<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekdigimarkList extends UmkmAspekdigimark
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekdigimark';

    // Page object name
    public $PageObjName = "UmkmAspekdigimarkList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fumkm_aspekdigimarklist";
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

        // Table object (umkm_aspekdigimark)
        if (!isset($GLOBALS["umkm_aspekdigimark"]) || get_class($GLOBALS["umkm_aspekdigimark"]) == PROJECT_NAMESPACE . "umkm_aspekdigimark") {
            $GLOBALS["umkm_aspekdigimark"] = &$this;
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
        $this->AddUrl = "umkmaspekdigimarkadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "umkmaspekdigimarkdelete";
        $this->MultiUpdateUrl = "umkmaspekdigimarkupdate";

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
        $this->FilterOptions->TagClassName = "ew-filter-option fumkm_aspekdigimarklistsrch";

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
        $this->setupLookupOptions($this->DM_CHATTING);
        $this->setupLookupOptions($this->DM_MEDSOS);
        $this->setupLookupOptions($this->DM_MP);
        $this->setupLookupOptions($this->DM_GMB);
        $this->setupLookupOptions($this->DM_WEB);
        $this->setupLookupOptions($this->DM_UPDATEMEDSOS);
        $this->setupLookupOptions($this->DM_UPDATEWEBSITE);
        $this->setupLookupOptions($this->DM_GOOGLEINDEX);
        $this->setupLookupOptions($this->DM_IKLANBERBAYAR);

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
            $this->updateSort($this->DM_CHATTING, $ctrl); // DM_CHATTING
            $this->updateSort($this->DM_MEDSOS, $ctrl); // DM_MEDSOS
            $this->updateSort($this->DM_MP, $ctrl); // DM_MP
            $this->updateSort($this->DM_GMB, $ctrl); // DM_GMB
            $this->updateSort($this->DM_WEB, $ctrl); // DM_WEB
            $this->updateSort($this->DM_UPDATEMEDSOS, $ctrl); // DM_UPDATEMEDSOS
            $this->updateSort($this->DM_UPDATEWEBSITE, $ctrl); // DM_UPDATEWEBSITE
            $this->updateSort($this->DM_GOOGLEINDEX, $ctrl); // DM_GOOGLEINDEX
            $this->updateSort($this->DM_IKLANBERBAYAR, $ctrl); // DM_IKLANBERBAYAR
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
                $this->DM_CHATTING->setSort("");
                $this->DM_MEDSOS->setSort("");
                $this->DM_MP->setSort("");
                $this->DM_GMB->setSort("");
                $this->DM_WEB->setSort("");
                $this->DM_UPDATEMEDSOS->setSort("");
                $this->DM_UPDATEWEBSITE->setSort("");
                $this->DM_GOOGLEINDEX->setSort("");
                $this->DM_IKLANBERBAYAR->setSort("");
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
        $item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fumkm_aspekdigimarklist, url:'" . GetUrl($this->MultiDeleteUrl) . "', data:{action:'delete'}, msg:ew.language.phrase('DeleteConfirmMsg')});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fumkm_aspekdigimarklistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = false;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fumkm_aspekdigimarklistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fumkm_aspekdigimarklist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
            $this->DM_CHATTING->PlaceHolder = RemoveHtml($this->DM_CHATTING->caption());

            // DM_MEDSOS
            $this->DM_MEDSOS->EditAttrs["class"] = "form-control";
            $this->DM_MEDSOS->EditCustomAttributes = "";
            $this->DM_MEDSOS->PlaceHolder = RemoveHtml($this->DM_MEDSOS->caption());

            // DM_MP
            $this->DM_MP->EditAttrs["class"] = "form-control";
            $this->DM_MP->EditCustomAttributes = "";
            $this->DM_MP->PlaceHolder = RemoveHtml($this->DM_MP->caption());

            // DM_GMB
            $this->DM_GMB->EditAttrs["class"] = "form-control";
            $this->DM_GMB->EditCustomAttributes = "";
            $this->DM_GMB->PlaceHolder = RemoveHtml($this->DM_GMB->caption());

            // DM_WEB
            $this->DM_WEB->EditAttrs["class"] = "form-control";
            $this->DM_WEB->EditCustomAttributes = "";
            $this->DM_WEB->PlaceHolder = RemoveHtml($this->DM_WEB->caption());

            // DM_UPDATEMEDSOS
            $this->DM_UPDATEMEDSOS->EditAttrs["class"] = "form-control";
            $this->DM_UPDATEMEDSOS->EditCustomAttributes = "";
            $this->DM_UPDATEMEDSOS->PlaceHolder = RemoveHtml($this->DM_UPDATEMEDSOS->caption());

            // DM_UPDATEWEBSITE
            $this->DM_UPDATEWEBSITE->EditAttrs["class"] = "form-control";
            $this->DM_UPDATEWEBSITE->EditCustomAttributes = "";
            $this->DM_UPDATEWEBSITE->PlaceHolder = RemoveHtml($this->DM_UPDATEWEBSITE->caption());

            // DM_GOOGLEINDEX
            $this->DM_GOOGLEINDEX->EditAttrs["class"] = "form-control";
            $this->DM_GOOGLEINDEX->EditCustomAttributes = "";
            $this->DM_GOOGLEINDEX->PlaceHolder = RemoveHtml($this->DM_GOOGLEINDEX->caption());

            // DM_IKLANBERBAYAR
            $this->DM_IKLANBERBAYAR->EditAttrs["class"] = "form-control";
            $this->DM_IKLANBERBAYAR->EditCustomAttributes = "";
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
        } elseif ($this->RowType == ROWTYPE_EDIT) {
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

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

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

            // DM_CHATTING
            $this->DM_CHATTING->setDbValueDef($rsnew, $this->DM_CHATTING->CurrentValue, null, $this->DM_CHATTING->ReadOnly);

            // DM_MEDSOS
            $this->DM_MEDSOS->setDbValueDef($rsnew, $this->DM_MEDSOS->CurrentValue, null, $this->DM_MEDSOS->ReadOnly);

            // DM_MP
            $this->DM_MP->setDbValueDef($rsnew, $this->DM_MP->CurrentValue, null, $this->DM_MP->ReadOnly);

            // DM_GMB
            $this->DM_GMB->setDbValueDef($rsnew, $this->DM_GMB->CurrentValue, null, $this->DM_GMB->ReadOnly);

            // DM_WEB
            $this->DM_WEB->setDbValueDef($rsnew, $this->DM_WEB->CurrentValue, null, $this->DM_WEB->ReadOnly);

            // DM_UPDATEMEDSOS
            $this->DM_UPDATEMEDSOS->setDbValueDef($rsnew, $this->DM_UPDATEMEDSOS->CurrentValue, null, $this->DM_UPDATEMEDSOS->ReadOnly);

            // DM_UPDATEWEBSITE
            $this->DM_UPDATEWEBSITE->setDbValueDef($rsnew, $this->DM_UPDATEWEBSITE->CurrentValue, null, $this->DM_UPDATEWEBSITE->ReadOnly);

            // DM_GOOGLEINDEX
            $this->DM_GOOGLEINDEX->setDbValueDef($rsnew, $this->DM_GOOGLEINDEX->CurrentValue, null, $this->DM_GOOGLEINDEX->ReadOnly);

            // DM_IKLANBERBAYAR
            $this->DM_IKLANBERBAYAR->setDbValueDef($rsnew, $this->DM_IKLANBERBAYAR->CurrentValue, null, $this->DM_IKLANBERBAYAR->ReadOnly);

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
        $hash .= GetFieldHash($row['DM_CHATTING']); // DM_CHATTING
        $hash .= GetFieldHash($row['DM_MEDSOS']); // DM_MEDSOS
        $hash .= GetFieldHash($row['DM_MP']); // DM_MP
        $hash .= GetFieldHash($row['DM_GMB']); // DM_GMB
        $hash .= GetFieldHash($row['DM_WEB']); // DM_WEB
        $hash .= GetFieldHash($row['DM_UPDATEMEDSOS']); // DM_UPDATEMEDSOS
        $hash .= GetFieldHash($row['DM_UPDATEWEBSITE']); // DM_UPDATEWEBSITE
        $hash .= GetFieldHash($row['DM_GOOGLEINDEX']); // DM_GOOGLEINDEX
        $hash .= GetFieldHash($row['DM_IKLANBERBAYAR']); // DM_IKLANBERBAYAR
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

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fumkm_aspekdigimarklist, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fumkm_aspekdigimarklist, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fumkm_aspekdigimarklist, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_umkm_aspekdigimark" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_umkm_aspekdigimark\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fumkm_aspekdigimarklist, sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
