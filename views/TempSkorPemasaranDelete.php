<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasarandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_pemasarandelete = currentForm = new ew.Form("ftemp_skor_pemasarandelete", "delete");
    loadjs.done("ftemp_skor_pemasarandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_pemasaran) ew.vars.tables.temp_skor_pemasaran = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaran")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_pemasarandelete" id="ftemp_skor_pemasarandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaran">
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
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_nik" class="temp_skor_pemasaran_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
        <th class="<?= $Page->skor_unggul->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_unggul" class="temp_skor_pemasaran_skor_unggul"><?= $Page->skor_unggul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_unggul->Visible) { // max_unggul ?>
        <th class="<?= $Page->max_unggul->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_unggul" class="temp_skor_pemasaran_max_unggul"><?= $Page->max_unggul->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <th class="<?= $Page->skor_target->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_target" class="temp_skor_pemasaran_skor_target"><?= $Page->skor_target->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <th class="<?= $Page->max_target->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_target" class="temp_skor_pemasaran_max_target"><?= $Page->max_target->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_available->Visible) { // skor_available ?>
        <th class="<?= $Page->skor_available->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_available" class="temp_skor_pemasaran_skor_available"><?= $Page->skor_available->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_available->Visible) { // max_available ?>
        <th class="<?= $Page->max_available->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_available" class="temp_skor_pemasaran_max_available"><?= $Page->max_available->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_merk->Visible) { // skor_merk ?>
        <th class="<?= $Page->skor_merk->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_merk" class="temp_skor_pemasaran_skor_merk"><?= $Page->skor_merk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_merk->Visible) { // max_merk ?>
        <th class="<?= $Page->max_merk->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_merk" class="temp_skor_pemasaran_max_merk"><?= $Page->max_merk->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
        <th class="<?= $Page->skor_merkhaki->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_merkhaki" class="temp_skor_pemasaran_skor_merkhaki"><?= $Page->skor_merkhaki->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
        <th class="<?= $Page->max_merkhaki->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_merkhaki" class="temp_skor_pemasaran_max_merkhaki"><?= $Page->max_merkhaki->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
        <th class="<?= $Page->skor_merkkonsep->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_merkkonsep" class="temp_skor_pemasaran_skor_merkkonsep"><?= $Page->skor_merkkonsep->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
        <th class="<?= $Page->max_merkkonsep->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_merkkonsep" class="temp_skor_pemasaran_max_merkkonsep"><?= $Page->max_merkkonsep->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
        <th class="<?= $Page->skor_merklisensi->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_merklisensi" class="temp_skor_pemasaran_skor_merklisensi"><?= $Page->skor_merklisensi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
        <th class="<?= $Page->max_merklisensi->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_merklisensi" class="temp_skor_pemasaran_max_merklisensi"><?= $Page->max_merklisensi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
        <th class="<?= $Page->skor_mitra->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_mitra" class="temp_skor_pemasaran_skor_mitra"><?= $Page->skor_mitra->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_mitra->Visible) { // max_mitra ?>
        <th class="<?= $Page->max_mitra->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_mitra" class="temp_skor_pemasaran_max_mitra"><?= $Page->max_mitra->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_market->Visible) { // skor_market ?>
        <th class="<?= $Page->skor_market->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_market" class="temp_skor_pemasaran_skor_market"><?= $Page->skor_market->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_market->Visible) { // max_market ?>
        <th class="<?= $Page->max_market->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_market" class="temp_skor_pemasaran_max_market"><?= $Page->max_market->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
        <th class="<?= $Page->skor_pelangganloyal->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_pelangganloyal" class="temp_skor_pemasaran_skor_pelangganloyal"><?= $Page->skor_pelangganloyal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
        <th class="<?= $Page->max_pelangganloyal->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_pelangganloyal" class="temp_skor_pemasaran_max_pelangganloyal"><?= $Page->max_pelangganloyal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
        <th class="<?= $Page->skor_pameranmandiri->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_pameranmandiri" class="temp_skor_pemasaran_skor_pameranmandiri"><?= $Page->skor_pameranmandiri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
        <th class="<?= $Page->max_pameranmandiri->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_pameranmandiri" class="temp_skor_pemasaran_max_pameranmandiri"><?= $Page->max_pameranmandiri->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
        <th class="<?= $Page->skor_mediaoffline->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_mediaoffline" class="temp_skor_pemasaran_skor_mediaoffline"><?= $Page->skor_mediaoffline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
        <th class="<?= $Page->max_mediaoffline->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_max_mediaoffline" class="temp_skor_pemasaran_max_mediaoffline"><?= $Page->max_mediaoffline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <th class="<?= $Page->skor_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_skor_pemasaran" class="temp_skor_pemasaran_skor_pemasaran"><?= $Page->skor_pemasaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <th class="<?= $Page->maxskor_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_maxskor_pemasaran" class="temp_skor_pemasaran_maxskor_pemasaran"><?= $Page->maxskor_pemasaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <th class="<?= $Page->bobot_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_pemasaran_bobot_pemasaran" class="temp_skor_pemasaran_bobot_pemasaran"><?= $Page->bobot_pemasaran->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_nik" class="temp_skor_pemasaran_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
        <td <?= $Page->skor_unggul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_unggul" class="temp_skor_pemasaran_skor_unggul">
<span<?= $Page->skor_unggul->viewAttributes() ?>>
<?= $Page->skor_unggul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_unggul->Visible) { // max_unggul ?>
        <td <?= $Page->max_unggul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_unggul" class="temp_skor_pemasaran_max_unggul">
<span<?= $Page->max_unggul->viewAttributes() ?>>
<?= $Page->max_unggul->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <td <?= $Page->skor_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_target" class="temp_skor_pemasaran_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <td <?= $Page->max_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_target" class="temp_skor_pemasaran_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_available->Visible) { // skor_available ?>
        <td <?= $Page->skor_available->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_available" class="temp_skor_pemasaran_skor_available">
<span<?= $Page->skor_available->viewAttributes() ?>>
<?= $Page->skor_available->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_available->Visible) { // max_available ?>
        <td <?= $Page->max_available->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_available" class="temp_skor_pemasaran_max_available">
<span<?= $Page->max_available->viewAttributes() ?>>
<?= $Page->max_available->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_merk->Visible) { // skor_merk ?>
        <td <?= $Page->skor_merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_merk" class="temp_skor_pemasaran_skor_merk">
<span<?= $Page->skor_merk->viewAttributes() ?>>
<?= $Page->skor_merk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_merk->Visible) { // max_merk ?>
        <td <?= $Page->max_merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_merk" class="temp_skor_pemasaran_max_merk">
<span<?= $Page->max_merk->viewAttributes() ?>>
<?= $Page->max_merk->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
        <td <?= $Page->skor_merkhaki->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_merkhaki" class="temp_skor_pemasaran_skor_merkhaki">
<span<?= $Page->skor_merkhaki->viewAttributes() ?>>
<?= $Page->skor_merkhaki->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
        <td <?= $Page->max_merkhaki->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_merkhaki" class="temp_skor_pemasaran_max_merkhaki">
<span<?= $Page->max_merkhaki->viewAttributes() ?>>
<?= $Page->max_merkhaki->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
        <td <?= $Page->skor_merkkonsep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_merkkonsep" class="temp_skor_pemasaran_skor_merkkonsep">
<span<?= $Page->skor_merkkonsep->viewAttributes() ?>>
<?= $Page->skor_merkkonsep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
        <td <?= $Page->max_merkkonsep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_merkkonsep" class="temp_skor_pemasaran_max_merkkonsep">
<span<?= $Page->max_merkkonsep->viewAttributes() ?>>
<?= $Page->max_merkkonsep->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
        <td <?= $Page->skor_merklisensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_merklisensi" class="temp_skor_pemasaran_skor_merklisensi">
<span<?= $Page->skor_merklisensi->viewAttributes() ?>>
<?= $Page->skor_merklisensi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
        <td <?= $Page->max_merklisensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_merklisensi" class="temp_skor_pemasaran_max_merklisensi">
<span<?= $Page->max_merklisensi->viewAttributes() ?>>
<?= $Page->max_merklisensi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
        <td <?= $Page->skor_mitra->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_mitra" class="temp_skor_pemasaran_skor_mitra">
<span<?= $Page->skor_mitra->viewAttributes() ?>>
<?= $Page->skor_mitra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_mitra->Visible) { // max_mitra ?>
        <td <?= $Page->max_mitra->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_mitra" class="temp_skor_pemasaran_max_mitra">
<span<?= $Page->max_mitra->viewAttributes() ?>>
<?= $Page->max_mitra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_market->Visible) { // skor_market ?>
        <td <?= $Page->skor_market->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_market" class="temp_skor_pemasaran_skor_market">
<span<?= $Page->skor_market->viewAttributes() ?>>
<?= $Page->skor_market->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_market->Visible) { // max_market ?>
        <td <?= $Page->max_market->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_market" class="temp_skor_pemasaran_max_market">
<span<?= $Page->max_market->viewAttributes() ?>>
<?= $Page->max_market->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
        <td <?= $Page->skor_pelangganloyal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_pelangganloyal" class="temp_skor_pemasaran_skor_pelangganloyal">
<span<?= $Page->skor_pelangganloyal->viewAttributes() ?>>
<?= $Page->skor_pelangganloyal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
        <td <?= $Page->max_pelangganloyal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_pelangganloyal" class="temp_skor_pemasaran_max_pelangganloyal">
<span<?= $Page->max_pelangganloyal->viewAttributes() ?>>
<?= $Page->max_pelangganloyal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
        <td <?= $Page->skor_pameranmandiri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_pameranmandiri" class="temp_skor_pemasaran_skor_pameranmandiri">
<span<?= $Page->skor_pameranmandiri->viewAttributes() ?>>
<?= $Page->skor_pameranmandiri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
        <td <?= $Page->max_pameranmandiri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_pameranmandiri" class="temp_skor_pemasaran_max_pameranmandiri">
<span<?= $Page->max_pameranmandiri->viewAttributes() ?>>
<?= $Page->max_pameranmandiri->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
        <td <?= $Page->skor_mediaoffline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_mediaoffline" class="temp_skor_pemasaran_skor_mediaoffline">
<span<?= $Page->skor_mediaoffline->viewAttributes() ?>>
<?= $Page->skor_mediaoffline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
        <td <?= $Page->max_mediaoffline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_max_mediaoffline" class="temp_skor_pemasaran_max_mediaoffline">
<span<?= $Page->max_mediaoffline->viewAttributes() ?>>
<?= $Page->max_mediaoffline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <td <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_skor_pemasaran" class="temp_skor_pemasaran_skor_pemasaran">
<span<?= $Page->skor_pemasaran->viewAttributes() ?>>
<?= $Page->skor_pemasaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <td <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_maxskor_pemasaran" class="temp_skor_pemasaran_maxskor_pemasaran">
<span<?= $Page->maxskor_pemasaran->viewAttributes() ?>>
<?= $Page->maxskor_pemasaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <td <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaran_bobot_pemasaran" class="temp_skor_pemasaran_bobot_pemasaran">
<span<?= $Page->bobot_pemasaran->viewAttributes() ?>>
<?= $Page->bobot_pemasaran->getViewValue() ?></span>
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
