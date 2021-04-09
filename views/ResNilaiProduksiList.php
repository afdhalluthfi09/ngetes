<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ResNilaiProduksiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fres_nilai_produksilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fres_nilai_produksilist = currentForm = new ew.Form("fres_nilai_produksilist", "list");
    fres_nilai_produksilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fres_nilai_produksilist");
});
var fres_nilai_produksilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fres_nilai_produksilistsrch = currentSearchForm = new ew.Form("fres_nilai_produksilistsrch");

    // Dynamic selection lists

    // Filters
    fres_nilai_produksilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fres_nilai_produksilistsrch");
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
<form name="fres_nilai_produksilistsrch" id="fres_nilai_produksilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fres_nilai_produksilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="res_nilai_produksi">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> res_nilai_produksi">
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
<form name="fres_nilai_produksilist" id="fres_nilai_produksilist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res_nilai_produksi">
<div id="gmp_res_nilai_produksi" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_res_nilai_produksilist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_res_nilai_produksi_nik" class="res_nilai_produksi_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
        <th data-name="skor_aktifitas" class="<?= $Page->skor_aktifitas->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_aktifitas" class="res_nilai_produksi_skor_aktifitas"><?= $Page->renderSort($Page->skor_aktifitas) ?></div></th>
<?php } ?>
<?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
        <th data-name="max_aktifitas" class="<?= $Page->max_aktifitas->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_aktifitas" class="res_nilai_produksi_max_aktifitas"><?= $Page->renderSort($Page->max_aktifitas) ?></div></th>
<?php } ?>
<?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
        <th data-name="skor_kapasitas" class="<?= $Page->skor_kapasitas->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_kapasitas" class="res_nilai_produksi_skor_kapasitas"><?= $Page->renderSort($Page->skor_kapasitas) ?></div></th>
<?php } ?>
<?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
        <th data-name="max_kapasitas" class="<?= $Page->max_kapasitas->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_kapasitas" class="res_nilai_produksi_max_kapasitas"><?= $Page->renderSort($Page->max_kapasitas) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
        <th data-name="skor_pangan" class="<?= $Page->skor_pangan->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_pangan" class="res_nilai_produksi_skor_pangan"><?= $Page->renderSort($Page->skor_pangan) ?></div></th>
<?php } ?>
<?php if ($Page->max_pangan->Visible) { // max_pangan ?>
        <th data-name="max_pangan" class="<?= $Page->max_pangan->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_pangan" class="res_nilai_produksi_max_pangan"><?= $Page->renderSort($Page->max_pangan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_sni->Visible) { // skor_sni ?>
        <th data-name="skor_sni" class="<?= $Page->skor_sni->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_sni" class="res_nilai_produksi_skor_sni"><?= $Page->renderSort($Page->skor_sni) ?></div></th>
<?php } ?>
<?php if ($Page->max_sni->Visible) { // max_sni ?>
        <th data-name="max_sni" class="<?= $Page->max_sni->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_sni" class="res_nilai_produksi_max_sni"><?= $Page->renderSort($Page->max_sni) ?></div></th>
<?php } ?>
<?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
        <th data-name="skor_kemasan" class="<?= $Page->skor_kemasan->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_kemasan" class="res_nilai_produksi_skor_kemasan"><?= $Page->renderSort($Page->skor_kemasan) ?></div></th>
<?php } ?>
<?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
        <th data-name="max_kemasan" class="<?= $Page->max_kemasan->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_kemasan" class="res_nilai_produksi_max_kemasan"><?= $Page->renderSort($Page->max_kemasan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
        <th data-name="skor_bahanbaku" class="<?= $Page->skor_bahanbaku->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_bahanbaku" class="res_nilai_produksi_skor_bahanbaku"><?= $Page->renderSort($Page->skor_bahanbaku) ?></div></th>
<?php } ?>
<?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
        <th data-name="max_bahanbaku" class="<?= $Page->max_bahanbaku->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_bahanbaku" class="res_nilai_produksi_max_bahanbaku"><?= $Page->renderSort($Page->max_bahanbaku) ?></div></th>
<?php } ?>
<?php if ($Page->skor_alat->Visible) { // skor_alat ?>
        <th data-name="skor_alat" class="<?= $Page->skor_alat->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_alat" class="res_nilai_produksi_skor_alat"><?= $Page->renderSort($Page->skor_alat) ?></div></th>
<?php } ?>
<?php if ($Page->max_alat->Visible) { // max_alat ?>
        <th data-name="max_alat" class="<?= $Page->max_alat->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_alat" class="res_nilai_produksi_max_alat"><?= $Page->renderSort($Page->max_alat) ?></div></th>
<?php } ?>
<?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
        <th data-name="skor_gudang" class="<?= $Page->skor_gudang->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_gudang" class="res_nilai_produksi_skor_gudang"><?= $Page->renderSort($Page->skor_gudang) ?></div></th>
<?php } ?>
<?php if ($Page->max_gudang->Visible) { // max_gudang ?>
        <th data-name="max_gudang" class="<?= $Page->max_gudang->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_gudang" class="res_nilai_produksi_max_gudang"><?= $Page->renderSort($Page->max_gudang) ?></div></th>
<?php } ?>
<?php if ($Page->skor_layout->Visible) { // skor_layout ?>
        <th data-name="skor_layout" class="<?= $Page->skor_layout->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_layout" class="res_nilai_produksi_skor_layout"><?= $Page->renderSort($Page->skor_layout) ?></div></th>
<?php } ?>
<?php if ($Page->max_layout->Visible) { // max_layout ?>
        <th data-name="max_layout" class="<?= $Page->max_layout->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_layout" class="res_nilai_produksi_max_layout"><?= $Page->renderSort($Page->max_layout) ?></div></th>
<?php } ?>
<?php if ($Page->skor_sop->Visible) { // skor_sop ?>
        <th data-name="skor_sop" class="<?= $Page->skor_sop->headerCellClass() ?>"><div id="elh_res_nilai_produksi_skor_sop" class="res_nilai_produksi_skor_sop"><?= $Page->renderSort($Page->skor_sop) ?></div></th>
<?php } ?>
<?php if ($Page->max_sop->Visible) { // max_sop ?>
        <th data-name="max_sop" class="<?= $Page->max_sop->headerCellClass() ?>"><div id="elh_res_nilai_produksi_max_sop" class="res_nilai_produksi_max_sop"><?= $Page->renderSort($Page->max_sop) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_res_nilai_produksi", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
        <td data-name="skor_aktifitas" <?= $Page->skor_aktifitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_aktifitas">
<span<?= $Page->skor_aktifitas->viewAttributes() ?>>
<?= $Page->skor_aktifitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
        <td data-name="max_aktifitas" <?= $Page->max_aktifitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_aktifitas">
<span<?= $Page->max_aktifitas->viewAttributes() ?>>
<?= $Page->max_aktifitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
        <td data-name="skor_kapasitas" <?= $Page->skor_kapasitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_kapasitas">
<span<?= $Page->skor_kapasitas->viewAttributes() ?>>
<?= $Page->skor_kapasitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
        <td data-name="max_kapasitas" <?= $Page->max_kapasitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_kapasitas">
<span<?= $Page->max_kapasitas->viewAttributes() ?>>
<?= $Page->max_kapasitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
        <td data-name="skor_pangan" <?= $Page->skor_pangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_pangan">
<span<?= $Page->skor_pangan->viewAttributes() ?>>
<?= $Page->skor_pangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_pangan->Visible) { // max_pangan ?>
        <td data-name="max_pangan" <?= $Page->max_pangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_pangan">
<span<?= $Page->max_pangan->viewAttributes() ?>>
<?= $Page->max_pangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_sni->Visible) { // skor_sni ?>
        <td data-name="skor_sni" <?= $Page->skor_sni->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_sni">
<span<?= $Page->skor_sni->viewAttributes() ?>>
<?= $Page->skor_sni->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_sni->Visible) { // max_sni ?>
        <td data-name="max_sni" <?= $Page->max_sni->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_sni">
<span<?= $Page->max_sni->viewAttributes() ?>>
<?= $Page->max_sni->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
        <td data-name="skor_kemasan" <?= $Page->skor_kemasan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_kemasan">
<span<?= $Page->skor_kemasan->viewAttributes() ?>>
<?= $Page->skor_kemasan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
        <td data-name="max_kemasan" <?= $Page->max_kemasan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_kemasan">
<span<?= $Page->max_kemasan->viewAttributes() ?>>
<?= $Page->max_kemasan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
        <td data-name="skor_bahanbaku" <?= $Page->skor_bahanbaku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_bahanbaku">
<span<?= $Page->skor_bahanbaku->viewAttributes() ?>>
<?= $Page->skor_bahanbaku->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
        <td data-name="max_bahanbaku" <?= $Page->max_bahanbaku->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_bahanbaku">
<span<?= $Page->max_bahanbaku->viewAttributes() ?>>
<?= $Page->max_bahanbaku->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_alat->Visible) { // skor_alat ?>
        <td data-name="skor_alat" <?= $Page->skor_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_alat">
<span<?= $Page->skor_alat->viewAttributes() ?>>
<?= $Page->skor_alat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_alat->Visible) { // max_alat ?>
        <td data-name="max_alat" <?= $Page->max_alat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_alat">
<span<?= $Page->max_alat->viewAttributes() ?>>
<?= $Page->max_alat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
        <td data-name="skor_gudang" <?= $Page->skor_gudang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_gudang">
<span<?= $Page->skor_gudang->viewAttributes() ?>>
<?= $Page->skor_gudang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_gudang->Visible) { // max_gudang ?>
        <td data-name="max_gudang" <?= $Page->max_gudang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_gudang">
<span<?= $Page->max_gudang->viewAttributes() ?>>
<?= $Page->max_gudang->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_layout->Visible) { // skor_layout ?>
        <td data-name="skor_layout" <?= $Page->skor_layout->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_layout">
<span<?= $Page->skor_layout->viewAttributes() ?>>
<?= $Page->skor_layout->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_layout->Visible) { // max_layout ?>
        <td data-name="max_layout" <?= $Page->max_layout->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_layout">
<span<?= $Page->max_layout->viewAttributes() ?>>
<?= $Page->max_layout->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_sop->Visible) { // skor_sop ?>
        <td data-name="skor_sop" <?= $Page->skor_sop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_skor_sop">
<span<?= $Page->skor_sop->viewAttributes() ?>>
<?= $Page->skor_sop->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_sop->Visible) { // max_sop ?>
        <td data-name="max_sop" <?= $Page->max_sop->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_produksi_max_sop">
<span<?= $Page->max_sop->viewAttributes() ?>>
<?= $Page->max_sop->getViewValue() ?></span>
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
    ew.addEventHandlers("res_nilai_produksi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
