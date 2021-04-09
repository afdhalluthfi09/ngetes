<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for kumkm_literasi
 */
class KumkmLiterasi extends DbTable
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
    public $id;
    public $tgl;
    public $foto;
    public $idjenis;
    public $judul_artikel;
    public $kelas;
    public $isi_artikel;
    public $subjenis;
    public $urutan;
    public $waktu;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'kumkm_literasi';
        $this->TableName = 'kumkm_literasi';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`kumkm_literasi`";
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

        // id
        $this->id = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = false; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // tgl
        $this->tgl = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_tgl', 'tgl', '`tgl`', CastDateFieldForLike("`tgl`", 0, "DB"), 133, 10, 0, false, '`tgl`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tgl->Sortable = true; // Allow sort
        $this->tgl->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tgl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tgl->Param, "CustomMsg");
        $this->Fields['tgl'] = &$this->tgl;

        // foto
        $this->foto = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_foto', 'foto', '`foto`', '`foto`', 200, 100, -1, false, '`foto`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->foto->Sortable = true; // Allow sort
        $this->foto->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->foto->Param, "CustomMsg");
        $this->Fields['foto'] = &$this->foto;

        // idjenis
        $this->idjenis = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_idjenis', 'idjenis', '`idjenis`', '`idjenis`', 200, 30, -1, false, '`idjenis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idjenis->Sortable = true; // Allow sort
        $this->idjenis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idjenis->Param, "CustomMsg");
        $this->Fields['idjenis'] = &$this->idjenis;

        // judul_artikel
        $this->judul_artikel = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_judul_artikel', 'judul_artikel', '`judul_artikel`', '`judul_artikel`', 200, 100, -1, false, '`judul_artikel`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_artikel->Sortable = true; // Allow sort
        $this->judul_artikel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_artikel->Param, "CustomMsg");
        $this->Fields['judul_artikel'] = &$this->judul_artikel;

        // kelas
        $this->kelas = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_kelas', 'kelas', '`kelas`', '`kelas`', 200, 20, -1, false, '`kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelas->Sortable = true; // Allow sort
        $this->kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelas->Param, "CustomMsg");
        $this->Fields['kelas'] = &$this->kelas;

        // isi_artikel
        $this->isi_artikel = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_isi_artikel', 'isi_artikel', '`isi_artikel`', '`isi_artikel`', 201, 65535, -1, false, '`isi_artikel`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->isi_artikel->Sortable = true; // Allow sort
        $this->isi_artikel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->isi_artikel->Param, "CustomMsg");
        $this->Fields['isi_artikel'] = &$this->isi_artikel;

        // subjenis
        $this->subjenis = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_subjenis', 'subjenis', '`subjenis`', '`subjenis`', 200, 50, -1, false, '`subjenis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->subjenis->Sortable = true; // Allow sort
        $this->subjenis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->subjenis->Param, "CustomMsg");
        $this->Fields['subjenis'] = &$this->subjenis;

        // urutan
        $this->urutan = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_urutan', 'urutan', '`urutan`', '`urutan`', 2, 6, -1, false, '`urutan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->urutan->Sortable = true; // Allow sort
        $this->urutan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->urutan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->urutan->Param, "CustomMsg");
        $this->Fields['urutan'] = &$this->urutan;

        // waktu
        $this->waktu = new DbField('kumkm_literasi', 'kumkm_literasi', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 0, "DB"), 135, 19, 0, false, '`waktu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu->Sortable = false; // Allow sort
        $this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu->Param, "CustomMsg");
        $this->Fields['waktu'] = &$this->waktu;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`kumkm_literasi`";
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
            $this->id->setDbValue($conn->lastInsertId());
            $rs['id'] = $this->id->DbValue;
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
            if (array_key_exists('id', $rs)) {
                AddFilter($where, QuotedName('id', $this->Dbid) . '=' . QuotedValue($rs['id'], $this->id->DataType, $this->Dbid));
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
        $this->id->DbValue = $row['id'];
        $this->tgl->DbValue = $row['tgl'];
        $this->foto->DbValue = $row['foto'];
        $this->idjenis->DbValue = $row['idjenis'];
        $this->judul_artikel->DbValue = $row['judul_artikel'];
        $this->kelas->DbValue = $row['kelas'];
        $this->isi_artikel->DbValue = $row['isi_artikel'];
        $this->subjenis->DbValue = $row['subjenis'];
        $this->urutan->DbValue = $row['urutan'];
        $this->waktu->DbValue = $row['waktu'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`id` = @id@";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->id->CurrentValue : $this->id->OldValue;
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
                $this->id->CurrentValue = $keys[0];
            } else {
                $this->id->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('id', $row) ? $row['id'] : null;
        } else {
            $val = $this->id->OldValue !== null ? $this->id->OldValue : $this->id->CurrentValue;
        }
        if (!is_numeric($val)) {
            return "0=1"; // Invalid key
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@id@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("kumkmliterasilist");
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
        if ($pageName == "kumkmliterasiview") {
            return $Language->phrase("View");
        } elseif ($pageName == "kumkmliterasiedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "kumkmliterasiadd") {
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
                return "KumkmLiterasiView";
            case Config("API_ADD_ACTION"):
                return "KumkmLiterasiAdd";
            case Config("API_EDIT_ACTION"):
                return "KumkmLiterasiEdit";
            case Config("API_DELETE_ACTION"):
                return "KumkmLiterasiDelete";
            case Config("API_LIST_ACTION"):
                return "KumkmLiterasiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "kumkmliterasilist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("kumkmliterasiview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("kumkmliterasiview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "kumkmliterasiadd?" . $this->getUrlParm($parm);
        } else {
            $url = "kumkmliterasiadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("kumkmliterasiedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("kumkmliterasiadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("kumkmliterasidelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "id:" . JsonEncode($this->id->CurrentValue, "number");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->id->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->id->CurrentValue);
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
            if (($keyValue = Param("id") ?? Route("id")) !== null) {
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
                $this->id->CurrentValue = $key;
            } else {
                $this->id->OldValue = $key;
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
        $this->id->setDbValue($row['id']);
        $this->tgl->setDbValue($row['tgl']);
        $this->foto->setDbValue($row['foto']);
        $this->idjenis->setDbValue($row['idjenis']);
        $this->judul_artikel->setDbValue($row['judul_artikel']);
        $this->kelas->setDbValue($row['kelas']);
        $this->isi_artikel->setDbValue($row['isi_artikel']);
        $this->subjenis->setDbValue($row['subjenis']);
        $this->urutan->setDbValue($row['urutan']);
        $this->waktu->setDbValue($row['waktu']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id
        $this->id->CellCssStyle = "white-space: nowrap;";

        // tgl

        // foto

        // idjenis

        // judul_artikel

        // kelas

        // isi_artikel

        // subjenis

        // urutan

        // waktu
        $this->waktu->CellCssStyle = "white-space: nowrap;";

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // tgl
        $this->tgl->ViewValue = $this->tgl->CurrentValue;
        $this->tgl->ViewValue = FormatDateTime($this->tgl->ViewValue, 0);
        $this->tgl->ViewCustomAttributes = "";

        // foto
        $this->foto->ViewValue = $this->foto->CurrentValue;
        $this->foto->ViewCustomAttributes = "";

        // idjenis
        $this->idjenis->ViewValue = $this->idjenis->CurrentValue;
        $this->idjenis->ViewCustomAttributes = "";

        // judul_artikel
        $this->judul_artikel->ViewValue = $this->judul_artikel->CurrentValue;
        $this->judul_artikel->ViewCustomAttributes = "";

        // kelas
        $this->kelas->ViewValue = $this->kelas->CurrentValue;
        $this->kelas->ViewCustomAttributes = "";

        // isi_artikel
        $this->isi_artikel->ViewValue = $this->isi_artikel->CurrentValue;
        $this->isi_artikel->ViewCustomAttributes = "";

        // subjenis
        $this->subjenis->ViewValue = $this->subjenis->CurrentValue;
        $this->subjenis->ViewCustomAttributes = "";

        // urutan
        $this->urutan->ViewValue = $this->urutan->CurrentValue;
        $this->urutan->ViewValue = FormatNumber($this->urutan->ViewValue, 0, -2, -2, -2);
        $this->urutan->ViewCustomAttributes = "";

        // waktu
        $this->waktu->ViewValue = $this->waktu->CurrentValue;
        $this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
        $this->waktu->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // tgl
        $this->tgl->LinkCustomAttributes = "";
        $this->tgl->HrefValue = "";
        $this->tgl->TooltipValue = "";

        // foto
        $this->foto->LinkCustomAttributes = "";
        $this->foto->HrefValue = "";
        $this->foto->TooltipValue = "";

        // idjenis
        $this->idjenis->LinkCustomAttributes = "";
        $this->idjenis->HrefValue = "";
        $this->idjenis->TooltipValue = "";

        // judul_artikel
        $this->judul_artikel->LinkCustomAttributes = "";
        $this->judul_artikel->HrefValue = "";
        $this->judul_artikel->TooltipValue = "";

        // kelas
        $this->kelas->LinkCustomAttributes = "";
        $this->kelas->HrefValue = "";
        $this->kelas->TooltipValue = "";

        // isi_artikel
        $this->isi_artikel->LinkCustomAttributes = "";
        $this->isi_artikel->HrefValue = "";
        $this->isi_artikel->TooltipValue = "";

        // subjenis
        $this->subjenis->LinkCustomAttributes = "";
        $this->subjenis->HrefValue = "";
        $this->subjenis->TooltipValue = "";

        // urutan
        $this->urutan->LinkCustomAttributes = "";
        $this->urutan->HrefValue = "";
        $this->urutan->TooltipValue = "";

        // waktu
        $this->waktu->LinkCustomAttributes = "";
        $this->waktu->HrefValue = "";
        $this->waktu->TooltipValue = "";

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

        // id
        $this->id->EditAttrs["class"] = "form-control";
        $this->id->EditCustomAttributes = "";
        $this->id->EditValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // tgl
        $this->tgl->EditAttrs["class"] = "form-control";
        $this->tgl->EditCustomAttributes = "";
        $this->tgl->EditValue = FormatDateTime($this->tgl->CurrentValue, 8);
        $this->tgl->PlaceHolder = RemoveHtml($this->tgl->caption());

        // foto
        $this->foto->EditAttrs["class"] = "form-control";
        $this->foto->EditCustomAttributes = "";
        if (!$this->foto->Raw) {
            $this->foto->CurrentValue = HtmlDecode($this->foto->CurrentValue);
        }
        $this->foto->EditValue = $this->foto->CurrentValue;
        $this->foto->PlaceHolder = RemoveHtml($this->foto->caption());

        // idjenis
        $this->idjenis->EditAttrs["class"] = "form-control";
        $this->idjenis->EditCustomAttributes = "";
        if (!$this->idjenis->Raw) {
            $this->idjenis->CurrentValue = HtmlDecode($this->idjenis->CurrentValue);
        }
        $this->idjenis->EditValue = $this->idjenis->CurrentValue;
        $this->idjenis->PlaceHolder = RemoveHtml($this->idjenis->caption());

        // judul_artikel
        $this->judul_artikel->EditAttrs["class"] = "form-control";
        $this->judul_artikel->EditCustomAttributes = "";
        if (!$this->judul_artikel->Raw) {
            $this->judul_artikel->CurrentValue = HtmlDecode($this->judul_artikel->CurrentValue);
        }
        $this->judul_artikel->EditValue = $this->judul_artikel->CurrentValue;
        $this->judul_artikel->PlaceHolder = RemoveHtml($this->judul_artikel->caption());

        // kelas
        $this->kelas->EditAttrs["class"] = "form-control";
        $this->kelas->EditCustomAttributes = "";
        if (!$this->kelas->Raw) {
            $this->kelas->CurrentValue = HtmlDecode($this->kelas->CurrentValue);
        }
        $this->kelas->EditValue = $this->kelas->CurrentValue;
        $this->kelas->PlaceHolder = RemoveHtml($this->kelas->caption());

        // isi_artikel
        $this->isi_artikel->EditAttrs["class"] = "form-control";
        $this->isi_artikel->EditCustomAttributes = "";
        $this->isi_artikel->EditValue = $this->isi_artikel->CurrentValue;
        $this->isi_artikel->PlaceHolder = RemoveHtml($this->isi_artikel->caption());

        // subjenis
        $this->subjenis->EditAttrs["class"] = "form-control";
        $this->subjenis->EditCustomAttributes = "";
        if (!$this->subjenis->Raw) {
            $this->subjenis->CurrentValue = HtmlDecode($this->subjenis->CurrentValue);
        }
        $this->subjenis->EditValue = $this->subjenis->CurrentValue;
        $this->subjenis->PlaceHolder = RemoveHtml($this->subjenis->caption());

        // urutan
        $this->urutan->EditAttrs["class"] = "form-control";
        $this->urutan->EditCustomAttributes = "";
        $this->urutan->EditValue = $this->urutan->CurrentValue;
        $this->urutan->PlaceHolder = RemoveHtml($this->urutan->caption());

        // waktu
        $this->waktu->EditAttrs["class"] = "form-control";
        $this->waktu->EditCustomAttributes = "";
        $this->waktu->EditValue = FormatDateTime($this->waktu->CurrentValue, 8);
        $this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

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
                    $doc->exportCaption($this->tgl);
                    $doc->exportCaption($this->foto);
                    $doc->exportCaption($this->idjenis);
                    $doc->exportCaption($this->judul_artikel);
                    $doc->exportCaption($this->kelas);
                    $doc->exportCaption($this->isi_artikel);
                    $doc->exportCaption($this->subjenis);
                    $doc->exportCaption($this->urutan);
                } else {
                    $doc->exportCaption($this->tgl);
                    $doc->exportCaption($this->foto);
                    $doc->exportCaption($this->idjenis);
                    $doc->exportCaption($this->judul_artikel);
                    $doc->exportCaption($this->kelas);
                    $doc->exportCaption($this->subjenis);
                    $doc->exportCaption($this->urutan);
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
                        $doc->exportField($this->tgl);
                        $doc->exportField($this->foto);
                        $doc->exportField($this->idjenis);
                        $doc->exportField($this->judul_artikel);
                        $doc->exportField($this->kelas);
                        $doc->exportField($this->isi_artikel);
                        $doc->exportField($this->subjenis);
                        $doc->exportField($this->urutan);
                    } else {
                        $doc->exportField($this->tgl);
                        $doc->exportField($this->foto);
                        $doc->exportField($this->idjenis);
                        $doc->exportField($this->judul_artikel);
                        $doc->exportField($this->kelas);
                        $doc->exportField($this->subjenis);
                        $doc->exportField($this->urutan);
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
