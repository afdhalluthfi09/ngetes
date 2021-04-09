<?php

namespace PHPMaker2021\umkm_sidakui;

use Doctrine\DBAL\ParameterType;

/**
 * Table class for ukm_bantul_fix
 */
class UkmBantulFix extends DbTable
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
    public $Nama_Pemilik_Usaha;
    public $Nomor_Induk_Kependudukan_NIK;
    public $Jenis_Kelamin;
    public $Nama_JalanGangRTRW;
    public $Dusun;
    public $DesaKelurahan;
    public $Kecamatan;
    public $Nomor_TeleponHP;
    public $Alamat_Email;
    public $Nama_Usaha;
    public $Tahun_Mulai_Usaha;
    public $Nama_JalanGangRTRW_1;
    public $Dusun_1;
    public $DesaKelurahan_1;
    public $Kecamatan_1;
    public $Status_Usaha;
    public $No_TelpHP_Usaha_Perusahaan;
    public $Alamat_Email_UsahaPerusahaan;
    public $Alamat_Website_UsahaPerusahaan_Jika_Ada;
    public $Afiliasi_dengan_emarketing;
    public $NPWP;
    public $Nomor_dan_Ijin_Usaha_yang_ada;
    public $Badan_Hukum_Perusahaan;
    public $Jenis_UsahaSektorProduk;
    public $Kegiatan_usaha_yang_dilakukan;
    public $Nama_Merk_Usaha;
    public $Bahan_Baku;
    public $Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku;
    public $Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah;
    public $Negara_Tujuan_Ekspor;
    public $Jumlah_produk_yang_dihasilkan_per_bulan;
    public $Satuan_Produk;
    public $Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah;
    public $Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah;
    public $Harga_aset_yang_dimiliki_dalam_rupiah;
    public $Modal_kerja_per_bulan_dalam_rupiah;
    public $Jumlah_Tenaga_Kerja_Laki_Laki;
    public $Jumlah_Tenaga_Kerja_Perempuan;
    public $Bantuan_Pemerintah;
    public $Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe;
    public $Nama_Jenis_Pinjaman_jika_ada;
    public $Pemberi_Pinjaman_jika_ada;
    public $Jumlah_Pinjaman_dalam_rupiah;
    public $Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya;
    public $Ratarata_omzet_per_tahun_dalam_rupiah;
    public $Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada;
    public $Aktifitas_Produksi_di_Usaha_Saya;
    public $Jumlah_Produksi_di_Usaha_Saya;
    public $Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar;
    public $Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki;
    public $Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk;
    public $Ketersediaan_Bahan_Baku;
    public $Alat_Produksi_di_Usaha_Saya;
    public $Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku;
    public $Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam;
    public $Menerapkan_Standar_Operational_Prosedur_SOP_Produksi;
    public $Mengetahui_Kelebihan__Kekuatan_Produk;
    public $Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama;
    public $Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U;
    public $Memiliki_Nama_Merk__Logo_Dagang;
    public $Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI;
    public $Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk;
    public $Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo;
    public $Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S;
    public $Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh;
    public $Sebaran_Pemasaran_Produk;
    public $Punya_Pelanggan_Tetap;
    public $Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu;
    public $Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk;
    public $Media_Sosial_Untuk_Memasarkan_Produk;
    public $Marketplace_yang_Digunakan_untuk_Memasarkan_Produk;
    public $Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk;
    public $Menggunakan_Website_untuk_Memasarkan_Produk;
    public $Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl;
    public $Memperbarui_Berita__Informasi__Tulisan_di_Website;
    public $Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google;
    public $Menggunakan_Iklan_Berbayar_di_Online;
    public $Usaha_Berbadan_Hukum;
    public $Punya_Izin_Usaha;
    public $Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak;
    public $Punya_Struktur_Organisasi_Usaha;
    public $Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D;
    public $Punya_Sertifikat_Managemen_Mutu_ISO;
    public $Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut;
    public $Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi;
    public $Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi;
    public $Punya_Pencatatan_Keuangan_Usaha;
    public $Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne;
    public $Punya_Pinjaman_Modal_Usaha_dari_Perbankan;
    public $Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik;
    public $Melayani_Transaksi_non_Tunai;
    public $Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri;
    public $Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban;
    public $Punya_Target_Bulanan__Tahunan;
    public $Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak;
    public $Punya_Tenaga_Kerja_Sub_Kontrak;
    public $Besaran_Gaji_Karyawan;
    public $Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan;
    public $Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan;
    public $Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men;

    // Page ID
    public $PageID = ""; // To be overridden by subclass

    // Constructor
    public function __construct()
    {
        global $Language, $CurrentLanguage;
        parent::__construct();

        // Language object
        $Language = Container("language");
        $this->TableVar = 'ukm_bantul_fix';
        $this->TableName = 'ukm_bantul_fix';
        $this->TableType = 'TABLE';

        // Update Table
        $this->UpdateTable = "`ukm_bantul_fix`";
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
        $this->id = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_id', 'id', '`id`', '`id`', 3, 11, -1, false, '`id`', false, false, false, 'FORMATTED TEXT', 'NO');
        $this->id->IsAutoIncrement = true; // Autoincrement field
        $this->id->IsPrimaryKey = true; // Primary key field
        $this->id->Sortable = true; // Allow sort
        $this->id->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->id->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->id->Param, "CustomMsg");
        $this->Fields['id'] = &$this->id;

        // Nama Pemilik Usaha
        $this->Nama_Pemilik_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_Pemilik_Usaha', 'Nama Pemilik Usaha', '`Nama Pemilik Usaha`', '`Nama Pemilik Usaha`', 200, 255, -1, false, '`Nama Pemilik Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_Pemilik_Usaha->Sortable = true; // Allow sort
        $this->Nama_Pemilik_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Pemilik_Usaha->Param, "CustomMsg");
        $this->Fields['Nama Pemilik Usaha'] = &$this->Nama_Pemilik_Usaha;

        // Nomor Induk Kependudukan (NIK)
        $this->Nomor_Induk_Kependudukan_NIK = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nomor_Induk_Kependudukan_NIK', 'Nomor Induk Kependudukan (NIK)', '`Nomor Induk Kependudukan (NIK)`', '`Nomor Induk Kependudukan (NIK)`', 200, 255, -1, false, '`Nomor Induk Kependudukan (NIK)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nomor_Induk_Kependudukan_NIK->Sortable = true; // Allow sort
        $this->Nomor_Induk_Kependudukan_NIK->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nomor_Induk_Kependudukan_NIK->Param, "CustomMsg");
        $this->Fields['Nomor Induk Kependudukan (NIK)'] = &$this->Nomor_Induk_Kependudukan_NIK;

        // Jenis Kelamin
        $this->Jenis_Kelamin = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jenis_Kelamin', 'Jenis Kelamin', '`Jenis Kelamin`', '`Jenis Kelamin`', 200, 255, -1, false, '`Jenis Kelamin`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jenis_Kelamin->Sortable = true; // Allow sort
        $this->Jenis_Kelamin->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jenis_Kelamin->Param, "CustomMsg");
        $this->Fields['Jenis Kelamin'] = &$this->Jenis_Kelamin;

        // Nama Jalan/Gang/RT/RW
        $this->Nama_JalanGangRTRW = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_JalanGangRTRW', 'Nama Jalan/Gang/RT/RW', '`Nama Jalan/Gang/RT/RW`', '`Nama Jalan/Gang/RT/RW`', 200, 255, -1, false, '`Nama Jalan/Gang/RT/RW`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_JalanGangRTRW->Sortable = true; // Allow sort
        $this->Nama_JalanGangRTRW->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_JalanGangRTRW->Param, "CustomMsg");
        $this->Fields['Nama Jalan/Gang/RT/RW'] = &$this->Nama_JalanGangRTRW;

        // Dusun
        $this->Dusun = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Dusun', 'Dusun', '`Dusun`', '`Dusun`', 200, 255, -1, false, '`Dusun`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Dusun->Sortable = true; // Allow sort
        $this->Dusun->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Dusun->Param, "CustomMsg");
        $this->Fields['Dusun'] = &$this->Dusun;

        // Desa/Kelurahan
        $this->DesaKelurahan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_DesaKelurahan', 'Desa/Kelurahan', '`Desa/Kelurahan`', '`Desa/Kelurahan`', 200, 255, -1, false, '`Desa/Kelurahan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DesaKelurahan->Sortable = true; // Allow sort
        $this->DesaKelurahan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DesaKelurahan->Param, "CustomMsg");
        $this->Fields['Desa/Kelurahan'] = &$this->DesaKelurahan;

        // Kecamatan
        $this->Kecamatan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kecamatan', 'Kecamatan', '`Kecamatan`', '`Kecamatan`', 200, 255, -1, false, '`Kecamatan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kecamatan->Sortable = true; // Allow sort
        $this->Kecamatan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kecamatan->Param, "CustomMsg");
        $this->Fields['Kecamatan'] = &$this->Kecamatan;

        // Nomor Telepon/HP
        $this->Nomor_TeleponHP = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nomor_TeleponHP', 'Nomor Telepon/HP', '`Nomor Telepon/HP`', '`Nomor Telepon/HP`', 200, 255, -1, false, '`Nomor Telepon/HP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nomor_TeleponHP->Sortable = true; // Allow sort
        $this->Nomor_TeleponHP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nomor_TeleponHP->Param, "CustomMsg");
        $this->Fields['Nomor Telepon/HP'] = &$this->Nomor_TeleponHP;

        // Alamat Email
        $this->Alamat_Email = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Alamat_Email', 'Alamat Email', '`Alamat Email`', '`Alamat Email`', 200, 255, -1, false, '`Alamat Email`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Alamat_Email->Sortable = true; // Allow sort
        $this->Alamat_Email->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alamat_Email->Param, "CustomMsg");
        $this->Fields['Alamat Email'] = &$this->Alamat_Email;

        // Nama Usaha
        $this->Nama_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_Usaha', 'Nama Usaha', '`Nama Usaha`', '`Nama Usaha`', 200, 255, -1, false, '`Nama Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_Usaha->Sortable = true; // Allow sort
        $this->Nama_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Usaha->Param, "CustomMsg");
        $this->Fields['Nama Usaha'] = &$this->Nama_Usaha;

        // Tahun Mulai Usaha
        $this->Tahun_Mulai_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Tahun_Mulai_Usaha', 'Tahun Mulai Usaha', '`Tahun Mulai Usaha`', '`Tahun Mulai Usaha`', 200, 255, -1, false, '`Tahun Mulai Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Tahun_Mulai_Usaha->Sortable = true; // Allow sort
        $this->Tahun_Mulai_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Tahun_Mulai_Usaha->Param, "CustomMsg");
        $this->Fields['Tahun Mulai Usaha'] = &$this->Tahun_Mulai_Usaha;

        // Nama Jalan/Gang/RT/RW (1)
        $this->Nama_JalanGangRTRW_1 = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_JalanGangRTRW_1', 'Nama Jalan/Gang/RT/RW (1)', '`Nama Jalan/Gang/RT/RW (1)`', '`Nama Jalan/Gang/RT/RW (1)`', 200, 255, -1, false, '`Nama Jalan/Gang/RT/RW (1)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_JalanGangRTRW_1->Sortable = true; // Allow sort
        $this->Nama_JalanGangRTRW_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_JalanGangRTRW_1->Param, "CustomMsg");
        $this->Fields['Nama Jalan/Gang/RT/RW (1)'] = &$this->Nama_JalanGangRTRW_1;

        // Dusun (1)
        $this->Dusun_1 = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Dusun_1', 'Dusun (1)', '`Dusun (1)`', '`Dusun (1)`', 200, 255, -1, false, '`Dusun (1)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Dusun_1->Sortable = true; // Allow sort
        $this->Dusun_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Dusun_1->Param, "CustomMsg");
        $this->Fields['Dusun (1)'] = &$this->Dusun_1;

        // Desa/Kelurahan (1)
        $this->DesaKelurahan_1 = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_DesaKelurahan_1', 'Desa/Kelurahan (1)', '`Desa/Kelurahan (1)`', '`Desa/Kelurahan (1)`', 200, 255, -1, false, '`Desa/Kelurahan (1)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->DesaKelurahan_1->Sortable = true; // Allow sort
        $this->DesaKelurahan_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->DesaKelurahan_1->Param, "CustomMsg");
        $this->Fields['Desa/Kelurahan (1)'] = &$this->DesaKelurahan_1;

        // Kecamatan (1)
        $this->Kecamatan_1 = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kecamatan_1', 'Kecamatan (1)', '`Kecamatan (1)`', '`Kecamatan (1)`', 200, 255, -1, false, '`Kecamatan (1)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kecamatan_1->Sortable = true; // Allow sort
        $this->Kecamatan_1->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kecamatan_1->Param, "CustomMsg");
        $this->Fields['Kecamatan (1)'] = &$this->Kecamatan_1;

        // Status Usaha
        $this->Status_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Status_Usaha', 'Status Usaha', '`Status Usaha`', '`Status Usaha`', 200, 255, -1, false, '`Status Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Status_Usaha->Sortable = true; // Allow sort
        $this->Status_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Status_Usaha->Param, "CustomMsg");
        $this->Fields['Status Usaha'] = &$this->Status_Usaha;

        // No Telp/HP Usaha Perusahaan
        $this->No_TelpHP_Usaha_Perusahaan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_No_TelpHP_Usaha_Perusahaan', 'No Telp/HP Usaha Perusahaan', '`No Telp/HP Usaha Perusahaan`', '`No Telp/HP Usaha Perusahaan`', 200, 255, -1, false, '`No Telp/HP Usaha Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->No_TelpHP_Usaha_Perusahaan->Sortable = true; // Allow sort
        $this->No_TelpHP_Usaha_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->No_TelpHP_Usaha_Perusahaan->Param, "CustomMsg");
        $this->Fields['No Telp/HP Usaha Perusahaan'] = &$this->No_TelpHP_Usaha_Perusahaan;

        // Alamat Email Usaha/Perusahaan
        $this->Alamat_Email_UsahaPerusahaan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Alamat_Email_UsahaPerusahaan', 'Alamat Email Usaha/Perusahaan', '`Alamat Email Usaha/Perusahaan`', '`Alamat Email Usaha/Perusahaan`', 200, 255, -1, false, '`Alamat Email Usaha/Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Alamat_Email_UsahaPerusahaan->Sortable = true; // Allow sort
        $this->Alamat_Email_UsahaPerusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alamat_Email_UsahaPerusahaan->Param, "CustomMsg");
        $this->Fields['Alamat Email Usaha/Perusahaan'] = &$this->Alamat_Email_UsahaPerusahaan;

        // Alamat Website Usaha/Perusahaan (Jika Ada)
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Alamat_Website_UsahaPerusahaan_Jika_Ada', 'Alamat Website Usaha/Perusahaan (Jika Ada)', '`Alamat Website Usaha/Perusahaan (Jika Ada)`', '`Alamat Website Usaha/Perusahaan (Jika Ada)`', 200, 255, -1, false, '`Alamat Website Usaha/Perusahaan (Jika Ada)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->Sortable = true; // Allow sort
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->Param, "CustomMsg");
        $this->Fields['Alamat Website Usaha/Perusahaan (Jika Ada)'] = &$this->Alamat_Website_UsahaPerusahaan_Jika_Ada;

        // Afiliasi dengan e-marketing
        $this->Afiliasi_dengan_emarketing = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Afiliasi_dengan_emarketing', 'Afiliasi dengan e-marketing', '`Afiliasi dengan e-marketing`', '`Afiliasi dengan e-marketing`', 200, 255, -1, false, '`Afiliasi dengan e-marketing`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Afiliasi_dengan_emarketing->Sortable = true; // Allow sort
        $this->Afiliasi_dengan_emarketing->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Afiliasi_dengan_emarketing->Param, "CustomMsg");
        $this->Fields['Afiliasi dengan e-marketing'] = &$this->Afiliasi_dengan_emarketing;

        // NPWP
        $this->NPWP = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_NPWP', 'NPWP', '`NPWP`', '`NPWP`', 200, 255, -1, false, '`NPWP`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->NPWP->Sortable = true; // Allow sort
        $this->NPWP->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->NPWP->Param, "CustomMsg");
        $this->Fields['NPWP'] = &$this->NPWP;

        // Nomor dan Ijin Usaha yang ada
        $this->Nomor_dan_Ijin_Usaha_yang_ada = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nomor_dan_Ijin_Usaha_yang_ada', 'Nomor dan Ijin Usaha yang ada', '`Nomor dan Ijin Usaha yang ada`', '`Nomor dan Ijin Usaha yang ada`', 200, 255, -1, false, '`Nomor dan Ijin Usaha yang ada`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nomor_dan_Ijin_Usaha_yang_ada->Sortable = true; // Allow sort
        $this->Nomor_dan_Ijin_Usaha_yang_ada->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nomor_dan_Ijin_Usaha_yang_ada->Param, "CustomMsg");
        $this->Fields['Nomor dan Ijin Usaha yang ada'] = &$this->Nomor_dan_Ijin_Usaha_yang_ada;

        // Badan Hukum Perusahaan
        $this->Badan_Hukum_Perusahaan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Badan_Hukum_Perusahaan', 'Badan Hukum Perusahaan', '`Badan Hukum Perusahaan`', '`Badan Hukum Perusahaan`', 200, 255, -1, false, '`Badan Hukum Perusahaan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Badan_Hukum_Perusahaan->Sortable = true; // Allow sort
        $this->Badan_Hukum_Perusahaan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Badan_Hukum_Perusahaan->Param, "CustomMsg");
        $this->Fields['Badan Hukum Perusahaan'] = &$this->Badan_Hukum_Perusahaan;

        // Jenis Usaha/Sektor/Produk
        $this->Jenis_UsahaSektorProduk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jenis_UsahaSektorProduk', 'Jenis Usaha/Sektor/Produk', '`Jenis Usaha/Sektor/Produk`', '`Jenis Usaha/Sektor/Produk`', 200, 255, -1, false, '`Jenis Usaha/Sektor/Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jenis_UsahaSektorProduk->Sortable = true; // Allow sort
        $this->Jenis_UsahaSektorProduk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jenis_UsahaSektorProduk->Param, "CustomMsg");
        $this->Fields['Jenis Usaha/Sektor/Produk'] = &$this->Jenis_UsahaSektorProduk;

        // Kegiatan usaha yang dilakukan
        $this->Kegiatan_usaha_yang_dilakukan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kegiatan_usaha_yang_dilakukan', 'Kegiatan usaha yang dilakukan', '`Kegiatan usaha yang dilakukan`', '`Kegiatan usaha yang dilakukan`', 200, 255, -1, false, '`Kegiatan usaha yang dilakukan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kegiatan_usaha_yang_dilakukan->Sortable = true; // Allow sort
        $this->Kegiatan_usaha_yang_dilakukan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kegiatan_usaha_yang_dilakukan->Param, "CustomMsg");
        $this->Fields['Kegiatan usaha yang dilakukan'] = &$this->Kegiatan_usaha_yang_dilakukan;

        // Nama Merk Usaha
        $this->Nama_Merk_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_Merk_Usaha', 'Nama Merk Usaha', '`Nama Merk Usaha`', '`Nama Merk Usaha`', 200, 255, -1, false, '`Nama Merk Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_Merk_Usaha->Sortable = true; // Allow sort
        $this->Nama_Merk_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Merk_Usaha->Param, "CustomMsg");
        $this->Fields['Nama Merk Usaha'] = &$this->Nama_Merk_Usaha;

        // Bahan Baku
        $this->Bahan_Baku = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Bahan_Baku', 'Bahan Baku', '`Bahan Baku`', '`Bahan Baku`', 200, 255, -1, false, '`Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bahan_Baku->Sortable = true; // Allow sort
        $this->Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Bahan Baku'] = &$this->Bahan_Baku;

        // Sumber Bahan Baku/Daerah Asal Bahan Baku
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku', 'Sumber Bahan Baku/Daerah Asal Bahan Baku', '`Sumber Bahan Baku/Daerah Asal Bahan Baku`', '`Sumber Bahan Baku/Daerah Asal Bahan Baku`', 200, 255, -1, false, '`Sumber Bahan Baku/Daerah Asal Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->Sortable = true; // Allow sort
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Sumber Bahan Baku/Daerah Asal Bahan Baku'] = &$this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku;

        // Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah', 'Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)', '`Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)`', '`Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)`', 5, 255, -1, false, '`Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->Sortable = true; // Allow sort
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)'] = &$this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah;

        // Negara Tujuan Ekspor
        $this->Negara_Tujuan_Ekspor = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Negara_Tujuan_Ekspor', 'Negara Tujuan Ekspor', '`Negara Tujuan Ekspor`', '`Negara Tujuan Ekspor`', 200, 255, -1, false, '`Negara Tujuan Ekspor`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Negara_Tujuan_Ekspor->Sortable = true; // Allow sort
        $this->Negara_Tujuan_Ekspor->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Negara_Tujuan_Ekspor->Param, "CustomMsg");
        $this->Fields['Negara Tujuan Ekspor'] = &$this->Negara_Tujuan_Ekspor;

        // Jumlah produk yang dihasilkan per bulan
        $this->Jumlah_produk_yang_dihasilkan_per_bulan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jumlah_produk_yang_dihasilkan_per_bulan', 'Jumlah produk yang dihasilkan per bulan', '`Jumlah produk yang dihasilkan per bulan`', '`Jumlah produk yang dihasilkan per bulan`', 4, 255, -1, false, '`Jumlah produk yang dihasilkan per bulan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->Sortable = true; // Allow sort
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_produk_yang_dihasilkan_per_bulan->Param, "CustomMsg");
        $this->Fields['Jumlah produk yang dihasilkan per bulan'] = &$this->Jumlah_produk_yang_dihasilkan_per_bulan;

        // Satuan Produk
        $this->Satuan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Satuan_Produk', 'Satuan Produk', '`Satuan Produk`', '`Satuan Produk`', 200, 255, -1, false, '`Satuan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Satuan_Produk->Sortable = true; // Allow sort
        $this->Satuan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Satuan_Produk->Param, "CustomMsg");
        $this->Fields['Satuan Produk'] = &$this->Satuan_Produk;

        // Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah', 'Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)', '`Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)`', '`Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)`', 5, 255, -1, false, '`Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->Sortable = true; // Allow sort
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)'] = &$this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah;

        // Harga sewa tanah dan bangunan usaha (dalam rupiah)
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah', 'Harga sewa tanah dan bangunan usaha (dalam rupiah)', '`Harga sewa tanah dan bangunan usaha (dalam rupiah)`', '`Harga sewa tanah dan bangunan usaha (dalam rupiah)`', 5, 255, -1, false, '`Harga sewa tanah dan bangunan usaha (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->Sortable = true; // Allow sort
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Harga sewa tanah dan bangunan usaha (dalam rupiah)'] = &$this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah;

        // Harga aset yang dimiliki (dalam rupiah)
        $this->Harga_aset_yang_dimiliki_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Harga_aset_yang_dimiliki_dalam_rupiah', 'Harga aset yang dimiliki (dalam rupiah)', '`Harga aset yang dimiliki (dalam rupiah)`', '`Harga aset yang dimiliki (dalam rupiah)`', 5, 255, -1, false, '`Harga aset yang dimiliki (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->Sortable = true; // Allow sort
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Harga_aset_yang_dimiliki_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Harga aset yang dimiliki (dalam rupiah)'] = &$this->Harga_aset_yang_dimiliki_dalam_rupiah;

        // Modal kerja per bulan (dalam rupiah)
        $this->Modal_kerja_per_bulan_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Modal_kerja_per_bulan_dalam_rupiah', 'Modal kerja per bulan (dalam rupiah)', '`Modal kerja per bulan (dalam rupiah)`', '`Modal kerja per bulan (dalam rupiah)`', 5, 255, -1, false, '`Modal kerja per bulan (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Modal_kerja_per_bulan_dalam_rupiah->Sortable = true; // Allow sort
        $this->Modal_kerja_per_bulan_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Modal_kerja_per_bulan_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Modal_kerja_per_bulan_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Modal_kerja_per_bulan_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Modal kerja per bulan (dalam rupiah)'] = &$this->Modal_kerja_per_bulan_dalam_rupiah;

        // Jumlah Tenaga Kerja Laki Laki
        $this->Jumlah_Tenaga_Kerja_Laki_Laki = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jumlah_Tenaga_Kerja_Laki_Laki', 'Jumlah Tenaga Kerja Laki Laki', '`Jumlah Tenaga Kerja Laki Laki`', '`Jumlah Tenaga Kerja Laki Laki`', 3, 255, -1, false, '`Jumlah Tenaga Kerja Laki Laki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->Sortable = true; // Allow sort
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Tenaga_Kerja_Laki_Laki->Param, "CustomMsg");
        $this->Fields['Jumlah Tenaga Kerja Laki Laki'] = &$this->Jumlah_Tenaga_Kerja_Laki_Laki;

        // Jumlah Tenaga Kerja Perempuan
        $this->Jumlah_Tenaga_Kerja_Perempuan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jumlah_Tenaga_Kerja_Perempuan', 'Jumlah Tenaga Kerja Perempuan', '`Jumlah Tenaga Kerja Perempuan`', '`Jumlah Tenaga Kerja Perempuan`', 3, 255, -1, false, '`Jumlah Tenaga Kerja Perempuan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Tenaga_Kerja_Perempuan->Sortable = true; // Allow sort
        $this->Jumlah_Tenaga_Kerja_Perempuan->DefaultErrorMessage = $Language->phrase("IncorrectInteger");
        $this->Jumlah_Tenaga_Kerja_Perempuan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Tenaga_Kerja_Perempuan->Param, "CustomMsg");
        $this->Fields['Jumlah Tenaga Kerja Perempuan'] = &$this->Jumlah_Tenaga_Kerja_Perempuan;

        // Bantuan Pemerintah
        $this->Bantuan_Pemerintah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Bantuan_Pemerintah', 'Bantuan Pemerintah', '`Bantuan Pemerintah`', '`Bantuan Pemerintah`', 200, 255, -1, false, '`Bantuan Pemerintah`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bantuan_Pemerintah->Sortable = true; // Allow sort
        $this->Bantuan_Pemerintah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bantuan_Pemerintah->Param, "CustomMsg");
        $this->Fields['Bantuan Pemerintah'] = &$this->Bantuan_Pemerintah;

        // Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe', 'Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe', '`Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe`', '`Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe`', 200, 255, -1, false, '`Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->Sortable = true; // Allow sort
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->Param, "CustomMsg");
        $this->Fields['Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe'] = &$this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe;

        // Nama Jenis Pinjaman (jika ada)
        $this->Nama_Jenis_Pinjaman_jika_ada = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Nama_Jenis_Pinjaman_jika_ada', 'Nama Jenis Pinjaman (jika ada)', '`Nama Jenis Pinjaman (jika ada)`', '`Nama Jenis Pinjaman (jika ada)`', 200, 255, -1, false, '`Nama Jenis Pinjaman (jika ada)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Nama_Jenis_Pinjaman_jika_ada->Sortable = true; // Allow sort
        $this->Nama_Jenis_Pinjaman_jika_ada->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Nama_Jenis_Pinjaman_jika_ada->Param, "CustomMsg");
        $this->Fields['Nama Jenis Pinjaman (jika ada)'] = &$this->Nama_Jenis_Pinjaman_jika_ada;

        // Pemberi Pinjaman (jika ada)
        $this->Pemberi_Pinjaman_jika_ada = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Pemberi_Pinjaman_jika_ada', 'Pemberi Pinjaman (jika ada)', '`Pemberi Pinjaman (jika ada)`', '`Pemberi Pinjaman (jika ada)`', 200, 255, -1, false, '`Pemberi Pinjaman (jika ada)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Pemberi_Pinjaman_jika_ada->Sortable = true; // Allow sort
        $this->Pemberi_Pinjaman_jika_ada->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pemberi_Pinjaman_jika_ada->Param, "CustomMsg");
        $this->Fields['Pemberi Pinjaman (jika ada)'] = &$this->Pemberi_Pinjaman_jika_ada;

        // Jumlah Pinjaman (dalam rupiah)
        $this->Jumlah_Pinjaman_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jumlah_Pinjaman_dalam_rupiah', 'Jumlah Pinjaman (dalam rupiah)', '`Jumlah Pinjaman (dalam rupiah)`', '`Jumlah Pinjaman (dalam rupiah)`', 5, 255, -1, false, '`Jumlah Pinjaman (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Pinjaman_dalam_rupiah->Sortable = true; // Allow sort
        $this->Jumlah_Pinjaman_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Jumlah_Pinjaman_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Jumlah_Pinjaman_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Pinjaman_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Jumlah Pinjaman (dalam rupiah)'] = &$this->Jumlah_Pinjaman_dalam_rupiah;

        // Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya', 'Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya', '`Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya`', '`Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya`', 200, 255, -1, false, '`Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->Sortable = true; // Allow sort
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->Param, "CustomMsg");
        $this->Fields['Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya'] = &$this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya;

        // Rata-rata omzet per tahun (dalam rupiah)
        $this->Ratarata_omzet_per_tahun_dalam_rupiah = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Ratarata_omzet_per_tahun_dalam_rupiah', 'Rata-rata omzet per tahun (dalam rupiah)', '`Rata-rata omzet per tahun (dalam rupiah)`', '`Rata-rata omzet per tahun (dalam rupiah)`', 5, 255, -1, false, '`Rata-rata omzet per tahun (dalam rupiah)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->Sortable = true; // Allow sort
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->DefaultDecimalPrecision = 2; // Default decimal precision
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->DefaultErrorMessage = $Language->phrase("IncorrectFloat");
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Ratarata_omzet_per_tahun_dalam_rupiah->Param, "CustomMsg");
        $this->Fields['Rata-rata omzet per tahun (dalam rupiah)'] = &$this->Ratarata_omzet_per_tahun_dalam_rupiah;

        // Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada', 'Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)', '`Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)`', '`Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)`', 200, 255, -1, false, '`Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->Sortable = true; // Allow sort
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->Param, "CustomMsg");
        $this->Fields['Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)'] = &$this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada;

        // Aktifitas Produksi di Usaha Saya
        $this->Aktifitas_Produksi_di_Usaha_Saya = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Aktifitas_Produksi_di_Usaha_Saya', 'Aktifitas Produksi di Usaha Saya', '`Aktifitas Produksi di Usaha Saya`', '`Aktifitas Produksi di Usaha Saya`', 200, 255, -1, false, '`Aktifitas Produksi di Usaha Saya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Aktifitas_Produksi_di_Usaha_Saya->Sortable = true; // Allow sort
        $this->Aktifitas_Produksi_di_Usaha_Saya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Aktifitas_Produksi_di_Usaha_Saya->Param, "CustomMsg");
        $this->Fields['Aktifitas Produksi di Usaha Saya'] = &$this->Aktifitas_Produksi_di_Usaha_Saya;

        // Jumlah Produksi di Usaha Saya
        $this->Jumlah_Produksi_di_Usaha_Saya = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Jumlah_Produksi_di_Usaha_Saya', 'Jumlah Produksi di Usaha Saya', '`Jumlah Produksi di Usaha Saya`', '`Jumlah Produksi di Usaha Saya`', 200, 255, -1, false, '`Jumlah Produksi di Usaha Saya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Jumlah_Produksi_di_Usaha_Saya->Sortable = true; // Allow sort
        $this->Jumlah_Produksi_di_Usaha_Saya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Jumlah_Produksi_di_Usaha_Saya->Param, "CustomMsg");
        $this->Fields['Jumlah Produksi di Usaha Saya'] = &$this->Jumlah_Produksi_di_Usaha_Saya;

        // Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar', 'Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar', '`Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar`', '`Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar`', 200, 255, -1, false, '`Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->Sortable = true; // Allow sort
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->Param, "CustomMsg");
        $this->Fields['Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar'] = &$this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar;

        // Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki', 'Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki', '`Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki`', '`Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki`', 200, 255, -1, false, '`Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->Sortable = true; // Allow sort
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->Param, "CustomMsg");
        $this->Fields['Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki'] = &$this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki;

        // Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk', 'Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk', '`Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk`', '`Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk`', 200, 255, -1, false, '`Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->Sortable = true; // Allow sort
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->Param, "CustomMsg");
        $this->Fields['Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk'] = &$this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk;

        // Ketersediaan Bahan Baku
        $this->Ketersediaan_Bahan_Baku = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Ketersediaan_Bahan_Baku', 'Ketersediaan Bahan Baku', '`Ketersediaan Bahan Baku`', '`Ketersediaan Bahan Baku`', 200, 255, -1, false, '`Ketersediaan Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Ketersediaan_Bahan_Baku->Sortable = true; // Allow sort
        $this->Ketersediaan_Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Ketersediaan_Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Ketersediaan Bahan Baku'] = &$this->Ketersediaan_Bahan_Baku;

        // Alat Produksi di Usaha Saya
        $this->Alat_Produksi_di_Usaha_Saya = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Alat_Produksi_di_Usaha_Saya', 'Alat Produksi di Usaha Saya', '`Alat Produksi di Usaha Saya`', '`Alat Produksi di Usaha Saya`', 200, 255, -1, false, '`Alat Produksi di Usaha Saya`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Alat_Produksi_di_Usaha_Saya->Sortable = true; // Allow sort
        $this->Alat_Produksi_di_Usaha_Saya->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Alat_Produksi_di_Usaha_Saya->Param, "CustomMsg");
        $this->Fields['Alat Produksi di Usaha Saya'] = &$this->Alat_Produksi_di_Usaha_Saya;

        // Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku', 'Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku', '`Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku`', '`Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku`', 200, 255, -1, false, '`Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->Sortable = true; // Allow sort
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->Param, "CustomMsg");
        $this->Fields['Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku'] = &$this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku;

        // Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam', 'Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam', '`Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam`', '`Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam`', 200, 255, -1, false, '`Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->Sortable = true; // Allow sort
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->Param, "CustomMsg");
        $this->Fields['Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam'] = &$this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam;

        // Menerapkan Standar Operational Prosedur (SOP) Produksi
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Menerapkan_Standar_Operational_Prosedur_SOP_Produksi', 'Menerapkan Standar Operational Prosedur (SOP) Produksi', '`Menerapkan Standar Operational Prosedur (SOP) Produksi`', '`Menerapkan Standar Operational Prosedur (SOP) Produksi`', 200, 255, -1, false, '`Menerapkan Standar Operational Prosedur (SOP) Produksi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->Sortable = true; // Allow sort
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->Param, "CustomMsg");
        $this->Fields['Menerapkan Standar Operational Prosedur (SOP) Produksi'] = &$this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi;

        // Mengetahui Kelebihan / Kekuatan Produk
        $this->Mengetahui_Kelebihan__Kekuatan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Mengetahui_Kelebihan__Kekuatan_Produk', 'Mengetahui Kelebihan / Kekuatan Produk', '`Mengetahui Kelebihan / Kekuatan Produk`', '`Mengetahui Kelebihan / Kekuatan Produk`', 200, 255, -1, false, '`Mengetahui Kelebihan / Kekuatan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->Sortable = true; // Allow sort
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Mengetahui_Kelebihan__Kekuatan_Produk->Param, "CustomMsg");
        $this->Fields['Mengetahui Kelebihan / Kekuatan Produk'] = &$this->Mengetahui_Kelebihan__Kekuatan_Produk;

        // Mengetahui Target Pasar Utama (Calon Pembeli Utama)
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama', 'Mengetahui Target Pasar Utama (Calon Pembeli Utama)', '`Mengetahui Target Pasar Utama (Calon Pembeli Utama)`', '`Mengetahui Target Pasar Utama (Calon Pembeli Utama)`', 200, 255, -1, false, '`Mengetahui Target Pasar Utama (Calon Pembeli Utama)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->Sortable = true; // Allow sort
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->Param, "CustomMsg");
        $this->Fields['Mengetahui Target Pasar Utama (Calon Pembeli Utama)'] = &$this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama;

        // Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U', 'Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U', '`Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U`', '`Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U`', 200, 255, -1, false, '`Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->Sortable = true; // Allow sort
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->Param, "CustomMsg");
        $this->Fields['Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U'] = &$this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U;

        // Memiliki Nama Merk / Logo Dagang
        $this->Memiliki_Nama_Merk__Logo_Dagang = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memiliki_Nama_Merk__Logo_Dagang', 'Memiliki Nama Merk / Logo Dagang', '`Memiliki Nama Merk / Logo Dagang`', '`Memiliki Nama Merk / Logo Dagang`', 200, 255, -1, false, '`Memiliki Nama Merk / Logo Dagang`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memiliki_Nama_Merk__Logo_Dagang->Sortable = true; // Allow sort
        $this->Memiliki_Nama_Merk__Logo_Dagang->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memiliki_Nama_Merk__Logo_Dagang->Param, "CustomMsg");
        $this->Fields['Memiliki Nama Merk / Logo Dagang'] = &$this->Memiliki_Nama_Merk__Logo_Dagang;

        // Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI', 'Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI', '`Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI`', '`Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI`', 200, 255, -1, false, '`Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->Sortable = true; // Allow sort
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->Param, "CustomMsg");
        $this->Fields['Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI'] = &$this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI;

        // Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk', 'Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)', '`Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)`', '`Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)`', 200, 255, -1, false, '`Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->Sortable = true; // Allow sort
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->Param, "CustomMsg");
        $this->Fields['Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)'] = &$this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk;

        // Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo', 'Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo', '`Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo`', '`Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo`', 200, 255, -1, false, '`Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->Sortable = true; // Allow sort
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->Param, "CustomMsg");
        $this->Fields['Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo'] = &$this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo;

        // Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S', 'Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S', '`Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S`', '`Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S`', 200, 255, -1, false, '`Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->Sortable = true; // Allow sort
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->Param, "CustomMsg");
        $this->Fields['Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S'] = &$this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S;

        // Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh', 'Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh', '`Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh`', '`Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh`', 200, 255, -1, false, '`Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->Sortable = true; // Allow sort
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->Param, "CustomMsg");
        $this->Fields['Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh'] = &$this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh;

        // Sebaran Pemasaran Produk
        $this->Sebaran_Pemasaran_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Sebaran_Pemasaran_Produk', 'Sebaran Pemasaran Produk', '`Sebaran Pemasaran Produk`', '`Sebaran Pemasaran Produk`', 200, 255, -1, false, '`Sebaran Pemasaran Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Sebaran_Pemasaran_Produk->Sortable = true; // Allow sort
        $this->Sebaran_Pemasaran_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Sebaran_Pemasaran_Produk->Param, "CustomMsg");
        $this->Fields['Sebaran Pemasaran Produk'] = &$this->Sebaran_Pemasaran_Produk;

        // Punya Pelanggan Tetap
        $this->Punya_Pelanggan_Tetap = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Pelanggan_Tetap', 'Punya Pelanggan Tetap', '`Punya Pelanggan Tetap`', '`Punya Pelanggan Tetap`', 200, 255, -1, false, '`Punya Pelanggan Tetap`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Pelanggan_Tetap->Sortable = true; // Allow sort
        $this->Punya_Pelanggan_Tetap->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Pelanggan_Tetap->Param, "CustomMsg");
        $this->Fields['Punya Pelanggan Tetap'] = &$this->Punya_Pelanggan_Tetap;

        // Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu', 'Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu', '`Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu`', '`Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu`', 200, 255, -1, false, '`Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->Sortable = true; // Allow sort
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->Param, "CustomMsg");
        $this->Fields['Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu'] = &$this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu;

        // Media Chatting yang Digunakan untuk Memasarkan Produk
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk', 'Media Chatting yang Digunakan untuk Memasarkan Produk', '`Media Chatting yang Digunakan untuk Memasarkan Produk`', '`Media Chatting yang Digunakan untuk Memasarkan Produk`', 200, 255, -1, false, '`Media Chatting yang Digunakan untuk Memasarkan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->Sortable = true; // Allow sort
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->Param, "CustomMsg");
        $this->Fields['Media Chatting yang Digunakan untuk Memasarkan Produk'] = &$this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk;

        // Media Sosial Untuk Memasarkan Produk
        $this->Media_Sosial_Untuk_Memasarkan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Media_Sosial_Untuk_Memasarkan_Produk', 'Media Sosial Untuk Memasarkan Produk', '`Media Sosial Untuk Memasarkan Produk`', '`Media Sosial Untuk Memasarkan Produk`', 200, 255, -1, false, '`Media Sosial Untuk Memasarkan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Media_Sosial_Untuk_Memasarkan_Produk->Sortable = true; // Allow sort
        $this->Media_Sosial_Untuk_Memasarkan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Media_Sosial_Untuk_Memasarkan_Produk->Param, "CustomMsg");
        $this->Fields['Media Sosial Untuk Memasarkan Produk'] = &$this->Media_Sosial_Untuk_Memasarkan_Produk;

        // Marketplace yang Digunakan untuk Memasarkan Produk
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Marketplace_yang_Digunakan_untuk_Memasarkan_Produk', 'Marketplace yang Digunakan untuk Memasarkan Produk', '`Marketplace yang Digunakan untuk Memasarkan Produk`', '`Marketplace yang Digunakan untuk Memasarkan Produk`', 200, 255, -1, false, '`Marketplace yang Digunakan untuk Memasarkan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->Sortable = true; // Allow sort
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->Param, "CustomMsg");
        $this->Fields['Marketplace yang Digunakan untuk Memasarkan Produk'] = &$this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk;

        // Menggunakan Google Bisnisku untuk Memasarkan Produk
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk', 'Menggunakan Google Bisnisku untuk Memasarkan Produk', '`Menggunakan Google Bisnisku untuk Memasarkan Produk`', '`Menggunakan Google Bisnisku untuk Memasarkan Produk`', 200, 255, -1, false, '`Menggunakan Google Bisnisku untuk Memasarkan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->Sortable = true; // Allow sort
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->Param, "CustomMsg");
        $this->Fields['Menggunakan Google Bisnisku untuk Memasarkan Produk'] = &$this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk;

        // Menggunakan Website untuk Memasarkan Produk
        $this->Menggunakan_Website_untuk_Memasarkan_Produk = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Menggunakan_Website_untuk_Memasarkan_Produk', 'Menggunakan Website untuk Memasarkan Produk', '`Menggunakan Website untuk Memasarkan Produk`', '`Menggunakan Website untuk Memasarkan Produk`', 200, 255, -1, false, '`Menggunakan Website untuk Memasarkan Produk`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->Sortable = true; // Allow sort
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Menggunakan_Website_untuk_Memasarkan_Produk->Param, "CustomMsg");
        $this->Fields['Menggunakan Website untuk Memasarkan Produk'] = &$this->Menggunakan_Website_untuk_Memasarkan_Produk;

        // Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl', 'Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl', '`Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl`', '`Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl`', 200, 255, -1, false, '`Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->Sortable = true; // Allow sort
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->Param, "CustomMsg");
        $this->Fields['Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl'] = &$this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl;

        // Memperbarui Berita / Informasi / Tulisan di Website
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memperbarui_Berita__Informasi__Tulisan_di_Website', 'Memperbarui Berita / Informasi / Tulisan di Website', '`Memperbarui Berita / Informasi / Tulisan di Website`', '`Memperbarui Berita / Informasi / Tulisan di Website`', 200, 255, -1, false, '`Memperbarui Berita / Informasi / Tulisan di Website`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->Sortable = true; // Allow sort
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->Param, "CustomMsg");
        $this->Fields['Memperbarui Berita / Informasi / Tulisan di Website'] = &$this->Memperbarui_Berita__Informasi__Tulisan_di_Website;

        // Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google', 'Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google', '`Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google`', '`Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google`', 200, 255, -1, false, '`Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->Sortable = true; // Allow sort
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->Param, "CustomMsg");
        $this->Fields['Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google'] = &$this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google;

        // Menggunakan Iklan Berbayar di Online
        $this->Menggunakan_Iklan_Berbayar_di_Online = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Menggunakan_Iklan_Berbayar_di_Online', 'Menggunakan Iklan Berbayar di Online', '`Menggunakan Iklan Berbayar di Online`', '`Menggunakan Iklan Berbayar di Online`', 200, 255, -1, false, '`Menggunakan Iklan Berbayar di Online`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Menggunakan_Iklan_Berbayar_di_Online->Sortable = true; // Allow sort
        $this->Menggunakan_Iklan_Berbayar_di_Online->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Menggunakan_Iklan_Berbayar_di_Online->Param, "CustomMsg");
        $this->Fields['Menggunakan Iklan Berbayar di Online'] = &$this->Menggunakan_Iklan_Berbayar_di_Online;

        // Usaha Berbadan Hukum
        $this->Usaha_Berbadan_Hukum = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Usaha_Berbadan_Hukum', 'Usaha Berbadan Hukum', '`Usaha Berbadan Hukum`', '`Usaha Berbadan Hukum`', 200, 255, -1, false, '`Usaha Berbadan Hukum`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Usaha_Berbadan_Hukum->Sortable = true; // Allow sort
        $this->Usaha_Berbadan_Hukum->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Usaha_Berbadan_Hukum->Param, "CustomMsg");
        $this->Fields['Usaha Berbadan Hukum'] = &$this->Usaha_Berbadan_Hukum;

        // Punya Izin Usaha
        $this->Punya_Izin_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Izin_Usaha', 'Punya Izin Usaha', '`Punya Izin Usaha`', '`Punya Izin Usaha`', 200, 255, -1, false, '`Punya Izin Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Izin_Usaha->Sortable = true; // Allow sort
        $this->Punya_Izin_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Izin_Usaha->Param, "CustomMsg");
        $this->Fields['Punya Izin Usaha'] = &$this->Punya_Izin_Usaha;

        // Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak', 'Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak', '`Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak`', '`Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak`', 200, 255, -1, false, '`Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->Sortable = true; // Allow sort
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->Param, "CustomMsg");
        $this->Fields['Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak'] = &$this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak;

        // Punya Struktur Organisasi Usaha
        $this->Punya_Struktur_Organisasi_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Struktur_Organisasi_Usaha', 'Punya Struktur Organisasi Usaha', '`Punya Struktur Organisasi Usaha`', '`Punya Struktur Organisasi Usaha`', 200, 255, -1, false, '`Punya Struktur Organisasi Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Struktur_Organisasi_Usaha->Sortable = true; // Allow sort
        $this->Punya_Struktur_Organisasi_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Struktur_Organisasi_Usaha->Param, "CustomMsg");
        $this->Fields['Punya Struktur Organisasi Usaha'] = &$this->Punya_Struktur_Organisasi_Usaha;

        // Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D', 'Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D', '`Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D`', '`Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D`', 200, 255, -1, false, '`Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->Sortable = true; // Allow sort
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->Param, "CustomMsg");
        $this->Fields['Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D'] = &$this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D;

        // Punya Sertifikat Managemen Mutu ISO
        $this->Punya_Sertifikat_Managemen_Mutu_ISO = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Sertifikat_Managemen_Mutu_ISO', 'Punya Sertifikat Managemen Mutu ISO', '`Punya Sertifikat Managemen Mutu ISO`', '`Punya Sertifikat Managemen Mutu ISO`', 200, 255, -1, false, '`Punya Sertifikat Managemen Mutu ISO`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->Sortable = true; // Allow sort
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Sertifikat_Managemen_Mutu_ISO->Param, "CustomMsg");
        $this->Fields['Punya Sertifikat Managemen Mutu ISO'] = &$this->Punya_Sertifikat_Managemen_Mutu_ISO;

        // Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut', 'Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut', '`Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut`', '`Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut`', 200, 255, -1, false, '`Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->Sortable = true; // Allow sort
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->Param, "CustomMsg");
        $this->Fields['Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut'] = &$this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut;

        // Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi', 'Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi', '`Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi`', '`Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi`', 200, 255, -1, false, '`Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->Sortable = true; // Allow sort
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->Param, "CustomMsg");
        $this->Fields['Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi'] = &$this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi;

        // Ada Bukti Transaksi Berupa Nota / Kuitansi
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi', 'Ada Bukti Transaksi Berupa Nota / Kuitansi', '`Ada Bukti Transaksi Berupa Nota / Kuitansi`', '`Ada Bukti Transaksi Berupa Nota / Kuitansi`', 200, 255, -1, false, '`Ada Bukti Transaksi Berupa Nota / Kuitansi`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->Sortable = true; // Allow sort
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->Param, "CustomMsg");
        $this->Fields['Ada Bukti Transaksi Berupa Nota / Kuitansi'] = &$this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi;

        // Punya Pencatatan Keuangan Usaha
        $this->Punya_Pencatatan_Keuangan_Usaha = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Pencatatan_Keuangan_Usaha', 'Punya Pencatatan Keuangan Usaha', '`Punya Pencatatan Keuangan Usaha`', '`Punya Pencatatan Keuangan Usaha`', 200, 255, -1, false, '`Punya Pencatatan Keuangan Usaha`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Pencatatan_Keuangan_Usaha->Sortable = true; // Allow sort
        $this->Punya_Pencatatan_Keuangan_Usaha->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Pencatatan_Keuangan_Usaha->Param, "CustomMsg");
        $this->Fields['Punya Pencatatan Keuangan Usaha'] = &$this->Punya_Pencatatan_Keuangan_Usaha;

        // Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne', 'Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne', '`Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne`', '`Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne`', 200, 255, -1, false, '`Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->Sortable = true; // Allow sort
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->Param, "CustomMsg");
        $this->Fields['Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne'] = &$this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne;

        // Punya Pinjaman Modal Usaha dari Perbankan
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Pinjaman_Modal_Usaha_dari_Perbankan', 'Punya Pinjaman Modal Usaha dari Perbankan', '`Punya Pinjaman Modal Usaha dari Perbankan`', '`Punya Pinjaman Modal Usaha dari Perbankan`', 200, 255, -1, false, '`Punya Pinjaman Modal Usaha dari Perbankan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->Sortable = true; // Allow sort
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->Param, "CustomMsg");
        $this->Fields['Punya Pinjaman Modal Usaha dari Perbankan'] = &$this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan;

        // Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik', 'Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik', '`Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik`', '`Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik`', 200, 255, -1, false, '`Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->Sortable = true; // Allow sort
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->Param, "CustomMsg");
        $this->Fields['Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik'] = &$this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik;

        // Melayani Transaksi non Tunai
        $this->Melayani_Transaksi_non_Tunai = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Melayani_Transaksi_non_Tunai', 'Melayani Transaksi non Tunai', '`Melayani Transaksi non Tunai`', '`Melayani Transaksi non Tunai`', 200, 255, -1, false, '`Melayani Transaksi non Tunai`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Melayani_Transaksi_non_Tunai->Sortable = true; // Allow sort
        $this->Melayani_Transaksi_non_Tunai->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Melayani_Transaksi_non_Tunai->Param, "CustomMsg");
        $this->Fields['Melayani Transaksi non Tunai'] = &$this->Melayani_Transaksi_non_Tunai;

        // Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri', 'Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri', '`Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri`', '`Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri`', 200, 255, -1, false, '`Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->Sortable = true; // Allow sort
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->Param, "CustomMsg");
        $this->Fields['Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri'] = &$this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri;

        // Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban', 'Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban', '`Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban`', '`Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban`', 200, 255, -1, false, '`Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->Sortable = true; // Allow sort
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->Param, "CustomMsg");
        $this->Fields['Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban'] = &$this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban;

        // Punya Target Bulanan / Tahunan
        $this->Punya_Target_Bulanan__Tahunan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Target_Bulanan__Tahunan', 'Punya Target Bulanan / Tahunan', '`Punya Target Bulanan / Tahunan`', '`Punya Target Bulanan / Tahunan`', 200, 255, -1, false, '`Punya Target Bulanan / Tahunan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Target_Bulanan__Tahunan->Sortable = true; // Allow sort
        $this->Punya_Target_Bulanan__Tahunan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Target_Bulanan__Tahunan->Param, "CustomMsg");
        $this->Fields['Punya Target Bulanan / Tahunan'] = &$this->Punya_Target_Bulanan__Tahunan;

        // Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak', 'Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)', '`Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)`', '`Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)`', 200, 255, -1, false, '`Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->Sortable = true; // Allow sort
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->Param, "CustomMsg");
        $this->Fields['Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)'] = &$this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak;

        // Punya Tenaga Kerja Sub Kontrak
        $this->Punya_Tenaga_Kerja_Sub_Kontrak = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Punya_Tenaga_Kerja_Sub_Kontrak', 'Punya Tenaga Kerja Sub Kontrak', '`Punya Tenaga Kerja Sub Kontrak`', '`Punya Tenaga Kerja Sub Kontrak`', 200, 255, -1, false, '`Punya Tenaga Kerja Sub Kontrak`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->Sortable = true; // Allow sort
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Punya_Tenaga_Kerja_Sub_Kontrak->Param, "CustomMsg");
        $this->Fields['Punya Tenaga Kerja Sub Kontrak'] = &$this->Punya_Tenaga_Kerja_Sub_Kontrak;

        // Besaran Gaji Karyawan
        $this->Besaran_Gaji_Karyawan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Besaran_Gaji_Karyawan', 'Besaran Gaji Karyawan', '`Besaran Gaji Karyawan`', '`Besaran Gaji Karyawan`', 200, 255, -1, false, '`Besaran Gaji Karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Besaran_Gaji_Karyawan->Sortable = true; // Allow sort
        $this->Besaran_Gaji_Karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Besaran_Gaji_Karyawan->Param, "CustomMsg");
        $this->Fields['Besaran Gaji Karyawan'] = &$this->Besaran_Gaji_Karyawan;

        // Memberikan Jaminan Ketenagakerjaan kepada Karyawan
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan', 'Memberikan Jaminan Ketenagakerjaan kepada Karyawan', '`Memberikan Jaminan Ketenagakerjaan kepada Karyawan`', '`Memberikan Jaminan Ketenagakerjaan kepada Karyawan`', 200, 255, -1, false, '`Memberikan Jaminan Ketenagakerjaan kepada Karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->Sortable = true; // Allow sort
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->Param, "CustomMsg");
        $this->Fields['Memberikan Jaminan Ketenagakerjaan kepada Karyawan'] = &$this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan;

        // Memberikan Tunjangan dan Bonus kepada Karyawan
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan', 'Memberikan Tunjangan dan Bonus kepada Karyawan', '`Memberikan Tunjangan dan Bonus kepada Karyawan`', '`Memberikan Tunjangan dan Bonus kepada Karyawan`', 200, 255, -1, false, '`Memberikan Tunjangan dan Bonus kepada Karyawan`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->Sortable = true; // Allow sort
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->Param, "CustomMsg");
        $this->Fields['Memberikan Tunjangan dan Bonus kepada Karyawan'] = &$this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan;

        // Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men = new DbField('ukm_bantul_fix', 'ukm_bantul_fix', 'x_Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men', 'Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men', '`Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men`', '`Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men`', 200, 255, -1, false, '`Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men`', false, false, false, 'FORMATTED TEXT', 'TEXT');
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->Sortable = true; // Allow sort
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->CustomMsg = $Language->FieldPhrase($this->TableVar, $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->Param, "CustomMsg");
        $this->Fields['Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men'] = &$this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men;
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
        return ($this->SqlFrom != "") ? $this->SqlFrom : "`ukm_bantul_fix`";
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
        $this->Nama_Pemilik_Usaha->DbValue = $row['Nama Pemilik Usaha'];
        $this->Nomor_Induk_Kependudukan_NIK->DbValue = $row['Nomor Induk Kependudukan (NIK)'];
        $this->Jenis_Kelamin->DbValue = $row['Jenis Kelamin'];
        $this->Nama_JalanGangRTRW->DbValue = $row['Nama Jalan/Gang/RT/RW'];
        $this->Dusun->DbValue = $row['Dusun'];
        $this->DesaKelurahan->DbValue = $row['Desa/Kelurahan'];
        $this->Kecamatan->DbValue = $row['Kecamatan'];
        $this->Nomor_TeleponHP->DbValue = $row['Nomor Telepon/HP'];
        $this->Alamat_Email->DbValue = $row['Alamat Email'];
        $this->Nama_Usaha->DbValue = $row['Nama Usaha'];
        $this->Tahun_Mulai_Usaha->DbValue = $row['Tahun Mulai Usaha'];
        $this->Nama_JalanGangRTRW_1->DbValue = $row['Nama Jalan/Gang/RT/RW (1)'];
        $this->Dusun_1->DbValue = $row['Dusun (1)'];
        $this->DesaKelurahan_1->DbValue = $row['Desa/Kelurahan (1)'];
        $this->Kecamatan_1->DbValue = $row['Kecamatan (1)'];
        $this->Status_Usaha->DbValue = $row['Status Usaha'];
        $this->No_TelpHP_Usaha_Perusahaan->DbValue = $row['No Telp/HP Usaha Perusahaan'];
        $this->Alamat_Email_UsahaPerusahaan->DbValue = $row['Alamat Email Usaha/Perusahaan'];
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->DbValue = $row['Alamat Website Usaha/Perusahaan (Jika Ada)'];
        $this->Afiliasi_dengan_emarketing->DbValue = $row['Afiliasi dengan e-marketing'];
        $this->NPWP->DbValue = $row['NPWP'];
        $this->Nomor_dan_Ijin_Usaha_yang_ada->DbValue = $row['Nomor dan Ijin Usaha yang ada'];
        $this->Badan_Hukum_Perusahaan->DbValue = $row['Badan Hukum Perusahaan'];
        $this->Jenis_UsahaSektorProduk->DbValue = $row['Jenis Usaha/Sektor/Produk'];
        $this->Kegiatan_usaha_yang_dilakukan->DbValue = $row['Kegiatan usaha yang dilakukan'];
        $this->Nama_Merk_Usaha->DbValue = $row['Nama Merk Usaha'];
        $this->Bahan_Baku->DbValue = $row['Bahan Baku'];
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->DbValue = $row['Sumber Bahan Baku/Daerah Asal Bahan Baku'];
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->DbValue = $row['Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)'];
        $this->Negara_Tujuan_Ekspor->DbValue = $row['Negara Tujuan Ekspor'];
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->DbValue = $row['Jumlah produk yang dihasilkan per bulan'];
        $this->Satuan_Produk->DbValue = $row['Satuan Produk'];
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->DbValue = $row['Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)'];
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->DbValue = $row['Harga sewa tanah dan bangunan usaha (dalam rupiah)'];
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->DbValue = $row['Harga aset yang dimiliki (dalam rupiah)'];
        $this->Modal_kerja_per_bulan_dalam_rupiah->DbValue = $row['Modal kerja per bulan (dalam rupiah)'];
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->DbValue = $row['Jumlah Tenaga Kerja Laki Laki'];
        $this->Jumlah_Tenaga_Kerja_Perempuan->DbValue = $row['Jumlah Tenaga Kerja Perempuan'];
        $this->Bantuan_Pemerintah->DbValue = $row['Bantuan Pemerintah'];
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->DbValue = $row['Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe'];
        $this->Nama_Jenis_Pinjaman_jika_ada->DbValue = $row['Nama Jenis Pinjaman (jika ada)'];
        $this->Pemberi_Pinjaman_jika_ada->DbValue = $row['Pemberi Pinjaman (jika ada)'];
        $this->Jumlah_Pinjaman_dalam_rupiah->DbValue = $row['Jumlah Pinjaman (dalam rupiah)'];
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->DbValue = $row['Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya'];
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->DbValue = $row['Rata-rata omzet per tahun (dalam rupiah)'];
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->DbValue = $row['Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)'];
        $this->Aktifitas_Produksi_di_Usaha_Saya->DbValue = $row['Aktifitas Produksi di Usaha Saya'];
        $this->Jumlah_Produksi_di_Usaha_Saya->DbValue = $row['Jumlah Produksi di Usaha Saya'];
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->DbValue = $row['Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar'];
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->DbValue = $row['Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki'];
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->DbValue = $row['Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk'];
        $this->Ketersediaan_Bahan_Baku->DbValue = $row['Ketersediaan Bahan Baku'];
        $this->Alat_Produksi_di_Usaha_Saya->DbValue = $row['Alat Produksi di Usaha Saya'];
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->DbValue = $row['Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku'];
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->DbValue = $row['Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam'];
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->DbValue = $row['Menerapkan Standar Operational Prosedur (SOP) Produksi'];
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->DbValue = $row['Mengetahui Kelebihan / Kekuatan Produk'];
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->DbValue = $row['Mengetahui Target Pasar Utama (Calon Pembeli Utama)'];
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->DbValue = $row['Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U'];
        $this->Memiliki_Nama_Merk__Logo_Dagang->DbValue = $row['Memiliki Nama Merk / Logo Dagang'];
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->DbValue = $row['Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI'];
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->DbValue = $row['Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)'];
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->DbValue = $row['Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo'];
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->DbValue = $row['Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S'];
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->DbValue = $row['Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh'];
        $this->Sebaran_Pemasaran_Produk->DbValue = $row['Sebaran Pemasaran Produk'];
        $this->Punya_Pelanggan_Tetap->DbValue = $row['Punya Pelanggan Tetap'];
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->DbValue = $row['Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu'];
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->DbValue = $row['Media Chatting yang Digunakan untuk Memasarkan Produk'];
        $this->Media_Sosial_Untuk_Memasarkan_Produk->DbValue = $row['Media Sosial Untuk Memasarkan Produk'];
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->DbValue = $row['Marketplace yang Digunakan untuk Memasarkan Produk'];
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->DbValue = $row['Menggunakan Google Bisnisku untuk Memasarkan Produk'];
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->DbValue = $row['Menggunakan Website untuk Memasarkan Produk'];
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->DbValue = $row['Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl'];
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->DbValue = $row['Memperbarui Berita / Informasi / Tulisan di Website'];
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->DbValue = $row['Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google'];
        $this->Menggunakan_Iklan_Berbayar_di_Online->DbValue = $row['Menggunakan Iklan Berbayar di Online'];
        $this->Usaha_Berbadan_Hukum->DbValue = $row['Usaha Berbadan Hukum'];
        $this->Punya_Izin_Usaha->DbValue = $row['Punya Izin Usaha'];
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->DbValue = $row['Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak'];
        $this->Punya_Struktur_Organisasi_Usaha->DbValue = $row['Punya Struktur Organisasi Usaha'];
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->DbValue = $row['Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D'];
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->DbValue = $row['Punya Sertifikat Managemen Mutu ISO'];
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->DbValue = $row['Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut'];
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->DbValue = $row['Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi'];
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->DbValue = $row['Ada Bukti Transaksi Berupa Nota / Kuitansi'];
        $this->Punya_Pencatatan_Keuangan_Usaha->DbValue = $row['Punya Pencatatan Keuangan Usaha'];
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->DbValue = $row['Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne'];
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->DbValue = $row['Punya Pinjaman Modal Usaha dari Perbankan'];
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->DbValue = $row['Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik'];
        $this->Melayani_Transaksi_non_Tunai->DbValue = $row['Melayani Transaksi non Tunai'];
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->DbValue = $row['Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri'];
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->DbValue = $row['Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban'];
        $this->Punya_Target_Bulanan__Tahunan->DbValue = $row['Punya Target Bulanan / Tahunan'];
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->DbValue = $row['Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)'];
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->DbValue = $row['Punya Tenaga Kerja Sub Kontrak'];
        $this->Besaran_Gaji_Karyawan->DbValue = $row['Besaran Gaji Karyawan'];
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->DbValue = $row['Memberikan Jaminan Ketenagakerjaan kepada Karyawan'];
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->DbValue = $row['Memberikan Tunjangan dan Bonus kepada Karyawan'];
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->DbValue = $row['Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men'];
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
        return $_SESSION[$name] ?? GetUrl("ukmbantulfixlist");
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
        if ($pageName == "ukmbantulfixview") {
            return $Language->phrase("View");
        } elseif ($pageName == "ukmbantulfixedit") {
            return $Language->phrase("Edit");
        } elseif ($pageName == "ukmbantulfixadd") {
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
                return "UkmBantulFixView";
            case Config("API_ADD_ACTION"):
                return "UkmBantulFixAdd";
            case Config("API_EDIT_ACTION"):
                return "UkmBantulFixEdit";
            case Config("API_DELETE_ACTION"):
                return "UkmBantulFixDelete";
            case Config("API_LIST_ACTION"):
                return "UkmBantulFixList";
            default:
                return "";
        }
    }

    // List URL
    public function getListUrl()
    {
        return "ukmbantulfixlist";
    }

    // View URL
    public function getViewUrl($parm = "")
    {
        if ($parm != "") {
            $url = $this->keyUrl("ukmbantulfixview", $this->getUrlParm($parm));
        } else {
            $url = $this->keyUrl("ukmbantulfixview", $this->getUrlParm(Config("TABLE_SHOW_DETAIL") . "="));
        }
        return $this->addMasterUrl($url);
    }

    // Add URL
    public function getAddUrl($parm = "")
    {
        if ($parm != "") {
            $url = "ukmbantulfixadd?" . $this->getUrlParm($parm);
        } else {
            $url = "ukmbantulfixadd";
        }
        return $this->addMasterUrl($url);
    }

    // Edit URL
    public function getEditUrl($parm = "")
    {
        $url = $this->keyUrl("ukmbantulfixedit", $this->getUrlParm($parm));
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
        $url = $this->keyUrl("ukmbantulfixadd", $this->getUrlParm($parm));
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
        return $this->keyUrl("ukmbantulfixdelete", $this->getUrlParm());
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
        $this->Nama_Pemilik_Usaha->setDbValue($row['Nama Pemilik Usaha']);
        $this->Nomor_Induk_Kependudukan_NIK->setDbValue($row['Nomor Induk Kependudukan (NIK)']);
        $this->Jenis_Kelamin->setDbValue($row['Jenis Kelamin']);
        $this->Nama_JalanGangRTRW->setDbValue($row['Nama Jalan/Gang/RT/RW']);
        $this->Dusun->setDbValue($row['Dusun']);
        $this->DesaKelurahan->setDbValue($row['Desa/Kelurahan']);
        $this->Kecamatan->setDbValue($row['Kecamatan']);
        $this->Nomor_TeleponHP->setDbValue($row['Nomor Telepon/HP']);
        $this->Alamat_Email->setDbValue($row['Alamat Email']);
        $this->Nama_Usaha->setDbValue($row['Nama Usaha']);
        $this->Tahun_Mulai_Usaha->setDbValue($row['Tahun Mulai Usaha']);
        $this->Nama_JalanGangRTRW_1->setDbValue($row['Nama Jalan/Gang/RT/RW (1)']);
        $this->Dusun_1->setDbValue($row['Dusun (1)']);
        $this->DesaKelurahan_1->setDbValue($row['Desa/Kelurahan (1)']);
        $this->Kecamatan_1->setDbValue($row['Kecamatan (1)']);
        $this->Status_Usaha->setDbValue($row['Status Usaha']);
        $this->No_TelpHP_Usaha_Perusahaan->setDbValue($row['No Telp/HP Usaha Perusahaan']);
        $this->Alamat_Email_UsahaPerusahaan->setDbValue($row['Alamat Email Usaha/Perusahaan']);
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->setDbValue($row['Alamat Website Usaha/Perusahaan (Jika Ada)']);
        $this->Afiliasi_dengan_emarketing->setDbValue($row['Afiliasi dengan e-marketing']);
        $this->NPWP->setDbValue($row['NPWP']);
        $this->Nomor_dan_Ijin_Usaha_yang_ada->setDbValue($row['Nomor dan Ijin Usaha yang ada']);
        $this->Badan_Hukum_Perusahaan->setDbValue($row['Badan Hukum Perusahaan']);
        $this->Jenis_UsahaSektorProduk->setDbValue($row['Jenis Usaha/Sektor/Produk']);
        $this->Kegiatan_usaha_yang_dilakukan->setDbValue($row['Kegiatan usaha yang dilakukan']);
        $this->Nama_Merk_Usaha->setDbValue($row['Nama Merk Usaha']);
        $this->Bahan_Baku->setDbValue($row['Bahan Baku']);
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->setDbValue($row['Sumber Bahan Baku/Daerah Asal Bahan Baku']);
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->setDbValue($row['Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)']);
        $this->Negara_Tujuan_Ekspor->setDbValue($row['Negara Tujuan Ekspor']);
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->setDbValue($row['Jumlah produk yang dihasilkan per bulan']);
        $this->Satuan_Produk->setDbValue($row['Satuan Produk']);
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->setDbValue($row['Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)']);
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->setDbValue($row['Harga sewa tanah dan bangunan usaha (dalam rupiah)']);
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->setDbValue($row['Harga aset yang dimiliki (dalam rupiah)']);
        $this->Modal_kerja_per_bulan_dalam_rupiah->setDbValue($row['Modal kerja per bulan (dalam rupiah)']);
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->setDbValue($row['Jumlah Tenaga Kerja Laki Laki']);
        $this->Jumlah_Tenaga_Kerja_Perempuan->setDbValue($row['Jumlah Tenaga Kerja Perempuan']);
        $this->Bantuan_Pemerintah->setDbValue($row['Bantuan Pemerintah']);
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->setDbValue($row['Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe']);
        $this->Nama_Jenis_Pinjaman_jika_ada->setDbValue($row['Nama Jenis Pinjaman (jika ada)']);
        $this->Pemberi_Pinjaman_jika_ada->setDbValue($row['Pemberi Pinjaman (jika ada)']);
        $this->Jumlah_Pinjaman_dalam_rupiah->setDbValue($row['Jumlah Pinjaman (dalam rupiah)']);
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->setDbValue($row['Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya']);
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->setDbValue($row['Rata-rata omzet per tahun (dalam rupiah)']);
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->setDbValue($row['Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)']);
        $this->Aktifitas_Produksi_di_Usaha_Saya->setDbValue($row['Aktifitas Produksi di Usaha Saya']);
        $this->Jumlah_Produksi_di_Usaha_Saya->setDbValue($row['Jumlah Produksi di Usaha Saya']);
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->setDbValue($row['Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar']);
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->setDbValue($row['Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki']);
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->setDbValue($row['Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk']);
        $this->Ketersediaan_Bahan_Baku->setDbValue($row['Ketersediaan Bahan Baku']);
        $this->Alat_Produksi_di_Usaha_Saya->setDbValue($row['Alat Produksi di Usaha Saya']);
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->setDbValue($row['Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku']);
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->setDbValue($row['Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam']);
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->setDbValue($row['Menerapkan Standar Operational Prosedur (SOP) Produksi']);
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->setDbValue($row['Mengetahui Kelebihan / Kekuatan Produk']);
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->setDbValue($row['Mengetahui Target Pasar Utama (Calon Pembeli Utama)']);
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->setDbValue($row['Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U']);
        $this->Memiliki_Nama_Merk__Logo_Dagang->setDbValue($row['Memiliki Nama Merk / Logo Dagang']);
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->setDbValue($row['Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI']);
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->setDbValue($row['Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)']);
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->setDbValue($row['Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo']);
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->setDbValue($row['Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S']);
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->setDbValue($row['Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh']);
        $this->Sebaran_Pemasaran_Produk->setDbValue($row['Sebaran Pemasaran Produk']);
        $this->Punya_Pelanggan_Tetap->setDbValue($row['Punya Pelanggan Tetap']);
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->setDbValue($row['Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu']);
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->setDbValue($row['Media Chatting yang Digunakan untuk Memasarkan Produk']);
        $this->Media_Sosial_Untuk_Memasarkan_Produk->setDbValue($row['Media Sosial Untuk Memasarkan Produk']);
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->setDbValue($row['Marketplace yang Digunakan untuk Memasarkan Produk']);
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->setDbValue($row['Menggunakan Google Bisnisku untuk Memasarkan Produk']);
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->setDbValue($row['Menggunakan Website untuk Memasarkan Produk']);
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->setDbValue($row['Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl']);
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->setDbValue($row['Memperbarui Berita / Informasi / Tulisan di Website']);
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->setDbValue($row['Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google']);
        $this->Menggunakan_Iklan_Berbayar_di_Online->setDbValue($row['Menggunakan Iklan Berbayar di Online']);
        $this->Usaha_Berbadan_Hukum->setDbValue($row['Usaha Berbadan Hukum']);
        $this->Punya_Izin_Usaha->setDbValue($row['Punya Izin Usaha']);
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->setDbValue($row['Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak']);
        $this->Punya_Struktur_Organisasi_Usaha->setDbValue($row['Punya Struktur Organisasi Usaha']);
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->setDbValue($row['Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D']);
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->setDbValue($row['Punya Sertifikat Managemen Mutu ISO']);
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->setDbValue($row['Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut']);
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->setDbValue($row['Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi']);
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->setDbValue($row['Ada Bukti Transaksi Berupa Nota / Kuitansi']);
        $this->Punya_Pencatatan_Keuangan_Usaha->setDbValue($row['Punya Pencatatan Keuangan Usaha']);
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->setDbValue($row['Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne']);
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->setDbValue($row['Punya Pinjaman Modal Usaha dari Perbankan']);
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->setDbValue($row['Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik']);
        $this->Melayani_Transaksi_non_Tunai->setDbValue($row['Melayani Transaksi non Tunai']);
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->setDbValue($row['Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri']);
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->setDbValue($row['Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban']);
        $this->Punya_Target_Bulanan__Tahunan->setDbValue($row['Punya Target Bulanan / Tahunan']);
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->setDbValue($row['Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)']);
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->setDbValue($row['Punya Tenaga Kerja Sub Kontrak']);
        $this->Besaran_Gaji_Karyawan->setDbValue($row['Besaran Gaji Karyawan']);
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->setDbValue($row['Memberikan Jaminan Ketenagakerjaan kepada Karyawan']);
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->setDbValue($row['Memberikan Tunjangan dan Bonus kepada Karyawan']);
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->setDbValue($row['Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men']);
    }

    // Render list row values
    public function renderListRow()
    {
        global $Security, $CurrentLanguage, $Language;

        // Call Row Rendering event
        $this->rowRendering();

        // Common render codes

        // id

        // Nama Pemilik Usaha

        // Nomor Induk Kependudukan (NIK)

        // Jenis Kelamin

        // Nama Jalan/Gang/RT/RW

        // Dusun

        // Desa/Kelurahan

        // Kecamatan

        // Nomor Telepon/HP

        // Alamat Email

        // Nama Usaha

        // Tahun Mulai Usaha

        // Nama Jalan/Gang/RT/RW (1)

        // Dusun (1)

        // Desa/Kelurahan (1)

        // Kecamatan (1)

        // Status Usaha

        // No Telp/HP Usaha Perusahaan

        // Alamat Email Usaha/Perusahaan

        // Alamat Website Usaha/Perusahaan (Jika Ada)

        // Afiliasi dengan e-marketing

        // NPWP

        // Nomor dan Ijin Usaha yang ada

        // Badan Hukum Perusahaan

        // Jenis Usaha/Sektor/Produk

        // Kegiatan usaha yang dilakukan

        // Nama Merk Usaha

        // Bahan Baku

        // Sumber Bahan Baku/Daerah Asal Bahan Baku

        // Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)

        // Negara Tujuan Ekspor

        // Jumlah produk yang dihasilkan per bulan

        // Satuan Produk

        // Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)

        // Harga sewa tanah dan bangunan usaha (dalam rupiah)

        // Harga aset yang dimiliki (dalam rupiah)

        // Modal kerja per bulan (dalam rupiah)

        // Jumlah Tenaga Kerja Laki Laki

        // Jumlah Tenaga Kerja Perempuan

        // Bantuan Pemerintah

        // Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe

        // Nama Jenis Pinjaman (jika ada)

        // Pemberi Pinjaman (jika ada)

        // Jumlah Pinjaman (dalam rupiah)

        // Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya

        // Rata-rata omzet per tahun (dalam rupiah)

        // Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)

        // Aktifitas Produksi di Usaha Saya

        // Jumlah Produksi di Usaha Saya

        // Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar

        // Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki

        // Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk

        // Ketersediaan Bahan Baku

        // Alat Produksi di Usaha Saya

        // Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku

        // Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam

        // Menerapkan Standar Operational Prosedur (SOP) Produksi

        // Mengetahui Kelebihan / Kekuatan Produk

        // Mengetahui Target Pasar Utama (Calon Pembeli Utama)

        // Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U

        // Memiliki Nama Merk / Logo Dagang

        // Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI

        // Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)

        // Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo

        // Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S

        // Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh

        // Sebaran Pemasaran Produk

        // Punya Pelanggan Tetap

        // Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu

        // Media Chatting yang Digunakan untuk Memasarkan Produk

        // Media Sosial Untuk Memasarkan Produk

        // Marketplace yang Digunakan untuk Memasarkan Produk

        // Menggunakan Google Bisnisku untuk Memasarkan Produk

        // Menggunakan Website untuk Memasarkan Produk

        // Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl

        // Memperbarui Berita / Informasi / Tulisan di Website

        // Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google

        // Menggunakan Iklan Berbayar di Online

        // Usaha Berbadan Hukum

        // Punya Izin Usaha

        // Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak

        // Punya Struktur Organisasi Usaha

        // Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D

        // Punya Sertifikat Managemen Mutu ISO

        // Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut

        // Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi

        // Ada Bukti Transaksi Berupa Nota / Kuitansi

        // Punya Pencatatan Keuangan Usaha

        // Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne

        // Punya Pinjaman Modal Usaha dari Perbankan

        // Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik

        // Melayani Transaksi non Tunai

        // Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri

        // Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban

        // Punya Target Bulanan / Tahunan

        // Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)

        // Punya Tenaga Kerja Sub Kontrak

        // Besaran Gaji Karyawan

        // Memberikan Jaminan Ketenagakerjaan kepada Karyawan

        // Memberikan Tunjangan dan Bonus kepada Karyawan

        // Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men

        // id
        $this->id->ViewValue = $this->id->CurrentValue;
        $this->id->ViewCustomAttributes = "";

        // Nama Pemilik Usaha
        $this->Nama_Pemilik_Usaha->ViewValue = $this->Nama_Pemilik_Usaha->CurrentValue;
        $this->Nama_Pemilik_Usaha->ViewCustomAttributes = "";

        // Nomor Induk Kependudukan (NIK)
        $this->Nomor_Induk_Kependudukan_NIK->ViewValue = $this->Nomor_Induk_Kependudukan_NIK->CurrentValue;
        $this->Nomor_Induk_Kependudukan_NIK->ViewCustomAttributes = "";

        // Jenis Kelamin
        $this->Jenis_Kelamin->ViewValue = $this->Jenis_Kelamin->CurrentValue;
        $this->Jenis_Kelamin->ViewCustomAttributes = "";

        // Nama Jalan/Gang/RT/RW
        $this->Nama_JalanGangRTRW->ViewValue = $this->Nama_JalanGangRTRW->CurrentValue;
        $this->Nama_JalanGangRTRW->ViewCustomAttributes = "";

        // Dusun
        $this->Dusun->ViewValue = $this->Dusun->CurrentValue;
        $this->Dusun->ViewCustomAttributes = "";

        // Desa/Kelurahan
        $this->DesaKelurahan->ViewValue = $this->DesaKelurahan->CurrentValue;
        $this->DesaKelurahan->ViewCustomAttributes = "";

        // Kecamatan
        $this->Kecamatan->ViewValue = $this->Kecamatan->CurrentValue;
        $this->Kecamatan->ViewCustomAttributes = "";

        // Nomor Telepon/HP
        $this->Nomor_TeleponHP->ViewValue = $this->Nomor_TeleponHP->CurrentValue;
        $this->Nomor_TeleponHP->ViewCustomAttributes = "";

        // Alamat Email
        $this->Alamat_Email->ViewValue = $this->Alamat_Email->CurrentValue;
        $this->Alamat_Email->ViewCustomAttributes = "";

        // Nama Usaha
        $this->Nama_Usaha->ViewValue = $this->Nama_Usaha->CurrentValue;
        $this->Nama_Usaha->ViewCustomAttributes = "";

        // Tahun Mulai Usaha
        $this->Tahun_Mulai_Usaha->ViewValue = $this->Tahun_Mulai_Usaha->CurrentValue;
        $this->Tahun_Mulai_Usaha->ViewCustomAttributes = "";

        // Nama Jalan/Gang/RT/RW (1)
        $this->Nama_JalanGangRTRW_1->ViewValue = $this->Nama_JalanGangRTRW_1->CurrentValue;
        $this->Nama_JalanGangRTRW_1->ViewCustomAttributes = "";

        // Dusun (1)
        $this->Dusun_1->ViewValue = $this->Dusun_1->CurrentValue;
        $this->Dusun_1->ViewCustomAttributes = "";

        // Desa/Kelurahan (1)
        $this->DesaKelurahan_1->ViewValue = $this->DesaKelurahan_1->CurrentValue;
        $this->DesaKelurahan_1->ViewCustomAttributes = "";

        // Kecamatan (1)
        $this->Kecamatan_1->ViewValue = $this->Kecamatan_1->CurrentValue;
        $this->Kecamatan_1->ViewCustomAttributes = "";

        // Status Usaha
        $this->Status_Usaha->ViewValue = $this->Status_Usaha->CurrentValue;
        $this->Status_Usaha->ViewCustomAttributes = "";

        // No Telp/HP Usaha Perusahaan
        $this->No_TelpHP_Usaha_Perusahaan->ViewValue = $this->No_TelpHP_Usaha_Perusahaan->CurrentValue;
        $this->No_TelpHP_Usaha_Perusahaan->ViewCustomAttributes = "";

        // Alamat Email Usaha/Perusahaan
        $this->Alamat_Email_UsahaPerusahaan->ViewValue = $this->Alamat_Email_UsahaPerusahaan->CurrentValue;
        $this->Alamat_Email_UsahaPerusahaan->ViewCustomAttributes = "";

        // Alamat Website Usaha/Perusahaan (Jika Ada)
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->ViewValue = $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->CurrentValue;
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->ViewCustomAttributes = "";

        // Afiliasi dengan e-marketing
        $this->Afiliasi_dengan_emarketing->ViewValue = $this->Afiliasi_dengan_emarketing->CurrentValue;
        $this->Afiliasi_dengan_emarketing->ViewCustomAttributes = "";

        // NPWP
        $this->NPWP->ViewValue = $this->NPWP->CurrentValue;
        $this->NPWP->ViewCustomAttributes = "";

        // Nomor dan Ijin Usaha yang ada
        $this->Nomor_dan_Ijin_Usaha_yang_ada->ViewValue = $this->Nomor_dan_Ijin_Usaha_yang_ada->CurrentValue;
        $this->Nomor_dan_Ijin_Usaha_yang_ada->ViewCustomAttributes = "";

        // Badan Hukum Perusahaan
        $this->Badan_Hukum_Perusahaan->ViewValue = $this->Badan_Hukum_Perusahaan->CurrentValue;
        $this->Badan_Hukum_Perusahaan->ViewCustomAttributes = "";

        // Jenis Usaha/Sektor/Produk
        $this->Jenis_UsahaSektorProduk->ViewValue = $this->Jenis_UsahaSektorProduk->CurrentValue;
        $this->Jenis_UsahaSektorProduk->ViewCustomAttributes = "";

        // Kegiatan usaha yang dilakukan
        $this->Kegiatan_usaha_yang_dilakukan->ViewValue = $this->Kegiatan_usaha_yang_dilakukan->CurrentValue;
        $this->Kegiatan_usaha_yang_dilakukan->ViewCustomAttributes = "";

        // Nama Merk Usaha
        $this->Nama_Merk_Usaha->ViewValue = $this->Nama_Merk_Usaha->CurrentValue;
        $this->Nama_Merk_Usaha->ViewCustomAttributes = "";

        // Bahan Baku
        $this->Bahan_Baku->ViewValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->ViewCustomAttributes = "";

        // Sumber Bahan Baku/Daerah Asal Bahan Baku
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->ViewValue = $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->CurrentValue;
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->ViewCustomAttributes = "";

        // Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->ViewValue = $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->CurrentValue;
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->ViewValue = FormatNumber($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->ViewCustomAttributes = "";

        // Negara Tujuan Ekspor
        $this->Negara_Tujuan_Ekspor->ViewValue = $this->Negara_Tujuan_Ekspor->CurrentValue;
        $this->Negara_Tujuan_Ekspor->ViewCustomAttributes = "";

        // Jumlah produk yang dihasilkan per bulan
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->ViewValue = $this->Jumlah_produk_yang_dihasilkan_per_bulan->CurrentValue;
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->ViewValue = FormatNumber($this->Jumlah_produk_yang_dihasilkan_per_bulan->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->ViewCustomAttributes = "";

        // Satuan Produk
        $this->Satuan_Produk->ViewValue = $this->Satuan_Produk->CurrentValue;
        $this->Satuan_Produk->ViewCustomAttributes = "";

        // Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->ViewValue = $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->CurrentValue;
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->ViewValue = FormatNumber($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->ViewCustomAttributes = "";

        // Harga sewa tanah dan bangunan usaha (dalam rupiah)
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->ViewValue = $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->CurrentValue;
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->ViewValue = FormatNumber($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->ViewCustomAttributes = "";

        // Harga aset yang dimiliki (dalam rupiah)
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->ViewValue = $this->Harga_aset_yang_dimiliki_dalam_rupiah->CurrentValue;
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->ViewValue = FormatNumber($this->Harga_aset_yang_dimiliki_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->ViewCustomAttributes = "";

        // Modal kerja per bulan (dalam rupiah)
        $this->Modal_kerja_per_bulan_dalam_rupiah->ViewValue = $this->Modal_kerja_per_bulan_dalam_rupiah->CurrentValue;
        $this->Modal_kerja_per_bulan_dalam_rupiah->ViewValue = FormatNumber($this->Modal_kerja_per_bulan_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Modal_kerja_per_bulan_dalam_rupiah->ViewCustomAttributes = "";

        // Jumlah Tenaga Kerja Laki Laki
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->ViewValue = $this->Jumlah_Tenaga_Kerja_Laki_Laki->CurrentValue;
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->ViewValue = FormatNumber($this->Jumlah_Tenaga_Kerja_Laki_Laki->ViewValue, 0, -2, -2, -2);
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->ViewCustomAttributes = "";

        // Jumlah Tenaga Kerja Perempuan
        $this->Jumlah_Tenaga_Kerja_Perempuan->ViewValue = $this->Jumlah_Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Jumlah_Tenaga_Kerja_Perempuan->ViewValue = FormatNumber($this->Jumlah_Tenaga_Kerja_Perempuan->ViewValue, 0, -2, -2, -2);
        $this->Jumlah_Tenaga_Kerja_Perempuan->ViewCustomAttributes = "";

        // Bantuan Pemerintah
        $this->Bantuan_Pemerintah->ViewValue = $this->Bantuan_Pemerintah->CurrentValue;
        $this->Bantuan_Pemerintah->ViewCustomAttributes = "";

        // Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->ViewValue = $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->CurrentValue;
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->ViewCustomAttributes = "";

        // Nama Jenis Pinjaman (jika ada)
        $this->Nama_Jenis_Pinjaman_jika_ada->ViewValue = $this->Nama_Jenis_Pinjaman_jika_ada->CurrentValue;
        $this->Nama_Jenis_Pinjaman_jika_ada->ViewCustomAttributes = "";

        // Pemberi Pinjaman (jika ada)
        $this->Pemberi_Pinjaman_jika_ada->ViewValue = $this->Pemberi_Pinjaman_jika_ada->CurrentValue;
        $this->Pemberi_Pinjaman_jika_ada->ViewCustomAttributes = "";

        // Jumlah Pinjaman (dalam rupiah)
        $this->Jumlah_Pinjaman_dalam_rupiah->ViewValue = $this->Jumlah_Pinjaman_dalam_rupiah->CurrentValue;
        $this->Jumlah_Pinjaman_dalam_rupiah->ViewValue = FormatNumber($this->Jumlah_Pinjaman_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Jumlah_Pinjaman_dalam_rupiah->ViewCustomAttributes = "";

        // Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->ViewValue = $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->CurrentValue;
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->ViewCustomAttributes = "";

        // Rata-rata omzet per tahun (dalam rupiah)
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->ViewValue = $this->Ratarata_omzet_per_tahun_dalam_rupiah->CurrentValue;
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->ViewValue = FormatNumber($this->Ratarata_omzet_per_tahun_dalam_rupiah->ViewValue, 2, -2, -2, -2);
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->ViewCustomAttributes = "";

        // Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->ViewValue = $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->CurrentValue;
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->ViewCustomAttributes = "";

        // Aktifitas Produksi di Usaha Saya
        $this->Aktifitas_Produksi_di_Usaha_Saya->ViewValue = $this->Aktifitas_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Aktifitas_Produksi_di_Usaha_Saya->ViewCustomAttributes = "";

        // Jumlah Produksi di Usaha Saya
        $this->Jumlah_Produksi_di_Usaha_Saya->ViewValue = $this->Jumlah_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Jumlah_Produksi_di_Usaha_Saya->ViewCustomAttributes = "";

        // Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->ViewValue = $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->CurrentValue;
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->ViewCustomAttributes = "";

        // Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->ViewValue = $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->CurrentValue;
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->ViewCustomAttributes = "";

        // Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->ViewValue = $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->CurrentValue;
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->ViewCustomAttributes = "";

        // Ketersediaan Bahan Baku
        $this->Ketersediaan_Bahan_Baku->ViewValue = $this->Ketersediaan_Bahan_Baku->CurrentValue;
        $this->Ketersediaan_Bahan_Baku->ViewCustomAttributes = "";

        // Alat Produksi di Usaha Saya
        $this->Alat_Produksi_di_Usaha_Saya->ViewValue = $this->Alat_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Alat_Produksi_di_Usaha_Saya->ViewCustomAttributes = "";

        // Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->ViewValue = $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->CurrentValue;
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->ViewCustomAttributes = "";

        // Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->ViewValue = $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->CurrentValue;
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->ViewCustomAttributes = "";

        // Menerapkan Standar Operational Prosedur (SOP) Produksi
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->ViewValue = $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->CurrentValue;
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->ViewCustomAttributes = "";

        // Mengetahui Kelebihan / Kekuatan Produk
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->ViewValue = $this->Mengetahui_Kelebihan__Kekuatan_Produk->CurrentValue;
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->ViewCustomAttributes = "";

        // Mengetahui Target Pasar Utama (Calon Pembeli Utama)
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->ViewValue = $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->CurrentValue;
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->ViewCustomAttributes = "";

        // Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->ViewValue = $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->CurrentValue;
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->ViewCustomAttributes = "";

        // Memiliki Nama Merk / Logo Dagang
        $this->Memiliki_Nama_Merk__Logo_Dagang->ViewValue = $this->Memiliki_Nama_Merk__Logo_Dagang->CurrentValue;
        $this->Memiliki_Nama_Merk__Logo_Dagang->ViewCustomAttributes = "";

        // Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->ViewValue = $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->CurrentValue;
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->ViewCustomAttributes = "";

        // Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->ViewValue = $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->CurrentValue;
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->ViewCustomAttributes = "";

        // Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->ViewValue = $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->CurrentValue;
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->ViewCustomAttributes = "";

        // Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->ViewValue = $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->CurrentValue;
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->ViewCustomAttributes = "";

        // Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->ViewValue = $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->CurrentValue;
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->ViewCustomAttributes = "";

        // Sebaran Pemasaran Produk
        $this->Sebaran_Pemasaran_Produk->ViewValue = $this->Sebaran_Pemasaran_Produk->CurrentValue;
        $this->Sebaran_Pemasaran_Produk->ViewCustomAttributes = "";

        // Punya Pelanggan Tetap
        $this->Punya_Pelanggan_Tetap->ViewValue = $this->Punya_Pelanggan_Tetap->CurrentValue;
        $this->Punya_Pelanggan_Tetap->ViewCustomAttributes = "";

        // Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->ViewValue = $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->CurrentValue;
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->ViewCustomAttributes = "";

        // Media Chatting yang Digunakan untuk Memasarkan Produk
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->ViewValue = $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue;
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->ViewCustomAttributes = "";

        // Media Sosial Untuk Memasarkan Produk
        $this->Media_Sosial_Untuk_Memasarkan_Produk->ViewValue = $this->Media_Sosial_Untuk_Memasarkan_Produk->CurrentValue;
        $this->Media_Sosial_Untuk_Memasarkan_Produk->ViewCustomAttributes = "";

        // Marketplace yang Digunakan untuk Memasarkan Produk
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->ViewValue = $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue;
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->ViewCustomAttributes = "";

        // Menggunakan Google Bisnisku untuk Memasarkan Produk
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->ViewValue = $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->CurrentValue;
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->ViewCustomAttributes = "";

        // Menggunakan Website untuk Memasarkan Produk
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->ViewValue = $this->Menggunakan_Website_untuk_Memasarkan_Produk->CurrentValue;
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->ViewCustomAttributes = "";

        // Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->ViewValue = $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->CurrentValue;
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->ViewCustomAttributes = "";

        // Memperbarui Berita / Informasi / Tulisan di Website
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->ViewValue = $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->CurrentValue;
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->ViewCustomAttributes = "";

        // Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->ViewValue = $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->CurrentValue;
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->ViewCustomAttributes = "";

        // Menggunakan Iklan Berbayar di Online
        $this->Menggunakan_Iklan_Berbayar_di_Online->ViewValue = $this->Menggunakan_Iklan_Berbayar_di_Online->CurrentValue;
        $this->Menggunakan_Iklan_Berbayar_di_Online->ViewCustomAttributes = "";

        // Usaha Berbadan Hukum
        $this->Usaha_Berbadan_Hukum->ViewValue = $this->Usaha_Berbadan_Hukum->CurrentValue;
        $this->Usaha_Berbadan_Hukum->ViewCustomAttributes = "";

        // Punya Izin Usaha
        $this->Punya_Izin_Usaha->ViewValue = $this->Punya_Izin_Usaha->CurrentValue;
        $this->Punya_Izin_Usaha->ViewCustomAttributes = "";

        // Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->ViewValue = $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->CurrentValue;
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->ViewCustomAttributes = "";

        // Punya Struktur Organisasi Usaha
        $this->Punya_Struktur_Organisasi_Usaha->ViewValue = $this->Punya_Struktur_Organisasi_Usaha->CurrentValue;
        $this->Punya_Struktur_Organisasi_Usaha->ViewCustomAttributes = "";

        // Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->ViewValue = $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->CurrentValue;
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->ViewCustomAttributes = "";

        // Punya Sertifikat Managemen Mutu ISO
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->ViewValue = $this->Punya_Sertifikat_Managemen_Mutu_ISO->CurrentValue;
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->ViewCustomAttributes = "";

        // Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->ViewValue = $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->CurrentValue;
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->ViewCustomAttributes = "";

        // Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->ViewValue = $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->CurrentValue;
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->ViewCustomAttributes = "";

        // Ada Bukti Transaksi Berupa Nota / Kuitansi
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->ViewValue = $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->CurrentValue;
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->ViewCustomAttributes = "";

        // Punya Pencatatan Keuangan Usaha
        $this->Punya_Pencatatan_Keuangan_Usaha->ViewValue = $this->Punya_Pencatatan_Keuangan_Usaha->CurrentValue;
        $this->Punya_Pencatatan_Keuangan_Usaha->ViewCustomAttributes = "";

        // Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->ViewValue = $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->CurrentValue;
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->ViewCustomAttributes = "";

        // Punya Pinjaman Modal Usaha dari Perbankan
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->ViewValue = $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->CurrentValue;
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->ViewCustomAttributes = "";

        // Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->ViewValue = $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->CurrentValue;
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->ViewCustomAttributes = "";

        // Melayani Transaksi non Tunai
        $this->Melayani_Transaksi_non_Tunai->ViewValue = $this->Melayani_Transaksi_non_Tunai->CurrentValue;
        $this->Melayani_Transaksi_non_Tunai->ViewCustomAttributes = "";

        // Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->ViewValue = $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->CurrentValue;
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->ViewCustomAttributes = "";

        // Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->ViewValue = $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->CurrentValue;
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->ViewCustomAttributes = "";

        // Punya Target Bulanan / Tahunan
        $this->Punya_Target_Bulanan__Tahunan->ViewValue = $this->Punya_Target_Bulanan__Tahunan->CurrentValue;
        $this->Punya_Target_Bulanan__Tahunan->ViewCustomAttributes = "";

        // Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->ViewValue = $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->CurrentValue;
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->ViewCustomAttributes = "";

        // Punya Tenaga Kerja Sub Kontrak
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->ViewValue = $this->Punya_Tenaga_Kerja_Sub_Kontrak->CurrentValue;
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->ViewCustomAttributes = "";

        // Besaran Gaji Karyawan
        $this->Besaran_Gaji_Karyawan->ViewValue = $this->Besaran_Gaji_Karyawan->CurrentValue;
        $this->Besaran_Gaji_Karyawan->ViewCustomAttributes = "";

        // Memberikan Jaminan Ketenagakerjaan kepada Karyawan
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->ViewValue = $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->CurrentValue;
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->ViewCustomAttributes = "";

        // Memberikan Tunjangan dan Bonus kepada Karyawan
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->ViewValue = $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->CurrentValue;
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->ViewCustomAttributes = "";

        // Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->ViewValue = $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->CurrentValue;
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->ViewCustomAttributes = "";

        // id
        $this->id->LinkCustomAttributes = "";
        $this->id->HrefValue = "";
        $this->id->TooltipValue = "";

        // Nama Pemilik Usaha
        $this->Nama_Pemilik_Usaha->LinkCustomAttributes = "";
        $this->Nama_Pemilik_Usaha->HrefValue = "";
        $this->Nama_Pemilik_Usaha->TooltipValue = "";

        // Nomor Induk Kependudukan (NIK)
        $this->Nomor_Induk_Kependudukan_NIK->LinkCustomAttributes = "";
        $this->Nomor_Induk_Kependudukan_NIK->HrefValue = "";
        $this->Nomor_Induk_Kependudukan_NIK->TooltipValue = "";

        // Jenis Kelamin
        $this->Jenis_Kelamin->LinkCustomAttributes = "";
        $this->Jenis_Kelamin->HrefValue = "";
        $this->Jenis_Kelamin->TooltipValue = "";

        // Nama Jalan/Gang/RT/RW
        $this->Nama_JalanGangRTRW->LinkCustomAttributes = "";
        $this->Nama_JalanGangRTRW->HrefValue = "";
        $this->Nama_JalanGangRTRW->TooltipValue = "";

        // Dusun
        $this->Dusun->LinkCustomAttributes = "";
        $this->Dusun->HrefValue = "";
        $this->Dusun->TooltipValue = "";

        // Desa/Kelurahan
        $this->DesaKelurahan->LinkCustomAttributes = "";
        $this->DesaKelurahan->HrefValue = "";
        $this->DesaKelurahan->TooltipValue = "";

        // Kecamatan
        $this->Kecamatan->LinkCustomAttributes = "";
        $this->Kecamatan->HrefValue = "";
        $this->Kecamatan->TooltipValue = "";

        // Nomor Telepon/HP
        $this->Nomor_TeleponHP->LinkCustomAttributes = "";
        $this->Nomor_TeleponHP->HrefValue = "";
        $this->Nomor_TeleponHP->TooltipValue = "";

        // Alamat Email
        $this->Alamat_Email->LinkCustomAttributes = "";
        $this->Alamat_Email->HrefValue = "";
        $this->Alamat_Email->TooltipValue = "";

        // Nama Usaha
        $this->Nama_Usaha->LinkCustomAttributes = "";
        $this->Nama_Usaha->HrefValue = "";
        $this->Nama_Usaha->TooltipValue = "";

        // Tahun Mulai Usaha
        $this->Tahun_Mulai_Usaha->LinkCustomAttributes = "";
        $this->Tahun_Mulai_Usaha->HrefValue = "";
        $this->Tahun_Mulai_Usaha->TooltipValue = "";

        // Nama Jalan/Gang/RT/RW (1)
        $this->Nama_JalanGangRTRW_1->LinkCustomAttributes = "";
        $this->Nama_JalanGangRTRW_1->HrefValue = "";
        $this->Nama_JalanGangRTRW_1->TooltipValue = "";

        // Dusun (1)
        $this->Dusun_1->LinkCustomAttributes = "";
        $this->Dusun_1->HrefValue = "";
        $this->Dusun_1->TooltipValue = "";

        // Desa/Kelurahan (1)
        $this->DesaKelurahan_1->LinkCustomAttributes = "";
        $this->DesaKelurahan_1->HrefValue = "";
        $this->DesaKelurahan_1->TooltipValue = "";

        // Kecamatan (1)
        $this->Kecamatan_1->LinkCustomAttributes = "";
        $this->Kecamatan_1->HrefValue = "";
        $this->Kecamatan_1->TooltipValue = "";

        // Status Usaha
        $this->Status_Usaha->LinkCustomAttributes = "";
        $this->Status_Usaha->HrefValue = "";
        $this->Status_Usaha->TooltipValue = "";

        // No Telp/HP Usaha Perusahaan
        $this->No_TelpHP_Usaha_Perusahaan->LinkCustomAttributes = "";
        $this->No_TelpHP_Usaha_Perusahaan->HrefValue = "";
        $this->No_TelpHP_Usaha_Perusahaan->TooltipValue = "";

        // Alamat Email Usaha/Perusahaan
        $this->Alamat_Email_UsahaPerusahaan->LinkCustomAttributes = "";
        $this->Alamat_Email_UsahaPerusahaan->HrefValue = "";
        $this->Alamat_Email_UsahaPerusahaan->TooltipValue = "";

        // Alamat Website Usaha/Perusahaan (Jika Ada)
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->LinkCustomAttributes = "";
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->HrefValue = "";
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->TooltipValue = "";

        // Afiliasi dengan e-marketing
        $this->Afiliasi_dengan_emarketing->LinkCustomAttributes = "";
        $this->Afiliasi_dengan_emarketing->HrefValue = "";
        $this->Afiliasi_dengan_emarketing->TooltipValue = "";

        // NPWP
        $this->NPWP->LinkCustomAttributes = "";
        $this->NPWP->HrefValue = "";
        $this->NPWP->TooltipValue = "";

        // Nomor dan Ijin Usaha yang ada
        $this->Nomor_dan_Ijin_Usaha_yang_ada->LinkCustomAttributes = "";
        $this->Nomor_dan_Ijin_Usaha_yang_ada->HrefValue = "";
        $this->Nomor_dan_Ijin_Usaha_yang_ada->TooltipValue = "";

        // Badan Hukum Perusahaan
        $this->Badan_Hukum_Perusahaan->LinkCustomAttributes = "";
        $this->Badan_Hukum_Perusahaan->HrefValue = "";
        $this->Badan_Hukum_Perusahaan->TooltipValue = "";

        // Jenis Usaha/Sektor/Produk
        $this->Jenis_UsahaSektorProduk->LinkCustomAttributes = "";
        $this->Jenis_UsahaSektorProduk->HrefValue = "";
        $this->Jenis_UsahaSektorProduk->TooltipValue = "";

        // Kegiatan usaha yang dilakukan
        $this->Kegiatan_usaha_yang_dilakukan->LinkCustomAttributes = "";
        $this->Kegiatan_usaha_yang_dilakukan->HrefValue = "";
        $this->Kegiatan_usaha_yang_dilakukan->TooltipValue = "";

        // Nama Merk Usaha
        $this->Nama_Merk_Usaha->LinkCustomAttributes = "";
        $this->Nama_Merk_Usaha->HrefValue = "";
        $this->Nama_Merk_Usaha->TooltipValue = "";

        // Bahan Baku
        $this->Bahan_Baku->LinkCustomAttributes = "";
        $this->Bahan_Baku->HrefValue = "";
        $this->Bahan_Baku->TooltipValue = "";

        // Sumber Bahan Baku/Daerah Asal Bahan Baku
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->LinkCustomAttributes = "";
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->HrefValue = "";
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->TooltipValue = "";

        // Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->LinkCustomAttributes = "";
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->HrefValue = "";
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->TooltipValue = "";

        // Negara Tujuan Ekspor
        $this->Negara_Tujuan_Ekspor->LinkCustomAttributes = "";
        $this->Negara_Tujuan_Ekspor->HrefValue = "";
        $this->Negara_Tujuan_Ekspor->TooltipValue = "";

        // Jumlah produk yang dihasilkan per bulan
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->LinkCustomAttributes = "";
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->HrefValue = "";
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->TooltipValue = "";

        // Satuan Produk
        $this->Satuan_Produk->LinkCustomAttributes = "";
        $this->Satuan_Produk->HrefValue = "";
        $this->Satuan_Produk->TooltipValue = "";

        // Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->LinkCustomAttributes = "";
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->HrefValue = "";
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->TooltipValue = "";

        // Harga sewa tanah dan bangunan usaha (dalam rupiah)
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->LinkCustomAttributes = "";
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->HrefValue = "";
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->TooltipValue = "";

        // Harga aset yang dimiliki (dalam rupiah)
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->LinkCustomAttributes = "";
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->HrefValue = "";
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->TooltipValue = "";

        // Modal kerja per bulan (dalam rupiah)
        $this->Modal_kerja_per_bulan_dalam_rupiah->LinkCustomAttributes = "";
        $this->Modal_kerja_per_bulan_dalam_rupiah->HrefValue = "";
        $this->Modal_kerja_per_bulan_dalam_rupiah->TooltipValue = "";

        // Jumlah Tenaga Kerja Laki Laki
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->LinkCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->HrefValue = "";
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->TooltipValue = "";

        // Jumlah Tenaga Kerja Perempuan
        $this->Jumlah_Tenaga_Kerja_Perempuan->LinkCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja_Perempuan->HrefValue = "";
        $this->Jumlah_Tenaga_Kerja_Perempuan->TooltipValue = "";

        // Bantuan Pemerintah
        $this->Bantuan_Pemerintah->LinkCustomAttributes = "";
        $this->Bantuan_Pemerintah->HrefValue = "";
        $this->Bantuan_Pemerintah->TooltipValue = "";

        // Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->LinkCustomAttributes = "";
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->HrefValue = "";
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->TooltipValue = "";

        // Nama Jenis Pinjaman (jika ada)
        $this->Nama_Jenis_Pinjaman_jika_ada->LinkCustomAttributes = "";
        $this->Nama_Jenis_Pinjaman_jika_ada->HrefValue = "";
        $this->Nama_Jenis_Pinjaman_jika_ada->TooltipValue = "";

        // Pemberi Pinjaman (jika ada)
        $this->Pemberi_Pinjaman_jika_ada->LinkCustomAttributes = "";
        $this->Pemberi_Pinjaman_jika_ada->HrefValue = "";
        $this->Pemberi_Pinjaman_jika_ada->TooltipValue = "";

        // Jumlah Pinjaman (dalam rupiah)
        $this->Jumlah_Pinjaman_dalam_rupiah->LinkCustomAttributes = "";
        $this->Jumlah_Pinjaman_dalam_rupiah->HrefValue = "";
        $this->Jumlah_Pinjaman_dalam_rupiah->TooltipValue = "";

        // Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->LinkCustomAttributes = "";
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->HrefValue = "";
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->TooltipValue = "";

        // Rata-rata omzet per tahun (dalam rupiah)
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->LinkCustomAttributes = "";
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->HrefValue = "";
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->TooltipValue = "";

        // Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->LinkCustomAttributes = "";
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->HrefValue = "";
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->TooltipValue = "";

        // Aktifitas Produksi di Usaha Saya
        $this->Aktifitas_Produksi_di_Usaha_Saya->LinkCustomAttributes = "";
        $this->Aktifitas_Produksi_di_Usaha_Saya->HrefValue = "";
        $this->Aktifitas_Produksi_di_Usaha_Saya->TooltipValue = "";

        // Jumlah Produksi di Usaha Saya
        $this->Jumlah_Produksi_di_Usaha_Saya->LinkCustomAttributes = "";
        $this->Jumlah_Produksi_di_Usaha_Saya->HrefValue = "";
        $this->Jumlah_Produksi_di_Usaha_Saya->TooltipValue = "";

        // Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->LinkCustomAttributes = "";
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->HrefValue = "";
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->TooltipValue = "";

        // Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->LinkCustomAttributes = "";
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->HrefValue = "";
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->TooltipValue = "";

        // Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->LinkCustomAttributes = "";
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->HrefValue = "";
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->TooltipValue = "";

        // Ketersediaan Bahan Baku
        $this->Ketersediaan_Bahan_Baku->LinkCustomAttributes = "";
        $this->Ketersediaan_Bahan_Baku->HrefValue = "";
        $this->Ketersediaan_Bahan_Baku->TooltipValue = "";

        // Alat Produksi di Usaha Saya
        $this->Alat_Produksi_di_Usaha_Saya->LinkCustomAttributes = "";
        $this->Alat_Produksi_di_Usaha_Saya->HrefValue = "";
        $this->Alat_Produksi_di_Usaha_Saya->TooltipValue = "";

        // Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->LinkCustomAttributes = "";
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->HrefValue = "";
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->TooltipValue = "";

        // Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->LinkCustomAttributes = "";
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->HrefValue = "";
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->TooltipValue = "";

        // Menerapkan Standar Operational Prosedur (SOP) Produksi
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->LinkCustomAttributes = "";
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->HrefValue = "";
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->TooltipValue = "";

        // Mengetahui Kelebihan / Kekuatan Produk
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->LinkCustomAttributes = "";
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->HrefValue = "";
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->TooltipValue = "";

        // Mengetahui Target Pasar Utama (Calon Pembeli Utama)
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->LinkCustomAttributes = "";
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->HrefValue = "";
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->TooltipValue = "";

        // Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->LinkCustomAttributes = "";
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->HrefValue = "";
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->TooltipValue = "";

        // Memiliki Nama Merk / Logo Dagang
        $this->Memiliki_Nama_Merk__Logo_Dagang->LinkCustomAttributes = "";
        $this->Memiliki_Nama_Merk__Logo_Dagang->HrefValue = "";
        $this->Memiliki_Nama_Merk__Logo_Dagang->TooltipValue = "";

        // Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->LinkCustomAttributes = "";
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->HrefValue = "";
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->TooltipValue = "";

        // Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->LinkCustomAttributes = "";
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->HrefValue = "";
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->TooltipValue = "";

        // Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->LinkCustomAttributes = "";
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->HrefValue = "";
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->TooltipValue = "";

        // Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->LinkCustomAttributes = "";
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->HrefValue = "";
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->TooltipValue = "";

        // Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->LinkCustomAttributes = "";
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->HrefValue = "";
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->TooltipValue = "";

        // Sebaran Pemasaran Produk
        $this->Sebaran_Pemasaran_Produk->LinkCustomAttributes = "";
        $this->Sebaran_Pemasaran_Produk->HrefValue = "";
        $this->Sebaran_Pemasaran_Produk->TooltipValue = "";

        // Punya Pelanggan Tetap
        $this->Punya_Pelanggan_Tetap->LinkCustomAttributes = "";
        $this->Punya_Pelanggan_Tetap->HrefValue = "";
        $this->Punya_Pelanggan_Tetap->TooltipValue = "";

        // Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->LinkCustomAttributes = "";
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->HrefValue = "";
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->TooltipValue = "";

        // Media Chatting yang Digunakan untuk Memasarkan Produk
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->LinkCustomAttributes = "";
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->HrefValue = "";
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->TooltipValue = "";

        // Media Sosial Untuk Memasarkan Produk
        $this->Media_Sosial_Untuk_Memasarkan_Produk->LinkCustomAttributes = "";
        $this->Media_Sosial_Untuk_Memasarkan_Produk->HrefValue = "";
        $this->Media_Sosial_Untuk_Memasarkan_Produk->TooltipValue = "";

        // Marketplace yang Digunakan untuk Memasarkan Produk
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->LinkCustomAttributes = "";
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->HrefValue = "";
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->TooltipValue = "";

        // Menggunakan Google Bisnisku untuk Memasarkan Produk
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->LinkCustomAttributes = "";
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->HrefValue = "";
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->TooltipValue = "";

        // Menggunakan Website untuk Memasarkan Produk
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->LinkCustomAttributes = "";
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->HrefValue = "";
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->TooltipValue = "";

        // Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->LinkCustomAttributes = "";
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->HrefValue = "";
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->TooltipValue = "";

        // Memperbarui Berita / Informasi / Tulisan di Website
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->LinkCustomAttributes = "";
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->HrefValue = "";
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->TooltipValue = "";

        // Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->LinkCustomAttributes = "";
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->HrefValue = "";
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->TooltipValue = "";

        // Menggunakan Iklan Berbayar di Online
        $this->Menggunakan_Iklan_Berbayar_di_Online->LinkCustomAttributes = "";
        $this->Menggunakan_Iklan_Berbayar_di_Online->HrefValue = "";
        $this->Menggunakan_Iklan_Berbayar_di_Online->TooltipValue = "";

        // Usaha Berbadan Hukum
        $this->Usaha_Berbadan_Hukum->LinkCustomAttributes = "";
        $this->Usaha_Berbadan_Hukum->HrefValue = "";
        $this->Usaha_Berbadan_Hukum->TooltipValue = "";

        // Punya Izin Usaha
        $this->Punya_Izin_Usaha->LinkCustomAttributes = "";
        $this->Punya_Izin_Usaha->HrefValue = "";
        $this->Punya_Izin_Usaha->TooltipValue = "";

        // Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->LinkCustomAttributes = "";
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->HrefValue = "";
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->TooltipValue = "";

        // Punya Struktur Organisasi Usaha
        $this->Punya_Struktur_Organisasi_Usaha->LinkCustomAttributes = "";
        $this->Punya_Struktur_Organisasi_Usaha->HrefValue = "";
        $this->Punya_Struktur_Organisasi_Usaha->TooltipValue = "";

        // Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->LinkCustomAttributes = "";
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->HrefValue = "";
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->TooltipValue = "";

        // Punya Sertifikat Managemen Mutu ISO
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->LinkCustomAttributes = "";
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->HrefValue = "";
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->TooltipValue = "";

        // Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->LinkCustomAttributes = "";
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->HrefValue = "";
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->TooltipValue = "";

        // Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->LinkCustomAttributes = "";
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->HrefValue = "";
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->TooltipValue = "";

        // Ada Bukti Transaksi Berupa Nota / Kuitansi
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->LinkCustomAttributes = "";
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->HrefValue = "";
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->TooltipValue = "";

        // Punya Pencatatan Keuangan Usaha
        $this->Punya_Pencatatan_Keuangan_Usaha->LinkCustomAttributes = "";
        $this->Punya_Pencatatan_Keuangan_Usaha->HrefValue = "";
        $this->Punya_Pencatatan_Keuangan_Usaha->TooltipValue = "";

        // Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->LinkCustomAttributes = "";
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->HrefValue = "";
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->TooltipValue = "";

        // Punya Pinjaman Modal Usaha dari Perbankan
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->LinkCustomAttributes = "";
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->HrefValue = "";
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->TooltipValue = "";

        // Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->LinkCustomAttributes = "";
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->HrefValue = "";
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->TooltipValue = "";

        // Melayani Transaksi non Tunai
        $this->Melayani_Transaksi_non_Tunai->LinkCustomAttributes = "";
        $this->Melayani_Transaksi_non_Tunai->HrefValue = "";
        $this->Melayani_Transaksi_non_Tunai->TooltipValue = "";

        // Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->LinkCustomAttributes = "";
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->HrefValue = "";
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->TooltipValue = "";

        // Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->LinkCustomAttributes = "";
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->HrefValue = "";
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->TooltipValue = "";

        // Punya Target Bulanan / Tahunan
        $this->Punya_Target_Bulanan__Tahunan->LinkCustomAttributes = "";
        $this->Punya_Target_Bulanan__Tahunan->HrefValue = "";
        $this->Punya_Target_Bulanan__Tahunan->TooltipValue = "";

        // Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->LinkCustomAttributes = "";
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->HrefValue = "";
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->TooltipValue = "";

        // Punya Tenaga Kerja Sub Kontrak
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->LinkCustomAttributes = "";
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->HrefValue = "";
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->TooltipValue = "";

        // Besaran Gaji Karyawan
        $this->Besaran_Gaji_Karyawan->LinkCustomAttributes = "";
        $this->Besaran_Gaji_Karyawan->HrefValue = "";
        $this->Besaran_Gaji_Karyawan->TooltipValue = "";

        // Memberikan Jaminan Ketenagakerjaan kepada Karyawan
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->LinkCustomAttributes = "";
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->HrefValue = "";
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->TooltipValue = "";

        // Memberikan Tunjangan dan Bonus kepada Karyawan
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->LinkCustomAttributes = "";
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->HrefValue = "";
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->TooltipValue = "";

        // Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->LinkCustomAttributes = "";
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->HrefValue = "";
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->TooltipValue = "";

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

        // Nama Pemilik Usaha
        $this->Nama_Pemilik_Usaha->EditAttrs["class"] = "form-control";
        $this->Nama_Pemilik_Usaha->EditCustomAttributes = "";
        if (!$this->Nama_Pemilik_Usaha->Raw) {
            $this->Nama_Pemilik_Usaha->CurrentValue = HtmlDecode($this->Nama_Pemilik_Usaha->CurrentValue);
        }
        $this->Nama_Pemilik_Usaha->EditValue = $this->Nama_Pemilik_Usaha->CurrentValue;
        $this->Nama_Pemilik_Usaha->PlaceHolder = RemoveHtml($this->Nama_Pemilik_Usaha->caption());

        // Nomor Induk Kependudukan (NIK)
        $this->Nomor_Induk_Kependudukan_NIK->EditAttrs["class"] = "form-control";
        $this->Nomor_Induk_Kependudukan_NIK->EditCustomAttributes = "";
        if (!$this->Nomor_Induk_Kependudukan_NIK->Raw) {
            $this->Nomor_Induk_Kependudukan_NIK->CurrentValue = HtmlDecode($this->Nomor_Induk_Kependudukan_NIK->CurrentValue);
        }
        $this->Nomor_Induk_Kependudukan_NIK->EditValue = $this->Nomor_Induk_Kependudukan_NIK->CurrentValue;
        $this->Nomor_Induk_Kependudukan_NIK->PlaceHolder = RemoveHtml($this->Nomor_Induk_Kependudukan_NIK->caption());

        // Jenis Kelamin
        $this->Jenis_Kelamin->EditAttrs["class"] = "form-control";
        $this->Jenis_Kelamin->EditCustomAttributes = "";
        if (!$this->Jenis_Kelamin->Raw) {
            $this->Jenis_Kelamin->CurrentValue = HtmlDecode($this->Jenis_Kelamin->CurrentValue);
        }
        $this->Jenis_Kelamin->EditValue = $this->Jenis_Kelamin->CurrentValue;
        $this->Jenis_Kelamin->PlaceHolder = RemoveHtml($this->Jenis_Kelamin->caption());

        // Nama Jalan/Gang/RT/RW
        $this->Nama_JalanGangRTRW->EditAttrs["class"] = "form-control";
        $this->Nama_JalanGangRTRW->EditCustomAttributes = "";
        if (!$this->Nama_JalanGangRTRW->Raw) {
            $this->Nama_JalanGangRTRW->CurrentValue = HtmlDecode($this->Nama_JalanGangRTRW->CurrentValue);
        }
        $this->Nama_JalanGangRTRW->EditValue = $this->Nama_JalanGangRTRW->CurrentValue;
        $this->Nama_JalanGangRTRW->PlaceHolder = RemoveHtml($this->Nama_JalanGangRTRW->caption());

        // Dusun
        $this->Dusun->EditAttrs["class"] = "form-control";
        $this->Dusun->EditCustomAttributes = "";
        if (!$this->Dusun->Raw) {
            $this->Dusun->CurrentValue = HtmlDecode($this->Dusun->CurrentValue);
        }
        $this->Dusun->EditValue = $this->Dusun->CurrentValue;
        $this->Dusun->PlaceHolder = RemoveHtml($this->Dusun->caption());

        // Desa/Kelurahan
        $this->DesaKelurahan->EditAttrs["class"] = "form-control";
        $this->DesaKelurahan->EditCustomAttributes = "";
        if (!$this->DesaKelurahan->Raw) {
            $this->DesaKelurahan->CurrentValue = HtmlDecode($this->DesaKelurahan->CurrentValue);
        }
        $this->DesaKelurahan->EditValue = $this->DesaKelurahan->CurrentValue;
        $this->DesaKelurahan->PlaceHolder = RemoveHtml($this->DesaKelurahan->caption());

        // Kecamatan
        $this->Kecamatan->EditAttrs["class"] = "form-control";
        $this->Kecamatan->EditCustomAttributes = "";
        if (!$this->Kecamatan->Raw) {
            $this->Kecamatan->CurrentValue = HtmlDecode($this->Kecamatan->CurrentValue);
        }
        $this->Kecamatan->EditValue = $this->Kecamatan->CurrentValue;
        $this->Kecamatan->PlaceHolder = RemoveHtml($this->Kecamatan->caption());

        // Nomor Telepon/HP
        $this->Nomor_TeleponHP->EditAttrs["class"] = "form-control";
        $this->Nomor_TeleponHP->EditCustomAttributes = "";
        if (!$this->Nomor_TeleponHP->Raw) {
            $this->Nomor_TeleponHP->CurrentValue = HtmlDecode($this->Nomor_TeleponHP->CurrentValue);
        }
        $this->Nomor_TeleponHP->EditValue = $this->Nomor_TeleponHP->CurrentValue;
        $this->Nomor_TeleponHP->PlaceHolder = RemoveHtml($this->Nomor_TeleponHP->caption());

        // Alamat Email
        $this->Alamat_Email->EditAttrs["class"] = "form-control";
        $this->Alamat_Email->EditCustomAttributes = "";
        if (!$this->Alamat_Email->Raw) {
            $this->Alamat_Email->CurrentValue = HtmlDecode($this->Alamat_Email->CurrentValue);
        }
        $this->Alamat_Email->EditValue = $this->Alamat_Email->CurrentValue;
        $this->Alamat_Email->PlaceHolder = RemoveHtml($this->Alamat_Email->caption());

        // Nama Usaha
        $this->Nama_Usaha->EditAttrs["class"] = "form-control";
        $this->Nama_Usaha->EditCustomAttributes = "";
        if (!$this->Nama_Usaha->Raw) {
            $this->Nama_Usaha->CurrentValue = HtmlDecode($this->Nama_Usaha->CurrentValue);
        }
        $this->Nama_Usaha->EditValue = $this->Nama_Usaha->CurrentValue;
        $this->Nama_Usaha->PlaceHolder = RemoveHtml($this->Nama_Usaha->caption());

        // Tahun Mulai Usaha
        $this->Tahun_Mulai_Usaha->EditAttrs["class"] = "form-control";
        $this->Tahun_Mulai_Usaha->EditCustomAttributes = "";
        if (!$this->Tahun_Mulai_Usaha->Raw) {
            $this->Tahun_Mulai_Usaha->CurrentValue = HtmlDecode($this->Tahun_Mulai_Usaha->CurrentValue);
        }
        $this->Tahun_Mulai_Usaha->EditValue = $this->Tahun_Mulai_Usaha->CurrentValue;
        $this->Tahun_Mulai_Usaha->PlaceHolder = RemoveHtml($this->Tahun_Mulai_Usaha->caption());

        // Nama Jalan/Gang/RT/RW (1)
        $this->Nama_JalanGangRTRW_1->EditAttrs["class"] = "form-control";
        $this->Nama_JalanGangRTRW_1->EditCustomAttributes = "";
        if (!$this->Nama_JalanGangRTRW_1->Raw) {
            $this->Nama_JalanGangRTRW_1->CurrentValue = HtmlDecode($this->Nama_JalanGangRTRW_1->CurrentValue);
        }
        $this->Nama_JalanGangRTRW_1->EditValue = $this->Nama_JalanGangRTRW_1->CurrentValue;
        $this->Nama_JalanGangRTRW_1->PlaceHolder = RemoveHtml($this->Nama_JalanGangRTRW_1->caption());

        // Dusun (1)
        $this->Dusun_1->EditAttrs["class"] = "form-control";
        $this->Dusun_1->EditCustomAttributes = "";
        if (!$this->Dusun_1->Raw) {
            $this->Dusun_1->CurrentValue = HtmlDecode($this->Dusun_1->CurrentValue);
        }
        $this->Dusun_1->EditValue = $this->Dusun_1->CurrentValue;
        $this->Dusun_1->PlaceHolder = RemoveHtml($this->Dusun_1->caption());

        // Desa/Kelurahan (1)
        $this->DesaKelurahan_1->EditAttrs["class"] = "form-control";
        $this->DesaKelurahan_1->EditCustomAttributes = "";
        if (!$this->DesaKelurahan_1->Raw) {
            $this->DesaKelurahan_1->CurrentValue = HtmlDecode($this->DesaKelurahan_1->CurrentValue);
        }
        $this->DesaKelurahan_1->EditValue = $this->DesaKelurahan_1->CurrentValue;
        $this->DesaKelurahan_1->PlaceHolder = RemoveHtml($this->DesaKelurahan_1->caption());

        // Kecamatan (1)
        $this->Kecamatan_1->EditAttrs["class"] = "form-control";
        $this->Kecamatan_1->EditCustomAttributes = "";
        if (!$this->Kecamatan_1->Raw) {
            $this->Kecamatan_1->CurrentValue = HtmlDecode($this->Kecamatan_1->CurrentValue);
        }
        $this->Kecamatan_1->EditValue = $this->Kecamatan_1->CurrentValue;
        $this->Kecamatan_1->PlaceHolder = RemoveHtml($this->Kecamatan_1->caption());

        // Status Usaha
        $this->Status_Usaha->EditAttrs["class"] = "form-control";
        $this->Status_Usaha->EditCustomAttributes = "";
        if (!$this->Status_Usaha->Raw) {
            $this->Status_Usaha->CurrentValue = HtmlDecode($this->Status_Usaha->CurrentValue);
        }
        $this->Status_Usaha->EditValue = $this->Status_Usaha->CurrentValue;
        $this->Status_Usaha->PlaceHolder = RemoveHtml($this->Status_Usaha->caption());

        // No Telp/HP Usaha Perusahaan
        $this->No_TelpHP_Usaha_Perusahaan->EditAttrs["class"] = "form-control";
        $this->No_TelpHP_Usaha_Perusahaan->EditCustomAttributes = "";
        if (!$this->No_TelpHP_Usaha_Perusahaan->Raw) {
            $this->No_TelpHP_Usaha_Perusahaan->CurrentValue = HtmlDecode($this->No_TelpHP_Usaha_Perusahaan->CurrentValue);
        }
        $this->No_TelpHP_Usaha_Perusahaan->EditValue = $this->No_TelpHP_Usaha_Perusahaan->CurrentValue;
        $this->No_TelpHP_Usaha_Perusahaan->PlaceHolder = RemoveHtml($this->No_TelpHP_Usaha_Perusahaan->caption());

        // Alamat Email Usaha/Perusahaan
        $this->Alamat_Email_UsahaPerusahaan->EditAttrs["class"] = "form-control";
        $this->Alamat_Email_UsahaPerusahaan->EditCustomAttributes = "";
        if (!$this->Alamat_Email_UsahaPerusahaan->Raw) {
            $this->Alamat_Email_UsahaPerusahaan->CurrentValue = HtmlDecode($this->Alamat_Email_UsahaPerusahaan->CurrentValue);
        }
        $this->Alamat_Email_UsahaPerusahaan->EditValue = $this->Alamat_Email_UsahaPerusahaan->CurrentValue;
        $this->Alamat_Email_UsahaPerusahaan->PlaceHolder = RemoveHtml($this->Alamat_Email_UsahaPerusahaan->caption());

        // Alamat Website Usaha/Perusahaan (Jika Ada)
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->EditAttrs["class"] = "form-control";
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->EditCustomAttributes = "";
        if (!$this->Alamat_Website_UsahaPerusahaan_Jika_Ada->Raw) {
            $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->CurrentValue = HtmlDecode($this->Alamat_Website_UsahaPerusahaan_Jika_Ada->CurrentValue);
        }
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->EditValue = $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->CurrentValue;
        $this->Alamat_Website_UsahaPerusahaan_Jika_Ada->PlaceHolder = RemoveHtml($this->Alamat_Website_UsahaPerusahaan_Jika_Ada->caption());

        // Afiliasi dengan e-marketing
        $this->Afiliasi_dengan_emarketing->EditAttrs["class"] = "form-control";
        $this->Afiliasi_dengan_emarketing->EditCustomAttributes = "";
        if (!$this->Afiliasi_dengan_emarketing->Raw) {
            $this->Afiliasi_dengan_emarketing->CurrentValue = HtmlDecode($this->Afiliasi_dengan_emarketing->CurrentValue);
        }
        $this->Afiliasi_dengan_emarketing->EditValue = $this->Afiliasi_dengan_emarketing->CurrentValue;
        $this->Afiliasi_dengan_emarketing->PlaceHolder = RemoveHtml($this->Afiliasi_dengan_emarketing->caption());

        // NPWP
        $this->NPWP->EditAttrs["class"] = "form-control";
        $this->NPWP->EditCustomAttributes = "";
        if (!$this->NPWP->Raw) {
            $this->NPWP->CurrentValue = HtmlDecode($this->NPWP->CurrentValue);
        }
        $this->NPWP->EditValue = $this->NPWP->CurrentValue;
        $this->NPWP->PlaceHolder = RemoveHtml($this->NPWP->caption());

        // Nomor dan Ijin Usaha yang ada
        $this->Nomor_dan_Ijin_Usaha_yang_ada->EditAttrs["class"] = "form-control";
        $this->Nomor_dan_Ijin_Usaha_yang_ada->EditCustomAttributes = "";
        if (!$this->Nomor_dan_Ijin_Usaha_yang_ada->Raw) {
            $this->Nomor_dan_Ijin_Usaha_yang_ada->CurrentValue = HtmlDecode($this->Nomor_dan_Ijin_Usaha_yang_ada->CurrentValue);
        }
        $this->Nomor_dan_Ijin_Usaha_yang_ada->EditValue = $this->Nomor_dan_Ijin_Usaha_yang_ada->CurrentValue;
        $this->Nomor_dan_Ijin_Usaha_yang_ada->PlaceHolder = RemoveHtml($this->Nomor_dan_Ijin_Usaha_yang_ada->caption());

        // Badan Hukum Perusahaan
        $this->Badan_Hukum_Perusahaan->EditAttrs["class"] = "form-control";
        $this->Badan_Hukum_Perusahaan->EditCustomAttributes = "";
        if (!$this->Badan_Hukum_Perusahaan->Raw) {
            $this->Badan_Hukum_Perusahaan->CurrentValue = HtmlDecode($this->Badan_Hukum_Perusahaan->CurrentValue);
        }
        $this->Badan_Hukum_Perusahaan->EditValue = $this->Badan_Hukum_Perusahaan->CurrentValue;
        $this->Badan_Hukum_Perusahaan->PlaceHolder = RemoveHtml($this->Badan_Hukum_Perusahaan->caption());

        // Jenis Usaha/Sektor/Produk
        $this->Jenis_UsahaSektorProduk->EditAttrs["class"] = "form-control";
        $this->Jenis_UsahaSektorProduk->EditCustomAttributes = "";
        if (!$this->Jenis_UsahaSektorProduk->Raw) {
            $this->Jenis_UsahaSektorProduk->CurrentValue = HtmlDecode($this->Jenis_UsahaSektorProduk->CurrentValue);
        }
        $this->Jenis_UsahaSektorProduk->EditValue = $this->Jenis_UsahaSektorProduk->CurrentValue;
        $this->Jenis_UsahaSektorProduk->PlaceHolder = RemoveHtml($this->Jenis_UsahaSektorProduk->caption());

        // Kegiatan usaha yang dilakukan
        $this->Kegiatan_usaha_yang_dilakukan->EditAttrs["class"] = "form-control";
        $this->Kegiatan_usaha_yang_dilakukan->EditCustomAttributes = "";
        if (!$this->Kegiatan_usaha_yang_dilakukan->Raw) {
            $this->Kegiatan_usaha_yang_dilakukan->CurrentValue = HtmlDecode($this->Kegiatan_usaha_yang_dilakukan->CurrentValue);
        }
        $this->Kegiatan_usaha_yang_dilakukan->EditValue = $this->Kegiatan_usaha_yang_dilakukan->CurrentValue;
        $this->Kegiatan_usaha_yang_dilakukan->PlaceHolder = RemoveHtml($this->Kegiatan_usaha_yang_dilakukan->caption());

        // Nama Merk Usaha
        $this->Nama_Merk_Usaha->EditAttrs["class"] = "form-control";
        $this->Nama_Merk_Usaha->EditCustomAttributes = "";
        if (!$this->Nama_Merk_Usaha->Raw) {
            $this->Nama_Merk_Usaha->CurrentValue = HtmlDecode($this->Nama_Merk_Usaha->CurrentValue);
        }
        $this->Nama_Merk_Usaha->EditValue = $this->Nama_Merk_Usaha->CurrentValue;
        $this->Nama_Merk_Usaha->PlaceHolder = RemoveHtml($this->Nama_Merk_Usaha->caption());

        // Bahan Baku
        $this->Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Bahan_Baku->EditCustomAttributes = "";
        if (!$this->Bahan_Baku->Raw) {
            $this->Bahan_Baku->CurrentValue = HtmlDecode($this->Bahan_Baku->CurrentValue);
        }
        $this->Bahan_Baku->EditValue = $this->Bahan_Baku->CurrentValue;
        $this->Bahan_Baku->PlaceHolder = RemoveHtml($this->Bahan_Baku->caption());

        // Sumber Bahan Baku/Daerah Asal Bahan Baku
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->EditCustomAttributes = "";
        if (!$this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->Raw) {
            $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->CurrentValue = HtmlDecode($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->CurrentValue);
        }
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->EditValue = $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->CurrentValue;
        $this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->PlaceHolder = RemoveHtml($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku->caption());

        // Nilai Penjualan Produk (Omzet per Bulan) (dalam rupiah)
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditCustomAttributes = "";
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditValue = $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->CurrentValue;
        $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->PlaceHolder = RemoveHtml($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->caption());
        if (strval($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditValue) != "" && is_numeric($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditValue)) {
            $this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditValue = FormatNumber($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Negara Tujuan Ekspor
        $this->Negara_Tujuan_Ekspor->EditAttrs["class"] = "form-control";
        $this->Negara_Tujuan_Ekspor->EditCustomAttributes = "";
        if (!$this->Negara_Tujuan_Ekspor->Raw) {
            $this->Negara_Tujuan_Ekspor->CurrentValue = HtmlDecode($this->Negara_Tujuan_Ekspor->CurrentValue);
        }
        $this->Negara_Tujuan_Ekspor->EditValue = $this->Negara_Tujuan_Ekspor->CurrentValue;
        $this->Negara_Tujuan_Ekspor->PlaceHolder = RemoveHtml($this->Negara_Tujuan_Ekspor->caption());

        // Jumlah produk yang dihasilkan per bulan
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->EditAttrs["class"] = "form-control";
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->EditCustomAttributes = "";
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->EditValue = $this->Jumlah_produk_yang_dihasilkan_per_bulan->CurrentValue;
        $this->Jumlah_produk_yang_dihasilkan_per_bulan->PlaceHolder = RemoveHtml($this->Jumlah_produk_yang_dihasilkan_per_bulan->caption());
        if (strval($this->Jumlah_produk_yang_dihasilkan_per_bulan->EditValue) != "" && is_numeric($this->Jumlah_produk_yang_dihasilkan_per_bulan->EditValue)) {
            $this->Jumlah_produk_yang_dihasilkan_per_bulan->EditValue = FormatNumber($this->Jumlah_produk_yang_dihasilkan_per_bulan->EditValue, -2, -2, -2, -2);
        }

        // Satuan Produk
        $this->Satuan_Produk->EditAttrs["class"] = "form-control";
        $this->Satuan_Produk->EditCustomAttributes = "";
        if (!$this->Satuan_Produk->Raw) {
            $this->Satuan_Produk->CurrentValue = HtmlDecode($this->Satuan_Produk->CurrentValue);
        }
        $this->Satuan_Produk->EditValue = $this->Satuan_Produk->CurrentValue;
        $this->Satuan_Produk->PlaceHolder = RemoveHtml($this->Satuan_Produk->caption());

        // Harga tanah dan bangunan usaha milik pribadi (dalam rupiah)
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditCustomAttributes = "";
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditValue = $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->CurrentValue;
        $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->PlaceHolder = RemoveHtml($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->caption());
        if (strval($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditValue) != "" && is_numeric($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditValue)) {
            $this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditValue = FormatNumber($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Harga sewa tanah dan bangunan usaha (dalam rupiah)
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditCustomAttributes = "";
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditValue = $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->CurrentValue;
        $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->PlaceHolder = RemoveHtml($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->caption());
        if (strval($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditValue) != "" && is_numeric($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditValue)) {
            $this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditValue = FormatNumber($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Harga aset yang dimiliki (dalam rupiah)
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->EditCustomAttributes = "";
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->EditValue = $this->Harga_aset_yang_dimiliki_dalam_rupiah->CurrentValue;
        $this->Harga_aset_yang_dimiliki_dalam_rupiah->PlaceHolder = RemoveHtml($this->Harga_aset_yang_dimiliki_dalam_rupiah->caption());
        if (strval($this->Harga_aset_yang_dimiliki_dalam_rupiah->EditValue) != "" && is_numeric($this->Harga_aset_yang_dimiliki_dalam_rupiah->EditValue)) {
            $this->Harga_aset_yang_dimiliki_dalam_rupiah->EditValue = FormatNumber($this->Harga_aset_yang_dimiliki_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Modal kerja per bulan (dalam rupiah)
        $this->Modal_kerja_per_bulan_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Modal_kerja_per_bulan_dalam_rupiah->EditCustomAttributes = "";
        $this->Modal_kerja_per_bulan_dalam_rupiah->EditValue = $this->Modal_kerja_per_bulan_dalam_rupiah->CurrentValue;
        $this->Modal_kerja_per_bulan_dalam_rupiah->PlaceHolder = RemoveHtml($this->Modal_kerja_per_bulan_dalam_rupiah->caption());
        if (strval($this->Modal_kerja_per_bulan_dalam_rupiah->EditValue) != "" && is_numeric($this->Modal_kerja_per_bulan_dalam_rupiah->EditValue)) {
            $this->Modal_kerja_per_bulan_dalam_rupiah->EditValue = FormatNumber($this->Modal_kerja_per_bulan_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Jumlah Tenaga Kerja Laki Laki
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->EditAttrs["class"] = "form-control";
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->EditCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->EditValue = $this->Jumlah_Tenaga_Kerja_Laki_Laki->CurrentValue;
        $this->Jumlah_Tenaga_Kerja_Laki_Laki->PlaceHolder = RemoveHtml($this->Jumlah_Tenaga_Kerja_Laki_Laki->caption());

        // Jumlah Tenaga Kerja Perempuan
        $this->Jumlah_Tenaga_Kerja_Perempuan->EditAttrs["class"] = "form-control";
        $this->Jumlah_Tenaga_Kerja_Perempuan->EditCustomAttributes = "";
        $this->Jumlah_Tenaga_Kerja_Perempuan->EditValue = $this->Jumlah_Tenaga_Kerja_Perempuan->CurrentValue;
        $this->Jumlah_Tenaga_Kerja_Perempuan->PlaceHolder = RemoveHtml($this->Jumlah_Tenaga_Kerja_Perempuan->caption());

        // Bantuan Pemerintah
        $this->Bantuan_Pemerintah->EditAttrs["class"] = "form-control";
        $this->Bantuan_Pemerintah->EditCustomAttributes = "";
        if (!$this->Bantuan_Pemerintah->Raw) {
            $this->Bantuan_Pemerintah->CurrentValue = HtmlDecode($this->Bantuan_Pemerintah->CurrentValue);
        }
        $this->Bantuan_Pemerintah->EditValue = $this->Bantuan_Pemerintah->CurrentValue;
        $this->Bantuan_Pemerintah->PlaceHolder = RemoveHtml($this->Bantuan_Pemerintah->caption());

        // Jika menerima bantuan pemerintah, sebutkan lembaga/organisasi pe
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->EditAttrs["class"] = "form-control";
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->EditCustomAttributes = "";
        if (!$this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->Raw) {
            $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->CurrentValue = HtmlDecode($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->CurrentValue);
        }
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->EditValue = $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->CurrentValue;
        $this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->PlaceHolder = RemoveHtml($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe->caption());

        // Nama Jenis Pinjaman (jika ada)
        $this->Nama_Jenis_Pinjaman_jika_ada->EditAttrs["class"] = "form-control";
        $this->Nama_Jenis_Pinjaman_jika_ada->EditCustomAttributes = "";
        if (!$this->Nama_Jenis_Pinjaman_jika_ada->Raw) {
            $this->Nama_Jenis_Pinjaman_jika_ada->CurrentValue = HtmlDecode($this->Nama_Jenis_Pinjaman_jika_ada->CurrentValue);
        }
        $this->Nama_Jenis_Pinjaman_jika_ada->EditValue = $this->Nama_Jenis_Pinjaman_jika_ada->CurrentValue;
        $this->Nama_Jenis_Pinjaman_jika_ada->PlaceHolder = RemoveHtml($this->Nama_Jenis_Pinjaman_jika_ada->caption());

        // Pemberi Pinjaman (jika ada)
        $this->Pemberi_Pinjaman_jika_ada->EditAttrs["class"] = "form-control";
        $this->Pemberi_Pinjaman_jika_ada->EditCustomAttributes = "";
        if (!$this->Pemberi_Pinjaman_jika_ada->Raw) {
            $this->Pemberi_Pinjaman_jika_ada->CurrentValue = HtmlDecode($this->Pemberi_Pinjaman_jika_ada->CurrentValue);
        }
        $this->Pemberi_Pinjaman_jika_ada->EditValue = $this->Pemberi_Pinjaman_jika_ada->CurrentValue;
        $this->Pemberi_Pinjaman_jika_ada->PlaceHolder = RemoveHtml($this->Pemberi_Pinjaman_jika_ada->caption());

        // Jumlah Pinjaman (dalam rupiah)
        $this->Jumlah_Pinjaman_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Jumlah_Pinjaman_dalam_rupiah->EditCustomAttributes = "";
        $this->Jumlah_Pinjaman_dalam_rupiah->EditValue = $this->Jumlah_Pinjaman_dalam_rupiah->CurrentValue;
        $this->Jumlah_Pinjaman_dalam_rupiah->PlaceHolder = RemoveHtml($this->Jumlah_Pinjaman_dalam_rupiah->caption());
        if (strval($this->Jumlah_Pinjaman_dalam_rupiah->EditValue) != "" && is_numeric($this->Jumlah_Pinjaman_dalam_rupiah->EditValue)) {
            $this->Jumlah_Pinjaman_dalam_rupiah->EditValue = FormatNumber($this->Jumlah_Pinjaman_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Kepesertaan Program Keluarga Harapan (PKH) dan sejenisnya
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->EditAttrs["class"] = "form-control";
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->EditCustomAttributes = "";
        if (!$this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->Raw) {
            $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->CurrentValue = HtmlDecode($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->CurrentValue);
        }
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->EditValue = $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->CurrentValue;
        $this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->PlaceHolder = RemoveHtml($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya->caption());

        // Rata-rata omzet per tahun (dalam rupiah)
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->EditAttrs["class"] = "form-control";
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->EditCustomAttributes = "";
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->EditValue = $this->Ratarata_omzet_per_tahun_dalam_rupiah->CurrentValue;
        $this->Ratarata_omzet_per_tahun_dalam_rupiah->PlaceHolder = RemoveHtml($this->Ratarata_omzet_per_tahun_dalam_rupiah->caption());
        if (strval($this->Ratarata_omzet_per_tahun_dalam_rupiah->EditValue) != "" && is_numeric($this->Ratarata_omzet_per_tahun_dalam_rupiah->EditValue)) {
            $this->Ratarata_omzet_per_tahun_dalam_rupiah->EditValue = FormatNumber($this->Ratarata_omzet_per_tahun_dalam_rupiah->EditValue, -2, -2, -2, -2);
        }

        // Struktur Organisasi Perangkat Daerah (SOPD) Pembina (jika ada)
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->EditAttrs["class"] = "form-control";
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->EditCustomAttributes = "";
        if (!$this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->Raw) {
            $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->CurrentValue = HtmlDecode($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->CurrentValue);
        }
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->EditValue = $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->CurrentValue;
        $this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->PlaceHolder = RemoveHtml($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada->caption());

        // Aktifitas Produksi di Usaha Saya
        $this->Aktifitas_Produksi_di_Usaha_Saya->EditAttrs["class"] = "form-control";
        $this->Aktifitas_Produksi_di_Usaha_Saya->EditCustomAttributes = "";
        if (!$this->Aktifitas_Produksi_di_Usaha_Saya->Raw) {
            $this->Aktifitas_Produksi_di_Usaha_Saya->CurrentValue = HtmlDecode($this->Aktifitas_Produksi_di_Usaha_Saya->CurrentValue);
        }
        $this->Aktifitas_Produksi_di_Usaha_Saya->EditValue = $this->Aktifitas_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Aktifitas_Produksi_di_Usaha_Saya->PlaceHolder = RemoveHtml($this->Aktifitas_Produksi_di_Usaha_Saya->caption());

        // Jumlah Produksi di Usaha Saya
        $this->Jumlah_Produksi_di_Usaha_Saya->EditAttrs["class"] = "form-control";
        $this->Jumlah_Produksi_di_Usaha_Saya->EditCustomAttributes = "";
        if (!$this->Jumlah_Produksi_di_Usaha_Saya->Raw) {
            $this->Jumlah_Produksi_di_Usaha_Saya->CurrentValue = HtmlDecode($this->Jumlah_Produksi_di_Usaha_Saya->CurrentValue);
        }
        $this->Jumlah_Produksi_di_Usaha_Saya->EditValue = $this->Jumlah_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Jumlah_Produksi_di_Usaha_Saya->PlaceHolder = RemoveHtml($this->Jumlah_Produksi_di_Usaha_Saya->caption());

        // Khusus Usaha Olahan Makanan dan Minuman: Produk Memiliki Standar
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->EditAttrs["class"] = "form-control";
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->EditCustomAttributes = "";
        if (!$this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->Raw) {
            $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->CurrentValue = HtmlDecode($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->CurrentValue);
        }
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->EditValue = $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->CurrentValue;
        $this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->PlaceHolder = RemoveHtml($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar->caption());

        // Khusus Usaha Kerajinan dan Fesyen: Produk Menerapkan / Memiliki
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->EditAttrs["class"] = "form-control";
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->EditCustomAttributes = "";
        if (!$this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->Raw) {
            $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->CurrentValue = HtmlDecode($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->CurrentValue);
        }
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->EditValue = $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->CurrentValue;
        $this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->PlaceHolder = RemoveHtml($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki->caption());

        // Kemasan yang Digunakan Memenuhi Standar untuk Keamanan Produk
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->EditAttrs["class"] = "form-control";
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->EditCustomAttributes = "";
        if (!$this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->Raw) {
            $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->CurrentValue = HtmlDecode($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->CurrentValue);
        }
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->EditValue = $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->CurrentValue;
        $this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->PlaceHolder = RemoveHtml($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk->caption());

        // Ketersediaan Bahan Baku
        $this->Ketersediaan_Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Ketersediaan_Bahan_Baku->EditCustomAttributes = "";
        if (!$this->Ketersediaan_Bahan_Baku->Raw) {
            $this->Ketersediaan_Bahan_Baku->CurrentValue = HtmlDecode($this->Ketersediaan_Bahan_Baku->CurrentValue);
        }
        $this->Ketersediaan_Bahan_Baku->EditValue = $this->Ketersediaan_Bahan_Baku->CurrentValue;
        $this->Ketersediaan_Bahan_Baku->PlaceHolder = RemoveHtml($this->Ketersediaan_Bahan_Baku->caption());

        // Alat Produksi di Usaha Saya
        $this->Alat_Produksi_di_Usaha_Saya->EditAttrs["class"] = "form-control";
        $this->Alat_Produksi_di_Usaha_Saya->EditCustomAttributes = "";
        if (!$this->Alat_Produksi_di_Usaha_Saya->Raw) {
            $this->Alat_Produksi_di_Usaha_Saya->CurrentValue = HtmlDecode($this->Alat_Produksi_di_Usaha_Saya->CurrentValue);
        }
        $this->Alat_Produksi_di_Usaha_Saya->EditValue = $this->Alat_Produksi_di_Usaha_Saya->CurrentValue;
        $this->Alat_Produksi_di_Usaha_Saya->PlaceHolder = RemoveHtml($this->Alat_Produksi_di_Usaha_Saya->caption());

        // Gudang Penyimpanan Bahan Baku / Produk Usaha Saya (Bahan Baku
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->EditAttrs["class"] = "form-control";
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->EditCustomAttributes = "";
        if (!$this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->Raw) {
            $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->CurrentValue = HtmlDecode($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->CurrentValue);
        }
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->EditValue = $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->CurrentValue;
        $this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->PlaceHolder = RemoveHtml($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku->caption());

        // Layout Produksi Sesuai dengan Alur Proses Produksi dari Awal Sam
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->EditAttrs["class"] = "form-control";
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->EditCustomAttributes = "";
        if (!$this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->Raw) {
            $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->CurrentValue = HtmlDecode($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->CurrentValue);
        }
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->EditValue = $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->CurrentValue;
        $this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->PlaceHolder = RemoveHtml($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam->caption());

        // Menerapkan Standar Operational Prosedur (SOP) Produksi
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->EditAttrs["class"] = "form-control";
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->EditCustomAttributes = "";
        if (!$this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->Raw) {
            $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->CurrentValue = HtmlDecode($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->CurrentValue);
        }
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->EditValue = $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->CurrentValue;
        $this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->PlaceHolder = RemoveHtml($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi->caption());

        // Mengetahui Kelebihan / Kekuatan Produk
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->EditAttrs["class"] = "form-control";
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->EditCustomAttributes = "";
        if (!$this->Mengetahui_Kelebihan__Kekuatan_Produk->Raw) {
            $this->Mengetahui_Kelebihan__Kekuatan_Produk->CurrentValue = HtmlDecode($this->Mengetahui_Kelebihan__Kekuatan_Produk->CurrentValue);
        }
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->EditValue = $this->Mengetahui_Kelebihan__Kekuatan_Produk->CurrentValue;
        $this->Mengetahui_Kelebihan__Kekuatan_Produk->PlaceHolder = RemoveHtml($this->Mengetahui_Kelebihan__Kekuatan_Produk->caption());

        // Mengetahui Target Pasar Utama (Calon Pembeli Utama)
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->EditAttrs["class"] = "form-control";
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->EditCustomAttributes = "";
        if (!$this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->Raw) {
            $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->CurrentValue = HtmlDecode($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->CurrentValue);
        }
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->EditValue = $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->CurrentValue;
        $this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->PlaceHolder = RemoveHtml($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama->caption());

        // Produk Mudah Didapatkan oleh Target Pasar Utama (Calon Pembeli U
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->EditAttrs["class"] = "form-control";
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->EditCustomAttributes = "";
        if (!$this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->Raw) {
            $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->CurrentValue = HtmlDecode($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->CurrentValue);
        }
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->EditValue = $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->CurrentValue;
        $this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->PlaceHolder = RemoveHtml($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U->caption());

        // Memiliki Nama Merk / Logo Dagang
        $this->Memiliki_Nama_Merk__Logo_Dagang->EditAttrs["class"] = "form-control";
        $this->Memiliki_Nama_Merk__Logo_Dagang->EditCustomAttributes = "";
        if (!$this->Memiliki_Nama_Merk__Logo_Dagang->Raw) {
            $this->Memiliki_Nama_Merk__Logo_Dagang->CurrentValue = HtmlDecode($this->Memiliki_Nama_Merk__Logo_Dagang->CurrentValue);
        }
        $this->Memiliki_Nama_Merk__Logo_Dagang->EditValue = $this->Memiliki_Nama_Merk__Logo_Dagang->CurrentValue;
        $this->Memiliki_Nama_Merk__Logo_Dagang->PlaceHolder = RemoveHtml($this->Memiliki_Nama_Merk__Logo_Dagang->caption());

        // Merek / Logo Dagang Sudah Terdaftar di Dirjen HKI Kemenkumham RI
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->EditAttrs["class"] = "form-control";
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->EditCustomAttributes = "";
        if (!$this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->Raw) {
            $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->CurrentValue = HtmlDecode($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->CurrentValue);
        }
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->EditValue = $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->CurrentValue;
        $this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->PlaceHolder = RemoveHtml($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI->caption());

        // Punya Konsep Branding (Narasi / Cerita / Nilai Terkait Produk)
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->EditAttrs["class"] = "form-control";
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->EditCustomAttributes = "";
        if (!$this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->Raw) {
            $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->CurrentValue = HtmlDecode($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->CurrentValue);
        }
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->EditValue = $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->CurrentValue;
        $this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->PlaceHolder = RemoveHtml($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk->caption());

        // Punya lisensi Co Branding Jogjamark (Jogjamark / 100% Jogja / Jo
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->EditAttrs["class"] = "form-control";
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->EditCustomAttributes = "";
        if (!$this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->Raw) {
            $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->CurrentValue = HtmlDecode($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->CurrentValue);
        }
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->EditValue = $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->CurrentValue;
        $this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->PlaceHolder = RemoveHtml($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo->caption());

        // Punya Media Pemasaran Offline (Papan Nama, Brosur, Kartu Nama, S
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->EditAttrs["class"] = "form-control";
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->EditCustomAttributes = "";
        if (!$this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->Raw) {
            $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->CurrentValue = HtmlDecode($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->CurrentValue);
        }
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->EditValue = $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->CurrentValue;
        $this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->PlaceHolder = RemoveHtml($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S->caption());

        // Punya Mitra Kerjasama Pemasaran Produk seperti Reseller / Dropsh
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->EditAttrs["class"] = "form-control";
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->EditCustomAttributes = "";
        if (!$this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->Raw) {
            $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->CurrentValue = HtmlDecode($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->CurrentValue);
        }
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->EditValue = $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->CurrentValue;
        $this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->PlaceHolder = RemoveHtml($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh->caption());

        // Sebaran Pemasaran Produk
        $this->Sebaran_Pemasaran_Produk->EditAttrs["class"] = "form-control";
        $this->Sebaran_Pemasaran_Produk->EditCustomAttributes = "";
        if (!$this->Sebaran_Pemasaran_Produk->Raw) {
            $this->Sebaran_Pemasaran_Produk->CurrentValue = HtmlDecode($this->Sebaran_Pemasaran_Produk->CurrentValue);
        }
        $this->Sebaran_Pemasaran_Produk->EditValue = $this->Sebaran_Pemasaran_Produk->CurrentValue;
        $this->Sebaran_Pemasaran_Produk->PlaceHolder = RemoveHtml($this->Sebaran_Pemasaran_Produk->caption());

        // Punya Pelanggan Tetap
        $this->Punya_Pelanggan_Tetap->EditAttrs["class"] = "form-control";
        $this->Punya_Pelanggan_Tetap->EditCustomAttributes = "";
        if (!$this->Punya_Pelanggan_Tetap->Raw) {
            $this->Punya_Pelanggan_Tetap->CurrentValue = HtmlDecode($this->Punya_Pelanggan_Tetap->CurrentValue);
        }
        $this->Punya_Pelanggan_Tetap->EditValue = $this->Punya_Pelanggan_Tetap->CurrentValue;
        $this->Punya_Pelanggan_Tetap->PlaceHolder = RemoveHtml($this->Punya_Pelanggan_Tetap->caption());

        // Mengikuti Pameran Produk secara Mandiri (Mengeluarkan Biaya untu
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->EditAttrs["class"] = "form-control";
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->EditCustomAttributes = "";
        if (!$this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->Raw) {
            $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->CurrentValue = HtmlDecode($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->CurrentValue);
        }
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->EditValue = $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->CurrentValue;
        $this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->PlaceHolder = RemoveHtml($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu->caption());

        // Media Chatting yang Digunakan untuk Memasarkan Produk
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->EditAttrs["class"] = "form-control";
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->EditCustomAttributes = "";
        if (!$this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->Raw) {
            $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue = HtmlDecode($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue);
        }
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->EditValue = $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue;
        $this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->PlaceHolder = RemoveHtml($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk->caption());

        // Media Sosial Untuk Memasarkan Produk
        $this->Media_Sosial_Untuk_Memasarkan_Produk->EditAttrs["class"] = "form-control";
        $this->Media_Sosial_Untuk_Memasarkan_Produk->EditCustomAttributes = "";
        if (!$this->Media_Sosial_Untuk_Memasarkan_Produk->Raw) {
            $this->Media_Sosial_Untuk_Memasarkan_Produk->CurrentValue = HtmlDecode($this->Media_Sosial_Untuk_Memasarkan_Produk->CurrentValue);
        }
        $this->Media_Sosial_Untuk_Memasarkan_Produk->EditValue = $this->Media_Sosial_Untuk_Memasarkan_Produk->CurrentValue;
        $this->Media_Sosial_Untuk_Memasarkan_Produk->PlaceHolder = RemoveHtml($this->Media_Sosial_Untuk_Memasarkan_Produk->caption());

        // Marketplace yang Digunakan untuk Memasarkan Produk
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->EditAttrs["class"] = "form-control";
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->EditCustomAttributes = "";
        if (!$this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->Raw) {
            $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue = HtmlDecode($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue);
        }
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->EditValue = $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->CurrentValue;
        $this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->PlaceHolder = RemoveHtml($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk->caption());

        // Menggunakan Google Bisnisku untuk Memasarkan Produk
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->EditAttrs["class"] = "form-control";
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->EditCustomAttributes = "";
        if (!$this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->Raw) {
            $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->CurrentValue = HtmlDecode($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->CurrentValue);
        }
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->EditValue = $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->CurrentValue;
        $this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->PlaceHolder = RemoveHtml($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk->caption());

        // Menggunakan Website untuk Memasarkan Produk
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->EditAttrs["class"] = "form-control";
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->EditCustomAttributes = "";
        if (!$this->Menggunakan_Website_untuk_Memasarkan_Produk->Raw) {
            $this->Menggunakan_Website_untuk_Memasarkan_Produk->CurrentValue = HtmlDecode($this->Menggunakan_Website_untuk_Memasarkan_Produk->CurrentValue);
        }
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->EditValue = $this->Menggunakan_Website_untuk_Memasarkan_Produk->CurrentValue;
        $this->Menggunakan_Website_untuk_Memasarkan_Produk->PlaceHolder = RemoveHtml($this->Menggunakan_Website_untuk_Memasarkan_Produk->caption());

        // Memperbarui Informasi Produk / Bisnis di Media Sosial / Marketpl
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->EditAttrs["class"] = "form-control";
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->EditCustomAttributes = "";
        if (!$this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->Raw) {
            $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->CurrentValue = HtmlDecode($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->CurrentValue);
        }
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->EditValue = $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->CurrentValue;
        $this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->PlaceHolder = RemoveHtml($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl->caption());

        // Memperbarui Berita / Informasi / Tulisan di Website
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->EditAttrs["class"] = "form-control";
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->EditCustomAttributes = "";
        if (!$this->Memperbarui_Berita__Informasi__Tulisan_di_Website->Raw) {
            $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->CurrentValue = HtmlDecode($this->Memperbarui_Berita__Informasi__Tulisan_di_Website->CurrentValue);
        }
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->EditValue = $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->CurrentValue;
        $this->Memperbarui_Berita__Informasi__Tulisan_di_Website->PlaceHolder = RemoveHtml($this->Memperbarui_Berita__Informasi__Tulisan_di_Website->caption());

        // Informasi Bisnis Mudah Ditemukan di Halaman Pencarian Google
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->EditAttrs["class"] = "form-control";
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->EditCustomAttributes = "";
        if (!$this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->Raw) {
            $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->CurrentValue = HtmlDecode($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->CurrentValue);
        }
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->EditValue = $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->CurrentValue;
        $this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->PlaceHolder = RemoveHtml($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google->caption());

        // Menggunakan Iklan Berbayar di Online
        $this->Menggunakan_Iklan_Berbayar_di_Online->EditAttrs["class"] = "form-control";
        $this->Menggunakan_Iklan_Berbayar_di_Online->EditCustomAttributes = "";
        if (!$this->Menggunakan_Iklan_Berbayar_di_Online->Raw) {
            $this->Menggunakan_Iklan_Berbayar_di_Online->CurrentValue = HtmlDecode($this->Menggunakan_Iklan_Berbayar_di_Online->CurrentValue);
        }
        $this->Menggunakan_Iklan_Berbayar_di_Online->EditValue = $this->Menggunakan_Iklan_Berbayar_di_Online->CurrentValue;
        $this->Menggunakan_Iklan_Berbayar_di_Online->PlaceHolder = RemoveHtml($this->Menggunakan_Iklan_Berbayar_di_Online->caption());

        // Usaha Berbadan Hukum
        $this->Usaha_Berbadan_Hukum->EditAttrs["class"] = "form-control";
        $this->Usaha_Berbadan_Hukum->EditCustomAttributes = "";
        if (!$this->Usaha_Berbadan_Hukum->Raw) {
            $this->Usaha_Berbadan_Hukum->CurrentValue = HtmlDecode($this->Usaha_Berbadan_Hukum->CurrentValue);
        }
        $this->Usaha_Berbadan_Hukum->EditValue = $this->Usaha_Berbadan_Hukum->CurrentValue;
        $this->Usaha_Berbadan_Hukum->PlaceHolder = RemoveHtml($this->Usaha_Berbadan_Hukum->caption());

        // Punya Izin Usaha
        $this->Punya_Izin_Usaha->EditAttrs["class"] = "form-control";
        $this->Punya_Izin_Usaha->EditCustomAttributes = "";
        if (!$this->Punya_Izin_Usaha->Raw) {
            $this->Punya_Izin_Usaha->CurrentValue = HtmlDecode($this->Punya_Izin_Usaha->CurrentValue);
        }
        $this->Punya_Izin_Usaha->EditValue = $this->Punya_Izin_Usaha->CurrentValue;
        $this->Punya_Izin_Usaha->PlaceHolder = RemoveHtml($this->Punya_Izin_Usaha->caption());

        // Punya Nomor Pokok Wajib Pajak (NPWP) dan Melaporkan Pajak
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->EditAttrs["class"] = "form-control";
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->EditCustomAttributes = "";
        if (!$this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->Raw) {
            $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->CurrentValue = HtmlDecode($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->CurrentValue);
        }
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->EditValue = $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->CurrentValue;
        $this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->PlaceHolder = RemoveHtml($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak->caption());

        // Punya Struktur Organisasi Usaha
        $this->Punya_Struktur_Organisasi_Usaha->EditAttrs["class"] = "form-control";
        $this->Punya_Struktur_Organisasi_Usaha->EditCustomAttributes = "";
        if (!$this->Punya_Struktur_Organisasi_Usaha->Raw) {
            $this->Punya_Struktur_Organisasi_Usaha->CurrentValue = HtmlDecode($this->Punya_Struktur_Organisasi_Usaha->CurrentValue);
        }
        $this->Punya_Struktur_Organisasi_Usaha->EditValue = $this->Punya_Struktur_Organisasi_Usaha->CurrentValue;
        $this->Punya_Struktur_Organisasi_Usaha->PlaceHolder = RemoveHtml($this->Punya_Struktur_Organisasi_Usaha->caption());

        // Melakukan Pembagian Tugas (Jobs Desk) secara Jelas pada Setiap D
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->EditAttrs["class"] = "form-control";
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->EditCustomAttributes = "";
        if (!$this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->Raw) {
            $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->CurrentValue = HtmlDecode($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->CurrentValue);
        }
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->EditValue = $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->CurrentValue;
        $this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->PlaceHolder = RemoveHtml($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D->caption());

        // Punya Sertifikat Managemen Mutu ISO
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->EditAttrs["class"] = "form-control";
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->EditCustomAttributes = "";
        if (!$this->Punya_Sertifikat_Managemen_Mutu_ISO->Raw) {
            $this->Punya_Sertifikat_Managemen_Mutu_ISO->CurrentValue = HtmlDecode($this->Punya_Sertifikat_Managemen_Mutu_ISO->CurrentValue);
        }
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->EditValue = $this->Punya_Sertifikat_Managemen_Mutu_ISO->CurrentValue;
        $this->Punya_Sertifikat_Managemen_Mutu_ISO->PlaceHolder = RemoveHtml($this->Punya_Sertifikat_Managemen_Mutu_ISO->caption());

        // Hasil Usaha Menjadi Sumber Pendapatan Utama dalam Memenuhi Kebut
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->EditAttrs["class"] = "form-control";
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->EditCustomAttributes = "";
        if (!$this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->Raw) {
            $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->CurrentValue = HtmlDecode($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->CurrentValue);
        }
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->EditValue = $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->CurrentValue;
        $this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->PlaceHolder = RemoveHtml($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut->caption());

        // Pengelolaan Keuangan Usaha Terpisah dengan Keuangan Pribadi
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->EditAttrs["class"] = "form-control";
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->EditCustomAttributes = "";
        if (!$this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->Raw) {
            $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->CurrentValue = HtmlDecode($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->CurrentValue);
        }
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->EditValue = $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->CurrentValue;
        $this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->PlaceHolder = RemoveHtml($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi->caption());

        // Ada Bukti Transaksi Berupa Nota / Kuitansi
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->EditAttrs["class"] = "form-control";
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->EditCustomAttributes = "";
        if (!$this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->Raw) {
            $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->CurrentValue = HtmlDecode($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->CurrentValue);
        }
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->EditValue = $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->CurrentValue;
        $this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->PlaceHolder = RemoveHtml($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi->caption());

        // Punya Pencatatan Keuangan Usaha
        $this->Punya_Pencatatan_Keuangan_Usaha->EditAttrs["class"] = "form-control";
        $this->Punya_Pencatatan_Keuangan_Usaha->EditCustomAttributes = "";
        if (!$this->Punya_Pencatatan_Keuangan_Usaha->Raw) {
            $this->Punya_Pencatatan_Keuangan_Usaha->CurrentValue = HtmlDecode($this->Punya_Pencatatan_Keuangan_Usaha->CurrentValue);
        }
        $this->Punya_Pencatatan_Keuangan_Usaha->EditValue = $this->Punya_Pencatatan_Keuangan_Usaha->CurrentValue;
        $this->Punya_Pencatatan_Keuangan_Usaha->PlaceHolder = RemoveHtml($this->Punya_Pencatatan_Keuangan_Usaha->caption());

        // Bisa Menyusun/Menyajikan Laporan Keuangan (Laporan Laba Rugi, Ne
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->EditAttrs["class"] = "form-control";
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->EditCustomAttributes = "";
        if (!$this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->Raw) {
            $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->CurrentValue = HtmlDecode($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->CurrentValue);
        }
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->EditValue = $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->CurrentValue;
        $this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->PlaceHolder = RemoveHtml($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne->caption());

        // Punya Pinjaman Modal Usaha dari Perbankan
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->EditAttrs["class"] = "form-control";
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->EditCustomAttributes = "";
        if (!$this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->Raw) {
            $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->CurrentValue = HtmlDecode($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->CurrentValue);
        }
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->EditValue = $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->CurrentValue;
        $this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->PlaceHolder = RemoveHtml($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan->caption());

        // Semua Aset Usaha Tercatat dan Terdokumentasi dengan Baik
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->EditAttrs["class"] = "form-control";
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->EditCustomAttributes = "";
        if (!$this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->Raw) {
            $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->CurrentValue = HtmlDecode($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->CurrentValue);
        }
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->EditValue = $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->CurrentValue;
        $this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->PlaceHolder = RemoveHtml($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik->caption());

        // Melayani Transaksi non Tunai
        $this->Melayani_Transaksi_non_Tunai->EditAttrs["class"] = "form-control";
        $this->Melayani_Transaksi_non_Tunai->EditCustomAttributes = "";
        if (!$this->Melayani_Transaksi_non_Tunai->Raw) {
            $this->Melayani_Transaksi_non_Tunai->CurrentValue = HtmlDecode($this->Melayani_Transaksi_non_Tunai->CurrentValue);
        }
        $this->Melayani_Transaksi_non_Tunai->EditValue = $this->Melayani_Transaksi_non_Tunai->CurrentValue;
        $this->Melayani_Transaksi_non_Tunai->PlaceHolder = RemoveHtml($this->Melayani_Transaksi_non_Tunai->caption());

        // Kesuksesan Bisnis Sangat Tergantung pada Diri Saya Sendiri
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->EditAttrs["class"] = "form-control";
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->EditCustomAttributes = "";
        if (!$this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->Raw) {
            $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->CurrentValue = HtmlDecode($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->CurrentValue);
        }
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->EditValue = $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->CurrentValue;
        $this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->PlaceHolder = RemoveHtml($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri->caption());

        // Saya Rela Menunda Pelaksanaan Kegiatan Lain Demi Fokus Mengemban
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->EditAttrs["class"] = "form-control";
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->EditCustomAttributes = "";
        if (!$this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->Raw) {
            $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->CurrentValue = HtmlDecode($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->CurrentValue);
        }
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->EditValue = $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->CurrentValue;
        $this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->PlaceHolder = RemoveHtml($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban->caption());

        // Punya Target Bulanan / Tahunan
        $this->Punya_Target_Bulanan__Tahunan->EditAttrs["class"] = "form-control";
        $this->Punya_Target_Bulanan__Tahunan->EditCustomAttributes = "";
        if (!$this->Punya_Target_Bulanan__Tahunan->Raw) {
            $this->Punya_Target_Bulanan__Tahunan->CurrentValue = HtmlDecode($this->Punya_Target_Bulanan__Tahunan->CurrentValue);
        }
        $this->Punya_Target_Bulanan__Tahunan->EditValue = $this->Punya_Target_Bulanan__Tahunan->CurrentValue;
        $this->Punya_Target_Bulanan__Tahunan->PlaceHolder = RemoveHtml($this->Punya_Target_Bulanan__Tahunan->caption());

        // Punya Karyawan Tetap yang Digaji (di Luar Sub Kontrak)
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->EditAttrs["class"] = "form-control";
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->EditCustomAttributes = "";
        if (!$this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->Raw) {
            $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->CurrentValue = HtmlDecode($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->CurrentValue);
        }
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->EditValue = $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->CurrentValue;
        $this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->PlaceHolder = RemoveHtml($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak->caption());

        // Punya Tenaga Kerja Sub Kontrak
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->EditAttrs["class"] = "form-control";
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->EditCustomAttributes = "";
        if (!$this->Punya_Tenaga_Kerja_Sub_Kontrak->Raw) {
            $this->Punya_Tenaga_Kerja_Sub_Kontrak->CurrentValue = HtmlDecode($this->Punya_Tenaga_Kerja_Sub_Kontrak->CurrentValue);
        }
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->EditValue = $this->Punya_Tenaga_Kerja_Sub_Kontrak->CurrentValue;
        $this->Punya_Tenaga_Kerja_Sub_Kontrak->PlaceHolder = RemoveHtml($this->Punya_Tenaga_Kerja_Sub_Kontrak->caption());

        // Besaran Gaji Karyawan
        $this->Besaran_Gaji_Karyawan->EditAttrs["class"] = "form-control";
        $this->Besaran_Gaji_Karyawan->EditCustomAttributes = "";
        if (!$this->Besaran_Gaji_Karyawan->Raw) {
            $this->Besaran_Gaji_Karyawan->CurrentValue = HtmlDecode($this->Besaran_Gaji_Karyawan->CurrentValue);
        }
        $this->Besaran_Gaji_Karyawan->EditValue = $this->Besaran_Gaji_Karyawan->CurrentValue;
        $this->Besaran_Gaji_Karyawan->PlaceHolder = RemoveHtml($this->Besaran_Gaji_Karyawan->caption());

        // Memberikan Jaminan Ketenagakerjaan kepada Karyawan
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->EditAttrs["class"] = "form-control";
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->EditCustomAttributes = "";
        if (!$this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->Raw) {
            $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->CurrentValue = HtmlDecode($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->CurrentValue);
        }
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->EditValue = $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->CurrentValue;
        $this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->PlaceHolder = RemoveHtml($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan->caption());

        // Memberikan Tunjangan dan Bonus kepada Karyawan
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->EditAttrs["class"] = "form-control";
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->EditCustomAttributes = "";
        if (!$this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->Raw) {
            $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->CurrentValue = HtmlDecode($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->CurrentValue);
        }
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->EditValue = $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->CurrentValue;
        $this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->PlaceHolder = RemoveHtml($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan->caption());

        // Memberikan Fasilitas Pengembangan Diri bagi Karyawan seperti Men
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->EditAttrs["class"] = "form-control";
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->EditCustomAttributes = "";
        if (!$this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->Raw) {
            $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->CurrentValue = HtmlDecode($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->CurrentValue);
        }
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->EditValue = $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->CurrentValue;
        $this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->PlaceHolder = RemoveHtml($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men->caption());

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
                    $doc->exportCaption($this->Nama_Pemilik_Usaha);
                    $doc->exportCaption($this->Nomor_Induk_Kependudukan_NIK);
                    $doc->exportCaption($this->Jenis_Kelamin);
                    $doc->exportCaption($this->Nama_JalanGangRTRW);
                    $doc->exportCaption($this->Dusun);
                    $doc->exportCaption($this->DesaKelurahan);
                    $doc->exportCaption($this->Kecamatan);
                    $doc->exportCaption($this->Nomor_TeleponHP);
                    $doc->exportCaption($this->Alamat_Email);
                    $doc->exportCaption($this->Nama_Usaha);
                    $doc->exportCaption($this->Tahun_Mulai_Usaha);
                    $doc->exportCaption($this->Nama_JalanGangRTRW_1);
                    $doc->exportCaption($this->Dusun_1);
                    $doc->exportCaption($this->DesaKelurahan_1);
                    $doc->exportCaption($this->Kecamatan_1);
                    $doc->exportCaption($this->Status_Usaha);
                    $doc->exportCaption($this->No_TelpHP_Usaha_Perusahaan);
                    $doc->exportCaption($this->Alamat_Email_UsahaPerusahaan);
                    $doc->exportCaption($this->Alamat_Website_UsahaPerusahaan_Jika_Ada);
                    $doc->exportCaption($this->Afiliasi_dengan_emarketing);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->Nomor_dan_Ijin_Usaha_yang_ada);
                    $doc->exportCaption($this->Badan_Hukum_Perusahaan);
                    $doc->exportCaption($this->Jenis_UsahaSektorProduk);
                    $doc->exportCaption($this->Kegiatan_usaha_yang_dilakukan);
                    $doc->exportCaption($this->Nama_Merk_Usaha);
                    $doc->exportCaption($this->Bahan_Baku);
                    $doc->exportCaption($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku);
                    $doc->exportCaption($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah);
                    $doc->exportCaption($this->Negara_Tujuan_Ekspor);
                    $doc->exportCaption($this->Jumlah_produk_yang_dihasilkan_per_bulan);
                    $doc->exportCaption($this->Satuan_Produk);
                    $doc->exportCaption($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah);
                    $doc->exportCaption($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah);
                    $doc->exportCaption($this->Harga_aset_yang_dimiliki_dalam_rupiah);
                    $doc->exportCaption($this->Modal_kerja_per_bulan_dalam_rupiah);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja_Laki_Laki);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->Bantuan_Pemerintah);
                    $doc->exportCaption($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe);
                    $doc->exportCaption($this->Nama_Jenis_Pinjaman_jika_ada);
                    $doc->exportCaption($this->Pemberi_Pinjaman_jika_ada);
                    $doc->exportCaption($this->Jumlah_Pinjaman_dalam_rupiah);
                    $doc->exportCaption($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya);
                    $doc->exportCaption($this->Ratarata_omzet_per_tahun_dalam_rupiah);
                    $doc->exportCaption($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada);
                    $doc->exportCaption($this->Aktifitas_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Jumlah_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar);
                    $doc->exportCaption($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki);
                    $doc->exportCaption($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk);
                    $doc->exportCaption($this->Ketersediaan_Bahan_Baku);
                    $doc->exportCaption($this->Alat_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku);
                    $doc->exportCaption($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam);
                    $doc->exportCaption($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi);
                    $doc->exportCaption($this->Mengetahui_Kelebihan__Kekuatan_Produk);
                    $doc->exportCaption($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama);
                    $doc->exportCaption($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U);
                    $doc->exportCaption($this->Memiliki_Nama_Merk__Logo_Dagang);
                    $doc->exportCaption($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI);
                    $doc->exportCaption($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk);
                    $doc->exportCaption($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo);
                    $doc->exportCaption($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S);
                    $doc->exportCaption($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh);
                    $doc->exportCaption($this->Sebaran_Pemasaran_Produk);
                    $doc->exportCaption($this->Punya_Pelanggan_Tetap);
                    $doc->exportCaption($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu);
                    $doc->exportCaption($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Media_Sosial_Untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Menggunakan_Website_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl);
                    $doc->exportCaption($this->Memperbarui_Berita__Informasi__Tulisan_di_Website);
                    $doc->exportCaption($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google);
                    $doc->exportCaption($this->Menggunakan_Iklan_Berbayar_di_Online);
                    $doc->exportCaption($this->Usaha_Berbadan_Hukum);
                    $doc->exportCaption($this->Punya_Izin_Usaha);
                    $doc->exportCaption($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak);
                    $doc->exportCaption($this->Punya_Struktur_Organisasi_Usaha);
                    $doc->exportCaption($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D);
                    $doc->exportCaption($this->Punya_Sertifikat_Managemen_Mutu_ISO);
                    $doc->exportCaption($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut);
                    $doc->exportCaption($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi);
                    $doc->exportCaption($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi);
                    $doc->exportCaption($this->Punya_Pencatatan_Keuangan_Usaha);
                    $doc->exportCaption($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne);
                    $doc->exportCaption($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan);
                    $doc->exportCaption($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik);
                    $doc->exportCaption($this->Melayani_Transaksi_non_Tunai);
                    $doc->exportCaption($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri);
                    $doc->exportCaption($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban);
                    $doc->exportCaption($this->Punya_Target_Bulanan__Tahunan);
                    $doc->exportCaption($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak);
                    $doc->exportCaption($this->Punya_Tenaga_Kerja_Sub_Kontrak);
                    $doc->exportCaption($this->Besaran_Gaji_Karyawan);
                    $doc->exportCaption($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan);
                    $doc->exportCaption($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan);
                    $doc->exportCaption($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men);
                } else {
                    $doc->exportCaption($this->id);
                    $doc->exportCaption($this->Nama_Pemilik_Usaha);
                    $doc->exportCaption($this->Nomor_Induk_Kependudukan_NIK);
                    $doc->exportCaption($this->Jenis_Kelamin);
                    $doc->exportCaption($this->Nama_JalanGangRTRW);
                    $doc->exportCaption($this->Dusun);
                    $doc->exportCaption($this->DesaKelurahan);
                    $doc->exportCaption($this->Kecamatan);
                    $doc->exportCaption($this->Nomor_TeleponHP);
                    $doc->exportCaption($this->Alamat_Email);
                    $doc->exportCaption($this->Nama_Usaha);
                    $doc->exportCaption($this->Tahun_Mulai_Usaha);
                    $doc->exportCaption($this->Nama_JalanGangRTRW_1);
                    $doc->exportCaption($this->Dusun_1);
                    $doc->exportCaption($this->DesaKelurahan_1);
                    $doc->exportCaption($this->Kecamatan_1);
                    $doc->exportCaption($this->Status_Usaha);
                    $doc->exportCaption($this->No_TelpHP_Usaha_Perusahaan);
                    $doc->exportCaption($this->Alamat_Email_UsahaPerusahaan);
                    $doc->exportCaption($this->Alamat_Website_UsahaPerusahaan_Jika_Ada);
                    $doc->exportCaption($this->Afiliasi_dengan_emarketing);
                    $doc->exportCaption($this->NPWP);
                    $doc->exportCaption($this->Nomor_dan_Ijin_Usaha_yang_ada);
                    $doc->exportCaption($this->Badan_Hukum_Perusahaan);
                    $doc->exportCaption($this->Jenis_UsahaSektorProduk);
                    $doc->exportCaption($this->Kegiatan_usaha_yang_dilakukan);
                    $doc->exportCaption($this->Nama_Merk_Usaha);
                    $doc->exportCaption($this->Bahan_Baku);
                    $doc->exportCaption($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku);
                    $doc->exportCaption($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah);
                    $doc->exportCaption($this->Negara_Tujuan_Ekspor);
                    $doc->exportCaption($this->Jumlah_produk_yang_dihasilkan_per_bulan);
                    $doc->exportCaption($this->Satuan_Produk);
                    $doc->exportCaption($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah);
                    $doc->exportCaption($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah);
                    $doc->exportCaption($this->Harga_aset_yang_dimiliki_dalam_rupiah);
                    $doc->exportCaption($this->Modal_kerja_per_bulan_dalam_rupiah);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja_Laki_Laki);
                    $doc->exportCaption($this->Jumlah_Tenaga_Kerja_Perempuan);
                    $doc->exportCaption($this->Bantuan_Pemerintah);
                    $doc->exportCaption($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe);
                    $doc->exportCaption($this->Nama_Jenis_Pinjaman_jika_ada);
                    $doc->exportCaption($this->Pemberi_Pinjaman_jika_ada);
                    $doc->exportCaption($this->Jumlah_Pinjaman_dalam_rupiah);
                    $doc->exportCaption($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya);
                    $doc->exportCaption($this->Ratarata_omzet_per_tahun_dalam_rupiah);
                    $doc->exportCaption($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada);
                    $doc->exportCaption($this->Aktifitas_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Jumlah_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar);
                    $doc->exportCaption($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki);
                    $doc->exportCaption($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk);
                    $doc->exportCaption($this->Ketersediaan_Bahan_Baku);
                    $doc->exportCaption($this->Alat_Produksi_di_Usaha_Saya);
                    $doc->exportCaption($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku);
                    $doc->exportCaption($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam);
                    $doc->exportCaption($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi);
                    $doc->exportCaption($this->Mengetahui_Kelebihan__Kekuatan_Produk);
                    $doc->exportCaption($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama);
                    $doc->exportCaption($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U);
                    $doc->exportCaption($this->Memiliki_Nama_Merk__Logo_Dagang);
                    $doc->exportCaption($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI);
                    $doc->exportCaption($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk);
                    $doc->exportCaption($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo);
                    $doc->exportCaption($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S);
                    $doc->exportCaption($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh);
                    $doc->exportCaption($this->Sebaran_Pemasaran_Produk);
                    $doc->exportCaption($this->Punya_Pelanggan_Tetap);
                    $doc->exportCaption($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu);
                    $doc->exportCaption($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Media_Sosial_Untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Menggunakan_Website_untuk_Memasarkan_Produk);
                    $doc->exportCaption($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl);
                    $doc->exportCaption($this->Memperbarui_Berita__Informasi__Tulisan_di_Website);
                    $doc->exportCaption($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google);
                    $doc->exportCaption($this->Menggunakan_Iklan_Berbayar_di_Online);
                    $doc->exportCaption($this->Usaha_Berbadan_Hukum);
                    $doc->exportCaption($this->Punya_Izin_Usaha);
                    $doc->exportCaption($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak);
                    $doc->exportCaption($this->Punya_Struktur_Organisasi_Usaha);
                    $doc->exportCaption($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D);
                    $doc->exportCaption($this->Punya_Sertifikat_Managemen_Mutu_ISO);
                    $doc->exportCaption($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut);
                    $doc->exportCaption($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi);
                    $doc->exportCaption($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi);
                    $doc->exportCaption($this->Punya_Pencatatan_Keuangan_Usaha);
                    $doc->exportCaption($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne);
                    $doc->exportCaption($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan);
                    $doc->exportCaption($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik);
                    $doc->exportCaption($this->Melayani_Transaksi_non_Tunai);
                    $doc->exportCaption($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri);
                    $doc->exportCaption($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban);
                    $doc->exportCaption($this->Punya_Target_Bulanan__Tahunan);
                    $doc->exportCaption($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak);
                    $doc->exportCaption($this->Punya_Tenaga_Kerja_Sub_Kontrak);
                    $doc->exportCaption($this->Besaran_Gaji_Karyawan);
                    $doc->exportCaption($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan);
                    $doc->exportCaption($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan);
                    $doc->exportCaption($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men);
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
                        $doc->exportField($this->Nama_Pemilik_Usaha);
                        $doc->exportField($this->Nomor_Induk_Kependudukan_NIK);
                        $doc->exportField($this->Jenis_Kelamin);
                        $doc->exportField($this->Nama_JalanGangRTRW);
                        $doc->exportField($this->Dusun);
                        $doc->exportField($this->DesaKelurahan);
                        $doc->exportField($this->Kecamatan);
                        $doc->exportField($this->Nomor_TeleponHP);
                        $doc->exportField($this->Alamat_Email);
                        $doc->exportField($this->Nama_Usaha);
                        $doc->exportField($this->Tahun_Mulai_Usaha);
                        $doc->exportField($this->Nama_JalanGangRTRW_1);
                        $doc->exportField($this->Dusun_1);
                        $doc->exportField($this->DesaKelurahan_1);
                        $doc->exportField($this->Kecamatan_1);
                        $doc->exportField($this->Status_Usaha);
                        $doc->exportField($this->No_TelpHP_Usaha_Perusahaan);
                        $doc->exportField($this->Alamat_Email_UsahaPerusahaan);
                        $doc->exportField($this->Alamat_Website_UsahaPerusahaan_Jika_Ada);
                        $doc->exportField($this->Afiliasi_dengan_emarketing);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->Nomor_dan_Ijin_Usaha_yang_ada);
                        $doc->exportField($this->Badan_Hukum_Perusahaan);
                        $doc->exportField($this->Jenis_UsahaSektorProduk);
                        $doc->exportField($this->Kegiatan_usaha_yang_dilakukan);
                        $doc->exportField($this->Nama_Merk_Usaha);
                        $doc->exportField($this->Bahan_Baku);
                        $doc->exportField($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku);
                        $doc->exportField($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah);
                        $doc->exportField($this->Negara_Tujuan_Ekspor);
                        $doc->exportField($this->Jumlah_produk_yang_dihasilkan_per_bulan);
                        $doc->exportField($this->Satuan_Produk);
                        $doc->exportField($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah);
                        $doc->exportField($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah);
                        $doc->exportField($this->Harga_aset_yang_dimiliki_dalam_rupiah);
                        $doc->exportField($this->Modal_kerja_per_bulan_dalam_rupiah);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja_Laki_Laki);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->Bantuan_Pemerintah);
                        $doc->exportField($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe);
                        $doc->exportField($this->Nama_Jenis_Pinjaman_jika_ada);
                        $doc->exportField($this->Pemberi_Pinjaman_jika_ada);
                        $doc->exportField($this->Jumlah_Pinjaman_dalam_rupiah);
                        $doc->exportField($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya);
                        $doc->exportField($this->Ratarata_omzet_per_tahun_dalam_rupiah);
                        $doc->exportField($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada);
                        $doc->exportField($this->Aktifitas_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Jumlah_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar);
                        $doc->exportField($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki);
                        $doc->exportField($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk);
                        $doc->exportField($this->Ketersediaan_Bahan_Baku);
                        $doc->exportField($this->Alat_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku);
                        $doc->exportField($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam);
                        $doc->exportField($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi);
                        $doc->exportField($this->Mengetahui_Kelebihan__Kekuatan_Produk);
                        $doc->exportField($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama);
                        $doc->exportField($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U);
                        $doc->exportField($this->Memiliki_Nama_Merk__Logo_Dagang);
                        $doc->exportField($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI);
                        $doc->exportField($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk);
                        $doc->exportField($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo);
                        $doc->exportField($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S);
                        $doc->exportField($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh);
                        $doc->exportField($this->Sebaran_Pemasaran_Produk);
                        $doc->exportField($this->Punya_Pelanggan_Tetap);
                        $doc->exportField($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu);
                        $doc->exportField($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Media_Sosial_Untuk_Memasarkan_Produk);
                        $doc->exportField($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Menggunakan_Website_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl);
                        $doc->exportField($this->Memperbarui_Berita__Informasi__Tulisan_di_Website);
                        $doc->exportField($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google);
                        $doc->exportField($this->Menggunakan_Iklan_Berbayar_di_Online);
                        $doc->exportField($this->Usaha_Berbadan_Hukum);
                        $doc->exportField($this->Punya_Izin_Usaha);
                        $doc->exportField($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak);
                        $doc->exportField($this->Punya_Struktur_Organisasi_Usaha);
                        $doc->exportField($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D);
                        $doc->exportField($this->Punya_Sertifikat_Managemen_Mutu_ISO);
                        $doc->exportField($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut);
                        $doc->exportField($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi);
                        $doc->exportField($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi);
                        $doc->exportField($this->Punya_Pencatatan_Keuangan_Usaha);
                        $doc->exportField($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne);
                        $doc->exportField($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan);
                        $doc->exportField($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik);
                        $doc->exportField($this->Melayani_Transaksi_non_Tunai);
                        $doc->exportField($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri);
                        $doc->exportField($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban);
                        $doc->exportField($this->Punya_Target_Bulanan__Tahunan);
                        $doc->exportField($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak);
                        $doc->exportField($this->Punya_Tenaga_Kerja_Sub_Kontrak);
                        $doc->exportField($this->Besaran_Gaji_Karyawan);
                        $doc->exportField($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan);
                        $doc->exportField($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan);
                        $doc->exportField($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men);
                    } else {
                        $doc->exportField($this->id);
                        $doc->exportField($this->Nama_Pemilik_Usaha);
                        $doc->exportField($this->Nomor_Induk_Kependudukan_NIK);
                        $doc->exportField($this->Jenis_Kelamin);
                        $doc->exportField($this->Nama_JalanGangRTRW);
                        $doc->exportField($this->Dusun);
                        $doc->exportField($this->DesaKelurahan);
                        $doc->exportField($this->Kecamatan);
                        $doc->exportField($this->Nomor_TeleponHP);
                        $doc->exportField($this->Alamat_Email);
                        $doc->exportField($this->Nama_Usaha);
                        $doc->exportField($this->Tahun_Mulai_Usaha);
                        $doc->exportField($this->Nama_JalanGangRTRW_1);
                        $doc->exportField($this->Dusun_1);
                        $doc->exportField($this->DesaKelurahan_1);
                        $doc->exportField($this->Kecamatan_1);
                        $doc->exportField($this->Status_Usaha);
                        $doc->exportField($this->No_TelpHP_Usaha_Perusahaan);
                        $doc->exportField($this->Alamat_Email_UsahaPerusahaan);
                        $doc->exportField($this->Alamat_Website_UsahaPerusahaan_Jika_Ada);
                        $doc->exportField($this->Afiliasi_dengan_emarketing);
                        $doc->exportField($this->NPWP);
                        $doc->exportField($this->Nomor_dan_Ijin_Usaha_yang_ada);
                        $doc->exportField($this->Badan_Hukum_Perusahaan);
                        $doc->exportField($this->Jenis_UsahaSektorProduk);
                        $doc->exportField($this->Kegiatan_usaha_yang_dilakukan);
                        $doc->exportField($this->Nama_Merk_Usaha);
                        $doc->exportField($this->Bahan_Baku);
                        $doc->exportField($this->Sumber_Bahan_BakuDaerah_Asal_Bahan_Baku);
                        $doc->exportField($this->Nilai_Penjualan_Produk_Omzet_per_Bulan_dalam_rupiah);
                        $doc->exportField($this->Negara_Tujuan_Ekspor);
                        $doc->exportField($this->Jumlah_produk_yang_dihasilkan_per_bulan);
                        $doc->exportField($this->Satuan_Produk);
                        $doc->exportField($this->Harga_tanah_dan_bangunan_usaha_milik_pribadi_dalam_rupiah);
                        $doc->exportField($this->Harga_sewa_tanah_dan_bangunan_usaha_dalam_rupiah);
                        $doc->exportField($this->Harga_aset_yang_dimiliki_dalam_rupiah);
                        $doc->exportField($this->Modal_kerja_per_bulan_dalam_rupiah);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja_Laki_Laki);
                        $doc->exportField($this->Jumlah_Tenaga_Kerja_Perempuan);
                        $doc->exportField($this->Bantuan_Pemerintah);
                        $doc->exportField($this->Jika_menerima_bantuan_pemerintah_sebutkan_lembagaorganisasi_pe);
                        $doc->exportField($this->Nama_Jenis_Pinjaman_jika_ada);
                        $doc->exportField($this->Pemberi_Pinjaman_jika_ada);
                        $doc->exportField($this->Jumlah_Pinjaman_dalam_rupiah);
                        $doc->exportField($this->Kepesertaan_Program_Keluarga_Harapan_PKH_dan_sejenisnya);
                        $doc->exportField($this->Ratarata_omzet_per_tahun_dalam_rupiah);
                        $doc->exportField($this->Struktur_Organisasi_Perangkat_Daerah_SOPD_Pembina_jika_ada);
                        $doc->exportField($this->Aktifitas_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Jumlah_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Khusus_Usaha_Olahan_Makanan_dan_Minuman_Produk_Memiliki_Standar);
                        $doc->exportField($this->Khusus_Usaha_Kerajinan_dan_Fesyen_Produk_Menerapkan__Memiliki);
                        $doc->exportField($this->Kemasan_yang_Digunakan_Memenuhi_Standar_untuk_Keamanan_Produk);
                        $doc->exportField($this->Ketersediaan_Bahan_Baku);
                        $doc->exportField($this->Alat_Produksi_di_Usaha_Saya);
                        $doc->exportField($this->Gudang_Penyimpanan_Bahan_Baku__Produk_Usaha_Saya_Bahan_Baku);
                        $doc->exportField($this->Layout_Produksi_Sesuai_dengan_Alur_Proses_Produksi_dari_Awal_Sam);
                        $doc->exportField($this->Menerapkan_Standar_Operational_Prosedur_SOP_Produksi);
                        $doc->exportField($this->Mengetahui_Kelebihan__Kekuatan_Produk);
                        $doc->exportField($this->Mengetahui_Target_Pasar_Utama_Calon_Pembeli_Utama);
                        $doc->exportField($this->Produk_Mudah_Didapatkan_oleh_Target_Pasar_Utama_Calon_Pembeli_U);
                        $doc->exportField($this->Memiliki_Nama_Merk__Logo_Dagang);
                        $doc->exportField($this->Merek__Logo_Dagang_Sudah_Terdaftar_di_Dirjen_HKI_Kemenkumham_RI);
                        $doc->exportField($this->Punya_Konsep_Branding_Narasi__Cerita__Nilai_Terkait_Produk);
                        $doc->exportField($this->Punya_lisensi_Co_Branding_Jogjamark_Jogjamark__100_Jogja__Jo);
                        $doc->exportField($this->Punya_Media_Pemasaran_Offline_Papan_Nama_Brosur_Kartu_Nama_S);
                        $doc->exportField($this->Punya_Mitra_Kerjasama_Pemasaran_Produk_seperti_Reseller__Dropsh);
                        $doc->exportField($this->Sebaran_Pemasaran_Produk);
                        $doc->exportField($this->Punya_Pelanggan_Tetap);
                        $doc->exportField($this->Mengikuti_Pameran_Produk_secara_Mandiri_Mengeluarkan_Biaya_untu);
                        $doc->exportField($this->Media_Chatting_yang_Digunakan_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Media_Sosial_Untuk_Memasarkan_Produk);
                        $doc->exportField($this->Marketplace_yang_Digunakan_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Menggunakan_Google_Bisnisku_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Menggunakan_Website_untuk_Memasarkan_Produk);
                        $doc->exportField($this->Memperbarui_Informasi_Produk__Bisnis_di_Media_Sosial__Marketpl);
                        $doc->exportField($this->Memperbarui_Berita__Informasi__Tulisan_di_Website);
                        $doc->exportField($this->Informasi_Bisnis_Mudah_Ditemukan_di_Halaman_Pencarian_Google);
                        $doc->exportField($this->Menggunakan_Iklan_Berbayar_di_Online);
                        $doc->exportField($this->Usaha_Berbadan_Hukum);
                        $doc->exportField($this->Punya_Izin_Usaha);
                        $doc->exportField($this->Punya_Nomor_Pokok_Wajib_Pajak_NPWP_dan_Melaporkan_Pajak);
                        $doc->exportField($this->Punya_Struktur_Organisasi_Usaha);
                        $doc->exportField($this->Melakukan_Pembagian_Tugas_Jobs_Desk_secara_Jelas_pada_Setiap_D);
                        $doc->exportField($this->Punya_Sertifikat_Managemen_Mutu_ISO);
                        $doc->exportField($this->Hasil_Usaha_Menjadi_Sumber_Pendapatan_Utama_dalam_Memenuhi_Kebut);
                        $doc->exportField($this->Pengelolaan_Keuangan_Usaha_Terpisah_dengan_Keuangan_Pribadi);
                        $doc->exportField($this->Ada_Bukti_Transaksi_Berupa_Nota__Kuitansi);
                        $doc->exportField($this->Punya_Pencatatan_Keuangan_Usaha);
                        $doc->exportField($this->Bisa_MenyusunMenyajikan_Laporan_Keuangan_Laporan_Laba_Rugi_Ne);
                        $doc->exportField($this->Punya_Pinjaman_Modal_Usaha_dari_Perbankan);
                        $doc->exportField($this->Semua_Aset_Usaha_Tercatat_dan_Terdokumentasi_dengan_Baik);
                        $doc->exportField($this->Melayani_Transaksi_non_Tunai);
                        $doc->exportField($this->Kesuksesan_Bisnis_Sangat_Tergantung_pada_Diri_Saya_Sendiri);
                        $doc->exportField($this->Saya_Rela_Menunda_Pelaksanaan_Kegiatan_Lain_Demi_Fokus_Mengemban);
                        $doc->exportField($this->Punya_Target_Bulanan__Tahunan);
                        $doc->exportField($this->Punya_Karyawan_Tetap_yang_Digaji_di_Luar_Sub_Kontrak);
                        $doc->exportField($this->Punya_Tenaga_Kerja_Sub_Kontrak);
                        $doc->exportField($this->Besaran_Gaji_Karyawan);
                        $doc->exportField($this->Memberikan_Jaminan_Ketenagakerjaan_kepada_Karyawan);
                        $doc->exportField($this->Memberikan_Tunjangan_dan_Bonus_kepada_Karyawan);
                        $doc->exportField($this->Memberikan_Fasilitas_Pengembangan_Diri_bagi_Karyawan_seperti_Men);
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
