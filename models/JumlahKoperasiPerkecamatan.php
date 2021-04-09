<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for jumlah_koperasi_perkecamatan
 */
class JumlahKoperasiPerkecamatan extends DbTable
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
    public $kecamatan;
    public $jumlah_koperasi;
    public $jumlah_aktif;
    public $jumlah_pasif;
    public $jumlah_ekonomi_konvesional;
    public $jumlah_ekonomi_syariah;
    public $jml_jns_koperasi_jasa;
    public $jml_jns_koperasi_konsumen;
    public $jml_jns_koperasi_pemasaran;
    public $jml_jns_koperasi_produsen;
    public $jml_jns_koperasi_sp;
    public $Jumlah_Anggota;
    public $Jumlah_Anggota_LakiLaki;
    public $Jumlah_Anggota_Perempuan;
    public $Jumlah_Calon_Anggota;
    public $Jumlah_Aset;
    public $Jumlah_Volume_Usaha;
    public $Modal_Luar;
    public $Biaya;
    public $Modal_Sendiri;
    public $Jumlah_Pinjaman;
    public $Jumlah_Dana;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'jumlah_koperasi_perkecamatan';
        $this->TableName = 'jumlah_koperasi_perkecamatan';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`jumlah_koperasi_perkecamatan`";
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

        // kecamatan
        $this->kecamatan = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_kecamatan', 'kecamatan', '`kecamatan`', '`kecamatan`', 200, 255, -1, false, '`kecamatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kecamatan->Nullable = false; // NOT NULL field
        $this->kecamatan->Required = true; // Required field
        $this->kecamatan->Sortable = true; // Allow sort
        $this->kecamatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kecamatan->Param, "CustomMsg");
        $this->Fields['kecamatan'] = &$this->kecamatan;

        // jumlah_koperasi
        $this->jumlah_koperasi = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jumlah_koperasi', 'jumlah_koperasi', '`jumlah_koperasi`', '`jumlah_koperasi`', 20, 21, -1, false, '`jumlah_koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_koperasi->Nullable = false; // NOT NULL field
        $this->jumlah_koperasi->Sortable = true; // Allow sort
        $this->jumlah_koperasi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->jumlah_koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_koperasi->Param, "CustomMsg");
        $this->Fields['jumlah_koperasi'] = &$this->jumlah_koperasi;

        // jumlah_aktif
        $this->jumlah_aktif = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jumlah_aktif', 'jumlah_aktif', '`jumlah_aktif`', '`jumlah_aktif`', 131, 22, -1, false, '`jumlah_aktif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_aktif->Sortable = true; // Allow sort
        $this->jumlah_aktif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah_aktif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah_aktif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_aktif->Param, "CustomMsg");
        $this->Fields['jumlah_aktif'] = &$this->jumlah_aktif;

        // jumlah_pasif
        $this->jumlah_pasif = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jumlah_pasif', 'jumlah_pasif', '`jumlah_pasif`', '`jumlah_pasif`', 131, 22, -1, false, '`jumlah_pasif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_pasif->Sortable = true; // Allow sort
        $this->jumlah_pasif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah_pasif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah_pasif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_pasif->Param, "CustomMsg");
        $this->Fields['jumlah_pasif'] = &$this->jumlah_pasif;

        // jumlah_ekonomi_konvesional
        $this->jumlah_ekonomi_konvesional = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jumlah_ekonomi_konvesional', 'jumlah_ekonomi_konvesional', '`jumlah_ekonomi_konvesional`', '`jumlah_ekonomi_konvesional`', 131, 22, -1, false, '`jumlah_ekonomi_konvesional`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_ekonomi_konvesional->Sortable = true; // Allow sort
        $this->jumlah_ekonomi_konvesional->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah_ekonomi_konvesional->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah_ekonomi_konvesional->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_ekonomi_konvesional->Param, "CustomMsg");
        $this->Fields['jumlah_ekonomi_konvesional'] = &$this->jumlah_ekonomi_konvesional;

        // jumlah_ekonomi_syariah
        $this->jumlah_ekonomi_syariah = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jumlah_ekonomi_syariah', 'jumlah_ekonomi_syariah', '`jumlah_ekonomi_syariah`', '`jumlah_ekonomi_syariah`', 131, 22, -1, false, '`jumlah_ekonomi_syariah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jumlah_ekonomi_syariah->Sortable = true; // Allow sort
        $this->jumlah_ekonomi_syariah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jumlah_ekonomi_syariah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jumlah_ekonomi_syariah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jumlah_ekonomi_syariah->Param, "CustomMsg");
        $this->Fields['jumlah_ekonomi_syariah'] = &$this->jumlah_ekonomi_syariah;

        // jml_jns_koperasi_jasa
        $this->jml_jns_koperasi_jasa = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jml_jns_koperasi_jasa', 'jml_jns_koperasi_jasa', '`jml_jns_koperasi_jasa`', '`jml_jns_koperasi_jasa`', 131, 22, -1, false, '`jml_jns_koperasi_jasa`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_jns_koperasi_jasa->Sortable = true; // Allow sort
        $this->jml_jns_koperasi_jasa->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_jns_koperasi_jasa->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_jns_koperasi_jasa->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_jns_koperasi_jasa->Param, "CustomMsg");
        $this->Fields['jml_jns_koperasi_jasa'] = &$this->jml_jns_koperasi_jasa;

        // jml_jns_koperasi_konsumen
        $this->jml_jns_koperasi_konsumen = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jml_jns_koperasi_konsumen', 'jml_jns_koperasi_konsumen', '`jml_jns_koperasi_konsumen`', '`jml_jns_koperasi_konsumen`', 131, 22, -1, false, '`jml_jns_koperasi_konsumen`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_jns_koperasi_konsumen->Sortable = true; // Allow sort
        $this->jml_jns_koperasi_konsumen->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_jns_koperasi_konsumen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_jns_koperasi_konsumen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_jns_koperasi_konsumen->Param, "CustomMsg");
        $this->Fields['jml_jns_koperasi_konsumen'] = &$this->jml_jns_koperasi_konsumen;

        // jml_jns_koperasi_pemasaran
        $this->jml_jns_koperasi_pemasaran = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jml_jns_koperasi_pemasaran', 'jml_jns_koperasi_pemasaran', '`jml_jns_koperasi_pemasaran`', '`jml_jns_koperasi_pemasaran`', 131, 22, -1, false, '`jml_jns_koperasi_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_jns_koperasi_pemasaran->Sortable = true; // Allow sort
        $this->jml_jns_koperasi_pemasaran->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_jns_koperasi_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_jns_koperasi_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_jns_koperasi_pemasaran->Param, "CustomMsg");
        $this->Fields['jml_jns_koperasi_pemasaran'] = &$this->jml_jns_koperasi_pemasaran;

        // jml_jns_koperasi_produsen
        $this->jml_jns_koperasi_produsen = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jml_jns_koperasi_produsen', 'jml_jns_koperasi_produsen', '`jml_jns_koperasi_produsen`', '`jml_jns_koperasi_produsen`', 131, 22, -1, false, '`jml_jns_koperasi_produsen`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_jns_koperasi_produsen->Sortable = true; // Allow sort
        $this->jml_jns_koperasi_produsen->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_jns_koperasi_produsen->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_jns_koperasi_produsen->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_jns_koperasi_produsen->Param, "CustomMsg");
        $this->Fields['jml_jns_koperasi_produsen'] = &$this->jml_jns_koperasi_produsen;

        // jml_jns_koperasi_sp
        $this->jml_jns_koperasi_sp = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_jml_jns_koperasi_sp', 'jml_jns_koperasi_sp', '`jml_jns_koperasi_sp`', '`jml_jns_koperasi_sp`', 131, 22, -1, false, '`jml_jns_koperasi_sp`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->jml_jns_koperasi_sp->Sortable = true; // Allow sort
        $this->jml_jns_koperasi_sp->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->jml_jns_koperasi_sp->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->jml_jns_koperasi_sp->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->jml_jns_koperasi_sp->Param, "CustomMsg");
        $this->Fields['jml_jns_koperasi_sp'] = &$this->jml_jns_koperasi_sp;

        // Jumlah Anggota
        $this->Jumlah_Anggota = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Anggota', 'Jumlah Anggota', '`Jumlah Anggota`', '`Jumlah Anggota`', 131, 32, -1, false, '`Jumlah Anggota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Anggota->Sortable = true; // Allow sort
        $this->Jumlah_Anggota->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Anggota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Anggota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Anggota->Param, "CustomMsg");
        $this->Fields['Jumlah Anggota'] = &$this->Jumlah_Anggota;

        // Jumlah Anggota Laki-Laki
        $this->Jumlah_Anggota_LakiLaki = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Anggota_LakiLaki', 'Jumlah Anggota Laki-Laki', '`Jumlah Anggota Laki-Laki`', '`Jumlah Anggota Laki-Laki`', 131, 32, -1, false, '`Jumlah Anggota Laki-Laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Anggota_LakiLaki->Sortable = true; // Allow sort
        $this->Jumlah_Anggota_LakiLaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Anggota_LakiLaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Anggota_LakiLaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Anggota_LakiLaki->Param, "CustomMsg");
        $this->Fields['Jumlah Anggota Laki-Laki'] = &$this->Jumlah_Anggota_LakiLaki;

        // Jumlah Anggota Perempuan
        $this->Jumlah_Anggota_Perempuan = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Anggota_Perempuan', 'Jumlah Anggota Perempuan', '`Jumlah Anggota Perempuan`', '`Jumlah Anggota Perempuan`', 131, 32, -1, false, '`Jumlah Anggota Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Anggota_Perempuan->Sortable = true; // Allow sort
        $this->Jumlah_Anggota_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Anggota_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Anggota_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Anggota_Perempuan->Param, "CustomMsg");
        $this->Fields['Jumlah Anggota Perempuan'] = &$this->Jumlah_Anggota_Perempuan;

        // Jumlah Calon Anggota
        $this->Jumlah_Calon_Anggota = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Calon_Anggota', 'Jumlah Calon Anggota', '`Jumlah Calon Anggota`', '`Jumlah Calon Anggota`', 131, 32, -1, false, '`Jumlah Calon Anggota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Calon_Anggota->Sortable = true; // Allow sort
        $this->Jumlah_Calon_Anggota->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Calon_Anggota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Calon_Anggota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Calon_Anggota->Param, "CustomMsg");
        $this->Fields['Jumlah Calon Anggota'] = &$this->Jumlah_Calon_Anggota;

        // Jumlah Aset
        $this->Jumlah_Aset = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Aset', 'Jumlah Aset', '`Jumlah Aset`', '`Jumlah Aset`', 5, 23, -1, false, '`Jumlah Aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Aset->Sortable = true; // Allow sort
        $this->Jumlah_Aset->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Aset->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Aset->Param, "CustomMsg");
        $this->Fields['Jumlah Aset'] = &$this->Jumlah_Aset;

        // Jumlah Volume Usaha
        $this->Jumlah_Volume_Usaha = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Volume_Usaha', 'Jumlah Volume Usaha', '`Jumlah Volume Usaha`', '`Jumlah Volume Usaha`', 5, 23, -1, false, '`Jumlah Volume Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Volume_Usaha->Sortable = true; // Allow sort
        $this->Jumlah_Volume_Usaha->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Volume_Usaha->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Volume_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Volume_Usaha->Param, "CustomMsg");
        $this->Fields['Jumlah Volume Usaha'] = &$this->Jumlah_Volume_Usaha;

        // Modal Luar
        $this->Modal_Luar = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Modal_Luar', 'Modal Luar', '`Modal Luar`', '`Modal Luar`', 5, 23, -1, false, '`Modal Luar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Modal_Luar->Sortable = true; // Allow sort
        $this->Modal_Luar->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Modal_Luar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Modal_Luar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Modal_Luar->Param, "CustomMsg");
        $this->Fields['Modal Luar'] = &$this->Modal_Luar;

        // Biaya
        $this->Biaya = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Biaya', 'Biaya', '`Biaya`', '`Biaya`', 5, 23, -1, false, '`Biaya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Biaya->Sortable = true; // Allow sort
        $this->Biaya->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Biaya->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Biaya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Biaya->Param, "CustomMsg");
        $this->Fields['Biaya'] = &$this->Biaya;

        // Modal Sendiri
        $this->Modal_Sendiri = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Modal_Sendiri', 'Modal Sendiri', '`Modal Sendiri`', '`Modal Sendiri`', 5, 23, -1, false, '`Modal Sendiri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Modal_Sendiri->Sortable = true; // Allow sort
        $this->Modal_Sendiri->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Modal_Sendiri->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Modal_Sendiri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Modal_Sendiri->Param, "CustomMsg");
        $this->Fields['Modal Sendiri'] = &$this->Modal_Sendiri;

        // Jumlah Pinjaman
        $this->Jumlah_Pinjaman = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Pinjaman', 'Jumlah Pinjaman', '`Jumlah Pinjaman`', '`Jumlah Pinjaman`', 5, 23, -1, false, '`Jumlah Pinjaman`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Pinjaman->Sortable = true; // Allow sort
        $this->Jumlah_Pinjaman->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Pinjaman->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Pinjaman->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Pinjaman->Param, "CustomMsg");
        $this->Fields['Jumlah Pinjaman'] = &$this->Jumlah_Pinjaman;

        // Jumlah Dana
        $this->Jumlah_Dana = new DbField('jumlah_koperasi_perkecamatan', 'jumlah_koperasi_perkecamatan', 'x_Jumlah_Dana', 'Jumlah Dana', '`Jumlah Dana`', '`Jumlah Dana`', 5, 23, -1, false, '`Jumlah Dana`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Dana->Sortable = true; // Allow sort
        $this->Jumlah_Dana->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Dana->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Dana->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Dana->Param, "CustomMsg");
        $this->Fields['Jumlah Dana'] = &$this->Jumlah_Dana;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`jumlah_koperasi_perkecamatan`";
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
        $this->kecamatan->DbValue = $row['kecamatan'];
        $this->jumlah_koperasi->DbValue = $row['jumlah_koperasi'];
        $this->jumlah_aktif->DbValue = $row['jumlah_aktif'];
        $this->jumlah_pasif->DbValue = $row['jumlah_pasif'];
        $this->jumlah_ekonomi_konvesional->DbValue = $row['jumlah_ekonomi_konvesional'];
        $this->jumlah_ekonomi_syariah->DbValue = $row['jumlah_ekonomi_syariah'];
        $this->jml_jns_koperasi_jasa->DbValue = $row['jml_jns_koperasi_jasa'];
        $this->jml_jns_koperasi_konsumen->DbValue = $row['jml_jns_koperasi_konsumen'];
        $this->jml_jns_koperasi_pemasaran->DbValue = $row['jml_jns_koperasi_pemasaran'];
        $this->jml_jns_koperasi_produsen->DbValue = $row['jml_jns_koperasi_produsen'];
        $this->jml_jns_koperasi_sp->DbValue = $row['jml_jns_koperasi_sp'];
        $this->Jumlah_Anggota->DbValue = $row['Jumlah Anggota'];
        $this->Jumlah_Anggota_LakiLaki->DbValue = $row['Jumlah Anggota Laki-Laki'];
        $this->Jumlah_Anggota_Perempuan->DbValue = $row['Jumlah Anggota Perempuan'];
        $this->Jumlah_Calon_Anggota->DbValue = $row['Jumlah Calon Anggota'];
        $this->Jumlah_Aset->DbValue = $row['Jumlah Aset'];
        $this->Jumlah_Volume_Usaha->DbValue = $row['Jumlah Volume Usaha'];
        $this->Modal_Luar->DbValue = $row['Modal Luar'];
        $this->Biaya->DbValue = $row['Biaya'];
        $this->Modal_Sendiri->DbValue = $row['Modal Sendiri'];
        $this->Jumlah_Pinjaman->DbValue = $row['Jumlah Pinjaman'];
        $this->Jumlah_Dana->DbValue = $row['Jumlah Dana'];
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
        return $_SESSION[$name] ?? GetUrl("jumlahkoperasiperkecamatanlist");
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
        if ($pageName == "jumlahkoperasiperkecamatanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "jumlahkoperasiperkecamatanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "jumlahkoperasiperkecamatanadd") {
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
                return "JumlahKoperasiPerkecamatanView";
            case Config("API_ADD_ACTION"):
                return "JumlahKoperasiPerkecamatanAdd";
            case Config("API_EDIT_ACTION"):
                return "JumlahKoperasiPerkecamatanEdit";
            case Config("API_DELETE_ACTION"):
                return "JumlahKoperasiPerkecamatanDelete";
            case Config("API_LIST_ACTION"):
                return "JumlahKoperasiPerkecamatanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "jumlahkoperasiperkecamatanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("jumlahkoperasiperkecamatanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("jumlahkoperasiperkecamatanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "jumlahkoperasiperkecamatanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "jumlahkoperasiperkecamatanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("jumlahkoperasiperkecamatanedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("jumlahkoperasiperkecamatanadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("jumlahkoperasiperkecamatandelete", $this->getUrlParm());
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
        $this->kecamatan->setDbValue($row['kecamatan']);
        $this->jumlah_koperasi->setDbValue($row['jumlah_koperasi']);
        $this->jumlah_aktif->setDbValue($row['jumlah_aktif']);
        $this->jumlah_pasif->setDbValue($row['jumlah_pasif']);
        $this->jumlah_ekonomi_konvesional->setDbValue($row['jumlah_ekonomi_konvesional']);
        $this->jumlah_ekonomi_syariah->setDbValue($row['jumlah_ekonomi_syariah']);
        $this->jml_jns_koperasi_jasa->setDbValue($row['jml_jns_koperasi_jasa']);
        $this->jml_jns_koperasi_konsumen->setDbValue($row['jml_jns_koperasi_konsumen']);
        $this->jml_jns_koperasi_pemasaran->setDbValue($row['jml_jns_koperasi_pemasaran']);
        $this->jml_jns_koperasi_produsen->setDbValue($row['jml_jns_koperasi_produsen']);
        $this->jml_jns_koperasi_sp->setDbValue($row['jml_jns_koperasi_sp']);
        $this->Jumlah_Anggota->setDbValue($row['Jumlah Anggota']);
        $this->Jumlah_Anggota_LakiLaki->setDbValue($row['Jumlah Anggota Laki-Laki']);
        $this->Jumlah_Anggota_Perempuan->setDbValue($row['Jumlah Anggota Perempuan']);
        $this->Jumlah_Calon_Anggota->setDbValue($row['Jumlah Calon Anggota']);
        $this->Jumlah_Aset->setDbValue($row['Jumlah Aset']);
        $this->Jumlah_Volume_Usaha->setDbValue($row['Jumlah Volume Usaha']);
        $this->Modal_Luar->setDbValue($row['Modal Luar']);
        $this->Biaya->setDbValue($row['Biaya']);
        $this->Modal_Sendiri->setDbValue($row['Modal Sendiri']);
        $this->Jumlah_Pinjaman->setDbValue($row['Jumlah Pinjaman']);
        $this->Jumlah_Dana->setDbValue($row['Jumlah Dana']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // kecamatan

        // jumlah_koperasi

        // jumlah_aktif

        // jumlah_pasif

        // jumlah_ekonomi_konvesional

        // jumlah_ekonomi_syariah

        // jml_jns_koperasi_jasa

        // jml_jns_koperasi_konsumen

        // jml_jns_koperasi_pemasaran

        // jml_jns_koperasi_produsen

        // jml_jns_koperasi_sp

        // Jumlah Anggota

        // Jumlah Anggota Laki-Laki

        // Jumlah Anggota Perempuan

        // Jumlah Calon Anggota

        // Jumlah Aset

        // Jumlah Volume Usaha

        // Modal Luar

        // Biaya

        // Modal Sendiri

        // Jumlah Pinjaman

        // Jumlah Dana

        // kecamatan
        $this->kecamatan->ViewValue = $this->kecamatan->CurrentValue;
        $this->kecamatan->ViewCustomAttributes = "";

        // jumlah_koperasi
        $this->jumlah_koperasi->ViewValue = $this->jumlah_koperasi->CurrentValue;
        $this->jumlah_koperasi->ViewValue = FormatNumber($this->jumlah_koperasi->ViewValue, 0, -2, -2, -2);
        $this->jumlah_koperasi->ViewCustomAttributes = "";

        // jumlah_aktif
        $this->jumlah_aktif->ViewValue = $this->jumlah_aktif->CurrentValue;
        $this->jumlah_aktif->ViewValue = FormatNumber($this->jumlah_aktif->ViewValue, 2, -2, -2, -2);
        $this->jumlah_aktif->ViewCustomAttributes = "";

        // jumlah_pasif
        $this->jumlah_pasif->ViewValue = $this->jumlah_pasif->CurrentValue;
        $this->jumlah_pasif->ViewValue = FormatNumber($this->jumlah_pasif->ViewValue, 2, -2, -2, -2);
        $this->jumlah_pasif->ViewCustomAttributes = "";

        // jumlah_ekonomi_konvesional
        $this->jumlah_ekonomi_konvesional->ViewValue = $this->jumlah_ekonomi_konvesional->CurrentValue;
        $this->jumlah_ekonomi_konvesional->ViewValue = FormatNumber($this->jumlah_ekonomi_konvesional->ViewValue, 2, -2, -2, -2);
        $this->jumlah_ekonomi_konvesional->ViewCustomAttributes = "";

        // jumlah_ekonomi_syariah
        $this->jumlah_ekonomi_syariah->ViewValue = $this->jumlah_ekonomi_syariah->CurrentValue;
        $this->jumlah_ekonomi_syariah->ViewValue = FormatNumber($this->jumlah_ekonomi_syariah->ViewValue, 2, -2, -2, -2);
        $this->jumlah_ekonomi_syariah->ViewCustomAttributes = "";

        // jml_jns_koperasi_jasa
        $this->jml_jns_koperasi_jasa->ViewValue = $this->jml_jns_koperasi_jasa->CurrentValue;
        $this->jml_jns_koperasi_jasa->ViewValue = FormatNumber($this->jml_jns_koperasi_jasa->ViewValue, 2, -2, -2, -2);
        $this->jml_jns_koperasi_jasa->ViewCustomAttributes = "";

        // jml_jns_koperasi_konsumen
        $this->jml_jns_koperasi_konsumen->ViewValue = $this->jml_jns_koperasi_konsumen->CurrentValue;
        $this->jml_jns_koperasi_konsumen->ViewValue = FormatNumber($this->jml_jns_koperasi_konsumen->ViewValue, 2, -2, -2, -2);
        $this->jml_jns_koperasi_konsumen->ViewCustomAttributes = "";

        // jml_jns_koperasi_pemasaran
        $this->jml_jns_koperasi_pemasaran->ViewValue = $this->jml_jns_koperasi_pemasaran->CurrentValue;
        $this->jml_jns_koperasi_pemasaran->ViewValue = FormatNumber($this->jml_jns_koperasi_pemasaran->ViewValue, 2, -2, -2, -2);
        $this->jml_jns_koperasi_pemasaran->ViewCustomAttributes = "";

        // jml_jns_koperasi_produsen
        $this->jml_jns_koperasi_produsen->ViewValue = $this->jml_jns_koperasi_produsen->CurrentValue;
        $this->jml_jns_koperasi_produsen->ViewValue = FormatNumber($this->jml_jns_koperasi_produsen->ViewValue, 2, -2, -2, -2);
        $this->jml_jns_koperasi_produsen->ViewCustomAttributes = "";

        // jml_jns_koperasi_sp
        $this->jml_jns_koperasi_sp->ViewValue = $this->jml_jns_koperasi_sp->CurrentValue;
        $this->jml_jns_koperasi_sp->ViewValue = FormatNumber($this->jml_jns_koperasi_sp->ViewValue, 2, -2, -2, -2);
        $this->jml_jns_koperasi_sp->ViewCustomAttributes = "";

        // Jumlah Anggota
        $this->Jumlah_Anggota->ViewValue = $this->Jumlah_Anggota->CurrentValue;
        $this->Jumlah_Anggota->ViewValue = FormatNumber($this->Jumlah_Anggota->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Anggota->ViewCustomAttributes = "";

        // Jumlah Anggota Laki-Laki
        $this->Jumlah_Anggota_LakiLaki->ViewValue = $this->Jumlah_Anggota_LakiLaki->CurrentValue;
        $this->Jumlah_Anggota_LakiLaki->ViewValue = FormatNumber($this->Jumlah_Anggota_LakiLaki->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Anggota_LakiLaki->ViewCustomAttributes = "";

        // Jumlah Anggota Perempuan
        $this->Jumlah_Anggota_Perempuan->ViewValue = $this->Jumlah_Anggota_Perempuan->CurrentValue;
        $this->Jumlah_Anggota_Perempuan->ViewValue = FormatNumber($this->Jumlah_Anggota_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Anggota_Perempuan->ViewCustomAttributes = "";

        // Jumlah Calon Anggota
        $this->Jumlah_Calon_Anggota->ViewValue = $this->Jumlah_Calon_Anggota->CurrentValue;
        $this->Jumlah_Calon_Anggota->ViewValue = FormatNumber($this->Jumlah_Calon_Anggota->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Calon_Anggota->ViewCustomAttributes = "";

        // Jumlah Aset
        $this->Jumlah_Aset->ViewValue = $this->Jumlah_Aset->CurrentValue;
        $this->Jumlah_Aset->ViewValue = FormatNumber($this->Jumlah_Aset->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Aset->ViewCustomAttributes = "";

        // Jumlah Volume Usaha
        $this->Jumlah_Volume_Usaha->ViewValue = $this->Jumlah_Volume_Usaha->CurrentValue;
        $this->Jumlah_Volume_Usaha->ViewValue = FormatNumber($this->Jumlah_Volume_Usaha->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Volume_Usaha->ViewCustomAttributes = "";

        // Modal Luar
        $this->Modal_Luar->ViewValue = $this->Modal_Luar->CurrentValue;
        $this->Modal_Luar->ViewValue = FormatNumber($this->Modal_Luar->ViewValue, 2, -2, -2, -2);
        $this->Modal_Luar->ViewCustomAttributes = "";

        // Biaya
        $this->Biaya->ViewValue = $this->Biaya->CurrentValue;
        $this->Biaya->ViewValue = FormatNumber($this->Biaya->ViewValue, 2, -2, -2, -2);
        $this->Biaya->ViewCustomAttributes = "";

        // Modal Sendiri
        $this->Modal_Sendiri->ViewValue = $this->Modal_Sendiri->CurrentValue;
        $this->Modal_Sendiri->ViewValue = FormatNumber($this->Modal_Sendiri->ViewValue, 2, -2, -2, -2);
        $this->Modal_Sendiri->ViewCustomAttributes = "";

        // Jumlah Pinjaman
        $this->Jumlah_Pinjaman->ViewValue = $this->Jumlah_Pinjaman->CurrentValue;
        $this->Jumlah_Pinjaman->ViewValue = FormatNumber($this->Jumlah_Pinjaman->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Pinjaman->ViewCustomAttributes = "";

        // Jumlah Dana
        $this->Jumlah_Dana->ViewValue = $this->Jumlah_Dana->CurrentValue;
        $this->Jumlah_Dana->ViewValue = FormatNumber($this->Jumlah_Dana->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Dana->ViewCustomAttributes = "";

        // kecamatan
        $this->kecamatan->LinkCustomAttributes = "";
        $this->kecamatan->HrefValue = "";
        $this->kecamatan->TooltipValue = "";

        // jumlah_koperasi
        $this->jumlah_koperasi->LinkCustomAttributes = "";
        $this->jumlah_koperasi->HrefValue = "";
        $this->jumlah_koperasi->TooltipValue = "";

        // jumlah_aktif
        $this->jumlah_aktif->LinkCustomAttributes = "";
        $this->jumlah_aktif->HrefValue = "";
        $this->jumlah_aktif->TooltipValue = "";

        // jumlah_pasif
        $this->jumlah_pasif->LinkCustomAttributes = "";
        $this->jumlah_pasif->HrefValue = "";
        $this->jumlah_pasif->TooltipValue = "";

        // jumlah_ekonomi_konvesional
        $this->jumlah_ekonomi_konvesional->LinkCustomAttributes = "";
        $this->jumlah_ekonomi_konvesional->HrefValue = "";
        $this->jumlah_ekonomi_konvesional->TooltipValue = "";

        // jumlah_ekonomi_syariah
        $this->jumlah_ekonomi_syariah->LinkCustomAttributes = "";
        $this->jumlah_ekonomi_syariah->HrefValue = "";
        $this->jumlah_ekonomi_syariah->TooltipValue = "";

        // jml_jns_koperasi_jasa
        $this->jml_jns_koperasi_jasa->LinkCustomAttributes = "";
        $this->jml_jns_koperasi_jasa->HrefValue = "";
        $this->jml_jns_koperasi_jasa->TooltipValue = "";

        // jml_jns_koperasi_konsumen
        $this->jml_jns_koperasi_konsumen->LinkCustomAttributes = "";
        $this->jml_jns_koperasi_konsumen->HrefValue = "";
        $this->jml_jns_koperasi_konsumen->TooltipValue = "";

        // jml_jns_koperasi_pemasaran
        $this->jml_jns_koperasi_pemasaran->LinkCustomAttributes = "";
        $this->jml_jns_koperasi_pemasaran->HrefValue = "";
        $this->jml_jns_koperasi_pemasaran->TooltipValue = "";

        // jml_jns_koperasi_produsen
        $this->jml_jns_koperasi_produsen->LinkCustomAttributes = "";
        $this->jml_jns_koperasi_produsen->HrefValue = "";
        $this->jml_jns_koperasi_produsen->TooltipValue = "";

        // jml_jns_koperasi_sp
        $this->jml_jns_koperasi_sp->LinkCustomAttributes = "";
        $this->jml_jns_koperasi_sp->HrefValue = "";
        $this->jml_jns_koperasi_sp->TooltipValue = "";

        // Jumlah Anggota
        $this->Jumlah_Anggota->LinkCustomAttributes = "";
        $this->Jumlah_Anggota->HrefValue = "";
        $this->Jumlah_Anggota->TooltipValue = "";

        // Jumlah Anggota Laki-Laki
        $this->Jumlah_Anggota_LakiLaki->LinkCustomAttributes = "";
        $this->Jumlah_Anggota_LakiLaki->HrefValue = "";
        $this->Jumlah_Anggota_LakiLaki->TooltipValue = "";

        // Jumlah Anggota Perempuan
        $this->Jumlah_Anggota_Perempuan->LinkCustomAttributes = "";
        $this->Jumlah_Anggota_Perempuan->HrefValue = "";
        $this->Jumlah_Anggota_Perempuan->TooltipValue = "";

        // Jumlah Calon Anggota
        $this->Jumlah_Calon_Anggota->LinkCustomAttributes = "";
        $this->Jumlah_Calon_Anggota->HrefValue = "";
        $this->Jumlah_Calon_Anggota->TooltipValue = "";

        // Jumlah Aset
        $this->Jumlah_Aset->LinkCustomAttributes = "";
        $this->Jumlah_Aset->HrefValue = "";
        $this->Jumlah_Aset->TooltipValue = "";

        // Jumlah Volume Usaha
        $this->Jumlah_Volume_Usaha->LinkCustomAttributes = "";
        $this->Jumlah_Volume_Usaha->HrefValue = "";
        $this->Jumlah_Volume_Usaha->TooltipValue = "";

        // Modal Luar
        $this->Modal_Luar->LinkCustomAttributes = "";
        $this->Modal_Luar->HrefValue = "";
        $this->Modal_Luar->TooltipValue = "";

        // Biaya
        $this->Biaya->LinkCustomAttributes = "";
        $this->Biaya->HrefValue = "";
        $this->Biaya->TooltipValue = "";

        // Modal Sendiri
        $this->Modal_Sendiri->LinkCustomAttributes = "";
        $this->Modal_Sendiri->HrefValue = "";
        $this->Modal_Sendiri->TooltipValue = "";

        // Jumlah Pinjaman
        $this->Jumlah_Pinjaman->LinkCustomAttributes = "";
        $this->Jumlah_Pinjaman->HrefValue = "";
        $this->Jumlah_Pinjaman->TooltipValue = "";

        // Jumlah Dana
        $this->Jumlah_Dana->LinkCustomAttributes = "";
        $this->Jumlah_Dana->HrefValue = "";
        $this->Jumlah_Dana->TooltipValue = "";

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

        // kecamatan
        $this->kecamatan->EditAttrs["class"] = "form-control";
        $this->kecamatan->EditCustomAttributes = "";
        if (!$this->kecamatan->Raw) {
            $this->kecamatan->CurrentValue = HtmlDecode($this->kecamatan->CurrentValue);
        }
        $this->kecamatan->EditValue = $this->kecamatan->CurrentValue;
        $this->kecamatan->PlaceHolder = RemoveHtml($this->kecamatan->caption());

        // jumlah_koperasi
        $this->jumlah_koperasi->EditAttrs["class"] = "form-control";
        $this->jumlah_koperasi->EditCustomAttributes = "";
        $this->jumlah_koperasi->EditValue = $this->jumlah_koperasi->CurrentValue;
        $this->jumlah_koperasi->PlaceHolder = RemoveHtml($this->jumlah_koperasi->caption());

        // jumlah_aktif
        $this->jumlah_aktif->EditAttrs["class"] = "form-control";
        $this->jumlah_aktif->EditCustomAttributes = "";
        $this->jumlah_aktif->EditValue = $this->jumlah_aktif->CurrentValue;
        $this->jumlah_aktif->PlaceHolder = RemoveHtml($this->jumlah_aktif->caption());
        if (strval($this->jumlah_aktif->EditValue) != "" && is_numeric($this->jumlah_aktif->EditValue)) {
            $this->jumlah_aktif->EditValue = FormatNumber($this->jumlah_aktif->EditValue, -2, -2, -2, -2);
        }

        // jumlah_pasif
        $this->jumlah_pasif->EditAttrs["class"] = "form-control";
        $this->jumlah_pasif->EditCustomAttributes = "";
        $this->jumlah_pasif->EditValue = $this->jumlah_pasif->CurrentValue;
        $this->jumlah_pasif->PlaceHolder = RemoveHtml($this->jumlah_pasif->caption());
        if (strval($this->jumlah_pasif->EditValue) != "" && is_numeric($this->jumlah_pasif->EditValue)) {
            $this->jumlah_pasif->EditValue = FormatNumber($this->jumlah_pasif->EditValue, -2, -2, -2, -2);
        }

        // jumlah_ekonomi_konvesional
        $this->jumlah_ekonomi_konvesional->EditAttrs["class"] = "form-control";
        $this->jumlah_ekonomi_konvesional->EditCustomAttributes = "";
        $this->jumlah_ekonomi_konvesional->EditValue = $this->jumlah_ekonomi_konvesional->CurrentValue;
        $this->jumlah_ekonomi_konvesional->PlaceHolder = RemoveHtml($this->jumlah_ekonomi_konvesional->caption());
        if (strval($this->jumlah_ekonomi_konvesional->EditValue) != "" && is_numeric($this->jumlah_ekonomi_konvesional->EditValue)) {
            $this->jumlah_ekonomi_konvesional->EditValue = FormatNumber($this->jumlah_ekonomi_konvesional->EditValue, -2, -2, -2, -2);
        }

        // jumlah_ekonomi_syariah
        $this->jumlah_ekonomi_syariah->EditAttrs["class"] = "form-control";
        $this->jumlah_ekonomi_syariah->EditCustomAttributes = "";
        $this->jumlah_ekonomi_syariah->EditValue = $this->jumlah_ekonomi_syariah->CurrentValue;
        $this->jumlah_ekonomi_syariah->PlaceHolder = RemoveHtml($this->jumlah_ekonomi_syariah->caption());
        if (strval($this->jumlah_ekonomi_syariah->EditValue) != "" && is_numeric($this->jumlah_ekonomi_syariah->EditValue)) {
            $this->jumlah_ekonomi_syariah->EditValue = FormatNumber($this->jumlah_ekonomi_syariah->EditValue, -2, -2, -2, -2);
        }

        // jml_jns_koperasi_jasa
        $this->jml_jns_koperasi_jasa->EditAttrs["class"] = "form-control";
        $this->jml_jns_koperasi_jasa->EditCustomAttributes = "";
        $this->jml_jns_koperasi_jasa->EditValue = $this->jml_jns_koperasi_jasa->CurrentValue;
        $this->jml_jns_koperasi_jasa->PlaceHolder = RemoveHtml($this->jml_jns_koperasi_jasa->caption());
        if (strval($this->jml_jns_koperasi_jasa->EditValue) != "" && is_numeric($this->jml_jns_koperasi_jasa->EditValue)) {
            $this->jml_jns_koperasi_jasa->EditValue = FormatNumber($this->jml_jns_koperasi_jasa->EditValue, -2, -2, -2, -2);
        }

        // jml_jns_koperasi_konsumen
        $this->jml_jns_koperasi_konsumen->EditAttrs["class"] = "form-control";
        $this->jml_jns_koperasi_konsumen->EditCustomAttributes = "";
        $this->jml_jns_koperasi_konsumen->EditValue = $this->jml_jns_koperasi_konsumen->CurrentValue;
        $this->jml_jns_koperasi_konsumen->PlaceHolder = RemoveHtml($this->jml_jns_koperasi_konsumen->caption());
        if (strval($this->jml_jns_koperasi_konsumen->EditValue) != "" && is_numeric($this->jml_jns_koperasi_konsumen->EditValue)) {
            $this->jml_jns_koperasi_konsumen->EditValue = FormatNumber($this->jml_jns_koperasi_konsumen->EditValue, -2, -2, -2, -2);
        }

        // jml_jns_koperasi_pemasaran
        $this->jml_jns_koperasi_pemasaran->EditAttrs["class"] = "form-control";
        $this->jml_jns_koperasi_pemasaran->EditCustomAttributes = "";
        $this->jml_jns_koperasi_pemasaran->EditValue = $this->jml_jns_koperasi_pemasaran->CurrentValue;
        $this->jml_jns_koperasi_pemasaran->PlaceHolder = RemoveHtml($this->jml_jns_koperasi_pemasaran->caption());
        if (strval($this->jml_jns_koperasi_pemasaran->EditValue) != "" && is_numeric($this->jml_jns_koperasi_pemasaran->EditValue)) {
            $this->jml_jns_koperasi_pemasaran->EditValue = FormatNumber($this->jml_jns_koperasi_pemasaran->EditValue, -2, -2, -2, -2);
        }

        // jml_jns_koperasi_produsen
        $this->jml_jns_koperasi_produsen->EditAttrs["class"] = "form-control";
        $this->jml_jns_koperasi_produsen->EditCustomAttributes = "";
        $this->jml_jns_koperasi_produsen->EditValue = $this->jml_jns_koperasi_produsen->CurrentValue;
        $this->jml_jns_koperasi_produsen->PlaceHolder = RemoveHtml($this->jml_jns_koperasi_produsen->caption());
        if (strval($this->jml_jns_koperasi_produsen->EditValue) != "" && is_numeric($this->jml_jns_koperasi_produsen->EditValue)) {
            $this->jml_jns_koperasi_produsen->EditValue = FormatNumber($this->jml_jns_koperasi_produsen->EditValue, -2, -2, -2, -2);
        }

        // jml_jns_koperasi_sp
        $this->jml_jns_koperasi_sp->EditAttrs["class"] = "form-control";
        $this->jml_jns_koperasi_sp->EditCustomAttributes = "";
        $this->jml_jns_koperasi_sp->EditValue = $this->jml_jns_koperasi_sp->CurrentValue;
        $this->jml_jns_koperasi_sp->PlaceHolder = RemoveHtml($this->jml_jns_koperasi_sp->caption());
        if (strval($this->jml_jns_koperasi_sp->EditValue) != "" && is_numeric($this->jml_jns_koperasi_sp->EditValue)) {
            $this->jml_jns_koperasi_sp->EditValue = FormatNumber($this->jml_jns_koperasi_sp->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Anggota
        $this->Jumlah_Anggota->EditAttrs["class"] = "form-control";
        $this->Jumlah_Anggota->EditCustomAttributes = "";
        $this->Jumlah_Anggota->EditValue = $this->Jumlah_Anggota->CurrentValue;
        $this->Jumlah_Anggota->PlaceHolder = RemoveHtml($this->Jumlah_Anggota->caption());
        if (strval($this->Jumlah_Anggota->EditValue) != "" && is_numeric($this->Jumlah_Anggota->EditValue)) {
            $this->Jumlah_Anggota->EditValue = FormatNumber($this->Jumlah_Anggota->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Anggota Laki-Laki
        $this->Jumlah_Anggota_LakiLaki->EditAttrs["class"] = "form-control";
        $this->Jumlah_Anggota_LakiLaki->EditCustomAttributes = "";
        $this->Jumlah_Anggota_LakiLaki->EditValue = $this->Jumlah_Anggota_LakiLaki->CurrentValue;
        $this->Jumlah_Anggota_LakiLaki->PlaceHolder = RemoveHtml($this->Jumlah_Anggota_LakiLaki->caption());
        if (strval($this->Jumlah_Anggota_LakiLaki->EditValue) != "" && is_numeric($this->Jumlah_Anggota_LakiLaki->EditValue)) {
            $this->Jumlah_Anggota_LakiLaki->EditValue = FormatNumber($this->Jumlah_Anggota_LakiLaki->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Anggota Perempuan
        $this->Jumlah_Anggota_Perempuan->EditAttrs["class"] = "form-control";
        $this->Jumlah_Anggota_Perempuan->EditCustomAttributes = "";
        $this->Jumlah_Anggota_Perempuan->EditValue = $this->Jumlah_Anggota_Perempuan->CurrentValue;
        $this->Jumlah_Anggota_Perempuan->PlaceHolder = RemoveHtml($this->Jumlah_Anggota_Perempuan->caption());
        if (strval($this->Jumlah_Anggota_Perempuan->EditValue) != "" && is_numeric($this->Jumlah_Anggota_Perempuan->EditValue)) {
            $this->Jumlah_Anggota_Perempuan->EditValue = FormatNumber($this->Jumlah_Anggota_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Calon Anggota
        $this->Jumlah_Calon_Anggota->EditAttrs["class"] = "form-control";
        $this->Jumlah_Calon_Anggota->EditCustomAttributes = "";
        $this->Jumlah_Calon_Anggota->EditValue = $this->Jumlah_Calon_Anggota->CurrentValue;
        $this->Jumlah_Calon_Anggota->PlaceHolder = RemoveHtml($this->Jumlah_Calon_Anggota->caption());
        if (strval($this->Jumlah_Calon_Anggota->EditValue) != "" && is_numeric($this->Jumlah_Calon_Anggota->EditValue)) {
            $this->Jumlah_Calon_Anggota->EditValue = FormatNumber($this->Jumlah_Calon_Anggota->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Aset
        $this->Jumlah_Aset->EditAttrs["class"] = "form-control";
        $this->Jumlah_Aset->EditCustomAttributes = "";
        $this->Jumlah_Aset->EditValue = $this->Jumlah_Aset->CurrentValue;
        $this->Jumlah_Aset->PlaceHolder = RemoveHtml($this->Jumlah_Aset->caption());
        if (strval($this->Jumlah_Aset->EditValue) != "" && is_numeric($this->Jumlah_Aset->EditValue)) {
            $this->Jumlah_Aset->EditValue = FormatNumber($this->Jumlah_Aset->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Volume Usaha
        $this->Jumlah_Volume_Usaha->EditAttrs["class"] = "form-control";
        $this->Jumlah_Volume_Usaha->EditCustomAttributes = "";
        $this->Jumlah_Volume_Usaha->EditValue = $this->Jumlah_Volume_Usaha->CurrentValue;
        $this->Jumlah_Volume_Usaha->PlaceHolder = RemoveHtml($this->Jumlah_Volume_Usaha->caption());
        if (strval($this->Jumlah_Volume_Usaha->EditValue) != "" && is_numeric($this->Jumlah_Volume_Usaha->EditValue)) {
            $this->Jumlah_Volume_Usaha->EditValue = FormatNumber($this->Jumlah_Volume_Usaha->EditValue, -2, -2, -2, -2);
        }

        // Modal Luar
        $this->Modal_Luar->EditAttrs["class"] = "form-control";
        $this->Modal_Luar->EditCustomAttributes = "";
        $this->Modal_Luar->EditValue = $this->Modal_Luar->CurrentValue;
        $this->Modal_Luar->PlaceHolder = RemoveHtml($this->Modal_Luar->caption());
        if (strval($this->Modal_Luar->EditValue) != "" && is_numeric($this->Modal_Luar->EditValue)) {
            $this->Modal_Luar->EditValue = FormatNumber($this->Modal_Luar->EditValue, -2, -2, -2, -2);
        }

        // Biaya
        $this->Biaya->EditAttrs["class"] = "form-control";
        $this->Biaya->EditCustomAttributes = "";
        $this->Biaya->EditValue = $this->Biaya->CurrentValue;
        $this->Biaya->PlaceHolder = RemoveHtml($this->Biaya->caption());
        if (strval($this->Biaya->EditValue) != "" && is_numeric($this->Biaya->EditValue)) {
            $this->Biaya->EditValue = FormatNumber($this->Biaya->EditValue, -2, -2, -2, -2);
        }

        // Modal Sendiri
        $this->Modal_Sendiri->EditAttrs["class"] = "form-control";
        $this->Modal_Sendiri->EditCustomAttributes = "";
        $this->Modal_Sendiri->EditValue = $this->Modal_Sendiri->CurrentValue;
        $this->Modal_Sendiri->PlaceHolder = RemoveHtml($this->Modal_Sendiri->caption());
        if (strval($this->Modal_Sendiri->EditValue) != "" && is_numeric($this->Modal_Sendiri->EditValue)) {
            $this->Modal_Sendiri->EditValue = FormatNumber($this->Modal_Sendiri->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Pinjaman
        $this->Jumlah_Pinjaman->EditAttrs["class"] = "form-control";
        $this->Jumlah_Pinjaman->EditCustomAttributes = "";
        $this->Jumlah_Pinjaman->EditValue = $this->Jumlah_Pinjaman->CurrentValue;
        $this->Jumlah_Pinjaman->PlaceHolder = RemoveHtml($this->Jumlah_Pinjaman->caption());
        if (strval($this->Jumlah_Pinjaman->EditValue) != "" && is_numeric($this->Jumlah_Pinjaman->EditValue)) {
            $this->Jumlah_Pinjaman->EditValue = FormatNumber($this->Jumlah_Pinjaman->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Dana
        $this->Jumlah_Dana->EditAttrs["class"] = "form-control";
        $this->Jumlah_Dana->EditCustomAttributes = "";
        $this->Jumlah_Dana->EditValue = $this->Jumlah_Dana->CurrentValue;
        $this->Jumlah_Dana->PlaceHolder = RemoveHtml($this->Jumlah_Dana->caption());
        if (strval($this->Jumlah_Dana->EditValue) != "" && is_numeric($this->Jumlah_Dana->EditValue)) {
            $this->Jumlah_Dana->EditValue = FormatNumber($this->Jumlah_Dana->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->kecamatan);
                    $doc->exportCaption($this->jumlah_koperasi);
                    $doc->exportCaption($this->jumlah_aktif);
                    $doc->exportCaption($this->jumlah_pasif);
                    $doc->exportCaption($this->jumlah_ekonomi_konvesional);
                    $doc->exportCaption($this->jumlah_ekonomi_syariah);
                    $doc->exportCaption($this->jml_jns_koperasi_jasa);
                    $doc->exportCaption($this->jml_jns_koperasi_konsumen);
                    $doc->exportCaption($this->jml_jns_koperasi_pemasaran);
                    $doc->exportCaption($this->jml_jns_koperasi_produsen);
                    $doc->exportCaption($this->jml_jns_koperasi_sp);
                    $doc->exportCaption($this->Jumlah_Anggota);
                    $doc->exportCaption($this->Jumlah_Anggota_LakiLaki);
                    $doc->exportCaption($this->Jumlah_Anggota_Perempuan);
                    $doc->exportCaption($this->Jumlah_Calon_Anggota);
                    $doc->exportCaption($this->Jumlah_Aset);
                    $doc->exportCaption($this->Jumlah_Volume_Usaha);
                    $doc->exportCaption($this->Modal_Luar);
                    $doc->exportCaption($this->Biaya);
                    $doc->exportCaption($this->Modal_Sendiri);
                    $doc->exportCaption($this->Jumlah_Pinjaman);
                    $doc->exportCaption($this->Jumlah_Dana);
                } else {
                    $doc->exportCaption($this->kecamatan);
                    $doc->exportCaption($this->jumlah_koperasi);
                    $doc->exportCaption($this->jumlah_aktif);
                    $doc->exportCaption($this->jumlah_pasif);
                    $doc->exportCaption($this->jumlah_ekonomi_konvesional);
                    $doc->exportCaption($this->jumlah_ekonomi_syariah);
                    $doc->exportCaption($this->jml_jns_koperasi_jasa);
                    $doc->exportCaption($this->jml_jns_koperasi_konsumen);
                    $doc->exportCaption($this->jml_jns_koperasi_pemasaran);
                    $doc->exportCaption($this->jml_jns_koperasi_produsen);
                    $doc->exportCaption($this->jml_jns_koperasi_sp);
                    $doc->exportCaption($this->Jumlah_Anggota);
                    $doc->exportCaption($this->Jumlah_Anggota_LakiLaki);
                    $doc->exportCaption($this->Jumlah_Anggota_Perempuan);
                    $doc->exportCaption($this->Jumlah_Calon_Anggota);
                    $doc->exportCaption($this->Jumlah_Aset);
                    $doc->exportCaption($this->Jumlah_Volume_Usaha);
                    $doc->exportCaption($this->Modal_Luar);
                    $doc->exportCaption($this->Biaya);
                    $doc->exportCaption($this->Modal_Sendiri);
                    $doc->exportCaption($this->Jumlah_Pinjaman);
                    $doc->exportCaption($this->Jumlah_Dana);
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
                        $doc->exportField($this->kecamatan);
                        $doc->exportField($this->jumlah_koperasi);
                        $doc->exportField($this->jumlah_aktif);
                        $doc->exportField($this->jumlah_pasif);
                        $doc->exportField($this->jumlah_ekonomi_konvesional);
                        $doc->exportField($this->jumlah_ekonomi_syariah);
                        $doc->exportField($this->jml_jns_koperasi_jasa);
                        $doc->exportField($this->jml_jns_koperasi_konsumen);
                        $doc->exportField($this->jml_jns_koperasi_pemasaran);
                        $doc->exportField($this->jml_jns_koperasi_produsen);
                        $doc->exportField($this->jml_jns_koperasi_sp);
                        $doc->exportField($this->Jumlah_Anggota);
                        $doc->exportField($this->Jumlah_Anggota_LakiLaki);
                        $doc->exportField($this->Jumlah_Anggota_Perempuan);
                        $doc->exportField($this->Jumlah_Calon_Anggota);
                        $doc->exportField($this->Jumlah_Aset);
                        $doc->exportField($this->Jumlah_Volume_Usaha);
                        $doc->exportField($this->Modal_Luar);
                        $doc->exportField($this->Biaya);
                        $doc->exportField($this->Modal_Sendiri);
                        $doc->exportField($this->Jumlah_Pinjaman);
                        $doc->exportField($this->Jumlah_Dana);
                    } else {
                        $doc->exportField($this->kecamatan);
                        $doc->exportField($this->jumlah_koperasi);
                        $doc->exportField($this->jumlah_aktif);
                        $doc->exportField($this->jumlah_pasif);
                        $doc->exportField($this->jumlah_ekonomi_konvesional);
                        $doc->exportField($this->jumlah_ekonomi_syariah);
                        $doc->exportField($this->jml_jns_koperasi_jasa);
                        $doc->exportField($this->jml_jns_koperasi_konsumen);
                        $doc->exportField($this->jml_jns_koperasi_pemasaran);
                        $doc->exportField($this->jml_jns_koperasi_produsen);
                        $doc->exportField($this->jml_jns_koperasi_sp);
                        $doc->exportField($this->Jumlah_Anggota);
                        $doc->exportField($this->Jumlah_Anggota_LakiLaki);
                        $doc->exportField($this->Jumlah_Anggota_Perempuan);
                        $doc->exportField($this->Jumlah_Calon_Anggota);
                        $doc->exportField($this->Jumlah_Aset);
                        $doc->exportField($this->Jumlah_Volume_Usaha);
                        $doc->exportField($this->Modal_Luar);
                        $doc->exportField($this->Biaya);
                        $doc->exportField($this->Modal_Sendiri);
                        $doc->exportField($this->Jumlah_Pinjaman);
                        $doc->exportField($this->Jumlah_Dana);
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
