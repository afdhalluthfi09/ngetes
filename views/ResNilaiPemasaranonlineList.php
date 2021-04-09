<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ResNilaiPemasaranonlineList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fres_nilai_pemasaranonlinelist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fres_nilai_pemasaranonlinelist = currentForm = new ew.Form("fres_nilai_pemasaranonlinelist", "list");
    fres_nilai_pemasaranonlinelist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fres_nilai_pemasaranonlinelist");
});
var fres_nilai_pemasaranonlinelistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fres_nilai_pemasaranonlinelistsrch = currentSearchForm = new ew.Form("fres_nilai_pemasaranonlinelistsrch");

    // Dynamic selection lists

    // Filters
    fres_nilai_pemasaranonlinelistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fres_nilai_pemasaranonlinelistsrch");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fres_nilai_pemasaranonlinelistsrch" id="fres_nilai_pemasaranonlinelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fres_nilai_pemasaranonlinelistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="res_nilai_pemasaranonline">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> res_nilai_pemasaranonline">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fres_nilai_pemasaranonlinelist" id="fres_nilai_pemasaranonlinelist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res_nilai_pemasaranonline">
<div id="gmp_res_nilai_pemasaranonline" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_res_nilai_pemasaranonlinelist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_nik" class="res_nilai_pemasaranonline_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->chatting->Visible) { // chatting ?>
        <th data-name="chatting" class="<?= $Page->chatting->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_chatting" class="res_nilai_pemasaranonline_chatting"><?= $Page->renderSort($Page->chatting) ?></div></th>
<?php } ?>
<?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
        <th data-name="skor_chatting" class="<?= $Page->skor_chatting->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_chatting" class="res_nilai_pemasaranonline_skor_chatting"><?= $Page->renderSort($Page->skor_chatting) ?></div></th>
<?php } ?>
<?php if ($Page->max_chatting->Visible) { // max_chatting ?>
        <th data-name="max_chatting" class="<?= $Page->max_chatting->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_chatting" class="res_nilai_pemasaranonline_max_chatting"><?= $Page->renderSort($Page->max_chatting) ?></div></th>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
        <th data-name="medsos" class="<?= $Page->medsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_medsos" class="res_nilai_pemasaranonline_medsos"><?= $Page->renderSort($Page->medsos) ?></div></th>
<?php } ?>
<?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
        <th data-name="skor_medsos" class="<?= $Page->skor_medsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_medsos" class="res_nilai_pemasaranonline_skor_medsos"><?= $Page->renderSort($Page->skor_medsos) ?></div></th>
<?php } ?>
<?php if ($Page->max_medsos->Visible) { // max_medsos ?>
        <th data-name="max_medsos" class="<?= $Page->max_medsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_medsos" class="res_nilai_pemasaranonline_max_medsos"><?= $Page->renderSort($Page->max_medsos) ?></div></th>
<?php } ?>
<?php if ($Page->marketplace->Visible) { // marketplace ?>
        <th data-name="marketplace" class="<?= $Page->marketplace->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_marketplace" class="res_nilai_pemasaranonline_marketplace"><?= $Page->renderSort($Page->marketplace) ?></div></th>
<?php } ?>
<?php if ($Page->skor_mp->Visible) { // skor_mp ?>
        <th data-name="skor_mp" class="<?= $Page->skor_mp->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_mp" class="res_nilai_pemasaranonline_skor_mp"><?= $Page->renderSort($Page->skor_mp) ?></div></th>
<?php } ?>
<?php if ($Page->max_mp->Visible) { // max_mp ?>
        <th data-name="max_mp" class="<?= $Page->max_mp->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_mp" class="res_nilai_pemasaranonline_max_mp"><?= $Page->renderSort($Page->max_mp) ?></div></th>
<?php } ?>
<?php if ($Page->gmb->Visible) { // gmb ?>
        <th data-name="gmb" class="<?= $Page->gmb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_gmb" class="res_nilai_pemasaranonline_gmb"><?= $Page->renderSort($Page->gmb) ?></div></th>
<?php } ?>
<?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
        <th data-name="skor_gmb" class="<?= $Page->skor_gmb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_gmb" class="res_nilai_pemasaranonline_skor_gmb"><?= $Page->renderSort($Page->skor_gmb) ?></div></th>
<?php } ?>
<?php if ($Page->max_gmb->Visible) { // max_gmb ?>
        <th data-name="max_gmb" class="<?= $Page->max_gmb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_gmb" class="res_nilai_pemasaranonline_max_gmb"><?= $Page->renderSort($Page->max_gmb) ?></div></th>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
        <th data-name="web" class="<?= $Page->web->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_web" class="res_nilai_pemasaranonline_web"><?= $Page->renderSort($Page->web) ?></div></th>
<?php } ?>
<?php if ($Page->skor_web->Visible) { // skor_web ?>
        <th data-name="skor_web" class="<?= $Page->skor_web->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_web" class="res_nilai_pemasaranonline_skor_web"><?= $Page->renderSort($Page->skor_web) ?></div></th>
<?php } ?>
<?php if ($Page->max_web->Visible) { // max_web ?>
        <th data-name="max_web" class="<?= $Page->max_web->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_web" class="res_nilai_pemasaranonline_max_web"><?= $Page->renderSort($Page->max_web) ?></div></th>
<?php } ?>
<?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
        <th data-name="updatemedsos" class="<?= $Page->updatemedsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_updatemedsos" class="res_nilai_pemasaranonline_updatemedsos"><?= $Page->renderSort($Page->updatemedsos) ?></div></th>
<?php } ?>
<?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
        <th data-name="skor_updatemedsos" class="<?= $Page->skor_updatemedsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_updatemedsos" class="res_nilai_pemasaranonline_skor_updatemedsos"><?= $Page->renderSort($Page->skor_updatemedsos) ?></div></th>
<?php } ?>
<?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
        <th data-name="max_updatemedsos" class="<?= $Page->max_updatemedsos->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_updatemedsos" class="res_nilai_pemasaranonline_max_updatemedsos"><?= $Page->renderSort($Page->max_updatemedsos) ?></div></th>
<?php } ?>
<?php if ($Page->updateweb->Visible) { // updateweb ?>
        <th data-name="updateweb" class="<?= $Page->updateweb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_updateweb" class="res_nilai_pemasaranonline_updateweb"><?= $Page->renderSort($Page->updateweb) ?></div></th>
<?php } ?>
<?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
        <th data-name="skor_updateweb" class="<?= $Page->skor_updateweb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_updateweb" class="res_nilai_pemasaranonline_skor_updateweb"><?= $Page->renderSort($Page->skor_updateweb) ?></div></th>
<?php } ?>
<?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
        <th data-name="max_updateweb" class="<?= $Page->max_updateweb->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_updateweb" class="res_nilai_pemasaranonline_max_updateweb"><?= $Page->renderSort($Page->max_updateweb) ?></div></th>
<?php } ?>
<?php if ($Page->seo->Visible) { // seo ?>
        <th data-name="seo" class="<?= $Page->seo->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_seo" class="res_nilai_pemasaranonline_seo"><?= $Page->renderSort($Page->seo) ?></div></th>
<?php } ?>
<?php if ($Page->skor_seo->Visible) { // skor_seo ?>
        <th data-name="skor_seo" class="<?= $Page->skor_seo->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_seo" class="res_nilai_pemasaranonline_skor_seo"><?= $Page->renderSort($Page->skor_seo) ?></div></th>
<?php } ?>
<?php if ($Page->max_seo->Visible) { // max_seo ?>
        <th data-name="max_seo" class="<?= $Page->max_seo->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_seo" class="res_nilai_pemasaranonline_max_seo"><?= $Page->renderSort($Page->max_seo) ?></div></th>
<?php } ?>
<?php if ($Page->iklan->Visible) { // iklan ?>
        <th data-name="iklan" class="<?= $Page->iklan->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_iklan" class="res_nilai_pemasaranonline_iklan"><?= $Page->renderSort($Page->iklan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
        <th data-name="skor_iklan" class="<?= $Page->skor_iklan->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_skor_iklan" class="res_nilai_pemasaranonline_skor_iklan"><?= $Page->renderSort($Page->skor_iklan) ?></div></th>
<?php } ?>
<?php if ($Page->max_iklan->Visible) { // max_iklan ?>
        <th data-name="max_iklan" class="<?= $Page->max_iklan->headerCellClass() ?>"><div id="elh_res_nilai_pemasaranonline_max_iklan" class="res_nilai_pemasaranonline_max_iklan"><?= $Page->renderSort($Page->max_iklan) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_res_nilai_pemasaranonline", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->nik->Visible) { // nik ?>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->chatting->Visible) { // chatting ?>
        <td data-name="chatting" <?= $Page->chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_chatting">
<span<?= $Page->chatting->viewAttributes() ?>>
<?= $Page->chatting->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
        <td data-name="skor_chatting" <?= $Page->skor_chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_chatting">
<span<?= $Page->skor_chatting->viewAttributes() ?>>
<?= $Page->skor_chatting->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_chatting->Visible) { // max_chatting ?>
        <td data-name="max_chatting" <?= $Page->max_chatting->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_chatting">
<span<?= $Page->max_chatting->viewAttributes() ?>>
<?= $Page->max_chatting->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->medsos->Visible) { // medsos ?>
        <td data-name="medsos" <?= $Page->medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_medsos">
<span<?= $Page->medsos->viewAttributes() ?>>
<?= $Page->medsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
        <td data-name="skor_medsos" <?= $Page->skor_medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_medsos">
<span<?= $Page->skor_medsos->viewAttributes() ?>>
<?= $Page->skor_medsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_medsos->Visible) { // max_medsos ?>
        <td data-name="max_medsos" <?= $Page->max_medsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_medsos">
<span<?= $Page->max_medsos->viewAttributes() ?>>
<?= $Page->max_medsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->marketplace->Visible) { // marketplace ?>
        <td data-name="marketplace" <?= $Page->marketplace->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_marketplace">
<span<?= $Page->marketplace->viewAttributes() ?>>
<?= $Page->marketplace->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_mp->Visible) { // skor_mp ?>
        <td data-name="skor_mp" <?= $Page->skor_mp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_mp">
<span<?= $Page->skor_mp->viewAttributes() ?>>
<?= $Page->skor_mp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_mp->Visible) { // max_mp ?>
        <td data-name="max_mp" <?= $Page->max_mp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_mp">
<span<?= $Page->max_mp->viewAttributes() ?>>
<?= $Page->max_mp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->gmb->Visible) { // gmb ?>
        <td data-name="gmb" <?= $Page->gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_gmb">
<span<?= $Page->gmb->viewAttributes() ?>>
<?= $Page->gmb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
        <td data-name="skor_gmb" <?= $Page->skor_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_gmb">
<span<?= $Page->skor_gmb->viewAttributes() ?>>
<?= $Page->skor_gmb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_gmb->Visible) { // max_gmb ?>
        <td data-name="max_gmb" <?= $Page->max_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_gmb">
<span<?= $Page->max_gmb->viewAttributes() ?>>
<?= $Page->max_gmb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->web->Visible) { // web ?>
        <td data-name="web" <?= $Page->web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_web">
<span<?= $Page->web->viewAttributes() ?>>
<?= $Page->web->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_web->Visible) { // skor_web ?>
        <td data-name="skor_web" <?= $Page->skor_web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_web">
<span<?= $Page->skor_web->viewAttributes() ?>>
<?= $Page->skor_web->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_web->Visible) { // max_web ?>
        <td data-name="max_web" <?= $Page->max_web->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_web">
<span<?= $Page->max_web->viewAttributes() ?>>
<?= $Page->max_web->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
        <td data-name="updatemedsos" <?= $Page->updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_updatemedsos">
<span<?= $Page->updatemedsos->viewAttributes() ?>>
<?= $Page->updatemedsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
        <td data-name="skor_updatemedsos" <?= $Page->skor_updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_updatemedsos">
<span<?= $Page->skor_updatemedsos->viewAttributes() ?>>
<?= $Page->skor_updatemedsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
        <td data-name="max_updatemedsos" <?= $Page->max_updatemedsos->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_updatemedsos">
<span<?= $Page->max_updatemedsos->viewAttributes() ?>>
<?= $Page->max_updatemedsos->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->updateweb->Visible) { // updateweb ?>
        <td data-name="updateweb" <?= $Page->updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_updateweb">
<span<?= $Page->updateweb->viewAttributes() ?>>
<?= $Page->updateweb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
        <td data-name="skor_updateweb" <?= $Page->skor_updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_updateweb">
<span<?= $Page->skor_updateweb->viewAttributes() ?>>
<?= $Page->skor_updateweb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
        <td data-name="max_updateweb" <?= $Page->max_updateweb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_updateweb">
<span<?= $Page->max_updateweb->viewAttributes() ?>>
<?= $Page->max_updateweb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->seo->Visible) { // seo ?>
        <td data-name="seo" <?= $Page->seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_seo">
<span<?= $Page->seo->viewAttributes() ?>>
<?= $Page->seo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_seo->Visible) { // skor_seo ?>
        <td data-name="skor_seo" <?= $Page->skor_seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_seo">
<span<?= $Page->skor_seo->viewAttributes() ?>>
<?= $Page->skor_seo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_seo->Visible) { // max_seo ?>
        <td data-name="max_seo" <?= $Page->max_seo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_seo">
<span<?= $Page->max_seo->viewAttributes() ?>>
<?= $Page->max_seo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->iklan->Visible) { // iklan ?>
        <td data-name="iklan" <?= $Page->iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_iklan">
<span<?= $Page->iklan->viewAttributes() ?>>
<?= $Page->iklan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
        <td data-name="skor_iklan" <?= $Page->skor_iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_skor_iklan">
<span<?= $Page->skor_iklan->viewAttributes() ?>>
<?= $Page->skor_iklan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_iklan->Visible) { // max_iklan ?>
        <td data-name="max_iklan" <?= $Page->max_iklan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaranonline_max_iklan">
<span<?= $Page->max_iklan->viewAttributes() ?>>
<?= $Page->max_iklan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("res_nilai_pemasaranonline");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
