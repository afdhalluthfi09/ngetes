<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelasView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelasview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_kelasview = currentForm = new ew.Form("ftemp_skor_kelasview", "view");
    loadjs.done("ftemp_skor_kelasview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_kelas) ew.vars.tables.temp_skor_kelas = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelas")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="ftemp_skor_kelasview" id="ftemp_skor_kelasview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelas">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
    <tr id="r_NAMA_PEMILIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_NAMA_PEMILIK"><?= $Page->NAMA_PEMILIK->caption() ?></span></td>
        <td data-name="NAMA_PEMILIK" <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
    <tr id="r_NO_HP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_NO_HP"><?= $Page->NO_HP->caption() ?></span></td>
        <td data-name="NO_HP" <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
    <tr id="r_NAMA_USAHA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_NAMA_USAHA"><?= $Page->NAMA_USAHA->caption() ?></span></td>
        <td data-name="NAMA_USAHA" <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
    <tr id="r_KALURAHAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_KALURAHAN"><?= $Page->KALURAHAN->caption() ?></span></td>
        <td data-name="KALURAHAN" <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el_temp_skor_kelas_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
    <tr id="r_KAPANEWON">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_KAPANEWON"><?= $Page->KAPANEWON->caption() ?></span></td>
        <td data-name="KAPANEWON" <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el_temp_skor_kelas_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
    <tr id="r_skor_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_produksi"><?= $Page->skor_produksi->caption() ?></span></td>
        <td data-name="skor_produksi" <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_produksi">
<span<?= $Page->skor_produksi->viewAttributes() ?>>
<?= $Page->skor_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
    <tr id="r_maxskor_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_produksi"><?= $Page->maxskor_produksi->caption() ?></span></td>
        <td data-name="maxskor_produksi" <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_produksi">
<span<?= $Page->maxskor_produksi->viewAttributes() ?>>
<?= $Page->maxskor_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
    <tr id="r_bobot_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_produksi"><?= $Page->bobot_produksi->caption() ?></span></td>
        <td data-name="bobot_produksi" <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_produksi">
<span<?= $Page->bobot_produksi->viewAttributes() ?>>
<?= $Page->bobot_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
    <tr id="r_skor_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_pemasaran"><?= $Page->skor_pemasaran->caption() ?></span></td>
        <td data-name="skor_pemasaran" <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_pemasaran">
<span<?= $Page->skor_pemasaran->viewAttributes() ?>>
<?= $Page->skor_pemasaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
    <tr id="r_maxskor_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_pemasaran"><?= $Page->maxskor_pemasaran->caption() ?></span></td>
        <td data-name="maxskor_pemasaran" <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_pemasaran">
<span<?= $Page->maxskor_pemasaran->viewAttributes() ?>>
<?= $Page->maxskor_pemasaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
    <tr id="r_bobot_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_pemasaran"><?= $Page->bobot_pemasaran->caption() ?></span></td>
        <td data-name="bobot_pemasaran" <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_pemasaran">
<span<?= $Page->bobot_pemasaran->viewAttributes() ?>>
<?= $Page->bobot_pemasaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
    <tr id="r_skor_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_pemasaranonline"><?= $Page->skor_pemasaranonline->caption() ?></span></td>
        <td data-name="skor_pemasaranonline" <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_pemasaranonline">
<span<?= $Page->skor_pemasaranonline->viewAttributes() ?>>
<?= $Page->skor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
    <tr id="r_maxskor_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_pemasaranonline"><?= $Page->maxskor_pemasaranonline->caption() ?></span></td>
        <td data-name="maxskor_pemasaranonline" <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_pemasaranonline">
<span<?= $Page->maxskor_pemasaranonline->viewAttributes() ?>>
<?= $Page->maxskor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
    <tr id="r_bobot_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_pemasaranonline"><?= $Page->bobot_pemasaranonline->caption() ?></span></td>
        <td data-name="bobot_pemasaranonline" <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_pemasaranonline">
<span<?= $Page->bobot_pemasaranonline->viewAttributes() ?>>
<?= $Page->bobot_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
    <tr id="r_skor_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_kelembagaan"><?= $Page->skor_kelembagaan->caption() ?></span></td>
        <td data-name="skor_kelembagaan" <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_kelembagaan">
<span<?= $Page->skor_kelembagaan->viewAttributes() ?>>
<?= $Page->skor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
    <tr id="r_maxskor_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_kelembagaan"><?= $Page->maxskor_kelembagaan->caption() ?></span></td>
        <td data-name="maxskor_kelembagaan" <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_kelembagaan">
<span<?= $Page->maxskor_kelembagaan->viewAttributes() ?>>
<?= $Page->maxskor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
    <tr id="r_bobot_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_kelembagaan"><?= $Page->bobot_kelembagaan->caption() ?></span></td>
        <td data-name="bobot_kelembagaan" <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_kelembagaan">
<span<?= $Page->bobot_kelembagaan->viewAttributes() ?>>
<?= $Page->bobot_kelembagaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
    <tr id="r_skor_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_keuangan"><?= $Page->skor_keuangan->caption() ?></span></td>
        <td data-name="skor_keuangan" <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_keuangan">
<span<?= $Page->skor_keuangan->viewAttributes() ?>>
<?= $Page->skor_keuangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
    <tr id="r_maxskor_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_keuangan"><?= $Page->maxskor_keuangan->caption() ?></span></td>
        <td data-name="maxskor_keuangan" <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_keuangan">
<span<?= $Page->maxskor_keuangan->viewAttributes() ?>>
<?= $Page->maxskor_keuangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
    <tr id="r_bobot_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_keuangan"><?= $Page->bobot_keuangan->caption() ?></span></td>
        <td data-name="bobot_keuangan" <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_keuangan">
<span<?= $Page->bobot_keuangan->viewAttributes() ?>>
<?= $Page->bobot_keuangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
    <tr id="r_skor_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_sdm"><?= $Page->skor_sdm->caption() ?></span></td>
        <td data-name="skor_sdm" <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
    <tr id="r_maxskor_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_sdm"><?= $Page->maxskor_sdm->caption() ?></span></td>
        <td data-name="maxskor_sdm" <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
    <tr id="r_bobot_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_bobot_sdm"><?= $Page->bobot_sdm->caption() ?></span></td>
        <td data-name="bobot_sdm" <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
    <tr id="r_skor_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_skor_kelas"><?= $Page->skor_kelas->caption() ?></span></td>
        <td data-name="skor_kelas" <?= $Page->skor_kelas->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_kelas">
<span<?= $Page->skor_kelas->viewAttributes() ?>>
<?= $Page->skor_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
    <tr id="r_maxskor_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_maxskor_kelas"><?= $Page->maxskor_kelas->caption() ?></span></td>
        <td data-name="maxskor_kelas" <?= $Page->maxskor_kelas->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_kelas">
<span<?= $Page->maxskor_kelas->viewAttributes() ?>>
<?= $Page->maxskor_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
    <tr id="r_kelas_umkm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelas_kelas_umkm"><?= $Page->kelas_umkm->caption() ?></span></td>
        <td data-name="kelas_umkm" <?= $Page->kelas_umkm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_kelas_umkm">
<span<?= $Page->kelas_umkm->viewAttributes() ?>>
<?= $Page->kelas_umkm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
