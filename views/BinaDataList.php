<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaDataList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbina_datalist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbina_datalist = currentForm = new ew.Form("fbina_datalist", "list");
    fbina_datalist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbina_datalist");
});
var fbina_datalistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fbina_datalistsrch = currentSearchForm = new ew.Form("fbina_datalistsrch");

    // Dynamic selection lists

    // Filters
    fbina_datalistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fbina_datalistsrch");
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
<form name="fbina_datalistsrch" id="fbina_datalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fbina_datalistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bina_data">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bina_data">
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
<form name="fbina_datalist" id="fbina_datalist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_data">
<div id="gmp_bina_data" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_bina_datalist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="id" class="<?= $Page->id->headerCellClass() ?>"><div id="elh_bina_data_id" class="bina_data_id"><?= $Page->renderSort($Page->id) ?></div></th>
<?php } ?>
<?php if ($Page->idperiode->Visible) { // idperiode ?>
        <th data-name="idperiode" class="<?= $Page->idperiode->headerCellClass() ?>"><div id="elh_bina_data_idperiode" class="bina_data_idperiode"><?= $Page->renderSort($Page->idperiode) ?></div></th>
<?php } ?>
<?php if ($Page->idkelompok->Visible) { // idkelompok ?>
        <th data-name="idkelompok" class="<?= $Page->idkelompok->headerCellClass() ?>"><div id="elh_bina_data_idkelompok" class="bina_data_idkelompok"><?= $Page->renderSort($Page->idkelompok) ?></div></th>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <th data-name="namakegiatan" class="<?= $Page->namakegiatan->headerCellClass() ?>"><div id="elh_bina_data_namakegiatan" class="bina_data_namakegiatan"><?= $Page->renderSort($Page->namakegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
        <th data-name="uraian" class="<?= $Page->uraian->headerCellClass() ?>"><div id="elh_bina_data_uraian" class="bina_data_uraian"><?= $Page->renderSort($Page->uraian) ?></div></th>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <th data-name="tglmulai" class="<?= $Page->tglmulai->headerCellClass() ?>"><div id="elh_bina_data_tglmulai" class="bina_data_tglmulai"><?= $Page->renderSort($Page->tglmulai) ?></div></th>
<?php } ?>
<?php if ($Page->tglakhir->Visible) { // tglakhir ?>
        <th data-name="tglakhir" class="<?= $Page->tglakhir->headerCellClass() ?>"><div id="elh_bina_data_tglakhir" class="bina_data_tglakhir"><?= $Page->renderSort($Page->tglakhir) ?></div></th>
<?php } ?>
<?php if ($Page->narasumber->Visible) { // narasumber ?>
        <th data-name="narasumber" class="<?= $Page->narasumber->headerCellClass() ?>"><div id="elh_bina_data_narasumber" class="bina_data_narasumber"><?= $Page->renderSort($Page->narasumber) ?></div></th>
<?php } ?>
<?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
        <th data-name="kontak_nama" class="<?= $Page->kontak_nama->headerCellClass() ?>"><div id="elh_bina_data_kontak_nama" class="bina_data_kontak_nama"><?= $Page->renderSort($Page->kontak_nama) ?></div></th>
<?php } ?>
<?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
        <th data-name="kontak_hp" class="<?= $Page->kontak_hp->headerCellClass() ?>"><div id="elh_bina_data_kontak_hp" class="bina_data_kontak_hp"><?= $Page->renderSort($Page->kontak_hp) ?></div></th>
<?php } ?>
<?php if ($Page->poster->Visible) { // poster ?>
        <th data-name="poster" class="<?= $Page->poster->headerCellClass() ?>"><div id="elh_bina_data_poster" class="bina_data_poster"><?= $Page->renderSort($Page->poster) ?></div></th>
<?php } ?>
<?php if ($Page->postertipe->Visible) { // postertipe ?>
        <th data-name="postertipe" class="<?= $Page->postertipe->headerCellClass() ?>"><div id="elh_bina_data_postertipe" class="bina_data_postertipe"><?= $Page->renderSort($Page->postertipe) ?></div></th>
<?php } ?>
<?php if ($Page->posterukuran->Visible) { // posterukuran ?>
        <th data-name="posterukuran" class="<?= $Page->posterukuran->headerCellClass() ?>"><div id="elh_bina_data_posterukuran" class="bina_data_posterukuran"><?= $Page->renderSort($Page->posterukuran) ?></div></th>
<?php } ?>
<?php if ($Page->posterlebar->Visible) { // posterlebar ?>
        <th data-name="posterlebar" class="<?= $Page->posterlebar->headerCellClass() ?>"><div id="elh_bina_data_posterlebar" class="bina_data_posterlebar"><?= $Page->renderSort($Page->posterlebar) ?></div></th>
<?php } ?>
<?php if ($Page->postertinggi->Visible) { // postertinggi ?>
        <th data-name="postertinggi" class="<?= $Page->postertinggi->headerCellClass() ?>"><div id="elh_bina_data_postertinggi" class="bina_data_postertinggi"><?= $Page->renderSort($Page->postertinggi) ?></div></th>
<?php } ?>
<?php if ($Page->linkinfo->Visible) { // linkinfo ?>
        <th data-name="linkinfo" class="<?= $Page->linkinfo->headerCellClass() ?>"><div id="elh_bina_data_linkinfo" class="bina_data_linkinfo"><?= $Page->renderSort($Page->linkinfo) ?></div></th>
<?php } ?>
<?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
        <th data-name="peserta_kelas" class="<?= $Page->peserta_kelas->headerCellClass() ?>"><div id="elh_bina_data_peserta_kelas" class="bina_data_peserta_kelas"><?= $Page->renderSort($Page->peserta_kelas) ?></div></th>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
        <th data-name="waktu" class="<?= $Page->waktu->headerCellClass() ?>"><div id="elh_bina_data_waktu" class="bina_data_waktu"><?= $Page->renderSort($Page->waktu) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_bina_data", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_bina_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<?= $Page->id->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idperiode->Visible) { // idperiode ?>
        <td data-name="idperiode" <?= $Page->idperiode->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_idperiode">
<span<?= $Page->idperiode->viewAttributes() ?>>
<?= $Page->idperiode->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->idkelompok->Visible) { // idkelompok ?>
        <td data-name="idkelompok" <?= $Page->idkelompok->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_idkelompok">
<span<?= $Page->idkelompok->viewAttributes() ?>>
<?= $Page->idkelompok->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <td data-name="namakegiatan" <?= $Page->namakegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_namakegiatan">
<span<?= $Page->namakegiatan->viewAttributes() ?>>
<?= $Page->namakegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian->Visible) { // uraian ?>
        <td data-name="uraian" <?= $Page->uraian->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_uraian">
<span<?= $Page->uraian->viewAttributes() ?>>
<?= $Page->uraian->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <td data-name="tglmulai" <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_tglmulai">
<span<?= $Page->tglmulai->viewAttributes() ?>>
<?= $Page->tglmulai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tglakhir->Visible) { // tglakhir ?>
        <td data-name="tglakhir" <?= $Page->tglakhir->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_tglakhir">
<span<?= $Page->tglakhir->viewAttributes() ?>>
<?= $Page->tglakhir->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->narasumber->Visible) { // narasumber ?>
        <td data-name="narasumber" <?= $Page->narasumber->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_narasumber">
<span<?= $Page->narasumber->viewAttributes() ?>>
<?= $Page->narasumber->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
        <td data-name="kontak_nama" <?= $Page->kontak_nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_kontak_nama">
<span<?= $Page->kontak_nama->viewAttributes() ?>>
<?= $Page->kontak_nama->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
        <td data-name="kontak_hp" <?= $Page->kontak_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_kontak_hp">
<span<?= $Page->kontak_hp->viewAttributes() ?>>
<?= $Page->kontak_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->poster->Visible) { // poster ?>
        <td data-name="poster" <?= $Page->poster->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_poster">
<span<?= $Page->poster->viewAttributes() ?>>
<?= $Page->poster->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->postertipe->Visible) { // postertipe ?>
        <td data-name="postertipe" <?= $Page->postertipe->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_postertipe">
<span<?= $Page->postertipe->viewAttributes() ?>>
<?= $Page->postertipe->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->posterukuran->Visible) { // posterukuran ?>
        <td data-name="posterukuran" <?= $Page->posterukuran->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_posterukuran">
<span<?= $Page->posterukuran->viewAttributes() ?>>
<?= $Page->posterukuran->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->posterlebar->Visible) { // posterlebar ?>
        <td data-name="posterlebar" <?= $Page->posterlebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_posterlebar">
<span<?= $Page->posterlebar->viewAttributes() ?>>
<?= $Page->posterlebar->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->postertinggi->Visible) { // postertinggi ?>
        <td data-name="postertinggi" <?= $Page->postertinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_postertinggi">
<span<?= $Page->postertinggi->viewAttributes() ?>>
<?= $Page->postertinggi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->linkinfo->Visible) { // linkinfo ?>
        <td data-name="linkinfo" <?= $Page->linkinfo->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_linkinfo">
<span<?= $Page->linkinfo->viewAttributes() ?>>
<?= $Page->linkinfo->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
        <td data-name="peserta_kelas" <?= $Page->peserta_kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_peserta_kelas">
<span<?= $Page->peserta_kelas->viewAttributes() ?>>
<?= $Page->peserta_kelas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->waktu->Visible) { // waktu ?>
        <td data-name="waktu" <?= $Page->waktu->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_bina_data_waktu">
<span<?= $Page->waktu->viewAttributes() ?>>
<?= $Page->waktu->getViewValue() ?></span>
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
    ew.addEventHandlers("bina_data");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
