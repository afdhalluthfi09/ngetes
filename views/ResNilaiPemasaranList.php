<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ResNilaiPemasaranList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fres_nilai_pemasaranlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fres_nilai_pemasaranlist = currentForm = new ew.Form("fres_nilai_pemasaranlist", "list");
    fres_nilai_pemasaranlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fres_nilai_pemasaranlist");
});
var fres_nilai_pemasaranlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fres_nilai_pemasaranlistsrch = currentSearchForm = new ew.Form("fres_nilai_pemasaranlistsrch");

    // Dynamic selection lists

    // Filters
    fres_nilai_pemasaranlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fres_nilai_pemasaranlistsrch");
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
<form name="fres_nilai_pemasaranlistsrch" id="fres_nilai_pemasaranlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fres_nilai_pemasaranlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="res_nilai_pemasaran">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> res_nilai_pemasaran">
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
<form name="fres_nilai_pemasaranlist" id="fres_nilai_pemasaranlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res_nilai_pemasaran">
<div id="gmp_res_nilai_pemasaran" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_res_nilai_pemasaranlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_nik" class="res_nilai_pemasaran_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
        <th data-name="skor_unggul" class="<?= $Page->skor_unggul->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_unggul" class="res_nilai_pemasaran_skor_unggul"><?= $Page->renderSort($Page->skor_unggul) ?></div></th>
<?php } ?>
<?php if ($Page->max_unggul->Visible) { // max_unggul ?>
        <th data-name="max_unggul" class="<?= $Page->max_unggul->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_unggul" class="res_nilai_pemasaran_max_unggul"><?= $Page->renderSort($Page->max_unggul) ?></div></th>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <th data-name="skor_target" class="<?= $Page->skor_target->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_target" class="res_nilai_pemasaran_skor_target"><?= $Page->renderSort($Page->skor_target) ?></div></th>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <th data-name="max_target" class="<?= $Page->max_target->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_target" class="res_nilai_pemasaran_max_target"><?= $Page->renderSort($Page->max_target) ?></div></th>
<?php } ?>
<?php if ($Page->skor_available->Visible) { // skor_available ?>
        <th data-name="skor_available" class="<?= $Page->skor_available->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_available" class="res_nilai_pemasaran_skor_available"><?= $Page->renderSort($Page->skor_available) ?></div></th>
<?php } ?>
<?php if ($Page->max_available->Visible) { // max_available ?>
        <th data-name="max_available" class="<?= $Page->max_available->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_available" class="res_nilai_pemasaran_max_available"><?= $Page->renderSort($Page->max_available) ?></div></th>
<?php } ?>
<?php if ($Page->skor_merk->Visible) { // skor_merk ?>
        <th data-name="skor_merk" class="<?= $Page->skor_merk->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_merk" class="res_nilai_pemasaran_skor_merk"><?= $Page->renderSort($Page->skor_merk) ?></div></th>
<?php } ?>
<?php if ($Page->max_merk->Visible) { // max_merk ?>
        <th data-name="max_merk" class="<?= $Page->max_merk->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_merk" class="res_nilai_pemasaran_max_merk"><?= $Page->renderSort($Page->max_merk) ?></div></th>
<?php } ?>
<?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
        <th data-name="skor_merkhaki" class="<?= $Page->skor_merkhaki->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_merkhaki" class="res_nilai_pemasaran_skor_merkhaki"><?= $Page->renderSort($Page->skor_merkhaki) ?></div></th>
<?php } ?>
<?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
        <th data-name="max_merkhaki" class="<?= $Page->max_merkhaki->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_merkhaki" class="res_nilai_pemasaran_max_merkhaki"><?= $Page->renderSort($Page->max_merkhaki) ?></div></th>
<?php } ?>
<?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
        <th data-name="skor_merkkonsep" class="<?= $Page->skor_merkkonsep->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_merkkonsep" class="res_nilai_pemasaran_skor_merkkonsep"><?= $Page->renderSort($Page->skor_merkkonsep) ?></div></th>
<?php } ?>
<?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
        <th data-name="max_merkkonsep" class="<?= $Page->max_merkkonsep->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_merkkonsep" class="res_nilai_pemasaran_max_merkkonsep"><?= $Page->renderSort($Page->max_merkkonsep) ?></div></th>
<?php } ?>
<?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
        <th data-name="skor_merklisensi" class="<?= $Page->skor_merklisensi->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_merklisensi" class="res_nilai_pemasaran_skor_merklisensi"><?= $Page->renderSort($Page->skor_merklisensi) ?></div></th>
<?php } ?>
<?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
        <th data-name="max_merklisensi" class="<?= $Page->max_merklisensi->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_merklisensi" class="res_nilai_pemasaran_max_merklisensi"><?= $Page->renderSort($Page->max_merklisensi) ?></div></th>
<?php } ?>
<?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
        <th data-name="skor_mitra" class="<?= $Page->skor_mitra->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_mitra" class="res_nilai_pemasaran_skor_mitra"><?= $Page->renderSort($Page->skor_mitra) ?></div></th>
<?php } ?>
<?php if ($Page->max_mitra->Visible) { // max_mitra ?>
        <th data-name="max_mitra" class="<?= $Page->max_mitra->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_mitra" class="res_nilai_pemasaran_max_mitra"><?= $Page->renderSort($Page->max_mitra) ?></div></th>
<?php } ?>
<?php if ($Page->skor_market->Visible) { // skor_market ?>
        <th data-name="skor_market" class="<?= $Page->skor_market->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_market" class="res_nilai_pemasaran_skor_market"><?= $Page->renderSort($Page->skor_market) ?></div></th>
<?php } ?>
<?php if ($Page->max_market->Visible) { // max_market ?>
        <th data-name="max_market" class="<?= $Page->max_market->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_market" class="res_nilai_pemasaran_max_market"><?= $Page->renderSort($Page->max_market) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
        <th data-name="skor_pelangganloyal" class="<?= $Page->skor_pelangganloyal->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_pelangganloyal" class="res_nilai_pemasaran_skor_pelangganloyal"><?= $Page->renderSort($Page->skor_pelangganloyal) ?></div></th>
<?php } ?>
<?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
        <th data-name="max_pelangganloyal" class="<?= $Page->max_pelangganloyal->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_pelangganloyal" class="res_nilai_pemasaran_max_pelangganloyal"><?= $Page->renderSort($Page->max_pelangganloyal) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
        <th data-name="skor_pameranmandiri" class="<?= $Page->skor_pameranmandiri->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_pameranmandiri" class="res_nilai_pemasaran_skor_pameranmandiri"><?= $Page->renderSort($Page->skor_pameranmandiri) ?></div></th>
<?php } ?>
<?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
        <th data-name="max_pameranmandiri" class="<?= $Page->max_pameranmandiri->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_pameranmandiri" class="res_nilai_pemasaran_max_pameranmandiri"><?= $Page->renderSort($Page->max_pameranmandiri) ?></div></th>
<?php } ?>
<?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
        <th data-name="skor_mediaoffline" class="<?= $Page->skor_mediaoffline->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_skor_mediaoffline" class="res_nilai_pemasaran_skor_mediaoffline"><?= $Page->renderSort($Page->skor_mediaoffline) ?></div></th>
<?php } ?>
<?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
        <th data-name="max_mediaoffline" class="<?= $Page->max_mediaoffline->headerCellClass() ?>"><div id="elh_res_nilai_pemasaran_max_mediaoffline" class="res_nilai_pemasaran_max_mediaoffline"><?= $Page->renderSort($Page->max_mediaoffline) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_res_nilai_pemasaran", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
        <td data-name="skor_unggul" <?= $Page->skor_unggul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_unggul">
<span<?= $Page->skor_unggul->viewAttributes() ?>>
<?= $Page->skor_unggul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_unggul->Visible) { // max_unggul ?>
        <td data-name="max_unggul" <?= $Page->max_unggul->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_unggul">
<span<?= $Page->max_unggul->viewAttributes() ?>>
<?= $Page->max_unggul->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_target->Visible) { // skor_target ?>
        <td data-name="skor_target" <?= $Page->skor_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_target->Visible) { // max_target ?>
        <td data-name="max_target" <?= $Page->max_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_available->Visible) { // skor_available ?>
        <td data-name="skor_available" <?= $Page->skor_available->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_available">
<span<?= $Page->skor_available->viewAttributes() ?>>
<?= $Page->skor_available->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_available->Visible) { // max_available ?>
        <td data-name="max_available" <?= $Page->max_available->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_available">
<span<?= $Page->max_available->viewAttributes() ?>>
<?= $Page->max_available->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_merk->Visible) { // skor_merk ?>
        <td data-name="skor_merk" <?= $Page->skor_merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_merk">
<span<?= $Page->skor_merk->viewAttributes() ?>>
<?= $Page->skor_merk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_merk->Visible) { // max_merk ?>
        <td data-name="max_merk" <?= $Page->max_merk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_merk">
<span<?= $Page->max_merk->viewAttributes() ?>>
<?= $Page->max_merk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
        <td data-name="skor_merkhaki" <?= $Page->skor_merkhaki->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_merkhaki">
<span<?= $Page->skor_merkhaki->viewAttributes() ?>>
<?= $Page->skor_merkhaki->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
        <td data-name="max_merkhaki" <?= $Page->max_merkhaki->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_merkhaki">
<span<?= $Page->max_merkhaki->viewAttributes() ?>>
<?= $Page->max_merkhaki->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
        <td data-name="skor_merkkonsep" <?= $Page->skor_merkkonsep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_merkkonsep">
<span<?= $Page->skor_merkkonsep->viewAttributes() ?>>
<?= $Page->skor_merkkonsep->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
        <td data-name="max_merkkonsep" <?= $Page->max_merkkonsep->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_merkkonsep">
<span<?= $Page->max_merkkonsep->viewAttributes() ?>>
<?= $Page->max_merkkonsep->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
        <td data-name="skor_merklisensi" <?= $Page->skor_merklisensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_merklisensi">
<span<?= $Page->skor_merklisensi->viewAttributes() ?>>
<?= $Page->skor_merklisensi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
        <td data-name="max_merklisensi" <?= $Page->max_merklisensi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_merklisensi">
<span<?= $Page->max_merklisensi->viewAttributes() ?>>
<?= $Page->max_merklisensi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
        <td data-name="skor_mitra" <?= $Page->skor_mitra->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_mitra">
<span<?= $Page->skor_mitra->viewAttributes() ?>>
<?= $Page->skor_mitra->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_mitra->Visible) { // max_mitra ?>
        <td data-name="max_mitra" <?= $Page->max_mitra->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_mitra">
<span<?= $Page->max_mitra->viewAttributes() ?>>
<?= $Page->max_mitra->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_market->Visible) { // skor_market ?>
        <td data-name="skor_market" <?= $Page->skor_market->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_market">
<span<?= $Page->skor_market->viewAttributes() ?>>
<?= $Page->skor_market->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_market->Visible) { // max_market ?>
        <td data-name="max_market" <?= $Page->max_market->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_market">
<span<?= $Page->max_market->viewAttributes() ?>>
<?= $Page->max_market->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
        <td data-name="skor_pelangganloyal" <?= $Page->skor_pelangganloyal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_pelangganloyal">
<span<?= $Page->skor_pelangganloyal->viewAttributes() ?>>
<?= $Page->skor_pelangganloyal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
        <td data-name="max_pelangganloyal" <?= $Page->max_pelangganloyal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_pelangganloyal">
<span<?= $Page->max_pelangganloyal->viewAttributes() ?>>
<?= $Page->max_pelangganloyal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
        <td data-name="skor_pameranmandiri" <?= $Page->skor_pameranmandiri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_pameranmandiri">
<span<?= $Page->skor_pameranmandiri->viewAttributes() ?>>
<?= $Page->skor_pameranmandiri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
        <td data-name="max_pameranmandiri" <?= $Page->max_pameranmandiri->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_pameranmandiri">
<span<?= $Page->max_pameranmandiri->viewAttributes() ?>>
<?= $Page->max_pameranmandiri->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
        <td data-name="skor_mediaoffline" <?= $Page->skor_mediaoffline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_skor_mediaoffline">
<span<?= $Page->skor_mediaoffline->viewAttributes() ?>>
<?= $Page->skor_mediaoffline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
        <td data-name="max_mediaoffline" <?= $Page->max_mediaoffline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_pemasaran_max_mediaoffline">
<span<?= $Page->max_mediaoffline->viewAttributes() ?>>
<?= $Page->max_mediaoffline->getViewValue() ?></span>
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
    ew.addEventHandlers("res_nilai_pemasaran");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
