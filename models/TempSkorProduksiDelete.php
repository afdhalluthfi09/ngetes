<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorProduksiDelete extends TempSkorProduksi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_produksi';

    // Page object name
    public $PageObjName = "TempSkorProduksiDelete";

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

        // Table object (temp_skor_produksi)
        if (!isset($GLOBALS["temp_skor_produksi"]) || get_class($GLOBALS["temp_skor_produksi"]) == PROJECT_NAMESPACE . "temp_skor_produksi") {
            $GLOBALS["temp_skor_produksi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("tempskorproduksilist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorproduksilist"); // Return to list
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorproduksilist"), "", $this->TableVar, true);
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
