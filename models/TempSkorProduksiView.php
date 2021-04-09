<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorProduksiView extends TempSkorProduksi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_produksi';

    // Page object name
    public $PageObjName = "TempSkorProduksiView";

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

        // Table object (temp_skor_produksi)
        if (!isset($GLOBALS["temp_skor_produksi"]) || get_class($GLOBALS["temp_skor_produksi"]) == PROJECT_NAMESPACE . "temp_skor_produksi") {
            $GLOBALS["temp_skor_produksi"] = &$this;
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
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_produksi');
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
                $doc = new $class(Container("temp_skor_produksi"));
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
                    if ($pageName == "tempskorproduksiview") {
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
        $this->skor_aktifitas->setVisibility();
        $this->max_aktifitas->setVisibility();
        $this->skor_kapasitas->setVisibility();
        $this->max_kapasitas->setVisibility();
        $this->skor_pangan->setVisibility();
        $this->max_pangan->setVisibility();
        $this->skor_sni->setVisibility();
        $this->max_sni->setVisibility();
        $this->skor_kemasan->setVisibility();
        $this->max_kemasan->setVisibility();
        $this->skor_bahanbaku->setVisibility();
        $this->max_bahanbaku->setVisibility();
        $this->skor_alat->setVisibility();
        $this->max_alat->setVisibility();
        $this->skor_gudang->setVisibility();
        $this->max_gudang->setVisibility();
        $this->skor_layout->setVisibility();
        $this->max_layout->setVisibility();
        $this->skor_sop->setVisibility();
        $this->max_sop->setVisibility();
        $this->skor_produksi->setVisibility();
        $this->maxskor_produksi->setVisibility();
        $this->bobot_produksi->setVisibility();
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
                        $this->terminate("tempskorproduksilist"); // Return to list page
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
                        $returnUrl = "tempskorproduksilist"; // No matching record, return to list
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
            $returnUrl = "tempskorproduksilist"; // Not page request, return to list
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
        $this->skor_aktifitas->setDbValue($row['skor_aktifitas']);
        $this->max_aktifitas->setDbValue($row['max_aktifitas']);
        $this->skor_kapasitas->setDbValue($row['skor_kapasitas']);
        $this->max_kapasitas->setDbValue($row['max_kapasitas']);
        $this->skor_pangan->setDbValue($row['skor_pangan']);
        $this->max_pangan->setDbValue($row['max_pangan']);
        $this->skor_sni->setDbValue($row['skor_sni']);
        $this->max_sni->setDbValue($row['max_sni']);
        $this->skor_kemasan->setDbValue($row['skor_kemasan']);
        $this->max_kemasan->setDbValue($row['max_kemasan']);
        $this->skor_bahanbaku->setDbValue($row['skor_bahanbaku']);
        $this->max_bahanbaku->setDbValue($row['max_bahanbaku']);
        $this->skor_alat->setDbValue($row['skor_alat']);
        $this->max_alat->setDbValue($row['max_alat']);
        $this->skor_gudang->setDbValue($row['skor_gudang']);
        $this->max_gudang->setDbValue($row['max_gudang']);
        $this->skor_layout->setDbValue($row['skor_layout']);
        $this->max_layout->setDbValue($row['max_layout']);
        $this->skor_sop->setDbValue($row['skor_sop']);
        $this->max_sop->setDbValue($row['max_sop']);
        $this->skor_produksi->setDbValue($row['skor_produksi']);
        $this->maxskor_produksi->setDbValue($row['maxskor_produksi']);
        $this->bobot_produksi->setDbValue($row['bobot_produksi']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_aktifitas'] = null;
        $row['max_aktifitas'] = null;
        $row['skor_kapasitas'] = null;
        $row['max_kapasitas'] = null;
        $row['skor_pangan'] = null;
        $row['max_pangan'] = null;
        $row['skor_sni'] = null;
        $row['max_sni'] = null;
        $row['skor_kemasan'] = null;
        $row['max_kemasan'] = null;
        $row['skor_bahanbaku'] = null;
        $row['max_bahanbaku'] = null;
        $row['skor_alat'] = null;
        $row['max_alat'] = null;
        $row['skor_gudang'] = null;
        $row['max_gudang'] = null;
        $row['skor_layout'] = null;
        $row['max_layout'] = null;
        $row['skor_sop'] = null;
        $row['max_sop'] = null;
        $row['skor_produksi'] = null;
        $row['maxskor_produksi'] = null;
        $row['bobot_produksi'] = null;
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
        if ($this->skor_aktifitas->FormValue == $this->skor_aktifitas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_aktifitas->CurrentValue))) {
            $this->skor_aktifitas->CurrentValue = ConvertToFloatString($this->skor_aktifitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_aktifitas->FormValue == $this->max_aktifitas->CurrentValue && is_numeric(ConvertToFloatString($this->max_aktifitas->CurrentValue))) {
            $this->max_aktifitas->CurrentValue = ConvertToFloatString($this->max_aktifitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kapasitas->FormValue == $this->skor_kapasitas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kapasitas->CurrentValue))) {
            $this->skor_kapasitas->CurrentValue = ConvertToFloatString($this->skor_kapasitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_kapasitas->FormValue == $this->max_kapasitas->CurrentValue && is_numeric(ConvertToFloatString($this->max_kapasitas->CurrentValue))) {
            $this->max_kapasitas->CurrentValue = ConvertToFloatString($this->max_kapasitas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pangan->FormValue == $this->skor_pangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pangan->CurrentValue))) {
            $this->skor_pangan->CurrentValue = ConvertToFloatString($this->skor_pangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pangan->FormValue == $this->max_pangan->CurrentValue && is_numeric(ConvertToFloatString($this->max_pangan->CurrentValue))) {
            $this->max_pangan->CurrentValue = ConvertToFloatString($this->max_pangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sni->FormValue == $this->skor_sni->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sni->CurrentValue))) {
            $this->skor_sni->CurrentValue = ConvertToFloatString($this->skor_sni->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_sni->FormValue == $this->max_sni->CurrentValue && is_numeric(ConvertToFloatString($this->max_sni->CurrentValue))) {
            $this->max_sni->CurrentValue = ConvertToFloatString($this->max_sni->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kemasan->FormValue == $this->skor_kemasan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kemasan->CurrentValue))) {
            $this->skor_kemasan->CurrentValue = ConvertToFloatString($this->skor_kemasan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_kemasan->FormValue == $this->max_kemasan->CurrentValue && is_numeric(ConvertToFloatString($this->max_kemasan->CurrentValue))) {
            $this->max_kemasan->CurrentValue = ConvertToFloatString($this->max_kemasan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_bahanbaku->FormValue == $this->skor_bahanbaku->CurrentValue && is_numeric(ConvertToFloatString($this->skor_bahanbaku->CurrentValue))) {
            $this->skor_bahanbaku->CurrentValue = ConvertToFloatString($this->skor_bahanbaku->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_bahanbaku->FormValue == $this->max_bahanbaku->CurrentValue && is_numeric(ConvertToFloatString($this->max_bahanbaku->CurrentValue))) {
            $this->max_bahanbaku->CurrentValue = ConvertToFloatString($this->max_bahanbaku->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_alat->FormValue == $this->skor_alat->CurrentValue && is_numeric(ConvertToFloatString($this->skor_alat->CurrentValue))) {
            $this->skor_alat->CurrentValue = ConvertToFloatString($this->skor_alat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_alat->FormValue == $this->max_alat->CurrentValue && is_numeric(ConvertToFloatString($this->max_alat->CurrentValue))) {
            $this->max_alat->CurrentValue = ConvertToFloatString($this->max_alat->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_gudang->FormValue == $this->skor_gudang->CurrentValue && is_numeric(ConvertToFloatString($this->skor_gudang->CurrentValue))) {
            $this->skor_gudang->CurrentValue = ConvertToFloatString($this->skor_gudang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_gudang->FormValue == $this->max_gudang->CurrentValue && is_numeric(ConvertToFloatString($this->max_gudang->CurrentValue))) {
            $this->max_gudang->CurrentValue = ConvertToFloatString($this->max_gudang->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_layout->FormValue == $this->skor_layout->CurrentValue && is_numeric(ConvertToFloatString($this->skor_layout->CurrentValue))) {
            $this->skor_layout->CurrentValue = ConvertToFloatString($this->skor_layout->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_layout->FormValue == $this->max_layout->CurrentValue && is_numeric(ConvertToFloatString($this->max_layout->CurrentValue))) {
            $this->max_layout->CurrentValue = ConvertToFloatString($this->max_layout->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sop->FormValue == $this->skor_sop->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sop->CurrentValue))) {
            $this->skor_sop->CurrentValue = ConvertToFloatString($this->skor_sop->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_sop->FormValue == $this->max_sop->CurrentValue && is_numeric(ConvertToFloatString($this->max_sop->CurrentValue))) {
            $this->max_sop->CurrentValue = ConvertToFloatString($this->max_sop->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_produksi->FormValue == $this->skor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_produksi->CurrentValue))) {
            $this->skor_produksi->CurrentValue = ConvertToFloatString($this->skor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_produksi->FormValue == $this->maxskor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_produksi->CurrentValue))) {
            $this->maxskor_produksi->CurrentValue = ConvertToFloatString($this->maxskor_produksi->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_aktifitas

        // max_aktifitas

        // skor_kapasitas

        // max_kapasitas

        // skor_pangan

        // max_pangan

        // skor_sni

        // max_sni

        // skor_kemasan

        // max_kemasan

        // skor_bahanbaku

        // max_bahanbaku

        // skor_alat

        // max_alat

        // skor_gudang

        // max_gudang

        // skor_layout

        // max_layout

        // skor_sop

        // max_sop

        // skor_produksi

        // maxskor_produksi

        // bobot_produksi
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_aktifitas
            $this->skor_aktifitas->ViewValue = $this->skor_aktifitas->CurrentValue;
            $this->skor_aktifitas->ViewValue = FormatNumber($this->skor_aktifitas->ViewValue, 2, -2, -2, -2);
            $this->skor_aktifitas->ViewCustomAttributes = "";

            // max_aktifitas
            $this->max_aktifitas->ViewValue = $this->max_aktifitas->CurrentValue;
            $this->max_aktifitas->ViewValue = FormatNumber($this->max_aktifitas->ViewValue, 2, -2, -2, -2);
            $this->max_aktifitas->ViewCustomAttributes = "";

            // skor_kapasitas
            $this->skor_kapasitas->ViewValue = $this->skor_kapasitas->CurrentValue;
            $this->skor_kapasitas->ViewValue = FormatNumber($this->skor_kapasitas->ViewValue, 2, -2, -2, -2);
            $this->skor_kapasitas->ViewCustomAttributes = "";

            // max_kapasitas
            $this->max_kapasitas->ViewValue = $this->max_kapasitas->CurrentValue;
            $this->max_kapasitas->ViewValue = FormatNumber($this->max_kapasitas->ViewValue, 2, -2, -2, -2);
            $this->max_kapasitas->ViewCustomAttributes = "";

            // skor_pangan
            $this->skor_pangan->ViewValue = $this->skor_pangan->CurrentValue;
            $this->skor_pangan->ViewValue = FormatNumber($this->skor_pangan->ViewValue, 2, -2, -2, -2);
            $this->skor_pangan->ViewCustomAttributes = "";

            // max_pangan
            $this->max_pangan->ViewValue = $this->max_pangan->CurrentValue;
            $this->max_pangan->ViewValue = FormatNumber($this->max_pangan->ViewValue, 2, -2, -2, -2);
            $this->max_pangan->ViewCustomAttributes = "";

            // skor_sni
            $this->skor_sni->ViewValue = $this->skor_sni->CurrentValue;
            $this->skor_sni->ViewValue = FormatNumber($this->skor_sni->ViewValue, 2, -2, -2, -2);
            $this->skor_sni->ViewCustomAttributes = "";

            // max_sni
            $this->max_sni->ViewValue = $this->max_sni->CurrentValue;
            $this->max_sni->ViewValue = FormatNumber($this->max_sni->ViewValue, 2, -2, -2, -2);
            $this->max_sni->ViewCustomAttributes = "";

            // skor_kemasan
            $this->skor_kemasan->ViewValue = $this->skor_kemasan->CurrentValue;
            $this->skor_kemasan->ViewValue = FormatNumber($this->skor_kemasan->ViewValue, 2, -2, -2, -2);
            $this->skor_kemasan->ViewCustomAttributes = "";

            // max_kemasan
            $this->max_kemasan->ViewValue = $this->max_kemasan->CurrentValue;
            $this->max_kemasan->ViewValue = FormatNumber($this->max_kemasan->ViewValue, 2, -2, -2, -2);
            $this->max_kemasan->ViewCustomAttributes = "";

            // skor_bahanbaku
            $this->skor_bahanbaku->ViewValue = $this->skor_bahanbaku->CurrentValue;
            $this->skor_bahanbaku->ViewValue = FormatNumber($this->skor_bahanbaku->ViewValue, 2, -2, -2, -2);
            $this->skor_bahanbaku->ViewCustomAttributes = "";

            // max_bahanbaku
            $this->max_bahanbaku->ViewValue = $this->max_bahanbaku->CurrentValue;
            $this->max_bahanbaku->ViewValue = FormatNumber($this->max_bahanbaku->ViewValue, 2, -2, -2, -2);
            $this->max_bahanbaku->ViewCustomAttributes = "";

            // skor_alat
            $this->skor_alat->ViewValue = $this->skor_alat->CurrentValue;
            $this->skor_alat->ViewValue = FormatNumber($this->skor_alat->ViewValue, 2, -2, -2, -2);
            $this->skor_alat->ViewCustomAttributes = "";

            // max_alat
            $this->max_alat->ViewValue = $this->max_alat->CurrentValue;
            $this->max_alat->ViewValue = FormatNumber($this->max_alat->ViewValue, 2, -2, -2, -2);
            $this->max_alat->ViewCustomAttributes = "";

            // skor_gudang
            $this->skor_gudang->ViewValue = $this->skor_gudang->CurrentValue;
            $this->skor_gudang->ViewValue = FormatNumber($this->skor_gudang->ViewValue, 2, -2, -2, -2);
            $this->skor_gudang->ViewCustomAttributes = "";

            // max_gudang
            $this->max_gudang->ViewValue = $this->max_gudang->CurrentValue;
            $this->max_gudang->ViewValue = FormatNumber($this->max_gudang->ViewValue, 2, -2, -2, -2);
            $this->max_gudang->ViewCustomAttributes = "";

            // skor_layout
            $this->skor_layout->ViewValue = $this->skor_layout->CurrentValue;
            $this->skor_layout->ViewValue = FormatNumber($this->skor_layout->ViewValue, 2, -2, -2, -2);
            $this->skor_layout->ViewCustomAttributes = "";

            // max_layout
            $this->max_layout->ViewValue = $this->max_layout->CurrentValue;
            $this->max_layout->ViewValue = FormatNumber($this->max_layout->ViewValue, 2, -2, -2, -2);
            $this->max_layout->ViewCustomAttributes = "";

            // skor_sop
            $this->skor_sop->ViewValue = $this->skor_sop->CurrentValue;
            $this->skor_sop->ViewValue = FormatNumber($this->skor_sop->ViewValue, 2, -2, -2, -2);
            $this->skor_sop->ViewCustomAttributes = "";

            // max_sop
            $this->max_sop->ViewValue = $this->max_sop->CurrentValue;
            $this->max_sop->ViewValue = FormatNumber($this->max_sop->ViewValue, 2, -2, -2, -2);
            $this->max_sop->ViewCustomAttributes = "";

            // skor_produksi
            $this->skor_produksi->ViewValue = $this->skor_produksi->CurrentValue;
            $this->skor_produksi->ViewValue = FormatNumber($this->skor_produksi->ViewValue, 2, -2, -2, -2);
            $this->skor_produksi->ViewCustomAttributes = "";

            // maxskor_produksi
            $this->maxskor_produksi->ViewValue = $this->maxskor_produksi->CurrentValue;
            $this->maxskor_produksi->ViewValue = FormatNumber($this->maxskor_produksi->ViewValue, 2, -2, -2, -2);
            $this->maxskor_produksi->ViewCustomAttributes = "";

            // bobot_produksi
            $this->bobot_produksi->ViewValue = $this->bobot_produksi->CurrentValue;
            $this->bobot_produksi->ViewValue = FormatNumber($this->bobot_produksi->ViewValue, 0, -2, -2, -2);
            $this->bobot_produksi->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_aktifitas
            $this->skor_aktifitas->LinkCustomAttributes = "";
            $this->skor_aktifitas->HrefValue = "";
            $this->skor_aktifitas->TooltipValue = "";

            // max_aktifitas
            $this->max_aktifitas->LinkCustomAttributes = "";
            $this->max_aktifitas->HrefValue = "";
            $this->max_aktifitas->TooltipValue = "";

            // skor_kapasitas
            $this->skor_kapasitas->LinkCustomAttributes = "";
            $this->skor_kapasitas->HrefValue = "";
            $this->skor_kapasitas->TooltipValue = "";

            // max_kapasitas
            $this->max_kapasitas->LinkCustomAttributes = "";
            $this->max_kapasitas->HrefValue = "";
            $this->max_kapasitas->TooltipValue = "";

            // skor_pangan
            $this->skor_pangan->LinkCustomAttributes = "";
            $this->skor_pangan->HrefValue = "";
            $this->skor_pangan->TooltipValue = "";

            // max_pangan
            $this->max_pangan->LinkCustomAttributes = "";
            $this->max_pangan->HrefValue = "";
            $this->max_pangan->TooltipValue = "";

            // skor_sni
            $this->skor_sni->LinkCustomAttributes = "";
            $this->skor_sni->HrefValue = "";
            $this->skor_sni->TooltipValue = "";

            // max_sni
            $this->max_sni->LinkCustomAttributes = "";
            $this->max_sni->HrefValue = "";
            $this->max_sni->TooltipValue = "";

            // skor_kemasan
            $this->skor_kemasan->LinkCustomAttributes = "";
            $this->skor_kemasan->HrefValue = "";
            $this->skor_kemasan->TooltipValue = "";

            // max_kemasan
            $this->max_kemasan->LinkCustomAttributes = "";
            $this->max_kemasan->HrefValue = "";
            $this->max_kemasan->TooltipValue = "";

            // skor_bahanbaku
            $this->skor_bahanbaku->LinkCustomAttributes = "";
            $this->skor_bahanbaku->HrefValue = "";
            $this->skor_bahanbaku->TooltipValue = "";

            // max_bahanbaku
            $this->max_bahanbaku->LinkCustomAttributes = "";
            $this->max_bahanbaku->HrefValue = "";
            $this->max_bahanbaku->TooltipValue = "";

            // skor_alat
            $this->skor_alat->LinkCustomAttributes = "";
            $this->skor_alat->HrefValue = "";
            $this->skor_alat->TooltipValue = "";

            // max_alat
            $this->max_alat->LinkCustomAttributes = "";
            $this->max_alat->HrefValue = "";
            $this->max_alat->TooltipValue = "";

            // skor_gudang
            $this->skor_gudang->LinkCustomAttributes = "";
            $this->skor_gudang->HrefValue = "";
            $this->skor_gudang->TooltipValue = "";

            // max_gudang
            $this->max_gudang->LinkCustomAttributes = "";
            $this->max_gudang->HrefValue = "";
            $this->max_gudang->TooltipValue = "";

            // skor_layout
            $this->skor_layout->LinkCustomAttributes = "";
            $this->skor_layout->HrefValue = "";
            $this->skor_layout->TooltipValue = "";

            // max_layout
            $this->max_layout->LinkCustomAttributes = "";
            $this->max_layout->HrefValue = "";
            $this->max_layout->TooltipValue = "";

            // skor_sop
            $this->skor_sop->LinkCustomAttributes = "";
            $this->skor_sop->HrefValue = "";
            $this->skor_sop->TooltipValue = "";

            // max_sop
            $this->max_sop->LinkCustomAttributes = "";
            $this->max_sop->HrefValue = "";
            $this->max_sop->TooltipValue = "";

            // skor_produksi
            $this->skor_produksi->LinkCustomAttributes = "";
            $this->skor_produksi->HrefValue = "";
            $this->skor_produksi->TooltipValue = "";

            // maxskor_produksi
            $this->maxskor_produksi->LinkCustomAttributes = "";
            $this->maxskor_produksi->HrefValue = "";
            $this->maxskor_produksi->TooltipValue = "";

            // bobot_produksi
            $this->bobot_produksi->LinkCustomAttributes = "";
            $this->bobot_produksi->HrefValue = "";
            $this->bobot_produksi->TooltipValue = "";
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
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.ftemp_skor_produksiview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.ftemp_skor_produksiview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.ftemp_skor_produksiview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_temp_skor_produksi" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_temp_skor_produksi\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.ftemp_skor_produksiview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorproduksilist"), "", $this->TableVar, true);
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
