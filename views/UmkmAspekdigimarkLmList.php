<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimark_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekdigimark_lmlist = currentForm = new ew.Form("fumkm_aspekdigimark_lmlist", "list");
    fumkm_aspekdigimark_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspekdigimark_lmlist");
});
var fumkm_aspekdigimark_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspekdigimark_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspekdigimark_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspekdigimark_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspekdigimark_lmlistsrch");
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
<form name="fumkm_aspekdigimark_lmlistsrch" id="fumkm_aspekdigimark_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspekdigimark_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspekdigimark_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspekdigimark_lm">
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
<form name="fumkm_aspekdigimark_lmlist" id="fumkm_aspekdigimark_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark_lm">
<div id="gmp_umkm_aspekdigimark_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspekdigimark_lmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_NIK" class="umkm_aspekdigimark_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
        <th data-name="DM_CHATTING" class="<?= $Page->DM_CHATTING->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_CHATTING" class="umkm_aspekdigimark_lm_DM_CHATTING"><?= $Page->renderSort($Page->DM_CHATTING) ?></div></th>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
        <th data-name="DM_MEDSOS" class="<?= $Page->DM_MEDSOS->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_MEDSOS" class="umkm_aspekdigimark_lm_DM_MEDSOS"><?= $Page->renderSort($Page->DM_MEDSOS) ?></div></th>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
        <th data-name="DM_MP" class="<?= $Page->DM_MP->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_MP" class="umkm_aspekdigimark_lm_DM_MP"><?= $Page->renderSort($Page->DM_MP) ?></div></th>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
        <th data-name="DM_GMB" class="<?= $Page->DM_GMB->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_GMB" class="umkm_aspekdigimark_lm_DM_GMB"><?= $Page->renderSort($Page->DM_GMB) ?></div></th>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
        <th data-name="DM_WEB" class="<?= $Page->DM_WEB->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_WEB" class="umkm_aspekdigimark_lm_DM_WEB"><?= $Page->renderSort($Page->DM_WEB) ?></div></th>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
        <th data-name="DM_UPDATEMEDSOS" class="<?= $Page->DM_UPDATEMEDSOS->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS" class="umkm_aspekdigimark_lm_DM_UPDATEMEDSOS"><?= $Page->renderSort($Page->DM_UPDATEMEDSOS) ?></div></th>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
        <th data-name="DM_UPDATEWEBSITE" class="<?= $Page->DM_UPDATEWEBSITE->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE" class="umkm_aspekdigimark_lm_DM_UPDATEWEBSITE"><?= $Page->renderSort($Page->DM_UPDATEWEBSITE) ?></div></th>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
        <th data-name="DM_GOOGLEINDEX" class="<?= $Page->DM_GOOGLEINDEX->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_GOOGLEINDEX" class="umkm_aspekdigimark_lm_DM_GOOGLEINDEX"><?= $Page->renderSort($Page->DM_GOOGLEINDEX) ?></div></th>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
        <th data-name="DM_IKLANBERBAYAR" class="<?= $Page->DM_IKLANBERBAYAR->headerCellClass() ?>"><div id="elh_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR" class="umkm_aspekdigimark_lm_DM_IKLANBERBAYAR"><?= $Page->renderSort($Page->DM_IKLANBERBAYAR) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekdigimark_lm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
        <td data-name="DM_CHATTING" <?= $Page->DM_CHATTING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_CHATTING">
<span<?= $Page->DM_CHATTING->viewAttributes() ?>>
<?= $Page->DM_CHATTING->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
        <td data-name="DM_MEDSOS" <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_MEDSOS">
<span<?= $Page->DM_MEDSOS->viewAttributes() ?>>
<?= $Page->DM_MEDSOS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_MP->Visible) { // DM_MP ?>
        <td data-name="DM_MP" <?= $Page->DM_MP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_MP">
<span<?= $Page->DM_MP->viewAttributes() ?>>
<?= $Page->DM_MP->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
        <td data-name="DM_GMB" <?= $Page->DM_GMB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_GMB">
<span<?= $Page->DM_GMB->viewAttributes() ?>>
<?= $Page->DM_GMB->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
        <td data-name="DM_WEB" <?= $Page->DM_WEB->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_WEB">
<span<?= $Page->DM_WEB->viewAttributes() ?>>
<?= $Page->DM_WEB->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
        <td data-name="DM_UPDATEMEDSOS" <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS">
<span<?= $Page->DM_UPDATEMEDSOS->viewAttributes() ?>>
<?= $Page->DM_UPDATEMEDSOS->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
        <td data-name="DM_UPDATEWEBSITE" <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE">
<span<?= $Page->DM_UPDATEWEBSITE->viewAttributes() ?>>
<?= $Page->DM_UPDATEWEBSITE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
        <td data-name="DM_GOOGLEINDEX" <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_GOOGLEINDEX">
<span<?= $Page->DM_GOOGLEINDEX->viewAttributes() ?>>
<?= $Page->DM_GOOGLEINDEX->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
        <td data-name="DM_IKLANBERBAYAR" <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR">
<span<?= $Page->DM_IKLANBERBAYAR->viewAttributes() ?>>
<?= $Page->DM_IKLANBERBAYAR->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspekdigimark_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
