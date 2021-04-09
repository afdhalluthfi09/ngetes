<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganLmView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuangan_lmview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fumkm_aspekkeuangan_lmview = currentForm = new ew.Form("fumkm_aspekkeuangan_lmview", "view");
    loadjs.done("fumkm_aspekkeuangan_lmview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.umkm_aspekkeuangan_lm) ew.vars.tables.umkm_aspekkeuangan_lm = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan_lm")) ?>;
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
<form name="fumkm_aspekkeuangan_lmview" id="fumkm_aspekkeuangan_lmview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan_lm">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->NIK->Visible) { // NIK ?>
    <tr id="r_NIK">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_NIK"><?= $Page->NIK->caption() ?></span></td>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
    <tr id="r_KEU_USAHAUTAMA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA"><?= $Page->KEU_USAHAUTAMA->caption() ?></span></td>
        <td data-name="KEU_USAHAUTAMA" <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA">
<span<?= $Page->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Page->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
    <tr id="r_KEU_PENGELOLAAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN"><?= $Page->KEU_PENGELOLAAN->caption() ?></span></td>
        <td data-name="KEU_PENGELOLAAN" <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN">
<span<?= $Page->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Page->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
    <tr id="r_KEU_NOTA">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_NOTA"><?= $Page->KEU_NOTA->caption() ?></span></td>
        <td data-name="KEU_NOTA" <?= $Page->KEU_NOTA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_NOTA">
<span<?= $Page->KEU_NOTA->viewAttributes() ?>>
<?= $Page->KEU_NOTA->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
    <tr id="r_KEU_PENCATATAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_PENCATATAN"><?= $Page->KEU_PENCATATAN->caption() ?></span></td>
        <td data-name="KEU_PENCATATAN" <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_PENCATATAN">
<span<?= $Page->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Page->KEU_PENCATATAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
    <tr id="r_KEU_LAPORAN">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_LAPORAN"><?= $Page->KEU_LAPORAN->caption() ?></span></td>
        <td data-name="KEU_LAPORAN" <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_LAPORAN">
<span<?= $Page->KEU_LAPORAN->viewAttributes() ?>>
<?= $Page->KEU_LAPORAN->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
    <tr id="r_KEU_UTANGMODAL">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_UTANGMODAL"><?= $Page->KEU_UTANGMODAL->caption() ?></span></td>
        <td data-name="KEU_UTANGMODAL" <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_UTANGMODAL">
<span<?= $Page->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Page->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
    <tr id="r_KEU_CATATNASET">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_CATATNASET"><?= $Page->KEU_CATATNASET->caption() ?></span></td>
        <td data-name="KEU_CATATNASET" <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_CATATNASET">
<span<?= $Page->KEU_CATATNASET->viewAttributes() ?>>
<?= $Page->KEU_CATATNASET->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
    <tr id="r_KEU_NONTUNAI">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_umkm_aspekkeuangan_lm_KEU_NONTUNAI"><?= $Page->KEU_NONTUNAI->caption() ?></span></td>
        <td data-name="KEU_NONTUNAI" <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_NONTUNAI">
<span<?= $Page->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Page->KEU_NONTUNAI->getViewValue() ?></span>
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
