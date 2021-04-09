<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekkeuanganGrid extends UmkmAspekkeuangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "grid";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekkeuangan';

    // Page object name
    public $PageObjName = "UmkmAspekkeuanganGrid";

    // Rendering View
    public $RenderingView = false;

    // Grid form hidden field names
    public $FormName = "fumkm_aspekkeuangangrid";
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
        $this->FormActionName .= "_" . $this->FormName;
        $this->OldKeyName .= "_" . $this->FormName;
        $this->FormBlankRowName .= "_" . $this->FormName;
        $this->FormKeyCountName .= "_" . $this->FormName;
        $GLOBALS["Grid"] = &$this;

        // Language object
        $Language = Container("language");

        // Parent constuctor
        parent::__construct();

        // Table object (umkm_aspekkeuangan)
        if (!isset($GLOBALS["umkm_aspekkeuangan"]) || get_class($GLOBALS["umkm_aspekkeuangan"]) == PROJECT_NAMESPACE . "umkm_aspekkeuangan") {
            $GLOBALS["umkm_aspekkeuangan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        $this->AddUrl = "umkmaspekkeuanganadd";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekkeuangan');
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

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["addedit"] = new ListOptions("div");
        $this->OtherOptions["addedit"]->TagClassName = "ew-add-edit-option";
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

        // Export
        if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, Config("EXPORT_CLASSES"))) {
            $content = $this->getContents();
            if ($ExportFileName == "") {
                $ExportFileName = $this->TableVar;
            }
            $class = PROJECT_NAMESPACE . Config("EXPORT_CLASSES." . $this->CustomExport);
            if (class_exists($class)) {
                $doc = new $class(Container("umkm_aspekkeuangan"));
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
        unset($GLOBALS["Grid"]);
        if ($url === "") {
            return;
        }
        if (!IsApi() && method_exists($this, "pageRedirecting")) {
            $this->pageRedirecting($url);
        }

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
    public $ShowOtherOptions = false;
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

        // Get grid add count
        $gridaddcnt = Get(Config("TABLE_GRID_ADD_ROW_COUNT"), "");
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0) {
            $this->GridAddRowCount = $gridaddcnt;
        }

        // Set up list options
        $this->setupListOptions();
        $this->NIK->setVisibility();
        $this->KEU_USAHAUTAMA->setVisibility();
        $this->KEU_PENGELOLAAN->setVisibility();
        $this->KEU_NOTA->setVisibility();
        $this->KEU_PENCATATAN->setVisibility();
        $this->KEU_LAPORAN->setVisibility();
        $this->KEU_UTANGMODAL->setVisibility();
        $this->KEU_CATATNASET->setVisibility();
        $this->KEU_NONTUNAI->setVisibility();
        $this->hideFieldsForAddEdit();

        // Global Page Loading event (in userfn*.php)
        Page_Loading();

        // Page Load event
        if (method_exists($this, "pageLoad")) {
            $this->pageLoad();
        }

        // Set up master detail parameters
        $this->setupMasterParms();

        // Setup other options
        $this->setupOtherOptions();

        // Set up lookup cache
        $this->setupLookupOptions($this->KEU_USAHAUTAMA);
        $this->setupLookupOptions($this->KEU_PENGELOLAAN);
        $this->setupLookupOptions($this->KEU_NOTA);
        $this->setupLookupOptions($this->KEU_PENCATATAN);
        $this->setupLookupOptions($this->KEU_LAPORAN);
        $this->setupLookupOptions($this->KEU_UTANGMODAL);
        $this->setupLookupOptions($this->KEU_CATATNASET);
        $this->setupLookupOptions($this->KEU_NONTUNAI);

        // Search filters
        $srchAdvanced = ""; // Advanced search filter
        $srchBasic = ""; // Basic search filter
        $filter = "";

        // Get command
        $this->Command = strtolower(Get("cmd"));
        if ($this->isPageRequest()) {
            // Set up records per page
            $this->setupDisplayRecords();

            // Handle reset command
            $this->resetCmd();

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

            // Show grid delete link for grid add / grid edit
            if ($this->AllowAddDeleteRow) {
                if ($this->isGridAdd() || $this->isGridEdit()) {
                    $item = $this->ListOptions["griddelete"];
                    if ($item) {
                        $item->Visible = true;
                    }
                }
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

        // Restore master/detail filter
        $this->DbMasterFilter = $this->getMasterFilter(); // Restore master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Restore detail filter
        AddFilter($filter, $this->DbDetailFilter);
        AddFilter($filter, $this->SearchWhere);

        // Load master record
        if ($this->CurrentMode != "add" && $this->getMasterFilter() != "" && $this->getCurrentMasterTable() == "umkm_datadiri") {
            $masterTbl = Container("umkm_datadiri");
            $rsmaster = $masterTbl->loadRs($this->DbMasterFilter)->fetch(\PDO::FETCH_ASSOC);
            $this->MasterRecordExists = $rsmaster !== false;
            if (!$this->MasterRecordExists) {
                $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record found
                $this->terminate("umkmdatadirilist"); // Return to master page
                return;
            } else {
                $masterTbl->loadListRowValues($rsmaster);
                $masterTbl->RowType = ROWTYPE_MASTER; // Master row
                $masterTbl->renderListRow();
            }
        }

        // Set up filter
        if ($this->Command == "json") {
            $this->UseSessionForListSql = false; // Do not use session for ListSQL
            $this->CurrentFilter = $filter;
        } else {
            $this->setSessionWhere($filter);
            $this->CurrentFilter = "";
        }
        if ($this->isGridAdd()) {
            if ($this->CurrentMode == "copy") {
                $this->TotalRecords = $this->listRecordCount();
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->TotalRecords;
                $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
            } else {
                $this->CurrentFilter = "0=1";
                $this->StartRecord = 1;
                $this->DisplayRecords = $this->GridAddRowCount;
            }
            $this->TotalRecords = $this->DisplayRecords;
            $this->StopRecord = $this->DisplayRecords;
        } else {
            $this->TotalRecords = $this->listRecordCount();
            $this->StartRecord = 1;
            $this->DisplayRecords = $this->TotalRecords; // Display all records
            $this->Recordset = $this->loadRecordset($this->StartRecord - 1, $this->DisplayRecords);
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

    // Switch to Grid Add mode
    protected function gridAddMode()
    {
        $this->CurrentAction = "gridadd";
        $_SESSION[SESSION_INLINE_MODE] = "gridadd";
        $this->hideFieldsForAddEdit();
    }

    // Switch to Grid Edit mode
    protected function gridEditMode()
    {
        $this->CurrentAction = "gridedit";
        $_SESSION[SESSION_INLINE_MODE] = "gridedit";
        $this->hideFieldsForAddEdit();
    }

    // Perform update to grid
    public function gridUpdate()
    {
        global $Language, $CurrentForm;
        $gridUpdate = true;

        // Get old recordset
        $this->CurrentFilter = $this->buildKeyFilter();
        if ($this->CurrentFilter == "") {
            $this->CurrentFilter = "0=1";
        }
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        if ($rs = $conn->executeQuery($sql)) {
            $rsold = $rs->fetchAll();
            $rs->closeCursor();
        }

        // Call Grid Updating event
        if (!$this->gridUpdating($rsold)) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridEditCancelled")); // Set grid edit cancelled message
            }
            return false;
        }
        $key = "";

        // Update row index and get row key
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Update all rows based on key
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            $CurrentForm->Index = $rowindex;
            $this->setKey($CurrentForm->getValue($this->OldKeyName));
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));

            // Load all values and keys
            if ($rowaction != "insertdelete") { // Skip insert then deleted rows
                $this->loadFormValues(); // Get form values
                if ($rowaction == "" || $rowaction == "edit" || $rowaction == "delete") {
                    $gridUpdate = $this->OldKey != ""; // Key must not be empty
                } else {
                    $gridUpdate = true;
                }

                // Skip empty row
                if ($rowaction == "insert" && $this->emptyRow()) {
                // Validate form and insert/update/delete record
                } elseif ($gridUpdate) {
                    if ($rowaction == "delete") {
                        $this->CurrentFilter = $this->getRecordFilter();
                        $gridUpdate = $this->deleteRows(); // Delete this row
                    //} elseif (!$this->validateForm()) { // Already done in validateGridForm
                    //    $gridUpdate = false; // Form error, reset action
                    } else {
                        if ($rowaction == "insert") {
                            $gridUpdate = $this->addRow(); // Insert this row
                        } else {
                            if ($this->OldKey != "") {
                                $this->SendEmail = false; // Do not send email on update success
                                $gridUpdate = $this->editRow(); // Update this row
                            }
                        } // End update
                    }
                }
                if ($gridUpdate) {
                    if ($key != "") {
                        $key .= ", ";
                    }
                    $key .= $this->OldKey;
                } else {
                    break;
                }
            }
        }
        if ($gridUpdate) {
            // Get new records
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Updated event
            $this->gridUpdated($rsold, $rsnew);
            $this->clearInlineMode(); // Clear inline edit mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("UpdateFailed")); // Set update failed message
            }
        }
        return $gridUpdate;
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

    // Perform Grid Add
    public function gridInsert()
    {
        global $Language, $CurrentForm;
        $rowindex = 1;
        $gridInsert = false;
        $conn = $this->getConnection();

        // Call Grid Inserting event
        if (!$this->gridInserting()) {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("GridAddCancelled")); // Set grid add cancelled message
            }
            return false;
        }

        // Init key filter
        $wrkfilter = "";
        $addcnt = 0;
        $key = "";

        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Insert all rows
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "" && $rowaction != "insert") {
                continue; // Skip
            }
            if ($rowaction == "insert") {
                $this->OldKey = strval($CurrentForm->getValue($this->OldKeyName));
                $this->loadOldRecord(); // Load old record
            }
            $this->loadFormValues(); // Get form values
            if (!$this->emptyRow()) {
                $addcnt++;
                $this->SendEmail = false; // Do not send email on insert success

                // Validate form // Already done in validateGridForm
                //if (!$this->validateForm()) {
                //    $gridInsert = false; // Form error, reset action
                //} else {
                    $gridInsert = $this->addRow($this->OldRecordset); // Insert this row
                //}
                if ($gridInsert) {
                    if ($key != "") {
                        $key .= Config("COMPOSITE_KEY_SEPARATOR");
                    }
                    $key .= $this->NIK->CurrentValue;

                    // Add filter for this record
                    $filter = $this->getRecordFilter();
                    if ($wrkfilter != "") {
                        $wrkfilter .= " OR ";
                    }
                    $wrkfilter .= $filter;
                } else {
                    break;
                }
            }
        }
        if ($addcnt == 0) { // No record inserted
            $this->clearInlineMode(); // Clear grid add mode and return
            return true;
        }
        if ($gridInsert) {
            // Get new records
            $this->CurrentFilter = $wrkfilter;
            $sql = $this->getCurrentSql();
            $rsnew = $conn->fetchAll($sql);

            // Call Grid_Inserted event
            $this->gridInserted($rsnew);
            $this->clearInlineMode(); // Clear grid add mode
        } else {
            if ($this->getFailureMessage() == "") {
                $this->setFailureMessage($Language->phrase("InsertFailed")); // Set insert failed message
            }
        }
        return $gridInsert;
    }

    // Check if empty row
    public function emptyRow()
    {
        global $CurrentForm;
        if ($CurrentForm->hasValue("x_KEU_USAHAUTAMA") && $CurrentForm->hasValue("o_KEU_USAHAUTAMA") && $this->KEU_USAHAUTAMA->CurrentValue != $this->KEU_USAHAUTAMA->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_PENGELOLAAN") && $CurrentForm->hasValue("o_KEU_PENGELOLAAN") && $this->KEU_PENGELOLAAN->CurrentValue != $this->KEU_PENGELOLAAN->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_NOTA") && $CurrentForm->hasValue("o_KEU_NOTA") && $this->KEU_NOTA->CurrentValue != $this->KEU_NOTA->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_PENCATATAN") && $CurrentForm->hasValue("o_KEU_PENCATATAN") && $this->KEU_PENCATATAN->CurrentValue != $this->KEU_PENCATATAN->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_LAPORAN") && $CurrentForm->hasValue("o_KEU_LAPORAN") && $this->KEU_LAPORAN->CurrentValue != $this->KEU_LAPORAN->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_UTANGMODAL") && $CurrentForm->hasValue("o_KEU_UTANGMODAL") && $this->KEU_UTANGMODAL->CurrentValue != $this->KEU_UTANGMODAL->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_CATATNASET") && $CurrentForm->hasValue("o_KEU_CATATNASET") && $this->KEU_CATATNASET->CurrentValue != $this->KEU_CATATNASET->OldValue) {
            return false;
        }
        if ($CurrentForm->hasValue("x_KEU_NONTUNAI") && $CurrentForm->hasValue("o_KEU_NONTUNAI") && $this->KEU_NONTUNAI->CurrentValue != $this->KEU_NONTUNAI->OldValue) {
            return false;
        }
        return true;
    }

    // Validate grid form
    public function validateGridForm()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }

        // Validate all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } elseif (!$this->validateForm()) {
                    return false;
                }
            }
        }
        return true;
    }

    // Get all form values of the grid
    public function getGridFormValues()
    {
        global $CurrentForm;
        // Get row count
        $CurrentForm->Index = -1;
        $rowcnt = strval($CurrentForm->getValue($this->FormKeyCountName));
        if ($rowcnt == "" || !is_numeric($rowcnt)) {
            $rowcnt = 0;
        }
        $rows = [];

        // Loop through all records
        for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {
            // Load current row values
            $CurrentForm->Index = $rowindex;
            $rowaction = strval($CurrentForm->getValue($this->FormActionName));
            if ($rowaction != "delete" && $rowaction != "insertdelete") {
                $this->loadFormValues(); // Get form values
                if ($rowaction == "insert" && $this->emptyRow()) {
                    // Ignore
                } else {
                    $rows[] = $this->getFieldValues("FormValue"); // Return row as array
                }
            }
        }
        return $rows; // Return as array of array
    }

    // Restore form values for current row
    public function restoreCurrentRowFormValues($idx)
    {
        global $CurrentForm;

        // Get row based on current index
        $CurrentForm->Index = $idx;
        $rowaction = strval($CurrentForm->getValue($this->FormActionName));
        $this->loadFormValues(); // Load form values
        // Set up invalid status correctly
        $this->resetFormError();
        if ($rowaction == "insert" && $this->emptyRow()) {
            // Ignore
        } else {
            $this->validateForm();
        }
    }

    // Reset form status
    public function resetFormError()
    {
        $this->NIK->clearErrorMessage();
        $this->KEU_USAHAUTAMA->clearErrorMessage();
        $this->KEU_PENGELOLAAN->clearErrorMessage();
        $this->KEU_NOTA->clearErrorMessage();
        $this->KEU_PENCATATAN->clearErrorMessage();
        $this->KEU_LAPORAN->clearErrorMessage();
        $this->KEU_UTANGMODAL->clearErrorMessage();
        $this->KEU_CATATNASET->clearErrorMessage();
        $this->KEU_NONTUNAI->clearErrorMessage();
    }

    // Set up sort parameters
    protected function setupSortOrder()
    {
        // Check for "order" parameter
        if (Get("order") !== null) {
            $this->CurrentOrder = Get("order");
            $this->CurrentOrderType = Get("ordertype", "");
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
            // Reset master/detail keys
            if ($this->Command == "resetall") {
                $this->setCurrentMasterTable(""); // Clear master table
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
                        $this->NIK->setSessionValue("");
            }

            // Reset (clear) sorting order
            if ($this->Command == "resetsort") {
                $orderBy = "";
                $this->setSessionOrderBy($orderBy);
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

        // "griddelete"
        if ($this->AllowAddDeleteRow) {
            $item = &$this->ListOptions->add("griddelete");
            $item->CssClass = "text-nowrap";
            $item->OnLeft = true;
            $item->Visible = false; // Default hidden
        }

        // Add group option item
        $item = &$this->ListOptions->add($this->ListOptions->GroupOptionName);
        $item->Body = "";
        $item->OnLeft = true;
        $item->Visible = false;

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

        // "delete"
        if ($this->AllowAddDeleteRow) {
            if ($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") {
                $options = &$this->ListOptions;
                $options->UseButtonGroup = true; // Use button group for grid delete button
                $opt = $options["griddelete"];
                if (!$Security->canDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
                    $opt->Body = "&nbsp;";
                } else {
                    $opt->Body = "<a class=\"ew-grid-link ew-grid-delete\" title=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("DeleteLink")) . "\" onclick=\"return ew.deleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->phrase("DeleteLink") . "</a>";
                }
            }
        }
        if ($this->CurrentMode == "view") { // View mode
        } // End View mode
        $this->renderListOptionsExt();

        // Call ListOptions_Rendered event
        $this->listOptionsRendered();
    }

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $option = $this->OtherOptions["addedit"];
        $option->UseDropDownButton = false;
        $option->DropDownButtonPhrase = $Language->phrase("ButtonAddEdit");
        $option->UseButtonGroup = true;
        //$option->ButtonClass = ""; // Class for button group
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;

        // Add
        if ($this->CurrentMode == "view") { // Check view mode
            $item = &$option->add("add");
            $addcaption = HtmlTitle($Language->phrase("AddLink"));
            $this->AddUrl = $this->getAddUrl();
            $item->Body = "<a class=\"ew-add-edit ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("AddLink") . "</a>";
            $item->Visible = $this->AddUrl != "" && $Security->canAdd();
        }
    }

    // Render other options
    public function renderOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        if (($this->CurrentMode == "add" || $this->CurrentMode == "copy" || $this->CurrentMode == "edit") && !$this->isConfirm()) { // Check add/copy/edit mode
            if ($this->AllowAddDeleteRow) {
                $option = $options["addedit"];
                $option->UseDropDownButton = false;
                $item = &$option->add("addblankrow");
                $item->Body = "<a class=\"ew-add-edit ew-add-blank-row\" title=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("AddBlankRow")) . "\" href=\"#\" onclick=\"return ew.addGridRow(this);\">" . $Language->phrase("AddBlankRow") . "</a>";
                $item->Visible = $Security->canAdd();
                $this->ShowOtherOptions = $item->Visible;
            }
        }
        if ($this->CurrentMode == "view") { // Check view mode
            $option = $options["addedit"];
            $item = $option["add"];
            $this->ShowOtherOptions = $item && $item->Visible;
        }
    }

    // Set up list options (extended codes)
    protected function setupListOptionsExt()
    {
    }

    // Render list options (extended codes)
    protected function renderListOptionsExt()
    {
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
        $this->KEU_USAHAUTAMA->CurrentValue = null;
        $this->KEU_USAHAUTAMA->OldValue = $this->KEU_USAHAUTAMA->CurrentValue;
        $this->KEU_PENGELOLAAN->CurrentValue = null;
        $this->KEU_PENGELOLAAN->OldValue = $this->KEU_PENGELOLAAN->CurrentValue;
        $this->KEU_NOTA->CurrentValue = null;
        $this->KEU_NOTA->OldValue = $this->KEU_NOTA->CurrentValue;
        $this->KEU_PENCATATAN->CurrentValue = null;
        $this->KEU_PENCATATAN->OldValue = $this->KEU_PENCATATAN->CurrentValue;
        $this->KEU_LAPORAN->CurrentValue = null;
        $this->KEU_LAPORAN->OldValue = $this->KEU_LAPORAN->CurrentValue;
        $this->KEU_UTANGMODAL->CurrentValue = null;
        $this->KEU_UTANGMODAL->OldValue = $this->KEU_UTANGMODAL->CurrentValue;
        $this->KEU_CATATNASET->CurrentValue = null;
        $this->KEU_CATATNASET->OldValue = $this->KEU_CATATNASET->CurrentValue;
        $this->KEU_NONTUNAI->CurrentValue = null;
        $this->KEU_NONTUNAI->OldValue = $this->KEU_NONTUNAI->CurrentValue;
    }

    // Load form values
    protected function loadFormValues()
    {
        // Load from form
        global $CurrentForm;
        $CurrentForm->FormName = $this->FormName;

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

        // Check field name 'KEU_USAHAUTAMA' first before field var 'x_KEU_USAHAUTAMA'
        $val = $CurrentForm->hasValue("KEU_USAHAUTAMA") ? $CurrentForm->getValue("KEU_USAHAUTAMA") : $CurrentForm->getValue("x_KEU_USAHAUTAMA");
        if (!$this->KEU_USAHAUTAMA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_USAHAUTAMA->Visible = false; // Disable update for API request
            } else {
                $this->KEU_USAHAUTAMA->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_USAHAUTAMA")) {
            $this->KEU_USAHAUTAMA->setOldValue($CurrentForm->getValue("o_KEU_USAHAUTAMA"));
        }

        // Check field name 'KEU_PENGELOLAAN' first before field var 'x_KEU_PENGELOLAAN'
        $val = $CurrentForm->hasValue("KEU_PENGELOLAAN") ? $CurrentForm->getValue("KEU_PENGELOLAAN") : $CurrentForm->getValue("x_KEU_PENGELOLAAN");
        if (!$this->KEU_PENGELOLAAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_PENGELOLAAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_PENGELOLAAN->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_PENGELOLAAN")) {
            $this->KEU_PENGELOLAAN->setOldValue($CurrentForm->getValue("o_KEU_PENGELOLAAN"));
        }

        // Check field name 'KEU_NOTA' first before field var 'x_KEU_NOTA'
        $val = $CurrentForm->hasValue("KEU_NOTA") ? $CurrentForm->getValue("KEU_NOTA") : $CurrentForm->getValue("x_KEU_NOTA");
        if (!$this->KEU_NOTA->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_NOTA->Visible = false; // Disable update for API request
            } else {
                $this->KEU_NOTA->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_NOTA")) {
            $this->KEU_NOTA->setOldValue($CurrentForm->getValue("o_KEU_NOTA"));
        }

        // Check field name 'KEU_PENCATATAN' first before field var 'x_KEU_PENCATATAN'
        $val = $CurrentForm->hasValue("KEU_PENCATATAN") ? $CurrentForm->getValue("KEU_PENCATATAN") : $CurrentForm->getValue("x_KEU_PENCATATAN");
        if (!$this->KEU_PENCATATAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_PENCATATAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_PENCATATAN->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_PENCATATAN")) {
            $this->KEU_PENCATATAN->setOldValue($CurrentForm->getValue("o_KEU_PENCATATAN"));
        }

        // Check field name 'KEU_LAPORAN' first before field var 'x_KEU_LAPORAN'
        $val = $CurrentForm->hasValue("KEU_LAPORAN") ? $CurrentForm->getValue("KEU_LAPORAN") : $CurrentForm->getValue("x_KEU_LAPORAN");
        if (!$this->KEU_LAPORAN->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_LAPORAN->Visible = false; // Disable update for API request
            } else {
                $this->KEU_LAPORAN->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_LAPORAN")) {
            $this->KEU_LAPORAN->setOldValue($CurrentForm->getValue("o_KEU_LAPORAN"));
        }

        // Check field name 'KEU_UTANGMODAL' first before field var 'x_KEU_UTANGMODAL'
        $val = $CurrentForm->hasValue("KEU_UTANGMODAL") ? $CurrentForm->getValue("KEU_UTANGMODAL") : $CurrentForm->getValue("x_KEU_UTANGMODAL");
        if (!$this->KEU_UTANGMODAL->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_UTANGMODAL->Visible = false; // Disable update for API request
            } else {
                $this->KEU_UTANGMODAL->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_UTANGMODAL")) {
            $this->KEU_UTANGMODAL->setOldValue($CurrentForm->getValue("o_KEU_UTANGMODAL"));
        }

        // Check field name 'KEU_CATATNASET' first before field var 'x_KEU_CATATNASET'
        $val = $CurrentForm->hasValue("KEU_CATATNASET") ? $CurrentForm->getValue("KEU_CATATNASET") : $CurrentForm->getValue("x_KEU_CATATNASET");
        if (!$this->KEU_CATATNASET->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_CATATNASET->Visible = false; // Disable update for API request
            } else {
                $this->KEU_CATATNASET->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_CATATNASET")) {
            $this->KEU_CATATNASET->setOldValue($CurrentForm->getValue("o_KEU_CATATNASET"));
        }

        // Check field name 'KEU_NONTUNAI' first before field var 'x_KEU_NONTUNAI'
        $val = $CurrentForm->hasValue("KEU_NONTUNAI") ? $CurrentForm->getValue("KEU_NONTUNAI") : $CurrentForm->getValue("x_KEU_NONTUNAI");
        if (!$this->KEU_NONTUNAI->IsDetailKey) {
            if (IsApi() && $val === null) {
                $this->KEU_NONTUNAI->Visible = false; // Disable update for API request
            } else {
                $this->KEU_NONTUNAI->setFormValue($val);
            }
        }
        if ($CurrentForm->hasValue("o_KEU_NONTUNAI")) {
            $this->KEU_NONTUNAI->setOldValue($CurrentForm->getValue("o_KEU_NONTUNAI"));
        }
    }

    // Restore form values
    public function restoreFormValues()
    {
        global $CurrentForm;
        $this->NIK->CurrentValue = $this->NIK->FormValue;
        $this->KEU_USAHAUTAMA->CurrentValue = $this->KEU_USAHAUTAMA->FormValue;
        $this->KEU_PENGELOLAAN->CurrentValue = $this->KEU_PENGELOLAAN->FormValue;
        $this->KEU_NOTA->CurrentValue = $this->KEU_NOTA->FormValue;
        $this->KEU_PENCATATAN->CurrentValue = $this->KEU_PENCATATAN->FormValue;
        $this->KEU_LAPORAN->CurrentValue = $this->KEU_LAPORAN->FormValue;
        $this->KEU_UTANGMODAL->CurrentValue = $this->KEU_UTANGMODAL->FormValue;
        $this->KEU_CATATNASET->CurrentValue = $this->KEU_CATATNASET->FormValue;
        $this->KEU_NONTUNAI->CurrentValue = $this->KEU_NONTUNAI->FormValue;
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
        $this->NIK->setDbValue($row['NIK']);
        $this->KEU_USAHAUTAMA->setDbValue($row['KEU_USAHAUTAMA']);
        $this->KEU_PENGELOLAAN->setDbValue($row['KEU_PENGELOLAAN']);
        $this->KEU_NOTA->setDbValue($row['KEU_NOTA']);
        $this->KEU_PENCATATAN->setDbValue($row['KEU_PENCATATAN']);
        $this->KEU_LAPORAN->setDbValue($row['KEU_LAPORAN']);
        $this->KEU_UTANGMODAL->setDbValue($row['KEU_UTANGMODAL']);
        $this->KEU_CATATNASET->setDbValue($row['KEU_CATATNASET']);
        $this->KEU_NONTUNAI->setDbValue($row['KEU_NONTUNAI']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $this->loadDefaultValues();
        $row = [];
        $row['NIK'] = $this->NIK->CurrentValue;
        $row['KEU_USAHAUTAMA'] = $this->KEU_USAHAUTAMA->CurrentValue;
        $row['KEU_PENGELOLAAN'] = $this->KEU_PENGELOLAAN->CurrentValue;
        $row['KEU_NOTA'] = $this->KEU_NOTA->CurrentValue;
        $row['KEU_PENCATATAN'] = $this->KEU_PENCATATAN->CurrentValue;
        $row['KEU_LAPORAN'] = $this->KEU_LAPORAN->CurrentValue;
        $row['KEU_UTANGMODAL'] = $this->KEU_UTANGMODAL->CurrentValue;
        $row['KEU_CATATNASET'] = $this->KEU_CATATNASET->CurrentValue;
        $row['KEU_NONTUNAI'] = $this->KEU_NONTUNAI->CurrentValue;
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
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // KEU_USAHAUTAMA

        // KEU_PENGELOLAAN

        // KEU_NOTA

        // KEU_PENCATATAN

        // KEU_LAPORAN

        // KEU_UTANGMODAL

        // KEU_CATATNASET

        // KEU_NONTUNAI
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // KEU_USAHAUTAMA
            $curVal = strval($this->KEU_USAHAUTAMA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
                if ($this->KEU_USAHAUTAMA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_USAHAUTAMA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->displayValue($arwrk);
                    } else {
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = null;
            }
            $this->KEU_USAHAUTAMA->ViewCustomAttributes = "";

            // KEU_PENGELOLAAN
            $curVal = strval($this->KEU_PENGELOLAAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
                if ($this->KEU_PENGELOLAAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENGELOLAAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = null;
            }
            $this->KEU_PENGELOLAAN->ViewCustomAttributes = "";

            // KEU_NOTA
            $curVal = strval($this->KEU_NOTA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
                if ($this->KEU_NOTA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NOTA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NOTA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->displayValue($arwrk);
                    } else {
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NOTA->ViewValue = null;
            }
            $this->KEU_NOTA->ViewCustomAttributes = "";

            // KEU_PENCATATAN
            $curVal = strval($this->KEU_PENCATATAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
                if ($this->KEU_PENCATATAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENCATATAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENCATATAN->ViewValue = null;
            }
            $this->KEU_PENCATATAN->ViewCustomAttributes = "";

            // KEU_LAPORAN
            $curVal = strval($this->KEU_LAPORAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
                if ($this->KEU_LAPORAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_LAPORAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->displayValue($arwrk);
                    } else {
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_LAPORAN->ViewValue = null;
            }
            $this->KEU_LAPORAN->ViewCustomAttributes = "";

            // KEU_UTANGMODAL
            $curVal = strval($this->KEU_UTANGMODAL->CurrentValue);
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
                if ($this->KEU_UTANGMODAL->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_UTANGMODAL->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->displayValue($arwrk);
                    } else {
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->CurrentValue;
                    }
                }
            } else {
                $this->KEU_UTANGMODAL->ViewValue = null;
            }
            $this->KEU_UTANGMODAL->ViewCustomAttributes = "";

            // KEU_CATATNASET
            $curVal = strval($this->KEU_CATATNASET->CurrentValue);
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
                if ($this->KEU_CATATNASET->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_CATATNASET->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->displayValue($arwrk);
                    } else {
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->CurrentValue;
                    }
                }
            } else {
                $this->KEU_CATATNASET->ViewValue = null;
            }
            $this->KEU_CATATNASET->ViewCustomAttributes = "";

            // KEU_NONTUNAI
            $curVal = strval($this->KEU_NONTUNAI->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
                if ($this->KEU_NONTUNAI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Non Tunai'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NONTUNAI->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->displayValue($arwrk);
                    } else {
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NONTUNAI->ViewValue = null;
            }
            $this->KEU_NONTUNAI->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";
            $this->KEU_USAHAUTAMA->TooltipValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";
            $this->KEU_PENGELOLAAN->TooltipValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";
            $this->KEU_NOTA->TooltipValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";
            $this->KEU_PENCATATAN->TooltipValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";
            $this->KEU_LAPORAN->TooltipValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";
            $this->KEU_UTANGMODAL->TooltipValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";
            $this->KEU_CATATNASET->TooltipValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
            $this->KEU_NONTUNAI->TooltipValue = "";
        } elseif ($this->RowType == ROWTYPE_ADD) {
            // NIK

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->EditAttrs["class"] = "form-control";
            $this->KEU_USAHAUTAMA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_USAHAUTAMA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->Lookup !== null && is_array($this->KEU_USAHAUTAMA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_USAHAUTAMA->ViewValue !== null) { // Load from cache
                $this->KEU_USAHAUTAMA->EditValue = array_values($this->KEU_USAHAUTAMA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_USAHAUTAMA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Sumber Utama'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_USAHAUTAMA->EditValue = $arwrk;
            }
            $this->KEU_USAHAUTAMA->PlaceHolder = RemoveHtml($this->KEU_USAHAUTAMA->caption());

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENGELOLAAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENGELOLAAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->Lookup !== null && is_array($this->KEU_PENGELOLAAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENGELOLAAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENGELOLAAN->EditValue = array_values($this->KEU_PENGELOLAAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENGELOLAAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Keuangan Perusahaan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENGELOLAAN->EditValue = $arwrk;
            }
            $this->KEU_PENGELOLAAN->PlaceHolder = RemoveHtml($this->KEU_PENGELOLAAN->caption());

            // KEU_NOTA
            $this->KEU_NOTA->EditAttrs["class"] = "form-control";
            $this->KEU_NOTA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NOTA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
            } else {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->Lookup !== null && is_array($this->KEU_NOTA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NOTA->ViewValue !== null) { // Load from cache
                $this->KEU_NOTA->EditValue = array_values($this->KEU_NOTA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NOTA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Nota'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NOTA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NOTA->EditValue = $arwrk;
            }
            $this->KEU_NOTA->PlaceHolder = RemoveHtml($this->KEU_NOTA->caption());

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENCATATAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENCATATAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->Lookup !== null && is_array($this->KEU_PENCATATAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENCATATAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENCATATAN->EditValue = array_values($this->KEU_PENCATATAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENCATATAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENCATATAN->EditValue = $arwrk;
            }
            $this->KEU_PENCATATAN->PlaceHolder = RemoveHtml($this->KEU_PENCATATAN->caption());

            // KEU_LAPORAN
            $this->KEU_LAPORAN->EditAttrs["class"] = "form-control";
            $this->KEU_LAPORAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_LAPORAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->Lookup !== null && is_array($this->KEU_LAPORAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_LAPORAN->ViewValue !== null) { // Load from cache
                $this->KEU_LAPORAN->EditValue = array_values($this->KEU_LAPORAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_LAPORAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Laporan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_LAPORAN->EditValue = $arwrk;
            }
            $this->KEU_LAPORAN->PlaceHolder = RemoveHtml($this->KEU_LAPORAN->caption());

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->EditAttrs["class"] = "form-control";
            $this->KEU_UTANGMODAL->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_UTANGMODAL->CurrentValue));
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
            } else {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->Lookup !== null && is_array($this->KEU_UTANGMODAL->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_UTANGMODAL->ViewValue !== null) { // Load from cache
                $this->KEU_UTANGMODAL->EditValue = array_values($this->KEU_UTANGMODAL->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_UTANGMODAL->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pinjaman Bank'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_UTANGMODAL->EditValue = $arwrk;
            }
            $this->KEU_UTANGMODAL->PlaceHolder = RemoveHtml($this->KEU_UTANGMODAL->caption());

            // KEU_CATATNASET
            $this->KEU_CATATNASET->EditAttrs["class"] = "form-control";
            $this->KEU_CATATNASET->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_CATATNASET->CurrentValue));
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
            } else {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->Lookup !== null && is_array($this->KEU_CATATNASET->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_CATATNASET->ViewValue !== null) { // Load from cache
                $this->KEU_CATATNASET->EditValue = array_values($this->KEU_CATATNASET->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_CATATNASET->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Aset'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_CATATNASET->EditValue = $arwrk;
            }
            $this->KEU_CATATNASET->PlaceHolder = RemoveHtml($this->KEU_CATATNASET->caption());

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->EditAttrs["class"] = "form-control";
            $this->KEU_NONTUNAI->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NONTUNAI->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
            } else {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->Lookup !== null && is_array($this->KEU_NONTUNAI->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NONTUNAI->ViewValue !== null) { // Load from cache
                $this->KEU_NONTUNAI->EditValue = array_values($this->KEU_NONTUNAI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NONTUNAI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Non Tunai'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NONTUNAI->EditValue = $arwrk;
            }
            $this->KEU_NONTUNAI->PlaceHolder = RemoveHtml($this->KEU_NONTUNAI->caption());

            // Add refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
        } elseif ($this->RowType == ROWTYPE_EDIT) {
            // NIK

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->EditAttrs["class"] = "form-control";
            $this->KEU_USAHAUTAMA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_USAHAUTAMA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->Lookup !== null && is_array($this->KEU_USAHAUTAMA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_USAHAUTAMA->ViewValue !== null) { // Load from cache
                $this->KEU_USAHAUTAMA->EditValue = array_values($this->KEU_USAHAUTAMA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_USAHAUTAMA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Sumber Utama'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_USAHAUTAMA->EditValue = $arwrk;
            }
            $this->KEU_USAHAUTAMA->PlaceHolder = RemoveHtml($this->KEU_USAHAUTAMA->caption());

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENGELOLAAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENGELOLAAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->Lookup !== null && is_array($this->KEU_PENGELOLAAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENGELOLAAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENGELOLAAN->EditValue = array_values($this->KEU_PENGELOLAAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENGELOLAAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Keuangan Perusahaan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENGELOLAAN->EditValue = $arwrk;
            }
            $this->KEU_PENGELOLAAN->PlaceHolder = RemoveHtml($this->KEU_PENGELOLAAN->caption());

            // KEU_NOTA
            $this->KEU_NOTA->EditAttrs["class"] = "form-control";
            $this->KEU_NOTA->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NOTA->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
            } else {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->Lookup !== null && is_array($this->KEU_NOTA->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NOTA->ViewValue !== null) { // Load from cache
                $this->KEU_NOTA->EditValue = array_values($this->KEU_NOTA->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NOTA->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Nota'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NOTA->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NOTA->EditValue = $arwrk;
            }
            $this->KEU_NOTA->PlaceHolder = RemoveHtml($this->KEU_NOTA->caption());

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->EditAttrs["class"] = "form-control";
            $this->KEU_PENCATATAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_PENCATATAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->Lookup !== null && is_array($this->KEU_PENCATATAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_PENCATATAN->ViewValue !== null) { // Load from cache
                $this->KEU_PENCATATAN->EditValue = array_values($this->KEU_PENCATATAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_PENCATATAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_PENCATATAN->EditValue = $arwrk;
            }
            $this->KEU_PENCATATAN->PlaceHolder = RemoveHtml($this->KEU_PENCATATAN->caption());

            // KEU_LAPORAN
            $this->KEU_LAPORAN->EditAttrs["class"] = "form-control";
            $this->KEU_LAPORAN->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_LAPORAN->CurrentValue));
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
            } else {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->Lookup !== null && is_array($this->KEU_LAPORAN->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_LAPORAN->ViewValue !== null) { // Load from cache
                $this->KEU_LAPORAN->EditValue = array_values($this->KEU_LAPORAN->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_LAPORAN->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Laporan Keuangan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_LAPORAN->EditValue = $arwrk;
            }
            $this->KEU_LAPORAN->PlaceHolder = RemoveHtml($this->KEU_LAPORAN->caption());

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->EditAttrs["class"] = "form-control";
            $this->KEU_UTANGMODAL->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_UTANGMODAL->CurrentValue));
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
            } else {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->Lookup !== null && is_array($this->KEU_UTANGMODAL->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_UTANGMODAL->ViewValue !== null) { // Load from cache
                $this->KEU_UTANGMODAL->EditValue = array_values($this->KEU_UTANGMODAL->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_UTANGMODAL->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Pinjaman Bank'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_UTANGMODAL->EditValue = $arwrk;
            }
            $this->KEU_UTANGMODAL->PlaceHolder = RemoveHtml($this->KEU_UTANGMODAL->caption());

            // KEU_CATATNASET
            $this->KEU_CATATNASET->EditAttrs["class"] = "form-control";
            $this->KEU_CATATNASET->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_CATATNASET->CurrentValue));
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
            } else {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->Lookup !== null && is_array($this->KEU_CATATNASET->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_CATATNASET->ViewValue !== null) { // Load from cache
                $this->KEU_CATATNASET->EditValue = array_values($this->KEU_CATATNASET->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_CATATNASET->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Catatan Aset'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_CATATNASET->EditValue = $arwrk;
            }
            $this->KEU_CATATNASET->PlaceHolder = RemoveHtml($this->KEU_CATATNASET->caption());

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->EditAttrs["class"] = "form-control";
            $this->KEU_NONTUNAI->EditCustomAttributes = "";
            $curVal = trim(strval($this->KEU_NONTUNAI->CurrentValue));
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
            } else {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->Lookup !== null && is_array($this->KEU_NONTUNAI->Lookup->Options) ? $curVal : null;
            }
            if ($this->KEU_NONTUNAI->ViewValue !== null) { // Load from cache
                $this->KEU_NONTUNAI->EditValue = array_values($this->KEU_NONTUNAI->Lookup->Options);
            } else { // Lookup from database
                if ($curVal == "") {
                    $filterWrk = "0=1";
                } else {
                    $filterWrk = "`id`" . SearchString("=", $this->KEU_NONTUNAI->CurrentValue, DATATYPE_NUMBER, "");
                }
                $lookupFilter = function() {
                    return "`subkat`='Non Tunai'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(true, $filterWrk, $lookupFilter, $this, false, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                $arwrk = $rswrk;
                $this->KEU_NONTUNAI->EditValue = $arwrk;
            }
            $this->KEU_NONTUNAI->PlaceHolder = RemoveHtml($this->KEU_NONTUNAI->caption());

            // Edit refer script

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
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
        if ($this->KEU_USAHAUTAMA->Required) {
            if (!$this->KEU_USAHAUTAMA->IsDetailKey && EmptyValue($this->KEU_USAHAUTAMA->FormValue)) {
                $this->KEU_USAHAUTAMA->addErrorMessage(str_replace("%s", $this->KEU_USAHAUTAMA->caption(), $this->KEU_USAHAUTAMA->RequiredErrorMessage));
            }
        }
        if ($this->KEU_PENGELOLAAN->Required) {
            if (!$this->KEU_PENGELOLAAN->IsDetailKey && EmptyValue($this->KEU_PENGELOLAAN->FormValue)) {
                $this->KEU_PENGELOLAAN->addErrorMessage(str_replace("%s", $this->KEU_PENGELOLAAN->caption(), $this->KEU_PENGELOLAAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_NOTA->Required) {
            if (!$this->KEU_NOTA->IsDetailKey && EmptyValue($this->KEU_NOTA->FormValue)) {
                $this->KEU_NOTA->addErrorMessage(str_replace("%s", $this->KEU_NOTA->caption(), $this->KEU_NOTA->RequiredErrorMessage));
            }
        }
        if ($this->KEU_PENCATATAN->Required) {
            if (!$this->KEU_PENCATATAN->IsDetailKey && EmptyValue($this->KEU_PENCATATAN->FormValue)) {
                $this->KEU_PENCATATAN->addErrorMessage(str_replace("%s", $this->KEU_PENCATATAN->caption(), $this->KEU_PENCATATAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_LAPORAN->Required) {
            if (!$this->KEU_LAPORAN->IsDetailKey && EmptyValue($this->KEU_LAPORAN->FormValue)) {
                $this->KEU_LAPORAN->addErrorMessage(str_replace("%s", $this->KEU_LAPORAN->caption(), $this->KEU_LAPORAN->RequiredErrorMessage));
            }
        }
        if ($this->KEU_UTANGMODAL->Required) {
            if (!$this->KEU_UTANGMODAL->IsDetailKey && EmptyValue($this->KEU_UTANGMODAL->FormValue)) {
                $this->KEU_UTANGMODAL->addErrorMessage(str_replace("%s", $this->KEU_UTANGMODAL->caption(), $this->KEU_UTANGMODAL->RequiredErrorMessage));
            }
        }
        if ($this->KEU_CATATNASET->Required) {
            if (!$this->KEU_CATATNASET->IsDetailKey && EmptyValue($this->KEU_CATATNASET->FormValue)) {
                $this->KEU_CATATNASET->addErrorMessage(str_replace("%s", $this->KEU_CATATNASET->caption(), $this->KEU_CATATNASET->RequiredErrorMessage));
            }
        }
        if ($this->KEU_NONTUNAI->Required) {
            if (!$this->KEU_NONTUNAI->IsDetailKey && EmptyValue($this->KEU_NONTUNAI->FormValue)) {
                $this->KEU_NONTUNAI->addErrorMessage(str_replace("%s", $this->KEU_NONTUNAI->caption(), $this->KEU_NONTUNAI->RequiredErrorMessage));
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

    // Delete records based on current filter
    protected function deleteRows()
    {
        global $Language, $Security;
        if (!$Security->canDelete()) {
            $this->setFailureMessage($Language->phrase("NoDeletePermission")); // No delete permission
            return false;
        }
        $deleteRows = true;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $rows = $conn->fetchAll($sql);
        if (count($rows) == 0) {
            $this->setFailureMessage($Language->phrase("NoRecord")); // No record found
            return false;
        }

        // Clone old rows
        $rsold = $rows;

        // Call row deleting event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $deleteRows = $this->rowDeleting($row);
                if (!$deleteRows) {
                    break;
                }
            }
        }
        if ($deleteRows) {
            $key = "";
            foreach ($rsold as $row) {
                $thisKey = "";
                if ($thisKey != "") {
                    $thisKey .= Config("COMPOSITE_KEY_SEPARATOR");
                }
                $thisKey .= $row['NIK'];
                if (Config("DELETE_UPLOADED_FILES")) { // Delete old files
                    $this->deleteUploadedFiles($row);
                }
                $deleteRows = $this->delete($row); // Delete
                if ($deleteRows === false) {
                    break;
                }
                if ($key != "") {
                    $key .= ", ";
                }
                $key .= $thisKey;
            }
        }
        if (!$deleteRows) {
            // Set up error message
            if ($this->getSuccessMessage() != "" || $this->getFailureMessage() != "") {
                // Use the message, do nothing
            } elseif ($this->CancelMessage != "") {
                $this->setFailureMessage($this->CancelMessage);
                $this->CancelMessage = "";
            } else {
                $this->setFailureMessage($Language->phrase("DeleteCancelled"));
            }
        }

        // Call Row Deleted event
        if ($deleteRows) {
            foreach ($rsold as $row) {
                $this->rowDeleted($row);
            }
        }

        // Write JSON for API request
        if (IsApi() && $deleteRows) {
            $row = $this->getRecordsFromRecordset($rsold);
            WriteJson(["success" => true, $this->TableVar => $row]);
        }
        return $deleteRows;
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

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->setDbValueDef($rsnew, $this->KEU_USAHAUTAMA->CurrentValue, null, $this->KEU_USAHAUTAMA->ReadOnly);

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->setDbValueDef($rsnew, $this->KEU_PENGELOLAAN->CurrentValue, null, $this->KEU_PENGELOLAAN->ReadOnly);

            // KEU_NOTA
            $this->KEU_NOTA->setDbValueDef($rsnew, $this->KEU_NOTA->CurrentValue, null, $this->KEU_NOTA->ReadOnly);

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->setDbValueDef($rsnew, $this->KEU_PENCATATAN->CurrentValue, null, $this->KEU_PENCATATAN->ReadOnly);

            // KEU_LAPORAN
            $this->KEU_LAPORAN->setDbValueDef($rsnew, $this->KEU_LAPORAN->CurrentValue, null, $this->KEU_LAPORAN->ReadOnly);

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->setDbValueDef($rsnew, $this->KEU_UTANGMODAL->CurrentValue, null, $this->KEU_UTANGMODAL->ReadOnly);

            // KEU_CATATNASET
            $this->KEU_CATATNASET->setDbValueDef($rsnew, $this->KEU_CATATNASET->CurrentValue, null, $this->KEU_CATATNASET->ReadOnly);

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->setDbValueDef($rsnew, $this->KEU_NONTUNAI->CurrentValue, null, $this->KEU_NONTUNAI->ReadOnly);

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

    // Add record
    protected function addRow($rsold = null)
    {
        global $Language, $Security;

        // Set up foreign key field value from Session
        if ($this->getCurrentMasterTable() == "umkm_datadiri") {
            $this->NIK->CurrentValue = $this->NIK->getSessionValue();
        }
        $conn = $this->getConnection();

        // Load db values from rsold
        $this->loadDbValues($rsold);
        if ($rsold) {
        }
        $rsnew = [];

        // NIK
        $this->NIK->CurrentValue = CurrentUserName();
        $this->NIK->setDbValueDef($rsnew, $this->NIK->CurrentValue, "");

        // KEU_USAHAUTAMA
        $this->KEU_USAHAUTAMA->setDbValueDef($rsnew, $this->KEU_USAHAUTAMA->CurrentValue, null, false);

        // KEU_PENGELOLAAN
        $this->KEU_PENGELOLAAN->setDbValueDef($rsnew, $this->KEU_PENGELOLAAN->CurrentValue, null, false);

        // KEU_NOTA
        $this->KEU_NOTA->setDbValueDef($rsnew, $this->KEU_NOTA->CurrentValue, null, false);

        // KEU_PENCATATAN
        $this->KEU_PENCATATAN->setDbValueDef($rsnew, $this->KEU_PENCATATAN->CurrentValue, null, false);

        // KEU_LAPORAN
        $this->KEU_LAPORAN->setDbValueDef($rsnew, $this->KEU_LAPORAN->CurrentValue, null, false);

        // KEU_UTANGMODAL
        $this->KEU_UTANGMODAL->setDbValueDef($rsnew, $this->KEU_UTANGMODAL->CurrentValue, null, false);

        // KEU_CATATNASET
        $this->KEU_CATATNASET->setDbValueDef($rsnew, $this->KEU_CATATNASET->CurrentValue, null, false);

        // KEU_NONTUNAI
        $this->KEU_NONTUNAI->setDbValueDef($rsnew, $this->KEU_NONTUNAI->CurrentValue, null, false);

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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        // Hide foreign keys
        $masterTblVar = $this->getCurrentMasterTable();
        if ($masterTblVar == "umkm_datadiri") {
            $masterTbl = Container("umkm_datadiri");
            $this->NIK->Visible = false;
            if ($masterTbl->EventCancelled) {
                $this->EventCancelled = true;
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
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
                case "x_KEU_USAHAUTAMA":
                    $lookupFilter = function () {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENGELOLAAN":
                    $lookupFilter = function () {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NOTA":
                    $lookupFilter = function () {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENCATATAN":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_LAPORAN":
                    $lookupFilter = function () {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_UTANGMODAL":
                    $lookupFilter = function () {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_CATATNASET":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NONTUNAI":
                    $lookupFilter = function () {
                        return "`subkat`='Non Tunai'";
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
}
