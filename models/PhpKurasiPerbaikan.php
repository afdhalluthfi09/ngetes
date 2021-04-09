<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for php_kurasi_perbaikan
 */
class PhpKurasiPerbaikan extends DbTable
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
    public $nik_ukm;
    public $produk_nama;
    public $produk_jenis;
    public $produk_desc;
    public $produk_harga;
    public $produk_foto;
    public $produk_berat;
    public $produk_legal;
    public $judul_sesuai;
    public $foto_bagus;
    public $deskripsi_jelas;
    public $harga_tidak_kosong;
    public $berat_tidak_kosong;
    public $kurasi;
    public $waktu_entry;
    public $waktu_kurasi;
    public $waktu_update;
    public $editor;
    public $kurator;
    public $produk_panjang;
    public $produk_lebar;
    public $produk_tinggi;
    public $produk_foto_1;
    public $produk_foto_2;
    public $produk_foto_3;
    public $produk_foto_4;
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
        $this->TableVar = 'php_kurasi_perbaikan';
        $this->TableName = 'php_kurasi_perbaikan';
        $this->TableType = 'VIEW';

        // Update Table
        $this->UpdateTable = "`php_kurasi_perbaikan`";
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
        $this->id = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // nik_ukm
        $this->nik_ukm = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_nik_ukm', 'nik_ukm', '`nik_ukm`', '`nik_ukm`', 200, 16, -1, false, '`nik_ukm`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->nik_ukm->Sortable = true; // Allow sort
        $this->nik_ukm->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->nik_ukm->Param, "CustomMsg");
        $this->Fields['nik_ukm'] = &$this->nik_ukm;

        // produk_nama
        $this->produk_nama = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_nama', 'produk_nama', '`produk_nama`', '`produk_nama`', 200, 50, -1, false, '`produk_nama`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_nama->Sortable = true; // Allow sort
        $this->produk_nama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_nama->Param, "CustomMsg");
        $this->Fields['produk_nama'] = &$this->produk_nama;

        // produk_jenis
        $this->produk_jenis = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_jenis', 'produk_jenis', '`produk_jenis`', '`produk_jenis`', 200, 50, -1, false, '`produk_jenis`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_jenis->Sortable = true; // Allow sort
        $this->produk_jenis->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_jenis->Param, "CustomMsg");
        $this->Fields['produk_jenis'] = &$this->produk_jenis;

        // produk_desc
        $this->produk_desc = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_desc', 'produk_desc', '`produk_desc`', '`produk_desc`', 201, 65535, -1, false, '`produk_desc`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
        $this->produk_desc->Sortable = true; // Allow sort
        $this->produk_desc->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_desc->Param, "CustomMsg");
        $this->Fields['produk_desc'] = &$this->produk_desc;

        // produk_harga
        $this->produk_harga = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_harga', 'produk_harga', '`produk_harga`', '`produk_harga`', 5, 22, -1, false, '`produk_harga`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_harga->Sortable = true; // Allow sort
        $this->produk_harga->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->produk_harga->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->produk_harga->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_harga->Param, "CustomMsg");
        $this->Fields['produk_harga'] = &$this->produk_harga;

        // produk_foto
        $this->produk_foto = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_foto', 'produk_foto', '`produk_foto`', '`produk_foto`', 200, 50, -1, true, '`produk_foto`', false, false, false, 'IMAGE', 'FILE');
        $this->produk_foto->Sortable = true; // Allow sort
        $this->produk_foto->UploadAllowedFileExt = "jpg,png,jpeg";
        $this->produk_foto->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_foto->Param, "CustomMsg");
        $this->Fields['produk_foto'] = &$this->produk_foto;

        // produk_berat
        $this->produk_berat = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_berat', 'produk_berat', '`produk_berat`', '`produk_berat`', 4, 12, -1, false, '`produk_berat`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_berat->Nullable = false; // NOT NULL field
        $this->produk_berat->Required = true; // Required field
        $this->produk_berat->Sortable = true; // Allow sort
        $this->produk_berat->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->produk_berat->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->produk_berat->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_berat->Param, "CustomMsg");
        $this->Fields['produk_berat'] = &$this->produk_berat;

        // produk_legal
        $this->produk_legal = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_legal', 'produk_legal', '`produk_legal`', '`produk_legal`', 2, 1, -1, false, '`produk_legal`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_legal->Sortable = true; // Allow sort
        $this->produk_legal->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->produk_legal->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_legal->Param, "CustomMsg");
        $this->Fields['produk_legal'] = &$this->produk_legal;

        // judul_sesuai
        $this->judul_sesuai = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_judul_sesuai', 'judul_sesuai', '`judul_sesuai`', '`judul_sesuai`', 2, 1, -1, false, '`judul_sesuai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->judul_sesuai->Sortable = true; // Allow sort
        $this->judul_sesuai->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->judul_sesuai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->judul_sesuai->Param, "CustomMsg");
        $this->Fields['judul_sesuai'] = &$this->judul_sesuai;

        // foto_bagus
        $this->foto_bagus = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_foto_bagus', 'foto_bagus', '`foto_bagus`', '`foto_bagus`', 2, 1, -1, false, '`foto_bagus`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->foto_bagus->Sortable = true; // Allow sort
        $this->foto_bagus->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->foto_bagus->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->foto_bagus->Param, "CustomMsg");
        $this->Fields['foto_bagus'] = &$this->foto_bagus;

        // deskripsi_jelas
        $this->deskripsi_jelas = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_deskripsi_jelas', 'deskripsi_jelas', '`deskripsi_jelas`', '`deskripsi_jelas`', 2, 1, -1, false, '`deskripsi_jelas`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->deskripsi_jelas->Sortable = true; // Allow sort
        $this->deskripsi_jelas->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->deskripsi_jelas->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->deskripsi_jelas->Param, "CustomMsg");
        $this->Fields['deskripsi_jelas'] = &$this->deskripsi_jelas;

        // harga_tidak_kosong
        $this->harga_tidak_kosong = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_harga_tidak_kosong', 'harga_tidak_kosong', '`harga_tidak_kosong`', '`harga_tidak_kosong`', 2, 1, -1, false, '`harga_tidak_kosong`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->harga_tidak_kosong->Sortable = true; // Allow sort
        $this->harga_tidak_kosong->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->harga_tidak_kosong->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->harga_tidak_kosong->Param, "CustomMsg");
        $this->Fields['harga_tidak_kosong'] = &$this->harga_tidak_kosong;

        // berat_tidak_kosong
        $this->berat_tidak_kosong = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_berat_tidak_kosong', 'berat_tidak_kosong', '`berat_tidak_kosong`', '`berat_tidak_kosong`', 2, 1, -1, false, '`berat_tidak_kosong`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->berat_tidak_kosong->Sortable = true; // Allow sort
        $this->berat_tidak_kosong->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->berat_tidak_kosong->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->berat_tidak_kosong->Param, "CustomMsg");
        $this->Fields['berat_tidak_kosong'] = &$this->berat_tidak_kosong;

        // kurasi
        $this->kurasi = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_kurasi', 'kurasi', '`kurasi`', '`kurasi`', 200, 50, -1, false, '`kurasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kurasi->Sortable = true; // Allow sort
        $this->kurasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kurasi->Param, "CustomMsg");
        $this->Fields['kurasi'] = &$this->kurasi;

        // waktu_entry
        $this->waktu_entry = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_waktu_entry', 'waktu_entry', '`waktu_entry`', CastDateFieldForLike("`waktu_entry`", 0, "DB"), 135, 19, 0, false, '`waktu_entry`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu_entry->Sortable = true; // Allow sort
        $this->waktu_entry->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu_entry->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu_entry->Param, "CustomMsg");
        $this->Fields['waktu_entry'] = &$this->waktu_entry;

        // waktu_kurasi
        $this->waktu_kurasi = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_waktu_kurasi', 'waktu_kurasi', '`waktu_kurasi`', CastDateFieldForLike("`waktu_kurasi`", 0, "DB"), 135, 19, 0, false, '`waktu_kurasi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu_kurasi->Sortable = true; // Allow sort
        $this->waktu_kurasi->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu_kurasi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu_kurasi->Param, "CustomMsg");
        $this->Fields['waktu_kurasi'] = &$this->waktu_kurasi;

        // waktu_update
        $this->waktu_update = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_waktu_update', 'waktu_update', '`waktu_update`', CastDateFieldForLike("`waktu_update`", 0, "DB"), 135, 19, 0, false, '`waktu_update`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->waktu_update->Sortable = true; // Allow sort
        $this->waktu_update->DefaultErrorMessage = str_replace("%s", $GLOBALS["DATE_FORMAT"], $Language->phrase("IncorrectDate"));
        $this->waktu_update->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->waktu_update->Param, "CustomMsg");
        $this->Fields['waktu_update'] = &$this->waktu_update;

        // editor
        $this->editor = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_editor', 'editor', '`editor`', '`editor`', 200, 20, -1, false, '`editor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->editor->Sortable = true; // Allow sort
        $this->editor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->editor->Param, "CustomMsg");
        $this->Fields['editor'] = &$this->editor;

        // kurator
        $this->kurator = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_kurator', 'kurator', '`kurator`', '`kurator`', 200, 50, -1, false, '`kurator`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->kurator->Sortable = true; // Allow sort
        $this->kurator->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->kurator->Param, "CustomMsg");
        $this->Fields['kurator'] = &$this->kurator;

        // produk_panjang
        $this->produk_panjang = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_panjang', 'produk_panjang', '`produk_panjang`', '`produk_panjang`', 4, 12, -1, false, '`produk_panjang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_panjang->Nullable = false; // NOT NULL field
        $this->produk_panjang->Required = true; // Required field
        $this->produk_panjang->Sortable = true; // Allow sort
        $this->produk_panjang->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->produk_panjang->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->produk_panjang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_panjang->Param, "CustomMsg");
        $this->Fields['produk_panjang'] = &$this->produk_panjang;

        // produk_lebar
        $this->produk_lebar = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_lebar', 'produk_lebar', '`produk_lebar`', '`produk_lebar`', 4, 12, -1, false, '`produk_lebar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_lebar->Nullable = false; // NOT NULL field
        $this->produk_lebar->Required = true; // Required field
        $this->produk_lebar->Sortable = true; // Allow sort
        $this->produk_lebar->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->produk_lebar->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->produk_lebar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_lebar->Param, "CustomMsg");
        $this->Fields['produk_lebar'] = &$this->produk_lebar;

        // produk_tinggi
        $this->produk_tinggi = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_tinggi', 'produk_tinggi', '`produk_tinggi`', '`produk_tinggi`', 4, 12, -1, false, '`produk_tinggi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->produk_tinggi->Nullable = false; // NOT NULL field
        $this->produk_tinggi->Required = true; // Required field
        $this->produk_tinggi->Sortable = true; // Allow sort
        $this->produk_tinggi->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->produk_tinggi->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->produk_tinggi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_tinggi->Param, "CustomMsg");
        $this->Fields['produk_tinggi'] = &$this->produk_tinggi;

        // produk_foto_1
        $this->produk_foto_1 = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_foto_1', 'produk_foto_1', '`produk_foto_1`', '`produk_foto_1`', 200, 50, -1, true, '`produk_foto_1`', false, false, false, 'IMAGE', 'FILE');
        $this->produk_foto_1->Sortable = true; // Allow sort
        $this->produk_foto_1->UploadAllowedFileExt = "jpg,png,jpeg";
        $this->produk_foto_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_foto_1->Param, "CustomMsg");
        $this->Fields['produk_foto_1'] = &$this->produk_foto_1;

        // produk_foto_2
        $this->produk_foto_2 = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_foto_2', 'produk_foto_2', '`produk_foto_2`', '`produk_foto_2`', 200, 50, -1, true, '`produk_foto_2`', false, false, false, 'IMAGE', 'FILE');
        $this->produk_foto_2->Sortable = true; // Allow sort
        $this->produk_foto_2->UploadAllowedFileExt = "jpg,png,jpeg";
        $this->produk_foto_2->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_foto_2->Param, "CustomMsg");
        $this->Fields['produk_foto_2'] = &$this->produk_foto_2;

        // produk_foto_3
        $this->produk_foto_3 = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_foto_3', 'produk_foto_3', '`produk_foto_3`', '`produk_foto_3`', 200, 50, -1, true, '`produk_foto_3`', false, false, false, 'IMAGE', 'FILE');
        $this->produk_foto_3->Sortable = true; // Allow sort
        $this->produk_foto_3->UploadAllowedFileExt = "jpg,png,jpeg";
        $this->produk_foto_3->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_foto_3->Param, "CustomMsg");
        $this->Fields['produk_foto_3'] = &$this->produk_foto_3;

        // produk_foto_4
        $this->produk_foto_4 = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_produk_foto_4', 'produk_foto_4', '`produk_foto_4`', '`produk_foto_4`', 200, 50, -1, true, '`produk_foto_4`', false, false, false, 'IMAGE', 'FILE');
        $this->produk_foto_4->Sortable = false; // Allow sort
        $this->produk_foto_4->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->produk_foto_4->Param, "CustomMsg");
        $this->Fields['produk_foto_4'] = &$this->produk_foto_4;

        // catatan
        $this->catatan = new DbField('php_kurasi_perbaikan', 'php_kurasi_perbaikan', 'x_catatan', 'catatan', '`catatan`', '`catatan`', 200, 255, -1, false, '`catatan`', false, false, false, 'FORMATTED TEXT', 'TEXTAREA');
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

    // Table level SQL
    public function getSqlFrom() // From
    {
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`php_kurasi_perbaikan`";
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
        $this->DefaultFilter = "`nik_ukm`='".CurrentUserName()."'";
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
        $this->nik_ukm->DbValue = $row['nik_ukm'];
        $this->produk_nama->DbValue = $row['produk_nama'];
        $this->produk_jenis->DbValue = $row['produk_jenis'];
        $this->produk_desc->DbValue = $row['produk_desc'];
        $this->produk_harga->DbValue = $row['produk_harga'];
        $this->produk_foto->Upload->DbValue = $row['produk_foto'];
        $this->produk_berat->DbValue = $row['produk_berat'];
        $this->produk_legal->DbValue = $row['produk_legal'];
        $this->judul_sesuai->DbValue = $row['judul_sesuai'];
        $this->foto_bagus->DbValue = $row['foto_bagus'];
        $this->deskripsi_jelas->DbValue = $row['deskripsi_jelas'];
        $this->harga_tidak_kosong->DbValue = $row['harga_tidak_kosong'];
        $this->berat_tidak_kosong->DbValue = $row['berat_tidak_kosong'];
        $this->kurasi->DbValue = $row['kurasi'];
        $this->waktu_entry->DbValue = $row['waktu_entry'];
        $this->waktu_kurasi->DbValue = $row['waktu_kurasi'];
        $this->waktu_update->DbValue = $row['waktu_update'];
        $this->editor->DbValue = $row['editor'];
        $this->kurator->DbValue = $row['kurator'];
        $this->produk_panjang->DbValue = $row['produk_panjang'];
        $this->produk_lebar->DbValue = $row['produk_lebar'];
        $this->produk_tinggi->DbValue = $row['produk_tinggi'];
        $this->produk_foto_1->Upload->DbValue = $row['produk_foto_1'];
        $this->produk_foto_2->Upload->DbValue = $row['produk_foto_2'];
        $this->produk_foto_3->Upload->DbValue = $row['produk_foto_3'];
        $this->produk_foto_4->Upload->DbValue = $row['produk_foto_4'];
        $this->catatan->DbValue = $row['catatan'];
    }

    // Delete uploaded files
    public function deleteUploadedFiles($row)
    {
        $this->loadDbValues($row);
        $oldFiles = EmptyValue($row['produk_foto']) ? [] : [$row['produk_foto']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->produk_foto->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->produk_foto->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $oldFiles = EmptyValue($row['produk_foto_1']) ? [] : [$row['produk_foto_1']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->produk_foto_1->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->produk_foto_1->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $oldFiles = EmptyValue($row['produk_foto_2']) ? [] : [$row['produk_foto_2']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->produk_foto_2->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->produk_foto_2->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $oldFiles = EmptyValue($row['produk_foto_3']) ? [] : [$row['produk_foto_3']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->produk_foto_3->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->produk_foto_3->oldPhysicalUploadPath() . $oldFile);
            }
        }
        $oldFiles = EmptyValue($row['produk_foto_4']) ? [] : [$row['produk_foto_4']];
        foreach ($oldFiles as $oldFile) {
            if (file_exists($this->produk_foto_4->oldPhysicalUploadPath() . $oldFile)) {
                @unlink($this->produk_foto_4->oldPhysicalUploadPath() . $oldFile);
            }
        }
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
        return $_SESSION[$name] ?? GetUrl("phpkurasiperbaikanlist");
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
        if ($pageName == "phpkurasiperbaikanview") {
            return $Language->phrase("View");
        } elseif ($pageName == "phpkurasiperbaikanedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "phpkurasiperbaikanadd") {
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
                return "PhpKurasiPerbaikanView";
            case Config("API_ADD_ACTION"):
                return "PhpKurasiPerbaikanAdd";
            case Config("API_EDIT_ACTION"):
                return "PhpKurasiPerbaikanEdit";
            case Config("API_DELETE_ACTION"):
                return "PhpKurasiPerbaikanDelete";
            case Config("API_LIST_ACTION"):
                return "PhpKurasiPerbaikanList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "phpkurasiperbaikanlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("phpkurasiperbaikanview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("phpkurasiperbaikanview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "phpkurasiperbaikanadd?" . $this->getUrlParm($parm);
        } else {
            $url = "phpkurasiperbaikanadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("phpkurasiperbaikanedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("phpkurasiperbaikanadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("phpkurasiperbaikandelete", $this->getUrlParm());
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
        $this->nik_ukm->setDbValue($row['nik_ukm']);
        $this->produk_nama->setDbValue($row['produk_nama']);
        $this->produk_jenis->setDbValue($row['produk_jenis']);
        $this->produk_desc->setDbValue($row['produk_desc']);
        $this->produk_harga->setDbValue($row['produk_harga']);
        $this->produk_foto->Upload->DbValue = $row['produk_foto'];
        $this->produk_foto->setDbValue($this->produk_foto->Upload->DbValue);
        $this->produk_berat->setDbValue($row['produk_berat']);
        $this->produk_legal->setDbValue($row['produk_legal']);
        $this->judul_sesuai->setDbValue($row['judul_sesuai']);
        $this->foto_bagus->setDbValue($row['foto_bagus']);
        $this->deskripsi_jelas->setDbValue($row['deskripsi_jelas']);
        $this->harga_tidak_kosong->setDbValue($row['harga_tidak_kosong']);
        $this->berat_tidak_kosong->setDbValue($row['berat_tidak_kosong']);
        $this->kurasi->setDbValue($row['kurasi']);
        $this->waktu_entry->setDbValue($row['waktu_entry']);
        $this->waktu_kurasi->setDbValue($row['waktu_kurasi']);
        $this->waktu_update->setDbValue($row['waktu_update']);
        $this->editor->setDbValue($row['editor']);
        $this->kurator->setDbValue($row['kurator']);
        $this->produk_panjang->setDbValue($row['produk_panjang']);
        $this->produk_lebar->setDbValue($row['produk_lebar']);
        $this->produk_tinggi->setDbValue($row['produk_tinggi']);
        $this->produk_foto_1->Upload->DbValue = $row['produk_foto_1'];
        $this->produk_foto_1->setDbValue($this->produk_foto_1->Upload->DbValue);
        $this->produk_foto_2->Upload->DbValue = $row['produk_foto_2'];
        $this->produk_foto_2->setDbValue($this->produk_foto_2->Upload->DbValue);
        $this->produk_foto_3->Upload->DbValue = $row['produk_foto_3'];
        $this->produk_foto_3->setDbValue($this->produk_foto_3->Upload->DbValue);
        $this->produk_foto_4->Upload->DbValue = $row['produk_foto_4'];
        $this->produk_foto_4->setDbValue($this->produk_foto_4->Upload->DbValue);
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

        // nik_ukm

        // produk_nama

        // produk_jenis

        // produk_desc

        // produk_harga

        // produk_foto

        // produk_berat

        // produk_legal

        // judul_sesuai

        // foto_bagus

        // deskripsi_jelas

        // harga_tidak_kosong

        // berat_tidak_kosong

        // kurasi

        // waktu_entry

        // waktu_kurasi

        // waktu_update

        // editor

        // kurator

        // produk_panjang

        // produk_lebar

        // produk_tinggi

        // produk_foto_1

        // produk_foto_2

        // produk_foto_3

        // produk_foto_4
        $this->produk_foto_4->CellCssStyle = "white-space: nowrap;";

        // catatan

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // nik_ukm
        $this->nik_ukm->ViewValue = $this->nik_ukm->CurrentValue;
        $this->nik_ukm->ViewCustomAttributes = "";

        // produk_nama
        $this->produk_nama->ViewValue = $this->produk_nama->CurrentValue;
        $this->produk_nama->ViewCustomAttributes = "";

        // produk_jenis
        $this->produk_jenis->ViewValue = $this->produk_jenis->CurrentValue;
        $this->produk_jenis->ViewCustomAttributes = "";

        // produk_desc
        $this->produk_desc->ViewValue = $this->produk_desc->CurrentValue;
        $this->produk_desc->ViewCustomAttributes = "";

        // produk_harga
        $this->produk_harga->ViewValue = $this->produk_harga->CurrentValue;
        $this->produk_harga->ViewValue = FormatNumber($this->produk_harga->ViewValue, 2, -2, -2, -2);
        $this->produk_harga->ViewCustomAttributes = "";

        // produk_foto
        if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
            $this->produk_foto->ImageWidth = 200;
            $this->produk_foto->ImageHeight = 200;
            $this->produk_foto->ImageAlt = $this->produk_foto->alt();
            $this->produk_foto->ViewValue = $this->produk_foto->Upload->DbValue;
        } else {
            $this->produk_foto->ViewValue = "";
        }
        $this->produk_foto->ViewCustomAttributes = "";

        // produk_berat
        $this->produk_berat->ViewValue = $this->produk_berat->CurrentValue;
        $this->produk_berat->ViewValue = FormatNumber($this->produk_berat->ViewValue, 2, -2, -2, -2);
        $this->produk_berat->ViewCustomAttributes = "";

        // produk_legal
        $this->produk_legal->ViewValue = $this->produk_legal->CurrentValue;
        $this->produk_legal->ViewValue = FormatNumber($this->produk_legal->ViewValue, 0, -2, -2, -2);
        $this->produk_legal->ViewCustomAttributes = "";

        // judul_sesuai
        $this->judul_sesuai->ViewValue = $this->judul_sesuai->CurrentValue;
        $this->judul_sesuai->ViewValue = FormatNumber($this->judul_sesuai->ViewValue, 0, -2, -2, -2);
        $this->judul_sesuai->ViewCustomAttributes = "";

        // foto_bagus
        $this->foto_bagus->ViewValue = $this->foto_bagus->CurrentValue;
        $this->foto_bagus->ViewValue = FormatNumber($this->foto_bagus->ViewValue, 0, -2, -2, -2);
        $this->foto_bagus->ViewCustomAttributes = "";

        // deskripsi_jelas
        $this->deskripsi_jelas->ViewValue = $this->deskripsi_jelas->CurrentValue;
        $this->deskripsi_jelas->ViewValue = FormatNumber($this->deskripsi_jelas->ViewValue, 0, -2, -2, -2);
        $this->deskripsi_jelas->ViewCustomAttributes = "";

        // harga_tidak_kosong
        $this->harga_tidak_kosong->ViewValue = $this->harga_tidak_kosong->CurrentValue;
        $this->harga_tidak_kosong->ViewValue = FormatNumber($this->harga_tidak_kosong->ViewValue, 0, -2, -2, -2);
        $this->harga_tidak_kosong->ViewCustomAttributes = "";

        // berat_tidak_kosong
        $this->berat_tidak_kosong->ViewValue = $this->berat_tidak_kosong->CurrentValue;
        $this->berat_tidak_kosong->ViewValue = FormatNumber($this->berat_tidak_kosong->ViewValue, 0, -2, -2, -2);
        $this->berat_tidak_kosong->ViewCustomAttributes = "";

        // kurasi
        $this->kurasi->ViewValue = $this->kurasi->CurrentValue;
        $this->kurasi->ViewCustomAttributes = "";

        // waktu_entry
        $this->waktu_entry->ViewValue = $this->waktu_entry->CurrentValue;
        $this->waktu_entry->ViewValue = FormatDateTime($this->waktu_entry->ViewValue, 0);
        $this->waktu_entry->ViewCustomAttributes = "";

        // waktu_kurasi
        $this->waktu_kurasi->ViewValue = $this->waktu_kurasi->CurrentValue;
        $this->waktu_kurasi->ViewValue = FormatDateTime($this->waktu_kurasi->ViewValue, 0);
        $this->waktu_kurasi->ViewCustomAttributes = "";

        // waktu_update
        $this->waktu_update->ViewValue = $this->waktu_update->CurrentValue;
        $this->waktu_update->ViewValue = FormatDateTime($this->waktu_update->ViewValue, 0);
        $this->waktu_update->ViewCustomAttributes = "";

        // editor
        $this->editor->ViewValue = $this->editor->CurrentValue;
        $this->editor->ViewCustomAttributes = "";

        // kurator
        $this->kurator->ViewValue = $this->kurator->CurrentValue;
        $this->kurator->ViewCustomAttributes = "";

        // produk_panjang
        $this->produk_panjang->ViewValue = $this->produk_panjang->CurrentValue;
        $this->produk_panjang->ViewValue = FormatNumber($this->produk_panjang->ViewValue, 2, -2, -2, -2);
        $this->produk_panjang->ViewCustomAttributes = "";

        // produk_lebar
        $this->produk_lebar->ViewValue = $this->produk_lebar->CurrentValue;
        $this->produk_lebar->ViewValue = FormatNumber($this->produk_lebar->ViewValue, 2, -2, -2, -2);
        $this->produk_lebar->ViewCustomAttributes = "";

        // produk_tinggi
        $this->produk_tinggi->ViewValue = $this->produk_tinggi->CurrentValue;
        $this->produk_tinggi->ViewValue = FormatNumber($this->produk_tinggi->ViewValue, 2, -2, -2, -2);
        $this->produk_tinggi->ViewCustomAttributes = "";

        // produk_foto_1
        if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
            $this->produk_foto_1->ImageWidth = 200;
            $this->produk_foto_1->ImageHeight = 200;
            $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
            $this->produk_foto_1->ViewValue = $this->produk_foto_1->Upload->DbValue;
        } else {
            $this->produk_foto_1->ViewValue = "";
        }
        $this->produk_foto_1->ViewCustomAttributes = "";

        // produk_foto_2
        if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
            $this->produk_foto_2->ImageWidth = 200;
            $this->produk_foto_2->ImageHeight = 200;
            $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
            $this->produk_foto_2->ViewValue = $this->produk_foto_2->Upload->DbValue;
        } else {
            $this->produk_foto_2->ViewValue = "";
        }
        $this->produk_foto_2->ViewCustomAttributes = "";

        // produk_foto_3
        if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
            $this->produk_foto_3->ImageWidth = 200;
            $this->produk_foto_3->ImageHeight = 200;
            $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
            $this->produk_foto_3->ViewValue = $this->produk_foto_3->Upload->DbValue;
        } else {
            $this->produk_foto_3->ViewValue = "";
        }
        $this->produk_foto_3->ViewCustomAttributes = "";

        // produk_foto_4
        if (!EmptyValue($this->produk_foto_4->Upload->DbValue)) {
            $this->produk_foto_4->ImageAlt = $this->produk_foto_4->alt();
            $this->produk_foto_4->ViewValue = $this->produk_foto_4->Upload->DbValue;
        } else {
            $this->produk_foto_4->ViewValue = "";
        }
        $this->produk_foto_4->ViewCustomAttributes = "";

        // catatan
        $this->catatan->ViewValue = $this->catatan->CurrentValue;
        $this->catatan->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // nik_ukm
        $this->nik_ukm->LinkCustomAttributes = "";
        $this->nik_ukm->HrefValue = "";
        $this->nik_ukm->TooltipValue = "";

        // produk_nama
        $this->produk_nama->LinkCustomAttributes = "";
        $this->produk_nama->HrefValue = "";
        $this->produk_nama->TooltipValue = "";

        // produk_jenis
        $this->produk_jenis->LinkCustomAttributes = "";
        $this->produk_jenis->HrefValue = "";
        $this->produk_jenis->TooltipValue = "";

        // produk_desc
        $this->produk_desc->LinkCustomAttributes = "";
        $this->produk_desc->HrefValue = "";
        $this->produk_desc->TooltipValue = "";

        // produk_harga
        $this->produk_harga->LinkCustomAttributes = "";
        $this->produk_harga->HrefValue = "";
        $this->produk_harga->TooltipValue = "";

        // produk_foto
        $this->produk_foto->LinkCustomAttributes = "";
        if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
            $this->produk_foto->HrefValue = GetFileUploadUrl($this->produk_foto, $this->produk_foto->htmlDecode($this->produk_foto->Upload->DbValue)); // Add prefix/suffix
            $this->produk_foto->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->produk_foto->HrefValue = FullUrl($this->produk_foto->HrefValue, "href");
            }
        } else {
            $this->produk_foto->HrefValue = "";
        }
        $this->produk_foto->ExportHrefValue = $this->produk_foto->UploadPath . $this->produk_foto->Upload->DbValue;
        $this->produk_foto->TooltipValue = "";
        if ($this->produk_foto->UseColorbox) {
            if (EmptyValue($this->produk_foto->TooltipValue)) {
                $this->produk_foto->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->produk_foto->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto";
            $this->produk_foto->LinkAttrs->appendClass("ew-lightbox");
        }

        // produk_berat
        $this->produk_berat->LinkCustomAttributes = "";
        $this->produk_berat->HrefValue = "";
        $this->produk_berat->TooltipValue = "";

        // produk_legal
        $this->produk_legal->LinkCustomAttributes = "";
        $this->produk_legal->HrefValue = "";
        $this->produk_legal->TooltipValue = "";

        // judul_sesuai
        $this->judul_sesuai->LinkCustomAttributes = "";
        $this->judul_sesuai->HrefValue = "";
        $this->judul_sesuai->TooltipValue = "";

        // foto_bagus
        $this->foto_bagus->LinkCustomAttributes = "";
        $this->foto_bagus->HrefValue = "";
        $this->foto_bagus->TooltipValue = "";

        // deskripsi_jelas
        $this->deskripsi_jelas->LinkCustomAttributes = "";
        $this->deskripsi_jelas->HrefValue = "";
        $this->deskripsi_jelas->TooltipValue = "";

        // harga_tidak_kosong
        $this->harga_tidak_kosong->LinkCustomAttributes = "";
        $this->harga_tidak_kosong->HrefValue = "";
        $this->harga_tidak_kosong->TooltipValue = "";

        // berat_tidak_kosong
        $this->berat_tidak_kosong->LinkCustomAttributes = "";
        $this->berat_tidak_kosong->HrefValue = "";
        $this->berat_tidak_kosong->TooltipValue = "";

        // kurasi
        $this->kurasi->LinkCustomAttributes = "";
        $this->kurasi->HrefValue = "";
        $this->kurasi->TooltipValue = "";

        // waktu_entry
        $this->waktu_entry->LinkCustomAttributes = "";
        $this->waktu_entry->HrefValue = "";
        $this->waktu_entry->TooltipValue = "";

        // waktu_kurasi
        $this->waktu_kurasi->LinkCustomAttributes = "";
        $this->waktu_kurasi->HrefValue = "";
        $this->waktu_kurasi->TooltipValue = "";

        // waktu_update
        $this->waktu_update->LinkCustomAttributes = "";
        $this->waktu_update->HrefValue = "";
        $this->waktu_update->TooltipValue = "";

        // editor
        $this->editor->LinkCustomAttributes = "";
        $this->editor->HrefValue = "";
        $this->editor->TooltipValue = "";

        // kurator
        $this->kurator->LinkCustomAttributes = "";
        $this->kurator->HrefValue = "";
        $this->kurator->TooltipValue = "";

        // produk_panjang
        $this->produk_panjang->LinkCustomAttributes = "";
        $this->produk_panjang->HrefValue = "";
        $this->produk_panjang->TooltipValue = "";

        // produk_lebar
        $this->produk_lebar->LinkCustomAttributes = "";
        $this->produk_lebar->HrefValue = "";
        $this->produk_lebar->TooltipValue = "";

        // produk_tinggi
        $this->produk_tinggi->LinkCustomAttributes = "";
        $this->produk_tinggi->HrefValue = "";
        $this->produk_tinggi->TooltipValue = "";

        // produk_foto_1
        $this->produk_foto_1->LinkCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
            $this->produk_foto_1->HrefValue = GetFileUploadUrl($this->produk_foto_1, $this->produk_foto_1->htmlDecode($this->produk_foto_1->Upload->DbValue)); // Add prefix/suffix
            $this->produk_foto_1->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->produk_foto_1->HrefValue = FullUrl($this->produk_foto_1->HrefValue, "href");
            }
        } else {
            $this->produk_foto_1->HrefValue = "";
        }
        $this->produk_foto_1->ExportHrefValue = $this->produk_foto_1->UploadPath . $this->produk_foto_1->Upload->DbValue;
        $this->produk_foto_1->TooltipValue = "";
        if ($this->produk_foto_1->UseColorbox) {
            if (EmptyValue($this->produk_foto_1->TooltipValue)) {
                $this->produk_foto_1->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->produk_foto_1->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_1";
            $this->produk_foto_1->LinkAttrs->appendClass("ew-lightbox");
        }

        // produk_foto_2
        $this->produk_foto_2->LinkCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
            $this->produk_foto_2->HrefValue = GetFileUploadUrl($this->produk_foto_2, $this->produk_foto_2->htmlDecode($this->produk_foto_2->Upload->DbValue)); // Add prefix/suffix
            $this->produk_foto_2->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->produk_foto_2->HrefValue = FullUrl($this->produk_foto_2->HrefValue, "href");
            }
        } else {
            $this->produk_foto_2->HrefValue = "";
        }
        $this->produk_foto_2->ExportHrefValue = $this->produk_foto_2->UploadPath . $this->produk_foto_2->Upload->DbValue;
        $this->produk_foto_2->TooltipValue = "";
        if ($this->produk_foto_2->UseColorbox) {
            if (EmptyValue($this->produk_foto_2->TooltipValue)) {
                $this->produk_foto_2->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->produk_foto_2->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_2";
            $this->produk_foto_2->LinkAttrs->appendClass("ew-lightbox");
        }

        // produk_foto_3
        $this->produk_foto_3->LinkCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
            $this->produk_foto_3->HrefValue = GetFileUploadUrl($this->produk_foto_3, $this->produk_foto_3->htmlDecode($this->produk_foto_3->Upload->DbValue)); // Add prefix/suffix
            $this->produk_foto_3->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->produk_foto_3->HrefValue = FullUrl($this->produk_foto_3->HrefValue, "href");
            }
        } else {
            $this->produk_foto_3->HrefValue = "";
        }
        $this->produk_foto_3->ExportHrefValue = $this->produk_foto_3->UploadPath . $this->produk_foto_3->Upload->DbValue;
        $this->produk_foto_3->TooltipValue = "";
        if ($this->produk_foto_3->UseColorbox) {
            if (EmptyValue($this->produk_foto_3->TooltipValue)) {
                $this->produk_foto_3->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->produk_foto_3->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_3";
            $this->produk_foto_3->LinkAttrs->appendClass("ew-lightbox");
        }

        // produk_foto_4
        $this->produk_foto_4->LinkCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_4->Upload->DbValue)) {
            $this->produk_foto_4->HrefValue = GetFileUploadUrl($this->produk_foto_4, $this->produk_foto_4->htmlDecode($this->produk_foto_4->Upload->DbValue)); // Add prefix/suffix
            $this->produk_foto_4->LinkAttrs["target"] = ""; // Add target
            if ($this->isExport()) {
                $this->produk_foto_4->HrefValue = FullUrl($this->produk_foto_4->HrefValue, "href");
            }
        } else {
            $this->produk_foto_4->HrefValue = "";
        }
        $this->produk_foto_4->ExportHrefValue = $this->produk_foto_4->UploadPath . $this->produk_foto_4->Upload->DbValue;
        $this->produk_foto_4->TooltipValue = "";
        if ($this->produk_foto_4->UseColorbox) {
            if (EmptyValue($this->produk_foto_4->TooltipValue)) {
                $this->produk_foto_4->LinkAttrs["title"] = $Language->phrase("ViewImageGallery");
            }
            $this->produk_foto_4->LinkAttrs["data-rel"] = "php_kurasi_perbaikan_x_produk_foto_4";
            $this->produk_foto_4->LinkAttrs->appendClass("ew-lightbox");
        }

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

        // nik_ukm
        $this->nik_ukm->EditAttrs["class"] = "form-control";
        $this->nik_ukm->EditCustomAttributes = "";
        if (!$this->nik_ukm->Raw) {
            $this->nik_ukm->CurrentValue = HtmlDecode($this->nik_ukm->CurrentValue);
        }
        $this->nik_ukm->EditValue = $this->nik_ukm->CurrentValue;
        $this->nik_ukm->PlaceHolder = RemoveHtml($this->nik_ukm->caption());

        // produk_nama
        $this->produk_nama->EditAttrs["class"] = "form-control";
        $this->produk_nama->EditCustomAttributes = "";
        if (!$this->produk_nama->Raw) {
            $this->produk_nama->CurrentValue = HtmlDecode($this->produk_nama->CurrentValue);
        }
        $this->produk_nama->EditValue = $this->produk_nama->CurrentValue;
        $this->produk_nama->PlaceHolder = RemoveHtml($this->produk_nama->caption());

        // produk_jenis
        $this->produk_jenis->EditAttrs["class"] = "form-control";
        $this->produk_jenis->EditCustomAttributes = "";
        if (!$this->produk_jenis->Raw) {
            $this->produk_jenis->CurrentValue = HtmlDecode($this->produk_jenis->CurrentValue);
        }
        $this->produk_jenis->EditValue = $this->produk_jenis->CurrentValue;
        $this->produk_jenis->PlaceHolder = RemoveHtml($this->produk_jenis->caption());

        // produk_desc
        $this->produk_desc->EditAttrs["class"] = "form-control";
        $this->produk_desc->EditCustomAttributes = "";
        $this->produk_desc->EditValue = $this->produk_desc->CurrentValue;
        $this->produk_desc->PlaceHolder = RemoveHtml($this->produk_desc->caption());

        // produk_harga
        $this->produk_harga->EditAttrs["class"] = "form-control";
        $this->produk_harga->EditCustomAttributes = "";
        $this->produk_harga->EditValue = $this->produk_harga->CurrentValue;
        $this->produk_harga->PlaceHolder = RemoveHtml($this->produk_harga->caption());
        if (strval($this->produk_harga->EditValue) != "" && is_numeric($this->produk_harga->EditValue)) {
            $this->produk_harga->EditValue = FormatNumber($this->produk_harga->EditValue, -2, -2, -2, -2);
        }

        // produk_foto
        $this->produk_foto->EditAttrs["class"] = "form-control";
        $this->produk_foto->EditCustomAttributes = "";
        if (!EmptyValue($this->produk_foto->Upload->DbValue)) {
            $this->produk_foto->ImageWidth = 200;
            $this->produk_foto->ImageHeight = 200;
            $this->produk_foto->ImageAlt = $this->produk_foto->alt();
            $this->produk_foto->EditValue = $this->produk_foto->Upload->DbValue;
        } else {
            $this->produk_foto->EditValue = "";
        }
        if (!EmptyValue($this->produk_foto->CurrentValue)) {
            $this->produk_foto->Upload->FileName = $this->produk_foto->CurrentValue;
        }

        // produk_berat
        $this->produk_berat->EditAttrs["class"] = "form-control";
        $this->produk_berat->EditCustomAttributes = "";
        $this->produk_berat->EditValue = $this->produk_berat->CurrentValue;
        $this->produk_berat->PlaceHolder = RemoveHtml($this->produk_berat->caption());
        if (strval($this->produk_berat->EditValue) != "" && is_numeric($this->produk_berat->EditValue)) {
            $this->produk_berat->EditValue = FormatNumber($this->produk_berat->EditValue, -2, -2, -2, -2);
        }

        // produk_legal
        $this->produk_legal->EditAttrs["class"] = "form-control";
        $this->produk_legal->EditCustomAttributes = "";
        $this->produk_legal->EditValue = $this->produk_legal->CurrentValue;
        $this->produk_legal->PlaceHolder = RemoveHtml($this->produk_legal->caption());

        // judul_sesuai
        $this->judul_sesuai->EditAttrs["class"] = "form-control";
        $this->judul_sesuai->EditCustomAttributes = "";
        $this->judul_sesuai->EditValue = $this->judul_sesuai->CurrentValue;
        $this->judul_sesuai->PlaceHolder = RemoveHtml($this->judul_sesuai->caption());

        // foto_bagus
        $this->foto_bagus->EditAttrs["class"] = "form-control";
        $this->foto_bagus->EditCustomAttributes = "";
        $this->foto_bagus->EditValue = $this->foto_bagus->CurrentValue;
        $this->foto_bagus->PlaceHolder = RemoveHtml($this->foto_bagus->caption());

        // deskripsi_jelas
        $this->deskripsi_jelas->EditAttrs["class"] = "form-control";
        $this->deskripsi_jelas->EditCustomAttributes = "";
        $this->deskripsi_jelas->EditValue = $this->deskripsi_jelas->CurrentValue;
        $this->deskripsi_jelas->PlaceHolder = RemoveHtml($this->deskripsi_jelas->caption());

        // harga_tidak_kosong
        $this->harga_tidak_kosong->EditAttrs["class"] = "form-control";
        $this->harga_tidak_kosong->EditCustomAttributes = "";
        $this->harga_tidak_kosong->EditValue = $this->harga_tidak_kosong->CurrentValue;
        $this->harga_tidak_kosong->PlaceHolder = RemoveHtml($this->harga_tidak_kosong->caption());

        // berat_tidak_kosong
        $this->berat_tidak_kosong->EditAttrs["class"] = "form-control";
        $this->berat_tidak_kosong->EditCustomAttributes = "";
        $this->berat_tidak_kosong->EditValue = $this->berat_tidak_kosong->CurrentValue;
        $this->berat_tidak_kosong->PlaceHolder = RemoveHtml($this->berat_tidak_kosong->caption());

        // kurasi
        $this->kurasi->EditAttrs["class"] = "form-control";
        $this->kurasi->EditCustomAttributes = "";
        if (!$this->kurasi->Raw) {
            $this->kurasi->CurrentValue = HtmlDecode($this->kurasi->CurrentValue);
        }
        $this->kurasi->EditValue = $this->kurasi->CurrentValue;
        $this->kurasi->PlaceHolder = RemoveHtml($this->kurasi->caption());

        // waktu_entry
        $this->waktu_entry->EditAttrs["class"] = "form-control";
        $this->waktu_entry->EditCustomAttributes = "";
        $this->waktu_entry->EditValue = FormatDateTime($this->waktu_entry->CurrentValue, 8);
        $this->waktu_entry->PlaceHolder = RemoveHtml($this->waktu_entry->caption());

        // waktu_kurasi
        $this->waktu_kurasi->EditAttrs["class"] = "form-control";
        $this->waktu_kurasi->EditCustomAttributes = "";
        $this->waktu_kurasi->EditValue = FormatDateTime($this->waktu_kurasi->CurrentValue, 8);
        $this->waktu_kurasi->PlaceHolder = RemoveHtml($this->waktu_kurasi->caption());

        // waktu_update
        $this->waktu_update->EditAttrs["class"] = "form-control";
        $this->waktu_update->EditCustomAttributes = "";
        $this->waktu_update->EditValue = FormatDateTime($this->waktu_update->CurrentValue, 8);
        $this->waktu_update->PlaceHolder = RemoveHtml($this->waktu_update->caption());

        // editor
        $this->editor->EditAttrs["class"] = "form-control";
        $this->editor->EditCustomAttributes = "";
        if (!$this->editor->Raw) {
            $this->editor->CurrentValue = HtmlDecode($this->editor->CurrentValue);
        }
        $this->editor->EditValue = $this->editor->CurrentValue;
        $this->editor->PlaceHolder = RemoveHtml($this->editor->caption());

        // kurator
        $this->kurator->EditAttrs["class"] = "form-control";
        $this->kurator->EditCustomAttributes = "";
        if (!$this->kurator->Raw) {
            $this->kurator->CurrentValue = HtmlDecode($this->kurator->CurrentValue);
        }
        $this->kurator->EditValue = $this->kurator->CurrentValue;
        $this->kurator->PlaceHolder = RemoveHtml($this->kurator->caption());

        // produk_panjang
        $this->produk_panjang->EditAttrs["class"] = "form-control";
        $this->produk_panjang->EditCustomAttributes = "";
        $this->produk_panjang->EditValue = $this->produk_panjang->CurrentValue;
        $this->produk_panjang->PlaceHolder = RemoveHtml($this->produk_panjang->caption());
        if (strval($this->produk_panjang->EditValue) != "" && is_numeric($this->produk_panjang->EditValue)) {
            $this->produk_panjang->EditValue = FormatNumber($this->produk_panjang->EditValue, -2, -2, -2, -2);
        }

        // produk_lebar
        $this->produk_lebar->EditAttrs["class"] = "form-control";
        $this->produk_lebar->EditCustomAttributes = "";
        $this->produk_lebar->EditValue = $this->produk_lebar->CurrentValue;
        $this->produk_lebar->PlaceHolder = RemoveHtml($this->produk_lebar->caption());
        if (strval($this->produk_lebar->EditValue) != "" && is_numeric($this->produk_lebar->EditValue)) {
            $this->produk_lebar->EditValue = FormatNumber($this->produk_lebar->EditValue, -2, -2, -2, -2);
        }

        // produk_tinggi
        $this->produk_tinggi->EditAttrs["class"] = "form-control";
        $this->produk_tinggi->EditCustomAttributes = "";
        $this->produk_tinggi->EditValue = $this->produk_tinggi->CurrentValue;
        $this->produk_tinggi->PlaceHolder = RemoveHtml($this->produk_tinggi->caption());
        if (strval($this->produk_tinggi->EditValue) != "" && is_numeric($this->produk_tinggi->EditValue)) {
            $this->produk_tinggi->EditValue = FormatNumber($this->produk_tinggi->EditValue, -2, -2, -2, -2);
        }

        // produk_foto_1
        $this->produk_foto_1->EditAttrs["class"] = "form-control";
        $this->produk_foto_1->EditCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_1->Upload->DbValue)) {
            $this->produk_foto_1->ImageWidth = 200;
            $this->produk_foto_1->ImageHeight = 200;
            $this->produk_foto_1->ImageAlt = $this->produk_foto_1->alt();
            $this->produk_foto_1->EditValue = $this->produk_foto_1->Upload->DbValue;
        } else {
            $this->produk_foto_1->EditValue = "";
        }
        if (!EmptyValue($this->produk_foto_1->CurrentValue)) {
            $this->produk_foto_1->Upload->FileName = $this->produk_foto_1->CurrentValue;
        }

        // produk_foto_2
        $this->produk_foto_2->EditAttrs["class"] = "form-control";
        $this->produk_foto_2->EditCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_2->Upload->DbValue)) {
            $this->produk_foto_2->ImageWidth = 200;
            $this->produk_foto_2->ImageHeight = 200;
            $this->produk_foto_2->ImageAlt = $this->produk_foto_2->alt();
            $this->produk_foto_2->EditValue = $this->produk_foto_2->Upload->DbValue;
        } else {
            $this->produk_foto_2->EditValue = "";
        }
        if (!EmptyValue($this->produk_foto_2->CurrentValue)) {
            $this->produk_foto_2->Upload->FileName = $this->produk_foto_2->CurrentValue;
        }

        // produk_foto_3
        $this->produk_foto_3->EditAttrs["class"] = "form-control";
        $this->produk_foto_3->EditCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_3->Upload->DbValue)) {
            $this->produk_foto_3->ImageWidth = 200;
            $this->produk_foto_3->ImageHeight = 200;
            $this->produk_foto_3->ImageAlt = $this->produk_foto_3->alt();
            $this->produk_foto_3->EditValue = $this->produk_foto_3->Upload->DbValue;
        } else {
            $this->produk_foto_3->EditValue = "";
        }
        if (!EmptyValue($this->produk_foto_3->CurrentValue)) {
            $this->produk_foto_3->Upload->FileName = $this->produk_foto_3->CurrentValue;
        }

        // produk_foto_4
        $this->produk_foto_4->EditAttrs["class"] = "form-control";
        $this->produk_foto_4->EditCustomAttributes = "";
        if (!EmptyValue($this->produk_foto_4->Upload->DbValue)) {
            $this->produk_foto_4->ImageAlt = $this->produk_foto_4->alt();
            $this->produk_foto_4->EditValue = $this->produk_foto_4->Upload->DbValue;
        } else {
            $this->produk_foto_4->EditValue = "";
        }
        if (!EmptyValue($this->produk_foto_4->CurrentValue)) {
            $this->produk_foto_4->Upload->FileName = $this->produk_foto_4->CurrentValue;
        }

        // catatan
        $this->catatan->EditAttrs["class"] = "form-control";
        $this->catatan->EditCustomAttributes = "";
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
                    $doc->exportCaption($this->nik_ukm);
                    $doc->exportCaption($this->produk_nama);
                    $doc->exportCaption($this->produk_jenis);
                    $doc->exportCaption($this->produk_desc);
                    $doc->exportCaption($this->produk_harga);
                    $doc->exportCaption($this->produk_foto);
                    $doc->exportCaption($this->produk_berat);
                    $doc->exportCaption($this->produk_legal);
                    $doc->exportCaption($this->judul_sesuai);
                    $doc->exportCaption($this->foto_bagus);
                    $doc->exportCaption($this->deskripsi_jelas);
                    $doc->exportCaption($this->harga_tidak_kosong);
                    $doc->exportCaption($this->berat_tidak_kosong);
                    $doc->exportCaption($this->kurasi);
                    $doc->exportCaption($this->waktu_entry);
                    $doc->exportCaption($this->waktu_kurasi);
                    $doc->exportCaption($this->waktu_update);
                    $doc->exportCaption($this->editor);
                    $doc->exportCaption($this->kurator);
                    $doc->exportCaption($this->produk_panjang);
                    $doc->exportCaption($this->produk_lebar);
                    $doc->exportCaption($this->produk_tinggi);
                    $doc->exportCaption($this->produk_foto_1);
                    $doc->exportCaption($this->produk_foto_2);
                    $doc->exportCaption($this->produk_foto_3);
                    $doc->exportCaption($this->catatan);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->nik_ukm);
                    $doc->exportCaption($this->produk_nama);
                    $doc->exportCaption($this->produk_jenis);
                    $doc->exportCaption($this->produk_harga);
                    $doc->exportCaption($this->produk_foto);
                    $doc->exportCaption($this->produk_berat);
                    $doc->exportCaption($this->produk_legal);
                    $doc->exportCaption($this->judul_sesuai);
                    $doc->exportCaption($this->foto_bagus);
                    $doc->exportCaption($this->deskripsi_jelas);
                    $doc->exportCaption($this->harga_tidak_kosong);
                    $doc->exportCaption($this->berat_tidak_kosong);
                    $doc->exportCaption($this->kurasi);
                    $doc->exportCaption($this->waktu_entry);
                    $doc->exportCaption($this->waktu_kurasi);
                    $doc->exportCaption($this->waktu_update);
                    $doc->exportCaption($this->editor);
                    $doc->exportCaption($this->kurator);
                    $doc->exportCaption($this->produk_panjang);
                    $doc->exportCaption($this->produk_lebar);
                    $doc->exportCaption($this->produk_tinggi);
                    $doc->exportCaption($this->produk_foto_1);
                    $doc->exportCaption($this->produk_foto_2);
                    $doc->exportCaption($this->produk_foto_3);
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
                        $doc->exportField($this->nik_ukm);
                        $doc->exportField($this->produk_nama);
                        $doc->exportField($this->produk_jenis);
                        $doc->exportField($this->produk_desc);
                        $doc->exportField($this->produk_harga);
                        $doc->exportField($this->produk_foto);
                        $doc->exportField($this->produk_berat);
                        $doc->exportField($this->produk_legal);
                        $doc->exportField($this->judul_sesuai);
                        $doc->exportField($this->foto_bagus);
                        $doc->exportField($this->deskripsi_jelas);
                        $doc->exportField($this->harga_tidak_kosong);
                        $doc->exportField($this->berat_tidak_kosong);
                        $doc->exportField($this->kurasi);
                        $doc->exportField($this->waktu_entry);
                        $doc->exportField($this->waktu_kurasi);
                        $doc->exportField($this->waktu_update);
                        $doc->exportField($this->editor);
                        $doc->exportField($this->kurator);
                        $doc->exportField($this->produk_panjang);
                        $doc->exportField($this->produk_lebar);
                        $doc->exportField($this->produk_tinggi);
                        $doc->exportField($this->produk_foto_1);
                        $doc->exportField($this->produk_foto_2);
                        $doc->exportField($this->produk_foto_3);
                        $doc->exportField($this->catatan);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->nik_ukm);
                        $doc->exportField($this->produk_nama);
                        $doc->exportField($this->produk_jenis);
                        $doc->exportField($this->produk_harga);
                        $doc->exportField($this->produk_foto);
                        $doc->exportField($this->produk_berat);
                        $doc->exportField($this->produk_legal);
                        $doc->exportField($this->judul_sesuai);
                        $doc->exportField($this->foto_bagus);
                        $doc->exportField($this->deskripsi_jelas);
                        $doc->exportField($this->harga_tidak_kosong);
                        $doc->exportField($this->berat_tidak_kosong);
                        $doc->exportField($this->kurasi);
                        $doc->exportField($this->waktu_entry);
                        $doc->exportField($this->waktu_kurasi);
                        $doc->exportField($this->waktu_update);
                        $doc->exportField($this->editor);
                        $doc->exportField($this->kurator);
                        $doc->exportField($this->produk_panjang);
                        $doc->exportField($this->produk_lebar);
                        $doc->exportField($this->produk_tinggi);
                        $doc->exportField($this->produk_foto_1);
                        $doc->exportField($this->produk_foto_2);
                        $doc->exportField($this->produk_foto_3);
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
        $width = ($width > 0) ? $width : Config("THUMBNAIL_DEFAULT_WIDTH");
        $height = ($height > 0) ? $height : Config("THUMBNAIL_DEFAULT_HEIGHT");

        // Set up field name / file name field / file type field
        $fldName = "";
        $fileNameFld = "";
        $fileTypeFld = "";
        if ($fldparm == 'produk_foto') {
            $fldName = "produk_foto";
            $fileNameFld = "produk_foto";
        } elseif ($fldparm == 'produk_foto_1') {
            $fldName = "produk_foto_1";
            $fileNameFld = "produk_foto_1";
        } elseif ($fldparm == 'produk_foto_2') {
            $fldName = "produk_foto_2";
            $fileNameFld = "produk_foto_2";
        } elseif ($fldparm == 'produk_foto_3') {
            $fldName = "produk_foto_3";
            $fileNameFld = "produk_foto_3";
        } elseif ($fldparm == 'produk_foto_4') {
            $fldName = "produk_foto_4";
            $fileNameFld = "produk_foto_4";
        } else {
            return false; // Incorrect field
        }

        // Set up key values
        $ar = explode(Config("COMPOSITE_KEY_SEPARATOR"), $key);
        if (count($ar) == 1) {
            $this->id->CurrentValue = $ar[0];
        } else {
            return false; // Incorrect key
        }

        // Set up filter (WHERE Clause)
        $filter = $this->getRecordFilter();
        $this->CurrentFilter = $filter;
        $sql = $this->getCurrentSql();
        $conn = $this->getConnection();
        $dbtype = GetConnectionType($this->Dbid);
        if ($row = $conn->fetchAssoc($sql)) {
            $val = $row[$fldName];
            if (!EmptyValue($val)) {
                $fld = $this->Fields[$fldName];

                // Binary data
                if ($fld->DataType == DATATYPE_BLOB) {
                    if ($dbtype != "MYSQL") {
                        if (is_resource($val) && get_resource_type($val) == "stream") { // Byte array
                            $val = stream_get_contents($val);
                        }
                    }
                    if ($resize) {
                        ResizeBinary($val, $width, $height, 100, $plugins);
                    }

                    // Write file type
                    if ($fileTypeFld != "" && !EmptyValue($row[$fileTypeFld])) {
                        AddHeader("Content-type", $row[$fileTypeFld]);
                    } else {
                        AddHeader("Content-type", ContentType($val));
                    }

                    // Write file name
                    $downloadPdf = !Config("EMBED_PDF") && Config("DOWNLOAD_PDF_FILE");
                    if ($fileNameFld != "" && !EmptyValue($row[$fileNameFld])) {
                        $fileName = $row[$fileNameFld];
                        $pathinfo = pathinfo($fileName);
                        $ext = strtolower(@$pathinfo["extension"]);
                        $isPdf = SameText($ext, "pdf");
                        if ($downloadPdf || !$isPdf) { // Skip header if not download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    } else {
                        $ext = ContentExtension($val);
                        $isPdf = SameText($ext, ".pdf");
                        if ($isPdf && $downloadPdf) { // Add header if download PDF
                            AddHeader("Content-Disposition", "attachment; filename=\"" . $fileName . "\"");
                        }
                    }

                    // Write file data
                    if (
                        StartsString("PK", $val) &&
                        ContainsString($val, "[Content_Types].xml") &&
                        ContainsString($val, "_rels") &&
                        ContainsString($val, "docProps")
                    ) { // Fix Office 2007 documents
                        if (!EndsString("\0\0\0", $val)) { // Not ends with 3 or 4 \0
                            $val .= "\0\0\0\0";
                        }
                    }

                    // Clear any debug message
                    if (ob_get_length()) {
                        ob_end_clean();
                    }

                    // Write binary data
                    Write($val);

                // Upload to folder
                } else {
                    if ($fld->UploadMultiple) {
                        $files = explode(Config("MULTIPLE_UPLOAD_SEPARATOR"), $val);
                    } else {
                        $files = [$val];
                    }
                    $data = [];
                    $ar = [];
                    foreach ($files as $file) {
                        if (!EmptyValue($file)) {
                            if (Config("ENCRYPT_FILE_PATH")) {
                                $ar[$file] = FullUrl(GetApiUrl(Config("API_FILE_ACTION") .
                                    "/" . $this->TableVar . "/" . Encrypt($fld->physicalUploadPath() . $file)));
                            } else {
                                $ar[$file] = FullUrl($fld->hrefPath() . $file);
                            }
                        }
                    }
                    $data[$fld->Param] = $ar;
                    WriteJson($data);
                }
            }
            return true;
        }
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
