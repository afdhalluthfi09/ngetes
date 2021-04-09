<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorPemasaranonlineView extends TempSkorPemasaranonline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_pemasaranonline';

    // Page object name
    public $PageObjName = "TempSkorPemasaranonlineView";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (temp_skor_pemasaranonline)
        if (!isset($GLOBALS["temp_skor_pemasaranonline"]) || get_class($GLOBALS["temp_skor_pemasaranonline"]) == PROJECT_NAMESPACE . "temp_skor_pemasaranonline") {
            $GLOBALS["temp_skor_pemasaranonline"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("nik") ?? Route("nik")) !== null) {
            $this->RecKey["nik"] = $keyValue;
        }
        $this->ExportPrintUrl = $pageUrl . "export=print";
        $this->ExportHtmlUrl = $pageUrl . "export=html";
        $this->ExportExcelUrl = $pageUrl . "export=excel";
        $this->ExportWordUrl = $pageUrl . "export=word";
        $this->ExportXmlUrl = $pageUrl . "export=xml";
        $this->ExportCsvUrl = $pageUrl . "export=csv";
        $this->ExportPdfUrl = $pageUrl . "export=pdf";

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_pemasaranonline');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");

        // Export options
        $this->ExportOptions = new ListOptions("div");
        $this->ExportOptions->TagClassName = "ew-export-option";

        // Other options
        if (!$this->OtherOptions) {
            $this->OtherOptions = new ListOptionsArray();
        }
        $this->OtherOptions["action"] = new ListOptions("div");
        $this->OtherOptions["action"]->TagClassName = "ew-action-option";
        $this->OtherOptions["detail"] = new ListOptions("div");
        $this->OtherOptions["detail"]->TagClassName = "ew-detail-option";
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
                $doc = new $class(Container("temp_skor_pemasaranonline"));
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
                    if ($pageName == "tempskorpemasaranonlineview") {
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
    public $ExportOptions; // Export options
    public $OtherOptions; // Other options
    public $DisplayRecords = 1;
    public $DbMasterFilter;
    public $DbDetailFilter;
    public $StartRecord;
    public $StopRecord;
    public $TotalRecords = 0;
    public $RecordRange = 10;
    public $RecKey = [];
    public $IsModal = false;

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
        if (Get("nik") !== null) {
            if ($ExportFileName != "") {
                $ExportFileName .= "_";
            }
            $ExportFileName .= Get("nik");
        }

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
        $this->skor_pemasaranonline->setVisibility();
        $this->maxskor_pemasaranonline->setVisibility();
        $this->bobot_pemasaranonline->setVisibility();
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

        // Load current record
        $loadCurrentRecord = false;
        $returnUrl = "";
        $matchRecord = false;
        if ($this->isPageRequest()) { // Validate request
            if (($keyValue = Get("nik") ?? Route("nik")) !== null) {
                $this->nik->setQueryStringValue($keyValue);
                $this->RecKey["nik"] = $this->nik->QueryStringValue;
            } elseif (Post("nik") !== null) {
                $this->nik->setFormValue(Post("nik"));
                $this->RecKey["nik"] = $this->nik->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->nik->setQueryStringValue($keyValue);
                $this->RecKey["nik"] = $this->nik->QueryStringValue;
            } else {
                $loadCurrentRecord = true;
            }

            // Get action
            $this->CurrentAction = "show"; // Display
            switch ($this->CurrentAction) {
                case "show": // Get a record to display
                    $this->StartRecord = 1; // Initialize start position
                    if ($this->Recordset = $this->loadRecordset()) { // Load records
                        $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
                    }
                    if ($this->TotalRecords <= 0) { // No record found
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $this->terminate("tempskorpemasaranonlinelist"); // Return to list page
                        return;
                    } elseif ($loadCurrentRecord) { // Load current record position
                        $this->setupStartRecord(); // Set up start record position
                        // Point to current record
                        if ($this->StartRecord <= $this->TotalRecords) {
                            $matchRecord = true;
                            $this->Recordset->move($this->StartRecord - 1);
                        }
                    } else { // Match key values
                        while (!$this->Recordset->EOF) {
                            if (SameString($this->nik->CurrentValue, $this->Recordset->fields['nik'])) {
                                $this->setStartRecordNumber($this->StartRecord); // Save record position
                                $matchRecord = true;
                                break;
                            } else {
                                $this->StartRecord++;
                                $this->Recordset->moveNext();
                            }
                        }
                    }
                    if (!$matchRecord) {
                        if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "") {
                            $this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
                        }
                        $returnUrl = "tempskorpemasaranonlinelist"; // No matching record, return to list
                    } else {
                        $this->loadRowValues($this->Recordset); // Load row values
                    }
                    break;
            }

            // Export data only
            if (!$this->CustomExport && in_array($this->Export, array_keys(Config("EXPORT_CLASSES")))) {
                $this->exportData();
                $this->terminate();
                return;
            }
        } else {
            $returnUrl = "tempskorpemasaranonlinelist"; // Not page request, return to list
        }
        if ($returnUrl != "") {
            $this->terminate($returnUrl);
            return;
        }

        // Set up Breadcrumb
        if (!$this->isExport()) {
            $this->setupBreadcrumb();
        }

        // Render row
        $this->RowType = ROWTYPE_VIEW;
        $this->resetAttributes();
        $this->renderRow();

        // Normal return
        if (IsApi()) {
            $rows = $this->getRecordsFromRecordset($this->Recordset, true); // Get current record only
            $this->Recordset->close();
            WriteJson(["success" => true, $this->TableVar => $rows]);
            $this->terminate(true);
            return;
        }

        // Set up pager
        $this->Pager = new PrevNextPager($this->StartRecord, $this->DisplayRecords, $this->TotalRecords, "", $this->RecordRange, $this->AutoHidePager);

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

    // Set up other options
    protected function setupOtherOptions()
    {
        global $Language, $Security;
        $options = &$this->OtherOptions;
        $option = $options["action"];

        // Add
        $item = &$option->add("add");
        $addcaption = HtmlTitle($Language->phrase("ViewPageAddLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->AddUrl)) . "'});\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-add\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . HtmlEncode(GetUrl($this->AddUrl)) . "\">" . $Language->phrase("ViewPageAddLink") . "</a>";
        }
        $item->Visible = ($this->AddUrl != "" && $Security->canAdd());

        // Edit
        $item = &$option->add("edit");
        $editcaption = HtmlTitle($Language->phrase("ViewPageEditLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,url:'" . HtmlEncode(GetUrl($this->EditUrl)) . "'});\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-edit\" title=\"" . $editcaption . "\" data-caption=\"" . $editcaption . "\" href=\"" . HtmlEncode(GetUrl($this->EditUrl)) . "\">" . $Language->phrase("ViewPageEditLink") . "</a>";
        }
        $item->Visible = ($this->EditUrl != "" && $Security->canEdit());

        // Copy
        $item = &$option->add("copy");
        $copycaption = HtmlTitle($Language->phrase("ViewPageCopyLink"));
        if ($this->IsModal) {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"#\" onclick=\"return ew.modalDialogShow({lnk:this,btn:'AddBtn',url:'" . HtmlEncode(GetUrl($this->CopyUrl)) . "'});\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-copy\" title=\"" . $copycaption . "\" data-caption=\"" . $copycaption . "\" href=\"" . HtmlEncode(GetUrl($this->CopyUrl)) . "\">" . $Language->phrase("ViewPageCopyLink") . "</a>";
        }
        $item->Visible = ($this->CopyUrl != "" && $Security->canAdd());

        // Delete
        $item = &$option->add("delete");
        if ($this->IsModal) { // Handle as inline delete
            $item->Body = "<a onclick=\"return ew.confirmDelete(this);\" class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(UrlAddQuery(GetUrl($this->DeleteUrl), "action=1")) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        } else {
            $item->Body = "<a class=\"ew-action ew-delete\" title=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" data-caption=\"" . HtmlTitle($Language->phrase("ViewPageDeleteLink")) . "\" href=\"" . HtmlEncode(GetUrl($this->DeleteUrl)) . "\">" . $Language->phrase("ViewPageDeleteLink") . "</a>";
        }
        $item->Visible = ($this->DeleteUrl != "" && $Security->canDelete());

        // Set up action default
        $option = $options["action"];
        $option->DropDownButtonPhrase = $Language->phrase("ButtonActions");
        $option->UseDropDownButton = true;
        $option->UseButtonGroup = true;
        $item = &$option->add($option->GroupOptionName);
        $item->Body = "";
        $item->Visible = false;
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
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
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
        $row['skor_pemasaranonline'] = null;
        $row['maxskor_pemasaranonline'] = null;
        $row['bobot_pemasaranonline'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs
        $this->AddUrl = $this->getAddUrl();
        $this->EditUrl = $this->getEditUrl();
        $this->CopyUrl = $this->getCopyUrl();
        $this->DeleteUrl = $this->getDeleteUrl();
        $this->ListUrl = $this->getListUrl();
        $this->setupOtherOptions();

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

        // Convert decimal values if posted back
        if ($this->skor_pemasaranonline->FormValue == $this->skor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaranonline->CurrentValue))) {
            $this->skor_pemasaranonline->CurrentValue = ConvertToFloatString($this->skor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaranonline->FormValue == $this->maxskor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue))) {
            $this->maxskor_pemasaranonline->CurrentValue = ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue);
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

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline
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

            // skor_pemasaranonline
            $this->skor_pemasaranonline->ViewValue = $this->skor_pemasaranonline->CurrentValue;
            $this->skor_pemasaranonline->ViewValue = FormatNumber($this->skor_pemasaranonline->ViewValue, 2, -2, -2, -2);
            $this->skor_pemasaranonline->ViewCustomAttributes = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->ViewValue = $this->maxskor_pemasaranonline->CurrentValue;
            $this->maxskor_pemasaranonline->ViewValue = FormatNumber($this->maxskor_pemasaranonline->ViewValue, 2, -2, -2, -2);
            $this->maxskor_pemasaranonline->ViewCustomAttributes = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->ViewValue = $this->bobot_pemasaranonline->CurrentValue;
            $this->bobot_pemasaranonline->ViewValue = FormatNumber($this->bobot_pemasaranonline->ViewValue, 0, -2, -2, -2);
            $this->bobot_pemasaranonline->ViewCustomAttributes = "";

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

            // skor_pemasaranonline
            $this->skor_pemasaranonline->LinkCustomAttributes = "";
            $this->skor_pemasaranonline->HrefValue = "";
            $this->skor_pemasaranonline->TooltipValue = "";

            // maxskor_pemasaranonline
            $this->maxskor_pemasaranonline->LinkCustomAttributes = "";
            $this->maxskor_pemasaranonline->HrefValue = "";
            $this->maxskor_pemasaranonline->TooltipValue = "";

            // bobot_pemasaranonline
            $this->bobot_pemasaranonline->LinkCustomAttributes = "";
            $this->bobot_pemasaranonline->HrefValue = "";
            $this->bobot_pemasaranonline->TooltipValue = "";
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
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ftemp_skor_pemasaranonlineview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ftemp_skor_pemasaranonlineview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ftemp_skor_pemasaranonlineview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_temp_skor_pemasaranonline" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_temp_skor_pemasaranonline\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ftemp_skor_pemasaranonlineview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $item->Visible = true;

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

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
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
        if (!$this->Recordset) {
            $this->Recordset = $this->loadRecordset();
        }
        $rs = &$this->Recordset;
        if ($rs) {
            $this->TotalRecords = $rs->recordCount();
        }
        $this->StartRecord = 1;
        $this->setupStartRecord(); // Set up start record position

        // Set the last record to display
        if ($this->DisplayRecords <= 0) {
            $this->StopRecord = $this->TotalRecords;
        } else {
            $this->StopRecord = $this->StartRecord + $this->DisplayRecords - 1;
        }
        $this->ExportDoc = GetExportDocument($this, "v");
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
        $this->exportDocument($doc, $rs, $this->StartRecord, $this->StopRecord, "view");
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorpemasaranonlinelist"), "", $this->TableVar, true);
        $pageId = "view";
        $Breadcrumb->add("view", $pageId, $url);
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
}
