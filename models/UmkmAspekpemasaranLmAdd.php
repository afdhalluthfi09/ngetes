<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekpemasaranLmAdd extends UmkmAspekpemasaranLm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "add";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekpemasaran_lm';

    // Page object name
    public $PageObjName = "UmkmAspekpemasaranLmAdd";

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

        // Table object (umkm_aspekpemasaran_lm)
        if (!isset($GLOBALS["umkm_aspekpemasaran_lm"]) || get_class($GLOBALS["umkm_aspekpemasaran_lm"]) == PROJECT_NAMESPACE . "umkm_aspekpemasaran_lm") {
            $GLOBALS["umkm_aspekpemasaran_lm"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekpemasaran_lm');
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
                $doc = new $class(Container("umkm_aspekpemasaran_lm"));
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
                    if ($pageName == "umkmaspekpemasaranlmview") {
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
        $this->MK_KEUNGGULANPRODUK->setVisibility();
        $this->MK_TARGETPASAR->setVisibility();
        $this->MK_KETERSEDIAAN->setVisibility();
        $this->MK_LOGO->setVisibility();
        $this->MK_HKI->setVisibility();
        $this->MK_BRANDING->setVisibility();
        $this->MK_COBRANDING->setVisibility();
        $this->MK_MEDIAOFFLINE->setVisibility();
        $this->MK_RESELLER->setVisibility();
        $this->MK_PASAR->setVisibility();
        $this->MK_PELANGGAN->setVisibility();
        $this->MK_PAMERANMANDIRI->setVisibility();
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
                    $this->terminate("umkmaspekpemasaranlmlist"); // No matching record, return to list
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
                    if (GetPageName($returnUrl) == "umkmaspekpemasaranlmlist") {
                        $returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
                    } elseif (GetPageName($returnUrl) == "umkmaspekpemasaranlmview") {
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
        $this->MK_KEUNGGULANPRODUK->CurrentValue = null;
        $this->MK_KEUNGGULANPRODUK->OldValue = $this->MK_KEUNGGULANPRODUK->CurrentValue;
        $this->MK_TARGETPASAR->CurrentValue = null;
        $this->MK_TARGETPASAR->OldValue = $this->MK_TARGETPASAR->CurrentValue;
        $this->MK_KETERSEDIAAN->CurrentValue = null;
        $this->MK_KETERSEDIAAN->OldValue = $this->MK_KETERSEDIAAN->CurrentValue;
        $this->MK_LOGO->CurrentValue = null;
        $this->MK_LOGO->OldValue = $this->MK_LOGO->CurrentValue;
        $this->MK_HKI->CurrentValue = null;
        $this->MK_HKI->OldValue = $this->MK_HKI->CurrentValue;
        $this->MK_BRANDING->CurrentValue = null;
        $this->MK_BRANDING->OldValue = $this->MK_BRANDING->CurrentValue;
        $this->MK_COBRANDING->CurrentValue = null;
        $this->MK_COBRANDING->OldValue = $this->MK_COBRANDING->CurrentValue;
        $this->MK_MEDIAOFFLINE->CurrentValue = null;
        $this->MK_MEDIAOFFLINE->OldValue = $this->MK_MEDIAOFFLINE->CurrentValue;
        $this->MK_RESELLER->CurrentValue = null;
        $this->MK_RESELLER->OldValue = $this->MK_RESELLER->CurrentValue;
        $this->MK_PASAR->CurrentValue = null;
        $this->MK_PASAR->OldValue = $this->MK_PASAR->CurrentValue;
        $this->MK_PELANGGAN->CurrentValue = null;
        $this->MK_PELANGGAN->OldValue = $this->MK_PELANGGAN->CurrentValue;
        $this->MK_PAMERANMANDIRI->CurrentValue = null;
        $this->MK_PAMERANMANDIRI->OldValue = $this->MK_PAMERANMANDIRI->CurrentValue;
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

        // Check field name 'MK_KEUNGGULANPRODUK' first before field var 'x_MK_KEUNGGULANPRODUK'
        $val = $CurrentForm->hasValue("MK_KEUNGGULANPRODUK") ? $CurrentForm->getValue("MK_KEUNGGULANPRODUK") : $CurrentForm->getValue("x_MK_KEUNGGULANPRODUK");
        if (!$this->MK_KEUNGGULANPRODUK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_KEUNGGULANPRODUK->Visible = false; // Disable update for API request
            } else {
                $this->MK_KEUNGGULANPRODUK->setFormValue($val);
            }
        }

        // Check field name 'MK_TARGETPASAR' first before field var 'x_MK_TARGETPASAR'
        $val = $CurrentForm->hasValue("MK_TARGETPASAR") ? $CurrentForm->getValue("MK_TARGETPASAR") : $CurrentForm->getValue("x_MK_TARGETPASAR");
        if (!$this->MK_TARGETPASAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_TARGETPASAR->Visible = false; // Disable update for API request
            } else {
                $this->MK_TARGETPASAR->setFormValue($val);
            }
        }

        // Check field name 'MK_KETERSEDIAAN' first before field var 'x_MK_KETERSEDIAAN'
        $val = $CurrentForm->hasValue("MK_KETERSEDIAAN") ? $CurrentForm->getValue("MK_KETERSEDIAAN") : $CurrentForm->getValue("x_MK_KETERSEDIAAN");
        if (!$this->MK_KETERSEDIAAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_KETERSEDIAAN->Visible = false; // Disable update for API request
            } else {
                $this->MK_KETERSEDIAAN->setFormValue($val);
            }
        }

        // Check field name 'MK_LOGO' first before field var 'x_MK_LOGO'
        $val = $CurrentForm->hasValue("MK_LOGO") ? $CurrentForm->getValue("MK_LOGO") : $CurrentForm->getValue("x_MK_LOGO");
        if (!$this->MK_LOGO->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_LOGO->Visible = false; // Disable update for API request
            } else {
                $this->MK_LOGO->setFormValue($val);
            }
        }

        // Check field name 'MK_HKI' first before field var 'x_MK_HKI'
        $val = $CurrentForm->hasValue("MK_HKI") ? $CurrentForm->getValue("MK_HKI") : $CurrentForm->getValue("x_MK_HKI");
        if (!$this->MK_HKI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_HKI->Visible = false; // Disable update for API request
            } else {
                $this->MK_HKI->setFormValue($val);
            }
        }

        // Check field name 'MK_BRANDING' first before field var 'x_MK_BRANDING'
        $val = $CurrentForm->hasValue("MK_BRANDING") ? $CurrentForm->getValue("MK_BRANDING") : $CurrentForm->getValue("x_MK_BRANDING");
        if (!$this->MK_BRANDING->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_BRANDING->Visible = false; // Disable update for API request
            } else {
                $this->MK_BRANDING->setFormValue($val);
            }
        }

        // Check field name 'MK_COBRANDING' first before field var 'x_MK_COBRANDING'
        $val = $CurrentForm->hasValue("MK_COBRANDING") ? $CurrentForm->getValue("MK_COBRANDING") : $CurrentForm->getValue("x_MK_COBRANDING");
        if (!$this->MK_COBRANDING->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_COBRANDING->Visible = false; // Disable update for API request
            } else {
                $this->MK_COBRANDING->setFormValue($val);
            }
        }

        // Check field name 'MK_MEDIAOFFLINE' first before field var 'x_MK_MEDIAOFFLINE'
        $val = $CurrentForm->hasValue("MK_MEDIAOFFLINE") ? $CurrentForm->getValue("MK_MEDIAOFFLINE") : $CurrentForm->getValue("x_MK_MEDIAOFFLINE");
        if (!$this->MK_MEDIAOFFLINE->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_MEDIAOFFLINE->Visible = false; // Disable update for API request
            } else {
                $this->MK_MEDIAOFFLINE->setFormValue($val);
            }
        }

        // Check field name 'MK_RESELLER' first before field var 'x_MK_RESELLER'
        $val = $CurrentForm->hasValue("MK_RESELLER") ? $CurrentForm->getValue("MK_RESELLER") : $CurrentForm->getValue("x_MK_RESELLER");
        if (!$this->MK_RESELLER->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_RESELLER->Visible = false; // Disable update for API request
            } else {
                $this->MK_RESELLER->setFormValue($val);
            }
        }

        // Check field name 'MK_PASAR' first before field var 'x_MK_PASAR'
        $val = $CurrentForm->hasValue("MK_PASAR") ? $CurrentForm->getValue("MK_PASAR") : $CurrentForm->getValue("x_MK_PASAR");
        if (!$this->MK_PASAR->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_PASAR->Visible = false; // Disable update for API request
            } else {
                $this->MK_PASAR->setFormValue($val);
            }
        }

        // Check field name 'MK_PELANGGAN' first before field var 'x_MK_PELANGGAN'
        $val = $CurrentForm->hasValue("MK_PELANGGAN") ? $CurrentForm->getValue("MK_PELANGGAN") : $CurrentForm->getValue("x_MK_PELANGGAN");
        if (!$this->MK_PELANGGAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_PELANGGAN->Visible = false; // Disable update for API request
            } else {
                $this->MK_PELANGGAN->setFormValue($val);
            }
        }

        // Check field name 'MK_PAMERANMANDIRI' first before field var 'x_MK_PAMERANMANDIRI'
        $val = $CurrentForm->hasValue("MK_PAMERANMANDIRI") ? $CurrentForm->getValue("MK_PAMERANMANDIRI") : $CurrentForm->getValue("x_MK_PAMERANMANDIRI");
        if (!$this->MK_PAMERANMANDIRI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->MK_PAMERANMANDIRI->Visible = false; // Disable update for API request
            } else {
                $this->MK_PAMERANMANDIRI->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->MK_KEUNGGULANPRODUK->CurrentValue = $this->MK_KEUNGGULANPRODUK->FormValue;
        $this->MK_TARGETPASAR->CurrentValue = $this->MK_TARGETPASAR->FormValue;
        $this->MK_KETERSEDIAAN->CurrentValue = $this->MK_KETERSEDIAAN->FormValue;
        $this->MK_LOGO->CurrentValue = $this->MK_LOGO->FormValue;
        $this->MK_HKI->CurrentValue = $this->MK_HKI->FormValue;
        $this->MK_BRANDING->CurrentValue = $this->MK_BRANDING->FormValue;
        $this->MK_COBRANDING->CurrentValue = $this->MK_COBRANDING->FormValue;
        $this->MK_MEDIAOFFLINE->CurrentValue = $this->MK_MEDIAOFFLINE->FormValue;
        $this->MK_RESELLER->CurrentValue = $this->MK_RESELLER->FormValue;
        $this->MK_PASAR->CurrentValue = $this->MK_PASAR->FormValue;
        $this->MK_PELANGGAN->CurrentValue = $this->MK_PELANGGAN->FormValue;
        $this->MK_PAMERANMANDIRI->CurrentValue = $this->MK_PAMERANMANDIRI->FormValue;
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
        $this->MK_KEUNGGULANPRODUK->setDbValue($row['MK_KEUNGGULANPRODUK']);
        $this->MK_TARGETPASAR->setDbValue($row['MK_TARGETPASAR']);
        $this->MK_KETERSEDIAAN->setDbValue($row['MK_KETERSEDIAAN']);
        $this->MK_LOGO->setDbValue($row['MK_LOGO']);
        $this->MK_HKI->setDbValue($row['MK_HKI']);
        $this->MK_BRANDING->setDbValue($row['MK_BRANDING']);
        $this->MK_COBRANDING->setDbValue($row['MK_COBRANDING']);
        $this->MK_MEDIAOFFLINE->setDbValue($row['MK_MEDIAOFFLINE']);
        $this->MK_RESELLER->setDbValue($row['MK_RESELLER']);
        $this->MK_PASAR->setDbValue($row['MK_PASAR']);
        $this->MK_PELANGGAN->setDbValue($row['MK_PELANGGAN']);
        $this->MK_PAMERANMANDIRI->setDbValue($row['MK_PAMERANMANDIRI']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['MK_KEUNGGULANPRODUK'] = $this->MK_KEUNGGULANPRODUK->CurrentValue;
        $row['MK_TARGETPASAR'] = $this->MK_TARGETPASAR->CurrentValue;
        $row['MK_KETERSEDIAAN'] = $this->MK_KETERSEDIAAN->CurrentValue;
        $row['MK_LOGO'] = $this->MK_LOGO->CurrentValue;
        $row['MK_HKI'] = $this->MK_HKI->CurrentValue;
        $row['MK_BRANDING'] = $this->MK_BRANDING->CurrentValue;
        $row['MK_COBRANDING'] = $this->MK_COBRANDING->CurrentValue;
        $row['MK_MEDIAOFFLINE'] = $this->MK_MEDIAOFFLINE->CurrentValue;
        $row['MK_RESELLER'] = $this->MK_RESELLER->CurrentValue;
        $row['MK_PASAR'] = $this->MK_PASAR->CurrentValue;
        $row['MK_PELANGGAN'] = $this->MK_PELANGGAN->CurrentValue;
        $row['MK_PAMERANMANDIRI'] = $this->MK_PAMERANMANDIRI->CurrentValue;
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

        // MK_KEUNGGULANPRODUK

        // MK_TARGETPASAR

        // MK_KETERSEDIAAN

        // MK_LOGO

        // MK_HKI

        // MK_BRANDING

        // MK_COBRANDING

        // MK_MEDIAOFFLINE

        // MK_RESELLER

        // MK_PASAR

        // MK_PELANGGAN

        // MK_PAMERANMANDIRI
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->CurrentValue;
            $this->MK_KEUNGGULANPRODUK->ViewCustomAttributes = "";

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->CurrentValue;
            $this->MK_TARGETPASAR->ViewCustomAttributes = "";

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->CurrentValue;
            $this->MK_KETERSEDIAAN->ViewCustomAttributes = "";

            // MK_LOGO
            $this->MK_LOGO->ViewValue = $this->MK_LOGO->CurrentValue;
            $this->MK_LOGO->ViewCustomAttributes = "";

            // MK_HKI
            $this->MK_HKI->ViewValue = $this->MK_HKI->CurrentValue;
            $this->MK_HKI->ViewCustomAttributes = "";

            // MK_BRANDING
            $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->CurrentValue;
            $this->MK_BRANDING->ViewCustomAttributes = "";

            // MK_COBRANDING
            $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->CurrentValue;
            $this->MK_COBRANDING->ViewCustomAttributes = "";

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->CurrentValue;
            $this->MK_MEDIAOFFLINE->ViewCustomAttributes = "";

            // MK_RESELLER
            $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->CurrentValue;
            $this->MK_RESELLER->ViewCustomAttributes = "";

            // MK_PASAR
            $this->MK_PASAR->ViewValue = $this->MK_PASAR->CurrentValue;
            $this->MK_PASAR->ViewCustomAttributes = "";

            // MK_PELANGGAN
            $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->CurrentValue;
            $this->MK_PELANGGAN->ViewCustomAttributes = "";

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->CurrentValue;
            $this->MK_PAMERANMANDIRI->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->LinkCustomAttributes = "";
            $this->MK_KEUNGGULANPRODUK->HrefValue = "";
            $this->MK_KEUNGGULANPRODUK->TooltipValue = "";

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->LinkCustomAttributes = "";
            $this->MK_TARGETPASAR->HrefValue = "";
            $this->MK_TARGETPASAR->TooltipValue = "";

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->LinkCustomAttributes = "";
            $this->MK_KETERSEDIAAN->HrefValue = "";
            $this->MK_KETERSEDIAAN->TooltipValue = "";

            // MK_LOGO
            $this->MK_LOGO->LinkCustomAttributes = "";
            $this->MK_LOGO->HrefValue = "";
            $this->MK_LOGO->TooltipValue = "";

            // MK_HKI
            $this->MK_HKI->LinkCustomAttributes = "";
            $this->MK_HKI->HrefValue = "";
            $this->MK_HKI->TooltipValue = "";

            // MK_BRANDING
            $this->MK_BRANDING->LinkCustomAttributes = "";
            $this->MK_BRANDING->HrefValue = "";
            $this->MK_BRANDING->TooltipValue = "";

            // MK_COBRANDING
            $this->MK_COBRANDING->LinkCustomAttributes = "";
            $this->MK_COBRANDING->HrefValue = "";
            $this->MK_COBRANDING->TooltipValue = "";

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->LinkCustomAttributes = "";
            $this->MK_MEDIAOFFLINE->HrefValue = "";
            $this->MK_MEDIAOFFLINE->TooltipValue = "";

            // MK_RESELLER
            $this->MK_RESELLER->LinkCustomAttributes = "";
            $this->MK_RESELLER->HrefValue = "";
            $this->MK_RESELLER->TooltipValue = "";

            // MK_PASAR
            $this->MK_PASAR->LinkCustomAttributes = "";
            $this->MK_PASAR->HrefValue = "";
            $this->MK_PASAR->TooltipValue = "";

            // MK_PELANGGAN
            $this->MK_PELANGGAN->LinkCustomAttributes = "";
            $this->MK_PELANGGAN->HrefValue = "";
            $this->MK_PELANGGAN->TooltipValue = "";

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->LinkCustomAttributes = "";
            $this->MK_PAMERANMANDIRI->HrefValue = "";
            $this->MK_PAMERANMANDIRI->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK
            $this->NIK->EditAttrs["class"] = "form-control";
            $this->NIK->EditCustomAttributes = "";
            if (!$this->NIK->Raw) {
                $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
            }
            $this->NIK->EditValue = HtmlEncode($this->NIK->CurrentValue);
            $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->EditAttrs["class"] = "form-control";
            $this->MK_KEUNGGULANPRODUK->EditCustomAttributes = "";
            if (!$this->MK_KEUNGGULANPRODUK->Raw) {
                $this->MK_KEUNGGULANPRODUK->CurrentValue = HtmlDecode($this->MK_KEUNGGULANPRODUK->CurrentValue);
            }
            $this->MK_KEUNGGULANPRODUK->EditValue = HtmlEncode($this->MK_KEUNGGULANPRODUK->CurrentValue);
            $this->MK_KEUNGGULANPRODUK->PlaceHolder = RemoveHtml($this->MK_KEUNGGULANPRODUK->caption());

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->EditAttrs["class"] = "form-control";
            $this->MK_TARGETPASAR->EditCustomAttributes = "";
            if (!$this->MK_TARGETPASAR->Raw) {
                $this->MK_TARGETPASAR->CurrentValue = HtmlDecode($this->MK_TARGETPASAR->CurrentValue);
            }
            $this->MK_TARGETPASAR->EditValue = HtmlEncode($this->MK_TARGETPASAR->CurrentValue);
            $this->MK_TARGETPASAR->PlaceHolder = RemoveHtml($this->MK_TARGETPASAR->caption());

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->EditAttrs["class"] = "form-control";
            $this->MK_KETERSEDIAAN->EditCustomAttributes = "";
            if (!$this->MK_KETERSEDIAAN->Raw) {
                $this->MK_KETERSEDIAAN->CurrentValue = HtmlDecode($this->MK_KETERSEDIAAN->CurrentValue);
            }
            $this->MK_KETERSEDIAAN->EditValue = HtmlEncode($this->MK_KETERSEDIAAN->CurrentValue);
            $this->MK_KETERSEDIAAN->PlaceHolder = RemoveHtml($this->MK_KETERSEDIAAN->caption());

            // MK_LOGO
            $this->MK_LOGO->EditAttrs["class"] = "form-control";
            $this->MK_LOGO->EditCustomAttributes = "";
            if (!$this->MK_LOGO->Raw) {
                $this->MK_LOGO->CurrentValue = HtmlDecode($this->MK_LOGO->CurrentValue);
            }
            $this->MK_LOGO->EditValue = HtmlEncode($this->MK_LOGO->CurrentValue);
            $this->MK_LOGO->PlaceHolder = RemoveHtml($this->MK_LOGO->caption());

            // MK_HKI
            $this->MK_HKI->EditAttrs["class"] = "form-control";
            $this->MK_HKI->EditCustomAttributes = "";
            if (!$this->MK_HKI->Raw) {
                $this->MK_HKI->CurrentValue = HtmlDecode($this->MK_HKI->CurrentValue);
            }
            $this->MK_HKI->EditValue = HtmlEncode($this->MK_HKI->CurrentValue);
            $this->MK_HKI->PlaceHolder = RemoveHtml($this->MK_HKI->caption());

            // MK_BRANDING
            $this->MK_BRANDING->EditAttrs["class"] = "form-control";
            $this->MK_BRANDING->EditCustomAttributes = "";
            if (!$this->MK_BRANDING->Raw) {
                $this->MK_BRANDING->CurrentValue = HtmlDecode($this->MK_BRANDING->CurrentValue);
            }
            $this->MK_BRANDING->EditValue = HtmlEncode($this->MK_BRANDING->CurrentValue);
            $this->MK_BRANDING->PlaceHolder = RemoveHtml($this->MK_BRANDING->caption());

            // MK_COBRANDING
            $this->MK_COBRANDING->EditAttrs["class"] = "form-control";
            $this->MK_COBRANDING->EditCustomAttributes = "";
            if (!$this->MK_COBRANDING->Raw) {
                $this->MK_COBRANDING->CurrentValue = HtmlDecode($this->MK_COBRANDING->CurrentValue);
            }
            $this->MK_COBRANDING->EditValue = HtmlEncode($this->MK_COBRANDING->CurrentValue);
            $this->MK_COBRANDING->PlaceHolder = RemoveHtml($this->MK_COBRANDING->caption());

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->EditAttrs["class"] = "form-control";
            $this->MK_MEDIAOFFLINE->EditCustomAttributes = "";
            if (!$this->MK_MEDIAOFFLINE->Raw) {
                $this->MK_MEDIAOFFLINE->CurrentValue = HtmlDecode($this->MK_MEDIAOFFLINE->CurrentValue);
            }
            $this->MK_MEDIAOFFLINE->EditValue = HtmlEncode($this->MK_MEDIAOFFLINE->CurrentValue);
            $this->MK_MEDIAOFFLINE->PlaceHolder = RemoveHtml($this->MK_MEDIAOFFLINE->caption());

            // MK_RESELLER
            $this->MK_RESELLER->EditAttrs["class"] = "form-control";
            $this->MK_RESELLER->EditCustomAttributes = "";
            if (!$this->MK_RESELLER->Raw) {
                $this->MK_RESELLER->CurrentValue = HtmlDecode($this->MK_RESELLER->CurrentValue);
            }
            $this->MK_RESELLER->EditValue = HtmlEncode($this->MK_RESELLER->CurrentValue);
            $this->MK_RESELLER->PlaceHolder = RemoveHtml($this->MK_RESELLER->caption());

            // MK_PASAR
            $this->MK_PASAR->EditAttrs["class"] = "form-control";
            $this->MK_PASAR->EditCustomAttributes = "";
            if (!$this->MK_PASAR->Raw) {
                $this->MK_PASAR->CurrentValue = HtmlDecode($this->MK_PASAR->CurrentValue);
            }
            $this->MK_PASAR->EditValue = HtmlEncode($this->MK_PASAR->CurrentValue);
            $this->MK_PASAR->PlaceHolder = RemoveHtml($this->MK_PASAR->caption());

            // MK_PELANGGAN
            $this->MK_PELANGGAN->EditAttrs["class"] = "form-control";
            $this->MK_PELANGGAN->EditCustomAttributes = "";
            if (!$this->MK_PELANGGAN->Raw) {
                $this->MK_PELANGGAN->CurrentValue = HtmlDecode($this->MK_PELANGGAN->CurrentValue);
            }
            $this->MK_PELANGGAN->EditValue = HtmlEncode($this->MK_PELANGGAN->CurrentValue);
            $this->MK_PELANGGAN->PlaceHolder = RemoveHtml($this->MK_PELANGGAN->caption());

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->EditAttrs["class"] = "form-control";
            $this->MK_PAMERANMANDIRI->EditCustomAttributes = "";
            if (!$this->MK_PAMERANMANDIRI->Raw) {
                $this->MK_PAMERANMANDIRI->CurrentValue = HtmlDecode($this->MK_PAMERANMANDIRI->CurrentValue);
            }
            $this->MK_PAMERANMANDIRI->EditValue = HtmlEncode($this->MK_PAMERANMANDIRI->CurrentValue);
            $this->MK_PAMERANMANDIRI->PlaceHolder = RemoveHtml($this->MK_PAMERANMANDIRI->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->LinkCustomAttributes = "";
            $this->MK_KEUNGGULANPRODUK->HrefValue = "";

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->LinkCustomAttributes = "";
            $this->MK_TARGETPASAR->HrefValue = "";

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->LinkCustomAttributes = "";
            $this->MK_KETERSEDIAAN->HrefValue = "";

            // MK_LOGO
            $this->MK_LOGO->LinkCustomAttributes = "";
            $this->MK_LOGO->HrefValue = "";

            // MK_HKI
            $this->MK_HKI->LinkCustomAttributes = "";
            $this->MK_HKI->HrefValue = "";

            // MK_BRANDING
            $this->MK_BRANDING->LinkCustomAttributes = "";
            $this->MK_BRANDING->HrefValue = "";

            // MK_COBRANDING
            $this->MK_COBRANDING->LinkCustomAttributes = "";
            $this->MK_COBRANDING->HrefValue = "";

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->LinkCustomAttributes = "";
            $this->MK_MEDIAOFFLINE->HrefValue = "";

            // MK_RESELLER
            $this->MK_RESELLER->LinkCustomAttributes = "";
            $this->MK_RESELLER->HrefValue = "";

            // MK_PASAR
            $this->MK_PASAR->LinkCustomAttributes = "";
            $this->MK_PASAR->HrefValue = "";

            // MK_PELANGGAN
            $this->MK_PELANGGAN->LinkCustomAttributes = "";
            $this->MK_PELANGGAN->HrefValue = "";

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->LinkCustomAttributes = "";
            $this->MK_PAMERANMANDIRI->HrefValue = "";
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
        if ($this->MK_KEUNGGULANPRODUK->Required) {
            if (!$this->MK_KEUNGGULANPRODUK->IsDetailKey && EmptyValue($this->MK_KEUNGGULANPRODUK->FormValue)) {
                $this->MK_KEUNGGULANPRODUK->addErrorMessage(str_replace("%s", $this->MK_KEUNGGULANPRODUK->caption(), $this->MK_KEUNGGULANPRODUK->RequiredErrorMessage));
            }
        }
        if ($this->MK_TARGETPASAR->Required) {
            if (!$this->MK_TARGETPASAR->IsDetailKey && EmptyValue($this->MK_TARGETPASAR->FormValue)) {
                $this->MK_TARGETPASAR->addErrorMessage(str_replace("%s", $this->MK_TARGETPASAR->caption(), $this->MK_TARGETPASAR->RequiredErrorMessage));
            }
        }
        if ($this->MK_KETERSEDIAAN->Required) {
            if (!$this->MK_KETERSEDIAAN->IsDetailKey && EmptyValue($this->MK_KETERSEDIAAN->FormValue)) {
                $this->MK_KETERSEDIAAN->addErrorMessage(str_replace("%s", $this->MK_KETERSEDIAAN->caption(), $this->MK_KETERSEDIAAN->RequiredErrorMessage));
            }
        }
        if ($this->MK_LOGO->Required) {
            if (!$this->MK_LOGO->IsDetailKey && EmptyValue($this->MK_LOGO->FormValue)) {
                $this->MK_LOGO->addErrorMessage(str_replace("%s", $this->MK_LOGO->caption(), $this->MK_LOGO->RequiredErrorMessage));
            }
        }
        if ($this->MK_HKI->Required) {
            if (!$this->MK_HKI->IsDetailKey && EmptyValue($this->MK_HKI->FormValue)) {
                $this->MK_HKI->addErrorMessage(str_replace("%s", $this->MK_HKI->caption(), $this->MK_HKI->RequiredErrorMessage));
            }
        }
        if ($this->MK_BRANDING->Required) {
            if (!$this->MK_BRANDING->IsDetailKey && EmptyValue($this->MK_BRANDING->FormValue)) {
                $this->MK_BRANDING->addErrorMessage(str_replace("%s", $this->MK_BRANDING->caption(), $this->MK_BRANDING->RequiredErrorMessage));
            }
        }
        if ($this->MK_COBRANDING->Required) {
            if (!$this->MK_COBRANDING->IsDetailKey && EmptyValue($this->MK_COBRANDING->FormValue)) {
                $this->MK_COBRANDING->addErrorMessage(str_replace("%s", $this->MK_COBRANDING->caption(), $this->MK_COBRANDING->RequiredErrorMessage));
            }
        }
        if ($this->MK_MEDIAOFFLINE->Required) {
            if (!$this->MK_MEDIAOFFLINE->IsDetailKey && EmptyValue($this->MK_MEDIAOFFLINE->FormValue)) {
                $this->MK_MEDIAOFFLINE->addErrorMessage(str_replace("%s", $this->MK_MEDIAOFFLINE->caption(), $this->MK_MEDIAOFFLINE->RequiredErrorMessage));
            }
        }
        if ($this->MK_RESELLER->Required) {
            if (!$this->MK_RESELLER->IsDetailKey && EmptyValue($this->MK_RESELLER->FormValue)) {
                $this->MK_RESELLER->addErrorMessage(str_replace("%s", $this->MK_RESELLER->caption(), $this->MK_RESELLER->RequiredErrorMessage));
            }
        }
        if ($this->MK_PASAR->Required) {
            if (!$this->MK_PASAR->IsDetailKey && EmptyValue($this->MK_PASAR->FormValue)) {
                $this->MK_PASAR->addErrorMessage(str_replace("%s", $this->MK_PASAR->caption(), $this->MK_PASAR->RequiredErrorMessage));
            }
        }
        if ($this->MK_PELANGGAN->Required) {
            if (!$this->MK_PELANGGAN->IsDetailKey && EmptyValue($this->MK_PELANGGAN->FormValue)) {
                $this->MK_PELANGGAN->addErrorMessage(str_replace("%s", $this->MK_PELANGGAN->caption(), $this->MK_PELANGGAN->RequiredErrorMessage));
            }
        }
        if ($this->MK_PAMERANMANDIRI->Required) {
            if (!$this->MK_PAMERANMANDIRI->IsDetailKey && EmptyValue($this->MK_PAMERANMANDIRI->FormValue)) {
                $this->MK_PAMERANMANDIRI->addErrorMessage(str_replace("%s", $this->MK_PAMERANMANDIRI->caption(), $this->MK_PAMERANMANDIRI->RequiredErrorMessage));
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

        // MK_KEUNGGULANPRODUK
        $this->MK_KEUNGGULANPRODUK->setDbValueDef($rsnew, $this->MK_KEUNGGULANPRODUK->CurrentValue, null, false);

        // MK_TARGETPASAR
        $this->MK_TARGETPASAR->setDbValueDef($rsnew, $this->MK_TARGETPASAR->CurrentValue, null, false);

        // MK_KETERSEDIAAN
        $this->MK_KETERSEDIAAN->setDbValueDef($rsnew, $this->MK_KETERSEDIAAN->CurrentValue, null, false);

        // MK_LOGO
        $this->MK_LOGO->setDbValueDef($rsnew, $this->MK_LOGO->CurrentValue, null, false);

        // MK_HKI
        $this->MK_HKI->setDbValueDef($rsnew, $this->MK_HKI->CurrentValue, null, false);

        // MK_BRANDING
        $this->MK_BRANDING->setDbValueDef($rsnew, $this->MK_BRANDING->CurrentValue, null, false);

        // MK_COBRANDING
        $this->MK_COBRANDING->setDbValueDef($rsnew, $this->MK_COBRANDING->CurrentValue, null, false);

        // MK_MEDIAOFFLINE
        $this->MK_MEDIAOFFLINE->setDbValueDef($rsnew, $this->MK_MEDIAOFFLINE->CurrentValue, null, false);

        // MK_RESELLER
        $this->MK_RESELLER->setDbValueDef($rsnew, $this->MK_RESELLER->CurrentValue, null, false);

        // MK_PASAR
        $this->MK_PASAR->setDbValueDef($rsnew, $this->MK_PASAR->CurrentValue, null, false);

        // MK_PELANGGAN
        $this->MK_PELANGGAN->setDbValueDef($rsnew, $this->MK_PELANGGAN->CurrentValue, null, false);

        // MK_PAMERANMANDIRI
        $this->MK_PAMERANMANDIRI->setDbValueDef($rsnew, $this->MK_PAMERANMANDIRI->CurrentValue, null, false);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekpemasaranlmlist"), "", $this->TableVar, true);
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
