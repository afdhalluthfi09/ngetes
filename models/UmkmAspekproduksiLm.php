<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for umkm_aspekproduksi_lm
 */
class UmkmAspekproduksiLm extends DbTable
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
    public $PROD_FREKUENSIPRODUKSI;
    public $PROD_KAPASITAS;
    public $PROD_KEAMANANPANGAN;
    public $PROD_SNI;
    public $PROD_KEMASAN;
    public $PROD_KETERSEDIAANBAHANBAKU;
    public $PROD_ALATPRODUKSI;
    public $PROD_GUDANGPENYIMPAN;
    public $PROD_LAYOUTPRODUKSI;
    public $PROD_SOP;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'umkm_aspekproduksi_lm';
        $this->TableName = 'umkm_aspekproduksi_lm';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`umkm_aspekproduksi_lm`";
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

        // NIK
        $this->NIK = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Required = true; // Required field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // PROD_FREKUENSIPRODUKSI
        $this->PROD_FREKUENSIPRODUKSI = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_FREKUENSIPRODUKSI', 'PROD_FREKUENSIPRODUKSI', '`PROD_FREKUENSIPRODUKSI`', '`PROD_FREKUENSIPRODUKSI`', 200, 50, -1, false, '`PROD_FREKUENSIPRODUKSI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_FREKUENSIPRODUKSI->Sortable = true; // Allow sort
        $this->PROD_FREKUENSIPRODUKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_FREKUENSIPRODUKSI->Param, "CustomMsg");
        $this->Fields['PROD_FREKUENSIPRODUKSI'] = &$this->PROD_FREKUENSIPRODUKSI;

        // PROD_KAPASITAS
        $this->PROD_KAPASITAS = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_KAPASITAS', 'PROD_KAPASITAS', '`PROD_KAPASITAS`', '`PROD_KAPASITAS`', 200, 50, -1, false, '`PROD_KAPASITAS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_KAPASITAS->Sortable = true; // Allow sort
        $this->PROD_KAPASITAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_KAPASITAS->Param, "CustomMsg");
        $this->Fields['PROD_KAPASITAS'] = &$this->PROD_KAPASITAS;

        // PROD_KEAMANANPANGAN
        $this->PROD_KEAMANANPANGAN = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_KEAMANANPANGAN', 'PROD_KEAMANANPANGAN', '`PROD_KEAMANANPANGAN`', '`PROD_KEAMANANPANGAN`', 200, 50, -1, false, '`PROD_KEAMANANPANGAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_KEAMANANPANGAN->Sortable = true; // Allow sort
        $this->PROD_KEAMANANPANGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_KEAMANANPANGAN->Param, "CustomMsg");
        $this->Fields['PROD_KEAMANANPANGAN'] = &$this->PROD_KEAMANANPANGAN;

        // PROD_SNI
        $this->PROD_SNI = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_SNI', 'PROD_SNI', '`PROD_SNI`', '`PROD_SNI`', 200, 50, -1, false, '`PROD_SNI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_SNI->Sortable = true; // Allow sort
        $this->PROD_SNI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_SNI->Param, "CustomMsg");
        $this->Fields['PROD_SNI'] = &$this->PROD_SNI;

        // PROD_KEMASAN
        $this->PROD_KEMASAN = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_KEMASAN', 'PROD_KEMASAN', '`PROD_KEMASAN`', '`PROD_KEMASAN`', 200, 50, -1, false, '`PROD_KEMASAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_KEMASAN->Sortable = true; // Allow sort
        $this->PROD_KEMASAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_KEMASAN->Param, "CustomMsg");
        $this->Fields['PROD_KEMASAN'] = &$this->PROD_KEMASAN;

        // PROD_KETERSEDIAANBAHANBAKU
        $this->PROD_KETERSEDIAANBAHANBAKU = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_KETERSEDIAANBAHANBAKU', 'PROD_KETERSEDIAANBAHANBAKU', '`PROD_KETERSEDIAANBAHANBAKU`', '`PROD_KETERSEDIAANBAHANBAKU`', 200, 50, -1, false, '`PROD_KETERSEDIAANBAHANBAKU`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_KETERSEDIAANBAHANBAKU->Sortable = true; // Allow sort
        $this->PROD_KETERSEDIAANBAHANBAKU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_KETERSEDIAANBAHANBAKU->Param, "CustomMsg");
        $this->Fields['PROD_KETERSEDIAANBAHANBAKU'] = &$this->PROD_KETERSEDIAANBAHANBAKU;

        // PROD_ALATPRODUKSI
        $this->PROD_ALATPRODUKSI = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_ALATPRODUKSI', 'PROD_ALATPRODUKSI', '`PROD_ALATPRODUKSI`', '`PROD_ALATPRODUKSI`', 200, 50, -1, false, '`PROD_ALATPRODUKSI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_ALATPRODUKSI->Sortable = true; // Allow sort
        $this->PROD_ALATPRODUKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_ALATPRODUKSI->Param, "CustomMsg");
        $this->Fields['PROD_ALATPRODUKSI'] = &$this->PROD_ALATPRODUKSI;

        // PROD_GUDANGPENYIMPAN
        $this->PROD_GUDANGPENYIMPAN = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_GUDANGPENYIMPAN', 'PROD_GUDANGPENYIMPAN', '`PROD_GUDANGPENYIMPAN`', '`PROD_GUDANGPENYIMPAN`', 200, 50, -1, false, '`PROD_GUDANGPENYIMPAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_GUDANGPENYIMPAN->Sortable = true; // Allow sort
        $this->PROD_GUDANGPENYIMPAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_GUDANGPENYIMPAN->Param, "CustomMsg");
        $this->Fields['PROD_GUDANGPENYIMPAN'] = &$this->PROD_GUDANGPENYIMPAN;

        // PROD_LAYOUTPRODUKSI
        $this->PROD_LAYOUTPRODUKSI = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_LAYOUTPRODUKSI', 'PROD_LAYOUTPRODUKSI', '`PROD_LAYOUTPRODUKSI`', '`PROD_LAYOUTPRODUKSI`', 200, 50, -1, false, '`PROD_LAYOUTPRODUKSI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_LAYOUTPRODUKSI->Sortable = true; // Allow sort
        $this->PROD_LAYOUTPRODUKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_LAYOUTPRODUKSI->Param, "CustomMsg");
        $this->Fields['PROD_LAYOUTPRODUKSI'] = &$this->PROD_LAYOUTPRODUKSI;

        // PROD_SOP
        $this->PROD_SOP = new DbField('umkm_aspekproduksi_lm', 'umkm_aspekproduksi_lm', 'x_PROD_SOP', 'PROD_SOP', '`PROD_SOP`', '`PROD_SOP`', 200, 50, -1, false, '`PROD_SOP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->PROD_SOP->Sortable = true; // Allow sort
        $this->PROD_SOP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROD_SOP->Param, "CustomMsg");
        $this->Fields['PROD_SOP'] = &$this->PROD_SOP;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`umkm_aspekproduksi_lm`";
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
        $this->PROD_FREKUENSIPRODUKSI->DbValue = $row['PROD_FREKUENSIPRODUKSI'];
        $this->PROD_KAPASITAS->DbValue = $row['PROD_KAPASITAS'];
        $this->PROD_KEAMANANPANGAN->DbValue = $row['PROD_KEAMANANPANGAN'];
        $this->PROD_SNI->DbValue = $row['PROD_SNI'];
        $this->PROD_KEMASAN->DbValue = $row['PROD_KEMASAN'];
        $this->PROD_KETERSEDIAANBAHANBAKU->DbValue = $row['PROD_KETERSEDIAANBAHANBAKU'];
        $this->PROD_ALATPRODUKSI->DbValue = $row['PROD_ALATPRODUKSI'];
        $this->PROD_GUDANGPENYIMPAN->DbValue = $row['PROD_GUDANGPENYIMPAN'];
        $this->PROD_LAYOUTPRODUKSI->DbValue = $row['PROD_LAYOUTPRODUKSI'];
        $this->PROD_SOP->DbValue = $row['PROD_SOP'];
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
        return $_SESSION[$name] ?? GetUrl("umkmaspekproduksilmlist");
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
        if ($pageName == "umkmaspekproduksilmview") {
            return $Language->phrase("View");
        } elseif ($pageName == "umkmaspekproduksilmedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "umkmaspekproduksilmadd") {
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
                return "UmkmAspekproduksiLmView";
            case Config("API_ADD_ACTION"):
                return "UmkmAspekproduksiLmAdd";
            case Config("API_EDIT_ACTION"):
                return "UmkmAspekproduksiLmEdit";
            case Config("API_DELETE_ACTION"):
                return "UmkmAspekproduksiLmDelete";
            case Config("API_LIST_ACTION"):
                return "UmkmAspekproduksiLmList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "umkmaspekproduksilmlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmaspekproduksilmview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmaspekproduksilmview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "umkmaspekproduksilmadd?" . $this->getUrlParm($parm);
        } else {
            $url = "umkmaspekproduksilmadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("umkmaspekproduksilmedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("umkmaspekproduksilmadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("umkmaspekproduksilmdelete", $this->getUrlParm());
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

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NIK

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

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // PROD_FREKUENSIPRODUKSI
        $this->PROD_FREKUENSIPRODUKSI->ViewValue = $this->PROD_FREKUENSIPRODUKSI->CurrentValue;
        $this->PROD_FREKUENSIPRODUKSI->ViewCustomAttributes = "";

        // PROD_KAPASITAS
        $this->PROD_KAPASITAS->ViewValue = $this->PROD_KAPASITAS->CurrentValue;
        $this->PROD_KAPASITAS->ViewCustomAttributes = "";

        // PROD_KEAMANANPANGAN
        $this->PROD_KEAMANANPANGAN->ViewValue = $this->PROD_KEAMANANPANGAN->CurrentValue;
        $this->PROD_KEAMANANPANGAN->ViewCustomAttributes = "";

        // PROD_SNI
        $this->PROD_SNI->ViewValue = $this->PROD_SNI->CurrentValue;
        $this->PROD_SNI->ViewCustomAttributes = "";

        // PROD_KEMASAN
        $this->PROD_KEMASAN->ViewValue = $this->PROD_KEMASAN->CurrentValue;
        $this->PROD_KEMASAN->ViewCustomAttributes = "";

        // PROD_KETERSEDIAANBAHANBAKU
        $this->PROD_KETERSEDIAANBAHANBAKU->ViewValue = $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue;
        $this->PROD_KETERSEDIAANBAHANBAKU->ViewCustomAttributes = "";

        // PROD_ALATPRODUKSI
        $this->PROD_ALATPRODUKSI->ViewValue = $this->PROD_ALATPRODUKSI->CurrentValue;
        $this->PROD_ALATPRODUKSI->ViewCustomAttributes = "";

        // PROD_GUDANGPENYIMPAN
        $this->PROD_GUDANGPENYIMPAN->ViewValue = $this->PROD_GUDANGPENYIMPAN->CurrentValue;
        $this->PROD_GUDANGPENYIMPAN->ViewCustomAttributes = "";

        // PROD_LAYOUTPRODUKSI
        $this->PROD_LAYOUTPRODUKSI->ViewValue = $this->PROD_LAYOUTPRODUKSI->CurrentValue;
        $this->PROD_LAYOUTPRODUKSI->ViewCustomAttributes = "";

        // PROD_SOP
        $this->PROD_SOP->ViewValue = $this->PROD_SOP->CurrentValue;
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

        // PROD_FREKUENSIPRODUKSI
        $this->PROD_FREKUENSIPRODUKSI->EditAttrs["class"] = "form-control";
        $this->PROD_FREKUENSIPRODUKSI->EditCustomAttributes = "";
        if (!$this->PROD_FREKUENSIPRODUKSI->Raw) {
            $this->PROD_FREKUENSIPRODUKSI->CurrentValue = HtmlDecode($this->PROD_FREKUENSIPRODUKSI->CurrentValue);
        }
        $this->PROD_FREKUENSIPRODUKSI->EditValue = $this->PROD_FREKUENSIPRODUKSI->CurrentValue;
        $this->PROD_FREKUENSIPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_FREKUENSIPRODUKSI->caption());

        // PROD_KAPASITAS
        $this->PROD_KAPASITAS->EditAttrs["class"] = "form-control";
        $this->PROD_KAPASITAS->EditCustomAttributes = "";
        if (!$this->PROD_KAPASITAS->Raw) {
            $this->PROD_KAPASITAS->CurrentValue = HtmlDecode($this->PROD_KAPASITAS->CurrentValue);
        }
        $this->PROD_KAPASITAS->EditValue = $this->PROD_KAPASITAS->CurrentValue;
        $this->PROD_KAPASITAS->PlaceHolder = RemoveHtml($this->PROD_KAPASITAS->caption());

        // PROD_KEAMANANPANGAN
        $this->PROD_KEAMANANPANGAN->EditAttrs["class"] = "form-control";
        $this->PROD_KEAMANANPANGAN->EditCustomAttributes = "";
        if (!$this->PROD_KEAMANANPANGAN->Raw) {
            $this->PROD_KEAMANANPANGAN->CurrentValue = HtmlDecode($this->PROD_KEAMANANPANGAN->CurrentValue);
        }
        $this->PROD_KEAMANANPANGAN->EditValue = $this->PROD_KEAMANANPANGAN->CurrentValue;
        $this->PROD_KEAMANANPANGAN->PlaceHolder = RemoveHtml($this->PROD_KEAMANANPANGAN->caption());

        // PROD_SNI
        $this->PROD_SNI->EditAttrs["class"] = "form-control";
        $this->PROD_SNI->EditCustomAttributes = "";
        if (!$this->PROD_SNI->Raw) {
            $this->PROD_SNI->CurrentValue = HtmlDecode($this->PROD_SNI->CurrentValue);
        }
        $this->PROD_SNI->EditValue = $this->PROD_SNI->CurrentValue;
        $this->PROD_SNI->PlaceHolder = RemoveHtml($this->PROD_SNI->caption());

        // PROD_KEMASAN
        $this->PROD_KEMASAN->EditAttrs["class"] = "form-control";
        $this->PROD_KEMASAN->EditCustomAttributes = "";
        if (!$this->PROD_KEMASAN->Raw) {
            $this->PROD_KEMASAN->CurrentValue = HtmlDecode($this->PROD_KEMASAN->CurrentValue);
        }
        $this->PROD_KEMASAN->EditValue = $this->PROD_KEMASAN->CurrentValue;
        $this->PROD_KEMASAN->PlaceHolder = RemoveHtml($this->PROD_KEMASAN->caption());

        // PROD_KETERSEDIAANBAHANBAKU
        $this->PROD_KETERSEDIAANBAHANBAKU->EditAttrs["class"] = "form-control";
        $this->PROD_KETERSEDIAANBAHANBAKU->EditCustomAttributes = "";
        if (!$this->PROD_KETERSEDIAANBAHANBAKU->Raw) {
            $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue = HtmlDecode($this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue);
        }
        $this->PROD_KETERSEDIAANBAHANBAKU->EditValue = $this->PROD_KETERSEDIAANBAHANBAKU->CurrentValue;
        $this->PROD_KETERSEDIAANBAHANBAKU->PlaceHolder = RemoveHtml($this->PROD_KETERSEDIAANBAHANBAKU->caption());

        // PROD_ALATPRODUKSI
        $this->PROD_ALATPRODUKSI->EditAttrs["class"] = "form-control";
        $this->PROD_ALATPRODUKSI->EditCustomAttributes = "";
        if (!$this->PROD_ALATPRODUKSI->Raw) {
            $this->PROD_ALATPRODUKSI->CurrentValue = HtmlDecode($this->PROD_ALATPRODUKSI->CurrentValue);
        }
        $this->PROD_ALATPRODUKSI->EditValue = $this->PROD_ALATPRODUKSI->CurrentValue;
        $this->PROD_ALATPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_ALATPRODUKSI->caption());

        // PROD_GUDANGPENYIMPAN
        $this->PROD_GUDANGPENYIMPAN->EditAttrs["class"] = "form-control";
        $this->PROD_GUDANGPENYIMPAN->EditCustomAttributes = "";
        if (!$this->PROD_GUDANGPENYIMPAN->Raw) {
            $this->PROD_GUDANGPENYIMPAN->CurrentValue = HtmlDecode($this->PROD_GUDANGPENYIMPAN->CurrentValue);
        }
        $this->PROD_GUDANGPENYIMPAN->EditValue = $this->PROD_GUDANGPENYIMPAN->CurrentValue;
        $this->PROD_GUDANGPENYIMPAN->PlaceHolder = RemoveHtml($this->PROD_GUDANGPENYIMPAN->caption());

        // PROD_LAYOUTPRODUKSI
        $this->PROD_LAYOUTPRODUKSI->EditAttrs["class"] = "form-control";
        $this->PROD_LAYOUTPRODUKSI->EditCustomAttributes = "";
        if (!$this->PROD_LAYOUTPRODUKSI->Raw) {
            $this->PROD_LAYOUTPRODUKSI->CurrentValue = HtmlDecode($this->PROD_LAYOUTPRODUKSI->CurrentValue);
        }
        $this->PROD_LAYOUTPRODUKSI->EditValue = $this->PROD_LAYOUTPRODUKSI->CurrentValue;
        $this->PROD_LAYOUTPRODUKSI->PlaceHolder = RemoveHtml($this->PROD_LAYOUTPRODUKSI->caption());

        // PROD_SOP
        $this->PROD_SOP->EditAttrs["class"] = "form-control";
        $this->PROD_SOP->EditCustomAttributes = "";
        if (!$this->PROD_SOP->Raw) {
            $this->PROD_SOP->CurrentValue = HtmlDecode($this->PROD_SOP->CurrentValue);
        }
        $this->PROD_SOP->EditValue = $this->PROD_SOP->CurrentValue;
        $this->PROD_SOP->PlaceHolder = RemoveHtml($this->PROD_SOP->caption());

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
                    $doc->exportCaption($this->PROD_FREKUENSIPRODUKSI);
                    $doc->exportCaption($this->PROD_KAPASITAS);
                    $doc->exportCaption($this->PROD_KEAMANANPANGAN);
                    $doc->exportCaption($this->PROD_SNI);
                    $doc->exportCaption($this->PROD_KEMASAN);
                    $doc->exportCaption($this->PROD_KETERSEDIAANBAHANBAKU);
                    $doc->exportCaption($this->PROD_ALATPRODUKSI);
                    $doc->exportCaption($this->PROD_GUDANGPENYIMPAN);
                    $doc->exportCaption($this->PROD_LAYOUTPRODUKSI);
                    $doc->exportCaption($this->PROD_SOP);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->PROD_FREKUENSIPRODUKSI);
                    $doc->exportCaption($this->PROD_KAPASITAS);
                    $doc->exportCaption($this->PROD_KEAMANANPANGAN);
                    $doc->exportCaption($this->PROD_SNI);
                    $doc->exportCaption($this->PROD_KEMASAN);
                    $doc->exportCaption($this->PROD_KETERSEDIAANBAHANBAKU);
                    $doc->exportCaption($this->PROD_ALATPRODUKSI);
                    $doc->exportCaption($this->PROD_GUDANGPENYIMPAN);
                    $doc->exportCaption($this->PROD_LAYOUTPRODUKSI);
                    $doc->exportCaption($this->PROD_SOP);
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
                        $doc->exportField($this->PROD_FREKUENSIPRODUKSI);
                        $doc->exportField($this->PROD_KAPASITAS);
                        $doc->exportField($this->PROD_KEAMANANPANGAN);
                        $doc->exportField($this->PROD_SNI);
                        $doc->exportField($this->PROD_KEMASAN);
                        $doc->exportField($this->PROD_KETERSEDIAANBAHANBAKU);
                        $doc->exportField($this->PROD_ALATPRODUKSI);
                        $doc->exportField($this->PROD_GUDANGPENYIMPAN);
                        $doc->exportField($this->PROD_LAYOUTPRODUKSI);
                        $doc->exportField($this->PROD_SOP);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->PROD_FREKUENSIPRODUKSI);
                        $doc->exportField($this->PROD_KAPASITAS);
                        $doc->exportField($this->PROD_KEAMANANPANGAN);
                        $doc->exportField($this->PROD_SNI);
                        $doc->exportField($this->PROD_KEMASAN);
                        $doc->exportField($this->PROD_KETERSEDIAANBAHANBAKU);
                        $doc->exportField($this->PROD_ALATPRODUKSI);
                        $doc->exportField($this->PROD_GUDANGPENYIMPAN);
                        $doc->exportField($this->PROD_LAYOUTPRODUKSI);
                        $doc->exportField($this->PROD_SOP);
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
