<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$PeriodeDataView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fperiode_dataview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fperiode_dataview = currentForm = new ew.Form("fperiode_dataview", "view");
    loadjs.done("fperiode_dataview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.periode_data) ew.vars.tables.periode_data = <?= JsonEncode(GetClientVar("tables", "periode_data")) ?>;
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
<form name="fperiode_dataview" id="fperiode_dataview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="periode_data">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_periode_data_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_periode_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
    <tr id="r_periode_tahun">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_periode_data_periode_tahun"><?= $Page->periode_tahun->caption() ?></span></td>
        <td data-name="periode_tahun" <?= $Page->periode_tahun->cellAttributes() ?>>
<span id="el_periode_data_periode_tahun">
<span<?= $Page->periode_tahun->viewAttributes() ?>>
<?= $Page->periode_tahun->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
    <tr id="r_periode_bulan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_periode_data_periode_bulan"><?= $Page->periode_bulan->caption() ?></span></td>
        <td data-name="periode_bulan" <?= $Page->periode_bulan->cellAttributes() ?>>
<span id="el_periode_data_periode_bulan">
<span<?= $Page->periode_bulan->viewAttributes() ?>>
<?= $Page->periode_bulan->getViewValue() ?></span>
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
