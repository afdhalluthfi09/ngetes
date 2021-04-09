<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekdigimarkAdd extends UmkmAspekdigimark
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekdigimark';

    // Page object name
    public $PageObjName = "UmkmAspekdigimarkAdd";

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

        // Table object (umkm_aspekdigimark)
        if (!isset($GLOBALS["umkm_aspekdigimark"]) || get_class($GLOBALS["umkm_aspekdigimark"]) == PROJECT_NAMESPACE . "umkm_aspekdigimark") {
            $GLOBALS["umkm_aspekdigimark"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekdigimark');
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
                $doc = new $class(Container("umkm_aspekdigimark"));
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
                    if ($pageName == "umkmaspekdigimarkview") {
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
        $this->DM_CHATTING->setVisibility();
        $this->DM_MEDSOS->setVisibility();
        $this->DM_MP->setVisibility();
        $this->DM_GMB->setVisibility();
        $this->DM_WEB->setVisibility();
        $this->DM_UPDATEMEDSOS->setVisibility();
        $this->DM_UPDATEWEBSITE->setVisibility();
        $this->DM_GOOGLEINDEX->setVisibility();
        $this->DM_IKLANBERBAYAR->setVisibility();
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
        $this->setupLookupOptions($this->DM_CHATTING);
        $this->setupLookupOptions($this->DM_MEDSOS);
        $this->setupLookupOptions($this->DM_MP);
        $this->setupLookupOptions($this->DM_GMB);
        $this->setupLookupOptions($this->DM_WEB);
        $this->setupLookupOptions($this->DM_UPDATEMEDSOS);
        $this->setupLookupOptions($this->DM_UPDATEWEBSITE);
        $this->setupLookupOptions($this->DM_GOOGLEINDEX);
        $this->setupLookupOptions($this->DM_IKLANBERBAYAR);

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
                    $this->terminate("umkmaspekdigimarklist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "umkmaspekdigimarklist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "umkmaspekdigimarkview") {
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
        $this->DM_CHATTING->CurrentValue = null;
        $this->DM_CHATTING->OldValue = $this->DM_CHATTING->CurrentValue;
        $this->DM_MEDSOS->CurrentValue = null;
        $this->DM_MEDSOS->OldValue = $this->DM_MEDSOS->CurrentValue;
        $this->DM_MP->CurrentValue = null;
        $this->DM_MP->OldValue = $this->DM_MP->CurrentValue;
        $this->DM_GMB->CurrentValue = null;
        $this->DM_GMB->OldValue = $this->DM_GMB->CurrentValue;
        $this->DM_WEB->CurrentValue = null;
        $this->DM_WEB->OldValue = $this->DM_WEB->CurrentValue;
        $this->DM_UPDATEMEDSOS->CurrentValue = null;
        $this->DM_UPDATEMEDSOS->OldValue = $this->DM_UPDATEMEDSOS->CurrentValue;
        $this->DM_UPDATEWEBSITE->CurrentValue = null;
        $this->DM_UPDATEWEBSITE->OldValue = $this->DM_UPDATEWEBSITE->CurrentValue;
        $this->DM_GOOGLEINDEX->CurrentValue = null;
        $this->DM_GOOGLEINDEX->OldValue = $this->DM_GOOGLEINDEX->CurrentValue;
        $this->DM_IKLANBERBAYAR->CurrentValue = null;
        $this->DM_IKLANBERBAYAR->OldValue = $this->DM_IKLANBERBAYAR->CurrentValue;
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

        // Check field name 'DM_CHATTING' first before field var 'x_DM_CHATTING'
        $val = $CurrentForm->hasValue("DM_CHATTING") ? $CurrentForm->getValue("DM_CHATTING") : $CurrentForm->getValue("x_DM_CHATTING");
        if (!$this->DM_CHATTING->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_CHATTING->Visible = false; // Disable update for API request
            } else {
                $this->DM_CHATTING->setFormValue($val);
            }
        }

        // Check field name 'DM_MEDSOS' first before field var 'x_DM_MEDSOS'
        $val = $CurrentForm->hasValue("DM_MEDSOS") ? $CurrentForm->getValue("DM_MEDSOS") : $CurrentForm->getValue("x_DM_MEDSOS");
        if (!$this->DM_MEDSOS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_MEDSOS->Visible = false; // Disable update for API request
            } else {
                $this->DM_MEDSOS->setFormValue($val);
            }
        }

        // Check field name 'DM_MP' first before field var 'x_DM_MP'
        $val = $CurrentForm->hasValue("DM_MP") ? $CurrentForm->getValue("DM_MP") : $CurrentForm->getValue("x_DM_MP");
        if (!$this->DM_MP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_MP->Visible = false; // Disable update for API request
            } else {
                $this->DM_MP->setFormValue($val);
            }
        }

        // Check field name 'DM_GMB' first before field var 'x_DM_GMB'
        $val = $CurrentForm->hasValue("DM_GMB") ? $CurrentForm->getValue("DM_GMB") : $CurrentForm->getValue("x_DM_GMB");
        if (!$this->DM_GMB->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_GMB->Visible = false; // Disable update for API request
            } else {
                $this->DM_GMB->setFormValue($val);
            }
        }

        // Check field name 'DM_WEB' first before field var 'x_DM_WEB'
        $val = $CurrentForm->hasValue("DM_WEB") ? $CurrentForm->getValue("DM_WEB") : $CurrentForm->getValue("x_DM_WEB");
        if (!$this->DM_WEB->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_WEB->Visible = false; // Disable update for API request
            } else {
                $this->DM_WEB->setFormValue($val);
            }
        }

        // Check field name 'DM_UPDATEMEDSOS' first before field var 'x_DM_UPDATEMEDSOS'
        $val = $CurrentForm->hasValue("DM_UPDATEMEDSOS") ? $CurrentForm->getValue("DM_UPDATEMEDSOS") : $CurrentForm->getValue("x_DM_UPDATEMEDSOS");
        if (!$this->DM_UPDATEMEDSOS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_UPDATEMEDSOS->Visible = false; // Disable update for API request
            } else {
                $this->DM_UPDATEMEDSOS->setFormValue($val);
            }
        }

        // Check field name 'DM_UPDATEWEBSITE' first before field var 'x_DM_UPDATEWEBSITE'
        $val = $CurrentForm->hasValue("DM_UPDATEWEBSITE") ? $CurrentForm->getValue("DM_UPDATEWEBSITE") : $CurrentForm->getValue("x_DM_UPDATEWEBSITE");
        if (!$this->DM_UPDATEWEBSITE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_UPDATEWEBSITE->Visible = false; // Disable update for API request
            } else {
                $this->DM_UPDATEWEBSITE->setFormValue($val);
            }
        }

        // Check field name 'DM_GOOGLEINDEX' first before field var 'x_DM_GOOGLEINDEX'
        $val = $CurrentForm->hasValue("DM_GOOGLEINDEX") ? $CurrentForm->getValue("DM_GOOGLEINDEX") : $CurrentForm->getValue("x_DM_GOOGLEINDEX");
        if (!$this->DM_GOOGLEINDEX->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_GOOGLEINDEX->Visible = false; // Disable update for API request
            } else {
                $this->DM_GOOGLEINDEX->setFormValue($val);
            }
        }

        // Check field name 'DM_IKLANBERBAYAR' first before field var 'x_DM_IKLANBERBAYAR'
        $val = $CurrentForm->hasValue("DM_IKLANBERBAYAR") ? $CurrentForm->getValue("DM_IKLANBERBAYAR") : $CurrentForm->getValue("x_DM_IKLANBERBAYAR");
        if (!$this->DM_IKLANBERBAYAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->DM_IKLANBERBAYAR->Visible = false; // Disable update for API request
            } else {
                $this->DM_IKLANBERBAYAR->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->DM_CHATTING->CurrentValue = $this->DM_CHATTING->FormValue;
        $this->DM_MEDSOS->CurrentValue = $this->DM_MEDSOS->FormValue;
        $this->DM_MP->CurrentValue = $this->DM_MP->FormValue;
        $this->DM_GMB->CurrentValue = $this->DM_GMB->FormValue;
        $this->DM_WEB->CurrentValue = $this->DM_WEB->FormValue;
        $this->DM_UPDATEMEDSOS->CurrentValue = $this->DM_UPDATEMEDSOS->FormValue;
        $this->DM_UPDATEWEBSITE->CurrentValue = $this->DM_UPDATEWEBSITE->FormValue;
        $this->DM_GOOGLEINDEX->CurrentValue = $this->DM_GOOGLEINDEX->FormValue;
        $this->DM_IKLANBERBAYAR->CurrentValue = $this->DM_IKLANBERBAYAR->FormValue;
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
        $this->DM_CHATTING->setDbValue($row['DM_CHATTING']);
        $this->DM_MEDSOS->setDbValue($row['DM_MEDSOS']);
        $this->DM_MP->setDbValue($row['DM_MP']);
        $this->DM_GMB->setDbValue($row['DM_GMB']);
        $this->DM_WEB->setDbValue($row['DM_WEB']);
        $this->DM_UPDATEMEDSOS->setDbValue($row['DM_UPDATEMEDSOS']);
        $this->DM_UPDATEWEBSITE->setDbValue($row['DM_UPDATEWEBSITE']);
        $this->DM_GOOGLEINDEX->setDbValue($row['DM_GOOGLEINDEX']);
        $this->DM_IKLANBERBAYAR->setDbValue($row['DM_IKLANBERBAYAR']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['DM_CHATTING'] = $this->DM_CHATTING->CurrentValue;
        $row['DM_MEDSOS'] = $this->DM_MEDSOS->CurrentValue;
        $row['DM_MP'] = $this->DM_MP->CurrentValue;
        $row['DM_GMB'] = $this->DM_GMB->CurrentValue;
        $row['DM_WEB'] = $this->DM_WEB->CurrentValue;
        $row['DM_UPDATEMEDSOS'] = $this->DM_UPDATEMEDSOS->CurrentValue;
        $row['DM_UPDATEWEBSITE'] = $this->DM_UPDATEWEBSITE->CurrentValue;
        $row['DM_GOOGLEINDEX'] = $this->DM_GOOGLEINDEX->CurrentValue;
        $row['DM_IKLANBERBAYAR'] = $this->DM_IKLANBERBAYAR->CurrentValue;
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

        // DM_CHATTING

        // DM_MEDSOS

        // DM_MP

        // DM_GMB

        // DM_WEB

        // DM_UPDATEMEDSOS

        // DM_UPDATEWEBSITE

        // DM_GOOGLEINDEX

        // DM_IKLANBERBAYAR
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // DM_CHATTING
            $curVal = strval($this->DM_CHATTING->CurrentValue);
            if ($curVal != "") {
                $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->lookupCacheOption($curVal);
                if ($this->DM_CHATTING->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Chatting'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_CHATTING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_CHATTING->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->displayValue($arwrk);
                    } else {
                        $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->CurrentValue;
                    }
                }
            } else {
                $this->DM_CHATTING->ViewValue = null;
            }
            $this->DM_CHATTING->ViewCustomAttributes = "";

            // DM_MEDSOS
            $curVal = strval($this->DM_MEDSOS->CurrentValue);
            if ($curVal != "") {
                $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->lookupCacheOption($curVal);
                if ($this->DM_MEDSOS->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Medsos'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_MEDSOS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_MEDSOS->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->displayValue($arwrk);
                    } else {
                        $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->CurrentValue;
                    }
                }
            } else {
                $this->DM_MEDSOS->ViewValue = null;
            }
            $this->DM_MEDSOS->ViewCustomAttributes = "";

            // DM_MP
            $curVal = strval($this->DM_MP->CurrentValue);
            if ($curVal != "") {
                $this->DM_MP->ViewValue = $this->DM_MP->lookupCacheOption($curVal);
                if ($this->DM_MP->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Marketplace'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_MP->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_MP->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_MP->ViewValue = $this->DM_MP->displayValue($arwrk);
                    } else {
                        $this->DM_MP->ViewValue = $this->DM_MP->CurrentValue;
                    }
                }
            } else {
                $this->DM_MP->ViewValue = null;
            }
            $this->DM_MP->ViewCustomAttributes = "";

            // DM_GMB
            $curVal = strval($this->DM_GMB->CurrentValue);
            if ($curVal != "") {
                $this->DM_GMB->ViewValue = $this->DM_GMB->lookupCacheOption($curVal);
                if ($this->DM_GMB->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='GMB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_GMB->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_GMB->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_GMB->ViewValue = $this->DM_GMB->displayValue($arwrk);
                    } else {
                        $this->DM_GMB->ViewValue = $this->DM_GMB->CurrentValue;
                    }
                }
            } else {
                $this->DM_GMB->ViewValue = null;
            }
            $this->DM_GMB->ViewCustomAttributes = "";

            // DM_WEB
            $curVal = strval($this->DM_WEB->CurrentValue);
            if ($curVal != "") {
                $this->DM_WEB->ViewValue = $this->DM_WEB->lookupCacheOption($curVal);
                if ($this->DM_WEB->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Website'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_WEB->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_WEB->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_WEB->ViewValue = $this->DM_WEB->displayValue($arwrk);
                    } else {
                        $this->DM_WEB->ViewValue = $this->DM_WEB->CurrentValue;
                    }
                }
            } else {
                $this->DM_WEB->ViewValue = null;
            }
            $this->DM_WEB->ViewCustomAttributes = "";

            // DM_UPDATEMEDSOS
            $curVal = strval($this->DM_UPDATEMEDSOS->CurrentValue);
            if ($curVal != "") {
                $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->lookupCacheOption($curVal);
                if ($this->DM_UPDATEMEDSOS->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Update Medsos'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_UPDATEMEDSOS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_UPDATEMEDSOS->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->displayValue($arwrk);
                    } else {
                        $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->CurrentValue;
                    }
                }
            } else {
                $this->DM_UPDATEMEDSOS->ViewValue = null;
            }
            $this->DM_UPDATEMEDSOS->ViewCustomAttributes = "";

            // DM_UPDATEWEBSITE
            $curVal = strval($this->DM_UPDATEWEBSITE->CurrentValue);
            if ($curVal != "") {
                $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->lookupCacheOption($curVal);
                if ($this->DM_UPDATEWEBSITE->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Update Website'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_UPDATEWEBSITE->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_UPDATEWEBSITE->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->displayValue($arwrk);
                    } else {
                        $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->CurrentValue;
                    }
                }
            } else {
                $this->DM_UPDATEWEBSITE->ViewValue = null;
            }
            $this->DM_UPDATEWEBSITE->ViewCustomAttributes = "";

            // DM_GOOGLEINDEX
            $curVal = strval($this->DM_GOOGLEINDEX->CurrentValue);
            if ($curVal != "") {
                $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->lookupCacheOption($curVal);
                if ($this->DM_GOOGLEINDEX->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='SEO'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_GOOGLEINDEX->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_GOOGLEINDEX->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->displayValue($arwrk);
                    } else {
                        $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->CurrentValue;
                    }
                }
            } else {
                $this->DM_GOOGLEINDEX->ViewValue = null;
            }
            $this->DM_GOOGLEINDEX->ViewCustomAttributes = "";

            // DM_IKLANBERBAYAR
            $curVal = strval($this->DM_IKLANBERBAYAR->CurrentValue);
            if ($curVal != "") {
                $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->lookupCacheOption($curVal);
                if ($this->DM_IKLANBERBAYAR->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='ADS'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->DM_IKLANBERBAYAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->DM_IKLANBERBAYAR->Lookup->renderViewRow($rswrk[0]);
                        $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->displayValue($arwrk);
                    } else {
                        $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->CurrentValue;
                    }
                }
            } else {
                $this->DM_IKLANBERBAYAR->ViewValue = null;
            }
            $this->DM_IKLANBERBAYAR->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // DM_CHATTING
            $this->DM_CHATTING->LinkCustomAttributes = "";
            $this->DM_CHATTING->HrefValue = "";
            $this->DM_CHATTING->TooltipValue = "";

            // DM_MEDSOS
            $this->DM_MEDSOS->LinkCustomAttributes = "";
            $this->DM_MEDSOS->HrefValue = "";
            $this->DM_MEDSOS->TooltipValue = "";

            // DM_MP
            $this->DM_MP->LinkCustomAttributes = "";
            $this->DM_MP->HrefValue = "";
            $this->DM_MP->TooltipValue = "";

            // DM_GMB
            $this->DM_GMB->LinkCustomAttributes = "";
            $this->DM_GMB->HrefValue = "";
            $this->DM_GMB->TooltipValue = "";

            // DM_WEB
            $this->DM_WEB->LinkCustomAttributes = "";
            $this->DM_WEB->HrefValue = "";
            $this->DM_WEB->TooltipValue = "";

            // DM_UPDATEMEDSOS
            $this->DM_UPDATEMEDSOS->LinkCustomAttributes = "";
            $this->DM_UPDATEMEDSOS->HrefValue = "";
            $this->DM_UPDATEMEDSOS->TooltipValue = "";

            // DM_UPDATEWEBSITE
            $this->DM_UPDATEWEBSITE->LinkCustomAttributes = "";
            $this->DM_UPDATEWEBSITE->HrefValue = "";
            $this->DM_UPDATEWEBSITE->TooltipValue = "";

            // DM_GOOGLEINDEX
            $this->DM_GOOGLEINDEX->LinkCustomAttributes = "";
            $this->DM_GOOGLEINDEX->HrefValue = "";
            $this->DM_GOOGLEINDEX->TooltipValue = "";

            // DM_IKLANBERBAYAR
            $this->DM_IKLANBERBAYAR->LinkCustomAttributes = "";
            $this->DM_IKLANBERBAYAR->HrefValue = "";
            $this->DM_IKLANBERBAYAR->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // DM_CHATTING
            $this->DM_CHATTING->EditAttrs["class"] = "form-control";
            $this->DM_CHATTING->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_CHATTING->CurrentValue));
            if ($curVal != "") {
                $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->lookupCacheOption($curVal);
            } else {
                $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->Lookup !== null && is_array($this->DM_CHATTING->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_CHATTING->ViewValue !== null) { // Load from cache
                $this->DM_CHATTING->EditValue = array_values($this->DM_CHATTING->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_CHATTING->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Chatting'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_CHATTING->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_CHATTING->EditValue = $arwrk;
            }
            $this->DM_CHATTING->PlaceHolder = RemoveHtml($this->DM_CHATTING->caption());

            // DM_MEDSOS
            $this->DM_MEDSOS->EditAttrs["class"] = "form-control";
            $this->DM_MEDSOS->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_MEDSOS->CurrentValue));
            if ($curVal != "") {
                $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->lookupCacheOption($curVal);
            } else {
                $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->Lookup !== null && is_array($this->DM_MEDSOS->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_MEDSOS->ViewValue !== null) { // Load from cache
                $this->DM_MEDSOS->EditValue = array_values($this->DM_MEDSOS->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_MEDSOS->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Medsos'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_MEDSOS->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_MEDSOS->EditValue = $arwrk;
            }
            $this->DM_MEDSOS->PlaceHolder = RemoveHtml($this->DM_MEDSOS->caption());

            // DM_MP
            $this->DM_MP->EditAttrs["class"] = "form-control";
            $this->DM_MP->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_MP->CurrentValue));
            if ($curVal != "") {
                $this->DM_MP->ViewValue = $this->DM_MP->lookupCacheOption($curVal);
            } else {
                $this->DM_MP->ViewValue = $this->DM_MP->Lookup !== null && is_array($this->DM_MP->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_MP->ViewValue !== null) { // Load from cache
                $this->DM_MP->EditValue = array_values($this->DM_MP->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_MP->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Marketplace'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_MP->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_MP->EditValue = $arwrk;
            }
            $this->DM_MP->PlaceHolder = RemoveHtml($this->DM_MP->caption());

            // DM_GMB
            $this->DM_GMB->EditAttrs["class"] = "form-control";
            $this->DM_GMB->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_GMB->CurrentValue));
            if ($curVal != "") {
                $this->DM_GMB->ViewValue = $this->DM_GMB->lookupCacheOption($curVal);
            } else {
                $this->DM_GMB->ViewValue = $this->DM_GMB->Lookup !== null && is_array($this->DM_GMB->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_GMB->ViewValue !== null) { // Load from cache
                $this->DM_GMB->EditValue = array_values($this->DM_GMB->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_GMB->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='GMB'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_GMB->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_GMB->EditValue = $arwrk;
            }
            $this->DM_GMB->PlaceHolder = RemoveHtml($this->DM_GMB->caption());

            // DM_WEB
            $this->DM_WEB->EditAttrs["class"] = "form-control";
            $this->DM_WEB->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_WEB->CurrentValue));
            if ($curVal != "") {
                $this->DM_WEB->ViewValue = $this->DM_WEB->lookupCacheOption($curVal);
            } else {
                $this->DM_WEB->ViewValue = $this->DM_WEB->Lookup !== null && is_array($this->DM_WEB->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_WEB->ViewValue !== null) { // Load from cache
                $this->DM_WEB->EditValue = array_values($this->DM_WEB->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_WEB->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Website'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_WEB->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_WEB->EditValue = $arwrk;
            }
            $this->DM_WEB->PlaceHolder = RemoveHtml($this->DM_WEB->caption());

            // DM_UPDATEMEDSOS
            $this->DM_UPDATEMEDSOS->EditAttrs["class"] = "form-control";
            $this->DM_UPDATEMEDSOS->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_UPDATEMEDSOS->CurrentValue));
            if ($curVal != "") {
                $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->lookupCacheOption($curVal);
            } else {
                $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->Lookup !== null && is_array($this->DM_UPDATEMEDSOS->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_UPDATEMEDSOS->ViewValue !== null) { // Load from cache
                $this->DM_UPDATEMEDSOS->EditValue = array_values($this->DM_UPDATEMEDSOS->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_UPDATEMEDSOS->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Update Medsos'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_UPDATEMEDSOS->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_UPDATEMEDSOS->EditValue = $arwrk;
            }
            $this->DM_UPDATEMEDSOS->PlaceHolder = RemoveHtml($this->DM_UPDATEMEDSOS->caption());

            // DM_UPDATEWEBSITE
            $this->DM_UPDATEWEBSITE->EditAttrs["class"] = "form-control";
            $this->DM_UPDATEWEBSITE->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_UPDATEWEBSITE->CurrentValue));
            if ($curVal != "") {
                $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->lookupCacheOption($curVal);
            } else {
                $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->Lookup !== null && is_array($this->DM_UPDATEWEBSITE->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_UPDATEWEBSITE->ViewValue !== null) { // Load from cache
                $this->DM_UPDATEWEBSITE->EditValue = array_values($this->DM_UPDATEWEBSITE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_UPDATEWEBSITE->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Update Website'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_UPDATEWEBSITE->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_UPDATEWEBSITE->EditValue = $arwrk;
            }
            $this->DM_UPDATEWEBSITE->PlaceHolder = RemoveHtml($this->DM_UPDATEWEBSITE->caption());

            // DM_GOOGLEINDEX
            $this->DM_GOOGLEINDEX->EditAttrs["class"] = "form-control";
            $this->DM_GOOGLEINDEX->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_GOOGLEINDEX->CurrentValue));
            if ($curVal != "") {
                $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->lookupCacheOption($curVal);
            } else {
                $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->Lookup !== null && is_array($this->DM_GOOGLEINDEX->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_GOOGLEINDEX->ViewValue !== null) { // Load from cache
                $this->DM_GOOGLEINDEX->EditValue = array_values($this->DM_GOOGLEINDEX->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_GOOGLEINDEX->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='SEO'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_GOOGLEINDEX->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_GOOGLEINDEX->EditValue = $arwrk;
            }
            $this->DM_GOOGLEINDEX->PlaceHolder = RemoveHtml($this->DM_GOOGLEINDEX->caption());

            // DM_IKLANBERBAYAR
            $this->DM_IKLANBERBAYAR->EditAttrs["class"] = "form-control";
            $this->DM_IKLANBERBAYAR->EditCustomAttributes = "";
            $curVal = trim(strval($this->DM_IKLANBERBAYAR->CurrentValue));
            if ($curVal != "") {
                $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->lookupCacheOption($curVal);
            } else {
                $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->Lookup !== null && is_array($this->DM_IKLANBERBAYAR->Lookup->Options) ? $curVal : null;
            }
            if ($this->DM_IKLANBERBAYAR->ViewValue !== null) { // Load from cache
                $this->DM_IKLANBERBAYAR->EditValue = array_values($this->DM_IKLANBERBAYAR->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->DM_IKLANBERBAYAR->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='ADS'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->DM_IKLANBERBAYAR->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->DM_IKLANBERBAYAR->EditValue = $arwrk;
            }
            $this->DM_IKLANBERBAYAR->PlaceHolder = RemoveHtml($this->DM_IKLANBERBAYAR->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // DM_CHATTING
            $this->DM_CHATTING->LinkCustomAttributes = "";
            $this->DM_CHATTING->HrefValue = "";

            // DM_MEDSOS
            $this->DM_MEDSOS->LinkCustomAttributes = "";
            $this->DM_MEDSOS->HrefValue = "";

            // DM_MP
            $this->DM_MP->LinkCustomAttributes = "";
            $this->DM_MP->HrefValue = "";

            // DM_GMB
            $this->DM_GMB->LinkCustomAttributes = "";
            $this->DM_GMB->HrefValue = "";

            // DM_WEB
            $this->DM_WEB->LinkCustomAttributes = "";
            $this->DM_WEB->HrefValue = "";

            // DM_UPDATEMEDSOS
            $this->DM_UPDATEMEDSOS->LinkCustomAttributes = "";
            $this->DM_UPDATEMEDSOS->HrefValue = "";

            // DM_UPDATEWEBSITE
            $this->DM_UPDATEWEBSITE->LinkCustomAttributes = "";
            $this->DM_UPDATEWEBSITE->HrefValue = "";

            // DM_GOOGLEINDEX
            $this->DM_GOOGLEINDEX->LinkCustomAttributes = "";
            $this->DM_GOOGLEINDEX->HrefValue = "";

            // DM_IKLANBERBAYAR
            $this->DM_IKLANBERBAYAR->LinkCustomAttributes = "";
            $this->DM_IKLANBERBAYAR->HrefValue = "";
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
        if ($this->DM_CHATTING->Required) {
            if (!$this->DM_CHATTING->IsDetailKey && EmptyValue($this->DM_CHATTING->FormValue)) {
                $this->DM_CHATTING->addErrorMessage(str_replace("%s", $this->DM_CHATTING->caption(), $this->DM_CHATTING->RequiredErrorMessage));
            }
        }
        if ($this->DM_MEDSOS->Required) {
            if (!$this->DM_MEDSOS->IsDetailKey && EmptyValue($this->DM_MEDSOS->FormValue)) {
                $this->DM_MEDSOS->addErrorMessage(str_replace("%s", $this->DM_MEDSOS->caption(), $this->DM_MEDSOS->RequiredErrorMessage));
            }
        }
        if ($this->DM_MP->Required) {
            if (!$this->DM_MP->IsDetailKey && EmptyValue($this->DM_MP->FormValue)) {
                $this->DM_MP->addErrorMessage(str_replace("%s", $this->DM_MP->caption(), $this->DM_MP->RequiredErrorMessage));
            }
        }
        if ($this->DM_GMB->Required) {
            if (!$this->DM_GMB->IsDetailKey && EmptyValue($this->DM_GMB->FormValue)) {
                $this->DM_GMB->addErrorMessage(str_replace("%s", $this->DM_GMB->caption(), $this->DM_GMB->RequiredErrorMessage));
            }
        }
        if ($this->DM_WEB->Required) {
            if (!$this->DM_WEB->IsDetailKey && EmptyValue($this->DM_WEB->FormValue)) {
                $this->DM_WEB->addErrorMessage(str_replace("%s", $this->DM_WEB->caption(), $this->DM_WEB->RequiredErrorMessage));
            }
        }
        if ($this->DM_UPDATEMEDSOS->Required) {
            if (!$this->DM_UPDATEMEDSOS->IsDetailKey && EmptyValue($this->DM_UPDATEMEDSOS->FormValue)) {
                $this->DM_UPDATEMEDSOS->addErrorMessage(str_replace("%s", $this->DM_UPDATEMEDSOS->caption(), $this->DM_UPDATEMEDSOS->RequiredErrorMessage));
            }
        }
        if ($this->DM_UPDATEWEBSITE->Required) {
            if (!$this->DM_UPDATEWEBSITE->IsDetailKey && EmptyValue($this->DM_UPDATEWEBSITE->FormValue)) {
                $this->DM_UPDATEWEBSITE->addErrorMessage(str_replace("%s", $this->DM_UPDATEWEBSITE->caption(), $this->DM_UPDATEWEBSITE->RequiredErrorMessage));
            }
        }
        if ($this->DM_GOOGLEINDEX->Required) {
            if (!$this->DM_GOOGLEINDEX->IsDetailKey && EmptyValue($this->DM_GOOGLEINDEX->FormValue)) {
                $this->DM_GOOGLEINDEX->addErrorMessage(str_replace("%s", $this->DM_GOOGLEINDEX->caption(), $this->DM_GOOGLEINDEX->RequiredErrorMessage));
            }
        }
        if ($this->DM_IKLANBERBAYAR->Required) {
            if (!$this->DM_IKLANBERBAYAR->IsDetailKey && EmptyValue($this->DM_IKLANBERBAYAR->FormValue)) {
                $this->DM_IKLANBERBAYAR->addErrorMessage(str_replace("%s", $this->DM_IKLANBERBAYAR->caption(), $this->DM_IKLANBERBAYAR->RequiredErrorMessage));
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

        // DM_CHATTING
        $this->DM_CHATTING->setDbValueDef($rsnew, $this->DM_CHATTING->CurrentValue, null, false);

        // DM_MEDSOS
        $this->DM_MEDSOS->setDbValueDef($rsnew, $this->DM_MEDSOS->CurrentValue, null, false);

        // DM_MP
        $this->DM_MP->setDbValueDef($rsnew, $this->DM_MP->CurrentValue, null, false);

        // DM_GMB
        $this->DM_GMB->setDbValueDef($rsnew, $this->DM_GMB->CurrentValue, null, false);

        // DM_WEB
        $this->DM_WEB->setDbValueDef($rsnew, $this->DM_WEB->CurrentValue, null, false);

        // DM_UPDATEMEDSOS
        $this->DM_UPDATEMEDSOS->setDbValueDef($rsnew, $this->DM_UPDATEMEDSOS->CurrentValue, null, false);

        // DM_UPDATEWEBSITE
        $this->DM_UPDATEWEBSITE->setDbValueDef($rsnew, $this->DM_UPDATEWEBSITE->CurrentValue, null, false);

        // DM_GOOGLEINDEX
        $this->DM_GOOGLEINDEX->setDbValueDef($rsnew, $this->DM_GOOGLEINDEX->CurrentValue, null, false);

        // DM_IKLANBERBAYAR
        $this->DM_IKLANBERBAYAR->setDbValueDef($rsnew, $this->DM_IKLANBERBAYAR->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekdigimarklist"), "", $this->TableVar, true);
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
                case "x_DM_CHATTING":
                    $lookupFilter = function () {
                        return "`subkat`='Chatting'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_MEDSOS":
                    $lookupFilter = function () {
                        return "`subkat`='Medsos'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_MP":
                    $lookupFilter = function () {
                        return "`subkat`='Marketplace'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_GMB":
                    $lookupFilter = function () {
                        return "`subkat`='GMB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_WEB":
                    $lookupFilter = function () {
                        return "`subkat`='Website'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_UPDATEMEDSOS":
                    $lookupFilter = function () {
                        return "`subkat`='Update Medsos'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_UPDATEWEBSITE":
                    $lookupFilter = function () {
                        return "`subkat`='Update Website'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_GOOGLEINDEX":
                    $lookupFilter = function () {
                        return "`subkat`='SEO'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_DM_IKLANBERBAYAR":
                    $lookupFilter = function () {
                        return "`subkat`='ADS'";
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
