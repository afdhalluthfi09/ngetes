<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for binapesertalengkap
 */
class Binapesertalengkap extends DbTable
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
    public $id_binadata;
    public $idperiode;
    public $periode_tahun;
    public $periode_bulan;
    public $idkelompok;
    public $kelompok_pembinaan;
    public $namakegiatan;
    public $uraian;
    public $tglmulai;
    public $tglakhir;
    public $narasumber;
    public $kontak_nama;
    public $kontak_hp;
    public $poster;
    public $postertipe;
    public $posterukuran;
    public $posterlebar;
    public $postertinggi;
    public $linkinfo;
    public $peserta_kelas;
    public $waktu;
    public $nik;
    public $status;
    public $catatan;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'binapesertalengkap';
        $this->TableName = 'binapesertalengkap';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`binapesertalengkap`";
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
        $this->id = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // id_binadata
        $this->id_binadata = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_id_binadata', 'id_binadata', '`id_binadata`', '`id_binadata`', 3, 11, -1, false, '`id_binadata`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->id_binadata->Sortable = true; // Allow sort
        $this->id_binadata->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id_binadata->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id_binadata->Param, "CustomMsg");
        $this->Fields['id_binadata'] = &$this->id_binadata;

        // idperiode
        $this->idperiode = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_idperiode', 'idperiode', '`idperiode`', '`idperiode`', 2, 6, -1, false, '`idperiode`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idperiode->Nullable = false; // NOT NULL field
        $this->idperiode->Sortable = true; // Allow sort
        $this->idperiode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idperiode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idperiode->Param, "CustomMsg");
        $this->Fields['idperiode'] = &$this->idperiode;

        // periode_tahun
        $this->periode_tahun = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_periode_tahun', 'periode_tahun', '`periode_tahun`', '`periode_tahun`', 3, 4, -1, false, '`periode_tahun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode_tahun->Sortable = true; // Allow sort
        $this->periode_tahun->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->periode_tahun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode_tahun->Param, "CustomMsg");
        $this->Fields['periode_tahun'] = &$this->periode_tahun;

        // periode_bulan
        $this->periode_bulan = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_periode_bulan', 'periode_bulan', '`periode_bulan`', '`periode_bulan`', 200, 30, -1, false, '`periode_bulan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode_bulan->Sortable = true; // Allow sort
        $this->periode_bulan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode_bulan->Param, "CustomMsg");
        $this->Fields['periode_bulan'] = &$this->periode_bulan;

        // idkelompok
        $this->idkelompok = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_idkelompok', 'idkelompok', '`idkelompok`', '`idkelompok`', 2, 6, -1, false, '`idkelompok`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->idkelompok->Sortable = true; // Allow sort
        $this->idkelompok->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->idkelompok->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->idkelompok->Param, "CustomMsg");
        $this->Fields['idkelompok'] = &$this->idkelompok;

        // kelompok_pembinaan
        $this->kelompok_pembinaan = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_kelompok_pembinaan', 'kelompok_pembinaan', '`kelompok_pembinaan`', '`kelompok_pembinaan`', 200, 255, -1, false, '`kelompok_pembinaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelompok_pembinaan->Sortable = true; // Allow sort
        $this->kelompok_pembinaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelompok_pembinaan->Param, "CustomMsg");
        $this->Fields['kelompok_pembinaan'] = &$this->kelompok_pembinaan;

        // namakegiatan
        $this->namakegiatan = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_namakegiatan', 'namakegiatan', '`namakegiatan`', '`namakegiatan`', 200, 200, -1, false, '`namakegiatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->namakegiatan->Sortable = true; // Allow sort
        $this->namakegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->namakegiatan->Param, "CustomMsg");
        $this->Fields['namakegiatan'] = &$this->namakegiatan;

        // uraian
        $this->uraian = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_uraian', 'uraian', '`uraian`', '`uraian`', 200, 255, -1, false, '`uraian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->uraian->Sortable = true; // Allow sort
        $this->uraian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->uraian->Param, "CustomMsg");
        $this->Fields['uraian'] = &$this->uraian;

        // tglmulai
        $this->tglmulai = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_tglmulai', 'tglmulai', '`tglmulai`', CastDateFieldForLike("`tglmulai`", 0, "DB"), 133, 10, 0, false, '`tglmulai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tglmulai->Sortable = true; // Allow sort
        $this->tglmulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tglmulai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tglmulai->Param, "CustomMsg");
        $this->Fields['tglmulai'] = &$this->tglmulai;

        // tglakhir
        $this->tglakhir = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_tglakhir', 'tglakhir', '`tglakhir`', CastDateFieldForLike("`tglakhir`", 0, "DB"), 133, 10, 0, false, '`tglakhir`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tglakhir->Sortable = true; // Allow sort
        $this->tglakhir->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tglakhir->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tglakhir->Param, "CustomMsg");
        $this->Fields['tglakhir'] = &$this->tglakhir;

        // narasumber
        $this->narasumber = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_narasumber', 'narasumber', '`narasumber`', '`narasumber`', 200, 100, -1, false, '`narasumber`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->narasumber->Sortable = true; // Allow sort
        $this->narasumber->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->narasumber->Param, "CustomMsg");
        $this->Fields['narasumber'] = &$this->narasumber;

        // kontak_nama
        $this->kontak_nama = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_kontak_nama', 'kontak_nama', '`kontak_nama`', '`kontak_nama`', 200, 50, -1, false, '`kontak_nama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kontak_nama->Sortable = true; // Allow sort
        $this->kontak_nama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kontak_nama->Param, "CustomMsg");
        $this->Fields['kontak_nama'] = &$this->kontak_nama;

        // kontak_hp
        $this->kontak_hp = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_kontak_hp', 'kontak_hp', '`kontak_hp`', '`kontak_hp`', 200, 50, -1, false, '`kontak_hp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kontak_hp->Sortable = true; // Allow sort
        $this->kontak_hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kontak_hp->Param, "CustomMsg");
        $this->Fields['kontak_hp'] = &$this->kontak_hp;

        // poster
        $this->poster = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_poster', 'poster', '`poster`', '`poster`', 200, 50, -1, false, '`poster`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->poster->Sortable = true; // Allow sort
        $this->poster->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->poster->Param, "CustomMsg");
        $this->Fields['poster'] = &$this->poster;

        // postertipe
        $this->postertipe = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_postertipe', 'postertipe', '`postertipe`', '`postertipe`', 200, 200, -1, false, '`postertipe`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->postertipe->Sortable = true; // Allow sort
        $this->postertipe->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->postertipe->Param, "CustomMsg");
        $this->Fields['postertipe'] = &$this->postertipe;

        // posterukuran
        $this->posterukuran = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_posterukuran', 'posterukuran', '`posterukuran`', '`posterukuran`', 3, 11, -1, false, '`posterukuran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->posterukuran->Sortable = true; // Allow sort
        $this->posterukuran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->posterukuran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->posterukuran->Param, "CustomMsg");
        $this->Fields['posterukuran'] = &$this->posterukuran;

        // posterlebar
        $this->posterlebar = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_posterlebar', 'posterlebar', '`posterlebar`', '`posterlebar`', 3, 11, -1, false, '`posterlebar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->posterlebar->Sortable = true; // Allow sort
        $this->posterlebar->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->posterlebar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->posterlebar->Param, "CustomMsg");
        $this->Fields['posterlebar'] = &$this->posterlebar;

        // postertinggi
        $this->postertinggi = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_postertinggi', 'postertinggi', '`postertinggi`', '`postertinggi`', 3, 11, -1, false, '`postertinggi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->postertinggi->Sortable = true; // Allow sort
        $this->postertinggi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->postertinggi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->postertinggi->Param, "CustomMsg");
        $this->Fields['postertinggi'] = &$this->postertinggi;

        // linkinfo
        $this->linkinfo = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_linkinfo', 'linkinfo', '`linkinfo`', '`linkinfo`', 200, 100, -1, false, '`linkinfo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->linkinfo->Sortable = true; // Allow sort
        $this->linkinfo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->linkinfo->Param, "CustomMsg");
        $this->Fields['linkinfo'] = &$this->linkinfo;

        // peserta_kelas
        $this->peserta_kelas = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_peserta_kelas', 'peserta_kelas', '`peserta_kelas`', '`peserta_kelas`', 200, 50, -1, false, '`peserta_kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->peserta_kelas->Sortable = true; // Allow sort
        $this->peserta_kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->peserta_kelas->Param, "CustomMsg");
        $this->Fields['peserta_kelas'] = &$this->peserta_kelas;

        // waktu
        $this->waktu = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_waktu', 'waktu', '`waktu`', CastDateFieldForLike("`waktu`", 0, "DB"), 135, 19, 0, false, '`waktu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu->Sortable = true; // Allow sort
        $this->waktu->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu->Param, "CustomMsg");
        $this->Fields['waktu'] = &$this->waktu;

        // nik
        $this->nik = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // status
        $this->status = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_status', 'status', '`status`', '`status`', 200, 255, -1, false, '`status`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->status->Sortable = true; // Allow sort
        $this->status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->status->Param, "CustomMsg");
        $this->Fields['status'] = &$this->status;

        // catatan
        $this->catatan = new DbField('binapesertalengkap', 'binapesertalengkap', 'x_catatan', 'catatan', '`catatan`', '`catatan`', 200, 255, -1, false, '`catatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->catatan->Sortable = true; // Allow sort
        $this->catatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->catatan->Param, "CustomMsg");
        $this->Fields['catatan'] = &$this->catatan;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`binapesertalengkap`";
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
        $this->id_binadata->DbValue = $row['id_binadata'];
        $this->idperiode->DbValue = $row['idperiode'];
        $this->periode_tahun->DbValue = $row['periode_tahun'];
        $this->periode_bulan->DbValue = $row['periode_bulan'];
        $this->idkelompok->DbValue = $row['idkelompok'];
        $this->kelompok_pembinaan->DbValue = $row['kelompok_pembinaan'];
        $this->namakegiatan->DbValue = $row['namakegiatan'];
        $this->uraian->DbValue = $row['uraian'];
        $this->tglmulai->DbValue = $row['tglmulai'];
        $this->tglakhir->DbValue = $row['tglakhir'];
        $this->narasumber->DbValue = $row['narasumber'];
        $this->kontak_nama->DbValue = $row['kontak_nama'];
        $this->kontak_hp->DbValue = $row['kontak_hp'];
        $this->poster->DbValue = $row['poster'];
        $this->postertipe->DbValue = $row['postertipe'];
        $this->posterukuran->DbValue = $row['posterukuran'];
        $this->posterlebar->DbValue = $row['posterlebar'];
        $this->postertinggi->DbValue = $row['postertinggi'];
        $this->linkinfo->DbValue = $row['linkinfo'];
        $this->peserta_kelas->DbValue = $row['peserta_kelas'];
        $this->waktu->DbValue = $row['waktu'];
        $this->nik->DbValue = $row['nik'];
        $this->status->DbValue = $row['status'];
        $this->catatan->DbValue = $row['catatan'];
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
        return $_SESSION[$name] ?? GetUrl("binapesertalengkaplist");
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
        if ($pageName == "binapesertalengkapview") {
            return $Language->phrase("View");
        } elseif ($pageName == "binapesertalengkapedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "binapesertalengkapadd") {
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
                return "BinapesertalengkapView";
            case Config("API_ADD_ACTION"):
                return "BinapesertalengkapAdd";
            case Config("API_EDIT_ACTION"):
                return "BinapesertalengkapEdit";
            case Config("API_DELETE_ACTION"):
                return "BinapesertalengkapDelete";
            case Config("API_LIST_ACTION"):
                return "BinapesertalengkapList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "binapesertalengkaplist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("binapesertalengkapview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("binapesertalengkapview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "binapesertalengkapadd?" . $this->getUrlParm($parm);
        } else {
            $url = "binapesertalengkapadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("binapesertalengkapedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("binapesertalengkapadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("binapesertalengkapdelete", $this->getUrlParm());
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
        $this->id_binadata->setDbValue($row['id_binadata']);
        $this->idperiode->setDbValue($row['idperiode']);
        $this->periode_tahun->setDbValue($row['periode_tahun']);
        $this->periode_bulan->setDbValue($row['periode_bulan']);
        $this->idkelompok->setDbValue($row['idkelompok']);
        $this->kelompok_pembinaan->setDbValue($row['kelompok_pembinaan']);
        $this->namakegiatan->setDbValue($row['namakegiatan']);
        $this->uraian->setDbValue($row['uraian']);
        $this->tglmulai->setDbValue($row['tglmulai']);
        $this->tglakhir->setDbValue($row['tglakhir']);
        $this->narasumber->setDbValue($row['narasumber']);
        $this->kontak_nama->setDbValue($row['kontak_nama']);
        $this->kontak_hp->setDbValue($row['kontak_hp']);
        $this->poster->setDbValue($row['poster']);
        $this->postertipe->setDbValue($row['postertipe']);
        $this->posterukuran->setDbValue($row['posterukuran']);
        $this->posterlebar->setDbValue($row['posterlebar']);
        $this->postertinggi->setDbValue($row['postertinggi']);
        $this->linkinfo->setDbValue($row['linkinfo']);
        $this->peserta_kelas->setDbValue($row['peserta_kelas']);
        $this->waktu->setDbValue($row['waktu']);
        $this->nik->setDbValue($row['nik']);
        $this->status->setDbValue($row['status']);
        $this->catatan->setDbValue($row['catatan']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // id_binadata

        // idperiode

        // periode_tahun

        // periode_bulan

        // idkelompok

        // kelompok_pembinaan

        // namakegiatan

        // uraian

        // tglmulai

        // tglakhir

        // narasumber

        // kontak_nama

        // kontak_hp

        // poster

        // postertipe

        // posterukuran

        // posterlebar

        // postertinggi

        // linkinfo

        // peserta_kelas

        // waktu

        // nik

        // status

        // catatan

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // id_binadata
        $this->id_binadata->ViewValue = $this->id_binadata->CurrentValue;
        $this->id_binadata->ViewValue = FormatNumber($this->id_binadata->ViewValue, 0, -2, -2, -2);
        $this->id_binadata->ViewCustomAttributes = "";

        // idperiode
        $this->idperiode->ViewValue = $this->idperiode->CurrentValue;
        $this->idperiode->ViewValue = FormatNumber($this->idperiode->ViewValue, 0, -2, -2, -2);
        $this->idperiode->ViewCustomAttributes = "";

        // periode_tahun
        $this->periode_tahun->ViewValue = $this->periode_tahun->CurrentValue;
        $this->periode_tahun->ViewValue = FormatNumber($this->periode_tahun->ViewValue, 0, -2, -2, -2);
        $this->periode_tahun->ViewCustomAttributes = "";

        // periode_bulan
        $this->periode_bulan->ViewValue = $this->periode_bulan->CurrentValue;
        $this->periode_bulan->ViewCustomAttributes = "";

        // idkelompok
        $this->idkelompok->ViewValue = $this->idkelompok->CurrentValue;
        $this->idkelompok->ViewValue = FormatNumber($this->idkelompok->ViewValue, 0, -2, -2, -2);
        $this->idkelompok->ViewCustomAttributes = "";

        // kelompok_pembinaan
        $this->kelompok_pembinaan->ViewValue = $this->kelompok_pembinaan->CurrentValue;
        $this->kelompok_pembinaan->ViewCustomAttributes = "";

        // namakegiatan
        $this->namakegiatan->ViewValue = $this->namakegiatan->CurrentValue;
        $this->namakegiatan->ViewCustomAttributes = "";

        // uraian
        $this->uraian->ViewValue = $this->uraian->CurrentValue;
        $this->uraian->ViewCustomAttributes = "";

        // tglmulai
        $this->tglmulai->ViewValue = $this->tglmulai->CurrentValue;
        $this->tglmulai->ViewValue = FormatDateTime($this->tglmulai->ViewValue, 0);
        $this->tglmulai->ViewCustomAttributes = "";

        // tglakhir
        $this->tglakhir->ViewValue = $this->tglakhir->CurrentValue;
        $this->tglakhir->ViewValue = FormatDateTime($this->tglakhir->ViewValue, 0);
        $this->tglakhir->ViewCustomAttributes = "";

        // narasumber
        $this->narasumber->ViewValue = $this->narasumber->CurrentValue;
        $this->narasumber->ViewCustomAttributes = "";

        // kontak_nama
        $this->kontak_nama->ViewValue = $this->kontak_nama->CurrentValue;
        $this->kontak_nama->ViewCustomAttributes = "";

        // kontak_hp
        $this->kontak_hp->ViewValue = $this->kontak_hp->CurrentValue;
        $this->kontak_hp->ViewCustomAttributes = "";

        // poster
        $this->poster->ViewValue = $this->poster->CurrentValue;
        $this->poster->ViewCustomAttributes = "";

        // postertipe
        $this->postertipe->ViewValue = $this->postertipe->CurrentValue;
        $this->postertipe->ViewCustomAttributes = "";

        // posterukuran
        $this->posterukuran->ViewValue = $this->posterukuran->CurrentValue;
        $this->posterukuran->ViewValue = FormatNumber($this->posterukuran->ViewValue, 0, -2, -2, -2);
        $this->posterukuran->ViewCustomAttributes = "";

        // posterlebar
        $this->posterlebar->ViewValue = $this->posterlebar->CurrentValue;
        $this->posterlebar->ViewValue = FormatNumber($this->posterlebar->ViewValue, 0, -2, -2, -2);
        $this->posterlebar->ViewCustomAttributes = "";

        // postertinggi
        $this->postertinggi->ViewValue = $this->postertinggi->CurrentValue;
        $this->postertinggi->ViewValue = FormatNumber($this->postertinggi->ViewValue, 0, -2, -2, -2);
        $this->postertinggi->ViewCustomAttributes = "";

        // linkinfo
        $this->linkinfo->ViewValue = $this->linkinfo->CurrentValue;
        $this->linkinfo->ViewCustomAttributes = "";

        // peserta_kelas
        $this->peserta_kelas->ViewValue = $this->peserta_kelas->CurrentValue;
        $this->peserta_kelas->ViewCustomAttributes = "";

        // waktu
        $this->waktu->ViewValue = $this->waktu->CurrentValue;
        $this->waktu->ViewValue = FormatDateTime($this->waktu->ViewValue, 0);
        $this->waktu->ViewCustomAttributes = "";

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // status
        $this->status->ViewValue = $this->status->CurrentValue;
        $this->status->ViewCustomAttributes = "";

        // catatan
        $this->catatan->ViewValue = $this->catatan->CurrentValue;
        $this->catatan->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // id_binadata
        $this->id_binadata->LinkCustomAttributes = "";
        $this->id_binadata->HrefValue = "";
        $this->id_binadata->TooltipValue = "";

        // idperiode
        $this->idperiode->LinkCustomAttributes = "";
        $this->idperiode->HrefValue = "";
        $this->idperiode->TooltipValue = "";

        // periode_tahun
        $this->periode_tahun->LinkCustomAttributes = "";
        $this->periode_tahun->HrefValue = "";
        $this->periode_tahun->TooltipValue = "";

        // periode_bulan
        $this->periode_bulan->LinkCustomAttributes = "";
        $this->periode_bulan->HrefValue = "";
        $this->periode_bulan->TooltipValue = "";

        // idkelompok
        $this->idkelompok->LinkCustomAttributes = "";
        $this->idkelompok->HrefValue = "";
        $this->idkelompok->TooltipValue = "";

        // kelompok_pembinaan
        $this->kelompok_pembinaan->LinkCustomAttributes = "";
        $this->kelompok_pembinaan->HrefValue = "";
        $this->kelompok_pembinaan->TooltipValue = "";

        // namakegiatan
        $this->namakegiatan->LinkCustomAttributes = "";
        $this->namakegiatan->HrefValue = "";
        $this->namakegiatan->TooltipValue = "";

        // uraian
        $this->uraian->LinkCustomAttributes = "";
        $this->uraian->HrefValue = "";
        $this->uraian->TooltipValue = "";

        // tglmulai
        $this->tglmulai->LinkCustomAttributes = "";
        $this->tglmulai->HrefValue = "";
        $this->tglmulai->TooltipValue = "";

        // tglakhir
        $this->tglakhir->LinkCustomAttributes = "";
        $this->tglakhir->HrefValue = "";
        $this->tglakhir->TooltipValue = "";

        // narasumber
        $this->narasumber->LinkCustomAttributes = "";
        $this->narasumber->HrefValue = "";
        $this->narasumber->TooltipValue = "";

        // kontak_nama
        $this->kontak_nama->LinkCustomAttributes = "";
        $this->kontak_nama->HrefValue = "";
        $this->kontak_nama->TooltipValue = "";

        // kontak_hp
        $this->kontak_hp->LinkCustomAttributes = "";
        $this->kontak_hp->HrefValue = "";
        $this->kontak_hp->TooltipValue = "";

        // poster
        $this->poster->LinkCustomAttributes = "";
        $this->poster->HrefValue = "";
        $this->poster->TooltipValue = "";

        // postertipe
        $this->postertipe->LinkCustomAttributes = "";
        $this->postertipe->HrefValue = "";
        $this->postertipe->TooltipValue = "";

        // posterukuran
        $this->posterukuran->LinkCustomAttributes = "";
        $this->posterukuran->HrefValue = "";
        $this->posterukuran->TooltipValue = "";

        // posterlebar
        $this->posterlebar->LinkCustomAttributes = "";
        $this->posterlebar->HrefValue = "";
        $this->posterlebar->TooltipValue = "";

        // postertinggi
        $this->postertinggi->LinkCustomAttributes = "";
        $this->postertinggi->HrefValue = "";
        $this->postertinggi->TooltipValue = "";

        // linkinfo
        $this->linkinfo->LinkCustomAttributes = "";
        $this->linkinfo->HrefValue = "";
        $this->linkinfo->TooltipValue = "";

        // peserta_kelas
        $this->peserta_kelas->LinkCustomAttributes = "";
        $this->peserta_kelas->HrefValue = "";
        $this->peserta_kelas->TooltipValue = "";

        // waktu
        $this->waktu->LinkCustomAttributes = "";
        $this->waktu->HrefValue = "";
        $this->waktu->TooltipValue = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // status
        $this->status->LinkCustomAttributes = "";
        $this->status->HrefValue = "";
        $this->status->TooltipValue = "";

        // catatan
        $this->catatan->LinkCustomAttributes = "";
        $this->catatan->HrefValue = "";
        $this->catatan->TooltipValue = "";

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

        // id_binadata
        $this->id_binadata->EditAttrs["class"] = "form-control";
        $this->id_binadata->EditCustomAttributes = "";
        $this->id_binadata->EditValue = $this->id_binadata->CurrentValue;
        $this->id_binadata->PlaceHolder = RemoveHtml($this->id_binadata->caption());

        // idperiode
        $this->idperiode->EditAttrs["class"] = "form-control";
        $this->idperiode->EditCustomAttributes = "";
        $this->idperiode->EditValue = $this->idperiode->CurrentValue;
        $this->idperiode->PlaceHolder = RemoveHtml($this->idperiode->caption());

        // periode_tahun
        $this->periode_tahun->EditAttrs["class"] = "form-control";
        $this->periode_tahun->EditCustomAttributes = "";
        $this->periode_tahun->EditValue = $this->periode_tahun->CurrentValue;
        $this->periode_tahun->PlaceHolder = RemoveHtml($this->periode_tahun->caption());

        // periode_bulan
        $this->periode_bulan->EditAttrs["class"] = "form-control";
        $this->periode_bulan->EditCustomAttributes = "";
        if (!$this->periode_bulan->Raw) {
            $this->periode_bulan->CurrentValue = HtmlDecode($this->periode_bulan->CurrentValue);
        }
        $this->periode_bulan->EditValue = $this->periode_bulan->CurrentValue;
        $this->periode_bulan->PlaceHolder = RemoveHtml($this->periode_bulan->caption());

        // idkelompok
        $this->idkelompok->EditAttrs["class"] = "form-control";
        $this->idkelompok->EditCustomAttributes = "";
        $this->idkelompok->EditValue = $this->idkelompok->CurrentValue;
        $this->idkelompok->PlaceHolder = RemoveHtml($this->idkelompok->caption());

        // kelompok_pembinaan
        $this->kelompok_pembinaan->EditAttrs["class"] = "form-control";
        $this->kelompok_pembinaan->EditCustomAttributes = "";
        if (!$this->kelompok_pembinaan->Raw) {
            $this->kelompok_pembinaan->CurrentValue = HtmlDecode($this->kelompok_pembinaan->CurrentValue);
        }
        $this->kelompok_pembinaan->EditValue = $this->kelompok_pembinaan->CurrentValue;
        $this->kelompok_pembinaan->PlaceHolder = RemoveHtml($this->kelompok_pembinaan->caption());

        // namakegiatan
        $this->namakegiatan->EditAttrs["class"] = "form-control";
        $this->namakegiatan->EditCustomAttributes = "";
        if (!$this->namakegiatan->Raw) {
            $this->namakegiatan->CurrentValue = HtmlDecode($this->namakegiatan->CurrentValue);
        }
        $this->namakegiatan->EditValue = $this->namakegiatan->CurrentValue;
        $this->namakegiatan->PlaceHolder = RemoveHtml($this->namakegiatan->caption());

        // uraian
        $this->uraian->EditAttrs["class"] = "form-control";
        $this->uraian->EditCustomAttributes = "";
        if (!$this->uraian->Raw) {
            $this->uraian->CurrentValue = HtmlDecode($this->uraian->CurrentValue);
        }
        $this->uraian->EditValue = $this->uraian->CurrentValue;
        $this->uraian->PlaceHolder = RemoveHtml($this->uraian->caption());

        // tglmulai
        $this->tglmulai->EditAttrs["class"] = "form-control";
        $this->tglmulai->EditCustomAttributes = "";
        $this->tglmulai->EditValue = FormatDateTime($this->tglmulai->CurrentValue, 8);
        $this->tglmulai->PlaceHolder = RemoveHtml($this->tglmulai->caption());

        // tglakhir
        $this->tglakhir->EditAttrs["class"] = "form-control";
        $this->tglakhir->EditCustomAttributes = "";
        $this->tglakhir->EditValue = FormatDateTime($this->tglakhir->CurrentValue, 8);
        $this->tglakhir->PlaceHolder = RemoveHtml($this->tglakhir->caption());

        // narasumber
        $this->narasumber->EditAttrs["class"] = "form-control";
        $this->narasumber->EditCustomAttributes = "";
        if (!$this->narasumber->Raw) {
            $this->narasumber->CurrentValue = HtmlDecode($this->narasumber->CurrentValue);
        }
        $this->narasumber->EditValue = $this->narasumber->CurrentValue;
        $this->narasumber->PlaceHolder = RemoveHtml($this->narasumber->caption());

        // kontak_nama
        $this->kontak_nama->EditAttrs["class"] = "form-control";
        $this->kontak_nama->EditCustomAttributes = "";
        if (!$this->kontak_nama->Raw) {
            $this->kontak_nama->CurrentValue = HtmlDecode($this->kontak_nama->CurrentValue);
        }
        $this->kontak_nama->EditValue = $this->kontak_nama->CurrentValue;
        $this->kontak_nama->PlaceHolder = RemoveHtml($this->kontak_nama->caption());

        // kontak_hp
        $this->kontak_hp->EditAttrs["class"] = "form-control";
        $this->kontak_hp->EditCustomAttributes = "";
        if (!$this->kontak_hp->Raw) {
            $this->kontak_hp->CurrentValue = HtmlDecode($this->kontak_hp->CurrentValue);
        }
        $this->kontak_hp->EditValue = $this->kontak_hp->CurrentValue;
        $this->kontak_hp->PlaceHolder = RemoveHtml($this->kontak_hp->caption());

        // poster
        $this->poster->EditAttrs["class"] = "form-control";
        $this->poster->EditCustomAttributes = "";
        if (!$this->poster->Raw) {
            $this->poster->CurrentValue = HtmlDecode($this->poster->CurrentValue);
        }
        $this->poster->EditValue = $this->poster->CurrentValue;
        $this->poster->PlaceHolder = RemoveHtml($this->poster->caption());

        // postertipe
        $this->postertipe->EditAttrs["class"] = "form-control";
        $this->postertipe->EditCustomAttributes = "";
        if (!$this->postertipe->Raw) {
            $this->postertipe->CurrentValue = HtmlDecode($this->postertipe->CurrentValue);
        }
        $this->postertipe->EditValue = $this->postertipe->CurrentValue;
        $this->postertipe->PlaceHolder = RemoveHtml($this->postertipe->caption());

        // posterukuran
        $this->posterukuran->EditAttrs["class"] = "form-control";
        $this->posterukuran->EditCustomAttributes = "";
        $this->posterukuran->EditValue = $this->posterukuran->CurrentValue;
        $this->posterukuran->PlaceHolder = RemoveHtml($this->posterukuran->caption());

        // posterlebar
        $this->posterlebar->EditAttrs["class"] = "form-control";
        $this->posterlebar->EditCustomAttributes = "";
        $this->posterlebar->EditValue = $this->posterlebar->CurrentValue;
        $this->posterlebar->PlaceHolder = RemoveHtml($this->posterlebar->caption());

        // postertinggi
        $this->postertinggi->EditAttrs["class"] = "form-control";
        $this->postertinggi->EditCustomAttributes = "";
        $this->postertinggi->EditValue = $this->postertinggi->CurrentValue;
        $this->postertinggi->PlaceHolder = RemoveHtml($this->postertinggi->caption());

        // linkinfo
        $this->linkinfo->EditAttrs["class"] = "form-control";
        $this->linkinfo->EditCustomAttributes = "";
        if (!$this->linkinfo->Raw) {
            $this->linkinfo->CurrentValue = HtmlDecode($this->linkinfo->CurrentValue);
        }
        $this->linkinfo->EditValue = $this->linkinfo->CurrentValue;
        $this->linkinfo->PlaceHolder = RemoveHtml($this->linkinfo->caption());

        // peserta_kelas
        $this->peserta_kelas->EditAttrs["class"] = "form-control";
        $this->peserta_kelas->EditCustomAttributes = "";
        if (!$this->peserta_kelas->Raw) {
            $this->peserta_kelas->CurrentValue = HtmlDecode($this->peserta_kelas->CurrentValue);
        }
        $this->peserta_kelas->EditValue = $this->peserta_kelas->CurrentValue;
        $this->peserta_kelas->PlaceHolder = RemoveHtml($this->peserta_kelas->caption());

        // waktu
        $this->waktu->EditAttrs["class"] = "form-control";
        $this->waktu->EditCustomAttributes = "";
        $this->waktu->EditValue = FormatDateTime($this->waktu->CurrentValue, 8);
        $this->waktu->PlaceHolder = RemoveHtml($this->waktu->caption());

        // nik
        $this->nik->EditAttrs["class"] = "form-control";
        $this->nik->EditCustomAttributes = "";
        if (!$this->nik->Raw) {
            $this->nik->CurrentValue = HtmlDecode($this->nik->CurrentValue);
        }
        $this->nik->EditValue = $this->nik->CurrentValue;
        $this->nik->PlaceHolder = RemoveHtml($this->nik->caption());

        // status
        $this->status->EditAttrs["class"] = "form-control";
        $this->status->EditCustomAttributes = "";
        if (!$this->status->Raw) {
            $this->status->CurrentValue = HtmlDecode($this->status->CurrentValue);
        }
        $this->status->EditValue = $this->status->CurrentValue;
        $this->status->PlaceHolder = RemoveHtml($this->status->caption());

        // catatan
        $this->catatan->EditAttrs["class"] = "form-control";
        $this->catatan->EditCustomAttributes = "";
        if (!$this->catatan->Raw) {
            $this->catatan->CurrentValue = HtmlDecode($this->catatan->CurrentValue);
        }
        $this->catatan->EditValue = $this->catatan->CurrentValue;
        $this->catatan->PlaceHolder = RemoveHtml($this->catatan->caption());

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
                    $doc->exportCaption($this->id_binadata);
                    $doc->exportCaption($this->idperiode);
                    $doc->exportCaption($this->periode_tahun);
                    $doc->exportCaption($this->periode_bulan);
                    $doc->exportCaption($this->idkelompok);
                    $doc->exportCaption($this->kelompok_pembinaan);
                    $doc->exportCaption($this->namakegiatan);
                    $doc->exportCaption($this->uraian);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->tglakhir);
                    $doc->exportCaption($this->narasumber);
                    $doc->exportCaption($this->kontak_nama);
                    $doc->exportCaption($this->kontak_hp);
                    $doc->exportCaption($this->poster);
                    $doc->exportCaption($this->postertipe);
                    $doc->exportCaption($this->posterukuran);
                    $doc->exportCaption($this->posterlebar);
                    $doc->exportCaption($this->postertinggi);
                    $doc->exportCaption($this->linkinfo);
                    $doc->exportCaption($this->peserta_kelas);
                    $doc->exportCaption($this->waktu);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->catatan);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->id_binadata);
                    $doc->exportCaption($this->idperiode);
                    $doc->exportCaption($this->periode_tahun);
                    $doc->exportCaption($this->periode_bulan);
                    $doc->exportCaption($this->idkelompok);
                    $doc->exportCaption($this->kelompok_pembinaan);
                    $doc->exportCaption($this->namakegiatan);
                    $doc->exportCaption($this->uraian);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->tglakhir);
                    $doc->exportCaption($this->narasumber);
                    $doc->exportCaption($this->kontak_nama);
                    $doc->exportCaption($this->kontak_hp);
                    $doc->exportCaption($this->poster);
                    $doc->exportCaption($this->postertipe);
                    $doc->exportCaption($this->posterukuran);
                    $doc->exportCaption($this->posterlebar);
                    $doc->exportCaption($this->postertinggi);
                    $doc->exportCaption($this->linkinfo);
                    $doc->exportCaption($this->peserta_kelas);
                    $doc->exportCaption($this->waktu);
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->status);
                    $doc->exportCaption($this->catatan);
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
                        $doc->exportField($this->id_binadata);
                        $doc->exportField($this->idperiode);
                        $doc->exportField($this->periode_tahun);
                        $doc->exportField($this->periode_bulan);
                        $doc->exportField($this->idkelompok);
                        $doc->exportField($this->kelompok_pembinaan);
                        $doc->exportField($this->namakegiatan);
                        $doc->exportField($this->uraian);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->tglakhir);
                        $doc->exportField($this->narasumber);
                        $doc->exportField($this->kontak_nama);
                        $doc->exportField($this->kontak_hp);
                        $doc->exportField($this->poster);
                        $doc->exportField($this->postertipe);
                        $doc->exportField($this->posterukuran);
                        $doc->exportField($this->posterlebar);
                        $doc->exportField($this->postertinggi);
                        $doc->exportField($this->linkinfo);
                        $doc->exportField($this->peserta_kelas);
                        $doc->exportField($this->waktu);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->status);
                        $doc->exportField($this->catatan);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->id_binadata);
                        $doc->exportField($this->idperiode);
                        $doc->exportField($this->periode_tahun);
                        $doc->exportField($this->periode_bulan);
                        $doc->exportField($this->idkelompok);
                        $doc->exportField($this->kelompok_pembinaan);
                        $doc->exportField($this->namakegiatan);
                        $doc->exportField($this->uraian);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->tglakhir);
                        $doc->exportField($this->narasumber);
                        $doc->exportField($this->kontak_nama);
                        $doc->exportField($this->kontak_hp);
                        $doc->exportField($this->poster);
                        $doc->exportField($this->postertipe);
                        $doc->exportField($this->posterukuran);
                        $doc->exportField($this->posterlebar);
                        $doc->exportField($this->postertinggi);
                        $doc->exportField($this->linkinfo);
                        $doc->exportField($this->peserta_kelas);
                        $doc->exportField($this->waktu);
                        $doc->exportField($this->nik);
                        $doc->exportField($this->status);
                        $doc->exportField($this->catatan);
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
