<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranLmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasaran_lmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekpemasaran_lmlist = currentForm = new ew.Form("fumkm_aspekpemasaran_lmlist", "list");
    fumkm_aspekpemasaran_lmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_aspekpemasaran_lmlist");
});
var fumkm_aspekpemasaran_lmlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fumkm_aspekpemasaran_lmlistsrch = currentSearchForm = new ew.Form("fumkm_aspekpemasaran_lmlistsrch");

    // Dynamic selection lists

    // Filters
    fumkm_aspekpemasaran_lmlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fumkm_aspekpemasaran_lmlistsrch");
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
<form name="fumkm_aspekpemasaran_lmlistsrch" id="fumkm_aspekpemasaran_lmlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fumkm_aspekpemasaran_lmlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="umkm_aspekpemasaran_lm">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspekpemasaran_lm">
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
<form name="fumkm_aspekpemasaran_lmlist" id="fumkm_aspekpemasaran_lmlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran_lm">
<div id="gmp_umkm_aspekpemasaran_lm" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_umkm_aspekpemasaran_lmlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Page->NIK->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_NIK" class="umkm_aspekpemasaran_lm_NIK"><?= $Page->renderSort($Page->NIK) ?></div></th>
<?php } ?>
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
        <th data-name="MK_KEUNGGULANPRODUK" class="<?= $Page->MK_KEUNGGULANPRODUK->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK" class="umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK"><?= $Page->renderSort($Page->MK_KEUNGGULANPRODUK) ?></div></th>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
        <th data-name="MK_TARGETPASAR" class="<?= $Page->MK_TARGETPASAR->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_TARGETPASAR" class="umkm_aspekpemasaran_lm_MK_TARGETPASAR"><?= $Page->renderSort($Page->MK_TARGETPASAR) ?></div></th>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
        <th data-name="MK_KETERSEDIAAN" class="<?= $Page->MK_KETERSEDIAAN->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN" class="umkm_aspekpemasaran_lm_MK_KETERSEDIAAN"><?= $Page->renderSort($Page->MK_KETERSEDIAAN) ?></div></th>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
        <th data-name="MK_LOGO" class="<?= $Page->MK_LOGO->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_LOGO" class="umkm_aspekpemasaran_lm_MK_LOGO"><?= $Page->renderSort($Page->MK_LOGO) ?></div></th>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
        <th data-name="MK_HKI" class="<?= $Page->MK_HKI->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_HKI" class="umkm_aspekpemasaran_lm_MK_HKI"><?= $Page->renderSort($Page->MK_HKI) ?></div></th>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
        <th data-name="MK_BRANDING" class="<?= $Page->MK_BRANDING->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_BRANDING" class="umkm_aspekpemasaran_lm_MK_BRANDING"><?= $Page->renderSort($Page->MK_BRANDING) ?></div></th>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
        <th data-name="MK_COBRANDING" class="<?= $Page->MK_COBRANDING->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_COBRANDING" class="umkm_aspekpemasaran_lm_MK_COBRANDING"><?= $Page->renderSort($Page->MK_COBRANDING) ?></div></th>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
        <th data-name="MK_MEDIAOFFLINE" class="<?= $Page->MK_MEDIAOFFLINE->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE" class="umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE"><?= $Page->renderSort($Page->MK_MEDIAOFFLINE) ?></div></th>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
        <th data-name="MK_RESELLER" class="<?= $Page->MK_RESELLER->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_RESELLER" class="umkm_aspekpemasaran_lm_MK_RESELLER"><?= $Page->renderSort($Page->MK_RESELLER) ?></div></th>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
        <th data-name="MK_PASAR" class="<?= $Page->MK_PASAR->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_PASAR" class="umkm_aspekpemasaran_lm_MK_PASAR"><?= $Page->renderSort($Page->MK_PASAR) ?></div></th>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
        <th data-name="MK_PELANGGAN" class="<?= $Page->MK_PELANGGAN->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_PELANGGAN" class="umkm_aspekpemasaran_lm_MK_PELANGGAN"><?= $Page->renderSort($Page->MK_PELANGGAN) ?></div></th>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
        <th data-name="MK_PAMERANMANDIRI" class="<?= $Page->MK_PAMERANMANDIRI->headerCellClass() ?>"><div id="elh_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI" class="umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI"><?= $Page->renderSort($Page->MK_PAMERANMANDIRI) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekpemasaran_lm", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
        <td data-name="MK_KEUNGGULANPRODUK" <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK">
<span<?= $Page->MK_KEUNGGULANPRODUK->viewAttributes() ?>>
<?= $Page->MK_KEUNGGULANPRODUK->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
        <td data-name="MK_TARGETPASAR" <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_TARGETPASAR">
<span<?= $Page->MK_TARGETPASAR->viewAttributes() ?>>
<?= $Page->MK_TARGETPASAR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
        <td data-name="MK_KETERSEDIAAN" <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN">
<span<?= $Page->MK_KETERSEDIAAN->viewAttributes() ?>>
<?= $Page->MK_KETERSEDIAAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
        <td data-name="MK_LOGO" <?= $Page->MK_LOGO->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_LOGO">
<span<?= $Page->MK_LOGO->viewAttributes() ?>>
<?= $Page->MK_LOGO->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
        <td data-name="MK_HKI" <?= $Page->MK_HKI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_HKI">
<span<?= $Page->MK_HKI->viewAttributes() ?>>
<?= $Page->MK_HKI->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
        <td data-name="MK_BRANDING" <?= $Page->MK_BRANDING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_BRANDING">
<span<?= $Page->MK_BRANDING->viewAttributes() ?>>
<?= $Page->MK_BRANDING->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
        <td data-name="MK_COBRANDING" <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_COBRANDING">
<span<?= $Page->MK_COBRANDING->viewAttributes() ?>>
<?= $Page->MK_COBRANDING->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
        <td data-name="MK_MEDIAOFFLINE" <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE">
<span<?= $Page->MK_MEDIAOFFLINE->viewAttributes() ?>>
<?= $Page->MK_MEDIAOFFLINE->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
        <td data-name="MK_RESELLER" <?= $Page->MK_RESELLER->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_RESELLER">
<span<?= $Page->MK_RESELLER->viewAttributes() ?>>
<?= $Page->MK_RESELLER->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
        <td data-name="MK_PASAR" <?= $Page->MK_PASAR->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_PASAR">
<span<?= $Page->MK_PASAR->viewAttributes() ?>>
<?= $Page->MK_PASAR->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
        <td data-name="MK_PELANGGAN" <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_PELANGGAN">
<span<?= $Page->MK_PELANGGAN->viewAttributes() ?>>
<?= $Page->MK_PELANGGAN->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
        <td data-name="MK_PAMERANMANDIRI" <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI">
<span<?= $Page->MK_PAMERANMANDIRI->viewAttributes() ?>>
<?= $Page->MK_PAMERANMANDIRI->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_aspekpemasaran_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
