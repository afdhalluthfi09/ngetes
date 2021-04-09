<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$ResNilaiKeuanganList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fres_nilai_keuanganlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fres_nilai_keuanganlist = currentForm = new ew.Form("fres_nilai_keuanganlist", "list");
    fres_nilai_keuanganlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fres_nilai_keuanganlist");
});
var fres_nilai_keuanganlistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fres_nilai_keuanganlistsrch = currentSearchForm = new ew.Form("fres_nilai_keuanganlistsrch");

    // Dynamic selection lists

    // Filters
    fres_nilai_keuanganlistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fres_nilai_keuanganlistsrch");
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
<form name="fres_nilai_keuanganlistsrch" id="fres_nilai_keuanganlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fres_nilai_keuanganlistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="res_nilai_keuangan">
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
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> res_nilai_keuangan">
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
<form name="fres_nilai_keuanganlist" id="fres_nilai_keuanganlist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="res_nilai_keuangan">
<div id="gmp_res_nilai_keuangan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_res_nilai_keuanganlist" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_nik" class="res_nilai_keuangan_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->skor_income->Visible) { // skor_income ?>
        <th data-name="skor_income" class="<?= $Page->skor_income->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_income" class="res_nilai_keuangan_skor_income"><?= $Page->renderSort($Page->skor_income) ?></div></th>
<?php } ?>
<?php if ($Page->max_income->Visible) { // max_income ?>
        <th data-name="max_income" class="<?= $Page->max_income->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_income" class="res_nilai_keuangan_max_income"><?= $Page->renderSort($Page->max_income) ?></div></th>
<?php } ?>
<?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
        <th data-name="skor_pengelolaan" class="<?= $Page->skor_pengelolaan->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_pengelolaan" class="res_nilai_keuangan_skor_pengelolaan"><?= $Page->renderSort($Page->skor_pengelolaan) ?></div></th>
<?php } ?>
<?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
        <th data-name="max_pengelolaan" class="<?= $Page->max_pengelolaan->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_pengelolaan" class="res_nilai_keuangan_max_pengelolaan"><?= $Page->renderSort($Page->max_pengelolaan) ?></div></th>
<?php } ?>
<?php if ($Page->skor_nota->Visible) { // skor_nota ?>
        <th data-name="skor_nota" class="<?= $Page->skor_nota->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_nota" class="res_nilai_keuangan_skor_nota"><?= $Page->renderSort($Page->skor_nota) ?></div></th>
<?php } ?>
<?php if ($Page->max_nota->Visible) { // max_nota ?>
        <th data-name="max_nota" class="<?= $Page->max_nota->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_nota" class="res_nilai_keuangan_max_nota"><?= $Page->renderSort($Page->max_nota) ?></div></th>
<?php } ?>
<?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
        <th data-name="skor_jurnal" class="<?= $Page->skor_jurnal->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_jurnal" class="res_nilai_keuangan_skor_jurnal"><?= $Page->renderSort($Page->skor_jurnal) ?></div></th>
<?php } ?>
<?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
        <th data-name="max_jurnal" class="<?= $Page->max_jurnal->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_jurnal" class="res_nilai_keuangan_max_jurnal"><?= $Page->renderSort($Page->max_jurnal) ?></div></th>
<?php } ?>
<?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
        <th data-name="skor_akutansi" class="<?= $Page->skor_akutansi->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_akutansi" class="res_nilai_keuangan_skor_akutansi"><?= $Page->renderSort($Page->skor_akutansi) ?></div></th>
<?php } ?>
<?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
        <th data-name="max_akutansi" class="<?= $Page->max_akutansi->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_akutansi" class="res_nilai_keuangan_max_akutansi"><?= $Page->renderSort($Page->max_akutansi) ?></div></th>
<?php } ?>
<?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
        <th data-name="skor_utangbank" class="<?= $Page->skor_utangbank->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_utangbank" class="res_nilai_keuangan_skor_utangbank"><?= $Page->renderSort($Page->skor_utangbank) ?></div></th>
<?php } ?>
<?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
        <th data-name="max_utangbank" class="<?= $Page->max_utangbank->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_utangbank" class="res_nilai_keuangan_max_utangbank"><?= $Page->renderSort($Page->max_utangbank) ?></div></th>
<?php } ?>
<?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
        <th data-name="skor_dokumentasi" class="<?= $Page->skor_dokumentasi->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_dokumentasi" class="res_nilai_keuangan_skor_dokumentasi"><?= $Page->renderSort($Page->skor_dokumentasi) ?></div></th>
<?php } ?>
<?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
        <th data-name="max_dokumentasi" class="<?= $Page->max_dokumentasi->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_dokumentasi" class="res_nilai_keuangan_max_dokumentasi"><?= $Page->renderSort($Page->max_dokumentasi) ?></div></th>
<?php } ?>
<?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
        <th data-name="skor_nontunai" class="<?= $Page->skor_nontunai->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_skor_nontunai" class="res_nilai_keuangan_skor_nontunai"><?= $Page->renderSort($Page->skor_nontunai) ?></div></th>
<?php } ?>
<?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
        <th data-name="max_nontunai" class="<?= $Page->max_nontunai->headerCellClass() ?>"><div id="elh_res_nilai_keuangan_max_nontunai" class="res_nilai_keuangan_max_nontunai"><?= $Page->renderSort($Page->max_nontunai) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_res_nilai_keuangan", "data-rowtype" => $Page->RowType]);

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
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_income->Visible) { // skor_income ?>
        <td data-name="skor_income" <?= $Page->skor_income->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_income">
<span<?= $Page->skor_income->viewAttributes() ?>>
<?= $Page->skor_income->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_income->Visible) { // max_income ?>
        <td data-name="max_income" <?= $Page->max_income->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_income">
<span<?= $Page->max_income->viewAttributes() ?>>
<?= $Page->max_income->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
        <td data-name="skor_pengelolaan" <?= $Page->skor_pengelolaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_pengelolaan">
<span<?= $Page->skor_pengelolaan->viewAttributes() ?>>
<?= $Page->skor_pengelolaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
        <td data-name="max_pengelolaan" <?= $Page->max_pengelolaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_pengelolaan">
<span<?= $Page->max_pengelolaan->viewAttributes() ?>>
<?= $Page->max_pengelolaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_nota->Visible) { // skor_nota ?>
        <td data-name="skor_nota" <?= $Page->skor_nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_nota">
<span<?= $Page->skor_nota->viewAttributes() ?>>
<?= $Page->skor_nota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_nota->Visible) { // max_nota ?>
        <td data-name="max_nota" <?= $Page->max_nota->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_nota">
<span<?= $Page->max_nota->viewAttributes() ?>>
<?= $Page->max_nota->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
        <td data-name="skor_jurnal" <?= $Page->skor_jurnal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_jurnal">
<span<?= $Page->skor_jurnal->viewAttributes() ?>>
<?= $Page->skor_jurnal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
        <td data-name="max_jurnal" <?= $Page->max_jurnal->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_jurnal">
<span<?= $Page->max_jurnal->viewAttributes() ?>>
<?= $Page->max_jurnal->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
        <td data-name="skor_akutansi" <?= $Page->skor_akutansi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_akutansi">
<span<?= $Page->skor_akutansi->viewAttributes() ?>>
<?= $Page->skor_akutansi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
        <td data-name="max_akutansi" <?= $Page->max_akutansi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_akutansi">
<span<?= $Page->max_akutansi->viewAttributes() ?>>
<?= $Page->max_akutansi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
        <td data-name="skor_utangbank" <?= $Page->skor_utangbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_utangbank">
<span<?= $Page->skor_utangbank->viewAttributes() ?>>
<?= $Page->skor_utangbank->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
        <td data-name="max_utangbank" <?= $Page->max_utangbank->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_utangbank">
<span<?= $Page->max_utangbank->viewAttributes() ?>>
<?= $Page->max_utangbank->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
        <td data-name="skor_dokumentasi" <?= $Page->skor_dokumentasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_dokumentasi">
<span<?= $Page->skor_dokumentasi->viewAttributes() ?>>
<?= $Page->skor_dokumentasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
        <td data-name="max_dokumentasi" <?= $Page->max_dokumentasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_dokumentasi">
<span<?= $Page->max_dokumentasi->viewAttributes() ?>>
<?= $Page->max_dokumentasi->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
        <td data-name="skor_nontunai" <?= $Page->skor_nontunai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_skor_nontunai">
<span<?= $Page->skor_nontunai->viewAttributes() ?>>
<?= $Page->skor_nontunai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
        <td data-name="max_nontunai" <?= $Page->max_nontunai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_res_nilai_keuangan_max_nontunai">
<span<?= $Page->max_nontunai->viewAttributes() ?>>
<?= $Page->max_nontunai->getViewValue() ?></span>
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
    ew.addEventHandlers("res_nilai_keuangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
