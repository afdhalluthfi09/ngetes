<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ikm_industrikreatif
 */
class IkmIndustrikreatif extends DbTable
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
    public $ID;
    public $KELOMPOK_USAHA;
    public $JENIS;
    public $NAMA_PEMILIK;
    public $TELP;
    public $NAMA_USAHA;
    public $KAPANEWON;
    public $KALURAHAN;
    public $DUSUN;
    public $TENAGA_KERJA;
    public $NIK;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ikm_industrikreatif';
        $this->TableName = 'ikm_industrikreatif';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`ikm_industrikreatif`";
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

        // ID
        $this->ID = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_ID', 'ID', '`ID`', '`ID`', 3, 11, -1, false, '`ID`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Sortable = false; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;

        // KELOMPOK_USAHA
        $this->KELOMPOK_USAHA = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_KELOMPOK_USAHA', 'KELOMPOK_USAHA', '`KELOMPOK_USAHA`', '`KELOMPOK_USAHA`', 200, 50, -1, false, '`KELOMPOK_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KELOMPOK_USAHA->Sortable = true; // Allow sort
        $this->KELOMPOK_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KELOMPOK_USAHA->Param, "CustomMsg");
        $this->Fields['KELOMPOK_USAHA'] = &$this->KELOMPOK_USAHA;

        // JENIS
        $this->JENIS = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_JENIS', 'JENIS', '`JENIS`', '`JENIS`', 200, 30, -1, false, '`JENIS`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->JENIS->Sortable = true; // Allow sort
        $this->JENIS->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->JENIS->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->JENIS->Lookup = new Lookup('JENIS', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '', '');
        $this->JENIS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JENIS->Param, "CustomMsg");
        $this->Fields['JENIS'] = &$this->JENIS;

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_NAMA_PEMILIK', 'NAMA_PEMILIK', '`NAMA_PEMILIK`', '`NAMA_PEMILIK`', 200, 50, -1, false, '`NAMA_PEMILIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PEMILIK->Sortable = true; // Allow sort
        $this->NAMA_PEMILIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PEMILIK->Param, "CustomMsg");
        $this->Fields['NAMA_PEMILIK'] = &$this->NAMA_PEMILIK;

        // TELP
        $this->TELP = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_TELP', 'TELP', '`TELP`', '`TELP`', 200, 20, -1, false, '`TELP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TELP->Sortable = true; // Allow sort
        $this->TELP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TELP->Param, "CustomMsg");
        $this->Fields['TELP'] = &$this->TELP;

        // NAMA_USAHA
        $this->NAMA_USAHA = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_NAMA_USAHA', 'NAMA_USAHA', '`NAMA_USAHA`', '`NAMA_USAHA`', 200, 50, -1, false, '`NAMA_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_USAHA->Sortable = true; // Allow sort
        $this->NAMA_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_USAHA->Param, "CustomMsg");
        $this->Fields['NAMA_USAHA'] = &$this->NAMA_USAHA;

        // KAPANEWON
        $this->KAPANEWON = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_KAPANEWON', 'KAPANEWON', '`KAPANEWON`', '`KAPANEWON`', 200, 50, -1, false, '`KAPANEWON`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAPANEWON->Sortable = true; // Allow sort
        $this->KAPANEWON->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KAPANEWON->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KAPANEWON->Lookup = new Lookup('KAPANEWON', 'indonesia_districts', false, 'id', ["name","","",""], [], ["x_KALURAHAN"], [], [], [], [], '', '');
        $this->KAPANEWON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPANEWON->Param, "CustomMsg");
        $this->Fields['KAPANEWON'] = &$this->KAPANEWON;

        // KALURAHAN
        $this->KALURAHAN = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_KALURAHAN', 'KALURAHAN', '`KALURAHAN`', '`KALURAHAN`', 200, 50, -1, false, '`KALURAHAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KALURAHAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KALURAHAN->Lookup = new Lookup('KALURAHAN', 'indonesia_villages', false, 'id', ["name","","",""], ["x_KAPANEWON"], [], ["district_id"], ["x_district_id"], [], [], '', '');
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // DUSUN
        $this->DUSUN = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_DUSUN', 'DUSUN', '`DUSUN`', '`DUSUN`', 200, 50, -1, false, '`DUSUN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DUSUN->Sortable = true; // Allow sort
        $this->DUSUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DUSUN->Param, "CustomMsg");
        $this->Fields['DUSUN'] = &$this->DUSUN;

        // TENAGA_KERJA
        $this->TENAGA_KERJA = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_TENAGA_KERJA', 'TENAGA_KERJA', '`TENAGA_KERJA`', '`TENAGA_KERJA`', 3, 10, -1, false, '`TENAGA_KERJA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENAGA_KERJA->Sortable = true; // Allow sort
        $this->TENAGA_KERJA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TENAGA_KERJA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENAGA_KERJA->Param, "CustomMsg");
        $this->Fields['TENAGA_KERJA'] = &$this->TENAGA_KERJA;

        // NIK
        $this->NIK = new DbField('ikm_industrikreatif', 'ikm_industrikreatif', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 3, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`ikm_industrikreatif`";
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
            // Get insert id if necessary
            $this->ID->setDbValue($conn->lastInsertId());
            $rs['ID'] = $this->ID->DbValue;
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
            if (array_key_exists('ID', $rs)) {
                AddFilter($where, QuotedName('ID', $this->Dbid) . '=' . QuotedValue($rs['ID'], $this->ID->DataType, $this->Dbid));
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
        $this->ID->DbValue = $row['ID'];
        $this->KELOMPOK_USAHA->DbValue = $row['KELOMPOK_USAHA'];
        $this->JENIS->DbValue = $row['JENIS'];
        $this->NAMA_PEMILIK->DbValue = $row['NAMA_PEMILIK'];
        $this->TELP->DbValue = $row['TELP'];
        $this->NAMA_USAHA->DbValue = $row['NAMA_USAHA'];
        $this->KAPANEWON->DbValue = $row['KAPANEWON'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->DUSUN->DbValue = $row['DUSUN'];
        $this->TENAGA_KERJA->DbValue = $row['TENAGA_KERJA'];
        $this->NIK->DbValue = $row['NIK'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`ID` = @ID@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->ID->CurrentValue : $this->ID->OldValue;
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
                $this->ID->CurrentValue = $keys[0];
            } else {
                $this->ID->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('ID', $row) ? $row['ID'] : null;
        } else {
            $val = $this->ID->OldValue !== null ? $this->ID->OldValue : $this->ID->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@ID@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("ikmindustrikreatiflist");
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
        if ($pageName == "ikmindustrikreatifview") {
            return $Language->phrase("View");
        } elseif ($pageName == "ikmindustrikreatifedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ikmindustrikreatifadd") {
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
                return "IkmIndustrikreatifView";
            case Config("API_ADD_ACTION"):
                return "IkmIndustrikreatifAdd";
            case Config("API_EDIT_ACTION"):
                return "IkmIndustrikreatifEdit";
            case Config("API_DELETE_ACTION"):
                return "IkmIndustrikreatifDelete";
            case Config("API_LIST_ACTION"):
                return "IkmIndustrikreatifList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ikmindustrikreatiflist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ikmindustrikreatifview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ikmindustrikreatifview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ikmindustrikreatifadd?" . $this->getUrlParm($parm);
        } else {
            $url = "ikmindustrikreatifadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ikmindustrikreatifedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ikmindustrikreatifadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ikmindustrikreatifdelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "ID:" . JsonEncode($this->ID->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->ID->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->ID->CurrentValue);
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
            if (($keyValue = Param("ID") ?? Route("ID")) !== null) {
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
                if (!is_numeric($key)) {
                    continue;
                }
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
                $this->ID->CurrentValue = $key;
            } else {
                $this->ID->OldValue = $key;
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
        $this->ID->setDbValue($row['ID']);
        $this->KELOMPOK_USAHA->setDbValue($row['KELOMPOK_USAHA']);
        $this->JENIS->setDbValue($row['JENIS']);
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->TELP->setDbValue($row['TELP']);
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->TENAGA_KERJA->setDbValue($row['TENAGA_KERJA']);
        $this->NIK->setDbValue($row['NIK']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // ID
        $this->ID->CellCssStyle = "white-space: nowrap;";

        // KELOMPOK_USAHA

        // JENIS

        // NAMA_PEMILIK

        // TELP

        // NAMA_USAHA

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // TENAGA_KERJA

        // NIK

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewValue = FormatNumber($this->ID->ViewValue, 0, -2, -2, -2);
        $this->ID->ViewCustomAttributes = "";

        // KELOMPOK_USAHA
        $this->KELOMPOK_USAHA->ViewValue = $this->KELOMPOK_USAHA->CurrentValue;
        $this->KELOMPOK_USAHA->ViewCustomAttributes = "";

        // JENIS
        $curVal = strval($this->JENIS->CurrentValue);
        if ($curVal != "") {
            $this->JENIS->ViewValue = $this->JENIS->lookupCacheOption($curVal);
            if ($this->JENIS->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Jenis Industri Kreatif'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->JENIS->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->JENIS->Lookup->renderViewRow($rswrk[0]);
                    $this->JENIS->ViewValue = $this->JENIS->displayValue($arwrk);
                } else {
                    $this->JENIS->ViewValue = $this->JENIS->CurrentValue;
                }
            }
        } else {
            $this->JENIS->ViewValue = null;
        }
        $this->JENIS->ViewCustomAttributes = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->ViewCustomAttributes = "";

        // TELP
        $this->TELP->ViewValue = $this->TELP->CurrentValue;
        $this->TELP->ViewCustomAttributes = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->ViewCustomAttributes = "";

        // KAPANEWON
        $curVal = strval($this->KAPANEWON->CurrentValue);
        if ($curVal != "") {
            $this->KAPANEWON->ViewValue = $this->KAPANEWON->lookupCacheOption($curVal);
            if ($this->KAPANEWON->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`city_id`='3402'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KAPANEWON->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KAPANEWON->Lookup->renderViewRow($rswrk[0]);
                    $this->KAPANEWON->ViewValue = $this->KAPANEWON->displayValue($arwrk);
                } else {
                    $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
                }
            }
        } else {
            $this->KAPANEWON->ViewValue = null;
        }
        $this->KAPANEWON->ViewCustomAttributes = "";

        // KALURAHAN
        $curVal = strval($this->KALURAHAN->CurrentValue);
        if ($curVal != "") {
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->lookupCacheOption($curVal);
            if ($this->KALURAHAN->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->KALURAHAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KALURAHAN->Lookup->renderViewRow($rswrk[0]);
                    $this->KALURAHAN->ViewValue = $this->KALURAHAN->displayValue($arwrk);
                } else {
                    $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
                }
            }
        } else {
            $this->KALURAHAN->ViewValue = null;
        }
        $this->KALURAHAN->ViewCustomAttributes = "";

        // DUSUN
        $this->DUSUN->ViewValue = $this->DUSUN->CurrentValue;
        $this->DUSUN->ViewCustomAttributes = "";

        // TENAGA_KERJA
        $this->TENAGA_KERJA->ViewValue = $this->TENAGA_KERJA->CurrentValue;
        $this->TENAGA_KERJA->ViewValue = FormatNumber($this->TENAGA_KERJA->ViewValue, 0, -2, -2, -2);
        $this->TENAGA_KERJA->ViewCustomAttributes = "";

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewValue = FormatNumber($this->NIK->ViewValue, 0, -2, -2, -2);
        $this->NIK->ViewCustomAttributes = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // KELOMPOK_USAHA
        $this->KELOMPOK_USAHA->LinkCustomAttributes = "";
        $this->KELOMPOK_USAHA->HrefValue = "";
        $this->KELOMPOK_USAHA->TooltipValue = "";

        // JENIS
        $this->JENIS->LinkCustomAttributes = "";
        $this->JENIS->HrefValue = "";
        $this->JENIS->TooltipValue = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->LinkCustomAttributes = "";
        $this->NAMA_PEMILIK->HrefValue = "";
        $this->NAMA_PEMILIK->TooltipValue = "";

        // TELP
        $this->TELP->LinkCustomAttributes = "";
        $this->TELP->HrefValue = "";
        $this->TELP->TooltipValue = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->LinkCustomAttributes = "";
        $this->NAMA_USAHA->HrefValue = "";
        $this->NAMA_USAHA->TooltipValue = "";

        // KAPANEWON
        $this->KAPANEWON->LinkCustomAttributes = "";
        $this->KAPANEWON->HrefValue = "";
        $this->KAPANEWON->TooltipValue = "";

        // KALURAHAN
        $this->KALURAHAN->LinkCustomAttributes = "";
        $this->KALURAHAN->HrefValue = "";
        $this->KALURAHAN->TooltipValue = "";

        // DUSUN
        $this->DUSUN->LinkCustomAttributes = "";
        $this->DUSUN->HrefValue = "";
        $this->DUSUN->TooltipValue = "";

        // TENAGA_KERJA
        $this->TENAGA_KERJA->LinkCustomAttributes = "";
        $this->TENAGA_KERJA->HrefValue = "";
        $this->TENAGA_KERJA->TooltipValue = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

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

        // ID
        $this->ID->EditAttrs["class"] = "form-control";
        $this->ID->EditCustomAttributes = "";
        $this->ID->EditValue = $this->ID->CurrentValue;
        $this->ID->EditValue = FormatNumber($this->ID->EditValue, 0, -2, -2, -2);
        $this->ID->ViewCustomAttributes = "";

        // KELOMPOK_USAHA
        $this->KELOMPOK_USAHA->EditAttrs["class"] = "form-control";
        $this->KELOMPOK_USAHA->EditCustomAttributes = "";
        if (!$this->KELOMPOK_USAHA->Raw) {
            $this->KELOMPOK_USAHA->CurrentValue = HtmlDecode($this->KELOMPOK_USAHA->CurrentValue);
        }
        $this->KELOMPOK_USAHA->EditValue = $this->KELOMPOK_USAHA->CurrentValue;
        $this->KELOMPOK_USAHA->PlaceHolder = RemoveHtml($this->KELOMPOK_USAHA->caption());

        // JENIS
        $this->JENIS->EditAttrs["class"] = "form-control";
        $this->JENIS->EditCustomAttributes = "";
        $this->JENIS->PlaceHolder = RemoveHtml($this->JENIS->caption());

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
        $this->NAMA_PEMILIK->EditCustomAttributes = "";
        if (!$this->NAMA_PEMILIK->Raw) {
            $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
        }
        $this->NAMA_PEMILIK->EditValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

        // TELP
        $this->TELP->EditAttrs["class"] = "form-control";
        $this->TELP->EditCustomAttributes = "";
        if (!$this->TELP->Raw) {
            $this->TELP->CurrentValue = HtmlDecode($this->TELP->CurrentValue);
        }
        $this->TELP->EditValue = $this->TELP->CurrentValue;
        $this->TELP->PlaceHolder = RemoveHtml($this->TELP->caption());

        // NAMA_USAHA
        $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
        $this->NAMA_USAHA->EditCustomAttributes = "";
        if (!$this->NAMA_USAHA->Raw) {
            $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
        }
        $this->NAMA_USAHA->EditValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

        // KAPANEWON
        $this->KAPANEWON->EditAttrs["class"] = "form-control";
        $this->KAPANEWON->EditCustomAttributes = "";
        $this->KAPANEWON->PlaceHolder = RemoveHtml($this->KAPANEWON->caption());

        // KALURAHAN
        $this->KALURAHAN->EditAttrs["class"] = "form-control";
        $this->KALURAHAN->EditCustomAttributes = "";
        $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

        // DUSUN
        $this->DUSUN->EditAttrs["class"] = "form-control";
        $this->DUSUN->EditCustomAttributes = "";
        if (!$this->DUSUN->Raw) {
            $this->DUSUN->CurrentValue = HtmlDecode($this->DUSUN->CurrentValue);
        }
        $this->DUSUN->EditValue = $this->DUSUN->CurrentValue;
        $this->DUSUN->PlaceHolder = RemoveHtml($this->DUSUN->caption());

        // TENAGA_KERJA
        $this->TENAGA_KERJA->EditAttrs["class"] = "form-control";
        $this->TENAGA_KERJA->EditCustomAttributes = "";
        $this->TENAGA_KERJA->EditValue = $this->TENAGA_KERJA->CurrentValue;
        $this->TENAGA_KERJA->PlaceHolder = RemoveHtml($this->TENAGA_KERJA->caption());

        // NIK
        $this->NIK->EditAttrs["class"] = "form-control";
        $this->NIK->EditCustomAttributes = "";
        $this->NIK->EditValue = $this->NIK->CurrentValue;
        $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

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
                    $doc->exportCaption($this->KELOMPOK_USAHA);
                    $doc->exportCaption($this->JENIS);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->TELP);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->DUSUN);
                    $doc->exportCaption($this->TENAGA_KERJA);
                    $doc->exportCaption($this->NIK);
                } else {
                    $doc->exportCaption($this->KELOMPOK_USAHA);
                    $doc->exportCaption($this->JENIS);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->TELP);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->DUSUN);
                    $doc->exportCaption($this->TENAGA_KERJA);
                    $doc->exportCaption($this->NIK);
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
                        $doc->exportField($this->KELOMPOK_USAHA);
                        $doc->exportField($this->JENIS);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->TELP);
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->DUSUN);
                        $doc->exportField($this->TENAGA_KERJA);
                        $doc->exportField($this->NIK);
                    } else {
                        $doc->exportField($this->KELOMPOK_USAHA);
                        $doc->exportField($this->JENIS);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->TELP);
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->DUSUN);
                        $doc->exportField($this->TENAGA_KERJA);
                        $doc->exportField($this->NIK);
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
