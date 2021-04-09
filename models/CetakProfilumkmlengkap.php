<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for cetak_profilumkmlengkap
 */
class CetakProfilumkmlengkap extends DbTable
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
    public $prf_addbisnis_kel;
    public $prf_addbisnis_kec;
    public $kabupaten;
    public $klasifikasi_usaha;
    public $sektor_pergub;
    public $sektor_kbli;
    public $sektor_ekraf;
    public $nama_lengkap;
    public $jenis_kelamin;
    public $no_hp;
    public $pendidikan;
    public $disabilitas;
    public $tglmulai;
    public $umurusaha;
    public $addbisnis;
    public $nilai_aset;
    public $omsetbulan;
    public $kegiatan_usaha;
    public $uraian_kegiatan;
    public $emailusaha;
    public $akun_ig;
    public $akun_facebook;
    public $akun_gmb;
    public $url_website;
    public $url_marketplace;
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
        $this->TableVar = 'cetak_profilumkmlengkap';
        $this->TableName = 'cetak_profilumkmlengkap';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`cetak_profilumkmlengkap`";
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
        $this->nik = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_nik', 'nik', '`nik`', '`nik`', 200, 24, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // nama_usaha
        $this->nama_usaha = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_nama_usaha', 'nama_usaha', '`nama_usaha`', '`nama_usaha`', 200, 100, -1, false, '`nama_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_usaha->Nullable = false; // NOT NULL field
        $this->nama_usaha->Required = true; // Required field
        $this->nama_usaha->Sortable = true; // Allow sort
        $this->nama_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_usaha->Param, "CustomMsg");
        $this->Fields['nama_usaha'] = &$this->nama_usaha;

        // prf_addbisnis_kel
        $this->prf_addbisnis_kel = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_prf_addbisnis_kel', 'prf_addbisnis_kel', '`prf_addbisnis_kel`', '`prf_addbisnis_kel`', 200, 255, -1, false, '`prf_addbisnis_kel`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->prf_addbisnis_kel->Sortable = true; // Allow sort
        $this->prf_addbisnis_kel->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prf_addbisnis_kel->Param, "CustomMsg");
        $this->Fields['prf_addbisnis_kel'] = &$this->prf_addbisnis_kel;

        // prf_addbisnis_kec
        $this->prf_addbisnis_kec = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_prf_addbisnis_kec', 'prf_addbisnis_kec', '`prf_addbisnis_kec`', '`prf_addbisnis_kec`', 200, 255, -1, false, '`prf_addbisnis_kec`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->prf_addbisnis_kec->Sortable = true; // Allow sort
        $this->prf_addbisnis_kec->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->prf_addbisnis_kec->Param, "CustomMsg");
        $this->Fields['prf_addbisnis_kec'] = &$this->prf_addbisnis_kec;

        // kabupaten
        $this->kabupaten = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_kabupaten', 'kabupaten', '`kabupaten`', '`kabupaten`', 200, 255, -1, false, '`kabupaten`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kabupaten->Sortable = true; // Allow sort
        $this->kabupaten->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kabupaten->Param, "CustomMsg");
        $this->Fields['kabupaten'] = &$this->kabupaten;

        // klasifikasi_usaha
        $this->klasifikasi_usaha = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_klasifikasi_usaha', 'klasifikasi_usaha', '`klasifikasi_usaha`', '`klasifikasi_usaha`', 200, 20, -1, false, '`klasifikasi_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->klasifikasi_usaha->Nullable = false; // NOT NULL field
        $this->klasifikasi_usaha->Required = true; // Required field
        $this->klasifikasi_usaha->Sortable = true; // Allow sort
        $this->klasifikasi_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->klasifikasi_usaha->Param, "CustomMsg");
        $this->Fields['klasifikasi_usaha'] = &$this->klasifikasi_usaha;

        // sektor_pergub
        $this->sektor_pergub = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_sektor_pergub', 'sektor_pergub', '`sektor_pergub`', '`sektor_pergub`', 200, 200, -1, false, '`sektor_pergub`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sektor_pergub->Sortable = true; // Allow sort
        $this->sektor_pergub->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_pergub->Param, "CustomMsg");
        $this->Fields['sektor_pergub'] = &$this->sektor_pergub;

        // sektor_kbli
        $this->sektor_kbli = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_sektor_kbli', 'sektor_kbli', '`sektor_kbli`', '`sektor_kbli`', 200, 200, -1, false, '`sektor_kbli`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sektor_kbli->Sortable = true; // Allow sort
        $this->sektor_kbli->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_kbli->Param, "CustomMsg");
        $this->Fields['sektor_kbli'] = &$this->sektor_kbli;

        // sektor_ekraf
        $this->sektor_ekraf = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_sektor_ekraf', 'sektor_ekraf', '`sektor_ekraf`', '`sektor_ekraf`', 200, 200, -1, false, '`sektor_ekraf`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->sektor_ekraf->Sortable = true; // Allow sort
        $this->sektor_ekraf->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->sektor_ekraf->Param, "CustomMsg");
        $this->Fields['sektor_ekraf'] = &$this->sektor_ekraf;

        // nama_lengkap
        $this->nama_lengkap = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_nama_lengkap', 'nama_lengkap', '`nama_lengkap`', '`nama_lengkap`', 200, 100, -1, false, '`nama_lengkap`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_lengkap->Sortable = true; // Allow sort
        $this->nama_lengkap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_lengkap->Param, "CustomMsg");
        $this->Fields['nama_lengkap'] = &$this->nama_lengkap;

        // jenis_kelamin
        $this->jenis_kelamin = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_jenis_kelamin', 'jenis_kelamin', '`jenis_kelamin`', '`jenis_kelamin`', 200, 10, -1, false, '`jenis_kelamin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jenis_kelamin->Sortable = true; // Allow sort
        $this->jenis_kelamin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jenis_kelamin->Param, "CustomMsg");
        $this->Fields['jenis_kelamin'] = &$this->jenis_kelamin;

        // no_hp
        $this->no_hp = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_no_hp', 'no_hp', '`no_hp`', '`no_hp`', 200, 30, -1, false, '`no_hp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->no_hp->Sortable = true; // Allow sort
        $this->no_hp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->no_hp->Param, "CustomMsg");
        $this->Fields['no_hp'] = &$this->no_hp;

        // pendidikan
        $this->pendidikan = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_pendidikan', 'pendidikan', '`pendidikan`', '`pendidikan`', 200, 20, -1, false, '`pendidikan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pendidikan->Sortable = true; // Allow sort
        $this->pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pendidikan->Param, "CustomMsg");
        $this->Fields['pendidikan'] = &$this->pendidikan;

        // disabilitas
        $this->disabilitas = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_disabilitas', 'disabilitas', '`disabilitas`', '`disabilitas`', 200, 20, -1, false, '`disabilitas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->disabilitas->Sortable = true; // Allow sort
        $this->disabilitas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->disabilitas->Param, "CustomMsg");
        $this->Fields['disabilitas'] = &$this->disabilitas;

        // tglmulai
        $this->tglmulai = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_tglmulai', 'tglmulai', '`tglmulai`', CastDateFieldForLike("`tglmulai`", 0, "DB"), 133, 10, 0, false, '`tglmulai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tglmulai->Nullable = false; // NOT NULL field
        $this->tglmulai->Required = true; // Required field
        $this->tglmulai->Sortable = true; // Allow sort
        $this->tglmulai->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tglmulai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tglmulai->Param, "CustomMsg");
        $this->Fields['tglmulai'] = &$this->tglmulai;

        // umurusaha
        $this->umurusaha = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_umurusaha', 'umurusaha', '`umurusaha`', '`umurusaha`', 200, 200, -1, false, '`umurusaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->umurusaha->Sortable = true; // Allow sort
        $this->umurusaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->umurusaha->Param, "CustomMsg");
        $this->Fields['umurusaha'] = &$this->umurusaha;

        // addbisnis
        $this->addbisnis = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_addbisnis', 'addbisnis', '`addbisnis`', '`addbisnis`', 200, 255, -1, false, '`addbisnis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->addbisnis->Nullable = false; // NOT NULL field
        $this->addbisnis->Required = true; // Required field
        $this->addbisnis->Sortable = true; // Allow sort
        $this->addbisnis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->addbisnis->Param, "CustomMsg");
        $this->Fields['addbisnis'] = &$this->addbisnis;

        // nilai_aset
        $this->nilai_aset = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_nilai_aset', 'nilai_aset', '`nilai_aset`', '`nilai_aset`', 5, 22, -1, false, '`nilai_aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nilai_aset->Nullable = false; // NOT NULL field
        $this->nilai_aset->Sortable = true; // Allow sort
        $this->nilai_aset->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->nilai_aset->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->nilai_aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nilai_aset->Param, "CustomMsg");
        $this->Fields['nilai_aset'] = &$this->nilai_aset;

        // omsetbulan
        $this->omsetbulan = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_omsetbulan', 'omsetbulan', '`omsetbulan`', '`omsetbulan`', 5, 22, -1, false, '`omsetbulan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->omsetbulan->Nullable = false; // NOT NULL field
        $this->omsetbulan->Sortable = true; // Allow sort
        $this->omsetbulan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->omsetbulan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->omsetbulan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->omsetbulan->Param, "CustomMsg");
        $this->Fields['omsetbulan'] = &$this->omsetbulan;

        // kegiatan_usaha
        $this->kegiatan_usaha = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_kegiatan_usaha', 'kegiatan_usaha', '`kegiatan_usaha`', '`kegiatan_usaha`', 200, 100, -1, false, '`kegiatan_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kegiatan_usaha->Nullable = false; // NOT NULL field
        $this->kegiatan_usaha->Required = true; // Required field
        $this->kegiatan_usaha->Sortable = true; // Allow sort
        $this->kegiatan_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kegiatan_usaha->Param, "CustomMsg");
        $this->Fields['kegiatan_usaha'] = &$this->kegiatan_usaha;

        // uraian_kegiatan
        $this->uraian_kegiatan = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_uraian_kegiatan', 'uraian_kegiatan', '`uraian_kegiatan`', '`uraian_kegiatan`', 200, 255, -1, false, '`uraian_kegiatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->uraian_kegiatan->Nullable = false; // NOT NULL field
        $this->uraian_kegiatan->Required = true; // Required field
        $this->uraian_kegiatan->Sortable = true; // Allow sort
        $this->uraian_kegiatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->uraian_kegiatan->Param, "CustomMsg");
        $this->Fields['uraian_kegiatan'] = &$this->uraian_kegiatan;

        // emailusaha
        $this->emailusaha = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_emailusaha', 'emailusaha', '`emailusaha`', '`emailusaha`', 200, 50, -1, false, '`emailusaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->emailusaha->Sortable = true; // Allow sort
        $this->emailusaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->emailusaha->Param, "CustomMsg");
        $this->Fields['emailusaha'] = &$this->emailusaha;

        // akun_ig
        $this->akun_ig = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_akun_ig', 'akun_ig', '`akun_ig`', '`akun_ig`', 200, 50, -1, false, '`akun_ig`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_ig->Sortable = true; // Allow sort
        $this->akun_ig->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_ig->Param, "CustomMsg");
        $this->Fields['akun_ig'] = &$this->akun_ig;

        // akun_facebook
        $this->akun_facebook = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_akun_facebook', 'akun_facebook', '`akun_facebook`', '`akun_facebook`', 200, 50, -1, false, '`akun_facebook`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_facebook->Sortable = true; // Allow sort
        $this->akun_facebook->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_facebook->Param, "CustomMsg");
        $this->Fields['akun_facebook'] = &$this->akun_facebook;

        // akun_gmb
        $this->akun_gmb = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_akun_gmb', 'akun_gmb', '`akun_gmb`', '`akun_gmb`', 200, 50, -1, false, '`akun_gmb`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akun_gmb->Sortable = true; // Allow sort
        $this->akun_gmb->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akun_gmb->Param, "CustomMsg");
        $this->Fields['akun_gmb'] = &$this->akun_gmb;

        // url_website
        $this->url_website = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_url_website', 'url_website', '`url_website`', '`url_website`', 200, 50, -1, false, '`url_website`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->url_website->Sortable = true; // Allow sort
        $this->url_website->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->url_website->Param, "CustomMsg");
        $this->Fields['url_website'] = &$this->url_website;

        // url_marketplace
        $this->url_marketplace = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_url_marketplace', 'url_marketplace', '`url_marketplace`', '`url_marketplace`', 200, 100, -1, false, '`url_marketplace`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->url_marketplace->Sortable = true; // Allow sort
        $this->url_marketplace->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->url_marketplace->Param, "CustomMsg");
        $this->Fields['url_marketplace'] = &$this->url_marketplace;

        // kelas
        $this->kelas = new DbField('cetak_profilumkmlengkap', 'cetak_profilumkmlengkap', 'x_kelas', 'kelas', '`kelas`', '`kelas`', 200, 20, -1, false, '`kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`cetak_profilumkmlengkap`";
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
        $this->prf_addbisnis_kel->DbValue = $row['prf_addbisnis_kel'];
        $this->prf_addbisnis_kec->DbValue = $row['prf_addbisnis_kec'];
        $this->kabupaten->DbValue = $row['kabupaten'];
        $this->klasifikasi_usaha->DbValue = $row['klasifikasi_usaha'];
        $this->sektor_pergub->DbValue = $row['sektor_pergub'];
        $this->sektor_kbli->DbValue = $row['sektor_kbli'];
        $this->sektor_ekraf->DbValue = $row['sektor_ekraf'];
        $this->nama_lengkap->DbValue = $row['nama_lengkap'];
        $this->jenis_kelamin->DbValue = $row['jenis_kelamin'];
        $this->no_hp->DbValue = $row['no_hp'];
        $this->pendidikan->DbValue = $row['pendidikan'];
        $this->disabilitas->DbValue = $row['disabilitas'];
        $this->tglmulai->DbValue = $row['tglmulai'];
        $this->umurusaha->DbValue = $row['umurusaha'];
        $this->addbisnis->DbValue = $row['addbisnis'];
        $this->nilai_aset->DbValue = $row['nilai_aset'];
        $this->omsetbulan->DbValue = $row['omsetbulan'];
        $this->kegiatan_usaha->DbValue = $row['kegiatan_usaha'];
        $this->uraian_kegiatan->DbValue = $row['uraian_kegiatan'];
        $this->emailusaha->DbValue = $row['emailusaha'];
        $this->akun_ig->DbValue = $row['akun_ig'];
        $this->akun_facebook->DbValue = $row['akun_facebook'];
        $this->akun_gmb->DbValue = $row['akun_gmb'];
        $this->url_website->DbValue = $row['url_website'];
        $this->url_marketplace->DbValue = $row['url_marketplace'];
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
        return $_SESSION[$name] ?? GetUrl("cetakprofilumkmlengkaplist");
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
        if ($pageName == "cetakprofilumkmlengkapview") {
            return $Language->phrase("View");
        } elseif ($pageName == "cetakprofilumkmlengkapedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "cetakprofilumkmlengkapadd") {
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
                return "CetakProfilumkmlengkapView";
            case Config("API_ADD_ACTION"):
                return "CetakProfilumkmlengkapAdd";
            case Config("API_EDIT_ACTION"):
                return "CetakProfilumkmlengkapEdit";
            case Config("API_DELETE_ACTION"):
                return "CetakProfilumkmlengkapDelete";
            case Config("API_LIST_ACTION"):
                return "CetakProfilumkmlengkapList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "cetakprofilumkmlengkaplist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("cetakprofilumkmlengkapview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("cetakprofilumkmlengkapview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "cetakprofilumkmlengkapadd?" . $this->getUrlParm($parm);
        } else {
            $url = "cetakprofilumkmlengkapadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("cetakprofilumkmlengkapedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("cetakprofilumkmlengkapadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("cetakprofilumkmlengkapdelete", $this->getUrlParm());
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
        $this->prf_addbisnis_kel->setDbValue($row['prf_addbisnis_kel']);
        $this->prf_addbisnis_kec->setDbValue($row['prf_addbisnis_kec']);
        $this->kabupaten->setDbValue($row['kabupaten']);
        $this->klasifikasi_usaha->setDbValue($row['klasifikasi_usaha']);
        $this->sektor_pergub->setDbValue($row['sektor_pergub']);
        $this->sektor_kbli->setDbValue($row['sektor_kbli']);
        $this->sektor_ekraf->setDbValue($row['sektor_ekraf']);
        $this->nama_lengkap->setDbValue($row['nama_lengkap']);
        $this->jenis_kelamin->setDbValue($row['jenis_kelamin']);
        $this->no_hp->setDbValue($row['no_hp']);
        $this->pendidikan->setDbValue($row['pendidikan']);
        $this->disabilitas->setDbValue($row['disabilitas']);
        $this->tglmulai->setDbValue($row['tglmulai']);
        $this->umurusaha->setDbValue($row['umurusaha']);
        $this->addbisnis->setDbValue($row['addbisnis']);
        $this->nilai_aset->setDbValue($row['nilai_aset']);
        $this->omsetbulan->setDbValue($row['omsetbulan']);
        $this->kegiatan_usaha->setDbValue($row['kegiatan_usaha']);
        $this->uraian_kegiatan->setDbValue($row['uraian_kegiatan']);
        $this->emailusaha->setDbValue($row['emailusaha']);
        $this->akun_ig->setDbValue($row['akun_ig']);
        $this->akun_facebook->setDbValue($row['akun_facebook']);
        $this->akun_gmb->setDbValue($row['akun_gmb']);
        $this->url_website->setDbValue($row['url_website']);
        $this->url_marketplace->setDbValue($row['url_marketplace']);
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

        // prf_addbisnis_kel

        // prf_addbisnis_kec

        // kabupaten

        // klasifikasi_usaha

        // sektor_pergub

        // sektor_kbli

        // sektor_ekraf

        // nama_lengkap

        // jenis_kelamin

        // no_hp

        // pendidikan

        // disabilitas

        // tglmulai

        // umurusaha

        // addbisnis

        // nilai_aset

        // omsetbulan

        // kegiatan_usaha

        // uraian_kegiatan

        // emailusaha

        // akun_ig

        // akun_facebook

        // akun_gmb

        // url_website

        // url_marketplace

        // kelas

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // nama_usaha
        $this->nama_usaha->ViewValue = $this->nama_usaha->CurrentValue;
        $this->nama_usaha->ViewCustomAttributes = "";

        // prf_addbisnis_kel
        $this->prf_addbisnis_kel->ViewValue = $this->prf_addbisnis_kel->CurrentValue;
        $this->prf_addbisnis_kel->ViewCustomAttributes = "";

        // prf_addbisnis_kec
        $this->prf_addbisnis_kec->ViewValue = $this->prf_addbisnis_kec->CurrentValue;
        $this->prf_addbisnis_kec->ViewCustomAttributes = "";

        // kabupaten
        $this->kabupaten->ViewValue = $this->kabupaten->CurrentValue;
        $this->kabupaten->ViewCustomAttributes = "";

        // klasifikasi_usaha
        $this->klasifikasi_usaha->ViewValue = $this->klasifikasi_usaha->CurrentValue;
        $this->klasifikasi_usaha->ViewCustomAttributes = "";

        // sektor_pergub
        $this->sektor_pergub->ViewValue = $this->sektor_pergub->CurrentValue;
        $this->sektor_pergub->ViewCustomAttributes = "";

        // sektor_kbli
        $this->sektor_kbli->ViewValue = $this->sektor_kbli->CurrentValue;
        $this->sektor_kbli->ViewCustomAttributes = "";

        // sektor_ekraf
        $this->sektor_ekraf->ViewValue = $this->sektor_ekraf->CurrentValue;
        $this->sektor_ekraf->ViewCustomAttributes = "";

        // nama_lengkap
        $this->nama_lengkap->ViewValue = $this->nama_lengkap->CurrentValue;
        $this->nama_lengkap->ViewCustomAttributes = "";

        // jenis_kelamin
        $this->jenis_kelamin->ViewValue = $this->jenis_kelamin->CurrentValue;
        $this->jenis_kelamin->ViewCustomAttributes = "";

        // no_hp
        $this->no_hp->ViewValue = $this->no_hp->CurrentValue;
        $this->no_hp->ViewCustomAttributes = "";

        // pendidikan
        $this->pendidikan->ViewValue = $this->pendidikan->CurrentValue;
        $this->pendidikan->ViewCustomAttributes = "";

        // disabilitas
        $this->disabilitas->ViewValue = $this->disabilitas->CurrentValue;
        $this->disabilitas->ViewCustomAttributes = "";

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
        $this->nilai_aset->ViewValue = FormatNumber($this->nilai_aset->ViewValue, 2, -2, -2, -2);
        $this->nilai_aset->ViewCustomAttributes = "";

        // omsetbulan
        $this->omsetbulan->ViewValue = $this->omsetbulan->CurrentValue;
        $this->omsetbulan->ViewValue = FormatNumber($this->omsetbulan->ViewValue, 2, -2, -2, -2);
        $this->omsetbulan->ViewCustomAttributes = "";

        // kegiatan_usaha
        $this->kegiatan_usaha->ViewValue = $this->kegiatan_usaha->CurrentValue;
        $this->kegiatan_usaha->ViewCustomAttributes = "";

        // uraian_kegiatan
        $this->uraian_kegiatan->ViewValue = $this->uraian_kegiatan->CurrentValue;
        $this->uraian_kegiatan->ViewCustomAttributes = "";

        // emailusaha
        $this->emailusaha->ViewValue = $this->emailusaha->CurrentValue;
        $this->emailusaha->ViewCustomAttributes = "";

        // akun_ig
        $this->akun_ig->ViewValue = $this->akun_ig->CurrentValue;
        $this->akun_ig->ViewCustomAttributes = "";

        // akun_facebook
        $this->akun_facebook->ViewValue = $this->akun_facebook->CurrentValue;
        $this->akun_facebook->ViewCustomAttributes = "";

        // akun_gmb
        $this->akun_gmb->ViewValue = $this->akun_gmb->CurrentValue;
        $this->akun_gmb->ViewCustomAttributes = "";

        // url_website
        $this->url_website->ViewValue = $this->url_website->CurrentValue;
        $this->url_website->ViewCustomAttributes = "";

        // url_marketplace
        $this->url_marketplace->ViewValue = $this->url_marketplace->CurrentValue;
        $this->url_marketplace->ViewCustomAttributes = "";

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

        // prf_addbisnis_kel
        $this->prf_addbisnis_kel->LinkCustomAttributes = "";
        $this->prf_addbisnis_kel->HrefValue = "";
        $this->prf_addbisnis_kel->TooltipValue = "";

        // prf_addbisnis_kec
        $this->prf_addbisnis_kec->LinkCustomAttributes = "";
        $this->prf_addbisnis_kec->HrefValue = "";
        $this->prf_addbisnis_kec->TooltipValue = "";

        // kabupaten
        $this->kabupaten->LinkCustomAttributes = "";
        $this->kabupaten->HrefValue = "";
        $this->kabupaten->TooltipValue = "";

        // klasifikasi_usaha
        $this->klasifikasi_usaha->LinkCustomAttributes = "";
        $this->klasifikasi_usaha->HrefValue = "";
        $this->klasifikasi_usaha->TooltipValue = "";

        // sektor_pergub
        $this->sektor_pergub->LinkCustomAttributes = "";
        $this->sektor_pergub->HrefValue = "";
        $this->sektor_pergub->TooltipValue = "";

        // sektor_kbli
        $this->sektor_kbli->LinkCustomAttributes = "";
        $this->sektor_kbli->HrefValue = "";
        $this->sektor_kbli->TooltipValue = "";

        // sektor_ekraf
        $this->sektor_ekraf->LinkCustomAttributes = "";
        $this->sektor_ekraf->HrefValue = "";
        $this->sektor_ekraf->TooltipValue = "";

        // nama_lengkap
        $this->nama_lengkap->LinkCustomAttributes = "";
        $this->nama_lengkap->HrefValue = "";
        $this->nama_lengkap->TooltipValue = "";

        // jenis_kelamin
        $this->jenis_kelamin->LinkCustomAttributes = "";
        $this->jenis_kelamin->HrefValue = "";
        $this->jenis_kelamin->TooltipValue = "";

        // no_hp
        $this->no_hp->LinkCustomAttributes = "";
        $this->no_hp->HrefValue = "";
        $this->no_hp->TooltipValue = "";

        // pendidikan
        $this->pendidikan->LinkCustomAttributes = "";
        $this->pendidikan->HrefValue = "";
        $this->pendidikan->TooltipValue = "";

        // disabilitas
        $this->disabilitas->LinkCustomAttributes = "";
        $this->disabilitas->HrefValue = "";
        $this->disabilitas->TooltipValue = "";

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

        // kegiatan_usaha
        $this->kegiatan_usaha->LinkCustomAttributes = "";
        $this->kegiatan_usaha->HrefValue = "";
        $this->kegiatan_usaha->TooltipValue = "";

        // uraian_kegiatan
        $this->uraian_kegiatan->LinkCustomAttributes = "";
        $this->uraian_kegiatan->HrefValue = "";
        $this->uraian_kegiatan->TooltipValue = "";

        // emailusaha
        $this->emailusaha->LinkCustomAttributes = "";
        $this->emailusaha->HrefValue = "";
        $this->emailusaha->TooltipValue = "";

        // akun_ig
        $this->akun_ig->LinkCustomAttributes = "";
        $this->akun_ig->HrefValue = "";
        $this->akun_ig->TooltipValue = "";

        // akun_facebook
        $this->akun_facebook->LinkCustomAttributes = "";
        $this->akun_facebook->HrefValue = "";
        $this->akun_facebook->TooltipValue = "";

        // akun_gmb
        $this->akun_gmb->LinkCustomAttributes = "";
        $this->akun_gmb->HrefValue = "";
        $this->akun_gmb->TooltipValue = "";

        // url_website
        $this->url_website->LinkCustomAttributes = "";
        $this->url_website->HrefValue = "";
        $this->url_website->TooltipValue = "";

        // url_marketplace
        $this->url_marketplace->LinkCustomAttributes = "";
        $this->url_marketplace->HrefValue = "";
        $this->url_marketplace->TooltipValue = "";

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
        if (!$this->nama_usaha->Raw) {
            $this->nama_usaha->CurrentValue = HtmlDecode($this->nama_usaha->CurrentValue);
        }
        $this->nama_usaha->EditValue = $this->nama_usaha->CurrentValue;
        $this->nama_usaha->PlaceHolder = RemoveHtml($this->nama_usaha->caption());

        // prf_addbisnis_kel
        $this->prf_addbisnis_kel->EditAttrs["class"] = "form-control";
        $this->prf_addbisnis_kel->EditCustomAttributes = "";
        if (!$this->prf_addbisnis_kel->Raw) {
            $this->prf_addbisnis_kel->CurrentValue = HtmlDecode($this->prf_addbisnis_kel->CurrentValue);
        }
        $this->prf_addbisnis_kel->EditValue = $this->prf_addbisnis_kel->CurrentValue;
        $this->prf_addbisnis_kel->PlaceHolder = RemoveHtml($this->prf_addbisnis_kel->caption());

        // prf_addbisnis_kec
        $this->prf_addbisnis_kec->EditAttrs["class"] = "form-control";
        $this->prf_addbisnis_kec->EditCustomAttributes = "";
        if (!$this->prf_addbisnis_kec->Raw) {
            $this->prf_addbisnis_kec->CurrentValue = HtmlDecode($this->prf_addbisnis_kec->CurrentValue);
        }
        $this->prf_addbisnis_kec->EditValue = $this->prf_addbisnis_kec->CurrentValue;
        $this->prf_addbisnis_kec->PlaceHolder = RemoveHtml($this->prf_addbisnis_kec->caption());

        // kabupaten
        $this->kabupaten->EditAttrs["class"] = "form-control";
        $this->kabupaten->EditCustomAttributes = "";
        if (!$this->kabupaten->Raw) {
            $this->kabupaten->CurrentValue = HtmlDecode($this->kabupaten->CurrentValue);
        }
        $this->kabupaten->EditValue = $this->kabupaten->CurrentValue;
        $this->kabupaten->PlaceHolder = RemoveHtml($this->kabupaten->caption());

        // klasifikasi_usaha
        $this->klasifikasi_usaha->EditAttrs["class"] = "form-control";
        $this->klasifikasi_usaha->EditCustomAttributes = "";
        if (!$this->klasifikasi_usaha->Raw) {
            $this->klasifikasi_usaha->CurrentValue = HtmlDecode($this->klasifikasi_usaha->CurrentValue);
        }
        $this->klasifikasi_usaha->EditValue = $this->klasifikasi_usaha->CurrentValue;
        $this->klasifikasi_usaha->PlaceHolder = RemoveHtml($this->klasifikasi_usaha->caption());

        // sektor_pergub
        $this->sektor_pergub->EditAttrs["class"] = "form-control";
        $this->sektor_pergub->EditCustomAttributes = "";
        if (!$this->sektor_pergub->Raw) {
            $this->sektor_pergub->CurrentValue = HtmlDecode($this->sektor_pergub->CurrentValue);
        }
        $this->sektor_pergub->EditValue = $this->sektor_pergub->CurrentValue;
        $this->sektor_pergub->PlaceHolder = RemoveHtml($this->sektor_pergub->caption());

        // sektor_kbli
        $this->sektor_kbli->EditAttrs["class"] = "form-control";
        $this->sektor_kbli->EditCustomAttributes = "";
        if (!$this->sektor_kbli->Raw) {
            $this->sektor_kbli->CurrentValue = HtmlDecode($this->sektor_kbli->CurrentValue);
        }
        $this->sektor_kbli->EditValue = $this->sektor_kbli->CurrentValue;
        $this->sektor_kbli->PlaceHolder = RemoveHtml($this->sektor_kbli->caption());

        // sektor_ekraf
        $this->sektor_ekraf->EditAttrs["class"] = "form-control";
        $this->sektor_ekraf->EditCustomAttributes = "";
        if (!$this->sektor_ekraf->Raw) {
            $this->sektor_ekraf->CurrentValue = HtmlDecode($this->sektor_ekraf->CurrentValue);
        }
        $this->sektor_ekraf->EditValue = $this->sektor_ekraf->CurrentValue;
        $this->sektor_ekraf->PlaceHolder = RemoveHtml($this->sektor_ekraf->caption());

        // nama_lengkap
        $this->nama_lengkap->EditAttrs["class"] = "form-control";
        $this->nama_lengkap->EditCustomAttributes = "";
        if (!$this->nama_lengkap->Raw) {
            $this->nama_lengkap->CurrentValue = HtmlDecode($this->nama_lengkap->CurrentValue);
        }
        $this->nama_lengkap->EditValue = $this->nama_lengkap->CurrentValue;
        $this->nama_lengkap->PlaceHolder = RemoveHtml($this->nama_lengkap->caption());

        // jenis_kelamin
        $this->jenis_kelamin->EditAttrs["class"] = "form-control";
        $this->jenis_kelamin->EditCustomAttributes = "";
        if (!$this->jenis_kelamin->Raw) {
            $this->jenis_kelamin->CurrentValue = HtmlDecode($this->jenis_kelamin->CurrentValue);
        }
        $this->jenis_kelamin->EditValue = $this->jenis_kelamin->CurrentValue;
        $this->jenis_kelamin->PlaceHolder = RemoveHtml($this->jenis_kelamin->caption());

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

        // disabilitas
        $this->disabilitas->EditAttrs["class"] = "form-control";
        $this->disabilitas->EditCustomAttributes = "";
        if (!$this->disabilitas->Raw) {
            $this->disabilitas->CurrentValue = HtmlDecode($this->disabilitas->CurrentValue);
        }
        $this->disabilitas->EditValue = $this->disabilitas->CurrentValue;
        $this->disabilitas->PlaceHolder = RemoveHtml($this->disabilitas->caption());

        // tglmulai
        $this->tglmulai->EditAttrs["class"] = "form-control";
        $this->tglmulai->EditCustomAttributes = "";
        $this->tglmulai->EditValue = FormatDateTime($this->tglmulai->CurrentValue, 8);
        $this->tglmulai->PlaceHolder = RemoveHtml($this->tglmulai->caption());

        // umurusaha
        $this->umurusaha->EditAttrs["class"] = "form-control";
        $this->umurusaha->EditCustomAttributes = "";
        if (!$this->umurusaha->Raw) {
            $this->umurusaha->CurrentValue = HtmlDecode($this->umurusaha->CurrentValue);
        }
        $this->umurusaha->EditValue = $this->umurusaha->CurrentValue;
        $this->umurusaha->PlaceHolder = RemoveHtml($this->umurusaha->caption());

        // addbisnis
        $this->addbisnis->EditAttrs["class"] = "form-control";
        $this->addbisnis->EditCustomAttributes = "";
        if (!$this->addbisnis->Raw) {
            $this->addbisnis->CurrentValue = HtmlDecode($this->addbisnis->CurrentValue);
        }
        $this->addbisnis->EditValue = $this->addbisnis->CurrentValue;
        $this->addbisnis->PlaceHolder = RemoveHtml($this->addbisnis->caption());

        // nilai_aset
        $this->nilai_aset->EditAttrs["class"] = "form-control";
        $this->nilai_aset->EditCustomAttributes = "";
        $this->nilai_aset->EditValue = $this->nilai_aset->CurrentValue;
        $this->nilai_aset->PlaceHolder = RemoveHtml($this->nilai_aset->caption());
        if (strval($this->nilai_aset->EditValue) != "" && is_numeric($this->nilai_aset->EditValue)) {
            $this->nilai_aset->EditValue = FormatNumber($this->nilai_aset->EditValue, -2, -2, -2, -2);
        }

        // omsetbulan
        $this->omsetbulan->EditAttrs["class"] = "form-control";
        $this->omsetbulan->EditCustomAttributes = "";
        $this->omsetbulan->EditValue = $this->omsetbulan->CurrentValue;
        $this->omsetbulan->PlaceHolder = RemoveHtml($this->omsetbulan->caption());
        if (strval($this->omsetbulan->EditValue) != "" && is_numeric($this->omsetbulan->EditValue)) {
            $this->omsetbulan->EditValue = FormatNumber($this->omsetbulan->EditValue, -2, -2, -2, -2);
        }

        // kegiatan_usaha
        $this->kegiatan_usaha->EditAttrs["class"] = "form-control";
        $this->kegiatan_usaha->EditCustomAttributes = "";
        if (!$this->kegiatan_usaha->Raw) {
            $this->kegiatan_usaha->CurrentValue = HtmlDecode($this->kegiatan_usaha->CurrentValue);
        }
        $this->kegiatan_usaha->EditValue = $this->kegiatan_usaha->CurrentValue;
        $this->kegiatan_usaha->PlaceHolder = RemoveHtml($this->kegiatan_usaha->caption());

        // uraian_kegiatan
        $this->uraian_kegiatan->EditAttrs["class"] = "form-control";
        $this->uraian_kegiatan->EditCustomAttributes = "";
        if (!$this->uraian_kegiatan->Raw) {
            $this->uraian_kegiatan->CurrentValue = HtmlDecode($this->uraian_kegiatan->CurrentValue);
        }
        $this->uraian_kegiatan->EditValue = $this->uraian_kegiatan->CurrentValue;
        $this->uraian_kegiatan->PlaceHolder = RemoveHtml($this->uraian_kegiatan->caption());

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

        // akun_facebook
        $this->akun_facebook->EditAttrs["class"] = "form-control";
        $this->akun_facebook->EditCustomAttributes = "";
        if (!$this->akun_facebook->Raw) {
            $this->akun_facebook->CurrentValue = HtmlDecode($this->akun_facebook->CurrentValue);
        }
        $this->akun_facebook->EditValue = $this->akun_facebook->CurrentValue;
        $this->akun_facebook->PlaceHolder = RemoveHtml($this->akun_facebook->caption());

        // akun_gmb
        $this->akun_gmb->EditAttrs["class"] = "form-control";
        $this->akun_gmb->EditCustomAttributes = "";
        if (!$this->akun_gmb->Raw) {
            $this->akun_gmb->CurrentValue = HtmlDecode($this->akun_gmb->CurrentValue);
        }
        $this->akun_gmb->EditValue = $this->akun_gmb->CurrentValue;
        $this->akun_gmb->PlaceHolder = RemoveHtml($this->akun_gmb->caption());

        // url_website
        $this->url_website->EditAttrs["class"] = "form-control";
        $this->url_website->EditCustomAttributes = "";
        if (!$this->url_website->Raw) {
            $this->url_website->CurrentValue = HtmlDecode($this->url_website->CurrentValue);
        }
        $this->url_website->EditValue = $this->url_website->CurrentValue;
        $this->url_website->PlaceHolder = RemoveHtml($this->url_website->caption());

        // url_marketplace
        $this->url_marketplace->EditAttrs["class"] = "form-control";
        $this->url_marketplace->EditCustomAttributes = "";
        if (!$this->url_marketplace->Raw) {
            $this->url_marketplace->CurrentValue = HtmlDecode($this->url_marketplace->CurrentValue);
        }
        $this->url_marketplace->EditValue = $this->url_marketplace->CurrentValue;
        $this->url_marketplace->PlaceHolder = RemoveHtml($this->url_marketplace->caption());

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
                    $doc->exportCaption($this->prf_addbisnis_kel);
                    $doc->exportCaption($this->prf_addbisnis_kec);
                    $doc->exportCaption($this->kabupaten);
                    $doc->exportCaption($this->klasifikasi_usaha);
                    $doc->exportCaption($this->sektor_pergub);
                    $doc->exportCaption($this->sektor_kbli);
                    $doc->exportCaption($this->sektor_ekraf);
                    $doc->exportCaption($this->nama_lengkap);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->disabilitas);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->umurusaha);
                    $doc->exportCaption($this->addbisnis);
                    $doc->exportCaption($this->nilai_aset);
                    $doc->exportCaption($this->omsetbulan);
                    $doc->exportCaption($this->kegiatan_usaha);
                    $doc->exportCaption($this->uraian_kegiatan);
                    $doc->exportCaption($this->emailusaha);
                    $doc->exportCaption($this->akun_ig);
                    $doc->exportCaption($this->akun_facebook);
                    $doc->exportCaption($this->akun_gmb);
                    $doc->exportCaption($this->url_website);
                    $doc->exportCaption($this->url_marketplace);
                    $doc->exportCaption($this->kelas);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->nama_usaha);
                    $doc->exportCaption($this->prf_addbisnis_kel);
                    $doc->exportCaption($this->prf_addbisnis_kec);
                    $doc->exportCaption($this->kabupaten);
                    $doc->exportCaption($this->klasifikasi_usaha);
                    $doc->exportCaption($this->sektor_pergub);
                    $doc->exportCaption($this->sektor_kbli);
                    $doc->exportCaption($this->sektor_ekraf);
                    $doc->exportCaption($this->nama_lengkap);
                    $doc->exportCaption($this->jenis_kelamin);
                    $doc->exportCaption($this->no_hp);
                    $doc->exportCaption($this->pendidikan);
                    $doc->exportCaption($this->disabilitas);
                    $doc->exportCaption($this->tglmulai);
                    $doc->exportCaption($this->umurusaha);
                    $doc->exportCaption($this->addbisnis);
                    $doc->exportCaption($this->nilai_aset);
                    $doc->exportCaption($this->omsetbulan);
                    $doc->exportCaption($this->kegiatan_usaha);
                    $doc->exportCaption($this->uraian_kegiatan);
                    $doc->exportCaption($this->emailusaha);
                    $doc->exportCaption($this->akun_ig);
                    $doc->exportCaption($this->akun_facebook);
                    $doc->exportCaption($this->akun_gmb);
                    $doc->exportCaption($this->url_website);
                    $doc->exportCaption($this->url_marketplace);
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
                        $doc->exportField($this->prf_addbisnis_kel);
                        $doc->exportField($this->prf_addbisnis_kec);
                        $doc->exportField($this->kabupaten);
                        $doc->exportField($this->klasifikasi_usaha);
                        $doc->exportField($this->sektor_pergub);
                        $doc->exportField($this->sektor_kbli);
                        $doc->exportField($this->sektor_ekraf);
                        $doc->exportField($this->nama_lengkap);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->disabilitas);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->umurusaha);
                        $doc->exportField($this->addbisnis);
                        $doc->exportField($this->nilai_aset);
                        $doc->exportField($this->omsetbulan);
                        $doc->exportField($this->kegiatan_usaha);
                        $doc->exportField($this->uraian_kegiatan);
                        $doc->exportField($this->emailusaha);
                        $doc->exportField($this->akun_ig);
                        $doc->exportField($this->akun_facebook);
                        $doc->exportField($this->akun_gmb);
                        $doc->exportField($this->url_website);
                        $doc->exportField($this->url_marketplace);
                        $doc->exportField($this->kelas);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->nama_usaha);
                        $doc->exportField($this->prf_addbisnis_kel);
                        $doc->exportField($this->prf_addbisnis_kec);
                        $doc->exportField($this->kabupaten);
                        $doc->exportField($this->klasifikasi_usaha);
                        $doc->exportField($this->sektor_pergub);
                        $doc->exportField($this->sektor_kbli);
                        $doc->exportField($this->sektor_ekraf);
                        $doc->exportField($this->nama_lengkap);
                        $doc->exportField($this->jenis_kelamin);
                        $doc->exportField($this->no_hp);
                        $doc->exportField($this->pendidikan);
                        $doc->exportField($this->disabilitas);
                        $doc->exportField($this->tglmulai);
                        $doc->exportField($this->umurusaha);
                        $doc->exportField($this->addbisnis);
                        $doc->exportField($this->nilai_aset);
                        $doc->exportField($this->omsetbulan);
                        $doc->exportField($this->kegiatan_usaha);
                        $doc->exportField($this->uraian_kegiatan);
                        $doc->exportField($this->emailusaha);
                        $doc->exportField($this->akun_ig);
                        $doc->exportField($this->akun_facebook);
                        $doc->exportField($this->akun_gmb);
                        $doc->exportField($this->url_website);
                        $doc->exportField($this->url_marketplace);
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
