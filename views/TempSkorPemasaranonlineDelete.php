<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranonlineDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasaranonlinedelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    ftemp_skor_pemasaranonlinedelete = currentForm = new ew.Form("ftemp_skor_pemasaranonlinedelete", "delete");
    loadjs.done("ftemp_skor_pemasaranonlinedelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.temp_skor_pemasaranonline) ew.vars.tables.temp_skor_pemasaranonline = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaranonline")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="ftemp_skor_pemasaranonlinedelete" id="ftemp_skor_pemasaranonlinedelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaranonline">
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
<?php if ($Page->nik->Visible) { // nik ?>
        <th class="<?= $Page->nik->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_nik" class="temp_skor_pemasaranonline_nik"><?= $Page->nik->caption() ?></span></th>
<?php } ?>
<?php if ($Page->chatting->Visible) { // chatting ?>
        <th class="<?= $Page->chatting->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_chatting" class="temp_skor_pemasaranonline_chatting"><?= $Page->chatting->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
        <th class="<?= $Page->skor_chatting->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_chatting" class="temp_skor_pemasaranonline_skor_chatting"><?= $Page->skor_chatting->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_chatting->Visible) { // max_chatting ?>
        <th class="<?= $Page->max_chatting->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_chatting" class="temp_skor_pemasaranonline_max_chatting"><?= $Page->max_chatting->caption() ?></span></th>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
        <th class="<?= $Page->medsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_medsos" class="temp_skor_pemasaranonline_medsos"><?= $Page->medsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
        <th class="<?= $Page->skor_medsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_medsos" class="temp_skor_pemasaranonline_skor_medsos"><?= $Page->skor_medsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_medsos->Visible) { // max_medsos ?>
        <th class="<?= $Page->max_medsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_medsos" class="temp_skor_pemasaranonline_max_medsos"><?= $Page->max_medsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->marketplace->Visible) { // marketplace ?>
        <th class="<?= $Page->marketplace->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_marketplace" class="temp_skor_pemasaranonline_marketplace"><?= $Page->marketplace->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_mp->Visible) { // skor_mp ?>
        <th class="<?= $Page->skor_mp->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_mp" class="temp_skor_pemasaranonline_skor_mp"><?= $Page->skor_mp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_mp->Visible) { // max_mp ?>
        <th class="<?= $Page->max_mp->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_mp" class="temp_skor_pemasaranonline_max_mp"><?= $Page->max_mp->caption() ?></span></th>
<?php } ?>
<?php if ($Page->gmb->Visible) { // gmb ?>
        <th class="<?= $Page->gmb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_gmb" class="temp_skor_pemasaranonline_gmb"><?= $Page->gmb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
        <th class="<?= $Page->skor_gmb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_gmb" class="temp_skor_pemasaranonline_skor_gmb"><?= $Page->skor_gmb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_gmb->Visible) { // max_gmb ?>
        <th class="<?= $Page->max_gmb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_gmb" class="temp_skor_pemasaranonline_max_gmb"><?= $Page->max_gmb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <th class="<?= $Page->web->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_web" class="temp_skor_pemasaranonline_web"><?= $Page->web->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_web->Visible) { // skor_web ?>
        <th class="<?= $Page->skor_web->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_web" class="temp_skor_pemasaranonline_skor_web"><?= $Page->skor_web->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_web->Visible) { // max_web ?>
        <th class="<?= $Page->max_web->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_web" class="temp_skor_pemasaranonline_max_web"><?= $Page->max_web->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
        <th class="<?= $Page->updatemedsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_updatemedsos" class="temp_skor_pemasaranonline_updatemedsos"><?= $Page->updatemedsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
        <th class="<?= $Page->skor_updatemedsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_updatemedsos" class="temp_skor_pemasaranonline_skor_updatemedsos"><?= $Page->skor_updatemedsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
        <th class="<?= $Page->max_updatemedsos->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_updatemedsos" class="temp_skor_pemasaranonline_max_updatemedsos"><?= $Page->max_updatemedsos->caption() ?></span></th>
<?php } ?>
<?php if ($Page->updateweb->Visible) { // updateweb ?>
        <th class="<?= $Page->updateweb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_updateweb" class="temp_skor_pemasaranonline_updateweb"><?= $Page->updateweb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
        <th class="<?= $Page->skor_updateweb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_updateweb" class="temp_skor_pemasaranonline_skor_updateweb"><?= $Page->skor_updateweb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
        <th class="<?= $Page->max_updateweb->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_updateweb" class="temp_skor_pemasaranonline_max_updateweb"><?= $Page->max_updateweb->caption() ?></span></th>
<?php } ?>
<?php if ($Page->seo->Visible) { // seo ?>
        <th class="<?= $Page->seo->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_seo" class="temp_skor_pemasaranonline_seo"><?= $Page->seo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_seo->Visible) { // skor_seo ?>
        <th class="<?= $Page->skor_seo->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_seo" class="temp_skor_pemasaranonline_skor_seo"><?= $Page->skor_seo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_seo->Visible) { // max_seo ?>
        <th class="<?= $Page->max_seo->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_seo" class="temp_skor_pemasaranonline_max_seo"><?= $Page->max_seo->caption() ?></span></th>
<?php } ?>
<?php if ($Page->iklan->Visible) { // iklan ?>
        <th class="<?= $Page->iklan->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_iklan" class="temp_skor_pemasaranonline_iklan"><?= $Page->iklan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
        <th class="<?= $Page->skor_iklan->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_iklan" class="temp_skor_pemasaranonline_skor_iklan"><?= $Page->skor_iklan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->max_iklan->Visible) { // max_iklan ?>
        <th class="<?= $Page->max_iklan->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_max_iklan" class="temp_skor_pemasaranonline_max_iklan"><?= $Page->max_iklan->caption() ?></span></th>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <th class="<?= $Page->skor_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_skor_pemasaranonline" class="temp_skor_pemasaranonline_skor_pemasaranonline"><?= $Page->skor_pemasaranonline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <th class="<?= $Page->maxskor_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_maxskor_pemasaranonline" class="temp_skor_pemasaranonline_maxskor_pemasaranonline"><?= $Page->maxskor_pemasaranonline->caption() ?></span></th>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <th class="<?= $Page->bobot_pemasaranonline->headerCellClass() ?>"><span id="elh_temp_skor_pemasaranonline_bobot_pemasaranonline" class="temp_skor_pemasaranonline_bobot_pemasaranonline"><?= $Page->bobot_pemasaranonline->caption() ?></span></th>
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
<?php if ($Page->nik->Visible) { // nik ?>
        <td <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_nik" class="temp_skor_pemasaranonline_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->chatting->Visible) { // chatting ?>
        <td <?= $Page->chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_chatting" class="temp_skor_pemasaranonline_chatting">
<span<?= $Page->chatting->viewAttributes() ?>>
<?= $Page->chatting->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
        <td <?= $Page->skor_chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_chatting" class="temp_skor_pemasaranonline_skor_chatting">
<span<?= $Page->skor_chatting->viewAttributes() ?>>
<?= $Page->skor_chatting->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_chatting->Visible) { // max_chatting ?>
        <td <?= $Page->max_chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_chatting" class="temp_skor_pemasaranonline_max_chatting">
<span<?= $Page->max_chatting->viewAttributes() ?>>
<?= $Page->max_chatting->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
        <td <?= $Page->medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_medsos" class="temp_skor_pemasaranonline_medsos">
<span<?= $Page->medsos->viewAttributes() ?>>
<?= $Page->medsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
        <td <?= $Page->skor_medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_medsos" class="temp_skor_pemasaranonline_skor_medsos">
<span<?= $Page->skor_medsos->viewAttributes() ?>>
<?= $Page->skor_medsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_medsos->Visible) { // max_medsos ?>
        <td <?= $Page->max_medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_medsos" class="temp_skor_pemasaranonline_max_medsos">
<span<?= $Page->max_medsos->viewAttributes() ?>>
<?= $Page->max_medsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->marketplace->Visible) { // marketplace ?>
        <td <?= $Page->marketplace->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_marketplace" class="temp_skor_pemasaranonline_marketplace">
<span<?= $Page->marketplace->viewAttributes() ?>>
<?= $Page->marketplace->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_mp->Visible) { // skor_mp ?>
        <td <?= $Page->skor_mp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_mp" class="temp_skor_pemasaranonline_skor_mp">
<span<?= $Page->skor_mp->viewAttributes() ?>>
<?= $Page->skor_mp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_mp->Visible) { // max_mp ?>
        <td <?= $Page->max_mp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_mp" class="temp_skor_pemasaranonline_max_mp">
<span<?= $Page->max_mp->viewAttributes() ?>>
<?= $Page->max_mp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->gmb->Visible) { // gmb ?>
        <td <?= $Page->gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_gmb" class="temp_skor_pemasaranonline_gmb">
<span<?= $Page->gmb->viewAttributes() ?>>
<?= $Page->gmb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
        <td <?= $Page->skor_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_gmb" class="temp_skor_pemasaranonline_skor_gmb">
<span<?= $Page->skor_gmb->viewAttributes() ?>>
<?= $Page->skor_gmb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_gmb->Visible) { // max_gmb ?>
        <td <?= $Page->max_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_gmb" class="temp_skor_pemasaranonline_max_gmb">
<span<?= $Page->max_gmb->viewAttributes() ?>>
<?= $Page->max_gmb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <td <?= $Page->web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_web" class="temp_skor_pemasaranonline_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_web->Visible) { // skor_web ?>
        <td <?= $Page->skor_web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_web" class="temp_skor_pemasaranonline_skor_web">
<span<?= $Page->skor_web->viewAttributes() ?>>
<?= $Page->skor_web->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_web->Visible) { // max_web ?>
        <td <?= $Page->max_web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_web" class="temp_skor_pemasaranonline_max_web">
<span<?= $Page->max_web->viewAttributes() ?>>
<?= $Page->max_web->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
        <td <?= $Page->updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_updatemedsos" class="temp_skor_pemasaranonline_updatemedsos">
<span<?= $Page->updatemedsos->viewAttributes() ?>>
<?= $Page->updatemedsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
        <td <?= $Page->skor_updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_updatemedsos" class="temp_skor_pemasaranonline_skor_updatemedsos">
<span<?= $Page->skor_updatemedsos->viewAttributes() ?>>
<?= $Page->skor_updatemedsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
        <td <?= $Page->max_updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_updatemedsos" class="temp_skor_pemasaranonline_max_updatemedsos">
<span<?= $Page->max_updatemedsos->viewAttributes() ?>>
<?= $Page->max_updatemedsos->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->updateweb->Visible) { // updateweb ?>
        <td <?= $Page->updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_updateweb" class="temp_skor_pemasaranonline_updateweb">
<span<?= $Page->updateweb->viewAttributes() ?>>
<?= $Page->updateweb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
        <td <?= $Page->skor_updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_updateweb" class="temp_skor_pemasaranonline_skor_updateweb">
<span<?= $Page->skor_updateweb->viewAttributes() ?>>
<?= $Page->skor_updateweb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
        <td <?= $Page->max_updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_updateweb" class="temp_skor_pemasaranonline_max_updateweb">
<span<?= $Page->max_updateweb->viewAttributes() ?>>
<?= $Page->max_updateweb->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->seo->Visible) { // seo ?>
        <td <?= $Page->seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_seo" class="temp_skor_pemasaranonline_seo">
<span<?= $Page->seo->viewAttributes() ?>>
<?= $Page->seo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_seo->Visible) { // skor_seo ?>
        <td <?= $Page->skor_seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_seo" class="temp_skor_pemasaranonline_skor_seo">
<span<?= $Page->skor_seo->viewAttributes() ?>>
<?= $Page->skor_seo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_seo->Visible) { // max_seo ?>
        <td <?= $Page->max_seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_seo" class="temp_skor_pemasaranonline_max_seo">
<span<?= $Page->max_seo->viewAttributes() ?>>
<?= $Page->max_seo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->iklan->Visible) { // iklan ?>
        <td <?= $Page->iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_iklan" class="temp_skor_pemasaranonline_iklan">
<span<?= $Page->iklan->viewAttributes() ?>>
<?= $Page->iklan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
        <td <?= $Page->skor_iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_iklan" class="temp_skor_pemasaranonline_skor_iklan">
<span<?= $Page->skor_iklan->viewAttributes() ?>>
<?= $Page->skor_iklan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->max_iklan->Visible) { // max_iklan ?>
        <td <?= $Page->max_iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_max_iklan" class="temp_skor_pemasaranonline_max_iklan">
<span<?= $Page->max_iklan->viewAttributes() ?>>
<?= $Page->max_iklan->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <td <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_skor_pemasaranonline" class="temp_skor_pemasaranonline_skor_pemasaranonline">
<span<?= $Page->skor_pemasaranonline->viewAttributes() ?>>
<?= $Page->skor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <td <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_maxskor_pemasaranonline" class="temp_skor_pemasaranonline_maxskor_pemasaranonline">
<span<?= $Page->maxskor_pemasaranonline->viewAttributes() ?>>
<?= $Page->maxskor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <td <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_pemasaranonline_bobot_pemasaranonline" class="temp_skor_pemasaranonline_bobot_pemasaranonline">
<span<?= $Page->bobot_pemasaranonline->viewAttributes() ?>>
<?= $Page->bobot_pemasaranonline->getViewValue() ?></span>
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
