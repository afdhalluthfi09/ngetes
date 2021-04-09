<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekkeuanganAdd extends UmkmAspekkeuangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekkeuangan';

    // Page object name
    public $PageObjName = "UmkmAspekkeuanganAdd";

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

        // Table object (umkm_aspekkeuangan)
        if (!isset($GLOBALS["umkm_aspekkeuangan"]) || get_class($GLOBALS["umkm_aspekkeuangan"]) == PROJECT_NAMESPACE . "umkm_aspekkeuangan") {
            $GLOBALS["umkm_aspekkeuangan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekkeuangan');
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
                $doc = new $class(Container("umkm_aspekkeuangan"));
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
                    if ($pageName == "umkmaspekkeuanganview") {
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
        $this->KEU_USAHAUTAMA->setVisibility();
        $this->KEU_PENGELOLAAN->setVisibility();
        $this->KEU_NOTA->setVisibility();
        $this->KEU_PENCATATAN->setVisibility();
        $this->KEU_LAPORAN->setVisibility();
        $this->KEU_UTANGMODAL->setVisibility();
        $this->KEU_CATATNASET->setVisibility();
        $this->KEU_NONTUNAI->setVisibility();
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
        $this->setupLookupOptions($this->KEU_USAHAUTAMA);
        $this->setupLookupOptions($this->KEU_PENGELOLAAN);
        $this->setupLookupOptions($this->KEU_NOTA);
        $this->setupLookupOptions($this->KEU_PENCATATAN);
        $this->setupLookupOptions($this->KEU_LAPORAN);
        $this->setupLookupOptions($this->KEU_UTANGMODAL);
        $this->setupLookupOptions($this->KEU_CATATNASET);
        $this->setupLookupOptions($this->KEU_NONTUNAI);

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
                    $this->terminate("umkmaspekkeuanganlist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "umkmaspekkeuanganlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "umkmaspekkeuanganview") {
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
        $this->KEU_USAHAUTAMA->CurrentValue = null;
        $this->KEU_USAHAUTAMA->OldValue = $this->KEU_USAHAUTAMA->CurrentValue;
        $this->KEU_PENGELOLAAN->CurrentValue = null;
        $this->KEU_PENGELOLAAN->OldValue = $this->KEU_PENGELOLAAN->CurrentValue;
        $this->KEU_NOTA->CurrentValue = null;
        $this->KEU_NOTA->OldValue = $this->KEU_NOTA->CurrentValue;
        $this->KEU_PENCATATAN->CurrentValue = null;
        $this->KEU_PENCATATAN->OldValue = $this->KEU_PENCATATAN->CurrentValue;
        $this->KEU_LAPORAN->CurrentValue = null;
        $this->KEU_LAPORAN->OldValue = $this->KEU_LAPORAN->CurrentValue;
        $this->KEU_UTANGMODAL->CurrentValue = null;
        $this->KEU_UTANGMODAL->OldValue = $this->KEU_UTANGMODAL->CurrentValue;
        $this->KEU_CATATNASET->CurrentValue = null;
        $this->KEU_CATATNASET->OldValue = $this->KEU_CATATNASET->CurrentValue;
        $this->KEU_NONTUNAI->CurrentValue = null;
        $this->KEU_NONTUNAI->OldValue = $this->KEU_NONTUNAI->CurrentValue;
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

        // Check field name 'KEU_USAHAUTAMA' first before field var 'x_KEU_USAHAUTAMA'
        $val = $CurrentForm->hasValue("KEU_USAHAUTAMA") ? $CurrentForm->getValue("KEU_USAHAUTAMA") : $CurrentForm->getValue("x_KEU_USAHAUTAMA");
        if (!$this->KEU_USAHAUTAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_USAHAUTAMA->Visible = false; // Disable update for API request
            } else {
                $this->KEU_USAHAUTAMA->setFormValue($val);
            }
        }

        // Check field name 'KEU_PENGELOLAAN' first before field var 'x_KEU_PENGELOLAAN'
        $val = $CurrentForm->hasValue("KEU_PENGELOLAAN") ? $CurrentForm->getValue("KEU_PENGELOLAAN") : $CurrentForm->getValue("x_KEU_PENGELOLAAN");
        if (!$this->KEU_PENGELOLAAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_PENGELOLAAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_PENGELOLAAN->setFormValue($val);
            }
        }

        // Check field name 'KEU_NOTA' first before field var 'x_KEU_NOTA'
        $val = $CurrentForm->hasValue("KEU_NOTA") ? $CurrentForm->getValue("KEU_NOTA") : $CurrentForm->getValue("x_KEU_NOTA");
        if (!$this->KEU_NOTA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_NOTA->Visible = false; // Disable update for API request
            } else {
                $this->KEU_NOTA->setFormValue($val);
            }
        }

        // Check field name 'KEU_PENCATATAN' first before field var 'x_KEU_PENCATATAN'
        $val = $CurrentForm->hasValue("KEU_PENCATATAN") ? $CurrentForm->getValue("KEU_PENCATATAN") : $CurrentForm->getValue("x_KEU_PENCATATAN");
        if (!$this->KEU_PENCATATAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_PENCATATAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_PENCATATAN->setFormValue($val);
            }
        }

        // Check field name 'KEU_LAPORAN' first before field var 'x_KEU_LAPORAN'
        $val = $CurrentForm->hasValue("KEU_LAPORAN") ? $CurrentForm->getValue("KEU_LAPORAN") : $CurrentForm->getValue("x_KEU_LAPORAN");
        if (!$this->KEU_LAPORAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_LAPORAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_LAPORAN->setFormValue($val);
            }
        }

        // Check field name 'KEU_UTANGMODAL' first before field var 'x_KEU_UTANGMODAL'
        $val = $CurrentForm->hasValue("KEU_UTANGMODAL") ? $CurrentForm->getValue("KEU_UTANGMODAL") : $CurrentForm->getValue("x_KEU_UTANGMODAL");
        if (!$this->KEU_UTANGMODAL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_UTANGMODAL->Visible = false; // Disable update for API request
            } else {
                $this->KEU_UTANGMODAL->setFormValue($val);
            }
        }

        // Check field name 'KEU_CATATNASET' first before field var 'x_KEU_CATATNASET'
        $val = $CurrentForm->hasValue("KEU_CATATNASET") ? $CurrentForm->getValue("KEU_CATATNASET") : $CurrentForm->getValue("x_KEU_CATATNASET");
        if (!$this->KEU_CATATNASET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_CATATNASET->Visible = false; // Disable update for API request
            } else {
                $this->KEU_CATATNASET->setFormValue($val);
            }
        }

        // Check field name 'KEU_NONTUNAI' first before field var 'x_KEU_NONTUNAI'
        $val = $CurrentForm->hasValue("KEU_NONTUNAI") ? $CurrentForm->getValue("KEU_NONTUNAI") : $CurrentForm->getValue("x_KEU_NONTUNAI");
        if (!$this->KEU_NONTUNAI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_NONTUNAI->Visible = false; // Disable update for API request
            } else {
                $this->KEU_NONTUNAI->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->KEU_USAHAUTAMA->CurrentValue = $this->KEU_USAHAUTAMA->FormValue;
        $this->KEU_PENGELOLAAN->CurrentValue = $this->KEU_PENGELOLAAN->FormValue;
        $this->KEU_NOTA->CurrentValue = $this->KEU_NOTA->FormValue;
        $this->KEU_PENCATATAN->CurrentValue = $this->KEU_PENCATATAN->FormValue;
        $this->KEU_LAPORAN->CurrentValue = $this->KEU_LAPORAN->FormValue;
        $this->KEU_UTANGMODAL->CurrentValue = $this->KEU_UTANGMODAL->FormValue;
        $this->KEU_CATATNASET->CurrentValue = $this->KEU_CATATNASET->FormValue;
        $this->KEU_NONTUNAI->CurrentValue = $this->KEU_NONTUNAI->FormValue;
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
        $this->KEU_USAHAUTAMA->setDbValue($row['KEU_USAHAUTAMA']);
        $this->KEU_PENGELOLAAN->setDbValue($row['KEU_PENGELOLAAN']);
        $this->KEU_NOTA->setDbValue($row['KEU_NOTA']);
        $this->KEU_PENCATATAN->setDbValue($row['KEU_PENCATATAN']);
        $this->KEU_LAPORAN->setDbValue($row['KEU_LAPORAN']);
        $this->KEU_UTANGMODAL->setDbValue($row['KEU_UTANGMODAL']);
        $this->KEU_CATATNASET->setDbValue($row['KEU_CATATNASET']);
        $this->KEU_NONTUNAI->setDbValue($row['KEU_NONTUNAI']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['KEU_USAHAUTAMA'] = $this->KEU_USAHAUTAMA->CurrentValue;
        $row['KEU_PENGELOLAAN'] = $this->KEU_PENGELOLAAN->CurrentValue;
        $row['KEU_NOTA'] = $this->KEU_NOTA->CurrentValue;
        $row['KEU_PENCATATAN'] = $this->KEU_PENCATATAN->CurrentValue;
        $row['KEU_LAPORAN'] = $this->KEU_LAPORAN->CurrentValue;
        $row['KEU_UTANGMODAL'] = $this->KEU_UTANGMODAL->CurrentValue;
        $row['KEU_CATATNASET'] = $this->KEU_CATATNASET->CurrentValue;
        $row['KEU_NONTUNAI'] = $this->KEU_NONTUNAI->CurrentValue;
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

        // NIK

        // KEU_USAHAUTAMA

        // KEU_PENGELOLAAN

        // KEU_NOTA

        // KEU_PENCATATAN

        // KEU_LAPORAN

        // KEU_UTANGMODAL

        // KEU_CATATNASET

        // KEU_NONTUNAI
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // KEU_USAHAUTAMA
            $curVal = strval($this->KEU_USAHAUTAMA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
                if ($this->KEU_USAHAUTAMA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_USAHAUTAMA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->displayValue($arwrk);
                    } else {
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = null;
            }
            $this->KEU_USAHAUTAMA->ViewCustomAttributes = "";

            // KEU_PENGELOLAAN
            $curVal = strval($this->KEU_PENGELOLAAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
                if ($this->KEU_PENGELOLAAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENGELOLAAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = null;
            }
            $this->KEU_PENGELOLAAN->ViewCustomAttributes = "";

            // KEU_NOTA
            $curVal = strval($this->KEU_NOTA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
                if ($this->KEU_NOTA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NOTA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NOTA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->displayValue($arwrk);
                    } else {
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NOTA->ViewValue = null;
            }
            $this->KEU_NOTA->ViewCustomAttributes = "";

            // KEU_PENCATATAN
            $curVal = strval($this->KEU_PENCATATAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
                if ($this->KEU_PENCATATAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENCATATAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENCATATAN->ViewValue = null;
            }
            $this->KEU_PENCATATAN->ViewCustomAttributes = "";

            // KEU_LAPORAN
            $curVal = strval($this->KEU_LAPORAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
                if ($this->KEU_LAPORAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_LAPORAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->displayValue($arwrk);
                    } else {
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_LAPORAN->ViewValue = null;
            }
            $this->KEU_LAPORAN->ViewCustomAttributes = "";

            // KEU_UTANGMODAL
            $curVal = strval($this->KEU_UTANGMODAL->CurrentValue);
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
                if ($this->KEU_UTANGMODAL->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_UTANGMODAL->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->displayValue($arwrk);
                    } else {
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->CurrentValue;
                    }
                }
            } else {
                $this->KEU_UTANGMODAL->ViewValue = null;
            }
            $this->KEU_UTANGMODAL->ViewCustomAttributes = "";

            // KEU_CATATNASET
            $curVal = strval($this->KEU_CATATNASET->CurrentValue);
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
                if ($this->KEU_CATATNASET->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_CATATNASET->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->displayValue($arwrk);
                    } else {
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->CurrentValue;
                    }
                }
            } else {
                $this->KEU_CATATNASET->ViewValue = null;
            }
            $this->KEU_CATATNASET->ViewCustomAttributes = "";

            // KEU_NONTUNAI
            $curVal = strval($this->KEU_NONTUNAI->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
                if ($this->KEU_NONTUNAI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Non Tunai'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NONTUNAI->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->displayValue($arwrk);
                    } else {
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NONTUNAI->ViewValue = null;
            }
            $this->KEU_NONTUNAI->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";
            $this->KEU_USAHAUTAMA->TooltipValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";
            $this->KEU_PENGELOLAAN->TooltipValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";
            $this->KEU_NOTA->TooltipValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";
            $this->KEU_PENCATATAN->TooltipValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";
            $this->KEU_LAPORAN->TooltipValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";
            $this->KEU_UTANGMODAL->TooltipValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";
            $this->KEU_CATATNASET->TooltipValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
            $this->KEU_NONTUNAI->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->EditAttrs["class"] = "form-control";
            $this->KEU_USAHAUTAMA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_USAHAUTAMA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->Lookup !== null && is_array($this->KEU_USAHAUTAMA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_USAHAUTAMA->ViewValue !== null) { // Load from cache
                $this->KEU_USAHAUTAMA->EditValue = array_values($this->KEU_USAHAUTAMA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_USAHAUTAMA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Sumber Utama'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_USAHAUTAMA->EditValue = $arwrk;
            }
            $this->KEU_USAHAUTAMA->PlaceHolder = RemoveHtml($this->KEU_USAHAUTAMA->caption());

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENGELOLAAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENGELOLAAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->Lookup !== null && is_array($this->KEU_PENGELOLAAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENGELOLAAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENGELOLAAN->EditValue = array_values($this->KEU_PENGELOLAAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENGELOLAAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Keuangan Perusahaan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENGELOLAAN->EditValue = $arwrk;
            }
            $this->KEU_PENGELOLAAN->PlaceHolder = RemoveHtml($this->KEU_PENGELOLAAN->caption());

            // KEU_NOTA
            $this->KEU_NOTA->EditAttrs["class"] = "form-control";
            $this->KEU_NOTA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NOTA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
            } else {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->Lookup !== null && is_array($this->KEU_NOTA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NOTA->ViewValue !== null) { // Load from cache
                $this->KEU_NOTA->EditValue = array_values($this->KEU_NOTA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NOTA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Nota'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NOTA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NOTA->EditValue = $arwrk;
            }
            $this->KEU_NOTA->PlaceHolder = RemoveHtml($this->KEU_NOTA->caption());

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENCATATAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENCATATAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->Lookup !== null && is_array($this->KEU_PENCATATAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENCATATAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENCATATAN->EditValue = array_values($this->KEU_PENCATATAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENCATATAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENCATATAN->EditValue = $arwrk;
            }
            $this->KEU_PENCATATAN->PlaceHolder = RemoveHtml($this->KEU_PENCATATAN->caption());

            // KEU_LAPORAN
            $this->KEU_LAPORAN->EditAttrs["class"] = "form-control";
            $this->KEU_LAPORAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_LAPORAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->Lookup !== null && is_array($this->KEU_LAPORAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_LAPORAN->ViewValue !== null) { // Load from cache
                $this->KEU_LAPORAN->EditValue = array_values($this->KEU_LAPORAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_LAPORAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Laporan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_LAPORAN->EditValue = $arwrk;
            }
            $this->KEU_LAPORAN->PlaceHolder = RemoveHtml($this->KEU_LAPORAN->caption());

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->EditAttrs["class"] = "form-control";
            $this->KEU_UTANGMODAL->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_UTANGMODAL->CurrentValue));
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
            } else {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->Lookup !== null && is_array($this->KEU_UTANGMODAL->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_UTANGMODAL->ViewValue !== null) { // Load from cache
                $this->KEU_UTANGMODAL->EditValue = array_values($this->KEU_UTANGMODAL->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_UTANGMODAL->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pinjaman Bank'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_UTANGMODAL->EditValue = $arwrk;
            }
            $this->KEU_UTANGMODAL->PlaceHolder = RemoveHtml($this->KEU_UTANGMODAL->caption());

            // KEU_CATATNASET
            $this->KEU_CATATNASET->EditAttrs["class"] = "form-control";
            $this->KEU_CATATNASET->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_CATATNASET->CurrentValue));
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
            } else {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->Lookup !== null && is_array($this->KEU_CATATNASET->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_CATATNASET->ViewValue !== null) { // Load from cache
                $this->KEU_CATATNASET->EditValue = array_values($this->KEU_CATATNASET->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_CATATNASET->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Aset'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_CATATNASET->EditValue = $arwrk;
            }
            $this->KEU_CATATNASET->PlaceHolder = RemoveHtml($this->KEU_CATATNASET->caption());

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->EditAttrs["class"] = "form-control";
            $this->KEU_NONTUNAI->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NONTUNAI->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
            } else {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->Lookup !== null && is_array($this->KEU_NONTUNAI->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NONTUNAI->ViewValue !== null) { // Load from cache
                $this->KEU_NONTUNAI->EditValue = array_values($this->KEU_NONTUNAI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NONTUNAI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Non Tunai'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NONTUNAI->EditValue = $arwrk;
            }
            $this->KEU_NONTUNAI->PlaceHolder = RemoveHtml($this->KEU_NONTUNAI->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
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
        if ($this->KEU_USAHAUTAMA->Required) {
            if (!$this->KEU_USAHAUTAMA->IsDetailKey && EmptyValue($this->KEU_USAHAUTAMA->FormValue)) {
                $this->KEU_USAHAUTAMA->addErrorMessage(str_replace("%s", $this->KEU_USAHAUTAMA->caption(), $this->KEU_USAHAUTAMA->RequiredErrorMessage));
            }
        }
        if ($this->KEU_PENGELOLAAN->Required) {
            if (!$this->KEU_PENGELOLAAN->IsDetailKey && EmptyValue($this->KEU_PENGELOLAAN->FormValue)) {
                $this->KEU_PENGELOLAAN->addErrorMessage(str_replace("%s", $this->KEU_PENGELOLAAN->caption(), $this->KEU_PENGELOLAAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_NOTA->Required) {
            if (!$this->KEU_NOTA->IsDetailKey && EmptyValue($this->KEU_NOTA->FormValue)) {
                $this->KEU_NOTA->addErrorMessage(str_replace("%s", $this->KEU_NOTA->caption(), $this->KEU_NOTA->RequiredErrorMessage));
            }
        }
        if ($this->KEU_PENCATATAN->Required) {
            if (!$this->KEU_PENCATATAN->IsDetailKey && EmptyValue($this->KEU_PENCATATAN->FormValue)) {
                $this->KEU_PENCATATAN->addErrorMessage(str_replace("%s", $this->KEU_PENCATATAN->caption(), $this->KEU_PENCATATAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_LAPORAN->Required) {
            if (!$this->KEU_LAPORAN->IsDetailKey && EmptyValue($this->KEU_LAPORAN->FormValue)) {
                $this->KEU_LAPORAN->addErrorMessage(str_replace("%s", $this->KEU_LAPORAN->caption(), $this->KEU_LAPORAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_UTANGMODAL->Required) {
            if (!$this->KEU_UTANGMODAL->IsDetailKey && EmptyValue($this->KEU_UTANGMODAL->FormValue)) {
                $this->KEU_UTANGMODAL->addErrorMessage(str_replace("%s", $this->KEU_UTANGMODAL->caption(), $this->KEU_UTANGMODAL->RequiredErrorMessage));
            }
        }
        if ($this->KEU_CATATNASET->Required) {
            if (!$this->KEU_CATATNASET->IsDetailKey && EmptyValue($this->KEU_CATATNASET->FormValue)) {
                $this->KEU_CATATNASET->addErrorMessage(str_replace("%s", $this->KEU_CATATNASET->caption(), $this->KEU_CATATNASET->RequiredErrorMessage));
            }
        }
        if ($this->KEU_NONTUNAI->Required) {
            if (!$this->KEU_NONTUNAI->IsDetailKey && EmptyValue($this->KEU_NONTUNAI->FormValue)) {
                $this->KEU_NONTUNAI->addErrorMessage(str_replace("%s", $this->KEU_NONTUNAI->caption(), $this->KEU_NONTUNAI->RequiredErrorMessage));
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
        $this->NIK->CurrentValue = CurrentUserName();
        $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "");

        // KEU_USAHAUTAMA
        $this->KEU_USAHAUTAMA->setDbValueDef($rsnew, $this->KEU_USAHAUTAMA->CurrentValue, null, false);

        // KEU_PENGELOLAAN
        $this->KEU_PENGELOLAAN->setDbValueDef($rsnew, $this->KEU_PENGELOLAAN->CurrentValue, null, false);

        // KEU_NOTA
        $this->KEU_NOTA->setDbValueDef($rsnew, $this->KEU_NOTA->CurrentValue, null, false);

        // KEU_PENCATATAN
        $this->KEU_PENCATATAN->setDbValueDef($rsnew, $this->KEU_PENCATATAN->CurrentValue, null, false);

        // KEU_LAPORAN
        $this->KEU_LAPORAN->setDbValueDef($rsnew, $this->KEU_LAPORAN->CurrentValue, null, false);

        // KEU_UTANGMODAL
        $this->KEU_UTANGMODAL->setDbValueDef($rsnew, $this->KEU_UTANGMODAL->CurrentValue, null, false);

        // KEU_CATATNASET
        $this->KEU_CATATNASET->setDbValueDef($rsnew, $this->KEU_CATATNASET->CurrentValue, null, false);

        // KEU_NONTUNAI
        $this->KEU_NONTUNAI->setDbValueDef($rsnew, $this->KEU_NONTUNAI->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekkeuanganlist"), "", $this->TableVar, true);
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
                case "x_KEU_USAHAUTAMA":
                    $lookupFilter = function () {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENGELOLAAN":
                    $lookupFilter = function () {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NOTA":
                    $lookupFilter = function () {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENCATATAN":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_LAPORAN":
                    $lookupFilter = function () {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_UTANGMODAL":
                    $lookupFilter = function () {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_CATATNASET":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NONTUNAI":
                    $lookupFilter = function () {
                        return "`subkat`='Non Tunai'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
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
