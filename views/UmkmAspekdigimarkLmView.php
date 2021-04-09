<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimark_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspekdigimark_lmview = currentForm = new ew.Form("fumkm_aspekdigimark_lmview", "view");
    loadjs.done("fumkm_aspekdigimark_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspekdigimark_lm) ew.vars.tables.umkm_aspekdigimark_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspekdigimark_lm")) ?>;
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
<form name="fumkm_aspekdigimark_lmview" id="fumkm_aspekdigimark_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
    <tr id="r_DM_CHATTING">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_CHATTING"><?= $Page->DM_CHATTING->caption() ?></span></td>
        <td data-name="DM_CHATTING" <?= $Page->DM_CHATTING->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_CHATTING">
<span<?= $Page->DM_CHATTING->viewAttributes() ?>>
<?= $Page->DM_CHATTING->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
    <tr id="r_DM_MEDSOS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_MEDSOS"><?= $Page->DM_MEDSOS->caption() ?></span></td>
        <td data-name="DM_MEDSOS" <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_MEDSOS">
<span<?= $Page->DM_MEDSOS->viewAttributes() ?>>
<?= $Page->DM_MEDSOS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
    <tr id="r_DM_MP">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_MP"><?= $Page->DM_MP->caption() ?></span></td>
        <td data-name="DM_MP" <?= $Page->DM_MP->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_MP">
<span<?= $Page->DM_MP->viewAttributes() ?>>
<?= $Page->DM_MP->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
    <tr id="r_DM_GMB">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_GMB"><?= $Page->DM_GMB->caption() ?></span></td>
        <td data-name="DM_GMB" <?= $Page->DM_GMB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_GMB">
<span<?= $Page->DM_GMB->viewAttributes() ?>>
<?= $Page->DM_GMB->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
    <tr id="r_DM_WEB">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_WEB"><?= $Page->DM_WEB->caption() ?></span></td>
        <td data-name="DM_WEB" <?= $Page->DM_WEB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_WEB">
<span<?= $Page->DM_WEB->viewAttributes() ?>>
<?= $Page->DM_WEB->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
    <tr id="r_DM_UPDATEMEDSOS">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS"><?= $Page->DM_UPDATEMEDSOS->caption() ?></span></td>
        <td data-name="DM_UPDATEMEDSOS" <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS">
<span<?= $Page->DM_UPDATEMEDSOS->viewAttributes() ?>>
<?= $Page->DM_UPDATEMEDSOS->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
    <tr id="r_DM_UPDATEWEBSITE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE"><?= $Page->DM_UPDATEWEBSITE->caption() ?></span></td>
        <td data-name="DM_UPDATEWEBSITE" <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE">
<span<?= $Page->DM_UPDATEWEBSITE->viewAttributes() ?>>
<?= $Page->DM_UPDATEWEBSITE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
    <tr id="r_DM_GOOGLEINDEX">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_GOOGLEINDEX"><?= $Page->DM_GOOGLEINDEX->caption() ?></span></td>
        <td data-name="DM_GOOGLEINDEX" <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_GOOGLEINDEX">
<span<?= $Page->DM_GOOGLEINDEX->viewAttributes() ?>>
<?= $Page->DM_GOOGLEINDEX->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
    <tr id="r_DM_IKLANBERBAYAR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR"><?= $Page->DM_IKLANBERBAYAR->caption() ?></span></td>
        <td data-name="DM_IKLANBERBAYAR" <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR">
<span<?= $Page->DM_IKLANBERBAYAR->viewAttributes() ?>>
<?= $Page->DM_IKLANBERBAYAR->getViewValue() ?></span>
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
