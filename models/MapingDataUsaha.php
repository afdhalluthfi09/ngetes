<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for maping_data_usaha
 */
class MapingDataUsaha extends DbTable
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
    public $Kapanewon;
    public $kapanewon_id;
    public $Jumlah;
    public $Usaha_Mikro;
    public $Usaha_Kecil;
    public $Usaha_Menengah;
    public $Status_Usaha_Kosong_Salah;
    public $Usaha_Pertanian;
    public $Usaha_Perdagangan;
    public $Usaha_Kuliner;
    public $Usaha_Bidang_Fashion;
    public $Usaha_Pendidikan;
    public $Usaha_Bidang_Otomotif;
    public $Usaha_Kerajinan_Tangan;
    public $Usaha_Elektronik_dan_Gadget;
    public $Jenis_Usaha_Lain;
    public $Tenaga_Kerja_Laki_laki;
    public $Tenaga_Kerja_Perempuan;
    public $Jumlah_Tenaga_Kerja;
    public $Aset;
    public $Omset_Per_Tahun;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'maping_data_usaha';
        $this->TableName = 'maping_data_usaha';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`maping_data_usaha`";
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

        // Kapanewon
        $this->Kapanewon = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Kapanewon', 'Kapanewon', '`Kapanewon`', '`Kapanewon`', 200, 255, -1, false, '`Kapanewon`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kapanewon->Sortable = true; // Allow sort
        $this->Kapanewon->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kapanewon->Param, "CustomMsg");
        $this->Fields['Kapanewon'] = &$this->Kapanewon;

        // kapanewon_id
        $this->kapanewon_id = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_kapanewon_id', 'kapanewon_id', '`kapanewon_id`', '`kapanewon_id`', 200, 50, -1, false, '`kapanewon_id`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kapanewon_id->Sortable = true; // Allow sort
        $this->kapanewon_id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kapanewon_id->Param, "CustomMsg");
        $this->Fields['kapanewon_id'] = &$this->kapanewon_id;

        // Jumlah
        $this->Jumlah = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Jumlah', 'Jumlah', '`Jumlah`', '`Jumlah`', 20, 21, -1, false, '`Jumlah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah->Nullable = false; // NOT NULL field
        $this->Jumlah->Sortable = true; // Allow sort
        $this->Jumlah->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Jumlah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah->Param, "CustomMsg");
        $this->Fields['Jumlah'] = &$this->Jumlah;

        // Usaha_Mikro
        $this->Usaha_Mikro = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Mikro', 'Usaha_Mikro', '`Usaha_Mikro`', '`Usaha_Mikro`', 131, 22, -1, false, '`Usaha_Mikro`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Mikro->Sortable = true; // Allow sort
        $this->Usaha_Mikro->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Mikro->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Mikro->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Mikro->Param, "CustomMsg");
        $this->Fields['Usaha_Mikro'] = &$this->Usaha_Mikro;

        // Usaha_Kecil
        $this->Usaha_Kecil = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Kecil', 'Usaha_Kecil', '`Usaha_Kecil`', '`Usaha_Kecil`', 131, 22, -1, false, '`Usaha_Kecil`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Kecil->Sortable = true; // Allow sort
        $this->Usaha_Kecil->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Kecil->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Kecil->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Kecil->Param, "CustomMsg");
        $this->Fields['Usaha_Kecil'] = &$this->Usaha_Kecil;

        // Usaha_Menengah
        $this->Usaha_Menengah = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Menengah', 'Usaha_Menengah', '`Usaha_Menengah`', '`Usaha_Menengah`', 131, 22, -1, false, '`Usaha_Menengah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Menengah->Sortable = true; // Allow sort
        $this->Usaha_Menengah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Menengah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Menengah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Menengah->Param, "CustomMsg");
        $this->Fields['Usaha_Menengah'] = &$this->Usaha_Menengah;

        // Status_Usaha_Kosong_Salah
        $this->Status_Usaha_Kosong_Salah = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Status_Usaha_Kosong_Salah', 'Status_Usaha_Kosong_Salah', '`Status_Usaha_Kosong_Salah`', '`Status_Usaha_Kosong_Salah`', 131, 22, -1, false, '`Status_Usaha_Kosong_Salah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Status_Usaha_Kosong_Salah->Sortable = true; // Allow sort
        $this->Status_Usaha_Kosong_Salah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Status_Usaha_Kosong_Salah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Status_Usaha_Kosong_Salah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Status_Usaha_Kosong_Salah->Param, "CustomMsg");
        $this->Fields['Status_Usaha_Kosong_Salah'] = &$this->Status_Usaha_Kosong_Salah;

        // Usaha_Pertanian
        $this->Usaha_Pertanian = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Pertanian', 'Usaha_Pertanian', '`Usaha_Pertanian`', '`Usaha_Pertanian`', 131, 22, -1, false, '`Usaha_Pertanian`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Pertanian->Sortable = true; // Allow sort
        $this->Usaha_Pertanian->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Pertanian->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Pertanian->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Pertanian->Param, "CustomMsg");
        $this->Fields['Usaha_Pertanian'] = &$this->Usaha_Pertanian;

        // Usaha_Perdagangan
        $this->Usaha_Perdagangan = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Perdagangan', 'Usaha_Perdagangan', '`Usaha_Perdagangan`', '`Usaha_Perdagangan`', 131, 22, -1, false, '`Usaha_Perdagangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Perdagangan->Sortable = true; // Allow sort
        $this->Usaha_Perdagangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Perdagangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Perdagangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Perdagangan->Param, "CustomMsg");
        $this->Fields['Usaha_Perdagangan'] = &$this->Usaha_Perdagangan;

        // Usaha_Kuliner
        $this->Usaha_Kuliner = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Kuliner', 'Usaha_Kuliner', '`Usaha_Kuliner`', '`Usaha_Kuliner`', 131, 22, -1, false, '`Usaha_Kuliner`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Kuliner->Sortable = true; // Allow sort
        $this->Usaha_Kuliner->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Kuliner->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Kuliner->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Kuliner->Param, "CustomMsg");
        $this->Fields['Usaha_Kuliner'] = &$this->Usaha_Kuliner;

        // Usaha_Bidang_Fashion
        $this->Usaha_Bidang_Fashion = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Bidang_Fashion', 'Usaha_Bidang_Fashion', '`Usaha_Bidang_Fashion`', '`Usaha_Bidang_Fashion`', 131, 22, -1, false, '`Usaha_Bidang_Fashion`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Bidang_Fashion->Sortable = true; // Allow sort
        $this->Usaha_Bidang_Fashion->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Bidang_Fashion->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Bidang_Fashion->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Bidang_Fashion->Param, "CustomMsg");
        $this->Fields['Usaha_Bidang_Fashion'] = &$this->Usaha_Bidang_Fashion;

        // Usaha_Pendidikan
        $this->Usaha_Pendidikan = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Pendidikan', 'Usaha_Pendidikan', '`Usaha_Pendidikan`', '`Usaha_Pendidikan`', 131, 22, -1, false, '`Usaha_Pendidikan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Pendidikan->Sortable = true; // Allow sort
        $this->Usaha_Pendidikan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Pendidikan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Pendidikan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Pendidikan->Param, "CustomMsg");
        $this->Fields['Usaha_Pendidikan'] = &$this->Usaha_Pendidikan;

        // Usaha_Bidang_Otomotif
        $this->Usaha_Bidang_Otomotif = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Bidang_Otomotif', 'Usaha_Bidang_Otomotif', '`Usaha_Bidang_Otomotif`', '`Usaha_Bidang_Otomotif`', 131, 22, -1, false, '`Usaha_Bidang_Otomotif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Bidang_Otomotif->Sortable = true; // Allow sort
        $this->Usaha_Bidang_Otomotif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Bidang_Otomotif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Bidang_Otomotif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Bidang_Otomotif->Param, "CustomMsg");
        $this->Fields['Usaha_Bidang_Otomotif'] = &$this->Usaha_Bidang_Otomotif;

        // Usaha_Kerajinan_Tangan
        $this->Usaha_Kerajinan_Tangan = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Kerajinan_Tangan', 'Usaha_Kerajinan_Tangan', '`Usaha_Kerajinan_Tangan`', '`Usaha_Kerajinan_Tangan`', 131, 22, -1, false, '`Usaha_Kerajinan_Tangan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Kerajinan_Tangan->Sortable = true; // Allow sort
        $this->Usaha_Kerajinan_Tangan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Kerajinan_Tangan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Kerajinan_Tangan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Kerajinan_Tangan->Param, "CustomMsg");
        $this->Fields['Usaha_Kerajinan_Tangan'] = &$this->Usaha_Kerajinan_Tangan;

        // Usaha_Elektronik_dan_Gadget
        $this->Usaha_Elektronik_dan_Gadget = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Usaha_Elektronik_dan_Gadget', 'Usaha_Elektronik_dan_Gadget', '`Usaha_Elektronik_dan_Gadget`', '`Usaha_Elektronik_dan_Gadget`', 131, 22, -1, false, '`Usaha_Elektronik_dan_Gadget`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Elektronik_dan_Gadget->Sortable = true; // Allow sort
        $this->Usaha_Elektronik_dan_Gadget->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Usaha_Elektronik_dan_Gadget->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Usaha_Elektronik_dan_Gadget->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Elektronik_dan_Gadget->Param, "CustomMsg");
        $this->Fields['Usaha_Elektronik_dan_Gadget'] = &$this->Usaha_Elektronik_dan_Gadget;

        // Jenis_Usaha_Lain
        $this->Jenis_Usaha_Lain = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Jenis_Usaha_Lain', 'Jenis_Usaha_Lain', '`Jenis_Usaha_Lain`', '`Jenis_Usaha_Lain`', 131, 22, -1, false, '`Jenis_Usaha_Lain`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jenis_Usaha_Lain->Sortable = true; // Allow sort
        $this->Jenis_Usaha_Lain->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jenis_Usaha_Lain->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jenis_Usaha_Lain->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jenis_Usaha_Lain->Param, "CustomMsg");
        $this->Fields['Jenis_Usaha_Lain'] = &$this->Jenis_Usaha_Lain;

        // Tenaga_Kerja_Laki_laki
        $this->Tenaga_Kerja_Laki_laki = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Tenaga_Kerja_Laki_laki', 'Tenaga_Kerja_Laki_laki', '`Tenaga_Kerja_Laki_laki`', '`Tenaga_Kerja_Laki_laki`', 131, 25, -1, false, '`Tenaga_Kerja_Laki_laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tenaga_Kerja_Laki_laki->Sortable = true; // Allow sort
        $this->Tenaga_Kerja_Laki_laki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Tenaga_Kerja_Laki_laki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Tenaga_Kerja_Laki_laki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tenaga_Kerja_Laki_laki->Param, "CustomMsg");
        $this->Fields['Tenaga_Kerja_Laki_laki'] = &$this->Tenaga_Kerja_Laki_laki;

        // Tenaga_Kerja_Perempuan
        $this->Tenaga_Kerja_Perempuan = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Tenaga_Kerja_Perempuan', 'Tenaga_Kerja_Perempuan', '`Tenaga_Kerja_Perempuan`', '`Tenaga_Kerja_Perempuan`', 131, 25, -1, false, '`Tenaga_Kerja_Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tenaga_Kerja_Perempuan->Sortable = true; // Allow sort
        $this->Tenaga_Kerja_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Tenaga_Kerja_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Tenaga_Kerja_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tenaga_Kerja_Perempuan->Param, "CustomMsg");
        $this->Fields['Tenaga_Kerja_Perempuan'] = &$this->Tenaga_Kerja_Perempuan;

        // Jumlah_Tenaga_Kerja
        $this->Jumlah_Tenaga_Kerja = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Jumlah_Tenaga_Kerja', 'Jumlah_Tenaga_Kerja', '`Jumlah_Tenaga_Kerja`', '`Jumlah_Tenaga_Kerja`', 131, 26, -1, false, '`Jumlah_Tenaga_Kerja`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Tenaga_Kerja->Sortable = true; // Allow sort
        $this->Jumlah_Tenaga_Kerja->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Tenaga_Kerja->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Tenaga_Kerja->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Tenaga_Kerja->Param, "CustomMsg");
        $this->Fields['Jumlah_Tenaga_Kerja'] = &$this->Jumlah_Tenaga_Kerja;

        // Aset
        $this->Aset = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Aset', 'Aset', '`Aset`', '`Aset`', 5, 23, -1, false, '`Aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aset->Sortable = true; // Allow sort
        $this->Aset->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Aset->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Aset->Param, "CustomMsg");
        $this->Fields['Aset'] = &$this->Aset;

        // Omset_Per_Tahun
        $this->Omset_Per_Tahun = new DbField('maping_data_usaha', 'maping_data_usaha', 'x_Omset_Per_Tahun', 'Omset_Per_Tahun', '`Omset_Per_Tahun`', '`Omset_Per_Tahun`', 5, 23, -1, false, '`Omset_Per_Tahun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Omset_Per_Tahun->Sortable = true; // Allow sort
        $this->Omset_Per_Tahun->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Omset_Per_Tahun->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Omset_Per_Tahun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Omset_Per_Tahun->Param, "CustomMsg");
        $this->Fields['Omset_Per_Tahun'] = &$this->Omset_Per_Tahun;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`maping_data_usaha`";
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
        $this->Kapanewon->DbValue = $row['Kapanewon'];
        $this->kapanewon_id->DbValue = $row['kapanewon_id'];
        $this->Jumlah->DbValue = $row['Jumlah'];
        $this->Usaha_Mikro->DbValue = $row['Usaha_Mikro'];
        $this->Usaha_Kecil->DbValue = $row['Usaha_Kecil'];
        $this->Usaha_Menengah->DbValue = $row['Usaha_Menengah'];
        $this->Status_Usaha_Kosong_Salah->DbValue = $row['Status_Usaha_Kosong_Salah'];
        $this->Usaha_Pertanian->DbValue = $row['Usaha_Pertanian'];
        $this->Usaha_Perdagangan->DbValue = $row['Usaha_Perdagangan'];
        $this->Usaha_Kuliner->DbValue = $row['Usaha_Kuliner'];
        $this->Usaha_Bidang_Fashion->DbValue = $row['Usaha_Bidang_Fashion'];
        $this->Usaha_Pendidikan->DbValue = $row['Usaha_Pendidikan'];
        $this->Usaha_Bidang_Otomotif->DbValue = $row['Usaha_Bidang_Otomotif'];
        $this->Usaha_Kerajinan_Tangan->DbValue = $row['Usaha_Kerajinan_Tangan'];
        $this->Usaha_Elektronik_dan_Gadget->DbValue = $row['Usaha_Elektronik_dan_Gadget'];
        $this->Jenis_Usaha_Lain->DbValue = $row['Jenis_Usaha_Lain'];
        $this->Tenaga_Kerja_Laki_laki->DbValue = $row['Tenaga_Kerja_Laki_laki'];
        $this->Tenaga_Kerja_Perempuan->DbValue = $row['Tenaga_Kerja_Perempuan'];
        $this->Jumlah_Tenaga_Kerja->DbValue = $row['Jumlah_Tenaga_Kerja'];
        $this->Aset->DbValue = $row['Aset'];
        $this->Omset_Per_Tahun->DbValue = $row['Omset_Per_Tahun'];
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
        return $_SESSION[$name] ?? GetUrl("mapingdatausahalist");
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
        if ($pageName == "mapingdatausahaview") {
            return $Language->phrase("View");
        } elseif ($pageName == "mapingdatausahaedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "mapingdatausahaadd") {
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
                return "MapingDataUsahaView";
            case Config("API_ADD_ACTION"):
                return "MapingDataUsahaAdd";
            case Config("API_EDIT_ACTION"):
                return "MapingDataUsahaEdit";
            case Config("API_DELETE_ACTION"):
                return "MapingDataUsahaDelete";
            case Config("API_LIST_ACTION"):
                return "MapingDataUsahaList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "mapingdatausahalist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("mapingdatausahaview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("mapingdatausahaview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "mapingdatausahaadd?" . $this->getUrlParm($parm);
        } else {
            $url = "mapingdatausahaadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("mapingdatausahaedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("mapingdatausahaadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("mapingdatausahadelete", $this->getUrlParm());
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
        $this->Kapanewon->setDbValue($row['Kapanewon']);
        $this->kapanewon_id->setDbValue($row['kapanewon_id']);
        $this->Jumlah->setDbValue($row['Jumlah']);
        $this->Usaha_Mikro->setDbValue($row['Usaha_Mikro']);
        $this->Usaha_Kecil->setDbValue($row['Usaha_Kecil']);
        $this->Usaha_Menengah->setDbValue($row['Usaha_Menengah']);
        $this->Status_Usaha_Kosong_Salah->setDbValue($row['Status_Usaha_Kosong_Salah']);
        $this->Usaha_Pertanian->setDbValue($row['Usaha_Pertanian']);
        $this->Usaha_Perdagangan->setDbValue($row['Usaha_Perdagangan']);
        $this->Usaha_Kuliner->setDbValue($row['Usaha_Kuliner']);
        $this->Usaha_Bidang_Fashion->setDbValue($row['Usaha_Bidang_Fashion']);
        $this->Usaha_Pendidikan->setDbValue($row['Usaha_Pendidikan']);
        $this->Usaha_Bidang_Otomotif->setDbValue($row['Usaha_Bidang_Otomotif']);
        $this->Usaha_Kerajinan_Tangan->setDbValue($row['Usaha_Kerajinan_Tangan']);
        $this->Usaha_Elektronik_dan_Gadget->setDbValue($row['Usaha_Elektronik_dan_Gadget']);
        $this->Jenis_Usaha_Lain->setDbValue($row['Jenis_Usaha_Lain']);
        $this->Tenaga_Kerja_Laki_laki->setDbValue($row['Tenaga_Kerja_Laki_laki']);
        $this->Tenaga_Kerja_Perempuan->setDbValue($row['Tenaga_Kerja_Perempuan']);
        $this->Jumlah_Tenaga_Kerja->setDbValue($row['Jumlah_Tenaga_Kerja']);
        $this->Aset->setDbValue($row['Aset']);
        $this->Omset_Per_Tahun->setDbValue($row['Omset_Per_Tahun']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Kapanewon

        // kapanewon_id

        // Jumlah

        // Usaha_Mikro

        // Usaha_Kecil

        // Usaha_Menengah

        // Status_Usaha_Kosong_Salah

        // Usaha_Pertanian

        // Usaha_Perdagangan

        // Usaha_Kuliner

        // Usaha_Bidang_Fashion

        // Usaha_Pendidikan

        // Usaha_Bidang_Otomotif

        // Usaha_Kerajinan_Tangan

        // Usaha_Elektronik_dan_Gadget

        // Jenis_Usaha_Lain

        // Tenaga_Kerja_Laki_laki

        // Tenaga_Kerja_Perempuan

        // Jumlah_Tenaga_Kerja

        // Aset

        // Omset_Per_Tahun

        // Kapanewon
        $this->Kapanewon->ViewValue = $this->Kapanewon->CurrentValue;
        $this->Kapanewon->ViewCustomAttributes = "";

        // kapanewon_id
        $this->kapanewon_id->ViewValue = $this->kapanewon_id->CurrentValue;
        $this->kapanewon_id->ViewCustomAttributes = "";

        // Jumlah
        $this->Jumlah->ViewValue = $this->Jumlah->CurrentValue;
        $this->Jumlah->ViewValue = FormatNumber($this->Jumlah->ViewValue, 0, -2, -2, -2);
        $this->Jumlah->ViewCustomAttributes = "";

        // Usaha_Mikro
        $this->Usaha_Mikro->ViewValue = $this->Usaha_Mikro->CurrentValue;
        $this->Usaha_Mikro->ViewValue = FormatNumber($this->Usaha_Mikro->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Mikro->ViewCustomAttributes = "";

        // Usaha_Kecil
        $this->Usaha_Kecil->ViewValue = $this->Usaha_Kecil->CurrentValue;
        $this->Usaha_Kecil->ViewValue = FormatNumber($this->Usaha_Kecil->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Kecil->ViewCustomAttributes = "";

        // Usaha_Menengah
        $this->Usaha_Menengah->ViewValue = $this->Usaha_Menengah->CurrentValue;
        $this->Usaha_Menengah->ViewValue = FormatNumber($this->Usaha_Menengah->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Menengah->ViewCustomAttributes = "";

        // Status_Usaha_Kosong_Salah
        $this->Status_Usaha_Kosong_Salah->ViewValue = $this->Status_Usaha_Kosong_Salah->CurrentValue;
        $this->Status_Usaha_Kosong_Salah->ViewValue = FormatNumber($this->Status_Usaha_Kosong_Salah->ViewValue, 2, -2, -2, -2);
        $this->Status_Usaha_Kosong_Salah->ViewCustomAttributes = "";

        // Usaha_Pertanian
        $this->Usaha_Pertanian->ViewValue = $this->Usaha_Pertanian->CurrentValue;
        $this->Usaha_Pertanian->ViewValue = FormatNumber($this->Usaha_Pertanian->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Pertanian->ViewCustomAttributes = "";

        // Usaha_Perdagangan
        $this->Usaha_Perdagangan->ViewValue = $this->Usaha_Perdagangan->CurrentValue;
        $this->Usaha_Perdagangan->ViewValue = FormatNumber($this->Usaha_Perdagangan->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Perdagangan->ViewCustomAttributes = "";

        // Usaha_Kuliner
        $this->Usaha_Kuliner->ViewValue = $this->Usaha_Kuliner->CurrentValue;
        $this->Usaha_Kuliner->ViewValue = FormatNumber($this->Usaha_Kuliner->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Kuliner->ViewCustomAttributes = "";

        // Usaha_Bidang_Fashion
        $this->Usaha_Bidang_Fashion->ViewValue = $this->Usaha_Bidang_Fashion->CurrentValue;
        $this->Usaha_Bidang_Fashion->ViewValue = FormatNumber($this->Usaha_Bidang_Fashion->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Bidang_Fashion->ViewCustomAttributes = "";

        // Usaha_Pendidikan
        $this->Usaha_Pendidikan->ViewValue = $this->Usaha_Pendidikan->CurrentValue;
        $this->Usaha_Pendidikan->ViewValue = FormatNumber($this->Usaha_Pendidikan->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Pendidikan->ViewCustomAttributes = "";

        // Usaha_Bidang_Otomotif
        $this->Usaha_Bidang_Otomotif->ViewValue = $this->Usaha_Bidang_Otomotif->CurrentValue;
        $this->Usaha_Bidang_Otomotif->ViewValue = FormatNumber($this->Usaha_Bidang_Otomotif->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Bidang_Otomotif->ViewCustomAttributes = "";

        // Usaha_Kerajinan_Tangan
        $this->Usaha_Kerajinan_Tangan->ViewValue = $this->Usaha_Kerajinan_Tangan->CurrentValue;
        $this->Usaha_Kerajinan_Tangan->ViewValue = FormatNumber($this->Usaha_Kerajinan_Tangan->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Kerajinan_Tangan->ViewCustomAttributes = "";

        // Usaha_Elektronik_dan_Gadget
        $this->Usaha_Elektronik_dan_Gadget->ViewValue = $this->Usaha_Elektronik_dan_Gadget->CurrentValue;
        $this->Usaha_Elektronik_dan_Gadget->ViewValue = FormatNumber($this->Usaha_Elektronik_dan_Gadget->ViewValue, 2, -2, -2, -2);
        $this->Usaha_Elektronik_dan_Gadget->ViewCustomAttributes = "";

        // Jenis_Usaha_Lain
        $this->Jenis_Usaha_Lain->ViewValue = $this->Jenis_Usaha_Lain->CurrentValue;
        $this->Jenis_Usaha_Lain->ViewValue = FormatNumber($this->Jenis_Usaha_Lain->ViewValue, 2, -2, -2, -2);
        $this->Jenis_Usaha_Lain->ViewCustomAttributes = "";

        // Tenaga_Kerja_Laki_laki
        $this->Tenaga_Kerja_Laki_laki->ViewValue = $this->Tenaga_Kerja_Laki_laki->CurrentValue;
        $this->Tenaga_Kerja_Laki_laki->ViewValue = FormatNumber($this->Tenaga_Kerja_Laki_laki->ViewValue, 2, -2, -2, -2);
        $this->Tenaga_Kerja_Laki_laki->ViewCustomAttributes = "";

        // Tenaga_Kerja_Perempuan
        $this->Tenaga_Kerja_Perempuan->ViewValue = $this->Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Tenaga_Kerja_Perempuan->ViewValue = FormatNumber($this->Tenaga_Kerja_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Tenaga_Kerja_Perempuan->ViewCustomAttributes = "";

        // Jumlah_Tenaga_Kerja
        $this->Jumlah_Tenaga_Kerja->ViewValue = $this->Jumlah_Tenaga_Kerja->CurrentValue;
        $this->Jumlah_Tenaga_Kerja->ViewValue = FormatNumber($this->Jumlah_Tenaga_Kerja->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Tenaga_Kerja->ViewCustomAttributes = "";

        // Aset
        $this->Aset->ViewValue = $this->Aset->CurrentValue;
        $this->Aset->ViewValue = FormatNumber($this->Aset->ViewValue, 2, -2, -2, -2);
        $this->Aset->ViewCustomAttributes = "";

        // Omset_Per_Tahun
        $this->Omset_Per_Tahun->ViewValue = $this->Omset_Per_Tahun->CurrentValue;
        $this->Omset_Per_Tahun->ViewValue = FormatNumber($this->Omset_Per_Tahun->ViewValue, 2, -2, -2, -2);
        $this->Omset_Per_Tahun->ViewCustomAttributes = "";

        // Kapanewon
        $this->Kapanewon->LinkCustomAttributes = "";
        $this->Kapanewon->HrefValue = "";
        $this->Kapanewon->TooltipValue = "";

        // kapanewon_id
        $this->kapanewon_id->LinkCustomAttributes = "";
        $this->kapanewon_id->HrefValue = "";
        $this->kapanewon_id->TooltipValue = "";

        // Jumlah
        $this->Jumlah->LinkCustomAttributes = "";
        $this->Jumlah->HrefValue = "";
        $this->Jumlah->TooltipValue = "";

        // Usaha_Mikro
        $this->Usaha_Mikro->LinkCustomAttributes = "";
        $this->Usaha_Mikro->HrefValue = "";
        $this->Usaha_Mikro->TooltipValue = "";

        // Usaha_Kecil
        $this->Usaha_Kecil->LinkCustomAttributes = "";
        $this->Usaha_Kecil->HrefValue = "";
        $this->Usaha_Kecil->TooltipValue = "";

        // Usaha_Menengah
        $this->Usaha_Menengah->LinkCustomAttributes = "";
        $this->Usaha_Menengah->HrefValue = "";
        $this->Usaha_Menengah->TooltipValue = "";

        // Status_Usaha_Kosong_Salah
        $this->Status_Usaha_Kosong_Salah->LinkCustomAttributes = "";
        $this->Status_Usaha_Kosong_Salah->HrefValue = "";
        $this->Status_Usaha_Kosong_Salah->TooltipValue = "";

        // Usaha_Pertanian
        $this->Usaha_Pertanian->LinkCustomAttributes = "";
        $this->Usaha_Pertanian->HrefValue = "";
        $this->Usaha_Pertanian->TooltipValue = "";

        // Usaha_Perdagangan
        $this->Usaha_Perdagangan->LinkCustomAttributes = "";
        $this->Usaha_Perdagangan->HrefValue = "";
        $this->Usaha_Perdagangan->TooltipValue = "";

        // Usaha_Kuliner
        $this->Usaha_Kuliner->LinkCustomAttributes = "";
        $this->Usaha_Kuliner->HrefValue = "";
        $this->Usaha_Kuliner->TooltipValue = "";

        // Usaha_Bidang_Fashion
        $this->Usaha_Bidang_Fashion->LinkCustomAttributes = "";
        $this->Usaha_Bidang_Fashion->HrefValue = "";
        $this->Usaha_Bidang_Fashion->TooltipValue = "";

        // Usaha_Pendidikan
        $this->Usaha_Pendidikan->LinkCustomAttributes = "";
        $this->Usaha_Pendidikan->HrefValue = "";
        $this->Usaha_Pendidikan->TooltipValue = "";

        // Usaha_Bidang_Otomotif
        $this->Usaha_Bidang_Otomotif->LinkCustomAttributes = "";
        $this->Usaha_Bidang_Otomotif->HrefValue = "";
        $this->Usaha_Bidang_Otomotif->TooltipValue = "";

        // Usaha_Kerajinan_Tangan
        $this->Usaha_Kerajinan_Tangan->LinkCustomAttributes = "";
        $this->Usaha_Kerajinan_Tangan->HrefValue = "";
        $this->Usaha_Kerajinan_Tangan->TooltipValue = "";

        // Usaha_Elektronik_dan_Gadget
        $this->Usaha_Elektronik_dan_Gadget->LinkCustomAttributes = "";
        $this->Usaha_Elektronik_dan_Gadget->HrefValue = "";
        $this->Usaha_Elektronik_dan_Gadget->TooltipValue = "";

        // Jenis_Usaha_Lain
        $this->Jenis_Usaha_Lain->LinkCustomAttributes = "";
        $this->Jenis_Usaha_Lain->HrefValue = "";
        $this->Jenis_Usaha_Lain->TooltipValue = "";

        // Tenaga_Kerja_Laki_laki
        $this->Tenaga_Kerja_Laki_laki->LinkCustomAttributes = "";
        $this->Tenaga_Kerja_Laki_laki->HrefValue = "";
        $this->Tenaga_Kerja_Laki_laki->TooltipValue = "";

        // Tenaga_Kerja_Perempuan
        $this->Tenaga_Kerja_Perempuan->LinkCustomAttributes = "";
        $this->Tenaga_Kerja_Perempuan->HrefValue = "";
        $this->Tenaga_Kerja_Perempuan->TooltipValue = "";

        // Jumlah_Tenaga_Kerja
        $this->Jumlah_Tenaga_Kerja->LinkCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja->HrefValue = "";
        $this->Jumlah_Tenaga_Kerja->TooltipValue = "";

        // Aset
        $this->Aset->LinkCustomAttributes = "";
        $this->Aset->HrefValue = "";
        $this->Aset->TooltipValue = "";

        // Omset_Per_Tahun
        $this->Omset_Per_Tahun->LinkCustomAttributes = "";
        $this->Omset_Per_Tahun->HrefValue = "";
        $this->Omset_Per_Tahun->TooltipValue = "";

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

        // Kapanewon
        $this->Kapanewon->EditAttrs["class"] = "form-control";
        $this->Kapanewon->EditCustomAttributes = "";
        if (!$this->Kapanewon->Raw) {
            $this->Kapanewon->CurrentValue = HtmlDecode($this->Kapanewon->CurrentValue);
        }
        $this->Kapanewon->EditValue = $this->Kapanewon->CurrentValue;
        $this->Kapanewon->PlaceHolder = RemoveHtml($this->Kapanewon->caption());

        // kapanewon_id
        $this->kapanewon_id->EditAttrs["class"] = "form-control";
        $this->kapanewon_id->EditCustomAttributes = "";
        if (!$this->kapanewon_id->Raw) {
            $this->kapanewon_id->CurrentValue = HtmlDecode($this->kapanewon_id->CurrentValue);
        }
        $this->kapanewon_id->EditValue = $this->kapanewon_id->CurrentValue;
        $this->kapanewon_id->PlaceHolder = RemoveHtml($this->kapanewon_id->caption());

        // Jumlah
        $this->Jumlah->EditAttrs["class"] = "form-control";
        $this->Jumlah->EditCustomAttributes = "";
        $this->Jumlah->EditValue = $this->Jumlah->CurrentValue;
        $this->Jumlah->PlaceHolder = RemoveHtml($this->Jumlah->caption());

        // Usaha_Mikro
        $this->Usaha_Mikro->EditAttrs["class"] = "form-control";
        $this->Usaha_Mikro->EditCustomAttributes = "";
        $this->Usaha_Mikro->EditValue = $this->Usaha_Mikro->CurrentValue;
        $this->Usaha_Mikro->PlaceHolder = RemoveHtml($this->Usaha_Mikro->caption());
        if (strval($this->Usaha_Mikro->EditValue) != "" && is_numeric($this->Usaha_Mikro->EditValue)) {
            $this->Usaha_Mikro->EditValue = FormatNumber($this->Usaha_Mikro->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Kecil
        $this->Usaha_Kecil->EditAttrs["class"] = "form-control";
        $this->Usaha_Kecil->EditCustomAttributes = "";
        $this->Usaha_Kecil->EditValue = $this->Usaha_Kecil->CurrentValue;
        $this->Usaha_Kecil->PlaceHolder = RemoveHtml($this->Usaha_Kecil->caption());
        if (strval($this->Usaha_Kecil->EditValue) != "" && is_numeric($this->Usaha_Kecil->EditValue)) {
            $this->Usaha_Kecil->EditValue = FormatNumber($this->Usaha_Kecil->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Menengah
        $this->Usaha_Menengah->EditAttrs["class"] = "form-control";
        $this->Usaha_Menengah->EditCustomAttributes = "";
        $this->Usaha_Menengah->EditValue = $this->Usaha_Menengah->CurrentValue;
        $this->Usaha_Menengah->PlaceHolder = RemoveHtml($this->Usaha_Menengah->caption());
        if (strval($this->Usaha_Menengah->EditValue) != "" && is_numeric($this->Usaha_Menengah->EditValue)) {
            $this->Usaha_Menengah->EditValue = FormatNumber($this->Usaha_Menengah->EditValue, -2, -2, -2, -2);
        }

        // Status_Usaha_Kosong_Salah
        $this->Status_Usaha_Kosong_Salah->EditAttrs["class"] = "form-control";
        $this->Status_Usaha_Kosong_Salah->EditCustomAttributes = "";
        $this->Status_Usaha_Kosong_Salah->EditValue = $this->Status_Usaha_Kosong_Salah->CurrentValue;
        $this->Status_Usaha_Kosong_Salah->PlaceHolder = RemoveHtml($this->Status_Usaha_Kosong_Salah->caption());
        if (strval($this->Status_Usaha_Kosong_Salah->EditValue) != "" && is_numeric($this->Status_Usaha_Kosong_Salah->EditValue)) {
            $this->Status_Usaha_Kosong_Salah->EditValue = FormatNumber($this->Status_Usaha_Kosong_Salah->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Pertanian
        $this->Usaha_Pertanian->EditAttrs["class"] = "form-control";
        $this->Usaha_Pertanian->EditCustomAttributes = "";
        $this->Usaha_Pertanian->EditValue = $this->Usaha_Pertanian->CurrentValue;
        $this->Usaha_Pertanian->PlaceHolder = RemoveHtml($this->Usaha_Pertanian->caption());
        if (strval($this->Usaha_Pertanian->EditValue) != "" && is_numeric($this->Usaha_Pertanian->EditValue)) {
            $this->Usaha_Pertanian->EditValue = FormatNumber($this->Usaha_Pertanian->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Perdagangan
        $this->Usaha_Perdagangan->EditAttrs["class"] = "form-control";
        $this->Usaha_Perdagangan->EditCustomAttributes = "";
        $this->Usaha_Perdagangan->EditValue = $this->Usaha_Perdagangan->CurrentValue;
        $this->Usaha_Perdagangan->PlaceHolder = RemoveHtml($this->Usaha_Perdagangan->caption());
        if (strval($this->Usaha_Perdagangan->EditValue) != "" && is_numeric($this->Usaha_Perdagangan->EditValue)) {
            $this->Usaha_Perdagangan->EditValue = FormatNumber($this->Usaha_Perdagangan->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Kuliner
        $this->Usaha_Kuliner->EditAttrs["class"] = "form-control";
        $this->Usaha_Kuliner->EditCustomAttributes = "";
        $this->Usaha_Kuliner->EditValue = $this->Usaha_Kuliner->CurrentValue;
        $this->Usaha_Kuliner->PlaceHolder = RemoveHtml($this->Usaha_Kuliner->caption());
        if (strval($this->Usaha_Kuliner->EditValue) != "" && is_numeric($this->Usaha_Kuliner->EditValue)) {
            $this->Usaha_Kuliner->EditValue = FormatNumber($this->Usaha_Kuliner->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Bidang_Fashion
        $this->Usaha_Bidang_Fashion->EditAttrs["class"] = "form-control";
        $this->Usaha_Bidang_Fashion->EditCustomAttributes = "";
        $this->Usaha_Bidang_Fashion->EditValue = $this->Usaha_Bidang_Fashion->CurrentValue;
        $this->Usaha_Bidang_Fashion->PlaceHolder = RemoveHtml($this->Usaha_Bidang_Fashion->caption());
        if (strval($this->Usaha_Bidang_Fashion->EditValue) != "" && is_numeric($this->Usaha_Bidang_Fashion->EditValue)) {
            $this->Usaha_Bidang_Fashion->EditValue = FormatNumber($this->Usaha_Bidang_Fashion->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Pendidikan
        $this->Usaha_Pendidikan->EditAttrs["class"] = "form-control";
        $this->Usaha_Pendidikan->EditCustomAttributes = "";
        $this->Usaha_Pendidikan->EditValue = $this->Usaha_Pendidikan->CurrentValue;
        $this->Usaha_Pendidikan->PlaceHolder = RemoveHtml($this->Usaha_Pendidikan->caption());
        if (strval($this->Usaha_Pendidikan->EditValue) != "" && is_numeric($this->Usaha_Pendidikan->EditValue)) {
            $this->Usaha_Pendidikan->EditValue = FormatNumber($this->Usaha_Pendidikan->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Bidang_Otomotif
        $this->Usaha_Bidang_Otomotif->EditAttrs["class"] = "form-control";
        $this->Usaha_Bidang_Otomotif->EditCustomAttributes = "";
        $this->Usaha_Bidang_Otomotif->EditValue = $this->Usaha_Bidang_Otomotif->CurrentValue;
        $this->Usaha_Bidang_Otomotif->PlaceHolder = RemoveHtml($this->Usaha_Bidang_Otomotif->caption());
        if (strval($this->Usaha_Bidang_Otomotif->EditValue) != "" && is_numeric($this->Usaha_Bidang_Otomotif->EditValue)) {
            $this->Usaha_Bidang_Otomotif->EditValue = FormatNumber($this->Usaha_Bidang_Otomotif->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Kerajinan_Tangan
        $this->Usaha_Kerajinan_Tangan->EditAttrs["class"] = "form-control";
        $this->Usaha_Kerajinan_Tangan->EditCustomAttributes = "";
        $this->Usaha_Kerajinan_Tangan->EditValue = $this->Usaha_Kerajinan_Tangan->CurrentValue;
        $this->Usaha_Kerajinan_Tangan->PlaceHolder = RemoveHtml($this->Usaha_Kerajinan_Tangan->caption());
        if (strval($this->Usaha_Kerajinan_Tangan->EditValue) != "" && is_numeric($this->Usaha_Kerajinan_Tangan->EditValue)) {
            $this->Usaha_Kerajinan_Tangan->EditValue = FormatNumber($this->Usaha_Kerajinan_Tangan->EditValue, -2, -2, -2, -2);
        }

        // Usaha_Elektronik_dan_Gadget
        $this->Usaha_Elektronik_dan_Gadget->EditAttrs["class"] = "form-control";
        $this->Usaha_Elektronik_dan_Gadget->EditCustomAttributes = "";
        $this->Usaha_Elektronik_dan_Gadget->EditValue = $this->Usaha_Elektronik_dan_Gadget->CurrentValue;
        $this->Usaha_Elektronik_dan_Gadget->PlaceHolder = RemoveHtml($this->Usaha_Elektronik_dan_Gadget->caption());
        if (strval($this->Usaha_Elektronik_dan_Gadget->EditValue) != "" && is_numeric($this->Usaha_Elektronik_dan_Gadget->EditValue)) {
            $this->Usaha_Elektronik_dan_Gadget->EditValue = FormatNumber($this->Usaha_Elektronik_dan_Gadget->EditValue, -2, -2, -2, -2);
        }

        // Jenis_Usaha_Lain
        $this->Jenis_Usaha_Lain->EditAttrs["class"] = "form-control";
        $this->Jenis_Usaha_Lain->EditCustomAttributes = "";
        $this->Jenis_Usaha_Lain->EditValue = $this->Jenis_Usaha_Lain->CurrentValue;
        $this->Jenis_Usaha_Lain->PlaceHolder = RemoveHtml($this->Jenis_Usaha_Lain->caption());
        if (strval($this->Jenis_Usaha_Lain->EditValue) != "" && is_numeric($this->Jenis_Usaha_Lain->EditValue)) {
            $this->Jenis_Usaha_Lain->EditValue = FormatNumber($this->Jenis_Usaha_Lain->EditValue, -2, -2, -2, -2);
        }

        // Tenaga_Kerja_Laki_laki
        $this->Tenaga_Kerja_Laki_laki->EditAttrs["class"] = "form-control";
        $this->Tenaga_Kerja_Laki_laki->EditCustomAttributes = "";
        $this->Tenaga_Kerja_Laki_laki->EditValue = $this->Tenaga_Kerja_Laki_laki->CurrentValue;
        $this->Tenaga_Kerja_Laki_laki->PlaceHolder = RemoveHtml($this->Tenaga_Kerja_Laki_laki->caption());
        if (strval($this->Tenaga_Kerja_Laki_laki->EditValue) != "" && is_numeric($this->Tenaga_Kerja_Laki_laki->EditValue)) {
            $this->Tenaga_Kerja_Laki_laki->EditValue = FormatNumber($this->Tenaga_Kerja_Laki_laki->EditValue, -2, -2, -2, -2);
        }

        // Tenaga_Kerja_Perempuan
        $this->Tenaga_Kerja_Perempuan->EditAttrs["class"] = "form-control";
        $this->Tenaga_Kerja_Perempuan->EditCustomAttributes = "";
        $this->Tenaga_Kerja_Perempuan->EditValue = $this->Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Tenaga_Kerja_Perempuan->PlaceHolder = RemoveHtml($this->Tenaga_Kerja_Perempuan->caption());
        if (strval($this->Tenaga_Kerja_Perempuan->EditValue) != "" && is_numeric($this->Tenaga_Kerja_Perempuan->EditValue)) {
            $this->Tenaga_Kerja_Perempuan->EditValue = FormatNumber($this->Tenaga_Kerja_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Tenaga_Kerja
        $this->Jumlah_Tenaga_Kerja->EditAttrs["class"] = "form-control";
        $this->Jumlah_Tenaga_Kerja->EditCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja->EditValue = $this->Jumlah_Tenaga_Kerja->CurrentValue;
        $this->Jumlah_Tenaga_Kerja->PlaceHolder = RemoveHtml($this->Jumlah_Tenaga_Kerja->caption());
        if (strval($this->Jumlah_Tenaga_Kerja->EditValue) != "" && is_numeric($this->Jumlah_Tenaga_Kerja->EditValue)) {
            $this->Jumlah_Tenaga_Kerja->EditValue = FormatNumber($this->Jumlah_Tenaga_Kerja->EditValue, -2, -2, -2, -2);
        }

        // Aset
        $this->Aset->EditAttrs["class"] = "form-control";
        $this->Aset->EditCustomAttributes = "";
        $this->Aset->EditValue = $this->Aset->CurrentValue;
        $this->Aset->PlaceHolder = RemoveHtml($this->Aset->caption());
        if (strval($this->Aset->EditValue) != "" && is_numeric($this->Aset->EditValue)) {
            $this->Aset->EditValue = FormatNumber($this->Aset->EditValue, -2, -2, -2, -2);
        }

        // Omset_Per_Tahun
        $this->Omset_Per_Tahun->EditAttrs["class"] = "form-control";
        $this->Omset_Per_Tahun->EditCustomAttributes = "";
        $this->Omset_Per_Tahun->EditValue = $this->Omset_Per_Tahun->CurrentValue;
        $this->Omset_Per_Tahun->PlaceHolder = RemoveHtml($this->Omset_Per_Tahun->caption());
        if (strval($this->Omset_Per_Tahun->EditValue) != "" && is_numeric($this->Omset_Per_Tahun->EditValue)) {
            $this->Omset_Per_Tahun->EditValue = FormatNumber($this->Omset_Per_Tahun->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->Kapanewon);
                    $doc->exportCaption($this->kapanewon_id);
                    $doc->exportCaption($this->Jumlah);
                    $doc->exportCaption($this->Usaha_Mikro);
                    $doc->exportCaption($this->Usaha_Kecil);
                    $doc->exportCaption($this->Usaha_Menengah);
                    $doc->exportCaption($this->Status_Usaha_Kosong_Salah);
                    $doc->exportCaption($this->Usaha_Pertanian);
                    $doc->exportCaption($this->Usaha_Perdagangan);
                    $doc->exportCaption($this->Usaha_Kuliner);
                    $doc->exportCaption($this->Usaha_Bidang_Fashion);
                    $doc->exportCaption($this->Usaha_Pendidikan);
                    $doc->exportCaption($this->Usaha_Bidang_Otomotif);
                    $doc->exportCaption($this->Usaha_Kerajinan_Tangan);
                    $doc->exportCaption($this->Usaha_Elektronik_dan_Gadget);
                    $doc->exportCaption($this->Jenis_Usaha_Lain);
                    $doc->exportCaption($this->Tenaga_Kerja_Laki_laki);
                    $doc->exportCaption($this->Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja);
                    $doc->exportCaption($this->Aset);
                    $doc->exportCaption($this->Omset_Per_Tahun);
                } else {
                    $doc->exportCaption($this->Kapanewon);
                    $doc->exportCaption($this->kapanewon_id);
                    $doc->exportCaption($this->Jumlah);
                    $doc->exportCaption($this->Usaha_Mikro);
                    $doc->exportCaption($this->Usaha_Kecil);
                    $doc->exportCaption($this->Usaha_Menengah);
                    $doc->exportCaption($this->Status_Usaha_Kosong_Salah);
                    $doc->exportCaption($this->Usaha_Pertanian);
                    $doc->exportCaption($this->Usaha_Perdagangan);
                    $doc->exportCaption($this->Usaha_Kuliner);
                    $doc->exportCaption($this->Usaha_Bidang_Fashion);
                    $doc->exportCaption($this->Usaha_Pendidikan);
                    $doc->exportCaption($this->Usaha_Bidang_Otomotif);
                    $doc->exportCaption($this->Usaha_Kerajinan_Tangan);
                    $doc->exportCaption($this->Usaha_Elektronik_dan_Gadget);
                    $doc->exportCaption($this->Jenis_Usaha_Lain);
                    $doc->exportCaption($this->Tenaga_Kerja_Laki_laki);
                    $doc->exportCaption($this->Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja);
                    $doc->exportCaption($this->Aset);
                    $doc->exportCaption($this->Omset_Per_Tahun);
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
                        $doc->exportField($this->Kapanewon);
                        $doc->exportField($this->kapanewon_id);
                        $doc->exportField($this->Jumlah);
                        $doc->exportField($this->Usaha_Mikro);
                        $doc->exportField($this->Usaha_Kecil);
                        $doc->exportField($this->Usaha_Menengah);
                        $doc->exportField($this->Status_Usaha_Kosong_Salah);
                        $doc->exportField($this->Usaha_Pertanian);
                        $doc->exportField($this->Usaha_Perdagangan);
                        $doc->exportField($this->Usaha_Kuliner);
                        $doc->exportField($this->Usaha_Bidang_Fashion);
                        $doc->exportField($this->Usaha_Pendidikan);
                        $doc->exportField($this->Usaha_Bidang_Otomotif);
                        $doc->exportField($this->Usaha_Kerajinan_Tangan);
                        $doc->exportField($this->Usaha_Elektronik_dan_Gadget);
                        $doc->exportField($this->Jenis_Usaha_Lain);
                        $doc->exportField($this->Tenaga_Kerja_Laki_laki);
                        $doc->exportField($this->Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja);
                        $doc->exportField($this->Aset);
                        $doc->exportField($this->Omset_Per_Tahun);
                    } else {
                        $doc->exportField($this->Kapanewon);
                        $doc->exportField($this->kapanewon_id);
                        $doc->exportField($this->Jumlah);
                        $doc->exportField($this->Usaha_Mikro);
                        $doc->exportField($this->Usaha_Kecil);
                        $doc->exportField($this->Usaha_Menengah);
                        $doc->exportField($this->Status_Usaha_Kosong_Salah);
                        $doc->exportField($this->Usaha_Pertanian);
                        $doc->exportField($this->Usaha_Perdagangan);
                        $doc->exportField($this->Usaha_Kuliner);
                        $doc->exportField($this->Usaha_Bidang_Fashion);
                        $doc->exportField($this->Usaha_Pendidikan);
                        $doc->exportField($this->Usaha_Bidang_Otomotif);
                        $doc->exportField($this->Usaha_Kerajinan_Tangan);
                        $doc->exportField($this->Usaha_Elektronik_dan_Gadget);
                        $doc->exportField($this->Jenis_Usaha_Lain);
                        $doc->exportField($this->Tenaga_Kerja_Laki_laki);
                        $doc->exportField($this->Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja);
                        $doc->exportField($this->Aset);
                        $doc->exportField($this->Omset_Per_Tahun);
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
