<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class Register extends UmkmDatadiri
{
    use MessagesTrait;

    // Page ID
    public $PageID = "register";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Page object name
    public $PageObjName = "Register";

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

        // Table object (umkm_datadiri)
        if (!isset($GLOBALS["umkm_datadiri"]) || get_class($GLOBALS["umkm_datadiri"]) == PROJECT_NAMESPACE . "umkm_datadiri") {
            $GLOBALS["umkm_datadiri"] = &$this;
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
                $row = ["url" => $url];
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
    public $FormClassName = "ew-horizontal ew-form ew-register-form";
    public $IsModal = false;
    public $IsMobileOrModal = false;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm,
            $UserTable, $CurrentLanguage, $Breadcrumb, $SkipHeaderFooter;

        // Is modal
        $this->IsModal = Param("modal") == "1";

        // Create form object
        $CurrentForm = new HttpForm();
        $this->CurrentAction = Param("action"); // Set up current action

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Check modal
        if ($this->IsModal) {
            $SkipHeaderFooter = true;
        }
        $this->IsMobileOrModal = IsMobile() || $this->IsModal;
        $this->FormClassName = "ew-form ew-register-form ew-horizontal";

        // Set up Breadcrumb
        $Breadcrumb = new Breadcrumb("index");
        $Breadcrumb->add("register", "RegisterPage", CurrentUrl(), "", "", true);
        $this->Heading = $Language->phrase("RegisterPage");
        $userExists = false;
        $this->loadRowValues(); // Load default values

        // Get action
        $action = "";
        if (IsApi()) {
            $action = "insert";
        } elseif (Post("action") != "") {
            $action = Post("action");
        }

        // Check action
        if ($action != "") {
            // Get action
            $this->CurrentAction = $action;
            $this->loadFormValues(); // Get form values

            // Validate form
            if (!$this->validateForm()) {
                if (IsApi()) {
                    $this->terminate();
                    return;
                } else {
                    $this->CurrentAction = "show"; // Form error, reset action
                }
            }
        } else {
            $this->CurrentAction = "show"; // Display blank record
        }

        // Insert record
        if ($this->isInsert()) {
            // Check for duplicate User ID
            $filter = GetUserFilter(Config("LOGIN_USERNAME_FIELD_NAME"), $this->NIK->CurrentValue);
            // Set up filter (WHERE Clause)
            $this->CurrentFilter = $filter;
            $userSql = $this->getCurrentSql();
            $rs = Conn($UserTable->Dbid)->executeQuery($userSql);
            if ($rs->fetch()) {
                $userExists = true;
                $this->restoreFormValues(); // Restore form values
                $this->setFailureMessage($Language->phrase("UserExists")); // Set user exist message
            }
            if (!$userExists) {
                $this->SendEmail = true; // Send email on add success
                if ($this->addRow()) { // Add record
                    $email = $this->prepareRegisterEmail();
                    // Get new record
                    $this->CurrentFilter = $this->getRecordFilter();
                    $sql = $this->getCurrentSql();
                    $row = Conn($UserTable->Dbid)->fetchAssoc($sql);
                    $args = [];
                    $args["rs"] = $row;
                    $emailSent = false;
                    if ($this->emailSending($email, $args)) {
                        $emailSent = $email->send();
                    }

                    // Send email failed
                    if (!$emailSent) {
                        $this->setFailureMessage($email->SendErrDescription);
                    }
                    if ($this->getSuccessMessage() == "") {
                        $this->setSuccessMessage($Language->phrase("RegisterSuccess")); // Register success
                    }

                    // Auto login user
                    if ($Security->validateUser($this->NIK->CurrentValue, $this->_PASSWORD->FormValue, true)) {
                        // Nothing to do
                    } else {
                        $this->setFailureMessage($Language->phrase("AutoLoginFailed")); // Set auto login failed message
                    }
                    if (IsApi()) { // Return to caller
                        $this->terminate(true);
                        return;
                    } else {
                        $this->terminate("index"); // Return
                        return;
                    }
                } else {
                    $this->restoreFormValues(); // Restore form values
                }
            }
        }

        // API request, return
        if (IsApi()) {
            $this->terminate();
            return;
        }

        // Render row
        if ($this->isConfirm()) { // Confirm page
            $this->RowType = ROWTYPE_VIEW; // Render view
        } else {
            $this->RowType = ROWTYPE_ADD; // Render add
        }
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
        $this->NAMA_PEMILIK->CurrentValue = null;
        $this->NAMA_PEMILIK->OldValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->JENIS_KELAMIN->CurrentValue = null;
        $this->JENIS_KELAMIN->OldValue = $this->JENIS_KELAMIN->CurrentValue;
        $this->NO_HP->CurrentValue = null;
        $this->NO_HP->OldValue = $this->NO_HP->CurrentValue;
        $this->ALAMAT->CurrentValue = null;
        $this->ALAMAT->OldValue = $this->ALAMAT->CurrentValue;
        $this->KAPANEWON->CurrentValue = null;
        $this->KAPANEWON->OldValue = $this->KAPANEWON->CurrentValue;
        $this->KALURAHAN->CurrentValue = null;
        $this->KALURAHAN->OldValue = $this->KALURAHAN->CurrentValue;
        $this->DUSUN->CurrentValue = null;
        $this->DUSUN->OldValue = $this->DUSUN->CurrentValue;
        $this->_PASSWORD->CurrentValue = null;
        $this->_PASSWORD->OldValue = $this->_PASSWORD->CurrentValue;
        $this->_EMAIL->CurrentValue = null;
        $this->_EMAIL->OldValue = $this->_EMAIL->CurrentValue;
        $this->AKTIVASI->CurrentValue = null;
        $this->AKTIVASI->OldValue = $this->AKTIVASI->CurrentValue;
        $this->PROFIL->CurrentValue = null;
        $this->PROFIL->OldValue = $this->PROFIL->CurrentValue;
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

        // Check field name 'NAMA_PEMILIK' first before field var 'x_NAMA_PEMILIK'
        $val = $CurrentForm->hasValue("NAMA_PEMILIK") ? $CurrentForm->getValue("NAMA_PEMILIK") : $CurrentForm->getValue("x_NAMA_PEMILIK");
        if (!$this->NAMA_PEMILIK->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NAMA_PEMILIK->Visible = false; // Disable update for API request
            } else {
                $this->NAMA_PEMILIK->setFormValue($val);
            }
        }

        // Check field name 'JENIS_KELAMIN' first before field var 'x_JENIS_KELAMIN'
        $val = $CurrentForm->hasValue("JENIS_KELAMIN") ? $CurrentForm->getValue("JENIS_KELAMIN") : $CurrentForm->getValue("x_JENIS_KELAMIN");
        if (!$this->JENIS_KELAMIN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->JENIS_KELAMIN->Visible = false; // Disable update for API request
            } else {
                $this->JENIS_KELAMIN->setFormValue($val);
            }
        }

        // Check field name 'NO_HP' first before field var 'x_NO_HP'
        $val = $CurrentForm->hasValue("NO_HP") ? $CurrentForm->getValue("NO_HP") : $CurrentForm->getValue("x_NO_HP");
        if (!$this->NO_HP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->NO_HP->Visible = false; // Disable update for API request
            } else {
                $this->NO_HP->setFormValue($val);
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

        // Check field name 'PASSWORD' first before field var 'x__PASSWORD'
        $val = $CurrentForm->hasValue("PASSWORD") ? $CurrentForm->getValue("PASSWORD") : $CurrentForm->getValue("x__PASSWORD");
        if (!$this->_PASSWORD->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_PASSWORD->Visible = false; // Disable update for API request
            } else {
                $this->_PASSWORD->setFormValue($val);
            }
        }

        // Note: ConfirmValue will be compared with FormValue
        if (Config("ENCRYPTED_PASSWORD")) { // Encrypted password, use raw value
            $this->_PASSWORD->ConfirmValue = $CurrentForm->getValue("c__PASSWORD");
        } else {
            $this->_PASSWORD->ConfirmValue = RemoveXss($CurrentForm->getValue("c__PASSWORD"));
        }

        // Check field name 'EMAIL' first before field var 'x__EMAIL'
        $val = $CurrentForm->hasValue("EMAIL") ? $CurrentForm->getValue("EMAIL") : $CurrentForm->getValue("x__EMAIL");
        if (!$this->_EMAIL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->_EMAIL->Visible = false; // Disable update for API request
            } else {
                $this->_EMAIL->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->NAMA_PEMILIK->CurrentValue = $this->NAMA_PEMILIK->FormValue;
        $this->JENIS_KELAMIN->CurrentValue = $this->JENIS_KELAMIN->FormValue;
        $this->NO_HP->CurrentValue = $this->NO_HP->FormValue;
        $this->ALAMAT->CurrentValue = $this->ALAMAT->FormValue;
        $this->_PASSWORD->CurrentValue = $this->_PASSWORD->FormValue;
        $this->_EMAIL->CurrentValue = $this->_EMAIL->FormValue;
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
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->AKTIVASI->setDbValue($row['AKTIVASI']);
        $this->PROFIL->setDbValue($row['PROFIL']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['NAMA_PEMILIK'] = $this->NAMA_PEMILIK->CurrentValue;
        $row['JENIS_KELAMIN'] = $this->JENIS_KELAMIN->CurrentValue;
        $row['NO_HP'] = $this->NO_HP->CurrentValue;
        $row['ALAMAT'] = $this->ALAMAT->CurrentValue;
        $row['KAPANEWON'] = $this->KAPANEWON->CurrentValue;
        $row['KALURAHAN'] = $this->KALURAHAN->CurrentValue;
        $row['DUSUN'] = $this->DUSUN->CurrentValue;
        $row['PASSWORD'] = $this->_PASSWORD->CurrentValue;
        $row['EMAIL'] = $this->_EMAIL->CurrentValue;
        $row['AKTIVASI'] = $this->AKTIVASI->CurrentValue;
        $row['PROFIL'] = $this->PROFIL->CurrentValue;
        return $row;
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

        // NAMA_PEMILIK

        // JENIS_KELAMIN

        // NO_HP

        // ALAMAT

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // PASSWORD

        // EMAIL

        // AKTIVASI

        // PROFIL
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
            $this->NAMA_PEMILIK->ViewCustomAttributes = "";

            // JENIS_KELAMIN
            if (strval($this->JENIS_KELAMIN->CurrentValue) != "") {
                $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->optionCaption($this->JENIS_KELAMIN->CurrentValue);
            } else {
                $this->JENIS_KELAMIN->ViewValue = null;
            }
            $this->JENIS_KELAMIN->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

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

            // PASSWORD
            $this->_PASSWORD->ViewValue = $Language->phrase("PasswordMask");
            $this->_PASSWORD->ViewCustomAttributes = "";

            // EMAIL
            $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
            $this->_EMAIL->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->ExportHrefValue = Barcode()->getHrefValue('', 'QRCODE', 100);
            $this->NIK->TooltipValue = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";
            $this->NAMA_PEMILIK->TooltipValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";
            $this->JENIS_KELAMIN->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // PASSWORD
            $this->_PASSWORD->LinkCustomAttributes = "";
            $this->_PASSWORD->HrefValue = "";
            $this->_PASSWORD->TooltipValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
            $this->_EMAIL->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK
            $this->NIK->EditAttrs["class"] = "form-control";
            $this->NIK->EditCustomAttributes = "";
            if (!$this->NIK->Raw) {
                $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
            }
            $this->NIK->EditValue = HtmlEncode($this->NIK->CurrentValue);
            $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
            $this->NAMA_PEMILIK->EditCustomAttributes = "";
            if (!$this->NAMA_PEMILIK->Raw) {
                $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
            }
            $this->NAMA_PEMILIK->EditValue = HtmlEncode($this->NAMA_PEMILIK->CurrentValue);
            $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->EditCustomAttributes = "";
            $this->JENIS_KELAMIN->EditValue = $this->JENIS_KELAMIN->options(false);
            $this->JENIS_KELAMIN->PlaceHolder = RemoveHtml($this->JENIS_KELAMIN->caption());

            // NO_HP
            $this->NO_HP->EditAttrs["class"] = "form-control";
            $this->NO_HP->EditCustomAttributes = "";
            if (!$this->NO_HP->Raw) {
                $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
            }
            $this->NO_HP->EditValue = HtmlEncode($this->NO_HP->CurrentValue);
            $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

            // ALAMAT
            $this->ALAMAT->EditAttrs["class"] = "form-control";
            $this->ALAMAT->EditCustomAttributes = "";
            $this->ALAMAT->EditValue = HtmlEncode($this->ALAMAT->CurrentValue);
            $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

            // PASSWORD
            $this->_PASSWORD->EditAttrs["class"] = "form-control ew-password-strength";
            $this->_PASSWORD->EditCustomAttributes = "";
            $this->_PASSWORD->PlaceHolder = RemoveHtml($this->_PASSWORD->caption());

            // EMAIL
            $this->_EMAIL->EditAttrs["class"] = "form-control";
            $this->_EMAIL->EditCustomAttributes = "";
            if (!$this->_EMAIL->Raw) {
                $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
            }
            $this->_EMAIL->EditValue = HtmlEncode($this->_EMAIL->CurrentValue);
            $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->ExportHrefValue = Barcode()->getHrefValue('', 'QRCODE', 100);

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";

            // JENIS_KELAMIN
            $this->JENIS_KELAMIN->LinkCustomAttributes = "";
            $this->JENIS_KELAMIN->HrefValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";

            // PASSWORD
            $this->_PASSWORD->LinkCustomAttributes = "";
            $this->_PASSWORD->HrefValue = "";

            // EMAIL
            $this->_EMAIL->LinkCustomAttributes = "";
            $this->_EMAIL->HrefValue = "";
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
                $this->NIK->addErrorMessage($Language->phrase("EnterUserName"));
            }
        }
        if (!CheckInteger($this->NIK->FormValue)) {
            $this->NIK->addErrorMessage($this->NIK->getErrorMessage(false));
        }
        if (!$this->NIK->Raw && Config("REMOVE_XSS") && CheckUsername($this->NIK->FormValue)) {
            $this->NIK->addErrorMessage($Language->phrase("InvalidUsernameChars"));
        }
        if ($this->NAMA_PEMILIK->Required) {
            if (!$this->NAMA_PEMILIK->IsDetailKey && EmptyValue($this->NAMA_PEMILIK->FormValue)) {
                $this->NAMA_PEMILIK->addErrorMessage(str_replace("%s", $this->NAMA_PEMILIK->caption(), $this->NAMA_PEMILIK->RequiredErrorMessage));
            }
        }
        if ($this->JENIS_KELAMIN->Required) {
            if ($this->JENIS_KELAMIN->FormValue == "") {
                $this->JENIS_KELAMIN->addErrorMessage(str_replace("%s", $this->JENIS_KELAMIN->caption(), $this->JENIS_KELAMIN->RequiredErrorMessage));
            }
        }
        if ($this->NO_HP->Required) {
            if (!$this->NO_HP->IsDetailKey && EmptyValue($this->NO_HP->FormValue)) {
                $this->NO_HP->addErrorMessage(str_replace("%s", $this->NO_HP->caption(), $this->NO_HP->RequiredErrorMessage));
            }
        }
        if ($this->ALAMAT->Required) {
            if (!$this->ALAMAT->IsDetailKey && EmptyValue($this->ALAMAT->FormValue)) {
                $this->ALAMAT->addErrorMessage(str_replace("%s", $this->ALAMAT->caption(), $this->ALAMAT->RequiredErrorMessage));
            }
        }
        if ($this->_PASSWORD->Required) {
            if (!$this->_PASSWORD->IsDetailKey && EmptyValue($this->_PASSWORD->FormValue)) {
                $this->_PASSWORD->addErrorMessage($Language->phrase("EnterPassword"));
            }
        }
        if (!$this->_PASSWORD->Raw && Config("REMOVE_XSS") && CheckPassword($this->_PASSWORD->FormValue)) {
            $this->_PASSWORD->addErrorMessage($Language->phrase("InvalidPasswordChars"));
        }
        if ($this->_EMAIL->Required) {
            if (!$this->_EMAIL->IsDetailKey && EmptyValue($this->_EMAIL->FormValue)) {
                $this->_EMAIL->addErrorMessage(str_replace("%s", $this->_EMAIL->caption(), $this->_EMAIL->RequiredErrorMessage));
            }
        }
        if (!CheckEmail($this->_EMAIL->FormValue)) {
            $this->_EMAIL->addErrorMessage($this->_EMAIL->getErrorMessage(false));
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

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->setDbValueDef($rsnew, $this->NAMA_PEMILIK->CurrentValue, null, false);

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->setDbValueDef($rsnew, $this->JENIS_KELAMIN->CurrentValue, null, false);

        // NO_HP
        $this->NO_HP->setDbValueDef($rsnew, $this->NO_HP->CurrentValue, null, false);

        // ALAMAT
        $this->ALAMAT->setDbValueDef($rsnew, $this->ALAMAT->CurrentValue, null, strval($this->ALAMAT->CurrentValue) == "");

        // PASSWORD
        if (!IsMaskedPassword($this->_PASSWORD->CurrentValue)) {
            $this->_PASSWORD->setDbValueDef($rsnew, $this->_PASSWORD->CurrentValue, null, false);
        }

        // EMAIL
        $this->_EMAIL->setDbValueDef($rsnew, $this->_EMAIL->CurrentValue, null, false);

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

            // Call User Registered event
            $this->userRegistered($rsnew);
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
                case "x_JENIS_KELAMIN":
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
    // $type = ''|'success'|'failure'
    public function messageShowing(&$msg, $type)
    {
        // Example:
        //if ($type == 'success') $msg = "your success message";
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

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Form Custom Validate event
    public function formCustomValidate(&$customError)
    {
        // Return error message in CustomError
        return true;
    }

    // User Registered event
    public function userRegistered(&$rs)
    {
        //Log("User_Registered");
    }

    // User Activated event
    public function userActivated(&$rs)
    {
        //Log("User_Activated");
    }
}
