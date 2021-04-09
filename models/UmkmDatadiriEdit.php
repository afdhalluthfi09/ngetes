<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmDatadiriEdit extends UmkmDatadiri
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_datadiri';

    // Page object name
    public $PageObjName = "UmkmDatadiriEdit";

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

        // Table object (umkm_datadiri)
        if (!isset($GLOBALS["umkm_datadiri"]) || get_class($GLOBALS["umkm_datadiri"]) == PROJECT_NAMESPACE . "umkm_datadiri") {
            $GLOBALS["umkm_datadiri"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_datadiri');
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
                $doc = new $class(Container("umkm_datadiri"));
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
                    if ($pageName == "umkmdatadiriview") {
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
        $this->NAMA_PEMILIK->setVisibility();
        $this->JENIS_KELAMIN->setVisibility();
        $this->NO_HP->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->KAPANEWON->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->DUSUN->setVisibility();
        $this->_PASSWORD->Visible = false;
        $this->_EMAIL->setVisibility();
        $this->AKTIVASI->Visible = false;
        $this->PROFIL->Visible = false;
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
        $this->setupLookupOptions($this->KAPANEWON);
        $this->setupLookupOptions($this->KALURAHAN);

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

            // Set up detail parameters
            $this->setupDetailParms();
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
                    $this->terminate("umkmdatadirilist"); // No matching record, return to list
                    return;
                }

                // Set up detail parameters
                $this->setupDetailParms();
                break;
            case "update": // Update
                if ($this->getCurrentDetailTable() != "") { // Master/detail edit
                    $returnUrl = $this->getViewUrl(Config("TABLE_SHOW_DETAIL") . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
                } else {
                    $returnUrl = $this->getReturnUrl();
                }
                if (GetPageName($returnUrl) == "umkmdatadirilist") {
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

                    // Set up detail parameters
                    $this->setupDetailParms();
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

        // Check field name 'NAMA_PEMILIK' first before field var 'x_NAMA_PEMILIK'
        $val = $CurrentForm->hasValue("NAMA_PEMILIK") ? $CurrentForm->getValue("NAMA_PEMILIK") : $CurrentForm->getValue("x_NAMA_PEMILIK");
        if (!$this->NAMA_PEMILIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_PEMILIK->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_PEMILIK->setFormValue($val);
            }
        }

        // Check field name 'JENIS_KELAMIN' first before field var 'x_JENIS_KELAMIN'
        $val = $CurrentForm->hasValue("JENIS_KELAMIN") ? $CurrentForm->getValue("JENIS_KELAMIN") : $CurrentForm->getValue("x_JENIS_KELAMIN");
        if (!$this->JENIS_KELAMIN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JENIS_KELAMIN->Visible = false; // Disable update for API request
            } else {
                $this->JENIS_KELAMIN->setFormValue($val);
            }
        }

        // Check field name 'NO_HP' first before field var 'x_NO_HP'
        $val = $CurrentForm->hasValue("NO_HP") ? $CurrentForm->getValue("NO_HP") : $CurrentForm->getValue("x_NO_HP");
        if (!$this->NO_HP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_HP->Visible = false; // Disable update for API request
            } else {
                $this->NO_HP->setFormValue($val);
            }
        }

        // Check field name 'ALAMAT' first before field var 'x_ALAMAT'
        $val = $CurrentForm->hasValue("ALAMAT") ? $CurrentForm->getValue("ALAMAT") : $CurrentForm->getValue("x_ALAMAT");
        if (!$this->ALAMAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ALAMAT->Visible = false; // Disable update for API request
            } else {
                $this->ALAMAT->setFormValue($val);
            }
        }

        // Check field name 'KAPANEWON' first before field var 'x_KAPANEWON'
        $val = $CurrentForm->hasValue("KAPANEWON") ? $CurrentForm->getValue("KAPANEWON") : $CurrentForm->getValue("x_KAPANEWON");
        if (!$this->KAPANEWON->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KAPANEWON->Visible = false; // Disable update for API request
            } else {
                $this->KAPANEWON->setFormValue($val);
            }
        }

        // Check field name 'KALURAHAN' first before field var 'x_KALURAHAN'
        $val = $CurrentForm->hasValue("KALURAHAN") ? $CurrentForm->getValue("KALURAHAN") : $CurrentForm->getValue("x_KALURAHAN");
        if (!$this->KALURAHAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KALURAHAN->Visible = false; // Disable update for API request
            } else {
                $this->KALURAHAN->setFormValue($val);
            }
        }

        // Check field name 'DUSUN' first before field var 'x_DUSUN'
        $val = $CurrentForm->hasValue("DUSUN") ? $CurrentForm->getValue("DUSUN") : $CurrentForm->getValue("x_DUSUN");
        if (!$this->DUSUN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DUSUN->Visible = false; // Disable update for API request
            } else {
                $this->DUSUN->setFormValue($val);
            }
        }

        // Check field name 'EMAIL' first before field var 'x__EMAIL'
        $val = $CurrentForm->hasValue("EMAIL") ? $CurrentForm->getValue("EMAIL") : $CurrentForm->getValue("x__EMAIL");
        if (!$this->_EMAIL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_EMAIL->Visible = false; // Disable update for API request
            } else {
                $this->_EMAIL->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->NAMA_PEMILIK->CurrentValue = $this->NAMA_PEMILIK->FormValue;
        $this->JENIS_KELAMIN->CurrentValue = $this->JENIS_KELAMIN->FormValue;
        $this->NO_HP->CurrentValue = $this->NO_HP->FormValue;
        $this->ALAMAT->CurrentValue = $this->ALAMAT->FormValue;
        $this->KAPANEWON->CurrentValue = $this->KAPANEWON->FormValue;
        $this->KALURAHAN->CurrentValue = $this->KALURAHAN->FormValue;
        $this->DUSUN->CurrentValue = $this->DUSUN->FormValue;
        $this->_EMAIL->CurrentValue = $this->_EMAIL->FormValue;
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
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->AKTIVASI->setDbValue($row['AKTIVASI']);
        $this->PROFIL->setDbValue($row['PROFIL']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['NAMA_PEMILIK'] = null;
        $row['JENIS_KELAMIN'] = null;
        $row['NO_HP'] = null;
        $row['ALAMAT'] = null;
        $row['KAPANEWON'] = null;
        $row['KALURAHAN'] = null;
        $row['DUSUN'] = null;
        $row['PASSWORD'] = null;
        $row['EMAIL'] = null;
        $row['AKTIVASI'] = null;
        $row['PROFIL'] = null;
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

        // NAMA_PEMILIK

        // JENIS_KELAMIN

        // NO_HP

        // ALAMAT

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // PASSWORD

        // EMAIL

        // AKTIVASI

        // PROFIL
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
            $this->NAMA_PEMILIK->ViewCustomAttributes = "";

            // JENIS_KELAMIN
            if (strval($this->JENIS_KELAMIN->CurrentValue) != "") {
                $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->optionCaption($this->JENIS_KELAMIN->CurrentValue);
            } else {
                $this->JENIS_KELAMIN->ViewValue = null;
            }
            $this->JENIS_KELAMIN->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // KAPANEWON
            $curVal = strval($this->KAPANEWON->CurrentValue);
            if ($curVal != "") {
                $this->KAPANEWON->ViewValue = $this->KAPANEWON->lookupCacheOption($curVal);
                if ($this->KAPANEWON->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "`city_id`='3402'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KAPANEWON->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KAPANEWON->Lookup->renderViewRow($rswrk[0]);
                        $this->KAPANEWON->ViewValue = $this->KAPANEWON->displayValue($arwrk);
                    } else {
                        $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
                    }
                }
            } else {
                $this->KAPANEWON->ViewValue = null;
            }
            $this->KAPANEWON->ViewCustomAttributes = "";

            // KALURAHAN
            $curVal = strval($this->KALURAHAN->CurrentValue);
            if ($curVal != "") {
                $this->KALURAHAN->ViewValue = $this->KALURAHAN->lookupCacheOption($curVal);
                if ($this->KALURAHAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->KALURAHAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KALURAHAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KALURAHAN->ViewValue = $this->KALURAHAN->displayValue($arwrk);
                    } else {
                        $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
                    }
                }
            } else {
                $this->KALURAHAN->ViewValue = null;
            }
            $this->KALURAHAN->ViewCustomAttributes = "";

            // DUSUN
            $this->DUSUN->ViewValue = $this->DUSUN->CurrentValue;
            $this->DUSUN->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->ExportHrefValue = Barcode()->getHrefValue('', 'QRCODE', 100);
            $this->NIK->TooltipValue = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";
            $this->NAMA_PEMILIK->TooltipValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";
            $this->JENIS_KELAMIN->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";
            $this->KAPANEWON->TooltipValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";
            $this->KALURAHAN->TooltipValue = "";

            // DUSUN
            $this->DUSUN->LinkCustomAttributes = "";
            $this->DUSUN->HrefValue = "";
            $this->DUSUN->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK
            $this->NIK->EditAttrs["class"] = "form-control";
            $this->NIK->EditCustomAttributes = "";
            if (!$this->NIK->Raw) {
                $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
            }
            $this->NIK->EditValue = HtmlEncode($this->NIK->CurrentValue);
            $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
            $this->NAMA_PEMILIK->EditCustomAttributes = "";
            if (!$this->NAMA_PEMILIK->Raw) {
                $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
            }
            $this->NAMA_PEMILIK->EditValue = HtmlEncode($this->NAMA_PEMILIK->CurrentValue);
            $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->EditCustomAttributes = "";
            $this->JENIS_KELAMIN->EditValue = $this->JENIS_KELAMIN->options(false);
            $this->JENIS_KELAMIN->PlaceHolder = RemoveHtml($this->JENIS_KELAMIN->caption());

            // NO_HP
            $this->NO_HP->EditAttrs["class"] = "form-control";
            $this->NO_HP->EditCustomAttributes = "";
            if (!$this->NO_HP->Raw) {
                $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
            }
            $this->NO_HP->EditValue = HtmlEncode($this->NO_HP->CurrentValue);
            $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

            // ALAMAT
            $this->ALAMAT->EditAttrs["class"] = "form-control";
            $this->ALAMAT->EditCustomAttributes = "";
            $this->ALAMAT->EditValue = HtmlEncode($this->ALAMAT->CurrentValue);
            $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

            // KAPANEWON
            $this->KAPANEWON->EditAttrs["class"] = "form-control";
            $this->KAPANEWON->EditCustomAttributes = "";
            $curVal = trim(strval($this->KAPANEWON->CurrentValue));
            if ($curVal != "") {
                $this->KAPANEWON->ViewValue = $this->KAPANEWON->lookupCacheOption($curVal);
            } else {
                $this->KAPANEWON->ViewValue = $this->KAPANEWON->Lookup !== null && is_array($this->KAPANEWON->Lookup->Options) ? $curVal : null;
            }
            if ($this->KAPANEWON->ViewValue !== null) { // Load from cache
                $this->KAPANEWON->EditValue = array_values($this->KAPANEWON->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KAPANEWON->CurrentValue, DATATYPE_STRING, "");
                }
                $lookupFilter = function() {
                    return "`city_id`='3402'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KAPANEWON->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KAPANEWON->EditValue = $arwrk;
            }
            $this->KAPANEWON->PlaceHolder = RemoveHtml($this->KAPANEWON->caption());

            // KALURAHAN
            $this->KALURAHAN->EditAttrs["class"] = "form-control";
            $this->KALURAHAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KALURAHAN->CurrentValue));
            if ($curVal != "") {
                $this->KALURAHAN->ViewValue = $this->KALURAHAN->lookupCacheOption($curVal);
            } else {
                $this->KALURAHAN->ViewValue = $this->KALURAHAN->Lookup !== null && is_array($this->KALURAHAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KALURAHAN->ViewValue !== null) { // Load from cache
                $this->KALURAHAN->EditValue = array_values($this->KALURAHAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KALURAHAN->CurrentValue, DATATYPE_STRING, "");
                }
                $sqlWrk = $this->KALURAHAN->Lookup->getSql(true, $filterWrk, '', $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KALURAHAN->EditValue = $arwrk;
            }
            $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

            // DUSUN
            $this->DUSUN->EditAttrs["class"] = "form-control";
            $this->DUSUN->EditCustomAttributes = "";
            if (!$this->DUSUN->Raw) {
                $this->DUSUN->CurrentValue = HtmlDecode($this->DUSUN->CurrentValue);
            }
            $this->DUSUN->EditValue = HtmlEncode($this->DUSUN->CurrentValue);
            $this->DUSUN->PlaceHolder = RemoveHtml($this->DUSUN->caption());

            // EMAIL
            $this->_EMAIL->EditAttrs["class"] = "form-control";
            $this->_EMAIL->EditCustomAttributes = "";
            if (!$this->_EMAIL->Raw) {
                $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
            }
            $this->_EMAIL->EditValue = HtmlEncode($this->_EMAIL->CurrentValue);
            $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->ExportHrefValue = Barcode()->getHrefValue('', 'QRCODE', 100);

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";

            // DUSUN
            $this->DUSUN->LinkCustomAttributes = "";
            $this->DUSUN->HrefValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
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
        if (!CheckInteger($this->NIK->FormValue)) {
            $this->NIK->addErrorMessage($this->NIK->getErrorMessage(false));
        }
        if (!$this->NIK->Raw && Config("REMOVE_XSS") && CheckUsername($this->NIK->FormValue)) {
            $this->NIK->addErrorMessage($Language->phrase("InvalidUsernameChars"));
        }
        if ($this->NAMA_PEMILIK->Required) {
            if (!$this->NAMA_PEMILIK->IsDetailKey && EmptyValue($this->NAMA_PEMILIK->FormValue)) {
                $this->NAMA_PEMILIK->addErrorMessage(str_replace("%s", $this->NAMA_PEMILIK->caption(), $this->NAMA_PEMILIK->RequiredErrorMessage));
            }
        }
        if ($this->JENIS_KELAMIN->Required) {
            if ($this->JENIS_KELAMIN->FormValue == "") {
                $this->JENIS_KELAMIN->addErrorMessage(str_replace("%s", $this->JENIS_KELAMIN->caption(), $this->JENIS_KELAMIN->RequiredErrorMessage));
            }
        }
        if ($this->NO_HP->Required) {
            if (!$this->NO_HP->IsDetailKey && EmptyValue($this->NO_HP->FormValue)) {
                $this->NO_HP->addErrorMessage(str_replace("%s", $this->NO_HP->caption(), $this->NO_HP->RequiredErrorMessage));
            }
        }
        if ($this->ALAMAT->Required) {
            if (!$this->ALAMAT->IsDetailKey && EmptyValue($this->ALAMAT->FormValue)) {
                $this->ALAMAT->addErrorMessage(str_replace("%s", $this->ALAMAT->caption(), $this->ALAMAT->RequiredErrorMessage));
            }
        }
        if ($this->KAPANEWON->Required) {
            if (!$this->KAPANEWON->IsDetailKey && EmptyValue($this->KAPANEWON->FormValue)) {
                $this->KAPANEWON->addErrorMessage(str_replace("%s", $this->KAPANEWON->caption(), $this->KAPANEWON->RequiredErrorMessage));
            }
        }
        if ($this->KALURAHAN->Required) {
            if (!$this->KALURAHAN->IsDetailKey && EmptyValue($this->KALURAHAN->FormValue)) {
                $this->KALURAHAN->addErrorMessage(str_replace("%s", $this->KALURAHAN->caption(), $this->KALURAHAN->RequiredErrorMessage));
            }
        }
        if ($this->DUSUN->Required) {
            if (!$this->DUSUN->IsDetailKey && EmptyValue($this->DUSUN->FormValue)) {
                $this->DUSUN->addErrorMessage(str_replace("%s", $this->DUSUN->caption(), $this->DUSUN->RequiredErrorMessage));
            }
        }
        if ($this->_EMAIL->Required) {
            if (!$this->_EMAIL->IsDetailKey && EmptyValue($this->_EMAIL->FormValue)) {
                $this->_EMAIL->addErrorMessage(str_replace("%s", $this->_EMAIL->caption(), $this->_EMAIL->RequiredErrorMessage));
            }
        }
        if (!CheckEmail($this->_EMAIL->FormValue)) {
            $this->_EMAIL->addErrorMessage($this->_EMAIL->getErrorMessage(false));
        }

        // Validate detail grid
        $detailTblVar = explode(",", $this->getCurrentDetailTable());
        $detailPage = Container("UmkmDatausahaGrid");
        if (in_array("umkm_datausaha", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->validateGridForm();
        }
        $detailPage = Container("UmkmAspekkeuanganGrid");
        if (in_array("umkm_aspekkeuangan", $detailTblVar) && $detailPage->DetailEdit) {
            $detailPage->validateGridForm();
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
            // Begin transaction
            if ($this->getCurrentDetailTable() != "") {
                $conn->beginTransaction();
            }

            // Save old values
            $this->loadDbValues($rsold);
            $rsnew = [];

            // NIK
            $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "", $this->NIK->ReadOnly);

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->setDbValueDef($rsnew, $this->NAMA_PEMILIK->CurrentValue, null, $this->NAMA_PEMILIK->ReadOnly);

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->setDbValueDef($rsnew, $this->JENIS_KELAMIN->CurrentValue, null, $this->JENIS_KELAMIN->ReadOnly);

            // NO_HP
            $this->NO_HP->setDbValueDef($rsnew, $this->NO_HP->CurrentValue, null, $this->NO_HP->ReadOnly);

            // ALAMAT
            $this->ALAMAT->setDbValueDef($rsnew, $this->ALAMAT->CurrentValue, null, $this->ALAMAT->ReadOnly);

            // KAPANEWON
            $this->KAPANEWON->setDbValueDef($rsnew, $this->KAPANEWON->CurrentValue, null, $this->KAPANEWON->ReadOnly);

            // KALURAHAN
            $this->KALURAHAN->setDbValueDef($rsnew, $this->KALURAHAN->CurrentValue, null, $this->KALURAHAN->ReadOnly);

            // DUSUN
            $this->DUSUN->setDbValueDef($rsnew, $this->DUSUN->CurrentValue, null, $this->DUSUN->ReadOnly);

            // EMAIL
            $this->_EMAIL->setDbValueDef($rsnew, $this->_EMAIL->CurrentValue, null, $this->_EMAIL->ReadOnly);

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

                // Update detail records
                $detailTblVar = explode(",", $this->getCurrentDetailTable());
                if ($editRow) {
                    $detailPage = Container("UmkmDatausahaGrid");
                    if (in_array("umkm_datausaha", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "umkm_datausaha"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }
                if ($editRow) {
                    $detailPage = Container("UmkmAspekkeuanganGrid");
                    if (in_array("umkm_aspekkeuangan", $detailTblVar) && $detailPage->DetailEdit) {
                        $Security->loadCurrentUserLevel($this->ProjectID . "umkm_aspekkeuangan"); // Load user level of detail table
                        $editRow = $detailPage->gridUpdate();
                        $Security->loadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
                    }
                }

                // Commit/Rollback transaction
                if ($this->getCurrentDetailTable() != "") {
                    if ($editRow) {
                        $conn->commit(); // Commit transaction
                    } else {
                        $conn->rollback(); // Rollback transaction
                    }
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

    // Set up detail parms based on QueryString
    protected function setupDetailParms()
    {
        // Get the keys for master table
        $detailTblVar = Get(Config("TABLE_SHOW_DETAIL"));
        if ($detailTblVar !== null) {
            $this->setCurrentDetailTable($detailTblVar);
        } else {
            $detailTblVar = $this->getCurrentDetailTable();
        }
        if ($detailTblVar != "") {
            $detailTblVar = explode(",", $detailTblVar);
            if (in_array("umkm_datausaha", $detailTblVar)) {
                $detailPageObj = Container("UmkmDatausahaGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->NIK->IsDetailKey = true;
                    $detailPageObj->NIK->CurrentValue = $this->NIK->CurrentValue;
                    $detailPageObj->NIK->setSessionValue($detailPageObj->NIK->CurrentValue);
                }
            }
            if (in_array("umkm_aspekkeuangan", $detailTblVar)) {
                $detailPageObj = Container("UmkmAspekkeuanganGrid");
                if ($detailPageObj->DetailEdit) {
                    $detailPageObj->CurrentMode = "edit";
                    $detailPageObj->CurrentAction = "gridedit";

                    // Save current master table to detail table
                    $detailPageObj->setCurrentMasterTable($this->TableVar);
                    $detailPageObj->setStartRecordNumber(1);
                    $detailPageObj->NIK->IsDetailKey = true;
                    $detailPageObj->NIK->CurrentValue = $this->NIK->CurrentValue;
                    $detailPageObj->NIK->setSessionValue($detailPageObj->NIK->CurrentValue);
                }
            }
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmdatadirilist"), "", $this->TableVar, true);
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
                case "x_JENIS_KELAMIN":
                    break;
                case "x_KAPANEWON":
                    $lookupFilter = function () {
                        return "`city_id`='3402'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KALURAHAN":
                    break;
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
