<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for v_data_usaha
 */
class VDataUsaha extends DbTable
{
    protected $SqlFrom = "";
    protected $SqlSelect = null;
    protected $SqlSelectList = null;
    protected $SqlWhere = "";
    protected $SqlGroupBy = "";
    protected $SqlHaving = "";
    protected $SqlOrderBy = "";
    public $UseSessionForListSql = true;

    // Column CSS classes
    public $LeftColumnClass = "col-sm-2 col-form-label ew-label";
    public $RightColumnClass = "col-sm-10";
    public $OffsetColumnClass = "col-sm-10 offset-sm-2";
    public $TableLeftColumnClass = "w-col-2";

    // Export
    public $ExportDoc;

    // Fields
    public $kapanewon;
    public $jumlah_Usaha;
    public $tenaga_kerja_lakilaki;
    public $Tenaga_Kerja_Perempuan;
    public $omset_pertahun;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_data_usaha';
        $this->TableName = 'v_data_usaha';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_data_usaha`";
        $this->Dbid = 'DB';
        $this->ExportAll = true;
        $this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
        $this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
        $this->ExportPageSize = "a4"; // Page size (PDF only)
        $this->ExportExcelPageOrientation = ""; // Page orientation (PhpSpreadsheet only)
        $this->ExportExcelPageSize = ""; // Page size (PhpSpreadsheet only)
        $this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
        $this->ExportWordColumnWidth = null; // Cell width (PHPWord only)
        $this->DetailAdd = false; // Allow detail add
        $this->DetailEdit = false; // Allow detail edit
        $this->DetailView = false; // Allow detail view
        $this->ShowMultipleDetails = false; // Show multiple details
        $this->GridAddRowCount = 5;
        $this->AllowAddDeleteRow = true; // Allow add/delete row
        $this->UserIDAllowSecurity = Config("DEFAULT_USER_ID_ALLOW_SECURITY"); // Default User ID allowed permissions
        $this->BasicSearch = new BasicSearch($this->TableVar);

        // kapanewon
        $this->kapanewon = new DbField('v_data_usaha', 'v_data_usaha', 'x_kapanewon', 'kapanewon', '`kapanewon`', '`kapanewon`', 200, 255, -1, false, '`kapanewon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapanewon->Nullable = false; // NOT NULL field
        $this->kapanewon->Required = true; // Required field
        $this->kapanewon->Sortable = true; // Allow sort
        $this->kapanewon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapanewon->Param, "CustomMsg");
        $this->Fields['kapanewon'] = &$this->kapanewon;

        // jumlah Usaha
        $this->jumlah_Usaha = new DbField('v_data_usaha', 'v_data_usaha', 'x_jumlah_Usaha', 'jumlah Usaha', '`jumlah Usaha`', '`jumlah Usaha`', 20, 21, -1, false, '`jumlah Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_Usaha->Nullable = false; // NOT NULL field
        $this->jumlah_Usaha->Sortable = true; // Allow sort
        $this->jumlah_Usaha->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jumlah_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_Usaha->Param, "CustomMsg");
        $this->Fields['jumlah Usaha'] = &$this->jumlah_Usaha;

        // tenaga kerja laki-laki
        $this->tenaga_kerja_lakilaki = new DbField('v_data_usaha', 'v_data_usaha', 'x_tenaga_kerja_lakilaki', 'tenaga kerja laki-laki', '`tenaga kerja laki-laki`', '`tenaga kerja laki-laki`', 131, 25, -1, false, '`tenaga kerja laki-laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tenaga_kerja_lakilaki->Sortable = true; // Allow sort
        $this->tenaga_kerja_lakilaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->tenaga_kerja_lakilaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->tenaga_kerja_lakilaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tenaga_kerja_lakilaki->Param, "CustomMsg");
        $this->Fields['tenaga kerja laki-laki'] = &$this->tenaga_kerja_lakilaki;

        // Tenaga Kerja Perempuan
        $this->Tenaga_Kerja_Perempuan = new DbField('v_data_usaha', 'v_data_usaha', 'x_Tenaga_Kerja_Perempuan', 'Tenaga Kerja Perempuan', '`Tenaga Kerja Perempuan`', '`Tenaga Kerja Perempuan`', 131, 25, -1, false, '`Tenaga Kerja Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tenaga_Kerja_Perempuan->Sortable = true; // Allow sort
        $this->Tenaga_Kerja_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Tenaga_Kerja_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Tenaga_Kerja_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tenaga_Kerja_Perempuan->Param, "CustomMsg");
        $this->Fields['Tenaga Kerja Perempuan'] = &$this->Tenaga_Kerja_Perempuan;

        // omset pertahun
        $this->omset_pertahun = new DbField('v_data_usaha', 'v_data_usaha', 'x_omset_pertahun', 'omset pertahun', '`omset pertahun`', '`omset pertahun`', 5, 23, -1, false, '`omset pertahun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omset_pertahun->Sortable = true; // Allow sort
        $this->omset_pertahun->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->omset_pertahun->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->omset_pertahun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omset_pertahun->Param, "CustomMsg");
        $this->Fields['omset pertahun'] = &$this->omset_pertahun;
    }

    // Field Visibility
    public function getFieldVisibility($fldParm)
    {
        global $Security;
        return $this->$fldParm->Visible; // Returns original value
    }

    // Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
    public function setLeftColumnClass($class)
    {
        if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
            $this->LeftColumnClass = $class . " col-form-label ew-label";
            $this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - (int)$match[2]);
            $this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace("col-", "offset-", $class);
            $this->TableLeftColumnClass = preg_replace('/^col-\w+-(\d+)$/', "w-col-$1", $class); // Change to w-col-*
        }
    }

    // Single column sort
    public function updateSort(&$fld)
    {
        if ($this->CurrentOrder == $fld->Name) {
            $sortField = $fld->Expression;
            $lastSort = $fld->getSort();
            if (in_array($this->CurrentOrderType, ["ASC", "DESC", "NO"])) {
                $curSort = $this->CurrentOrderType;
            } else {
                $curSort = $lastSort;
            }
            $fld->setSort($curSort);
            $orderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            $this->setSessionOrderBy($orderBy); // Save to Session
        } else {
            $fld->setSort("");
        }
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_data_usaha`";
    }

    public function sqlFrom() // For backward compatibility
    {
        return $this->getSqlFrom();
    }

    public function setSqlFrom($v)
    {
        $this->SqlFrom = $v;
    }

    public function getSqlSelect() // Select
    {
        return $this->SqlSelect ?? $this->getQueryBuilder()->select("*");
    }

    public function sqlSelect() // For backward compatibility
    {
        return $this->getSqlSelect();
    }

    public function setSqlSelect($v)
    {
        $this->SqlSelect = $v;
    }

    public function getSqlWhere() // Where
    {
        $where = ($this->SqlWhere != "") ? $this->SqlWhere : "";
        $this->DefaultFilter = "";
        AddFilter($where, $this->DefaultFilter);
        return $where;
    }

    public function sqlWhere() // For backward compatibility
    {
        return $this->getSqlWhere();
    }

    public function setSqlWhere($v)
    {
        $this->SqlWhere = $v;
    }

    public function getSqlGroupBy() // Group By
    {
        return ($this->SqlGroupBy != "") ? $this->SqlGroupBy : "";
    }

    public function sqlGroupBy() // For backward compatibility
    {
        return $this->getSqlGroupBy();
    }

    public function setSqlGroupBy($v)
    {
        $this->SqlGroupBy = $v;
    }

    public function getSqlHaving() // Having
    {
        return ($this->SqlHaving != "") ? $this->SqlHaving : "";
    }

    public function sqlHaving() // For backward compatibility
    {
        return $this->getSqlHaving();
    }

    public function setSqlHaving($v)
    {
        $this->SqlHaving = $v;
    }

    public function getSqlOrderBy() // Order By
    {
        return ($this->SqlOrderBy != "") ? $this->SqlOrderBy : $this->DefaultSort;
    }

    public function sqlOrderBy() // For backward compatibility
    {
        return $this->getSqlOrderBy();
    }

    public function setSqlOrderBy($v)
    {
        $this->SqlOrderBy = $v;
    }

    // Apply User ID filters
    public function applyUserIDFilters($filter)
    {
        return $filter;
    }

    // Check if User ID security allows view all
    public function userIDAllow($id = "")
    {
        $allow = $this->UserIDAllowSecurity;
        switch ($id) {
            case "add":
            case "copy":
            case "gridadd":
            case "register":
            case "addopt":
                return (($allow & 1) == 1);
            case "edit":
            case "gridedit":
            case "update":
            case "changepassword":
            case "resetpassword":
                return (($allow & 4) == 4);
            case "delete":
                return (($allow & 2) == 2);
            case "view":
                return (($allow & 32) == 32);
            case "search":
                return (($allow & 64) == 64);
            default:
                return (($allow & 8) == 8);
        }
    }

    /**
     * Get record count
     *
     * @param string|QueryBuilder $sql SQL or QueryBuilder
     * @param mixed $c Connection
     * @return int
     */
    public function getRecordCount($sql, $c = null)
    {
        $cnt = -1;
        $rs = null;
        if ($sql instanceof \Doctrine\DBAL\Query\QueryBuilder) { // Query builder
            $sqlwrk = clone $sql;
            $sqlwrk = $sqlwrk->resetQueryPart("orderBy")->getSQL();
        } else {
            $sqlwrk = $sql;
        }
        $pattern = '/^SELECT\s([\s\S]+)\sFROM\s/i';
        // Skip Custom View / SubQuery / SELECT DISTINCT / ORDER BY
        if (
            ($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') &&
            preg_match($pattern, $sqlwrk) && !preg_match('/\(\s*(SELECT[^)]+)\)/i', $sqlwrk) &&
            !preg_match('/^\s*select\s+distinct\s+/i', $sqlwrk) && !preg_match('/\s+order\s+by\s+/i', $sqlwrk)
        ) {
            $sqlwrk = "SELECT COUNT(*) FROM " . preg_replace($pattern, "", $sqlwrk);
        } else {
            $sqlwrk = "SELECT COUNT(*) FROM (" . $sqlwrk . ") COUNT_TABLE";
        }
        $conn = $c ?? $this->getConnection();
        $rs = $conn->executeQuery($sqlwrk);
        $cnt = $rs->fetchColumn();
        if ($cnt !== false) {
            return (int)$cnt;
        }

        // Unable to get count by SELECT COUNT(*), execute the SQL to get record count directly
        return ExecuteRecordCount($sql, $conn);
    }

    // Get SQL
    public function getSql($where, $orderBy = "")
    {
        return $this->buildSelectSql(
            $this->getSqlSelect(),
            $this->getSqlFrom(),
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $where,
            $orderBy
        )->getSQL();
    }

    // Table SQL
    public function getCurrentSql()
    {
        $filter = $this->CurrentFilter;
        $filter = $this->applyUserIDFilters($filter);
        $sort = $this->getSessionOrderBy();
        return $this->getSql($filter, $sort);
    }

    /**
     * Table SQL with List page filter
     *
     * @return QueryBuilder
     */
    public function getListSql()
    {
        $filter = $this->UseSessionForListSql ? $this->getSessionWhere() : "";
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->getSqlSelect();
        $from = $this->getSqlFrom();
        $sort = $this->UseSessionForListSql ? $this->getSessionOrderBy() : "";
        $this->Sort = $sort;
        return $this->buildSelectSql(
            $select,
            $from,
            $this->getSqlWhere(),
            $this->getSqlGroupBy(),
            $this->getSqlHaving(),
            $this->getSqlOrderBy(),
            $filter,
            $sort
        );
    }

    // Get ORDER BY clause
    public function getOrderBy()
    {
        $orderBy = $this->getSqlOrderBy();
        $sort = $this->getSessionOrderBy();
        if ($orderBy != "" && $sort != "") {
            $orderBy .= ", " . $sort;
        } elseif ($sort != "") {
            $orderBy = $sort;
        }
        return $orderBy;
    }

    // Get record count based on filter (for detail record count in master table pages)
    public function loadRecordCount($filter)
    {
        $origFilter = $this->CurrentFilter;
        $this->CurrentFilter = $filter;
        $this->recordsetSelecting($this->CurrentFilter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
        $cnt = $this->getRecordCount($sql);
        $this->CurrentFilter = $origFilter;
        return $cnt;
    }

    // Get record count (for current List page)
    public function listRecordCount()
    {
        $filter = $this->getSessionWhere();
        AddFilter($filter, $this->CurrentFilter);
        $filter = $this->applyUserIDFilters($filter);
        $this->recordsetSelecting($filter);
        $select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : $this->getQueryBuilder()->select("*");
        $groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
        $having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
        $sql = $this->buildSelectSql($select, $this->getSqlFrom(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
        $cnt = $this->getRecordCount($sql);
        return $cnt;
    }

    /**
     * INSERT statement
     *
     * @param mixed $rs
     * @return QueryBuilder
     */
    protected function insertSql(&$rs)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->insert($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->setValue($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        return $queryBuilder;
    }

    // Insert
    public function insert(&$rs)
    {
        $conn = $this->getConnection();
        $success = $this->insertSql($rs)->execute();
        if ($success) {
        }
        return $success;
    }

    /**
     * UPDATE statement
     *
     * @param array $rs Data to be updated
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function updateSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->update($this->UpdateTable);
        foreach ($rs as $name => $value) {
            if (!isset($this->Fields[$name]) || $this->Fields[$name]->IsCustom || $this->Fields[$name]->IsAutoIncrement) {
                continue;
            }
            $type = GetParameterType($this->Fields[$name], $value, $this->Dbid);
            $queryBuilder->set($this->Fields[$name]->Expression, $queryBuilder->createPositionalParameter($value, $type));
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        AddFilter($filter, $where);
        if ($filter != "") {
            $queryBuilder->where($filter);
        }
        return $queryBuilder;
    }

    // Update
    public function update(&$rs, $where = "", $rsold = null, $curfilter = true)
    {
        // If no field is updated, execute may return 0. Treat as success
        $success = $this->updateSql($rs, $where, $curfilter)->execute();
        $success = ($success > 0) ? $success : true;
        return $success;
    }

    /**
     * DELETE statement
     *
     * @param array $rs Key values
     * @param string|array $where WHERE clause
     * @param string $curfilter Filter
     * @return QueryBuilder
     */
    protected function deleteSql(&$rs, $where = "", $curfilter = true)
    {
        $queryBuilder = $this->getQueryBuilder();
        $queryBuilder->delete($this->UpdateTable);
        if (is_array($where)) {
            $where = $this->arrayToFilter($where);
        }
        if ($rs) {
        }
        $filter = ($curfilter) ? $this->CurrentFilter : "";
        AddFilter($filter, $where);
        return $queryBuilder->where($filter != "" ? $filter : "0=1");
    }

    // Delete
    public function delete(&$rs, $where = "", $curfilter = false)
    {
        $success = true;
        if ($success) {
            $success = $this->deleteSql($rs, $where, $curfilter)->execute();
        }
        return $success;
    }

    // Load DbValue from recordset or array
    protected function loadDbValues($row)
    {
        if (!is_array($row)) {
            return;
        }
        $this->kapanewon->DbValue = $row['kapanewon'];
        $this->jumlah_Usaha->DbValue = $row['jumlah Usaha'];
        $this->tenaga_kerja_lakilaki->DbValue = $row['tenaga kerja laki-laki'];
        $this->Tenaga_Kerja_Perempuan->DbValue = $row['Tenaga Kerja Perempuan'];
        $this->omset_pertahun->DbValue = $row['omset pertahun'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        return $keyFilter;
    }

    // Return page URL
    public function getReturnUrl()
    {
        $referUrl = ReferUrl();
        $referPageName = ReferPageName();
        $name = PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL");
        // Get referer URL automatically
        if ($referUrl != "" && $referPageName != CurrentPageName() && $referPageName != "login") { // Referer not same page or login page
            $_SESSION[$name] = $referUrl; // Save to Session
        }
        return $_SESSION[$name] ?? GetUrl("vdatausahalist");
    }

    // Set return page URL
    public function setReturnUrl($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_RETURN_URL")] = $v;
    }

    // Get modal caption
    public function getModalCaption($pageName)
    {
        global $Language;
        if ($pageName == "vdatausahaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vdatausahaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vdatausahaadd") {
            return $Language->phrase("Add");
        } else {
            return "";
        }
    }

    // API page name
    public function getApiPageName($action)
    {
        switch (strtolower($action)) {
            case Config("API_VIEW_ACTION"):
                return "VDataUsahaView";
            case Config("API_ADD_ACTION"):
                return "VDataUsahaAdd";
            case Config("API_EDIT_ACTION"):
                return "VDataUsahaEdit";
            case Config("API_DELETE_ACTION"):
                return "VDataUsahaDelete";
            case Config("API_LIST_ACTION"):
                return "VDataUsahaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vdatausahalist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vdatausahaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vdatausahaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vdatausahaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "vdatausahaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vdatausahaedit", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline edit URL
    public function getInlineEditUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=edit"));
        return $this->addMasterUrl($url);
    }

    // Copy URL
    public function getCopyUrl($parm = "")
    {
        $url = $this->keyUrl("vdatausahaadd", $this->getUrlParm($parm));
        return $this->addMasterUrl($url);
    }

    // Inline copy URL
    public function getInlineCopyUrl()
    {
        $url = $this->keyUrl(CurrentPageName(), $this->getUrlParm("action=copy"));
        return $this->addMasterUrl($url);
    }

    // Delete URL
    public function getDeleteUrl()
    {
        return $this->keyUrl("vdatausahadelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($parm != "") {
            $url .= "?" . $parm;
        }
        return $url;
    }

    // Render sort
    public function renderSort($fld)
    {
        $classId = $fld->TableVar . "_" . $fld->Param;
        $scriptId = str_replace("%id%", $classId, "tpc_%id%");
        $scriptStart = $this->UseCustomTemplate ? "<template id=\"" . $scriptId . "\">" : "";
        $scriptEnd = $this->UseCustomTemplate ? "</template>" : "";
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 1);\"";
        if ($this->sortUrl($fld) == "") {
            $html = <<<NOSORTHTML
{$scriptStart}<div class="ew-table-header-caption">{$fld->caption()}</div>{$scriptEnd}
NOSORTHTML;
        } else {
            if ($fld->getSort() == "ASC") {
                $sortIcon = '<i class="fas fa-sort-up"></i>';
            } elseif ($fld->getSort() == "DESC") {
                $sortIcon = '<i class="fas fa-sort-down"></i>';
            } else {
                $sortIcon = '';
            }
            $html = <<<SORTHTML
{$scriptStart}<div{$jsSort}><div class="ew-table-header-btn"><span class="ew-table-header-caption">{$fld->caption()}</span><span class="ew-table-header-sort">{$sortIcon}</span></div></div>{$scriptEnd}
SORTHTML;
        }
        return $html;
    }

    // Sort URL
    public function sortUrl($fld)
    {
        if (
            $this->CurrentAction || $this->isExport() ||
            in_array($fld->Type, [128, 204, 205])
        ) { // Unsortable data type
                return "";
        } elseif ($fld->Sortable) {
            $urlParm = $this->getUrlParm("order=" . urlencode($fld->Name) . "&amp;ordertype=" . $fld->getNextSort());
            return $this->addMasterUrl(CurrentPageName() . "?" . $urlParm);
        } else {
            return "";
        }
    }

    // Get record keys from Post/Get/Session
    public function getRecordKeys()
    {
        $arKeys = [];
        $arKey = [];
        if (Param("key_m") !== null) {
            $arKeys = Param("key_m");
            $cnt = count($arKeys);
        } else {
            //return $arKeys; // Do not return yet, so the values will also be checked by the following code
        }
        // Check keys
        $ar = [];
        if (is_array($arKeys)) {
            foreach ($arKeys as $key) {
                $ar[] = $key;
            }
        }
        return $ar;
    }

    // Get filter from record keys
    public function getFilterFromRecordKeys($setCurrent = true)
    {
        $arKeys = $this->getRecordKeys();
        $keyFilter = "";
        foreach ($arKeys as $key) {
            if ($keyFilter != "") {
                $keyFilter .= " OR ";
            }
            $keyFilter .= "(" . $this->getRecordFilter() . ")";
        }
        return $keyFilter;
    }

    // Load recordset based on filter
    public function &loadRs($filter)
    {
        $sql = $this->getSql($filter); // Set up filter (WHERE Clause)
        $conn = $this->getConnection();
        $stmt = $conn->executeQuery($sql);
        return $stmt;
    }

    // Load row values from record
    public function loadListRowValues(&$rs)
    {
        if (is_array($rs)) {
            $row = $rs;
        } elseif ($rs && property_exists($rs, "fields")) { // Recordset
            $row = $rs->fields;
        } else {
            return;
        }
        $this->kapanewon->setDbValue($row['kapanewon']);
        $this->jumlah_Usaha->setDbValue($row['jumlah Usaha']);
        $this->tenaga_kerja_lakilaki->setDbValue($row['tenaga kerja laki-laki']);
        $this->Tenaga_Kerja_Perempuan->setDbValue($row['Tenaga Kerja Perempuan']);
        $this->omset_pertahun->setDbValue($row['omset pertahun']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kapanewon

        // jumlah Usaha

        // tenaga kerja laki-laki

        // Tenaga Kerja Perempuan

        // omset pertahun

        // kapanewon
        $this->kapanewon->ViewValue = $this->kapanewon->CurrentValue;
        $this->kapanewon->ViewCustomAttributes = "";

        // jumlah Usaha
        $this->jumlah_Usaha->ViewValue = $this->jumlah_Usaha->CurrentValue;
        $this->jumlah_Usaha->ViewValue = FormatNumber($this->jumlah_Usaha->ViewValue, 0, -2, -2, -2);
        $this->jumlah_Usaha->ViewCustomAttributes = "";

        // tenaga kerja laki-laki
        $this->tenaga_kerja_lakilaki->ViewValue = $this->tenaga_kerja_lakilaki->CurrentValue;
        $this->tenaga_kerja_lakilaki->ViewValue = FormatNumber($this->tenaga_kerja_lakilaki->ViewValue, 2, -2, -2, -2);
        $this->tenaga_kerja_lakilaki->ViewCustomAttributes = "";

        // Tenaga Kerja Perempuan
        $this->Tenaga_Kerja_Perempuan->ViewValue = $this->Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Tenaga_Kerja_Perempuan->ViewValue = FormatNumber($this->Tenaga_Kerja_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Tenaga_Kerja_Perempuan->ViewCustomAttributes = "";

        // omset pertahun
        $this->omset_pertahun->ViewValue = $this->omset_pertahun->CurrentValue;
        $this->omset_pertahun->ViewValue = FormatNumber($this->omset_pertahun->ViewValue, 2, -2, -2, -2);
        $this->omset_pertahun->ViewCustomAttributes = "";

        // kapanewon
        $this->kapanewon->LinkCustomAttributes = "";
        $this->kapanewon->HrefValue = "";
        $this->kapanewon->TooltipValue = "";

        // jumlah Usaha
        $this->jumlah_Usaha->LinkCustomAttributes = "";
        $this->jumlah_Usaha->HrefValue = "";
        $this->jumlah_Usaha->TooltipValue = "";

        // tenaga kerja laki-laki
        $this->tenaga_kerja_lakilaki->LinkCustomAttributes = "";
        $this->tenaga_kerja_lakilaki->HrefValue = "";
        $this->tenaga_kerja_lakilaki->TooltipValue = "";

        // Tenaga Kerja Perempuan
        $this->Tenaga_Kerja_Perempuan->LinkCustomAttributes = "";
        $this->Tenaga_Kerja_Perempuan->HrefValue = "";
        $this->Tenaga_Kerja_Perempuan->TooltipValue = "";

        // omset pertahun
        $this->omset_pertahun->LinkCustomAttributes = "";
        $this->omset_pertahun->HrefValue = "";
        $this->omset_pertahun->TooltipValue = "";

        // Call Row Rendered event
        $this->rowRendered();

        // Save data for Custom Template
        $this->Rows[] = $this->customTemplateFieldValues();
    }

    // Render edit row values
    public function renderEditRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // kapanewon
        $this->kapanewon->EditAttrs["class"] = "form-control";
        $this->kapanewon->EditCustomAttributes = "";
        if (!$this->kapanewon->Raw) {
            $this->kapanewon->CurrentValue = HtmlDecode($this->kapanewon->CurrentValue);
        }
        $this->kapanewon->EditValue = $this->kapanewon->CurrentValue;
        $this->kapanewon->PlaceHolder = RemoveHtml($this->kapanewon->caption());

        // jumlah Usaha
        $this->jumlah_Usaha->EditAttrs["class"] = "form-control";
        $this->jumlah_Usaha->EditCustomAttributes = "";
        $this->jumlah_Usaha->EditValue = $this->jumlah_Usaha->CurrentValue;
        $this->jumlah_Usaha->PlaceHolder = RemoveHtml($this->jumlah_Usaha->caption());

        // tenaga kerja laki-laki
        $this->tenaga_kerja_lakilaki->EditAttrs["class"] = "form-control";
        $this->tenaga_kerja_lakilaki->EditCustomAttributes = "";
        $this->tenaga_kerja_lakilaki->EditValue = $this->tenaga_kerja_lakilaki->CurrentValue;
        $this->tenaga_kerja_lakilaki->PlaceHolder = RemoveHtml($this->tenaga_kerja_lakilaki->caption());
        if (strval($this->tenaga_kerja_lakilaki->EditValue) != "" && is_numeric($this->tenaga_kerja_lakilaki->EditValue)) {
            $this->tenaga_kerja_lakilaki->EditValue = FormatNumber($this->tenaga_kerja_lakilaki->EditValue, -2, -2, -2, -2);
        }

        // Tenaga Kerja Perempuan
        $this->Tenaga_Kerja_Perempuan->EditAttrs["class"] = "form-control";
        $this->Tenaga_Kerja_Perempuan->EditCustomAttributes = "";
        $this->Tenaga_Kerja_Perempuan->EditValue = $this->Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Tenaga_Kerja_Perempuan->PlaceHolder = RemoveHtml($this->Tenaga_Kerja_Perempuan->caption());
        if (strval($this->Tenaga_Kerja_Perempuan->EditValue) != "" && is_numeric($this->Tenaga_Kerja_Perempuan->EditValue)) {
            $this->Tenaga_Kerja_Perempuan->EditValue = FormatNumber($this->Tenaga_Kerja_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // omset pertahun
        $this->omset_pertahun->EditAttrs["class"] = "form-control";
        $this->omset_pertahun->EditCustomAttributes = "";
        $this->omset_pertahun->EditValue = $this->omset_pertahun->CurrentValue;
        $this->omset_pertahun->PlaceHolder = RemoveHtml($this->omset_pertahun->caption());
        if (strval($this->omset_pertahun->EditValue) != "" && is_numeric($this->omset_pertahun->EditValue)) {
            $this->omset_pertahun->EditValue = FormatNumber($this->omset_pertahun->EditValue, -2, -2, -2, -2);
        }

        // Call Row Rendered event
        $this->rowRendered();
    }

    // Aggregate list row values
    public function aggregateListRowValues()
    {
    }

    // Aggregate list row (for rendering)
    public function aggregateListRow()
    {
        // Call Row Rendered event
        $this->rowRendered();
    }

    // Export data in HTML/CSV/Word/Excel/Email/PDF format
    public function exportDocument($doc, $recordset, $startRec = 1, $stopRec = 1, $exportPageType = "")
    {
        if (!$recordset || !$doc) {
            return;
        }
        if (!$doc->ExportCustom) {
            // Write header
            $doc->exportTableHeader();
            if ($doc->Horizontal) { // Horizontal format, write header
                $doc->beginExportRow();
                if ($exportPageType == "view") {
                    $doc->exportCaption($this->kapanewon);
                    $doc->exportCaption($this->jumlah_Usaha);
                    $doc->exportCaption($this->tenaga_kerja_lakilaki);
                    $doc->exportCaption($this->Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->omset_pertahun);
                } else {
                    $doc->exportCaption($this->kapanewon);
                    $doc->exportCaption($this->jumlah_Usaha);
                    $doc->exportCaption($this->tenaga_kerja_lakilaki);
                    $doc->exportCaption($this->Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->omset_pertahun);
                }
                $doc->endExportRow();
            }
        }

        // Move to first record
        $recCnt = $startRec - 1;
        $stopRec = ($stopRec > 0) ? $stopRec : PHP_INT_MAX;
        while (!$recordset->EOF && $recCnt < $stopRec) {
            $row = $recordset->fields;
            $recCnt++;
            if ($recCnt >= $startRec) {
                $rowCnt = $recCnt - $startRec + 1;

                // Page break
                if ($this->ExportPageBreakCount > 0) {
                    if ($rowCnt > 1 && ($rowCnt - 1) % $this->ExportPageBreakCount == 0) {
                        $doc->exportPageBreak();
                    }
                }
                $this->loadListRowValues($row);

                // Render row
                $this->RowType = ROWTYPE_VIEW; // Render view
                $this->resetAttributes();
                $this->renderListRow();
                if (!$doc->ExportCustom) {
                    $doc->beginExportRow($rowCnt); // Allow CSS styles if enabled
                    if ($exportPageType == "view") {
                        $doc->exportField($this->kapanewon);
                        $doc->exportField($this->jumlah_Usaha);
                        $doc->exportField($this->tenaga_kerja_lakilaki);
                        $doc->exportField($this->Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->omset_pertahun);
                    } else {
                        $doc->exportField($this->kapanewon);
                        $doc->exportField($this->jumlah_Usaha);
                        $doc->exportField($this->tenaga_kerja_lakilaki);
                        $doc->exportField($this->Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->omset_pertahun);
                    }
                    $doc->endExportRow($rowCnt);
                }
            }

            // Call Row Export server event
            if ($doc->ExportCustom) {
                $this->rowExport($row);
            }
            $recordset->moveNext();
        }
        if (!$doc->ExportCustom) {
            $doc->exportTableFooter();
        }
    }

    // Get file data
    public function getFileData($fldparm, $key, $resize, $width = 0, $height = 0, $plugins = [])
    {
        // No binary fields
        return false;
    }

    // Table level events

    // Recordset Selecting event
    public function recordsetSelecting(&$filter)
    {
        // Enter your code here
    }

    // Recordset Selected event
    public function recordsetSelected(&$rs)
    {
        //Log("Recordset Selected");
    }

    // Recordset Search Validated event
    public function recordsetSearchValidated()
    {
        // Example:
        //$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value
    }

    // Recordset Searching event
    public function recordsetSearching(&$filter)
    {
        // Enter your code here
    }

    // Row_Selecting event
    public function rowSelecting(&$filter)
    {
        // Enter your code here
    }

    // Row Selected event
    public function rowSelected(&$rs)
    {
        //Log("Row Selected");
    }

    // Row Inserting event
    public function rowInserting($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Inserted event
    public function rowInserted($rsold, &$rsnew)
    {
        //Log("Row Inserted");
    }

    // Row Updating event
    public function rowUpdating($rsold, &$rsnew)
    {
        // Enter your code here
        // To cancel, set return value to false
        return true;
    }

    // Row Updated event
    public function rowUpdated($rsold, &$rsnew)
    {
        //Log("Row Updated");
    }

    // Row Update Conflict event
    public function rowUpdateConflict($rsold, &$rsnew)
    {
        // Enter your code here
        // To ignore conflict, set return value to false
        return true;
    }

    // Grid Inserting event
    public function gridInserting()
    {
        // Enter your code here
        // To reject grid insert, set return value to false
        return true;
    }

    // Grid Inserted event
    public function gridInserted($rsnew)
    {
        //Log("Grid Inserted");
    }

    // Grid Updating event
    public function gridUpdating($rsold)
    {
        // Enter your code here
        // To reject grid update, set return value to false
        return true;
    }

    // Grid Updated event
    public function gridUpdated($rsold, $rsnew)
    {
        //Log("Grid Updated");
    }

    // Row Deleting event
    public function rowDeleting(&$rs)
    {
        // Enter your code here
        // To cancel, set return value to False
        return true;
    }

    // Row Deleted event
    public function rowDeleted(&$rs)
    {
        //Log("Row Deleted");
    }

    // Email Sending event
    public function emailSending($email, &$args)
    {
        //var_dump($email); var_dump($args); exit();
        return true;
    }

    // Lookup Selecting event
    public function lookupSelecting($fld, &$filter)
    {
        //var_dump($fld->Name, $fld->Lookup, $filter); // Uncomment to view the filter
        // Enter your code here
    }

    // Row Rendering event
    public function rowRendering()
    {
        // Enter your code here
    }

    // Row Rendered event
    public function rowRendered()
    {
        // To view properties of field class, use:
        //var_dump($this-><FieldName>);
    }

    // User ID Filtering event
    public function userIdFiltering(&$filter)
    {
        // Enter your code here
    }
}
