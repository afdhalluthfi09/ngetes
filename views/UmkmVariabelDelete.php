<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmVariabelDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_variabeldelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_variabeldelete = currentForm = new ew.Form("fumkm_variabeldelete", "delete");
    loadjs.done("fumkm_variabeldelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_variabel) ew.vars.tables.umkm_variabel = <?= JsonEncode(GetClientVar("tables", "umkm_variabel")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_variabeldelete" id="fumkm_variabeldelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_variabel">
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
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_umkm_variabel_id" class="umkm_variabel_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->variabel->Visible) { // variabel ?>
        <th class="<?= $Page->variabel->headerCellClass() ?>"><span id="elh_umkm_variabel_variabel" class="umkm_variabel_variabel"><?= $Page->variabel->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nmin->Visible) { // nmin ?>
        <th class="<?= $Page->nmin->headerCellClass() ?>"><span id="elh_umkm_variabel_nmin" class="umkm_variabel_nmin"><?= $Page->nmin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->nmax->Visible) { // nmax ?>
        <th class="<?= $Page->nmax->headerCellClass() ?>"><span id="elh_umkm_variabel_nmax" class="umkm_variabel_nmax"><?= $Page->nmax->caption() ?></span></th>
<?php } ?>
<?php if ($Page->subkat->Visible) { // subkat ?>
        <th class="<?= $Page->subkat->headerCellClass() ?>"><span id="elh_umkm_variabel_subkat" class="umkm_variabel_subkat"><?= $Page->subkat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot->Visible) { // bobot ?>
        <th class="<?= $Page->bobot->headerCellClass() ?>"><span id="elh_umkm_variabel_bobot" class="umkm_variabel_bobot"><?= $Page->bobot->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kat->Visible) { // kat ?>
        <th class="<?= $Page->kat->headerCellClass() ?>"><span id="elh_umkm_variabel_kat" class="umkm_variabel_kat"><?= $Page->kat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->porsi->Visible) { // porsi ?>
        <th class="<?= $Page->porsi->headerCellClass() ?>"><span id="elh_umkm_variabel_porsi" class="umkm_variabel_porsi"><?= $Page->porsi->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_variabel_id" class="umkm_variabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->variabel->Visible) { // variabel ?>
        <td <?= $Page->variabel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_variabel" class="umkm_variabel_variabel">
<span<?= $Page->variabel->viewAttributes() ?>>
<?= $Page->variabel->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nmin->Visible) { // nmin ?>
        <td <?= $Page->nmin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_nmin" class="umkm_variabel_nmin">
<span<?= $Page->nmin->viewAttributes() ?>>
<?= $Page->nmin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->nmax->Visible) { // nmax ?>
        <td <?= $Page->nmax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_nmax" class="umkm_variabel_nmax">
<span<?= $Page->nmax->viewAttributes() ?>>
<?= $Page->nmax->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->subkat->Visible) { // subkat ?>
        <td <?= $Page->subkat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_subkat" class="umkm_variabel_subkat">
<span<?= $Page->subkat->viewAttributes() ?>>
<?= $Page->subkat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot->Visible) { // bobot ?>
        <td <?= $Page->bobot->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_bobot" class="umkm_variabel_bobot">
<span<?= $Page->bobot->viewAttributes() ?>>
<?= $Page->bobot->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kat->Visible) { // kat ?>
        <td <?= $Page->kat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_kat" class="umkm_variabel_kat">
<span<?= $Page->kat->viewAttributes() ?>>
<?= $Page->kat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->porsi->Visible) { // porsi ?>
        <td <?= $Page->porsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_porsi" class="umkm_variabel_porsi">
<span<?= $Page->porsi->viewAttributes() ?>>
<?= $Page->porsi->getViewValue() ?></span>
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
