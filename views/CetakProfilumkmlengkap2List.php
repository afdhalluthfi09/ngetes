<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$CetakProfilumkmlengkap2List = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var f_cetak_profilumkmlengkap2list;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    f_cetak_profilumkmlengkap2list = currentForm = new ew.Form("f_cetak_profilumkmlengkap2list", "list");
    f_cetak_profilumkmlengkap2list.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("f_cetak_profilumkmlengkap2list");
});
var f_cetak_profilumkmlengkap2listsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    f_cetak_profilumkmlengkap2listsrch = currentSearchForm = new ew.Form("f_cetak_profilumkmlengkap2listsrch");

    // Dynamic selection lists

    // Filters
    f_cetak_profilumkmlengkap2listsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("f_cetak_profilumkmlengkap2listsrch");
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
<form name="f_cetak_profilumkmlengkap2listsrch" id="f_cetak_profilumkmlengkap2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="f_cetak_profilumkmlengkap2listsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_cetak_profilumkmlengkap2">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _cetak_profilumkmlengkap2">
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
<form name="f_cetak_profilumkmlengkap2list" id="f_cetak_profilumkmlengkap2list" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="_cetak_profilumkmlengkap2">
<div id="gmp__cetak_profilumkmlengkap2" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl__cetak_profilumkmlengkap2list" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_nik" class="_cetak_profilumkmlengkap2_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->klasifikas->Visible) { // klasifikas ?>
        <th data-name="klasifikas" class="<?= $Page->klasifikas->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_klasifikas" class="_cetak_profilumkmlengkap2_klasifikas"><?= $Page->renderSort($Page->klasifikas) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_kela->Visible) { // jenis_kela ?>
        <th data-name="jenis_kela" class="<?= $Page->jenis_kela->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_jenis_kela" class="_cetak_profilumkmlengkap2_jenis_kela"><?= $Page->renderSort($Page->jenis_kela) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_no_hp" class="_cetak_profilumkmlengkap2_no_hp"><?= $Page->renderSort($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th data-name="pendidikan" class="<?= $Page->pendidikan->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_pendidikan" class="_cetak_profilumkmlengkap2_pendidikan"><?= $Page->renderSort($Page->pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->disabilita->Visible) { // disabilita ?>
        <th data-name="disabilita" class="<?= $Page->disabilita->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_disabilita" class="_cetak_profilumkmlengkap2_disabilita"><?= $Page->renderSort($Page->disabilita) ?></div></th>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <th data-name="tglmulai" class="<?= $Page->tglmulai->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_tglmulai" class="_cetak_profilumkmlengkap2_tglmulai"><?= $Page->renderSort($Page->tglmulai) ?></div></th>
<?php } ?>
<?php if ($Page->nilai_aset->Visible) { // nilai_aset ?>
        <th data-name="nilai_aset" class="<?= $Page->nilai_aset->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_nilai_aset" class="_cetak_profilumkmlengkap2_nilai_aset"><?= $Page->renderSort($Page->nilai_aset) ?></div></th>
<?php } ?>
<?php if ($Page->omsetbulan->Visible) { // omsetbulan ?>
        <th data-name="omsetbulan" class="<?= $Page->omsetbulan->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_omsetbulan" class="_cetak_profilumkmlengkap2_omsetbulan"><?= $Page->renderSort($Page->omsetbulan) ?></div></th>
<?php } ?>
<?php if ($Page->emailusaha->Visible) { // emailusaha ?>
        <th data-name="emailusaha" class="<?= $Page->emailusaha->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_emailusaha" class="_cetak_profilumkmlengkap2_emailusaha"><?= $Page->renderSort($Page->emailusaha) ?></div></th>
<?php } ?>
<?php if ($Page->akun_ig->Visible) { // akun_ig ?>
        <th data-name="akun_ig" class="<?= $Page->akun_ig->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_akun_ig" class="_cetak_profilumkmlengkap2_akun_ig"><?= $Page->renderSort($Page->akun_ig) ?></div></th>
<?php } ?>
<?php if ($Page->akun_faceb->Visible) { // akun_faceb ?>
        <th data-name="akun_faceb" class="<?= $Page->akun_faceb->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_akun_faceb" class="_cetak_profilumkmlengkap2_akun_faceb"><?= $Page->renderSort($Page->akun_faceb) ?></div></th>
<?php } ?>
<?php if ($Page->akun_gmb->Visible) { // akun_gmb ?>
        <th data-name="akun_gmb" class="<?= $Page->akun_gmb->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_akun_gmb" class="_cetak_profilumkmlengkap2_akun_gmb"><?= $Page->renderSort($Page->akun_gmb) ?></div></th>
<?php } ?>
<?php if ($Page->url_websit->Visible) { // url_websit ?>
        <th data-name="url_websit" class="<?= $Page->url_websit->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_url_websit" class="_cetak_profilumkmlengkap2_url_websit"><?= $Page->renderSort($Page->url_websit) ?></div></th>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
        <th data-name="kelas" class="<?= $Page->kelas->headerCellClass() ?>"><div id="elh__cetak_profilumkmlengkap2_kelas" class="_cetak_profilumkmlengkap2_kelas"><?= $Page->renderSort($Page->kelas) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "__cetak_profilumkmlengkap2", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->klasifikas->Visible) { // klasifikas ?>
        <td data-name="klasifikas" <?= $Page->klasifikas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_klasifikas">
<span<?= $Page->klasifikas->viewAttributes() ?>>
<?= $Page->klasifikas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis_kela->Visible) { // jenis_kela ?>
        <td data-name="jenis_kela" <?= $Page->jenis_kela->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_jenis_kela">
<span<?= $Page->jenis_kela->viewAttributes() ?>>
<?= $Page->jenis_kela->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->disabilita->Visible) { // disabilita ?>
        <td data-name="disabilita" <?= $Page->disabilita->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_disabilita">
<span<?= $Page->disabilita->viewAttributes() ?>>
<?= $Page->disabilita->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <td data-name="tglmulai" <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_tglmulai">
<span<?= $Page->tglmulai->viewAttributes() ?>>
<?= $Page->tglmulai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nilai_aset->Visible) { // nilai_aset ?>
        <td data-name="nilai_aset" <?= $Page->nilai_aset->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_nilai_aset">
<span<?= $Page->nilai_aset->viewAttributes() ?>>
<?= $Page->nilai_aset->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->omsetbulan->Visible) { // omsetbulan ?>
        <td data-name="omsetbulan" <?= $Page->omsetbulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_omsetbulan">
<span<?= $Page->omsetbulan->viewAttributes() ?>>
<?= $Page->omsetbulan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->emailusaha->Visible) { // emailusaha ?>
        <td data-name="emailusaha" <?= $Page->emailusaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_emailusaha">
<span<?= $Page->emailusaha->viewAttributes() ?>>
<?= $Page->emailusaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_ig->Visible) { // akun_ig ?>
        <td data-name="akun_ig" <?= $Page->akun_ig->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_akun_ig">
<span<?= $Page->akun_ig->viewAttributes() ?>>
<?= $Page->akun_ig->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_faceb->Visible) { // akun_faceb ?>
        <td data-name="akun_faceb" <?= $Page->akun_faceb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_akun_faceb">
<span<?= $Page->akun_faceb->viewAttributes() ?>>
<?= $Page->akun_faceb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_gmb->Visible) { // akun_gmb ?>
        <td data-name="akun_gmb" <?= $Page->akun_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_akun_gmb">
<span<?= $Page->akun_gmb->viewAttributes() ?>>
<?= $Page->akun_gmb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->url_websit->Visible) { // url_websit ?>
        <td data-name="url_websit" <?= $Page->url_websit->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_url_websit">
<span<?= $Page->url_websit->viewAttributes() ?>>
<?= $Page->url_websit->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kelas->Visible) { // kelas ?>
        <td data-name="kelas" <?= $Page->kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>__cetak_profilumkmlengkap2_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
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
    ew.addEventHandlers("_cetak_profilumkmlengkap2");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
