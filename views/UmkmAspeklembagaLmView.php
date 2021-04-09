<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembaga_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspeklembaga_lmview = currentForm = new ew.Form("fumkm_aspeklembaga_lmview", "view");
    loadjs.done("fumkm_aspeklembaga_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspeklembaga_lm) ew.vars.tables.umkm_aspeklembaga_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspeklembaga_lm")) ?>;
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
<form name="fumkm_aspeklembaga_lmview" id="fumkm_aspeklembaga_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
    <tr id="r_LB_BADANHUKUM">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_BADANHUKUM"><?= $Page->LB_BADANHUKUM->caption() ?></span></td>
        <td data-name="LB_BADANHUKUM" <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_BADANHUKUM">
<span<?= $Page->LB_BADANHUKUM->viewAttributes() ?>>
<?= $Page->LB_BADANHUKUM->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
    <tr id="r_LB_IZINUSAHA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_IZINUSAHA"><?= $Page->LB_IZINUSAHA->caption() ?></span></td>
        <td data-name="LB_IZINUSAHA" <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_IZINUSAHA">
<span<?= $Page->LB_IZINUSAHA->viewAttributes() ?>>
<?= $Page->LB_IZINUSAHA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
    <tr id="r_LB_NPWP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_NPWP"><?= $Page->LB_NPWP->caption() ?></span></td>
        <td data-name="LB_NPWP" <?= $Page->LB_NPWP->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_NPWP">
<span<?= $Page->LB_NPWP->viewAttributes() ?>>
<?= $Page->LB_NPWP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
    <tr id="r_LB_SO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_SO"><?= $Page->LB_SO->caption() ?></span></td>
        <td data-name="LB_SO" <?= $Page->LB_SO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_SO">
<span<?= $Page->LB_SO->viewAttributes() ?>>
<?= $Page->LB_SO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
    <tr id="r_LB_JD">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_JD"><?= $Page->LB_JD->caption() ?></span></td>
        <td data-name="LB_JD" <?= $Page->LB_JD->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_JD">
<span<?= $Page->LB_JD->viewAttributes() ?>>
<?= $Page->LB_JD->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
    <tr id="r_LB_ISO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspeklembaga_lm_LB_ISO"><?= $Page->LB_ISO->caption() ?></span></td>
        <td data-name="LB_ISO" <?= $Page->LB_ISO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_ISO">
<span<?= $Page->LB_ISO->viewAttributes() ?>>
<?= $Page->LB_ISO->getViewValue() ?></span>
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
