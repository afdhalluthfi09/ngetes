<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class KumkmMarketList extends KumkmMarket
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'kumkm_market';

    // Page object name
    public $PageObjName = "KumkmMarketList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fkumkm_marketlist";
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

        // Table object (kumkm_market)
        if (!isset($GLOBALS["kumkm_market"]) || get_class($GLOBALS["kumkm_market"]) == PROJECT_NAMESPACE . "kumkm_market") {
            $GLOBALS["kumkm_market"] = &$this;
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
        $this->AddUrl = "kumkmmarketadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "kumkmmarketdelete";
        $this->MultiUpdateUrl = "kumkmmarketupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'kumkm_market');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fkumkm_marketlistsrch";

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
                $doc = new $class(Container("kumkm_market"));
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
        if ($this->isAddOrEdit()) {
            $this->nik_ukm->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->kurasi->Visible = false;
        }
        if ($this->isAddOrEdit()) {
            $this->waktu_entry->Visible = false;
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
    public $PageSizes = "20"; // Page sizes (comma separated)
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
    public $MultiColumnClass = "col-sm-2";
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->id->Visible = false;
        $this->produk_foto->setVisibility();
        $this->nik_ukm->Visible = false;
        $this->produk_nama->setVisibility();
        $this->produk_jenis->setVisibility();
        $this->produk_desc->Visible = false;
        $this->produk_harga->setVisibility();
        $this->kurasi->setVisibility();
        $this->waktu_entry->Visible = false;
        $this->waktu_kurasi->Visible = false;
        $this->waktu_update->Visible = false;
        $this->editor->Visible = false;
        $this->kurator->Visible = false;
        $this->produk_legal->Visible = false;
        $this->judul_sesuai->setVisibility();
        $this->foto_bagus->setVisibility();
        $this->deskripsi_jelas->setVisibility();
        $this->harga_tidak_kosong->setVisibility();
        $this->berat_tidak_kosong->setVisibility();
        $this->produk_berat->setVisibility();
        $this->produk_panjang->setVisibility();
        $this->produk_lebar->setVisibility();
        $this->produk_tinggi->setVisibility();
        $this->produk_harga_dasar->setVisibility();
        $this->produk_foto_1->setVisibility();
        $this->produk_foto_2->setVisibility();
        $this->produk_foto_3->setVisibility();
        $this->catatan->Visible = false;
        $this->market->setVisibility();
        $this->yia_sku->Visible = false;
        $this->yia_idproduk->Visible = false;
        $this->yia_stok_alert->Visible = false;
        $this->produk_foto_4->Visible = false;
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
            $savedFilterList = $UserProfile->getSearchFilters(CurrentUserName(), "fkumkm_marketlistsrch");
        }
        $filterList = Concat($filterList, $this->produk_foto->AdvancedSearch->toJson(), ","); // Field produk_foto
        $filterList = Concat($filterList, $this->produk_nama->AdvancedSearch->toJson(), ","); // Field produk_nama
        $filterList = Concat($filterList, $this->produk_jenis->AdvancedSearch->toJson(), ","); // Field produk_jenis
        $filterList = Concat($filterList, $this->produk_desc->AdvancedSearch->toJson(), ","); // Field produk_desc
        $filterList = Concat($filterList, $this->produk_harga->AdvancedSearch->toJson(), ","); // Field produk_harga
        $filterList = Concat($filterList, $this->kurator->AdvancedSearch->toJson(), ","); // Field kurator
        $filterList = Concat($filterList, $this->produk_berat->AdvancedSearch->toJson(), ","); // Field produk_berat
        $filterList = Concat($filterList, $this->produk_panjang->AdvancedSearch->toJson(), ","); // Field produk_panjang
        $filterList = Concat($filterList, $this->produk_lebar->AdvancedSearch->toJson(), ","); // Field produk_lebar
        $filterList = Concat($filterList, $this->produk_tinggi->AdvancedSearch->toJson(), ","); // Field produk_tinggi
        $filterList = Concat($filterList, $this->produk_harga_dasar->AdvancedSearch->toJson(), ","); // Field produk_harga_dasar
        $filterList = Concat($filterList, $this->market->AdvancedSearch->toJson(), ","); // Field market
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
            $UserProfile->setSearchFilters(CurrentUserName(), "fkumkm_marketlistsrch", $filters);
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

        // Field produk_foto
        $this->produk_foto->AdvancedSearch->SearchValue = @$filter["x_produk_foto"];
        $this->produk_foto->AdvancedSearch->SearchOperator = @$filter["z_produk_foto"];
        $this->produk_foto->AdvancedSearch->SearchCondition = @$filter["v_produk_foto"];
        $this->produk_foto->AdvancedSearch->SearchValue2 = @$filter["y_produk_foto"];
        $this->produk_foto->AdvancedSearch->SearchOperator2 = @$filter["w_produk_foto"];
        $this->produk_foto->AdvancedSearch->save();

        // Field produk_nama
        $this->produk_nama->AdvancedSearch->SearchValue = @$filter["x_produk_nama"];
        $this->produk_nama->AdvancedSearch->SearchOperator = @$filter["z_produk_nama"];
        $this->produk_nama->AdvancedSearch->SearchCondition = @$filter["v_produk_nama"];
        $this->produk_nama->AdvancedSearch->SearchValue2 = @$filter["y_produk_nama"];
        $this->produk_nama->AdvancedSearch->SearchOperator2 = @$filter["w_produk_nama"];
        $this->produk_nama->AdvancedSearch->save();

        // Field produk_jenis
        $this->produk_jenis->AdvancedSearch->SearchValue = @$filter["x_produk_jenis"];
        $this->produk_jenis->AdvancedSearch->SearchOperator = @$filter["z_produk_jenis"];
        $this->produk_jenis->AdvancedSearch->SearchCondition = @$filter["v_produk_jenis"];
        $this->produk_jenis->AdvancedSearch->SearchValue2 = @$filter["y_produk_jenis"];
        $this->produk_jenis->AdvancedSearch->SearchOperator2 = @$filter["w_produk_jenis"];
        $this->produk_jenis->AdvancedSearch->save();

        // Field produk_desc
        $this->produk_desc->AdvancedSearch->SearchValue = @$filter["x_produk_desc"];
        $this->produk_desc->AdvancedSearch->SearchOperator = @$filter["z_produk_desc"];
        $this->produk_desc->AdvancedSearch->SearchCondition = @$filter["v_produk_desc"];
        $this->produk_desc->AdvancedSearch->SearchValue2 = @$filter["y_produk_desc"];
        $this->produk_desc->AdvancedSearch->SearchOperator2 = @$filter["w_produk_desc"];
        $this->produk_desc->AdvancedSearch->save();

        // Field produk_harga
        $this->produk_harga->AdvancedSearch->SearchValue = @$filter["x_produk_harga"];
        $this->produk_harga->AdvancedSearch->SearchOperator = @$filter["z_produk_harga"];
        $this->produk_harga->AdvancedSearch->SearchCondition = @$filter["v_produk_harga"];
        $this->produk_harga->AdvancedSearch->SearchValue2 = @$filter["y_produk_harga"];
        $this->produk_harga->AdvancedSearch->SearchOperator2 = @$filter["w_produk_harga"];
        $this->produk_harga->AdvancedSearch->save();

        // Field kurator
        $this->kurator->AdvancedSearch->SearchValue = @$filter["x_kurator"];
        $this->kurator->AdvancedSearch->SearchOperator = @$filter["z_kurator"];
        $this->kurator->AdvancedSearch->SearchCondition = @$filter["v_kurator"];
        $this->kurator->AdvancedSearch->SearchValue2 = @$filter["y_kurator"];
        $this->kurator->AdvancedSearch->SearchOperator2 = @$filter["w_kurator"];
        $this->kurator->AdvancedSearch->save();

        // Field produk_berat
        $this->produk_berat->AdvancedSearch->SearchValue = @$filter["x_produk_berat"];
        $this->produk_berat->AdvancedSearch->SearchOperator = @$filter["z_produk_berat"];
        $this->produk_berat->AdvancedSearch->SearchCondition = @$filter["v_produk_berat"];
        $this->produk_berat->AdvancedSearch->SearchValue2 = @$filter["y_produk_berat"];
        $this->produk_berat->AdvancedSearch->SearchOperator2 = @$filter["w_produk_berat"];
        $this->produk_berat->AdvancedSearch->save();

        // Field produk_panjang
        $this->produk_panjang->AdvancedSearch->SearchValue = @$filter["x_produk_panjang"];
        $this->produk_panjang->AdvancedSearch->SearchOperator = @$filter["z_produk_panjang"];
        $this->produk_panjang->AdvancedSearch->SearchCondition = @$filter["v_produk_panjang"];
        $this->produk_panjang->AdvancedSearch->SearchValue2 = @$filter["y_produk_panjang"];
        $this->produk_panjang->AdvancedSearch->SearchOperator2 = @$filter["w_produk_panjang"];
        $this->produk_panjang->AdvancedSearch->save();

        // Field produk_lebar
        $this->produk_lebar->AdvancedSearch->SearchValue = @$filter["x_produk_lebar"];
        $this->produk_lebar->AdvancedSearch->SearchOperator = @$filter["z_produk_lebar"];
        $this->produk_lebar->AdvancedSearch->SearchCondition = @$filter["v_produk_lebar"];
        $this->produk_lebar->AdvancedSearch->SearchValue2 = @$filter["y_produk_lebar"];
        $this->produk_lebar->AdvancedSearch->SearchOperator2 = @$filter["w_produk_lebar"];
        $this->produk_lebar->AdvancedSearch->save();

        // Field produk_tinggi
        $this->produk_tinggi->AdvancedSearch->SearchValue = @$filter["x_produk_tinggi"];
        $this->produk_tinggi->AdvancedSearch->SearchOperator = @$filter["z_produk_tinggi"];
        $this->produk_tinggi->AdvancedSearch->SearchCondition = @$filter["v_produk_tinggi"];
        $this->produk_tinggi->AdvancedSearch->SearchValue2 = @$filter["y_produk_tinggi"];
        $this->produk_tinggi->AdvancedSearch->SearchOperator2 = @$filter["w_produk_tinggi"];
        $this->produk_tinggi->AdvancedSearch->save();

        // Field produk_harga_dasar
        $this->produk_harga_dasar->AdvancedSearch->SearchValue = @$filter["x_produk_harga_dasar"];
        $this->produk_harga_dasar->AdvancedSearch->SearchOperator = @$filter["z_produk_harga_dasar"];
        $this->produk_harga_dasar->AdvancedSearch->SearchCondition = @$filter["v_produk_harga_dasar"];
        $this->produk_harga_dasar->AdvancedSearch->SearchValue2 = @$filter["y_produk_harga_dasar"];
        $this->produk_harga_dasar->AdvancedSearch->SearchOperator2 = @$filter["w_produk_harga_dasar"];
        $this->produk_harga_dasar->AdvancedSearch->save();

        // Field market
        $this->market->AdvancedSearch->SearchValue = @$filter["x_market"];
        $this->market->AdvancedSearch->SearchOperator = @$filter["z_market"];
        $this->market->AdvancedSearch->SearchCondition = @$filter["v_market"];
        $this->market->AdvancedSearch->SearchValue2 = @$filter["y_market"];
        $this->market->AdvancedSearch->SearchOperator2 = @$filter["w_market"];
        $this->market->AdvancedSearch->save();
        $this->BasicSearch->setKeyword(@$filter[Config("TABLE_BASIC_SEARCH")]);
        $this->BasicSearch->setType(@$filter[Config("TABLE_BASIC_SEARCH_TYPE")]);
    }

    // Return basic search SQL
    protected function basicSearchSql($arKeywords, $type)
    {
        $where = "";
        $this->buildBasicSearchSql($where, $this->produk_foto, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_nama, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_jenis, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_desc, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->kurator, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_foto_1, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_foto_2, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->produk_foto_3, $arKeywords, $type);
        $this->buildBasicSearchSql($where, $this->market, $arKeywords, $type);
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
        // Check for Ctrl pressed
        $ctrl = Get("ctrl") !== null;

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->produk_foto, $ctrl); // produk_foto
            $this->updateSort($this->produk_nama, $ctrl); // produk_nama
            $this->updateSort($this->produk_jenis, $ctrl); // produk_jenis
            $this->updateSort($this->produk_harga, $ctrl); // produk_harga
            $this->updateSort($this->kurasi, $ctrl); // kurasi
            $this->updateSort($this->judul_sesuai, $ctrl); // judul_sesuai
            $this->updateSort($this->foto_bagus, $ctrl); // foto_bagus
            $this->updateSort($this->deskripsi_jelas, $ctrl); // deskripsi_jelas
            $this->updateSort($this->harga_tidak_kosong, $ctrl); // harga_tidak_kosong
            $this->updateSort($this->berat_tidak_kosong, $ctrl); // berat_tidak_kosong
            $this->updateSort($this->produk_berat, $ctrl); // produk_berat
            $this->updateSort($this->produk_panjang, $ctrl); // produk_panjang
            $this->updateSort($this->produk_lebar, $ctrl); // produk_lebar
            $this->updateSort($this->produk_tinggi, $ctrl); // produk_tinggi
            $this->updateSort($this->produk_harga_dasar, $ctrl); // produk_harga_dasar
            $this->updateSort($this->produk_foto_1, $ctrl); // produk_foto_1
            $this->updateSort($this->produk_foto_2, $ctrl); // produk_foto_2
            $this->updateSort($this->produk_foto_3, $ctrl); // produk_foto_3
            $this->updateSort($this->market, $ctrl); // market
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
                $this->id->setSort("");
                $this->produk_foto->setSort("");
                $this->nik_ukm->setSort("");
                $this->produk_nama->setSort("");
                $this->produk_jenis->setSort("");
                $this->produk_desc->setSort("");
                $this->produk_harga->setSort("");
                $this->kurasi->setSort("");
                $this->waktu_entry->setSort("");
                $this->waktu_kurasi->setSort("");
                $this->waktu_update->setSort("");
                $this->editor->setSort("");
                $this->kurator->setSort("");
                $this->produk_legal->setSort("");
                $this->judul_sesuai->setSort("");
                $this->foto_bagus->setSort("");
                $this->deskripsi_jelas->setSort("");
                $this->harga_tidak_kosong->setSort("");
                $this->berat_tidak_kosong->setSort("");
                $this->produk_berat->setSort("");
                $this->produk_panjang->setSort("");
                $this->produk_lebar->setSort("");
                $this->produk_tinggi->setSort("");
                $this->produk_harga_dasar->setSort("");
                $this->produk_foto_1->setSort("");
                $this->produk_foto_2->setSort("");
                $this->produk_foto_3->setSort("");
                $this->catatan->setSort("");
                $this->market->setSort("");
                $this->yia_sku->setSort("");
                $this->yia_idproduk->setSort("");
                $this->yia_stok_alert->setSort("");
                $this->produk_foto_4->setSort("");
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

        // "view"
        $item = &$this->ListOptions->add("view");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canView();
        $item->OnLeft = true;

        // "edit"
        $item = &$this->ListOptions->add("edit");
        $item->CssClass = "text-nowrap";
        $item->Visible = $Security->canEdit();
        $item->OnLeft = true;

        // List actions
        $item = &$this->ListOptions->add("listactions");
        $item->CssClass = "text-nowrap";
        $item->OnLeft = true;
        $item->Visible = false;
        $item->ShowInButtonGroup = false;
        $item->ShowInDropDown = false;

        // "checkbox"
        $item = &$this->ListOptions->add("checkbox");
        $item->Visible = $Security->canDelete();
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
        if ($this->CurrentMode == "view") {
            // "view"
            $opt = $this->ListOptions["view"];
            $viewcaption = HtmlTitle($Language->phrase("ViewLink"));
            if ($Security->canView()) {
                $opt->Body = "<a class=\"ew-row-link ew-view\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . HtmlEncode(GetUrl($this->ViewUrl)) . "\">" . $Language->phrase("ViewLink") . "</a>";
            } else {
                $opt->Body = "";
            }

            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body = "<a class=\"ew-row-link ew-edit\" title=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("EditLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("EditLink") . "</a>";
            } else {
                $opt->Body = "";
            }
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->id->CurrentValue) . "\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["addedit"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("AddLink"));
        $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
        $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        $option = $options["action"];

        // Add multi delete
        $item = &$option->add("multidelete");
        $item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fkumkm_marketlist, url:'" . GetUrl($this->MultiDeleteUrl) . "', data:{action:'show'}});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
        $item->Visible = $Security->canDelete();

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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fkumkm_marketlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = true;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fkumkm_marketlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fkumkm_marketlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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

    // Get multi column CSS class for record DIV
    public function getMultiColumnClass()
    {
        if ($this->isGridAdd() || $this->isGridEdit() || $this->isInlineActionRow()) {
            return "p-3 " . $this->MultiColumnEditClass; // Occupy a whole row
        }
        return $this->MultiColumnClass; // Occupy a column only
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
        $this->id->setDbValue($row['id']);
        $this->produk_foto->Upload->DbValue = $row['produk_foto'];
        $this->produk_foto->setDbValue($this->produk_foto->Upload->DbValue);
        $this->nik_ukm->setDbValue($row['nik_ukm']);
        $this->produk_nama->setDbValue($row['produk_nama']);
        $this->produk_jenis->setDbValue($row['produk_jenis']);
        $this->produk_desc->setDbValue($row['produk_desc']);
        $this->produk_harga->setDbValue($row['produk_harga']);
        $this->kurasi->setDbValue($row['kurasi']);
        $this->waktu_entry->setDbValue($row['waktu_entry']);
        $this->waktu_kurasi->setDbValue($row['waktu_kurasi']);
        $this->waktu_update->setDbValue($row['waktu_update']);
        $this->editor->setDbValue($row['editor']);
        $this->kurator->setDbValue($row['kurator']);
        $this->produk_legal->setDbValue($row['produk_legal']);
        $this->judul_sesuai->setDbValue($row['judul_sesuai']);
        $this->foto_bagus->setDbValue($row['foto_bagus']);
        $this->deskripsi_jelas->setDbValue($row['deskripsi_jelas']);
        $this->harga_tidak_kosong->setDbValue($row['harga_tidak_kosong']);
        $this->berat_tidak_kosong->setDbValue($row['berat_tidak_kosong']);
        $this->produk_berat->setDbValue($row['produk_berat']);
        $this->produk_panjang->setDbValue($row['produk_panjang']);
        $this->produk_lebar->setDbValue($row['produk_lebar']);
        $this->produk_tinggi->setDbValue($row['produk_tinggi']);
        $this->produk_harga_dasar->setDbValue($row['produk_harga_dasar']);
        $this->produk_foto_1->Upload->DbValue = $row['produk_foto_1'];
        $this->produk_foto_1->setDbValue($this->produk_foto_1->Upload->DbValue);
        $this->produk_foto_2->Upload->DbValue = $row['produk_foto_2'];
        $this->produk_foto_2->setDbValue($this->produk_foto_2->Upload->DbValue);
        $this->produk_foto_3->Upload->DbValue = $row['produk_foto_3'];
        $this->produk_foto_3->setDbValue($this->produk_foto_3->Upload->DbValue);
        $this->catatan->setDbValue($row['catatan']);
        $this->market->setDbValue($row['market']);
        $this->yia_sku->setDbValue($row['yia_sku']);
        $this->yia_idproduk->setDbValue($row['yia_idproduk']);
        $this->yia_stok_alert->setDbValue($row['yia_stok_alert']);
        $this->produk_foto_4->Upload->DbValue = $row['produk_foto_4'];
        $this->produk_foto_4->setDbValue($this->produk_foto_4->Upload->DbValue);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['id'] = null;
        $row['produk_foto'] = null;
        $row['nik_ukm'] = null;
        $row['produk_nama'] = null;
        $row['produk_jenis'] = null;
        $row['produk_desc'] = null;
        $row['produk_harga'] = null;
        $row['kurasi'] = null;
        $row['waktu_entry'] = null;
        $row['waktu_kurasi'] = null;
        $row['waktu_update'] = null;
        $row['editor'] = null;
        $row['kurator'] = null;
        $row['produk_legal'] = null;
        $row['judul_sesuai'] = null;
        $row['foto_bagus'] = null;
        $row['deskripsi_jelas'] = null;
        $row['harga_tidak_kosong'] = null;
        $row['berat_tidak_kosong'] = null;
        $row['produk_berat'] = null;
        $row['produk_panjang'] = null;
        $row['produk_lebar'] = null;
        $row['produk_tinggi'] = null;
        $row['produk_harga_dasar'] = null;
        $row['produk_foto_1'] = null;
        $row['produk_foto_2'] = null;
        $row['produk_foto_3'] = null;
        $row['catatan'] = null;
        $row['market'] = null;
        $row['yia_sku'] = null;
        $row['yia_idproduk'] = null;
        $row['yia_stok_alert'] = null;
        $row['produk_foto_4'] = null;
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
        if ($this->produk_harga->FormValue == $this->produk_harga->CurrentValue && is_numeric(ConvertToFloatString($this->produk_harga->CurrentValue))) {
            $this->produk_harga->CurrentValue = ConvertToFloatString($this->produk_harga->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_berat->FormValue == $this->produk_berat->CurrentValue && is_numeric(ConvertToFloatString($this->produk_berat->CurrentValue))) {
            $this->produk_berat->CurrentValue = ConvertToFloatString($this->produk_berat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_panjang->FormValue == $this->produk_panjang->CurrentValue && is_numeric(ConvertToFloatString($this->produk_panjang->CurrentValue))) {
            $this->produk_panjang->CurrentValue = ConvertToFloatString($this->produk_panjang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_lebar->FormValue == $this->produk_lebar->CurrentValue && is_numeric(ConvertToFloatString($this->produk_lebar->CurrentValue))) {
            $this->produk_lebar->CurrentValue = ConvertToFloatString($this->produk_lebar->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_tinggi->FormValue == $this->produk_tinggi->CurrentValue && is_numeric(ConvertToFloatString($this->produk_tinggi->CurrentValue))) {
            $this->produk_tinggi->CurrentValue = ConvertToFloatString($this->produk_tinggi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->produk_harga_dasar->FormValue == $this->produk_harga_dasar->CurrentValue && is_numeric(ConvertToFloatString($this->produk_harga_dasar->CurrentValue))) {
            $this->produk_harga_dasar->CurrentValue = ConvertToFloatString($this->produk_harga_dasar->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // produk_foto

        // nik_ukm
        $this->nik_ukm->CellCssStyle = "white-space: nowrap;";

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // kurasi
        $this->kurasi->CellCssStyle = "white-space: nowrap;";

        // waktu_entry
        $this->waktu_entry->CellCssStyle = "white-space: nowrap;";

        // waktu_kurasi
        $this->waktu_kurasi->CellCssStyle = "white-space: nowrap;";

        // waktu_update
        $this->waktu_update->CellCssStyle = "white-space: nowrap;";

        // editor
        $this->editor->CellCssStyle = "white-space: nowrap;";

        // kurator

        // produk_legal
        $this->produk_legal->CellCssStyle = "white-space: nowrap;";

        // judul_sesuai
        $this->judul_sesuai->CellCssStyle = "white-space: nowrap;";

        // foto_bagus
        $this->foto_bagus->CellCssStyle = "white-space: nowrap;";

        // deskripsi_jelas
        $this->deskripsi_jelas->CellCssStyle = "white-space: nowrap;";

        // harga_tidak_kosong
        $this->harga_tidak_kosong->CellCssStyle = "white-space: nowrap;";

        // berat_tidak_kosong
        $this->berat_tidak_kosong->CellCssStyle = "white-space: nowrap;";

        // produk_berat

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // produk_harga_dasar

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // catatan
        $this->catatan->CellCssStyle = "white-space: nowrap;";

        // market

        // yia_sku
        $this->yia_sku->CellCssStyle = "white-space: nowrap;";

        // yia_idproduk
        $this->yia_idproduk->CellCssStyle = "white-space: nowrap;";

        // yia_stok_alert
        $this->yia_stok_alert->CellCssStyle = "white-space: nowrap;";

        // produk_foto_4
        $this->produk_foto_4->CellCssStyle = "white-space: nowrap;";
        if ($this->RowType == ROWTYPE_VIEW) {
            // produk_foto
            if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
                $this->produk_foto->ViewValue = $this->produk_foto->Upload->DbValue;
            } else {
                $this->produk_foto->ViewValue = "";
            }
            $this->produk_foto->ViewCustomAttributes = "";

            // produk_nama
            $this->produk_nama->ViewValue = $this->produk_nama->CurrentValue;
            $this->produk_nama->ViewCustomAttributes = "";

            // produk_jenis
            $this->produk_jenis->ViewValue = $this->produk_jenis->CurrentValue;
            $this->produk_jenis->ViewCustomAttributes = "";

            // produk_harga
            $this->produk_harga->ViewValue = $this->produk_harga->CurrentValue;
            $this->produk_harga->ViewValue = FormatNumber($this->produk_harga->ViewValue, 2, -2, -2, -2);
            $this->produk_harga->ViewCustomAttributes = "";

            // kurasi
            if (strval($this->kurasi->CurrentValue) != "") {
                $this->kurasi->ViewValue = $this->kurasi->optionCaption($this->kurasi->CurrentValue);
            } else {
                $this->kurasi->ViewValue = null;
            }
            $this->kurasi->ViewCustomAttributes = "";

            // judul_sesuai
            if (strval($this->judul_sesuai->CurrentValue) != "") {
                $this->judul_sesuai->ViewValue = $this->judul_sesuai->optionCaption($this->judul_sesuai->CurrentValue);
            } else {
                $this->judul_sesuai->ViewValue = null;
            }
            $this->judul_sesuai->ViewCustomAttributes = "";

            // foto_bagus
            if (strval($this->foto_bagus->CurrentValue) != "") {
                $this->foto_bagus->ViewValue = $this->foto_bagus->optionCaption($this->foto_bagus->CurrentValue);
            } else {
                $this->foto_bagus->ViewValue = null;
            }
            $this->foto_bagus->ViewCustomAttributes = "";

            // deskripsi_jelas
            if (strval($this->deskripsi_jelas->CurrentValue) != "") {
                $this->deskripsi_jelas->ViewValue = $this->deskripsi_jelas->optionCaption($this->deskripsi_jelas->CurrentValue);
            } else {
                $this->deskripsi_jelas->ViewValue = null;
            }
            $this->deskripsi_jelas->ViewCustomAttributes = "";

            // harga_tidak_kosong
            if (strval($this->harga_tidak_kosong->CurrentValue) != "") {
                $this->harga_tidak_kosong->ViewValue = $this->harga_tidak_kosong->optionCaption($this->harga_tidak_kosong->CurrentValue);
            } else {
                $this->harga_tidak_kosong->ViewValue = null;
            }
            $this->harga_tidak_kosong->ViewCustomAttributes = "";

            // berat_tidak_kosong
            if (strval($this->berat_tidak_kosong->CurrentValue) != "") {
                $this->berat_tidak_kosong->ViewValue = $this->berat_tidak_kosong->optionCaption($this->berat_tidak_kosong->CurrentValue);
            } else {
                $this->berat_tidak_kosong->ViewValue = null;
            }
            $this->berat_tidak_kosong->ViewCustomAttributes = "";

            // produk_berat
            $this->produk_berat->ViewValue = $this->produk_berat->CurrentValue;
            $this->produk_berat->ViewValue = FormatNumber($this->produk_berat->ViewValue, 2, -2, -2, -2);
            $this->produk_berat->ViewCustomAttributes = "";

            // produk_panjang
            $this->produk_panjang->ViewValue = $this->produk_panjang->CurrentValue;
            $this->produk_panjang->ViewValue = FormatNumber($this->produk_panjang->ViewValue, 2, -2, -2, -2);
            $this->produk_panjang->ViewCustomAttributes = "";

            // produk_lebar
            $this->produk_lebar->ViewValue = $this->produk_lebar->CurrentValue;
            $this->produk_lebar->ViewValue = FormatNumber($this->produk_lebar->ViewValue, 2, -2, -2, -2);
            $this->produk_lebar->ViewCustomAttributes = "";

            // produk_tinggi
            $this->produk_tinggi->ViewValue = $this->produk_tinggi->CurrentValue;
            $this->produk_tinggi->ViewValue = FormatNumber($this->produk_tinggi->ViewValue, 2, -2, -2, -2);
            $this->produk_tinggi->ViewCustomAttributes = "";

            // produk_harga_dasar
            $this->produk_harga_dasar->ViewValue = $this->produk_harga_dasar->CurrentValue;
            $this->produk_harga_dasar->ViewValue = FormatNumber($this->produk_harga_dasar->ViewValue, 2, -2, -2, -2);
            $this->produk_harga_dasar->ViewCustomAttributes = "";

            // produk_foto_1
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->ImageWidth = 200;
                $this->produk_foto_1->ImageHeight = 200;
                $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
                $this->produk_foto_1->ViewValue = $this->produk_foto_1->Upload->DbValue;
            } else {
                $this->produk_foto_1->ViewValue = "";
            }
            $this->produk_foto_1->ViewCustomAttributes = "";

            // produk_foto_2
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->ImageWidth = 200;
                $this->produk_foto_2->ImageHeight = 200;
                $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
                $this->produk_foto_2->ViewValue = $this->produk_foto_2->Upload->DbValue;
            } else {
                $this->produk_foto_2->ViewValue = "";
            }
            $this->produk_foto_2->ViewCustomAttributes = "";

            // produk_foto_3
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->ImageWidth = 200;
                $this->produk_foto_3->ImageHeight = 200;
                $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
                $this->produk_foto_3->ViewValue = $this->produk_foto_3->Upload->DbValue;
            } else {
                $this->produk_foto_3->ViewValue = "";
            }
            $this->produk_foto_3->ViewCustomAttributes = "";

            // market
            $this->market->ViewValue = $this->market->CurrentValue;
            $this->market->ViewCustomAttributes = "";

            // produk_foto
            $this->produk_foto->LinkCustomAttributes = "";
            $this->produk_foto->HrefValue = "";
            $this->produk_foto->ExportHrefValue = $this->produk_foto->UploadPath . $this->produk_foto->Upload->DbValue;
            $this->produk_foto->TooltipValue = "";

            // produk_nama
            $this->produk_nama->LinkCustomAttributes = "";
            $this->produk_nama->HrefValue = "";
            $this->produk_nama->TooltipValue = "";

            // produk_jenis
            $this->produk_jenis->LinkCustomAttributes = "";
            $this->produk_jenis->HrefValue = "";
            $this->produk_jenis->TooltipValue = "";

            // produk_harga
            $this->produk_harga->LinkCustomAttributes = "";
            $this->produk_harga->HrefValue = "";
            $this->produk_harga->TooltipValue = "";

            // kurasi
            $this->kurasi->LinkCustomAttributes = "";
            $this->kurasi->HrefValue = "";
            $this->kurasi->TooltipValue = "";

            // judul_sesuai
            $this->judul_sesuai->LinkCustomAttributes = "";
            $this->judul_sesuai->HrefValue = "";
            $this->judul_sesuai->TooltipValue = "";

            // foto_bagus
            $this->foto_bagus->LinkCustomAttributes = "";
            $this->foto_bagus->HrefValue = "";
            $this->foto_bagus->TooltipValue = "";

            // deskripsi_jelas
            $this->deskripsi_jelas->LinkCustomAttributes = "";
            $this->deskripsi_jelas->HrefValue = "";
            $this->deskripsi_jelas->TooltipValue = "";

            // harga_tidak_kosong
            $this->harga_tidak_kosong->LinkCustomAttributes = "";
            $this->harga_tidak_kosong->HrefValue = "";
            $this->harga_tidak_kosong->TooltipValue = "";

            // berat_tidak_kosong
            $this->berat_tidak_kosong->LinkCustomAttributes = "";
            $this->berat_tidak_kosong->HrefValue = "";
            $this->berat_tidak_kosong->TooltipValue = "";

            // produk_berat
            $this->produk_berat->LinkCustomAttributes = "";
            $this->produk_berat->HrefValue = "";
            $this->produk_berat->TooltipValue = "";

            // produk_panjang
            $this->produk_panjang->LinkCustomAttributes = "";
            $this->produk_panjang->HrefValue = "";
            $this->produk_panjang->TooltipValue = "";

            // produk_lebar
            $this->produk_lebar->LinkCustomAttributes = "";
            $this->produk_lebar->HrefValue = "";
            $this->produk_lebar->TooltipValue = "";

            // produk_tinggi
            $this->produk_tinggi->LinkCustomAttributes = "";
            $this->produk_tinggi->HrefValue = "";
            $this->produk_tinggi->TooltipValue = "";

            // produk_harga_dasar
            $this->produk_harga_dasar->LinkCustomAttributes = "";
            $this->produk_harga_dasar->HrefValue = "";
            $this->produk_harga_dasar->TooltipValue = "";

            // produk_foto_1
            $this->produk_foto_1->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
                $this->produk_foto_1->HrefValue = GetFileUploadUrl($this->produk_foto_1, $this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_1->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_1->HrefValue = FullUrl($this->produk_foto_1->HrefValue, "href");
                }
            } else {
                $this->produk_foto_1->HrefValue = "";
            }
            $this->produk_foto_1->ExportHrefValue = $this->produk_foto_1->UploadPath . $this->produk_foto_1->Upload->DbValue;
            $this->produk_foto_1->TooltipValue = "";
            if ($this->produk_foto_1->UseColorbox) {
                if (EmptyValue($this->produk_foto_1->TooltipValue)) {
                    $this->produk_foto_1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_1->LinkAttrs["data-rel"] = "kumkm_market_x" . $this->RowCount . "_produk_foto_1";
                $this->produk_foto_1->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_foto_2
            $this->produk_foto_2->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
                $this->produk_foto_2->HrefValue = GetFileUploadUrl($this->produk_foto_2, $this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_2->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_2->HrefValue = FullUrl($this->produk_foto_2->HrefValue, "href");
                }
            } else {
                $this->produk_foto_2->HrefValue = "";
            }
            $this->produk_foto_2->ExportHrefValue = $this->produk_foto_2->UploadPath . $this->produk_foto_2->Upload->DbValue;
            $this->produk_foto_2->TooltipValue = "";
            if ($this->produk_foto_2->UseColorbox) {
                if (EmptyValue($this->produk_foto_2->TooltipValue)) {
                    $this->produk_foto_2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_2->LinkAttrs["data-rel"] = "kumkm_market_x" . $this->RowCount . "_produk_foto_2";
                $this->produk_foto_2->LinkAttrs->appendClass("ew-lightbox");
            }

            // produk_foto_3
            $this->produk_foto_3->LinkCustomAttributes = "";
            if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
                $this->produk_foto_3->HrefValue = GetFileUploadUrl($this->produk_foto_3, $this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)); // Add prefix/suffix
                $this->produk_foto_3->LinkAttrs["target"] = ""; // Add target
                if ($this->isExport()) {
                    $this->produk_foto_3->HrefValue = FullUrl($this->produk_foto_3->HrefValue, "href");
                }
            } else {
                $this->produk_foto_3->HrefValue = "";
            }
            $this->produk_foto_3->ExportHrefValue = $this->produk_foto_3->UploadPath . $this->produk_foto_3->Upload->DbValue;
            $this->produk_foto_3->TooltipValue = "";
            if ($this->produk_foto_3->UseColorbox) {
                if (EmptyValue($this->produk_foto_3->TooltipValue)) {
                    $this->produk_foto_3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
                }
                $this->produk_foto_3->LinkAttrs["data-rel"] = "kumkm_market_x" . $this->RowCount . "_produk_foto_3";
                $this->produk_foto_3->LinkAttrs->appendClass("ew-lightbox");
            }

            // market
            $this->market->LinkCustomAttributes = "";
            $this->market->HrefValue = "";
            $this->market->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        $item->Body = "<a class=\"btn btn-default ew-search-toggle" . $searchToggleClass . "\" href=\"#\" role=\"button\" title=\"" . $Language->phrase("SearchPanel") . "\" data-caption=\"" . $Language->phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fkumkm_marketlistsrch\" aria-pressed=\"" . ($searchToggleClass == " active" ? "true" : "false") . "\">" . $Language->phrase("SearchLink") . "</a>";
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
                case "x_kurasi":
                    break;
                case "x_produk_legal":
                    break;
                case "x_judul_sesuai":
                    break;
                case "x_foto_bagus":
                    break;
                case "x_deskripsi_jelas":
                    break;
                case "x_harga_tidak_kosong":
                    break;
                case "x_berat_tidak_kosong":
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
