<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$PeriodeDataDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fperiode_datadelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fperiode_datadelete = currentForm = new ew.Form("fperiode_datadelete", "delete");
    loadjs.done("fperiode_datadelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.periode_data) ew.vars.tables.periode_data = <?= JsonEncode(GetClientVar("tables", "periode_data")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fperiode_datadelete" id="fperiode_datadelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="periode_data">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_periode_data_id" class="periode_data_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
        <th class="<?= $Page->periode_tahun->headerCellClass() ?>"><span id="elh_periode_data_periode_tahun" class="periode_data_periode_tahun"><?= $Page->periode_tahun->caption() ?></span></th>
<?php } ?>
<?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
        <th class="<?= $Page->periode_bulan->headerCellClass() ?>"><span id="elh_periode_data_periode_bulan" class="periode_data_periode_bulan"><?= $Page->periode_bulan->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_periode_data_id" class="periode_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
        <td <?= $Page->periode_tahun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_periode_data_periode_tahun" class="periode_data_periode_tahun">
<span<?= $Page->periode_tahun->viewAttributes() ?>>
<?= $Page->periode_tahun->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
        <td <?= $Page->periode_bulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_periode_data_periode_bulan" class="periode_data_periode_bulan">
<span<?= $Page->periode_bulan->viewAttributes() ?>>
<?= $Page->periode_bulan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
