<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorKelembagaanDelete extends TempSkorKelembagaan
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_kelembagaan';

    // Page object name
    public $PageObjName = "TempSkorKelembagaanDelete";

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

        // Table object (temp_skor_kelembagaan)
        if (!isset($GLOBALS["temp_skor_kelembagaan"]) || get_class($GLOBALS["temp_skor_kelembagaan"]) == PROJECT_NAMESPACE . "temp_skor_kelembagaan") {
            $GLOBALS["temp_skor_kelembagaan"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_kelembagaan');
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
                $doc = new $class(Container("temp_skor_kelembagaan"));
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
        $this->skor_badanhukum->setVisibility();
        $this->max_badanhukum->setVisibility();
        $this->skor_izin->setVisibility();
        $this->max_izin->setVisibility();
        $this->skor_npwp->setVisibility();
        $this->max_npwp->setVisibility();
        $this->skor_struktur->setVisibility();
        $this->max_struktur->setVisibility();
        $this->skor_jobdesk->setVisibility();
        $this->max_jobdesk->setVisibility();
        $this->skor_iso->setVisibility();
        $this->max_iso->setVisibility();
        $this->skor_kelembagaan->setVisibility();
        $this->maxskor_kelembagaan->setVisibility();
        $this->bobot_kelembagaan->setVisibility();
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
            $this->terminate("tempskorkelembagaanlist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorkelembagaanlist"); // Return to list
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
        $this->skor_badanhukum->setDbValue($row['skor_badanhukum']);
        $this->max_badanhukum->setDbValue($row['max_badanhukum']);
        $this->skor_izin->setDbValue($row['skor_izin']);
        $this->max_izin->setDbValue($row['max_izin']);
        $this->skor_npwp->setDbValue($row['skor_npwp']);
        $this->max_npwp->setDbValue($row['max_npwp']);
        $this->skor_struktur->setDbValue($row['skor_struktur']);
        $this->max_struktur->setDbValue($row['max_struktur']);
        $this->skor_jobdesk->setDbValue($row['skor_jobdesk']);
        $this->max_jobdesk->setDbValue($row['max_jobdesk']);
        $this->skor_iso->setDbValue($row['skor_iso']);
        $this->max_iso->setDbValue($row['max_iso']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['skor_badanhukum'] = null;
        $row['max_badanhukum'] = null;
        $row['skor_izin'] = null;
        $row['max_izin'] = null;
        $row['skor_npwp'] = null;
        $row['max_npwp'] = null;
        $row['skor_struktur'] = null;
        $row['max_struktur'] = null;
        $row['skor_jobdesk'] = null;
        $row['max_jobdesk'] = null;
        $row['skor_iso'] = null;
        $row['max_iso'] = null;
        $row['skor_kelembagaan'] = null;
        $row['maxskor_kelembagaan'] = null;
        $row['bobot_kelembagaan'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_badanhukum->FormValue == $this->skor_badanhukum->CurrentValue && is_numeric(ConvertToFloatString($this->skor_badanhukum->CurrentValue))) {
            $this->skor_badanhukum->CurrentValue = ConvertToFloatString($this->skor_badanhukum->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_badanhukum->FormValue == $this->max_badanhukum->CurrentValue && is_numeric(ConvertToFloatString($this->max_badanhukum->CurrentValue))) {
            $this->max_badanhukum->CurrentValue = ConvertToFloatString($this->max_badanhukum->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_izin->FormValue == $this->skor_izin->CurrentValue && is_numeric(ConvertToFloatString($this->skor_izin->CurrentValue))) {
            $this->skor_izin->CurrentValue = ConvertToFloatString($this->skor_izin->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_izin->FormValue == $this->max_izin->CurrentValue && is_numeric(ConvertToFloatString($this->max_izin->CurrentValue))) {
            $this->max_izin->CurrentValue = ConvertToFloatString($this->max_izin->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_npwp->FormValue == $this->skor_npwp->CurrentValue && is_numeric(ConvertToFloatString($this->skor_npwp->CurrentValue))) {
            $this->skor_npwp->CurrentValue = ConvertToFloatString($this->skor_npwp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_npwp->FormValue == $this->max_npwp->CurrentValue && is_numeric(ConvertToFloatString($this->max_npwp->CurrentValue))) {
            $this->max_npwp->CurrentValue = ConvertToFloatString($this->max_npwp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_struktur->FormValue == $this->skor_struktur->CurrentValue && is_numeric(ConvertToFloatString($this->skor_struktur->CurrentValue))) {
            $this->skor_struktur->CurrentValue = ConvertToFloatString($this->skor_struktur->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_struktur->FormValue == $this->max_struktur->CurrentValue && is_numeric(ConvertToFloatString($this->max_struktur->CurrentValue))) {
            $this->max_struktur->CurrentValue = ConvertToFloatString($this->max_struktur->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_jobdesk->FormValue == $this->skor_jobdesk->CurrentValue && is_numeric(ConvertToFloatString($this->skor_jobdesk->CurrentValue))) {
            $this->skor_jobdesk->CurrentValue = ConvertToFloatString($this->skor_jobdesk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_jobdesk->FormValue == $this->max_jobdesk->CurrentValue && is_numeric(ConvertToFloatString($this->max_jobdesk->CurrentValue))) {
            $this->max_jobdesk->CurrentValue = ConvertToFloatString($this->max_jobdesk->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_iso->FormValue == $this->skor_iso->CurrentValue && is_numeric(ConvertToFloatString($this->skor_iso->CurrentValue))) {
            $this->skor_iso->CurrentValue = ConvertToFloatString($this->skor_iso->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_iso->FormValue == $this->max_iso->CurrentValue && is_numeric(ConvertToFloatString($this->max_iso->CurrentValue))) {
            $this->max_iso->CurrentValue = ConvertToFloatString($this->max_iso->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_kelembagaan->FormValue == $this->skor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_kelembagaan->CurrentValue))) {
            $this->skor_kelembagaan->CurrentValue = ConvertToFloatString($this->skor_kelembagaan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_kelembagaan->FormValue == $this->maxskor_kelembagaan->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue))) {
            $this->maxskor_kelembagaan->CurrentValue = ConvertToFloatString($this->maxskor_kelembagaan->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // skor_badanhukum

        // max_badanhukum

        // skor_izin

        // max_izin

        // skor_npwp

        // max_npwp

        // skor_struktur

        // max_struktur

        // skor_jobdesk

        // max_jobdesk

        // skor_iso

        // max_iso

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // skor_badanhukum
            $this->skor_badanhukum->ViewValue = $this->skor_badanhukum->CurrentValue;
            $this->skor_badanhukum->ViewValue = FormatNumber($this->skor_badanhukum->ViewValue, 2, -2, -2, -2);
            $this->skor_badanhukum->ViewCustomAttributes = "";

            // max_badanhukum
            $this->max_badanhukum->ViewValue = $this->max_badanhukum->CurrentValue;
            $this->max_badanhukum->ViewValue = FormatNumber($this->max_badanhukum->ViewValue, 2, -2, -2, -2);
            $this->max_badanhukum->ViewCustomAttributes = "";

            // skor_izin
            $this->skor_izin->ViewValue = $this->skor_izin->CurrentValue;
            $this->skor_izin->ViewValue = FormatNumber($this->skor_izin->ViewValue, 2, -2, -2, -2);
            $this->skor_izin->ViewCustomAttributes = "";

            // max_izin
            $this->max_izin->ViewValue = $this->max_izin->CurrentValue;
            $this->max_izin->ViewValue = FormatNumber($this->max_izin->ViewValue, 2, -2, -2, -2);
            $this->max_izin->ViewCustomAttributes = "";

            // skor_npwp
            $this->skor_npwp->ViewValue = $this->skor_npwp->CurrentValue;
            $this->skor_npwp->ViewValue = FormatNumber($this->skor_npwp->ViewValue, 2, -2, -2, -2);
            $this->skor_npwp->ViewCustomAttributes = "";

            // max_npwp
            $this->max_npwp->ViewValue = $this->max_npwp->CurrentValue;
            $this->max_npwp->ViewValue = FormatNumber($this->max_npwp->ViewValue, 2, -2, -2, -2);
            $this->max_npwp->ViewCustomAttributes = "";

            // skor_struktur
            $this->skor_struktur->ViewValue = $this->skor_struktur->CurrentValue;
            $this->skor_struktur->ViewValue = FormatNumber($this->skor_struktur->ViewValue, 2, -2, -2, -2);
            $this->skor_struktur->ViewCustomAttributes = "";

            // max_struktur
            $this->max_struktur->ViewValue = $this->max_struktur->CurrentValue;
            $this->max_struktur->ViewValue = FormatNumber($this->max_struktur->ViewValue, 2, -2, -2, -2);
            $this->max_struktur->ViewCustomAttributes = "";

            // skor_jobdesk
            $this->skor_jobdesk->ViewValue = $this->skor_jobdesk->CurrentValue;
            $this->skor_jobdesk->ViewValue = FormatNumber($this->skor_jobdesk->ViewValue, 2, -2, -2, -2);
            $this->skor_jobdesk->ViewCustomAttributes = "";

            // max_jobdesk
            $this->max_jobdesk->ViewValue = $this->max_jobdesk->CurrentValue;
            $this->max_jobdesk->ViewValue = FormatNumber($this->max_jobdesk->ViewValue, 2, -2, -2, -2);
            $this->max_jobdesk->ViewCustomAttributes = "";

            // skor_iso
            $this->skor_iso->ViewValue = $this->skor_iso->CurrentValue;
            $this->skor_iso->ViewValue = FormatNumber($this->skor_iso->ViewValue, 2, -2, -2, -2);
            $this->skor_iso->ViewCustomAttributes = "";

            // max_iso
            $this->max_iso->ViewValue = $this->max_iso->CurrentValue;
            $this->max_iso->ViewValue = FormatNumber($this->max_iso->ViewValue, 2, -2, -2, -2);
            $this->max_iso->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // skor_badanhukum
            $this->skor_badanhukum->LinkCustomAttributes = "";
            $this->skor_badanhukum->HrefValue = "";
            $this->skor_badanhukum->TooltipValue = "";

            // max_badanhukum
            $this->max_badanhukum->LinkCustomAttributes = "";
            $this->max_badanhukum->HrefValue = "";
            $this->max_badanhukum->TooltipValue = "";

            // skor_izin
            $this->skor_izin->LinkCustomAttributes = "";
            $this->skor_izin->HrefValue = "";
            $this->skor_izin->TooltipValue = "";

            // max_izin
            $this->max_izin->LinkCustomAttributes = "";
            $this->max_izin->HrefValue = "";
            $this->max_izin->TooltipValue = "";

            // skor_npwp
            $this->skor_npwp->LinkCustomAttributes = "";
            $this->skor_npwp->HrefValue = "";
            $this->skor_npwp->TooltipValue = "";

            // max_npwp
            $this->max_npwp->LinkCustomAttributes = "";
            $this->max_npwp->HrefValue = "";
            $this->max_npwp->TooltipValue = "";

            // skor_struktur
            $this->skor_struktur->LinkCustomAttributes = "";
            $this->skor_struktur->HrefValue = "";
            $this->skor_struktur->TooltipValue = "";

            // max_struktur
            $this->max_struktur->LinkCustomAttributes = "";
            $this->max_struktur->HrefValue = "";
            $this->max_struktur->TooltipValue = "";

            // skor_jobdesk
            $this->skor_jobdesk->LinkCustomAttributes = "";
            $this->skor_jobdesk->HrefValue = "";
            $this->skor_jobdesk->TooltipValue = "";

            // max_jobdesk
            $this->max_jobdesk->LinkCustomAttributes = "";
            $this->max_jobdesk->HrefValue = "";
            $this->max_jobdesk->TooltipValue = "";

            // skor_iso
            $this->skor_iso->LinkCustomAttributes = "";
            $this->skor_iso->HrefValue = "";
            $this->skor_iso->TooltipValue = "";

            // max_iso
            $this->max_iso->LinkCustomAttributes = "";
            $this->max_iso->HrefValue = "";
            $this->max_iso->TooltipValue = "";

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorkelembagaanlist"), "", $this->TableVar, true);
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
