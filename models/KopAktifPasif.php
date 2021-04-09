<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for kop_aktif_pasif
 */
class KopAktifPasif extends DbTable
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
    public $binaan;
    public $thn_periode;
    public $periode;
    public $nama_koperasi;
    public $akte;
    public $tanggal_pendirian;
    public $alamat_jalan;
    public $kapanewon;
    public $kalurahan;
    public $alamat_kodepos;
    public $telp;
    public $fax;
    public $_email;
    public $website;
    public $aktif;
    public $pasif;
    public $bentuk_koperasi;
    public $bentuk_ekonomi;
    public $kelompok_koperasi;
    public $jns_koperasi;
    public $pengurus_ketua;
    public $pengurus_sekertartaris;
    public $pengurus_bendahara;
    public $pengurus_masa_jabatan;
    public $pengawas_ketua;
    public $pengawas_anggota_1;
    public $pengawas_anggota_2;
    public $pengawas_masa_jabatan;
    public $manajer;
    public $pemeringkatan_klasifikasi;
    public $kesehatan_koperasi_status;
    public $kesehatan_koperasi_angka;
    public $anggota_l;
    public $anggota_p;
    public $anggota_jml;
    public $anggota_calon;
    public $pengurus_l;
    public $pengurus_p;
    public $pengurus_jml;
    public $pengawas_l;
    public $pengawas_p;
    public $pengawas_jml;
    public $karyawan_l;
    public $karyawan_p;
    public $karyawan_jml;
    public $manajer_l;
    public $manajer_p;
    public $manajer_jml;
    public $rat_buku;
    public $rat_tanggal;
    public $rat;
    public $indikator_usaha;
    public $modal_luar;
    public $aset;
    public $vol_usaha;
    public $vol_usaha_lainya;
    public $vol_usaha_jml;
    public $vol_usaha_tahunlalu;
    public $shu;
    public $pedpt;
    public $biaya;
    public $ms_sp;
    public $ms_sw;
    public $ms_khusus;
    public $ms_cad;
    public $ms_hibah;
    public $ms_shu_belumdibagi;
    public $ms_dana_cadlain;
    public $ms_modal_penyerta;
    public $ms_jumlah;
    public $pinjaman_sp;
    public $pinjaman_lainya;
    public $pinjaman_jumlah;
    public $jml_dana;
    public $investasi_jangka_panjang;
    public $simpanan_lainya;
    public $simpanan_sukarela;
    public $simpanan_jumlah;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'kop_aktif_pasif';
        $this->TableName = 'kop_aktif_pasif';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`kop_aktif_pasif`";
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
        $this->id = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // binaan
        $this->binaan = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_binaan', 'binaan', '`binaan`', '`binaan`', 200, 30, -1, false, '`binaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->binaan->Sortable = true; // Allow sort
        $this->binaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->binaan->Param, "CustomMsg");
        $this->Fields['binaan'] = &$this->binaan;

        // thn_periode
        $this->thn_periode = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_thn_periode', 'thn_periode', '`thn_periode`', '`thn_periode`', 3, 4, -1, false, '`thn_periode`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->thn_periode->Sortable = true; // Allow sort
        $this->thn_periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->thn_periode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->thn_periode->Param, "CustomMsg");
        $this->Fields['thn_periode'] = &$this->thn_periode;

        // periode
        $this->periode = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_periode', 'periode', '`periode`', '`periode`', 3, 1, -1, false, '`periode`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->periode->Sortable = true; // Allow sort
        $this->periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->periode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->periode->Param, "CustomMsg");
        $this->Fields['periode'] = &$this->periode;

        // nama_koperasi
        $this->nama_koperasi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_nama_koperasi', 'nama_koperasi', '`nama_koperasi`', '`nama_koperasi`', 200, 100, -1, false, '`nama_koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nama_koperasi->Sortable = true; // Allow sort
        $this->nama_koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nama_koperasi->Param, "CustomMsg");
        $this->Fields['nama_koperasi'] = &$this->nama_koperasi;

        // akte
        $this->akte = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_akte', 'akte', '`akte`', '`akte`', 200, 50, -1, false, '`akte`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->akte->Sortable = true; // Allow sort
        $this->akte->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->akte->Param, "CustomMsg");
        $this->Fields['akte'] = &$this->akte;

        // tanggal_pendirian
        $this->tanggal_pendirian = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_tanggal_pendirian', 'tanggal_pendirian', '`tanggal_pendirian`', CastDateFieldForLike("`tanggal_pendirian`", 0, "DB"), 133, 10, 0, false, '`tanggal_pendirian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->tanggal_pendirian->Sortable = true; // Allow sort
        $this->tanggal_pendirian->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->tanggal_pendirian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->tanggal_pendirian->Param, "CustomMsg");
        $this->Fields['tanggal_pendirian'] = &$this->tanggal_pendirian;

        // alamat_jalan
        $this->alamat_jalan = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_alamat_jalan', 'alamat_jalan', '`alamat_jalan`', '`alamat_jalan`', 200, 100, -1, false, '`alamat_jalan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat_jalan->Sortable = true; // Allow sort
        $this->alamat_jalan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat_jalan->Param, "CustomMsg");
        $this->Fields['alamat_jalan'] = &$this->alamat_jalan;

        // kapanewon
        $this->kapanewon = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_kapanewon', 'kapanewon', '`kapanewon`', '`kapanewon`', 200, 30, -1, false, '`kapanewon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapanewon->Sortable = true; // Allow sort
        $this->kapanewon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapanewon->Param, "CustomMsg");
        $this->Fields['kapanewon'] = &$this->kapanewon;

        // kalurahan
        $this->kalurahan = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_kalurahan', 'kalurahan', '`kalurahan`', '`kalurahan`', 200, 30, -1, false, '`kalurahan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kalurahan->Sortable = true; // Allow sort
        $this->kalurahan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kalurahan->Param, "CustomMsg");
        $this->Fields['kalurahan'] = &$this->kalurahan;

        // alamat_kodepos
        $this->alamat_kodepos = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_alamat_kodepos', 'alamat_kodepos', '`alamat_kodepos`', '`alamat_kodepos`', 200, 10, -1, false, '`alamat_kodepos`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->alamat_kodepos->Sortable = true; // Allow sort
        $this->alamat_kodepos->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->alamat_kodepos->Param, "CustomMsg");
        $this->Fields['alamat_kodepos'] = &$this->alamat_kodepos;

        // telp
        $this->telp = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_telp', 'telp', '`telp`', '`telp`', 200, 20, -1, false, '`telp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->telp->Sortable = true; // Allow sort
        $this->telp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->telp->Param, "CustomMsg");
        $this->Fields['telp'] = &$this->telp;

        // fax
        $this->fax = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_fax', 'fax', '`fax`', '`fax`', 200, 20, -1, false, '`fax`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->fax->Sortable = true; // Allow sort
        $this->fax->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->fax->Param, "CustomMsg");
        $this->Fields['fax'] = &$this->fax;

        // email
        $this->_email = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x__email', 'email', '`email`', '`email`', 200, 50, -1, false, '`email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->_email->Sortable = true; // Allow sort
        $this->_email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->_email->Param, "CustomMsg");
        $this->Fields['email'] = &$this->_email;

        // website
        $this->website = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_website', 'website', '`website`', '`website`', 200, 50, -1, false, '`website`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->website->Sortable = true; // Allow sort
        $this->website->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->website->Param, "CustomMsg");
        $this->Fields['website'] = &$this->website;

        // aktif
        $this->aktif = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_aktif', 'aktif', '`aktif`', '`aktif`', 200, 1, -1, false, '`aktif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->aktif->Sortable = true; // Allow sort
        $this->aktif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->aktif->Param, "CustomMsg");
        $this->Fields['aktif'] = &$this->aktif;

        // pasif
        $this->pasif = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pasif', 'pasif', '`pasif`', '`pasif`', 200, 1, -1, false, '`pasif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pasif->Sortable = true; // Allow sort
        $this->pasif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pasif->Param, "CustomMsg");
        $this->Fields['pasif'] = &$this->pasif;

        // bentuk_koperasi
        $this->bentuk_koperasi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_bentuk_koperasi', 'bentuk_koperasi', '`bentuk_koperasi`', '`bentuk_koperasi`', 200, 30, -1, false, '`bentuk_koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bentuk_koperasi->Sortable = true; // Allow sort
        $this->bentuk_koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bentuk_koperasi->Param, "CustomMsg");
        $this->Fields['bentuk_koperasi'] = &$this->bentuk_koperasi;

        // bentuk_ekonomi
        $this->bentuk_ekonomi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_bentuk_ekonomi', 'bentuk_ekonomi', '`bentuk_ekonomi`', '`bentuk_ekonomi`', 200, 30, -1, false, '`bentuk_ekonomi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bentuk_ekonomi->Sortable = true; // Allow sort
        $this->bentuk_ekonomi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bentuk_ekonomi->Param, "CustomMsg");
        $this->Fields['bentuk_ekonomi'] = &$this->bentuk_ekonomi;

        // kelompok_koperasi
        $this->kelompok_koperasi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_kelompok_koperasi', 'kelompok_koperasi', '`kelompok_koperasi`', '`kelompok_koperasi`', 200, 50, -1, false, '`kelompok_koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelompok_koperasi->Sortable = true; // Allow sort
        $this->kelompok_koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelompok_koperasi->Param, "CustomMsg");
        $this->Fields['kelompok_koperasi'] = &$this->kelompok_koperasi;

        // jns_koperasi
        $this->jns_koperasi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_jns_koperasi', 'jns_koperasi', '`jns_koperasi`', '`jns_koperasi`', 200, 50, -1, false, '`jns_koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jns_koperasi->Sortable = true; // Allow sort
        $this->jns_koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jns_koperasi->Param, "CustomMsg");
        $this->Fields['jns_koperasi'] = &$this->jns_koperasi;

        // pengurus_ketua
        $this->pengurus_ketua = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_ketua', 'pengurus_ketua', '`pengurus_ketua`', '`pengurus_ketua`', 200, 100, -1, false, '`pengurus_ketua`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_ketua->Sortable = true; // Allow sort
        $this->pengurus_ketua->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_ketua->Param, "CustomMsg");
        $this->Fields['pengurus_ketua'] = &$this->pengurus_ketua;

        // pengurus_sekertartaris
        $this->pengurus_sekertartaris = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_sekertartaris', 'pengurus_sekertartaris', '`pengurus_sekertartaris`', '`pengurus_sekertartaris`', 200, 100, -1, false, '`pengurus_sekertartaris`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_sekertartaris->Sortable = true; // Allow sort
        $this->pengurus_sekertartaris->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_sekertartaris->Param, "CustomMsg");
        $this->Fields['pengurus_sekertartaris'] = &$this->pengurus_sekertartaris;

        // pengurus_bendahara
        $this->pengurus_bendahara = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_bendahara', 'pengurus_bendahara', '`pengurus_bendahara`', '`pengurus_bendahara`', 200, 100, -1, false, '`pengurus_bendahara`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_bendahara->Sortable = true; // Allow sort
        $this->pengurus_bendahara->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_bendahara->Param, "CustomMsg");
        $this->Fields['pengurus_bendahara'] = &$this->pengurus_bendahara;

        // pengurus_masa_jabatan
        $this->pengurus_masa_jabatan = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_masa_jabatan', 'pengurus_masa_jabatan', '`pengurus_masa_jabatan`', '`pengurus_masa_jabatan`', 200, 20, -1, false, '`pengurus_masa_jabatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_masa_jabatan->Sortable = true; // Allow sort
        $this->pengurus_masa_jabatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_masa_jabatan->Param, "CustomMsg");
        $this->Fields['pengurus_masa_jabatan'] = &$this->pengurus_masa_jabatan;

        // pengawas_ketua
        $this->pengawas_ketua = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_ketua', 'pengawas_ketua', '`pengawas_ketua`', '`pengawas_ketua`', 200, 100, -1, false, '`pengawas_ketua`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_ketua->Sortable = true; // Allow sort
        $this->pengawas_ketua->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_ketua->Param, "CustomMsg");
        $this->Fields['pengawas_ketua'] = &$this->pengawas_ketua;

        // pengawas_anggota_1
        $this->pengawas_anggota_1 = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_anggota_1', 'pengawas_anggota_1', '`pengawas_anggota_1`', '`pengawas_anggota_1`', 200, 100, -1, false, '`pengawas_anggota_1`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_anggota_1->Sortable = true; // Allow sort
        $this->pengawas_anggota_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_anggota_1->Param, "CustomMsg");
        $this->Fields['pengawas_anggota_1'] = &$this->pengawas_anggota_1;

        // pengawas_anggota_2
        $this->pengawas_anggota_2 = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_anggota_2', 'pengawas_anggota_2', '`pengawas_anggota_2`', '`pengawas_anggota_2`', 200, 100, -1, false, '`pengawas_anggota_2`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_anggota_2->Sortable = true; // Allow sort
        $this->pengawas_anggota_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_anggota_2->Param, "CustomMsg");
        $this->Fields['pengawas_anggota_2'] = &$this->pengawas_anggota_2;

        // pengawas_masa_jabatan
        $this->pengawas_masa_jabatan = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_masa_jabatan', 'pengawas_masa_jabatan', '`pengawas_masa_jabatan`', '`pengawas_masa_jabatan`', 200, 20, -1, false, '`pengawas_masa_jabatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_masa_jabatan->Sortable = true; // Allow sort
        $this->pengawas_masa_jabatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_masa_jabatan->Param, "CustomMsg");
        $this->Fields['pengawas_masa_jabatan'] = &$this->pengawas_masa_jabatan;

        // manajer
        $this->manajer = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_manajer', 'manajer', '`manajer`', '`manajer`', 200, 100, -1, false, '`manajer`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->manajer->Sortable = true; // Allow sort
        $this->manajer->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->manajer->Param, "CustomMsg");
        $this->Fields['manajer'] = &$this->manajer;

        // pemeringkatan_klasifikasi
        $this->pemeringkatan_klasifikasi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pemeringkatan_klasifikasi', 'pemeringkatan_klasifikasi', '`pemeringkatan_klasifikasi`', '`pemeringkatan_klasifikasi`', 200, 50, -1, false, '`pemeringkatan_klasifikasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pemeringkatan_klasifikasi->Sortable = true; // Allow sort
        $this->pemeringkatan_klasifikasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pemeringkatan_klasifikasi->Param, "CustomMsg");
        $this->Fields['pemeringkatan_klasifikasi'] = &$this->pemeringkatan_klasifikasi;

        // kesehatan_koperasi_status
        $this->kesehatan_koperasi_status = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_kesehatan_koperasi_status', 'kesehatan_koperasi_status', '`kesehatan_koperasi_status`', '`kesehatan_koperasi_status`', 200, 50, -1, false, '`kesehatan_koperasi_status`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kesehatan_koperasi_status->Sortable = true; // Allow sort
        $this->kesehatan_koperasi_status->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kesehatan_koperasi_status->Param, "CustomMsg");
        $this->Fields['kesehatan_koperasi_status'] = &$this->kesehatan_koperasi_status;

        // kesehatan_koperasi_angka
        $this->kesehatan_koperasi_angka = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_kesehatan_koperasi_angka', 'kesehatan_koperasi_angka', '`kesehatan_koperasi_angka`', '`kesehatan_koperasi_angka`', 5, 22, -1, false, '`kesehatan_koperasi_angka`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kesehatan_koperasi_angka->Sortable = true; // Allow sort
        $this->kesehatan_koperasi_angka->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->kesehatan_koperasi_angka->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->kesehatan_koperasi_angka->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kesehatan_koperasi_angka->Param, "CustomMsg");
        $this->Fields['kesehatan_koperasi_angka'] = &$this->kesehatan_koperasi_angka;

        // anggota_l
        $this->anggota_l = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_anggota_l', 'anggota_l', '`anggota_l`', '`anggota_l`', 3, 11, -1, false, '`anggota_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->anggota_l->Sortable = true; // Allow sort
        $this->anggota_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->anggota_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anggota_l->Param, "CustomMsg");
        $this->Fields['anggota_l'] = &$this->anggota_l;

        // anggota_p
        $this->anggota_p = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_anggota_p', 'anggota_p', '`anggota_p`', '`anggota_p`', 3, 11, -1, false, '`anggota_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->anggota_p->Sortable = true; // Allow sort
        $this->anggota_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->anggota_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anggota_p->Param, "CustomMsg");
        $this->Fields['anggota_p'] = &$this->anggota_p;

        // anggota_jml
        $this->anggota_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_anggota_jml', 'anggota_jml', '`anggota_jml`', '`anggota_jml`', 3, 11, -1, false, '`anggota_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->anggota_jml->Sortable = true; // Allow sort
        $this->anggota_jml->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->anggota_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anggota_jml->Param, "CustomMsg");
        $this->Fields['anggota_jml'] = &$this->anggota_jml;

        // anggota_calon
        $this->anggota_calon = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_anggota_calon', 'anggota_calon', '`anggota_calon`', '`anggota_calon`', 3, 11, -1, false, '`anggota_calon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->anggota_calon->Sortable = true; // Allow sort
        $this->anggota_calon->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->anggota_calon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->anggota_calon->Param, "CustomMsg");
        $this->Fields['anggota_calon'] = &$this->anggota_calon;

        // pengurus_l
        $this->pengurus_l = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_l', 'pengurus_l', '`pengurus_l`', '`pengurus_l`', 3, 11, -1, false, '`pengurus_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_l->Sortable = true; // Allow sort
        $this->pengurus_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengurus_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_l->Param, "CustomMsg");
        $this->Fields['pengurus_l'] = &$this->pengurus_l;

        // pengurus_p
        $this->pengurus_p = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_p', 'pengurus_p', '`pengurus_p`', '`pengurus_p`', 3, 11, -1, false, '`pengurus_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_p->Sortable = true; // Allow sort
        $this->pengurus_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengurus_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_p->Param, "CustomMsg");
        $this->Fields['pengurus_p'] = &$this->pengurus_p;

        // pengurus_jml
        $this->pengurus_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengurus_jml', 'pengurus_jml', '`pengurus_jml`', '`pengurus_jml`', 3, 11, -1, false, '`pengurus_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengurus_jml->Sortable = true; // Allow sort
        $this->pengurus_jml->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengurus_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengurus_jml->Param, "CustomMsg");
        $this->Fields['pengurus_jml'] = &$this->pengurus_jml;

        // pengawas_l
        $this->pengawas_l = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_l', 'pengawas_l', '`pengawas_l`', '`pengawas_l`', 3, 11, -1, false, '`pengawas_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_l->Sortable = true; // Allow sort
        $this->pengawas_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengawas_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_l->Param, "CustomMsg");
        $this->Fields['pengawas_l'] = &$this->pengawas_l;

        // pengawas_p
        $this->pengawas_p = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_p', 'pengawas_p', '`pengawas_p`', '`pengawas_p`', 3, 11, -1, false, '`pengawas_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_p->Sortable = true; // Allow sort
        $this->pengawas_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengawas_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_p->Param, "CustomMsg");
        $this->Fields['pengawas_p'] = &$this->pengawas_p;

        // pengawas_jml
        $this->pengawas_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pengawas_jml', 'pengawas_jml', '`pengawas_jml`', '`pengawas_jml`', 3, 11, -1, false, '`pengawas_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pengawas_jml->Sortable = true; // Allow sort
        $this->pengawas_jml->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->pengawas_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pengawas_jml->Param, "CustomMsg");
        $this->Fields['pengawas_jml'] = &$this->pengawas_jml;

        // karyawan_l
        $this->karyawan_l = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_karyawan_l', 'karyawan_l', '`karyawan_l`', '`karyawan_l`', 3, 11, -1, false, '`karyawan_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->karyawan_l->Sortable = true; // Allow sort
        $this->karyawan_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->karyawan_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->karyawan_l->Param, "CustomMsg");
        $this->Fields['karyawan_l'] = &$this->karyawan_l;

        // karyawan_p
        $this->karyawan_p = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_karyawan_p', 'karyawan_p', '`karyawan_p`', '`karyawan_p`', 3, 11, -1, false, '`karyawan_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->karyawan_p->Sortable = true; // Allow sort
        $this->karyawan_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->karyawan_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->karyawan_p->Param, "CustomMsg");
        $this->Fields['karyawan_p'] = &$this->karyawan_p;

        // karyawan_jml
        $this->karyawan_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_karyawan_jml', 'karyawan_jml', '`karyawan_jml`', '`karyawan_jml`', 3, 11, -1, false, '`karyawan_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->karyawan_jml->Sortable = true; // Allow sort
        $this->karyawan_jml->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->karyawan_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->karyawan_jml->Param, "CustomMsg");
        $this->Fields['karyawan_jml'] = &$this->karyawan_jml;

        // manajer_l
        $this->manajer_l = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_manajer_l', 'manajer_l', '`manajer_l`', '`manajer_l`', 3, 11, -1, false, '`manajer_l`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->manajer_l->Sortable = true; // Allow sort
        $this->manajer_l->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->manajer_l->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->manajer_l->Param, "CustomMsg");
        $this->Fields['manajer_l'] = &$this->manajer_l;

        // manajer_p
        $this->manajer_p = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_manajer_p', 'manajer_p', '`manajer_p`', '`manajer_p`', 3, 11, -1, false, '`manajer_p`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->manajer_p->Sortable = true; // Allow sort
        $this->manajer_p->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->manajer_p->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->manajer_p->Param, "CustomMsg");
        $this->Fields['manajer_p'] = &$this->manajer_p;

        // manajer_jml
        $this->manajer_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_manajer_jml', 'manajer_jml', '`manajer_jml`', '`manajer_jml`', 3, 11, -1, false, '`manajer_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->manajer_jml->Sortable = true; // Allow sort
        $this->manajer_jml->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->manajer_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->manajer_jml->Param, "CustomMsg");
        $this->Fields['manajer_jml'] = &$this->manajer_jml;

        // rat_buku
        $this->rat_buku = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_rat_buku', 'rat_buku', '`rat_buku`', '`rat_buku`', 200, 20, -1, false, '`rat_buku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rat_buku->Sortable = true; // Allow sort
        $this->rat_buku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rat_buku->Param, "CustomMsg");
        $this->Fields['rat_buku'] = &$this->rat_buku;

        // rat_tanggal
        $this->rat_tanggal = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_rat_tanggal', 'rat_tanggal', '`rat_tanggal`', '`rat_tanggal`', 200, 20, -1, false, '`rat_tanggal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rat_tanggal->Sortable = true; // Allow sort
        $this->rat_tanggal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rat_tanggal->Param, "CustomMsg");
        $this->Fields['rat_tanggal'] = &$this->rat_tanggal;

        // rat
        $this->rat = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_rat', 'rat', '`rat`', '`rat`', 3, 1, -1, false, '`rat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->rat->Sortable = true; // Allow sort
        $this->rat->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->rat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->rat->Param, "CustomMsg");
        $this->Fields['rat'] = &$this->rat;

        // indikator_usaha
        $this->indikator_usaha = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_indikator_usaha', 'indikator_usaha', '`indikator_usaha`', '`indikator_usaha`', 200, 50, -1, false, '`indikator_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->indikator_usaha->Sortable = true; // Allow sort
        $this->indikator_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->indikator_usaha->Param, "CustomMsg");
        $this->Fields['indikator_usaha'] = &$this->indikator_usaha;

        // modal_luar
        $this->modal_luar = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_modal_luar', 'modal_luar', '`modal_luar`', '`modal_luar`', 5, 22, -1, false, '`modal_luar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->modal_luar->Sortable = true; // Allow sort
        $this->modal_luar->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->modal_luar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->modal_luar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->modal_luar->Param, "CustomMsg");
        $this->Fields['modal_luar'] = &$this->modal_luar;

        // aset
        $this->aset = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_aset', 'aset', '`aset`', '`aset`', 5, 22, -1, false, '`aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->aset->Sortable = true; // Allow sort
        $this->aset->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->aset->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->aset->Param, "CustomMsg");
        $this->Fields['aset'] = &$this->aset;

        // vol_usaha
        $this->vol_usaha = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_vol_usaha', 'vol_usaha', '`vol_usaha`', '`vol_usaha`', 5, 22, -1, false, '`vol_usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vol_usaha->Sortable = true; // Allow sort
        $this->vol_usaha->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->vol_usaha->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->vol_usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->vol_usaha->Param, "CustomMsg");
        $this->Fields['vol_usaha'] = &$this->vol_usaha;

        // vol_usaha_lainya
        $this->vol_usaha_lainya = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_vol_usaha_lainya', 'vol_usaha_lainya', '`vol_usaha_lainya`', '`vol_usaha_lainya`', 5, 22, -1, false, '`vol_usaha_lainya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vol_usaha_lainya->Sortable = true; // Allow sort
        $this->vol_usaha_lainya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->vol_usaha_lainya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->vol_usaha_lainya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->vol_usaha_lainya->Param, "CustomMsg");
        $this->Fields['vol_usaha_lainya'] = &$this->vol_usaha_lainya;

        // vol_usaha_jml
        $this->vol_usaha_jml = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_vol_usaha_jml', 'vol_usaha_jml', '`vol_usaha_jml`', '`vol_usaha_jml`', 5, 22, -1, false, '`vol_usaha_jml`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vol_usaha_jml->Sortable = true; // Allow sort
        $this->vol_usaha_jml->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->vol_usaha_jml->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->vol_usaha_jml->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->vol_usaha_jml->Param, "CustomMsg");
        $this->Fields['vol_usaha_jml'] = &$this->vol_usaha_jml;

        // vol_usaha_tahunlalu
        $this->vol_usaha_tahunlalu = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_vol_usaha_tahunlalu', 'vol_usaha_tahunlalu', '`vol_usaha_tahunlalu`', '`vol_usaha_tahunlalu`', 5, 22, -1, false, '`vol_usaha_tahunlalu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->vol_usaha_tahunlalu->Sortable = true; // Allow sort
        $this->vol_usaha_tahunlalu->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->vol_usaha_tahunlalu->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->vol_usaha_tahunlalu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->vol_usaha_tahunlalu->Param, "CustomMsg");
        $this->Fields['vol_usaha_tahunlalu'] = &$this->vol_usaha_tahunlalu;

        // shu
        $this->shu = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_shu', 'shu', '`shu`', '`shu`', 5, 22, -1, false, '`shu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->shu->Sortable = true; // Allow sort
        $this->shu->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->shu->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->shu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->shu->Param, "CustomMsg");
        $this->Fields['shu'] = &$this->shu;

        // pedpt
        $this->pedpt = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pedpt', 'pedpt', '`pedpt`', '`pedpt`', 5, 22, -1, false, '`pedpt`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pedpt->Sortable = true; // Allow sort
        $this->pedpt->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pedpt->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pedpt->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pedpt->Param, "CustomMsg");
        $this->Fields['pedpt'] = &$this->pedpt;

        // biaya
        $this->biaya = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_biaya', 'biaya', '`biaya`', '`biaya`', 5, 22, -1, false, '`biaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->biaya->Sortable = true; // Allow sort
        $this->biaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->biaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->biaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->biaya->Param, "CustomMsg");
        $this->Fields['biaya'] = &$this->biaya;

        // ms_sp
        $this->ms_sp = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_sp', 'ms_sp', '`ms_sp`', '`ms_sp`', 5, 22, -1, false, '`ms_sp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_sp->Sortable = true; // Allow sort
        $this->ms_sp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_sp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_sp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_sp->Param, "CustomMsg");
        $this->Fields['ms_sp'] = &$this->ms_sp;

        // ms_sw
        $this->ms_sw = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_sw', 'ms_sw', '`ms_sw`', '`ms_sw`', 5, 22, -1, false, '`ms_sw`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_sw->Sortable = true; // Allow sort
        $this->ms_sw->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_sw->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_sw->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_sw->Param, "CustomMsg");
        $this->Fields['ms_sw'] = &$this->ms_sw;

        // ms_khusus
        $this->ms_khusus = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_khusus', 'ms_khusus', '`ms_khusus`', '`ms_khusus`', 5, 22, -1, false, '`ms_khusus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_khusus->Sortable = true; // Allow sort
        $this->ms_khusus->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_khusus->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_khusus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_khusus->Param, "CustomMsg");
        $this->Fields['ms_khusus'] = &$this->ms_khusus;

        // ms_cad
        $this->ms_cad = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_cad', 'ms_cad', '`ms_cad`', '`ms_cad`', 5, 22, -1, false, '`ms_cad`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_cad->Sortable = true; // Allow sort
        $this->ms_cad->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_cad->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_cad->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_cad->Param, "CustomMsg");
        $this->Fields['ms_cad'] = &$this->ms_cad;

        // ms_hibah
        $this->ms_hibah = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_hibah', 'ms_hibah', '`ms_hibah`', '`ms_hibah`', 5, 22, -1, false, '`ms_hibah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_hibah->Sortable = true; // Allow sort
        $this->ms_hibah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_hibah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_hibah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_hibah->Param, "CustomMsg");
        $this->Fields['ms_hibah'] = &$this->ms_hibah;

        // ms_shu_belumdibagi
        $this->ms_shu_belumdibagi = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_shu_belumdibagi', 'ms_shu_belumdibagi', '`ms_shu_belumdibagi`', '`ms_shu_belumdibagi`', 5, 22, -1, false, '`ms_shu_belumdibagi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_shu_belumdibagi->Sortable = true; // Allow sort
        $this->ms_shu_belumdibagi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_shu_belumdibagi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_shu_belumdibagi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_shu_belumdibagi->Param, "CustomMsg");
        $this->Fields['ms_shu_belumdibagi'] = &$this->ms_shu_belumdibagi;

        // ms_dana_cadlain
        $this->ms_dana_cadlain = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_dana_cadlain', 'ms_dana_cadlain', '`ms_dana_cadlain`', '`ms_dana_cadlain`', 5, 22, -1, false, '`ms_dana_cadlain`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_dana_cadlain->Sortable = true; // Allow sort
        $this->ms_dana_cadlain->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_dana_cadlain->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_dana_cadlain->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_dana_cadlain->Param, "CustomMsg");
        $this->Fields['ms_dana_cadlain'] = &$this->ms_dana_cadlain;

        // ms_modal_penyerta
        $this->ms_modal_penyerta = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_modal_penyerta', 'ms_modal_penyerta', '`ms_modal_penyerta`', '`ms_modal_penyerta`', 5, 22, -1, false, '`ms_modal_penyerta`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_modal_penyerta->Sortable = true; // Allow sort
        $this->ms_modal_penyerta->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_modal_penyerta->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_modal_penyerta->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_modal_penyerta->Param, "CustomMsg");
        $this->Fields['ms_modal_penyerta'] = &$this->ms_modal_penyerta;

        // ms_jumlah
        $this->ms_jumlah = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_ms_jumlah', 'ms_jumlah', '`ms_jumlah`', '`ms_jumlah`', 5, 22, -1, false, '`ms_jumlah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->ms_jumlah->Sortable = true; // Allow sort
        $this->ms_jumlah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->ms_jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->ms_jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->ms_jumlah->Param, "CustomMsg");
        $this->Fields['ms_jumlah'] = &$this->ms_jumlah;

        // pinjaman_sp
        $this->pinjaman_sp = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pinjaman_sp', 'pinjaman_sp', '`pinjaman_sp`', '`pinjaman_sp`', 5, 22, -1, false, '`pinjaman_sp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pinjaman_sp->Sortable = true; // Allow sort
        $this->pinjaman_sp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pinjaman_sp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pinjaman_sp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pinjaman_sp->Param, "CustomMsg");
        $this->Fields['pinjaman_sp'] = &$this->pinjaman_sp;

        // pinjaman_lainya
        $this->pinjaman_lainya = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pinjaman_lainya', 'pinjaman_lainya', '`pinjaman_lainya`', '`pinjaman_lainya`', 5, 22, -1, false, '`pinjaman_lainya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pinjaman_lainya->Sortable = true; // Allow sort
        $this->pinjaman_lainya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pinjaman_lainya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pinjaman_lainya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pinjaman_lainya->Param, "CustomMsg");
        $this->Fields['pinjaman_lainya'] = &$this->pinjaman_lainya;

        // pinjaman_jumlah
        $this->pinjaman_jumlah = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_pinjaman_jumlah', 'pinjaman_jumlah', '`pinjaman_jumlah`', '`pinjaman_jumlah`', 5, 22, -1, false, '`pinjaman_jumlah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->pinjaman_jumlah->Sortable = true; // Allow sort
        $this->pinjaman_jumlah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->pinjaman_jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->pinjaman_jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->pinjaman_jumlah->Param, "CustomMsg");
        $this->Fields['pinjaman_jumlah'] = &$this->pinjaman_jumlah;

        // jml_dana
        $this->jml_dana = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_jml_dana', 'jml_dana', '`jml_dana`', '`jml_dana`', 5, 22, -1, false, '`jml_dana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_dana->Sortable = true; // Allow sort
        $this->jml_dana->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_dana->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_dana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_dana->Param, "CustomMsg");
        $this->Fields['jml_dana'] = &$this->jml_dana;

        // investasi_jangka_panjang
        $this->investasi_jangka_panjang = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_investasi_jangka_panjang', 'investasi_jangka_panjang', '`investasi_jangka_panjang`', '`investasi_jangka_panjang`', 5, 22, -1, false, '`investasi_jangka_panjang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->investasi_jangka_panjang->Sortable = true; // Allow sort
        $this->investasi_jangka_panjang->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->investasi_jangka_panjang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->investasi_jangka_panjang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->investasi_jangka_panjang->Param, "CustomMsg");
        $this->Fields['investasi_jangka_panjang'] = &$this->investasi_jangka_panjang;

        // simpanan_lainya
        $this->simpanan_lainya = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_simpanan_lainya', 'simpanan_lainya', '`simpanan_lainya`', '`simpanan_lainya`', 5, 22, -1, false, '`simpanan_lainya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->simpanan_lainya->Sortable = true; // Allow sort
        $this->simpanan_lainya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->simpanan_lainya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->simpanan_lainya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->simpanan_lainya->Param, "CustomMsg");
        $this->Fields['simpanan_lainya'] = &$this->simpanan_lainya;

        // simpanan_sukarela
        $this->simpanan_sukarela = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_simpanan_sukarela', 'simpanan_sukarela', '`simpanan_sukarela`', '`simpanan_sukarela`', 5, 22, -1, false, '`simpanan_sukarela`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->simpanan_sukarela->Sortable = true; // Allow sort
        $this->simpanan_sukarela->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->simpanan_sukarela->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->simpanan_sukarela->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->simpanan_sukarela->Param, "CustomMsg");
        $this->Fields['simpanan_sukarela'] = &$this->simpanan_sukarela;

        // simpanan_jumlah
        $this->simpanan_jumlah = new DbField('kop_aktif_pasif', 'kop_aktif_pasif', 'x_simpanan_jumlah', 'simpanan_jumlah', '`simpanan_jumlah`', '`simpanan_jumlah`', 5, 22, -1, false, '`simpanan_jumlah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->simpanan_jumlah->Sortable = true; // Allow sort
        $this->simpanan_jumlah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->simpanan_jumlah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->simpanan_jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->simpanan_jumlah->Param, "CustomMsg");
        $this->Fields['simpanan_jumlah'] = &$this->simpanan_jumlah;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`kop_aktif_pasif`";
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
        $this->binaan->DbValue = $row['binaan'];
        $this->thn_periode->DbValue = $row['thn_periode'];
        $this->periode->DbValue = $row['periode'];
        $this->nama_koperasi->DbValue = $row['nama_koperasi'];
        $this->akte->DbValue = $row['akte'];
        $this->tanggal_pendirian->DbValue = $row['tanggal_pendirian'];
        $this->alamat_jalan->DbValue = $row['alamat_jalan'];
        $this->kapanewon->DbValue = $row['kapanewon'];
        $this->kalurahan->DbValue = $row['kalurahan'];
        $this->alamat_kodepos->DbValue = $row['alamat_kodepos'];
        $this->telp->DbValue = $row['telp'];
        $this->fax->DbValue = $row['fax'];
        $this->_email->DbValue = $row['email'];
        $this->website->DbValue = $row['website'];
        $this->aktif->DbValue = $row['aktif'];
        $this->pasif->DbValue = $row['pasif'];
        $this->bentuk_koperasi->DbValue = $row['bentuk_koperasi'];
        $this->bentuk_ekonomi->DbValue = $row['bentuk_ekonomi'];
        $this->kelompok_koperasi->DbValue = $row['kelompok_koperasi'];
        $this->jns_koperasi->DbValue = $row['jns_koperasi'];
        $this->pengurus_ketua->DbValue = $row['pengurus_ketua'];
        $this->pengurus_sekertartaris->DbValue = $row['pengurus_sekertartaris'];
        $this->pengurus_bendahara->DbValue = $row['pengurus_bendahara'];
        $this->pengurus_masa_jabatan->DbValue = $row['pengurus_masa_jabatan'];
        $this->pengawas_ketua->DbValue = $row['pengawas_ketua'];
        $this->pengawas_anggota_1->DbValue = $row['pengawas_anggota_1'];
        $this->pengawas_anggota_2->DbValue = $row['pengawas_anggota_2'];
        $this->pengawas_masa_jabatan->DbValue = $row['pengawas_masa_jabatan'];
        $this->manajer->DbValue = $row['manajer'];
        $this->pemeringkatan_klasifikasi->DbValue = $row['pemeringkatan_klasifikasi'];
        $this->kesehatan_koperasi_status->DbValue = $row['kesehatan_koperasi_status'];
        $this->kesehatan_koperasi_angka->DbValue = $row['kesehatan_koperasi_angka'];
        $this->anggota_l->DbValue = $row['anggota_l'];
        $this->anggota_p->DbValue = $row['anggota_p'];
        $this->anggota_jml->DbValue = $row['anggota_jml'];
        $this->anggota_calon->DbValue = $row['anggota_calon'];
        $this->pengurus_l->DbValue = $row['pengurus_l'];
        $this->pengurus_p->DbValue = $row['pengurus_p'];
        $this->pengurus_jml->DbValue = $row['pengurus_jml'];
        $this->pengawas_l->DbValue = $row['pengawas_l'];
        $this->pengawas_p->DbValue = $row['pengawas_p'];
        $this->pengawas_jml->DbValue = $row['pengawas_jml'];
        $this->karyawan_l->DbValue = $row['karyawan_l'];
        $this->karyawan_p->DbValue = $row['karyawan_p'];
        $this->karyawan_jml->DbValue = $row['karyawan_jml'];
        $this->manajer_l->DbValue = $row['manajer_l'];
        $this->manajer_p->DbValue = $row['manajer_p'];
        $this->manajer_jml->DbValue = $row['manajer_jml'];
        $this->rat_buku->DbValue = $row['rat_buku'];
        $this->rat_tanggal->DbValue = $row['rat_tanggal'];
        $this->rat->DbValue = $row['rat'];
        $this->indikator_usaha->DbValue = $row['indikator_usaha'];
        $this->modal_luar->DbValue = $row['modal_luar'];
        $this->aset->DbValue = $row['aset'];
        $this->vol_usaha->DbValue = $row['vol_usaha'];
        $this->vol_usaha_lainya->DbValue = $row['vol_usaha_lainya'];
        $this->vol_usaha_jml->DbValue = $row['vol_usaha_jml'];
        $this->vol_usaha_tahunlalu->DbValue = $row['vol_usaha_tahunlalu'];
        $this->shu->DbValue = $row['shu'];
        $this->pedpt->DbValue = $row['pedpt'];
        $this->biaya->DbValue = $row['biaya'];
        $this->ms_sp->DbValue = $row['ms_sp'];
        $this->ms_sw->DbValue = $row['ms_sw'];
        $this->ms_khusus->DbValue = $row['ms_khusus'];
        $this->ms_cad->DbValue = $row['ms_cad'];
        $this->ms_hibah->DbValue = $row['ms_hibah'];
        $this->ms_shu_belumdibagi->DbValue = $row['ms_shu_belumdibagi'];
        $this->ms_dana_cadlain->DbValue = $row['ms_dana_cadlain'];
        $this->ms_modal_penyerta->DbValue = $row['ms_modal_penyerta'];
        $this->ms_jumlah->DbValue = $row['ms_jumlah'];
        $this->pinjaman_sp->DbValue = $row['pinjaman_sp'];
        $this->pinjaman_lainya->DbValue = $row['pinjaman_lainya'];
        $this->pinjaman_jumlah->DbValue = $row['pinjaman_jumlah'];
        $this->jml_dana->DbValue = $row['jml_dana'];
        $this->investasi_jangka_panjang->DbValue = $row['investasi_jangka_panjang'];
        $this->simpanan_lainya->DbValue = $row['simpanan_lainya'];
        $this->simpanan_sukarela->DbValue = $row['simpanan_sukarela'];
        $this->simpanan_jumlah->DbValue = $row['simpanan_jumlah'];
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
        return $_SESSION[$name] ?? GetUrl("kopaktifpasiflist");
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
        if ($pageName == "kopaktifpasifview") {
            return $Language->phrase("View");
        } elseif ($pageName == "kopaktifpasifedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "kopaktifpasifadd") {
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
                return "KopAktifPasifView";
            case Config("API_ADD_ACTION"):
                return "KopAktifPasifAdd";
            case Config("API_EDIT_ACTION"):
                return "KopAktifPasifEdit";
            case Config("API_DELETE_ACTION"):
                return "KopAktifPasifDelete";
            case Config("API_LIST_ACTION"):
                return "KopAktifPasifList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "kopaktifpasiflist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("kopaktifpasifview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("kopaktifpasifview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "kopaktifpasifadd?" . $this->getUrlParm($parm);
        } else {
            $url = "kopaktifpasifadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("kopaktifpasifedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("kopaktifpasifadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("kopaktifpasifdelete", $this->getUrlParm());
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
        $this->binaan->setDbValue($row['binaan']);
        $this->thn_periode->setDbValue($row['thn_periode']);
        $this->periode->setDbValue($row['periode']);
        $this->nama_koperasi->setDbValue($row['nama_koperasi']);
        $this->akte->setDbValue($row['akte']);
        $this->tanggal_pendirian->setDbValue($row['tanggal_pendirian']);
        $this->alamat_jalan->setDbValue($row['alamat_jalan']);
        $this->kapanewon->setDbValue($row['kapanewon']);
        $this->kalurahan->setDbValue($row['kalurahan']);
        $this->alamat_kodepos->setDbValue($row['alamat_kodepos']);
        $this->telp->setDbValue($row['telp']);
        $this->fax->setDbValue($row['fax']);
        $this->_email->setDbValue($row['email']);
        $this->website->setDbValue($row['website']);
        $this->aktif->setDbValue($row['aktif']);
        $this->pasif->setDbValue($row['pasif']);
        $this->bentuk_koperasi->setDbValue($row['bentuk_koperasi']);
        $this->bentuk_ekonomi->setDbValue($row['bentuk_ekonomi']);
        $this->kelompok_koperasi->setDbValue($row['kelompok_koperasi']);
        $this->jns_koperasi->setDbValue($row['jns_koperasi']);
        $this->pengurus_ketua->setDbValue($row['pengurus_ketua']);
        $this->pengurus_sekertartaris->setDbValue($row['pengurus_sekertartaris']);
        $this->pengurus_bendahara->setDbValue($row['pengurus_bendahara']);
        $this->pengurus_masa_jabatan->setDbValue($row['pengurus_masa_jabatan']);
        $this->pengawas_ketua->setDbValue($row['pengawas_ketua']);
        $this->pengawas_anggota_1->setDbValue($row['pengawas_anggota_1']);
        $this->pengawas_anggota_2->setDbValue($row['pengawas_anggota_2']);
        $this->pengawas_masa_jabatan->setDbValue($row['pengawas_masa_jabatan']);
        $this->manajer->setDbValue($row['manajer']);
        $this->pemeringkatan_klasifikasi->setDbValue($row['pemeringkatan_klasifikasi']);
        $this->kesehatan_koperasi_status->setDbValue($row['kesehatan_koperasi_status']);
        $this->kesehatan_koperasi_angka->setDbValue($row['kesehatan_koperasi_angka']);
        $this->anggota_l->setDbValue($row['anggota_l']);
        $this->anggota_p->setDbValue($row['anggota_p']);
        $this->anggota_jml->setDbValue($row['anggota_jml']);
        $this->anggota_calon->setDbValue($row['anggota_calon']);
        $this->pengurus_l->setDbValue($row['pengurus_l']);
        $this->pengurus_p->setDbValue($row['pengurus_p']);
        $this->pengurus_jml->setDbValue($row['pengurus_jml']);
        $this->pengawas_l->setDbValue($row['pengawas_l']);
        $this->pengawas_p->setDbValue($row['pengawas_p']);
        $this->pengawas_jml->setDbValue($row['pengawas_jml']);
        $this->karyawan_l->setDbValue($row['karyawan_l']);
        $this->karyawan_p->setDbValue($row['karyawan_p']);
        $this->karyawan_jml->setDbValue($row['karyawan_jml']);
        $this->manajer_l->setDbValue($row['manajer_l']);
        $this->manajer_p->setDbValue($row['manajer_p']);
        $this->manajer_jml->setDbValue($row['manajer_jml']);
        $this->rat_buku->setDbValue($row['rat_buku']);
        $this->rat_tanggal->setDbValue($row['rat_tanggal']);
        $this->rat->setDbValue($row['rat']);
        $this->indikator_usaha->setDbValue($row['indikator_usaha']);
        $this->modal_luar->setDbValue($row['modal_luar']);
        $this->aset->setDbValue($row['aset']);
        $this->vol_usaha->setDbValue($row['vol_usaha']);
        $this->vol_usaha_lainya->setDbValue($row['vol_usaha_lainya']);
        $this->vol_usaha_jml->setDbValue($row['vol_usaha_jml']);
        $this->vol_usaha_tahunlalu->setDbValue($row['vol_usaha_tahunlalu']);
        $this->shu->setDbValue($row['shu']);
        $this->pedpt->setDbValue($row['pedpt']);
        $this->biaya->setDbValue($row['biaya']);
        $this->ms_sp->setDbValue($row['ms_sp']);
        $this->ms_sw->setDbValue($row['ms_sw']);
        $this->ms_khusus->setDbValue($row['ms_khusus']);
        $this->ms_cad->setDbValue($row['ms_cad']);
        $this->ms_hibah->setDbValue($row['ms_hibah']);
        $this->ms_shu_belumdibagi->setDbValue($row['ms_shu_belumdibagi']);
        $this->ms_dana_cadlain->setDbValue($row['ms_dana_cadlain']);
        $this->ms_modal_penyerta->setDbValue($row['ms_modal_penyerta']);
        $this->ms_jumlah->setDbValue($row['ms_jumlah']);
        $this->pinjaman_sp->setDbValue($row['pinjaman_sp']);
        $this->pinjaman_lainya->setDbValue($row['pinjaman_lainya']);
        $this->pinjaman_jumlah->setDbValue($row['pinjaman_jumlah']);
        $this->jml_dana->setDbValue($row['jml_dana']);
        $this->investasi_jangka_panjang->setDbValue($row['investasi_jangka_panjang']);
        $this->simpanan_lainya->setDbValue($row['simpanan_lainya']);
        $this->simpanan_sukarela->setDbValue($row['simpanan_sukarela']);
        $this->simpanan_jumlah->setDbValue($row['simpanan_jumlah']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // binaan

        // thn_periode

        // periode

        // nama_koperasi

        // akte

        // tanggal_pendirian

        // alamat_jalan

        // kapanewon

        // kalurahan

        // alamat_kodepos

        // telp

        // fax

        // email

        // website

        // aktif

        // pasif

        // bentuk_koperasi

        // bentuk_ekonomi

        // kelompok_koperasi

        // jns_koperasi

        // pengurus_ketua

        // pengurus_sekertartaris

        // pengurus_bendahara

        // pengurus_masa_jabatan

        // pengawas_ketua

        // pengawas_anggota_1

        // pengawas_anggota_2

        // pengawas_masa_jabatan

        // manajer

        // pemeringkatan_klasifikasi

        // kesehatan_koperasi_status

        // kesehatan_koperasi_angka

        // anggota_l

        // anggota_p

        // anggota_jml

        // anggota_calon

        // pengurus_l

        // pengurus_p

        // pengurus_jml

        // pengawas_l

        // pengawas_p

        // pengawas_jml

        // karyawan_l

        // karyawan_p

        // karyawan_jml

        // manajer_l

        // manajer_p

        // manajer_jml

        // rat_buku

        // rat_tanggal

        // rat

        // indikator_usaha

        // modal_luar

        // aset

        // vol_usaha

        // vol_usaha_lainya

        // vol_usaha_jml

        // vol_usaha_tahunlalu

        // shu

        // pedpt

        // biaya

        // ms_sp

        // ms_sw

        // ms_khusus

        // ms_cad

        // ms_hibah

        // ms_shu_belumdibagi

        // ms_dana_cadlain

        // ms_modal_penyerta

        // ms_jumlah

        // pinjaman_sp

        // pinjaman_lainya

        // pinjaman_jumlah

        // jml_dana

        // investasi_jangka_panjang

        // simpanan_lainya

        // simpanan_sukarela

        // simpanan_jumlah

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // binaan
        $this->binaan->ViewValue = $this->binaan->CurrentValue;
        $this->binaan->ViewCustomAttributes = "";

        // thn_periode
        $this->thn_periode->ViewValue = $this->thn_periode->CurrentValue;
        $this->thn_periode->ViewValue = FormatNumber($this->thn_periode->ViewValue, 0, -2, -2, -2);
        $this->thn_periode->ViewCustomAttributes = "";

        // periode
        $this->periode->ViewValue = $this->periode->CurrentValue;
        $this->periode->ViewValue = FormatNumber($this->periode->ViewValue, 0, -2, -2, -2);
        $this->periode->ViewCustomAttributes = "";

        // nama_koperasi
        $this->nama_koperasi->ViewValue = $this->nama_koperasi->CurrentValue;
        $this->nama_koperasi->ViewCustomAttributes = "";

        // akte
        $this->akte->ViewValue = $this->akte->CurrentValue;
        $this->akte->ViewCustomAttributes = "";

        // tanggal_pendirian
        $this->tanggal_pendirian->ViewValue = $this->tanggal_pendirian->CurrentValue;
        $this->tanggal_pendirian->ViewValue = FormatDateTime($this->tanggal_pendirian->ViewValue, 0);
        $this->tanggal_pendirian->ViewCustomAttributes = "";

        // alamat_jalan
        $this->alamat_jalan->ViewValue = $this->alamat_jalan->CurrentValue;
        $this->alamat_jalan->ViewCustomAttributes = "";

        // kapanewon
        $this->kapanewon->ViewValue = $this->kapanewon->CurrentValue;
        $this->kapanewon->ViewCustomAttributes = "";

        // kalurahan
        $this->kalurahan->ViewValue = $this->kalurahan->CurrentValue;
        $this->kalurahan->ViewCustomAttributes = "";

        // alamat_kodepos
        $this->alamat_kodepos->ViewValue = $this->alamat_kodepos->CurrentValue;
        $this->alamat_kodepos->ViewCustomAttributes = "";

        // telp
        $this->telp->ViewValue = $this->telp->CurrentValue;
        $this->telp->ViewCustomAttributes = "";

        // fax
        $this->fax->ViewValue = $this->fax->CurrentValue;
        $this->fax->ViewCustomAttributes = "";

        // email
        $this->_email->ViewValue = $this->_email->CurrentValue;
        $this->_email->ViewCustomAttributes = "";

        // website
        $this->website->ViewValue = $this->website->CurrentValue;
        $this->website->ViewCustomAttributes = "";

        // aktif
        $this->aktif->ViewValue = $this->aktif->CurrentValue;
        $this->aktif->ViewCustomAttributes = "";

        // pasif
        $this->pasif->ViewValue = $this->pasif->CurrentValue;
        $this->pasif->ViewCustomAttributes = "";

        // bentuk_koperasi
        $this->bentuk_koperasi->ViewValue = $this->bentuk_koperasi->CurrentValue;
        $this->bentuk_koperasi->ViewCustomAttributes = "";

        // bentuk_ekonomi
        $this->bentuk_ekonomi->ViewValue = $this->bentuk_ekonomi->CurrentValue;
        $this->bentuk_ekonomi->ViewCustomAttributes = "";

        // kelompok_koperasi
        $this->kelompok_koperasi->ViewValue = $this->kelompok_koperasi->CurrentValue;
        $this->kelompok_koperasi->ViewCustomAttributes = "";

        // jns_koperasi
        $this->jns_koperasi->ViewValue = $this->jns_koperasi->CurrentValue;
        $this->jns_koperasi->ViewCustomAttributes = "";

        // pengurus_ketua
        $this->pengurus_ketua->ViewValue = $this->pengurus_ketua->CurrentValue;
        $this->pengurus_ketua->ViewCustomAttributes = "";

        // pengurus_sekertartaris
        $this->pengurus_sekertartaris->ViewValue = $this->pengurus_sekertartaris->CurrentValue;
        $this->pengurus_sekertartaris->ViewCustomAttributes = "";

        // pengurus_bendahara
        $this->pengurus_bendahara->ViewValue = $this->pengurus_bendahara->CurrentValue;
        $this->pengurus_bendahara->ViewCustomAttributes = "";

        // pengurus_masa_jabatan
        $this->pengurus_masa_jabatan->ViewValue = $this->pengurus_masa_jabatan->CurrentValue;
        $this->pengurus_masa_jabatan->ViewCustomAttributes = "";

        // pengawas_ketua
        $this->pengawas_ketua->ViewValue = $this->pengawas_ketua->CurrentValue;
        $this->pengawas_ketua->ViewCustomAttributes = "";

        // pengawas_anggota_1
        $this->pengawas_anggota_1->ViewValue = $this->pengawas_anggota_1->CurrentValue;
        $this->pengawas_anggota_1->ViewCustomAttributes = "";

        // pengawas_anggota_2
        $this->pengawas_anggota_2->ViewValue = $this->pengawas_anggota_2->CurrentValue;
        $this->pengawas_anggota_2->ViewCustomAttributes = "";

        // pengawas_masa_jabatan
        $this->pengawas_masa_jabatan->ViewValue = $this->pengawas_masa_jabatan->CurrentValue;
        $this->pengawas_masa_jabatan->ViewCustomAttributes = "";

        // manajer
        $this->manajer->ViewValue = $this->manajer->CurrentValue;
        $this->manajer->ViewCustomAttributes = "";

        // pemeringkatan_klasifikasi
        $this->pemeringkatan_klasifikasi->ViewValue = $this->pemeringkatan_klasifikasi->CurrentValue;
        $this->pemeringkatan_klasifikasi->ViewCustomAttributes = "";

        // kesehatan_koperasi_status
        $this->kesehatan_koperasi_status->ViewValue = $this->kesehatan_koperasi_status->CurrentValue;
        $this->kesehatan_koperasi_status->ViewCustomAttributes = "";

        // kesehatan_koperasi_angka
        $this->kesehatan_koperasi_angka->ViewValue = $this->kesehatan_koperasi_angka->CurrentValue;
        $this->kesehatan_koperasi_angka->ViewValue = FormatNumber($this->kesehatan_koperasi_angka->ViewValue, 2, -2, -2, -2);
        $this->kesehatan_koperasi_angka->ViewCustomAttributes = "";

        // anggota_l
        $this->anggota_l->ViewValue = $this->anggota_l->CurrentValue;
        $this->anggota_l->ViewValue = FormatNumber($this->anggota_l->ViewValue, 0, -2, -2, -2);
        $this->anggota_l->ViewCustomAttributes = "";

        // anggota_p
        $this->anggota_p->ViewValue = $this->anggota_p->CurrentValue;
        $this->anggota_p->ViewValue = FormatNumber($this->anggota_p->ViewValue, 0, -2, -2, -2);
        $this->anggota_p->ViewCustomAttributes = "";

        // anggota_jml
        $this->anggota_jml->ViewValue = $this->anggota_jml->CurrentValue;
        $this->anggota_jml->ViewValue = FormatNumber($this->anggota_jml->ViewValue, 0, -2, -2, -2);
        $this->anggota_jml->ViewCustomAttributes = "";

        // anggota_calon
        $this->anggota_calon->ViewValue = $this->anggota_calon->CurrentValue;
        $this->anggota_calon->ViewValue = FormatNumber($this->anggota_calon->ViewValue, 0, -2, -2, -2);
        $this->anggota_calon->ViewCustomAttributes = "";

        // pengurus_l
        $this->pengurus_l->ViewValue = $this->pengurus_l->CurrentValue;
        $this->pengurus_l->ViewValue = FormatNumber($this->pengurus_l->ViewValue, 0, -2, -2, -2);
        $this->pengurus_l->ViewCustomAttributes = "";

        // pengurus_p
        $this->pengurus_p->ViewValue = $this->pengurus_p->CurrentValue;
        $this->pengurus_p->ViewValue = FormatNumber($this->pengurus_p->ViewValue, 0, -2, -2, -2);
        $this->pengurus_p->ViewCustomAttributes = "";

        // pengurus_jml
        $this->pengurus_jml->ViewValue = $this->pengurus_jml->CurrentValue;
        $this->pengurus_jml->ViewValue = FormatNumber($this->pengurus_jml->ViewValue, 0, -2, -2, -2);
        $this->pengurus_jml->ViewCustomAttributes = "";

        // pengawas_l
        $this->pengawas_l->ViewValue = $this->pengawas_l->CurrentValue;
        $this->pengawas_l->ViewValue = FormatNumber($this->pengawas_l->ViewValue, 0, -2, -2, -2);
        $this->pengawas_l->ViewCustomAttributes = "";

        // pengawas_p
        $this->pengawas_p->ViewValue = $this->pengawas_p->CurrentValue;
        $this->pengawas_p->ViewValue = FormatNumber($this->pengawas_p->ViewValue, 0, -2, -2, -2);
        $this->pengawas_p->ViewCustomAttributes = "";

        // pengawas_jml
        $this->pengawas_jml->ViewValue = $this->pengawas_jml->CurrentValue;
        $this->pengawas_jml->ViewValue = FormatNumber($this->pengawas_jml->ViewValue, 0, -2, -2, -2);
        $this->pengawas_jml->ViewCustomAttributes = "";

        // karyawan_l
        $this->karyawan_l->ViewValue = $this->karyawan_l->CurrentValue;
        $this->karyawan_l->ViewValue = FormatNumber($this->karyawan_l->ViewValue, 0, -2, -2, -2);
        $this->karyawan_l->ViewCustomAttributes = "";

        // karyawan_p
        $this->karyawan_p->ViewValue = $this->karyawan_p->CurrentValue;
        $this->karyawan_p->ViewValue = FormatNumber($this->karyawan_p->ViewValue, 0, -2, -2, -2);
        $this->karyawan_p->ViewCustomAttributes = "";

        // karyawan_jml
        $this->karyawan_jml->ViewValue = $this->karyawan_jml->CurrentValue;
        $this->karyawan_jml->ViewValue = FormatNumber($this->karyawan_jml->ViewValue, 0, -2, -2, -2);
        $this->karyawan_jml->ViewCustomAttributes = "";

        // manajer_l
        $this->manajer_l->ViewValue = $this->manajer_l->CurrentValue;
        $this->manajer_l->ViewValue = FormatNumber($this->manajer_l->ViewValue, 0, -2, -2, -2);
        $this->manajer_l->ViewCustomAttributes = "";

        // manajer_p
        $this->manajer_p->ViewValue = $this->manajer_p->CurrentValue;
        $this->manajer_p->ViewValue = FormatNumber($this->manajer_p->ViewValue, 0, -2, -2, -2);
        $this->manajer_p->ViewCustomAttributes = "";

        // manajer_jml
        $this->manajer_jml->ViewValue = $this->manajer_jml->CurrentValue;
        $this->manajer_jml->ViewValue = FormatNumber($this->manajer_jml->ViewValue, 0, -2, -2, -2);
        $this->manajer_jml->ViewCustomAttributes = "";

        // rat_buku
        $this->rat_buku->ViewValue = $this->rat_buku->CurrentValue;
        $this->rat_buku->ViewCustomAttributes = "";

        // rat_tanggal
        $this->rat_tanggal->ViewValue = $this->rat_tanggal->CurrentValue;
        $this->rat_tanggal->ViewCustomAttributes = "";

        // rat
        $this->rat->ViewValue = $this->rat->CurrentValue;
        $this->rat->ViewValue = FormatNumber($this->rat->ViewValue, 0, -2, -2, -2);
        $this->rat->ViewCustomAttributes = "";

        // indikator_usaha
        $this->indikator_usaha->ViewValue = $this->indikator_usaha->CurrentValue;
        $this->indikator_usaha->ViewCustomAttributes = "";

        // modal_luar
        $this->modal_luar->ViewValue = $this->modal_luar->CurrentValue;
        $this->modal_luar->ViewValue = FormatNumber($this->modal_luar->ViewValue, 2, -2, -2, -2);
        $this->modal_luar->ViewCustomAttributes = "";

        // aset
        $this->aset->ViewValue = $this->aset->CurrentValue;
        $this->aset->ViewValue = FormatNumber($this->aset->ViewValue, 2, -2, -2, -2);
        $this->aset->ViewCustomAttributes = "";

        // vol_usaha
        $this->vol_usaha->ViewValue = $this->vol_usaha->CurrentValue;
        $this->vol_usaha->ViewValue = FormatNumber($this->vol_usaha->ViewValue, 2, -2, -2, -2);
        $this->vol_usaha->ViewCustomAttributes = "";

        // vol_usaha_lainya
        $this->vol_usaha_lainya->ViewValue = $this->vol_usaha_lainya->CurrentValue;
        $this->vol_usaha_lainya->ViewValue = FormatNumber($this->vol_usaha_lainya->ViewValue, 2, -2, -2, -2);
        $this->vol_usaha_lainya->ViewCustomAttributes = "";

        // vol_usaha_jml
        $this->vol_usaha_jml->ViewValue = $this->vol_usaha_jml->CurrentValue;
        $this->vol_usaha_jml->ViewValue = FormatNumber($this->vol_usaha_jml->ViewValue, 2, -2, -2, -2);
        $this->vol_usaha_jml->ViewCustomAttributes = "";

        // vol_usaha_tahunlalu
        $this->vol_usaha_tahunlalu->ViewValue = $this->vol_usaha_tahunlalu->CurrentValue;
        $this->vol_usaha_tahunlalu->ViewValue = FormatNumber($this->vol_usaha_tahunlalu->ViewValue, 2, -2, -2, -2);
        $this->vol_usaha_tahunlalu->ViewCustomAttributes = "";

        // shu
        $this->shu->ViewValue = $this->shu->CurrentValue;
        $this->shu->ViewValue = FormatNumber($this->shu->ViewValue, 2, -2, -2, -2);
        $this->shu->ViewCustomAttributes = "";

        // pedpt
        $this->pedpt->ViewValue = $this->pedpt->CurrentValue;
        $this->pedpt->ViewValue = FormatNumber($this->pedpt->ViewValue, 2, -2, -2, -2);
        $this->pedpt->ViewCustomAttributes = "";

        // biaya
        $this->biaya->ViewValue = $this->biaya->CurrentValue;
        $this->biaya->ViewValue = FormatNumber($this->biaya->ViewValue, 2, -2, -2, -2);
        $this->biaya->ViewCustomAttributes = "";

        // ms_sp
        $this->ms_sp->ViewValue = $this->ms_sp->CurrentValue;
        $this->ms_sp->ViewValue = FormatNumber($this->ms_sp->ViewValue, 2, -2, -2, -2);
        $this->ms_sp->ViewCustomAttributes = "";

        // ms_sw
        $this->ms_sw->ViewValue = $this->ms_sw->CurrentValue;
        $this->ms_sw->ViewValue = FormatNumber($this->ms_sw->ViewValue, 2, -2, -2, -2);
        $this->ms_sw->ViewCustomAttributes = "";

        // ms_khusus
        $this->ms_khusus->ViewValue = $this->ms_khusus->CurrentValue;
        $this->ms_khusus->ViewValue = FormatNumber($this->ms_khusus->ViewValue, 2, -2, -2, -2);
        $this->ms_khusus->ViewCustomAttributes = "";

        // ms_cad
        $this->ms_cad->ViewValue = $this->ms_cad->CurrentValue;
        $this->ms_cad->ViewValue = FormatNumber($this->ms_cad->ViewValue, 2, -2, -2, -2);
        $this->ms_cad->ViewCustomAttributes = "";

        // ms_hibah
        $this->ms_hibah->ViewValue = $this->ms_hibah->CurrentValue;
        $this->ms_hibah->ViewValue = FormatNumber($this->ms_hibah->ViewValue, 2, -2, -2, -2);
        $this->ms_hibah->ViewCustomAttributes = "";

        // ms_shu_belumdibagi
        $this->ms_shu_belumdibagi->ViewValue = $this->ms_shu_belumdibagi->CurrentValue;
        $this->ms_shu_belumdibagi->ViewValue = FormatNumber($this->ms_shu_belumdibagi->ViewValue, 2, -2, -2, -2);
        $this->ms_shu_belumdibagi->ViewCustomAttributes = "";

        // ms_dana_cadlain
        $this->ms_dana_cadlain->ViewValue = $this->ms_dana_cadlain->CurrentValue;
        $this->ms_dana_cadlain->ViewValue = FormatNumber($this->ms_dana_cadlain->ViewValue, 2, -2, -2, -2);
        $this->ms_dana_cadlain->ViewCustomAttributes = "";

        // ms_modal_penyerta
        $this->ms_modal_penyerta->ViewValue = $this->ms_modal_penyerta->CurrentValue;
        $this->ms_modal_penyerta->ViewValue = FormatNumber($this->ms_modal_penyerta->ViewValue, 2, -2, -2, -2);
        $this->ms_modal_penyerta->ViewCustomAttributes = "";

        // ms_jumlah
        $this->ms_jumlah->ViewValue = $this->ms_jumlah->CurrentValue;
        $this->ms_jumlah->ViewValue = FormatNumber($this->ms_jumlah->ViewValue, 2, -2, -2, -2);
        $this->ms_jumlah->ViewCustomAttributes = "";

        // pinjaman_sp
        $this->pinjaman_sp->ViewValue = $this->pinjaman_sp->CurrentValue;
        $this->pinjaman_sp->ViewValue = FormatNumber($this->pinjaman_sp->ViewValue, 2, -2, -2, -2);
        $this->pinjaman_sp->ViewCustomAttributes = "";

        // pinjaman_lainya
        $this->pinjaman_lainya->ViewValue = $this->pinjaman_lainya->CurrentValue;
        $this->pinjaman_lainya->ViewValue = FormatNumber($this->pinjaman_lainya->ViewValue, 2, -2, -2, -2);
        $this->pinjaman_lainya->ViewCustomAttributes = "";

        // pinjaman_jumlah
        $this->pinjaman_jumlah->ViewValue = $this->pinjaman_jumlah->CurrentValue;
        $this->pinjaman_jumlah->ViewValue = FormatNumber($this->pinjaman_jumlah->ViewValue, 2, -2, -2, -2);
        $this->pinjaman_jumlah->ViewCustomAttributes = "";

        // jml_dana
        $this->jml_dana->ViewValue = $this->jml_dana->CurrentValue;
        $this->jml_dana->ViewValue = FormatNumber($this->jml_dana->ViewValue, 2, -2, -2, -2);
        $this->jml_dana->ViewCustomAttributes = "";

        // investasi_jangka_panjang
        $this->investasi_jangka_panjang->ViewValue = $this->investasi_jangka_panjang->CurrentValue;
        $this->investasi_jangka_panjang->ViewValue = FormatNumber($this->investasi_jangka_panjang->ViewValue, 2, -2, -2, -2);
        $this->investasi_jangka_panjang->ViewCustomAttributes = "";

        // simpanan_lainya
        $this->simpanan_lainya->ViewValue = $this->simpanan_lainya->CurrentValue;
        $this->simpanan_lainya->ViewValue = FormatNumber($this->simpanan_lainya->ViewValue, 2, -2, -2, -2);
        $this->simpanan_lainya->ViewCustomAttributes = "";

        // simpanan_sukarela
        $this->simpanan_sukarela->ViewValue = $this->simpanan_sukarela->CurrentValue;
        $this->simpanan_sukarela->ViewValue = FormatNumber($this->simpanan_sukarela->ViewValue, 2, -2, -2, -2);
        $this->simpanan_sukarela->ViewCustomAttributes = "";

        // simpanan_jumlah
        $this->simpanan_jumlah->ViewValue = $this->simpanan_jumlah->CurrentValue;
        $this->simpanan_jumlah->ViewValue = FormatNumber($this->simpanan_jumlah->ViewValue, 2, -2, -2, -2);
        $this->simpanan_jumlah->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // binaan
        $this->binaan->LinkCustomAttributes = "";
        $this->binaan->HrefValue = "";
        $this->binaan->TooltipValue = "";

        // thn_periode
        $this->thn_periode->LinkCustomAttributes = "";
        $this->thn_periode->HrefValue = "";
        $this->thn_periode->TooltipValue = "";

        // periode
        $this->periode->LinkCustomAttributes = "";
        $this->periode->HrefValue = "";
        $this->periode->TooltipValue = "";

        // nama_koperasi
        $this->nama_koperasi->LinkCustomAttributes = "";
        $this->nama_koperasi->HrefValue = "";
        $this->nama_koperasi->TooltipValue = "";

        // akte
        $this->akte->LinkCustomAttributes = "";
        $this->akte->HrefValue = "";
        $this->akte->TooltipValue = "";

        // tanggal_pendirian
        $this->tanggal_pendirian->LinkCustomAttributes = "";
        $this->tanggal_pendirian->HrefValue = "";
        $this->tanggal_pendirian->TooltipValue = "";

        // alamat_jalan
        $this->alamat_jalan->LinkCustomAttributes = "";
        $this->alamat_jalan->HrefValue = "";
        $this->alamat_jalan->TooltipValue = "";

        // kapanewon
        $this->kapanewon->LinkCustomAttributes = "";
        $this->kapanewon->HrefValue = "";
        $this->kapanewon->TooltipValue = "";

        // kalurahan
        $this->kalurahan->LinkCustomAttributes = "";
        $this->kalurahan->HrefValue = "";
        $this->kalurahan->TooltipValue = "";

        // alamat_kodepos
        $this->alamat_kodepos->LinkCustomAttributes = "";
        $this->alamat_kodepos->HrefValue = "";
        $this->alamat_kodepos->TooltipValue = "";

        // telp
        $this->telp->LinkCustomAttributes = "";
        $this->telp->HrefValue = "";
        $this->telp->TooltipValue = "";

        // fax
        $this->fax->LinkCustomAttributes = "";
        $this->fax->HrefValue = "";
        $this->fax->TooltipValue = "";

        // email
        $this->_email->LinkCustomAttributes = "";
        $this->_email->HrefValue = "";
        $this->_email->TooltipValue = "";

        // website
        $this->website->LinkCustomAttributes = "";
        $this->website->HrefValue = "";
        $this->website->TooltipValue = "";

        // aktif
        $this->aktif->LinkCustomAttributes = "";
        $this->aktif->HrefValue = "";
        $this->aktif->TooltipValue = "";

        // pasif
        $this->pasif->LinkCustomAttributes = "";
        $this->pasif->HrefValue = "";
        $this->pasif->TooltipValue = "";

        // bentuk_koperasi
        $this->bentuk_koperasi->LinkCustomAttributes = "";
        $this->bentuk_koperasi->HrefValue = "";
        $this->bentuk_koperasi->TooltipValue = "";

        // bentuk_ekonomi
        $this->bentuk_ekonomi->LinkCustomAttributes = "";
        $this->bentuk_ekonomi->HrefValue = "";
        $this->bentuk_ekonomi->TooltipValue = "";

        // kelompok_koperasi
        $this->kelompok_koperasi->LinkCustomAttributes = "";
        $this->kelompok_koperasi->HrefValue = "";
        $this->kelompok_koperasi->TooltipValue = "";

        // jns_koperasi
        $this->jns_koperasi->LinkCustomAttributes = "";
        $this->jns_koperasi->HrefValue = "";
        $this->jns_koperasi->TooltipValue = "";

        // pengurus_ketua
        $this->pengurus_ketua->LinkCustomAttributes = "";
        $this->pengurus_ketua->HrefValue = "";
        $this->pengurus_ketua->TooltipValue = "";

        // pengurus_sekertartaris
        $this->pengurus_sekertartaris->LinkCustomAttributes = "";
        $this->pengurus_sekertartaris->HrefValue = "";
        $this->pengurus_sekertartaris->TooltipValue = "";

        // pengurus_bendahara
        $this->pengurus_bendahara->LinkCustomAttributes = "";
        $this->pengurus_bendahara->HrefValue = "";
        $this->pengurus_bendahara->TooltipValue = "";

        // pengurus_masa_jabatan
        $this->pengurus_masa_jabatan->LinkCustomAttributes = "";
        $this->pengurus_masa_jabatan->HrefValue = "";
        $this->pengurus_masa_jabatan->TooltipValue = "";

        // pengawas_ketua
        $this->pengawas_ketua->LinkCustomAttributes = "";
        $this->pengawas_ketua->HrefValue = "";
        $this->pengawas_ketua->TooltipValue = "";

        // pengawas_anggota_1
        $this->pengawas_anggota_1->LinkCustomAttributes = "";
        $this->pengawas_anggota_1->HrefValue = "";
        $this->pengawas_anggota_1->TooltipValue = "";

        // pengawas_anggota_2
        $this->pengawas_anggota_2->LinkCustomAttributes = "";
        $this->pengawas_anggota_2->HrefValue = "";
        $this->pengawas_anggota_2->TooltipValue = "";

        // pengawas_masa_jabatan
        $this->pengawas_masa_jabatan->LinkCustomAttributes = "";
        $this->pengawas_masa_jabatan->HrefValue = "";
        $this->pengawas_masa_jabatan->TooltipValue = "";

        // manajer
        $this->manajer->LinkCustomAttributes = "";
        $this->manajer->HrefValue = "";
        $this->manajer->TooltipValue = "";

        // pemeringkatan_klasifikasi
        $this->pemeringkatan_klasifikasi->LinkCustomAttributes = "";
        $this->pemeringkatan_klasifikasi->HrefValue = "";
        $this->pemeringkatan_klasifikasi->TooltipValue = "";

        // kesehatan_koperasi_status
        $this->kesehatan_koperasi_status->LinkCustomAttributes = "";
        $this->kesehatan_koperasi_status->HrefValue = "";
        $this->kesehatan_koperasi_status->TooltipValue = "";

        // kesehatan_koperasi_angka
        $this->kesehatan_koperasi_angka->LinkCustomAttributes = "";
        $this->kesehatan_koperasi_angka->HrefValue = "";
        $this->kesehatan_koperasi_angka->TooltipValue = "";

        // anggota_l
        $this->anggota_l->LinkCustomAttributes = "";
        $this->anggota_l->HrefValue = "";
        $this->anggota_l->TooltipValue = "";

        // anggota_p
        $this->anggota_p->LinkCustomAttributes = "";
        $this->anggota_p->HrefValue = "";
        $this->anggota_p->TooltipValue = "";

        // anggota_jml
        $this->anggota_jml->LinkCustomAttributes = "";
        $this->anggota_jml->HrefValue = "";
        $this->anggota_jml->TooltipValue = "";

        // anggota_calon
        $this->anggota_calon->LinkCustomAttributes = "";
        $this->anggota_calon->HrefValue = "";
        $this->anggota_calon->TooltipValue = "";

        // pengurus_l
        $this->pengurus_l->LinkCustomAttributes = "";
        $this->pengurus_l->HrefValue = "";
        $this->pengurus_l->TooltipValue = "";

        // pengurus_p
        $this->pengurus_p->LinkCustomAttributes = "";
        $this->pengurus_p->HrefValue = "";
        $this->pengurus_p->TooltipValue = "";

        // pengurus_jml
        $this->pengurus_jml->LinkCustomAttributes = "";
        $this->pengurus_jml->HrefValue = "";
        $this->pengurus_jml->TooltipValue = "";

        // pengawas_l
        $this->pengawas_l->LinkCustomAttributes = "";
        $this->pengawas_l->HrefValue = "";
        $this->pengawas_l->TooltipValue = "";

        // pengawas_p
        $this->pengawas_p->LinkCustomAttributes = "";
        $this->pengawas_p->HrefValue = "";
        $this->pengawas_p->TooltipValue = "";

        // pengawas_jml
        $this->pengawas_jml->LinkCustomAttributes = "";
        $this->pengawas_jml->HrefValue = "";
        $this->pengawas_jml->TooltipValue = "";

        // karyawan_l
        $this->karyawan_l->LinkCustomAttributes = "";
        $this->karyawan_l->HrefValue = "";
        $this->karyawan_l->TooltipValue = "";

        // karyawan_p
        $this->karyawan_p->LinkCustomAttributes = "";
        $this->karyawan_p->HrefValue = "";
        $this->karyawan_p->TooltipValue = "";

        // karyawan_jml
        $this->karyawan_jml->LinkCustomAttributes = "";
        $this->karyawan_jml->HrefValue = "";
        $this->karyawan_jml->TooltipValue = "";

        // manajer_l
        $this->manajer_l->LinkCustomAttributes = "";
        $this->manajer_l->HrefValue = "";
        $this->manajer_l->TooltipValue = "";

        // manajer_p
        $this->manajer_p->LinkCustomAttributes = "";
        $this->manajer_p->HrefValue = "";
        $this->manajer_p->TooltipValue = "";

        // manajer_jml
        $this->manajer_jml->LinkCustomAttributes = "";
        $this->manajer_jml->HrefValue = "";
        $this->manajer_jml->TooltipValue = "";

        // rat_buku
        $this->rat_buku->LinkCustomAttributes = "";
        $this->rat_buku->HrefValue = "";
        $this->rat_buku->TooltipValue = "";

        // rat_tanggal
        $this->rat_tanggal->LinkCustomAttributes = "";
        $this->rat_tanggal->HrefValue = "";
        $this->rat_tanggal->TooltipValue = "";

        // rat
        $this->rat->LinkCustomAttributes = "";
        $this->rat->HrefValue = "";
        $this->rat->TooltipValue = "";

        // indikator_usaha
        $this->indikator_usaha->LinkCustomAttributes = "";
        $this->indikator_usaha->HrefValue = "";
        $this->indikator_usaha->TooltipValue = "";

        // modal_luar
        $this->modal_luar->LinkCustomAttributes = "";
        $this->modal_luar->HrefValue = "";
        $this->modal_luar->TooltipValue = "";

        // aset
        $this->aset->LinkCustomAttributes = "";
        $this->aset->HrefValue = "";
        $this->aset->TooltipValue = "";

        // vol_usaha
        $this->vol_usaha->LinkCustomAttributes = "";
        $this->vol_usaha->HrefValue = "";
        $this->vol_usaha->TooltipValue = "";

        // vol_usaha_lainya
        $this->vol_usaha_lainya->LinkCustomAttributes = "";
        $this->vol_usaha_lainya->HrefValue = "";
        $this->vol_usaha_lainya->TooltipValue = "";

        // vol_usaha_jml
        $this->vol_usaha_jml->LinkCustomAttributes = "";
        $this->vol_usaha_jml->HrefValue = "";
        $this->vol_usaha_jml->TooltipValue = "";

        // vol_usaha_tahunlalu
        $this->vol_usaha_tahunlalu->LinkCustomAttributes = "";
        $this->vol_usaha_tahunlalu->HrefValue = "";
        $this->vol_usaha_tahunlalu->TooltipValue = "";

        // shu
        $this->shu->LinkCustomAttributes = "";
        $this->shu->HrefValue = "";
        $this->shu->TooltipValue = "";

        // pedpt
        $this->pedpt->LinkCustomAttributes = "";
        $this->pedpt->HrefValue = "";
        $this->pedpt->TooltipValue = "";

        // biaya
        $this->biaya->LinkCustomAttributes = "";
        $this->biaya->HrefValue = "";
        $this->biaya->TooltipValue = "";

        // ms_sp
        $this->ms_sp->LinkCustomAttributes = "";
        $this->ms_sp->HrefValue = "";
        $this->ms_sp->TooltipValue = "";

        // ms_sw
        $this->ms_sw->LinkCustomAttributes = "";
        $this->ms_sw->HrefValue = "";
        $this->ms_sw->TooltipValue = "";

        // ms_khusus
        $this->ms_khusus->LinkCustomAttributes = "";
        $this->ms_khusus->HrefValue = "";
        $this->ms_khusus->TooltipValue = "";

        // ms_cad
        $this->ms_cad->LinkCustomAttributes = "";
        $this->ms_cad->HrefValue = "";
        $this->ms_cad->TooltipValue = "";

        // ms_hibah
        $this->ms_hibah->LinkCustomAttributes = "";
        $this->ms_hibah->HrefValue = "";
        $this->ms_hibah->TooltipValue = "";

        // ms_shu_belumdibagi
        $this->ms_shu_belumdibagi->LinkCustomAttributes = "";
        $this->ms_shu_belumdibagi->HrefValue = "";
        $this->ms_shu_belumdibagi->TooltipValue = "";

        // ms_dana_cadlain
        $this->ms_dana_cadlain->LinkCustomAttributes = "";
        $this->ms_dana_cadlain->HrefValue = "";
        $this->ms_dana_cadlain->TooltipValue = "";

        // ms_modal_penyerta
        $this->ms_modal_penyerta->LinkCustomAttributes = "";
        $this->ms_modal_penyerta->HrefValue = "";
        $this->ms_modal_penyerta->TooltipValue = "";

        // ms_jumlah
        $this->ms_jumlah->LinkCustomAttributes = "";
        $this->ms_jumlah->HrefValue = "";
        $this->ms_jumlah->TooltipValue = "";

        // pinjaman_sp
        $this->pinjaman_sp->LinkCustomAttributes = "";
        $this->pinjaman_sp->HrefValue = "";
        $this->pinjaman_sp->TooltipValue = "";

        // pinjaman_lainya
        $this->pinjaman_lainya->LinkCustomAttributes = "";
        $this->pinjaman_lainya->HrefValue = "";
        $this->pinjaman_lainya->TooltipValue = "";

        // pinjaman_jumlah
        $this->pinjaman_jumlah->LinkCustomAttributes = "";
        $this->pinjaman_jumlah->HrefValue = "";
        $this->pinjaman_jumlah->TooltipValue = "";

        // jml_dana
        $this->jml_dana->LinkCustomAttributes = "";
        $this->jml_dana->HrefValue = "";
        $this->jml_dana->TooltipValue = "";

        // investasi_jangka_panjang
        $this->investasi_jangka_panjang->LinkCustomAttributes = "";
        $this->investasi_jangka_panjang->HrefValue = "";
        $this->investasi_jangka_panjang->TooltipValue = "";

        // simpanan_lainya
        $this->simpanan_lainya->LinkCustomAttributes = "";
        $this->simpanan_lainya->HrefValue = "";
        $this->simpanan_lainya->TooltipValue = "";

        // simpanan_sukarela
        $this->simpanan_sukarela->LinkCustomAttributes = "";
        $this->simpanan_sukarela->HrefValue = "";
        $this->simpanan_sukarela->TooltipValue = "";

        // simpanan_jumlah
        $this->simpanan_jumlah->LinkCustomAttributes = "";
        $this->simpanan_jumlah->HrefValue = "";
        $this->simpanan_jumlah->TooltipValue = "";

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

        // binaan
        $this->binaan->EditAttrs["class"] = "form-control";
        $this->binaan->EditCustomAttributes = "";
        if (!$this->binaan->Raw) {
            $this->binaan->CurrentValue = HtmlDecode($this->binaan->CurrentValue);
        }
        $this->binaan->EditValue = $this->binaan->CurrentValue;
        $this->binaan->PlaceHolder = RemoveHtml($this->binaan->caption());

        // thn_periode
        $this->thn_periode->EditAttrs["class"] = "form-control";
        $this->thn_periode->EditCustomAttributes = "";
        $this->thn_periode->EditValue = $this->thn_periode->CurrentValue;
        $this->thn_periode->PlaceHolder = RemoveHtml($this->thn_periode->caption());

        // periode
        $this->periode->EditAttrs["class"] = "form-control";
        $this->periode->EditCustomAttributes = "";
        $this->periode->EditValue = $this->periode->CurrentValue;
        $this->periode->PlaceHolder = RemoveHtml($this->periode->caption());

        // nama_koperasi
        $this->nama_koperasi->EditAttrs["class"] = "form-control";
        $this->nama_koperasi->EditCustomAttributes = "";
        if (!$this->nama_koperasi->Raw) {
            $this->nama_koperasi->CurrentValue = HtmlDecode($this->nama_koperasi->CurrentValue);
        }
        $this->nama_koperasi->EditValue = $this->nama_koperasi->CurrentValue;
        $this->nama_koperasi->PlaceHolder = RemoveHtml($this->nama_koperasi->caption());

        // akte
        $this->akte->EditAttrs["class"] = "form-control";
        $this->akte->EditCustomAttributes = "";
        if (!$this->akte->Raw) {
            $this->akte->CurrentValue = HtmlDecode($this->akte->CurrentValue);
        }
        $this->akte->EditValue = $this->akte->CurrentValue;
        $this->akte->PlaceHolder = RemoveHtml($this->akte->caption());

        // tanggal_pendirian
        $this->tanggal_pendirian->EditAttrs["class"] = "form-control";
        $this->tanggal_pendirian->EditCustomAttributes = "";
        $this->tanggal_pendirian->EditValue = FormatDateTime($this->tanggal_pendirian->CurrentValue, 8);
        $this->tanggal_pendirian->PlaceHolder = RemoveHtml($this->tanggal_pendirian->caption());

        // alamat_jalan
        $this->alamat_jalan->EditAttrs["class"] = "form-control";
        $this->alamat_jalan->EditCustomAttributes = "";
        if (!$this->alamat_jalan->Raw) {
            $this->alamat_jalan->CurrentValue = HtmlDecode($this->alamat_jalan->CurrentValue);
        }
        $this->alamat_jalan->EditValue = $this->alamat_jalan->CurrentValue;
        $this->alamat_jalan->PlaceHolder = RemoveHtml($this->alamat_jalan->caption());

        // kapanewon
        $this->kapanewon->EditAttrs["class"] = "form-control";
        $this->kapanewon->EditCustomAttributes = "";
        if (!$this->kapanewon->Raw) {
            $this->kapanewon->CurrentValue = HtmlDecode($this->kapanewon->CurrentValue);
        }
        $this->kapanewon->EditValue = $this->kapanewon->CurrentValue;
        $this->kapanewon->PlaceHolder = RemoveHtml($this->kapanewon->caption());

        // kalurahan
        $this->kalurahan->EditAttrs["class"] = "form-control";
        $this->kalurahan->EditCustomAttributes = "";
        if (!$this->kalurahan->Raw) {
            $this->kalurahan->CurrentValue = HtmlDecode($this->kalurahan->CurrentValue);
        }
        $this->kalurahan->EditValue = $this->kalurahan->CurrentValue;
        $this->kalurahan->PlaceHolder = RemoveHtml($this->kalurahan->caption());

        // alamat_kodepos
        $this->alamat_kodepos->EditAttrs["class"] = "form-control";
        $this->alamat_kodepos->EditCustomAttributes = "";
        if (!$this->alamat_kodepos->Raw) {
            $this->alamat_kodepos->CurrentValue = HtmlDecode($this->alamat_kodepos->CurrentValue);
        }
        $this->alamat_kodepos->EditValue = $this->alamat_kodepos->CurrentValue;
        $this->alamat_kodepos->PlaceHolder = RemoveHtml($this->alamat_kodepos->caption());

        // telp
        $this->telp->EditAttrs["class"] = "form-control";
        $this->telp->EditCustomAttributes = "";
        if (!$this->telp->Raw) {
            $this->telp->CurrentValue = HtmlDecode($this->telp->CurrentValue);
        }
        $this->telp->EditValue = $this->telp->CurrentValue;
        $this->telp->PlaceHolder = RemoveHtml($this->telp->caption());

        // fax
        $this->fax->EditAttrs["class"] = "form-control";
        $this->fax->EditCustomAttributes = "";
        if (!$this->fax->Raw) {
            $this->fax->CurrentValue = HtmlDecode($this->fax->CurrentValue);
        }
        $this->fax->EditValue = $this->fax->CurrentValue;
        $this->fax->PlaceHolder = RemoveHtml($this->fax->caption());

        // email
        $this->_email->EditAttrs["class"] = "form-control";
        $this->_email->EditCustomAttributes = "";
        if (!$this->_email->Raw) {
            $this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
        }
        $this->_email->EditValue = $this->_email->CurrentValue;
        $this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

        // website
        $this->website->EditAttrs["class"] = "form-control";
        $this->website->EditCustomAttributes = "";
        if (!$this->website->Raw) {
            $this->website->CurrentValue = HtmlDecode($this->website->CurrentValue);
        }
        $this->website->EditValue = $this->website->CurrentValue;
        $this->website->PlaceHolder = RemoveHtml($this->website->caption());

        // aktif
        $this->aktif->EditAttrs["class"] = "form-control";
        $this->aktif->EditCustomAttributes = "";
        if (!$this->aktif->Raw) {
            $this->aktif->CurrentValue = HtmlDecode($this->aktif->CurrentValue);
        }
        $this->aktif->EditValue = $this->aktif->CurrentValue;
        $this->aktif->PlaceHolder = RemoveHtml($this->aktif->caption());

        // pasif
        $this->pasif->EditAttrs["class"] = "form-control";
        $this->pasif->EditCustomAttributes = "";
        if (!$this->pasif->Raw) {
            $this->pasif->CurrentValue = HtmlDecode($this->pasif->CurrentValue);
        }
        $this->pasif->EditValue = $this->pasif->CurrentValue;
        $this->pasif->PlaceHolder = RemoveHtml($this->pasif->caption());

        // bentuk_koperasi
        $this->bentuk_koperasi->EditAttrs["class"] = "form-control";
        $this->bentuk_koperasi->EditCustomAttributes = "";
        if (!$this->bentuk_koperasi->Raw) {
            $this->bentuk_koperasi->CurrentValue = HtmlDecode($this->bentuk_koperasi->CurrentValue);
        }
        $this->bentuk_koperasi->EditValue = $this->bentuk_koperasi->CurrentValue;
        $this->bentuk_koperasi->PlaceHolder = RemoveHtml($this->bentuk_koperasi->caption());

        // bentuk_ekonomi
        $this->bentuk_ekonomi->EditAttrs["class"] = "form-control";
        $this->bentuk_ekonomi->EditCustomAttributes = "";
        if (!$this->bentuk_ekonomi->Raw) {
            $this->bentuk_ekonomi->CurrentValue = HtmlDecode($this->bentuk_ekonomi->CurrentValue);
        }
        $this->bentuk_ekonomi->EditValue = $this->bentuk_ekonomi->CurrentValue;
        $this->bentuk_ekonomi->PlaceHolder = RemoveHtml($this->bentuk_ekonomi->caption());

        // kelompok_koperasi
        $this->kelompok_koperasi->EditAttrs["class"] = "form-control";
        $this->kelompok_koperasi->EditCustomAttributes = "";
        if (!$this->kelompok_koperasi->Raw) {
            $this->kelompok_koperasi->CurrentValue = HtmlDecode($this->kelompok_koperasi->CurrentValue);
        }
        $this->kelompok_koperasi->EditValue = $this->kelompok_koperasi->CurrentValue;
        $this->kelompok_koperasi->PlaceHolder = RemoveHtml($this->kelompok_koperasi->caption());

        // jns_koperasi
        $this->jns_koperasi->EditAttrs["class"] = "form-control";
        $this->jns_koperasi->EditCustomAttributes = "";
        if (!$this->jns_koperasi->Raw) {
            $this->jns_koperasi->CurrentValue = HtmlDecode($this->jns_koperasi->CurrentValue);
        }
        $this->jns_koperasi->EditValue = $this->jns_koperasi->CurrentValue;
        $this->jns_koperasi->PlaceHolder = RemoveHtml($this->jns_koperasi->caption());

        // pengurus_ketua
        $this->pengurus_ketua->EditAttrs["class"] = "form-control";
        $this->pengurus_ketua->EditCustomAttributes = "";
        if (!$this->pengurus_ketua->Raw) {
            $this->pengurus_ketua->CurrentValue = HtmlDecode($this->pengurus_ketua->CurrentValue);
        }
        $this->pengurus_ketua->EditValue = $this->pengurus_ketua->CurrentValue;
        $this->pengurus_ketua->PlaceHolder = RemoveHtml($this->pengurus_ketua->caption());

        // pengurus_sekertartaris
        $this->pengurus_sekertartaris->EditAttrs["class"] = "form-control";
        $this->pengurus_sekertartaris->EditCustomAttributes = "";
        if (!$this->pengurus_sekertartaris->Raw) {
            $this->pengurus_sekertartaris->CurrentValue = HtmlDecode($this->pengurus_sekertartaris->CurrentValue);
        }
        $this->pengurus_sekertartaris->EditValue = $this->pengurus_sekertartaris->CurrentValue;
        $this->pengurus_sekertartaris->PlaceHolder = RemoveHtml($this->pengurus_sekertartaris->caption());

        // pengurus_bendahara
        $this->pengurus_bendahara->EditAttrs["class"] = "form-control";
        $this->pengurus_bendahara->EditCustomAttributes = "";
        if (!$this->pengurus_bendahara->Raw) {
            $this->pengurus_bendahara->CurrentValue = HtmlDecode($this->pengurus_bendahara->CurrentValue);
        }
        $this->pengurus_bendahara->EditValue = $this->pengurus_bendahara->CurrentValue;
        $this->pengurus_bendahara->PlaceHolder = RemoveHtml($this->pengurus_bendahara->caption());

        // pengurus_masa_jabatan
        $this->pengurus_masa_jabatan->EditAttrs["class"] = "form-control";
        $this->pengurus_masa_jabatan->EditCustomAttributes = "";
        if (!$this->pengurus_masa_jabatan->Raw) {
            $this->pengurus_masa_jabatan->CurrentValue = HtmlDecode($this->pengurus_masa_jabatan->CurrentValue);
        }
        $this->pengurus_masa_jabatan->EditValue = $this->pengurus_masa_jabatan->CurrentValue;
        $this->pengurus_masa_jabatan->PlaceHolder = RemoveHtml($this->pengurus_masa_jabatan->caption());

        // pengawas_ketua
        $this->pengawas_ketua->EditAttrs["class"] = "form-control";
        $this->pengawas_ketua->EditCustomAttributes = "";
        if (!$this->pengawas_ketua->Raw) {
            $this->pengawas_ketua->CurrentValue = HtmlDecode($this->pengawas_ketua->CurrentValue);
        }
        $this->pengawas_ketua->EditValue = $this->pengawas_ketua->CurrentValue;
        $this->pengawas_ketua->PlaceHolder = RemoveHtml($this->pengawas_ketua->caption());

        // pengawas_anggota_1
        $this->pengawas_anggota_1->EditAttrs["class"] = "form-control";
        $this->pengawas_anggota_1->EditCustomAttributes = "";
        if (!$this->pengawas_anggota_1->Raw) {
            $this->pengawas_anggota_1->CurrentValue = HtmlDecode($this->pengawas_anggota_1->CurrentValue);
        }
        $this->pengawas_anggota_1->EditValue = $this->pengawas_anggota_1->CurrentValue;
        $this->pengawas_anggota_1->PlaceHolder = RemoveHtml($this->pengawas_anggota_1->caption());

        // pengawas_anggota_2
        $this->pengawas_anggota_2->EditAttrs["class"] = "form-control";
        $this->pengawas_anggota_2->EditCustomAttributes = "";
        if (!$this->pengawas_anggota_2->Raw) {
            $this->pengawas_anggota_2->CurrentValue = HtmlDecode($this->pengawas_anggota_2->CurrentValue);
        }
        $this->pengawas_anggota_2->EditValue = $this->pengawas_anggota_2->CurrentValue;
        $this->pengawas_anggota_2->PlaceHolder = RemoveHtml($this->pengawas_anggota_2->caption());

        // pengawas_masa_jabatan
        $this->pengawas_masa_jabatan->EditAttrs["class"] = "form-control";
        $this->pengawas_masa_jabatan->EditCustomAttributes = "";
        if (!$this->pengawas_masa_jabatan->Raw) {
            $this->pengawas_masa_jabatan->CurrentValue = HtmlDecode($this->pengawas_masa_jabatan->CurrentValue);
        }
        $this->pengawas_masa_jabatan->EditValue = $this->pengawas_masa_jabatan->CurrentValue;
        $this->pengawas_masa_jabatan->PlaceHolder = RemoveHtml($this->pengawas_masa_jabatan->caption());

        // manajer
        $this->manajer->EditAttrs["class"] = "form-control";
        $this->manajer->EditCustomAttributes = "";
        if (!$this->manajer->Raw) {
            $this->manajer->CurrentValue = HtmlDecode($this->manajer->CurrentValue);
        }
        $this->manajer->EditValue = $this->manajer->CurrentValue;
        $this->manajer->PlaceHolder = RemoveHtml($this->manajer->caption());

        // pemeringkatan_klasifikasi
        $this->pemeringkatan_klasifikasi->EditAttrs["class"] = "form-control";
        $this->pemeringkatan_klasifikasi->EditCustomAttributes = "";
        if (!$this->pemeringkatan_klasifikasi->Raw) {
            $this->pemeringkatan_klasifikasi->CurrentValue = HtmlDecode($this->pemeringkatan_klasifikasi->CurrentValue);
        }
        $this->pemeringkatan_klasifikasi->EditValue = $this->pemeringkatan_klasifikasi->CurrentValue;
        $this->pemeringkatan_klasifikasi->PlaceHolder = RemoveHtml($this->pemeringkatan_klasifikasi->caption());

        // kesehatan_koperasi_status
        $this->kesehatan_koperasi_status->EditAttrs["class"] = "form-control";
        $this->kesehatan_koperasi_status->EditCustomAttributes = "";
        if (!$this->kesehatan_koperasi_status->Raw) {
            $this->kesehatan_koperasi_status->CurrentValue = HtmlDecode($this->kesehatan_koperasi_status->CurrentValue);
        }
        $this->kesehatan_koperasi_status->EditValue = $this->kesehatan_koperasi_status->CurrentValue;
        $this->kesehatan_koperasi_status->PlaceHolder = RemoveHtml($this->kesehatan_koperasi_status->caption());

        // kesehatan_koperasi_angka
        $this->kesehatan_koperasi_angka->EditAttrs["class"] = "form-control";
        $this->kesehatan_koperasi_angka->EditCustomAttributes = "";
        $this->kesehatan_koperasi_angka->EditValue = $this->kesehatan_koperasi_angka->CurrentValue;
        $this->kesehatan_koperasi_angka->PlaceHolder = RemoveHtml($this->kesehatan_koperasi_angka->caption());
        if (strval($this->kesehatan_koperasi_angka->EditValue) != "" && is_numeric($this->kesehatan_koperasi_angka->EditValue)) {
            $this->kesehatan_koperasi_angka->EditValue = FormatNumber($this->kesehatan_koperasi_angka->EditValue, -2, -2, -2, -2);
        }

        // anggota_l
        $this->anggota_l->EditAttrs["class"] = "form-control";
        $this->anggota_l->EditCustomAttributes = "";
        $this->anggota_l->EditValue = $this->anggota_l->CurrentValue;
        $this->anggota_l->PlaceHolder = RemoveHtml($this->anggota_l->caption());

        // anggota_p
        $this->anggota_p->EditAttrs["class"] = "form-control";
        $this->anggota_p->EditCustomAttributes = "";
        $this->anggota_p->EditValue = $this->anggota_p->CurrentValue;
        $this->anggota_p->PlaceHolder = RemoveHtml($this->anggota_p->caption());

        // anggota_jml
        $this->anggota_jml->EditAttrs["class"] = "form-control";
        $this->anggota_jml->EditCustomAttributes = "";
        $this->anggota_jml->EditValue = $this->anggota_jml->CurrentValue;
        $this->anggota_jml->PlaceHolder = RemoveHtml($this->anggota_jml->caption());

        // anggota_calon
        $this->anggota_calon->EditAttrs["class"] = "form-control";
        $this->anggota_calon->EditCustomAttributes = "";
        $this->anggota_calon->EditValue = $this->anggota_calon->CurrentValue;
        $this->anggota_calon->PlaceHolder = RemoveHtml($this->anggota_calon->caption());

        // pengurus_l
        $this->pengurus_l->EditAttrs["class"] = "form-control";
        $this->pengurus_l->EditCustomAttributes = "";
        $this->pengurus_l->EditValue = $this->pengurus_l->CurrentValue;
        $this->pengurus_l->PlaceHolder = RemoveHtml($this->pengurus_l->caption());

        // pengurus_p
        $this->pengurus_p->EditAttrs["class"] = "form-control";
        $this->pengurus_p->EditCustomAttributes = "";
        $this->pengurus_p->EditValue = $this->pengurus_p->CurrentValue;
        $this->pengurus_p->PlaceHolder = RemoveHtml($this->pengurus_p->caption());

        // pengurus_jml
        $this->pengurus_jml->EditAttrs["class"] = "form-control";
        $this->pengurus_jml->EditCustomAttributes = "";
        $this->pengurus_jml->EditValue = $this->pengurus_jml->CurrentValue;
        $this->pengurus_jml->PlaceHolder = RemoveHtml($this->pengurus_jml->caption());

        // pengawas_l
        $this->pengawas_l->EditAttrs["class"] = "form-control";
        $this->pengawas_l->EditCustomAttributes = "";
        $this->pengawas_l->EditValue = $this->pengawas_l->CurrentValue;
        $this->pengawas_l->PlaceHolder = RemoveHtml($this->pengawas_l->caption());

        // pengawas_p
        $this->pengawas_p->EditAttrs["class"] = "form-control";
        $this->pengawas_p->EditCustomAttributes = "";
        $this->pengawas_p->EditValue = $this->pengawas_p->CurrentValue;
        $this->pengawas_p->PlaceHolder = RemoveHtml($this->pengawas_p->caption());

        // pengawas_jml
        $this->pengawas_jml->EditAttrs["class"] = "form-control";
        $this->pengawas_jml->EditCustomAttributes = "";
        $this->pengawas_jml->EditValue = $this->pengawas_jml->CurrentValue;
        $this->pengawas_jml->PlaceHolder = RemoveHtml($this->pengawas_jml->caption());

        // karyawan_l
        $this->karyawan_l->EditAttrs["class"] = "form-control";
        $this->karyawan_l->EditCustomAttributes = "";
        $this->karyawan_l->EditValue = $this->karyawan_l->CurrentValue;
        $this->karyawan_l->PlaceHolder = RemoveHtml($this->karyawan_l->caption());

        // karyawan_p
        $this->karyawan_p->EditAttrs["class"] = "form-control";
        $this->karyawan_p->EditCustomAttributes = "";
        $this->karyawan_p->EditValue = $this->karyawan_p->CurrentValue;
        $this->karyawan_p->PlaceHolder = RemoveHtml($this->karyawan_p->caption());

        // karyawan_jml
        $this->karyawan_jml->EditAttrs["class"] = "form-control";
        $this->karyawan_jml->EditCustomAttributes = "";
        $this->karyawan_jml->EditValue = $this->karyawan_jml->CurrentValue;
        $this->karyawan_jml->PlaceHolder = RemoveHtml($this->karyawan_jml->caption());

        // manajer_l
        $this->manajer_l->EditAttrs["class"] = "form-control";
        $this->manajer_l->EditCustomAttributes = "";
        $this->manajer_l->EditValue = $this->manajer_l->CurrentValue;
        $this->manajer_l->PlaceHolder = RemoveHtml($this->manajer_l->caption());

        // manajer_p
        $this->manajer_p->EditAttrs["class"] = "form-control";
        $this->manajer_p->EditCustomAttributes = "";
        $this->manajer_p->EditValue = $this->manajer_p->CurrentValue;
        $this->manajer_p->PlaceHolder = RemoveHtml($this->manajer_p->caption());

        // manajer_jml
        $this->manajer_jml->EditAttrs["class"] = "form-control";
        $this->manajer_jml->EditCustomAttributes = "";
        $this->manajer_jml->EditValue = $this->manajer_jml->CurrentValue;
        $this->manajer_jml->PlaceHolder = RemoveHtml($this->manajer_jml->caption());

        // rat_buku
        $this->rat_buku->EditAttrs["class"] = "form-control";
        $this->rat_buku->EditCustomAttributes = "";
        if (!$this->rat_buku->Raw) {
            $this->rat_buku->CurrentValue = HtmlDecode($this->rat_buku->CurrentValue);
        }
        $this->rat_buku->EditValue = $this->rat_buku->CurrentValue;
        $this->rat_buku->PlaceHolder = RemoveHtml($this->rat_buku->caption());

        // rat_tanggal
        $this->rat_tanggal->EditAttrs["class"] = "form-control";
        $this->rat_tanggal->EditCustomAttributes = "";
        if (!$this->rat_tanggal->Raw) {
            $this->rat_tanggal->CurrentValue = HtmlDecode($this->rat_tanggal->CurrentValue);
        }
        $this->rat_tanggal->EditValue = $this->rat_tanggal->CurrentValue;
        $this->rat_tanggal->PlaceHolder = RemoveHtml($this->rat_tanggal->caption());

        // rat
        $this->rat->EditAttrs["class"] = "form-control";
        $this->rat->EditCustomAttributes = "";
        $this->rat->EditValue = $this->rat->CurrentValue;
        $this->rat->PlaceHolder = RemoveHtml($this->rat->caption());

        // indikator_usaha
        $this->indikator_usaha->EditAttrs["class"] = "form-control";
        $this->indikator_usaha->EditCustomAttributes = "";
        if (!$this->indikator_usaha->Raw) {
            $this->indikator_usaha->CurrentValue = HtmlDecode($this->indikator_usaha->CurrentValue);
        }
        $this->indikator_usaha->EditValue = $this->indikator_usaha->CurrentValue;
        $this->indikator_usaha->PlaceHolder = RemoveHtml($this->indikator_usaha->caption());

        // modal_luar
        $this->modal_luar->EditAttrs["class"] = "form-control";
        $this->modal_luar->EditCustomAttributes = "";
        $this->modal_luar->EditValue = $this->modal_luar->CurrentValue;
        $this->modal_luar->PlaceHolder = RemoveHtml($this->modal_luar->caption());
        if (strval($this->modal_luar->EditValue) != "" && is_numeric($this->modal_luar->EditValue)) {
            $this->modal_luar->EditValue = FormatNumber($this->modal_luar->EditValue, -2, -2, -2, -2);
        }

        // aset
        $this->aset->EditAttrs["class"] = "form-control";
        $this->aset->EditCustomAttributes = "";
        $this->aset->EditValue = $this->aset->CurrentValue;
        $this->aset->PlaceHolder = RemoveHtml($this->aset->caption());
        if (strval($this->aset->EditValue) != "" && is_numeric($this->aset->EditValue)) {
            $this->aset->EditValue = FormatNumber($this->aset->EditValue, -2, -2, -2, -2);
        }

        // vol_usaha
        $this->vol_usaha->EditAttrs["class"] = "form-control";
        $this->vol_usaha->EditCustomAttributes = "";
        $this->vol_usaha->EditValue = $this->vol_usaha->CurrentValue;
        $this->vol_usaha->PlaceHolder = RemoveHtml($this->vol_usaha->caption());
        if (strval($this->vol_usaha->EditValue) != "" && is_numeric($this->vol_usaha->EditValue)) {
            $this->vol_usaha->EditValue = FormatNumber($this->vol_usaha->EditValue, -2, -2, -2, -2);
        }

        // vol_usaha_lainya
        $this->vol_usaha_lainya->EditAttrs["class"] = "form-control";
        $this->vol_usaha_lainya->EditCustomAttributes = "";
        $this->vol_usaha_lainya->EditValue = $this->vol_usaha_lainya->CurrentValue;
        $this->vol_usaha_lainya->PlaceHolder = RemoveHtml($this->vol_usaha_lainya->caption());
        if (strval($this->vol_usaha_lainya->EditValue) != "" && is_numeric($this->vol_usaha_lainya->EditValue)) {
            $this->vol_usaha_lainya->EditValue = FormatNumber($this->vol_usaha_lainya->EditValue, -2, -2, -2, -2);
        }

        // vol_usaha_jml
        $this->vol_usaha_jml->EditAttrs["class"] = "form-control";
        $this->vol_usaha_jml->EditCustomAttributes = "";
        $this->vol_usaha_jml->EditValue = $this->vol_usaha_jml->CurrentValue;
        $this->vol_usaha_jml->PlaceHolder = RemoveHtml($this->vol_usaha_jml->caption());
        if (strval($this->vol_usaha_jml->EditValue) != "" && is_numeric($this->vol_usaha_jml->EditValue)) {
            $this->vol_usaha_jml->EditValue = FormatNumber($this->vol_usaha_jml->EditValue, -2, -2, -2, -2);
        }

        // vol_usaha_tahunlalu
        $this->vol_usaha_tahunlalu->EditAttrs["class"] = "form-control";
        $this->vol_usaha_tahunlalu->EditCustomAttributes = "";
        $this->vol_usaha_tahunlalu->EditValue = $this->vol_usaha_tahunlalu->CurrentValue;
        $this->vol_usaha_tahunlalu->PlaceHolder = RemoveHtml($this->vol_usaha_tahunlalu->caption());
        if (strval($this->vol_usaha_tahunlalu->EditValue) != "" && is_numeric($this->vol_usaha_tahunlalu->EditValue)) {
            $this->vol_usaha_tahunlalu->EditValue = FormatNumber($this->vol_usaha_tahunlalu->EditValue, -2, -2, -2, -2);
        }

        // shu
        $this->shu->EditAttrs["class"] = "form-control";
        $this->shu->EditCustomAttributes = "";
        $this->shu->EditValue = $this->shu->CurrentValue;
        $this->shu->PlaceHolder = RemoveHtml($this->shu->caption());
        if (strval($this->shu->EditValue) != "" && is_numeric($this->shu->EditValue)) {
            $this->shu->EditValue = FormatNumber($this->shu->EditValue, -2, -2, -2, -2);
        }

        // pedpt
        $this->pedpt->EditAttrs["class"] = "form-control";
        $this->pedpt->EditCustomAttributes = "";
        $this->pedpt->EditValue = $this->pedpt->CurrentValue;
        $this->pedpt->PlaceHolder = RemoveHtml($this->pedpt->caption());
        if (strval($this->pedpt->EditValue) != "" && is_numeric($this->pedpt->EditValue)) {
            $this->pedpt->EditValue = FormatNumber($this->pedpt->EditValue, -2, -2, -2, -2);
        }

        // biaya
        $this->biaya->EditAttrs["class"] = "form-control";
        $this->biaya->EditCustomAttributes = "";
        $this->biaya->EditValue = $this->biaya->CurrentValue;
        $this->biaya->PlaceHolder = RemoveHtml($this->biaya->caption());
        if (strval($this->biaya->EditValue) != "" && is_numeric($this->biaya->EditValue)) {
            $this->biaya->EditValue = FormatNumber($this->biaya->EditValue, -2, -2, -2, -2);
        }

        // ms_sp
        $this->ms_sp->EditAttrs["class"] = "form-control";
        $this->ms_sp->EditCustomAttributes = "";
        $this->ms_sp->EditValue = $this->ms_sp->CurrentValue;
        $this->ms_sp->PlaceHolder = RemoveHtml($this->ms_sp->caption());
        if (strval($this->ms_sp->EditValue) != "" && is_numeric($this->ms_sp->EditValue)) {
            $this->ms_sp->EditValue = FormatNumber($this->ms_sp->EditValue, -2, -2, -2, -2);
        }

        // ms_sw
        $this->ms_sw->EditAttrs["class"] = "form-control";
        $this->ms_sw->EditCustomAttributes = "";
        $this->ms_sw->EditValue = $this->ms_sw->CurrentValue;
        $this->ms_sw->PlaceHolder = RemoveHtml($this->ms_sw->caption());
        if (strval($this->ms_sw->EditValue) != "" && is_numeric($this->ms_sw->EditValue)) {
            $this->ms_sw->EditValue = FormatNumber($this->ms_sw->EditValue, -2, -2, -2, -2);
        }

        // ms_khusus
        $this->ms_khusus->EditAttrs["class"] = "form-control";
        $this->ms_khusus->EditCustomAttributes = "";
        $this->ms_khusus->EditValue = $this->ms_khusus->CurrentValue;
        $this->ms_khusus->PlaceHolder = RemoveHtml($this->ms_khusus->caption());
        if (strval($this->ms_khusus->EditValue) != "" && is_numeric($this->ms_khusus->EditValue)) {
            $this->ms_khusus->EditValue = FormatNumber($this->ms_khusus->EditValue, -2, -2, -2, -2);
        }

        // ms_cad
        $this->ms_cad->EditAttrs["class"] = "form-control";
        $this->ms_cad->EditCustomAttributes = "";
        $this->ms_cad->EditValue = $this->ms_cad->CurrentValue;
        $this->ms_cad->PlaceHolder = RemoveHtml($this->ms_cad->caption());
        if (strval($this->ms_cad->EditValue) != "" && is_numeric($this->ms_cad->EditValue)) {
            $this->ms_cad->EditValue = FormatNumber($this->ms_cad->EditValue, -2, -2, -2, -2);
        }

        // ms_hibah
        $this->ms_hibah->EditAttrs["class"] = "form-control";
        $this->ms_hibah->EditCustomAttributes = "";
        $this->ms_hibah->EditValue = $this->ms_hibah->CurrentValue;
        $this->ms_hibah->PlaceHolder = RemoveHtml($this->ms_hibah->caption());
        if (strval($this->ms_hibah->EditValue) != "" && is_numeric($this->ms_hibah->EditValue)) {
            $this->ms_hibah->EditValue = FormatNumber($this->ms_hibah->EditValue, -2, -2, -2, -2);
        }

        // ms_shu_belumdibagi
        $this->ms_shu_belumdibagi->EditAttrs["class"] = "form-control";
        $this->ms_shu_belumdibagi->EditCustomAttributes = "";
        $this->ms_shu_belumdibagi->EditValue = $this->ms_shu_belumdibagi->CurrentValue;
        $this->ms_shu_belumdibagi->PlaceHolder = RemoveHtml($this->ms_shu_belumdibagi->caption());
        if (strval($this->ms_shu_belumdibagi->EditValue) != "" && is_numeric($this->ms_shu_belumdibagi->EditValue)) {
            $this->ms_shu_belumdibagi->EditValue = FormatNumber($this->ms_shu_belumdibagi->EditValue, -2, -2, -2, -2);
        }

        // ms_dana_cadlain
        $this->ms_dana_cadlain->EditAttrs["class"] = "form-control";
        $this->ms_dana_cadlain->EditCustomAttributes = "";
        $this->ms_dana_cadlain->EditValue = $this->ms_dana_cadlain->CurrentValue;
        $this->ms_dana_cadlain->PlaceHolder = RemoveHtml($this->ms_dana_cadlain->caption());
        if (strval($this->ms_dana_cadlain->EditValue) != "" && is_numeric($this->ms_dana_cadlain->EditValue)) {
            $this->ms_dana_cadlain->EditValue = FormatNumber($this->ms_dana_cadlain->EditValue, -2, -2, -2, -2);
        }

        // ms_modal_penyerta
        $this->ms_modal_penyerta->EditAttrs["class"] = "form-control";
        $this->ms_modal_penyerta->EditCustomAttributes = "";
        $this->ms_modal_penyerta->EditValue = $this->ms_modal_penyerta->CurrentValue;
        $this->ms_modal_penyerta->PlaceHolder = RemoveHtml($this->ms_modal_penyerta->caption());
        if (strval($this->ms_modal_penyerta->EditValue) != "" && is_numeric($this->ms_modal_penyerta->EditValue)) {
            $this->ms_modal_penyerta->EditValue = FormatNumber($this->ms_modal_penyerta->EditValue, -2, -2, -2, -2);
        }

        // ms_jumlah
        $this->ms_jumlah->EditAttrs["class"] = "form-control";
        $this->ms_jumlah->EditCustomAttributes = "";
        $this->ms_jumlah->EditValue = $this->ms_jumlah->CurrentValue;
        $this->ms_jumlah->PlaceHolder = RemoveHtml($this->ms_jumlah->caption());
        if (strval($this->ms_jumlah->EditValue) != "" && is_numeric($this->ms_jumlah->EditValue)) {
            $this->ms_jumlah->EditValue = FormatNumber($this->ms_jumlah->EditValue, -2, -2, -2, -2);
        }

        // pinjaman_sp
        $this->pinjaman_sp->EditAttrs["class"] = "form-control";
        $this->pinjaman_sp->EditCustomAttributes = "";
        $this->pinjaman_sp->EditValue = $this->pinjaman_sp->CurrentValue;
        $this->pinjaman_sp->PlaceHolder = RemoveHtml($this->pinjaman_sp->caption());
        if (strval($this->pinjaman_sp->EditValue) != "" && is_numeric($this->pinjaman_sp->EditValue)) {
            $this->pinjaman_sp->EditValue = FormatNumber($this->pinjaman_sp->EditValue, -2, -2, -2, -2);
        }

        // pinjaman_lainya
        $this->pinjaman_lainya->EditAttrs["class"] = "form-control";
        $this->pinjaman_lainya->EditCustomAttributes = "";
        $this->pinjaman_lainya->EditValue = $this->pinjaman_lainya->CurrentValue;
        $this->pinjaman_lainya->PlaceHolder = RemoveHtml($this->pinjaman_lainya->caption());
        if (strval($this->pinjaman_lainya->EditValue) != "" && is_numeric($this->pinjaman_lainya->EditValue)) {
            $this->pinjaman_lainya->EditValue = FormatNumber($this->pinjaman_lainya->EditValue, -2, -2, -2, -2);
        }

        // pinjaman_jumlah
        $this->pinjaman_jumlah->EditAttrs["class"] = "form-control";
        $this->pinjaman_jumlah->EditCustomAttributes = "";
        $this->pinjaman_jumlah->EditValue = $this->pinjaman_jumlah->CurrentValue;
        $this->pinjaman_jumlah->PlaceHolder = RemoveHtml($this->pinjaman_jumlah->caption());
        if (strval($this->pinjaman_jumlah->EditValue) != "" && is_numeric($this->pinjaman_jumlah->EditValue)) {
            $this->pinjaman_jumlah->EditValue = FormatNumber($this->pinjaman_jumlah->EditValue, -2, -2, -2, -2);
        }

        // jml_dana
        $this->jml_dana->EditAttrs["class"] = "form-control";
        $this->jml_dana->EditCustomAttributes = "";
        $this->jml_dana->EditValue = $this->jml_dana->CurrentValue;
        $this->jml_dana->PlaceHolder = RemoveHtml($this->jml_dana->caption());
        if (strval($this->jml_dana->EditValue) != "" && is_numeric($this->jml_dana->EditValue)) {
            $this->jml_dana->EditValue = FormatNumber($this->jml_dana->EditValue, -2, -2, -2, -2);
        }

        // investasi_jangka_panjang
        $this->investasi_jangka_panjang->EditAttrs["class"] = "form-control";
        $this->investasi_jangka_panjang->EditCustomAttributes = "";
        $this->investasi_jangka_panjang->EditValue = $this->investasi_jangka_panjang->CurrentValue;
        $this->investasi_jangka_panjang->PlaceHolder = RemoveHtml($this->investasi_jangka_panjang->caption());
        if (strval($this->investasi_jangka_panjang->EditValue) != "" && is_numeric($this->investasi_jangka_panjang->EditValue)) {
            $this->investasi_jangka_panjang->EditValue = FormatNumber($this->investasi_jangka_panjang->EditValue, -2, -2, -2, -2);
        }

        // simpanan_lainya
        $this->simpanan_lainya->EditAttrs["class"] = "form-control";
        $this->simpanan_lainya->EditCustomAttributes = "";
        $this->simpanan_lainya->EditValue = $this->simpanan_lainya->CurrentValue;
        $this->simpanan_lainya->PlaceHolder = RemoveHtml($this->simpanan_lainya->caption());
        if (strval($this->simpanan_lainya->EditValue) != "" && is_numeric($this->simpanan_lainya->EditValue)) {
            $this->simpanan_lainya->EditValue = FormatNumber($this->simpanan_lainya->EditValue, -2, -2, -2, -2);
        }

        // simpanan_sukarela
        $this->simpanan_sukarela->EditAttrs["class"] = "form-control";
        $this->simpanan_sukarela->EditCustomAttributes = "";
        $this->simpanan_sukarela->EditValue = $this->simpanan_sukarela->CurrentValue;
        $this->simpanan_sukarela->PlaceHolder = RemoveHtml($this->simpanan_sukarela->caption());
        if (strval($this->simpanan_sukarela->EditValue) != "" && is_numeric($this->simpanan_sukarela->EditValue)) {
            $this->simpanan_sukarela->EditValue = FormatNumber($this->simpanan_sukarela->EditValue, -2, -2, -2, -2);
        }

        // simpanan_jumlah
        $this->simpanan_jumlah->EditAttrs["class"] = "form-control";
        $this->simpanan_jumlah->EditCustomAttributes = "";
        $this->simpanan_jumlah->EditValue = $this->simpanan_jumlah->CurrentValue;
        $this->simpanan_jumlah->PlaceHolder = RemoveHtml($this->simpanan_jumlah->caption());
        if (strval($this->simpanan_jumlah->EditValue) != "" && is_numeric($this->simpanan_jumlah->EditValue)) {
            $this->simpanan_jumlah->EditValue = FormatNumber($this->simpanan_jumlah->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->binaan);
                    $doc->exportCaption($this->thn_periode);
                    $doc->exportCaption($this->periode);
                    $doc->exportCaption($this->nama_koperasi);
                    $doc->exportCaption($this->akte);
                    $doc->exportCaption($this->tanggal_pendirian);
                    $doc->exportCaption($this->alamat_jalan);
                    $doc->exportCaption($this->kapanewon);
                    $doc->exportCaption($this->kalurahan);
                    $doc->exportCaption($this->alamat_kodepos);
                    $doc->exportCaption($this->telp);
                    $doc->exportCaption($this->fax);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->aktif);
                    $doc->exportCaption($this->pasif);
                    $doc->exportCaption($this->bentuk_koperasi);
                    $doc->exportCaption($this->bentuk_ekonomi);
                    $doc->exportCaption($this->kelompok_koperasi);
                    $doc->exportCaption($this->jns_koperasi);
                    $doc->exportCaption($this->pengurus_ketua);
                    $doc->exportCaption($this->pengurus_sekertartaris);
                    $doc->exportCaption($this->pengurus_bendahara);
                    $doc->exportCaption($this->pengurus_masa_jabatan);
                    $doc->exportCaption($this->pengawas_ketua);
                    $doc->exportCaption($this->pengawas_anggota_1);
                    $doc->exportCaption($this->pengawas_anggota_2);
                    $doc->exportCaption($this->pengawas_masa_jabatan);
                    $doc->exportCaption($this->manajer);
                    $doc->exportCaption($this->pemeringkatan_klasifikasi);
                    $doc->exportCaption($this->kesehatan_koperasi_status);
                    $doc->exportCaption($this->kesehatan_koperasi_angka);
                    $doc->exportCaption($this->anggota_l);
                    $doc->exportCaption($this->anggota_p);
                    $doc->exportCaption($this->anggota_jml);
                    $doc->exportCaption($this->anggota_calon);
                    $doc->exportCaption($this->pengurus_l);
                    $doc->exportCaption($this->pengurus_p);
                    $doc->exportCaption($this->pengurus_jml);
                    $doc->exportCaption($this->pengawas_l);
                    $doc->exportCaption($this->pengawas_p);
                    $doc->exportCaption($this->pengawas_jml);
                    $doc->exportCaption($this->karyawan_l);
                    $doc->exportCaption($this->karyawan_p);
                    $doc->exportCaption($this->karyawan_jml);
                    $doc->exportCaption($this->manajer_l);
                    $doc->exportCaption($this->manajer_p);
                    $doc->exportCaption($this->manajer_jml);
                    $doc->exportCaption($this->rat_buku);
                    $doc->exportCaption($this->rat_tanggal);
                    $doc->exportCaption($this->rat);
                    $doc->exportCaption($this->indikator_usaha);
                    $doc->exportCaption($this->modal_luar);
                    $doc->exportCaption($this->aset);
                    $doc->exportCaption($this->vol_usaha);
                    $doc->exportCaption($this->vol_usaha_lainya);
                    $doc->exportCaption($this->vol_usaha_jml);
                    $doc->exportCaption($this->vol_usaha_tahunlalu);
                    $doc->exportCaption($this->shu);
                    $doc->exportCaption($this->pedpt);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->ms_sp);
                    $doc->exportCaption($this->ms_sw);
                    $doc->exportCaption($this->ms_khusus);
                    $doc->exportCaption($this->ms_cad);
                    $doc->exportCaption($this->ms_hibah);
                    $doc->exportCaption($this->ms_shu_belumdibagi);
                    $doc->exportCaption($this->ms_dana_cadlain);
                    $doc->exportCaption($this->ms_modal_penyerta);
                    $doc->exportCaption($this->ms_jumlah);
                    $doc->exportCaption($this->pinjaman_sp);
                    $doc->exportCaption($this->pinjaman_lainya);
                    $doc->exportCaption($this->pinjaman_jumlah);
                    $doc->exportCaption($this->jml_dana);
                    $doc->exportCaption($this->investasi_jangka_panjang);
                    $doc->exportCaption($this->simpanan_lainya);
                    $doc->exportCaption($this->simpanan_sukarela);
                    $doc->exportCaption($this->simpanan_jumlah);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->binaan);
                    $doc->exportCaption($this->thn_periode);
                    $doc->exportCaption($this->periode);
                    $doc->exportCaption($this->nama_koperasi);
                    $doc->exportCaption($this->akte);
                    $doc->exportCaption($this->tanggal_pendirian);
                    $doc->exportCaption($this->alamat_jalan);
                    $doc->exportCaption($this->kapanewon);
                    $doc->exportCaption($this->kalurahan);
                    $doc->exportCaption($this->alamat_kodepos);
                    $doc->exportCaption($this->telp);
                    $doc->exportCaption($this->fax);
                    $doc->exportCaption($this->_email);
                    $doc->exportCaption($this->website);
                    $doc->exportCaption($this->aktif);
                    $doc->exportCaption($this->pasif);
                    $doc->exportCaption($this->bentuk_koperasi);
                    $doc->exportCaption($this->bentuk_ekonomi);
                    $doc->exportCaption($this->kelompok_koperasi);
                    $doc->exportCaption($this->jns_koperasi);
                    $doc->exportCaption($this->pengurus_ketua);
                    $doc->exportCaption($this->pengurus_sekertartaris);
                    $doc->exportCaption($this->pengurus_bendahara);
                    $doc->exportCaption($this->pengurus_masa_jabatan);
                    $doc->exportCaption($this->pengawas_ketua);
                    $doc->exportCaption($this->pengawas_anggota_1);
                    $doc->exportCaption($this->pengawas_anggota_2);
                    $doc->exportCaption($this->pengawas_masa_jabatan);
                    $doc->exportCaption($this->manajer);
                    $doc->exportCaption($this->pemeringkatan_klasifikasi);
                    $doc->exportCaption($this->kesehatan_koperasi_status);
                    $doc->exportCaption($this->kesehatan_koperasi_angka);
                    $doc->exportCaption($this->anggota_l);
                    $doc->exportCaption($this->anggota_p);
                    $doc->exportCaption($this->anggota_jml);
                    $doc->exportCaption($this->anggota_calon);
                    $doc->exportCaption($this->pengurus_l);
                    $doc->exportCaption($this->pengurus_p);
                    $doc->exportCaption($this->pengurus_jml);
                    $doc->exportCaption($this->pengawas_l);
                    $doc->exportCaption($this->pengawas_p);
                    $doc->exportCaption($this->pengawas_jml);
                    $doc->exportCaption($this->karyawan_l);
                    $doc->exportCaption($this->karyawan_p);
                    $doc->exportCaption($this->karyawan_jml);
                    $doc->exportCaption($this->manajer_l);
                    $doc->exportCaption($this->manajer_p);
                    $doc->exportCaption($this->manajer_jml);
                    $doc->exportCaption($this->rat_buku);
                    $doc->exportCaption($this->rat_tanggal);
                    $doc->exportCaption($this->rat);
                    $doc->exportCaption($this->indikator_usaha);
                    $doc->exportCaption($this->modal_luar);
                    $doc->exportCaption($this->aset);
                    $doc->exportCaption($this->vol_usaha);
                    $doc->exportCaption($this->vol_usaha_lainya);
                    $doc->exportCaption($this->vol_usaha_jml);
                    $doc->exportCaption($this->vol_usaha_tahunlalu);
                    $doc->exportCaption($this->shu);
                    $doc->exportCaption($this->pedpt);
                    $doc->exportCaption($this->biaya);
                    $doc->exportCaption($this->ms_sp);
                    $doc->exportCaption($this->ms_sw);
                    $doc->exportCaption($this->ms_khusus);
                    $doc->exportCaption($this->ms_cad);
                    $doc->exportCaption($this->ms_hibah);
                    $doc->exportCaption($this->ms_shu_belumdibagi);
                    $doc->exportCaption($this->ms_dana_cadlain);
                    $doc->exportCaption($this->ms_modal_penyerta);
                    $doc->exportCaption($this->ms_jumlah);
                    $doc->exportCaption($this->pinjaman_sp);
                    $doc->exportCaption($this->pinjaman_lainya);
                    $doc->exportCaption($this->pinjaman_jumlah);
                    $doc->exportCaption($this->jml_dana);
                    $doc->exportCaption($this->investasi_jangka_panjang);
                    $doc->exportCaption($this->simpanan_lainya);
                    $doc->exportCaption($this->simpanan_sukarela);
                    $doc->exportCaption($this->simpanan_jumlah);
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
                        $doc->exportField($this->binaan);
                        $doc->exportField($this->thn_periode);
                        $doc->exportField($this->periode);
                        $doc->exportField($this->nama_koperasi);
                        $doc->exportField($this->akte);
                        $doc->exportField($this->tanggal_pendirian);
                        $doc->exportField($this->alamat_jalan);
                        $doc->exportField($this->kapanewon);
                        $doc->exportField($this->kalurahan);
                        $doc->exportField($this->alamat_kodepos);
                        $doc->exportField($this->telp);
                        $doc->exportField($this->fax);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->website);
                        $doc->exportField($this->aktif);
                        $doc->exportField($this->pasif);
                        $doc->exportField($this->bentuk_koperasi);
                        $doc->exportField($this->bentuk_ekonomi);
                        $doc->exportField($this->kelompok_koperasi);
                        $doc->exportField($this->jns_koperasi);
                        $doc->exportField($this->pengurus_ketua);
                        $doc->exportField($this->pengurus_sekertartaris);
                        $doc->exportField($this->pengurus_bendahara);
                        $doc->exportField($this->pengurus_masa_jabatan);
                        $doc->exportField($this->pengawas_ketua);
                        $doc->exportField($this->pengawas_anggota_1);
                        $doc->exportField($this->pengawas_anggota_2);
                        $doc->exportField($this->pengawas_masa_jabatan);
                        $doc->exportField($this->manajer);
                        $doc->exportField($this->pemeringkatan_klasifikasi);
                        $doc->exportField($this->kesehatan_koperasi_status);
                        $doc->exportField($this->kesehatan_koperasi_angka);
                        $doc->exportField($this->anggota_l);
                        $doc->exportField($this->anggota_p);
                        $doc->exportField($this->anggota_jml);
                        $doc->exportField($this->anggota_calon);
                        $doc->exportField($this->pengurus_l);
                        $doc->exportField($this->pengurus_p);
                        $doc->exportField($this->pengurus_jml);
                        $doc->exportField($this->pengawas_l);
                        $doc->exportField($this->pengawas_p);
                        $doc->exportField($this->pengawas_jml);
                        $doc->exportField($this->karyawan_l);
                        $doc->exportField($this->karyawan_p);
                        $doc->exportField($this->karyawan_jml);
                        $doc->exportField($this->manajer_l);
                        $doc->exportField($this->manajer_p);
                        $doc->exportField($this->manajer_jml);
                        $doc->exportField($this->rat_buku);
                        $doc->exportField($this->rat_tanggal);
                        $doc->exportField($this->rat);
                        $doc->exportField($this->indikator_usaha);
                        $doc->exportField($this->modal_luar);
                        $doc->exportField($this->aset);
                        $doc->exportField($this->vol_usaha);
                        $doc->exportField($this->vol_usaha_lainya);
                        $doc->exportField($this->vol_usaha_jml);
                        $doc->exportField($this->vol_usaha_tahunlalu);
                        $doc->exportField($this->shu);
                        $doc->exportField($this->pedpt);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->ms_sp);
                        $doc->exportField($this->ms_sw);
                        $doc->exportField($this->ms_khusus);
                        $doc->exportField($this->ms_cad);
                        $doc->exportField($this->ms_hibah);
                        $doc->exportField($this->ms_shu_belumdibagi);
                        $doc->exportField($this->ms_dana_cadlain);
                        $doc->exportField($this->ms_modal_penyerta);
                        $doc->exportField($this->ms_jumlah);
                        $doc->exportField($this->pinjaman_sp);
                        $doc->exportField($this->pinjaman_lainya);
                        $doc->exportField($this->pinjaman_jumlah);
                        $doc->exportField($this->jml_dana);
                        $doc->exportField($this->investasi_jangka_panjang);
                        $doc->exportField($this->simpanan_lainya);
                        $doc->exportField($this->simpanan_sukarela);
                        $doc->exportField($this->simpanan_jumlah);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->binaan);
                        $doc->exportField($this->thn_periode);
                        $doc->exportField($this->periode);
                        $doc->exportField($this->nama_koperasi);
                        $doc->exportField($this->akte);
                        $doc->exportField($this->tanggal_pendirian);
                        $doc->exportField($this->alamat_jalan);
                        $doc->exportField($this->kapanewon);
                        $doc->exportField($this->kalurahan);
                        $doc->exportField($this->alamat_kodepos);
                        $doc->exportField($this->telp);
                        $doc->exportField($this->fax);
                        $doc->exportField($this->_email);
                        $doc->exportField($this->website);
                        $doc->exportField($this->aktif);
                        $doc->exportField($this->pasif);
                        $doc->exportField($this->bentuk_koperasi);
                        $doc->exportField($this->bentuk_ekonomi);
                        $doc->exportField($this->kelompok_koperasi);
                        $doc->exportField($this->jns_koperasi);
                        $doc->exportField($this->pengurus_ketua);
                        $doc->exportField($this->pengurus_sekertartaris);
                        $doc->exportField($this->pengurus_bendahara);
                        $doc->exportField($this->pengurus_masa_jabatan);
                        $doc->exportField($this->pengawas_ketua);
                        $doc->exportField($this->pengawas_anggota_1);
                        $doc->exportField($this->pengawas_anggota_2);
                        $doc->exportField($this->pengawas_masa_jabatan);
                        $doc->exportField($this->manajer);
                        $doc->exportField($this->pemeringkatan_klasifikasi);
                        $doc->exportField($this->kesehatan_koperasi_status);
                        $doc->exportField($this->kesehatan_koperasi_angka);
                        $doc->exportField($this->anggota_l);
                        $doc->exportField($this->anggota_p);
                        $doc->exportField($this->anggota_jml);
                        $doc->exportField($this->anggota_calon);
                        $doc->exportField($this->pengurus_l);
                        $doc->exportField($this->pengurus_p);
                        $doc->exportField($this->pengurus_jml);
                        $doc->exportField($this->pengawas_l);
                        $doc->exportField($this->pengawas_p);
                        $doc->exportField($this->pengawas_jml);
                        $doc->exportField($this->karyawan_l);
                        $doc->exportField($this->karyawan_p);
                        $doc->exportField($this->karyawan_jml);
                        $doc->exportField($this->manajer_l);
                        $doc->exportField($this->manajer_p);
                        $doc->exportField($this->manajer_jml);
                        $doc->exportField($this->rat_buku);
                        $doc->exportField($this->rat_tanggal);
                        $doc->exportField($this->rat);
                        $doc->exportField($this->indikator_usaha);
                        $doc->exportField($this->modal_luar);
                        $doc->exportField($this->aset);
                        $doc->exportField($this->vol_usaha);
                        $doc->exportField($this->vol_usaha_lainya);
                        $doc->exportField($this->vol_usaha_jml);
                        $doc->exportField($this->vol_usaha_tahunlalu);
                        $doc->exportField($this->shu);
                        $doc->exportField($this->pedpt);
                        $doc->exportField($this->biaya);
                        $doc->exportField($this->ms_sp);
                        $doc->exportField($this->ms_sw);
                        $doc->exportField($this->ms_khusus);
                        $doc->exportField($this->ms_cad);
                        $doc->exportField($this->ms_hibah);
                        $doc->exportField($this->ms_shu_belumdibagi);
                        $doc->exportField($this->ms_dana_cadlain);
                        $doc->exportField($this->ms_modal_penyerta);
                        $doc->exportField($this->ms_jumlah);
                        $doc->exportField($this->pinjaman_sp);
                        $doc->exportField($this->pinjaman_lainya);
                        $doc->exportField($this->pinjaman_jumlah);
                        $doc->exportField($this->jml_dana);
                        $doc->exportField($this->investasi_jangka_panjang);
                        $doc->exportField($this->simpanan_lainya);
                        $doc->exportField($this->simpanan_sukarela);
                        $doc->exportField($this->simpanan_jumlah);
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
