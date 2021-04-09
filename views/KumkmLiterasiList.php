<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmLiterasiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkumkm_literasilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fkumkm_literasilist = currentForm = new ew.Form("fkumkm_literasilist", "list");
    fkumkm_literasilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fkumkm_literasilist");
});
var fkumkm_literasilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fkumkm_literasilistsrch = currentSearchForm = new ew.Form("fkumkm_literasilistsrch");

    // Dynamic selection lists

    // Filters
    fkumkm_literasilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fkumkm_literasilistsrch");
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
<form name="fkumkm_literasilistsrch" id="fkumkm_literasilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fkumkm_literasilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="kumkm_literasi">
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
<div class="ew-multi-column-grid">
<?php if (!$Page->isExport()) { ?>
<div>
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
<form name="fkumkm_literasilist" id="fkumkm_literasilist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_literasi">
<div class="row ew-multi-column-row">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_kumkm_literasi", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
<div class="<?= $Page->getMultiColumnClass() ?>" <?= $Page->rowAttributes() ?>>
    <div class="card ew-card">
    <div class="card-body">
    <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
    <table class="table table-striped table-sm ew-view-table">
    <?php } ?>
    <?php if ($Page->tgl->Visible) { // tgl ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_tgl"><?= $Page->renderSort($Page->tgl) ?></span></td>
            <td <?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_tgl">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_tgl">
<span<?= $Page->tgl->viewAttributes() ?>>
<?= $Page->tgl->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->foto->Visible) { // foto ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_foto"><?= $Page->renderSort($Page->foto) ?></span></td>
            <td <?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= $Page->foto->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_foto">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_foto">
<span<?= $Page->foto->viewAttributes() ?>>
<?= $Page->foto->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->idjenis->Visible) { // idjenis ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_idjenis"><?= $Page->renderSort($Page->idjenis) ?></span></td>
            <td <?= $Page->idjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_idjenis">
<span<?= $Page->idjenis->viewAttributes() ?>>
<?= $Page->idjenis->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_idjenis">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->idjenis->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_idjenis">
<span<?= $Page->idjenis->viewAttributes() ?>>
<?= $Page->idjenis->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->judul_artikel->Visible) { // judul_artikel ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_judul_artikel"><?= $Page->renderSort($Page->judul_artikel) ?></span></td>
            <td <?= $Page->judul_artikel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_judul_artikel">
<span<?= $Page->judul_artikel->viewAttributes() ?>>
<?= $Page->judul_artikel->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_judul_artikel">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul_artikel->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->judul_artikel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_judul_artikel">
<span<?= $Page->judul_artikel->viewAttributes() ?>>
<?= $Page->judul_artikel->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->kelas->Visible) { // kelas ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_kelas"><?= $Page->renderSort($Page->kelas) ?></span></td>
            <td <?= $Page->kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_kelas">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->kelas->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->subjenis->Visible) { // subjenis ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_subjenis"><?= $Page->renderSort($Page->subjenis) ?></span></td>
            <td <?= $Page->subjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_subjenis">
<span<?= $Page->subjenis->viewAttributes() ?>>
<?= $Page->subjenis->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_subjenis">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->subjenis->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subjenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_subjenis">
<span<?= $Page->subjenis->viewAttributes() ?>>
<?= $Page->subjenis->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->urutan->Visible) { // urutan ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="kumkm_literasi_urutan"><?= $Page->renderSort($Page->urutan) ?></span></td>
            <td <?= $Page->urutan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_urutan">
<span<?= $Page->urutan->viewAttributes() ?>>
<?= $Page->urutan->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row kumkm_literasi_urutan">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->urutan->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->urutan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_literasi_urutan">
<span<?= $Page->urutan->viewAttributes() ?>>
<?= $Page->urutan->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
    </table>
    <?php } ?>
    </div><!-- /.card-body -->
<?php if (!$Page->isExport()) { ?>
    <div class="card-footer">
        <div class="ew-multi-column-list-option">
<?php
// Render list options (body, bottom)
$Page->ListOptions->render("body", "bottom", $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
        <div class="clearfix"></div>
    </div><!-- /.card-footer -->
<?php } ?>
    </div><!-- /.card -->
</div><!-- /.col-* -->
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
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
<div>
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
</div><!-- /.ew-multi-column-grid -->
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
    ew.addEventHandlers("kumkm_literasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
