<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for Cetak Aspek Sumber Daya Manusia
 */
class CetakAspekSumberDayaManusia extends DbTable
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
    public $SDM_OMS;
    public $SDM_FOKUS;
    public $SDM_TARGET;
    public $SDM_KARYAWANTETAP;
    public $SDM_KARYAWANSUBKON;
    public $SDM_GAJI;
    public $SDM_ASURANSI;
    public $SDM_TUNJANGAN;
    public $SDM_PELATIHAN;
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
        $this->TableVar = 'Cetak_Aspek_Sumber_Daya_Manusia';
        $this->TableName = 'Cetak Aspek Sumber Daya Manusia';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`Cetak Aspek Sumber Daya Manusia`";
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
        $this->NIK = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Required = true; // Required field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // SDM_OMS
        $this->SDM_OMS = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_OMS', 'SDM_OMS', '`SDM_OMS`', '`SDM_OMS`', 200, 50, -1, false, '`SDM_OMS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_OMS->Sortable = true; // Allow sort
        $this->SDM_OMS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_OMS->Param, "CustomMsg");
        $this->Fields['SDM_OMS'] = &$this->SDM_OMS;

        // SDM_FOKUS
        $this->SDM_FOKUS = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_FOKUS', 'SDM_FOKUS', '`SDM_FOKUS`', '`SDM_FOKUS`', 200, 50, -1, false, '`SDM_FOKUS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_FOKUS->Sortable = true; // Allow sort
        $this->SDM_FOKUS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_FOKUS->Param, "CustomMsg");
        $this->Fields['SDM_FOKUS'] = &$this->SDM_FOKUS;

        // SDM_TARGET
        $this->SDM_TARGET = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_TARGET', 'SDM_TARGET', '`SDM_TARGET`', '`SDM_TARGET`', 200, 50, -1, false, '`SDM_TARGET`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_TARGET->Sortable = true; // Allow sort
        $this->SDM_TARGET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_TARGET->Param, "CustomMsg");
        $this->Fields['SDM_TARGET'] = &$this->SDM_TARGET;

        // SDM_KARYAWANTETAP
        $this->SDM_KARYAWANTETAP = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_KARYAWANTETAP', 'SDM_KARYAWANTETAP', '`SDM_KARYAWANTETAP`', '`SDM_KARYAWANTETAP`', 200, 50, -1, false, '`SDM_KARYAWANTETAP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_KARYAWANTETAP->Sortable = true; // Allow sort
        $this->SDM_KARYAWANTETAP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_KARYAWANTETAP->Param, "CustomMsg");
        $this->Fields['SDM_KARYAWANTETAP'] = &$this->SDM_KARYAWANTETAP;

        // SDM_KARYAWANSUBKON
        $this->SDM_KARYAWANSUBKON = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_KARYAWANSUBKON', 'SDM_KARYAWANSUBKON', '`SDM_KARYAWANSUBKON`', '`SDM_KARYAWANSUBKON`', 200, 50, -1, false, '`SDM_KARYAWANSUBKON`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_KARYAWANSUBKON->Sortable = true; // Allow sort
        $this->SDM_KARYAWANSUBKON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_KARYAWANSUBKON->Param, "CustomMsg");
        $this->Fields['SDM_KARYAWANSUBKON'] = &$this->SDM_KARYAWANSUBKON;

        // SDM_GAJI
        $this->SDM_GAJI = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_GAJI', 'SDM_GAJI', '`SDM_GAJI`', '`SDM_GAJI`', 200, 50, -1, false, '`SDM_GAJI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_GAJI->Sortable = true; // Allow sort
        $this->SDM_GAJI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_GAJI->Param, "CustomMsg");
        $this->Fields['SDM_GAJI'] = &$this->SDM_GAJI;

        // SDM_ASURANSI
        $this->SDM_ASURANSI = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_ASURANSI', 'SDM_ASURANSI', '`SDM_ASURANSI`', '`SDM_ASURANSI`', 200, 50, -1, false, '`SDM_ASURANSI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_ASURANSI->Sortable = true; // Allow sort
        $this->SDM_ASURANSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_ASURANSI->Param, "CustomMsg");
        $this->Fields['SDM_ASURANSI'] = &$this->SDM_ASURANSI;

        // SDM_TUNJANGAN
        $this->SDM_TUNJANGAN = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_TUNJANGAN', 'SDM_TUNJANGAN', '`SDM_TUNJANGAN`', '`SDM_TUNJANGAN`', 200, 50, -1, false, '`SDM_TUNJANGAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_TUNJANGAN->Sortable = true; // Allow sort
        $this->SDM_TUNJANGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_TUNJANGAN->Param, "CustomMsg");
        $this->Fields['SDM_TUNJANGAN'] = &$this->SDM_TUNJANGAN;

        // SDM_PELATIHAN
        $this->SDM_PELATIHAN = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_SDM_PELATIHAN', 'SDM_PELATIHAN', '`SDM_PELATIHAN`', '`SDM_PELATIHAN`', 200, 50, -1, false, '`SDM_PELATIHAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SDM_PELATIHAN->Sortable = true; // Allow sort
        $this->SDM_PELATIHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SDM_PELATIHAN->Param, "CustomMsg");
        $this->Fields['SDM_PELATIHAN'] = &$this->SDM_PELATIHAN;

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_NAMA_PEMILIK', 'NAMA_PEMILIK', '`NAMA_PEMILIK`', '`NAMA_PEMILIK`', 200, 100, -1, false, '`NAMA_PEMILIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PEMILIK->Sortable = true; // Allow sort
        $this->NAMA_PEMILIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PEMILIK->Param, "CustomMsg");
        $this->Fields['NAMA_PEMILIK'] = &$this->NAMA_PEMILIK;

        // NAMA_USAHA
        $this->NAMA_USAHA = new DbField('Cetak_Aspek_Sumber_Daya_Manusia', 'Cetak Aspek Sumber Daya Manusia', 'x_NAMA_USAHA', 'NAMA_USAHA', '`NAMA_USAHA`', '`NAMA_USAHA`', 200, 100, -1, false, '`NAMA_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`Cetak Aspek Sumber Daya Manusia`";
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
        $this->SDM_OMS->DbValue = $row['SDM_OMS'];
        $this->SDM_FOKUS->DbValue = $row['SDM_FOKUS'];
        $this->SDM_TARGET->DbValue = $row['SDM_TARGET'];
        $this->SDM_KARYAWANTETAP->DbValue = $row['SDM_KARYAWANTETAP'];
        $this->SDM_KARYAWANSUBKON->DbValue = $row['SDM_KARYAWANSUBKON'];
        $this->SDM_GAJI->DbValue = $row['SDM_GAJI'];
        $this->SDM_ASURANSI->DbValue = $row['SDM_ASURANSI'];
        $this->SDM_TUNJANGAN->DbValue = $row['SDM_TUNJANGAN'];
        $this->SDM_PELATIHAN->DbValue = $row['SDM_PELATIHAN'];
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
        return $_SESSION[$name] ?? GetUrl("cetakaspeksumberdayamanusialist");
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
        if ($pageName == "cetakaspeksumberdayamanusiaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "cetakaspeksumberdayamanusiaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "cetakaspeksumberdayamanusiaadd") {
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
                return "CetakAspekSumberDayaManusiaView";
            case Config("API_ADD_ACTION"):
                return "CetakAspekSumberDayaManusiaAdd";
            case Config("API_EDIT_ACTION"):
                return "CetakAspekSumberDayaManusiaEdit";
            case Config("API_DELETE_ACTION"):
                return "CetakAspekSumberDayaManusiaDelete";
            case Config("API_LIST_ACTION"):
                return "CetakAspekSumberDayaManusiaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "cetakaspeksumberdayamanusialist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("cetakaspeksumberdayamanusiaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("cetakaspeksumberdayamanusiaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "cetakaspeksumberdayamanusiaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "cetakaspeksumberdayamanusiaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("cetakaspeksumberdayamanusiaedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("cetakaspeksumberdayamanusiaadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("cetakaspeksumberdayamanusiadelete", $this->getUrlParm());
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
        $this->SDM_OMS->setDbValue($row['SDM_OMS']);
        $this->SDM_FOKUS->setDbValue($row['SDM_FOKUS']);
        $this->SDM_TARGET->setDbValue($row['SDM_TARGET']);
        $this->SDM_KARYAWANTETAP->setDbValue($row['SDM_KARYAWANTETAP']);
        $this->SDM_KARYAWANSUBKON->setDbValue($row['SDM_KARYAWANSUBKON']);
        $this->SDM_GAJI->setDbValue($row['SDM_GAJI']);
        $this->SDM_ASURANSI->setDbValue($row['SDM_ASURANSI']);
        $this->SDM_TUNJANGAN->setDbValue($row['SDM_TUNJANGAN']);
        $this->SDM_PELATIHAN->setDbValue($row['SDM_PELATIHAN']);
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

        // SDM_OMS

        // SDM_FOKUS

        // SDM_TARGET

        // SDM_KARYAWANTETAP

        // SDM_KARYAWANSUBKON

        // SDM_GAJI

        // SDM_ASURANSI

        // SDM_TUNJANGAN

        // SDM_PELATIHAN

        // NAMA_PEMILIK

        // NAMA_USAHA

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // SDM_OMS
        $this->SDM_OMS->ViewValue = $this->SDM_OMS->CurrentValue;
        $this->SDM_OMS->ViewCustomAttributes = "";

        // SDM_FOKUS
        $this->SDM_FOKUS->ViewValue = $this->SDM_FOKUS->CurrentValue;
        $this->SDM_FOKUS->ViewCustomAttributes = "";

        // SDM_TARGET
        $this->SDM_TARGET->ViewValue = $this->SDM_TARGET->CurrentValue;
        $this->SDM_TARGET->ViewCustomAttributes = "";

        // SDM_KARYAWANTETAP
        $this->SDM_KARYAWANTETAP->ViewValue = $this->SDM_KARYAWANTETAP->CurrentValue;
        $this->SDM_KARYAWANTETAP->ViewCustomAttributes = "";

        // SDM_KARYAWANSUBKON
        $this->SDM_KARYAWANSUBKON->ViewValue = $this->SDM_KARYAWANSUBKON->CurrentValue;
        $this->SDM_KARYAWANSUBKON->ViewCustomAttributes = "";

        // SDM_GAJI
        $this->SDM_GAJI->ViewValue = $this->SDM_GAJI->CurrentValue;
        $this->SDM_GAJI->ViewCustomAttributes = "";

        // SDM_ASURANSI
        $this->SDM_ASURANSI->ViewValue = $this->SDM_ASURANSI->CurrentValue;
        $this->SDM_ASURANSI->ViewCustomAttributes = "";

        // SDM_TUNJANGAN
        $this->SDM_TUNJANGAN->ViewValue = $this->SDM_TUNJANGAN->CurrentValue;
        $this->SDM_TUNJANGAN->ViewCustomAttributes = "";

        // SDM_PELATIHAN
        $this->SDM_PELATIHAN->ViewValue = $this->SDM_PELATIHAN->CurrentValue;
        $this->SDM_PELATIHAN->ViewCustomAttributes = "";

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

        // SDM_OMS
        $this->SDM_OMS->LinkCustomAttributes = "";
        $this->SDM_OMS->HrefValue = "";
        $this->SDM_OMS->TooltipValue = "";

        // SDM_FOKUS
        $this->SDM_FOKUS->LinkCustomAttributes = "";
        $this->SDM_FOKUS->HrefValue = "";
        $this->SDM_FOKUS->TooltipValue = "";

        // SDM_TARGET
        $this->SDM_TARGET->LinkCustomAttributes = "";
        $this->SDM_TARGET->HrefValue = "";
        $this->SDM_TARGET->TooltipValue = "";

        // SDM_KARYAWANTETAP
        $this->SDM_KARYAWANTETAP->LinkCustomAttributes = "";
        $this->SDM_KARYAWANTETAP->HrefValue = "";
        $this->SDM_KARYAWANTETAP->TooltipValue = "";

        // SDM_KARYAWANSUBKON
        $this->SDM_KARYAWANSUBKON->LinkCustomAttributes = "";
        $this->SDM_KARYAWANSUBKON->HrefValue = "";
        $this->SDM_KARYAWANSUBKON->TooltipValue = "";

        // SDM_GAJI
        $this->SDM_GAJI->LinkCustomAttributes = "";
        $this->SDM_GAJI->HrefValue = "";
        $this->SDM_GAJI->TooltipValue = "";

        // SDM_ASURANSI
        $this->SDM_ASURANSI->LinkCustomAttributes = "";
        $this->SDM_ASURANSI->HrefValue = "";
        $this->SDM_ASURANSI->TooltipValue = "";

        // SDM_TUNJANGAN
        $this->SDM_TUNJANGAN->LinkCustomAttributes = "";
        $this->SDM_TUNJANGAN->HrefValue = "";
        $this->SDM_TUNJANGAN->TooltipValue = "";

        // SDM_PELATIHAN
        $this->SDM_PELATIHAN->LinkCustomAttributes = "";
        $this->SDM_PELATIHAN->HrefValue = "";
        $this->SDM_PELATIHAN->TooltipValue = "";

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

        // SDM_OMS
        $this->SDM_OMS->EditAttrs["class"] = "form-control";
        $this->SDM_OMS->EditCustomAttributes = "";
        if (!$this->SDM_OMS->Raw) {
            $this->SDM_OMS->CurrentValue = HtmlDecode($this->SDM_OMS->CurrentValue);
        }
        $this->SDM_OMS->EditValue = $this->SDM_OMS->CurrentValue;
        $this->SDM_OMS->PlaceHolder = RemoveHtml($this->SDM_OMS->caption());

        // SDM_FOKUS
        $this->SDM_FOKUS->EditAttrs["class"] = "form-control";
        $this->SDM_FOKUS->EditCustomAttributes = "";
        if (!$this->SDM_FOKUS->Raw) {
            $this->SDM_FOKUS->CurrentValue = HtmlDecode($this->SDM_FOKUS->CurrentValue);
        }
        $this->SDM_FOKUS->EditValue = $this->SDM_FOKUS->CurrentValue;
        $this->SDM_FOKUS->PlaceHolder = RemoveHtml($this->SDM_FOKUS->caption());

        // SDM_TARGET
        $this->SDM_TARGET->EditAttrs["class"] = "form-control";
        $this->SDM_TARGET->EditCustomAttributes = "";
        if (!$this->SDM_TARGET->Raw) {
            $this->SDM_TARGET->CurrentValue = HtmlDecode($this->SDM_TARGET->CurrentValue);
        }
        $this->SDM_TARGET->EditValue = $this->SDM_TARGET->CurrentValue;
        $this->SDM_TARGET->PlaceHolder = RemoveHtml($this->SDM_TARGET->caption());

        // SDM_KARYAWANTETAP
        $this->SDM_KARYAWANTETAP->EditAttrs["class"] = "form-control";
        $this->SDM_KARYAWANTETAP->EditCustomAttributes = "";
        if (!$this->SDM_KARYAWANTETAP->Raw) {
            $this->SDM_KARYAWANTETAP->CurrentValue = HtmlDecode($this->SDM_KARYAWANTETAP->CurrentValue);
        }
        $this->SDM_KARYAWANTETAP->EditValue = $this->SDM_KARYAWANTETAP->CurrentValue;
        $this->SDM_KARYAWANTETAP->PlaceHolder = RemoveHtml($this->SDM_KARYAWANTETAP->caption());

        // SDM_KARYAWANSUBKON
        $this->SDM_KARYAWANSUBKON->EditAttrs["class"] = "form-control";
        $this->SDM_KARYAWANSUBKON->EditCustomAttributes = "";
        if (!$this->SDM_KARYAWANSUBKON->Raw) {
            $this->SDM_KARYAWANSUBKON->CurrentValue = HtmlDecode($this->SDM_KARYAWANSUBKON->CurrentValue);
        }
        $this->SDM_KARYAWANSUBKON->EditValue = $this->SDM_KARYAWANSUBKON->CurrentValue;
        $this->SDM_KARYAWANSUBKON->PlaceHolder = RemoveHtml($this->SDM_KARYAWANSUBKON->caption());

        // SDM_GAJI
        $this->SDM_GAJI->EditAttrs["class"] = "form-control";
        $this->SDM_GAJI->EditCustomAttributes = "";
        if (!$this->SDM_GAJI->Raw) {
            $this->SDM_GAJI->CurrentValue = HtmlDecode($this->SDM_GAJI->CurrentValue);
        }
        $this->SDM_GAJI->EditValue = $this->SDM_GAJI->CurrentValue;
        $this->SDM_GAJI->PlaceHolder = RemoveHtml($this->SDM_GAJI->caption());

        // SDM_ASURANSI
        $this->SDM_ASURANSI->EditAttrs["class"] = "form-control";
        $this->SDM_ASURANSI->EditCustomAttributes = "";
        if (!$this->SDM_ASURANSI->Raw) {
            $this->SDM_ASURANSI->CurrentValue = HtmlDecode($this->SDM_ASURANSI->CurrentValue);
        }
        $this->SDM_ASURANSI->EditValue = $this->SDM_ASURANSI->CurrentValue;
        $this->SDM_ASURANSI->PlaceHolder = RemoveHtml($this->SDM_ASURANSI->caption());

        // SDM_TUNJANGAN
        $this->SDM_TUNJANGAN->EditAttrs["class"] = "form-control";
        $this->SDM_TUNJANGAN->EditCustomAttributes = "";
        if (!$this->SDM_TUNJANGAN->Raw) {
            $this->SDM_TUNJANGAN->CurrentValue = HtmlDecode($this->SDM_TUNJANGAN->CurrentValue);
        }
        $this->SDM_TUNJANGAN->EditValue = $this->SDM_TUNJANGAN->CurrentValue;
        $this->SDM_TUNJANGAN->PlaceHolder = RemoveHtml($this->SDM_TUNJANGAN->caption());

        // SDM_PELATIHAN
        $this->SDM_PELATIHAN->EditAttrs["class"] = "form-control";
        $this->SDM_PELATIHAN->EditCustomAttributes = "";
        if (!$this->SDM_PELATIHAN->Raw) {
            $this->SDM_PELATIHAN->CurrentValue = HtmlDecode($this->SDM_PELATIHAN->CurrentValue);
        }
        $this->SDM_PELATIHAN->EditValue = $this->SDM_PELATIHAN->CurrentValue;
        $this->SDM_PELATIHAN->PlaceHolder = RemoveHtml($this->SDM_PELATIHAN->caption());

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
                    $doc->exportCaption($this->SDM_OMS);
                    $doc->exportCaption($this->SDM_FOKUS);
                    $doc->exportCaption($this->SDM_TARGET);
                    $doc->exportCaption($this->SDM_KARYAWANTETAP);
                    $doc->exportCaption($this->SDM_KARYAWANSUBKON);
                    $doc->exportCaption($this->SDM_GAJI);
                    $doc->exportCaption($this->SDM_ASURANSI);
                    $doc->exportCaption($this->SDM_TUNJANGAN);
                    $doc->exportCaption($this->SDM_PELATIHAN);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->NAMA_USAHA);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->SDM_OMS);
                    $doc->exportCaption($this->SDM_FOKUS);
                    $doc->exportCaption($this->SDM_TARGET);
                    $doc->exportCaption($this->SDM_KARYAWANTETAP);
                    $doc->exportCaption($this->SDM_KARYAWANSUBKON);
                    $doc->exportCaption($this->SDM_GAJI);
                    $doc->exportCaption($this->SDM_ASURANSI);
                    $doc->exportCaption($this->SDM_TUNJANGAN);
                    $doc->exportCaption($this->SDM_PELATIHAN);
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
                        $doc->exportField($this->SDM_OMS);
                        $doc->exportField($this->SDM_FOKUS);
                        $doc->exportField($this->SDM_TARGET);
                        $doc->exportField($this->SDM_KARYAWANTETAP);
                        $doc->exportField($this->SDM_KARYAWANSUBKON);
                        $doc->exportField($this->SDM_GAJI);
                        $doc->exportField($this->SDM_ASURANSI);
                        $doc->exportField($this->SDM_TUNJANGAN);
                        $doc->exportField($this->SDM_PELATIHAN);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->NAMA_USAHA);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->SDM_OMS);
                        $doc->exportField($this->SDM_FOKUS);
                        $doc->exportField($this->SDM_TARGET);
                        $doc->exportField($this->SDM_KARYAWANTETAP);
                        $doc->exportField($this->SDM_KARYAWANSUBKON);
                        $doc->exportField($this->SDM_GAJI);
                        $doc->exportField($this->SDM_ASURANSI);
                        $doc->exportField($this->SDM_TUNJANGAN);
                        $doc->exportField($this->SDM_PELATIHAN);
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
