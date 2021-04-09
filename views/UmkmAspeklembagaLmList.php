<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembaga_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspeklembaga_lmlist = currentForm = new ew.Form("fumkm_aspeklembaga_lmlist", "list");
    fumkm_aspeklembaga_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspeklembaga_lmlist");
});
var fumkm_aspeklembaga_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspeklembaga_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspeklembaga_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspeklembaga_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspeklembaga_lmlistsrch");
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
<form name="fumkm_aspeklembaga_lmlistsrch" id="fumkm_aspeklembaga_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspeklembaga_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspeklembaga_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspeklembaga_lm">
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
<form name="fumkm_aspeklembaga_lmlist" id="fumkm_aspeklembaga_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga_lm">
<div id="gmp_umkm_aspeklembaga_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspeklembaga_lmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_NIK" class="umkm_aspeklembaga_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
        <th data-name="LB_BADANHUKUM" class="<?= $Page->LB_BADANHUKUM->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_BADANHUKUM" class="umkm_aspeklembaga_lm_LB_BADANHUKUM"><?= $Page->renderSort($Page->LB_BADANHUKUM) ?></div></th>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
        <th data-name="LB_IZINUSAHA" class="<?= $Page->LB_IZINUSAHA->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_IZINUSAHA" class="umkm_aspeklembaga_lm_LB_IZINUSAHA"><?= $Page->renderSort($Page->LB_IZINUSAHA) ?></div></th>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
        <th data-name="LB_NPWP" class="<?= $Page->LB_NPWP->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_NPWP" class="umkm_aspeklembaga_lm_LB_NPWP"><?= $Page->renderSort($Page->LB_NPWP) ?></div></th>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
        <th data-name="LB_SO" class="<?= $Page->LB_SO->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_SO" class="umkm_aspeklembaga_lm_LB_SO"><?= $Page->renderSort($Page->LB_SO) ?></div></th>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
        <th data-name="LB_JD" class="<?= $Page->LB_JD->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_JD" class="umkm_aspeklembaga_lm_LB_JD"><?= $Page->renderSort($Page->LB_JD) ?></div></th>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
        <th data-name="LB_ISO" class="<?= $Page->LB_ISO->headerCellClass() ?>"><div id="elh_umkm_aspeklembaga_lm_LB_ISO" class="umkm_aspeklembaga_lm_LB_ISO"><?= $Page->renderSort($Page->LB_ISO) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspeklembaga_lm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
        <td data-name="LB_BADANHUKUM" <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_BADANHUKUM">
<span<?= $Page->LB_BADANHUKUM->viewAttributes() ?>>
<?= $Page->LB_BADANHUKUM->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
        <td data-name="LB_IZINUSAHA" <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_IZINUSAHA">
<span<?= $Page->LB_IZINUSAHA->viewAttributes() ?>>
<?= $Page->LB_IZINUSAHA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
        <td data-name="LB_NPWP" <?= $Page->LB_NPWP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_NPWP">
<span<?= $Page->LB_NPWP->viewAttributes() ?>>
<?= $Page->LB_NPWP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_SO->Visible) { // LB_SO ?>
        <td data-name="LB_SO" <?= $Page->LB_SO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_SO">
<span<?= $Page->LB_SO->viewAttributes() ?>>
<?= $Page->LB_SO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_JD->Visible) { // LB_JD ?>
        <td data-name="LB_JD" <?= $Page->LB_JD->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_JD">
<span<?= $Page->LB_JD->viewAttributes() ?>>
<?= $Page->LB_JD->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
        <td data-name="LB_ISO" <?= $Page->LB_ISO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_lm_LB_ISO">
<span<?= $Page->LB_ISO->viewAttributes() ?>>
<?= $Page->LB_ISO->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspeklembaga_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
