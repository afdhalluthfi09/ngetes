<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmDatausahaDelete extends UmkmDatausaha
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_datausaha';

    // Page object name
    public $PageObjName = "UmkmDatausahaDelete";

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

        // Table object (umkm_datausaha)
        if (!isset($GLOBALS["umkm_datausaha"]) || get_class($GLOBALS["umkm_datausaha"]) == PROJECT_NAMESPACE . "umkm_datausaha") {
            $GLOBALS["umkm_datausaha"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_datausaha');
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
                $doc = new $class(Container("umkm_datausaha"));
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
        $this->NAMA_USAHA->setVisibility();
        $this->TAHUN_MULAI_USAHA->setVisibility();
        $this->NO_IZIN_USAHA->setVisibility();
        $this->SEKTOR->setVisibility();
        $this->SEKTOR_PERGUB->setVisibility();
        $this->SEKTOR_KBLI->setVisibility();
        $this->SEKTOR_EKRAF->setVisibility();
        $this->KAPANEWON->setVisibility();
        $this->KALURAHAN->setVisibility();
        $this->DUSUN->setVisibility();
        $this->ALAMAT->setVisibility();
        $this->TENAGA_KERJA_LAKILAKI->setVisibility();
        $this->TENAGA_KERJA_PEREMPUAN->setVisibility();
        $this->MODAL_KERJA->setVisibility();
        $this->OMZET_RATARATA_PERTAHUN->setVisibility();
        $this->STATUS_USAHA->setVisibility();
        $this->ASET->setVisibility();
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
        $this->setupLookupOptions($this->SEKTOR_PERGUB);
        $this->setupLookupOptions($this->SEKTOR_KBLI);
        $this->setupLookupOptions($this->SEKTOR_EKRAF);
        $this->setupLookupOptions($this->KAPANEWON);
        $this->setupLookupOptions($this->KALURAHAN);

        // Set up master/detail parameters
        $this->setupMasterParms();

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("umkmdatausahalist"); // Prevent SQL injection, return to list
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
            $this->CurrentAction = "delete"; // Delete record directly
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
                $this->terminate($this->getReturnUrl()); // Return to caller
                return;
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
                $this->terminate("umkmdatausahalist"); // Return to list
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
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->TAHUN_MULAI_USAHA->setDbValue($row['TAHUN_MULAI_USAHA']);
        $this->NO_IZIN_USAHA->setDbValue($row['NO_IZIN_USAHA']);
        $this->SEKTOR->setDbValue($row['SEKTOR']);
        $this->SEKTOR_PERGUB->setDbValue($row['SEKTOR_PERGUB']);
        $this->SEKTOR_KBLI->setDbValue($row['SEKTOR_KBLI']);
        $this->SEKTOR_EKRAF->setDbValue($row['SEKTOR_EKRAF']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->TENAGA_KERJA_LAKILAKI->setDbValue($row['TENAGA_KERJA_LAKI-LAKI']);
        $this->TENAGA_KERJA_PEREMPUAN->setDbValue($row['TENAGA_KERJA_PEREMPUAN']);
        $this->MODAL_KERJA->setDbValue($row['MODAL_KERJA']);
        $this->OMZET_RATARATA_PERTAHUN->setDbValue($row['OMZET_RATA-RATA_PERTAHUN']);
        $this->STATUS_USAHA->setDbValue($row['STATUS_USAHA']);
        $this->ASET->setDbValue($row['ASET']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['NAMA_USAHA'] = null;
        $row['TAHUN_MULAI_USAHA'] = null;
        $row['NO_IZIN_USAHA'] = null;
        $row['SEKTOR'] = null;
        $row['SEKTOR_PERGUB'] = null;
        $row['SEKTOR_KBLI'] = null;
        $row['SEKTOR_EKRAF'] = null;
        $row['KAPANEWON'] = null;
        $row['KALURAHAN'] = null;
        $row['DUSUN'] = null;
        $row['ALAMAT'] = null;
        $row['TENAGA_KERJA_LAKI-LAKI'] = null;
        $row['TENAGA_KERJA_PEREMPUAN'] = null;
        $row['MODAL_KERJA'] = null;
        $row['OMZET_RATA-RATA_PERTAHUN'] = null;
        $row['STATUS_USAHA'] = null;
        $row['ASET'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->MODAL_KERJA->FormValue == $this->MODAL_KERJA->CurrentValue && is_numeric(ConvertToFloatString($this->MODAL_KERJA->CurrentValue))) {
            $this->MODAL_KERJA->CurrentValue = ConvertToFloatString($this->MODAL_KERJA->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->OMZET_RATARATA_PERTAHUN->FormValue == $this->OMZET_RATARATA_PERTAHUN->CurrentValue && is_numeric(ConvertToFloatString($this->OMZET_RATARATA_PERTAHUN->CurrentValue))) {
            $this->OMZET_RATARATA_PERTAHUN->CurrentValue = ConvertToFloatString($this->OMZET_RATARATA_PERTAHUN->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->ASET->FormValue == $this->ASET->CurrentValue && is_numeric(ConvertToFloatString($this->ASET->CurrentValue))) {
            $this->ASET->CurrentValue = ConvertToFloatString($this->ASET->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK

        // NAMA_USAHA

        // TAHUN_MULAI_USAHA

        // NO_IZIN_USAHA

        // SEKTOR

        // SEKTOR_PERGUB

        // SEKTOR_KBLI

        // SEKTOR_EKRAF

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // ALAMAT

        // TENAGA_KERJA_LAKI-LAKI

        // TENAGA_KERJA_PEREMPUAN

        // MODAL_KERJA

        // OMZET_RATA-RATA_PERTAHUN

        // STATUS_USAHA

        // ASET
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
            $this->NAMA_USAHA->ViewCustomAttributes = "";

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->ViewValue = $this->TAHUN_MULAI_USAHA->CurrentValue;
            $this->TAHUN_MULAI_USAHA->ViewCustomAttributes = "";

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->ViewValue = $this->NO_IZIN_USAHA->CurrentValue;
            $this->NO_IZIN_USAHA->ViewCustomAttributes = "";

            // SEKTOR
            $this->SEKTOR->ViewValue = $this->SEKTOR->CurrentValue;
            $this->SEKTOR->ViewCustomAttributes = "";

            // SEKTOR_PERGUB
            $curVal = strval($this->SEKTOR_PERGUB->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->lookupCacheOption($curVal);
                if ($this->SEKTOR_PERGUB->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='PERGUB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_PERGUB->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_PERGUB->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_PERGUB->ViewValue = null;
            }
            $this->SEKTOR_PERGUB->ViewCustomAttributes = "";

            // SEKTOR_KBLI
            $curVal = strval($this->SEKTOR_KBLI->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->lookupCacheOption($curVal);
                if ($this->SEKTOR_KBLI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='KBLI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_KBLI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_KBLI->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_KBLI->ViewValue = null;
            }
            $this->SEKTOR_KBLI->ViewCustomAttributes = "";

            // SEKTOR_EKRAF
            $curVal = strval($this->SEKTOR_EKRAF->CurrentValue);
            if ($curVal != "") {
                $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->lookupCacheOption($curVal);
                if ($this->SEKTOR_EKRAF->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='EKRAFT'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->SEKTOR_EKRAF->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->SEKTOR_EKRAF->Lookup->renderViewRow($rswrk[0]);
                        $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->displayValue($arwrk);
                    } else {
                        $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->CurrentValue;
                    }
                }
            } else {
                $this->SEKTOR_EKRAF->ViewValue = null;
            }
            $this->SEKTOR_EKRAF->ViewCustomAttributes = "";

            // KAPANEWON
            $curVal = strval($this->KAPANEWON->CurrentValue);
            if ($curVal != "") {
                $this->KAPANEWON->ViewValue = $this->KAPANEWON->lookupCacheOption($curVal);
                if ($this->KAPANEWON->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "`city_id`='3402'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KAPANEWON->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KAPANEWON->Lookup->renderViewRow($rswrk[0]);
                        $this->KAPANEWON->ViewValue = $this->KAPANEWON->displayValue($arwrk);
                    } else {
                        $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
                    }
                }
            } else {
                $this->KAPANEWON->ViewValue = null;
            }
            $this->KAPANEWON->ViewCustomAttributes = "";

            // KALURAHAN
            $curVal = strval($this->KALURAHAN->CurrentValue);
            if ($curVal != "") {
                $this->KALURAHAN->ViewValue = $this->KALURAHAN->lookupCacheOption($curVal);
                if ($this->KALURAHAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $sqlWrk = $this->KALURAHAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KALURAHAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KALURAHAN->ViewValue = $this->KALURAHAN->displayValue($arwrk);
                    } else {
                        $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
                    }
                }
            } else {
                $this->KALURAHAN->ViewValue = null;
            }
            $this->KALURAHAN->ViewCustomAttributes = "";

            // DUSUN
            $this->DUSUN->ViewValue = $this->DUSUN->CurrentValue;
            $this->DUSUN->ViewCustomAttributes = "";

            // ALAMAT
            $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
            $this->ALAMAT->ViewCustomAttributes = "";

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->ViewValue = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
            $this->TENAGA_KERJA_LAKILAKI->ViewValue = FormatNumber($this->TENAGA_KERJA_LAKILAKI->ViewValue, 0, -2, -2, -2);
            $this->TENAGA_KERJA_LAKILAKI->ViewCustomAttributes = "";

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->ViewValue = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
            $this->TENAGA_KERJA_PEREMPUAN->ViewValue = FormatNumber($this->TENAGA_KERJA_PEREMPUAN->ViewValue, 0, -2, -2, -2);
            $this->TENAGA_KERJA_PEREMPUAN->ViewCustomAttributes = "";

            // MODAL_KERJA
            $this->MODAL_KERJA->ViewValue = $this->MODAL_KERJA->CurrentValue;
            $this->MODAL_KERJA->ViewValue = FormatNumber($this->MODAL_KERJA->ViewValue, 2, -2, -2, -2);
            $this->MODAL_KERJA->ViewCustomAttributes = "";

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->ViewValue = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
            $this->OMZET_RATARATA_PERTAHUN->ViewValue = FormatNumber($this->OMZET_RATARATA_PERTAHUN->ViewValue, 2, -2, -2, -2);
            $this->OMZET_RATARATA_PERTAHUN->ViewCustomAttributes = "";

            // STATUS_USAHA
            $this->STATUS_USAHA->ViewValue = $this->STATUS_USAHA->CurrentValue;
            $this->STATUS_USAHA->ViewCustomAttributes = "";

            // ASET
            $this->ASET->ViewValue = $this->ASET->CurrentValue;
            $this->ASET->ViewValue = FormatNumber($this->ASET->ViewValue, 2, -2, -2, -2);
            $this->ASET->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // NAMA_USAHA
            $this->NAMA_USAHA->LinkCustomAttributes = "";
            $this->NAMA_USAHA->HrefValue = "";
            $this->NAMA_USAHA->TooltipValue = "";

            // TAHUN_MULAI_USAHA
            $this->TAHUN_MULAI_USAHA->LinkCustomAttributes = "";
            $this->TAHUN_MULAI_USAHA->HrefValue = "";
            $this->TAHUN_MULAI_USAHA->TooltipValue = "";

            // NO_IZIN_USAHA
            $this->NO_IZIN_USAHA->LinkCustomAttributes = "";
            $this->NO_IZIN_USAHA->HrefValue = "";
            $this->NO_IZIN_USAHA->TooltipValue = "";

            // SEKTOR
            $this->SEKTOR->LinkCustomAttributes = "";
            $this->SEKTOR->HrefValue = "";
            $this->SEKTOR->TooltipValue = "";

            // SEKTOR_PERGUB
            $this->SEKTOR_PERGUB->LinkCustomAttributes = "";
            $this->SEKTOR_PERGUB->HrefValue = "";
            $this->SEKTOR_PERGUB->TooltipValue = "";

            // SEKTOR_KBLI
            $this->SEKTOR_KBLI->LinkCustomAttributes = "";
            $this->SEKTOR_KBLI->HrefValue = "";
            $this->SEKTOR_KBLI->TooltipValue = "";

            // SEKTOR_EKRAF
            $this->SEKTOR_EKRAF->LinkCustomAttributes = "";
            $this->SEKTOR_EKRAF->HrefValue = "";
            $this->SEKTOR_EKRAF->TooltipValue = "";

            // KAPANEWON
            $this->KAPANEWON->LinkCustomAttributes = "";
            $this->KAPANEWON->HrefValue = "";
            $this->KAPANEWON->TooltipValue = "";

            // KALURAHAN
            $this->KALURAHAN->LinkCustomAttributes = "";
            $this->KALURAHAN->HrefValue = "";
            $this->KALURAHAN->TooltipValue = "";

            // DUSUN
            $this->DUSUN->LinkCustomAttributes = "";
            $this->DUSUN->HrefValue = "";
            $this->DUSUN->TooltipValue = "";

            // ALAMAT
            $this->ALAMAT->LinkCustomAttributes = "";
            $this->ALAMAT->HrefValue = "";
            $this->ALAMAT->TooltipValue = "";

            // TENAGA_KERJA_LAKI-LAKI
            $this->TENAGA_KERJA_LAKILAKI->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_LAKILAKI->HrefValue = "";
            $this->TENAGA_KERJA_LAKILAKI->TooltipValue = "";

            // TENAGA_KERJA_PEREMPUAN
            $this->TENAGA_KERJA_PEREMPUAN->LinkCustomAttributes = "";
            $this->TENAGA_KERJA_PEREMPUAN->HrefValue = "";
            $this->TENAGA_KERJA_PEREMPUAN->TooltipValue = "";

            // MODAL_KERJA
            $this->MODAL_KERJA->LinkCustomAttributes = "";
            $this->MODAL_KERJA->HrefValue = "";
            $this->MODAL_KERJA->TooltipValue = "";

            // OMZET_RATA-RATA_PERTAHUN
            $this->OMZET_RATARATA_PERTAHUN->LinkCustomAttributes = "";
            $this->OMZET_RATARATA_PERTAHUN->HrefValue = "";
            $this->OMZET_RATARATA_PERTAHUN->TooltipValue = "";

            // STATUS_USAHA
            $this->STATUS_USAHA->LinkCustomAttributes = "";
            $this->STATUS_USAHA->HrefValue = "";
            $this->STATUS_USAHA->TooltipValue = "";

            // ASET
            $this->ASET->LinkCustomAttributes = "";
            $this->ASET->HrefValue = "";
            $this->ASET->TooltipValue = "";
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

    // Set up master/detail based on QueryString
    protected function setupMasterParms()
    {
        $validMaster = false;
        // Get the keys for master table
        if (($master = Get(Config("TABLE_SHOW_MASTER"), Get(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                $validMaster = true;
                $this->DbMasterFilter = "";
                $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "umkm_datadiri") {
                $validMaster = true;
                $masterTbl = Container("umkm_datadiri");
                if (($parm = Get("fk_NIK", Get("NIK"))) !== null) {
                    $masterTbl->NIK->setQueryStringValue($parm);
                    $this->NIK->setQueryStringValue($masterTbl->NIK->QueryStringValue);
                    $this->NIK->setSessionValue($this->NIK->QueryStringValue);
                } else {
                    $validMaster = false;
                }
            }
        } elseif (($master = Post(Config("TABLE_SHOW_MASTER"), Post(Config("TABLE_MASTER")))) !== null) {
            $masterTblVar = $master;
            if ($masterTblVar == "") {
                    $validMaster = true;
                    $this->DbMasterFilter = "";
                    $this->DbDetailFilter = "";
            }
            if ($masterTblVar == "umkm_datadiri") {
                $validMaster = true;
                $masterTbl = Container("umkm_datadiri");
                if (($parm = Post("fk_NIK", Post("NIK"))) !== null) {
                    $masterTbl->NIK->setFormValue($parm);
                    $this->NIK->setFormValue($masterTbl->NIK->FormValue);
                    $this->NIK->setSessionValue($this->NIK->FormValue);
                } else {
                    $validMaster = false;
                }
            }
        }
        if ($validMaster) {
            // Save current master table
            $this->setCurrentMasterTable($masterTblVar);

            // Reset start record counter (new master key)
            if (!$this->isAddOrEdit()) {
                $this->StartRecord = 1;
                $this->setStartRecordNumber($this->StartRecord);
            }

            // Clear previous master key from Session
            if ($masterTblVar != "umkm_datadiri") {
                if ($this->NIK->CurrentValue == "") {
                    $this->NIK->setSessionValue("");
                }
            }
        }
        $this->DbMasterFilter = $this->getMasterFilter(); // Get master filter
        $this->DbDetailFilter = $this->getDetailFilter(); // Get detail filter
    }

    // Set up Breadcrumb
    protected function setupBreadcrumb()
    {
        global $Breadcrumb, $Language;
        $Breadcrumb = new Breadcrumb("index");
        $url = CurrentUrl();
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmdatausahalist"), "", $this->TableVar, true);
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
                case "x_SEKTOR_PERGUB":
                    $lookupFilter = function () {
                        return "`subkat`='PERGUB'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SEKTOR_KBLI":
                    $lookupFilter = function () {
                        return "`subkat`='KBLI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_SEKTOR_EKRAF":
                    $lookupFilter = function () {
                        return "`subkat`='EKRAFT'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KAPANEWON":
                    $lookupFilter = function () {
                        return "`city_id`='3402'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KALURAHAN":
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
