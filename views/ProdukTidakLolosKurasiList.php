<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ProdukTidakLolosKurasiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fProduk_Tidak_Lolos_Kurasilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fProduk_Tidak_Lolos_Kurasilist = currentForm = new ew.Form("fProduk_Tidak_Lolos_Kurasilist", "list");
    fProduk_Tidak_Lolos_Kurasilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fProduk_Tidak_Lolos_Kurasilist");
});
var fProduk_Tidak_Lolos_Kurasilistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fProduk_Tidak_Lolos_Kurasilistsrch = currentSearchForm = new ew.Form("fProduk_Tidak_Lolos_Kurasilistsrch");

    // Dynamic selection lists

    // Filters
    fProduk_Tidak_Lolos_Kurasilistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fProduk_Tidak_Lolos_Kurasilistsrch");
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
<form name="fProduk_Tidak_Lolos_Kurasilistsrch" id="fProduk_Tidak_Lolos_Kurasilistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fProduk_Tidak_Lolos_Kurasilistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="Produk_Tidak_Lolos_Kurasi">
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
<form name="fProduk_Tidak_Lolos_Kurasilist" id="fProduk_Tidak_Lolos_Kurasilist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="Produk_Tidak_Lolos_Kurasi">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_Produk_Tidak_Lolos_Kurasi", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->produk_foto->Visible) { // produk_foto ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_foto"><?= $Page->renderSort($Page->produk_foto) ?></span></td>
            <td <?= $Page->produk_foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto">
<span<?= $Page->produk_foto->viewAttributes() ?>>
<?= $Page->produk_foto->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_foto">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto">
<span<?= $Page->produk_foto->viewAttributes() ?>>
<?= $Page->produk_foto->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_nama->Visible) { // produk_nama ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_nama"><?= $Page->renderSort($Page->produk_nama) ?></span></td>
            <td <?= $Page->produk_nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_nama">
<span<?= $Page->produk_nama->viewAttributes() ?>>
<?= $Page->produk_nama->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_nama">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_nama->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_nama">
<span<?= $Page->produk_nama->viewAttributes() ?>>
<?= $Page->produk_nama->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_jenis->Visible) { // produk_jenis ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_jenis"><?= $Page->renderSort($Page->produk_jenis) ?></span></td>
            <td <?= $Page->produk_jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_jenis">
<span<?= $Page->produk_jenis->viewAttributes() ?>>
<?= $Page->produk_jenis->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_jenis">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_jenis->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_jenis">
<span<?= $Page->produk_jenis->viewAttributes() ?>>
<?= $Page->produk_jenis->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_harga->Visible) { // produk_harga ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_harga"><?= $Page->renderSort($Page->produk_harga) ?></span></td>
            <td <?= $Page->produk_harga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_harga">
<span<?= $Page->produk_harga->viewAttributes() ?>>
<?= $Page->produk_harga->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_harga">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_harga->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_harga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_harga">
<span<?= $Page->produk_harga->viewAttributes() ?>>
<?= $Page->produk_harga->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->judul_sesuai->Visible) { // judul_sesuai ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_judul_sesuai" style="white-space: nowrap;"><?= $Page->renderSort($Page->judul_sesuai) ?></span></td>
            <td <?= $Page->judul_sesuai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_judul_sesuai">
<span<?= $Page->judul_sesuai->viewAttributes() ?>>
<?= $Page->judul_sesuai->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_judul_sesuai">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul_sesuai->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->judul_sesuai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_judul_sesuai">
<span<?= $Page->judul_sesuai->viewAttributes() ?>>
<?= $Page->judul_sesuai->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->foto_bagus->Visible) { // foto_bagus ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_foto_bagus" style="white-space: nowrap;"><?= $Page->renderSort($Page->foto_bagus) ?></span></td>
            <td <?= $Page->foto_bagus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_foto_bagus">
<span<?= $Page->foto_bagus->viewAttributes() ?>>
<?= $Page->foto_bagus->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_foto_bagus">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto_bagus->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foto_bagus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_foto_bagus">
<span<?= $Page->foto_bagus->viewAttributes() ?>>
<?= $Page->foto_bagus->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->deskripsi_jelas->Visible) { // deskripsi_jelas ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_deskripsi_jelas" style="white-space: nowrap;"><?= $Page->renderSort($Page->deskripsi_jelas) ?></span></td>
            <td <?= $Page->deskripsi_jelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_deskripsi_jelas">
<span<?= $Page->deskripsi_jelas->viewAttributes() ?>>
<?= $Page->deskripsi_jelas->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_deskripsi_jelas">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi_jelas->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deskripsi_jelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_deskripsi_jelas">
<span<?= $Page->deskripsi_jelas->viewAttributes() ?>>
<?= $Page->deskripsi_jelas->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->harga_tidak_kosong->Visible) { // harga_tidak_kosong ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_harga_tidak_kosong" style="white-space: nowrap;"><?= $Page->renderSort($Page->harga_tidak_kosong) ?></span></td>
            <td <?= $Page->harga_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_harga_tidak_kosong">
<span<?= $Page->harga_tidak_kosong->viewAttributes() ?>>
<?= $Page->harga_tidak_kosong->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_harga_tidak_kosong">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->harga_tidak_kosong->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->harga_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_harga_tidak_kosong">
<span<?= $Page->harga_tidak_kosong->viewAttributes() ?>>
<?= $Page->harga_tidak_kosong->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->berat_tidak_kosong->Visible) { // berat_tidak_kosong ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_berat_tidak_kosong" style="white-space: nowrap;"><?= $Page->renderSort($Page->berat_tidak_kosong) ?></span></td>
            <td <?= $Page->berat_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_berat_tidak_kosong">
<span<?= $Page->berat_tidak_kosong->viewAttributes() ?>>
<?= $Page->berat_tidak_kosong->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_berat_tidak_kosong">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->berat_tidak_kosong->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berat_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_berat_tidak_kosong">
<span<?= $Page->berat_tidak_kosong->viewAttributes() ?>>
<?= $Page->berat_tidak_kosong->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_foto_1->Visible) { // produk_foto_1 ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_foto_1"><?= $Page->renderSort($Page->produk_foto_1) ?></span></td>
            <td <?= $Page->produk_foto_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_1">
<span>
<?= GetFileViewTag($Page->produk_foto_1, $Page->produk_foto_1->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_foto_1">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_1->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_1">
<span>
<?= GetFileViewTag($Page->produk_foto_1, $Page->produk_foto_1->getViewValue(), false) ?>
</span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_foto_2->Visible) { // produk_foto_2 ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_foto_2"><?= $Page->renderSort($Page->produk_foto_2) ?></span></td>
            <td <?= $Page->produk_foto_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_2">
<span>
<?= GetFileViewTag($Page->produk_foto_2, $Page->produk_foto_2->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_foto_2">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_2->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_2">
<span>
<?= GetFileViewTag($Page->produk_foto_2, $Page->produk_foto_2->getViewValue(), false) ?>
</span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_foto_3->Visible) { // produk_foto_3 ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_foto_3"><?= $Page->renderSort($Page->produk_foto_3) ?></span></td>
            <td <?= $Page->produk_foto_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_3">
<span>
<?= GetFileViewTag($Page->produk_foto_3, $Page->produk_foto_3->getViewValue(), false) ?>
</span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_foto_3">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_3->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_foto_3">
<span>
<?= GetFileViewTag($Page->produk_foto_3, $Page->produk_foto_3->getViewValue(), false) ?>
</span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_berat->Visible) { // produk_berat ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_berat"><?= $Page->renderSort($Page->produk_berat) ?></span></td>
            <td <?= $Page->produk_berat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_berat">
<span<?= $Page->produk_berat->viewAttributes() ?>>
<?= $Page->produk_berat->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_berat">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_berat->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_berat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_berat">
<span<?= $Page->produk_berat->viewAttributes() ?>>
<?= $Page->produk_berat->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_panjang->Visible) { // produk_panjang ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_panjang"><?= $Page->renderSort($Page->produk_panjang) ?></span></td>
            <td <?= $Page->produk_panjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_panjang">
<span<?= $Page->produk_panjang->viewAttributes() ?>>
<?= $Page->produk_panjang->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_panjang">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_panjang->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_panjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_panjang">
<span<?= $Page->produk_panjang->viewAttributes() ?>>
<?= $Page->produk_panjang->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_lebar->Visible) { // produk_lebar ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_lebar"><?= $Page->renderSort($Page->produk_lebar) ?></span></td>
            <td <?= $Page->produk_lebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_lebar">
<span<?= $Page->produk_lebar->viewAttributes() ?>>
<?= $Page->produk_lebar->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_lebar">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_lebar->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_lebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_lebar">
<span<?= $Page->produk_lebar->viewAttributes() ?>>
<?= $Page->produk_lebar->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->produk_tinggi->Visible) { // produk_tinggi ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="Produk_Tidak_Lolos_Kurasi_produk_tinggi"><?= $Page->renderSort($Page->produk_tinggi) ?></span></td>
            <td <?= $Page->produk_tinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_tinggi">
<span<?= $Page->produk_tinggi->viewAttributes() ?>>
<?= $Page->produk_tinggi->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row Produk_Tidak_Lolos_Kurasi_produk_tinggi">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_tinggi->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_tinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_Produk_Tidak_Lolos_Kurasi_produk_tinggi">
<span<?= $Page->produk_tinggi->viewAttributes() ?>>
<?= $Page->produk_tinggi->getViewValue() ?></span>
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
    ew.addEventHandlers("Produk_Tidak_Lolos_Kurasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
