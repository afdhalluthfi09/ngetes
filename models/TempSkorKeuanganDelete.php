<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKeuanganDelete extends TempSkorKeuangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_keuangan';

    // Page object name
    public $PageObjName = "TempSkorKeuanganDelete";

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

        // Table object (temp_skor_keuangan)
        if (!isset($GLOBALS["temp_skor_keuangan"]) || get_class($GLOBALS["temp_skor_keuangan"]) == PROJECT_NAMESPACE . "temp_skor_keuangan") {
            $GLOBALS["temp_skor_keuangan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_keuangan');
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
                $doc = new $class(Container("temp_skor_keuangan"));
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
        $this->skor_income->setVisibility();
        $this->max_income->setVisibility();
        $this->skor_pengelolaan->setVisibility();
        $this->max_pengelolaan->setVisibility();
        $this->skor_nota->setVisibility();
        $this->max_nota->setVisibility();
        $this->skor_jurnal->setVisibility();
        $this->max_jurnal->setVisibility();
        $this->skor_akutansi->setVisibility();
        $this->max_akutansi->setVisibility();
        $this->skor_utangbank->setVisibility();
        $this->max_utangbank->setVisibility();
        $this->skor_dokumentasi->setVisibility();
        $this->max_dokumentasi->setVisibility();
        $this->skor_nontunai->setVisibility();
        $this->max_nontunai->setVisibility();
        $this->skor_keuangan->setVisibility();
        $this->maxskor_keuangan->setVisibility();
        $this->bobot_keuangan->setVisibility();
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
            $this->terminate("tempskorkeuanganlist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorkeuanganlist"); // Return to list
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
        $this->skor_income->setDbValue($row['skor_income']);
        $this->max_income->setDbValue($row['max_income']);
        $this->skor_pengelolaan->setDbValue($row['skor_pengelolaan']);
        $this->max_pengelolaan->setDbValue($row['max_pengelolaan']);
        $this->skor_nota->setDbValue($row['skor_nota']);
        $this->max_nota->setDbValue($row['max_nota']);
        $this->skor_jurnal->setDbValue($row['skor_jurnal']);
        $this->max_jurnal->setDbValue($row['max_jurnal']);
        $this->skor_akutansi->setDbValue($row['skor_akutansi']);
        $this->max_akutansi->setDbValue($row['max_akutansi']);
        $this->skor_utangbank->setDbValue($row['skor_utangbank']);
        $this->max_utangbank->setDbValue($row['max_utangbank']);
        $this->skor_dokumentasi->setDbValue($row['skor_dokumentasi']);
        $this->max_dokumentasi->setDbValue($row['max_dokumentasi']);
        $this->skor_nontunai->setDbValue($row['skor_nontunai']);
        $this->max_nontunai->setDbValue($row['max_nontunai']);
        $this->skor_keuangan->setDbValue($row['skor_keuangan']);
        $this->maxskor_keuangan->setDbValue($row['maxskor_keuangan']);
        $this->bobot_keuangan->setDbValue($row['bobot_keuangan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_income'] = null;
        $row['max_income'] = null;
        $row['skor_pengelolaan'] = null;
        $row['max_pengelolaan'] = null;
        $row['skor_nota'] = null;
        $row['max_nota'] = null;
        $row['skor_jurnal'] = null;
        $row['max_jurnal'] = null;
        $row['skor_akutansi'] = null;
        $row['max_akutansi'] = null;
        $row['skor_utangbank'] = null;
        $row['max_utangbank'] = null;
        $row['skor_dokumentasi'] = null;
        $row['max_dokumentasi'] = null;
        $row['skor_nontunai'] = null;
        $row['max_nontunai'] = null;
        $row['skor_keuangan'] = null;
        $row['maxskor_keuangan'] = null;
        $row['bobot_keuangan'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_income->FormValue == $this->skor_income->CurrentValue && is_numeric(ConvertToFloatString($this->skor_income->CurrentValue))) {
            $this->skor_income->CurrentValue = ConvertToFloatString($this->skor_income->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_income->FormValue == $this->max_income->CurrentValue && is_numeric(ConvertToFloatString($this->max_income->CurrentValue))) {
            $this->max_income->CurrentValue = ConvertToFloatString($this->max_income->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pengelolaan->FormValue == $this->skor_pengelolaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pengelolaan->CurrentValue))) {
            $this->skor_pengelolaan->CurrentValue = ConvertToFloatString($this->skor_pengelolaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_pengelolaan->FormValue == $this->max_pengelolaan->CurrentValue && is_numeric(ConvertToFloatString($this->max_pengelolaan->CurrentValue))) {
            $this->max_pengelolaan->CurrentValue = ConvertToFloatString($this->max_pengelolaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_nota->FormValue == $this->skor_nota->CurrentValue && is_numeric(ConvertToFloatString($this->skor_nota->CurrentValue))) {
            $this->skor_nota->CurrentValue = ConvertToFloatString($this->skor_nota->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_nota->FormValue == $this->max_nota->CurrentValue && is_numeric(ConvertToFloatString($this->max_nota->CurrentValue))) {
            $this->max_nota->CurrentValue = ConvertToFloatString($this->max_nota->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_jurnal->FormValue == $this->skor_jurnal->CurrentValue && is_numeric(ConvertToFloatString($this->skor_jurnal->CurrentValue))) {
            $this->skor_jurnal->CurrentValue = ConvertToFloatString($this->skor_jurnal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_jurnal->FormValue == $this->max_jurnal->CurrentValue && is_numeric(ConvertToFloatString($this->max_jurnal->CurrentValue))) {
            $this->max_jurnal->CurrentValue = ConvertToFloatString($this->max_jurnal->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_akutansi->FormValue == $this->skor_akutansi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_akutansi->CurrentValue))) {
            $this->skor_akutansi->CurrentValue = ConvertToFloatString($this->skor_akutansi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_akutansi->FormValue == $this->max_akutansi->CurrentValue && is_numeric(ConvertToFloatString($this->max_akutansi->CurrentValue))) {
            $this->max_akutansi->CurrentValue = ConvertToFloatString($this->max_akutansi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_utangbank->FormValue == $this->skor_utangbank->CurrentValue && is_numeric(ConvertToFloatString($this->skor_utangbank->CurrentValue))) {
            $this->skor_utangbank->CurrentValue = ConvertToFloatString($this->skor_utangbank->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_utangbank->FormValue == $this->max_utangbank->CurrentValue && is_numeric(ConvertToFloatString($this->max_utangbank->CurrentValue))) {
            $this->max_utangbank->CurrentValue = ConvertToFloatString($this->max_utangbank->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_dokumentasi->FormValue == $this->skor_dokumentasi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_dokumentasi->CurrentValue))) {
            $this->skor_dokumentasi->CurrentValue = ConvertToFloatString($this->skor_dokumentasi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_dokumentasi->FormValue == $this->max_dokumentasi->CurrentValue && is_numeric(ConvertToFloatString($this->max_dokumentasi->CurrentValue))) {
            $this->max_dokumentasi->CurrentValue = ConvertToFloatString($this->max_dokumentasi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_nontunai->FormValue == $this->skor_nontunai->CurrentValue && is_numeric(ConvertToFloatString($this->skor_nontunai->CurrentValue))) {
            $this->skor_nontunai->CurrentValue = ConvertToFloatString($this->skor_nontunai->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_nontunai->FormValue == $this->max_nontunai->CurrentValue && is_numeric(ConvertToFloatString($this->max_nontunai->CurrentValue))) {
            $this->max_nontunai->CurrentValue = ConvertToFloatString($this->max_nontunai->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_keuangan->FormValue == $this->skor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_keuangan->CurrentValue))) {
            $this->skor_keuangan->CurrentValue = ConvertToFloatString($this->skor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_keuangan->FormValue == $this->maxskor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_keuangan->CurrentValue))) {
            $this->maxskor_keuangan->CurrentValue = ConvertToFloatString($this->maxskor_keuangan->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_income

        // max_income

        // skor_pengelolaan

        // max_pengelolaan

        // skor_nota

        // max_nota

        // skor_jurnal

        // max_jurnal

        // skor_akutansi

        // max_akutansi

        // skor_utangbank

        // max_utangbank

        // skor_dokumentasi

        // max_dokumentasi

        // skor_nontunai

        // max_nontunai

        // skor_keuangan

        // maxskor_keuangan

        // bobot_keuangan
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_income
            $this->skor_income->ViewValue = $this->skor_income->CurrentValue;
            $this->skor_income->ViewValue = FormatNumber($this->skor_income->ViewValue, 2, -2, -2, -2);
            $this->skor_income->ViewCustomAttributes = "";

            // max_income
            $this->max_income->ViewValue = $this->max_income->CurrentValue;
            $this->max_income->ViewValue = FormatNumber($this->max_income->ViewValue, 2, -2, -2, -2);
            $this->max_income->ViewCustomAttributes = "";

            // skor_pengelolaan
            $this->skor_pengelolaan->ViewValue = $this->skor_pengelolaan->CurrentValue;
            $this->skor_pengelolaan->ViewValue = FormatNumber($this->skor_pengelolaan->ViewValue, 2, -2, -2, -2);
            $this->skor_pengelolaan->ViewCustomAttributes = "";

            // max_pengelolaan
            $this->max_pengelolaan->ViewValue = $this->max_pengelolaan->CurrentValue;
            $this->max_pengelolaan->ViewValue = FormatNumber($this->max_pengelolaan->ViewValue, 2, -2, -2, -2);
            $this->max_pengelolaan->ViewCustomAttributes = "";

            // skor_nota
            $this->skor_nota->ViewValue = $this->skor_nota->CurrentValue;
            $this->skor_nota->ViewValue = FormatNumber($this->skor_nota->ViewValue, 2, -2, -2, -2);
            $this->skor_nota->ViewCustomAttributes = "";

            // max_nota
            $this->max_nota->ViewValue = $this->max_nota->CurrentValue;
            $this->max_nota->ViewValue = FormatNumber($this->max_nota->ViewValue, 2, -2, -2, -2);
            $this->max_nota->ViewCustomAttributes = "";

            // skor_jurnal
            $this->skor_jurnal->ViewValue = $this->skor_jurnal->CurrentValue;
            $this->skor_jurnal->ViewValue = FormatNumber($this->skor_jurnal->ViewValue, 2, -2, -2, -2);
            $this->skor_jurnal->ViewCustomAttributes = "";

            // max_jurnal
            $this->max_jurnal->ViewValue = $this->max_jurnal->CurrentValue;
            $this->max_jurnal->ViewValue = FormatNumber($this->max_jurnal->ViewValue, 2, -2, -2, -2);
            $this->max_jurnal->ViewCustomAttributes = "";

            // skor_akutansi
            $this->skor_akutansi->ViewValue = $this->skor_akutansi->CurrentValue;
            $this->skor_akutansi->ViewValue = FormatNumber($this->skor_akutansi->ViewValue, 2, -2, -2, -2);
            $this->skor_akutansi->ViewCustomAttributes = "";

            // max_akutansi
            $this->max_akutansi->ViewValue = $this->max_akutansi->CurrentValue;
            $this->max_akutansi->ViewValue = FormatNumber($this->max_akutansi->ViewValue, 2, -2, -2, -2);
            $this->max_akutansi->ViewCustomAttributes = "";

            // skor_utangbank
            $this->skor_utangbank->ViewValue = $this->skor_utangbank->CurrentValue;
            $this->skor_utangbank->ViewValue = FormatNumber($this->skor_utangbank->ViewValue, 2, -2, -2, -2);
            $this->skor_utangbank->ViewCustomAttributes = "";

            // max_utangbank
            $this->max_utangbank->ViewValue = $this->max_utangbank->CurrentValue;
            $this->max_utangbank->ViewValue = FormatNumber($this->max_utangbank->ViewValue, 2, -2, -2, -2);
            $this->max_utangbank->ViewCustomAttributes = "";

            // skor_dokumentasi
            $this->skor_dokumentasi->ViewValue = $this->skor_dokumentasi->CurrentValue;
            $this->skor_dokumentasi->ViewValue = FormatNumber($this->skor_dokumentasi->ViewValue, 2, -2, -2, -2);
            $this->skor_dokumentasi->ViewCustomAttributes = "";

            // max_dokumentasi
            $this->max_dokumentasi->ViewValue = $this->max_dokumentasi->CurrentValue;
            $this->max_dokumentasi->ViewValue = FormatNumber($this->max_dokumentasi->ViewValue, 2, -2, -2, -2);
            $this->max_dokumentasi->ViewCustomAttributes = "";

            // skor_nontunai
            $this->skor_nontunai->ViewValue = $this->skor_nontunai->CurrentValue;
            $this->skor_nontunai->ViewValue = FormatNumber($this->skor_nontunai->ViewValue, 2, -2, -2, -2);
            $this->skor_nontunai->ViewCustomAttributes = "";

            // max_nontunai
            $this->max_nontunai->ViewValue = $this->max_nontunai->CurrentValue;
            $this->max_nontunai->ViewValue = FormatNumber($this->max_nontunai->ViewValue, 2, -2, -2, -2);
            $this->max_nontunai->ViewCustomAttributes = "";

            // skor_keuangan
            $this->skor_keuangan->ViewValue = $this->skor_keuangan->CurrentValue;
            $this->skor_keuangan->ViewValue = FormatNumber($this->skor_keuangan->ViewValue, 2, -2, -2, -2);
            $this->skor_keuangan->ViewCustomAttributes = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->ViewValue = $this->maxskor_keuangan->CurrentValue;
            $this->maxskor_keuangan->ViewValue = FormatNumber($this->maxskor_keuangan->ViewValue, 2, -2, -2, -2);
            $this->maxskor_keuangan->ViewCustomAttributes = "";

            // bobot_keuangan
            $this->bobot_keuangan->ViewValue = $this->bobot_keuangan->CurrentValue;
            $this->bobot_keuangan->ViewValue = FormatNumber($this->bobot_keuangan->ViewValue, 0, -2, -2, -2);
            $this->bobot_keuangan->ViewCustomAttributes = "";

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_income
            $this->skor_income->LinkCustomAttributes = "";
            $this->skor_income->HrefValue = "";
            $this->skor_income->TooltipValue = "";

            // max_income
            $this->max_income->LinkCustomAttributes = "";
            $this->max_income->HrefValue = "";
            $this->max_income->TooltipValue = "";

            // skor_pengelolaan
            $this->skor_pengelolaan->LinkCustomAttributes = "";
            $this->skor_pengelolaan->HrefValue = "";
            $this->skor_pengelolaan->TooltipValue = "";

            // max_pengelolaan
            $this->max_pengelolaan->LinkCustomAttributes = "";
            $this->max_pengelolaan->HrefValue = "";
            $this->max_pengelolaan->TooltipValue = "";

            // skor_nota
            $this->skor_nota->LinkCustomAttributes = "";
            $this->skor_nota->HrefValue = "";
            $this->skor_nota->TooltipValue = "";

            // max_nota
            $this->max_nota->LinkCustomAttributes = "";
            $this->max_nota->HrefValue = "";
            $this->max_nota->TooltipValue = "";

            // skor_jurnal
            $this->skor_jurnal->LinkCustomAttributes = "";
            $this->skor_jurnal->HrefValue = "";
            $this->skor_jurnal->TooltipValue = "";

            // max_jurnal
            $this->max_jurnal->LinkCustomAttributes = "";
            $this->max_jurnal->HrefValue = "";
            $this->max_jurnal->TooltipValue = "";

            // skor_akutansi
            $this->skor_akutansi->LinkCustomAttributes = "";
            $this->skor_akutansi->HrefValue = "";
            $this->skor_akutansi->TooltipValue = "";

            // max_akutansi
            $this->max_akutansi->LinkCustomAttributes = "";
            $this->max_akutansi->HrefValue = "";
            $this->max_akutansi->TooltipValue = "";

            // skor_utangbank
            $this->skor_utangbank->LinkCustomAttributes = "";
            $this->skor_utangbank->HrefValue = "";
            $this->skor_utangbank->TooltipValue = "";

            // max_utangbank
            $this->max_utangbank->LinkCustomAttributes = "";
            $this->max_utangbank->HrefValue = "";
            $this->max_utangbank->TooltipValue = "";

            // skor_dokumentasi
            $this->skor_dokumentasi->LinkCustomAttributes = "";
            $this->skor_dokumentasi->HrefValue = "";
            $this->skor_dokumentasi->TooltipValue = "";

            // max_dokumentasi
            $this->max_dokumentasi->LinkCustomAttributes = "";
            $this->max_dokumentasi->HrefValue = "";
            $this->max_dokumentasi->TooltipValue = "";

            // skor_nontunai
            $this->skor_nontunai->LinkCustomAttributes = "";
            $this->skor_nontunai->HrefValue = "";
            $this->skor_nontunai->TooltipValue = "";

            // max_nontunai
            $this->max_nontunai->LinkCustomAttributes = "";
            $this->max_nontunai->HrefValue = "";
            $this->max_nontunai->TooltipValue = "";

            // skor_keuangan
            $this->skor_keuangan->LinkCustomAttributes = "";
            $this->skor_keuangan->HrefValue = "";
            $this->skor_keuangan->TooltipValue = "";

            // maxskor_keuangan
            $this->maxskor_keuangan->LinkCustomAttributes = "";
            $this->maxskor_keuangan->HrefValue = "";
            $this->maxskor_keuangan->TooltipValue = "";

            // bobot_keuangan
            $this->bobot_keuangan->LinkCustomAttributes = "";
            $this->bobot_keuangan->HrefValue = "";
            $this->bobot_keuangan->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkeuanganlist"), "", $this->TableVar, true);
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
