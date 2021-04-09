<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class PhpKurasiPerbaikanEdit extends PhpKurasiPerbaikan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'php_kurasi_perbaikan';

    // Page object name
    public $PageObjName = "PhpKurasiPerbaikanEdit";

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

        // Table object (php_kurasi_perbaikan)
        if (!isset($GLOBALS["php_kurasi_perbaikan"]) || get_class($GLOBALS["php_kurasi_perbaikan"]) == PROJECT_NAMESPACE . "php_kurasi_perbaikan") {
            $GLOBALS["php_kurasi_perbaikan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'php_kurasi_perbaikan');
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
                $doc = new $class(Container("php_kurasi_perbaikan"));
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
                    if ($pageName == "phpkurasiperbaikanview") {
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
        $this->nik_ukm->setVisibility();
        $this->produk_nama->setVisibility();
        $this->produk_jenis->setVisibility();
        $this->produk_desc->setVisibility();
        $this->produk_harga->setVisibility();
        $this->produk_foto->setVisibility();
        $this->produk_berat->setVisibility();
        $this->produk_legal->setVisibility();
        $this->judul_sesuai->setVisibility();
        $this->foto_bagus->setVisibility();
        $this->deskripsi_jelas->setVisibility();
        $this->harga_tidak_kosong->setVisibility();
        $this->berat_tidak_kosong->setVisibility();
        $this->kurasi->setVisibility();
        $this->waktu_entry->setVisibility();
        $this->waktu_kurasi->setVisibility();
        $this->waktu_update->setVisibility();
        $this->editor->setVisibility();
        $this->kurator->setVisibility();
        $this->produk_panjang->setVisibility();
        $this->produk_lebar->setVisibility();
        $this->produk_tinggi->setVisibility();
        $this->produk_foto_1->setVisibility();
        $this->produk_foto_2->setVisibility();
        $this->produk_foto_3->setVisibility();
        $this->produk_foto_4->Visible = false;
        $this->catatan->setVisibility();
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
                    $this->terminate("phpkurasiperbaikanlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "phpkurasiperbaikanlist") {
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
        $this->produk_foto->Upload->Index = $CurrentForm->Index;
        $this->produk_foto->Upload->uploadFile();
        $this->produk_foto->CurrentValue = $this->produk_foto->Upload->FileName;
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

        // Check field name 'nik_ukm' first before field var 'x_nik_ukm'
        $val = $CurrentForm->hasValue("nik_ukm") ? $CurrentForm->getValue("nik_ukm") : $CurrentForm->getValue("x_nik_ukm");
        if (!$this->nik_ukm->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->nik_ukm->Visible = false; // Disable update for API request
            } else {
                $this->nik_ukm->setFormValue($val);
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

        // Check field name 'produk_legal' first before field var 'x_produk_legal'
        $val = $CurrentForm->hasValue("produk_legal") ? $CurrentForm->getValue("produk_legal") : $CurrentForm->getValue("x_produk_legal");
        if (!$this->produk_legal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->produk_legal->Visible = false; // Disable update for API request
            } else {
                $this->produk_legal->setFormValue($val);
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

        // Check field name 'kurasi' first before field var 'x_kurasi'
        $val = $CurrentForm->hasValue("kurasi") ? $CurrentForm->getValue("kurasi") : $CurrentForm->getValue("x_kurasi");
        if (!$this->kurasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kurasi->Visible = false; // Disable update for API request
            } else {
                $this->kurasi->setFormValue($val);
            }
        }

        // Check field name 'waktu_entry' first before field var 'x_waktu_entry'
        $val = $CurrentForm->hasValue("waktu_entry") ? $CurrentForm->getValue("waktu_entry") : $CurrentForm->getValue("x_waktu_entry");
        if (!$this->waktu_entry->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->waktu_entry->Visible = false; // Disable update for API request
            } else {
                $this->waktu_entry->setFormValue($val);
            }
            $this->waktu_entry->CurrentValue = UnFormatDateTime($this->waktu_entry->CurrentValue, 0);
        }

        // Check field name 'waktu_kurasi' first before field var 'x_waktu_kurasi'
        $val = $CurrentForm->hasValue("waktu_kurasi") ? $CurrentForm->getValue("waktu_kurasi") : $CurrentForm->getValue("x_waktu_kurasi");
        if (!$this->waktu_kurasi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->waktu_kurasi->Visible = false; // Disable update for API request
            } else {
                $this->waktu_kurasi->setFormValue($val);
            }
            $this->waktu_kurasi->CurrentValue = UnFormatDateTime($this->waktu_kurasi->CurrentValue, 0);
        }

        // Check field name 'waktu_update' first before field var 'x_waktu_update'
        $val = $CurrentForm->hasValue("waktu_update") ? $CurrentForm->getValue("waktu_update") : $CurrentForm->getValue("x_waktu_update");
        if (!$this->waktu_update->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->waktu_update->Visible = false; // Disable update for API request
            } else {
                $this->waktu_update->setFormValue($val);
            }
            $this->waktu_update->CurrentValue = UnFormatDateTime($this->waktu_update->CurrentValue, 0);
        }

        // Check field name 'editor' first before field var 'x_editor'
        $val = $CurrentForm->hasValue("editor") ? $CurrentForm->getValue("editor") : $CurrentForm->getValue("x_editor");
        if (!$this->editor->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->editor->Visible = false; // Disable update for API request
            } else {
                $this->editor->setFormValue($val);
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

        // Check field name 'catatan' first before field var 'x_catatan'
        $val = $CurrentForm->hasValue("catatan") ? $CurrentForm->getValue("catatan") : $CurrentForm->getValue("x_catatan");
        if (!$this->catatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->catatan->Visible = false; // Disable update for API request
            } else {
                $this->catatan->setFormValue($val);
            }
        }
        $this->getUploadFiles(); // Get upload files
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->nik_ukm->CurrentValue = $this->nik_ukm->FormValue;
        $this->produk_nama->CurrentValue = $this->produk_nama->FormValue;
        $this->produk_jenis->CurrentValue = $this->produk_jenis->FormValue;
        $this->produk_desc->CurrentValue = $this->produk_desc->FormValue;
        $this->produk_harga->CurrentValue = $this->produk_harga->FormValue;
        $this->produk_berat->CurrentValue = $this->produk_berat->FormValue;
        $this->produk_legal->CurrentValue = $this->produk_legal->FormValue;
        $this->judul_sesuai->CurrentValue = $this->judul_sesuai->FormValue;
        $this->foto_bagus->CurrentValue = $this->foto_bagus->FormValue;
        $this->deskripsi_jelas->CurrentValue = $this->deskripsi_jelas->FormValue;
        $this->harga_tidak_kosong->CurrentValue = $this->harga_tidak_kosong->FormValue;
        $this->berat_tidak_kosong->CurrentValue = $this->berat_tidak_kosong->FormValue;
        $this->kurasi->CurrentValue = $this->kurasi->FormValue;
        $this->waktu_entry->CurrentValue = $this->waktu_entry->FormValue;
        $this->waktu_entry->CurrentValue = UnFormatDateTime($this->waktu_entry->CurrentValue, 0);
        $this->waktu_kurasi->CurrentValue = $this->waktu_kurasi->FormValue;
        $this->waktu_kurasi->CurrentValue = UnFormatDateTime($this->waktu_kurasi->CurrentValue, 0);
        $this->waktu_update->CurrentValue = $this->waktu_update->FormValue;
        $this->waktu_update->CurrentValue = UnFormatDateTime($this->waktu_update->CurrentValue, 0);
        $this->editor->CurrentValue = $this->editor->FormValue;
        $this->kurator->CurrentValue = $this->kurator->FormValue;
        $this->produk_panjang->CurrentValue = $this->produk_panjang->FormValue;
        $this->produk_lebar->CurrentValue = $this->produk_lebar->FormValue;
        $this->produk_tinggi->CurrentValue = $this->produk_tinggi->FormValue;
        $this->catatan->CurrentValue = $this->catatan->FormValue;
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
        $this->nik_ukm->setDbValue($row['nik_ukm']);
        $this->produk_nama->setDbValue($row['produk_nama']);
        $this->produk_jenis->setDbValue($row['produk_jenis']);
        $this->produk_desc->setDbValue($row['produk_desc']);
        $this->produk_harga->setDbValue($row['produk_harga']);
        $this->produk_foto->Upload->DbValue = $row['produk_foto'];
        $this->produk_foto->setDbValue($this->produk_foto->Upload->DbValue);
        $this->produk_berat->setDbValue($row['produk_berat']);
        $this->produk_legal->setDbValue($row['produk_legal']);
        $this->judul_sesuai->setDbValue($row['judul_sesuai']);
        $this->foto_bagus->setDbValue($row['foto_bagus']);
        $this->deskripsi_jelas->setDbValue($row['deskripsi_jelas']);
        $this->harga_tidak_kosong->setDbValue($row['harga_tidak_kosong']);
        $this->berat_tidak_kosong->setDbValue($row['berat_tidak_kosong']);
        $this->kurasi->setDbValue($row['kurasi']);
        $this->waktu_entry->setDbValue($row['waktu_entry']);
        $this->waktu_kurasi->setDbValue($row['waktu_kurasi']);
        $this->waktu_update->setDbValue($row['waktu_update']);
        $this->editor->setDbValue($row['editor']);
        $this->kurator->setDbValue($row['kurator']);
        $this->produk_panjang->setDbValue($row['produk_panjang']);
        $this->produk_lebar->setDbValue($row['produk_lebar']);
        $this->produk_tinggi->setDbValue($row['produk_tinggi']);
        $this->produk_foto_1->Upload->DbValue = $row['produk_foto_1'];
        $this->produk_foto_1->setDbValue($this->produk_foto_1->Upload->DbValue);
        $this->produk_foto_2->Upload->DbValue = $row['produk_foto_2'];
        $this->produk_foto_2->setDbValue($this->produk_foto_2->Upload->DbValue);
        $this->produk_foto_3->Upload->DbValue = $row['produk_foto_3'];
        $this->produk_foto_3->setDbValue($this->produk_foto_3->Upload->DbValue);
        $this->produk_foto_4->Upload->DbValue = $row['produk_foto_4'];
        $this->produk_foto_4->setDbValue($this->produk_foto_4->Upload->DbValue);
        $this->catatan->setDbValue($row['catatan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['nik_ukm'] = null;
        $row['produk_nama'] = null;
        $row['produk_jenis'] = null;
        $row['produk_desc'] = null;
        $row['produk_harga'] = null;
        $row['produk_foto'] = null;
        $row['produk_berat'] = null;
        $row['produk_legal'] = null;
        $row['judul_sesuai'] = null;
        $row['foto_bagus'] = null;
        $row['deskripsi_jelas'] = null;
        $row['harga_tidak_kosong'] = null;
        $row['berat_tidak_kosong'] = null;
        $row['kurasi'] = null;
        $row['waktu_entry'] = null;
        $row['waktu_kurasi'] = null;
        $row['waktu_update'] = null;
        $row['editor'] = null;
        $row['kurator'] = null;
        $row['produk_panjang'] = null;
        $row['produk_lebar'] = null;
        $row['produk_tinggi'] = null;
        $row['produk_foto_1'] = null;
        $row['produk_foto_2'] = null;
        $row['produk_foto_3'] = null;
        $row['produk_foto_4'] = null;
        $row['catatan'] = null;
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

        // nik_ukm

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // produk_foto

        // produk_berat

        // produk_legal

        // judul_sesuai

        // foto_bagus

        // deskripsi_jelas

        // harga_tidak_kosong

        // berat_tidak_kosong

        // kurasi

        // waktu_entry

        // waktu_kurasi

        // waktu_update

        // editor

        // kurator

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // produk_foto_4

        // catatan
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // nik_ukm
            $this->nik_ukm->ViewValue = $this->nik_ukm->CurrentValue;
            $this->nik_ukm->ViewCustomAttributes = "";

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

            // produk_foto
            if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
                $this->produk_foto->ImageWidth = 200;
                $this->produk_foto->ImageHeight = 200;
                $this->produk_foto->ImageAlt = $this->produk_foto->alt();
                $this->produk_foto->ViewValue = $this->produk_foto->Upload->DbValue;
            } else {
                $this->produk_foto->ViewValue = "";
            }
            $this->produk_foto->ViewCustomAttributes = "";

            // produk_berat
            $this->produk_berat->ViewValue = $this->produk_berat->CurrentValue;
            $this->produk_berat->ViewValue = FormatNumber($this->produk_berat->ViewValue, 2, -2, -2, -2);
            $this->produk_berat->ViewCustomAttributes = "";

            // produk_legal
            $this->produk_legal->ViewValue = $this->produk_legal->CurrentValue;
            $this->produk_legal->ViewValue = FormatNumber($this->produk_legal->ViewValue, 0, -2, -2, -2);
            $this->produk_legal->ViewCustomAttributes = "";

            // judul_sesuai
            $this->judul_sesuai->ViewValue = $this->judul_sesuai->CurrentValue;
            $this->judul_sesuai->ViewValue = FormatNumber($this->judul_sesuai->ViewValue, 0, -2, -2, -2);
            $this->judul_sesuai->ViewCustomAttributes = "";

            // foto_bagus
            $this->foto_bagus->ViewValue = $this->foto_bagus->CurrentValue;
            $this->foto_bagus->ViewValue = FormatNumber($this->foto_bagus->ViewValue, 0, -2, -2, -2);
            $this->foto_bagus->ViewCustomAttributes = "";

            // deskripsi_jelas
            $this->deskripsi_jelas->ViewValue = $this->deskripsi_jelas->CurrentValue;
            $this->deskripsi_jelas->ViewValue = FormatNumber($this->deskripsi_jelas->ViewValue, 0, -2, -2, -2);
            $this->deskripsi_jelas->ViewCustomAttributes = "";

            // harga_tidak_kosong
            $this->harga_tidak_kosong->ViewValue = $this->harga_tidak_kosong->CurrentValue;
            $this->harga_tidak_kosong->ViewValue = FormatNumber($this->harga_tidak_kosong->ViewValue, 0, -2, -2, -2);
            $this->harga_tidak_kosong->ViewCustomAttributes = "";

            // berat_tidak_kosong
            $this->berat_tidak_kosong->ViewValue = $this->berat_tidak_kosong->CurrentValue;
            $this->berat_tidak_kosong->ViewValue = FormatNumber($this->berat_tidak_kosong->ViewValue, 0, -2, -2, -2);
            $this->berat_tidak_kosong->ViewCustomAttributes = "";

            // kurasi
            $this->kurasi->ViewValue = $this->kurasi->CurrentValue;
            $this->kurasi->ViewCustomAttributes = "";

            // waktu_entry
            $this->waktu_entry->ViewValue = $this->waktu_entry->CurrentValue;
            $this->waktu_entry->ViewValue = FormatDateTime($this->waktu_entry->ViewValue, 0);
            $this->waktu_entry->ViewCustomAttributes = "";

            // waktu_kurasi
            $this->waktu_kurasi->ViewValue = $this->waktu_kurasi->CurrentValue;
            $this->waktu_kurasi->ViewValue = FormatDateTime($this->waktu_kurasi->ViewValue, 0);
            $this->waktu_kurasi->ViewCustomAttributes = "";

            // waktu_update
            $this->waktu_update->ViewValue = $this->waktu_update->CurrentValue;
            $this->waktu_update->ViewValue = FormatDateTime($this->waktu_update->ViewValue, 0);
            $this->waktu_update->ViewCustomAttributes = "";

            // editor
            $this->editor->ViewValue = $this->editor->CurrentValue;
            $this->editor->ViewCustomAttributes = "";

            // kurator
            $this->kurator->ViewValue = $this->kurator->CurrentValue;
            $this->kurator->ViewCustomAttributes = "";

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

            // produk_foto_1
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->ImageWidth = 200;
                $this->produk_foto_1->ImageHeight = 200;
                $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
                $this->produk_foto_1->ViewValue = $this->produk_foto_1->Upload->DbValue;
            } else {
                $this->produk_foto_1->ViewValue = "";
            }
            $this->produk_foto_1->ViewCustomAttributes = "";

            // produk_foto_2
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->ImageWidth = 200;
                $this->produk_foto_2->ImageHeight = 200;
                $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
                $this->produk_foto_2->ViewValue = $this->produk_foto_2->Upload->DbValue;
            } else {
                $this->produk_foto_2->ViewValue = "";
            }
            $this->produk_foto_2->ViewCustomAttributes = "";

            // produk_foto_3
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->ImageWidth = 200;
                $this->produk_foto_3->ImageHeight = 200;
                $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
                $this->produk_foto_3->ViewValue = $this->produk_foto_3->Upload->DbValue;
            } else {
                $this->produk_foto_3->ViewValue = "";
            }
            $this->produk_foto_3->ViewCustomAttributes = "";

            // catatan
            $this->catatan->ViewValue = $this->catatan->CurrentValue;
            $this->catatan->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // nik_ukm
            $this->nik_ukm->LinkCustomAttributes = "";
            $this->nik_ukm->HrefValue = "";
            $this->nik_ukm->TooltipValue = "";

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

            // produk_foto
            $this->produk_foto->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
                $this->produk_foto->HrefValue = GetFileUploadUrl($this->produk_foto, $this->produk_foto->htmlDecode($this->produk_foto->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto->HrefValue = FullUrl($this->produk_foto->HrefValue, "href");
                }
            } else {
                $this->produk_foto->HrefValue = "";
            }
            $this->produk_foto->ExportHrefValue = $this->produk_foto->UploadPath . $this->produk_foto->Upload->DbValue;
            $this->produk_foto->TooltipValue = "";
            if ($this->produk_foto->UseColorbox) {
                if (EmptyValue($this->produk_foto->TooltipValue)) {
                    $this->produk_foto->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto";
                $this->produk_foto->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_berat
            $this->produk_berat->LinkCustomAttributes = "";
            $this->produk_berat->HrefValue = "";
            $this->produk_berat->TooltipValue = "";

            // produk_legal
            $this->produk_legal->LinkCustomAttributes = "";
            $this->produk_legal->HrefValue = "";
            $this->produk_legal->TooltipValue = "";

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

            // kurasi
            $this->kurasi->LinkCustomAttributes = "";
            $this->kurasi->HrefValue = "";
            $this->kurasi->TooltipValue = "";

            // waktu_entry
            $this->waktu_entry->LinkCustomAttributes = "";
            $this->waktu_entry->HrefValue = "";
            $this->waktu_entry->TooltipValue = "";

            // waktu_kurasi
            $this->waktu_kurasi->LinkCustomAttributes = "";
            $this->waktu_kurasi->HrefValue = "";
            $this->waktu_kurasi->TooltipValue = "";

            // waktu_update
            $this->waktu_update->LinkCustomAttributes = "";
            $this->waktu_update->HrefValue = "";
            $this->waktu_update->TooltipValue = "";

            // editor
            $this->editor->LinkCustomAttributes = "";
            $this->editor->HrefValue = "";
            $this->editor->TooltipValue = "";

            // kurator
            $this->kurator->LinkCustomAttributes = "";
            $this->kurator->HrefValue = "";
            $this->kurator->TooltipValue = "";

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
                $this->produk_foto_1->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_1";
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
                $this->produk_foto_2->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_2";
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
                $this->produk_foto_3->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_3";
                $this->produk_foto_3->LinkAttrs->appendClass("ew-lightbox");
            }

            // catatan
            $this->catatan->LinkCustomAttributes = "";
            $this->catatan->HrefValue = "";
            $this->catatan->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // nik_ukm
            $this->nik_ukm->EditAttrs["class"] = "form-control";
            $this->nik_ukm->EditCustomAttributes = "";
            if (!$this->nik_ukm->Raw) {
                $this->nik_ukm->CurrentValue = HtmlDecode($this->nik_ukm->CurrentValue);
            }
            $this->nik_ukm->EditValue = HtmlEncode($this->nik_ukm->CurrentValue);
            $this->nik_ukm->PlaceHolder = RemoveHtml($this->nik_ukm->caption());

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

            // produk_foto
            $this->produk_foto->EditAttrs["class"] = "form-control";
            $this->produk_foto->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
                $this->produk_foto->ImageWidth = 200;
                $this->produk_foto->ImageHeight = 200;
                $this->produk_foto->ImageAlt = $this->produk_foto->alt();
                $this->produk_foto->EditValue = $this->produk_foto->Upload->DbValue;
            } else {
                $this->produk_foto->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto->CurrentValue)) {
                $this->produk_foto->Upload->FileName = $this->produk_foto->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->produk_foto);
            }

            // produk_berat
            $this->produk_berat->EditAttrs["class"] = "form-control";
            $this->produk_berat->EditCustomAttributes = "";
            $this->produk_berat->EditValue = HtmlEncode($this->produk_berat->CurrentValue);
            $this->produk_berat->PlaceHolder = RemoveHtml($this->produk_berat->caption());
            if (strval($this->produk_berat->EditValue) != "" && is_numeric($this->produk_berat->EditValue)) {
                $this->produk_berat->EditValue = FormatNumber($this->produk_berat->EditValue, -2, -2, -2, -2);
            }

            // produk_legal
            $this->produk_legal->EditAttrs["class"] = "form-control";
            $this->produk_legal->EditCustomAttributes = "";
            $this->produk_legal->EditValue = HtmlEncode($this->produk_legal->CurrentValue);
            $this->produk_legal->PlaceHolder = RemoveHtml($this->produk_legal->caption());

            // judul_sesuai
            $this->judul_sesuai->EditAttrs["class"] = "form-control";
            $this->judul_sesuai->EditCustomAttributes = "";
            $this->judul_sesuai->EditValue = HtmlEncode($this->judul_sesuai->CurrentValue);
            $this->judul_sesuai->PlaceHolder = RemoveHtml($this->judul_sesuai->caption());

            // foto_bagus
            $this->foto_bagus->EditAttrs["class"] = "form-control";
            $this->foto_bagus->EditCustomAttributes = "";
            $this->foto_bagus->EditValue = HtmlEncode($this->foto_bagus->CurrentValue);
            $this->foto_bagus->PlaceHolder = RemoveHtml($this->foto_bagus->caption());

            // deskripsi_jelas
            $this->deskripsi_jelas->EditAttrs["class"] = "form-control";
            $this->deskripsi_jelas->EditCustomAttributes = "";
            $this->deskripsi_jelas->EditValue = HtmlEncode($this->deskripsi_jelas->CurrentValue);
            $this->deskripsi_jelas->PlaceHolder = RemoveHtml($this->deskripsi_jelas->caption());

            // harga_tidak_kosong
            $this->harga_tidak_kosong->EditAttrs["class"] = "form-control";
            $this->harga_tidak_kosong->EditCustomAttributes = "";
            $this->harga_tidak_kosong->EditValue = HtmlEncode($this->harga_tidak_kosong->CurrentValue);
            $this->harga_tidak_kosong->PlaceHolder = RemoveHtml($this->harga_tidak_kosong->caption());

            // berat_tidak_kosong
            $this->berat_tidak_kosong->EditAttrs["class"] = "form-control";
            $this->berat_tidak_kosong->EditCustomAttributes = "";
            $this->berat_tidak_kosong->EditValue = HtmlEncode($this->berat_tidak_kosong->CurrentValue);
            $this->berat_tidak_kosong->PlaceHolder = RemoveHtml($this->berat_tidak_kosong->caption());

            // kurasi
            $this->kurasi->EditAttrs["class"] = "form-control";
            $this->kurasi->EditCustomAttributes = "";
            if (!$this->kurasi->Raw) {
                $this->kurasi->CurrentValue = HtmlDecode($this->kurasi->CurrentValue);
            }
            $this->kurasi->EditValue = HtmlEncode($this->kurasi->CurrentValue);
            $this->kurasi->PlaceHolder = RemoveHtml($this->kurasi->caption());

            // waktu_entry
            $this->waktu_entry->EditAttrs["class"] = "form-control";
            $this->waktu_entry->EditCustomAttributes = "";
            $this->waktu_entry->EditValue = HtmlEncode(FormatDateTime($this->waktu_entry->CurrentValue, 8));
            $this->waktu_entry->PlaceHolder = RemoveHtml($this->waktu_entry->caption());

            // waktu_kurasi
            $this->waktu_kurasi->EditAttrs["class"] = "form-control";
            $this->waktu_kurasi->EditCustomAttributes = "";
            $this->waktu_kurasi->EditValue = HtmlEncode(FormatDateTime($this->waktu_kurasi->CurrentValue, 8));
            $this->waktu_kurasi->PlaceHolder = RemoveHtml($this->waktu_kurasi->caption());

            // waktu_update
            $this->waktu_update->EditAttrs["class"] = "form-control";
            $this->waktu_update->EditCustomAttributes = "";
            $this->waktu_update->EditValue = HtmlEncode(FormatDateTime($this->waktu_update->CurrentValue, 8));
            $this->waktu_update->PlaceHolder = RemoveHtml($this->waktu_update->caption());

            // editor
            $this->editor->EditAttrs["class"] = "form-control";
            $this->editor->EditCustomAttributes = "";
            if (!$this->editor->Raw) {
                $this->editor->CurrentValue = HtmlDecode($this->editor->CurrentValue);
            }
            $this->editor->EditValue = HtmlEncode($this->editor->CurrentValue);
            $this->editor->PlaceHolder = RemoveHtml($this->editor->caption());

            // kurator
            $this->kurator->EditAttrs["class"] = "form-control";
            $this->kurator->EditCustomAttributes = "";
            if (!$this->kurator->Raw) {
                $this->kurator->CurrentValue = HtmlDecode($this->kurator->CurrentValue);
            }
            $this->kurator->EditValue = HtmlEncode($this->kurator->CurrentValue);
            $this->kurator->PlaceHolder = RemoveHtml($this->kurator->caption());

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

            // produk_foto_1
            $this->produk_foto_1->EditAttrs["class"] = "form-control";
            $this->produk_foto_1->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->ImageWidth = 200;
                $this->produk_foto_1->ImageHeight = 200;
                $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
                $this->produk_foto_1->EditValue = $this->produk_foto_1->Upload->DbValue;
            } else {
                $this->produk_foto_1->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_1->CurrentValue)) {
                $this->produk_foto_1->Upload->FileName = $this->produk_foto_1->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->produk_foto_1);
            }

            // produk_foto_2
            $this->produk_foto_2->EditAttrs["class"] = "form-control";
            $this->produk_foto_2->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->ImageWidth = 200;
                $this->produk_foto_2->ImageHeight = 200;
                $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
                $this->produk_foto_2->EditValue = $this->produk_foto_2->Upload->DbValue;
            } else {
                $this->produk_foto_2->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_2->CurrentValue)) {
                $this->produk_foto_2->Upload->FileName = $this->produk_foto_2->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->produk_foto_2);
            }

            // produk_foto_3
            $this->produk_foto_3->EditAttrs["class"] = "form-control";
            $this->produk_foto_3->EditCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->ImageWidth = 200;
                $this->produk_foto_3->ImageHeight = 200;
                $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
                $this->produk_foto_3->EditValue = $this->produk_foto_3->Upload->DbValue;
            } else {
                $this->produk_foto_3->EditValue = "";
            }
            if (!EmptyValue($this->produk_foto_3->CurrentValue)) {
                $this->produk_foto_3->Upload->FileName = $this->produk_foto_3->CurrentValue;
            }
            if ($this->isShow()) {
                RenderUploadField($this->produk_foto_3);
            }

            // catatan
            $this->catatan->EditAttrs["class"] = "form-control";
            $this->catatan->EditCustomAttributes = "";
            $this->catatan->EditValue = HtmlEncode($this->catatan->CurrentValue);
            $this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // nik_ukm
            $this->nik_ukm->LinkCustomAttributes = "";
            $this->nik_ukm->HrefValue = "";

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

            // produk_foto
            $this->produk_foto->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
                $this->produk_foto->HrefValue = GetFileUploadUrl($this->produk_foto, $this->produk_foto->htmlDecode($this->produk_foto->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto->HrefValue = FullUrl($this->produk_foto->HrefValue, "href");
                }
            } else {
                $this->produk_foto->HrefValue = "";
            }
            $this->produk_foto->ExportHrefValue = $this->produk_foto->UploadPath . $this->produk_foto->Upload->DbValue;

            // produk_berat
            $this->produk_berat->LinkCustomAttributes = "";
            $this->produk_berat->HrefValue = "";

            // produk_legal
            $this->produk_legal->LinkCustomAttributes = "";
            $this->produk_legal->HrefValue = "";

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

            // kurasi
            $this->kurasi->LinkCustomAttributes = "";
            $this->kurasi->HrefValue = "";

            // waktu_entry
            $this->waktu_entry->LinkCustomAttributes = "";
            $this->waktu_entry->HrefValue = "";

            // waktu_kurasi
            $this->waktu_kurasi->LinkCustomAttributes = "";
            $this->waktu_kurasi->HrefValue = "";

            // waktu_update
            $this->waktu_update->LinkCustomAttributes = "";
            $this->waktu_update->HrefValue = "";

            // editor
            $this->editor->LinkCustomAttributes = "";
            $this->editor->HrefValue = "";

            // kurator
            $this->kurator->LinkCustomAttributes = "";
            $this->kurator->HrefValue = "";

            // produk_panjang
            $this->produk_panjang->LinkCustomAttributes = "";
            $this->produk_panjang->HrefValue = "";

            // produk_lebar
            $this->produk_lebar->LinkCustomAttributes = "";
            $this->produk_lebar->HrefValue = "";

            // produk_tinggi
            $this->produk_tinggi->LinkCustomAttributes = "";
            $this->produk_tinggi->HrefValue = "";

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

            // catatan
            $this->catatan->LinkCustomAttributes = "";
            $this->catatan->HrefValue = "";
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
        if ($this->nik_ukm->Required) {
            if (!$this->nik_ukm->IsDetailKey && EmptyValue($this->nik_ukm->FormValue)) {
                $this->nik_ukm->addErrorMessage(str_replace("%s", $this->nik_ukm->caption(), $this->nik_ukm->RequiredErrorMessage));
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
        if ($this->produk_foto->Required) {
            if ($this->produk_foto->Upload->FileName == "" && !$this->produk_foto->Upload->KeepFile) {
                $this->produk_foto->addErrorMessage(str_replace("%s", $this->produk_foto->caption(), $this->produk_foto->RequiredErrorMessage));
            }
        }
        if ($this->produk_berat->Required) {
            if (!$this->produk_berat->IsDetailKey && EmptyValue($this->produk_berat->FormValue)) {
                $this->produk_berat->addErrorMessage(str_replace("%s", $this->produk_berat->caption(), $this->produk_berat->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->produk_berat->FormValue)) {
            $this->produk_berat->addErrorMessage($this->produk_berat->getErrorMessage(false));
        }
        if ($this->produk_legal->Required) {
            if (!$this->produk_legal->IsDetailKey && EmptyValue($this->produk_legal->FormValue)) {
                $this->produk_legal->addErrorMessage(str_replace("%s", $this->produk_legal->caption(), $this->produk_legal->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->produk_legal->FormValue)) {
            $this->produk_legal->addErrorMessage($this->produk_legal->getErrorMessage(false));
        }
        if ($this->judul_sesuai->Required) {
            if (!$this->judul_sesuai->IsDetailKey && EmptyValue($this->judul_sesuai->FormValue)) {
                $this->judul_sesuai->addErrorMessage(str_replace("%s", $this->judul_sesuai->caption(), $this->judul_sesuai->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->judul_sesuai->FormValue)) {
            $this->judul_sesuai->addErrorMessage($this->judul_sesuai->getErrorMessage(false));
        }
        if ($this->foto_bagus->Required) {
            if (!$this->foto_bagus->IsDetailKey && EmptyValue($this->foto_bagus->FormValue)) {
                $this->foto_bagus->addErrorMessage(str_replace("%s", $this->foto_bagus->caption(), $this->foto_bagus->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->foto_bagus->FormValue)) {
            $this->foto_bagus->addErrorMessage($this->foto_bagus->getErrorMessage(false));
        }
        if ($this->deskripsi_jelas->Required) {
            if (!$this->deskripsi_jelas->IsDetailKey && EmptyValue($this->deskripsi_jelas->FormValue)) {
                $this->deskripsi_jelas->addErrorMessage(str_replace("%s", $this->deskripsi_jelas->caption(), $this->deskripsi_jelas->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->deskripsi_jelas->FormValue)) {
            $this->deskripsi_jelas->addErrorMessage($this->deskripsi_jelas->getErrorMessage(false));
        }
        if ($this->harga_tidak_kosong->Required) {
            if (!$this->harga_tidak_kosong->IsDetailKey && EmptyValue($this->harga_tidak_kosong->FormValue)) {
                $this->harga_tidak_kosong->addErrorMessage(str_replace("%s", $this->harga_tidak_kosong->caption(), $this->harga_tidak_kosong->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->harga_tidak_kosong->FormValue)) {
            $this->harga_tidak_kosong->addErrorMessage($this->harga_tidak_kosong->getErrorMessage(false));
        }
        if ($this->berat_tidak_kosong->Required) {
            if (!$this->berat_tidak_kosong->IsDetailKey && EmptyValue($this->berat_tidak_kosong->FormValue)) {
                $this->berat_tidak_kosong->addErrorMessage(str_replace("%s", $this->berat_tidak_kosong->caption(), $this->berat_tidak_kosong->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->berat_tidak_kosong->FormValue)) {
            $this->berat_tidak_kosong->addErrorMessage($this->berat_tidak_kosong->getErrorMessage(false));
        }
        if ($this->kurasi->Required) {
            if (!$this->kurasi->IsDetailKey && EmptyValue($this->kurasi->FormValue)) {
                $this->kurasi->addErrorMessage(str_replace("%s", $this->kurasi->caption(), $this->kurasi->RequiredErrorMessage));
            }
        }
        if ($this->waktu_entry->Required) {
            if (!$this->waktu_entry->IsDetailKey && EmptyValue($this->waktu_entry->FormValue)) {
                $this->waktu_entry->addErrorMessage(str_replace("%s", $this->waktu_entry->caption(), $this->waktu_entry->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->waktu_entry->FormValue)) {
            $this->waktu_entry->addErrorMessage($this->waktu_entry->getErrorMessage(false));
        }
        if ($this->waktu_kurasi->Required) {
            if (!$this->waktu_kurasi->IsDetailKey && EmptyValue($this->waktu_kurasi->FormValue)) {
                $this->waktu_kurasi->addErrorMessage(str_replace("%s", $this->waktu_kurasi->caption(), $this->waktu_kurasi->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->waktu_kurasi->FormValue)) {
            $this->waktu_kurasi->addErrorMessage($this->waktu_kurasi->getErrorMessage(false));
        }
        if ($this->waktu_update->Required) {
            if (!$this->waktu_update->IsDetailKey && EmptyValue($this->waktu_update->FormValue)) {
                $this->waktu_update->addErrorMessage(str_replace("%s", $this->waktu_update->caption(), $this->waktu_update->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->waktu_update->FormValue)) {
            $this->waktu_update->addErrorMessage($this->waktu_update->getErrorMessage(false));
        }
        if ($this->editor->Required) {
            if (!$this->editor->IsDetailKey && EmptyValue($this->editor->FormValue)) {
                $this->editor->addErrorMessage(str_replace("%s", $this->editor->caption(), $this->editor->RequiredErrorMessage));
            }
        }
        if ($this->kurator->Required) {
            if (!$this->kurator->IsDetailKey && EmptyValue($this->kurator->FormValue)) {
                $this->kurator->addErrorMessage(str_replace("%s", $this->kurator->caption(), $this->kurator->RequiredErrorMessage));
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
        if ($this->catatan->Required) {
            if (!$this->catatan->IsDetailKey && EmptyValue($this->catatan->FormValue)) {
                $this->catatan->addErrorMessage(str_replace("%s", $this->catatan->caption(), $this->catatan->RequiredErrorMessage));
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

            // nik_ukm
            $this->nik_ukm->setDbValueDef($rsnew, $this->nik_ukm->CurrentValue, null, $this->nik_ukm->ReadOnly);

            // produk_nama
            $this->produk_nama->setDbValueDef($rsnew, $this->produk_nama->CurrentValue, null, $this->produk_nama->ReadOnly);

            // produk_jenis
            $this->produk_jenis->setDbValueDef($rsnew, $this->produk_jenis->CurrentValue, null, $this->produk_jenis->ReadOnly);

            // produk_desc
            $this->produk_desc->setDbValueDef($rsnew, $this->produk_desc->CurrentValue, null, $this->produk_desc->ReadOnly);

            // produk_harga
            $this->produk_harga->setDbValueDef($rsnew, $this->produk_harga->CurrentValue, null, $this->produk_harga->ReadOnly);

            // produk_foto
            if ($this->produk_foto->Visible && !$this->produk_foto->ReadOnly && !$this->produk_foto->Upload->KeepFile) {
                $this->produk_foto->Upload->DbValue = $rsold['produk_foto']; // Get original value
                if ($this->produk_foto->Upload->FileName == "") {
                    $rsnew['produk_foto'] = null;
                } else {
                    $rsnew['produk_foto'] = $this->produk_foto->Upload->FileName;
                }
            }

            // produk_berat
            $this->produk_berat->setDbValueDef($rsnew, $this->produk_berat->CurrentValue, 0, $this->produk_berat->ReadOnly);

            // produk_legal
            $this->produk_legal->setDbValueDef($rsnew, $this->produk_legal->CurrentValue, null, $this->produk_legal->ReadOnly);

            // judul_sesuai
            $this->judul_sesuai->setDbValueDef($rsnew, $this->judul_sesuai->CurrentValue, null, $this->judul_sesuai->ReadOnly);

            // foto_bagus
            $this->foto_bagus->setDbValueDef($rsnew, $this->foto_bagus->CurrentValue, null, $this->foto_bagus->ReadOnly);

            // deskripsi_jelas
            $this->deskripsi_jelas->setDbValueDef($rsnew, $this->deskripsi_jelas->CurrentValue, null, $this->deskripsi_jelas->ReadOnly);

            // harga_tidak_kosong
            $this->harga_tidak_kosong->setDbValueDef($rsnew, $this->harga_tidak_kosong->CurrentValue, null, $this->harga_tidak_kosong->ReadOnly);

            // berat_tidak_kosong
            $this->berat_tidak_kosong->setDbValueDef($rsnew, $this->berat_tidak_kosong->CurrentValue, null, $this->berat_tidak_kosong->ReadOnly);

            // kurasi
            $this->kurasi->setDbValueDef($rsnew, $this->kurasi->CurrentValue, null, $this->kurasi->ReadOnly);

            // waktu_entry
            $this->waktu_entry->setDbValueDef($rsnew, UnFormatDateTime($this->waktu_entry->CurrentValue, 0), null, $this->waktu_entry->ReadOnly);

            // waktu_kurasi
            $this->waktu_kurasi->setDbValueDef($rsnew, UnFormatDateTime($this->waktu_kurasi->CurrentValue, 0), null, $this->waktu_kurasi->ReadOnly);

            // waktu_update
            $this->waktu_update->setDbValueDef($rsnew, UnFormatDateTime($this->waktu_update->CurrentValue, 0), null, $this->waktu_update->ReadOnly);

            // editor
            $this->editor->setDbValueDef($rsnew, $this->editor->CurrentValue, null, $this->editor->ReadOnly);

            // kurator
            $this->kurator->setDbValueDef($rsnew, $this->kurator->CurrentValue, null, $this->kurator->ReadOnly);

            // produk_panjang
            $this->produk_panjang->setDbValueDef($rsnew, $this->produk_panjang->CurrentValue, 0, $this->produk_panjang->ReadOnly);

            // produk_lebar
            $this->produk_lebar->setDbValueDef($rsnew, $this->produk_lebar->CurrentValue, 0, $this->produk_lebar->ReadOnly);

            // produk_tinggi
            $this->produk_tinggi->setDbValueDef($rsnew, $this->produk_tinggi->CurrentValue, 0, $this->produk_tinggi->ReadOnly);

            // produk_foto_1
            if ($this->produk_foto_1->Visible && !$this->produk_foto_1->ReadOnly && !$this->produk_foto_1->Upload->KeepFile) {
                $this->produk_foto_1->Upload->DbValue = $rsold['produk_foto_1']; // Get original value
                if ($this->produk_foto_1->Upload->FileName == "") {
                    $rsnew['produk_foto_1'] = null;
                } else {
                    $rsnew['produk_foto_1'] = $this->produk_foto_1->Upload->FileName;
                }
            }

            // produk_foto_2
            if ($this->produk_foto_2->Visible && !$this->produk_foto_2->ReadOnly && !$this->produk_foto_2->Upload->KeepFile) {
                $this->produk_foto_2->Upload->DbValue = $rsold['produk_foto_2']; // Get original value
                if ($this->produk_foto_2->Upload->FileName == "") {
                    $rsnew['produk_foto_2'] = null;
                } else {
                    $rsnew['produk_foto_2'] = $this->produk_foto_2->Upload->FileName;
                }
            }

            // produk_foto_3
            if ($this->produk_foto_3->Visible && !$this->produk_foto_3->ReadOnly && !$this->produk_foto_3->Upload->KeepFile) {
                $this->produk_foto_3->Upload->DbValue = $rsold['produk_foto_3']; // Get original value
                if ($this->produk_foto_3->Upload->FileName == "") {
                    $rsnew['produk_foto_3'] = null;
                } else {
                    $rsnew['produk_foto_3'] = $this->produk_foto_3->Upload->FileName;
                }
            }

            // catatan
            $this->catatan->setDbValueDef($rsnew, $this->catatan->CurrentValue, null, $this->catatan->ReadOnly);
            if ($this->produk_foto->Visible && !$this->produk_foto->Upload->KeepFile) {
                $oldFiles = EmptyValue($this->produk_foto->Upload->DbValue) ? [] : [$this->produk_foto->htmlDecode($this->produk_foto->Upload->DbValue)];
                if (!EmptyValue($this->produk_foto->Upload->FileName)) {
                    $newFiles = [$this->produk_foto->Upload->FileName];
                    $NewFileCount = count($newFiles);
                    for ($i = 0; $i < $NewFileCount; $i++) {
                        if ($newFiles[$i] != "") {
                            $file = $newFiles[$i];
                            $tempPath = UploadTempPath($this->produk_foto, $this->produk_foto->Upload->Index);
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
                                $file1 = UniqueFilename($this->produk_foto->physicalUploadPath(), $file); // Get new file name
                                if ($file1 != $file) { // Rename temp file
                                    while (file_exists($tempPath . $file1) || file_exists($this->produk_foto->physicalUploadPath() . $file1)) { // Make sure no file name clash
                                        $file1 = UniqueFilename([$this->produk_foto->physicalUploadPath(), $tempPath], $file1, true); // Use indexed name
                                    }
                                    rename($tempPath . $file, $tempPath . $file1);
                                    $newFiles[$i] = $file1;
                                }
                            }
                        }
                    }
                    $this->produk_foto->Upload->DbValue = empty($oldFiles) ? "" : implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $oldFiles);
                    $this->produk_foto->Upload->FileName = implode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $newFiles);
                    $this->produk_foto->setDbValueDef($rsnew, $this->produk_foto->Upload->FileName, null, $this->produk_foto->ReadOnly);
                }
            }
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
                    $this->produk_foto_1->setDbValueDef($rsnew, $this->produk_foto_1->Upload->FileName, null, $this->produk_foto_1->ReadOnly);
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
                    $this->produk_foto_2->setDbValueDef($rsnew, $this->produk_foto_2->Upload->FileName, null, $this->produk_foto_2->ReadOnly);
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
                    $this->produk_foto_3->setDbValueDef($rsnew, $this->produk_foto_3->Upload->FileName, null, $this->produk_foto_3->ReadOnly);
                }
            }

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
                    if ($this->produk_foto->Visible && !$this->produk_foto->Upload->KeepFile) {
                        $oldFiles = EmptyValue($this->produk_foto->Upload->DbValue) ? [] : [$this->produk_foto->htmlDecode($this->produk_foto->Upload->DbValue)];
                        if (!EmptyValue($this->produk_foto->Upload->FileName)) {
                            $newFiles = [$this->produk_foto->Upload->FileName];
                            $newFiles2 = [$this->produk_foto->htmlDecode($rsnew['produk_foto'])];
                            $newFileCount = count($newFiles);
                            for ($i = 0; $i < $newFileCount; $i++) {
                                if ($newFiles[$i] != "") {
                                    $file = UploadTempPath($this->produk_foto, $this->produk_foto->Upload->Index) . $newFiles[$i];
                                    if (file_exists($file)) {
                                        if (@$newFiles2[$i] != "") { // Use correct file name
                                            $newFiles[$i] = $newFiles2[$i];
                                        }
                                        if (!$this->produk_foto->Upload->SaveToFile($newFiles[$i], true, $i)) { // Just replace
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
                                    @unlink($this->produk_foto->oldPhysicalUploadPath() . $oldFile);
                                }
                            }
                        }
                    }
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
            // produk_foto
            CleanUploadTempPath($this->produk_foto, $this->produk_foto->Upload->Index);

            // produk_foto_1
            CleanUploadTempPath($this->produk_foto_1, $this->produk_foto_1->Upload->Index);

            // produk_foto_2
            CleanUploadTempPath($this->produk_foto_2, $this->produk_foto_2->Upload->Index);

            // produk_foto_3
            CleanUploadTempPath($this->produk_foto_3, $this->produk_foto_3->Upload->Index);
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("phpkurasiperbaikanlist"), "", $this->TableVar, true);
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
