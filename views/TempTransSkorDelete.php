<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempTransSkorDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_trans_skordelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_trans_skordelete = currentForm = new ew.Form("ftemp_trans_skordelete", "delete");
    loadjs.done("ftemp_trans_skordelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_trans_skor) ew.vars.tables.temp_trans_skor = <?= JsonEncode(GetClientVar("tables", "temp_trans_skor")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_trans_skordelete" id="ftemp_trans_skordelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_trans_skor">
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
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_trans_skor_nik" class="temp_trans_skor_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->jenis_nilai->Visible) { // jenis_nilai ?>
        <th class="<?= $Page->jenis_nilai->headerCellClass() ?>"><span id="elh_temp_trans_skor_jenis_nilai" class="temp_trans_skor_jenis_nilai"><?= $Page->jenis_nilai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilai->Visible) { // nilai ?>
        <th class="<?= $Page->nilai->headerCellClass() ?>"><span id="elh_temp_trans_skor_nilai" class="temp_trans_skor_nilai"><?= $Page->nilai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nilaimax->Visible) { // nilaimax ?>
        <th class="<?= $Page->nilaimax->headerCellClass() ?>"><span id="elh_temp_trans_skor_nilaimax" class="temp_trans_skor_nilaimax"><?= $Page->nilaimax->caption() ?></span></th>
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
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_trans_skor_nik" class="temp_trans_skor_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->jenis_nilai->Visible) { // jenis_nilai ?>
        <td <?= $Page->jenis_nilai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_trans_skor_jenis_nilai" class="temp_trans_skor_jenis_nilai">
<span<?= $Page->jenis_nilai->viewAttributes() ?>>
<?= $Page->jenis_nilai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilai->Visible) { // nilai ?>
        <td <?= $Page->nilai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_trans_skor_nilai" class="temp_trans_skor_nilai">
<span<?= $Page->nilai->viewAttributes() ?>>
<?= $Page->nilai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nilaimax->Visible) { // nilaimax ?>
        <td <?= $Page->nilaimax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_trans_skor_nilaimax" class="temp_trans_skor_nilaimax">
<span<?= $Page->nilaimax->viewAttributes() ?>>
<?= $Page->nilaimax->getViewValue() ?></span>
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
