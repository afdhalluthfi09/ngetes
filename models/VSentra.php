<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for v_sentra
 */
class VSentra extends DbTable
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
    public $kerajinan;
    public $kimia_dan_bahan_bangunan;
    public $logam_dan_elektronika;
    public $pangan;
    public $sandang_dan_kulit;
    public $jumlah_tenaga_kerja;
    public $nilali_produksi;
    public $Kapasits;
    public $Bahan_Baku;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_sentra';
        $this->TableName = 'v_sentra';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_sentra`";
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
        $this->kapanewon = new DbField('v_sentra', 'v_sentra', 'x_kapanewon', 'kapanewon', '`kapanewon`', '`kapanewon`', 200, 255, -1, false, '`kapanewon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapanewon->Nullable = false; // NOT NULL field
        $this->kapanewon->Required = true; // Required field
        $this->kapanewon->Sortable = true; // Allow sort
        $this->kapanewon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapanewon->Param, "CustomMsg");
        $this->Fields['kapanewon'] = &$this->kapanewon;

        // kerajinan
        $this->kerajinan = new DbField('v_sentra', 'v_sentra', 'x_kerajinan', 'kerajinan', '`kerajinan`', '`kerajinan`', 131, 22, -1, false, '`kerajinan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kerajinan->Sortable = true; // Allow sort
        $this->kerajinan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kerajinan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kerajinan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kerajinan->Param, "CustomMsg");
        $this->Fields['kerajinan'] = &$this->kerajinan;

        // kimia dan bahan bangunan
        $this->kimia_dan_bahan_bangunan = new DbField('v_sentra', 'v_sentra', 'x_kimia_dan_bahan_bangunan', 'kimia dan bahan bangunan', '`kimia dan bahan bangunan`', '`kimia dan bahan bangunan`', 131, 22, -1, false, '`kimia dan bahan bangunan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kimia_dan_bahan_bangunan->Sortable = true; // Allow sort
        $this->kimia_dan_bahan_bangunan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kimia_dan_bahan_bangunan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kimia_dan_bahan_bangunan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kimia_dan_bahan_bangunan->Param, "CustomMsg");
        $this->Fields['kimia dan bahan bangunan'] = &$this->kimia_dan_bahan_bangunan;

        // logam dan elektronika
        $this->logam_dan_elektronika = new DbField('v_sentra', 'v_sentra', 'x_logam_dan_elektronika', 'logam dan elektronika', '`logam dan elektronika`', '`logam dan elektronika`', 131, 22, -1, false, '`logam dan elektronika`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->logam_dan_elektronika->Sortable = true; // Allow sort
        $this->logam_dan_elektronika->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->logam_dan_elektronika->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->logam_dan_elektronika->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->logam_dan_elektronika->Param, "CustomMsg");
        $this->Fields['logam dan elektronika'] = &$this->logam_dan_elektronika;

        // pangan
        $this->pangan = new DbField('v_sentra', 'v_sentra', 'x_pangan', 'pangan', '`pangan`', '`pangan`', 131, 22, -1, false, '`pangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pangan->Sortable = true; // Allow sort
        $this->pangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pangan->Param, "CustomMsg");
        $this->Fields['pangan'] = &$this->pangan;

        // sandang dan kulit
        $this->sandang_dan_kulit = new DbField('v_sentra', 'v_sentra', 'x_sandang_dan_kulit', 'sandang dan kulit', '`sandang dan kulit`', '`sandang dan kulit`', 131, 22, -1, false, '`sandang dan kulit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sandang_dan_kulit->Sortable = true; // Allow sort
        $this->sandang_dan_kulit->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->sandang_dan_kulit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->sandang_dan_kulit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sandang_dan_kulit->Param, "CustomMsg");
        $this->Fields['sandang dan kulit'] = &$this->sandang_dan_kulit;

        // jumlah tenaga kerja
        $this->jumlah_tenaga_kerja = new DbField('v_sentra', 'v_sentra', 'x_jumlah_tenaga_kerja', 'jumlah tenaga kerja', '`jumlah tenaga kerja`', '`jumlah tenaga kerja`', 131, 32, -1, false, '`jumlah tenaga kerja`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_tenaga_kerja->Sortable = true; // Allow sort
        $this->jumlah_tenaga_kerja->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah_tenaga_kerja->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah_tenaga_kerja->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_tenaga_kerja->Param, "CustomMsg");
        $this->Fields['jumlah tenaga kerja'] = &$this->jumlah_tenaga_kerja;

        // nilali_produksi
        $this->nilali_produksi = new DbField('v_sentra', 'v_sentra', 'x_nilali_produksi', 'nilali_produksi', '`nilali_produksi`', '`nilali_produksi`', 5, 23, -1, false, '`nilali_produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nilali_produksi->Sortable = true; // Allow sort
        $this->nilali_produksi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->nilali_produksi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->nilali_produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilali_produksi->Param, "CustomMsg");
        $this->Fields['nilali_produksi'] = &$this->nilali_produksi;

        // Kapasits
        $this->Kapasits = new DbField('v_sentra', 'v_sentra', 'x_Kapasits', 'Kapasits', '`Kapasits`', '`Kapasits`', 5, 23, -1, false, '`Kapasits`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kapasits->Sortable = true; // Allow sort
        $this->Kapasits->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Kapasits->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Kapasits->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kapasits->Param, "CustomMsg");
        $this->Fields['Kapasits'] = &$this->Kapasits;

        // Bahan Baku
        $this->Bahan_Baku = new DbField('v_sentra', 'v_sentra', 'x_Bahan_Baku', 'Bahan Baku', '`Bahan Baku`', '`Bahan Baku`', 5, 23, -1, false, '`Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bahan_Baku->Sortable = true; // Allow sort
        $this->Bahan_Baku->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Bahan_Baku->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Bahan Baku'] = &$this->Bahan_Baku;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_sentra`";
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
        $this->kerajinan->DbValue = $row['kerajinan'];
        $this->kimia_dan_bahan_bangunan->DbValue = $row['kimia dan bahan bangunan'];
        $this->logam_dan_elektronika->DbValue = $row['logam dan elektronika'];
        $this->pangan->DbValue = $row['pangan'];
        $this->sandang_dan_kulit->DbValue = $row['sandang dan kulit'];
        $this->jumlah_tenaga_kerja->DbValue = $row['jumlah tenaga kerja'];
        $this->nilali_produksi->DbValue = $row['nilali_produksi'];
        $this->Kapasits->DbValue = $row['Kapasits'];
        $this->Bahan_Baku->DbValue = $row['Bahan Baku'];
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
        return $_SESSION[$name] ?? GetUrl("vsentralist");
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
        if ($pageName == "vsentraview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vsentraedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vsentraadd") {
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
                return "VSentraView";
            case Config("API_ADD_ACTION"):
                return "VSentraAdd";
            case Config("API_EDIT_ACTION"):
                return "VSentraEdit";
            case Config("API_DELETE_ACTION"):
                return "VSentraDelete";
            case Config("API_LIST_ACTION"):
                return "VSentraList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vsentralist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vsentraview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vsentraview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vsentraadd?" . $this->getUrlParm($parm);
        } else {
            $url = "vsentraadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vsentraedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("vsentraadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("vsentradelete", $this->getUrlParm());
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
        $this->kerajinan->setDbValue($row['kerajinan']);
        $this->kimia_dan_bahan_bangunan->setDbValue($row['kimia dan bahan bangunan']);
        $this->logam_dan_elektronika->setDbValue($row['logam dan elektronika']);
        $this->pangan->setDbValue($row['pangan']);
        $this->sandang_dan_kulit->setDbValue($row['sandang dan kulit']);
        $this->jumlah_tenaga_kerja->setDbValue($row['jumlah tenaga kerja']);
        $this->nilali_produksi->setDbValue($row['nilali_produksi']);
        $this->Kapasits->setDbValue($row['Kapasits']);
        $this->Bahan_Baku->setDbValue($row['Bahan Baku']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kapanewon

        // kerajinan

        // kimia dan bahan bangunan

        // logam dan elektronika

        // pangan

        // sandang dan kulit

        // jumlah tenaga kerja

        // nilali_produksi

        // Kapasits

        // Bahan Baku

        // kapanewon
        $this->kapanewon->ViewValue = $this->kapanewon->CurrentValue;
        $this->kapanewon->ViewCustomAttributes = "";

        // kerajinan
        $this->kerajinan->ViewValue = $this->kerajinan->CurrentValue;
        $this->kerajinan->ViewValue = FormatNumber($this->kerajinan->ViewValue, 2, -2, -2, -2);
        $this->kerajinan->ViewCustomAttributes = "";

        // kimia dan bahan bangunan
        $this->kimia_dan_bahan_bangunan->ViewValue = $this->kimia_dan_bahan_bangunan->CurrentValue;
        $this->kimia_dan_bahan_bangunan->ViewValue = FormatNumber($this->kimia_dan_bahan_bangunan->ViewValue, 2, -2, -2, -2);
        $this->kimia_dan_bahan_bangunan->ViewCustomAttributes = "";

        // logam dan elektronika
        $this->logam_dan_elektronika->ViewValue = $this->logam_dan_elektronika->CurrentValue;
        $this->logam_dan_elektronika->ViewValue = FormatNumber($this->logam_dan_elektronika->ViewValue, 2, -2, -2, -2);
        $this->logam_dan_elektronika->ViewCustomAttributes = "";

        // pangan
        $this->pangan->ViewValue = $this->pangan->CurrentValue;
        $this->pangan->ViewValue = FormatNumber($this->pangan->ViewValue, 2, -2, -2, -2);
        $this->pangan->ViewCustomAttributes = "";

        // sandang dan kulit
        $this->sandang_dan_kulit->ViewValue = $this->sandang_dan_kulit->CurrentValue;
        $this->sandang_dan_kulit->ViewValue = FormatNumber($this->sandang_dan_kulit->ViewValue, 2, -2, -2, -2);
        $this->sandang_dan_kulit->ViewCustomAttributes = "";

        // jumlah tenaga kerja
        $this->jumlah_tenaga_kerja->ViewValue = $this->jumlah_tenaga_kerja->CurrentValue;
        $this->jumlah_tenaga_kerja->ViewValue = FormatNumber($this->jumlah_tenaga_kerja->ViewValue, 2, -2, -2, -2);
        $this->jumlah_tenaga_kerja->ViewCustomAttributes = "";

        // nilali_produksi
        $this->nilali_produksi->ViewValue = $this->nilali_produksi->CurrentValue;
        $this->nilali_produksi->ViewValue = FormatNumber($this->nilali_produksi->ViewValue, 2, -2, -2, -2);
        $this->nilali_produksi->ViewCustomAttributes = "";

        // Kapasits
        $this->Kapasits->ViewValue = $this->Kapasits->CurrentValue;
        $this->Kapasits->ViewValue = FormatNumber($this->Kapasits->ViewValue, 2, -2, -2, -2);
        $this->Kapasits->ViewCustomAttributes = "";

        // Bahan Baku
        $this->Bahan_Baku->ViewValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->ViewValue = FormatNumber($this->Bahan_Baku->ViewValue, 2, -2, -2, -2);
        $this->Bahan_Baku->ViewCustomAttributes = "";

        // kapanewon
        $this->kapanewon->LinkCustomAttributes = "";
        $this->kapanewon->HrefValue = "";
        $this->kapanewon->TooltipValue = "";

        // kerajinan
        $this->kerajinan->LinkCustomAttributes = "";
        $this->kerajinan->HrefValue = "";
        $this->kerajinan->TooltipValue = "";

        // kimia dan bahan bangunan
        $this->kimia_dan_bahan_bangunan->LinkCustomAttributes = "";
        $this->kimia_dan_bahan_bangunan->HrefValue = "";
        $this->kimia_dan_bahan_bangunan->TooltipValue = "";

        // logam dan elektronika
        $this->logam_dan_elektronika->LinkCustomAttributes = "";
        $this->logam_dan_elektronika->HrefValue = "";
        $this->logam_dan_elektronika->TooltipValue = "";

        // pangan
        $this->pangan->LinkCustomAttributes = "";
        $this->pangan->HrefValue = "";
        $this->pangan->TooltipValue = "";

        // sandang dan kulit
        $this->sandang_dan_kulit->LinkCustomAttributes = "";
        $this->sandang_dan_kulit->HrefValue = "";
        $this->sandang_dan_kulit->TooltipValue = "";

        // jumlah tenaga kerja
        $this->jumlah_tenaga_kerja->LinkCustomAttributes = "";
        $this->jumlah_tenaga_kerja->HrefValue = "";
        $this->jumlah_tenaga_kerja->TooltipValue = "";

        // nilali_produksi
        $this->nilali_produksi->LinkCustomAttributes = "";
        $this->nilali_produksi->HrefValue = "";
        $this->nilali_produksi->TooltipValue = "";

        // Kapasits
        $this->Kapasits->LinkCustomAttributes = "";
        $this->Kapasits->HrefValue = "";
        $this->Kapasits->TooltipValue = "";

        // Bahan Baku
        $this->Bahan_Baku->LinkCustomAttributes = "";
        $this->Bahan_Baku->HrefValue = "";
        $this->Bahan_Baku->TooltipValue = "";

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

        // kerajinan
        $this->kerajinan->EditAttrs["class"] = "form-control";
        $this->kerajinan->EditCustomAttributes = "";
        $this->kerajinan->EditValue = $this->kerajinan->CurrentValue;
        $this->kerajinan->PlaceHolder = RemoveHtml($this->kerajinan->caption());
        if (strval($this->kerajinan->EditValue) != "" && is_numeric($this->kerajinan->EditValue)) {
            $this->kerajinan->EditValue = FormatNumber($this->kerajinan->EditValue, -2, -2, -2, -2);
        }

        // kimia dan bahan bangunan
        $this->kimia_dan_bahan_bangunan->EditAttrs["class"] = "form-control";
        $this->kimia_dan_bahan_bangunan->EditCustomAttributes = "";
        $this->kimia_dan_bahan_bangunan->EditValue = $this->kimia_dan_bahan_bangunan->CurrentValue;
        $this->kimia_dan_bahan_bangunan->PlaceHolder = RemoveHtml($this->kimia_dan_bahan_bangunan->caption());
        if (strval($this->kimia_dan_bahan_bangunan->EditValue) != "" && is_numeric($this->kimia_dan_bahan_bangunan->EditValue)) {
            $this->kimia_dan_bahan_bangunan->EditValue = FormatNumber($this->kimia_dan_bahan_bangunan->EditValue, -2, -2, -2, -2);
        }

        // logam dan elektronika
        $this->logam_dan_elektronika->EditAttrs["class"] = "form-control";
        $this->logam_dan_elektronika->EditCustomAttributes = "";
        $this->logam_dan_elektronika->EditValue = $this->logam_dan_elektronika->CurrentValue;
        $this->logam_dan_elektronika->PlaceHolder = RemoveHtml($this->logam_dan_elektronika->caption());
        if (strval($this->logam_dan_elektronika->EditValue) != "" && is_numeric($this->logam_dan_elektronika->EditValue)) {
            $this->logam_dan_elektronika->EditValue = FormatNumber($this->logam_dan_elektronika->EditValue, -2, -2, -2, -2);
        }

        // pangan
        $this->pangan->EditAttrs["class"] = "form-control";
        $this->pangan->EditCustomAttributes = "";
        $this->pangan->EditValue = $this->pangan->CurrentValue;
        $this->pangan->PlaceHolder = RemoveHtml($this->pangan->caption());
        if (strval($this->pangan->EditValue) != "" && is_numeric($this->pangan->EditValue)) {
            $this->pangan->EditValue = FormatNumber($this->pangan->EditValue, -2, -2, -2, -2);
        }

        // sandang dan kulit
        $this->sandang_dan_kulit->EditAttrs["class"] = "form-control";
        $this->sandang_dan_kulit->EditCustomAttributes = "";
        $this->sandang_dan_kulit->EditValue = $this->sandang_dan_kulit->CurrentValue;
        $this->sandang_dan_kulit->PlaceHolder = RemoveHtml($this->sandang_dan_kulit->caption());
        if (strval($this->sandang_dan_kulit->EditValue) != "" && is_numeric($this->sandang_dan_kulit->EditValue)) {
            $this->sandang_dan_kulit->EditValue = FormatNumber($this->sandang_dan_kulit->EditValue, -2, -2, -2, -2);
        }

        // jumlah tenaga kerja
        $this->jumlah_tenaga_kerja->EditAttrs["class"] = "form-control";
        $this->jumlah_tenaga_kerja->EditCustomAttributes = "";
        $this->jumlah_tenaga_kerja->EditValue = $this->jumlah_tenaga_kerja->CurrentValue;
        $this->jumlah_tenaga_kerja->PlaceHolder = RemoveHtml($this->jumlah_tenaga_kerja->caption());
        if (strval($this->jumlah_tenaga_kerja->EditValue) != "" && is_numeric($this->jumlah_tenaga_kerja->EditValue)) {
            $this->jumlah_tenaga_kerja->EditValue = FormatNumber($this->jumlah_tenaga_kerja->EditValue, -2, -2, -2, -2);
        }

        // nilali_produksi
        $this->nilali_produksi->EditAttrs["class"] = "form-control";
        $this->nilali_produksi->EditCustomAttributes = "";
        $this->nilali_produksi->EditValue = $this->nilali_produksi->CurrentValue;
        $this->nilali_produksi->PlaceHolder = RemoveHtml($this->nilali_produksi->caption());
        if (strval($this->nilali_produksi->EditValue) != "" && is_numeric($this->nilali_produksi->EditValue)) {
            $this->nilali_produksi->EditValue = FormatNumber($this->nilali_produksi->EditValue, -2, -2, -2, -2);
        }

        // Kapasits
        $this->Kapasits->EditAttrs["class"] = "form-control";
        $this->Kapasits->EditCustomAttributes = "";
        $this->Kapasits->EditValue = $this->Kapasits->CurrentValue;
        $this->Kapasits->PlaceHolder = RemoveHtml($this->Kapasits->caption());
        if (strval($this->Kapasits->EditValue) != "" && is_numeric($this->Kapasits->EditValue)) {
            $this->Kapasits->EditValue = FormatNumber($this->Kapasits->EditValue, -2, -2, -2, -2);
        }

        // Bahan Baku
        $this->Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Bahan_Baku->EditCustomAttributes = "";
        $this->Bahan_Baku->EditValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->PlaceHolder = RemoveHtml($this->Bahan_Baku->caption());
        if (strval($this->Bahan_Baku->EditValue) != "" && is_numeric($this->Bahan_Baku->EditValue)) {
            $this->Bahan_Baku->EditValue = FormatNumber($this->Bahan_Baku->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->kerajinan);
                    $doc->exportCaption($this->kimia_dan_bahan_bangunan);
                    $doc->exportCaption($this->logam_dan_elektronika);
                    $doc->exportCaption($this->pangan);
                    $doc->exportCaption($this->sandang_dan_kulit);
                    $doc->exportCaption($this->jumlah_tenaga_kerja);
                    $doc->exportCaption($this->nilali_produksi);
                    $doc->exportCaption($this->Kapasits);
                    $doc->exportCaption($this->Bahan_Baku);
                } else {
                    $doc->exportCaption($this->kapanewon);
                    $doc->exportCaption($this->kerajinan);
                    $doc->exportCaption($this->kimia_dan_bahan_bangunan);
                    $doc->exportCaption($this->logam_dan_elektronika);
                    $doc->exportCaption($this->pangan);
                    $doc->exportCaption($this->sandang_dan_kulit);
                    $doc->exportCaption($this->jumlah_tenaga_kerja);
                    $doc->exportCaption($this->nilali_produksi);
                    $doc->exportCaption($this->Kapasits);
                    $doc->exportCaption($this->Bahan_Baku);
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
                        $doc->exportField($this->kerajinan);
                        $doc->exportField($this->kimia_dan_bahan_bangunan);
                        $doc->exportField($this->logam_dan_elektronika);
                        $doc->exportField($this->pangan);
                        $doc->exportField($this->sandang_dan_kulit);
                        $doc->exportField($this->jumlah_tenaga_kerja);
                        $doc->exportField($this->nilali_produksi);
                        $doc->exportField($this->Kapasits);
                        $doc->exportField($this->Bahan_Baku);
                    } else {
                        $doc->exportField($this->kapanewon);
                        $doc->exportField($this->kerajinan);
                        $doc->exportField($this->kimia_dan_bahan_bangunan);
                        $doc->exportField($this->logam_dan_elektronika);
                        $doc->exportField($this->pangan);
                        $doc->exportField($this->sandang_dan_kulit);
                        $doc->exportField($this->jumlah_tenaga_kerja);
                        $doc->exportField($this->nilali_produksi);
                        $doc->exportField($this->Kapasits);
                        $doc->exportField($this->Bahan_Baku);
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
