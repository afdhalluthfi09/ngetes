<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for res_nilai_produksi
 */
class ResNilaiProduksi extends DbTable
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
    public $skor_aktifitas;
    public $max_aktifitas;
    public $skor_kapasitas;
    public $max_kapasitas;
    public $skor_pangan;
    public $max_pangan;
    public $skor_sni;
    public $max_sni;
    public $skor_kemasan;
    public $max_kemasan;
    public $skor_bahanbaku;
    public $max_bahanbaku;
    public $skor_alat;
    public $max_alat;
    public $skor_gudang;
    public $max_gudang;
    public $skor_layout;
    public $max_layout;
    public $skor_sop;
    public $max_sop;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'res_nilai_produksi';
        $this->TableName = 'res_nilai_produksi';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`res_nilai_produksi`";
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
        $this->nik = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // skor_aktifitas
        $this->skor_aktifitas = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_aktifitas', 'skor_aktifitas', '`skor_aktifitas`', '`skor_aktifitas`', 5, 23, -1, false, '`skor_aktifitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_aktifitas->Sortable = true; // Allow sort
        $this->skor_aktifitas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_aktifitas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_aktifitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_aktifitas->Param, "CustomMsg");
        $this->Fields['skor_aktifitas'] = &$this->skor_aktifitas;

        // max_aktifitas
        $this->max_aktifitas = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_aktifitas', 'max_aktifitas', '`max_aktifitas`', '`max_aktifitas`', 5, 23, -1, false, '`max_aktifitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_aktifitas->Sortable = true; // Allow sort
        $this->max_aktifitas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_aktifitas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_aktifitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_aktifitas->Param, "CustomMsg");
        $this->Fields['max_aktifitas'] = &$this->max_aktifitas;

        // skor_kapasitas
        $this->skor_kapasitas = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_kapasitas', 'skor_kapasitas', '`skor_kapasitas`', '`skor_kapasitas`', 5, 23, -1, false, '`skor_kapasitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_kapasitas->Sortable = true; // Allow sort
        $this->skor_kapasitas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_kapasitas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_kapasitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_kapasitas->Param, "CustomMsg");
        $this->Fields['skor_kapasitas'] = &$this->skor_kapasitas;

        // max_kapasitas
        $this->max_kapasitas = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_kapasitas', 'max_kapasitas', '`max_kapasitas`', '`max_kapasitas`', 5, 23, -1, false, '`max_kapasitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_kapasitas->Sortable = true; // Allow sort
        $this->max_kapasitas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_kapasitas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_kapasitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_kapasitas->Param, "CustomMsg");
        $this->Fields['max_kapasitas'] = &$this->max_kapasitas;

        // skor_pangan
        $this->skor_pangan = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_pangan', 'skor_pangan', '`skor_pangan`', '`skor_pangan`', 5, 23, -1, false, '`skor_pangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pangan->Sortable = true; // Allow sort
        $this->skor_pangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pangan->Param, "CustomMsg");
        $this->Fields['skor_pangan'] = &$this->skor_pangan;

        // max_pangan
        $this->max_pangan = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_pangan', 'max_pangan', '`max_pangan`', '`max_pangan`', 5, 23, -1, false, '`max_pangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_pangan->Sortable = true; // Allow sort
        $this->max_pangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_pangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_pangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_pangan->Param, "CustomMsg");
        $this->Fields['max_pangan'] = &$this->max_pangan;

        // skor_sni
        $this->skor_sni = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_sni', 'skor_sni', '`skor_sni`', '`skor_sni`', 5, 23, -1, false, '`skor_sni`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_sni->Sortable = true; // Allow sort
        $this->skor_sni->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_sni->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_sni->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_sni->Param, "CustomMsg");
        $this->Fields['skor_sni'] = &$this->skor_sni;

        // max_sni
        $this->max_sni = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_sni', 'max_sni', '`max_sni`', '`max_sni`', 5, 23, -1, false, '`max_sni`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_sni->Sortable = true; // Allow sort
        $this->max_sni->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_sni->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_sni->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_sni->Param, "CustomMsg");
        $this->Fields['max_sni'] = &$this->max_sni;

        // skor_kemasan
        $this->skor_kemasan = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_kemasan', 'skor_kemasan', '`skor_kemasan`', '`skor_kemasan`', 5, 23, -1, false, '`skor_kemasan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_kemasan->Sortable = true; // Allow sort
        $this->skor_kemasan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_kemasan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_kemasan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_kemasan->Param, "CustomMsg");
        $this->Fields['skor_kemasan'] = &$this->skor_kemasan;

        // max_kemasan
        $this->max_kemasan = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_kemasan', 'max_kemasan', '`max_kemasan`', '`max_kemasan`', 5, 23, -1, false, '`max_kemasan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_kemasan->Sortable = true; // Allow sort
        $this->max_kemasan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_kemasan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_kemasan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_kemasan->Param, "CustomMsg");
        $this->Fields['max_kemasan'] = &$this->max_kemasan;

        // skor_bahanbaku
        $this->skor_bahanbaku = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_bahanbaku', 'skor_bahanbaku', '`skor_bahanbaku`', '`skor_bahanbaku`', 5, 23, -1, false, '`skor_bahanbaku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_bahanbaku->Sortable = true; // Allow sort
        $this->skor_bahanbaku->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_bahanbaku->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_bahanbaku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_bahanbaku->Param, "CustomMsg");
        $this->Fields['skor_bahanbaku'] = &$this->skor_bahanbaku;

        // max_bahanbaku
        $this->max_bahanbaku = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_bahanbaku', 'max_bahanbaku', '`max_bahanbaku`', '`max_bahanbaku`', 5, 23, -1, false, '`max_bahanbaku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_bahanbaku->Sortable = true; // Allow sort
        $this->max_bahanbaku->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_bahanbaku->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_bahanbaku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_bahanbaku->Param, "CustomMsg");
        $this->Fields['max_bahanbaku'] = &$this->max_bahanbaku;

        // skor_alat
        $this->skor_alat = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_alat', 'skor_alat', '`skor_alat`', '`skor_alat`', 5, 23, -1, false, '`skor_alat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_alat->Sortable = true; // Allow sort
        $this->skor_alat->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_alat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_alat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_alat->Param, "CustomMsg");
        $this->Fields['skor_alat'] = &$this->skor_alat;

        // max_alat
        $this->max_alat = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_alat', 'max_alat', '`max_alat`', '`max_alat`', 5, 23, -1, false, '`max_alat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_alat->Sortable = true; // Allow sort
        $this->max_alat->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_alat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_alat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_alat->Param, "CustomMsg");
        $this->Fields['max_alat'] = &$this->max_alat;

        // skor_gudang
        $this->skor_gudang = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_gudang', 'skor_gudang', '`skor_gudang`', '`skor_gudang`', 5, 23, -1, false, '`skor_gudang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_gudang->Sortable = true; // Allow sort
        $this->skor_gudang->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_gudang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_gudang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_gudang->Param, "CustomMsg");
        $this->Fields['skor_gudang'] = &$this->skor_gudang;

        // max_gudang
        $this->max_gudang = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_gudang', 'max_gudang', '`max_gudang`', '`max_gudang`', 5, 23, -1, false, '`max_gudang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_gudang->Sortable = true; // Allow sort
        $this->max_gudang->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_gudang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_gudang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_gudang->Param, "CustomMsg");
        $this->Fields['max_gudang'] = &$this->max_gudang;

        // skor_layout
        $this->skor_layout = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_layout', 'skor_layout', '`skor_layout`', '`skor_layout`', 5, 23, -1, false, '`skor_layout`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_layout->Sortable = true; // Allow sort
        $this->skor_layout->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_layout->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_layout->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_layout->Param, "CustomMsg");
        $this->Fields['skor_layout'] = &$this->skor_layout;

        // max_layout
        $this->max_layout = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_layout', 'max_layout', '`max_layout`', '`max_layout`', 5, 23, -1, false, '`max_layout`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_layout->Sortable = true; // Allow sort
        $this->max_layout->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_layout->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_layout->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_layout->Param, "CustomMsg");
        $this->Fields['max_layout'] = &$this->max_layout;

        // skor_sop
        $this->skor_sop = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_skor_sop', 'skor_sop', '`skor_sop`', '`skor_sop`', 5, 23, -1, false, '`skor_sop`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_sop->Sortable = true; // Allow sort
        $this->skor_sop->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_sop->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_sop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_sop->Param, "CustomMsg");
        $this->Fields['skor_sop'] = &$this->skor_sop;

        // max_sop
        $this->max_sop = new DbField('res_nilai_produksi', 'res_nilai_produksi', 'x_max_sop', 'max_sop', '`max_sop`', '`max_sop`', 5, 23, -1, false, '`max_sop`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_sop->Sortable = true; // Allow sort
        $this->max_sop->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_sop->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_sop->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_sop->Param, "CustomMsg");
        $this->Fields['max_sop'] = &$this->max_sop;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`res_nilai_produksi`";
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
        $this->skor_aktifitas->DbValue = $row['skor_aktifitas'];
        $this->max_aktifitas->DbValue = $row['max_aktifitas'];
        $this->skor_kapasitas->DbValue = $row['skor_kapasitas'];
        $this->max_kapasitas->DbValue = $row['max_kapasitas'];
        $this->skor_pangan->DbValue = $row['skor_pangan'];
        $this->max_pangan->DbValue = $row['max_pangan'];
        $this->skor_sni->DbValue = $row['skor_sni'];
        $this->max_sni->DbValue = $row['max_sni'];
        $this->skor_kemasan->DbValue = $row['skor_kemasan'];
        $this->max_kemasan->DbValue = $row['max_kemasan'];
        $this->skor_bahanbaku->DbValue = $row['skor_bahanbaku'];
        $this->max_bahanbaku->DbValue = $row['max_bahanbaku'];
        $this->skor_alat->DbValue = $row['skor_alat'];
        $this->max_alat->DbValue = $row['max_alat'];
        $this->skor_gudang->DbValue = $row['skor_gudang'];
        $this->max_gudang->DbValue = $row['max_gudang'];
        $this->skor_layout->DbValue = $row['skor_layout'];
        $this->max_layout->DbValue = $row['max_layout'];
        $this->skor_sop->DbValue = $row['skor_sop'];
        $this->max_sop->DbValue = $row['max_sop'];
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
        return $_SESSION[$name] ?? GetUrl("resnilaiproduksilist");
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
        if ($pageName == "resnilaiproduksiview") {
            return $Language->phrase("View");
        } elseif ($pageName == "resnilaiproduksiedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "resnilaiproduksiadd") {
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
                return "ResNilaiProduksiView";
            case Config("API_ADD_ACTION"):
                return "ResNilaiProduksiAdd";
            case Config("API_EDIT_ACTION"):
                return "ResNilaiProduksiEdit";
            case Config("API_DELETE_ACTION"):
                return "ResNilaiProduksiDelete";
            case Config("API_LIST_ACTION"):
                return "ResNilaiProduksiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "resnilaiproduksilist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("resnilaiproduksiview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("resnilaiproduksiview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "resnilaiproduksiadd?" . $this->getUrlParm($parm);
        } else {
            $url = "resnilaiproduksiadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("resnilaiproduksiedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("resnilaiproduksiadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("resnilaiproduksidelete", $this->getUrlParm());
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
        $this->skor_aktifitas->setDbValue($row['skor_aktifitas']);
        $this->max_aktifitas->setDbValue($row['max_aktifitas']);
        $this->skor_kapasitas->setDbValue($row['skor_kapasitas']);
        $this->max_kapasitas->setDbValue($row['max_kapasitas']);
        $this->skor_pangan->setDbValue($row['skor_pangan']);
        $this->max_pangan->setDbValue($row['max_pangan']);
        $this->skor_sni->setDbValue($row['skor_sni']);
        $this->max_sni->setDbValue($row['max_sni']);
        $this->skor_kemasan->setDbValue($row['skor_kemasan']);
        $this->max_kemasan->setDbValue($row['max_kemasan']);
        $this->skor_bahanbaku->setDbValue($row['skor_bahanbaku']);
        $this->max_bahanbaku->setDbValue($row['max_bahanbaku']);
        $this->skor_alat->setDbValue($row['skor_alat']);
        $this->max_alat->setDbValue($row['max_alat']);
        $this->skor_gudang->setDbValue($row['skor_gudang']);
        $this->max_gudang->setDbValue($row['max_gudang']);
        $this->skor_layout->setDbValue($row['skor_layout']);
        $this->max_layout->setDbValue($row['max_layout']);
        $this->skor_sop->setDbValue($row['skor_sop']);
        $this->max_sop->setDbValue($row['max_sop']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // skor_aktifitas

        // max_aktifitas

        // skor_kapasitas

        // max_kapasitas

        // skor_pangan

        // max_pangan

        // skor_sni

        // max_sni

        // skor_kemasan

        // max_kemasan

        // skor_bahanbaku

        // max_bahanbaku

        // skor_alat

        // max_alat

        // skor_gudang

        // max_gudang

        // skor_layout

        // max_layout

        // skor_sop

        // max_sop

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // skor_aktifitas
        $this->skor_aktifitas->ViewValue = $this->skor_aktifitas->CurrentValue;
        $this->skor_aktifitas->ViewValue = FormatNumber($this->skor_aktifitas->ViewValue, 2, -2, -2, -2);
        $this->skor_aktifitas->ViewCustomAttributes = "";

        // max_aktifitas
        $this->max_aktifitas->ViewValue = $this->max_aktifitas->CurrentValue;
        $this->max_aktifitas->ViewValue = FormatNumber($this->max_aktifitas->ViewValue, 2, -2, -2, -2);
        $this->max_aktifitas->ViewCustomAttributes = "";

        // skor_kapasitas
        $this->skor_kapasitas->ViewValue = $this->skor_kapasitas->CurrentValue;
        $this->skor_kapasitas->ViewValue = FormatNumber($this->skor_kapasitas->ViewValue, 2, -2, -2, -2);
        $this->skor_kapasitas->ViewCustomAttributes = "";

        // max_kapasitas
        $this->max_kapasitas->ViewValue = $this->max_kapasitas->CurrentValue;
        $this->max_kapasitas->ViewValue = FormatNumber($this->max_kapasitas->ViewValue, 2, -2, -2, -2);
        $this->max_kapasitas->ViewCustomAttributes = "";

        // skor_pangan
        $this->skor_pangan->ViewValue = $this->skor_pangan->CurrentValue;
        $this->skor_pangan->ViewValue = FormatNumber($this->skor_pangan->ViewValue, 2, -2, -2, -2);
        $this->skor_pangan->ViewCustomAttributes = "";

        // max_pangan
        $this->max_pangan->ViewValue = $this->max_pangan->CurrentValue;
        $this->max_pangan->ViewValue = FormatNumber($this->max_pangan->ViewValue, 2, -2, -2, -2);
        $this->max_pangan->ViewCustomAttributes = "";

        // skor_sni
        $this->skor_sni->ViewValue = $this->skor_sni->CurrentValue;
        $this->skor_sni->ViewValue = FormatNumber($this->skor_sni->ViewValue, 2, -2, -2, -2);
        $this->skor_sni->ViewCustomAttributes = "";

        // max_sni
        $this->max_sni->ViewValue = $this->max_sni->CurrentValue;
        $this->max_sni->ViewValue = FormatNumber($this->max_sni->ViewValue, 2, -2, -2, -2);
        $this->max_sni->ViewCustomAttributes = "";

        // skor_kemasan
        $this->skor_kemasan->ViewValue = $this->skor_kemasan->CurrentValue;
        $this->skor_kemasan->ViewValue = FormatNumber($this->skor_kemasan->ViewValue, 2, -2, -2, -2);
        $this->skor_kemasan->ViewCustomAttributes = "";

        // max_kemasan
        $this->max_kemasan->ViewValue = $this->max_kemasan->CurrentValue;
        $this->max_kemasan->ViewValue = FormatNumber($this->max_kemasan->ViewValue, 2, -2, -2, -2);
        $this->max_kemasan->ViewCustomAttributes = "";

        // skor_bahanbaku
        $this->skor_bahanbaku->ViewValue = $this->skor_bahanbaku->CurrentValue;
        $this->skor_bahanbaku->ViewValue = FormatNumber($this->skor_bahanbaku->ViewValue, 2, -2, -2, -2);
        $this->skor_bahanbaku->ViewCustomAttributes = "";

        // max_bahanbaku
        $this->max_bahanbaku->ViewValue = $this->max_bahanbaku->CurrentValue;
        $this->max_bahanbaku->ViewValue = FormatNumber($this->max_bahanbaku->ViewValue, 2, -2, -2, -2);
        $this->max_bahanbaku->ViewCustomAttributes = "";

        // skor_alat
        $this->skor_alat->ViewValue = $this->skor_alat->CurrentValue;
        $this->skor_alat->ViewValue = FormatNumber($this->skor_alat->ViewValue, 2, -2, -2, -2);
        $this->skor_alat->ViewCustomAttributes = "";

        // max_alat
        $this->max_alat->ViewValue = $this->max_alat->CurrentValue;
        $this->max_alat->ViewValue = FormatNumber($this->max_alat->ViewValue, 2, -2, -2, -2);
        $this->max_alat->ViewCustomAttributes = "";

        // skor_gudang
        $this->skor_gudang->ViewValue = $this->skor_gudang->CurrentValue;
        $this->skor_gudang->ViewValue = FormatNumber($this->skor_gudang->ViewValue, 2, -2, -2, -2);
        $this->skor_gudang->ViewCustomAttributes = "";

        // max_gudang
        $this->max_gudang->ViewValue = $this->max_gudang->CurrentValue;
        $this->max_gudang->ViewValue = FormatNumber($this->max_gudang->ViewValue, 2, -2, -2, -2);
        $this->max_gudang->ViewCustomAttributes = "";

        // skor_layout
        $this->skor_layout->ViewValue = $this->skor_layout->CurrentValue;
        $this->skor_layout->ViewValue = FormatNumber($this->skor_layout->ViewValue, 2, -2, -2, -2);
        $this->skor_layout->ViewCustomAttributes = "";

        // max_layout
        $this->max_layout->ViewValue = $this->max_layout->CurrentValue;
        $this->max_layout->ViewValue = FormatNumber($this->max_layout->ViewValue, 2, -2, -2, -2);
        $this->max_layout->ViewCustomAttributes = "";

        // skor_sop
        $this->skor_sop->ViewValue = $this->skor_sop->CurrentValue;
        $this->skor_sop->ViewValue = FormatNumber($this->skor_sop->ViewValue, 2, -2, -2, -2);
        $this->skor_sop->ViewCustomAttributes = "";

        // max_sop
        $this->max_sop->ViewValue = $this->max_sop->CurrentValue;
        $this->max_sop->ViewValue = FormatNumber($this->max_sop->ViewValue, 2, -2, -2, -2);
        $this->max_sop->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // skor_aktifitas
        $this->skor_aktifitas->LinkCustomAttributes = "";
        $this->skor_aktifitas->HrefValue = "";
        $this->skor_aktifitas->TooltipValue = "";

        // max_aktifitas
        $this->max_aktifitas->LinkCustomAttributes = "";
        $this->max_aktifitas->HrefValue = "";
        $this->max_aktifitas->TooltipValue = "";

        // skor_kapasitas
        $this->skor_kapasitas->LinkCustomAttributes = "";
        $this->skor_kapasitas->HrefValue = "";
        $this->skor_kapasitas->TooltipValue = "";

        // max_kapasitas
        $this->max_kapasitas->LinkCustomAttributes = "";
        $this->max_kapasitas->HrefValue = "";
        $this->max_kapasitas->TooltipValue = "";

        // skor_pangan
        $this->skor_pangan->LinkCustomAttributes = "";
        $this->skor_pangan->HrefValue = "";
        $this->skor_pangan->TooltipValue = "";

        // max_pangan
        $this->max_pangan->LinkCustomAttributes = "";
        $this->max_pangan->HrefValue = "";
        $this->max_pangan->TooltipValue = "";

        // skor_sni
        $this->skor_sni->LinkCustomAttributes = "";
        $this->skor_sni->HrefValue = "";
        $this->skor_sni->TooltipValue = "";

        // max_sni
        $this->max_sni->LinkCustomAttributes = "";
        $this->max_sni->HrefValue = "";
        $this->max_sni->TooltipValue = "";

        // skor_kemasan
        $this->skor_kemasan->LinkCustomAttributes = "";
        $this->skor_kemasan->HrefValue = "";
        $this->skor_kemasan->TooltipValue = "";

        // max_kemasan
        $this->max_kemasan->LinkCustomAttributes = "";
        $this->max_kemasan->HrefValue = "";
        $this->max_kemasan->TooltipValue = "";

        // skor_bahanbaku
        $this->skor_bahanbaku->LinkCustomAttributes = "";
        $this->skor_bahanbaku->HrefValue = "";
        $this->skor_bahanbaku->TooltipValue = "";

        // max_bahanbaku
        $this->max_bahanbaku->LinkCustomAttributes = "";
        $this->max_bahanbaku->HrefValue = "";
        $this->max_bahanbaku->TooltipValue = "";

        // skor_alat
        $this->skor_alat->LinkCustomAttributes = "";
        $this->skor_alat->HrefValue = "";
        $this->skor_alat->TooltipValue = "";

        // max_alat
        $this->max_alat->LinkCustomAttributes = "";
        $this->max_alat->HrefValue = "";
        $this->max_alat->TooltipValue = "";

        // skor_gudang
        $this->skor_gudang->LinkCustomAttributes = "";
        $this->skor_gudang->HrefValue = "";
        $this->skor_gudang->TooltipValue = "";

        // max_gudang
        $this->max_gudang->LinkCustomAttributes = "";
        $this->max_gudang->HrefValue = "";
        $this->max_gudang->TooltipValue = "";

        // skor_layout
        $this->skor_layout->LinkCustomAttributes = "";
        $this->skor_layout->HrefValue = "";
        $this->skor_layout->TooltipValue = "";

        // max_layout
        $this->max_layout->LinkCustomAttributes = "";
        $this->max_layout->HrefValue = "";
        $this->max_layout->TooltipValue = "";

        // skor_sop
        $this->skor_sop->LinkCustomAttributes = "";
        $this->skor_sop->HrefValue = "";
        $this->skor_sop->TooltipValue = "";

        // max_sop
        $this->max_sop->LinkCustomAttributes = "";
        $this->max_sop->HrefValue = "";
        $this->max_sop->TooltipValue = "";

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

        // skor_aktifitas
        $this->skor_aktifitas->EditAttrs["class"] = "form-control";
        $this->skor_aktifitas->EditCustomAttributes = "";
        $this->skor_aktifitas->EditValue = $this->skor_aktifitas->CurrentValue;
        $this->skor_aktifitas->PlaceHolder = RemoveHtml($this->skor_aktifitas->caption());
        if (strval($this->skor_aktifitas->EditValue) != "" && is_numeric($this->skor_aktifitas->EditValue)) {
            $this->skor_aktifitas->EditValue = FormatNumber($this->skor_aktifitas->EditValue, -2, -2, -2, -2);
        }

        // max_aktifitas
        $this->max_aktifitas->EditAttrs["class"] = "form-control";
        $this->max_aktifitas->EditCustomAttributes = "";
        $this->max_aktifitas->EditValue = $this->max_aktifitas->CurrentValue;
        $this->max_aktifitas->PlaceHolder = RemoveHtml($this->max_aktifitas->caption());
        if (strval($this->max_aktifitas->EditValue) != "" && is_numeric($this->max_aktifitas->EditValue)) {
            $this->max_aktifitas->EditValue = FormatNumber($this->max_aktifitas->EditValue, -2, -2, -2, -2);
        }

        // skor_kapasitas
        $this->skor_kapasitas->EditAttrs["class"] = "form-control";
        $this->skor_kapasitas->EditCustomAttributes = "";
        $this->skor_kapasitas->EditValue = $this->skor_kapasitas->CurrentValue;
        $this->skor_kapasitas->PlaceHolder = RemoveHtml($this->skor_kapasitas->caption());
        if (strval($this->skor_kapasitas->EditValue) != "" && is_numeric($this->skor_kapasitas->EditValue)) {
            $this->skor_kapasitas->EditValue = FormatNumber($this->skor_kapasitas->EditValue, -2, -2, -2, -2);
        }

        // max_kapasitas
        $this->max_kapasitas->EditAttrs["class"] = "form-control";
        $this->max_kapasitas->EditCustomAttributes = "";
        $this->max_kapasitas->EditValue = $this->max_kapasitas->CurrentValue;
        $this->max_kapasitas->PlaceHolder = RemoveHtml($this->max_kapasitas->caption());
        if (strval($this->max_kapasitas->EditValue) != "" && is_numeric($this->max_kapasitas->EditValue)) {
            $this->max_kapasitas->EditValue = FormatNumber($this->max_kapasitas->EditValue, -2, -2, -2, -2);
        }

        // skor_pangan
        $this->skor_pangan->EditAttrs["class"] = "form-control";
        $this->skor_pangan->EditCustomAttributes = "";
        $this->skor_pangan->EditValue = $this->skor_pangan->CurrentValue;
        $this->skor_pangan->PlaceHolder = RemoveHtml($this->skor_pangan->caption());
        if (strval($this->skor_pangan->EditValue) != "" && is_numeric($this->skor_pangan->EditValue)) {
            $this->skor_pangan->EditValue = FormatNumber($this->skor_pangan->EditValue, -2, -2, -2, -2);
        }

        // max_pangan
        $this->max_pangan->EditAttrs["class"] = "form-control";
        $this->max_pangan->EditCustomAttributes = "";
        $this->max_pangan->EditValue = $this->max_pangan->CurrentValue;
        $this->max_pangan->PlaceHolder = RemoveHtml($this->max_pangan->caption());
        if (strval($this->max_pangan->EditValue) != "" && is_numeric($this->max_pangan->EditValue)) {
            $this->max_pangan->EditValue = FormatNumber($this->max_pangan->EditValue, -2, -2, -2, -2);
        }

        // skor_sni
        $this->skor_sni->EditAttrs["class"] = "form-control";
        $this->skor_sni->EditCustomAttributes = "";
        $this->skor_sni->EditValue = $this->skor_sni->CurrentValue;
        $this->skor_sni->PlaceHolder = RemoveHtml($this->skor_sni->caption());
        if (strval($this->skor_sni->EditValue) != "" && is_numeric($this->skor_sni->EditValue)) {
            $this->skor_sni->EditValue = FormatNumber($this->skor_sni->EditValue, -2, -2, -2, -2);
        }

        // max_sni
        $this->max_sni->EditAttrs["class"] = "form-control";
        $this->max_sni->EditCustomAttributes = "";
        $this->max_sni->EditValue = $this->max_sni->CurrentValue;
        $this->max_sni->PlaceHolder = RemoveHtml($this->max_sni->caption());
        if (strval($this->max_sni->EditValue) != "" && is_numeric($this->max_sni->EditValue)) {
            $this->max_sni->EditValue = FormatNumber($this->max_sni->EditValue, -2, -2, -2, -2);
        }

        // skor_kemasan
        $this->skor_kemasan->EditAttrs["class"] = "form-control";
        $this->skor_kemasan->EditCustomAttributes = "";
        $this->skor_kemasan->EditValue = $this->skor_kemasan->CurrentValue;
        $this->skor_kemasan->PlaceHolder = RemoveHtml($this->skor_kemasan->caption());
        if (strval($this->skor_kemasan->EditValue) != "" && is_numeric($this->skor_kemasan->EditValue)) {
            $this->skor_kemasan->EditValue = FormatNumber($this->skor_kemasan->EditValue, -2, -2, -2, -2);
        }

        // max_kemasan
        $this->max_kemasan->EditAttrs["class"] = "form-control";
        $this->max_kemasan->EditCustomAttributes = "";
        $this->max_kemasan->EditValue = $this->max_kemasan->CurrentValue;
        $this->max_kemasan->PlaceHolder = RemoveHtml($this->max_kemasan->caption());
        if (strval($this->max_kemasan->EditValue) != "" && is_numeric($this->max_kemasan->EditValue)) {
            $this->max_kemasan->EditValue = FormatNumber($this->max_kemasan->EditValue, -2, -2, -2, -2);
        }

        // skor_bahanbaku
        $this->skor_bahanbaku->EditAttrs["class"] = "form-control";
        $this->skor_bahanbaku->EditCustomAttributes = "";
        $this->skor_bahanbaku->EditValue = $this->skor_bahanbaku->CurrentValue;
        $this->skor_bahanbaku->PlaceHolder = RemoveHtml($this->skor_bahanbaku->caption());
        if (strval($this->skor_bahanbaku->EditValue) != "" && is_numeric($this->skor_bahanbaku->EditValue)) {
            $this->skor_bahanbaku->EditValue = FormatNumber($this->skor_bahanbaku->EditValue, -2, -2, -2, -2);
        }

        // max_bahanbaku
        $this->max_bahanbaku->EditAttrs["class"] = "form-control";
        $this->max_bahanbaku->EditCustomAttributes = "";
        $this->max_bahanbaku->EditValue = $this->max_bahanbaku->CurrentValue;
        $this->max_bahanbaku->PlaceHolder = RemoveHtml($this->max_bahanbaku->caption());
        if (strval($this->max_bahanbaku->EditValue) != "" && is_numeric($this->max_bahanbaku->EditValue)) {
            $this->max_bahanbaku->EditValue = FormatNumber($this->max_bahanbaku->EditValue, -2, -2, -2, -2);
        }

        // skor_alat
        $this->skor_alat->EditAttrs["class"] = "form-control";
        $this->skor_alat->EditCustomAttributes = "";
        $this->skor_alat->EditValue = $this->skor_alat->CurrentValue;
        $this->skor_alat->PlaceHolder = RemoveHtml($this->skor_alat->caption());
        if (strval($this->skor_alat->EditValue) != "" && is_numeric($this->skor_alat->EditValue)) {
            $this->skor_alat->EditValue = FormatNumber($this->skor_alat->EditValue, -2, -2, -2, -2);
        }

        // max_alat
        $this->max_alat->EditAttrs["class"] = "form-control";
        $this->max_alat->EditCustomAttributes = "";
        $this->max_alat->EditValue = $this->max_alat->CurrentValue;
        $this->max_alat->PlaceHolder = RemoveHtml($this->max_alat->caption());
        if (strval($this->max_alat->EditValue) != "" && is_numeric($this->max_alat->EditValue)) {
            $this->max_alat->EditValue = FormatNumber($this->max_alat->EditValue, -2, -2, -2, -2);
        }

        // skor_gudang
        $this->skor_gudang->EditAttrs["class"] = "form-control";
        $this->skor_gudang->EditCustomAttributes = "";
        $this->skor_gudang->EditValue = $this->skor_gudang->CurrentValue;
        $this->skor_gudang->PlaceHolder = RemoveHtml($this->skor_gudang->caption());
        if (strval($this->skor_gudang->EditValue) != "" && is_numeric($this->skor_gudang->EditValue)) {
            $this->skor_gudang->EditValue = FormatNumber($this->skor_gudang->EditValue, -2, -2, -2, -2);
        }

        // max_gudang
        $this->max_gudang->EditAttrs["class"] = "form-control";
        $this->max_gudang->EditCustomAttributes = "";
        $this->max_gudang->EditValue = $this->max_gudang->CurrentValue;
        $this->max_gudang->PlaceHolder = RemoveHtml($this->max_gudang->caption());
        if (strval($this->max_gudang->EditValue) != "" && is_numeric($this->max_gudang->EditValue)) {
            $this->max_gudang->EditValue = FormatNumber($this->max_gudang->EditValue, -2, -2, -2, -2);
        }

        // skor_layout
        $this->skor_layout->EditAttrs["class"] = "form-control";
        $this->skor_layout->EditCustomAttributes = "";
        $this->skor_layout->EditValue = $this->skor_layout->CurrentValue;
        $this->skor_layout->PlaceHolder = RemoveHtml($this->skor_layout->caption());
        if (strval($this->skor_layout->EditValue) != "" && is_numeric($this->skor_layout->EditValue)) {
            $this->skor_layout->EditValue = FormatNumber($this->skor_layout->EditValue, -2, -2, -2, -2);
        }

        // max_layout
        $this->max_layout->EditAttrs["class"] = "form-control";
        $this->max_layout->EditCustomAttributes = "";
        $this->max_layout->EditValue = $this->max_layout->CurrentValue;
        $this->max_layout->PlaceHolder = RemoveHtml($this->max_layout->caption());
        if (strval($this->max_layout->EditValue) != "" && is_numeric($this->max_layout->EditValue)) {
            $this->max_layout->EditValue = FormatNumber($this->max_layout->EditValue, -2, -2, -2, -2);
        }

        // skor_sop
        $this->skor_sop->EditAttrs["class"] = "form-control";
        $this->skor_sop->EditCustomAttributes = "";
        $this->skor_sop->EditValue = $this->skor_sop->CurrentValue;
        $this->skor_sop->PlaceHolder = RemoveHtml($this->skor_sop->caption());
        if (strval($this->skor_sop->EditValue) != "" && is_numeric($this->skor_sop->EditValue)) {
            $this->skor_sop->EditValue = FormatNumber($this->skor_sop->EditValue, -2, -2, -2, -2);
        }

        // max_sop
        $this->max_sop->EditAttrs["class"] = "form-control";
        $this->max_sop->EditCustomAttributes = "";
        $this->max_sop->EditValue = $this->max_sop->CurrentValue;
        $this->max_sop->PlaceHolder = RemoveHtml($this->max_sop->caption());
        if (strval($this->max_sop->EditValue) != "" && is_numeric($this->max_sop->EditValue)) {
            $this->max_sop->EditValue = FormatNumber($this->max_sop->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->skor_aktifitas);
                    $doc->exportCaption($this->max_aktifitas);
                    $doc->exportCaption($this->skor_kapasitas);
                    $doc->exportCaption($this->max_kapasitas);
                    $doc->exportCaption($this->skor_pangan);
                    $doc->exportCaption($this->max_pangan);
                    $doc->exportCaption($this->skor_sni);
                    $doc->exportCaption($this->max_sni);
                    $doc->exportCaption($this->skor_kemasan);
                    $doc->exportCaption($this->max_kemasan);
                    $doc->exportCaption($this->skor_bahanbaku);
                    $doc->exportCaption($this->max_bahanbaku);
                    $doc->exportCaption($this->skor_alat);
                    $doc->exportCaption($this->max_alat);
                    $doc->exportCaption($this->skor_gudang);
                    $doc->exportCaption($this->max_gudang);
                    $doc->exportCaption($this->skor_layout);
                    $doc->exportCaption($this->max_layout);
                    $doc->exportCaption($this->skor_sop);
                    $doc->exportCaption($this->max_sop);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_aktifitas);
                    $doc->exportCaption($this->max_aktifitas);
                    $doc->exportCaption($this->skor_kapasitas);
                    $doc->exportCaption($this->max_kapasitas);
                    $doc->exportCaption($this->skor_pangan);
                    $doc->exportCaption($this->max_pangan);
                    $doc->exportCaption($this->skor_sni);
                    $doc->exportCaption($this->max_sni);
                    $doc->exportCaption($this->skor_kemasan);
                    $doc->exportCaption($this->max_kemasan);
                    $doc->exportCaption($this->skor_bahanbaku);
                    $doc->exportCaption($this->max_bahanbaku);
                    $doc->exportCaption($this->skor_alat);
                    $doc->exportCaption($this->max_alat);
                    $doc->exportCaption($this->skor_gudang);
                    $doc->exportCaption($this->max_gudang);
                    $doc->exportCaption($this->skor_layout);
                    $doc->exportCaption($this->max_layout);
                    $doc->exportCaption($this->skor_sop);
                    $doc->exportCaption($this->max_sop);
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
                        $doc->exportField($this->skor_aktifitas);
                        $doc->exportField($this->max_aktifitas);
                        $doc->exportField($this->skor_kapasitas);
                        $doc->exportField($this->max_kapasitas);
                        $doc->exportField($this->skor_pangan);
                        $doc->exportField($this->max_pangan);
                        $doc->exportField($this->skor_sni);
                        $doc->exportField($this->max_sni);
                        $doc->exportField($this->skor_kemasan);
                        $doc->exportField($this->max_kemasan);
                        $doc->exportField($this->skor_bahanbaku);
                        $doc->exportField($this->max_bahanbaku);
                        $doc->exportField($this->skor_alat);
                        $doc->exportField($this->max_alat);
                        $doc->exportField($this->skor_gudang);
                        $doc->exportField($this->max_gudang);
                        $doc->exportField($this->skor_layout);
                        $doc->exportField($this->max_layout);
                        $doc->exportField($this->skor_sop);
                        $doc->exportField($this->max_sop);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_aktifitas);
                        $doc->exportField($this->max_aktifitas);
                        $doc->exportField($this->skor_kapasitas);
                        $doc->exportField($this->max_kapasitas);
                        $doc->exportField($this->skor_pangan);
                        $doc->exportField($this->max_pangan);
                        $doc->exportField($this->skor_sni);
                        $doc->exportField($this->max_sni);
                        $doc->exportField($this->skor_kemasan);
                        $doc->exportField($this->max_kemasan);
                        $doc->exportField($this->skor_bahanbaku);
                        $doc->exportField($this->max_bahanbaku);
                        $doc->exportField($this->skor_alat);
                        $doc->exportField($this->max_alat);
                        $doc->exportField($this->skor_gudang);
                        $doc->exportField($this->max_gudang);
                        $doc->exportField($this->skor_layout);
                        $doc->exportField($this->max_layout);
                        $doc->exportField($this->skor_sop);
                        $doc->exportField($this->max_sop);
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
