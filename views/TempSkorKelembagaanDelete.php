<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelembagaanDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelembagaandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_kelembagaandelete = currentForm = new ew.Form("ftemp_skor_kelembagaandelete", "delete");
    loadjs.done("ftemp_skor_kelembagaandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_kelembagaan) ew.vars.tables.temp_skor_kelembagaan = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelembagaan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_kelembagaandelete" id="ftemp_skor_kelembagaandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelembagaan">
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
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_nik" class="temp_skor_kelembagaan_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
        <th class="<?= $Page->skor_badanhukum->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_badanhukum" class="temp_skor_kelembagaan_skor_badanhukum"><?= $Page->skor_badanhukum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
        <th class="<?= $Page->max_badanhukum->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_badanhukum" class="temp_skor_kelembagaan_max_badanhukum"><?= $Page->max_badanhukum->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_izin->Visible) { // skor_izin ?>
        <th class="<?= $Page->skor_izin->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_izin" class="temp_skor_kelembagaan_skor_izin"><?= $Page->skor_izin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_izin->Visible) { // max_izin ?>
        <th class="<?= $Page->max_izin->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_izin" class="temp_skor_kelembagaan_max_izin"><?= $Page->max_izin->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
        <th class="<?= $Page->skor_npwp->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_npwp" class="temp_skor_kelembagaan_skor_npwp"><?= $Page->skor_npwp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_npwp->Visible) { // max_npwp ?>
        <th class="<?= $Page->max_npwp->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_npwp" class="temp_skor_kelembagaan_max_npwp"><?= $Page->max_npwp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
        <th class="<?= $Page->skor_struktur->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_struktur" class="temp_skor_kelembagaan_skor_struktur"><?= $Page->skor_struktur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_struktur->Visible) { // max_struktur ?>
        <th class="<?= $Page->max_struktur->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_struktur" class="temp_skor_kelembagaan_max_struktur"><?= $Page->max_struktur->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
        <th class="<?= $Page->skor_jobdesk->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_jobdesk" class="temp_skor_kelembagaan_skor_jobdesk"><?= $Page->skor_jobdesk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
        <th class="<?= $Page->max_jobdesk->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_jobdesk" class="temp_skor_kelembagaan_max_jobdesk"><?= $Page->max_jobdesk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_iso->Visible) { // skor_iso ?>
        <th class="<?= $Page->skor_iso->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_iso" class="temp_skor_kelembagaan_skor_iso"><?= $Page->skor_iso->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_iso->Visible) { // max_iso ?>
        <th class="<?= $Page->max_iso->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_max_iso" class="temp_skor_kelembagaan_max_iso"><?= $Page->max_iso->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <th class="<?= $Page->skor_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_skor_kelembagaan" class="temp_skor_kelembagaan_skor_kelembagaan"><?= $Page->skor_kelembagaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <th class="<?= $Page->maxskor_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_maxskor_kelembagaan" class="temp_skor_kelembagaan_maxskor_kelembagaan"><?= $Page->maxskor_kelembagaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <th class="<?= $Page->bobot_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelembagaan_bobot_kelembagaan" class="temp_skor_kelembagaan_bobot_kelembagaan"><?= $Page->bobot_kelembagaan->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_nik" class="temp_skor_kelembagaan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
        <td <?= $Page->skor_badanhukum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_badanhukum" class="temp_skor_kelembagaan_skor_badanhukum">
<span<?= $Page->skor_badanhukum->viewAttributes() ?>>
<?= $Page->skor_badanhukum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
        <td <?= $Page->max_badanhukum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_badanhukum" class="temp_skor_kelembagaan_max_badanhukum">
<span<?= $Page->max_badanhukum->viewAttributes() ?>>
<?= $Page->max_badanhukum->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_izin->Visible) { // skor_izin ?>
        <td <?= $Page->skor_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_izin" class="temp_skor_kelembagaan_skor_izin">
<span<?= $Page->skor_izin->viewAttributes() ?>>
<?= $Page->skor_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_izin->Visible) { // max_izin ?>
        <td <?= $Page->max_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_izin" class="temp_skor_kelembagaan_max_izin">
<span<?= $Page->max_izin->viewAttributes() ?>>
<?= $Page->max_izin->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
        <td <?= $Page->skor_npwp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_npwp" class="temp_skor_kelembagaan_skor_npwp">
<span<?= $Page->skor_npwp->viewAttributes() ?>>
<?= $Page->skor_npwp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_npwp->Visible) { // max_npwp ?>
        <td <?= $Page->max_npwp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_npwp" class="temp_skor_kelembagaan_max_npwp">
<span<?= $Page->max_npwp->viewAttributes() ?>>
<?= $Page->max_npwp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
        <td <?= $Page->skor_struktur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_struktur" class="temp_skor_kelembagaan_skor_struktur">
<span<?= $Page->skor_struktur->viewAttributes() ?>>
<?= $Page->skor_struktur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_struktur->Visible) { // max_struktur ?>
        <td <?= $Page->max_struktur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_struktur" class="temp_skor_kelembagaan_max_struktur">
<span<?= $Page->max_struktur->viewAttributes() ?>>
<?= $Page->max_struktur->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
        <td <?= $Page->skor_jobdesk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_jobdesk" class="temp_skor_kelembagaan_skor_jobdesk">
<span<?= $Page->skor_jobdesk->viewAttributes() ?>>
<?= $Page->skor_jobdesk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
        <td <?= $Page->max_jobdesk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_jobdesk" class="temp_skor_kelembagaan_max_jobdesk">
<span<?= $Page->max_jobdesk->viewAttributes() ?>>
<?= $Page->max_jobdesk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_iso->Visible) { // skor_iso ?>
        <td <?= $Page->skor_iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_iso" class="temp_skor_kelembagaan_skor_iso">
<span<?= $Page->skor_iso->viewAttributes() ?>>
<?= $Page->skor_iso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_iso->Visible) { // max_iso ?>
        <td <?= $Page->max_iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_max_iso" class="temp_skor_kelembagaan_max_iso">
<span<?= $Page->max_iso->viewAttributes() ?>>
<?= $Page->max_iso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <td <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_skor_kelembagaan" class="temp_skor_kelembagaan_skor_kelembagaan">
<span<?= $Page->skor_kelembagaan->viewAttributes() ?>>
<?= $Page->skor_kelembagaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <td <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_maxskor_kelembagaan" class="temp_skor_kelembagaan_maxskor_kelembagaan">
<span<?= $Page->maxskor_kelembagaan->viewAttributes() ?>>
<?= $Page->maxskor_kelembagaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <td <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelembagaan_bobot_kelembagaan" class="temp_skor_kelembagaan_bobot_kelembagaan">
<span<?= $Page->bobot_kelembagaan->viewAttributes() ?>>
<?= $Page->bobot_kelembagaan->getViewValue() ?></span>
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
