<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempTransSkorView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_trans_skorview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_trans_skorview = currentForm = new ew.Form("ftemp_trans_skorview", "view");
    loadjs.done("ftemp_trans_skorview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_trans_skor) ew.vars.tables.temp_trans_skor = <?= JsonEncode(GetClientVar("tables", "temp_trans_skor")) ?>;
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
<form name="ftemp_trans_skorview" id="ftemp_trans_skorview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_trans_skor">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_trans_skor_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_trans_skor_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->jenis_nilai->Visible) { // jenis_nilai ?>
    <tr id="r_jenis_nilai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_trans_skor_jenis_nilai"><?= $Page->jenis_nilai->caption() ?></span></td>
        <td data-name="jenis_nilai" <?= $Page->jenis_nilai->cellAttributes() ?>>
<span id="el_temp_trans_skor_jenis_nilai">
<span<?= $Page->jenis_nilai->viewAttributes() ?>>
<?= $Page->jenis_nilai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilai->Visible) { // nilai ?>
    <tr id="r_nilai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_trans_skor_nilai"><?= $Page->nilai->caption() ?></span></td>
        <td data-name="nilai" <?= $Page->nilai->cellAttributes() ?>>
<span id="el_temp_trans_skor_nilai">
<span<?= $Page->nilai->viewAttributes() ?>>
<?= $Page->nilai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nilaimax->Visible) { // nilaimax ?>
    <tr id="r_nilaimax">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_trans_skor_nilaimax"><?= $Page->nilaimax->caption() ?></span></td>
        <td data-name="nilaimax" <?= $Page->nilaimax->cellAttributes() ?>>
<span id="el_temp_trans_skor_nilaimax">
<span<?= $Page->nilaimax->viewAttributes() ?>>
<?= $Page->nilaimax->getViewValue() ?></span>
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
