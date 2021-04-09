<?php

namespace PHPMaker2021\umkm_sidakui;

use Slim\Views\PhpRenderer;
use Slim\Csrf\Guard;
use Psr\Container\ContainerInterface;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use Doctrine\DBAL\Logging\LoggerChain;
use Doctrine\DBAL\Logging\DebugStack;

return [
    "cache" => function (ContainerInterface $c) {
        return new \Slim\HttpCache\CacheProvider();
    },
    "view" => function (ContainerInterface $c) {
        return new PhpRenderer("views/");
    },
    "flash" => function (ContainerInterface $c) {
        return new \Slim\Flash\Messages();
    },
    "audit" => function (ContainerInterface $c) {
        $logger = new Logger("audit"); // For audit trail
        $logger->pushHandler(new AuditTrailHandler("audit.log"));
        return $logger;
    },
    "log" => function (ContainerInterface $c) {
        global $RELATIVE_PATH;
        $logger = new Logger("log");
        $logger->pushHandler(new RotatingFileHandler($RELATIVE_PATH . "log.log"));
        return $logger;
    },
    "sqllogger" => function (ContainerInterface $c) {
        $loggers = [];
        if (Config("DEBUG")) {
            $loggers[] = $c->get("debugstack");
        }
        return (count($loggers) > 0) ? new LoggerChain($loggers) : null;
    },
    "csrf" => function (ContainerInterface $c) {
        global $ResponseFactory;
        return new Guard($ResponseFactory, Config("CSRF_PREFIX"));
    },
    "debugstack" => \DI\create(DebugStack::class),
    "debugsqllogger" => \DI\create(DebugSqlLogger::class),
    "security" => \DI\create(AdvancedSecurity::class),
    "profile" => \DI\create(UserProfile::class),
    "language" => \DI\create(Language::class),
    "timer" => \DI\create(Timer::class),
    "session" => \DI\create(HttpSession::class),

    // Tables
    "umkm_aspekdigimark" => \DI\create(UmkmAspekdigimark::class),
    "umkm_aspekkeuangan" => \DI\create(UmkmAspekkeuangan::class),
    "umkm_aspeklembaga" => \DI\create(UmkmAspeklembaga::class),
    "umkm_aspekpemasaran" => \DI\create(UmkmAspekpemasaran::class),
    "umkm_aspekproduksi" => \DI\create(UmkmAspekproduksi::class),
    "umkm_aspeksdm" => \DI\create(UmkmAspeksdm::class),
    "umkm_datadiri" => \DI\create(UmkmDatadiri::class),
    "koperasi_profil" => \DI\create(KoperasiProfil::class),
    "admin" => \DI\create(Admin::class),
    "ikm_industrikreatif" => \DI\create(IkmIndustrikreatif::class),
    "ikm_industrimikro" => \DI\create(IkmIndustrimikro::class),
    "ikm_sentra" => \DI\create(IkmSentra::class),
    "umkm_datausaha" => \DI\create(UmkmDatausaha::class),
    "umkm_variabel" => \DI\create(UmkmVariabel::class),
    "indonesia_cities" => \DI\create(IndonesiaCities::class),
    "indonesia_districts" => \DI\create(IndonesiaDistricts::class),
    "indonesia_provinces" => \DI\create(IndonesiaProvinces::class),
    "indonesia_villages" => \DI\create(IndonesiaVillages::class),
    "v_desa" => \DI\create(VDesa::class),
    "Dashboard2" => \DI\create(Dashboard2::class),
    "jumlah_koperasi_perkecamatan" => \DI\create(JumlahKoperasiPerkecamatan::class),
    "jumlah_koperasi" => \DI\create(JumlahKoperasi::class),
    "Status_Koperasi" => \DI\create(StatusKoperasi::class),
    "v_industri_kreatif" => \DI\create(VIndustriKreatif::class),
    "Industri_Kreatif" => \DI\create(IndustriKreatif::class),
    "v_sentra" => \DI\create(VSentra::class),
    "Sentra" => \DI\create(Sentra::class),
    "v_ikm_sentra_mickro" => \DI\create(VIkmSentraMickro::class),
    "Sentra_Ikm_Micro" => \DI\create(SentraIkmMicro::class),
    "v_data_usaha" => \DI\create(VDataUsaha::class),
    "Report_Data_Usaha" => \DI\create(ReportDataUsaha::class),
    "cetak_profil_umkm" => \DI\create(CetakProfilUmkm::class),
    "cetak_apek_pemasaran" => \DI\create(CetakApekPemasaran::class),
    "cetak_aspek_pemasaran_online" => \DI\create(CetakAspekPemasaranOnline::class),
    "Cetak_Aspek_Keuangan" => \DI\create(CetakAspekKeuangan::class),
    "Cetak_Aspek_Kelembagaan" => \DI\create(CetakAspekKelembagaan::class),
    "Cetak_Aspek_Sumber_Daya_Manusia" => \DI\create(CetakAspekSumberDayaManusia::class),
    "cetak_aspek_produksi" => \DI\create(CetakAspekProduksi::class),
    "umkm_data_diri2" => \DI\create(UmkmDataDiri2::class),
    "kapanewon_bantul" => \DI\create(KapanewonBantul::class),
    "report_data_usaha_bantul" => \DI\create(ReportDataUsahaBantul::class),
    "v_koperasi" => \DI\create(VKoperasi::class),
    "kumkm_literasi" => \DI\create(KumkmLiterasi::class),
    "kop_aktif_pasif" => \DI\create(KopAktifPasif::class),
    "kop_keragaan_bybentuk_ekonomi" => \DI\create(KopKeragaanBybentukEkonomi::class),
    "kop_keragaan_bybentuk_keanggotaan" => \DI\create(KopKeragaanBybentukKeanggotaan::class),
    "kop_keragaan_byjenis" => \DI\create(KopKeragaanByjenis::class),
    "kop_keragaan_bykelompok" => \DI\create(KopKeragaanBykelompok::class),
    "kop_keragaan_bywilayah" => \DI\create(KopKeragaanBywilayah::class),
    "maping_data_usaha" => \DI\create(MapingDataUsaha::class),
    "umkm_datadiri_backup" => \DI\create(UmkmDatadiriBackup::class),
    "umkm_datausaha_backup" => \DI\create(UmkmDatausahaBackup::class),
    "web_sidakui" => \DI\create(WebSidakui::class),
    "ukm_bantul_fix" => \DI\create(UkmBantulFix::class),
    "v_umkm_datadiri" => \DI\create(VUmkmDatadiri::class),
    "tidak_ada" => \DI\create(TidakAda::class),
    "zz_datadiri_digimark" => \DI\create(ZzDatadiriDigimark::class),
    "panduanlist" => \DI\create(Panduanlist::class),
    "detail" => \DI\create(Detail::class),
    "umkm_aspekdigimark_lm" => \DI\create(UmkmAspekdigimarkLm::class),
    "umkm_aspekkeuangan_lm" => \DI\create(UmkmAspekkeuanganLm::class),
    "umkm_aspeklembaga_lm" => \DI\create(UmkmAspeklembagaLm::class),
    "res_nilai_kelembagaan" => \DI\create(ResNilaiKelembagaan::class),
    "res_nilai_keuangan" => \DI\create(ResNilaiKeuangan::class),
    "res_nilai_pemasaran" => \DI\create(ResNilaiPemasaran::class),
    "res_nilai_pemasaranonline" => \DI\create(ResNilaiPemasaranonline::class),
    "res_nilai_produksi" => \DI\create(ResNilaiProduksi::class),
    "res_nilai_sdm" => \DI\create(ResNilaiSdm::class),
    "temp_skor_kelas" => \DI\create(TempSkorKelas::class),
    "temp_skor_kelembagaan" => \DI\create(TempSkorKelembagaan::class),
    "temp_skor_keuangan" => \DI\create(TempSkorKeuangan::class),
    "temp_skor_pemasaran" => \DI\create(TempSkorPemasaran::class),
    "temp_skor_pemasaranonline" => \DI\create(TempSkorPemasaranonline::class),
    "temp_skor_produksi" => \DI\create(TempSkorProduksi::class),
    "temp_skor_sdm" => \DI\create(TempSkorSdm::class),
    "temp_trans_skor" => \DI\create(TempTransSkor::class),
    "umkm_aspekpemasaran_lm" => \DI\create(UmkmAspekpemasaranLm::class),
    "umkm_aspekproduksi_lm" => \DI\create(UmkmAspekproduksiLm::class),
    "umkm_aspeksdm_lm" => \DI\create(UmkmAspeksdmLm::class),
    "v_skor_kelas" => \DI\create(VSkorKelas::class),
    "skro" => \DI\create(Skro::class),
    "bina_data" => \DI\create(BinaData::class),
    "bina_kelompok" => \DI\create(BinaKelompok::class),
    "bina_umkm_peserta" => \DI\create(BinaUmkmPeserta::class),
    "binadatalengkap" => \DI\create(Binadatalengkap::class),
    "periode_data" => \DI\create(PeriodeData::class),
    "binapesertalengkap" => \DI\create(Binapesertalengkap::class),
    "userlevelpermissions" => \DI\create(Userlevelpermissions::class),
    "userlevels" => \DI\create(Userlevels::class),
    "_cetak_profilumkmlengkap2" => \DI\create(CetakProfilumkmlengkap2::class),
    "bina_umkm_peserta_copy" => \DI\create(BinaUmkmPesertaCopy::class),
    "cetak_profilumkmlengkap" => \DI\create(CetakProfilumkmlengkap::class),
    "kumkm_market" => \DI\create(KumkmMarket::class),
    "php_kurasi_lolos" => \DI\create(PhpKurasiLolos::class),
    "php_kurasi_perbaikan" => \DI\create(PhpKurasiPerbaikan::class),
    "Produk_Lolos_Kurasi" => \DI\create(ProdukLolosKurasi::class),
    "Produk_Tidak_Lolos_Kurasi" => \DI\create(ProdukTidakLolosKurasi::class),

    // User table
    "usertable" => \DI\get("umkm_datadiri"),
];
