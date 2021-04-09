<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmDatadiriDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_datadiridelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_datadiridelete = currentForm = new ew.Form("fumkm_datadiridelete", "delete");
    loadjs.done("fumkm_datadiridelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_datadiri) ew.vars.tables.umkm_datadiri = <?= JsonEncode(GetClientVar("tables", "umkm_datadiri")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_datadiridelete" id="fumkm_datadiridelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_datadiri">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_datadiri_NIK" class="umkm_datadiri_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <th class="<?= $Page->NAMA_PEMILIK->headerCellClass() ?>"><span id="elh_umkm_datadiri_NAMA_PEMILIK" class="umkm_datadiri_NAMA_PEMILIK"><?= $Page->NAMA_PEMILIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <th class="<?= $Page->JENIS_KELAMIN->headerCellClass() ?>"><span id="elh_umkm_datadiri_JENIS_KELAMIN" class="umkm_datadiri_JENIS_KELAMIN"><?= $Page->JENIS_KELAMIN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <th class="<?= $Page->NO_HP->headerCellClass() ?>"><span id="elh_umkm_datadiri_NO_HP" class="umkm_datadiri_NO_HP"><?= $Page->NO_HP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <th class="<?= $Page->ALAMAT->headerCellClass() ?>"><span id="elh_umkm_datadiri_ALAMAT" class="umkm_datadiri_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <th class="<?= $Page->KAPANEWON->headerCellClass() ?>"><span id="elh_umkm_datadiri_KAPANEWON" class="umkm_datadiri_KAPANEWON"><?= $Page->KAPANEWON->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <th class="<?= $Page->KALURAHAN->headerCellClass() ?>"><span id="elh_umkm_datadiri_KALURAHAN" class="umkm_datadiri_KALURAHAN"><?= $Page->KALURAHAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <th class="<?= $Page->_EMAIL->headerCellClass() ?>"><span id="elh_umkm_datadiri__EMAIL" class="umkm_datadiri__EMAIL"><?= $Page->_EMAIL->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NIK" class="umkm_datadiri_NIK">
<span<?= $Page->NIK->viewAttributes() ?>><?= Barcode()->show('', 'QRCODE', 100) ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <td <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NAMA_PEMILIK" class="umkm_datadiri_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <td <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_JENIS_KELAMIN" class="umkm_datadiri_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <td <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NO_HP" class="umkm_datadiri_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <td <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_ALAMAT" class="umkm_datadiri_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <td <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KAPANEWON" class="umkm_datadiri_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <td <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KALURAHAN" class="umkm_datadiri_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <td <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri__EMAIL" class="umkm_datadiri__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
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
