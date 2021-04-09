<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for umkm_aspekpemasaran
 */
class UmkmAspekpemasaran extends DbTable
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
    public $MK_KEUNGGULANPRODUK;
    public $MK_TARGETPASAR;
    public $MK_KETERSEDIAAN;
    public $MK_LOGO;
    public $MK_HKI;
    public $MK_BRANDING;
    public $MK_COBRANDING;
    public $MK_MEDIAOFFLINE;
    public $MK_RESELLER;
    public $MK_PASAR;
    public $MK_PELANGGAN;
    public $MK_PAMERANMANDIRI;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'umkm_aspekpemasaran';
        $this->TableName = 'umkm_aspekpemasaran';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`umkm_aspekpemasaran`";
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
        $this->NIK = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // MK_KEUNGGULANPRODUK
        $this->MK_KEUNGGULANPRODUK = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_KEUNGGULANPRODUK', 'MK_KEUNGGULANPRODUK', '`MK_KEUNGGULANPRODUK`', '`MK_KEUNGGULANPRODUK`', 200, 50, -1, false, '`MK_KEUNGGULANPRODUK`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_KEUNGGULANPRODUK->Sortable = true; // Allow sort
        $this->MK_KEUNGGULANPRODUK->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_KEUNGGULANPRODUK->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_KEUNGGULANPRODUK->Lookup = new Lookup('MK_KEUNGGULANPRODUK', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_KEUNGGULANPRODUK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_KEUNGGULANPRODUK->Param, "CustomMsg");
        $this->Fields['MK_KEUNGGULANPRODUK'] = &$this->MK_KEUNGGULANPRODUK;

        // MK_TARGETPASAR
        $this->MK_TARGETPASAR = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_TARGETPASAR', 'MK_TARGETPASAR', '`MK_TARGETPASAR`', '`MK_TARGETPASAR`', 200, 50, -1, false, '`MK_TARGETPASAR`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_TARGETPASAR->Sortable = true; // Allow sort
        $this->MK_TARGETPASAR->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_TARGETPASAR->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_TARGETPASAR->Lookup = new Lookup('MK_TARGETPASAR', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_TARGETPASAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_TARGETPASAR->Param, "CustomMsg");
        $this->Fields['MK_TARGETPASAR'] = &$this->MK_TARGETPASAR;

        // MK_KETERSEDIAAN
        $this->MK_KETERSEDIAAN = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_KETERSEDIAAN', 'MK_KETERSEDIAAN', '`MK_KETERSEDIAAN`', '`MK_KETERSEDIAAN`', 200, 50, -1, false, '`MK_KETERSEDIAAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_KETERSEDIAAN->Sortable = true; // Allow sort
        $this->MK_KETERSEDIAAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_KETERSEDIAAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_KETERSEDIAAN->Lookup = new Lookup('MK_KETERSEDIAAN', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_KETERSEDIAAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_KETERSEDIAAN->Param, "CustomMsg");
        $this->Fields['MK_KETERSEDIAAN'] = &$this->MK_KETERSEDIAAN;

        // MK_LOGO
        $this->MK_LOGO = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_LOGO', 'MK_LOGO', '`MK_LOGO`', '`MK_LOGO`', 200, 50, -1, false, '`MK_LOGO`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_LOGO->Sortable = true; // Allow sort
        $this->MK_LOGO->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_LOGO->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_LOGO->Lookup = new Lookup('MK_LOGO', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_LOGO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_LOGO->Param, "CustomMsg");
        $this->Fields['MK_LOGO'] = &$this->MK_LOGO;

        // MK_HKI
        $this->MK_HKI = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_HKI', 'MK_HKI', '`MK_HKI`', '`MK_HKI`', 200, 50, -1, false, '`MK_HKI`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_HKI->Sortable = true; // Allow sort
        $this->MK_HKI->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_HKI->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_HKI->Lookup = new Lookup('MK_HKI', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_HKI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_HKI->Param, "CustomMsg");
        $this->Fields['MK_HKI'] = &$this->MK_HKI;

        // MK_BRANDING
        $this->MK_BRANDING = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_BRANDING', 'MK_BRANDING', '`MK_BRANDING`', '`MK_BRANDING`', 200, 50, -1, false, '`MK_BRANDING`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_BRANDING->Sortable = true; // Allow sort
        $this->MK_BRANDING->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_BRANDING->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_BRANDING->Lookup = new Lookup('MK_BRANDING', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_BRANDING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_BRANDING->Param, "CustomMsg");
        $this->Fields['MK_BRANDING'] = &$this->MK_BRANDING;

        // MK_COBRANDING
        $this->MK_COBRANDING = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_COBRANDING', 'MK_COBRANDING', '`MK_COBRANDING`', '`MK_COBRANDING`', 200, 50, -1, false, '`MK_COBRANDING`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_COBRANDING->Sortable = true; // Allow sort
        $this->MK_COBRANDING->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_COBRANDING->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_COBRANDING->Lookup = new Lookup('MK_COBRANDING', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_COBRANDING->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_COBRANDING->Param, "CustomMsg");
        $this->Fields['MK_COBRANDING'] = &$this->MK_COBRANDING;

        // MK_MEDIAOFFLINE
        $this->MK_MEDIAOFFLINE = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_MEDIAOFFLINE', 'MK_MEDIAOFFLINE', '`MK_MEDIAOFFLINE`', '`MK_MEDIAOFFLINE`', 200, 50, -1, false, '`MK_MEDIAOFFLINE`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_MEDIAOFFLINE->Sortable = true; // Allow sort
        $this->MK_MEDIAOFFLINE->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_MEDIAOFFLINE->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_MEDIAOFFLINE->Lookup = new Lookup('MK_MEDIAOFFLINE', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_MEDIAOFFLINE->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_MEDIAOFFLINE->Param, "CustomMsg");
        $this->Fields['MK_MEDIAOFFLINE'] = &$this->MK_MEDIAOFFLINE;

        // MK_RESELLER
        $this->MK_RESELLER = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_RESELLER', 'MK_RESELLER', '`MK_RESELLER`', '`MK_RESELLER`', 200, 50, -1, false, '`MK_RESELLER`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_RESELLER->Sortable = true; // Allow sort
        $this->MK_RESELLER->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_RESELLER->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_RESELLER->Lookup = new Lookup('MK_RESELLER', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_RESELLER->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_RESELLER->Param, "CustomMsg");
        $this->Fields['MK_RESELLER'] = &$this->MK_RESELLER;

        // MK_PASAR
        $this->MK_PASAR = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_PASAR', 'MK_PASAR', '`MK_PASAR`', '`MK_PASAR`', 200, 50, -1, false, '`MK_PASAR`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_PASAR->Sortable = true; // Allow sort
        $this->MK_PASAR->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_PASAR->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_PASAR->Lookup = new Lookup('MK_PASAR', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_PASAR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_PASAR->Param, "CustomMsg");
        $this->Fields['MK_PASAR'] = &$this->MK_PASAR;

        // MK_PELANGGAN
        $this->MK_PELANGGAN = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_PELANGGAN', 'MK_PELANGGAN', '`MK_PELANGGAN`', '`MK_PELANGGAN`', 200, 50, -1, false, '`MK_PELANGGAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_PELANGGAN->Sortable = true; // Allow sort
        $this->MK_PELANGGAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_PELANGGAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_PELANGGAN->Lookup = new Lookup('MK_PELANGGAN', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_PELANGGAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_PELANGGAN->Param, "CustomMsg");
        $this->Fields['MK_PELANGGAN'] = &$this->MK_PELANGGAN;

        // MK_PAMERANMANDIRI
        $this->MK_PAMERANMANDIRI = new DbField('umkm_aspekpemasaran', 'umkm_aspekpemasaran', 'x_MK_PAMERANMANDIRI', 'MK_PAMERANMANDIRI', '`MK_PAMERANMANDIRI`', '`MK_PAMERANMANDIRI`', 200, 50, -1, false, '`MK_PAMERANMANDIRI`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->MK_PAMERANMANDIRI->Sortable = true; // Allow sort
        $this->MK_PAMERANMANDIRI->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->MK_PAMERANMANDIRI->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->MK_PAMERANMANDIRI->Lookup = new Lookup('MK_PAMERANMANDIRI', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`id` ASC', '');
        $this->MK_PAMERANMANDIRI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MK_PAMERANMANDIRI->Param, "CustomMsg");
        $this->Fields['MK_PAMERANMANDIRI'] = &$this->MK_PAMERANMANDIRI;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`umkm_aspekpemasaran`";
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
        $this->MK_KEUNGGULANPRODUK->DbValue = $row['MK_KEUNGGULANPRODUK'];
        $this->MK_TARGETPASAR->DbValue = $row['MK_TARGETPASAR'];
        $this->MK_KETERSEDIAAN->DbValue = $row['MK_KETERSEDIAAN'];
        $this->MK_LOGO->DbValue = $row['MK_LOGO'];
        $this->MK_HKI->DbValue = $row['MK_HKI'];
        $this->MK_BRANDING->DbValue = $row['MK_BRANDING'];
        $this->MK_COBRANDING->DbValue = $row['MK_COBRANDING'];
        $this->MK_MEDIAOFFLINE->DbValue = $row['MK_MEDIAOFFLINE'];
        $this->MK_RESELLER->DbValue = $row['MK_RESELLER'];
        $this->MK_PASAR->DbValue = $row['MK_PASAR'];
        $this->MK_PELANGGAN->DbValue = $row['MK_PELANGGAN'];
        $this->MK_PAMERANMANDIRI->DbValue = $row['MK_PAMERANMANDIRI'];
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
        return $_SESSION[$name] ?? GetUrl("umkmaspekpemasaranlist");
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
        if ($pageName == "umkmaspekpemasaranview") {
            return $Language->phrase("View");
        } elseif ($pageName == "umkmaspekpemasaranedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "umkmaspekpemasaranadd") {
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
                return "UmkmAspekpemasaranView";
            case Config("API_ADD_ACTION"):
                return "UmkmAspekpemasaranAdd";
            case Config("API_EDIT_ACTION"):
                return "UmkmAspekpemasaranEdit";
            case Config("API_DELETE_ACTION"):
                return "UmkmAspekpemasaranDelete";
            case Config("API_LIST_ACTION"):
                return "UmkmAspekpemasaranList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "umkmaspekpemasaranlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmaspekpemasaranview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmaspekpemasaranview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "umkmaspekpemasaranadd?" . $this->getUrlParm($parm);
        } else {
            $url = "umkmaspekpemasaranadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("umkmaspekpemasaranedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("umkmaspekpemasaranadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("umkmaspekpemasarandelete", $this->getUrlParm());
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
        $this->MK_KEUNGGULANPRODUK->setDbValue($row['MK_KEUNGGULANPRODUK']);
        $this->MK_TARGETPASAR->setDbValue($row['MK_TARGETPASAR']);
        $this->MK_KETERSEDIAAN->setDbValue($row['MK_KETERSEDIAAN']);
        $this->MK_LOGO->setDbValue($row['MK_LOGO']);
        $this->MK_HKI->setDbValue($row['MK_HKI']);
        $this->MK_BRANDING->setDbValue($row['MK_BRANDING']);
        $this->MK_COBRANDING->setDbValue($row['MK_COBRANDING']);
        $this->MK_MEDIAOFFLINE->setDbValue($row['MK_MEDIAOFFLINE']);
        $this->MK_RESELLER->setDbValue($row['MK_RESELLER']);
        $this->MK_PASAR->setDbValue($row['MK_PASAR']);
        $this->MK_PELANGGAN->setDbValue($row['MK_PELANGGAN']);
        $this->MK_PAMERANMANDIRI->setDbValue($row['MK_PAMERANMANDIRI']);
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

        // MK_KEUNGGULANPRODUK

        // MK_TARGETPASAR

        // MK_KETERSEDIAAN

        // MK_LOGO

        // MK_HKI

        // MK_BRANDING

        // MK_COBRANDING

        // MK_MEDIAOFFLINE

        // MK_RESELLER

        // MK_PASAR

        // MK_PELANGGAN

        // MK_PAMERANMANDIRI

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // MK_KEUNGGULANPRODUK
        $curVal = strval($this->MK_KEUNGGULANPRODUK->CurrentValue);
        if ($curVal != "") {
            $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->lookupCacheOption($curVal);
            if ($this->MK_KEUNGGULANPRODUK->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Kekuatan Produk'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_KEUNGGULANPRODUK->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_KEUNGGULANPRODUK->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->displayValue($arwrk);
                } else {
                    $this->MK_KEUNGGULANPRODUK->ViewValue = $this->MK_KEUNGGULANPRODUK->CurrentValue;
                }
            }
        } else {
            $this->MK_KEUNGGULANPRODUK->ViewValue = null;
        }
        $this->MK_KEUNGGULANPRODUK->ViewCustomAttributes = "";

        // MK_TARGETPASAR
        $curVal = strval($this->MK_TARGETPASAR->CurrentValue);
        if ($curVal != "") {
            $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->lookupCacheOption($curVal);
            if ($this->MK_TARGETPASAR->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Target Pasar'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_TARGETPASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_TARGETPASAR->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->displayValue($arwrk);
                } else {
                    $this->MK_TARGETPASAR->ViewValue = $this->MK_TARGETPASAR->CurrentValue;
                }
            }
        } else {
            $this->MK_TARGETPASAR->ViewValue = null;
        }
        $this->MK_TARGETPASAR->ViewCustomAttributes = "";

        // MK_KETERSEDIAAN
        $curVal = strval($this->MK_KETERSEDIAAN->CurrentValue);
        if ($curVal != "") {
            $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->lookupCacheOption($curVal);
            if ($this->MK_KETERSEDIAAN->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Mudah Didapatkan'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_KETERSEDIAAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_KETERSEDIAAN->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->displayValue($arwrk);
                } else {
                    $this->MK_KETERSEDIAAN->ViewValue = $this->MK_KETERSEDIAAN->CurrentValue;
                }
            }
        } else {
            $this->MK_KETERSEDIAAN->ViewValue = null;
        }
        $this->MK_KETERSEDIAAN->ViewCustomAttributes = "";

        // MK_LOGO
        $curVal = strval($this->MK_LOGO->CurrentValue);
        if ($curVal != "") {
            $this->MK_LOGO->ViewValue = $this->MK_LOGO->lookupCacheOption($curVal);
            if ($this->MK_LOGO->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Logo Dagang'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_LOGO->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_LOGO->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_LOGO->ViewValue = $this->MK_LOGO->displayValue($arwrk);
                } else {
                    $this->MK_LOGO->ViewValue = $this->MK_LOGO->CurrentValue;
                }
            }
        } else {
            $this->MK_LOGO->ViewValue = null;
        }
        $this->MK_LOGO->ViewCustomAttributes = "";

        // MK_HKI
        $curVal = strval($this->MK_HKI->CurrentValue);
        if ($curVal != "") {
            $this->MK_HKI->ViewValue = $this->MK_HKI->lookupCacheOption($curVal);
            if ($this->MK_HKI->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='HKI'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_HKI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_HKI->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_HKI->ViewValue = $this->MK_HKI->displayValue($arwrk);
                } else {
                    $this->MK_HKI->ViewValue = $this->MK_HKI->CurrentValue;
                }
            }
        } else {
            $this->MK_HKI->ViewValue = null;
        }
        $this->MK_HKI->ViewCustomAttributes = "";

        // MK_BRANDING
        $curVal = strval($this->MK_BRANDING->CurrentValue);
        if ($curVal != "") {
            $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->lookupCacheOption($curVal);
            if ($this->MK_BRANDING->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Konsep Branding'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_BRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_BRANDING->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->displayValue($arwrk);
                } else {
                    $this->MK_BRANDING->ViewValue = $this->MK_BRANDING->CurrentValue;
                }
            }
        } else {
            $this->MK_BRANDING->ViewValue = null;
        }
        $this->MK_BRANDING->ViewCustomAttributes = "";

        // MK_COBRANDING
        $curVal = strval($this->MK_COBRANDING->CurrentValue);
        if ($curVal != "") {
            $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->lookupCacheOption($curVal);
            if ($this->MK_COBRANDING->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Jogjamark'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_COBRANDING->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_COBRANDING->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->displayValue($arwrk);
                } else {
                    $this->MK_COBRANDING->ViewValue = $this->MK_COBRANDING->CurrentValue;
                }
            }
        } else {
            $this->MK_COBRANDING->ViewValue = null;
        }
        $this->MK_COBRANDING->ViewCustomAttributes = "";

        // MK_MEDIAOFFLINE
        $curVal = strval($this->MK_MEDIAOFFLINE->CurrentValue);
        if ($curVal != "") {
            $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->lookupCacheOption($curVal);
            if ($this->MK_MEDIAOFFLINE->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Offline'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_MEDIAOFFLINE->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_MEDIAOFFLINE->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->displayValue($arwrk);
                } else {
                    $this->MK_MEDIAOFFLINE->ViewValue = $this->MK_MEDIAOFFLINE->CurrentValue;
                }
            }
        } else {
            $this->MK_MEDIAOFFLINE->ViewValue = null;
        }
        $this->MK_MEDIAOFFLINE->ViewCustomAttributes = "";

        // MK_RESELLER
        $curVal = strval($this->MK_RESELLER->CurrentValue);
        if ($curVal != "") {
            $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->lookupCacheOption($curVal);
            if ($this->MK_RESELLER->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Mitra'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_RESELLER->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_RESELLER->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->displayValue($arwrk);
                } else {
                    $this->MK_RESELLER->ViewValue = $this->MK_RESELLER->CurrentValue;
                }
            }
        } else {
            $this->MK_RESELLER->ViewValue = null;
        }
        $this->MK_RESELLER->ViewCustomAttributes = "";

        // MK_PASAR
        $curVal = strval($this->MK_PASAR->CurrentValue);
        if ($curVal != "") {
            $this->MK_PASAR->ViewValue = $this->MK_PASAR->lookupCacheOption($curVal);
            if ($this->MK_PASAR->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Pemasaran'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PASAR->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_PASAR->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_PASAR->ViewValue = $this->MK_PASAR->displayValue($arwrk);
                } else {
                    $this->MK_PASAR->ViewValue = $this->MK_PASAR->CurrentValue;
                }
            }
        } else {
            $this->MK_PASAR->ViewValue = null;
        }
        $this->MK_PASAR->ViewCustomAttributes = "";

        // MK_PELANGGAN
        $curVal = strval($this->MK_PELANGGAN->CurrentValue);
        if ($curVal != "") {
            $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->lookupCacheOption($curVal);
            if ($this->MK_PELANGGAN->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Pelanggan Tetap'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PELANGGAN->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_PELANGGAN->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->displayValue($arwrk);
                } else {
                    $this->MK_PELANGGAN->ViewValue = $this->MK_PELANGGAN->CurrentValue;
                }
            }
        } else {
            $this->MK_PELANGGAN->ViewValue = null;
        }
        $this->MK_PELANGGAN->ViewCustomAttributes = "";

        // MK_PAMERANMANDIRI
        $curVal = strval($this->MK_PAMERANMANDIRI->CurrentValue);
        if ($curVal != "") {
            $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->lookupCacheOption($curVal);
            if ($this->MK_PAMERANMANDIRI->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='Pameran Mandiri'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->MK_PAMERANMANDIRI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->MK_PAMERANMANDIRI->Lookup->renderViewRow($rswrk[0]);
                    $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->displayValue($arwrk);
                } else {
                    $this->MK_PAMERANMANDIRI->ViewValue = $this->MK_PAMERANMANDIRI->CurrentValue;
                }
            }
        } else {
            $this->MK_PAMERANMANDIRI->ViewValue = null;
        }
        $this->MK_PAMERANMANDIRI->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // MK_KEUNGGULANPRODUK
        $this->MK_KEUNGGULANPRODUK->LinkCustomAttributes = "";
        $this->MK_KEUNGGULANPRODUK->HrefValue = "";
        $this->MK_KEUNGGULANPRODUK->TooltipValue = "";

        // MK_TARGETPASAR
        $this->MK_TARGETPASAR->LinkCustomAttributes = "";
        $this->MK_TARGETPASAR->HrefValue = "";
        $this->MK_TARGETPASAR->TooltipValue = "";

        // MK_KETERSEDIAAN
        $this->MK_KETERSEDIAAN->LinkCustomAttributes = "";
        $this->MK_KETERSEDIAAN->HrefValue = "";
        $this->MK_KETERSEDIAAN->TooltipValue = "";

        // MK_LOGO
        $this->MK_LOGO->LinkCustomAttributes = "";
        $this->MK_LOGO->HrefValue = "";
        $this->MK_LOGO->TooltipValue = "";

        // MK_HKI
        $this->MK_HKI->LinkCustomAttributes = "";
        $this->MK_HKI->HrefValue = "";
        $this->MK_HKI->TooltipValue = "";

        // MK_BRANDING
        $this->MK_BRANDING->LinkCustomAttributes = "";
        $this->MK_BRANDING->HrefValue = "";
        $this->MK_BRANDING->TooltipValue = "";

        // MK_COBRANDING
        $this->MK_COBRANDING->LinkCustomAttributes = "";
        $this->MK_COBRANDING->HrefValue = "";
        $this->MK_COBRANDING->TooltipValue = "";

        // MK_MEDIAOFFLINE
        $this->MK_MEDIAOFFLINE->LinkCustomAttributes = "";
        $this->MK_MEDIAOFFLINE->HrefValue = "";
        $this->MK_MEDIAOFFLINE->TooltipValue = "";

        // MK_RESELLER
        $this->MK_RESELLER->LinkCustomAttributes = "";
        $this->MK_RESELLER->HrefValue = "";
        $this->MK_RESELLER->TooltipValue = "";

        // MK_PASAR
        $this->MK_PASAR->LinkCustomAttributes = "";
        $this->MK_PASAR->HrefValue = "";
        $this->MK_PASAR->TooltipValue = "";

        // MK_PELANGGAN
        $this->MK_PELANGGAN->LinkCustomAttributes = "";
        $this->MK_PELANGGAN->HrefValue = "";
        $this->MK_PELANGGAN->TooltipValue = "";

        // MK_PAMERANMANDIRI
        $this->MK_PAMERANMANDIRI->LinkCustomAttributes = "";
        $this->MK_PAMERANMANDIRI->HrefValue = "";
        $this->MK_PAMERANMANDIRI->TooltipValue = "";

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

        // MK_KEUNGGULANPRODUK
        $this->MK_KEUNGGULANPRODUK->EditAttrs["class"] = "form-control";
        $this->MK_KEUNGGULANPRODUK->EditCustomAttributes = "";
        $this->MK_KEUNGGULANPRODUK->PlaceHolder = RemoveHtml($this->MK_KEUNGGULANPRODUK->caption());

        // MK_TARGETPASAR
        $this->MK_TARGETPASAR->EditAttrs["class"] = "form-control";
        $this->MK_TARGETPASAR->EditCustomAttributes = "";
        $this->MK_TARGETPASAR->PlaceHolder = RemoveHtml($this->MK_TARGETPASAR->caption());

        // MK_KETERSEDIAAN
        $this->MK_KETERSEDIAAN->EditAttrs["class"] = "form-control";
        $this->MK_KETERSEDIAAN->EditCustomAttributes = "";
        $this->MK_KETERSEDIAAN->PlaceHolder = RemoveHtml($this->MK_KETERSEDIAAN->caption());

        // MK_LOGO
        $this->MK_LOGO->EditAttrs["class"] = "form-control";
        $this->MK_LOGO->EditCustomAttributes = "";
        $this->MK_LOGO->PlaceHolder = RemoveHtml($this->MK_LOGO->caption());

        // MK_HKI
        $this->MK_HKI->EditAttrs["class"] = "form-control";
        $this->MK_HKI->EditCustomAttributes = "";
        $this->MK_HKI->PlaceHolder = RemoveHtml($this->MK_HKI->caption());

        // MK_BRANDING
        $this->MK_BRANDING->EditAttrs["class"] = "form-control";
        $this->MK_BRANDING->EditCustomAttributes = "";
        $this->MK_BRANDING->PlaceHolder = RemoveHtml($this->MK_BRANDING->caption());

        // MK_COBRANDING
        $this->MK_COBRANDING->EditAttrs["class"] = "form-control";
        $this->MK_COBRANDING->EditCustomAttributes = "";
        $this->MK_COBRANDING->PlaceHolder = RemoveHtml($this->MK_COBRANDING->caption());

        // MK_MEDIAOFFLINE
        $this->MK_MEDIAOFFLINE->EditAttrs["class"] = "form-control";
        $this->MK_MEDIAOFFLINE->EditCustomAttributes = "";
        $this->MK_MEDIAOFFLINE->PlaceHolder = RemoveHtml($this->MK_MEDIAOFFLINE->caption());

        // MK_RESELLER
        $this->MK_RESELLER->EditAttrs["class"] = "form-control";
        $this->MK_RESELLER->EditCustomAttributes = "";
        $this->MK_RESELLER->PlaceHolder = RemoveHtml($this->MK_RESELLER->caption());

        // MK_PASAR
        $this->MK_PASAR->EditAttrs["class"] = "form-control";
        $this->MK_PASAR->EditCustomAttributes = "";
        $this->MK_PASAR->PlaceHolder = RemoveHtml($this->MK_PASAR->caption());

        // MK_PELANGGAN
        $this->MK_PELANGGAN->EditAttrs["class"] = "form-control";
        $this->MK_PELANGGAN->EditCustomAttributes = "";
        $this->MK_PELANGGAN->PlaceHolder = RemoveHtml($this->MK_PELANGGAN->caption());

        // MK_PAMERANMANDIRI
        $this->MK_PAMERANMANDIRI->EditAttrs["class"] = "form-control";
        $this->MK_PAMERANMANDIRI->EditCustomAttributes = "";
        $this->MK_PAMERANMANDIRI->PlaceHolder = RemoveHtml($this->MK_PAMERANMANDIRI->caption());

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
                    $doc->exportCaption($this->MK_KEUNGGULANPRODUK);
                    $doc->exportCaption($this->MK_TARGETPASAR);
                    $doc->exportCaption($this->MK_KETERSEDIAAN);
                    $doc->exportCaption($this->MK_LOGO);
                    $doc->exportCaption($this->MK_HKI);
                    $doc->exportCaption($this->MK_BRANDING);
                    $doc->exportCaption($this->MK_COBRANDING);
                    $doc->exportCaption($this->MK_MEDIAOFFLINE);
                    $doc->exportCaption($this->MK_RESELLER);
                    $doc->exportCaption($this->MK_PASAR);
                    $doc->exportCaption($this->MK_PELANGGAN);
                    $doc->exportCaption($this->MK_PAMERANMANDIRI);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->MK_KEUNGGULANPRODUK);
                    $doc->exportCaption($this->MK_TARGETPASAR);
                    $doc->exportCaption($this->MK_KETERSEDIAAN);
                    $doc->exportCaption($this->MK_LOGO);
                    $doc->exportCaption($this->MK_HKI);
                    $doc->exportCaption($this->MK_BRANDING);
                    $doc->exportCaption($this->MK_COBRANDING);
                    $doc->exportCaption($this->MK_MEDIAOFFLINE);
                    $doc->exportCaption($this->MK_RESELLER);
                    $doc->exportCaption($this->MK_PASAR);
                    $doc->exportCaption($this->MK_PELANGGAN);
                    $doc->exportCaption($this->MK_PAMERANMANDIRI);
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
                        $doc->exportField($this->MK_KEUNGGULANPRODUK);
                        $doc->exportField($this->MK_TARGETPASAR);
                        $doc->exportField($this->MK_KETERSEDIAAN);
                        $doc->exportField($this->MK_LOGO);
                        $doc->exportField($this->MK_HKI);
                        $doc->exportField($this->MK_BRANDING);
                        $doc->exportField($this->MK_COBRANDING);
                        $doc->exportField($this->MK_MEDIAOFFLINE);
                        $doc->exportField($this->MK_RESELLER);
                        $doc->exportField($this->MK_PASAR);
                        $doc->exportField($this->MK_PELANGGAN);
                        $doc->exportField($this->MK_PAMERANMANDIRI);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->MK_KEUNGGULANPRODUK);
                        $doc->exportField($this->MK_TARGETPASAR);
                        $doc->exportField($this->MK_KETERSEDIAAN);
                        $doc->exportField($this->MK_LOGO);
                        $doc->exportField($this->MK_HKI);
                        $doc->exportField($this->MK_BRANDING);
                        $doc->exportField($this->MK_COBRANDING);
                        $doc->exportField($this->MK_MEDIAOFFLINE);
                        $doc->exportField($this->MK_RESELLER);
                        $doc->exportField($this->MK_PASAR);
                        $doc->exportField($this->MK_PELANGGAN);
                        $doc->exportField($this->MK_PAMERANMANDIRI);
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
