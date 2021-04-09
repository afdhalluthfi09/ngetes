<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelasDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelasdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_kelasdelete = currentForm = new ew.Form("ftemp_skor_kelasdelete", "delete");
    loadjs.done("ftemp_skor_kelasdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_kelas) ew.vars.tables.temp_skor_kelas = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelas")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_kelasdelete" id="ftemp_skor_kelasdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelas">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_temp_skor_kelas_NIK" class="temp_skor_kelas_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <th class="<?= $Page->NAMA_PEMILIK->headerCellClass() ?>"><span id="elh_temp_skor_kelas_NAMA_PEMILIK" class="temp_skor_kelas_NAMA_PEMILIK"><?= $Page->NAMA_PEMILIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <th class="<?= $Page->NO_HP->headerCellClass() ?>"><span id="elh_temp_skor_kelas_NO_HP" class="temp_skor_kelas_NO_HP"><?= $Page->NO_HP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <th class="<?= $Page->NAMA_USAHA->headerCellClass() ?>"><span id="elh_temp_skor_kelas_NAMA_USAHA" class="temp_skor_kelas_NAMA_USAHA"><?= $Page->NAMA_USAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <th class="<?= $Page->KALURAHAN->headerCellClass() ?>"><span id="elh_temp_skor_kelas_KALURAHAN" class="temp_skor_kelas_KALURAHAN"><?= $Page->KALURAHAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <th class="<?= $Page->KAPANEWON->headerCellClass() ?>"><span id="elh_temp_skor_kelas_KAPANEWON" class="temp_skor_kelas_KAPANEWON"><?= $Page->KAPANEWON->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <th class="<?= $Page->skor_produksi->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_produksi" class="temp_skor_kelas_skor_produksi"><?= $Page->skor_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <th class="<?= $Page->maxskor_produksi->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_produksi" class="temp_skor_kelas_maxskor_produksi"><?= $Page->maxskor_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <th class="<?= $Page->bobot_produksi->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_produksi" class="temp_skor_kelas_bobot_produksi"><?= $Page->bobot_produksi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <th class="<?= $Page->skor_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_pemasaran" class="temp_skor_kelas_skor_pemasaran"><?= $Page->skor_pemasaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <th class="<?= $Page->maxskor_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_pemasaran" class="temp_skor_kelas_maxskor_pemasaran"><?= $Page->maxskor_pemasaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <th class="<?= $Page->bobot_pemasaran->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_pemasaran" class="temp_skor_kelas_bobot_pemasaran"><?= $Page->bobot_pemasaran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <th class="<?= $Page->skor_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_pemasaranonline" class="temp_skor_kelas_skor_pemasaranonline"><?= $Page->skor_pemasaranonline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <th class="<?= $Page->maxskor_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_pemasaranonline" class="temp_skor_kelas_maxskor_pemasaranonline"><?= $Page->maxskor_pemasaranonline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <th class="<?= $Page->bobot_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_pemasaranonline" class="temp_skor_kelas_bobot_pemasaranonline"><?= $Page->bobot_pemasaranonline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <th class="<?= $Page->skor_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_kelembagaan" class="temp_skor_kelas_skor_kelembagaan"><?= $Page->skor_kelembagaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <th class="<?= $Page->maxskor_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_kelembagaan" class="temp_skor_kelas_maxskor_kelembagaan"><?= $Page->maxskor_kelembagaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <th class="<?= $Page->bobot_kelembagaan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_kelembagaan" class="temp_skor_kelas_bobot_kelembagaan"><?= $Page->bobot_kelembagaan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <th class="<?= $Page->skor_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_keuangan" class="temp_skor_kelas_skor_keuangan"><?= $Page->skor_keuangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <th class="<?= $Page->maxskor_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_keuangan" class="temp_skor_kelas_maxskor_keuangan"><?= $Page->maxskor_keuangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <th class="<?= $Page->bobot_keuangan->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_keuangan" class="temp_skor_kelas_bobot_keuangan"><?= $Page->bobot_keuangan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <th class="<?= $Page->skor_sdm->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_sdm" class="temp_skor_kelas_skor_sdm"><?= $Page->skor_sdm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <th class="<?= $Page->maxskor_sdm->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_sdm" class="temp_skor_kelas_maxskor_sdm"><?= $Page->maxskor_sdm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <th class="<?= $Page->bobot_sdm->headerCellClass() ?>"><span id="elh_temp_skor_kelas_bobot_sdm" class="temp_skor_kelas_bobot_sdm"><?= $Page->bobot_sdm->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
        <th class="<?= $Page->skor_kelas->headerCellClass() ?>"><span id="elh_temp_skor_kelas_skor_kelas" class="temp_skor_kelas_skor_kelas"><?= $Page->skor_kelas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
        <th class="<?= $Page->maxskor_kelas->headerCellClass() ?>"><span id="elh_temp_skor_kelas_maxskor_kelas" class="temp_skor_kelas_maxskor_kelas"><?= $Page->maxskor_kelas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
        <th class="<?= $Page->kelas_umkm->headerCellClass() ?>"><span id="elh_temp_skor_kelas_kelas_umkm" class="temp_skor_kelas_kelas_umkm"><?= $Page->kelas_umkm->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NIK" class="temp_skor_kelas_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <td <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NAMA_PEMILIK" class="temp_skor_kelas_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <td <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NO_HP" class="temp_skor_kelas_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <td <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NAMA_USAHA" class="temp_skor_kelas_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <td <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_KALURAHAN" class="temp_skor_kelas_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <td <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_KAPANEWON" class="temp_skor_kelas_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <td <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_produksi" class="temp_skor_kelas_skor_produksi">
<span<?= $Page->skor_produksi->viewAttributes() ?>>
<?= $Page->skor_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <td <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_produksi" class="temp_skor_kelas_maxskor_produksi">
<span<?= $Page->maxskor_produksi->viewAttributes() ?>>
<?= $Page->maxskor_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <td <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_produksi" class="temp_skor_kelas_bobot_produksi">
<span<?= $Page->bobot_produksi->viewAttributes() ?>>
<?= $Page->bobot_produksi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <td <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_pemasaran" class="temp_skor_kelas_skor_pemasaran">
<span<?= $Page->skor_pemasaran->viewAttributes() ?>>
<?= $Page->skor_pemasaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <td <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_pemasaran" class="temp_skor_kelas_maxskor_pemasaran">
<span<?= $Page->maxskor_pemasaran->viewAttributes() ?>>
<?= $Page->maxskor_pemasaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <td <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_pemasaran" class="temp_skor_kelas_bobot_pemasaran">
<span<?= $Page->bobot_pemasaran->viewAttributes() ?>>
<?= $Page->bobot_pemasaran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <td <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_pemasaranonline" class="temp_skor_kelas_skor_pemasaranonline">
<span<?= $Page->skor_pemasaranonline->viewAttributes() ?>>
<?= $Page->skor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <td <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_pemasaranonline" class="temp_skor_kelas_maxskor_pemasaranonline">
<span<?= $Page->maxskor_pemasaranonline->viewAttributes() ?>>
<?= $Page->maxskor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <td <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_pemasaranonline" class="temp_skor_kelas_bobot_pemasaranonline">
<span<?= $Page->bobot_pemasaranonline->viewAttributes() ?>>
<?= $Page->bobot_pemasaranonline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <td <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_kelembagaan" class="temp_skor_kelas_skor_kelembagaan">
<span<?= $Page->skor_kelembagaan->viewAttributes() ?>>
<?= $Page->skor_kelembagaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <td <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_kelembagaan" class="temp_skor_kelas_maxskor_kelembagaan">
<span<?= $Page->maxskor_kelembagaan->viewAttributes() ?>>
<?= $Page->maxskor_kelembagaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <td <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_kelembagaan" class="temp_skor_kelas_bobot_kelembagaan">
<span<?= $Page->bobot_kelembagaan->viewAttributes() ?>>
<?= $Page->bobot_kelembagaan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <td <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_keuangan" class="temp_skor_kelas_skor_keuangan">
<span<?= $Page->skor_keuangan->viewAttributes() ?>>
<?= $Page->skor_keuangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <td <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_keuangan" class="temp_skor_kelas_maxskor_keuangan">
<span<?= $Page->maxskor_keuangan->viewAttributes() ?>>
<?= $Page->maxskor_keuangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <td <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_keuangan" class="temp_skor_kelas_bobot_keuangan">
<span<?= $Page->bobot_keuangan->viewAttributes() ?>>
<?= $Page->bobot_keuangan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <td <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_sdm" class="temp_skor_kelas_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <td <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_sdm" class="temp_skor_kelas_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <td <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_sdm" class="temp_skor_kelas_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
        <td <?= $Page->skor_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_kelas" class="temp_skor_kelas_skor_kelas">
<span<?= $Page->skor_kelas->viewAttributes() ?>>
<?= $Page->skor_kelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
        <td <?= $Page->maxskor_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_kelas" class="temp_skor_kelas_maxskor_kelas">
<span<?= $Page->maxskor_kelas->viewAttributes() ?>>
<?= $Page->maxskor_kelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
        <td <?= $Page->kelas_umkm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_kelas_umkm" class="temp_skor_kelas_kelas_umkm">
<span<?= $Page->kelas_umkm->viewAttributes() ?>>
<?= $Page->kelas_umkm->getViewValue() ?></span>
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
