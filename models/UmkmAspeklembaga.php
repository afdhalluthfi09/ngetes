<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for umkm_aspeklembaga
 */
class UmkmAspeklembaga extends DbTable
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
    public $LB_BADANHUKUM;
    public $LB_IZINUSAHA;
    public $LB_NPWP;
    public $LB_SO;
    public $LB_JD;
    public $LB_ISO;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'umkm_aspeklembaga';
        $this->TableName = 'umkm_aspeklembaga';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`umkm_aspeklembaga`";
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
        $this->NIK = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Sortable = false; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // LB_BADANHUKUM
        $this->LB_BADANHUKUM = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_BADANHUKUM', 'LB_BADANHUKUM', '`LB_BADANHUKUM`', '`LB_BADANHUKUM`', 200, 50, -1, false, '`LB_BADANHUKUM`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_BADANHUKUM->Sortable = true; // Allow sort
        $this->LB_BADANHUKUM->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_BADANHUKUM->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_BADANHUKUM->Lookup = new Lookup('LB_BADANHUKUM', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_BADANHUKUM->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_BADANHUKUM->Param, "CustomMsg");
        $this->Fields['LB_BADANHUKUM'] = &$this->LB_BADANHUKUM;

        // LB_IZINUSAHA
        $this->LB_IZINUSAHA = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_IZINUSAHA', 'LB_IZINUSAHA', '`LB_IZINUSAHA`', '`LB_IZINUSAHA`', 200, 50, -1, false, '`LB_IZINUSAHA`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_IZINUSAHA->Sortable = true; // Allow sort
        $this->LB_IZINUSAHA->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_IZINUSAHA->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_IZINUSAHA->Lookup = new Lookup('LB_IZINUSAHA', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_IZINUSAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_IZINUSAHA->Param, "CustomMsg");
        $this->Fields['LB_IZINUSAHA'] = &$this->LB_IZINUSAHA;

        // LB_NPWP
        $this->LB_NPWP = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_NPWP', 'LB_NPWP', '`LB_NPWP`', '`LB_NPWP`', 200, 50, -1, false, '`LB_NPWP`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_NPWP->Sortable = true; // Allow sort
        $this->LB_NPWP->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_NPWP->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_NPWP->Lookup = new Lookup('LB_NPWP', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_NPWP->Param, "CustomMsg");
        $this->Fields['LB_NPWP'] = &$this->LB_NPWP;

        // LB_SO
        $this->LB_SO = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_SO', 'LB_SO', '`LB_SO`', '`LB_SO`', 200, 50, -1, false, '`LB_SO`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_SO->Sortable = true; // Allow sort
        $this->LB_SO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_SO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_SO->Lookup = new Lookup('LB_SO', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_SO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_SO->Param, "CustomMsg");
        $this->Fields['LB_SO'] = &$this->LB_SO;

        // LB_JD
        $this->LB_JD = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_JD', 'LB_JD', '`LB_JD`', '`LB_JD`', 200, 50, -1, false, '`LB_JD`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_JD->Sortable = true; // Allow sort
        $this->LB_JD->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_JD->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_JD->Lookup = new Lookup('LB_JD', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_JD->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_JD->Param, "CustomMsg");
        $this->Fields['LB_JD'] = &$this->LB_JD;

        // LB_ISO
        $this->LB_ISO = new DbField('umkm_aspeklembaga', 'umkm_aspeklembaga', 'x_LB_ISO', 'LB_ISO', '`LB_ISO`', '`LB_ISO`', 200, 50, -1, false, '`LB_ISO`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->LB_ISO->Sortable = true; // Allow sort
        $this->LB_ISO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->LB_ISO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->LB_ISO->Lookup = new Lookup('LB_ISO', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->LB_ISO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->LB_ISO->Param, "CustomMsg");
        $this->Fields['LB_ISO'] = &$this->LB_ISO;
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

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`umkm_aspeklembaga`";
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
        $this->DefaultFilter = "`NIK`='".CurrentUserName()."'";
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
        $this->LB_BADANHUKUM->DbValue = $row['LB_BADANHUKUM'];
        $this->LB_IZINUSAHA->DbValue = $row['LB_IZINUSAHA'];
        $this->LB_NPWP->DbValue = $row['LB_NPWP'];
        $this->LB_SO->DbValue = $row['LB_SO'];
        $this->LB_JD->DbValue = $row['LB_JD'];
        $this->LB_ISO->DbValue = $row['LB_ISO'];
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
        return $_SESSION[$name] ?? GetUrl("umkmaspeklembagalist");
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
        if ($pageName == "umkmaspeklembagaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "umkmaspeklembagaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "umkmaspeklembagaadd") {
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
                return "UmkmAspeklembagaView";
            case Config("API_ADD_ACTION"):
                return "UmkmAspeklembagaAdd";
            case Config("API_EDIT_ACTION"):
                return "UmkmAspeklembagaEdit";
            case Config("API_DELETE_ACTION"):
                return "UmkmAspeklembagaDelete";
            case Config("API_LIST_ACTION"):
                return "UmkmAspeklembagaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "umkmaspeklembagalist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmaspeklembagaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmaspeklembagaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "umkmaspeklembagaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "umkmaspeklembagaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("umkmaspeklembagaedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("umkmaspeklembagaadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("umkmaspeklembagadelete", $this->getUrlParm());
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
        $this->LB_BADANHUKUM->setDbValue($row['LB_BADANHUKUM']);
        $this->LB_IZINUSAHA->setDbValue($row['LB_IZINUSAHA']);
        $this->LB_NPWP->setDbValue($row['LB_NPWP']);
        $this->LB_SO->setDbValue($row['LB_SO']);
        $this->LB_JD->setDbValue($row['LB_JD']);
        $this->LB_ISO->setDbValue($row['LB_ISO']);
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

        // LB_BADANHUKUM

        // LB_IZINUSAHA

        // LB_NPWP

        // LB_SO

        // LB_JD

        // LB_ISO

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // LB_BADANHUKUM
        $curVal = strval($this->LB_BADANHUKUM->CurrentValue);
        if ($curVal != "") {
            $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->lookupCacheOption($curVal);
            if ($this->LB_BADANHUKUM->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Badan Hukum'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_BADANHUKUM->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_BADANHUKUM->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->displayValue($arwrk);
                } else {
                    $this->LB_BADANHUKUM->ViewValue = $this->LB_BADANHUKUM->CurrentValue;
                }
            }
        } else {
            $this->LB_BADANHUKUM->ViewValue = null;
        }
        $this->LB_BADANHUKUM->ViewCustomAttributes = "";

        // LB_IZINUSAHA
        $curVal = strval($this->LB_IZINUSAHA->CurrentValue);
        if ($curVal != "") {
            $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->lookupCacheOption($curVal);
            if ($this->LB_IZINUSAHA->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Izin Usaha'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_IZINUSAHA->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_IZINUSAHA->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->displayValue($arwrk);
                } else {
                    $this->LB_IZINUSAHA->ViewValue = $this->LB_IZINUSAHA->CurrentValue;
                }
            }
        } else {
            $this->LB_IZINUSAHA->ViewValue = null;
        }
        $this->LB_IZINUSAHA->ViewCustomAttributes = "";

        // LB_NPWP
        $curVal = strval($this->LB_NPWP->CurrentValue);
        if ($curVal != "") {
            $this->LB_NPWP->ViewValue = $this->LB_NPWP->lookupCacheOption($curVal);
            if ($this->LB_NPWP->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='NPWP'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_NPWP->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_NPWP->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_NPWP->ViewValue = $this->LB_NPWP->displayValue($arwrk);
                } else {
                    $this->LB_NPWP->ViewValue = $this->LB_NPWP->CurrentValue;
                }
            }
        } else {
            $this->LB_NPWP->ViewValue = null;
        }
        $this->LB_NPWP->ViewCustomAttributes = "";

        // LB_SO
        $curVal = strval($this->LB_SO->CurrentValue);
        if ($curVal != "") {
            $this->LB_SO->ViewValue = $this->LB_SO->lookupCacheOption($curVal);
            if ($this->LB_SO->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Struktur Organisasi'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_SO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_SO->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_SO->ViewValue = $this->LB_SO->displayValue($arwrk);
                } else {
                    $this->LB_SO->ViewValue = $this->LB_SO->CurrentValue;
                }
            }
        } else {
            $this->LB_SO->ViewValue = null;
        }
        $this->LB_SO->ViewCustomAttributes = "";

        // LB_JD
        $curVal = strval($this->LB_JD->CurrentValue);
        if ($curVal != "") {
            $this->LB_JD->ViewValue = $this->LB_JD->lookupCacheOption($curVal);
            if ($this->LB_JD->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Jobs Desk'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_JD->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_JD->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_JD->ViewValue = $this->LB_JD->displayValue($arwrk);
                } else {
                    $this->LB_JD->ViewValue = $this->LB_JD->CurrentValue;
                }
            }
        } else {
            $this->LB_JD->ViewValue = null;
        }
        $this->LB_JD->ViewCustomAttributes = "";

        // LB_ISO
        $curVal = strval($this->LB_ISO->CurrentValue);
        if ($curVal != "") {
            $this->LB_ISO->ViewValue = $this->LB_ISO->lookupCacheOption($curVal);
            if ($this->LB_ISO->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='ISO'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->LB_ISO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->LB_ISO->Lookup->renderViewRow($rswrk[0]);
                    $this->LB_ISO->ViewValue = $this->LB_ISO->displayValue($arwrk);
                } else {
                    $this->LB_ISO->ViewValue = $this->LB_ISO->CurrentValue;
                }
            }
        } else {
            $this->LB_ISO->ViewValue = null;
        }
        $this->LB_ISO->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // LB_BADANHUKUM
        $this->LB_BADANHUKUM->LinkCustomAttributes = "";
        $this->LB_BADANHUKUM->HrefValue = "";
        $this->LB_BADANHUKUM->TooltipValue = "";

        // LB_IZINUSAHA
        $this->LB_IZINUSAHA->LinkCustomAttributes = "";
        $this->LB_IZINUSAHA->HrefValue = "";
        $this->LB_IZINUSAHA->TooltipValue = "";

        // LB_NPWP
        $this->LB_NPWP->LinkCustomAttributes = "";
        $this->LB_NPWP->HrefValue = "";
        $this->LB_NPWP->TooltipValue = "";

        // LB_SO
        $this->LB_SO->LinkCustomAttributes = "";
        $this->LB_SO->HrefValue = "";
        $this->LB_SO->TooltipValue = "";

        // LB_JD
        $this->LB_JD->LinkCustomAttributes = "";
        $this->LB_JD->HrefValue = "";
        $this->LB_JD->TooltipValue = "";

        // LB_ISO
        $this->LB_ISO->LinkCustomAttributes = "";
        $this->LB_ISO->HrefValue = "";
        $this->LB_ISO->TooltipValue = "";

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

        // LB_BADANHUKUM
        $this->LB_BADANHUKUM->EditAttrs["class"] = "form-control";
        $this->LB_BADANHUKUM->EditCustomAttributes = "";
        $this->LB_BADANHUKUM->PlaceHolder = RemoveHtml($this->LB_BADANHUKUM->caption());

        // LB_IZINUSAHA
        $this->LB_IZINUSAHA->EditAttrs["class"] = "form-control";
        $this->LB_IZINUSAHA->EditCustomAttributes = "";
        $this->LB_IZINUSAHA->PlaceHolder = RemoveHtml($this->LB_IZINUSAHA->caption());

        // LB_NPWP
        $this->LB_NPWP->EditAttrs["class"] = "form-control";
        $this->LB_NPWP->EditCustomAttributes = "";
        $this->LB_NPWP->PlaceHolder = RemoveHtml($this->LB_NPWP->caption());

        // LB_SO
        $this->LB_SO->EditAttrs["class"] = "form-control";
        $this->LB_SO->EditCustomAttributes = "";
        $this->LB_SO->PlaceHolder = RemoveHtml($this->LB_SO->caption());

        // LB_JD
        $this->LB_JD->EditAttrs["class"] = "form-control";
        $this->LB_JD->EditCustomAttributes = "";
        $this->LB_JD->PlaceHolder = RemoveHtml($this->LB_JD->caption());

        // LB_ISO
        $this->LB_ISO->EditAttrs["class"] = "form-control";
        $this->LB_ISO->EditCustomAttributes = "";
        $this->LB_ISO->PlaceHolder = RemoveHtml($this->LB_ISO->caption());

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
                    $doc->exportCaption($this->LB_BADANHUKUM);
                    $doc->exportCaption($this->LB_IZINUSAHA);
                    $doc->exportCaption($this->LB_NPWP);
                    $doc->exportCaption($this->LB_SO);
                    $doc->exportCaption($this->LB_JD);
                    $doc->exportCaption($this->LB_ISO);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->LB_BADANHUKUM);
                    $doc->exportCaption($this->LB_IZINUSAHA);
                    $doc->exportCaption($this->LB_NPWP);
                    $doc->exportCaption($this->LB_SO);
                    $doc->exportCaption($this->LB_JD);
                    $doc->exportCaption($this->LB_ISO);
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
                        $doc->exportField($this->LB_BADANHUKUM);
                        $doc->exportField($this->LB_IZINUSAHA);
                        $doc->exportField($this->LB_NPWP);
                        $doc->exportField($this->LB_SO);
                        $doc->exportField($this->LB_JD);
                        $doc->exportField($this->LB_ISO);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->LB_BADANHUKUM);
                        $doc->exportField($this->LB_IZINUSAHA);
                        $doc->exportField($this->LB_NPWP);
                        $doc->exportField($this->LB_SO);
                        $doc->exportField($this->LB_JD);
                        $doc->exportField($this->LB_ISO);
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
