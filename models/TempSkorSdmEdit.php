<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorSdmEdit extends TempSkorSdm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_sdm';

    // Page object name
    public $PageObjName = "TempSkorSdmEdit";

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

        // Table object (temp_skor_sdm)
        if (!isset($GLOBALS["temp_skor_sdm"]) || get_class($GLOBALS["temp_skor_sdm"]) == PROJECT_NAMESPACE . "temp_skor_sdm") {
            $GLOBALS["temp_skor_sdm"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_sdm');
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
                $doc = new $class(Container("temp_skor_sdm"));
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
                    if ($pageName == "tempskorsdmview") {
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
            $key .= @$ar['nik'];
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
        $this->nik->setVisibility();
        $this->skor_oms->setVisibility();
        $this->max_oms->setVisibility();
        $this->skor_fokus->setVisibility();
        $this->max_fokus->setVisibility();
        $this->skor_target->setVisibility();
        $this->max_target->setVisibility();
        $this->skor_karyawan->setVisibility();
        $this->max_karyawan->setVisibility();
        $this->skor_outsource->setVisibility();
        $this->max_outsource->setVisibility();
        $this->skor_besarangaji->setVisibility();
        $this->max_besarangaji->setVisibility();
        $this->skor_asuransi->setVisibility();
        $this->max_asuransi->setVisibility();
        $this->skor_bonus->setVisibility();
        $this->max_bonus->setVisibility();
        $this->skor_training->setVisibility();
        $this->max_training->setVisibility();
        $this->skor_sdm->setVisibility();
        $this->maxskor_sdm->setVisibility();
        $this->bobot_sdm->setVisibility();
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
            if (($keyValue = Get("nik") ?? Key(0) ?? Route(2)) !== null) {
                $this->nik->setQueryStringValue($keyValue);
                $this->nik->setOldValue($this->nik->QueryStringValue);
            } elseif (Post("nik") !== null) {
                $this->nik->setFormValue(Post("nik"));
                $this->nik->setOldValue($this->nik->FormValue);
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
                if (($keyValue = Get("nik") ?? Route("nik")) !== null) {
                    $this->nik->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->nik->CurrentValue = null;
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
                    $this->terminate("tempskorsdmlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "tempskorsdmlist") {
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

        // Check field name 'nik' first before field var 'x_nik'
        $val = $CurrentForm->hasValue("nik") ? $CurrentForm->getValue("nik") : $CurrentForm->getValue("x_nik");
        if (!$this->nik->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nik->Visible = false; // Disable update for API request
            } else {
                $this->nik->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_nik")) {
            $this->nik->setOldValue($CurrentForm->getValue("o_nik"));
        }

        // Check field name 'skor_oms' first before field var 'x_skor_oms'
        $val = $CurrentForm->hasValue("skor_oms") ? $CurrentForm->getValue("skor_oms") : $CurrentForm->getValue("x_skor_oms");
        if (!$this->skor_oms->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_oms->Visible = false; // Disable update for API request
            } else {
                $this->skor_oms->setFormValue($val);
            }
        }

        // Check field name 'max_oms' first before field var 'x_max_oms'
        $val = $CurrentForm->hasValue("max_oms") ? $CurrentForm->getValue("max_oms") : $CurrentForm->getValue("x_max_oms");
        if (!$this->max_oms->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_oms->Visible = false; // Disable update for API request
            } else {
                $this->max_oms->setFormValue($val);
            }
        }

        // Check field name 'skor_fokus' first before field var 'x_skor_fokus'
        $val = $CurrentForm->hasValue("skor_fokus") ? $CurrentForm->getValue("skor_fokus") : $CurrentForm->getValue("x_skor_fokus");
        if (!$this->skor_fokus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_fokus->Visible = false; // Disable update for API request
            } else {
                $this->skor_fokus->setFormValue($val);
            }
        }

        // Check field name 'max_fokus' first before field var 'x_max_fokus'
        $val = $CurrentForm->hasValue("max_fokus") ? $CurrentForm->getValue("max_fokus") : $CurrentForm->getValue("x_max_fokus");
        if (!$this->max_fokus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_fokus->Visible = false; // Disable update for API request
            } else {
                $this->max_fokus->setFormValue($val);
            }
        }

        // Check field name 'skor_target' first before field var 'x_skor_target'
        $val = $CurrentForm->hasValue("skor_target") ? $CurrentForm->getValue("skor_target") : $CurrentForm->getValue("x_skor_target");
        if (!$this->skor_target->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_target->Visible = false; // Disable update for API request
            } else {
                $this->skor_target->setFormValue($val);
            }
        }

        // Check field name 'max_target' first before field var 'x_max_target'
        $val = $CurrentForm->hasValue("max_target") ? $CurrentForm->getValue("max_target") : $CurrentForm->getValue("x_max_target");
        if (!$this->max_target->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_target->Visible = false; // Disable update for API request
            } else {
                $this->max_target->setFormValue($val);
            }
        }

        // Check field name 'skor_karyawan' first before field var 'x_skor_karyawan'
        $val = $CurrentForm->hasValue("skor_karyawan") ? $CurrentForm->getValue("skor_karyawan") : $CurrentForm->getValue("x_skor_karyawan");
        if (!$this->skor_karyawan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_karyawan->Visible = false; // Disable update for API request
            } else {
                $this->skor_karyawan->setFormValue($val);
            }
        }

        // Check field name 'max_karyawan' first before field var 'x_max_karyawan'
        $val = $CurrentForm->hasValue("max_karyawan") ? $CurrentForm->getValue("max_karyawan") : $CurrentForm->getValue("x_max_karyawan");
        if (!$this->max_karyawan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_karyawan->Visible = false; // Disable update for API request
            } else {
                $this->max_karyawan->setFormValue($val);
            }
        }

        // Check field name 'skor_outsource' first before field var 'x_skor_outsource'
        $val = $CurrentForm->hasValue("skor_outsource") ? $CurrentForm->getValue("skor_outsource") : $CurrentForm->getValue("x_skor_outsource");
        if (!$this->skor_outsource->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_outsource->Visible = false; // Disable update for API request
            } else {
                $this->skor_outsource->setFormValue($val);
            }
        }

        // Check field name 'max_outsource' first before field var 'x_max_outsource'
        $val = $CurrentForm->hasValue("max_outsource") ? $CurrentForm->getValue("max_outsource") : $CurrentForm->getValue("x_max_outsource");
        if (!$this->max_outsource->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_outsource->Visible = false; // Disable update for API request
            } else {
                $this->max_outsource->setFormValue($val);
            }
        }

        // Check field name 'skor_besarangaji' first before field var 'x_skor_besarangaji'
        $val = $CurrentForm->hasValue("skor_besarangaji") ? $CurrentForm->getValue("skor_besarangaji") : $CurrentForm->getValue("x_skor_besarangaji");
        if (!$this->skor_besarangaji->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_besarangaji->Visible = false; // Disable update for API request
            } else {
                $this->skor_besarangaji->setFormValue($val);
            }
        }

        // Check field name 'max_besarangaji' first before field var 'x_max_besarangaji'
        $val = $CurrentForm->hasValue("max_besarangaji") ? $CurrentForm->getValue("max_besarangaji") : $CurrentForm->getValue("x_max_besarangaji");
        if (!$this->max_besarangaji->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_besarangaji->Visible = false; // Disable update for API request
            } else {
                $this->max_besarangaji->setFormValue($val);
            }
        }

        // Check field name 'skor_asuransi' first before field var 'x_skor_asuransi'
        $val = $CurrentForm->hasValue("skor_asuransi") ? $CurrentForm->getValue("skor_asuransi") : $CurrentForm->getValue("x_skor_asuransi");
        if (!$this->skor_asuransi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_asuransi->Visible = false; // Disable update for API request
            } else {
                $this->skor_asuransi->setFormValue($val);
            }
        }

        // Check field name 'max_asuransi' first before field var 'x_max_asuransi'
        $val = $CurrentForm->hasValue("max_asuransi") ? $CurrentForm->getValue("max_asuransi") : $CurrentForm->getValue("x_max_asuransi");
        if (!$this->max_asuransi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_asuransi->Visible = false; // Disable update for API request
            } else {
                $this->max_asuransi->setFormValue($val);
            }
        }

        // Check field name 'skor_bonus' first before field var 'x_skor_bonus'
        $val = $CurrentForm->hasValue("skor_bonus") ? $CurrentForm->getValue("skor_bonus") : $CurrentForm->getValue("x_skor_bonus");
        if (!$this->skor_bonus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_bonus->Visible = false; // Disable update for API request
            } else {
                $this->skor_bonus->setFormValue($val);
            }
        }

        // Check field name 'max_bonus' first before field var 'x_max_bonus'
        $val = $CurrentForm->hasValue("max_bonus") ? $CurrentForm->getValue("max_bonus") : $CurrentForm->getValue("x_max_bonus");
        if (!$this->max_bonus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_bonus->Visible = false; // Disable update for API request
            } else {
                $this->max_bonus->setFormValue($val);
            }
        }

        // Check field name 'skor_training' first before field var 'x_skor_training'
        $val = $CurrentForm->hasValue("skor_training") ? $CurrentForm->getValue("skor_training") : $CurrentForm->getValue("x_skor_training");
        if (!$this->skor_training->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_training->Visible = false; // Disable update for API request
            } else {
                $this->skor_training->setFormValue($val);
            }
        }

        // Check field name 'max_training' first before field var 'x_max_training'
        $val = $CurrentForm->hasValue("max_training") ? $CurrentForm->getValue("max_training") : $CurrentForm->getValue("x_max_training");
        if (!$this->max_training->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_training->Visible = false; // Disable update for API request
            } else {
                $this->max_training->setFormValue($val);
            }
        }

        // Check field name 'skor_sdm' first before field var 'x_skor_sdm'
        $val = $CurrentForm->hasValue("skor_sdm") ? $CurrentForm->getValue("skor_sdm") : $CurrentForm->getValue("x_skor_sdm");
        if (!$this->skor_sdm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_sdm->Visible = false; // Disable update for API request
            } else {
                $this->skor_sdm->setFormValue($val);
            }
        }

        // Check field name 'maxskor_sdm' first before field var 'x_maxskor_sdm'
        $val = $CurrentForm->hasValue("maxskor_sdm") ? $CurrentForm->getValue("maxskor_sdm") : $CurrentForm->getValue("x_maxskor_sdm");
        if (!$this->maxskor_sdm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_sdm->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_sdm->setFormValue($val);
            }
        }

        // Check field name 'bobot_sdm' first before field var 'x_bobot_sdm'
        $val = $CurrentForm->hasValue("bobot_sdm") ? $CurrentForm->getValue("bobot_sdm") : $CurrentForm->getValue("x_bobot_sdm");
        if (!$this->bobot_sdm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_sdm->Visible = false; // Disable update for API request
            } else {
                $this->bobot_sdm->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->skor_oms->CurrentValue = $this->skor_oms->FormValue;
        $this->max_oms->CurrentValue = $this->max_oms->FormValue;
        $this->skor_fokus->CurrentValue = $this->skor_fokus->FormValue;
        $this->max_fokus->CurrentValue = $this->max_fokus->FormValue;
        $this->skor_target->CurrentValue = $this->skor_target->FormValue;
        $this->max_target->CurrentValue = $this->max_target->FormValue;
        $this->skor_karyawan->CurrentValue = $this->skor_karyawan->FormValue;
        $this->max_karyawan->CurrentValue = $this->max_karyawan->FormValue;
        $this->skor_outsource->CurrentValue = $this->skor_outsource->FormValue;
        $this->max_outsource->CurrentValue = $this->max_outsource->FormValue;
        $this->skor_besarangaji->CurrentValue = $this->skor_besarangaji->FormValue;
        $this->max_besarangaji->CurrentValue = $this->max_besarangaji->FormValue;
        $this->skor_asuransi->CurrentValue = $this->skor_asuransi->FormValue;
        $this->max_asuransi->CurrentValue = $this->max_asuransi->FormValue;
        $this->skor_bonus->CurrentValue = $this->skor_bonus->FormValue;
        $this->max_bonus->CurrentValue = $this->max_bonus->FormValue;
        $this->skor_training->CurrentValue = $this->skor_training->FormValue;
        $this->max_training->CurrentValue = $this->max_training->FormValue;
        $this->skor_sdm->CurrentValue = $this->skor_sdm->FormValue;
        $this->maxskor_sdm->CurrentValue = $this->maxskor_sdm->FormValue;
        $this->bobot_sdm->CurrentValue = $this->bobot_sdm->FormValue;
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
        $this->nik->setDbValue($row['nik']);
        $this->skor_oms->setDbValue($row['skor_oms']);
        $this->max_oms->setDbValue($row['max_oms']);
        $this->skor_fokus->setDbValue($row['skor_fokus']);
        $this->max_fokus->setDbValue($row['max_fokus']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_karyawan->setDbValue($row['skor_karyawan']);
        $this->max_karyawan->setDbValue($row['max_karyawan']);
        $this->skor_outsource->setDbValue($row['skor_outsource']);
        $this->max_outsource->setDbValue($row['max_outsource']);
        $this->skor_besarangaji->setDbValue($row['skor_besarangaji']);
        $this->max_besarangaji->setDbValue($row['max_besarangaji']);
        $this->skor_asuransi->setDbValue($row['skor_asuransi']);
        $this->max_asuransi->setDbValue($row['max_asuransi']);
        $this->skor_bonus->setDbValue($row['skor_bonus']);
        $this->max_bonus->setDbValue($row['max_bonus']);
        $this->skor_training->setDbValue($row['skor_training']);
        $this->max_training->setDbValue($row['max_training']);
        $this->skor_sdm->setDbValue($row['skor_sdm']);
        $this->maxskor_sdm->setDbValue($row['maxskor_sdm']);
        $this->bobot_sdm->setDbValue($row['bobot_sdm']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_oms'] = null;
        $row['max_oms'] = null;
        $row['skor_fokus'] = null;
        $row['max_fokus'] = null;
        $row['skor_target'] = null;
        $row['max_target'] = null;
        $row['skor_karyawan'] = null;
        $row['max_karyawan'] = null;
        $row['skor_outsource'] = null;
        $row['max_outsource'] = null;
        $row['skor_besarangaji'] = null;
        $row['max_besarangaji'] = null;
        $row['skor_asuransi'] = null;
        $row['max_asuransi'] = null;
        $row['skor_bonus'] = null;
        $row['max_bonus'] = null;
        $row['skor_training'] = null;
        $row['max_training'] = null;
        $row['skor_sdm'] = null;
        $row['maxskor_sdm'] = null;
        $row['bobot_sdm'] = null;
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

        // Convert decimal values if posted back
        if ($this->skor_oms->FormValue == $this->skor_oms->CurrentValue && is_numeric(ConvertToFloatString($this->skor_oms->CurrentValue))) {
            $this->skor_oms->CurrentValue = ConvertToFloatString($this->skor_oms->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_oms->FormValue == $this->max_oms->CurrentValue && is_numeric(ConvertToFloatString($this->max_oms->CurrentValue))) {
            $this->max_oms->CurrentValue = ConvertToFloatString($this->max_oms->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_fokus->FormValue == $this->skor_fokus->CurrentValue && is_numeric(ConvertToFloatString($this->skor_fokus->CurrentValue))) {
            $this->skor_fokus->CurrentValue = ConvertToFloatString($this->skor_fokus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_fokus->FormValue == $this->max_fokus->CurrentValue && is_numeric(ConvertToFloatString($this->max_fokus->CurrentValue))) {
            $this->max_fokus->CurrentValue = ConvertToFloatString($this->max_fokus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_target->FormValue == $this->skor_target->CurrentValue && is_numeric(ConvertToFloatString($this->skor_target->CurrentValue))) {
            $this->skor_target->CurrentValue = ConvertToFloatString($this->skor_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_target->FormValue == $this->max_target->CurrentValue && is_numeric(ConvertToFloatString($this->max_target->CurrentValue))) {
            $this->max_target->CurrentValue = ConvertToFloatString($this->max_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_karyawan->FormValue == $this->skor_karyawan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_karyawan->CurrentValue))) {
            $this->skor_karyawan->CurrentValue = ConvertToFloatString($this->skor_karyawan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_karyawan->FormValue == $this->max_karyawan->CurrentValue && is_numeric(ConvertToFloatString($this->max_karyawan->CurrentValue))) {
            $this->max_karyawan->CurrentValue = ConvertToFloatString($this->max_karyawan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_outsource->FormValue == $this->skor_outsource->CurrentValue && is_numeric(ConvertToFloatString($this->skor_outsource->CurrentValue))) {
            $this->skor_outsource->CurrentValue = ConvertToFloatString($this->skor_outsource->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_outsource->FormValue == $this->max_outsource->CurrentValue && is_numeric(ConvertToFloatString($this->max_outsource->CurrentValue))) {
            $this->max_outsource->CurrentValue = ConvertToFloatString($this->max_outsource->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_besarangaji->FormValue == $this->skor_besarangaji->CurrentValue && is_numeric(ConvertToFloatString($this->skor_besarangaji->CurrentValue))) {
            $this->skor_besarangaji->CurrentValue = ConvertToFloatString($this->skor_besarangaji->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_besarangaji->FormValue == $this->max_besarangaji->CurrentValue && is_numeric(ConvertToFloatString($this->max_besarangaji->CurrentValue))) {
            $this->max_besarangaji->CurrentValue = ConvertToFloatString($this->max_besarangaji->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_asuransi->FormValue == $this->skor_asuransi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_asuransi->CurrentValue))) {
            $this->skor_asuransi->CurrentValue = ConvertToFloatString($this->skor_asuransi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_asuransi->FormValue == $this->max_asuransi->CurrentValue && is_numeric(ConvertToFloatString($this->max_asuransi->CurrentValue))) {
            $this->max_asuransi->CurrentValue = ConvertToFloatString($this->max_asuransi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_bonus->FormValue == $this->skor_bonus->CurrentValue && is_numeric(ConvertToFloatString($this->skor_bonus->CurrentValue))) {
            $this->skor_bonus->CurrentValue = ConvertToFloatString($this->skor_bonus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_bonus->FormValue == $this->max_bonus->CurrentValue && is_numeric(ConvertToFloatString($this->max_bonus->CurrentValue))) {
            $this->max_bonus->CurrentValue = ConvertToFloatString($this->max_bonus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_training->FormValue == $this->skor_training->CurrentValue && is_numeric(ConvertToFloatString($this->skor_training->CurrentValue))) {
            $this->skor_training->CurrentValue = ConvertToFloatString($this->skor_training->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_training->FormValue == $this->max_training->CurrentValue && is_numeric(ConvertToFloatString($this->max_training->CurrentValue))) {
            $this->max_training->CurrentValue = ConvertToFloatString($this->max_training->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sdm->FormValue == $this->skor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sdm->CurrentValue))) {
            $this->skor_sdm->CurrentValue = ConvertToFloatString($this->skor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_sdm->FormValue == $this->maxskor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_sdm->CurrentValue))) {
            $this->maxskor_sdm->CurrentValue = ConvertToFloatString($this->maxskor_sdm->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_oms

        // max_oms

        // skor_fokus

        // max_fokus

        // skor_target

        // max_target

        // skor_karyawan

        // max_karyawan

        // skor_outsource

        // max_outsource

        // skor_besarangaji

        // max_besarangaji

        // skor_asuransi

        // max_asuransi

        // skor_bonus

        // max_bonus

        // skor_training

        // max_training

        // skor_sdm

        // maxskor_sdm

        // bobot_sdm
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_oms
            $this->skor_oms->ViewValue = $this->skor_oms->CurrentValue;
            $this->skor_oms->ViewValue = FormatNumber($this->skor_oms->ViewValue, 2, -2, -2, -2);
            $this->skor_oms->ViewCustomAttributes = "";

            // max_oms
            $this->max_oms->ViewValue = $this->max_oms->CurrentValue;
            $this->max_oms->ViewValue = FormatNumber($this->max_oms->ViewValue, 2, -2, -2, -2);
            $this->max_oms->ViewCustomAttributes = "";

            // skor_fokus
            $this->skor_fokus->ViewValue = $this->skor_fokus->CurrentValue;
            $this->skor_fokus->ViewValue = FormatNumber($this->skor_fokus->ViewValue, 2, -2, -2, -2);
            $this->skor_fokus->ViewCustomAttributes = "";

            // max_fokus
            $this->max_fokus->ViewValue = $this->max_fokus->CurrentValue;
            $this->max_fokus->ViewValue = FormatNumber($this->max_fokus->ViewValue, 2, -2, -2, -2);
            $this->max_fokus->ViewCustomAttributes = "";

            // skor_target
            $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
            $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
            $this->skor_target->ViewCustomAttributes = "";

            // max_target
            $this->max_target->ViewValue = $this->max_target->CurrentValue;
            $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
            $this->max_target->ViewCustomAttributes = "";

            // skor_karyawan
            $this->skor_karyawan->ViewValue = $this->skor_karyawan->CurrentValue;
            $this->skor_karyawan->ViewValue = FormatNumber($this->skor_karyawan->ViewValue, 2, -2, -2, -2);
            $this->skor_karyawan->ViewCustomAttributes = "";

            // max_karyawan
            $this->max_karyawan->ViewValue = $this->max_karyawan->CurrentValue;
            $this->max_karyawan->ViewValue = FormatNumber($this->max_karyawan->ViewValue, 2, -2, -2, -2);
            $this->max_karyawan->ViewCustomAttributes = "";

            // skor_outsource
            $this->skor_outsource->ViewValue = $this->skor_outsource->CurrentValue;
            $this->skor_outsource->ViewValue = FormatNumber($this->skor_outsource->ViewValue, 2, -2, -2, -2);
            $this->skor_outsource->ViewCustomAttributes = "";

            // max_outsource
            $this->max_outsource->ViewValue = $this->max_outsource->CurrentValue;
            $this->max_outsource->ViewValue = FormatNumber($this->max_outsource->ViewValue, 2, -2, -2, -2);
            $this->max_outsource->ViewCustomAttributes = "";

            // skor_besarangaji
            $this->skor_besarangaji->ViewValue = $this->skor_besarangaji->CurrentValue;
            $this->skor_besarangaji->ViewValue = FormatNumber($this->skor_besarangaji->ViewValue, 2, -2, -2, -2);
            $this->skor_besarangaji->ViewCustomAttributes = "";

            // max_besarangaji
            $this->max_besarangaji->ViewValue = $this->max_besarangaji->CurrentValue;
            $this->max_besarangaji->ViewValue = FormatNumber($this->max_besarangaji->ViewValue, 2, -2, -2, -2);
            $this->max_besarangaji->ViewCustomAttributes = "";

            // skor_asuransi
            $this->skor_asuransi->ViewValue = $this->skor_asuransi->CurrentValue;
            $this->skor_asuransi->ViewValue = FormatNumber($this->skor_asuransi->ViewValue, 2, -2, -2, -2);
            $this->skor_asuransi->ViewCustomAttributes = "";

            // max_asuransi
            $this->max_asuransi->ViewValue = $this->max_asuransi->CurrentValue;
            $this->max_asuransi->ViewValue = FormatNumber($this->max_asuransi->ViewValue, 2, -2, -2, -2);
            $this->max_asuransi->ViewCustomAttributes = "";

            // skor_bonus
            $this->skor_bonus->ViewValue = $this->skor_bonus->CurrentValue;
            $this->skor_bonus->ViewValue = FormatNumber($this->skor_bonus->ViewValue, 2, -2, -2, -2);
            $this->skor_bonus->ViewCustomAttributes = "";

            // max_bonus
            $this->max_bonus->ViewValue = $this->max_bonus->CurrentValue;
            $this->max_bonus->ViewValue = FormatNumber($this->max_bonus->ViewValue, 2, -2, -2, -2);
            $this->max_bonus->ViewCustomAttributes = "";

            // skor_training
            $this->skor_training->ViewValue = $this->skor_training->CurrentValue;
            $this->skor_training->ViewValue = FormatNumber($this->skor_training->ViewValue, 2, -2, -2, -2);
            $this->skor_training->ViewCustomAttributes = "";

            // max_training
            $this->max_training->ViewValue = $this->max_training->CurrentValue;
            $this->max_training->ViewValue = FormatNumber($this->max_training->ViewValue, 2, -2, -2, -2);
            $this->max_training->ViewCustomAttributes = "";

            // skor_sdm
            $this->skor_sdm->ViewValue = $this->skor_sdm->CurrentValue;
            $this->skor_sdm->ViewValue = FormatNumber($this->skor_sdm->ViewValue, 2, -2, -2, -2);
            $this->skor_sdm->ViewCustomAttributes = "";

            // maxskor_sdm
            $this->maxskor_sdm->ViewValue = $this->maxskor_sdm->CurrentValue;
            $this->maxskor_sdm->ViewValue = FormatNumber($this->maxskor_sdm->ViewValue, 2, -2, -2, -2);
            $this->maxskor_sdm->ViewCustomAttributes = "";

            // bobot_sdm
            $this->bobot_sdm->ViewValue = $this->bobot_sdm->CurrentValue;
            $this->bobot_sdm->ViewValue = FormatNumber($this->bobot_sdm->ViewValue, 0, -2, -2, -2);
            $this->bobot_sdm->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_oms
            $this->skor_oms->LinkCustomAttributes = "";
            $this->skor_oms->HrefValue = "";
            $this->skor_oms->TooltipValue = "";

            // max_oms
            $this->max_oms->LinkCustomAttributes = "";
            $this->max_oms->HrefValue = "";
            $this->max_oms->TooltipValue = "";

            // skor_fokus
            $this->skor_fokus->LinkCustomAttributes = "";
            $this->skor_fokus->HrefValue = "";
            $this->skor_fokus->TooltipValue = "";

            // max_fokus
            $this->max_fokus->LinkCustomAttributes = "";
            $this->max_fokus->HrefValue = "";
            $this->max_fokus->TooltipValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";
            $this->skor_target->TooltipValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";
            $this->max_target->TooltipValue = "";

            // skor_karyawan
            $this->skor_karyawan->LinkCustomAttributes = "";
            $this->skor_karyawan->HrefValue = "";
            $this->skor_karyawan->TooltipValue = "";

            // max_karyawan
            $this->max_karyawan->LinkCustomAttributes = "";
            $this->max_karyawan->HrefValue = "";
            $this->max_karyawan->TooltipValue = "";

            // skor_outsource
            $this->skor_outsource->LinkCustomAttributes = "";
            $this->skor_outsource->HrefValue = "";
            $this->skor_outsource->TooltipValue = "";

            // max_outsource
            $this->max_outsource->LinkCustomAttributes = "";
            $this->max_outsource->HrefValue = "";
            $this->max_outsource->TooltipValue = "";

            // skor_besarangaji
            $this->skor_besarangaji->LinkCustomAttributes = "";
            $this->skor_besarangaji->HrefValue = "";
            $this->skor_besarangaji->TooltipValue = "";

            // max_besarangaji
            $this->max_besarangaji->LinkCustomAttributes = "";
            $this->max_besarangaji->HrefValue = "";
            $this->max_besarangaji->TooltipValue = "";

            // skor_asuransi
            $this->skor_asuransi->LinkCustomAttributes = "";
            $this->skor_asuransi->HrefValue = "";
            $this->skor_asuransi->TooltipValue = "";

            // max_asuransi
            $this->max_asuransi->LinkCustomAttributes = "";
            $this->max_asuransi->HrefValue = "";
            $this->max_asuransi->TooltipValue = "";

            // skor_bonus
            $this->skor_bonus->LinkCustomAttributes = "";
            $this->skor_bonus->HrefValue = "";
            $this->skor_bonus->TooltipValue = "";

            // max_bonus
            $this->max_bonus->LinkCustomAttributes = "";
            $this->max_bonus->HrefValue = "";
            $this->max_bonus->TooltipValue = "";

            // skor_training
            $this->skor_training->LinkCustomAttributes = "";
            $this->skor_training->HrefValue = "";
            $this->skor_training->TooltipValue = "";

            // max_training
            $this->max_training->LinkCustomAttributes = "";
            $this->max_training->HrefValue = "";
            $this->max_training->TooltipValue = "";

            // skor_sdm
            $this->skor_sdm->LinkCustomAttributes = "";
            $this->skor_sdm->HrefValue = "";
            $this->skor_sdm->TooltipValue = "";

            // maxskor_sdm
            $this->maxskor_sdm->LinkCustomAttributes = "";
            $this->maxskor_sdm->HrefValue = "";
            $this->maxskor_sdm->TooltipValue = "";

            // bobot_sdm
            $this->bobot_sdm->LinkCustomAttributes = "";
            $this->bobot_sdm->HrefValue = "";
            $this->bobot_sdm->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // skor_oms
            $this->skor_oms->EditAttrs["class"] = "form-control";
            $this->skor_oms->EditCustomAttributes = "";
            $this->skor_oms->EditValue = HtmlEncode($this->skor_oms->CurrentValue);
            $this->skor_oms->PlaceHolder = RemoveHtml($this->skor_oms->caption());
            if (strval($this->skor_oms->EditValue) != "" && is_numeric($this->skor_oms->EditValue)) {
                $this->skor_oms->EditValue = FormatNumber($this->skor_oms->EditValue, -2, -2, -2, -2);
            }

            // max_oms
            $this->max_oms->EditAttrs["class"] = "form-control";
            $this->max_oms->EditCustomAttributes = "";
            $this->max_oms->EditValue = HtmlEncode($this->max_oms->CurrentValue);
            $this->max_oms->PlaceHolder = RemoveHtml($this->max_oms->caption());
            if (strval($this->max_oms->EditValue) != "" && is_numeric($this->max_oms->EditValue)) {
                $this->max_oms->EditValue = FormatNumber($this->max_oms->EditValue, -2, -2, -2, -2);
            }

            // skor_fokus
            $this->skor_fokus->EditAttrs["class"] = "form-control";
            $this->skor_fokus->EditCustomAttributes = "";
            $this->skor_fokus->EditValue = HtmlEncode($this->skor_fokus->CurrentValue);
            $this->skor_fokus->PlaceHolder = RemoveHtml($this->skor_fokus->caption());
            if (strval($this->skor_fokus->EditValue) != "" && is_numeric($this->skor_fokus->EditValue)) {
                $this->skor_fokus->EditValue = FormatNumber($this->skor_fokus->EditValue, -2, -2, -2, -2);
            }

            // max_fokus
            $this->max_fokus->EditAttrs["class"] = "form-control";
            $this->max_fokus->EditCustomAttributes = "";
            $this->max_fokus->EditValue = HtmlEncode($this->max_fokus->CurrentValue);
            $this->max_fokus->PlaceHolder = RemoveHtml($this->max_fokus->caption());
            if (strval($this->max_fokus->EditValue) != "" && is_numeric($this->max_fokus->EditValue)) {
                $this->max_fokus->EditValue = FormatNumber($this->max_fokus->EditValue, -2, -2, -2, -2);
            }

            // skor_target
            $this->skor_target->EditAttrs["class"] = "form-control";
            $this->skor_target->EditCustomAttributes = "";
            $this->skor_target->EditValue = HtmlEncode($this->skor_target->CurrentValue);
            $this->skor_target->PlaceHolder = RemoveHtml($this->skor_target->caption());
            if (strval($this->skor_target->EditValue) != "" && is_numeric($this->skor_target->EditValue)) {
                $this->skor_target->EditValue = FormatNumber($this->skor_target->EditValue, -2, -2, -2, -2);
            }

            // max_target
            $this->max_target->EditAttrs["class"] = "form-control";
            $this->max_target->EditCustomAttributes = "";
            $this->max_target->EditValue = HtmlEncode($this->max_target->CurrentValue);
            $this->max_target->PlaceHolder = RemoveHtml($this->max_target->caption());
            if (strval($this->max_target->EditValue) != "" && is_numeric($this->max_target->EditValue)) {
                $this->max_target->EditValue = FormatNumber($this->max_target->EditValue, -2, -2, -2, -2);
            }

            // skor_karyawan
            $this->skor_karyawan->EditAttrs["class"] = "form-control";
            $this->skor_karyawan->EditCustomAttributes = "";
            $this->skor_karyawan->EditValue = HtmlEncode($this->skor_karyawan->CurrentValue);
            $this->skor_karyawan->PlaceHolder = RemoveHtml($this->skor_karyawan->caption());
            if (strval($this->skor_karyawan->EditValue) != "" && is_numeric($this->skor_karyawan->EditValue)) {
                $this->skor_karyawan->EditValue = FormatNumber($this->skor_karyawan->EditValue, -2, -2, -2, -2);
            }

            // max_karyawan
            $this->max_karyawan->EditAttrs["class"] = "form-control";
            $this->max_karyawan->EditCustomAttributes = "";
            $this->max_karyawan->EditValue = HtmlEncode($this->max_karyawan->CurrentValue);
            $this->max_karyawan->PlaceHolder = RemoveHtml($this->max_karyawan->caption());
            if (strval($this->max_karyawan->EditValue) != "" && is_numeric($this->max_karyawan->EditValue)) {
                $this->max_karyawan->EditValue = FormatNumber($this->max_karyawan->EditValue, -2, -2, -2, -2);
            }

            // skor_outsource
            $this->skor_outsource->EditAttrs["class"] = "form-control";
            $this->skor_outsource->EditCustomAttributes = "";
            $this->skor_outsource->EditValue = HtmlEncode($this->skor_outsource->CurrentValue);
            $this->skor_outsource->PlaceHolder = RemoveHtml($this->skor_outsource->caption());
            if (strval($this->skor_outsource->EditValue) != "" && is_numeric($this->skor_outsource->EditValue)) {
                $this->skor_outsource->EditValue = FormatNumber($this->skor_outsource->EditValue, -2, -2, -2, -2);
            }

            // max_outsource
            $this->max_outsource->EditAttrs["class"] = "form-control";
            $this->max_outsource->EditCustomAttributes = "";
            $this->max_outsource->EditValue = HtmlEncode($this->max_outsource->CurrentValue);
            $this->max_outsource->PlaceHolder = RemoveHtml($this->max_outsource->caption());
            if (strval($this->max_outsource->EditValue) != "" && is_numeric($this->max_outsource->EditValue)) {
                $this->max_outsource->EditValue = FormatNumber($this->max_outsource->EditValue, -2, -2, -2, -2);
            }

            // skor_besarangaji
            $this->skor_besarangaji->EditAttrs["class"] = "form-control";
            $this->skor_besarangaji->EditCustomAttributes = "";
            $this->skor_besarangaji->EditValue = HtmlEncode($this->skor_besarangaji->CurrentValue);
            $this->skor_besarangaji->PlaceHolder = RemoveHtml($this->skor_besarangaji->caption());
            if (strval($this->skor_besarangaji->EditValue) != "" && is_numeric($this->skor_besarangaji->EditValue)) {
                $this->skor_besarangaji->EditValue = FormatNumber($this->skor_besarangaji->EditValue, -2, -2, -2, -2);
            }

            // max_besarangaji
            $this->max_besarangaji->EditAttrs["class"] = "form-control";
            $this->max_besarangaji->EditCustomAttributes = "";
            $this->max_besarangaji->EditValue = HtmlEncode($this->max_besarangaji->CurrentValue);
            $this->max_besarangaji->PlaceHolder = RemoveHtml($this->max_besarangaji->caption());
            if (strval($this->max_besarangaji->EditValue) != "" && is_numeric($this->max_besarangaji->EditValue)) {
                $this->max_besarangaji->EditValue = FormatNumber($this->max_besarangaji->EditValue, -2, -2, -2, -2);
            }

            // skor_asuransi
            $this->skor_asuransi->EditAttrs["class"] = "form-control";
            $this->skor_asuransi->EditCustomAttributes = "";
            $this->skor_asuransi->EditValue = HtmlEncode($this->skor_asuransi->CurrentValue);
            $this->skor_asuransi->PlaceHolder = RemoveHtml($this->skor_asuransi->caption());
            if (strval($this->skor_asuransi->EditValue) != "" && is_numeric($this->skor_asuransi->EditValue)) {
                $this->skor_asuransi->EditValue = FormatNumber($this->skor_asuransi->EditValue, -2, -2, -2, -2);
            }

            // max_asuransi
            $this->max_asuransi->EditAttrs["class"] = "form-control";
            $this->max_asuransi->EditCustomAttributes = "";
            $this->max_asuransi->EditValue = HtmlEncode($this->max_asuransi->CurrentValue);
            $this->max_asuransi->PlaceHolder = RemoveHtml($this->max_asuransi->caption());
            if (strval($this->max_asuransi->EditValue) != "" && is_numeric($this->max_asuransi->EditValue)) {
                $this->max_asuransi->EditValue = FormatNumber($this->max_asuransi->EditValue, -2, -2, -2, -2);
            }

            // skor_bonus
            $this->skor_bonus->EditAttrs["class"] = "form-control";
            $this->skor_bonus->EditCustomAttributes = "";
            $this->skor_bonus->EditValue = HtmlEncode($this->skor_bonus->CurrentValue);
            $this->skor_bonus->PlaceHolder = RemoveHtml($this->skor_bonus->caption());
            if (strval($this->skor_bonus->EditValue) != "" && is_numeric($this->skor_bonus->EditValue)) {
                $this->skor_bonus->EditValue = FormatNumber($this->skor_bonus->EditValue, -2, -2, -2, -2);
            }

            // max_bonus
            $this->max_bonus->EditAttrs["class"] = "form-control";
            $this->max_bonus->EditCustomAttributes = "";
            $this->max_bonus->EditValue = HtmlEncode($this->max_bonus->CurrentValue);
            $this->max_bonus->PlaceHolder = RemoveHtml($this->max_bonus->caption());
            if (strval($this->max_bonus->EditValue) != "" && is_numeric($this->max_bonus->EditValue)) {
                $this->max_bonus->EditValue = FormatNumber($this->max_bonus->EditValue, -2, -2, -2, -2);
            }

            // skor_training
            $this->skor_training->EditAttrs["class"] = "form-control";
            $this->skor_training->EditCustomAttributes = "";
            $this->skor_training->EditValue = HtmlEncode($this->skor_training->CurrentValue);
            $this->skor_training->PlaceHolder = RemoveHtml($this->skor_training->caption());
            if (strval($this->skor_training->EditValue) != "" && is_numeric($this->skor_training->EditValue)) {
                $this->skor_training->EditValue = FormatNumber($this->skor_training->EditValue, -2, -2, -2, -2);
            }

            // max_training
            $this->max_training->EditAttrs["class"] = "form-control";
            $this->max_training->EditCustomAttributes = "";
            $this->max_training->EditValue = HtmlEncode($this->max_training->CurrentValue);
            $this->max_training->PlaceHolder = RemoveHtml($this->max_training->caption());
            if (strval($this->max_training->EditValue) != "" && is_numeric($this->max_training->EditValue)) {
                $this->max_training->EditValue = FormatNumber($this->max_training->EditValue, -2, -2, -2, -2);
            }

            // skor_sdm
            $this->skor_sdm->EditAttrs["class"] = "form-control";
            $this->skor_sdm->EditCustomAttributes = "";
            $this->skor_sdm->EditValue = HtmlEncode($this->skor_sdm->CurrentValue);
            $this->skor_sdm->PlaceHolder = RemoveHtml($this->skor_sdm->caption());
            if (strval($this->skor_sdm->EditValue) != "" && is_numeric($this->skor_sdm->EditValue)) {
                $this->skor_sdm->EditValue = FormatNumber($this->skor_sdm->EditValue, -2, -2, -2, -2);
            }

            // maxskor_sdm
            $this->maxskor_sdm->EditAttrs["class"] = "form-control";
            $this->maxskor_sdm->EditCustomAttributes = "";
            $this->maxskor_sdm->EditValue = HtmlEncode($this->maxskor_sdm->CurrentValue);
            $this->maxskor_sdm->PlaceHolder = RemoveHtml($this->maxskor_sdm->caption());
            if (strval($this->maxskor_sdm->EditValue) != "" && is_numeric($this->maxskor_sdm->EditValue)) {
                $this->maxskor_sdm->EditValue = FormatNumber($this->maxskor_sdm->EditValue, -2, -2, -2, -2);
            }

            // bobot_sdm
            $this->bobot_sdm->EditAttrs["class"] = "form-control";
            $this->bobot_sdm->EditCustomAttributes = "";
            $this->bobot_sdm->EditValue = HtmlEncode($this->bobot_sdm->CurrentValue);
            $this->bobot_sdm->PlaceHolder = RemoveHtml($this->bobot_sdm->caption());

            // Edit refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // skor_oms
            $this->skor_oms->LinkCustomAttributes = "";
            $this->skor_oms->HrefValue = "";

            // max_oms
            $this->max_oms->LinkCustomAttributes = "";
            $this->max_oms->HrefValue = "";

            // skor_fokus
            $this->skor_fokus->LinkCustomAttributes = "";
            $this->skor_fokus->HrefValue = "";

            // max_fokus
            $this->max_fokus->LinkCustomAttributes = "";
            $this->max_fokus->HrefValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";

            // skor_karyawan
            $this->skor_karyawan->LinkCustomAttributes = "";
            $this->skor_karyawan->HrefValue = "";

            // max_karyawan
            $this->max_karyawan->LinkCustomAttributes = "";
            $this->max_karyawan->HrefValue = "";

            // skor_outsource
            $this->skor_outsource->LinkCustomAttributes = "";
            $this->skor_outsource->HrefValue = "";

            // max_outsource
            $this->max_outsource->LinkCustomAttributes = "";
            $this->max_outsource->HrefValue = "";

            // skor_besarangaji
            $this->skor_besarangaji->LinkCustomAttributes = "";
            $this->skor_besarangaji->HrefValue = "";

            // max_besarangaji
            $this->max_besarangaji->LinkCustomAttributes = "";
            $this->max_besarangaji->HrefValue = "";

            // skor_asuransi
            $this->skor_asuransi->LinkCustomAttributes = "";
            $this->skor_asuransi->HrefValue = "";

            // max_asuransi
            $this->max_asuransi->LinkCustomAttributes = "";
            $this->max_asuransi->HrefValue = "";

            // skor_bonus
            $this->skor_bonus->LinkCustomAttributes = "";
            $this->skor_bonus->HrefValue = "";

            // max_bonus
            $this->max_bonus->LinkCustomAttributes = "";
            $this->max_bonus->HrefValue = "";

            // skor_training
            $this->skor_training->LinkCustomAttributes = "";
            $this->skor_training->HrefValue = "";

            // max_training
            $this->max_training->LinkCustomAttributes = "";
            $this->max_training->HrefValue = "";

            // skor_sdm
            $this->skor_sdm->LinkCustomAttributes = "";
            $this->skor_sdm->HrefValue = "";

            // maxskor_sdm
            $this->maxskor_sdm->LinkCustomAttributes = "";
            $this->maxskor_sdm->HrefValue = "";

            // bobot_sdm
            $this->bobot_sdm->LinkCustomAttributes = "";
            $this->bobot_sdm->HrefValue = "";
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
        if ($this->nik->Required) {
            if (!$this->nik->IsDetailKey && EmptyValue($this->nik->FormValue)) {
                $this->nik->addErrorMessage(str_replace("%s", $this->nik->caption(), $this->nik->RequiredErrorMessage));
            }
        }
        if ($this->skor_oms->Required) {
            if (!$this->skor_oms->IsDetailKey && EmptyValue($this->skor_oms->FormValue)) {
                $this->skor_oms->addErrorMessage(str_replace("%s", $this->skor_oms->caption(), $this->skor_oms->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_oms->FormValue)) {
            $this->skor_oms->addErrorMessage($this->skor_oms->getErrorMessage(false));
        }
        if ($this->max_oms->Required) {
            if (!$this->max_oms->IsDetailKey && EmptyValue($this->max_oms->FormValue)) {
                $this->max_oms->addErrorMessage(str_replace("%s", $this->max_oms->caption(), $this->max_oms->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_oms->FormValue)) {
            $this->max_oms->addErrorMessage($this->max_oms->getErrorMessage(false));
        }
        if ($this->skor_fokus->Required) {
            if (!$this->skor_fokus->IsDetailKey && EmptyValue($this->skor_fokus->FormValue)) {
                $this->skor_fokus->addErrorMessage(str_replace("%s", $this->skor_fokus->caption(), $this->skor_fokus->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_fokus->FormValue)) {
            $this->skor_fokus->addErrorMessage($this->skor_fokus->getErrorMessage(false));
        }
        if ($this->max_fokus->Required) {
            if (!$this->max_fokus->IsDetailKey && EmptyValue($this->max_fokus->FormValue)) {
                $this->max_fokus->addErrorMessage(str_replace("%s", $this->max_fokus->caption(), $this->max_fokus->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_fokus->FormValue)) {
            $this->max_fokus->addErrorMessage($this->max_fokus->getErrorMessage(false));
        }
        if ($this->skor_target->Required) {
            if (!$this->skor_target->IsDetailKey && EmptyValue($this->skor_target->FormValue)) {
                $this->skor_target->addErrorMessage(str_replace("%s", $this->skor_target->caption(), $this->skor_target->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_target->FormValue)) {
            $this->skor_target->addErrorMessage($this->skor_target->getErrorMessage(false));
        }
        if ($this->max_target->Required) {
            if (!$this->max_target->IsDetailKey && EmptyValue($this->max_target->FormValue)) {
                $this->max_target->addErrorMessage(str_replace("%s", $this->max_target->caption(), $this->max_target->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_target->FormValue)) {
            $this->max_target->addErrorMessage($this->max_target->getErrorMessage(false));
        }
        if ($this->skor_karyawan->Required) {
            if (!$this->skor_karyawan->IsDetailKey && EmptyValue($this->skor_karyawan->FormValue)) {
                $this->skor_karyawan->addErrorMessage(str_replace("%s", $this->skor_karyawan->caption(), $this->skor_karyawan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_karyawan->FormValue)) {
            $this->skor_karyawan->addErrorMessage($this->skor_karyawan->getErrorMessage(false));
        }
        if ($this->max_karyawan->Required) {
            if (!$this->max_karyawan->IsDetailKey && EmptyValue($this->max_karyawan->FormValue)) {
                $this->max_karyawan->addErrorMessage(str_replace("%s", $this->max_karyawan->caption(), $this->max_karyawan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_karyawan->FormValue)) {
            $this->max_karyawan->addErrorMessage($this->max_karyawan->getErrorMessage(false));
        }
        if ($this->skor_outsource->Required) {
            if (!$this->skor_outsource->IsDetailKey && EmptyValue($this->skor_outsource->FormValue)) {
                $this->skor_outsource->addErrorMessage(str_replace("%s", $this->skor_outsource->caption(), $this->skor_outsource->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_outsource->FormValue)) {
            $this->skor_outsource->addErrorMessage($this->skor_outsource->getErrorMessage(false));
        }
        if ($this->max_outsource->Required) {
            if (!$this->max_outsource->IsDetailKey && EmptyValue($this->max_outsource->FormValue)) {
                $this->max_outsource->addErrorMessage(str_replace("%s", $this->max_outsource->caption(), $this->max_outsource->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_outsource->FormValue)) {
            $this->max_outsource->addErrorMessage($this->max_outsource->getErrorMessage(false));
        }
        if ($this->skor_besarangaji->Required) {
            if (!$this->skor_besarangaji->IsDetailKey && EmptyValue($this->skor_besarangaji->FormValue)) {
                $this->skor_besarangaji->addErrorMessage(str_replace("%s", $this->skor_besarangaji->caption(), $this->skor_besarangaji->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_besarangaji->FormValue)) {
            $this->skor_besarangaji->addErrorMessage($this->skor_besarangaji->getErrorMessage(false));
        }
        if ($this->max_besarangaji->Required) {
            if (!$this->max_besarangaji->IsDetailKey && EmptyValue($this->max_besarangaji->FormValue)) {
                $this->max_besarangaji->addErrorMessage(str_replace("%s", $this->max_besarangaji->caption(), $this->max_besarangaji->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_besarangaji->FormValue)) {
            $this->max_besarangaji->addErrorMessage($this->max_besarangaji->getErrorMessage(false));
        }
        if ($this->skor_asuransi->Required) {
            if (!$this->skor_asuransi->IsDetailKey && EmptyValue($this->skor_asuransi->FormValue)) {
                $this->skor_asuransi->addErrorMessage(str_replace("%s", $this->skor_asuransi->caption(), $this->skor_asuransi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_asuransi->FormValue)) {
            $this->skor_asuransi->addErrorMessage($this->skor_asuransi->getErrorMessage(false));
        }
        if ($this->max_asuransi->Required) {
            if (!$this->max_asuransi->IsDetailKey && EmptyValue($this->max_asuransi->FormValue)) {
                $this->max_asuransi->addErrorMessage(str_replace("%s", $this->max_asuransi->caption(), $this->max_asuransi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_asuransi->FormValue)) {
            $this->max_asuransi->addErrorMessage($this->max_asuransi->getErrorMessage(false));
        }
        if ($this->skor_bonus->Required) {
            if (!$this->skor_bonus->IsDetailKey && EmptyValue($this->skor_bonus->FormValue)) {
                $this->skor_bonus->addErrorMessage(str_replace("%s", $this->skor_bonus->caption(), $this->skor_bonus->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_bonus->FormValue)) {
            $this->skor_bonus->addErrorMessage($this->skor_bonus->getErrorMessage(false));
        }
        if ($this->max_bonus->Required) {
            if (!$this->max_bonus->IsDetailKey && EmptyValue($this->max_bonus->FormValue)) {
                $this->max_bonus->addErrorMessage(str_replace("%s", $this->max_bonus->caption(), $this->max_bonus->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_bonus->FormValue)) {
            $this->max_bonus->addErrorMessage($this->max_bonus->getErrorMessage(false));
        }
        if ($this->skor_training->Required) {
            if (!$this->skor_training->IsDetailKey && EmptyValue($this->skor_training->FormValue)) {
                $this->skor_training->addErrorMessage(str_replace("%s", $this->skor_training->caption(), $this->skor_training->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_training->FormValue)) {
            $this->skor_training->addErrorMessage($this->skor_training->getErrorMessage(false));
        }
        if ($this->max_training->Required) {
            if (!$this->max_training->IsDetailKey && EmptyValue($this->max_training->FormValue)) {
                $this->max_training->addErrorMessage(str_replace("%s", $this->max_training->caption(), $this->max_training->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_training->FormValue)) {
            $this->max_training->addErrorMessage($this->max_training->getErrorMessage(false));
        }
        if ($this->skor_sdm->Required) {
            if (!$this->skor_sdm->IsDetailKey && EmptyValue($this->skor_sdm->FormValue)) {
                $this->skor_sdm->addErrorMessage(str_replace("%s", $this->skor_sdm->caption(), $this->skor_sdm->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_sdm->FormValue)) {
            $this->skor_sdm->addErrorMessage($this->skor_sdm->getErrorMessage(false));
        }
        if ($this->maxskor_sdm->Required) {
            if (!$this->maxskor_sdm->IsDetailKey && EmptyValue($this->maxskor_sdm->FormValue)) {
                $this->maxskor_sdm->addErrorMessage(str_replace("%s", $this->maxskor_sdm->caption(), $this->maxskor_sdm->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_sdm->FormValue)) {
            $this->maxskor_sdm->addErrorMessage($this->maxskor_sdm->getErrorMessage(false));
        }
        if ($this->bobot_sdm->Required) {
            if (!$this->bobot_sdm->IsDetailKey && EmptyValue($this->bobot_sdm->FormValue)) {
                $this->bobot_sdm->addErrorMessage(str_replace("%s", $this->bobot_sdm->caption(), $this->bobot_sdm->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_sdm->FormValue)) {
            $this->bobot_sdm->addErrorMessage($this->bobot_sdm->getErrorMessage(false));
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

            // nik
            $this->nik->setDbValueDef($rsnew, $this->nik->CurrentValue, "", $this->nik->ReadOnly);

            // skor_oms
            $this->skor_oms->setDbValueDef($rsnew, $this->skor_oms->CurrentValue, null, $this->skor_oms->ReadOnly);

            // max_oms
            $this->max_oms->setDbValueDef($rsnew, $this->max_oms->CurrentValue, null, $this->max_oms->ReadOnly);

            // skor_fokus
            $this->skor_fokus->setDbValueDef($rsnew, $this->skor_fokus->CurrentValue, null, $this->skor_fokus->ReadOnly);

            // max_fokus
            $this->max_fokus->setDbValueDef($rsnew, $this->max_fokus->CurrentValue, null, $this->max_fokus->ReadOnly);

            // skor_target
            $this->skor_target->setDbValueDef($rsnew, $this->skor_target->CurrentValue, null, $this->skor_target->ReadOnly);

            // max_target
            $this->max_target->setDbValueDef($rsnew, $this->max_target->CurrentValue, null, $this->max_target->ReadOnly);

            // skor_karyawan
            $this->skor_karyawan->setDbValueDef($rsnew, $this->skor_karyawan->CurrentValue, null, $this->skor_karyawan->ReadOnly);

            // max_karyawan
            $this->max_karyawan->setDbValueDef($rsnew, $this->max_karyawan->CurrentValue, null, $this->max_karyawan->ReadOnly);

            // skor_outsource
            $this->skor_outsource->setDbValueDef($rsnew, $this->skor_outsource->CurrentValue, null, $this->skor_outsource->ReadOnly);

            // max_outsource
            $this->max_outsource->setDbValueDef($rsnew, $this->max_outsource->CurrentValue, null, $this->max_outsource->ReadOnly);

            // skor_besarangaji
            $this->skor_besarangaji->setDbValueDef($rsnew, $this->skor_besarangaji->CurrentValue, null, $this->skor_besarangaji->ReadOnly);

            // max_besarangaji
            $this->max_besarangaji->setDbValueDef($rsnew, $this->max_besarangaji->CurrentValue, null, $this->max_besarangaji->ReadOnly);

            // skor_asuransi
            $this->skor_asuransi->setDbValueDef($rsnew, $this->skor_asuransi->CurrentValue, null, $this->skor_asuransi->ReadOnly);

            // max_asuransi
            $this->max_asuransi->setDbValueDef($rsnew, $this->max_asuransi->CurrentValue, null, $this->max_asuransi->ReadOnly);

            // skor_bonus
            $this->skor_bonus->setDbValueDef($rsnew, $this->skor_bonus->CurrentValue, null, $this->skor_bonus->ReadOnly);

            // max_bonus
            $this->max_bonus->setDbValueDef($rsnew, $this->max_bonus->CurrentValue, null, $this->max_bonus->ReadOnly);

            // skor_training
            $this->skor_training->setDbValueDef($rsnew, $this->skor_training->CurrentValue, null, $this->skor_training->ReadOnly);

            // max_training
            $this->max_training->setDbValueDef($rsnew, $this->max_training->CurrentValue, null, $this->max_training->ReadOnly);

            // skor_sdm
            $this->skor_sdm->setDbValueDef($rsnew, $this->skor_sdm->CurrentValue, null, $this->skor_sdm->ReadOnly);

            // maxskor_sdm
            $this->maxskor_sdm->setDbValueDef($rsnew, $this->maxskor_sdm->CurrentValue, null, $this->maxskor_sdm->ReadOnly);

            // bobot_sdm
            $this->bobot_sdm->setDbValueDef($rsnew, $this->bobot_sdm->CurrentValue, 0, $this->bobot_sdm->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorsdmlist"), "", $this->TableVar, true);
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
