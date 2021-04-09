<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspekproduksidelete = currentForm = new ew.Form("fumkm_aspekproduksidelete", "delete");
    loadjs.done("fumkm_aspekproduksidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspekproduksi) ew.vars.tables.umkm_aspekproduksi = <?= JsonEncode(GetClientVar("tables", "umkm_aspekproduksi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspekproduksidelete" id="fumkm_aspekproduksidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi">
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
<?php if ($Page->NIK->Visible) { // NIK ?>
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_NIK" class="umkm_aspekproduksi_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
        <th class="<?= $Page->PROD_FREKUENSIPRODUKSI->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI" class="umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI"><?= $Page->PROD_FREKUENSIPRODUKSI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
        <th class="<?= $Page->PROD_KAPASITAS->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_KAPASITAS" class="umkm_aspekproduksi_PROD_KAPASITAS"><?= $Page->PROD_KAPASITAS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
        <th class="<?= $Page->PROD_KEAMANANPANGAN->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_KEAMANANPANGAN" class="umkm_aspekproduksi_PROD_KEAMANANPANGAN"><?= $Page->PROD_KEAMANANPANGAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
        <th class="<?= $Page->PROD_SNI->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_SNI" class="umkm_aspekproduksi_PROD_SNI"><?= $Page->PROD_SNI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
        <th class="<?= $Page->PROD_KEMASAN->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_KEMASAN" class="umkm_aspekproduksi_PROD_KEMASAN"><?= $Page->PROD_KEMASAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
        <th class="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU" class="umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
        <th class="<?= $Page->PROD_ALATPRODUKSI->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_ALATPRODUKSI" class="umkm_aspekproduksi_PROD_ALATPRODUKSI"><?= $Page->PROD_ALATPRODUKSI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
        <th class="<?= $Page->PROD_GUDANGPENYIMPAN->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN" class="umkm_aspekproduksi_PROD_GUDANGPENYIMPAN"><?= $Page->PROD_GUDANGPENYIMPAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
        <th class="<?= $Page->PROD_LAYOUTPRODUKSI->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI" class="umkm_aspekproduksi_PROD_LAYOUTPRODUKSI"><?= $Page->PROD_LAYOUTPRODUKSI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
        <th class="<?= $Page->PROD_SOP->headerCellClass() ?>"><span id="elh_umkm_aspekproduksi_PROD_SOP" class="umkm_aspekproduksi_PROD_SOP"><?= $Page->PROD_SOP->caption() ?></span></th>
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
<?php if ($Page->NIK->Visible) { // NIK ?>
        <td <?= $Page->NIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_NIK" class="umkm_aspekproduksi_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
        <td <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI" class="umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
<span<?= $Page->PROD_FREKUENSIPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_FREKUENSIPRODUKSI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
        <td <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KAPASITAS" class="umkm_aspekproduksi_PROD_KAPASITAS">
<span<?= $Page->PROD_KAPASITAS->viewAttributes() ?>>
<?= $Page->PROD_KAPASITAS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
        <td <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEAMANANPANGAN" class="umkm_aspekproduksi_PROD_KEAMANANPANGAN">
<span<?= $Page->PROD_KEAMANANPANGAN->viewAttributes() ?>>
<?= $Page->PROD_KEAMANANPANGAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
        <td <?= $Page->PROD_SNI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SNI" class="umkm_aspekproduksi_PROD_SNI">
<span<?= $Page->PROD_SNI->viewAttributes() ?>>
<?= $Page->PROD_SNI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
        <td <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEMASAN" class="umkm_aspekproduksi_PROD_KEMASAN">
<span<?= $Page->PROD_KEMASAN->viewAttributes() ?>>
<?= $Page->PROD_KEMASAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
        <td <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU" class="umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
<span<?= $Page->PROD_KETERSEDIAANBAHANBAKU->viewAttributes() ?>>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
        <td <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_ALATPRODUKSI" class="umkm_aspekproduksi_PROD_ALATPRODUKSI">
<span<?= $Page->PROD_ALATPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_ALATPRODUKSI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
        <td <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN" class="umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
<span<?= $Page->PROD_GUDANGPENYIMPAN->viewAttributes() ?>>
<?= $Page->PROD_GUDANGPENYIMPAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
        <td <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI" class="umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
<span<?= $Page->PROD_LAYOUTPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_LAYOUTPRODUKSI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
        <td <?= $Page->PROD_SOP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SOP" class="umkm_aspekproduksi_PROD_SOP">
<span<?= $Page->PROD_SOP->viewAttributes() ?>>
<?= $Page->PROD_SOP->getViewValue() ?></span>
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
