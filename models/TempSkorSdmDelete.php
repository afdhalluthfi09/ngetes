<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorSdmDelete extends TempSkorSdm
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_sdm';

    // Page object name
    public $PageObjName = "TempSkorSdmDelete";

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

        // Table object (temp_skor_sdm)
        if (!isset($GLOBALS["temp_skor_sdm"]) || get_class($GLOBALS["temp_skor_sdm"]) == PROJECT_NAMESPACE . "temp_skor_sdm") {
            $GLOBALS["temp_skor_sdm"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_sdm');
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
                $doc = new $class(Container("temp_skor_sdm"));
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
        $this->skor_oms->setVisibility();
        $this->max_oms->setVisibility();
        $this->skor_fokus->setVisibility();
        $this->max_fokus->setVisibility();
        $this->skor_target->setVisibility();
        $this->max_target->setVisibility();
        $this->skor_karyawan->setVisibility();
        $this->max_karyawan->setVisibility();
        $this->skor_outsource->setVisibility();
        $this->max_outsource->setVisibility();
        $this->skor_besarangaji->setVisibility();
        $this->max_besarangaji->setVisibility();
        $this->skor_asuransi->setVisibility();
        $this->max_asuransi->setVisibility();
        $this->skor_bonus->setVisibility();
        $this->max_bonus->setVisibility();
        $this->skor_training->setVisibility();
        $this->max_training->setVisibility();
        $this->skor_sdm->setVisibility();
        $this->maxskor_sdm->setVisibility();
        $this->bobot_sdm->setVisibility();
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
            $this->terminate("tempskorsdmlist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorsdmlist"); // Return to list
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
        $this->skor_oms->setDbValue($row['skor_oms']);
        $this->max_oms->setDbValue($row['max_oms']);
        $this->skor_fokus->setDbValue($row['skor_fokus']);
        $this->max_fokus->setDbValue($row['max_fokus']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_karyawan->setDbValue($row['skor_karyawan']);
        $this->max_karyawan->setDbValue($row['max_karyawan']);
        $this->skor_outsource->setDbValue($row['skor_outsource']);
        $this->max_outsource->setDbValue($row['max_outsource']);
        $this->skor_besarangaji->setDbValue($row['skor_besarangaji']);
        $this->max_besarangaji->setDbValue($row['max_besarangaji']);
        $this->skor_asuransi->setDbValue($row['skor_asuransi']);
        $this->max_asuransi->setDbValue($row['max_asuransi']);
        $this->skor_bonus->setDbValue($row['skor_bonus']);
        $this->max_bonus->setDbValue($row['max_bonus']);
        $this->skor_training->setDbValue($row['skor_training']);
        $this->max_training->setDbValue($row['max_training']);
        $this->skor_sdm->setDbValue($row['skor_sdm']);
        $this->maxskor_sdm->setDbValue($row['maxskor_sdm']);
        $this->bobot_sdm->setDbValue($row['bobot_sdm']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_oms'] = null;
        $row['max_oms'] = null;
        $row['skor_fokus'] = null;
        $row['max_fokus'] = null;
        $row['skor_target'] = null;
        $row['max_target'] = null;
        $row['skor_karyawan'] = null;
        $row['max_karyawan'] = null;
        $row['skor_outsource'] = null;
        $row['max_outsource'] = null;
        $row['skor_besarangaji'] = null;
        $row['max_besarangaji'] = null;
        $row['skor_asuransi'] = null;
        $row['max_asuransi'] = null;
        $row['skor_bonus'] = null;
        $row['max_bonus'] = null;
        $row['skor_training'] = null;
        $row['max_training'] = null;
        $row['skor_sdm'] = null;
        $row['maxskor_sdm'] = null;
        $row['bobot_sdm'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_oms->FormValue == $this->skor_oms->CurrentValue && is_numeric(ConvertToFloatString($this->skor_oms->CurrentValue))) {
            $this->skor_oms->CurrentValue = ConvertToFloatString($this->skor_oms->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_oms->FormValue == $this->max_oms->CurrentValue && is_numeric(ConvertToFloatString($this->max_oms->CurrentValue))) {
            $this->max_oms->CurrentValue = ConvertToFloatString($this->max_oms->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_fokus->FormValue == $this->skor_fokus->CurrentValue && is_numeric(ConvertToFloatString($this->skor_fokus->CurrentValue))) {
            $this->skor_fokus->CurrentValue = ConvertToFloatString($this->skor_fokus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_fokus->FormValue == $this->max_fokus->CurrentValue && is_numeric(ConvertToFloatString($this->max_fokus->CurrentValue))) {
            $this->max_fokus->CurrentValue = ConvertToFloatString($this->max_fokus->CurrentValue);
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
        if ($this->skor_karyawan->FormValue == $this->skor_karyawan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_karyawan->CurrentValue))) {
            $this->skor_karyawan->CurrentValue = ConvertToFloatString($this->skor_karyawan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_karyawan->FormValue == $this->max_karyawan->CurrentValue && is_numeric(ConvertToFloatString($this->max_karyawan->CurrentValue))) {
            $this->max_karyawan->CurrentValue = ConvertToFloatString($this->max_karyawan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_outsource->FormValue == $this->skor_outsource->CurrentValue && is_numeric(ConvertToFloatString($this->skor_outsource->CurrentValue))) {
            $this->skor_outsource->CurrentValue = ConvertToFloatString($this->skor_outsource->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_outsource->FormValue == $this->max_outsource->CurrentValue && is_numeric(ConvertToFloatString($this->max_outsource->CurrentValue))) {
            $this->max_outsource->CurrentValue = ConvertToFloatString($this->max_outsource->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_besarangaji->FormValue == $this->skor_besarangaji->CurrentValue && is_numeric(ConvertToFloatString($this->skor_besarangaji->CurrentValue))) {
            $this->skor_besarangaji->CurrentValue = ConvertToFloatString($this->skor_besarangaji->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_besarangaji->FormValue == $this->max_besarangaji->CurrentValue && is_numeric(ConvertToFloatString($this->max_besarangaji->CurrentValue))) {
            $this->max_besarangaji->CurrentValue = ConvertToFloatString($this->max_besarangaji->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_asuransi->FormValue == $this->skor_asuransi->CurrentValue && is_numeric(ConvertToFloatString($this->skor_asuransi->CurrentValue))) {
            $this->skor_asuransi->CurrentValue = ConvertToFloatString($this->skor_asuransi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_asuransi->FormValue == $this->max_asuransi->CurrentValue && is_numeric(ConvertToFloatString($this->max_asuransi->CurrentValue))) {
            $this->max_asuransi->CurrentValue = ConvertToFloatString($this->max_asuransi->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_bonus->FormValue == $this->skor_bonus->CurrentValue && is_numeric(ConvertToFloatString($this->skor_bonus->CurrentValue))) {
            $this->skor_bonus->CurrentValue = ConvertToFloatString($this->skor_bonus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_bonus->FormValue == $this->max_bonus->CurrentValue && is_numeric(ConvertToFloatString($this->max_bonus->CurrentValue))) {
            $this->max_bonus->CurrentValue = ConvertToFloatString($this->max_bonus->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_training->FormValue == $this->skor_training->CurrentValue && is_numeric(ConvertToFloatString($this->skor_training->CurrentValue))) {
            $this->skor_training->CurrentValue = ConvertToFloatString($this->skor_training->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_training->FormValue == $this->max_training->CurrentValue && is_numeric(ConvertToFloatString($this->max_training->CurrentValue))) {
            $this->max_training->CurrentValue = ConvertToFloatString($this->max_training->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_sdm->FormValue == $this->skor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->skor_sdm->CurrentValue))) {
            $this->skor_sdm->CurrentValue = ConvertToFloatString($this->skor_sdm->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_sdm->FormValue == $this->maxskor_sdm->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_sdm->CurrentValue))) {
            $this->maxskor_sdm->CurrentValue = ConvertToFloatString($this->maxskor_sdm->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_oms

        // max_oms

        // skor_fokus

        // max_fokus

        // skor_target

        // max_target

        // skor_karyawan

        // max_karyawan

        // skor_outsource

        // max_outsource

        // skor_besarangaji

        // max_besarangaji

        // skor_asuransi

        // max_asuransi

        // skor_bonus

        // max_bonus

        // skor_training

        // max_training

        // skor_sdm

        // maxskor_sdm

        // bobot_sdm
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_oms
            $this->skor_oms->ViewValue = $this->skor_oms->CurrentValue;
            $this->skor_oms->ViewValue = FormatNumber($this->skor_oms->ViewValue, 2, -2, -2, -2);
            $this->skor_oms->ViewCustomAttributes = "";

            // max_oms
            $this->max_oms->ViewValue = $this->max_oms->CurrentValue;
            $this->max_oms->ViewValue = FormatNumber($this->max_oms->ViewValue, 2, -2, -2, -2);
            $this->max_oms->ViewCustomAttributes = "";

            // skor_fokus
            $this->skor_fokus->ViewValue = $this->skor_fokus->CurrentValue;
            $this->skor_fokus->ViewValue = FormatNumber($this->skor_fokus->ViewValue, 2, -2, -2, -2);
            $this->skor_fokus->ViewCustomAttributes = "";

            // max_fokus
            $this->max_fokus->ViewValue = $this->max_fokus->CurrentValue;
            $this->max_fokus->ViewValue = FormatNumber($this->max_fokus->ViewValue, 2, -2, -2, -2);
            $this->max_fokus->ViewCustomAttributes = "";

            // skor_target
            $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
            $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
            $this->skor_target->ViewCustomAttributes = "";

            // max_target
            $this->max_target->ViewValue = $this->max_target->CurrentValue;
            $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
            $this->max_target->ViewCustomAttributes = "";

            // skor_karyawan
            $this->skor_karyawan->ViewValue = $this->skor_karyawan->CurrentValue;
            $this->skor_karyawan->ViewValue = FormatNumber($this->skor_karyawan->ViewValue, 2, -2, -2, -2);
            $this->skor_karyawan->ViewCustomAttributes = "";

            // max_karyawan
            $this->max_karyawan->ViewValue = $this->max_karyawan->CurrentValue;
            $this->max_karyawan->ViewValue = FormatNumber($this->max_karyawan->ViewValue, 2, -2, -2, -2);
            $this->max_karyawan->ViewCustomAttributes = "";

            // skor_outsource
            $this->skor_outsource->ViewValue = $this->skor_outsource->CurrentValue;
            $this->skor_outsource->ViewValue = FormatNumber($this->skor_outsource->ViewValue, 2, -2, -2, -2);
            $this->skor_outsource->ViewCustomAttributes = "";

            // max_outsource
            $this->max_outsource->ViewValue = $this->max_outsource->CurrentValue;
            $this->max_outsource->ViewValue = FormatNumber($this->max_outsource->ViewValue, 2, -2, -2, -2);
            $this->max_outsource->ViewCustomAttributes = "";

            // skor_besarangaji
            $this->skor_besarangaji->ViewValue = $this->skor_besarangaji->CurrentValue;
            $this->skor_besarangaji->ViewValue = FormatNumber($this->skor_besarangaji->ViewValue, 2, -2, -2, -2);
            $this->skor_besarangaji->ViewCustomAttributes = "";

            // max_besarangaji
            $this->max_besarangaji->ViewValue = $this->max_besarangaji->CurrentValue;
            $this->max_besarangaji->ViewValue = FormatNumber($this->max_besarangaji->ViewValue, 2, -2, -2, -2);
            $this->max_besarangaji->ViewCustomAttributes = "";

            // skor_asuransi
            $this->skor_asuransi->ViewValue = $this->skor_asuransi->CurrentValue;
            $this->skor_asuransi->ViewValue = FormatNumber($this->skor_asuransi->ViewValue, 2, -2, -2, -2);
            $this->skor_asuransi->ViewCustomAttributes = "";

            // max_asuransi
            $this->max_asuransi->ViewValue = $this->max_asuransi->CurrentValue;
            $this->max_asuransi->ViewValue = FormatNumber($this->max_asuransi->ViewValue, 2, -2, -2, -2);
            $this->max_asuransi->ViewCustomAttributes = "";

            // skor_bonus
            $this->skor_bonus->ViewValue = $this->skor_bonus->CurrentValue;
            $this->skor_bonus->ViewValue = FormatNumber($this->skor_bonus->ViewValue, 2, -2, -2, -2);
            $this->skor_bonus->ViewCustomAttributes = "";

            // max_bonus
            $this->max_bonus->ViewValue = $this->max_bonus->CurrentValue;
            $this->max_bonus->ViewValue = FormatNumber($this->max_bonus->ViewValue, 2, -2, -2, -2);
            $this->max_bonus->ViewCustomAttributes = "";

            // skor_training
            $this->skor_training->ViewValue = $this->skor_training->CurrentValue;
            $this->skor_training->ViewValue = FormatNumber($this->skor_training->ViewValue, 2, -2, -2, -2);
            $this->skor_training->ViewCustomAttributes = "";

            // max_training
            $this->max_training->ViewValue = $this->max_training->CurrentValue;
            $this->max_training->ViewValue = FormatNumber($this->max_training->ViewValue, 2, -2, -2, -2);
            $this->max_training->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_oms
            $this->skor_oms->LinkCustomAttributes = "";
            $this->skor_oms->HrefValue = "";
            $this->skor_oms->TooltipValue = "";

            // max_oms
            $this->max_oms->LinkCustomAttributes = "";
            $this->max_oms->HrefValue = "";
            $this->max_oms->TooltipValue = "";

            // skor_fokus
            $this->skor_fokus->LinkCustomAttributes = "";
            $this->skor_fokus->HrefValue = "";
            $this->skor_fokus->TooltipValue = "";

            // max_fokus
            $this->max_fokus->LinkCustomAttributes = "";
            $this->max_fokus->HrefValue = "";
            $this->max_fokus->TooltipValue = "";

            // skor_target
            $this->skor_target->LinkCustomAttributes = "";
            $this->skor_target->HrefValue = "";
            $this->skor_target->TooltipValue = "";

            // max_target
            $this->max_target->LinkCustomAttributes = "";
            $this->max_target->HrefValue = "";
            $this->max_target->TooltipValue = "";

            // skor_karyawan
            $this->skor_karyawan->LinkCustomAttributes = "";
            $this->skor_karyawan->HrefValue = "";
            $this->skor_karyawan->TooltipValue = "";

            // max_karyawan
            $this->max_karyawan->LinkCustomAttributes = "";
            $this->max_karyawan->HrefValue = "";
            $this->max_karyawan->TooltipValue = "";

            // skor_outsource
            $this->skor_outsource->LinkCustomAttributes = "";
            $this->skor_outsource->HrefValue = "";
            $this->skor_outsource->TooltipValue = "";

            // max_outsource
            $this->max_outsource->LinkCustomAttributes = "";
            $this->max_outsource->HrefValue = "";
            $this->max_outsource->TooltipValue = "";

            // skor_besarangaji
            $this->skor_besarangaji->LinkCustomAttributes = "";
            $this->skor_besarangaji->HrefValue = "";
            $this->skor_besarangaji->TooltipValue = "";

            // max_besarangaji
            $this->max_besarangaji->LinkCustomAttributes = "";
            $this->max_besarangaji->HrefValue = "";
            $this->max_besarangaji->TooltipValue = "";

            // skor_asuransi
            $this->skor_asuransi->LinkCustomAttributes = "";
            $this->skor_asuransi->HrefValue = "";
            $this->skor_asuransi->TooltipValue = "";

            // max_asuransi
            $this->max_asuransi->LinkCustomAttributes = "";
            $this->max_asuransi->HrefValue = "";
            $this->max_asuransi->TooltipValue = "";

            // skor_bonus
            $this->skor_bonus->LinkCustomAttributes = "";
            $this->skor_bonus->HrefValue = "";
            $this->skor_bonus->TooltipValue = "";

            // max_bonus
            $this->max_bonus->LinkCustomAttributes = "";
            $this->max_bonus->HrefValue = "";
            $this->max_bonus->TooltipValue = "";

            // skor_training
            $this->skor_training->LinkCustomAttributes = "";
            $this->skor_training->HrefValue = "";
            $this->skor_training->TooltipValue = "";

            // max_training
            $this->max_training->LinkCustomAttributes = "";
            $this->max_training->HrefValue = "";
            $this->max_training->TooltipValue = "";

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorsdmlist"), "", $this->TableVar, true);
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
