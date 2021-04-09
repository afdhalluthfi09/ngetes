<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmLiterasiView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkumkm_literasiview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkumkm_literasiview = currentForm = new ew.Form("fkumkm_literasiview", "view");
    loadjs.done("fkumkm_literasiview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.kumkm_literasi) ew.vars.tables.kumkm_literasi = <?= JsonEncode(GetClientVar("tables", "kumkm_literasi")) ?>;
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
<form name="fkumkm_literasiview" id="fkumkm_literasiview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_literasi">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->tgl->Visible) { // tgl ?>
    <tr id="r_tgl">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_tgl"><?= $Page->tgl->caption() ?></span></td>
        <td data-name="tgl" <?= $Page->tgl->cellAttributes() ?>>
<span id="el_kumkm_literasi_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <tr id="r_foto">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_foto"><?= $Page->foto->caption() ?></span></td>
        <td data-name="foto" <?= $Page->foto->cellAttributes() ?>>
<span id="el_kumkm_literasi_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= $Page->foto->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->idjenis->Visible) { // idjenis ?>
    <tr id="r_idjenis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_idjenis"><?= $Page->idjenis->caption() ?></span></td>
        <td data-name="idjenis" <?= $Page->idjenis->cellAttributes() ?>>
<span id="el_kumkm_literasi_idjenis">
<span<?= $Page->idjenis->viewAttributes() ?>>
<?= $Page->idjenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul_artikel->Visible) { // judul_artikel ?>
    <tr id="r_judul_artikel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_judul_artikel"><?= $Page->judul_artikel->caption() ?></span></td>
        <td data-name="judul_artikel" <?= $Page->judul_artikel->cellAttributes() ?>>
<span id="el_kumkm_literasi_judul_artikel">
<span<?= $Page->judul_artikel->viewAttributes() ?>>
<?= $Page->judul_artikel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
    <tr id="r_kelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_kelas"><?= $Page->kelas->caption() ?></span></td>
        <td data-name="kelas" <?= $Page->kelas->cellAttributes() ?>>
<span id="el_kumkm_literasi_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->isi_artikel->Visible) { // isi_artikel ?>
    <tr id="r_isi_artikel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_isi_artikel"><?= $Page->isi_artikel->caption() ?></span></td>
        <td data-name="isi_artikel" <?= $Page->isi_artikel->cellAttributes() ?>>
<span id="el_kumkm_literasi_isi_artikel">
<span<?= $Page->isi_artikel->viewAttributes() ?>>
<?= $Page->isi_artikel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subjenis->Visible) { // subjenis ?>
    <tr id="r_subjenis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_subjenis"><?= $Page->subjenis->caption() ?></span></td>
        <td data-name="subjenis" <?= $Page->subjenis->cellAttributes() ?>>
<span id="el_kumkm_literasi_subjenis">
<span<?= $Page->subjenis->viewAttributes() ?>>
<?= $Page->subjenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->urutan->Visible) { // urutan ?>
    <tr id="r_urutan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_literasi_urutan"><?= $Page->urutan->caption() ?></span></td>
        <td data-name="urutan" <?= $Page->urutan->cellAttributes() ?>>
<span id="el_kumkm_literasi_urutan">
<span<?= $Page->urutan->viewAttributes() ?>>
<?= $Page->urutan->getViewValue() ?></span>
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
