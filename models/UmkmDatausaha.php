<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for umkm_datausaha
 */
class UmkmDatausaha extends DbTable
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
    public $NAMA_USAHA;
    public $TAHUN_MULAI_USAHA;
    public $NO_IZIN_USAHA;
    public $SEKTOR;
    public $SEKTOR_PERGUB;
    public $SEKTOR_KBLI;
    public $SEKTOR_EKRAF;
    public $KAPANEWON;
    public $KALURAHAN;
    public $DUSUN;
    public $ALAMAT;
    public $TENAGA_KERJA_LAKILAKI;
    public $TENAGA_KERJA_PEREMPUAN;
    public $MODAL_KERJA;
    public $OMZET_RATARATA_PERTAHUN;
    public $STATUS_USAHA;
    public $ASET;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'umkm_datausaha';
        $this->TableName = 'umkm_datausaha';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`umkm_datausaha`";
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
        $this->NIK = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->IsForeignKey = true; // Foreign key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // NAMA_USAHA
        $this->NAMA_USAHA = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_NAMA_USAHA', 'NAMA_USAHA', '`NAMA_USAHA`', '`NAMA_USAHA`', 200, 100, -1, false, '`NAMA_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_USAHA->Sortable = true; // Allow sort
        $this->NAMA_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_USAHA->Param, "CustomMsg");
        $this->Fields['NAMA_USAHA'] = &$this->NAMA_USAHA;

        // TAHUN_MULAI_USAHA
        $this->TAHUN_MULAI_USAHA = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_TAHUN_MULAI_USAHA', 'TAHUN_MULAI_USAHA', '`TAHUN_MULAI_USAHA`', '`TAHUN_MULAI_USAHA`', 200, 10, -1, false, '`TAHUN_MULAI_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TAHUN_MULAI_USAHA->Sortable = true; // Allow sort
        $this->TAHUN_MULAI_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TAHUN_MULAI_USAHA->Param, "CustomMsg");
        $this->Fields['TAHUN_MULAI_USAHA'] = &$this->TAHUN_MULAI_USAHA;

        // NO_IZIN_USAHA
        $this->NO_IZIN_USAHA = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_NO_IZIN_USAHA', 'NO_IZIN_USAHA', '`NO_IZIN_USAHA`', '`NO_IZIN_USAHA`', 200, 100, -1, false, '`NO_IZIN_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_IZIN_USAHA->Sortable = true; // Allow sort
        $this->NO_IZIN_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_IZIN_USAHA->Param, "CustomMsg");
        $this->Fields['NO_IZIN_USAHA'] = &$this->NO_IZIN_USAHA;

        // SEKTOR
        $this->SEKTOR = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_SEKTOR', 'SEKTOR', '`SEKTOR`', '`SEKTOR`', 200, 50, -1, false, '`SEKTOR`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SEKTOR->Sortable = true; // Allow sort
        $this->SEKTOR->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEKTOR->Param, "CustomMsg");
        $this->Fields['SEKTOR'] = &$this->SEKTOR;

        // SEKTOR_PERGUB
        $this->SEKTOR_PERGUB = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_SEKTOR_PERGUB', 'SEKTOR_PERGUB', '`SEKTOR_PERGUB`', '`SEKTOR_PERGUB`', 2, 6, -1, false, '`SEKTOR_PERGUB`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SEKTOR_PERGUB->Sortable = true; // Allow sort
        $this->SEKTOR_PERGUB->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SEKTOR_PERGUB->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SEKTOR_PERGUB->Lookup = new Lookup('SEKTOR_PERGUB', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`variabel`', '');
        $this->SEKTOR_PERGUB->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SEKTOR_PERGUB->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEKTOR_PERGUB->Param, "CustomMsg");
        $this->Fields['SEKTOR_PERGUB'] = &$this->SEKTOR_PERGUB;

        // SEKTOR_KBLI
        $this->SEKTOR_KBLI = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_SEKTOR_KBLI', 'SEKTOR_KBLI', '`SEKTOR_KBLI`', '`SEKTOR_KBLI`', 2, 6, -1, false, '`SEKTOR_KBLI`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SEKTOR_KBLI->Sortable = true; // Allow sort
        $this->SEKTOR_KBLI->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SEKTOR_KBLI->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SEKTOR_KBLI->Lookup = new Lookup('SEKTOR_KBLI', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`variabel`', '');
        $this->SEKTOR_KBLI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SEKTOR_KBLI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEKTOR_KBLI->Param, "CustomMsg");
        $this->Fields['SEKTOR_KBLI'] = &$this->SEKTOR_KBLI;

        // SEKTOR_EKRAF
        $this->SEKTOR_EKRAF = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_SEKTOR_EKRAF', 'SEKTOR_EKRAF', '`SEKTOR_EKRAF`', '`SEKTOR_EKRAF`', 2, 6, -1, false, '`SEKTOR_EKRAF`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->SEKTOR_EKRAF->Sortable = true; // Allow sort
        $this->SEKTOR_EKRAF->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->SEKTOR_EKRAF->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->SEKTOR_EKRAF->Lookup = new Lookup('SEKTOR_EKRAF', 'umkm_variabel', false, 'id', ["variabel","","",""], [], [], [], [], [], [], '`variabel`', '');
        $this->SEKTOR_EKRAF->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->SEKTOR_EKRAF->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SEKTOR_EKRAF->Param, "CustomMsg");
        $this->Fields['SEKTOR_EKRAF'] = &$this->SEKTOR_EKRAF;

        // KAPANEWON
        $this->KAPANEWON = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_KAPANEWON', 'KAPANEWON', '`KAPANEWON`', '`KAPANEWON`', 200, 50, -1, false, '`KAPANEWON`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KAPANEWON->Sortable = true; // Allow sort
        $this->KAPANEWON->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KAPANEWON->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KAPANEWON->Lookup = new Lookup('KAPANEWON', 'indonesia_districts', false, 'id', ["name","","",""], [], ["x_KALURAHAN"], [], [], [], [], '', '');
        $this->KAPANEWON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPANEWON->Param, "CustomMsg");
        $this->Fields['KAPANEWON'] = &$this->KAPANEWON;

        // KALURAHAN
        $this->KALURAHAN = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_KALURAHAN', 'KALURAHAN', '`KALURAHAN`', '`KALURAHAN`', 200, 50, -1, false, '`KALURAHAN`', false, false, false, 'FORMATTED TEXT', 'SELECT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->UsePleaseSelect = true; // Use PleaseSelect by default
        $this->KALURAHAN->PleaseSelectText = $Language->phrase("PleaseSelect"); // "PleaseSelect" text
        $this->KALURAHAN->Lookup = new Lookup('KALURAHAN', 'indonesia_villages', false, 'id', ["name","","",""], ["x_KAPANEWON"], [], ["district_id"], ["x_district_id"], [], [], '', '');
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // DUSUN
        $this->DUSUN = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_DUSUN', 'DUSUN', '`DUSUN`', '`DUSUN`', 200, 50, -1, false, '`DUSUN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DUSUN->Sortable = true; // Allow sort
        $this->DUSUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DUSUN->Param, "CustomMsg");
        $this->Fields['DUSUN'] = &$this->DUSUN;

        // ALAMAT
        $this->ALAMAT = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_ALAMAT', 'ALAMAT', '`ALAMAT`', '`ALAMAT`', 200, 255, -1, false, '`ALAMAT`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->ALAMAT->Sortable = true; // Allow sort
        $this->ALAMAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ALAMAT->Param, "CustomMsg");
        $this->Fields['ALAMAT'] = &$this->ALAMAT;

        // TENAGA_KERJA_LAKI-LAKI
        $this->TENAGA_KERJA_LAKILAKI = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_TENAGA_KERJA_LAKILAKI', 'TENAGA_KERJA_LAKI-LAKI', '`TENAGA_KERJA_LAKI-LAKI`', '`TENAGA_KERJA_LAKI-LAKI`', 16, 4, -1, false, '`TENAGA_KERJA_LAKI-LAKI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENAGA_KERJA_LAKILAKI->Sortable = true; // Allow sort
        $this->TENAGA_KERJA_LAKILAKI->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TENAGA_KERJA_LAKILAKI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENAGA_KERJA_LAKILAKI->Param, "CustomMsg");
        $this->Fields['TENAGA_KERJA_LAKI-LAKI'] = &$this->TENAGA_KERJA_LAKILAKI;

        // TENAGA_KERJA_PEREMPUAN
        $this->TENAGA_KERJA_PEREMPUAN = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_TENAGA_KERJA_PEREMPUAN', 'TENAGA_KERJA_PEREMPUAN', '`TENAGA_KERJA_PEREMPUAN`', '`TENAGA_KERJA_PEREMPUAN`', 16, 4, -1, false, '`TENAGA_KERJA_PEREMPUAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->TENAGA_KERJA_PEREMPUAN->Sortable = true; // Allow sort
        $this->TENAGA_KERJA_PEREMPUAN->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->TENAGA_KERJA_PEREMPUAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->TENAGA_KERJA_PEREMPUAN->Param, "CustomMsg");
        $this->Fields['TENAGA_KERJA_PEREMPUAN'] = &$this->TENAGA_KERJA_PEREMPUAN;

        // MODAL_KERJA
        $this->MODAL_KERJA = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_MODAL_KERJA', 'MODAL_KERJA', '`MODAL_KERJA`', '`MODAL_KERJA`', 5, 22, -1, false, '`MODAL_KERJA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->MODAL_KERJA->Sortable = true; // Allow sort
        $this->MODAL_KERJA->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->MODAL_KERJA->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->MODAL_KERJA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->MODAL_KERJA->Param, "CustomMsg");
        $this->Fields['MODAL_KERJA'] = &$this->MODAL_KERJA;

        // OMZET_RATA-RATA_PERTAHUN
        $this->OMZET_RATARATA_PERTAHUN = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_OMZET_RATARATA_PERTAHUN', 'OMZET_RATA-RATA_PERTAHUN', '`OMZET_RATA-RATA_PERTAHUN`', '`OMZET_RATA-RATA_PERTAHUN`', 5, 22, -1, false, '`OMZET_RATA-RATA_PERTAHUN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->OMZET_RATARATA_PERTAHUN->Sortable = true; // Allow sort
        $this->OMZET_RATARATA_PERTAHUN->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->OMZET_RATARATA_PERTAHUN->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->OMZET_RATARATA_PERTAHUN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->OMZET_RATARATA_PERTAHUN->Param, "CustomMsg");
        $this->Fields['OMZET_RATA-RATA_PERTAHUN'] = &$this->OMZET_RATARATA_PERTAHUN;

        // STATUS_USAHA
        $this->STATUS_USAHA = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_STATUS_USAHA', 'STATUS_USAHA', '`STATUS_USAHA`', '`STATUS_USAHA`', 200, 50, -1, false, '`STATUS_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->STATUS_USAHA->Sortable = true; // Allow sort
        $this->STATUS_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->STATUS_USAHA->Param, "CustomMsg");
        $this->Fields['STATUS_USAHA'] = &$this->STATUS_USAHA;

        // ASET
        $this->ASET = new DbField('umkm_datausaha', 'umkm_datausaha', 'x_ASET', 'ASET', '`ASET`', '`ASET`', 5, 22, -1, false, '`ASET`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ASET->Sortable = true; // Allow sort
        $this->ASET->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ASET->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ASET->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ASET->Param, "CustomMsg");
        $this->Fields['ASET'] = &$this->ASET;
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

    // Current master table name
    public function getCurrentMasterTable()
    {
        return Session(PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE"));
    }

    public function setCurrentMasterTable($v)
    {
        $_SESSION[PROJECT_NAME . "_" . $this->TableVar . "_" . Config("TABLE_MASTER_TABLE")] = $v;
    }

    // Session master WHERE clause
    public function getMasterFilter()
    {
        // Master filter
        $masterFilter = "";
        if ($this->getCurrentMasterTable() == "umkm_datadiri") {
            if ($this->NIK->getSessionValue() != "") {
                $masterFilter .= "" . GetForeignKeySql("`NIK`", $this->NIK->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $masterFilter;
    }

    // Session detail WHERE clause
    public function getDetailFilter()
    {
        // Detail filter
        $detailFilter = "";
        if ($this->getCurrentMasterTable() == "umkm_datadiri") {
            if ($this->NIK->getSessionValue() != "") {
                $detailFilter .= "" . GetForeignKeySql("`NIK`", $this->NIK->getSessionValue(), DATATYPE_STRING, "DB");
            } else {
                return "";
            }
        }
        return $detailFilter;
    }

    // Master filter
    public function sqlMasterFilter_umkm_datadiri()
    {
        return "`NIK`='@NIK@'";
    }
    // Detail filter
    public function sqlDetailFilter_umkm_datadiri()
    {
        return "`NIK`='@NIK@'";
    }

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`umkm_datausaha`";
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
        $this->NAMA_USAHA->DbValue = $row['NAMA_USAHA'];
        $this->TAHUN_MULAI_USAHA->DbValue = $row['TAHUN_MULAI_USAHA'];
        $this->NO_IZIN_USAHA->DbValue = $row['NO_IZIN_USAHA'];
        $this->SEKTOR->DbValue = $row['SEKTOR'];
        $this->SEKTOR_PERGUB->DbValue = $row['SEKTOR_PERGUB'];
        $this->SEKTOR_KBLI->DbValue = $row['SEKTOR_KBLI'];
        $this->SEKTOR_EKRAF->DbValue = $row['SEKTOR_EKRAF'];
        $this->KAPANEWON->DbValue = $row['KAPANEWON'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->DUSUN->DbValue = $row['DUSUN'];
        $this->ALAMAT->DbValue = $row['ALAMAT'];
        $this->TENAGA_KERJA_LAKILAKI->DbValue = $row['TENAGA_KERJA_LAKI-LAKI'];
        $this->TENAGA_KERJA_PEREMPUAN->DbValue = $row['TENAGA_KERJA_PEREMPUAN'];
        $this->MODAL_KERJA->DbValue = $row['MODAL_KERJA'];
        $this->OMZET_RATARATA_PERTAHUN->DbValue = $row['OMZET_RATA-RATA_PERTAHUN'];
        $this->STATUS_USAHA->DbValue = $row['STATUS_USAHA'];
        $this->ASET->DbValue = $row['ASET'];
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
        return $_SESSION[$name] ?? GetUrl("umkmdatausahalist");
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
        if ($pageName == "umkmdatausahaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "umkmdatausahaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "umkmdatausahaadd") {
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
                return "UmkmDatausahaView";
            case Config("API_ADD_ACTION"):
                return "UmkmDatausahaAdd";
            case Config("API_EDIT_ACTION"):
                return "UmkmDatausahaEdit";
            case Config("API_DELETE_ACTION"):
                return "UmkmDatausahaDelete";
            case Config("API_LIST_ACTION"):
                return "UmkmDatausahaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "umkmdatausahalist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("umkmdatausahaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("umkmdatausahaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "umkmdatausahaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "umkmdatausahaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("umkmdatausahaedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("umkmdatausahaadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("umkmdatausahadelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        if ($this->getCurrentMasterTable() == "umkm_datadiri" && !ContainsString($url, Config("TABLE_SHOW_MASTER") . "=")) {
            $url .= (ContainsString($url, "?") ? "&" : "?") . Config("TABLE_SHOW_MASTER") . "=" . $this->getCurrentMasterTable();
            $url .= "&" . GetForeignKeyUrl("fk_NIK", $this->NIK->CurrentValue ?? $this->NIK->getSessionValue());
        }
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
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->TAHUN_MULAI_USAHA->setDbValue($row['TAHUN_MULAI_USAHA']);
        $this->NO_IZIN_USAHA->setDbValue($row['NO_IZIN_USAHA']);
        $this->SEKTOR->setDbValue($row['SEKTOR']);
        $this->SEKTOR_PERGUB->setDbValue($row['SEKTOR_PERGUB']);
        $this->SEKTOR_KBLI->setDbValue($row['SEKTOR_KBLI']);
        $this->SEKTOR_EKRAF->setDbValue($row['SEKTOR_EKRAF']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->DUSUN->setDbValue($row['DUSUN']);
        $this->ALAMAT->setDbValue($row['ALAMAT']);
        $this->TENAGA_KERJA_LAKILAKI->setDbValue($row['TENAGA_KERJA_LAKI-LAKI']);
        $this->TENAGA_KERJA_PEREMPUAN->setDbValue($row['TENAGA_KERJA_PEREMPUAN']);
        $this->MODAL_KERJA->setDbValue($row['MODAL_KERJA']);
        $this->OMZET_RATARATA_PERTAHUN->setDbValue($row['OMZET_RATA-RATA_PERTAHUN']);
        $this->STATUS_USAHA->setDbValue($row['STATUS_USAHA']);
        $this->ASET->setDbValue($row['ASET']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NIK

        // NAMA_USAHA

        // TAHUN_MULAI_USAHA

        // NO_IZIN_USAHA

        // SEKTOR

        // SEKTOR_PERGUB

        // SEKTOR_KBLI

        // SEKTOR_EKRAF

        // KAPANEWON

        // KALURAHAN

        // DUSUN

        // ALAMAT

        // TENAGA_KERJA_LAKI-LAKI

        // TENAGA_KERJA_PEREMPUAN

        // MODAL_KERJA

        // OMZET_RATA-RATA_PERTAHUN

        // STATUS_USAHA

        // ASET

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->ViewCustomAttributes = "";

        // TAHUN_MULAI_USAHA
        $this->TAHUN_MULAI_USAHA->ViewValue = $this->TAHUN_MULAI_USAHA->CurrentValue;
        $this->TAHUN_MULAI_USAHA->ViewCustomAttributes = "";

        // NO_IZIN_USAHA
        $this->NO_IZIN_USAHA->ViewValue = $this->NO_IZIN_USAHA->CurrentValue;
        $this->NO_IZIN_USAHA->ViewCustomAttributes = "";

        // SEKTOR
        $this->SEKTOR->ViewValue = $this->SEKTOR->CurrentValue;
        $this->SEKTOR->ViewCustomAttributes = "";

        // SEKTOR_PERGUB
        $curVal = strval($this->SEKTOR_PERGUB->CurrentValue);
        if ($curVal != "") {
            $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->lookupCacheOption($curVal);
            if ($this->SEKTOR_PERGUB->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='PERGUB'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_PERGUB->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SEKTOR_PERGUB->Lookup->renderViewRow($rswrk[0]);
                    $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->displayValue($arwrk);
                } else {
                    $this->SEKTOR_PERGUB->ViewValue = $this->SEKTOR_PERGUB->CurrentValue;
                }
            }
        } else {
            $this->SEKTOR_PERGUB->ViewValue = null;
        }
        $this->SEKTOR_PERGUB->ViewCustomAttributes = "";

        // SEKTOR_KBLI
        $curVal = strval($this->SEKTOR_KBLI->CurrentValue);
        if ($curVal != "") {
            $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->lookupCacheOption($curVal);
            if ($this->SEKTOR_KBLI->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='KBLI'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_KBLI->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SEKTOR_KBLI->Lookup->renderViewRow($rswrk[0]);
                    $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->displayValue($arwrk);
                } else {
                    $this->SEKTOR_KBLI->ViewValue = $this->SEKTOR_KBLI->CurrentValue;
                }
            }
        } else {
            $this->SEKTOR_KBLI->ViewValue = null;
        }
        $this->SEKTOR_KBLI->ViewCustomAttributes = "";

        // SEKTOR_EKRAF
        $curVal = strval($this->SEKTOR_EKRAF->CurrentValue);
        if ($curVal != "") {
            $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->lookupCacheOption($curVal);
            if ($this->SEKTOR_EKRAF->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_NUMBER, "");
                $lookupFilter = function() {
                    return "`subkat`='EKRAFT'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->SEKTOR_EKRAF->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->SEKTOR_EKRAF->Lookup->renderViewRow($rswrk[0]);
                    $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->displayValue($arwrk);
                } else {
                    $this->SEKTOR_EKRAF->ViewValue = $this->SEKTOR_EKRAF->CurrentValue;
                }
            }
        } else {
            $this->SEKTOR_EKRAF->ViewValue = null;
        }
        $this->SEKTOR_EKRAF->ViewCustomAttributes = "";

        // KAPANEWON
        $curVal = strval($this->KAPANEWON->CurrentValue);
        if ($curVal != "") {
            $this->KAPANEWON->ViewValue = $this->KAPANEWON->lookupCacheOption($curVal);
            if ($this->KAPANEWON->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $lookupFilter = function() {
                    return "`city_id`='3402'";
                };
                $lookupFilter = $lookupFilter->bindTo($this);
                $sqlWrk = $this->KAPANEWON->Lookup->getSql(false, $filterWrk, $lookupFilter, $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KAPANEWON->Lookup->renderViewRow($rswrk[0]);
                    $this->KAPANEWON->ViewValue = $this->KAPANEWON->displayValue($arwrk);
                } else {
                    $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
                }
            }
        } else {
            $this->KAPANEWON->ViewValue = null;
        }
        $this->KAPANEWON->ViewCustomAttributes = "";

        // KALURAHAN
        $curVal = strval($this->KALURAHAN->CurrentValue);
        if ($curVal != "") {
            $this->KALURAHAN->ViewValue = $this->KALURAHAN->lookupCacheOption($curVal);
            if ($this->KALURAHAN->ViewValue === null) { // Lookup from database
                $filterWrk = "`id`" . SearchString("=", $curVal, DATATYPE_STRING, "");
                $sqlWrk = $this->KALURAHAN->Lookup->getSql(false, $filterWrk, '', $this, true, true);
                $rswrk = Conn()->executeQuery($sqlWrk)->fetchAll(\PDO::FETCH_BOTH);
                $ari = count($rswrk);
                if ($ari > 0) { // Lookup values found
                    $arwrk = $this->KALURAHAN->Lookup->renderViewRow($rswrk[0]);
                    $this->KALURAHAN->ViewValue = $this->KALURAHAN->displayValue($arwrk);
                } else {
                    $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
                }
            }
        } else {
            $this->KALURAHAN->ViewValue = null;
        }
        $this->KALURAHAN->ViewCustomAttributes = "";

        // DUSUN
        $this->DUSUN->ViewValue = $this->DUSUN->CurrentValue;
        $this->DUSUN->ViewCustomAttributes = "";

        // ALAMAT
        $this->ALAMAT->ViewValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->ViewCustomAttributes = "";

        // TENAGA_KERJA_LAKI-LAKI
        $this->TENAGA_KERJA_LAKILAKI->ViewValue = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
        $this->TENAGA_KERJA_LAKILAKI->ViewValue = FormatNumber($this->TENAGA_KERJA_LAKILAKI->ViewValue, 0, -2, -2, -2);
        $this->TENAGA_KERJA_LAKILAKI->ViewCustomAttributes = "";

        // TENAGA_KERJA_PEREMPUAN
        $this->TENAGA_KERJA_PEREMPUAN->ViewValue = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
        $this->TENAGA_KERJA_PEREMPUAN->ViewValue = FormatNumber($this->TENAGA_KERJA_PEREMPUAN->ViewValue, 0, -2, -2, -2);
        $this->TENAGA_KERJA_PEREMPUAN->ViewCustomAttributes = "";

        // MODAL_KERJA
        $this->MODAL_KERJA->ViewValue = $this->MODAL_KERJA->CurrentValue;
        $this->MODAL_KERJA->ViewValue = FormatNumber($this->MODAL_KERJA->ViewValue, 2, -2, -2, -2);
        $this->MODAL_KERJA->ViewCustomAttributes = "";

        // OMZET_RATA-RATA_PERTAHUN
        $this->OMZET_RATARATA_PERTAHUN->ViewValue = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
        $this->OMZET_RATARATA_PERTAHUN->ViewValue = FormatNumber($this->OMZET_RATARATA_PERTAHUN->ViewValue, 2, -2, -2, -2);
        $this->OMZET_RATARATA_PERTAHUN->ViewCustomAttributes = "";

        // STATUS_USAHA
        $this->STATUS_USAHA->ViewValue = $this->STATUS_USAHA->CurrentValue;
        $this->STATUS_USAHA->ViewCustomAttributes = "";

        // ASET
        $this->ASET->ViewValue = $this->ASET->CurrentValue;
        $this->ASET->ViewValue = FormatNumber($this->ASET->ViewValue, 2, -2, -2, -2);
        $this->ASET->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->LinkCustomAttributes = "";
        $this->NAMA_USAHA->HrefValue = "";
        $this->NAMA_USAHA->TooltipValue = "";

        // TAHUN_MULAI_USAHA
        $this->TAHUN_MULAI_USAHA->LinkCustomAttributes = "";
        $this->TAHUN_MULAI_USAHA->HrefValue = "";
        $this->TAHUN_MULAI_USAHA->TooltipValue = "";

        // NO_IZIN_USAHA
        $this->NO_IZIN_USAHA->LinkCustomAttributes = "";
        $this->NO_IZIN_USAHA->HrefValue = "";
        $this->NO_IZIN_USAHA->TooltipValue = "";

        // SEKTOR
        $this->SEKTOR->LinkCustomAttributes = "";
        $this->SEKTOR->HrefValue = "";
        $this->SEKTOR->TooltipValue = "";

        // SEKTOR_PERGUB
        $this->SEKTOR_PERGUB->LinkCustomAttributes = "";
        $this->SEKTOR_PERGUB->HrefValue = "";
        $this->SEKTOR_PERGUB->TooltipValue = "";

        // SEKTOR_KBLI
        $this->SEKTOR_KBLI->LinkCustomAttributes = "";
        $this->SEKTOR_KBLI->HrefValue = "";
        $this->SEKTOR_KBLI->TooltipValue = "";

        // SEKTOR_EKRAF
        $this->SEKTOR_EKRAF->LinkCustomAttributes = "";
        $this->SEKTOR_EKRAF->HrefValue = "";
        $this->SEKTOR_EKRAF->TooltipValue = "";

        // KAPANEWON
        $this->KAPANEWON->LinkCustomAttributes = "";
        $this->KAPANEWON->HrefValue = "";
        $this->KAPANEWON->TooltipValue = "";

        // KALURAHAN
        $this->KALURAHAN->LinkCustomAttributes = "";
        $this->KALURAHAN->HrefValue = "";
        $this->KALURAHAN->TooltipValue = "";

        // DUSUN
        $this->DUSUN->LinkCustomAttributes = "";
        $this->DUSUN->HrefValue = "";
        $this->DUSUN->TooltipValue = "";

        // ALAMAT
        $this->ALAMAT->LinkCustomAttributes = "";
        $this->ALAMAT->HrefValue = "";
        $this->ALAMAT->TooltipValue = "";

        // TENAGA_KERJA_LAKI-LAKI
        $this->TENAGA_KERJA_LAKILAKI->LinkCustomAttributes = "";
        $this->TENAGA_KERJA_LAKILAKI->HrefValue = "";
        $this->TENAGA_KERJA_LAKILAKI->TooltipValue = "";

        // TENAGA_KERJA_PEREMPUAN
        $this->TENAGA_KERJA_PEREMPUAN->LinkCustomAttributes = "";
        $this->TENAGA_KERJA_PEREMPUAN->HrefValue = "";
        $this->TENAGA_KERJA_PEREMPUAN->TooltipValue = "";

        // MODAL_KERJA
        $this->MODAL_KERJA->LinkCustomAttributes = "";
        $this->MODAL_KERJA->HrefValue = "";
        $this->MODAL_KERJA->TooltipValue = "";

        // OMZET_RATA-RATA_PERTAHUN
        $this->OMZET_RATARATA_PERTAHUN->LinkCustomAttributes = "";
        $this->OMZET_RATARATA_PERTAHUN->HrefValue = "";
        $this->OMZET_RATARATA_PERTAHUN->TooltipValue = "";

        // STATUS_USAHA
        $this->STATUS_USAHA->LinkCustomAttributes = "";
        $this->STATUS_USAHA->HrefValue = "";
        $this->STATUS_USAHA->TooltipValue = "";

        // ASET
        $this->ASET->LinkCustomAttributes = "";
        $this->ASET->HrefValue = "";
        $this->ASET->TooltipValue = "";

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

        // NAMA_USAHA
        $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
        $this->NAMA_USAHA->EditCustomAttributes = "";
        if (!$this->NAMA_USAHA->Raw) {
            $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
        }
        $this->NAMA_USAHA->EditValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

        // TAHUN_MULAI_USAHA
        $this->TAHUN_MULAI_USAHA->EditAttrs["class"] = "form-control";
        $this->TAHUN_MULAI_USAHA->EditCustomAttributes = "";
        if (!$this->TAHUN_MULAI_USAHA->Raw) {
            $this->TAHUN_MULAI_USAHA->CurrentValue = HtmlDecode($this->TAHUN_MULAI_USAHA->CurrentValue);
        }
        $this->TAHUN_MULAI_USAHA->EditValue = $this->TAHUN_MULAI_USAHA->CurrentValue;
        $this->TAHUN_MULAI_USAHA->PlaceHolder = RemoveHtml($this->TAHUN_MULAI_USAHA->caption());

        // NO_IZIN_USAHA
        $this->NO_IZIN_USAHA->EditAttrs["class"] = "form-control";
        $this->NO_IZIN_USAHA->EditCustomAttributes = "";
        if (!$this->NO_IZIN_USAHA->Raw) {
            $this->NO_IZIN_USAHA->CurrentValue = HtmlDecode($this->NO_IZIN_USAHA->CurrentValue);
        }
        $this->NO_IZIN_USAHA->EditValue = $this->NO_IZIN_USAHA->CurrentValue;
        $this->NO_IZIN_USAHA->PlaceHolder = RemoveHtml($this->NO_IZIN_USAHA->caption());

        // SEKTOR
        $this->SEKTOR->EditAttrs["class"] = "form-control";
        $this->SEKTOR->EditCustomAttributes = "";
        if (!$this->SEKTOR->Raw) {
            $this->SEKTOR->CurrentValue = HtmlDecode($this->SEKTOR->CurrentValue);
        }
        $this->SEKTOR->EditValue = $this->SEKTOR->CurrentValue;
        $this->SEKTOR->PlaceHolder = RemoveHtml($this->SEKTOR->caption());

        // SEKTOR_PERGUB
        $this->SEKTOR_PERGUB->EditAttrs["class"] = "form-control";
        $this->SEKTOR_PERGUB->EditCustomAttributes = "";
        $this->SEKTOR_PERGUB->PlaceHolder = RemoveHtml($this->SEKTOR_PERGUB->caption());

        // SEKTOR_KBLI
        $this->SEKTOR_KBLI->EditAttrs["class"] = "form-control";
        $this->SEKTOR_KBLI->EditCustomAttributes = "";
        $this->SEKTOR_KBLI->PlaceHolder = RemoveHtml($this->SEKTOR_KBLI->caption());

        // SEKTOR_EKRAF
        $this->SEKTOR_EKRAF->EditAttrs["class"] = "form-control";
        $this->SEKTOR_EKRAF->EditCustomAttributes = "";
        $this->SEKTOR_EKRAF->PlaceHolder = RemoveHtml($this->SEKTOR_EKRAF->caption());

        // KAPANEWON
        $this->KAPANEWON->EditAttrs["class"] = "form-control";
        $this->KAPANEWON->EditCustomAttributes = "";
        $this->KAPANEWON->PlaceHolder = RemoveHtml($this->KAPANEWON->caption());

        // KALURAHAN
        $this->KALURAHAN->EditAttrs["class"] = "form-control";
        $this->KALURAHAN->EditCustomAttributes = "";
        $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

        // DUSUN
        $this->DUSUN->EditAttrs["class"] = "form-control";
        $this->DUSUN->EditCustomAttributes = "";
        if (!$this->DUSUN->Raw) {
            $this->DUSUN->CurrentValue = HtmlDecode($this->DUSUN->CurrentValue);
        }
        $this->DUSUN->EditValue = $this->DUSUN->CurrentValue;
        $this->DUSUN->PlaceHolder = RemoveHtml($this->DUSUN->caption());

        // ALAMAT
        $this->ALAMAT->EditAttrs["class"] = "form-control";
        $this->ALAMAT->EditCustomAttributes = "";
        $this->ALAMAT->EditValue = $this->ALAMAT->CurrentValue;
        $this->ALAMAT->PlaceHolder = RemoveHtml($this->ALAMAT->caption());

        // TENAGA_KERJA_LAKI-LAKI
        $this->TENAGA_KERJA_LAKILAKI->EditAttrs["class"] = "form-control";
        $this->TENAGA_KERJA_LAKILAKI->EditCustomAttributes = "";
        $this->TENAGA_KERJA_LAKILAKI->EditValue = $this->TENAGA_KERJA_LAKILAKI->CurrentValue;
        $this->TENAGA_KERJA_LAKILAKI->PlaceHolder = RemoveHtml($this->TENAGA_KERJA_LAKILAKI->caption());

        // TENAGA_KERJA_PEREMPUAN
        $this->TENAGA_KERJA_PEREMPUAN->EditAttrs["class"] = "form-control";
        $this->TENAGA_KERJA_PEREMPUAN->EditCustomAttributes = "";
        $this->TENAGA_KERJA_PEREMPUAN->EditValue = $this->TENAGA_KERJA_PEREMPUAN->CurrentValue;
        $this->TENAGA_KERJA_PEREMPUAN->PlaceHolder = RemoveHtml($this->TENAGA_KERJA_PEREMPUAN->caption());

        // MODAL_KERJA
        $this->MODAL_KERJA->EditAttrs["class"] = "form-control";
        $this->MODAL_KERJA->EditCustomAttributes = "";
        $this->MODAL_KERJA->EditValue = $this->MODAL_KERJA->CurrentValue;
        $this->MODAL_KERJA->PlaceHolder = RemoveHtml($this->MODAL_KERJA->caption());
        if (strval($this->MODAL_KERJA->EditValue) != "" && is_numeric($this->MODAL_KERJA->EditValue)) {
            $this->MODAL_KERJA->EditValue = FormatNumber($this->MODAL_KERJA->EditValue, -2, -2, -2, -2);
        }

        // OMZET_RATA-RATA_PERTAHUN
        $this->OMZET_RATARATA_PERTAHUN->EditAttrs["class"] = "form-control";
        $this->OMZET_RATARATA_PERTAHUN->EditCustomAttributes = "";
        $this->OMZET_RATARATA_PERTAHUN->EditValue = $this->OMZET_RATARATA_PERTAHUN->CurrentValue;
        $this->OMZET_RATARATA_PERTAHUN->PlaceHolder = RemoveHtml($this->OMZET_RATARATA_PERTAHUN->caption());
        if (strval($this->OMZET_RATARATA_PERTAHUN->EditValue) != "" && is_numeric($this->OMZET_RATARATA_PERTAHUN->EditValue)) {
            $this->OMZET_RATARATA_PERTAHUN->EditValue = FormatNumber($this->OMZET_RATARATA_PERTAHUN->EditValue, -2, -2, -2, -2);
        }

        // STATUS_USAHA
        $this->STATUS_USAHA->EditAttrs["class"] = "form-control";
        $this->STATUS_USAHA->EditCustomAttributes = "";
        if (!$this->STATUS_USAHA->Raw) {
            $this->STATUS_USAHA->CurrentValue = HtmlDecode($this->STATUS_USAHA->CurrentValue);
        }
        $this->STATUS_USAHA->EditValue = $this->STATUS_USAHA->CurrentValue;
        $this->STATUS_USAHA->PlaceHolder = RemoveHtml($this->STATUS_USAHA->caption());

        // ASET
        $this->ASET->EditAttrs["class"] = "form-control";
        $this->ASET->EditCustomAttributes = "";
        $this->ASET->EditValue = $this->ASET->CurrentValue;
        $this->ASET->PlaceHolder = RemoveHtml($this->ASET->caption());
        if (strval($this->ASET->EditValue) != "" && is_numeric($this->ASET->EditValue)) {
            $this->ASET->EditValue = FormatNumber($this->ASET->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->TAHUN_MULAI_USAHA);
                    $doc->exportCaption($this->NO_IZIN_USAHA);
                    $doc->exportCaption($this->SEKTOR);
                    $doc->exportCaption($this->SEKTOR_PERGUB);
                    $doc->exportCaption($this->SEKTOR_KBLI);
                    $doc->exportCaption($this->SEKTOR_EKRAF);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->DUSUN);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->TENAGA_KERJA_LAKILAKI);
                    $doc->exportCaption($this->TENAGA_KERJA_PEREMPUAN);
                    $doc->exportCaption($this->MODAL_KERJA);
                    $doc->exportCaption($this->OMZET_RATARATA_PERTAHUN);
                    $doc->exportCaption($this->STATUS_USAHA);
                    $doc->exportCaption($this->ASET);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->TAHUN_MULAI_USAHA);
                    $doc->exportCaption($this->NO_IZIN_USAHA);
                    $doc->exportCaption($this->SEKTOR);
                    $doc->exportCaption($this->SEKTOR_PERGUB);
                    $doc->exportCaption($this->SEKTOR_KBLI);
                    $doc->exportCaption($this->SEKTOR_EKRAF);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->DUSUN);
                    $doc->exportCaption($this->ALAMAT);
                    $doc->exportCaption($this->TENAGA_KERJA_LAKILAKI);
                    $doc->exportCaption($this->TENAGA_KERJA_PEREMPUAN);
                    $doc->exportCaption($this->MODAL_KERJA);
                    $doc->exportCaption($this->OMZET_RATARATA_PERTAHUN);
                    $doc->exportCaption($this->STATUS_USAHA);
                    $doc->exportCaption($this->ASET);
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
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->TAHUN_MULAI_USAHA);
                        $doc->exportField($this->NO_IZIN_USAHA);
                        $doc->exportField($this->SEKTOR);
                        $doc->exportField($this->SEKTOR_PERGUB);
                        $doc->exportField($this->SEKTOR_KBLI);
                        $doc->exportField($this->SEKTOR_EKRAF);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->DUSUN);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->TENAGA_KERJA_LAKILAKI);
                        $doc->exportField($this->TENAGA_KERJA_PEREMPUAN);
                        $doc->exportField($this->MODAL_KERJA);
                        $doc->exportField($this->OMZET_RATARATA_PERTAHUN);
                        $doc->exportField($this->STATUS_USAHA);
                        $doc->exportField($this->ASET);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->TAHUN_MULAI_USAHA);
                        $doc->exportField($this->NO_IZIN_USAHA);
                        $doc->exportField($this->SEKTOR);
                        $doc->exportField($this->SEKTOR_PERGUB);
                        $doc->exportField($this->SEKTOR_KBLI);
                        $doc->exportField($this->SEKTOR_EKRAF);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->DUSUN);
                        $doc->exportField($this->ALAMAT);
                        $doc->exportField($this->TENAGA_KERJA_LAKILAKI);
                        $doc->exportField($this->TENAGA_KERJA_PEREMPUAN);
                        $doc->exportField($this->MODAL_KERJA);
                        $doc->exportField($this->OMZET_RATARATA_PERTAHUN);
                        $doc->exportField($this->STATUS_USAHA);
                        $doc->exportField($this->ASET);
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
