<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKelembagaanEdit extends TempSkorKelembagaan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_kelembagaan';

    // Page object name
    public $PageObjName = "TempSkorKelembagaanEdit";

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

        // Table object (temp_skor_kelembagaan)
        if (!isset($GLOBALS["temp_skor_kelembagaan"]) || get_class($GLOBALS["temp_skor_kelembagaan"]) == PROJECT_NAMESPACE . "temp_skor_kelembagaan") {
            $GLOBALS["temp_skor_kelembagaan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_kelembagaan');
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
                $doc = new $class(Container("temp_skor_kelembagaan"));
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
                    if ($pageName == "tempskorkelembagaanview") {
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
        $this->skor_badanhukum->setVisibility();
        $this->max_badanhukum->setVisibility();
        $this->skor_izin->setVisibility();
        $this->max_izin->setVisibility();
        $this->skor_npwp->setVisibility();
        $this->max_npwp->setVisibility();
        $this->skor_struktur->setVisibility();
        $this->max_struktur->setVisibility();
        $this->skor_jobdesk->setVisibility();
        $this->max_jobdesk->setVisibility();
        $this->skor_iso->setVisibility();
        $this->max_iso->setVisibility();
        $this->skor_kelembagaan->setVisibility();
        $this->maxskor_kelembagaan->setVisibility();
        $this->bobot_kelembagaan->setVisibility();
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
                    $this->terminate("tempskorkelembagaanlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "tempskorkelembagaanlist") {
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

        // Check field name 'skor_badanhukum' first before field var 'x_skor_badanhukum'
        $val = $CurrentForm->hasValue("skor_badanhukum") ? $CurrentForm->getValue("skor_badanhukum") : $CurrentForm->getValue("x_skor_badanhukum");
        if (!$this->skor_badanhukum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_badanhukum->Visible = false; // Disable update for API request
            } else {
                $this->skor_badanhukum->setFormValue($val);
            }
        }

        // Check field name 'max_badanhukum' first before field var 'x_max_badanhukum'
        $val = $CurrentForm->hasValue("max_badanhukum") ? $CurrentForm->getValue("max_badanhukum") : $CurrentForm->getValue("x_max_badanhukum");
        if (!$this->max_badanhukum->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_badanhukum->Visible = false; // Disable update for API request
            } else {
                $this->max_badanhukum->setFormValue($val);
            }
        }

        // Check field name 'skor_izin' first before field var 'x_skor_izin'
        $val = $CurrentForm->hasValue("skor_izin") ? $CurrentForm->getValue("skor_izin") : $CurrentForm->getValue("x_skor_izin");
        if (!$this->skor_izin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_izin->Visible = false; // Disable update for API request
            } else {
                $this->skor_izin->setFormValue($val);
            }
        }

        // Check field name 'max_izin' first before field var 'x_max_izin'
        $val = $CurrentForm->hasValue("max_izin") ? $CurrentForm->getValue("max_izin") : $CurrentForm->getValue("x_max_izin");
        if (!$this->max_izin->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_izin->Visible = false; // Disable update for API request
            } else {
                $this->max_izin->setFormValue($val);
            }
        }

        // Check field name 'skor_npwp' first before field var 'x_skor_npwp'
        $val = $CurrentForm->hasValue("skor_npwp") ? $CurrentForm->getValue("skor_npwp") : $CurrentForm->getValue("x_skor_npwp");
        if (!$this->skor_npwp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_npwp->Visible = false; // Disable update for API request
            } else {
                $this->skor_npwp->setFormValue($val);
            }
        }

        // Check field name 'max_npwp' first before field var 'x_max_npwp'
        $val = $CurrentForm->hasValue("max_npwp") ? $CurrentForm->getValue("max_npwp") : $CurrentForm->getValue("x_max_npwp");
        if (!$this->max_npwp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_npwp->Visible = false; // Disable update for API request
            } else {
                $this->max_npwp->setFormValue($val);
            }
        }

        // Check field name 'skor_struktur' first before field var 'x_skor_struktur'
        $val = $CurrentForm->hasValue("skor_struktur") ? $CurrentForm->getValue("skor_struktur") : $CurrentForm->getValue("x_skor_struktur");
        if (!$this->skor_struktur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_struktur->Visible = false; // Disable update for API request
            } else {
                $this->skor_struktur->setFormValue($val);
            }
        }

        // Check field name 'max_struktur' first before field var 'x_max_struktur'
        $val = $CurrentForm->hasValue("max_struktur") ? $CurrentForm->getValue("max_struktur") : $CurrentForm->getValue("x_max_struktur");
        if (!$this->max_struktur->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_struktur->Visible = false; // Disable update for API request
            } else {
                $this->max_struktur->setFormValue($val);
            }
        }

        // Check field name 'skor_jobdesk' first before field var 'x_skor_jobdesk'
        $val = $CurrentForm->hasValue("skor_jobdesk") ? $CurrentForm->getValue("skor_jobdesk") : $CurrentForm->getValue("x_skor_jobdesk");
        if (!$this->skor_jobdesk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_jobdesk->Visible = false; // Disable update for API request
            } else {
                $this->skor_jobdesk->setFormValue($val);
            }
        }

        // Check field name 'max_jobdesk' first before field var 'x_max_jobdesk'
        $val = $CurrentForm->hasValue("max_jobdesk") ? $CurrentForm->getValue("max_jobdesk") : $CurrentForm->getValue("x_max_jobdesk");
        if (!$this->max_jobdesk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_jobdesk->Visible = false; // Disable update for API request
            } else {
                $this->max_jobdesk->setFormValue($val);
            }
        }

        // Check field name 'skor_iso' first before field var 'x_skor_iso'
        $val = $CurrentForm->hasValue("skor_iso") ? $CurrentForm->getValue("skor_iso") : $CurrentForm->getValue("x_skor_iso");
        if (!$this->skor_iso->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_iso->Visible = false; // Disable update for API request
            } else {
                $this->skor_iso->setFormValue($val);
            }
        }

        // Check field name 'max_iso' first before field var 'x_max_iso'
        $val = $CurrentForm->hasValue("max_iso") ? $CurrentForm->getValue("max_iso") : $CurrentForm->getValue("x_max_iso");
        if (!$this->max_iso->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_iso->Visible = false; // Disable update for API request
            } else {
                $this->max_iso->setFormValue($val);
            }
        }

        // Check field name 'skor_kelembagaan' first before field var 'x_skor_kelembagaan'
        $val = $CurrentForm->hasValue("skor_kelembagaan") ? $CurrentForm->getValue("skor_kelembagaan") : $CurrentForm->getValue("x_skor_kelembagaan");
        if (!$this->skor_kelembagaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_kelembagaan->Visible = false; // Disable update for API request
            } else {
                $this->skor_kelembagaan->setFormValue($val);
            }
        }

        // Check field name 'maxskor_kelembagaan' first before field var 'x_maxskor_kelembagaan'
        $val = $CurrentForm->hasValue("maxskor_kelembagaan") ? $CurrentForm->getValue("maxskor_kelembagaan") : $CurrentForm->getValue("x_maxskor_kelembagaan");
        if (!$this->maxskor_kelembagaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_kelembagaan->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_kelembagaan->setFormValue($val);
            }
        }

        // Check field name 'bobot_kelembagaan' first before field var 'x_bobot_kelembagaan'
        $val = $CurrentForm->hasValue("bobot_kelembagaan") ? $CurrentForm->getValue("bobot_kelembagaan") : $CurrentForm->getValue("x_bobot_kelembagaan");
        if (!$this->bobot_kelembagaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_kelembagaan->Visible = false; // Disable update for API request
            } else {
                $this->bobot_kelembagaan->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->skor_badanhukum->CurrentValue = $this->skor_badanhukum->FormValue;
        $this->max_badanhukum->CurrentValue = $this->max_badanhukum->FormValue;
        $this->skor_izin->CurrentValue = $this->skor_izin->FormValue;
        $this->max_izin->CurrentValue = $this->max_izin->FormValue;
        $this->skor_npwp->CurrentValue = $this->skor_npwp->FormValue;
        $this->max_npwp->CurrentValue = $this->max_npwp->FormValue;
        $this->skor_struktur->CurrentValue = $this->skor_struktur->FormValue;
        $this->max_struktur->CurrentValue = $this->max_struktur->FormValue;
        $this->skor_jobdesk->CurrentValue = $this->skor_jobdesk->FormValue;
        $this->max_jobdesk->CurrentValue = $this->max_jobdesk->FormValue;
        $this->skor_iso->CurrentValue = $this->skor_iso->FormValue;
        $this->max_iso->CurrentValue = $this->max_iso->FormValue;
        $this->skor_kelembagaan->CurrentValue = $this->skor_kelembagaan->FormValue;
        $this->maxskor_kelembagaan->CurrentValue = $this->maxskor_kelembagaan->FormValue;
        $this->bobot_kelembagaan->CurrentValue = $this->bobot_kelembagaan->FormValue;
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
        $this->skor_badanhukum->setDbValue($row['skor_badanhukum']);
        $this->max_badanhukum->setDbValue($row['max_badanhukum']);
        $this->skor_izin->setDbValue($row['skor_izin']);
        $this->max_izin->setDbValue($row['max_izin']);
        $this->skor_npwp->setDbValue($row['skor_npwp']);
        $this->max_npwp->setDbValue($row['max_npwp']);
        $this->skor_struktur->setDbValue($row['skor_struktur']);
        $this->max_struktur->setDbValue($row['max_struktur']);
        $this->skor_jobdesk->setDbValue($row['skor_jobdesk']);
        $this->max_jobdesk->setDbValue($row['max_jobdesk']);
        $this->skor_iso->setDbValue($row['skor_iso']);
        $this->max_iso->setDbValue($row['max_iso']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_badanhukum'] = null;
        $row['max_badanhukum'] = null;
        $row['skor_izin'] = null;
        $row['max_izin'] = null;
        $row['skor_npwp'] = null;
        $row['max_npwp'] = null;
        $row['skor_struktur'] = null;
        $row['max_struktur'] = null;
        $row['skor_jobdesk'] = null;
        $row['max_jobdesk'] = null;
        $row['skor_iso'] = null;
        $row['max_iso'] = null;
        $row['skor_kelembagaan'] = null;
        $row['maxskor_kelembagaan'] = null;
        $row['bobot_kelembagaan'] = null;
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
        if ($this->skor_badanhukum->FormValue == $this->skor_badanhukum->CurrentValue && is_numeric(ConvertToFloatString($this->skor_badanhukum->CurrentValue))) {
            $this->skor_badanhukum->CurrentValue = ConvertToFloatString($this->skor_badanhukum->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_badanhukum->FormValue == $this->max_badanhukum->CurrentValue && is_numeric(ConvertToFloatString($this->max_badanhukum->CurrentValue))) {
            $this->max_badanhukum->CurrentValue = ConvertToFloatString($this->max_badanhukum->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_izin->FormValue == $this->skor_izin->CurrentValue && is_numeric(ConvertToFloatString($this->skor_izin->CurrentValue))) {
            $this->skor_izin->CurrentValue = ConvertToFloatString($this->skor_izin->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_izin->FormValue == $this->max_izin->CurrentValue && is_numeric(ConvertToFloatString($this->max_izin->CurrentValue))) {
            $this->max_izin->CurrentValue = ConvertToFloatString($this->max_izin->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_npwp->FormValue == $this->skor_npwp->CurrentValue && is_numeric(ConvertToFloatString($this->skor_npwp->CurrentValue))) {
            $this->skor_npwp->CurrentValue = ConvertToFloatString($this->skor_npwp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_npwp->FormValue == $this->max_npwp->CurrentValue && is_numeric(ConvertToFloatString($this->max_npwp->CurrentValue))) {
            $this->max_npwp->CurrentValue = ConvertToFloatString($this->max_npwp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_struktur->FormValue == $this->skor_struktur->CurrentValue && is_numeric(ConvertToFloatString($this->skor_struktur->CurrentValue))) {
            $this->skor_struktur->CurrentValue = ConvertToFloatString($this->skor_struktur->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_struktur->FormValue == $this->max_struktur->CurrentValue && is_numeric(ConvertToFloatString($this->max_struktur->CurrentValue))) {
            $this->max_struktur->CurrentValue = ConvertToFloatString($this->max_struktur->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_jobdesk->FormValue == $this->skor_jobdesk->CurrentValue && is_numeric(ConvertToFloatString($this->skor_jobdesk->CurrentValue))) {
            $this->skor_jobdesk->CurrentValue = ConvertToFloatString($this->skor_jobdesk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_jobdesk->FormValue == $this->max_jobdesk->CurrentValue && is_numeric(ConvertToFloatString($this->max_jobdesk->CurrentValue))) {
            $this->max_jobdesk->CurrentValue = ConvertToFloatString($this->max_jobdesk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_iso->FormValue == $this->skor_iso->CurrentValue && is_numeric(ConvertToFloatString($this->skor_iso->CurrentValue))) {
            $this->skor_iso->CurrentValue = ConvertToFloatString($this->skor_iso->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_iso->FormValue == $this->max_iso->CurrentValue && is_numeric(ConvertToFloatString($this->max_iso->CurrentValue))) {
            $this->max_iso->CurrentValue = ConvertToFloatString($this->max_iso->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelembagaan->FormValue == $this->skor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelembagaan->CurrentValue))) {
            $this->skor_kelembagaan->CurrentValue = ConvertToFloatString($this->skor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelembagaan->FormValue == $this->maxskor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue))) {
            $this->maxskor_kelembagaan->CurrentValue = ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_badanhukum

        // max_badanhukum

        // skor_izin

        // max_izin

        // skor_npwp

        // max_npwp

        // skor_struktur

        // max_struktur

        // skor_jobdesk

        // max_jobdesk

        // skor_iso

        // max_iso

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_badanhukum
            $this->skor_badanhukum->ViewValue = $this->skor_badanhukum->CurrentValue;
            $this->skor_badanhukum->ViewValue = FormatNumber($this->skor_badanhukum->ViewValue, 2, -2, -2, -2);
            $this->skor_badanhukum->ViewCustomAttributes = "";

            // max_badanhukum
            $this->max_badanhukum->ViewValue = $this->max_badanhukum->CurrentValue;
            $this->max_badanhukum->ViewValue = FormatNumber($this->max_badanhukum->ViewValue, 2, -2, -2, -2);
            $this->max_badanhukum->ViewCustomAttributes = "";

            // skor_izin
            $this->skor_izin->ViewValue = $this->skor_izin->CurrentValue;
            $this->skor_izin->ViewValue = FormatNumber($this->skor_izin->ViewValue, 2, -2, -2, -2);
            $this->skor_izin->ViewCustomAttributes = "";

            // max_izin
            $this->max_izin->ViewValue = $this->max_izin->CurrentValue;
            $this->max_izin->ViewValue = FormatNumber($this->max_izin->ViewValue, 2, -2, -2, -2);
            $this->max_izin->ViewCustomAttributes = "";

            // skor_npwp
            $this->skor_npwp->ViewValue = $this->skor_npwp->CurrentValue;
            $this->skor_npwp->ViewValue = FormatNumber($this->skor_npwp->ViewValue, 2, -2, -2, -2);
            $this->skor_npwp->ViewCustomAttributes = "";

            // max_npwp
            $this->max_npwp->ViewValue = $this->max_npwp->CurrentValue;
            $this->max_npwp->ViewValue = FormatNumber($this->max_npwp->ViewValue, 2, -2, -2, -2);
            $this->max_npwp->ViewCustomAttributes = "";

            // skor_struktur
            $this->skor_struktur->ViewValue = $this->skor_struktur->CurrentValue;
            $this->skor_struktur->ViewValue = FormatNumber($this->skor_struktur->ViewValue, 2, -2, -2, -2);
            $this->skor_struktur->ViewCustomAttributes = "";

            // max_struktur
            $this->max_struktur->ViewValue = $this->max_struktur->CurrentValue;
            $this->max_struktur->ViewValue = FormatNumber($this->max_struktur->ViewValue, 2, -2, -2, -2);
            $this->max_struktur->ViewCustomAttributes = "";

            // skor_jobdesk
            $this->skor_jobdesk->ViewValue = $this->skor_jobdesk->CurrentValue;
            $this->skor_jobdesk->ViewValue = FormatNumber($this->skor_jobdesk->ViewValue, 2, -2, -2, -2);
            $this->skor_jobdesk->ViewCustomAttributes = "";

            // max_jobdesk
            $this->max_jobdesk->ViewValue = $this->max_jobdesk->CurrentValue;
            $this->max_jobdesk->ViewValue = FormatNumber($this->max_jobdesk->ViewValue, 2, -2, -2, -2);
            $this->max_jobdesk->ViewCustomAttributes = "";

            // skor_iso
            $this->skor_iso->ViewValue = $this->skor_iso->CurrentValue;
            $this->skor_iso->ViewValue = FormatNumber($this->skor_iso->ViewValue, 2, -2, -2, -2);
            $this->skor_iso->ViewCustomAttributes = "";

            // max_iso
            $this->max_iso->ViewValue = $this->max_iso->CurrentValue;
            $this->max_iso->ViewValue = FormatNumber($this->max_iso->ViewValue, 2, -2, -2, -2);
            $this->max_iso->ViewCustomAttributes = "";

            // skor_kelembagaan
            $this->skor_kelembagaan->ViewValue = $this->skor_kelembagaan->CurrentValue;
            $this->skor_kelembagaan->ViewValue = FormatNumber($this->skor_kelembagaan->ViewValue, 2, -2, -2, -2);
            $this->skor_kelembagaan->ViewCustomAttributes = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->ViewValue = $this->maxskor_kelembagaan->CurrentValue;
            $this->maxskor_kelembagaan->ViewValue = FormatNumber($this->maxskor_kelembagaan->ViewValue, 2, -2, -2, -2);
            $this->maxskor_kelembagaan->ViewCustomAttributes = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->ViewValue = $this->bobot_kelembagaan->CurrentValue;
            $this->bobot_kelembagaan->ViewValue = FormatNumber($this->bobot_kelembagaan->ViewValue, 0, -2, -2, -2);
            $this->bobot_kelembagaan->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_badanhukum
            $this->skor_badanhukum->LinkCustomAttributes = "";
            $this->skor_badanhukum->HrefValue = "";
            $this->skor_badanhukum->TooltipValue = "";

            // max_badanhukum
            $this->max_badanhukum->LinkCustomAttributes = "";
            $this->max_badanhukum->HrefValue = "";
            $this->max_badanhukum->TooltipValue = "";

            // skor_izin
            $this->skor_izin->LinkCustomAttributes = "";
            $this->skor_izin->HrefValue = "";
            $this->skor_izin->TooltipValue = "";

            // max_izin
            $this->max_izin->LinkCustomAttributes = "";
            $this->max_izin->HrefValue = "";
            $this->max_izin->TooltipValue = "";

            // skor_npwp
            $this->skor_npwp->LinkCustomAttributes = "";
            $this->skor_npwp->HrefValue = "";
            $this->skor_npwp->TooltipValue = "";

            // max_npwp
            $this->max_npwp->LinkCustomAttributes = "";
            $this->max_npwp->HrefValue = "";
            $this->max_npwp->TooltipValue = "";

            // skor_struktur
            $this->skor_struktur->LinkCustomAttributes = "";
            $this->skor_struktur->HrefValue = "";
            $this->skor_struktur->TooltipValue = "";

            // max_struktur
            $this->max_struktur->LinkCustomAttributes = "";
            $this->max_struktur->HrefValue = "";
            $this->max_struktur->TooltipValue = "";

            // skor_jobdesk
            $this->skor_jobdesk->LinkCustomAttributes = "";
            $this->skor_jobdesk->HrefValue = "";
            $this->skor_jobdesk->TooltipValue = "";

            // max_jobdesk
            $this->max_jobdesk->LinkCustomAttributes = "";
            $this->max_jobdesk->HrefValue = "";
            $this->max_jobdesk->TooltipValue = "";

            // skor_iso
            $this->skor_iso->LinkCustomAttributes = "";
            $this->skor_iso->HrefValue = "";
            $this->skor_iso->TooltipValue = "";

            // max_iso
            $this->max_iso->LinkCustomAttributes = "";
            $this->max_iso->HrefValue = "";
            $this->max_iso->TooltipValue = "";

            // skor_kelembagaan
            $this->skor_kelembagaan->LinkCustomAttributes = "";
            $this->skor_kelembagaan->HrefValue = "";
            $this->skor_kelembagaan->TooltipValue = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->LinkCustomAttributes = "";
            $this->maxskor_kelembagaan->HrefValue = "";
            $this->maxskor_kelembagaan->TooltipValue = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->LinkCustomAttributes = "";
            $this->bobot_kelembagaan->HrefValue = "";
            $this->bobot_kelembagaan->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // skor_badanhukum
            $this->skor_badanhukum->EditAttrs["class"] = "form-control";
            $this->skor_badanhukum->EditCustomAttributes = "";
            $this->skor_badanhukum->EditValue = HtmlEncode($this->skor_badanhukum->CurrentValue);
            $this->skor_badanhukum->PlaceHolder = RemoveHtml($this->skor_badanhukum->caption());
            if (strval($this->skor_badanhukum->EditValue) != "" && is_numeric($this->skor_badanhukum->EditValue)) {
                $this->skor_badanhukum->EditValue = FormatNumber($this->skor_badanhukum->EditValue, -2, -2, -2, -2);
            }

            // max_badanhukum
            $this->max_badanhukum->EditAttrs["class"] = "form-control";
            $this->max_badanhukum->EditCustomAttributes = "";
            $this->max_badanhukum->EditValue = HtmlEncode($this->max_badanhukum->CurrentValue);
            $this->max_badanhukum->PlaceHolder = RemoveHtml($this->max_badanhukum->caption());
            if (strval($this->max_badanhukum->EditValue) != "" && is_numeric($this->max_badanhukum->EditValue)) {
                $this->max_badanhukum->EditValue = FormatNumber($this->max_badanhukum->EditValue, -2, -2, -2, -2);
            }

            // skor_izin
            $this->skor_izin->EditAttrs["class"] = "form-control";
            $this->skor_izin->EditCustomAttributes = "";
            $this->skor_izin->EditValue = HtmlEncode($this->skor_izin->CurrentValue);
            $this->skor_izin->PlaceHolder = RemoveHtml($this->skor_izin->caption());
            if (strval($this->skor_izin->EditValue) != "" && is_numeric($this->skor_izin->EditValue)) {
                $this->skor_izin->EditValue = FormatNumber($this->skor_izin->EditValue, -2, -2, -2, -2);
            }

            // max_izin
            $this->max_izin->EditAttrs["class"] = "form-control";
            $this->max_izin->EditCustomAttributes = "";
            $this->max_izin->EditValue = HtmlEncode($this->max_izin->CurrentValue);
            $this->max_izin->PlaceHolder = RemoveHtml($this->max_izin->caption());
            if (strval($this->max_izin->EditValue) != "" && is_numeric($this->max_izin->EditValue)) {
                $this->max_izin->EditValue = FormatNumber($this->max_izin->EditValue, -2, -2, -2, -2);
            }

            // skor_npwp
            $this->skor_npwp->EditAttrs["class"] = "form-control";
            $this->skor_npwp->EditCustomAttributes = "";
            $this->skor_npwp->EditValue = HtmlEncode($this->skor_npwp->CurrentValue);
            $this->skor_npwp->PlaceHolder = RemoveHtml($this->skor_npwp->caption());
            if (strval($this->skor_npwp->EditValue) != "" && is_numeric($this->skor_npwp->EditValue)) {
                $this->skor_npwp->EditValue = FormatNumber($this->skor_npwp->EditValue, -2, -2, -2, -2);
            }

            // max_npwp
            $this->max_npwp->EditAttrs["class"] = "form-control";
            $this->max_npwp->EditCustomAttributes = "";
            $this->max_npwp->EditValue = HtmlEncode($this->max_npwp->CurrentValue);
            $this->max_npwp->PlaceHolder = RemoveHtml($this->max_npwp->caption());
            if (strval($this->max_npwp->EditValue) != "" && is_numeric($this->max_npwp->EditValue)) {
                $this->max_npwp->EditValue = FormatNumber($this->max_npwp->EditValue, -2, -2, -2, -2);
            }

            // skor_struktur
            $this->skor_struktur->EditAttrs["class"] = "form-control";
            $this->skor_struktur->EditCustomAttributes = "";
            $this->skor_struktur->EditValue = HtmlEncode($this->skor_struktur->CurrentValue);
            $this->skor_struktur->PlaceHolder = RemoveHtml($this->skor_struktur->caption());
            if (strval($this->skor_struktur->EditValue) != "" && is_numeric($this->skor_struktur->EditValue)) {
                $this->skor_struktur->EditValue = FormatNumber($this->skor_struktur->EditValue, -2, -2, -2, -2);
            }

            // max_struktur
            $this->max_struktur->EditAttrs["class"] = "form-control";
            $this->max_struktur->EditCustomAttributes = "";
            $this->max_struktur->EditValue = HtmlEncode($this->max_struktur->CurrentValue);
            $this->max_struktur->PlaceHolder = RemoveHtml($this->max_struktur->caption());
            if (strval($this->max_struktur->EditValue) != "" && is_numeric($this->max_struktur->EditValue)) {
                $this->max_struktur->EditValue = FormatNumber($this->max_struktur->EditValue, -2, -2, -2, -2);
            }

            // skor_jobdesk
            $this->skor_jobdesk->EditAttrs["class"] = "form-control";
            $this->skor_jobdesk->EditCustomAttributes = "";
            $this->skor_jobdesk->EditValue = HtmlEncode($this->skor_jobdesk->CurrentValue);
            $this->skor_jobdesk->PlaceHolder = RemoveHtml($this->skor_jobdesk->caption());
            if (strval($this->skor_jobdesk->EditValue) != "" && is_numeric($this->skor_jobdesk->EditValue)) {
                $this->skor_jobdesk->EditValue = FormatNumber($this->skor_jobdesk->EditValue, -2, -2, -2, -2);
            }

            // max_jobdesk
            $this->max_jobdesk->EditAttrs["class"] = "form-control";
            $this->max_jobdesk->EditCustomAttributes = "";
            $this->max_jobdesk->EditValue = HtmlEncode($this->max_jobdesk->CurrentValue);
            $this->max_jobdesk->PlaceHolder = RemoveHtml($this->max_jobdesk->caption());
            if (strval($this->max_jobdesk->EditValue) != "" && is_numeric($this->max_jobdesk->EditValue)) {
                $this->max_jobdesk->EditValue = FormatNumber($this->max_jobdesk->EditValue, -2, -2, -2, -2);
            }

            // skor_iso
            $this->skor_iso->EditAttrs["class"] = "form-control";
            $this->skor_iso->EditCustomAttributes = "";
            $this->skor_iso->EditValue = HtmlEncode($this->skor_iso->CurrentValue);
            $this->skor_iso->PlaceHolder = RemoveHtml($this->skor_iso->caption());
            if (strval($this->skor_iso->EditValue) != "" && is_numeric($this->skor_iso->EditValue)) {
                $this->skor_iso->EditValue = FormatNumber($this->skor_iso->EditValue, -2, -2, -2, -2);
            }

            // max_iso
            $this->max_iso->EditAttrs["class"] = "form-control";
            $this->max_iso->EditCustomAttributes = "";
            $this->max_iso->EditValue = HtmlEncode($this->max_iso->CurrentValue);
            $this->max_iso->PlaceHolder = RemoveHtml($this->max_iso->caption());
            if (strval($this->max_iso->EditValue) != "" && is_numeric($this->max_iso->EditValue)) {
                $this->max_iso->EditValue = FormatNumber($this->max_iso->EditValue, -2, -2, -2, -2);
            }

            // skor_kelembagaan
            $this->skor_kelembagaan->EditAttrs["class"] = "form-control";
            $this->skor_kelembagaan->EditCustomAttributes = "";
            $this->skor_kelembagaan->EditValue = HtmlEncode($this->skor_kelembagaan->CurrentValue);
            $this->skor_kelembagaan->PlaceHolder = RemoveHtml($this->skor_kelembagaan->caption());
            if (strval($this->skor_kelembagaan->EditValue) != "" && is_numeric($this->skor_kelembagaan->EditValue)) {
                $this->skor_kelembagaan->EditValue = FormatNumber($this->skor_kelembagaan->EditValue, -2, -2, -2, -2);
            }

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->EditAttrs["class"] = "form-control";
            $this->maxskor_kelembagaan->EditCustomAttributes = "";
            $this->maxskor_kelembagaan->EditValue = HtmlEncode($this->maxskor_kelembagaan->CurrentValue);
            $this->maxskor_kelembagaan->PlaceHolder = RemoveHtml($this->maxskor_kelembagaan->caption());
            if (strval($this->maxskor_kelembagaan->EditValue) != "" && is_numeric($this->maxskor_kelembagaan->EditValue)) {
                $this->maxskor_kelembagaan->EditValue = FormatNumber($this->maxskor_kelembagaan->EditValue, -2, -2, -2, -2);
            }

            // bobot_kelembagaan
            $this->bobot_kelembagaan->EditAttrs["class"] = "form-control";
            $this->bobot_kelembagaan->EditCustomAttributes = "";
            $this->bobot_kelembagaan->EditValue = HtmlEncode($this->bobot_kelembagaan->CurrentValue);
            $this->bobot_kelembagaan->PlaceHolder = RemoveHtml($this->bobot_kelembagaan->caption());

            // Edit refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // skor_badanhukum
            $this->skor_badanhukum->LinkCustomAttributes = "";
            $this->skor_badanhukum->HrefValue = "";

            // max_badanhukum
            $this->max_badanhukum->LinkCustomAttributes = "";
            $this->max_badanhukum->HrefValue = "";

            // skor_izin
            $this->skor_izin->LinkCustomAttributes = "";
            $this->skor_izin->HrefValue = "";

            // max_izin
            $this->max_izin->LinkCustomAttributes = "";
            $this->max_izin->HrefValue = "";

            // skor_npwp
            $this->skor_npwp->LinkCustomAttributes = "";
            $this->skor_npwp->HrefValue = "";

            // max_npwp
            $this->max_npwp->LinkCustomAttributes = "";
            $this->max_npwp->HrefValue = "";

            // skor_struktur
            $this->skor_struktur->LinkCustomAttributes = "";
            $this->skor_struktur->HrefValue = "";

            // max_struktur
            $this->max_struktur->LinkCustomAttributes = "";
            $this->max_struktur->HrefValue = "";

            // skor_jobdesk
            $this->skor_jobdesk->LinkCustomAttributes = "";
            $this->skor_jobdesk->HrefValue = "";

            // max_jobdesk
            $this->max_jobdesk->LinkCustomAttributes = "";
            $this->max_jobdesk->HrefValue = "";

            // skor_iso
            $this->skor_iso->LinkCustomAttributes = "";
            $this->skor_iso->HrefValue = "";

            // max_iso
            $this->max_iso->LinkCustomAttributes = "";
            $this->max_iso->HrefValue = "";

            // skor_kelembagaan
            $this->skor_kelembagaan->LinkCustomAttributes = "";
            $this->skor_kelembagaan->HrefValue = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->LinkCustomAttributes = "";
            $this->maxskor_kelembagaan->HrefValue = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->LinkCustomAttributes = "";
            $this->bobot_kelembagaan->HrefValue = "";
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
        if ($this->skor_badanhukum->Required) {
            if (!$this->skor_badanhukum->IsDetailKey && EmptyValue($this->skor_badanhukum->FormValue)) {
                $this->skor_badanhukum->addErrorMessage(str_replace("%s", $this->skor_badanhukum->caption(), $this->skor_badanhukum->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_badanhukum->FormValue)) {
            $this->skor_badanhukum->addErrorMessage($this->skor_badanhukum->getErrorMessage(false));
        }
        if ($this->max_badanhukum->Required) {
            if (!$this->max_badanhukum->IsDetailKey && EmptyValue($this->max_badanhukum->FormValue)) {
                $this->max_badanhukum->addErrorMessage(str_replace("%s", $this->max_badanhukum->caption(), $this->max_badanhukum->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_badanhukum->FormValue)) {
            $this->max_badanhukum->addErrorMessage($this->max_badanhukum->getErrorMessage(false));
        }
        if ($this->skor_izin->Required) {
            if (!$this->skor_izin->IsDetailKey && EmptyValue($this->skor_izin->FormValue)) {
                $this->skor_izin->addErrorMessage(str_replace("%s", $this->skor_izin->caption(), $this->skor_izin->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_izin->FormValue)) {
            $this->skor_izin->addErrorMessage($this->skor_izin->getErrorMessage(false));
        }
        if ($this->max_izin->Required) {
            if (!$this->max_izin->IsDetailKey && EmptyValue($this->max_izin->FormValue)) {
                $this->max_izin->addErrorMessage(str_replace("%s", $this->max_izin->caption(), $this->max_izin->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_izin->FormValue)) {
            $this->max_izin->addErrorMessage($this->max_izin->getErrorMessage(false));
        }
        if ($this->skor_npwp->Required) {
            if (!$this->skor_npwp->IsDetailKey && EmptyValue($this->skor_npwp->FormValue)) {
                $this->skor_npwp->addErrorMessage(str_replace("%s", $this->skor_npwp->caption(), $this->skor_npwp->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_npwp->FormValue)) {
            $this->skor_npwp->addErrorMessage($this->skor_npwp->getErrorMessage(false));
        }
        if ($this->max_npwp->Required) {
            if (!$this->max_npwp->IsDetailKey && EmptyValue($this->max_npwp->FormValue)) {
                $this->max_npwp->addErrorMessage(str_replace("%s", $this->max_npwp->caption(), $this->max_npwp->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_npwp->FormValue)) {
            $this->max_npwp->addErrorMessage($this->max_npwp->getErrorMessage(false));
        }
        if ($this->skor_struktur->Required) {
            if (!$this->skor_struktur->IsDetailKey && EmptyValue($this->skor_struktur->FormValue)) {
                $this->skor_struktur->addErrorMessage(str_replace("%s", $this->skor_struktur->caption(), $this->skor_struktur->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_struktur->FormValue)) {
            $this->skor_struktur->addErrorMessage($this->skor_struktur->getErrorMessage(false));
        }
        if ($this->max_struktur->Required) {
            if (!$this->max_struktur->IsDetailKey && EmptyValue($this->max_struktur->FormValue)) {
                $this->max_struktur->addErrorMessage(str_replace("%s", $this->max_struktur->caption(), $this->max_struktur->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_struktur->FormValue)) {
            $this->max_struktur->addErrorMessage($this->max_struktur->getErrorMessage(false));
        }
        if ($this->skor_jobdesk->Required) {
            if (!$this->skor_jobdesk->IsDetailKey && EmptyValue($this->skor_jobdesk->FormValue)) {
                $this->skor_jobdesk->addErrorMessage(str_replace("%s", $this->skor_jobdesk->caption(), $this->skor_jobdesk->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_jobdesk->FormValue)) {
            $this->skor_jobdesk->addErrorMessage($this->skor_jobdesk->getErrorMessage(false));
        }
        if ($this->max_jobdesk->Required) {
            if (!$this->max_jobdesk->IsDetailKey && EmptyValue($this->max_jobdesk->FormValue)) {
                $this->max_jobdesk->addErrorMessage(str_replace("%s", $this->max_jobdesk->caption(), $this->max_jobdesk->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_jobdesk->FormValue)) {
            $this->max_jobdesk->addErrorMessage($this->max_jobdesk->getErrorMessage(false));
        }
        if ($this->skor_iso->Required) {
            if (!$this->skor_iso->IsDetailKey && EmptyValue($this->skor_iso->FormValue)) {
                $this->skor_iso->addErrorMessage(str_replace("%s", $this->skor_iso->caption(), $this->skor_iso->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_iso->FormValue)) {
            $this->skor_iso->addErrorMessage($this->skor_iso->getErrorMessage(false));
        }
        if ($this->max_iso->Required) {
            if (!$this->max_iso->IsDetailKey && EmptyValue($this->max_iso->FormValue)) {
                $this->max_iso->addErrorMessage(str_replace("%s", $this->max_iso->caption(), $this->max_iso->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_iso->FormValue)) {
            $this->max_iso->addErrorMessage($this->max_iso->getErrorMessage(false));
        }
        if ($this->skor_kelembagaan->Required) {
            if (!$this->skor_kelembagaan->IsDetailKey && EmptyValue($this->skor_kelembagaan->FormValue)) {
                $this->skor_kelembagaan->addErrorMessage(str_replace("%s", $this->skor_kelembagaan->caption(), $this->skor_kelembagaan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_kelembagaan->FormValue)) {
            $this->skor_kelembagaan->addErrorMessage($this->skor_kelembagaan->getErrorMessage(false));
        }
        if ($this->maxskor_kelembagaan->Required) {
            if (!$this->maxskor_kelembagaan->IsDetailKey && EmptyValue($this->maxskor_kelembagaan->FormValue)) {
                $this->maxskor_kelembagaan->addErrorMessage(str_replace("%s", $this->maxskor_kelembagaan->caption(), $this->maxskor_kelembagaan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_kelembagaan->FormValue)) {
            $this->maxskor_kelembagaan->addErrorMessage($this->maxskor_kelembagaan->getErrorMessage(false));
        }
        if ($this->bobot_kelembagaan->Required) {
            if (!$this->bobot_kelembagaan->IsDetailKey && EmptyValue($this->bobot_kelembagaan->FormValue)) {
                $this->bobot_kelembagaan->addErrorMessage(str_replace("%s", $this->bobot_kelembagaan->caption(), $this->bobot_kelembagaan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_kelembagaan->FormValue)) {
            $this->bobot_kelembagaan->addErrorMessage($this->bobot_kelembagaan->getErrorMessage(false));
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

            // skor_badanhukum
            $this->skor_badanhukum->setDbValueDef($rsnew, $this->skor_badanhukum->CurrentValue, null, $this->skor_badanhukum->ReadOnly);

            // max_badanhukum
            $this->max_badanhukum->setDbValueDef($rsnew, $this->max_badanhukum->CurrentValue, null, $this->max_badanhukum->ReadOnly);

            // skor_izin
            $this->skor_izin->setDbValueDef($rsnew, $this->skor_izin->CurrentValue, null, $this->skor_izin->ReadOnly);

            // max_izin
            $this->max_izin->setDbValueDef($rsnew, $this->max_izin->CurrentValue, null, $this->max_izin->ReadOnly);

            // skor_npwp
            $this->skor_npwp->setDbValueDef($rsnew, $this->skor_npwp->CurrentValue, null, $this->skor_npwp->ReadOnly);

            // max_npwp
            $this->max_npwp->setDbValueDef($rsnew, $this->max_npwp->CurrentValue, null, $this->max_npwp->ReadOnly);

            // skor_struktur
            $this->skor_struktur->setDbValueDef($rsnew, $this->skor_struktur->CurrentValue, null, $this->skor_struktur->ReadOnly);

            // max_struktur
            $this->max_struktur->setDbValueDef($rsnew, $this->max_struktur->CurrentValue, null, $this->max_struktur->ReadOnly);

            // skor_jobdesk
            $this->skor_jobdesk->setDbValueDef($rsnew, $this->skor_jobdesk->CurrentValue, null, $this->skor_jobdesk->ReadOnly);

            // max_jobdesk
            $this->max_jobdesk->setDbValueDef($rsnew, $this->max_jobdesk->CurrentValue, null, $this->max_jobdesk->ReadOnly);

            // skor_iso
            $this->skor_iso->setDbValueDef($rsnew, $this->skor_iso->CurrentValue, null, $this->skor_iso->ReadOnly);

            // max_iso
            $this->max_iso->setDbValueDef($rsnew, $this->max_iso->CurrentValue, null, $this->max_iso->ReadOnly);

            // skor_kelembagaan
            $this->skor_kelembagaan->setDbValueDef($rsnew, $this->skor_kelembagaan->CurrentValue, null, $this->skor_kelembagaan->ReadOnly);

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->setDbValueDef($rsnew, $this->maxskor_kelembagaan->CurrentValue, null, $this->maxskor_kelembagaan->ReadOnly);

            // bobot_kelembagaan
            $this->bobot_kelembagaan->setDbValueDef($rsnew, $this->bobot_kelembagaan->CurrentValue, 0, $this->bobot_kelembagaan->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkelembagaanlist"), "", $this->TableVar, true);
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
