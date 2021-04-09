<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelasList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelaslist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    ftemp_skor_kelaslist = currentForm = new ew.Form("ftemp_skor_kelaslist", "list");
    ftemp_skor_kelaslist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("ftemp_skor_kelaslist");
});
var ftemp_skor_kelaslistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    ftemp_skor_kelaslistsrch = currentSearchForm = new ew.Form("ftemp_skor_kelaslistsrch");

    // Dynamic selection lists

    // Filters
    ftemp_skor_kelaslistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftemp_skor_kelaslistsrch");
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
<form name="ftemp_skor_kelaslistsrch" id="ftemp_skor_kelaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftemp_skor_kelaslistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="temp_skor_kelas">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> temp_skor_kelas">
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
<form name="ftemp_skor_kelaslist" id="ftemp_skor_kelaslist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelas">
<div id="gmp_temp_skor_kelas" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_temp_skor_kelaslist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_temp_skor_kelas_NIK" class="temp_skor_kelas_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <th data-name="NAMA_PEMILIK" class="<?= $Page->NAMA_PEMILIK->headerCellClass() ?>"><div id="elh_temp_skor_kelas_NAMA_PEMILIK" class="temp_skor_kelas_NAMA_PEMILIK"><?= $Page->renderSort($Page->NAMA_PEMILIK) ?></div></th>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <th data-name="NO_HP" class="<?= $Page->NO_HP->headerCellClass() ?>"><div id="elh_temp_skor_kelas_NO_HP" class="temp_skor_kelas_NO_HP"><?= $Page->renderSort($Page->NO_HP) ?></div></th>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <th data-name="NAMA_USAHA" class="<?= $Page->NAMA_USAHA->headerCellClass() ?>"><div id="elh_temp_skor_kelas_NAMA_USAHA" class="temp_skor_kelas_NAMA_USAHA"><?= $Page->renderSort($Page->NAMA_USAHA) ?></div></th>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <th data-name="KALURAHAN" class="<?= $Page->KALURAHAN->headerCellClass() ?>"><div id="elh_temp_skor_kelas_KALURAHAN" class="temp_skor_kelas_KALURAHAN"><?= $Page->renderSort($Page->KALURAHAN) ?></div></th>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <th data-name="KAPANEWON" class="<?= $Page->KAPANEWON->headerCellClass() ?>"><div id="elh_temp_skor_kelas_KAPANEWON" class="temp_skor_kelas_KAPANEWON"><?= $Page->renderSort($Page->KAPANEWON) ?></div></th>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <th data-name="skor_produksi" class="<?= $Page->skor_produksi->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_produksi" class="temp_skor_kelas_skor_produksi"><?= $Page->renderSort($Page->skor_produksi) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <th data-name="maxskor_produksi" class="<?= $Page->maxskor_produksi->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_produksi" class="temp_skor_kelas_maxskor_produksi"><?= $Page->renderSort($Page->maxskor_produksi) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <th data-name="bobot_produksi" class="<?= $Page->bobot_produksi->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_produksi" class="temp_skor_kelas_bobot_produksi"><?= $Page->renderSort($Page->bobot_produksi) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <th data-name="skor_pemasaran" class="<?= $Page->skor_pemasaran->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_pemasaran" class="temp_skor_kelas_skor_pemasaran"><?= $Page->renderSort($Page->skor_pemasaran) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <th data-name="maxskor_pemasaran" class="<?= $Page->maxskor_pemasaran->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_pemasaran" class="temp_skor_kelas_maxskor_pemasaran"><?= $Page->renderSort($Page->maxskor_pemasaran) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <th data-name="bobot_pemasaran" class="<?= $Page->bobot_pemasaran->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_pemasaran" class="temp_skor_kelas_bobot_pemasaran"><?= $Page->renderSort($Page->bobot_pemasaran) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <th data-name="skor_pemasaranonline" class="<?= $Page->skor_pemasaranonline->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_pemasaranonline" class="temp_skor_kelas_skor_pemasaranonline"><?= $Page->renderSort($Page->skor_pemasaranonline) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <th data-name="maxskor_pemasaranonline" class="<?= $Page->maxskor_pemasaranonline->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_pemasaranonline" class="temp_skor_kelas_maxskor_pemasaranonline"><?= $Page->renderSort($Page->maxskor_pemasaranonline) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <th data-name="bobot_pemasaranonline" class="<?= $Page->bobot_pemasaranonline->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_pemasaranonline" class="temp_skor_kelas_bobot_pemasaranonline"><?= $Page->renderSort($Page->bobot_pemasaranonline) ?></div></th>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <th data-name="skor_kelembagaan" class="<?= $Page->skor_kelembagaan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_kelembagaan" class="temp_skor_kelas_skor_kelembagaan"><?= $Page->renderSort($Page->skor_kelembagaan) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <th data-name="maxskor_kelembagaan" class="<?= $Page->maxskor_kelembagaan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_kelembagaan" class="temp_skor_kelas_maxskor_kelembagaan"><?= $Page->renderSort($Page->maxskor_kelembagaan) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <th data-name="bobot_kelembagaan" class="<?= $Page->bobot_kelembagaan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_kelembagaan" class="temp_skor_kelas_bobot_kelembagaan"><?= $Page->renderSort($Page->bobot_kelembagaan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <th data-name="skor_keuangan" class="<?= $Page->skor_keuangan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_keuangan" class="temp_skor_kelas_skor_keuangan"><?= $Page->renderSort($Page->skor_keuangan) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <th data-name="maxskor_keuangan" class="<?= $Page->maxskor_keuangan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_keuangan" class="temp_skor_kelas_maxskor_keuangan"><?= $Page->renderSort($Page->maxskor_keuangan) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <th data-name="bobot_keuangan" class="<?= $Page->bobot_keuangan->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_keuangan" class="temp_skor_kelas_bobot_keuangan"><?= $Page->renderSort($Page->bobot_keuangan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <th data-name="skor_sdm" class="<?= $Page->skor_sdm->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_sdm" class="temp_skor_kelas_skor_sdm"><?= $Page->renderSort($Page->skor_sdm) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <th data-name="maxskor_sdm" class="<?= $Page->maxskor_sdm->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_sdm" class="temp_skor_kelas_maxskor_sdm"><?= $Page->renderSort($Page->maxskor_sdm) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <th data-name="bobot_sdm" class="<?= $Page->bobot_sdm->headerCellClass() ?>"><div id="elh_temp_skor_kelas_bobot_sdm" class="temp_skor_kelas_bobot_sdm"><?= $Page->renderSort($Page->bobot_sdm) ?></div></th>
<?php } ?>
<?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
        <th data-name="skor_kelas" class="<?= $Page->skor_kelas->headerCellClass() ?>"><div id="elh_temp_skor_kelas_skor_kelas" class="temp_skor_kelas_skor_kelas"><?= $Page->renderSort($Page->skor_kelas) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
        <th data-name="maxskor_kelas" class="<?= $Page->maxskor_kelas->headerCellClass() ?>"><div id="elh_temp_skor_kelas_maxskor_kelas" class="temp_skor_kelas_maxskor_kelas"><?= $Page->renderSort($Page->maxskor_kelas) ?></div></th>
<?php } ?>
<?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
        <th data-name="kelas_umkm" class="<?= $Page->kelas_umkm->headerCellClass() ?>"><div id="elh_temp_skor_kelas_kelas_umkm" class="temp_skor_kelas_kelas_umkm"><?= $Page->renderSort($Page->kelas_umkm) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_temp_skor_kelas", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <td data-name="NAMA_PEMILIK" <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <td data-name="NO_HP" <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <td data-name="NAMA_USAHA" <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <td data-name="KALURAHAN" <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <td data-name="KAPANEWON" <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
        <td data-name="skor_produksi" <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_produksi">
<span<?= $Page->skor_produksi->viewAttributes() ?>>
<?= $Page->skor_produksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
        <td data-name="maxskor_produksi" <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_produksi">
<span<?= $Page->maxskor_produksi->viewAttributes() ?>>
<?= $Page->maxskor_produksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
        <td data-name="bobot_produksi" <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_produksi">
<span<?= $Page->bobot_produksi->viewAttributes() ?>>
<?= $Page->bobot_produksi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
        <td data-name="skor_pemasaran" <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_pemasaran">
<span<?= $Page->skor_pemasaran->viewAttributes() ?>>
<?= $Page->skor_pemasaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
        <td data-name="maxskor_pemasaran" <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_pemasaran">
<span<?= $Page->maxskor_pemasaran->viewAttributes() ?>>
<?= $Page->maxskor_pemasaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
        <td data-name="bobot_pemasaran" <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_pemasaran">
<span<?= $Page->bobot_pemasaran->viewAttributes() ?>>
<?= $Page->bobot_pemasaran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
        <td data-name="skor_pemasaranonline" <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_pemasaranonline">
<span<?= $Page->skor_pemasaranonline->viewAttributes() ?>>
<?= $Page->skor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
        <td data-name="maxskor_pemasaranonline" <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_pemasaranonline">
<span<?= $Page->maxskor_pemasaranonline->viewAttributes() ?>>
<?= $Page->maxskor_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
        <td data-name="bobot_pemasaranonline" <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_pemasaranonline">
<span<?= $Page->bobot_pemasaranonline->viewAttributes() ?>>
<?= $Page->bobot_pemasaranonline->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
        <td data-name="skor_kelembagaan" <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_kelembagaan">
<span<?= $Page->skor_kelembagaan->viewAttributes() ?>>
<?= $Page->skor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
        <td data-name="maxskor_kelembagaan" <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_kelembagaan">
<span<?= $Page->maxskor_kelembagaan->viewAttributes() ?>>
<?= $Page->maxskor_kelembagaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
        <td data-name="bobot_kelembagaan" <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_kelembagaan">
<span<?= $Page->bobot_kelembagaan->viewAttributes() ?>>
<?= $Page->bobot_kelembagaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
        <td data-name="skor_keuangan" <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_keuangan">
<span<?= $Page->skor_keuangan->viewAttributes() ?>>
<?= $Page->skor_keuangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
        <td data-name="maxskor_keuangan" <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_keuangan">
<span<?= $Page->maxskor_keuangan->viewAttributes() ?>>
<?= $Page->maxskor_keuangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
        <td data-name="bobot_keuangan" <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_keuangan">
<span<?= $Page->bobot_keuangan->viewAttributes() ?>>
<?= $Page->bobot_keuangan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <td data-name="skor_sdm" <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <td data-name="maxskor_sdm" <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <td data-name="bobot_sdm" <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
        <td data-name="skor_kelas" <?= $Page->skor_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_skor_kelas">
<span<?= $Page->skor_kelas->viewAttributes() ?>>
<?= $Page->skor_kelas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
        <td data-name="maxskor_kelas" <?= $Page->maxskor_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_maxskor_kelas">
<span<?= $Page->maxskor_kelas->viewAttributes() ?>>
<?= $Page->maxskor_kelas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
        <td data-name="kelas_umkm" <?= $Page->kelas_umkm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_kelas_kelas_umkm">
<span<?= $Page->kelas_umkm->viewAttributes() ?>>
<?= $Page->kelas_umkm->getViewValue() ?></span>
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
    ew.addEventHandlers("temp_skor_kelas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
