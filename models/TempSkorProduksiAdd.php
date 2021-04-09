<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorProduksiAdd extends TempSkorProduksi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_produksi';

    // Page object name
    public $PageObjName = "TempSkorProduksiAdd";

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

        // Table object (temp_skor_produksi)
        if (!isset($GLOBALS["temp_skor_produksi"]) || get_class($GLOBALS["temp_skor_produksi"]) == PROJECT_NAMESPACE . "temp_skor_produksi") {
            $GLOBALS["temp_skor_produksi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_produksi');
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
                $doc = new $class(Container("temp_skor_produksi"));
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
                    if ($pageName == "tempskorproduksiview") {
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
        $this->nik->setVisibility();
        $this->skor_aktifitas->setVisibility();
        $this->max_aktifitas->setVisibility();
        $this->skor_kapasitas->setVisibility();
        $this->max_kapasitas->setVisibility();
        $this->skor_pangan->setVisibility();
        $this->max_pangan->setVisibility();
        $this->skor_sni->setVisibility();
        $this->max_sni->setVisibility();
        $this->skor_kemasan->setVisibility();
        $this->max_kemasan->setVisibility();
        $this->skor_bahanbaku->setVisibility();
        $this->max_bahanbaku->setVisibility();
        $this->skor_alat->setVisibility();
        $this->max_alat->setVisibility();
        $this->skor_gudang->setVisibility();
        $this->max_gudang->setVisibility();
        $this->skor_layout->setVisibility();
        $this->max_layout->setVisibility();
        $this->skor_sop->setVisibility();
        $this->max_sop->setVisibility();
        $this->skor_produksi->setVisibility();
        $this->maxskor_produksi->setVisibility();
        $this->bobot_produksi->setVisibility();
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
            if (($keyValue = Get("nik") ?? Route("nik")) !== null) {
                $this->nik->setQueryStringValue($keyValue);
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
                    $this->terminate("tempskorproduksilist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "tempskorproduksilist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "tempskorproduksiview") {
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
        $this->nik->CurrentValue = null;
        $this->nik->OldValue = $this->nik->CurrentValue;
        $this->skor_aktifitas->CurrentValue = null;
        $this->skor_aktifitas->OldValue = $this->skor_aktifitas->CurrentValue;
        $this->max_aktifitas->CurrentValue = null;
        $this->max_aktifitas->OldValue = $this->max_aktifitas->CurrentValue;
        $this->skor_kapasitas->CurrentValue = null;
        $this->skor_kapasitas->OldValue = $this->skor_kapasitas->CurrentValue;
        $this->max_kapasitas->CurrentValue = null;
        $this->max_kapasitas->OldValue = $this->max_kapasitas->CurrentValue;
        $this->skor_pangan->CurrentValue = null;
        $this->skor_pangan->OldValue = $this->skor_pangan->CurrentValue;
        $this->max_pangan->CurrentValue = null;
        $this->max_pangan->OldValue = $this->max_pangan->CurrentValue;
        $this->skor_sni->CurrentValue = null;
        $this->skor_sni->OldValue = $this->skor_sni->CurrentValue;
        $this->max_sni->CurrentValue = null;
        $this->max_sni->OldValue = $this->max_sni->CurrentValue;
        $this->skor_kemasan->CurrentValue = null;
        $this->skor_kemasan->OldValue = $this->skor_kemasan->CurrentValue;
        $this->max_kemasan->CurrentValue = null;
        $this->max_kemasan->OldValue = $this->max_kemasan->CurrentValue;
        $this->skor_bahanbaku->CurrentValue = null;
        $this->skor_bahanbaku->OldValue = $this->skor_bahanbaku->CurrentValue;
        $this->max_bahanbaku->CurrentValue = null;
        $this->max_bahanbaku->OldValue = $this->max_bahanbaku->CurrentValue;
        $this->skor_alat->CurrentValue = null;
        $this->skor_alat->OldValue = $this->skor_alat->CurrentValue;
        $this->max_alat->CurrentValue = null;
        $this->max_alat->OldValue = $this->max_alat->CurrentValue;
        $this->skor_gudang->CurrentValue = null;
        $this->skor_gudang->OldValue = $this->skor_gudang->CurrentValue;
        $this->max_gudang->CurrentValue = null;
        $this->max_gudang->OldValue = $this->max_gudang->CurrentValue;
        $this->skor_layout->CurrentValue = null;
        $this->skor_layout->OldValue = $this->skor_layout->CurrentValue;
        $this->max_layout->CurrentValue = null;
        $this->max_layout->OldValue = $this->max_layout->CurrentValue;
        $this->skor_sop->CurrentValue = null;
        $this->skor_sop->OldValue = $this->skor_sop->CurrentValue;
        $this->max_sop->CurrentValue = null;
        $this->max_sop->OldValue = $this->max_sop->CurrentValue;
        $this->skor_produksi->CurrentValue = null;
        $this->skor_produksi->OldValue = $this->skor_produksi->CurrentValue;
        $this->maxskor_produksi->CurrentValue = null;
        $this->maxskor_produksi->OldValue = $this->maxskor_produksi->CurrentValue;
        $this->bobot_produksi->CurrentValue = null;
        $this->bobot_produksi->OldValue = $this->bobot_produksi->CurrentValue;
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

        // Check field name 'skor_aktifitas' first before field var 'x_skor_aktifitas'
        $val = $CurrentForm->hasValue("skor_aktifitas") ? $CurrentForm->getValue("skor_aktifitas") : $CurrentForm->getValue("x_skor_aktifitas");
        if (!$this->skor_aktifitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_aktifitas->Visible = false; // Disable update for API request
            } else {
                $this->skor_aktifitas->setFormValue($val);
            }
        }

        // Check field name 'max_aktifitas' first before field var 'x_max_aktifitas'
        $val = $CurrentForm->hasValue("max_aktifitas") ? $CurrentForm->getValue("max_aktifitas") : $CurrentForm->getValue("x_max_aktifitas");
        if (!$this->max_aktifitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_aktifitas->Visible = false; // Disable update for API request
            } else {
                $this->max_aktifitas->setFormValue($val);
            }
        }

        // Check field name 'skor_kapasitas' first before field var 'x_skor_kapasitas'
        $val = $CurrentForm->hasValue("skor_kapasitas") ? $CurrentForm->getValue("skor_kapasitas") : $CurrentForm->getValue("x_skor_kapasitas");
        if (!$this->skor_kapasitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_kapasitas->Visible = false; // Disable update for API request
            } else {
                $this->skor_kapasitas->setFormValue($val);
            }
        }

        // Check field name 'max_kapasitas' first before field var 'x_max_kapasitas'
        $val = $CurrentForm->hasValue("max_kapasitas") ? $CurrentForm->getValue("max_kapasitas") : $CurrentForm->getValue("x_max_kapasitas");
        if (!$this->max_kapasitas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_kapasitas->Visible = false; // Disable update for API request
            } else {
                $this->max_kapasitas->setFormValue($val);
            }
        }

        // Check field name 'skor_pangan' first before field var 'x_skor_pangan'
        $val = $CurrentForm->hasValue("skor_pangan") ? $CurrentForm->getValue("skor_pangan") : $CurrentForm->getValue("x_skor_pangan");
        if (!$this->skor_pangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pangan->Visible = false; // Disable update for API request
            } else {
                $this->skor_pangan->setFormValue($val);
            }
        }

        // Check field name 'max_pangan' first before field var 'x_max_pangan'
        $val = $CurrentForm->hasValue("max_pangan") ? $CurrentForm->getValue("max_pangan") : $CurrentForm->getValue("x_max_pangan");
        if (!$this->max_pangan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_pangan->Visible = false; // Disable update for API request
            } else {
                $this->max_pangan->setFormValue($val);
            }
        }

        // Check field name 'skor_sni' first before field var 'x_skor_sni'
        $val = $CurrentForm->hasValue("skor_sni") ? $CurrentForm->getValue("skor_sni") : $CurrentForm->getValue("x_skor_sni");
        if (!$this->skor_sni->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_sni->Visible = false; // Disable update for API request
            } else {
                $this->skor_sni->setFormValue($val);
            }
        }

        // Check field name 'max_sni' first before field var 'x_max_sni'
        $val = $CurrentForm->hasValue("max_sni") ? $CurrentForm->getValue("max_sni") : $CurrentForm->getValue("x_max_sni");
        if (!$this->max_sni->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_sni->Visible = false; // Disable update for API request
            } else {
                $this->max_sni->setFormValue($val);
            }
        }

        // Check field name 'skor_kemasan' first before field var 'x_skor_kemasan'
        $val = $CurrentForm->hasValue("skor_kemasan") ? $CurrentForm->getValue("skor_kemasan") : $CurrentForm->getValue("x_skor_kemasan");
        if (!$this->skor_kemasan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_kemasan->Visible = false; // Disable update for API request
            } else {
                $this->skor_kemasan->setFormValue($val);
            }
        }

        // Check field name 'max_kemasan' first before field var 'x_max_kemasan'
        $val = $CurrentForm->hasValue("max_kemasan") ? $CurrentForm->getValue("max_kemasan") : $CurrentForm->getValue("x_max_kemasan");
        if (!$this->max_kemasan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_kemasan->Visible = false; // Disable update for API request
            } else {
                $this->max_kemasan->setFormValue($val);
            }
        }

        // Check field name 'skor_bahanbaku' first before field var 'x_skor_bahanbaku'
        $val = $CurrentForm->hasValue("skor_bahanbaku") ? $CurrentForm->getValue("skor_bahanbaku") : $CurrentForm->getValue("x_skor_bahanbaku");
        if (!$this->skor_bahanbaku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_bahanbaku->Visible = false; // Disable update for API request
            } else {
                $this->skor_bahanbaku->setFormValue($val);
            }
        }

        // Check field name 'max_bahanbaku' first before field var 'x_max_bahanbaku'
        $val = $CurrentForm->hasValue("max_bahanbaku") ? $CurrentForm->getValue("max_bahanbaku") : $CurrentForm->getValue("x_max_bahanbaku");
        if (!$this->max_bahanbaku->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_bahanbaku->Visible = false; // Disable update for API request
            } else {
                $this->max_bahanbaku->setFormValue($val);
            }
        }

        // Check field name 'skor_alat' first before field var 'x_skor_alat'
        $val = $CurrentForm->hasValue("skor_alat") ? $CurrentForm->getValue("skor_alat") : $CurrentForm->getValue("x_skor_alat");
        if (!$this->skor_alat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_alat->Visible = false; // Disable update for API request
            } else {
                $this->skor_alat->setFormValue($val);
            }
        }

        // Check field name 'max_alat' first before field var 'x_max_alat'
        $val = $CurrentForm->hasValue("max_alat") ? $CurrentForm->getValue("max_alat") : $CurrentForm->getValue("x_max_alat");
        if (!$this->max_alat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_alat->Visible = false; // Disable update for API request
            } else {
                $this->max_alat->setFormValue($val);
            }
        }

        // Check field name 'skor_gudang' first before field var 'x_skor_gudang'
        $val = $CurrentForm->hasValue("skor_gudang") ? $CurrentForm->getValue("skor_gudang") : $CurrentForm->getValue("x_skor_gudang");
        if (!$this->skor_gudang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_gudang->Visible = false; // Disable update for API request
            } else {
                $this->skor_gudang->setFormValue($val);
            }
        }

        // Check field name 'max_gudang' first before field var 'x_max_gudang'
        $val = $CurrentForm->hasValue("max_gudang") ? $CurrentForm->getValue("max_gudang") : $CurrentForm->getValue("x_max_gudang");
        if (!$this->max_gudang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_gudang->Visible = false; // Disable update for API request
            } else {
                $this->max_gudang->setFormValue($val);
            }
        }

        // Check field name 'skor_layout' first before field var 'x_skor_layout'
        $val = $CurrentForm->hasValue("skor_layout") ? $CurrentForm->getValue("skor_layout") : $CurrentForm->getValue("x_skor_layout");
        if (!$this->skor_layout->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_layout->Visible = false; // Disable update for API request
            } else {
                $this->skor_layout->setFormValue($val);
            }
        }

        // Check field name 'max_layout' first before field var 'x_max_layout'
        $val = $CurrentForm->hasValue("max_layout") ? $CurrentForm->getValue("max_layout") : $CurrentForm->getValue("x_max_layout");
        if (!$this->max_layout->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_layout->Visible = false; // Disable update for API request
            } else {
                $this->max_layout->setFormValue($val);
            }
        }

        // Check field name 'skor_sop' first before field var 'x_skor_sop'
        $val = $CurrentForm->hasValue("skor_sop") ? $CurrentForm->getValue("skor_sop") : $CurrentForm->getValue("x_skor_sop");
        if (!$this->skor_sop->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_sop->Visible = false; // Disable update for API request
            } else {
                $this->skor_sop->setFormValue($val);
            }
        }

        // Check field name 'max_sop' first before field var 'x_max_sop'
        $val = $CurrentForm->hasValue("max_sop") ? $CurrentForm->getValue("max_sop") : $CurrentForm->getValue("x_max_sop");
        if (!$this->max_sop->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_sop->Visible = false; // Disable update for API request
            } else {
                $this->max_sop->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->skor_aktifitas->CurrentValue = $this->skor_aktifitas->FormValue;
        $this->max_aktifitas->CurrentValue = $this->max_aktifitas->FormValue;
        $this->skor_kapasitas->CurrentValue = $this->skor_kapasitas->FormValue;
        $this->max_kapasitas->CurrentValue = $this->max_kapasitas->FormValue;
        $this->skor_pangan->CurrentValue = $this->skor_pangan->FormValue;
        $this->max_pangan->CurrentValue = $this->max_pangan->FormValue;
        $this->skor_sni->CurrentValue = $this->skor_sni->FormValue;
        $this->max_sni->CurrentValue = $this->max_sni->FormValue;
        $this->skor_kemasan->CurrentValue = $this->skor_kemasan->FormValue;
        $this->max_kemasan->CurrentValue = $this->max_kemasan->FormValue;
        $this->skor_bahanbaku->CurrentValue = $this->skor_bahanbaku->FormValue;
        $this->max_bahanbaku->CurrentValue = $this->max_bahanbaku->FormValue;
        $this->skor_alat->CurrentValue = $this->skor_alat->FormValue;
        $this->max_alat->CurrentValue = $this->max_alat->FormValue;
        $this->skor_gudang->CurrentValue = $this->skor_gudang->FormValue;
        $this->max_gudang->CurrentValue = $this->max_gudang->FormValue;
        $this->skor_layout->CurrentValue = $this->skor_layout->FormValue;
        $this->max_layout->CurrentValue = $this->max_layout->FormValue;
        $this->skor_sop->CurrentValue = $this->skor_sop->FormValue;
        $this->max_sop->CurrentValue = $this->max_sop->FormValue;
        $this->skor_produksi->CurrentValue = $this->skor_produksi->FormValue;
        $this->maxskor_produksi->CurrentValue = $this->maxskor_produksi->FormValue;
        $this->bobot_produksi->CurrentValue = $this->bobot_produksi->FormValue;
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
        $this->skor_aktifitas->setDbValue($row['skor_aktifitas']);
        $this->max_aktifitas->setDbValue($row['max_aktifitas']);
        $this->skor_kapasitas->setDbValue($row['skor_kapasitas']);
        $this->max_kapasitas->setDbValue($row['max_kapasitas']);
        $this->skor_pangan->setDbValue($row['skor_pangan']);
        $this->max_pangan->setDbValue($row['max_pangan']);
        $this->skor_sni->setDbValue($row['skor_sni']);
        $this->max_sni->setDbValue($row['max_sni']);
        $this->skor_kemasan->setDbValue($row['skor_kemasan']);
        $this->max_kemasan->setDbValue($row['max_kemasan']);
        $this->skor_bahanbaku->setDbValue($row['skor_bahanbaku']);
        $this->max_bahanbaku->setDbValue($row['max_bahanbaku']);
        $this->skor_alat->setDbValue($row['skor_alat']);
        $this->max_alat->setDbValue($row['max_alat']);
        $this->skor_gudang->setDbValue($row['skor_gudang']);
        $this->max_gudang->setDbValue($row['max_gudang']);
        $this->skor_layout->setDbValue($row['skor_layout']);
        $this->max_layout->setDbValue($row['max_layout']);
        $this->skor_sop->setDbValue($row['skor_sop']);
        $this->max_sop->setDbValue($row['max_sop']);
        $this->skor_produksi->setDbValue($row['skor_produksi']);
        $this->maxskor_produksi->setDbValue($row['maxskor_produksi']);
        $this->bobot_produksi->setDbValue($row['bobot_produksi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['nik'] = $this->nik->CurrentValue;
        $row['skor_aktifitas'] = $this->skor_aktifitas->CurrentValue;
        $row['max_aktifitas'] = $this->max_aktifitas->CurrentValue;
        $row['skor_kapasitas'] = $this->skor_kapasitas->CurrentValue;
        $row['max_kapasitas'] = $this->max_kapasitas->CurrentValue;
        $row['skor_pangan'] = $this->skor_pangan->CurrentValue;
        $row['max_pangan'] = $this->max_pangan->CurrentValue;
        $row['skor_sni'] = $this->skor_sni->CurrentValue;
        $row['max_sni'] = $this->max_sni->CurrentValue;
        $row['skor_kemasan'] = $this->skor_kemasan->CurrentValue;
        $row['max_kemasan'] = $this->max_kemasan->CurrentValue;
        $row['skor_bahanbaku'] = $this->skor_bahanbaku->CurrentValue;
        $row['max_bahanbaku'] = $this->max_bahanbaku->CurrentValue;
        $row['skor_alat'] = $this->skor_alat->CurrentValue;
        $row['max_alat'] = $this->max_alat->CurrentValue;
        $row['skor_gudang'] = $this->skor_gudang->CurrentValue;
        $row['max_gudang'] = $this->max_gudang->CurrentValue;
        $row['skor_layout'] = $this->skor_layout->CurrentValue;
        $row['max_layout'] = $this->max_layout->CurrentValue;
        $row['skor_sop'] = $this->skor_sop->CurrentValue;
        $row['max_sop'] = $this->max_sop->CurrentValue;
        $row['skor_produksi'] = $this->skor_produksi->CurrentValue;
        $row['maxskor_produksi'] = $this->maxskor_produksi->CurrentValue;
        $row['bobot_produksi'] = $this->bobot_produksi->CurrentValue;
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
        if ($this->skor_aktifitas->FormValue == $this->skor_aktifitas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_aktifitas->CurrentValue))) {
            $this->skor_aktifitas->CurrentValue = ConvertToFloatString($this->skor_aktifitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_aktifitas->FormValue == $this->max_aktifitas->CurrentValue && is_numeric(ConvertToFloatString($this->max_aktifitas->CurrentValue))) {
            $this->max_aktifitas->CurrentValue = ConvertToFloatString($this->max_aktifitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kapasitas->FormValue == $this->skor_kapasitas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kapasitas->CurrentValue))) {
            $this->skor_kapasitas->CurrentValue = ConvertToFloatString($this->skor_kapasitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_kapasitas->FormValue == $this->max_kapasitas->CurrentValue && is_numeric(ConvertToFloatString($this->max_kapasitas->CurrentValue))) {
            $this->max_kapasitas->CurrentValue = ConvertToFloatString($this->max_kapasitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pangan->FormValue == $this->skor_pangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pangan->CurrentValue))) {
            $this->skor_pangan->CurrentValue = ConvertToFloatString($this->skor_pangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pangan->FormValue == $this->max_pangan->CurrentValue && is_numeric(ConvertToFloatString($this->max_pangan->CurrentValue))) {
            $this->max_pangan->CurrentValue = ConvertToFloatString($this->max_pangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sni->FormValue == $this->skor_sni->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sni->CurrentValue))) {
            $this->skor_sni->CurrentValue = ConvertToFloatString($this->skor_sni->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_sni->FormValue == $this->max_sni->CurrentValue && is_numeric(ConvertToFloatString($this->max_sni->CurrentValue))) {
            $this->max_sni->CurrentValue = ConvertToFloatString($this->max_sni->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kemasan->FormValue == $this->skor_kemasan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kemasan->CurrentValue))) {
            $this->skor_kemasan->CurrentValue = ConvertToFloatString($this->skor_kemasan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_kemasan->FormValue == $this->max_kemasan->CurrentValue && is_numeric(ConvertToFloatString($this->max_kemasan->CurrentValue))) {
            $this->max_kemasan->CurrentValue = ConvertToFloatString($this->max_kemasan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_bahanbaku->FormValue == $this->skor_bahanbaku->CurrentValue && is_numeric(ConvertToFloatString($this->skor_bahanbaku->CurrentValue))) {
            $this->skor_bahanbaku->CurrentValue = ConvertToFloatString($this->skor_bahanbaku->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_bahanbaku->FormValue == $this->max_bahanbaku->CurrentValue && is_numeric(ConvertToFloatString($this->max_bahanbaku->CurrentValue))) {
            $this->max_bahanbaku->CurrentValue = ConvertToFloatString($this->max_bahanbaku->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_alat->FormValue == $this->skor_alat->CurrentValue && is_numeric(ConvertToFloatString($this->skor_alat->CurrentValue))) {
            $this->skor_alat->CurrentValue = ConvertToFloatString($this->skor_alat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_alat->FormValue == $this->max_alat->CurrentValue && is_numeric(ConvertToFloatString($this->max_alat->CurrentValue))) {
            $this->max_alat->CurrentValue = ConvertToFloatString($this->max_alat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_gudang->FormValue == $this->skor_gudang->CurrentValue && is_numeric(ConvertToFloatString($this->skor_gudang->CurrentValue))) {
            $this->skor_gudang->CurrentValue = ConvertToFloatString($this->skor_gudang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_gudang->FormValue == $this->max_gudang->CurrentValue && is_numeric(ConvertToFloatString($this->max_gudang->CurrentValue))) {
            $this->max_gudang->CurrentValue = ConvertToFloatString($this->max_gudang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_layout->FormValue == $this->skor_layout->CurrentValue && is_numeric(ConvertToFloatString($this->skor_layout->CurrentValue))) {
            $this->skor_layout->CurrentValue = ConvertToFloatString($this->skor_layout->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_layout->FormValue == $this->max_layout->CurrentValue && is_numeric(ConvertToFloatString($this->max_layout->CurrentValue))) {
            $this->max_layout->CurrentValue = ConvertToFloatString($this->max_layout->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sop->FormValue == $this->skor_sop->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sop->CurrentValue))) {
            $this->skor_sop->CurrentValue = ConvertToFloatString($this->skor_sop->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_sop->FormValue == $this->max_sop->CurrentValue && is_numeric(ConvertToFloatString($this->max_sop->CurrentValue))) {
            $this->max_sop->CurrentValue = ConvertToFloatString($this->max_sop->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_produksi->FormValue == $this->skor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_produksi->CurrentValue))) {
            $this->skor_produksi->CurrentValue = ConvertToFloatString($this->skor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_produksi->FormValue == $this->maxskor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_produksi->CurrentValue))) {
            $this->maxskor_produksi->CurrentValue = ConvertToFloatString($this->maxskor_produksi->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_aktifitas

        // max_aktifitas

        // skor_kapasitas

        // max_kapasitas

        // skor_pangan

        // max_pangan

        // skor_sni

        // max_sni

        // skor_kemasan

        // max_kemasan

        // skor_bahanbaku

        // max_bahanbaku

        // skor_alat

        // max_alat

        // skor_gudang

        // max_gudang

        // skor_layout

        // max_layout

        // skor_sop

        // max_sop

        // skor_produksi

        // maxskor_produksi

        // bobot_produksi
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_aktifitas
            $this->skor_aktifitas->ViewValue = $this->skor_aktifitas->CurrentValue;
            $this->skor_aktifitas->ViewValue = FormatNumber($this->skor_aktifitas->ViewValue, 2, -2, -2, -2);
            $this->skor_aktifitas->ViewCustomAttributes = "";

            // max_aktifitas
            $this->max_aktifitas->ViewValue = $this->max_aktifitas->CurrentValue;
            $this->max_aktifitas->ViewValue = FormatNumber($this->max_aktifitas->ViewValue, 2, -2, -2, -2);
            $this->max_aktifitas->ViewCustomAttributes = "";

            // skor_kapasitas
            $this->skor_kapasitas->ViewValue = $this->skor_kapasitas->CurrentValue;
            $this->skor_kapasitas->ViewValue = FormatNumber($this->skor_kapasitas->ViewValue, 2, -2, -2, -2);
            $this->skor_kapasitas->ViewCustomAttributes = "";

            // max_kapasitas
            $this->max_kapasitas->ViewValue = $this->max_kapasitas->CurrentValue;
            $this->max_kapasitas->ViewValue = FormatNumber($this->max_kapasitas->ViewValue, 2, -2, -2, -2);
            $this->max_kapasitas->ViewCustomAttributes = "";

            // skor_pangan
            $this->skor_pangan->ViewValue = $this->skor_pangan->CurrentValue;
            $this->skor_pangan->ViewValue = FormatNumber($this->skor_pangan->ViewValue, 2, -2, -2, -2);
            $this->skor_pangan->ViewCustomAttributes = "";

            // max_pangan
            $this->max_pangan->ViewValue = $this->max_pangan->CurrentValue;
            $this->max_pangan->ViewValue = FormatNumber($this->max_pangan->ViewValue, 2, -2, -2, -2);
            $this->max_pangan->ViewCustomAttributes = "";

            // skor_sni
            $this->skor_sni->ViewValue = $this->skor_sni->CurrentValue;
            $this->skor_sni->ViewValue = FormatNumber($this->skor_sni->ViewValue, 2, -2, -2, -2);
            $this->skor_sni->ViewCustomAttributes = "";

            // max_sni
            $this->max_sni->ViewValue = $this->max_sni->CurrentValue;
            $this->max_sni->ViewValue = FormatNumber($this->max_sni->ViewValue, 2, -2, -2, -2);
            $this->max_sni->ViewCustomAttributes = "";

            // skor_kemasan
            $this->skor_kemasan->ViewValue = $this->skor_kemasan->CurrentValue;
            $this->skor_kemasan->ViewValue = FormatNumber($this->skor_kemasan->ViewValue, 2, -2, -2, -2);
            $this->skor_kemasan->ViewCustomAttributes = "";

            // max_kemasan
            $this->max_kemasan->ViewValue = $this->max_kemasan->CurrentValue;
            $this->max_kemasan->ViewValue = FormatNumber($this->max_kemasan->ViewValue, 2, -2, -2, -2);
            $this->max_kemasan->ViewCustomAttributes = "";

            // skor_bahanbaku
            $this->skor_bahanbaku->ViewValue = $this->skor_bahanbaku->CurrentValue;
            $this->skor_bahanbaku->ViewValue = FormatNumber($this->skor_bahanbaku->ViewValue, 2, -2, -2, -2);
            $this->skor_bahanbaku->ViewCustomAttributes = "";

            // max_bahanbaku
            $this->max_bahanbaku->ViewValue = $this->max_bahanbaku->CurrentValue;
            $this->max_bahanbaku->ViewValue = FormatNumber($this->max_bahanbaku->ViewValue, 2, -2, -2, -2);
            $this->max_bahanbaku->ViewCustomAttributes = "";

            // skor_alat
            $this->skor_alat->ViewValue = $this->skor_alat->CurrentValue;
            $this->skor_alat->ViewValue = FormatNumber($this->skor_alat->ViewValue, 2, -2, -2, -2);
            $this->skor_alat->ViewCustomAttributes = "";

            // max_alat
            $this->max_alat->ViewValue = $this->max_alat->CurrentValue;
            $this->max_alat->ViewValue = FormatNumber($this->max_alat->ViewValue, 2, -2, -2, -2);
            $this->max_alat->ViewCustomAttributes = "";

            // skor_gudang
            $this->skor_gudang->ViewValue = $this->skor_gudang->CurrentValue;
            $this->skor_gudang->ViewValue = FormatNumber($this->skor_gudang->ViewValue, 2, -2, -2, -2);
            $this->skor_gudang->ViewCustomAttributes = "";

            // max_gudang
            $this->max_gudang->ViewValue = $this->max_gudang->CurrentValue;
            $this->max_gudang->ViewValue = FormatNumber($this->max_gudang->ViewValue, 2, -2, -2, -2);
            $this->max_gudang->ViewCustomAttributes = "";

            // skor_layout
            $this->skor_layout->ViewValue = $this->skor_layout->CurrentValue;
            $this->skor_layout->ViewValue = FormatNumber($this->skor_layout->ViewValue, 2, -2, -2, -2);
            $this->skor_layout->ViewCustomAttributes = "";

            // max_layout
            $this->max_layout->ViewValue = $this->max_layout->CurrentValue;
            $this->max_layout->ViewValue = FormatNumber($this->max_layout->ViewValue, 2, -2, -2, -2);
            $this->max_layout->ViewCustomAttributes = "";

            // skor_sop
            $this->skor_sop->ViewValue = $this->skor_sop->CurrentValue;
            $this->skor_sop->ViewValue = FormatNumber($this->skor_sop->ViewValue, 2, -2, -2, -2);
            $this->skor_sop->ViewCustomAttributes = "";

            // max_sop
            $this->max_sop->ViewValue = $this->max_sop->CurrentValue;
            $this->max_sop->ViewValue = FormatNumber($this->max_sop->ViewValue, 2, -2, -2, -2);
            $this->max_sop->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_aktifitas
            $this->skor_aktifitas->LinkCustomAttributes = "";
            $this->skor_aktifitas->HrefValue = "";
            $this->skor_aktifitas->TooltipValue = "";

            // max_aktifitas
            $this->max_aktifitas->LinkCustomAttributes = "";
            $this->max_aktifitas->HrefValue = "";
            $this->max_aktifitas->TooltipValue = "";

            // skor_kapasitas
            $this->skor_kapasitas->LinkCustomAttributes = "";
            $this->skor_kapasitas->HrefValue = "";
            $this->skor_kapasitas->TooltipValue = "";

            // max_kapasitas
            $this->max_kapasitas->LinkCustomAttributes = "";
            $this->max_kapasitas->HrefValue = "";
            $this->max_kapasitas->TooltipValue = "";

            // skor_pangan
            $this->skor_pangan->LinkCustomAttributes = "";
            $this->skor_pangan->HrefValue = "";
            $this->skor_pangan->TooltipValue = "";

            // max_pangan
            $this->max_pangan->LinkCustomAttributes = "";
            $this->max_pangan->HrefValue = "";
            $this->max_pangan->TooltipValue = "";

            // skor_sni
            $this->skor_sni->LinkCustomAttributes = "";
            $this->skor_sni->HrefValue = "";
            $this->skor_sni->TooltipValue = "";

            // max_sni
            $this->max_sni->LinkCustomAttributes = "";
            $this->max_sni->HrefValue = "";
            $this->max_sni->TooltipValue = "";

            // skor_kemasan
            $this->skor_kemasan->LinkCustomAttributes = "";
            $this->skor_kemasan->HrefValue = "";
            $this->skor_kemasan->TooltipValue = "";

            // max_kemasan
            $this->max_kemasan->LinkCustomAttributes = "";
            $this->max_kemasan->HrefValue = "";
            $this->max_kemasan->TooltipValue = "";

            // skor_bahanbaku
            $this->skor_bahanbaku->LinkCustomAttributes = "";
            $this->skor_bahanbaku->HrefValue = "";
            $this->skor_bahanbaku->TooltipValue = "";

            // max_bahanbaku
            $this->max_bahanbaku->LinkCustomAttributes = "";
            $this->max_bahanbaku->HrefValue = "";
            $this->max_bahanbaku->TooltipValue = "";

            // skor_alat
            $this->skor_alat->LinkCustomAttributes = "";
            $this->skor_alat->HrefValue = "";
            $this->skor_alat->TooltipValue = "";

            // max_alat
            $this->max_alat->LinkCustomAttributes = "";
            $this->max_alat->HrefValue = "";
            $this->max_alat->TooltipValue = "";

            // skor_gudang
            $this->skor_gudang->LinkCustomAttributes = "";
            $this->skor_gudang->HrefValue = "";
            $this->skor_gudang->TooltipValue = "";

            // max_gudang
            $this->max_gudang->LinkCustomAttributes = "";
            $this->max_gudang->HrefValue = "";
            $this->max_gudang->TooltipValue = "";

            // skor_layout
            $this->skor_layout->LinkCustomAttributes = "";
            $this->skor_layout->HrefValue = "";
            $this->skor_layout->TooltipValue = "";

            // max_layout
            $this->max_layout->LinkCustomAttributes = "";
            $this->max_layout->HrefValue = "";
            $this->max_layout->TooltipValue = "";

            // skor_sop
            $this->skor_sop->LinkCustomAttributes = "";
            $this->skor_sop->HrefValue = "";
            $this->skor_sop->TooltipValue = "";

            // max_sop
            $this->max_sop->LinkCustomAttributes = "";
            $this->max_sop->HrefValue = "";
            $this->max_sop->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // skor_aktifitas
            $this->skor_aktifitas->EditAttrs["class"] = "form-control";
            $this->skor_aktifitas->EditCustomAttributes = "";
            $this->skor_aktifitas->EditValue = HtmlEncode($this->skor_aktifitas->CurrentValue);
            $this->skor_aktifitas->PlaceHolder = RemoveHtml($this->skor_aktifitas->caption());
            if (strval($this->skor_aktifitas->EditValue) != "" && is_numeric($this->skor_aktifitas->EditValue)) {
                $this->skor_aktifitas->EditValue = FormatNumber($this->skor_aktifitas->EditValue, -2, -2, -2, -2);
            }

            // max_aktifitas
            $this->max_aktifitas->EditAttrs["class"] = "form-control";
            $this->max_aktifitas->EditCustomAttributes = "";
            $this->max_aktifitas->EditValue = HtmlEncode($this->max_aktifitas->CurrentValue);
            $this->max_aktifitas->PlaceHolder = RemoveHtml($this->max_aktifitas->caption());
            if (strval($this->max_aktifitas->EditValue) != "" && is_numeric($this->max_aktifitas->EditValue)) {
                $this->max_aktifitas->EditValue = FormatNumber($this->max_aktifitas->EditValue, -2, -2, -2, -2);
            }

            // skor_kapasitas
            $this->skor_kapasitas->EditAttrs["class"] = "form-control";
            $this->skor_kapasitas->EditCustomAttributes = "";
            $this->skor_kapasitas->EditValue = HtmlEncode($this->skor_kapasitas->CurrentValue);
            $this->skor_kapasitas->PlaceHolder = RemoveHtml($this->skor_kapasitas->caption());
            if (strval($this->skor_kapasitas->EditValue) != "" && is_numeric($this->skor_kapasitas->EditValue)) {
                $this->skor_kapasitas->EditValue = FormatNumber($this->skor_kapasitas->EditValue, -2, -2, -2, -2);
            }

            // max_kapasitas
            $this->max_kapasitas->EditAttrs["class"] = "form-control";
            $this->max_kapasitas->EditCustomAttributes = "";
            $this->max_kapasitas->EditValue = HtmlEncode($this->max_kapasitas->CurrentValue);
            $this->max_kapasitas->PlaceHolder = RemoveHtml($this->max_kapasitas->caption());
            if (strval($this->max_kapasitas->EditValue) != "" && is_numeric($this->max_kapasitas->EditValue)) {
                $this->max_kapasitas->EditValue = FormatNumber($this->max_kapasitas->EditValue, -2, -2, -2, -2);
            }

            // skor_pangan
            $this->skor_pangan->EditAttrs["class"] = "form-control";
            $this->skor_pangan->EditCustomAttributes = "";
            $this->skor_pangan->EditValue = HtmlEncode($this->skor_pangan->CurrentValue);
            $this->skor_pangan->PlaceHolder = RemoveHtml($this->skor_pangan->caption());
            if (strval($this->skor_pangan->EditValue) != "" && is_numeric($this->skor_pangan->EditValue)) {
                $this->skor_pangan->EditValue = FormatNumber($this->skor_pangan->EditValue, -2, -2, -2, -2);
            }

            // max_pangan
            $this->max_pangan->EditAttrs["class"] = "form-control";
            $this->max_pangan->EditCustomAttributes = "";
            $this->max_pangan->EditValue = HtmlEncode($this->max_pangan->CurrentValue);
            $this->max_pangan->PlaceHolder = RemoveHtml($this->max_pangan->caption());
            if (strval($this->max_pangan->EditValue) != "" && is_numeric($this->max_pangan->EditValue)) {
                $this->max_pangan->EditValue = FormatNumber($this->max_pangan->EditValue, -2, -2, -2, -2);
            }

            // skor_sni
            $this->skor_sni->EditAttrs["class"] = "form-control";
            $this->skor_sni->EditCustomAttributes = "";
            $this->skor_sni->EditValue = HtmlEncode($this->skor_sni->CurrentValue);
            $this->skor_sni->PlaceHolder = RemoveHtml($this->skor_sni->caption());
            if (strval($this->skor_sni->EditValue) != "" && is_numeric($this->skor_sni->EditValue)) {
                $this->skor_sni->EditValue = FormatNumber($this->skor_sni->EditValue, -2, -2, -2, -2);
            }

            // max_sni
            $this->max_sni->EditAttrs["class"] = "form-control";
            $this->max_sni->EditCustomAttributes = "";
            $this->max_sni->EditValue = HtmlEncode($this->max_sni->CurrentValue);
            $this->max_sni->PlaceHolder = RemoveHtml($this->max_sni->caption());
            if (strval($this->max_sni->EditValue) != "" && is_numeric($this->max_sni->EditValue)) {
                $this->max_sni->EditValue = FormatNumber($this->max_sni->EditValue, -2, -2, -2, -2);
            }

            // skor_kemasan
            $this->skor_kemasan->EditAttrs["class"] = "form-control";
            $this->skor_kemasan->EditCustomAttributes = "";
            $this->skor_kemasan->EditValue = HtmlEncode($this->skor_kemasan->CurrentValue);
            $this->skor_kemasan->PlaceHolder = RemoveHtml($this->skor_kemasan->caption());
            if (strval($this->skor_kemasan->EditValue) != "" && is_numeric($this->skor_kemasan->EditValue)) {
                $this->skor_kemasan->EditValue = FormatNumber($this->skor_kemasan->EditValue, -2, -2, -2, -2);
            }

            // max_kemasan
            $this->max_kemasan->EditAttrs["class"] = "form-control";
            $this->max_kemasan->EditCustomAttributes = "";
            $this->max_kemasan->EditValue = HtmlEncode($this->max_kemasan->CurrentValue);
            $this->max_kemasan->PlaceHolder = RemoveHtml($this->max_kemasan->caption());
            if (strval($this->max_kemasan->EditValue) != "" && is_numeric($this->max_kemasan->EditValue)) {
                $this->max_kemasan->EditValue = FormatNumber($this->max_kemasan->EditValue, -2, -2, -2, -2);
            }

            // skor_bahanbaku
            $this->skor_bahanbaku->EditAttrs["class"] = "form-control";
            $this->skor_bahanbaku->EditCustomAttributes = "";
            $this->skor_bahanbaku->EditValue = HtmlEncode($this->skor_bahanbaku->CurrentValue);
            $this->skor_bahanbaku->PlaceHolder = RemoveHtml($this->skor_bahanbaku->caption());
            if (strval($this->skor_bahanbaku->EditValue) != "" && is_numeric($this->skor_bahanbaku->EditValue)) {
                $this->skor_bahanbaku->EditValue = FormatNumber($this->skor_bahanbaku->EditValue, -2, -2, -2, -2);
            }

            // max_bahanbaku
            $this->max_bahanbaku->EditAttrs["class"] = "form-control";
            $this->max_bahanbaku->EditCustomAttributes = "";
            $this->max_bahanbaku->EditValue = HtmlEncode($this->max_bahanbaku->CurrentValue);
            $this->max_bahanbaku->PlaceHolder = RemoveHtml($this->max_bahanbaku->caption());
            if (strval($this->max_bahanbaku->EditValue) != "" && is_numeric($this->max_bahanbaku->EditValue)) {
                $this->max_bahanbaku->EditValue = FormatNumber($this->max_bahanbaku->EditValue, -2, -2, -2, -2);
            }

            // skor_alat
            $this->skor_alat->EditAttrs["class"] = "form-control";
            $this->skor_alat->EditCustomAttributes = "";
            $this->skor_alat->EditValue = HtmlEncode($this->skor_alat->CurrentValue);
            $this->skor_alat->PlaceHolder = RemoveHtml($this->skor_alat->caption());
            if (strval($this->skor_alat->EditValue) != "" && is_numeric($this->skor_alat->EditValue)) {
                $this->skor_alat->EditValue = FormatNumber($this->skor_alat->EditValue, -2, -2, -2, -2);
            }

            // max_alat
            $this->max_alat->EditAttrs["class"] = "form-control";
            $this->max_alat->EditCustomAttributes = "";
            $this->max_alat->EditValue = HtmlEncode($this->max_alat->CurrentValue);
            $this->max_alat->PlaceHolder = RemoveHtml($this->max_alat->caption());
            if (strval($this->max_alat->EditValue) != "" && is_numeric($this->max_alat->EditValue)) {
                $this->max_alat->EditValue = FormatNumber($this->max_alat->EditValue, -2, -2, -2, -2);
            }

            // skor_gudang
            $this->skor_gudang->EditAttrs["class"] = "form-control";
            $this->skor_gudang->EditCustomAttributes = "";
            $this->skor_gudang->EditValue = HtmlEncode($this->skor_gudang->CurrentValue);
            $this->skor_gudang->PlaceHolder = RemoveHtml($this->skor_gudang->caption());
            if (strval($this->skor_gudang->EditValue) != "" && is_numeric($this->skor_gudang->EditValue)) {
                $this->skor_gudang->EditValue = FormatNumber($this->skor_gudang->EditValue, -2, -2, -2, -2);
            }

            // max_gudang
            $this->max_gudang->EditAttrs["class"] = "form-control";
            $this->max_gudang->EditCustomAttributes = "";
            $this->max_gudang->EditValue = HtmlEncode($this->max_gudang->CurrentValue);
            $this->max_gudang->PlaceHolder = RemoveHtml($this->max_gudang->caption());
            if (strval($this->max_gudang->EditValue) != "" && is_numeric($this->max_gudang->EditValue)) {
                $this->max_gudang->EditValue = FormatNumber($this->max_gudang->EditValue, -2, -2, -2, -2);
            }

            // skor_layout
            $this->skor_layout->EditAttrs["class"] = "form-control";
            $this->skor_layout->EditCustomAttributes = "";
            $this->skor_layout->EditValue = HtmlEncode($this->skor_layout->CurrentValue);
            $this->skor_layout->PlaceHolder = RemoveHtml($this->skor_layout->caption());
            if (strval($this->skor_layout->EditValue) != "" && is_numeric($this->skor_layout->EditValue)) {
                $this->skor_layout->EditValue = FormatNumber($this->skor_layout->EditValue, -2, -2, -2, -2);
            }

            // max_layout
            $this->max_layout->EditAttrs["class"] = "form-control";
            $this->max_layout->EditCustomAttributes = "";
            $this->max_layout->EditValue = HtmlEncode($this->max_layout->CurrentValue);
            $this->max_layout->PlaceHolder = RemoveHtml($this->max_layout->caption());
            if (strval($this->max_layout->EditValue) != "" && is_numeric($this->max_layout->EditValue)) {
                $this->max_layout->EditValue = FormatNumber($this->max_layout->EditValue, -2, -2, -2, -2);
            }

            // skor_sop
            $this->skor_sop->EditAttrs["class"] = "form-control";
            $this->skor_sop->EditCustomAttributes = "";
            $this->skor_sop->EditValue = HtmlEncode($this->skor_sop->CurrentValue);
            $this->skor_sop->PlaceHolder = RemoveHtml($this->skor_sop->caption());
            if (strval($this->skor_sop->EditValue) != "" && is_numeric($this->skor_sop->EditValue)) {
                $this->skor_sop->EditValue = FormatNumber($this->skor_sop->EditValue, -2, -2, -2, -2);
            }

            // max_sop
            $this->max_sop->EditAttrs["class"] = "form-control";
            $this->max_sop->EditCustomAttributes = "";
            $this->max_sop->EditValue = HtmlEncode($this->max_sop->CurrentValue);
            $this->max_sop->PlaceHolder = RemoveHtml($this->max_sop->caption());
            if (strval($this->max_sop->EditValue) != "" && is_numeric($this->max_sop->EditValue)) {
                $this->max_sop->EditValue = FormatNumber($this->max_sop->EditValue, -2, -2, -2, -2);
            }

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

            // Add refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // skor_aktifitas
            $this->skor_aktifitas->LinkCustomAttributes = "";
            $this->skor_aktifitas->HrefValue = "";

            // max_aktifitas
            $this->max_aktifitas->LinkCustomAttributes = "";
            $this->max_aktifitas->HrefValue = "";

            // skor_kapasitas
            $this->skor_kapasitas->LinkCustomAttributes = "";
            $this->skor_kapasitas->HrefValue = "";

            // max_kapasitas
            $this->max_kapasitas->LinkCustomAttributes = "";
            $this->max_kapasitas->HrefValue = "";

            // skor_pangan
            $this->skor_pangan->LinkCustomAttributes = "";
            $this->skor_pangan->HrefValue = "";

            // max_pangan
            $this->max_pangan->LinkCustomAttributes = "";
            $this->max_pangan->HrefValue = "";

            // skor_sni
            $this->skor_sni->LinkCustomAttributes = "";
            $this->skor_sni->HrefValue = "";

            // max_sni
            $this->max_sni->LinkCustomAttributes = "";
            $this->max_sni->HrefValue = "";

            // skor_kemasan
            $this->skor_kemasan->LinkCustomAttributes = "";
            $this->skor_kemasan->HrefValue = "";

            // max_kemasan
            $this->max_kemasan->LinkCustomAttributes = "";
            $this->max_kemasan->HrefValue = "";

            // skor_bahanbaku
            $this->skor_bahanbaku->LinkCustomAttributes = "";
            $this->skor_bahanbaku->HrefValue = "";

            // max_bahanbaku
            $this->max_bahanbaku->LinkCustomAttributes = "";
            $this->max_bahanbaku->HrefValue = "";

            // skor_alat
            $this->skor_alat->LinkCustomAttributes = "";
            $this->skor_alat->HrefValue = "";

            // max_alat
            $this->max_alat->LinkCustomAttributes = "";
            $this->max_alat->HrefValue = "";

            // skor_gudang
            $this->skor_gudang->LinkCustomAttributes = "";
            $this->skor_gudang->HrefValue = "";

            // max_gudang
            $this->max_gudang->LinkCustomAttributes = "";
            $this->max_gudang->HrefValue = "";

            // skor_layout
            $this->skor_layout->LinkCustomAttributes = "";
            $this->skor_layout->HrefValue = "";

            // max_layout
            $this->max_layout->LinkCustomAttributes = "";
            $this->max_layout->HrefValue = "";

            // skor_sop
            $this->skor_sop->LinkCustomAttributes = "";
            $this->skor_sop->HrefValue = "";

            // max_sop
            $this->max_sop->LinkCustomAttributes = "";
            $this->max_sop->HrefValue = "";

            // skor_produksi
            $this->skor_produksi->LinkCustomAttributes = "";
            $this->skor_produksi->HrefValue = "";

            // maxskor_produksi
            $this->maxskor_produksi->LinkCustomAttributes = "";
            $this->maxskor_produksi->HrefValue = "";

            // bobot_produksi
            $this->bobot_produksi->LinkCustomAttributes = "";
            $this->bobot_produksi->HrefValue = "";
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
        if ($this->skor_aktifitas->Required) {
            if (!$this->skor_aktifitas->IsDetailKey && EmptyValue($this->skor_aktifitas->FormValue)) {
                $this->skor_aktifitas->addErrorMessage(str_replace("%s", $this->skor_aktifitas->caption(), $this->skor_aktifitas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_aktifitas->FormValue)) {
            $this->skor_aktifitas->addErrorMessage($this->skor_aktifitas->getErrorMessage(false));
        }
        if ($this->max_aktifitas->Required) {
            if (!$this->max_aktifitas->IsDetailKey && EmptyValue($this->max_aktifitas->FormValue)) {
                $this->max_aktifitas->addErrorMessage(str_replace("%s", $this->max_aktifitas->caption(), $this->max_aktifitas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_aktifitas->FormValue)) {
            $this->max_aktifitas->addErrorMessage($this->max_aktifitas->getErrorMessage(false));
        }
        if ($this->skor_kapasitas->Required) {
            if (!$this->skor_kapasitas->IsDetailKey && EmptyValue($this->skor_kapasitas->FormValue)) {
                $this->skor_kapasitas->addErrorMessage(str_replace("%s", $this->skor_kapasitas->caption(), $this->skor_kapasitas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_kapasitas->FormValue)) {
            $this->skor_kapasitas->addErrorMessage($this->skor_kapasitas->getErrorMessage(false));
        }
        if ($this->max_kapasitas->Required) {
            if (!$this->max_kapasitas->IsDetailKey && EmptyValue($this->max_kapasitas->FormValue)) {
                $this->max_kapasitas->addErrorMessage(str_replace("%s", $this->max_kapasitas->caption(), $this->max_kapasitas->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_kapasitas->FormValue)) {
            $this->max_kapasitas->addErrorMessage($this->max_kapasitas->getErrorMessage(false));
        }
        if ($this->skor_pangan->Required) {
            if (!$this->skor_pangan->IsDetailKey && EmptyValue($this->skor_pangan->FormValue)) {
                $this->skor_pangan->addErrorMessage(str_replace("%s", $this->skor_pangan->caption(), $this->skor_pangan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pangan->FormValue)) {
            $this->skor_pangan->addErrorMessage($this->skor_pangan->getErrorMessage(false));
        }
        if ($this->max_pangan->Required) {
            if (!$this->max_pangan->IsDetailKey && EmptyValue($this->max_pangan->FormValue)) {
                $this->max_pangan->addErrorMessage(str_replace("%s", $this->max_pangan->caption(), $this->max_pangan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_pangan->FormValue)) {
            $this->max_pangan->addErrorMessage($this->max_pangan->getErrorMessage(false));
        }
        if ($this->skor_sni->Required) {
            if (!$this->skor_sni->IsDetailKey && EmptyValue($this->skor_sni->FormValue)) {
                $this->skor_sni->addErrorMessage(str_replace("%s", $this->skor_sni->caption(), $this->skor_sni->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_sni->FormValue)) {
            $this->skor_sni->addErrorMessage($this->skor_sni->getErrorMessage(false));
        }
        if ($this->max_sni->Required) {
            if (!$this->max_sni->IsDetailKey && EmptyValue($this->max_sni->FormValue)) {
                $this->max_sni->addErrorMessage(str_replace("%s", $this->max_sni->caption(), $this->max_sni->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_sni->FormValue)) {
            $this->max_sni->addErrorMessage($this->max_sni->getErrorMessage(false));
        }
        if ($this->skor_kemasan->Required) {
            if (!$this->skor_kemasan->IsDetailKey && EmptyValue($this->skor_kemasan->FormValue)) {
                $this->skor_kemasan->addErrorMessage(str_replace("%s", $this->skor_kemasan->caption(), $this->skor_kemasan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_kemasan->FormValue)) {
            $this->skor_kemasan->addErrorMessage($this->skor_kemasan->getErrorMessage(false));
        }
        if ($this->max_kemasan->Required) {
            if (!$this->max_kemasan->IsDetailKey && EmptyValue($this->max_kemasan->FormValue)) {
                $this->max_kemasan->addErrorMessage(str_replace("%s", $this->max_kemasan->caption(), $this->max_kemasan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_kemasan->FormValue)) {
            $this->max_kemasan->addErrorMessage($this->max_kemasan->getErrorMessage(false));
        }
        if ($this->skor_bahanbaku->Required) {
            if (!$this->skor_bahanbaku->IsDetailKey && EmptyValue($this->skor_bahanbaku->FormValue)) {
                $this->skor_bahanbaku->addErrorMessage(str_replace("%s", $this->skor_bahanbaku->caption(), $this->skor_bahanbaku->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_bahanbaku->FormValue)) {
            $this->skor_bahanbaku->addErrorMessage($this->skor_bahanbaku->getErrorMessage(false));
        }
        if ($this->max_bahanbaku->Required) {
            if (!$this->max_bahanbaku->IsDetailKey && EmptyValue($this->max_bahanbaku->FormValue)) {
                $this->max_bahanbaku->addErrorMessage(str_replace("%s", $this->max_bahanbaku->caption(), $this->max_bahanbaku->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_bahanbaku->FormValue)) {
            $this->max_bahanbaku->addErrorMessage($this->max_bahanbaku->getErrorMessage(false));
        }
        if ($this->skor_alat->Required) {
            if (!$this->skor_alat->IsDetailKey && EmptyValue($this->skor_alat->FormValue)) {
                $this->skor_alat->addErrorMessage(str_replace("%s", $this->skor_alat->caption(), $this->skor_alat->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_alat->FormValue)) {
            $this->skor_alat->addErrorMessage($this->skor_alat->getErrorMessage(false));
        }
        if ($this->max_alat->Required) {
            if (!$this->max_alat->IsDetailKey && EmptyValue($this->max_alat->FormValue)) {
                $this->max_alat->addErrorMessage(str_replace("%s", $this->max_alat->caption(), $this->max_alat->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_alat->FormValue)) {
            $this->max_alat->addErrorMessage($this->max_alat->getErrorMessage(false));
        }
        if ($this->skor_gudang->Required) {
            if (!$this->skor_gudang->IsDetailKey && EmptyValue($this->skor_gudang->FormValue)) {
                $this->skor_gudang->addErrorMessage(str_replace("%s", $this->skor_gudang->caption(), $this->skor_gudang->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_gudang->FormValue)) {
            $this->skor_gudang->addErrorMessage($this->skor_gudang->getErrorMessage(false));
        }
        if ($this->max_gudang->Required) {
            if (!$this->max_gudang->IsDetailKey && EmptyValue($this->max_gudang->FormValue)) {
                $this->max_gudang->addErrorMessage(str_replace("%s", $this->max_gudang->caption(), $this->max_gudang->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_gudang->FormValue)) {
            $this->max_gudang->addErrorMessage($this->max_gudang->getErrorMessage(false));
        }
        if ($this->skor_layout->Required) {
            if (!$this->skor_layout->IsDetailKey && EmptyValue($this->skor_layout->FormValue)) {
                $this->skor_layout->addErrorMessage(str_replace("%s", $this->skor_layout->caption(), $this->skor_layout->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_layout->FormValue)) {
            $this->skor_layout->addErrorMessage($this->skor_layout->getErrorMessage(false));
        }
        if ($this->max_layout->Required) {
            if (!$this->max_layout->IsDetailKey && EmptyValue($this->max_layout->FormValue)) {
                $this->max_layout->addErrorMessage(str_replace("%s", $this->max_layout->caption(), $this->max_layout->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_layout->FormValue)) {
            $this->max_layout->addErrorMessage($this->max_layout->getErrorMessage(false));
        }
        if ($this->skor_sop->Required) {
            if (!$this->skor_sop->IsDetailKey && EmptyValue($this->skor_sop->FormValue)) {
                $this->skor_sop->addErrorMessage(str_replace("%s", $this->skor_sop->caption(), $this->skor_sop->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_sop->FormValue)) {
            $this->skor_sop->addErrorMessage($this->skor_sop->getErrorMessage(false));
        }
        if ($this->max_sop->Required) {
            if (!$this->max_sop->IsDetailKey && EmptyValue($this->max_sop->FormValue)) {
                $this->max_sop->addErrorMessage(str_replace("%s", $this->max_sop->caption(), $this->max_sop->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_sop->FormValue)) {
            $this->max_sop->addErrorMessage($this->max_sop->getErrorMessage(false));
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

        // nik
        $this->nik->setDbValueDef($rsnew, $this->nik->CurrentValue, "", false);

        // skor_aktifitas
        $this->skor_aktifitas->setDbValueDef($rsnew, $this->skor_aktifitas->CurrentValue, null, false);

        // max_aktifitas
        $this->max_aktifitas->setDbValueDef($rsnew, $this->max_aktifitas->CurrentValue, null, false);

        // skor_kapasitas
        $this->skor_kapasitas->setDbValueDef($rsnew, $this->skor_kapasitas->CurrentValue, null, false);

        // max_kapasitas
        $this->max_kapasitas->setDbValueDef($rsnew, $this->max_kapasitas->CurrentValue, null, false);

        // skor_pangan
        $this->skor_pangan->setDbValueDef($rsnew, $this->skor_pangan->CurrentValue, null, false);

        // max_pangan
        $this->max_pangan->setDbValueDef($rsnew, $this->max_pangan->CurrentValue, null, false);

        // skor_sni
        $this->skor_sni->setDbValueDef($rsnew, $this->skor_sni->CurrentValue, null, false);

        // max_sni
        $this->max_sni->setDbValueDef($rsnew, $this->max_sni->CurrentValue, null, false);

        // skor_kemasan
        $this->skor_kemasan->setDbValueDef($rsnew, $this->skor_kemasan->CurrentValue, null, false);

        // max_kemasan
        $this->max_kemasan->setDbValueDef($rsnew, $this->max_kemasan->CurrentValue, null, false);

        // skor_bahanbaku
        $this->skor_bahanbaku->setDbValueDef($rsnew, $this->skor_bahanbaku->CurrentValue, null, false);

        // max_bahanbaku
        $this->max_bahanbaku->setDbValueDef($rsnew, $this->max_bahanbaku->CurrentValue, null, false);

        // skor_alat
        $this->skor_alat->setDbValueDef($rsnew, $this->skor_alat->CurrentValue, null, false);

        // max_alat
        $this->max_alat->setDbValueDef($rsnew, $this->max_alat->CurrentValue, null, false);

        // skor_gudang
        $this->skor_gudang->setDbValueDef($rsnew, $this->skor_gudang->CurrentValue, null, false);

        // max_gudang
        $this->max_gudang->setDbValueDef($rsnew, $this->max_gudang->CurrentValue, null, false);

        // skor_layout
        $this->skor_layout->setDbValueDef($rsnew, $this->skor_layout->CurrentValue, null, false);

        // max_layout
        $this->max_layout->setDbValueDef($rsnew, $this->max_layout->CurrentValue, null, false);

        // skor_sop
        $this->skor_sop->setDbValueDef($rsnew, $this->skor_sop->CurrentValue, null, false);

        // max_sop
        $this->max_sop->setDbValueDef($rsnew, $this->max_sop->CurrentValue, null, false);

        // skor_produksi
        $this->skor_produksi->setDbValueDef($rsnew, $this->skor_produksi->CurrentValue, null, false);

        // maxskor_produksi
        $this->maxskor_produksi->setDbValueDef($rsnew, $this->maxskor_produksi->CurrentValue, null, false);

        // bobot_produksi
        $this->bobot_produksi->setDbValueDef($rsnew, $this->bobot_produksi->CurrentValue, 0, false);

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);

        // Check if key value entered
        if ($insertRow && $this->ValidateKey && strval($rsnew['nik']) == "") {
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorproduksilist"), "", $this->TableVar, true);
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
