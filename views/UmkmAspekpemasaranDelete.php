<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasarandelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspekpemasarandelete = currentForm = new ew.Form("fumkm_aspekpemasarandelete", "delete");
    loadjs.done("fumkm_aspekpemasarandelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspekpemasaran) ew.vars.tables.umkm_aspekpemasaran = <?= JsonEncode(GetClientVar("tables", "umkm_aspekpemasaran")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspekpemasarandelete" id="fumkm_aspekpemasarandelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran">
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
<?php if ($Page->NIK->Visible) { // NIK ?>
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_NIK" class="umkm_aspekpemasaran_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
        <th class="<?= $Page->MK_KEUNGGULANPRODUK->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK" class="umkm_aspekpemasaran_MK_KEUNGGULANPRODUK"><?= $Page->MK_KEUNGGULANPRODUK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
        <th class="<?= $Page->MK_TARGETPASAR->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_TARGETPASAR" class="umkm_aspekpemasaran_MK_TARGETPASAR"><?= $Page->MK_TARGETPASAR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
        <th class="<?= $Page->MK_KETERSEDIAAN->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_KETERSEDIAAN" class="umkm_aspekpemasaran_MK_KETERSEDIAAN"><?= $Page->MK_KETERSEDIAAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
        <th class="<?= $Page->MK_LOGO->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_LOGO" class="umkm_aspekpemasaran_MK_LOGO"><?= $Page->MK_LOGO->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
        <th class="<?= $Page->MK_HKI->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_HKI" class="umkm_aspekpemasaran_MK_HKI"><?= $Page->MK_HKI->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
        <th class="<?= $Page->MK_BRANDING->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_BRANDING" class="umkm_aspekpemasaran_MK_BRANDING"><?= $Page->MK_BRANDING->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
        <th class="<?= $Page->MK_COBRANDING->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_COBRANDING" class="umkm_aspekpemasaran_MK_COBRANDING"><?= $Page->MK_COBRANDING->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
        <th class="<?= $Page->MK_MEDIAOFFLINE->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_MEDIAOFFLINE" class="umkm_aspekpemasaran_MK_MEDIAOFFLINE"><?= $Page->MK_MEDIAOFFLINE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
        <th class="<?= $Page->MK_RESELLER->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_RESELLER" class="umkm_aspekpemasaran_MK_RESELLER"><?= $Page->MK_RESELLER->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
        <th class="<?= $Page->MK_PASAR->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_PASAR" class="umkm_aspekpemasaran_MK_PASAR"><?= $Page->MK_PASAR->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
        <th class="<?= $Page->MK_PELANGGAN->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_PELANGGAN" class="umkm_aspekpemasaran_MK_PELANGGAN"><?= $Page->MK_PELANGGAN->caption() ?></span></th>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
        <th class="<?= $Page->MK_PAMERANMANDIRI->headerCellClass() ?>"><span id="elh_umkm_aspekpemasaran_MK_PAMERANMANDIRI" class="umkm_aspekpemasaran_MK_PAMERANMANDIRI"><?= $Page->MK_PAMERANMANDIRI->caption() ?></span></th>
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
<?php if ($Page->NIK->Visible) { // NIK ?>
        <td <?= $Page->NIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_NIK" class="umkm_aspekpemasaran_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
        <td <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK" class="umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
<span<?= $Page->MK_KEUNGGULANPRODUK->viewAttributes() ?>>
<?= $Page->MK_KEUNGGULANPRODUK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
        <td <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_TARGETPASAR" class="umkm_aspekpemasaran_MK_TARGETPASAR">
<span<?= $Page->MK_TARGETPASAR->viewAttributes() ?>>
<?= $Page->MK_TARGETPASAR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
        <td <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KETERSEDIAAN" class="umkm_aspekpemasaran_MK_KETERSEDIAAN">
<span<?= $Page->MK_KETERSEDIAAN->viewAttributes() ?>>
<?= $Page->MK_KETERSEDIAAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
        <td <?= $Page->MK_LOGO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_LOGO" class="umkm_aspekpemasaran_MK_LOGO">
<span<?= $Page->MK_LOGO->viewAttributes() ?>>
<?= $Page->MK_LOGO->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
        <td <?= $Page->MK_HKI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_HKI" class="umkm_aspekpemasaran_MK_HKI">
<span<?= $Page->MK_HKI->viewAttributes() ?>>
<?= $Page->MK_HKI->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
        <td <?= $Page->MK_BRANDING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_BRANDING" class="umkm_aspekpemasaran_MK_BRANDING">
<span<?= $Page->MK_BRANDING->viewAttributes() ?>>
<?= $Page->MK_BRANDING->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
        <td <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_COBRANDING" class="umkm_aspekpemasaran_MK_COBRANDING">
<span<?= $Page->MK_COBRANDING->viewAttributes() ?>>
<?= $Page->MK_COBRANDING->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
        <td <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_MEDIAOFFLINE" class="umkm_aspekpemasaran_MK_MEDIAOFFLINE">
<span<?= $Page->MK_MEDIAOFFLINE->viewAttributes() ?>>
<?= $Page->MK_MEDIAOFFLINE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
        <td <?= $Page->MK_RESELLER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_RESELLER" class="umkm_aspekpemasaran_MK_RESELLER">
<span<?= $Page->MK_RESELLER->viewAttributes() ?>>
<?= $Page->MK_RESELLER->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
        <td <?= $Page->MK_PASAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PASAR" class="umkm_aspekpemasaran_MK_PASAR">
<span<?= $Page->MK_PASAR->viewAttributes() ?>>
<?= $Page->MK_PASAR->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
        <td <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PELANGGAN" class="umkm_aspekpemasaran_MK_PELANGGAN">
<span<?= $Page->MK_PELANGGAN->viewAttributes() ?>>
<?= $Page->MK_PELANGGAN->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
        <td <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PAMERANMANDIRI" class="umkm_aspekpemasaran_MK_PAMERANMANDIRI">
<span<?= $Page->MK_PAMERANMANDIRI->viewAttributes() ?>>
<?= $Page->MK_PAMERANMANDIRI->getViewValue() ?></span>
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
