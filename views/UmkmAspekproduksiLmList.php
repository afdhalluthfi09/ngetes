<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksi_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekproduksi_lmlist = currentForm = new ew.Form("fumkm_aspekproduksi_lmlist", "list");
    fumkm_aspekproduksi_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspekproduksi_lmlist");
});
var fumkm_aspekproduksi_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspekproduksi_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspekproduksi_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspekproduksi_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspekproduksi_lmlistsrch");
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
<form name="fumkm_aspekproduksi_lmlistsrch" id="fumkm_aspekproduksi_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspekproduksi_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspekproduksi_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspekproduksi_lm">
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
<form name="fumkm_aspekproduksi_lmlist" id="fumkm_aspekproduksi_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi_lm">
<div id="gmp_umkm_aspekproduksi_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspekproduksi_lmlist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->NIK->Visible) { // NIK ?>
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_NIK" class="umkm_aspekproduksi_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
        <th data-name="PROD_FREKUENSIPRODUKSI" class="<?= $Page->PROD_FREKUENSIPRODUKSI->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI" class="umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI"><?= $Page->renderSort($Page->PROD_FREKUENSIPRODUKSI) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
        <th data-name="PROD_KAPASITAS" class="<?= $Page->PROD_KAPASITAS->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_KAPASITAS" class="umkm_aspekproduksi_lm_PROD_KAPASITAS"><?= $Page->renderSort($Page->PROD_KAPASITAS) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
        <th data-name="PROD_KEAMANANPANGAN" class="<?= $Page->PROD_KEAMANANPANGAN->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN" class="umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN"><?= $Page->renderSort($Page->PROD_KEAMANANPANGAN) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
        <th data-name="PROD_SNI" class="<?= $Page->PROD_SNI->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_SNI" class="umkm_aspekproduksi_lm_PROD_SNI"><?= $Page->renderSort($Page->PROD_SNI) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
        <th data-name="PROD_KEMASAN" class="<?= $Page->PROD_KEMASAN->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_KEMASAN" class="umkm_aspekproduksi_lm_PROD_KEMASAN"><?= $Page->renderSort($Page->PROD_KEMASAN) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
        <th data-name="PROD_KETERSEDIAANBAHANBAKU" class="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU" class="umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU"><?= $Page->renderSort($Page->PROD_KETERSEDIAANBAHANBAKU) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
        <th data-name="PROD_ALATPRODUKSI" class="<?= $Page->PROD_ALATPRODUKSI->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI" class="umkm_aspekproduksi_lm_PROD_ALATPRODUKSI"><?= $Page->renderSort($Page->PROD_ALATPRODUKSI) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
        <th data-name="PROD_GUDANGPENYIMPAN" class="<?= $Page->PROD_GUDANGPENYIMPAN->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN" class="umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN"><?= $Page->renderSort($Page->PROD_GUDANGPENYIMPAN) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
        <th data-name="PROD_LAYOUTPRODUKSI" class="<?= $Page->PROD_LAYOUTPRODUKSI->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI" class="umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI"><?= $Page->renderSort($Page->PROD_LAYOUTPRODUKSI) ?></div></th>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
        <th data-name="PROD_SOP" class="<?= $Page->PROD_SOP->headerCellClass() ?>"><div id="elh_umkm_aspekproduksi_lm_PROD_SOP" class="umkm_aspekproduksi_lm_PROD_SOP"><?= $Page->renderSort($Page->PROD_SOP) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekproduksi_lm", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->NIK->Visible) { // NIK ?>
        <td data-name="NIK" <?= $Page->NIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
        <td data-name="PROD_FREKUENSIPRODUKSI" <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI">
<span<?= $Page->PROD_FREKUENSIPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_FREKUENSIPRODUKSI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
        <td data-name="PROD_KAPASITAS" <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_KAPASITAS">
<span<?= $Page->PROD_KAPASITAS->viewAttributes() ?>>
<?= $Page->PROD_KAPASITAS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
        <td data-name="PROD_KEAMANANPANGAN" <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN">
<span<?= $Page->PROD_KEAMANANPANGAN->viewAttributes() ?>>
<?= $Page->PROD_KEAMANANPANGAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
        <td data-name="PROD_SNI" <?= $Page->PROD_SNI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_SNI">
<span<?= $Page->PROD_SNI->viewAttributes() ?>>
<?= $Page->PROD_SNI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
        <td data-name="PROD_KEMASAN" <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_KEMASAN">
<span<?= $Page->PROD_KEMASAN->viewAttributes() ?>>
<?= $Page->PROD_KEMASAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
        <td data-name="PROD_KETERSEDIAANBAHANBAKU" <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU">
<span<?= $Page->PROD_KETERSEDIAANBAHANBAKU->viewAttributes() ?>>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
        <td data-name="PROD_ALATPRODUKSI" <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI">
<span<?= $Page->PROD_ALATPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_ALATPRODUKSI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
        <td data-name="PROD_GUDANGPENYIMPAN" <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN">
<span<?= $Page->PROD_GUDANGPENYIMPAN->viewAttributes() ?>>
<?= $Page->PROD_GUDANGPENYIMPAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
        <td data-name="PROD_LAYOUTPRODUKSI" <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI">
<span<?= $Page->PROD_LAYOUTPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_LAYOUTPRODUKSI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
        <td data-name="PROD_SOP" <?= $Page->PROD_SOP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_lm_PROD_SOP">
<span<?= $Page->PROD_SOP->viewAttributes() ?>>
<?= $Page->PROD_SOP->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspekproduksi_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
