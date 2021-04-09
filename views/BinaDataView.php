<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaDataView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbina_dataview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbina_dataview = currentForm = new ew.Form("fbina_dataview", "view");
    loadjs.done("fbina_dataview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.bina_data) ew.vars.tables.bina_data = <?= JsonEncode(GetClientVar("tables", "bina_data")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fbina_dataview" id="fbina_dataview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_data">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_bina_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idperiode->Visible) { // idperiode ?>
    <tr id="r_idperiode">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_idperiode"><?= $Page->idperiode->caption() ?></span></td>
        <td data-name="idperiode" <?= $Page->idperiode->cellAttributes() ?>>
<span id="el_bina_data_idperiode">
<span<?= $Page->idperiode->viewAttributes() ?>>
<?= $Page->idperiode->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idkelompok->Visible) { // idkelompok ?>
    <tr id="r_idkelompok">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_idkelompok"><?= $Page->idkelompok->caption() ?></span></td>
        <td data-name="idkelompok" <?= $Page->idkelompok->cellAttributes() ?>>
<span id="el_bina_data_idkelompok">
<span<?= $Page->idkelompok->viewAttributes() ?>>
<?= $Page->idkelompok->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
    <tr id="r_namakegiatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_namakegiatan"><?= $Page->namakegiatan->caption() ?></span></td>
        <td data-name="namakegiatan" <?= $Page->namakegiatan->cellAttributes() ?>>
<span id="el_bina_data_namakegiatan">
<span<?= $Page->namakegiatan->viewAttributes() ?>>
<?= $Page->namakegiatan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <tr id="r_uraian">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_uraian"><?= $Page->uraian->caption() ?></span></td>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el_bina_data_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
    <tr id="r_tglmulai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_tglmulai"><?= $Page->tglmulai->caption() ?></span></td>
        <td data-name="tglmulai" <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el_bina_data_tglmulai">
<span<?= $Page->tglmulai->viewAttributes() ?>>
<?= $Page->tglmulai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->tglakhir->Visible) { // tglakhir ?>
    <tr id="r_tglakhir">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_tglakhir"><?= $Page->tglakhir->caption() ?></span></td>
        <td data-name="tglakhir" <?= $Page->tglakhir->cellAttributes() ?>>
<span id="el_bina_data_tglakhir">
<span<?= $Page->tglakhir->viewAttributes() ?>>
<?= $Page->tglakhir->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->narasumber->Visible) { // narasumber ?>
    <tr id="r_narasumber">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_narasumber"><?= $Page->narasumber->caption() ?></span></td>
        <td data-name="narasumber" <?= $Page->narasumber->cellAttributes() ?>>
<span id="el_bina_data_narasumber">
<span<?= $Page->narasumber->viewAttributes() ?>>
<?= $Page->narasumber->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
    <tr id="r_kontak_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_kontak_nama"><?= $Page->kontak_nama->caption() ?></span></td>
        <td data-name="kontak_nama" <?= $Page->kontak_nama->cellAttributes() ?>>
<span id="el_bina_data_kontak_nama">
<span<?= $Page->kontak_nama->viewAttributes() ?>>
<?= $Page->kontak_nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
    <tr id="r_kontak_hp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_kontak_hp"><?= $Page->kontak_hp->caption() ?></span></td>
        <td data-name="kontak_hp" <?= $Page->kontak_hp->cellAttributes() ?>>
<span id="el_bina_data_kontak_hp">
<span<?= $Page->kontak_hp->viewAttributes() ?>>
<?= $Page->kontak_hp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->poster->Visible) { // poster ?>
    <tr id="r_poster">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_poster"><?= $Page->poster->caption() ?></span></td>
        <td data-name="poster" <?= $Page->poster->cellAttributes() ?>>
<span id="el_bina_data_poster">
<span<?= $Page->poster->viewAttributes() ?>>
<?= $Page->poster->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->postertipe->Visible) { // postertipe ?>
    <tr id="r_postertipe">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_postertipe"><?= $Page->postertipe->caption() ?></span></td>
        <td data-name="postertipe" <?= $Page->postertipe->cellAttributes() ?>>
<span id="el_bina_data_postertipe">
<span<?= $Page->postertipe->viewAttributes() ?>>
<?= $Page->postertipe->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->posterukuran->Visible) { // posterukuran ?>
    <tr id="r_posterukuran">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_posterukuran"><?= $Page->posterukuran->caption() ?></span></td>
        <td data-name="posterukuran" <?= $Page->posterukuran->cellAttributes() ?>>
<span id="el_bina_data_posterukuran">
<span<?= $Page->posterukuran->viewAttributes() ?>>
<?= $Page->posterukuran->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->posterlebar->Visible) { // posterlebar ?>
    <tr id="r_posterlebar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_posterlebar"><?= $Page->posterlebar->caption() ?></span></td>
        <td data-name="posterlebar" <?= $Page->posterlebar->cellAttributes() ?>>
<span id="el_bina_data_posterlebar">
<span<?= $Page->posterlebar->viewAttributes() ?>>
<?= $Page->posterlebar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->postertinggi->Visible) { // postertinggi ?>
    <tr id="r_postertinggi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_postertinggi"><?= $Page->postertinggi->caption() ?></span></td>
        <td data-name="postertinggi" <?= $Page->postertinggi->cellAttributes() ?>>
<span id="el_bina_data_postertinggi">
<span<?= $Page->postertinggi->viewAttributes() ?>>
<?= $Page->postertinggi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->linkinfo->Visible) { // linkinfo ?>
    <tr id="r_linkinfo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_linkinfo"><?= $Page->linkinfo->caption() ?></span></td>
        <td data-name="linkinfo" <?= $Page->linkinfo->cellAttributes() ?>>
<span id="el_bina_data_linkinfo">
<span<?= $Page->linkinfo->viewAttributes() ?>>
<?= $Page->linkinfo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
    <tr id="r_peserta_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_peserta_kelas"><?= $Page->peserta_kelas->caption() ?></span></td>
        <td data-name="peserta_kelas" <?= $Page->peserta_kelas->cellAttributes() ?>>
<span id="el_bina_data_peserta_kelas">
<span<?= $Page->peserta_kelas->viewAttributes() ?>>
<?= $Page->peserta_kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <tr id="r_waktu">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_data_waktu"><?= $Page->waktu->caption() ?></span></td>
        <td data-name="waktu" <?= $Page->waktu->cellAttributes() ?>>
<span id="el_bina_data_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
