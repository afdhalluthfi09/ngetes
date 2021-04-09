<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspeklembagaAdd extends UmkmAspeklembaga
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspeklembaga';

    // Page object name
    public $PageObjName = "UmkmAspeklembagaAdd";

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

        // Table object (umkm_aspeklembaga)
        if (!isset($GLOBALS["umkm_aspeklembaga"]) || get_class($GLOBALS["umkm_aspeklembaga"]) == PROJECT_NAMESPACE . "umkm_aspeklembaga") {
            $GLOBALS["umkm_aspeklembaga"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspeklembaga');
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
                $doc = new $class(Container("umkm_aspeklembaga"));
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
                    if ($pageName == "umkmaspeklembagaview") {
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
    public $FormClassName = "ew-horizontal ew-form ew-add-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $Priv = 0;
    public $OldRecordset;
    public $CopyRecord;

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
        $this->LB_BADANHUKUM->setVisibility();
        $this->LB_IZINUSAHA->setVisibility();
        $this->LB_NPWP->setVisibility();
        $this->LB_SO->setVisibility();
        $this->LB_JD->setVisibility();
        $this->LB_ISO->setVisibility();
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
        $this->setupLookupOptions($this->LB_BADANHUKUM);
        $this->setupLookupOptions($this->LB_IZINUSAHA);
        $this->setupLookupOptions($this->LB_NPWP);
        $this->setupLookupOptions($this->LB_SO);
        $this->setupLookupOptions($this->LB_JD);
        $this->setupLookupOptions($this->LB_ISO);

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-add-form ew-horizontal";
        $postBack = false;

        // Set up current action
        if (IsApi()) {
            $this->CurrentAction = "insert"; // Add record directly
            $postBack = true;
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action"); // Get form action
            $this->setKey(Post($this->OldKeyName));
            $postBack = true;
        } else {
            // Load key values from QueryString
            if (($keyValue = Get("NIK") ?? Route("NIK")) !== null) {
                $this->NIK->setQueryStringValue($keyValue);
            }
            $this->OldKey = $this->getKey(true); // Get from CurrentValue
            $this->CopyRecord = !EmptyValue($this->OldKey);
            if ($this->CopyRecord) {
                $this->CurrentAction = "copy"; // Copy record
            } else {
                $this->CurrentAction = "show"; // Display blank record
            }
        }

        // Load old record / default values
        $loaded = $this->loadOldRecord();

        // Load form values
        if ($postBack) {
            $this->loadFormValues(); // Load form values
        }

        // Validate form if post back
        if ($postBack) {
            if (!$this->validateForm()) {
                $this->EventCancelled = true; // Event cancelled
                $this->restoreFormValues(); // Restore form values
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        }

        // Perform current action
        switch ($this->CurrentAction) {
            case "copy": // Copy an existing record
                if (!$loaded) { // Record not loaded
                    if ($this->getFailureMessage() == "") {
                        $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
                    }
                    $this->terminate("umkmaspeklembagalist"); // No matching record, return to list
                    return;
                }
                break;
            case "insert": // Add new record
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow($this->OldRecordset)) { // Add successful
                    if ($this->getSuccessMessage() == "" && Post("addopt") != "1") { // Skip success message for addopt (done in JavaScript)
                        $this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
                    }
                    $returnUrl = $this->getReturnUrl();
                    if (GetPageName($returnUrl) == "umkmaspeklembagalist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "umkmaspeklembagaview") {
                        $returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate($returnUrl);
                        return;
                    }
                } elseif (IsApi()) { // API request, return
                    $this->terminate();
                    return;
                } else {
                    $this->EventCancelled = true; // Event cancelled
                    $this->restoreFormValues(); // Add failed, restore form values
                }
        }

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Render row based on row type
        $this->RowType = ROWTYPE_ADD; // Render add type

        // Render row
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

    // Load default values
    protected function loadDefaultValues()
    {
        $this->NIK->CurrentValue = null;
        $this->NIK->OldValue = $this->NIK->CurrentValue;
        $this->LB_BADANHUKUM->CurrentValue = null;
        $this->LB_BADANHUKUM->OldValue = $this->LB_BADANHUKUM->CurrentValue;
        $this->LB_IZINUSAHA->CurrentValue = null;
        $this->LB_IZINUSAHA->OldValue = $this->LB_IZINUSAHA->CurrentValue;
        $this->LB_NPWP->CurrentValue = null;
        $this->LB_NPWP->OldValue = $this->LB_NPWP->CurrentValue;
        $this->LB_SO->CurrentValue = null;
        $this->LB_SO->OldValue = $this->LB_SO->CurrentValue;
        $this->LB_JD->CurrentValue = null;
        $this->LB_JD->OldValue = $this->LB_JD->CurrentValue;
        $this->LB_ISO->CurrentValue = null;
        $this->LB_ISO->OldValue = $this->LB_ISO->CurrentValue;
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

        // Check field name 'LB_BADANHUKUM' first before field var 'x_LB_BADANHUKUM'
        $val = $CurrentForm->hasValue("LB_BADANHUKUM") ? $CurrentForm->getValue("LB_BADANHUKUM") : $CurrentForm->getValue("x_LB_BADANHUKUM");
        if (!$this->LB_BADANHUKUM->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_BADANHUKUM->Visible = false; // Disable update for API request
            } else {
                $this->LB_BADANHUKUM->setFormValue($val);
            }
        }

        // Check field name 'LB_IZINUSAHA' first before field var 'x_LB_IZINUSAHA'
        $val = $CurrentForm->hasValue("LB_IZINUSAHA") ? $CurrentForm->getValue("LB_IZINUSAHA") : $CurrentForm->getValue("x_LB_IZINUSAHA");
        if (!$this->LB_IZINUSAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_IZINUSAHA->Visible = false; // Disable update for API request
            } else {
                $this->LB_IZINUSAHA->setFormValue($val);
            }
        }

        // Check field name 'LB_NPWP' first before field var 'x_LB_NPWP'
        $val = $CurrentForm->hasValue("LB_NPWP") ? $CurrentForm->getValue("LB_NPWP") : $CurrentForm->getValue("x_LB_NPWP");
        if (!$this->LB_NPWP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_NPWP->Visible = false; // Disable update for API request
            } else {
                $this->LB_NPWP->setFormValue($val);
            }
        }

        // Check field name 'LB_SO' first before field var 'x_LB_SO'
        $val = $CurrentForm->hasValue("LB_SO") ? $CurrentForm->getValue("LB_SO") : $CurrentForm->getValue("x_LB_SO");
        if (!$this->LB_SO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_SO->Visible = false; // Disable update for API request
            } else {
                $this->LB_SO->setFormValue($val);
            }
        }

        // Check field name 'LB_JD' first before field var 'x_LB_JD'
        $val = $CurrentForm->hasValue("LB_JD") ? $CurrentForm->getValue("LB_JD") : $CurrentForm->getValue("x_LB_JD");
        if (!$this->LB_JD->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_JD->Visible = false; // Disable update for API request
            } else {
                $this->LB_JD->setFormValue($val);
            }
        }

        // Check field name 'LB_ISO' first before field var 'x_LB_ISO'
        $val = $CurrentForm->hasValue("LB_ISO") ? $CurrentForm->getValue("LB_ISO") : $CurrentForm->getValue("x_LB_ISO");
        if (!$this->LB_ISO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->LB_ISO->Visible = false; // Disable update for API request
            } else {
                $this->LB_ISO->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->LB_BADANHUKUM->CurrentValue = $this->LB_BADANHUKUM->FormValue;
        $this->LB_IZINUSAHA->CurrentValue = $this->LB_IZINUSAHA->FormValue;
        $this->LB_NPWP->CurrentValue = $this->LB_NPWP->FormValue;
        $this->LB_SO->CurrentValue = $this->LB_SO->FormValue;
        $this->LB_JD->CurrentValue = $this->LB_JD->FormValue;
        $this->LB_ISO->CurrentValue = $this->LB_ISO->FormValue;
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
        $this->LB_BADANHUKUM->setDbValue($row['LB_BADANHUKUM']);
        $this->LB_IZINUSAHA->setDbValue($row['LB_IZINUSAHA']);
        $this->LB_NPWP->setDbValue($row['LB_NPWP']);
        $this->LB_SO->setDbValue($row['LB_SO']);
        $this->LB_JD->setDbValue($row['LB_JD']);
        $this->LB_ISO->setDbValue($row['LB_ISO']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['LB_BADANHUKUM'] = $this->LB_BADANHUKUM->CurrentValue;
        $row['LB_IZINUSAHA'] = $this->LB_IZINUSAHA->CurrentValue;
        $row['LB_NPWP'] = $this->LB_NPWP->CurrentValue;
        $row['LB_SO'] = $this->LB_SO->CurrentValue;
        $row['LB_JD'] = $this->LB_JD->CurrentValue;
        $row['LB_ISO'] = $this->LB_ISO->CurrentValue;
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

        // LB_BADANHUKUM

        // LB_IZINUSAHA

        // LB_NPWP

        // LB_SO

        // LB_JD

        // LB_ISO
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // LB_BADANHUKUM
            $curVal = strval($this->LB_BADANHUKUM->CurrentValue);
            if ($curVal != "") {
                $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->lookupCacheOption($curVal);
                if ($this->LB_BADANHUKUM->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Badan Hukum'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_BADANHUKUM->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_BADANHUKUM->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->displayValue($arwrk);
                    } else {
                        $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->CurrentValue;
                    }
                }
            } else {
                $this->LB_BADANHUKUM->ViewValue = null;
            }
            $this->LB_BADANHUKUM->ViewCustomAttributes = "";

            // LB_IZINUSAHA
            $curVal = strval($this->LB_IZINUSAHA->CurrentValue);
            if ($curVal != "") {
                $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->lookupCacheOption($curVal);
                if ($this->LB_IZINUSAHA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Izin Usaha'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_IZINUSAHA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_IZINUSAHA->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->displayValue($arwrk);
                    } else {
                        $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->CurrentValue;
                    }
                }
            } else {
                $this->LB_IZINUSAHA->ViewValue = null;
            }
            $this->LB_IZINUSAHA->ViewCustomAttributes = "";

            // LB_NPWP
            $curVal = strval($this->LB_NPWP->CurrentValue);
            if ($curVal != "") {
                $this->LB_NPWP->ViewValue = $this->LB_NPWP->lookupCacheOption($curVal);
                if ($this->LB_NPWP->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='NPWP'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_NPWP->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_NPWP->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_NPWP->ViewValue = $this->LB_NPWP->displayValue($arwrk);
                    } else {
                        $this->LB_NPWP->ViewValue = $this->LB_NPWP->CurrentValue;
                    }
                }
            } else {
                $this->LB_NPWP->ViewValue = null;
            }
            $this->LB_NPWP->ViewCustomAttributes = "";

            // LB_SO
            $curVal = strval($this->LB_SO->CurrentValue);
            if ($curVal != "") {
                $this->LB_SO->ViewValue = $this->LB_SO->lookupCacheOption($curVal);
                if ($this->LB_SO->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Struktur Organisasi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_SO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_SO->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_SO->ViewValue = $this->LB_SO->displayValue($arwrk);
                    } else {
                        $this->LB_SO->ViewValue = $this->LB_SO->CurrentValue;
                    }
                }
            } else {
                $this->LB_SO->ViewValue = null;
            }
            $this->LB_SO->ViewCustomAttributes = "";

            // LB_JD
            $curVal = strval($this->LB_JD->CurrentValue);
            if ($curVal != "") {
                $this->LB_JD->ViewValue = $this->LB_JD->lookupCacheOption($curVal);
                if ($this->LB_JD->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Jobs Desk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_JD->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_JD->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_JD->ViewValue = $this->LB_JD->displayValue($arwrk);
                    } else {
                        $this->LB_JD->ViewValue = $this->LB_JD->CurrentValue;
                    }
                }
            } else {
                $this->LB_JD->ViewValue = null;
            }
            $this->LB_JD->ViewCustomAttributes = "";

            // LB_ISO
            $curVal = strval($this->LB_ISO->CurrentValue);
            if ($curVal != "") {
                $this->LB_ISO->ViewValue = $this->LB_ISO->lookupCacheOption($curVal);
                if ($this->LB_ISO->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='ISO'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->LB_ISO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->LB_ISO->Lookup->renderViewRow($rswrk[0]);
                        $this->LB_ISO->ViewValue = $this->LB_ISO->displayValue($arwrk);
                    } else {
                        $this->LB_ISO->ViewValue = $this->LB_ISO->CurrentValue;
                    }
                }
            } else {
                $this->LB_ISO->ViewValue = null;
            }
            $this->LB_ISO->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // LB_BADANHUKUM
            $this->LB_BADANHUKUM->LinkCustomAttributes = "";
            $this->LB_BADANHUKUM->HrefValue = "";
            $this->LB_BADANHUKUM->TooltipValue = "";

            // LB_IZINUSAHA
            $this->LB_IZINUSAHA->LinkCustomAttributes = "";
            $this->LB_IZINUSAHA->HrefValue = "";
            $this->LB_IZINUSAHA->TooltipValue = "";

            // LB_NPWP
            $this->LB_NPWP->LinkCustomAttributes = "";
            $this->LB_NPWP->HrefValue = "";
            $this->LB_NPWP->TooltipValue = "";

            // LB_SO
            $this->LB_SO->LinkCustomAttributes = "";
            $this->LB_SO->HrefValue = "";
            $this->LB_SO->TooltipValue = "";

            // LB_JD
            $this->LB_JD->LinkCustomAttributes = "";
            $this->LB_JD->HrefValue = "";
            $this->LB_JD->TooltipValue = "";

            // LB_ISO
            $this->LB_ISO->LinkCustomAttributes = "";
            $this->LB_ISO->HrefValue = "";
            $this->LB_ISO->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // LB_BADANHUKUM
            $this->LB_BADANHUKUM->EditAttrs["class"] = "form-control";
            $this->LB_BADANHUKUM->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_BADANHUKUM->CurrentValue));
            if ($curVal != "") {
                $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->lookupCacheOption($curVal);
            } else {
                $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->Lookup !== null && is_array($this->LB_BADANHUKUM->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_BADANHUKUM->ViewValue !== null) { // Load from cache
                $this->LB_BADANHUKUM->EditValue = array_values($this->LB_BADANHUKUM->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_BADANHUKUM->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Badan Hukum'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_BADANHUKUM->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_BADANHUKUM->EditValue = $arwrk;
            }
            $this->LB_BADANHUKUM->PlaceHolder = RemoveHtml($this->LB_BADANHUKUM->caption());

            // LB_IZINUSAHA
            $this->LB_IZINUSAHA->EditAttrs["class"] = "form-control";
            $this->LB_IZINUSAHA->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_IZINUSAHA->CurrentValue));
            if ($curVal != "") {
                $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->lookupCacheOption($curVal);
            } else {
                $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->Lookup !== null && is_array($this->LB_IZINUSAHA->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_IZINUSAHA->ViewValue !== null) { // Load from cache
                $this->LB_IZINUSAHA->EditValue = array_values($this->LB_IZINUSAHA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_IZINUSAHA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Izin Usaha'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_IZINUSAHA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_IZINUSAHA->EditValue = $arwrk;
            }
            $this->LB_IZINUSAHA->PlaceHolder = RemoveHtml($this->LB_IZINUSAHA->caption());

            // LB_NPWP
            $this->LB_NPWP->EditAttrs["class"] = "form-control";
            $this->LB_NPWP->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_NPWP->CurrentValue));
            if ($curVal != "") {
                $this->LB_NPWP->ViewValue = $this->LB_NPWP->lookupCacheOption($curVal);
            } else {
                $this->LB_NPWP->ViewValue = $this->LB_NPWP->Lookup !== null && is_array($this->LB_NPWP->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_NPWP->ViewValue !== null) { // Load from cache
                $this->LB_NPWP->EditValue = array_values($this->LB_NPWP->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_NPWP->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='NPWP'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_NPWP->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_NPWP->EditValue = $arwrk;
            }
            $this->LB_NPWP->PlaceHolder = RemoveHtml($this->LB_NPWP->caption());

            // LB_SO
            $this->LB_SO->EditAttrs["class"] = "form-control";
            $this->LB_SO->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_SO->CurrentValue));
            if ($curVal != "") {
                $this->LB_SO->ViewValue = $this->LB_SO->lookupCacheOption($curVal);
            } else {
                $this->LB_SO->ViewValue = $this->LB_SO->Lookup !== null && is_array($this->LB_SO->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_SO->ViewValue !== null) { // Load from cache
                $this->LB_SO->EditValue = array_values($this->LB_SO->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_SO->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Struktur Organisasi'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_SO->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_SO->EditValue = $arwrk;
            }
            $this->LB_SO->PlaceHolder = RemoveHtml($this->LB_SO->caption());

            // LB_JD
            $this->LB_JD->EditAttrs["class"] = "form-control";
            $this->LB_JD->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_JD->CurrentValue));
            if ($curVal != "") {
                $this->LB_JD->ViewValue = $this->LB_JD->lookupCacheOption($curVal);
            } else {
                $this->LB_JD->ViewValue = $this->LB_JD->Lookup !== null && is_array($this->LB_JD->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_JD->ViewValue !== null) { // Load from cache
                $this->LB_JD->EditValue = array_values($this->LB_JD->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_JD->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Jobs Desk'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_JD->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_JD->EditValue = $arwrk;
            }
            $this->LB_JD->PlaceHolder = RemoveHtml($this->LB_JD->caption());

            // LB_ISO
            $this->LB_ISO->EditAttrs["class"] = "form-control";
            $this->LB_ISO->EditCustomAttributes = "";
            $curVal = trim(strval($this->LB_ISO->CurrentValue));
            if ($curVal != "") {
                $this->LB_ISO->ViewValue = $this->LB_ISO->lookupCacheOption($curVal);
            } else {
                $this->LB_ISO->ViewValue = $this->LB_ISO->Lookup !== null && is_array($this->LB_ISO->Lookup->Options) ? $curVal : null;
            }
            if ($this->LB_ISO->ViewValue !== null) { // Load from cache
                $this->LB_ISO->EditValue = array_values($this->LB_ISO->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->LB_ISO->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='ISO'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_ISO->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->LB_ISO->EditValue = $arwrk;
            }
            $this->LB_ISO->PlaceHolder = RemoveHtml($this->LB_ISO->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // LB_BADANHUKUM
            $this->LB_BADANHUKUM->LinkCustomAttributes = "";
            $this->LB_BADANHUKUM->HrefValue = "";

            // LB_IZINUSAHA
            $this->LB_IZINUSAHA->LinkCustomAttributes = "";
            $this->LB_IZINUSAHA->HrefValue = "";

            // LB_NPWP
            $this->LB_NPWP->LinkCustomAttributes = "";
            $this->LB_NPWP->HrefValue = "";

            // LB_SO
            $this->LB_SO->LinkCustomAttributes = "";
            $this->LB_SO->HrefValue = "";

            // LB_JD
            $this->LB_JD->LinkCustomAttributes = "";
            $this->LB_JD->HrefValue = "";

            // LB_ISO
            $this->LB_ISO->LinkCustomAttributes = "";
            $this->LB_ISO->HrefValue = "";
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
        if ($this->LB_BADANHUKUM->Required) {
            if (!$this->LB_BADANHUKUM->IsDetailKey && EmptyValue($this->LB_BADANHUKUM->FormValue)) {
                $this->LB_BADANHUKUM->addErrorMessage(str_replace("%s", $this->LB_BADANHUKUM->caption(), $this->LB_BADANHUKUM->RequiredErrorMessage));
            }
        }
        if ($this->LB_IZINUSAHA->Required) {
            if (!$this->LB_IZINUSAHA->IsDetailKey && EmptyValue($this->LB_IZINUSAHA->FormValue)) {
                $this->LB_IZINUSAHA->addErrorMessage(str_replace("%s", $this->LB_IZINUSAHA->caption(), $this->LB_IZINUSAHA->RequiredErrorMessage));
            }
        }
        if ($this->LB_NPWP->Required) {
            if (!$this->LB_NPWP->IsDetailKey && EmptyValue($this->LB_NPWP->FormValue)) {
                $this->LB_NPWP->addErrorMessage(str_replace("%s", $this->LB_NPWP->caption(), $this->LB_NPWP->RequiredErrorMessage));
            }
        }
        if ($this->LB_SO->Required) {
            if (!$this->LB_SO->IsDetailKey && EmptyValue($this->LB_SO->FormValue)) {
                $this->LB_SO->addErrorMessage(str_replace("%s", $this->LB_SO->caption(), $this->LB_SO->RequiredErrorMessage));
            }
        }
        if ($this->LB_JD->Required) {
            if (!$this->LB_JD->IsDetailKey && EmptyValue($this->LB_JD->FormValue)) {
                $this->LB_JD->addErrorMessage(str_replace("%s", $this->LB_JD->caption(), $this->LB_JD->RequiredErrorMessage));
            }
        }
        if ($this->LB_ISO->Required) {
            if (!$this->LB_ISO->IsDetailKey && EmptyValue($this->LB_ISO->FormValue)) {
                $this->LB_ISO->addErrorMessage(str_replace("%s", $this->LB_ISO->caption(), $this->LB_ISO->RequiredErrorMessage));
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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // NIK
        $this->NIK->CurrentValue = CurrentUserName();
        $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "");

        // LB_BADANHUKUM
        $this->LB_BADANHUKUM->setDbValueDef($rsnew, $this->LB_BADANHUKUM->CurrentValue, null, false);

        // LB_IZINUSAHA
        $this->LB_IZINUSAHA->setDbValueDef($rsnew, $this->LB_IZINUSAHA->CurrentValue, null, false);

        // LB_NPWP
        $this->LB_NPWP->setDbValueDef($rsnew, $this->LB_NPWP->CurrentValue, null, false);

        // LB_SO
        $this->LB_SO->setDbValueDef($rsnew, $this->LB_SO->CurrentValue, null, false);

        // LB_JD
        $this->LB_JD->setDbValueDef($rsnew, $this->LB_JD->CurrentValue, null, false);

        // LB_ISO
        $this->LB_ISO->setDbValueDef($rsnew, $this->LB_ISO->CurrentValue, null, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['NIK']) == "") {
            $this->setFailureMessage($Language->phrase("InvalidKeyValue"));
            $insertRow = false;
        }

        // Check for duplicate key
        if ($insertRow && $this->ValidateKey) {
            $filter = $this->getRecordFilter($rsnew);
            $rsChk = $this->loadRs($filter)->fetch();
            if ($rsChk !== false) {
                $keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
                $this->setFailureMessage($keyErrMsg);
                $insertRow = false;
            }
        }
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
            }
        } else {
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("InsertCancelled"));
            }
            $addRow = false;
        }
        if ($addRow) {
            // Call Row Inserted event
            $this->rowInserted($rsold, $rsnew);
        }

        // Clean upload path if any
        if ($addRow) {
        }

        // Write JSON for API request
        if (IsApi() && $addRow) {
            $row = $this->getRecordsFromRecordset([$rsnew], true);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $addRow;
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspeklembagalist"), "", $this->TableVar, true);
        $pageId = ($this->isCopy()) ? "Copy" : "Add";
        $Breadcrumb->add("add", $pageId, $url);
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
                case "x_LB_BADANHUKUM":
                    $lookupFilter = function () {
                        return "`subkat`='Badan Hukum'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_LB_IZINUSAHA":
                    $lookupFilter = function () {
                        return "`subkat`='Izin Usaha'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_LB_NPWP":
                    $lookupFilter = function () {
                        return "`subkat`='NPWP'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_LB_SO":
                    $lookupFilter = function () {
                        return "`subkat`='Struktur Organisasi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_LB_JD":
                    $lookupFilter = function () {
                        return "`subkat`='Jobs Desk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_LB_ISO":
                    $lookupFilter = function () {
                        return "`subkat`='ISO'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
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
