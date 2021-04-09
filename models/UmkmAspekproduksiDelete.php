<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekproduksiDelete extends UmkmAspekproduksi
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekproduksi';

    // Page object name
    public $PageObjName = "UmkmAspekproduksiDelete";

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

        // Table object (umkm_aspekproduksi)
        if (!isset($GLOBALS["umkm_aspekproduksi"]) || get_class($GLOBALS["umkm_aspekproduksi"]) == PROJECT_NAMESPACE . "umkm_aspekproduksi") {
            $GLOBALS["umkm_aspekproduksi"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekproduksi');
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
                $doc = new $class(Container("umkm_aspekproduksi"));
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
        $this->PROD_FREKUENSIPRODUKSI->setVisibility();
        $this->PROD_KAPASITAS->setVisibility();
        $this->PROD_KEAMANANPANGAN->setVisibility();
        $this->PROD_SNI->setVisibility();
        $this->PROD_KEMASAN->setVisibility();
        $this->PROD_KETERSEDIAANBAHANBAKU->setVisibility();
        $this->PROD_ALATPRODUKSI->setVisibility();
        $this->PROD_GUDANGPENYIMPAN->setVisibility();
        $this->PROD_LAYOUTPRODUKSI->setVisibility();
        $this->PROD_SOP->setVisibility();
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
        $this->setupLookupOptions($this->PROD_FREKUENSIPRODUKSI);
        $this->setupLookupOptions($this->PROD_KAPASITAS);
        $this->setupLookupOptions($this->PROD_KEAMANANPANGAN);
        $this->setupLookupOptions($this->PROD_SNI);
        $this->setupLookupOptions($this->PROD_KEMASAN);
        $this->setupLookupOptions($this->PROD_KETERSEDIAANBAHANBAKU);
        $this->setupLookupOptions($this->PROD_ALATPRODUKSI);
        $this->setupLookupOptions($this->PROD_GUDANGPENYIMPAN);
        $this->setupLookupOptions($this->PROD_LAYOUTPRODUKSI);
        $this->setupLookupOptions($this->PROD_SOP);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("umkmaspekproduksilist"); // Prevent SQL injection, return to list
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
                $this->terminate("umkmaspekproduksilist"); // Return to list
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
        $this->PROD_FREKUENSIPRODUKSI->setDbValue($row['PROD_FREKUENSIPRODUKSI']);
        $this->PROD_KAPASITAS->setDbValue($row['PROD_KAPASITAS']);
        $this->PROD_KEAMANANPANGAN->setDbValue($row['PROD_KEAMANANPANGAN']);
        $this->PROD_SNI->setDbValue($row['PROD_SNI']);
        $this->PROD_KEMASAN->setDbValue($row['PROD_KEMASAN']);
        $this->PROD_KETERSEDIAANBAHANBAKU->setDbValue($row['PROD_KETERSEDIAANBAHANBAKU']);
        $this->PROD_ALATPRODUKSI->setDbValue($row['PROD_ALATPRODUKSI']);
        $this->PROD_GUDANGPENYIMPAN->setDbValue($row['PROD_GUDANGPENYIMPAN']);
        $this->PROD_LAYOUTPRODUKSI->setDbValue($row['PROD_LAYOUTPRODUKSI']);
        $this->PROD_SOP->setDbValue($row['PROD_SOP']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['PROD_FREKUENSIPRODUKSI'] = null;
        $row['PROD_KAPASITAS'] = null;
        $row['PROD_KEAMANANPANGAN'] = null;
        $row['PROD_SNI'] = null;
        $row['PROD_KEMASAN'] = null;
        $row['PROD_KETERSEDIAANBAHANBAKU'] = null;
        $row['PROD_ALATPRODUKSI'] = null;
        $row['PROD_GUDANGPENYIMPAN'] = null;
        $row['PROD_LAYOUTPRODUKSI'] = null;
        $row['PROD_SOP'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // NIK
        $this->NIK->CellCssStyle = "white-space: nowrap;";

        // PROD_FREKUENSIPRODUKSI

        // PROD_KAPASITAS

        // PROD_KEAMANANPANGAN

        // PROD_SNI

        // PROD_KEMASAN

        // PROD_KETERSEDIAANBAHANBAKU

        // PROD_ALATPRODUKSI

        // PROD_GUDANGPENYIMPAN

        // PROD_LAYOUTPRODUKSI

        // PROD_SOP
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // PROD_FREKUENSIPRODUKSI
            $curVal = strval($this->PROD_FREKUENSIPRODUKSI->CurrentValue);
            if ($curVal != "") {
                $this->PROD_FREKUENSIPRODUKSI->ViewValue = $this->PROD_FREKUENSIPRODUKSI->lookupCacheOption($curVal);
                if ($this->PROD_FREKUENSIPRODUKSI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Aktifitas Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_FREKUENSIPRODUKSI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_FREKUENSIPRODUKSI->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_FREKUENSIPRODUKSI->ViewValue = $this->PROD_FREKUENSIPRODUKSI->displayValue($arwrk);
                    } else {
                        $this->PROD_FREKUENSIPRODUKSI->ViewValue = $this->PROD_FREKUENSIPRODUKSI->CurrentValue;
                    }
                }
            } else {
                $this->PROD_FREKUENSIPRODUKSI->ViewValue = null;
            }
            $this->PROD_FREKUENSIPRODUKSI->ViewCustomAttributes = "";

            // PROD_KAPASITAS
            $curVal = strval($this->PROD_KAPASITAS->CurrentValue);
            if ($curVal != "") {
                $this->PROD_KAPASITAS->ViewValue = $this->PROD_KAPASITAS->lookupCacheOption($curVal);
                if ($this->PROD_KAPASITAS->ViewValue === null) { // Lookup from database
                    $filterWrk = "`variabel`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                    $lookupFilter = function() {
                        return "`subkat`='Jumlah Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_KAPASITAS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_KAPASITAS->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_KAPASITAS->ViewValue = $this->PROD_KAPASITAS->displayValue($arwrk);
                    } else {
                        $this->PROD_KAPASITAS->ViewValue = $this->PROD_KAPASITAS->CurrentValue;
                    }
                }
            } else {
                $this->PROD_KAPASITAS->ViewValue = null;
            }
            $this->PROD_KAPASITAS->ViewCustomAttributes = "";

            // PROD_KEAMANANPANGAN
            $curVal = strval($this->PROD_KEAMANANPANGAN->CurrentValue);
            if ($curVal != "") {
                $this->PROD_KEAMANANPANGAN->ViewValue = $this->PROD_KEAMANANPANGAN->lookupCacheOption($curVal);
                if ($this->PROD_KEAMANANPANGAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Keamanan Pangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_KEAMANANPANGAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_KEAMANANPANGAN->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_KEAMANANPANGAN->ViewValue = $this->PROD_KEAMANANPANGAN->displayValue($arwrk);
                    } else {
                        $this->PROD_KEAMANANPANGAN->ViewValue = $this->PROD_KEAMANANPANGAN->CurrentValue;
                    }
                }
            } else {
                $this->PROD_KEAMANANPANGAN->ViewValue = null;
            }
            $this->PROD_KEAMANANPANGAN->ViewCustomAttributes = "";

            // PROD_SNI
            $curVal = strval($this->PROD_SNI->CurrentValue);
            if ($curVal != "") {
                $this->PROD_SNI->ViewValue = $this->PROD_SNI->lookupCacheOption($curVal);
                if ($this->PROD_SNI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='SNI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_SNI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_SNI->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_SNI->ViewValue = $this->PROD_SNI->displayValue($arwrk);
                    } else {
                        $this->PROD_SNI->ViewValue = $this->PROD_SNI->CurrentValue;
                    }
                }
            } else {
                $this->PROD_SNI->ViewValue = null;
            }
            $this->PROD_SNI->ViewCustomAttributes = "";

            // PROD_KEMASAN
            $curVal = strval($this->PROD_KEMASAN->CurrentValue);
            if ($curVal != "") {
                $this->PROD_KEMASAN->ViewValue = $this->PROD_KEMASAN->lookupCacheOption($curVal);
                if ($this->PROD_KEMASAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Kemasan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_KEMASAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_KEMASAN->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_KEMASAN->ViewValue = $this->PROD_KEMASAN->displayValue($arwrk);
                    } else {
                        $this->PROD_KEMASAN->ViewValue = $this->PROD_KEMASAN->CurrentValue;
                    }
                }
            } else {
                $this->PROD_KEMASAN->ViewValue = null;
            }
            $this->PROD_KEMASAN->ViewCustomAttributes = "";

            // PROD_KETERSEDIAANBAHANBAKU
            $curVal = strval($this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue);
            if ($curVal != "") {
                $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = $this->PROD_KETERSEDIAANBAHANBAKU->lookupCacheOption($curVal);
                if ($this->PROD_KETERSEDIAANBAHANBAKU->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Bahan Baku'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_KETERSEDIAANBAHANBAKU->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_KETERSEDIAANBAHANBAKU->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = $this->PROD_KETERSEDIAANBAHANBAKU->displayValue($arwrk);
                    } else {
                        $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue;
                    }
                }
            } else {
                $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = null;
            }
            $this->PROD_KETERSEDIAANBAHANBAKU->ViewCustomAttributes = "";

            // PROD_ALATPRODUKSI
            $curVal = strval($this->PROD_ALATPRODUKSI->CurrentValue);
            if ($curVal != "") {
                $this->PROD_ALATPRODUKSI->ViewValue = $this->PROD_ALATPRODUKSI->lookupCacheOption($curVal);
                if ($this->PROD_ALATPRODUKSI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Alat Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_ALATPRODUKSI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_ALATPRODUKSI->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_ALATPRODUKSI->ViewValue = $this->PROD_ALATPRODUKSI->displayValue($arwrk);
                    } else {
                        $this->PROD_ALATPRODUKSI->ViewValue = $this->PROD_ALATPRODUKSI->CurrentValue;
                    }
                }
            } else {
                $this->PROD_ALATPRODUKSI->ViewValue = null;
            }
            $this->PROD_ALATPRODUKSI->ViewCustomAttributes = "";

            // PROD_GUDANGPENYIMPAN
            $curVal = strval($this->PROD_GUDANGPENYIMPAN->CurrentValue);
            if ($curVal != "") {
                $this->PROD_GUDANGPENYIMPAN->ViewValue = $this->PROD_GUDANGPENYIMPAN->lookupCacheOption($curVal);
                if ($this->PROD_GUDANGPENYIMPAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Gudang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_GUDANGPENYIMPAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_GUDANGPENYIMPAN->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_GUDANGPENYIMPAN->ViewValue = $this->PROD_GUDANGPENYIMPAN->displayValue($arwrk);
                    } else {
                        $this->PROD_GUDANGPENYIMPAN->ViewValue = $this->PROD_GUDANGPENYIMPAN->CurrentValue;
                    }
                }
            } else {
                $this->PROD_GUDANGPENYIMPAN->ViewValue = null;
            }
            $this->PROD_GUDANGPENYIMPAN->ViewCustomAttributes = "";

            // PROD_LAYOUTPRODUKSI
            $curVal = strval($this->PROD_LAYOUTPRODUKSI->CurrentValue);
            if ($curVal != "") {
                $this->PROD_LAYOUTPRODUKSI->ViewValue = $this->PROD_LAYOUTPRODUKSI->lookupCacheOption($curVal);
                if ($this->PROD_LAYOUTPRODUKSI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Layout'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_LAYOUTPRODUKSI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_LAYOUTPRODUKSI->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_LAYOUTPRODUKSI->ViewValue = $this->PROD_LAYOUTPRODUKSI->displayValue($arwrk);
                    } else {
                        $this->PROD_LAYOUTPRODUKSI->ViewValue = $this->PROD_LAYOUTPRODUKSI->CurrentValue;
                    }
                }
            } else {
                $this->PROD_LAYOUTPRODUKSI->ViewValue = null;
            }
            $this->PROD_LAYOUTPRODUKSI->ViewCustomAttributes = "";

            // PROD_SOP
            $curVal = strval($this->PROD_SOP->CurrentValue);
            if ($curVal != "") {
                $this->PROD_SOP->ViewValue = $this->PROD_SOP->lookupCacheOption($curVal);
                if ($this->PROD_SOP->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='SOP'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->PROD_SOP->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->PROD_SOP->Lookup->renderViewRow($rswrk[0]);
                        $this->PROD_SOP->ViewValue = $this->PROD_SOP->displayValue($arwrk);
                    } else {
                        $this->PROD_SOP->ViewValue = $this->PROD_SOP->CurrentValue;
                    }
                }
            } else {
                $this->PROD_SOP->ViewValue = null;
            }
            $this->PROD_SOP->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // PROD_FREKUENSIPRODUKSI
            $this->PROD_FREKUENSIPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_FREKUENSIPRODUKSI->HrefValue = "";
            $this->PROD_FREKUENSIPRODUKSI->TooltipValue = "";

            // PROD_KAPASITAS
            $this->PROD_KAPASITAS->LinkCustomAttributes = "";
            $this->PROD_KAPASITAS->HrefValue = "";
            $this->PROD_KAPASITAS->TooltipValue = "";

            // PROD_KEAMANANPANGAN
            $this->PROD_KEAMANANPANGAN->LinkCustomAttributes = "";
            $this->PROD_KEAMANANPANGAN->HrefValue = "";
            $this->PROD_KEAMANANPANGAN->TooltipValue = "";

            // PROD_SNI
            $this->PROD_SNI->LinkCustomAttributes = "";
            $this->PROD_SNI->HrefValue = "";
            $this->PROD_SNI->TooltipValue = "";

            // PROD_KEMASAN
            $this->PROD_KEMASAN->LinkCustomAttributes = "";
            $this->PROD_KEMASAN->HrefValue = "";
            $this->PROD_KEMASAN->TooltipValue = "";

            // PROD_KETERSEDIAANBAHANBAKU
            $this->PROD_KETERSEDIAANBAHANBAKU->LinkCustomAttributes = "";
            $this->PROD_KETERSEDIAANBAHANBAKU->HrefValue = "";
            $this->PROD_KETERSEDIAANBAHANBAKU->TooltipValue = "";

            // PROD_ALATPRODUKSI
            $this->PROD_ALATPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_ALATPRODUKSI->HrefValue = "";
            $this->PROD_ALATPRODUKSI->TooltipValue = "";

            // PROD_GUDANGPENYIMPAN
            $this->PROD_GUDANGPENYIMPAN->LinkCustomAttributes = "";
            $this->PROD_GUDANGPENYIMPAN->HrefValue = "";
            $this->PROD_GUDANGPENYIMPAN->TooltipValue = "";

            // PROD_LAYOUTPRODUKSI
            $this->PROD_LAYOUTPRODUKSI->LinkCustomAttributes = "";
            $this->PROD_LAYOUTPRODUKSI->HrefValue = "";
            $this->PROD_LAYOUTPRODUKSI->TooltipValue = "";

            // PROD_SOP
            $this->PROD_SOP->LinkCustomAttributes = "";
            $this->PROD_SOP->HrefValue = "";
            $this->PROD_SOP->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekproduksilist"), "", $this->TableVar, true);
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
                case "x_PROD_FREKUENSIPRODUKSI":
                    $lookupFilter = function () {
                        return "`subkat`='Aktifitas Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_KAPASITAS":
                    $lookupFilter = function () {
                        return "`subkat`='Jumlah Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_KEAMANANPANGAN":
                    $lookupFilter = function () {
                        return "`subkat`='Keamanan Pangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_SNI":
                    $lookupFilter = function () {
                        return "`subkat`='SNI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_KEMASAN":
                    $lookupFilter = function () {
                        return "`subkat`='Kemasan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_KETERSEDIAANBAHANBAKU":
                    $lookupFilter = function () {
                        return "`subkat`='Bahan Baku'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_ALATPRODUKSI":
                    $lookupFilter = function () {
                        return "`subkat`='Alat Produksi'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_GUDANGPENYIMPAN":
                    $lookupFilter = function () {
                        return "`subkat`='Gudang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_LAYOUTPRODUKSI":
                    $lookupFilter = function () {
                        return "`subkat`='Layout'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_PROD_SOP":
                    $lookupFilter = function () {
                        return "`subkat`='SOP'";
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
}