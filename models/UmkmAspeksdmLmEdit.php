<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspeksdmLmEdit extends UmkmAspeksdmLm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspeksdm_lm';

    // Page object name
    public $PageObjName = "UmkmAspeksdmLmEdit";

    // Rendering View
    public $RenderingView = false;

    // Page headings
    public $Heading = "";
    public $Subheading = "";
    public $PageHeader;
    public $PageFooter;

    // Page terminated
    private $terminated = false;

    // Page heading
    public function pageHeading()
    {
        global $Language;
        if ($this->Heading != "") {
            return $this->Heading;
        }
        if (method_exists($this, "tableCaption")) {
            return $this->tableCaption();
        }
        return "";
    }

    // Page subheading
    public function pageSubheading()
    {
        global $Language;
        if ($this->Subheading != "") {
            return $this->Subheading;
        }
        if ($this->TableName) {
            return $Language->phrase($this->PageID);
        }
        return "";
    }

    // Page name
    public function pageName()
    {
        return CurrentPageName();
    }

    // Page URL
    public function pageUrl()
    {
        $url = ScriptName() . "?";
        if ($this->UseTokenInUrl) {
            $url .= "t=" . $this->TableVar . "&"; // Add page token
        }
        return $url;
    }

    // Show Page Header
    public function showPageHeader()
    {
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        if ($header != "") { // Header exists, display
            echo '<p id="ew-page-header">' . $header . '</p>';
        }
    }

    // Show Page Footer
    public function showPageFooter()
    {
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        if ($footer != "") { // Footer exists, display
            echo '<p id="ew-page-footer">' . $footer . '</p>';
        }
    }

    // Validate page request
    protected function isPageRequest()
    {
        global $CurrentForm;
        if ($this->UseTokenInUrl) {
            if ($CurrentForm) {
                return ($this->TableVar == $CurrentForm->getValue("t"));
            }
            if (Get("t") !== null) {
                return ($this->TableVar == Get("t"));
            }
        }
        return true;
    }

    // Constructor
    public function __construct()
    {
        global $Language, $DashboardReport, $DebugTimer;
        global $UserTable;

        // Initialize
        $GLOBALS["Page"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (umkm_aspeksdm_lm)
        if (!isset($GLOBALS["umkm_aspeksdm_lm"]) || get_class($GLOBALS["umkm_aspeksdm_lm"]) == PROJECT_NAMESPACE . "umkm_aspeksdm_lm") {
            $GLOBALS["umkm_aspeksdm_lm"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspeksdm_lm');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
    }

    // Get content from stream
    public function getContents($stream = null): string
    {
        global $Response;
        return is_object($Response) ? $Response->getBody() : ob_get_clean();
    }

    // Is lookup
    public function isLookup()
    {
        return SameText(Route(0), Config("API_LOOKUP_ACTION"));
    }

    // Is AutoFill
    public function isAutoFill()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autofill");
    }

    // Is AutoSuggest
    public function isAutoSuggest()
    {
        return $this->isLookup() && SameText(Post("ajax"), "autosuggest");
    }

    // Is modal lookup
    public function isModalLookup()
    {
        return $this->isLookup() && SameText(Post("ajax"), "modal");
    }

    // Is terminated
    public function isTerminated()
    {
        return $this->terminated;
    }

    /**
     * Terminate page
     *
     * @param string $url URL for direction
     * @return void
     */
    public function terminate($url = "")
    {
        if ($this->terminated) {
            return;
        }
        global $ExportFileName, $TempImages, $DashboardReport, $Response;

        // Page is terminated
        $this->terminated = true;

         // Page Unload event
        if (method_exists($this, "pageUnload")) {
            $this->pageUnload();
        }

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("umkm_aspeksdm_lm"));
                $doc->Text = @$content;
                if ($this->isExport("email")) {
                    echo $this->exportEmail($doc->Text);
                } else {
                    $doc->export();
                }
                DeleteTempImages(); // Delete temp images
                return;
            }
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

        // Close connection
        CloseConnections();

        // Return for API
        if (IsApi()) {
            $res = $url === true;
            if (!$res) { // Show error
                WriteJson(array_merge(["success" => false], $this->getMessages()));
            }
            return;
        } else { // Check if response is JSON
            if (StartsString("application/json", $Response->getHeaderLine("Content-type")) && $Response->getBody()->getSize()) { // With JSON response
                $this->clearMessages();
                return;
            }
        }

        // Go to URL if specified
        if ($url != "") {
            if (!Config("DEBUG") && ob_get_length()) {
                ob_end_clean();
            }

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "umkmaspeksdmlmview") {
                        $row["view"] = "1";
                    }
                } else { // List page should not be shown as modal => error
                    $row["error"] = $this->getFailureMessage();
                    $this->clearFailureMessage();
                }
                WriteJson($row);
            } else {
                SaveDebugMessage();
                Redirect(GetUrl($url));
            }
        }
        return; // Return to controller
    }

    // Get records from recordset
    protected function getRecordsFromRecordset($rs, $current = false)
    {
        $rows = [];
        if (is_object($rs)) { // Recordset
            while ($rs && !$rs->EOF) {
                $this->loadRowValues($rs); // Set up DbValue/CurrentValue
                $row = $this->getRecordFromArray($rs->fields);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
                $rs->moveNext();
            }
        } elseif (is_array($rs)) {
            foreach ($rs as $ar) {
                $row = $this->getRecordFromArray($ar);
                if ($current) {
                    return $row;
                } else {
                    $rows[] = $row;
                }
            }
        }
        return $rows;
    }

    // Get record from array
    protected function getRecordFromArray($ar)
    {
        $row = [];
        if (is_array($ar)) {
            foreach ($ar as $fldname => $val) {
                if (array_key_exists($fldname, $this->Fields) && ($this->Fields[$fldname]->Visible || $this->Fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
                    $fld = &$this->Fields[$fldname];
                    if ($fld->HtmlTag == "FILE") { // Upload field
                        if (EmptyValue($val)) {
                            $row[$fldname] = null;
                        } else {
                            if ($fld->DataType == DATATYPE_BLOB) {
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))));
                                $row[$fldname] = ["type" => ContentType($val), "url" => $url, "name" => $fld->Param . ContentExtension($val)];
                            } elseif (!$fld->UploadMultiple || !ContainsString($val, Config("MULTIPLE_UPLOAD_SEPARATOR"))) { // Single file
                                $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $val)));
                                $row[$fldname] = ["type" => MimeContentType($val), "url" => $url, "name" => $val];
                            } else { // Multiple files
                                $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                                $ar = [];
                                foreach ($files as $file) {
                                    $url = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                        "/" . $fld->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                                    if (!EmptyValue($file)) {
                                        $ar[] = ["type" => MimeContentType($file), "url" => $url, "name" => $file];
                                    }
                                }
                                $row[$fldname] = $ar;
                            }
                        }
                    } else {
                        $row[$fldname] = $val;
                    }
                }
            }
        }
        return $row;
    }

    // Get record key value from array
    protected function getRecordKeyValue($ar)
    {
        $key = "";
        if (is_array($ar)) {
            $key .= @$ar['NIK'];
        }
        return $key;
    }

    /**
     * Hide fields for add/edit
     *
     * @return void
     */
    protected function hideFieldsForAddEdit()
    {
    }

    // Lookup data
    public function lookup()
    {
        global $Language, $Security;

        // Get lookup object
        $fieldName = Post("field");
        $lookup = $this->Fields[$fieldName]->Lookup;

        // Get lookup parameters
        $lookupType = Post("ajax", "unknown");
        $pageSize = -1;
        $offset = -1;
        $searchValue = "";
        if (SameText($lookupType, "modal")) {
            $searchValue = Post("sv", "");
            $pageSize = Post("recperpage", 10);
            $offset = Post("start", 0);
        } elseif (SameText($lookupType, "autosuggest")) {
            $searchValue = Param("q", "");
            $pageSize = Param("n", -1);
            $pageSize = is_numeric($pageSize) ? (int)$pageSize : -1;
            if ($pageSize <= 0) {
                $pageSize = Config("AUTO_SUGGEST_MAX_ENTRIES");
            }
            $start = Param("start", -1);
            $start = is_numeric($start) ? (int)$start : -1;
            $page = Param("page", -1);
            $page = is_numeric($page) ? (int)$page : -1;
            $offset = $start >= 0 ? $start : ($page > 0 && $pageSize > 0 ? ($page - 1) * $pageSize : 0);
        }
        $userSelect = Decrypt(Post("s", ""));
        $userFilter = Decrypt(Post("f", ""));
        $userOrderBy = Decrypt(Post("o", ""));
        $keys = Post("keys");
        $lookup->LookupType = $lookupType; // Lookup type
        if ($keys !== null) { // Selected records from modal
            if (is_array($keys)) {
                $keys = implode(Config("MULTIPLE_OPTION_SEPARATOR"), $keys);
            }
            $lookup->FilterFields = []; // Skip parent fields if any
            $lookup->FilterValues[] = $keys; // Lookup values
            $pageSize = -1; // Show all records
        } else { // Lookup values
            $lookup->FilterValues[] = Post("v0", Post("lookupValue", ""));
        }
        $cnt = is_array($lookup->FilterFields) ? count($lookup->FilterFields) : 0;
        for ($i = 1; $i <= $cnt; $i++) {
            $lookup->FilterValues[] = Post("v" . $i, "");
        }
        $lookup->SearchValue = $searchValue;
        $lookup->PageSize = $pageSize;
        $lookup->Offset = $offset;
        if ($userSelect != "") {
            $lookup->UserSelect = $userSelect;
        }
        if ($userFilter != "") {
            $lookup->UserFilter = $userFilter;
        }
        if ($userOrderBy != "") {
            $lookup->UserOrderBy = $userOrderBy;
        }
        $lookup->toJson($this); // Use settings from current page
    }
    public $FormClassName = "ew-horizontal ew-form ew-edit-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $HashValue; // Hash Value
    public $DisplayRecords = 1;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecordCount;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action
        $this->NIK->setVisibility();
        $this->SDM_OMS->setVisibility();
        $this->SDM_FOKUS->setVisibility();
        $this->SDM_TARGET->setVisibility();
        $this->SDM_KARYAWANTETAP->setVisibility();
        $this->SDM_KARYAWANSUBKON->setVisibility();
        $this->SDM_GAJI->setVisibility();
        $this->SDM_ASURANSI->setVisibility();
        $this->SDM_TUNJANGAN->setVisibility();
        $this->SDM_PELATIHAN->setVisibility();
        $this->hideFieldsForAddEdit();

        // Do not use lookup cache
        $this->setUseLookupCache(false);

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up lookup cache

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-edit-form ew-horizontal";
        $loaded = false;
        $postBack = false;

        // Set up current action and primary key
        if (IsApi()) {
            // Load key values
            $loaded = true;
            if (($keyValue = Get("NIK") ?? Key(0) ?? Route(2)) !== null) {
                $this->NIK->setQueryStringValue($keyValue);
                $this->NIK->setOldValue($this->NIK->QueryStringValue);
            } elseif (Post("NIK") !== null) {
                $this->NIK->setFormValue(Post("NIK"));
                $this->NIK->setOldValue($this->NIK->FormValue);
            } else {
                $loaded = false; // Unable to load key
            }

            // Load record
            if ($loaded) {
                $loaded = $this->loadRow();
            }
            if (!$loaded) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                $this->terminate();
                return;
            }
            $this->CurrentAction = "update"; // Update record directly
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $postBack = true;
        } else {
            if (Post("action") !== null) {
                $this->CurrentAction = Post("action"); // Get action code
                if (!$this->isShow()) { // Not reload record, handle as postback
                    $postBack = true;
                }

                // Get key from Form
                $this->setKey(Post($this->OldKeyName), $this->isShow());
            } else {
                $this->CurrentAction = "show"; // Default action is display

                // Load key from QueryString
                $loadByQuery = false;
                if (($keyValue = Get("NIK") ?? Route("NIK")) !== null) {
                    $this->NIK->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->NIK->CurrentValue = null;
                }
            }

            // Load recordset
            if ($this->isShow()) {
                // Load current record
                $loaded = $this->loadRow();
                $this->OldKey = $loaded ? $this->getKey(true) : ""; // Get from CurrentValue
            }
        }

        // Process form if post back
        if ($postBack) {
            $this->loadFormValues(); // Get form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues();
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = ""; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "show": // Get a record to display
                if (!$loaded) { // Load record based on key
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("umkmaspeksdmlmlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "umkmaspeksdmlmlist") {
                    $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                }
                $this->SendEmail = true; // Send email on update success
                if ($this->editRow()) { // Update record based on key
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
                    }
                    if (IsApi()) {
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl); // Return to caller
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
                    $this->terminate($returnUrl); // Return to caller
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Restore form values if update failed
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render the record
        $this->RowType = ROWTYPE_EDIT; // Render as Edit
        $this->resetAttributes();
        $this->renderRow();

        // Set LoginStatus / Page_Rendering / Page_Render
        if (!IsApi() && !$this->isTerminated()) {
            // Pass table and field properties to client side
            $this->toClientVar(["tableCaption"], ["caption", "Visible", "Required", "IsInvalid", "Raw"]);

            // Setup login status
            SetupLoginStatus();

            // Pass login status to client side
            SetClientVar("login", LoginStatus());

            // Global Page Rendering event (in userfn*.php)
            Page_Rendering();

            // Page Render event
            if (method_exists($this, "pageRender")) {
                $this->pageRender();
            }
        }
    }

    // Get upload files
    protected function getUploadFiles()
    {
        global $CurrentForm, $Language;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'NIK' first before field var 'x_NIK'
        $val = $CurrentForm->hasValue("NIK") ? $CurrentForm->getValue("NIK") : $CurrentForm->getValue("x_NIK");
        if (!$this->NIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NIK->Visible = false; // Disable update for API request
            } else {
                $this->NIK->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_NIK")) {
            $this->NIK->setOldValue($CurrentForm->getValue("o_NIK"));
        }

        // Check field name 'SDM_OMS' first before field var 'x_SDM_OMS'
        $val = $CurrentForm->hasValue("SDM_OMS") ? $CurrentForm->getValue("SDM_OMS") : $CurrentForm->getValue("x_SDM_OMS");
        if (!$this->SDM_OMS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_OMS->Visible = false; // Disable update for API request
            } else {
                $this->SDM_OMS->setFormValue($val);
            }
        }

        // Check field name 'SDM_FOKUS' first before field var 'x_SDM_FOKUS'
        $val = $CurrentForm->hasValue("SDM_FOKUS") ? $CurrentForm->getValue("SDM_FOKUS") : $CurrentForm->getValue("x_SDM_FOKUS");
        if (!$this->SDM_FOKUS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_FOKUS->Visible = false; // Disable update for API request
            } else {
                $this->SDM_FOKUS->setFormValue($val);
            }
        }

        // Check field name 'SDM_TARGET' first before field var 'x_SDM_TARGET'
        $val = $CurrentForm->hasValue("SDM_TARGET") ? $CurrentForm->getValue("SDM_TARGET") : $CurrentForm->getValue("x_SDM_TARGET");
        if (!$this->SDM_TARGET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_TARGET->Visible = false; // Disable update for API request
            } else {
                $this->SDM_TARGET->setFormValue($val);
            }
        }

        // Check field name 'SDM_KARYAWANTETAP' first before field var 'x_SDM_KARYAWANTETAP'
        $val = $CurrentForm->hasValue("SDM_KARYAWANTETAP") ? $CurrentForm->getValue("SDM_KARYAWANTETAP") : $CurrentForm->getValue("x_SDM_KARYAWANTETAP");
        if (!$this->SDM_KARYAWANTETAP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_KARYAWANTETAP->Visible = false; // Disable update for API request
            } else {
                $this->SDM_KARYAWANTETAP->setFormValue($val);
            }
        }

        // Check field name 'SDM_KARYAWANSUBKON' first before field var 'x_SDM_KARYAWANSUBKON'
        $val = $CurrentForm->hasValue("SDM_KARYAWANSUBKON") ? $CurrentForm->getValue("SDM_KARYAWANSUBKON") : $CurrentForm->getValue("x_SDM_KARYAWANSUBKON");
        if (!$this->SDM_KARYAWANSUBKON->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_KARYAWANSUBKON->Visible = false; // Disable update for API request
            } else {
                $this->SDM_KARYAWANSUBKON->setFormValue($val);
            }
        }

        // Check field name 'SDM_GAJI' first before field var 'x_SDM_GAJI'
        $val = $CurrentForm->hasValue("SDM_GAJI") ? $CurrentForm->getValue("SDM_GAJI") : $CurrentForm->getValue("x_SDM_GAJI");
        if (!$this->SDM_GAJI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_GAJI->Visible = false; // Disable update for API request
            } else {
                $this->SDM_GAJI->setFormValue($val);
            }
        }

        // Check field name 'SDM_ASURANSI' first before field var 'x_SDM_ASURANSI'
        $val = $CurrentForm->hasValue("SDM_ASURANSI") ? $CurrentForm->getValue("SDM_ASURANSI") : $CurrentForm->getValue("x_SDM_ASURANSI");
        if (!$this->SDM_ASURANSI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_ASURANSI->Visible = false; // Disable update for API request
            } else {
                $this->SDM_ASURANSI->setFormValue($val);
            }
        }

        // Check field name 'SDM_TUNJANGAN' first before field var 'x_SDM_TUNJANGAN'
        $val = $CurrentForm->hasValue("SDM_TUNJANGAN") ? $CurrentForm->getValue("SDM_TUNJANGAN") : $CurrentForm->getValue("x_SDM_TUNJANGAN");
        if (!$this->SDM_TUNJANGAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_TUNJANGAN->Visible = false; // Disable update for API request
            } else {
                $this->SDM_TUNJANGAN->setFormValue($val);
            }
        }

        // Check field name 'SDM_PELATIHAN' first before field var 'x_SDM_PELATIHAN'
        $val = $CurrentForm->hasValue("SDM_PELATIHAN") ? $CurrentForm->getValue("SDM_PELATIHAN") : $CurrentForm->getValue("x_SDM_PELATIHAN");
        if (!$this->SDM_PELATIHAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_PELATIHAN->Visible = false; // Disable update for API request
            } else {
                $this->SDM_PELATIHAN->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->SDM_OMS->CurrentValue = $this->SDM_OMS->FormValue;
        $this->SDM_FOKUS->CurrentValue = $this->SDM_FOKUS->FormValue;
        $this->SDM_TARGET->CurrentValue = $this->SDM_TARGET->FormValue;
        $this->SDM_KARYAWANTETAP->CurrentValue = $this->SDM_KARYAWANTETAP->FormValue;
        $this->SDM_KARYAWANSUBKON->CurrentValue = $this->SDM_KARYAWANSUBKON->FormValue;
        $this->SDM_GAJI->CurrentValue = $this->SDM_GAJI->FormValue;
        $this->SDM_ASURANSI->CurrentValue = $this->SDM_ASURANSI->FormValue;
        $this->SDM_TUNJANGAN->CurrentValue = $this->SDM_TUNJANGAN->FormValue;
        $this->SDM_PELATIHAN->CurrentValue = $this->SDM_PELATIHAN->FormValue;
    }

    /**
     * Load row based on key values
     *
     * @return void
     */
    public function loadRow()
    {
        global $Security, $Language;
        $filter = $this->getRecordFilter();

        // Call Row Selecting event
        $this->rowSelecting($filter);

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $res = false;
        $row = $conn->fetchAssoc($sql);
        if ($row) {
            $res = true;
            $this->loadRowValues($row); // Load row values
        }
        return $res;
    }

    /**
     * Load row values from recordset or record
     *
     * @param Recordset|array $rs Record
     * @return void
     */
    public function loadRowValues($rs = null)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            $row = $this->newRow();
        }

        // Call Row Selected event
        $this->rowSelected($row);
        if (!$rs) {
            return;
        }
        $this->NIK->setDbValue($row['NIK']);
        $this->SDM_OMS->setDbValue($row['SDM_OMS']);
        $this->SDM_FOKUS->setDbValue($row['SDM_FOKUS']);
        $this->SDM_TARGET->setDbValue($row['SDM_TARGET']);
        $this->SDM_KARYAWANTETAP->setDbValue($row['SDM_KARYAWANTETAP']);
        $this->SDM_KARYAWANSUBKON->setDbValue($row['SDM_KARYAWANSUBKON']);
        $this->SDM_GAJI->setDbValue($row['SDM_GAJI']);
        $this->SDM_ASURANSI->setDbValue($row['SDM_ASURANSI']);
        $this->SDM_TUNJANGAN->setDbValue($row['SDM_TUNJANGAN']);
        $this->SDM_PELATIHAN->setDbValue($row['SDM_PELATIHAN']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['SDM_OMS'] = null;
        $row['SDM_FOKUS'] = null;
        $row['SDM_TARGET'] = null;
        $row['SDM_KARYAWANTETAP'] = null;
        $row['SDM_KARYAWANSUBKON'] = null;
        $row['SDM_GAJI'] = null;
        $row['SDM_ASURANSI'] = null;
        $row['SDM_TUNJANGAN'] = null;
        $row['SDM_PELATIHAN'] = null;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        // Load old record
        $this->OldRecordset = null;
        $validKey = $this->OldKey != "";
        if ($validKey) {
            $this->CurrentFilter = $this->getRecordFilter();
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $this->OldRecordset = LoadRecordset($sql, $conn);
        }
        $this->loadRowValues($this->OldRecordset); // Load row values
        return $validKey;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // SDM_OMS

        // SDM_FOKUS

        // SDM_TARGET

        // SDM_KARYAWANTETAP

        // SDM_KARYAWANSUBKON

        // SDM_GAJI

        // SDM_ASURANSI

        // SDM_TUNJANGAN

        // SDM_PELATIHAN
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // SDM_OMS
            $this->SDM_OMS->ViewValue = $this->SDM_OMS->CurrentValue;
            $this->SDM_OMS->ViewCustomAttributes = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->CurrentValue;
            $this->SDM_FOKUS->ViewCustomAttributes = "";

            // SDM_TARGET
            $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->CurrentValue;
            $this->SDM_TARGET->ViewCustomAttributes = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->CurrentValue;
            $this->SDM_KARYAWANTETAP->ViewCustomAttributes = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->CurrentValue;
            $this->SDM_KARYAWANSUBKON->ViewCustomAttributes = "";

            // SDM_GAJI
            $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->CurrentValue;
            $this->SDM_GAJI->ViewCustomAttributes = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->CurrentValue;
            $this->SDM_ASURANSI->ViewCustomAttributes = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->CurrentValue;
            $this->SDM_TUNJANGAN->ViewCustomAttributes = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->CurrentValue;
            $this->SDM_PELATIHAN->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // SDM_OMS
            $this->SDM_OMS->LinkCustomAttributes = "";
            $this->SDM_OMS->HrefValue = "";
            $this->SDM_OMS->TooltipValue = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->LinkCustomAttributes = "";
            $this->SDM_FOKUS->HrefValue = "";
            $this->SDM_FOKUS->TooltipValue = "";

            // SDM_TARGET
            $this->SDM_TARGET->LinkCustomAttributes = "";
            $this->SDM_TARGET->HrefValue = "";
            $this->SDM_TARGET->TooltipValue = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->HrefValue = "";
            $this->SDM_KARYAWANTETAP->TooltipValue = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->HrefValue = "";
            $this->SDM_KARYAWANSUBKON->TooltipValue = "";

            // SDM_GAJI
            $this->SDM_GAJI->LinkCustomAttributes = "";
            $this->SDM_GAJI->HrefValue = "";
            $this->SDM_GAJI->TooltipValue = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->LinkCustomAttributes = "";
            $this->SDM_ASURANSI->HrefValue = "";
            $this->SDM_ASURANSI->TooltipValue = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
            $this->SDM_TUNJANGAN->HrefValue = "";
            $this->SDM_TUNJANGAN->TooltipValue = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->LinkCustomAttributes = "";
            $this->SDM_PELATIHAN->HrefValue = "";
            $this->SDM_PELATIHAN->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK
            $this->NIK->EditAttrs["class"] = "form-control";
            $this->NIK->EditCustomAttributes = "";
            if (!$this->NIK->Raw) {
                $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
            }
            $this->NIK->EditValue = HtmlEncode($this->NIK->CurrentValue);
            $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

            // SDM_OMS
            $this->SDM_OMS->EditAttrs["class"] = "form-control";
            $this->SDM_OMS->EditCustomAttributes = "";
            if (!$this->SDM_OMS->Raw) {
                $this->SDM_OMS->CurrentValue = HtmlDecode($this->SDM_OMS->CurrentValue);
            }
            $this->SDM_OMS->EditValue = HtmlEncode($this->SDM_OMS->CurrentValue);
            $this->SDM_OMS->PlaceHolder = RemoveHtml($this->SDM_OMS->caption());

            // SDM_FOKUS
            $this->SDM_FOKUS->EditAttrs["class"] = "form-control";
            $this->SDM_FOKUS->EditCustomAttributes = "";
            if (!$this->SDM_FOKUS->Raw) {
                $this->SDM_FOKUS->CurrentValue = HtmlDecode($this->SDM_FOKUS->CurrentValue);
            }
            $this->SDM_FOKUS->EditValue = HtmlEncode($this->SDM_FOKUS->CurrentValue);
            $this->SDM_FOKUS->PlaceHolder = RemoveHtml($this->SDM_FOKUS->caption());

            // SDM_TARGET
            $this->SDM_TARGET->EditAttrs["class"] = "form-control";
            $this->SDM_TARGET->EditCustomAttributes = "";
            if (!$this->SDM_TARGET->Raw) {
                $this->SDM_TARGET->CurrentValue = HtmlDecode($this->SDM_TARGET->CurrentValue);
            }
            $this->SDM_TARGET->EditValue = HtmlEncode($this->SDM_TARGET->CurrentValue);
            $this->SDM_TARGET->PlaceHolder = RemoveHtml($this->SDM_TARGET->caption());

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANTETAP->EditCustomAttributes = "";
            if (!$this->SDM_KARYAWANTETAP->Raw) {
                $this->SDM_KARYAWANTETAP->CurrentValue = HtmlDecode($this->SDM_KARYAWANTETAP->CurrentValue);
            }
            $this->SDM_KARYAWANTETAP->EditValue = HtmlEncode($this->SDM_KARYAWANTETAP->CurrentValue);
            $this->SDM_KARYAWANTETAP->PlaceHolder = RemoveHtml($this->SDM_KARYAWANTETAP->caption());

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANSUBKON->EditCustomAttributes = "";
            if (!$this->SDM_KARYAWANSUBKON->Raw) {
                $this->SDM_KARYAWANSUBKON->CurrentValue = HtmlDecode($this->SDM_KARYAWANSUBKON->CurrentValue);
            }
            $this->SDM_KARYAWANSUBKON->EditValue = HtmlEncode($this->SDM_KARYAWANSUBKON->CurrentValue);
            $this->SDM_KARYAWANSUBKON->PlaceHolder = RemoveHtml($this->SDM_KARYAWANSUBKON->caption());

            // SDM_GAJI
            $this->SDM_GAJI->EditAttrs["class"] = "form-control";
            $this->SDM_GAJI->EditCustomAttributes = "";
            if (!$this->SDM_GAJI->Raw) {
                $this->SDM_GAJI->CurrentValue = HtmlDecode($this->SDM_GAJI->CurrentValue);
            }
            $this->SDM_GAJI->EditValue = HtmlEncode($this->SDM_GAJI->CurrentValue);
            $this->SDM_GAJI->PlaceHolder = RemoveHtml($this->SDM_GAJI->caption());

            // SDM_ASURANSI
            $this->SDM_ASURANSI->EditAttrs["class"] = "form-control";
            $this->SDM_ASURANSI->EditCustomAttributes = "";
            if (!$this->SDM_ASURANSI->Raw) {
                $this->SDM_ASURANSI->CurrentValue = HtmlDecode($this->SDM_ASURANSI->CurrentValue);
            }
            $this->SDM_ASURANSI->EditValue = HtmlEncode($this->SDM_ASURANSI->CurrentValue);
            $this->SDM_ASURANSI->PlaceHolder = RemoveHtml($this->SDM_ASURANSI->caption());

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->EditAttrs["class"] = "form-control";
            $this->SDM_TUNJANGAN->EditCustomAttributes = "";
            if (!$this->SDM_TUNJANGAN->Raw) {
                $this->SDM_TUNJANGAN->CurrentValue = HtmlDecode($this->SDM_TUNJANGAN->CurrentValue);
            }
            $this->SDM_TUNJANGAN->EditValue = HtmlEncode($this->SDM_TUNJANGAN->CurrentValue);
            $this->SDM_TUNJANGAN->PlaceHolder = RemoveHtml($this->SDM_TUNJANGAN->caption());

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->EditAttrs["class"] = "form-control";
            $this->SDM_PELATIHAN->EditCustomAttributes = "";
            if (!$this->SDM_PELATIHAN->Raw) {
                $this->SDM_PELATIHAN->CurrentValue = HtmlDecode($this->SDM_PELATIHAN->CurrentValue);
            }
            $this->SDM_PELATIHAN->EditValue = HtmlEncode($this->SDM_PELATIHAN->CurrentValue);
            $this->SDM_PELATIHAN->PlaceHolder = RemoveHtml($this->SDM_PELATIHAN->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // SDM_OMS
            $this->SDM_OMS->LinkCustomAttributes = "";
            $this->SDM_OMS->HrefValue = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->LinkCustomAttributes = "";
            $this->SDM_FOKUS->HrefValue = "";

            // SDM_TARGET
            $this->SDM_TARGET->LinkCustomAttributes = "";
            $this->SDM_TARGET->HrefValue = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->HrefValue = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->HrefValue = "";

            // SDM_GAJI
            $this->SDM_GAJI->LinkCustomAttributes = "";
            $this->SDM_GAJI->HrefValue = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->LinkCustomAttributes = "";
            $this->SDM_ASURANSI->HrefValue = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
            $this->SDM_TUNJANGAN->HrefValue = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->LinkCustomAttributes = "";
            $this->SDM_PELATIHAN->HrefValue = "";
        }
        if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) { // Add/Edit/Search row
            $this->setupFieldTitles();
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Validate form
    protected function validateForm()
    {
        global $Language;

        // Check if validation required
        if (!Config("SERVER_VALIDATE")) {
            return true;
        }
        if ($this->NIK->Required) {
            if (!$this->NIK->IsDetailKey && EmptyValue($this->NIK->FormValue)) {
                $this->NIK->addErrorMessage(str_replace("%s", $this->NIK->caption(), $this->NIK->RequiredErrorMessage));
            }
        }
        if ($this->SDM_OMS->Required) {
            if (!$this->SDM_OMS->IsDetailKey && EmptyValue($this->SDM_OMS->FormValue)) {
                $this->SDM_OMS->addErrorMessage(str_replace("%s", $this->SDM_OMS->caption(), $this->SDM_OMS->RequiredErrorMessage));
            }
        }
        if ($this->SDM_FOKUS->Required) {
            if (!$this->SDM_FOKUS->IsDetailKey && EmptyValue($this->SDM_FOKUS->FormValue)) {
                $this->SDM_FOKUS->addErrorMessage(str_replace("%s", $this->SDM_FOKUS->caption(), $this->SDM_FOKUS->RequiredErrorMessage));
            }
        }
        if ($this->SDM_TARGET->Required) {
            if (!$this->SDM_TARGET->IsDetailKey && EmptyValue($this->SDM_TARGET->FormValue)) {
                $this->SDM_TARGET->addErrorMessage(str_replace("%s", $this->SDM_TARGET->caption(), $this->SDM_TARGET->RequiredErrorMessage));
            }
        }
        if ($this->SDM_KARYAWANTETAP->Required) {
            if (!$this->SDM_KARYAWANTETAP->IsDetailKey && EmptyValue($this->SDM_KARYAWANTETAP->FormValue)) {
                $this->SDM_KARYAWANTETAP->addErrorMessage(str_replace("%s", $this->SDM_KARYAWANTETAP->caption(), $this->SDM_KARYAWANTETAP->RequiredErrorMessage));
            }
        }
        if ($this->SDM_KARYAWANSUBKON->Required) {
            if (!$this->SDM_KARYAWANSUBKON->IsDetailKey && EmptyValue($this->SDM_KARYAWANSUBKON->FormValue)) {
                $this->SDM_KARYAWANSUBKON->addErrorMessage(str_replace("%s", $this->SDM_KARYAWANSUBKON->caption(), $this->SDM_KARYAWANSUBKON->RequiredErrorMessage));
            }
        }
        if ($this->SDM_GAJI->Required) {
            if (!$this->SDM_GAJI->IsDetailKey && EmptyValue($this->SDM_GAJI->FormValue)) {
                $this->SDM_GAJI->addErrorMessage(str_replace("%s", $this->SDM_GAJI->caption(), $this->SDM_GAJI->RequiredErrorMessage));
            }
        }
        if ($this->SDM_ASURANSI->Required) {
            if (!$this->SDM_ASURANSI->IsDetailKey && EmptyValue($this->SDM_ASURANSI->FormValue)) {
                $this->SDM_ASURANSI->addErrorMessage(str_replace("%s", $this->SDM_ASURANSI->caption(), $this->SDM_ASURANSI->RequiredErrorMessage));
            }
        }
        if ($this->SDM_TUNJANGAN->Required) {
            if (!$this->SDM_TUNJANGAN->IsDetailKey && EmptyValue($this->SDM_TUNJANGAN->FormValue)) {
                $this->SDM_TUNJANGAN->addErrorMessage(str_replace("%s", $this->SDM_TUNJANGAN->caption(), $this->SDM_TUNJANGAN->RequiredErrorMessage));
            }
        }
        if ($this->SDM_PELATIHAN->Required) {
            if (!$this->SDM_PELATIHAN->IsDetailKey && EmptyValue($this->SDM_PELATIHAN->FormValue)) {
                $this->SDM_PELATIHAN->addErrorMessage(str_replace("%s", $this->SDM_PELATIHAN->caption(), $this->SDM_PELATIHAN->RequiredErrorMessage));
            }
        }

        // Return validate result
        $validateForm = !$this->hasInvalidFields();

        // Call Form_CustomValidate event
        $formCustomError = "";
        $validateForm = $validateForm && $this->formCustomValidate($formCustomError);
        if ($formCustomError != "") {
            $this->setFailureMessage($formCustomError);
        }
        return $validateForm;
    }

    // Update record based on key values
    protected function editRow()
    {
        global $Security, $Language;
        $oldKeyFilter = $this->getRecordFilter();
        $filter = $this->applyUserIDFilters($oldKeyFilter);
        $conn = $this->getConnection();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $rsold = $conn->fetchAssoc($sql);
        $editRow = false;
        if (!$rsold) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
            $editRow = false; // Update Failed
        } else {
            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // NIK
            $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "", $this->NIK->ReadOnly);

            // SDM_OMS
            $this->SDM_OMS->setDbValueDef($rsnew, $this->SDM_OMS->CurrentValue, null, $this->SDM_OMS->ReadOnly);

            // SDM_FOKUS
            $this->SDM_FOKUS->setDbValueDef($rsnew, $this->SDM_FOKUS->CurrentValue, null, $this->SDM_FOKUS->ReadOnly);

            // SDM_TARGET
            $this->SDM_TARGET->setDbValueDef($rsnew, $this->SDM_TARGET->CurrentValue, null, $this->SDM_TARGET->ReadOnly);

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->setDbValueDef($rsnew, $this->SDM_KARYAWANTETAP->CurrentValue, null, $this->SDM_KARYAWANTETAP->ReadOnly);

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->setDbValueDef($rsnew, $this->SDM_KARYAWANSUBKON->CurrentValue, null, $this->SDM_KARYAWANSUBKON->ReadOnly);

            // SDM_GAJI
            $this->SDM_GAJI->setDbValueDef($rsnew, $this->SDM_GAJI->CurrentValue, null, $this->SDM_GAJI->ReadOnly);

            // SDM_ASURANSI
            $this->SDM_ASURANSI->setDbValueDef($rsnew, $this->SDM_ASURANSI->CurrentValue, null, $this->SDM_ASURANSI->ReadOnly);

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->setDbValueDef($rsnew, $this->SDM_TUNJANGAN->CurrentValue, null, $this->SDM_TUNJANGAN->ReadOnly);

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->setDbValueDef($rsnew, $this->SDM_PELATIHAN->CurrentValue, null, $this->SDM_PELATIHAN->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);

            // Check for duplicate key when key changed
            if ($updateRow) {
                $newKeyFilter = $this->getRecordFilter($rsnew);
                if ($newKeyFilter != $oldKeyFilter) {
                    $rsChk = $this->loadRs($newKeyFilter)->fetch();
                    if ($rsChk !== false) {
                        $keyErrMsg = str_replace("%f", $newKeyFilter, $Language->phrase("DupKey"));
                        $this->setFailureMessage($keyErrMsg);
                        $updateRow = false;
                    }
                }
            }
            if ($updateRow) {
                if (count($rsnew) > 0) {
                    try {
                        $editRow = $this->update($rsnew, "", $rsold);
                    } catch (\Exception $e) {
                        $this->setFailureMessage($e->getMessage());
                    }
                } else {
                    $editRow = true; // No field to update
                }
                if ($editRow) {
                }
            } else {
                if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                    // Use the message, do nothing
                } elseif ($this->CancelMessage != "") {
                    $this->setFailureMessage($this->CancelMessage);
                    $this->CancelMessage = "";
                } else {
                    $this->setFailureMessage($Language->phrase("UpdateCancelled"));
                }
                $editRow = false;
            }
        }

        // Call Row_Updated event
        if ($editRow) {
            $this->rowUpdated($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($editRow) {
        }

        // Write JSON for API request
        if (IsApi() && $editRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $editRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspeksdmlmlist"), "", $this->TableVar, true);
        $pageId = "edit";
        $Breadcrumb->add("edit", $pageId, $url);
    }

    // Setup lookup options
    public function setupLookupOptions($fld)
    {
        if ($fld->Lookup !== null && $fld->Lookup->Options === null) {
            // Get default connection and filter
            $conn = $this->getConnection();
            $lookupFilter = "";

            // No need to check any more
            $fld->Lookup->Options = [];

            // Set up lookup SQL and connection
            switch ($fld->FieldVar) {
                default:
                    $lookupFilter = "";
                    break;
            }

            // Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
            $sql = $fld->Lookup->getSql(false, "", $lookupFilter, $this);

            // Set up lookup cache
            if ($fld->UseLookupCache && $sql != "" && count($fld->Lookup->Options) == 0) {
                $totalCnt = $this->getRecordCount($sql, $conn);
                if ($totalCnt > $fld->LookupCacheCount) { // Total count > cache count, do not cache
                    return;
                }
                $rows = $conn->executeQuery($sql)->fetchAll(\PDO::FETCH_BOTH);
                $ar = [];
                foreach ($rows as $row) {
                    $row = $fld->Lookup->renderViewRow($row);
                    $ar[strval($row[0])] = $row;
                }
                $fld->Lookup->Options = $ar;
            }
        }
    }

    // Set up starting record parameters
    public function setupStartRecord()
    {
        if ($this->DisplayRecords == 0) {
            return;
        }
        if ($this->isPageRequest()) { // Validate request
            $startRec = Get(Config("TABLE_START_REC"));
            $pageNo = Get(Config("TABLE_PAGE_NO"));
            if ($pageNo !== null) { // Check for "pageno" parameter first
                if (is_numeric($pageNo)) {
                    $this->StartRecord = ($pageNo - 1) * $this->DisplayRecords + 1;
                    if ($this->StartRecord <= 0) {
                        $this->StartRecord = 1;
                    } elseif ($this->StartRecord >= (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1) {
                        $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1;
                    }
                    $this->setStartRecordNumber($this->StartRecord);
                }
            } elseif ($startRec !== null) { // Check for "start" parameter
                $this->StartRecord = $startRec;
                $this->setStartRecordNumber($this->StartRecord);
            }
        }
        $this->StartRecord = $this->getStartRecordNumber();

        // Check if correct start record counter
        if (!is_numeric($this->StartRecord) || $this->StartRecord == "") { // Avoid invalid start record counter
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->StartRecord > $this->TotalRecords) { // Avoid starting record > total records
            $this->StartRecord = (int)(($this->TotalRecords - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to last page first record
            $this->setStartRecordNumber($this->StartRecord);
        } elseif (($this->StartRecord - 1) % $this->DisplayRecords != 0) {
            $this->StartRecord = (int)(($this->StartRecord - 1) / $this->DisplayRecords) * $this->DisplayRecords + 1; // Point to page boundary
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Page Load event
    public function pageLoad()
    {
        //Log("Page Load");
    }

    // Page Unload event
    public function pageUnload()
    {
        //Log("Page Unload");
    }

    // Page Redirecting event
    public function pageRedirecting(&$url)
    {
        // Example:
        //$url = "your URL";
    }

    // Message Showing event
    // $type = ''|'success'|'failure'|'warning'
    public function messageShowing(&$msg, $type)
    {
        if ($type == 'success') {
            //$msg = "your success message";
        } elseif ($type == 'failure') {
            //$msg = "your failure message";
        } elseif ($type == 'warning') {
            //$msg = "your warning message";
        } else {
            //$msg = "your message";
        }
    }

    // Page Render event
    public function pageRender()
    {
        //Log("Page Render");
    }

    // Page Data Rendering event
    public function pageDataRendering(&$header)
    {
        // Example:
        //$header = "your header";
    }

    // Page Data Rendered event
    public function pageDataRendered(&$footer)
    {
        // Example:
        //$footer = "your footer";
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }
}
