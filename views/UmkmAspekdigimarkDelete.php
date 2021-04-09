<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimarkdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fumkm_aspekdigimarkdelete = currentForm = new ew.Form("fumkm_aspekdigimarkdelete", "delete");
    loadjs.done("fumkm_aspekdigimarkdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.umkm_aspekdigimark) ew.vars.tables.umkm_aspekdigimark = <?= JsonEncode(GetClientVar("tables", "umkm_aspekdigimark")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspekdigimarkdelete" id="fumkm_aspekdigimarkdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark">
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
        <th class="<?= $Page->NIK->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_NIK" class="umkm_aspekdigimark_NIK"><?= $Page->NIK->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
        <th class="<?= $Page->DM_CHATTING->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_CHATTING" class="umkm_aspekdigimark_DM_CHATTING"><?= $Page->DM_CHATTING->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
        <th class="<?= $Page->DM_MEDSOS->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_MEDSOS" class="umkm_aspekdigimark_DM_MEDSOS"><?= $Page->DM_MEDSOS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
        <th class="<?= $Page->DM_MP->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_MP" class="umkm_aspekdigimark_DM_MP"><?= $Page->DM_MP->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
        <th class="<?= $Page->DM_GMB->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_GMB" class="umkm_aspekdigimark_DM_GMB"><?= $Page->DM_GMB->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
        <th class="<?= $Page->DM_WEB->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_WEB" class="umkm_aspekdigimark_DM_WEB"><?= $Page->DM_WEB->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
        <th class="<?= $Page->DM_UPDATEMEDSOS->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_UPDATEMEDSOS" class="umkm_aspekdigimark_DM_UPDATEMEDSOS"><?= $Page->DM_UPDATEMEDSOS->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
        <th class="<?= $Page->DM_UPDATEWEBSITE->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_UPDATEWEBSITE" class="umkm_aspekdigimark_DM_UPDATEWEBSITE"><?= $Page->DM_UPDATEWEBSITE->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
        <th class="<?= $Page->DM_GOOGLEINDEX->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_GOOGLEINDEX" class="umkm_aspekdigimark_DM_GOOGLEINDEX"><?= $Page->DM_GOOGLEINDEX->caption() ?></span></th>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
        <th class="<?= $Page->DM_IKLANBERBAYAR->headerCellClass() ?>"><span id="elh_umkm_aspekdigimark_DM_IKLANBERBAYAR" class="umkm_aspekdigimark_DM_IKLANBERBAYAR"><?= $Page->DM_IKLANBERBAYAR->caption() ?></span></th>
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
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_NIK" class="umkm_aspekdigimark_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
        <td <?= $Page->DM_CHATTING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_CHATTING" class="umkm_aspekdigimark_DM_CHATTING">
<span<?= $Page->DM_CHATTING->viewAttributes() ?>>
<?= $Page->DM_CHATTING->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
        <td <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MEDSOS" class="umkm_aspekdigimark_DM_MEDSOS">
<span<?= $Page->DM_MEDSOS->viewAttributes() ?>>
<?= $Page->DM_MEDSOS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
        <td <?= $Page->DM_MP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MP" class="umkm_aspekdigimark_DM_MP">
<span<?= $Page->DM_MP->viewAttributes() ?>>
<?= $Page->DM_MP->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
        <td <?= $Page->DM_GMB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GMB" class="umkm_aspekdigimark_DM_GMB">
<span<?= $Page->DM_GMB->viewAttributes() ?>>
<?= $Page->DM_GMB->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
        <td <?= $Page->DM_WEB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_WEB" class="umkm_aspekdigimark_DM_WEB">
<span<?= $Page->DM_WEB->viewAttributes() ?>>
<?= $Page->DM_WEB->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
        <td <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEMEDSOS" class="umkm_aspekdigimark_DM_UPDATEMEDSOS">
<span<?= $Page->DM_UPDATEMEDSOS->viewAttributes() ?>>
<?= $Page->DM_UPDATEMEDSOS->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
        <td <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEWEBSITE" class="umkm_aspekdigimark_DM_UPDATEWEBSITE">
<span<?= $Page->DM_UPDATEWEBSITE->viewAttributes() ?>>
<?= $Page->DM_UPDATEWEBSITE->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
        <td <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GOOGLEINDEX" class="umkm_aspekdigimark_DM_GOOGLEINDEX">
<span<?= $Page->DM_GOOGLEINDEX->viewAttributes() ?>>
<?= $Page->DM_GOOGLEINDEX->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
        <td <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_IKLANBERBAYAR" class="umkm_aspekdigimark_DM_IKLANBERBAYAR">
<span<?= $Page->DM_IKLANBERBAYAR->viewAttributes() ?>>
<?= $Page->DM_IKLANBERBAYAR->getViewValue() ?></span>
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
