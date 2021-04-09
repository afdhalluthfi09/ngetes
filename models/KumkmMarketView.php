<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class KumkmMarketView extends KumkmMarket
{
    use MessagesTrait;

    // Page ID
    public $PageID = "view";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'kumkm_market';

    // Page object name
    public $PageObjName = "KumkmMarketView";

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

        // Table object (kumkm_market)
        if (!isset($GLOBALS["kumkm_market"]) || get_class($GLOBALS["kumkm_market"]) == PROJECT_NAMESPACE . "kumkm_market") {
            $GLOBALS["kumkm_market"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();
        if (($keyValue = Get("id") ?? Route("id")) !== null) {
            $this->RecKey["id"] = $keyValue;
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

            // Handle modal response
            if ($this->IsModal) { // Show as modal
                $row = ["url" => GetUrl($url), "modal" => "1"];
                $pageName = GetPageName($url);
                if ($pageName != $this->getListUrl()) { // Not List page
                    $row["caption"] = $this->getModalCaption($pageName);
                    if ($pageName == "kumkmmarketview") {
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
        if (Get("id") !== null) {
            if ($ExportFileName != "") {
                $ExportFileName .= "_";
            }
            $ExportFileName .= Get("id");
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
        $this->id->setVisibility();
        $this->produk_foto->setVisibility();
        $this->nik_ukm->setVisibility();
        $this->produk_nama->setVisibility();
        $this->produk_jenis->setVisibility();
        $this->produk_desc->setVisibility();
        $this->produk_harga->setVisibility();
        $this->kurasi->setVisibility();
        $this->waktu_entry->setVisibility();
        $this->waktu_kurasi->setVisibility();
        $this->waktu_update->setVisibility();
        $this->editor->setVisibility();
        $this->kurator->setVisibility();
        $this->produk_legal->setVisibility();
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
        $this->catatan->setVisibility();
        $this->market->setVisibility();
        $this->yia_sku->setVisibility();
        $this->yia_idproduk->setVisibility();
        $this->yia_stok_alert->setVisibility();
        $this->produk_foto_4->setVisibility();
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
            if (($keyValue = Get("id") ?? Route("id")) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
            } elseif (Post("id") !== null) {
                $this->id->setFormValue(Post("id"));
                $this->RecKey["id"] = $this->id->FormValue;
            } elseif (IsApi() && ($keyValue = Key(0) ?? Route(2)) !== null) {
                $this->id->setQueryStringValue($keyValue);
                $this->RecKey["id"] = $this->id->QueryStringValue;
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
                        $this->terminate("kumkmmarketlist"); // Return to list page
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
                            if (SameString($this->id->CurrentValue, $this->Recordset->fields['id'])) {
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
                        $returnUrl = "kumkmmarketlist"; // No matching record, return to list
                    } else {
                        $this->loadRowValues($this->Recordset); // Load row values
                    }
                    break;
            }
        } else {
            $returnUrl = "kumkmmarketlist"; // Not page request, return to list
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

        // produk_foto

        // nik_ukm

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // kurasi

        // waktu_entry

        // waktu_kurasi

        // waktu_update

        // editor

        // kurator

        // produk_legal

        // judul_sesuai

        // foto_bagus

        // deskripsi_jelas

        // harga_tidak_kosong

        // berat_tidak_kosong

        // produk_berat

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // produk_harga_dasar

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // catatan

        // market

        // yia_sku

        // yia_idproduk

        // yia_stok_alert

        // produk_foto_4
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

            // produk_desc
            $this->produk_desc->ViewValue = $this->produk_desc->CurrentValue;
            $this->produk_desc->ViewCustomAttributes = "";

            // produk_harga
            $this->produk_harga->ViewValue = $this->produk_harga->CurrentValue;
            $this->produk_harga->ViewValue = FormatNumber($this->produk_harga->ViewValue, 2, -2, -2, -2);
            $this->produk_harga->ViewCustomAttributes = "";

            // kurator
            $this->kurator->ViewValue = $this->kurator->CurrentValue;
            $this->kurator->ViewCustomAttributes = "";

            // produk_legal
            if (strval($this->produk_legal->CurrentValue) != "") {
                $this->produk_legal->ViewValue = $this->produk_legal->optionCaption($this->produk_legal->CurrentValue);
            } else {
                $this->produk_legal->ViewValue = null;
            }
            $this->produk_legal->ViewCustomAttributes = "";

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

            // produk_desc
            $this->produk_desc->LinkCustomAttributes = "";
            $this->produk_desc->HrefValue = "";
            $this->produk_desc->TooltipValue = "";

            // produk_harga
            $this->produk_harga->LinkCustomAttributes = "";
            $this->produk_harga->HrefValue = "";
            $this->produk_harga->TooltipValue = "";

            // kurator
            $this->kurator->LinkCustomAttributes = "";
            $this->kurator->HrefValue = "";
            $this->kurator->TooltipValue = "";

            // produk_legal
            $this->produk_legal->LinkCustomAttributes = "";
            $this->produk_legal->HrefValue = "";
            $this->produk_legal->TooltipValue = "";

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
                $this->produk_foto_1->LinkAttrs["data-rel"] = "kumkm_market_x_produk_foto_1";
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
                $this->produk_foto_2->LinkAttrs["data-rel"] = "kumkm_market_x_produk_foto_2";
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
                $this->produk_foto_3->LinkAttrs["data-rel"] = "kumkm_market_x_produk_foto_3";
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

    // Get export HTML tag
    protected function getExportTag($type, $custom = false)
    {
        global $Language;
        $pageUrl = $this->pageUrl();
        if (SameText($type, "excel")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" onclick=\"return ew.export(document.fkumkm_marketview, '" . $this->ExportExcelUrl . "', 'excel', true);\">" . $Language->phrase("ExportToExcel") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ew-export-link ew-excel\" title=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToExcelText")) . "\">" . $Language->phrase("ExportToExcel") . "</a>";
            }
        } elseif (SameText($type, "word")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" onclick=\"return ew.export(document.fkumkm_marketview, '" . $this->ExportWordUrl . "', 'word', true);\">" . $Language->phrase("ExportToWord") . "</a>";
            } else {
                return "<a href=\"" . $this->ExportWordUrl . "\" class=\"ew-export-link ew-word\" title=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToWordText")) . "\">" . $Language->phrase("ExportToWord") . "</a>";
            }
        } elseif (SameText($type, "pdf")) {
            if ($custom) {
                return "<a href=\"#\" class=\"ew-export-link ew-pdf\" title=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" data-caption=\"" . HtmlEncode($Language->phrase("ExportToPDFText")) . "\" onclick=\"return ew.export(document.fkumkm_marketview, '" . $this->ExportPdfUrl . "', 'pdf', true);\">" . $Language->phrase("ExportToPDF") . "</a>";
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
            return '<button id="emf_kumkm_market" class="ew-export-link ew-email" title="' . $Language->phrase("ExportToEmailText") . '" data-caption="' . $Language->phrase("ExportToEmailText") . '" onclick="ew.emailDialogShow({lnk:\'emf_kumkm_market\', hdr:ew.language.phrase(\'ExportToEmailText\'), f:document.fkumkm_marketview, key:' . ArrayToJsonAttribute($this->RecKey) . ', sel:false' . $url . '});">' . $Language->phrase("ExportToEmail") . '</button>';
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

        // Hide options for export
        if ($this->isExport()) {
            $this->ExportOptions->hideAllOptions();
        }
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kumkmmarketlist"), "", $this->TableVar, true);
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
