<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for _cetak_profilumkmlengkap
 */
class CetakProfilumkmlengkap2 extends DbTable
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
    public $nama_usaha;
    public $prf_addbis;
    public $prf_addbi1;
    public $kabupaten;
    public $klasifikas;
    public $sektor_per;
    public $sektor_kbl;
    public $sektor_ekr;
    public $nama_lengk;
    public $jenis_kela;
    public $no_hp;
    public $pendidikan;
    public $disabilita;
    public $tglmulai;
    public $umurusaha;
    public $addbisnis;
    public $nilai_aset;
    public $omsetbulan;
    public $kegiatan_u;
    public $uraian_keg;
    public $emailusaha;
    public $akun_ig;
    public $akun_faceb;
    public $akun_gmb;
    public $url_websit;
    public $url_market;
    public $kelas;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = '_cetak_profilumkmlengkap2';
        $this->TableName = '_cetak_profilumkmlengkap';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`_cetak_profilumkmlengkap`";
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
        $this->nik = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_nik', 'nik', '`nik`', '`nik`', 200, 72, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // nama_usaha
        $this->nama_usaha = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_nama_usaha', 'nama_usaha', '`nama_usaha`', '`nama_usaha`', 201, -1, -1, false, '`nama_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->nama_usaha->Sortable = true; // Allow sort
        $this->nama_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_usaha->Param, "CustomMsg");
        $this->Fields['nama_usaha'] = &$this->nama_usaha;

        // prf_addbis
        $this->prf_addbis = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_prf_addbis', 'prf_addbis', '`prf_addbis`', '`prf_addbis`', 201, -1, -1, false, '`prf_addbis`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->prf_addbis->Sortable = true; // Allow sort
        $this->prf_addbis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prf_addbis->Param, "CustomMsg");
        $this->Fields['prf_addbis'] = &$this->prf_addbis;

        // prf_addbi1
        $this->prf_addbi1 = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_prf_addbi1', 'prf_addbi1', '`prf_addbi1`', '`prf_addbi1`', 201, -1, -1, false, '`prf_addbi1`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->prf_addbi1->Sortable = true; // Allow sort
        $this->prf_addbi1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prf_addbi1->Param, "CustomMsg");
        $this->Fields['prf_addbi1'] = &$this->prf_addbi1;

        // kabupaten
        $this->kabupaten = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_kabupaten', 'kabupaten', '`kabupaten`', '`kabupaten`', 201, -1, -1, false, '`kabupaten`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->kabupaten->Sortable = true; // Allow sort
        $this->kabupaten->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kabupaten->Param, "CustomMsg");
        $this->Fields['kabupaten'] = &$this->kabupaten;

        // klasifikas
        $this->klasifikas = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_klasifikas', 'klasifikas', '`klasifikas`', '`klasifikas`', 200, 60, -1, false, '`klasifikas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->klasifikas->Sortable = true; // Allow sort
        $this->klasifikas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->klasifikas->Param, "CustomMsg");
        $this->Fields['klasifikas'] = &$this->klasifikas;

        // sektor_per
        $this->sektor_per = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_sektor_per', 'sektor_per', '`sektor_per`', '`sektor_per`', 201, -1, -1, false, '`sektor_per`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->sektor_per->Sortable = true; // Allow sort
        $this->sektor_per->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_per->Param, "CustomMsg");
        $this->Fields['sektor_per'] = &$this->sektor_per;

        // sektor_kbl
        $this->sektor_kbl = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_sektor_kbl', 'sektor_kbl', '`sektor_kbl`', '`sektor_kbl`', 201, -1, -1, false, '`sektor_kbl`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->sektor_kbl->Sortable = true; // Allow sort
        $this->sektor_kbl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_kbl->Param, "CustomMsg");
        $this->Fields['sektor_kbl'] = &$this->sektor_kbl;

        // sektor_ekr
        $this->sektor_ekr = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_sektor_ekr', 'sektor_ekr', '`sektor_ekr`', '`sektor_ekr`', 201, -1, -1, false, '`sektor_ekr`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->sektor_ekr->Sortable = true; // Allow sort
        $this->sektor_ekr->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_ekr->Param, "CustomMsg");
        $this->Fields['sektor_ekr'] = &$this->sektor_ekr;

        // nama_lengk
        $this->nama_lengk = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_nama_lengk', 'nama_lengk', '`nama_lengk`', '`nama_lengk`', 201, -1, -1, false, '`nama_lengk`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->nama_lengk->Sortable = true; // Allow sort
        $this->nama_lengk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_lengk->Param, "CustomMsg");
        $this->Fields['nama_lengk'] = &$this->nama_lengk;

        // jenis_kela
        $this->jenis_kela = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_jenis_kela', 'jenis_kela', '`jenis_kela`', '`jenis_kela`', 200, 30, -1, false, '`jenis_kela`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jenis_kela->Sortable = true; // Allow sort
        $this->jenis_kela->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenis_kela->Param, "CustomMsg");
        $this->Fields['jenis_kela'] = &$this->jenis_kela;

        // no_hp
        $this->no_hp = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_no_hp', 'no_hp', '`no_hp`', '`no_hp`', 200, 90, -1, false, '`no_hp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_hp->Sortable = true; // Allow sort
        $this->no_hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_hp->Param, "CustomMsg");
        $this->Fields['no_hp'] = &$this->no_hp;

        // pendidikan
        $this->pendidikan = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_pendidikan', 'pendidikan', '`pendidikan`', '`pendidikan`', 200, 60, -1, false, '`pendidikan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pendidikan->Sortable = true; // Allow sort
        $this->pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pendidikan->Param, "CustomMsg");
        $this->Fields['pendidikan'] = &$this->pendidikan;

        // disabilita
        $this->disabilita = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_disabilita', 'disabilita', '`disabilita`', '`disabilita`', 200, 60, -1, false, '`disabilita`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->disabilita->Sortable = true; // Allow sort
        $this->disabilita->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->disabilita->Param, "CustomMsg");
        $this->Fields['disabilita'] = &$this->disabilita;

        // tglmulai
        $this->tglmulai = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_tglmulai', 'tglmulai', '`tglmulai`', CastDateFieldForLike("`tglmulai`", 0, "DB"), 133, 10, 0, false, '`tglmulai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tglmulai->Sortable = true; // Allow sort
        $this->tglmulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tglmulai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tglmulai->Param, "CustomMsg");
        $this->Fields['tglmulai'] = &$this->tglmulai;

        // umurusaha
        $this->umurusaha = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_umurusaha', 'umurusaha', '`umurusaha`', '`umurusaha`', 201, -1, -1, false, '`umurusaha`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->umurusaha->Sortable = true; // Allow sort
        $this->umurusaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->umurusaha->Param, "CustomMsg");
        $this->Fields['umurusaha'] = &$this->umurusaha;

        // addbisnis
        $this->addbisnis = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_addbisnis', 'addbisnis', '`addbisnis`', '`addbisnis`', 201, -1, -1, false, '`addbisnis`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->addbisnis->Sortable = true; // Allow sort
        $this->addbisnis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->addbisnis->Param, "CustomMsg");
        $this->Fields['addbisnis'] = &$this->addbisnis;

        // nilai_aset
        $this->nilai_aset = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_nilai_aset', 'nilai_aset', '`nilai_aset`', '`nilai_aset`', 20, 20, -1, false, '`nilai_aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nilai_aset->Sortable = true; // Allow sort
        $this->nilai_aset->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->nilai_aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai_aset->Param, "CustomMsg");
        $this->Fields['nilai_aset'] = &$this->nilai_aset;

        // omsetbulan
        $this->omsetbulan = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_omsetbulan', 'omsetbulan', '`omsetbulan`', '`omsetbulan`', 20, 20, -1, false, '`omsetbulan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omsetbulan->Sortable = true; // Allow sort
        $this->omsetbulan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->omsetbulan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omsetbulan->Param, "CustomMsg");
        $this->Fields['omsetbulan'] = &$this->omsetbulan;

        // kegiatan_u
        $this->kegiatan_u = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_kegiatan_u', 'kegiatan_u', '`kegiatan_u`', '`kegiatan_u`', 201, -1, -1, false, '`kegiatan_u`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->kegiatan_u->Sortable = true; // Allow sort
        $this->kegiatan_u->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kegiatan_u->Param, "CustomMsg");
        $this->Fields['kegiatan_u'] = &$this->kegiatan_u;

        // uraian_keg
        $this->uraian_keg = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_uraian_keg', 'uraian_keg', '`uraian_keg`', '`uraian_keg`', 201, -1, -1, false, '`uraian_keg`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->uraian_keg->Sortable = true; // Allow sort
        $this->uraian_keg->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->uraian_keg->Param, "CustomMsg");
        $this->Fields['uraian_keg'] = &$this->uraian_keg;

        // emailusaha
        $this->emailusaha = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_emailusaha', 'emailusaha', '`emailusaha`', '`emailusaha`', 200, 150, -1, false, '`emailusaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->emailusaha->Sortable = true; // Allow sort
        $this->emailusaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->emailusaha->Param, "CustomMsg");
        $this->Fields['emailusaha'] = &$this->emailusaha;

        // akun_ig
        $this->akun_ig = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_akun_ig', 'akun_ig', '`akun_ig`', '`akun_ig`', 200, 150, -1, false, '`akun_ig`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_ig->Sortable = true; // Allow sort
        $this->akun_ig->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_ig->Param, "CustomMsg");
        $this->Fields['akun_ig'] = &$this->akun_ig;

        // akun_faceb
        $this->akun_faceb = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_akun_faceb', 'akun_faceb', '`akun_faceb`', '`akun_faceb`', 200, 150, -1, false, '`akun_faceb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_faceb->Sortable = true; // Allow sort
        $this->akun_faceb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_faceb->Param, "CustomMsg");
        $this->Fields['akun_faceb'] = &$this->akun_faceb;

        // akun_gmb
        $this->akun_gmb = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_akun_gmb', 'akun_gmb', '`akun_gmb`', '`akun_gmb`', 200, 150, -1, false, '`akun_gmb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_gmb->Sortable = true; // Allow sort
        $this->akun_gmb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_gmb->Param, "CustomMsg");
        $this->Fields['akun_gmb'] = &$this->akun_gmb;

        // url_websit
        $this->url_websit = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_url_websit', 'url_websit', '`url_websit`', '`url_websit`', 200, 150, -1, false, '`url_websit`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->url_websit->Sortable = true; // Allow sort
        $this->url_websit->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->url_websit->Param, "CustomMsg");
        $this->Fields['url_websit'] = &$this->url_websit;

        // url_market
        $this->url_market = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_url_market', 'url_market', '`url_market`', '`url_market`', 201, -1, -1, false, '`url_market`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->url_market->Sortable = true; // Allow sort
        $this->url_market->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->url_market->Param, "CustomMsg");
        $this->Fields['url_market'] = &$this->url_market;

        // kelas
        $this->kelas = new DbField('_cetak_profilumkmlengkap2', '_cetak_profilumkmlengkap', 'x_kelas', 'kelas', '`kelas`', '`kelas`', 200, 60, -1, false, '`kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelas->Sortable = true; // Allow sort
        $this->kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelas->Param, "CustomMsg");
        $this->Fields['kelas'] = &$this->kelas;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`_cetak_profilumkmlengkap`";
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
        $this->nik->DbValue = $row['nik'];
        $this->nama_usaha->DbValue = $row['nama_usaha'];
        $this->prf_addbis->DbValue = $row['prf_addbis'];
        $this->prf_addbi1->DbValue = $row['prf_addbi1'];
        $this->kabupaten->DbValue = $row['kabupaten'];
        $this->klasifikas->DbValue = $row['klasifikas'];
        $this->sektor_per->DbValue = $row['sektor_per'];
        $this->sektor_kbl->DbValue = $row['sektor_kbl'];
        $this->sektor_ekr->DbValue = $row['sektor_ekr'];
        $this->nama_lengk->DbValue = $row['nama_lengk'];
        $this->jenis_kela->DbValue = $row['jenis_kela'];
        $this->no_hp->DbValue = $row['no_hp'];
        $this->pendidikan->DbValue = $row['pendidikan'];
        $this->disabilita->DbValue = $row['disabilita'];
        $this->tglmulai->DbValue = $row['tglmulai'];
        $this->umurusaha->DbValue = $row['umurusaha'];
        $this->addbisnis->DbValue = $row['addbisnis'];
        $this->nilai_aset->DbValue = $row['nilai_aset'];
        $this->omsetbulan->DbValue = $row['omsetbulan'];
        $this->kegiatan_u->DbValue = $row['kegiatan_u'];
        $this->uraian_keg->DbValue = $row['uraian_keg'];
        $this->emailusaha->DbValue = $row['emailusaha'];
        $this->akun_ig->DbValue = $row['akun_ig'];
        $this->akun_faceb->DbValue = $row['akun_faceb'];
        $this->akun_gmb->DbValue = $row['akun_gmb'];
        $this->url_websit->DbValue = $row['url_websit'];
        $this->url_market->DbValue = $row['url_market'];
        $this->kelas->DbValue = $row['kelas'];
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
        return $_SESSION[$name] ?? GetUrl("cetakprofilumkmlengkap2list");
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
        if ($pageName == "cetakprofilumkmlengkap2view") {
            return $Language->phrase("View");
        } elseif ($pageName == "cetakprofilumkmlengkap2edit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "cetakprofilumkmlengkap2add") {
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
                return "CetakProfilumkmlengkap2View";
            case Config("API_ADD_ACTION"):
                return "CetakProfilumkmlengkap2Add";
            case Config("API_EDIT_ACTION"):
                return "CetakProfilumkmlengkap2Edit";
            case Config("API_DELETE_ACTION"):
                return "CetakProfilumkmlengkap2Delete";
            case Config("API_LIST_ACTION"):
                return "CetakProfilumkmlengkap2List";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "cetakprofilumkmlengkap2list";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("cetakprofilumkmlengkap2view", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("cetakprofilumkmlengkap2view", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "cetakprofilumkmlengkap2add?" . $this->getUrlParm($parm);
        } else {
            $url = "cetakprofilumkmlengkap2add";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("cetakprofilumkmlengkap2edit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("cetakprofilumkmlengkap2add", $this->getUrlParm($parm));
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
        return $this->keyUrl("cetakprofilumkmlengkap2delete", $this->getUrlParm());
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
        $this->nik->setDbValue($row['nik']);
        $this->nama_usaha->setDbValue($row['nama_usaha']);
        $this->prf_addbis->setDbValue($row['prf_addbis']);
        $this->prf_addbi1->setDbValue($row['prf_addbi1']);
        $this->kabupaten->setDbValue($row['kabupaten']);
        $this->klasifikas->setDbValue($row['klasifikas']);
        $this->sektor_per->setDbValue($row['sektor_per']);
        $this->sektor_kbl->setDbValue($row['sektor_kbl']);
        $this->sektor_ekr->setDbValue($row['sektor_ekr']);
        $this->nama_lengk->setDbValue($row['nama_lengk']);
        $this->jenis_kela->setDbValue($row['jenis_kela']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->disabilita->setDbValue($row['disabilita']);
        $this->tglmulai->setDbValue($row['tglmulai']);
        $this->umurusaha->setDbValue($row['umurusaha']);
        $this->addbisnis->setDbValue($row['addbisnis']);
        $this->nilai_aset->setDbValue($row['nilai_aset']);
        $this->omsetbulan->setDbValue($row['omsetbulan']);
        $this->kegiatan_u->setDbValue($row['kegiatan_u']);
        $this->uraian_keg->setDbValue($row['uraian_keg']);
        $this->emailusaha->setDbValue($row['emailusaha']);
        $this->akun_ig->setDbValue($row['akun_ig']);
        $this->akun_faceb->setDbValue($row['akun_faceb']);
        $this->akun_gmb->setDbValue($row['akun_gmb']);
        $this->url_websit->setDbValue($row['url_websit']);
        $this->url_market->setDbValue($row['url_market']);
        $this->kelas->setDbValue($row['kelas']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // nama_usaha

        // prf_addbis

        // prf_addbi1

        // kabupaten

        // klasifikas

        // sektor_per

        // sektor_kbl

        // sektor_ekr

        // nama_lengk

        // jenis_kela

        // no_hp

        // pendidikan

        // disabilita

        // tglmulai

        // umurusaha

        // addbisnis

        // nilai_aset

        // omsetbulan

        // kegiatan_u

        // uraian_keg

        // emailusaha

        // akun_ig

        // akun_faceb

        // akun_gmb

        // url_websit

        // url_market

        // kelas

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // nama_usaha
        $this->nama_usaha->ViewValue = $this->nama_usaha->CurrentValue;
        $this->nama_usaha->ViewCustomAttributes = "";

        // prf_addbis
        $this->prf_addbis->ViewValue = $this->prf_addbis->CurrentValue;
        $this->prf_addbis->ViewCustomAttributes = "";

        // prf_addbi1
        $this->prf_addbi1->ViewValue = $this->prf_addbi1->CurrentValue;
        $this->prf_addbi1->ViewCustomAttributes = "";

        // kabupaten
        $this->kabupaten->ViewValue = $this->kabupaten->CurrentValue;
        $this->kabupaten->ViewCustomAttributes = "";

        // klasifikas
        $this->klasifikas->ViewValue = $this->klasifikas->CurrentValue;
        $this->klasifikas->ViewCustomAttributes = "";

        // sektor_per
        $this->sektor_per->ViewValue = $this->sektor_per->CurrentValue;
        $this->sektor_per->ViewCustomAttributes = "";

        // sektor_kbl
        $this->sektor_kbl->ViewValue = $this->sektor_kbl->CurrentValue;
        $this->sektor_kbl->ViewCustomAttributes = "";

        // sektor_ekr
        $this->sektor_ekr->ViewValue = $this->sektor_ekr->CurrentValue;
        $this->sektor_ekr->ViewCustomAttributes = "";

        // nama_lengk
        $this->nama_lengk->ViewValue = $this->nama_lengk->CurrentValue;
        $this->nama_lengk->ViewCustomAttributes = "";

        // jenis_kela
        $this->jenis_kela->ViewValue = $this->jenis_kela->CurrentValue;
        $this->jenis_kela->ViewCustomAttributes = "";

        // no_hp
        $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
        $this->no_hp->ViewCustomAttributes = "";

        // pendidikan
        $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->ViewCustomAttributes = "";

        // disabilita
        $this->disabilita->ViewValue = $this->disabilita->CurrentValue;
        $this->disabilita->ViewCustomAttributes = "";

        // tglmulai
        $this->tglmulai->ViewValue = $this->tglmulai->CurrentValue;
        $this->tglmulai->ViewValue = FormatDateTime($this->tglmulai->ViewValue, 0);
        $this->tglmulai->ViewCustomAttributes = "";

        // umurusaha
        $this->umurusaha->ViewValue = $this->umurusaha->CurrentValue;
        $this->umurusaha->ViewCustomAttributes = "";

        // addbisnis
        $this->addbisnis->ViewValue = $this->addbisnis->CurrentValue;
        $this->addbisnis->ViewCustomAttributes = "";

        // nilai_aset
        $this->nilai_aset->ViewValue = $this->nilai_aset->CurrentValue;
        $this->nilai_aset->ViewValue = FormatNumber($this->nilai_aset->ViewValue, 0, -2, -2, -2);
        $this->nilai_aset->ViewCustomAttributes = "";

        // omsetbulan
        $this->omsetbulan->ViewValue = $this->omsetbulan->CurrentValue;
        $this->omsetbulan->ViewValue = FormatNumber($this->omsetbulan->ViewValue, 0, -2, -2, -2);
        $this->omsetbulan->ViewCustomAttributes = "";

        // kegiatan_u
        $this->kegiatan_u->ViewValue = $this->kegiatan_u->CurrentValue;
        $this->kegiatan_u->ViewCustomAttributes = "";

        // uraian_keg
        $this->uraian_keg->ViewValue = $this->uraian_keg->CurrentValue;
        $this->uraian_keg->ViewCustomAttributes = "";

        // emailusaha
        $this->emailusaha->ViewValue = $this->emailusaha->CurrentValue;
        $this->emailusaha->ViewCustomAttributes = "";

        // akun_ig
        $this->akun_ig->ViewValue = $this->akun_ig->CurrentValue;
        $this->akun_ig->ViewCustomAttributes = "";

        // akun_faceb
        $this->akun_faceb->ViewValue = $this->akun_faceb->CurrentValue;
        $this->akun_faceb->ViewCustomAttributes = "";

        // akun_gmb
        $this->akun_gmb->ViewValue = $this->akun_gmb->CurrentValue;
        $this->akun_gmb->ViewCustomAttributes = "";

        // url_websit
        $this->url_websit->ViewValue = $this->url_websit->CurrentValue;
        $this->url_websit->ViewCustomAttributes = "";

        // url_market
        $this->url_market->ViewValue = $this->url_market->CurrentValue;
        $this->url_market->ViewCustomAttributes = "";

        // kelas
        $this->kelas->ViewValue = $this->kelas->CurrentValue;
        $this->kelas->ViewCustomAttributes = "";

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // nama_usaha
        $this->nama_usaha->LinkCustomAttributes = "";
        $this->nama_usaha->HrefValue = "";
        $this->nama_usaha->TooltipValue = "";

        // prf_addbis
        $this->prf_addbis->LinkCustomAttributes = "";
        $this->prf_addbis->HrefValue = "";
        $this->prf_addbis->TooltipValue = "";

        // prf_addbi1
        $this->prf_addbi1->LinkCustomAttributes = "";
        $this->prf_addbi1->HrefValue = "";
        $this->prf_addbi1->TooltipValue = "";

        // kabupaten
        $this->kabupaten->LinkCustomAttributes = "";
        $this->kabupaten->HrefValue = "";
        $this->kabupaten->TooltipValue = "";

        // klasifikas
        $this->klasifikas->LinkCustomAttributes = "";
        $this->klasifikas->HrefValue = "";
        $this->klasifikas->TooltipValue = "";

        // sektor_per
        $this->sektor_per->LinkCustomAttributes = "";
        $this->sektor_per->HrefValue = "";
        $this->sektor_per->TooltipValue = "";

        // sektor_kbl
        $this->sektor_kbl->LinkCustomAttributes = "";
        $this->sektor_kbl->HrefValue = "";
        $this->sektor_kbl->TooltipValue = "";

        // sektor_ekr
        $this->sektor_ekr->LinkCustomAttributes = "";
        $this->sektor_ekr->HrefValue = "";
        $this->sektor_ekr->TooltipValue = "";

        // nama_lengk
        $this->nama_lengk->LinkCustomAttributes = "";
        $this->nama_lengk->HrefValue = "";
        $this->nama_lengk->TooltipValue = "";

        // jenis_kela
        $this->jenis_kela->LinkCustomAttributes = "";
        $this->jenis_kela->HrefValue = "";
        $this->jenis_kela->TooltipValue = "";

        // no_hp
        $this->no_hp->LinkCustomAttributes = "";
        $this->no_hp->HrefValue = "";
        $this->no_hp->TooltipValue = "";

        // pendidikan
        $this->pendidikan->LinkCustomAttributes = "";
        $this->pendidikan->HrefValue = "";
        $this->pendidikan->TooltipValue = "";

        // disabilita
        $this->disabilita->LinkCustomAttributes = "";
        $this->disabilita->HrefValue = "";
        $this->disabilita->TooltipValue = "";

        // tglmulai
        $this->tglmulai->LinkCustomAttributes = "";
        $this->tglmulai->HrefValue = "";
        $this->tglmulai->TooltipValue = "";

        // umurusaha
        $this->umurusaha->LinkCustomAttributes = "";
        $this->umurusaha->HrefValue = "";
        $this->umurusaha->TooltipValue = "";

        // addbisnis
        $this->addbisnis->LinkCustomAttributes = "";
        $this->addbisnis->HrefValue = "";
        $this->addbisnis->TooltipValue = "";

        // nilai_aset
        $this->nilai_aset->LinkCustomAttributes = "";
        $this->nilai_aset->HrefValue = "";
        $this->nilai_aset->TooltipValue = "";

        // omsetbulan
        $this->omsetbulan->LinkCustomAttributes = "";
        $this->omsetbulan->HrefValue = "";
        $this->omsetbulan->TooltipValue = "";

        // kegiatan_u
        $this->kegiatan_u->LinkCustomAttributes = "";
        $this->kegiatan_u->HrefValue = "";
        $this->kegiatan_u->TooltipValue = "";

        // uraian_keg
        $this->uraian_keg->LinkCustomAttributes = "";
        $this->uraian_keg->HrefValue = "";
        $this->uraian_keg->TooltipValue = "";

        // emailusaha
        $this->emailusaha->LinkCustomAttributes = "";
        $this->emailusaha->HrefValue = "";
        $this->emailusaha->TooltipValue = "";

        // akun_ig
        $this->akun_ig->LinkCustomAttributes = "";
        $this->akun_ig->HrefValue = "";
        $this->akun_ig->TooltipValue = "";

        // akun_faceb
        $this->akun_faceb->LinkCustomAttributes = "";
        $this->akun_faceb->HrefValue = "";
        $this->akun_faceb->TooltipValue = "";

        // akun_gmb
        $this->akun_gmb->LinkCustomAttributes = "";
        $this->akun_gmb->HrefValue = "";
        $this->akun_gmb->TooltipValue = "";

        // url_websit
        $this->url_websit->LinkCustomAttributes = "";
        $this->url_websit->HrefValue = "";
        $this->url_websit->TooltipValue = "";

        // url_market
        $this->url_market->LinkCustomAttributes = "";
        $this->url_market->HrefValue = "";
        $this->url_market->TooltipValue = "";

        // kelas
        $this->kelas->LinkCustomAttributes = "";
        $this->kelas->HrefValue = "";
        $this->kelas->TooltipValue = "";

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

        // nama_usaha
        $this->nama_usaha->EditAttrs["class"] = "form-control";
        $this->nama_usaha->EditCustomAttributes = "";
        $this->nama_usaha->EditValue = $this->nama_usaha->CurrentValue;
        $this->nama_usaha->PlaceHolder = RemoveHtml($this->nama_usaha->caption());

        // prf_addbis
        $this->prf_addbis->EditAttrs["class"] = "form-control";
        $this->prf_addbis->EditCustomAttributes = "";
        $this->prf_addbis->EditValue = $this->prf_addbis->CurrentValue;
        $this->prf_addbis->PlaceHolder = RemoveHtml($this->prf_addbis->caption());

        // prf_addbi1
        $this->prf_addbi1->EditAttrs["class"] = "form-control";
        $this->prf_addbi1->EditCustomAttributes = "";
        $this->prf_addbi1->EditValue = $this->prf_addbi1->CurrentValue;
        $this->prf_addbi1->PlaceHolder = RemoveHtml($this->prf_addbi1->caption());

        // kabupaten
        $this->kabupaten->EditAttrs["class"] = "form-control";
        $this->kabupaten->EditCustomAttributes = "";
        $this->kabupaten->EditValue = $this->kabupaten->CurrentValue;
        $this->kabupaten->PlaceHolder = RemoveHtml($this->kabupaten->caption());

        // klasifikas
        $this->klasifikas->EditAttrs["class"] = "form-control";
        $this->klasifikas->EditCustomAttributes = "";
        if (!$this->klasifikas->Raw) {
            $this->klasifikas->CurrentValue = HtmlDecode($this->klasifikas->CurrentValue);
        }
        $this->klasifikas->EditValue = $this->klasifikas->CurrentValue;
        $this->klasifikas->PlaceHolder = RemoveHtml($this->klasifikas->caption());

        // sektor_per
        $this->sektor_per->EditAttrs["class"] = "form-control";
        $this->sektor_per->EditCustomAttributes = "";
        $this->sektor_per->EditValue = $this->sektor_per->CurrentValue;
        $this->sektor_per->PlaceHolder = RemoveHtml($this->sektor_per->caption());

        // sektor_kbl
        $this->sektor_kbl->EditAttrs["class"] = "form-control";
        $this->sektor_kbl->EditCustomAttributes = "";
        $this->sektor_kbl->EditValue = $this->sektor_kbl->CurrentValue;
        $this->sektor_kbl->PlaceHolder = RemoveHtml($this->sektor_kbl->caption());

        // sektor_ekr
        $this->sektor_ekr->EditAttrs["class"] = "form-control";
        $this->sektor_ekr->EditCustomAttributes = "";
        $this->sektor_ekr->EditValue = $this->sektor_ekr->CurrentValue;
        $this->sektor_ekr->PlaceHolder = RemoveHtml($this->sektor_ekr->caption());

        // nama_lengk
        $this->nama_lengk->EditAttrs["class"] = "form-control";
        $this->nama_lengk->EditCustomAttributes = "";
        $this->nama_lengk->EditValue = $this->nama_lengk->CurrentValue;
        $this->nama_lengk->PlaceHolder = RemoveHtml($this->nama_lengk->caption());

        // jenis_kela
        $this->jenis_kela->EditAttrs["class"] = "form-control";
        $this->jenis_kela->EditCustomAttributes = "";
        if (!$this->jenis_kela->Raw) {
            $this->jenis_kela->CurrentValue = HtmlDecode($this->jenis_kela->CurrentValue);
        }
        $this->jenis_kela->EditValue = $this->jenis_kela->CurrentValue;
        $this->jenis_kela->PlaceHolder = RemoveHtml($this->jenis_kela->caption());

        // no_hp
        $this->no_hp->EditAttrs["class"] = "form-control";
        $this->no_hp->EditCustomAttributes = "";
        if (!$this->no_hp->Raw) {
            $this->no_hp->CurrentValue = HtmlDecode($this->no_hp->CurrentValue);
        }
        $this->no_hp->EditValue = $this->no_hp->CurrentValue;
        $this->no_hp->PlaceHolder = RemoveHtml($this->no_hp->caption());

        // pendidikan
        $this->pendidikan->EditAttrs["class"] = "form-control";
        $this->pendidikan->EditCustomAttributes = "";
        if (!$this->pendidikan->Raw) {
            $this->pendidikan->CurrentValue = HtmlDecode($this->pendidikan->CurrentValue);
        }
        $this->pendidikan->EditValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->PlaceHolder = RemoveHtml($this->pendidikan->caption());

        // disabilita
        $this->disabilita->EditAttrs["class"] = "form-control";
        $this->disabilita->EditCustomAttributes = "";
        if (!$this->disabilita->Raw) {
            $this->disabilita->CurrentValue = HtmlDecode($this->disabilita->CurrentValue);
        }
        $this->disabilita->EditValue = $this->disabilita->CurrentValue;
        $this->disabilita->PlaceHolder = RemoveHtml($this->disabilita->caption());

        // tglmulai
        $this->tglmulai->EditAttrs["class"] = "form-control";
        $this->tglmulai->EditCustomAttributes = "";
        $this->tglmulai->EditValue = FormatDateTime($this->tglmulai->CurrentValue, 8);
        $this->tglmulai->PlaceHolder = RemoveHtml($this->tglmulai->caption());

        // umurusaha
        $this->umurusaha->EditAttrs["class"] = "form-control";
        $this->umurusaha->EditCustomAttributes = "";
        $this->umurusaha->EditValue = $this->umurusaha->CurrentValue;
        $this->umurusaha->PlaceHolder = RemoveHtml($this->umurusaha->caption());

        // addbisnis
        $this->addbisnis->EditAttrs["class"] = "form-control";
        $this->addbisnis->EditCustomAttributes = "";
        $this->addbisnis->EditValue = $this->addbisnis->CurrentValue;
        $this->addbisnis->PlaceHolder = RemoveHtml($this->addbisnis->caption());

        // nilai_aset
        $this->nilai_aset->EditAttrs["class"] = "form-control";
        $this->nilai_aset->EditCustomAttributes = "";
        $this->nilai_aset->EditValue = $this->nilai_aset->CurrentValue;
        $this->nilai_aset->PlaceHolder = RemoveHtml($this->nilai_aset->caption());

        // omsetbulan
        $this->omsetbulan->EditAttrs["class"] = "form-control";
        $this->omsetbulan->EditCustomAttributes = "";
        $this->omsetbulan->EditValue = $this->omsetbulan->CurrentValue;
        $this->omsetbulan->PlaceHolder = RemoveHtml($this->omsetbulan->caption());

        // kegiatan_u
        $this->kegiatan_u->EditAttrs["class"] = "form-control";
        $this->kegiatan_u->EditCustomAttributes = "";
        $this->kegiatan_u->EditValue = $this->kegiatan_u->CurrentValue;
        $this->kegiatan_u->PlaceHolder = RemoveHtml($this->kegiatan_u->caption());

        // uraian_keg
        $this->uraian_keg->EditAttrs["class"] = "form-control";
        $this->uraian_keg->EditCustomAttributes = "";
        $this->uraian_keg->EditValue = $this->uraian_keg->CurrentValue;
        $this->uraian_keg->PlaceHolder = RemoveHtml($this->uraian_keg->caption());

        // emailusaha
        $this->emailusaha->EditAttrs["class"] = "form-control";
        $this->emailusaha->EditCustomAttributes = "";
        if (!$this->emailusaha->Raw) {
            $this->emailusaha->CurrentValue = HtmlDecode($this->emailusaha->CurrentValue);
        }
        $this->emailusaha->EditValue = $this->emailusaha->CurrentValue;
        $this->emailusaha->PlaceHolder = RemoveHtml($this->emailusaha->caption());

        // akun_ig
        $this->akun_ig->EditAttrs["class"] = "form-control";
        $this->akun_ig->EditCustomAttributes = "";
        if (!$this->akun_ig->Raw) {
            $this->akun_ig->CurrentValue = HtmlDecode($this->akun_ig->CurrentValue);
        }
        $this->akun_ig->EditValue = $this->akun_ig->CurrentValue;
        $this->akun_ig->PlaceHolder = RemoveHtml($this->akun_ig->caption());

        // akun_faceb
        $this->akun_faceb->EditAttrs["class"] = "form-control";
        $this->akun_faceb->EditCustomAttributes = "";
        if (!$this->akun_faceb->Raw) {
            $this->akun_faceb->CurrentValue = HtmlDecode($this->akun_faceb->CurrentValue);
        }
        $this->akun_faceb->EditValue = $this->akun_faceb->CurrentValue;
        $this->akun_faceb->PlaceHolder = RemoveHtml($this->akun_faceb->caption());

        // akun_gmb
        $this->akun_gmb->EditAttrs["class"] = "form-control";
        $this->akun_gmb->EditCustomAttributes = "";
        if (!$this->akun_gmb->Raw) {
            $this->akun_gmb->CurrentValue = HtmlDecode($this->akun_gmb->CurrentValue);
        }
        $this->akun_gmb->EditValue = $this->akun_gmb->CurrentValue;
        $this->akun_gmb->PlaceHolder = RemoveHtml($this->akun_gmb->caption());

        // url_websit
        $this->url_websit->EditAttrs["class"] = "form-control";
        $this->url_websit->EditCustomAttributes = "";
        if (!$this->url_websit->Raw) {
            $this->url_websit->CurrentValue = HtmlDecode($this->url_websit->CurrentValue);
        }
        $this->url_websit->EditValue = $this->url_websit->CurrentValue;
        $this->url_websit->PlaceHolder = RemoveHtml($this->url_websit->caption());

        // url_market
        $this->url_market->EditAttrs["class"] = "form-control";
        $this->url_market->EditCustomAttributes = "";
        $this->url_market->EditValue = $this->url_market->CurrentValue;
        $this->url_market->PlaceHolder = RemoveHtml($this->url_market->caption());

        // kelas
        $this->kelas->EditAttrs["class"] = "form-control";
        $this->kelas->EditCustomAttributes = "";
        if (!$this->kelas->Raw) {
            $this->kelas->CurrentValue = HtmlDecode($this->kelas->CurrentValue);
        }
        $this->kelas->EditValue = $this->kelas->CurrentValue;
        $this->kelas->PlaceHolder = RemoveHtml($this->kelas->caption());

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
                    $doc->exportCaption($this->nama_usaha);
                    $doc->exportCaption($this->prf_addbis);
                    $doc->exportCaption($this->prf_addbi1);
                    $doc->exportCaption($this->kabupaten);
                    $doc->exportCaption($this->klasifikas);
                    $doc->exportCaption($this->sektor_per);
                    $doc->exportCaption($this->sektor_kbl);
                    $doc->exportCaption($this->sektor_ekr);
                    $doc->exportCaption($this->nama_lengk);
                    $doc->exportCaption($this->jenis_kela);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->disabilita);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->umurusaha);
                    $doc->exportCaption($this->addbisnis);
                    $doc->exportCaption($this->nilai_aset);
                    $doc->exportCaption($this->omsetbulan);
                    $doc->exportCaption($this->kegiatan_u);
                    $doc->exportCaption($this->uraian_keg);
                    $doc->exportCaption($this->emailusaha);
                    $doc->exportCaption($this->akun_ig);
                    $doc->exportCaption($this->akun_faceb);
                    $doc->exportCaption($this->akun_gmb);
                    $doc->exportCaption($this->url_websit);
                    $doc->exportCaption($this->url_market);
                    $doc->exportCaption($this->kelas);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->klasifikas);
                    $doc->exportCaption($this->jenis_kela);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->disabilita);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->nilai_aset);
                    $doc->exportCaption($this->omsetbulan);
                    $doc->exportCaption($this->emailusaha);
                    $doc->exportCaption($this->akun_ig);
                    $doc->exportCaption($this->akun_faceb);
                    $doc->exportCaption($this->akun_gmb);
                    $doc->exportCaption($this->url_websit);
                    $doc->exportCaption($this->kelas);
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
                        $doc->exportField($this->nama_usaha);
                        $doc->exportField($this->prf_addbis);
                        $doc->exportField($this->prf_addbi1);
                        $doc->exportField($this->kabupaten);
                        $doc->exportField($this->klasifikas);
                        $doc->exportField($this->sektor_per);
                        $doc->exportField($this->sektor_kbl);
                        $doc->exportField($this->sektor_ekr);
                        $doc->exportField($this->nama_lengk);
                        $doc->exportField($this->jenis_kela);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->disabilita);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->umurusaha);
                        $doc->exportField($this->addbisnis);
                        $doc->exportField($this->nilai_aset);
                        $doc->exportField($this->omsetbulan);
                        $doc->exportField($this->kegiatan_u);
                        $doc->exportField($this->uraian_keg);
                        $doc->exportField($this->emailusaha);
                        $doc->exportField($this->akun_ig);
                        $doc->exportField($this->akun_faceb);
                        $doc->exportField($this->akun_gmb);
                        $doc->exportField($this->url_websit);
                        $doc->exportField($this->url_market);
                        $doc->exportField($this->kelas);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->klasifikas);
                        $doc->exportField($this->jenis_kela);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->disabilita);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->nilai_aset);
                        $doc->exportField($this->omsetbulan);
                        $doc->exportField($this->emailusaha);
                        $doc->exportField($this->akun_ig);
                        $doc->exportField($this->akun_faceb);
                        $doc->exportField($this->akun_gmb);
                        $doc->exportField($this->url_websit);
                        $doc->exportField($this->kelas);
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
