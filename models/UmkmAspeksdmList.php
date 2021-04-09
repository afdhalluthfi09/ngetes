<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspeksdmList extends UmkmAspeksdm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "list";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspeksdm';

    // Page object name
    public $PageObjName = "UmkmAspeksdmList";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fumkm_aspeksdmlist";
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

        // Table object (umkm_aspeksdm)
        if (!isset($GLOBALS["umkm_aspeksdm"]) || get_class($GLOBALS["umkm_aspeksdm"]) == PROJECT_NAMESPACE . "umkm_aspeksdm") {
            $GLOBALS["umkm_aspeksdm"] = &$this;
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
        $this->AddUrl = "umkmaspeksdmadd";
        $this->InlineAddUrl = $pageUrl . "action=add";
        $this->GridAddUrl = $pageUrl . "action=gridadd";
        $this->GridEditUrl = $pageUrl . "action=gridedit";
        $this->MultiDeleteUrl = "umkmaspeksdmdelete";
        $this->MultiUpdateUrl = "umkmaspeksdmupdate";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspeksdm');
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
        $this->FilterOptions->TagClassName = "ew-filter-option fumkm_aspeksdmlistsrch";

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
                $doc = new $class(Container("umkm_aspeksdm"));
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
        $this->CurrentAction = Param("action"); // Set up current action

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->NIK->setVisibility();
        $this->SDM_OMS->setVisibility();
        $this->SDM_FOKUS->setVisibility();
        $this->SDM_TARGET->setVisibility();
        $this->SDM_KARYAWANTETAP->setVisibility();
        $this->SDM_KARYAWANSUBKON->setVisibility();
        $this->SDM_GAJI->setVisibility();
        $this->SDM_ASURANSI->setVisibility();
        $this->SDM_TUNJANGAN->setVisibility();
        $this->SDM_PELATIHAN->setVisibility();
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
        $this->setupLookupOptions($this->SDM_OMS);
        $this->setupLookupOptions($this->SDM_FOKUS);
        $this->setupLookupOptions($this->SDM_TARGET);
        $this->setupLookupOptions($this->SDM_KARYAWANTETAP);
        $this->setupLookupOptions($this->SDM_KARYAWANSUBKON);
        $this->setupLookupOptions($this->SDM_GAJI);
        $this->setupLookupOptions($this->SDM_ASURANSI);
        $this->setupLookupOptions($this->SDM_TUNJANGAN);
        $this->setupLookupOptions($this->SDM_PELATIHAN);

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
            $this->updateSort($this->SDM_OMS, $ctrl); // SDM_OMS
            $this->updateSort($this->SDM_FOKUS, $ctrl); // SDM_FOKUS
            $this->updateSort($this->SDM_TARGET, $ctrl); // SDM_TARGET
            $this->updateSort($this->SDM_KARYAWANTETAP, $ctrl); // SDM_KARYAWANTETAP
            $this->updateSort($this->SDM_KARYAWANSUBKON, $ctrl); // SDM_KARYAWANSUBKON
            $this->updateSort($this->SDM_GAJI, $ctrl); // SDM_GAJI
            $this->updateSort($this->SDM_ASURANSI, $ctrl); // SDM_ASURANSI
            $this->updateSort($this->SDM_TUNJANGAN, $ctrl); // SDM_TUNJANGAN
            $this->updateSort($this->SDM_PELATIHAN, $ctrl); // SDM_PELATIHAN
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
                $this->SDM_OMS->setSort("");
                $this->SDM_FOKUS->setSort("");
                $this->SDM_TARGET->setSort("");
                $this->SDM_KARYAWANTETAP->setSort("");
                $this->SDM_KARYAWANSUBKON->setSort("");
                $this->SDM_GAJI->setSort("");
                $this->SDM_ASURANSI->setSort("");
                $this->SDM_TUNJANGAN->setSort("");
                $this->SDM_PELATIHAN->setSort("");
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
        $item->Body = "<a class=\"ew-action ew-multi-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteSelectedLink")) . "\" href=\"#\" onclick=\"return ew.submitAction(event, {f:document.fumkm_aspeksdmlist, url:'" . GetUrl($this->MultiDeleteUrl) . "', data:{action:'delete'}, msg:ew.language.phrase('DeleteConfirmMsg')});return false;\">" . $Language->phrase("DeleteSelectedLink") . "</a>";
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
        $item->Body = "<a class=\"ew-save-filter\" data-form=\"fumkm_aspeksdmlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = false;
        $item = &$this->FilterOptions->add("deletefilter");
        $item->Body = "<a class=\"ew-delete-filter\" data-form=\"fumkm_aspeksdmlistsrch\" href=\"#\" onclick=\"return false;\">" . $Language->phrase("DeleteFilter") . "</a>";
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
                $item->Body = '<a class="ew-action ew-list-action" title="' . HtmlEncode($caption) . '" data-caption="' . HtmlEncode($caption) . '" href="#" onclick="return ew.submitAction(event,jQuery.extend({f:document.fumkm_aspeksdmlist},' . $listaction->toJson(true) . '));">' . $icon . '</a>';
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
        $this->SDM_OMS->CurrentValue = null;
        $this->SDM_OMS->OldValue = $this->SDM_OMS->CurrentValue;
        $this->SDM_FOKUS->CurrentValue = null;
        $this->SDM_FOKUS->OldValue = $this->SDM_FOKUS->CurrentValue;
        $this->SDM_TARGET->CurrentValue = null;
        $this->SDM_TARGET->OldValue = $this->SDM_TARGET->CurrentValue;
        $this->SDM_KARYAWANTETAP->CurrentValue = null;
        $this->SDM_KARYAWANTETAP->OldValue = $this->SDM_KARYAWANTETAP->CurrentValue;
        $this->SDM_KARYAWANSUBKON->CurrentValue = null;
        $this->SDM_KARYAWANSUBKON->OldValue = $this->SDM_KARYAWANSUBKON->CurrentValue;
        $this->SDM_GAJI->CurrentValue = null;
        $this->SDM_GAJI->OldValue = $this->SDM_GAJI->CurrentValue;
        $this->SDM_ASURANSI->CurrentValue = null;
        $this->SDM_ASURANSI->OldValue = $this->SDM_ASURANSI->CurrentValue;
        $this->SDM_TUNJANGAN->CurrentValue = null;
        $this->SDM_TUNJANGAN->OldValue = $this->SDM_TUNJANGAN->CurrentValue;
        $this->SDM_PELATIHAN->CurrentValue = null;
        $this->SDM_PELATIHAN->OldValue = $this->SDM_PELATIHAN->CurrentValue;
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

        // Check field name 'SDM_OMS' first before field var 'x_SDM_OMS'
        $val = $CurrentForm->hasValue("SDM_OMS") ? $CurrentForm->getValue("SDM_OMS") : $CurrentForm->getValue("x_SDM_OMS");
        if (!$this->SDM_OMS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_OMS->Visible = false; // Disable update for API request
            } else {
                $this->SDM_OMS->setFormValue($val);
            }
        }

        // Check field name 'SDM_FOKUS' first before field var 'x_SDM_FOKUS'
        $val = $CurrentForm->hasValue("SDM_FOKUS") ? $CurrentForm->getValue("SDM_FOKUS") : $CurrentForm->getValue("x_SDM_FOKUS");
        if (!$this->SDM_FOKUS->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_FOKUS->Visible = false; // Disable update for API request
            } else {
                $this->SDM_FOKUS->setFormValue($val);
            }
        }

        // Check field name 'SDM_TARGET' first before field var 'x_SDM_TARGET'
        $val = $CurrentForm->hasValue("SDM_TARGET") ? $CurrentForm->getValue("SDM_TARGET") : $CurrentForm->getValue("x_SDM_TARGET");
        if (!$this->SDM_TARGET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_TARGET->Visible = false; // Disable update for API request
            } else {
                $this->SDM_TARGET->setFormValue($val);
            }
        }

        // Check field name 'SDM_KARYAWANTETAP' first before field var 'x_SDM_KARYAWANTETAP'
        $val = $CurrentForm->hasValue("SDM_KARYAWANTETAP") ? $CurrentForm->getValue("SDM_KARYAWANTETAP") : $CurrentForm->getValue("x_SDM_KARYAWANTETAP");
        if (!$this->SDM_KARYAWANTETAP->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_KARYAWANTETAP->Visible = false; // Disable update for API request
            } else {
                $this->SDM_KARYAWANTETAP->setFormValue($val);
            }
        }

        // Check field name 'SDM_KARYAWANSUBKON' first before field var 'x_SDM_KARYAWANSUBKON'
        $val = $CurrentForm->hasValue("SDM_KARYAWANSUBKON") ? $CurrentForm->getValue("SDM_KARYAWANSUBKON") : $CurrentForm->getValue("x_SDM_KARYAWANSUBKON");
        if (!$this->SDM_KARYAWANSUBKON->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_KARYAWANSUBKON->Visible = false; // Disable update for API request
            } else {
                $this->SDM_KARYAWANSUBKON->setFormValue($val);
            }
        }

        // Check field name 'SDM_GAJI' first before field var 'x_SDM_GAJI'
        $val = $CurrentForm->hasValue("SDM_GAJI") ? $CurrentForm->getValue("SDM_GAJI") : $CurrentForm->getValue("x_SDM_GAJI");
        if (!$this->SDM_GAJI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_GAJI->Visible = false; // Disable update for API request
            } else {
                $this->SDM_GAJI->setFormValue($val);
            }
        }

        // Check field name 'SDM_ASURANSI' first before field var 'x_SDM_ASURANSI'
        $val = $CurrentForm->hasValue("SDM_ASURANSI") ? $CurrentForm->getValue("SDM_ASURANSI") : $CurrentForm->getValue("x_SDM_ASURANSI");
        if (!$this->SDM_ASURANSI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_ASURANSI->Visible = false; // Disable update for API request
            } else {
                $this->SDM_ASURANSI->setFormValue($val);
            }
        }

        // Check field name 'SDM_TUNJANGAN' first before field var 'x_SDM_TUNJANGAN'
        $val = $CurrentForm->hasValue("SDM_TUNJANGAN") ? $CurrentForm->getValue("SDM_TUNJANGAN") : $CurrentForm->getValue("x_SDM_TUNJANGAN");
        if (!$this->SDM_TUNJANGAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_TUNJANGAN->Visible = false; // Disable update for API request
            } else {
                $this->SDM_TUNJANGAN->setFormValue($val);
            }
        }

        // Check field name 'SDM_PELATIHAN' first before field var 'x_SDM_PELATIHAN'
        $val = $CurrentForm->hasValue("SDM_PELATIHAN") ? $CurrentForm->getValue("SDM_PELATIHAN") : $CurrentForm->getValue("x_SDM_PELATIHAN");
        if (!$this->SDM_PELATIHAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->SDM_PELATIHAN->Visible = false; // Disable update for API request
            } else {
                $this->SDM_PELATIHAN->setFormValue($val);
            }
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->SDM_OMS->CurrentValue = $this->SDM_OMS->FormValue;
        $this->SDM_FOKUS->CurrentValue = $this->SDM_FOKUS->FormValue;
        $this->SDM_TARGET->CurrentValue = $this->SDM_TARGET->FormValue;
        $this->SDM_KARYAWANTETAP->CurrentValue = $this->SDM_KARYAWANTETAP->FormValue;
        $this->SDM_KARYAWANSUBKON->CurrentValue = $this->SDM_KARYAWANSUBKON->FormValue;
        $this->SDM_GAJI->CurrentValue = $this->SDM_GAJI->FormValue;
        $this->SDM_ASURANSI->CurrentValue = $this->SDM_ASURANSI->FormValue;
        $this->SDM_TUNJANGAN->CurrentValue = $this->SDM_TUNJANGAN->FormValue;
        $this->SDM_PELATIHAN->CurrentValue = $this->SDM_PELATIHAN->FormValue;
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
        $this->SDM_OMS->setDbValue($row['SDM_OMS']);
        $this->SDM_FOKUS->setDbValue($row['SDM_FOKUS']);
        $this->SDM_TARGET->setDbValue($row['SDM_TARGET']);
        $this->SDM_KARYAWANTETAP->setDbValue($row['SDM_KARYAWANTETAP']);
        $this->SDM_KARYAWANSUBKON->setDbValue($row['SDM_KARYAWANSUBKON']);
        $this->SDM_GAJI->setDbValue($row['SDM_GAJI']);
        $this->SDM_ASURANSI->setDbValue($row['SDM_ASURANSI']);
        $this->SDM_TUNJANGAN->setDbValue($row['SDM_TUNJANGAN']);
        $this->SDM_PELATIHAN->setDbValue($row['SDM_PELATIHAN']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['SDM_OMS'] = $this->SDM_OMS->CurrentValue;
        $row['SDM_FOKUS'] = $this->SDM_FOKUS->CurrentValue;
        $row['SDM_TARGET'] = $this->SDM_TARGET->CurrentValue;
        $row['SDM_KARYAWANTETAP'] = $this->SDM_KARYAWANTETAP->CurrentValue;
        $row['SDM_KARYAWANSUBKON'] = $this->SDM_KARYAWANSUBKON->CurrentValue;
        $row['SDM_GAJI'] = $this->SDM_GAJI->CurrentValue;
        $row['SDM_ASURANSI'] = $this->SDM_ASURANSI->CurrentValue;
        $row['SDM_TUNJANGAN'] = $this->SDM_TUNJANGAN->CurrentValue;
        $row['SDM_PELATIHAN'] = $this->SDM_PELATIHAN->CurrentValue;
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

        // SDM_OMS

        // SDM_FOKUS

        // SDM_TARGET

        // SDM_KARYAWANTETAP

        // SDM_KARYAWANSUBKON

        // SDM_GAJI

        // SDM_ASURANSI

        // SDM_TUNJANGAN

        // SDM_PELATIHAN
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // SDM_OMS
            $curVal = strval($this->SDM_OMS->CurrentValue);
            if ($curVal != "") {
                $this->SDM_OMS->ViewValue = $this->SDM_OMS->lookupCacheOption($curVal);
                if ($this->SDM_OMS->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='OMS'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_OMS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_OMS->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_OMS->ViewValue = $this->SDM_OMS->displayValue($arwrk);
                    } else {
                        $this->SDM_OMS->ViewValue = $this->SDM_OMS->CurrentValue;
                    }
                }
            } else {
                $this->SDM_OMS->ViewValue = null;
            }
            $this->SDM_OMS->ViewCustomAttributes = "";

            // SDM_FOKUS
            $curVal = strval($this->SDM_FOKUS->CurrentValue);
            if ($curVal != "") {
                $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->lookupCacheOption($curVal);
                if ($this->SDM_FOKUS->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Fokus Usaha'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_FOKUS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_FOKUS->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->displayValue($arwrk);
                    } else {
                        $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->CurrentValue;
                    }
                }
            } else {
                $this->SDM_FOKUS->ViewValue = null;
            }
            $this->SDM_FOKUS->ViewCustomAttributes = "";

            // SDM_TARGET
            $curVal = strval($this->SDM_TARGET->CurrentValue);
            if ($curVal != "") {
                $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->lookupCacheOption($curVal);
                if ($this->SDM_TARGET->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Target'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_TARGET->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_TARGET->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->displayValue($arwrk);
                    } else {
                        $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->CurrentValue;
                    }
                }
            } else {
                $this->SDM_TARGET->ViewValue = null;
            }
            $this->SDM_TARGET->ViewCustomAttributes = "";

            // SDM_KARYAWANTETAP
            $curVal = strval($this->SDM_KARYAWANTETAP->CurrentValue);
            if ($curVal != "") {
                $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->lookupCacheOption($curVal);
                if ($this->SDM_KARYAWANTETAP->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Karyawan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_KARYAWANTETAP->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_KARYAWANTETAP->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->displayValue($arwrk);
                    } else {
                        $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->CurrentValue;
                    }
                }
            } else {
                $this->SDM_KARYAWANTETAP->ViewValue = null;
            }
            $this->SDM_KARYAWANTETAP->ViewCustomAttributes = "";

            // SDM_KARYAWANSUBKON
            $curVal = strval($this->SDM_KARYAWANSUBKON->CurrentValue);
            if ($curVal != "") {
                $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->lookupCacheOption($curVal);
                if ($this->SDM_KARYAWANSUBKON->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Outsource'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_KARYAWANSUBKON->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_KARYAWANSUBKON->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->displayValue($arwrk);
                    } else {
                        $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->CurrentValue;
                    }
                }
            } else {
                $this->SDM_KARYAWANSUBKON->ViewValue = null;
            }
            $this->SDM_KARYAWANSUBKON->ViewCustomAttributes = "";

            // SDM_GAJI
            $curVal = strval($this->SDM_GAJI->CurrentValue);
            if ($curVal != "") {
                $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->lookupCacheOption($curVal);
                if ($this->SDM_GAJI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='UMR'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_GAJI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_GAJI->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->displayValue($arwrk);
                    } else {
                        $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->CurrentValue;
                    }
                }
            } else {
                $this->SDM_GAJI->ViewValue = null;
            }
            $this->SDM_GAJI->ViewCustomAttributes = "";

            // SDM_ASURANSI
            $curVal = strval($this->SDM_ASURANSI->CurrentValue);
            if ($curVal != "") {
                $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->lookupCacheOption($curVal);
                if ($this->SDM_ASURANSI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Asuransi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_ASURANSI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_ASURANSI->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->displayValue($arwrk);
                    } else {
                        $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->CurrentValue;
                    }
                }
            } else {
                $this->SDM_ASURANSI->ViewValue = null;
            }
            $this->SDM_ASURANSI->ViewCustomAttributes = "";

            // SDM_TUNJANGAN
            $curVal = strval($this->SDM_TUNJANGAN->CurrentValue);
            if ($curVal != "") {
                $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->lookupCacheOption($curVal);
                if ($this->SDM_TUNJANGAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='THR'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_TUNJANGAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_TUNJANGAN->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->displayValue($arwrk);
                    } else {
                        $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->CurrentValue;
                    }
                }
            } else {
                $this->SDM_TUNJANGAN->ViewValue = null;
            }
            $this->SDM_TUNJANGAN->ViewCustomAttributes = "";

            // SDM_PELATIHAN
            $curVal = strval($this->SDM_PELATIHAN->CurrentValue);
            if ($curVal != "") {
                $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->lookupCacheOption($curVal);
                if ($this->SDM_PELATIHAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Training'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SDM_PELATIHAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SDM_PELATIHAN->Lookup->renderViewRow($rswrk[0]);
                        $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->displayValue($arwrk);
                    } else {
                        $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->CurrentValue;
                    }
                }
            } else {
                $this->SDM_PELATIHAN->ViewValue = null;
            }
            $this->SDM_PELATIHAN->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // SDM_OMS
            $this->SDM_OMS->LinkCustomAttributes = "";
            $this->SDM_OMS->HrefValue = "";
            $this->SDM_OMS->TooltipValue = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->LinkCustomAttributes = "";
            $this->SDM_FOKUS->HrefValue = "";
            $this->SDM_FOKUS->TooltipValue = "";

            // SDM_TARGET
            $this->SDM_TARGET->LinkCustomAttributes = "";
            $this->SDM_TARGET->HrefValue = "";
            $this->SDM_TARGET->TooltipValue = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->HrefValue = "";
            $this->SDM_KARYAWANTETAP->TooltipValue = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->HrefValue = "";
            $this->SDM_KARYAWANSUBKON->TooltipValue = "";

            // SDM_GAJI
            $this->SDM_GAJI->LinkCustomAttributes = "";
            $this->SDM_GAJI->HrefValue = "";
            $this->SDM_GAJI->TooltipValue = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->LinkCustomAttributes = "";
            $this->SDM_ASURANSI->HrefValue = "";
            $this->SDM_ASURANSI->TooltipValue = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
            $this->SDM_TUNJANGAN->HrefValue = "";
            $this->SDM_TUNJANGAN->TooltipValue = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->LinkCustomAttributes = "";
            $this->SDM_PELATIHAN->HrefValue = "";
            $this->SDM_PELATIHAN->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // SDM_OMS
            $this->SDM_OMS->EditAttrs["class"] = "form-control";
            $this->SDM_OMS->EditCustomAttributes = "";
            $this->SDM_OMS->PlaceHolder = RemoveHtml($this->SDM_OMS->caption());

            // SDM_FOKUS
            $this->SDM_FOKUS->EditAttrs["class"] = "form-control";
            $this->SDM_FOKUS->EditCustomAttributes = "";
            $this->SDM_FOKUS->PlaceHolder = RemoveHtml($this->SDM_FOKUS->caption());

            // SDM_TARGET
            $this->SDM_TARGET->EditAttrs["class"] = "form-control";
            $this->SDM_TARGET->EditCustomAttributes = "";
            $this->SDM_TARGET->PlaceHolder = RemoveHtml($this->SDM_TARGET->caption());

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANTETAP->EditCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->PlaceHolder = RemoveHtml($this->SDM_KARYAWANTETAP->caption());

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANSUBKON->EditCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->PlaceHolder = RemoveHtml($this->SDM_KARYAWANSUBKON->caption());

            // SDM_GAJI
            $this->SDM_GAJI->EditAttrs["class"] = "form-control";
            $this->SDM_GAJI->EditCustomAttributes = "";
            $this->SDM_GAJI->PlaceHolder = RemoveHtml($this->SDM_GAJI->caption());

            // SDM_ASURANSI
            $this->SDM_ASURANSI->EditAttrs["class"] = "form-control";
            $this->SDM_ASURANSI->EditCustomAttributes = "";
            $this->SDM_ASURANSI->PlaceHolder = RemoveHtml($this->SDM_ASURANSI->caption());

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->EditAttrs["class"] = "form-control";
            $this->SDM_TUNJANGAN->EditCustomAttributes = "";
            $this->SDM_TUNJANGAN->PlaceHolder = RemoveHtml($this->SDM_TUNJANGAN->caption());

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->EditAttrs["class"] = "form-control";
            $this->SDM_PELATIHAN->EditCustomAttributes = "";
            $this->SDM_PELATIHAN->PlaceHolder = RemoveHtml($this->SDM_PELATIHAN->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // SDM_OMS
            $this->SDM_OMS->LinkCustomAttributes = "";
            $this->SDM_OMS->HrefValue = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->LinkCustomAttributes = "";
            $this->SDM_FOKUS->HrefValue = "";

            // SDM_TARGET
            $this->SDM_TARGET->LinkCustomAttributes = "";
            $this->SDM_TARGET->HrefValue = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->HrefValue = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->HrefValue = "";

            // SDM_GAJI
            $this->SDM_GAJI->LinkCustomAttributes = "";
            $this->SDM_GAJI->HrefValue = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->LinkCustomAttributes = "";
            $this->SDM_ASURANSI->HrefValue = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
            $this->SDM_TUNJANGAN->HrefValue = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->LinkCustomAttributes = "";
            $this->SDM_PELATIHAN->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK

            // SDM_OMS
            $this->SDM_OMS->EditAttrs["class"] = "form-control";
            $this->SDM_OMS->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_OMS->CurrentValue));
            if ($curVal != "") {
                $this->SDM_OMS->ViewValue = $this->SDM_OMS->lookupCacheOption($curVal);
            } else {
                $this->SDM_OMS->ViewValue = $this->SDM_OMS->Lookup !== null && is_array($this->SDM_OMS->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_OMS->ViewValue !== null) { // Load from cache
                $this->SDM_OMS->EditValue = array_values($this->SDM_OMS->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_OMS->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='OMS'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_OMS->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_OMS->EditValue = $arwrk;
            }
            $this->SDM_OMS->PlaceHolder = RemoveHtml($this->SDM_OMS->caption());

            // SDM_FOKUS
            $this->SDM_FOKUS->EditAttrs["class"] = "form-control";
            $this->SDM_FOKUS->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_FOKUS->CurrentValue));
            if ($curVal != "") {
                $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->lookupCacheOption($curVal);
            } else {
                $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->Lookup !== null && is_array($this->SDM_FOKUS->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_FOKUS->ViewValue !== null) { // Load from cache
                $this->SDM_FOKUS->EditValue = array_values($this->SDM_FOKUS->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_FOKUS->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Fokus Usaha'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_FOKUS->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_FOKUS->EditValue = $arwrk;
            }
            $this->SDM_FOKUS->PlaceHolder = RemoveHtml($this->SDM_FOKUS->caption());

            // SDM_TARGET
            $this->SDM_TARGET->EditAttrs["class"] = "form-control";
            $this->SDM_TARGET->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_TARGET->CurrentValue));
            if ($curVal != "") {
                $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->lookupCacheOption($curVal);
            } else {
                $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->Lookup !== null && is_array($this->SDM_TARGET->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_TARGET->ViewValue !== null) { // Load from cache
                $this->SDM_TARGET->EditValue = array_values($this->SDM_TARGET->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_TARGET->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Target'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_TARGET->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_TARGET->EditValue = $arwrk;
            }
            $this->SDM_TARGET->PlaceHolder = RemoveHtml($this->SDM_TARGET->caption());

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANTETAP->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_KARYAWANTETAP->CurrentValue));
            if ($curVal != "") {
                $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->lookupCacheOption($curVal);
            } else {
                $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->Lookup !== null && is_array($this->SDM_KARYAWANTETAP->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_KARYAWANTETAP->ViewValue !== null) { // Load from cache
                $this->SDM_KARYAWANTETAP->EditValue = array_values($this->SDM_KARYAWANTETAP->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_KARYAWANTETAP->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Karyawan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_KARYAWANTETAP->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_KARYAWANTETAP->EditValue = $arwrk;
            }
            $this->SDM_KARYAWANTETAP->PlaceHolder = RemoveHtml($this->SDM_KARYAWANTETAP->caption());

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->EditAttrs["class"] = "form-control";
            $this->SDM_KARYAWANSUBKON->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_KARYAWANSUBKON->CurrentValue));
            if ($curVal != "") {
                $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->lookupCacheOption($curVal);
            } else {
                $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->Lookup !== null && is_array($this->SDM_KARYAWANSUBKON->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_KARYAWANSUBKON->ViewValue !== null) { // Load from cache
                $this->SDM_KARYAWANSUBKON->EditValue = array_values($this->SDM_KARYAWANSUBKON->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_KARYAWANSUBKON->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Outsource'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_KARYAWANSUBKON->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_KARYAWANSUBKON->EditValue = $arwrk;
            }
            $this->SDM_KARYAWANSUBKON->PlaceHolder = RemoveHtml($this->SDM_KARYAWANSUBKON->caption());

            // SDM_GAJI
            $this->SDM_GAJI->EditAttrs["class"] = "form-control";
            $this->SDM_GAJI->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_GAJI->CurrentValue));
            if ($curVal != "") {
                $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->lookupCacheOption($curVal);
            } else {
                $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->Lookup !== null && is_array($this->SDM_GAJI->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_GAJI->ViewValue !== null) { // Load from cache
                $this->SDM_GAJI->EditValue = array_values($this->SDM_GAJI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_GAJI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='UMR'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_GAJI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_GAJI->EditValue = $arwrk;
            }
            $this->SDM_GAJI->PlaceHolder = RemoveHtml($this->SDM_GAJI->caption());

            // SDM_ASURANSI
            $this->SDM_ASURANSI->EditAttrs["class"] = "form-control";
            $this->SDM_ASURANSI->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_ASURANSI->CurrentValue));
            if ($curVal != "") {
                $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->lookupCacheOption($curVal);
            } else {
                $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->Lookup !== null && is_array($this->SDM_ASURANSI->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_ASURANSI->ViewValue !== null) { // Load from cache
                $this->SDM_ASURANSI->EditValue = array_values($this->SDM_ASURANSI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_ASURANSI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Asuransi'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_ASURANSI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_ASURANSI->EditValue = $arwrk;
            }
            $this->SDM_ASURANSI->PlaceHolder = RemoveHtml($this->SDM_ASURANSI->caption());

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->EditAttrs["class"] = "form-control";
            $this->SDM_TUNJANGAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_TUNJANGAN->CurrentValue));
            if ($curVal != "") {
                $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->lookupCacheOption($curVal);
            } else {
                $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->Lookup !== null && is_array($this->SDM_TUNJANGAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_TUNJANGAN->ViewValue !== null) { // Load from cache
                $this->SDM_TUNJANGAN->EditValue = array_values($this->SDM_TUNJANGAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_TUNJANGAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='THR'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_TUNJANGAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_TUNJANGAN->EditValue = $arwrk;
            }
            $this->SDM_TUNJANGAN->PlaceHolder = RemoveHtml($this->SDM_TUNJANGAN->caption());

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->EditAttrs["class"] = "form-control";
            $this->SDM_PELATIHAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->SDM_PELATIHAN->CurrentValue));
            if ($curVal != "") {
                $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->lookupCacheOption($curVal);
            } else {
                $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->Lookup !== null && is_array($this->SDM_PELATIHAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->SDM_PELATIHAN->ViewValue !== null) { // Load from cache
                $this->SDM_PELATIHAN->EditValue = array_values($this->SDM_PELATIHAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->SDM_PELATIHAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Training'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SDM_PELATIHAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->SDM_PELATIHAN->EditValue = $arwrk;
            }
            $this->SDM_PELATIHAN->PlaceHolder = RemoveHtml($this->SDM_PELATIHAN->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // SDM_OMS
            $this->SDM_OMS->LinkCustomAttributes = "";
            $this->SDM_OMS->HrefValue = "";

            // SDM_FOKUS
            $this->SDM_FOKUS->LinkCustomAttributes = "";
            $this->SDM_FOKUS->HrefValue = "";

            // SDM_TARGET
            $this->SDM_TARGET->LinkCustomAttributes = "";
            $this->SDM_TARGET->HrefValue = "";

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
            $this->SDM_KARYAWANTETAP->HrefValue = "";

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
            $this->SDM_KARYAWANSUBKON->HrefValue = "";

            // SDM_GAJI
            $this->SDM_GAJI->LinkCustomAttributes = "";
            $this->SDM_GAJI->HrefValue = "";

            // SDM_ASURANSI
            $this->SDM_ASURANSI->LinkCustomAttributes = "";
            $this->SDM_ASURANSI->HrefValue = "";

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
            $this->SDM_TUNJANGAN->HrefValue = "";

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->LinkCustomAttributes = "";
            $this->SDM_PELATIHAN->HrefValue = "";
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
        if ($this->SDM_OMS->Required) {
            if (!$this->SDM_OMS->IsDetailKey && EmptyValue($this->SDM_OMS->FormValue)) {
                $this->SDM_OMS->addErrorMessage(str_replace("%s", $this->SDM_OMS->caption(), $this->SDM_OMS->RequiredErrorMessage));
            }
        }
        if ($this->SDM_FOKUS->Required) {
            if (!$this->SDM_FOKUS->IsDetailKey && EmptyValue($this->SDM_FOKUS->FormValue)) {
                $this->SDM_FOKUS->addErrorMessage(str_replace("%s", $this->SDM_FOKUS->caption(), $this->SDM_FOKUS->RequiredErrorMessage));
            }
        }
        if ($this->SDM_TARGET->Required) {
            if (!$this->SDM_TARGET->IsDetailKey && EmptyValue($this->SDM_TARGET->FormValue)) {
                $this->SDM_TARGET->addErrorMessage(str_replace("%s", $this->SDM_TARGET->caption(), $this->SDM_TARGET->RequiredErrorMessage));
            }
        }
        if ($this->SDM_KARYAWANTETAP->Required) {
            if (!$this->SDM_KARYAWANTETAP->IsDetailKey && EmptyValue($this->SDM_KARYAWANTETAP->FormValue)) {
                $this->SDM_KARYAWANTETAP->addErrorMessage(str_replace("%s", $this->SDM_KARYAWANTETAP->caption(), $this->SDM_KARYAWANTETAP->RequiredErrorMessage));
            }
        }
        if ($this->SDM_KARYAWANSUBKON->Required) {
            if (!$this->SDM_KARYAWANSUBKON->IsDetailKey && EmptyValue($this->SDM_KARYAWANSUBKON->FormValue)) {
                $this->SDM_KARYAWANSUBKON->addErrorMessage(str_replace("%s", $this->SDM_KARYAWANSUBKON->caption(), $this->SDM_KARYAWANSUBKON->RequiredErrorMessage));
            }
        }
        if ($this->SDM_GAJI->Required) {
            if (!$this->SDM_GAJI->IsDetailKey && EmptyValue($this->SDM_GAJI->FormValue)) {
                $this->SDM_GAJI->addErrorMessage(str_replace("%s", $this->SDM_GAJI->caption(), $this->SDM_GAJI->RequiredErrorMessage));
            }
        }
        if ($this->SDM_ASURANSI->Required) {
            if (!$this->SDM_ASURANSI->IsDetailKey && EmptyValue($this->SDM_ASURANSI->FormValue)) {
                $this->SDM_ASURANSI->addErrorMessage(str_replace("%s", $this->SDM_ASURANSI->caption(), $this->SDM_ASURANSI->RequiredErrorMessage));
            }
        }
        if ($this->SDM_TUNJANGAN->Required) {
            if (!$this->SDM_TUNJANGAN->IsDetailKey && EmptyValue($this->SDM_TUNJANGAN->FormValue)) {
                $this->SDM_TUNJANGAN->addErrorMessage(str_replace("%s", $this->SDM_TUNJANGAN->caption(), $this->SDM_TUNJANGAN->RequiredErrorMessage));
            }
        }
        if ($this->SDM_PELATIHAN->Required) {
            if (!$this->SDM_PELATIHAN->IsDetailKey && EmptyValue($this->SDM_PELATIHAN->FormValue)) {
                $this->SDM_PELATIHAN->addErrorMessage(str_replace("%s", $this->SDM_PELATIHAN->caption(), $this->SDM_PELATIHAN->RequiredErrorMessage));
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

            // SDM_OMS
            $this->SDM_OMS->setDbValueDef($rsnew, $this->SDM_OMS->CurrentValue, null, $this->SDM_OMS->ReadOnly);

            // SDM_FOKUS
            $this->SDM_FOKUS->setDbValueDef($rsnew, $this->SDM_FOKUS->CurrentValue, null, $this->SDM_FOKUS->ReadOnly);

            // SDM_TARGET
            $this->SDM_TARGET->setDbValueDef($rsnew, $this->SDM_TARGET->CurrentValue, null, $this->SDM_TARGET->ReadOnly);

            // SDM_KARYAWANTETAP
            $this->SDM_KARYAWANTETAP->setDbValueDef($rsnew, $this->SDM_KARYAWANTETAP->CurrentValue, null, $this->SDM_KARYAWANTETAP->ReadOnly);

            // SDM_KARYAWANSUBKON
            $this->SDM_KARYAWANSUBKON->setDbValueDef($rsnew, $this->SDM_KARYAWANSUBKON->CurrentValue, null, $this->SDM_KARYAWANSUBKON->ReadOnly);

            // SDM_GAJI
            $this->SDM_GAJI->setDbValueDef($rsnew, $this->SDM_GAJI->CurrentValue, null, $this->SDM_GAJI->ReadOnly);

            // SDM_ASURANSI
            $this->SDM_ASURANSI->setDbValueDef($rsnew, $this->SDM_ASURANSI->CurrentValue, null, $this->SDM_ASURANSI->ReadOnly);

            // SDM_TUNJANGAN
            $this->SDM_TUNJANGAN->setDbValueDef($rsnew, $this->SDM_TUNJANGAN->CurrentValue, null, $this->SDM_TUNJANGAN->ReadOnly);

            // SDM_PELATIHAN
            $this->SDM_PELATIHAN->setDbValueDef($rsnew, $this->SDM_PELATIHAN->CurrentValue, null, $this->SDM_PELATIHAN->ReadOnly);

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
        $hash .= GetFieldHash($row['SDM_OMS']); // SDM_OMS
        $hash .= GetFieldHash($row['SDM_FOKUS']); // SDM_FOKUS
        $hash .= GetFieldHash($row['SDM_TARGET']); // SDM_TARGET
        $hash .= GetFieldHash($row['SDM_KARYAWANTETAP']); // SDM_KARYAWANTETAP
        $hash .= GetFieldHash($row['SDM_KARYAWANSUBKON']); // SDM_KARYAWANSUBKON
        $hash .= GetFieldHash($row['SDM_GAJI']); // SDM_GAJI
        $hash .= GetFieldHash($row['SDM_ASURANSI']); // SDM_ASURANSI
        $hash .= GetFieldHash($row['SDM_TUNJANGAN']); // SDM_TUNJANGAN
        $hash .= GetFieldHash($row['SDM_PELATIHAN']); // SDM_PELATIHAN
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

        // SDM_OMS
        $this->SDM_OMS->setDbValueDef($rsnew, $this->SDM_OMS->CurrentValue, null, false);

        // SDM_FOKUS
        $this->SDM_FOKUS->setDbValueDef($rsnew, $this->SDM_FOKUS->CurrentValue, null, false);

        // SDM_TARGET
        $this->SDM_TARGET->setDbValueDef($rsnew, $this->SDM_TARGET->CurrentValue, null, false);

        // SDM_KARYAWANTETAP
        $this->SDM_KARYAWANTETAP->setDbValueDef($rsnew, $this->SDM_KARYAWANTETAP->CurrentValue, null, false);

        // SDM_KARYAWANSUBKON
        $this->SDM_KARYAWANSUBKON->setDbValueDef($rsnew, $this->SDM_KARYAWANSUBKON->CurrentValue, null, false);

        // SDM_GAJI
        $this->SDM_GAJI->setDbValueDef($rsnew, $this->SDM_GAJI->CurrentValue, null, false);

        // SDM_ASURANSI
        $this->SDM_ASURANSI->setDbValueDef($rsnew, $this->SDM_ASURANSI->CurrentValue, null, false);

        // SDM_TUNJANGAN
        $this->SDM_TUNJANGAN->setDbValueDef($rsnew, $this->SDM_TUNJANGAN->CurrentValue, null, false);

        // SDM_PELATIHAN
        $this->SDM_PELATIHAN->setDbValueDef($rsnew, $this->SDM_PELATIHAN->CurrentValue, null, false);

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
                case "x_SDM_OMS":
                    $lookupFilter = function () {
                        return "`subkat`='OMS'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_FOKUS":
                    $lookupFilter = function () {
                        return "`subkat`='Fokus Usaha'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_TARGET":
                    $lookupFilter = function () {
                        return "`subkat`='Target'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_KARYAWANTETAP":
                    $lookupFilter = function () {
                        return "`subkat`='Karyawan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_KARYAWANSUBKON":
                    $lookupFilter = function () {
                        return "`subkat`='Outsource'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_GAJI":
                    $lookupFilter = function () {
                        return "`subkat`='UMR'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_ASURANSI":
                    $lookupFilter = function () {
                        return "`subkat`='Asuransi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_TUNJANGAN":
                    $lookupFilter = function () {
                        return "`subkat`='THR'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SDM_PELATIHAN":
                    $lookupFilter = function () {
                        return "`subkat`='Training'";
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
