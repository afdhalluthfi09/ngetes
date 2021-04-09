<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class BinaDataEdit extends BinaData
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'bina_data';

    // Page object name
    public $PageObjName = "BinaDataEdit";

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

        // Table object (bina_data)
        if (!isset($GLOBALS["bina_data"]) || get_class($GLOBALS["bina_data"]) == PROJECT_NAMESPACE . "bina_data") {
            $GLOBALS["bina_data"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'bina_data');
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
                $doc = new $class(Container("bina_data"));
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
                    if ($pageName == "binadataview") {
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
        $this->idperiode->setVisibility();
        $this->idkelompok->setVisibility();
        $this->namakegiatan->setVisibility();
        $this->uraian->setVisibility();
        $this->tglmulai->setVisibility();
        $this->tglakhir->setVisibility();
        $this->narasumber->setVisibility();
        $this->kontak_nama->setVisibility();
        $this->kontak_hp->setVisibility();
        $this->poster->setVisibility();
        $this->postertipe->setVisibility();
        $this->posterukuran->setVisibility();
        $this->posterlebar->setVisibility();
        $this->postertinggi->setVisibility();
        $this->linkinfo->setVisibility();
        $this->peserta_kelas->setVisibility();
        $this->waktu->setVisibility();
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
                    $this->terminate("binadatalist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "binadatalist") {
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

        // Check field name 'idperiode' first before field var 'x_idperiode'
        $val = $CurrentForm->hasValue("idperiode") ? $CurrentForm->getValue("idperiode") : $CurrentForm->getValue("x_idperiode");
        if (!$this->idperiode->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->idperiode->Visible = false; // Disable update for API request
            } else {
                $this->idperiode->setFormValue($val);
            }
        }

        // Check field name 'idkelompok' first before field var 'x_idkelompok'
        $val = $CurrentForm->hasValue("idkelompok") ? $CurrentForm->getValue("idkelompok") : $CurrentForm->getValue("x_idkelompok");
        if (!$this->idkelompok->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->idkelompok->Visible = false; // Disable update for API request
            } else {
                $this->idkelompok->setFormValue($val);
            }
        }

        // Check field name 'namakegiatan' first before field var 'x_namakegiatan'
        $val = $CurrentForm->hasValue("namakegiatan") ? $CurrentForm->getValue("namakegiatan") : $CurrentForm->getValue("x_namakegiatan");
        if (!$this->namakegiatan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->namakegiatan->Visible = false; // Disable update for API request
            } else {
                $this->namakegiatan->setFormValue($val);
            }
        }

        // Check field name 'uraian' first before field var 'x_uraian'
        $val = $CurrentForm->hasValue("uraian") ? $CurrentForm->getValue("uraian") : $CurrentForm->getValue("x_uraian");
        if (!$this->uraian->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->uraian->Visible = false; // Disable update for API request
            } else {
                $this->uraian->setFormValue($val);
            }
        }

        // Check field name 'tglmulai' first before field var 'x_tglmulai'
        $val = $CurrentForm->hasValue("tglmulai") ? $CurrentForm->getValue("tglmulai") : $CurrentForm->getValue("x_tglmulai");
        if (!$this->tglmulai->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tglmulai->Visible = false; // Disable update for API request
            } else {
                $this->tglmulai->setFormValue($val);
            }
            $this->tglmulai->CurrentValue = UnFormatDateTime($this->tglmulai->CurrentValue, 0);
        }

        // Check field name 'tglakhir' first before field var 'x_tglakhir'
        $val = $CurrentForm->hasValue("tglakhir") ? $CurrentForm->getValue("tglakhir") : $CurrentForm->getValue("x_tglakhir");
        if (!$this->tglakhir->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->tglakhir->Visible = false; // Disable update for API request
            } else {
                $this->tglakhir->setFormValue($val);
            }
            $this->tglakhir->CurrentValue = UnFormatDateTime($this->tglakhir->CurrentValue, 0);
        }

        // Check field name 'narasumber' first before field var 'x_narasumber'
        $val = $CurrentForm->hasValue("narasumber") ? $CurrentForm->getValue("narasumber") : $CurrentForm->getValue("x_narasumber");
        if (!$this->narasumber->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->narasumber->Visible = false; // Disable update for API request
            } else {
                $this->narasumber->setFormValue($val);
            }
        }

        // Check field name 'kontak_nama' first before field var 'x_kontak_nama'
        $val = $CurrentForm->hasValue("kontak_nama") ? $CurrentForm->getValue("kontak_nama") : $CurrentForm->getValue("x_kontak_nama");
        if (!$this->kontak_nama->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kontak_nama->Visible = false; // Disable update for API request
            } else {
                $this->kontak_nama->setFormValue($val);
            }
        }

        // Check field name 'kontak_hp' first before field var 'x_kontak_hp'
        $val = $CurrentForm->hasValue("kontak_hp") ? $CurrentForm->getValue("kontak_hp") : $CurrentForm->getValue("x_kontak_hp");
        if (!$this->kontak_hp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->kontak_hp->Visible = false; // Disable update for API request
            } else {
                $this->kontak_hp->setFormValue($val);
            }
        }

        // Check field name 'poster' first before field var 'x_poster'
        $val = $CurrentForm->hasValue("poster") ? $CurrentForm->getValue("poster") : $CurrentForm->getValue("x_poster");
        if (!$this->poster->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->poster->Visible = false; // Disable update for API request
            } else {
                $this->poster->setFormValue($val);
            }
        }

        // Check field name 'postertipe' first before field var 'x_postertipe'
        $val = $CurrentForm->hasValue("postertipe") ? $CurrentForm->getValue("postertipe") : $CurrentForm->getValue("x_postertipe");
        if (!$this->postertipe->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->postertipe->Visible = false; // Disable update for API request
            } else {
                $this->postertipe->setFormValue($val);
            }
        }

        // Check field name 'posterukuran' first before field var 'x_posterukuran'
        $val = $CurrentForm->hasValue("posterukuran") ? $CurrentForm->getValue("posterukuran") : $CurrentForm->getValue("x_posterukuran");
        if (!$this->posterukuran->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->posterukuran->Visible = false; // Disable update for API request
            } else {
                $this->posterukuran->setFormValue($val);
            }
        }

        // Check field name 'posterlebar' first before field var 'x_posterlebar'
        $val = $CurrentForm->hasValue("posterlebar") ? $CurrentForm->getValue("posterlebar") : $CurrentForm->getValue("x_posterlebar");
        if (!$this->posterlebar->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->posterlebar->Visible = false; // Disable update for API request
            } else {
                $this->posterlebar->setFormValue($val);
            }
        }

        // Check field name 'postertinggi' first before field var 'x_postertinggi'
        $val = $CurrentForm->hasValue("postertinggi") ? $CurrentForm->getValue("postertinggi") : $CurrentForm->getValue("x_postertinggi");
        if (!$this->postertinggi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->postertinggi->Visible = false; // Disable update for API request
            } else {
                $this->postertinggi->setFormValue($val);
            }
        }

        // Check field name 'linkinfo' first before field var 'x_linkinfo'
        $val = $CurrentForm->hasValue("linkinfo") ? $CurrentForm->getValue("linkinfo") : $CurrentForm->getValue("x_linkinfo");
        if (!$this->linkinfo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->linkinfo->Visible = false; // Disable update for API request
            } else {
                $this->linkinfo->setFormValue($val);
            }
        }

        // Check field name 'peserta_kelas' first before field var 'x_peserta_kelas'
        $val = $CurrentForm->hasValue("peserta_kelas") ? $CurrentForm->getValue("peserta_kelas") : $CurrentForm->getValue("x_peserta_kelas");
        if (!$this->peserta_kelas->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->peserta_kelas->Visible = false; // Disable update for API request
            } else {
                $this->peserta_kelas->setFormValue($val);
            }
        }

        // Check field name 'waktu' first before field var 'x_waktu'
        $val = $CurrentForm->hasValue("waktu") ? $CurrentForm->getValue("waktu") : $CurrentForm->getValue("x_waktu");
        if (!$this->waktu->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->waktu->Visible = false; // Disable update for API request
            } else {
                $this->waktu->setFormValue($val);
            }
            $this->waktu->CurrentValue = UnFormatDateTime($this->waktu->CurrentValue, 0);
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->id->CurrentValue = $this->id->FormValue;
        $this->idperiode->CurrentValue = $this->idperiode->FormValue;
        $this->idkelompok->CurrentValue = $this->idkelompok->FormValue;
        $this->namakegiatan->CurrentValue = $this->namakegiatan->FormValue;
        $this->uraian->CurrentValue = $this->uraian->FormValue;
        $this->tglmulai->CurrentValue = $this->tglmulai->FormValue;
        $this->tglmulai->CurrentValue = UnFormatDateTime($this->tglmulai->CurrentValue, 0);
        $this->tglakhir->CurrentValue = $this->tglakhir->FormValue;
        $this->tglakhir->CurrentValue = UnFormatDateTime($this->tglakhir->CurrentValue, 0);
        $this->narasumber->CurrentValue = $this->narasumber->FormValue;
        $this->kontak_nama->CurrentValue = $this->kontak_nama->FormValue;
        $this->kontak_hp->CurrentValue = $this->kontak_hp->FormValue;
        $this->poster->CurrentValue = $this->poster->FormValue;
        $this->postertipe->CurrentValue = $this->postertipe->FormValue;
        $this->posterukuran->CurrentValue = $this->posterukuran->FormValue;
        $this->posterlebar->CurrentValue = $this->posterlebar->FormValue;
        $this->postertinggi->CurrentValue = $this->postertinggi->FormValue;
        $this->linkinfo->CurrentValue = $this->linkinfo->FormValue;
        $this->peserta_kelas->CurrentValue = $this->peserta_kelas->FormValue;
        $this->waktu->CurrentValue = $this->waktu->FormValue;
        $this->waktu->CurrentValue = UnFormatDateTime($this->waktu->CurrentValue, 0);
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
        $this->idperiode->setDbValue($row['idperiode']);
        $this->idkelompok->setDbValue($row['idkelompok']);
        $this->namakegiatan->setDbValue($row['namakegiatan']);
        $this->uraian->setDbValue($row['uraian']);
        $this->tglmulai->setDbValue($row['tglmulai']);
        $this->tglakhir->setDbValue($row['tglakhir']);
        $this->narasumber->setDbValue($row['narasumber']);
        $this->kontak_nama->setDbValue($row['kontak_nama']);
        $this->kontak_hp->setDbValue($row['kontak_hp']);
        $this->poster->setDbValue($row['poster']);
        $this->postertipe->setDbValue($row['postertipe']);
        $this->posterukuran->setDbValue($row['posterukuran']);
        $this->posterlebar->setDbValue($row['posterlebar']);
        $this->postertinggi->setDbValue($row['postertinggi']);
        $this->linkinfo->setDbValue($row['linkinfo']);
        $this->peserta_kelas->setDbValue($row['peserta_kelas']);
        $this->waktu->setDbValue($row['waktu']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['idperiode'] = null;
        $row['idkelompok'] = null;
        $row['namakegiatan'] = null;
        $row['uraian'] = null;
        $row['tglmulai'] = null;
        $row['tglakhir'] = null;
        $row['narasumber'] = null;
        $row['kontak_nama'] = null;
        $row['kontak_hp'] = null;
        $row['poster'] = null;
        $row['postertipe'] = null;
        $row['posterukuran'] = null;
        $row['posterlebar'] = null;
        $row['postertinggi'] = null;
        $row['linkinfo'] = null;
        $row['peserta_kelas'] = null;
        $row['waktu'] = null;
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

        // id

        // idperiode

        // idkelompok

        // namakegiatan

        // uraian

        // tglmulai

        // tglakhir

        // narasumber

        // kontak_nama

        // kontak_hp

        // poster

        // postertipe

        // posterukuran

        // posterlebar

        // postertinggi

        // linkinfo

        // peserta_kelas

        // waktu
        if ($this->RowType == ROWTYPE_VIEW) {
            // id
            $this->id->ViewValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // idperiode
            $this->idperiode->ViewValue = $this->idperiode->CurrentValue;
            $this->idperiode->ViewValue = FormatNumber($this->idperiode->ViewValue, 0, -2, -2, -2);
            $this->idperiode->ViewCustomAttributes = "";

            // idkelompok
            $this->idkelompok->ViewValue = $this->idkelompok->CurrentValue;
            $this->idkelompok->ViewValue = FormatNumber($this->idkelompok->ViewValue, 0, -2, -2, -2);
            $this->idkelompok->ViewCustomAttributes = "";

            // namakegiatan
            $this->namakegiatan->ViewValue = $this->namakegiatan->CurrentValue;
            $this->namakegiatan->ViewCustomAttributes = "";

            // uraian
            $this->uraian->ViewValue = $this->uraian->CurrentValue;
            $this->uraian->ViewCustomAttributes = "";

            // tglmulai
            $this->tglmulai->ViewValue = $this->tglmulai->CurrentValue;
            $this->tglmulai->ViewValue = FormatDateTime($this->tglmulai->ViewValue, 0);
            $this->tglmulai->ViewCustomAttributes = "";

            // tglakhir
            $this->tglakhir->ViewValue = $this->tglakhir->CurrentValue;
            $this->tglakhir->ViewValue = FormatDateTime($this->tglakhir->ViewValue, 0);
            $this->tglakhir->ViewCustomAttributes = "";

            // narasumber
            $this->narasumber->ViewValue = $this->narasumber->CurrentValue;
            $this->narasumber->ViewCustomAttributes = "";

            // kontak_nama
            $this->kontak_nama->ViewValue = $this->kontak_nama->CurrentValue;
            $this->kontak_nama->ViewCustomAttributes = "";

            // kontak_hp
            $this->kontak_hp->ViewValue = $this->kontak_hp->CurrentValue;
            $this->kontak_hp->ViewCustomAttributes = "";

            // poster
            $this->poster->ViewValue = $this->poster->CurrentValue;
            $this->poster->ViewCustomAttributes = "";

            // postertipe
            $this->postertipe->ViewValue = $this->postertipe->CurrentValue;
            $this->postertipe->ViewCustomAttributes = "";

            // posterukuran
            $this->posterukuran->ViewValue = $this->posterukuran->CurrentValue;
            $this->posterukuran->ViewValue = FormatNumber($this->posterukuran->ViewValue, 0, -2, -2, -2);
            $this->posterukuran->ViewCustomAttributes = "";

            // posterlebar
            $this->posterlebar->ViewValue = $this->posterlebar->CurrentValue;
            $this->posterlebar->ViewValue = FormatNumber($this->posterlebar->ViewValue, 0, -2, -2, -2);
            $this->posterlebar->ViewCustomAttributes = "";

            // postertinggi
            $this->postertinggi->ViewValue = $this->postertinggi->CurrentValue;
            $this->postertinggi->ViewValue = FormatNumber($this->postertinggi->ViewValue, 0, -2, -2, -2);
            $this->postertinggi->ViewCustomAttributes = "";

            // linkinfo
            $this->linkinfo->ViewValue = $this->linkinfo->CurrentValue;
            $this->linkinfo->ViewCustomAttributes = "";

            // peserta_kelas
            $this->peserta_kelas->ViewValue = $this->peserta_kelas->CurrentValue;
            $this->peserta_kelas->ViewCustomAttributes = "";

            // waktu
            $this->waktu->ViewValue = $this->waktu->CurrentValue;
            $this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
            $this->waktu->ViewCustomAttributes = "";

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

            // idperiode
            $this->idperiode->LinkCustomAttributes = "";
            $this->idperiode->HrefValue = "";
            $this->idperiode->TooltipValue = "";

            // idkelompok
            $this->idkelompok->LinkCustomAttributes = "";
            $this->idkelompok->HrefValue = "";
            $this->idkelompok->TooltipValue = "";

            // namakegiatan
            $this->namakegiatan->LinkCustomAttributes = "";
            $this->namakegiatan->HrefValue = "";
            $this->namakegiatan->TooltipValue = "";

            // uraian
            $this->uraian->LinkCustomAttributes = "";
            $this->uraian->HrefValue = "";
            $this->uraian->TooltipValue = "";

            // tglmulai
            $this->tglmulai->LinkCustomAttributes = "";
            $this->tglmulai->HrefValue = "";
            $this->tglmulai->TooltipValue = "";

            // tglakhir
            $this->tglakhir->LinkCustomAttributes = "";
            $this->tglakhir->HrefValue = "";
            $this->tglakhir->TooltipValue = "";

            // narasumber
            $this->narasumber->LinkCustomAttributes = "";
            $this->narasumber->HrefValue = "";
            $this->narasumber->TooltipValue = "";

            // kontak_nama
            $this->kontak_nama->LinkCustomAttributes = "";
            $this->kontak_nama->HrefValue = "";
            $this->kontak_nama->TooltipValue = "";

            // kontak_hp
            $this->kontak_hp->LinkCustomAttributes = "";
            $this->kontak_hp->HrefValue = "";
            $this->kontak_hp->TooltipValue = "";

            // poster
            $this->poster->LinkCustomAttributes = "";
            $this->poster->HrefValue = "";
            $this->poster->TooltipValue = "";

            // postertipe
            $this->postertipe->LinkCustomAttributes = "";
            $this->postertipe->HrefValue = "";
            $this->postertipe->TooltipValue = "";

            // posterukuran
            $this->posterukuran->LinkCustomAttributes = "";
            $this->posterukuran->HrefValue = "";
            $this->posterukuran->TooltipValue = "";

            // posterlebar
            $this->posterlebar->LinkCustomAttributes = "";
            $this->posterlebar->HrefValue = "";
            $this->posterlebar->TooltipValue = "";

            // postertinggi
            $this->postertinggi->LinkCustomAttributes = "";
            $this->postertinggi->HrefValue = "";
            $this->postertinggi->TooltipValue = "";

            // linkinfo
            $this->linkinfo->LinkCustomAttributes = "";
            $this->linkinfo->HrefValue = "";
            $this->linkinfo->TooltipValue = "";

            // peserta_kelas
            $this->peserta_kelas->LinkCustomAttributes = "";
            $this->peserta_kelas->HrefValue = "";
            $this->peserta_kelas->TooltipValue = "";

            // waktu
            $this->waktu->LinkCustomAttributes = "";
            $this->waktu->HrefValue = "";
            $this->waktu->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // idperiode
            $this->idperiode->EditAttrs["class"] = "form-control";
            $this->idperiode->EditCustomAttributes = "";
            $this->idperiode->EditValue = HtmlEncode($this->idperiode->CurrentValue);
            $this->idperiode->PlaceHolder = RemoveHtml($this->idperiode->caption());

            // idkelompok
            $this->idkelompok->EditAttrs["class"] = "form-control";
            $this->idkelompok->EditCustomAttributes = "";
            $this->idkelompok->EditValue = HtmlEncode($this->idkelompok->CurrentValue);
            $this->idkelompok->PlaceHolder = RemoveHtml($this->idkelompok->caption());

            // namakegiatan
            $this->namakegiatan->EditAttrs["class"] = "form-control";
            $this->namakegiatan->EditCustomAttributes = "";
            if (!$this->namakegiatan->Raw) {
                $this->namakegiatan->CurrentValue = HtmlDecode($this->namakegiatan->CurrentValue);
            }
            $this->namakegiatan->EditValue = HtmlEncode($this->namakegiatan->CurrentValue);
            $this->namakegiatan->PlaceHolder = RemoveHtml($this->namakegiatan->caption());

            // uraian
            $this->uraian->EditAttrs["class"] = "form-control";
            $this->uraian->EditCustomAttributes = "";
            if (!$this->uraian->Raw) {
                $this->uraian->CurrentValue = HtmlDecode($this->uraian->CurrentValue);
            }
            $this->uraian->EditValue = HtmlEncode($this->uraian->CurrentValue);
            $this->uraian->PlaceHolder = RemoveHtml($this->uraian->caption());

            // tglmulai
            $this->tglmulai->EditAttrs["class"] = "form-control";
            $this->tglmulai->EditCustomAttributes = "";
            $this->tglmulai->EditValue = HtmlEncode(FormatDateTime($this->tglmulai->CurrentValue, 8));
            $this->tglmulai->PlaceHolder = RemoveHtml($this->tglmulai->caption());

            // tglakhir
            $this->tglakhir->EditAttrs["class"] = "form-control";
            $this->tglakhir->EditCustomAttributes = "";
            $this->tglakhir->EditValue = HtmlEncode(FormatDateTime($this->tglakhir->CurrentValue, 8));
            $this->tglakhir->PlaceHolder = RemoveHtml($this->tglakhir->caption());

            // narasumber
            $this->narasumber->EditAttrs["class"] = "form-control";
            $this->narasumber->EditCustomAttributes = "";
            if (!$this->narasumber->Raw) {
                $this->narasumber->CurrentValue = HtmlDecode($this->narasumber->CurrentValue);
            }
            $this->narasumber->EditValue = HtmlEncode($this->narasumber->CurrentValue);
            $this->narasumber->PlaceHolder = RemoveHtml($this->narasumber->caption());

            // kontak_nama
            $this->kontak_nama->EditAttrs["class"] = "form-control";
            $this->kontak_nama->EditCustomAttributes = "";
            if (!$this->kontak_nama->Raw) {
                $this->kontak_nama->CurrentValue = HtmlDecode($this->kontak_nama->CurrentValue);
            }
            $this->kontak_nama->EditValue = HtmlEncode($this->kontak_nama->CurrentValue);
            $this->kontak_nama->PlaceHolder = RemoveHtml($this->kontak_nama->caption());

            // kontak_hp
            $this->kontak_hp->EditAttrs["class"] = "form-control";
            $this->kontak_hp->EditCustomAttributes = "";
            if (!$this->kontak_hp->Raw) {
                $this->kontak_hp->CurrentValue = HtmlDecode($this->kontak_hp->CurrentValue);
            }
            $this->kontak_hp->EditValue = HtmlEncode($this->kontak_hp->CurrentValue);
            $this->kontak_hp->PlaceHolder = RemoveHtml($this->kontak_hp->caption());

            // poster
            $this->poster->EditAttrs["class"] = "form-control";
            $this->poster->EditCustomAttributes = "";
            if (!$this->poster->Raw) {
                $this->poster->CurrentValue = HtmlDecode($this->poster->CurrentValue);
            }
            $this->poster->EditValue = HtmlEncode($this->poster->CurrentValue);
            $this->poster->PlaceHolder = RemoveHtml($this->poster->caption());

            // postertipe
            $this->postertipe->EditAttrs["class"] = "form-control";
            $this->postertipe->EditCustomAttributes = "";
            if (!$this->postertipe->Raw) {
                $this->postertipe->CurrentValue = HtmlDecode($this->postertipe->CurrentValue);
            }
            $this->postertipe->EditValue = HtmlEncode($this->postertipe->CurrentValue);
            $this->postertipe->PlaceHolder = RemoveHtml($this->postertipe->caption());

            // posterukuran
            $this->posterukuran->EditAttrs["class"] = "form-control";
            $this->posterukuran->EditCustomAttributes = "";
            $this->posterukuran->EditValue = HtmlEncode($this->posterukuran->CurrentValue);
            $this->posterukuran->PlaceHolder = RemoveHtml($this->posterukuran->caption());

            // posterlebar
            $this->posterlebar->EditAttrs["class"] = "form-control";
            $this->posterlebar->EditCustomAttributes = "";
            $this->posterlebar->EditValue = HtmlEncode($this->posterlebar->CurrentValue);
            $this->posterlebar->PlaceHolder = RemoveHtml($this->posterlebar->caption());

            // postertinggi
            $this->postertinggi->EditAttrs["class"] = "form-control";
            $this->postertinggi->EditCustomAttributes = "";
            $this->postertinggi->EditValue = HtmlEncode($this->postertinggi->CurrentValue);
            $this->postertinggi->PlaceHolder = RemoveHtml($this->postertinggi->caption());

            // linkinfo
            $this->linkinfo->EditAttrs["class"] = "form-control";
            $this->linkinfo->EditCustomAttributes = "";
            if (!$this->linkinfo->Raw) {
                $this->linkinfo->CurrentValue = HtmlDecode($this->linkinfo->CurrentValue);
            }
            $this->linkinfo->EditValue = HtmlEncode($this->linkinfo->CurrentValue);
            $this->linkinfo->PlaceHolder = RemoveHtml($this->linkinfo->caption());

            // peserta_kelas
            $this->peserta_kelas->EditAttrs["class"] = "form-control";
            $this->peserta_kelas->EditCustomAttributes = "";
            if (!$this->peserta_kelas->Raw) {
                $this->peserta_kelas->CurrentValue = HtmlDecode($this->peserta_kelas->CurrentValue);
            }
            $this->peserta_kelas->EditValue = HtmlEncode($this->peserta_kelas->CurrentValue);
            $this->peserta_kelas->PlaceHolder = RemoveHtml($this->peserta_kelas->caption());

            // waktu
            $this->waktu->EditAttrs["class"] = "form-control";
            $this->waktu->EditCustomAttributes = "";
            $this->waktu->EditValue = HtmlEncode(FormatDateTime($this->waktu->CurrentValue, 8));
            $this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

            // Edit refer script

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // idperiode
            $this->idperiode->LinkCustomAttributes = "";
            $this->idperiode->HrefValue = "";

            // idkelompok
            $this->idkelompok->LinkCustomAttributes = "";
            $this->idkelompok->HrefValue = "";

            // namakegiatan
            $this->namakegiatan->LinkCustomAttributes = "";
            $this->namakegiatan->HrefValue = "";

            // uraian
            $this->uraian->LinkCustomAttributes = "";
            $this->uraian->HrefValue = "";

            // tglmulai
            $this->tglmulai->LinkCustomAttributes = "";
            $this->tglmulai->HrefValue = "";

            // tglakhir
            $this->tglakhir->LinkCustomAttributes = "";
            $this->tglakhir->HrefValue = "";

            // narasumber
            $this->narasumber->LinkCustomAttributes = "";
            $this->narasumber->HrefValue = "";

            // kontak_nama
            $this->kontak_nama->LinkCustomAttributes = "";
            $this->kontak_nama->HrefValue = "";

            // kontak_hp
            $this->kontak_hp->LinkCustomAttributes = "";
            $this->kontak_hp->HrefValue = "";

            // poster
            $this->poster->LinkCustomAttributes = "";
            $this->poster->HrefValue = "";

            // postertipe
            $this->postertipe->LinkCustomAttributes = "";
            $this->postertipe->HrefValue = "";

            // posterukuran
            $this->posterukuran->LinkCustomAttributes = "";
            $this->posterukuran->HrefValue = "";

            // posterlebar
            $this->posterlebar->LinkCustomAttributes = "";
            $this->posterlebar->HrefValue = "";

            // postertinggi
            $this->postertinggi->LinkCustomAttributes = "";
            $this->postertinggi->HrefValue = "";

            // linkinfo
            $this->linkinfo->LinkCustomAttributes = "";
            $this->linkinfo->HrefValue = "";

            // peserta_kelas
            $this->peserta_kelas->LinkCustomAttributes = "";
            $this->peserta_kelas->HrefValue = "";

            // waktu
            $this->waktu->LinkCustomAttributes = "";
            $this->waktu->HrefValue = "";
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
        if ($this->idperiode->Required) {
            if (!$this->idperiode->IsDetailKey && EmptyValue($this->idperiode->FormValue)) {
                $this->idperiode->addErrorMessage(str_replace("%s", $this->idperiode->caption(), $this->idperiode->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->idperiode->FormValue)) {
            $this->idperiode->addErrorMessage($this->idperiode->getErrorMessage(false));
        }
        if ($this->idkelompok->Required) {
            if (!$this->idkelompok->IsDetailKey && EmptyValue($this->idkelompok->FormValue)) {
                $this->idkelompok->addErrorMessage(str_replace("%s", $this->idkelompok->caption(), $this->idkelompok->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->idkelompok->FormValue)) {
            $this->idkelompok->addErrorMessage($this->idkelompok->getErrorMessage(false));
        }
        if ($this->namakegiatan->Required) {
            if (!$this->namakegiatan->IsDetailKey && EmptyValue($this->namakegiatan->FormValue)) {
                $this->namakegiatan->addErrorMessage(str_replace("%s", $this->namakegiatan->caption(), $this->namakegiatan->RequiredErrorMessage));
            }
        }
        if ($this->uraian->Required) {
            if (!$this->uraian->IsDetailKey && EmptyValue($this->uraian->FormValue)) {
                $this->uraian->addErrorMessage(str_replace("%s", $this->uraian->caption(), $this->uraian->RequiredErrorMessage));
            }
        }
        if ($this->tglmulai->Required) {
            if (!$this->tglmulai->IsDetailKey && EmptyValue($this->tglmulai->FormValue)) {
                $this->tglmulai->addErrorMessage(str_replace("%s", $this->tglmulai->caption(), $this->tglmulai->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tglmulai->FormValue)) {
            $this->tglmulai->addErrorMessage($this->tglmulai->getErrorMessage(false));
        }
        if ($this->tglakhir->Required) {
            if (!$this->tglakhir->IsDetailKey && EmptyValue($this->tglakhir->FormValue)) {
                $this->tglakhir->addErrorMessage(str_replace("%s", $this->tglakhir->caption(), $this->tglakhir->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->tglakhir->FormValue)) {
            $this->tglakhir->addErrorMessage($this->tglakhir->getErrorMessage(false));
        }
        if ($this->narasumber->Required) {
            if (!$this->narasumber->IsDetailKey && EmptyValue($this->narasumber->FormValue)) {
                $this->narasumber->addErrorMessage(str_replace("%s", $this->narasumber->caption(), $this->narasumber->RequiredErrorMessage));
            }
        }
        if ($this->kontak_nama->Required) {
            if (!$this->kontak_nama->IsDetailKey && EmptyValue($this->kontak_nama->FormValue)) {
                $this->kontak_nama->addErrorMessage(str_replace("%s", $this->kontak_nama->caption(), $this->kontak_nama->RequiredErrorMessage));
            }
        }
        if ($this->kontak_hp->Required) {
            if (!$this->kontak_hp->IsDetailKey && EmptyValue($this->kontak_hp->FormValue)) {
                $this->kontak_hp->addErrorMessage(str_replace("%s", $this->kontak_hp->caption(), $this->kontak_hp->RequiredErrorMessage));
            }
        }
        if ($this->poster->Required) {
            if (!$this->poster->IsDetailKey && EmptyValue($this->poster->FormValue)) {
                $this->poster->addErrorMessage(str_replace("%s", $this->poster->caption(), $this->poster->RequiredErrorMessage));
            }
        }
        if ($this->postertipe->Required) {
            if (!$this->postertipe->IsDetailKey && EmptyValue($this->postertipe->FormValue)) {
                $this->postertipe->addErrorMessage(str_replace("%s", $this->postertipe->caption(), $this->postertipe->RequiredErrorMessage));
            }
        }
        if ($this->posterukuran->Required) {
            if (!$this->posterukuran->IsDetailKey && EmptyValue($this->posterukuran->FormValue)) {
                $this->posterukuran->addErrorMessage(str_replace("%s", $this->posterukuran->caption(), $this->posterukuran->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->posterukuran->FormValue)) {
            $this->posterukuran->addErrorMessage($this->posterukuran->getErrorMessage(false));
        }
        if ($this->posterlebar->Required) {
            if (!$this->posterlebar->IsDetailKey && EmptyValue($this->posterlebar->FormValue)) {
                $this->posterlebar->addErrorMessage(str_replace("%s", $this->posterlebar->caption(), $this->posterlebar->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->posterlebar->FormValue)) {
            $this->posterlebar->addErrorMessage($this->posterlebar->getErrorMessage(false));
        }
        if ($this->postertinggi->Required) {
            if (!$this->postertinggi->IsDetailKey && EmptyValue($this->postertinggi->FormValue)) {
                $this->postertinggi->addErrorMessage(str_replace("%s", $this->postertinggi->caption(), $this->postertinggi->RequiredErrorMessage));
            }
        }
        if (!CheckInteger($this->postertinggi->FormValue)) {
            $this->postertinggi->addErrorMessage($this->postertinggi->getErrorMessage(false));
        }
        if ($this->linkinfo->Required) {
            if (!$this->linkinfo->IsDetailKey && EmptyValue($this->linkinfo->FormValue)) {
                $this->linkinfo->addErrorMessage(str_replace("%s", $this->linkinfo->caption(), $this->linkinfo->RequiredErrorMessage));
            }
        }
        if ($this->peserta_kelas->Required) {
            if (!$this->peserta_kelas->IsDetailKey && EmptyValue($this->peserta_kelas->FormValue)) {
                $this->peserta_kelas->addErrorMessage(str_replace("%s", $this->peserta_kelas->caption(), $this->peserta_kelas->RequiredErrorMessage));
            }
        }
        if ($this->waktu->Required) {
            if (!$this->waktu->IsDetailKey && EmptyValue($this->waktu->FormValue)) {
                $this->waktu->addErrorMessage(str_replace("%s", $this->waktu->caption(), $this->waktu->RequiredErrorMessage));
            }
        }
        if (!CheckDate($this->waktu->FormValue)) {
            $this->waktu->addErrorMessage($this->waktu->getErrorMessage(false));
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

            // idperiode
            $this->idperiode->setDbValueDef($rsnew, $this->idperiode->CurrentValue, 0, $this->idperiode->ReadOnly);

            // idkelompok
            $this->idkelompok->setDbValueDef($rsnew, $this->idkelompok->CurrentValue, null, $this->idkelompok->ReadOnly);

            // namakegiatan
            $this->namakegiatan->setDbValueDef($rsnew, $this->namakegiatan->CurrentValue, null, $this->namakegiatan->ReadOnly);

            // uraian
            $this->uraian->setDbValueDef($rsnew, $this->uraian->CurrentValue, null, $this->uraian->ReadOnly);

            // tglmulai
            $this->tglmulai->setDbValueDef($rsnew, UnFormatDateTime($this->tglmulai->CurrentValue, 0), null, $this->tglmulai->ReadOnly);

            // tglakhir
            $this->tglakhir->setDbValueDef($rsnew, UnFormatDateTime($this->tglakhir->CurrentValue, 0), null, $this->tglakhir->ReadOnly);

            // narasumber
            $this->narasumber->setDbValueDef($rsnew, $this->narasumber->CurrentValue, null, $this->narasumber->ReadOnly);

            // kontak_nama
            $this->kontak_nama->setDbValueDef($rsnew, $this->kontak_nama->CurrentValue, null, $this->kontak_nama->ReadOnly);

            // kontak_hp
            $this->kontak_hp->setDbValueDef($rsnew, $this->kontak_hp->CurrentValue, null, $this->kontak_hp->ReadOnly);

            // poster
            $this->poster->setDbValueDef($rsnew, $this->poster->CurrentValue, null, $this->poster->ReadOnly);

            // postertipe
            $this->postertipe->setDbValueDef($rsnew, $this->postertipe->CurrentValue, null, $this->postertipe->ReadOnly);

            // posterukuran
            $this->posterukuran->setDbValueDef($rsnew, $this->posterukuran->CurrentValue, null, $this->posterukuran->ReadOnly);

            // posterlebar
            $this->posterlebar->setDbValueDef($rsnew, $this->posterlebar->CurrentValue, null, $this->posterlebar->ReadOnly);

            // postertinggi
            $this->postertinggi->setDbValueDef($rsnew, $this->postertinggi->CurrentValue, null, $this->postertinggi->ReadOnly);

            // linkinfo
            $this->linkinfo->setDbValueDef($rsnew, $this->linkinfo->CurrentValue, null, $this->linkinfo->ReadOnly);

            // peserta_kelas
            $this->peserta_kelas->setDbValueDef($rsnew, $this->peserta_kelas->CurrentValue, null, $this->peserta_kelas->ReadOnly);

            // waktu
            $this->waktu->setDbValueDef($rsnew, UnFormatDateTime($this->waktu->CurrentValue, 0), null, $this->waktu->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("binadatalist"), "", $this->TableVar, true);
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
