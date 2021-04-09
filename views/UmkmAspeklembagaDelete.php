<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembagadelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspeklembagadelete = currentForm = new ew.Form("fumkm_aspeklembagadelete", "delete");
    loadjs.done("fumkm_aspeklembagadelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspeklembaga) ew.vars.tables.umkm_aspeklembaga = <?= JsonEncode(GetClientVar("tables", "umkm_aspeklembaga")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspeklembagadelete" id="fumkm_aspeklembagadelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_NIK" class="umkm_aspeklembaga_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
        <th class="<?= $Page->LB_BADANHUKUM->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_BADANHUKUM" class="umkm_aspeklembaga_LB_BADANHUKUM"><?= $Page->LB_BADANHUKUM->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
        <th class="<?= $Page->LB_IZINUSAHA->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_IZINUSAHA" class="umkm_aspeklembaga_LB_IZINUSAHA"><?= $Page->LB_IZINUSAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
        <th class="<?= $Page->LB_NPWP->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_NPWP" class="umkm_aspeklembaga_LB_NPWP"><?= $Page->LB_NPWP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
        <th class="<?= $Page->LB_SO->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_SO" class="umkm_aspeklembaga_LB_SO"><?= $Page->LB_SO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
        <th class="<?= $Page->LB_JD->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_JD" class="umkm_aspeklembaga_LB_JD"><?= $Page->LB_JD->caption() ?></span></th>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
        <th class="<?= $Page->LB_ISO->headerCellClass() ?>"><span id="elh_umkm_aspeklembaga_LB_ISO" class="umkm_aspeklembaga_LB_ISO"><?= $Page->LB_ISO->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_NIK" class="umkm_aspeklembaga_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
        <td <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_BADANHUKUM" class="umkm_aspeklembaga_LB_BADANHUKUM">
<span<?= $Page->LB_BADANHUKUM->viewAttributes() ?>>
<?= $Page->LB_BADANHUKUM->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
        <td <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_IZINUSAHA" class="umkm_aspeklembaga_LB_IZINUSAHA">
<span<?= $Page->LB_IZINUSAHA->viewAttributes() ?>>
<?= $Page->LB_IZINUSAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
        <td <?= $Page->LB_NPWP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_NPWP" class="umkm_aspeklembaga_LB_NPWP">
<span<?= $Page->LB_NPWP->viewAttributes() ?>>
<?= $Page->LB_NPWP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
        <td <?= $Page->LB_SO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_SO" class="umkm_aspeklembaga_LB_SO">
<span<?= $Page->LB_SO->viewAttributes() ?>>
<?= $Page->LB_SO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
        <td <?= $Page->LB_JD->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_JD" class="umkm_aspeklembaga_LB_JD">
<span<?= $Page->LB_JD->viewAttributes() ?>>
<?= $Page->LB_JD->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
        <td <?= $Page->LB_ISO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_ISO" class="umkm_aspeklembaga_LB_ISO">
<span<?= $Page->LB_ISO->viewAttributes() ?>>
<?= $Page->LB_ISO->getViewValue() ?></span>
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
