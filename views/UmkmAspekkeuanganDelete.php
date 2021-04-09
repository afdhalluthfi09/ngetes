<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuangandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspekkeuangandelete = currentForm = new ew.Form("fumkm_aspekkeuangandelete", "delete");
    loadjs.done("fumkm_aspekkeuangandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspekkeuangan) ew.vars.tables.umkm_aspekkeuangan = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspekkeuangandelete" id="fumkm_aspekkeuangandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_NIK" class="umkm_aspekkeuangan_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <th class="<?= $Page->KEU_USAHAUTAMA->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_USAHAUTAMA" class="umkm_aspekkeuangan_KEU_USAHAUTAMA"><?= $Page->KEU_USAHAUTAMA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <th class="<?= $Page->KEU_PENGELOLAAN->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_PENGELOLAAN" class="umkm_aspekkeuangan_KEU_PENGELOLAAN"><?= $Page->KEU_PENGELOLAAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <th class="<?= $Page->KEU_NOTA->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_NOTA" class="umkm_aspekkeuangan_KEU_NOTA"><?= $Page->KEU_NOTA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <th class="<?= $Page->KEU_PENCATATAN->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_PENCATATAN" class="umkm_aspekkeuangan_KEU_PENCATATAN"><?= $Page->KEU_PENCATATAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <th class="<?= $Page->KEU_LAPORAN->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_LAPORAN" class="umkm_aspekkeuangan_KEU_LAPORAN"><?= $Page->KEU_LAPORAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <th class="<?= $Page->KEU_UTANGMODAL->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_UTANGMODAL" class="umkm_aspekkeuangan_KEU_UTANGMODAL"><?= $Page->KEU_UTANGMODAL->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <th class="<?= $Page->KEU_CATATNASET->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_CATATNASET" class="umkm_aspekkeuangan_KEU_CATATNASET"><?= $Page->KEU_CATATNASET->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <th class="<?= $Page->KEU_NONTUNAI->headerCellClass() ?>"><span id="elh_umkm_aspekkeuangan_KEU_NONTUNAI" class="umkm_aspekkeuangan_KEU_NONTUNAI"><?= $Page->KEU_NONTUNAI->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_NIK" class="umkm_aspekkeuangan_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <td <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA" class="umkm_aspekkeuangan_KEU_USAHAUTAMA">
<span<?= $Page->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Page->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <td <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN" class="umkm_aspekkeuangan_KEU_PENGELOLAAN">
<span<?= $Page->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Page->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <td <?= $Page->KEU_NOTA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA" class="umkm_aspekkeuangan_KEU_NOTA">
<span<?= $Page->KEU_NOTA->viewAttributes() ?>>
<?= $Page->KEU_NOTA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <td <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN" class="umkm_aspekkeuangan_KEU_PENCATATAN">
<span<?= $Page->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Page->KEU_PENCATATAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <td <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN" class="umkm_aspekkeuangan_KEU_LAPORAN">
<span<?= $Page->KEU_LAPORAN->viewAttributes() ?>>
<?= $Page->KEU_LAPORAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <td <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL" class="umkm_aspekkeuangan_KEU_UTANGMODAL">
<span<?= $Page->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Page->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <td <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET" class="umkm_aspekkeuangan_KEU_CATATNASET">
<span<?= $Page->KEU_CATATNASET->viewAttributes() ?>>
<?= $Page->KEU_CATATNASET->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <td <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI" class="umkm_aspekkeuangan_KEU_NONTUNAI">
<span<?= $Page->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Page->KEU_NONTUNAI->getViewValue() ?></span>
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
