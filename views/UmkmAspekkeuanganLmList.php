<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuangan_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekkeuangan_lmlist = currentForm = new ew.Form("fumkm_aspekkeuangan_lmlist", "list");
    fumkm_aspekkeuangan_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspekkeuangan_lmlist");
});
var fumkm_aspekkeuangan_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspekkeuangan_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspekkeuangan_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspekkeuangan_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspekkeuangan_lmlistsrch");
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
<form name="fumkm_aspekkeuangan_lmlistsrch" id="fumkm_aspekkeuangan_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspekkeuangan_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspekkeuangan_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspekkeuangan_lm">
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
<form name="fumkm_aspekkeuangan_lmlist" id="fumkm_aspekkeuangan_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan_lm">
<div id="gmp_umkm_aspekkeuangan_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspekkeuangan_lmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_NIK" class="umkm_aspekkeuangan_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <th data-name="KEU_USAHAUTAMA" class="<?= $Page->KEU_USAHAUTAMA->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA" class="umkm_aspekkeuangan_lm_KEU_USAHAUTAMA"><?= $Page->renderSort($Page->KEU_USAHAUTAMA) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <th data-name="KEU_PENGELOLAAN" class="<?= $Page->KEU_PENGELOLAAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN" class="umkm_aspekkeuangan_lm_KEU_PENGELOLAAN"><?= $Page->renderSort($Page->KEU_PENGELOLAAN) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <th data-name="KEU_NOTA" class="<?= $Page->KEU_NOTA->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_NOTA" class="umkm_aspekkeuangan_lm_KEU_NOTA"><?= $Page->renderSort($Page->KEU_NOTA) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <th data-name="KEU_PENCATATAN" class="<?= $Page->KEU_PENCATATAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_PENCATATAN" class="umkm_aspekkeuangan_lm_KEU_PENCATATAN"><?= $Page->renderSort($Page->KEU_PENCATATAN) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <th data-name="KEU_LAPORAN" class="<?= $Page->KEU_LAPORAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_LAPORAN" class="umkm_aspekkeuangan_lm_KEU_LAPORAN"><?= $Page->renderSort($Page->KEU_LAPORAN) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <th data-name="KEU_UTANGMODAL" class="<?= $Page->KEU_UTANGMODAL->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_UTANGMODAL" class="umkm_aspekkeuangan_lm_KEU_UTANGMODAL"><?= $Page->renderSort($Page->KEU_UTANGMODAL) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <th data-name="KEU_CATATNASET" class="<?= $Page->KEU_CATATNASET->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_CATATNASET" class="umkm_aspekkeuangan_lm_KEU_CATATNASET"><?= $Page->renderSort($Page->KEU_CATATNASET) ?></div></th>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <th data-name="KEU_NONTUNAI" class="<?= $Page->KEU_NONTUNAI->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_lm_KEU_NONTUNAI" class="umkm_aspekkeuangan_lm_KEU_NONTUNAI"><?= $Page->renderSort($Page->KEU_NONTUNAI) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekkeuangan_lm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <td data-name="KEU_USAHAUTAMA" <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA">
<span<?= $Page->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Page->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <td data-name="KEU_PENGELOLAAN" <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN">
<span<?= $Page->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Page->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <td data-name="KEU_NOTA" <?= $Page->KEU_NOTA->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_NOTA">
<span<?= $Page->KEU_NOTA->viewAttributes() ?>>
<?= $Page->KEU_NOTA->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <td data-name="KEU_PENCATATAN" <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_PENCATATAN">
<span<?= $Page->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Page->KEU_PENCATATAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <td data-name="KEU_LAPORAN" <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_LAPORAN">
<span<?= $Page->KEU_LAPORAN->viewAttributes() ?>>
<?= $Page->KEU_LAPORAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <td data-name="KEU_UTANGMODAL" <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_UTANGMODAL">
<span<?= $Page->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Page->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <td data-name="KEU_CATATNASET" <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_CATATNASET">
<span<?= $Page->KEU_CATATNASET->viewAttributes() ?>>
<?= $Page->KEU_CATATNASET->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <td data-name="KEU_NONTUNAI" <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_lm_KEU_NONTUNAI">
<span<?= $Page->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Page->KEU_NONTUNAI->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspekkeuangan_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
