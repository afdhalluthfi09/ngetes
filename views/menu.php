<?php

namespace PHPMaker2021\umkm_sidakui;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
    $MenuRelativePath = "";
    $MenuLanguage = &$Language;
} else { // Compat reports
    $LANGUAGE_FOLDER = "../lang/";
    $MenuRelativePath = "../";
    $MenuLanguage = Container("language");
}

// Navbar menu
$topMenu = new Menu("navbar", true, true);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", true, false);
$sideMenu->addMenuItem(229, "mi_v_umkm_datadiri", $MenuLanguage->MenuPhrase("229", "MenuText"), $MenuRelativePath . "vumkmdatadirilist", -1, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}v_umkm_datadiri'), false, false, "fa-user-shield", "", false);
$sideMenu->addMenuItem(322, "mi_skro", $MenuLanguage->MenuPhrase("322", "MenuText"), $MenuRelativePath . "test/skro", -1, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}skro.php'), false, false, "fa-tachometer-alt", "", false);
$sideMenu->addMenuItem(54, "mi_umkm_datausaha", $MenuLanguage->MenuPhrase("54", "MenuText"), $MenuRelativePath . "umkmdatausahalist?cmd=resetall", -1, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_datausaha'), false, false, "fa-store", "", false);
$sideMenu->addMenuItem(298, "mci_DATA_KELAS_BINAAN", $MenuLanguage->MenuPhrase("298", "MenuText"), "", -1, "", IsLoggedIn(), false, true, "fa-signal", "", false);
$sideMenu->addMenuItem(20, "mi_umkm_aspekproduksi", $MenuLanguage->MenuPhrase("20", "MenuText"), $MenuRelativePath . "umkmaspekproduksilist", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspekproduksi'), false, false, "", "", false);
$sideMenu->addMenuItem(19, "mi_umkm_aspekpemasaran", $MenuLanguage->MenuPhrase("19", "MenuText"), $MenuRelativePath . "umkmaspekpemasaranlist", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspekpemasaran'), false, false, "", "", false);
$sideMenu->addMenuItem(16, "mi_umkm_aspekdigimark", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "umkmaspekdigimarklist", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspekdigimark'), false, false, "", "", false);
$sideMenu->addMenuItem(17, "mi_umkm_aspekkeuangan", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "umkmaspekkeuanganlist?cmd=resetall", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspekkeuangan'), false, false, "", "", false);
$sideMenu->addMenuItem(18, "mi_umkm_aspeklembaga", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "umkmaspeklembagalist", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspeklembaga'), false, false, "", "", false);
$sideMenu->addMenuItem(21, "mi_umkm_aspeksdm", $MenuLanguage->MenuPhrase("21", "MenuText"), $MenuRelativePath . "umkmaspeksdmlist", 298, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}umkm_aspeksdm'), false, false, "", "", false);
$sideMenu->addMenuItem(299, "mi_panduanlist", $MenuLanguage->MenuPhrase("299", "MenuText"), $MenuRelativePath . "test/panduanlist", -1, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}panduanlist.php'), false, false, "fa-book", "", false);
$sideMenu->addMenuItem(328, "mi_binapesertalengkap", $MenuLanguage->MenuPhrase("328", "MenuText"), $MenuRelativePath . "binapesertalengkaplist", -1, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}binapesertalengkap'), false, false, "fa-clipboard-list", "", false);
$sideMenu->addMenuItem(436, "mci_ETALASE_PRODUK", $MenuLanguage->MenuPhrase("436", "MenuText"), "", -1, "", true, false, true, "", "", false);
$sideMenu->addMenuItem(334, "mi_kumkm_market", $MenuLanguage->MenuPhrase("334", "MenuText"), $MenuRelativePath . "kumkmmarketlist", 436, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}kumkm_market'), false, false, "", "", false);
$sideMenu->addMenuItem(335, "mi_php_kurasi_lolos", $MenuLanguage->MenuPhrase("335", "MenuText"), $MenuRelativePath . "phpkurasiloloslist", 436, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}php_kurasi_lolos'), false, false, "", "", false);
$sideMenu->addMenuItem(336, "mi_php_kurasi_perbaikan", $MenuLanguage->MenuPhrase("336", "MenuText"), $MenuRelativePath . "phpkurasiperbaikanlist", 436, "", IsLoggedIn() || AllowListMenu('{B83CD199-CAE6-417E-A080-3F09712867FE}php_kurasi_perbaikan'), false, false, "", "", false);
echo $sideMenu->toScript();
