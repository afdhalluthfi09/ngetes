<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaUmkmPesertaCopyDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbina_umkm_peserta_copydelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbina_umkm_peserta_copydelete = currentForm = new ew.Form("fbina_umkm_peserta_copydelete", "delete");
    loadjs.done("fbina_umkm_peserta_copydelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.bina_umkm_peserta_copy) ew.vars.tables.bina_umkm_peserta_copy = <?= JsonEncode(GetClientVar("tables", "bina_umkm_peserta_copy")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbina_umkm_peserta_copydelete" id="fbina_umkm_peserta_copydelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_umkm_peserta_copy">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_bina_umkm_peserta_copy_id" class="bina_umkm_peserta_copy_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->id_binadata->Visible) { // id_binadata ?>
        <th class="<?= $Page->id_binadata->headerCellClass() ?>"><span id="elh_bina_umkm_peserta_copy_id_binadata" class="bina_umkm_peserta_copy_id_binadata"><?= $Page->id_binadata->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_bina_umkm_peserta_copy_nik" class="bina_umkm_peserta_copy_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th class="<?= $Page->status->headerCellClass() ?>"><span id="elh_bina_umkm_peserta_copy_status" class="bina_umkm_peserta_copy_status"><?= $Page->status->caption() ?></span></th>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
        <th class="<?= $Page->catatan->headerCellClass() ?>"><span id="elh_bina_umkm_peserta_copy_catatan" class="bina_umkm_peserta_copy_catatan"><?= $Page->catatan->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_bina_umkm_peserta_copy_id" class="bina_umkm_peserta_copy_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->id_binadata->Visible) { // id_binadata ?>
        <td <?= $Page->id_binadata->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_umkm_peserta_copy_id_binadata" class="bina_umkm_peserta_copy_id_binadata">
<span<?= $Page->id_binadata->viewAttributes() ?>>
<?= $Page->id_binadata->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_umkm_peserta_copy_nik" class="bina_umkm_peserta_copy_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <td <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_umkm_peserta_copy_status" class="bina_umkm_peserta_copy_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
        <td <?= $Page->catatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_umkm_peserta_copy_catatan" class="bina_umkm_peserta_copy_catatan">
<span<?= $Page->catatan->viewAttributes() ?>>
<?= $Page->catatan->getViewValue() ?></span>
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
