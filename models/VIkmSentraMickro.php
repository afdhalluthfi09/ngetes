<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for v_ikm_sentra_mickro
 */
class VIkmSentraMickro extends DbTable
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
    public $alat_pertanian;
    public $kerajinan;
    public $Kimia_dan_Bahan_Bangunan;
    public $Logam_Dan_Elektronika;
    public $Pangan;
    public $Sandang_Dan_Kulit;
    public $Tenaga_Kerja;
    public $Investasi;
    public $Bahan_Baku;
    public $Produksi;
    public $Kapanewon;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_ikm_sentra_mickro';
        $this->TableName = 'v_ikm_sentra_mickro';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_ikm_sentra_mickro`";
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

        // alat pertanian
        $this->alat_pertanian = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_alat_pertanian', 'alat pertanian', '`alat pertanian`', '`alat pertanian`', 131, 22, -1, false, '`alat pertanian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alat_pertanian->Sortable = true; // Allow sort
        $this->alat_pertanian->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->alat_pertanian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->alat_pertanian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alat_pertanian->Param, "CustomMsg");
        $this->Fields['alat pertanian'] = &$this->alat_pertanian;

        // kerajinan
        $this->kerajinan = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_kerajinan', 'kerajinan', '`kerajinan`', '`kerajinan`', 131, 22, -1, false, '`kerajinan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kerajinan->Sortable = true; // Allow sort
        $this->kerajinan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kerajinan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kerajinan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kerajinan->Param, "CustomMsg");
        $this->Fields['kerajinan'] = &$this->kerajinan;

        // Kimia dan Bahan Bangunan
        $this->Kimia_dan_Bahan_Bangunan = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Kimia_dan_Bahan_Bangunan', 'Kimia dan Bahan Bangunan', '`Kimia dan Bahan Bangunan`', '`Kimia dan Bahan Bangunan`', 131, 22, -1, false, '`Kimia dan Bahan Bangunan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kimia_dan_Bahan_Bangunan->Sortable = true; // Allow sort
        $this->Kimia_dan_Bahan_Bangunan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Kimia_dan_Bahan_Bangunan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Kimia_dan_Bahan_Bangunan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kimia_dan_Bahan_Bangunan->Param, "CustomMsg");
        $this->Fields['Kimia dan Bahan Bangunan'] = &$this->Kimia_dan_Bahan_Bangunan;

        // Logam Dan Elektronika
        $this->Logam_Dan_Elektronika = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Logam_Dan_Elektronika', 'Logam Dan Elektronika', '`Logam Dan Elektronika`', '`Logam Dan Elektronika`', 131, 22, -1, false, '`Logam Dan Elektronika`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Logam_Dan_Elektronika->Sortable = true; // Allow sort
        $this->Logam_Dan_Elektronika->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Logam_Dan_Elektronika->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Logam_Dan_Elektronika->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Logam_Dan_Elektronika->Param, "CustomMsg");
        $this->Fields['Logam Dan Elektronika'] = &$this->Logam_Dan_Elektronika;

        // Pangan
        $this->Pangan = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Pangan', 'Pangan', '`Pangan`', '`Pangan`', 131, 22, -1, false, '`Pangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Pangan->Sortable = true; // Allow sort
        $this->Pangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Pangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Pangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pangan->Param, "CustomMsg");
        $this->Fields['Pangan'] = &$this->Pangan;

        // Sandang Dan Kulit
        $this->Sandang_Dan_Kulit = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Sandang_Dan_Kulit', 'Sandang Dan Kulit', '`Sandang Dan Kulit`', '`Sandang Dan Kulit`', 131, 22, -1, false, '`Sandang Dan Kulit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Sandang_Dan_Kulit->Sortable = true; // Allow sort
        $this->Sandang_Dan_Kulit->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Sandang_Dan_Kulit->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Sandang_Dan_Kulit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Sandang_Dan_Kulit->Param, "CustomMsg");
        $this->Fields['Sandang Dan Kulit'] = &$this->Sandang_Dan_Kulit;

        // Tenaga Kerja
        $this->Tenaga_Kerja = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Tenaga_Kerja', 'Tenaga Kerja', '`Tenaga Kerja`', '`Tenaga Kerja`', 131, 32, -1, false, '`Tenaga Kerja`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tenaga_Kerja->Sortable = true; // Allow sort
        $this->Tenaga_Kerja->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Tenaga_Kerja->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Tenaga_Kerja->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tenaga_Kerja->Param, "CustomMsg");
        $this->Fields['Tenaga Kerja'] = &$this->Tenaga_Kerja;

        // Investasi
        $this->Investasi = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Investasi', 'Investasi', '`Investasi`', '`Investasi`', 5, 23, -1, false, '`Investasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Investasi->Sortable = true; // Allow sort
        $this->Investasi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Investasi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Investasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Investasi->Param, "CustomMsg");
        $this->Fields['Investasi'] = &$this->Investasi;

        // Bahan Baku
        $this->Bahan_Baku = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Bahan_Baku', 'Bahan Baku', '`Bahan Baku`', '`Bahan Baku`', 5, 23, -1, false, '`Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bahan_Baku->Sortable = true; // Allow sort
        $this->Bahan_Baku->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Bahan_Baku->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Bahan Baku'] = &$this->Bahan_Baku;

        // Produksi
        $this->Produksi = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Produksi', 'Produksi', '`Produksi`', '`Produksi`', 5, 23, -1, false, '`Produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Produksi->Sortable = true; // Allow sort
        $this->Produksi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Produksi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Produksi->Param, "CustomMsg");
        $this->Fields['Produksi'] = &$this->Produksi;

        // Kapanewon
        $this->Kapanewon = new DbField('v_ikm_sentra_mickro', 'v_ikm_sentra_mickro', 'x_Kapanewon', 'Kapanewon', '`Kapanewon`', '`Kapanewon`', 200, 255, -1, false, '`Kapanewon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kapanewon->Nullable = false; // NOT NULL field
        $this->Kapanewon->Required = true; // Required field
        $this->Kapanewon->Sortable = true; // Allow sort
        $this->Kapanewon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kapanewon->Param, "CustomMsg");
        $this->Fields['Kapanewon'] = &$this->Kapanewon;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_ikm_sentra_mickro`";
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
        $this->alat_pertanian->DbValue = $row['alat pertanian'];
        $this->kerajinan->DbValue = $row['kerajinan'];
        $this->Kimia_dan_Bahan_Bangunan->DbValue = $row['Kimia dan Bahan Bangunan'];
        $this->Logam_Dan_Elektronika->DbValue = $row['Logam Dan Elektronika'];
        $this->Pangan->DbValue = $row['Pangan'];
        $this->Sandang_Dan_Kulit->DbValue = $row['Sandang Dan Kulit'];
        $this->Tenaga_Kerja->DbValue = $row['Tenaga Kerja'];
        $this->Investasi->DbValue = $row['Investasi'];
        $this->Bahan_Baku->DbValue = $row['Bahan Baku'];
        $this->Produksi->DbValue = $row['Produksi'];
        $this->Kapanewon->DbValue = $row['Kapanewon'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        return implode(Config("COMPOSITE_KEY_SEPARATOR"), $keys);
    }

    // Set Key
    public function setKey($key, $current = false)
    {
        $this->OldKey = strval($key);
        $keys = explode(Config("COMPOSITE_KEY_SEPARATOR"), $this->OldKey);
        if (count($keys) == 0) {
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
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
        return $_SESSION[$name] ?? GetUrl("vikmsentramickrolist");
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
        if ($pageName == "vikmsentramickroview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vikmsentramickroedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vikmsentramickroadd") {
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
                return "VIkmSentraMickroView";
            case Config("API_ADD_ACTION"):
                return "VIkmSentraMickroAdd";
            case Config("API_EDIT_ACTION"):
                return "VIkmSentraMickroEdit";
            case Config("API_DELETE_ACTION"):
                return "VIkmSentraMickroDelete";
            case Config("API_LIST_ACTION"):
                return "VIkmSentraMickroList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vikmsentramickrolist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vikmsentramickroview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vikmsentramickroview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vikmsentramickroadd?" . $this->getUrlParm($parm);
        } else {
            $url = "vikmsentramickroadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vikmsentramickroedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("vikmsentramickroadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("vikmsentramickrodelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
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
        $this->alat_pertanian->setDbValue($row['alat pertanian']);
        $this->kerajinan->setDbValue($row['kerajinan']);
        $this->Kimia_dan_Bahan_Bangunan->setDbValue($row['Kimia dan Bahan Bangunan']);
        $this->Logam_Dan_Elektronika->setDbValue($row['Logam Dan Elektronika']);
        $this->Pangan->setDbValue($row['Pangan']);
        $this->Sandang_Dan_Kulit->setDbValue($row['Sandang Dan Kulit']);
        $this->Tenaga_Kerja->setDbValue($row['Tenaga Kerja']);
        $this->Investasi->setDbValue($row['Investasi']);
        $this->Bahan_Baku->setDbValue($row['Bahan Baku']);
        $this->Produksi->setDbValue($row['Produksi']);
        $this->Kapanewon->setDbValue($row['Kapanewon']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // alat pertanian

        // kerajinan

        // Kimia dan Bahan Bangunan

        // Logam Dan Elektronika

        // Pangan

        // Sandang Dan Kulit

        // Tenaga Kerja

        // Investasi

        // Bahan Baku

        // Produksi

        // Kapanewon

        // alat pertanian
        $this->alat_pertanian->ViewValue = $this->alat_pertanian->CurrentValue;
        $this->alat_pertanian->ViewValue = FormatNumber($this->alat_pertanian->ViewValue, 2, -2, -2, -2);
        $this->alat_pertanian->ViewCustomAttributes = "";

        // kerajinan
        $this->kerajinan->ViewValue = $this->kerajinan->CurrentValue;
        $this->kerajinan->ViewValue = FormatNumber($this->kerajinan->ViewValue, 2, -2, -2, -2);
        $this->kerajinan->ViewCustomAttributes = "";

        // Kimia dan Bahan Bangunan
        $this->Kimia_dan_Bahan_Bangunan->ViewValue = $this->Kimia_dan_Bahan_Bangunan->CurrentValue;
        $this->Kimia_dan_Bahan_Bangunan->ViewValue = FormatNumber($this->Kimia_dan_Bahan_Bangunan->ViewValue, 2, -2, -2, -2);
        $this->Kimia_dan_Bahan_Bangunan->ViewCustomAttributes = "";

        // Logam Dan Elektronika
        $this->Logam_Dan_Elektronika->ViewValue = $this->Logam_Dan_Elektronika->CurrentValue;
        $this->Logam_Dan_Elektronika->ViewValue = FormatNumber($this->Logam_Dan_Elektronika->ViewValue, 2, -2, -2, -2);
        $this->Logam_Dan_Elektronika->ViewCustomAttributes = "";

        // Pangan
        $this->Pangan->ViewValue = $this->Pangan->CurrentValue;
        $this->Pangan->ViewValue = FormatNumber($this->Pangan->ViewValue, 2, -2, -2, -2);
        $this->Pangan->ViewCustomAttributes = "";

        // Sandang Dan Kulit
        $this->Sandang_Dan_Kulit->ViewValue = $this->Sandang_Dan_Kulit->CurrentValue;
        $this->Sandang_Dan_Kulit->ViewValue = FormatNumber($this->Sandang_Dan_Kulit->ViewValue, 2, -2, -2, -2);
        $this->Sandang_Dan_Kulit->ViewCustomAttributes = "";

        // Tenaga Kerja
        $this->Tenaga_Kerja->ViewValue = $this->Tenaga_Kerja->CurrentValue;
        $this->Tenaga_Kerja->ViewValue = FormatNumber($this->Tenaga_Kerja->ViewValue, 2, -2, -2, -2);
        $this->Tenaga_Kerja->ViewCustomAttributes = "";

        // Investasi
        $this->Investasi->ViewValue = $this->Investasi->CurrentValue;
        $this->Investasi->ViewValue = FormatNumber($this->Investasi->ViewValue, 2, -2, -2, -2);
        $this->Investasi->ViewCustomAttributes = "";

        // Bahan Baku
        $this->Bahan_Baku->ViewValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->ViewValue = FormatNumber($this->Bahan_Baku->ViewValue, 2, -2, -2, -2);
        $this->Bahan_Baku->ViewCustomAttributes = "";

        // Produksi
        $this->Produksi->ViewValue = $this->Produksi->CurrentValue;
        $this->Produksi->ViewValue = FormatNumber($this->Produksi->ViewValue, 2, -2, -2, -2);
        $this->Produksi->ViewCustomAttributes = "";

        // Kapanewon
        $this->Kapanewon->ViewValue = $this->Kapanewon->CurrentValue;
        $this->Kapanewon->ViewCustomAttributes = "";

        // alat pertanian
        $this->alat_pertanian->LinkCustomAttributes = "";
        $this->alat_pertanian->HrefValue = "";
        $this->alat_pertanian->TooltipValue = "";

        // kerajinan
        $this->kerajinan->LinkCustomAttributes = "";
        $this->kerajinan->HrefValue = "";
        $this->kerajinan->TooltipValue = "";

        // Kimia dan Bahan Bangunan
        $this->Kimia_dan_Bahan_Bangunan->LinkCustomAttributes = "";
        $this->Kimia_dan_Bahan_Bangunan->HrefValue = "";
        $this->Kimia_dan_Bahan_Bangunan->TooltipValue = "";

        // Logam Dan Elektronika
        $this->Logam_Dan_Elektronika->LinkCustomAttributes = "";
        $this->Logam_Dan_Elektronika->HrefValue = "";
        $this->Logam_Dan_Elektronika->TooltipValue = "";

        // Pangan
        $this->Pangan->LinkCustomAttributes = "";
        $this->Pangan->HrefValue = "";
        $this->Pangan->TooltipValue = "";

        // Sandang Dan Kulit
        $this->Sandang_Dan_Kulit->LinkCustomAttributes = "";
        $this->Sandang_Dan_Kulit->HrefValue = "";
        $this->Sandang_Dan_Kulit->TooltipValue = "";

        // Tenaga Kerja
        $this->Tenaga_Kerja->LinkCustomAttributes = "";
        $this->Tenaga_Kerja->HrefValue = "";
        $this->Tenaga_Kerja->TooltipValue = "";

        // Investasi
        $this->Investasi->LinkCustomAttributes = "";
        $this->Investasi->HrefValue = "";
        $this->Investasi->TooltipValue = "";

        // Bahan Baku
        $this->Bahan_Baku->LinkCustomAttributes = "";
        $this->Bahan_Baku->HrefValue = "";
        $this->Bahan_Baku->TooltipValue = "";

        // Produksi
        $this->Produksi->LinkCustomAttributes = "";
        $this->Produksi->HrefValue = "";
        $this->Produksi->TooltipValue = "";

        // Kapanewon
        $this->Kapanewon->LinkCustomAttributes = "";
        $this->Kapanewon->HrefValue = "";
        $this->Kapanewon->TooltipValue = "";

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

        // alat pertanian
        $this->alat_pertanian->EditAttrs["class"] = "form-control";
        $this->alat_pertanian->EditCustomAttributes = "";
        $this->alat_pertanian->EditValue = $this->alat_pertanian->CurrentValue;
        $this->alat_pertanian->PlaceHolder = RemoveHtml($this->alat_pertanian->caption());
        if (strval($this->alat_pertanian->EditValue) != "" && is_numeric($this->alat_pertanian->EditValue)) {
            $this->alat_pertanian->EditValue = FormatNumber($this->alat_pertanian->EditValue, -2, -2, -2, -2);
        }

        // kerajinan
        $this->kerajinan->EditAttrs["class"] = "form-control";
        $this->kerajinan->EditCustomAttributes = "";
        $this->kerajinan->EditValue = $this->kerajinan->CurrentValue;
        $this->kerajinan->PlaceHolder = RemoveHtml($this->kerajinan->caption());
        if (strval($this->kerajinan->EditValue) != "" && is_numeric($this->kerajinan->EditValue)) {
            $this->kerajinan->EditValue = FormatNumber($this->kerajinan->EditValue, -2, -2, -2, -2);
        }

        // Kimia dan Bahan Bangunan
        $this->Kimia_dan_Bahan_Bangunan->EditAttrs["class"] = "form-control";
        $this->Kimia_dan_Bahan_Bangunan->EditCustomAttributes = "";
        $this->Kimia_dan_Bahan_Bangunan->EditValue = $this->Kimia_dan_Bahan_Bangunan->CurrentValue;
        $this->Kimia_dan_Bahan_Bangunan->PlaceHolder = RemoveHtml($this->Kimia_dan_Bahan_Bangunan->caption());
        if (strval($this->Kimia_dan_Bahan_Bangunan->EditValue) != "" && is_numeric($this->Kimia_dan_Bahan_Bangunan->EditValue)) {
            $this->Kimia_dan_Bahan_Bangunan->EditValue = FormatNumber($this->Kimia_dan_Bahan_Bangunan->EditValue, -2, -2, -2, -2);
        }

        // Logam Dan Elektronika
        $this->Logam_Dan_Elektronika->EditAttrs["class"] = "form-control";
        $this->Logam_Dan_Elektronika->EditCustomAttributes = "";
        $this->Logam_Dan_Elektronika->EditValue = $this->Logam_Dan_Elektronika->CurrentValue;
        $this->Logam_Dan_Elektronika->PlaceHolder = RemoveHtml($this->Logam_Dan_Elektronika->caption());
        if (strval($this->Logam_Dan_Elektronika->EditValue) != "" && is_numeric($this->Logam_Dan_Elektronika->EditValue)) {
            $this->Logam_Dan_Elektronika->EditValue = FormatNumber($this->Logam_Dan_Elektronika->EditValue, -2, -2, -2, -2);
        }

        // Pangan
        $this->Pangan->EditAttrs["class"] = "form-control";
        $this->Pangan->EditCustomAttributes = "";
        $this->Pangan->EditValue = $this->Pangan->CurrentValue;
        $this->Pangan->PlaceHolder = RemoveHtml($this->Pangan->caption());
        if (strval($this->Pangan->EditValue) != "" && is_numeric($this->Pangan->EditValue)) {
            $this->Pangan->EditValue = FormatNumber($this->Pangan->EditValue, -2, -2, -2, -2);
        }

        // Sandang Dan Kulit
        $this->Sandang_Dan_Kulit->EditAttrs["class"] = "form-control";
        $this->Sandang_Dan_Kulit->EditCustomAttributes = "";
        $this->Sandang_Dan_Kulit->EditValue = $this->Sandang_Dan_Kulit->CurrentValue;
        $this->Sandang_Dan_Kulit->PlaceHolder = RemoveHtml($this->Sandang_Dan_Kulit->caption());
        if (strval($this->Sandang_Dan_Kulit->EditValue) != "" && is_numeric($this->Sandang_Dan_Kulit->EditValue)) {
            $this->Sandang_Dan_Kulit->EditValue = FormatNumber($this->Sandang_Dan_Kulit->EditValue, -2, -2, -2, -2);
        }

        // Tenaga Kerja
        $this->Tenaga_Kerja->EditAttrs["class"] = "form-control";
        $this->Tenaga_Kerja->EditCustomAttributes = "";
        $this->Tenaga_Kerja->EditValue = $this->Tenaga_Kerja->CurrentValue;
        $this->Tenaga_Kerja->PlaceHolder = RemoveHtml($this->Tenaga_Kerja->caption());
        if (strval($this->Tenaga_Kerja->EditValue) != "" && is_numeric($this->Tenaga_Kerja->EditValue)) {
            $this->Tenaga_Kerja->EditValue = FormatNumber($this->Tenaga_Kerja->EditValue, -2, -2, -2, -2);
        }

        // Investasi
        $this->Investasi->EditAttrs["class"] = "form-control";
        $this->Investasi->EditCustomAttributes = "";
        $this->Investasi->EditValue = $this->Investasi->CurrentValue;
        $this->Investasi->PlaceHolder = RemoveHtml($this->Investasi->caption());
        if (strval($this->Investasi->EditValue) != "" && is_numeric($this->Investasi->EditValue)) {
            $this->Investasi->EditValue = FormatNumber($this->Investasi->EditValue, -2, -2, -2, -2);
        }

        // Bahan Baku
        $this->Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Bahan_Baku->EditCustomAttributes = "";
        $this->Bahan_Baku->EditValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->PlaceHolder = RemoveHtml($this->Bahan_Baku->caption());
        if (strval($this->Bahan_Baku->EditValue) != "" && is_numeric($this->Bahan_Baku->EditValue)) {
            $this->Bahan_Baku->EditValue = FormatNumber($this->Bahan_Baku->EditValue, -2, -2, -2, -2);
        }

        // Produksi
        $this->Produksi->EditAttrs["class"] = "form-control";
        $this->Produksi->EditCustomAttributes = "";
        $this->Produksi->EditValue = $this->Produksi->CurrentValue;
        $this->Produksi->PlaceHolder = RemoveHtml($this->Produksi->caption());
        if (strval($this->Produksi->EditValue) != "" && is_numeric($this->Produksi->EditValue)) {
            $this->Produksi->EditValue = FormatNumber($this->Produksi->EditValue, -2, -2, -2, -2);
        }

        // Kapanewon
        $this->Kapanewon->EditAttrs["class"] = "form-control";
        $this->Kapanewon->EditCustomAttributes = "";
        if (!$this->Kapanewon->Raw) {
            $this->Kapanewon->CurrentValue = HtmlDecode($this->Kapanewon->CurrentValue);
        }
        $this->Kapanewon->EditValue = $this->Kapanewon->CurrentValue;
        $this->Kapanewon->PlaceHolder = RemoveHtml($this->Kapanewon->caption());

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
                    $doc->exportCaption($this->alat_pertanian);
                    $doc->exportCaption($this->kerajinan);
                    $doc->exportCaption($this->Kimia_dan_Bahan_Bangunan);
                    $doc->exportCaption($this->Logam_Dan_Elektronika);
                    $doc->exportCaption($this->Pangan);
                    $doc->exportCaption($this->Sandang_Dan_Kulit);
                    $doc->exportCaption($this->Tenaga_Kerja);
                    $doc->exportCaption($this->Investasi);
                    $doc->exportCaption($this->Bahan_Baku);
                    $doc->exportCaption($this->Produksi);
                    $doc->exportCaption($this->Kapanewon);
                } else {
                    $doc->exportCaption($this->alat_pertanian);
                    $doc->exportCaption($this->kerajinan);
                    $doc->exportCaption($this->Kimia_dan_Bahan_Bangunan);
                    $doc->exportCaption($this->Logam_Dan_Elektronika);
                    $doc->exportCaption($this->Pangan);
                    $doc->exportCaption($this->Sandang_Dan_Kulit);
                    $doc->exportCaption($this->Tenaga_Kerja);
                    $doc->exportCaption($this->Investasi);
                    $doc->exportCaption($this->Bahan_Baku);
                    $doc->exportCaption($this->Produksi);
                    $doc->exportCaption($this->Kapanewon);
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
                        $doc->exportField($this->alat_pertanian);
                        $doc->exportField($this->kerajinan);
                        $doc->exportField($this->Kimia_dan_Bahan_Bangunan);
                        $doc->exportField($this->Logam_Dan_Elektronika);
                        $doc->exportField($this->Pangan);
                        $doc->exportField($this->Sandang_Dan_Kulit);
                        $doc->exportField($this->Tenaga_Kerja);
                        $doc->exportField($this->Investasi);
                        $doc->exportField($this->Bahan_Baku);
                        $doc->exportField($this->Produksi);
                        $doc->exportField($this->Kapanewon);
                    } else {
                        $doc->exportField($this->alat_pertanian);
                        $doc->exportField($this->kerajinan);
                        $doc->exportField($this->Kimia_dan_Bahan_Bangunan);
                        $doc->exportField($this->Logam_Dan_Elektronika);
                        $doc->exportField($this->Pangan);
                        $doc->exportField($this->Sandang_Dan_Kulit);
                        $doc->exportField($this->Tenaga_Kerja);
                        $doc->exportField($this->Investasi);
                        $doc->exportField($this->Bahan_Baku);
                        $doc->exportField($this->Produksi);
                        $doc->exportField($this->Kapanewon);
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
