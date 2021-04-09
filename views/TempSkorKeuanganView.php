<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKeuanganView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_keuanganview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_keuanganview = currentForm = new ew.Form("ftemp_skor_keuanganview", "view");
    loadjs.done("ftemp_skor_keuanganview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_keuangan) ew.vars.tables.temp_skor_keuangan = <?= JsonEncode(GetClientVar("tables", "temp_skor_keuangan")) ?>;
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
<form name="ftemp_skor_keuanganview" id="ftemp_skor_keuanganview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_keuangan">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_income->Visible) { // skor_income ?>
    <tr id="r_skor_income">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_income"><?= $Page->skor_income->caption() ?></span></td>
        <td data-name="skor_income" <?= $Page->skor_income->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_income">
<span<?= $Page->skor_income->viewAttributes() ?>>
<?= $Page->skor_income->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_income->Visible) { // max_income ?>
    <tr id="r_max_income">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_income"><?= $Page->max_income->caption() ?></span></td>
        <td data-name="max_income" <?= $Page->max_income->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_income">
<span<?= $Page->max_income->viewAttributes() ?>>
<?= $Page->max_income->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
    <tr id="r_skor_pengelolaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_pengelolaan"><?= $Page->skor_pengelolaan->caption() ?></span></td>
        <td data-name="skor_pengelolaan" <?= $Page->skor_pengelolaan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_pengelolaan">
<span<?= $Page->skor_pengelolaan->viewAttributes() ?>>
<?= $Page->skor_pengelolaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
    <tr id="r_max_pengelolaan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_pengelolaan"><?= $Page->max_pengelolaan->caption() ?></span></td>
        <td data-name="max_pengelolaan" <?= $Page->max_pengelolaan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_pengelolaan">
<span<?= $Page->max_pengelolaan->viewAttributes() ?>>
<?= $Page->max_pengelolaan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_nota->Visible) { // skor_nota ?>
    <tr id="r_skor_nota">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_nota"><?= $Page->skor_nota->caption() ?></span></td>
        <td data-name="skor_nota" <?= $Page->skor_nota->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_nota">
<span<?= $Page->skor_nota->viewAttributes() ?>>
<?= $Page->skor_nota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_nota->Visible) { // max_nota ?>
    <tr id="r_max_nota">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_nota"><?= $Page->max_nota->caption() ?></span></td>
        <td data-name="max_nota" <?= $Page->max_nota->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_nota">
<span<?= $Page->max_nota->viewAttributes() ?>>
<?= $Page->max_nota->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
    <tr id="r_skor_jurnal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_jurnal"><?= $Page->skor_jurnal->caption() ?></span></td>
        <td data-name="skor_jurnal" <?= $Page->skor_jurnal->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_jurnal">
<span<?= $Page->skor_jurnal->viewAttributes() ?>>
<?= $Page->skor_jurnal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
    <tr id="r_max_jurnal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_jurnal"><?= $Page->max_jurnal->caption() ?></span></td>
        <td data-name="max_jurnal" <?= $Page->max_jurnal->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_jurnal">
<span<?= $Page->max_jurnal->viewAttributes() ?>>
<?= $Page->max_jurnal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
    <tr id="r_skor_akutansi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_akutansi"><?= $Page->skor_akutansi->caption() ?></span></td>
        <td data-name="skor_akutansi" <?= $Page->skor_akutansi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_akutansi">
<span<?= $Page->skor_akutansi->viewAttributes() ?>>
<?= $Page->skor_akutansi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
    <tr id="r_max_akutansi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_akutansi"><?= $Page->max_akutansi->caption() ?></span></td>
        <td data-name="max_akutansi" <?= $Page->max_akutansi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_akutansi">
<span<?= $Page->max_akutansi->viewAttributes() ?>>
<?= $Page->max_akutansi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
    <tr id="r_skor_utangbank">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_utangbank"><?= $Page->skor_utangbank->caption() ?></span></td>
        <td data-name="skor_utangbank" <?= $Page->skor_utangbank->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_utangbank">
<span<?= $Page->skor_utangbank->viewAttributes() ?>>
<?= $Page->skor_utangbank->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
    <tr id="r_max_utangbank">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_utangbank"><?= $Page->max_utangbank->caption() ?></span></td>
        <td data-name="max_utangbank" <?= $Page->max_utangbank->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_utangbank">
<span<?= $Page->max_utangbank->viewAttributes() ?>>
<?= $Page->max_utangbank->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
    <tr id="r_skor_dokumentasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_dokumentasi"><?= $Page->skor_dokumentasi->caption() ?></span></td>
        <td data-name="skor_dokumentasi" <?= $Page->skor_dokumentasi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_dokumentasi">
<span<?= $Page->skor_dokumentasi->viewAttributes() ?>>
<?= $Page->skor_dokumentasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
    <tr id="r_max_dokumentasi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_dokumentasi"><?= $Page->max_dokumentasi->caption() ?></span></td>
        <td data-name="max_dokumentasi" <?= $Page->max_dokumentasi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_dokumentasi">
<span<?= $Page->max_dokumentasi->viewAttributes() ?>>
<?= $Page->max_dokumentasi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
    <tr id="r_skor_nontunai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_nontunai"><?= $Page->skor_nontunai->caption() ?></span></td>
        <td data-name="skor_nontunai" <?= $Page->skor_nontunai->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_nontunai">
<span<?= $Page->skor_nontunai->viewAttributes() ?>>
<?= $Page->skor_nontunai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
    <tr id="r_max_nontunai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_max_nontunai"><?= $Page->max_nontunai->caption() ?></span></td>
        <td data-name="max_nontunai" <?= $Page->max_nontunai->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_nontunai">
<span<?= $Page->max_nontunai->viewAttributes() ?>>
<?= $Page->max_nontunai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
    <tr id="r_skor_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_skor_keuangan"><?= $Page->skor_keuangan->caption() ?></span></td>
        <td data-name="skor_keuangan" <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_keuangan">
<span<?= $Page->skor_keuangan->viewAttributes() ?>>
<?= $Page->skor_keuangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
    <tr id="r_maxskor_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_maxskor_keuangan"><?= $Page->maxskor_keuangan->caption() ?></span></td>
        <td data-name="maxskor_keuangan" <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_maxskor_keuangan">
<span<?= $Page->maxskor_keuangan->viewAttributes() ?>>
<?= $Page->maxskor_keuangan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
    <tr id="r_bobot_keuangan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_keuangan_bobot_keuangan"><?= $Page->bobot_keuangan->caption() ?></span></td>
        <td data-name="bobot_keuangan" <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_bobot_keuangan">
<span<?= $Page->bobot_keuangan->viewAttributes() ?>>
<?= $Page->bobot_keuangan->getViewValue() ?></span>
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
