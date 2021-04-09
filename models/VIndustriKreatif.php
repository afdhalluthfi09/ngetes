<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for v_industri_kreatif
 */
class VIndustriKreatif extends DbTable
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
    public $name;
    public $Usaha;
    public $tenaga_kerja;
    public $fashion;
    public $kreatif;
    public $kuliner;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'v_industri_kreatif';
        $this->TableName = 'v_industri_kreatif';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`v_industri_kreatif`";
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

        // name
        $this->name = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_name', 'name', '`name`', '`name`', 200, 255, -1, false, '`name`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->name->Nullable = false; // NOT NULL field
        $this->name->Required = true; // Required field
        $this->name->Sortable = true; // Allow sort
        $this->name->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->name->Param, "CustomMsg");
        $this->Fields['name'] = &$this->name;

        // Usaha
        $this->Usaha = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_Usaha', 'Usaha', '`Usaha`', '`Usaha`', 20, 21, -1, false, '`Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha->Nullable = false; // NOT NULL field
        $this->Usaha->Sortable = true; // Allow sort
        $this->Usaha->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha->Param, "CustomMsg");
        $this->Fields['Usaha'] = &$this->Usaha;

        // tenaga kerja
        $this->tenaga_kerja = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_tenaga_kerja', 'tenaga kerja', '`tenaga kerja`', '`tenaga kerja`', 131, 32, -1, false, '`tenaga kerja`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tenaga_kerja->Sortable = true; // Allow sort
        $this->tenaga_kerja->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->tenaga_kerja->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->tenaga_kerja->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tenaga_kerja->Param, "CustomMsg");
        $this->Fields['tenaga kerja'] = &$this->tenaga_kerja;

        // fashion
        $this->fashion = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_fashion', 'fashion', '`fashion`', '`fashion`', 131, 22, -1, false, '`fashion`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->fashion->Sortable = true; // Allow sort
        $this->fashion->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->fashion->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->fashion->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fashion->Param, "CustomMsg");
        $this->Fields['fashion'] = &$this->fashion;

        // kreatif
        $this->kreatif = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_kreatif', 'kreatif', '`kreatif`', '`kreatif`', 131, 22, -1, false, '`kreatif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kreatif->Sortable = true; // Allow sort
        $this->kreatif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kreatif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kreatif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kreatif->Param, "CustomMsg");
        $this->Fields['kreatif'] = &$this->kreatif;

        // kuliner
        $this->kuliner = new DbField('v_industri_kreatif', 'v_industri_kreatif', 'x_kuliner', 'kuliner', '`kuliner`', '`kuliner`', 131, 22, -1, false, '`kuliner`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kuliner->Sortable = true; // Allow sort
        $this->kuliner->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kuliner->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kuliner->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kuliner->Param, "CustomMsg");
        $this->Fields['kuliner'] = &$this->kuliner;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`v_industri_kreatif`";
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
        $this->name->DbValue = $row['name'];
        $this->Usaha->DbValue = $row['Usaha'];
        $this->tenaga_kerja->DbValue = $row['tenaga kerja'];
        $this->fashion->DbValue = $row['fashion'];
        $this->kreatif->DbValue = $row['kreatif'];
        $this->kuliner->DbValue = $row['kuliner'];
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
        return $_SESSION[$name] ?? GetUrl("vindustrikreatiflist");
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
        if ($pageName == "vindustrikreatifview") {
            return $Language->phrase("View");
        } elseif ($pageName == "vindustrikreatifedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "vindustrikreatifadd") {
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
                return "VIndustriKreatifView";
            case Config("API_ADD_ACTION"):
                return "VIndustriKreatifAdd";
            case Config("API_EDIT_ACTION"):
                return "VIndustriKreatifEdit";
            case Config("API_DELETE_ACTION"):
                return "VIndustriKreatifDelete";
            case Config("API_LIST_ACTION"):
                return "VIndustriKreatifList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "vindustrikreatiflist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("vindustrikreatifview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("vindustrikreatifview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "vindustrikreatifadd?" . $this->getUrlParm($parm);
        } else {
            $url = "vindustrikreatifadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("vindustrikreatifedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("vindustrikreatifadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("vindustrikreatifdelete", $this->getUrlParm());
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
        $this->name->setDbValue($row['name']);
        $this->Usaha->setDbValue($row['Usaha']);
        $this->tenaga_kerja->setDbValue($row['tenaga kerja']);
        $this->fashion->setDbValue($row['fashion']);
        $this->kreatif->setDbValue($row['kreatif']);
        $this->kuliner->setDbValue($row['kuliner']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // name

        // Usaha

        // tenaga kerja

        // fashion

        // kreatif

        // kuliner

        // name
        $this->name->ViewValue = $this->name->CurrentValue;
        $this->name->ViewCustomAttributes = "";

        // Usaha
        $this->Usaha->ViewValue = $this->Usaha->CurrentValue;
        $this->Usaha->ViewValue = FormatNumber($this->Usaha->ViewValue, 0, -2, -2, -2);
        $this->Usaha->ViewCustomAttributes = "";

        // tenaga kerja
        $this->tenaga_kerja->ViewValue = $this->tenaga_kerja->CurrentValue;
        $this->tenaga_kerja->ViewValue = FormatNumber($this->tenaga_kerja->ViewValue, 2, -2, -2, -2);
        $this->tenaga_kerja->ViewCustomAttributes = "";

        // fashion
        $this->fashion->ViewValue = $this->fashion->CurrentValue;
        $this->fashion->ViewValue = FormatNumber($this->fashion->ViewValue, 2, -2, -2, -2);
        $this->fashion->ViewCustomAttributes = "";

        // kreatif
        $this->kreatif->ViewValue = $this->kreatif->CurrentValue;
        $this->kreatif->ViewValue = FormatNumber($this->kreatif->ViewValue, 2, -2, -2, -2);
        $this->kreatif->ViewCustomAttributes = "";

        // kuliner
        $this->kuliner->ViewValue = $this->kuliner->CurrentValue;
        $this->kuliner->ViewValue = FormatNumber($this->kuliner->ViewValue, 2, -2, -2, -2);
        $this->kuliner->ViewCustomAttributes = "";

        // name
        $this->name->LinkCustomAttributes = "";
        $this->name->HrefValue = "";
        $this->name->TooltipValue = "";

        // Usaha
        $this->Usaha->LinkCustomAttributes = "";
        $this->Usaha->HrefValue = "";
        $this->Usaha->TooltipValue = "";

        // tenaga kerja
        $this->tenaga_kerja->LinkCustomAttributes = "";
        $this->tenaga_kerja->HrefValue = "";
        $this->tenaga_kerja->TooltipValue = "";

        // fashion
        $this->fashion->LinkCustomAttributes = "";
        $this->fashion->HrefValue = "";
        $this->fashion->TooltipValue = "";

        // kreatif
        $this->kreatif->LinkCustomAttributes = "";
        $this->kreatif->HrefValue = "";
        $this->kreatif->TooltipValue = "";

        // kuliner
        $this->kuliner->LinkCustomAttributes = "";
        $this->kuliner->HrefValue = "";
        $this->kuliner->TooltipValue = "";

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

        // name
        $this->name->EditAttrs["class"] = "form-control";
        $this->name->EditCustomAttributes = "";
        if (!$this->name->Raw) {
            $this->name->CurrentValue = HtmlDecode($this->name->CurrentValue);
        }
        $this->name->EditValue = $this->name->CurrentValue;
        $this->name->PlaceHolder = RemoveHtml($this->name->caption());

        // Usaha
        $this->Usaha->EditAttrs["class"] = "form-control";
        $this->Usaha->EditCustomAttributes = "";
        $this->Usaha->EditValue = $this->Usaha->CurrentValue;
        $this->Usaha->PlaceHolder = RemoveHtml($this->Usaha->caption());

        // tenaga kerja
        $this->tenaga_kerja->EditAttrs["class"] = "form-control";
        $this->tenaga_kerja->EditCustomAttributes = "";
        $this->tenaga_kerja->EditValue = $this->tenaga_kerja->CurrentValue;
        $this->tenaga_kerja->PlaceHolder = RemoveHtml($this->tenaga_kerja->caption());
        if (strval($this->tenaga_kerja->EditValue) != "" && is_numeric($this->tenaga_kerja->EditValue)) {
            $this->tenaga_kerja->EditValue = FormatNumber($this->tenaga_kerja->EditValue, -2, -2, -2, -2);
        }

        // fashion
        $this->fashion->EditAttrs["class"] = "form-control";
        $this->fashion->EditCustomAttributes = "";
        $this->fashion->EditValue = $this->fashion->CurrentValue;
        $this->fashion->PlaceHolder = RemoveHtml($this->fashion->caption());
        if (strval($this->fashion->EditValue) != "" && is_numeric($this->fashion->EditValue)) {
            $this->fashion->EditValue = FormatNumber($this->fashion->EditValue, -2, -2, -2, -2);
        }

        // kreatif
        $this->kreatif->EditAttrs["class"] = "form-control";
        $this->kreatif->EditCustomAttributes = "";
        $this->kreatif->EditValue = $this->kreatif->CurrentValue;
        $this->kreatif->PlaceHolder = RemoveHtml($this->kreatif->caption());
        if (strval($this->kreatif->EditValue) != "" && is_numeric($this->kreatif->EditValue)) {
            $this->kreatif->EditValue = FormatNumber($this->kreatif->EditValue, -2, -2, -2, -2);
        }

        // kuliner
        $this->kuliner->EditAttrs["class"] = "form-control";
        $this->kuliner->EditCustomAttributes = "";
        $this->kuliner->EditValue = $this->kuliner->CurrentValue;
        $this->kuliner->PlaceHolder = RemoveHtml($this->kuliner->caption());
        if (strval($this->kuliner->EditValue) != "" && is_numeric($this->kuliner->EditValue)) {
            $this->kuliner->EditValue = FormatNumber($this->kuliner->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->Usaha);
                    $doc->exportCaption($this->tenaga_kerja);
                    $doc->exportCaption($this->fashion);
                    $doc->exportCaption($this->kreatif);
                    $doc->exportCaption($this->kuliner);
                } else {
                    $doc->exportCaption($this->name);
                    $doc->exportCaption($this->Usaha);
                    $doc->exportCaption($this->tenaga_kerja);
                    $doc->exportCaption($this->fashion);
                    $doc->exportCaption($this->kreatif);
                    $doc->exportCaption($this->kuliner);
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
                        $doc->exportField($this->name);
                        $doc->exportField($this->Usaha);
                        $doc->exportField($this->tenaga_kerja);
                        $doc->exportField($this->fashion);
                        $doc->exportField($this->kreatif);
                        $doc->exportField($this->kuliner);
                    } else {
                        $doc->exportField($this->name);
                        $doc->exportField($this->Usaha);
                        $doc->exportField($this->tenaga_kerja);
                        $doc->exportField($this->fashion);
                        $doc->exportField($this->kreatif);
                        $doc->exportField($this->kuliner);
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
