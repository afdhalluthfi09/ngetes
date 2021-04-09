<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorPemasaranonlineAdd extends TempSkorPemasaranonline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_pemasaranonline';

    // Page object name
    public $PageObjName = "TempSkorPemasaranonlineAdd";

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

        // Table object (temp_skor_pemasaranonline)
        if (!isset($GLOBALS["temp_skor_pemasaranonline"]) || get_class($GLOBALS["temp_skor_pemasaranonline"]) == PROJECT_NAMESPACE . "temp_skor_pemasaranonline") {
            $GLOBALS["temp_skor_pemasaranonline"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_pemasaranonline');
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
                $doc = new $class(Container("temp_skor_pemasaranonline"));
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
                    if ($pageName == "tempskorpemasaranonlineview") {
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
        $this->chatting->setVisibility();
        $this->skor_chatting->setVisibility();
        $this->max_chatting->setVisibility();
        $this->medsos->setVisibility();
        $this->skor_medsos->setVisibility();
        $this->max_medsos->setVisibility();
        $this->marketplace->setVisibility();
        $this->skor_mp->setVisibility();
        $this->max_mp->setVisibility();
        $this->gmb->setVisibility();
        $this->skor_gmb->setVisibility();
        $this->max_gmb->setVisibility();
        $this->web->setVisibility();
        $this->skor_web->setVisibility();
        $this->max_web->setVisibility();
        $this->updatemedsos->setVisibility();
        $this->skor_updatemedsos->setVisibility();
        $this->max_updatemedsos->setVisibility();
        $this->updateweb->setVisibility();
        $this->skor_updateweb->setVisibility();
        $this->max_updateweb->setVisibility();
        $this->seo->setVisibility();
        $this->skor_seo->setVisibility();
        $this->max_seo->setVisibility();
        $this->iklan->setVisibility();
        $this->skor_iklan->setVisibility();
        $this->max_iklan->setVisibility();
        $this->skor_pemasaranonline->setVisibility();
        $this->maxskor_pemasaranonline->setVisibility();
        $this->bobot_pemasaranonline->setVisibility();
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
                    $this->terminate("tempskorpemasaranonlinelist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "tempskorpemasaranonlinelist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "tempskorpemasaranonlineview") {
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
        $this->chatting->CurrentValue = null;
        $this->chatting->OldValue = $this->chatting->CurrentValue;
        $this->skor_chatting->CurrentValue = null;
        $this->skor_chatting->OldValue = $this->skor_chatting->CurrentValue;
        $this->max_chatting->CurrentValue = null;
        $this->max_chatting->OldValue = $this->max_chatting->CurrentValue;
        $this->medsos->CurrentValue = null;
        $this->medsos->OldValue = $this->medsos->CurrentValue;
        $this->skor_medsos->CurrentValue = null;
        $this->skor_medsos->OldValue = $this->skor_medsos->CurrentValue;
        $this->max_medsos->CurrentValue = null;
        $this->max_medsos->OldValue = $this->max_medsos->CurrentValue;
        $this->marketplace->CurrentValue = null;
        $this->marketplace->OldValue = $this->marketplace->CurrentValue;
        $this->skor_mp->CurrentValue = null;
        $this->skor_mp->OldValue = $this->skor_mp->CurrentValue;
        $this->max_mp->CurrentValue = null;
        $this->max_mp->OldValue = $this->max_mp->CurrentValue;
        $this->gmb->CurrentValue = null;
        $this->gmb->OldValue = $this->gmb->CurrentValue;
        $this->skor_gmb->CurrentValue = null;
        $this->skor_gmb->OldValue = $this->skor_gmb->CurrentValue;
        $this->max_gmb->CurrentValue = null;
        $this->max_gmb->OldValue = $this->max_gmb->CurrentValue;
        $this->web->CurrentValue = null;
        $this->web->OldValue = $this->web->CurrentValue;
        $this->skor_web->CurrentValue = null;
        $this->skor_web->OldValue = $this->skor_web->CurrentValue;
        $this->max_web->CurrentValue = null;
        $this->max_web->OldValue = $this->max_web->CurrentValue;
        $this->updatemedsos->CurrentValue = null;
        $this->updatemedsos->OldValue = $this->updatemedsos->CurrentValue;
        $this->skor_updatemedsos->CurrentValue = null;
        $this->skor_updatemedsos->OldValue = $this->skor_updatemedsos->CurrentValue;
        $this->max_updatemedsos->CurrentValue = null;
        $this->max_updatemedsos->OldValue = $this->max_updatemedsos->CurrentValue;
        $this->updateweb->CurrentValue = null;
        $this->updateweb->OldValue = $this->updateweb->CurrentValue;
        $this->skor_updateweb->CurrentValue = null;
        $this->skor_updateweb->OldValue = $this->skor_updateweb->CurrentValue;
        $this->max_updateweb->CurrentValue = null;
        $this->max_updateweb->OldValue = $this->max_updateweb->CurrentValue;
        $this->seo->CurrentValue = null;
        $this->seo->OldValue = $this->seo->CurrentValue;
        $this->skor_seo->CurrentValue = null;
        $this->skor_seo->OldValue = $this->skor_seo->CurrentValue;
        $this->max_seo->CurrentValue = null;
        $this->max_seo->OldValue = $this->max_seo->CurrentValue;
        $this->iklan->CurrentValue = null;
        $this->iklan->OldValue = $this->iklan->CurrentValue;
        $this->skor_iklan->CurrentValue = null;
        $this->skor_iklan->OldValue = $this->skor_iklan->CurrentValue;
        $this->max_iklan->CurrentValue = null;
        $this->max_iklan->OldValue = $this->max_iklan->CurrentValue;
        $this->skor_pemasaranonline->CurrentValue = null;
        $this->skor_pemasaranonline->OldValue = $this->skor_pemasaranonline->CurrentValue;
        $this->maxskor_pemasaranonline->CurrentValue = null;
        $this->maxskor_pemasaranonline->OldValue = $this->maxskor_pemasaranonline->CurrentValue;
        $this->bobot_pemasaranonline->CurrentValue = null;
        $this->bobot_pemasaranonline->OldValue = $this->bobot_pemasaranonline->CurrentValue;
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

        // Check field name 'chatting' first before field var 'x_chatting'
        $val = $CurrentForm->hasValue("chatting") ? $CurrentForm->getValue("chatting") : $CurrentForm->getValue("x_chatting");
        if (!$this->chatting->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->chatting->Visible = false; // Disable update for API request
            } else {
                $this->chatting->setFormValue($val);
            }
        }

        // Check field name 'skor_chatting' first before field var 'x_skor_chatting'
        $val = $CurrentForm->hasValue("skor_chatting") ? $CurrentForm->getValue("skor_chatting") : $CurrentForm->getValue("x_skor_chatting");
        if (!$this->skor_chatting->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_chatting->Visible = false; // Disable update for API request
            } else {
                $this->skor_chatting->setFormValue($val);
            }
        }

        // Check field name 'max_chatting' first before field var 'x_max_chatting'
        $val = $CurrentForm->hasValue("max_chatting") ? $CurrentForm->getValue("max_chatting") : $CurrentForm->getValue("x_max_chatting");
        if (!$this->max_chatting->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_chatting->Visible = false; // Disable update for API request
            } else {
                $this->max_chatting->setFormValue($val);
            }
        }

        // Check field name 'medsos' first before field var 'x_medsos'
        $val = $CurrentForm->hasValue("medsos") ? $CurrentForm->getValue("medsos") : $CurrentForm->getValue("x_medsos");
        if (!$this->medsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->medsos->Visible = false; // Disable update for API request
            } else {
                $this->medsos->setFormValue($val);
            }
        }

        // Check field name 'skor_medsos' first before field var 'x_skor_medsos'
        $val = $CurrentForm->hasValue("skor_medsos") ? $CurrentForm->getValue("skor_medsos") : $CurrentForm->getValue("x_skor_medsos");
        if (!$this->skor_medsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_medsos->Visible = false; // Disable update for API request
            } else {
                $this->skor_medsos->setFormValue($val);
            }
        }

        // Check field name 'max_medsos' first before field var 'x_max_medsos'
        $val = $CurrentForm->hasValue("max_medsos") ? $CurrentForm->getValue("max_medsos") : $CurrentForm->getValue("x_max_medsos");
        if (!$this->max_medsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_medsos->Visible = false; // Disable update for API request
            } else {
                $this->max_medsos->setFormValue($val);
            }
        }

        // Check field name 'marketplace' first before field var 'x_marketplace'
        $val = $CurrentForm->hasValue("marketplace") ? $CurrentForm->getValue("marketplace") : $CurrentForm->getValue("x_marketplace");
        if (!$this->marketplace->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->marketplace->Visible = false; // Disable update for API request
            } else {
                $this->marketplace->setFormValue($val);
            }
        }

        // Check field name 'skor_mp' first before field var 'x_skor_mp'
        $val = $CurrentForm->hasValue("skor_mp") ? $CurrentForm->getValue("skor_mp") : $CurrentForm->getValue("x_skor_mp");
        if (!$this->skor_mp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_mp->Visible = false; // Disable update for API request
            } else {
                $this->skor_mp->setFormValue($val);
            }
        }

        // Check field name 'max_mp' first before field var 'x_max_mp'
        $val = $CurrentForm->hasValue("max_mp") ? $CurrentForm->getValue("max_mp") : $CurrentForm->getValue("x_max_mp");
        if (!$this->max_mp->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_mp->Visible = false; // Disable update for API request
            } else {
                $this->max_mp->setFormValue($val);
            }
        }

        // Check field name 'gmb' first before field var 'x_gmb'
        $val = $CurrentForm->hasValue("gmb") ? $CurrentForm->getValue("gmb") : $CurrentForm->getValue("x_gmb");
        if (!$this->gmb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->gmb->Visible = false; // Disable update for API request
            } else {
                $this->gmb->setFormValue($val);
            }
        }

        // Check field name 'skor_gmb' first before field var 'x_skor_gmb'
        $val = $CurrentForm->hasValue("skor_gmb") ? $CurrentForm->getValue("skor_gmb") : $CurrentForm->getValue("x_skor_gmb");
        if (!$this->skor_gmb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_gmb->Visible = false; // Disable update for API request
            } else {
                $this->skor_gmb->setFormValue($val);
            }
        }

        // Check field name 'max_gmb' first before field var 'x_max_gmb'
        $val = $CurrentForm->hasValue("max_gmb") ? $CurrentForm->getValue("max_gmb") : $CurrentForm->getValue("x_max_gmb");
        if (!$this->max_gmb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_gmb->Visible = false; // Disable update for API request
            } else {
                $this->max_gmb->setFormValue($val);
            }
        }

        // Check field name 'web' first before field var 'x_web'
        $val = $CurrentForm->hasValue("web") ? $CurrentForm->getValue("web") : $CurrentForm->getValue("x_web");
        if (!$this->web->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->web->Visible = false; // Disable update for API request
            } else {
                $this->web->setFormValue($val);
            }
        }

        // Check field name 'skor_web' first before field var 'x_skor_web'
        $val = $CurrentForm->hasValue("skor_web") ? $CurrentForm->getValue("skor_web") : $CurrentForm->getValue("x_skor_web");
        if (!$this->skor_web->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_web->Visible = false; // Disable update for API request
            } else {
                $this->skor_web->setFormValue($val);
            }
        }

        // Check field name 'max_web' first before field var 'x_max_web'
        $val = $CurrentForm->hasValue("max_web") ? $CurrentForm->getValue("max_web") : $CurrentForm->getValue("x_max_web");
        if (!$this->max_web->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_web->Visible = false; // Disable update for API request
            } else {
                $this->max_web->setFormValue($val);
            }
        }

        // Check field name 'updatemedsos' first before field var 'x_updatemedsos'
        $val = $CurrentForm->hasValue("updatemedsos") ? $CurrentForm->getValue("updatemedsos") : $CurrentForm->getValue("x_updatemedsos");
        if (!$this->updatemedsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updatemedsos->Visible = false; // Disable update for API request
            } else {
                $this->updatemedsos->setFormValue($val);
            }
        }

        // Check field name 'skor_updatemedsos' first before field var 'x_skor_updatemedsos'
        $val = $CurrentForm->hasValue("skor_updatemedsos") ? $CurrentForm->getValue("skor_updatemedsos") : $CurrentForm->getValue("x_skor_updatemedsos");
        if (!$this->skor_updatemedsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_updatemedsos->Visible = false; // Disable update for API request
            } else {
                $this->skor_updatemedsos->setFormValue($val);
            }
        }

        // Check field name 'max_updatemedsos' first before field var 'x_max_updatemedsos'
        $val = $CurrentForm->hasValue("max_updatemedsos") ? $CurrentForm->getValue("max_updatemedsos") : $CurrentForm->getValue("x_max_updatemedsos");
        if (!$this->max_updatemedsos->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_updatemedsos->Visible = false; // Disable update for API request
            } else {
                $this->max_updatemedsos->setFormValue($val);
            }
        }

        // Check field name 'updateweb' first before field var 'x_updateweb'
        $val = $CurrentForm->hasValue("updateweb") ? $CurrentForm->getValue("updateweb") : $CurrentForm->getValue("x_updateweb");
        if (!$this->updateweb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->updateweb->Visible = false; // Disable update for API request
            } else {
                $this->updateweb->setFormValue($val);
            }
        }

        // Check field name 'skor_updateweb' first before field var 'x_skor_updateweb'
        $val = $CurrentForm->hasValue("skor_updateweb") ? $CurrentForm->getValue("skor_updateweb") : $CurrentForm->getValue("x_skor_updateweb");
        if (!$this->skor_updateweb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_updateweb->Visible = false; // Disable update for API request
            } else {
                $this->skor_updateweb->setFormValue($val);
            }
        }

        // Check field name 'max_updateweb' first before field var 'x_max_updateweb'
        $val = $CurrentForm->hasValue("max_updateweb") ? $CurrentForm->getValue("max_updateweb") : $CurrentForm->getValue("x_max_updateweb");
        if (!$this->max_updateweb->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_updateweb->Visible = false; // Disable update for API request
            } else {
                $this->max_updateweb->setFormValue($val);
            }
        }

        // Check field name 'seo' first before field var 'x_seo'
        $val = $CurrentForm->hasValue("seo") ? $CurrentForm->getValue("seo") : $CurrentForm->getValue("x_seo");
        if (!$this->seo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->seo->Visible = false; // Disable update for API request
            } else {
                $this->seo->setFormValue($val);
            }
        }

        // Check field name 'skor_seo' first before field var 'x_skor_seo'
        $val = $CurrentForm->hasValue("skor_seo") ? $CurrentForm->getValue("skor_seo") : $CurrentForm->getValue("x_skor_seo");
        if (!$this->skor_seo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_seo->Visible = false; // Disable update for API request
            } else {
                $this->skor_seo->setFormValue($val);
            }
        }

        // Check field name 'max_seo' first before field var 'x_max_seo'
        $val = $CurrentForm->hasValue("max_seo") ? $CurrentForm->getValue("max_seo") : $CurrentForm->getValue("x_max_seo");
        if (!$this->max_seo->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_seo->Visible = false; // Disable update for API request
            } else {
                $this->max_seo->setFormValue($val);
            }
        }

        // Check field name 'iklan' first before field var 'x_iklan'
        $val = $CurrentForm->hasValue("iklan") ? $CurrentForm->getValue("iklan") : $CurrentForm->getValue("x_iklan");
        if (!$this->iklan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->iklan->Visible = false; // Disable update for API request
            } else {
                $this->iklan->setFormValue($val);
            }
        }

        // Check field name 'skor_iklan' first before field var 'x_skor_iklan'
        $val = $CurrentForm->hasValue("skor_iklan") ? $CurrentForm->getValue("skor_iklan") : $CurrentForm->getValue("x_skor_iklan");
        if (!$this->skor_iklan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->skor_iklan->Visible = false; // Disable update for API request
            } else {
                $this->skor_iklan->setFormValue($val);
            }
        }

        // Check field name 'max_iklan' first before field var 'x_max_iklan'
        $val = $CurrentForm->hasValue("max_iklan") ? $CurrentForm->getValue("max_iklan") : $CurrentForm->getValue("x_max_iklan");
        if (!$this->max_iklan->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->max_iklan->Visible = false; // Disable update for API request
            } else {
                $this->max_iklan->setFormValue($val);
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
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->nik->CurrentValue = $this->nik->FormValue;
        $this->chatting->CurrentValue = $this->chatting->FormValue;
        $this->skor_chatting->CurrentValue = $this->skor_chatting->FormValue;
        $this->max_chatting->CurrentValue = $this->max_chatting->FormValue;
        $this->medsos->CurrentValue = $this->medsos->FormValue;
        $this->skor_medsos->CurrentValue = $this->skor_medsos->FormValue;
        $this->max_medsos->CurrentValue = $this->max_medsos->FormValue;
        $this->marketplace->CurrentValue = $this->marketplace->FormValue;
        $this->skor_mp->CurrentValue = $this->skor_mp->FormValue;
        $this->max_mp->CurrentValue = $this->max_mp->FormValue;
        $this->gmb->CurrentValue = $this->gmb->FormValue;
        $this->skor_gmb->CurrentValue = $this->skor_gmb->FormValue;
        $this->max_gmb->CurrentValue = $this->max_gmb->FormValue;
        $this->web->CurrentValue = $this->web->FormValue;
        $this->skor_web->CurrentValue = $this->skor_web->FormValue;
        $this->max_web->CurrentValue = $this->max_web->FormValue;
        $this->updatemedsos->CurrentValue = $this->updatemedsos->FormValue;
        $this->skor_updatemedsos->CurrentValue = $this->skor_updatemedsos->FormValue;
        $this->max_updatemedsos->CurrentValue = $this->max_updatemedsos->FormValue;
        $this->updateweb->CurrentValue = $this->updateweb->FormValue;
        $this->skor_updateweb->CurrentValue = $this->skor_updateweb->FormValue;
        $this->max_updateweb->CurrentValue = $this->max_updateweb->FormValue;
        $this->seo->CurrentValue = $this->seo->FormValue;
        $this->skor_seo->CurrentValue = $this->skor_seo->FormValue;
        $this->max_seo->CurrentValue = $this->max_seo->FormValue;
        $this->iklan->CurrentValue = $this->iklan->FormValue;
        $this->skor_iklan->CurrentValue = $this->skor_iklan->FormValue;
        $this->max_iklan->CurrentValue = $this->max_iklan->FormValue;
        $this->skor_pemasaranonline->CurrentValue = $this->skor_pemasaranonline->FormValue;
        $this->maxskor_pemasaranonline->CurrentValue = $this->maxskor_pemasaranonline->FormValue;
        $this->bobot_pemasaranonline->CurrentValue = $this->bobot_pemasaranonline->FormValue;
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
        $this->chatting->setDbValue($row['chatting']);
        $this->skor_chatting->setDbValue($row['skor_chatting']);
        $this->max_chatting->setDbValue($row['max_chatting']);
        $this->medsos->setDbValue($row['medsos']);
        $this->skor_medsos->setDbValue($row['skor_medsos']);
        $this->max_medsos->setDbValue($row['max_medsos']);
        $this->marketplace->setDbValue($row['marketplace']);
        $this->skor_mp->setDbValue($row['skor_mp']);
        $this->max_mp->setDbValue($row['max_mp']);
        $this->gmb->setDbValue($row['gmb']);
        $this->skor_gmb->setDbValue($row['skor_gmb']);
        $this->max_gmb->setDbValue($row['max_gmb']);
        $this->web->setDbValue($row['web']);
        $this->skor_web->setDbValue($row['skor_web']);
        $this->max_web->setDbValue($row['max_web']);
        $this->updatemedsos->setDbValue($row['updatemedsos']);
        $this->skor_updatemedsos->setDbValue($row['skor_updatemedsos']);
        $this->max_updatemedsos->setDbValue($row['max_updatemedsos']);
        $this->updateweb->setDbValue($row['updateweb']);
        $this->skor_updateweb->setDbValue($row['skor_updateweb']);
        $this->max_updateweb->setDbValue($row['max_updateweb']);
        $this->seo->setDbValue($row['seo']);
        $this->skor_seo->setDbValue($row['skor_seo']);
        $this->max_seo->setDbValue($row['max_seo']);
        $this->iklan->setDbValue($row['iklan']);
        $this->skor_iklan->setDbValue($row['skor_iklan']);
        $this->max_iklan->setDbValue($row['max_iklan']);
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['nik'] = $this->nik->CurrentValue;
        $row['chatting'] = $this->chatting->CurrentValue;
        $row['skor_chatting'] = $this->skor_chatting->CurrentValue;
        $row['max_chatting'] = $this->max_chatting->CurrentValue;
        $row['medsos'] = $this->medsos->CurrentValue;
        $row['skor_medsos'] = $this->skor_medsos->CurrentValue;
        $row['max_medsos'] = $this->max_medsos->CurrentValue;
        $row['marketplace'] = $this->marketplace->CurrentValue;
        $row['skor_mp'] = $this->skor_mp->CurrentValue;
        $row['max_mp'] = $this->max_mp->CurrentValue;
        $row['gmb'] = $this->gmb->CurrentValue;
        $row['skor_gmb'] = $this->skor_gmb->CurrentValue;
        $row['max_gmb'] = $this->max_gmb->CurrentValue;
        $row['web'] = $this->web->CurrentValue;
        $row['skor_web'] = $this->skor_web->CurrentValue;
        $row['max_web'] = $this->max_web->CurrentValue;
        $row['updatemedsos'] = $this->updatemedsos->CurrentValue;
        $row['skor_updatemedsos'] = $this->skor_updatemedsos->CurrentValue;
        $row['max_updatemedsos'] = $this->max_updatemedsos->CurrentValue;
        $row['updateweb'] = $this->updateweb->CurrentValue;
        $row['skor_updateweb'] = $this->skor_updateweb->CurrentValue;
        $row['max_updateweb'] = $this->max_updateweb->CurrentValue;
        $row['seo'] = $this->seo->CurrentValue;
        $row['skor_seo'] = $this->skor_seo->CurrentValue;
        $row['max_seo'] = $this->max_seo->CurrentValue;
        $row['iklan'] = $this->iklan->CurrentValue;
        $row['skor_iklan'] = $this->skor_iklan->CurrentValue;
        $row['max_iklan'] = $this->max_iklan->CurrentValue;
        $row['skor_pemasaranonline'] = $this->skor_pemasaranonline->CurrentValue;
        $row['maxskor_pemasaranonline'] = $this->maxskor_pemasaranonline->CurrentValue;
        $row['bobot_pemasaranonline'] = $this->bobot_pemasaranonline->CurrentValue;
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
        if ($this->skor_chatting->FormValue == $this->skor_chatting->CurrentValue && is_numeric(ConvertToFloatString($this->skor_chatting->CurrentValue))) {
            $this->skor_chatting->CurrentValue = ConvertToFloatString($this->skor_chatting->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_chatting->FormValue == $this->max_chatting->CurrentValue && is_numeric(ConvertToFloatString($this->max_chatting->CurrentValue))) {
            $this->max_chatting->CurrentValue = ConvertToFloatString($this->max_chatting->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_medsos->FormValue == $this->skor_medsos->CurrentValue && is_numeric(ConvertToFloatString($this->skor_medsos->CurrentValue))) {
            $this->skor_medsos->CurrentValue = ConvertToFloatString($this->skor_medsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_medsos->FormValue == $this->max_medsos->CurrentValue && is_numeric(ConvertToFloatString($this->max_medsos->CurrentValue))) {
            $this->max_medsos->CurrentValue = ConvertToFloatString($this->max_medsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mp->FormValue == $this->skor_mp->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mp->CurrentValue))) {
            $this->skor_mp->CurrentValue = ConvertToFloatString($this->skor_mp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mp->FormValue == $this->max_mp->CurrentValue && is_numeric(ConvertToFloatString($this->max_mp->CurrentValue))) {
            $this->max_mp->CurrentValue = ConvertToFloatString($this->max_mp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_gmb->FormValue == $this->skor_gmb->CurrentValue && is_numeric(ConvertToFloatString($this->skor_gmb->CurrentValue))) {
            $this->skor_gmb->CurrentValue = ConvertToFloatString($this->skor_gmb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_gmb->FormValue == $this->max_gmb->CurrentValue && is_numeric(ConvertToFloatString($this->max_gmb->CurrentValue))) {
            $this->max_gmb->CurrentValue = ConvertToFloatString($this->max_gmb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_web->FormValue == $this->skor_web->CurrentValue && is_numeric(ConvertToFloatString($this->skor_web->CurrentValue))) {
            $this->skor_web->CurrentValue = ConvertToFloatString($this->skor_web->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_web->FormValue == $this->max_web->CurrentValue && is_numeric(ConvertToFloatString($this->max_web->CurrentValue))) {
            $this->max_web->CurrentValue = ConvertToFloatString($this->max_web->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_updatemedsos->FormValue == $this->skor_updatemedsos->CurrentValue && is_numeric(ConvertToFloatString($this->skor_updatemedsos->CurrentValue))) {
            $this->skor_updatemedsos->CurrentValue = ConvertToFloatString($this->skor_updatemedsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_updatemedsos->FormValue == $this->max_updatemedsos->CurrentValue && is_numeric(ConvertToFloatString($this->max_updatemedsos->CurrentValue))) {
            $this->max_updatemedsos->CurrentValue = ConvertToFloatString($this->max_updatemedsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_updateweb->FormValue == $this->skor_updateweb->CurrentValue && is_numeric(ConvertToFloatString($this->skor_updateweb->CurrentValue))) {
            $this->skor_updateweb->CurrentValue = ConvertToFloatString($this->skor_updateweb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_updateweb->FormValue == $this->max_updateweb->CurrentValue && is_numeric(ConvertToFloatString($this->max_updateweb->CurrentValue))) {
            $this->max_updateweb->CurrentValue = ConvertToFloatString($this->max_updateweb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_seo->FormValue == $this->skor_seo->CurrentValue && is_numeric(ConvertToFloatString($this->skor_seo->CurrentValue))) {
            $this->skor_seo->CurrentValue = ConvertToFloatString($this->skor_seo->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_seo->FormValue == $this->max_seo->CurrentValue && is_numeric(ConvertToFloatString($this->max_seo->CurrentValue))) {
            $this->max_seo->CurrentValue = ConvertToFloatString($this->max_seo->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_iklan->FormValue == $this->skor_iklan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_iklan->CurrentValue))) {
            $this->skor_iklan->CurrentValue = ConvertToFloatString($this->skor_iklan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_iklan->FormValue == $this->max_iklan->CurrentValue && is_numeric(ConvertToFloatString($this->max_iklan->CurrentValue))) {
            $this->max_iklan->CurrentValue = ConvertToFloatString($this->max_iklan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaranonline->FormValue == $this->skor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaranonline->CurrentValue))) {
            $this->skor_pemasaranonline->CurrentValue = ConvertToFloatString($this->skor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaranonline->FormValue == $this->maxskor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue))) {
            $this->maxskor_pemasaranonline->CurrentValue = ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // chatting

        // skor_chatting

        // max_chatting

        // medsos

        // skor_medsos

        // max_medsos

        // marketplace

        // skor_mp

        // max_mp

        // gmb

        // skor_gmb

        // max_gmb

        // web

        // skor_web

        // max_web

        // updatemedsos

        // skor_updatemedsos

        // max_updatemedsos

        // updateweb

        // skor_updateweb

        // max_updateweb

        // seo

        // skor_seo

        // max_seo

        // iklan

        // skor_iklan

        // max_iklan

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // chatting
            $this->chatting->ViewValue = $this->chatting->CurrentValue;
            $this->chatting->ViewCustomAttributes = "";

            // skor_chatting
            $this->skor_chatting->ViewValue = $this->skor_chatting->CurrentValue;
            $this->skor_chatting->ViewValue = FormatNumber($this->skor_chatting->ViewValue, 2, -2, -2, -2);
            $this->skor_chatting->ViewCustomAttributes = "";

            // max_chatting
            $this->max_chatting->ViewValue = $this->max_chatting->CurrentValue;
            $this->max_chatting->ViewValue = FormatNumber($this->max_chatting->ViewValue, 2, -2, -2, -2);
            $this->max_chatting->ViewCustomAttributes = "";

            // medsos
            $this->medsos->ViewValue = $this->medsos->CurrentValue;
            $this->medsos->ViewCustomAttributes = "";

            // skor_medsos
            $this->skor_medsos->ViewValue = $this->skor_medsos->CurrentValue;
            $this->skor_medsos->ViewValue = FormatNumber($this->skor_medsos->ViewValue, 2, -2, -2, -2);
            $this->skor_medsos->ViewCustomAttributes = "";

            // max_medsos
            $this->max_medsos->ViewValue = $this->max_medsos->CurrentValue;
            $this->max_medsos->ViewValue = FormatNumber($this->max_medsos->ViewValue, 2, -2, -2, -2);
            $this->max_medsos->ViewCustomAttributes = "";

            // marketplace
            $this->marketplace->ViewValue = $this->marketplace->CurrentValue;
            $this->marketplace->ViewCustomAttributes = "";

            // skor_mp
            $this->skor_mp->ViewValue = $this->skor_mp->CurrentValue;
            $this->skor_mp->ViewValue = FormatNumber($this->skor_mp->ViewValue, 2, -2, -2, -2);
            $this->skor_mp->ViewCustomAttributes = "";

            // max_mp
            $this->max_mp->ViewValue = $this->max_mp->CurrentValue;
            $this->max_mp->ViewValue = FormatNumber($this->max_mp->ViewValue, 2, -2, -2, -2);
            $this->max_mp->ViewCustomAttributes = "";

            // gmb
            $this->gmb->ViewValue = $this->gmb->CurrentValue;
            $this->gmb->ViewCustomAttributes = "";

            // skor_gmb
            $this->skor_gmb->ViewValue = $this->skor_gmb->CurrentValue;
            $this->skor_gmb->ViewValue = FormatNumber($this->skor_gmb->ViewValue, 2, -2, -2, -2);
            $this->skor_gmb->ViewCustomAttributes = "";

            // max_gmb
            $this->max_gmb->ViewValue = $this->max_gmb->CurrentValue;
            $this->max_gmb->ViewValue = FormatNumber($this->max_gmb->ViewValue, 2, -2, -2, -2);
            $this->max_gmb->ViewCustomAttributes = "";

            // web
            $this->web->ViewValue = $this->web->CurrentValue;
            $this->web->ViewCustomAttributes = "";

            // skor_web
            $this->skor_web->ViewValue = $this->skor_web->CurrentValue;
            $this->skor_web->ViewValue = FormatNumber($this->skor_web->ViewValue, 2, -2, -2, -2);
            $this->skor_web->ViewCustomAttributes = "";

            // max_web
            $this->max_web->ViewValue = $this->max_web->CurrentValue;
            $this->max_web->ViewValue = FormatNumber($this->max_web->ViewValue, 2, -2, -2, -2);
            $this->max_web->ViewCustomAttributes = "";

            // updatemedsos
            $this->updatemedsos->ViewValue = $this->updatemedsos->CurrentValue;
            $this->updatemedsos->ViewCustomAttributes = "";

            // skor_updatemedsos
            $this->skor_updatemedsos->ViewValue = $this->skor_updatemedsos->CurrentValue;
            $this->skor_updatemedsos->ViewValue = FormatNumber($this->skor_updatemedsos->ViewValue, 2, -2, -2, -2);
            $this->skor_updatemedsos->ViewCustomAttributes = "";

            // max_updatemedsos
            $this->max_updatemedsos->ViewValue = $this->max_updatemedsos->CurrentValue;
            $this->max_updatemedsos->ViewValue = FormatNumber($this->max_updatemedsos->ViewValue, 2, -2, -2, -2);
            $this->max_updatemedsos->ViewCustomAttributes = "";

            // updateweb
            $this->updateweb->ViewValue = $this->updateweb->CurrentValue;
            $this->updateweb->ViewCustomAttributes = "";

            // skor_updateweb
            $this->skor_updateweb->ViewValue = $this->skor_updateweb->CurrentValue;
            $this->skor_updateweb->ViewValue = FormatNumber($this->skor_updateweb->ViewValue, 2, -2, -2, -2);
            $this->skor_updateweb->ViewCustomAttributes = "";

            // max_updateweb
            $this->max_updateweb->ViewValue = $this->max_updateweb->CurrentValue;
            $this->max_updateweb->ViewValue = FormatNumber($this->max_updateweb->ViewValue, 2, -2, -2, -2);
            $this->max_updateweb->ViewCustomAttributes = "";

            // seo
            $this->seo->ViewValue = $this->seo->CurrentValue;
            $this->seo->ViewCustomAttributes = "";

            // skor_seo
            $this->skor_seo->ViewValue = $this->skor_seo->CurrentValue;
            $this->skor_seo->ViewValue = FormatNumber($this->skor_seo->ViewValue, 2, -2, -2, -2);
            $this->skor_seo->ViewCustomAttributes = "";

            // max_seo
            $this->max_seo->ViewValue = $this->max_seo->CurrentValue;
            $this->max_seo->ViewValue = FormatNumber($this->max_seo->ViewValue, 2, -2, -2, -2);
            $this->max_seo->ViewCustomAttributes = "";

            // iklan
            $this->iklan->ViewValue = $this->iklan->CurrentValue;
            $this->iklan->ViewCustomAttributes = "";

            // skor_iklan
            $this->skor_iklan->ViewValue = $this->skor_iklan->CurrentValue;
            $this->skor_iklan->ViewValue = FormatNumber($this->skor_iklan->ViewValue, 2, -2, -2, -2);
            $this->skor_iklan->ViewCustomAttributes = "";

            // max_iklan
            $this->max_iklan->ViewValue = $this->max_iklan->CurrentValue;
            $this->max_iklan->ViewValue = FormatNumber($this->max_iklan->ViewValue, 2, -2, -2, -2);
            $this->max_iklan->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // chatting
            $this->chatting->LinkCustomAttributes = "";
            $this->chatting->HrefValue = "";
            $this->chatting->TooltipValue = "";

            // skor_chatting
            $this->skor_chatting->LinkCustomAttributes = "";
            $this->skor_chatting->HrefValue = "";
            $this->skor_chatting->TooltipValue = "";

            // max_chatting
            $this->max_chatting->LinkCustomAttributes = "";
            $this->max_chatting->HrefValue = "";
            $this->max_chatting->TooltipValue = "";

            // medsos
            $this->medsos->LinkCustomAttributes = "";
            $this->medsos->HrefValue = "";
            $this->medsos->TooltipValue = "";

            // skor_medsos
            $this->skor_medsos->LinkCustomAttributes = "";
            $this->skor_medsos->HrefValue = "";
            $this->skor_medsos->TooltipValue = "";

            // max_medsos
            $this->max_medsos->LinkCustomAttributes = "";
            $this->max_medsos->HrefValue = "";
            $this->max_medsos->TooltipValue = "";

            // marketplace
            $this->marketplace->LinkCustomAttributes = "";
            $this->marketplace->HrefValue = "";
            $this->marketplace->TooltipValue = "";

            // skor_mp
            $this->skor_mp->LinkCustomAttributes = "";
            $this->skor_mp->HrefValue = "";
            $this->skor_mp->TooltipValue = "";

            // max_mp
            $this->max_mp->LinkCustomAttributes = "";
            $this->max_mp->HrefValue = "";
            $this->max_mp->TooltipValue = "";

            // gmb
            $this->gmb->LinkCustomAttributes = "";
            $this->gmb->HrefValue = "";
            $this->gmb->TooltipValue = "";

            // skor_gmb
            $this->skor_gmb->LinkCustomAttributes = "";
            $this->skor_gmb->HrefValue = "";
            $this->skor_gmb->TooltipValue = "";

            // max_gmb
            $this->max_gmb->LinkCustomAttributes = "";
            $this->max_gmb->HrefValue = "";
            $this->max_gmb->TooltipValue = "";

            // web
            $this->web->LinkCustomAttributes = "";
            $this->web->HrefValue = "";
            $this->web->TooltipValue = "";

            // skor_web
            $this->skor_web->LinkCustomAttributes = "";
            $this->skor_web->HrefValue = "";
            $this->skor_web->TooltipValue = "";

            // max_web
            $this->max_web->LinkCustomAttributes = "";
            $this->max_web->HrefValue = "";
            $this->max_web->TooltipValue = "";

            // updatemedsos
            $this->updatemedsos->LinkCustomAttributes = "";
            $this->updatemedsos->HrefValue = "";
            $this->updatemedsos->TooltipValue = "";

            // skor_updatemedsos
            $this->skor_updatemedsos->LinkCustomAttributes = "";
            $this->skor_updatemedsos->HrefValue = "";
            $this->skor_updatemedsos->TooltipValue = "";

            // max_updatemedsos
            $this->max_updatemedsos->LinkCustomAttributes = "";
            $this->max_updatemedsos->HrefValue = "";
            $this->max_updatemedsos->TooltipValue = "";

            // updateweb
            $this->updateweb->LinkCustomAttributes = "";
            $this->updateweb->HrefValue = "";
            $this->updateweb->TooltipValue = "";

            // skor_updateweb
            $this->skor_updateweb->LinkCustomAttributes = "";
            $this->skor_updateweb->HrefValue = "";
            $this->skor_updateweb->TooltipValue = "";

            // max_updateweb
            $this->max_updateweb->LinkCustomAttributes = "";
            $this->max_updateweb->HrefValue = "";
            $this->max_updateweb->TooltipValue = "";

            // seo
            $this->seo->LinkCustomAttributes = "";
            $this->seo->HrefValue = "";
            $this->seo->TooltipValue = "";

            // skor_seo
            $this->skor_seo->LinkCustomAttributes = "";
            $this->skor_seo->HrefValue = "";
            $this->skor_seo->TooltipValue = "";

            // max_seo
            $this->max_seo->LinkCustomAttributes = "";
            $this->max_seo->HrefValue = "";
            $this->max_seo->TooltipValue = "";

            // iklan
            $this->iklan->LinkCustomAttributes = "";
            $this->iklan->HrefValue = "";
            $this->iklan->TooltipValue = "";

            // skor_iklan
            $this->skor_iklan->LinkCustomAttributes = "";
            $this->skor_iklan->HrefValue = "";
            $this->skor_iklan->TooltipValue = "";

            // max_iklan
            $this->max_iklan->LinkCustomAttributes = "";
            $this->max_iklan->HrefValue = "";
            $this->max_iklan->TooltipValue = "";

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
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // nik
            $this->nik->EditAttrs["class"] = "form-control";
            $this->nik->EditCustomAttributes = "";
            if (!$this->nik->Raw) {
                $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
            }
            $this->nik->EditValue = HtmlEncode($this->nik->CurrentValue);
            $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

            // chatting
            $this->chatting->EditAttrs["class"] = "form-control";
            $this->chatting->EditCustomAttributes = "";
            if (!$this->chatting->Raw) {
                $this->chatting->CurrentValue = HtmlDecode($this->chatting->CurrentValue);
            }
            $this->chatting->EditValue = HtmlEncode($this->chatting->CurrentValue);
            $this->chatting->PlaceHolder = RemoveHtml($this->chatting->caption());

            // skor_chatting
            $this->skor_chatting->EditAttrs["class"] = "form-control";
            $this->skor_chatting->EditCustomAttributes = "";
            $this->skor_chatting->EditValue = HtmlEncode($this->skor_chatting->CurrentValue);
            $this->skor_chatting->PlaceHolder = RemoveHtml($this->skor_chatting->caption());
            if (strval($this->skor_chatting->EditValue) != "" && is_numeric($this->skor_chatting->EditValue)) {
                $this->skor_chatting->EditValue = FormatNumber($this->skor_chatting->EditValue, -2, -2, -2, -2);
            }

            // max_chatting
            $this->max_chatting->EditAttrs["class"] = "form-control";
            $this->max_chatting->EditCustomAttributes = "";
            $this->max_chatting->EditValue = HtmlEncode($this->max_chatting->CurrentValue);
            $this->max_chatting->PlaceHolder = RemoveHtml($this->max_chatting->caption());
            if (strval($this->max_chatting->EditValue) != "" && is_numeric($this->max_chatting->EditValue)) {
                $this->max_chatting->EditValue = FormatNumber($this->max_chatting->EditValue, -2, -2, -2, -2);
            }

            // medsos
            $this->medsos->EditAttrs["class"] = "form-control";
            $this->medsos->EditCustomAttributes = "";
            if (!$this->medsos->Raw) {
                $this->medsos->CurrentValue = HtmlDecode($this->medsos->CurrentValue);
            }
            $this->medsos->EditValue = HtmlEncode($this->medsos->CurrentValue);
            $this->medsos->PlaceHolder = RemoveHtml($this->medsos->caption());

            // skor_medsos
            $this->skor_medsos->EditAttrs["class"] = "form-control";
            $this->skor_medsos->EditCustomAttributes = "";
            $this->skor_medsos->EditValue = HtmlEncode($this->skor_medsos->CurrentValue);
            $this->skor_medsos->PlaceHolder = RemoveHtml($this->skor_medsos->caption());
            if (strval($this->skor_medsos->EditValue) != "" && is_numeric($this->skor_medsos->EditValue)) {
                $this->skor_medsos->EditValue = FormatNumber($this->skor_medsos->EditValue, -2, -2, -2, -2);
            }

            // max_medsos
            $this->max_medsos->EditAttrs["class"] = "form-control";
            $this->max_medsos->EditCustomAttributes = "";
            $this->max_medsos->EditValue = HtmlEncode($this->max_medsos->CurrentValue);
            $this->max_medsos->PlaceHolder = RemoveHtml($this->max_medsos->caption());
            if (strval($this->max_medsos->EditValue) != "" && is_numeric($this->max_medsos->EditValue)) {
                $this->max_medsos->EditValue = FormatNumber($this->max_medsos->EditValue, -2, -2, -2, -2);
            }

            // marketplace
            $this->marketplace->EditAttrs["class"] = "form-control";
            $this->marketplace->EditCustomAttributes = "";
            if (!$this->marketplace->Raw) {
                $this->marketplace->CurrentValue = HtmlDecode($this->marketplace->CurrentValue);
            }
            $this->marketplace->EditValue = HtmlEncode($this->marketplace->CurrentValue);
            $this->marketplace->PlaceHolder = RemoveHtml($this->marketplace->caption());

            // skor_mp
            $this->skor_mp->EditAttrs["class"] = "form-control";
            $this->skor_mp->EditCustomAttributes = "";
            $this->skor_mp->EditValue = HtmlEncode($this->skor_mp->CurrentValue);
            $this->skor_mp->PlaceHolder = RemoveHtml($this->skor_mp->caption());
            if (strval($this->skor_mp->EditValue) != "" && is_numeric($this->skor_mp->EditValue)) {
                $this->skor_mp->EditValue = FormatNumber($this->skor_mp->EditValue, -2, -2, -2, -2);
            }

            // max_mp
            $this->max_mp->EditAttrs["class"] = "form-control";
            $this->max_mp->EditCustomAttributes = "";
            $this->max_mp->EditValue = HtmlEncode($this->max_mp->CurrentValue);
            $this->max_mp->PlaceHolder = RemoveHtml($this->max_mp->caption());
            if (strval($this->max_mp->EditValue) != "" && is_numeric($this->max_mp->EditValue)) {
                $this->max_mp->EditValue = FormatNumber($this->max_mp->EditValue, -2, -2, -2, -2);
            }

            // gmb
            $this->gmb->EditAttrs["class"] = "form-control";
            $this->gmb->EditCustomAttributes = "";
            if (!$this->gmb->Raw) {
                $this->gmb->CurrentValue = HtmlDecode($this->gmb->CurrentValue);
            }
            $this->gmb->EditValue = HtmlEncode($this->gmb->CurrentValue);
            $this->gmb->PlaceHolder = RemoveHtml($this->gmb->caption());

            // skor_gmb
            $this->skor_gmb->EditAttrs["class"] = "form-control";
            $this->skor_gmb->EditCustomAttributes = "";
            $this->skor_gmb->EditValue = HtmlEncode($this->skor_gmb->CurrentValue);
            $this->skor_gmb->PlaceHolder = RemoveHtml($this->skor_gmb->caption());
            if (strval($this->skor_gmb->EditValue) != "" && is_numeric($this->skor_gmb->EditValue)) {
                $this->skor_gmb->EditValue = FormatNumber($this->skor_gmb->EditValue, -2, -2, -2, -2);
            }

            // max_gmb
            $this->max_gmb->EditAttrs["class"] = "form-control";
            $this->max_gmb->EditCustomAttributes = "";
            $this->max_gmb->EditValue = HtmlEncode($this->max_gmb->CurrentValue);
            $this->max_gmb->PlaceHolder = RemoveHtml($this->max_gmb->caption());
            if (strval($this->max_gmb->EditValue) != "" && is_numeric($this->max_gmb->EditValue)) {
                $this->max_gmb->EditValue = FormatNumber($this->max_gmb->EditValue, -2, -2, -2, -2);
            }

            // web
            $this->web->EditAttrs["class"] = "form-control";
            $this->web->EditCustomAttributes = "";
            if (!$this->web->Raw) {
                $this->web->CurrentValue = HtmlDecode($this->web->CurrentValue);
            }
            $this->web->EditValue = HtmlEncode($this->web->CurrentValue);
            $this->web->PlaceHolder = RemoveHtml($this->web->caption());

            // skor_web
            $this->skor_web->EditAttrs["class"] = "form-control";
            $this->skor_web->EditCustomAttributes = "";
            $this->skor_web->EditValue = HtmlEncode($this->skor_web->CurrentValue);
            $this->skor_web->PlaceHolder = RemoveHtml($this->skor_web->caption());
            if (strval($this->skor_web->EditValue) != "" && is_numeric($this->skor_web->EditValue)) {
                $this->skor_web->EditValue = FormatNumber($this->skor_web->EditValue, -2, -2, -2, -2);
            }

            // max_web
            $this->max_web->EditAttrs["class"] = "form-control";
            $this->max_web->EditCustomAttributes = "";
            $this->max_web->EditValue = HtmlEncode($this->max_web->CurrentValue);
            $this->max_web->PlaceHolder = RemoveHtml($this->max_web->caption());
            if (strval($this->max_web->EditValue) != "" && is_numeric($this->max_web->EditValue)) {
                $this->max_web->EditValue = FormatNumber($this->max_web->EditValue, -2, -2, -2, -2);
            }

            // updatemedsos
            $this->updatemedsos->EditAttrs["class"] = "form-control";
            $this->updatemedsos->EditCustomAttributes = "";
            if (!$this->updatemedsos->Raw) {
                $this->updatemedsos->CurrentValue = HtmlDecode($this->updatemedsos->CurrentValue);
            }
            $this->updatemedsos->EditValue = HtmlEncode($this->updatemedsos->CurrentValue);
            $this->updatemedsos->PlaceHolder = RemoveHtml($this->updatemedsos->caption());

            // skor_updatemedsos
            $this->skor_updatemedsos->EditAttrs["class"] = "form-control";
            $this->skor_updatemedsos->EditCustomAttributes = "";
            $this->skor_updatemedsos->EditValue = HtmlEncode($this->skor_updatemedsos->CurrentValue);
            $this->skor_updatemedsos->PlaceHolder = RemoveHtml($this->skor_updatemedsos->caption());
            if (strval($this->skor_updatemedsos->EditValue) != "" && is_numeric($this->skor_updatemedsos->EditValue)) {
                $this->skor_updatemedsos->EditValue = FormatNumber($this->skor_updatemedsos->EditValue, -2, -2, -2, -2);
            }

            // max_updatemedsos
            $this->max_updatemedsos->EditAttrs["class"] = "form-control";
            $this->max_updatemedsos->EditCustomAttributes = "";
            $this->max_updatemedsos->EditValue = HtmlEncode($this->max_updatemedsos->CurrentValue);
            $this->max_updatemedsos->PlaceHolder = RemoveHtml($this->max_updatemedsos->caption());
            if (strval($this->max_updatemedsos->EditValue) != "" && is_numeric($this->max_updatemedsos->EditValue)) {
                $this->max_updatemedsos->EditValue = FormatNumber($this->max_updatemedsos->EditValue, -2, -2, -2, -2);
            }

            // updateweb
            $this->updateweb->EditAttrs["class"] = "form-control";
            $this->updateweb->EditCustomAttributes = "";
            if (!$this->updateweb->Raw) {
                $this->updateweb->CurrentValue = HtmlDecode($this->updateweb->CurrentValue);
            }
            $this->updateweb->EditValue = HtmlEncode($this->updateweb->CurrentValue);
            $this->updateweb->PlaceHolder = RemoveHtml($this->updateweb->caption());

            // skor_updateweb
            $this->skor_updateweb->EditAttrs["class"] = "form-control";
            $this->skor_updateweb->EditCustomAttributes = "";
            $this->skor_updateweb->EditValue = HtmlEncode($this->skor_updateweb->CurrentValue);
            $this->skor_updateweb->PlaceHolder = RemoveHtml($this->skor_updateweb->caption());
            if (strval($this->skor_updateweb->EditValue) != "" && is_numeric($this->skor_updateweb->EditValue)) {
                $this->skor_updateweb->EditValue = FormatNumber($this->skor_updateweb->EditValue, -2, -2, -2, -2);
            }

            // max_updateweb
            $this->max_updateweb->EditAttrs["class"] = "form-control";
            $this->max_updateweb->EditCustomAttributes = "";
            $this->max_updateweb->EditValue = HtmlEncode($this->max_updateweb->CurrentValue);
            $this->max_updateweb->PlaceHolder = RemoveHtml($this->max_updateweb->caption());
            if (strval($this->max_updateweb->EditValue) != "" && is_numeric($this->max_updateweb->EditValue)) {
                $this->max_updateweb->EditValue = FormatNumber($this->max_updateweb->EditValue, -2, -2, -2, -2);
            }

            // seo
            $this->seo->EditAttrs["class"] = "form-control";
            $this->seo->EditCustomAttributes = "";
            if (!$this->seo->Raw) {
                $this->seo->CurrentValue = HtmlDecode($this->seo->CurrentValue);
            }
            $this->seo->EditValue = HtmlEncode($this->seo->CurrentValue);
            $this->seo->PlaceHolder = RemoveHtml($this->seo->caption());

            // skor_seo
            $this->skor_seo->EditAttrs["class"] = "form-control";
            $this->skor_seo->EditCustomAttributes = "";
            $this->skor_seo->EditValue = HtmlEncode($this->skor_seo->CurrentValue);
            $this->skor_seo->PlaceHolder = RemoveHtml($this->skor_seo->caption());
            if (strval($this->skor_seo->EditValue) != "" && is_numeric($this->skor_seo->EditValue)) {
                $this->skor_seo->EditValue = FormatNumber($this->skor_seo->EditValue, -2, -2, -2, -2);
            }

            // max_seo
            $this->max_seo->EditAttrs["class"] = "form-control";
            $this->max_seo->EditCustomAttributes = "";
            $this->max_seo->EditValue = HtmlEncode($this->max_seo->CurrentValue);
            $this->max_seo->PlaceHolder = RemoveHtml($this->max_seo->caption());
            if (strval($this->max_seo->EditValue) != "" && is_numeric($this->max_seo->EditValue)) {
                $this->max_seo->EditValue = FormatNumber($this->max_seo->EditValue, -2, -2, -2, -2);
            }

            // iklan
            $this->iklan->EditAttrs["class"] = "form-control";
            $this->iklan->EditCustomAttributes = "";
            if (!$this->iklan->Raw) {
                $this->iklan->CurrentValue = HtmlDecode($this->iklan->CurrentValue);
            }
            $this->iklan->EditValue = HtmlEncode($this->iklan->CurrentValue);
            $this->iklan->PlaceHolder = RemoveHtml($this->iklan->caption());

            // skor_iklan
            $this->skor_iklan->EditAttrs["class"] = "form-control";
            $this->skor_iklan->EditCustomAttributes = "";
            $this->skor_iklan->EditValue = HtmlEncode($this->skor_iklan->CurrentValue);
            $this->skor_iklan->PlaceHolder = RemoveHtml($this->skor_iklan->caption());
            if (strval($this->skor_iklan->EditValue) != "" && is_numeric($this->skor_iklan->EditValue)) {
                $this->skor_iklan->EditValue = FormatNumber($this->skor_iklan->EditValue, -2, -2, -2, -2);
            }

            // max_iklan
            $this->max_iklan->EditAttrs["class"] = "form-control";
            $this->max_iklan->EditCustomAttributes = "";
            $this->max_iklan->EditValue = HtmlEncode($this->max_iklan->CurrentValue);
            $this->max_iklan->PlaceHolder = RemoveHtml($this->max_iklan->caption());
            if (strval($this->max_iklan->EditValue) != "" && is_numeric($this->max_iklan->EditValue)) {
                $this->max_iklan->EditValue = FormatNumber($this->max_iklan->EditValue, -2, -2, -2, -2);
            }

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

            // Add refer script

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";

            // chatting
            $this->chatting->LinkCustomAttributes = "";
            $this->chatting->HrefValue = "";

            // skor_chatting
            $this->skor_chatting->LinkCustomAttributes = "";
            $this->skor_chatting->HrefValue = "";

            // max_chatting
            $this->max_chatting->LinkCustomAttributes = "";
            $this->max_chatting->HrefValue = "";

            // medsos
            $this->medsos->LinkCustomAttributes = "";
            $this->medsos->HrefValue = "";

            // skor_medsos
            $this->skor_medsos->LinkCustomAttributes = "";
            $this->skor_medsos->HrefValue = "";

            // max_medsos
            $this->max_medsos->LinkCustomAttributes = "";
            $this->max_medsos->HrefValue = "";

            // marketplace
            $this->marketplace->LinkCustomAttributes = "";
            $this->marketplace->HrefValue = "";

            // skor_mp
            $this->skor_mp->LinkCustomAttributes = "";
            $this->skor_mp->HrefValue = "";

            // max_mp
            $this->max_mp->LinkCustomAttributes = "";
            $this->max_mp->HrefValue = "";

            // gmb
            $this->gmb->LinkCustomAttributes = "";
            $this->gmb->HrefValue = "";

            // skor_gmb
            $this->skor_gmb->LinkCustomAttributes = "";
            $this->skor_gmb->HrefValue = "";

            // max_gmb
            $this->max_gmb->LinkCustomAttributes = "";
            $this->max_gmb->HrefValue = "";

            // web
            $this->web->LinkCustomAttributes = "";
            $this->web->HrefValue = "";

            // skor_web
            $this->skor_web->LinkCustomAttributes = "";
            $this->skor_web->HrefValue = "";

            // max_web
            $this->max_web->LinkCustomAttributes = "";
            $this->max_web->HrefValue = "";

            // updatemedsos
            $this->updatemedsos->LinkCustomAttributes = "";
            $this->updatemedsos->HrefValue = "";

            // skor_updatemedsos
            $this->skor_updatemedsos->LinkCustomAttributes = "";
            $this->skor_updatemedsos->HrefValue = "";

            // max_updatemedsos
            $this->max_updatemedsos->LinkCustomAttributes = "";
            $this->max_updatemedsos->HrefValue = "";

            // updateweb
            $this->updateweb->LinkCustomAttributes = "";
            $this->updateweb->HrefValue = "";

            // skor_updateweb
            $this->skor_updateweb->LinkCustomAttributes = "";
            $this->skor_updateweb->HrefValue = "";

            // max_updateweb
            $this->max_updateweb->LinkCustomAttributes = "";
            $this->max_updateweb->HrefValue = "";

            // seo
            $this->seo->LinkCustomAttributes = "";
            $this->seo->HrefValue = "";

            // skor_seo
            $this->skor_seo->LinkCustomAttributes = "";
            $this->skor_seo->HrefValue = "";

            // max_seo
            $this->max_seo->LinkCustomAttributes = "";
            $this->max_seo->HrefValue = "";

            // iklan
            $this->iklan->LinkCustomAttributes = "";
            $this->iklan->HrefValue = "";

            // skor_iklan
            $this->skor_iklan->LinkCustomAttributes = "";
            $this->skor_iklan->HrefValue = "";

            // max_iklan
            $this->max_iklan->LinkCustomAttributes = "";
            $this->max_iklan->HrefValue = "";

            // skor_pemasaranonline
            $this->skor_pemasaranonline->LinkCustomAttributes = "";
            $this->skor_pemasaranonline->HrefValue = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->LinkCustomAttributes = "";
            $this->maxskor_pemasaranonline->HrefValue = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->LinkCustomAttributes = "";
            $this->bobot_pemasaranonline->HrefValue = "";
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
        if ($this->chatting->Required) {
            if (!$this->chatting->IsDetailKey && EmptyValue($this->chatting->FormValue)) {
                $this->chatting->addErrorMessage(str_replace("%s", $this->chatting->caption(), $this->chatting->RequiredErrorMessage));
            }
        }
        if ($this->skor_chatting->Required) {
            if (!$this->skor_chatting->IsDetailKey && EmptyValue($this->skor_chatting->FormValue)) {
                $this->skor_chatting->addErrorMessage(str_replace("%s", $this->skor_chatting->caption(), $this->skor_chatting->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_chatting->FormValue)) {
            $this->skor_chatting->addErrorMessage($this->skor_chatting->getErrorMessage(false));
        }
        if ($this->max_chatting->Required) {
            if (!$this->max_chatting->IsDetailKey && EmptyValue($this->max_chatting->FormValue)) {
                $this->max_chatting->addErrorMessage(str_replace("%s", $this->max_chatting->caption(), $this->max_chatting->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_chatting->FormValue)) {
            $this->max_chatting->addErrorMessage($this->max_chatting->getErrorMessage(false));
        }
        if ($this->medsos->Required) {
            if (!$this->medsos->IsDetailKey && EmptyValue($this->medsos->FormValue)) {
                $this->medsos->addErrorMessage(str_replace("%s", $this->medsos->caption(), $this->medsos->RequiredErrorMessage));
            }
        }
        if ($this->skor_medsos->Required) {
            if (!$this->skor_medsos->IsDetailKey && EmptyValue($this->skor_medsos->FormValue)) {
                $this->skor_medsos->addErrorMessage(str_replace("%s", $this->skor_medsos->caption(), $this->skor_medsos->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_medsos->FormValue)) {
            $this->skor_medsos->addErrorMessage($this->skor_medsos->getErrorMessage(false));
        }
        if ($this->max_medsos->Required) {
            if (!$this->max_medsos->IsDetailKey && EmptyValue($this->max_medsos->FormValue)) {
                $this->max_medsos->addErrorMessage(str_replace("%s", $this->max_medsos->caption(), $this->max_medsos->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_medsos->FormValue)) {
            $this->max_medsos->addErrorMessage($this->max_medsos->getErrorMessage(false));
        }
        if ($this->marketplace->Required) {
            if (!$this->marketplace->IsDetailKey && EmptyValue($this->marketplace->FormValue)) {
                $this->marketplace->addErrorMessage(str_replace("%s", $this->marketplace->caption(), $this->marketplace->RequiredErrorMessage));
            }
        }
        if ($this->skor_mp->Required) {
            if (!$this->skor_mp->IsDetailKey && EmptyValue($this->skor_mp->FormValue)) {
                $this->skor_mp->addErrorMessage(str_replace("%s", $this->skor_mp->caption(), $this->skor_mp->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_mp->FormValue)) {
            $this->skor_mp->addErrorMessage($this->skor_mp->getErrorMessage(false));
        }
        if ($this->max_mp->Required) {
            if (!$this->max_mp->IsDetailKey && EmptyValue($this->max_mp->FormValue)) {
                $this->max_mp->addErrorMessage(str_replace("%s", $this->max_mp->caption(), $this->max_mp->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_mp->FormValue)) {
            $this->max_mp->addErrorMessage($this->max_mp->getErrorMessage(false));
        }
        if ($this->gmb->Required) {
            if (!$this->gmb->IsDetailKey && EmptyValue($this->gmb->FormValue)) {
                $this->gmb->addErrorMessage(str_replace("%s", $this->gmb->caption(), $this->gmb->RequiredErrorMessage));
            }
        }
        if ($this->skor_gmb->Required) {
            if (!$this->skor_gmb->IsDetailKey && EmptyValue($this->skor_gmb->FormValue)) {
                $this->skor_gmb->addErrorMessage(str_replace("%s", $this->skor_gmb->caption(), $this->skor_gmb->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_gmb->FormValue)) {
            $this->skor_gmb->addErrorMessage($this->skor_gmb->getErrorMessage(false));
        }
        if ($this->max_gmb->Required) {
            if (!$this->max_gmb->IsDetailKey && EmptyValue($this->max_gmb->FormValue)) {
                $this->max_gmb->addErrorMessage(str_replace("%s", $this->max_gmb->caption(), $this->max_gmb->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_gmb->FormValue)) {
            $this->max_gmb->addErrorMessage($this->max_gmb->getErrorMessage(false));
        }
        if ($this->web->Required) {
            if (!$this->web->IsDetailKey && EmptyValue($this->web->FormValue)) {
                $this->web->addErrorMessage(str_replace("%s", $this->web->caption(), $this->web->RequiredErrorMessage));
            }
        }
        if ($this->skor_web->Required) {
            if (!$this->skor_web->IsDetailKey && EmptyValue($this->skor_web->FormValue)) {
                $this->skor_web->addErrorMessage(str_replace("%s", $this->skor_web->caption(), $this->skor_web->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_web->FormValue)) {
            $this->skor_web->addErrorMessage($this->skor_web->getErrorMessage(false));
        }
        if ($this->max_web->Required) {
            if (!$this->max_web->IsDetailKey && EmptyValue($this->max_web->FormValue)) {
                $this->max_web->addErrorMessage(str_replace("%s", $this->max_web->caption(), $this->max_web->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_web->FormValue)) {
            $this->max_web->addErrorMessage($this->max_web->getErrorMessage(false));
        }
        if ($this->updatemedsos->Required) {
            if (!$this->updatemedsos->IsDetailKey && EmptyValue($this->updatemedsos->FormValue)) {
                $this->updatemedsos->addErrorMessage(str_replace("%s", $this->updatemedsos->caption(), $this->updatemedsos->RequiredErrorMessage));
            }
        }
        if ($this->skor_updatemedsos->Required) {
            if (!$this->skor_updatemedsos->IsDetailKey && EmptyValue($this->skor_updatemedsos->FormValue)) {
                $this->skor_updatemedsos->addErrorMessage(str_replace("%s", $this->skor_updatemedsos->caption(), $this->skor_updatemedsos->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_updatemedsos->FormValue)) {
            $this->skor_updatemedsos->addErrorMessage($this->skor_updatemedsos->getErrorMessage(false));
        }
        if ($this->max_updatemedsos->Required) {
            if (!$this->max_updatemedsos->IsDetailKey && EmptyValue($this->max_updatemedsos->FormValue)) {
                $this->max_updatemedsos->addErrorMessage(str_replace("%s", $this->max_updatemedsos->caption(), $this->max_updatemedsos->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_updatemedsos->FormValue)) {
            $this->max_updatemedsos->addErrorMessage($this->max_updatemedsos->getErrorMessage(false));
        }
        if ($this->updateweb->Required) {
            if (!$this->updateweb->IsDetailKey && EmptyValue($this->updateweb->FormValue)) {
                $this->updateweb->addErrorMessage(str_replace("%s", $this->updateweb->caption(), $this->updateweb->RequiredErrorMessage));
            }
        }
        if ($this->skor_updateweb->Required) {
            if (!$this->skor_updateweb->IsDetailKey && EmptyValue($this->skor_updateweb->FormValue)) {
                $this->skor_updateweb->addErrorMessage(str_replace("%s", $this->skor_updateweb->caption(), $this->skor_updateweb->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_updateweb->FormValue)) {
            $this->skor_updateweb->addErrorMessage($this->skor_updateweb->getErrorMessage(false));
        }
        if ($this->max_updateweb->Required) {
            if (!$this->max_updateweb->IsDetailKey && EmptyValue($this->max_updateweb->FormValue)) {
                $this->max_updateweb->addErrorMessage(str_replace("%s", $this->max_updateweb->caption(), $this->max_updateweb->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_updateweb->FormValue)) {
            $this->max_updateweb->addErrorMessage($this->max_updateweb->getErrorMessage(false));
        }
        if ($this->seo->Required) {
            if (!$this->seo->IsDetailKey && EmptyValue($this->seo->FormValue)) {
                $this->seo->addErrorMessage(str_replace("%s", $this->seo->caption(), $this->seo->RequiredErrorMessage));
            }
        }
        if ($this->skor_seo->Required) {
            if (!$this->skor_seo->IsDetailKey && EmptyValue($this->skor_seo->FormValue)) {
                $this->skor_seo->addErrorMessage(str_replace("%s", $this->skor_seo->caption(), $this->skor_seo->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_seo->FormValue)) {
            $this->skor_seo->addErrorMessage($this->skor_seo->getErrorMessage(false));
        }
        if ($this->max_seo->Required) {
            if (!$this->max_seo->IsDetailKey && EmptyValue($this->max_seo->FormValue)) {
                $this->max_seo->addErrorMessage(str_replace("%s", $this->max_seo->caption(), $this->max_seo->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_seo->FormValue)) {
            $this->max_seo->addErrorMessage($this->max_seo->getErrorMessage(false));
        }
        if ($this->iklan->Required) {
            if (!$this->iklan->IsDetailKey && EmptyValue($this->iklan->FormValue)) {
                $this->iklan->addErrorMessage(str_replace("%s", $this->iklan->caption(), $this->iklan->RequiredErrorMessage));
            }
        }
        if ($this->skor_iklan->Required) {
            if (!$this->skor_iklan->IsDetailKey && EmptyValue($this->skor_iklan->FormValue)) {
                $this->skor_iklan->addErrorMessage(str_replace("%s", $this->skor_iklan->caption(), $this->skor_iklan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->skor_iklan->FormValue)) {
            $this->skor_iklan->addErrorMessage($this->skor_iklan->getErrorMessage(false));
        }
        if ($this->max_iklan->Required) {
            if (!$this->max_iklan->IsDetailKey && EmptyValue($this->max_iklan->FormValue)) {
                $this->max_iklan->addErrorMessage(str_replace("%s", $this->max_iklan->caption(), $this->max_iklan->RequiredErrorMessage));
            }
        }
        if (!CheckNumber($this->max_iklan->FormValue)) {
            $this->max_iklan->addErrorMessage($this->max_iklan->getErrorMessage(false));
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

        // chatting
        $this->chatting->setDbValueDef($rsnew, $this->chatting->CurrentValue, null, false);

        // skor_chatting
        $this->skor_chatting->setDbValueDef($rsnew, $this->skor_chatting->CurrentValue, null, false);

        // max_chatting
        $this->max_chatting->setDbValueDef($rsnew, $this->max_chatting->CurrentValue, null, false);

        // medsos
        $this->medsos->setDbValueDef($rsnew, $this->medsos->CurrentValue, null, false);

        // skor_medsos
        $this->skor_medsos->setDbValueDef($rsnew, $this->skor_medsos->CurrentValue, null, false);

        // max_medsos
        $this->max_medsos->setDbValueDef($rsnew, $this->max_medsos->CurrentValue, null, false);

        // marketplace
        $this->marketplace->setDbValueDef($rsnew, $this->marketplace->CurrentValue, null, false);

        // skor_mp
        $this->skor_mp->setDbValueDef($rsnew, $this->skor_mp->CurrentValue, null, false);

        // max_mp
        $this->max_mp->setDbValueDef($rsnew, $this->max_mp->CurrentValue, null, false);

        // gmb
        $this->gmb->setDbValueDef($rsnew, $this->gmb->CurrentValue, null, false);

        // skor_gmb
        $this->skor_gmb->setDbValueDef($rsnew, $this->skor_gmb->CurrentValue, null, false);

        // max_gmb
        $this->max_gmb->setDbValueDef($rsnew, $this->max_gmb->CurrentValue, null, false);

        // web
        $this->web->setDbValueDef($rsnew, $this->web->CurrentValue, null, false);

        // skor_web
        $this->skor_web->setDbValueDef($rsnew, $this->skor_web->CurrentValue, null, false);

        // max_web
        $this->max_web->setDbValueDef($rsnew, $this->max_web->CurrentValue, null, false);

        // updatemedsos
        $this->updatemedsos->setDbValueDef($rsnew, $this->updatemedsos->CurrentValue, null, false);

        // skor_updatemedsos
        $this->skor_updatemedsos->setDbValueDef($rsnew, $this->skor_updatemedsos->CurrentValue, null, false);

        // max_updatemedsos
        $this->max_updatemedsos->setDbValueDef($rsnew, $this->max_updatemedsos->CurrentValue, null, false);

        // updateweb
        $this->updateweb->setDbValueDef($rsnew, $this->updateweb->CurrentValue, null, false);

        // skor_updateweb
        $this->skor_updateweb->setDbValueDef($rsnew, $this->skor_updateweb->CurrentValue, null, false);

        // max_updateweb
        $this->max_updateweb->setDbValueDef($rsnew, $this->max_updateweb->CurrentValue, null, false);

        // seo
        $this->seo->setDbValueDef($rsnew, $this->seo->CurrentValue, null, false);

        // skor_seo
        $this->skor_seo->setDbValueDef($rsnew, $this->skor_seo->CurrentValue, null, false);

        // max_seo
        $this->max_seo->setDbValueDef($rsnew, $this->max_seo->CurrentValue, null, false);

        // iklan
        $this->iklan->setDbValueDef($rsnew, $this->iklan->CurrentValue, null, false);

        // skor_iklan
        $this->skor_iklan->setDbValueDef($rsnew, $this->skor_iklan->CurrentValue, null, false);

        // max_iklan
        $this->max_iklan->setDbValueDef($rsnew, $this->max_iklan->CurrentValue, null, false);

        // skor_pemasaranonline
        $this->skor_pemasaranonline->setDbValueDef($rsnew, $this->skor_pemasaranonline->CurrentValue, null, false);

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline->setDbValueDef($rsnew, $this->maxskor_pemasaranonline->CurrentValue, null, false);

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline->setDbValueDef($rsnew, $this->bobot_pemasaranonline->CurrentValue, 0, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorpemasaranonlinelist"), "", $this->TableVar, true);
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
