<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekpemasaranDelete extends UmkmAspekpemasaran
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekpemasaran';

    // Page object name
    public $PageObjName = "UmkmAspekpemasaranDelete";

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

        // Table object (umkm_aspekpemasaran)
        if (!isset($GLOBALS["umkm_aspekpemasaran"]) || get_class($GLOBALS["umkm_aspekpemasaran"]) == PROJECT_NAMESPACE . "umkm_aspekpemasaran") {
            $GLOBALS["umkm_aspekpemasaran"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekpemasaran');
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
                $doc = new $class(Container("umkm_aspekpemasaran"));
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
        $this->MK_KEUNGGULANPRODUK->setVisibility();
        $this->MK_TARGETPASAR->setVisibility();
        $this->MK_KETERSEDIAAN->setVisibility();
        $this->MK_LOGO->setVisibility();
        $this->MK_HKI->setVisibility();
        $this->MK_BRANDING->setVisibility();
        $this->MK_COBRANDING->setVisibility();
        $this->MK_MEDIAOFFLINE->setVisibility();
        $this->MK_RESELLER->setVisibility();
        $this->MK_PASAR->setVisibility();
        $this->MK_PELANGGAN->setVisibility();
        $this->MK_PAMERANMANDIRI->setVisibility();
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
        $this->setupLookupOptions($this->MK_KEUNGGULANPRODUK);
        $this->setupLookupOptions($this->MK_TARGETPASAR);
        $this->setupLookupOptions($this->MK_KETERSEDIAAN);
        $this->setupLookupOptions($this->MK_LOGO);
        $this->setupLookupOptions($this->MK_HKI);
        $this->setupLookupOptions($this->MK_BRANDING);
        $this->setupLookupOptions($this->MK_COBRANDING);
        $this->setupLookupOptions($this->MK_MEDIAOFFLINE);
        $this->setupLookupOptions($this->MK_RESELLER);
        $this->setupLookupOptions($this->MK_PASAR);
        $this->setupLookupOptions($this->MK_PELANGGAN);
        $this->setupLookupOptions($this->MK_PAMERANMANDIRI);

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("umkmaspekpemasaranlist"); // Prevent SQL injection, return to list
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
                $this->terminate("umkmaspekpemasaranlist"); // Return to list
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
        $this->MK_KEUNGGULANPRODUK->setDbValue($row['MK_KEUNGGULANPRODUK']);
        $this->MK_TARGETPASAR->setDbValue($row['MK_TARGETPASAR']);
        $this->MK_KETERSEDIAAN->setDbValue($row['MK_KETERSEDIAAN']);
        $this->MK_LOGO->setDbValue($row['MK_LOGO']);
        $this->MK_HKI->setDbValue($row['MK_HKI']);
        $this->MK_BRANDING->setDbValue($row['MK_BRANDING']);
        $this->MK_COBRANDING->setDbValue($row['MK_COBRANDING']);
        $this->MK_MEDIAOFFLINE->setDbValue($row['MK_MEDIAOFFLINE']);
        $this->MK_RESELLER->setDbValue($row['MK_RESELLER']);
        $this->MK_PASAR->setDbValue($row['MK_PASAR']);
        $this->MK_PELANGGAN->setDbValue($row['MK_PELANGGAN']);
        $this->MK_PAMERANMANDIRI->setDbValue($row['MK_PAMERANMANDIRI']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['MK_KEUNGGULANPRODUK'] = null;
        $row['MK_TARGETPASAR'] = null;
        $row['MK_KETERSEDIAAN'] = null;
        $row['MK_LOGO'] = null;
        $row['MK_HKI'] = null;
        $row['MK_BRANDING'] = null;
        $row['MK_COBRANDING'] = null;
        $row['MK_MEDIAOFFLINE'] = null;
        $row['MK_RESELLER'] = null;
        $row['MK_PASAR'] = null;
        $row['MK_PELANGGAN'] = null;
        $row['MK_PAMERANMANDIRI'] = null;
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

        // MK_KEUNGGULANPRODUK

        // MK_TARGETPASAR

        // MK_KETERSEDIAAN

        // MK_LOGO

        // MK_HKI

        // MK_BRANDING

        // MK_COBRANDING

        // MK_MEDIAOFFLINE

        // MK_RESELLER

        // MK_PASAR

        // MK_PELANGGAN

        // MK_PAMERANMANDIRI
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // MK_KEUNGGULANPRODUK
            $curVal = strval($this->MK_KEUNGGULANPRODUK->CurrentValue);
            if ($curVal != "") {
                $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->lookupCacheOption($curVal);
                if ($this->MK_KEUNGGULANPRODUK->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Kekuatan Produk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_KEUNGGULANPRODUK->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_KEUNGGULANPRODUK->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->displayValue($arwrk);
                    } else {
                        $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->CurrentValue;
                    }
                }
            } else {
                $this->MK_KEUNGGULANPRODUK->ViewValue = null;
            }
            $this->MK_KEUNGGULANPRODUK->ViewCustomAttributes = "";

            // MK_TARGETPASAR
            $curVal = strval($this->MK_TARGETPASAR->CurrentValue);
            if ($curVal != "") {
                $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->lookupCacheOption($curVal);
                if ($this->MK_TARGETPASAR->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Target Pasar'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_TARGETPASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_TARGETPASAR->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->displayValue($arwrk);
                    } else {
                        $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->CurrentValue;
                    }
                }
            } else {
                $this->MK_TARGETPASAR->ViewValue = null;
            }
            $this->MK_TARGETPASAR->ViewCustomAttributes = "";

            // MK_KETERSEDIAAN
            $curVal = strval($this->MK_KETERSEDIAAN->CurrentValue);
            if ($curVal != "") {
                $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->lookupCacheOption($curVal);
                if ($this->MK_KETERSEDIAAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Mudah Didapatkan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_KETERSEDIAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_KETERSEDIAAN->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->displayValue($arwrk);
                    } else {
                        $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->CurrentValue;
                    }
                }
            } else {
                $this->MK_KETERSEDIAAN->ViewValue = null;
            }
            $this->MK_KETERSEDIAAN->ViewCustomAttributes = "";

            // MK_LOGO
            $curVal = strval($this->MK_LOGO->CurrentValue);
            if ($curVal != "") {
                $this->MK_LOGO->ViewValue = $this->MK_LOGO->lookupCacheOption($curVal);
                if ($this->MK_LOGO->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Logo Dagang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_LOGO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_LOGO->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_LOGO->ViewValue = $this->MK_LOGO->displayValue($arwrk);
                    } else {
                        $this->MK_LOGO->ViewValue = $this->MK_LOGO->CurrentValue;
                    }
                }
            } else {
                $this->MK_LOGO->ViewValue = null;
            }
            $this->MK_LOGO->ViewCustomAttributes = "";

            // MK_HKI
            $curVal = strval($this->MK_HKI->CurrentValue);
            if ($curVal != "") {
                $this->MK_HKI->ViewValue = $this->MK_HKI->lookupCacheOption($curVal);
                if ($this->MK_HKI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='HKI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_HKI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_HKI->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_HKI->ViewValue = $this->MK_HKI->displayValue($arwrk);
                    } else {
                        $this->MK_HKI->ViewValue = $this->MK_HKI->CurrentValue;
                    }
                }
            } else {
                $this->MK_HKI->ViewValue = null;
            }
            $this->MK_HKI->ViewCustomAttributes = "";

            // MK_BRANDING
            $curVal = strval($this->MK_BRANDING->CurrentValue);
            if ($curVal != "") {
                $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->lookupCacheOption($curVal);
                if ($this->MK_BRANDING->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Konsep Branding'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_BRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_BRANDING->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->displayValue($arwrk);
                    } else {
                        $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->CurrentValue;
                    }
                }
            } else {
                $this->MK_BRANDING->ViewValue = null;
            }
            $this->MK_BRANDING->ViewCustomAttributes = "";

            // MK_COBRANDING
            $curVal = strval($this->MK_COBRANDING->CurrentValue);
            if ($curVal != "") {
                $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->lookupCacheOption($curVal);
                if ($this->MK_COBRANDING->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Jogjamark'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_COBRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_COBRANDING->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->displayValue($arwrk);
                    } else {
                        $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->CurrentValue;
                    }
                }
            } else {
                $this->MK_COBRANDING->ViewValue = null;
            }
            $this->MK_COBRANDING->ViewCustomAttributes = "";

            // MK_MEDIAOFFLINE
            $curVal = strval($this->MK_MEDIAOFFLINE->CurrentValue);
            if ($curVal != "") {
                $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->lookupCacheOption($curVal);
                if ($this->MK_MEDIAOFFLINE->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Offline'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_MEDIAOFFLINE->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_MEDIAOFFLINE->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->displayValue($arwrk);
                    } else {
                        $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->CurrentValue;
                    }
                }
            } else {
                $this->MK_MEDIAOFFLINE->ViewValue = null;
            }
            $this->MK_MEDIAOFFLINE->ViewCustomAttributes = "";

            // MK_RESELLER
            $curVal = strval($this->MK_RESELLER->CurrentValue);
            if ($curVal != "") {
                $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->lookupCacheOption($curVal);
                if ($this->MK_RESELLER->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Mitra'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_RESELLER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_RESELLER->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->displayValue($arwrk);
                    } else {
                        $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->CurrentValue;
                    }
                }
            } else {
                $this->MK_RESELLER->ViewValue = null;
            }
            $this->MK_RESELLER->ViewCustomAttributes = "";

            // MK_PASAR
            $curVal = strval($this->MK_PASAR->CurrentValue);
            if ($curVal != "") {
                $this->MK_PASAR->ViewValue = $this->MK_PASAR->lookupCacheOption($curVal);
                if ($this->MK_PASAR->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pemasaran'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PASAR->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PASAR->ViewValue = $this->MK_PASAR->displayValue($arwrk);
                    } else {
                        $this->MK_PASAR->ViewValue = $this->MK_PASAR->CurrentValue;
                    }
                }
            } else {
                $this->MK_PASAR->ViewValue = null;
            }
            $this->MK_PASAR->ViewCustomAttributes = "";

            // MK_PELANGGAN
            $curVal = strval($this->MK_PELANGGAN->CurrentValue);
            if ($curVal != "") {
                $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->lookupCacheOption($curVal);
                if ($this->MK_PELANGGAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pelanggan Tetap'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PELANGGAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PELANGGAN->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->displayValue($arwrk);
                    } else {
                        $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->CurrentValue;
                    }
                }
            } else {
                $this->MK_PELANGGAN->ViewValue = null;
            }
            $this->MK_PELANGGAN->ViewCustomAttributes = "";

            // MK_PAMERANMANDIRI
            $curVal = strval($this->MK_PAMERANMANDIRI->CurrentValue);
            if ($curVal != "") {
                $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->lookupCacheOption($curVal);
                if ($this->MK_PAMERANMANDIRI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pameran Mandiri'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->MK_PAMERANMANDIRI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->MK_PAMERANMANDIRI->Lookup->renderViewRow($rswrk[0]);
                        $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->displayValue($arwrk);
                    } else {
                        $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->CurrentValue;
                    }
                }
            } else {
                $this->MK_PAMERANMANDIRI->ViewValue = null;
            }
            $this->MK_PAMERANMANDIRI->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // MK_KEUNGGULANPRODUK
            $this->MK_KEUNGGULANPRODUK->LinkCustomAttributes = "";
            $this->MK_KEUNGGULANPRODUK->HrefValue = "";
            $this->MK_KEUNGGULANPRODUK->TooltipValue = "";

            // MK_TARGETPASAR
            $this->MK_TARGETPASAR->LinkCustomAttributes = "";
            $this->MK_TARGETPASAR->HrefValue = "";
            $this->MK_TARGETPASAR->TooltipValue = "";

            // MK_KETERSEDIAAN
            $this->MK_KETERSEDIAAN->LinkCustomAttributes = "";
            $this->MK_KETERSEDIAAN->HrefValue = "";
            $this->MK_KETERSEDIAAN->TooltipValue = "";

            // MK_LOGO
            $this->MK_LOGO->LinkCustomAttributes = "";
            $this->MK_LOGO->HrefValue = "";
            $this->MK_LOGO->TooltipValue = "";

            // MK_HKI
            $this->MK_HKI->LinkCustomAttributes = "";
            $this->MK_HKI->HrefValue = "";
            $this->MK_HKI->TooltipValue = "";

            // MK_BRANDING
            $this->MK_BRANDING->LinkCustomAttributes = "";
            $this->MK_BRANDING->HrefValue = "";
            $this->MK_BRANDING->TooltipValue = "";

            // MK_COBRANDING
            $this->MK_COBRANDING->LinkCustomAttributes = "";
            $this->MK_COBRANDING->HrefValue = "";
            $this->MK_COBRANDING->TooltipValue = "";

            // MK_MEDIAOFFLINE
            $this->MK_MEDIAOFFLINE->LinkCustomAttributes = "";
            $this->MK_MEDIAOFFLINE->HrefValue = "";
            $this->MK_MEDIAOFFLINE->TooltipValue = "";

            // MK_RESELLER
            $this->MK_RESELLER->LinkCustomAttributes = "";
            $this->MK_RESELLER->HrefValue = "";
            $this->MK_RESELLER->TooltipValue = "";

            // MK_PASAR
            $this->MK_PASAR->LinkCustomAttributes = "";
            $this->MK_PASAR->HrefValue = "";
            $this->MK_PASAR->TooltipValue = "";

            // MK_PELANGGAN
            $this->MK_PELANGGAN->LinkCustomAttributes = "";
            $this->MK_PELANGGAN->HrefValue = "";
            $this->MK_PELANGGAN->TooltipValue = "";

            // MK_PAMERANMANDIRI
            $this->MK_PAMERANMANDIRI->LinkCustomAttributes = "";
            $this->MK_PAMERANMANDIRI->HrefValue = "";
            $this->MK_PAMERANMANDIRI->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekpemasaranlist"), "", $this->TableVar, true);
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
                case "x_MK_KEUNGGULANPRODUK":
                    $lookupFilter = function () {
                        return "`subkat`='Kekuatan Produk'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_TARGETPASAR":
                    $lookupFilter = function () {
                        return "`subkat`='Target Pasar'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_KETERSEDIAAN":
                    $lookupFilter = function () {
                        return "`subkat`='Mudah Didapatkan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_LOGO":
                    $lookupFilter = function () {
                        return "`subkat`='Logo Dagang'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_HKI":
                    $lookupFilter = function () {
                        return "`subkat`='HKI'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_BRANDING":
                    $lookupFilter = function () {
                        return "`subkat`='Konsep Branding'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_COBRANDING":
                    $lookupFilter = function () {
                        return "`subkat`='Jogjamark'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_MEDIAOFFLINE":
                    $lookupFilter = function () {
                        return "`subkat`='Offline'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_RESELLER":
                    $lookupFilter = function () {
                        return "`subkat`='Mitra'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PASAR":
                    $lookupFilter = function () {
                        return "`subkat`='Pemasaran'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PELANGGAN":
                    $lookupFilter = function () {
                        return "`subkat`='Pelanggan Tetap'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_MK_PAMERANMANDIRI":
                    $lookupFilter = function () {
                        return "`subkat`='Pameran Mandiri'";
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
