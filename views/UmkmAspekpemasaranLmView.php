<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasaran_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspekpemasaran_lmview = currentForm = new ew.Form("fumkm_aspekpemasaran_lmview", "view");
    loadjs.done("fumkm_aspekpemasaran_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspekpemasaran_lm) ew.vars.tables.umkm_aspekpemasaran_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspekpemasaran_lm")) ?>;
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
<form name="fumkm_aspekpemasaran_lmview" id="fumkm_aspekpemasaran_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
    <tr id="r_MK_KEUNGGULANPRODUK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK"><?= $Page->MK_KEUNGGULANPRODUK->caption() ?></span></td>
        <td data-name="MK_KEUNGGULANPRODUK" <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK">
<span<?= $Page->MK_KEUNGGULANPRODUK->viewAttributes() ?>>
<?= $Page->MK_KEUNGGULANPRODUK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
    <tr id="r_MK_TARGETPASAR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_TARGETPASAR"><?= $Page->MK_TARGETPASAR->caption() ?></span></td>
        <td data-name="MK_TARGETPASAR" <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_TARGETPASAR">
<span<?= $Page->MK_TARGETPASAR->viewAttributes() ?>>
<?= $Page->MK_TARGETPASAR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
    <tr id="r_MK_KETERSEDIAAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN"><?= $Page->MK_KETERSEDIAAN->caption() ?></span></td>
        <td data-name="MK_KETERSEDIAAN" <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN">
<span<?= $Page->MK_KETERSEDIAAN->viewAttributes() ?>>
<?= $Page->MK_KETERSEDIAAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
    <tr id="r_MK_LOGO">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_LOGO"><?= $Page->MK_LOGO->caption() ?></span></td>
        <td data-name="MK_LOGO" <?= $Page->MK_LOGO->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_LOGO">
<span<?= $Page->MK_LOGO->viewAttributes() ?>>
<?= $Page->MK_LOGO->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
    <tr id="r_MK_HKI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_HKI"><?= $Page->MK_HKI->caption() ?></span></td>
        <td data-name="MK_HKI" <?= $Page->MK_HKI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_HKI">
<span<?= $Page->MK_HKI->viewAttributes() ?>>
<?= $Page->MK_HKI->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
    <tr id="r_MK_BRANDING">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_BRANDING"><?= $Page->MK_BRANDING->caption() ?></span></td>
        <td data-name="MK_BRANDING" <?= $Page->MK_BRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_BRANDING">
<span<?= $Page->MK_BRANDING->viewAttributes() ?>>
<?= $Page->MK_BRANDING->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
    <tr id="r_MK_COBRANDING">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_COBRANDING"><?= $Page->MK_COBRANDING->caption() ?></span></td>
        <td data-name="MK_COBRANDING" <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_COBRANDING">
<span<?= $Page->MK_COBRANDING->viewAttributes() ?>>
<?= $Page->MK_COBRANDING->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
    <tr id="r_MK_MEDIAOFFLINE">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE"><?= $Page->MK_MEDIAOFFLINE->caption() ?></span></td>
        <td data-name="MK_MEDIAOFFLINE" <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE">
<span<?= $Page->MK_MEDIAOFFLINE->viewAttributes() ?>>
<?= $Page->MK_MEDIAOFFLINE->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
    <tr id="r_MK_RESELLER">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_RESELLER"><?= $Page->MK_RESELLER->caption() ?></span></td>
        <td data-name="MK_RESELLER" <?= $Page->MK_RESELLER->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_RESELLER">
<span<?= $Page->MK_RESELLER->viewAttributes() ?>>
<?= $Page->MK_RESELLER->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
    <tr id="r_MK_PASAR">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_PASAR"><?= $Page->MK_PASAR->caption() ?></span></td>
        <td data-name="MK_PASAR" <?= $Page->MK_PASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PASAR">
<span<?= $Page->MK_PASAR->viewAttributes() ?>>
<?= $Page->MK_PASAR->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
    <tr id="r_MK_PELANGGAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_PELANGGAN"><?= $Page->MK_PELANGGAN->caption() ?></span></td>
        <td data-name="MK_PELANGGAN" <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PELANGGAN">
<span<?= $Page->MK_PELANGGAN->viewAttributes() ?>>
<?= $Page->MK_PELANGGAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
    <tr id="r_MK_PAMERANMANDIRI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI"><?= $Page->MK_PAMERANMANDIRI->caption() ?></span></td>
        <td data-name="MK_PAMERANMANDIRI" <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI">
<span<?= $Page->MK_PAMERANMANDIRI->viewAttributes() ?>>
<?= $Page->MK_PAMERANMANDIRI->getViewValue() ?></span>
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
