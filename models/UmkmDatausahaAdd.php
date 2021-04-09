<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmDatausahaAdd extends UmkmDatausaha
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_datausaha';

    // Page object name
    public $PageObjName = "UmkmDatausahaAdd";

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

        // Table object (umkm_datausaha)
        if (!isset($GLOBALS["umkm_datausaha"]) || get_class($GLOBALS["umkm_datausaha"]) == PROJECT_NAMESPACE . "umkm_datausaha") {
            $GLOBALS["umkm_datausaha"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_datausaha');
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
                $doc = new $class(Container("umkm_datausaha"));
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
                    if ($pageName == "umkmdatausahaview") {
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
        $this->NAMA_USAHA->setVisibility();
        $this->TAHUN_MULAI_USAHA->setVisibility();
        $this->NO_IZIN_USAHA->setVisibility();
        $this->SEKTOR->setVisibility();
        $this->SEKTOR_PERGUB->setVisibility();
        $this->SEKTOR_KBLI->setVisibility();
        $this->SEKTOR_EKRAF->setVisibility();
        $this->KAPANEWON->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->DUSUN->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->TENAGA_KERJA_LAKILAKI->setVisibility();
        $this->TENAGA_KERJA_PEREMPUAN->setVisibility();
        $this->MODAL_KERJA->setVisibility();
        $this->OMZET_RATARATA_PERTAHUN->setVisibility();
        $this->STATUS_USAHA->setVisibility();
        $this->ASET->setVisibility();
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
        $this->setupLookupOptions($this->SEKTOR_PERGUB);
        $this->setupLookupOptions($this->SEKTOR_KBLI);
        $this->setupLookupOptions($this->SEKTOR_EKRAF);
        $this->setupLookupOptions($this->KAPANEWON);
        $this->setupLookupOptions($this->KALURAHAN);

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

        // Set up master/detail parameters
        // NOTE: must be after loadOldRecord to prevent master key values overwritten
        $this->setupMasterParms();

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
                    $this->terminate("umkmdatausahalist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "umkmdatausahalist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "umkmdatausahaview") {
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
        $this->NAMA_USAHA->CurrentValue = null;
        $this->NAMA_USAHA->OldValue = $this->NAMA_USAHA->CurrentValue;
        $this->TAHUN_MULAI_USAHA->CurrentValue = null;
        $this->TAHUN_MULAI_USAHA->OldValue = $this->TAHUN_MULAI_USAHA->CurrentValue;
        $this->NO_IZIN_USAHA->CurrentValue = null;
        $this->NO_IZIN_USAHA->OldValue = $this->NO_IZIN_USAHA->CurrentValue;
        $this->SEKTOR->CurrentValue = null;
        $this->SEKTOR->OldValue = $this->SEKTOR->CurrentValue;
        $this->SEKTOR_PERGUB->CurrentValue = null;
        $this->SEKTOR_PERGUB->OldValue = $this->SEKTOR_PERGUB->CurrentValue;
        $this->SEKTOR_KBLI->CurrentValue = null;
        $this->SEKTOR_KBLI->OldValue = $this->SEKTOR_KBLI->CurrentValue;
        $this->SEKTOR_EKRAF->CurrentValue = null;
        $this->SEKTOR_EKRAF->OldValue = $this->SEKTOR_EKRAF->CurrentValue;
        $this->KAPANEWON->CurrentValue = null;
        $this->KAPANEWON->OldValue = $this->KAPANEWON->CurrentValue;
        $this->KALURAHAN->CurrentValue = null;
        $this->KALURAHAN->OldValue = $this->KALURAHAN->CurrentValue;
        $this->DUSUN->CurrentValue = null;
        $this->DUSUN->OldValue = $this->DUSUN->CurrentValue;
        $this->ALAMAT->CurrentValue = null;
        $this->ALAMAT->OldValue = $this->ALAMAT->CurrentValue;
        $this->TENAGA_KERJA_LAKILAKI->CurrentValue = null;
        $this->TENAGA_KERJA_LAKILAKI->OldValue = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
        $this->TENAGA_KERJA_PEREMPUAN->CurrentValue = null;
        $this->TENAGA_KERJA_PEREMPUAN->OldValue = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
        $this->MODAL_KERJA->CurrentValue = null;
        $this->MODAL_KERJA->OldValue = $this->MODAL_KERJA->CurrentValue;
        $this->OMZET_RATARATA_PERTAHUN->CurrentValue = null;
        $this->OMZET_RATARATA_PERTAHUN->OldValue = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
        $this->STATUS_USAHA->CurrentValue = null;
        $this->STATUS_USAHA->OldValue = $this->STATUS_USAHA->CurrentValue;
        $this->ASET->CurrentValue = null;
        $this->ASET->OldValue = $this->ASET->CurrentValue;
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

        // Check field name 'NAMA_USAHA' first before field var 'x_NAMA_USAHA'
        $val = $CurrentForm->hasValue("NAMA_USAHA") ? $CurrentForm->getValue("NAMA_USAHA") : $CurrentForm->getValue("x_NAMA_USAHA");
        if (!$this->NAMA_USAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_USAHA->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_USAHA->setFormValue($val);
            }
        }

        // Check field name 'TAHUN_MULAI_USAHA' first before field var 'x_TAHUN_MULAI_USAHA'
        $val = $CurrentForm->hasValue("TAHUN_MULAI_USAHA") ? $CurrentForm->getValue("TAHUN_MULAI_USAHA") : $CurrentForm->getValue("x_TAHUN_MULAI_USAHA");
        if (!$this->TAHUN_MULAI_USAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TAHUN_MULAI_USAHA->Visible = false; // Disable update for API request
            } else {
                $this->TAHUN_MULAI_USAHA->setFormValue($val);
            }
        }

        // Check field name 'NO_IZIN_USAHA' first before field var 'x_NO_IZIN_USAHA'
        $val = $CurrentForm->hasValue("NO_IZIN_USAHA") ? $CurrentForm->getValue("NO_IZIN_USAHA") : $CurrentForm->getValue("x_NO_IZIN_USAHA");
        if (!$this->NO_IZIN_USAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_IZIN_USAHA->Visible = false; // Disable update for API request
            } else {
                $this->NO_IZIN_USAHA->setFormValue($val);
            }
        }

        // Check field name 'SEKTOR' first before field var 'x_SEKTOR'
        $val = $CurrentForm->hasValue("SEKTOR") ? $CurrentForm->getValue("SEKTOR") : $CurrentForm->getValue("x_SEKTOR");
        if (!$this->SEKTOR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SEKTOR->Visible = false; // Disable update for API request
            } else {
                $this->SEKTOR->setFormValue($val);
            }
        }

        // Check field name 'SEKTOR_PERGUB' first before field var 'x_SEKTOR_PERGUB'
        $val = $CurrentForm->hasValue("SEKTOR_PERGUB") ? $CurrentForm->getValue("SEKTOR_PERGUB") : $CurrentForm->getValue("x_SEKTOR_PERGUB");
        if (!$this->SEKTOR_PERGUB->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SEKTOR_PERGUB->Visible = false; // Disable update for API request
            } else {
                $this->SEKTOR_PERGUB->setFormValue($val);
            }
        }

        // Check field name 'SEKTOR_KBLI' first before field var 'x_SEKTOR_KBLI'
        $val = $CurrentForm->hasValue("SEKTOR_KBLI") ? $CurrentForm->getValue("SEKTOR_KBLI") : $CurrentForm->getValue("x_SEKTOR_KBLI");
        if (!$this->SEKTOR_KBLI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SEKTOR_KBLI->Visible = false; // Disable update for API request
            } else {
                $this->SEKTOR_KBLI->setFormValue($val);
            }
        }

        // Check field name 'SEKTOR_EKRAF' first before field var 'x_SEKTOR_EKRAF'
        $val = $CurrentForm->hasValue("SEKTOR_EKRAF") ? $CurrentForm->getValue("SEKTOR_EKRAF") : $CurrentForm->getValue("x_SEKTOR_EKRAF");
        if (!$this->SEKTOR_EKRAF->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SEKTOR_EKRAF->Visible = false; // Disable update for API request
            } else {
                $this->SEKTOR_EKRAF->setFormValue($val);
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

        // Check field name 'ALAMAT' first before field var 'x_ALAMAT'
        $val = $CurrentForm->hasValue("ALAMAT") ? $CurrentForm->getValue("ALAMAT") : $CurrentForm->getValue("x_ALAMAT");
        if (!$this->ALAMAT->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ALAMAT->Visible = false; // Disable update for API request
            } else {
                $this->ALAMAT->setFormValue($val);
            }
        }

        // Check field name 'TENAGA_KERJA_LAKI-LAKI' first before field var 'x_TENAGA_KERJA_LAKILAKI'
        $val = $CurrentForm->hasValue("TENAGA_KERJA_LAKI-LAKI") ? $CurrentForm->getValue("TENAGA_KERJA_LAKI-LAKI") : $CurrentForm->getValue("x_TENAGA_KERJA_LAKILAKI");
        if (!$this->TENAGA_KERJA_LAKILAKI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TENAGA_KERJA_LAKILAKI->Visible = false; // Disable update for API request
            } else {
                $this->TENAGA_KERJA_LAKILAKI->setFormValue($val);
            }
        }

        // Check field name 'TENAGA_KERJA_PEREMPUAN' first before field var 'x_TENAGA_KERJA_PEREMPUAN'
        $val = $CurrentForm->hasValue("TENAGA_KERJA_PEREMPUAN") ? $CurrentForm->getValue("TENAGA_KERJA_PEREMPUAN") : $CurrentForm->getValue("x_TENAGA_KERJA_PEREMPUAN");
        if (!$this->TENAGA_KERJA_PEREMPUAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->TENAGA_KERJA_PEREMPUAN->Visible = false; // Disable update for API request
            } else {
                $this->TENAGA_KERJA_PEREMPUAN->setFormValue($val);
            }
        }

        // Check field name 'MODAL_KERJA' first before field var 'x_MODAL_KERJA'
        $val = $CurrentForm->hasValue("MODAL_KERJA") ? $CurrentForm->getValue("MODAL_KERJA") : $CurrentForm->getValue("x_MODAL_KERJA");
        if (!$this->MODAL_KERJA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MODAL_KERJA->Visible = false; // Disable update for API request
            } else {
                $this->MODAL_KERJA->setFormValue($val);
            }
        }

        // Check field name 'OMZET_RATA-RATA_PERTAHUN' first before field var 'x_OMZET_RATARATA_PERTAHUN'
        $val = $CurrentForm->hasValue("OMZET_RATA-RATA_PERTAHUN") ? $CurrentForm->getValue("OMZET_RATA-RATA_PERTAHUN") : $CurrentForm->getValue("x_OMZET_RATARATA_PERTAHUN");
        if (!$this->OMZET_RATARATA_PERTAHUN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->OMZET_RATARATA_PERTAHUN->Visible = false; // Disable update for API request
            } else {
                $this->OMZET_RATARATA_PERTAHUN->setFormValue($val);
            }
        }

        // Check field name 'STATUS_USAHA' first before field var 'x_STATUS_USAHA'
        $val = $CurrentForm->hasValue("STATUS_USAHA") ? $CurrentForm->getValue("STATUS_USAHA") : $CurrentForm->getValue("x_STATUS_USAHA");
        if (!$this->STATUS_USAHA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->STATUS_USAHA->Visible = false; // Disable update for API request
            } else {
                $this->STATUS_USAHA->setFormValue($val);
            }
        }

        // Check field name 'ASET' first before field var 'x_ASET'
        $val = $CurrentForm->hasValue("ASET") ? $CurrentForm->getValue("ASET") : $CurrentForm->getValue("x_ASET");
        if (!$this->ASET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->ASET->Visible = false; // Disable update for API request
            } else {
                $this->ASET->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->NAMA_USAHA->CurrentValue = $this->NAMA_USAHA->FormValue;
        $this->TAHUN_MULAI_USAHA->CurrentValue = $this->TAHUN_MULAI_USAHA->FormValue;
        $this->NO_IZIN_USAHA->CurrentValue = $this->NO_IZIN_USAHA->FormValue;
        $this->SEKTOR->CurrentValue = $this->SEKTOR->FormValue;
        $this->SEKTOR_PERGUB->CurrentValue = $this->SEKTOR_PERGUB->FormValue;
        $this->SEKTOR_KBLI->CurrentValue = $this->SEKTOR_KBLI->FormValue;
        $this->SEKTOR_EKRAF->CurrentValue = $this->SEKTOR_EKRAF->FormValue;
        $this->KAPANEWON->CurrentValue = $this->KAPANEWON->FormValue;
        $this->KALURAHAN->CurrentValue = $this->KALURAHAN->FormValue;
        $this->DUSUN->CurrentValue = $this->DUSUN->FormValue;
        $this->ALAMAT->CurrentValue = $this->ALAMAT->FormValue;
        $this->TENAGA_KERJA_LAKILAKI->CurrentValue = $this->TENAGA_KERJA_LAKILAKI->FormValue;
        $this->TENAGA_KERJA_PEREMPUAN->CurrentValue = $this->TENAGA_KERJA_PEREMPUAN->FormValue;
        $this->MODAL_KERJA->CurrentValue = $this->MODAL_KERJA->FormValue;
        $this->OMZET_RATARATA_PERTAHUN->CurrentValue = $this->OMZET_RATARATA_PERTAHUN->FormValue;
        $this->STATUS_USAHA->CurrentValue = $this->STATUS_USAHA->FormValue;
        $this->ASET->CurrentValue = $this->ASET->FormValue;
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
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->TAHUN_MULAI_USAHA->setDbValue($row['TAHUN_MULAI_USAHA']);
        $this->NO_IZIN_USAHA->setDbValue($row['NO_IZIN_USAHA']);
        $this->SEKTOR->setDbValue($row['SEKTOR']);
        $this->SEKTOR_PERGUB->setDbValue($row['SEKTOR_PERGUB']);
        $this->SEKTOR_KBLI->setDbValue($row['SEKTOR_KBLI']);
        $this->SEKTOR_EKRAF->setDbValue($row['SEKTOR_EKRAF']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->TENAGA_KERJA_LAKILAKI->setDbValue($row['TENAGA_KERJA_LAKI-LAKI']);
        $this->TENAGA_KERJA_PEREMPUAN->setDbValue($row['TENAGA_KERJA_PEREMPUAN']);
        $this->MODAL_KERJA->setDbValue($row['MODAL_KERJA']);
        $this->OMZET_RATARATA_PERTAHUN->setDbValue($row['OMZET_RATA-RATA_PERTAHUN']);
        $this->STATUS_USAHA->setDbValue($row['STATUS_USAHA']);
        $this->ASET->setDbValue($row['ASET']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['NAMA_USAHA'] = $this->NAMA_USAHA->CurrentValue;
        $row['TAHUN_MULAI_USAHA'] = $this->TAHUN_MULAI_USAHA->CurrentValue;
        $row['NO_IZIN_USAHA'] = $this->NO_IZIN_USAHA->CurrentValue;
        $row['SEKTOR'] = $this->SEKTOR->CurrentValue;
        $row['SEKTOR_PERGUB'] = $this->SEKTOR_PERGUB->CurrentValue;
        $row['SEKTOR_KBLI'] = $this->SEKTOR_KBLI->CurrentValue;
        $row['SEKTOR_EKRAF'] = $this->SEKTOR_EKRAF->CurrentValue;
        $row['KAPANEWON'] = $this->KAPANEWON->CurrentValue;
        $row['KALURAHAN'] = $this->KALURAHAN->CurrentValue;
        $row['DUSUN'] = $this->DUSUN->CurrentValue;
        $row['ALAMAT'] = $this->ALAMAT->CurrentValue;
        $row['TENAGA_KERJA_LAKI-LAKI'] = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
        $row['TENAGA_KERJA_PEREMPUAN'] = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
        $row['MODAL_KERJA'] = $this->MODAL_KERJA->CurrentValue;
        $row['OMZET_RATA-RATA_PERTAHUN'] = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
        $row['STATUS_USAHA'] = $this->STATUS_USAHA->CurrentValue;
        $row['ASET'] = $this->ASET->CurrentValue;
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
        if ($this->MODAL_KERJA->FormValue == $this->MODAL_KERJA->CurrentValue && is_numeric(ConvertToFloatString($this->MODAL_KERJA->CurrentValue))) {
            $this->MODAL_KERJA->CurrentValue = ConvertToFloatString($this->MODAL_KERJA->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->OMZET_RATARATA_PERTAHUN->FormValue == $this->OMZET_RATARATA_PERTAHUN->CurrentValue && is_numeric(ConvertToFloatString($this->OMZET_RATARATA_PERTAHUN->CurrentValue))) {
            $this->OMZET_RATARATA_PERTAHUN->CurrentValue = ConvertToFloatString($this->OMZET_RATARATA_PERTAHUN->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->ASET->FormValue == $this->ASET->CurrentValue && is_numeric(ConvertToFloatString($this->ASET->CurrentValue))) {
            $this->ASET->CurrentValue = ConvertToFloatString($this->ASET->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // NAMA_USAHA

        // TAHUN_MULAI_USAHA

        // NO_IZIN_USAHA

        // SEKTOR

        // SEKTOR_PERGUB

        // SEKTOR_KBLI

        // SEKTOR_EKRAF

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // ALAMAT

        // TENAGA_KERJA_LAKI-LAKI

        // TENAGA_KERJA_PEREMPUAN

        // MODAL_KERJA

        // OMZET_RATA-RATA_PERTAHUN

        // STATUS_USAHA

        // ASET
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
            $this->NAMA_USAHA->ViewCustomAttributes = "";

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->ViewValue = $this->TAHUN_MULAI_USAHA->CurrentValue;
            $this->TAHUN_MULAI_USAHA->ViewCustomAttributes = "";

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->ViewValue = $this->NO_IZIN_USAHA->CurrentValue;
            $this->NO_IZIN_USAHA->ViewCustomAttributes = "";

            // SEKTOR
            $this->SEKTOR->ViewValue = $this->SEKTOR->CurrentValue;
            $this->SEKTOR->ViewCustomAttributes = "";

            // SEKTOR_PERGUB
            $curVal = strval($this->SEKTOR_PERGUB->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->lookupCacheOption($curVal);
                if ($this->SEKTOR_PERGUB->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='PERGUB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_PERGUB->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_PERGUB->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_PERGUB->ViewValue = null;
            }
            $this->SEKTOR_PERGUB->ViewCustomAttributes = "";

            // SEKTOR_KBLI
            $curVal = strval($this->SEKTOR_KBLI->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->lookupCacheOption($curVal);
                if ($this->SEKTOR_KBLI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='KBLI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_KBLI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_KBLI->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_KBLI->ViewValue = null;
            }
            $this->SEKTOR_KBLI->ViewCustomAttributes = "";

            // SEKTOR_EKRAF
            $curVal = strval($this->SEKTOR_EKRAF->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->lookupCacheOption($curVal);
                if ($this->SEKTOR_EKRAF->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='EKRAFT'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_EKRAF->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_EKRAF->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_EKRAF->ViewValue = null;
            }
            $this->SEKTOR_EKRAF->ViewCustomAttributes = "";

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

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->ViewValue = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
            $this->TENAGA_KERJA_LAKILAKI->ViewValue = FormatNumber($this->TENAGA_KERJA_LAKILAKI->ViewValue, 0, -2, -2, -2);
            $this->TENAGA_KERJA_LAKILAKI->ViewCustomAttributes = "";

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->ViewValue = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
            $this->TENAGA_KERJA_PEREMPUAN->ViewValue = FormatNumber($this->TENAGA_KERJA_PEREMPUAN->ViewValue, 0, -2, -2, -2);
            $this->TENAGA_KERJA_PEREMPUAN->ViewCustomAttributes = "";

            // MODAL_KERJA
            $this->MODAL_KERJA->ViewValue = $this->MODAL_KERJA->CurrentValue;
            $this->MODAL_KERJA->ViewValue = FormatNumber($this->MODAL_KERJA->ViewValue, 2, -2, -2, -2);
            $this->MODAL_KERJA->ViewCustomAttributes = "";

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->ViewValue = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
            $this->OMZET_RATARATA_PERTAHUN->ViewValue = FormatNumber($this->OMZET_RATARATA_PERTAHUN->ViewValue, 2, -2, -2, -2);
            $this->OMZET_RATARATA_PERTAHUN->ViewCustomAttributes = "";

            // STATUS_USAHA
            $this->STATUS_USAHA->ViewValue = $this->STATUS_USAHA->CurrentValue;
            $this->STATUS_USAHA->ViewCustomAttributes = "";

            // ASET
            $this->ASET->ViewValue = $this->ASET->CurrentValue;
            $this->ASET->ViewValue = FormatNumber($this->ASET->ViewValue, 2, -2, -2, -2);
            $this->ASET->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";
            $this->NAMA_USAHA->TooltipValue = "";

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->LinkCustomAttributes = "";
            $this->TAHUN_MULAI_USAHA->HrefValue = "";
            $this->TAHUN_MULAI_USAHA->TooltipValue = "";

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->LinkCustomAttributes = "";
            $this->NO_IZIN_USAHA->HrefValue = "";
            $this->NO_IZIN_USAHA->TooltipValue = "";

            // SEKTOR
            $this->SEKTOR->LinkCustomAttributes = "";
            $this->SEKTOR->HrefValue = "";
            $this->SEKTOR->TooltipValue = "";

            // SEKTOR_PERGUB
            $this->SEKTOR_PERGUB->LinkCustomAttributes = "";
            $this->SEKTOR_PERGUB->HrefValue = "";
            $this->SEKTOR_PERGUB->TooltipValue = "";

            // SEKTOR_KBLI
            $this->SEKTOR_KBLI->LinkCustomAttributes = "";
            $this->SEKTOR_KBLI->HrefValue = "";
            $this->SEKTOR_KBLI->TooltipValue = "";

            // SEKTOR_EKRAF
            $this->SEKTOR_EKRAF->LinkCustomAttributes = "";
            $this->SEKTOR_EKRAF->HrefValue = "";
            $this->SEKTOR_EKRAF->TooltipValue = "";

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

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_LAKILAKI->HrefValue = "";
            $this->TENAGA_KERJA_LAKILAKI->TooltipValue = "";

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_PEREMPUAN->HrefValue = "";
            $this->TENAGA_KERJA_PEREMPUAN->TooltipValue = "";

            // MODAL_KERJA
            $this->MODAL_KERJA->LinkCustomAttributes = "";
            $this->MODAL_KERJA->HrefValue = "";
            $this->MODAL_KERJA->TooltipValue = "";

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->LinkCustomAttributes = "";
            $this->OMZET_RATARATA_PERTAHUN->HrefValue = "";
            $this->OMZET_RATARATA_PERTAHUN->TooltipValue = "";

            // STATUS_USAHA
            $this->STATUS_USAHA->LinkCustomAttributes = "";
            $this->STATUS_USAHA->HrefValue = "";
            $this->STATUS_USAHA->TooltipValue = "";

            // ASET
            $this->ASET->LinkCustomAttributes = "";
            $this->ASET->HrefValue = "";
            $this->ASET->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // NAMA_USAHA
            $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
            $this->NAMA_USAHA->EditCustomAttributes = "";
            if (!$this->NAMA_USAHA->Raw) {
                $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
            }
            $this->NAMA_USAHA->EditValue = HtmlEncode($this->NAMA_USAHA->CurrentValue);
            $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->EditAttrs["class"] = "form-control";
            $this->TAHUN_MULAI_USAHA->EditCustomAttributes = "";
            if (!$this->TAHUN_MULAI_USAHA->Raw) {
                $this->TAHUN_MULAI_USAHA->CurrentValue = HtmlDecode($this->TAHUN_MULAI_USAHA->CurrentValue);
            }
            $this->TAHUN_MULAI_USAHA->EditValue = HtmlEncode($this->TAHUN_MULAI_USAHA->CurrentValue);
            $this->TAHUN_MULAI_USAHA->PlaceHolder = RemoveHtml($this->TAHUN_MULAI_USAHA->caption());

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->EditAttrs["class"] = "form-control";
            $this->NO_IZIN_USAHA->EditCustomAttributes = "";
            if (!$this->NO_IZIN_USAHA->Raw) {
                $this->NO_IZIN_USAHA->CurrentValue = HtmlDecode($this->NO_IZIN_USAHA->CurrentValue);
            }
            $this->NO_IZIN_USAHA->EditValue = HtmlEncode($this->NO_IZIN_USAHA->CurrentValue);
            $this->NO_IZIN_USAHA->PlaceHolder = RemoveHtml($this->NO_IZIN_USAHA->caption());

            // SEKTOR
            $this->SEKTOR->EditAttrs["class"] = "form-control";
            $this->SEKTOR->EditCustomAttributes = "";
            if (!$this->SEKTOR->Raw) {
                $this->SEKTOR->CurrentValue = HtmlDecode($this->SEKTOR->CurrentValue);
            }
            $this->SEKTOR->EditValue = HtmlEncode($this->SEKTOR->CurrentValue);
            $this->SEKTOR->PlaceHolder = RemoveHtml($this->SEKTOR->caption());

            // SEKTOR_PERGUB
            $this->SEKTOR_PERGUB->EditAttrs["class"] = "form-control";
            $this->SEKTOR_PERGUB->EditCustomAttributes = "";
            $curVal = trim(strval($this->SEKTOR_PERGUB->CurrentValue));
            if ($curVal != "") {
                $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->lookupCacheOption($curVal);
            } else {
                $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->Lookup !== null && is_array($this->SEKTOR_PERGUB->Lookup->Options) ? $curVal : null;
            }
            if ($this->SEKTOR_PERGUB->ViewValue !== null) { // Load from cache
                $this->SEKTOR_PERGUB->EditValue = array_values($this->SEKTOR_PERGUB->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SEKTOR_PERGUB->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='PERGUB'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_PERGUB->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SEKTOR_PERGUB->EditValue = $arwrk;
            }
            $this->SEKTOR_PERGUB->PlaceHolder = RemoveHtml($this->SEKTOR_PERGUB->caption());

            // SEKTOR_KBLI
            $this->SEKTOR_KBLI->EditAttrs["class"] = "form-control";
            $this->SEKTOR_KBLI->EditCustomAttributes = "";
            $curVal = trim(strval($this->SEKTOR_KBLI->CurrentValue));
            if ($curVal != "") {
                $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->lookupCacheOption($curVal);
            } else {
                $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->Lookup !== null && is_array($this->SEKTOR_KBLI->Lookup->Options) ? $curVal : null;
            }
            if ($this->SEKTOR_KBLI->ViewValue !== null) { // Load from cache
                $this->SEKTOR_KBLI->EditValue = array_values($this->SEKTOR_KBLI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SEKTOR_KBLI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='KBLI'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_KBLI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SEKTOR_KBLI->EditValue = $arwrk;
            }
            $this->SEKTOR_KBLI->PlaceHolder = RemoveHtml($this->SEKTOR_KBLI->caption());

            // SEKTOR_EKRAF
            $this->SEKTOR_EKRAF->EditAttrs["class"] = "form-control";
            $this->SEKTOR_EKRAF->EditCustomAttributes = "";
            $curVal = trim(strval($this->SEKTOR_EKRAF->CurrentValue));
            if ($curVal != "") {
                $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->lookupCacheOption($curVal);
            } else {
                $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->Lookup !== null && is_array($this->SEKTOR_EKRAF->Lookup->Options) ? $curVal : null;
            }
            if ($this->SEKTOR_EKRAF->ViewValue !== null) { // Load from cache
                $this->SEKTOR_EKRAF->EditValue = array_values($this->SEKTOR_EKRAF->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SEKTOR_EKRAF->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='EKRAFT'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_EKRAF->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SEKTOR_EKRAF->EditValue = $arwrk;
            }
            $this->SEKTOR_EKRAF->PlaceHolder = RemoveHtml($this->SEKTOR_EKRAF->caption());

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

            // ALAMAT
            $this->ALAMAT->EditAttrs["class"] = "form-control";
            $this->ALAMAT->EditCustomAttributes = "";
            $this->ALAMAT->EditValue = HtmlEncode($this->ALAMAT->CurrentValue);
            $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->EditAttrs["class"] = "form-control";
            $this->TENAGA_KERJA_LAKILAKI->EditCustomAttributes = "";
            $this->TENAGA_KERJA_LAKILAKI->EditValue = HtmlEncode($this->TENAGA_KERJA_LAKILAKI->CurrentValue);
            $this->TENAGA_KERJA_LAKILAKI->PlaceHolder = RemoveHtml($this->TENAGA_KERJA_LAKILAKI->caption());

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->EditAttrs["class"] = "form-control";
            $this->TENAGA_KERJA_PEREMPUAN->EditCustomAttributes = "";
            $this->TENAGA_KERJA_PEREMPUAN->EditValue = HtmlEncode($this->TENAGA_KERJA_PEREMPUAN->CurrentValue);
            $this->TENAGA_KERJA_PEREMPUAN->PlaceHolder = RemoveHtml($this->TENAGA_KERJA_PEREMPUAN->caption());

            // MODAL_KERJA
            $this->MODAL_KERJA->EditAttrs["class"] = "form-control";
            $this->MODAL_KERJA->EditCustomAttributes = "";
            $this->MODAL_KERJA->EditValue = HtmlEncode($this->MODAL_KERJA->CurrentValue);
            $this->MODAL_KERJA->PlaceHolder = RemoveHtml($this->MODAL_KERJA->caption());
            if (strval($this->MODAL_KERJA->EditValue) != "" && is_numeric($this->MODAL_KERJA->EditValue)) {
                $this->MODAL_KERJA->EditValue = FormatNumber($this->MODAL_KERJA->EditValue, -2, -2, -2, -2);
            }

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->EditAttrs["class"] = "form-control";
            $this->OMZET_RATARATA_PERTAHUN->EditCustomAttributes = "";
            $this->OMZET_RATARATA_PERTAHUN->EditValue = HtmlEncode($this->OMZET_RATARATA_PERTAHUN->CurrentValue);
            $this->OMZET_RATARATA_PERTAHUN->PlaceHolder = RemoveHtml($this->OMZET_RATARATA_PERTAHUN->caption());
            if (strval($this->OMZET_RATARATA_PERTAHUN->EditValue) != "" && is_numeric($this->OMZET_RATARATA_PERTAHUN->EditValue)) {
                $this->OMZET_RATARATA_PERTAHUN->EditValue = FormatNumber($this->OMZET_RATARATA_PERTAHUN->EditValue, -2, -2, -2, -2);
            }

            // STATUS_USAHA
            $this->STATUS_USAHA->EditAttrs["class"] = "form-control";
            $this->STATUS_USAHA->EditCustomAttributes = "";
            if (!$this->STATUS_USAHA->Raw) {
                $this->STATUS_USAHA->CurrentValue = HtmlDecode($this->STATUS_USAHA->CurrentValue);
            }
            $this->STATUS_USAHA->EditValue = HtmlEncode($this->STATUS_USAHA->CurrentValue);
            $this->STATUS_USAHA->PlaceHolder = RemoveHtml($this->STATUS_USAHA->caption());

            // ASET
            $this->ASET->EditAttrs["class"] = "form-control";
            $this->ASET->EditCustomAttributes = "";
            $this->ASET->EditValue = HtmlEncode($this->ASET->CurrentValue);
            $this->ASET->PlaceHolder = RemoveHtml($this->ASET->caption());
            if (strval($this->ASET->EditValue) != "" && is_numeric($this->ASET->EditValue)) {
                $this->ASET->EditValue = FormatNumber($this->ASET->EditValue, -2, -2, -2, -2);
            }

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->LinkCustomAttributes = "";
            $this->TAHUN_MULAI_USAHA->HrefValue = "";

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->LinkCustomAttributes = "";
            $this->NO_IZIN_USAHA->HrefValue = "";

            // SEKTOR
            $this->SEKTOR->LinkCustomAttributes = "";
            $this->SEKTOR->HrefValue = "";

            // SEKTOR_PERGUB
            $this->SEKTOR_PERGUB->LinkCustomAttributes = "";
            $this->SEKTOR_PERGUB->HrefValue = "";

            // SEKTOR_KBLI
            $this->SEKTOR_KBLI->LinkCustomAttributes = "";
            $this->SEKTOR_KBLI->HrefValue = "";

            // SEKTOR_EKRAF
            $this->SEKTOR_EKRAF->LinkCustomAttributes = "";
            $this->SEKTOR_EKRAF->HrefValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";

            // DUSUN
            $this->DUSUN->LinkCustomAttributes = "";
            $this->DUSUN->HrefValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_LAKILAKI->HrefValue = "";

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_PEREMPUAN->HrefValue = "";

            // MODAL_KERJA
            $this->MODAL_KERJA->LinkCustomAttributes = "";
            $this->MODAL_KERJA->HrefValue = "";

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->LinkCustomAttributes = "";
            $this->OMZET_RATARATA_PERTAHUN->HrefValue = "";

            // STATUS_USAHA
            $this->STATUS_USAHA->LinkCustomAttributes = "";
            $this->STATUS_USAHA->HrefValue = "";

            // ASET
            $this->ASET->LinkCustomAttributes = "";
            $this->ASET->HrefValue = "";
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
        if ($this->NAMA_USAHA->Required) {
            if (!$this->NAMA_USAHA->IsDetailKey && EmptyValue($this->NAMA_USAHA->FormValue)) {
                $this->NAMA_USAHA->addErrorMessage(str_replace("%s", $this->NAMA_USAHA->caption(), $this->NAMA_USAHA->RequiredErrorMessage));
            }
        }
        if ($this->TAHUN_MULAI_USAHA->Required) {
            if (!$this->TAHUN_MULAI_USAHA->IsDetailKey && EmptyValue($this->TAHUN_MULAI_USAHA->FormValue)) {
                $this->TAHUN_MULAI_USAHA->addErrorMessage(str_replace("%s", $this->TAHUN_MULAI_USAHA->caption(), $this->TAHUN_MULAI_USAHA->RequiredErrorMessage));
            }
        }
        if ($this->NO_IZIN_USAHA->Required) {
            if (!$this->NO_IZIN_USAHA->IsDetailKey && EmptyValue($this->NO_IZIN_USAHA->FormValue)) {
                $this->NO_IZIN_USAHA->addErrorMessage(str_replace("%s", $this->NO_IZIN_USAHA->caption(), $this->NO_IZIN_USAHA->RequiredErrorMessage));
            }
        }
        if ($this->SEKTOR->Required) {
            if (!$this->SEKTOR->IsDetailKey && EmptyValue($this->SEKTOR->FormValue)) {
                $this->SEKTOR->addErrorMessage(str_replace("%s", $this->SEKTOR->caption(), $this->SEKTOR->RequiredErrorMessage));
            }
        }
        if ($this->SEKTOR_PERGUB->Required) {
            if (!$this->SEKTOR_PERGUB->IsDetailKey && EmptyValue($this->SEKTOR_PERGUB->FormValue)) {
                $this->SEKTOR_PERGUB->addErrorMessage(str_replace("%s", $this->SEKTOR_PERGUB->caption(), $this->SEKTOR_PERGUB->RequiredErrorMessage));
            }
        }
        if ($this->SEKTOR_KBLI->Required) {
            if (!$this->SEKTOR_KBLI->IsDetailKey && EmptyValue($this->SEKTOR_KBLI->FormValue)) {
                $this->SEKTOR_KBLI->addErrorMessage(str_replace("%s", $this->SEKTOR_KBLI->caption(), $this->SEKTOR_KBLI->RequiredErrorMessage));
            }
        }
        if ($this->SEKTOR_EKRAF->Required) {
            if (!$this->SEKTOR_EKRAF->IsDetailKey && EmptyValue($this->SEKTOR_EKRAF->FormValue)) {
                $this->SEKTOR_EKRAF->addErrorMessage(str_replace("%s", $this->SEKTOR_EKRAF->caption(), $this->SEKTOR_EKRAF->RequiredErrorMessage));
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
        if ($this->ALAMAT->Required) {
            if (!$this->ALAMAT->IsDetailKey && EmptyValue($this->ALAMAT->FormValue)) {
                $this->ALAMAT->addErrorMessage(str_replace("%s", $this->ALAMAT->caption(), $this->ALAMAT->RequiredErrorMessage));
            }
        }
        if ($this->TENAGA_KERJA_LAKILAKI->Required) {
            if (!$this->TENAGA_KERJA_LAKILAKI->IsDetailKey && EmptyValue($this->TENAGA_KERJA_LAKILAKI->FormValue)) {
                $this->TENAGA_KERJA_LAKILAKI->addErrorMessage(str_replace("%s", $this->TENAGA_KERJA_LAKILAKI->caption(), $this->TENAGA_KERJA_LAKILAKI->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->TENAGA_KERJA_LAKILAKI->FormValue)) {
            $this->TENAGA_KERJA_LAKILAKI->addErrorMessage($this->TENAGA_KERJA_LAKILAKI->getErrorMessage(false));
        }
        if ($this->TENAGA_KERJA_PEREMPUAN->Required) {
            if (!$this->TENAGA_KERJA_PEREMPUAN->IsDetailKey && EmptyValue($this->TENAGA_KERJA_PEREMPUAN->FormValue)) {
                $this->TENAGA_KERJA_PEREMPUAN->addErrorMessage(str_replace("%s", $this->TENAGA_KERJA_PEREMPUAN->caption(), $this->TENAGA_KERJA_PEREMPUAN->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->TENAGA_KERJA_PEREMPUAN->FormValue)) {
            $this->TENAGA_KERJA_PEREMPUAN->addErrorMessage($this->TENAGA_KERJA_PEREMPUAN->getErrorMessage(false));
        }
        if ($this->MODAL_KERJA->Required) {
            if (!$this->MODAL_KERJA->IsDetailKey && EmptyValue($this->MODAL_KERJA->FormValue)) {
                $this->MODAL_KERJA->addErrorMessage(str_replace("%s", $this->MODAL_KERJA->caption(), $this->MODAL_KERJA->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->MODAL_KERJA->FormValue)) {
            $this->MODAL_KERJA->addErrorMessage($this->MODAL_KERJA->getErrorMessage(false));
        }
        if ($this->OMZET_RATARATA_PERTAHUN->Required) {
            if (!$this->OMZET_RATARATA_PERTAHUN->IsDetailKey && EmptyValue($this->OMZET_RATARATA_PERTAHUN->FormValue)) {
                $this->OMZET_RATARATA_PERTAHUN->addErrorMessage(str_replace("%s", $this->OMZET_RATARATA_PERTAHUN->caption(), $this->OMZET_RATARATA_PERTAHUN->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->OMZET_RATARATA_PERTAHUN->FormValue)) {
            $this->OMZET_RATARATA_PERTAHUN->addErrorMessage($this->OMZET_RATARATA_PERTAHUN->getErrorMessage(false));
        }
        if ($this->STATUS_USAHA->Required) {
            if (!$this->STATUS_USAHA->IsDetailKey && EmptyValue($this->STATUS_USAHA->FormValue)) {
                $this->STATUS_USAHA->addErrorMessage(str_replace("%s", $this->STATUS_USAHA->caption(), $this->STATUS_USAHA->RequiredErrorMessage));
            }
        }
        if ($this->ASET->Required) {
            if (!$this->ASET->IsDetailKey && EmptyValue($this->ASET->FormValue)) {
                $this->ASET->addErrorMessage(str_replace("%s", $this->ASET->caption(), $this->ASET->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->ASET->FormValue)) {
            $this->ASET->addErrorMessage($this->ASET->getErrorMessage(false));
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

        // NAMA_USAHA
        $this->NAMA_USAHA->setDbValueDef($rsnew, $this->NAMA_USAHA->CurrentValue, null, false);

        // TAHUN_MULAI_USAHA
        $this->TAHUN_MULAI_USAHA->setDbValueDef($rsnew, $this->TAHUN_MULAI_USAHA->CurrentValue, null, false);

        // NO_IZIN_USAHA
        $this->NO_IZIN_USAHA->setDbValueDef($rsnew, $this->NO_IZIN_USAHA->CurrentValue, null, false);

        // SEKTOR
        $this->SEKTOR->setDbValueDef($rsnew, $this->SEKTOR->CurrentValue, null, false);

        // SEKTOR_PERGUB
        $this->SEKTOR_PERGUB->setDbValueDef($rsnew, $this->SEKTOR_PERGUB->CurrentValue, null, false);

        // SEKTOR_KBLI
        $this->SEKTOR_KBLI->setDbValueDef($rsnew, $this->SEKTOR_KBLI->CurrentValue, null, false);

        // SEKTOR_EKRAF
        $this->SEKTOR_EKRAF->setDbValueDef($rsnew, $this->SEKTOR_EKRAF->CurrentValue, null, false);

        // KAPANEWON
        $this->KAPANEWON->setDbValueDef($rsnew, $this->KAPANEWON->CurrentValue, null, false);

        // KALURAHAN
        $this->KALURAHAN->setDbValueDef($rsnew, $this->KALURAHAN->CurrentValue, null, false);

        // DUSUN
        $this->DUSUN->setDbValueDef($rsnew, $this->DUSUN->CurrentValue, null, false);

        // ALAMAT
        $this->ALAMAT->setDbValueDef($rsnew, $this->ALAMAT->CurrentValue, null, false);

        // TENAGA_KERJA_LAKI-LAKI
        $this->TENAGA_KERJA_LAKILAKI->setDbValueDef($rsnew, $this->TENAGA_KERJA_LAKILAKI->CurrentValue, null, false);

        // TENAGA_KERJA_PEREMPUAN
        $this->TENAGA_KERJA_PEREMPUAN->setDbValueDef($rsnew, $this->TENAGA_KERJA_PEREMPUAN->CurrentValue, null, false);

        // MODAL_KERJA
        $this->MODAL_KERJA->setDbValueDef($rsnew, $this->MODAL_KERJA->CurrentValue, null, false);

        // OMZET_RATA-RATA_PERTAHUN
        $this->OMZET_RATARATA_PERTAHUN->setDbValueDef($rsnew, $this->OMZET_RATARATA_PERTAHUN->CurrentValue, null, false);

        // STATUS_USAHA
        $this->STATUS_USAHA->setDbValueDef($rsnew, $this->STATUS_USAHA->CurrentValue, null, false);

        // ASET
        $this->ASET->setDbValueDef($rsnew, $this->ASET->CurrentValue, null, false);

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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "umkm_datadiri") {
                $validMaster = true;
                $masterTbl = Container("umkm_datadiri");
                if (($parm = Get("fk_NIK", Get("NIK"))) !== null) {
                    $masterTbl->NIK->setQueryStringValue($parm);
                    $this->NIK->setQueryStringValue($masterTbl->NIK->QueryStringValue);
                    $this->NIK->setSessionValue($this->NIK->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "umkm_datadiri") {
                $validMaster = true;
                $masterTbl = Container("umkm_datadiri");
                if (($parm = Post("fk_NIK", Post("NIK"))) !== null) {
                    $masterTbl->NIK->setFormValue($parm);
                    $this->NIK->setFormValue($masterTbl->NIK->FormValue);
                    $this->NIK->setSessionValue($this->NIK->FormValue);
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "umkm_datadiri") {
                if ($this->NIK->CurrentValue == "") {
                    $this->NIK->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmdatausahalist"), "", $this->TableVar, true);
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
                case "x_SEKTOR_PERGUB":
                    $lookupFilter = function () {
                        return "`subkat`='PERGUB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SEKTOR_KBLI":
                    $lookupFilter = function () {
                        return "`subkat`='KBLI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SEKTOR_EKRAF":
                    $lookupFilter = function () {
                        return "`subkat`='EKRAFT'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
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
