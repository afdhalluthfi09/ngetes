<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for res_nilai_keuangan
 */
class ResNilaiKeuangan extends DbTable
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
    public $nik;
    public $skor_income;
    public $max_income;
    public $skor_pengelolaan;
    public $max_pengelolaan;
    public $skor_nota;
    public $max_nota;
    public $skor_jurnal;
    public $max_jurnal;
    public $skor_akutansi;
    public $max_akutansi;
    public $skor_utangbank;
    public $max_utangbank;
    public $skor_dokumentasi;
    public $max_dokumentasi;
    public $skor_nontunai;
    public $max_nontunai;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'res_nilai_keuangan';
        $this->TableName = 'res_nilai_keuangan';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`res_nilai_keuangan`";
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

        // nik
        $this->nik = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // skor_income
        $this->skor_income = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_income', 'skor_income', '`skor_income`', '`skor_income`', 5, 23, -1, false, '`skor_income`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_income->Sortable = true; // Allow sort
        $this->skor_income->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_income->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_income->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_income->Param, "CustomMsg");
        $this->Fields['skor_income'] = &$this->skor_income;

        // max_income
        $this->max_income = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_income', 'max_income', '`max_income`', '`max_income`', 5, 23, -1, false, '`max_income`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_income->Sortable = true; // Allow sort
        $this->max_income->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_income->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_income->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_income->Param, "CustomMsg");
        $this->Fields['max_income'] = &$this->max_income;

        // skor_pengelolaan
        $this->skor_pengelolaan = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_pengelolaan', 'skor_pengelolaan', '`skor_pengelolaan`', '`skor_pengelolaan`', 5, 23, -1, false, '`skor_pengelolaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pengelolaan->Sortable = true; // Allow sort
        $this->skor_pengelolaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pengelolaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pengelolaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pengelolaan->Param, "CustomMsg");
        $this->Fields['skor_pengelolaan'] = &$this->skor_pengelolaan;

        // max_pengelolaan
        $this->max_pengelolaan = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_pengelolaan', 'max_pengelolaan', '`max_pengelolaan`', '`max_pengelolaan`', 5, 23, -1, false, '`max_pengelolaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_pengelolaan->Sortable = true; // Allow sort
        $this->max_pengelolaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_pengelolaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_pengelolaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_pengelolaan->Param, "CustomMsg");
        $this->Fields['max_pengelolaan'] = &$this->max_pengelolaan;

        // skor_nota
        $this->skor_nota = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_nota', 'skor_nota', '`skor_nota`', '`skor_nota`', 5, 23, -1, false, '`skor_nota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_nota->Sortable = true; // Allow sort
        $this->skor_nota->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_nota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_nota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_nota->Param, "CustomMsg");
        $this->Fields['skor_nota'] = &$this->skor_nota;

        // max_nota
        $this->max_nota = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_nota', 'max_nota', '`max_nota`', '`max_nota`', 5, 23, -1, false, '`max_nota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_nota->Sortable = true; // Allow sort
        $this->max_nota->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_nota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_nota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_nota->Param, "CustomMsg");
        $this->Fields['max_nota'] = &$this->max_nota;

        // skor_jurnal
        $this->skor_jurnal = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_jurnal', 'skor_jurnal', '`skor_jurnal`', '`skor_jurnal`', 5, 23, -1, false, '`skor_jurnal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_jurnal->Sortable = true; // Allow sort
        $this->skor_jurnal->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_jurnal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_jurnal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_jurnal->Param, "CustomMsg");
        $this->Fields['skor_jurnal'] = &$this->skor_jurnal;

        // max_jurnal
        $this->max_jurnal = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_jurnal', 'max_jurnal', '`max_jurnal`', '`max_jurnal`', 5, 23, -1, false, '`max_jurnal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_jurnal->Sortable = true; // Allow sort
        $this->max_jurnal->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_jurnal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_jurnal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_jurnal->Param, "CustomMsg");
        $this->Fields['max_jurnal'] = &$this->max_jurnal;

        // skor_akutansi
        $this->skor_akutansi = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_akutansi', 'skor_akutansi', '`skor_akutansi`', '`skor_akutansi`', 5, 23, -1, false, '`skor_akutansi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_akutansi->Sortable = true; // Allow sort
        $this->skor_akutansi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_akutansi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_akutansi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_akutansi->Param, "CustomMsg");
        $this->Fields['skor_akutansi'] = &$this->skor_akutansi;

        // max_akutansi
        $this->max_akutansi = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_akutansi', 'max_akutansi', '`max_akutansi`', '`max_akutansi`', 5, 23, -1, false, '`max_akutansi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_akutansi->Sortable = true; // Allow sort
        $this->max_akutansi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_akutansi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_akutansi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_akutansi->Param, "CustomMsg");
        $this->Fields['max_akutansi'] = &$this->max_akutansi;

        // skor_utangbank
        $this->skor_utangbank = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_utangbank', 'skor_utangbank', '`skor_utangbank`', '`skor_utangbank`', 5, 23, -1, false, '`skor_utangbank`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_utangbank->Sortable = true; // Allow sort
        $this->skor_utangbank->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_utangbank->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_utangbank->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_utangbank->Param, "CustomMsg");
        $this->Fields['skor_utangbank'] = &$this->skor_utangbank;

        // max_utangbank
        $this->max_utangbank = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_utangbank', 'max_utangbank', '`max_utangbank`', '`max_utangbank`', 5, 23, -1, false, '`max_utangbank`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_utangbank->Sortable = true; // Allow sort
        $this->max_utangbank->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_utangbank->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_utangbank->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_utangbank->Param, "CustomMsg");
        $this->Fields['max_utangbank'] = &$this->max_utangbank;

        // skor_dokumentasi
        $this->skor_dokumentasi = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_dokumentasi', 'skor_dokumentasi', '`skor_dokumentasi`', '`skor_dokumentasi`', 5, 23, -1, false, '`skor_dokumentasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_dokumentasi->Sortable = true; // Allow sort
        $this->skor_dokumentasi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_dokumentasi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_dokumentasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_dokumentasi->Param, "CustomMsg");
        $this->Fields['skor_dokumentasi'] = &$this->skor_dokumentasi;

        // max_dokumentasi
        $this->max_dokumentasi = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_dokumentasi', 'max_dokumentasi', '`max_dokumentasi`', '`max_dokumentasi`', 5, 23, -1, false, '`max_dokumentasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_dokumentasi->Sortable = true; // Allow sort
        $this->max_dokumentasi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_dokumentasi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_dokumentasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_dokumentasi->Param, "CustomMsg");
        $this->Fields['max_dokumentasi'] = &$this->max_dokumentasi;

        // skor_nontunai
        $this->skor_nontunai = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_skor_nontunai', 'skor_nontunai', '`skor_nontunai`', '`skor_nontunai`', 5, 23, -1, false, '`skor_nontunai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_nontunai->Sortable = true; // Allow sort
        $this->skor_nontunai->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_nontunai->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_nontunai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_nontunai->Param, "CustomMsg");
        $this->Fields['skor_nontunai'] = &$this->skor_nontunai;

        // max_nontunai
        $this->max_nontunai = new DbField('res_nilai_keuangan', 'res_nilai_keuangan', 'x_max_nontunai', 'max_nontunai', '`max_nontunai`', '`max_nontunai`', 5, 23, -1, false, '`max_nontunai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_nontunai->Sortable = true; // Allow sort
        $this->max_nontunai->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_nontunai->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_nontunai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_nontunai->Param, "CustomMsg");
        $this->Fields['max_nontunai'] = &$this->max_nontunai;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`res_nilai_keuangan`";
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
            if (array_key_exists('nik', $rs)) {
                AddFilter($where, QuotedName('nik', $this->Dbid) . '=' . QuotedValue($rs['nik'], $this->nik->DataType, $this->Dbid));
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
        $this->nik->DbValue = $row['nik'];
        $this->skor_income->DbValue = $row['skor_income'];
        $this->max_income->DbValue = $row['max_income'];
        $this->skor_pengelolaan->DbValue = $row['skor_pengelolaan'];
        $this->max_pengelolaan->DbValue = $row['max_pengelolaan'];
        $this->skor_nota->DbValue = $row['skor_nota'];
        $this->max_nota->DbValue = $row['max_nota'];
        $this->skor_jurnal->DbValue = $row['skor_jurnal'];
        $this->max_jurnal->DbValue = $row['max_jurnal'];
        $this->skor_akutansi->DbValue = $row['skor_akutansi'];
        $this->max_akutansi->DbValue = $row['max_akutansi'];
        $this->skor_utangbank->DbValue = $row['skor_utangbank'];
        $this->max_utangbank->DbValue = $row['max_utangbank'];
        $this->skor_dokumentasi->DbValue = $row['skor_dokumentasi'];
        $this->max_dokumentasi->DbValue = $row['max_dokumentasi'];
        $this->skor_nontunai->DbValue = $row['skor_nontunai'];
        $this->max_nontunai->DbValue = $row['max_nontunai'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`nik` = '@nik@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->nik->CurrentValue : $this->nik->OldValue;
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
                $this->nik->CurrentValue = $keys[0];
            } else {
                $this->nik->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('nik', $row) ? $row['nik'] : null;
        } else {
            $val = $this->nik->OldValue !== null ? $this->nik->OldValue : $this->nik->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@nik@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("resnilaikeuanganlist");
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
        if ($pageName == "resnilaikeuanganview") {
            return $Language->phrase("View");
        } elseif ($pageName == "resnilaikeuanganedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "resnilaikeuanganadd") {
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
                return "ResNilaiKeuanganView";
            case Config("API_ADD_ACTION"):
                return "ResNilaiKeuanganAdd";
            case Config("API_EDIT_ACTION"):
                return "ResNilaiKeuanganEdit";
            case Config("API_DELETE_ACTION"):
                return "ResNilaiKeuanganDelete";
            case Config("API_LIST_ACTION"):
                return "ResNilaiKeuanganList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "resnilaikeuanganlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("resnilaikeuanganview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("resnilaikeuanganview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "resnilaikeuanganadd?" . $this->getUrlParm($parm);
        } else {
            $url = "resnilaikeuanganadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("resnilaikeuanganedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("resnilaikeuanganadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("resnilaikeuangandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "nik:" . JsonEncode($this->nik->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->nik->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->nik->CurrentValue);
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
            if (($keyValue = Param("nik") ?? Route("nik")) !== null) {
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
                $this->nik->CurrentValue = $key;
            } else {
                $this->nik->OldValue = $key;
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
        $this->nik->setDbValue($row['nik']);
        $this->skor_income->setDbValue($row['skor_income']);
        $this->max_income->setDbValue($row['max_income']);
        $this->skor_pengelolaan->setDbValue($row['skor_pengelolaan']);
        $this->max_pengelolaan->setDbValue($row['max_pengelolaan']);
        $this->skor_nota->setDbValue($row['skor_nota']);
        $this->max_nota->setDbValue($row['max_nota']);
        $this->skor_jurnal->setDbValue($row['skor_jurnal']);
        $this->max_jurnal->setDbValue($row['max_jurnal']);
        $this->skor_akutansi->setDbValue($row['skor_akutansi']);
        $this->max_akutansi->setDbValue($row['max_akutansi']);
        $this->skor_utangbank->setDbValue($row['skor_utangbank']);
        $this->max_utangbank->setDbValue($row['max_utangbank']);
        $this->skor_dokumentasi->setDbValue($row['skor_dokumentasi']);
        $this->max_dokumentasi->setDbValue($row['max_dokumentasi']);
        $this->skor_nontunai->setDbValue($row['skor_nontunai']);
        $this->max_nontunai->setDbValue($row['max_nontunai']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // skor_income

        // max_income

        // skor_pengelolaan

        // max_pengelolaan

        // skor_nota

        // max_nota

        // skor_jurnal

        // max_jurnal

        // skor_akutansi

        // max_akutansi

        // skor_utangbank

        // max_utangbank

        // skor_dokumentasi

        // max_dokumentasi

        // skor_nontunai

        // max_nontunai

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // skor_income
        $this->skor_income->ViewValue = $this->skor_income->CurrentValue;
        $this->skor_income->ViewValue = FormatNumber($this->skor_income->ViewValue, 2, -2, -2, -2);
        $this->skor_income->ViewCustomAttributes = "";

        // max_income
        $this->max_income->ViewValue = $this->max_income->CurrentValue;
        $this->max_income->ViewValue = FormatNumber($this->max_income->ViewValue, 2, -2, -2, -2);
        $this->max_income->ViewCustomAttributes = "";

        // skor_pengelolaan
        $this->skor_pengelolaan->ViewValue = $this->skor_pengelolaan->CurrentValue;
        $this->skor_pengelolaan->ViewValue = FormatNumber($this->skor_pengelolaan->ViewValue, 2, -2, -2, -2);
        $this->skor_pengelolaan->ViewCustomAttributes = "";

        // max_pengelolaan
        $this->max_pengelolaan->ViewValue = $this->max_pengelolaan->CurrentValue;
        $this->max_pengelolaan->ViewValue = FormatNumber($this->max_pengelolaan->ViewValue, 2, -2, -2, -2);
        $this->max_pengelolaan->ViewCustomAttributes = "";

        // skor_nota
        $this->skor_nota->ViewValue = $this->skor_nota->CurrentValue;
        $this->skor_nota->ViewValue = FormatNumber($this->skor_nota->ViewValue, 2, -2, -2, -2);
        $this->skor_nota->ViewCustomAttributes = "";

        // max_nota
        $this->max_nota->ViewValue = $this->max_nota->CurrentValue;
        $this->max_nota->ViewValue = FormatNumber($this->max_nota->ViewValue, 2, -2, -2, -2);
        $this->max_nota->ViewCustomAttributes = "";

        // skor_jurnal
        $this->skor_jurnal->ViewValue = $this->skor_jurnal->CurrentValue;
        $this->skor_jurnal->ViewValue = FormatNumber($this->skor_jurnal->ViewValue, 2, -2, -2, -2);
        $this->skor_jurnal->ViewCustomAttributes = "";

        // max_jurnal
        $this->max_jurnal->ViewValue = $this->max_jurnal->CurrentValue;
        $this->max_jurnal->ViewValue = FormatNumber($this->max_jurnal->ViewValue, 2, -2, -2, -2);
        $this->max_jurnal->ViewCustomAttributes = "";

        // skor_akutansi
        $this->skor_akutansi->ViewValue = $this->skor_akutansi->CurrentValue;
        $this->skor_akutansi->ViewValue = FormatNumber($this->skor_akutansi->ViewValue, 2, -2, -2, -2);
        $this->skor_akutansi->ViewCustomAttributes = "";

        // max_akutansi
        $this->max_akutansi->ViewValue = $this->max_akutansi->CurrentValue;
        $this->max_akutansi->ViewValue = FormatNumber($this->max_akutansi->ViewValue, 2, -2, -2, -2);
        $this->max_akutansi->ViewCustomAttributes = "";

        // skor_utangbank
        $this->skor_utangbank->ViewValue = $this->skor_utangbank->CurrentValue;
        $this->skor_utangbank->ViewValue = FormatNumber($this->skor_utangbank->ViewValue, 2, -2, -2, -2);
        $this->skor_utangbank->ViewCustomAttributes = "";

        // max_utangbank
        $this->max_utangbank->ViewValue = $this->max_utangbank->CurrentValue;
        $this->max_utangbank->ViewValue = FormatNumber($this->max_utangbank->ViewValue, 2, -2, -2, -2);
        $this->max_utangbank->ViewCustomAttributes = "";

        // skor_dokumentasi
        $this->skor_dokumentasi->ViewValue = $this->skor_dokumentasi->CurrentValue;
        $this->skor_dokumentasi->ViewValue = FormatNumber($this->skor_dokumentasi->ViewValue, 2, -2, -2, -2);
        $this->skor_dokumentasi->ViewCustomAttributes = "";

        // max_dokumentasi
        $this->max_dokumentasi->ViewValue = $this->max_dokumentasi->CurrentValue;
        $this->max_dokumentasi->ViewValue = FormatNumber($this->max_dokumentasi->ViewValue, 2, -2, -2, -2);
        $this->max_dokumentasi->ViewCustomAttributes = "";

        // skor_nontunai
        $this->skor_nontunai->ViewValue = $this->skor_nontunai->CurrentValue;
        $this->skor_nontunai->ViewValue = FormatNumber($this->skor_nontunai->ViewValue, 2, -2, -2, -2);
        $this->skor_nontunai->ViewCustomAttributes = "";

        // max_nontunai
        $this->max_nontunai->ViewValue = $this->max_nontunai->CurrentValue;
        $this->max_nontunai->ViewValue = FormatNumber($this->max_nontunai->ViewValue, 2, -2, -2, -2);
        $this->max_nontunai->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // skor_income
        $this->skor_income->LinkCustomAttributes = "";
        $this->skor_income->HrefValue = "";
        $this->skor_income->TooltipValue = "";

        // max_income
        $this->max_income->LinkCustomAttributes = "";
        $this->max_income->HrefValue = "";
        $this->max_income->TooltipValue = "";

        // skor_pengelolaan
        $this->skor_pengelolaan->LinkCustomAttributes = "";
        $this->skor_pengelolaan->HrefValue = "";
        $this->skor_pengelolaan->TooltipValue = "";

        // max_pengelolaan
        $this->max_pengelolaan->LinkCustomAttributes = "";
        $this->max_pengelolaan->HrefValue = "";
        $this->max_pengelolaan->TooltipValue = "";

        // skor_nota
        $this->skor_nota->LinkCustomAttributes = "";
        $this->skor_nota->HrefValue = "";
        $this->skor_nota->TooltipValue = "";

        // max_nota
        $this->max_nota->LinkCustomAttributes = "";
        $this->max_nota->HrefValue = "";
        $this->max_nota->TooltipValue = "";

        // skor_jurnal
        $this->skor_jurnal->LinkCustomAttributes = "";
        $this->skor_jurnal->HrefValue = "";
        $this->skor_jurnal->TooltipValue = "";

        // max_jurnal
        $this->max_jurnal->LinkCustomAttributes = "";
        $this->max_jurnal->HrefValue = "";
        $this->max_jurnal->TooltipValue = "";

        // skor_akutansi
        $this->skor_akutansi->LinkCustomAttributes = "";
        $this->skor_akutansi->HrefValue = "";
        $this->skor_akutansi->TooltipValue = "";

        // max_akutansi
        $this->max_akutansi->LinkCustomAttributes = "";
        $this->max_akutansi->HrefValue = "";
        $this->max_akutansi->TooltipValue = "";

        // skor_utangbank
        $this->skor_utangbank->LinkCustomAttributes = "";
        $this->skor_utangbank->HrefValue = "";
        $this->skor_utangbank->TooltipValue = "";

        // max_utangbank
        $this->max_utangbank->LinkCustomAttributes = "";
        $this->max_utangbank->HrefValue = "";
        $this->max_utangbank->TooltipValue = "";

        // skor_dokumentasi
        $this->skor_dokumentasi->LinkCustomAttributes = "";
        $this->skor_dokumentasi->HrefValue = "";
        $this->skor_dokumentasi->TooltipValue = "";

        // max_dokumentasi
        $this->max_dokumentasi->LinkCustomAttributes = "";
        $this->max_dokumentasi->HrefValue = "";
        $this->max_dokumentasi->TooltipValue = "";

        // skor_nontunai
        $this->skor_nontunai->LinkCustomAttributes = "";
        $this->skor_nontunai->HrefValue = "";
        $this->skor_nontunai->TooltipValue = "";

        // max_nontunai
        $this->max_nontunai->LinkCustomAttributes = "";
        $this->max_nontunai->HrefValue = "";
        $this->max_nontunai->TooltipValue = "";

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

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        if (!$this->nik->Raw) {
            $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
        }
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // skor_income
        $this->skor_income->EditAttrs["class"] = "form-control";
        $this->skor_income->EditCustomAttributes = "";
        $this->skor_income->EditValue = $this->skor_income->CurrentValue;
        $this->skor_income->PlaceHolder = RemoveHtml($this->skor_income->caption());
        if (strval($this->skor_income->EditValue) != "" && is_numeric($this->skor_income->EditValue)) {
            $this->skor_income->EditValue = FormatNumber($this->skor_income->EditValue, -2, -2, -2, -2);
        }

        // max_income
        $this->max_income->EditAttrs["class"] = "form-control";
        $this->max_income->EditCustomAttributes = "";
        $this->max_income->EditValue = $this->max_income->CurrentValue;
        $this->max_income->PlaceHolder = RemoveHtml($this->max_income->caption());
        if (strval($this->max_income->EditValue) != "" && is_numeric($this->max_income->EditValue)) {
            $this->max_income->EditValue = FormatNumber($this->max_income->EditValue, -2, -2, -2, -2);
        }

        // skor_pengelolaan
        $this->skor_pengelolaan->EditAttrs["class"] = "form-control";
        $this->skor_pengelolaan->EditCustomAttributes = "";
        $this->skor_pengelolaan->EditValue = $this->skor_pengelolaan->CurrentValue;
        $this->skor_pengelolaan->PlaceHolder = RemoveHtml($this->skor_pengelolaan->caption());
        if (strval($this->skor_pengelolaan->EditValue) != "" && is_numeric($this->skor_pengelolaan->EditValue)) {
            $this->skor_pengelolaan->EditValue = FormatNumber($this->skor_pengelolaan->EditValue, -2, -2, -2, -2);
        }

        // max_pengelolaan
        $this->max_pengelolaan->EditAttrs["class"] = "form-control";
        $this->max_pengelolaan->EditCustomAttributes = "";
        $this->max_pengelolaan->EditValue = $this->max_pengelolaan->CurrentValue;
        $this->max_pengelolaan->PlaceHolder = RemoveHtml($this->max_pengelolaan->caption());
        if (strval($this->max_pengelolaan->EditValue) != "" && is_numeric($this->max_pengelolaan->EditValue)) {
            $this->max_pengelolaan->EditValue = FormatNumber($this->max_pengelolaan->EditValue, -2, -2, -2, -2);
        }

        // skor_nota
        $this->skor_nota->EditAttrs["class"] = "form-control";
        $this->skor_nota->EditCustomAttributes = "";
        $this->skor_nota->EditValue = $this->skor_nota->CurrentValue;
        $this->skor_nota->PlaceHolder = RemoveHtml($this->skor_nota->caption());
        if (strval($this->skor_nota->EditValue) != "" && is_numeric($this->skor_nota->EditValue)) {
            $this->skor_nota->EditValue = FormatNumber($this->skor_nota->EditValue, -2, -2, -2, -2);
        }

        // max_nota
        $this->max_nota->EditAttrs["class"] = "form-control";
        $this->max_nota->EditCustomAttributes = "";
        $this->max_nota->EditValue = $this->max_nota->CurrentValue;
        $this->max_nota->PlaceHolder = RemoveHtml($this->max_nota->caption());
        if (strval($this->max_nota->EditValue) != "" && is_numeric($this->max_nota->EditValue)) {
            $this->max_nota->EditValue = FormatNumber($this->max_nota->EditValue, -2, -2, -2, -2);
        }

        // skor_jurnal
        $this->skor_jurnal->EditAttrs["class"] = "form-control";
        $this->skor_jurnal->EditCustomAttributes = "";
        $this->skor_jurnal->EditValue = $this->skor_jurnal->CurrentValue;
        $this->skor_jurnal->PlaceHolder = RemoveHtml($this->skor_jurnal->caption());
        if (strval($this->skor_jurnal->EditValue) != "" && is_numeric($this->skor_jurnal->EditValue)) {
            $this->skor_jurnal->EditValue = FormatNumber($this->skor_jurnal->EditValue, -2, -2, -2, -2);
        }

        // max_jurnal
        $this->max_jurnal->EditAttrs["class"] = "form-control";
        $this->max_jurnal->EditCustomAttributes = "";
        $this->max_jurnal->EditValue = $this->max_jurnal->CurrentValue;
        $this->max_jurnal->PlaceHolder = RemoveHtml($this->max_jurnal->caption());
        if (strval($this->max_jurnal->EditValue) != "" && is_numeric($this->max_jurnal->EditValue)) {
            $this->max_jurnal->EditValue = FormatNumber($this->max_jurnal->EditValue, -2, -2, -2, -2);
        }

        // skor_akutansi
        $this->skor_akutansi->EditAttrs["class"] = "form-control";
        $this->skor_akutansi->EditCustomAttributes = "";
        $this->skor_akutansi->EditValue = $this->skor_akutansi->CurrentValue;
        $this->skor_akutansi->PlaceHolder = RemoveHtml($this->skor_akutansi->caption());
        if (strval($this->skor_akutansi->EditValue) != "" && is_numeric($this->skor_akutansi->EditValue)) {
            $this->skor_akutansi->EditValue = FormatNumber($this->skor_akutansi->EditValue, -2, -2, -2, -2);
        }

        // max_akutansi
        $this->max_akutansi->EditAttrs["class"] = "form-control";
        $this->max_akutansi->EditCustomAttributes = "";
        $this->max_akutansi->EditValue = $this->max_akutansi->CurrentValue;
        $this->max_akutansi->PlaceHolder = RemoveHtml($this->max_akutansi->caption());
        if (strval($this->max_akutansi->EditValue) != "" && is_numeric($this->max_akutansi->EditValue)) {
            $this->max_akutansi->EditValue = FormatNumber($this->max_akutansi->EditValue, -2, -2, -2, -2);
        }

        // skor_utangbank
        $this->skor_utangbank->EditAttrs["class"] = "form-control";
        $this->skor_utangbank->EditCustomAttributes = "";
        $this->skor_utangbank->EditValue = $this->skor_utangbank->CurrentValue;
        $this->skor_utangbank->PlaceHolder = RemoveHtml($this->skor_utangbank->caption());
        if (strval($this->skor_utangbank->EditValue) != "" && is_numeric($this->skor_utangbank->EditValue)) {
            $this->skor_utangbank->EditValue = FormatNumber($this->skor_utangbank->EditValue, -2, -2, -2, -2);
        }

        // max_utangbank
        $this->max_utangbank->EditAttrs["class"] = "form-control";
        $this->max_utangbank->EditCustomAttributes = "";
        $this->max_utangbank->EditValue = $this->max_utangbank->CurrentValue;
        $this->max_utangbank->PlaceHolder = RemoveHtml($this->max_utangbank->caption());
        if (strval($this->max_utangbank->EditValue) != "" && is_numeric($this->max_utangbank->EditValue)) {
            $this->max_utangbank->EditValue = FormatNumber($this->max_utangbank->EditValue, -2, -2, -2, -2);
        }

        // skor_dokumentasi
        $this->skor_dokumentasi->EditAttrs["class"] = "form-control";
        $this->skor_dokumentasi->EditCustomAttributes = "";
        $this->skor_dokumentasi->EditValue = $this->skor_dokumentasi->CurrentValue;
        $this->skor_dokumentasi->PlaceHolder = RemoveHtml($this->skor_dokumentasi->caption());
        if (strval($this->skor_dokumentasi->EditValue) != "" && is_numeric($this->skor_dokumentasi->EditValue)) {
            $this->skor_dokumentasi->EditValue = FormatNumber($this->skor_dokumentasi->EditValue, -2, -2, -2, -2);
        }

        // max_dokumentasi
        $this->max_dokumentasi->EditAttrs["class"] = "form-control";
        $this->max_dokumentasi->EditCustomAttributes = "";
        $this->max_dokumentasi->EditValue = $this->max_dokumentasi->CurrentValue;
        $this->max_dokumentasi->PlaceHolder = RemoveHtml($this->max_dokumentasi->caption());
        if (strval($this->max_dokumentasi->EditValue) != "" && is_numeric($this->max_dokumentasi->EditValue)) {
            $this->max_dokumentasi->EditValue = FormatNumber($this->max_dokumentasi->EditValue, -2, -2, -2, -2);
        }

        // skor_nontunai
        $this->skor_nontunai->EditAttrs["class"] = "form-control";
        $this->skor_nontunai->EditCustomAttributes = "";
        $this->skor_nontunai->EditValue = $this->skor_nontunai->CurrentValue;
        $this->skor_nontunai->PlaceHolder = RemoveHtml($this->skor_nontunai->caption());
        if (strval($this->skor_nontunai->EditValue) != "" && is_numeric($this->skor_nontunai->EditValue)) {
            $this->skor_nontunai->EditValue = FormatNumber($this->skor_nontunai->EditValue, -2, -2, -2, -2);
        }

        // max_nontunai
        $this->max_nontunai->EditAttrs["class"] = "form-control";
        $this->max_nontunai->EditCustomAttributes = "";
        $this->max_nontunai->EditValue = $this->max_nontunai->CurrentValue;
        $this->max_nontunai->PlaceHolder = RemoveHtml($this->max_nontunai->caption());
        if (strval($this->max_nontunai->EditValue) != "" && is_numeric($this->max_nontunai->EditValue)) {
            $this->max_nontunai->EditValue = FormatNumber($this->max_nontunai->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_income);
                    $doc->exportCaption($this->max_income);
                    $doc->exportCaption($this->skor_pengelolaan);
                    $doc->exportCaption($this->max_pengelolaan);
                    $doc->exportCaption($this->skor_nota);
                    $doc->exportCaption($this->max_nota);
                    $doc->exportCaption($this->skor_jurnal);
                    $doc->exportCaption($this->max_jurnal);
                    $doc->exportCaption($this->skor_akutansi);
                    $doc->exportCaption($this->max_akutansi);
                    $doc->exportCaption($this->skor_utangbank);
                    $doc->exportCaption($this->max_utangbank);
                    $doc->exportCaption($this->skor_dokumentasi);
                    $doc->exportCaption($this->max_dokumentasi);
                    $doc->exportCaption($this->skor_nontunai);
                    $doc->exportCaption($this->max_nontunai);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_income);
                    $doc->exportCaption($this->max_income);
                    $doc->exportCaption($this->skor_pengelolaan);
                    $doc->exportCaption($this->max_pengelolaan);
                    $doc->exportCaption($this->skor_nota);
                    $doc->exportCaption($this->max_nota);
                    $doc->exportCaption($this->skor_jurnal);
                    $doc->exportCaption($this->max_jurnal);
                    $doc->exportCaption($this->skor_akutansi);
                    $doc->exportCaption($this->max_akutansi);
                    $doc->exportCaption($this->skor_utangbank);
                    $doc->exportCaption($this->max_utangbank);
                    $doc->exportCaption($this->skor_dokumentasi);
                    $doc->exportCaption($this->max_dokumentasi);
                    $doc->exportCaption($this->skor_nontunai);
                    $doc->exportCaption($this->max_nontunai);
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
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_income);
                        $doc->exportField($this->max_income);
                        $doc->exportField($this->skor_pengelolaan);
                        $doc->exportField($this->max_pengelolaan);
                        $doc->exportField($this->skor_nota);
                        $doc->exportField($this->max_nota);
                        $doc->exportField($this->skor_jurnal);
                        $doc->exportField($this->max_jurnal);
                        $doc->exportField($this->skor_akutansi);
                        $doc->exportField($this->max_akutansi);
                        $doc->exportField($this->skor_utangbank);
                        $doc->exportField($this->max_utangbank);
                        $doc->exportField($this->skor_dokumentasi);
                        $doc->exportField($this->max_dokumentasi);
                        $doc->exportField($this->skor_nontunai);
                        $doc->exportField($this->max_nontunai);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_income);
                        $doc->exportField($this->max_income);
                        $doc->exportField($this->skor_pengelolaan);
                        $doc->exportField($this->max_pengelolaan);
                        $doc->exportField($this->skor_nota);
                        $doc->exportField($this->max_nota);
                        $doc->exportField($this->skor_jurnal);
                        $doc->exportField($this->max_jurnal);
                        $doc->exportField($this->skor_akutansi);
                        $doc->exportField($this->max_akutansi);
                        $doc->exportField($this->skor_utangbank);
                        $doc->exportField($this->max_utangbank);
                        $doc->exportField($this->skor_dokumentasi);
                        $doc->exportField($this->max_dokumentasi);
                        $doc->exportField($this->skor_nontunai);
                        $doc->exportField($this->max_nontunai);
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
