<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorSdmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_sdmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_sdmview = currentForm = new ew.Form("ftemp_skor_sdmview", "view");
    loadjs.done("ftemp_skor_sdmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_sdm) ew.vars.tables.temp_skor_sdm = <?= JsonEncode(GetClientVar("tables", "temp_skor_sdm")) ?>;
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
<form name="ftemp_skor_sdmview" id="ftemp_skor_sdmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_sdm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_sdm_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_oms->Visible) { // skor_oms ?>
    <tr id="r_skor_oms">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_oms"><?= $Page->skor_oms->caption() ?></span></td>
        <td data-name="skor_oms" <?= $Page->skor_oms->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_oms">
<span<?= $Page->skor_oms->viewAttributes() ?>>
<?= $Page->skor_oms->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_oms->Visible) { // max_oms ?>
    <tr id="r_max_oms">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_oms"><?= $Page->max_oms->caption() ?></span></td>
        <td data-name="max_oms" <?= $Page->max_oms->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_oms">
<span<?= $Page->max_oms->viewAttributes() ?>>
<?= $Page->max_oms->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
    <tr id="r_skor_fokus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_fokus"><?= $Page->skor_fokus->caption() ?></span></td>
        <td data-name="skor_fokus" <?= $Page->skor_fokus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_fokus">
<span<?= $Page->skor_fokus->viewAttributes() ?>>
<?= $Page->skor_fokus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_fokus->Visible) { // max_fokus ?>
    <tr id="r_max_fokus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_fokus"><?= $Page->max_fokus->caption() ?></span></td>
        <td data-name="max_fokus" <?= $Page->max_fokus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_fokus">
<span<?= $Page->max_fokus->viewAttributes() ?>>
<?= $Page->max_fokus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
    <tr id="r_skor_target">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_target"><?= $Page->skor_target->caption() ?></span></td>
        <td data-name="skor_target" <?= $Page->skor_target->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
    <tr id="r_max_target">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_target"><?= $Page->max_target->caption() ?></span></td>
        <td data-name="max_target" <?= $Page->max_target->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
    <tr id="r_skor_karyawan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_karyawan"><?= $Page->skor_karyawan->caption() ?></span></td>
        <td data-name="skor_karyawan" <?= $Page->skor_karyawan->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_karyawan">
<span<?= $Page->skor_karyawan->viewAttributes() ?>>
<?= $Page->skor_karyawan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
    <tr id="r_max_karyawan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_karyawan"><?= $Page->max_karyawan->caption() ?></span></td>
        <td data-name="max_karyawan" <?= $Page->max_karyawan->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_karyawan">
<span<?= $Page->max_karyawan->viewAttributes() ?>>
<?= $Page->max_karyawan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
    <tr id="r_skor_outsource">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_outsource"><?= $Page->skor_outsource->caption() ?></span></td>
        <td data-name="skor_outsource" <?= $Page->skor_outsource->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_outsource">
<span<?= $Page->skor_outsource->viewAttributes() ?>>
<?= $Page->skor_outsource->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_outsource->Visible) { // max_outsource ?>
    <tr id="r_max_outsource">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_outsource"><?= $Page->max_outsource->caption() ?></span></td>
        <td data-name="max_outsource" <?= $Page->max_outsource->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_outsource">
<span<?= $Page->max_outsource->viewAttributes() ?>>
<?= $Page->max_outsource->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
    <tr id="r_skor_besarangaji">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_besarangaji"><?= $Page->skor_besarangaji->caption() ?></span></td>
        <td data-name="skor_besarangaji" <?= $Page->skor_besarangaji->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_besarangaji">
<span<?= $Page->skor_besarangaji->viewAttributes() ?>>
<?= $Page->skor_besarangaji->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
    <tr id="r_max_besarangaji">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_besarangaji"><?= $Page->max_besarangaji->caption() ?></span></td>
        <td data-name="max_besarangaji" <?= $Page->max_besarangaji->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_besarangaji">
<span<?= $Page->max_besarangaji->viewAttributes() ?>>
<?= $Page->max_besarangaji->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
    <tr id="r_skor_asuransi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_asuransi"><?= $Page->skor_asuransi->caption() ?></span></td>
        <td data-name="skor_asuransi" <?= $Page->skor_asuransi->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_asuransi">
<span<?= $Page->skor_asuransi->viewAttributes() ?>>
<?= $Page->skor_asuransi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
    <tr id="r_max_asuransi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_asuransi"><?= $Page->max_asuransi->caption() ?></span></td>
        <td data-name="max_asuransi" <?= $Page->max_asuransi->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_asuransi">
<span<?= $Page->max_asuransi->viewAttributes() ?>>
<?= $Page->max_asuransi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
    <tr id="r_skor_bonus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_bonus"><?= $Page->skor_bonus->caption() ?></span></td>
        <td data-name="skor_bonus" <?= $Page->skor_bonus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_bonus">
<span<?= $Page->skor_bonus->viewAttributes() ?>>
<?= $Page->skor_bonus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_bonus->Visible) { // max_bonus ?>
    <tr id="r_max_bonus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_bonus"><?= $Page->max_bonus->caption() ?></span></td>
        <td data-name="max_bonus" <?= $Page->max_bonus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_bonus">
<span<?= $Page->max_bonus->viewAttributes() ?>>
<?= $Page->max_bonus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_training->Visible) { // skor_training ?>
    <tr id="r_skor_training">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_training"><?= $Page->skor_training->caption() ?></span></td>
        <td data-name="skor_training" <?= $Page->skor_training->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_training">
<span<?= $Page->skor_training->viewAttributes() ?>>
<?= $Page->skor_training->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_training->Visible) { // max_training ?>
    <tr id="r_max_training">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_max_training"><?= $Page->max_training->caption() ?></span></td>
        <td data-name="max_training" <?= $Page->max_training->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_training">
<span<?= $Page->max_training->viewAttributes() ?>>
<?= $Page->max_training->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
    <tr id="r_skor_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_skor_sdm"><?= $Page->skor_sdm->caption() ?></span></td>
        <td data-name="skor_sdm" <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
    <tr id="r_maxskor_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_maxskor_sdm"><?= $Page->maxskor_sdm->caption() ?></span></td>
        <td data-name="maxskor_sdm" <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
    <tr id="r_bobot_sdm">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_sdm_bobot_sdm"><?= $Page->bobot_sdm->caption() ?></span></td>
        <td data-name="bobot_sdm" <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
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
