<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for temp_skor_pemasaran
 */
class TempSkorPemasaran extends DbTable
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
    public $skor_unggul;
    public $max_unggul;
    public $skor_target;
    public $max_target;
    public $skor_available;
    public $max_available;
    public $skor_merk;
    public $max_merk;
    public $skor_merkhaki;
    public $max_merkhaki;
    public $skor_merkkonsep;
    public $max_merkkonsep;
    public $skor_merklisensi;
    public $max_merklisensi;
    public $skor_mitra;
    public $max_mitra;
    public $skor_market;
    public $max_market;
    public $skor_pelangganloyal;
    public $max_pelangganloyal;
    public $skor_pameranmandiri;
    public $max_pameranmandiri;
    public $skor_mediaoffline;
    public $max_mediaoffline;
    public $skor_pemasaran;
    public $maxskor_pemasaran;
    public $bobot_pemasaran;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'temp_skor_pemasaran';
        $this->TableName = 'temp_skor_pemasaran';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`temp_skor_pemasaran`";
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
        $this->nik = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_nik', 'nik', '`nik`', '`nik`', 200, 16, -1, false, '`nik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik->IsPrimaryKey = true; // Primary key field
        $this->nik->Nullable = false; // NOT NULL field
        $this->nik->Required = true; // Required field
        $this->nik->Sortable = true; // Allow sort
        $this->nik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik->Param, "CustomMsg");
        $this->Fields['nik'] = &$this->nik;

        // skor_unggul
        $this->skor_unggul = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_unggul', 'skor_unggul', '`skor_unggul`', '`skor_unggul`', 5, 23, -1, false, '`skor_unggul`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_unggul->Sortable = true; // Allow sort
        $this->skor_unggul->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_unggul->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_unggul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_unggul->Param, "CustomMsg");
        $this->Fields['skor_unggul'] = &$this->skor_unggul;

        // max_unggul
        $this->max_unggul = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_unggul', 'max_unggul', '`max_unggul`', '`max_unggul`', 5, 23, -1, false, '`max_unggul`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_unggul->Sortable = true; // Allow sort
        $this->max_unggul->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_unggul->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_unggul->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_unggul->Param, "CustomMsg");
        $this->Fields['max_unggul'] = &$this->max_unggul;

        // skor_target
        $this->skor_target = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_target', 'skor_target', '`skor_target`', '`skor_target`', 5, 23, -1, false, '`skor_target`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_target->Sortable = true; // Allow sort
        $this->skor_target->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_target->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_target->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_target->Param, "CustomMsg");
        $this->Fields['skor_target'] = &$this->skor_target;

        // max_target
        $this->max_target = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_target', 'max_target', '`max_target`', '`max_target`', 5, 23, -1, false, '`max_target`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_target->Sortable = true; // Allow sort
        $this->max_target->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_target->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_target->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_target->Param, "CustomMsg");
        $this->Fields['max_target'] = &$this->max_target;

        // skor_available
        $this->skor_available = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_available', 'skor_available', '`skor_available`', '`skor_available`', 5, 23, -1, false, '`skor_available`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_available->Sortable = true; // Allow sort
        $this->skor_available->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_available->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_available->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_available->Param, "CustomMsg");
        $this->Fields['skor_available'] = &$this->skor_available;

        // max_available
        $this->max_available = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_available', 'max_available', '`max_available`', '`max_available`', 5, 23, -1, false, '`max_available`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_available->Sortable = true; // Allow sort
        $this->max_available->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_available->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_available->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_available->Param, "CustomMsg");
        $this->Fields['max_available'] = &$this->max_available;

        // skor_merk
        $this->skor_merk = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_merk', 'skor_merk', '`skor_merk`', '`skor_merk`', 5, 23, -1, false, '`skor_merk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_merk->Sortable = true; // Allow sort
        $this->skor_merk->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_merk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_merk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_merk->Param, "CustomMsg");
        $this->Fields['skor_merk'] = &$this->skor_merk;

        // max_merk
        $this->max_merk = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_merk', 'max_merk', '`max_merk`', '`max_merk`', 5, 23, -1, false, '`max_merk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_merk->Sortable = true; // Allow sort
        $this->max_merk->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_merk->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_merk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_merk->Param, "CustomMsg");
        $this->Fields['max_merk'] = &$this->max_merk;

        // skor_merkhaki
        $this->skor_merkhaki = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_merkhaki', 'skor_merkhaki', '`skor_merkhaki`', '`skor_merkhaki`', 5, 23, -1, false, '`skor_merkhaki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_merkhaki->Sortable = true; // Allow sort
        $this->skor_merkhaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_merkhaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_merkhaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_merkhaki->Param, "CustomMsg");
        $this->Fields['skor_merkhaki'] = &$this->skor_merkhaki;

        // max_merkhaki
        $this->max_merkhaki = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_merkhaki', 'max_merkhaki', '`max_merkhaki`', '`max_merkhaki`', 5, 23, -1, false, '`max_merkhaki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_merkhaki->Sortable = true; // Allow sort
        $this->max_merkhaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_merkhaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_merkhaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_merkhaki->Param, "CustomMsg");
        $this->Fields['max_merkhaki'] = &$this->max_merkhaki;

        // skor_merkkonsep
        $this->skor_merkkonsep = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_merkkonsep', 'skor_merkkonsep', '`skor_merkkonsep`', '`skor_merkkonsep`', 5, 23, -1, false, '`skor_merkkonsep`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_merkkonsep->Sortable = true; // Allow sort
        $this->skor_merkkonsep->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_merkkonsep->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_merkkonsep->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_merkkonsep->Param, "CustomMsg");
        $this->Fields['skor_merkkonsep'] = &$this->skor_merkkonsep;

        // max_merkkonsep
        $this->max_merkkonsep = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_merkkonsep', 'max_merkkonsep', '`max_merkkonsep`', '`max_merkkonsep`', 5, 23, -1, false, '`max_merkkonsep`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_merkkonsep->Sortable = true; // Allow sort
        $this->max_merkkonsep->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_merkkonsep->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_merkkonsep->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_merkkonsep->Param, "CustomMsg");
        $this->Fields['max_merkkonsep'] = &$this->max_merkkonsep;

        // skor_merklisensi
        $this->skor_merklisensi = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_merklisensi', 'skor_merklisensi', '`skor_merklisensi`', '`skor_merklisensi`', 5, 23, -1, false, '`skor_merklisensi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_merklisensi->Sortable = true; // Allow sort
        $this->skor_merklisensi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_merklisensi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_merklisensi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_merklisensi->Param, "CustomMsg");
        $this->Fields['skor_merklisensi'] = &$this->skor_merklisensi;

        // max_merklisensi
        $this->max_merklisensi = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_merklisensi', 'max_merklisensi', '`max_merklisensi`', '`max_merklisensi`', 5, 23, -1, false, '`max_merklisensi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_merklisensi->Sortable = true; // Allow sort
        $this->max_merklisensi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_merklisensi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_merklisensi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_merklisensi->Param, "CustomMsg");
        $this->Fields['max_merklisensi'] = &$this->max_merklisensi;

        // skor_mitra
        $this->skor_mitra = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_mitra', 'skor_mitra', '`skor_mitra`', '`skor_mitra`', 5, 23, -1, false, '`skor_mitra`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_mitra->Sortable = true; // Allow sort
        $this->skor_mitra->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_mitra->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_mitra->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_mitra->Param, "CustomMsg");
        $this->Fields['skor_mitra'] = &$this->skor_mitra;

        // max_mitra
        $this->max_mitra = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_mitra', 'max_mitra', '`max_mitra`', '`max_mitra`', 5, 23, -1, false, '`max_mitra`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_mitra->Sortable = true; // Allow sort
        $this->max_mitra->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_mitra->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_mitra->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_mitra->Param, "CustomMsg");
        $this->Fields['max_mitra'] = &$this->max_mitra;

        // skor_market
        $this->skor_market = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_market', 'skor_market', '`skor_market`', '`skor_market`', 5, 23, -1, false, '`skor_market`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_market->Sortable = true; // Allow sort
        $this->skor_market->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_market->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_market->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_market->Param, "CustomMsg");
        $this->Fields['skor_market'] = &$this->skor_market;

        // max_market
        $this->max_market = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_market', 'max_market', '`max_market`', '`max_market`', 5, 23, -1, false, '`max_market`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_market->Sortable = true; // Allow sort
        $this->max_market->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_market->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_market->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_market->Param, "CustomMsg");
        $this->Fields['max_market'] = &$this->max_market;

        // skor_pelangganloyal
        $this->skor_pelangganloyal = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_pelangganloyal', 'skor_pelangganloyal', '`skor_pelangganloyal`', '`skor_pelangganloyal`', 5, 23, -1, false, '`skor_pelangganloyal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pelangganloyal->Sortable = true; // Allow sort
        $this->skor_pelangganloyal->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pelangganloyal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pelangganloyal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pelangganloyal->Param, "CustomMsg");
        $this->Fields['skor_pelangganloyal'] = &$this->skor_pelangganloyal;

        // max_pelangganloyal
        $this->max_pelangganloyal = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_pelangganloyal', 'max_pelangganloyal', '`max_pelangganloyal`', '`max_pelangganloyal`', 5, 23, -1, false, '`max_pelangganloyal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_pelangganloyal->Sortable = true; // Allow sort
        $this->max_pelangganloyal->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_pelangganloyal->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_pelangganloyal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_pelangganloyal->Param, "CustomMsg");
        $this->Fields['max_pelangganloyal'] = &$this->max_pelangganloyal;

        // skor_pameranmandiri
        $this->skor_pameranmandiri = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_pameranmandiri', 'skor_pameranmandiri', '`skor_pameranmandiri`', '`skor_pameranmandiri`', 5, 23, -1, false, '`skor_pameranmandiri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pameranmandiri->Sortable = true; // Allow sort
        $this->skor_pameranmandiri->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pameranmandiri->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pameranmandiri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pameranmandiri->Param, "CustomMsg");
        $this->Fields['skor_pameranmandiri'] = &$this->skor_pameranmandiri;

        // max_pameranmandiri
        $this->max_pameranmandiri = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_pameranmandiri', 'max_pameranmandiri', '`max_pameranmandiri`', '`max_pameranmandiri`', 5, 23, -1, false, '`max_pameranmandiri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_pameranmandiri->Sortable = true; // Allow sort
        $this->max_pameranmandiri->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_pameranmandiri->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_pameranmandiri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_pameranmandiri->Param, "CustomMsg");
        $this->Fields['max_pameranmandiri'] = &$this->max_pameranmandiri;

        // skor_mediaoffline
        $this->skor_mediaoffline = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_mediaoffline', 'skor_mediaoffline', '`skor_mediaoffline`', '`skor_mediaoffline`', 5, 23, -1, false, '`skor_mediaoffline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_mediaoffline->Sortable = true; // Allow sort
        $this->skor_mediaoffline->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_mediaoffline->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_mediaoffline->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_mediaoffline->Param, "CustomMsg");
        $this->Fields['skor_mediaoffline'] = &$this->skor_mediaoffline;

        // max_mediaoffline
        $this->max_mediaoffline = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_max_mediaoffline', 'max_mediaoffline', '`max_mediaoffline`', '`max_mediaoffline`', 5, 23, -1, false, '`max_mediaoffline`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->max_mediaoffline->Sortable = true; // Allow sort
        $this->max_mediaoffline->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->max_mediaoffline->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->max_mediaoffline->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->max_mediaoffline->Param, "CustomMsg");
        $this->Fields['max_mediaoffline'] = &$this->max_mediaoffline;

        // skor_pemasaran
        $this->skor_pemasaran = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_skor_pemasaran', 'skor_pemasaran', '`skor_pemasaran`', '`skor_pemasaran`', 5, 23, -1, false, '`skor_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->skor_pemasaran->Sortable = true; // Allow sort
        $this->skor_pemasaran->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->skor_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->skor_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->skor_pemasaran->Param, "CustomMsg");
        $this->Fields['skor_pemasaran'] = &$this->skor_pemasaran;

        // maxskor_pemasaran
        $this->maxskor_pemasaran = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_maxskor_pemasaran', 'maxskor_pemasaran', '`maxskor_pemasaran`', '`maxskor_pemasaran`', 5, 23, -1, false, '`maxskor_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->maxskor_pemasaran->Sortable = true; // Allow sort
        $this->maxskor_pemasaran->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->maxskor_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->maxskor_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->maxskor_pemasaran->Param, "CustomMsg");
        $this->Fields['maxskor_pemasaran'] = &$this->maxskor_pemasaran;

        // bobot_pemasaran
        $this->bobot_pemasaran = new DbField('temp_skor_pemasaran', 'temp_skor_pemasaran', 'x_bobot_pemasaran', 'bobot_pemasaran', '`bobot_pemasaran`', '`bobot_pemasaran`', 3, 2, -1, false, '`bobot_pemasaran`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->bobot_pemasaran->Nullable = false; // NOT NULL field
        $this->bobot_pemasaran->Required = true; // Required field
        $this->bobot_pemasaran->Sortable = true; // Allow sort
        $this->bobot_pemasaran->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->bobot_pemasaran->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->bobot_pemasaran->Param, "CustomMsg");
        $this->Fields['bobot_pemasaran'] = &$this->bobot_pemasaran;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`temp_skor_pemasaran`";
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
            if (array_key_exists('nik', $rs)) {
                AddFilter($where, QuotedName('nik', $this->Dbid) . '=' . QuotedValue($rs['nik'], $this->nik->DataType, $this->Dbid));
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
        $this->nik->DbValue = $row['nik'];
        $this->skor_unggul->DbValue = $row['skor_unggul'];
        $this->max_unggul->DbValue = $row['max_unggul'];
        $this->skor_target->DbValue = $row['skor_target'];
        $this->max_target->DbValue = $row['max_target'];
        $this->skor_available->DbValue = $row['skor_available'];
        $this->max_available->DbValue = $row['max_available'];
        $this->skor_merk->DbValue = $row['skor_merk'];
        $this->max_merk->DbValue = $row['max_merk'];
        $this->skor_merkhaki->DbValue = $row['skor_merkhaki'];
        $this->max_merkhaki->DbValue = $row['max_merkhaki'];
        $this->skor_merkkonsep->DbValue = $row['skor_merkkonsep'];
        $this->max_merkkonsep->DbValue = $row['max_merkkonsep'];
        $this->skor_merklisensi->DbValue = $row['skor_merklisensi'];
        $this->max_merklisensi->DbValue = $row['max_merklisensi'];
        $this->skor_mitra->DbValue = $row['skor_mitra'];
        $this->max_mitra->DbValue = $row['max_mitra'];
        $this->skor_market->DbValue = $row['skor_market'];
        $this->max_market->DbValue = $row['max_market'];
        $this->skor_pelangganloyal->DbValue = $row['skor_pelangganloyal'];
        $this->max_pelangganloyal->DbValue = $row['max_pelangganloyal'];
        $this->skor_pameranmandiri->DbValue = $row['skor_pameranmandiri'];
        $this->max_pameranmandiri->DbValue = $row['max_pameranmandiri'];
        $this->skor_mediaoffline->DbValue = $row['skor_mediaoffline'];
        $this->max_mediaoffline->DbValue = $row['max_mediaoffline'];
        $this->skor_pemasaran->DbValue = $row['skor_pemasaran'];
        $this->maxskor_pemasaran->DbValue = $row['maxskor_pemasaran'];
        $this->bobot_pemasaran->DbValue = $row['bobot_pemasaran'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
    }

    // Record filter WHERE clause
    protected function sqlKeyFilter()
    {
        return "`nik` = '@nik@'";
    }

    // Get Key
    public function getKey($current = false)
    {
        $keys = [];
        $val = $current ? $this->nik->CurrentValue : $this->nik->OldValue;
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
                $this->nik->CurrentValue = $keys[0];
            } else {
                $this->nik->OldValue = $keys[0];
            }
        }
    }

    // Get record filter
    public function getRecordFilter($row = null)
    {
        $keyFilter = $this->sqlKeyFilter();
        if (is_array($row)) {
            $val = array_key_exists('nik', $row) ? $row['nik'] : null;
        } else {
            $val = $this->nik->OldValue !== null ? $this->nik->OldValue : $this->nik->CurrentValue;
        }
        if ($val === null) {
            return "0=1"; // Invalid key
        } else {
            $keyFilter = str_replace("@nik@", AdjustSql($val, $this->Dbid), $keyFilter); // Replace key value
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
        return $_SESSION[$name] ?? GetUrl("tempskorpemasaranlist");
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
        if ($pageName == "tempskorpemasaranview") {
            return $Language->phrase("View");
        } elseif ($pageName == "tempskorpemasaranedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "tempskorpemasaranadd") {
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
                return "TempSkorPemasaranView";
            case Config("API_ADD_ACTION"):
                return "TempSkorPemasaranAdd";
            case Config("API_EDIT_ACTION"):
                return "TempSkorPemasaranEdit";
            case Config("API_DELETE_ACTION"):
                return "TempSkorPemasaranDelete";
            case Config("API_LIST_ACTION"):
                return "TempSkorPemasaranList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "tempskorpemasaranlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("tempskorpemasaranview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("tempskorpemasaranview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "tempskorpemasaranadd?" . $this->getUrlParm($parm);
        } else {
            $url = "tempskorpemasaranadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("tempskorpemasaranedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("tempskorpemasaranadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("tempskorpemasarandelete", $this->getUrlParm());
    }

    // Add master url
    public function addMasterUrl($url)
    {
        return $url;
    }

    public function keyToJson($htmlEncode = false)
    {
        $json = "";
        $json .= "nik:" . JsonEncode($this->nik->CurrentValue, "string");
        $json = "{" . $json . "}";
        if ($htmlEncode) {
            $json = HtmlEncode($json);
        }
        return $json;
    }

    // Add key value to URL
    public function keyUrl($url, $parm = "")
    {
        if ($this->nik->CurrentValue !== null) {
            $url .= "/" . rawurlencode($this->nik->CurrentValue);
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
            if (($keyValue = Param("nik") ?? Route("nik")) !== null) {
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
                $this->nik->CurrentValue = $key;
            } else {
                $this->nik->OldValue = $key;
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
        $this->skor_unggul->setDbValue($row['skor_unggul']);
        $this->max_unggul->setDbValue($row['max_unggul']);
        $this->skor_target->setDbValue($row['skor_target']);
        $this->max_target->setDbValue($row['max_target']);
        $this->skor_available->setDbValue($row['skor_available']);
        $this->max_available->setDbValue($row['max_available']);
        $this->skor_merk->setDbValue($row['skor_merk']);
        $this->max_merk->setDbValue($row['max_merk']);
        $this->skor_merkhaki->setDbValue($row['skor_merkhaki']);
        $this->max_merkhaki->setDbValue($row['max_merkhaki']);
        $this->skor_merkkonsep->setDbValue($row['skor_merkkonsep']);
        $this->max_merkkonsep->setDbValue($row['max_merkkonsep']);
        $this->skor_merklisensi->setDbValue($row['skor_merklisensi']);
        $this->max_merklisensi->setDbValue($row['max_merklisensi']);
        $this->skor_mitra->setDbValue($row['skor_mitra']);
        $this->max_mitra->setDbValue($row['max_mitra']);
        $this->skor_market->setDbValue($row['skor_market']);
        $this->max_market->setDbValue($row['max_market']);
        $this->skor_pelangganloyal->setDbValue($row['skor_pelangganloyal']);
        $this->max_pelangganloyal->setDbValue($row['max_pelangganloyal']);
        $this->skor_pameranmandiri->setDbValue($row['skor_pameranmandiri']);
        $this->max_pameranmandiri->setDbValue($row['max_pameranmandiri']);
        $this->skor_mediaoffline->setDbValue($row['skor_mediaoffline']);
        $this->max_mediaoffline->setDbValue($row['max_mediaoffline']);
        $this->skor_pemasaran->setDbValue($row['skor_pemasaran']);
        $this->maxskor_pemasaran->setDbValue($row['maxskor_pemasaran']);
        $this->bobot_pemasaran->setDbValue($row['bobot_pemasaran']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // nik

        // skor_unggul

        // max_unggul

        // skor_target

        // max_target

        // skor_available

        // max_available

        // skor_merk

        // max_merk

        // skor_merkhaki

        // max_merkhaki

        // skor_merkkonsep

        // max_merkkonsep

        // skor_merklisensi

        // max_merklisensi

        // skor_mitra

        // max_mitra

        // skor_market

        // max_market

        // skor_pelangganloyal

        // max_pelangganloyal

        // skor_pameranmandiri

        // max_pameranmandiri

        // skor_mediaoffline

        // max_mediaoffline

        // skor_pemasaran

        // maxskor_pemasaran

        // bobot_pemasaran

        // nik
        $this->nik->ViewValue = $this->nik->CurrentValue;
        $this->nik->ViewCustomAttributes = "";

        // skor_unggul
        $this->skor_unggul->ViewValue = $this->skor_unggul->CurrentValue;
        $this->skor_unggul->ViewValue = FormatNumber($this->skor_unggul->ViewValue, 2, -2, -2, -2);
        $this->skor_unggul->ViewCustomAttributes = "";

        // max_unggul
        $this->max_unggul->ViewValue = $this->max_unggul->CurrentValue;
        $this->max_unggul->ViewValue = FormatNumber($this->max_unggul->ViewValue, 2, -2, -2, -2);
        $this->max_unggul->ViewCustomAttributes = "";

        // skor_target
        $this->skor_target->ViewValue = $this->skor_target->CurrentValue;
        $this->skor_target->ViewValue = FormatNumber($this->skor_target->ViewValue, 2, -2, -2, -2);
        $this->skor_target->ViewCustomAttributes = "";

        // max_target
        $this->max_target->ViewValue = $this->max_target->CurrentValue;
        $this->max_target->ViewValue = FormatNumber($this->max_target->ViewValue, 2, -2, -2, -2);
        $this->max_target->ViewCustomAttributes = "";

        // skor_available
        $this->skor_available->ViewValue = $this->skor_available->CurrentValue;
        $this->skor_available->ViewValue = FormatNumber($this->skor_available->ViewValue, 2, -2, -2, -2);
        $this->skor_available->ViewCustomAttributes = "";

        // max_available
        $this->max_available->ViewValue = $this->max_available->CurrentValue;
        $this->max_available->ViewValue = FormatNumber($this->max_available->ViewValue, 2, -2, -2, -2);
        $this->max_available->ViewCustomAttributes = "";

        // skor_merk
        $this->skor_merk->ViewValue = $this->skor_merk->CurrentValue;
        $this->skor_merk->ViewValue = FormatNumber($this->skor_merk->ViewValue, 2, -2, -2, -2);
        $this->skor_merk->ViewCustomAttributes = "";

        // max_merk
        $this->max_merk->ViewValue = $this->max_merk->CurrentValue;
        $this->max_merk->ViewValue = FormatNumber($this->max_merk->ViewValue, 2, -2, -2, -2);
        $this->max_merk->ViewCustomAttributes = "";

        // skor_merkhaki
        $this->skor_merkhaki->ViewValue = $this->skor_merkhaki->CurrentValue;
        $this->skor_merkhaki->ViewValue = FormatNumber($this->skor_merkhaki->ViewValue, 2, -2, -2, -2);
        $this->skor_merkhaki->ViewCustomAttributes = "";

        // max_merkhaki
        $this->max_merkhaki->ViewValue = $this->max_merkhaki->CurrentValue;
        $this->max_merkhaki->ViewValue = FormatNumber($this->max_merkhaki->ViewValue, 2, -2, -2, -2);
        $this->max_merkhaki->ViewCustomAttributes = "";

        // skor_merkkonsep
        $this->skor_merkkonsep->ViewValue = $this->skor_merkkonsep->CurrentValue;
        $this->skor_merkkonsep->ViewValue = FormatNumber($this->skor_merkkonsep->ViewValue, 2, -2, -2, -2);
        $this->skor_merkkonsep->ViewCustomAttributes = "";

        // max_merkkonsep
        $this->max_merkkonsep->ViewValue = $this->max_merkkonsep->CurrentValue;
        $this->max_merkkonsep->ViewValue = FormatNumber($this->max_merkkonsep->ViewValue, 2, -2, -2, -2);
        $this->max_merkkonsep->ViewCustomAttributes = "";

        // skor_merklisensi
        $this->skor_merklisensi->ViewValue = $this->skor_merklisensi->CurrentValue;
        $this->skor_merklisensi->ViewValue = FormatNumber($this->skor_merklisensi->ViewValue, 2, -2, -2, -2);
        $this->skor_merklisensi->ViewCustomAttributes = "";

        // max_merklisensi
        $this->max_merklisensi->ViewValue = $this->max_merklisensi->CurrentValue;
        $this->max_merklisensi->ViewValue = FormatNumber($this->max_merklisensi->ViewValue, 2, -2, -2, -2);
        $this->max_merklisensi->ViewCustomAttributes = "";

        // skor_mitra
        $this->skor_mitra->ViewValue = $this->skor_mitra->CurrentValue;
        $this->skor_mitra->ViewValue = FormatNumber($this->skor_mitra->ViewValue, 2, -2, -2, -2);
        $this->skor_mitra->ViewCustomAttributes = "";

        // max_mitra
        $this->max_mitra->ViewValue = $this->max_mitra->CurrentValue;
        $this->max_mitra->ViewValue = FormatNumber($this->max_mitra->ViewValue, 2, -2, -2, -2);
        $this->max_mitra->ViewCustomAttributes = "";

        // skor_market
        $this->skor_market->ViewValue = $this->skor_market->CurrentValue;
        $this->skor_market->ViewValue = FormatNumber($this->skor_market->ViewValue, 2, -2, -2, -2);
        $this->skor_market->ViewCustomAttributes = "";

        // max_market
        $this->max_market->ViewValue = $this->max_market->CurrentValue;
        $this->max_market->ViewValue = FormatNumber($this->max_market->ViewValue, 2, -2, -2, -2);
        $this->max_market->ViewCustomAttributes = "";

        // skor_pelangganloyal
        $this->skor_pelangganloyal->ViewValue = $this->skor_pelangganloyal->CurrentValue;
        $this->skor_pelangganloyal->ViewValue = FormatNumber($this->skor_pelangganloyal->ViewValue, 2, -2, -2, -2);
        $this->skor_pelangganloyal->ViewCustomAttributes = "";

        // max_pelangganloyal
        $this->max_pelangganloyal->ViewValue = $this->max_pelangganloyal->CurrentValue;
        $this->max_pelangganloyal->ViewValue = FormatNumber($this->max_pelangganloyal->ViewValue, 2, -2, -2, -2);
        $this->max_pelangganloyal->ViewCustomAttributes = "";

        // skor_pameranmandiri
        $this->skor_pameranmandiri->ViewValue = $this->skor_pameranmandiri->CurrentValue;
        $this->skor_pameranmandiri->ViewValue = FormatNumber($this->skor_pameranmandiri->ViewValue, 2, -2, -2, -2);
        $this->skor_pameranmandiri->ViewCustomAttributes = "";

        // max_pameranmandiri
        $this->max_pameranmandiri->ViewValue = $this->max_pameranmandiri->CurrentValue;
        $this->max_pameranmandiri->ViewValue = FormatNumber($this->max_pameranmandiri->ViewValue, 2, -2, -2, -2);
        $this->max_pameranmandiri->ViewCustomAttributes = "";

        // skor_mediaoffline
        $this->skor_mediaoffline->ViewValue = $this->skor_mediaoffline->CurrentValue;
        $this->skor_mediaoffline->ViewValue = FormatNumber($this->skor_mediaoffline->ViewValue, 2, -2, -2, -2);
        $this->skor_mediaoffline->ViewCustomAttributes = "";

        // max_mediaoffline
        $this->max_mediaoffline->ViewValue = $this->max_mediaoffline->CurrentValue;
        $this->max_mediaoffline->ViewValue = FormatNumber($this->max_mediaoffline->ViewValue, 2, -2, -2, -2);
        $this->max_mediaoffline->ViewCustomAttributes = "";

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

        // nik
        $this->nik->LinkCustomAttributes = "";
        $this->nik->HrefValue = "";
        $this->nik->TooltipValue = "";

        // skor_unggul
        $this->skor_unggul->LinkCustomAttributes = "";
        $this->skor_unggul->HrefValue = "";
        $this->skor_unggul->TooltipValue = "";

        // max_unggul
        $this->max_unggul->LinkCustomAttributes = "";
        $this->max_unggul->HrefValue = "";
        $this->max_unggul->TooltipValue = "";

        // skor_target
        $this->skor_target->LinkCustomAttributes = "";
        $this->skor_target->HrefValue = "";
        $this->skor_target->TooltipValue = "";

        // max_target
        $this->max_target->LinkCustomAttributes = "";
        $this->max_target->HrefValue = "";
        $this->max_target->TooltipValue = "";

        // skor_available
        $this->skor_available->LinkCustomAttributes = "";
        $this->skor_available->HrefValue = "";
        $this->skor_available->TooltipValue = "";

        // max_available
        $this->max_available->LinkCustomAttributes = "";
        $this->max_available->HrefValue = "";
        $this->max_available->TooltipValue = "";

        // skor_merk
        $this->skor_merk->LinkCustomAttributes = "";
        $this->skor_merk->HrefValue = "";
        $this->skor_merk->TooltipValue = "";

        // max_merk
        $this->max_merk->LinkCustomAttributes = "";
        $this->max_merk->HrefValue = "";
        $this->max_merk->TooltipValue = "";

        // skor_merkhaki
        $this->skor_merkhaki->LinkCustomAttributes = "";
        $this->skor_merkhaki->HrefValue = "";
        $this->skor_merkhaki->TooltipValue = "";

        // max_merkhaki
        $this->max_merkhaki->LinkCustomAttributes = "";
        $this->max_merkhaki->HrefValue = "";
        $this->max_merkhaki->TooltipValue = "";

        // skor_merkkonsep
        $this->skor_merkkonsep->LinkCustomAttributes = "";
        $this->skor_merkkonsep->HrefValue = "";
        $this->skor_merkkonsep->TooltipValue = "";

        // max_merkkonsep
        $this->max_merkkonsep->LinkCustomAttributes = "";
        $this->max_merkkonsep->HrefValue = "";
        $this->max_merkkonsep->TooltipValue = "";

        // skor_merklisensi
        $this->skor_merklisensi->LinkCustomAttributes = "";
        $this->skor_merklisensi->HrefValue = "";
        $this->skor_merklisensi->TooltipValue = "";

        // max_merklisensi
        $this->max_merklisensi->LinkCustomAttributes = "";
        $this->max_merklisensi->HrefValue = "";
        $this->max_merklisensi->TooltipValue = "";

        // skor_mitra
        $this->skor_mitra->LinkCustomAttributes = "";
        $this->skor_mitra->HrefValue = "";
        $this->skor_mitra->TooltipValue = "";

        // max_mitra
        $this->max_mitra->LinkCustomAttributes = "";
        $this->max_mitra->HrefValue = "";
        $this->max_mitra->TooltipValue = "";

        // skor_market
        $this->skor_market->LinkCustomAttributes = "";
        $this->skor_market->HrefValue = "";
        $this->skor_market->TooltipValue = "";

        // max_market
        $this->max_market->LinkCustomAttributes = "";
        $this->max_market->HrefValue = "";
        $this->max_market->TooltipValue = "";

        // skor_pelangganloyal
        $this->skor_pelangganloyal->LinkCustomAttributes = "";
        $this->skor_pelangganloyal->HrefValue = "";
        $this->skor_pelangganloyal->TooltipValue = "";

        // max_pelangganloyal
        $this->max_pelangganloyal->LinkCustomAttributes = "";
        $this->max_pelangganloyal->HrefValue = "";
        $this->max_pelangganloyal->TooltipValue = "";

        // skor_pameranmandiri
        $this->skor_pameranmandiri->LinkCustomAttributes = "";
        $this->skor_pameranmandiri->HrefValue = "";
        $this->skor_pameranmandiri->TooltipValue = "";

        // max_pameranmandiri
        $this->max_pameranmandiri->LinkCustomAttributes = "";
        $this->max_pameranmandiri->HrefValue = "";
        $this->max_pameranmandiri->TooltipValue = "";

        // skor_mediaoffline
        $this->skor_mediaoffline->LinkCustomAttributes = "";
        $this->skor_mediaoffline->HrefValue = "";
        $this->skor_mediaoffline->TooltipValue = "";

        // max_mediaoffline
        $this->max_mediaoffline->LinkCustomAttributes = "";
        $this->max_mediaoffline->HrefValue = "";
        $this->max_mediaoffline->TooltipValue = "";

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

        // skor_unggul
        $this->skor_unggul->EditAttrs["class"] = "form-control";
        $this->skor_unggul->EditCustomAttributes = "";
        $this->skor_unggul->EditValue = $this->skor_unggul->CurrentValue;
        $this->skor_unggul->PlaceHolder = RemoveHtml($this->skor_unggul->caption());
        if (strval($this->skor_unggul->EditValue) != "" && is_numeric($this->skor_unggul->EditValue)) {
            $this->skor_unggul->EditValue = FormatNumber($this->skor_unggul->EditValue, -2, -2, -2, -2);
        }

        // max_unggul
        $this->max_unggul->EditAttrs["class"] = "form-control";
        $this->max_unggul->EditCustomAttributes = "";
        $this->max_unggul->EditValue = $this->max_unggul->CurrentValue;
        $this->max_unggul->PlaceHolder = RemoveHtml($this->max_unggul->caption());
        if (strval($this->max_unggul->EditValue) != "" && is_numeric($this->max_unggul->EditValue)) {
            $this->max_unggul->EditValue = FormatNumber($this->max_unggul->EditValue, -2, -2, -2, -2);
        }

        // skor_target
        $this->skor_target->EditAttrs["class"] = "form-control";
        $this->skor_target->EditCustomAttributes = "";
        $this->skor_target->EditValue = $this->skor_target->CurrentValue;
        $this->skor_target->PlaceHolder = RemoveHtml($this->skor_target->caption());
        if (strval($this->skor_target->EditValue) != "" && is_numeric($this->skor_target->EditValue)) {
            $this->skor_target->EditValue = FormatNumber($this->skor_target->EditValue, -2, -2, -2, -2);
        }

        // max_target
        $this->max_target->EditAttrs["class"] = "form-control";
        $this->max_target->EditCustomAttributes = "";
        $this->max_target->EditValue = $this->max_target->CurrentValue;
        $this->max_target->PlaceHolder = RemoveHtml($this->max_target->caption());
        if (strval($this->max_target->EditValue) != "" && is_numeric($this->max_target->EditValue)) {
            $this->max_target->EditValue = FormatNumber($this->max_target->EditValue, -2, -2, -2, -2);
        }

        // skor_available
        $this->skor_available->EditAttrs["class"] = "form-control";
        $this->skor_available->EditCustomAttributes = "";
        $this->skor_available->EditValue = $this->skor_available->CurrentValue;
        $this->skor_available->PlaceHolder = RemoveHtml($this->skor_available->caption());
        if (strval($this->skor_available->EditValue) != "" && is_numeric($this->skor_available->EditValue)) {
            $this->skor_available->EditValue = FormatNumber($this->skor_available->EditValue, -2, -2, -2, -2);
        }

        // max_available
        $this->max_available->EditAttrs["class"] = "form-control";
        $this->max_available->EditCustomAttributes = "";
        $this->max_available->EditValue = $this->max_available->CurrentValue;
        $this->max_available->PlaceHolder = RemoveHtml($this->max_available->caption());
        if (strval($this->max_available->EditValue) != "" && is_numeric($this->max_available->EditValue)) {
            $this->max_available->EditValue = FormatNumber($this->max_available->EditValue, -2, -2, -2, -2);
        }

        // skor_merk
        $this->skor_merk->EditAttrs["class"] = "form-control";
        $this->skor_merk->EditCustomAttributes = "";
        $this->skor_merk->EditValue = $this->skor_merk->CurrentValue;
        $this->skor_merk->PlaceHolder = RemoveHtml($this->skor_merk->caption());
        if (strval($this->skor_merk->EditValue) != "" && is_numeric($this->skor_merk->EditValue)) {
            $this->skor_merk->EditValue = FormatNumber($this->skor_merk->EditValue, -2, -2, -2, -2);
        }

        // max_merk
        $this->max_merk->EditAttrs["class"] = "form-control";
        $this->max_merk->EditCustomAttributes = "";
        $this->max_merk->EditValue = $this->max_merk->CurrentValue;
        $this->max_merk->PlaceHolder = RemoveHtml($this->max_merk->caption());
        if (strval($this->max_merk->EditValue) != "" && is_numeric($this->max_merk->EditValue)) {
            $this->max_merk->EditValue = FormatNumber($this->max_merk->EditValue, -2, -2, -2, -2);
        }

        // skor_merkhaki
        $this->skor_merkhaki->EditAttrs["class"] = "form-control";
        $this->skor_merkhaki->EditCustomAttributes = "";
        $this->skor_merkhaki->EditValue = $this->skor_merkhaki->CurrentValue;
        $this->skor_merkhaki->PlaceHolder = RemoveHtml($this->skor_merkhaki->caption());
        if (strval($this->skor_merkhaki->EditValue) != "" && is_numeric($this->skor_merkhaki->EditValue)) {
            $this->skor_merkhaki->EditValue = FormatNumber($this->skor_merkhaki->EditValue, -2, -2, -2, -2);
        }

        // max_merkhaki
        $this->max_merkhaki->EditAttrs["class"] = "form-control";
        $this->max_merkhaki->EditCustomAttributes = "";
        $this->max_merkhaki->EditValue = $this->max_merkhaki->CurrentValue;
        $this->max_merkhaki->PlaceHolder = RemoveHtml($this->max_merkhaki->caption());
        if (strval($this->max_merkhaki->EditValue) != "" && is_numeric($this->max_merkhaki->EditValue)) {
            $this->max_merkhaki->EditValue = FormatNumber($this->max_merkhaki->EditValue, -2, -2, -2, -2);
        }

        // skor_merkkonsep
        $this->skor_merkkonsep->EditAttrs["class"] = "form-control";
        $this->skor_merkkonsep->EditCustomAttributes = "";
        $this->skor_merkkonsep->EditValue = $this->skor_merkkonsep->CurrentValue;
        $this->skor_merkkonsep->PlaceHolder = RemoveHtml($this->skor_merkkonsep->caption());
        if (strval($this->skor_merkkonsep->EditValue) != "" && is_numeric($this->skor_merkkonsep->EditValue)) {
            $this->skor_merkkonsep->EditValue = FormatNumber($this->skor_merkkonsep->EditValue, -2, -2, -2, -2);
        }

        // max_merkkonsep
        $this->max_merkkonsep->EditAttrs["class"] = "form-control";
        $this->max_merkkonsep->EditCustomAttributes = "";
        $this->max_merkkonsep->EditValue = $this->max_merkkonsep->CurrentValue;
        $this->max_merkkonsep->PlaceHolder = RemoveHtml($this->max_merkkonsep->caption());
        if (strval($this->max_merkkonsep->EditValue) != "" && is_numeric($this->max_merkkonsep->EditValue)) {
            $this->max_merkkonsep->EditValue = FormatNumber($this->max_merkkonsep->EditValue, -2, -2, -2, -2);
        }

        // skor_merklisensi
        $this->skor_merklisensi->EditAttrs["class"] = "form-control";
        $this->skor_merklisensi->EditCustomAttributes = "";
        $this->skor_merklisensi->EditValue = $this->skor_merklisensi->CurrentValue;
        $this->skor_merklisensi->PlaceHolder = RemoveHtml($this->skor_merklisensi->caption());
        if (strval($this->skor_merklisensi->EditValue) != "" && is_numeric($this->skor_merklisensi->EditValue)) {
            $this->skor_merklisensi->EditValue = FormatNumber($this->skor_merklisensi->EditValue, -2, -2, -2, -2);
        }

        // max_merklisensi
        $this->max_merklisensi->EditAttrs["class"] = "form-control";
        $this->max_merklisensi->EditCustomAttributes = "";
        $this->max_merklisensi->EditValue = $this->max_merklisensi->CurrentValue;
        $this->max_merklisensi->PlaceHolder = RemoveHtml($this->max_merklisensi->caption());
        if (strval($this->max_merklisensi->EditValue) != "" && is_numeric($this->max_merklisensi->EditValue)) {
            $this->max_merklisensi->EditValue = FormatNumber($this->max_merklisensi->EditValue, -2, -2, -2, -2);
        }

        // skor_mitra
        $this->skor_mitra->EditAttrs["class"] = "form-control";
        $this->skor_mitra->EditCustomAttributes = "";
        $this->skor_mitra->EditValue = $this->skor_mitra->CurrentValue;
        $this->skor_mitra->PlaceHolder = RemoveHtml($this->skor_mitra->caption());
        if (strval($this->skor_mitra->EditValue) != "" && is_numeric($this->skor_mitra->EditValue)) {
            $this->skor_mitra->EditValue = FormatNumber($this->skor_mitra->EditValue, -2, -2, -2, -2);
        }

        // max_mitra
        $this->max_mitra->EditAttrs["class"] = "form-control";
        $this->max_mitra->EditCustomAttributes = "";
        $this->max_mitra->EditValue = $this->max_mitra->CurrentValue;
        $this->max_mitra->PlaceHolder = RemoveHtml($this->max_mitra->caption());
        if (strval($this->max_mitra->EditValue) != "" && is_numeric($this->max_mitra->EditValue)) {
            $this->max_mitra->EditValue = FormatNumber($this->max_mitra->EditValue, -2, -2, -2, -2);
        }

        // skor_market
        $this->skor_market->EditAttrs["class"] = "form-control";
        $this->skor_market->EditCustomAttributes = "";
        $this->skor_market->EditValue = $this->skor_market->CurrentValue;
        $this->skor_market->PlaceHolder = RemoveHtml($this->skor_market->caption());
        if (strval($this->skor_market->EditValue) != "" && is_numeric($this->skor_market->EditValue)) {
            $this->skor_market->EditValue = FormatNumber($this->skor_market->EditValue, -2, -2, -2, -2);
        }

        // max_market
        $this->max_market->EditAttrs["class"] = "form-control";
        $this->max_market->EditCustomAttributes = "";
        $this->max_market->EditValue = $this->max_market->CurrentValue;
        $this->max_market->PlaceHolder = RemoveHtml($this->max_market->caption());
        if (strval($this->max_market->EditValue) != "" && is_numeric($this->max_market->EditValue)) {
            $this->max_market->EditValue = FormatNumber($this->max_market->EditValue, -2, -2, -2, -2);
        }

        // skor_pelangganloyal
        $this->skor_pelangganloyal->EditAttrs["class"] = "form-control";
        $this->skor_pelangganloyal->EditCustomAttributes = "";
        $this->skor_pelangganloyal->EditValue = $this->skor_pelangganloyal->CurrentValue;
        $this->skor_pelangganloyal->PlaceHolder = RemoveHtml($this->skor_pelangganloyal->caption());
        if (strval($this->skor_pelangganloyal->EditValue) != "" && is_numeric($this->skor_pelangganloyal->EditValue)) {
            $this->skor_pelangganloyal->EditValue = FormatNumber($this->skor_pelangganloyal->EditValue, -2, -2, -2, -2);
        }

        // max_pelangganloyal
        $this->max_pelangganloyal->EditAttrs["class"] = "form-control";
        $this->max_pelangganloyal->EditCustomAttributes = "";
        $this->max_pelangganloyal->EditValue = $this->max_pelangganloyal->CurrentValue;
        $this->max_pelangganloyal->PlaceHolder = RemoveHtml($this->max_pelangganloyal->caption());
        if (strval($this->max_pelangganloyal->EditValue) != "" && is_numeric($this->max_pelangganloyal->EditValue)) {
            $this->max_pelangganloyal->EditValue = FormatNumber($this->max_pelangganloyal->EditValue, -2, -2, -2, -2);
        }

        // skor_pameranmandiri
        $this->skor_pameranmandiri->EditAttrs["class"] = "form-control";
        $this->skor_pameranmandiri->EditCustomAttributes = "";
        $this->skor_pameranmandiri->EditValue = $this->skor_pameranmandiri->CurrentValue;
        $this->skor_pameranmandiri->PlaceHolder = RemoveHtml($this->skor_pameranmandiri->caption());
        if (strval($this->skor_pameranmandiri->EditValue) != "" && is_numeric($this->skor_pameranmandiri->EditValue)) {
            $this->skor_pameranmandiri->EditValue = FormatNumber($this->skor_pameranmandiri->EditValue, -2, -2, -2, -2);
        }

        // max_pameranmandiri
        $this->max_pameranmandiri->EditAttrs["class"] = "form-control";
        $this->max_pameranmandiri->EditCustomAttributes = "";
        $this->max_pameranmandiri->EditValue = $this->max_pameranmandiri->CurrentValue;
        $this->max_pameranmandiri->PlaceHolder = RemoveHtml($this->max_pameranmandiri->caption());
        if (strval($this->max_pameranmandiri->EditValue) != "" && is_numeric($this->max_pameranmandiri->EditValue)) {
            $this->max_pameranmandiri->EditValue = FormatNumber($this->max_pameranmandiri->EditValue, -2, -2, -2, -2);
        }

        // skor_mediaoffline
        $this->skor_mediaoffline->EditAttrs["class"] = "form-control";
        $this->skor_mediaoffline->EditCustomAttributes = "";
        $this->skor_mediaoffline->EditValue = $this->skor_mediaoffline->CurrentValue;
        $this->skor_mediaoffline->PlaceHolder = RemoveHtml($this->skor_mediaoffline->caption());
        if (strval($this->skor_mediaoffline->EditValue) != "" && is_numeric($this->skor_mediaoffline->EditValue)) {
            $this->skor_mediaoffline->EditValue = FormatNumber($this->skor_mediaoffline->EditValue, -2, -2, -2, -2);
        }

        // max_mediaoffline
        $this->max_mediaoffline->EditAttrs["class"] = "form-control";
        $this->max_mediaoffline->EditCustomAttributes = "";
        $this->max_mediaoffline->EditValue = $this->max_mediaoffline->CurrentValue;
        $this->max_mediaoffline->PlaceHolder = RemoveHtml($this->max_mediaoffline->caption());
        if (strval($this->max_mediaoffline->EditValue) != "" && is_numeric($this->max_mediaoffline->EditValue)) {
            $this->max_mediaoffline->EditValue = FormatNumber($this->max_mediaoffline->EditValue, -2, -2, -2, -2);
        }

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
                    $doc->exportCaption($this->skor_unggul);
                    $doc->exportCaption($this->max_unggul);
                    $doc->exportCaption($this->skor_target);
                    $doc->exportCaption($this->max_target);
                    $doc->exportCaption($this->skor_available);
                    $doc->exportCaption($this->max_available);
                    $doc->exportCaption($this->skor_merk);
                    $doc->exportCaption($this->max_merk);
                    $doc->exportCaption($this->skor_merkhaki);
                    $doc->exportCaption($this->max_merkhaki);
                    $doc->exportCaption($this->skor_merkkonsep);
                    $doc->exportCaption($this->max_merkkonsep);
                    $doc->exportCaption($this->skor_merklisensi);
                    $doc->exportCaption($this->max_merklisensi);
                    $doc->exportCaption($this->skor_mitra);
                    $doc->exportCaption($this->max_mitra);
                    $doc->exportCaption($this->skor_market);
                    $doc->exportCaption($this->max_market);
                    $doc->exportCaption($this->skor_pelangganloyal);
                    $doc->exportCaption($this->max_pelangganloyal);
                    $doc->exportCaption($this->skor_pameranmandiri);
                    $doc->exportCaption($this->max_pameranmandiri);
                    $doc->exportCaption($this->skor_mediaoffline);
                    $doc->exportCaption($this->max_mediaoffline);
                    $doc->exportCaption($this->skor_pemasaran);
                    $doc->exportCaption($this->maxskor_pemasaran);
                    $doc->exportCaption($this->bobot_pemasaran);
                } else {
                    $doc->exportCaption($this->nik);
                    $doc->exportCaption($this->skor_unggul);
                    $doc->exportCaption($this->max_unggul);
                    $doc->exportCaption($this->skor_target);
                    $doc->exportCaption($this->max_target);
                    $doc->exportCaption($this->skor_available);
                    $doc->exportCaption($this->max_available);
                    $doc->exportCaption($this->skor_merk);
                    $doc->exportCaption($this->max_merk);
                    $doc->exportCaption($this->skor_merkhaki);
                    $doc->exportCaption($this->max_merkhaki);
                    $doc->exportCaption($this->skor_merkkonsep);
                    $doc->exportCaption($this->max_merkkonsep);
                    $doc->exportCaption($this->skor_merklisensi);
                    $doc->exportCaption($this->max_merklisensi);
                    $doc->exportCaption($this->skor_mitra);
                    $doc->exportCaption($this->max_mitra);
                    $doc->exportCaption($this->skor_market);
                    $doc->exportCaption($this->max_market);
                    $doc->exportCaption($this->skor_pelangganloyal);
                    $doc->exportCaption($this->max_pelangganloyal);
                    $doc->exportCaption($this->skor_pameranmandiri);
                    $doc->exportCaption($this->max_pameranmandiri);
                    $doc->exportCaption($this->skor_mediaoffline);
                    $doc->exportCaption($this->max_mediaoffline);
                    $doc->exportCaption($this->skor_pemasaran);
                    $doc->exportCaption($this->maxskor_pemasaran);
                    $doc->exportCaption($this->bobot_pemasaran);
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
                        $doc->exportField($this->skor_unggul);
                        $doc->exportField($this->max_unggul);
                        $doc->exportField($this->skor_target);
                        $doc->exportField($this->max_target);
                        $doc->exportField($this->skor_available);
                        $doc->exportField($this->max_available);
                        $doc->exportField($this->skor_merk);
                        $doc->exportField($this->max_merk);
                        $doc->exportField($this->skor_merkhaki);
                        $doc->exportField($this->max_merkhaki);
                        $doc->exportField($this->skor_merkkonsep);
                        $doc->exportField($this->max_merkkonsep);
                        $doc->exportField($this->skor_merklisensi);
                        $doc->exportField($this->max_merklisensi);
                        $doc->exportField($this->skor_mitra);
                        $doc->exportField($this->max_mitra);
                        $doc->exportField($this->skor_market);
                        $doc->exportField($this->max_market);
                        $doc->exportField($this->skor_pelangganloyal);
                        $doc->exportField($this->max_pelangganloyal);
                        $doc->exportField($this->skor_pameranmandiri);
                        $doc->exportField($this->max_pameranmandiri);
                        $doc->exportField($this->skor_mediaoffline);
                        $doc->exportField($this->max_mediaoffline);
                        $doc->exportField($this->skor_pemasaran);
                        $doc->exportField($this->maxskor_pemasaran);
                        $doc->exportField($this->bobot_pemasaran);
                    } else {
                        $doc->exportField($this->nik);
                        $doc->exportField($this->skor_unggul);
                        $doc->exportField($this->max_unggul);
                        $doc->exportField($this->skor_target);
                        $doc->exportField($this->max_target);
                        $doc->exportField($this->skor_available);
                        $doc->exportField($this->max_available);
                        $doc->exportField($this->skor_merk);
                        $doc->exportField($this->max_merk);
                        $doc->exportField($this->skor_merkhaki);
                        $doc->exportField($this->max_merkhaki);
                        $doc->exportField($this->skor_merkkonsep);
                        $doc->exportField($this->max_merkkonsep);
                        $doc->exportField($this->skor_merklisensi);
                        $doc->exportField($this->max_merklisensi);
                        $doc->exportField($this->skor_mitra);
                        $doc->exportField($this->max_mitra);
                        $doc->exportField($this->skor_market);
                        $doc->exportField($this->max_market);
                        $doc->exportField($this->skor_pelangganloyal);
                        $doc->exportField($this->max_pelangganloyal);
                        $doc->exportField($this->skor_pameranmandiri);
                        $doc->exportField($this->max_pameranmandiri);
                        $doc->exportField($this->skor_mediaoffline);
                        $doc->exportField($this->max_mediaoffline);
                        $doc->exportField($this->skor_pemasaran);
                        $doc->exportField($this->maxskor_pemasaran);
                        $doc->exportField($this->bobot_pemasaran);
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
