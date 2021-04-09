<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class UmkmAspekkeuanganDelete extends UmkmAspekkeuangan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'umkm_aspekkeuangan';

    // Page object name
    public $PageObjName = "UmkmAspekkeuanganDelete";

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

        // Table object (umkm_aspekkeuangan)
        if (!isset($GLOBALS["umkm_aspekkeuangan"]) || get_class($GLOBALS["umkm_aspekkeuangan"]) == PROJECT_NAMESPACE . "umkm_aspekkeuangan") {
            $GLOBALS["umkm_aspekkeuangan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'umkm_aspekkeuangan');
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
                $doc = new $class(Container("umkm_aspekkeuangan"));
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
        $this->KEU_USAHAUTAMA->setVisibility();
        $this->KEU_PENGELOLAAN->setVisibility();
        $this->KEU_NOTA->setVisibility();
        $this->KEU_PENCATATAN->setVisibility();
        $this->KEU_LAPORAN->setVisibility();
        $this->KEU_UTANGMODAL->setVisibility();
        $this->KEU_CATATNASET->setVisibility();
        $this->KEU_NONTUNAI->setVisibility();
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
        $this->setupLookupOptions($this->KEU_USAHAUTAMA);
        $this->setupLookupOptions($this->KEU_PENGELOLAAN);
        $this->setupLookupOptions($this->KEU_NOTA);
        $this->setupLookupOptions($this->KEU_PENCATATAN);
        $this->setupLookupOptions($this->KEU_LAPORAN);
        $this->setupLookupOptions($this->KEU_UTANGMODAL);
        $this->setupLookupOptions($this->KEU_CATATNASET);
        $this->setupLookupOptions($this->KEU_NONTUNAI);

        // Set up master/detail parameters
        $this->setupMasterParms();

        // Set up Breadcrumb
        $this->setupBreadcrumb();

        // Load key parameters
        $this->RecKeys = $this->getRecordKeys(); // Load record keys
        $filter = $this->getFilterFromRecordKeys();
        if ($filter == "") {
            $this->terminate("umkmaspekkeuanganlist"); // Prevent SQL injection, return to list
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
                $this->terminate("umkmaspekkeuanganlist"); // Return to list
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
        $this->KEU_USAHAUTAMA->setDbValue($row['KEU_USAHAUTAMA']);
        $this->KEU_PENGELOLAAN->setDbValue($row['KEU_PENGELOLAAN']);
        $this->KEU_NOTA->setDbValue($row['KEU_NOTA']);
        $this->KEU_PENCATATAN->setDbValue($row['KEU_PENCATATAN']);
        $this->KEU_LAPORAN->setDbValue($row['KEU_LAPORAN']);
        $this->KEU_UTANGMODAL->setDbValue($row['KEU_UTANGMODAL']);
        $this->KEU_CATATNASET->setDbValue($row['KEU_CATATNASET']);
        $this->KEU_NONTUNAI->setDbValue($row['KEU_NONTUNAI']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['NIK'] = null;
        $row['KEU_USAHAUTAMA'] = null;
        $row['KEU_PENGELOLAAN'] = null;
        $row['KEU_NOTA'] = null;
        $row['KEU_PENCATATAN'] = null;
        $row['KEU_LAPORAN'] = null;
        $row['KEU_UTANGMODAL'] = null;
        $row['KEU_CATATNASET'] = null;
        $row['KEU_NONTUNAI'] = null;
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

        // KEU_USAHAUTAMA

        // KEU_PENGELOLAAN

        // KEU_NOTA

        // KEU_PENCATATAN

        // KEU_LAPORAN

        // KEU_UTANGMODAL

        // KEU_CATATNASET

        // KEU_NONTUNAI
        if ($this->RowType == ROWTYPE_VIEW) {
            // NIK
            $this->NIK->ViewValue = $this->NIK->CurrentValue;
            $this->NIK->ViewCustomAttributes = "";

            // KEU_USAHAUTAMA
            $curVal = strval($this->KEU_USAHAUTAMA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->lookupCacheOption($curVal);
                if ($this->KEU_USAHAUTAMA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_USAHAUTAMA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_USAHAUTAMA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->displayValue($arwrk);
                    } else {
                        $this->KEU_USAHAUTAMA->ViewValue = $this->KEU_USAHAUTAMA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_USAHAUTAMA->ViewValue = null;
            }
            $this->KEU_USAHAUTAMA->ViewCustomAttributes = "";

            // KEU_PENGELOLAAN
            $curVal = strval($this->KEU_PENGELOLAAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->lookupCacheOption($curVal);
                if ($this->KEU_PENGELOLAAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENGELOLAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENGELOLAAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENGELOLAAN->ViewValue = $this->KEU_PENGELOLAAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENGELOLAAN->ViewValue = null;
            }
            $this->KEU_PENGELOLAAN->ViewCustomAttributes = "";

            // KEU_NOTA
            $curVal = strval($this->KEU_NOTA->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->lookupCacheOption($curVal);
                if ($this->KEU_NOTA->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NOTA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NOTA->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->displayValue($arwrk);
                    } else {
                        $this->KEU_NOTA->ViewValue = $this->KEU_NOTA->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NOTA->ViewValue = null;
            }
            $this->KEU_NOTA->ViewCustomAttributes = "";

            // KEU_PENCATATAN
            $curVal = strval($this->KEU_PENCATATAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->lookupCacheOption($curVal);
                if ($this->KEU_PENCATATAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_PENCATATAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_PENCATATAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->displayValue($arwrk);
                    } else {
                        $this->KEU_PENCATATAN->ViewValue = $this->KEU_PENCATATAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_PENCATATAN->ViewValue = null;
            }
            $this->KEU_PENCATATAN->ViewCustomAttributes = "";

            // KEU_LAPORAN
            $curVal = strval($this->KEU_LAPORAN->CurrentValue);
            if ($curVal != "") {
                $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->lookupCacheOption($curVal);
                if ($this->KEU_LAPORAN->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_LAPORAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_LAPORAN->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->displayValue($arwrk);
                    } else {
                        $this->KEU_LAPORAN->ViewValue = $this->KEU_LAPORAN->CurrentValue;
                    }
                }
            } else {
                $this->KEU_LAPORAN->ViewValue = null;
            }
            $this->KEU_LAPORAN->ViewCustomAttributes = "";

            // KEU_UTANGMODAL
            $curVal = strval($this->KEU_UTANGMODAL->CurrentValue);
            if ($curVal != "") {
                $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->lookupCacheOption($curVal);
                if ($this->KEU_UTANGMODAL->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_UTANGMODAL->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_UTANGMODAL->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->displayValue($arwrk);
                    } else {
                        $this->KEU_UTANGMODAL->ViewValue = $this->KEU_UTANGMODAL->CurrentValue;
                    }
                }
            } else {
                $this->KEU_UTANGMODAL->ViewValue = null;
            }
            $this->KEU_UTANGMODAL->ViewCustomAttributes = "";

            // KEU_CATATNASET
            $curVal = strval($this->KEU_CATATNASET->CurrentValue);
            if ($curVal != "") {
                $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->lookupCacheOption($curVal);
                if ($this->KEU_CATATNASET->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_CATATNASET->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_CATATNASET->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->displayValue($arwrk);
                    } else {
                        $this->KEU_CATATNASET->ViewValue = $this->KEU_CATATNASET->CurrentValue;
                    }
                }
            } else {
                $this->KEU_CATATNASET->ViewValue = null;
            }
            $this->KEU_CATATNASET->ViewCustomAttributes = "";

            // KEU_NONTUNAI
            $curVal = strval($this->KEU_NONTUNAI->CurrentValue);
            if ($curVal != "") {
                $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->lookupCacheOption($curVal);
                if ($this->KEU_NONTUNAI->ViewValue === null) { // Lookup from database
                    $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                    $lookupFilter = function() {
                        return "`subkat`='Non Tunai'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    $sqlWrk = $this->KEU_NONTUNAI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                    $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                    $ari = count($rswrk);
                    if ($ari > 0) { // Lookup values found
                        $arwrk = $this->KEU_NONTUNAI->Lookup->renderViewRow($rswrk[0]);
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->displayValue($arwrk);
                    } else {
                        $this->KEU_NONTUNAI->ViewValue = $this->KEU_NONTUNAI->CurrentValue;
                    }
                }
            } else {
                $this->KEU_NONTUNAI->ViewValue = null;
            }
            $this->KEU_NONTUNAI->ViewCustomAttributes = "";

            // NIK
            $this->NIK->LinkCustomAttributes = "";
            $this->NIK->HrefValue = "";
            $this->NIK->TooltipValue = "";

            // KEU_USAHAUTAMA
            $this->KEU_USAHAUTAMA->LinkCustomAttributes = "";
            $this->KEU_USAHAUTAMA->HrefValue = "";
            $this->KEU_USAHAUTAMA->TooltipValue = "";

            // KEU_PENGELOLAAN
            $this->KEU_PENGELOLAAN->LinkCustomAttributes = "";
            $this->KEU_PENGELOLAAN->HrefValue = "";
            $this->KEU_PENGELOLAAN->TooltipValue = "";

            // KEU_NOTA
            $this->KEU_NOTA->LinkCustomAttributes = "";
            $this->KEU_NOTA->HrefValue = "";
            $this->KEU_NOTA->TooltipValue = "";

            // KEU_PENCATATAN
            $this->KEU_PENCATATAN->LinkCustomAttributes = "";
            $this->KEU_PENCATATAN->HrefValue = "";
            $this->KEU_PENCATATAN->TooltipValue = "";

            // KEU_LAPORAN
            $this->KEU_LAPORAN->LinkCustomAttributes = "";
            $this->KEU_LAPORAN->HrefValue = "";
            $this->KEU_LAPORAN->TooltipValue = "";

            // KEU_UTANGMODAL
            $this->KEU_UTANGMODAL->LinkCustomAttributes = "";
            $this->KEU_UTANGMODAL->HrefValue = "";
            $this->KEU_UTANGMODAL->TooltipValue = "";

            // KEU_CATATNASET
            $this->KEU_CATATNASET->LinkCustomAttributes = "";
            $this->KEU_CATATNASET->HrefValue = "";
            $this->KEU_CATATNASET->TooltipValue = "";

            // KEU_NONTUNAI
            $this->KEU_NONTUNAI->LinkCustomAttributes = "";
            $this->KEU_NONTUNAI->HrefValue = "";
            $this->KEU_NONTUNAI->TooltipValue = "";
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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("umkmaspekkeuanganlist"), "", $this->TableVar, true);
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
                case "x_KEU_USAHAUTAMA":
                    $lookupFilter = function () {
                        return "`subkat`='Sumber Utama'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENGELOLAAN":
                    $lookupFilter = function () {
                        return "`subkat`='Keuangan Perusahaan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NOTA":
                    $lookupFilter = function () {
                        return "`subkat`='Nota'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_PENCATATAN":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_LAPORAN":
                    $lookupFilter = function () {
                        return "`subkat`='Laporan Keuangan'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_UTANGMODAL":
                    $lookupFilter = function () {
                        return "`subkat`='Pinjaman Bank'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_CATATNASET":
                    $lookupFilter = function () {
                        return "`subkat`='Catatan Aset'";
                    };
                    $lookupFilter = $lookupFilter->bindTo($this);
                    break;
                case "x_KEU_NONTUNAI":
                    $lookupFilter = function () {
                        return "`subkat`='Non Tunai'";
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
