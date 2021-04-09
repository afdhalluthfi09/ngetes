<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class ResNilaiPemasaranonlineList extends ResNilaiPemasaranonline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'res_nilai_pemasaranonline';

    // Page object name
    public $PageObjName = "ResNilaiPemasaranonlineList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fres_nilai_pemasaranonlinelist";
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

        // Table object (res_nilai_pemasaranonline)
        if (!isset($GLOBALS["res_nilai_pemasaranonline"]) || get_class($GLOBALS["res_nilai_pemasaranonline"]) == PROJECT_NAMESPACE . "res_nilai_pemasaranonline") {
            $GLOBALS["res_nilai_pemasaranonline"] = &$this;
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
        $this->AddUrl = "resnilaipemasaranonlineadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "resnilaipemasaranonlinedelete";
        $this->MultiUpdateUrl = "resnilaipemasaranonlineupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'res_nilai_pemasaranonline');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fres_nilai_pemasaranonlinelistsrch";

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
                $doc = new $class(Container("res_nilai_pemasaranonline"));
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
            $savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fres_nilai_pemasaranonlinelistsrch");
        }
        $filterList = Concat($filterList, $this->nik->AdvancedSearch->toJson(), ","); // Field nik
        $filterList = Concat($filterList, $this->chatting->AdvancedSearch->toJson(), ","); // Field chatting
        $filterList = Concat($filterList, $this->skor_chatting->AdvancedSearch->toJson(), ","); // Field skor_chatting
        $filterList = Concat($filterList, $this->max_chatting->AdvancedSearch->toJson(), ","); // Field max_chatting
        $filterList = Concat($filterList, $this->medsos->AdvancedSearch->toJson(), ","); // Field medsos
        $filterList = Concat($filterList, $this->skor_medsos->AdvancedSearch->toJson(), ","); // Field skor_medsos
        $filterList = Concat($filterList, $this->max_medsos->AdvancedSearch->toJson(), ","); // Field max_medsos
        $filterList = Concat($filterList, $this->marketplace->AdvancedSearch->toJson(), ","); // Field marketplace
        $filterList = Concat($filterList, $this->skor_mp->AdvancedSearch->toJson(), ","); // Field skor_mp
        $filterList = Concat($filterList, $this->max_mp->AdvancedSearch->toJson(), ","); // Field max_mp
        $filterList = Concat($filterList, $this->gmb->AdvancedSearch->toJson(), ","); // Field gmb
        $filterList = Concat($filterList, $this->skor_gmb->AdvancedSearch->toJson(), ","); // Field skor_gmb
        $filterList = Concat($filterList, $this->max_gmb->AdvancedSearch->toJson(), ","); // Field max_gmb
        $filterList = Concat($filterList, $this->web->AdvancedSearch->toJson(), ","); // Field web
        $filterList = Concat($filterList, $this->skor_web->AdvancedSearch->toJson(), ","); // Field skor_web
        $filterList = Concat($filterList, $this->max_web->AdvancedSearch->toJson(), ","); // Field max_web
        $filterList = Concat($filterList, $this->updatemedsos->AdvancedSearch->toJson(), ","); // Field updatemedsos
        $filterList = Concat($filterList, $this->skor_updatemedsos->AdvancedSearch->toJson(), ","); // Field skor_updatemedsos
        $filterList = Concat($filterList, $this->max_updatemedsos->AdvancedSearch->toJson(), ","); // Field max_updatemedsos
        $filterList = Concat($filterList, $this->updateweb->AdvancedSearch->toJson(), ","); // Field updateweb
        $filterList = Concat($filterList, $this->skor_updateweb->AdvancedSearch->toJson(), ","); // Field skor_updateweb
        $filterList = Concat($filterList, $this->max_updateweb->AdvancedSearch->toJson(), ","); // Field max_updateweb
        $filterList = Concat($filterList, $this->seo->AdvancedSearch->toJson(), ","); // Field seo
        $filterList = Concat($filterList, $this->skor_seo->AdvancedSearch->toJson(), ","); // Field skor_seo
        $filterList = Concat($filterList, $this->max_seo->AdvancedSearch->toJson(), ","); // Field max_seo
        $filterList = Concat($filterList, $this->iklan->AdvancedSearch->toJson(), ","); // Field iklan
        $filterList = Concat($filterList, $this->skor_iklan->AdvancedSearch->toJson(), ","); // Field skor_iklan
        $filterList = Concat($filterList, $this->max_iklan->AdvancedSearch->toJson(), ","); // Field max_iklan
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fres_nilai_pemasaranonlinelistsrch", $filters);
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

        // Field chatting
        $this->chatting->AdvancedSearch->SearchValue = @$filter["x_chatting"];
        $this->chatting->AdvancedSearch->SearchOperator = @$filter["z_chatting"];
        $this->chatting->AdvancedSearch->SearchCondition = @$filter["v_chatting"];
        $this->chatting->AdvancedSearch->SearchValue2 = @$filter["y_chatting"];
        $this->chatting->AdvancedSearch->SearchOperator2 = @$filter["w_chatting"];
        $this->chatting->AdvancedSearch->save();

        // Field skor_chatting
        $this->skor_chatting->AdvancedSearch->SearchValue = @$filter["x_skor_chatting"];
        $this->skor_chatting->AdvancedSearch->SearchOperator = @$filter["z_skor_chatting"];
        $this->skor_chatting->AdvancedSearch->SearchCondition = @$filter["v_skor_chatting"];
        $this->skor_chatting->AdvancedSearch->SearchValue2 = @$filter["y_skor_chatting"];
        $this->skor_chatting->AdvancedSearch->SearchOperator2 = @$filter["w_skor_chatting"];
        $this->skor_chatting->AdvancedSearch->save();

        // Field max_chatting
        $this->max_chatting->AdvancedSearch->SearchValue = @$filter["x_max_chatting"];
        $this->max_chatting->AdvancedSearch->SearchOperator = @$filter["z_max_chatting"];
        $this->max_chatting->AdvancedSearch->SearchCondition = @$filter["v_max_chatting"];
        $this->max_chatting->AdvancedSearch->SearchValue2 = @$filter["y_max_chatting"];
        $this->max_chatting->AdvancedSearch->SearchOperator2 = @$filter["w_max_chatting"];
        $this->max_chatting->AdvancedSearch->save();

        // Field medsos
        $this->medsos->AdvancedSearch->SearchValue = @$filter["x_medsos"];
        $this->medsos->AdvancedSearch->SearchOperator = @$filter["z_medsos"];
        $this->medsos->AdvancedSearch->SearchCondition = @$filter["v_medsos"];
        $this->medsos->AdvancedSearch->SearchValue2 = @$filter["y_medsos"];
        $this->medsos->AdvancedSearch->SearchOperator2 = @$filter["w_medsos"];
        $this->medsos->AdvancedSearch->save();

        // Field skor_medsos
        $this->skor_medsos->AdvancedSearch->SearchValue = @$filter["x_skor_medsos"];
        $this->skor_medsos->AdvancedSearch->SearchOperator = @$filter["z_skor_medsos"];
        $this->skor_medsos->AdvancedSearch->SearchCondition = @$filter["v_skor_medsos"];
        $this->skor_medsos->AdvancedSearch->SearchValue2 = @$filter["y_skor_medsos"];
        $this->skor_medsos->AdvancedSearch->SearchOperator2 = @$filter["w_skor_medsos"];
        $this->skor_medsos->AdvancedSearch->save();

        // Field max_medsos
        $this->max_medsos->AdvancedSearch->SearchValue = @$filter["x_max_medsos"];
        $this->max_medsos->AdvancedSearch->SearchOperator = @$filter["z_max_medsos"];
        $this->max_medsos->AdvancedSearch->SearchCondition = @$filter["v_max_medsos"];
        $this->max_medsos->AdvancedSearch->SearchValue2 = @$filter["y_max_medsos"];
        $this->max_medsos->AdvancedSearch->SearchOperator2 = @$filter["w_max_medsos"];
        $this->max_medsos->AdvancedSearch->save();

        // Field marketplace
        $this->marketplace->AdvancedSearch->SearchValue = @$filter["x_marketplace"];
        $this->marketplace->AdvancedSearch->SearchOperator = @$filter["z_marketplace"];
        $this->marketplace->AdvancedSearch->SearchCondition = @$filter["v_marketplace"];
        $this->marketplace->AdvancedSearch->SearchValue2 = @$filter["y_marketplace"];
        $this->marketplace->AdvancedSearch->SearchOperator2 = @$filter["w_marketplace"];
        $this->marketplace->AdvancedSearch->save();

        // Field skor_mp
        $this->skor_mp->AdvancedSearch->SearchValue = @$filter["x_skor_mp"];
        $this->skor_mp->AdvancedSearch->SearchOperator = @$filter["z_skor_mp"];
        $this->skor_mp->AdvancedSearch->SearchCondition = @$filter["v_skor_mp"];
        $this->skor_mp->AdvancedSearch->SearchValue2 = @$filter["y_skor_mp"];
        $this->skor_mp->AdvancedSearch->SearchOperator2 = @$filter["w_skor_mp"];
        $this->skor_mp->AdvancedSearch->save();

        // Field max_mp
        $this->max_mp->AdvancedSearch->SearchValue = @$filter["x_max_mp"];
        $this->max_mp->AdvancedSearch->SearchOperator = @$filter["z_max_mp"];
        $this->max_mp->AdvancedSearch->SearchCondition = @$filter["v_max_mp"];
        $this->max_mp->AdvancedSearch->SearchValue2 = @$filter["y_max_mp"];
        $this->max_mp->AdvancedSearch->SearchOperator2 = @$filter["w_max_mp"];
        $this->max_mp->AdvancedSearch->save();

        // Field gmb
        $this->gmb->AdvancedSearch->SearchValue = @$filter["x_gmb"];
        $this->gmb->AdvancedSearch->SearchOperator = @$filter["z_gmb"];
        $this->gmb->AdvancedSearch->SearchCondition = @$filter["v_gmb"];
        $this->gmb->AdvancedSearch->SearchValue2 = @$filter["y_gmb"];
        $this->gmb->AdvancedSearch->SearchOperator2 = @$filter["w_gmb"];
        $this->gmb->AdvancedSearch->save();

        // Field skor_gmb
        $this->skor_gmb->AdvancedSearch->SearchValue = @$filter["x_skor_gmb"];
        $this->skor_gmb->AdvancedSearch->SearchOperator = @$filter["z_skor_gmb"];
        $this->skor_gmb->AdvancedSearch->SearchCondition = @$filter["v_skor_gmb"];
        $this->skor_gmb->AdvancedSearch->SearchValue2 = @$filter["y_skor_gmb"];
        $this->skor_gmb->AdvancedSearch->SearchOperator2 = @$filter["w_skor_gmb"];
        $this->skor_gmb->AdvancedSearch->save();

        // Field max_gmb
        $this->max_gmb->AdvancedSearch->SearchValue = @$filter["x_max_gmb"];
        $this->max_gmb->AdvancedSearch->SearchOperator = @$filter["z_max_gmb"];
        $this->max_gmb->AdvancedSearch->SearchCondition = @$filter["v_max_gmb"];
        $this->max_gmb->AdvancedSearch->SearchValue2 = @$filter["y_max_gmb"];
        $this->max_gmb->AdvancedSearch->SearchOperator2 = @$filter["w_max_gmb"];
        $this->max_gmb->AdvancedSearch->save();

        // Field web
        $this->web->AdvancedSearch->SearchValue = @$filter["x_web"];
        $this->web->AdvancedSearch->SearchOperator = @$filter["z_web"];
        $this->web->AdvancedSearch->SearchCondition = @$filter["v_web"];
        $this->web->AdvancedSearch->SearchValue2 = @$filter["y_web"];
        $this->web->AdvancedSearch->SearchOperator2 = @$filter["w_web"];
        $this->web->AdvancedSearch->save();

        // Field skor_web
        $this->skor_web->AdvancedSearch->SearchValue = @$filter["x_skor_web"];
        $this->skor_web->AdvancedSearch->SearchOperator = @$filter["z_skor_web"];
        $this->skor_web->AdvancedSearch->SearchCondition = @$filter["v_skor_web"];
        $this->skor_web->AdvancedSearch->SearchValue2 = @$filter["y_skor_web"];
        $this->skor_web->AdvancedSearch->SearchOperator2 = @$filter["w_skor_web"];
        $this->skor_web->AdvancedSearch->save();

        // Field max_web
        $this->max_web->AdvancedSearch->SearchValue = @$filter["x_max_web"];
        $this->max_web->AdvancedSearch->SearchOperator = @$filter["z_max_web"];
        $this->max_web->AdvancedSearch->SearchCondition = @$filter["v_max_web"];
        $this->max_web->AdvancedSearch->SearchValue2 = @$filter["y_max_web"];
        $this->max_web->AdvancedSearch->SearchOperator2 = @$filter["w_max_web"];
        $this->max_web->AdvancedSearch->save();

        // Field updatemedsos
        $this->updatemedsos->AdvancedSearch->SearchValue = @$filter["x_updatemedsos"];
        $this->updatemedsos->AdvancedSearch->SearchOperator = @$filter["z_updatemedsos"];
        $this->updatemedsos->AdvancedSearch->SearchCondition = @$filter["v_updatemedsos"];
        $this->updatemedsos->AdvancedSearch->SearchValue2 = @$filter["y_updatemedsos"];
        $this->updatemedsos->AdvancedSearch->SearchOperator2 = @$filter["w_updatemedsos"];
        $this->updatemedsos->AdvancedSearch->save();

        // Field skor_updatemedsos
        $this->skor_updatemedsos->AdvancedSearch->SearchValue = @$filter["x_skor_updatemedsos"];
        $this->skor_updatemedsos->AdvancedSearch->SearchOperator = @$filter["z_skor_updatemedsos"];
        $this->skor_updatemedsos->AdvancedSearch->SearchCondition = @$filter["v_skor_updatemedsos"];
        $this->skor_updatemedsos->AdvancedSearch->SearchValue2 = @$filter["y_skor_updatemedsos"];
        $this->skor_updatemedsos->AdvancedSearch->SearchOperator2 = @$filter["w_skor_updatemedsos"];
        $this->skor_updatemedsos->AdvancedSearch->save();

        // Field max_updatemedsos
        $this->max_updatemedsos->AdvancedSearch->SearchValue = @$filter["x_max_updatemedsos"];
        $this->max_updatemedsos->AdvancedSearch->SearchOperator = @$filter["z_max_updatemedsos"];
        $this->max_updatemedsos->AdvancedSearch->SearchCondition = @$filter["v_max_updatemedsos"];
        $this->max_updatemedsos->AdvancedSearch->SearchValue2 = @$filter["y_max_updatemedsos"];
        $this->max_updatemedsos->AdvancedSearch->SearchOperator2 = @$filter["w_max_updatemedsos"];
        $this->max_updatemedsos->AdvancedSearch->save();

        // Field updateweb
        $this->updateweb->AdvancedSearch->SearchValue = @$filter["x_updateweb"];
        $this->updateweb->AdvancedSearch->SearchOperator = @$filter["z_updateweb"];
        $this->updateweb->AdvancedSearch->SearchCondition = @$filter["v_updateweb"];
        $this->updateweb->AdvancedSearch->SearchValue2 = @$filter["y_updateweb"];
        $this->updateweb->AdvancedSearch->SearchOperator2 = @$filter["w_updateweb"];
        $this->updateweb->AdvancedSearch->save();

        // Field skor_updateweb
        $this->skor_updateweb->AdvancedSearch->SearchValue = @$filter["x_skor_updateweb"];
        $this->skor_updateweb->AdvancedSearch->SearchOperator = @$filter["z_skor_updateweb"];
        $this->skor_updateweb->AdvancedSearch->SearchCondition = @$filter["v_skor_updateweb"];
        $this->skor_updateweb->AdvancedSearch->SearchValue2 = @$filter["y_skor_updateweb"];
        $this->skor_updateweb->AdvancedSearch->SearchOperator2 = @$filter["w_skor_updateweb"];
        $this->skor_updateweb->AdvancedSearch->save();

        // Field max_updateweb
        $this->max_updateweb->AdvancedSearch->SearchValue = @$filter["x_max_updateweb"];
        $this->max_updateweb->AdvancedSearch->SearchOperator = @$filter["z_max_updateweb"];
        $this->max_updateweb->AdvancedSearch->SearchCondition = @$filter["v_max_updateweb"];
        $this->max_updateweb->AdvancedSearch->SearchValue2 = @$filter["y_max_updateweb"];
        $this->max_updateweb->AdvancedSearch->SearchOperator2 = @$filter["w_max_updateweb"];
        $this->max_updateweb->AdvancedSearch->save();

        // Field seo
        $this->seo->AdvancedSearch->SearchValue = @$filter["x_seo"];
        $this->seo->AdvancedSearch->SearchOperator = @$filter["z_seo"];
        $this->seo->AdvancedSearch->SearchCondition = @$filter["v_seo"];
        $this->seo->AdvancedSearch->SearchValue2 = @$filter["y_seo"];
        $this->seo->AdvancedSearch->SearchOperator2 = @$filter["w_seo"];
        $this->seo->AdvancedSearch->save();

        // Field skor_seo
        $this->skor_seo->AdvancedSearch->SearchValue = @$filter["x_skor_seo"];
        $this->skor_seo->AdvancedSearch->SearchOperator = @$filter["z_skor_seo"];
        $this->skor_seo->AdvancedSearch->SearchCondition = @$filter["v_skor_seo"];
        $this->skor_seo->AdvancedSearch->SearchValue2 = @$filter["y_skor_seo"];
        $this->skor_seo->AdvancedSearch->SearchOperator2 = @$filter["w_skor_seo"];
        $this->skor_seo->AdvancedSearch->save();

        // Field max_seo
        $this->max_seo->AdvancedSearch->SearchValue = @$filter["x_max_seo"];
        $this->max_seo->AdvancedSearch->SearchOperator = @$filter["z_max_seo"];
        $this->max_seo->AdvancedSearch->SearchCondition = @$filter["v_max_seo"];
        $this->max_seo->AdvancedSearch->SearchValue2 = @$filter["y_max_seo"];
        $this->max_seo->AdvancedSearch->SearchOperator2 = @$filter["w_max_seo"];
        $this->max_seo->AdvancedSearch->save();

        // Field iklan
        $this->iklan->AdvancedSearch->SearchValue = @$filter["x_iklan"];
        $this->iklan->AdvancedSearch->SearchOperator = @$filter["z_iklan"];
        $this->iklan->AdvancedSearch->SearchCondition = @$filter["v_iklan"];
        $this->iklan->AdvancedSearch->SearchValue2 = @$filter["y_iklan"];
        $this->iklan->AdvancedSearch->SearchOperator2 = @$filter["w_iklan"];
        $this->iklan->AdvancedSearch->save();

        // Field skor_iklan
        $this->skor_iklan->AdvancedSearch->SearchValue = @$filter["x_skor_iklan"];
        $this->skor_iklan->AdvancedSearch->SearchOperator = @$filter["z_skor_iklan"];
        $this->skor_iklan->AdvancedSearch->SearchCondition = @$filter["v_skor_iklan"];
        $this->skor_iklan->AdvancedSearch->SearchValue2 = @$filter["y_skor_iklan"];
        $this->skor_iklan->AdvancedSearch->SearchOperator2 = @$filter["w_skor_iklan"];
        $this->skor_iklan->AdvancedSearch->save();

        // Field max_iklan
        $this->max_iklan->AdvancedSearch->SearchValue = @$filter["x_max_iklan"];
        $this->max_iklan->AdvancedSearch->SearchOperator = @$filter["z_max_iklan"];
        $this->max_iklan->AdvancedSearch->SearchCondition = @$filter["v_max_iklan"];
        $this->max_iklan->AdvancedSearch->SearchValue2 = @$filter["y_max_iklan"];
        $this->max_iklan->AdvancedSearch->SearchOperator2 = @$filter["w_max_iklan"];
        $this->max_iklan->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->nik, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->chatting, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->medsos, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->marketplace, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->gmb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->web, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->updatemedsos, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->updateweb, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->seo, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->iklan, $arKeywords, $type);
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
            $this->updateSort($this->chatting); // chatting
            $this->updateSort($this->skor_chatting); // skor_chatting
            $this->updateSort($this->max_chatting); // max_chatting
            $this->updateSort($this->medsos); // medsos
            $this->updateSort($this->skor_medsos); // skor_medsos
            $this->updateSort($this->max_medsos); // max_medsos
            $this->updateSort($this->marketplace); // marketplace
            $this->updateSort($this->skor_mp); // skor_mp
            $this->updateSort($this->max_mp); // max_mp
            $this->updateSort($this->gmb); // gmb
            $this->updateSort($this->skor_gmb); // skor_gmb
            $this->updateSort($this->max_gmb); // max_gmb
            $this->updateSort($this->web); // web
            $this->updateSort($this->skor_web); // skor_web
            $this->updateSort($this->max_web); // max_web
            $this->updateSort($this->updatemedsos); // updatemedsos
            $this->updateSort($this->skor_updatemedsos); // skor_updatemedsos
            $this->updateSort($this->max_updatemedsos); // max_updatemedsos
            $this->updateSort($this->updateweb); // updateweb
            $this->updateSort($this->skor_updateweb); // skor_updateweb
            $this->updateSort($this->max_updateweb); // max_updateweb
            $this->updateSort($this->seo); // seo
            $this->updateSort($this->skor_seo); // skor_seo
            $this->updateSort($this->max_seo); // max_seo
            $this->updateSort($this->iklan); // iklan
            $this->updateSort($this->skor_iklan); // skor_iklan
            $this->updateSort($this->max_iklan); // max_iklan
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
                $this->chatting->setSort("");
                $this->skor_chatting->setSort("");
                $this->max_chatting->setSort("");
                $this->medsos->setSort("");
                $this->skor_medsos->setSort("");
                $this->max_medsos->setSort("");
                $this->marketplace->setSort("");
                $this->skor_mp->setSort("");
                $this->max_mp->setSort("");
                $this->gmb->setSort("");
                $this->skor_gmb->setSort("");
                $this->max_gmb->setSort("");
                $this->web->setSort("");
                $this->skor_web->setSort("");
                $this->max_web->setSort("");
                $this->updatemedsos->setSort("");
                $this->skor_updatemedsos->setSort("");
                $this->max_updatemedsos->setSort("");
                $this->updateweb->setSort("");
                $this->skor_updateweb->setSort("");
                $this->max_updateweb->setSort("");
                $this->seo->setSort("");
                $this->skor_seo->setSort("");
                $this->max_seo->setSort("");
                $this->iklan->setSort("");
                $this->skor_iklan->setSort("");
                $this->max_iklan->setSort("");
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->nik->CurrentValue) . "\" onclick=\"ew.clickMultiCheckbox(event);\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fres_nilai_pemasaranonlinelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fres_nilai_pemasaranonlinelistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fres_nilai_pemasaranonlinelist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['chatting'] = null;
        $row['skor_chatting'] = null;
        $row['max_chatting'] = null;
        $row['medsos'] = null;
        $row['skor_medsos'] = null;
        $row['max_medsos'] = null;
        $row['marketplace'] = null;
        $row['skor_mp'] = null;
        $row['max_mp'] = null;
        $row['gmb'] = null;
        $row['skor_gmb'] = null;
        $row['max_gmb'] = null;
        $row['web'] = null;
        $row['skor_web'] = null;
        $row['max_web'] = null;
        $row['updatemedsos'] = null;
        $row['skor_updatemedsos'] = null;
        $row['max_updatemedsos'] = null;
        $row['updateweb'] = null;
        $row['skor_updateweb'] = null;
        $row['max_updateweb'] = null;
        $row['seo'] = null;
        $row['skor_seo'] = null;
        $row['max_seo'] = null;
        $row['iklan'] = null;
        $row['skor_iklan'] = null;
        $row['max_iklan'] = null;
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

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
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fres_nilai_pemasaranonlinelist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fres_nilai_pemasaranonlinelist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fres_nilai_pemasaranonlinelist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_res_nilai_pemasaranonline" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_res_nilai_pemasaranonline\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fres_nilai_pemasaranonlinelist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fres_nilai_pemasaranonlinelistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
