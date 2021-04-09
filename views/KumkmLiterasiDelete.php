<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmLiterasiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkumkm_literasidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkumkm_literasidelete = currentForm = new ew.Form("fkumkm_literasidelete", "delete");
    loadjs.done("fkumkm_literasidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.kumkm_literasi) ew.vars.tables.kumkm_literasi = <?= JsonEncode(GetClientVar("tables", "kumkm_literasi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkumkm_literasidelete" id="fkumkm_literasidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_literasi">
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
<?php if ($Page->tgl->Visible) { // tgl ?>
        <th class="<?= $Page->tgl->headerCellClass() ?>"><span id="elh_kumkm_literasi_tgl" class="kumkm_literasi_tgl"><?= $Page->tgl->caption() ?></span></th>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <th class="<?= $Page->foto->headerCellClass() ?>"><span id="elh_kumkm_literasi_foto" class="kumkm_literasi_foto"><?= $Page->foto->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idjenis->Visible) { // idjenis ?>
        <th class="<?= $Page->idjenis->headerCellClass() ?>"><span id="elh_kumkm_literasi_idjenis" class="kumkm_literasi_idjenis"><?= $Page->idjenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul_artikel->Visible) { // judul_artikel ?>
        <th class="<?= $Page->judul_artikel->headerCellClass() ?>"><span id="elh_kumkm_literasi_judul_artikel" class="kumkm_literasi_judul_artikel"><?= $Page->judul_artikel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
        <th class="<?= $Page->kelas->headerCellClass() ?>"><span id="elh_kumkm_literasi_kelas" class="kumkm_literasi_kelas"><?= $Page->kelas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subjenis->Visible) { // subjenis ?>
        <th class="<?= $Page->subjenis->headerCellClass() ?>"><span id="elh_kumkm_literasi_subjenis" class="kumkm_literasi_subjenis"><?= $Page->subjenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->urutan->Visible) { // urutan ?>
        <th class="<?= $Page->urutan->headerCellClass() ?>"><span id="elh_kumkm_literasi_urutan" class="kumkm_literasi_urutan"><?= $Page->urutan->caption() ?></span></th>
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
<?php if ($Page->tgl->Visible) { // tgl ?>
        <td <?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_tgl" class="kumkm_literasi_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
        <td <?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_foto" class="kumkm_literasi_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= $Page->foto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idjenis->Visible) { // idjenis ?>
        <td <?= $Page->idjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_idjenis" class="kumkm_literasi_idjenis">
<span<?= $Page->idjenis->viewAttributes() ?>>
<?= $Page->idjenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->judul_artikel->Visible) { // judul_artikel ?>
        <td <?= $Page->judul_artikel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_judul_artikel" class="kumkm_literasi_judul_artikel">
<span<?= $Page->judul_artikel->viewAttributes() ?>>
<?= $Page->judul_artikel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
        <td <?= $Page->kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_kelas" class="kumkm_literasi_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subjenis->Visible) { // subjenis ?>
        <td <?= $Page->subjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_subjenis" class="kumkm_literasi_subjenis">
<span<?= $Page->subjenis->viewAttributes() ?>>
<?= $Page->subjenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->urutan->Visible) { // urutan ?>
        <td <?= $Page->urutan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_urutan" class="kumkm_literasi_urutan">
<span<?= $Page->urutan->viewAttributes() ?>>
<?= $Page->urutan->getViewValue() ?></span>
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
