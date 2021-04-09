<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelembagaanView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelembagaanview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_kelembagaanview = currentForm = new ew.Form("ftemp_skor_kelembagaanview", "view");
    loadjs.done("ftemp_skor_kelembagaanview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_kelembagaan) ew.vars.tables.temp_skor_kelembagaan = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelembagaan")) ?>;
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
<form name="ftemp_skor_kelembagaanview" id="ftemp_skor_kelembagaanview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelembagaan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
    <tr id="r_skor_badanhukum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_badanhukum"><?= $Page->skor_badanhukum->caption() ?></span></td>
        <td data-name="skor_badanhukum" <?= $Page->skor_badanhukum->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_badanhukum">
<span<?= $Page->skor_badanhukum->viewAttributes() ?>>
<?= $Page->skor_badanhukum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
    <tr id="r_max_badanhukum">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_badanhukum"><?= $Page->max_badanhukum->caption() ?></span></td>
        <td data-name="max_badanhukum" <?= $Page->max_badanhukum->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_badanhukum">
<span<?= $Page->max_badanhukum->viewAttributes() ?>>
<?= $Page->max_badanhukum->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_izin->Visible) { // skor_izin ?>
    <tr id="r_skor_izin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_izin"><?= $Page->skor_izin->caption() ?></span></td>
        <td data-name="skor_izin" <?= $Page->skor_izin->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_izin">
<span<?= $Page->skor_izin->viewAttributes() ?>>
<?= $Page->skor_izin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_izin->Visible) { // max_izin ?>
    <tr id="r_max_izin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_izin"><?= $Page->max_izin->caption() ?></span></td>
        <td data-name="max_izin" <?= $Page->max_izin->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_izin">
<span<?= $Page->max_izin->viewAttributes() ?>>
<?= $Page->max_izin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
    <tr id="r_skor_npwp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_npwp"><?= $Page->skor_npwp->caption() ?></span></td>
        <td data-name="skor_npwp" <?= $Page->skor_npwp->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_npwp">
<span<?= $Page->skor_npwp->viewAttributes() ?>>
<?= $Page->skor_npwp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_npwp->Visible) { // max_npwp ?>
    <tr id="r_max_npwp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_npwp"><?= $Page->max_npwp->caption() ?></span></td>
        <td data-name="max_npwp" <?= $Page->max_npwp->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_npwp">
<span<?= $Page->max_npwp->viewAttributes() ?>>
<?= $Page->max_npwp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
    <tr id="r_skor_struktur">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_struktur"><?= $Page->skor_struktur->caption() ?></span></td>
        <td data-name="skor_struktur" <?= $Page->skor_struktur->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_struktur">
<span<?= $Page->skor_struktur->viewAttributes() ?>>
<?= $Page->skor_struktur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_struktur->Visible) { // max_struktur ?>
    <tr id="r_max_struktur">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_struktur"><?= $Page->max_struktur->caption() ?></span></td>
        <td data-name="max_struktur" <?= $Page->max_struktur->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_struktur">
<span<?= $Page->max_struktur->viewAttributes() ?>>
<?= $Page->max_struktur->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
    <tr id="r_skor_jobdesk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_jobdesk"><?= $Page->skor_jobdesk->caption() ?></span></td>
        <td data-name="skor_jobdesk" <?= $Page->skor_jobdesk->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_jobdesk">
<span<?= $Page->skor_jobdesk->viewAttributes() ?>>
<?= $Page->skor_jobdesk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
    <tr id="r_max_jobdesk">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_jobdesk"><?= $Page->max_jobdesk->caption() ?></span></td>
        <td data-name="max_jobdesk" <?= $Page->max_jobdesk->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_jobdesk">
<span<?= $Page->max_jobdesk->viewAttributes() ?>>
<?= $Page->max_jobdesk->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_iso->Visible) { // skor_iso ?>
    <tr id="r_skor_iso">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_iso"><?= $Page->skor_iso->caption() ?></span></td>
        <td data-name="skor_iso" <?= $Page->skor_iso->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_iso">
<span<?= $Page->skor_iso->viewAttributes() ?>>
<?= $Page->skor_iso->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_iso->Visible) { // max_iso ?>
    <tr id="r_max_iso">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_max_iso"><?= $Page->max_iso->caption() ?></span></td>
        <td data-name="max_iso" <?= $Page->max_iso->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_iso">
<span<?= $Page->max_iso->viewAttributes() ?>>
<?= $Page->max_iso->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
    <tr id="r_skor_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_skor_kelembagaan"><?= $Page->skor_kelembagaan->caption() ?></span></td>
        <td data-name="skor_kelembagaan" <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_kelembagaan">
<span<?= $Page->skor_kelembagaan->viewAttributes() ?>>
<?= $Page->skor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
    <tr id="r_maxskor_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_maxskor_kelembagaan"><?= $Page->maxskor_kelembagaan->caption() ?></span></td>
        <td data-name="maxskor_kelembagaan" <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_maxskor_kelembagaan">
<span<?= $Page->maxskor_kelembagaan->viewAttributes() ?>>
<?= $Page->maxskor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
    <tr id="r_bobot_kelembagaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_kelembagaan_bobot_kelembagaan"><?= $Page->bobot_kelembagaan->caption() ?></span></td>
        <td data-name="bobot_kelembagaan" <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_bobot_kelembagaan">
<span<?= $Page->bobot_kelembagaan->viewAttributes() ?>>
<?= $Page->bobot_kelembagaan->getViewValue() ?></span>
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
