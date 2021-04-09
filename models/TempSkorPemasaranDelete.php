<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorPemasaranDelete extends TempSkorPemasaran
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_pemasaran';

    // Page object name
    public $PageObjName = "TempSkorPemasaranDelete";

    // Rendering View
    public $RenderingView = false;

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

        // Table object (temp_skor_pemasaran)
        if (!isset($GLOBALS["temp_skor_pemasaran"]) || get_class($GLOBALS["temp_skor_pemasaran"]) == PROJECT_NAMESPACE . "temp_skor_pemasaran") {
            $GLOBALS["temp_skor_pemasaran"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_pemasaran');
        }

        // Start timer
        $DebugTimer = Container("timer");

        // Debug message
        LoadDebugMessage();

        // Open connection
        $GLOBALS["Conn"] = $GLOBALS["Conn"] ?? $this->getConnection();

        // User table object
        $UserTable = Container("usertable");
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
                $doc = new $class(Container("temp_skor_pemasaran"));
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
    public $DbMasterFilter = "";
    public $DbDetailFilter = "";
    public $StartRecord;
    public $TotalRecords = 0;
    public $RecordCount;
    public $RecKeys = [];
    public $StartRowCount = 1;
    public $RowCount = 0;

    /**
     * Page run
     *
     * @return void
     */
    public function run()
    {
        global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $CurrentForm;
        $this->CurrentAction = Param("action"); // Set up current action
        $this->nik->setVisibility();
        $this->skor_unggul->setVisibility();
        $this->max_unggul->setVisibility();
        $this->skor_target->setVisibility();
        $this->max_target->setVisibility();
        $this->skor_available->setVisibility();
        $this->max_available->setVisibility();
        $this->skor_merk->setVisibility();
        $this->max_merk->setVisibility();
        $this->skor_merkhaki->setVisibility();
        $this->max_merkhaki->setVisibility();
        $this->skor_merkkonsep->setVisibility();
        $this->max_merkkonsep->setVisibility();
        $this->skor_merklisensi->setVisibility();
        $this->max_merklisensi->setVisibility();
        $this->skor_mitra->setVisibility();
        $this->max_mitra->setVisibility();
        $this->skor_market->setVisibility();
        $this->max_market->setVisibility();
        $this->skor_pelangganloyal->setVisibility();
        $this->max_pelangganloyal->setVisibility();
        $this->skor_pameranmandiri->setVisibility();
        $this->max_pameranmandiri->setVisibility();
        $this->skor_mediaoffline->setVisibility();
        $this->max_mediaoffline->setVisibility();
        $this->skor_pemasaran->setVisibility();
        $this->maxskor_pemasaran->setVisibility();
        $this->bobot_pemasaran->setVisibility();
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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("tempskorpemasaranlist"); // Prevent SQL injection, return to list
            return;
        }

        // Set up filter (WHERE Clause)
        $this->CurrentFilter = $filter;

        // Get action
        if (IsApi()) {
            $this->CurrentAction = "delete"; // Delete record directly
        } elseif (Post("action") !== null) {
            $this->CurrentAction = Post("action");
        } elseif (Get("action") == "1") {
            $this->CurrentAction = "delete"; // Delete record directly
        } else {
            $this->CurrentAction = "show"; // Display record
        }
        if ($this->isDelete()) {
            $this->SendEmail = true; // Send email on delete success
            if ($this->deleteRows()) { // Delete rows
                if ($this->getSuccessMessage() == "") {
                    $this->setSuccessMessage($Language->phrase("DeleteSuccess")); // Set up success message
                }
                if (IsApi()) {
                    $this->terminate(true);
                    return;
                } else {
                    $this->terminate($this->getReturnUrl()); // Return to caller
                    return;
                }
            } else { // Delete failed
                if (IsApi()) {
                    $this->terminate();
                    return;
                }
                $this->CurrentAction = "show"; // Display record
            }
        }
        if ($this->isShow()) { // Load records for display
            if ($this->Recordset = $this->loadRecordset()) {
                $this->TotalRecords = $this->Recordset->recordCount(); // Get record count
            }
            if ($this->TotalRecords <= 0) { // No record found, exit
                if ($this->Recordset) {
                    $this->Recordset->close();
                }
                $this->terminate("tempskorpemasaranlist"); // Return to list
                return;
            }
        }

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
        $this->skor_unggul->setDbValue($row['skor_unggul']);
        $this->max_unggul->setDbValue($row['max_unggul']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_available->setDbValue($row['skor_available']);
        $this->max_available->setDbValue($row['max_available']);
        $this->skor_merk->setDbValue($row['skor_merk']);
        $this->max_merk->setDbValue($row['max_merk']);
        $this->skor_merkhaki->setDbValue($row['skor_merkhaki']);
        $this->max_merkhaki->setDbValue($row['max_merkhaki']);
        $this->skor_merkkonsep->setDbValue($row['skor_merkkonsep']);
        $this->max_merkkonsep->setDbValue($row['max_merkkonsep']);
        $this->skor_merklisensi->setDbValue($row['skor_merklisensi']);
        $this->max_merklisensi->setDbValue($row['max_merklisensi']);
        $this->skor_mitra->setDbValue($row['skor_mitra']);
        $this->max_mitra->setDbValue($row['max_mitra']);
        $this->skor_market->setDbValue($row['skor_market']);
        $this->max_market->setDbValue($row['max_market']);
        $this->skor_pelangganloyal->setDbValue($row['skor_pelangganloyal']);
        $this->max_pelangganloyal->setDbValue($row['max_pelangganloyal']);
        $this->skor_pameranmandiri->setDbValue($row['skor_pameranmandiri']);
        $this->max_pameranmandiri->setDbValue($row['max_pameranmandiri']);
        $this->skor_mediaoffline->setDbValue($row['skor_mediaoffline']);
        $this->max_mediaoffline->setDbValue($row['max_mediaoffline']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_unggul'] = null;
        $row['max_unggul'] = null;
        $row['skor_target'] = null;
        $row['max_target'] = null;
        $row['skor_available'] = null;
        $row['max_available'] = null;
        $row['skor_merk'] = null;
        $row['max_merk'] = null;
        $row['skor_merkhaki'] = null;
        $row['max_merkhaki'] = null;
        $row['skor_merkkonsep'] = null;
        $row['max_merkkonsep'] = null;
        $row['skor_merklisensi'] = null;
        $row['max_merklisensi'] = null;
        $row['skor_mitra'] = null;
        $row['max_mitra'] = null;
        $row['skor_market'] = null;
        $row['max_market'] = null;
        $row['skor_pelangganloyal'] = null;
        $row['max_pelangganloyal'] = null;
        $row['skor_pameranmandiri'] = null;
        $row['max_pameranmandiri'] = null;
        $row['skor_mediaoffline'] = null;
        $row['max_mediaoffline'] = null;
        $row['skor_pemasaran'] = null;
        $row['maxskor_pemasaran'] = null;
        $row['bobot_pemasaran'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_unggul->FormValue == $this->skor_unggul->CurrentValue && is_numeric(ConvertToFloatString($this->skor_unggul->CurrentValue))) {
            $this->skor_unggul->CurrentValue = ConvertToFloatString($this->skor_unggul->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_unggul->FormValue == $this->max_unggul->CurrentValue && is_numeric(ConvertToFloatString($this->max_unggul->CurrentValue))) {
            $this->max_unggul->CurrentValue = ConvertToFloatString($this->max_unggul->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_target->FormValue == $this->skor_target->CurrentValue && is_numeric(ConvertToFloatString($this->skor_target->CurrentValue))) {
            $this->skor_target->CurrentValue = ConvertToFloatString($this->skor_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_target->FormValue == $this->max_target->CurrentValue && is_numeric(ConvertToFloatString($this->max_target->CurrentValue))) {
            $this->max_target->CurrentValue = ConvertToFloatString($this->max_target->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_available->FormValue == $this->skor_available->CurrentValue && is_numeric(ConvertToFloatString($this->skor_available->CurrentValue))) {
            $this->skor_available->CurrentValue = ConvertToFloatString($this->skor_available->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_available->FormValue == $this->max_available->CurrentValue && is_numeric(ConvertToFloatString($this->max_available->CurrentValue))) {
            $this->max_available->CurrentValue = ConvertToFloatString($this->max_available->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merk->FormValue == $this->skor_merk->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merk->CurrentValue))) {
            $this->skor_merk->CurrentValue = ConvertToFloatString($this->skor_merk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merk->FormValue == $this->max_merk->CurrentValue && is_numeric(ConvertToFloatString($this->max_merk->CurrentValue))) {
            $this->max_merk->CurrentValue = ConvertToFloatString($this->max_merk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merkhaki->FormValue == $this->skor_merkhaki->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merkhaki->CurrentValue))) {
            $this->skor_merkhaki->CurrentValue = ConvertToFloatString($this->skor_merkhaki->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merkhaki->FormValue == $this->max_merkhaki->CurrentValue && is_numeric(ConvertToFloatString($this->max_merkhaki->CurrentValue))) {
            $this->max_merkhaki->CurrentValue = ConvertToFloatString($this->max_merkhaki->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merkkonsep->FormValue == $this->skor_merkkonsep->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merkkonsep->CurrentValue))) {
            $this->skor_merkkonsep->CurrentValue = ConvertToFloatString($this->skor_merkkonsep->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merkkonsep->FormValue == $this->max_merkkonsep->CurrentValue && is_numeric(ConvertToFloatString($this->max_merkkonsep->CurrentValue))) {
            $this->max_merkkonsep->CurrentValue = ConvertToFloatString($this->max_merkkonsep->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_merklisensi->FormValue == $this->skor_merklisensi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_merklisensi->CurrentValue))) {
            $this->skor_merklisensi->CurrentValue = ConvertToFloatString($this->skor_merklisensi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_merklisensi->FormValue == $this->max_merklisensi->CurrentValue && is_numeric(ConvertToFloatString($this->max_merklisensi->CurrentValue))) {
            $this->max_merklisensi->CurrentValue = ConvertToFloatString($this->max_merklisensi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mitra->FormValue == $this->skor_mitra->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mitra->CurrentValue))) {
            $this->skor_mitra->CurrentValue = ConvertToFloatString($this->skor_mitra->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mitra->FormValue == $this->max_mitra->CurrentValue && is_numeric(ConvertToFloatString($this->max_mitra->CurrentValue))) {
            $this->max_mitra->CurrentValue = ConvertToFloatString($this->max_mitra->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_market->FormValue == $this->skor_market->CurrentValue && is_numeric(ConvertToFloatString($this->skor_market->CurrentValue))) {
            $this->skor_market->CurrentValue = ConvertToFloatString($this->skor_market->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_market->FormValue == $this->max_market->CurrentValue && is_numeric(ConvertToFloatString($this->max_market->CurrentValue))) {
            $this->max_market->CurrentValue = ConvertToFloatString($this->max_market->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pelangganloyal->FormValue == $this->skor_pelangganloyal->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pelangganloyal->CurrentValue))) {
            $this->skor_pelangganloyal->CurrentValue = ConvertToFloatString($this->skor_pelangganloyal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pelangganloyal->FormValue == $this->max_pelangganloyal->CurrentValue && is_numeric(ConvertToFloatString($this->max_pelangganloyal->CurrentValue))) {
            $this->max_pelangganloyal->CurrentValue = ConvertToFloatString($this->max_pelangganloyal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pameranmandiri->FormValue == $this->skor_pameranmandiri->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pameranmandiri->CurrentValue))) {
            $this->skor_pameranmandiri->CurrentValue = ConvertToFloatString($this->skor_pameranmandiri->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pameranmandiri->FormValue == $this->max_pameranmandiri->CurrentValue && is_numeric(ConvertToFloatString($this->max_pameranmandiri->CurrentValue))) {
            $this->max_pameranmandiri->CurrentValue = ConvertToFloatString($this->max_pameranmandiri->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mediaoffline->FormValue == $this->skor_mediaoffline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mediaoffline->CurrentValue))) {
            $this->skor_mediaoffline->CurrentValue = ConvertToFloatString($this->skor_mediaoffline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mediaoffline->FormValue == $this->max_mediaoffline->CurrentValue && is_numeric(ConvertToFloatString($this->max_mediaoffline->CurrentValue))) {
            $this->max_mediaoffline->CurrentValue = ConvertToFloatString($this->max_mediaoffline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaran->FormValue == $this->skor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaran->CurrentValue))) {
            $this->skor_pemasaran->CurrentValue = ConvertToFloatString($this->skor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaran->FormValue == $this->maxskor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaran->CurrentValue))) {
            $this->maxskor_pemasaran->CurrentValue = ConvertToFloatString($this->maxskor_pemasaran->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_unggul

        // max_unggul

        // skor_target

        // max_target

        // skor_available

        // max_available

        // skor_merk

        // max_merk

        // skor_merkhaki

        // max_merkhaki

        // skor_merkkonsep

        // max_merkkonsep

        // skor_merklisensi

        // max_merklisensi

        // skor_mitra

        // max_mitra

        // skor_market

        // max_market

        // skor_pelangganloyal

        // max_pelangganloyal

        // skor_pameranmandiri

        // max_pameranmandiri

        // skor_mediaoffline

        // max_mediaoffline

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_unggul
            $this->skor_unggul->ViewValue = $this->skor_unggul->CurrentValue;
            $this->skor_unggul->ViewValue = FormatNumber($this->skor_unggul->ViewValue, 2, -2, -2, -2);
            $this->skor_unggul->ViewCustomAttributes = "";

            // max_unggul
            $this->max_unggul->ViewValue = $this->max_unggul->CurrentValue;
            $this->max_unggul->ViewValue = FormatNumber($this->max_unggul->ViewValue, 2, -2, -2, -2);
            $this->max_unggul->ViewCustomAttributes = "";

            // skor_target
            $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
            $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
            $this->skor_target->ViewCustomAttributes = "";

            // max_target
            $this->max_target->ViewValue = $this->max_target->CurrentValue;
            $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
            $this->max_target->ViewCustomAttributes = "";

            // skor_available
            $this->skor_available->ViewValue = $this->skor_available->CurrentValue;
            $this->skor_available->ViewValue = FormatNumber($this->skor_available->ViewValue, 2, -2, -2, -2);
            $this->skor_available->ViewCustomAttributes = "";

            // max_available
            $this->max_available->ViewValue = $this->max_available->CurrentValue;
            $this->max_available->ViewValue = FormatNumber($this->max_available->ViewValue, 2, -2, -2, -2);
            $this->max_available->ViewCustomAttributes = "";

            // skor_merk
            $this->skor_merk->ViewValue = $this->skor_merk->CurrentValue;
            $this->skor_merk->ViewValue = FormatNumber($this->skor_merk->ViewValue, 2, -2, -2, -2);
            $this->skor_merk->ViewCustomAttributes = "";

            // max_merk
            $this->max_merk->ViewValue = $this->max_merk->CurrentValue;
            $this->max_merk->ViewValue = FormatNumber($this->max_merk->ViewValue, 2, -2, -2, -2);
            $this->max_merk->ViewCustomAttributes = "";

            // skor_merkhaki
            $this->skor_merkhaki->ViewValue = $this->skor_merkhaki->CurrentValue;
            $this->skor_merkhaki->ViewValue = FormatNumber($this->skor_merkhaki->ViewValue, 2, -2, -2, -2);
            $this->skor_merkhaki->ViewCustomAttributes = "";

            // max_merkhaki
            $this->max_merkhaki->ViewValue = $this->max_merkhaki->CurrentValue;
            $this->max_merkhaki->ViewValue = FormatNumber($this->max_merkhaki->ViewValue, 2, -2, -2, -2);
            $this->max_merkhaki->ViewCustomAttributes = "";

            // skor_merkkonsep
            $this->skor_merkkonsep->ViewValue = $this->skor_merkkonsep->CurrentValue;
            $this->skor_merkkonsep->ViewValue = FormatNumber($this->skor_merkkonsep->ViewValue, 2, -2, -2, -2);
            $this->skor_merkkonsep->ViewCustomAttributes = "";

            // max_merkkonsep
            $this->max_merkkonsep->ViewValue = $this->max_merkkonsep->CurrentValue;
            $this->max_merkkonsep->ViewValue = FormatNumber($this->max_merkkonsep->ViewValue, 2, -2, -2, -2);
            $this->max_merkkonsep->ViewCustomAttributes = "";

            // skor_merklisensi
            $this->skor_merklisensi->ViewValue = $this->skor_merklisensi->CurrentValue;
            $this->skor_merklisensi->ViewValue = FormatNumber($this->skor_merklisensi->ViewValue, 2, -2, -2, -2);
            $this->skor_merklisensi->ViewCustomAttributes = "";

            // max_merklisensi
            $this->max_merklisensi->ViewValue = $this->max_merklisensi->CurrentValue;
            $this->max_merklisensi->ViewValue = FormatNumber($this->max_merklisensi->ViewValue, 2, -2, -2, -2);
            $this->max_merklisensi->ViewCustomAttributes = "";

            // skor_mitra
            $this->skor_mitra->ViewValue = $this->skor_mitra->CurrentValue;
            $this->skor_mitra->ViewValue = FormatNumber($this->skor_mitra->ViewValue, 2, -2, -2, -2);
            $this->skor_mitra->ViewCustomAttributes = "";

            // max_mitra
            $this->max_mitra->ViewValue = $this->max_mitra->CurrentValue;
            $this->max_mitra->ViewValue = FormatNumber($this->max_mitra->ViewValue, 2, -2, -2, -2);
            $this->max_mitra->ViewCustomAttributes = "";

            // skor_market
            $this->skor_market->ViewValue = $this->skor_market->CurrentValue;
            $this->skor_market->ViewValue = FormatNumber($this->skor_market->ViewValue, 2, -2, -2, -2);
            $this->skor_market->ViewCustomAttributes = "";

            // max_market
            $this->max_market->ViewValue = $this->max_market->CurrentValue;
            $this->max_market->ViewValue = FormatNumber($this->max_market->ViewValue, 2, -2, -2, -2);
            $this->max_market->ViewCustomAttributes = "";

            // skor_pelangganloyal
            $this->skor_pelangganloyal->ViewValue = $this->skor_pelangganloyal->CurrentValue;
            $this->skor_pelangganloyal->ViewValue = FormatNumber($this->skor_pelangganloyal->ViewValue, 2, -2, -2, -2);
            $this->skor_pelangganloyal->ViewCustomAttributes = "";

            // max_pelangganloyal
            $this->max_pelangganloyal->ViewValue = $this->max_pelangganloyal->CurrentValue;
            $this->max_pelangganloyal->ViewValue = FormatNumber($this->max_pelangganloyal->ViewValue, 2, -2, -2, -2);
            $this->max_pelangganloyal->ViewCustomAttributes = "";

            // skor_pameranmandiri
            $this->skor_pameranmandiri->ViewValue = $this->skor_pameranmandiri->CurrentValue;
            $this->skor_pameranmandiri->ViewValue = FormatNumber($this->skor_pameranmandiri->ViewValue, 2, -2, -2, -2);
            $this->skor_pameranmandiri->ViewCustomAttributes = "";

            // max_pameranmandiri
            $this->max_pameranmandiri->ViewValue = $this->max_pameranmandiri->CurrentValue;
            $this->max_pameranmandiri->ViewValue = FormatNumber($this->max_pameranmandiri->ViewValue, 2, -2, -2, -2);
            $this->max_pameranmandiri->ViewCustomAttributes = "";

            // skor_mediaoffline
            $this->skor_mediaoffline->ViewValue = $this->skor_mediaoffline->CurrentValue;
            $this->skor_mediaoffline->ViewValue = FormatNumber($this->skor_mediaoffline->ViewValue, 2, -2, -2, -2);
            $this->skor_mediaoffline->ViewCustomAttributes = "";

            // max_mediaoffline
            $this->max_mediaoffline->ViewValue = $this->max_mediaoffline->CurrentValue;
            $this->max_mediaoffline->ViewValue = FormatNumber($this->max_mediaoffline->ViewValue, 2, -2, -2, -2);
            $this->max_mediaoffline->ViewCustomAttributes = "";

            // skor_pemasaran
            $this->skor_pemasaran->ViewValue = $this->skor_pemasaran->CurrentValue;
            $this->skor_pemasaran->ViewValue = FormatNumber($this->skor_pemasaran->ViewValue, 2, -2, -2, -2);
            $this->skor_pemasaran->ViewCustomAttributes = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->ViewValue = $this->maxskor_pemasaran->CurrentValue;
            $this->maxskor_pemasaran->ViewValue = FormatNumber($this->maxskor_pemasaran->ViewValue, 2, -2, -2, -2);
            $this->maxskor_pemasaran->ViewCustomAttributes = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->ViewValue = $this->bobot_pemasaran->CurrentValue;
            $this->bobot_pemasaran->ViewValue = FormatNumber($this->bobot_pemasaran->ViewValue, 0, -2, -2, -2);
            $this->bobot_pemasaran->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_unggul
            $this->skor_unggul->LinkCustomAttributes = "";
            $this->skor_unggul->HrefValue = "";
            $this->skor_unggul->TooltipValue = "";

            // max_unggul
            $this->max_unggul->LinkCustomAttributes = "";
            $this->max_unggul->HrefValue = "";
            $this->max_unggul->TooltipValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";
            $this->skor_target->TooltipValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";
            $this->max_target->TooltipValue = "";

            // skor_available
            $this->skor_available->LinkCustomAttributes = "";
            $this->skor_available->HrefValue = "";
            $this->skor_available->TooltipValue = "";

            // max_available
            $this->max_available->LinkCustomAttributes = "";
            $this->max_available->HrefValue = "";
            $this->max_available->TooltipValue = "";

            // skor_merk
            $this->skor_merk->LinkCustomAttributes = "";
            $this->skor_merk->HrefValue = "";
            $this->skor_merk->TooltipValue = "";

            // max_merk
            $this->max_merk->LinkCustomAttributes = "";
            $this->max_merk->HrefValue = "";
            $this->max_merk->TooltipValue = "";

            // skor_merkhaki
            $this->skor_merkhaki->LinkCustomAttributes = "";
            $this->skor_merkhaki->HrefValue = "";
            $this->skor_merkhaki->TooltipValue = "";

            // max_merkhaki
            $this->max_merkhaki->LinkCustomAttributes = "";
            $this->max_merkhaki->HrefValue = "";
            $this->max_merkhaki->TooltipValue = "";

            // skor_merkkonsep
            $this->skor_merkkonsep->LinkCustomAttributes = "";
            $this->skor_merkkonsep->HrefValue = "";
            $this->skor_merkkonsep->TooltipValue = "";

            // max_merkkonsep
            $this->max_merkkonsep->LinkCustomAttributes = "";
            $this->max_merkkonsep->HrefValue = "";
            $this->max_merkkonsep->TooltipValue = "";

            // skor_merklisensi
            $this->skor_merklisensi->LinkCustomAttributes = "";
            $this->skor_merklisensi->HrefValue = "";
            $this->skor_merklisensi->TooltipValue = "";

            // max_merklisensi
            $this->max_merklisensi->LinkCustomAttributes = "";
            $this->max_merklisensi->HrefValue = "";
            $this->max_merklisensi->TooltipValue = "";

            // skor_mitra
            $this->skor_mitra->LinkCustomAttributes = "";
            $this->skor_mitra->HrefValue = "";
            $this->skor_mitra->TooltipValue = "";

            // max_mitra
            $this->max_mitra->LinkCustomAttributes = "";
            $this->max_mitra->HrefValue = "";
            $this->max_mitra->TooltipValue = "";

            // skor_market
            $this->skor_market->LinkCustomAttributes = "";
            $this->skor_market->HrefValue = "";
            $this->skor_market->TooltipValue = "";

            // max_market
            $this->max_market->LinkCustomAttributes = "";
            $this->max_market->HrefValue = "";
            $this->max_market->TooltipValue = "";

            // skor_pelangganloyal
            $this->skor_pelangganloyal->LinkCustomAttributes = "";
            $this->skor_pelangganloyal->HrefValue = "";
            $this->skor_pelangganloyal->TooltipValue = "";

            // max_pelangganloyal
            $this->max_pelangganloyal->LinkCustomAttributes = "";
            $this->max_pelangganloyal->HrefValue = "";
            $this->max_pelangganloyal->TooltipValue = "";

            // skor_pameranmandiri
            $this->skor_pameranmandiri->LinkCustomAttributes = "";
            $this->skor_pameranmandiri->HrefValue = "";
            $this->skor_pameranmandiri->TooltipValue = "";

            // max_pameranmandiri
            $this->max_pameranmandiri->LinkCustomAttributes = "";
            $this->max_pameranmandiri->HrefValue = "";
            $this->max_pameranmandiri->TooltipValue = "";

            // skor_mediaoffline
            $this->skor_mediaoffline->LinkCustomAttributes = "";
            $this->skor_mediaoffline->HrefValue = "";
            $this->skor_mediaoffline->TooltipValue = "";

            // max_mediaoffline
            $this->max_mediaoffline->LinkCustomAttributes = "";
            $this->max_mediaoffline->HrefValue = "";
            $this->max_mediaoffline->TooltipValue = "";

            // skor_pemasaran
            $this->skor_pemasaran->LinkCustomAttributes = "";
            $this->skor_pemasaran->HrefValue = "";
            $this->skor_pemasaran->TooltipValue = "";

            // maxskor_pemasaran
            $this->maxskor_pemasaran->LinkCustomAttributes = "";
            $this->maxskor_pemasaran->HrefValue = "";
            $this->maxskor_pemasaran->TooltipValue = "";

            // bobot_pemasaran
            $this->bobot_pemasaran->LinkCustomAttributes = "";
            $this->bobot_pemasaran->HrefValue = "";
            $this->bobot_pemasaran->TooltipValue = "";
        }

        // Call Row Rendered event
        if ($this->RowType != ROWTYPE_AGGREGATEINIT) {
            $this->rowRendered();
        }
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
        $conn->beginTransaction();

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
                $thisKey .= $row['nik'];
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
        if ($deleteRows) {
            $conn->commit(); // Commit the changes
        } else {
            $conn->rollback(); // Rollback changes
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

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorpemasaranlist"), "", $this->TableVar, true);
        $pageId = "delete";
        $Breadcrumb->add("delete", $pageId, $url);
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
}
