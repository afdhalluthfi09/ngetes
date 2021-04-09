<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinapesertalengkapList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fbinapesertalengkaplist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fbinapesertalengkaplist = currentForm = new ew.Form("fbinapesertalengkaplist", "list");
    fbinapesertalengkaplist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fbinapesertalengkaplist");
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
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> binapesertalengkap">
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
<form name="fbinapesertalengkaplist" id="fbinapesertalengkaplist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="binapesertalengkap">
<div id="gmp_binapesertalengkap" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_binapesertalengkaplist" class="table ew-table"><!-- .ew-table -->
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
<?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
        <th data-name="periode_tahun" class="<?= $Page->periode_tahun->headerCellClass() ?>"><div id="elh_binapesertalengkap_periode_tahun" class="binapesertalengkap_periode_tahun"><?= $Page->renderSort($Page->periode_tahun) ?></div></th>
<?php } ?>
<?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
        <th data-name="periode_bulan" class="<?= $Page->periode_bulan->headerCellClass() ?>"><div id="elh_binapesertalengkap_periode_bulan" class="binapesertalengkap_periode_bulan"><?= $Page->renderSort($Page->periode_bulan) ?></div></th>
<?php } ?>
<?php if ($Page->kelompok_pembinaan->Visible) { // kelompok_pembinaan ?>
        <th data-name="kelompok_pembinaan" class="<?= $Page->kelompok_pembinaan->headerCellClass() ?>"><div id="elh_binapesertalengkap_kelompok_pembinaan" class="binapesertalengkap_kelompok_pembinaan"><?= $Page->renderSort($Page->kelompok_pembinaan) ?></div></th>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <th data-name="namakegiatan" class="<?= $Page->namakegiatan->headerCellClass() ?>"><div id="elh_binapesertalengkap_namakegiatan" class="binapesertalengkap_namakegiatan"><?= $Page->renderSort($Page->namakegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
        <th data-name="status" class="<?= $Page->status->headerCellClass() ?>"><div id="elh_binapesertalengkap_status" class="binapesertalengkap_status"><?= $Page->renderSort($Page->status) ?></div></th>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_binapesertalengkap", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
        <td data-name="periode_tahun" <?= $Page->periode_tahun->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_binapesertalengkap_periode_tahun">
<span<?= $Page->periode_tahun->viewAttributes() ?>>
<?= $Page->periode_tahun->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
        <td data-name="periode_bulan" <?= $Page->periode_bulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_binapesertalengkap_periode_bulan">
<span<?= $Page->periode_bulan->viewAttributes() ?>>
<?= $Page->periode_bulan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kelompok_pembinaan->Visible) { // kelompok_pembinaan ?>
        <td data-name="kelompok_pembinaan" <?= $Page->kelompok_pembinaan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_binapesertalengkap_kelompok_pembinaan">
<span<?= $Page->kelompok_pembinaan->viewAttributes() ?>>
<?= $Page->kelompok_pembinaan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
        <td data-name="namakegiatan" <?= $Page->namakegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_binapesertalengkap_namakegiatan">
<span<?= $Page->namakegiatan->viewAttributes() ?>>
<?= $Page->namakegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->status->Visible) { // status ?>
        <td data-name="status" <?= $Page->status->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_binapesertalengkap_status">
<span<?= $Page->status->viewAttributes() ?>>
<?= $Page->status->getViewValue() ?></span>
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
    ew.addEventHandlers("binapesertalengkap");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
