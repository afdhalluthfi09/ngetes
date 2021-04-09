<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for umkm_datadiri
 */
class UmkmDatadiri extends DbTable
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
    public $NAMA_PEMILIK;
    public $JENIS_KELAMIN;
    public $NO_HP;
    public $ALAMAT;
    public $KAPANEWON;
    public $KALURAHAN;
    public $DUSUN;
    public $_PASSWORD;
    public $_EMAIL;
    public $AKTIVASI;
    public $PROFIL;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'umkm_datadiri';
        $this->TableName = 'umkm_datadiri';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`umkm_datadiri`";
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
        $this->NIK = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->IsForeignKey = true; // Foreign key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Required = true; // Required field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_NAMA_PEMILIK', 'NAMA_PEMILIK', '`NAMA_PEMILIK`', '`NAMA_PEMILIK`', 200, 100, -1, false, '`NAMA_PEMILIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PEMILIK->Sortable = true; // Allow sort
        $this->NAMA_PEMILIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PEMILIK->Param, "CustomMsg");
        $this->Fields['NAMA_PEMILIK'] = &$this->NAMA_PEMILIK;

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_JENIS_KELAMIN', 'JENIS_KELAMIN', '`JENIS_KELAMIN`', '`JENIS_KELAMIN`', 200, 10, -1, false, '`JENIS_KELAMIN`', false, false, false, 'FORMATTED TEXT', 'RADIO');
        $this->JENIS_KELAMIN->Sortable = true; // Allow sort
        $this->JENIS_KELAMIN->Lookup = new Lookup('JENIS_KELAMIN', 'umkm_datadiri', false, '', ["","","",""], [], [], [], [], [], [], '', '');
        $this->JENIS_KELAMIN->OptionCount = 2;
        $this->JENIS_KELAMIN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->JENIS_KELAMIN->Param, "CustomMsg");
        $this->Fields['JENIS_KELAMIN'] = &$this->JENIS_KELAMIN;

        // NO_HP
        $this->NO_HP = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_NO_HP', 'NO_HP', '`NO_HP`', '`NO_HP`', 200, 20, -1, false, '`NO_HP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_HP->Sortable = true; // Allow sort
        $this->NO_HP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_HP->Param, "CustomMsg");
        $this->Fields['NO_HP'] = &$this->NO_HP;

        // ALAMAT
        $this->ALAMAT = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_ALAMAT', 'ALAMAT', '`ALAMAT`', '`ALAMAT`', 201, 65535, -1, false, '`ALAMAT`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ALAMAT->Sortable = true; // Allow sort
        $this->ALAMAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALAMAT->Param, "CustomMsg");
        $this->Fields['ALAMAT'] = &$this->ALAMAT;

        // KAPANEWON
        $this->KAPANEWON = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_KAPANEWON', 'KAPANEWON', '`KAPANEWON`', '`KAPANEWON`', 200, 50, -1, false, '`KAPANEWON`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAPANEWON->Sortable = true; // Allow sort
        $this->KAPANEWON->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KAPANEWON->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KAPANEWON->Lookup = new Lookup('KAPANEWON', 'indonesia_districts', false, 'id', ["name","","",""], [], ["x_KALURAHAN"], [], [], [], [], '', '');
        $this->KAPANEWON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPANEWON->Param, "CustomMsg");
        $this->Fields['KAPANEWON'] = &$this->KAPANEWON;

        // KALURAHAN
        $this->KALURAHAN = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_KALURAHAN', 'KALURAHAN', '`KALURAHAN`', '`KALURAHAN`', 200, 50, -1, false, '`KALURAHAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KALURAHAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KALURAHAN->Lookup = new Lookup('KALURAHAN', 'indonesia_villages', false, 'id', ["name","","",""], ["x_KAPANEWON"], [], ["district_id"], ["x_district_id"], [], [], '', '');
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // DUSUN
        $this->DUSUN = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_DUSUN', 'DUSUN', '`DUSUN`', '`DUSUN`', 200, 50, -1, false, '`DUSUN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DUSUN->Sortable = false; // Allow sort
        $this->DUSUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DUSUN->Param, "CustomMsg");
        $this->Fields['DUSUN'] = &$this->DUSUN;

        // PASSWORD
        $this->_PASSWORD = new DbField('umkm_datadiri', 'umkm_datadiri', 'x__PASSWORD', 'PASSWORD', '`PASSWORD`', '`PASSWORD`', 200, 255, -1, false, '`PASSWORD`', false, false, false, 'FORMATTED TEXT', 'PASSWORD');
        if (Config("ENCRYPTED_PASSWORD")) {
            $this->_PASSWORD->Raw = true;
        }
        $this->_PASSWORD->Required = true; // Required field
        $this->_PASSWORD->Sortable = false; // Allow sort
        $this->_PASSWORD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_PASSWORD->Param, "CustomMsg");
        $this->Fields['PASSWORD'] = &$this->_PASSWORD;

        // EMAIL
        $this->_EMAIL = new DbField('umkm_datadiri', 'umkm_datadiri', 'x__EMAIL', 'EMAIL', '`EMAIL`', '`EMAIL`', 200, 100, -1, false, '`EMAIL`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_EMAIL->Required = true; // Required field
        $this->_EMAIL->Sortable = true; // Allow sort
        $this->_EMAIL->DefaultErrorMessage = $Language->phrase("IncorrectEmail");
        $this->_EMAIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_EMAIL->Param, "CustomMsg");
        $this->Fields['EMAIL'] = &$this->_EMAIL;

        // AKTIVASI
        $this->AKTIVASI = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_AKTIVASI', 'AKTIVASI', '`AKTIVASI`', '`AKTIVASI`', 200, 100, -1, false, '`AKTIVASI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->AKTIVASI->Sortable = false; // Allow sort
        $this->AKTIVASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->AKTIVASI->Param, "CustomMsg");
        $this->Fields['AKTIVASI'] = &$this->AKTIVASI;

        // PROFIL
        $this->PROFIL = new DbField('umkm_datadiri', 'umkm_datadiri', 'x_PROFIL', 'PROFIL', '`PROFIL`', '`PROFIL`', 201, 65535, -1, false, '`PROFIL`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->PROFIL->Sortable = false; // Allow sort
        $this->PROFIL->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->PROFIL->Param, "CustomMsg");
        $this->Fields['PROFIL'] = &$this->PROFIL;
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

    // Multiple column sort
    public function updateSort(&$fld, $ctrl)
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
            $lastOrderBy = in_array($lastSort, ["ASC", "DESC"]) ? $sortField . " " . $lastSort : "";
            $curOrderBy = in_array($curSort, ["ASC", "DESC"]) ? $sortField . " " . $curSort : "";
            if ($ctrl) {
                $orderBy = $this->getSessionOrderBy();
                $arOrderBy = !empty($orderBy) ? explode(", ", $orderBy) : [];
                if ($lastOrderBy != "" && in_array($lastOrderBy, $arOrderBy)) {
                    foreach ($arOrderBy as $key => $val) {
                        if ($val == $lastOrderBy) {
                            if ($curOrderBy == "") {
                                unset($arOrderBy[$key]);
                            } else {
                                $arOrderBy[$key] = $curOrderBy;
                            }
                        }
                    }
                } elseif ($curOrderBy != "") {
                    $arOrderBy[] = $curOrderBy;
                }
                $orderBy = implode(", ", $arOrderBy);
                $this->setSessionOrderBy($orderBy); // Save to Session
            } else {
                $this->setSessionOrderBy($curOrderBy); // Save to Session
            }
        } else {
            if (!$ctrl) {
                $fld->setSort("");
            }
        }
    }

    // Current detail table name
    public function getCurrentDetailTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE"));
    }

    public function setCurrentDetailTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_DETAIL_TABLE")] = $v;
    }

    // Get detail url
    public function getDetailUrl()
    {
        // Detail url
        $detailUrl = "";
        if ($this->getCurrentDetailTable() == "umkm_datausaha") {
            $detailUrl = Container("umkm_datausaha")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_NIK", $this->NIK->CurrentValue);
        }
        if ($this->getCurrentDetailTable() == "umkm_aspekkeuangan") {
            $detailUrl = Container("umkm_aspekkeuangan")->getListUrl() . "?" . Config("TABLE_SHOW_MASTER") . "=" . $this->TableVar;
            $detailUrl .= "&" . GetForeignKeyUrl("fk_NIK", $this->NIK->CurrentValue);
        }
        if ($detailUrl == "") {
            $detailUrl = "umkmdatadirilist";
        }
        return $detailUrl;
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`umkm_datadiri`";
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
            if (Config("ENCRYPTED_PASSWORD") && $name == Config("LOGIN_PASSWORD_FIELD_NAME")) {
                if ($value == $this->Fields[$name]->OldValue) { // No need to update hashed password if not changed
                    continue;
                }
                $value = Config("CASE_SENSITIVE_PASSWORD") ? EncryptPassword($value) : EncryptPassword(strtolower($value));
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
        $this->NAMA_PEMILIK->DbValue = $row['NAMA_PEMILIK'];
        $this->JENIS_KELAMIN->DbValue = $row['JENIS_KELAMIN'];
        $this->NO_HP->DbValue = $row['NO_HP'];
        $this->ALAMAT->DbValue = $row['ALAMAT'];
        $this->KAPANEWON->DbValue = $row['KAPANEWON'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->DUSUN->DbValue = $row['DUSUN'];
        $this->_PASSWORD->DbValue = $row['PASSWORD'];
        $this->_EMAIL->DbValue = $row['EMAIL'];
        $this->AKTIVASI->DbValue = $row['AKTIVASI'];
        $this->PROFIL->DbValue = $row['PROFIL'];
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
        return $_SESSION[$name] ?? GetUrl("umkmdatadirilist");
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
        if ($pageName == "umkmdatadiriview") {
            return $Language->phrase("View");
        } elseif ($pageName == "umkmdatadiriedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "umkmdatadiriadd") {
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
                return "UmkmDatadiriView";
            case Config("API_ADD_ACTION"):
                return "UmkmDatadiriAdd";
            case Config("API_EDIT_ACTION"):
                return "UmkmDatadiriEdit";
            case Config("API_DELETE_ACTION"):
                return "UmkmDatadiriDelete";
            case Config("API_LIST_ACTION"):
                return "UmkmDatadiriList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "umkmdatadirilist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmdatadiriview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmdatadiriview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "umkmdatadiriadd?" . $this->getUrlParm($parm);
        } else {
            $url = "umkmdatadiriadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmdatadiriedit", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmdatadiriedit", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        if ($parm != "") {
            $url = $this->keyUrl("umkmdatadiriadd", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmdatadiriadd", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
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
        return $this->keyUrl("umkmdatadiridelete", $this->getUrlParm());
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
        $jsSort = " class=\"ew-pointer\" onclick=\"ew.sort(event, '" . $this->sortUrl($fld) . "', 2);\"";
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
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->JENIS_KELAMIN->setDbValue($row['JENIS_KELAMIN']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->_PASSWORD->setDbValue($row['PASSWORD']);
        $this->_EMAIL->setDbValue($row['EMAIL']);
        $this->AKTIVASI->setDbValue($row['AKTIVASI']);
        $this->PROFIL->setDbValue($row['PROFIL']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NIK
        $this->NIK->CellCssStyle = "white-space: nowrap;";

        // NAMA_PEMILIK

        // JENIS_KELAMIN

        // NO_HP

        // ALAMAT

        // KAPANEWON

        // KALURAHAN

        // DUSUN
        $this->DUSUN->CellCssStyle = "white-space: nowrap;";

        // PASSWORD
        $this->_PASSWORD->CellCssStyle = "white-space: nowrap;";

        // EMAIL

        // AKTIVASI
        $this->AKTIVASI->CellCssStyle = "white-space: nowrap;";

        // PROFIL
        $this->PROFIL->CellCssStyle = "white-space: nowrap;";

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->ViewCustomAttributes = "";

        // JENIS_KELAMIN
        if (strval($this->JENIS_KELAMIN->CurrentValue) != "") {
            $this->JENIS_KELAMIN->ViewValue = $this->JENIS_KELAMIN->optionCaption($this->JENIS_KELAMIN->CurrentValue);
        } else {
            $this->JENIS_KELAMIN->ViewValue = null;
        }
        $this->JENIS_KELAMIN->ViewCustomAttributes = "";

        // NO_HP
        $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->ViewCustomAttributes = "";

        // ALAMAT
        $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->ViewCustomAttributes = "";

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

        // PASSWORD
        $this->_PASSWORD->ViewValue = $Language->phrase("PasswordMask");
        $this->_PASSWORD->ViewCustomAttributes = "";

        // EMAIL
        $this->_EMAIL->ViewValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->ViewCustomAttributes = "";

        // AKTIVASI
        $this->AKTIVASI->ViewValue = $this->AKTIVASI->CurrentValue;
        $this->AKTIVASI->ViewCustomAttributes = "";

        // PROFIL
        $this->PROFIL->ViewValue = $this->PROFIL->CurrentValue;
        $this->PROFIL->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->ExportHrefValue = Barcode()->getHrefValue('', 'QRCODE', 100);
        $this->NIK->TooltipValue = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->LinkCustomAttributes = "";
        $this->NAMA_PEMILIK->HrefValue = "";
        $this->NAMA_PEMILIK->TooltipValue = "";

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->LinkCustomAttributes = "";
        $this->JENIS_KELAMIN->HrefValue = "";
        $this->JENIS_KELAMIN->TooltipValue = "";

        // NO_HP
        $this->NO_HP->LinkCustomAttributes = "";
        $this->NO_HP->HrefValue = "";
        $this->NO_HP->TooltipValue = "";

        // ALAMAT
        $this->ALAMAT->LinkCustomAttributes = "";
        $this->ALAMAT->HrefValue = "";
        $this->ALAMAT->TooltipValue = "";

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

        // PASSWORD
        $this->_PASSWORD->LinkCustomAttributes = "";
        $this->_PASSWORD->HrefValue = "";
        $this->_PASSWORD->TooltipValue = "";

        // EMAIL
        $this->_EMAIL->LinkCustomAttributes = "";
        $this->_EMAIL->HrefValue = "";
        $this->_EMAIL->TooltipValue = "";

        // AKTIVASI
        $this->AKTIVASI->LinkCustomAttributes = "";
        $this->AKTIVASI->HrefValue = "";
        $this->AKTIVASI->TooltipValue = "";

        // PROFIL
        $this->PROFIL->LinkCustomAttributes = "";
        $this->PROFIL->HrefValue = "";
        $this->PROFIL->TooltipValue = "";

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

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
        $this->NAMA_PEMILIK->EditCustomAttributes = "";
        if (!$this->NAMA_PEMILIK->Raw) {
            $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
        }
        $this->NAMA_PEMILIK->EditValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

        // JENIS_KELAMIN
        $this->JENIS_KELAMIN->EditCustomAttributes = "";
        $this->JENIS_KELAMIN->EditValue = $this->JENIS_KELAMIN->options(false);
        $this->JENIS_KELAMIN->PlaceHolder = RemoveHtml($this->JENIS_KELAMIN->caption());

        // NO_HP
        $this->NO_HP->EditAttrs["class"] = "form-control";
        $this->NO_HP->EditCustomAttributes = "";
        if (!$this->NO_HP->Raw) {
            $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
        }
        $this->NO_HP->EditValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

        // ALAMAT
        $this->ALAMAT->EditAttrs["class"] = "form-control";
        $this->ALAMAT->EditCustomAttributes = "";
        $this->ALAMAT->EditValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

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

        // PASSWORD
        $this->_PASSWORD->EditAttrs["class"] = "form-control ew-password-strength";
        $this->_PASSWORD->EditCustomAttributes = "";
        $this->_PASSWORD->EditValue = $Language->phrase("PasswordMask"); // Show as masked password
        $this->_PASSWORD->PlaceHolder = RemoveHtml($this->_PASSWORD->caption());

        // EMAIL
        $this->_EMAIL->EditAttrs["class"] = "form-control";
        $this->_EMAIL->EditCustomAttributes = "";
        if (!$this->_EMAIL->Raw) {
            $this->_EMAIL->CurrentValue = HtmlDecode($this->_EMAIL->CurrentValue);
        }
        $this->_EMAIL->EditValue = $this->_EMAIL->CurrentValue;
        $this->_EMAIL->PlaceHolder = RemoveHtml($this->_EMAIL->caption());

        // AKTIVASI
        $this->AKTIVASI->EditAttrs["class"] = "form-control";
        $this->AKTIVASI->EditCustomAttributes = "";
        if (!$this->AKTIVASI->Raw) {
            $this->AKTIVASI->CurrentValue = HtmlDecode($this->AKTIVASI->CurrentValue);
        }
        $this->AKTIVASI->EditValue = $this->AKTIVASI->CurrentValue;
        $this->AKTIVASI->PlaceHolder = RemoveHtml($this->AKTIVASI->caption());

        // PROFIL
        $this->PROFIL->EditAttrs["class"] = "form-control";
        $this->PROFIL->EditCustomAttributes = "";
        $this->PROFIL->EditValue = $this->PROFIL->CurrentValue;
        $this->PROFIL->PlaceHolder = RemoveHtml($this->PROFIL->caption());

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
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->JENIS_KELAMIN);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->_EMAIL);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->JENIS_KELAMIN);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->_EMAIL);
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
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->JENIS_KELAMIN);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->_EMAIL);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->JENIS_KELAMIN);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->_EMAIL);
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

    // Send register email
    public function sendRegisterEmail($row)
    {
        $email = $this->prepareRegisterEmail($row);
        $args = [];
        $args["rs"] = $row;
        $emailSent = false;
        if ($this->emailSending($email, $args)) { // Use Email_Sending server event of user table
            $emailSent = $email->send();
        }
        return $emailSent;
    }

    // Prepare register email
    public function prepareRegisterEmail($row = null, $langId = "")
    {
        global $CurrentForm;
        $email = new Email();
        $email->load(Config("EMAIL_REGISTER_TEMPLATE"), $langId);
        $receiverEmail = $row === null ? $this->_EMAIL->CurrentValue : GetUserInfo(Config("USER_EMAIL_FIELD_NAME"), $row);
        if ($receiverEmail == "") { // Send to recipient directly
            $receiverEmail = Config("RECIPIENT_EMAIL");
            $bccEmail = "";
        } else { // Bcc recipient
            $bccEmail = Config("RECIPIENT_EMAIL");
        }
        $email->replaceSender(Config("SENDER_EMAIL")); // Replace Sender
        $email->replaceRecipient($receiverEmail); // Replace Recipient
        if ($bccEmail != "") // Add Bcc
            $email->addBcc($bccEmail);
        $email->replaceContent('<!--FieldCaption_NIK-->', $this->NIK->caption());
        $email->replaceContent('<!--NIK-->', $row === null ? strval($this->NIK->FormValue) : GetUserInfo('NIK', $row));
        $email->replaceContent('<!--FieldCaption_NAMA_PEMILIK-->', $this->NAMA_PEMILIK->caption());
        $email->replaceContent('<!--NAMA_PEMILIK-->', $row === null ? strval($this->NAMA_PEMILIK->FormValue) : GetUserInfo('NAMA_PEMILIK', $row));
        $email->replaceContent('<!--FieldCaption_JENIS_KELAMIN-->', $this->JENIS_KELAMIN->caption());
        $email->replaceContent('<!--JENIS_KELAMIN-->', $row === null ? strval($this->JENIS_KELAMIN->FormValue) : GetUserInfo('JENIS_KELAMIN', $row));
        $email->replaceContent('<!--FieldCaption_NO_HP-->', $this->NO_HP->caption());
        $email->replaceContent('<!--NO_HP-->', $row === null ? strval($this->NO_HP->FormValue) : GetUserInfo('NO_HP', $row));
        $email->replaceContent('<!--FieldCaption_ALAMAT-->', $this->ALAMAT->caption());
        $email->replaceContent('<!--ALAMAT-->', $row === null ? strval($this->ALAMAT->FormValue) : GetUserInfo('ALAMAT', $row));
        $email->replaceContent('<!--FieldCaption_PASSWORD-->', $this->_PASSWORD->caption());
        $email->replaceContent('<!--PASSWORD-->', $row === null ? strval($this->_PASSWORD->FormValue) : GetUserInfo('PASSWORD', $row));
        $email->replaceContent('<!--FieldCaption_EMAIL-->', $this->_EMAIL->caption());
        $email->replaceContent('<!--EMAIL-->', $row === null ? strval($this->_EMAIL->FormValue) : GetUserInfo('EMAIL', $row));
        $email->Content = preg_replace('/<!--\s*register_activate_link_begin[\s\S]*?-->[\s\S]*?<!--\s*register_activate_link_end[\s\S]*?-->/i', '', $email->Content); // Remove activate link block
        return $email;
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
