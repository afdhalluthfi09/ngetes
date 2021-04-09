<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekproduksiLmEdit extends UmkmAspekproduksiLm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "edit";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekproduksi_lm';

    // Page object name
    public $PageObjName = "UmkmAspekproduksiLmEdit";

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

        // Table object (umkm_aspekproduksi_lm)
        if (!isset($GLOBALS["umkm_aspekproduksi_lm"]) || get_class($GLOBALS["umkm_aspekproduksi_lm"]) == PROJECT_NAMESPACE . "umkm_aspekproduksi_lm") {
            $GLOBALS["umkm_aspekproduksi_lm"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekproduksi_lm');
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
                $doc = new $class(Container("umkm_aspekproduksi_lm"));
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
                    if ($pageName == "umkmaspekproduksilmview") {
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
        $this->NIK->setVisibility();
        $this->PROD_FREKUENSIPRODUKSI->setVisibility();
        $this->PROD_KAPASITAS->setVisibility();
        $this->PROD_KEAMANANPANGAN->setVisibility();
        $this->PROD_SNI->setVisibility();
        $this->PROD_KEMASAN->setVisibility();
        $this->PROD_KETERSEDIAANBAHANBAKU->setVisibility();
        $this->PROD_ALATPRODUKSI->setVisibility();
        $this->PROD_GUDANGPENYIMPAN->setVisibility();
        $this->PROD_LAYOUTPRODUKSI->setVisibility();
        $this->PROD_SOP->setVisibility();
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
            if (($keyValue = Get("NIK") ?? Key(0) ?? Route(2)) !== null) {
                $this->NIK->setQueryStringValue($keyValue);
                $this->NIK->setOldValue($this->NIK->QueryStringValue);
            } elseif (Post("NIK") !== null) {
                $this->NIK->setFormValue(Post("NIK"));
                $this->NIK->setOldValue($this->NIK->FormValue);
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
                if (($keyValue = Get("NIK") ?? Route("NIK")) !== null) {
                    $this->NIK->setQueryStringValue($keyValue);
                    $loadByQuery = true;
                } else {
                    $this->NIK->CurrentValue = null;
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
                    $this->terminate("umkmaspekproduksilmlist"); // No matching record, return to list
                    return;
                }
                break;
            case "update": // Update
                $returnUrl = $this->getReturnUrl();
                if (GetPageName($returnUrl) == "umkmaspekproduksilmlist") {
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

        // Check field name 'NIK' first before field var 'x_NIK'
        $val = $CurrentForm->hasValue("NIK") ? $CurrentForm->getValue("NIK") : $CurrentForm->getValue("x_NIK");
        if (!$this->NIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NIK->Visible = false; // Disable update for API request
            } else {
                $this->NIK->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_NIK")) {
            $this->NIK->setOldValue($CurrentForm->getValue("o_NIK"));
        }

        // Check field name 'PROD_FREKUENSIPRODUKSI' first before field var 'x_PROD_FREKUENSIPRODUKSI'
        $val = $CurrentForm->hasValue("PROD_FREKUENSIPRODUKSI") ? $CurrentForm->getValue("PROD_FREKUENSIPRODUKSI") : $CurrentForm->getValue("x_PROD_FREKUENSIPRODUKSI");
        if (!$this->PROD_FREKUENSIPRODUKSI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_FREKUENSIPRODUKSI->Visible = false; // Disable update for API request
            } else {
                $this->PROD_FREKUENSIPRODUKSI->setFormValue($val);
            }
        }

        // Check field name 'PROD_KAPASITAS' first before field var 'x_PROD_KAPASITAS'
        $val = $CurrentForm->hasValue("PROD_KAPASITAS") ? $CurrentForm->getValue("PROD_KAPASITAS") : $CurrentForm->getValue("x_PROD_KAPASITAS");
        if (!$this->PROD_KAPASITAS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_KAPASITAS->Visible = false; // Disable update for API request
            } else {
                $this->PROD_KAPASITAS->setFormValue($val);
            }
        }

        // Check field name 'PROD_KEAMANANPANGAN' first before field var 'x_PROD_KEAMANANPANGAN'
        $val = $CurrentForm->hasValue("PROD_KEAMANANPANGAN") ? $CurrentForm->getValue("PROD_KEAMANANPANGAN") : $CurrentForm->getValue("x_PROD_KEAMANANPANGAN");
        if (!$this->PROD_KEAMANANPANGAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_KEAMANANPANGAN->Visible = false; // Disable update for API request
            } else {
                $this->PROD_KEAMANANPANGAN->setFormValue($val);
            }
        }

        // Check field name 'PROD_SNI' first before field var 'x_PROD_SNI'
        $val = $CurrentForm->hasValue("PROD_SNI") ? $CurrentForm->getValue("PROD_SNI") : $CurrentForm->getValue("x_PROD_SNI");
        if (!$this->PROD_SNI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_SNI->Visible = false; // Disable update for API request
            } else {
                $this->PROD_SNI->setFormValue($val);
            }
        }

        // Check field name 'PROD_KEMASAN' first before field var 'x_PROD_KEMASAN'
        $val = $CurrentForm->hasValue("PROD_KEMASAN") ? $CurrentForm->getValue("PROD_KEMASAN") : $CurrentForm->getValue("x_PROD_KEMASAN");
        if (!$this->PROD_KEMASAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_KEMASAN->Visible = false; // Disable update for API request
            } else {
                $this->PROD_KEMASAN->setFormValue($val);
            }
        }

        // Check field name 'PROD_KETERSEDIAANBAHANBAKU' first before field var 'x_PROD_KETERSEDIAANBAHANBAKU'
        $val = $CurrentForm->hasValue("PROD_KETERSEDIAANBAHANBAKU") ? $CurrentForm->getValue("PROD_KETERSEDIAANBAHANBAKU") : $CurrentForm->getValue("x_PROD_KETERSEDIAANBAHANBAKU");
        if (!$this->PROD_KETERSEDIAANBAHANBAKU->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_KETERSEDIAANBAHANBAKU->Visible = false; // Disable update for API request
            } else {
                $this->PROD_KETERSEDIAANBAHANBAKU->setFormValue($val);
            }
        }

        // Check field name 'PROD_ALATPRODUKSI' first before field var 'x_PROD_ALATPRODUKSI'
        $val = $CurrentForm->hasValue("PROD_ALATPRODUKSI") ? $CurrentForm->getValue("PROD_ALATPRODUKSI") : $CurrentForm->getValue("x_PROD_ALATPRODUKSI");
        if (!$this->PROD_ALATPRODUKSI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_ALATPRODUKSI->Visible = false; // Disable update for API request
            } else {
                $this->PROD_ALATPRODUKSI->setFormValue($val);
            }
        }

        // Check field name 'PROD_GUDANGPENYIMPAN' first before field var 'x_PROD_GUDANGPENYIMPAN'
        $val = $CurrentForm->hasValue("PROD_GUDANGPENYIMPAN") ? $CurrentForm->getValue("PROD_GUDANGPENYIMPAN") : $CurrentForm->getValue("x_PROD_GUDANGPENYIMPAN");
        if (!$this->PROD_GUDANGPENYIMPAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_GUDANGPENYIMPAN->Visible = false; // Disable update for API request
            } else {
                $this->PROD_GUDANGPENYIMPAN->setFormValue($val);
            }
        }

        // Check field name 'PROD_LAYOUTPRODUKSI' first before field var 'x_PROD_LAYOUTPRODUKSI'
        $val = $CurrentForm->hasValue("PROD_LAYOUTPRODUKSI") ? $CurrentForm->getValue("PROD_LAYOUTPRODUKSI") : $CurrentForm->getValue("x_PROD_LAYOUTPRODUKSI");
        if (!$this->PROD_LAYOUTPRODUKSI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_LAYOUTPRODUKSI->Visible = false; // Disable update for API request
            } else {
                $this->PROD_LAYOUTPRODUKSI->setFormValue($val);
            }
        }

        // Check field name 'PROD_SOP' first before field var 'x_PROD_SOP'
        $val = $CurrentForm->hasValue("PROD_SOP") ? $CurrentForm->getValue("PROD_SOP") : $CurrentForm->getValue("x_PROD_SOP");
        if (!$this->PROD_SOP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->PROD_SOP->Visible = false; // Disable update for API request
            } else {
                $this->PROD_SOP->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->PROD_FREKUENSIPRODUKSI->CurrentValue = $this->PROD_FREKUENSIPRODUKSI->FormValue;
        $this->PROD_KAPASITAS->CurrentValue = $this->PROD_KAPASITAS->FormValue;
        $this->PROD_KEAMANANPANGAN->CurrentValue = $this->PROD_KEAMANANPANGAN->FormValue;
        $this->PROD_SNI->CurrentValue = $this->PROD_SNI->FormValue;
        $this->PROD_KEMASAN->CurrentValue = $this->PROD_KEMASAN->FormValue;
        $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue = $this->PROD_KETERSEDIAANBAHANBAKU->FormValue;
        $this->PROD_ALATPRODUKSI->CurrentValue = $this->PROD_ALATPRODUKSI->FormValue;
        $this->PROD_GUDANGPENYIMPAN->CurrentValue = $this->PROD_GUDANGPENYIMPAN->FormValue;
        $this->PROD_LAYOUTPRODUKSI->CurrentValue = $this->PROD_LAYOUTPRODUKSI->FormValue;
        $this->PROD_SOP->CurrentValue = $this->PROD_SOP->FormValue;
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
        $this->PROD_FREKUENSIPRODUKSI->setDbValue($row['PROD_FREKUENSIPRODUKSI']);
        $this->PROD_KAPASITAS->setDbValue($row['PROD_KAPASITAS']);
        $this->PROD_KEAMANANPANGAN->setDbValue($row['PROD_KEAMANANPANGAN']);
        $this->PROD_SNI->setDbValue($row['PROD_SNI']);
        $this->PROD_KEMASAN->setDbValue($row['PROD_KEMASAN']);
        $this->PROD_KETERSEDIAANBAHANBAKU->setDbValue($row['PROD_KETERSEDIAANBAHANBAKU']);
        $this->PROD_ALATPRODUKSI->setDbValue($row['PROD_ALATPRODUKSI']);
        $this->PROD_GUDANGPENYIMPAN->setDbValue($row['PROD_GUDANGPENYIMPAN']);
        $this->PROD_LAYOUTPRODUKSI->setDbValue($row['PROD_LAYOUTPRODUKSI']);
        $this->PROD_SOP->setDbValue($row['PROD_SOP']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['PROD_FREKUENSIPRODUKSI'] = null;
        $row['PROD_KAPASITAS'] = null;
        $row['PROD_KEAMANANPANGAN'] = null;
        $row['PROD_SNI'] = null;
        $row['PROD_KEMASAN'] = null;
        $row['PROD_KETERSEDIAANBAHANBAKU'] = null;
        $row['PROD_ALATPRODUKSI'] = null;
        $row['PROD_GUDANGPENYIMPAN'] = null;
        $row['PROD_LAYOUTPRODUKSI'] = null;
        $row['PROD_SOP'] = null;
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

        // PROD_FREKUENSIPRODUKSI

        // PROD_KAPASITAS

        // PROD_KEAMANANPANGAN

        // PROD_SNI

        // PROD_KEMASAN

        // PROD_KETERSEDIAANBAHANBAKU

        // PROD_ALATPRODUKSI

        // PROD_GUDANGPENYIMPAN

        // PROD_LAYOUTPRODUKSI

        // PROD_SOP
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->ViewValue = $this->PROD_FREKUENSIPRODUKSI->CurrentValue;
            $this->PROD_FREKUENSIPRODUKSI->ViewCustomAttributes = "";

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->ViewValue = $this->PROD_KAPASITAS->CurrentValue;
            $this->PROD_KAPASITAS->ViewCustomAttributes = "";

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->ViewValue = $this->PROD_KEAMANANPANGAN->CurrentValue;
            $this->PROD_KEAMANANPANGAN->ViewCustomAttributes = "";

            // PROD_SNI
            $this->PROD_SNI->ViewValue = $this->PROD_SNI->CurrentValue;
            $this->PROD_SNI->ViewCustomAttributes = "";

            // PROD_KEMASAN
            $this->PROD_KEMASAN->ViewValue = $this->PROD_KEMASAN->CurrentValue;
            $this->PROD_KEMASAN->ViewCustomAttributes = "";

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue;
            $this->PROD_KETERSEDIAANBAHANBAKU->ViewCustomAttributes = "";

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->ViewValue = $this->PROD_ALATPRODUKSI->CurrentValue;
            $this->PROD_ALATPRODUKSI->ViewCustomAttributes = "";

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->ViewValue = $this->PROD_GUDANGPENYIMPAN->CurrentValue;
            $this->PROD_GUDANGPENYIMPAN->ViewCustomAttributes = "";

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->ViewValue = $this->PROD_LAYOUTPRODUKSI->CurrentValue;
            $this->PROD_LAYOUTPRODUKSI->ViewCustomAttributes = "";

            // PROD_SOP
            $this->PROD_SOP->ViewValue = $this->PROD_SOP->CurrentValue;
            $this->PROD_SOP->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_FREKUENSIPRODUKSI->HrefValue = "";
            $this->PROD_FREKUENSIPRODUKSI->TooltipValue = "";

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->LinkCustomAttributes = "";
            $this->PROD_KAPASITAS->HrefValue = "";
            $this->PROD_KAPASITAS->TooltipValue = "";

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->LinkCustomAttributes = "";
            $this->PROD_KEAMANANPANGAN->HrefValue = "";
            $this->PROD_KEAMANANPANGAN->TooltipValue = "";

            // PROD_SNI
            $this->PROD_SNI->LinkCustomAttributes = "";
            $this->PROD_SNI->HrefValue = "";
            $this->PROD_SNI->TooltipValue = "";

            // PROD_KEMASAN
            $this->PROD_KEMASAN->LinkCustomAttributes = "";
            $this->PROD_KEMASAN->HrefValue = "";
            $this->PROD_KEMASAN->TooltipValue = "";

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->LinkCustomAttributes = "";
            $this->PROD_KETERSEDIAANBAHANBAKU->HrefValue = "";
            $this->PROD_KETERSEDIAANBAHANBAKU->TooltipValue = "";

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_ALATPRODUKSI->HrefValue = "";
            $this->PROD_ALATPRODUKSI->TooltipValue = "";

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->LinkCustomAttributes = "";
            $this->PROD_GUDANGPENYIMPAN->HrefValue = "";
            $this->PROD_GUDANGPENYIMPAN->TooltipValue = "";

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_LAYOUTPRODUKSI->HrefValue = "";
            $this->PROD_LAYOUTPRODUKSI->TooltipValue = "";

            // PROD_SOP
            $this->PROD_SOP->LinkCustomAttributes = "";
            $this->PROD_SOP->HrefValue = "";
            $this->PROD_SOP->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK
            $this->NIK->EditAttrs["class"] = "form-control";
            $this->NIK->EditCustomAttributes = "";
            if (!$this->NIK->Raw) {
                $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
            }
            $this->NIK->EditValue = HtmlEncode($this->NIK->CurrentValue);
            $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->EditAttrs["class"] = "form-control";
            $this->PROD_FREKUENSIPRODUKSI->EditCustomAttributes = "";
            if (!$this->PROD_FREKUENSIPRODUKSI->Raw) {
                $this->PROD_FREKUENSIPRODUKSI->CurrentValue = HtmlDecode($this->PROD_FREKUENSIPRODUKSI->CurrentValue);
            }
            $this->PROD_FREKUENSIPRODUKSI->EditValue = HtmlEncode($this->PROD_FREKUENSIPRODUKSI->CurrentValue);
            $this->PROD_FREKUENSIPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_FREKUENSIPRODUKSI->caption());

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->EditAttrs["class"] = "form-control";
            $this->PROD_KAPASITAS->EditCustomAttributes = "";
            if (!$this->PROD_KAPASITAS->Raw) {
                $this->PROD_KAPASITAS->CurrentValue = HtmlDecode($this->PROD_KAPASITAS->CurrentValue);
            }
            $this->PROD_KAPASITAS->EditValue = HtmlEncode($this->PROD_KAPASITAS->CurrentValue);
            $this->PROD_KAPASITAS->PlaceHolder = RemoveHtml($this->PROD_KAPASITAS->caption());

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->EditAttrs["class"] = "form-control";
            $this->PROD_KEAMANANPANGAN->EditCustomAttributes = "";
            if (!$this->PROD_KEAMANANPANGAN->Raw) {
                $this->PROD_KEAMANANPANGAN->CurrentValue = HtmlDecode($this->PROD_KEAMANANPANGAN->CurrentValue);
            }
            $this->PROD_KEAMANANPANGAN->EditValue = HtmlEncode($this->PROD_KEAMANANPANGAN->CurrentValue);
            $this->PROD_KEAMANANPANGAN->PlaceHolder = RemoveHtml($this->PROD_KEAMANANPANGAN->caption());

            // PROD_SNI
            $this->PROD_SNI->EditAttrs["class"] = "form-control";
            $this->PROD_SNI->EditCustomAttributes = "";
            if (!$this->PROD_SNI->Raw) {
                $this->PROD_SNI->CurrentValue = HtmlDecode($this->PROD_SNI->CurrentValue);
            }
            $this->PROD_SNI->EditValue = HtmlEncode($this->PROD_SNI->CurrentValue);
            $this->PROD_SNI->PlaceHolder = RemoveHtml($this->PROD_SNI->caption());

            // PROD_KEMASAN
            $this->PROD_KEMASAN->EditAttrs["class"] = "form-control";
            $this->PROD_KEMASAN->EditCustomAttributes = "";
            if (!$this->PROD_KEMASAN->Raw) {
                $this->PROD_KEMASAN->CurrentValue = HtmlDecode($this->PROD_KEMASAN->CurrentValue);
            }
            $this->PROD_KEMASAN->EditValue = HtmlEncode($this->PROD_KEMASAN->CurrentValue);
            $this->PROD_KEMASAN->PlaceHolder = RemoveHtml($this->PROD_KEMASAN->caption());

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->EditAttrs["class"] = "form-control";
            $this->PROD_KETERSEDIAANBAHANBAKU->EditCustomAttributes = "";
            if (!$this->PROD_KETERSEDIAANBAHANBAKU->Raw) {
                $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue = HtmlDecode($this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue);
            }
            $this->PROD_KETERSEDIAANBAHANBAKU->EditValue = HtmlEncode($this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue);
            $this->PROD_KETERSEDIAANBAHANBAKU->PlaceHolder = RemoveHtml($this->PROD_KETERSEDIAANBAHANBAKU->caption());

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->EditAttrs["class"] = "form-control";
            $this->PROD_ALATPRODUKSI->EditCustomAttributes = "";
            if (!$this->PROD_ALATPRODUKSI->Raw) {
                $this->PROD_ALATPRODUKSI->CurrentValue = HtmlDecode($this->PROD_ALATPRODUKSI->CurrentValue);
            }
            $this->PROD_ALATPRODUKSI->EditValue = HtmlEncode($this->PROD_ALATPRODUKSI->CurrentValue);
            $this->PROD_ALATPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_ALATPRODUKSI->caption());

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->EditAttrs["class"] = "form-control";
            $this->PROD_GUDANGPENYIMPAN->EditCustomAttributes = "";
            if (!$this->PROD_GUDANGPENYIMPAN->Raw) {
                $this->PROD_GUDANGPENYIMPAN->CurrentValue = HtmlDecode($this->PROD_GUDANGPENYIMPAN->CurrentValue);
            }
            $this->PROD_GUDANGPENYIMPAN->EditValue = HtmlEncode($this->PROD_GUDANGPENYIMPAN->CurrentValue);
            $this->PROD_GUDANGPENYIMPAN->PlaceHolder = RemoveHtml($this->PROD_GUDANGPENYIMPAN->caption());

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->EditAttrs["class"] = "form-control";
            $this->PROD_LAYOUTPRODUKSI->EditCustomAttributes = "";
            if (!$this->PROD_LAYOUTPRODUKSI->Raw) {
                $this->PROD_LAYOUTPRODUKSI->CurrentValue = HtmlDecode($this->PROD_LAYOUTPRODUKSI->CurrentValue);
            }
            $this->PROD_LAYOUTPRODUKSI->EditValue = HtmlEncode($this->PROD_LAYOUTPRODUKSI->CurrentValue);
            $this->PROD_LAYOUTPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_LAYOUTPRODUKSI->caption());

            // PROD_SOP
            $this->PROD_SOP->EditAttrs["class"] = "form-control";
            $this->PROD_SOP->EditCustomAttributes = "";
            if (!$this->PROD_SOP->Raw) {
                $this->PROD_SOP->CurrentValue = HtmlDecode($this->PROD_SOP->CurrentValue);
            }
            $this->PROD_SOP->EditValue = HtmlEncode($this->PROD_SOP->CurrentValue);
            $this->PROD_SOP->PlaceHolder = RemoveHtml($this->PROD_SOP->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_FREKUENSIPRODUKSI->HrefValue = "";

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->LinkCustomAttributes = "";
            $this->PROD_KAPASITAS->HrefValue = "";

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->LinkCustomAttributes = "";
            $this->PROD_KEAMANANPANGAN->HrefValue = "";

            // PROD_SNI
            $this->PROD_SNI->LinkCustomAttributes = "";
            $this->PROD_SNI->HrefValue = "";

            // PROD_KEMASAN
            $this->PROD_KEMASAN->LinkCustomAttributes = "";
            $this->PROD_KEMASAN->HrefValue = "";

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->LinkCustomAttributes = "";
            $this->PROD_KETERSEDIAANBAHANBAKU->HrefValue = "";

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_ALATPRODUKSI->HrefValue = "";

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->LinkCustomAttributes = "";
            $this->PROD_GUDANGPENYIMPAN->HrefValue = "";

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_LAYOUTPRODUKSI->HrefValue = "";

            // PROD_SOP
            $this->PROD_SOP->LinkCustomAttributes = "";
            $this->PROD_SOP->HrefValue = "";
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
        if ($this->PROD_FREKUENSIPRODUKSI->Required) {
            if (!$this->PROD_FREKUENSIPRODUKSI->IsDetailKey && EmptyValue($this->PROD_FREKUENSIPRODUKSI->FormValue)) {
                $this->PROD_FREKUENSIPRODUKSI->addErrorMessage(str_replace("%s", $this->PROD_FREKUENSIPRODUKSI->caption(), $this->PROD_FREKUENSIPRODUKSI->RequiredErrorMessage));
            }
        }
        if ($this->PROD_KAPASITAS->Required) {
            if (!$this->PROD_KAPASITAS->IsDetailKey && EmptyValue($this->PROD_KAPASITAS->FormValue)) {
                $this->PROD_KAPASITAS->addErrorMessage(str_replace("%s", $this->PROD_KAPASITAS->caption(), $this->PROD_KAPASITAS->RequiredErrorMessage));
            }
        }
        if ($this->PROD_KEAMANANPANGAN->Required) {
            if (!$this->PROD_KEAMANANPANGAN->IsDetailKey && EmptyValue($this->PROD_KEAMANANPANGAN->FormValue)) {
                $this->PROD_KEAMANANPANGAN->addErrorMessage(str_replace("%s", $this->PROD_KEAMANANPANGAN->caption(), $this->PROD_KEAMANANPANGAN->RequiredErrorMessage));
            }
        }
        if ($this->PROD_SNI->Required) {
            if (!$this->PROD_SNI->IsDetailKey && EmptyValue($this->PROD_SNI->FormValue)) {
                $this->PROD_SNI->addErrorMessage(str_replace("%s", $this->PROD_SNI->caption(), $this->PROD_SNI->RequiredErrorMessage));
            }
        }
        if ($this->PROD_KEMASAN->Required) {
            if (!$this->PROD_KEMASAN->IsDetailKey && EmptyValue($this->PROD_KEMASAN->FormValue)) {
                $this->PROD_KEMASAN->addErrorMessage(str_replace("%s", $this->PROD_KEMASAN->caption(), $this->PROD_KEMASAN->RequiredErrorMessage));
            }
        }
        if ($this->PROD_KETERSEDIAANBAHANBAKU->Required) {
            if (!$this->PROD_KETERSEDIAANBAHANBAKU->IsDetailKey && EmptyValue($this->PROD_KETERSEDIAANBAHANBAKU->FormValue)) {
                $this->PROD_KETERSEDIAANBAHANBAKU->addErrorMessage(str_replace("%s", $this->PROD_KETERSEDIAANBAHANBAKU->caption(), $this->PROD_KETERSEDIAANBAHANBAKU->RequiredErrorMessage));
            }
        }
        if ($this->PROD_ALATPRODUKSI->Required) {
            if (!$this->PROD_ALATPRODUKSI->IsDetailKey && EmptyValue($this->PROD_ALATPRODUKSI->FormValue)) {
                $this->PROD_ALATPRODUKSI->addErrorMessage(str_replace("%s", $this->PROD_ALATPRODUKSI->caption(), $this->PROD_ALATPRODUKSI->RequiredErrorMessage));
            }
        }
        if ($this->PROD_GUDANGPENYIMPAN->Required) {
            if (!$this->PROD_GUDANGPENYIMPAN->IsDetailKey && EmptyValue($this->PROD_GUDANGPENYIMPAN->FormValue)) {
                $this->PROD_GUDANGPENYIMPAN->addErrorMessage(str_replace("%s", $this->PROD_GUDANGPENYIMPAN->caption(), $this->PROD_GUDANGPENYIMPAN->RequiredErrorMessage));
            }
        }
        if ($this->PROD_LAYOUTPRODUKSI->Required) {
            if (!$this->PROD_LAYOUTPRODUKSI->IsDetailKey && EmptyValue($this->PROD_LAYOUTPRODUKSI->FormValue)) {
                $this->PROD_LAYOUTPRODUKSI->addErrorMessage(str_replace("%s", $this->PROD_LAYOUTPRODUKSI->caption(), $this->PROD_LAYOUTPRODUKSI->RequiredErrorMessage));
            }
        }
        if ($this->PROD_SOP->Required) {
            if (!$this->PROD_SOP->IsDetailKey && EmptyValue($this->PROD_SOP->FormValue)) {
                $this->PROD_SOP->addErrorMessage(str_replace("%s", $this->PROD_SOP->caption(), $this->PROD_SOP->RequiredErrorMessage));
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

            // NIK
            $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "", $this->NIK->ReadOnly);

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->setDbValueDef($rsnew, $this->PROD_FREKUENSIPRODUKSI->CurrentValue, null, $this->PROD_FREKUENSIPRODUKSI->ReadOnly);

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->setDbValueDef($rsnew, $this->PROD_KAPASITAS->CurrentValue, null, $this->PROD_KAPASITAS->ReadOnly);

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->setDbValueDef($rsnew, $this->PROD_KEAMANANPANGAN->CurrentValue, null, $this->PROD_KEAMANANPANGAN->ReadOnly);

            // PROD_SNI
            $this->PROD_SNI->setDbValueDef($rsnew, $this->PROD_SNI->CurrentValue, null, $this->PROD_SNI->ReadOnly);

            // PROD_KEMASAN
            $this->PROD_KEMASAN->setDbValueDef($rsnew, $this->PROD_KEMASAN->CurrentValue, null, $this->PROD_KEMASAN->ReadOnly);

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->setDbValueDef($rsnew, $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue, null, $this->PROD_KETERSEDIAANBAHANBAKU->ReadOnly);

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->setDbValueDef($rsnew, $this->PROD_ALATPRODUKSI->CurrentValue, null, $this->PROD_ALATPRODUKSI->ReadOnly);

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->setDbValueDef($rsnew, $this->PROD_GUDANGPENYIMPAN->CurrentValue, null, $this->PROD_GUDANGPENYIMPAN->ReadOnly);

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->setDbValueDef($rsnew, $this->PROD_LAYOUTPRODUKSI->CurrentValue, null, $this->PROD_LAYOUTPRODUKSI->ReadOnly);

            // PROD_SOP
            $this->PROD_SOP->setDbValueDef($rsnew, $this->PROD_SOP->CurrentValue, null, $this->PROD_SOP->ReadOnly);

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekproduksilmlist"), "", $this->TableVar, true);
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
