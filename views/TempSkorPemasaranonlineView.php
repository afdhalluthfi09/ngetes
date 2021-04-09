<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranonlineView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasaranonlineview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    ftemp_skor_pemasaranonlineview = currentForm = new ew.Form("ftemp_skor_pemasaranonlineview", "view");
    loadjs.done("ftemp_skor_pemasaranonlineview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.temp_skor_pemasaranonline) ew.vars.tables.temp_skor_pemasaranonline = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaranonline")) ?>;
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
<form name="ftemp_skor_pemasaranonlineview" id="ftemp_skor_pemasaranonlineview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaranonline">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->nik->Visible) { // nik ?>
    <tr id="r_nik">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_nik"><?= $Page->nik->caption() ?></span></td>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->chatting->Visible) { // chatting ?>
    <tr id="r_chatting">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_chatting"><?= $Page->chatting->caption() ?></span></td>
        <td data-name="chatting" <?= $Page->chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_chatting">
<span<?= $Page->chatting->viewAttributes() ?>>
<?= $Page->chatting->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
    <tr id="r_skor_chatting">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_chatting"><?= $Page->skor_chatting->caption() ?></span></td>
        <td data-name="skor_chatting" <?= $Page->skor_chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_chatting">
<span<?= $Page->skor_chatting->viewAttributes() ?>>
<?= $Page->skor_chatting->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_chatting->Visible) { // max_chatting ?>
    <tr id="r_max_chatting">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_chatting"><?= $Page->max_chatting->caption() ?></span></td>
        <td data-name="max_chatting" <?= $Page->max_chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_chatting">
<span<?= $Page->max_chatting->viewAttributes() ?>>
<?= $Page->max_chatting->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
    <tr id="r_medsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_medsos"><?= $Page->medsos->caption() ?></span></td>
        <td data-name="medsos" <?= $Page->medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_medsos">
<span<?= $Page->medsos->viewAttributes() ?>>
<?= $Page->medsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
    <tr id="r_skor_medsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_medsos"><?= $Page->skor_medsos->caption() ?></span></td>
        <td data-name="skor_medsos" <?= $Page->skor_medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_medsos">
<span<?= $Page->skor_medsos->viewAttributes() ?>>
<?= $Page->skor_medsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_medsos->Visible) { // max_medsos ?>
    <tr id="r_max_medsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_medsos"><?= $Page->max_medsos->caption() ?></span></td>
        <td data-name="max_medsos" <?= $Page->max_medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_medsos">
<span<?= $Page->max_medsos->viewAttributes() ?>>
<?= $Page->max_medsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->marketplace->Visible) { // marketplace ?>
    <tr id="r_marketplace">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_marketplace"><?= $Page->marketplace->caption() ?></span></td>
        <td data-name="marketplace" <?= $Page->marketplace->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_marketplace">
<span<?= $Page->marketplace->viewAttributes() ?>>
<?= $Page->marketplace->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_mp->Visible) { // skor_mp ?>
    <tr id="r_skor_mp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_mp"><?= $Page->skor_mp->caption() ?></span></td>
        <td data-name="skor_mp" <?= $Page->skor_mp->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_mp">
<span<?= $Page->skor_mp->viewAttributes() ?>>
<?= $Page->skor_mp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_mp->Visible) { // max_mp ?>
    <tr id="r_max_mp">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_mp"><?= $Page->max_mp->caption() ?></span></td>
        <td data-name="max_mp" <?= $Page->max_mp->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_mp">
<span<?= $Page->max_mp->viewAttributes() ?>>
<?= $Page->max_mp->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->gmb->Visible) { // gmb ?>
    <tr id="r_gmb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_gmb"><?= $Page->gmb->caption() ?></span></td>
        <td data-name="gmb" <?= $Page->gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_gmb">
<span<?= $Page->gmb->viewAttributes() ?>>
<?= $Page->gmb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
    <tr id="r_skor_gmb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_gmb"><?= $Page->skor_gmb->caption() ?></span></td>
        <td data-name="skor_gmb" <?= $Page->skor_gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_gmb">
<span<?= $Page->skor_gmb->viewAttributes() ?>>
<?= $Page->skor_gmb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_gmb->Visible) { // max_gmb ?>
    <tr id="r_max_gmb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_gmb"><?= $Page->max_gmb->caption() ?></span></td>
        <td data-name="max_gmb" <?= $Page->max_gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_gmb">
<span<?= $Page->max_gmb->viewAttributes() ?>>
<?= $Page->max_gmb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
    <tr id="r_web">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_web"><?= $Page->web->caption() ?></span></td>
        <td data-name="web" <?= $Page->web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_web->Visible) { // skor_web ?>
    <tr id="r_skor_web">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_web"><?= $Page->skor_web->caption() ?></span></td>
        <td data-name="skor_web" <?= $Page->skor_web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_web">
<span<?= $Page->skor_web->viewAttributes() ?>>
<?= $Page->skor_web->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_web->Visible) { // max_web ?>
    <tr id="r_max_web">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_web"><?= $Page->max_web->caption() ?></span></td>
        <td data-name="max_web" <?= $Page->max_web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_web">
<span<?= $Page->max_web->viewAttributes() ?>>
<?= $Page->max_web->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
    <tr id="r_updatemedsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_updatemedsos"><?= $Page->updatemedsos->caption() ?></span></td>
        <td data-name="updatemedsos" <?= $Page->updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_updatemedsos">
<span<?= $Page->updatemedsos->viewAttributes() ?>>
<?= $Page->updatemedsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
    <tr id="r_skor_updatemedsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_updatemedsos"><?= $Page->skor_updatemedsos->caption() ?></span></td>
        <td data-name="skor_updatemedsos" <?= $Page->skor_updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_updatemedsos">
<span<?= $Page->skor_updatemedsos->viewAttributes() ?>>
<?= $Page->skor_updatemedsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
    <tr id="r_max_updatemedsos">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_updatemedsos"><?= $Page->max_updatemedsos->caption() ?></span></td>
        <td data-name="max_updatemedsos" <?= $Page->max_updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_updatemedsos">
<span<?= $Page->max_updatemedsos->viewAttributes() ?>>
<?= $Page->max_updatemedsos->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->updateweb->Visible) { // updateweb ?>
    <tr id="r_updateweb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_updateweb"><?= $Page->updateweb->caption() ?></span></td>
        <td data-name="updateweb" <?= $Page->updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_updateweb">
<span<?= $Page->updateweb->viewAttributes() ?>>
<?= $Page->updateweb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
    <tr id="r_skor_updateweb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_updateweb"><?= $Page->skor_updateweb->caption() ?></span></td>
        <td data-name="skor_updateweb" <?= $Page->skor_updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_updateweb">
<span<?= $Page->skor_updateweb->viewAttributes() ?>>
<?= $Page->skor_updateweb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
    <tr id="r_max_updateweb">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_updateweb"><?= $Page->max_updateweb->caption() ?></span></td>
        <td data-name="max_updateweb" <?= $Page->max_updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_updateweb">
<span<?= $Page->max_updateweb->viewAttributes() ?>>
<?= $Page->max_updateweb->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->seo->Visible) { // seo ?>
    <tr id="r_seo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_seo"><?= $Page->seo->caption() ?></span></td>
        <td data-name="seo" <?= $Page->seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_seo">
<span<?= $Page->seo->viewAttributes() ?>>
<?= $Page->seo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_seo->Visible) { // skor_seo ?>
    <tr id="r_skor_seo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_seo"><?= $Page->skor_seo->caption() ?></span></td>
        <td data-name="skor_seo" <?= $Page->skor_seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_seo">
<span<?= $Page->skor_seo->viewAttributes() ?>>
<?= $Page->skor_seo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_seo->Visible) { // max_seo ?>
    <tr id="r_max_seo">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_seo"><?= $Page->max_seo->caption() ?></span></td>
        <td data-name="max_seo" <?= $Page->max_seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_seo">
<span<?= $Page->max_seo->viewAttributes() ?>>
<?= $Page->max_seo->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->iklan->Visible) { // iklan ?>
    <tr id="r_iklan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_iklan"><?= $Page->iklan->caption() ?></span></td>
        <td data-name="iklan" <?= $Page->iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_iklan">
<span<?= $Page->iklan->viewAttributes() ?>>
<?= $Page->iklan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
    <tr id="r_skor_iklan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_iklan"><?= $Page->skor_iklan->caption() ?></span></td>
        <td data-name="skor_iklan" <?= $Page->skor_iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_iklan">
<span<?= $Page->skor_iklan->viewAttributes() ?>>
<?= $Page->skor_iklan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->max_iklan->Visible) { // max_iklan ?>
    <tr id="r_max_iklan">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_max_iklan"><?= $Page->max_iklan->caption() ?></span></td>
        <td data-name="max_iklan" <?= $Page->max_iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_iklan">
<span<?= $Page->max_iklan->viewAttributes() ?>>
<?= $Page->max_iklan->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
    <tr id="r_skor_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_skor_pemasaranonline"><?= $Page->skor_pemasaranonline->caption() ?></span></td>
        <td data-name="skor_pemasaranonline" <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_pemasaranonline">
<span<?= $Page->skor_pemasaranonline->viewAttributes() ?>>
<?= $Page->skor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
    <tr id="r_maxskor_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_maxskor_pemasaranonline"><?= $Page->maxskor_pemasaranonline->caption() ?></span></td>
        <td data-name="maxskor_pemasaranonline" <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_maxskor_pemasaranonline">
<span<?= $Page->maxskor_pemasaranonline->viewAttributes() ?>>
<?= $Page->maxskor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
    <tr id="r_bobot_pemasaranonline">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_temp_skor_pemasaranonline_bobot_pemasaranonline"><?= $Page->bobot_pemasaranonline->caption() ?></span></td>
        <td data-name="bobot_pemasaranonline" <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_bobot_pemasaranonline">
<span<?= $Page->bobot_pemasaranonline->viewAttributes() ?>>
<?= $Page->bobot_pemasaranonline->getViewValue() ?></span>
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
