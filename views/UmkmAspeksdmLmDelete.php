<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmLmDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdm_lmdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspeksdm_lmdelete = currentForm = new ew.Form("fumkm_aspeksdm_lmdelete", "delete");
    loadjs.done("fumkm_aspeksdm_lmdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspeksdm_lm) ew.vars.tables.umkm_aspeksdm_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspeksdm_lm")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspeksdm_lmdelete" id="fumkm_aspeksdm_lmdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm_lm">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_NIK" class="umkm_aspeksdm_lm_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
        <th class="<?= $Page->SDM_OMS->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_OMS" class="umkm_aspeksdm_lm_SDM_OMS"><?= $Page->SDM_OMS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
        <th class="<?= $Page->SDM_FOKUS->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_FOKUS" class="umkm_aspeksdm_lm_SDM_FOKUS"><?= $Page->SDM_FOKUS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
        <th class="<?= $Page->SDM_TARGET->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_TARGET" class="umkm_aspeksdm_lm_SDM_TARGET"><?= $Page->SDM_TARGET->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
        <th class="<?= $Page->SDM_KARYAWANTETAP->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_KARYAWANTETAP" class="umkm_aspeksdm_lm_SDM_KARYAWANTETAP"><?= $Page->SDM_KARYAWANTETAP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
        <th class="<?= $Page->SDM_KARYAWANSUBKON->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON" class="umkm_aspeksdm_lm_SDM_KARYAWANSUBKON"><?= $Page->SDM_KARYAWANSUBKON->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
        <th class="<?= $Page->SDM_GAJI->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_GAJI" class="umkm_aspeksdm_lm_SDM_GAJI"><?= $Page->SDM_GAJI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
        <th class="<?= $Page->SDM_ASURANSI->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_ASURANSI" class="umkm_aspeksdm_lm_SDM_ASURANSI"><?= $Page->SDM_ASURANSI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
        <th class="<?= $Page->SDM_TUNJANGAN->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_TUNJANGAN" class="umkm_aspeksdm_lm_SDM_TUNJANGAN"><?= $Page->SDM_TUNJANGAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
        <th class="<?= $Page->SDM_PELATIHAN->headerCellClass() ?>"><span id="elh_umkm_aspeksdm_lm_SDM_PELATIHAN" class="umkm_aspeksdm_lm_SDM_PELATIHAN"><?= $Page->SDM_PELATIHAN->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_NIK" class="umkm_aspeksdm_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
        <td <?= $Page->SDM_OMS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_OMS" class="umkm_aspeksdm_lm_SDM_OMS">
<span<?= $Page->SDM_OMS->viewAttributes() ?>>
<?= $Page->SDM_OMS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
        <td <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_FOKUS" class="umkm_aspeksdm_lm_SDM_FOKUS">
<span<?= $Page->SDM_FOKUS->viewAttributes() ?>>
<?= $Page->SDM_FOKUS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
        <td <?= $Page->SDM_TARGET->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_TARGET" class="umkm_aspeksdm_lm_SDM_TARGET">
<span<?= $Page->SDM_TARGET->viewAttributes() ?>>
<?= $Page->SDM_TARGET->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
        <td <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_KARYAWANTETAP" class="umkm_aspeksdm_lm_SDM_KARYAWANTETAP">
<span<?= $Page->SDM_KARYAWANTETAP->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANTETAP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
        <td <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON" class="umkm_aspeksdm_lm_SDM_KARYAWANSUBKON">
<span<?= $Page->SDM_KARYAWANSUBKON->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANSUBKON->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
        <td <?= $Page->SDM_GAJI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_GAJI" class="umkm_aspeksdm_lm_SDM_GAJI">
<span<?= $Page->SDM_GAJI->viewAttributes() ?>>
<?= $Page->SDM_GAJI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
        <td <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_ASURANSI" class="umkm_aspeksdm_lm_SDM_ASURANSI">
<span<?= $Page->SDM_ASURANSI->viewAttributes() ?>>
<?= $Page->SDM_ASURANSI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
        <td <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_TUNJANGAN" class="umkm_aspeksdm_lm_SDM_TUNJANGAN">
<span<?= $Page->SDM_TUNJANGAN->viewAttributes() ?>>
<?= $Page->SDM_TUNJANGAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
        <td <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_PELATIHAN" class="umkm_aspeksdm_lm_SDM_PELATIHAN">
<span<?= $Page->SDM_PELATIHAN->viewAttributes() ?>>
<?= $Page->SDM_PELATIHAN->getViewValue() ?></span>
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
