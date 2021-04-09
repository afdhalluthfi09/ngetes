<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorSdmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var ftemp_skor_sdmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    ftemp_skor_sdmlist = currentForm = new ew.Form("ftemp_skor_sdmlist", "list");
    ftemp_skor_sdmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("ftemp_skor_sdmlist");
});
var ftemp_skor_sdmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    ftemp_skor_sdmlistsrch = currentSearchForm = new ew.Form("ftemp_skor_sdmlistsrch");

    // Dynamic selection lists

    // Filters
    ftemp_skor_sdmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("ftemp_skor_sdmlistsrch");
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
<form name="ftemp_skor_sdmlistsrch" id="ftemp_skor_sdmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="ftemp_skor_sdmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="temp_skor_sdm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> temp_skor_sdm">
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
<form name="ftemp_skor_sdmlist" id="ftemp_skor_sdmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_sdm">
<div id="gmp_temp_skor_sdm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_temp_skor_sdmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_temp_skor_sdm_nik" class="temp_skor_sdm_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->skor_oms->Visible) { // skor_oms ?>
        <th data-name="skor_oms" class="<?= $Page->skor_oms->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_oms" class="temp_skor_sdm_skor_oms"><?= $Page->renderSort($Page->skor_oms) ?></div></th>
<?php } ?>
<?php if ($Page->max_oms->Visible) { // max_oms ?>
        <th data-name="max_oms" class="<?= $Page->max_oms->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_oms" class="temp_skor_sdm_max_oms"><?= $Page->renderSort($Page->max_oms) ?></div></th>
<?php } ?>
<?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
        <th data-name="skor_fokus" class="<?= $Page->skor_fokus->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_fokus" class="temp_skor_sdm_skor_fokus"><?= $Page->renderSort($Page->skor_fokus) ?></div></th>
<?php } ?>
<?php if ($Page->max_fokus->Visible) { // max_fokus ?>
        <th data-name="max_fokus" class="<?= $Page->max_fokus->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_fokus" class="temp_skor_sdm_max_fokus"><?= $Page->renderSort($Page->max_fokus) ?></div></th>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
        <th data-name="skor_target" class="<?= $Page->skor_target->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_target" class="temp_skor_sdm_skor_target"><?= $Page->renderSort($Page->skor_target) ?></div></th>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
        <th data-name="max_target" class="<?= $Page->max_target->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_target" class="temp_skor_sdm_max_target"><?= $Page->renderSort($Page->max_target) ?></div></th>
<?php } ?>
<?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
        <th data-name="skor_karyawan" class="<?= $Page->skor_karyawan->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_karyawan" class="temp_skor_sdm_skor_karyawan"><?= $Page->renderSort($Page->skor_karyawan) ?></div></th>
<?php } ?>
<?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
        <th data-name="max_karyawan" class="<?= $Page->max_karyawan->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_karyawan" class="temp_skor_sdm_max_karyawan"><?= $Page->renderSort($Page->max_karyawan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
        <th data-name="skor_outsource" class="<?= $Page->skor_outsource->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_outsource" class="temp_skor_sdm_skor_outsource"><?= $Page->renderSort($Page->skor_outsource) ?></div></th>
<?php } ?>
<?php if ($Page->max_outsource->Visible) { // max_outsource ?>
        <th data-name="max_outsource" class="<?= $Page->max_outsource->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_outsource" class="temp_skor_sdm_max_outsource"><?= $Page->renderSort($Page->max_outsource) ?></div></th>
<?php } ?>
<?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
        <th data-name="skor_besarangaji" class="<?= $Page->skor_besarangaji->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_besarangaji" class="temp_skor_sdm_skor_besarangaji"><?= $Page->renderSort($Page->skor_besarangaji) ?></div></th>
<?php } ?>
<?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
        <th data-name="max_besarangaji" class="<?= $Page->max_besarangaji->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_besarangaji" class="temp_skor_sdm_max_besarangaji"><?= $Page->renderSort($Page->max_besarangaji) ?></div></th>
<?php } ?>
<?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
        <th data-name="skor_asuransi" class="<?= $Page->skor_asuransi->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_asuransi" class="temp_skor_sdm_skor_asuransi"><?= $Page->renderSort($Page->skor_asuransi) ?></div></th>
<?php } ?>
<?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
        <th data-name="max_asuransi" class="<?= $Page->max_asuransi->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_asuransi" class="temp_skor_sdm_max_asuransi"><?= $Page->renderSort($Page->max_asuransi) ?></div></th>
<?php } ?>
<?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
        <th data-name="skor_bonus" class="<?= $Page->skor_bonus->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_bonus" class="temp_skor_sdm_skor_bonus"><?= $Page->renderSort($Page->skor_bonus) ?></div></th>
<?php } ?>
<?php if ($Page->max_bonus->Visible) { // max_bonus ?>
        <th data-name="max_bonus" class="<?= $Page->max_bonus->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_bonus" class="temp_skor_sdm_max_bonus"><?= $Page->renderSort($Page->max_bonus) ?></div></th>
<?php } ?>
<?php if ($Page->skor_training->Visible) { // skor_training ?>
        <th data-name="skor_training" class="<?= $Page->skor_training->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_training" class="temp_skor_sdm_skor_training"><?= $Page->renderSort($Page->skor_training) ?></div></th>
<?php } ?>
<?php if ($Page->max_training->Visible) { // max_training ?>
        <th data-name="max_training" class="<?= $Page->max_training->headerCellClass() ?>"><div id="elh_temp_skor_sdm_max_training" class="temp_skor_sdm_max_training"><?= $Page->renderSort($Page->max_training) ?></div></th>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <th data-name="skor_sdm" class="<?= $Page->skor_sdm->headerCellClass() ?>"><div id="elh_temp_skor_sdm_skor_sdm" class="temp_skor_sdm_skor_sdm"><?= $Page->renderSort($Page->skor_sdm) ?></div></th>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <th data-name="maxskor_sdm" class="<?= $Page->maxskor_sdm->headerCellClass() ?>"><div id="elh_temp_skor_sdm_maxskor_sdm" class="temp_skor_sdm_maxskor_sdm"><?= $Page->renderSort($Page->maxskor_sdm) ?></div></th>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <th data-name="bobot_sdm" class="<?= $Page->bobot_sdm->headerCellClass() ?>"><div id="elh_temp_skor_sdm_bobot_sdm" class="temp_skor_sdm_bobot_sdm"><?= $Page->renderSort($Page->bobot_sdm) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_temp_skor_sdm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_oms->Visible) { // skor_oms ?>
        <td data-name="skor_oms" <?= $Page->skor_oms->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_oms">
<span<?= $Page->skor_oms->viewAttributes() ?>>
<?= $Page->skor_oms->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_oms->Visible) { // max_oms ?>
        <td data-name="max_oms" <?= $Page->max_oms->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_oms">
<span<?= $Page->max_oms->viewAttributes() ?>>
<?= $Page->max_oms->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
        <td data-name="skor_fokus" <?= $Page->skor_fokus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_fokus">
<span<?= $Page->skor_fokus->viewAttributes() ?>>
<?= $Page->skor_fokus->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_fokus->Visible) { // max_fokus ?>
        <td data-name="max_fokus" <?= $Page->max_fokus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_fokus">
<span<?= $Page->max_fokus->viewAttributes() ?>>
<?= $Page->max_fokus->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_target->Visible) { // skor_target ?>
        <td data-name="skor_target" <?= $Page->skor_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_target">
<span<?= $Page->skor_target->viewAttributes() ?>>
<?= $Page->skor_target->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_target->Visible) { // max_target ?>
        <td data-name="max_target" <?= $Page->max_target->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_target">
<span<?= $Page->max_target->viewAttributes() ?>>
<?= $Page->max_target->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
        <td data-name="skor_karyawan" <?= $Page->skor_karyawan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_karyawan">
<span<?= $Page->skor_karyawan->viewAttributes() ?>>
<?= $Page->skor_karyawan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
        <td data-name="max_karyawan" <?= $Page->max_karyawan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_karyawan">
<span<?= $Page->max_karyawan->viewAttributes() ?>>
<?= $Page->max_karyawan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
        <td data-name="skor_outsource" <?= $Page->skor_outsource->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_outsource">
<span<?= $Page->skor_outsource->viewAttributes() ?>>
<?= $Page->skor_outsource->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_outsource->Visible) { // max_outsource ?>
        <td data-name="max_outsource" <?= $Page->max_outsource->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_outsource">
<span<?= $Page->max_outsource->viewAttributes() ?>>
<?= $Page->max_outsource->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
        <td data-name="skor_besarangaji" <?= $Page->skor_besarangaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_besarangaji">
<span<?= $Page->skor_besarangaji->viewAttributes() ?>>
<?= $Page->skor_besarangaji->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
        <td data-name="max_besarangaji" <?= $Page->max_besarangaji->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_besarangaji">
<span<?= $Page->max_besarangaji->viewAttributes() ?>>
<?= $Page->max_besarangaji->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
        <td data-name="skor_asuransi" <?= $Page->skor_asuransi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_asuransi">
<span<?= $Page->skor_asuransi->viewAttributes() ?>>
<?= $Page->skor_asuransi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
        <td data-name="max_asuransi" <?= $Page->max_asuransi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_asuransi">
<span<?= $Page->max_asuransi->viewAttributes() ?>>
<?= $Page->max_asuransi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
        <td data-name="skor_bonus" <?= $Page->skor_bonus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_bonus">
<span<?= $Page->skor_bonus->viewAttributes() ?>>
<?= $Page->skor_bonus->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_bonus->Visible) { // max_bonus ?>
        <td data-name="max_bonus" <?= $Page->max_bonus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_bonus">
<span<?= $Page->max_bonus->viewAttributes() ?>>
<?= $Page->max_bonus->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_training->Visible) { // skor_training ?>
        <td data-name="skor_training" <?= $Page->skor_training->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_training">
<span<?= $Page->skor_training->viewAttributes() ?>>
<?= $Page->skor_training->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_training->Visible) { // max_training ?>
        <td data-name="max_training" <?= $Page->max_training->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_max_training">
<span<?= $Page->max_training->viewAttributes() ?>>
<?= $Page->max_training->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
        <td data-name="skor_sdm" <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_skor_sdm">
<span<?= $Page->skor_sdm->viewAttributes() ?>>
<?= $Page->skor_sdm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
        <td data-name="maxskor_sdm" <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_maxskor_sdm">
<span<?= $Page->maxskor_sdm->viewAttributes() ?>>
<?= $Page->maxskor_sdm->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
        <td data-name="bobot_sdm" <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_temp_skor_sdm_bobot_sdm">
<span<?= $Page->bobot_sdm->viewAttributes() ?>>
<?= $Page->bobot_sdm->getViewValue() ?></span>
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
    ew.addEventHandlers("temp_skor_sdm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
