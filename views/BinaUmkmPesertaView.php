<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaUmkmPesertaView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbina_umkm_pesertaview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fbina_umkm_pesertaview = currentForm = new ew.Form("fbina_umkm_pesertaview", "view");
    loadjs.done("fbina_umkm_pesertaview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.bina_umkm_peserta) ew.vars.tables.bina_umkm_peserta = <?= JsonEncode(GetClientVar("tables", "bina_umkm_peserta")) ?>;
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
<form name="fbina_umkm_pesertaview" id="fbina_umkm_pesertaview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_umkm_peserta">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_umkm_peserta_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->id_binadata->Visible) { // id_binadata ?>
    <tr id="r_id_binadata">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_umkm_peserta_id_binadata"><?= $Page->id_binadata->caption() ?></span></td>
        <td data-name="id_binadata" <?= $Page->id_binadata->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_id_binadata">
<span<?= $Page->id_binadata->viewAttributes() ?>>
<?= $Page->id_binadata->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_umkm_peserta_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <tr id="r_status">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_umkm_peserta_status"><?= $Page->status->caption() ?></span></td>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <tr id="r_catatan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_bina_umkm_peserta_catatan"><?= $Page->catatan->caption() ?></span></td>
        <td data-name="catatan" <?= $Page->catatan->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_catatan">
<span<?= $Page->catatan->viewAttributes() ?>>
<?= $Page->catatan->getViewValue() ?></span>
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
