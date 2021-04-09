<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for kop_keragaan_bybentuk_ekonomi
 */
class KopKeragaanBybentukEkonomi extends DbTable
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
    public $Tahun_Periode;
    public $Periode;
    public $Bentuk_Ekonomi;
    public $Jumlah_Koperasi;
    public $Aktif;
    public $Pasif;
    public $Jumlah_Anggota;
    public $Anggota_Lakilaki;
    public $Anggota_Perempuan;
    public $Jumlah_Manajer;
    public $Manajer_Lakilaki;
    public $Manajer_Perempuan;
    public $Jumlah_Karyawan;
    public $Karyawan_Lakilaki;
    public $Karyawan_Perempuan;
    public $RAT;
    public $Jumlah_Modal_Sendiri;
    public $Jumlah_Modal_Luar;
    public $Jumlah_Volume_Usaha;
    public $SHU;
    public $Aset;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'kop_keragaan_bybentuk_ekonomi';
        $this->TableName = 'kop_keragaan_bybentuk_ekonomi';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`kop_keragaan_bybentuk_ekonomi`";
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

        // Tahun_Periode
        $this->Tahun_Periode = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Tahun_Periode', 'Tahun_Periode', '`Tahun_Periode`', '`Tahun_Periode`', 3, 4, -1, false, '`Tahun_Periode`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tahun_Periode->Sortable = true; // Allow sort
        $this->Tahun_Periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Tahun_Periode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tahun_Periode->Param, "CustomMsg");
        $this->Fields['Tahun_Periode'] = &$this->Tahun_Periode;

        // Periode
        $this->Periode = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Periode', 'Periode', '`Periode`', '`Periode`', 3, 1, -1, false, '`Periode`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Periode->Sortable = true; // Allow sort
        $this->Periode->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Periode->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Periode->Param, "CustomMsg");
        $this->Fields['Periode'] = &$this->Periode;

        // Bentuk_Ekonomi
        $this->Bentuk_Ekonomi = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Bentuk_Ekonomi', 'Bentuk_Ekonomi', '`Bentuk_Ekonomi`', '`Bentuk_Ekonomi`', 200, 200, -1, false, '`Bentuk_Ekonomi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bentuk_Ekonomi->Sortable = true; // Allow sort
        $this->Bentuk_Ekonomi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bentuk_Ekonomi->Param, "CustomMsg");
        $this->Fields['Bentuk_Ekonomi'] = &$this->Bentuk_Ekonomi;

        // Jumlah_Koperasi
        $this->Jumlah_Koperasi = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Koperasi', 'Jumlah_Koperasi', '`Jumlah_Koperasi`', '`Jumlah_Koperasi`', 5, 23, -1, false, '`Jumlah_Koperasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Koperasi->Sortable = true; // Allow sort
        $this->Jumlah_Koperasi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Koperasi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Koperasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Koperasi->Param, "CustomMsg");
        $this->Fields['Jumlah_Koperasi'] = &$this->Jumlah_Koperasi;

        // Aktif
        $this->Aktif = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Aktif', 'Aktif', '`Aktif`', '`Aktif`', 5, 23, -1, false, '`Aktif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aktif->Sortable = true; // Allow sort
        $this->Aktif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Aktif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Aktif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Aktif->Param, "CustomMsg");
        $this->Fields['Aktif'] = &$this->Aktif;

        // Pasif
        $this->Pasif = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Pasif', 'Pasif', '`Pasif`', '`Pasif`', 5, 23, -1, false, '`Pasif`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Pasif->Sortable = true; // Allow sort
        $this->Pasif->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Pasif->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Pasif->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pasif->Param, "CustomMsg");
        $this->Fields['Pasif'] = &$this->Pasif;

        // Jumlah_Anggota
        $this->Jumlah_Anggota = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Anggota', 'Jumlah_Anggota', '`Jumlah_Anggota`', '`Jumlah_Anggota`', 131, 32, -1, false, '`Jumlah_Anggota`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Anggota->Sortable = true; // Allow sort
        $this->Jumlah_Anggota->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Anggota->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Anggota->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Anggota->Param, "CustomMsg");
        $this->Fields['Jumlah_Anggota'] = &$this->Jumlah_Anggota;

        // Anggota_Laki-laki
        $this->Anggota_Lakilaki = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Anggota_Lakilaki', 'Anggota_Laki-laki', '`Anggota_Laki-laki`', '`Anggota_Laki-laki`', 131, 32, -1, false, '`Anggota_Laki-laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Anggota_Lakilaki->Sortable = true; // Allow sort
        $this->Anggota_Lakilaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Anggota_Lakilaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Anggota_Lakilaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Anggota_Lakilaki->Param, "CustomMsg");
        $this->Fields['Anggota_Laki-laki'] = &$this->Anggota_Lakilaki;

        // Anggota_Perempuan
        $this->Anggota_Perempuan = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Anggota_Perempuan', 'Anggota_Perempuan', '`Anggota_Perempuan`', '`Anggota_Perempuan`', 131, 32, -1, false, '`Anggota_Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Anggota_Perempuan->Sortable = true; // Allow sort
        $this->Anggota_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Anggota_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Anggota_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Anggota_Perempuan->Param, "CustomMsg");
        $this->Fields['Anggota_Perempuan'] = &$this->Anggota_Perempuan;

        // Jumlah_Manajer
        $this->Jumlah_Manajer = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Manajer', 'Jumlah_Manajer', '`Jumlah_Manajer`', '`Jumlah_Manajer`', 131, 32, -1, false, '`Jumlah_Manajer`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Manajer->Sortable = true; // Allow sort
        $this->Jumlah_Manajer->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Manajer->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Manajer->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Manajer->Param, "CustomMsg");
        $this->Fields['Jumlah_Manajer'] = &$this->Jumlah_Manajer;

        // Manajer_Laki-laki
        $this->Manajer_Lakilaki = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Manajer_Lakilaki', 'Manajer_Laki-laki', '`Manajer_Laki-laki`', '`Manajer_Laki-laki`', 131, 32, -1, false, '`Manajer_Laki-laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Manajer_Lakilaki->Sortable = true; // Allow sort
        $this->Manajer_Lakilaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Manajer_Lakilaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Manajer_Lakilaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Manajer_Lakilaki->Param, "CustomMsg");
        $this->Fields['Manajer_Laki-laki'] = &$this->Manajer_Lakilaki;

        // Manajer_Perempuan
        $this->Manajer_Perempuan = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Manajer_Perempuan', 'Manajer_Perempuan', '`Manajer_Perempuan`', '`Manajer_Perempuan`', 131, 32, -1, false, '`Manajer_Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Manajer_Perempuan->Sortable = true; // Allow sort
        $this->Manajer_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Manajer_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Manajer_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Manajer_Perempuan->Param, "CustomMsg");
        $this->Fields['Manajer_Perempuan'] = &$this->Manajer_Perempuan;

        // Jumlah_Karyawan
        $this->Jumlah_Karyawan = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Karyawan', 'Jumlah_Karyawan', '`Jumlah_Karyawan`', '`Jumlah_Karyawan`', 131, 32, -1, false, '`Jumlah_Karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Karyawan->Sortable = true; // Allow sort
        $this->Jumlah_Karyawan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Karyawan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Karyawan->Param, "CustomMsg");
        $this->Fields['Jumlah_Karyawan'] = &$this->Jumlah_Karyawan;

        // Karyawan_Laki-laki
        $this->Karyawan_Lakilaki = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Karyawan_Lakilaki', 'Karyawan_Laki-laki', '`Karyawan_Laki-laki`', '`Karyawan_Laki-laki`', 131, 32, -1, false, '`Karyawan_Laki-laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Karyawan_Lakilaki->Sortable = true; // Allow sort
        $this->Karyawan_Lakilaki->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Karyawan_Lakilaki->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Karyawan_Lakilaki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Karyawan_Lakilaki->Param, "CustomMsg");
        $this->Fields['Karyawan_Laki-laki'] = &$this->Karyawan_Lakilaki;

        // Karyawan_Perempuan
        $this->Karyawan_Perempuan = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Karyawan_Perempuan', 'Karyawan_Perempuan', '`Karyawan_Perempuan`', '`Karyawan_Perempuan`', 131, 32, -1, false, '`Karyawan_Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Karyawan_Perempuan->Sortable = true; // Allow sort
        $this->Karyawan_Perempuan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Karyawan_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Karyawan_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Karyawan_Perempuan->Param, "CustomMsg");
        $this->Fields['Karyawan_Perempuan'] = &$this->Karyawan_Perempuan;

        // RAT
        $this->RAT = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_RAT', 'RAT', '`RAT`', '`RAT`', 131, 22, -1, false, '`RAT`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->RAT->Sortable = true; // Allow sort
        $this->RAT->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->RAT->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->RAT->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->RAT->Param, "CustomMsg");
        $this->Fields['RAT'] = &$this->RAT;

        // Jumlah_Modal_Sendiri
        $this->Jumlah_Modal_Sendiri = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Modal_Sendiri', 'Jumlah_Modal_Sendiri', '`Jumlah_Modal_Sendiri`', '`Jumlah_Modal_Sendiri`', 5, 23, -1, false, '`Jumlah_Modal_Sendiri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Modal_Sendiri->Sortable = true; // Allow sort
        $this->Jumlah_Modal_Sendiri->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Modal_Sendiri->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Modal_Sendiri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Modal_Sendiri->Param, "CustomMsg");
        $this->Fields['Jumlah_Modal_Sendiri'] = &$this->Jumlah_Modal_Sendiri;

        // Jumlah_Modal_Luar
        $this->Jumlah_Modal_Luar = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Modal_Luar', 'Jumlah_Modal_Luar', '`Jumlah_Modal_Luar`', '`Jumlah_Modal_Luar`', 5, 23, -1, false, '`Jumlah_Modal_Luar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Modal_Luar->Sortable = true; // Allow sort
        $this->Jumlah_Modal_Luar->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Modal_Luar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Modal_Luar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Modal_Luar->Param, "CustomMsg");
        $this->Fields['Jumlah_Modal_Luar'] = &$this->Jumlah_Modal_Luar;

        // Jumlah_Volume_Usaha
        $this->Jumlah_Volume_Usaha = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Jumlah_Volume_Usaha', 'Jumlah_Volume_Usaha', '`Jumlah_Volume_Usaha`', '`Jumlah_Volume_Usaha`', 5, 23, -1, false, '`Jumlah_Volume_Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Volume_Usaha->Sortable = true; // Allow sort
        $this->Jumlah_Volume_Usaha->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Volume_Usaha->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Volume_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Volume_Usaha->Param, "CustomMsg");
        $this->Fields['Jumlah_Volume_Usaha'] = &$this->Jumlah_Volume_Usaha;

        // SHU
        $this->SHU = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_SHU', 'SHU', '`SHU`', '`SHU`', 5, 23, -1, false, '`SHU`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->SHU->Sortable = true; // Allow sort
        $this->SHU->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->SHU->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->SHU->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->SHU->Param, "CustomMsg");
        $this->Fields['SHU'] = &$this->SHU;

        // Aset
        $this->Aset = new DbField('kop_keragaan_bybentuk_ekonomi', 'kop_keragaan_bybentuk_ekonomi', 'x_Aset', 'Aset', '`Aset`', '`Aset`', 5, 23, -1, false, '`Aset`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aset->Sortable = true; // Allow sort
        $this->Aset->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Aset->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Aset->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Aset->Param, "CustomMsg");
        $this->Fields['Aset'] = &$this->Aset;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`kop_keragaan_bybentuk_ekonomi`";
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
        $this->Tahun_Periode->DbValue = $row['Tahun_Periode'];
        $this->Periode->DbValue = $row['Periode'];
        $this->Bentuk_Ekonomi->DbValue = $row['Bentuk_Ekonomi'];
        $this->Jumlah_Koperasi->DbValue = $row['Jumlah_Koperasi'];
        $this->Aktif->DbValue = $row['Aktif'];
        $this->Pasif->DbValue = $row['Pasif'];
        $this->Jumlah_Anggota->DbValue = $row['Jumlah_Anggota'];
        $this->Anggota_Lakilaki->DbValue = $row['Anggota_Laki-laki'];
        $this->Anggota_Perempuan->DbValue = $row['Anggota_Perempuan'];
        $this->Jumlah_Manajer->DbValue = $row['Jumlah_Manajer'];
        $this->Manajer_Lakilaki->DbValue = $row['Manajer_Laki-laki'];
        $this->Manajer_Perempuan->DbValue = $row['Manajer_Perempuan'];
        $this->Jumlah_Karyawan->DbValue = $row['Jumlah_Karyawan'];
        $this->Karyawan_Lakilaki->DbValue = $row['Karyawan_Laki-laki'];
        $this->Karyawan_Perempuan->DbValue = $row['Karyawan_Perempuan'];
        $this->RAT->DbValue = $row['RAT'];
        $this->Jumlah_Modal_Sendiri->DbValue = $row['Jumlah_Modal_Sendiri'];
        $this->Jumlah_Modal_Luar->DbValue = $row['Jumlah_Modal_Luar'];
        $this->Jumlah_Volume_Usaha->DbValue = $row['Jumlah_Volume_Usaha'];
        $this->SHU->DbValue = $row['SHU'];
        $this->Aset->DbValue = $row['Aset'];
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
        return $_SESSION[$name] ?? GetUrl("kopkeragaanbybentukekonomilist");
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
        if ($pageName == "kopkeragaanbybentukekonomiview") {
            return $Language->phrase("View");
        } elseif ($pageName == "kopkeragaanbybentukekonomiedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "kopkeragaanbybentukekonomiadd") {
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
                return "KopKeragaanBybentukEkonomiView";
            case Config("API_ADD_ACTION"):
                return "KopKeragaanBybentukEkonomiAdd";
            case Config("API_EDIT_ACTION"):
                return "KopKeragaanBybentukEkonomiEdit";
            case Config("API_DELETE_ACTION"):
                return "KopKeragaanBybentukEkonomiDelete";
            case Config("API_LIST_ACTION"):
                return "KopKeragaanBybentukEkonomiList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "kopkeragaanbybentukekonomilist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("kopkeragaanbybentukekonomiview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("kopkeragaanbybentukekonomiview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "kopkeragaanbybentukekonomiadd?" . $this->getUrlParm($parm);
        } else {
            $url = "kopkeragaanbybentukekonomiadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("kopkeragaanbybentukekonomiedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("kopkeragaanbybentukekonomiadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("kopkeragaanbybentukekonomidelete", $this->getUrlParm());
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
        $this->Tahun_Periode->setDbValue($row['Tahun_Periode']);
        $this->Periode->setDbValue($row['Periode']);
        $this->Bentuk_Ekonomi->setDbValue($row['Bentuk_Ekonomi']);
        $this->Jumlah_Koperasi->setDbValue($row['Jumlah_Koperasi']);
        $this->Aktif->setDbValue($row['Aktif']);
        $this->Pasif->setDbValue($row['Pasif']);
        $this->Jumlah_Anggota->setDbValue($row['Jumlah_Anggota']);
        $this->Anggota_Lakilaki->setDbValue($row['Anggota_Laki-laki']);
        $this->Anggota_Perempuan->setDbValue($row['Anggota_Perempuan']);
        $this->Jumlah_Manajer->setDbValue($row['Jumlah_Manajer']);
        $this->Manajer_Lakilaki->setDbValue($row['Manajer_Laki-laki']);
        $this->Manajer_Perempuan->setDbValue($row['Manajer_Perempuan']);
        $this->Jumlah_Karyawan->setDbValue($row['Jumlah_Karyawan']);
        $this->Karyawan_Lakilaki->setDbValue($row['Karyawan_Laki-laki']);
        $this->Karyawan_Perempuan->setDbValue($row['Karyawan_Perempuan']);
        $this->RAT->setDbValue($row['RAT']);
        $this->Jumlah_Modal_Sendiri->setDbValue($row['Jumlah_Modal_Sendiri']);
        $this->Jumlah_Modal_Luar->setDbValue($row['Jumlah_Modal_Luar']);
        $this->Jumlah_Volume_Usaha->setDbValue($row['Jumlah_Volume_Usaha']);
        $this->SHU->setDbValue($row['SHU']);
        $this->Aset->setDbValue($row['Aset']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // Tahun_Periode

        // Periode

        // Bentuk_Ekonomi

        // Jumlah_Koperasi

        // Aktif

        // Pasif

        // Jumlah_Anggota

        // Anggota_Laki-laki

        // Anggota_Perempuan

        // Jumlah_Manajer

        // Manajer_Laki-laki

        // Manajer_Perempuan

        // Jumlah_Karyawan

        // Karyawan_Laki-laki

        // Karyawan_Perempuan

        // RAT

        // Jumlah_Modal_Sendiri

        // Jumlah_Modal_Luar

        // Jumlah_Volume_Usaha

        // SHU

        // Aset

        // Tahun_Periode
        $this->Tahun_Periode->ViewValue = $this->Tahun_Periode->CurrentValue;
        $this->Tahun_Periode->ViewValue = FormatNumber($this->Tahun_Periode->ViewValue, 0, -2, -2, -2);
        $this->Tahun_Periode->ViewCustomAttributes = "";

        // Periode
        $this->Periode->ViewValue = $this->Periode->CurrentValue;
        $this->Periode->ViewValue = FormatNumber($this->Periode->ViewValue, 0, -2, -2, -2);
        $this->Periode->ViewCustomAttributes = "";

        // Bentuk_Ekonomi
        $this->Bentuk_Ekonomi->ViewValue = $this->Bentuk_Ekonomi->CurrentValue;
        $this->Bentuk_Ekonomi->ViewCustomAttributes = "";

        // Jumlah_Koperasi
        $this->Jumlah_Koperasi->ViewValue = $this->Jumlah_Koperasi->CurrentValue;
        $this->Jumlah_Koperasi->ViewValue = FormatNumber($this->Jumlah_Koperasi->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Koperasi->ViewCustomAttributes = "";

        // Aktif
        $this->Aktif->ViewValue = $this->Aktif->CurrentValue;
        $this->Aktif->ViewValue = FormatNumber($this->Aktif->ViewValue, 2, -2, -2, -2);
        $this->Aktif->ViewCustomAttributes = "";

        // Pasif
        $this->Pasif->ViewValue = $this->Pasif->CurrentValue;
        $this->Pasif->ViewValue = FormatNumber($this->Pasif->ViewValue, 2, -2, -2, -2);
        $this->Pasif->ViewCustomAttributes = "";

        // Jumlah_Anggota
        $this->Jumlah_Anggota->ViewValue = $this->Jumlah_Anggota->CurrentValue;
        $this->Jumlah_Anggota->ViewValue = FormatNumber($this->Jumlah_Anggota->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Anggota->ViewCustomAttributes = "";

        // Anggota_Laki-laki
        $this->Anggota_Lakilaki->ViewValue = $this->Anggota_Lakilaki->CurrentValue;
        $this->Anggota_Lakilaki->ViewValue = FormatNumber($this->Anggota_Lakilaki->ViewValue, 2, -2, -2, -2);
        $this->Anggota_Lakilaki->ViewCustomAttributes = "";

        // Anggota_Perempuan
        $this->Anggota_Perempuan->ViewValue = $this->Anggota_Perempuan->CurrentValue;
        $this->Anggota_Perempuan->ViewValue = FormatNumber($this->Anggota_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Anggota_Perempuan->ViewCustomAttributes = "";

        // Jumlah_Manajer
        $this->Jumlah_Manajer->ViewValue = $this->Jumlah_Manajer->CurrentValue;
        $this->Jumlah_Manajer->ViewValue = FormatNumber($this->Jumlah_Manajer->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Manajer->ViewCustomAttributes = "";

        // Manajer_Laki-laki
        $this->Manajer_Lakilaki->ViewValue = $this->Manajer_Lakilaki->CurrentValue;
        $this->Manajer_Lakilaki->ViewValue = FormatNumber($this->Manajer_Lakilaki->ViewValue, 2, -2, -2, -2);
        $this->Manajer_Lakilaki->ViewCustomAttributes = "";

        // Manajer_Perempuan
        $this->Manajer_Perempuan->ViewValue = $this->Manajer_Perempuan->CurrentValue;
        $this->Manajer_Perempuan->ViewValue = FormatNumber($this->Manajer_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Manajer_Perempuan->ViewCustomAttributes = "";

        // Jumlah_Karyawan
        $this->Jumlah_Karyawan->ViewValue = $this->Jumlah_Karyawan->CurrentValue;
        $this->Jumlah_Karyawan->ViewValue = FormatNumber($this->Jumlah_Karyawan->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Karyawan->ViewCustomAttributes = "";

        // Karyawan_Laki-laki
        $this->Karyawan_Lakilaki->ViewValue = $this->Karyawan_Lakilaki->CurrentValue;
        $this->Karyawan_Lakilaki->ViewValue = FormatNumber($this->Karyawan_Lakilaki->ViewValue, 2, -2, -2, -2);
        $this->Karyawan_Lakilaki->ViewCustomAttributes = "";

        // Karyawan_Perempuan
        $this->Karyawan_Perempuan->ViewValue = $this->Karyawan_Perempuan->CurrentValue;
        $this->Karyawan_Perempuan->ViewValue = FormatNumber($this->Karyawan_Perempuan->ViewValue, 2, -2, -2, -2);
        $this->Karyawan_Perempuan->ViewCustomAttributes = "";

        // RAT
        $this->RAT->ViewValue = $this->RAT->CurrentValue;
        $this->RAT->ViewValue = FormatNumber($this->RAT->ViewValue, 2, -2, -2, -2);
        $this->RAT->ViewCustomAttributes = "";

        // Jumlah_Modal_Sendiri
        $this->Jumlah_Modal_Sendiri->ViewValue = $this->Jumlah_Modal_Sendiri->CurrentValue;
        $this->Jumlah_Modal_Sendiri->ViewValue = FormatNumber($this->Jumlah_Modal_Sendiri->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Modal_Sendiri->ViewCustomAttributes = "";

        // Jumlah_Modal_Luar
        $this->Jumlah_Modal_Luar->ViewValue = $this->Jumlah_Modal_Luar->CurrentValue;
        $this->Jumlah_Modal_Luar->ViewValue = FormatNumber($this->Jumlah_Modal_Luar->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Modal_Luar->ViewCustomAttributes = "";

        // Jumlah_Volume_Usaha
        $this->Jumlah_Volume_Usaha->ViewValue = $this->Jumlah_Volume_Usaha->CurrentValue;
        $this->Jumlah_Volume_Usaha->ViewValue = FormatNumber($this->Jumlah_Volume_Usaha->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Volume_Usaha->ViewCustomAttributes = "";

        // SHU
        $this->SHU->ViewValue = $this->SHU->CurrentValue;
        $this->SHU->ViewValue = FormatNumber($this->SHU->ViewValue, 2, -2, -2, -2);
        $this->SHU->ViewCustomAttributes = "";

        // Aset
        $this->Aset->ViewValue = $this->Aset->CurrentValue;
        $this->Aset->ViewValue = FormatNumber($this->Aset->ViewValue, 2, -2, -2, -2);
        $this->Aset->ViewCustomAttributes = "";

        // Tahun_Periode
        $this->Tahun_Periode->LinkCustomAttributes = "";
        $this->Tahun_Periode->HrefValue = "";
        $this->Tahun_Periode->TooltipValue = "";

        // Periode
        $this->Periode->LinkCustomAttributes = "";
        $this->Periode->HrefValue = "";
        $this->Periode->TooltipValue = "";

        // Bentuk_Ekonomi
        $this->Bentuk_Ekonomi->LinkCustomAttributes = "";
        $this->Bentuk_Ekonomi->HrefValue = "";
        $this->Bentuk_Ekonomi->TooltipValue = "";

        // Jumlah_Koperasi
        $this->Jumlah_Koperasi->LinkCustomAttributes = "";
        $this->Jumlah_Koperasi->HrefValue = "";
        $this->Jumlah_Koperasi->TooltipValue = "";

        // Aktif
        $this->Aktif->LinkCustomAttributes = "";
        $this->Aktif->HrefValue = "";
        $this->Aktif->TooltipValue = "";

        // Pasif
        $this->Pasif->LinkCustomAttributes = "";
        $this->Pasif->HrefValue = "";
        $this->Pasif->TooltipValue = "";

        // Jumlah_Anggota
        $this->Jumlah_Anggota->LinkCustomAttributes = "";
        $this->Jumlah_Anggota->HrefValue = "";
        $this->Jumlah_Anggota->TooltipValue = "";

        // Anggota_Laki-laki
        $this->Anggota_Lakilaki->LinkCustomAttributes = "";
        $this->Anggota_Lakilaki->HrefValue = "";
        $this->Anggota_Lakilaki->TooltipValue = "";

        // Anggota_Perempuan
        $this->Anggota_Perempuan->LinkCustomAttributes = "";
        $this->Anggota_Perempuan->HrefValue = "";
        $this->Anggota_Perempuan->TooltipValue = "";

        // Jumlah_Manajer
        $this->Jumlah_Manajer->LinkCustomAttributes = "";
        $this->Jumlah_Manajer->HrefValue = "";
        $this->Jumlah_Manajer->TooltipValue = "";

        // Manajer_Laki-laki
        $this->Manajer_Lakilaki->LinkCustomAttributes = "";
        $this->Manajer_Lakilaki->HrefValue = "";
        $this->Manajer_Lakilaki->TooltipValue = "";

        // Manajer_Perempuan
        $this->Manajer_Perempuan->LinkCustomAttributes = "";
        $this->Manajer_Perempuan->HrefValue = "";
        $this->Manajer_Perempuan->TooltipValue = "";

        // Jumlah_Karyawan
        $this->Jumlah_Karyawan->LinkCustomAttributes = "";
        $this->Jumlah_Karyawan->HrefValue = "";
        $this->Jumlah_Karyawan->TooltipValue = "";

        // Karyawan_Laki-laki
        $this->Karyawan_Lakilaki->LinkCustomAttributes = "";
        $this->Karyawan_Lakilaki->HrefValue = "";
        $this->Karyawan_Lakilaki->TooltipValue = "";

        // Karyawan_Perempuan
        $this->Karyawan_Perempuan->LinkCustomAttributes = "";
        $this->Karyawan_Perempuan->HrefValue = "";
        $this->Karyawan_Perempuan->TooltipValue = "";

        // RAT
        $this->RAT->LinkCustomAttributes = "";
        $this->RAT->HrefValue = "";
        $this->RAT->TooltipValue = "";

        // Jumlah_Modal_Sendiri
        $this->Jumlah_Modal_Sendiri->LinkCustomAttributes = "";
        $this->Jumlah_Modal_Sendiri->HrefValue = "";
        $this->Jumlah_Modal_Sendiri->TooltipValue = "";

        // Jumlah_Modal_Luar
        $this->Jumlah_Modal_Luar->LinkCustomAttributes = "";
        $this->Jumlah_Modal_Luar->HrefValue = "";
        $this->Jumlah_Modal_Luar->TooltipValue = "";

        // Jumlah_Volume_Usaha
        $this->Jumlah_Volume_Usaha->LinkCustomAttributes = "";
        $this->Jumlah_Volume_Usaha->HrefValue = "";
        $this->Jumlah_Volume_Usaha->TooltipValue = "";

        // SHU
        $this->SHU->LinkCustomAttributes = "";
        $this->SHU->HrefValue = "";
        $this->SHU->TooltipValue = "";

        // Aset
        $this->Aset->LinkCustomAttributes = "";
        $this->Aset->HrefValue = "";
        $this->Aset->TooltipValue = "";

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

        // Tahun_Periode
        $this->Tahun_Periode->EditAttrs["class"] = "form-control";
        $this->Tahun_Periode->EditCustomAttributes = "";
        $this->Tahun_Periode->EditValue = $this->Tahun_Periode->CurrentValue;
        $this->Tahun_Periode->PlaceHolder = RemoveHtml($this->Tahun_Periode->caption());

        // Periode
        $this->Periode->EditAttrs["class"] = "form-control";
        $this->Periode->EditCustomAttributes = "";
        $this->Periode->EditValue = $this->Periode->CurrentValue;
        $this->Periode->PlaceHolder = RemoveHtml($this->Periode->caption());

        // Bentuk_Ekonomi
        $this->Bentuk_Ekonomi->EditAttrs["class"] = "form-control";
        $this->Bentuk_Ekonomi->EditCustomAttributes = "";
        if (!$this->Bentuk_Ekonomi->Raw) {
            $this->Bentuk_Ekonomi->CurrentValue = HtmlDecode($this->Bentuk_Ekonomi->CurrentValue);
        }
        $this->Bentuk_Ekonomi->EditValue = $this->Bentuk_Ekonomi->CurrentValue;
        $this->Bentuk_Ekonomi->PlaceHolder = RemoveHtml($this->Bentuk_Ekonomi->caption());

        // Jumlah_Koperasi
        $this->Jumlah_Koperasi->EditAttrs["class"] = "form-control";
        $this->Jumlah_Koperasi->EditCustomAttributes = "";
        $this->Jumlah_Koperasi->EditValue = $this->Jumlah_Koperasi->CurrentValue;
        $this->Jumlah_Koperasi->PlaceHolder = RemoveHtml($this->Jumlah_Koperasi->caption());
        if (strval($this->Jumlah_Koperasi->EditValue) != "" && is_numeric($this->Jumlah_Koperasi->EditValue)) {
            $this->Jumlah_Koperasi->EditValue = FormatNumber($this->Jumlah_Koperasi->EditValue, -2, -2, -2, -2);
        }

        // Aktif
        $this->Aktif->EditAttrs["class"] = "form-control";
        $this->Aktif->EditCustomAttributes = "";
        $this->Aktif->EditValue = $this->Aktif->CurrentValue;
        $this->Aktif->PlaceHolder = RemoveHtml($this->Aktif->caption());
        if (strval($this->Aktif->EditValue) != "" && is_numeric($this->Aktif->EditValue)) {
            $this->Aktif->EditValue = FormatNumber($this->Aktif->EditValue, -2, -2, -2, -2);
        }

        // Pasif
        $this->Pasif->EditAttrs["class"] = "form-control";
        $this->Pasif->EditCustomAttributes = "";
        $this->Pasif->EditValue = $this->Pasif->CurrentValue;
        $this->Pasif->PlaceHolder = RemoveHtml($this->Pasif->caption());
        if (strval($this->Pasif->EditValue) != "" && is_numeric($this->Pasif->EditValue)) {
            $this->Pasif->EditValue = FormatNumber($this->Pasif->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Anggota
        $this->Jumlah_Anggota->EditAttrs["class"] = "form-control";
        $this->Jumlah_Anggota->EditCustomAttributes = "";
        $this->Jumlah_Anggota->EditValue = $this->Jumlah_Anggota->CurrentValue;
        $this->Jumlah_Anggota->PlaceHolder = RemoveHtml($this->Jumlah_Anggota->caption());
        if (strval($this->Jumlah_Anggota->EditValue) != "" && is_numeric($this->Jumlah_Anggota->EditValue)) {
            $this->Jumlah_Anggota->EditValue = FormatNumber($this->Jumlah_Anggota->EditValue, -2, -2, -2, -2);
        }

        // Anggota_Laki-laki
        $this->Anggota_Lakilaki->EditAttrs["class"] = "form-control";
        $this->Anggota_Lakilaki->EditCustomAttributes = "";
        $this->Anggota_Lakilaki->EditValue = $this->Anggota_Lakilaki->CurrentValue;
        $this->Anggota_Lakilaki->PlaceHolder = RemoveHtml($this->Anggota_Lakilaki->caption());
        if (strval($this->Anggota_Lakilaki->EditValue) != "" && is_numeric($this->Anggota_Lakilaki->EditValue)) {
            $this->Anggota_Lakilaki->EditValue = FormatNumber($this->Anggota_Lakilaki->EditValue, -2, -2, -2, -2);
        }

        // Anggota_Perempuan
        $this->Anggota_Perempuan->EditAttrs["class"] = "form-control";
        $this->Anggota_Perempuan->EditCustomAttributes = "";
        $this->Anggota_Perempuan->EditValue = $this->Anggota_Perempuan->CurrentValue;
        $this->Anggota_Perempuan->PlaceHolder = RemoveHtml($this->Anggota_Perempuan->caption());
        if (strval($this->Anggota_Perempuan->EditValue) != "" && is_numeric($this->Anggota_Perempuan->EditValue)) {
            $this->Anggota_Perempuan->EditValue = FormatNumber($this->Anggota_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Manajer
        $this->Jumlah_Manajer->EditAttrs["class"] = "form-control";
        $this->Jumlah_Manajer->EditCustomAttributes = "";
        $this->Jumlah_Manajer->EditValue = $this->Jumlah_Manajer->CurrentValue;
        $this->Jumlah_Manajer->PlaceHolder = RemoveHtml($this->Jumlah_Manajer->caption());
        if (strval($this->Jumlah_Manajer->EditValue) != "" && is_numeric($this->Jumlah_Manajer->EditValue)) {
            $this->Jumlah_Manajer->EditValue = FormatNumber($this->Jumlah_Manajer->EditValue, -2, -2, -2, -2);
        }

        // Manajer_Laki-laki
        $this->Manajer_Lakilaki->EditAttrs["class"] = "form-control";
        $this->Manajer_Lakilaki->EditCustomAttributes = "";
        $this->Manajer_Lakilaki->EditValue = $this->Manajer_Lakilaki->CurrentValue;
        $this->Manajer_Lakilaki->PlaceHolder = RemoveHtml($this->Manajer_Lakilaki->caption());
        if (strval($this->Manajer_Lakilaki->EditValue) != "" && is_numeric($this->Manajer_Lakilaki->EditValue)) {
            $this->Manajer_Lakilaki->EditValue = FormatNumber($this->Manajer_Lakilaki->EditValue, -2, -2, -2, -2);
        }

        // Manajer_Perempuan
        $this->Manajer_Perempuan->EditAttrs["class"] = "form-control";
        $this->Manajer_Perempuan->EditCustomAttributes = "";
        $this->Manajer_Perempuan->EditValue = $this->Manajer_Perempuan->CurrentValue;
        $this->Manajer_Perempuan->PlaceHolder = RemoveHtml($this->Manajer_Perempuan->caption());
        if (strval($this->Manajer_Perempuan->EditValue) != "" && is_numeric($this->Manajer_Perempuan->EditValue)) {
            $this->Manajer_Perempuan->EditValue = FormatNumber($this->Manajer_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Karyawan
        $this->Jumlah_Karyawan->EditAttrs["class"] = "form-control";
        $this->Jumlah_Karyawan->EditCustomAttributes = "";
        $this->Jumlah_Karyawan->EditValue = $this->Jumlah_Karyawan->CurrentValue;
        $this->Jumlah_Karyawan->PlaceHolder = RemoveHtml($this->Jumlah_Karyawan->caption());
        if (strval($this->Jumlah_Karyawan->EditValue) != "" && is_numeric($this->Jumlah_Karyawan->EditValue)) {
            $this->Jumlah_Karyawan->EditValue = FormatNumber($this->Jumlah_Karyawan->EditValue, -2, -2, -2, -2);
        }

        // Karyawan_Laki-laki
        $this->Karyawan_Lakilaki->EditAttrs["class"] = "form-control";
        $this->Karyawan_Lakilaki->EditCustomAttributes = "";
        $this->Karyawan_Lakilaki->EditValue = $this->Karyawan_Lakilaki->CurrentValue;
        $this->Karyawan_Lakilaki->PlaceHolder = RemoveHtml($this->Karyawan_Lakilaki->caption());
        if (strval($this->Karyawan_Lakilaki->EditValue) != "" && is_numeric($this->Karyawan_Lakilaki->EditValue)) {
            $this->Karyawan_Lakilaki->EditValue = FormatNumber($this->Karyawan_Lakilaki->EditValue, -2, -2, -2, -2);
        }

        // Karyawan_Perempuan
        $this->Karyawan_Perempuan->EditAttrs["class"] = "form-control";
        $this->Karyawan_Perempuan->EditCustomAttributes = "";
        $this->Karyawan_Perempuan->EditValue = $this->Karyawan_Perempuan->CurrentValue;
        $this->Karyawan_Perempuan->PlaceHolder = RemoveHtml($this->Karyawan_Perempuan->caption());
        if (strval($this->Karyawan_Perempuan->EditValue) != "" && is_numeric($this->Karyawan_Perempuan->EditValue)) {
            $this->Karyawan_Perempuan->EditValue = FormatNumber($this->Karyawan_Perempuan->EditValue, -2, -2, -2, -2);
        }

        // RAT
        $this->RAT->EditAttrs["class"] = "form-control";
        $this->RAT->EditCustomAttributes = "";
        $this->RAT->EditValue = $this->RAT->CurrentValue;
        $this->RAT->PlaceHolder = RemoveHtml($this->RAT->caption());
        if (strval($this->RAT->EditValue) != "" && is_numeric($this->RAT->EditValue)) {
            $this->RAT->EditValue = FormatNumber($this->RAT->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Modal_Sendiri
        $this->Jumlah_Modal_Sendiri->EditAttrs["class"] = "form-control";
        $this->Jumlah_Modal_Sendiri->EditCustomAttributes = "";
        $this->Jumlah_Modal_Sendiri->EditValue = $this->Jumlah_Modal_Sendiri->CurrentValue;
        $this->Jumlah_Modal_Sendiri->PlaceHolder = RemoveHtml($this->Jumlah_Modal_Sendiri->caption());
        if (strval($this->Jumlah_Modal_Sendiri->EditValue) != "" && is_numeric($this->Jumlah_Modal_Sendiri->EditValue)) {
            $this->Jumlah_Modal_Sendiri->EditValue = FormatNumber($this->Jumlah_Modal_Sendiri->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Modal_Luar
        $this->Jumlah_Modal_Luar->EditAttrs["class"] = "form-control";
        $this->Jumlah_Modal_Luar->EditCustomAttributes = "";
        $this->Jumlah_Modal_Luar->EditValue = $this->Jumlah_Modal_Luar->CurrentValue;
        $this->Jumlah_Modal_Luar->PlaceHolder = RemoveHtml($this->Jumlah_Modal_Luar->caption());
        if (strval($this->Jumlah_Modal_Luar->EditValue) != "" && is_numeric($this->Jumlah_Modal_Luar->EditValue)) {
            $this->Jumlah_Modal_Luar->EditValue = FormatNumber($this->Jumlah_Modal_Luar->EditValue, -2, -2, -2, -2);
        }

        // Jumlah_Volume_Usaha
        $this->Jumlah_Volume_Usaha->EditAttrs["class"] = "form-control";
        $this->Jumlah_Volume_Usaha->EditCustomAttributes = "";
        $this->Jumlah_Volume_Usaha->EditValue = $this->Jumlah_Volume_Usaha->CurrentValue;
        $this->Jumlah_Volume_Usaha->PlaceHolder = RemoveHtml($this->Jumlah_Volume_Usaha->caption());
        if (strval($this->Jumlah_Volume_Usaha->EditValue) != "" && is_numeric($this->Jumlah_Volume_Usaha->EditValue)) {
            $this->Jumlah_Volume_Usaha->EditValue = FormatNumber($this->Jumlah_Volume_Usaha->EditValue, -2, -2, -2, -2);
        }

        // SHU
        $this->SHU->EditAttrs["class"] = "form-control";
        $this->SHU->EditCustomAttributes = "";
        $this->SHU->EditValue = $this->SHU->CurrentValue;
        $this->SHU->PlaceHolder = RemoveHtml($this->SHU->caption());
        if (strval($this->SHU->EditValue) != "" && is_numeric($this->SHU->EditValue)) {
            $this->SHU->EditValue = FormatNumber($this->SHU->EditValue, -2, -2, -2, -2);
        }

        // Aset
        $this->Aset->EditAttrs["class"] = "form-control";
        $this->Aset->EditCustomAttributes = "";
        $this->Aset->EditValue = $this->Aset->CurrentValue;
        $this->Aset->PlaceHolder = RemoveHtml($this->Aset->caption());
        if (strval($this->Aset->EditValue) != "" && is_numeric($this->Aset->EditValue)) {
            $this->Aset->EditValue = FormatNumber($this->Aset->EditValue, -2, -2, -2, -2);
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
                    $doc->exportCaption($this->Tahun_Periode);
                    $doc->exportCaption($this->Periode);
                    $doc->exportCaption($this->Bentuk_Ekonomi);
                    $doc->exportCaption($this->Jumlah_Koperasi);
                    $doc->exportCaption($this->Aktif);
                    $doc->exportCaption($this->Pasif);
                    $doc->exportCaption($this->Jumlah_Anggota);
                    $doc->exportCaption($this->Anggota_Lakilaki);
                    $doc->exportCaption($this->Anggota_Perempuan);
                    $doc->exportCaption($this->Jumlah_Manajer);
                    $doc->exportCaption($this->Manajer_Lakilaki);
                    $doc->exportCaption($this->Manajer_Perempuan);
                    $doc->exportCaption($this->Jumlah_Karyawan);
                    $doc->exportCaption($this->Karyawan_Lakilaki);
                    $doc->exportCaption($this->Karyawan_Perempuan);
                    $doc->exportCaption($this->RAT);
                    $doc->exportCaption($this->Jumlah_Modal_Sendiri);
                    $doc->exportCaption($this->Jumlah_Modal_Luar);
                    $doc->exportCaption($this->Jumlah_Volume_Usaha);
                    $doc->exportCaption($this->SHU);
                    $doc->exportCaption($this->Aset);
                } else {
                    $doc->exportCaption($this->Tahun_Periode);
                    $doc->exportCaption($this->Periode);
                    $doc->exportCaption($this->Bentuk_Ekonomi);
                    $doc->exportCaption($this->Jumlah_Koperasi);
                    $doc->exportCaption($this->Aktif);
                    $doc->exportCaption($this->Pasif);
                    $doc->exportCaption($this->Jumlah_Anggota);
                    $doc->exportCaption($this->Anggota_Lakilaki);
                    $doc->exportCaption($this->Anggota_Perempuan);
                    $doc->exportCaption($this->Jumlah_Manajer);
                    $doc->exportCaption($this->Manajer_Lakilaki);
                    $doc->exportCaption($this->Manajer_Perempuan);
                    $doc->exportCaption($this->Jumlah_Karyawan);
                    $doc->exportCaption($this->Karyawan_Lakilaki);
                    $doc->exportCaption($this->Karyawan_Perempuan);
                    $doc->exportCaption($this->RAT);
                    $doc->exportCaption($this->Jumlah_Modal_Sendiri);
                    $doc->exportCaption($this->Jumlah_Modal_Luar);
                    $doc->exportCaption($this->Jumlah_Volume_Usaha);
                    $doc->exportCaption($this->SHU);
                    $doc->exportCaption($this->Aset);
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
                        $doc->exportField($this->Tahun_Periode);
                        $doc->exportField($this->Periode);
                        $doc->exportField($this->Bentuk_Ekonomi);
                        $doc->exportField($this->Jumlah_Koperasi);
                        $doc->exportField($this->Aktif);
                        $doc->exportField($this->Pasif);
                        $doc->exportField($this->Jumlah_Anggota);
                        $doc->exportField($this->Anggota_Lakilaki);
                        $doc->exportField($this->Anggota_Perempuan);
                        $doc->exportField($this->Jumlah_Manajer);
                        $doc->exportField($this->Manajer_Lakilaki);
                        $doc->exportField($this->Manajer_Perempuan);
                        $doc->exportField($this->Jumlah_Karyawan);
                        $doc->exportField($this->Karyawan_Lakilaki);
                        $doc->exportField($this->Karyawan_Perempuan);
                        $doc->exportField($this->RAT);
                        $doc->exportField($this->Jumlah_Modal_Sendiri);
                        $doc->exportField($this->Jumlah_Modal_Luar);
                        $doc->exportField($this->Jumlah_Volume_Usaha);
                        $doc->exportField($this->SHU);
                        $doc->exportField($this->Aset);
                    } else {
                        $doc->exportField($this->Tahun_Periode);
                        $doc->exportField($this->Periode);
                        $doc->exportField($this->Bentuk_Ekonomi);
                        $doc->exportField($this->Jumlah_Koperasi);
                        $doc->exportField($this->Aktif);
                        $doc->exportField($this->Pasif);
                        $doc->exportField($this->Jumlah_Anggota);
                        $doc->exportField($this->Anggota_Lakilaki);
                        $doc->exportField($this->Anggota_Perempuan);
                        $doc->exportField($this->Jumlah_Manajer);
                        $doc->exportField($this->Manajer_Lakilaki);
                        $doc->exportField($this->Manajer_Perempuan);
                        $doc->exportField($this->Jumlah_Karyawan);
                        $doc->exportField($this->Karyawan_Lakilaki);
                        $doc->exportField($this->Karyawan_Perempuan);
                        $doc->exportField($this->RAT);
                        $doc->exportField($this->Jumlah_Modal_Sendiri);
                        $doc->exportField($this->Jumlah_Modal_Luar);
                        $doc->exportField($this->Jumlah_Volume_Usaha);
                        $doc->exportField($this->SHU);
                        $doc->exportField($this->Aset);
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
