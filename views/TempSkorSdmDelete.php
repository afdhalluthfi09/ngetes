<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorSdmDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_sdmdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_sdmdelete = currentForm = new ew.Form("ftemp_skor_sdmdelete", "delete");
    loadjs.done("ftemp_skor_sdmdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_sdm) ew.vars.tables.temp_skor_sdm = <?= JsonEncode(GetClientVar("tables", "temp_skor_sdm")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_sdmdelete" id="ftemp_skor_sdmdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_sdm">
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
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_sdm_nik" class="temp_skor_sdm_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_oms->Visible) { // skor_oms ?>
        <th class="<?= $Page->skor_oms->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_oms" class="temp_skor_sdm_skor_oms"><?= $Page->skor_oms->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_oms->Visible) { // max_oms ?>
        <th class="<?= $Page->max_oms->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_oms" class="temp_skor_sdm_max_oms"><?= $Page->max_oms->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
        <th class="<?= $Page->skor_fokus->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_fokus" class="temp_skor_sdm_skor_fokus"><?= $Page->skor_fokus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_fokus->Visible) { // max_fokus ?>
        <th class="<?= $Page->max_fokus->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_fokus" class="temp_skor_sdm_max_fokus"><?= $Page->max_fokus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <th class="<?= $Page->skor_target->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_target" class="temp_skor_sdm_skor_target"><?= $Page->skor_target->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <th class="<?= $Page->max_target->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_target" class="temp_skor_sdm_max_target"><?= $Page->max_target->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
        <th class="<?= $Page->skor_karyawan->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_karyawan" class="temp_skor_sdm_skor_karyawan"><?= $Page->skor_karyawan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
        <th class="<?= $Page->max_karyawan->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_karyawan" class="temp_skor_sdm_max_karyawan"><?= $Page->max_karyawan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
        <th class="<?= $Page->skor_outsource->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_outsource" class="temp_skor_sdm_skor_outsource"><?= $Page->skor_outsource->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_outsource->Visible) { // max_outsource ?>
        <th class="<?= $Page->max_outsource->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_outsource" class="temp_skor_sdm_max_outsource"><?= $Page->max_outsource->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
        <th class="<?= $Page->skor_besarangaji->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_besarangaji" class="temp_skor_sdm_skor_besarangaji"><?= $Page->skor_besarangaji->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
        <th class="<?= $Page->max_besarangaji->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_besarangaji" class="temp_skor_sdm_max_besarangaji"><?= $Page->max_besarangaji->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
        <th class="<?= $Page->skor_asuransi->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_asuransi" class="temp_skor_sdm_skor_asuransi"><?= $Page->skor_asuransi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
        <th class="<?= $Page->max_asuransi->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_asuransi" class="temp_skor_sdm_max_asuransi"><?= $Page->max_asuransi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
        <th class="<?= $Page->skor_bonus->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_bonus" class="temp_skor_sdm_skor_bonus"><?= $Page->skor_bonus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_bonus->Visible) { // max_bonus ?>
        <th class="<?= $Page->max_bonus->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_bonus" class="temp_skor_sdm_max_bonus"><?= $Page->max_bonus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_training->Visible) { // skor_training ?>
        <th class="<?= $Page->skor_training->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_training" class="temp_skor_sdm_skor_training"><?= $Page->skor_training->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_training->Visible) { // max_training ?>
        <th class="<?= $Page->max_training->headerCellClass() ?>"><span id="elh_temp_skor_sdm_max_training" class="temp_skor_sdm_max_training"><?= $Page->max_training->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <th class="<?= $Page->skor_sdm->headerCellClass() ?>"><span id="elh_temp_skor_sdm_skor_sdm" class="temp_skor_sdm_skor_sdm"><?= $Page->skor_sdm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <th class="<?= $Page->maxskor_sdm->headerCellClass() ?>"><span id="elh_temp_skor_sdm_maxskor_sdm" class="temp_skor_sdm_maxskor_sdm"><?= $Page->maxskor_sdm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <th class="<?= $Page->bobot_sdm->headerCellClass() ?>"><span id="elh_temp_skor_sdm_bobot_sdm" class="temp_skor_sdm_bobot_sdm"><?= $Page->bobot_sdm->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_nik" class="temp_skor_sdm_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_oms->Visible) { // skor_oms ?>
        <td <?= $Page->skor_oms->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_oms" class="temp_skor_sdm_skor_oms">
<span<?= $Page->skor_oms->viewAttributes() ?>>
<?= $Page->skor_oms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_oms->Visible) { // max_oms ?>
        <td <?= $Page->max_oms->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_oms" class="temp_skor_sdm_max_oms">
<span<?= $Page->max_oms->viewAttributes() ?>>
<?= $Page->max_oms->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
        <td <?= $Page->skor_fokus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_fokus" class="temp_skor_sdm_skor_fokus">
<span<?= $Page->skor_fokus->viewAttributes() ?>>
<?= $Page->skor_fokus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_fokus->Visible) { // max_fokus ?>
        <td <?= $Page->max_fokus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_fokus" class="temp_skor_sdm_max_fokus">
<span<?= $Page->max_fokus->viewAttributes() ?>>
<?= $Page->max_fokus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <td <?= $Page->skor_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_target" class="temp_skor_sdm_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <td <?= $Page->max_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_target" class="temp_skor_sdm_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
        <td <?= $Page->skor_karyawan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_karyawan" class="temp_skor_sdm_skor_karyawan">
<span<?= $Page->skor_karyawan->viewAttributes() ?>>
<?= $Page->skor_karyawan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
        <td <?= $Page->max_karyawan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_karyawan" class="temp_skor_sdm_max_karyawan">
<span<?= $Page->max_karyawan->viewAttributes() ?>>
<?= $Page->max_karyawan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
        <td <?= $Page->skor_outsource->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_outsource" class="temp_skor_sdm_skor_outsource">
<span<?= $Page->skor_outsource->viewAttributes() ?>>
<?= $Page->skor_outsource->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_outsource->Visible) { // max_outsource ?>
        <td <?= $Page->max_outsource->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_outsource" class="temp_skor_sdm_max_outsource">
<span<?= $Page->max_outsource->viewAttributes() ?>>
<?= $Page->max_outsource->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
        <td <?= $Page->skor_besarangaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_besarangaji" class="temp_skor_sdm_skor_besarangaji">
<span<?= $Page->skor_besarangaji->viewAttributes() ?>>
<?= $Page->skor_besarangaji->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
        <td <?= $Page->max_besarangaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_besarangaji" class="temp_skor_sdm_max_besarangaji">
<span<?= $Page->max_besarangaji->viewAttributes() ?>>
<?= $Page->max_besarangaji->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
        <td <?= $Page->skor_asuransi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_asuransi" class="temp_skor_sdm_skor_asuransi">
<span<?= $Page->skor_asuransi->viewAttributes() ?>>
<?= $Page->skor_asuransi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
        <td <?= $Page->max_asuransi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_asuransi" class="temp_skor_sdm_max_asuransi">
<span<?= $Page->max_asuransi->viewAttributes() ?>>
<?= $Page->max_asuransi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
        <td <?= $Page->skor_bonus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_bonus" class="temp_skor_sdm_skor_bonus">
<span<?= $Page->skor_bonus->viewAttributes() ?>>
<?= $Page->skor_bonus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_bonus->Visible) { // max_bonus ?>
        <td <?= $Page->max_bonus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_bonus" class="temp_skor_sdm_max_bonus">
<span<?= $Page->max_bonus->viewAttributes() ?>>
<?= $Page->max_bonus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_training->Visible) { // skor_training ?>
        <td <?= $Page->skor_training->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_training" class="temp_skor_sdm_skor_training">
<span<?= $Page->skor_training->viewAttributes() ?>>
<?= $Page->skor_training->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_training->Visible) { // max_training ?>
        <td <?= $Page->max_training->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_training" class="temp_skor_sdm_max_training">
<span<?= $Page->max_training->viewAttributes() ?>>
<?= $Page->max_training->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <td <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_sdm" class="temp_skor_sdm_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <td <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_maxskor_sdm" class="temp_skor_sdm_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <td <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_bobot_sdm" class="temp_skor_sdm_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
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
