<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ResNilaiKelembagaanList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fres_nilai_kelembagaanlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fres_nilai_kelembagaanlist = currentForm = new ew.Form("fres_nilai_kelembagaanlist", "list");
    fres_nilai_kelembagaanlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fres_nilai_kelembagaanlist");
});
var fres_nilai_kelembagaanlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fres_nilai_kelembagaanlistsrch = currentSearchForm = new ew.Form("fres_nilai_kelembagaanlistsrch");

    // Dynamic selection lists

    // Filters
    fres_nilai_kelembagaanlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fres_nilai_kelembagaanlistsrch");
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
<form name="fres_nilai_kelembagaanlistsrch" id="fres_nilai_kelembagaanlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fres_nilai_kelembagaanlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="res_nilai_kelembagaan">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> res_nilai_kelembagaan">
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
<form name="fres_nilai_kelembagaanlist" id="fres_nilai_kelembagaanlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res_nilai_kelembagaan">
<div id="gmp_res_nilai_kelembagaan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_res_nilai_kelembagaanlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_nik" class="res_nilai_kelembagaan_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
        <th data-name="skor_badanhukum" class="<?= $Page->skor_badanhukum->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_badanhukum" class="res_nilai_kelembagaan_skor_badanhukum"><?= $Page->renderSort($Page->skor_badanhukum) ?></div></th>
<?php } ?>
<?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
        <th data-name="max_badanhukum" class="<?= $Page->max_badanhukum->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_badanhukum" class="res_nilai_kelembagaan_max_badanhukum"><?= $Page->renderSort($Page->max_badanhukum) ?></div></th>
<?php } ?>
<?php if ($Page->skor_izin->Visible) { // skor_izin ?>
        <th data-name="skor_izin" class="<?= $Page->skor_izin->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_izin" class="res_nilai_kelembagaan_skor_izin"><?= $Page->renderSort($Page->skor_izin) ?></div></th>
<?php } ?>
<?php if ($Page->max_izin->Visible) { // max_izin ?>
        <th data-name="max_izin" class="<?= $Page->max_izin->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_izin" class="res_nilai_kelembagaan_max_izin"><?= $Page->renderSort($Page->max_izin) ?></div></th>
<?php } ?>
<?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
        <th data-name="skor_npwp" class="<?= $Page->skor_npwp->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_npwp" class="res_nilai_kelembagaan_skor_npwp"><?= $Page->renderSort($Page->skor_npwp) ?></div></th>
<?php } ?>
<?php if ($Page->max_npwp->Visible) { // max_npwp ?>
        <th data-name="max_npwp" class="<?= $Page->max_npwp->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_npwp" class="res_nilai_kelembagaan_max_npwp"><?= $Page->renderSort($Page->max_npwp) ?></div></th>
<?php } ?>
<?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
        <th data-name="skor_struktur" class="<?= $Page->skor_struktur->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_struktur" class="res_nilai_kelembagaan_skor_struktur"><?= $Page->renderSort($Page->skor_struktur) ?></div></th>
<?php } ?>
<?php if ($Page->max_struktur->Visible) { // max_struktur ?>
        <th data-name="max_struktur" class="<?= $Page->max_struktur->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_struktur" class="res_nilai_kelembagaan_max_struktur"><?= $Page->renderSort($Page->max_struktur) ?></div></th>
<?php } ?>
<?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
        <th data-name="skor_jobdesk" class="<?= $Page->skor_jobdesk->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_jobdesk" class="res_nilai_kelembagaan_skor_jobdesk"><?= $Page->renderSort($Page->skor_jobdesk) ?></div></th>
<?php } ?>
<?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
        <th data-name="max_jobdesk" class="<?= $Page->max_jobdesk->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_jobdesk" class="res_nilai_kelembagaan_max_jobdesk"><?= $Page->renderSort($Page->max_jobdesk) ?></div></th>
<?php } ?>
<?php if ($Page->skor_iso->Visible) { // skor_iso ?>
        <th data-name="skor_iso" class="<?= $Page->skor_iso->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_skor_iso" class="res_nilai_kelembagaan_skor_iso"><?= $Page->renderSort($Page->skor_iso) ?></div></th>
<?php } ?>
<?php if ($Page->max_iso->Visible) { // max_iso ?>
        <th data-name="max_iso" class="<?= $Page->max_iso->headerCellClass() ?>"><div id="elh_res_nilai_kelembagaan_max_iso" class="res_nilai_kelembagaan_max_iso"><?= $Page->renderSort($Page->max_iso) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_res_nilai_kelembagaan", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
        <td data-name="skor_badanhukum" <?= $Page->skor_badanhukum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_badanhukum">
<span<?= $Page->skor_badanhukum->viewAttributes() ?>>
<?= $Page->skor_badanhukum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
        <td data-name="max_badanhukum" <?= $Page->max_badanhukum->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_badanhukum">
<span<?= $Page->max_badanhukum->viewAttributes() ?>>
<?= $Page->max_badanhukum->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_izin->Visible) { // skor_izin ?>
        <td data-name="skor_izin" <?= $Page->skor_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_izin">
<span<?= $Page->skor_izin->viewAttributes() ?>>
<?= $Page->skor_izin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_izin->Visible) { // max_izin ?>
        <td data-name="max_izin" <?= $Page->max_izin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_izin">
<span<?= $Page->max_izin->viewAttributes() ?>>
<?= $Page->max_izin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
        <td data-name="skor_npwp" <?= $Page->skor_npwp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_npwp">
<span<?= $Page->skor_npwp->viewAttributes() ?>>
<?= $Page->skor_npwp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_npwp->Visible) { // max_npwp ?>
        <td data-name="max_npwp" <?= $Page->max_npwp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_npwp">
<span<?= $Page->max_npwp->viewAttributes() ?>>
<?= $Page->max_npwp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
        <td data-name="skor_struktur" <?= $Page->skor_struktur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_struktur">
<span<?= $Page->skor_struktur->viewAttributes() ?>>
<?= $Page->skor_struktur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_struktur->Visible) { // max_struktur ?>
        <td data-name="max_struktur" <?= $Page->max_struktur->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_struktur">
<span<?= $Page->max_struktur->viewAttributes() ?>>
<?= $Page->max_struktur->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
        <td data-name="skor_jobdesk" <?= $Page->skor_jobdesk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_jobdesk">
<span<?= $Page->skor_jobdesk->viewAttributes() ?>>
<?= $Page->skor_jobdesk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
        <td data-name="max_jobdesk" <?= $Page->max_jobdesk->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_jobdesk">
<span<?= $Page->max_jobdesk->viewAttributes() ?>>
<?= $Page->max_jobdesk->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_iso->Visible) { // skor_iso ?>
        <td data-name="skor_iso" <?= $Page->skor_iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_skor_iso">
<span<?= $Page->skor_iso->viewAttributes() ?>>
<?= $Page->skor_iso->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_iso->Visible) { // max_iso ?>
        <td data-name="max_iso" <?= $Page->max_iso->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_kelembagaan_max_iso">
<span<?= $Page->max_iso->viewAttributes() ?>>
<?= $Page->max_iso->getViewValue() ?></span>
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
    ew.addEventHandlers("res_nilai_kelembagaan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
