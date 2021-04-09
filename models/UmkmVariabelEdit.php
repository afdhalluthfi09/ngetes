<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmVariabelEdit extends UmkmVariabel
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_variabel';

    // Page object name
    public $PageObjName = "UmkmVariabelEdit";

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

        // Table object (umkm_variabel)
        if (!isset($GLOBALS["umkm_variabel"]) || get_class($GLOBALS["umkm_variabel"]) == PROJECT_NAMESPACE . "umkm_variabel") {
            $GLOBALS["umkm_variabel"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_variabel');
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
                $doc = new $class(Container("umkm_variabel"));
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
                    if ($pageName == "umkmvariabelview") {
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
            $key .= @$ar['id'];
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
        if ($this->isAdd() || $this->isCopy() || $this->isGridAdd()) {
            $this->id->Visible = false;
        }
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
        $this->id->setVisibility();
        $this->variabel->setVisibility();
        $this->nmin->setVisibility();
        $this->nmax->setVisibility();
        $this->subkat->setVisibility();
        $this->bobot->setVisibility();
        $this->kat->setVisibility();
        $this->porsi->setVisibility();
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
            if (($keyValue = Get("id") ?? Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->id->setOldValue($this->id->QueryStringValue);
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->id->setOldValue($this->id->FormValue);
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
                if (($keyValue = Get("id") ?? Route("id")) !== null) {
                    $this->id->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->id->CurrentValue = null;
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
                    $this->terminate("umkmvariabellist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "umkmvariabellist") {
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

        // Check field name 'id' first before field var 'x_id'
        $val = $CurrentForm->hasValue("id") ? $CurrentForm->getValue("id") : $CurrentForm->getValue("x_id");
        if (!$this->id->IsDetailKey) {
            $this->id->setFormValue($val);
        }

        // Check field name 'variabel' first before field var 'x_variabel'
        $val = $CurrentForm->hasValue("variabel") ? $CurrentForm->getValue("variabel") : $CurrentForm->getValue("x_variabel");
        if (!$this->variabel->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->variabel->Visible = false; // Disable update for API request
            } else {
                $this->variabel->setFormValue($val);
            }
        }

        // Check field name 'nmin' first before field var 'x_nmin'
        $val = $CurrentForm->hasValue("nmin") ? $CurrentForm->getValue("nmin") : $CurrentForm->getValue("x_nmin");
        if (!$this->nmin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nmin->Visible = false; // Disable update for API request
            } else {
                $this->nmin->setFormValue($val);
            }
        }

        // Check field name 'nmax' first before field var 'x_nmax'
        $val = $CurrentForm->hasValue("nmax") ? $CurrentForm->getValue("nmax") : $CurrentForm->getValue("x_nmax");
        if (!$this->nmax->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nmax->Visible = false; // Disable update for API request
            } else {
                $this->nmax->setFormValue($val);
            }
        }

        // Check field name 'subkat' first before field var 'x_subkat'
        $val = $CurrentForm->hasValue("subkat") ? $CurrentForm->getValue("subkat") : $CurrentForm->getValue("x_subkat");
        if (!$this->subkat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->subkat->Visible = false; // Disable update for API request
            } else {
                $this->subkat->setFormValue($val);
            }
        }

        // Check field name 'bobot' first before field var 'x_bobot'
        $val = $CurrentForm->hasValue("bobot") ? $CurrentForm->getValue("bobot") : $CurrentForm->getValue("x_bobot");
        if (!$this->bobot->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot->Visible = false; // Disable update for API request
            } else {
                $this->bobot->setFormValue($val);
            }
        }

        // Check field name 'kat' first before field var 'x_kat'
        $val = $CurrentForm->hasValue("kat") ? $CurrentForm->getValue("kat") : $CurrentForm->getValue("x_kat");
        if (!$this->kat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kat->Visible = false; // Disable update for API request
            } else {
                $this->kat->setFormValue($val);
            }
        }

        // Check field name 'porsi' first before field var 'x_porsi'
        $val = $CurrentForm->hasValue("porsi") ? $CurrentForm->getValue("porsi") : $CurrentForm->getValue("x_porsi");
        if (!$this->porsi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->porsi->Visible = false; // Disable update for API request
            } else {
                $this->porsi->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->variabel->CurrentValue = $this->variabel->FormValue;
        $this->nmin->CurrentValue = $this->nmin->FormValue;
        $this->nmax->CurrentValue = $this->nmax->FormValue;
        $this->subkat->CurrentValue = $this->subkat->FormValue;
        $this->bobot->CurrentValue = $this->bobot->FormValue;
        $this->kat->CurrentValue = $this->kat->FormValue;
        $this->porsi->CurrentValue = $this->porsi->FormValue;
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
        $this->id->setDbValue($row['id']);
        $this->variabel->setDbValue($row['variabel']);
        $this->nmin->setDbValue($row['nmin']);
        $this->nmax->setDbValue($row['nmax']);
        $this->subkat->setDbValue($row['subkat']);
        $this->bobot->setDbValue($row['bobot']);
        $this->kat->setDbValue($row['kat']);
        $this->porsi->setDbValue($row['porsi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['variabel'] = null;
        $row['nmin'] = null;
        $row['nmax'] = null;
        $row['subkat'] = null;
        $row['bobot'] = null;
        $row['kat'] = null;
        $row['porsi'] = null;
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
        if ($this->nmin->FormValue == $this->nmin->CurrentValue && is_numeric(ConvertToFloatString($this->nmin->CurrentValue))) {
            $this->nmin->CurrentValue = ConvertToFloatString($this->nmin->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->nmax->FormValue == $this->nmax->CurrentValue && is_numeric(ConvertToFloatString($this->nmax->CurrentValue))) {
            $this->nmax->CurrentValue = ConvertToFloatString($this->nmax->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->bobot->FormValue == $this->bobot->CurrentValue && is_numeric(ConvertToFloatString($this->bobot->CurrentValue))) {
            $this->bobot->CurrentValue = ConvertToFloatString($this->bobot->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->porsi->FormValue == $this->porsi->CurrentValue && is_numeric(ConvertToFloatString($this->porsi->CurrentValue))) {
            $this->porsi->CurrentValue = ConvertToFloatString($this->porsi->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // variabel

        // nmin

        // nmax

        // subkat

        // bobot

        // kat

        // porsi
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // variabel
            $this->variabel->ViewValue = $this->variabel->CurrentValue;
            $this->variabel->ViewCustomAttributes = "";

            // nmin
            $this->nmin->ViewValue = $this->nmin->CurrentValue;
            $this->nmin->ViewValue = FormatNumber($this->nmin->ViewValue, 2, -2, -2, -2);
            $this->nmin->ViewCustomAttributes = "";

            // nmax
            $this->nmax->ViewValue = $this->nmax->CurrentValue;
            $this->nmax->ViewValue = FormatNumber($this->nmax->ViewValue, 2, -2, -2, -2);
            $this->nmax->ViewCustomAttributes = "";

            // subkat
            $this->subkat->ViewValue = $this->subkat->CurrentValue;
            $this->subkat->ViewCustomAttributes = "";

            // bobot
            $this->bobot->ViewValue = $this->bobot->CurrentValue;
            $this->bobot->ViewValue = FormatNumber($this->bobot->ViewValue, 2, -2, -2, -2);
            $this->bobot->ViewCustomAttributes = "";

            // kat
            $this->kat->ViewValue = $this->kat->CurrentValue;
            $this->kat->ViewCustomAttributes = "";

            // porsi
            $this->porsi->ViewValue = $this->porsi->CurrentValue;
            $this->porsi->ViewValue = FormatNumber($this->porsi->ViewValue, 2, -2, -2, -2);
            $this->porsi->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // variabel
            $this->variabel->LinkCustomAttributes = "";
            $this->variabel->HrefValue = "";
            $this->variabel->TooltipValue = "";

            // nmin
            $this->nmin->LinkCustomAttributes = "";
            $this->nmin->HrefValue = "";
            $this->nmin->TooltipValue = "";

            // nmax
            $this->nmax->LinkCustomAttributes = "";
            $this->nmax->HrefValue = "";
            $this->nmax->TooltipValue = "";

            // subkat
            $this->subkat->LinkCustomAttributes = "";
            $this->subkat->HrefValue = "";
            $this->subkat->TooltipValue = "";

            // bobot
            $this->bobot->LinkCustomAttributes = "";
            $this->bobot->HrefValue = "";
            $this->bobot->TooltipValue = "";

            // kat
            $this->kat->LinkCustomAttributes = "";
            $this->kat->HrefValue = "";
            $this->kat->TooltipValue = "";

            // porsi
            $this->porsi->LinkCustomAttributes = "";
            $this->porsi->HrefValue = "";
            $this->porsi->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // variabel
            $this->variabel->EditAttrs["class"] = "form-control";
            $this->variabel->EditCustomAttributes = "";
            if (!$this->variabel->Raw) {
                $this->variabel->CurrentValue = HtmlDecode($this->variabel->CurrentValue);
            }
            $this->variabel->EditValue = HtmlEncode($this->variabel->CurrentValue);
            $this->variabel->PlaceHolder = RemoveHtml($this->variabel->caption());

            // nmin
            $this->nmin->EditAttrs["class"] = "form-control";
            $this->nmin->EditCustomAttributes = "";
            $this->nmin->EditValue = HtmlEncode($this->nmin->CurrentValue);
            $this->nmin->PlaceHolder = RemoveHtml($this->nmin->caption());
            if (strval($this->nmin->EditValue) != "" && is_numeric($this->nmin->EditValue)) {
                $this->nmin->EditValue = FormatNumber($this->nmin->EditValue, -2, -2, -2, -2);
            }

            // nmax
            $this->nmax->EditAttrs["class"] = "form-control";
            $this->nmax->EditCustomAttributes = "";
            $this->nmax->EditValue = HtmlEncode($this->nmax->CurrentValue);
            $this->nmax->PlaceHolder = RemoveHtml($this->nmax->caption());
            if (strval($this->nmax->EditValue) != "" && is_numeric($this->nmax->EditValue)) {
                $this->nmax->EditValue = FormatNumber($this->nmax->EditValue, -2, -2, -2, -2);
            }

            // subkat
            $this->subkat->EditAttrs["class"] = "form-control";
            $this->subkat->EditCustomAttributes = "";
            if (!$this->subkat->Raw) {
                $this->subkat->CurrentValue = HtmlDecode($this->subkat->CurrentValue);
            }
            $this->subkat->EditValue = HtmlEncode($this->subkat->CurrentValue);
            $this->subkat->PlaceHolder = RemoveHtml($this->subkat->caption());

            // bobot
            $this->bobot->EditAttrs["class"] = "form-control";
            $this->bobot->EditCustomAttributes = "";
            $this->bobot->EditValue = HtmlEncode($this->bobot->CurrentValue);
            $this->bobot->PlaceHolder = RemoveHtml($this->bobot->caption());
            if (strval($this->bobot->EditValue) != "" && is_numeric($this->bobot->EditValue)) {
                $this->bobot->EditValue = FormatNumber($this->bobot->EditValue, -2, -2, -2, -2);
            }

            // kat
            $this->kat->EditAttrs["class"] = "form-control";
            $this->kat->EditCustomAttributes = "";
            if (!$this->kat->Raw) {
                $this->kat->CurrentValue = HtmlDecode($this->kat->CurrentValue);
            }
            $this->kat->EditValue = HtmlEncode($this->kat->CurrentValue);
            $this->kat->PlaceHolder = RemoveHtml($this->kat->caption());

            // porsi
            $this->porsi->EditAttrs["class"] = "form-control";
            $this->porsi->EditCustomAttributes = "";
            $this->porsi->EditValue = HtmlEncode($this->porsi->CurrentValue);
            $this->porsi->PlaceHolder = RemoveHtml($this->porsi->caption());
            if (strval($this->porsi->EditValue) != "" && is_numeric($this->porsi->EditValue)) {
                $this->porsi->EditValue = FormatNumber($this->porsi->EditValue, -2, -2, -2, -2);
            }

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // variabel
            $this->variabel->LinkCustomAttributes = "";
            $this->variabel->HrefValue = "";

            // nmin
            $this->nmin->LinkCustomAttributes = "";
            $this->nmin->HrefValue = "";

            // nmax
            $this->nmax->LinkCustomAttributes = "";
            $this->nmax->HrefValue = "";

            // subkat
            $this->subkat->LinkCustomAttributes = "";
            $this->subkat->HrefValue = "";

            // bobot
            $this->bobot->LinkCustomAttributes = "";
            $this->bobot->HrefValue = "";

            // kat
            $this->kat->LinkCustomAttributes = "";
            $this->kat->HrefValue = "";

            // porsi
            $this->porsi->LinkCustomAttributes = "";
            $this->porsi->HrefValue = "";
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
        if ($this->id->Required) {
            if (!$this->id->IsDetailKey && EmptyValue($this->id->FormValue)) {
                $this->id->addErrorMessage(str_replace("%s", $this->id->caption(), $this->id->RequiredErrorMessage));
            }
        }
        if ($this->variabel->Required) {
            if (!$this->variabel->IsDetailKey && EmptyValue($this->variabel->FormValue)) {
                $this->variabel->addErrorMessage(str_replace("%s", $this->variabel->caption(), $this->variabel->RequiredErrorMessage));
            }
        }
        if ($this->nmin->Required) {
            if (!$this->nmin->IsDetailKey && EmptyValue($this->nmin->FormValue)) {
                $this->nmin->addErrorMessage(str_replace("%s", $this->nmin->caption(), $this->nmin->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->nmin->FormValue)) {
            $this->nmin->addErrorMessage($this->nmin->getErrorMessage(false));
        }
        if ($this->nmax->Required) {
            if (!$this->nmax->IsDetailKey && EmptyValue($this->nmax->FormValue)) {
                $this->nmax->addErrorMessage(str_replace("%s", $this->nmax->caption(), $this->nmax->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->nmax->FormValue)) {
            $this->nmax->addErrorMessage($this->nmax->getErrorMessage(false));
        }
        if ($this->subkat->Required) {
            if (!$this->subkat->IsDetailKey && EmptyValue($this->subkat->FormValue)) {
                $this->subkat->addErrorMessage(str_replace("%s", $this->subkat->caption(), $this->subkat->RequiredErrorMessage));
            }
        }
        if ($this->bobot->Required) {
            if (!$this->bobot->IsDetailKey && EmptyValue($this->bobot->FormValue)) {
                $this->bobot->addErrorMessage(str_replace("%s", $this->bobot->caption(), $this->bobot->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->bobot->FormValue)) {
            $this->bobot->addErrorMessage($this->bobot->getErrorMessage(false));
        }
        if ($this->kat->Required) {
            if (!$this->kat->IsDetailKey && EmptyValue($this->kat->FormValue)) {
                $this->kat->addErrorMessage(str_replace("%s", $this->kat->caption(), $this->kat->RequiredErrorMessage));
            }
        }
        if ($this->porsi->Required) {
            if (!$this->porsi->IsDetailKey && EmptyValue($this->porsi->FormValue)) {
                $this->porsi->addErrorMessage(str_replace("%s", $this->porsi->caption(), $this->porsi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->porsi->FormValue)) {
            $this->porsi->addErrorMessage($this->porsi->getErrorMessage(false));
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

            // variabel
            $this->variabel->setDbValueDef($rsnew, $this->variabel->CurrentValue, null, $this->variabel->ReadOnly);

            // nmin
            $this->nmin->setDbValueDef($rsnew, $this->nmin->CurrentValue, null, $this->nmin->ReadOnly);

            // nmax
            $this->nmax->setDbValueDef($rsnew, $this->nmax->CurrentValue, null, $this->nmax->ReadOnly);

            // subkat
            $this->subkat->setDbValueDef($rsnew, $this->subkat->CurrentValue, null, $this->subkat->ReadOnly);

            // bobot
            $this->bobot->setDbValueDef($rsnew, $this->bobot->CurrentValue, null, $this->bobot->ReadOnly);

            // kat
            $this->kat->setDbValueDef($rsnew, $this->kat->CurrentValue, null, $this->kat->ReadOnly);

            // porsi
            $this->porsi->setDbValueDef($rsnew, $this->porsi->CurrentValue, null, $this->porsi->ReadOnly);

            // Call Row Updating event
            $updateRow = $this->rowUpdating($rsold, $rsnew);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmvariabellist"), "", $this->TableVar, true);
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
