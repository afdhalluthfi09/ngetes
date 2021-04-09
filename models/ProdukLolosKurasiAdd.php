<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ProdukLolosKurasiAdd extends ProdukLolosKurasi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'Produk Lolos Kurasi';

    // Page object name
    public $PageObjName = "ProdukLolosKurasiAdd";

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

        // Table object (Produk_Lolos_Kurasi)
        if (!isset($GLOBALS["Produk_Lolos_Kurasi"]) || get_class($GLOBALS["Produk_Lolos_Kurasi"]) == PROJECT_NAMESPACE . "Produk_Lolos_Kurasi") {
            $GLOBALS["Produk_Lolos_Kurasi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'Produk Lolos Kurasi');
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
                $doc = new $class(Container("Produk_Lolos_Kurasi"));
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
                    if ($pageName == "produkloloskurasiview") {
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
        if ($this->isAddOrEdit()) {
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
        $this->id->Visible = false;
        $this->produk_foto->setVisibility();
        $this->nik_ukm->Visible = false;
        $this->produk_nama->setVisibility();
        $this->produk_jenis->setVisibility();
        $this->produk_desc->setVisibility();
        $this->produk_harga->setVisibility();
        $this->produk_berat->setVisibility();
        $this->kurator->setVisibility();
        $this->produk_legal->Visible = false;
        $this->judul_sesuai->setVisibility();
        $this->foto_bagus->setVisibility();
        $this->deskripsi_jelas->setVisibility();
        $this->harga_tidak_kosong->setVisibility();
        $this->berat_tidak_kosong->setVisibility();
        $this->produk_foto_1->setVisibility();
        $this->produk_foto_2->setVisibility();
        $this->produk_foto_3->setVisibility();
        $this->produk_panjang->setVisibility();
        $this->produk_lebar->setVisibility();
        $this->produk_tinggi->setVisibility();
        $this->waktu_kurasi->Visible = false;
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
        } else { // Not post back
            $this->CopyRecord = false;
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
                    $this->terminate("produkloloskurasilist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "produkloloskurasilist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "produkloloskurasiview") {
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
        $this->produk_foto_1->Upload->Index = $CurrentForm->Index;
        $this->produk_foto_1->Upload->uploadFile();
        $this->produk_foto_1->CurrentValue = $this->produk_foto_1->Upload->FileName;
        $this->produk_foto_2->Upload->Index = $CurrentForm->Index;
        $this->produk_foto_2->Upload->uploadFile();
        $this->produk_foto_2->CurrentValue = $this->produk_foto_2->Upload->FileName;
        $this->produk_foto_3->Upload->Index = $CurrentForm->Index;
        $this->produk_foto_3->Upload->uploadFile();
        $this->produk_foto_3->CurrentValue = $this->produk_foto_3->Upload->FileName;
    }

    // Load default values
    protected function loadDefaultValues()
    {
        $this->id->CurrentValue = null;
        $this->id->OldValue = $this->id->CurrentValue;
        $this->produk_foto->CurrentValue = null;
        $this->produk_foto->OldValue = $this->produk_foto->CurrentValue;
        $this->nik_ukm->CurrentValue = null;
        $this->nik_ukm->OldValue = $this->nik_ukm->CurrentValue;
        $this->produk_nama->CurrentValue = null;
        $this->produk_nama->OldValue = $this->produk_nama->CurrentValue;
        $this->produk_jenis->CurrentValue = null;
        $this->produk_jenis->OldValue = $this->produk_jenis->CurrentValue;
        $this->produk_desc->CurrentValue = null;
        $this->produk_desc->OldValue = $this->produk_desc->CurrentValue;
        $this->produk_harga->CurrentValue = 0;
        $this->produk_berat->CurrentValue = null;
        $this->produk_berat->OldValue = $this->produk_berat->CurrentValue;
        $this->kurator->CurrentValue = null;
        $this->kurator->OldValue = $this->kurator->CurrentValue;
        $this->produk_legal->CurrentValue = 0;
        $this->judul_sesuai->CurrentValue = 0;
        $this->foto_bagus->CurrentValue = 0;
        $this->deskripsi_jelas->CurrentValue = 0;
        $this->harga_tidak_kosong->CurrentValue = 0;
        $this->berat_tidak_kosong->CurrentValue = 0;
        $this->produk_foto_1->Upload->DbValue = null;
        $this->produk_foto_1->OldValue = $this->produk_foto_1->Upload->DbValue;
        $this->produk_foto_1->CurrentValue = null; // Clear file related field
        $this->produk_foto_2->Upload->DbValue = null;
        $this->produk_foto_2->OldValue = $this->produk_foto_2->Upload->DbValue;
        $this->produk_foto_2->CurrentValue = null; // Clear file related field
        $this->produk_foto_3->Upload->DbValue = null;
        $this->produk_foto_3->OldValue = $this->produk_foto_3->Upload->DbValue;
        $this->produk_foto_3->CurrentValue = null; // Clear file related field
        $this->produk_panjang->CurrentValue = null;
        $this->produk_panjang->OldValue = $this->produk_panjang->CurrentValue;
        $this->produk_lebar->CurrentValue = null;
        $this->produk_lebar->OldValue = $this->produk_lebar->CurrentValue;
        $this->produk_tinggi->CurrentValue = null;
        $this->produk_tinggi->OldValue = $this->produk_tinggi->CurrentValue;
        $this->waktu_kurasi->CurrentValue = null;
        $this->waktu_kurasi->OldValue = $this->waktu_kurasi->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;

        // Check field name 'produk_foto' first before field var 'x_produk_foto'
        $val = $CurrentForm->hasValue("produk_foto") ? $CurrentForm->getValue("produk_foto") : $CurrentForm->getValue("x_produk_foto");
        if (!$this->produk_foto->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_foto->Visible = false; // Disable update for API request
            } else {
                $this->produk_foto->setFormValue($val);
            }
        }

        // Check field name 'produk_nama' first before field var 'x_produk_nama'
        $val = $CurrentForm->hasValue("produk_nama") ? $CurrentForm->getValue("produk_nama") : $CurrentForm->getValue("x_produk_nama");
        if (!$this->produk_nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_nama->Visible = false; // Disable update for API request
            } else {
                $this->produk_nama->setFormValue($val);
            }
        }

        // Check field name 'produk_jenis' first before field var 'x_produk_jenis'
        $val = $CurrentForm->hasValue("produk_jenis") ? $CurrentForm->getValue("produk_jenis") : $CurrentForm->getValue("x_produk_jenis");
        if (!$this->produk_jenis->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_jenis->Visible = false; // Disable update for API request
            } else {
                $this->produk_jenis->setFormValue($val);
            }
        }

        // Check field name 'produk_desc' first before field var 'x_produk_desc'
        $val = $CurrentForm->hasValue("produk_desc") ? $CurrentForm->getValue("produk_desc") : $CurrentForm->getValue("x_produk_desc");
        if (!$this->produk_desc->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_desc->Visible = false; // Disable update for API request
            } else {
                $this->produk_desc->setFormValue($val);
            }
        }

        // Check field name 'produk_harga' first before field var 'x_produk_harga'
        $val = $CurrentForm->hasValue("produk_harga") ? $CurrentForm->getValue("produk_harga") : $CurrentForm->getValue("x_produk_harga");
        if (!$this->produk_harga->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_harga->Visible = false; // Disable update for API request
            } else {
                $this->produk_harga->setFormValue($val);
            }
        }

        // Check field name 'produk_berat' first before field var 'x_produk_berat'
        $val = $CurrentForm->hasValue("produk_berat") ? $CurrentForm->getValue("produk_berat") : $CurrentForm->getValue("x_produk_berat");
        if (!$this->produk_berat->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_berat->Visible = false; // Disable update for API request
            } else {
                $this->produk_berat->setFormValue($val);
            }
        }

        // Check field name 'kurator' first before field var 'x_kurator'
        $val = $CurrentForm->hasValue("kurator") ? $CurrentForm->getValue("kurator") : $CurrentForm->getValue("x_kurator");
        if (!$this->kurator->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kurator->Visible = false; // Disable update for API request
            } else {
                $this->kurator->setFormValue($val);
            }
        }

        // Check field name 'judul_sesuai' first before field var 'x_judul_sesuai'
        $val = $CurrentForm->hasValue("judul_sesuai") ? $CurrentForm->getValue("judul_sesuai") : $CurrentForm->getValue("x_judul_sesuai");
        if (!$this->judul_sesuai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->judul_sesuai->Visible = false; // Disable update for API request
            } else {
                $this->judul_sesuai->setFormValue($val);
            }
        }

        // Check field name 'foto_bagus' first before field var 'x_foto_bagus'
        $val = $CurrentForm->hasValue("foto_bagus") ? $CurrentForm->getValue("foto_bagus") : $CurrentForm->getValue("x_foto_bagus");
        if (!$this->foto_bagus->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->foto_bagus->Visible = false; // Disable update for API request
            } else {
                $this->foto_bagus->setFormValue($val);
            }
        }

        // Check field name 'deskripsi_jelas' first before field var 'x_deskripsi_jelas'
        $val = $CurrentForm->hasValue("deskripsi_jelas") ? $CurrentForm->getValue("deskripsi_jelas") : $CurrentForm->getValue("x_deskripsi_jelas");
        if (!$this->deskripsi_jelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->deskripsi_jelas->Visible = false; // Disable update for API request
            } else {
                $this->deskripsi_jelas->setFormValue($val);
            }
        }

        // Check field name 'harga_tidak_kosong' first before field var 'x_harga_tidak_kosong'
        $val = $CurrentForm->hasValue("harga_tidak_kosong") ? $CurrentForm->getValue("harga_tidak_kosong") : $CurrentForm->getValue("x_harga_tidak_kosong");
        if (!$this->harga_tidak_kosong->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->harga_tidak_kosong->Visible = false; // Disable update for API request
            } else {
                $this->harga_tidak_kosong->setFormValue($val);
            }
        }

        // Check field name 'berat_tidak_kosong' first before field var 'x_berat_tidak_kosong'
        $val = $CurrentForm->hasValue("berat_tidak_kosong") ? $CurrentForm->getValue("berat_tidak_kosong") : $CurrentForm->getValue("x_berat_tidak_kosong");
        if (!$this->berat_tidak_kosong->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->berat_tidak_kosong->Visible = false; // Disable update for API request
            } else {
                $this->berat_tidak_kosong->setFormValue($val);
            }
        }

        // Check field name 'produk_panjang' first before field var 'x_produk_panjang'
        $val = $CurrentForm->hasValue("produk_panjang") ? $CurrentForm->getValue("produk_panjang") : $CurrentForm->getValue("x_produk_panjang");
        if (!$this->produk_panjang->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_panjang->Visible = false; // Disable update for API request
            } else {
                $this->produk_panjang->setFormValue($val);
            }
        }

        // Check field name 'produk_lebar' first before field var 'x_produk_lebar'
        $val = $CurrentForm->hasValue("produk_lebar") ? $CurrentForm->getValue("produk_lebar") : $CurrentForm->getValue("x_produk_lebar");
        if (!$this->produk_lebar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_lebar->Visible = false; // Disable update for API request
            } else {
                $this->produk_lebar->setFormValue($val);
            }
        }

        // Check field name 'produk_tinggi' first before field var 'x_produk_tinggi'
        $val = $CurrentForm->hasValue("produk_tinggi") ? $CurrentForm->getValue("produk_tinggi") : $CurrentForm->getValue("x_produk_tinggi");
        if (!$this->produk_tinggi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_tinggi->Visible = false; // Disable update for API request
            } else {
                $this->produk_tinggi->setFormValue($val);
            }
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->produk_foto->CurrentValue = $this->produk_foto->FormValue;
        $this->produk_nama->CurrentValue = $this->produk_nama->FormValue;
        $this->produk_jenis->CurrentValue = $this->produk_jenis->FormValue;
        $this->produk_desc->CurrentValue = $this->produk_desc->FormValue;
        $this->produk_harga->CurrentValue = $this->produk_harga->FormValue;
        $this->produk_berat->CurrentValue = $this->produk_berat->FormValue;
        $this->kurator->CurrentValue = $this->kurator->FormValue;
        $this->judul_sesuai->CurrentValue = $this->judul_sesuai->FormValue;
        $this->foto_bagus->CurrentValue = $this->foto_bagus->FormValue;
        $this->deskripsi_jelas->CurrentValue = $this->deskripsi_jelas->FormValue;
        $this->harga_tidak_kosong->CurrentValue = $this->harga_tidak_kosong->FormValue;
        $this->berat_tidak_kosong->CurrentValue = $this->berat_tidak_kosong->FormValue;
        $this->produk_panjang->CurrentValue = $this->produk_panjang->FormValue;
        $this->produk_lebar->CurrentValue = $this->produk_lebar->FormValue;
        $this->produk_tinggi->CurrentValue = $this->produk_tinggi->FormValue;
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
        $this->produk_foto->setDbValue($row['produk_foto']);
        $this->nik_ukm->setDbValue($row['nik_ukm']);
        $this->produk_nama->setDbValue($row['produk_nama']);
        $this->produk_jenis->setDbValue($row['produk_jenis']);
        $this->produk_desc->setDbValue($row['produk_desc']);
        $this->produk_harga->setDbValue($row['produk_harga']);
        $this->produk_berat->setDbValue($row['produk_berat']);
        $this->kurator->setDbValue($row['kurator']);
        $this->produk_legal->setDbValue($row['produk_legal']);
        $this->judul_sesuai->setDbValue($row['judul_sesuai']);
        $this->foto_bagus->setDbValue($row['foto_bagus']);
        $this->deskripsi_jelas->setDbValue($row['deskripsi_jelas']);
        $this->harga_tidak_kosong->setDbValue($row['harga_tidak_kosong']);
        $this->berat_tidak_kosong->setDbValue($row['berat_tidak_kosong']);
        $this->produk_foto_1->Upload->DbValue = $row['produk_foto_1'];
        $this->produk_foto_1->setDbValue($this->produk_foto_1->Upload->DbValue);
        $this->produk_foto_2->Upload->DbValue = $row['produk_foto_2'];
        $this->produk_foto_2->setDbValue($this->produk_foto_2->Upload->DbValue);
        $this->produk_foto_3->Upload->DbValue = $row['produk_foto_3'];
        $this->produk_foto_3->setDbValue($this->produk_foto_3->Upload->DbValue);
        $this->produk_panjang->setDbValue($row['produk_panjang']);
        $this->produk_lebar->setDbValue($row['produk_lebar']);
        $this->produk_tinggi->setDbValue($row['produk_tinggi']);
        $this->waktu_kurasi->setDbValue($row['waktu_kurasi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['id'] = $this->id->CurrentValue;
        $row['produk_foto'] = $this->produk_foto->CurrentValue;
        $row['nik_ukm'] = $this->nik_ukm->CurrentValue;
        $row['produk_nama'] = $this->produk_nama->CurrentValue;
        $row['produk_jenis'] = $this->produk_jenis->CurrentValue;
        $row['produk_desc'] = $this->produk_desc->CurrentValue;
        $row['produk_harga'] = $this->produk_harga->CurrentValue;
        $row['produk_berat'] = $this->produk_berat->CurrentValue;
        $row['kurator'] = $this->kurator->CurrentValue;
        $row['produk_legal'] = $this->produk_legal->CurrentValue;
        $row['judul_sesuai'] = $this->judul_sesuai->CurrentValue;
        $row['foto_bagus'] = $this->foto_bagus->CurrentValue;
        $row['deskripsi_jelas'] = $this->deskripsi_jelas->CurrentValue;
        $row['harga_tidak_kosong'] = $this->harga_tidak_kosong->CurrentValue;
        $row['berat_tidak_kosong'] = $this->berat_tidak_kosong->CurrentValue;
        $row['produk_foto_1'] = $this->produk_foto_1->Upload->DbValue;
        $row['produk_foto_2'] = $this->produk_foto_2->Upload->DbValue;
        $row['produk_foto_3'] = $this->produk_foto_3->Upload->DbValue;
        $row['produk_panjang'] = $this->produk_panjang->CurrentValue;
        $row['produk_lebar'] = $this->produk_lebar->CurrentValue;
        $row['produk_tinggi'] = $this->produk_tinggi->CurrentValue;
        $row['waktu_kurasi'] = $this->waktu_kurasi->CurrentValue;
        return $row;
    }

    // Load old record
    protected function loadOldRecord()
    {
        return false;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->produk_harga->FormValue == $this->produk_harga->CurrentValue && is_numeric(ConvertToFloatString($this->produk_harga->CurrentValue))) {
            $this->produk_harga->CurrentValue = ConvertToFloatString($this->produk_harga->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_berat->FormValue == $this->produk_berat->CurrentValue && is_numeric(ConvertToFloatString($this->produk_berat->CurrentValue))) {
            $this->produk_berat->CurrentValue = ConvertToFloatString($this->produk_berat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_panjang->FormValue == $this->produk_panjang->CurrentValue && is_numeric(ConvertToFloatString($this->produk_panjang->CurrentValue))) {
            $this->produk_panjang->CurrentValue = ConvertToFloatString($this->produk_panjang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_lebar->FormValue == $this->produk_lebar->CurrentValue && is_numeric(ConvertToFloatString($this->produk_lebar->CurrentValue))) {
            $this->produk_lebar->CurrentValue = ConvertToFloatString($this->produk_lebar->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_tinggi->FormValue == $this->produk_tinggi->CurrentValue && is_numeric(ConvertToFloatString($this->produk_tinggi->CurrentValue))) {
            $this->produk_tinggi->CurrentValue = ConvertToFloatString($this->produk_tinggi->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id

        // produk_foto

        // nik_ukm

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // produk_berat

        // kurator

        // produk_legal

        // judul_sesuai

        // foto_bagus

        // deskripsi_jelas

        // harga_tidak_kosong

        // berat_tidak_kosong

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // waktu_kurasi
        if ($this->RowType == ROWTYPE_VIEW) {
            // produk_foto
            $this->produk_foto->ViewValue = $this->produk_foto->CurrentValue;
            $this->produk_foto->ViewCustomAttributes = "";

            // produk_nama
            $this->produk_nama->ViewValue = $this->produk_nama->CurrentValue;
            $this->produk_nama->ViewCustomAttributes = "";

            // produk_jenis
            $this->produk_jenis->ViewValue = $this->produk_jenis->CurrentValue;
            $this->produk_jenis->ViewCustomAttributes = "";

            // produk_desc
            $this->produk_desc->ViewValue = $this->produk_desc->CurrentValue;
            $this->produk_desc->ViewCustomAttributes = "";

            // produk_harga
            $this->produk_harga->ViewValue = $this->produk_harga->CurrentValue;
            $this->produk_harga->ViewValue = FormatNumber($this->produk_harga->ViewValue, 2, -2, -2, -2);
            $this->produk_harga->ViewCustomAttributes = "";

            // produk_berat
            $this->produk_berat->ViewValue = $this->produk_berat->CurrentValue;
            $this->produk_berat->ViewValue = FormatNumber($this->produk_berat->ViewValue, 2, -2, -2, -2);
            $this->produk_berat->ViewCustomAttributes = "";

            // kurator
            $this->kurator->ViewValue = $this->kurator->CurrentValue;
            $this->kurator->ViewCustomAttributes = "";

            // judul_sesuai
            if (strval($this->judul_sesuai->CurrentValue) != "") {
                $this->judul_sesuai->ViewValue = $this->judul_sesuai->optionCaption($this->judul_sesuai->CurrentValue);
            } else {
                $this->judul_sesuai->ViewValue = null;
            }
            $this->judul_sesuai->ViewCustomAttributes = "";

            // foto_bagus
            if (strval($this->foto_bagus->CurrentValue) != "") {
                $this->foto_bagus->ViewValue = $this->foto_bagus->optionCaption($this->foto_bagus->CurrentValue);
            } else {
                $this->foto_bagus->ViewValue = null;
            }
            $this->foto_bagus->ViewCustomAttributes = "";

            // deskripsi_jelas
            if (strval($this->deskripsi_jelas->CurrentValue) != "") {
                $this->deskripsi_jelas->ViewValue = $this->deskripsi_jelas->optionCaption($this->deskripsi_jelas->CurrentValue);
            } else {
                $this->deskripsi_jelas->ViewValue = null;
            }
            $this->deskripsi_jelas->ViewCustomAttributes = "";

            // harga_tidak_kosong
            if (strval($this->harga_tidak_kosong->CurrentValue) != "") {
                $this->harga_tidak_kosong->ViewValue = $this->harga_tidak_kosong->optionCaption($this->harga_tidak_kosong->CurrentValue);
            } else {
                $this->harga_tidak_kosong->ViewValue = null;
            }
            $this->harga_tidak_kosong->ViewCustomAttributes = "";

            // berat_tidak_kosong
            if (strval($this->berat_tidak_kosong->CurrentValue) != "") {
                $this->berat_tidak_kosong->ViewValue = $this->berat_tidak_kosong->optionCaption($this->berat_tidak_kosong->CurrentValue);
            } else {
                $this->berat_tidak_kosong->ViewValue = null;
            }
            $this->berat_tidak_kosong->ViewCustomAttributes = "";

            // produk_foto_1
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
                $this->produk_foto_1->ViewValue = $this->produk_foto_1->Upload->DbValue;
            } else {
                $this->produk_foto_1->ViewValue = "";
            }
            $this->produk_foto_1->ViewCustomAttributes = "";

            // produk_foto_2
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
                $this->produk_foto_2->ViewValue = $this->produk_foto_2->Upload->DbValue;
            } else {
                $this->produk_foto_2->ViewValue = "";
            }
            $this->produk_foto_2->ViewCustomAttributes = "";

            // produk_foto_3
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
                $this->produk_foto_3->ViewValue = $this->produk_foto_3->Upload->DbValue;
            } else {
                $this->produk_foto_3->ViewValue = "";
            }
            $this->produk_foto_3->ViewCustomAttributes = "";

            // produk_panjang
            $this->produk_panjang->ViewValue = $this->produk_panjang->CurrentValue;
            $this->produk_panjang->ViewValue = FormatNumber($this->produk_panjang->ViewValue, 2, -2, -2, -2);
            $this->produk_panjang->ViewCustomAttributes = "";

            // produk_lebar
            $this->produk_lebar->ViewValue = $this->produk_lebar->CurrentValue;
            $this->produk_lebar->ViewValue = FormatNumber($this->produk_lebar->ViewValue, 2, -2, -2, -2);
            $this->produk_lebar->ViewCustomAttributes = "";

            // produk_tinggi
            $this->produk_tinggi->ViewValue = $this->produk_tinggi->CurrentValue;
            $this->produk_tinggi->ViewValue = FormatNumber($this->produk_tinggi->ViewValue, 2, -2, -2, -2);
            $this->produk_tinggi->ViewCustomAttributes = "";

            // produk_foto
            $this->produk_foto->LinkCustomAttributes = "";
            $this->produk_foto->HrefValue = "";
            $this->produk_foto->TooltipValue = "";

            // produk_nama
            $this->produk_nama->LinkCustomAttributes = "";
            $this->produk_nama->HrefValue = "";
            $this->produk_nama->TooltipValue = "";

            // produk_jenis
            $this->produk_jenis->LinkCustomAttributes = "";
            $this->produk_jenis->HrefValue = "";
            $this->produk_jenis->TooltipValue = "";

            // produk_desc
            $this->produk_desc->LinkCustomAttributes = "";
            $this->produk_desc->HrefValue = "";
            $this->produk_desc->TooltipValue = "";

            // produk_harga
            $this->produk_harga->LinkCustomAttributes = "";
            $this->produk_harga->HrefValue = "";
            $this->produk_harga->TooltipValue = "";

            // produk_berat
            $this->produk_berat->LinkCustomAttributes = "";
            $this->produk_berat->HrefValue = "";
            $this->produk_berat->TooltipValue = "";

            // kurator
            $this->kurator->LinkCustomAttributes = "";
            $this->kurator->HrefValue = "";
            $this->kurator->TooltipValue = "";

            // judul_sesuai
            $this->judul_sesuai->LinkCustomAttributes = "";
            $this->judul_sesuai->HrefValue = "";
            $this->judul_sesuai->TooltipValue = "";

            // foto_bagus
            $this->foto_bagus->LinkCustomAttributes = "";
            $this->foto_bagus->HrefValue = "";
            $this->foto_bagus->TooltipValue = "";

            // deskripsi_jelas
            $this->deskripsi_jelas->LinkCustomAttributes = "";
            $this->deskripsi_jelas->HrefValue = "";
            $this->deskripsi_jelas->TooltipValue = "";

            // harga_tidak_kosong
            $this->harga_tidak_kosong->LinkCustomAttributes = "";
            $this->harga_tidak_kosong->HrefValue = "";
            $this->harga_tidak_kosong->TooltipValue = "";

            // berat_tidak_kosong
            $this->berat_tidak_kosong->LinkCustomAttributes = "";
            $this->berat_tidak_kosong->HrefValue = "";
            $this->berat_tidak_kosong->TooltipValue = "";

            // produk_foto_1
            $this->produk_foto_1->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->HrefValue = GetFileUploadUrl($this->produk_foto_1, $this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_1->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_1->HrefValue = FullUrl($this->produk_foto_1->HrefValue, "href");
                }
            } else {
                $this->produk_foto_1->HrefValue = "";
            }
            $this->produk_foto_1->ExportHrefValue = $this->produk_foto_1->UploadPath . $this->produk_foto_1->Upload->DbValue;
            $this->produk_foto_1->TooltipValue = "";
            if ($this->produk_foto_1->UseColorbox) {
                if (EmptyValue($this->produk_foto_1->TooltipValue)) {
                    $this->produk_foto_1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_1->LinkAttrs["data-rel"] = "Produk_Lolos_Kurasi_x_produk_foto_1";
                $this->produk_foto_1->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_foto_2
            $this->produk_foto_2->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->HrefValue = GetFileUploadUrl($this->produk_foto_2, $this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_2->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_2->HrefValue = FullUrl($this->produk_foto_2->HrefValue, "href");
                }
            } else {
                $this->produk_foto_2->HrefValue = "";
            }
            $this->produk_foto_2->ExportHrefValue = $this->produk_foto_2->UploadPath . $this->produk_foto_2->Upload->DbValue;
            $this->produk_foto_2->TooltipValue = "";
            if ($this->produk_foto_2->UseColorbox) {
                if (EmptyValue($this->produk_foto_2->TooltipValue)) {
                    $this->produk_foto_2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_2->LinkAttrs["data-rel"] = "Produk_Lolos_Kurasi_x_produk_foto_2";
                $this->produk_foto_2->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_foto_3
            $this->produk_foto_3->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->HrefValue = GetFileUploadUrl($this->produk_foto_3, $this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_3->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_3->HrefValue = FullUrl($this->produk_foto_3->HrefValue, "href");
                }
            } else {
                $this->produk_foto_3->HrefValue = "";
            }
            $this->produk_foto_3->ExportHrefValue = $this->produk_foto_3->UploadPath . $this->produk_foto_3->Upload->DbValue;
            $this->produk_foto_3->TooltipValue = "";
            if ($this->produk_foto_3->UseColorbox) {
                if (EmptyValue($this->produk_foto_3->TooltipValue)) {
                    $this->produk_foto_3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_3->LinkAttrs["data-rel"] = "Produk_Lolos_Kurasi_x_produk_foto_3";
                $this->produk_foto_3->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_panjang
            $this->produk_panjang->LinkCustomAttributes = "";
            $this->produk_panjang->HrefValue = "";
            $this->produk_panjang->TooltipValue = "";

            // produk_lebar
            $this->produk_lebar->LinkCustomAttributes = "";
            $this->produk_lebar->HrefValue = "";
            $this->produk_lebar->TooltipValue = "";

            // produk_tinggi
            $this->produk_tinggi->LinkCustomAttributes = "";
            $this->produk_tinggi->HrefValue = "";
            $this->produk_tinggi->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // produk_foto
            $this->produk_foto->EditAttrs["class"] = "form-control";
            $this->produk_foto->EditCustomAttributes = "";
            if (!$this->produk_foto->Raw) {
                $this->produk_foto->CurrentValue = HtmlDecode($this->produk_foto->CurrentValue);
            }
            $this->produk_foto->EditValue = HtmlEncode($this->produk_foto->CurrentValue);
            $this->produk_foto->PlaceHolder = RemoveHtml($this->produk_foto->caption());

            // produk_nama
            $this->produk_nama->EditAttrs["class"] = "form-control";
            $this->produk_nama->EditCustomAttributes = "";
            if (!$this->produk_nama->Raw) {
                $this->produk_nama->CurrentValue = HtmlDecode($this->produk_nama->CurrentValue);
            }
            $this->produk_nama->EditValue = HtmlEncode($this->produk_nama->CurrentValue);
            $this->produk_nama->PlaceHolder = RemoveHtml($this->produk_nama->caption());

            // produk_jenis
            $this->produk_jenis->EditAttrs["class"] = "form-control";
            $this->produk_jenis->EditCustomAttributes = "";
            if (!$this->produk_jenis->Raw) {
                $this->produk_jenis->CurrentValue = HtmlDecode($this->produk_jenis->CurrentValue);
            }
            $this->produk_jenis->EditValue = HtmlEncode($this->produk_jenis->CurrentValue);
            $this->produk_jenis->PlaceHolder = RemoveHtml($this->produk_jenis->caption());

            // produk_desc
            $this->produk_desc->EditAttrs["class"] = "form-control";
            $this->produk_desc->EditCustomAttributes = "";
            $this->produk_desc->EditValue = HtmlEncode($this->produk_desc->CurrentValue);
            $this->produk_desc->PlaceHolder = RemoveHtml($this->produk_desc->caption());

            // produk_harga
            $this->produk_harga->EditAttrs["class"] = "form-control";
            $this->produk_harga->EditCustomAttributes = "";
            $this->produk_harga->EditValue = HtmlEncode($this->produk_harga->CurrentValue);
            $this->produk_harga->PlaceHolder = RemoveHtml($this->produk_harga->caption());
            if (strval($this->produk_harga->EditValue) != "" && is_numeric($this->produk_harga->EditValue)) {
                $this->produk_harga->EditValue = FormatNumber($this->produk_harga->EditValue, -2, -2, -2, -2);
            }

            // produk_berat
            $this->produk_berat->EditAttrs["class"] = "form-control";
            $this->produk_berat->EditCustomAttributes = "";
            $this->produk_berat->EditValue = HtmlEncode($this->produk_berat->CurrentValue);
            $this->produk_berat->PlaceHolder = RemoveHtml($this->produk_berat->caption());
            if (strval($this->produk_berat->EditValue) != "" && is_numeric($this->produk_berat->EditValue)) {
                $this->produk_berat->EditValue = FormatNumber($this->produk_berat->EditValue, -2, -2, -2, -2);
            }

            // kurator
            $this->kurator->EditAttrs["class"] = "form-control";
            $this->kurator->EditCustomAttributes = "";
            if (!$this->kurator->Raw) {
                $this->kurator->CurrentValue = HtmlDecode($this->kurator->CurrentValue);
            }
            $this->kurator->EditValue = HtmlEncode($this->kurator->CurrentValue);
            $this->kurator->PlaceHolder = RemoveHtml($this->kurator->caption());

            // judul_sesuai
            $this->judul_sesuai->EditCustomAttributes = "";
            $this->judul_sesuai->EditValue = $this->judul_sesuai->options(false);
            $this->judul_sesuai->PlaceHolder = RemoveHtml($this->judul_sesuai->caption());

            // foto_bagus
            $this->foto_bagus->EditCustomAttributes = "";
            $this->foto_bagus->EditValue = $this->foto_bagus->options(false);
            $this->foto_bagus->PlaceHolder = RemoveHtml($this->foto_bagus->caption());

            // deskripsi_jelas
            $this->deskripsi_jelas->EditCustomAttributes = "";
            $this->deskripsi_jelas->EditValue = $this->deskripsi_jelas->options(false);
            $this->deskripsi_jelas->PlaceHolder = RemoveHtml($this->deskripsi_jelas->caption());

            // harga_tidak_kosong
            $this->harga_tidak_kosong->EditCustomAttributes = "";
            $this->harga_tidak_kosong->EditValue = $this->harga_tidak_kosong->options(false);
            $this->harga_tidak_kosong->PlaceHolder = RemoveHtml($this->harga_tidak_kosong->caption());

            // berat_tidak_kosong
            $this->berat_tidak_kosong->EditCustomAttributes = "";
            $this->berat_tidak_kosong->EditValue = $this->berat_tidak_kosong->options(false);
            $this->berat_tidak_kosong->PlaceHolder = RemoveHtml($this->berat_tidak_kosong->caption());

            // produk_foto_1
            $this->produk_foto_1->EditAttrs["class"] = "form-control";
            $this->produk_foto_1->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
                $this->produk_foto_1->EditValue = $this->produk_foto_1->Upload->DbValue;
            } else {
                $this->produk_foto_1->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_1->CurrentValue)) {
                $this->produk_foto_1->Upload->FileName = $this->produk_foto_1->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->produk_foto_1);
            }

            // produk_foto_2
            $this->produk_foto_2->EditAttrs["class"] = "form-control";
            $this->produk_foto_2->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
                $this->produk_foto_2->EditValue = $this->produk_foto_2->Upload->DbValue;
            } else {
                $this->produk_foto_2->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_2->CurrentValue)) {
                $this->produk_foto_2->Upload->FileName = $this->produk_foto_2->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->produk_foto_2);
            }

            // produk_foto_3
            $this->produk_foto_3->EditAttrs["class"] = "form-control";
            $this->produk_foto_3->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
                $this->produk_foto_3->EditValue = $this->produk_foto_3->Upload->DbValue;
            } else {
                $this->produk_foto_3->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_3->CurrentValue)) {
                $this->produk_foto_3->Upload->FileName = $this->produk_foto_3->CurrentValue;
            }
            if ($this->isShow() || $this->isCopy()) {
                RenderUploadField($this->produk_foto_3);
            }

            // produk_panjang
            $this->produk_panjang->EditAttrs["class"] = "form-control";
            $this->produk_panjang->EditCustomAttributes = "";
            $this->produk_panjang->EditValue = HtmlEncode($this->produk_panjang->CurrentValue);
            $this->produk_panjang->PlaceHolder = RemoveHtml($this->produk_panjang->caption());
            if (strval($this->produk_panjang->EditValue) != "" && is_numeric($this->produk_panjang->EditValue)) {
                $this->produk_panjang->EditValue = FormatNumber($this->produk_panjang->EditValue, -2, -2, -2, -2);
            }

            // produk_lebar
            $this->produk_lebar->EditAttrs["class"] = "form-control";
            $this->produk_lebar->EditCustomAttributes = "";
            $this->produk_lebar->EditValue = HtmlEncode($this->produk_lebar->CurrentValue);
            $this->produk_lebar->PlaceHolder = RemoveHtml($this->produk_lebar->caption());
            if (strval($this->produk_lebar->EditValue) != "" && is_numeric($this->produk_lebar->EditValue)) {
                $this->produk_lebar->EditValue = FormatNumber($this->produk_lebar->EditValue, -2, -2, -2, -2);
            }

            // produk_tinggi
            $this->produk_tinggi->EditAttrs["class"] = "form-control";
            $this->produk_tinggi->EditCustomAttributes = "";
            $this->produk_tinggi->EditValue = HtmlEncode($this->produk_tinggi->CurrentValue);
            $this->produk_tinggi->PlaceHolder = RemoveHtml($this->produk_tinggi->caption());
            if (strval($this->produk_tinggi->EditValue) != "" && is_numeric($this->produk_tinggi->EditValue)) {
                $this->produk_tinggi->EditValue = FormatNumber($this->produk_tinggi->EditValue, -2, -2, -2, -2);
            }

            // Add refer script

            // produk_foto
            $this->produk_foto->LinkCustomAttributes = "";
            $this->produk_foto->HrefValue = "";

            // produk_nama
            $this->produk_nama->LinkCustomAttributes = "";
            $this->produk_nama->HrefValue = "";

            // produk_jenis
            $this->produk_jenis->LinkCustomAttributes = "";
            $this->produk_jenis->HrefValue = "";

            // produk_desc
            $this->produk_desc->LinkCustomAttributes = "";
            $this->produk_desc->HrefValue = "";

            // produk_harga
            $this->produk_harga->LinkCustomAttributes = "";
            $this->produk_harga->HrefValue = "";

            // produk_berat
            $this->produk_berat->LinkCustomAttributes = "";
            $this->produk_berat->HrefValue = "";

            // kurator
            $this->kurator->LinkCustomAttributes = "";
            $this->kurator->HrefValue = "";

            // judul_sesuai
            $this->judul_sesuai->LinkCustomAttributes = "";
            $this->judul_sesuai->HrefValue = "";

            // foto_bagus
            $this->foto_bagus->LinkCustomAttributes = "";
            $this->foto_bagus->HrefValue = "";

            // deskripsi_jelas
            $this->deskripsi_jelas->LinkCustomAttributes = "";
            $this->deskripsi_jelas->HrefValue = "";

            // harga_tidak_kosong
            $this->harga_tidak_kosong->LinkCustomAttributes = "";
            $this->harga_tidak_kosong->HrefValue = "";

            // berat_tidak_kosong
            $this->berat_tidak_kosong->LinkCustomAttributes = "";
            $this->berat_tidak_kosong->HrefValue = "";

            // produk_foto_1
            $this->produk_foto_1->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->HrefValue = GetFileUploadUrl($this->produk_foto_1, $this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_1->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_1->HrefValue = FullUrl($this->produk_foto_1->HrefValue, "href");
                }
            } else {
                $this->produk_foto_1->HrefValue = "";
            }
            $this->produk_foto_1->ExportHrefValue = $this->produk_foto_1->UploadPath . $this->produk_foto_1->Upload->DbValue;

            // produk_foto_2
            $this->produk_foto_2->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->HrefValue = GetFileUploadUrl($this->produk_foto_2, $this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_2->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_2->HrefValue = FullUrl($this->produk_foto_2->HrefValue, "href");
                }
            } else {
                $this->produk_foto_2->HrefValue = "";
            }
            $this->produk_foto_2->ExportHrefValue = $this->produk_foto_2->UploadPath . $this->produk_foto_2->Upload->DbValue;

            // produk_foto_3
            $this->produk_foto_3->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->HrefValue = GetFileUploadUrl($this->produk_foto_3, $this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_3->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_3->HrefValue = FullUrl($this->produk_foto_3->HrefValue, "href");
                }
            } else {
                $this->produk_foto_3->HrefValue = "";
            }
            $this->produk_foto_3->ExportHrefValue = $this->produk_foto_3->UploadPath . $this->produk_foto_3->Upload->DbValue;

            // produk_panjang
            $this->produk_panjang->LinkCustomAttributes = "";
            $this->produk_panjang->HrefValue = "";

            // produk_lebar
            $this->produk_lebar->LinkCustomAttributes = "";
            $this->produk_lebar->HrefValue = "";

            // produk_tinggi
            $this->produk_tinggi->LinkCustomAttributes = "";
            $this->produk_tinggi->HrefValue = "";
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
        if ($this->produk_foto->Required) {
            if (!$this->produk_foto->IsDetailKey && EmptyValue($this->produk_foto->FormValue)) {
                $this->produk_foto->addErrorMessage(str_replace("%s", $this->produk_foto->caption(), $this->produk_foto->RequiredErrorMessage));
            }
        }
        if ($this->produk_nama->Required) {
            if (!$this->produk_nama->IsDetailKey && EmptyValue($this->produk_nama->FormValue)) {
                $this->produk_nama->addErrorMessage(str_replace("%s", $this->produk_nama->caption(), $this->produk_nama->RequiredErrorMessage));
            }
        }
        if ($this->produk_jenis->Required) {
            if (!$this->produk_jenis->IsDetailKey && EmptyValue($this->produk_jenis->FormValue)) {
                $this->produk_jenis->addErrorMessage(str_replace("%s", $this->produk_jenis->caption(), $this->produk_jenis->RequiredErrorMessage));
            }
        }
        if ($this->produk_desc->Required) {
            if (!$this->produk_desc->IsDetailKey && EmptyValue($this->produk_desc->FormValue)) {
                $this->produk_desc->addErrorMessage(str_replace("%s", $this->produk_desc->caption(), $this->produk_desc->RequiredErrorMessage));
            }
        }
        if ($this->produk_harga->Required) {
            if (!$this->produk_harga->IsDetailKey && EmptyValue($this->produk_harga->FormValue)) {
                $this->produk_harga->addErrorMessage(str_replace("%s", $this->produk_harga->caption(), $this->produk_harga->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_harga->FormValue)) {
            $this->produk_harga->addErrorMessage($this->produk_harga->getErrorMessage(false));
        }
        if ($this->produk_berat->Required) {
            if (!$this->produk_berat->IsDetailKey && EmptyValue($this->produk_berat->FormValue)) {
                $this->produk_berat->addErrorMessage(str_replace("%s", $this->produk_berat->caption(), $this->produk_berat->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_berat->FormValue)) {
            $this->produk_berat->addErrorMessage($this->produk_berat->getErrorMessage(false));
        }
        if ($this->kurator->Required) {
            if (!$this->kurator->IsDetailKey && EmptyValue($this->kurator->FormValue)) {
                $this->kurator->addErrorMessage(str_replace("%s", $this->kurator->caption(), $this->kurator->RequiredErrorMessage));
            }
        }
        if ($this->judul_sesuai->Required) {
            if ($this->judul_sesuai->FormValue == "") {
                $this->judul_sesuai->addErrorMessage(str_replace("%s", $this->judul_sesuai->caption(), $this->judul_sesuai->RequiredErrorMessage));
            }
        }
        if ($this->foto_bagus->Required) {
            if ($this->foto_bagus->FormValue == "") {
                $this->foto_bagus->addErrorMessage(str_replace("%s", $this->foto_bagus->caption(), $this->foto_bagus->RequiredErrorMessage));
            }
        }
        if ($this->deskripsi_jelas->Required) {
            if ($this->deskripsi_jelas->FormValue == "") {
                $this->deskripsi_jelas->addErrorMessage(str_replace("%s", $this->deskripsi_jelas->caption(), $this->deskripsi_jelas->RequiredErrorMessage));
            }
        }
        if ($this->harga_tidak_kosong->Required) {
            if ($this->harga_tidak_kosong->FormValue == "") {
                $this->harga_tidak_kosong->addErrorMessage(str_replace("%s", $this->harga_tidak_kosong->caption(), $this->harga_tidak_kosong->RequiredErrorMessage));
            }
        }
        if ($this->berat_tidak_kosong->Required) {
            if ($this->berat_tidak_kosong->FormValue == "") {
                $this->berat_tidak_kosong->addErrorMessage(str_replace("%s", $this->berat_tidak_kosong->caption(), $this->berat_tidak_kosong->RequiredErrorMessage));
            }
        }
        if ($this->produk_foto_1->Required) {
            if ($this->produk_foto_1->Upload->FileName == "" && !$this->produk_foto_1->Upload->KeepFile) {
                $this->produk_foto_1->addErrorMessage(str_replace("%s", $this->produk_foto_1->caption(), $this->produk_foto_1->RequiredErrorMessage));
            }
        }
        if ($this->produk_foto_2->Required) {
            if ($this->produk_foto_2->Upload->FileName == "" && !$this->produk_foto_2->Upload->KeepFile) {
                $this->produk_foto_2->addErrorMessage(str_replace("%s", $this->produk_foto_2->caption(), $this->produk_foto_2->RequiredErrorMessage));
            }
        }
        if ($this->produk_foto_3->Required) {
            if ($this->produk_foto_3->Upload->FileName == "" && !$this->produk_foto_3->Upload->KeepFile) {
                $this->produk_foto_3->addErrorMessage(str_replace("%s", $this->produk_foto_3->caption(), $this->produk_foto_3->RequiredErrorMessage));
            }
        }
        if ($this->produk_panjang->Required) {
            if (!$this->produk_panjang->IsDetailKey && EmptyValue($this->produk_panjang->FormValue)) {
                $this->produk_panjang->addErrorMessage(str_replace("%s", $this->produk_panjang->caption(), $this->produk_panjang->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_panjang->FormValue)) {
            $this->produk_panjang->addErrorMessage($this->produk_panjang->getErrorMessage(false));
        }
        if ($this->produk_lebar->Required) {
            if (!$this->produk_lebar->IsDetailKey && EmptyValue($this->produk_lebar->FormValue)) {
                $this->produk_lebar->addErrorMessage(str_replace("%s", $this->produk_lebar->caption(), $this->produk_lebar->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_lebar->FormValue)) {
            $this->produk_lebar->addErrorMessage($this->produk_lebar->getErrorMessage(false));
        }
        if ($this->produk_tinggi->Required) {
            if (!$this->produk_tinggi->IsDetailKey && EmptyValue($this->produk_tinggi->FormValue)) {
                $this->produk_tinggi->addErrorMessage(str_replace("%s", $this->produk_tinggi->caption(), $this->produk_tinggi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_tinggi->FormValue)) {
            $this->produk_tinggi->addErrorMessage($this->produk_tinggi->getErrorMessage(false));
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

        // produk_foto
        $this->produk_foto->setDbValueDef($rsnew, $this->produk_foto->CurrentValue, null, false);

        // produk_nama
        $this->produk_nama->setDbValueDef($rsnew, $this->produk_nama->CurrentValue, null, false);

        // produk_jenis
        $this->produk_jenis->setDbValueDef($rsnew, $this->produk_jenis->CurrentValue, null, false);

        // produk_desc
        $this->produk_desc->setDbValueDef($rsnew, $this->produk_desc->CurrentValue, null, false);

        // produk_harga
        $this->produk_harga->setDbValueDef($rsnew, $this->produk_harga->CurrentValue, null, strval($this->produk_harga->CurrentValue) == "");

        // produk_berat
        $this->produk_berat->setDbValueDef($rsnew, $this->produk_berat->CurrentValue, 0, false);

        // kurator
        $this->kurator->setDbValueDef($rsnew, $this->kurator->CurrentValue, null, false);

        // judul_sesuai
        $this->judul_sesuai->setDbValueDef($rsnew, $this->judul_sesuai->CurrentValue, null, strval($this->judul_sesuai->CurrentValue) == "");

        // foto_bagus
        $this->foto_bagus->setDbValueDef($rsnew, $this->foto_bagus->CurrentValue, null, strval($this->foto_bagus->CurrentValue) == "");

        // deskripsi_jelas
        $this->deskripsi_jelas->setDbValueDef($rsnew, $this->deskripsi_jelas->CurrentValue, null, strval($this->deskripsi_jelas->CurrentValue) == "");

        // harga_tidak_kosong
        $this->harga_tidak_kosong->setDbValueDef($rsnew, $this->harga_tidak_kosong->CurrentValue, null, strval($this->harga_tidak_kosong->CurrentValue) == "");

        // berat_tidak_kosong
        $this->berat_tidak_kosong->setDbValueDef($rsnew, $this->berat_tidak_kosong->CurrentValue, null, strval($this->berat_tidak_kosong->CurrentValue) == "");

        // produk_foto_1
        if ($this->produk_foto_1->Visible && !$this->produk_foto_1->Upload->KeepFile) {
            $this->produk_foto_1->Upload->DbValue = ""; // No need to delete old file
            if ($this->produk_foto_1->Upload->FileName == "") {
                $rsnew['produk_foto_1'] = null;
            } else {
                $rsnew['produk_foto_1'] = $this->produk_foto_1->Upload->FileName;
            }
        }

        // produk_foto_2
        if ($this->produk_foto_2->Visible && !$this->produk_foto_2->Upload->KeepFile) {
            $this->produk_foto_2->Upload->DbValue = ""; // No need to delete old file
            if ($this->produk_foto_2->Upload->FileName == "") {
                $rsnew['produk_foto_2'] = null;
            } else {
                $rsnew['produk_foto_2'] = $this->produk_foto_2->Upload->FileName;
            }
        }

        // produk_foto_3
        if ($this->produk_foto_3->Visible && !$this->produk_foto_3->Upload->KeepFile) {
            $this->produk_foto_3->Upload->DbValue = ""; // No need to delete old file
            if ($this->produk_foto_3->Upload->FileName == "") {
                $rsnew['produk_foto_3'] = null;
            } else {
                $rsnew['produk_foto_3'] = $this->produk_foto_3->Upload->FileName;
            }
        }

        // produk_panjang
        $this->produk_panjang->setDbValueDef($rsnew, $this->produk_panjang->CurrentValue, 0, false);

        // produk_lebar
        $this->produk_lebar->setDbValueDef($rsnew, $this->produk_lebar->CurrentValue, 0, false);

        // produk_tinggi
        $this->produk_tinggi->setDbValueDef($rsnew, $this->produk_tinggi->CurrentValue, 0, false);
        if ($this->produk_foto_1->Visible && !$this->produk_foto_1->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->produk_foto_1->Upload->DbValue) ? [] : [$this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)];
            if (!EmptyValue($this->produk_foto_1->Upload->FileName)) {
                $newFiles = [$this->produk_foto_1->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->produk_foto_1, $this->produk_foto_1->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->produk_foto_1->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->produk_foto_1->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->produk_foto_1->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->produk_foto_1->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->produk_foto_1->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->produk_foto_1->setDbValueDef($rsnew, $this->produk_foto_1->Upload->FileName, null, false);
            }
        }
        if ($this->produk_foto_2->Visible && !$this->produk_foto_2->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->produk_foto_2->Upload->DbValue) ? [] : [$this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)];
            if (!EmptyValue($this->produk_foto_2->Upload->FileName)) {
                $newFiles = [$this->produk_foto_2->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->produk_foto_2, $this->produk_foto_2->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->produk_foto_2->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->produk_foto_2->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->produk_foto_2->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->produk_foto_2->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->produk_foto_2->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->produk_foto_2->setDbValueDef($rsnew, $this->produk_foto_2->Upload->FileName, null, false);
            }
        }
        if ($this->produk_foto_3->Visible && !$this->produk_foto_3->Upload->KeepFile) {
            $oldFiles = EmptyValue($this->produk_foto_3->Upload->DbValue) ? [] : [$this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)];
            if (!EmptyValue($this->produk_foto_3->Upload->FileName)) {
                $newFiles = [$this->produk_foto_3->Upload->FileName];
                $NewFileCount = count($newFiles);
                for ($i = 0; $i < $NewFileCount; $i++) {
                    if ($newFiles[$i] != "") {
                        $file = $newFiles[$i];
                        $tempPath = UploadTempPath($this->produk_foto_3, $this->produk_foto_3->Upload->Index);
                        if (file_exists($tempPath . $file)) {
                            if (Config("DELETE_UPLOADED_FILES")) {
                                $oldFileFound = false;
                                $oldFileCount = count($oldFiles);
                                for ($j = 0; $j < $oldFileCount; $j++) {
                                    $oldFile = $oldFiles[$j];
                                    if ($oldFile == $file) { // Old file found, no need to delete anymore
                                        array_splice($oldFiles, $j, 1);
                                        $oldFileFound = true;
                                        break;
                                    }
                                }
                                if ($oldFileFound) { // No need to check if file exists further
                                    continue;
                                }
                            }
                            $file1 = UniqueFilename($this->produk_foto_3->physicalUploadPath(), $file); // Get new file name
                            if ($file1 != $file) { // Rename temp file
                                while (file_exists($tempPath . $file1) || file_exists($this->produk_foto_3->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                    $file1 = UniqueFilename([$this->produk_foto_3->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                }
                                rename($tempPath . $file, $tempPath . $file1);
                                $newFiles[$i] = $file1;
                            }
                        }
                    }
                }
                $this->produk_foto_3->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                $this->produk_foto_3->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                $this->produk_foto_3->setDbValueDef($rsnew, $this->produk_foto_3->Upload->FileName, null, false);
            }
        }

        // Call Row Inserting event
        $insertRow = $this->rowInserting($rsold, $rsnew);
        $addRow = false;
        if ($insertRow) {
            try {
                $addRow = $this->insert($rsnew);
            } catch (\Exception $e) {
                $this->setFailureMessage($e->getMessage());
            }
            if ($addRow) {
                if ($this->produk_foto_1->Visible && !$this->produk_foto_1->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->produk_foto_1->Upload->DbValue) ? [] : [$this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)];
                    if (!EmptyValue($this->produk_foto_1->Upload->FileName)) {
                        $newFiles = [$this->produk_foto_1->Upload->FileName];
                        $newFiles2 = [$this->produk_foto_1->htmlDecode($rsnew['produk_foto_1'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->produk_foto_1, $this->produk_foto_1->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->produk_foto_1->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->produk_foto_1->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->produk_foto_2->Visible && !$this->produk_foto_2->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->produk_foto_2->Upload->DbValue) ? [] : [$this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)];
                    if (!EmptyValue($this->produk_foto_2->Upload->FileName)) {
                        $newFiles = [$this->produk_foto_2->Upload->FileName];
                        $newFiles2 = [$this->produk_foto_2->htmlDecode($rsnew['produk_foto_2'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->produk_foto_2, $this->produk_foto_2->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->produk_foto_2->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->produk_foto_2->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
                if ($this->produk_foto_3->Visible && !$this->produk_foto_3->Upload->KeepFile) {
                    $oldFiles = EmptyValue($this->produk_foto_3->Upload->DbValue) ? [] : [$this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)];
                    if (!EmptyValue($this->produk_foto_3->Upload->FileName)) {
                        $newFiles = [$this->produk_foto_3->Upload->FileName];
                        $newFiles2 = [$this->produk_foto_3->htmlDecode($rsnew['produk_foto_3'])];
                        $newFileCount = count($newFiles);
                        for ($i = 0; $i < $newFileCount; $i++) {
                            if ($newFiles[$i] != "") {
                                $file = UploadTempPath($this->produk_foto_3, $this->produk_foto_3->Upload->Index) . $newFiles[$i];
                                if (file_exists($file)) {
                                    if (@$newFiles2[$i] != "") { // Use correct file name
                                        $newFiles[$i] = $newFiles2[$i];
                                    }
                                    if (!$this->produk_foto_3->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
                                        $this->setFailureMessage($Language->phrase("UploadErrMsg7"));
                                        return false;
                                    }
                                }
                            }
                        }
                    } else {
                        $newFiles = [];
                    }
                    if (Config("DELETE_UPLOADED_FILES")) {
                        foreach ($oldFiles as $oldFile) {
                            if ($oldFile != "" && !in_array($oldFile, $newFiles)) {
                                @unlink($this->produk_foto_3->oldPhysicalUploadPath() . $oldFile);
                            }
                        }
                    }
                }
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
            // produk_foto_1
            CleanUploadTempPath($this->produk_foto_1, $this->produk_foto_1->Upload->Index);

            // produk_foto_2
            CleanUploadTempPath($this->produk_foto_2, $this->produk_foto_2->Upload->Index);

            // produk_foto_3
            CleanUploadTempPath($this->produk_foto_3, $this->produk_foto_3->Upload->Index);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("produkloloskurasilist"), "", $this->TableVar, true);
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
                case "x_produk_legal":
                    break;
                case "x_judul_sesuai":
                    break;
                case "x_foto_bagus":
                    break;
                case "x_deskripsi_jelas":
                    break;
                case "x_harga_tidak_kosong":
                    break;
                case "x_berat_tidak_kosong":
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
