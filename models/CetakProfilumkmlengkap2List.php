<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class CetakProfilumkmlengkap2List extends CetakProfilumkmlengkap2
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = '_cetak_profilumkmlengkap';

    // Page object name
    public $PageObjName = "CetakProfilumkmlengkap2List";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "f_cetak_profilumkmlengkap2list";
    public $FormActionName = "k_action";
    public $FormBlankRowName = "k_blankrow";
    public $FormKeyCountName = "key_count";

    // Page URLs
    public $AddUrl;
    public $EditUrl;
    public $CopyUrl;
    public $DeleteUrl;
    public $ViewUrl;
    public $ListUrl;

    // Export URLs
    public $ExportPrintUrl;
    public $ExportHtmlUrl;
    public $ExportExcelUrl;
    public $ExportWordUrl;
    public $ExportXmlUrl;
    public $ExportCsvUrl;
    public $ExportPdfUrl;

    // Custom export
    public $ExportExcelCustom = false;
    public $ExportWordCustom = false;
    public $ExportPdfCustom = false;
    public $ExportEmailCustom = false;

    // Update URLs
    public $InlineAddUrl;
    public $InlineCopyUrl;
    public $InlineEditUrl;
    public $GridAddUrl;
    public $GridEditUrl;
    public $MultiDeleteUrl;
    public $MultiUpdateUrl;

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

        // Table object (_cetak_profilumkmlengkap2)
        if (!isset($GLOBALS["_cetak_profilumkmlengkap2"]) || get_class($GLOBALS["_cetak_profilumkmlengkap2"]) == PROJECT_NAMESPACE . "_cetak_profilumkmlengkap2") {
            $GLOBALS["_cetak_profilumkmlengkap2"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Initialize URLs
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->AddUrl = "cetakprofilumkmlengkap2add";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "cetakprofilumkmlengkap2delete";
        $this->MultiUpdateUrl = "cetakprofilumkmlengkap2update";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", '_cetak_profilumkmlengkap');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // List options
        $this->ListOptions = new ListOptions();
        $this->ListOptions->TableVar = $this->TableVar;

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Import options
        $this->ImportOptions = new ListOptions("div");
        $this->ImportOptions->TagClassName = "ew-import-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";

        // Filter options
        $this->FilterOptions = new ListOptions("div");
        $this->FilterOptions->TagClassName = "ew-filter-option f_cetak_profilumkmlengkap2listsrch";

        // List actions
        $this->ListActions = new ListActions();
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
                $doc = new $class(Container("_cetak_profilumkmlengkap2"));
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
            SaveDebugMessage();
            Redirect(GetUrl($url));
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
                        if ($fld->DataType == DATATYPE_MEMO && $fld->MemoMaxLength > 0) {
                            $val = TruncateMemo($val, $fld->MemoMaxLength, $fld->TruncateMemoRemoveHtml);
                        }
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

    // Class variables
    public $ListOptions; // List options
    public $ExportOptions; // Export options
    public $SearchOptions; // Search options
    public $OtherOptions; // Other options
    public $FilterOptions; // Filter options
    public $ImportOptions; // Import options
    public $ListActions; // List actions
    public $SelectedCount = 0;
    public $SelectedIndex = 0;
    public $DisplayRecords = 20;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $PageSizes = "10,20,50,-1"; // Page sizes (comma separated)
    public $DefaultSearchWhere = ""; // Default search WHERE clause
    public $SearchWhere = ""; // Search WHERE clause
    public $SearchPanelClass = "ew-search-panel collapse show"; // Search Panel class
    public $SearchRowCount = 0; // For extended search
    public $SearchColumnCount = 0; // For extended search
    public $SearchFieldsPerRow = 1; // For extended search
    public $RecordCount = 0; // Record count
    public $EditRowCount;
    public $StartRowCount = 1;
    public $RowCount = 0;
    public $Attrs = []; // Row attributes and cell attributes
    public $RowIndex = 0; // Row index
    public $KeyCount = 0; // Key count
    public $RowAction = ""; // Row action
    public $MultiColumnClass = "col-sm";
    public $MultiColumnEditClass = "w-100";
    public $DbMasterFilter = ""; // Master filter
    public $DbDetailFilter = ""; // Detail filter
    public $MasterRecordExists;
    public $MultiSelectKey;
    public $Command;
    public $RestoreSearch = false;
    public $HashValue; // Hash value
    public $DetailPages;
    public $OldRecordset;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;

        // Get export parameters
        $custom = "";
        if (Param("export") !== null) {
            $this->Export = Param("export");
            $custom = Param("custom", "");
        } elseif (IsPost()) {
            if (Post("exporttype") !== null) {
                $this->Export = Post("exporttype");
            }
            $custom = Post("custom", "");
        } elseif (Get("cmd") == "json") {
            $this->Export = Get("cmd");
        } else {
            $this->setExportReturnUrl(CurrentUrl());
        }
        $ExportFileName = $this->TableVar; // Get export file, used in header

        // Get custom export parameters
        if ($this->isExport() && $custom != "") {
            $this->CustomExport = $this->Export;
            $this->Export = "print";
        }
        $CustomExportType = $this->CustomExport;
        $ExportType = $this->Export; // Get export parameter, used in header

        // Update Export URLs
        if (Config("USE_PHPEXCEL")) {
            $this->ExportExcelCustom = false;
        }
        if (Config("USE_PHPWORD")) {
            $this->ExportWordCustom = false;
        }
        if ($this->ExportExcelCustom) {
            $this->ExportExcelUrl .= "&amp;custom=1";
        }
        if ($this->ExportWordCustom) {
            $this->ExportWordUrl .= "&amp;custom=1";
        }
        if ($this->ExportPdfCustom) {
            $this->ExportPdfUrl .= "&amp;custom=1";
        }
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();

        // Setup export options
        $this->setupExportOptions();
        $this->nik->setVisibility();
        $this->nama_usaha->Visible = false;
        $this->prf_addbis->Visible = false;
        $this->prf_addbi1->Visible = false;
        $this->kabupaten->Visible = false;
        $this->klasifikas->setVisibility();
        $this->sektor_per->Visible = false;
        $this->sektor_kbl->Visible = false;
        $this->sektor_ekr->Visible = false;
        $this->nama_lengk->Visible = false;
        $this->jenis_kela->setVisibility();
        $this->no_hp->setVisibility();
        $this->pendidikan->setVisibility();
        $this->disabilita->setVisibility();
        $this->tglmulai->setVisibility();
        $this->umurusaha->Visible = false;
        $this->addbisnis->Visible = false;
        $this->nilai_aset->setVisibility();
        $this->omsetbulan->setVisibility();
        $this->kegiatan_u->Visible = false;
        $this->uraian_keg->Visible = false;
        $this->emailusaha->setVisibility();
        $this->akun_ig->setVisibility();
        $this->akun_faceb->setVisibility();
        $this->akun_gmb->setVisibility();
        $this->url_websit->setVisibility();
        $this->url_market->Visible = false;
        $this->kelas->setVisibility();
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Setup other options
        $this->setupOtherOptions();

        // Set up custom action (compatible with old version)
        foreach ($this->CustomActions as $name => $action) {
            $this->ListActions->add($name, $action);
        }

        // Show checkbox column if multiple action
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE && $listaction->Allow) {
                $this->ListOptions["checkbox"]->Visible = true;
                break;
            }
        }

        // Set up lookup cache

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Process list action first
            if ($this->processListAction()) { // Ajax request
                $this->terminate();
                return;
            }

            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

            // Set up Breadcrumb
            if (!$this->isExport()) {
                $this->setupBreadcrumb();
            }

            // Hide list options
            if ($this->isExport()) {
                $this->ListOptions->hideAllOptions(["sequence"]);
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            } elseif ($this->isGridAdd() || $this->isGridEdit()) {
                $this->ListOptions->hideAllOptions();
                $this->ListOptions->UseDropDownButton = false; // Disable drop down button
                $this->ListOptions->UseButtonGroup = false; // Disable button group
            }

            // Hide options
            if ($this->isExport() || $this->CurrentAction) {
                $this->ExportOptions->hideAllOptions();
                $this->FilterOptions->hideAllOptions();
                $this->ImportOptions->hideAllOptions();
            }

            // Hide other options
            if ($this->isExport()) {
                $this->OtherOptions->hideAllOptions();
            }

            // Get default search criteria
            AddFilter($this->DefaultSearchWhere, $this->basicSearchWhere(true));

            // Get basic search values
            $this->loadBasicSearchValues();

            // Process filter list
            if ($this->processFilterList()) {
                $this->terminate();
                return;
            }

            // Restore search parms from Session if not searching / reset / export
            if (($this->isExport() || $this->Command != "search" && $this->Command != "reset" && $this->Command != "resetall") && $this->Command != "json" && $this->checkSearchParms()) {
                $this->restoreSearchParms();
            }

            // Call Recordset SearchValidated event
            $this->recordsetSearchValidated();

            // Set up sorting order
            $this->setupSortOrder();

            // Get basic search criteria
            if (!$this->hasInvalidFields()) {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Restore display records
        if ($this->Command != "json" && $this->getRecordsPerPage() != "") {
            $this->DisplayRecords = $this->getRecordsPerPage(); // Restore from Session
        } else {
            $this->DisplayRecords = 20; // Load default
            $this->setRecordsPerPage($this->DisplayRecords); // Save default to Session
        }

        // Load Sorting Order
        if ($this->Command != "json") {
            $this->loadSortOrder();
        }

        // Load search default if no existing search criteria
        if (!$this->checkSearchParms()) {
            // Load basic search from default
            $this->BasicSearch->loadDefault();
            if ($this->BasicSearch->Keyword != "") {
                $srchBasic = $this->basicSearchWhere();
            }
        }

        // Build search criteria
        AddFilter($this->SearchWhere, $srchAdvanced);
        AddFilter($this->SearchWhere, $srchBasic);

        // Call Recordset_Searching event
        $this->recordsetSearching($this->SearchWhere);

        // Save search criteria
        if ($this->Command == "search" && !$this->RestoreSearch) {
            $this->setSearchWhere($this->SearchWhere); // Save to Session
            $this->StartRecord = 1; // Reset start record counter
            $this->setStartRecordNumber($this->StartRecord);
        } elseif ($this->Command != "json") {
            $this->SearchWhere = $this->getSearchWhere();
        }

        // Build filter
        $filter = "";
        if (!$Security->canList()) {
            $filter = "(0=1)"; // Filter all records
        }
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }

        // Export data only
        if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
            $this->exportData();
            $this->terminate();
            return;
        }
        if ($this->isGridAdd()) {
            $this->CurrentFilter = "0=1";
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->GridAddRowCount;
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            if ($this->DisplayRecords <= 0 || ($this->isExport() && $this->ExportAll)) { // Display all records
                $this->DisplayRecords = $this->TotalRecords;
            }
            if (!($this->isExport() && $this->ExportAll)) { // Set up start record position
                $this->setupStartRecord();
            }
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);

            // Set no record found message
            if (!$this->CurrentAction && $this->TotalRecords == 0) {
                if (!$Security->canList()) {
                    $this->setWarningMessage(DeniedMessage());
                }
                if ($this->SearchWhere == "0=101") {
                    $this->setWarningMessage($Language->phrase("EnterSearchCriteria"));
                } else {
                    $this->setWarningMessage($Language->phrase("NoRecord"));
                }
            }
        }

        // Search/sort options
        $this->setupSearchSortOptions();

        // Set up search panel class
        if ($this->SearchWhere != "") {
            AppendClass($this->SearchPanelClass, "show");
        }

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset);
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows, "totalRecordCount" => $this->TotalRecords]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->getRecordsPerPage(), $this->TotalRecords, $this->PageSizes, $this->RecordRange, $this->AutoHidePager, $this->AutoHidePageSizeSelector);

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

    // Set up number of records displayed per page
    protected function setupDisplayRecords()
    {
        $wrk = Get(Config("TABLE_REC_PER_PAGE"), "");
        if ($wrk != "") {
            if (is_numeric($wrk)) {
                $this->DisplayRecords = (int)$wrk;
            } else {
                if (SameText($wrk, "all")) { // Display all records
                    $this->DisplayRecords = -1;
                } else {
                    $this->DisplayRecords = 20; // Non-numeric, load default
                }
            }
            $this->setRecordsPerPage($this->DisplayRecords); // Save to Session
            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Build filter for all keys
    protected function buildKeyFilter()
    {
        global $CurrentForm;
        $wrkFilter = "";

        // Update row index and get row key
        $rowindex = 1;
        $CurrentForm->Index = $rowindex;
        $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        while ($thisKey != "") {
            $this->setKey($thisKey);
            if ($this->OldKey != "") {
                $filter = $this->getRecordFilter();
                if ($wrkFilter != "") {
                    $wrkFilter .= " OR ";
                }
                $wrkFilter .= $filter;
            } else {
                $wrkFilter = "0=1";
                break;
            }

            // Update row index and get row key
            $rowindex++; // Next row
            $CurrentForm->Index = $rowindex;
            $thisKey = strval($CurrentForm->getValue($this->OldKeyName));
        }
        return $wrkFilter;
    }

    // Get list of filters
    public function getFilterList()
    {
        global $UserProfile;

        // Initialize
        $filterList = "";
        $savedFilterList = "";

        // Load server side filters
        if (Config("SEARCH_FILTER_OPTION") == "Server" && isset($UserProfile)) {
            $savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "f_cetak_profilumkmlengkap2listsrch");
        }
        $filterList = Concat($filterList, $this->nik->AdvancedSearch->toJson(), ","); // Field nik
        $filterList = Concat($filterList, $this->nama_usaha->AdvancedSearch->toJson(), ","); // Field nama_usaha
        $filterList = Concat($filterList, $this->prf_addbis->AdvancedSearch->toJson(), ","); // Field prf_addbis
        $filterList = Concat($filterList, $this->prf_addbi1->AdvancedSearch->toJson(), ","); // Field prf_addbi1
        $filterList = Concat($filterList, $this->kabupaten->AdvancedSearch->toJson(), ","); // Field kabupaten
        $filterList = Concat($filterList, $this->klasifikas->AdvancedSearch->toJson(), ","); // Field klasifikas
        $filterList = Concat($filterList, $this->sektor_per->AdvancedSearch->toJson(), ","); // Field sektor_per
        $filterList = Concat($filterList, $this->sektor_kbl->AdvancedSearch->toJson(), ","); // Field sektor_kbl
        $filterList = Concat($filterList, $this->sektor_ekr->AdvancedSearch->toJson(), ","); // Field sektor_ekr
        $filterList = Concat($filterList, $this->nama_lengk->AdvancedSearch->toJson(), ","); // Field nama_lengk
        $filterList = Concat($filterList, $this->jenis_kela->AdvancedSearch->toJson(), ","); // Field jenis_kela
        $filterList = Concat($filterList, $this->no_hp->AdvancedSearch->toJson(), ","); // Field no_hp
        $filterList = Concat($filterList, $this->pendidikan->AdvancedSearch->toJson(), ","); // Field pendidikan
        $filterList = Concat($filterList, $this->disabilita->AdvancedSearch->toJson(), ","); // Field disabilita
        $filterList = Concat($filterList, $this->tglmulai->AdvancedSearch->toJson(), ","); // Field tglmulai
        $filterList = Concat($filterList, $this->umurusaha->AdvancedSearch->toJson(), ","); // Field umurusaha
        $filterList = Concat($filterList, $this->addbisnis->AdvancedSearch->toJson(), ","); // Field addbisnis
        $filterList = Concat($filterList, $this->nilai_aset->AdvancedSearch->toJson(), ","); // Field nilai_aset
        $filterList = Concat($filterList, $this->omsetbulan->AdvancedSearch->toJson(), ","); // Field omsetbulan
        $filterList = Concat($filterList, $this->kegiatan_u->AdvancedSearch->toJson(), ","); // Field kegiatan_u
        $filterList = Concat($filterList, $this->uraian_keg->AdvancedSearch->toJson(), ","); // Field uraian_keg
        $filterList = Concat($filterList, $this->emailusaha->AdvancedSearch->toJson(), ","); // Field emailusaha
        $filterList = Concat($filterList, $this->akun_ig->AdvancedSearch->toJson(), ","); // Field akun_ig
        $filterList = Concat($filterList, $this->akun_faceb->AdvancedSearch->toJson(), ","); // Field akun_faceb
        $filterList = Concat($filterList, $this->akun_gmb->AdvancedSearch->toJson(), ","); // Field akun_gmb
        $filterList = Concat($filterList, $this->url_websit->AdvancedSearch->toJson(), ","); // Field url_websit
        $filterList = Concat($filterList, $this->url_market->AdvancedSearch->toJson(), ","); // Field url_market
        $filterList = Concat($filterList, $this->kelas->AdvancedSearch->toJson(), ","); // Field kelas
        if ($this->BasicSearch->Keyword != "") {
            $wrk = "\"" . Config("TABLE_BASIC_SEARCH") . "\":\"" . JsEncode($this->BasicSearch->Keyword) . "\",\"" . Config("TABLE_BASIC_SEARCH_TYPE") . "\":\"" . JsEncode($this->BasicSearch->Type) . "\"";
            $filterList = Concat($filterList, $wrk, ",");
        }

        // Return filter list in JSON
        if ($filterList != "") {
            $filterList = "\"data\":{" . $filterList . "}";
        }
        if ($savedFilterList != "") {
            $filterList = Concat($filterList, "\"filters\":" . $savedFilterList, ",");
        }
        return ($filterList != "") ? "{" . $filterList . "}" : "null";
    }

    // Process filter list
    protected function processFilterList()
    {
        global $UserProfile;
        if (Post("ajax") == "savefilters") { // Save filter request (Ajax)
            $filters = Post("filters");
            $UserProfile->setSearchFilters(CurrentUserName(), "f_cetak_profilumkmlengkap2listsrch", $filters);
            WriteJson([["success" => true]]); // Success
            return true;
        } elseif (Post("cmd") == "resetfilter") {
            $this->restoreFilterList();
        }
        return false;
    }

    // Restore list of filters
    protected function restoreFilterList()
    {
        // Return if not reset filter
        if (Post("cmd") !== "resetfilter") {
            return false;
        }
        $filter = json_decode(Post("filter"), true);
        $this->Command = "search";

        // Field nik
        $this->nik->AdvancedSearch->SearchValue = @$filter["x_nik"];
        $this->nik->AdvancedSearch->SearchOperator = @$filter["z_nik"];
        $this->nik->AdvancedSearch->SearchCondition = @$filter["v_nik"];
        $this->nik->AdvancedSearch->SearchValue2 = @$filter["y_nik"];
        $this->nik->AdvancedSearch->SearchOperator2 = @$filter["w_nik"];
        $this->nik->AdvancedSearch->save();

        // Field nama_usaha
        $this->nama_usaha->AdvancedSearch->SearchValue = @$filter["x_nama_usaha"];
        $this->nama_usaha->AdvancedSearch->SearchOperator = @$filter["z_nama_usaha"];
        $this->nama_usaha->AdvancedSearch->SearchCondition = @$filter["v_nama_usaha"];
        $this->nama_usaha->AdvancedSearch->SearchValue2 = @$filter["y_nama_usaha"];
        $this->nama_usaha->AdvancedSearch->SearchOperator2 = @$filter["w_nama_usaha"];
        $this->nama_usaha->AdvancedSearch->save();

        // Field prf_addbis
        $this->prf_addbis->AdvancedSearch->SearchValue = @$filter["x_prf_addbis"];
        $this->prf_addbis->AdvancedSearch->SearchOperator = @$filter["z_prf_addbis"];
        $this->prf_addbis->AdvancedSearch->SearchCondition = @$filter["v_prf_addbis"];
        $this->prf_addbis->AdvancedSearch->SearchValue2 = @$filter["y_prf_addbis"];
        $this->prf_addbis->AdvancedSearch->SearchOperator2 = @$filter["w_prf_addbis"];
        $this->prf_addbis->AdvancedSearch->save();

        // Field prf_addbi1
        $this->prf_addbi1->AdvancedSearch->SearchValue = @$filter["x_prf_addbi1"];
        $this->prf_addbi1->AdvancedSearch->SearchOperator = @$filter["z_prf_addbi1"];
        $this->prf_addbi1->AdvancedSearch->SearchCondition = @$filter["v_prf_addbi1"];
        $this->prf_addbi1->AdvancedSearch->SearchValue2 = @$filter["y_prf_addbi1"];
        $this->prf_addbi1->AdvancedSearch->SearchOperator2 = @$filter["w_prf_addbi1"];
        $this->prf_addbi1->AdvancedSearch->save();

        // Field kabupaten
        $this->kabupaten->AdvancedSearch->SearchValue = @$filter["x_kabupaten"];
        $this->kabupaten->AdvancedSearch->SearchOperator = @$filter["z_kabupaten"];
        $this->kabupaten->AdvancedSearch->SearchCondition = @$filter["v_kabupaten"];
        $this->kabupaten->AdvancedSearch->SearchValue2 = @$filter["y_kabupaten"];
        $this->kabupaten->AdvancedSearch->SearchOperator2 = @$filter["w_kabupaten"];
        $this->kabupaten->AdvancedSearch->save();

        // Field klasifikas
        $this->klasifikas->AdvancedSearch->SearchValue = @$filter["x_klasifikas"];
        $this->klasifikas->AdvancedSearch->SearchOperator = @$filter["z_klasifikas"];
        $this->klasifikas->AdvancedSearch->SearchCondition = @$filter["v_klasifikas"];
        $this->klasifikas->AdvancedSearch->SearchValue2 = @$filter["y_klasifikas"];
        $this->klasifikas->AdvancedSearch->SearchOperator2 = @$filter["w_klasifikas"];
        $this->klasifikas->AdvancedSearch->save();

        // Field sektor_per
        $this->sektor_per->AdvancedSearch->SearchValue = @$filter["x_sektor_per"];
        $this->sektor_per->AdvancedSearch->SearchOperator = @$filter["z_sektor_per"];
        $this->sektor_per->AdvancedSearch->SearchCondition = @$filter["v_sektor_per"];
        $this->sektor_per->AdvancedSearch->SearchValue2 = @$filter["y_sektor_per"];
        $this->sektor_per->AdvancedSearch->SearchOperator2 = @$filter["w_sektor_per"];
        $this->sektor_per->AdvancedSearch->save();

        // Field sektor_kbl
        $this->sektor_kbl->AdvancedSearch->SearchValue = @$filter["x_sektor_kbl"];
        $this->sektor_kbl->AdvancedSearch->SearchOperator = @$filter["z_sektor_kbl"];
        $this->sektor_kbl->AdvancedSearch->SearchCondition = @$filter["v_sektor_kbl"];
        $this->sektor_kbl->AdvancedSearch->SearchValue2 = @$filter["y_sektor_kbl"];
        $this->sektor_kbl->AdvancedSearch->SearchOperator2 = @$filter["w_sektor_kbl"];
        $this->sektor_kbl->AdvancedSearch->save();

        // Field sektor_ekr
        $this->sektor_ekr->AdvancedSearch->SearchValue = @$filter["x_sektor_ekr"];
        $this->sektor_ekr->AdvancedSearch->SearchOperator = @$filter["z_sektor_ekr"];
        $this->sektor_ekr->AdvancedSearch->SearchCondition = @$filter["v_sektor_ekr"];
        $this->sektor_ekr->AdvancedSearch->SearchValue2 = @$filter["y_sektor_ekr"];
        $this->sektor_ekr->AdvancedSearch->SearchOperator2 = @$filter["w_sektor_ekr"];
        $this->sektor_ekr->AdvancedSearch->save();

        // Field nama_lengk
        $this->nama_lengk->AdvancedSearch->SearchValue = @$filter["x_nama_lengk"];
        $this->nama_lengk->AdvancedSearch->SearchOperator = @$filter["z_nama_lengk"];
        $this->nama_lengk->AdvancedSearch->SearchCondition = @$filter["v_nama_lengk"];
        $this->nama_lengk->AdvancedSearch->SearchValue2 = @$filter["y_nama_lengk"];
        $this->nama_lengk->AdvancedSearch->SearchOperator2 = @$filter["w_nama_lengk"];
        $this->nama_lengk->AdvancedSearch->save();

        // Field jenis_kela
        $this->jenis_kela->AdvancedSearch->SearchValue = @$filter["x_jenis_kela"];
        $this->jenis_kela->AdvancedSearch->SearchOperator = @$filter["z_jenis_kela"];
        $this->jenis_kela->AdvancedSearch->SearchCondition = @$filter["v_jenis_kela"];
        $this->jenis_kela->AdvancedSearch->SearchValue2 = @$filter["y_jenis_kela"];
        $this->jenis_kela->AdvancedSearch->SearchOperator2 = @$filter["w_jenis_kela"];
        $this->jenis_kela->AdvancedSearch->save();

        // Field no_hp
        $this->no_hp->AdvancedSearch->SearchValue = @$filter["x_no_hp"];
        $this->no_hp->AdvancedSearch->SearchOperator = @$filter["z_no_hp"];
        $this->no_hp->AdvancedSearch->SearchCondition = @$filter["v_no_hp"];
        $this->no_hp->AdvancedSearch->SearchValue2 = @$filter["y_no_hp"];
        $this->no_hp->AdvancedSearch->SearchOperator2 = @$filter["w_no_hp"];
        $this->no_hp->AdvancedSearch->save();

        // Field pendidikan
        $this->pendidikan->AdvancedSearch->SearchValue = @$filter["x_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator = @$filter["z_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchCondition = @$filter["v_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchValue2 = @$filter["y_pendidikan"];
        $this->pendidikan->AdvancedSearch->SearchOperator2 = @$filter["w_pendidikan"];
        $this->pendidikan->AdvancedSearch->save();

        // Field disabilita
        $this->disabilita->AdvancedSearch->SearchValue = @$filter["x_disabilita"];
        $this->disabilita->AdvancedSearch->SearchOperator = @$filter["z_disabilita"];
        $this->disabilita->AdvancedSearch->SearchCondition = @$filter["v_disabilita"];
        $this->disabilita->AdvancedSearch->SearchValue2 = @$filter["y_disabilita"];
        $this->disabilita->AdvancedSearch->SearchOperator2 = @$filter["w_disabilita"];
        $this->disabilita->AdvancedSearch->save();

        // Field tglmulai
        $this->tglmulai->AdvancedSearch->SearchValue = @$filter["x_tglmulai"];
        $this->tglmulai->AdvancedSearch->SearchOperator = @$filter["z_tglmulai"];
        $this->tglmulai->AdvancedSearch->SearchCondition = @$filter["v_tglmulai"];
        $this->tglmulai->AdvancedSearch->SearchValue2 = @$filter["y_tglmulai"];
        $this->tglmulai->AdvancedSearch->SearchOperator2 = @$filter["w_tglmulai"];
        $this->tglmulai->AdvancedSearch->save();

        // Field umurusaha
        $this->umurusaha->AdvancedSearch->SearchValue = @$filter["x_umurusaha"];
        $this->umurusaha->AdvancedSearch->SearchOperator = @$filter["z_umurusaha"];
        $this->umurusaha->AdvancedSearch->SearchCondition = @$filter["v_umurusaha"];
        $this->umurusaha->AdvancedSearch->SearchValue2 = @$filter["y_umurusaha"];
        $this->umurusaha->AdvancedSearch->SearchOperator2 = @$filter["w_umurusaha"];
        $this->umurusaha->AdvancedSearch->save();

        // Field addbisnis
        $this->addbisnis->AdvancedSearch->SearchValue = @$filter["x_addbisnis"];
        $this->addbisnis->AdvancedSearch->SearchOperator = @$filter["z_addbisnis"];
        $this->addbisnis->AdvancedSearch->SearchCondition = @$filter["v_addbisnis"];
        $this->addbisnis->AdvancedSearch->SearchValue2 = @$filter["y_addbisnis"];
        $this->addbisnis->AdvancedSearch->SearchOperator2 = @$filter["w_addbisnis"];
        $this->addbisnis->AdvancedSearch->save();

        // Field nilai_aset
        $this->nilai_aset->AdvancedSearch->SearchValue = @$filter["x_nilai_aset"];
        $this->nilai_aset->AdvancedSearch->SearchOperator = @$filter["z_nilai_aset"];
        $this->nilai_aset->AdvancedSearch->SearchCondition = @$filter["v_nilai_aset"];
        $this->nilai_aset->AdvancedSearch->SearchValue2 = @$filter["y_nilai_aset"];
        $this->nilai_aset->AdvancedSearch->SearchOperator2 = @$filter["w_nilai_aset"];
        $this->nilai_aset->AdvancedSearch->save();

        // Field omsetbulan
        $this->omsetbulan->AdvancedSearch->SearchValue = @$filter["x_omsetbulan"];
        $this->omsetbulan->AdvancedSearch->SearchOperator = @$filter["z_omsetbulan"];
        $this->omsetbulan->AdvancedSearch->SearchCondition = @$filter["v_omsetbulan"];
        $this->omsetbulan->AdvancedSearch->SearchValue2 = @$filter["y_omsetbulan"];
        $this->omsetbulan->AdvancedSearch->SearchOperator2 = @$filter["w_omsetbulan"];
        $this->omsetbulan->AdvancedSearch->save();

        // Field kegiatan_u
        $this->kegiatan_u->AdvancedSearch->SearchValue = @$filter["x_kegiatan_u"];
        $this->kegiatan_u->AdvancedSearch->SearchOperator = @$filter["z_kegiatan_u"];
        $this->kegiatan_u->AdvancedSearch->SearchCondition = @$filter["v_kegiatan_u"];
        $this->kegiatan_u->AdvancedSearch->SearchValue2 = @$filter["y_kegiatan_u"];
        $this->kegiatan_u->AdvancedSearch->SearchOperator2 = @$filter["w_kegiatan_u"];
        $this->kegiatan_u->AdvancedSearch->save();

        // Field uraian_keg
        $this->uraian_keg->AdvancedSearch->SearchValue = @$filter["x_uraian_keg"];
        $this->uraian_keg->AdvancedSearch->SearchOperator = @$filter["z_uraian_keg"];
        $this->uraian_keg->AdvancedSearch->SearchCondition = @$filter["v_uraian_keg"];
        $this->uraian_keg->AdvancedSearch->SearchValue2 = @$filter["y_uraian_keg"];
        $this->uraian_keg->AdvancedSearch->SearchOperator2 = @$filter["w_uraian_keg"];
        $this->uraian_keg->AdvancedSearch->save();

        // Field emailusaha
        $this->emailusaha->AdvancedSearch->SearchValue = @$filter["x_emailusaha"];
        $this->emailusaha->AdvancedSearch->SearchOperator = @$filter["z_emailusaha"];
        $this->emailusaha->AdvancedSearch->SearchCondition = @$filter["v_emailusaha"];
        $this->emailusaha->AdvancedSearch->SearchValue2 = @$filter["y_emailusaha"];
        $this->emailusaha->AdvancedSearch->SearchOperator2 = @$filter["w_emailusaha"];
        $this->emailusaha->AdvancedSearch->save();

        // Field akun_ig
        $this->akun_ig->AdvancedSearch->SearchValue = @$filter["x_akun_ig"];
        $this->akun_ig->AdvancedSearch->SearchOperator = @$filter["z_akun_ig"];
        $this->akun_ig->AdvancedSearch->SearchCondition = @$filter["v_akun_ig"];
        $this->akun_ig->AdvancedSearch->SearchValue2 = @$filter["y_akun_ig"];
        $this->akun_ig->AdvancedSearch->SearchOperator2 = @$filter["w_akun_ig"];
        $this->akun_ig->AdvancedSearch->save();

        // Field akun_faceb
        $this->akun_faceb->AdvancedSearch->SearchValue = @$filter["x_akun_faceb"];
        $this->akun_faceb->AdvancedSearch->SearchOperator = @$filter["z_akun_faceb"];
        $this->akun_faceb->AdvancedSearch->SearchCondition = @$filter["v_akun_faceb"];
        $this->akun_faceb->AdvancedSearch->SearchValue2 = @$filter["y_akun_faceb"];
        $this->akun_faceb->AdvancedSearch->SearchOperator2 = @$filter["w_akun_faceb"];
        $this->akun_faceb->AdvancedSearch->save();

        // Field akun_gmb
        $this->akun_gmb->AdvancedSearch->SearchValue = @$filter["x_akun_gmb"];
        $this->akun_gmb->AdvancedSearch->SearchOperator = @$filter["z_akun_gmb"];
        $this->akun_gmb->AdvancedSearch->SearchCondition = @$filter["v_akun_gmb"];
        $this->akun_gmb->AdvancedSearch->SearchValue2 = @$filter["y_akun_gmb"];
        $this->akun_gmb->AdvancedSearch->SearchOperator2 = @$filter["w_akun_gmb"];
        $this->akun_gmb->AdvancedSearch->save();

        // Field url_websit
        $this->url_websit->AdvancedSearch->SearchValue = @$filter["x_url_websit"];
        $this->url_websit->AdvancedSearch->SearchOperator = @$filter["z_url_websit"];
        $this->url_websit->AdvancedSearch->SearchCondition = @$filter["v_url_websit"];
        $this->url_websit->AdvancedSearch->SearchValue2 = @$filter["y_url_websit"];
        $this->url_websit->AdvancedSearch->SearchOperator2 = @$filter["w_url_websit"];
        $this->url_websit->AdvancedSearch->save();

        // Field url_market
        $this->url_market->AdvancedSearch->SearchValue = @$filter["x_url_market"];
        $this->url_market->AdvancedSearch->SearchOperator = @$filter["z_url_market"];
        $this->url_market->AdvancedSearch->SearchCondition = @$filter["v_url_market"];
        $this->url_market->AdvancedSearch->SearchValue2 = @$filter["y_url_market"];
        $this->url_market->AdvancedSearch->SearchOperator2 = @$filter["w_url_market"];
        $this->url_market->AdvancedSearch->save();

        // Field kelas
        $this->kelas->AdvancedSearch->SearchValue = @$filter["x_kelas"];
        $this->kelas->AdvancedSearch->SearchOperator = @$filter["z_kelas"];
        $this->kelas->AdvancedSearch->SearchCondition = @$filter["v_kelas"];
        $this->kelas->AdvancedSearch->SearchValue2 = @$filter["y_kelas"];
        $this->kelas->AdvancedSearch->SearchOperator2 = @$filter["w_kelas"];
        $this->kelas->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->nik, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nama_usaha, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->prf_addbis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->prf_addbi1, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kabupaten, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->klasifikas, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->sektor_per, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->sektor_kbl, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->sektor_ekr, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->nama_lengk, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->jenis_kela, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->no_hp, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->pendidikan, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->disabilita, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->umurusaha, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->addbisnis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kegiatan_u, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->uraian_keg, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->emailusaha, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->akun_ig, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->akun_faceb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->akun_gmb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->url_websit, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->url_market, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kelas, $arKeywords, $type);
        return $where;
    }

    // Build basic search SQL
    protected function buildBasicSearchSql(&$where, &$fld, $arKeywords, $type)
    {
        $defCond = ($type == "OR") ? "OR" : "AND";
        $arSql = []; // Array for SQL parts
        $arCond = []; // Array for search conditions
        $cnt = count($arKeywords);
        $j = 0; // Number of SQL parts
        for ($i = 0; $i < $cnt; $i++) {
            $keyword = $arKeywords[$i];
            $keyword = trim($keyword);
            if (Config("BASIC_SEARCH_IGNORE_PATTERN") != "") {
                $keyword = preg_replace(Config("BASIC_SEARCH_IGNORE_PATTERN"), "\\", $keyword);
                $ar = explode("\\", $keyword);
            } else {
                $ar = [$keyword];
            }
            foreach ($ar as $keyword) {
                if ($keyword != "") {
                    $wrk = "";
                    if ($keyword == "OR" && $type == "") {
                        if ($j > 0) {
                            $arCond[$j - 1] = "OR";
                        }
                    } elseif ($keyword == Config("NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NULL";
                    } elseif ($keyword == Config("NOT_NULL_VALUE")) {
                        $wrk = $fld->Expression . " IS NOT NULL";
                    } elseif ($fld->IsVirtual && $fld->Visible) {
                        $wrk = $fld->VirtualExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    } elseif ($fld->DataType != DATATYPE_NUMBER || is_numeric($keyword)) {
                        $wrk = $fld->BasicSearchExpression . Like(QuotedValue("%" . $keyword . "%", DATATYPE_STRING, $this->Dbid), $this->Dbid);
                    }
                    if ($wrk != "") {
                        $arSql[$j] = $wrk;
                        $arCond[$j] = $defCond;
                        $j += 1;
                    }
                }
            }
        }
        $cnt = count($arSql);
        $quoted = false;
        $sql = "";
        if ($cnt > 0) {
            for ($i = 0; $i < $cnt - 1; $i++) {
                if ($arCond[$i] == "OR") {
                    if (!$quoted) {
                        $sql .= "(";
                    }
                    $quoted = true;
                }
                $sql .= $arSql[$i];
                if ($quoted && $arCond[$i] != "OR") {
                    $sql .= ")";
                    $quoted = false;
                }
                $sql .= " " . $arCond[$i] . " ";
            }
            $sql .= $arSql[$cnt - 1];
            if ($quoted) {
                $sql .= ")";
            }
        }
        if ($sql != "") {
            if ($where != "") {
                $where .= " OR ";
            }
            $where .= "(" . $sql . ")";
        }
    }

    // Return basic search WHERE clause based on search keyword and type
    protected function basicSearchWhere($default = false)
    {
        global $Security;
        $searchStr = "";
        if (!$Security->canSearch()) {
            return "";
        }
        $searchKeyword = ($default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
        $searchType = ($default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

        // Get search SQL
        if ($searchKeyword != "") {
            $ar = $this->BasicSearch->keywordList($default);
            // Search keyword in any fields
            if (($searchType == "OR" || $searchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
                foreach ($ar as $keyword) {
                    if ($keyword != "") {
                        if ($searchStr != "") {
                            $searchStr .= " " . $searchType . " ";
                        }
                        $searchStr .= "(" . $this->basicSearchSql([$keyword], $searchType) . ")";
                    }
                }
            } else {
                $searchStr = $this->basicSearchSql($ar, $searchType);
            }
            if (!$default && in_array($this->Command, ["", "reset", "resetall"])) {
                $this->Command = "search";
            }
        }
        if (!$default && $this->Command == "search") {
            $this->BasicSearch->setKeyword($searchKeyword);
            $this->BasicSearch->setType($searchType);
        }
        return $searchStr;
    }

    // Check if search parm exists
    protected function checkSearchParms()
    {
        // Check basic search
        if ($this->BasicSearch->issetSession()) {
            return true;
        }
        return false;
    }

    // Clear all search parameters
    protected function resetSearchParms()
    {
        // Clear search WHERE clause
        $this->SearchWhere = "";
        $this->setSearchWhere($this->SearchWhere);

        // Clear basic search parameters
        $this->resetBasicSearchParms();
    }

    // Load advanced search default values
    protected function loadAdvancedSearchDefault()
    {
        return false;
    }

    // Clear all basic search parameters
    protected function resetBasicSearchParms()
    {
        $this->BasicSearch->unsetSession();
    }

    // Restore all search parameters
    protected function restoreSearchParms()
    {
        $this->RestoreSearch = true;

        // Restore basic search values
        $this->BasicSearch->load();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->nik); // nik
            $this->updateSort($this->klasifikas); // klasifikas
            $this->updateSort($this->jenis_kela); // jenis_kela
            $this->updateSort($this->no_hp); // no_hp
            $this->updateSort($this->pendidikan); // pendidikan
            $this->updateSort($this->disabilita); // disabilita
            $this->updateSort($this->tglmulai); // tglmulai
            $this->updateSort($this->nilai_aset); // nilai_aset
            $this->updateSort($this->omsetbulan); // omsetbulan
            $this->updateSort($this->emailusaha); // emailusaha
            $this->updateSort($this->akun_ig); // akun_ig
            $this->updateSort($this->akun_faceb); // akun_faceb
            $this->updateSort($this->akun_gmb); // akun_gmb
            $this->updateSort($this->url_websit); // url_websit
            $this->updateSort($this->kelas); // kelas
            $this->setStartRecordNumber(1); // Reset start position
        }
    }

    // Load sort order parameters
    protected function loadSortOrder()
    {
        $orderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
        if ($orderBy == "") {
            $this->DefaultSort = "";
            if ($this->getSqlOrderBy() != "") {
                $useDefaultSort = true;
                if ($useDefaultSort) {
                    $orderBy = $this->getSqlOrderBy();
                    $this->setSessionOrderBy($orderBy);
                } else {
                    $this->setSessionOrderBy("");
                }
            }
        }
    }

    // Reset command
    // - cmd=reset (Reset search parameters)
    // - cmd=resetall (Reset search and master/detail parameters)
    // - cmd=resetsort (Reset sort parameters)
    protected function resetCmd()
    {
        // Check if reset command
        if (StartsString("reset", $this->Command)) {
            // Reset search criteria
            if ($this->Command == "reset" || $this->Command == "resetall") {
                $this->resetSearchParms();
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->nik->setSort("");
                $this->nama_usaha->setSort("");
                $this->prf_addbis->setSort("");
                $this->prf_addbi1->setSort("");
                $this->kabupaten->setSort("");
                $this->klasifikas->setSort("");
                $this->sektor_per->setSort("");
                $this->sektor_kbl->setSort("");
                $this->sektor_ekr->setSort("");
                $this->nama_lengk->setSort("");
                $this->jenis_kela->setSort("");
                $this->no_hp->setSort("");
                $this->pendidikan->setSort("");
                $this->disabilita->setSort("");
                $this->tglmulai->setSort("");
                $this->umurusaha->setSort("");
                $this->addbisnis->setSort("");
                $this->nilai_aset->setSort("");
                $this->omsetbulan->setSort("");
                $this->kegiatan_u->setSort("");
                $this->uraian_keg->setSort("");
                $this->emailusaha->setSort("");
                $this->akun_ig->setSort("");
                $this->akun_faceb->setSort("");
                $this->akun_gmb->setSort("");
                $this->url_websit->setSort("");
                $this->url_market->setSort("");
                $this->kelas->setSort("");
            }

            // Reset start position
            $this->StartRecord = 1;
            $this->setStartRecordNumber($this->StartRecord);
        }
    }

    // Set up list options
    protected function setupListOptions()
    {
        global $Security, $Language;

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = false;
        $item->OnLeft = true;
        $item->Header = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" name=\"key\" id=\"key\" class=\"custom-control-input\" onclick=\"ew.selectAllKey(this);\"><label class=\"custom-control-label\" for=\"key\"></label></div>";
        $item->moveTo(0);
        $item->ShowInDropDown = false;
        $item->ShowInButtonGroup = false;

        // Drop down button for ListOptions
        $this->ListOptions->UseDropDownButton = true;
        $this->ListOptions->DropDownButtonPhrase = $Language->phrase("ButtonListOptions");
        $this->ListOptions->UseButtonGroup = false;
        if ($this->ListOptions->UseButtonGroup && IsMobile()) {
            $this->ListOptions->UseDropDownButton = true;
        }

        //$this->ListOptions->ButtonClass = ""; // Class for button group

        // Call ListOptions_Load event
        $this->listOptionsLoad();
        $this->setupListOptionsExt();
        $item = $this->ListOptions[$this->ListOptions->GroupOptionName];
        $item->Visible = $this->ListOptions->groupOptionVisible();
    }

    // Render list options
    public function renderListOptions()
    {
        global $Security, $Language, $CurrentForm;
        $this->ListOptions->loadDefault();

        // Call ListOptions_Rendering event
        $this->listOptionsRendering();
        $pageUrl = $this->pageUrl();
        if ($this->CurrentMode == "view") { // View mode
        } // End View mode

        // Set up list action buttons
        $opt = $this->ListOptions["listactions"];
        if ($opt && !$this->isExport() && !$this->CurrentAction) {
            $body = "";
            $links = [];
            foreach ($this->ListActions->Items as $listaction) {
                if ($listaction->Select == ACTION_SINGLE && $listaction->Allow) {
                    $action = $listaction->Action;
                    $caption = $listaction->Caption;
                    $icon = ($listaction->Icon != "") ? "<i class=\"" . HtmlEncode(str_replace(" ew-icon", "", $listaction->Icon)) . "\" data-caption=\"" . HtmlTitle($caption) . "\"></i> " : "";
                    $links[] = "<li><a class=\"dropdown-item ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a></li>";
                    if (count($links) == 1) { // Single button
                        $body = "<a class=\"ew-action ew-list-action\" data-action=\"" . HtmlEncode($action) . "\" title=\"" . HtmlTitle($caption) . "\" data-caption=\"" . HtmlTitle($caption) . "\" href=\"#\" onclick=\"return ew.submitAction(event,jQuery.extend({key:" . $this->keyToJson(true) . "}," . $listaction->toJson(true) . "));\">" . $icon . $listaction->Caption . "</a>";
                    }
                }
            }
            if (count($links) > 1) { // More than one buttons, use dropdown
                $body = "<button class=\"dropdown-toggle btn btn-default ew-actions\" title=\"" . HtmlTitle($Language->phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->phrase("ListActionButton") . "</button>";
                $content = "";
                foreach ($links as $link) {
                    $content .= "<li>" . $link . "</li>";
                }
                $body .= "<ul class=\"dropdown-menu" . ($opt->OnLeft ? "" : " dropdown-menu-right") . "\">" . $content . "</ul>";
                $body = "<div class=\"btn-group btn-group-sm\">" . $body . "</div>";
            }
            if (count($links) > 0) {
                $opt->Body = $body;
                $opt->Visible = true;
            }
        }

        // "checkbox"
        $opt = $this->ListOptions["checkbox"];
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Set up options default
        foreach ($options as $option) {
            $option->UseDropDownButton = true;
            $option->UseButtonGroup = true;
            //$option->ButtonClass = ""; // Class for button group
            $item = &$option->add($option->GroupOptionName);
            $item->Body = "";
            $item->Visible = false;
        }
        $options["addedit"]->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $options["detail"]->DropDownButtonPhrase = $Language->phrase("ButtonDetails");
        $options["action"]->DropDownButtonPhrase = $Language->phrase("ButtonActions");

        // Filter button
        $item = &$this->FilterOptions->add("savecurrentfilter");
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"f_cetak_profilumkmlengkap2listsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"f_cetak_profilumkmlengkap2listsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = true;
        $this->FilterOptions->UseDropDownButton = true;
        $this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
        $this->FilterOptions->DropDownButtonPhrase = $Language->phrase("Filters");

        // Add group option item
        $item = &$this->FilterOptions->add($this->FilterOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];
        // Set up list action buttons
        foreach ($this->ListActions->Items as $listaction) {
            if ($listaction->Select == ACTION_MULTIPLE) {
                $item = &$option->add("custom_" . $listaction->Action);
                $caption = $listaction->Caption;
                $icon = ($listaction->Icon != "") ? '<i class="' . HtmlEncode($listaction->Icon) . '" data-caption="' . HtmlEncode($caption) . '"></i>' . $caption : $caption;
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.f_cetak_profilumkmlengkap2list},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
                $item->Visible = $listaction->Allow;
            }
        }

        // Hide grid edit and other options
        if ($this->TotalRecords <= 0) {
            $option = $options["addedit"];
            $item = $option["gridedit"];
            if ($item) {
                $item->Visible = false;
            }
            $option = $options["action"];
            $option->hideAllOptions();
        }
    }

    // Process list action
    protected function processListAction()
    {
        global $Language, $Security;
        $userlist = "";
        $user = "";
        $filter = $this->getFilterFromRecordKeys();
        $userAction = Post("useraction", "");
        if ($filter != "" && $userAction != "") {
            // Check permission first
            $actionCaption = $userAction;
            if (array_key_exists($userAction, $this->ListActions->Items)) {
                $actionCaption = $this->ListActions[$userAction]->Caption;
                if (!$this->ListActions[$userAction]->Allow) {
                    $errmsg = str_replace('%s', $actionCaption, $Language->phrase("CustomActionNotAllowed"));
                    if (Post("ajax") == $userAction) { // Ajax
                        echo "<p class=\"text-danger\">" . $errmsg . "</p>";
                        return true;
                    } else {
                        $this->setFailureMessage($errmsg);
                        return false;
                    }
                }
            }
            $this->CurrentFilter = $filter;
            $sql = $this->getCurrentSql();
            $conn = $this->getConnection();
            $rs = LoadRecordset($sql, $conn, \PDO::FETCH_ASSOC);
            $this->CurrentAction = $userAction;

            // Call row action event
            if ($rs) {
                $conn->beginTransaction();
                $this->SelectedCount = $rs->recordCount();
                $this->SelectedIndex = 0;
                while (!$rs->EOF) {
                    $this->SelectedIndex++;
                    $row = $rs->fields;
                    $processed = $this->rowCustomAction($userAction, $row);
                    if (!$processed) {
                        break;
                    }
                    $rs->moveNext();
                }
                if ($processed) {
                    $conn->commit(); // Commit the changes
                    if ($this->getSuccessMessage() == "" && !ob_get_length()) { // No output
                        $this->setSuccessMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionCompleted"))); // Set up success message
                    }
                } else {
                    $conn->rollback(); // Rollback changes

                    // Set up error message
                    if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                        // Use the message, do nothing
                    } elseif ($this->CancelMessage != "") {
                        $this->setFailureMessage($this->CancelMessage);
                        $this->CancelMessage = "";
                    } else {
                        $this->setFailureMessage(str_replace('%s', $actionCaption, $Language->phrase("CustomActionFailed")));
                    }
                }
            }
            if ($rs) {
                $rs->close();
            }
            $this->CurrentAction = ""; // Clear action
            if (Post("ajax") == $userAction) { // Ajax
                if ($this->getSuccessMessage() != "") {
                    echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
                    $this->clearSuccessMessage(); // Clear message
                }
                if ($this->getFailureMessage() != "") {
                    echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
                    $this->clearFailureMessage(); // Clear message
                }
                return true;
            }
        }
        return false; // Not ajax request
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
    }

    // Load basic search values
    protected function loadBasicSearchValues()
    {
        $this->BasicSearch->setKeyword(Get(Config("TABLE_BASIC_SEARCH"), ""), false);
        if ($this->BasicSearch->Keyword != "" && $this->Command == "") {
            $this->Command = "search";
        }
        $this->BasicSearch->setType(Get(Config("TABLE_BASIC_SEARCH_TYPE"), ""), false);
    }

    // Load recordset
    public function loadRecordset($offset = -1, $rowcnt = -1)
    {
        // Load List page SQL (QueryBuilder)
        $sql = $this->getListSql();

        // Load recordset
        if ($offset > -1) {
            $sql->setFirstResult($offset);
        }
        if ($rowcnt > 0) {
            $sql->setMaxResults($rowcnt);
        }
        $stmt = $sql->execute();
        $rs = new Recordset($stmt, $sql);

        // Call Recordset Selected event
        $this->recordsetSelected($rs);
        return $rs;
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
        $this->nama_usaha->setDbValue($row['nama_usaha']);
        $this->prf_addbis->setDbValue($row['prf_addbis']);
        $this->prf_addbi1->setDbValue($row['prf_addbi1']);
        $this->kabupaten->setDbValue($row['kabupaten']);
        $this->klasifikas->setDbValue($row['klasifikas']);
        $this->sektor_per->setDbValue($row['sektor_per']);
        $this->sektor_kbl->setDbValue($row['sektor_kbl']);
        $this->sektor_ekr->setDbValue($row['sektor_ekr']);
        $this->nama_lengk->setDbValue($row['nama_lengk']);
        $this->jenis_kela->setDbValue($row['jenis_kela']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->disabilita->setDbValue($row['disabilita']);
        $this->tglmulai->setDbValue($row['tglmulai']);
        $this->umurusaha->setDbValue($row['umurusaha']);
        $this->addbisnis->setDbValue($row['addbisnis']);
        $this->nilai_aset->setDbValue($row['nilai_aset']);
        $this->omsetbulan->setDbValue($row['omsetbulan']);
        $this->kegiatan_u->setDbValue($row['kegiatan_u']);
        $this->uraian_keg->setDbValue($row['uraian_keg']);
        $this->emailusaha->setDbValue($row['emailusaha']);
        $this->akun_ig->setDbValue($row['akun_ig']);
        $this->akun_faceb->setDbValue($row['akun_faceb']);
        $this->akun_gmb->setDbValue($row['akun_gmb']);
        $this->url_websit->setDbValue($row['url_websit']);
        $this->url_market->setDbValue($row['url_market']);
        $this->kelas->setDbValue($row['kelas']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['nama_usaha'] = null;
        $row['prf_addbis'] = null;
        $row['prf_addbi1'] = null;
        $row['kabupaten'] = null;
        $row['klasifikas'] = null;
        $row['sektor_per'] = null;
        $row['sektor_kbl'] = null;
        $row['sektor_ekr'] = null;
        $row['nama_lengk'] = null;
        $row['jenis_kela'] = null;
        $row['no_hp'] = null;
        $row['pendidikan'] = null;
        $row['disabilita'] = null;
        $row['tglmulai'] = null;
        $row['umurusaha'] = null;
        $row['addbisnis'] = null;
        $row['nilai_aset'] = null;
        $row['omsetbulan'] = null;
        $row['kegiatan_u'] = null;
        $row['uraian_keg'] = null;
        $row['emailusaha'] = null;
        $row['akun_ig'] = null;
        $row['akun_faceb'] = null;
        $row['akun_gmb'] = null;
        $row['url_websit'] = null;
        $row['url_market'] = null;
        $row['kelas'] = null;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // nama_usaha

        // prf_addbis

        // prf_addbi1

        // kabupaten

        // klasifikas

        // sektor_per

        // sektor_kbl

        // sektor_ekr

        // nama_lengk

        // jenis_kela

        // no_hp

        // pendidikan

        // disabilita

        // tglmulai

        // umurusaha

        // addbisnis

        // nilai_aset

        // omsetbulan

        // kegiatan_u

        // uraian_keg

        // emailusaha

        // akun_ig

        // akun_faceb

        // akun_gmb

        // url_websit

        // url_market

        // kelas
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // klasifikas
            $this->klasifikas->ViewValue = $this->klasifikas->CurrentValue;
            $this->klasifikas->ViewCustomAttributes = "";

            // jenis_kela
            $this->jenis_kela->ViewValue = $this->jenis_kela->CurrentValue;
            $this->jenis_kela->ViewCustomAttributes = "";

            // no_hp
            $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
            $this->no_hp->ViewCustomAttributes = "";

            // pendidikan
            $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
            $this->pendidikan->ViewCustomAttributes = "";

            // disabilita
            $this->disabilita->ViewValue = $this->disabilita->CurrentValue;
            $this->disabilita->ViewCustomAttributes = "";

            // tglmulai
            $this->tglmulai->ViewValue = $this->tglmulai->CurrentValue;
            $this->tglmulai->ViewValue = FormatDateTime($this->tglmulai->ViewValue, 0);
            $this->tglmulai->ViewCustomAttributes = "";

            // nilai_aset
            $this->nilai_aset->ViewValue = $this->nilai_aset->CurrentValue;
            $this->nilai_aset->ViewValue = FormatNumber($this->nilai_aset->ViewValue, 0, -2, -2, -2);
            $this->nilai_aset->ViewCustomAttributes = "";

            // omsetbulan
            $this->omsetbulan->ViewValue = $this->omsetbulan->CurrentValue;
            $this->omsetbulan->ViewValue = FormatNumber($this->omsetbulan->ViewValue, 0, -2, -2, -2);
            $this->omsetbulan->ViewCustomAttributes = "";

            // emailusaha
            $this->emailusaha->ViewValue = $this->emailusaha->CurrentValue;
            $this->emailusaha->ViewCustomAttributes = "";

            // akun_ig
            $this->akun_ig->ViewValue = $this->akun_ig->CurrentValue;
            $this->akun_ig->ViewCustomAttributes = "";

            // akun_faceb
            $this->akun_faceb->ViewValue = $this->akun_faceb->CurrentValue;
            $this->akun_faceb->ViewCustomAttributes = "";

            // akun_gmb
            $this->akun_gmb->ViewValue = $this->akun_gmb->CurrentValue;
            $this->akun_gmb->ViewCustomAttributes = "";

            // url_websit
            $this->url_websit->ViewValue = $this->url_websit->CurrentValue;
            $this->url_websit->ViewCustomAttributes = "";

            // kelas
            $this->kelas->ViewValue = $this->kelas->CurrentValue;
            $this->kelas->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // klasifikas
            $this->klasifikas->LinkCustomAttributes = "";
            $this->klasifikas->HrefValue = "";
            $this->klasifikas->TooltipValue = "";

            // jenis_kela
            $this->jenis_kela->LinkCustomAttributes = "";
            $this->jenis_kela->HrefValue = "";
            $this->jenis_kela->TooltipValue = "";

            // no_hp
            $this->no_hp->LinkCustomAttributes = "";
            $this->no_hp->HrefValue = "";
            $this->no_hp->TooltipValue = "";

            // pendidikan
            $this->pendidikan->LinkCustomAttributes = "";
            $this->pendidikan->HrefValue = "";
            $this->pendidikan->TooltipValue = "";

            // disabilita
            $this->disabilita->LinkCustomAttributes = "";
            $this->disabilita->HrefValue = "";
            $this->disabilita->TooltipValue = "";

            // tglmulai
            $this->tglmulai->LinkCustomAttributes = "";
            $this->tglmulai->HrefValue = "";
            $this->tglmulai->TooltipValue = "";

            // nilai_aset
            $this->nilai_aset->LinkCustomAttributes = "";
            $this->nilai_aset->HrefValue = "";
            $this->nilai_aset->TooltipValue = "";

            // omsetbulan
            $this->omsetbulan->LinkCustomAttributes = "";
            $this->omsetbulan->HrefValue = "";
            $this->omsetbulan->TooltipValue = "";

            // emailusaha
            $this->emailusaha->LinkCustomAttributes = "";
            $this->emailusaha->HrefValue = "";
            $this->emailusaha->TooltipValue = "";

            // akun_ig
            $this->akun_ig->LinkCustomAttributes = "";
            $this->akun_ig->HrefValue = "";
            $this->akun_ig->TooltipValue = "";

            // akun_faceb
            $this->akun_faceb->LinkCustomAttributes = "";
            $this->akun_faceb->HrefValue = "";
            $this->akun_faceb->TooltipValue = "";

            // akun_gmb
            $this->akun_gmb->LinkCustomAttributes = "";
            $this->akun_gmb->HrefValue = "";
            $this->akun_gmb->TooltipValue = "";

            // url_websit
            $this->url_websit->LinkCustomAttributes = "";
            $this->url_websit->HrefValue = "";
            $this->url_websit->TooltipValue = "";

            // kelas
            $this->kelas->LinkCustomAttributes = "";
            $this->kelas->HrefValue = "";
            $this->kelas->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
    }

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.f_cetak_profilumkmlengkap2list, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.f_cetak_profilumkmlengkap2list, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.f_cetak_profilumkmlengkap2list, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\">" . $Language->phrase("ExportToPDF") . "</a>";
            }
        } elseif (SameText($type, "html")) {
            return "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ew-export-link ew-html\" title=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToHtmlText")) . "\">" . $Language->phrase("ExportToHtml") . "</a>";
        } elseif (SameText($type, "xml")) {
            return "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ew-export-link ew-xml\" title=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToXmlText")) . "\">" . $Language->phrase("ExportToXml") . "</a>";
        } elseif (SameText($type, "csv")) {
            return "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ew-export-link ew-csv\" title=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToCsvText")) . "\">" . $Language->phrase("ExportToCsv") . "</a>";
        } elseif (SameText($type, "email")) {
            $url = $custom ? ",url:'" . $pageUrl . "export=email&amp;custom=1'" : "";
            return '<button id="emf__cetak_profilumkmlengkap2" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf__cetak_profilumkmlengkap2\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.f_cetak_profilumkmlengkap2list, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
        } elseif (SameText($type, "print")) {
            return "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ew-export-link ew-print\" title=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("PrinterFriendlyText")) . "\">" . $Language->phrase("PrinterFriendly") . "</a>";
        }
    }

    // Set up export options
    protected function setupExportOptions()
    {
        global $Language;

        // Printer friendly
        $item = &$this->ExportOptions->add("print");
        $item->Body = $this->getExportTag("print");
        $item->Visible = true;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = true;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = true;

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = true;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = true;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = true;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = true;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = true;
        if ($this->ExportOptions->UseButtonGroup && IsMobile()) {
            $this->ExportOptions->UseDropDownButton = true;
        }
        $this->ExportOptions->DropDownButtonPhrase = $Language->phrase("ButtonExport");

        // Add group option item
        $item = &$this->ExportOptions->add($this->ExportOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
    }

    // Set up search/sort options
    protected function setupSearchSortOptions()
    {
        global $Language, $Security;
        $pageUrl = $this->pageUrl();
        $this->SearchOptions = new ListOptions("div");
        $this->SearchOptions->TagClassName = "ew-search-option";

        // Search button
        $item = &$this->SearchOptions->add("searchtoggle");
        $searchToggleClass = ($this->SearchWhere != "") ? " active" : " active";
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"f_cetak_profilumkmlengkap2listsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
        $item->Visible = true;

        // Show all button
        $item = &$this->SearchOptions->add("showall");
        $item->Body = "<a class=\"btn btn-default ew-show-all\" title=\"" . $Language->phrase("ShowAll") . "\" data-caption=\"" . $Language->phrase("ShowAll") . "\" href=\"" . $pageUrl . "cmd=reset\">" . $Language->phrase("ShowAllBtn") . "</a>";
        $item->Visible = ($this->SearchWhere != $this->DefaultSearchWhere && $this->SearchWhere != "0=101");

        // Button group for search
        $this->SearchOptions->UseDropDownButton = false;
        $this->SearchOptions->UseButtonGroup = true;
        $this->SearchOptions->DropDownButtonPhrase = $Language->phrase("ButtonSearch");

        // Add group option item
        $item = &$this->SearchOptions->add($this->SearchOptions->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Hide search options
        if ($this->isExport() || $this->CurrentAction) {
            $this->SearchOptions->hideAllOptions();
        }
        if (!$Security->canSearch()) {
            $this->SearchOptions->hideAllOptions();
            $this->FilterOptions->hideAllOptions();
        }
    }

    /**
    * Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
    *
    * @param bool $return Return the data rather than output it
    * @return mixed
    */
    public function exportData($return = false)
    {
        global $Language;
        $utf8 = SameText(Config("PROJECT_CHARSET"), "utf-8");

        // Load recordset
        $this->TotalRecords = $this->listRecordCount();
        $this->StartRecord = 1;

        // Export all
        if ($this->ExportAll) {
            if (Config("EXPORT_ALL_TIME_LIMIT") >= 0) {
                @set_time_limit(Config("EXPORT_ALL_TIME_LIMIT"));
            }
            $this->DisplayRecords = $this->TotalRecords;
            $this->StopRecord = $this->TotalRecords;
        } else { // Export one page only
            $this->setupStartRecord(); // Set up start record position
            // Set the last record to display
            if ($this->DisplayRecords <= 0) {
                $this->StopRecord = $this->TotalRecords;
            } else {
                $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
            }
        }
        $rs = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords);
        $this->ExportDoc = GetExportDocument($this, "h");
        $doc = &$this->ExportDoc;
        if (!$doc) {
            $this->setFailureMessage($Language->phrase("ExportClassNotFound")); // Export class not found
        }
        if (!$rs || !$doc) {
            RemoveHeader("Content-Type"); // Remove header
            RemoveHeader("Content-Disposition");
            $this->showMessage();
            return;
        }
        $this->StartRecord = 1;
        $this->StopRecord = $this->DisplayRecords <= 0 ? $this->TotalRecords : $this->DisplayRecords;

        // Call Page Exporting server event
        $this->ExportDoc->ExportCustom = !$this->pageExporting();
        $header = $this->PageHeader;
        $this->pageDataRendering($header);
        $doc->Text .= $header;
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "");
        $footer = $this->PageFooter;
        $this->pageDataRendered($footer);
        $doc->Text .= $footer;

        // Close recordset
        $rs->close();

        // Call Page Exported server event
        $this->pageExported();

        // Export header and footer
        $doc->exportHeaderAndFooter();

        // Clean output buffer (without destroying output buffer)
        $buffer = ob_get_contents(); // Save the output buffer
        if (!Config("DEBUG") && $buffer) {
            ob_clean();
        }

        // Write debug message if enabled
        if (Config("DEBUG") && !$this->isExport("pdf")) {
            echo GetDebugMessage();
        }

        // Output data
        if ($this->isExport("email")) {
            if ($return) {
                return $doc->Text; // Return email content
            } else {
                echo $this->exportEmail($doc->Text); // Send email
            }
        } else {
            $doc->export();
            if ($return) {
                RemoveHeader("Content-Type"); // Remove header
                RemoveHeader("Content-Disposition");
                $content = ob_get_contents();
                if ($content) {
                    ob_clean();
                }
                if ($buffer) {
                    echo $buffer; // Resume the output buffer
                }
                return $content;
            }
        }
    }

    // Export email
    protected function exportEmail($emailContent)
    {
        global $TempImages, $Language;
        $sender = Post("sender", "");
        $recipient = Post("recipient", "");
        $cc = Post("cc", "");
        $bcc = Post("bcc", "");

        // Subject
        $subject = Post("subject", "");
        $emailSubject = $subject;

        // Message
        $content = Post("message", "");
        $emailMessage = $content;

        // Check sender
        if ($sender == "") {
            return "<p class=\"text-danger\">" . str_replace("%s", $Language->phrase("Sender"), $Language->phrase("EnterRequiredField")) . "</p>";
        }
        if (!CheckEmail($sender)) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperSenderEmail") . "</p>";
        }

        // Check recipient
        if ($recipient == "") {
            return "<p class=\"text-danger\">" . str_replace("%s", $Language->phrase("Recipient"), $Language->phrase("EnterRequiredField")) . "</p>";
        }
        if (!CheckEmailList($recipient, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperRecipientEmail") . "</p>";
        }

        // Check cc
        if (!CheckEmailList($cc, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperCcEmail") . "</p>";
        }

        // Check bcc
        if (!CheckEmailList($bcc, Config("MAX_EMAIL_RECIPIENT"))) {
            return "<p class=\"text-danger\">" . $Language->phrase("EnterProperBccEmail") . "</p>";
        }

        // Check email sent count
        $_SESSION[Config("EXPORT_EMAIL_COUNTER")] = Session(Config("EXPORT_EMAIL_COUNTER")) ?? 0;
        if ((int)Session(Config("EXPORT_EMAIL_COUNTER")) > Config("MAX_EMAIL_SENT_COUNT")) {
            return "<p class=\"text-danger\">" . $Language->phrase("ExceedMaxEmailExport") . "</p>";
        }

        // Send email
        $email = new Email();
        $email->Sender = $sender; // Sender
        $email->Recipient = $recipient; // Recipient
        $email->Cc = $cc; // Cc
        $email->Bcc = $bcc; // Bcc
        $email->Subject = $emailSubject; // Subject
        $email->Format = "html";
        if ($emailMessage != "") {
            $emailMessage = RemoveXss($emailMessage) . "<br><br>";
        }
        foreach ($TempImages as $tmpImage) {
            $email->addEmbeddedImage($tmpImage);
        }
        $email->Content = $emailMessage . CleanEmailContent($emailContent); // Content
        $eventArgs = [];
        if ($this->Recordset) {
            $eventArgs["rs"] = &$this->Recordset;
        }
        $emailSent = false;
        if ($this->emailSending($email, $eventArgs)) {
            $emailSent = $email->send();
        }

        // Check email sent status
        if ($emailSent) {
            // Update email sent count
            $_SESSION[Config("EXPORT_EMAIL_COUNTER")]++;

            // Sent email success
            return "<p class=\"text-success\">" . $Language->phrase("SendEmailSuccess") . "</p>"; // Set up success message
        } else {
            // Sent email failure
            return "<p class=\"text-danger\">" . $email->SendErrDescription . "</p>";
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
        $Breadcrumb->add("list", $this->TableVar, $url, "", $this->TableVar, true);
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

    // ListOptions Load event
    public function listOptionsLoad()
    {
        // Example:
        //$opt = &$this->ListOptions->Add("new");
        //$opt->Header = "xxx";
        //$opt->OnLeft = true; // Link on left
        //$opt->MoveTo(0); // Move to first column
    }

    // ListOptions Rendering event
    public function listOptionsRendering()
    {
        //Container("DetailTableGrid")->DetailAdd = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailEdit = (...condition...); // Set to true or false conditionally
        //Container("DetailTableGrid")->DetailView = (...condition...); // Set to true or false conditionally
    }

    // ListOptions Rendered event
    public function listOptionsRendered()
    {
        // Example:
        //$this->ListOptions["new"]->Body = "xxx";
    }

    // Row Custom Action event
    public function rowCustomAction($action, $row)
    {
        // Return false to abort
        return true;
    }

    // Page Exporting event
    // $this->ExportDoc = export document object
    public function pageExporting()
    {
        //$this->ExportDoc->Text = "my header"; // Export header
        //return false; // Return false to skip default export and use Row_Export event
        return true; // Return true to use default export and skip Row_Export event
    }

    // Row Export event
    // $this->ExportDoc = export document object
    public function rowExport($rs)
    {
        //$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
    }

    // Page Exported event
    // $this->ExportDoc = export document object
    public function pageExported()
    {
        //$this->ExportDoc->Text .= "my footer"; // Export footer
        //Log($this->ExportDoc->Text);
    }

    // Page Importing event
    public function pageImporting($reader, &$options)
    {
        //var_dump($reader); // Import data reader
        //var_dump($options); // Show all options for importing
        //return false; // Return false to skip import
        return true;
    }

    // Row Import event
    public function rowImport(&$row, $cnt)
    {
        //Log($cnt); // Import record count
        //var_dump($row); // Import row
        //return false; // Return false to skip import
        return true;
    }

    // Page Imported event
    public function pageImported($reader, $results)
    {
        //var_dump($reader); // Import data reader
        //var_dump($results); // Import results
    }
}
