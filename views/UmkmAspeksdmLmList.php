<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdm_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspeksdm_lmlist = currentForm = new ew.Form("fumkm_aspeksdm_lmlist", "list");
    fumkm_aspeksdm_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspeksdm_lmlist");
});
var fumkm_aspeksdm_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspeksdm_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspeksdm_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspeksdm_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspeksdm_lmlistsrch");
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
<form name="fumkm_aspeksdm_lmlistsrch" id="fumkm_aspeksdm_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspeksdm_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspeksdm_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspeksdm_lm">
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
<form name="fumkm_aspeksdm_lmlist" id="fumkm_aspeksdm_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm_lm">
<div id="gmp_umkm_aspeksdm_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspeksdm_lmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_NIK" class="umkm_aspeksdm_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
        <th data-name="SDM_OMS" class="<?= $Page->SDM_OMS->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_OMS" class="umkm_aspeksdm_lm_SDM_OMS"><?= $Page->renderSort($Page->SDM_OMS) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
        <th data-name="SDM_FOKUS" class="<?= $Page->SDM_FOKUS->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_FOKUS" class="umkm_aspeksdm_lm_SDM_FOKUS"><?= $Page->renderSort($Page->SDM_FOKUS) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
        <th data-name="SDM_TARGET" class="<?= $Page->SDM_TARGET->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_TARGET" class="umkm_aspeksdm_lm_SDM_TARGET"><?= $Page->renderSort($Page->SDM_TARGET) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
        <th data-name="SDM_KARYAWANTETAP" class="<?= $Page->SDM_KARYAWANTETAP->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_KARYAWANTETAP" class="umkm_aspeksdm_lm_SDM_KARYAWANTETAP"><?= $Page->renderSort($Page->SDM_KARYAWANTETAP) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
        <th data-name="SDM_KARYAWANSUBKON" class="<?= $Page->SDM_KARYAWANSUBKON->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON" class="umkm_aspeksdm_lm_SDM_KARYAWANSUBKON"><?= $Page->renderSort($Page->SDM_KARYAWANSUBKON) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
        <th data-name="SDM_GAJI" class="<?= $Page->SDM_GAJI->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_GAJI" class="umkm_aspeksdm_lm_SDM_GAJI"><?= $Page->renderSort($Page->SDM_GAJI) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
        <th data-name="SDM_ASURANSI" class="<?= $Page->SDM_ASURANSI->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_ASURANSI" class="umkm_aspeksdm_lm_SDM_ASURANSI"><?= $Page->renderSort($Page->SDM_ASURANSI) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
        <th data-name="SDM_TUNJANGAN" class="<?= $Page->SDM_TUNJANGAN->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_TUNJANGAN" class="umkm_aspeksdm_lm_SDM_TUNJANGAN"><?= $Page->renderSort($Page->SDM_TUNJANGAN) ?></div></th>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
        <th data-name="SDM_PELATIHAN" class="<?= $Page->SDM_PELATIHAN->headerCellClass() ?>"><div id="elh_umkm_aspeksdm_lm_SDM_PELATIHAN" class="umkm_aspeksdm_lm_SDM_PELATIHAN"><?= $Page->renderSort($Page->SDM_PELATIHAN) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspeksdm_lm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
        <td data-name="SDM_OMS" <?= $Page->SDM_OMS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_OMS">
<span<?= $Page->SDM_OMS->viewAttributes() ?>>
<?= $Page->SDM_OMS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
        <td data-name="SDM_FOKUS" <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_FOKUS">
<span<?= $Page->SDM_FOKUS->viewAttributes() ?>>
<?= $Page->SDM_FOKUS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
        <td data-name="SDM_TARGET" <?= $Page->SDM_TARGET->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_TARGET">
<span<?= $Page->SDM_TARGET->viewAttributes() ?>>
<?= $Page->SDM_TARGET->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
        <td data-name="SDM_KARYAWANTETAP" <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_KARYAWANTETAP">
<span<?= $Page->SDM_KARYAWANTETAP->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANTETAP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
        <td data-name="SDM_KARYAWANSUBKON" <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON">
<span<?= $Page->SDM_KARYAWANSUBKON->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANSUBKON->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
        <td data-name="SDM_GAJI" <?= $Page->SDM_GAJI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_GAJI">
<span<?= $Page->SDM_GAJI->viewAttributes() ?>>
<?= $Page->SDM_GAJI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
        <td data-name="SDM_ASURANSI" <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_ASURANSI">
<span<?= $Page->SDM_ASURANSI->viewAttributes() ?>>
<?= $Page->SDM_ASURANSI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
        <td data-name="SDM_TUNJANGAN" <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_TUNJANGAN">
<span<?= $Page->SDM_TUNJANGAN->viewAttributes() ?>>
<?= $Page->SDM_TUNJANGAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
        <td data-name="SDM_PELATIHAN" <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_lm_SDM_PELATIHAN">
<span<?= $Page->SDM_PELATIHAN->viewAttributes() ?>>
<?= $Page->SDM_PELATIHAN->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspeksdm_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
