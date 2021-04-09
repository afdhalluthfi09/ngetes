<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Page class
 */
class TempSkorPemasaranonlineDelete extends TempSkorPemasaranonline
{
    use MessagesTrait;

    // Page ID
    public $PageID = "delete";

    // Project ID
    public $ProjectID = PROJECT_ID;

    // Table name
    public $TableName = 'temp_skor_pemasaranonline';

    // Page object name
    public $PageObjName = "TempSkorPemasaranonlineDelete";

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

        // Table object (temp_skor_pemasaranonline)
        if (!isset($GLOBALS["temp_skor_pemasaranonline"]) || get_class($GLOBALS["temp_skor_pemasaranonline"]) == PROJECT_NAMESPACE . "temp_skor_pemasaranonline") {
            $GLOBALS["temp_skor_pemasaranonline"] = &$this;
        }

        // Page URL
        $pageUrl = $this->pageUrl();

        // Table name (for backward compatibility only)
        if (!defined(PROJECT_NAMESPACE . "TABLE_NAME")) {
            define(PROJECT_NAMESPACE . "TABLE_NAME", 'temp_skor_pemasaranonline');
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
                $doc = new $class(Container("temp_skor_pemasaranonline"));
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
        $this->chatting->setVisibility();
        $this->skor_chatting->setVisibility();
        $this->max_chatting->setVisibility();
        $this->medsos->setVisibility();
        $this->skor_medsos->setVisibility();
        $this->max_medsos->setVisibility();
        $this->marketplace->setVisibility();
        $this->skor_mp->setVisibility();
        $this->max_mp->setVisibility();
        $this->gmb->setVisibility();
        $this->skor_gmb->setVisibility();
        $this->max_gmb->setVisibility();
        $this->web->setVisibility();
        $this->skor_web->setVisibility();
        $this->max_web->setVisibility();
        $this->updatemedsos->setVisibility();
        $this->skor_updatemedsos->setVisibility();
        $this->max_updatemedsos->setVisibility();
        $this->updateweb->setVisibility();
        $this->skor_updateweb->setVisibility();
        $this->max_updateweb->setVisibility();
        $this->seo->setVisibility();
        $this->skor_seo->setVisibility();
        $this->max_seo->setVisibility();
        $this->iklan->setVisibility();
        $this->skor_iklan->setVisibility();
        $this->max_iklan->setVisibility();
        $this->skor_pemasaranonline->setVisibility();
        $this->maxskor_pemasaranonline->setVisibility();
        $this->bobot_pemasaranonline->setVisibility();
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
            $this->terminate("tempskorpemasaranonlinelist"); // Prevent SQL injection, return to list
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
                $this->terminate("tempskorpemasaranonlinelist"); // Return to list
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
        $this->chatting->setDbValue($row['chatting']);
        $this->skor_chatting->setDbValue($row['skor_chatting']);
        $this->max_chatting->setDbValue($row['max_chatting']);
        $this->medsos->setDbValue($row['medsos']);
        $this->skor_medsos->setDbValue($row['skor_medsos']);
        $this->max_medsos->setDbValue($row['max_medsos']);
        $this->marketplace->setDbValue($row['marketplace']);
        $this->skor_mp->setDbValue($row['skor_mp']);
        $this->max_mp->setDbValue($row['max_mp']);
        $this->gmb->setDbValue($row['gmb']);
        $this->skor_gmb->setDbValue($row['skor_gmb']);
        $this->max_gmb->setDbValue($row['max_gmb']);
        $this->web->setDbValue($row['web']);
        $this->skor_web->setDbValue($row['skor_web']);
        $this->max_web->setDbValue($row['max_web']);
        $this->updatemedsos->setDbValue($row['updatemedsos']);
        $this->skor_updatemedsos->setDbValue($row['skor_updatemedsos']);
        $this->max_updatemedsos->setDbValue($row['max_updatemedsos']);
        $this->updateweb->setDbValue($row['updateweb']);
        $this->skor_updateweb->setDbValue($row['skor_updateweb']);
        $this->max_updateweb->setDbValue($row['max_updateweb']);
        $this->seo->setDbValue($row['seo']);
        $this->skor_seo->setDbValue($row['skor_seo']);
        $this->max_seo->setDbValue($row['max_seo']);
        $this->iklan->setDbValue($row['iklan']);
        $this->skor_iklan->setDbValue($row['skor_iklan']);
        $this->max_iklan->setDbValue($row['max_iklan']);
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
    }

    // Return a row with default values
    protected function newRow()
    {
        $row = [];
        $row['nik'] = null;
        $row['chatting'] = null;
        $row['skor_chatting'] = null;
        $row['max_chatting'] = null;
        $row['medsos'] = null;
        $row['skor_medsos'] = null;
        $row['max_medsos'] = null;
        $row['marketplace'] = null;
        $row['skor_mp'] = null;
        $row['max_mp'] = null;
        $row['gmb'] = null;
        $row['skor_gmb'] = null;
        $row['max_gmb'] = null;
        $row['web'] = null;
        $row['skor_web'] = null;
        $row['max_web'] = null;
        $row['updatemedsos'] = null;
        $row['skor_updatemedsos'] = null;
        $row['max_updatemedsos'] = null;
        $row['updateweb'] = null;
        $row['skor_updateweb'] = null;
        $row['max_updateweb'] = null;
        $row['seo'] = null;
        $row['skor_seo'] = null;
        $row['max_seo'] = null;
        $row['iklan'] = null;
        $row['skor_iklan'] = null;
        $row['max_iklan'] = null;
        $row['skor_pemasaranonline'] = null;
        $row['maxskor_pemasaranonline'] = null;
        $row['bobot_pemasaranonline'] = null;
        return $row;
    }

    // Render row values based on field settings
    public function renderRow()
    {
        global $Security, $Language, $CurrentLanguage;

        // Initialize URLs

        // Convert decimal values if posted back
        if ($this->skor_chatting->FormValue == $this->skor_chatting->CurrentValue && is_numeric(ConvertToFloatString($this->skor_chatting->CurrentValue))) {
            $this->skor_chatting->CurrentValue = ConvertToFloatString($this->skor_chatting->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_chatting->FormValue == $this->max_chatting->CurrentValue && is_numeric(ConvertToFloatString($this->max_chatting->CurrentValue))) {
            $this->max_chatting->CurrentValue = ConvertToFloatString($this->max_chatting->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_medsos->FormValue == $this->skor_medsos->CurrentValue && is_numeric(ConvertToFloatString($this->skor_medsos->CurrentValue))) {
            $this->skor_medsos->CurrentValue = ConvertToFloatString($this->skor_medsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_medsos->FormValue == $this->max_medsos->CurrentValue && is_numeric(ConvertToFloatString($this->max_medsos->CurrentValue))) {
            $this->max_medsos->CurrentValue = ConvertToFloatString($this->max_medsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_mp->FormValue == $this->skor_mp->CurrentValue && is_numeric(ConvertToFloatString($this->skor_mp->CurrentValue))) {
            $this->skor_mp->CurrentValue = ConvertToFloatString($this->skor_mp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_mp->FormValue == $this->max_mp->CurrentValue && is_numeric(ConvertToFloatString($this->max_mp->CurrentValue))) {
            $this->max_mp->CurrentValue = ConvertToFloatString($this->max_mp->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_gmb->FormValue == $this->skor_gmb->CurrentValue && is_numeric(ConvertToFloatString($this->skor_gmb->CurrentValue))) {
            $this->skor_gmb->CurrentValue = ConvertToFloatString($this->skor_gmb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_gmb->FormValue == $this->max_gmb->CurrentValue && is_numeric(ConvertToFloatString($this->max_gmb->CurrentValue))) {
            $this->max_gmb->CurrentValue = ConvertToFloatString($this->max_gmb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_web->FormValue == $this->skor_web->CurrentValue && is_numeric(ConvertToFloatString($this->skor_web->CurrentValue))) {
            $this->skor_web->CurrentValue = ConvertToFloatString($this->skor_web->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_web->FormValue == $this->max_web->CurrentValue && is_numeric(ConvertToFloatString($this->max_web->CurrentValue))) {
            $this->max_web->CurrentValue = ConvertToFloatString($this->max_web->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_updatemedsos->FormValue == $this->skor_updatemedsos->CurrentValue && is_numeric(ConvertToFloatString($this->skor_updatemedsos->CurrentValue))) {
            $this->skor_updatemedsos->CurrentValue = ConvertToFloatString($this->skor_updatemedsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_updatemedsos->FormValue == $this->max_updatemedsos->CurrentValue && is_numeric(ConvertToFloatString($this->max_updatemedsos->CurrentValue))) {
            $this->max_updatemedsos->CurrentValue = ConvertToFloatString($this->max_updatemedsos->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_updateweb->FormValue == $this->skor_updateweb->CurrentValue && is_numeric(ConvertToFloatString($this->skor_updateweb->CurrentValue))) {
            $this->skor_updateweb->CurrentValue = ConvertToFloatString($this->skor_updateweb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_updateweb->FormValue == $this->max_updateweb->CurrentValue && is_numeric(ConvertToFloatString($this->max_updateweb->CurrentValue))) {
            $this->max_updateweb->CurrentValue = ConvertToFloatString($this->max_updateweb->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_seo->FormValue == $this->skor_seo->CurrentValue && is_numeric(ConvertToFloatString($this->skor_seo->CurrentValue))) {
            $this->skor_seo->CurrentValue = ConvertToFloatString($this->skor_seo->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_seo->FormValue == $this->max_seo->CurrentValue && is_numeric(ConvertToFloatString($this->max_seo->CurrentValue))) {
            $this->max_seo->CurrentValue = ConvertToFloatString($this->max_seo->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_iklan->FormValue == $this->skor_iklan->CurrentValue && is_numeric(ConvertToFloatString($this->skor_iklan->CurrentValue))) {
            $this->skor_iklan->CurrentValue = ConvertToFloatString($this->skor_iklan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->max_iklan->FormValue == $this->max_iklan->CurrentValue && is_numeric(ConvertToFloatString($this->max_iklan->CurrentValue))) {
            $this->max_iklan->CurrentValue = ConvertToFloatString($this->max_iklan->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->skor_pemasaranonline->FormValue == $this->skor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->skor_pemasaranonline->CurrentValue))) {
            $this->skor_pemasaranonline->CurrentValue = ConvertToFloatString($this->skor_pemasaranonline->CurrentValue);
        }

        // Convert decimal values if posted back
        if ($this->maxskor_pemasaranonline->FormValue == $this->maxskor_pemasaranonline->CurrentValue && is_numeric(ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue))) {
            $this->maxskor_pemasaranonline->CurrentValue = ConvertToFloatString($this->maxskor_pemasaranonline->CurrentValue);
        }

        // Call Row_Rendering event
        $this->rowRendering();

        // Common render codes for all row types

        // nik

        // chatting

        // skor_chatting

        // max_chatting

        // medsos

        // skor_medsos

        // max_medsos

        // marketplace

        // skor_mp

        // max_mp

        // gmb

        // skor_gmb

        // max_gmb

        // web

        // skor_web

        // max_web

        // updatemedsos

        // skor_updatemedsos

        // max_updatemedsos

        // updateweb

        // skor_updateweb

        // max_updateweb

        // seo

        // skor_seo

        // max_seo

        // iklan

        // skor_iklan

        // max_iklan

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline
        if ($this->RowType == ROWTYPE_VIEW) {
            // nik
            $this->nik->ViewValue = $this->nik->CurrentValue;
            $this->nik->ViewCustomAttributes = "";

            // chatting
            $this->chatting->ViewValue = $this->chatting->CurrentValue;
            $this->chatting->ViewCustomAttributes = "";

            // skor_chatting
            $this->skor_chatting->ViewValue = $this->skor_chatting->CurrentValue;
            $this->skor_chatting->ViewValue = FormatNumber($this->skor_chatting->ViewValue, 2, -2, -2, -2);
            $this->skor_chatting->ViewCustomAttributes = "";

            // max_chatting
            $this->max_chatting->ViewValue = $this->max_chatting->CurrentValue;
            $this->max_chatting->ViewValue = FormatNumber($this->max_chatting->ViewValue, 2, -2, -2, -2);
            $this->max_chatting->ViewCustomAttributes = "";

            // medsos
            $this->medsos->ViewValue = $this->medsos->CurrentValue;
            $this->medsos->ViewCustomAttributes = "";

            // skor_medsos
            $this->skor_medsos->ViewValue = $this->skor_medsos->CurrentValue;
            $this->skor_medsos->ViewValue = FormatNumber($this->skor_medsos->ViewValue, 2, -2, -2, -2);
            $this->skor_medsos->ViewCustomAttributes = "";

            // max_medsos
            $this->max_medsos->ViewValue = $this->max_medsos->CurrentValue;
            $this->max_medsos->ViewValue = FormatNumber($this->max_medsos->ViewValue, 2, -2, -2, -2);
            $this->max_medsos->ViewCustomAttributes = "";

            // marketplace
            $this->marketplace->ViewValue = $this->marketplace->CurrentValue;
            $this->marketplace->ViewCustomAttributes = "";

            // skor_mp
            $this->skor_mp->ViewValue = $this->skor_mp->CurrentValue;
            $this->skor_mp->ViewValue = FormatNumber($this->skor_mp->ViewValue, 2, -2, -2, -2);
            $this->skor_mp->ViewCustomAttributes = "";

            // max_mp
            $this->max_mp->ViewValue = $this->max_mp->CurrentValue;
            $this->max_mp->ViewValue = FormatNumber($this->max_mp->ViewValue, 2, -2, -2, -2);
            $this->max_mp->ViewCustomAttributes = "";

            // gmb
            $this->gmb->ViewValue = $this->gmb->CurrentValue;
            $this->gmb->ViewCustomAttributes = "";

            // skor_gmb
            $this->skor_gmb->ViewValue = $this->skor_gmb->CurrentValue;
            $this->skor_gmb->ViewValue = FormatNumber($this->skor_gmb->ViewValue, 2, -2, -2, -2);
            $this->skor_gmb->ViewCustomAttributes = "";

            // max_gmb
            $this->max_gmb->ViewValue = $this->max_gmb->CurrentValue;
            $this->max_gmb->ViewValue = FormatNumber($this->max_gmb->ViewValue, 2, -2, -2, -2);
            $this->max_gmb->ViewCustomAttributes = "";

            // web
            $this->web->ViewValue = $this->web->CurrentValue;
            $this->web->ViewCustomAttributes = "";

            // skor_web
            $this->skor_web->ViewValue = $this->skor_web->CurrentValue;
            $this->skor_web->ViewValue = FormatNumber($this->skor_web->ViewValue, 2, -2, -2, -2);
            $this->skor_web->ViewCustomAttributes = "";

            // max_web
            $this->max_web->ViewValue = $this->max_web->CurrentValue;
            $this->max_web->ViewValue = FormatNumber($this->max_web->ViewValue, 2, -2, -2, -2);
            $this->max_web->ViewCustomAttributes = "";

            // updatemedsos
            $this->updatemedsos->ViewValue = $this->updatemedsos->CurrentValue;
            $this->updatemedsos->ViewCustomAttributes = "";

            // skor_updatemedsos
            $this->skor_updatemedsos->ViewValue = $this->skor_updatemedsos->CurrentValue;
            $this->skor_updatemedsos->ViewValue = FormatNumber($this->skor_updatemedsos->ViewValue, 2, -2, -2, -2);
            $this->skor_updatemedsos->ViewCustomAttributes = "";

            // max_updatemedsos
            $this->max_updatemedsos->ViewValue = $this->max_updatemedsos->CurrentValue;
            $this->max_updatemedsos->ViewValue = FormatNumber($this->max_updatemedsos->ViewValue, 2, -2, -2, -2);
            $this->max_updatemedsos->ViewCustomAttributes = "";

            // updateweb
            $this->updateweb->ViewValue = $this->updateweb->CurrentValue;
            $this->updateweb->ViewCustomAttributes = "";

            // skor_updateweb
            $this->skor_updateweb->ViewValue = $this->skor_updateweb->CurrentValue;
            $this->skor_updateweb->ViewValue = FormatNumber($this->skor_updateweb->ViewValue, 2, -2, -2, -2);
            $this->skor_updateweb->ViewCustomAttributes = "";

            // max_updateweb
            $this->max_updateweb->ViewValue = $this->max_updateweb->CurrentValue;
            $this->max_updateweb->ViewValue = FormatNumber($this->max_updateweb->ViewValue, 2, -2, -2, -2);
            $this->max_updateweb->ViewCustomAttributes = "";

            // seo
            $this->seo->ViewValue = $this->seo->CurrentValue;
            $this->seo->ViewCustomAttributes = "";

            // skor_seo
            $this->skor_seo->ViewValue = $this->skor_seo->CurrentValue;
            $this->skor_seo->ViewValue = FormatNumber($this->skor_seo->ViewValue, 2, -2, -2, -2);
            $this->skor_seo->ViewCustomAttributes = "";

            // max_seo
            $this->max_seo->ViewValue = $this->max_seo->CurrentValue;
            $this->max_seo->ViewValue = FormatNumber($this->max_seo->ViewValue, 2, -2, -2, -2);
            $this->max_seo->ViewCustomAttributes = "";

            // iklan
            $this->iklan->ViewValue = $this->iklan->CurrentValue;
            $this->iklan->ViewCustomAttributes = "";

            // skor_iklan
            $this->skor_iklan->ViewValue = $this->skor_iklan->CurrentValue;
            $this->skor_iklan->ViewValue = FormatNumber($this->skor_iklan->ViewValue, 2, -2, -2, -2);
            $this->skor_iklan->ViewCustomAttributes = "";

            // max_iklan
            $this->max_iklan->ViewValue = $this->max_iklan->CurrentValue;
            $this->max_iklan->ViewValue = FormatNumber($this->max_iklan->ViewValue, 2, -2, -2, -2);
            $this->max_iklan->ViewCustomAttributes = "";

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

            // nik
            $this->nik->LinkCustomAttributes = "";
            $this->nik->HrefValue = "";
            $this->nik->TooltipValue = "";

            // chatting
            $this->chatting->LinkCustomAttributes = "";
            $this->chatting->HrefValue = "";
            $this->chatting->TooltipValue = "";

            // skor_chatting
            $this->skor_chatting->LinkCustomAttributes = "";
            $this->skor_chatting->HrefValue = "";
            $this->skor_chatting->TooltipValue = "";

            // max_chatting
            $this->max_chatting->LinkCustomAttributes = "";
            $this->max_chatting->HrefValue = "";
            $this->max_chatting->TooltipValue = "";

            // medsos
            $this->medsos->LinkCustomAttributes = "";
            $this->medsos->HrefValue = "";
            $this->medsos->TooltipValue = "";

            // skor_medsos
            $this->skor_medsos->LinkCustomAttributes = "";
            $this->skor_medsos->HrefValue = "";
            $this->skor_medsos->TooltipValue = "";

            // max_medsos
            $this->max_medsos->LinkCustomAttributes = "";
            $this->max_medsos->HrefValue = "";
            $this->max_medsos->TooltipValue = "";

            // marketplace
            $this->marketplace->LinkCustomAttributes = "";
            $this->marketplace->HrefValue = "";
            $this->marketplace->TooltipValue = "";

            // skor_mp
            $this->skor_mp->LinkCustomAttributes = "";
            $this->skor_mp->HrefValue = "";
            $this->skor_mp->TooltipValue = "";

            // max_mp
            $this->max_mp->LinkCustomAttributes = "";
            $this->max_mp->HrefValue = "";
            $this->max_mp->TooltipValue = "";

            // gmb
            $this->gmb->LinkCustomAttributes = "";
            $this->gmb->HrefValue = "";
            $this->gmb->TooltipValue = "";

            // skor_gmb
            $this->skor_gmb->LinkCustomAttributes = "";
            $this->skor_gmb->HrefValue = "";
            $this->skor_gmb->TooltipValue = "";

            // max_gmb
            $this->max_gmb->LinkCustomAttributes = "";
            $this->max_gmb->HrefValue = "";
            $this->max_gmb->TooltipValue = "";

            // web
            $this->web->LinkCustomAttributes = "";
            $this->web->HrefValue = "";
            $this->web->TooltipValue = "";

            // skor_web
            $this->skor_web->LinkCustomAttributes = "";
            $this->skor_web->HrefValue = "";
            $this->skor_web->TooltipValue = "";

            // max_web
            $this->max_web->LinkCustomAttributes = "";
            $this->max_web->HrefValue = "";
            $this->max_web->TooltipValue = "";

            // updatemedsos
            $this->updatemedsos->LinkCustomAttributes = "";
            $this->updatemedsos->HrefValue = "";
            $this->updatemedsos->TooltipValue = "";

            // skor_updatemedsos
            $this->skor_updatemedsos->LinkCustomAttributes = "";
            $this->skor_updatemedsos->HrefValue = "";
            $this->skor_updatemedsos->TooltipValue = "";

            // max_updatemedsos
            $this->max_updatemedsos->LinkCustomAttributes = "";
            $this->max_updatemedsos->HrefValue = "";
            $this->max_updatemedsos->TooltipValue = "";

            // updateweb
            $this->updateweb->LinkCustomAttributes = "";
            $this->updateweb->HrefValue = "";
            $this->updateweb->TooltipValue = "";

            // skor_updateweb
            $this->skor_updateweb->LinkCustomAttributes = "";
            $this->skor_updateweb->HrefValue = "";
            $this->skor_updateweb->TooltipValue = "";

            // max_updateweb
            $this->max_updateweb->LinkCustomAttributes = "";
            $this->max_updateweb->HrefValue = "";
            $this->max_updateweb->TooltipValue = "";

            // seo
            $this->seo->LinkCustomAttributes = "";
            $this->seo->HrefValue = "";
            $this->seo->TooltipValue = "";

            // skor_seo
            $this->skor_seo->LinkCustomAttributes = "";
            $this->skor_seo->HrefValue = "";
            $this->skor_seo->TooltipValue = "";

            // max_seo
            $this->max_seo->LinkCustomAttributes = "";
            $this->max_seo->HrefValue = "";
            $this->max_seo->TooltipValue = "";

            // iklan
            $this->iklan->LinkCustomAttributes = "";
            $this->iklan->HrefValue = "";
            $this->iklan->TooltipValue = "";

            // skor_iklan
            $this->skor_iklan->LinkCustomAttributes = "";
            $this->skor_iklan->HrefValue = "";
            $this->skor_iklan->TooltipValue = "";

            // max_iklan
            $this->max_iklan->LinkCustomAttributes = "";
            $this->max_iklan->HrefValue = "";
            $this->max_iklan->TooltipValue = "";

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
        $Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("tempskorpemasaranonlinelist"), "", $this->TableVar, true);
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
