<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for temp_skor_kelas
 */
class TempSkorKelas extends DbTable
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
    public $NAMA_PEMILIK;
    public $NO_HP;
    public $NAMA_USAHA;
    public $KALURAHAN;
    public $KAPANEWON;
    public $skor_produksi;
    public $maxskor_produksi;
    public $bobot_produksi;
    public $skor_pemasaran;
    public $maxskor_pemasaran;
    public $bobot_pemasaran;
    public $skor_pemasaranonline;
    public $maxskor_pemasaranonline;
    public $bobot_pemasaranonline;
    public $skor_kelembagaan;
    public $maxskor_kelembagaan;
    public $bobot_kelembagaan;
    public $skor_keuangan;
    public $maxskor_keuangan;
    public $bobot_keuangan;
    public $skor_sdm;
    public $maxskor_sdm;
    public $bobot_sdm;
    public $skor_kelas;
    public $maxskor_kelas;
    public $kelas_umkm;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'temp_skor_kelas';
        $this->TableName = 'temp_skor_kelas';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`temp_skor_kelas`";
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
        $this->NIK = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_NIK', 'NIK', '`NIK`', '`NIK`', 200, 16, -1, false, '`NIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NIK->IsPrimaryKey = true; // Primary key field
        $this->NIK->Nullable = false; // NOT NULL field
        $this->NIK->Required = true; // Required field
        $this->NIK->Sortable = true; // Allow sort
        $this->NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NIK->Param, "CustomMsg");
        $this->Fields['NIK'] = &$this->NIK;

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_NAMA_PEMILIK', 'NAMA_PEMILIK', '`NAMA_PEMILIK`', '`NAMA_PEMILIK`', 200, 100, -1, false, '`NAMA_PEMILIK`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_PEMILIK->Sortable = true; // Allow sort
        $this->NAMA_PEMILIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_PEMILIK->Param, "CustomMsg");
        $this->Fields['NAMA_PEMILIK'] = &$this->NAMA_PEMILIK;

        // NO_HP
        $this->NO_HP = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_NO_HP', 'NO_HP', '`NO_HP`', '`NO_HP`', 200, 20, -1, false, '`NO_HP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NO_HP->Sortable = true; // Allow sort
        $this->NO_HP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NO_HP->Param, "CustomMsg");
        $this->Fields['NO_HP'] = &$this->NO_HP;

        // NAMA_USAHA
        $this->NAMA_USAHA = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_NAMA_USAHA', 'NAMA_USAHA', '`NAMA_USAHA`', '`NAMA_USAHA`', 200, 100, -1, false, '`NAMA_USAHA`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NAMA_USAHA->Sortable = true; // Allow sort
        $this->NAMA_USAHA->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NAMA_USAHA->Param, "CustomMsg");
        $this->Fields['NAMA_USAHA'] = &$this->NAMA_USAHA;

        // KALURAHAN
        $this->KALURAHAN = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_KALURAHAN', 'KALURAHAN', '`KALURAHAN`', '`KALURAHAN`', 200, 50, -1, false, '`KALURAHAN`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KALURAHAN->Sortable = true; // Allow sort
        $this->KALURAHAN->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KALURAHAN->Param, "CustomMsg");
        $this->Fields['KALURAHAN'] = &$this->KALURAHAN;

        // KAPANEWON
        $this->KAPANEWON = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_KAPANEWON', 'KAPANEWON', '`KAPANEWON`', '`KAPANEWON`', 200, 50, -1, false, '`KAPANEWON`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->KAPANEWON->Sortable = true; // Allow sort
        $this->KAPANEWON->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->KAPANEWON->Param, "CustomMsg");
        $this->Fields['KAPANEWON'] = &$this->KAPANEWON;

        // skor_produksi
        $this->skor_produksi = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_produksi', 'skor_produksi', '`skor_produksi`', '`skor_produksi`', 5, 23, -1, false, '`skor_produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_produksi->Sortable = true; // Allow sort
        $this->skor_produksi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_produksi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_produksi->Param, "CustomMsg");
        $this->Fields['skor_produksi'] = &$this->skor_produksi;

        // maxskor_produksi
        $this->maxskor_produksi = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_produksi', 'maxskor_produksi', '`maxskor_produksi`', '`maxskor_produksi`', 5, 23, -1, false, '`maxskor_produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_produksi->Sortable = true; // Allow sort
        $this->maxskor_produksi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_produksi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_produksi->Param, "CustomMsg");
        $this->Fields['maxskor_produksi'] = &$this->maxskor_produksi;

        // bobot_produksi
        $this->bobot_produksi = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_produksi', 'bobot_produksi', '`bobot_produksi`', '`bobot_produksi`', 3, 2, -1, false, '`bobot_produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_produksi->Nullable = false; // NOT NULL field
        $this->bobot_produksi->Required = true; // Required field
        $this->bobot_produksi->Sortable = true; // Allow sort
        $this->bobot_produksi->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_produksi->Param, "CustomMsg");
        $this->Fields['bobot_produksi'] = &$this->bobot_produksi;

        // skor_pemasaran
        $this->skor_pemasaran = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_pemasaran', 'skor_pemasaran', '`skor_pemasaran`', '`skor_pemasaran`', 5, 23, -1, false, '`skor_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pemasaran->Sortable = true; // Allow sort
        $this->skor_pemasaran->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pemasaran->Param, "CustomMsg");
        $this->Fields['skor_pemasaran'] = &$this->skor_pemasaran;

        // maxskor_pemasaran
        $this->maxskor_pemasaran = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_pemasaran', 'maxskor_pemasaran', '`maxskor_pemasaran`', '`maxskor_pemasaran`', 5, 23, -1, false, '`maxskor_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_pemasaran->Sortable = true; // Allow sort
        $this->maxskor_pemasaran->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_pemasaran->Param, "CustomMsg");
        $this->Fields['maxskor_pemasaran'] = &$this->maxskor_pemasaran;

        // bobot_pemasaran
        $this->bobot_pemasaran = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_pemasaran', 'bobot_pemasaran', '`bobot_pemasaran`', '`bobot_pemasaran`', 3, 2, -1, false, '`bobot_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_pemasaran->Nullable = false; // NOT NULL field
        $this->bobot_pemasaran->Required = true; // Required field
        $this->bobot_pemasaran->Sortable = true; // Allow sort
        $this->bobot_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_pemasaran->Param, "CustomMsg");
        $this->Fields['bobot_pemasaran'] = &$this->bobot_pemasaran;

        // skor_pemasaranonline
        $this->skor_pemasaranonline = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_pemasaranonline', 'skor_pemasaranonline', '`skor_pemasaranonline`', '`skor_pemasaranonline`', 5, 23, -1, false, '`skor_pemasaranonline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pemasaranonline->Sortable = true; // Allow sort
        $this->skor_pemasaranonline->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pemasaranonline->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pemasaranonline->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pemasaranonline->Param, "CustomMsg");
        $this->Fields['skor_pemasaranonline'] = &$this->skor_pemasaranonline;

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_pemasaranonline', 'maxskor_pemasaranonline', '`maxskor_pemasaranonline`', '`maxskor_pemasaranonline`', 5, 23, -1, false, '`maxskor_pemasaranonline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_pemasaranonline->Sortable = true; // Allow sort
        $this->maxskor_pemasaranonline->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_pemasaranonline->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_pemasaranonline->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_pemasaranonline->Param, "CustomMsg");
        $this->Fields['maxskor_pemasaranonline'] = &$this->maxskor_pemasaranonline;

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_pemasaranonline', 'bobot_pemasaranonline', '`bobot_pemasaranonline`', '`bobot_pemasaranonline`', 3, 2, -1, false, '`bobot_pemasaranonline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_pemasaranonline->Nullable = false; // NOT NULL field
        $this->bobot_pemasaranonline->Required = true; // Required field
        $this->bobot_pemasaranonline->Sortable = true; // Allow sort
        $this->bobot_pemasaranonline->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_pemasaranonline->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_pemasaranonline->Param, "CustomMsg");
        $this->Fields['bobot_pemasaranonline'] = &$this->bobot_pemasaranonline;

        // skor_kelembagaan
        $this->skor_kelembagaan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_kelembagaan', 'skor_kelembagaan', '`skor_kelembagaan`', '`skor_kelembagaan`', 5, 23, -1, false, '`skor_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_kelembagaan->Sortable = true; // Allow sort
        $this->skor_kelembagaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_kelembagaan->Param, "CustomMsg");
        $this->Fields['skor_kelembagaan'] = &$this->skor_kelembagaan;

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_kelembagaan', 'maxskor_kelembagaan', '`maxskor_kelembagaan`', '`maxskor_kelembagaan`', 5, 23, -1, false, '`maxskor_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_kelembagaan->Sortable = true; // Allow sort
        $this->maxskor_kelembagaan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_kelembagaan->Param, "CustomMsg");
        $this->Fields['maxskor_kelembagaan'] = &$this->maxskor_kelembagaan;

        // bobot_kelembagaan
        $this->bobot_kelembagaan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_kelembagaan', 'bobot_kelembagaan', '`bobot_kelembagaan`', '`bobot_kelembagaan`', 3, 2, -1, false, '`bobot_kelembagaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_kelembagaan->Nullable = false; // NOT NULL field
        $this->bobot_kelembagaan->Required = true; // Required field
        $this->bobot_kelembagaan->Sortable = true; // Allow sort
        $this->bobot_kelembagaan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_kelembagaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_kelembagaan->Param, "CustomMsg");
        $this->Fields['bobot_kelembagaan'] = &$this->bobot_kelembagaan;

        // skor_keuangan
        $this->skor_keuangan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_keuangan', 'skor_keuangan', '`skor_keuangan`', '`skor_keuangan`', 5, 23, -1, false, '`skor_keuangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_keuangan->Sortable = true; // Allow sort
        $this->skor_keuangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_keuangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_keuangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_keuangan->Param, "CustomMsg");
        $this->Fields['skor_keuangan'] = &$this->skor_keuangan;

        // maxskor_keuangan
        $this->maxskor_keuangan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_keuangan', 'maxskor_keuangan', '`maxskor_keuangan`', '`maxskor_keuangan`', 5, 23, -1, false, '`maxskor_keuangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_keuangan->Sortable = true; // Allow sort
        $this->maxskor_keuangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_keuangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_keuangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_keuangan->Param, "CustomMsg");
        $this->Fields['maxskor_keuangan'] = &$this->maxskor_keuangan;

        // bobot_keuangan
        $this->bobot_keuangan = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_keuangan', 'bobot_keuangan', '`bobot_keuangan`', '`bobot_keuangan`', 3, 2, -1, false, '`bobot_keuangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_keuangan->Nullable = false; // NOT NULL field
        $this->bobot_keuangan->Required = true; // Required field
        $this->bobot_keuangan->Sortable = true; // Allow sort
        $this->bobot_keuangan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_keuangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_keuangan->Param, "CustomMsg");
        $this->Fields['bobot_keuangan'] = &$this->bobot_keuangan;

        // skor_sdm
        $this->skor_sdm = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_sdm', 'skor_sdm', '`skor_sdm`', '`skor_sdm`', 5, 23, -1, false, '`skor_sdm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_sdm->Sortable = true; // Allow sort
        $this->skor_sdm->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_sdm->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_sdm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_sdm->Param, "CustomMsg");
        $this->Fields['skor_sdm'] = &$this->skor_sdm;

        // maxskor_sdm
        $this->maxskor_sdm = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_sdm', 'maxskor_sdm', '`maxskor_sdm`', '`maxskor_sdm`', 5, 23, -1, false, '`maxskor_sdm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_sdm->Sortable = true; // Allow sort
        $this->maxskor_sdm->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_sdm->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_sdm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_sdm->Param, "CustomMsg");
        $this->Fields['maxskor_sdm'] = &$this->maxskor_sdm;

        // bobot_sdm
        $this->bobot_sdm = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_bobot_sdm', 'bobot_sdm', '`bobot_sdm`', '`bobot_sdm`', 3, 2, -1, false, '`bobot_sdm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_sdm->Nullable = false; // NOT NULL field
        $this->bobot_sdm->Required = true; // Required field
        $this->bobot_sdm->Sortable = true; // Allow sort
        $this->bobot_sdm->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_sdm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_sdm->Param, "CustomMsg");
        $this->Fields['bobot_sdm'] = &$this->bobot_sdm;

        // skor_kelas
        $this->skor_kelas = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_skor_kelas', 'skor_kelas', '`skor_kelas`', '`skor_kelas`', 5, 23, -1, false, '`skor_kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_kelas->Sortable = true; // Allow sort
        $this->skor_kelas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_kelas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_kelas->Param, "CustomMsg");
        $this->Fields['skor_kelas'] = &$this->skor_kelas;

        // maxskor_kelas
        $this->maxskor_kelas = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_maxskor_kelas', 'maxskor_kelas', '`maxskor_kelas`', '`maxskor_kelas`', 5, 23, -1, false, '`maxskor_kelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_kelas->Sortable = true; // Allow sort
        $this->maxskor_kelas->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_kelas->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_kelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_kelas->Param, "CustomMsg");
        $this->Fields['maxskor_kelas'] = &$this->maxskor_kelas;

        // kelas_umkm
        $this->kelas_umkm = new DbField('temp_skor_kelas', 'temp_skor_kelas', 'x_kelas_umkm', 'kelas_umkm', '`kelas_umkm`', '`kelas_umkm`', 200, 7, -1, false, '`kelas_umkm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kelas_umkm->Nullable = false; // NOT NULL field
        $this->kelas_umkm->Required = true; // Required field
        $this->kelas_umkm->Sortable = true; // Allow sort
        $this->kelas_umkm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kelas_umkm->Param, "CustomMsg");
        $this->Fields['kelas_umkm'] = &$this->kelas_umkm;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`temp_skor_kelas`";
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
        $this->NAMA_PEMILIK->DbValue = $row['NAMA_PEMILIK'];
        $this->NO_HP->DbValue = $row['NO_HP'];
        $this->NAMA_USAHA->DbValue = $row['NAMA_USAHA'];
        $this->KALURAHAN->DbValue = $row['KALURAHAN'];
        $this->KAPANEWON->DbValue = $row['KAPANEWON'];
        $this->skor_produksi->DbValue = $row['skor_produksi'];
        $this->maxskor_produksi->DbValue = $row['maxskor_produksi'];
        $this->bobot_produksi->DbValue = $row['bobot_produksi'];
        $this->skor_pemasaran->DbValue = $row['skor_pemasaran'];
        $this->maxskor_pemasaran->DbValue = $row['maxskor_pemasaran'];
        $this->bobot_pemasaran->DbValue = $row['bobot_pemasaran'];
        $this->skor_pemasaranonline->DbValue = $row['skor_pemasaranonline'];
        $this->maxskor_pemasaranonline->DbValue = $row['maxskor_pemasaranonline'];
        $this->bobot_pemasaranonline->DbValue = $row['bobot_pemasaranonline'];
        $this->skor_kelembagaan->DbValue = $row['skor_kelembagaan'];
        $this->maxskor_kelembagaan->DbValue = $row['maxskor_kelembagaan'];
        $this->bobot_kelembagaan->DbValue = $row['bobot_kelembagaan'];
        $this->skor_keuangan->DbValue = $row['skor_keuangan'];
        $this->maxskor_keuangan->DbValue = $row['maxskor_keuangan'];
        $this->bobot_keuangan->DbValue = $row['bobot_keuangan'];
        $this->skor_sdm->DbValue = $row['skor_sdm'];
        $this->maxskor_sdm->DbValue = $row['maxskor_sdm'];
        $this->bobot_sdm->DbValue = $row['bobot_sdm'];
        $this->skor_kelas->DbValue = $row['skor_kelas'];
        $this->maxskor_kelas->DbValue = $row['maxskor_kelas'];
        $this->kelas_umkm->DbValue = $row['kelas_umkm'];
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
        return $_SESSION[$name] ?? GetUrl("tempskorkelaslist");
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
        if ($pageName == "tempskorkelasview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tempskorkelasedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tempskorkelasadd") {
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
                return "TempSkorKelasView";
            case Config("API_ADD_ACTION"):
                return "TempSkorKelasAdd";
            case Config("API_EDIT_ACTION"):
                return "TempSkorKelasEdit";
            case Config("API_DELETE_ACTION"):
                return "TempSkorKelasDelete";
            case Config("API_LIST_ACTION"):
                return "TempSkorKelasList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tempskorkelaslist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tempskorkelasview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tempskorkelasview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tempskorkelasadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tempskorkelasadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tempskorkelasedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tempskorkelasadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tempskorkelasdelete", $this->getUrlParm());
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
        $this->NAMA_PEMILIK->setDbValue($row['NAMA_PEMILIK']);
        $this->NO_HP->setDbValue($row['NO_HP']);
        $this->NAMA_USAHA->setDbValue($row['NAMA_USAHA']);
        $this->KALURAHAN->setDbValue($row['KALURAHAN']);
        $this->KAPANEWON->setDbValue($row['KAPANEWON']);
        $this->skor_produksi->setDbValue($row['skor_produksi']);
        $this->maxskor_produksi->setDbValue($row['maxskor_produksi']);
        $this->bobot_produksi->setDbValue($row['bobot_produksi']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
        $this->skor_pemasaranonline->setDbValue($row['skor_pemasaranonline']);
        $this->maxskor_pemasaranonline->setDbValue($row['maxskor_pemasaranonline']);
        $this->bobot_pemasaranonline->setDbValue($row['bobot_pemasaranonline']);
        $this->skor_kelembagaan->setDbValue($row['skor_kelembagaan']);
        $this->maxskor_kelembagaan->setDbValue($row['maxskor_kelembagaan']);
        $this->bobot_kelembagaan->setDbValue($row['bobot_kelembagaan']);
        $this->skor_keuangan->setDbValue($row['skor_keuangan']);
        $this->maxskor_keuangan->setDbValue($row['maxskor_keuangan']);
        $this->bobot_keuangan->setDbValue($row['bobot_keuangan']);
        $this->skor_sdm->setDbValue($row['skor_sdm']);
        $this->maxskor_sdm->setDbValue($row['maxskor_sdm']);
        $this->bobot_sdm->setDbValue($row['bobot_sdm']);
        $this->skor_kelas->setDbValue($row['skor_kelas']);
        $this->maxskor_kelas->setDbValue($row['maxskor_kelas']);
        $this->kelas_umkm->setDbValue($row['kelas_umkm']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // NIK

        // NAMA_PEMILIK

        // NO_HP

        // NAMA_USAHA

        // KALURAHAN

        // KAPANEWON

        // skor_produksi

        // maxskor_produksi

        // bobot_produksi

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran

        // skor_pemasaranonline

        // maxskor_pemasaranonline

        // bobot_pemasaranonline

        // skor_kelembagaan

        // maxskor_kelembagaan

        // bobot_kelembagaan

        // skor_keuangan

        // maxskor_keuangan

        // bobot_keuangan

        // skor_sdm

        // maxskor_sdm

        // bobot_sdm

        // skor_kelas

        // maxskor_kelas

        // kelas_umkm

        // NIK
        $this->NIK->ViewValue = $this->NIK->CurrentValue;
        $this->NIK->ViewCustomAttributes = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->ViewValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->ViewCustomAttributes = "";

        // NO_HP
        $this->NO_HP->ViewValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->ViewCustomAttributes = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->ViewValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->ViewCustomAttributes = "";

        // KALURAHAN
        $this->KALURAHAN->ViewValue = $this->KALURAHAN->CurrentValue;
        $this->KALURAHAN->ViewCustomAttributes = "";

        // KAPANEWON
        $this->KAPANEWON->ViewValue = $this->KAPANEWON->CurrentValue;
        $this->KAPANEWON->ViewCustomAttributes = "";

        // skor_produksi
        $this->skor_produksi->ViewValue = $this->skor_produksi->CurrentValue;
        $this->skor_produksi->ViewValue = FormatNumber($this->skor_produksi->ViewValue, 2, -2, -2, -2);
        $this->skor_produksi->ViewCustomAttributes = "";

        // maxskor_produksi
        $this->maxskor_produksi->ViewValue = $this->maxskor_produksi->CurrentValue;
        $this->maxskor_produksi->ViewValue = FormatNumber($this->maxskor_produksi->ViewValue, 2, -2, -2, -2);
        $this->maxskor_produksi->ViewCustomAttributes = "";

        // bobot_produksi
        $this->bobot_produksi->ViewValue = $this->bobot_produksi->CurrentValue;
        $this->bobot_produksi->ViewValue = FormatNumber($this->bobot_produksi->ViewValue, 0, -2, -2, -2);
        $this->bobot_produksi->ViewCustomAttributes = "";

        // skor_pemasaran
        $this->skor_pemasaran->ViewValue = $this->skor_pemasaran->CurrentValue;
        $this->skor_pemasaran->ViewValue = FormatNumber($this->skor_pemasaran->ViewValue, 2, -2, -2, -2);
        $this->skor_pemasaran->ViewCustomAttributes = "";

        // maxskor_pemasaran
        $this->maxskor_pemasaran->ViewValue = $this->maxskor_pemasaran->CurrentValue;
        $this->maxskor_pemasaran->ViewValue = FormatNumber($this->maxskor_pemasaran->ViewValue, 2, -2, -2, -2);
        $this->maxskor_pemasaran->ViewCustomAttributes = "";

        // bobot_pemasaran
        $this->bobot_pemasaran->ViewValue = $this->bobot_pemasaran->CurrentValue;
        $this->bobot_pemasaran->ViewValue = FormatNumber($this->bobot_pemasaran->ViewValue, 0, -2, -2, -2);
        $this->bobot_pemasaran->ViewCustomAttributes = "";

        // skor_pemasaranonline
        $this->skor_pemasaranonline->ViewValue = $this->skor_pemasaranonline->CurrentValue;
        $this->skor_pemasaranonline->ViewValue = FormatNumber($this->skor_pemasaranonline->ViewValue, 2, -2, -2, -2);
        $this->skor_pemasaranonline->ViewCustomAttributes = "";

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline->ViewValue = $this->maxskor_pemasaranonline->CurrentValue;
        $this->maxskor_pemasaranonline->ViewValue = FormatNumber($this->maxskor_pemasaranonline->ViewValue, 2, -2, -2, -2);
        $this->maxskor_pemasaranonline->ViewCustomAttributes = "";

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline->ViewValue = $this->bobot_pemasaranonline->CurrentValue;
        $this->bobot_pemasaranonline->ViewValue = FormatNumber($this->bobot_pemasaranonline->ViewValue, 0, -2, -2, -2);
        $this->bobot_pemasaranonline->ViewCustomAttributes = "";

        // skor_kelembagaan
        $this->skor_kelembagaan->ViewValue = $this->skor_kelembagaan->CurrentValue;
        $this->skor_kelembagaan->ViewValue = FormatNumber($this->skor_kelembagaan->ViewValue, 2, -2, -2, -2);
        $this->skor_kelembagaan->ViewCustomAttributes = "";

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->ViewValue = $this->maxskor_kelembagaan->CurrentValue;
        $this->maxskor_kelembagaan->ViewValue = FormatNumber($this->maxskor_kelembagaan->ViewValue, 2, -2, -2, -2);
        $this->maxskor_kelembagaan->ViewCustomAttributes = "";

        // bobot_kelembagaan
        $this->bobot_kelembagaan->ViewValue = $this->bobot_kelembagaan->CurrentValue;
        $this->bobot_kelembagaan->ViewValue = FormatNumber($this->bobot_kelembagaan->ViewValue, 0, -2, -2, -2);
        $this->bobot_kelembagaan->ViewCustomAttributes = "";

        // skor_keuangan
        $this->skor_keuangan->ViewValue = $this->skor_keuangan->CurrentValue;
        $this->skor_keuangan->ViewValue = FormatNumber($this->skor_keuangan->ViewValue, 2, -2, -2, -2);
        $this->skor_keuangan->ViewCustomAttributes = "";

        // maxskor_keuangan
        $this->maxskor_keuangan->ViewValue = $this->maxskor_keuangan->CurrentValue;
        $this->maxskor_keuangan->ViewValue = FormatNumber($this->maxskor_keuangan->ViewValue, 2, -2, -2, -2);
        $this->maxskor_keuangan->ViewCustomAttributes = "";

        // bobot_keuangan
        $this->bobot_keuangan->ViewValue = $this->bobot_keuangan->CurrentValue;
        $this->bobot_keuangan->ViewValue = FormatNumber($this->bobot_keuangan->ViewValue, 0, -2, -2, -2);
        $this->bobot_keuangan->ViewCustomAttributes = "";

        // skor_sdm
        $this->skor_sdm->ViewValue = $this->skor_sdm->CurrentValue;
        $this->skor_sdm->ViewValue = FormatNumber($this->skor_sdm->ViewValue, 2, -2, -2, -2);
        $this->skor_sdm->ViewCustomAttributes = "";

        // maxskor_sdm
        $this->maxskor_sdm->ViewValue = $this->maxskor_sdm->CurrentValue;
        $this->maxskor_sdm->ViewValue = FormatNumber($this->maxskor_sdm->ViewValue, 2, -2, -2, -2);
        $this->maxskor_sdm->ViewCustomAttributes = "";

        // bobot_sdm
        $this->bobot_sdm->ViewValue = $this->bobot_sdm->CurrentValue;
        $this->bobot_sdm->ViewValue = FormatNumber($this->bobot_sdm->ViewValue, 0, -2, -2, -2);
        $this->bobot_sdm->ViewCustomAttributes = "";

        // skor_kelas
        $this->skor_kelas->ViewValue = $this->skor_kelas->CurrentValue;
        $this->skor_kelas->ViewValue = FormatNumber($this->skor_kelas->ViewValue, 2, -2, -2, -2);
        $this->skor_kelas->ViewCustomAttributes = "";

        // maxskor_kelas
        $this->maxskor_kelas->ViewValue = $this->maxskor_kelas->CurrentValue;
        $this->maxskor_kelas->ViewValue = FormatNumber($this->maxskor_kelas->ViewValue, 2, -2, -2, -2);
        $this->maxskor_kelas->ViewCustomAttributes = "";

        // kelas_umkm
        $this->kelas_umkm->ViewValue = $this->kelas_umkm->CurrentValue;
        $this->kelas_umkm->ViewCustomAttributes = "";

        // NIK
        $this->NIK->LinkCustomAttributes = "";
        $this->NIK->HrefValue = "";
        $this->NIK->TooltipValue = "";

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->LinkCustomAttributes = "";
        $this->NAMA_PEMILIK->HrefValue = "";
        $this->NAMA_PEMILIK->TooltipValue = "";

        // NO_HP
        $this->NO_HP->LinkCustomAttributes = "";
        $this->NO_HP->HrefValue = "";
        $this->NO_HP->TooltipValue = "";

        // NAMA_USAHA
        $this->NAMA_USAHA->LinkCustomAttributes = "";
        $this->NAMA_USAHA->HrefValue = "";
        $this->NAMA_USAHA->TooltipValue = "";

        // KALURAHAN
        $this->KALURAHAN->LinkCustomAttributes = "";
        $this->KALURAHAN->HrefValue = "";
        $this->KALURAHAN->TooltipValue = "";

        // KAPANEWON
        $this->KAPANEWON->LinkCustomAttributes = "";
        $this->KAPANEWON->HrefValue = "";
        $this->KAPANEWON->TooltipValue = "";

        // skor_produksi
        $this->skor_produksi->LinkCustomAttributes = "";
        $this->skor_produksi->HrefValue = "";
        $this->skor_produksi->TooltipValue = "";

        // maxskor_produksi
        $this->maxskor_produksi->LinkCustomAttributes = "";
        $this->maxskor_produksi->HrefValue = "";
        $this->maxskor_produksi->TooltipValue = "";

        // bobot_produksi
        $this->bobot_produksi->LinkCustomAttributes = "";
        $this->bobot_produksi->HrefValue = "";
        $this->bobot_produksi->TooltipValue = "";

        // skor_pemasaran
        $this->skor_pemasaran->LinkCustomAttributes = "";
        $this->skor_pemasaran->HrefValue = "";
        $this->skor_pemasaran->TooltipValue = "";

        // maxskor_pemasaran
        $this->maxskor_pemasaran->LinkCustomAttributes = "";
        $this->maxskor_pemasaran->HrefValue = "";
        $this->maxskor_pemasaran->TooltipValue = "";

        // bobot_pemasaran
        $this->bobot_pemasaran->LinkCustomAttributes = "";
        $this->bobot_pemasaran->HrefValue = "";
        $this->bobot_pemasaran->TooltipValue = "";

        // skor_pemasaranonline
        $this->skor_pemasaranonline->LinkCustomAttributes = "";
        $this->skor_pemasaranonline->HrefValue = "";
        $this->skor_pemasaranonline->TooltipValue = "";

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline->LinkCustomAttributes = "";
        $this->maxskor_pemasaranonline->HrefValue = "";
        $this->maxskor_pemasaranonline->TooltipValue = "";

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline->LinkCustomAttributes = "";
        $this->bobot_pemasaranonline->HrefValue = "";
        $this->bobot_pemasaranonline->TooltipValue = "";

        // skor_kelembagaan
        $this->skor_kelembagaan->LinkCustomAttributes = "";
        $this->skor_kelembagaan->HrefValue = "";
        $this->skor_kelembagaan->TooltipValue = "";

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->LinkCustomAttributes = "";
        $this->maxskor_kelembagaan->HrefValue = "";
        $this->maxskor_kelembagaan->TooltipValue = "";

        // bobot_kelembagaan
        $this->bobot_kelembagaan->LinkCustomAttributes = "";
        $this->bobot_kelembagaan->HrefValue = "";
        $this->bobot_kelembagaan->TooltipValue = "";

        // skor_keuangan
        $this->skor_keuangan->LinkCustomAttributes = "";
        $this->skor_keuangan->HrefValue = "";
        $this->skor_keuangan->TooltipValue = "";

        // maxskor_keuangan
        $this->maxskor_keuangan->LinkCustomAttributes = "";
        $this->maxskor_keuangan->HrefValue = "";
        $this->maxskor_keuangan->TooltipValue = "";

        // bobot_keuangan
        $this->bobot_keuangan->LinkCustomAttributes = "";
        $this->bobot_keuangan->HrefValue = "";
        $this->bobot_keuangan->TooltipValue = "";

        // skor_sdm
        $this->skor_sdm->LinkCustomAttributes = "";
        $this->skor_sdm->HrefValue = "";
        $this->skor_sdm->TooltipValue = "";

        // maxskor_sdm
        $this->maxskor_sdm->LinkCustomAttributes = "";
        $this->maxskor_sdm->HrefValue = "";
        $this->maxskor_sdm->TooltipValue = "";

        // bobot_sdm
        $this->bobot_sdm->LinkCustomAttributes = "";
        $this->bobot_sdm->HrefValue = "";
        $this->bobot_sdm->TooltipValue = "";

        // skor_kelas
        $this->skor_kelas->LinkCustomAttributes = "";
        $this->skor_kelas->HrefValue = "";
        $this->skor_kelas->TooltipValue = "";

        // maxskor_kelas
        $this->maxskor_kelas->LinkCustomAttributes = "";
        $this->maxskor_kelas->HrefValue = "";
        $this->maxskor_kelas->TooltipValue = "";

        // kelas_umkm
        $this->kelas_umkm->LinkCustomAttributes = "";
        $this->kelas_umkm->HrefValue = "";
        $this->kelas_umkm->TooltipValue = "";

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
        $this->NIK->EditAttrs["class"] = "form-control";
        $this->NIK->EditCustomAttributes = "";
        if (!$this->NIK->Raw) {
            $this->NIK->CurrentValue = HtmlDecode($this->NIK->CurrentValue);
        }
        $this->NIK->EditValue = $this->NIK->CurrentValue;
        $this->NIK->PlaceHolder = RemoveHtml($this->NIK->caption());

        // NAMA_PEMILIK
        $this->NAMA_PEMILIK->EditAttrs["class"] = "form-control";
        $this->NAMA_PEMILIK->EditCustomAttributes = "";
        if (!$this->NAMA_PEMILIK->Raw) {
            $this->NAMA_PEMILIK->CurrentValue = HtmlDecode($this->NAMA_PEMILIK->CurrentValue);
        }
        $this->NAMA_PEMILIK->EditValue = $this->NAMA_PEMILIK->CurrentValue;
        $this->NAMA_PEMILIK->PlaceHolder = RemoveHtml($this->NAMA_PEMILIK->caption());

        // NO_HP
        $this->NO_HP->EditAttrs["class"] = "form-control";
        $this->NO_HP->EditCustomAttributes = "";
        if (!$this->NO_HP->Raw) {
            $this->NO_HP->CurrentValue = HtmlDecode($this->NO_HP->CurrentValue);
        }
        $this->NO_HP->EditValue = $this->NO_HP->CurrentValue;
        $this->NO_HP->PlaceHolder = RemoveHtml($this->NO_HP->caption());

        // NAMA_USAHA
        $this->NAMA_USAHA->EditAttrs["class"] = "form-control";
        $this->NAMA_USAHA->EditCustomAttributes = "";
        if (!$this->NAMA_USAHA->Raw) {
            $this->NAMA_USAHA->CurrentValue = HtmlDecode($this->NAMA_USAHA->CurrentValue);
        }
        $this->NAMA_USAHA->EditValue = $this->NAMA_USAHA->CurrentValue;
        $this->NAMA_USAHA->PlaceHolder = RemoveHtml($this->NAMA_USAHA->caption());

        // KALURAHAN
        $this->KALURAHAN->EditAttrs["class"] = "form-control";
        $this->KALURAHAN->EditCustomAttributes = "";
        if (!$this->KALURAHAN->Raw) {
            $this->KALURAHAN->CurrentValue = HtmlDecode($this->KALURAHAN->CurrentValue);
        }
        $this->KALURAHAN->EditValue = $this->KALURAHAN->CurrentValue;
        $this->KALURAHAN->PlaceHolder = RemoveHtml($this->KALURAHAN->caption());

        // KAPANEWON
        $this->KAPANEWON->EditAttrs["class"] = "form-control";
        $this->KAPANEWON->EditCustomAttributes = "";
        if (!$this->KAPANEWON->Raw) {
            $this->KAPANEWON->CurrentValue = HtmlDecode($this->KAPANEWON->CurrentValue);
        }
        $this->KAPANEWON->EditValue = $this->KAPANEWON->CurrentValue;
        $this->KAPANEWON->PlaceHolder = RemoveHtml($this->KAPANEWON->caption());

        // skor_produksi
        $this->skor_produksi->EditAttrs["class"] = "form-control";
        $this->skor_produksi->EditCustomAttributes = "";
        $this->skor_produksi->EditValue = $this->skor_produksi->CurrentValue;
        $this->skor_produksi->PlaceHolder = RemoveHtml($this->skor_produksi->caption());
        if (strval($this->skor_produksi->EditValue) != "" && is_numeric($this->skor_produksi->EditValue)) {
            $this->skor_produksi->EditValue = FormatNumber($this->skor_produksi->EditValue, -2, -2, -2, -2);
        }

        // maxskor_produksi
        $this->maxskor_produksi->EditAttrs["class"] = "form-control";
        $this->maxskor_produksi->EditCustomAttributes = "";
        $this->maxskor_produksi->EditValue = $this->maxskor_produksi->CurrentValue;
        $this->maxskor_produksi->PlaceHolder = RemoveHtml($this->maxskor_produksi->caption());
        if (strval($this->maxskor_produksi->EditValue) != "" && is_numeric($this->maxskor_produksi->EditValue)) {
            $this->maxskor_produksi->EditValue = FormatNumber($this->maxskor_produksi->EditValue, -2, -2, -2, -2);
        }

        // bobot_produksi
        $this->bobot_produksi->EditAttrs["class"] = "form-control";
        $this->bobot_produksi->EditCustomAttributes = "";
        $this->bobot_produksi->EditValue = $this->bobot_produksi->CurrentValue;
        $this->bobot_produksi->PlaceHolder = RemoveHtml($this->bobot_produksi->caption());

        // skor_pemasaran
        $this->skor_pemasaran->EditAttrs["class"] = "form-control";
        $this->skor_pemasaran->EditCustomAttributes = "";
        $this->skor_pemasaran->EditValue = $this->skor_pemasaran->CurrentValue;
        $this->skor_pemasaran->PlaceHolder = RemoveHtml($this->skor_pemasaran->caption());
        if (strval($this->skor_pemasaran->EditValue) != "" && is_numeric($this->skor_pemasaran->EditValue)) {
            $this->skor_pemasaran->EditValue = FormatNumber($this->skor_pemasaran->EditValue, -2, -2, -2, -2);
        }

        // maxskor_pemasaran
        $this->maxskor_pemasaran->EditAttrs["class"] = "form-control";
        $this->maxskor_pemasaran->EditCustomAttributes = "";
        $this->maxskor_pemasaran->EditValue = $this->maxskor_pemasaran->CurrentValue;
        $this->maxskor_pemasaran->PlaceHolder = RemoveHtml($this->maxskor_pemasaran->caption());
        if (strval($this->maxskor_pemasaran->EditValue) != "" && is_numeric($this->maxskor_pemasaran->EditValue)) {
            $this->maxskor_pemasaran->EditValue = FormatNumber($this->maxskor_pemasaran->EditValue, -2, -2, -2, -2);
        }

        // bobot_pemasaran
        $this->bobot_pemasaran->EditAttrs["class"] = "form-control";
        $this->bobot_pemasaran->EditCustomAttributes = "";
        $this->bobot_pemasaran->EditValue = $this->bobot_pemasaran->CurrentValue;
        $this->bobot_pemasaran->PlaceHolder = RemoveHtml($this->bobot_pemasaran->caption());

        // skor_pemasaranonline
        $this->skor_pemasaranonline->EditAttrs["class"] = "form-control";
        $this->skor_pemasaranonline->EditCustomAttributes = "";
        $this->skor_pemasaranonline->EditValue = $this->skor_pemasaranonline->CurrentValue;
        $this->skor_pemasaranonline->PlaceHolder = RemoveHtml($this->skor_pemasaranonline->caption());
        if (strval($this->skor_pemasaranonline->EditValue) != "" && is_numeric($this->skor_pemasaranonline->EditValue)) {
            $this->skor_pemasaranonline->EditValue = FormatNumber($this->skor_pemasaranonline->EditValue, -2, -2, -2, -2);
        }

        // maxskor_pemasaranonline
        $this->maxskor_pemasaranonline->EditAttrs["class"] = "form-control";
        $this->maxskor_pemasaranonline->EditCustomAttributes = "";
        $this->maxskor_pemasaranonline->EditValue = $this->maxskor_pemasaranonline->CurrentValue;
        $this->maxskor_pemasaranonline->PlaceHolder = RemoveHtml($this->maxskor_pemasaranonline->caption());
        if (strval($this->maxskor_pemasaranonline->EditValue) != "" && is_numeric($this->maxskor_pemasaranonline->EditValue)) {
            $this->maxskor_pemasaranonline->EditValue = FormatNumber($this->maxskor_pemasaranonline->EditValue, -2, -2, -2, -2);
        }

        // bobot_pemasaranonline
        $this->bobot_pemasaranonline->EditAttrs["class"] = "form-control";
        $this->bobot_pemasaranonline->EditCustomAttributes = "";
        $this->bobot_pemasaranonline->EditValue = $this->bobot_pemasaranonline->CurrentValue;
        $this->bobot_pemasaranonline->PlaceHolder = RemoveHtml($this->bobot_pemasaranonline->caption());

        // skor_kelembagaan
        $this->skor_kelembagaan->EditAttrs["class"] = "form-control";
        $this->skor_kelembagaan->EditCustomAttributes = "";
        $this->skor_kelembagaan->EditValue = $this->skor_kelembagaan->CurrentValue;
        $this->skor_kelembagaan->PlaceHolder = RemoveHtml($this->skor_kelembagaan->caption());
        if (strval($this->skor_kelembagaan->EditValue) != "" && is_numeric($this->skor_kelembagaan->EditValue)) {
            $this->skor_kelembagaan->EditValue = FormatNumber($this->skor_kelembagaan->EditValue, -2, -2, -2, -2);
        }

        // maxskor_kelembagaan
        $this->maxskor_kelembagaan->EditAttrs["class"] = "form-control";
        $this->maxskor_kelembagaan->EditCustomAttributes = "";
        $this->maxskor_kelembagaan->EditValue = $this->maxskor_kelembagaan->CurrentValue;
        $this->maxskor_kelembagaan->PlaceHolder = RemoveHtml($this->maxskor_kelembagaan->caption());
        if (strval($this->maxskor_kelembagaan->EditValue) != "" && is_numeric($this->maxskor_kelembagaan->EditValue)) {
            $this->maxskor_kelembagaan->EditValue = FormatNumber($this->maxskor_kelembagaan->EditValue, -2, -2, -2, -2);
        }

        // bobot_kelembagaan
        $this->bobot_kelembagaan->EditAttrs["class"] = "form-control";
        $this->bobot_kelembagaan->EditCustomAttributes = "";
        $this->bobot_kelembagaan->EditValue = $this->bobot_kelembagaan->CurrentValue;
        $this->bobot_kelembagaan->PlaceHolder = RemoveHtml($this->bobot_kelembagaan->caption());

        // skor_keuangan
        $this->skor_keuangan->EditAttrs["class"] = "form-control";
        $this->skor_keuangan->EditCustomAttributes = "";
        $this->skor_keuangan->EditValue = $this->skor_keuangan->CurrentValue;
        $this->skor_keuangan->PlaceHolder = RemoveHtml($this->skor_keuangan->caption());
        if (strval($this->skor_keuangan->EditValue) != "" && is_numeric($this->skor_keuangan->EditValue)) {
            $this->skor_keuangan->EditValue = FormatNumber($this->skor_keuangan->EditValue, -2, -2, -2, -2);
        }

        // maxskor_keuangan
        $this->maxskor_keuangan->EditAttrs["class"] = "form-control";
        $this->maxskor_keuangan->EditCustomAttributes = "";
        $this->maxskor_keuangan->EditValue = $this->maxskor_keuangan->CurrentValue;
        $this->maxskor_keuangan->PlaceHolder = RemoveHtml($this->maxskor_keuangan->caption());
        if (strval($this->maxskor_keuangan->EditValue) != "" && is_numeric($this->maxskor_keuangan->EditValue)) {
            $this->maxskor_keuangan->EditValue = FormatNumber($this->maxskor_keuangan->EditValue, -2, -2, -2, -2);
        }

        // bobot_keuangan
        $this->bobot_keuangan->EditAttrs["class"] = "form-control";
        $this->bobot_keuangan->EditCustomAttributes = "";
        $this->bobot_keuangan->EditValue = $this->bobot_keuangan->CurrentValue;
        $this->bobot_keuangan->PlaceHolder = RemoveHtml($this->bobot_keuangan->caption());

        // skor_sdm
        $this->skor_sdm->EditAttrs["class"] = "form-control";
        $this->skor_sdm->EditCustomAttributes = "";
        $this->skor_sdm->EditValue = $this->skor_sdm->CurrentValue;
        $this->skor_sdm->PlaceHolder = RemoveHtml($this->skor_sdm->caption());
        if (strval($this->skor_sdm->EditValue) != "" && is_numeric($this->skor_sdm->EditValue)) {
            $this->skor_sdm->EditValue = FormatNumber($this->skor_sdm->EditValue, -2, -2, -2, -2);
        }

        // maxskor_sdm
        $this->maxskor_sdm->EditAttrs["class"] = "form-control";
        $this->maxskor_sdm->EditCustomAttributes = "";
        $this->maxskor_sdm->EditValue = $this->maxskor_sdm->CurrentValue;
        $this->maxskor_sdm->PlaceHolder = RemoveHtml($this->maxskor_sdm->caption());
        if (strval($this->maxskor_sdm->EditValue) != "" && is_numeric($this->maxskor_sdm->EditValue)) {
            $this->maxskor_sdm->EditValue = FormatNumber($this->maxskor_sdm->EditValue, -2, -2, -2, -2);
        }

        // bobot_sdm
        $this->bobot_sdm->EditAttrs["class"] = "form-control";
        $this->bobot_sdm->EditCustomAttributes = "";
        $this->bobot_sdm->EditValue = $this->bobot_sdm->CurrentValue;
        $this->bobot_sdm->PlaceHolder = RemoveHtml($this->bobot_sdm->caption());

        // skor_kelas
        $this->skor_kelas->EditAttrs["class"] = "form-control";
        $this->skor_kelas->EditCustomAttributes = "";
        $this->skor_kelas->EditValue = $this->skor_kelas->CurrentValue;
        $this->skor_kelas->PlaceHolder = RemoveHtml($this->skor_kelas->caption());
        if (strval($this->skor_kelas->EditValue) != "" && is_numeric($this->skor_kelas->EditValue)) {
            $this->skor_kelas->EditValue = FormatNumber($this->skor_kelas->EditValue, -2, -2, -2, -2);
        }

        // maxskor_kelas
        $this->maxskor_kelas->EditAttrs["class"] = "form-control";
        $this->maxskor_kelas->EditCustomAttributes = "";
        $this->maxskor_kelas->EditValue = $this->maxskor_kelas->CurrentValue;
        $this->maxskor_kelas->PlaceHolder = RemoveHtml($this->maxskor_kelas->caption());
        if (strval($this->maxskor_kelas->EditValue) != "" && is_numeric($this->maxskor_kelas->EditValue)) {
            $this->maxskor_kelas->EditValue = FormatNumber($this->maxskor_kelas->EditValue, -2, -2, -2, -2);
        }

        // kelas_umkm
        $this->kelas_umkm->EditAttrs["class"] = "form-control";
        $this->kelas_umkm->EditCustomAttributes = "";
        if (!$this->kelas_umkm->Raw) {
            $this->kelas_umkm->CurrentValue = HtmlDecode($this->kelas_umkm->CurrentValue);
        }
        $this->kelas_umkm->EditValue = $this->kelas_umkm->CurrentValue;
        $this->kelas_umkm->PlaceHolder = RemoveHtml($this->kelas_umkm->caption());

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
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->skor_produksi);
                    $doc->exportCaption($this->maxskor_produksi);
                    $doc->exportCaption($this->bobot_produksi);
                    $doc->exportCaption($this->skor_pemasaran);
                    $doc->exportCaption($this->maxskor_pemasaran);
                    $doc->exportCaption($this->bobot_pemasaran);
                    $doc->exportCaption($this->skor_pemasaranonline);
                    $doc->exportCaption($this->maxskor_pemasaranonline);
                    $doc->exportCaption($this->bobot_pemasaranonline);
                    $doc->exportCaption($this->skor_kelembagaan);
                    $doc->exportCaption($this->maxskor_kelembagaan);
                    $doc->exportCaption($this->bobot_kelembagaan);
                    $doc->exportCaption($this->skor_keuangan);
                    $doc->exportCaption($this->maxskor_keuangan);
                    $doc->exportCaption($this->bobot_keuangan);
                    $doc->exportCaption($this->skor_sdm);
                    $doc->exportCaption($this->maxskor_sdm);
                    $doc->exportCaption($this->bobot_sdm);
                    $doc->exportCaption($this->skor_kelas);
                    $doc->exportCaption($this->maxskor_kelas);
                    $doc->exportCaption($this->kelas_umkm);
                } else {
                    $doc->exportCaption($this->NIK);
                    $doc->exportCaption($this->NAMA_PEMILIK);
                    $doc->exportCaption($this->NO_HP);
                    $doc->exportCaption($this->NAMA_USAHA);
                    $doc->exportCaption($this->KALURAHAN);
                    $doc->exportCaption($this->KAPANEWON);
                    $doc->exportCaption($this->skor_produksi);
                    $doc->exportCaption($this->maxskor_produksi);
                    $doc->exportCaption($this->bobot_produksi);
                    $doc->exportCaption($this->skor_pemasaran);
                    $doc->exportCaption($this->maxskor_pemasaran);
                    $doc->exportCaption($this->bobot_pemasaran);
                    $doc->exportCaption($this->skor_pemasaranonline);
                    $doc->exportCaption($this->maxskor_pemasaranonline);
                    $doc->exportCaption($this->bobot_pemasaranonline);
                    $doc->exportCaption($this->skor_kelembagaan);
                    $doc->exportCaption($this->maxskor_kelembagaan);
                    $doc->exportCaption($this->bobot_kelembagaan);
                    $doc->exportCaption($this->skor_keuangan);
                    $doc->exportCaption($this->maxskor_keuangan);
                    $doc->exportCaption($this->bobot_keuangan);
                    $doc->exportCaption($this->skor_sdm);
                    $doc->exportCaption($this->maxskor_sdm);
                    $doc->exportCaption($this->bobot_sdm);
                    $doc->exportCaption($this->skor_kelas);
                    $doc->exportCaption($this->maxskor_kelas);
                    $doc->exportCaption($this->kelas_umkm);
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
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->skor_produksi);
                        $doc->exportField($this->maxskor_produksi);
                        $doc->exportField($this->bobot_produksi);
                        $doc->exportField($this->skor_pemasaran);
                        $doc->exportField($this->maxskor_pemasaran);
                        $doc->exportField($this->bobot_pemasaran);
                        $doc->exportField($this->skor_pemasaranonline);
                        $doc->exportField($this->maxskor_pemasaranonline);
                        $doc->exportField($this->bobot_pemasaranonline);
                        $doc->exportField($this->skor_kelembagaan);
                        $doc->exportField($this->maxskor_kelembagaan);
                        $doc->exportField($this->bobot_kelembagaan);
                        $doc->exportField($this->skor_keuangan);
                        $doc->exportField($this->maxskor_keuangan);
                        $doc->exportField($this->bobot_keuangan);
                        $doc->exportField($this->skor_sdm);
                        $doc->exportField($this->maxskor_sdm);
                        $doc->exportField($this->bobot_sdm);
                        $doc->exportField($this->skor_kelas);
                        $doc->exportField($this->maxskor_kelas);
                        $doc->exportField($this->kelas_umkm);
                    } else {
                        $doc->exportField($this->NIK);
                        $doc->exportField($this->NAMA_PEMILIK);
                        $doc->exportField($this->NO_HP);
                        $doc->exportField($this->NAMA_USAHA);
                        $doc->exportField($this->KALURAHAN);
                        $doc->exportField($this->KAPANEWON);
                        $doc->exportField($this->skor_produksi);
                        $doc->exportField($this->maxskor_produksi);
                        $doc->exportField($this->bobot_produksi);
                        $doc->exportField($this->skor_pemasaran);
                        $doc->exportField($this->maxskor_pemasaran);
                        $doc->exportField($this->bobot_pemasaran);
                        $doc->exportField($this->skor_pemasaranonline);
                        $doc->exportField($this->maxskor_pemasaranonline);
                        $doc->exportField($this->bobot_pemasaranonline);
                        $doc->exportField($this->skor_kelembagaan);
                        $doc->exportField($this->maxskor_kelembagaan);
                        $doc->exportField($this->bobot_kelembagaan);
                        $doc->exportField($this->skor_keuangan);
                        $doc->exportField($this->maxskor_keuangan);
                        $doc->exportField($this->bobot_keuangan);
                        $doc->exportField($this->skor_sdm);
                        $doc->exportField($this->maxskor_sdm);
                        $doc->exportField($this->bobot_sdm);
                        $doc->exportField($this->skor_kelas);
                        $doc->exportField($this->maxskor_kelas);
                        $doc->exportField($this->kelas_umkm);
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
