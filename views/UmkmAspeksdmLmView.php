<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdm_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspeksdm_lmview = currentForm = new ew.Form("fumkm_aspeksdm_lmview", "view");
    loadjs.done("fumkm_aspeksdm_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspeksdm_lm) ew.vars.tables.umkm_aspeksdm_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspeksdm_lm")) ?>;
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
<form name="fumkm_aspeksdm_lmview" id="fumkm_aspeksdm_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
    <tr id="r_SDM_OMS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_OMS"><?= $Page->SDM_OMS->caption() ?></span></td>
        <td data-name="SDM_OMS" <?= $Page->SDM_OMS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_OMS">
<span<?= $Page->SDM_OMS->viewAttributes() ?>>
<?= $Page->SDM_OMS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
    <tr id="r_SDM_FOKUS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_FOKUS"><?= $Page->SDM_FOKUS->caption() ?></span></td>
        <td data-name="SDM_FOKUS" <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_FOKUS">
<span<?= $Page->SDM_FOKUS->viewAttributes() ?>>
<?= $Page->SDM_FOKUS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
    <tr id="r_SDM_TARGET">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_TARGET"><?= $Page->SDM_TARGET->caption() ?></span></td>
        <td data-name="SDM_TARGET" <?= $Page->SDM_TARGET->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_TARGET">
<span<?= $Page->SDM_TARGET->viewAttributes() ?>>
<?= $Page->SDM_TARGET->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
    <tr id="r_SDM_KARYAWANTETAP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_KARYAWANTETAP"><?= $Page->SDM_KARYAWANTETAP->caption() ?></span></td>
        <td data-name="SDM_KARYAWANTETAP" <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_KARYAWANTETAP">
<span<?= $Page->SDM_KARYAWANTETAP->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANTETAP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
    <tr id="r_SDM_KARYAWANSUBKON">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON"><?= $Page->SDM_KARYAWANSUBKON->caption() ?></span></td>
        <td data-name="SDM_KARYAWANSUBKON" <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON">
<span<?= $Page->SDM_KARYAWANSUBKON->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANSUBKON->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
    <tr id="r_SDM_GAJI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_GAJI"><?= $Page->SDM_GAJI->caption() ?></span></td>
        <td data-name="SDM_GAJI" <?= $Page->SDM_GAJI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_GAJI">
<span<?= $Page->SDM_GAJI->viewAttributes() ?>>
<?= $Page->SDM_GAJI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
    <tr id="r_SDM_ASURANSI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_ASURANSI"><?= $Page->SDM_ASURANSI->caption() ?></span></td>
        <td data-name="SDM_ASURANSI" <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_ASURANSI">
<span<?= $Page->SDM_ASURANSI->viewAttributes() ?>>
<?= $Page->SDM_ASURANSI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
    <tr id="r_SDM_TUNJANGAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_TUNJANGAN"><?= $Page->SDM_TUNJANGAN->caption() ?></span></td>
        <td data-name="SDM_TUNJANGAN" <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_TUNJANGAN">
<span<?= $Page->SDM_TUNJANGAN->viewAttributes() ?>>
<?= $Page->SDM_TUNJANGAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
    <tr id="r_SDM_PELATIHAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeksdm_lm_SDM_PELATIHAN"><?= $Page->SDM_PELATIHAN->caption() ?></span></td>
        <td data-name="SDM_PELATIHAN" <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_PELATIHAN">
<span<?= $Page->SDM_PELATIHAN->viewAttributes() ?>>
<?= $Page->SDM_PELATIHAN->getViewValue() ?></span>
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
