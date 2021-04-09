<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasaranview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_pemasaranview = currentForm = new ew.Form("ftemp_skor_pemasaranview", "view");
    loadjs.done("ftemp_skor_pemasaranview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_pemasaran) ew.vars.tables.temp_skor_pemasaran = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaran")) ?>;
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
<form name="ftemp_skor_pemasaranview" id="ftemp_skor_pemasaranview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaran">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
    <tr id="r_skor_unggul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_unggul"><?= $Page->skor_unggul->caption() ?></span></td>
        <td data-name="skor_unggul" <?= $Page->skor_unggul->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_unggul">
<span<?= $Page->skor_unggul->viewAttributes() ?>>
<?= $Page->skor_unggul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_unggul->Visible) { // max_unggul ?>
    <tr id="r_max_unggul">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_unggul"><?= $Page->max_unggul->caption() ?></span></td>
        <td data-name="max_unggul" <?= $Page->max_unggul->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_unggul">
<span<?= $Page->max_unggul->viewAttributes() ?>>
<?= $Page->max_unggul->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
    <tr id="r_skor_target">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_target"><?= $Page->skor_target->caption() ?></span></td>
        <td data-name="skor_target" <?= $Page->skor_target->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
    <tr id="r_max_target">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_target"><?= $Page->max_target->caption() ?></span></td>
        <td data-name="max_target" <?= $Page->max_target->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_available->Visible) { // skor_available ?>
    <tr id="r_skor_available">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_available"><?= $Page->skor_available->caption() ?></span></td>
        <td data-name="skor_available" <?= $Page->skor_available->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_available">
<span<?= $Page->skor_available->viewAttributes() ?>>
<?= $Page->skor_available->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_available->Visible) { // max_available ?>
    <tr id="r_max_available">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_available"><?= $Page->max_available->caption() ?></span></td>
        <td data-name="max_available" <?= $Page->max_available->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_available">
<span<?= $Page->max_available->viewAttributes() ?>>
<?= $Page->max_available->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_merk->Visible) { // skor_merk ?>
    <tr id="r_skor_merk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_merk"><?= $Page->skor_merk->caption() ?></span></td>
        <td data-name="skor_merk" <?= $Page->skor_merk->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merk">
<span<?= $Page->skor_merk->viewAttributes() ?>>
<?= $Page->skor_merk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_merk->Visible) { // max_merk ?>
    <tr id="r_max_merk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_merk"><?= $Page->max_merk->caption() ?></span></td>
        <td data-name="max_merk" <?= $Page->max_merk->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merk">
<span<?= $Page->max_merk->viewAttributes() ?>>
<?= $Page->max_merk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
    <tr id="r_skor_merkhaki">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_merkhaki"><?= $Page->skor_merkhaki->caption() ?></span></td>
        <td data-name="skor_merkhaki" <?= $Page->skor_merkhaki->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merkhaki">
<span<?= $Page->skor_merkhaki->viewAttributes() ?>>
<?= $Page->skor_merkhaki->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
    <tr id="r_max_merkhaki">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_merkhaki"><?= $Page->max_merkhaki->caption() ?></span></td>
        <td data-name="max_merkhaki" <?= $Page->max_merkhaki->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merkhaki">
<span<?= $Page->max_merkhaki->viewAttributes() ?>>
<?= $Page->max_merkhaki->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
    <tr id="r_skor_merkkonsep">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_merkkonsep"><?= $Page->skor_merkkonsep->caption() ?></span></td>
        <td data-name="skor_merkkonsep" <?= $Page->skor_merkkonsep->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merkkonsep">
<span<?= $Page->skor_merkkonsep->viewAttributes() ?>>
<?= $Page->skor_merkkonsep->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
    <tr id="r_max_merkkonsep">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_merkkonsep"><?= $Page->max_merkkonsep->caption() ?></span></td>
        <td data-name="max_merkkonsep" <?= $Page->max_merkkonsep->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merkkonsep">
<span<?= $Page->max_merkkonsep->viewAttributes() ?>>
<?= $Page->max_merkkonsep->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
    <tr id="r_skor_merklisensi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_merklisensi"><?= $Page->skor_merklisensi->caption() ?></span></td>
        <td data-name="skor_merklisensi" <?= $Page->skor_merklisensi->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merklisensi">
<span<?= $Page->skor_merklisensi->viewAttributes() ?>>
<?= $Page->skor_merklisensi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
    <tr id="r_max_merklisensi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_merklisensi"><?= $Page->max_merklisensi->caption() ?></span></td>
        <td data-name="max_merklisensi" <?= $Page->max_merklisensi->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merklisensi">
<span<?= $Page->max_merklisensi->viewAttributes() ?>>
<?= $Page->max_merklisensi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
    <tr id="r_skor_mitra">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_mitra"><?= $Page->skor_mitra->caption() ?></span></td>
        <td data-name="skor_mitra" <?= $Page->skor_mitra->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_mitra">
<span<?= $Page->skor_mitra->viewAttributes() ?>>
<?= $Page->skor_mitra->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_mitra->Visible) { // max_mitra ?>
    <tr id="r_max_mitra">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_mitra"><?= $Page->max_mitra->caption() ?></span></td>
        <td data-name="max_mitra" <?= $Page->max_mitra->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_mitra">
<span<?= $Page->max_mitra->viewAttributes() ?>>
<?= $Page->max_mitra->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_market->Visible) { // skor_market ?>
    <tr id="r_skor_market">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_market"><?= $Page->skor_market->caption() ?></span></td>
        <td data-name="skor_market" <?= $Page->skor_market->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_market">
<span<?= $Page->skor_market->viewAttributes() ?>>
<?= $Page->skor_market->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_market->Visible) { // max_market ?>
    <tr id="r_max_market">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_market"><?= $Page->max_market->caption() ?></span></td>
        <td data-name="max_market" <?= $Page->max_market->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_market">
<span<?= $Page->max_market->viewAttributes() ?>>
<?= $Page->max_market->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
    <tr id="r_skor_pelangganloyal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_pelangganloyal"><?= $Page->skor_pelangganloyal->caption() ?></span></td>
        <td data-name="skor_pelangganloyal" <?= $Page->skor_pelangganloyal->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pelangganloyal">
<span<?= $Page->skor_pelangganloyal->viewAttributes() ?>>
<?= $Page->skor_pelangganloyal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
    <tr id="r_max_pelangganloyal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_pelangganloyal"><?= $Page->max_pelangganloyal->caption() ?></span></td>
        <td data-name="max_pelangganloyal" <?= $Page->max_pelangganloyal->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_pelangganloyal">
<span<?= $Page->max_pelangganloyal->viewAttributes() ?>>
<?= $Page->max_pelangganloyal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
    <tr id="r_skor_pameranmandiri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_pameranmandiri"><?= $Page->skor_pameranmandiri->caption() ?></span></td>
        <td data-name="skor_pameranmandiri" <?= $Page->skor_pameranmandiri->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pameranmandiri">
<span<?= $Page->skor_pameranmandiri->viewAttributes() ?>>
<?= $Page->skor_pameranmandiri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
    <tr id="r_max_pameranmandiri">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_pameranmandiri"><?= $Page->max_pameranmandiri->caption() ?></span></td>
        <td data-name="max_pameranmandiri" <?= $Page->max_pameranmandiri->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_pameranmandiri">
<span<?= $Page->max_pameranmandiri->viewAttributes() ?>>
<?= $Page->max_pameranmandiri->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
    <tr id="r_skor_mediaoffline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_mediaoffline"><?= $Page->skor_mediaoffline->caption() ?></span></td>
        <td data-name="skor_mediaoffline" <?= $Page->skor_mediaoffline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_mediaoffline">
<span<?= $Page->skor_mediaoffline->viewAttributes() ?>>
<?= $Page->skor_mediaoffline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
    <tr id="r_max_mediaoffline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_max_mediaoffline"><?= $Page->max_mediaoffline->caption() ?></span></td>
        <td data-name="max_mediaoffline" <?= $Page->max_mediaoffline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_mediaoffline">
<span<?= $Page->max_mediaoffline->viewAttributes() ?>>
<?= $Page->max_mediaoffline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
    <tr id="r_skor_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_skor_pemasaran"><?= $Page->skor_pemasaran->caption() ?></span></td>
        <td data-name="skor_pemasaran" <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pemasaran">
<span<?= $Page->skor_pemasaran->viewAttributes() ?>>
<?= $Page->skor_pemasaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
    <tr id="r_maxskor_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_maxskor_pemasaran"><?= $Page->maxskor_pemasaran->caption() ?></span></td>
        <td data-name="maxskor_pemasaran" <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_maxskor_pemasaran">
<span<?= $Page->maxskor_pemasaran->viewAttributes() ?>>
<?= $Page->maxskor_pemasaran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
    <tr id="r_bobot_pemasaran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaran_bobot_pemasaran"><?= $Page->bobot_pemasaran->caption() ?></span></td>
        <td data-name="bobot_pemasaran" <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_bobot_pemasaran">
<span<?= $Page->bobot_pemasaran->viewAttributes() ?>>
<?= $Page->bobot_pemasaran->getViewValue() ?></span>
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
