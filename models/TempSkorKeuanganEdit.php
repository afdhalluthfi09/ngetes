<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKeuanganEdit extends TempSkorKeuangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_keuangan';

    // Page object name
    public $PageObjName = "TempSkorKeuanganEdit";

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

        // Table object (temp_skor_keuangan)
        if (!isset($GLOBALS["temp_skor_keuangan"]) || get_class($GLOBALS["temp_skor_keuangan"]) == PROJECT_NAMESPACE . "temp_skor_keuangan") {
            $GLOBALS["temp_skor_keuangan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_keuangan');
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
                $doc = new $class(Container("temp_skor_keuangan"));
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
                    if ($pageName == "tempskorkeuanganview") {
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
        $this->skor_income->setVisibility();
        $this->max_income->setVisibility();
        $this->skor_pengelolaan->setVisibility();
        $this->max_pengelolaan->setVisibility();
        $this->skor_nota->setVisibility();
        $this->max_nota->setVisibility();
        $this->skor_jurnal->setVisibility();
        $this->max_jurnal->setVisibility();
        $this->skor_akutansi->setVisibility();
        $this->max_akutansi->setVisibility();
        $this->skor_utangbank->setVisibility();
        $this->max_utangbank->setVisibility();
        $this->skor_dokumentasi->setVisibility();
        $this->max_dokumentasi->setVisibility();
        $this->skor_nontunai->setVisibility();
        $this->max_nontunai->setVisibility();
        $this->skor_keuangan->setVisibility();
        $this->maxskor_keuangan->setVisibility();
        $this->bobot_keuangan->setVisibility();
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
                    $this->terminate("tempskorkeuanganlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "tempskorkeuanganlist") {
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

        // Check field name 'skor_income' first before field var 'x_skor_income'
        $val = $CurrentForm->hasValue("skor_income") ? $CurrentForm->getValue("skor_income") : $CurrentForm->getValue("x_skor_income");
        if (!$this->skor_income->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_income->Visible = false; // Disable update for API request
            } else {
                $this->skor_income->setFormValue($val);
            }
        }

        // Check field name 'max_income' first before field var 'x_max_income'
        $val = $CurrentForm->hasValue("max_income") ? $CurrentForm->getValue("max_income") : $CurrentForm->getValue("x_max_income");
        if (!$this->max_income->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_income->Visible = false; // Disable update for API request
            } else {
                $this->max_income->setFormValue($val);
            }
        }

        // Check field name 'skor_pengelolaan' first before field var 'x_skor_pengelolaan'
        $val = $CurrentForm->hasValue("skor_pengelolaan") ? $CurrentForm->getValue("skor_pengelolaan") : $CurrentForm->getValue("x_skor_pengelolaan");
        if (!$this->skor_pengelolaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pengelolaan->Visible = false; // Disable update for API request
            } else {
                $this->skor_pengelolaan->setFormValue($val);
            }
        }

        // Check field name 'max_pengelolaan' first before field var 'x_max_pengelolaan'
        $val = $CurrentForm->hasValue("max_pengelolaan") ? $CurrentForm->getValue("max_pengelolaan") : $CurrentForm->getValue("x_max_pengelolaan");
        if (!$this->max_pengelolaan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_pengelolaan->Visible = false; // Disable update for API request
            } else {
                $this->max_pengelolaan->setFormValue($val);
            }
        }

        // Check field name 'skor_nota' first before field var 'x_skor_nota'
        $val = $CurrentForm->hasValue("skor_nota") ? $CurrentForm->getValue("skor_nota") : $CurrentForm->getValue("x_skor_nota");
        if (!$this->skor_nota->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_nota->Visible = false; // Disable update for API request
            } else {
                $this->skor_nota->setFormValue($val);
            }
        }

        // Check field name 'max_nota' first before field var 'x_max_nota'
        $val = $CurrentForm->hasValue("max_nota") ? $CurrentForm->getValue("max_nota") : $CurrentForm->getValue("x_max_nota");
        if (!$this->max_nota->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_nota->Visible = false; // Disable update for API request
            } else {
                $this->max_nota->setFormValue($val);
            }
        }

        // Check field name 'skor_jurnal' first before field var 'x_skor_jurnal'
        $val = $CurrentForm->hasValue("skor_jurnal") ? $CurrentForm->getValue("skor_jurnal") : $CurrentForm->getValue("x_skor_jurnal");
        if (!$this->skor_jurnal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_jurnal->Visible = false; // Disable update for API request
            } else {
                $this->skor_jurnal->setFormValue($val);
            }
        }

        // Check field name 'max_jurnal' first before field var 'x_max_jurnal'
        $val = $CurrentForm->hasValue("max_jurnal") ? $CurrentForm->getValue("max_jurnal") : $CurrentForm->getValue("x_max_jurnal");
        if (!$this->max_jurnal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_jurnal->Visible = false; // Disable update for API request
            } else {
                $this->max_jurnal->setFormValue($val);
            }
        }

        // Check field name 'skor_akutansi' first before field var 'x_skor_akutansi'
        $val = $CurrentForm->hasValue("skor_akutansi") ? $CurrentForm->getValue("skor_akutansi") : $CurrentForm->getValue("x_skor_akutansi");
        if (!$this->skor_akutansi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_akutansi->Visible = false; // Disable update for API request
            } else {
                $this->skor_akutansi->setFormValue($val);
            }
        }

        // Check field name 'max_akutansi' first before field var 'x_max_akutansi'
        $val = $CurrentForm->hasValue("max_akutansi") ? $CurrentForm->getValue("max_akutansi") : $CurrentForm->getValue("x_max_akutansi");
        if (!$this->max_akutansi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_akutansi->Visible = false; // Disable update for API request
            } else {
                $this->max_akutansi->setFormValue($val);
            }
        }

        // Check field name 'skor_utangbank' first before field var 'x_skor_utangbank'
        $val = $CurrentForm->hasValue("skor_utangbank") ? $CurrentForm->getValue("skor_utangbank") : $CurrentForm->getValue("x_skor_utangbank");
        if (!$this->skor_utangbank->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_utangbank->Visible = false; // Disable update for API request
            } else {
                $this->skor_utangbank->setFormValue($val);
            }
        }

        // Check field name 'max_utangbank' first before field var 'x_max_utangbank'
        $val = $CurrentForm->hasValue("max_utangbank") ? $CurrentForm->getValue("max_utangbank") : $CurrentForm->getValue("x_max_utangbank");
        if (!$this->max_utangbank->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_utangbank->Visible = false; // Disable update for API request
            } else {
                $this->max_utangbank->setFormValue($val);
            }
        }

        // Check field name 'skor_dokumentasi' first before field var 'x_skor_dokumentasi'
        $val = $CurrentForm->hasValue("skor_dokumentasi") ? $CurrentForm->getValue("skor_dokumentasi") : $CurrentForm->getValue("x_skor_dokumentasi");
        if (!$this->skor_dokumentasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_dokumentasi->Visible = false; // Disable update for API request
            } else {
                $this->skor_dokumentasi->setFormValue($val);
            }
        }

        // Check field name 'max_dokumentasi' first before field var 'x_max_dokumentasi'
        $val = $CurrentForm->hasValue("max_dokumentasi") ? $CurrentForm->getValue("max_dokumentasi") : $CurrentForm->getValue("x_max_dokumentasi");
        if (!$this->max_dokumentasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_dokumentasi->Visible = false; // Disable update for API request
            } else {
                $this->max_dokumentasi->setFormValue($val);
            }
        }

        // Check field name 'skor_nontunai' first before field var 'x_skor_nontunai'
        $val = $CurrentForm->hasValue("skor_nontunai") ? $CurrentForm->getValue("skor_nontunai") : $CurrentForm->getValue("x_skor_nontunai");
        if (!$this->skor_nontunai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_nontunai->Visible = false; // Disable update for API request
            } else {
                $this->skor_nontunai->setFormValue($val);
            }
        }

        // Check field name 'max_nontunai' first before field var 'x_max_nontunai'
        $val = $CurrentForm->hasValue("max_nontunai") ? $CurrentForm->getValue("max_nontunai") : $CurrentForm->getValue("x_max_nontunai");
        if (!$this->max_nontunai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_nontunai->Visible = false; // Disable update for API request
            } else {
                $this->max_nontunai->setFormValue($val);
            }
        }

        // Check field name 'skor_keuangan' first before field var 'x_skor_keuangan'
        $val = $CurrentForm->hasValue("skor_keuangan") ? $CurrentForm->getValue("skor_keuangan") : $CurrentForm->getValue("x_skor_keuangan");
        if (!$this->skor_keuangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_keuangan->Visible = false; // Disable update for API request
            } else {
                $this->skor_keuangan->setFormValue($val);
            }
        }

        // Check field name 'maxskor_keuangan' first before field var 'x_maxskor_keuangan'
        $val = $CurrentForm->hasValue("maxskor_keuangan") ? $CurrentForm->getValue("maxskor_keuangan") : $CurrentForm->getValue("x_maxskor_keuangan");
        if (!$this->maxskor_keuangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_keuangan->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_keuangan->setFormValue($val);
            }
        }

        // Check field name 'bobot_keuangan' first before field var 'x_bobot_keuangan'
        $val = $CurrentForm->hasValue("bobot_keuangan") ? $CurrentForm->getValue("bobot_keuangan") : $CurrentForm->getValue("x_bobot_keuangan");
        if (!$this->bobot_keuangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_keuangan->Visible = false; // Disable update for API request
            } else {
                $this->bobot_keuangan->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->skor_income->CurrentValue = $this->skor_income->FormValue;
        $this->max_income->CurrentValue = $this->max_income->FormValue;
        $this->skor_pengelolaan->CurrentValue = $this->skor_pengelolaan->FormValue;
        $this->max_pengelolaan->CurrentValue = $this->max_pengelolaan->FormValue;
        $this->skor_nota->CurrentValue = $this->skor_nota->FormValue;
        $this->max_nota->CurrentValue = $this->max_nota->FormValue;
        $this->skor_jurnal->CurrentValue = $this->skor_jurnal->FormValue;
        $this->max_jurnal->CurrentValue = $this->max_jurnal->FormValue;
        $this->skor_akutansi->CurrentValue = $this->skor_akutansi->FormValue;
        $this->max_akutansi->CurrentValue = $this->max_akutansi->FormValue;
        $this->skor_utangbank->CurrentValue = $this->skor_utangbank->FormValue;
        $this->max_utangbank->CurrentValue = $this->max_utangbank->FormValue;
        $this->skor_dokumentasi->CurrentValue = $this->skor_dokumentasi->FormValue;
        $this->max_dokumentasi->CurrentValue = $this->max_dokumentasi->FormValue;
        $this->skor_nontunai->CurrentValue = $this->skor_nontunai->FormValue;
        $this->max_nontunai->CurrentValue = $this->max_nontunai->FormValue;
        $this->skor_keuangan->CurrentValue = $this->skor_keuangan->FormValue;
        $this->maxskor_keuangan->CurrentValue = $this->maxskor_keuangan->FormValue;
        $this->bobot_keuangan->CurrentValue = $this->bobot_keuangan->FormValue;
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
        $this->skor_income->setDbValue($row['skor_income']);
        $this->max_income->setDbValue($row['max_income']);
        $this->skor_pengelolaan->setDbValue($row['skor_pengelolaan']);
        $this->max_pengelolaan->setDbValue($row['max_pengelolaan']);
        $this->skor_nota->setDbValue($row['skor_nota']);
        $this->max_nota->setDbValue($row['max_nota']);
        $this->skor_jurnal->setDbValue($row['skor_jurnal']);
        $this->max_jurnal->setDbValue($row['max_jurnal']);
        $this->skor_akutansi->setDbValue($row['skor_akutansi']);
        $this->max_akutansi->setDbValue($row['max_akutansi']);
        $this->skor_utangbank->setDbValue($row['skor_utangbank']);
        $this->max_utangbank->setDbValue($row['max_utangbank']);
        $this->skor_dokumentasi->setDbValue($row['skor_dokumentasi']);
        $this->max_dokumentasi->setDbValue($row['max_dokumentasi']);
        $this->skor_nontunai->setDbValue($row['skor_nontunai']);
        $this->max_nontunai->setDbValue($row['max_nontunai']);
        $this->skor_keuangan->setDbValue($row['skor_keuangan']);
        $this->maxskor_keuangan->setDbValue($row['maxskor_keuangan']);
        $this->bobot_keuangan->setDbValue($row['bobot_keuangan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_income'] = null;
        $row['max_income'] = null;
        $row['skor_pengelolaan'] = null;
        $row['max_pengelolaan'] = null;
        $row['skor_nota'] = null;
        $row['max_nota'] = null;
        $row['skor_jurnal'] = null;
        $row['max_jurnal'] = null;
        $row['skor_akutansi'] = null;
        $row['max_akutansi'] = null;
        $row['skor_utangbank'] = null;
        $row['max_utangbank'] = null;
        $row['skor_dokumentasi'] = null;
        $row['max_dokumentasi'] = null;
        $row['skor_nontunai'] = null;
        $row['max_nontunai'] = null;
        $row['skor_keuangan'] = null;
        $row['maxskor_keuangan'] = null;
        $row['bobot_keuangan'] = null;
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
        if ($this->skor_income->FormValue == $this->skor_income->CurrentValue && is_numeric(ConvertToFloatString($this->skor_income->CurrentValue))) {
            $this->skor_income->CurrentValue = ConvertToFloatString($this->skor_income->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_income->FormValue == $this->max_income->CurrentValue && is_numeric(ConvertToFloatString($this->max_income->CurrentValue))) {
            $this->max_income->CurrentValue = ConvertToFloatString($this->max_income->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pengelolaan->FormValue == $this->skor_pengelolaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pengelolaan->CurrentValue))) {
            $this->skor_pengelolaan->CurrentValue = ConvertToFloatString($this->skor_pengelolaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pengelolaan->FormValue == $this->max_pengelolaan->CurrentValue && is_numeric(ConvertToFloatString($this->max_pengelolaan->CurrentValue))) {
            $this->max_pengelolaan->CurrentValue = ConvertToFloatString($this->max_pengelolaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_nota->FormValue == $this->skor_nota->CurrentValue && is_numeric(ConvertToFloatString($this->skor_nota->CurrentValue))) {
            $this->skor_nota->CurrentValue = ConvertToFloatString($this->skor_nota->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_nota->FormValue == $this->max_nota->CurrentValue && is_numeric(ConvertToFloatString($this->max_nota->CurrentValue))) {
            $this->max_nota->CurrentValue = ConvertToFloatString($this->max_nota->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_jurnal->FormValue == $this->skor_jurnal->CurrentValue && is_numeric(ConvertToFloatString($this->skor_jurnal->CurrentValue))) {
            $this->skor_jurnal->CurrentValue = ConvertToFloatString($this->skor_jurnal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_jurnal->FormValue == $this->max_jurnal->CurrentValue && is_numeric(ConvertToFloatString($this->max_jurnal->CurrentValue))) {
            $this->max_jurnal->CurrentValue = ConvertToFloatString($this->max_jurnal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_akutansi->FormValue == $this->skor_akutansi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_akutansi->CurrentValue))) {
            $this->skor_akutansi->CurrentValue = ConvertToFloatString($this->skor_akutansi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_akutansi->FormValue == $this->max_akutansi->CurrentValue && is_numeric(ConvertToFloatString($this->max_akutansi->CurrentValue))) {
            $this->max_akutansi->CurrentValue = ConvertToFloatString($this->max_akutansi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_utangbank->FormValue == $this->skor_utangbank->CurrentValue && is_numeric(ConvertToFloatString($this->skor_utangbank->CurrentValue))) {
            $this->skor_utangbank->CurrentValue = ConvertToFloatString($this->skor_utangbank->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_utangbank->FormValue == $this->max_utangbank->CurrentValue && is_numeric(ConvertToFloatString($this->max_utangbank->CurrentValue))) {
            $this->max_utangbank->CurrentValue = ConvertToFloatString($this->max_utangbank->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_dokumentasi->FormValue == $this->skor_dokumentasi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_dokumentasi->CurrentValue))) {
            $this->skor_dokumentasi->CurrentValue = ConvertToFloatString($this->skor_dokumentasi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_dokumentasi->FormValue == $this->max_dokumentasi->CurrentValue && is_numeric(ConvertToFloatString($this->max_dokumentasi->CurrentValue))) {
            $this->max_dokumentasi->CurrentValue = ConvertToFloatString($this->max_dokumentasi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_nontunai->FormValue == $this->skor_nontunai->CurrentValue && is_numeric(ConvertToFloatString($this->skor_nontunai->CurrentValue))) {
            $this->skor_nontunai->CurrentValue = ConvertToFloatString($this->skor_nontunai->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_nontunai->FormValue == $this->max_nontunai->CurrentValue && is_numeric(ConvertToFloatString($this->max_nontunai->CurrentValue))) {
            $this->max_nontunai->CurrentValue = ConvertToFloatString($this->max_nontunai->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_keuangan->FormValue == $this->skor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_keuangan->CurrentValue))) {
            $this->skor_keuangan->CurrentValue = ConvertToFloatString($this->skor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_keuangan->FormValue == $this->maxskor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_keuangan->CurrentValue))) {
            $this->maxskor_keuangan->CurrentValue = ConvertToFloatString($this->maxskor_keuangan->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_income

        // max_income

        // skor_pengelolaan

        // max_pengelolaan

        // skor_nota

        // max_nota

        // skor_jurnal

        // max_jurnal

        // skor_akutansi

        // max_akutansi

        // skor_utangbank

        // max_utangbank

        // skor_dokumentasi

        // max_dokumentasi

        // skor_nontunai

        // max_nontunai

        // skor_keuangan

        // maxskor_keuangan

        // bobot_keuangan
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_income
            $this->skor_income->ViewValue = $this->skor_income->CurrentValue;
            $this->skor_income->ViewValue = FormatNumber($this->skor_income->ViewValue, 2, -2, -2, -2);
            $this->skor_income->ViewCustomAttributes = "";

            // max_income
            $this->max_income->ViewValue = $this->max_income->CurrentValue;
            $this->max_income->ViewValue = FormatNumber($this->max_income->ViewValue, 2, -2, -2, -2);
            $this->max_income->ViewCustomAttributes = "";

            // skor_pengelolaan
            $this->skor_pengelolaan->ViewValue = $this->skor_pengelolaan->CurrentValue;
            $this->skor_pengelolaan->ViewValue = FormatNumber($this->skor_pengelolaan->ViewValue, 2, -2, -2, -2);
            $this->skor_pengelolaan->ViewCustomAttributes = "";

            // max_pengelolaan
            $this->max_pengelolaan->ViewValue = $this->max_pengelolaan->CurrentValue;
            $this->max_pengelolaan->ViewValue = FormatNumber($this->max_pengelolaan->ViewValue, 2, -2, -2, -2);
            $this->max_pengelolaan->ViewCustomAttributes = "";

            // skor_nota
            $this->skor_nota->ViewValue = $this->skor_nota->CurrentValue;
            $this->skor_nota->ViewValue = FormatNumber($this->skor_nota->ViewValue, 2, -2, -2, -2);
            $this->skor_nota->ViewCustomAttributes = "";

            // max_nota
            $this->max_nota->ViewValue = $this->max_nota->CurrentValue;
            $this->max_nota->ViewValue = FormatNumber($this->max_nota->ViewValue, 2, -2, -2, -2);
            $this->max_nota->ViewCustomAttributes = "";

            // skor_jurnal
            $this->skor_jurnal->ViewValue = $this->skor_jurnal->CurrentValue;
            $this->skor_jurnal->ViewValue = FormatNumber($this->skor_jurnal->ViewValue, 2, -2, -2, -2);
            $this->skor_jurnal->ViewCustomAttributes = "";

            // max_jurnal
            $this->max_jurnal->ViewValue = $this->max_jurnal->CurrentValue;
            $this->max_jurnal->ViewValue = FormatNumber($this->max_jurnal->ViewValue, 2, -2, -2, -2);
            $this->max_jurnal->ViewCustomAttributes = "";

            // skor_akutansi
            $this->skor_akutansi->ViewValue = $this->skor_akutansi->CurrentValue;
            $this->skor_akutansi->ViewValue = FormatNumber($this->skor_akutansi->ViewValue, 2, -2, -2, -2);
            $this->skor_akutansi->ViewCustomAttributes = "";

            // max_akutansi
            $this->max_akutansi->ViewValue = $this->max_akutansi->CurrentValue;
            $this->max_akutansi->ViewValue = FormatNumber($this->max_akutansi->ViewValue, 2, -2, -2, -2);
            $this->max_akutansi->ViewCustomAttributes = "";

            // skor_utangbank
            $this->skor_utangbank->ViewValue = $this->skor_utangbank->CurrentValue;
            $this->skor_utangbank->ViewValue = FormatNumber($this->skor_utangbank->ViewValue, 2, -2, -2, -2);
            $this->skor_utangbank->ViewCustomAttributes = "";

            // max_utangbank
            $this->max_utangbank->ViewValue = $this->max_utangbank->CurrentValue;
            $this->max_utangbank->ViewValue = FormatNumber($this->max_utangbank->ViewValue, 2, -2, -2, -2);
            $this->max_utangbank->ViewCustomAttributes = "";

            // skor_dokumentasi
            $this->skor_dokumentasi->ViewValue = $this->skor_dokumentasi->CurrentValue;
            $this->skor_dokumentasi->ViewValue = FormatNumber($this->skor_dokumentasi->ViewValue, 2, -2, -2, -2);
            $this->skor_dokumentasi->ViewCustomAttributes = "";

            // max_dokumentasi
            $this->max_dokumentasi->ViewValue = $this->max_dokumentasi->CurrentValue;
            $this->max_dokumentasi->ViewValue = FormatNumber($this->max_dokumentasi->ViewValue, 2, -2, -2, -2);
            $this->max_dokumentasi->ViewCustomAttributes = "";

            // skor_nontunai
            $this->skor_nontunai->ViewValue = $this->skor_nontunai->CurrentValue;
            $this->skor_nontunai->ViewValue = FormatNumber($this->skor_nontunai->ViewValue, 2, -2, -2, -2);
            $this->skor_nontunai->ViewCustomAttributes = "";

            // max_nontunai
            $this->max_nontunai->ViewValue = $this->max_nontunai->CurrentValue;
            $this->max_nontunai->ViewValue = FormatNumber($this->max_nontunai->ViewValue, 2, -2, -2, -2);
            $this->max_nontunai->ViewCustomAttributes = "";

            // skor_keuangan
            $this->skor_keuangan->ViewValue = $this->skor_keuangan->CurrentValue;
            $this->skor_keuangan->ViewValue = FormatNumber($this->skor_keuangan->ViewValue, 2, -2, -2, -2);
            $this->skor_keuangan->ViewCustomAttributes = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->ViewValue = $this->maxskor_keuangan->CurrentValue;
            $this->maxskor_keuangan->ViewValue = FormatNumber($this->maxskor_keuangan->ViewValue, 2, -2, -2, -2);
            $this->maxskor_keuangan->ViewCustomAttributes = "";

            // bobot_keuangan
            $this->bobot_keuangan->ViewValue = $this->bobot_keuangan->CurrentValue;
            $this->bobot_keuangan->ViewValue = FormatNumber($this->bobot_keuangan->ViewValue, 0, -2, -2, -2);
            $this->bobot_keuangan->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_income
            $this->skor_income->LinkCustomAttributes = "";
            $this->skor_income->HrefValue = "";
            $this->skor_income->TooltipValue = "";

            // max_income
            $this->max_income->LinkCustomAttributes = "";
            $this->max_income->HrefValue = "";
            $this->max_income->TooltipValue = "";

            // skor_pengelolaan
            $this->skor_pengelolaan->LinkCustomAttributes = "";
            $this->skor_pengelolaan->HrefValue = "";
            $this->skor_pengelolaan->TooltipValue = "";

            // max_pengelolaan
            $this->max_pengelolaan->LinkCustomAttributes = "";
            $this->max_pengelolaan->HrefValue = "";
            $this->max_pengelolaan->TooltipValue = "";

            // skor_nota
            $this->skor_nota->LinkCustomAttributes = "";
            $this->skor_nota->HrefValue = "";
            $this->skor_nota->TooltipValue = "";

            // max_nota
            $this->max_nota->LinkCustomAttributes = "";
            $this->max_nota->HrefValue = "";
            $this->max_nota->TooltipValue = "";

            // skor_jurnal
            $this->skor_jurnal->LinkCustomAttributes = "";
            $this->skor_jurnal->HrefValue = "";
            $this->skor_jurnal->TooltipValue = "";

            // max_jurnal
            $this->max_jurnal->LinkCustomAttributes = "";
            $this->max_jurnal->HrefValue = "";
            $this->max_jurnal->TooltipValue = "";

            // skor_akutansi
            $this->skor_akutansi->LinkCustomAttributes = "";
            $this->skor_akutansi->HrefValue = "";
            $this->skor_akutansi->TooltipValue = "";

            // max_akutansi
            $this->max_akutansi->LinkCustomAttributes = "";
            $this->max_akutansi->HrefValue = "";
            $this->max_akutansi->TooltipValue = "";

            // skor_utangbank
            $this->skor_utangbank->LinkCustomAttributes = "";
            $this->skor_utangbank->HrefValue = "";
            $this->skor_utangbank->TooltipValue = "";

            // max_utangbank
            $this->max_utangbank->LinkCustomAttributes = "";
            $this->max_utangbank->HrefValue = "";
            $this->max_utangbank->TooltipValue = "";

            // skor_dokumentasi
            $this->skor_dokumentasi->LinkCustomAttributes = "";
            $this->skor_dokumentasi->HrefValue = "";
            $this->skor_dokumentasi->TooltipValue = "";

            // max_dokumentasi
            $this->max_dokumentasi->LinkCustomAttributes = "";
            $this->max_dokumentasi->HrefValue = "";
            $this->max_dokumentasi->TooltipValue = "";

            // skor_nontunai
            $this->skor_nontunai->LinkCustomAttributes = "";
            $this->skor_nontunai->HrefValue = "";
            $this->skor_nontunai->TooltipValue = "";

            // max_nontunai
            $this->max_nontunai->LinkCustomAttributes = "";
            $this->max_nontunai->HrefValue = "";
            $this->max_nontunai->TooltipValue = "";

            // skor_keuangan
            $this->skor_keuangan->LinkCustomAttributes = "";
            $this->skor_keuangan->HrefValue = "";
            $this->skor_keuangan->TooltipValue = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->LinkCustomAttributes = "";
            $this->maxskor_keuangan->HrefValue = "";
            $this->maxskor_keuangan->TooltipValue = "";

            // bobot_keuangan
            $this->bobot_keuangan->LinkCustomAttributes = "";
            $this->bobot_keuangan->HrefValue = "";
            $this->bobot_keuangan->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // skor_income
            $this->skor_income->EditAttrs["class"] = "form-control";
            $this->skor_income->EditCustomAttributes = "";
            $this->skor_income->EditValue = HtmlEncode($this->skor_income->CurrentValue);
            $this->skor_income->PlaceHolder = RemoveHtml($this->skor_income->caption());
            if (strval($this->skor_income->EditValue) != "" && is_numeric($this->skor_income->EditValue)) {
                $this->skor_income->EditValue = FormatNumber($this->skor_income->EditValue, -2, -2, -2, -2);
            }

            // max_income
            $this->max_income->EditAttrs["class"] = "form-control";
            $this->max_income->EditCustomAttributes = "";
            $this->max_income->EditValue = HtmlEncode($this->max_income->CurrentValue);
            $this->max_income->PlaceHolder = RemoveHtml($this->max_income->caption());
            if (strval($this->max_income->EditValue) != "" && is_numeric($this->max_income->EditValue)) {
                $this->max_income->EditValue = FormatNumber($this->max_income->EditValue, -2, -2, -2, -2);
            }

            // skor_pengelolaan
            $this->skor_pengelolaan->EditAttrs["class"] = "form-control";
            $this->skor_pengelolaan->EditCustomAttributes = "";
            $this->skor_pengelolaan->EditValue = HtmlEncode($this->skor_pengelolaan->CurrentValue);
            $this->skor_pengelolaan->PlaceHolder = RemoveHtml($this->skor_pengelolaan->caption());
            if (strval($this->skor_pengelolaan->EditValue) != "" && is_numeric($this->skor_pengelolaan->EditValue)) {
                $this->skor_pengelolaan->EditValue = FormatNumber($this->skor_pengelolaan->EditValue, -2, -2, -2, -2);
            }

            // max_pengelolaan
            $this->max_pengelolaan->EditAttrs["class"] = "form-control";
            $this->max_pengelolaan->EditCustomAttributes = "";
            $this->max_pengelolaan->EditValue = HtmlEncode($this->max_pengelolaan->CurrentValue);
            $this->max_pengelolaan->PlaceHolder = RemoveHtml($this->max_pengelolaan->caption());
            if (strval($this->max_pengelolaan->EditValue) != "" && is_numeric($this->max_pengelolaan->EditValue)) {
                $this->max_pengelolaan->EditValue = FormatNumber($this->max_pengelolaan->EditValue, -2, -2, -2, -2);
            }

            // skor_nota
            $this->skor_nota->EditAttrs["class"] = "form-control";
            $this->skor_nota->EditCustomAttributes = "";
            $this->skor_nota->EditValue = HtmlEncode($this->skor_nota->CurrentValue);
            $this->skor_nota->PlaceHolder = RemoveHtml($this->skor_nota->caption());
            if (strval($this->skor_nota->EditValue) != "" && is_numeric($this->skor_nota->EditValue)) {
                $this->skor_nota->EditValue = FormatNumber($this->skor_nota->EditValue, -2, -2, -2, -2);
            }

            // max_nota
            $this->max_nota->EditAttrs["class"] = "form-control";
            $this->max_nota->EditCustomAttributes = "";
            $this->max_nota->EditValue = HtmlEncode($this->max_nota->CurrentValue);
            $this->max_nota->PlaceHolder = RemoveHtml($this->max_nota->caption());
            if (strval($this->max_nota->EditValue) != "" && is_numeric($this->max_nota->EditValue)) {
                $this->max_nota->EditValue = FormatNumber($this->max_nota->EditValue, -2, -2, -2, -2);
            }

            // skor_jurnal
            $this->skor_jurnal->EditAttrs["class"] = "form-control";
            $this->skor_jurnal->EditCustomAttributes = "";
            $this->skor_jurnal->EditValue = HtmlEncode($this->skor_jurnal->CurrentValue);
            $this->skor_jurnal->PlaceHolder = RemoveHtml($this->skor_jurnal->caption());
            if (strval($this->skor_jurnal->EditValue) != "" && is_numeric($this->skor_jurnal->EditValue)) {
                $this->skor_jurnal->EditValue = FormatNumber($this->skor_jurnal->EditValue, -2, -2, -2, -2);
            }

            // max_jurnal
            $this->max_jurnal->EditAttrs["class"] = "form-control";
            $this->max_jurnal->EditCustomAttributes = "";
            $this->max_jurnal->EditValue = HtmlEncode($this->max_jurnal->CurrentValue);
            $this->max_jurnal->PlaceHolder = RemoveHtml($this->max_jurnal->caption());
            if (strval($this->max_jurnal->EditValue) != "" && is_numeric($this->max_jurnal->EditValue)) {
                $this->max_jurnal->EditValue = FormatNumber($this->max_jurnal->EditValue, -2, -2, -2, -2);
            }

            // skor_akutansi
            $this->skor_akutansi->EditAttrs["class"] = "form-control";
            $this->skor_akutansi->EditCustomAttributes = "";
            $this->skor_akutansi->EditValue = HtmlEncode($this->skor_akutansi->CurrentValue);
            $this->skor_akutansi->PlaceHolder = RemoveHtml($this->skor_akutansi->caption());
            if (strval($this->skor_akutansi->EditValue) != "" && is_numeric($this->skor_akutansi->EditValue)) {
                $this->skor_akutansi->EditValue = FormatNumber($this->skor_akutansi->EditValue, -2, -2, -2, -2);
            }

            // max_akutansi
            $this->max_akutansi->EditAttrs["class"] = "form-control";
            $this->max_akutansi->EditCustomAttributes = "";
            $this->max_akutansi->EditValue = HtmlEncode($this->max_akutansi->CurrentValue);
            $this->max_akutansi->PlaceHolder = RemoveHtml($this->max_akutansi->caption());
            if (strval($this->max_akutansi->EditValue) != "" && is_numeric($this->max_akutansi->EditValue)) {
                $this->max_akutansi->EditValue = FormatNumber($this->max_akutansi->EditValue, -2, -2, -2, -2);
            }

            // skor_utangbank
            $this->skor_utangbank->EditAttrs["class"] = "form-control";
            $this->skor_utangbank->EditCustomAttributes = "";
            $this->skor_utangbank->EditValue = HtmlEncode($this->skor_utangbank->CurrentValue);
            $this->skor_utangbank->PlaceHolder = RemoveHtml($this->skor_utangbank->caption());
            if (strval($this->skor_utangbank->EditValue) != "" && is_numeric($this->skor_utangbank->EditValue)) {
                $this->skor_utangbank->EditValue = FormatNumber($this->skor_utangbank->EditValue, -2, -2, -2, -2);
            }

            // max_utangbank
            $this->max_utangbank->EditAttrs["class"] = "form-control";
            $this->max_utangbank->EditCustomAttributes = "";
            $this->max_utangbank->EditValue = HtmlEncode($this->max_utangbank->CurrentValue);
            $this->max_utangbank->PlaceHolder = RemoveHtml($this->max_utangbank->caption());
            if (strval($this->max_utangbank->EditValue) != "" && is_numeric($this->max_utangbank->EditValue)) {
                $this->max_utangbank->EditValue = FormatNumber($this->max_utangbank->EditValue, -2, -2, -2, -2);
            }

            // skor_dokumentasi
            $this->skor_dokumentasi->EditAttrs["class"] = "form-control";
            $this->skor_dokumentasi->EditCustomAttributes = "";
            $this->skor_dokumentasi->EditValue = HtmlEncode($this->skor_dokumentasi->CurrentValue);
            $this->skor_dokumentasi->PlaceHolder = RemoveHtml($this->skor_dokumentasi->caption());
            if (strval($this->skor_dokumentasi->EditValue) != "" && is_numeric($this->skor_dokumentasi->EditValue)) {
                $this->skor_dokumentasi->EditValue = FormatNumber($this->skor_dokumentasi->EditValue, -2, -2, -2, -2);
            }

            // max_dokumentasi
            $this->max_dokumentasi->EditAttrs["class"] = "form-control";
            $this->max_dokumentasi->EditCustomAttributes = "";
            $this->max_dokumentasi->EditValue = HtmlEncode($this->max_dokumentasi->CurrentValue);
            $this->max_dokumentasi->PlaceHolder = RemoveHtml($this->max_dokumentasi->caption());
            if (strval($this->max_dokumentasi->EditValue) != "" && is_numeric($this->max_dokumentasi->EditValue)) {
                $this->max_dokumentasi->EditValue = FormatNumber($this->max_dokumentasi->EditValue, -2, -2, -2, -2);
            }

            // skor_nontunai
            $this->skor_nontunai->EditAttrs["class"] = "form-control";
            $this->skor_nontunai->EditCustomAttributes = "";
            $this->skor_nontunai->EditValue = HtmlEncode($this->skor_nontunai->CurrentValue);
            $this->skor_nontunai->PlaceHolder = RemoveHtml($this->skor_nontunai->caption());
            if (strval($this->skor_nontunai->EditValue) != "" && is_numeric($this->skor_nontunai->EditValue)) {
                $this->skor_nontunai->EditValue = FormatNumber($this->skor_nontunai->EditValue, -2, -2, -2, -2);
            }

            // max_nontunai
            $this->max_nontunai->EditAttrs["class"] = "form-control";
            $this->max_nontunai->EditCustomAttributes = "";
            $this->max_nontunai->EditValue = HtmlEncode($this->max_nontunai->CurrentValue);
            $this->max_nontunai->PlaceHolder = RemoveHtml($this->max_nontunai->caption());
            if (strval($this->max_nontunai->EditValue) != "" && is_numeric($this->max_nontunai->EditValue)) {
                $this->max_nontunai->EditValue = FormatNumber($this->max_nontunai->EditValue, -2, -2, -2, -2);
            }

            // skor_keuangan
            $this->skor_keuangan->EditAttrs["class"] = "form-control";
            $this->skor_keuangan->EditCustomAttributes = "";
            $this->skor_keuangan->EditValue = HtmlEncode($this->skor_keuangan->CurrentValue);
            $this->skor_keuangan->PlaceHolder = RemoveHtml($this->skor_keuangan->caption());
            if (strval($this->skor_keuangan->EditValue) != "" && is_numeric($this->skor_keuangan->EditValue)) {
                $this->skor_keuangan->EditValue = FormatNumber($this->skor_keuangan->EditValue, -2, -2, -2, -2);
            }

            // maxskor_keuangan
            $this->maxskor_keuangan->EditAttrs["class"] = "form-control";
            $this->maxskor_keuangan->EditCustomAttributes = "";
            $this->maxskor_keuangan->EditValue = HtmlEncode($this->maxskor_keuangan->CurrentValue);
            $this->maxskor_keuangan->PlaceHolder = RemoveHtml($this->maxskor_keuangan->caption());
            if (strval($this->maxskor_keuangan->EditValue) != "" && is_numeric($this->maxskor_keuangan->EditValue)) {
                $this->maxskor_keuangan->EditValue = FormatNumber($this->maxskor_keuangan->EditValue, -2, -2, -2, -2);
            }

            // bobot_keuangan
            $this->bobot_keuangan->EditAttrs["class"] = "form-control";
            $this->bobot_keuangan->EditCustomAttributes = "";
            $this->bobot_keuangan->EditValue = HtmlEncode($this->bobot_keuangan->CurrentValue);
            $this->bobot_keuangan->PlaceHolder = RemoveHtml($this->bobot_keuangan->caption());

            // Edit refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // skor_income
            $this->skor_income->LinkCustomAttributes = "";
            $this->skor_income->HrefValue = "";

            // max_income
            $this->max_income->LinkCustomAttributes = "";
            $this->max_income->HrefValue = "";

            // skor_pengelolaan
            $this->skor_pengelolaan->LinkCustomAttributes = "";
            $this->skor_pengelolaan->HrefValue = "";

            // max_pengelolaan
            $this->max_pengelolaan->LinkCustomAttributes = "";
            $this->max_pengelolaan->HrefValue = "";

            // skor_nota
            $this->skor_nota->LinkCustomAttributes = "";
            $this->skor_nota->HrefValue = "";

            // max_nota
            $this->max_nota->LinkCustomAttributes = "";
            $this->max_nota->HrefValue = "";

            // skor_jurnal
            $this->skor_jurnal->LinkCustomAttributes = "";
            $this->skor_jurnal->HrefValue = "";

            // max_jurnal
            $this->max_jurnal->LinkCustomAttributes = "";
            $this->max_jurnal->HrefValue = "";

            // skor_akutansi
            $this->skor_akutansi->LinkCustomAttributes = "";
            $this->skor_akutansi->HrefValue = "";

            // max_akutansi
            $this->max_akutansi->LinkCustomAttributes = "";
            $this->max_akutansi->HrefValue = "";

            // skor_utangbank
            $this->skor_utangbank->LinkCustomAttributes = "";
            $this->skor_utangbank->HrefValue = "";

            // max_utangbank
            $this->max_utangbank->LinkCustomAttributes = "";
            $this->max_utangbank->HrefValue = "";

            // skor_dokumentasi
            $this->skor_dokumentasi->LinkCustomAttributes = "";
            $this->skor_dokumentasi->HrefValue = "";

            // max_dokumentasi
            $this->max_dokumentasi->LinkCustomAttributes = "";
            $this->max_dokumentasi->HrefValue = "";

            // skor_nontunai
            $this->skor_nontunai->LinkCustomAttributes = "";
            $this->skor_nontunai->HrefValue = "";

            // max_nontunai
            $this->max_nontunai->LinkCustomAttributes = "";
            $this->max_nontunai->HrefValue = "";

            // skor_keuangan
            $this->skor_keuangan->LinkCustomAttributes = "";
            $this->skor_keuangan->HrefValue = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->LinkCustomAttributes = "";
            $this->maxskor_keuangan->HrefValue = "";

            // bobot_keuangan
            $this->bobot_keuangan->LinkCustomAttributes = "";
            $this->bobot_keuangan->HrefValue = "";
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
        if ($this->skor_income->Required) {
            if (!$this->skor_income->IsDetailKey && EmptyValue($this->skor_income->FormValue)) {
                $this->skor_income->addErrorMessage(str_replace("%s", $this->skor_income->caption(), $this->skor_income->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_income->FormValue)) {
            $this->skor_income->addErrorMessage($this->skor_income->getErrorMessage(false));
        }
        if ($this->max_income->Required) {
            if (!$this->max_income->IsDetailKey && EmptyValue($this->max_income->FormValue)) {
                $this->max_income->addErrorMessage(str_replace("%s", $this->max_income->caption(), $this->max_income->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_income->FormValue)) {
            $this->max_income->addErrorMessage($this->max_income->getErrorMessage(false));
        }
        if ($this->skor_pengelolaan->Required) {
            if (!$this->skor_pengelolaan->IsDetailKey && EmptyValue($this->skor_pengelolaan->FormValue)) {
                $this->skor_pengelolaan->addErrorMessage(str_replace("%s", $this->skor_pengelolaan->caption(), $this->skor_pengelolaan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pengelolaan->FormValue)) {
            $this->skor_pengelolaan->addErrorMessage($this->skor_pengelolaan->getErrorMessage(false));
        }
        if ($this->max_pengelolaan->Required) {
            if (!$this->max_pengelolaan->IsDetailKey && EmptyValue($this->max_pengelolaan->FormValue)) {
                $this->max_pengelolaan->addErrorMessage(str_replace("%s", $this->max_pengelolaan->caption(), $this->max_pengelolaan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_pengelolaan->FormValue)) {
            $this->max_pengelolaan->addErrorMessage($this->max_pengelolaan->getErrorMessage(false));
        }
        if ($this->skor_nota->Required) {
            if (!$this->skor_nota->IsDetailKey && EmptyValue($this->skor_nota->FormValue)) {
                $this->skor_nota->addErrorMessage(str_replace("%s", $this->skor_nota->caption(), $this->skor_nota->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_nota->FormValue)) {
            $this->skor_nota->addErrorMessage($this->skor_nota->getErrorMessage(false));
        }
        if ($this->max_nota->Required) {
            if (!$this->max_nota->IsDetailKey && EmptyValue($this->max_nota->FormValue)) {
                $this->max_nota->addErrorMessage(str_replace("%s", $this->max_nota->caption(), $this->max_nota->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_nota->FormValue)) {
            $this->max_nota->addErrorMessage($this->max_nota->getErrorMessage(false));
        }
        if ($this->skor_jurnal->Required) {
            if (!$this->skor_jurnal->IsDetailKey && EmptyValue($this->skor_jurnal->FormValue)) {
                $this->skor_jurnal->addErrorMessage(str_replace("%s", $this->skor_jurnal->caption(), $this->skor_jurnal->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_jurnal->FormValue)) {
            $this->skor_jurnal->addErrorMessage($this->skor_jurnal->getErrorMessage(false));
        }
        if ($this->max_jurnal->Required) {
            if (!$this->max_jurnal->IsDetailKey && EmptyValue($this->max_jurnal->FormValue)) {
                $this->max_jurnal->addErrorMessage(str_replace("%s", $this->max_jurnal->caption(), $this->max_jurnal->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_jurnal->FormValue)) {
            $this->max_jurnal->addErrorMessage($this->max_jurnal->getErrorMessage(false));
        }
        if ($this->skor_akutansi->Required) {
            if (!$this->skor_akutansi->IsDetailKey && EmptyValue($this->skor_akutansi->FormValue)) {
                $this->skor_akutansi->addErrorMessage(str_replace("%s", $this->skor_akutansi->caption(), $this->skor_akutansi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_akutansi->FormValue)) {
            $this->skor_akutansi->addErrorMessage($this->skor_akutansi->getErrorMessage(false));
        }
        if ($this->max_akutansi->Required) {
            if (!$this->max_akutansi->IsDetailKey && EmptyValue($this->max_akutansi->FormValue)) {
                $this->max_akutansi->addErrorMessage(str_replace("%s", $this->max_akutansi->caption(), $this->max_akutansi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_akutansi->FormValue)) {
            $this->max_akutansi->addErrorMessage($this->max_akutansi->getErrorMessage(false));
        }
        if ($this->skor_utangbank->Required) {
            if (!$this->skor_utangbank->IsDetailKey && EmptyValue($this->skor_utangbank->FormValue)) {
                $this->skor_utangbank->addErrorMessage(str_replace("%s", $this->skor_utangbank->caption(), $this->skor_utangbank->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_utangbank->FormValue)) {
            $this->skor_utangbank->addErrorMessage($this->skor_utangbank->getErrorMessage(false));
        }
        if ($this->max_utangbank->Required) {
            if (!$this->max_utangbank->IsDetailKey && EmptyValue($this->max_utangbank->FormValue)) {
                $this->max_utangbank->addErrorMessage(str_replace("%s", $this->max_utangbank->caption(), $this->max_utangbank->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_utangbank->FormValue)) {
            $this->max_utangbank->addErrorMessage($this->max_utangbank->getErrorMessage(false));
        }
        if ($this->skor_dokumentasi->Required) {
            if (!$this->skor_dokumentasi->IsDetailKey && EmptyValue($this->skor_dokumentasi->FormValue)) {
                $this->skor_dokumentasi->addErrorMessage(str_replace("%s", $this->skor_dokumentasi->caption(), $this->skor_dokumentasi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_dokumentasi->FormValue)) {
            $this->skor_dokumentasi->addErrorMessage($this->skor_dokumentasi->getErrorMessage(false));
        }
        if ($this->max_dokumentasi->Required) {
            if (!$this->max_dokumentasi->IsDetailKey && EmptyValue($this->max_dokumentasi->FormValue)) {
                $this->max_dokumentasi->addErrorMessage(str_replace("%s", $this->max_dokumentasi->caption(), $this->max_dokumentasi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_dokumentasi->FormValue)) {
            $this->max_dokumentasi->addErrorMessage($this->max_dokumentasi->getErrorMessage(false));
        }
        if ($this->skor_nontunai->Required) {
            if (!$this->skor_nontunai->IsDetailKey && EmptyValue($this->skor_nontunai->FormValue)) {
                $this->skor_nontunai->addErrorMessage(str_replace("%s", $this->skor_nontunai->caption(), $this->skor_nontunai->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_nontunai->FormValue)) {
            $this->skor_nontunai->addErrorMessage($this->skor_nontunai->getErrorMessage(false));
        }
        if ($this->max_nontunai->Required) {
            if (!$this->max_nontunai->IsDetailKey && EmptyValue($this->max_nontunai->FormValue)) {
                $this->max_nontunai->addErrorMessage(str_replace("%s", $this->max_nontunai->caption(), $this->max_nontunai->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_nontunai->FormValue)) {
            $this->max_nontunai->addErrorMessage($this->max_nontunai->getErrorMessage(false));
        }
        if ($this->skor_keuangan->Required) {
            if (!$this->skor_keuangan->IsDetailKey && EmptyValue($this->skor_keuangan->FormValue)) {
                $this->skor_keuangan->addErrorMessage(str_replace("%s", $this->skor_keuangan->caption(), $this->skor_keuangan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_keuangan->FormValue)) {
            $this->skor_keuangan->addErrorMessage($this->skor_keuangan->getErrorMessage(false));
        }
        if ($this->maxskor_keuangan->Required) {
            if (!$this->maxskor_keuangan->IsDetailKey && EmptyValue($this->maxskor_keuangan->FormValue)) {
                $this->maxskor_keuangan->addErrorMessage(str_replace("%s", $this->maxskor_keuangan->caption(), $this->maxskor_keuangan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_keuangan->FormValue)) {
            $this->maxskor_keuangan->addErrorMessage($this->maxskor_keuangan->getErrorMessage(false));
        }
        if ($this->bobot_keuangan->Required) {
            if (!$this->bobot_keuangan->IsDetailKey && EmptyValue($this->bobot_keuangan->FormValue)) {
                $this->bobot_keuangan->addErrorMessage(str_replace("%s", $this->bobot_keuangan->caption(), $this->bobot_keuangan->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_keuangan->FormValue)) {
            $this->bobot_keuangan->addErrorMessage($this->bobot_keuangan->getErrorMessage(false));
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

            // skor_income
            $this->skor_income->setDbValueDef($rsnew, $this->skor_income->CurrentValue, null, $this->skor_income->ReadOnly);

            // max_income
            $this->max_income->setDbValueDef($rsnew, $this->max_income->CurrentValue, null, $this->max_income->ReadOnly);

            // skor_pengelolaan
            $this->skor_pengelolaan->setDbValueDef($rsnew, $this->skor_pengelolaan->CurrentValue, null, $this->skor_pengelolaan->ReadOnly);

            // max_pengelolaan
            $this->max_pengelolaan->setDbValueDef($rsnew, $this->max_pengelolaan->CurrentValue, null, $this->max_pengelolaan->ReadOnly);

            // skor_nota
            $this->skor_nota->setDbValueDef($rsnew, $this->skor_nota->CurrentValue, null, $this->skor_nota->ReadOnly);

            // max_nota
            $this->max_nota->setDbValueDef($rsnew, $this->max_nota->CurrentValue, null, $this->max_nota->ReadOnly);

            // skor_jurnal
            $this->skor_jurnal->setDbValueDef($rsnew, $this->skor_jurnal->CurrentValue, null, $this->skor_jurnal->ReadOnly);

            // max_jurnal
            $this->max_jurnal->setDbValueDef($rsnew, $this->max_jurnal->CurrentValue, null, $this->max_jurnal->ReadOnly);

            // skor_akutansi
            $this->skor_akutansi->setDbValueDef($rsnew, $this->skor_akutansi->CurrentValue, null, $this->skor_akutansi->ReadOnly);

            // max_akutansi
            $this->max_akutansi->setDbValueDef($rsnew, $this->max_akutansi->CurrentValue, null, $this->max_akutansi->ReadOnly);

            // skor_utangbank
            $this->skor_utangbank->setDbValueDef($rsnew, $this->skor_utangbank->CurrentValue, null, $this->skor_utangbank->ReadOnly);

            // max_utangbank
            $this->max_utangbank->setDbValueDef($rsnew, $this->max_utangbank->CurrentValue, null, $this->max_utangbank->ReadOnly);

            // skor_dokumentasi
            $this->skor_dokumentasi->setDbValueDef($rsnew, $this->skor_dokumentasi->CurrentValue, null, $this->skor_dokumentasi->ReadOnly);

            // max_dokumentasi
            $this->max_dokumentasi->setDbValueDef($rsnew, $this->max_dokumentasi->CurrentValue, null, $this->max_dokumentasi->ReadOnly);

            // skor_nontunai
            $this->skor_nontunai->setDbValueDef($rsnew, $this->skor_nontunai->CurrentValue, null, $this->skor_nontunai->ReadOnly);

            // max_nontunai
            $this->max_nontunai->setDbValueDef($rsnew, $this->max_nontunai->CurrentValue, null, $this->max_nontunai->ReadOnly);

            // skor_keuangan
            $this->skor_keuangan->setDbValueDef($rsnew, $this->skor_keuangan->CurrentValue, null, $this->skor_keuangan->ReadOnly);

            // maxskor_keuangan
            $this->maxskor_keuangan->setDbValueDef($rsnew, $this->maxskor_keuangan->CurrentValue, null, $this->maxskor_keuangan->ReadOnly);

            // bobot_keuangan
            $this->bobot_keuangan->setDbValueDef($rsnew, $this->bobot_keuangan->CurrentValue, 0, $this->bobot_keuangan->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkeuanganlist"), "", $this->TableVar, true);
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
