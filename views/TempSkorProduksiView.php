<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorProduksiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_produksiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_produksiview = currentForm = new ew.Form("ftemp_skor_produksiview", "view");
    loadjs.done("ftemp_skor_produksiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_produksi) ew.vars.tables.temp_skor_produksi = <?= JsonEncode(GetClientVar("tables", "temp_skor_produksi")) ?>;
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
<form name="ftemp_skor_produksiview" id="ftemp_skor_produksiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_produksi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_produksi_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
    <tr id="r_skor_aktifitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_aktifitas"><?= $Page->skor_aktifitas->caption() ?></span></td>
        <td data-name="skor_aktifitas" <?= $Page->skor_aktifitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_aktifitas">
<span<?= $Page->skor_aktifitas->viewAttributes() ?>>
<?= $Page->skor_aktifitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
    <tr id="r_max_aktifitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_aktifitas"><?= $Page->max_aktifitas->caption() ?></span></td>
        <td data-name="max_aktifitas" <?= $Page->max_aktifitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_aktifitas">
<span<?= $Page->max_aktifitas->viewAttributes() ?>>
<?= $Page->max_aktifitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
    <tr id="r_skor_kapasitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_kapasitas"><?= $Page->skor_kapasitas->caption() ?></span></td>
        <td data-name="skor_kapasitas" <?= $Page->skor_kapasitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_kapasitas">
<span<?= $Page->skor_kapasitas->viewAttributes() ?>>
<?= $Page->skor_kapasitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
    <tr id="r_max_kapasitas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_kapasitas"><?= $Page->max_kapasitas->caption() ?></span></td>
        <td data-name="max_kapasitas" <?= $Page->max_kapasitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_kapasitas">
<span<?= $Page->max_kapasitas->viewAttributes() ?>>
<?= $Page->max_kapasitas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
    <tr id="r_skor_pangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_pangan"><?= $Page->skor_pangan->caption() ?></span></td>
        <td data-name="skor_pangan" <?= $Page->skor_pangan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_pangan">
<span<?= $Page->skor_pangan->viewAttributes() ?>>
<?= $Page->skor_pangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_pangan->Visible) { // max_pangan ?>
    <tr id="r_max_pangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_pangan"><?= $Page->max_pangan->caption() ?></span></td>
        <td data-name="max_pangan" <?= $Page->max_pangan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_pangan">
<span<?= $Page->max_pangan->viewAttributes() ?>>
<?= $Page->max_pangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_sni->Visible) { // skor_sni ?>
    <tr id="r_skor_sni">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_sni"><?= $Page->skor_sni->caption() ?></span></td>
        <td data-name="skor_sni" <?= $Page->skor_sni->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_sni">
<span<?= $Page->skor_sni->viewAttributes() ?>>
<?= $Page->skor_sni->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_sni->Visible) { // max_sni ?>
    <tr id="r_max_sni">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_sni"><?= $Page->max_sni->caption() ?></span></td>
        <td data-name="max_sni" <?= $Page->max_sni->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_sni">
<span<?= $Page->max_sni->viewAttributes() ?>>
<?= $Page->max_sni->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
    <tr id="r_skor_kemasan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_kemasan"><?= $Page->skor_kemasan->caption() ?></span></td>
        <td data-name="skor_kemasan" <?= $Page->skor_kemasan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_kemasan">
<span<?= $Page->skor_kemasan->viewAttributes() ?>>
<?= $Page->skor_kemasan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
    <tr id="r_max_kemasan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_kemasan"><?= $Page->max_kemasan->caption() ?></span></td>
        <td data-name="max_kemasan" <?= $Page->max_kemasan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_kemasan">
<span<?= $Page->max_kemasan->viewAttributes() ?>>
<?= $Page->max_kemasan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
    <tr id="r_skor_bahanbaku">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_bahanbaku"><?= $Page->skor_bahanbaku->caption() ?></span></td>
        <td data-name="skor_bahanbaku" <?= $Page->skor_bahanbaku->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_bahanbaku">
<span<?= $Page->skor_bahanbaku->viewAttributes() ?>>
<?= $Page->skor_bahanbaku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
    <tr id="r_max_bahanbaku">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_bahanbaku"><?= $Page->max_bahanbaku->caption() ?></span></td>
        <td data-name="max_bahanbaku" <?= $Page->max_bahanbaku->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_bahanbaku">
<span<?= $Page->max_bahanbaku->viewAttributes() ?>>
<?= $Page->max_bahanbaku->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_alat->Visible) { // skor_alat ?>
    <tr id="r_skor_alat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_alat"><?= $Page->skor_alat->caption() ?></span></td>
        <td data-name="skor_alat" <?= $Page->skor_alat->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_alat">
<span<?= $Page->skor_alat->viewAttributes() ?>>
<?= $Page->skor_alat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_alat->Visible) { // max_alat ?>
    <tr id="r_max_alat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_alat"><?= $Page->max_alat->caption() ?></span></td>
        <td data-name="max_alat" <?= $Page->max_alat->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_alat">
<span<?= $Page->max_alat->viewAttributes() ?>>
<?= $Page->max_alat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
    <tr id="r_skor_gudang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_gudang"><?= $Page->skor_gudang->caption() ?></span></td>
        <td data-name="skor_gudang" <?= $Page->skor_gudang->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_gudang">
<span<?= $Page->skor_gudang->viewAttributes() ?>>
<?= $Page->skor_gudang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_gudang->Visible) { // max_gudang ?>
    <tr id="r_max_gudang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_gudang"><?= $Page->max_gudang->caption() ?></span></td>
        <td data-name="max_gudang" <?= $Page->max_gudang->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_gudang">
<span<?= $Page->max_gudang->viewAttributes() ?>>
<?= $Page->max_gudang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_layout->Visible) { // skor_layout ?>
    <tr id="r_skor_layout">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_layout"><?= $Page->skor_layout->caption() ?></span></td>
        <td data-name="skor_layout" <?= $Page->skor_layout->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_layout">
<span<?= $Page->skor_layout->viewAttributes() ?>>
<?= $Page->skor_layout->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_layout->Visible) { // max_layout ?>
    <tr id="r_max_layout">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_layout"><?= $Page->max_layout->caption() ?></span></td>
        <td data-name="max_layout" <?= $Page->max_layout->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_layout">
<span<?= $Page->max_layout->viewAttributes() ?>>
<?= $Page->max_layout->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_sop->Visible) { // skor_sop ?>
    <tr id="r_skor_sop">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_sop"><?= $Page->skor_sop->caption() ?></span></td>
        <td data-name="skor_sop" <?= $Page->skor_sop->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_sop">
<span<?= $Page->skor_sop->viewAttributes() ?>>
<?= $Page->skor_sop->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_sop->Visible) { // max_sop ?>
    <tr id="r_max_sop">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_max_sop"><?= $Page->max_sop->caption() ?></span></td>
        <td data-name="max_sop" <?= $Page->max_sop->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_sop">
<span<?= $Page->max_sop->viewAttributes() ?>>
<?= $Page->max_sop->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
    <tr id="r_skor_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_skor_produksi"><?= $Page->skor_produksi->caption() ?></span></td>
        <td data-name="skor_produksi" <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_produksi">
<span<?= $Page->skor_produksi->viewAttributes() ?>>
<?= $Page->skor_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
    <tr id="r_maxskor_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_maxskor_produksi"><?= $Page->maxskor_produksi->caption() ?></span></td>
        <td data-name="maxskor_produksi" <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_maxskor_produksi">
<span<?= $Page->maxskor_produksi->viewAttributes() ?>>
<?= $Page->maxskor_produksi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
    <tr id="r_bobot_produksi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_produksi_bobot_produksi"><?= $Page->bobot_produksi->caption() ?></span></td>
        <td data-name="bobot_produksi" <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_bobot_produksi">
<span<?= $Page->bobot_produksi->viewAttributes() ?>>
<?= $Page->bobot_produksi->getViewValue() ?></span>
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
