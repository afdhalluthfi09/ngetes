<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for res_nilai_sdm
 */
class ResNilaiSdm extends DbTable
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
    public $skor_oms;
    public $max_oms;
    public $skor_fokus;
    public $max_fokus;
    public $skor_target;
    public $max_target;
    public $skor_karyawan;
    public $max_karyawan;
    public $skor_outsource;
    public $max_outsource;
    public $skor_besarangaji;
    public $max_besarangaji;
    public $skor_asuransi;
    public $max_asuransi;
    public $skor_bonus;
    public $max_bonus;
    public $skor_training;
    public $max_training;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'res_nilai_sdm';
        $this->TableName = 'res_nilai_sdm';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`res_nilai_sdm`";
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
        $this->nik = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // skor_oms
        $this->skor_oms = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_oms', 'skor_oms', '`skor_oms`', '`skor_oms`', 5, 23, -1, false, '`skor_oms`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_oms->Sortable = true; // Allow sort
        $this->skor_oms->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_oms->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_oms->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_oms->Param, "CustomMsg");
        $this->Fields['skor_oms'] = &$this->skor_oms;

        // max_oms
        $this->max_oms = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_oms', 'max_oms', '`max_oms`', '`max_oms`', 5, 23, -1, false, '`max_oms`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_oms->Sortable = true; // Allow sort
        $this->max_oms->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_oms->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_oms->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_oms->Param, "CustomMsg");
        $this->Fields['max_oms'] = &$this->max_oms;

        // skor_fokus
        $this->skor_fokus = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_fokus', 'skor_fokus', '`skor_fokus`', '`skor_fokus`', 5, 23, -1, false, '`skor_fokus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_fokus->Sortable = true; // Allow sort
        $this->skor_fokus->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_fokus->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_fokus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_fokus->Param, "CustomMsg");
        $this->Fields['skor_fokus'] = &$this->skor_fokus;

        // max_fokus
        $this->max_fokus = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_fokus', 'max_fokus', '`max_fokus`', '`max_fokus`', 5, 23, -1, false, '`max_fokus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_fokus->Sortable = true; // Allow sort
        $this->max_fokus->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_fokus->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_fokus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_fokus->Param, "CustomMsg");
        $this->Fields['max_fokus'] = &$this->max_fokus;

        // skor_target
        $this->skor_target = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_target', 'skor_target', '`skor_target`', '`skor_target`', 5, 23, -1, false, '`skor_target`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_target->Sortable = true; // Allow sort
        $this->skor_target->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_target->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_target->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_target->Param, "CustomMsg");
        $this->Fields['skor_target'] = &$this->skor_target;

        // max_target
        $this->max_target = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_target', 'max_target', '`max_target`', '`max_target`', 5, 23, -1, false, '`max_target`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_target->Sortable = true; // Allow sort
        $this->max_target->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_target->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_target->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_target->Param, "CustomMsg");
        $this->Fields['max_target'] = &$this->max_target;

        // skor_karyawan
        $this->skor_karyawan = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_karyawan', 'skor_karyawan', '`skor_karyawan`', '`skor_karyawan`', 5, 23, -1, false, '`skor_karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_karyawan->Sortable = true; // Allow sort
        $this->skor_karyawan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_karyawan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_karyawan->Param, "CustomMsg");
        $this->Fields['skor_karyawan'] = &$this->skor_karyawan;

        // max_karyawan
        $this->max_karyawan = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_karyawan', 'max_karyawan', '`max_karyawan`', '`max_karyawan`', 5, 23, -1, false, '`max_karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_karyawan->Sortable = true; // Allow sort
        $this->max_karyawan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_karyawan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_karyawan->Param, "CustomMsg");
        $this->Fields['max_karyawan'] = &$this->max_karyawan;

        // skor_outsource
        $this->skor_outsource = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_outsource', 'skor_outsource', '`skor_outsource`', '`skor_outsource`', 5, 23, -1, false, '`skor_outsource`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_outsource->Sortable = true; // Allow sort
        $this->skor_outsource->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_outsource->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_outsource->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_outsource->Param, "CustomMsg");
        $this->Fields['skor_outsource'] = &$this->skor_outsource;

        // max_outsource
        $this->max_outsource = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_outsource', 'max_outsource', '`max_outsource`', '`max_outsource`', 5, 23, -1, false, '`max_outsource`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_outsource->Sortable = true; // Allow sort
        $this->max_outsource->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_outsource->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_outsource->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_outsource->Param, "CustomMsg");
        $this->Fields['max_outsource'] = &$this->max_outsource;

        // skor_besarangaji
        $this->skor_besarangaji = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_besarangaji', 'skor_besarangaji', '`skor_besarangaji`', '`skor_besarangaji`', 5, 23, -1, false, '`skor_besarangaji`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_besarangaji->Sortable = true; // Allow sort
        $this->skor_besarangaji->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_besarangaji->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_besarangaji->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_besarangaji->Param, "CustomMsg");
        $this->Fields['skor_besarangaji'] = &$this->skor_besarangaji;

        // max_besarangaji
        $this->max_besarangaji = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_besarangaji', 'max_besarangaji', '`max_besarangaji`', '`max_besarangaji`', 5, 23, -1, false, '`max_besarangaji`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_besarangaji->Sortable = true; // Allow sort
        $this->max_besarangaji->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_besarangaji->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_besarangaji->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_besarangaji->Param, "CustomMsg");
        $this->Fields['max_besarangaji'] = &$this->max_besarangaji;

        // skor_asuransi
        $this->skor_asuransi = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_asuransi', 'skor_asuransi', '`skor_asuransi`', '`skor_asuransi`', 5, 23, -1, false, '`skor_asuransi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_asuransi->Sortable = true; // Allow sort
        $this->skor_asuransi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_asuransi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_asuransi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_asuransi->Param, "CustomMsg");
        $this->Fields['skor_asuransi'] = &$this->skor_asuransi;

        // max_asuransi
        $this->max_asuransi = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_asuransi', 'max_asuransi', '`max_asuransi`', '`max_asuransi`', 5, 23, -1, false, '`max_asuransi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_asuransi->Sortable = true; // Allow sort
        $this->max_asuransi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_asuransi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_asuransi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_asuransi->Param, "CustomMsg");
        $this->Fields['max_asuransi'] = &$this->max_asuransi;

        // skor_bonus
        $this->skor_bonus = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_bonus', 'skor_bonus', '`skor_bonus`', '`skor_bonus`', 5, 23, -1, false, '`skor_bonus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_bonus->Sortable = true; // Allow sort
        $this->skor_bonus->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_bonus->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_bonus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_bonus->Param, "CustomMsg");
        $this->Fields['skor_bonus'] = &$this->skor_bonus;

        // max_bonus
        $this->max_bonus = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_bonus', 'max_bonus', '`max_bonus`', '`max_bonus`', 5, 23, -1, false, '`max_bonus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_bonus->Sortable = true; // Allow sort
        $this->max_bonus->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_bonus->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_bonus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_bonus->Param, "CustomMsg");
        $this->Fields['max_bonus'] = &$this->max_bonus;

        // skor_training
        $this->skor_training = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_skor_training', 'skor_training', '`skor_training`', '`skor_training`', 5, 23, -1, false, '`skor_training`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_training->Sortable = true; // Allow sort
        $this->skor_training->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_training->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_training->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_training->Param, "CustomMsg");
        $this->Fields['skor_training'] = &$this->skor_training;

        // max_training
        $this->max_training = new DbField('res_nilai_sdm', 'res_nilai_sdm', 'x_max_training', 'max_training', '`max_training`', '`max_training`', 5, 23, -1, false, '`max_training`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_training->Sortable = true; // Allow sort
        $this->max_training->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_training->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_training->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_training->Param, "CustomMsg");
        $this->Fields['max_training'] = &$this->max_training;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`res_nilai_sdm`";
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
        $this->skor_oms->DbValue = $row['skor_oms'];
        $this->max_oms->DbValue = $row['max_oms'];
        $this->skor_fokus->DbValue = $row['skor_fokus'];
        $this->max_fokus->DbValue = $row['max_fokus'];
        $this->skor_target->DbValue = $row['skor_target'];
        $this->max_target->DbValue = $row['max_target'];
        $this->skor_karyawan->DbValue = $row['skor_karyawan'];
        $this->max_karyawan->DbValue = $row['max_karyawan'];
        $this->skor_outsource->DbValue = $row['skor_outsource'];
        $this->max_outsource->DbValue = $row['max_outsource'];
        $this->skor_besarangaji->DbValue = $row['skor_besarangaji'];
        $this->max_besarangaji->DbValue = $row['max_besarangaji'];
        $this->skor_asuransi->DbValue = $row['skor_asuransi'];
        $this->max_asuransi->DbValue = $row['max_asuransi'];
        $this->skor_bonus->DbValue = $row['skor_bonus'];
        $this->max_bonus->DbValue = $row['max_bonus'];
        $this->skor_training->DbValue = $row['skor_training'];
        $this->max_training->DbValue = $row['max_training'];
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
        return $_SESSION[$name] ?? GetUrl("resnilaisdmlist");
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
        if ($pageName == "resnilaisdmview") {
            return $Language->phrase("View");
        } elseif ($pageName == "resnilaisdmedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "resnilaisdmadd") {
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
                return "ResNilaiSdmView";
            case Config("API_ADD_ACTION"):
                return "ResNilaiSdmAdd";
            case Config("API_EDIT_ACTION"):
                return "ResNilaiSdmEdit";
            case Config("API_DELETE_ACTION"):
                return "ResNilaiSdmDelete";
            case Config("API_LIST_ACTION"):
                return "ResNilaiSdmList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "resnilaisdmlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("resnilaisdmview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("resnilaisdmview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "resnilaisdmadd?" . $this->getUrlParm($parm);
        } else {
            $url = "resnilaisdmadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("resnilaisdmedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("resnilaisdmadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("resnilaisdmdelete", $this->getUrlParm());
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
        $this->skor_oms->setDbValue($row['skor_oms']);
        $this->max_oms->setDbValue($row['max_oms']);
        $this->skor_fokus->setDbValue($row['skor_fokus']);
        $this->max_fokus->setDbValue($row['max_fokus']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_karyawan->setDbValue($row['skor_karyawan']);
        $this->max_karyawan->setDbValue($row['max_karyawan']);
        $this->skor_outsource->setDbValue($row['skor_outsource']);
        $this->max_outsource->setDbValue($row['max_outsource']);
        $this->skor_besarangaji->setDbValue($row['skor_besarangaji']);
        $this->max_besarangaji->setDbValue($row['max_besarangaji']);
        $this->skor_asuransi->setDbValue($row['skor_asuransi']);
        $this->max_asuransi->setDbValue($row['max_asuransi']);
        $this->skor_bonus->setDbValue($row['skor_bonus']);
        $this->max_bonus->setDbValue($row['max_bonus']);
        $this->skor_training->setDbValue($row['skor_training']);
        $this->max_training->setDbValue($row['max_training']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // skor_oms

        // max_oms

        // skor_fokus

        // max_fokus

        // skor_target

        // max_target

        // skor_karyawan

        // max_karyawan

        // skor_outsource

        // max_outsource

        // skor_besarangaji

        // max_besarangaji

        // skor_asuransi

        // max_asuransi

        // skor_bonus

        // max_bonus

        // skor_training

        // max_training

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // skor_oms
        $this->skor_oms->ViewValue = $this->skor_oms->CurrentValue;
        $this->skor_oms->ViewValue = FormatNumber($this->skor_oms->ViewValue, 2, -2, -2, -2);
        $this->skor_oms->ViewCustomAttributes = "";

        // max_oms
        $this->max_oms->ViewValue = $this->max_oms->CurrentValue;
        $this->max_oms->ViewValue = FormatNumber($this->max_oms->ViewValue, 2, -2, -2, -2);
        $this->max_oms->ViewCustomAttributes = "";

        // skor_fokus
        $this->skor_fokus->ViewValue = $this->skor_fokus->CurrentValue;
        $this->skor_fokus->ViewValue = FormatNumber($this->skor_fokus->ViewValue, 2, -2, -2, -2);
        $this->skor_fokus->ViewCustomAttributes = "";

        // max_fokus
        $this->max_fokus->ViewValue = $this->max_fokus->CurrentValue;
        $this->max_fokus->ViewValue = FormatNumber($this->max_fokus->ViewValue, 2, -2, -2, -2);
        $this->max_fokus->ViewCustomAttributes = "";

        // skor_target
        $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
        $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
        $this->skor_target->ViewCustomAttributes = "";

        // max_target
        $this->max_target->ViewValue = $this->max_target->CurrentValue;
        $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
        $this->max_target->ViewCustomAttributes = "";

        // skor_karyawan
        $this->skor_karyawan->ViewValue = $this->skor_karyawan->CurrentValue;
        $this->skor_karyawan->ViewValue = FormatNumber($this->skor_karyawan->ViewValue, 2, -2, -2, -2);
        $this->skor_karyawan->ViewCustomAttributes = "";

        // max_karyawan
        $this->max_karyawan->ViewValue = $this->max_karyawan->CurrentValue;
        $this->max_karyawan->ViewValue = FormatNumber($this->max_karyawan->ViewValue, 2, -2, -2, -2);
        $this->max_karyawan->ViewCustomAttributes = "";

        // skor_outsource
        $this->skor_outsource->ViewValue = $this->skor_outsource->CurrentValue;
        $this->skor_outsource->ViewValue = FormatNumber($this->skor_outsource->ViewValue, 2, -2, -2, -2);
        $this->skor_outsource->ViewCustomAttributes = "";

        // max_outsource
        $this->max_outsource->ViewValue = $this->max_outsource->CurrentValue;
        $this->max_outsource->ViewValue = FormatNumber($this->max_outsource->ViewValue, 2, -2, -2, -2);
        $this->max_outsource->ViewCustomAttributes = "";

        // skor_besarangaji
        $this->skor_besarangaji->ViewValue = $this->skor_besarangaji->CurrentValue;
        $this->skor_besarangaji->ViewValue = FormatNumber($this->skor_besarangaji->ViewValue, 2, -2, -2, -2);
        $this->skor_besarangaji->ViewCustomAttributes = "";

        // max_besarangaji
        $this->max_besarangaji->ViewValue = $this->max_besarangaji->CurrentValue;
        $this->max_besarangaji->ViewValue = FormatNumber($this->max_besarangaji->ViewValue, 2, -2, -2, -2);
        $this->max_besarangaji->ViewCustomAttributes = "";

        // skor_asuransi
        $this->skor_asuransi->ViewValue = $this->skor_asuransi->CurrentValue;
        $this->skor_asuransi->ViewValue = FormatNumber($this->skor_asuransi->ViewValue, 2, -2, -2, -2);
        $this->skor_asuransi->ViewCustomAttributes = "";

        // max_asuransi
        $this->max_asuransi->ViewValue = $this->max_asuransi->CurrentValue;
        $this->max_asuransi->ViewValue = FormatNumber($this->max_asuransi->ViewValue, 2, -2, -2, -2);
        $this->max_asuransi->ViewCustomAttributes = "";

        // skor_bonus
        $this->skor_bonus->ViewValue = $this->skor_bonus->CurrentValue;
        $this->skor_bonus->ViewValue = FormatNumber($this->skor_bonus->ViewValue, 2, -2, -2, -2);
        $this->skor_bonus->ViewCustomAttributes = "";

        // max_bonus
        $this->max_bonus->ViewValue = $this->max_bonus->CurrentValue;
        $this->max_bonus->ViewValue = FormatNumber($this->max_bonus->ViewValue, 2, -2, -2, -2);
        $this->max_bonus->ViewCustomAttributes = "";

        // skor_training
        $this->skor_training->ViewValue = $this->skor_training->CurrentValue;
        $this->skor_training->ViewValue = FormatNumber($this->skor_training->ViewValue, 2, -2, -2, -2);
        $this->skor_training->ViewCustomAttributes = "";

        // max_training
        $this->max_training->ViewValue = $this->max_training->CurrentValue;
        $this->max_training->ViewValue = FormatNumber($this->max_training->ViewValue, 2, -2, -2, -2);
        $this->max_training->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // skor_oms
        $this->skor_oms->LinkCustomAttributes = "";
        $this->skor_oms->HrefValue = "";
        $this->skor_oms->TooltipValue = "";

        // max_oms
        $this->max_oms->LinkCustomAttributes = "";
        $this->max_oms->HrefValue = "";
        $this->max_oms->TooltipValue = "";

        // skor_fokus
        $this->skor_fokus->LinkCustomAttributes = "";
        $this->skor_fokus->HrefValue = "";
        $this->skor_fokus->TooltipValue = "";

        // max_fokus
        $this->max_fokus->LinkCustomAttributes = "";
        $this->max_fokus->HrefValue = "";
        $this->max_fokus->TooltipValue = "";

        // skor_target
        $this->skor_target->LinkCustomAttributes = "";
        $this->skor_target->HrefValue = "";
        $this->skor_target->TooltipValue = "";

        // max_target
        $this->max_target->LinkCustomAttributes = "";
        $this->max_target->HrefValue = "";
        $this->max_target->TooltipValue = "";

        // skor_karyawan
        $this->skor_karyawan->LinkCustomAttributes = "";
        $this->skor_karyawan->HrefValue = "";
        $this->skor_karyawan->TooltipValue = "";

        // max_karyawan
        $this->max_karyawan->LinkCustomAttributes = "";
        $this->max_karyawan->HrefValue = "";
        $this->max_karyawan->TooltipValue = "";

        // skor_outsource
        $this->skor_outsource->LinkCustomAttributes = "";
        $this->skor_outsource->HrefValue = "";
        $this->skor_outsource->TooltipValue = "";

        // max_outsource
        $this->max_outsource->LinkCustomAttributes = "";
        $this->max_outsource->HrefValue = "";
        $this->max_outsource->TooltipValue = "";

        // skor_besarangaji
        $this->skor_besarangaji->LinkCustomAttributes = "";
        $this->skor_besarangaji->HrefValue = "";
        $this->skor_besarangaji->TooltipValue = "";

        // max_besarangaji
        $this->max_besarangaji->LinkCustomAttributes = "";
        $this->max_besarangaji->HrefValue = "";
        $this->max_besarangaji->TooltipValue = "";

        // skor_asuransi
        $this->skor_asuransi->LinkCustomAttributes = "";
        $this->skor_asuransi->HrefValue = "";
        $this->skor_asuransi->TooltipValue = "";

        // max_asuransi
        $this->max_asuransi->LinkCustomAttributes = "";
        $this->max_asuransi->HrefValue = "";
        $this->max_asuransi->TooltipValue = "";

        // skor_bonus
        $this->skor_bonus->LinkCustomAttributes = "";
        $this->skor_bonus->HrefValue = "";
        $this->skor_bonus->TooltipValue = "";

        // max_bonus
        $this->max_bonus->LinkCustomAttributes = "";
        $this->max_bonus->HrefValue = "";
        $this->max_bonus->TooltipValue = "";

        // skor_training
        $this->skor_training->LinkCustomAttributes = "";
        $this->skor_training->HrefValue = "";
        $this->skor_training->TooltipValue = "";

        // max_training
        $this->max_training->LinkCustomAttributes = "";
        $this->max_training->HrefValue = "";
        $this->max_training->TooltipValue = "";

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

        // skor_oms
        $this->skor_oms->EditAttrs["class"] = "form-control";
        $this->skor_oms->EditCustomAttributes = "";
        $this->skor_oms->EditValue = $this->skor_oms->CurrentValue;
        $this->skor_oms->PlaceHolder = RemoveHtml($this->skor_oms->caption());
        if (strval($this->skor_oms->EditValue) != "" && is_numeric($this->skor_oms->EditValue)) {
            $this->skor_oms->EditValue = FormatNumber($this->skor_oms->EditValue, -2, -2, -2, -2);
        }

        // max_oms
        $this->max_oms->EditAttrs["class"] = "form-control";
        $this->max_oms->EditCustomAttributes = "";
        $this->max_oms->EditValue = $this->max_oms->CurrentValue;
        $this->max_oms->PlaceHolder = RemoveHtml($this->max_oms->caption());
        if (strval($this->max_oms->EditValue) != "" && is_numeric($this->max_oms->EditValue)) {
            $this->max_oms->EditValue = FormatNumber($this->max_oms->EditValue, -2, -2, -2, -2);
        }

        // skor_fokus
        $this->skor_fokus->EditAttrs["class"] = "form-control";
        $this->skor_fokus->EditCustomAttributes = "";
        $this->skor_fokus->EditValue = $this->skor_fokus->CurrentValue;
        $this->skor_fokus->PlaceHolder = RemoveHtml($this->skor_fokus->caption());
        if (strval($this->skor_fokus->EditValue) != "" && is_numeric($this->skor_fokus->EditValue)) {
            $this->skor_fokus->EditValue = FormatNumber($this->skor_fokus->EditValue, -2, -2, -2, -2);
        }

        // max_fokus
        $this->max_fokus->EditAttrs["class"] = "form-control";
        $this->max_fokus->EditCustomAttributes = "";
        $this->max_fokus->EditValue = $this->max_fokus->CurrentValue;
        $this->max_fokus->PlaceHolder = RemoveHtml($this->max_fokus->caption());
        if (strval($this->max_fokus->EditValue) != "" && is_numeric($this->max_fokus->EditValue)) {
            $this->max_fokus->EditValue = FormatNumber($this->max_fokus->EditValue, -2, -2, -2, -2);
        }

        // skor_target
        $this->skor_target->EditAttrs["class"] = "form-control";
        $this->skor_target->EditCustomAttributes = "";
        $this->skor_target->EditValue = $this->skor_target->CurrentValue;
        $this->skor_target->PlaceHolder = RemoveHtml($this->skor_target->caption());
        if (strval($this->skor_target->EditValue) != "" && is_numeric($this->skor_target->EditValue)) {
            $this->skor_target->EditValue = FormatNumber($this->skor_target->EditValue, -2, -2, -2, -2);
        }

        // max_target
        $this->max_target->EditAttrs["class"] = "form-control";
        $this->max_target->EditCustomAttributes = "";
        $this->max_target->EditValue = $this->max_target->CurrentValue;
        $this->max_target->PlaceHolder = RemoveHtml($this->max_target->caption());
        if (strval($this->max_target->EditValue) != "" && is_numeric($this->max_target->EditValue)) {
            $this->max_target->EditValue = FormatNumber($this->max_target->EditValue, -2, -2, -2, -2);
        }

        // skor_karyawan
        $this->skor_karyawan->EditAttrs["class"] = "form-control";
        $this->skor_karyawan->EditCustomAttributes = "";
        $this->skor_karyawan->EditValue = $this->skor_karyawan->CurrentValue;
        $this->skor_karyawan->PlaceHolder = RemoveHtml($this->skor_karyawan->caption());
        if (strval($this->skor_karyawan->EditValue) != "" && is_numeric($this->skor_karyawan->EditValue)) {
            $this->skor_karyawan->EditValue = FormatNumber($this->skor_karyawan->EditValue, -2, -2, -2, -2);
        }

        // max_karyawan
        $this->max_karyawan->EditAttrs["class"] = "form-control";
        $this->max_karyawan->EditCustomAttributes = "";
        $this->max_karyawan->EditValue = $this->max_karyawan->CurrentValue;
        $this->max_karyawan->PlaceHolder = RemoveHtml($this->max_karyawan->caption());
        if (strval($this->max_karyawan->EditValue) != "" && is_numeric($this->max_karyawan->EditValue)) {
            $this->max_karyawan->EditValue = FormatNumber($this->max_karyawan->EditValue, -2, -2, -2, -2);
        }

        // skor_outsource
        $this->skor_outsource->EditAttrs["class"] = "form-control";
        $this->skor_outsource->EditCustomAttributes = "";
        $this->skor_outsource->EditValue = $this->skor_outsource->CurrentValue;
        $this->skor_outsource->PlaceHolder = RemoveHtml($this->skor_outsource->caption());
        if (strval($this->skor_outsource->EditValue) != "" && is_numeric($this->skor_outsource->EditValue)) {
            $this->skor_outsource->EditValue = FormatNumber($this->skor_outsource->EditValue, -2, -2, -2, -2);
        }

        // max_outsource
        $this->max_outsource->EditAttrs["class"] = "form-control";
        $this->max_outsource->EditCustomAttributes = "";
        $this->max_outsource->EditValue = $this->max_outsource->CurrentValue;
        $this->max_outsource->PlaceHolder = RemoveHtml($this->max_outsource->caption());
        if (strval($this->max_outsource->EditValue) != "" && is_numeric($this->max_outsource->EditValue)) {
            $this->max_outsource->EditValue = FormatNumber($this->max_outsource->EditValue, -2, -2, -2, -2);
        }

        // skor_besarangaji
        $this->skor_besarangaji->EditAttrs["class"] = "form-control";
        $this->skor_besarangaji->EditCustomAttributes = "";
        $this->skor_besarangaji->EditValue = $this->skor_besarangaji->CurrentValue;
        $this->skor_besarangaji->PlaceHolder = RemoveHtml($this->skor_besarangaji->caption());
        if (strval($this->skor_besarangaji->EditValue) != "" && is_numeric($this->skor_besarangaji->EditValue)) {
            $this->skor_besarangaji->EditValue = FormatNumber($this->skor_besarangaji->EditValue, -2, -2, -2, -2);
        }

        // max_besarangaji
        $this->max_besarangaji->EditAttrs["class"] = "form-control";
        $this->max_besarangaji->EditCustomAttributes = "";
        $this->max_besarangaji->EditValue = $this->max_besarangaji->CurrentValue;
        $this->max_besarangaji->PlaceHolder = RemoveHtml($this->max_besarangaji->caption());
        if (strval($this->max_besarangaji->EditValue) != "" && is_numeric($this->max_besarangaji->EditValue)) {
            $this->max_besarangaji->EditValue = FormatNumber($this->max_besarangaji->EditValue, -2, -2, -2, -2);
        }

        // skor_asuransi
        $this->skor_asuransi->EditAttrs["class"] = "form-control";
        $this->skor_asuransi->EditCustomAttributes = "";
        $this->skor_asuransi->EditValue = $this->skor_asuransi->CurrentValue;
        $this->skor_asuransi->PlaceHolder = RemoveHtml($this->skor_asuransi->caption());
        if (strval($this->skor_asuransi->EditValue) != "" && is_numeric($this->skor_asuransi->EditValue)) {
            $this->skor_asuransi->EditValue = FormatNumber($this->skor_asuransi->EditValue, -2, -2, -2, -2);
        }

        // max_asuransi
        $this->max_asuransi->EditAttrs["class"] = "form-control";
        $this->max_asuransi->EditCustomAttributes = "";
        $this->max_asuransi->EditValue = $this->max_asuransi->CurrentValue;
        $this->max_asuransi->PlaceHolder = RemoveHtml($this->max_asuransi->caption());
        if (strval($this->max_asuransi->EditValue) != "" && is_numeric($this->max_asuransi->EditValue)) {
            $this->max_asuransi->EditValue = FormatNumber($this->max_asuransi->EditValue, -2, -2, -2, -2);
        }

        // skor_bonus
        $this->skor_bonus->EditAttrs["class"] = "form-control";
        $this->skor_bonus->EditCustomAttributes = "";
        $this->skor_bonus->EditValue = $this->skor_bonus->CurrentValue;
        $this->skor_bonus->PlaceHolder = RemoveHtml($this->skor_bonus->caption());
        if (strval($this->skor_bonus->EditValue) != "" && is_numeric($this->skor_bonus->EditValue)) {
            $this->skor_bonus->EditValue = FormatNumber($this->skor_bonus->EditValue, -2, -2, -2, -2);
        }

        // max_bonus
        $this->max_bonus->EditAttrs["class"] = "form-control";
        $this->max_bonus->EditCustomAttributes = "";
        $this->max_bonus->EditValue = $this->max_bonus->CurrentValue;
        $this->max_bonus->PlaceHolder = RemoveHtml($this->max_bonus->caption());
        if (strval($this->max_bonus->EditValue) != "" && is_numeric($this->max_bonus->EditValue)) {
            $this->max_bonus->EditValue = FormatNumber($this->max_bonus->EditValue, -2, -2, -2, -2);
        }

        // skor_training
        $this->skor_training->EditAttrs["class"] = "form-control";
        $this->skor_training->EditCustomAttributes = "";
        $this->skor_training->EditValue = $this->skor_training->CurrentValue;
        $this->skor_training->PlaceHolder = RemoveHtml($this->skor_training->caption());
        if (strval($this->skor_training->EditValue) != "" && is_numeric($this->skor_training->EditValue)) {
            $this->skor_training->EditValue = FormatNumber($this->skor_training->EditValue, -2, -2, -2, -2);
        }

        // max_training
        $this->max_training->EditAttrs["class"] = "form-control";
        $this->max_training->EditCustomAttributes = "";
        $this->max_training->EditValue = $this->max_training->CurrentValue;
        $this->max_training->PlaceHolder = RemoveHtml($this->max_training->caption());
        if (strval($this->max_training->EditValue) != "" && is_numeric($this->max_training->EditValue)) {
            $this->max_training->EditValue = FormatNumber($this->max_training->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->skor_oms);
                    $doc->exportCaption($this->max_oms);
                    $doc->exportCaption($this->skor_fokus);
                    $doc->exportCaption($this->max_fokus);
                    $doc->exportCaption($this->skor_target);
                    $doc->exportCaption($this->max_target);
                    $doc->exportCaption($this->skor_karyawan);
                    $doc->exportCaption($this->max_karyawan);
                    $doc->exportCaption($this->skor_outsource);
                    $doc->exportCaption($this->max_outsource);
                    $doc->exportCaption($this->skor_besarangaji);
                    $doc->exportCaption($this->max_besarangaji);
                    $doc->exportCaption($this->skor_asuransi);
                    $doc->exportCaption($this->max_asuransi);
                    $doc->exportCaption($this->skor_bonus);
                    $doc->exportCaption($this->max_bonus);
                    $doc->exportCaption($this->skor_training);
                    $doc->exportCaption($this->max_training);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_oms);
                    $doc->exportCaption($this->max_oms);
                    $doc->exportCaption($this->skor_fokus);
                    $doc->exportCaption($this->max_fokus);
                    $doc->exportCaption($this->skor_target);
                    $doc->exportCaption($this->max_target);
                    $doc->exportCaption($this->skor_karyawan);
                    $doc->exportCaption($this->max_karyawan);
                    $doc->exportCaption($this->skor_outsource);
                    $doc->exportCaption($this->max_outsource);
                    $doc->exportCaption($this->skor_besarangaji);
                    $doc->exportCaption($this->max_besarangaji);
                    $doc->exportCaption($this->skor_asuransi);
                    $doc->exportCaption($this->max_asuransi);
                    $doc->exportCaption($this->skor_bonus);
                    $doc->exportCaption($this->max_bonus);
                    $doc->exportCaption($this->skor_training);
                    $doc->exportCaption($this->max_training);
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
                        $doc->exportField($this->skor_oms);
                        $doc->exportField($this->max_oms);
                        $doc->exportField($this->skor_fokus);
                        $doc->exportField($this->max_fokus);
                        $doc->exportField($this->skor_target);
                        $doc->exportField($this->max_target);
                        $doc->exportField($this->skor_karyawan);
                        $doc->exportField($this->max_karyawan);
                        $doc->exportField($this->skor_outsource);
                        $doc->exportField($this->max_outsource);
                        $doc->exportField($this->skor_besarangaji);
                        $doc->exportField($this->max_besarangaji);
                        $doc->exportField($this->skor_asuransi);
                        $doc->exportField($this->max_asuransi);
                        $doc->exportField($this->skor_bonus);
                        $doc->exportField($this->max_bonus);
                        $doc->exportField($this->skor_training);
                        $doc->exportField($this->max_training);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_oms);
                        $doc->exportField($this->max_oms);
                        $doc->exportField($this->skor_fokus);
                        $doc->exportField($this->max_fokus);
                        $doc->exportField($this->skor_target);
                        $doc->exportField($this->max_target);
                        $doc->exportField($this->skor_karyawan);
                        $doc->exportField($this->max_karyawan);
                        $doc->exportField($this->skor_outsource);
                        $doc->exportField($this->max_outsource);
                        $doc->exportField($this->skor_besarangaji);
                        $doc->exportField($this->max_besarangaji);
                        $doc->exportField($this->skor_asuransi);
                        $doc->exportField($this->max_asuransi);
                        $doc->exportField($this->skor_bonus);
                        $doc->exportField($this->max_bonus);
                        $doc->exportField($this->skor_training);
                        $doc->exportField($this->max_training);
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
