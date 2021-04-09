<?php

namespace PHPMaker2021\umkm_sidakui;

// Set up and run Grid object
$Grid = Container("UmkmDatausahaGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_datausahagrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fumkm_datausahagrid = new ew.Form("fumkm_datausahagrid", "grid");
    fumkm_datausahagrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_datausaha")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_datausaha)
        ew.vars.tables.umkm_datausaha = currentTable;
    fumkm_datausahagrid.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["NAMA_USAHA", [fields.NAMA_USAHA.visible && fields.NAMA_USAHA.required ? ew.Validators.required(fields.NAMA_USAHA.caption) : null], fields.NAMA_USAHA.isInvalid],
        ["TAHUN_MULAI_USAHA", [fields.TAHUN_MULAI_USAHA.visible && fields.TAHUN_MULAI_USAHA.required ? ew.Validators.required(fields.TAHUN_MULAI_USAHA.caption) : null], fields.TAHUN_MULAI_USAHA.isInvalid],
        ["NO_IZIN_USAHA", [fields.NO_IZIN_USAHA.visible && fields.NO_IZIN_USAHA.required ? ew.Validators.required(fields.NO_IZIN_USAHA.caption) : null], fields.NO_IZIN_USAHA.isInvalid],
        ["SEKTOR", [fields.SEKTOR.visible && fields.SEKTOR.required ? ew.Validators.required(fields.SEKTOR.caption) : null], fields.SEKTOR.isInvalid],
        ["SEKTOR_PERGUB", [fields.SEKTOR_PERGUB.visible && fields.SEKTOR_PERGUB.required ? ew.Validators.required(fields.SEKTOR_PERGUB.caption) : null], fields.SEKTOR_PERGUB.isInvalid],
        ["SEKTOR_KBLI", [fields.SEKTOR_KBLI.visible && fields.SEKTOR_KBLI.required ? ew.Validators.required(fields.SEKTOR_KBLI.caption) : null], fields.SEKTOR_KBLI.isInvalid],
        ["SEKTOR_EKRAF", [fields.SEKTOR_EKRAF.visible && fields.SEKTOR_EKRAF.required ? ew.Validators.required(fields.SEKTOR_EKRAF.caption) : null], fields.SEKTOR_EKRAF.isInvalid],
        ["KAPANEWON", [fields.KAPANEWON.visible && fields.KAPANEWON.required ? ew.Validators.required(fields.KAPANEWON.caption) : null], fields.KAPANEWON.isInvalid],
        ["KALURAHAN", [fields.KALURAHAN.visible && fields.KALURAHAN.required ? ew.Validators.required(fields.KALURAHAN.caption) : null], fields.KALURAHAN.isInvalid],
        ["DUSUN", [fields.DUSUN.visible && fields.DUSUN.required ? ew.Validators.required(fields.DUSUN.caption) : null], fields.DUSUN.isInvalid],
        ["ALAMAT", [fields.ALAMAT.visible && fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["TENAGA_KERJA_LAKILAKI", [fields.TENAGA_KERJA_LAKILAKI.visible && fields.TENAGA_KERJA_LAKILAKI.required ? ew.Validators.required(fields.TENAGA_KERJA_LAKILAKI.caption) : null, ew.Validators.integer], fields.TENAGA_KERJA_LAKILAKI.isInvalid],
        ["TENAGA_KERJA_PEREMPUAN", [fields.TENAGA_KERJA_PEREMPUAN.visible && fields.TENAGA_KERJA_PEREMPUAN.required ? ew.Validators.required(fields.TENAGA_KERJA_PEREMPUAN.caption) : null, ew.Validators.integer], fields.TENAGA_KERJA_PEREMPUAN.isInvalid],
        ["MODAL_KERJA", [fields.MODAL_KERJA.visible && fields.MODAL_KERJA.required ? ew.Validators.required(fields.MODAL_KERJA.caption) : null, ew.Validators.float], fields.MODAL_KERJA.isInvalid],
        ["OMZET_RATARATA_PERTAHUN", [fields.OMZET_RATARATA_PERTAHUN.visible && fields.OMZET_RATARATA_PERTAHUN.required ? ew.Validators.required(fields.OMZET_RATARATA_PERTAHUN.caption) : null, ew.Validators.float], fields.OMZET_RATARATA_PERTAHUN.isInvalid],
        ["STATUS_USAHA", [fields.STATUS_USAHA.visible && fields.STATUS_USAHA.required ? ew.Validators.required(fields.STATUS_USAHA.caption) : null], fields.STATUS_USAHA.isInvalid],
        ["ASET", [fields.ASET.visible && fields.ASET.required ? ew.Validators.required(fields.ASET.caption) : null, ew.Validators.float], fields.ASET.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_datausahagrid,
            fobj = f.getForm(),
            $fobj = $(fobj),
            $k = $fobj.find("#" + f.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            f.setInvalid(rowIndex);
        }
    });

    // Validate form
    fumkm_datausahagrid.validate = function () {
        if (!this.validateRequired)
            return true; // Ignore validation
        var fobj = this.getForm(),
            $fobj = $(fobj);
        if ($fobj.find("#confirm").val() == "confirm")
            return true;
        var addcnt = 0,
            $k = $fobj.find("#" + this.formKeyCountName), // Get key_count
            rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1,
            startcnt = (rowcnt == 0) ? 0 : 1, // Check rowcnt == 0 => Inline-Add
            gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
        for (var i = startcnt; i <= rowcnt; i++) {
            var rowIndex = ($k[0]) ? String(i) : "";
            $fobj.data("rowindex", rowIndex);
            var checkrow = (gridinsert) ? !this.emptyRow(rowIndex) : true;
            if (checkrow) {
                addcnt++;

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
            } // End Grid Add checking
        }
        return true;
    }

    // Check empty row
    fumkm_datausahagrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "NAMA_USAHA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TAHUN_MULAI_USAHA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "NO_IZIN_USAHA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "SEKTOR", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "SEKTOR_PERGUB", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "SEKTOR_KBLI", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "SEKTOR_EKRAF", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KAPANEWON", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KALURAHAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "DUSUN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ALAMAT", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TENAGA_KERJA_LAKILAKI", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "TENAGA_KERJA_PEREMPUAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "MODAL_KERJA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "OMZET_RATARATA_PERTAHUN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "STATUS_USAHA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "ASET", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fumkm_datausahagrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_datausahagrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_datausahagrid.lists.SEKTOR_PERGUB = <?= $Grid->SEKTOR_PERGUB->toClientList($Grid) ?>;
    fumkm_datausahagrid.lists.SEKTOR_KBLI = <?= $Grid->SEKTOR_KBLI->toClientList($Grid) ?>;
    fumkm_datausahagrid.lists.SEKTOR_EKRAF = <?= $Grid->SEKTOR_EKRAF->toClientList($Grid) ?>;
    fumkm_datausahagrid.lists.KAPANEWON = <?= $Grid->KAPANEWON->toClientList($Grid) ?>;
    fumkm_datausahagrid.lists.KALURAHAN = <?= $Grid->KALURAHAN->toClientList($Grid) ?>;
    loadjs.done("fumkm_datausahagrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_datausaha">
<div id="fumkm_datausahagrid" class="ew-form ew-list-form form-inline">
<div id="gmp_umkm_datausaha" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_umkm_datausahagrid" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Grid->RowType = ROWTYPE_HEADER;

// Render list options
$Grid->renderListOptions();

// Render list options (header, left)
$Grid->ListOptions->render("header", "left");
?>
<?php if ($Grid->NIK->Visible) { // NIK ?>
        <th data-name="NIK" class="<?= $Grid->NIK->headerCellClass() ?>"><div id="elh_umkm_datausaha_NIK" class="umkm_datausaha_NIK"><?= $Grid->renderSort($Grid->NIK) ?></div></th>
<?php } ?>
<?php if ($Grid->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <th data-name="NAMA_USAHA" class="<?= $Grid->NAMA_USAHA->headerCellClass() ?>"><div id="elh_umkm_datausaha_NAMA_USAHA" class="umkm_datausaha_NAMA_USAHA"><?= $Grid->renderSort($Grid->NAMA_USAHA) ?></div></th>
<?php } ?>
<?php if ($Grid->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <th data-name="TAHUN_MULAI_USAHA" class="<?= $Grid->TAHUN_MULAI_USAHA->headerCellClass() ?>"><div id="elh_umkm_datausaha_TAHUN_MULAI_USAHA" class="umkm_datausaha_TAHUN_MULAI_USAHA"><?= $Grid->renderSort($Grid->TAHUN_MULAI_USAHA) ?></div></th>
<?php } ?>
<?php if ($Grid->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <th data-name="NO_IZIN_USAHA" class="<?= $Grid->NO_IZIN_USAHA->headerCellClass() ?>"><div id="elh_umkm_datausaha_NO_IZIN_USAHA" class="umkm_datausaha_NO_IZIN_USAHA"><?= $Grid->renderSort($Grid->NO_IZIN_USAHA) ?></div></th>
<?php } ?>
<?php if ($Grid->SEKTOR->Visible) { // SEKTOR ?>
        <th data-name="SEKTOR" class="<?= $Grid->SEKTOR->headerCellClass() ?>"><div id="elh_umkm_datausaha_SEKTOR" class="umkm_datausaha_SEKTOR"><?= $Grid->renderSort($Grid->SEKTOR) ?></div></th>
<?php } ?>
<?php if ($Grid->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <th data-name="SEKTOR_PERGUB" class="<?= $Grid->SEKTOR_PERGUB->headerCellClass() ?>"><div id="elh_umkm_datausaha_SEKTOR_PERGUB" class="umkm_datausaha_SEKTOR_PERGUB"><?= $Grid->renderSort($Grid->SEKTOR_PERGUB) ?></div></th>
<?php } ?>
<?php if ($Grid->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <th data-name="SEKTOR_KBLI" class="<?= $Grid->SEKTOR_KBLI->headerCellClass() ?>"><div id="elh_umkm_datausaha_SEKTOR_KBLI" class="umkm_datausaha_SEKTOR_KBLI"><?= $Grid->renderSort($Grid->SEKTOR_KBLI) ?></div></th>
<?php } ?>
<?php if ($Grid->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <th data-name="SEKTOR_EKRAF" class="<?= $Grid->SEKTOR_EKRAF->headerCellClass() ?>"><div id="elh_umkm_datausaha_SEKTOR_EKRAF" class="umkm_datausaha_SEKTOR_EKRAF"><?= $Grid->renderSort($Grid->SEKTOR_EKRAF) ?></div></th>
<?php } ?>
<?php if ($Grid->KAPANEWON->Visible) { // KAPANEWON ?>
        <th data-name="KAPANEWON" class="<?= $Grid->KAPANEWON->headerCellClass() ?>"><div id="elh_umkm_datausaha_KAPANEWON" class="umkm_datausaha_KAPANEWON"><?= $Grid->renderSort($Grid->KAPANEWON) ?></div></th>
<?php } ?>
<?php if ($Grid->KALURAHAN->Visible) { // KALURAHAN ?>
        <th data-name="KALURAHAN" class="<?= $Grid->KALURAHAN->headerCellClass() ?>"><div id="elh_umkm_datausaha_KALURAHAN" class="umkm_datausaha_KALURAHAN"><?= $Grid->renderSort($Grid->KALURAHAN) ?></div></th>
<?php } ?>
<?php if ($Grid->DUSUN->Visible) { // DUSUN ?>
        <th data-name="DUSUN" class="<?= $Grid->DUSUN->headerCellClass() ?>"><div id="elh_umkm_datausaha_DUSUN" class="umkm_datausaha_DUSUN"><?= $Grid->renderSort($Grid->DUSUN) ?></div></th>
<?php } ?>
<?php if ($Grid->ALAMAT->Visible) { // ALAMAT ?>
        <th data-name="ALAMAT" class="<?= $Grid->ALAMAT->headerCellClass() ?>"><div id="elh_umkm_datausaha_ALAMAT" class="umkm_datausaha_ALAMAT"><?= $Grid->renderSort($Grid->ALAMAT) ?></div></th>
<?php } ?>
<?php if ($Grid->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <th data-name="TENAGA_KERJA_LAKILAKI" class="<?= $Grid->TENAGA_KERJA_LAKILAKI->headerCellClass() ?>"><div id="elh_umkm_datausaha_TENAGA_KERJA_LAKILAKI" class="umkm_datausaha_TENAGA_KERJA_LAKILAKI"><?= $Grid->renderSort($Grid->TENAGA_KERJA_LAKILAKI) ?></div></th>
<?php } ?>
<?php if ($Grid->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <th data-name="TENAGA_KERJA_PEREMPUAN" class="<?= $Grid->TENAGA_KERJA_PEREMPUAN->headerCellClass() ?>"><div id="elh_umkm_datausaha_TENAGA_KERJA_PEREMPUAN" class="umkm_datausaha_TENAGA_KERJA_PEREMPUAN"><?= $Grid->renderSort($Grid->TENAGA_KERJA_PEREMPUAN) ?></div></th>
<?php } ?>
<?php if ($Grid->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <th data-name="MODAL_KERJA" class="<?= $Grid->MODAL_KERJA->headerCellClass() ?>"><div id="elh_umkm_datausaha_MODAL_KERJA" class="umkm_datausaha_MODAL_KERJA"><?= $Grid->renderSort($Grid->MODAL_KERJA) ?></div></th>
<?php } ?>
<?php if ($Grid->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <th data-name="OMZET_RATARATA_PERTAHUN" class="<?= $Grid->OMZET_RATARATA_PERTAHUN->headerCellClass() ?>"><div id="elh_umkm_datausaha_OMZET_RATARATA_PERTAHUN" class="umkm_datausaha_OMZET_RATARATA_PERTAHUN"><?= $Grid->renderSort($Grid->OMZET_RATARATA_PERTAHUN) ?></div></th>
<?php } ?>
<?php if ($Grid->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <th data-name="STATUS_USAHA" class="<?= $Grid->STATUS_USAHA->headerCellClass() ?>"><div id="elh_umkm_datausaha_STATUS_USAHA" class="umkm_datausaha_STATUS_USAHA"><?= $Grid->renderSort($Grid->STATUS_USAHA) ?></div></th>
<?php } ?>
<?php if ($Grid->ASET->Visible) { // ASET ?>
        <th data-name="ASET" class="<?= $Grid->ASET->headerCellClass() ?>"><div id="elh_umkm_datausaha_ASET" class="umkm_datausaha_ASET"><?= $Grid->renderSort($Grid->ASET) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Grid->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
<?php
$Grid->StartRecord = 1;
$Grid->StopRecord = $Grid->TotalRecords; // Show all records

// Restore number of post back records
if ($CurrentForm && ($Grid->isConfirm() || $Grid->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Grid->FormKeyCountName) && ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm())) {
        $Grid->KeyCount = $CurrentForm->getValue($Grid->FormKeyCountName);
        $Grid->StopRecord = $Grid->StartRecord + $Grid->KeyCount - 1;
    }
}
$Grid->RecordCount = $Grid->StartRecord - 1;
if ($Grid->Recordset && !$Grid->Recordset->EOF) {
    // Nothing to do
} elseif (!$Grid->AllowAddDeleteRow && $Grid->StopRecord == 0) {
    $Grid->StopRecord = $Grid->GridAddRowCount;
}

// Initialize aggregate
$Grid->RowType = ROWTYPE_AGGREGATEINIT;
$Grid->resetAttributes();
$Grid->renderRow();
if ($Grid->isGridAdd())
    $Grid->RowIndex = 0;
if ($Grid->isGridEdit())
    $Grid->RowIndex = 0;
while ($Grid->RecordCount < $Grid->StopRecord) {
    $Grid->RecordCount++;
    if ($Grid->RecordCount >= $Grid->StartRecord) {
        $Grid->RowCount++;
        if ($Grid->isGridAdd() || $Grid->isGridEdit() || $Grid->isConfirm()) {
            $Grid->RowIndex++;
            $CurrentForm->Index = $Grid->RowIndex;
            if ($CurrentForm->hasValue($Grid->FormActionName) && ($Grid->isConfirm() || $Grid->EventCancelled)) {
                $Grid->RowAction = strval($CurrentForm->getValue($Grid->FormActionName));
            } elseif ($Grid->isGridAdd()) {
                $Grid->RowAction = "insert";
            } else {
                $Grid->RowAction = "";
            }
        }

        // Set up key count
        $Grid->KeyCount = $Grid->RowIndex;

        // Init row class and style
        $Grid->resetAttributes();
        $Grid->CssClass = "";
        if ($Grid->isGridAdd()) {
            if ($Grid->CurrentMode == "copy") {
                $Grid->loadRowValues($Grid->Recordset); // Load row values
                $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
            } else {
                $Grid->loadRowValues(); // Load default values
                $Grid->OldKey = "";
            }
        } else {
            $Grid->loadRowValues($Grid->Recordset); // Load row values
            $Grid->OldKey = $Grid->getKey(true); // Get from CurrentValue
        }
        $Grid->setKey($Grid->OldKey);
        $Grid->RowType = ROWTYPE_VIEW; // Render view
        if ($Grid->isGridAdd()) { // Grid add
            $Grid->RowType = ROWTYPE_ADD; // Render add
        }
        if ($Grid->isGridAdd() && $Grid->EventCancelled && !$CurrentForm->hasValue("k_blankrow")) { // Insert failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->isGridEdit()) { // Grid edit
            if ($Grid->EventCancelled) {
                $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
            }
            if ($Grid->RowAction == "insert") {
                $Grid->RowType = ROWTYPE_ADD; // Render add
            } else {
                $Grid->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Grid->isGridEdit() && ($Grid->RowType == ROWTYPE_EDIT || $Grid->RowType == ROWTYPE_ADD) && $Grid->EventCancelled) { // Update failed
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }
        if ($Grid->RowType == ROWTYPE_EDIT) { // Edit row
            $Grid->EditRowCount++;
        }
        if ($Grid->isConfirm()) { // Confirm row
            $Grid->restoreCurrentRowFormValues($Grid->RowIndex); // Restore form values
        }

        // Set up row id / data-rowindex
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_umkm_datausaha", "data-rowtype" => $Grid->RowType]);

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();

        // Skip delete row / empty row for confirm page
        if ($Grid->RowAction != "delete" && $Grid->RowAction != "insertdelete" && !($Grid->RowAction == "insert" && $Grid->isConfirm() && $Grid->emptyRow())) {
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowCount);
?>
    <?php if ($Grid->NIK->Visible) { // NIK ?>
        <td data-name="NIK" <?= $Grid->NIK->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NIK" id="o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NIK">
<span<?= $Grid->NIK->viewAttributes() ?>>
<?= $Grid->NIK->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NIK" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NIK" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NIK" id="x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <td data-name="NAMA_USAHA" <?= $Grid->NAMA_USAHA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Grid->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x<?= $Grid->RowIndex ?>_NAMA_USAHA" id="x<?= $Grid->RowIndex ?>_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NAMA_USAHA->EditValue ?>"<?= $Grid->NAMA_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NAMA_USAHA->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NAMA_USAHA" id="o<?= $Grid->RowIndex ?>_NAMA_USAHA" value="<?= HtmlEncode($Grid->NAMA_USAHA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Grid->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x<?= $Grid->RowIndex ?>_NAMA_USAHA" id="x<?= $Grid->RowIndex ?>_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NAMA_USAHA->EditValue ?>"<?= $Grid->NAMA_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NAMA_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<span<?= $Grid->NAMA_USAHA->viewAttributes() ?>>
<?= $Grid->NAMA_USAHA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NAMA_USAHA" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NAMA_USAHA" value="<?= HtmlEncode($Grid->NAMA_USAHA->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NAMA_USAHA" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NAMA_USAHA" value="<?= HtmlEncode($Grid->NAMA_USAHA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <td data-name="TAHUN_MULAI_USAHA" <?= $Grid->TAHUN_MULAI_USAHA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Grid->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Grid->TAHUN_MULAI_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" value="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Grid->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Grid->TAHUN_MULAI_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<span<?= $Grid->TAHUN_MULAI_USAHA->viewAttributes() ?>>
<?= $Grid->TAHUN_MULAI_USAHA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" value="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" value="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <td data-name="NO_IZIN_USAHA" <?= $Grid->NO_IZIN_USAHA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Grid->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NO_IZIN_USAHA->EditValue ?>"<?= $Grid->NO_IZIN_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" value="<?= HtmlEncode($Grid->NO_IZIN_USAHA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Grid->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NO_IZIN_USAHA->EditValue ?>"<?= $Grid->NO_IZIN_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<span<?= $Grid->NO_IZIN_USAHA->viewAttributes() ?>>
<?= $Grid->NO_IZIN_USAHA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" value="<?= HtmlEncode($Grid->NO_IZIN_USAHA->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" value="<?= HtmlEncode($Grid->NO_IZIN_USAHA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR->Visible) { // SEKTOR ?>
        <td data-name="SEKTOR" <?= $Grid->SEKTOR->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR">
<input type="<?= $Grid->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x<?= $Grid->RowIndex ?>_SEKTOR" id="x<?= $Grid->RowIndex ?>_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->SEKTOR->getPlaceHolder()) ?>" value="<?= $Grid->SEKTOR->EditValue ?>"<?= $Grid->SEKTOR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->SEKTOR->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR" id="o<?= $Grid->RowIndex ?>_SEKTOR" value="<?= HtmlEncode($Grid->SEKTOR->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR">
<input type="<?= $Grid->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x<?= $Grid->RowIndex ?>_SEKTOR" id="x<?= $Grid->RowIndex ?>_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->SEKTOR->getPlaceHolder()) ?>" value="<?= $Grid->SEKTOR->EditValue ?>"<?= $Grid->SEKTOR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->SEKTOR->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR">
<span<?= $Grid->SEKTOR->viewAttributes() ?>>
<?= $Grid->SEKTOR->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR" value="<?= HtmlEncode($Grid->SEKTOR->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR" value="<?= HtmlEncode($Grid->SEKTOR->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <td data-name="SEKTOR_PERGUB" <?= $Grid->SEKTOR_PERGUB->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Grid->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Grid->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Grid->SEKTOR_PERGUB->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_PERGUB") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_PERGUB->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_PERGUB" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" id="o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" value="<?= HtmlEncode($Grid->SEKTOR_PERGUB->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Grid->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Grid->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Grid->SEKTOR_PERGUB->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_PERGUB") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_PERGUB->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
<span<?= $Grid->SEKTOR_PERGUB->viewAttributes() ?>>
<?= $Grid->SEKTOR_PERGUB->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_PERGUB" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" value="<?= HtmlEncode($Grid->SEKTOR_PERGUB->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_PERGUB" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" value="<?= HtmlEncode($Grid->SEKTOR_PERGUB->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <td data-name="SEKTOR_KBLI" <?= $Grid->SEKTOR_KBLI->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        class="form-control ew-select<?= $Grid->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Grid->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Grid->SEKTOR_KBLI->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_KBLI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_KBLI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_KBLI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" id="o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" value="<?= HtmlEncode($Grid->SEKTOR_KBLI->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        class="form-control ew-select<?= $Grid->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Grid->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Grid->SEKTOR_KBLI->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_KBLI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_KBLI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
<span<?= $Grid->SEKTOR_KBLI->viewAttributes() ?>>
<?= $Grid->SEKTOR_KBLI->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_KBLI" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_KBLI" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_KBLI" value="<?= HtmlEncode($Grid->SEKTOR_KBLI->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_KBLI" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" value="<?= HtmlEncode($Grid->SEKTOR_KBLI->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <td data-name="SEKTOR_EKRAF" <?= $Grid->SEKTOR_EKRAF->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Grid->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Grid->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Grid->SEKTOR_EKRAF->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_EKRAF") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_EKRAF->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_EKRAF" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" id="o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" value="<?= HtmlEncode($Grid->SEKTOR_EKRAF->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Grid->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Grid->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Grid->SEKTOR_EKRAF->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_EKRAF") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_EKRAF->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
<span<?= $Grid->SEKTOR_EKRAF->viewAttributes() ?>>
<?= $Grid->SEKTOR_EKRAF->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_EKRAF" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" value="<?= HtmlEncode($Grid->SEKTOR_EKRAF->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_EKRAF" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" value="<?= HtmlEncode($Grid->SEKTOR_EKRAF->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KAPANEWON->Visible) { // KAPANEWON ?>
        <td data-name="KAPANEWON" <?= $Grid->KAPANEWON->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KAPANEWON">
<?php $Grid->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_KAPANEWON"
        name="x<?= $Grid->RowIndex ?>_KAPANEWON"
        class="form-control ew-select<?= $Grid->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Grid->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Grid->KAPANEWON->editAttributes() ?>>
        <?= $Grid->KAPANEWON->selectOptionListHtml("x{$Grid->RowIndex}_KAPANEWON") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KAPANEWON->getErrorMessage() ?></div>
<?= $Grid->KAPANEWON->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KAPANEWON", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KAPANEWON" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KAPANEWON" id="o<?= $Grid->RowIndex ?>_KAPANEWON" value="<?= HtmlEncode($Grid->KAPANEWON->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KAPANEWON">
<?php $Grid->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_KAPANEWON"
        name="x<?= $Grid->RowIndex ?>_KAPANEWON"
        class="form-control ew-select<?= $Grid->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Grid->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Grid->KAPANEWON->editAttributes() ?>>
        <?= $Grid->KAPANEWON->selectOptionListHtml("x{$Grid->RowIndex}_KAPANEWON") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KAPANEWON->getErrorMessage() ?></div>
<?= $Grid->KAPANEWON->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KAPANEWON", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KAPANEWON">
<span<?= $Grid->KAPANEWON->viewAttributes() ?>>
<?= $Grid->KAPANEWON->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KAPANEWON" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_KAPANEWON" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_KAPANEWON" value="<?= HtmlEncode($Grid->KAPANEWON->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_KAPANEWON" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_KAPANEWON" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_KAPANEWON" value="<?= HtmlEncode($Grid->KAPANEWON->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KALURAHAN->Visible) { // KALURAHAN ?>
        <td data-name="KALURAHAN" <?= $Grid->KALURAHAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KALURAHAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KALURAHAN"
        name="x<?= $Grid->RowIndex ?>_KALURAHAN"
        class="form-control ew-select<?= $Grid->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Grid->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Grid->KALURAHAN->editAttributes() ?>>
        <?= $Grid->KALURAHAN->selectOptionListHtml("x{$Grid->RowIndex}_KALURAHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KALURAHAN->getErrorMessage() ?></div>
<?= $Grid->KALURAHAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KALURAHAN", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KALURAHAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KALURAHAN" id="o<?= $Grid->RowIndex ?>_KALURAHAN" value="<?= HtmlEncode($Grid->KALURAHAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KALURAHAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KALURAHAN"
        name="x<?= $Grid->RowIndex ?>_KALURAHAN"
        class="form-control ew-select<?= $Grid->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Grid->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Grid->KALURAHAN->editAttributes() ?>>
        <?= $Grid->KALURAHAN->selectOptionListHtml("x{$Grid->RowIndex}_KALURAHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KALURAHAN->getErrorMessage() ?></div>
<?= $Grid->KALURAHAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KALURAHAN", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_KALURAHAN">
<span<?= $Grid->KALURAHAN->viewAttributes() ?>>
<?= $Grid->KALURAHAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KALURAHAN" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_KALURAHAN" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_KALURAHAN" value="<?= HtmlEncode($Grid->KALURAHAN->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_KALURAHAN" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_KALURAHAN" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_KALURAHAN" value="<?= HtmlEncode($Grid->KALURAHAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->DUSUN->Visible) { // DUSUN ?>
        <td data-name="DUSUN" <?= $Grid->DUSUN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_DUSUN">
<input type="<?= $Grid->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x<?= $Grid->RowIndex ?>_DUSUN" id="x<?= $Grid->RowIndex ?>_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->DUSUN->getPlaceHolder()) ?>" value="<?= $Grid->DUSUN->EditValue ?>"<?= $Grid->DUSUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DUSUN->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_DUSUN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DUSUN" id="o<?= $Grid->RowIndex ?>_DUSUN" value="<?= HtmlEncode($Grid->DUSUN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_DUSUN">
<input type="<?= $Grid->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x<?= $Grid->RowIndex ?>_DUSUN" id="x<?= $Grid->RowIndex ?>_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->DUSUN->getPlaceHolder()) ?>" value="<?= $Grid->DUSUN->EditValue ?>"<?= $Grid->DUSUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DUSUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_DUSUN">
<span<?= $Grid->DUSUN->viewAttributes() ?>>
<?= $Grid->DUSUN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_DUSUN" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_DUSUN" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_DUSUN" value="<?= HtmlEncode($Grid->DUSUN->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_DUSUN" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_DUSUN" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_DUSUN" value="<?= HtmlEncode($Grid->DUSUN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ALAMAT->Visible) { // ALAMAT ?>
        <td data-name="ALAMAT" <?= $Grid->ALAMAT->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x<?= $Grid->RowIndex ?>_ALAMAT" id="x<?= $Grid->RowIndex ?>_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ALAMAT->getPlaceHolder()) ?>"<?= $Grid->ALAMAT->editAttributes() ?>><?= $Grid->ALAMAT->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ALAMAT->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ALAMAT" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ALAMAT" id="o<?= $Grid->RowIndex ?>_ALAMAT" value="<?= HtmlEncode($Grid->ALAMAT->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x<?= $Grid->RowIndex ?>_ALAMAT" id="x<?= $Grid->RowIndex ?>_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ALAMAT->getPlaceHolder()) ?>"<?= $Grid->ALAMAT->editAttributes() ?>><?= $Grid->ALAMAT->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ALAMAT->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ALAMAT">
<span<?= $Grid->ALAMAT->viewAttributes() ?>>
<?= $Grid->ALAMAT->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ALAMAT" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_ALAMAT" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_ALAMAT" value="<?= HtmlEncode($Grid->ALAMAT->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_ALAMAT" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_ALAMAT" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_ALAMAT" value="<?= HtmlEncode($Grid->ALAMAT->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <td data-name="TENAGA_KERJA_LAKILAKI" <?= $Grid->TENAGA_KERJA_LAKILAKI->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Grid->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Grid->TENAGA_KERJA_LAKILAKI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" value="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Grid->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Grid->TENAGA_KERJA_LAKILAKI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<span<?= $Grid->TENAGA_KERJA_LAKILAKI->viewAttributes() ?>>
<?= $Grid->TENAGA_KERJA_LAKILAKI->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" value="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" value="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <td data-name="TENAGA_KERJA_PEREMPUAN" <?= $Grid->TENAGA_KERJA_PEREMPUAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Grid->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Grid->TENAGA_KERJA_PEREMPUAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" value="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Grid->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Grid->TENAGA_KERJA_PEREMPUAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<span<?= $Grid->TENAGA_KERJA_PEREMPUAN->viewAttributes() ?>>
<?= $Grid->TENAGA_KERJA_PEREMPUAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" value="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" value="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <td data-name="MODAL_KERJA" <?= $Grid->MODAL_KERJA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Grid->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x<?= $Grid->RowIndex ?>_MODAL_KERJA" id="x<?= $Grid->RowIndex ?>_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Grid->MODAL_KERJA->EditValue ?>"<?= $Grid->MODAL_KERJA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MODAL_KERJA->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_MODAL_KERJA" id="o<?= $Grid->RowIndex ?>_MODAL_KERJA" value="<?= HtmlEncode($Grid->MODAL_KERJA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Grid->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x<?= $Grid->RowIndex ?>_MODAL_KERJA" id="x<?= $Grid->RowIndex ?>_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Grid->MODAL_KERJA->EditValue ?>"<?= $Grid->MODAL_KERJA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MODAL_KERJA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<span<?= $Grid->MODAL_KERJA->viewAttributes() ?>>
<?= $Grid->MODAL_KERJA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_MODAL_KERJA" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_MODAL_KERJA" value="<?= HtmlEncode($Grid->MODAL_KERJA->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_MODAL_KERJA" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_MODAL_KERJA" value="<?= HtmlEncode($Grid->MODAL_KERJA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <td data-name="OMZET_RATARATA_PERTAHUN" <?= $Grid->OMZET_RATARATA_PERTAHUN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Grid->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Grid->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Grid->OMZET_RATARATA_PERTAHUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" value="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Grid->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Grid->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Grid->OMZET_RATARATA_PERTAHUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<span<?= $Grid->OMZET_RATARATA_PERTAHUN->viewAttributes() ?>>
<?= $Grid->OMZET_RATARATA_PERTAHUN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" value="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" value="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <td data-name="STATUS_USAHA" <?= $Grid->STATUS_USAHA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Grid->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x<?= $Grid->RowIndex ?>_STATUS_USAHA" id="x<?= $Grid->RowIndex ?>_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->STATUS_USAHA->EditValue ?>"<?= $Grid->STATUS_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->STATUS_USAHA->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_STATUS_USAHA" id="o<?= $Grid->RowIndex ?>_STATUS_USAHA" value="<?= HtmlEncode($Grid->STATUS_USAHA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Grid->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x<?= $Grid->RowIndex ?>_STATUS_USAHA" id="x<?= $Grid->RowIndex ?>_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->STATUS_USAHA->EditValue ?>"<?= $Grid->STATUS_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->STATUS_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<span<?= $Grid->STATUS_USAHA->viewAttributes() ?>>
<?= $Grid->STATUS_USAHA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_STATUS_USAHA" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_STATUS_USAHA" value="<?= HtmlEncode($Grid->STATUS_USAHA->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_STATUS_USAHA" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_STATUS_USAHA" value="<?= HtmlEncode($Grid->STATUS_USAHA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->ASET->Visible) { // ASET ?>
        <td data-name="ASET" <?= $Grid->ASET->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ASET">
<input type="<?= $Grid->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x<?= $Grid->RowIndex ?>_ASET" id="x<?= $Grid->RowIndex ?>_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->ASET->getPlaceHolder()) ?>" value="<?= $Grid->ASET->EditValue ?>"<?= $Grid->ASET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ASET->getErrorMessage() ?></div>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ASET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ASET" id="o<?= $Grid->RowIndex ?>_ASET" value="<?= HtmlEncode($Grid->ASET->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ASET">
<input type="<?= $Grid->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x<?= $Grid->RowIndex ?>_ASET" id="x<?= $Grid->RowIndex ?>_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->ASET->getPlaceHolder()) ?>" value="<?= $Grid->ASET->EditValue ?>"<?= $Grid->ASET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ASET->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_datausaha_ASET">
<span<?= $Grid->ASET->viewAttributes() ?>>
<?= $Grid->ASET->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ASET" data-hidden="1" name="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_ASET" id="fumkm_datausahagrid$x<?= $Grid->RowIndex ?>_ASET" value="<?= HtmlEncode($Grid->ASET->FormValue) ?>">
<input type="hidden" data-table="umkm_datausaha" data-field="x_ASET" data-hidden="1" name="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_ASET" id="fumkm_datausahagrid$o<?= $Grid->RowIndex ?>_ASET" value="<?= HtmlEncode($Grid->ASET->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowCount);
?>
    </tr>
<?php if ($Grid->RowType == ROWTYPE_ADD || $Grid->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fumkm_datausahagrid","load"], function () {
    fumkm_datausahagrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    } // End delete row checking
    if (!$Grid->isGridAdd() || $Grid->CurrentMode == "copy")
        if (!$Grid->Recordset->EOF) {
            $Grid->Recordset->moveNext();
        }
}
?>
<?php
    if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy" || $Grid->CurrentMode == "edit") {
        $Grid->RowIndex = '$rowindex$';
        $Grid->loadRowValues();

        // Set row properties
        $Grid->resetAttributes();
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_umkm_datausaha", "data-rowtype" => ROWTYPE_ADD]);
        $Grid->RowAttrs->appendClass("ew-template");
        $Grid->RowType = ROWTYPE_ADD;

        // Render row
        $Grid->renderRow();

        // Render list options
        $Grid->renderListOptions();
        $Grid->StartRowCount = 0;
?>
    <tr <?= $Grid->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Grid->ListOptions->render("body", "left", $Grid->RowIndex);
?>
    <?php if ($Grid->NIK->Visible) { // NIK ?>
        <td data-name="NIK">
<?php if (!$Grid->isConfirm()) { ?>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_NIK">
<span<?= $Grid->NIK->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NIK->getDisplayValue($Grid->NIK->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NIK" id="x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NIK" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NIK" id="o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <td data-name="NAMA_USAHA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Grid->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x<?= $Grid->RowIndex ?>_NAMA_USAHA" id="x<?= $Grid->RowIndex ?>_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NAMA_USAHA->EditValue ?>"<?= $Grid->NAMA_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NAMA_USAHA->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_NAMA_USAHA">
<span<?= $Grid->NAMA_USAHA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NAMA_USAHA->getDisplayValue($Grid->NAMA_USAHA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NAMA_USAHA" id="x<?= $Grid->RowIndex ?>_NAMA_USAHA" value="<?= HtmlEncode($Grid->NAMA_USAHA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NAMA_USAHA" id="o<?= $Grid->RowIndex ?>_NAMA_USAHA" value="<?= HtmlEncode($Grid->NAMA_USAHA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <td data-name="TAHUN_MULAI_USAHA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Grid->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Grid->TAHUN_MULAI_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_TAHUN_MULAI_USAHA">
<span<?= $Grid->TAHUN_MULAI_USAHA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TAHUN_MULAI_USAHA->getDisplayValue($Grid->TAHUN_MULAI_USAHA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" value="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" id="o<?= $Grid->RowIndex ?>_TAHUN_MULAI_USAHA" value="<?= HtmlEncode($Grid->TAHUN_MULAI_USAHA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <td data-name="NO_IZIN_USAHA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Grid->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Grid->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->NO_IZIN_USAHA->EditValue ?>"<?= $Grid->NO_IZIN_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_NO_IZIN_USAHA">
<span<?= $Grid->NO_IZIN_USAHA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NO_IZIN_USAHA->getDisplayValue($Grid->NO_IZIN_USAHA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" value="<?= HtmlEncode($Grid->NO_IZIN_USAHA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" id="o<?= $Grid->RowIndex ?>_NO_IZIN_USAHA" value="<?= HtmlEncode($Grid->NO_IZIN_USAHA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR->Visible) { // SEKTOR ?>
        <td data-name="SEKTOR">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR">
<input type="<?= $Grid->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x<?= $Grid->RowIndex ?>_SEKTOR" id="x<?= $Grid->RowIndex ?>_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->SEKTOR->getPlaceHolder()) ?>" value="<?= $Grid->SEKTOR->EditValue ?>"<?= $Grid->SEKTOR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->SEKTOR->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR">
<span<?= $Grid->SEKTOR->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->SEKTOR->getDisplayValue($Grid->SEKTOR->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR" data-hidden="1" name="x<?= $Grid->RowIndex ?>_SEKTOR" id="x<?= $Grid->RowIndex ?>_SEKTOR" value="<?= HtmlEncode($Grid->SEKTOR->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR" id="o<?= $Grid->RowIndex ?>_SEKTOR" value="<?= HtmlEncode($Grid->SEKTOR->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <td data-name="SEKTOR_PERGUB">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Grid->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Grid->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Grid->SEKTOR_PERGUB->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_PERGUB") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_PERGUB->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_PERGUB">
<span<?= $Grid->SEKTOR_PERGUB->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->SEKTOR_PERGUB->getDisplayValue($Grid->SEKTOR_PERGUB->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_PERGUB" data-hidden="1" name="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" id="x<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" value="<?= HtmlEncode($Grid->SEKTOR_PERGUB->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_PERGUB" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" id="o<?= $Grid->RowIndex ?>_SEKTOR_PERGUB" value="<?= HtmlEncode($Grid->SEKTOR_PERGUB->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <td data-name="SEKTOR_KBLI">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        class="form-control ew-select<?= $Grid->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Grid->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Grid->SEKTOR_KBLI->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_KBLI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_KBLI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_KBLI">
<span<?= $Grid->SEKTOR_KBLI->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->SEKTOR_KBLI->getDisplayValue($Grid->SEKTOR_KBLI->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_KBLI" data-hidden="1" name="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI" id="x<?= $Grid->RowIndex ?>_SEKTOR_KBLI" value="<?= HtmlEncode($Grid->SEKTOR_KBLI->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_KBLI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" id="o<?= $Grid->RowIndex ?>_SEKTOR_KBLI" value="<?= HtmlEncode($Grid->SEKTOR_KBLI->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <td data-name="SEKTOR_EKRAF">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        name="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Grid->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Grid->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Grid->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Grid->SEKTOR_EKRAF->selectOptionListHtml("x{$Grid->RowIndex}_SEKTOR_EKRAF") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Grid->SEKTOR_EKRAF->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF']"),
        options = { name: "x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_SEKTOR_EKRAF">
<span<?= $Grid->SEKTOR_EKRAF->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->SEKTOR_EKRAF->getDisplayValue($Grid->SEKTOR_EKRAF->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_EKRAF" data-hidden="1" name="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" id="x<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" value="<?= HtmlEncode($Grid->SEKTOR_EKRAF->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_SEKTOR_EKRAF" data-hidden="1" name="o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" id="o<?= $Grid->RowIndex ?>_SEKTOR_EKRAF" value="<?= HtmlEncode($Grid->SEKTOR_EKRAF->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KAPANEWON->Visible) { // KAPANEWON ?>
        <td data-name="KAPANEWON">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_KAPANEWON">
<?php $Grid->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Grid->RowIndex ?>_KAPANEWON"
        name="x<?= $Grid->RowIndex ?>_KAPANEWON"
        class="form-control ew-select<?= $Grid->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Grid->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Grid->KAPANEWON->editAttributes() ?>>
        <?= $Grid->KAPANEWON->selectOptionListHtml("x{$Grid->RowIndex}_KAPANEWON") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KAPANEWON->getErrorMessage() ?></div>
<?= $Grid->KAPANEWON->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KAPANEWON", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_KAPANEWON">
<span<?= $Grid->KAPANEWON->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KAPANEWON->getDisplayValue($Grid->KAPANEWON->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KAPANEWON" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KAPANEWON" id="x<?= $Grid->RowIndex ?>_KAPANEWON" value="<?= HtmlEncode($Grid->KAPANEWON->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KAPANEWON" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KAPANEWON" id="o<?= $Grid->RowIndex ?>_KAPANEWON" value="<?= HtmlEncode($Grid->KAPANEWON->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KALURAHAN->Visible) { // KALURAHAN ?>
        <td data-name="KALURAHAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_KALURAHAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KALURAHAN"
        name="x<?= $Grid->RowIndex ?>_KALURAHAN"
        class="form-control ew-select<?= $Grid->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Grid->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Grid->KALURAHAN->editAttributes() ?>>
        <?= $Grid->KALURAHAN->selectOptionListHtml("x{$Grid->RowIndex}_KALURAHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KALURAHAN->getErrorMessage() ?></div>
<?= $Grid->KALURAHAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KALURAHAN", selectId: "umkm_datausaha_x<?= $Grid->RowIndex ?>_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_KALURAHAN">
<span<?= $Grid->KALURAHAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KALURAHAN->getDisplayValue($Grid->KALURAHAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KALURAHAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KALURAHAN" id="x<?= $Grid->RowIndex ?>_KALURAHAN" value="<?= HtmlEncode($Grid->KALURAHAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_KALURAHAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KALURAHAN" id="o<?= $Grid->RowIndex ?>_KALURAHAN" value="<?= HtmlEncode($Grid->KALURAHAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->DUSUN->Visible) { // DUSUN ?>
        <td data-name="DUSUN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_DUSUN">
<input type="<?= $Grid->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x<?= $Grid->RowIndex ?>_DUSUN" id="x<?= $Grid->RowIndex ?>_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->DUSUN->getPlaceHolder()) ?>" value="<?= $Grid->DUSUN->EditValue ?>"<?= $Grid->DUSUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->DUSUN->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_DUSUN">
<span<?= $Grid->DUSUN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->DUSUN->getDisplayValue($Grid->DUSUN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_DUSUN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_DUSUN" id="x<?= $Grid->RowIndex ?>_DUSUN" value="<?= HtmlEncode($Grid->DUSUN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_DUSUN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_DUSUN" id="o<?= $Grid->RowIndex ?>_DUSUN" value="<?= HtmlEncode($Grid->DUSUN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ALAMAT->Visible) { // ALAMAT ?>
        <td data-name="ALAMAT">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x<?= $Grid->RowIndex ?>_ALAMAT" id="x<?= $Grid->RowIndex ?>_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Grid->ALAMAT->getPlaceHolder()) ?>"<?= $Grid->ALAMAT->editAttributes() ?>><?= $Grid->ALAMAT->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Grid->ALAMAT->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_ALAMAT">
<span<?= $Grid->ALAMAT->viewAttributes() ?>>
<?= $Grid->ALAMAT->ViewValue ?></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ALAMAT" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ALAMAT" id="x<?= $Grid->RowIndex ?>_ALAMAT" value="<?= HtmlEncode($Grid->ALAMAT->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ALAMAT" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ALAMAT" id="o<?= $Grid->RowIndex ?>_ALAMAT" value="<?= HtmlEncode($Grid->ALAMAT->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <td data-name="TENAGA_KERJA_LAKILAKI">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Grid->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Grid->TENAGA_KERJA_LAKILAKI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<span<?= $Grid->TENAGA_KERJA_LAKILAKI->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TENAGA_KERJA_LAKILAKI->getDisplayValue($Grid->TENAGA_KERJA_LAKILAKI->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" value="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_LAKILAKI" value="<?= HtmlEncode($Grid->TENAGA_KERJA_LAKILAKI->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <td data-name="TENAGA_KERJA_PEREMPUAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Grid->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Grid->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Grid->TENAGA_KERJA_PEREMPUAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<span<?= $Grid->TENAGA_KERJA_PEREMPUAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->TENAGA_KERJA_PEREMPUAN->getDisplayValue($Grid->TENAGA_KERJA_PEREMPUAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" value="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="o<?= $Grid->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" value="<?= HtmlEncode($Grid->TENAGA_KERJA_PEREMPUAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <td data-name="MODAL_KERJA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Grid->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x<?= $Grid->RowIndex ?>_MODAL_KERJA" id="x<?= $Grid->RowIndex ?>_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Grid->MODAL_KERJA->EditValue ?>"<?= $Grid->MODAL_KERJA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->MODAL_KERJA->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_MODAL_KERJA">
<span<?= $Grid->MODAL_KERJA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->MODAL_KERJA->getDisplayValue($Grid->MODAL_KERJA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_MODAL_KERJA" id="x<?= $Grid->RowIndex ?>_MODAL_KERJA" value="<?= HtmlEncode($Grid->MODAL_KERJA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_MODAL_KERJA" id="o<?= $Grid->RowIndex ?>_MODAL_KERJA" value="<?= HtmlEncode($Grid->MODAL_KERJA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <td data-name="OMZET_RATARATA_PERTAHUN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Grid->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Grid->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Grid->OMZET_RATARATA_PERTAHUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<span<?= $Grid->OMZET_RATARATA_PERTAHUN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->OMZET_RATARATA_PERTAHUN->getDisplayValue($Grid->OMZET_RATARATA_PERTAHUN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" value="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="o<?= $Grid->RowIndex ?>_OMZET_RATARATA_PERTAHUN" value="<?= HtmlEncode($Grid->OMZET_RATARATA_PERTAHUN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <td data-name="STATUS_USAHA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Grid->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x<?= $Grid->RowIndex ?>_STATUS_USAHA" id="x<?= $Grid->RowIndex ?>_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Grid->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Grid->STATUS_USAHA->EditValue ?>"<?= $Grid->STATUS_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->STATUS_USAHA->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_STATUS_USAHA">
<span<?= $Grid->STATUS_USAHA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->STATUS_USAHA->getDisplayValue($Grid->STATUS_USAHA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_STATUS_USAHA" id="x<?= $Grid->RowIndex ?>_STATUS_USAHA" value="<?= HtmlEncode($Grid->STATUS_USAHA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_STATUS_USAHA" id="o<?= $Grid->RowIndex ?>_STATUS_USAHA" value="<?= HtmlEncode($Grid->STATUS_USAHA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->ASET->Visible) { // ASET ?>
        <td data-name="ASET">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_datausaha_ASET">
<input type="<?= $Grid->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x<?= $Grid->RowIndex ?>_ASET" id="x<?= $Grid->RowIndex ?>_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Grid->ASET->getPlaceHolder()) ?>" value="<?= $Grid->ASET->EditValue ?>"<?= $Grid->ASET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Grid->ASET->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_datausaha_ASET">
<span<?= $Grid->ASET->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->ASET->getDisplayValue($Grid->ASET->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ASET" data-hidden="1" name="x<?= $Grid->RowIndex ?>_ASET" id="x<?= $Grid->RowIndex ?>_ASET" value="<?= HtmlEncode($Grid->ASET->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_datausaha" data-field="x_ASET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_ASET" id="o<?= $Grid->RowIndex ?>_ASET" value="<?= HtmlEncode($Grid->ASET->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fumkm_datausahagrid","load"], function() {
    fumkm_datausahagrid.updateLists(<?= $Grid->RowIndex ?>);
});
</script>
    </tr>
<?php
    }
?>
</tbody>
</table><!-- /.ew-table -->
</div><!-- /.ew-grid-middle-panel -->
<?php if ($Grid->CurrentMode == "add" || $Grid->CurrentMode == "copy") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "edit") { ?>
<input type="hidden" name="<?= $Grid->FormKeyCountName ?>" id="<?= $Grid->FormKeyCountName ?>" value="<?= $Grid->KeyCount ?>">
<?= $Grid->MultiSelectKey ?>
<?php } ?>
<?php if ($Grid->CurrentMode == "") { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fumkm_datausahagrid">
</div><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Grid->Recordset) {
    $Grid->Recordset->close();
}
?>
<?php if ($Grid->ShowOtherOptions) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php $Grid->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($Grid->TotalRecords == 0 && !$Grid->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Grid->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if (!$Grid->isExport()) { ?>
<script>
// Field event handlers
loadjs.ready("head", function() {
    ew.addEventHandlers("umkm_datausaha");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
