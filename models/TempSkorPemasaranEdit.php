<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorPemasaranEdit extends TempSkorPemasaran
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_pemasaran';

    // Page object name
    public $PageObjName = "TempSkorPemasaranEdit";

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

        // Table object (temp_skor_pemasaran)
        if (!isset($GLOBALS["temp_skor_pemasaran"]) || get_class($GLOBALS["temp_skor_pemasaran"]) == PROJECT_NAMESPACE . "temp_skor_pemasaran") {
            $GLOBALS["temp_skor_pemasaran"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_pemasaran');
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
                $doc = new $class(Container("temp_skor_pemasaran"));
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
                    if ($pageName == "tempskorpemasaranview") {
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
        $this->skor_unggul->setVisibility();
        $this->max_unggul->setVisibility();
        $this->skor_target->setVisibility();
        $this->max_target->setVisibility();
        $this->skor_available->setVisibility();
        $this->max_available->setVisibility();
        $this->skor_merk->setVisibility();
        $this->max_merk->setVisibility();
        $this->skor_merkhaki->setVisibility();
        $this->max_merkhaki->setVisibility();
        $this->skor_merkkonsep->setVisibility();
        $this->max_merkkonsep->setVisibility();
        $this->skor_merklisensi->setVisibility();
        $this->max_merklisensi->setVisibility();
        $this->skor_mitra->setVisibility();
        $this->max_mitra->setVisibility();
        $this->skor_market->setVisibility();
        $this->max_market->setVisibility();
        $this->skor_pelangganloyal->setVisibility();
        $this->max_pelangganloyal->setVisibility();
        $this->skor_pameranmandiri->setVisibility();
        $this->max_pameranmandiri->setVisibility();
        $this->skor_mediaoffline->setVisibility();
        $this->max_mediaoffline->setVisibility();
        $this->skor_pemasaran->setVisibility();
        $this->maxskor_pemasaran->setVisibility();
        $this->bobot_pemasaran->setVisibility();
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
                    $this->terminate("tempskorpemasaranlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "tempskorpemasaranlist") {
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

        // Check field name 'skor_unggul' first before field var 'x_skor_unggul'
        $val = $CurrentForm->hasValue("skor_unggul") ? $CurrentForm->getValue("skor_unggul") : $CurrentForm->getValue("x_skor_unggul");
        if (!$this->skor_unggul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_unggul->Visible = false; // Disable update for API request
            } else {
                $this->skor_unggul->setFormValue($val);
            }
        }

        // Check field name 'max_unggul' first before field var 'x_max_unggul'
        $val = $CurrentForm->hasValue("max_unggul") ? $CurrentForm->getValue("max_unggul") : $CurrentForm->getValue("x_max_unggul");
        if (!$this->max_unggul->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_unggul->Visible = false; // Disable update for API request
            } else {
                $this->max_unggul->setFormValue($val);
            }
        }

        // Check field name 'skor_target' first before field var 'x_skor_target'
        $val = $CurrentForm->hasValue("skor_target") ? $CurrentForm->getValue("skor_target") : $CurrentForm->getValue("x_skor_target");
        if (!$this->skor_target->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_target->Visible = false; // Disable update for API request
            } else {
                $this->skor_target->setFormValue($val);
            }
        }

        // Check field name 'max_target' first before field var 'x_max_target'
        $val = $CurrentForm->hasValue("max_target") ? $CurrentForm->getValue("max_target") : $CurrentForm->getValue("x_max_target");
        if (!$this->max_target->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_target->Visible = false; // Disable update for API request
            } else {
                $this->max_target->setFormValue($val);
            }
        }

        // Check field name 'skor_available' first before field var 'x_skor_available'
        $val = $CurrentForm->hasValue("skor_available") ? $CurrentForm->getValue("skor_available") : $CurrentForm->getValue("x_skor_available");
        if (!$this->skor_available->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_available->Visible = false; // Disable update for API request
            } else {
                $this->skor_available->setFormValue($val);
            }
        }

        // Check field name 'max_available' first before field var 'x_max_available'
        $val = $CurrentForm->hasValue("max_available") ? $CurrentForm->getValue("max_available") : $CurrentForm->getValue("x_max_available");
        if (!$this->max_available->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_available->Visible = false; // Disable update for API request
            } else {
                $this->max_available->setFormValue($val);
            }
        }

        // Check field name 'skor_merk' first before field var 'x_skor_merk'
        $val = $CurrentForm->hasValue("skor_merk") ? $CurrentForm->getValue("skor_merk") : $CurrentForm->getValue("x_skor_merk");
        if (!$this->skor_merk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_merk->Visible = false; // Disable update for API request
            } else {
                $this->skor_merk->setFormValue($val);
            }
        }

        // Check field name 'max_merk' first before field var 'x_max_merk'
        $val = $CurrentForm->hasValue("max_merk") ? $CurrentForm->getValue("max_merk") : $CurrentForm->getValue("x_max_merk");
        if (!$this->max_merk->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_merk->Visible = false; // Disable update for API request
            } else {
                $this->max_merk->setFormValue($val);
            }
        }

        // Check field name 'skor_merkhaki' first before field var 'x_skor_merkhaki'
        $val = $CurrentForm->hasValue("skor_merkhaki") ? $CurrentForm->getValue("skor_merkhaki") : $CurrentForm->getValue("x_skor_merkhaki");
        if (!$this->skor_merkhaki->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_merkhaki->Visible = false; // Disable update for API request
            } else {
                $this->skor_merkhaki->setFormValue($val);
            }
        }

        // Check field name 'max_merkhaki' first before field var 'x_max_merkhaki'
        $val = $CurrentForm->hasValue("max_merkhaki") ? $CurrentForm->getValue("max_merkhaki") : $CurrentForm->getValue("x_max_merkhaki");
        if (!$this->max_merkhaki->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_merkhaki->Visible = false; // Disable update for API request
            } else {
                $this->max_merkhaki->setFormValue($val);
            }
        }

        // Check field name 'skor_merkkonsep' first before field var 'x_skor_merkkonsep'
        $val = $CurrentForm->hasValue("skor_merkkonsep") ? $CurrentForm->getValue("skor_merkkonsep") : $CurrentForm->getValue("x_skor_merkkonsep");
        if (!$this->skor_merkkonsep->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_merkkonsep->Visible = false; // Disable update for API request
            } else {
                $this->skor_merkkonsep->setFormValue($val);
            }
        }

        // Check field name 'max_merkkonsep' first before field var 'x_max_merkkonsep'
        $val = $CurrentForm->hasValue("max_merkkonsep") ? $CurrentForm->getValue("max_merkkonsep") : $CurrentForm->getValue("x_max_merkkonsep");
        if (!$this->max_merkkonsep->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_merkkonsep->Visible = false; // Disable update for API request
            } else {
                $this->max_merkkonsep->setFormValue($val);
            }
        }

        // Check field name 'skor_merklisensi' first before field var 'x_skor_merklisensi'
        $val = $CurrentForm->hasValue("skor_merklisensi") ? $CurrentForm->getValue("skor_merklisensi") : $CurrentForm->getValue("x_skor_merklisensi");
        if (!$this->skor_merklisensi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_merklisensi->Visible = false; // Disable update for API request
            } else {
                $this->skor_merklisensi->setFormValue($val);
            }
        }

        // Check field name 'max_merklisensi' first before field var 'x_max_merklisensi'
        $val = $CurrentForm->hasValue("max_merklisensi") ? $CurrentForm->getValue("max_merklisensi") : $CurrentForm->getValue("x_max_merklisensi");
        if (!$this->max_merklisensi->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_merklisensi->Visible = false; // Disable update for API request
            } else {
                $this->max_merklisensi->setFormValue($val);
            }
        }

        // Check field name 'skor_mitra' first before field var 'x_skor_mitra'
        $val = $CurrentForm->hasValue("skor_mitra") ? $CurrentForm->getValue("skor_mitra") : $CurrentForm->getValue("x_skor_mitra");
        if (!$this->skor_mitra->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_mitra->Visible = false; // Disable update for API request
            } else {
                $this->skor_mitra->setFormValue($val);
            }
        }

        // Check field name 'max_mitra' first before field var 'x_max_mitra'
        $val = $CurrentForm->hasValue("max_mitra") ? $CurrentForm->getValue("max_mitra") : $CurrentForm->getValue("x_max_mitra");
        if (!$this->max_mitra->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_mitra->Visible = false; // Disable update for API request
            } else {
                $this->max_mitra->setFormValue($val);
            }
        }

        // Check field name 'skor_market' first before field var 'x_skor_market'
        $val = $CurrentForm->hasValue("skor_market") ? $CurrentForm->getValue("skor_market") : $CurrentForm->getValue("x_skor_market");
        if (!$this->skor_market->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_market->Visible = false; // Disable update for API request
            } else {
                $this->skor_market->setFormValue($val);
            }
        }

        // Check field name 'max_market' first before field var 'x_max_market'
        $val = $CurrentForm->hasValue("max_market") ? $CurrentForm->getValue("max_market") : $CurrentForm->getValue("x_max_market");
        if (!$this->max_market->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_market->Visible = false; // Disable update for API request
            } else {
                $this->max_market->setFormValue($val);
            }
        }

        // Check field name 'skor_pelangganloyal' first before field var 'x_skor_pelangganloyal'
        $val = $CurrentForm->hasValue("skor_pelangganloyal") ? $CurrentForm->getValue("skor_pelangganloyal") : $CurrentForm->getValue("x_skor_pelangganloyal");
        if (!$this->skor_pelangganloyal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pelangganloyal->Visible = false; // Disable update for API request
            } else {
                $this->skor_pelangganloyal->setFormValue($val);
            }
        }

        // Check field name 'max_pelangganloyal' first before field var 'x_max_pelangganloyal'
        $val = $CurrentForm->hasValue("max_pelangganloyal") ? $CurrentForm->getValue("max_pelangganloyal") : $CurrentForm->getValue("x_max_pelangganloyal");
        if (!$this->max_pelangganloyal->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_pelangganloyal->Visible = false; // Disable update for API request
            } else {
                $this->max_pelangganloyal->setFormValue($val);
            }
        }

        // Check field name 'skor_pameranmandiri' first before field var 'x_skor_pameranmandiri'
        $val = $CurrentForm->hasValue("skor_pameranmandiri") ? $CurrentForm->getValue("skor_pameranmandiri") : $CurrentForm->getValue("x_skor_pameranmandiri");
        if (!$this->skor_pameranmandiri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_pameranmandiri->Visible = false; // Disable update for API request
            } else {
                $this->skor_pameranmandiri->setFormValue($val);
            }
        }

        // Check field name 'max_pameranmandiri' first before field var 'x_max_pameranmandiri'
        $val = $CurrentForm->hasValue("max_pameranmandiri") ? $CurrentForm->getValue("max_pameranmandiri") : $CurrentForm->getValue("x_max_pameranmandiri");
        if (!$this->max_pameranmandiri->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_pameranmandiri->Visible = false; // Disable update for API request
            } else {
                $this->max_pameranmandiri->setFormValue($val);
            }
        }

        // Check field name 'skor_mediaoffline' first before field var 'x_skor_mediaoffline'
        $val = $CurrentForm->hasValue("skor_mediaoffline") ? $CurrentForm->getValue("skor_mediaoffline") : $CurrentForm->getValue("x_skor_mediaoffline");
        if (!$this->skor_mediaoffline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_mediaoffline->Visible = false; // Disable update for API request
            } else {
                $this->skor_mediaoffline->setFormValue($val);
            }
        }

        // Check field name 'max_mediaoffline' first before field var 'x_max_mediaoffline'
        $val = $CurrentForm->hasValue("max_mediaoffline") ? $CurrentForm->getValue("max_mediaoffline") : $CurrentForm->getValue("x_max_mediaoffline");
        if (!$this->max_mediaoffline->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_mediaoffline->Visible = false; // Disable update for API request
            } else {
                $this->max_mediaoffline->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->skor_unggul->CurrentValue = $this->skor_unggul->FormValue;
        $this->max_unggul->CurrentValue = $this->max_unggul->FormValue;
        $this->skor_target->CurrentValue = $this->skor_target->FormValue;
        $this->max_target->CurrentValue = $this->max_target->FormValue;
        $this->skor_available->CurrentValue = $this->skor_available->FormValue;
        $this->max_available->CurrentValue = $this->max_available->FormValue;
        $this->skor_merk->CurrentValue = $this->skor_merk->FormValue;
        $this->max_merk->CurrentValue = $this->max_merk->FormValue;
        $this->skor_merkhaki->CurrentValue = $this->skor_merkhaki->FormValue;
        $this->max_merkhaki->CurrentValue = $this->max_merkhaki->FormValue;
        $this->skor_merkkonsep->CurrentValue = $this->skor_merkkonsep->FormValue;
        $this->max_merkkonsep->CurrentValue = $this->max_merkkonsep->FormValue;
        $this->skor_merklisensi->CurrentValue = $this->skor_merklisensi->FormValue;
        $this->max_merklisensi->CurrentValue = $this->max_merklisensi->FormValue;
        $this->skor_mitra->CurrentValue = $this->skor_mitra->FormValue;
        $this->max_mitra->CurrentValue = $this->max_mitra->FormValue;
        $this->skor_market->CurrentValue = $this->skor_market->FormValue;
        $this->max_market->CurrentValue = $this->max_market->FormValue;
        $this->skor_pelangganloyal->CurrentValue = $this->skor_pelangganloyal->FormValue;
        $this->max_pelangganloyal->CurrentValue = $this->max_pelangganloyal->FormValue;
        $this->skor_pameranmandiri->CurrentValue = $this->skor_pameranmandiri->FormValue;
        $this->max_pameranmandiri->CurrentValue = $this->max_pameranmandiri->FormValue;
        $this->skor_mediaoffline->CurrentValue = $this->skor_mediaoffline->FormValue;
        $this->max_mediaoffline->CurrentValue = $this->max_mediaoffline->FormValue;
        $this->skor_pemasaran->CurrentValue = $this->skor_pemasaran->FormValue;
        $this->maxskor_pemasaran->CurrentValue = $this->maxskor_pemasaran->FormValue;
        $this->bobot_pemasaran->CurrentValue = $this->bobot_pemasaran->FormValue;
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
        $this->skor_unggul->setDbValue($row['skor_unggul']);
        $this->max_unggul->setDbValue($row['max_unggul']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_available->setDbValue($row['skor_available']);
        $this->max_available->setDbValue($row['max_available']);
        $this->skor_merk->setDbValue($row['skor_merk']);
        $this->max_merk->setDbValue($row['max_merk']);
        $this->skor_merkhaki->setDbValue($row['skor_merkhaki']);
        $this->max_merkhaki->setDbValue($row['max_merkhaki']);
        $this->skor_merkkonsep->setDbValue($row['skor_merkkonsep']);
        $this->max_merkkonsep->setDbValue($row['max_merkkonsep']);
        $this->skor_merklisensi->setDbValue($row['skor_merklisensi']);
        $this->max_merklisensi->setDbValue($row['max_merklisensi']);
        $this->skor_mitra->setDbValue($row['skor_mitra']);
        $this->max_mitra->setDbValue($row['max_mitra']);
        $this->skor_market->setDbValue($row['skor_market']);
        $this->max_market->setDbValue($row['max_market']);
        $this->skor_pelangganloyal->setDbValue($row['skor_pelangganloyal']);
        $this->max_pelangganloyal->setDbValue($row['max_pelangganloyal']);
        $this->skor_pameranmandiri->setDbValue($row['skor_pameranmandiri']);
        $this->max_pameranmandiri->setDbValue($row['max_pameranmandiri']);
        $this->skor_mediaoffline->setDbValue($row['skor_mediaoffline']);
        $this->max_mediaoffline->setDbValue($row['max_mediaoffline']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_unggul'] = null;
        $row['max_unggul'] = null;
        $row['skor_target'] = null;
        $row['max_target'] = null;
        $row['skor_available'] = null;
        $row['max_available'] = null;
        $row['skor_merk'] = null;
        $row['max_merk'] = null;
        $row['skor_merkhaki'] = null;
        $row['max_merkhaki'] = null;
        $row['skor_merkkonsep'] = null;
        $row['max_merkkonsep'] = null;
        $row['skor_merklisensi'] = null;
        $row['max_merklisensi'] = null;
        $row['skor_mitra'] = null;
        $row['max_mitra'] = null;
        $row['skor_market'] = null;
        $row['max_market'] = null;
        $row['skor_pelangganloyal'] = null;
        $row['max_pelangganloyal'] = null;
        $row['skor_pameranmandiri'] = null;
        $row['max_pameranmandiri'] = null;
        $row['skor_mediaoffline'] = null;
        $row['max_mediaoffline'] = null;
        $row['skor_pemasaran'] = null;
        $row['maxskor_pemasaran'] = null;
        $row['bobot_pemasaran'] = null;
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
        if ($this->skor_unggul->FormValue == $this->skor_unggul->CurrentValue && is_numeric(ConvertToFloatString($this->skor_unggul->CurrentValue))) {
            $this->skor_unggul->CurrentValue = ConvertToFloatString($this->skor_unggul->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_unggul->FormValue == $this->max_unggul->CurrentValue && is_numeric(ConvertToFloatString($this->max_unggul->CurrentValue))) {
            $this->max_unggul->CurrentValue = ConvertToFloatString($this->max_unggul->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_target->FormValue == $this->skor_target->CurrentValue && is_numeric(ConvertToFloatString($this->skor_target->CurrentValue))) {
            $this->skor_target->CurrentValue = ConvertToFloatString($this->skor_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_target->FormValue == $this->max_target->CurrentValue && is_numeric(ConvertToFloatString($this->max_target->CurrentValue))) {
            $this->max_target->CurrentValue = ConvertToFloatString($this->max_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_available->FormValue == $this->skor_available->CurrentValue && is_numeric(ConvertToFloatString($this->skor_available->CurrentValue))) {
            $this->skor_available->CurrentValue = ConvertToFloatString($this->skor_available->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_available->FormValue == $this->max_available->CurrentValue && is_numeric(ConvertToFloatString($this->max_available->CurrentValue))) {
            $this->max_available->CurrentValue = ConvertToFloatString($this->max_available->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merk->FormValue == $this->skor_merk->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merk->CurrentValue))) {
            $this->skor_merk->CurrentValue = ConvertToFloatString($this->skor_merk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merk->FormValue == $this->max_merk->CurrentValue && is_numeric(ConvertToFloatString($this->max_merk->CurrentValue))) {
            $this->max_merk->CurrentValue = ConvertToFloatString($this->max_merk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merkhaki->FormValue == $this->skor_merkhaki->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merkhaki->CurrentValue))) {
            $this->skor_merkhaki->CurrentValue = ConvertToFloatString($this->skor_merkhaki->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merkhaki->FormValue == $this->max_merkhaki->CurrentValue && is_numeric(ConvertToFloatString($this->max_merkhaki->CurrentValue))) {
            $this->max_merkhaki->CurrentValue = ConvertToFloatString($this->max_merkhaki->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merkkonsep->FormValue == $this->skor_merkkonsep->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merkkonsep->CurrentValue))) {
            $this->skor_merkkonsep->CurrentValue = ConvertToFloatString($this->skor_merkkonsep->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merkkonsep->FormValue == $this->max_merkkonsep->CurrentValue && is_numeric(ConvertToFloatString($this->max_merkkonsep->CurrentValue))) {
            $this->max_merkkonsep->CurrentValue = ConvertToFloatString($this->max_merkkonsep->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merklisensi->FormValue == $this->skor_merklisensi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merklisensi->CurrentValue))) {
            $this->skor_merklisensi->CurrentValue = ConvertToFloatString($this->skor_merklisensi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merklisensi->FormValue == $this->max_merklisensi->CurrentValue && is_numeric(ConvertToFloatString($this->max_merklisensi->CurrentValue))) {
            $this->max_merklisensi->CurrentValue = ConvertToFloatString($this->max_merklisensi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mitra->FormValue == $this->skor_mitra->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mitra->CurrentValue))) {
            $this->skor_mitra->CurrentValue = ConvertToFloatString($this->skor_mitra->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mitra->FormValue == $this->max_mitra->CurrentValue && is_numeric(ConvertToFloatString($this->max_mitra->CurrentValue))) {
            $this->max_mitra->CurrentValue = ConvertToFloatString($this->max_mitra->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_market->FormValue == $this->skor_market->CurrentValue && is_numeric(ConvertToFloatString($this->skor_market->CurrentValue))) {
            $this->skor_market->CurrentValue = ConvertToFloatString($this->skor_market->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_market->FormValue == $this->max_market->CurrentValue && is_numeric(ConvertToFloatString($this->max_market->CurrentValue))) {
            $this->max_market->CurrentValue = ConvertToFloatString($this->max_market->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pelangganloyal->FormValue == $this->skor_pelangganloyal->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pelangganloyal->CurrentValue))) {
            $this->skor_pelangganloyal->CurrentValue = ConvertToFloatString($this->skor_pelangganloyal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pelangganloyal->FormValue == $this->max_pelangganloyal->CurrentValue && is_numeric(ConvertToFloatString($this->max_pelangganloyal->CurrentValue))) {
            $this->max_pelangganloyal->CurrentValue = ConvertToFloatString($this->max_pelangganloyal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pameranmandiri->FormValue == $this->skor_pameranmandiri->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pameranmandiri->CurrentValue))) {
            $this->skor_pameranmandiri->CurrentValue = ConvertToFloatString($this->skor_pameranmandiri->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pameranmandiri->FormValue == $this->max_pameranmandiri->CurrentValue && is_numeric(ConvertToFloatString($this->max_pameranmandiri->CurrentValue))) {
            $this->max_pameranmandiri->CurrentValue = ConvertToFloatString($this->max_pameranmandiri->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mediaoffline->FormValue == $this->skor_mediaoffline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mediaoffline->CurrentValue))) {
            $this->skor_mediaoffline->CurrentValue = ConvertToFloatString($this->skor_mediaoffline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mediaoffline->FormValue == $this->max_mediaoffline->CurrentValue && is_numeric(ConvertToFloatString($this->max_mediaoffline->CurrentValue))) {
            $this->max_mediaoffline->CurrentValue = ConvertToFloatString($this->max_mediaoffline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaran->FormValue == $this->skor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaran->CurrentValue))) {
            $this->skor_pemasaran->CurrentValue = ConvertToFloatString($this->skor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaran->FormValue == $this->maxskor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaran->CurrentValue))) {
            $this->maxskor_pemasaran->CurrentValue = ConvertToFloatString($this->maxskor_pemasaran->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_unggul

        // max_unggul

        // skor_target

        // max_target

        // skor_available

        // max_available

        // skor_merk

        // max_merk

        // skor_merkhaki

        // max_merkhaki

        // skor_merkkonsep

        // max_merkkonsep

        // skor_merklisensi

        // max_merklisensi

        // skor_mitra

        // max_mitra

        // skor_market

        // max_market

        // skor_pelangganloyal

        // max_pelangganloyal

        // skor_pameranmandiri

        // max_pameranmandiri

        // skor_mediaoffline

        // max_mediaoffline

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_unggul
            $this->skor_unggul->ViewValue = $this->skor_unggul->CurrentValue;
            $this->skor_unggul->ViewValue = FormatNumber($this->skor_unggul->ViewValue, 2, -2, -2, -2);
            $this->skor_unggul->ViewCustomAttributes = "";

            // max_unggul
            $this->max_unggul->ViewValue = $this->max_unggul->CurrentValue;
            $this->max_unggul->ViewValue = FormatNumber($this->max_unggul->ViewValue, 2, -2, -2, -2);
            $this->max_unggul->ViewCustomAttributes = "";

            // skor_target
            $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
            $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
            $this->skor_target->ViewCustomAttributes = "";

            // max_target
            $this->max_target->ViewValue = $this->max_target->CurrentValue;
            $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
            $this->max_target->ViewCustomAttributes = "";

            // skor_available
            $this->skor_available->ViewValue = $this->skor_available->CurrentValue;
            $this->skor_available->ViewValue = FormatNumber($this->skor_available->ViewValue, 2, -2, -2, -2);
            $this->skor_available->ViewCustomAttributes = "";

            // max_available
            $this->max_available->ViewValue = $this->max_available->CurrentValue;
            $this->max_available->ViewValue = FormatNumber($this->max_available->ViewValue, 2, -2, -2, -2);
            $this->max_available->ViewCustomAttributes = "";

            // skor_merk
            $this->skor_merk->ViewValue = $this->skor_merk->CurrentValue;
            $this->skor_merk->ViewValue = FormatNumber($this->skor_merk->ViewValue, 2, -2, -2, -2);
            $this->skor_merk->ViewCustomAttributes = "";

            // max_merk
            $this->max_merk->ViewValue = $this->max_merk->CurrentValue;
            $this->max_merk->ViewValue = FormatNumber($this->max_merk->ViewValue, 2, -2, -2, -2);
            $this->max_merk->ViewCustomAttributes = "";

            // skor_merkhaki
            $this->skor_merkhaki->ViewValue = $this->skor_merkhaki->CurrentValue;
            $this->skor_merkhaki->ViewValue = FormatNumber($this->skor_merkhaki->ViewValue, 2, -2, -2, -2);
            $this->skor_merkhaki->ViewCustomAttributes = "";

            // max_merkhaki
            $this->max_merkhaki->ViewValue = $this->max_merkhaki->CurrentValue;
            $this->max_merkhaki->ViewValue = FormatNumber($this->max_merkhaki->ViewValue, 2, -2, -2, -2);
            $this->max_merkhaki->ViewCustomAttributes = "";

            // skor_merkkonsep
            $this->skor_merkkonsep->ViewValue = $this->skor_merkkonsep->CurrentValue;
            $this->skor_merkkonsep->ViewValue = FormatNumber($this->skor_merkkonsep->ViewValue, 2, -2, -2, -2);
            $this->skor_merkkonsep->ViewCustomAttributes = "";

            // max_merkkonsep
            $this->max_merkkonsep->ViewValue = $this->max_merkkonsep->CurrentValue;
            $this->max_merkkonsep->ViewValue = FormatNumber($this->max_merkkonsep->ViewValue, 2, -2, -2, -2);
            $this->max_merkkonsep->ViewCustomAttributes = "";

            // skor_merklisensi
            $this->skor_merklisensi->ViewValue = $this->skor_merklisensi->CurrentValue;
            $this->skor_merklisensi->ViewValue = FormatNumber($this->skor_merklisensi->ViewValue, 2, -2, -2, -2);
            $this->skor_merklisensi->ViewCustomAttributes = "";

            // max_merklisensi
            $this->max_merklisensi->ViewValue = $this->max_merklisensi->CurrentValue;
            $this->max_merklisensi->ViewValue = FormatNumber($this->max_merklisensi->ViewValue, 2, -2, -2, -2);
            $this->max_merklisensi->ViewCustomAttributes = "";

            // skor_mitra
            $this->skor_mitra->ViewValue = $this->skor_mitra->CurrentValue;
            $this->skor_mitra->ViewValue = FormatNumber($this->skor_mitra->ViewValue, 2, -2, -2, -2);
            $this->skor_mitra->ViewCustomAttributes = "";

            // max_mitra
            $this->max_mitra->ViewValue = $this->max_mitra->CurrentValue;
            $this->max_mitra->ViewValue = FormatNumber($this->max_mitra->ViewValue, 2, -2, -2, -2);
            $this->max_mitra->ViewCustomAttributes = "";

            // skor_market
            $this->skor_market->ViewValue = $this->skor_market->CurrentValue;
            $this->skor_market->ViewValue = FormatNumber($this->skor_market->ViewValue, 2, -2, -2, -2);
            $this->skor_market->ViewCustomAttributes = "";

            // max_market
            $this->max_market->ViewValue = $this->max_market->CurrentValue;
            $this->max_market->ViewValue = FormatNumber($this->max_market->ViewValue, 2, -2, -2, -2);
            $this->max_market->ViewCustomAttributes = "";

            // skor_pelangganloyal
            $this->skor_pelangganloyal->ViewValue = $this->skor_pelangganloyal->CurrentValue;
            $this->skor_pelangganloyal->ViewValue = FormatNumber($this->skor_pelangganloyal->ViewValue, 2, -2, -2, -2);
            $this->skor_pelangganloyal->ViewCustomAttributes = "";

            // max_pelangganloyal
            $this->max_pelangganloyal->ViewValue = $this->max_pelangganloyal->CurrentValue;
            $this->max_pelangganloyal->ViewValue = FormatNumber($this->max_pelangganloyal->ViewValue, 2, -2, -2, -2);
            $this->max_pelangganloyal->ViewCustomAttributes = "";

            // skor_pameranmandiri
            $this->skor_pameranmandiri->ViewValue = $this->skor_pameranmandiri->CurrentValue;
            $this->skor_pameranmandiri->ViewValue = FormatNumber($this->skor_pameranmandiri->ViewValue, 2, -2, -2, -2);
            $this->skor_pameranmandiri->ViewCustomAttributes = "";

            // max_pameranmandiri
            $this->max_pameranmandiri->ViewValue = $this->max_pameranmandiri->CurrentValue;
            $this->max_pameranmandiri->ViewValue = FormatNumber($this->max_pameranmandiri->ViewValue, 2, -2, -2, -2);
            $this->max_pameranmandiri->ViewCustomAttributes = "";

            // skor_mediaoffline
            $this->skor_mediaoffline->ViewValue = $this->skor_mediaoffline->CurrentValue;
            $this->skor_mediaoffline->ViewValue = FormatNumber($this->skor_mediaoffline->ViewValue, 2, -2, -2, -2);
            $this->skor_mediaoffline->ViewCustomAttributes = "";

            // max_mediaoffline
            $this->max_mediaoffline->ViewValue = $this->max_mediaoffline->CurrentValue;
            $this->max_mediaoffline->ViewValue = FormatNumber($this->max_mediaoffline->ViewValue, 2, -2, -2, -2);
            $this->max_mediaoffline->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_unggul
            $this->skor_unggul->LinkCustomAttributes = "";
            $this->skor_unggul->HrefValue = "";
            $this->skor_unggul->TooltipValue = "";

            // max_unggul
            $this->max_unggul->LinkCustomAttributes = "";
            $this->max_unggul->HrefValue = "";
            $this->max_unggul->TooltipValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";
            $this->skor_target->TooltipValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";
            $this->max_target->TooltipValue = "";

            // skor_available
            $this->skor_available->LinkCustomAttributes = "";
            $this->skor_available->HrefValue = "";
            $this->skor_available->TooltipValue = "";

            // max_available
            $this->max_available->LinkCustomAttributes = "";
            $this->max_available->HrefValue = "";
            $this->max_available->TooltipValue = "";

            // skor_merk
            $this->skor_merk->LinkCustomAttributes = "";
            $this->skor_merk->HrefValue = "";
            $this->skor_merk->TooltipValue = "";

            // max_merk
            $this->max_merk->LinkCustomAttributes = "";
            $this->max_merk->HrefValue = "";
            $this->max_merk->TooltipValue = "";

            // skor_merkhaki
            $this->skor_merkhaki->LinkCustomAttributes = "";
            $this->skor_merkhaki->HrefValue = "";
            $this->skor_merkhaki->TooltipValue = "";

            // max_merkhaki
            $this->max_merkhaki->LinkCustomAttributes = "";
            $this->max_merkhaki->HrefValue = "";
            $this->max_merkhaki->TooltipValue = "";

            // skor_merkkonsep
            $this->skor_merkkonsep->LinkCustomAttributes = "";
            $this->skor_merkkonsep->HrefValue = "";
            $this->skor_merkkonsep->TooltipValue = "";

            // max_merkkonsep
            $this->max_merkkonsep->LinkCustomAttributes = "";
            $this->max_merkkonsep->HrefValue = "";
            $this->max_merkkonsep->TooltipValue = "";

            // skor_merklisensi
            $this->skor_merklisensi->LinkCustomAttributes = "";
            $this->skor_merklisensi->HrefValue = "";
            $this->skor_merklisensi->TooltipValue = "";

            // max_merklisensi
            $this->max_merklisensi->LinkCustomAttributes = "";
            $this->max_merklisensi->HrefValue = "";
            $this->max_merklisensi->TooltipValue = "";

            // skor_mitra
            $this->skor_mitra->LinkCustomAttributes = "";
            $this->skor_mitra->HrefValue = "";
            $this->skor_mitra->TooltipValue = "";

            // max_mitra
            $this->max_mitra->LinkCustomAttributes = "";
            $this->max_mitra->HrefValue = "";
            $this->max_mitra->TooltipValue = "";

            // skor_market
            $this->skor_market->LinkCustomAttributes = "";
            $this->skor_market->HrefValue = "";
            $this->skor_market->TooltipValue = "";

            // max_market
            $this->max_market->LinkCustomAttributes = "";
            $this->max_market->HrefValue = "";
            $this->max_market->TooltipValue = "";

            // skor_pelangganloyal
            $this->skor_pelangganloyal->LinkCustomAttributes = "";
            $this->skor_pelangganloyal->HrefValue = "";
            $this->skor_pelangganloyal->TooltipValue = "";

            // max_pelangganloyal
            $this->max_pelangganloyal->LinkCustomAttributes = "";
            $this->max_pelangganloyal->HrefValue = "";
            $this->max_pelangganloyal->TooltipValue = "";

            // skor_pameranmandiri
            $this->skor_pameranmandiri->LinkCustomAttributes = "";
            $this->skor_pameranmandiri->HrefValue = "";
            $this->skor_pameranmandiri->TooltipValue = "";

            // max_pameranmandiri
            $this->max_pameranmandiri->LinkCustomAttributes = "";
            $this->max_pameranmandiri->HrefValue = "";
            $this->max_pameranmandiri->TooltipValue = "";

            // skor_mediaoffline
            $this->skor_mediaoffline->LinkCustomAttributes = "";
            $this->skor_mediaoffline->HrefValue = "";
            $this->skor_mediaoffline->TooltipValue = "";

            // max_mediaoffline
            $this->max_mediaoffline->LinkCustomAttributes = "";
            $this->max_mediaoffline->HrefValue = "";
            $this->max_mediaoffline->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // skor_unggul
            $this->skor_unggul->EditAttrs["class"] = "form-control";
            $this->skor_unggul->EditCustomAttributes = "";
            $this->skor_unggul->EditValue = HtmlEncode($this->skor_unggul->CurrentValue);
            $this->skor_unggul->PlaceHolder = RemoveHtml($this->skor_unggul->caption());
            if (strval($this->skor_unggul->EditValue) != "" && is_numeric($this->skor_unggul->EditValue)) {
                $this->skor_unggul->EditValue = FormatNumber($this->skor_unggul->EditValue, -2, -2, -2, -2);
            }

            // max_unggul
            $this->max_unggul->EditAttrs["class"] = "form-control";
            $this->max_unggul->EditCustomAttributes = "";
            $this->max_unggul->EditValue = HtmlEncode($this->max_unggul->CurrentValue);
            $this->max_unggul->PlaceHolder = RemoveHtml($this->max_unggul->caption());
            if (strval($this->max_unggul->EditValue) != "" && is_numeric($this->max_unggul->EditValue)) {
                $this->max_unggul->EditValue = FormatNumber($this->max_unggul->EditValue, -2, -2, -2, -2);
            }

            // skor_target
            $this->skor_target->EditAttrs["class"] = "form-control";
            $this->skor_target->EditCustomAttributes = "";
            $this->skor_target->EditValue = HtmlEncode($this->skor_target->CurrentValue);
            $this->skor_target->PlaceHolder = RemoveHtml($this->skor_target->caption());
            if (strval($this->skor_target->EditValue) != "" && is_numeric($this->skor_target->EditValue)) {
                $this->skor_target->EditValue = FormatNumber($this->skor_target->EditValue, -2, -2, -2, -2);
            }

            // max_target
            $this->max_target->EditAttrs["class"] = "form-control";
            $this->max_target->EditCustomAttributes = "";
            $this->max_target->EditValue = HtmlEncode($this->max_target->CurrentValue);
            $this->max_target->PlaceHolder = RemoveHtml($this->max_target->caption());
            if (strval($this->max_target->EditValue) != "" && is_numeric($this->max_target->EditValue)) {
                $this->max_target->EditValue = FormatNumber($this->max_target->EditValue, -2, -2, -2, -2);
            }

            // skor_available
            $this->skor_available->EditAttrs["class"] = "form-control";
            $this->skor_available->EditCustomAttributes = "";
            $this->skor_available->EditValue = HtmlEncode($this->skor_available->CurrentValue);
            $this->skor_available->PlaceHolder = RemoveHtml($this->skor_available->caption());
            if (strval($this->skor_available->EditValue) != "" && is_numeric($this->skor_available->EditValue)) {
                $this->skor_available->EditValue = FormatNumber($this->skor_available->EditValue, -2, -2, -2, -2);
            }

            // max_available
            $this->max_available->EditAttrs["class"] = "form-control";
            $this->max_available->EditCustomAttributes = "";
            $this->max_available->EditValue = HtmlEncode($this->max_available->CurrentValue);
            $this->max_available->PlaceHolder = RemoveHtml($this->max_available->caption());
            if (strval($this->max_available->EditValue) != "" && is_numeric($this->max_available->EditValue)) {
                $this->max_available->EditValue = FormatNumber($this->max_available->EditValue, -2, -2, -2, -2);
            }

            // skor_merk
            $this->skor_merk->EditAttrs["class"] = "form-control";
            $this->skor_merk->EditCustomAttributes = "";
            $this->skor_merk->EditValue = HtmlEncode($this->skor_merk->CurrentValue);
            $this->skor_merk->PlaceHolder = RemoveHtml($this->skor_merk->caption());
            if (strval($this->skor_merk->EditValue) != "" && is_numeric($this->skor_merk->EditValue)) {
                $this->skor_merk->EditValue = FormatNumber($this->skor_merk->EditValue, -2, -2, -2, -2);
            }

            // max_merk
            $this->max_merk->EditAttrs["class"] = "form-control";
            $this->max_merk->EditCustomAttributes = "";
            $this->max_merk->EditValue = HtmlEncode($this->max_merk->CurrentValue);
            $this->max_merk->PlaceHolder = RemoveHtml($this->max_merk->caption());
            if (strval($this->max_merk->EditValue) != "" && is_numeric($this->max_merk->EditValue)) {
                $this->max_merk->EditValue = FormatNumber($this->max_merk->EditValue, -2, -2, -2, -2);
            }

            // skor_merkhaki
            $this->skor_merkhaki->EditAttrs["class"] = "form-control";
            $this->skor_merkhaki->EditCustomAttributes = "";
            $this->skor_merkhaki->EditValue = HtmlEncode($this->skor_merkhaki->CurrentValue);
            $this->skor_merkhaki->PlaceHolder = RemoveHtml($this->skor_merkhaki->caption());
            if (strval($this->skor_merkhaki->EditValue) != "" && is_numeric($this->skor_merkhaki->EditValue)) {
                $this->skor_merkhaki->EditValue = FormatNumber($this->skor_merkhaki->EditValue, -2, -2, -2, -2);
            }

            // max_merkhaki
            $this->max_merkhaki->EditAttrs["class"] = "form-control";
            $this->max_merkhaki->EditCustomAttributes = "";
            $this->max_merkhaki->EditValue = HtmlEncode($this->max_merkhaki->CurrentValue);
            $this->max_merkhaki->PlaceHolder = RemoveHtml($this->max_merkhaki->caption());
            if (strval($this->max_merkhaki->EditValue) != "" && is_numeric($this->max_merkhaki->EditValue)) {
                $this->max_merkhaki->EditValue = FormatNumber($this->max_merkhaki->EditValue, -2, -2, -2, -2);
            }

            // skor_merkkonsep
            $this->skor_merkkonsep->EditAttrs["class"] = "form-control";
            $this->skor_merkkonsep->EditCustomAttributes = "";
            $this->skor_merkkonsep->EditValue = HtmlEncode($this->skor_merkkonsep->CurrentValue);
            $this->skor_merkkonsep->PlaceHolder = RemoveHtml($this->skor_merkkonsep->caption());
            if (strval($this->skor_merkkonsep->EditValue) != "" && is_numeric($this->skor_merkkonsep->EditValue)) {
                $this->skor_merkkonsep->EditValue = FormatNumber($this->skor_merkkonsep->EditValue, -2, -2, -2, -2);
            }

            // max_merkkonsep
            $this->max_merkkonsep->EditAttrs["class"] = "form-control";
            $this->max_merkkonsep->EditCustomAttributes = "";
            $this->max_merkkonsep->EditValue = HtmlEncode($this->max_merkkonsep->CurrentValue);
            $this->max_merkkonsep->PlaceHolder = RemoveHtml($this->max_merkkonsep->caption());
            if (strval($this->max_merkkonsep->EditValue) != "" && is_numeric($this->max_merkkonsep->EditValue)) {
                $this->max_merkkonsep->EditValue = FormatNumber($this->max_merkkonsep->EditValue, -2, -2, -2, -2);
            }

            // skor_merklisensi
            $this->skor_merklisensi->EditAttrs["class"] = "form-control";
            $this->skor_merklisensi->EditCustomAttributes = "";
            $this->skor_merklisensi->EditValue = HtmlEncode($this->skor_merklisensi->CurrentValue);
            $this->skor_merklisensi->PlaceHolder = RemoveHtml($this->skor_merklisensi->caption());
            if (strval($this->skor_merklisensi->EditValue) != "" && is_numeric($this->skor_merklisensi->EditValue)) {
                $this->skor_merklisensi->EditValue = FormatNumber($this->skor_merklisensi->EditValue, -2, -2, -2, -2);
            }

            // max_merklisensi
            $this->max_merklisensi->EditAttrs["class"] = "form-control";
            $this->max_merklisensi->EditCustomAttributes = "";
            $this->max_merklisensi->EditValue = HtmlEncode($this->max_merklisensi->CurrentValue);
            $this->max_merklisensi->PlaceHolder = RemoveHtml($this->max_merklisensi->caption());
            if (strval($this->max_merklisensi->EditValue) != "" && is_numeric($this->max_merklisensi->EditValue)) {
                $this->max_merklisensi->EditValue = FormatNumber($this->max_merklisensi->EditValue, -2, -2, -2, -2);
            }

            // skor_mitra
            $this->skor_mitra->EditAttrs["class"] = "form-control";
            $this->skor_mitra->EditCustomAttributes = "";
            $this->skor_mitra->EditValue = HtmlEncode($this->skor_mitra->CurrentValue);
            $this->skor_mitra->PlaceHolder = RemoveHtml($this->skor_mitra->caption());
            if (strval($this->skor_mitra->EditValue) != "" && is_numeric($this->skor_mitra->EditValue)) {
                $this->skor_mitra->EditValue = FormatNumber($this->skor_mitra->EditValue, -2, -2, -2, -2);
            }

            // max_mitra
            $this->max_mitra->EditAttrs["class"] = "form-control";
            $this->max_mitra->EditCustomAttributes = "";
            $this->max_mitra->EditValue = HtmlEncode($this->max_mitra->CurrentValue);
            $this->max_mitra->PlaceHolder = RemoveHtml($this->max_mitra->caption());
            if (strval($this->max_mitra->EditValue) != "" && is_numeric($this->max_mitra->EditValue)) {
                $this->max_mitra->EditValue = FormatNumber($this->max_mitra->EditValue, -2, -2, -2, -2);
            }

            // skor_market
            $this->skor_market->EditAttrs["class"] = "form-control";
            $this->skor_market->EditCustomAttributes = "";
            $this->skor_market->EditValue = HtmlEncode($this->skor_market->CurrentValue);
            $this->skor_market->PlaceHolder = RemoveHtml($this->skor_market->caption());
            if (strval($this->skor_market->EditValue) != "" && is_numeric($this->skor_market->EditValue)) {
                $this->skor_market->EditValue = FormatNumber($this->skor_market->EditValue, -2, -2, -2, -2);
            }

            // max_market
            $this->max_market->EditAttrs["class"] = "form-control";
            $this->max_market->EditCustomAttributes = "";
            $this->max_market->EditValue = HtmlEncode($this->max_market->CurrentValue);
            $this->max_market->PlaceHolder = RemoveHtml($this->max_market->caption());
            if (strval($this->max_market->EditValue) != "" && is_numeric($this->max_market->EditValue)) {
                $this->max_market->EditValue = FormatNumber($this->max_market->EditValue, -2, -2, -2, -2);
            }

            // skor_pelangganloyal
            $this->skor_pelangganloyal->EditAttrs["class"] = "form-control";
            $this->skor_pelangganloyal->EditCustomAttributes = "";
            $this->skor_pelangganloyal->EditValue = HtmlEncode($this->skor_pelangganloyal->CurrentValue);
            $this->skor_pelangganloyal->PlaceHolder = RemoveHtml($this->skor_pelangganloyal->caption());
            if (strval($this->skor_pelangganloyal->EditValue) != "" && is_numeric($this->skor_pelangganloyal->EditValue)) {
                $this->skor_pelangganloyal->EditValue = FormatNumber($this->skor_pelangganloyal->EditValue, -2, -2, -2, -2);
            }

            // max_pelangganloyal
            $this->max_pelangganloyal->EditAttrs["class"] = "form-control";
            $this->max_pelangganloyal->EditCustomAttributes = "";
            $this->max_pelangganloyal->EditValue = HtmlEncode($this->max_pelangganloyal->CurrentValue);
            $this->max_pelangganloyal->PlaceHolder = RemoveHtml($this->max_pelangganloyal->caption());
            if (strval($this->max_pelangganloyal->EditValue) != "" && is_numeric($this->max_pelangganloyal->EditValue)) {
                $this->max_pelangganloyal->EditValue = FormatNumber($this->max_pelangganloyal->EditValue, -2, -2, -2, -2);
            }

            // skor_pameranmandiri
            $this->skor_pameranmandiri->EditAttrs["class"] = "form-control";
            $this->skor_pameranmandiri->EditCustomAttributes = "";
            $this->skor_pameranmandiri->EditValue = HtmlEncode($this->skor_pameranmandiri->CurrentValue);
            $this->skor_pameranmandiri->PlaceHolder = RemoveHtml($this->skor_pameranmandiri->caption());
            if (strval($this->skor_pameranmandiri->EditValue) != "" && is_numeric($this->skor_pameranmandiri->EditValue)) {
                $this->skor_pameranmandiri->EditValue = FormatNumber($this->skor_pameranmandiri->EditValue, -2, -2, -2, -2);
            }

            // max_pameranmandiri
            $this->max_pameranmandiri->EditAttrs["class"] = "form-control";
            $this->max_pameranmandiri->EditCustomAttributes = "";
            $this->max_pameranmandiri->EditValue = HtmlEncode($this->max_pameranmandiri->CurrentValue);
            $this->max_pameranmandiri->PlaceHolder = RemoveHtml($this->max_pameranmandiri->caption());
            if (strval($this->max_pameranmandiri->EditValue) != "" && is_numeric($this->max_pameranmandiri->EditValue)) {
                $this->max_pameranmandiri->EditValue = FormatNumber($this->max_pameranmandiri->EditValue, -2, -2, -2, -2);
            }

            // skor_mediaoffline
            $this->skor_mediaoffline->EditAttrs["class"] = "form-control";
            $this->skor_mediaoffline->EditCustomAttributes = "";
            $this->skor_mediaoffline->EditValue = HtmlEncode($this->skor_mediaoffline->CurrentValue);
            $this->skor_mediaoffline->PlaceHolder = RemoveHtml($this->skor_mediaoffline->caption());
            if (strval($this->skor_mediaoffline->EditValue) != "" && is_numeric($this->skor_mediaoffline->EditValue)) {
                $this->skor_mediaoffline->EditValue = FormatNumber($this->skor_mediaoffline->EditValue, -2, -2, -2, -2);
            }

            // max_mediaoffline
            $this->max_mediaoffline->EditAttrs["class"] = "form-control";
            $this->max_mediaoffline->EditCustomAttributes = "";
            $this->max_mediaoffline->EditValue = HtmlEncode($this->max_mediaoffline->CurrentValue);
            $this->max_mediaoffline->PlaceHolder = RemoveHtml($this->max_mediaoffline->caption());
            if (strval($this->max_mediaoffline->EditValue) != "" && is_numeric($this->max_mediaoffline->EditValue)) {
                $this->max_mediaoffline->EditValue = FormatNumber($this->max_mediaoffline->EditValue, -2, -2, -2, -2);
            }

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

            // Edit refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // skor_unggul
            $this->skor_unggul->LinkCustomAttributes = "";
            $this->skor_unggul->HrefValue = "";

            // max_unggul
            $this->max_unggul->LinkCustomAttributes = "";
            $this->max_unggul->HrefValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";

            // skor_available
            $this->skor_available->LinkCustomAttributes = "";
            $this->skor_available->HrefValue = "";

            // max_available
            $this->max_available->LinkCustomAttributes = "";
            $this->max_available->HrefValue = "";

            // skor_merk
            $this->skor_merk->LinkCustomAttributes = "";
            $this->skor_merk->HrefValue = "";

            // max_merk
            $this->max_merk->LinkCustomAttributes = "";
            $this->max_merk->HrefValue = "";

            // skor_merkhaki
            $this->skor_merkhaki->LinkCustomAttributes = "";
            $this->skor_merkhaki->HrefValue = "";

            // max_merkhaki
            $this->max_merkhaki->LinkCustomAttributes = "";
            $this->max_merkhaki->HrefValue = "";

            // skor_merkkonsep
            $this->skor_merkkonsep->LinkCustomAttributes = "";
            $this->skor_merkkonsep->HrefValue = "";

            // max_merkkonsep
            $this->max_merkkonsep->LinkCustomAttributes = "";
            $this->max_merkkonsep->HrefValue = "";

            // skor_merklisensi
            $this->skor_merklisensi->LinkCustomAttributes = "";
            $this->skor_merklisensi->HrefValue = "";

            // max_merklisensi
            $this->max_merklisensi->LinkCustomAttributes = "";
            $this->max_merklisensi->HrefValue = "";

            // skor_mitra
            $this->skor_mitra->LinkCustomAttributes = "";
            $this->skor_mitra->HrefValue = "";

            // max_mitra
            $this->max_mitra->LinkCustomAttributes = "";
            $this->max_mitra->HrefValue = "";

            // skor_market
            $this->skor_market->LinkCustomAttributes = "";
            $this->skor_market->HrefValue = "";

            // max_market
            $this->max_market->LinkCustomAttributes = "";
            $this->max_market->HrefValue = "";

            // skor_pelangganloyal
            $this->skor_pelangganloyal->LinkCustomAttributes = "";
            $this->skor_pelangganloyal->HrefValue = "";

            // max_pelangganloyal
            $this->max_pelangganloyal->LinkCustomAttributes = "";
            $this->max_pelangganloyal->HrefValue = "";

            // skor_pameranmandiri
            $this->skor_pameranmandiri->LinkCustomAttributes = "";
            $this->skor_pameranmandiri->HrefValue = "";

            // max_pameranmandiri
            $this->max_pameranmandiri->LinkCustomAttributes = "";
            $this->max_pameranmandiri->HrefValue = "";

            // skor_mediaoffline
            $this->skor_mediaoffline->LinkCustomAttributes = "";
            $this->skor_mediaoffline->HrefValue = "";

            // max_mediaoffline
            $this->max_mediaoffline->LinkCustomAttributes = "";
            $this->max_mediaoffline->HrefValue = "";

            // skor_pemasaran
            $this->skor_pemasaran->LinkCustomAttributes = "";
            $this->skor_pemasaran->HrefValue = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->LinkCustomAttributes = "";
            $this->maxskor_pemasaran->HrefValue = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->LinkCustomAttributes = "";
            $this->bobot_pemasaran->HrefValue = "";
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
        if ($this->skor_unggul->Required) {
            if (!$this->skor_unggul->IsDetailKey && EmptyValue($this->skor_unggul->FormValue)) {
                $this->skor_unggul->addErrorMessage(str_replace("%s", $this->skor_unggul->caption(), $this->skor_unggul->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_unggul->FormValue)) {
            $this->skor_unggul->addErrorMessage($this->skor_unggul->getErrorMessage(false));
        }
        if ($this->max_unggul->Required) {
            if (!$this->max_unggul->IsDetailKey && EmptyValue($this->max_unggul->FormValue)) {
                $this->max_unggul->addErrorMessage(str_replace("%s", $this->max_unggul->caption(), $this->max_unggul->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_unggul->FormValue)) {
            $this->max_unggul->addErrorMessage($this->max_unggul->getErrorMessage(false));
        }
        if ($this->skor_target->Required) {
            if (!$this->skor_target->IsDetailKey && EmptyValue($this->skor_target->FormValue)) {
                $this->skor_target->addErrorMessage(str_replace("%s", $this->skor_target->caption(), $this->skor_target->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_target->FormValue)) {
            $this->skor_target->addErrorMessage($this->skor_target->getErrorMessage(false));
        }
        if ($this->max_target->Required) {
            if (!$this->max_target->IsDetailKey && EmptyValue($this->max_target->FormValue)) {
                $this->max_target->addErrorMessage(str_replace("%s", $this->max_target->caption(), $this->max_target->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_target->FormValue)) {
            $this->max_target->addErrorMessage($this->max_target->getErrorMessage(false));
        }
        if ($this->skor_available->Required) {
            if (!$this->skor_available->IsDetailKey && EmptyValue($this->skor_available->FormValue)) {
                $this->skor_available->addErrorMessage(str_replace("%s", $this->skor_available->caption(), $this->skor_available->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_available->FormValue)) {
            $this->skor_available->addErrorMessage($this->skor_available->getErrorMessage(false));
        }
        if ($this->max_available->Required) {
            if (!$this->max_available->IsDetailKey && EmptyValue($this->max_available->FormValue)) {
                $this->max_available->addErrorMessage(str_replace("%s", $this->max_available->caption(), $this->max_available->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_available->FormValue)) {
            $this->max_available->addErrorMessage($this->max_available->getErrorMessage(false));
        }
        if ($this->skor_merk->Required) {
            if (!$this->skor_merk->IsDetailKey && EmptyValue($this->skor_merk->FormValue)) {
                $this->skor_merk->addErrorMessage(str_replace("%s", $this->skor_merk->caption(), $this->skor_merk->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_merk->FormValue)) {
            $this->skor_merk->addErrorMessage($this->skor_merk->getErrorMessage(false));
        }
        if ($this->max_merk->Required) {
            if (!$this->max_merk->IsDetailKey && EmptyValue($this->max_merk->FormValue)) {
                $this->max_merk->addErrorMessage(str_replace("%s", $this->max_merk->caption(), $this->max_merk->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_merk->FormValue)) {
            $this->max_merk->addErrorMessage($this->max_merk->getErrorMessage(false));
        }
        if ($this->skor_merkhaki->Required) {
            if (!$this->skor_merkhaki->IsDetailKey && EmptyValue($this->skor_merkhaki->FormValue)) {
                $this->skor_merkhaki->addErrorMessage(str_replace("%s", $this->skor_merkhaki->caption(), $this->skor_merkhaki->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_merkhaki->FormValue)) {
            $this->skor_merkhaki->addErrorMessage($this->skor_merkhaki->getErrorMessage(false));
        }
        if ($this->max_merkhaki->Required) {
            if (!$this->max_merkhaki->IsDetailKey && EmptyValue($this->max_merkhaki->FormValue)) {
                $this->max_merkhaki->addErrorMessage(str_replace("%s", $this->max_merkhaki->caption(), $this->max_merkhaki->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_merkhaki->FormValue)) {
            $this->max_merkhaki->addErrorMessage($this->max_merkhaki->getErrorMessage(false));
        }
        if ($this->skor_merkkonsep->Required) {
            if (!$this->skor_merkkonsep->IsDetailKey && EmptyValue($this->skor_merkkonsep->FormValue)) {
                $this->skor_merkkonsep->addErrorMessage(str_replace("%s", $this->skor_merkkonsep->caption(), $this->skor_merkkonsep->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_merkkonsep->FormValue)) {
            $this->skor_merkkonsep->addErrorMessage($this->skor_merkkonsep->getErrorMessage(false));
        }
        if ($this->max_merkkonsep->Required) {
            if (!$this->max_merkkonsep->IsDetailKey && EmptyValue($this->max_merkkonsep->FormValue)) {
                $this->max_merkkonsep->addErrorMessage(str_replace("%s", $this->max_merkkonsep->caption(), $this->max_merkkonsep->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_merkkonsep->FormValue)) {
            $this->max_merkkonsep->addErrorMessage($this->max_merkkonsep->getErrorMessage(false));
        }
        if ($this->skor_merklisensi->Required) {
            if (!$this->skor_merklisensi->IsDetailKey && EmptyValue($this->skor_merklisensi->FormValue)) {
                $this->skor_merklisensi->addErrorMessage(str_replace("%s", $this->skor_merklisensi->caption(), $this->skor_merklisensi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_merklisensi->FormValue)) {
            $this->skor_merklisensi->addErrorMessage($this->skor_merklisensi->getErrorMessage(false));
        }
        if ($this->max_merklisensi->Required) {
            if (!$this->max_merklisensi->IsDetailKey && EmptyValue($this->max_merklisensi->FormValue)) {
                $this->max_merklisensi->addErrorMessage(str_replace("%s", $this->max_merklisensi->caption(), $this->max_merklisensi->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_merklisensi->FormValue)) {
            $this->max_merklisensi->addErrorMessage($this->max_merklisensi->getErrorMessage(false));
        }
        if ($this->skor_mitra->Required) {
            if (!$this->skor_mitra->IsDetailKey && EmptyValue($this->skor_mitra->FormValue)) {
                $this->skor_mitra->addErrorMessage(str_replace("%s", $this->skor_mitra->caption(), $this->skor_mitra->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_mitra->FormValue)) {
            $this->skor_mitra->addErrorMessage($this->skor_mitra->getErrorMessage(false));
        }
        if ($this->max_mitra->Required) {
            if (!$this->max_mitra->IsDetailKey && EmptyValue($this->max_mitra->FormValue)) {
                $this->max_mitra->addErrorMessage(str_replace("%s", $this->max_mitra->caption(), $this->max_mitra->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_mitra->FormValue)) {
            $this->max_mitra->addErrorMessage($this->max_mitra->getErrorMessage(false));
        }
        if ($this->skor_market->Required) {
            if (!$this->skor_market->IsDetailKey && EmptyValue($this->skor_market->FormValue)) {
                $this->skor_market->addErrorMessage(str_replace("%s", $this->skor_market->caption(), $this->skor_market->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_market->FormValue)) {
            $this->skor_market->addErrorMessage($this->skor_market->getErrorMessage(false));
        }
        if ($this->max_market->Required) {
            if (!$this->max_market->IsDetailKey && EmptyValue($this->max_market->FormValue)) {
                $this->max_market->addErrorMessage(str_replace("%s", $this->max_market->caption(), $this->max_market->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_market->FormValue)) {
            $this->max_market->addErrorMessage($this->max_market->getErrorMessage(false));
        }
        if ($this->skor_pelangganloyal->Required) {
            if (!$this->skor_pelangganloyal->IsDetailKey && EmptyValue($this->skor_pelangganloyal->FormValue)) {
                $this->skor_pelangganloyal->addErrorMessage(str_replace("%s", $this->skor_pelangganloyal->caption(), $this->skor_pelangganloyal->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pelangganloyal->FormValue)) {
            $this->skor_pelangganloyal->addErrorMessage($this->skor_pelangganloyal->getErrorMessage(false));
        }
        if ($this->max_pelangganloyal->Required) {
            if (!$this->max_pelangganloyal->IsDetailKey && EmptyValue($this->max_pelangganloyal->FormValue)) {
                $this->max_pelangganloyal->addErrorMessage(str_replace("%s", $this->max_pelangganloyal->caption(), $this->max_pelangganloyal->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_pelangganloyal->FormValue)) {
            $this->max_pelangganloyal->addErrorMessage($this->max_pelangganloyal->getErrorMessage(false));
        }
        if ($this->skor_pameranmandiri->Required) {
            if (!$this->skor_pameranmandiri->IsDetailKey && EmptyValue($this->skor_pameranmandiri->FormValue)) {
                $this->skor_pameranmandiri->addErrorMessage(str_replace("%s", $this->skor_pameranmandiri->caption(), $this->skor_pameranmandiri->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_pameranmandiri->FormValue)) {
            $this->skor_pameranmandiri->addErrorMessage($this->skor_pameranmandiri->getErrorMessage(false));
        }
        if ($this->max_pameranmandiri->Required) {
            if (!$this->max_pameranmandiri->IsDetailKey && EmptyValue($this->max_pameranmandiri->FormValue)) {
                $this->max_pameranmandiri->addErrorMessage(str_replace("%s", $this->max_pameranmandiri->caption(), $this->max_pameranmandiri->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_pameranmandiri->FormValue)) {
            $this->max_pameranmandiri->addErrorMessage($this->max_pameranmandiri->getErrorMessage(false));
        }
        if ($this->skor_mediaoffline->Required) {
            if (!$this->skor_mediaoffline->IsDetailKey && EmptyValue($this->skor_mediaoffline->FormValue)) {
                $this->skor_mediaoffline->addErrorMessage(str_replace("%s", $this->skor_mediaoffline->caption(), $this->skor_mediaoffline->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_mediaoffline->FormValue)) {
            $this->skor_mediaoffline->addErrorMessage($this->skor_mediaoffline->getErrorMessage(false));
        }
        if ($this->max_mediaoffline->Required) {
            if (!$this->max_mediaoffline->IsDetailKey && EmptyValue($this->max_mediaoffline->FormValue)) {
                $this->max_mediaoffline->addErrorMessage(str_replace("%s", $this->max_mediaoffline->caption(), $this->max_mediaoffline->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_mediaoffline->FormValue)) {
            $this->max_mediaoffline->addErrorMessage($this->max_mediaoffline->getErrorMessage(false));
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

            // skor_unggul
            $this->skor_unggul->setDbValueDef($rsnew, $this->skor_unggul->CurrentValue, null, $this->skor_unggul->ReadOnly);

            // max_unggul
            $this->max_unggul->setDbValueDef($rsnew, $this->max_unggul->CurrentValue, null, $this->max_unggul->ReadOnly);

            // skor_target
            $this->skor_target->setDbValueDef($rsnew, $this->skor_target->CurrentValue, null, $this->skor_target->ReadOnly);

            // max_target
            $this->max_target->setDbValueDef($rsnew, $this->max_target->CurrentValue, null, $this->max_target->ReadOnly);

            // skor_available
            $this->skor_available->setDbValueDef($rsnew, $this->skor_available->CurrentValue, null, $this->skor_available->ReadOnly);

            // max_available
            $this->max_available->setDbValueDef($rsnew, $this->max_available->CurrentValue, null, $this->max_available->ReadOnly);

            // skor_merk
            $this->skor_merk->setDbValueDef($rsnew, $this->skor_merk->CurrentValue, null, $this->skor_merk->ReadOnly);

            // max_merk
            $this->max_merk->setDbValueDef($rsnew, $this->max_merk->CurrentValue, null, $this->max_merk->ReadOnly);

            // skor_merkhaki
            $this->skor_merkhaki->setDbValueDef($rsnew, $this->skor_merkhaki->CurrentValue, null, $this->skor_merkhaki->ReadOnly);

            // max_merkhaki
            $this->max_merkhaki->setDbValueDef($rsnew, $this->max_merkhaki->CurrentValue, null, $this->max_merkhaki->ReadOnly);

            // skor_merkkonsep
            $this->skor_merkkonsep->setDbValueDef($rsnew, $this->skor_merkkonsep->CurrentValue, null, $this->skor_merkkonsep->ReadOnly);

            // max_merkkonsep
            $this->max_merkkonsep->setDbValueDef($rsnew, $this->max_merkkonsep->CurrentValue, null, $this->max_merkkonsep->ReadOnly);

            // skor_merklisensi
            $this->skor_merklisensi->setDbValueDef($rsnew, $this->skor_merklisensi->CurrentValue, null, $this->skor_merklisensi->ReadOnly);

            // max_merklisensi
            $this->max_merklisensi->setDbValueDef($rsnew, $this->max_merklisensi->CurrentValue, null, $this->max_merklisensi->ReadOnly);

            // skor_mitra
            $this->skor_mitra->setDbValueDef($rsnew, $this->skor_mitra->CurrentValue, null, $this->skor_mitra->ReadOnly);

            // max_mitra
            $this->max_mitra->setDbValueDef($rsnew, $this->max_mitra->CurrentValue, null, $this->max_mitra->ReadOnly);

            // skor_market
            $this->skor_market->setDbValueDef($rsnew, $this->skor_market->CurrentValue, null, $this->skor_market->ReadOnly);

            // max_market
            $this->max_market->setDbValueDef($rsnew, $this->max_market->CurrentValue, null, $this->max_market->ReadOnly);

            // skor_pelangganloyal
            $this->skor_pelangganloyal->setDbValueDef($rsnew, $this->skor_pelangganloyal->CurrentValue, null, $this->skor_pelangganloyal->ReadOnly);

            // max_pelangganloyal
            $this->max_pelangganloyal->setDbValueDef($rsnew, $this->max_pelangganloyal->CurrentValue, null, $this->max_pelangganloyal->ReadOnly);

            // skor_pameranmandiri
            $this->skor_pameranmandiri->setDbValueDef($rsnew, $this->skor_pameranmandiri->CurrentValue, null, $this->skor_pameranmandiri->ReadOnly);

            // max_pameranmandiri
            $this->max_pameranmandiri->setDbValueDef($rsnew, $this->max_pameranmandiri->CurrentValue, null, $this->max_pameranmandiri->ReadOnly);

            // skor_mediaoffline
            $this->skor_mediaoffline->setDbValueDef($rsnew, $this->skor_mediaoffline->CurrentValue, null, $this->skor_mediaoffline->ReadOnly);

            // max_mediaoffline
            $this->max_mediaoffline->setDbValueDef($rsnew, $this->max_mediaoffline->CurrentValue, null, $this->max_mediaoffline->ReadOnly);

            // skor_pemasaran
            $this->skor_pemasaran->setDbValueDef($rsnew, $this->skor_pemasaran->CurrentValue, null, $this->skor_pemasaran->ReadOnly);

            // maxskor_pemasaran
            $this->maxskor_pemasaran->setDbValueDef($rsnew, $this->maxskor_pemasaran->CurrentValue, null, $this->maxskor_pemasaran->ReadOnly);

            // bobot_pemasaran
            $this->bobot_pemasaran->setDbValueDef($rsnew, $this->bobot_pemasaran->CurrentValue, 0, $this->bobot_pemasaran->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorpemasaranlist"), "", $this->TableVar, true);
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
