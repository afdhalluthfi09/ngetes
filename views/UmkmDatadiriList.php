<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmDatadiriList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_datadirilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_datadirilist = currentForm = new ew.Form("fumkm_datadirilist", "list");
    fumkm_datadirilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fumkm_datadirilist");
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
<div class="ew-multi-column-grid">
<form name="fumkm_datadirilist" id="fumkm_datadirilist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_datadiri">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_datadiri", "data-rowtype" => $Page->RowType]);

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
    <?php if ($Page->NIK->Visible) { // NIK ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_NIK" style="white-space: nowrap;"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NIK">
<span<?= $Page->NIK->viewAttributes() ?>><?= Barcode()->show('', 'QRCODE', 100) ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NIK">
<span<?= $Page->NIK->viewAttributes() ?>><?= Barcode()->show('', 'QRCODE', 100) ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_NAMA_PEMILIK"><?= $Page->renderSort($Page->NAMA_PEMILIK) ?></span></td>
            <td <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_NAMA_PEMILIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PEMILIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<?= $Page->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_JENIS_KELAMIN"><?= $Page->renderSort($Page->JENIS_KELAMIN) ?></span></td>
            <td <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_JENIS_KELAMIN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->JENIS_KELAMIN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->NO_HP->Visible) { // NO_HP ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_NO_HP"><?= $Page->renderSort($Page->NO_HP) ?></span></td>
            <td <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_NO_HP">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_HP->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<?= $Page->NO_HP->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_ALAMAT"><?= $Page->renderSort($Page->ALAMAT) ?></span></td>
            <td <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_ALAMAT">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_KAPANEWON"><?= $Page->renderSort($Page->KAPANEWON) ?></span></td>
            <td <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_KAPANEWON">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAPANEWON->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri_KALURAHAN"><?= $Page->renderSort($Page->KALURAHAN) ?></span></td>
            <td <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri_KALURAHAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KALURAHAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datadiri__EMAIL"><?= $Page->renderSort($Page->_EMAIL) ?></span></td>
            <td <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
</span>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datadiri__EMAIL">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->_EMAIL->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_umkm_datadiri__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<?= $Page->_EMAIL->getViewValue() ?></span>
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
    ew.addEventHandlers("umkm_datadiri");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
