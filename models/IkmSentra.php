<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ikm_sentra
 */
class IkmSentra extends DbTable
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
    public $CABANG_INDUSTRI;
    public $NAMA_SENTRA;
    public $KBLI;
    public $ALAMAT;
    public $KAPANEWON;
    public $KALURAHAN;
    public $KONTAK;
    public $TELP;
    public $UNIT__USAHA;
    public $TENAGA_KERJA;
    public $NILAI_INVESTASI;
    public $KAPASITAS;
    public $SATUAN;
    public $NILAI_PRODUKSI;
    public $NILAI_BB_BP;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ikm_sentra';
        $this->TableName = 'ikm_sentra';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`ikm_sentra`";
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
        $this->ID = new DbField('ikm_sentra', 'ikm_sentra', 'x_ID', 'ID', '`ID`', '`ID`', 2, 6, -1, false, '`ID`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->ID->IsAutoIncrement = true; // Autoincrement field
        $this->ID->IsPrimaryKey = true; // Primary key field
        $this->ID->Sortable = false; // Allow sort
        $this->ID->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->ID->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ID->Param, "CustomMsg");
        $this->Fields['ID'] = &$this->ID;

        // CABANG_INDUSTRI
        $this->CABANG_INDUSTRI = new DbField('ikm_sentra', 'ikm_sentra', 'x_CABANG_INDUSTRI', 'CABANG_INDUSTRI', '`CABANG_INDUSTRI`', '`CABANG_INDUSTRI`', 200, 30, -1, false, '`CABANG_INDUSTRI`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->CABANG_INDUSTRI->Sortable = true; // Allow sort
        $this->CABANG_INDUSTRI->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->CABANG_INDUSTRI->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->CABANG_INDUSTRI->Lookup = new Lookup('CABANG_INDUSTRI', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '', '');
        $this->CABANG_INDUSTRI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->CABANG_INDUSTRI->Param, "CustomMsg");
        $this->Fields['CABANG_INDUSTRI'] = &$this->CABANG_INDUSTRI;

        // NAMA_SENTRA
        $this->NAMA_SENTRA = new DbField('ikm_sentra', 'ikm_sentra', 'x_NAMA_SENTRA', 'NAMA_SENTRA', '`NAMA_SENTRA`', '`NAMA_SENTRA`', 200, 50, -1, false, '`NAMA_SENTRA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_SENTRA->Sortable = true; // Allow sort
        $this->NAMA_SENTRA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_SENTRA->Param, "CustomMsg");
        $this->Fields['NAMA_SENTRA'] = &$this->NAMA_SENTRA;

        // KBLI
        $this->KBLI = new DbField('ikm_sentra', 'ikm_sentra', 'x_KBLI', 'KBLI', '`KBLI`', '`KBLI`', 200, 20, -1, false, '`KBLI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KBLI->Sortable = true; // Allow sort
        $this->KBLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KBLI->Param, "CustomMsg");
        $this->Fields['KBLI'] = &$this->KBLI;

        // ALAMAT
        $this->ALAMAT = new DbField('ikm_sentra', 'ikm_sentra', 'x_ALAMAT', 'ALAMAT', '`ALAMAT`', '`ALAMAT`', 200, 50, -1, false, '`ALAMAT`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ALAMAT->Sortable = true; // Allow sort
        $this->ALAMAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALAMAT->Param, "CustomMsg");
        $this->Fields['ALAMAT'] = &$this->ALAMAT;

        // KAPANEWON
        $this->KAPANEWON = new DbField('ikm_sentra', 'ikm_sentra', 'x_KAPANEWON', 'KAPANEWON', '`KAPANEWON`', '`KAPANEWON`', 200, 50, -1, false, '`KAPANEWON`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAPANEWON->Sortable = true; // Allow sort
        $this->KAPANEWON->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KAPANEWON->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KAPANEWON->Lookup = new Lookup('KAPANEWON', 'indonesia_districts', false, 'id', ["name","","",""], [], ["x_KALURAHAN"], [], [], [], [], '', '');
        $this->KAPANEWON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPANEWON->Param, "CustomMsg");
        $this->Fields['KAPANEWON'] = &$this->KAPANEWON;

        // KALURAHAN
        $this->KALURAHAN = new DbField('ikm_sentra', 'ikm_sentra', 'x_KALURAHAN', 'KALURAHAN', '`KALURAHAN`', '`KALURAHAN`', 200, 50, -1, false, '`KALURAHAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KALURAHAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KALURAHAN->Lookup = new Lookup('KALURAHAN', 'indonesia_villages', false, 'id', ["name","","",""], ["x_KAPANEWON"], [], ["district_id"], ["x_district_id"], [], [], '', '');
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // KONTAK
        $this->KONTAK = new DbField('ikm_sentra', 'ikm_sentra', 'x_KONTAK', 'KONTAK', '`KONTAK`', '`KONTAK`', 200, 20, -1, false, '`KONTAK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KONTAK->Sortable = true; // Allow sort
        $this->KONTAK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KONTAK->Param, "CustomMsg");
        $this->Fields['KONTAK'] = &$this->KONTAK;

        // TELP
        $this->TELP = new DbField('ikm_sentra', 'ikm_sentra', 'x_TELP', 'TELP', '`TELP`', '`TELP`', 200, 20, -1, false, '`TELP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TELP->Sortable = true; // Allow sort
        $this->TELP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TELP->Param, "CustomMsg");
        $this->Fields['TELP'] = &$this->TELP;

        // UNIT_ USAHA
        $this->UNIT__USAHA = new DbField('ikm_sentra', 'ikm_sentra', 'x_UNIT__USAHA', 'UNIT_ USAHA', '`UNIT_ USAHA`', '`UNIT_ USAHA`', 3, 10, -1, false, '`UNIT_ USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->UNIT__USAHA->Sortable = true; // Allow sort
        $this->UNIT__USAHA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->UNIT__USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->UNIT__USAHA->Param, "CustomMsg");
        $this->Fields['UNIT_ USAHA'] = &$this->UNIT__USAHA;

        // TENAGA_KERJA
        $this->TENAGA_KERJA = new DbField('ikm_sentra', 'ikm_sentra', 'x_TENAGA_KERJA', 'TENAGA_KERJA', '`TENAGA_KERJA`', '`TENAGA_KERJA`', 3, 10, -1, false, '`TENAGA_KERJA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENAGA_KERJA->Sortable = true; // Allow sort
        $this->TENAGA_KERJA->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TENAGA_KERJA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENAGA_KERJA->Param, "CustomMsg");
        $this->Fields['TENAGA_KERJA'] = &$this->TENAGA_KERJA;

        // NILAI_INVESTASI
        $this->NILAI_INVESTASI = new DbField('ikm_sentra', 'ikm_sentra', 'x_NILAI_INVESTASI', 'NILAI_INVESTASI', '`NILAI_INVESTASI`', '`NILAI_INVESTASI`', 5, 22, -1, false, '`NILAI_INVESTASI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NILAI_INVESTASI->Sortable = true; // Allow sort
        $this->NILAI_INVESTASI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NILAI_INVESTASI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NILAI_INVESTASI->Param, "CustomMsg");
        $this->Fields['NILAI_INVESTASI'] = &$this->NILAI_INVESTASI;

        // KAPASITAS
        $this->KAPASITAS = new DbField('ikm_sentra', 'ikm_sentra', 'x_KAPASITAS', 'KAPASITAS', '`KAPASITAS`', '`KAPASITAS`', 5, 22, -1, false, '`KAPASITAS`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAPASITAS->Sortable = true; // Allow sort
        $this->KAPASITAS->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->KAPASITAS->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPASITAS->Param, "CustomMsg");
        $this->Fields['KAPASITAS'] = &$this->KAPASITAS;

        // SATUAN
        $this->SATUAN = new DbField('ikm_sentra', 'ikm_sentra', 'x_SATUAN', 'SATUAN', '`SATUAN`', '`SATUAN`', 200, 20, -1, false, '`SATUAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SATUAN->Sortable = true; // Allow sort
        $this->SATUAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SATUAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SATUAN->Lookup = new Lookup('SATUAN', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->SATUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SATUAN->Param, "CustomMsg");
        $this->Fields['SATUAN'] = &$this->SATUAN;

        // NILAI_PRODUKSI
        $this->NILAI_PRODUKSI = new DbField('ikm_sentra', 'ikm_sentra', 'x_NILAI_PRODUKSI', 'NILAI_PRODUKSI', '`NILAI_PRODUKSI`', '`NILAI_PRODUKSI`', 5, 22, -1, false, '`NILAI_PRODUKSI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NILAI_PRODUKSI->Sortable = true; // Allow sort
        $this->NILAI_PRODUKSI->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NILAI_PRODUKSI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NILAI_PRODUKSI->Param, "CustomMsg");
        $this->Fields['NILAI_PRODUKSI'] = &$this->NILAI_PRODUKSI;

        // NILAI_BB_BP
        $this->NILAI_BB_BP = new DbField('ikm_sentra', 'ikm_sentra', 'x_NILAI_BB_BP', 'NILAI_BB_BP', '`NILAI_BB_BP`', '`NILAI_BB_BP`', 5, 22, -1, false, '`NILAI_BB_BP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NILAI_BB_BP->Sortable = true; // Allow sort
        $this->NILAI_BB_BP->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->NILAI_BB_BP->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->NILAI_BB_BP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NILAI_BB_BP->Param, "CustomMsg");
        $this->Fields['NILAI_BB_BP'] = &$this->NILAI_BB_BP;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`ikm_sentra`";
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
        $this->CABANG_INDUSTRI->DbValue = $row['CABANG_INDUSTRI'];
        $this->NAMA_SENTRA->DbValue = $row['NAMA_SENTRA'];
        $this->KBLI->DbValue = $row['KBLI'];
        $this->ALAMAT->DbValue = $row['ALAMAT'];
        $this->KAPANEWON->DbValue = $row['KAPANEWON'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->KONTAK->DbValue = $row['KONTAK'];
        $this->TELP->DbValue = $row['TELP'];
        $this->UNIT__USAHA->DbValue = $row['UNIT_ USAHA'];
        $this->TENAGA_KERJA->DbValue = $row['TENAGA_KERJA'];
        $this->NILAI_INVESTASI->DbValue = $row['NILAI_INVESTASI'];
        $this->KAPASITAS->DbValue = $row['KAPASITAS'];
        $this->SATUAN->DbValue = $row['SATUAN'];
        $this->NILAI_PRODUKSI->DbValue = $row['NILAI_PRODUKSI'];
        $this->NILAI_BB_BP->DbValue = $row['NILAI_BB_BP'];
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
        return $_SESSION[$name] ?? GetUrl("ikmsentralist");
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
        if ($pageName == "ikmsentraview") {
            return $Language->phrase("View");
        } elseif ($pageName == "ikmsentraedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ikmsentraadd") {
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
                return "IkmSentraView";
            case Config("API_ADD_ACTION"):
                return "IkmSentraAdd";
            case Config("API_EDIT_ACTION"):
                return "IkmSentraEdit";
            case Config("API_DELETE_ACTION"):
                return "IkmSentraDelete";
            case Config("API_LIST_ACTION"):
                return "IkmSentraList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ikmsentralist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ikmsentraview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ikmsentraview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ikmsentraadd?" . $this->getUrlParm($parm);
        } else {
            $url = "ikmsentraadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ikmsentraedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ikmsentraadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ikmsentradelete", $this->getUrlParm());
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
        $this->CABANG_INDUSTRI->setDbValue($row['CABANG_INDUSTRI']);
        $this->NAMA_SENTRA->setDbValue($row['NAMA_SENTRA']);
        $this->KBLI->setDbValue($row['KBLI']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->KONTAK->setDbValue($row['KONTAK']);
        $this->TELP->setDbValue($row['TELP']);
        $this->UNIT__USAHA->setDbValue($row['UNIT_ USAHA']);
        $this->TENAGA_KERJA->setDbValue($row['TENAGA_KERJA']);
        $this->NILAI_INVESTASI->setDbValue($row['NILAI_INVESTASI']);
        $this->KAPASITAS->setDbValue($row['KAPASITAS']);
        $this->SATUAN->setDbValue($row['SATUAN']);
        $this->NILAI_PRODUKSI->setDbValue($row['NILAI_PRODUKSI']);
        $this->NILAI_BB_BP->setDbValue($row['NILAI_BB_BP']);
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

        // CABANG_INDUSTRI

        // NAMA_SENTRA

        // KBLI
        $this->KBLI->CellCssStyle = "white-space: nowrap;";

        // ALAMAT

        // KAPANEWON

        // KALURAHAN

        // KONTAK

        // TELP

        // UNIT_ USAHA

        // TENAGA_KERJA

        // NILAI_INVESTASI

        // KAPASITAS

        // SATUAN

        // NILAI_PRODUKSI

        // NILAI_BB_BP

        // ID
        $this->ID->ViewValue = $this->ID->CurrentValue;
        $this->ID->ViewCustomAttributes = "";

        // CABANG_INDUSTRI
        $curVal = strval($this->CABANG_INDUSTRI->CurrentValue);
        if ($curVal != "") {
            $this->CABANG_INDUSTRI->ViewValue = $this->CABANG_INDUSTRI->lookupCacheOption($curVal);
            if ($this->CABANG_INDUSTRI->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Sentra IKM'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->CABANG_INDUSTRI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->CABANG_INDUSTRI->Lookup->renderViewRow($rswrk[0]);
                    $this->CABANG_INDUSTRI->ViewValue = $this->CABANG_INDUSTRI->displayValue($arwrk);
                } else {
                    $this->CABANG_INDUSTRI->ViewValue = $this->CABANG_INDUSTRI->CurrentValue;
                }
            }
        } else {
            $this->CABANG_INDUSTRI->ViewValue = null;
        }
        $this->CABANG_INDUSTRI->ViewCustomAttributes = "";

        // NAMA_SENTRA
        $this->NAMA_SENTRA->ViewValue = $this->NAMA_SENTRA->CurrentValue;
        $this->NAMA_SENTRA->ViewCustomAttributes = "";

        // KBLI
        $this->KBLI->ViewValue = $this->KBLI->CurrentValue;
        $this->KBLI->ViewCustomAttributes = "";

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

        // KONTAK
        $this->KONTAK->ViewValue = $this->KONTAK->CurrentValue;
        $this->KONTAK->ViewCustomAttributes = "";

        // TELP
        $this->TELP->ViewValue = $this->TELP->CurrentValue;
        $this->TELP->ViewCustomAttributes = "";

        // UNIT_ USAHA
        $this->UNIT__USAHA->ViewValue = $this->UNIT__USAHA->CurrentValue;
        $this->UNIT__USAHA->ViewValue = FormatNumber($this->UNIT__USAHA->ViewValue, 0, -2, -2, -2);
        $this->UNIT__USAHA->ViewCustomAttributes = "";

        // TENAGA_KERJA
        $this->TENAGA_KERJA->ViewValue = $this->TENAGA_KERJA->CurrentValue;
        $this->TENAGA_KERJA->ViewCustomAttributes = "";

        // NILAI_INVESTASI
        $this->NILAI_INVESTASI->ViewValue = $this->NILAI_INVESTASI->CurrentValue;
        $this->NILAI_INVESTASI->ViewValue = FormatNumber($this->NILAI_INVESTASI->ViewValue, 0, -2, -2, -2);
        $this->NILAI_INVESTASI->ViewCustomAttributes = "";

        // KAPASITAS
        $this->KAPASITAS->ViewValue = $this->KAPASITAS->CurrentValue;
        $this->KAPASITAS->ViewValue = FormatNumber($this->KAPASITAS->ViewValue, 0, -2, -2, -2);
        $this->KAPASITAS->ViewCustomAttributes = "";

        // SATUAN
        $curVal = strval($this->SATUAN->CurrentValue);
        if ($curVal != "") {
            $this->SATUAN->ViewValue = $this->SATUAN->lookupCacheOption($curVal);
            if ($this->SATUAN->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Satuan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SATUAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SATUAN->Lookup->renderViewRow($rswrk[0]);
                    $this->SATUAN->ViewValue = $this->SATUAN->displayValue($arwrk);
                } else {
                    $this->SATUAN->ViewValue = $this->SATUAN->CurrentValue;
                }
            }
        } else {
            $this->SATUAN->ViewValue = null;
        }
        $this->SATUAN->ViewCustomAttributes = "";

        // NILAI_PRODUKSI
        $this->NILAI_PRODUKSI->ViewValue = $this->NILAI_PRODUKSI->CurrentValue;
        $this->NILAI_PRODUKSI->ViewValue = FormatNumber($this->NILAI_PRODUKSI->ViewValue, 0, -2, -2, -2);
        $this->NILAI_PRODUKSI->ViewCustomAttributes = "";

        // NILAI_BB_BP
        $this->NILAI_BB_BP->ViewValue = $this->NILAI_BB_BP->CurrentValue;
        $this->NILAI_BB_BP->ViewValue = FormatNumber($this->NILAI_BB_BP->ViewValue, 2, -2, -2, -2);
        $this->NILAI_BB_BP->ViewCustomAttributes = "";

        // ID
        $this->ID->LinkCustomAttributes = "";
        $this->ID->HrefValue = "";
        $this->ID->TooltipValue = "";

        // CABANG_INDUSTRI
        $this->CABANG_INDUSTRI->LinkCustomAttributes = "";
        $this->CABANG_INDUSTRI->HrefValue = "";
        $this->CABANG_INDUSTRI->TooltipValue = "";

        // NAMA_SENTRA
        $this->NAMA_SENTRA->LinkCustomAttributes = "";
        $this->NAMA_SENTRA->HrefValue = "";
        $this->NAMA_SENTRA->TooltipValue = "";

        // KBLI
        $this->KBLI->LinkCustomAttributes = "";
        $this->KBLI->HrefValue = "";
        $this->KBLI->TooltipValue = "";

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

        // KONTAK
        $this->KONTAK->LinkCustomAttributes = "";
        $this->KONTAK->HrefValue = "";
        $this->KONTAK->TooltipValue = "";

        // TELP
        $this->TELP->LinkCustomAttributes = "";
        $this->TELP->HrefValue = "";
        $this->TELP->TooltipValue = "";

        // UNIT_ USAHA
        $this->UNIT__USAHA->LinkCustomAttributes = "";
        $this->UNIT__USAHA->HrefValue = "";
        $this->UNIT__USAHA->TooltipValue = "";

        // TENAGA_KERJA
        $this->TENAGA_KERJA->LinkCustomAttributes = "";
        $this->TENAGA_KERJA->HrefValue = "";
        $this->TENAGA_KERJA->TooltipValue = "";

        // NILAI_INVESTASI
        $this->NILAI_INVESTASI->LinkCustomAttributes = "";
        $this->NILAI_INVESTASI->HrefValue = "";
        $this->NILAI_INVESTASI->TooltipValue = "";

        // KAPASITAS
        $this->KAPASITAS->LinkCustomAttributes = "";
        $this->KAPASITAS->HrefValue = "";
        $this->KAPASITAS->TooltipValue = "";

        // SATUAN
        $this->SATUAN->LinkCustomAttributes = "";
        $this->SATUAN->HrefValue = "";
        $this->SATUAN->TooltipValue = "";

        // NILAI_PRODUKSI
        $this->NILAI_PRODUKSI->LinkCustomAttributes = "";
        $this->NILAI_PRODUKSI->HrefValue = "";
        $this->NILAI_PRODUKSI->TooltipValue = "";

        // NILAI_BB_BP
        $this->NILAI_BB_BP->LinkCustomAttributes = "";
        $this->NILAI_BB_BP->HrefValue = "";
        $this->NILAI_BB_BP->TooltipValue = "";

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
        $this->ID->ViewCustomAttributes = "";

        // CABANG_INDUSTRI
        $this->CABANG_INDUSTRI->EditAttrs["class"] = "form-control";
        $this->CABANG_INDUSTRI->EditCustomAttributes = "";
        $this->CABANG_INDUSTRI->PlaceHolder = RemoveHtml($this->CABANG_INDUSTRI->caption());

        // NAMA_SENTRA
        $this->NAMA_SENTRA->EditAttrs["class"] = "form-control";
        $this->NAMA_SENTRA->EditCustomAttributes = "";
        if (!$this->NAMA_SENTRA->Raw) {
            $this->NAMA_SENTRA->CurrentValue = HtmlDecode($this->NAMA_SENTRA->CurrentValue);
        }
        $this->NAMA_SENTRA->EditValue = $this->NAMA_SENTRA->CurrentValue;
        $this->NAMA_SENTRA->PlaceHolder = RemoveHtml($this->NAMA_SENTRA->caption());

        // KBLI
        $this->KBLI->EditAttrs["class"] = "form-control";
        $this->KBLI->EditCustomAttributes = "";
        if (!$this->KBLI->Raw) {
            $this->KBLI->CurrentValue = HtmlDecode($this->KBLI->CurrentValue);
        }
        $this->KBLI->EditValue = $this->KBLI->CurrentValue;
        $this->KBLI->PlaceHolder = RemoveHtml($this->KBLI->caption());

        // ALAMAT
        $this->ALAMAT->EditAttrs["class"] = "form-control";
        $this->ALAMAT->EditCustomAttributes = "";
        if (!$this->ALAMAT->Raw) {
            $this->ALAMAT->CurrentValue = HtmlDecode($this->ALAMAT->CurrentValue);
        }
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

        // KONTAK
        $this->KONTAK->EditAttrs["class"] = "form-control";
        $this->KONTAK->EditCustomAttributes = "";
        if (!$this->KONTAK->Raw) {
            $this->KONTAK->CurrentValue = HtmlDecode($this->KONTAK->CurrentValue);
        }
        $this->KONTAK->EditValue = $this->KONTAK->CurrentValue;
        $this->KONTAK->PlaceHolder = RemoveHtml($this->KONTAK->caption());

        // TELP
        $this->TELP->EditAttrs["class"] = "form-control";
        $this->TELP->EditCustomAttributes = "";
        if (!$this->TELP->Raw) {
            $this->TELP->CurrentValue = HtmlDecode($this->TELP->CurrentValue);
        }
        $this->TELP->EditValue = $this->TELP->CurrentValue;
        $this->TELP->PlaceHolder = RemoveHtml($this->TELP->caption());

        // UNIT_ USAHA
        $this->UNIT__USAHA->EditAttrs["class"] = "form-control";
        $this->UNIT__USAHA->EditCustomAttributes = "";
        $this->UNIT__USAHA->EditValue = $this->UNIT__USAHA->CurrentValue;
        $this->UNIT__USAHA->PlaceHolder = RemoveHtml($this->UNIT__USAHA->caption());

        // TENAGA_KERJA
        $this->TENAGA_KERJA->EditAttrs["class"] = "form-control";
        $this->TENAGA_KERJA->EditCustomAttributes = "";
        $this->TENAGA_KERJA->EditValue = $this->TENAGA_KERJA->CurrentValue;
        $this->TENAGA_KERJA->PlaceHolder = RemoveHtml($this->TENAGA_KERJA->caption());

        // NILAI_INVESTASI
        $this->NILAI_INVESTASI->EditAttrs["class"] = "form-control";
        $this->NILAI_INVESTASI->EditCustomAttributes = "";
        $this->NILAI_INVESTASI->EditValue = $this->NILAI_INVESTASI->CurrentValue;
        $this->NILAI_INVESTASI->PlaceHolder = RemoveHtml($this->NILAI_INVESTASI->caption());
        if (strval($this->NILAI_INVESTASI->EditValue) != "" && is_numeric($this->NILAI_INVESTASI->EditValue)) {
            $this->NILAI_INVESTASI->EditValue = FormatNumber($this->NILAI_INVESTASI->EditValue, -2, -2, -2, -2);
        }

        // KAPASITAS
        $this->KAPASITAS->EditAttrs["class"] = "form-control";
        $this->KAPASITAS->EditCustomAttributes = "";
        $this->KAPASITAS->EditValue = $this->KAPASITAS->CurrentValue;
        $this->KAPASITAS->PlaceHolder = RemoveHtml($this->KAPASITAS->caption());
        if (strval($this->KAPASITAS->EditValue) != "" && is_numeric($this->KAPASITAS->EditValue)) {
            $this->KAPASITAS->EditValue = FormatNumber($this->KAPASITAS->EditValue, -2, -2, -2, -2);
        }

        // SATUAN
        $this->SATUAN->EditAttrs["class"] = "form-control";
        $this->SATUAN->EditCustomAttributes = "";
        $this->SATUAN->PlaceHolder = RemoveHtml($this->SATUAN->caption());

        // NILAI_PRODUKSI
        $this->NILAI_PRODUKSI->EditAttrs["class"] = "form-control";
        $this->NILAI_PRODUKSI->EditCustomAttributes = "";
        $this->NILAI_PRODUKSI->EditValue = $this->NILAI_PRODUKSI->CurrentValue;
        $this->NILAI_PRODUKSI->PlaceHolder = RemoveHtml($this->NILAI_PRODUKSI->caption());
        if (strval($this->NILAI_PRODUKSI->EditValue) != "" && is_numeric($this->NILAI_PRODUKSI->EditValue)) {
            $this->NILAI_PRODUKSI->EditValue = FormatNumber($this->NILAI_PRODUKSI->EditValue, -2, -2, -2, -2);
        }

        // NILAI_BB_BP
        $this->NILAI_BB_BP->EditAttrs["class"] = "form-control";
        $this->NILAI_BB_BP->EditCustomAttributes = "";
        $this->NILAI_BB_BP->EditValue = $this->NILAI_BB_BP->CurrentValue;
        $this->NILAI_BB_BP->PlaceHolder = RemoveHtml($this->NILAI_BB_BP->caption());
        if (strval($this->NILAI_BB_BP->EditValue) != "" && is_numeric($this->NILAI_BB_BP->EditValue)) {
            $this->NILAI_BB_BP->EditValue = FormatNumber($this->NILAI_BB_BP->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->CABANG_INDUSTRI);
                    $doc->exportCaption($this->NAMA_SENTRA);
                    $doc->exportCaption($this->KBLI);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->KONTAK);
                    $doc->exportCaption($this->TELP);
                    $doc->exportCaption($this->UNIT__USAHA);
                    $doc->exportCaption($this->TENAGA_KERJA);
                    $doc->exportCaption($this->NILAI_INVESTASI);
                    $doc->exportCaption($this->KAPASITAS);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->NILAI_PRODUKSI);
                    $doc->exportCaption($this->NILAI_BB_BP);
                } else {
                    $doc->exportCaption($this->CABANG_INDUSTRI);
                    $doc->exportCaption($this->NAMA_SENTRA);
                    $doc->exportCaption($this->KBLI);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->KONTAK);
                    $doc->exportCaption($this->TELP);
                    $doc->exportCaption($this->UNIT__USAHA);
                    $doc->exportCaption($this->TENAGA_KERJA);
                    $doc->exportCaption($this->NILAI_INVESTASI);
                    $doc->exportCaption($this->KAPASITAS);
                    $doc->exportCaption($this->SATUAN);
                    $doc->exportCaption($this->NILAI_PRODUKSI);
                    $doc->exportCaption($this->NILAI_BB_BP);
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
                        $doc->exportField($this->CABANG_INDUSTRI);
                        $doc->exportField($this->NAMA_SENTRA);
                        $doc->exportField($this->KBLI);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->KONTAK);
                        $doc->exportField($this->TELP);
                        $doc->exportField($this->UNIT__USAHA);
                        $doc->exportField($this->TENAGA_KERJA);
                        $doc->exportField($this->NILAI_INVESTASI);
                        $doc->exportField($this->KAPASITAS);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->NILAI_PRODUKSI);
                        $doc->exportField($this->NILAI_BB_BP);
                    } else {
                        $doc->exportField($this->CABANG_INDUSTRI);
                        $doc->exportField($this->NAMA_SENTRA);
                        $doc->exportField($this->KBLI);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->KONTAK);
                        $doc->exportField($this->TELP);
                        $doc->exportField($this->UNIT__USAHA);
                        $doc->exportField($this->TENAGA_KERJA);
                        $doc->exportField($this->NILAI_INVESTASI);
                        $doc->exportField($this->KAPASITAS);
                        $doc->exportField($this->SATUAN);
                        $doc->exportField($this->NILAI_PRODUKSI);
                        $doc->exportField($this->NILAI_BB_BP);
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
