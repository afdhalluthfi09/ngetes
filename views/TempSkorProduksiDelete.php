<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorProduksiDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_produksidelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_produksidelete = currentForm = new ew.Form("ftemp_skor_produksidelete", "delete");
    loadjs.done("ftemp_skor_produksidelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_produksi) ew.vars.tables.temp_skor_produksi = <?= JsonEncode(GetClientVar("tables", "temp_skor_produksi")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_produksidelete" id="ftemp_skor_produksidelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_produksi">
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
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_produksi_nik" class="temp_skor_produksi_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
        <th class="<?= $Page->skor_aktifitas->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_aktifitas" class="temp_skor_produksi_skor_aktifitas"><?= $Page->skor_aktifitas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
        <th class="<?= $Page->max_aktifitas->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_aktifitas" class="temp_skor_produksi_max_aktifitas"><?= $Page->max_aktifitas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
        <th class="<?= $Page->skor_kapasitas->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_kapasitas" class="temp_skor_produksi_skor_kapasitas"><?= $Page->skor_kapasitas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
        <th class="<?= $Page->max_kapasitas->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_kapasitas" class="temp_skor_produksi_max_kapasitas"><?= $Page->max_kapasitas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
        <th class="<?= $Page->skor_pangan->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_pangan" class="temp_skor_produksi_skor_pangan"><?= $Page->skor_pangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_pangan->Visible) { // max_pangan ?>
        <th class="<?= $Page->max_pangan->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_pangan" class="temp_skor_produksi_max_pangan"><?= $Page->max_pangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_sni->Visible) { // skor_sni ?>
        <th class="<?= $Page->skor_sni->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_sni" class="temp_skor_produksi_skor_sni"><?= $Page->skor_sni->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_sni->Visible) { // max_sni ?>
        <th class="<?= $Page->max_sni->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_sni" class="temp_skor_produksi_max_sni"><?= $Page->max_sni->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
        <th class="<?= $Page->skor_kemasan->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_kemasan" class="temp_skor_produksi_skor_kemasan"><?= $Page->skor_kemasan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
        <th class="<?= $Page->max_kemasan->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_kemasan" class="temp_skor_produksi_max_kemasan"><?= $Page->max_kemasan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
        <th class="<?= $Page->skor_bahanbaku->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_bahanbaku" class="temp_skor_produksi_skor_bahanbaku"><?= $Page->skor_bahanbaku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
        <th class="<?= $Page->max_bahanbaku->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_bahanbaku" class="temp_skor_produksi_max_bahanbaku"><?= $Page->max_bahanbaku->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_alat->Visible) { // skor_alat ?>
        <th class="<?= $Page->skor_alat->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_alat" class="temp_skor_produksi_skor_alat"><?= $Page->skor_alat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_alat->Visible) { // max_alat ?>
        <th class="<?= $Page->max_alat->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_alat" class="temp_skor_produksi_max_alat"><?= $Page->max_alat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
        <th class="<?= $Page->skor_gudang->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_gudang" class="temp_skor_produksi_skor_gudang"><?= $Page->skor_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_gudang->Visible) { // max_gudang ?>
        <th class="<?= $Page->max_gudang->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_gudang" class="temp_skor_produksi_max_gudang"><?= $Page->max_gudang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_layout->Visible) { // skor_layout ?>
        <th class="<?= $Page->skor_layout->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_layout" class="temp_skor_produksi_skor_layout"><?= $Page->skor_layout->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_layout->Visible) { // max_layout ?>
        <th class="<?= $Page->max_layout->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_layout" class="temp_skor_produksi_max_layout"><?= $Page->max_layout->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_sop->Visible) { // skor_sop ?>
        <th class="<?= $Page->skor_sop->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_sop" class="temp_skor_produksi_skor_sop"><?= $Page->skor_sop->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_sop->Visible) { // max_sop ?>
        <th class="<?= $Page->max_sop->headerCellClass() ?>"><span id="elh_temp_skor_produksi_max_sop" class="temp_skor_produksi_max_sop"><?= $Page->max_sop->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <th class="<?= $Page->skor_produksi->headerCellClass() ?>"><span id="elh_temp_skor_produksi_skor_produksi" class="temp_skor_produksi_skor_produksi"><?= $Page->skor_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <th class="<?= $Page->maxskor_produksi->headerCellClass() ?>"><span id="elh_temp_skor_produksi_maxskor_produksi" class="temp_skor_produksi_maxskor_produksi"><?= $Page->maxskor_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <th class="<?= $Page->bobot_produksi->headerCellClass() ?>"><span id="elh_temp_skor_produksi_bobot_produksi" class="temp_skor_produksi_bobot_produksi"><?= $Page->bobot_produksi->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_nik" class="temp_skor_produksi_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
        <td <?= $Page->skor_aktifitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_aktifitas" class="temp_skor_produksi_skor_aktifitas">
<span<?= $Page->skor_aktifitas->viewAttributes() ?>>
<?= $Page->skor_aktifitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
        <td <?= $Page->max_aktifitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_aktifitas" class="temp_skor_produksi_max_aktifitas">
<span<?= $Page->max_aktifitas->viewAttributes() ?>>
<?= $Page->max_aktifitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
        <td <?= $Page->skor_kapasitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_kapasitas" class="temp_skor_produksi_skor_kapasitas">
<span<?= $Page->skor_kapasitas->viewAttributes() ?>>
<?= $Page->skor_kapasitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
        <td <?= $Page->max_kapasitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_kapasitas" class="temp_skor_produksi_max_kapasitas">
<span<?= $Page->max_kapasitas->viewAttributes() ?>>
<?= $Page->max_kapasitas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
        <td <?= $Page->skor_pangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_pangan" class="temp_skor_produksi_skor_pangan">
<span<?= $Page->skor_pangan->viewAttributes() ?>>
<?= $Page->skor_pangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_pangan->Visible) { // max_pangan ?>
        <td <?= $Page->max_pangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_pangan" class="temp_skor_produksi_max_pangan">
<span<?= $Page->max_pangan->viewAttributes() ?>>
<?= $Page->max_pangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_sni->Visible) { // skor_sni ?>
        <td <?= $Page->skor_sni->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_sni" class="temp_skor_produksi_skor_sni">
<span<?= $Page->skor_sni->viewAttributes() ?>>
<?= $Page->skor_sni->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_sni->Visible) { // max_sni ?>
        <td <?= $Page->max_sni->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_sni" class="temp_skor_produksi_max_sni">
<span<?= $Page->max_sni->viewAttributes() ?>>
<?= $Page->max_sni->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
        <td <?= $Page->skor_kemasan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_kemasan" class="temp_skor_produksi_skor_kemasan">
<span<?= $Page->skor_kemasan->viewAttributes() ?>>
<?= $Page->skor_kemasan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
        <td <?= $Page->max_kemasan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_kemasan" class="temp_skor_produksi_max_kemasan">
<span<?= $Page->max_kemasan->viewAttributes() ?>>
<?= $Page->max_kemasan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
        <td <?= $Page->skor_bahanbaku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_bahanbaku" class="temp_skor_produksi_skor_bahanbaku">
<span<?= $Page->skor_bahanbaku->viewAttributes() ?>>
<?= $Page->skor_bahanbaku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
        <td <?= $Page->max_bahanbaku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_bahanbaku" class="temp_skor_produksi_max_bahanbaku">
<span<?= $Page->max_bahanbaku->viewAttributes() ?>>
<?= $Page->max_bahanbaku->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_alat->Visible) { // skor_alat ?>
        <td <?= $Page->skor_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_alat" class="temp_skor_produksi_skor_alat">
<span<?= $Page->skor_alat->viewAttributes() ?>>
<?= $Page->skor_alat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_alat->Visible) { // max_alat ?>
        <td <?= $Page->max_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_alat" class="temp_skor_produksi_max_alat">
<span<?= $Page->max_alat->viewAttributes() ?>>
<?= $Page->max_alat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
        <td <?= $Page->skor_gudang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_gudang" class="temp_skor_produksi_skor_gudang">
<span<?= $Page->skor_gudang->viewAttributes() ?>>
<?= $Page->skor_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_gudang->Visible) { // max_gudang ?>
        <td <?= $Page->max_gudang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_gudang" class="temp_skor_produksi_max_gudang">
<span<?= $Page->max_gudang->viewAttributes() ?>>
<?= $Page->max_gudang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_layout->Visible) { // skor_layout ?>
        <td <?= $Page->skor_layout->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_layout" class="temp_skor_produksi_skor_layout">
<span<?= $Page->skor_layout->viewAttributes() ?>>
<?= $Page->skor_layout->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_layout->Visible) { // max_layout ?>
        <td <?= $Page->max_layout->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_layout" class="temp_skor_produksi_max_layout">
<span<?= $Page->max_layout->viewAttributes() ?>>
<?= $Page->max_layout->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_sop->Visible) { // skor_sop ?>
        <td <?= $Page->skor_sop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_sop" class="temp_skor_produksi_skor_sop">
<span<?= $Page->skor_sop->viewAttributes() ?>>
<?= $Page->skor_sop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_sop->Visible) { // max_sop ?>
        <td <?= $Page->max_sop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_max_sop" class="temp_skor_produksi_max_sop">
<span<?= $Page->max_sop->viewAttributes() ?>>
<?= $Page->max_sop->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <td <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_skor_produksi" class="temp_skor_produksi_skor_produksi">
<span<?= $Page->skor_produksi->viewAttributes() ?>>
<?= $Page->skor_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <td <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_maxskor_produksi" class="temp_skor_produksi_maxskor_produksi">
<span<?= $Page->maxskor_produksi->viewAttributes() ?>>
<?= $Page->maxskor_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <td <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_produksi_bobot_produksi" class="temp_skor_produksi_bobot_produksi">
<span<?= $Page->bobot_produksi->viewAttributes() ?>>
<?= $Page->bobot_produksi->getViewValue() ?></span>
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
