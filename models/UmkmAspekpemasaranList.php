<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekpemasaranList extends UmkmAspekpemasaran
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekpemasaran';

    // Page object name
    public $PageObjName = "UmkmAspekpemasaranList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fumkm_aspekpemasaranlist";
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

        // Table object (umkm_aspekpemasaran)
        if (!isset($GLOBALS["umkm_aspekpemasaran"]) || get_class($GLOBALS["umkm_aspekpemasaran"]) == PROJECT_NAMESPACE . "umkm_aspekpemasaran") {
            $GLOBALS["umkm_aspekpemasaran"] = &$this;
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
        $this->AddUrl = "umkmaspekpemasaranadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "umkmaspekpemasarandelete";
        $this->MultiUpdateUrl = "umkmaspekpemasaranupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekpemasaran');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fumkm_aspekpemasaranlistsrch";

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
                $doc = new $class(Container("umkm_aspekpemasaran"));
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
        if ($this->isAddOrEdit()) {
            $this->NIK->Visible = false;
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
    public $MultiColumnClass = "col-sm-12";
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

        // Create form object
        $CurrentForm = new HttpForm();

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
        $this->setupLookupOptions($this->MK_KEUNGGULANPRODUK);
        $this->setupLookupOptions($this->MK_TARGETPASAR);
        $this->setupLookupOptions($this->MK_KETERSEDIAAN);
        $this->setupLookupOptions($this->MK_LOGO);
        $this->setupLookupOptions($this->MK_HKI);
        $this->setupLookupOptions($this->MK_BRANDING);
        $this->setupLookupOptions($this->MK_COBRANDING);
        $this->setupLookupOptions($this->MK_MEDIAOFFLINE);
        $this->setupLookupOptions($this->MK_RESELLER);
        $this->setupLookupOptions($this->MK_PASAR);
        $this->setupLookupOptions($this->MK_PELANGGAN);
        $this->setupLookupOptions($this->MK_PAMERANMANDIRI);

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

            // Check QueryString parameters
            if (Get("action") !== null) {
                $this->CurrentAction = Get("action");

                // Clear inline mode
                if ($this->isCancel()) {
                    $this->clearInlineMode();
                }

                // Switch to inline edit mode
                if ($this->isEdit()) {
                    $this->inlineEditMode();
                }
            } else {
                if (Post("action") !== null) {
                    $this->CurrentAction = Post("action"); // Get action

                    // Inline Update
                    if (($this->isUpdate() || $this->isOverwrite()) && Session(SESSION_INLINE_MODE) == "edit") {
                        $this->setKey(Post($this->OldKeyName));
                        $this->inlineUpdate();
                    }
                }
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

            // Set up sorting order
            $this->setupSortOrder();
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

    // Exit inline mode
    protected function clearInlineMode()
    {
        $this->LastAction = $this->CurrentAction; // Save last action
        $this->CurrentAction = ""; // Clear action
        $_SESSION[SESSION_INLINE_MODE] = ""; // Clear inline mode
    }

    // Switch to Inline Edit mode
    protected function inlineEditMode()
    {
        global $Security, $Language;
        if (!$Security->canEdit()) {
            return false; // Edit not allowed
        }
        $inlineEdit = true;
        if (($keyValue = Get("NIK") ?? Route("NIK")) !== null) {
            $this->NIK->setQueryStringValue($keyValue);
        } else {
            $inlineEdit = false;
        }
        if ($inlineEdit) {
            if ($this->loadRow()) {
                $this->OldKey = $this->getKey(true); // Get from CurrentValue
                $this->setKey($this->OldKey); // Set to OldValue
                $_SESSION[SESSION_INLINE_MODE] = "edit"; // Enable inline edit
            }
        }
        return true;
    }

    // Perform update to Inline Edit record
    protected function inlineUpdate()
    {
        global $Language, $CurrentForm;
        $CurrentForm->Index = 1;
        $this->loadFormValues(); // Get form values

        // Validate form
        $inlineUpdate = true;
        if (!$this->validateForm()) {
            $inlineUpdate = false; // Form error, reset action
        } else {
            $inlineUpdate = false;
            $this->SendEmail = true; // Send email on update success
            $inlineUpdate = $this->editRow(); // Update record
        }
        if ($inlineUpdate) { // Update success
            if ($this->getSuccessMessage() == "") {
                $this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Set up success message
            }
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
            $this->EventCancelled = true; // Cancel event
            $this->CurrentAction = "edit"; // Stay in edit mode
        }
    }

    // Check Inline Edit key
    public function checkInlineEditKey()
    {
        if (!SameString($this->NIK->OldValue, $this->NIK->CurrentValue)) {
            return false;
        }
        return true;
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

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for Ctrl pressed
        $ctrl = Get("ctrl") !== null;

        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
            $this->updateSort($this->NIK, $ctrl); // NIK
            $this->updateSort($this->MK_KEUNGGULANPRODUK, $ctrl); // MK_KEUNGGULANPRODUK
            $this->updateSort($this->MK_TARGETPASAR, $ctrl); // MK_TARGETPASAR
            $this->updateSort($this->MK_KETERSEDIAAN, $ctrl); // MK_KETERSEDIAAN
            $this->updateSort($this->MK_LOGO, $ctrl); // MK_LOGO
            $this->updateSort($this->MK_HKI, $ctrl); // MK_HKI
            $this->updateSort($this->MK_BRANDING, $ctrl); // MK_BRANDING
            $this->updateSort($this->MK_COBRANDING, $ctrl); // MK_COBRANDING
            $this->updateSort($this->MK_MEDIAOFFLINE, $ctrl); // MK_MEDIAOFFLINE
            $this->updateSort($this->MK_RESELLER, $ctrl); // MK_RESELLER
            $this->updateSort($this->MK_PASAR, $ctrl); // MK_PASAR
            $this->updateSort($this->MK_PELANGGAN, $ctrl); // MK_PELANGGAN
            $this->updateSort($this->MK_PAMERANMANDIRI, $ctrl); // MK_PAMERANMANDIRI
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
            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
                $this->NIK->setSort("");
                $this->MK_KEUNGGULANPRODUK->setSort("");
                $this->MK_TARGETPASAR->setSort("");
                $this->MK_KETERSEDIAAN->setSort("");
                $this->MK_LOGO->setSort("");
                $this->MK_HKI->setSort("");
                $this->MK_BRANDING->setSort("");
                $this->MK_COBRANDING->setSort("");
                $this->MK_MEDIAOFFLINE->setSort("");
                $this->MK_RESELLER->setSort("");
                $this->MK_PASAR->setSort("");
                $this->MK_PELANGGAN->setSort("");
                $this->MK_PAMERANMANDIRI->setSort("");
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

        // Set up row action and key
        if ($CurrentForm && is_numeric($this->RowIndex) && $this->RowType != "view") {
            $CurrentForm->Index = $this->RowIndex;
            $actionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
            $oldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->OldKeyName);
            $blankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
            if ($this->RowAction != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $actionName . "\" id=\"" . $actionName . "\" value=\"" . $this->RowAction . "\">";
            }
            $oldKey = $this->getKey(false); // Get from OldValue
            if ($oldKeyName != "" && $oldKey != "") {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $oldKeyName . "\" id=\"" . $oldKeyName . "\" value=\"" . HtmlEncode($oldKey) . "\">";
            }
            if ($this->RowAction == "insert" && $this->isConfirm() && $this->emptyRow()) {
                $this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $blankRowName . "\" id=\"" . $blankRowName . "\" value=\"1\">";
            }
        }
        $pageUrl = $this->pageUrl();

        // "edit"
        $opt = $this->ListOptions["edit"];
        if ($this->isInlineEditRow()) { // Inline-Edit
            $this->ListOptions->CustomItem = "edit"; // Show edit column only
            $cancelurl = $this->addMasterUrl($pageUrl . "action=cancel");
                $opt->Body = "<div" . (($opt->OnLeft) ? " class=\"text-right\"" : "") . ">" .
                "<a class=\"ew-grid-link ew-inline-update\" title=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("UpdateLink")) . "\" href=\"#\" onclick=\"ew.forms.get(this).submit(event, '" . UrlAddHash($this->pageName(), "r" . $this->RowCount . "_" . $this->TableVar) . "'); return false;\">" . $Language->phrase("UpdateLink") . "</a>&nbsp;" .
                "<a class=\"ew-grid-link ew-inline-cancel\" title=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->phrase("CancelLink") . "</a>" .
                "<input type=\"hidden\" name=\"action\" id=\"action\" value=\"update\"></div>";
            $opt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . HtmlEncode($this->NIK->CurrentValue) . "\">";
            return;
        }
        if ($this->CurrentMode == "view") {
            // "edit"
            $opt = $this->ListOptions["edit"];
            $editcaption = HtmlTitle($Language->phrase("EditLink"));
            if ($Security->canEdit()) {
                $opt->Body .= "<a class=\"ew-row-link ew-inline-edit\" title=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("InlineEditLink")) . "\" href=\"" . HtmlEncode(UrlAddHash(GetUrl($this->InlineEditUrl), "r" . $this->RowCount . "_" . $this->TableVar)) . "\">" . $Language->phrase("InlineEditLink") . "</a>";
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
        $opt->Body = "<div class=\"custom-control custom-checkbox d-inline-block\"><input type=\"checkbox\" id=\"key_m_" . $this->RowCount . "\" name=\"key_m[]\" class=\"custom-control-input ew-multi-select\" value=\"" . HtmlEncode($this->NIK->CurrentValue) . "\"><label class=\"custom-control-label\" for=\"key_m_" . $this->RowCount . "\"></label></div>";
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
        $item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fumkm_aspekpemasaranlist, url:'" . GetUrl($this->MultiDeleteUrl) . "', data:{action:'delete'}, msg:ew.language.phrase('DeleteConfirmMsg')});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fumkm_aspekpemasaranlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = false;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fumkm_aspekpemasaranlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
        $item->Visible = false;
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fumkm_aspekpemasaranlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
            if (!$this->EventCancelled) {
                $this->HashValue = $this->getRowHash($row); // Get hash value for record
            }
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
        $this->ViewUrl = $this->getViewUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->InlineEditUrl = $this->getInlineEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->InlineCopyUrl = $this->getInlineCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK
        $this->NIK->CellCssStyle = "white-space: nowrap;";

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
            $curVal = strval($this->MK_KEUNGGULANPRODUK->CurrentValue);
            if ($curVal != "") {
                $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->lookupCacheOption($curVal);
                if ($this->MK_KEUNGGULANPRODUK->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Kekuatan Produk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_KEUNGGULANPRODUK->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_KEUNGGULANPRODUK->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->displayValue($arwrk);
                    } else {
                        $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->CurrentValue;
                    }
                }
            } else {
                $this->MK_KEUNGGULANPRODUK->ViewValue = null;
            }
            $this->MK_KEUNGGULANPRODUK->ViewCustomAttributes = "";

            // MK_TARGETPASAR
            $curVal = strval($this->MK_TARGETPASAR->CurrentValue);
            if ($curVal != "") {
                $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->lookupCacheOption($curVal);
                if ($this->MK_TARGETPASAR->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Target Pasar'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_TARGETPASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_TARGETPASAR->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->displayValue($arwrk);
                    } else {
                        $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->CurrentValue;
                    }
                }
            } else {
                $this->MK_TARGETPASAR->ViewValue = null;
            }
            $this->MK_TARGETPASAR->ViewCustomAttributes = "";

            // MK_KETERSEDIAAN
            $curVal = strval($this->MK_KETERSEDIAAN->CurrentValue);
            if ($curVal != "") {
                $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->lookupCacheOption($curVal);
                if ($this->MK_KETERSEDIAAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Mudah Didapatkan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_KETERSEDIAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_KETERSEDIAAN->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->displayValue($arwrk);
                    } else {
                        $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->CurrentValue;
                    }
                }
            } else {
                $this->MK_KETERSEDIAAN->ViewValue = null;
            }
            $this->MK_KETERSEDIAAN->ViewCustomAttributes = "";

            // MK_LOGO
            $curVal = strval($this->MK_LOGO->CurrentValue);
            if ($curVal != "") {
                $this->MK_LOGO->ViewValue = $this->MK_LOGO->lookupCacheOption($curVal);
                if ($this->MK_LOGO->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Logo Dagang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_LOGO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_LOGO->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_LOGO->ViewValue = $this->MK_LOGO->displayValue($arwrk);
                    } else {
                        $this->MK_LOGO->ViewValue = $this->MK_LOGO->CurrentValue;
                    }
                }
            } else {
                $this->MK_LOGO->ViewValue = null;
            }
            $this->MK_LOGO->ViewCustomAttributes = "";

            // MK_HKI
            $curVal = strval($this->MK_HKI->CurrentValue);
            if ($curVal != "") {
                $this->MK_HKI->ViewValue = $this->MK_HKI->lookupCacheOption($curVal);
                if ($this->MK_HKI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='HKI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_HKI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_HKI->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_HKI->ViewValue = $this->MK_HKI->displayValue($arwrk);
                    } else {
                        $this->MK_HKI->ViewValue = $this->MK_HKI->CurrentValue;
                    }
                }
            } else {
                $this->MK_HKI->ViewValue = null;
            }
            $this->MK_HKI->ViewCustomAttributes = "";

            // MK_BRANDING
            $curVal = strval($this->MK_BRANDING->CurrentValue);
            if ($curVal != "") {
                $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->lookupCacheOption($curVal);
                if ($this->MK_BRANDING->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Konsep Branding'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_BRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_BRANDING->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->displayValue($arwrk);
                    } else {
                        $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->CurrentValue;
                    }
                }
            } else {
                $this->MK_BRANDING->ViewValue = null;
            }
            $this->MK_BRANDING->ViewCustomAttributes = "";

            // MK_COBRANDING
            $curVal = strval($this->MK_COBRANDING->CurrentValue);
            if ($curVal != "") {
                $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->lookupCacheOption($curVal);
                if ($this->MK_COBRANDING->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Jogjamark'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_COBRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_COBRANDING->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->displayValue($arwrk);
                    } else {
                        $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->CurrentValue;
                    }
                }
            } else {
                $this->MK_COBRANDING->ViewValue = null;
            }
            $this->MK_COBRANDING->ViewCustomAttributes = "";

            // MK_MEDIAOFFLINE
            $curVal = strval($this->MK_MEDIAOFFLINE->CurrentValue);
            if ($curVal != "") {
                $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->lookupCacheOption($curVal);
                if ($this->MK_MEDIAOFFLINE->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Offline'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_MEDIAOFFLINE->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_MEDIAOFFLINE->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->displayValue($arwrk);
                    } else {
                        $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->CurrentValue;
                    }
                }
            } else {
                $this->MK_MEDIAOFFLINE->ViewValue = null;
            }
            $this->MK_MEDIAOFFLINE->ViewCustomAttributes = "";

            // MK_RESELLER
            $curVal = strval($this->MK_RESELLER->CurrentValue);
            if ($curVal != "") {
                $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->lookupCacheOption($curVal);
                if ($this->MK_RESELLER->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Mitra'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_RESELLER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_RESELLER->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->displayValue($arwrk);
                    } else {
                        $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->CurrentValue;
                    }
                }
            } else {
                $this->MK_RESELLER->ViewValue = null;
            }
            $this->MK_RESELLER->ViewCustomAttributes = "";

            // MK_PASAR
            $curVal = strval($this->MK_PASAR->CurrentValue);
            if ($curVal != "") {
                $this->MK_PASAR->ViewValue = $this->MK_PASAR->lookupCacheOption($curVal);
                if ($this->MK_PASAR->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pemasaran'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PASAR->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PASAR->ViewValue = $this->MK_PASAR->displayValue($arwrk);
                    } else {
                        $this->MK_PASAR->ViewValue = $this->MK_PASAR->CurrentValue;
                    }
                }
            } else {
                $this->MK_PASAR->ViewValue = null;
            }
            $this->MK_PASAR->ViewCustomAttributes = "";

            // MK_PELANGGAN
            $curVal = strval($this->MK_PELANGGAN->CurrentValue);
            if ($curVal != "") {
                $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->lookupCacheOption($curVal);
                if ($this->MK_PELANGGAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pelanggan Tetap'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PELANGGAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PELANGGAN->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->displayValue($arwrk);
                    } else {
                        $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->CurrentValue;
                    }
                }
            } else {
                $this->MK_PELANGGAN->ViewValue = null;
            }
            $this->MK_PELANGGAN->ViewCustomAttributes = "";

            // MK_PAMERANMANDIRI
            $curVal = strval($this->MK_PAMERANMANDIRI->CurrentValue);
            if ($curVal != "") {
                $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->lookupCacheOption($curVal);
                if ($this->MK_PAMERANMANDIRI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pameran Mandiri'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PAMERANMANDIRI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PAMERANMANDIRI->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->displayValue($arwrk);
                    } else {
                        $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->CurrentValue;
                    }
                }
            } else {
                $this->MK_PAMERANMANDIRI->ViewValue = null;
            }
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

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->EditAttrs["class"] = "form-control";
            $this->MK_KEUNGGULANPRODUK->EditCustomAttributes = "";
            $this->MK_KEUNGGULANPRODUK->PlaceHolder = RemoveHtml($this->MK_KEUNGGULANPRODUK->caption());

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->EditAttrs["class"] = "form-control";
            $this->MK_TARGETPASAR->EditCustomAttributes = "";
            $this->MK_TARGETPASAR->PlaceHolder = RemoveHtml($this->MK_TARGETPASAR->caption());

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->EditAttrs["class"] = "form-control";
            $this->MK_KETERSEDIAAN->EditCustomAttributes = "";
            $this->MK_KETERSEDIAAN->PlaceHolder = RemoveHtml($this->MK_KETERSEDIAAN->caption());

            // MK_LOGO
            $this->MK_LOGO->EditAttrs["class"] = "form-control";
            $this->MK_LOGO->EditCustomAttributes = "";
            $this->MK_LOGO->PlaceHolder = RemoveHtml($this->MK_LOGO->caption());

            // MK_HKI
            $this->MK_HKI->EditAttrs["class"] = "form-control";
            $this->MK_HKI->EditCustomAttributes = "";
            $this->MK_HKI->PlaceHolder = RemoveHtml($this->MK_HKI->caption());

            // MK_BRANDING
            $this->MK_BRANDING->EditAttrs["class"] = "form-control";
            $this->MK_BRANDING->EditCustomAttributes = "";
            $this->MK_BRANDING->PlaceHolder = RemoveHtml($this->MK_BRANDING->caption());

            // MK_COBRANDING
            $this->MK_COBRANDING->EditAttrs["class"] = "form-control";
            $this->MK_COBRANDING->EditCustomAttributes = "";
            $this->MK_COBRANDING->PlaceHolder = RemoveHtml($this->MK_COBRANDING->caption());

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->EditAttrs["class"] = "form-control";
            $this->MK_MEDIAOFFLINE->EditCustomAttributes = "";
            $this->MK_MEDIAOFFLINE->PlaceHolder = RemoveHtml($this->MK_MEDIAOFFLINE->caption());

            // MK_RESELLER
            $this->MK_RESELLER->EditAttrs["class"] = "form-control";
            $this->MK_RESELLER->EditCustomAttributes = "";
            $this->MK_RESELLER->PlaceHolder = RemoveHtml($this->MK_RESELLER->caption());

            // MK_PASAR
            $this->MK_PASAR->EditAttrs["class"] = "form-control";
            $this->MK_PASAR->EditCustomAttributes = "";
            $this->MK_PASAR->PlaceHolder = RemoveHtml($this->MK_PASAR->caption());

            // MK_PELANGGAN
            $this->MK_PELANGGAN->EditAttrs["class"] = "form-control";
            $this->MK_PELANGGAN->EditCustomAttributes = "";
            $this->MK_PELANGGAN->PlaceHolder = RemoveHtml($this->MK_PELANGGAN->caption());

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->EditAttrs["class"] = "form-control";
            $this->MK_PAMERANMANDIRI->EditCustomAttributes = "";
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->EditAttrs["class"] = "form-control";
            $this->MK_KEUNGGULANPRODUK->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_KEUNGGULANPRODUK->CurrentValue));
            if ($curVal != "") {
                $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->lookupCacheOption($curVal);
            } else {
                $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->Lookup !== null && is_array($this->MK_KEUNGGULANPRODUK->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_KEUNGGULANPRODUK->ViewValue !== null) { // Load from cache
                $this->MK_KEUNGGULANPRODUK->EditValue = array_values($this->MK_KEUNGGULANPRODUK->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_KEUNGGULANPRODUK->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Kekuatan Produk'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_KEUNGGULANPRODUK->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_KEUNGGULANPRODUK->EditValue = $arwrk;
            }
            $this->MK_KEUNGGULANPRODUK->PlaceHolder = RemoveHtml($this->MK_KEUNGGULANPRODUK->caption());

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->EditAttrs["class"] = "form-control";
            $this->MK_TARGETPASAR->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_TARGETPASAR->CurrentValue));
            if ($curVal != "") {
                $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->lookupCacheOption($curVal);
            } else {
                $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->Lookup !== null && is_array($this->MK_TARGETPASAR->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_TARGETPASAR->ViewValue !== null) { // Load from cache
                $this->MK_TARGETPASAR->EditValue = array_values($this->MK_TARGETPASAR->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_TARGETPASAR->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Target Pasar'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_TARGETPASAR->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_TARGETPASAR->EditValue = $arwrk;
            }
            $this->MK_TARGETPASAR->PlaceHolder = RemoveHtml($this->MK_TARGETPASAR->caption());

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->EditAttrs["class"] = "form-control";
            $this->MK_KETERSEDIAAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_KETERSEDIAAN->CurrentValue));
            if ($curVal != "") {
                $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->lookupCacheOption($curVal);
            } else {
                $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->Lookup !== null && is_array($this->MK_KETERSEDIAAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_KETERSEDIAAN->ViewValue !== null) { // Load from cache
                $this->MK_KETERSEDIAAN->EditValue = array_values($this->MK_KETERSEDIAAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_KETERSEDIAAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Mudah Didapatkan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_KETERSEDIAAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_KETERSEDIAAN->EditValue = $arwrk;
            }
            $this->MK_KETERSEDIAAN->PlaceHolder = RemoveHtml($this->MK_KETERSEDIAAN->caption());

            // MK_LOGO
            $this->MK_LOGO->EditAttrs["class"] = "form-control";
            $this->MK_LOGO->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_LOGO->CurrentValue));
            if ($curVal != "") {
                $this->MK_LOGO->ViewValue = $this->MK_LOGO->lookupCacheOption($curVal);
            } else {
                $this->MK_LOGO->ViewValue = $this->MK_LOGO->Lookup !== null && is_array($this->MK_LOGO->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_LOGO->ViewValue !== null) { // Load from cache
                $this->MK_LOGO->EditValue = array_values($this->MK_LOGO->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_LOGO->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Logo Dagang'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_LOGO->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_LOGO->EditValue = $arwrk;
            }
            $this->MK_LOGO->PlaceHolder = RemoveHtml($this->MK_LOGO->caption());

            // MK_HKI
            $this->MK_HKI->EditAttrs["class"] = "form-control";
            $this->MK_HKI->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_HKI->CurrentValue));
            if ($curVal != "") {
                $this->MK_HKI->ViewValue = $this->MK_HKI->lookupCacheOption($curVal);
            } else {
                $this->MK_HKI->ViewValue = $this->MK_HKI->Lookup !== null && is_array($this->MK_HKI->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_HKI->ViewValue !== null) { // Load from cache
                $this->MK_HKI->EditValue = array_values($this->MK_HKI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_HKI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='HKI'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_HKI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_HKI->EditValue = $arwrk;
            }
            $this->MK_HKI->PlaceHolder = RemoveHtml($this->MK_HKI->caption());

            // MK_BRANDING
            $this->MK_BRANDING->EditAttrs["class"] = "form-control";
            $this->MK_BRANDING->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_BRANDING->CurrentValue));
            if ($curVal != "") {
                $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->lookupCacheOption($curVal);
            } else {
                $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->Lookup !== null && is_array($this->MK_BRANDING->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_BRANDING->ViewValue !== null) { // Load from cache
                $this->MK_BRANDING->EditValue = array_values($this->MK_BRANDING->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_BRANDING->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Konsep Branding'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_BRANDING->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_BRANDING->EditValue = $arwrk;
            }
            $this->MK_BRANDING->PlaceHolder = RemoveHtml($this->MK_BRANDING->caption());

            // MK_COBRANDING
            $this->MK_COBRANDING->EditAttrs["class"] = "form-control";
            $this->MK_COBRANDING->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_COBRANDING->CurrentValue));
            if ($curVal != "") {
                $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->lookupCacheOption($curVal);
            } else {
                $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->Lookup !== null && is_array($this->MK_COBRANDING->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_COBRANDING->ViewValue !== null) { // Load from cache
                $this->MK_COBRANDING->EditValue = array_values($this->MK_COBRANDING->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_COBRANDING->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Jogjamark'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_COBRANDING->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_COBRANDING->EditValue = $arwrk;
            }
            $this->MK_COBRANDING->PlaceHolder = RemoveHtml($this->MK_COBRANDING->caption());

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->EditAttrs["class"] = "form-control";
            $this->MK_MEDIAOFFLINE->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_MEDIAOFFLINE->CurrentValue));
            if ($curVal != "") {
                $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->lookupCacheOption($curVal);
            } else {
                $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->Lookup !== null && is_array($this->MK_MEDIAOFFLINE->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_MEDIAOFFLINE->ViewValue !== null) { // Load from cache
                $this->MK_MEDIAOFFLINE->EditValue = array_values($this->MK_MEDIAOFFLINE->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_MEDIAOFFLINE->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Offline'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_MEDIAOFFLINE->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_MEDIAOFFLINE->EditValue = $arwrk;
            }
            $this->MK_MEDIAOFFLINE->PlaceHolder = RemoveHtml($this->MK_MEDIAOFFLINE->caption());

            // MK_RESELLER
            $this->MK_RESELLER->EditAttrs["class"] = "form-control";
            $this->MK_RESELLER->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_RESELLER->CurrentValue));
            if ($curVal != "") {
                $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->lookupCacheOption($curVal);
            } else {
                $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->Lookup !== null && is_array($this->MK_RESELLER->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_RESELLER->ViewValue !== null) { // Load from cache
                $this->MK_RESELLER->EditValue = array_values($this->MK_RESELLER->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_RESELLER->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Mitra'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_RESELLER->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_RESELLER->EditValue = $arwrk;
            }
            $this->MK_RESELLER->PlaceHolder = RemoveHtml($this->MK_RESELLER->caption());

            // MK_PASAR
            $this->MK_PASAR->EditAttrs["class"] = "form-control";
            $this->MK_PASAR->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_PASAR->CurrentValue));
            if ($curVal != "") {
                $this->MK_PASAR->ViewValue = $this->MK_PASAR->lookupCacheOption($curVal);
            } else {
                $this->MK_PASAR->ViewValue = $this->MK_PASAR->Lookup !== null && is_array($this->MK_PASAR->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_PASAR->ViewValue !== null) { // Load from cache
                $this->MK_PASAR->EditValue = array_values($this->MK_PASAR->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_PASAR->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pemasaran'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PASAR->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_PASAR->EditValue = $arwrk;
            }
            $this->MK_PASAR->PlaceHolder = RemoveHtml($this->MK_PASAR->caption());

            // MK_PELANGGAN
            $this->MK_PELANGGAN->EditAttrs["class"] = "form-control";
            $this->MK_PELANGGAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_PELANGGAN->CurrentValue));
            if ($curVal != "") {
                $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->lookupCacheOption($curVal);
            } else {
                $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->Lookup !== null && is_array($this->MK_PELANGGAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_PELANGGAN->ViewValue !== null) { // Load from cache
                $this->MK_PELANGGAN->EditValue = array_values($this->MK_PELANGGAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_PELANGGAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pelanggan Tetap'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PELANGGAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_PELANGGAN->EditValue = $arwrk;
            }
            $this->MK_PELANGGAN->PlaceHolder = RemoveHtml($this->MK_PELANGGAN->caption());

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->EditAttrs["class"] = "form-control";
            $this->MK_PAMERANMANDIRI->EditCustomAttributes = "";
            $curVal = trim(strval($this->MK_PAMERANMANDIRI->CurrentValue));
            if ($curVal != "") {
                $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->lookupCacheOption($curVal);
            } else {
                $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->Lookup !== null && is_array($this->MK_PAMERANMANDIRI->Lookup->Options) ? $curVal : null;
            }
            if ($this->MK_PAMERANMANDIRI->ViewValue !== null) { // Load from cache
                $this->MK_PAMERANMANDIRI->EditValue = array_values($this->MK_PAMERANMANDIRI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->MK_PAMERANMANDIRI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pameran Mandiri'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PAMERANMANDIRI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->MK_PAMERANMANDIRI->EditValue = $arwrk;
            }
            $this->MK_PAMERANMANDIRI->PlaceHolder = RemoveHtml($this->MK_PAMERANMANDIRI->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

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

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->setDbValueDef($rsnew, $this->MK_KEUNGGULANPRODUK->CurrentValue, null, $this->MK_KEUNGGULANPRODUK->ReadOnly);

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->setDbValueDef($rsnew, $this->MK_TARGETPASAR->CurrentValue, null, $this->MK_TARGETPASAR->ReadOnly);

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->setDbValueDef($rsnew, $this->MK_KETERSEDIAAN->CurrentValue, null, $this->MK_KETERSEDIAAN->ReadOnly);

            // MK_LOGO
            $this->MK_LOGO->setDbValueDef($rsnew, $this->MK_LOGO->CurrentValue, null, $this->MK_LOGO->ReadOnly);

            // MK_HKI
            $this->MK_HKI->setDbValueDef($rsnew, $this->MK_HKI->CurrentValue, null, $this->MK_HKI->ReadOnly);

            // MK_BRANDING
            $this->MK_BRANDING->setDbValueDef($rsnew, $this->MK_BRANDING->CurrentValue, null, $this->MK_BRANDING->ReadOnly);

            // MK_COBRANDING
            $this->MK_COBRANDING->setDbValueDef($rsnew, $this->MK_COBRANDING->CurrentValue, null, $this->MK_COBRANDING->ReadOnly);

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->setDbValueDef($rsnew, $this->MK_MEDIAOFFLINE->CurrentValue, null, $this->MK_MEDIAOFFLINE->ReadOnly);

            // MK_RESELLER
            $this->MK_RESELLER->setDbValueDef($rsnew, $this->MK_RESELLER->CurrentValue, null, $this->MK_RESELLER->ReadOnly);

            // MK_PASAR
            $this->MK_PASAR->setDbValueDef($rsnew, $this->MK_PASAR->CurrentValue, null, $this->MK_PASAR->ReadOnly);

            // MK_PELANGGAN
            $this->MK_PELANGGAN->setDbValueDef($rsnew, $this->MK_PELANGGAN->CurrentValue, null, $this->MK_PELANGGAN->ReadOnly);

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->setDbValueDef($rsnew, $this->MK_PAMERANMANDIRI->CurrentValue, null, $this->MK_PAMERANMANDIRI->ReadOnly);

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

    // Load row hash
    protected function loadRowHash()
    {
        $filter = $this->getRecordFilter();

        // Load SQL based on filter
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $row = $conn->fetchAssoc($sql);
        $this->HashValue = $row ? $this->getRowHash($row) : ""; // Get hash value for record
    }

    // Get Row Hash
    public function getRowHash(&$rs)
    {
        if (!$rs) {
            return "";
        }
        $row = ($rs instanceof Recordset) ? $rs->fields : $rs;
        $hash = "";
        $hash .= GetFieldHash($row['MK_KEUNGGULANPRODUK']); // MK_KEUNGGULANPRODUK
        $hash .= GetFieldHash($row['MK_TARGETPASAR']); // MK_TARGETPASAR
        $hash .= GetFieldHash($row['MK_KETERSEDIAAN']); // MK_KETERSEDIAAN
        $hash .= GetFieldHash($row['MK_LOGO']); // MK_LOGO
        $hash .= GetFieldHash($row['MK_HKI']); // MK_HKI
        $hash .= GetFieldHash($row['MK_BRANDING']); // MK_BRANDING
        $hash .= GetFieldHash($row['MK_COBRANDING']); // MK_COBRANDING
        $hash .= GetFieldHash($row['MK_MEDIAOFFLINE']); // MK_MEDIAOFFLINE
        $hash .= GetFieldHash($row['MK_RESELLER']); // MK_RESELLER
        $hash .= GetFieldHash($row['MK_PASAR']); // MK_PASAR
        $hash .= GetFieldHash($row['MK_PELANGGAN']); // MK_PELANGGAN
        $hash .= GetFieldHash($row['MK_PAMERANMANDIRI']); // MK_PAMERANMANDIRI
        return md5($hash);
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

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fumkm_aspekpemasaranlist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fumkm_aspekpemasaranlist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fumkm_aspekpemasaranlist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_umkm_aspekpemasaran" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_umkm_aspekpemasaran\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fumkm_aspekpemasaranlist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Visible = false;

        // Export to Excel
        $item = &$this->ExportOptions->add("excel");
        $item->Body = $this->getExportTag("excel");
        $item->Visible = false;

        // Export to Word
        $item = &$this->ExportOptions->add("word");
        $item->Body = $this->getExportTag("word");
        $item->Visible = false;

        // Export to Html
        $item = &$this->ExportOptions->add("html");
        $item->Body = $this->getExportTag("html");
        $item->Visible = false;

        // Export to Xml
        $item = &$this->ExportOptions->add("xml");
        $item->Body = $this->getExportTag("xml");
        $item->Visible = false;

        // Export to Csv
        $item = &$this->ExportOptions->add("csv");
        $item->Body = $this->getExportTag("csv");
        $item->Visible = false;

        // Export to Pdf
        $item = &$this->ExportOptions->add("pdf");
        $item->Body = $this->getExportTag("pdf");
        $item->Visible = false;

        // Export to Email
        $item = &$this->ExportOptions->add("email");
        $item->Body = $this->getExportTag("email");
        $item->Visible = false;

        // Drop down button for export
        $this->ExportOptions->UseButtonGroup = true;
        $this->ExportOptions->UseDropDownButton = false;
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
                case "x_MK_KEUNGGULANPRODUK":
                    $lookupFilter = function () {
                        return "`subkat`='Kekuatan Produk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_TARGETPASAR":
                    $lookupFilter = function () {
                        return "`subkat`='Target Pasar'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_KETERSEDIAAN":
                    $lookupFilter = function () {
                        return "`subkat`='Mudah Didapatkan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_LOGO":
                    $lookupFilter = function () {
                        return "`subkat`='Logo Dagang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_HKI":
                    $lookupFilter = function () {
                        return "`subkat`='HKI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_BRANDING":
                    $lookupFilter = function () {
                        return "`subkat`='Konsep Branding'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_COBRANDING":
                    $lookupFilter = function () {
                        return "`subkat`='Jogjamark'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_MEDIAOFFLINE":
                    $lookupFilter = function () {
                        return "`subkat`='Offline'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_RESELLER":
                    $lookupFilter = function () {
                        return "`subkat`='Mitra'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PASAR":
                    $lookupFilter = function () {
                        return "`subkat`='Pemasaran'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PELANGGAN":
                    $lookupFilter = function () {
                        return "`subkat`='Pelanggan Tetap'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PAMERANMANDIRI":
                    $lookupFilter = function () {
                        return "`subkat`='Pameran Mandiri'";
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
