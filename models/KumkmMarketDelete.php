<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class KumkmMarketDelete extends KumkmMarket
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'kumkm_market';

    // Page object name
    public $PageObjName = "KumkmMarketDelete";

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

        // Table object (kumkm_market)
        if (!isset($GLOBALS["kumkm_market"]) || get_class($GLOBALS["kumkm_market"]) == PROJECT_NAMESPACE . "kumkm_market") {
            $GLOBALS["kumkm_market"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

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
        $this->id->Visible = false;
        $this->produk_foto->setVisibility();
        $this->nik_ukm->Visible = false;
        $this->produk_nama->setVisibility();
        $this->produk_jenis->setVisibility();
        $this->produk_desc->Visible = false;
        $this->produk_harga->setVisibility();
        $this->kurasi->setVisibility();
        $this->waktu_entry->Visible = false;
        $this->waktu_kurasi->Visible = false;
        $this->waktu_update->Visible = false;
        $this->editor->Visible = false;
        $this->kurator->Visible = false;
        $this->produk_legal->Visible = false;
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
        $this->catatan->Visible = false;
        $this->market->setVisibility();
        $this->yia_sku->Visible = false;
        $this->yia_idproduk->Visible = false;
        $this->yia_stok_alert->Visible = false;
        $this->produk_foto_4->Visible = false;
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
            $this->terminate("kumkmmarketlist"); // Prevent SQL injection, return to list
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
                $this->terminate("kumkmmarketlist"); // Return to list
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
        $this->id->CellCssStyle = "white-space: nowrap;";

        // produk_foto

        // nik_ukm
        $this->nik_ukm->CellCssStyle = "white-space: nowrap;";

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // kurasi
        $this->kurasi->CellCssStyle = "white-space: nowrap;";

        // waktu_entry
        $this->waktu_entry->CellCssStyle = "white-space: nowrap;";

        // waktu_kurasi
        $this->waktu_kurasi->CellCssStyle = "white-space: nowrap;";

        // waktu_update
        $this->waktu_update->CellCssStyle = "white-space: nowrap;";

        // editor
        $this->editor->CellCssStyle = "white-space: nowrap;";

        // kurator

        // produk_legal
        $this->produk_legal->CellCssStyle = "white-space: nowrap;";

        // judul_sesuai
        $this->judul_sesuai->CellCssStyle = "white-space: nowrap;";

        // foto_bagus
        $this->foto_bagus->CellCssStyle = "white-space: nowrap;";

        // deskripsi_jelas
        $this->deskripsi_jelas->CellCssStyle = "white-space: nowrap;";

        // harga_tidak_kosong
        $this->harga_tidak_kosong->CellCssStyle = "white-space: nowrap;";

        // berat_tidak_kosong
        $this->berat_tidak_kosong->CellCssStyle = "white-space: nowrap;";

        // produk_berat

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // produk_harga_dasar

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // catatan
        $this->catatan->CellCssStyle = "white-space: nowrap;";

        // market

        // yia_sku
        $this->yia_sku->CellCssStyle = "white-space: nowrap;";

        // yia_idproduk
        $this->yia_idproduk->CellCssStyle = "white-space: nowrap;";

        // yia_stok_alert
        $this->yia_stok_alert->CellCssStyle = "white-space: nowrap;";

        // produk_foto_4
        $this->produk_foto_4->CellCssStyle = "white-space: nowrap;";
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

            // produk_harga
            $this->produk_harga->ViewValue = $this->produk_harga->CurrentValue;
            $this->produk_harga->ViewValue = FormatNumber($this->produk_harga->ViewValue, 2, -2, -2, -2);
            $this->produk_harga->ViewCustomAttributes = "";

            // kurasi
            if (strval($this->kurasi->CurrentValue) != "") {
                $this->kurasi->ViewValue = $this->kurasi->optionCaption($this->kurasi->CurrentValue);
            } else {
                $this->kurasi->ViewValue = null;
            }
            $this->kurasi->ViewCustomAttributes = "";

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

            // produk_harga
            $this->produk_harga->LinkCustomAttributes = "";
            $this->produk_harga->HrefValue = "";
            $this->produk_harga->TooltipValue = "";

            // kurasi
            $this->kurasi->LinkCustomAttributes = "";
            $this->kurasi->HrefValue = "";
            $this->kurasi->TooltipValue = "";

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
                $thisKey .= $row['id'];
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("kumkmmarketlist"), "", $this->TableVar, true);
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
