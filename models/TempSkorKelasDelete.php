<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKelasDelete extends TempSkorKelas
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_kelas';

    // Page object name
    public $PageObjName = "TempSkorKelasDelete";

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

        // Table object (temp_skor_kelas)
        if (!isset($GLOBALS["temp_skor_kelas"]) || get_class($GLOBALS["temp_skor_kelas"]) == PROJECT_NAMESPACE . "temp_skor_kelas") {
            $GLOBALS["temp_skor_kelas"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_kelas');
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
                $doc = new $class(Container("temp_skor_kelas"));
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
        $this->NIK->setVisibility();
        $this->NAMA_PEMILIK->setVisibility();
        $this->NO_HP->setVisibility();
        $this->NAMA_USAHA->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->KAPANEWON->setVisibility();
        $this->skor_produksi->setVisibility();
        $this->maxskor_produksi->setVisibility();
        $this->bobot_produksi->setVisibility();
        $this->skor_pemasaran->setVisibility();
        $this->maxskor_pemasaran->setVisibility();
        $this->bobot_pemasaran->setVisibility();
        $this->skor_pemasaranonline->setVisibility();
        $this->maxskor_pemasaranonline->setVisibility();
        $this->bobot_pemasaranonline->setVisibility();
        $this->skor_kelembagaan->setVisibility();
        $this->maxskor_kelembagaan->setVisibility();
        $this->bobot_kelembagaan->setVisibility();
        $this->skor_keuangan->setVisibility();
        $this->maxskor_keuangan->setVisibility();
        $this->bobot_keuangan->setVisibility();
        $this->skor_sdm->setVisibility();
        $this->maxskor_sdm->setVisibility();
        $this->bobot_sdm->setVisibility();
        $this->skor_kelas->setVisibility();
        $this->maxskor_kelas->setVisibility();
        $this->kelas_umkm->setVisibility();
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
            $this->terminate("tempskorkelaslist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorkelaslist"); // Return to list
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
        $this->NIK->setDbValue($row['NIK']);
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->skor_produksi->setDbValue($row['skor_produksi']);
        $this->maxskor_produksi->setDbValue($row['maxskor_produksi']);
        $this->bobot_produksi->setDbValue($row['bobot_produksi']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
        $this->skor_keuangan->setDbValue($row['skor_keuangan']);
        $this->maxskor_keuangan->setDbValue($row['maxskor_keuangan']);
        $this->bobot_keuangan->setDbValue($row['bobot_keuangan']);
        $this->skor_sdm->setDbValue($row['skor_sdm']);
        $this->maxskor_sdm->setDbValue($row['maxskor_sdm']);
        $this->bobot_sdm->setDbValue($row['bobot_sdm']);
        $this->skor_kelas->setDbValue($row['skor_kelas']);
        $this->maxskor_kelas->setDbValue($row['maxskor_kelas']);
        $this->kelas_umkm->setDbValue($row['kelas_umkm']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['NAMA_PEMILIK'] = null;
        $row['NO_HP'] = null;
        $row['NAMA_USAHA'] = null;
        $row['KALURAHAN'] = null;
        $row['KAPANEWON'] = null;
        $row['skor_produksi'] = null;
        $row['maxskor_produksi'] = null;
        $row['bobot_produksi'] = null;
        $row['skor_pemasaran'] = null;
        $row['maxskor_pemasaran'] = null;
        $row['bobot_pemasaran'] = null;
        $row['skor_pemasaranonline'] = null;
        $row['maxskor_pemasaranonline'] = null;
        $row['bobot_pemasaranonline'] = null;
        $row['skor_kelembagaan'] = null;
        $row['maxskor_kelembagaan'] = null;
        $row['bobot_kelembagaan'] = null;
        $row['skor_keuangan'] = null;
        $row['maxskor_keuangan'] = null;
        $row['bobot_keuangan'] = null;
        $row['skor_sdm'] = null;
        $row['maxskor_sdm'] = null;
        $row['bobot_sdm'] = null;
        $row['skor_kelas'] = null;
        $row['maxskor_kelas'] = null;
        $row['kelas_umkm'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_produksi->FormValue == $this->skor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_produksi->CurrentValue))) {
            $this->skor_produksi->CurrentValue = ConvertToFloatString($this->skor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_produksi->FormValue == $this->maxskor_produksi->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_produksi->CurrentValue))) {
            $this->maxskor_produksi->CurrentValue = ConvertToFloatString($this->maxskor_produksi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaran->FormValue == $this->skor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaran->CurrentValue))) {
            $this->skor_pemasaran->CurrentValue = ConvertToFloatString($this->skor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaran->FormValue == $this->maxskor_pemasaran->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaran->CurrentValue))) {
            $this->maxskor_pemasaran->CurrentValue = ConvertToFloatString($this->maxskor_pemasaran->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaranonline->FormValue == $this->skor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaranonline->CurrentValue))) {
            $this->skor_pemasaranonline->CurrentValue = ConvertToFloatString($this->skor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaranonline->FormValue == $this->maxskor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue))) {
            $this->maxskor_pemasaranonline->CurrentValue = ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelembagaan->FormValue == $this->skor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelembagaan->CurrentValue))) {
            $this->skor_kelembagaan->CurrentValue = ConvertToFloatString($this->skor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelembagaan->FormValue == $this->maxskor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue))) {
            $this->maxskor_kelembagaan->CurrentValue = ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_keuangan->FormValue == $this->skor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_keuangan->CurrentValue))) {
            $this->skor_keuangan->CurrentValue = ConvertToFloatString($this->skor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_keuangan->FormValue == $this->maxskor_keuangan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_keuangan->CurrentValue))) {
            $this->maxskor_keuangan->CurrentValue = ConvertToFloatString($this->maxskor_keuangan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sdm->FormValue == $this->skor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sdm->CurrentValue))) {
            $this->skor_sdm->CurrentValue = ConvertToFloatString($this->skor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_sdm->FormValue == $this->maxskor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_sdm->CurrentValue))) {
            $this->maxskor_sdm->CurrentValue = ConvertToFloatString($this->maxskor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelas->FormValue == $this->skor_kelas->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelas->CurrentValue))) {
            $this->skor_kelas->CurrentValue = ConvertToFloatString($this->skor_kelas->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelas->FormValue == $this->maxskor_kelas->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelas->CurrentValue))) {
            $this->maxskor_kelas->CurrentValue = ConvertToFloatString($this->maxskor_kelas->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // NAMA_PEMILIK

        // NO_HP

        // NAMA_USAHA

        // KALURAHAN

        // KAPANEWON

        // skor_produksi

        // maxskor_produksi

        // bobot_produksi

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan

        // skor_keuangan

        // maxskor_keuangan

        // bobot_keuangan

        // skor_sdm

        // maxskor_sdm

        // bobot_sdm

        // skor_kelas

        // maxskor_kelas

        // kelas_umkm
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
            $this->NAMA_PEMILIK->ViewCustomAttributes = "";

            // NO_HP
            $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
            $this->NO_HP->ViewCustomAttributes = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
            $this->NAMA_USAHA->ViewCustomAttributes = "";

            // KALURAHAN
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
            $this->KALURAHAN->ViewCustomAttributes = "";

            // KAPANEWON
            $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
            $this->KAPANEWON->ViewCustomAttributes = "";

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

            // skor_kelembagaan
            $this->skor_kelembagaan->ViewValue = $this->skor_kelembagaan->CurrentValue;
            $this->skor_kelembagaan->ViewValue = FormatNumber($this->skor_kelembagaan->ViewValue, 2, -2, -2, -2);
            $this->skor_kelembagaan->ViewCustomAttributes = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->ViewValue = $this->maxskor_kelembagaan->CurrentValue;
            $this->maxskor_kelembagaan->ViewValue = FormatNumber($this->maxskor_kelembagaan->ViewValue, 2, -2, -2, -2);
            $this->maxskor_kelembagaan->ViewCustomAttributes = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->ViewValue = $this->bobot_kelembagaan->CurrentValue;
            $this->bobot_kelembagaan->ViewValue = FormatNumber($this->bobot_kelembagaan->ViewValue, 0, -2, -2, -2);
            $this->bobot_kelembagaan->ViewCustomAttributes = "";

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

            // skor_sdm
            $this->skor_sdm->ViewValue = $this->skor_sdm->CurrentValue;
            $this->skor_sdm->ViewValue = FormatNumber($this->skor_sdm->ViewValue, 2, -2, -2, -2);
            $this->skor_sdm->ViewCustomAttributes = "";

            // maxskor_sdm
            $this->maxskor_sdm->ViewValue = $this->maxskor_sdm->CurrentValue;
            $this->maxskor_sdm->ViewValue = FormatNumber($this->maxskor_sdm->ViewValue, 2, -2, -2, -2);
            $this->maxskor_sdm->ViewCustomAttributes = "";

            // bobot_sdm
            $this->bobot_sdm->ViewValue = $this->bobot_sdm->CurrentValue;
            $this->bobot_sdm->ViewValue = FormatNumber($this->bobot_sdm->ViewValue, 0, -2, -2, -2);
            $this->bobot_sdm->ViewCustomAttributes = "";

            // skor_kelas
            $this->skor_kelas->ViewValue = $this->skor_kelas->CurrentValue;
            $this->skor_kelas->ViewValue = FormatNumber($this->skor_kelas->ViewValue, 2, -2, -2, -2);
            $this->skor_kelas->ViewCustomAttributes = "";

            // maxskor_kelas
            $this->maxskor_kelas->ViewValue = $this->maxskor_kelas->CurrentValue;
            $this->maxskor_kelas->ViewValue = FormatNumber($this->maxskor_kelas->ViewValue, 2, -2, -2, -2);
            $this->maxskor_kelas->ViewCustomAttributes = "";

            // kelas_umkm
            $this->kelas_umkm->ViewValue = $this->kelas_umkm->CurrentValue;
            $this->kelas_umkm->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // NAMA_PEMILIK
            $this->NAMA_PEMILIK->LinkCustomAttributes = "";
            $this->NAMA_PEMILIK->HrefValue = "";
            $this->NAMA_PEMILIK->TooltipValue = "";

            // NO_HP
            $this->NO_HP->LinkCustomAttributes = "";
            $this->NO_HP->HrefValue = "";
            $this->NO_HP->TooltipValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";
            $this->NAMA_USAHA->TooltipValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";
            $this->KALURAHAN->TooltipValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";
            $this->KAPANEWON->TooltipValue = "";

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

            // skor_kelembagaan
            $this->skor_kelembagaan->LinkCustomAttributes = "";
            $this->skor_kelembagaan->HrefValue = "";
            $this->skor_kelembagaan->TooltipValue = "";

            // maxskor_kelembagaan
            $this->maxskor_kelembagaan->LinkCustomAttributes = "";
            $this->maxskor_kelembagaan->HrefValue = "";
            $this->maxskor_kelembagaan->TooltipValue = "";

            // bobot_kelembagaan
            $this->bobot_kelembagaan->LinkCustomAttributes = "";
            $this->bobot_kelembagaan->HrefValue = "";
            $this->bobot_kelembagaan->TooltipValue = "";

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

            // skor_sdm
            $this->skor_sdm->LinkCustomAttributes = "";
            $this->skor_sdm->HrefValue = "";
            $this->skor_sdm->TooltipValue = "";

            // maxskor_sdm
            $this->maxskor_sdm->LinkCustomAttributes = "";
            $this->maxskor_sdm->HrefValue = "";
            $this->maxskor_sdm->TooltipValue = "";

            // bobot_sdm
            $this->bobot_sdm->LinkCustomAttributes = "";
            $this->bobot_sdm->HrefValue = "";
            $this->bobot_sdm->TooltipValue = "";

            // skor_kelas
            $this->skor_kelas->LinkCustomAttributes = "";
            $this->skor_kelas->HrefValue = "";
            $this->skor_kelas->TooltipValue = "";

            // maxskor_kelas
            $this->maxskor_kelas->LinkCustomAttributes = "";
            $this->maxskor_kelas->HrefValue = "";
            $this->maxskor_kelas->TooltipValue = "";

            // kelas_umkm
            $this->kelas_umkm->LinkCustomAttributes = "";
            $this->kelas_umkm->HrefValue = "";
            $this->kelas_umkm->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkelaslist"), "", $this->TableVar, true);
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
