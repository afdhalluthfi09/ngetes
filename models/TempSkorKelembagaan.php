<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for temp_skor_kelembagaan
 */
class TempSkorKelembagaan extends DbTable
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
    public $skor_badanhukum;
    public $max_badanhukum;
    public $skor_izin;
    public $max_izin;
    public $skor_npwp;
    public $max_npwp;
    public $skor_struktur;
    public $max_struktur;
    public $skor_jobdesk;
    public $max_jobdesk;
    public $skor_iso;
    public $max_iso;
    public $skor_kelembagaan;
    public $maxskor_kelembagaan;
    public $bobot_kelembagaan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'temp_skor_kelembagaan';
        $this->TableName = 'temp_skor_kelembagaan';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`temp_skor_kelembagaan`";
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
        $this->nik = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // skor_badanhukum
        $this->skor_badanhukum = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_badanhukum', 'skor_badanhukum', '`skor_badanhukum`', '`skor_badanhukum`', 5, 23, -1, false, '`skor_badanhukum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_badanhukum->Sortable = true; // Allow sort
        $this->skor_badanhukum->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_badanhukum->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_badanhukum->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_badanhukum->Param, "CustomMsg");
        $this->Fields['skor_badanhukum'] = &$this->skor_badanhukum;

        // max_badanhukum
        $this->max_badanhukum = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_badanhukum', 'max_badanhukum', '`max_badanhukum`', '`max_badanhukum`', 5, 23, -1, false, '`max_badanhukum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_badanhukum->Sortable = true; // Allow sort
        $this->max_badanhukum->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_badanhukum->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_badanhukum->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_badanhukum->Param, "CustomMsg");
        $this->Fields['max_badanhukum'] = &$this->max_badanhukum;

        // skor_izin
        $this->skor_izin = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_izin', 'skor_izin', '`skor_izin`', '`skor_izin`', 5, 23, -1, false, '`skor_izin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_izin->Sortable = true; // Allow sort
        $this->skor_izin->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_izin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_izin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_izin->Param, "CustomMsg");
        $this->Fields['skor_izin'] = &$this->skor_izin;

        // max_izin
        $this->max_izin = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_izin', 'max_izin', '`max_izin`', '`max_izin`', 5, 23, -1, false, '`max_izin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_izin->Sortable = true; // Allow sort
        $this->max_izin->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_izin->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_izin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_izin->Param, "CustomMsg");
        $this->Fields['max_izin'] = &$this->max_izin;

        // skor_npwp
        $this->skor_npwp = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_npwp', 'skor_npwp', '`skor_npwp`', '`skor_npwp`', 5, 23, -1, false, '`skor_npwp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_npwp->Sortable = true; // Allow sort
        $this->skor_npwp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_npwp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_npwp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_npwp->Param, "CustomMsg");
        $this->Fields['skor_npwp'] = &$this->skor_npwp;

        // max_npwp
        $this->max_npwp = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_npwp', 'max_npwp', '`max_npwp`', '`max_npwp`', 5, 23, -1, false, '`max_npwp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_npwp->Sortable = true; // Allow sort
        $this->max_npwp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_npwp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_npwp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_npwp->Param, "CustomMsg");
        $this->Fields['max_npwp'] = &$this->max_npwp;

        // skor_struktur
        $this->skor_struktur = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_struktur', 'skor_struktur', '`skor_struktur`', '`skor_struktur`', 5, 23, -1, false, '`skor_struktur`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_struktur->Sortable = true; // Allow sort
        $this->skor_struktur->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_struktur->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_struktur->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_struktur->Param, "CustomMsg");
        $this->Fields['skor_struktur'] = &$this->skor_struktur;

        // max_struktur
        $this->max_struktur = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_struktur', 'max_struktur', '`max_struktur`', '`max_struktur`', 5, 23, -1, false, '`max_struktur`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_struktur->Sortable = true; // Allow sort
        $this->max_struktur->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_struktur->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_struktur->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_struktur->Param, "CustomMsg");
        $this->Fields['max_struktur'] = &$this->max_struktur;

        // skor_jobdesk
        $this->skor_jobdesk = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_jobdesk', 'skor_jobdesk', '`skor_jobdesk`', '`skor_jobdesk`', 5, 23, -1, false, '`skor_jobdesk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_jobdesk->Sortable = true; // Allow sort
        $this->skor_jobdesk->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_jobdesk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_jobdesk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_jobdesk->Param, "CustomMsg");
        $this->Fields['skor_jobdesk'] = &$this->skor_jobdesk;

        // max_jobdesk
        $this->max_jobdesk = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_jobdesk', 'max_jobdesk', '`max_jobdesk`', '`max_jobdesk`', 5, 23, -1, false, '`max_jobdesk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_jobdesk->Sortable = true; // Allow sort
        $this->max_jobdesk->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_jobdesk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_jobdesk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_jobdesk->Param, "CustomMsg");
        $this->Fields['max_jobdesk'] = &$this->max_jobdesk;

        // skor_iso
        $this->skor_iso = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_iso', 'skor_iso', '`skor_iso`', '`skor_iso`', 5, 23, -1, false, '`skor_iso`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_iso->Sortable = true; // Allow sort
        $this->skor_iso->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_iso->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_iso->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_iso->Param, "CustomMsg");
        $this->Fields['skor_iso'] = &$this->skor_iso;

        // max_iso
        $this->max_iso = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_max_iso', 'max_iso', '`max_iso`', '`max_iso`', 5, 23, -1, false, '`max_iso`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_iso->Sortable = true; // Allow sort
        $this->max_iso->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_iso->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_iso->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_iso->Param, "CustomMsg");
        $this->Fields['max_iso'] = &$this->max_iso;

        // skor_kelembagaan
        $this->skor_kelembagaan = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_skor_kelembagaan', 'skor_kelembagaan', '`skor_kelembagaan`', '`skor_kelembagaan`', 5, 23, -1, false, '`skor_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_kelembagaan->Sortable = true; // Allow sort
        $this->skor_kelembagaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_kelembagaan->Param, "CustomMsg");
        $this->Fields['skor_kelembagaan'] = &$this->skor_kelembagaan;

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_maxskor_kelembagaan', 'maxskor_kelembagaan', '`maxskor_kelembagaan`', '`maxskor_kelembagaan`', 5, 23, -1, false, '`maxskor_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_kelembagaan->Sortable = true; // Allow sort
        $this->maxskor_kelembagaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_kelembagaan->Param, "CustomMsg");
        $this->Fields['maxskor_kelembagaan'] = &$this->maxskor_kelembagaan;

        // bobot_kelembagaan
        $this->bobot_kelembagaan = new DbField('temp_skor_kelembagaan', 'temp_skor_kelembagaan', 'x_bobot_kelembagaan', 'bobot_kelembagaan', '`bobot_kelembagaan`', '`bobot_kelembagaan`', 3, 2, -1, false, '`bobot_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_kelembagaan->Nullable = false; // NOT NULL field
        $this->bobot_kelembagaan->Required = true; // Required field
        $this->bobot_kelembagaan->Sortable = true; // Allow sort
        $this->bobot_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_kelembagaan->Param, "CustomMsg");
        $this->Fields['bobot_kelembagaan'] = &$this->bobot_kelembagaan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`temp_skor_kelembagaan`";
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
        $this->skor_badanhukum->DbValue = $row['skor_badanhukum'];
        $this->max_badanhukum->DbValue = $row['max_badanhukum'];
        $this->skor_izin->DbValue = $row['skor_izin'];
        $this->max_izin->DbValue = $row['max_izin'];
        $this->skor_npwp->DbValue = $row['skor_npwp'];
        $this->max_npwp->DbValue = $row['max_npwp'];
        $this->skor_struktur->DbValue = $row['skor_struktur'];
        $this->max_struktur->DbValue = $row['max_struktur'];
        $this->skor_jobdesk->DbValue = $row['skor_jobdesk'];
        $this->max_jobdesk->DbValue = $row['max_jobdesk'];
        $this->skor_iso->DbValue = $row['skor_iso'];
        $this->max_iso->DbValue = $row['max_iso'];
        $this->skor_kelembagaan->DbValue = $row['skor_kelembagaan'];
        $this->maxskor_kelembagaan->DbValue = $row['maxskor_kelembagaan'];
        $this->bobot_kelembagaan->DbValue = $row['bobot_kelembagaan'];
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
        return $_SESSION[$name] ?? GetUrl("tempskorkelembagaanlist");
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
        if ($pageName == "tempskorkelembagaanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tempskorkelembagaanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tempskorkelembagaanadd") {
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
                return "TempSkorKelembagaanView";
            case Config("API_ADD_ACTION"):
                return "TempSkorKelembagaanAdd";
            case Config("API_EDIT_ACTION"):
                return "TempSkorKelembagaanEdit";
            case Config("API_DELETE_ACTION"):
                return "TempSkorKelembagaanDelete";
            case Config("API_LIST_ACTION"):
                return "TempSkorKelembagaanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tempskorkelembagaanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tempskorkelembagaanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tempskorkelembagaanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tempskorkelembagaanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tempskorkelembagaanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tempskorkelembagaanedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tempskorkelembagaanadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tempskorkelembagaandelete", $this->getUrlParm());
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
        $this->skor_badanhukum->setDbValue($row['skor_badanhukum']);
        $this->max_badanhukum->setDbValue($row['max_badanhukum']);
        $this->skor_izin->setDbValue($row['skor_izin']);
        $this->max_izin->setDbValue($row['max_izin']);
        $this->skor_npwp->setDbValue($row['skor_npwp']);
        $this->max_npwp->setDbValue($row['max_npwp']);
        $this->skor_struktur->setDbValue($row['skor_struktur']);
        $this->max_struktur->setDbValue($row['max_struktur']);
        $this->skor_jobdesk->setDbValue($row['skor_jobdesk']);
        $this->max_jobdesk->setDbValue($row['max_jobdesk']);
        $this->skor_iso->setDbValue($row['skor_iso']);
        $this->max_iso->setDbValue($row['max_iso']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // skor_badanhukum

        // max_badanhukum

        // skor_izin

        // max_izin

        // skor_npwp

        // max_npwp

        // skor_struktur

        // max_struktur

        // skor_jobdesk

        // max_jobdesk

        // skor_iso

        // max_iso

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // skor_badanhukum
        $this->skor_badanhukum->ViewValue = $this->skor_badanhukum->CurrentValue;
        $this->skor_badanhukum->ViewValue = FormatNumber($this->skor_badanhukum->ViewValue, 2, -2, -2, -2);
        $this->skor_badanhukum->ViewCustomAttributes = "";

        // max_badanhukum
        $this->max_badanhukum->ViewValue = $this->max_badanhukum->CurrentValue;
        $this->max_badanhukum->ViewValue = FormatNumber($this->max_badanhukum->ViewValue, 2, -2, -2, -2);
        $this->max_badanhukum->ViewCustomAttributes = "";

        // skor_izin
        $this->skor_izin->ViewValue = $this->skor_izin->CurrentValue;
        $this->skor_izin->ViewValue = FormatNumber($this->skor_izin->ViewValue, 2, -2, -2, -2);
        $this->skor_izin->ViewCustomAttributes = "";

        // max_izin
        $this->max_izin->ViewValue = $this->max_izin->CurrentValue;
        $this->max_izin->ViewValue = FormatNumber($this->max_izin->ViewValue, 2, -2, -2, -2);
        $this->max_izin->ViewCustomAttributes = "";

        // skor_npwp
        $this->skor_npwp->ViewValue = $this->skor_npwp->CurrentValue;
        $this->skor_npwp->ViewValue = FormatNumber($this->skor_npwp->ViewValue, 2, -2, -2, -2);
        $this->skor_npwp->ViewCustomAttributes = "";

        // max_npwp
        $this->max_npwp->ViewValue = $this->max_npwp->CurrentValue;
        $this->max_npwp->ViewValue = FormatNumber($this->max_npwp->ViewValue, 2, -2, -2, -2);
        $this->max_npwp->ViewCustomAttributes = "";

        // skor_struktur
        $this->skor_struktur->ViewValue = $this->skor_struktur->CurrentValue;
        $this->skor_struktur->ViewValue = FormatNumber($this->skor_struktur->ViewValue, 2, -2, -2, -2);
        $this->skor_struktur->ViewCustomAttributes = "";

        // max_struktur
        $this->max_struktur->ViewValue = $this->max_struktur->CurrentValue;
        $this->max_struktur->ViewValue = FormatNumber($this->max_struktur->ViewValue, 2, -2, -2, -2);
        $this->max_struktur->ViewCustomAttributes = "";

        // skor_jobdesk
        $this->skor_jobdesk->ViewValue = $this->skor_jobdesk->CurrentValue;
        $this->skor_jobdesk->ViewValue = FormatNumber($this->skor_jobdesk->ViewValue, 2, -2, -2, -2);
        $this->skor_jobdesk->ViewCustomAttributes = "";

        // max_jobdesk
        $this->max_jobdesk->ViewValue = $this->max_jobdesk->CurrentValue;
        $this->max_jobdesk->ViewValue = FormatNumber($this->max_jobdesk->ViewValue, 2, -2, -2, -2);
        $this->max_jobdesk->ViewCustomAttributes = "";

        // skor_iso
        $this->skor_iso->ViewValue = $this->skor_iso->CurrentValue;
        $this->skor_iso->ViewValue = FormatNumber($this->skor_iso->ViewValue, 2, -2, -2, -2);
        $this->skor_iso->ViewCustomAttributes = "";

        // max_iso
        $this->max_iso->ViewValue = $this->max_iso->CurrentValue;
        $this->max_iso->ViewValue = FormatNumber($this->max_iso->ViewValue, 2, -2, -2, -2);
        $this->max_iso->ViewCustomAttributes = "";

        // skor_kelembagaan
        $this->skor_kelembagaan->ViewValue = $this->skor_kelembagaan->CurrentValue;
        $this->skor_kelembagaan->ViewValue = FormatNumber($this->skor_kelembagaan->ViewValue, 2, -2, -2, -2);
        $this->skor_kelembagaan->ViewCustomAttributes = "";

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->ViewValue = $this->maxskor_kelembagaan->CurrentValue;
        $this->maxskor_kelembagaan->ViewValue = FormatNumber($this->maxskor_kelembagaan->ViewValue, 2, -2, -2, -2);
        $this->maxskor_kelembagaan->ViewCustomAttributes = "";

        // bobot_kelembagaan
        $this->bobot_kelembagaan->ViewValue = $this->bobot_kelembagaan->CurrentValue;
        $this->bobot_kelembagaan->ViewValue = FormatNumber($this->bobot_kelembagaan->ViewValue, 0, -2, -2, -2);
        $this->bobot_kelembagaan->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // skor_badanhukum
        $this->skor_badanhukum->LinkCustomAttributes = "";
        $this->skor_badanhukum->HrefValue = "";
        $this->skor_badanhukum->TooltipValue = "";

        // max_badanhukum
        $this->max_badanhukum->LinkCustomAttributes = "";
        $this->max_badanhukum->HrefValue = "";
        $this->max_badanhukum->TooltipValue = "";

        // skor_izin
        $this->skor_izin->LinkCustomAttributes = "";
        $this->skor_izin->HrefValue = "";
        $this->skor_izin->TooltipValue = "";

        // max_izin
        $this->max_izin->LinkCustomAttributes = "";
        $this->max_izin->HrefValue = "";
        $this->max_izin->TooltipValue = "";

        // skor_npwp
        $this->skor_npwp->LinkCustomAttributes = "";
        $this->skor_npwp->HrefValue = "";
        $this->skor_npwp->TooltipValue = "";

        // max_npwp
        $this->max_npwp->LinkCustomAttributes = "";
        $this->max_npwp->HrefValue = "";
        $this->max_npwp->TooltipValue = "";

        // skor_struktur
        $this->skor_struktur->LinkCustomAttributes = "";
        $this->skor_struktur->HrefValue = "";
        $this->skor_struktur->TooltipValue = "";

        // max_struktur
        $this->max_struktur->LinkCustomAttributes = "";
        $this->max_struktur->HrefValue = "";
        $this->max_struktur->TooltipValue = "";

        // skor_jobdesk
        $this->skor_jobdesk->LinkCustomAttributes = "";
        $this->skor_jobdesk->HrefValue = "";
        $this->skor_jobdesk->TooltipValue = "";

        // max_jobdesk
        $this->max_jobdesk->LinkCustomAttributes = "";
        $this->max_jobdesk->HrefValue = "";
        $this->max_jobdesk->TooltipValue = "";

        // skor_iso
        $this->skor_iso->LinkCustomAttributes = "";
        $this->skor_iso->HrefValue = "";
        $this->skor_iso->TooltipValue = "";

        // max_iso
        $this->max_iso->LinkCustomAttributes = "";
        $this->max_iso->HrefValue = "";
        $this->max_iso->TooltipValue = "";

        // skor_kelembagaan
        $this->skor_kelembagaan->LinkCustomAttributes = "";
        $this->skor_kelembagaan->HrefValue = "";
        $this->skor_kelembagaan->TooltipValue = "";

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->LinkCustomAttributes = "";
        $this->maxskor_kelembagaan->HrefValue = "";
        $this->maxskor_kelembagaan->TooltipValue = "";

        // bobot_kelembagaan
        $this->bobot_kelembagaan->LinkCustomAttributes = "";
        $this->bobot_kelembagaan->HrefValue = "";
        $this->bobot_kelembagaan->TooltipValue = "";

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

        // skor_badanhukum
        $this->skor_badanhukum->EditAttrs["class"] = "form-control";
        $this->skor_badanhukum->EditCustomAttributes = "";
        $this->skor_badanhukum->EditValue = $this->skor_badanhukum->CurrentValue;
        $this->skor_badanhukum->PlaceHolder = RemoveHtml($this->skor_badanhukum->caption());
        if (strval($this->skor_badanhukum->EditValue) != "" && is_numeric($this->skor_badanhukum->EditValue)) {
            $this->skor_badanhukum->EditValue = FormatNumber($this->skor_badanhukum->EditValue, -2, -2, -2, -2);
        }

        // max_badanhukum
        $this->max_badanhukum->EditAttrs["class"] = "form-control";
        $this->max_badanhukum->EditCustomAttributes = "";
        $this->max_badanhukum->EditValue = $this->max_badanhukum->CurrentValue;
        $this->max_badanhukum->PlaceHolder = RemoveHtml($this->max_badanhukum->caption());
        if (strval($this->max_badanhukum->EditValue) != "" && is_numeric($this->max_badanhukum->EditValue)) {
            $this->max_badanhukum->EditValue = FormatNumber($this->max_badanhukum->EditValue, -2, -2, -2, -2);
        }

        // skor_izin
        $this->skor_izin->EditAttrs["class"] = "form-control";
        $this->skor_izin->EditCustomAttributes = "";
        $this->skor_izin->EditValue = $this->skor_izin->CurrentValue;
        $this->skor_izin->PlaceHolder = RemoveHtml($this->skor_izin->caption());
        if (strval($this->skor_izin->EditValue) != "" && is_numeric($this->skor_izin->EditValue)) {
            $this->skor_izin->EditValue = FormatNumber($this->skor_izin->EditValue, -2, -2, -2, -2);
        }

        // max_izin
        $this->max_izin->EditAttrs["class"] = "form-control";
        $this->max_izin->EditCustomAttributes = "";
        $this->max_izin->EditValue = $this->max_izin->CurrentValue;
        $this->max_izin->PlaceHolder = RemoveHtml($this->max_izin->caption());
        if (strval($this->max_izin->EditValue) != "" && is_numeric($this->max_izin->EditValue)) {
            $this->max_izin->EditValue = FormatNumber($this->max_izin->EditValue, -2, -2, -2, -2);
        }

        // skor_npwp
        $this->skor_npwp->EditAttrs["class"] = "form-control";
        $this->skor_npwp->EditCustomAttributes = "";
        $this->skor_npwp->EditValue = $this->skor_npwp->CurrentValue;
        $this->skor_npwp->PlaceHolder = RemoveHtml($this->skor_npwp->caption());
        if (strval($this->skor_npwp->EditValue) != "" && is_numeric($this->skor_npwp->EditValue)) {
            $this->skor_npwp->EditValue = FormatNumber($this->skor_npwp->EditValue, -2, -2, -2, -2);
        }

        // max_npwp
        $this->max_npwp->EditAttrs["class"] = "form-control";
        $this->max_npwp->EditCustomAttributes = "";
        $this->max_npwp->EditValue = $this->max_npwp->CurrentValue;
        $this->max_npwp->PlaceHolder = RemoveHtml($this->max_npwp->caption());
        if (strval($this->max_npwp->EditValue) != "" && is_numeric($this->max_npwp->EditValue)) {
            $this->max_npwp->EditValue = FormatNumber($this->max_npwp->EditValue, -2, -2, -2, -2);
        }

        // skor_struktur
        $this->skor_struktur->EditAttrs["class"] = "form-control";
        $this->skor_struktur->EditCustomAttributes = "";
        $this->skor_struktur->EditValue = $this->skor_struktur->CurrentValue;
        $this->skor_struktur->PlaceHolder = RemoveHtml($this->skor_struktur->caption());
        if (strval($this->skor_struktur->EditValue) != "" && is_numeric($this->skor_struktur->EditValue)) {
            $this->skor_struktur->EditValue = FormatNumber($this->skor_struktur->EditValue, -2, -2, -2, -2);
        }

        // max_struktur
        $this->max_struktur->EditAttrs["class"] = "form-control";
        $this->max_struktur->EditCustomAttributes = "";
        $this->max_struktur->EditValue = $this->max_struktur->CurrentValue;
        $this->max_struktur->PlaceHolder = RemoveHtml($this->max_struktur->caption());
        if (strval($this->max_struktur->EditValue) != "" && is_numeric($this->max_struktur->EditValue)) {
            $this->max_struktur->EditValue = FormatNumber($this->max_struktur->EditValue, -2, -2, -2, -2);
        }

        // skor_jobdesk
        $this->skor_jobdesk->EditAttrs["class"] = "form-control";
        $this->skor_jobdesk->EditCustomAttributes = "";
        $this->skor_jobdesk->EditValue = $this->skor_jobdesk->CurrentValue;
        $this->skor_jobdesk->PlaceHolder = RemoveHtml($this->skor_jobdesk->caption());
        if (strval($this->skor_jobdesk->EditValue) != "" && is_numeric($this->skor_jobdesk->EditValue)) {
            $this->skor_jobdesk->EditValue = FormatNumber($this->skor_jobdesk->EditValue, -2, -2, -2, -2);
        }

        // max_jobdesk
        $this->max_jobdesk->EditAttrs["class"] = "form-control";
        $this->max_jobdesk->EditCustomAttributes = "";
        $this->max_jobdesk->EditValue = $this->max_jobdesk->CurrentValue;
        $this->max_jobdesk->PlaceHolder = RemoveHtml($this->max_jobdesk->caption());
        if (strval($this->max_jobdesk->EditValue) != "" && is_numeric($this->max_jobdesk->EditValue)) {
            $this->max_jobdesk->EditValue = FormatNumber($this->max_jobdesk->EditValue, -2, -2, -2, -2);
        }

        // skor_iso
        $this->skor_iso->EditAttrs["class"] = "form-control";
        $this->skor_iso->EditCustomAttributes = "";
        $this->skor_iso->EditValue = $this->skor_iso->CurrentValue;
        $this->skor_iso->PlaceHolder = RemoveHtml($this->skor_iso->caption());
        if (strval($this->skor_iso->EditValue) != "" && is_numeric($this->skor_iso->EditValue)) {
            $this->skor_iso->EditValue = FormatNumber($this->skor_iso->EditValue, -2, -2, -2, -2);
        }

        // max_iso
        $this->max_iso->EditAttrs["class"] = "form-control";
        $this->max_iso->EditCustomAttributes = "";
        $this->max_iso->EditValue = $this->max_iso->CurrentValue;
        $this->max_iso->PlaceHolder = RemoveHtml($this->max_iso->caption());
        if (strval($this->max_iso->EditValue) != "" && is_numeric($this->max_iso->EditValue)) {
            $this->max_iso->EditValue = FormatNumber($this->max_iso->EditValue, -2, -2, -2, -2);
        }

        // skor_kelembagaan
        $this->skor_kelembagaan->EditAttrs["class"] = "form-control";
        $this->skor_kelembagaan->EditCustomAttributes = "";
        $this->skor_kelembagaan->EditValue = $this->skor_kelembagaan->CurrentValue;
        $this->skor_kelembagaan->PlaceHolder = RemoveHtml($this->skor_kelembagaan->caption());
        if (strval($this->skor_kelembagaan->EditValue) != "" && is_numeric($this->skor_kelembagaan->EditValue)) {
            $this->skor_kelembagaan->EditValue = FormatNumber($this->skor_kelembagaan->EditValue, -2, -2, -2, -2);
        }

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->EditAttrs["class"] = "form-control";
        $this->maxskor_kelembagaan->EditCustomAttributes = "";
        $this->maxskor_kelembagaan->EditValue = $this->maxskor_kelembagaan->CurrentValue;
        $this->maxskor_kelembagaan->PlaceHolder = RemoveHtml($this->maxskor_kelembagaan->caption());
        if (strval($this->maxskor_kelembagaan->EditValue) != "" && is_numeric($this->maxskor_kelembagaan->EditValue)) {
            $this->maxskor_kelembagaan->EditValue = FormatNumber($this->maxskor_kelembagaan->EditValue, -2, -2, -2, -2);
        }

        // bobot_kelembagaan
        $this->bobot_kelembagaan->EditAttrs["class"] = "form-control";
        $this->bobot_kelembagaan->EditCustomAttributes = "";
        $this->bobot_kelembagaan->EditValue = $this->bobot_kelembagaan->CurrentValue;
        $this->bobot_kelembagaan->PlaceHolder = RemoveHtml($this->bobot_kelembagaan->caption());

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
                    $doc->exportCaption($this->skor_badanhukum);
                    $doc->exportCaption($this->max_badanhukum);
                    $doc->exportCaption($this->skor_izin);
                    $doc->exportCaption($this->max_izin);
                    $doc->exportCaption($this->skor_npwp);
                    $doc->exportCaption($this->max_npwp);
                    $doc->exportCaption($this->skor_struktur);
                    $doc->exportCaption($this->max_struktur);
                    $doc->exportCaption($this->skor_jobdesk);
                    $doc->exportCaption($this->max_jobdesk);
                    $doc->exportCaption($this->skor_iso);
                    $doc->exportCaption($this->max_iso);
                    $doc->exportCaption($this->skor_kelembagaan);
                    $doc->exportCaption($this->maxskor_kelembagaan);
                    $doc->exportCaption($this->bobot_kelembagaan);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_badanhukum);
                    $doc->exportCaption($this->max_badanhukum);
                    $doc->exportCaption($this->skor_izin);
                    $doc->exportCaption($this->max_izin);
                    $doc->exportCaption($this->skor_npwp);
                    $doc->exportCaption($this->max_npwp);
                    $doc->exportCaption($this->skor_struktur);
                    $doc->exportCaption($this->max_struktur);
                    $doc->exportCaption($this->skor_jobdesk);
                    $doc->exportCaption($this->max_jobdesk);
                    $doc->exportCaption($this->skor_iso);
                    $doc->exportCaption($this->max_iso);
                    $doc->exportCaption($this->skor_kelembagaan);
                    $doc->exportCaption($this->maxskor_kelembagaan);
                    $doc->exportCaption($this->bobot_kelembagaan);
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
                        $doc->exportField($this->skor_badanhukum);
                        $doc->exportField($this->max_badanhukum);
                        $doc->exportField($this->skor_izin);
                        $doc->exportField($this->max_izin);
                        $doc->exportField($this->skor_npwp);
                        $doc->exportField($this->max_npwp);
                        $doc->exportField($this->skor_struktur);
                        $doc->exportField($this->max_struktur);
                        $doc->exportField($this->skor_jobdesk);
                        $doc->exportField($this->max_jobdesk);
                        $doc->exportField($this->skor_iso);
                        $doc->exportField($this->max_iso);
                        $doc->exportField($this->skor_kelembagaan);
                        $doc->exportField($this->maxskor_kelembagaan);
                        $doc->exportField($this->bobot_kelembagaan);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_badanhukum);
                        $doc->exportField($this->max_badanhukum);
                        $doc->exportField($this->skor_izin);
                        $doc->exportField($this->max_izin);
                        $doc->exportField($this->skor_npwp);
                        $doc->exportField($this->max_npwp);
                        $doc->exportField($this->skor_struktur);
                        $doc->exportField($this->max_struktur);
                        $doc->exportField($this->skor_jobdesk);
                        $doc->exportField($this->max_jobdesk);
                        $doc->exportField($this->skor_iso);
                        $doc->exportField($this->max_iso);
                        $doc->exportField($this->skor_kelembagaan);
                        $doc->exportField($this->maxskor_kelembagaan);
                        $doc->exportField($this->bobot_kelembagaan);
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
