<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for web_sidakui
 */
class WebSidakui extends DbTable
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
    public $baner_1;
    public $baner_2;
    public $baner_3;
    public $baner_4;
    public $baner_5;
    public $baner_6;
    public $judul_baner_1;
    public $judul_baner_2;
    public $judul_baner_3;
    public $judul_baner_4;
    public $judul_baner_5;
    public $judul_baner_6;
    public $text_baner_1;
    public $text_baner_2;
    public $text_baner_3;
    public $text_baner_4;
    public $text_baner_5;
    public $text_baner_6;
    public $alamat_dinas;
    public $instagram;
    public $facebook;
    public $no_wa;
    public $tentang_sidakui;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'web_sidakui';
        $this->TableName = 'web_sidakui';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`web_sidakui`";
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
        $this->id = new DbField('web_sidakui', 'web_sidakui', 'x_id', 'id', '`id`', '`id`', 2, 6, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // baner_1
        $this->baner_1 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_1', 'baner_1', '`baner_1`', '`baner_1`', 200, 50, -1, false, '`baner_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_1->Sortable = true; // Allow sort
        $this->baner_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_1->Param, "CustomMsg");
        $this->Fields['baner_1'] = &$this->baner_1;

        // baner_2
        $this->baner_2 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_2', 'baner_2', '`baner_2`', '`baner_2`', 200, 50, -1, false, '`baner_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_2->Sortable = true; // Allow sort
        $this->baner_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_2->Param, "CustomMsg");
        $this->Fields['baner_2'] = &$this->baner_2;

        // baner_3
        $this->baner_3 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_3', 'baner_3', '`baner_3`', '`baner_3`', 200, 50, -1, false, '`baner_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_3->Sortable = true; // Allow sort
        $this->baner_3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_3->Param, "CustomMsg");
        $this->Fields['baner_3'] = &$this->baner_3;

        // baner_4
        $this->baner_4 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_4', 'baner_4', '`baner_4`', '`baner_4`', 200, 50, -1, false, '`baner_4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_4->Sortable = true; // Allow sort
        $this->baner_4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_4->Param, "CustomMsg");
        $this->Fields['baner_4'] = &$this->baner_4;

        // baner_5
        $this->baner_5 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_5', 'baner_5', '`baner_5`', '`baner_5`', 200, 50, -1, false, '`baner_5`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_5->Sortable = true; // Allow sort
        $this->baner_5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_5->Param, "CustomMsg");
        $this->Fields['baner_5'] = &$this->baner_5;

        // baner_6
        $this->baner_6 = new DbField('web_sidakui', 'web_sidakui', 'x_baner_6', 'baner_6', '`baner_6`', '`baner_6`', 200, 50, -1, false, '`baner_6`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->baner_6->Sortable = true; // Allow sort
        $this->baner_6->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->baner_6->Param, "CustomMsg");
        $this->Fields['baner_6'] = &$this->baner_6;

        // judul_baner_1
        $this->judul_baner_1 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_1', 'judul_baner_1', '`judul_baner_1`', '`judul_baner_1`', 200, 100, -1, false, '`judul_baner_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_1->Sortable = true; // Allow sort
        $this->judul_baner_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_1->Param, "CustomMsg");
        $this->Fields['judul_baner_1'] = &$this->judul_baner_1;

        // judul_baner_2
        $this->judul_baner_2 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_2', 'judul_baner_2', '`judul_baner_2`', '`judul_baner_2`', 200, 100, -1, false, '`judul_baner_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_2->Sortable = true; // Allow sort
        $this->judul_baner_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_2->Param, "CustomMsg");
        $this->Fields['judul_baner_2'] = &$this->judul_baner_2;

        // judul_baner_3
        $this->judul_baner_3 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_3', 'judul_baner_3', '`judul_baner_3`', '`judul_baner_3`', 200, 100, -1, false, '`judul_baner_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_3->Sortable = true; // Allow sort
        $this->judul_baner_3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_3->Param, "CustomMsg");
        $this->Fields['judul_baner_3'] = &$this->judul_baner_3;

        // judul_baner_4
        $this->judul_baner_4 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_4', 'judul_baner_4', '`judul_baner_4`', '`judul_baner_4`', 200, 100, -1, false, '`judul_baner_4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_4->Sortable = true; // Allow sort
        $this->judul_baner_4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_4->Param, "CustomMsg");
        $this->Fields['judul_baner_4'] = &$this->judul_baner_4;

        // judul_baner_5
        $this->judul_baner_5 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_5', 'judul_baner_5', '`judul_baner_5`', '`judul_baner_5`', 200, 100, -1, false, '`judul_baner_5`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_5->Sortable = true; // Allow sort
        $this->judul_baner_5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_5->Param, "CustomMsg");
        $this->Fields['judul_baner_5'] = &$this->judul_baner_5;

        // judul_baner_6
        $this->judul_baner_6 = new DbField('web_sidakui', 'web_sidakui', 'x_judul_baner_6', 'judul_baner_6', '`judul_baner_6`', '`judul_baner_6`', 200, 100, -1, false, '`judul_baner_6`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_baner_6->Sortable = true; // Allow sort
        $this->judul_baner_6->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_baner_6->Param, "CustomMsg");
        $this->Fields['judul_baner_6'] = &$this->judul_baner_6;

        // text_baner_1
        $this->text_baner_1 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_1', 'text_baner_1', '`text_baner_1`', '`text_baner_1`', 200, 100, -1, false, '`text_baner_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_1->Sortable = true; // Allow sort
        $this->text_baner_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_1->Param, "CustomMsg");
        $this->Fields['text_baner_1'] = &$this->text_baner_1;

        // text_baner_2
        $this->text_baner_2 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_2', 'text_baner_2', '`text_baner_2`', '`text_baner_2`', 200, 100, -1, false, '`text_baner_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_2->Sortable = true; // Allow sort
        $this->text_baner_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_2->Param, "CustomMsg");
        $this->Fields['text_baner_2'] = &$this->text_baner_2;

        // text_baner_3
        $this->text_baner_3 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_3', 'text_baner_3', '`text_baner_3`', '`text_baner_3`', 200, 100, -1, false, '`text_baner_3`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_3->Sortable = true; // Allow sort
        $this->text_baner_3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_3->Param, "CustomMsg");
        $this->Fields['text_baner_3'] = &$this->text_baner_3;

        // text_baner_4
        $this->text_baner_4 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_4', 'text_baner_4', '`text_baner_4`', '`text_baner_4`', 200, 100, -1, false, '`text_baner_4`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_4->Sortable = true; // Allow sort
        $this->text_baner_4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_4->Param, "CustomMsg");
        $this->Fields['text_baner_4'] = &$this->text_baner_4;

        // text_baner_5
        $this->text_baner_5 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_5', 'text_baner_5', '`text_baner_5`', '`text_baner_5`', 200, 100, -1, false, '`text_baner_5`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_5->Sortable = true; // Allow sort
        $this->text_baner_5->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_5->Param, "CustomMsg");
        $this->Fields['text_baner_5'] = &$this->text_baner_5;

        // text_baner_6
        $this->text_baner_6 = new DbField('web_sidakui', 'web_sidakui', 'x_text_baner_6', 'text_baner_6', '`text_baner_6`', '`text_baner_6`', 200, 100, -1, false, '`text_baner_6`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->text_baner_6->Sortable = true; // Allow sort
        $this->text_baner_6->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->text_baner_6->Param, "CustomMsg");
        $this->Fields['text_baner_6'] = &$this->text_baner_6;

        // alamat_dinas
        $this->alamat_dinas = new DbField('web_sidakui', 'web_sidakui', 'x_alamat_dinas', 'alamat_dinas', '`alamat_dinas`', '`alamat_dinas`', 200, 255, -1, false, '`alamat_dinas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat_dinas->Sortable = true; // Allow sort
        $this->alamat_dinas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat_dinas->Param, "CustomMsg");
        $this->Fields['alamat_dinas'] = &$this->alamat_dinas;

        // instagram
        $this->instagram = new DbField('web_sidakui', 'web_sidakui', 'x_instagram', 'instagram', '`instagram`', '`instagram`', 200, 200, -1, false, '`instagram`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->instagram->Sortable = true; // Allow sort
        $this->instagram->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->instagram->Param, "CustomMsg");
        $this->Fields['instagram'] = &$this->instagram;

        // facebook
        $this->facebook = new DbField('web_sidakui', 'web_sidakui', 'x_facebook', 'facebook', '`facebook`', '`facebook`', 200, 200, -1, false, '`facebook`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->facebook->Sortable = true; // Allow sort
        $this->facebook->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->facebook->Param, "CustomMsg");
        $this->Fields['facebook'] = &$this->facebook;

        // no_wa
        $this->no_wa = new DbField('web_sidakui', 'web_sidakui', 'x_no_wa', 'no_wa', '`no_wa`', '`no_wa`', 200, 20, -1, false, '`no_wa`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_wa->Sortable = true; // Allow sort
        $this->no_wa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_wa->Param, "CustomMsg");
        $this->Fields['no_wa'] = &$this->no_wa;

        // tentang_sidakui
        $this->tentang_sidakui = new DbField('web_sidakui', 'web_sidakui', 'x_tentang_sidakui', 'tentang_sidakui', '`tentang_sidakui`', '`tentang_sidakui`', 201, 65535, -1, false, '`tentang_sidakui`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->tentang_sidakui->Sortable = true; // Allow sort
        $this->tentang_sidakui->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tentang_sidakui->Param, "CustomMsg");
        $this->Fields['tentang_sidakui'] = &$this->tentang_sidakui;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`web_sidakui`";
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
        $this->baner_1->DbValue = $row['baner_1'];
        $this->baner_2->DbValue = $row['baner_2'];
        $this->baner_3->DbValue = $row['baner_3'];
        $this->baner_4->DbValue = $row['baner_4'];
        $this->baner_5->DbValue = $row['baner_5'];
        $this->baner_6->DbValue = $row['baner_6'];
        $this->judul_baner_1->DbValue = $row['judul_baner_1'];
        $this->judul_baner_2->DbValue = $row['judul_baner_2'];
        $this->judul_baner_3->DbValue = $row['judul_baner_3'];
        $this->judul_baner_4->DbValue = $row['judul_baner_4'];
        $this->judul_baner_5->DbValue = $row['judul_baner_5'];
        $this->judul_baner_6->DbValue = $row['judul_baner_6'];
        $this->text_baner_1->DbValue = $row['text_baner_1'];
        $this->text_baner_2->DbValue = $row['text_baner_2'];
        $this->text_baner_3->DbValue = $row['text_baner_3'];
        $this->text_baner_4->DbValue = $row['text_baner_4'];
        $this->text_baner_5->DbValue = $row['text_baner_5'];
        $this->text_baner_6->DbValue = $row['text_baner_6'];
        $this->alamat_dinas->DbValue = $row['alamat_dinas'];
        $this->instagram->DbValue = $row['instagram'];
        $this->facebook->DbValue = $row['facebook'];
        $this->no_wa->DbValue = $row['no_wa'];
        $this->tentang_sidakui->DbValue = $row['tentang_sidakui'];
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
        return $_SESSION[$name] ?? GetUrl("websidakuilist");
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
        if ($pageName == "websidakuiview") {
            return $Language->phrase("View");
        } elseif ($pageName == "websidakuiedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "websidakuiadd") {
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
                return "WebSidakuiView";
            case Config("API_ADD_ACTION"):
                return "WebSidakuiAdd";
            case Config("API_EDIT_ACTION"):
                return "WebSidakuiEdit";
            case Config("API_DELETE_ACTION"):
                return "WebSidakuiDelete";
            case Config("API_LIST_ACTION"):
                return "WebSidakuiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "websidakuilist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("websidakuiview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("websidakuiview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "websidakuiadd?" . $this->getUrlParm($parm);
        } else {
            $url = "websidakuiadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("websidakuiedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("websidakuiadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("websidakuidelete", $this->getUrlParm());
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
        $this->baner_1->setDbValue($row['baner_1']);
        $this->baner_2->setDbValue($row['baner_2']);
        $this->baner_3->setDbValue($row['baner_3']);
        $this->baner_4->setDbValue($row['baner_4']);
        $this->baner_5->setDbValue($row['baner_5']);
        $this->baner_6->setDbValue($row['baner_6']);
        $this->judul_baner_1->setDbValue($row['judul_baner_1']);
        $this->judul_baner_2->setDbValue($row['judul_baner_2']);
        $this->judul_baner_3->setDbValue($row['judul_baner_3']);
        $this->judul_baner_4->setDbValue($row['judul_baner_4']);
        $this->judul_baner_5->setDbValue($row['judul_baner_5']);
        $this->judul_baner_6->setDbValue($row['judul_baner_6']);
        $this->text_baner_1->setDbValue($row['text_baner_1']);
        $this->text_baner_2->setDbValue($row['text_baner_2']);
        $this->text_baner_3->setDbValue($row['text_baner_3']);
        $this->text_baner_4->setDbValue($row['text_baner_4']);
        $this->text_baner_5->setDbValue($row['text_baner_5']);
        $this->text_baner_6->setDbValue($row['text_baner_6']);
        $this->alamat_dinas->setDbValue($row['alamat_dinas']);
        $this->instagram->setDbValue($row['instagram']);
        $this->facebook->setDbValue($row['facebook']);
        $this->no_wa->setDbValue($row['no_wa']);
        $this->tentang_sidakui->setDbValue($row['tentang_sidakui']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // baner_1

        // baner_2

        // baner_3

        // baner_4

        // baner_5

        // baner_6

        // judul_baner_1

        // judul_baner_2

        // judul_baner_3

        // judul_baner_4

        // judul_baner_5

        // judul_baner_6

        // text_baner_1

        // text_baner_2

        // text_baner_3

        // text_baner_4

        // text_baner_5

        // text_baner_6

        // alamat_dinas

        // instagram

        // facebook

        // no_wa

        // tentang_sidakui

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // baner_1
        $this->baner_1->ViewValue = $this->baner_1->CurrentValue;
        $this->baner_1->ViewCustomAttributes = "";

        // baner_2
        $this->baner_2->ViewValue = $this->baner_2->CurrentValue;
        $this->baner_2->ViewCustomAttributes = "";

        // baner_3
        $this->baner_3->ViewValue = $this->baner_3->CurrentValue;
        $this->baner_3->ViewCustomAttributes = "";

        // baner_4
        $this->baner_4->ViewValue = $this->baner_4->CurrentValue;
        $this->baner_4->ViewCustomAttributes = "";

        // baner_5
        $this->baner_5->ViewValue = $this->baner_5->CurrentValue;
        $this->baner_5->ViewCustomAttributes = "";

        // baner_6
        $this->baner_6->ViewValue = $this->baner_6->CurrentValue;
        $this->baner_6->ViewCustomAttributes = "";

        // judul_baner_1
        $this->judul_baner_1->ViewValue = $this->judul_baner_1->CurrentValue;
        $this->judul_baner_1->ViewCustomAttributes = "";

        // judul_baner_2
        $this->judul_baner_2->ViewValue = $this->judul_baner_2->CurrentValue;
        $this->judul_baner_2->ViewCustomAttributes = "";

        // judul_baner_3
        $this->judul_baner_3->ViewValue = $this->judul_baner_3->CurrentValue;
        $this->judul_baner_3->ViewCustomAttributes = "";

        // judul_baner_4
        $this->judul_baner_4->ViewValue = $this->judul_baner_4->CurrentValue;
        $this->judul_baner_4->ViewCustomAttributes = "";

        // judul_baner_5
        $this->judul_baner_5->ViewValue = $this->judul_baner_5->CurrentValue;
        $this->judul_baner_5->ViewCustomAttributes = "";

        // judul_baner_6
        $this->judul_baner_6->ViewValue = $this->judul_baner_6->CurrentValue;
        $this->judul_baner_6->ViewCustomAttributes = "";

        // text_baner_1
        $this->text_baner_1->ViewValue = $this->text_baner_1->CurrentValue;
        $this->text_baner_1->ViewCustomAttributes = "";

        // text_baner_2
        $this->text_baner_2->ViewValue = $this->text_baner_2->CurrentValue;
        $this->text_baner_2->ViewCustomAttributes = "";

        // text_baner_3
        $this->text_baner_3->ViewValue = $this->text_baner_3->CurrentValue;
        $this->text_baner_3->ViewCustomAttributes = "";

        // text_baner_4
        $this->text_baner_4->ViewValue = $this->text_baner_4->CurrentValue;
        $this->text_baner_4->ViewCustomAttributes = "";

        // text_baner_5
        $this->text_baner_5->ViewValue = $this->text_baner_5->CurrentValue;
        $this->text_baner_5->ViewCustomAttributes = "";

        // text_baner_6
        $this->text_baner_6->ViewValue = $this->text_baner_6->CurrentValue;
        $this->text_baner_6->ViewCustomAttributes = "";

        // alamat_dinas
        $this->alamat_dinas->ViewValue = $this->alamat_dinas->CurrentValue;
        $this->alamat_dinas->ViewCustomAttributes = "";

        // instagram
        $this->instagram->ViewValue = $this->instagram->CurrentValue;
        $this->instagram->ViewCustomAttributes = "";

        // facebook
        $this->facebook->ViewValue = $this->facebook->CurrentValue;
        $this->facebook->ViewCustomAttributes = "";

        // no_wa
        $this->no_wa->ViewValue = $this->no_wa->CurrentValue;
        $this->no_wa->ViewCustomAttributes = "";

        // tentang_sidakui
        $this->tentang_sidakui->ViewValue = $this->tentang_sidakui->CurrentValue;
        $this->tentang_sidakui->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // baner_1
        $this->baner_1->LinkCustomAttributes = "";
        $this->baner_1->HrefValue = "";
        $this->baner_1->TooltipValue = "";

        // baner_2
        $this->baner_2->LinkCustomAttributes = "";
        $this->baner_2->HrefValue = "";
        $this->baner_2->TooltipValue = "";

        // baner_3
        $this->baner_3->LinkCustomAttributes = "";
        $this->baner_3->HrefValue = "";
        $this->baner_3->TooltipValue = "";

        // baner_4
        $this->baner_4->LinkCustomAttributes = "";
        $this->baner_4->HrefValue = "";
        $this->baner_4->TooltipValue = "";

        // baner_5
        $this->baner_5->LinkCustomAttributes = "";
        $this->baner_5->HrefValue = "";
        $this->baner_5->TooltipValue = "";

        // baner_6
        $this->baner_6->LinkCustomAttributes = "";
        $this->baner_6->HrefValue = "";
        $this->baner_6->TooltipValue = "";

        // judul_baner_1
        $this->judul_baner_1->LinkCustomAttributes = "";
        $this->judul_baner_1->HrefValue = "";
        $this->judul_baner_1->TooltipValue = "";

        // judul_baner_2
        $this->judul_baner_2->LinkCustomAttributes = "";
        $this->judul_baner_2->HrefValue = "";
        $this->judul_baner_2->TooltipValue = "";

        // judul_baner_3
        $this->judul_baner_3->LinkCustomAttributes = "";
        $this->judul_baner_3->HrefValue = "";
        $this->judul_baner_3->TooltipValue = "";

        // judul_baner_4
        $this->judul_baner_4->LinkCustomAttributes = "";
        $this->judul_baner_4->HrefValue = "";
        $this->judul_baner_4->TooltipValue = "";

        // judul_baner_5
        $this->judul_baner_5->LinkCustomAttributes = "";
        $this->judul_baner_5->HrefValue = "";
        $this->judul_baner_5->TooltipValue = "";

        // judul_baner_6
        $this->judul_baner_6->LinkCustomAttributes = "";
        $this->judul_baner_6->HrefValue = "";
        $this->judul_baner_6->TooltipValue = "";

        // text_baner_1
        $this->text_baner_1->LinkCustomAttributes = "";
        $this->text_baner_1->HrefValue = "";
        $this->text_baner_1->TooltipValue = "";

        // text_baner_2
        $this->text_baner_2->LinkCustomAttributes = "";
        $this->text_baner_2->HrefValue = "";
        $this->text_baner_2->TooltipValue = "";

        // text_baner_3
        $this->text_baner_3->LinkCustomAttributes = "";
        $this->text_baner_3->HrefValue = "";
        $this->text_baner_3->TooltipValue = "";

        // text_baner_4
        $this->text_baner_4->LinkCustomAttributes = "";
        $this->text_baner_4->HrefValue = "";
        $this->text_baner_4->TooltipValue = "";

        // text_baner_5
        $this->text_baner_5->LinkCustomAttributes = "";
        $this->text_baner_5->HrefValue = "";
        $this->text_baner_5->TooltipValue = "";

        // text_baner_6
        $this->text_baner_6->LinkCustomAttributes = "";
        $this->text_baner_6->HrefValue = "";
        $this->text_baner_6->TooltipValue = "";

        // alamat_dinas
        $this->alamat_dinas->LinkCustomAttributes = "";
        $this->alamat_dinas->HrefValue = "";
        $this->alamat_dinas->TooltipValue = "";

        // instagram
        $this->instagram->LinkCustomAttributes = "";
        $this->instagram->HrefValue = "";
        $this->instagram->TooltipValue = "";

        // facebook
        $this->facebook->LinkCustomAttributes = "";
        $this->facebook->HrefValue = "";
        $this->facebook->TooltipValue = "";

        // no_wa
        $this->no_wa->LinkCustomAttributes = "";
        $this->no_wa->HrefValue = "";
        $this->no_wa->TooltipValue = "";

        // tentang_sidakui
        $this->tentang_sidakui->LinkCustomAttributes = "";
        $this->tentang_sidakui->HrefValue = "";
        $this->tentang_sidakui->TooltipValue = "";

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

        // baner_1
        $this->baner_1->EditAttrs["class"] = "form-control";
        $this->baner_1->EditCustomAttributes = "";
        if (!$this->baner_1->Raw) {
            $this->baner_1->CurrentValue = HtmlDecode($this->baner_1->CurrentValue);
        }
        $this->baner_1->EditValue = $this->baner_1->CurrentValue;
        $this->baner_1->PlaceHolder = RemoveHtml($this->baner_1->caption());

        // baner_2
        $this->baner_2->EditAttrs["class"] = "form-control";
        $this->baner_2->EditCustomAttributes = "";
        if (!$this->baner_2->Raw) {
            $this->baner_2->CurrentValue = HtmlDecode($this->baner_2->CurrentValue);
        }
        $this->baner_2->EditValue = $this->baner_2->CurrentValue;
        $this->baner_2->PlaceHolder = RemoveHtml($this->baner_2->caption());

        // baner_3
        $this->baner_3->EditAttrs["class"] = "form-control";
        $this->baner_3->EditCustomAttributes = "";
        if (!$this->baner_3->Raw) {
            $this->baner_3->CurrentValue = HtmlDecode($this->baner_3->CurrentValue);
        }
        $this->baner_3->EditValue = $this->baner_3->CurrentValue;
        $this->baner_3->PlaceHolder = RemoveHtml($this->baner_3->caption());

        // baner_4
        $this->baner_4->EditAttrs["class"] = "form-control";
        $this->baner_4->EditCustomAttributes = "";
        if (!$this->baner_4->Raw) {
            $this->baner_4->CurrentValue = HtmlDecode($this->baner_4->CurrentValue);
        }
        $this->baner_4->EditValue = $this->baner_4->CurrentValue;
        $this->baner_4->PlaceHolder = RemoveHtml($this->baner_4->caption());

        // baner_5
        $this->baner_5->EditAttrs["class"] = "form-control";
        $this->baner_5->EditCustomAttributes = "";
        if (!$this->baner_5->Raw) {
            $this->baner_5->CurrentValue = HtmlDecode($this->baner_5->CurrentValue);
        }
        $this->baner_5->EditValue = $this->baner_5->CurrentValue;
        $this->baner_5->PlaceHolder = RemoveHtml($this->baner_5->caption());

        // baner_6
        $this->baner_6->EditAttrs["class"] = "form-control";
        $this->baner_6->EditCustomAttributes = "";
        if (!$this->baner_6->Raw) {
            $this->baner_6->CurrentValue = HtmlDecode($this->baner_6->CurrentValue);
        }
        $this->baner_6->EditValue = $this->baner_6->CurrentValue;
        $this->baner_6->PlaceHolder = RemoveHtml($this->baner_6->caption());

        // judul_baner_1
        $this->judul_baner_1->EditAttrs["class"] = "form-control";
        $this->judul_baner_1->EditCustomAttributes = "";
        if (!$this->judul_baner_1->Raw) {
            $this->judul_baner_1->CurrentValue = HtmlDecode($this->judul_baner_1->CurrentValue);
        }
        $this->judul_baner_1->EditValue = $this->judul_baner_1->CurrentValue;
        $this->judul_baner_1->PlaceHolder = RemoveHtml($this->judul_baner_1->caption());

        // judul_baner_2
        $this->judul_baner_2->EditAttrs["class"] = "form-control";
        $this->judul_baner_2->EditCustomAttributes = "";
        if (!$this->judul_baner_2->Raw) {
            $this->judul_baner_2->CurrentValue = HtmlDecode($this->judul_baner_2->CurrentValue);
        }
        $this->judul_baner_2->EditValue = $this->judul_baner_2->CurrentValue;
        $this->judul_baner_2->PlaceHolder = RemoveHtml($this->judul_baner_2->caption());

        // judul_baner_3
        $this->judul_baner_3->EditAttrs["class"] = "form-control";
        $this->judul_baner_3->EditCustomAttributes = "";
        if (!$this->judul_baner_3->Raw) {
            $this->judul_baner_3->CurrentValue = HtmlDecode($this->judul_baner_3->CurrentValue);
        }
        $this->judul_baner_3->EditValue = $this->judul_baner_3->CurrentValue;
        $this->judul_baner_3->PlaceHolder = RemoveHtml($this->judul_baner_3->caption());

        // judul_baner_4
        $this->judul_baner_4->EditAttrs["class"] = "form-control";
        $this->judul_baner_4->EditCustomAttributes = "";
        if (!$this->judul_baner_4->Raw) {
            $this->judul_baner_4->CurrentValue = HtmlDecode($this->judul_baner_4->CurrentValue);
        }
        $this->judul_baner_4->EditValue = $this->judul_baner_4->CurrentValue;
        $this->judul_baner_4->PlaceHolder = RemoveHtml($this->judul_baner_4->caption());

        // judul_baner_5
        $this->judul_baner_5->EditAttrs["class"] = "form-control";
        $this->judul_baner_5->EditCustomAttributes = "";
        if (!$this->judul_baner_5->Raw) {
            $this->judul_baner_5->CurrentValue = HtmlDecode($this->judul_baner_5->CurrentValue);
        }
        $this->judul_baner_5->EditValue = $this->judul_baner_5->CurrentValue;
        $this->judul_baner_5->PlaceHolder = RemoveHtml($this->judul_baner_5->caption());

        // judul_baner_6
        $this->judul_baner_6->EditAttrs["class"] = "form-control";
        $this->judul_baner_6->EditCustomAttributes = "";
        if (!$this->judul_baner_6->Raw) {
            $this->judul_baner_6->CurrentValue = HtmlDecode($this->judul_baner_6->CurrentValue);
        }
        $this->judul_baner_6->EditValue = $this->judul_baner_6->CurrentValue;
        $this->judul_baner_6->PlaceHolder = RemoveHtml($this->judul_baner_6->caption());

        // text_baner_1
        $this->text_baner_1->EditAttrs["class"] = "form-control";
        $this->text_baner_1->EditCustomAttributes = "";
        if (!$this->text_baner_1->Raw) {
            $this->text_baner_1->CurrentValue = HtmlDecode($this->text_baner_1->CurrentValue);
        }
        $this->text_baner_1->EditValue = $this->text_baner_1->CurrentValue;
        $this->text_baner_1->PlaceHolder = RemoveHtml($this->text_baner_1->caption());

        // text_baner_2
        $this->text_baner_2->EditAttrs["class"] = "form-control";
        $this->text_baner_2->EditCustomAttributes = "";
        if (!$this->text_baner_2->Raw) {
            $this->text_baner_2->CurrentValue = HtmlDecode($this->text_baner_2->CurrentValue);
        }
        $this->text_baner_2->EditValue = $this->text_baner_2->CurrentValue;
        $this->text_baner_2->PlaceHolder = RemoveHtml($this->text_baner_2->caption());

        // text_baner_3
        $this->text_baner_3->EditAttrs["class"] = "form-control";
        $this->text_baner_3->EditCustomAttributes = "";
        if (!$this->text_baner_3->Raw) {
            $this->text_baner_3->CurrentValue = HtmlDecode($this->text_baner_3->CurrentValue);
        }
        $this->text_baner_3->EditValue = $this->text_baner_3->CurrentValue;
        $this->text_baner_3->PlaceHolder = RemoveHtml($this->text_baner_3->caption());

        // text_baner_4
        $this->text_baner_4->EditAttrs["class"] = "form-control";
        $this->text_baner_4->EditCustomAttributes = "";
        if (!$this->text_baner_4->Raw) {
            $this->text_baner_4->CurrentValue = HtmlDecode($this->text_baner_4->CurrentValue);
        }
        $this->text_baner_4->EditValue = $this->text_baner_4->CurrentValue;
        $this->text_baner_4->PlaceHolder = RemoveHtml($this->text_baner_4->caption());

        // text_baner_5
        $this->text_baner_5->EditAttrs["class"] = "form-control";
        $this->text_baner_5->EditCustomAttributes = "";
        if (!$this->text_baner_5->Raw) {
            $this->text_baner_5->CurrentValue = HtmlDecode($this->text_baner_5->CurrentValue);
        }
        $this->text_baner_5->EditValue = $this->text_baner_5->CurrentValue;
        $this->text_baner_5->PlaceHolder = RemoveHtml($this->text_baner_5->caption());

        // text_baner_6
        $this->text_baner_6->EditAttrs["class"] = "form-control";
        $this->text_baner_6->EditCustomAttributes = "";
        if (!$this->text_baner_6->Raw) {
            $this->text_baner_6->CurrentValue = HtmlDecode($this->text_baner_6->CurrentValue);
        }
        $this->text_baner_6->EditValue = $this->text_baner_6->CurrentValue;
        $this->text_baner_6->PlaceHolder = RemoveHtml($this->text_baner_6->caption());

        // alamat_dinas
        $this->alamat_dinas->EditAttrs["class"] = "form-control";
        $this->alamat_dinas->EditCustomAttributes = "";
        if (!$this->alamat_dinas->Raw) {
            $this->alamat_dinas->CurrentValue = HtmlDecode($this->alamat_dinas->CurrentValue);
        }
        $this->alamat_dinas->EditValue = $this->alamat_dinas->CurrentValue;
        $this->alamat_dinas->PlaceHolder = RemoveHtml($this->alamat_dinas->caption());

        // instagram
        $this->instagram->EditAttrs["class"] = "form-control";
        $this->instagram->EditCustomAttributes = "";
        if (!$this->instagram->Raw) {
            $this->instagram->CurrentValue = HtmlDecode($this->instagram->CurrentValue);
        }
        $this->instagram->EditValue = $this->instagram->CurrentValue;
        $this->instagram->PlaceHolder = RemoveHtml($this->instagram->caption());

        // facebook
        $this->facebook->EditAttrs["class"] = "form-control";
        $this->facebook->EditCustomAttributes = "";
        if (!$this->facebook->Raw) {
            $this->facebook->CurrentValue = HtmlDecode($this->facebook->CurrentValue);
        }
        $this->facebook->EditValue = $this->facebook->CurrentValue;
        $this->facebook->PlaceHolder = RemoveHtml($this->facebook->caption());

        // no_wa
        $this->no_wa->EditAttrs["class"] = "form-control";
        $this->no_wa->EditCustomAttributes = "";
        if (!$this->no_wa->Raw) {
            $this->no_wa->CurrentValue = HtmlDecode($this->no_wa->CurrentValue);
        }
        $this->no_wa->EditValue = $this->no_wa->CurrentValue;
        $this->no_wa->PlaceHolder = RemoveHtml($this->no_wa->caption());

        // tentang_sidakui
        $this->tentang_sidakui->EditAttrs["class"] = "form-control";
        $this->tentang_sidakui->EditCustomAttributes = "";
        $this->tentang_sidakui->EditValue = $this->tentang_sidakui->CurrentValue;
        $this->tentang_sidakui->PlaceHolder = RemoveHtml($this->tentang_sidakui->caption());

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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->baner_1);
                    $doc->exportCaption($this->baner_2);
                    $doc->exportCaption($this->baner_3);
                    $doc->exportCaption($this->baner_4);
                    $doc->exportCaption($this->baner_5);
                    $doc->exportCaption($this->baner_6);
                    $doc->exportCaption($this->judul_baner_1);
                    $doc->exportCaption($this->judul_baner_2);
                    $doc->exportCaption($this->judul_baner_3);
                    $doc->exportCaption($this->judul_baner_4);
                    $doc->exportCaption($this->judul_baner_5);
                    $doc->exportCaption($this->judul_baner_6);
                    $doc->exportCaption($this->text_baner_1);
                    $doc->exportCaption($this->text_baner_2);
                    $doc->exportCaption($this->text_baner_3);
                    $doc->exportCaption($this->text_baner_4);
                    $doc->exportCaption($this->text_baner_5);
                    $doc->exportCaption($this->text_baner_6);
                    $doc->exportCaption($this->alamat_dinas);
                    $doc->exportCaption($this->instagram);
                    $doc->exportCaption($this->facebook);
                    $doc->exportCaption($this->no_wa);
                    $doc->exportCaption($this->tentang_sidakui);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->baner_1);
                    $doc->exportCaption($this->baner_2);
                    $doc->exportCaption($this->baner_3);
                    $doc->exportCaption($this->baner_4);
                    $doc->exportCaption($this->baner_5);
                    $doc->exportCaption($this->baner_6);
                    $doc->exportCaption($this->judul_baner_1);
                    $doc->exportCaption($this->judul_baner_2);
                    $doc->exportCaption($this->judul_baner_3);
                    $doc->exportCaption($this->judul_baner_4);
                    $doc->exportCaption($this->judul_baner_5);
                    $doc->exportCaption($this->judul_baner_6);
                    $doc->exportCaption($this->text_baner_1);
                    $doc->exportCaption($this->text_baner_2);
                    $doc->exportCaption($this->text_baner_3);
                    $doc->exportCaption($this->text_baner_4);
                    $doc->exportCaption($this->text_baner_5);
                    $doc->exportCaption($this->text_baner_6);
                    $doc->exportCaption($this->alamat_dinas);
                    $doc->exportCaption($this->instagram);
                    $doc->exportCaption($this->facebook);
                    $doc->exportCaption($this->no_wa);
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
                        $doc->exportField($this->id);
                        $doc->exportField($this->baner_1);
                        $doc->exportField($this->baner_2);
                        $doc->exportField($this->baner_3);
                        $doc->exportField($this->baner_4);
                        $doc->exportField($this->baner_5);
                        $doc->exportField($this->baner_6);
                        $doc->exportField($this->judul_baner_1);
                        $doc->exportField($this->judul_baner_2);
                        $doc->exportField($this->judul_baner_3);
                        $doc->exportField($this->judul_baner_4);
                        $doc->exportField($this->judul_baner_5);
                        $doc->exportField($this->judul_baner_6);
                        $doc->exportField($this->text_baner_1);
                        $doc->exportField($this->text_baner_2);
                        $doc->exportField($this->text_baner_3);
                        $doc->exportField($this->text_baner_4);
                        $doc->exportField($this->text_baner_5);
                        $doc->exportField($this->text_baner_6);
                        $doc->exportField($this->alamat_dinas);
                        $doc->exportField($this->instagram);
                        $doc->exportField($this->facebook);
                        $doc->exportField($this->no_wa);
                        $doc->exportField($this->tentang_sidakui);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->baner_1);
                        $doc->exportField($this->baner_2);
                        $doc->exportField($this->baner_3);
                        $doc->exportField($this->baner_4);
                        $doc->exportField($this->baner_5);
                        $doc->exportField($this->baner_6);
                        $doc->exportField($this->judul_baner_1);
                        $doc->exportField($this->judul_baner_2);
                        $doc->exportField($this->judul_baner_3);
                        $doc->exportField($this->judul_baner_4);
                        $doc->exportField($this->judul_baner_5);
                        $doc->exportField($this->judul_baner_6);
                        $doc->exportField($this->text_baner_1);
                        $doc->exportField($this->text_baner_2);
                        $doc->exportField($this->text_baner_3);
                        $doc->exportField($this->text_baner_4);
                        $doc->exportField($this->text_baner_5);
                        $doc->exportField($this->text_baner_6);
                        $doc->exportField($this->alamat_dinas);
                        $doc->exportField($this->instagram);
                        $doc->exportField($this->facebook);
                        $doc->exportField($this->no_wa);
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
