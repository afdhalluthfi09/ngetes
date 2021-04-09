<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for cetak_aspek_pemasaran_online
 */
class CetakAspekPemasaranOnline extends DbTable
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
    public $NIK;
    public $DM_CHATTING;
    public $DM_MEDSOS;
    public $DM_MP;
    public $DM_GMB;
    public $DM_WEB;
    public $DM_UPDATEMEDSOS;
    public $DM_UPDATEWEBSITE;
    public $DM_GOOGLEINDEX;
    public $DM_IKLANBERBAYAR;
    public $NAMA_PEMILIK;
    public $NAMA_USAHA;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'cetak_aspek_pemasaran_online';
        $this->TableName = 'cetak_aspek_pemasaran_online';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`cetak_aspek_pemasaran_online`";
        $this->Dbid = 'DB';
        $this->ExportAll = false;
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

        // NIK
        $this->NIK = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Required = true; // Required field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // DM_CHATTING
        $this->DM_CHATTING = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_CHATTING', 'DM_CHATTING', '`DM_CHATTING`', '`DM_CHATTING`', 200, 50, -1, false, '`DM_CHATTING`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_CHATTING->Sortable = true; // Allow sort
        $this->DM_CHATTING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_CHATTING->Param, "CustomMsg");
        $this->Fields['DM_CHATTING'] = &$this->DM_CHATTING;

        // DM_MEDSOS
        $this->DM_MEDSOS = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_MEDSOS', 'DM_MEDSOS', '`DM_MEDSOS`', '`DM_MEDSOS`', 200, 50, -1, false, '`DM_MEDSOS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_MEDSOS->Sortable = true; // Allow sort
        $this->DM_MEDSOS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_MEDSOS->Param, "CustomMsg");
        $this->Fields['DM_MEDSOS'] = &$this->DM_MEDSOS;

        // DM_MP
        $this->DM_MP = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_MP', 'DM_MP', '`DM_MP`', '`DM_MP`', 200, 50, -1, false, '`DM_MP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_MP->Sortable = true; // Allow sort
        $this->DM_MP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_MP->Param, "CustomMsg");
        $this->Fields['DM_MP'] = &$this->DM_MP;

        // DM_GMB
        $this->DM_GMB = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_GMB', 'DM_GMB', '`DM_GMB`', '`DM_GMB`', 200, 50, -1, false, '`DM_GMB`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_GMB->Sortable = true; // Allow sort
        $this->DM_GMB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_GMB->Param, "CustomMsg");
        $this->Fields['DM_GMB'] = &$this->DM_GMB;

        // DM_WEB
        $this->DM_WEB = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_WEB', 'DM_WEB', '`DM_WEB`', '`DM_WEB`', 200, 50, -1, false, '`DM_WEB`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_WEB->Sortable = true; // Allow sort
        $this->DM_WEB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_WEB->Param, "CustomMsg");
        $this->Fields['DM_WEB'] = &$this->DM_WEB;

        // DM_UPDATEMEDSOS
        $this->DM_UPDATEMEDSOS = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_UPDATEMEDSOS', 'DM_UPDATEMEDSOS', '`DM_UPDATEMEDSOS`', '`DM_UPDATEMEDSOS`', 200, 50, -1, false, '`DM_UPDATEMEDSOS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_UPDATEMEDSOS->Sortable = true; // Allow sort
        $this->DM_UPDATEMEDSOS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_UPDATEMEDSOS->Param, "CustomMsg");
        $this->Fields['DM_UPDATEMEDSOS'] = &$this->DM_UPDATEMEDSOS;

        // DM_UPDATEWEBSITE
        $this->DM_UPDATEWEBSITE = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_UPDATEWEBSITE', 'DM_UPDATEWEBSITE', '`DM_UPDATEWEBSITE`', '`DM_UPDATEWEBSITE`', 200, 50, -1, false, '`DM_UPDATEWEBSITE`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_UPDATEWEBSITE->Sortable = true; // Allow sort
        $this->DM_UPDATEWEBSITE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_UPDATEWEBSITE->Param, "CustomMsg");
        $this->Fields['DM_UPDATEWEBSITE'] = &$this->DM_UPDATEWEBSITE;

        // DM_GOOGLEINDEX
        $this->DM_GOOGLEINDEX = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_GOOGLEINDEX', 'DM_GOOGLEINDEX', '`DM_GOOGLEINDEX`', '`DM_GOOGLEINDEX`', 200, 50, -1, false, '`DM_GOOGLEINDEX`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_GOOGLEINDEX->Sortable = true; // Allow sort
        $this->DM_GOOGLEINDEX->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_GOOGLEINDEX->Param, "CustomMsg");
        $this->Fields['DM_GOOGLEINDEX'] = &$this->DM_GOOGLEINDEX;

        // DM_IKLANBERBAYAR
        $this->DM_IKLANBERBAYAR = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_DM_IKLANBERBAYAR', 'DM_IKLANBERBAYAR', '`DM_IKLANBERBAYAR`', '`DM_IKLANBERBAYAR`', 200, 50, -1, false, '`DM_IKLANBERBAYAR`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DM_IKLANBERBAYAR->Sortable = true; // Allow sort
        $this->DM_IKLANBERBAYAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DM_IKLANBERBAYAR->Param, "CustomMsg");
        $this->Fields['DM_IKLANBERBAYAR'] = &$this->DM_IKLANBERBAYAR;

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_NAMA_PEMILIK', 'NAMA_PEMILIK', '`NAMA_PEMILIK`', '`NAMA_PEMILIK`', 200, 100, -1, false, '`NAMA_PEMILIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PEMILIK->Sortable = true; // Allow sort
        $this->NAMA_PEMILIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PEMILIK->Param, "CustomMsg");
        $this->Fields['NAMA_PEMILIK'] = &$this->NAMA_PEMILIK;

        // NAMA_USAHA
        $this->NAMA_USAHA = new DbField('cetak_aspek_pemasaran_online', 'cetak_aspek_pemasaran_online', 'x_NAMA_USAHA', 'NAMA_USAHA', '`NAMA_USAHA`', '`NAMA_USAHA`', 200, 100, -1, false, '`NAMA_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_USAHA->Sortable = true; // Allow sort
        $this->NAMA_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_USAHA->Param, "CustomMsg");
        $this->Fields['NAMA_USAHA'] = &$this->NAMA_USAHA;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`cetak_aspek_pemasaran_online`";
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
            if (array_key_exists('NIK', $rs)) {
                AddFilter($where, QuotedName('NIK', $this->Dbid) . '=' . QuotedValue($rs['NIK'], $this->NIK->DataType, $this->Dbid));
            }
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
        $this->NIK->DbValue = $row['NIK'];
        $this->DM_CHATTING->DbValue = $row['DM_CHATTING'];
        $this->DM_MEDSOS->DbValue = $row['DM_MEDSOS'];
        $this->DM_MP->DbValue = $row['DM_MP'];
        $this->DM_GMB->DbValue = $row['DM_GMB'];
        $this->DM_WEB->DbValue = $row['DM_WEB'];
        $this->DM_UPDATEMEDSOS->DbValue = $row['DM_UPDATEMEDSOS'];
        $this->DM_UPDATEWEBSITE->DbValue = $row['DM_UPDATEWEBSITE'];
        $this->DM_GOOGLEINDEX->DbValue = $row['DM_GOOGLEINDEX'];
        $this->DM_IKLANBERBAYAR->DbValue = $row['DM_IKLANBERBAYAR'];
        $this->NAMA_PEMILIK->DbValue = $row['NAMA_PEMILIK'];
        $this->NAMA_USAHA->DbValue = $row['NAMA_USAHA'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`NIK` = '@NIK@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->NIK->CurrentValue : $this->NIK->OldValue;
        if (EmptyValue($val)) {
            return "";
        } else {
            $keys[] = $val;
        }
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 1) {
            if ($current) {
                $this->NIK->CurrentValue = $keys[0];
            } else {
                $this->NIK->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('NIK', $row) ? $row['NIK'] : null;
        } else {
            $val = $this->NIK->OldValue !== null ? $this->NIK->OldValue : $this->NIK->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@NIK@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
        }
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
        return $_SESSION[$name] ?? GetUrl("cetakaspekpemasaranonlinelist");
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
        if ($pageName == "cetakaspekpemasaranonlineview") {
            return $Language->phrase("View");
        } elseif ($pageName == "cetakaspekpemasaranonlineedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "cetakaspekpemasaranonlineadd") {
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
                return "CetakAspekPemasaranOnlineView";
            case Config("API_ADD_ACTION"):
                return "CetakAspekPemasaranOnlineAdd";
            case Config("API_EDIT_ACTION"):
                return "CetakAspekPemasaranOnlineEdit";
            case Config("API_DELETE_ACTION"):
                return "CetakAspekPemasaranOnlineDelete";
            case Config("API_LIST_ACTION"):
                return "CetakAspekPemasaranOnlineList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "cetakaspekpemasaranonlinelist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("cetakaspekpemasaranonlineview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("cetakaspekpemasaranonlineview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "cetakaspekpemasaranonlineadd?" . $this->getUrlParm($parm);
        } else {
            $url = "cetakaspekpemasaranonlineadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("cetakaspekpemasaranonlineedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("cetakaspekpemasaranonlineadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("cetakaspekpemasaranonlinedelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "NIK:" . JsonEncode($this->NIK->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->NIK->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->NIK->CurrentValue);
        } else {
            return "javascript:ew.alert(ew.language.phrase('InvalidRecord'));";
        }
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
            if (($keyValue = Param("NIK") ?? Route("NIK")) !== null) {
                $arKeys[] = $keyValue;
            } elseif (IsApi() && (($keyValue = Key(0) ?? Route(2)) !== null)) {
                $arKeys[] = $keyValue;
            } else {
                $arKeys = null; // Do not setup
            }

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
            if ($setCurrent) {
                $this->NIK->CurrentValue = $key;
            } else {
                $this->NIK->OldValue = $key;
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
        $this->NIK->setDbValue($row['NIK']);
        $this->DM_CHATTING->setDbValue($row['DM_CHATTING']);
        $this->DM_MEDSOS->setDbValue($row['DM_MEDSOS']);
        $this->DM_MP->setDbValue($row['DM_MP']);
        $this->DM_GMB->setDbValue($row['DM_GMB']);
        $this->DM_WEB->setDbValue($row['DM_WEB']);
        $this->DM_UPDATEMEDSOS->setDbValue($row['DM_UPDATEMEDSOS']);
        $this->DM_UPDATEWEBSITE->setDbValue($row['DM_UPDATEWEBSITE']);
        $this->DM_GOOGLEINDEX->setDbValue($row['DM_GOOGLEINDEX']);
        $this->DM_IKLANBERBAYAR->setDbValue($row['DM_IKLANBERBAYAR']);
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NIK

        // DM_CHATTING

        // DM_MEDSOS

        // DM_MP

        // DM_GMB

        // DM_WEB

        // DM_UPDATEMEDSOS

        // DM_UPDATEWEBSITE

        // DM_GOOGLEINDEX

        // DM_IKLANBERBAYAR

        // NAMA_PEMILIK

        // NAMA_USAHA

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // DM_CHATTING
        $this->DM_CHATTING->ViewValue = $this->DM_CHATTING->CurrentValue;
        $this->DM_CHATTING->ViewCustomAttributes = "";

        // DM_MEDSOS
        $this->DM_MEDSOS->ViewValue = $this->DM_MEDSOS->CurrentValue;
        $this->DM_MEDSOS->ViewCustomAttributes = "";

        // DM_MP
        $this->DM_MP->ViewValue = $this->DM_MP->CurrentValue;
        $this->DM_MP->ViewCustomAttributes = "";

        // DM_GMB
        $this->DM_GMB->ViewValue = $this->DM_GMB->CurrentValue;
        $this->DM_GMB->ViewCustomAttributes = "";

        // DM_WEB
        $this->DM_WEB->ViewValue = $this->DM_WEB->CurrentValue;
        $this->DM_WEB->ViewCustomAttributes = "";

        // DM_UPDATEMEDSOS
        $this->DM_UPDATEMEDSOS->ViewValue = $this->DM_UPDATEMEDSOS->CurrentValue;
        $this->DM_UPDATEMEDSOS->ViewCustomAttributes = "";

        // DM_UPDATEWEBSITE
        $this->DM_UPDATEWEBSITE->ViewValue = $this->DM_UPDATEWEBSITE->CurrentValue;
        $this->DM_UPDATEWEBSITE->ViewCustomAttributes = "";

        // DM_GOOGLEINDEX
        $this->DM_GOOGLEINDEX->ViewValue = $this->DM_GOOGLEINDEX->CurrentValue;
        $this->DM_GOOGLEINDEX->ViewCustomAttributes = "";

        // DM_IKLANBERBAYAR
        $this->DM_IKLANBERBAYAR->ViewValue = $this->DM_IKLANBERBAYAR->CurrentValue;
        $this->DM_IKLANBERBAYAR->ViewCustomAttributes = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->ViewCustomAttributes = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // DM_CHATTING
        $this->DM_CHATTING->LinkCustomAttributes = "";
        $this->DM_CHATTING->HrefValue = "";
        $this->DM_CHATTING->TooltipValue = "";

        // DM_MEDSOS
        $this->DM_MEDSOS->LinkCustomAttributes = "";
        $this->DM_MEDSOS->HrefValue = "";
        $this->DM_MEDSOS->TooltipValue = "";

        // DM_MP
        $this->DM_MP->LinkCustomAttributes = "";
        $this->DM_MP->HrefValue = "";
        $this->DM_MP->TooltipValue = "";

        // DM_GMB
        $this->DM_GMB->LinkCustomAttributes = "";
        $this->DM_GMB->HrefValue = "";
        $this->DM_GMB->TooltipValue = "";

        // DM_WEB
        $this->DM_WEB->LinkCustomAttributes = "";
        $this->DM_WEB->HrefValue = "";
        $this->DM_WEB->TooltipValue = "";

        // DM_UPDATEMEDSOS
        $this->DM_UPDATEMEDSOS->LinkCustomAttributes = "";
        $this->DM_UPDATEMEDSOS->HrefValue = "";
        $this->DM_UPDATEMEDSOS->TooltipValue = "";

        // DM_UPDATEWEBSITE
        $this->DM_UPDATEWEBSITE->LinkCustomAttributes = "";
        $this->DM_UPDATEWEBSITE->HrefValue = "";
        $this->DM_UPDATEWEBSITE->TooltipValue = "";

        // DM_GOOGLEINDEX
        $this->DM_GOOGLEINDEX->LinkCustomAttributes = "";
        $this->DM_GOOGLEINDEX->HrefValue = "";
        $this->DM_GOOGLEINDEX->TooltipValue = "";

        // DM_IKLANBERBAYAR
        $this->DM_IKLANBERBAYAR->LinkCustomAttributes = "";
        $this->DM_IKLANBERBAYAR->HrefValue = "";
        $this->DM_IKLANBERBAYAR->TooltipValue = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->LinkCustomAttributes = "";
        $this->NAMA_PEMILIK->HrefValue = "";
        $this->NAMA_PEMILIK->TooltipValue = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->LinkCustomAttributes = "";
        $this->NAMA_USAHA->HrefValue = "";
        $this->NAMA_USAHA->TooltipValue = "";

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

        // NIK
        $this->NIK->EditAttrs["class"] = "form-control";
        $this->NIK->EditCustomAttributes = "";
        if (!$this->NIK->Raw) {
            $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
        }
        $this->NIK->EditValue = $this->NIK->CurrentValue;
        $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

        // DM_CHATTING
        $this->DM_CHATTING->EditAttrs["class"] = "form-control";
        $this->DM_CHATTING->EditCustomAttributes = "";
        if (!$this->DM_CHATTING->Raw) {
            $this->DM_CHATTING->CurrentValue = HtmlDecode($this->DM_CHATTING->CurrentValue);
        }
        $this->DM_CHATTING->EditValue = $this->DM_CHATTING->CurrentValue;
        $this->DM_CHATTING->PlaceHolder = RemoveHtml($this->DM_CHATTING->caption());

        // DM_MEDSOS
        $this->DM_MEDSOS->EditAttrs["class"] = "form-control";
        $this->DM_MEDSOS->EditCustomAttributes = "";
        if (!$this->DM_MEDSOS->Raw) {
            $this->DM_MEDSOS->CurrentValue = HtmlDecode($this->DM_MEDSOS->CurrentValue);
        }
        $this->DM_MEDSOS->EditValue = $this->DM_MEDSOS->CurrentValue;
        $this->DM_MEDSOS->PlaceHolder = RemoveHtml($this->DM_MEDSOS->caption());

        // DM_MP
        $this->DM_MP->EditAttrs["class"] = "form-control";
        $this->DM_MP->EditCustomAttributes = "";
        if (!$this->DM_MP->Raw) {
            $this->DM_MP->CurrentValue = HtmlDecode($this->DM_MP->CurrentValue);
        }
        $this->DM_MP->EditValue = $this->DM_MP->CurrentValue;
        $this->DM_MP->PlaceHolder = RemoveHtml($this->DM_MP->caption());

        // DM_GMB
        $this->DM_GMB->EditAttrs["class"] = "form-control";
        $this->DM_GMB->EditCustomAttributes = "";
        if (!$this->DM_GMB->Raw) {
            $this->DM_GMB->CurrentValue = HtmlDecode($this->DM_GMB->CurrentValue);
        }
        $this->DM_GMB->EditValue = $this->DM_GMB->CurrentValue;
        $this->DM_GMB->PlaceHolder = RemoveHtml($this->DM_GMB->caption());

        // DM_WEB
        $this->DM_WEB->EditAttrs["class"] = "form-control";
        $this->DM_WEB->EditCustomAttributes = "";
        if (!$this->DM_WEB->Raw) {
            $this->DM_WEB->CurrentValue = HtmlDecode($this->DM_WEB->CurrentValue);
        }
        $this->DM_WEB->EditValue = $this->DM_WEB->CurrentValue;
        $this->DM_WEB->PlaceHolder = RemoveHtml($this->DM_WEB->caption());

        // DM_UPDATEMEDSOS
        $this->DM_UPDATEMEDSOS->EditAttrs["class"] = "form-control";
        $this->DM_UPDATEMEDSOS->EditCustomAttributes = "";
        if (!$this->DM_UPDATEMEDSOS->Raw) {
            $this->DM_UPDATEMEDSOS->CurrentValue = HtmlDecode($this->DM_UPDATEMEDSOS->CurrentValue);
        }
        $this->DM_UPDATEMEDSOS->EditValue = $this->DM_UPDATEMEDSOS->CurrentValue;
        $this->DM_UPDATEMEDSOS->PlaceHolder = RemoveHtml($this->DM_UPDATEMEDSOS->caption());

        // DM_UPDATEWEBSITE
        $this->DM_UPDATEWEBSITE->EditAttrs["class"] = "form-control";
        $this->DM_UPDATEWEBSITE->EditCustomAttributes = "";
        if (!$this->DM_UPDATEWEBSITE->Raw) {
            $this->DM_UPDATEWEBSITE->CurrentValue = HtmlDecode($this->DM_UPDATEWEBSITE->CurrentValue);
        }
        $this->DM_UPDATEWEBSITE->EditValue = $this->DM_UPDATEWEBSITE->CurrentValue;
        $this->DM_UPDATEWEBSITE->PlaceHolder = RemoveHtml($this->DM_UPDATEWEBSITE->caption());

        // DM_GOOGLEINDEX
        $this->DM_GOOGLEINDEX->EditAttrs["class"] = "form-control";
        $this->DM_GOOGLEINDEX->EditCustomAttributes = "";
        if (!$this->DM_GOOGLEINDEX->Raw) {
            $this->DM_GOOGLEINDEX->CurrentValue = HtmlDecode($this->DM_GOOGLEINDEX->CurrentValue);
        }
        $this->DM_GOOGLEINDEX->EditValue = $this->DM_GOOGLEINDEX->CurrentValue;
        $this->DM_GOOGLEINDEX->PlaceHolder = RemoveHtml($this->DM_GOOGLEINDEX->caption());

        // DM_IKLANBERBAYAR
        $this->DM_IKLANBERBAYAR->EditAttrs["class"] = "form-control";
        $this->DM_IKLANBERBAYAR->EditCustomAttributes = "";
        if (!$this->DM_IKLANBERBAYAR->Raw) {
            $this->DM_IKLANBERBAYAR->CurrentValue = HtmlDecode($this->DM_IKLANBERBAYAR->CurrentValue);
        }
        $this->DM_IKLANBERBAYAR->EditValue = $this->DM_IKLANBERBAYAR->CurrentValue;
        $this->DM_IKLANBERBAYAR->PlaceHolder = RemoveHtml($this->DM_IKLANBERBAYAR->caption());

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
        $this->NAMA_PEMILIK->EditCustomAttributes = "";
        if (!$this->NAMA_PEMILIK->Raw) {
            $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
        }
        $this->NAMA_PEMILIK->EditValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

        // NAMA_USAHA
        $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
        $this->NAMA_USAHA->EditCustomAttributes = "";
        if (!$this->NAMA_USAHA->Raw) {
            $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
        }
        $this->NAMA_USAHA->EditValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

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
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->DM_CHATTING);
                    $doc->exportCaption($this->DM_MEDSOS);
                    $doc->exportCaption($this->DM_MP);
                    $doc->exportCaption($this->DM_GMB);
                    $doc->exportCaption($this->DM_WEB);
                    $doc->exportCaption($this->DM_UPDATEMEDSOS);
                    $doc->exportCaption($this->DM_UPDATEWEBSITE);
                    $doc->exportCaption($this->DM_GOOGLEINDEX);
                    $doc->exportCaption($this->DM_IKLANBERBAYAR);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->NAMA_USAHA);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->DM_CHATTING);
                    $doc->exportCaption($this->DM_MEDSOS);
                    $doc->exportCaption($this->DM_MP);
                    $doc->exportCaption($this->DM_GMB);
                    $doc->exportCaption($this->DM_WEB);
                    $doc->exportCaption($this->DM_UPDATEMEDSOS);
                    $doc->exportCaption($this->DM_UPDATEWEBSITE);
                    $doc->exportCaption($this->DM_GOOGLEINDEX);
                    $doc->exportCaption($this->DM_IKLANBERBAYAR);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->NAMA_USAHA);
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
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->DM_CHATTING);
                        $doc->exportField($this->DM_MEDSOS);
                        $doc->exportField($this->DM_MP);
                        $doc->exportField($this->DM_GMB);
                        $doc->exportField($this->DM_WEB);
                        $doc->exportField($this->DM_UPDATEMEDSOS);
                        $doc->exportField($this->DM_UPDATEWEBSITE);
                        $doc->exportField($this->DM_GOOGLEINDEX);
                        $doc->exportField($this->DM_IKLANBERBAYAR);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->NAMA_USAHA);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->DM_CHATTING);
                        $doc->exportField($this->DM_MEDSOS);
                        $doc->exportField($this->DM_MP);
                        $doc->exportField($this->DM_GMB);
                        $doc->exportField($this->DM_WEB);
                        $doc->exportField($this->DM_UPDATEMEDSOS);
                        $doc->exportField($this->DM_UPDATEWEBSITE);
                        $doc->exportField($this->DM_GOOGLEINDEX);
                        $doc->exportField($this->DM_IKLANBERBAYAR);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->NAMA_USAHA);
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
