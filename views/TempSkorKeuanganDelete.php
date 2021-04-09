<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKeuanganDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_keuangandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_keuangandelete = currentForm = new ew.Form("ftemp_skor_keuangandelete", "delete");
    loadjs.done("ftemp_skor_keuangandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_keuangan) ew.vars.tables.temp_skor_keuangan = <?= JsonEncode(GetClientVar("tables", "temp_skor_keuangan")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_keuangandelete" id="ftemp_skor_keuangandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_keuangan">
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
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_nik" class="temp_skor_keuangan_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_income->Visible) { // skor_income ?>
        <th class="<?= $Page->skor_income->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_income" class="temp_skor_keuangan_skor_income"><?= $Page->skor_income->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_income->Visible) { // max_income ?>
        <th class="<?= $Page->max_income->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_income" class="temp_skor_keuangan_max_income"><?= $Page->max_income->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
        <th class="<?= $Page->skor_pengelolaan->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_pengelolaan" class="temp_skor_keuangan_skor_pengelolaan"><?= $Page->skor_pengelolaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
        <th class="<?= $Page->max_pengelolaan->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_pengelolaan" class="temp_skor_keuangan_max_pengelolaan"><?= $Page->max_pengelolaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_nota->Visible) { // skor_nota ?>
        <th class="<?= $Page->skor_nota->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_nota" class="temp_skor_keuangan_skor_nota"><?= $Page->skor_nota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_nota->Visible) { // max_nota ?>
        <th class="<?= $Page->max_nota->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_nota" class="temp_skor_keuangan_max_nota"><?= $Page->max_nota->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
        <th class="<?= $Page->skor_jurnal->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_jurnal" class="temp_skor_keuangan_skor_jurnal"><?= $Page->skor_jurnal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
        <th class="<?= $Page->max_jurnal->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_jurnal" class="temp_skor_keuangan_max_jurnal"><?= $Page->max_jurnal->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
        <th class="<?= $Page->skor_akutansi->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_akutansi" class="temp_skor_keuangan_skor_akutansi"><?= $Page->skor_akutansi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
        <th class="<?= $Page->max_akutansi->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_akutansi" class="temp_skor_keuangan_max_akutansi"><?= $Page->max_akutansi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
        <th class="<?= $Page->skor_utangbank->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_utangbank" class="temp_skor_keuangan_skor_utangbank"><?= $Page->skor_utangbank->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
        <th class="<?= $Page->max_utangbank->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_utangbank" class="temp_skor_keuangan_max_utangbank"><?= $Page->max_utangbank->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
        <th class="<?= $Page->skor_dokumentasi->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_dokumentasi" class="temp_skor_keuangan_skor_dokumentasi"><?= $Page->skor_dokumentasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
        <th class="<?= $Page->max_dokumentasi->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_dokumentasi" class="temp_skor_keuangan_max_dokumentasi"><?= $Page->max_dokumentasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
        <th class="<?= $Page->skor_nontunai->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_nontunai" class="temp_skor_keuangan_skor_nontunai"><?= $Page->skor_nontunai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
        <th class="<?= $Page->max_nontunai->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_max_nontunai" class="temp_skor_keuangan_max_nontunai"><?= $Page->max_nontunai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <th class="<?= $Page->skor_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_skor_keuangan" class="temp_skor_keuangan_skor_keuangan"><?= $Page->skor_keuangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <th class="<?= $Page->maxskor_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_maxskor_keuangan" class="temp_skor_keuangan_maxskor_keuangan"><?= $Page->maxskor_keuangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <th class="<?= $Page->bobot_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_keuangan_bobot_keuangan" class="temp_skor_keuangan_bobot_keuangan"><?= $Page->bobot_keuangan->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_nik" class="temp_skor_keuangan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_income->Visible) { // skor_income ?>
        <td <?= $Page->skor_income->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_income" class="temp_skor_keuangan_skor_income">
<span<?= $Page->skor_income->viewAttributes() ?>>
<?= $Page->skor_income->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_income->Visible) { // max_income ?>
        <td <?= $Page->max_income->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_income" class="temp_skor_keuangan_max_income">
<span<?= $Page->max_income->viewAttributes() ?>>
<?= $Page->max_income->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
        <td <?= $Page->skor_pengelolaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_pengelolaan" class="temp_skor_keuangan_skor_pengelolaan">
<span<?= $Page->skor_pengelolaan->viewAttributes() ?>>
<?= $Page->skor_pengelolaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
        <td <?= $Page->max_pengelolaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_pengelolaan" class="temp_skor_keuangan_max_pengelolaan">
<span<?= $Page->max_pengelolaan->viewAttributes() ?>>
<?= $Page->max_pengelolaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_nota->Visible) { // skor_nota ?>
        <td <?= $Page->skor_nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_nota" class="temp_skor_keuangan_skor_nota">
<span<?= $Page->skor_nota->viewAttributes() ?>>
<?= $Page->skor_nota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_nota->Visible) { // max_nota ?>
        <td <?= $Page->max_nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_nota" class="temp_skor_keuangan_max_nota">
<span<?= $Page->max_nota->viewAttributes() ?>>
<?= $Page->max_nota->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
        <td <?= $Page->skor_jurnal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_jurnal" class="temp_skor_keuangan_skor_jurnal">
<span<?= $Page->skor_jurnal->viewAttributes() ?>>
<?= $Page->skor_jurnal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
        <td <?= $Page->max_jurnal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_jurnal" class="temp_skor_keuangan_max_jurnal">
<span<?= $Page->max_jurnal->viewAttributes() ?>>
<?= $Page->max_jurnal->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
        <td <?= $Page->skor_akutansi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_akutansi" class="temp_skor_keuangan_skor_akutansi">
<span<?= $Page->skor_akutansi->viewAttributes() ?>>
<?= $Page->skor_akutansi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
        <td <?= $Page->max_akutansi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_akutansi" class="temp_skor_keuangan_max_akutansi">
<span<?= $Page->max_akutansi->viewAttributes() ?>>
<?= $Page->max_akutansi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
        <td <?= $Page->skor_utangbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_utangbank" class="temp_skor_keuangan_skor_utangbank">
<span<?= $Page->skor_utangbank->viewAttributes() ?>>
<?= $Page->skor_utangbank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
        <td <?= $Page->max_utangbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_utangbank" class="temp_skor_keuangan_max_utangbank">
<span<?= $Page->max_utangbank->viewAttributes() ?>>
<?= $Page->max_utangbank->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
        <td <?= $Page->skor_dokumentasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_dokumentasi" class="temp_skor_keuangan_skor_dokumentasi">
<span<?= $Page->skor_dokumentasi->viewAttributes() ?>>
<?= $Page->skor_dokumentasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
        <td <?= $Page->max_dokumentasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_dokumentasi" class="temp_skor_keuangan_max_dokumentasi">
<span<?= $Page->max_dokumentasi->viewAttributes() ?>>
<?= $Page->max_dokumentasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
        <td <?= $Page->skor_nontunai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_nontunai" class="temp_skor_keuangan_skor_nontunai">
<span<?= $Page->skor_nontunai->viewAttributes() ?>>
<?= $Page->skor_nontunai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
        <td <?= $Page->max_nontunai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_max_nontunai" class="temp_skor_keuangan_max_nontunai">
<span<?= $Page->max_nontunai->viewAttributes() ?>>
<?= $Page->max_nontunai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <td <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_skor_keuangan" class="temp_skor_keuangan_skor_keuangan">
<span<?= $Page->skor_keuangan->viewAttributes() ?>>
<?= $Page->skor_keuangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <td <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_maxskor_keuangan" class="temp_skor_keuangan_maxskor_keuangan">
<span<?= $Page->maxskor_keuangan->viewAttributes() ?>>
<?= $Page->maxskor_keuangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <td <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_keuangan_bobot_keuangan" class="temp_skor_keuangan_bobot_keuangan">
<span<?= $Page->bobot_keuangan->viewAttributes() ?>>
<?= $Page->bobot_keuangan->getViewValue() ?></span>
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
