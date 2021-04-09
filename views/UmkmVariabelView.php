<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmVariabelView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_variabelview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_variabelview = currentForm = new ew.Form("fumkm_variabelview", "view");
    loadjs.done("fumkm_variabelview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_variabel) ew.vars.tables.umkm_variabel = <?= JsonEncode(GetClientVar("tables", "umkm_variabel")) ?>;
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
<form name="fumkm_variabelview" id="fumkm_variabelview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_variabel">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->id->Visible) { // id ?>
    <tr id="r_id">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_id"><?= $Page->id->caption() ?></span></td>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el_umkm_variabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->variabel->Visible) { // variabel ?>
    <tr id="r_variabel">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_variabel"><?= $Page->variabel->caption() ?></span></td>
        <td data-name="variabel" <?= $Page->variabel->cellAttributes() ?>>
<span id="el_umkm_variabel_variabel">
<span<?= $Page->variabel->viewAttributes() ?>>
<?= $Page->variabel->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nmin->Visible) { // nmin ?>
    <tr id="r_nmin">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_nmin"><?= $Page->nmin->caption() ?></span></td>
        <td data-name="nmin" <?= $Page->nmin->cellAttributes() ?>>
<span id="el_umkm_variabel_nmin">
<span<?= $Page->nmin->viewAttributes() ?>>
<?= $Page->nmin->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->nmax->Visible) { // nmax ?>
    <tr id="r_nmax">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_nmax"><?= $Page->nmax->caption() ?></span></td>
        <td data-name="nmax" <?= $Page->nmax->cellAttributes() ?>>
<span id="el_umkm_variabel_nmax">
<span<?= $Page->nmax->viewAttributes() ?>>
<?= $Page->nmax->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->subkat->Visible) { // subkat ?>
    <tr id="r_subkat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_subkat"><?= $Page->subkat->caption() ?></span></td>
        <td data-name="subkat" <?= $Page->subkat->cellAttributes() ?>>
<span id="el_umkm_variabel_subkat">
<span<?= $Page->subkat->viewAttributes() ?>>
<?= $Page->subkat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot->Visible) { // bobot ?>
    <tr id="r_bobot">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_bobot"><?= $Page->bobot->caption() ?></span></td>
        <td data-name="bobot" <?= $Page->bobot->cellAttributes() ?>>
<span id="el_umkm_variabel_bobot">
<span<?= $Page->bobot->viewAttributes() ?>>
<?= $Page->bobot->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kat->Visible) { // kat ?>
    <tr id="r_kat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_kat"><?= $Page->kat->caption() ?></span></td>
        <td data-name="kat" <?= $Page->kat->cellAttributes() ?>>
<span id="el_umkm_variabel_kat">
<span<?= $Page->kat->viewAttributes() ?>>
<?= $Page->kat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->porsi->Visible) { // porsi ?>
    <tr id="r_porsi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_variabel_porsi"><?= $Page->porsi->caption() ?></span></td>
        <td data-name="porsi" <?= $Page->porsi->cellAttributes() ?>>
<span id="el_umkm_variabel_porsi">
<span<?= $Page->porsi->viewAttributes() ?>>
<?= $Page->porsi->getViewValue() ?></span>
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
