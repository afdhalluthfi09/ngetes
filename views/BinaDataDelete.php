<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaDataDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbina_datadelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fbina_datadelete = currentForm = new ew.Form("fbina_datadelete", "delete");
    loadjs.done("fbina_datadelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.bina_data) ew.vars.tables.bina_data = <?= JsonEncode(GetClientVar("tables", "bina_data")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fbina_datadelete" id="fbina_datadelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_data">
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
<?php if ($Page->id->Visible) { // id ?>
        <th class="<?= $Page->id->headerCellClass() ?>"><span id="elh_bina_data_id" class="bina_data_id"><?= $Page->id->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idperiode->Visible) { // idperiode ?>
        <th class="<?= $Page->idperiode->headerCellClass() ?>"><span id="elh_bina_data_idperiode" class="bina_data_idperiode"><?= $Page->idperiode->caption() ?></span></th>
<?php } ?>
<?php if ($Page->idkelompok->Visible) { // idkelompok ?>
        <th class="<?= $Page->idkelompok->headerCellClass() ?>"><span id="elh_bina_data_idkelompok" class="bina_data_idkelompok"><?= $Page->idkelompok->caption() ?></span></th>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <th class="<?= $Page->namakegiatan->headerCellClass() ?>"><span id="elh_bina_data_namakegiatan" class="bina_data_namakegiatan"><?= $Page->namakegiatan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th class="<?= $Page->uraian->headerCellClass() ?>"><span id="elh_bina_data_uraian" class="bina_data_uraian"><?= $Page->uraian->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <th class="<?= $Page->tglmulai->headerCellClass() ?>"><span id="elh_bina_data_tglmulai" class="bina_data_tglmulai"><?= $Page->tglmulai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->tglakhir->Visible) { // tglakhir ?>
        <th class="<?= $Page->tglakhir->headerCellClass() ?>"><span id="elh_bina_data_tglakhir" class="bina_data_tglakhir"><?= $Page->tglakhir->caption() ?></span></th>
<?php } ?>
<?php if ($Page->narasumber->Visible) { // narasumber ?>
        <th class="<?= $Page->narasumber->headerCellClass() ?>"><span id="elh_bina_data_narasumber" class="bina_data_narasumber"><?= $Page->narasumber->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
        <th class="<?= $Page->kontak_nama->headerCellClass() ?>"><span id="elh_bina_data_kontak_nama" class="bina_data_kontak_nama"><?= $Page->kontak_nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
        <th class="<?= $Page->kontak_hp->headerCellClass() ?>"><span id="elh_bina_data_kontak_hp" class="bina_data_kontak_hp"><?= $Page->kontak_hp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->poster->Visible) { // poster ?>
        <th class="<?= $Page->poster->headerCellClass() ?>"><span id="elh_bina_data_poster" class="bina_data_poster"><?= $Page->poster->caption() ?></span></th>
<?php } ?>
<?php if ($Page->postertipe->Visible) { // postertipe ?>
        <th class="<?= $Page->postertipe->headerCellClass() ?>"><span id="elh_bina_data_postertipe" class="bina_data_postertipe"><?= $Page->postertipe->caption() ?></span></th>
<?php } ?>
<?php if ($Page->posterukuran->Visible) { // posterukuran ?>
        <th class="<?= $Page->posterukuran->headerCellClass() ?>"><span id="elh_bina_data_posterukuran" class="bina_data_posterukuran"><?= $Page->posterukuran->caption() ?></span></th>
<?php } ?>
<?php if ($Page->posterlebar->Visible) { // posterlebar ?>
        <th class="<?= $Page->posterlebar->headerCellClass() ?>"><span id="elh_bina_data_posterlebar" class="bina_data_posterlebar"><?= $Page->posterlebar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->postertinggi->Visible) { // postertinggi ?>
        <th class="<?= $Page->postertinggi->headerCellClass() ?>"><span id="elh_bina_data_postertinggi" class="bina_data_postertinggi"><?= $Page->postertinggi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->linkinfo->Visible) { // linkinfo ?>
        <th class="<?= $Page->linkinfo->headerCellClass() ?>"><span id="elh_bina_data_linkinfo" class="bina_data_linkinfo"><?= $Page->linkinfo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
        <th class="<?= $Page->peserta_kelas->headerCellClass() ?>"><span id="elh_bina_data_peserta_kelas" class="bina_data_peserta_kelas"><?= $Page->peserta_kelas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <th class="<?= $Page->waktu->headerCellClass() ?>"><span id="elh_bina_data_waktu" class="bina_data_waktu"><?= $Page->waktu->caption() ?></span></th>
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
<?php if ($Page->id->Visible) { // id ?>
        <td <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_id" class="bina_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idperiode->Visible) { // idperiode ?>
        <td <?= $Page->idperiode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_idperiode" class="bina_data_idperiode">
<span<?= $Page->idperiode->viewAttributes() ?>>
<?= $Page->idperiode->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->idkelompok->Visible) { // idkelompok ?>
        <td <?= $Page->idkelompok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_idkelompok" class="bina_data_idkelompok">
<span<?= $Page->idkelompok->viewAttributes() ?>>
<?= $Page->idkelompok->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <td <?= $Page->namakegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_namakegiatan" class="bina_data_namakegiatan">
<span<?= $Page->namakegiatan->viewAttributes() ?>>
<?= $Page->namakegiatan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <td <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_uraian" class="bina_data_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <td <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_tglmulai" class="bina_data_tglmulai">
<span<?= $Page->tglmulai->viewAttributes() ?>>
<?= $Page->tglmulai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->tglakhir->Visible) { // tglakhir ?>
        <td <?= $Page->tglakhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_tglakhir" class="bina_data_tglakhir">
<span<?= $Page->tglakhir->viewAttributes() ?>>
<?= $Page->tglakhir->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->narasumber->Visible) { // narasumber ?>
        <td <?= $Page->narasumber->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_narasumber" class="bina_data_narasumber">
<span<?= $Page->narasumber->viewAttributes() ?>>
<?= $Page->narasumber->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
        <td <?= $Page->kontak_nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_kontak_nama" class="bina_data_kontak_nama">
<span<?= $Page->kontak_nama->viewAttributes() ?>>
<?= $Page->kontak_nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
        <td <?= $Page->kontak_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_kontak_hp" class="bina_data_kontak_hp">
<span<?= $Page->kontak_hp->viewAttributes() ?>>
<?= $Page->kontak_hp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->poster->Visible) { // poster ?>
        <td <?= $Page->poster->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_poster" class="bina_data_poster">
<span<?= $Page->poster->viewAttributes() ?>>
<?= $Page->poster->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->postertipe->Visible) { // postertipe ?>
        <td <?= $Page->postertipe->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_postertipe" class="bina_data_postertipe">
<span<?= $Page->postertipe->viewAttributes() ?>>
<?= $Page->postertipe->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->posterukuran->Visible) { // posterukuran ?>
        <td <?= $Page->posterukuran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_posterukuran" class="bina_data_posterukuran">
<span<?= $Page->posterukuran->viewAttributes() ?>>
<?= $Page->posterukuran->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->posterlebar->Visible) { // posterlebar ?>
        <td <?= $Page->posterlebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_posterlebar" class="bina_data_posterlebar">
<span<?= $Page->posterlebar->viewAttributes() ?>>
<?= $Page->posterlebar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->postertinggi->Visible) { // postertinggi ?>
        <td <?= $Page->postertinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_postertinggi" class="bina_data_postertinggi">
<span<?= $Page->postertinggi->viewAttributes() ?>>
<?= $Page->postertinggi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->linkinfo->Visible) { // linkinfo ?>
        <td <?= $Page->linkinfo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_linkinfo" class="bina_data_linkinfo">
<span<?= $Page->linkinfo->viewAttributes() ?>>
<?= $Page->linkinfo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
        <td <?= $Page->peserta_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_peserta_kelas" class="bina_data_peserta_kelas">
<span<?= $Page->peserta_kelas->viewAttributes() ?>>
<?= $Page->peserta_kelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <td <?= $Page->waktu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_waktu" class="bina_data_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
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
