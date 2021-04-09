<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmVariabelList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_variabellist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_variabellist = currentForm = new ew.Form("fumkm_variabellist", "list");
    fumkm_variabellist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_variabellist");
});
var fumkm_variabellistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_variabellistsrch = currentSearchForm = new ew.Form("fumkm_variabellistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_variabellistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_variabellistsrch");
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
<form name="fumkm_variabellistsrch" id="fumkm_variabellistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_variabellistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_variabel">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_variabel">
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
<form name="fumkm_variabellist" id="fumkm_variabellist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_variabel">
<div id="gmp_umkm_variabel" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_variabellist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->id->Visible) { // id ?>
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_umkm_variabel_id" class="umkm_variabel_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->variabel->Visible) { // variabel ?>
        <th data-name="variabel" class="<?= $Page->variabel->headerCellClass() ?>"><div id="elh_umkm_variabel_variabel" class="umkm_variabel_variabel"><?= $Page->renderSort($Page->variabel) ?></div></th>
<?php } ?>
<?php if ($Page->nmin->Visible) { // nmin ?>
        <th data-name="nmin" class="<?= $Page->nmin->headerCellClass() ?>"><div id="elh_umkm_variabel_nmin" class="umkm_variabel_nmin"><?= $Page->renderSort($Page->nmin) ?></div></th>
<?php } ?>
<?php if ($Page->nmax->Visible) { // nmax ?>
        <th data-name="nmax" class="<?= $Page->nmax->headerCellClass() ?>"><div id="elh_umkm_variabel_nmax" class="umkm_variabel_nmax"><?= $Page->renderSort($Page->nmax) ?></div></th>
<?php } ?>
<?php if ($Page->subkat->Visible) { // subkat ?>
        <th data-name="subkat" class="<?= $Page->subkat->headerCellClass() ?>"><div id="elh_umkm_variabel_subkat" class="umkm_variabel_subkat"><?= $Page->renderSort($Page->subkat) ?></div></th>
<?php } ?>
<?php if ($Page->bobot->Visible) { // bobot ?>
        <th data-name="bobot" class="<?= $Page->bobot->headerCellClass() ?>"><div id="elh_umkm_variabel_bobot" class="umkm_variabel_bobot"><?= $Page->renderSort($Page->bobot) ?></div></th>
<?php } ?>
<?php if ($Page->kat->Visible) { // kat ?>
        <th data-name="kat" class="<?= $Page->kat->headerCellClass() ?>"><div id="elh_umkm_variabel_kat" class="umkm_variabel_kat"><?= $Page->renderSort($Page->kat) ?></div></th>
<?php } ?>
<?php if ($Page->porsi->Visible) { // porsi ?>
        <th data-name="porsi" class="<?= $Page->porsi->headerCellClass() ?>"><div id="elh_umkm_variabel_porsi" class="umkm_variabel_porsi"><?= $Page->renderSort($Page->porsi) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_variabel", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->id->Visible) { // id ?>
        <td data-name="id" <?= $Page->id->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->variabel->Visible) { // variabel ?>
        <td data-name="variabel" <?= $Page->variabel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_variabel">
<span<?= $Page->variabel->viewAttributes() ?>>
<?= $Page->variabel->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nmin->Visible) { // nmin ?>
        <td data-name="nmin" <?= $Page->nmin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_nmin">
<span<?= $Page->nmin->viewAttributes() ?>>
<?= $Page->nmin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nmax->Visible) { // nmax ?>
        <td data-name="nmax" <?= $Page->nmax->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_nmax">
<span<?= $Page->nmax->viewAttributes() ?>>
<?= $Page->nmax->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->subkat->Visible) { // subkat ?>
        <td data-name="subkat" <?= $Page->subkat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_subkat">
<span<?= $Page->subkat->viewAttributes() ?>>
<?= $Page->subkat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->bobot->Visible) { // bobot ?>
        <td data-name="bobot" <?= $Page->bobot->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_bobot">
<span<?= $Page->bobot->viewAttributes() ?>>
<?= $Page->bobot->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kat->Visible) { // kat ?>
        <td data-name="kat" <?= $Page->kat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_kat">
<span<?= $Page->kat->viewAttributes() ?>>
<?= $Page->kat->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->porsi->Visible) { // porsi ?>
        <td data-name="porsi" <?= $Page->porsi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_variabel_porsi">
<span<?= $Page->porsi->viewAttributes() ?>>
<?= $Page->porsi->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_variabel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
