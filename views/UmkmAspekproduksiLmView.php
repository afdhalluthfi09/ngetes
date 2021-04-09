<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksi_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspekproduksi_lmview = currentForm = new ew.Form("fumkm_aspekproduksi_lmview", "view");
    loadjs.done("fumkm_aspekproduksi_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspekproduksi_lm) ew.vars.tables.umkm_aspekproduksi_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspekproduksi_lm")) ?>;
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
<form name="fumkm_aspekproduksi_lmview" id="fumkm_aspekproduksi_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
    <tr id="r_PROD_FREKUENSIPRODUKSI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI"><?= $Page->PROD_FREKUENSIPRODUKSI->caption() ?></span></td>
        <td data-name="PROD_FREKUENSIPRODUKSI" <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI">
<span<?= $Page->PROD_FREKUENSIPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_FREKUENSIPRODUKSI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
    <tr id="r_PROD_KAPASITAS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_KAPASITAS"><?= $Page->PROD_KAPASITAS->caption() ?></span></td>
        <td data-name="PROD_KAPASITAS" <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KAPASITAS">
<span<?= $Page->PROD_KAPASITAS->viewAttributes() ?>>
<?= $Page->PROD_KAPASITAS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
    <tr id="r_PROD_KEAMANANPANGAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN"><?= $Page->PROD_KEAMANANPANGAN->caption() ?></span></td>
        <td data-name="PROD_KEAMANANPANGAN" <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN">
<span<?= $Page->PROD_KEAMANANPANGAN->viewAttributes() ?>>
<?= $Page->PROD_KEAMANANPANGAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
    <tr id="r_PROD_SNI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_SNI"><?= $Page->PROD_SNI->caption() ?></span></td>
        <td data-name="PROD_SNI" <?= $Page->PROD_SNI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_SNI">
<span<?= $Page->PROD_SNI->viewAttributes() ?>>
<?= $Page->PROD_SNI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
    <tr id="r_PROD_KEMASAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_KEMASAN"><?= $Page->PROD_KEMASAN->caption() ?></span></td>
        <td data-name="PROD_KEMASAN" <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KEMASAN">
<span<?= $Page->PROD_KEMASAN->viewAttributes() ?>>
<?= $Page->PROD_KEMASAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
    <tr id="r_PROD_KETERSEDIAANBAHANBAKU">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->caption() ?></span></td>
        <td data-name="PROD_KETERSEDIAANBAHANBAKU" <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU">
<span<?= $Page->PROD_KETERSEDIAANBAHANBAKU->viewAttributes() ?>>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
    <tr id="r_PROD_ALATPRODUKSI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI"><?= $Page->PROD_ALATPRODUKSI->caption() ?></span></td>
        <td data-name="PROD_ALATPRODUKSI" <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI">
<span<?= $Page->PROD_ALATPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_ALATPRODUKSI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
    <tr id="r_PROD_GUDANGPENYIMPAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN"><?= $Page->PROD_GUDANGPENYIMPAN->caption() ?></span></td>
        <td data-name="PROD_GUDANGPENYIMPAN" <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN">
<span<?= $Page->PROD_GUDANGPENYIMPAN->viewAttributes() ?>>
<?= $Page->PROD_GUDANGPENYIMPAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
    <tr id="r_PROD_LAYOUTPRODUKSI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI"><?= $Page->PROD_LAYOUTPRODUKSI->caption() ?></span></td>
        <td data-name="PROD_LAYOUTPRODUKSI" <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI">
<span<?= $Page->PROD_LAYOUTPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_LAYOUTPRODUKSI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
    <tr id="r_PROD_SOP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekproduksi_lm_PROD_SOP"><?= $Page->PROD_SOP->caption() ?></span></td>
        <td data-name="PROD_SOP" <?= $Page->PROD_SOP->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_SOP">
<span<?= $Page->PROD_SOP->viewAttributes() ?>>
<?= $Page->PROD_SOP->getViewValue() ?></span>
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
