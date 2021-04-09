<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKelasAdd extends TempSkorKelas
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_kelas';

    // Page object name
    public $PageObjName = "TempSkorKelasAdd";

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

        // Table object (temp_skor_kelas)
        if (!isset($GLOBALS["temp_skor_kelas"]) || get_class($GLOBALS["temp_skor_kelas"]) == PROJECT_NAMESPACE . "temp_skor_kelas") {
            $GLOBALS["temp_skor_kelas"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_kelas');
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
                $doc = new $class(Container("temp_skor_kelas"));
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
                    if ($pageName == "tempskorkelasview") {
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
        $this->NAMA_PEMILIK->setVisibility();
        $this->NO_HP->setVisibility();
        $this->NAMA_USAHA->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->KAPANEWON->setVisibility();
        $this->skor_produksi->setVisibility();
        $this->maxskor_produksi->setVisibility();
        $this->bobot_produksi->setVisibility();
        $this->skor_pemasaran->setVisibility();
        $this->maxskor_pemasaran->setVisibility();
        $this->bobot_pemasaran->setVisibility();
        $this->skor_pemasaranonline->setVisibility();
        $this->maxskor_pemasaranonline->setVisibility();
        $this->bobot_pemasaranonline->setVisibility();
        $this->skor_kelembagaan->setVisibility();
        $this->maxskor_kelembagaan->setVisibility();
        $this->bobot_kelembagaan->setVisibility();
        $this->skor_keuangan->setVisibility();
        $this->maxskor_keuangan->setVisibility();
        $this->bobot_keuangan->setVisibility();
        $this->skor_sdm->setVisibility();
        $this->maxskor_sdm->setVisibility();
        $this->bobot_sdm->setVisibility();
        $this->skor_kelas->setVisibility();
        $this->maxskor_kelas->setVisibility();
        $this->kelas_umkm->setVisibility();
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
                    $this->terminate("tempskorkelaslist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "tempskorkelaslist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "tempskorkelasview") {
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
        $this->NAMA_PEMILIK->CurrentValue = null;
        $this->NAMA_PEMILIK->OldValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NO_HP->CurrentValue = null;
        $this->NO_HP->OldValue = $this->NO_HP->CurrentValue;
        $this->NAMA_USAHA->CurrentValue = null;
        $this->NAMA_USAHA->OldValue = $this->NAMA_USAHA->CurrentValue;
        $this->KALURAHAN->CurrentValue = null;
        $this->KALURAHAN->OldValue = $this->KALURAHAN->CurrentValue;
        $this->KAPANEWON->CurrentValue = null;
        $this->KAPANEWON->OldValue = $this->KAPANEWON->CurrentValue;
        $this->skor_produksi->CurrentValue = null;
        $this->skor_produksi->OldValue = $this->skor_produksi->CurrentValue;
        $this->maxskor_produksi->CurrentValue = null;
        $this->maxskor_produksi->OldValue = $this->maxskor_produksi->CurrentValue;
        $this->bobot_produksi->CurrentValue = null;
        $this->bobot_produksi->OldValue = $this->bobot_produksi->CurrentValue;
        $this->skor_pemasaran->CurrentValue = null;
        $this->skor_pemasaran->OldValue = $this->skor_pemasaran->CurrentValue;
        $this->maxskor_pemasaran->CurrentValue = null;
        $this->maxskor_pemasaran->OldValue = $this->maxskor_pemasaran->CurrentValue;
        $this->bobot_pemasaran->CurrentValue = null;
        $this->bobot_pemasaran->OldValue = $this->bobot_pemasaran->CurrentValue;
        $this->skor_pemasaranonline->CurrentValue = null;
        $this->skor_pemasaranonline->OldValue = $this->skor_pemasaranonline->CurrentValue;
        $this->maxskor_pemasaranonline->CurrentValue = null;
        $this->maxskor_pemasaranonline->OldValue = $this->maxskor_pemasaranonline->CurrentValue;
        $this->bobot_pemasaranonline->CurrentValue = null;
        $this->bobot_pemasaranonline->OldValue = $this->bobot_pemasaranonline->CurrentValue;
        $this->skor_kelembagaan->CurrentValue = null;
        $this->skor_kelembagaan->OldValue = $this->skor_kelembagaan->CurrentValue;
        $this->maxskor_kelembagaan->CurrentValue = null;
        $this->maxskor_kelembagaan->OldValue = $this->maxskor_kelembagaan->CurrentValue;
        $this->bobot_kelembagaan->CurrentValue = null;
        $this->bobot_kelembagaan->OldValue = $this->bobot_kelembagaan->CurrentValue;
        $this->skor_keuangan->CurrentValue = null;
        $this->skor_keuangan->OldValue = $this->skor_keuangan->CurrentValue;
        $this->maxskor_keuangan->CurrentValue = null;
        $this->maxskor_keuangan->OldValue = $this->maxskor_keuangan->CurrentValue;
        $this->bobot_keuangan->CurrentValue = null;
        $this->bobot_keuangan->OldValue = $this->bobot_keuangan->CurrentValue;
        $this->skor_sdm->CurrentValue = null;
        $this->skor_sdm->OldValue = $this->skor_sdm->CurrentValue;
        $this->maxskor_sdm->CurrentValue = null;
        $this->maxskor_sdm->OldValue = $this->maxskor_sdm->CurrentValue;
        $this->bobot_sdm->CurrentValue = null;
        $this->bobot_sdm->OldValue = $this->bobot_sdm->CurrentValue;
        $this->skor_kelas->CurrentValue = null;
        $this->skor_kelas->OldValue = $this->skor_kelas->CurrentValue;
        $this->maxskor_kelas->CurrentValue = null;
        $this->maxskor_kelas->OldValue = $this->maxskor_kelas->CurrentValue;
        $this->kelas_umkm->CurrentValue = null;
        $this->kelas_umkm->OldValue = $this->kelas_umkm->CurrentValue;
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

        // Check field name 'NAMA_PEMILIK' first before field var 'x_NAMA_PEMILIK'
        $val = $CurrentForm->hasValue("NAMA_PEMILIK") ? $CurrentForm->getValue("NAMA_PEMILIK") : $CurrentForm->getValue("x_NAMA_PEMILIK");
        if (!$this->NAMA_PEMILIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_PEMILIK->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_PEMILIK->setFormValue($val);
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

        // Check field name 'NAMA_USAHA' first before field var 'x_NAMA_USAHA'
        $val = $CurrentForm->hasValue("NAMA_USAHA") ? $CurrentForm->getValue("NAMA_USAHA") : $CurrentForm->getValue("x_NAMA_USAHA");
        if (!$this->NAMA_USAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_USAHA->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_USAHA->setFormValue($val);
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

        // Check field name 'KAPANEWON' first before field var 'x_KAPANEWON'
        $val = $CurrentForm->hasValue("KAPANEWON") ? $CurrentForm->getValue("KAPANEWON") : $CurrentForm->getValue("x_KAPANEWON");
        if (!$this->KAPANEWON->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KAPANEWON->Visible = false; // Disable update for API request
            } else {
                $this->KAPANEWON->setFormValue($val);
            }
        }

        // Check field name 'skor_produksi' first before field var 'x_skor_produksi'
        $val = $CurrentForm->hasValue("skor_produksi") ? $CurrentForm->getValue("skor_produksi") : $CurrentForm->getValue("x_skor_produksi");
        if (!$this->skor_produksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_produksi->Visible = false; // Disable update for API request
            } else {
                $this->skor_produksi->setFormValue($val);
            }
        }

        // Check field name 'maxskor_produksi' first before field var 'x_maxskor_produksi'
        $val = $CurrentForm->hasValue("maxskor_produksi") ? $CurrentForm->getValue("maxskor_produksi") : $CurrentForm->getValue("x_maxskor_produksi");
        if (!$this->maxskor_produksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_produksi->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_produksi->setFormValue($val);
            }
        }

        // Check field name 'bobot_produksi' first before field var 'x_bobot_produksi'
        $val = $CurrentForm->hasValue("bobot_produksi") ? $CurrentForm->getValue("bobot_produksi") : $CurrentForm->getValue("x_bobot_produksi");
        if (!$this->bobot_produksi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_produksi->Visible = false; // Disable update for API request
            } else {
                $this->bobot_produksi->setFormValue($val);
            }
        }

        // Check field name 'skor_pemasaran' first before field var 'x_skor_pemasaran'
        $val = $CurrentForm->hasValue("skor_pemasaran") ? $CurrentForm->getValue("skor_pemasaran") : $CurrentForm->getValue("x_skor_pemasaran");
        if (!$this->skor_pemasaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pemasaran->Visible = false; // Disable update for API request
            } else {
                $this->skor_pemasaran->setFormValue($val);
            }
        }

        // Check field name 'maxskor_pemasaran' first before field var 'x_maxskor_pemasaran'
        $val = $CurrentForm->hasValue("maxskor_pemasaran") ? $CurrentForm->getValue("maxskor_pemasaran") : $CurrentForm->getValue("x_maxskor_pemasaran");
        if (!$this->maxskor_pemasaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_pemasaran->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_pemasaran->setFormValue($val);
            }
        }

        // Check field name 'bobot_pemasaran' first before field var 'x_bobot_pemasaran'
        $val = $CurrentForm->hasValue("bobot_pemasaran") ? $CurrentForm->getValue("bobot_pemasaran") : $CurrentForm->getValue("x_bobot_pemasaran");
        if (!$this->bobot_pemasaran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_pemasaran->Visible = false; // Disable update for API request
            } else {
                $this->bobot_pemasaran->setFormValue($val);
            }
        }

        // Check field name 'skor_pemasaranonline' first before field var 'x_skor_pemasaranonline'
        $val = $CurrentForm->hasValue("skor_pemasaranonline") ? $CurrentForm->getValue("skor_pemasaranonline") : $CurrentForm->getValue("x_skor_pemasaranonline");
        if (!$this->skor_pemasaranonline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pemasaranonline->Visible = false; // Disable update for API request
            } else {
                $this->skor_pemasaranonline->setFormValue($val);
            }
        }

        // Check field name 'maxskor_pemasaranonline' first before field var 'x_maxskor_pemasaranonline'
        $val = $CurrentForm->hasValue("maxskor_pemasaranonline") ? $CurrentForm->getValue("maxskor_pemasaranonline") : $CurrentForm->getValue("x_maxskor_pemasaranonline");
        if (!$this->maxskor_pemasaranonline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_pemasaranonline->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_pemasaranonline->setFormValue($val);
            }
        }

        // Check field name 'bobot_pemasaranonline' first before field var 'x_bobot_pemasaranonline'
        $val = $CurrentForm->hasValue("bobot_pemasaranonline") ? $CurrentForm->getValue("bobot_pemasaranonline") : $CurrentForm->getValue("x_bobot_pemasaranonline");
        if (!$this->bobot_pemasaranonline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->bobot_pemasaranonline->Visible = false; // Disable update for API request
            } else {
                $this->bobot_pemasaranonline->setFormValue($val);
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

        // Check field name 'skor_kelas' first before field var 'x_skor_kelas'
        $val = $CurrentForm->hasValue("skor_kelas") ? $CurrentForm->getValue("skor_kelas") : $CurrentForm->getValue("x_skor_kelas");
        if (!$this->skor_kelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_kelas->Visible = false; // Disable update for API request
            } else {
                $this->skor_kelas->setFormValue($val);
            }
        }

        // Check field name 'maxskor_kelas' first before field var 'x_maxskor_kelas'
        $val = $CurrentForm->hasValue("maxskor_kelas") ? $CurrentForm->getValue("maxskor_kelas") : $CurrentForm->getValue("x_maxskor_kelas");
        if (!$this->maxskor_kelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->maxskor_kelas->Visible = false; // Disable update for API request
            } else {
                $this->maxskor_kelas->setFormValue($val);
            }
        }

        // Check field name 'kelas_umkm' first before field var 'x_kelas_umkm'
        $val = $CurrentForm->hasValue("kelas_umkm") ? $CurrentForm->getValue("kelas_umkm") : $CurrentForm->getValue("x_kelas_umkm");
        if (!$this->kelas_umkm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kelas_umkm->Visible = false; // Disable update for API request
            } else {
                $this->kelas_umkm->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->NAMA_PEMILIK->CurrentValue = $this->NAMA_PEMILIK->FormValue;
        $this->NO_HP->CurrentValue = $this->NO_HP->FormValue;
        $this->NAMA_USAHA->CurrentValue = $this->NAMA_USAHA->FormValue;
        $this->KALURAHAN->CurrentValue = $this->KALURAHAN->FormValue;
        $this->KAPANEWON->CurrentValue = $this->KAPANEWON->FormValue;
        $this->skor_produksi->CurrentValue = $this->skor_produksi->FormValue;
        $this->maxskor_produksi->CurrentValue = $this->maxskor_produksi->FormValue;
        $this->bobot_produksi->CurrentValue = $this->bobot_produksi->FormValue;
        $this->skor_pemasaran->CurrentValue = $this->skor_pemasaran->FormValue;
        $this->maxskor_pemasaran->CurrentValue = $this->maxskor_pemasaran->FormValue;
        $this->bobot_pemasaran->CurrentValue = $this->bobot_pemasaran->FormValue;
        $this->skor_pemasaranonline->CurrentValue = $this->skor_pemasaranonline->FormValue;
        $this->maxskor_pemasaranonline->CurrentValue = $this->maxskor_pemasaranonline->FormValue;
        $this->bobot_pemasaranonline->CurrentValue = $this->bobot_pemasaranonline->FormValue;
        $this->skor_kelembagaan->CurrentValue = $this->skor_kelembagaan->FormValue;
        $this->maxskor_kelembagaan->CurrentValue = $this->maxskor_kelembagaan->FormValue;
        $this->bobot_kelembagaan->CurrentValue = $this->bobot_kelembagaan->FormValue;
        $this->skor_keuangan->CurrentValue = $this->skor_keuangan->FormValue;
        $this->maxskor_keuangan->CurrentValue = $this->maxskor_keuangan->FormValue;
        $this->bobot_keuangan->CurrentValue = $this->bobot_keuangan->FormValue;
        $this->skor_sdm->CurrentValue = $this->skor_sdm->FormValue;
        $this->maxskor_sdm->CurrentValue = $this->maxskor_sdm->FormValue;
        $this->bobot_sdm->CurrentValue = $this->bobot_sdm->FormValue;
        $this->skor_kelas->CurrentValue = $this->skor_kelas->FormValue;
        $this->maxskor_kelas->CurrentValue = $this->maxskor_kelas->FormValue;
        $this->kelas_umkm->CurrentValue = $this->kelas_umkm->FormValue;
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
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->skor_produksi->setDbValue($row['skor_produksi']);
        $this->maxskor_produksi->setDbValue($row['maxskor_produksi']);
        $this->bobot_produksi->setDbValue($row['bobot_produksi']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
        $this->skor_keuangan->setDbValue($row['skor_keuangan']);
        $this->maxskor_keuangan->setDbValue($row['maxskor_keuangan']);
        $this->bobot_keuangan->setDbValue($row['bobot_keuangan']);
        $this->skor_sdm->setDbValue($row['skor_sdm']);
        $this->maxskor_sdm->setDbValue($row['maxskor_sdm']);
        $this->bobot_sdm->setDbValue($row['bobot_sdm']);
        $this->skor_kelas->setDbValue($row['skor_kelas']);
        $this->maxskor_kelas->setDbValue($row['maxskor_kelas']);
        $this->kelas_umkm->setDbValue($row['kelas_umkm']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['NAMA_PEMILIK'] = $this->NAMA_PEMILIK->CurrentValue;
        $row['NO_HP'] = $this->NO_HP->CurrentValue;
        $row['NAMA_USAHA'] = $this->NAMA_USAHA->CurrentValue;
        $row['KALURAHAN'] = $this->KALURAHAN->CurrentValue;
        $row['KAPANEWON'] = $this->KAPANEWON->CurrentValue;
        $row['skor_produksi'] = $this->skor_produksi->CurrentValue;
        $row['maxskor_produksi'] = $this->maxskor_produksi->CurrentValue;
        $row['bobot_produksi'] = $this->bobot_produksi->CurrentValue;
        $row['skor_pemasaran'] = $this->skor_pemasaran->CurrentValue;
        $row['maxskor_pemasaran'] = $this->maxskor_pemasaran->CurrentValue;
        $row['bobot_pemasaran'] = $this->bobot_pemasaran->CurrentValue;
        $row['skor_pemasaranonline'] = $this->skor_pemasaranonline->CurrentValue;
        $row['maxskor_pemasaranonline'] = $this->maxskor_pemasaranonline->CurrentValue;
        $row['bobot_pemasaranonline'] = $this->bobot_pemasaranonline->CurrentValue;
        $row['skor_kelembagaan'] = $this->skor_kelembagaan->CurrentValue;
        $row['maxskor_kelembagaan'] = $this->maxskor_kelembagaan->CurrentValue;
        $row['bobot_kelembagaan'] = $this->bobot_kelembagaan->CurrentValue;
        $row['skor_keuangan'] = $this->skor_keuangan->CurrentValue;
        $row['maxskor_keuangan'] = $this->maxskor_keuangan->CurrentValue;
        $row['bobot_keuangan'] = $this->bobot_keuangan->CurrentValue;
        $row['skor_sdm'] = $this->skor_sdm->CurrentValue;
        $row['maxskor_sdm'] = $this->maxskor_sdm->CurrentValue;
        $row['bobot_sdm'] = $this->bobot_sdm->CurrentValue;
        $row['skor_kelas'] = $this->skor_kelas->CurrentValue;
        $row['maxskor_kelas'] = $this->maxskor_kelas->CurrentValue;
        $row['kelas_umkm'] = $this->kelas_umkm->CurrentValue;
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
        if ($this->skor_produksi->FormValue == $this->skor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_produksi->CurrentValue))) {
            $this->skor_produksi->CurrentValue = ConvertToFloatString($this->skor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_produksi->FormValue == $this->maxskor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_produksi->CurrentValue))) {
            $this->maxskor_produksi->CurrentValue = ConvertToFloatString($this->maxskor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaran->FormValue == $this->skor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaran->CurrentValue))) {
            $this->skor_pemasaran->CurrentValue = ConvertToFloatString($this->skor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaran->FormValue == $this->maxskor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaran->CurrentValue))) {
            $this->maxskor_pemasaran->CurrentValue = ConvertToFloatString($this->maxskor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaranonline->FormValue == $this->skor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaranonline->CurrentValue))) {
            $this->skor_pemasaranonline->CurrentValue = ConvertToFloatString($this->skor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaranonline->FormValue == $this->maxskor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue))) {
            $this->maxskor_pemasaranonline->CurrentValue = ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelembagaan->FormValue == $this->skor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelembagaan->CurrentValue))) {
            $this->skor_kelembagaan->CurrentValue = ConvertToFloatString($this->skor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelembagaan->FormValue == $this->maxskor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue))) {
            $this->maxskor_kelembagaan->CurrentValue = ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_keuangan->FormValue == $this->skor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_keuangan->CurrentValue))) {
            $this->skor_keuangan->CurrentValue = ConvertToFloatString($this->skor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_keuangan->FormValue == $this->maxskor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_keuangan->CurrentValue))) {
            $this->maxskor_keuangan->CurrentValue = ConvertToFloatString($this->maxskor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sdm->FormValue == $this->skor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sdm->CurrentValue))) {
            $this->skor_sdm->CurrentValue = ConvertToFloatString($this->skor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_sdm->FormValue == $this->maxskor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_sdm->CurrentValue))) {
            $this->maxskor_sdm->CurrentValue = ConvertToFloatString($this->maxskor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelas->FormValue == $this->skor_kelas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelas->CurrentValue))) {
            $this->skor_kelas->CurrentValue = ConvertToFloatString($this->skor_kelas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelas->FormValue == $this->maxskor_kelas->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelas->CurrentValue))) {
            $this->maxskor_kelas->CurrentValue = ConvertToFloatString($this->maxskor_kelas->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // NAMA_PEMILIK

        // NO_HP

        // NAMA_USAHA

        // KALURAHAN

        // KAPANEWON

        // skor_produksi

        // maxskor_produksi

        // bobot_produksi

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan

        // skor_keuangan

        // maxskor_keuangan

        // bobot_keuangan

        // skor_sdm

        // maxskor_sdm

        // bobot_sdm

        // skor_kelas

        // maxskor_kelas

        // kelas_umkm
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
            $this->NAMA_PEMILIK->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
            $this->NAMA_USAHA->ViewCustomAttributes = "";

            // KALURAHAN
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
            $this->KALURAHAN->ViewCustomAttributes = "";

            // KAPANEWON
            $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
            $this->KAPANEWON->ViewCustomAttributes = "";

            // skor_produksi
            $this->skor_produksi->ViewValue = $this->skor_produksi->CurrentValue;
            $this->skor_produksi->ViewValue = FormatNumber($this->skor_produksi->ViewValue, 2, -2, -2, -2);
            $this->skor_produksi->ViewCustomAttributes = "";

            // maxskor_produksi
            $this->maxskor_produksi->ViewValue = $this->maxskor_produksi->CurrentValue;
            $this->maxskor_produksi->ViewValue = FormatNumber($this->maxskor_produksi->ViewValue, 2, -2, -2, -2);
            $this->maxskor_produksi->ViewCustomAttributes = "";

            // bobot_produksi
            $this->bobot_produksi->ViewValue = $this->bobot_produksi->CurrentValue;
            $this->bobot_produksi->ViewValue = FormatNumber($this->bobot_produksi->ViewValue, 0, -2, -2, -2);
            $this->bobot_produksi->ViewCustomAttributes = "";

            // skor_pemasaran
            $this->skor_pemasaran->ViewValue = $this->skor_pemasaran->CurrentValue;
            $this->skor_pemasaran->ViewValue = FormatNumber($this->skor_pemasaran->ViewValue, 2, -2, -2, -2);
            $this->skor_pemasaran->ViewCustomAttributes = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->ViewValue = $this->maxskor_pemasaran->CurrentValue;
            $this->maxskor_pemasaran->ViewValue = FormatNumber($this->maxskor_pemasaran->ViewValue, 2, -2, -2, -2);
            $this->maxskor_pemasaran->ViewCustomAttributes = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->ViewValue = $this->bobot_pemasaran->CurrentValue;
            $this->bobot_pemasaran->ViewValue = FormatNumber($this->bobot_pemasaran->ViewValue, 0, -2, -2, -2);
            $this->bobot_pemasaran->ViewCustomAttributes = "";

            // skor_pemasaranonline
            $this->skor_pemasaranonline->ViewValue = $this->skor_pemasaranonline->CurrentValue;
            $this->skor_pemasaranonline->ViewValue = FormatNumber($this->skor_pemasaranonline->ViewValue, 2, -2, -2, -2);
            $this->skor_pemasaranonline->ViewCustomAttributes = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->ViewValue = $this->maxskor_pemasaranonline->CurrentValue;
            $this->maxskor_pemasaranonline->ViewValue = FormatNumber($this->maxskor_pemasaranonline->ViewValue, 2, -2, -2, -2);
            $this->maxskor_pemasaranonline->ViewCustomAttributes = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->ViewValue = $this->bobot_pemasaranonline->CurrentValue;
            $this->bobot_pemasaranonline->ViewValue = FormatNumber($this->bobot_pemasaranonline->ViewValue, 0, -2, -2, -2);
            $this->bobot_pemasaranonline->ViewCustomAttributes = "";

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

            // skor_kelas
            $this->skor_kelas->ViewValue = $this->skor_kelas->CurrentValue;
            $this->skor_kelas->ViewValue = FormatNumber($this->skor_kelas->ViewValue, 2, -2, -2, -2);
            $this->skor_kelas->ViewCustomAttributes = "";

            // maxskor_kelas
            $this->maxskor_kelas->ViewValue = $this->maxskor_kelas->CurrentValue;
            $this->maxskor_kelas->ViewValue = FormatNumber($this->maxskor_kelas->ViewValue, 2, -2, -2, -2);
            $this->maxskor_kelas->ViewCustomAttributes = "";

            // kelas_umkm
            $this->kelas_umkm->ViewValue = $this->kelas_umkm->CurrentValue;
            $this->kelas_umkm->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";
            $this->NAMA_PEMILIK->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";
            $this->NAMA_USAHA->TooltipValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";
            $this->KALURAHAN->TooltipValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";
            $this->KAPANEWON->TooltipValue = "";

            // skor_produksi
            $this->skor_produksi->LinkCustomAttributes = "";
            $this->skor_produksi->HrefValue = "";
            $this->skor_produksi->TooltipValue = "";

            // maxskor_produksi
            $this->maxskor_produksi->LinkCustomAttributes = "";
            $this->maxskor_produksi->HrefValue = "";
            $this->maxskor_produksi->TooltipValue = "";

            // bobot_produksi
            $this->bobot_produksi->LinkCustomAttributes = "";
            $this->bobot_produksi->HrefValue = "";
            $this->bobot_produksi->TooltipValue = "";

            // skor_pemasaran
            $this->skor_pemasaran->LinkCustomAttributes = "";
            $this->skor_pemasaran->HrefValue = "";
            $this->skor_pemasaran->TooltipValue = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->LinkCustomAttributes = "";
            $this->maxskor_pemasaran->HrefValue = "";
            $this->maxskor_pemasaran->TooltipValue = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->LinkCustomAttributes = "";
            $this->bobot_pemasaran->HrefValue = "";
            $this->bobot_pemasaran->TooltipValue = "";

            // skor_pemasaranonline
            $this->skor_pemasaranonline->LinkCustomAttributes = "";
            $this->skor_pemasaranonline->HrefValue = "";
            $this->skor_pemasaranonline->TooltipValue = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->LinkCustomAttributes = "";
            $this->maxskor_pemasaranonline->HrefValue = "";
            $this->maxskor_pemasaranonline->TooltipValue = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->LinkCustomAttributes = "";
            $this->bobot_pemasaranonline->HrefValue = "";
            $this->bobot_pemasaranonline->TooltipValue = "";

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

            // skor_kelas
            $this->skor_kelas->LinkCustomAttributes = "";
            $this->skor_kelas->HrefValue = "";
            $this->skor_kelas->TooltipValue = "";

            // maxskor_kelas
            $this->maxskor_kelas->LinkCustomAttributes = "";
            $this->maxskor_kelas->HrefValue = "";
            $this->maxskor_kelas->TooltipValue = "";

            // kelas_umkm
            $this->kelas_umkm->LinkCustomAttributes = "";
            $this->kelas_umkm->HrefValue = "";
            $this->kelas_umkm->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
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

            // NO_HP
            $this->NO_HP->EditAttrs["class"] = "form-control";
            $this->NO_HP->EditCustomAttributes = "";
            if (!$this->NO_HP->Raw) {
                $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
            }
            $this->NO_HP->EditValue = HtmlEncode($this->NO_HP->CurrentValue);
            $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

            // NAMA_USAHA
            $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
            $this->NAMA_USAHA->EditCustomAttributes = "";
            if (!$this->NAMA_USAHA->Raw) {
                $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
            }
            $this->NAMA_USAHA->EditValue = HtmlEncode($this->NAMA_USAHA->CurrentValue);
            $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

            // KALURAHAN
            $this->KALURAHAN->EditAttrs["class"] = "form-control";
            $this->KALURAHAN->EditCustomAttributes = "";
            if (!$this->KALURAHAN->Raw) {
                $this->KALURAHAN->CurrentValue = HtmlDecode($this->KALURAHAN->CurrentValue);
            }
            $this->KALURAHAN->EditValue = HtmlEncode($this->KALURAHAN->CurrentValue);
            $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

            // KAPANEWON
            $this->KAPANEWON->EditAttrs["class"] = "form-control";
            $this->KAPANEWON->EditCustomAttributes = "";
            if (!$this->KAPANEWON->Raw) {
                $this->KAPANEWON->CurrentValue = HtmlDecode($this->KAPANEWON->CurrentValue);
            }
            $this->KAPANEWON->EditValue = HtmlEncode($this->KAPANEWON->CurrentValue);
            $this->KAPANEWON->PlaceHolder = RemoveHtml($this->KAPANEWON->caption());

            // skor_produksi
            $this->skor_produksi->EditAttrs["class"] = "form-control";
            $this->skor_produksi->EditCustomAttributes = "";
            $this->skor_produksi->EditValue = HtmlEncode($this->skor_produksi->CurrentValue);
            $this->skor_produksi->PlaceHolder = RemoveHtml($this->skor_produksi->caption());
            if (strval($this->skor_produksi->EditValue) != "" && is_numeric($this->skor_produksi->EditValue)) {
                $this->skor_produksi->EditValue = FormatNumber($this->skor_produksi->EditValue, -2, -2, -2, -2);
            }

            // maxskor_produksi
            $this->maxskor_produksi->EditAttrs["class"] = "form-control";
            $this->maxskor_produksi->EditCustomAttributes = "";
            $this->maxskor_produksi->EditValue = HtmlEncode($this->maxskor_produksi->CurrentValue);
            $this->maxskor_produksi->PlaceHolder = RemoveHtml($this->maxskor_produksi->caption());
            if (strval($this->maxskor_produksi->EditValue) != "" && is_numeric($this->maxskor_produksi->EditValue)) {
                $this->maxskor_produksi->EditValue = FormatNumber($this->maxskor_produksi->EditValue, -2, -2, -2, -2);
            }

            // bobot_produksi
            $this->bobot_produksi->EditAttrs["class"] = "form-control";
            $this->bobot_produksi->EditCustomAttributes = "";
            $this->bobot_produksi->EditValue = HtmlEncode($this->bobot_produksi->CurrentValue);
            $this->bobot_produksi->PlaceHolder = RemoveHtml($this->bobot_produksi->caption());

            // skor_pemasaran
            $this->skor_pemasaran->EditAttrs["class"] = "form-control";
            $this->skor_pemasaran->EditCustomAttributes = "";
            $this->skor_pemasaran->EditValue = HtmlEncode($this->skor_pemasaran->CurrentValue);
            $this->skor_pemasaran->PlaceHolder = RemoveHtml($this->skor_pemasaran->caption());
            if (strval($this->skor_pemasaran->EditValue) != "" && is_numeric($this->skor_pemasaran->EditValue)) {
                $this->skor_pemasaran->EditValue = FormatNumber($this->skor_pemasaran->EditValue, -2, -2, -2, -2);
            }

            // maxskor_pemasaran
            $this->maxskor_pemasaran->EditAttrs["class"] = "form-control";
            $this->maxskor_pemasaran->EditCustomAttributes = "";
            $this->maxskor_pemasaran->EditValue = HtmlEncode($this->maxskor_pemasaran->CurrentValue);
            $this->maxskor_pemasaran->PlaceHolder = RemoveHtml($this->maxskor_pemasaran->caption());
            if (strval($this->maxskor_pemasaran->EditValue) != "" && is_numeric($this->maxskor_pemasaran->EditValue)) {
                $this->maxskor_pemasaran->EditValue = FormatNumber($this->maxskor_pemasaran->EditValue, -2, -2, -2, -2);
            }

            // bobot_pemasaran
            $this->bobot_pemasaran->EditAttrs["class"] = "form-control";
            $this->bobot_pemasaran->EditCustomAttributes = "";
            $this->bobot_pemasaran->EditValue = HtmlEncode($this->bobot_pemasaran->CurrentValue);
            $this->bobot_pemasaran->PlaceHolder = RemoveHtml($this->bobot_pemasaran->caption());

            // skor_pemasaranonline
            $this->skor_pemasaranonline->EditAttrs["class"] = "form-control";
            $this->skor_pemasaranonline->EditCustomAttributes = "";
            $this->skor_pemasaranonline->EditValue = HtmlEncode($this->skor_pemasaranonline->CurrentValue);
            $this->skor_pemasaranonline->PlaceHolder = RemoveHtml($this->skor_pemasaranonline->caption());
            if (strval($this->skor_pemasaranonline->EditValue) != "" && is_numeric($this->skor_pemasaranonline->EditValue)) {
                $this->skor_pemasaranonline->EditValue = FormatNumber($this->skor_pemasaranonline->EditValue, -2, -2, -2, -2);
            }

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->EditAttrs["class"] = "form-control";
            $this->maxskor_pemasaranonline->EditCustomAttributes = "";
            $this->maxskor_pemasaranonline->EditValue = HtmlEncode($this->maxskor_pemasaranonline->CurrentValue);
            $this->maxskor_pemasaranonline->PlaceHolder = RemoveHtml($this->maxskor_pemasaranonline->caption());
            if (strval($this->maxskor_pemasaranonline->EditValue) != "" && is_numeric($this->maxskor_pemasaranonline->EditValue)) {
                $this->maxskor_pemasaranonline->EditValue = FormatNumber($this->maxskor_pemasaranonline->EditValue, -2, -2, -2, -2);
            }

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->EditAttrs["class"] = "form-control";
            $this->bobot_pemasaranonline->EditCustomAttributes = "";
            $this->bobot_pemasaranonline->EditValue = HtmlEncode($this->bobot_pemasaranonline->CurrentValue);
            $this->bobot_pemasaranonline->PlaceHolder = RemoveHtml($this->bobot_pemasaranonline->caption());

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

            // skor_kelas
            $this->skor_kelas->EditAttrs["class"] = "form-control";
            $this->skor_kelas->EditCustomAttributes = "";
            $this->skor_kelas->EditValue = HtmlEncode($this->skor_kelas->CurrentValue);
            $this->skor_kelas->PlaceHolder = RemoveHtml($this->skor_kelas->caption());
            if (strval($this->skor_kelas->EditValue) != "" && is_numeric($this->skor_kelas->EditValue)) {
                $this->skor_kelas->EditValue = FormatNumber($this->skor_kelas->EditValue, -2, -2, -2, -2);
            }

            // maxskor_kelas
            $this->maxskor_kelas->EditAttrs["class"] = "form-control";
            $this->maxskor_kelas->EditCustomAttributes = "";
            $this->maxskor_kelas->EditValue = HtmlEncode($this->maxskor_kelas->CurrentValue);
            $this->maxskor_kelas->PlaceHolder = RemoveHtml($this->maxskor_kelas->caption());
            if (strval($this->maxskor_kelas->EditValue) != "" && is_numeric($this->maxskor_kelas->EditValue)) {
                $this->maxskor_kelas->EditValue = FormatNumber($this->maxskor_kelas->EditValue, -2, -2, -2, -2);
            }

            // kelas_umkm
            $this->kelas_umkm->EditAttrs["class"] = "form-control";
            $this->kelas_umkm->EditCustomAttributes = "";
            if (!$this->kelas_umkm->Raw) {
                $this->kelas_umkm->CurrentValue = HtmlDecode($this->kelas_umkm->CurrentValue);
            }
            $this->kelas_umkm->EditValue = HtmlEncode($this->kelas_umkm->CurrentValue);
            $this->kelas_umkm->PlaceHolder = RemoveHtml($this->kelas_umkm->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";

            // skor_produksi
            $this->skor_produksi->LinkCustomAttributes = "";
            $this->skor_produksi->HrefValue = "";

            // maxskor_produksi
            $this->maxskor_produksi->LinkCustomAttributes = "";
            $this->maxskor_produksi->HrefValue = "";

            // bobot_produksi
            $this->bobot_produksi->LinkCustomAttributes = "";
            $this->bobot_produksi->HrefValue = "";

            // skor_pemasaran
            $this->skor_pemasaran->LinkCustomAttributes = "";
            $this->skor_pemasaran->HrefValue = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->LinkCustomAttributes = "";
            $this->maxskor_pemasaran->HrefValue = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->LinkCustomAttributes = "";
            $this->bobot_pemasaran->HrefValue = "";

            // skor_pemasaranonline
            $this->skor_pemasaranonline->LinkCustomAttributes = "";
            $this->skor_pemasaranonline->HrefValue = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->LinkCustomAttributes = "";
            $this->maxskor_pemasaranonline->HrefValue = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->LinkCustomAttributes = "";
            $this->bobot_pemasaranonline->HrefValue = "";

            // skor_kelembagaan
            $this->skor_kelembagaan->LinkCustomAttributes = "";
            $this->skor_kelembagaan->HrefValue = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->LinkCustomAttributes = "";
            $this->maxskor_kelembagaan->HrefValue = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->LinkCustomAttributes = "";
            $this->bobot_kelembagaan->HrefValue = "";

            // skor_keuangan
            $this->skor_keuangan->LinkCustomAttributes = "";
            $this->skor_keuangan->HrefValue = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->LinkCustomAttributes = "";
            $this->maxskor_keuangan->HrefValue = "";

            // bobot_keuangan
            $this->bobot_keuangan->LinkCustomAttributes = "";
            $this->bobot_keuangan->HrefValue = "";

            // skor_sdm
            $this->skor_sdm->LinkCustomAttributes = "";
            $this->skor_sdm->HrefValue = "";

            // maxskor_sdm
            $this->maxskor_sdm->LinkCustomAttributes = "";
            $this->maxskor_sdm->HrefValue = "";

            // bobot_sdm
            $this->bobot_sdm->LinkCustomAttributes = "";
            $this->bobot_sdm->HrefValue = "";

            // skor_kelas
            $this->skor_kelas->LinkCustomAttributes = "";
            $this->skor_kelas->HrefValue = "";

            // maxskor_kelas
            $this->maxskor_kelas->LinkCustomAttributes = "";
            $this->maxskor_kelas->HrefValue = "";

            // kelas_umkm
            $this->kelas_umkm->LinkCustomAttributes = "";
            $this->kelas_umkm->HrefValue = "";
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
        if ($this->NAMA_PEMILIK->Required) {
            if (!$this->NAMA_PEMILIK->IsDetailKey && EmptyValue($this->NAMA_PEMILIK->FormValue)) {
                $this->NAMA_PEMILIK->addErrorMessage(str_replace("%s", $this->NAMA_PEMILIK->caption(), $this->NAMA_PEMILIK->RequiredErrorMessage));
            }
        }
        if ($this->NO_HP->Required) {
            if (!$this->NO_HP->IsDetailKey && EmptyValue($this->NO_HP->FormValue)) {
                $this->NO_HP->addErrorMessage(str_replace("%s", $this->NO_HP->caption(), $this->NO_HP->RequiredErrorMessage));
            }
        }
        if ($this->NAMA_USAHA->Required) {
            if (!$this->NAMA_USAHA->IsDetailKey && EmptyValue($this->NAMA_USAHA->FormValue)) {
                $this->NAMA_USAHA->addErrorMessage(str_replace("%s", $this->NAMA_USAHA->caption(), $this->NAMA_USAHA->RequiredErrorMessage));
            }
        }
        if ($this->KALURAHAN->Required) {
            if (!$this->KALURAHAN->IsDetailKey && EmptyValue($this->KALURAHAN->FormValue)) {
                $this->KALURAHAN->addErrorMessage(str_replace("%s", $this->KALURAHAN->caption(), $this->KALURAHAN->RequiredErrorMessage));
            }
        }
        if ($this->KAPANEWON->Required) {
            if (!$this->KAPANEWON->IsDetailKey && EmptyValue($this->KAPANEWON->FormValue)) {
                $this->KAPANEWON->addErrorMessage(str_replace("%s", $this->KAPANEWON->caption(), $this->KAPANEWON->RequiredErrorMessage));
            }
        }
        if ($this->skor_produksi->Required) {
            if (!$this->skor_produksi->IsDetailKey && EmptyValue($this->skor_produksi->FormValue)) {
                $this->skor_produksi->addErrorMessage(str_replace("%s", $this->skor_produksi->caption(), $this->skor_produksi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_produksi->FormValue)) {
            $this->skor_produksi->addErrorMessage($this->skor_produksi->getErrorMessage(false));
        }
        if ($this->maxskor_produksi->Required) {
            if (!$this->maxskor_produksi->IsDetailKey && EmptyValue($this->maxskor_produksi->FormValue)) {
                $this->maxskor_produksi->addErrorMessage(str_replace("%s", $this->maxskor_produksi->caption(), $this->maxskor_produksi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_produksi->FormValue)) {
            $this->maxskor_produksi->addErrorMessage($this->maxskor_produksi->getErrorMessage(false));
        }
        if ($this->bobot_produksi->Required) {
            if (!$this->bobot_produksi->IsDetailKey && EmptyValue($this->bobot_produksi->FormValue)) {
                $this->bobot_produksi->addErrorMessage(str_replace("%s", $this->bobot_produksi->caption(), $this->bobot_produksi->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_produksi->FormValue)) {
            $this->bobot_produksi->addErrorMessage($this->bobot_produksi->getErrorMessage(false));
        }
        if ($this->skor_pemasaran->Required) {
            if (!$this->skor_pemasaran->IsDetailKey && EmptyValue($this->skor_pemasaran->FormValue)) {
                $this->skor_pemasaran->addErrorMessage(str_replace("%s", $this->skor_pemasaran->caption(), $this->skor_pemasaran->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pemasaran->FormValue)) {
            $this->skor_pemasaran->addErrorMessage($this->skor_pemasaran->getErrorMessage(false));
        }
        if ($this->maxskor_pemasaran->Required) {
            if (!$this->maxskor_pemasaran->IsDetailKey && EmptyValue($this->maxskor_pemasaran->FormValue)) {
                $this->maxskor_pemasaran->addErrorMessage(str_replace("%s", $this->maxskor_pemasaran->caption(), $this->maxskor_pemasaran->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_pemasaran->FormValue)) {
            $this->maxskor_pemasaran->addErrorMessage($this->maxskor_pemasaran->getErrorMessage(false));
        }
        if ($this->bobot_pemasaran->Required) {
            if (!$this->bobot_pemasaran->IsDetailKey && EmptyValue($this->bobot_pemasaran->FormValue)) {
                $this->bobot_pemasaran->addErrorMessage(str_replace("%s", $this->bobot_pemasaran->caption(), $this->bobot_pemasaran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_pemasaran->FormValue)) {
            $this->bobot_pemasaran->addErrorMessage($this->bobot_pemasaran->getErrorMessage(false));
        }
        if ($this->skor_pemasaranonline->Required) {
            if (!$this->skor_pemasaranonline->IsDetailKey && EmptyValue($this->skor_pemasaranonline->FormValue)) {
                $this->skor_pemasaranonline->addErrorMessage(str_replace("%s", $this->skor_pemasaranonline->caption(), $this->skor_pemasaranonline->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pemasaranonline->FormValue)) {
            $this->skor_pemasaranonline->addErrorMessage($this->skor_pemasaranonline->getErrorMessage(false));
        }
        if ($this->maxskor_pemasaranonline->Required) {
            if (!$this->maxskor_pemasaranonline->IsDetailKey && EmptyValue($this->maxskor_pemasaranonline->FormValue)) {
                $this->maxskor_pemasaranonline->addErrorMessage(str_replace("%s", $this->maxskor_pemasaranonline->caption(), $this->maxskor_pemasaranonline->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_pemasaranonline->FormValue)) {
            $this->maxskor_pemasaranonline->addErrorMessage($this->maxskor_pemasaranonline->getErrorMessage(false));
        }
        if ($this->bobot_pemasaranonline->Required) {
            if (!$this->bobot_pemasaranonline->IsDetailKey && EmptyValue($this->bobot_pemasaranonline->FormValue)) {
                $this->bobot_pemasaranonline->addErrorMessage(str_replace("%s", $this->bobot_pemasaranonline->caption(), $this->bobot_pemasaranonline->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->bobot_pemasaranonline->FormValue)) {
            $this->bobot_pemasaranonline->addErrorMessage($this->bobot_pemasaranonline->getErrorMessage(false));
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
        if ($this->skor_kelas->Required) {
            if (!$this->skor_kelas->IsDetailKey && EmptyValue($this->skor_kelas->FormValue)) {
                $this->skor_kelas->addErrorMessage(str_replace("%s", $this->skor_kelas->caption(), $this->skor_kelas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_kelas->FormValue)) {
            $this->skor_kelas->addErrorMessage($this->skor_kelas->getErrorMessage(false));
        }
        if ($this->maxskor_kelas->Required) {
            if (!$this->maxskor_kelas->IsDetailKey && EmptyValue($this->maxskor_kelas->FormValue)) {
                $this->maxskor_kelas->addErrorMessage(str_replace("%s", $this->maxskor_kelas->caption(), $this->maxskor_kelas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->maxskor_kelas->FormValue)) {
            $this->maxskor_kelas->addErrorMessage($this->maxskor_kelas->getErrorMessage(false));
        }
        if ($this->kelas_umkm->Required) {
            if (!$this->kelas_umkm->IsDetailKey && EmptyValue($this->kelas_umkm->FormValue)) {
                $this->kelas_umkm->addErrorMessage(str_replace("%s", $this->kelas_umkm->caption(), $this->kelas_umkm->RequiredErrorMessage));
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
        $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "", false);

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->setDbValueDef($rsnew, $this->NAMA_PEMILIK->CurrentValue, null, false);

        // NO_HP
        $this->NO_HP->setDbValueDef($rsnew, $this->NO_HP->CurrentValue, null, false);

        // NAMA_USAHA
        $this->NAMA_USAHA->setDbValueDef($rsnew, $this->NAMA_USAHA->CurrentValue, null, false);

        // KALURAHAN
        $this->KALURAHAN->setDbValueDef($rsnew, $this->KALURAHAN->CurrentValue, null, false);

        // KAPANEWON
        $this->KAPANEWON->setDbValueDef($rsnew, $this->KAPANEWON->CurrentValue, null, false);

        // skor_produksi
        $this->skor_produksi->setDbValueDef($rsnew, $this->skor_produksi->CurrentValue, null, false);

        // maxskor_produksi
        $this->maxskor_produksi->setDbValueDef($rsnew, $this->maxskor_produksi->CurrentValue, null, false);

        // bobot_produksi
        $this->bobot_produksi->setDbValueDef($rsnew, $this->bobot_produksi->CurrentValue, 0, false);

        // skor_pemasaran
        $this->skor_pemasaran->setDbValueDef($rsnew, $this->skor_pemasaran->CurrentValue, null, false);

        // maxskor_pemasaran
        $this->maxskor_pemasaran->setDbValueDef($rsnew, $this->maxskor_pemasaran->CurrentValue, null, false);

        // bobot_pemasaran
        $this->bobot_pemasaran->setDbValueDef($rsnew, $this->bobot_pemasaran->CurrentValue, 0, false);

        // skor_pemasaranonline
        $this->skor_pemasaranonline->setDbValueDef($rsnew, $this->skor_pemasaranonline->CurrentValue, null, false);

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline->setDbValueDef($rsnew, $this->maxskor_pemasaranonline->CurrentValue, null, false);

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline->setDbValueDef($rsnew, $this->bobot_pemasaranonline->CurrentValue, 0, false);

        // skor_kelembagaan
        $this->skor_kelembagaan->setDbValueDef($rsnew, $this->skor_kelembagaan->CurrentValue, null, false);

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->setDbValueDef($rsnew, $this->maxskor_kelembagaan->CurrentValue, null, false);

        // bobot_kelembagaan
        $this->bobot_kelembagaan->setDbValueDef($rsnew, $this->bobot_kelembagaan->CurrentValue, 0, false);

        // skor_keuangan
        $this->skor_keuangan->setDbValueDef($rsnew, $this->skor_keuangan->CurrentValue, null, false);

        // maxskor_keuangan
        $this->maxskor_keuangan->setDbValueDef($rsnew, $this->maxskor_keuangan->CurrentValue, null, false);

        // bobot_keuangan
        $this->bobot_keuangan->setDbValueDef($rsnew, $this->bobot_keuangan->CurrentValue, 0, false);

        // skor_sdm
        $this->skor_sdm->setDbValueDef($rsnew, $this->skor_sdm->CurrentValue, null, false);

        // maxskor_sdm
        $this->maxskor_sdm->setDbValueDef($rsnew, $this->maxskor_sdm->CurrentValue, null, false);

        // bobot_sdm
        $this->bobot_sdm->setDbValueDef($rsnew, $this->bobot_sdm->CurrentValue, 0, false);

        // skor_kelas
        $this->skor_kelas->setDbValueDef($rsnew, $this->skor_kelas->CurrentValue, null, false);

        // maxskor_kelas
        $this->maxskor_kelas->setDbValueDef($rsnew, $this->maxskor_kelas->CurrentValue, null, false);

        // kelas_umkm
        $this->kelas_umkm->setDbValueDef($rsnew, $this->kelas_umkm->CurrentValue, "", false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkelaslist"), "", $this->TableVar, true);
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
