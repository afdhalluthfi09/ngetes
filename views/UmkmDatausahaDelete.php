<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmDatausahaDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_datausahadelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_datausahadelete = currentForm = new ew.Form("fumkm_datausahadelete", "delete");
    loadjs.done("fumkm_datausahadelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_datausaha) ew.vars.tables.umkm_datausaha = <?= JsonEncode(GetClientVar("tables", "umkm_datausaha")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_datausahadelete" id="fumkm_datausahadelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_datausaha">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_datausaha_NIK" class="umkm_datausaha_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <th class="<?= $Page->NAMA_USAHA->headerCellClass() ?>"><span id="elh_umkm_datausaha_NAMA_USAHA" class="umkm_datausaha_NAMA_USAHA"><?= $Page->NAMA_USAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <th class="<?= $Page->TAHUN_MULAI_USAHA->headerCellClass() ?>"><span id="elh_umkm_datausaha_TAHUN_MULAI_USAHA" class="umkm_datausaha_TAHUN_MULAI_USAHA"><?= $Page->TAHUN_MULAI_USAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <th class="<?= $Page->NO_IZIN_USAHA->headerCellClass() ?>"><span id="elh_umkm_datausaha_NO_IZIN_USAHA" class="umkm_datausaha_NO_IZIN_USAHA"><?= $Page->NO_IZIN_USAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SEKTOR->Visible) { // SEKTOR ?>
        <th class="<?= $Page->SEKTOR->headerCellClass() ?>"><span id="elh_umkm_datausaha_SEKTOR" class="umkm_datausaha_SEKTOR"><?= $Page->SEKTOR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <th class="<?= $Page->SEKTOR_PERGUB->headerCellClass() ?>"><span id="elh_umkm_datausaha_SEKTOR_PERGUB" class="umkm_datausaha_SEKTOR_PERGUB"><?= $Page->SEKTOR_PERGUB->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <th class="<?= $Page->SEKTOR_KBLI->headerCellClass() ?>"><span id="elh_umkm_datausaha_SEKTOR_KBLI" class="umkm_datausaha_SEKTOR_KBLI"><?= $Page->SEKTOR_KBLI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <th class="<?= $Page->SEKTOR_EKRAF->headerCellClass() ?>"><span id="elh_umkm_datausaha_SEKTOR_EKRAF" class="umkm_datausaha_SEKTOR_EKRAF"><?= $Page->SEKTOR_EKRAF->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <th class="<?= $Page->KAPANEWON->headerCellClass() ?>"><span id="elh_umkm_datausaha_KAPANEWON" class="umkm_datausaha_KAPANEWON"><?= $Page->KAPANEWON->caption() ?></span></th>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <th class="<?= $Page->KALURAHAN->headerCellClass() ?>"><span id="elh_umkm_datausaha_KALURAHAN" class="umkm_datausaha_KALURAHAN"><?= $Page->KALURAHAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DUSUN->Visible) { // DUSUN ?>
        <th class="<?= $Page->DUSUN->headerCellClass() ?>"><span id="elh_umkm_datausaha_DUSUN" class="umkm_datausaha_DUSUN"><?= $Page->DUSUN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <th class="<?= $Page->ALAMAT->headerCellClass() ?>"><span id="elh_umkm_datausaha_ALAMAT" class="umkm_datausaha_ALAMAT"><?= $Page->ALAMAT->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <th class="<?= $Page->TENAGA_KERJA_LAKILAKI->headerCellClass() ?>"><span id="elh_umkm_datausaha_TENAGA_KERJA_LAKILAKI" class="umkm_datausaha_TENAGA_KERJA_LAKILAKI"><?= $Page->TENAGA_KERJA_LAKILAKI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <th class="<?= $Page->TENAGA_KERJA_PEREMPUAN->headerCellClass() ?>"><span id="elh_umkm_datausaha_TENAGA_KERJA_PEREMPUAN" class="umkm_datausaha_TENAGA_KERJA_PEREMPUAN"><?= $Page->TENAGA_KERJA_PEREMPUAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <th class="<?= $Page->MODAL_KERJA->headerCellClass() ?>"><span id="elh_umkm_datausaha_MODAL_KERJA" class="umkm_datausaha_MODAL_KERJA"><?= $Page->MODAL_KERJA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <th class="<?= $Page->OMZET_RATARATA_PERTAHUN->headerCellClass() ?>"><span id="elh_umkm_datausaha_OMZET_RATARATA_PERTAHUN" class="umkm_datausaha_OMZET_RATARATA_PERTAHUN"><?= $Page->OMZET_RATARATA_PERTAHUN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <th class="<?= $Page->STATUS_USAHA->headerCellClass() ?>"><span id="elh_umkm_datausaha_STATUS_USAHA" class="umkm_datausaha_STATUS_USAHA"><?= $Page->STATUS_USAHA->caption() ?></span></th>
<?php } ?>
<?php if ($Page->ASET->Visible) { // ASET ?>
        <th class="<?= $Page->ASET->headerCellClass() ?>"><span id="elh_umkm_datausaha_ASET" class="umkm_datausaha_ASET"><?= $Page->ASET->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NIK" class="umkm_datausaha_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <td <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NAMA_USAHA" class="umkm_datausaha_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <td <?= $Page->TAHUN_MULAI_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA" class="umkm_datausaha_TAHUN_MULAI_USAHA">
<span<?= $Page->TAHUN_MULAI_USAHA->viewAttributes() ?>>
<?= $Page->TAHUN_MULAI_USAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <td <?= $Page->NO_IZIN_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA" class="umkm_datausaha_NO_IZIN_USAHA">
<span<?= $Page->NO_IZIN_USAHA->viewAttributes() ?>>
<?= $Page->NO_IZIN_USAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SEKTOR->Visible) { // SEKTOR ?>
        <td <?= $Page->SEKTOR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR" class="umkm_datausaha_SEKTOR">
<span<?= $Page->SEKTOR->viewAttributes() ?>>
<?= $Page->SEKTOR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <td <?= $Page->SEKTOR_PERGUB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB" class="umkm_datausaha_SEKTOR_PERGUB">
<span<?= $Page->SEKTOR_PERGUB->viewAttributes() ?>>
<?= $Page->SEKTOR_PERGUB->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <td <?= $Page->SEKTOR_KBLI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_KBLI" class="umkm_datausaha_SEKTOR_KBLI">
<span<?= $Page->SEKTOR_KBLI->viewAttributes() ?>>
<?= $Page->SEKTOR_KBLI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <td <?= $Page->SEKTOR_EKRAF->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF" class="umkm_datausaha_SEKTOR_EKRAF">
<span<?= $Page->SEKTOR_EKRAF->viewAttributes() ?>>
<?= $Page->SEKTOR_EKRAF->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <td <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KAPANEWON" class="umkm_datausaha_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <td <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KALURAHAN" class="umkm_datausaha_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DUSUN->Visible) { // DUSUN ?>
        <td <?= $Page->DUSUN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_DUSUN" class="umkm_datausaha_DUSUN">
<span<?= $Page->DUSUN->viewAttributes() ?>>
<?= $Page->DUSUN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <td <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ALAMAT" class="umkm_datausaha_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <td <?= $Page->TENAGA_KERJA_LAKILAKI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI" class="umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<span<?= $Page->TENAGA_KERJA_LAKILAKI->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_LAKILAKI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <td <?= $Page->TENAGA_KERJA_PEREMPUAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN" class="umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<span<?= $Page->TENAGA_KERJA_PEREMPUAN->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_PEREMPUAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <td <?= $Page->MODAL_KERJA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_MODAL_KERJA" class="umkm_datausaha_MODAL_KERJA">
<span<?= $Page->MODAL_KERJA->viewAttributes() ?>>
<?= $Page->MODAL_KERJA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <td <?= $Page->OMZET_RATARATA_PERTAHUN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN" class="umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<span<?= $Page->OMZET_RATARATA_PERTAHUN->viewAttributes() ?>>
<?= $Page->OMZET_RATARATA_PERTAHUN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <td <?= $Page->STATUS_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_STATUS_USAHA" class="umkm_datausaha_STATUS_USAHA">
<span<?= $Page->STATUS_USAHA->viewAttributes() ?>>
<?= $Page->STATUS_USAHA->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->ASET->Visible) { // ASET ?>
        <td <?= $Page->ASET->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ASET" class="umkm_datausaha_ASET">
<span<?= $Page->ASET->viewAttributes() ?>>
<?= $Page->ASET->getViewValue() ?></span>
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
