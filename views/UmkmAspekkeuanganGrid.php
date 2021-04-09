<?php

namespace PHPMaker2021\umkm_sidakui;

// Set up and run Grid object
$Grid = Container("UmkmAspekkeuanganGrid");
$Grid->run();
?>
<?php if (!$Grid->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuangangrid;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    fumkm_aspekkeuangangrid = new ew.Form("fumkm_aspekkeuangangrid", "grid");
    fumkm_aspekkeuangangrid.formKeyCountName = '<?= $Grid->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekkeuangan)
        ew.vars.tables.umkm_aspekkeuangan = currentTable;
    fumkm_aspekkeuangangrid.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["KEU_USAHAUTAMA", [fields.KEU_USAHAUTAMA.visible && fields.KEU_USAHAUTAMA.required ? ew.Validators.required(fields.KEU_USAHAUTAMA.caption) : null], fields.KEU_USAHAUTAMA.isInvalid],
        ["KEU_PENGELOLAAN", [fields.KEU_PENGELOLAAN.visible && fields.KEU_PENGELOLAAN.required ? ew.Validators.required(fields.KEU_PENGELOLAAN.caption) : null], fields.KEU_PENGELOLAAN.isInvalid],
        ["KEU_NOTA", [fields.KEU_NOTA.visible && fields.KEU_NOTA.required ? ew.Validators.required(fields.KEU_NOTA.caption) : null], fields.KEU_NOTA.isInvalid],
        ["KEU_PENCATATAN", [fields.KEU_PENCATATAN.visible && fields.KEU_PENCATATAN.required ? ew.Validators.required(fields.KEU_PENCATATAN.caption) : null], fields.KEU_PENCATATAN.isInvalid],
        ["KEU_LAPORAN", [fields.KEU_LAPORAN.visible && fields.KEU_LAPORAN.required ? ew.Validators.required(fields.KEU_LAPORAN.caption) : null], fields.KEU_LAPORAN.isInvalid],
        ["KEU_UTANGMODAL", [fields.KEU_UTANGMODAL.visible && fields.KEU_UTANGMODAL.required ? ew.Validators.required(fields.KEU_UTANGMODAL.caption) : null], fields.KEU_UTANGMODAL.isInvalid],
        ["KEU_CATATNASET", [fields.KEU_CATATNASET.visible && fields.KEU_CATATNASET.required ? ew.Validators.required(fields.KEU_CATATNASET.caption) : null], fields.KEU_CATATNASET.isInvalid],
        ["KEU_NONTUNAI", [fields.KEU_NONTUNAI.visible && fields.KEU_NONTUNAI.required ? ew.Validators.required(fields.KEU_NONTUNAI.caption) : null], fields.KEU_NONTUNAI.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspekkeuangangrid,
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
    fumkm_aspekkeuangangrid.validate = function () {
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
    fumkm_aspekkeuangangrid.emptyRow = function (rowIndex) {
        var fobj = this.getForm();
        if (ew.valueChanged(fobj, rowIndex, "KEU_USAHAUTAMA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_PENGELOLAAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_NOTA", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_PENCATATAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_LAPORAN", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_UTANGMODAL", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_CATATNASET", false))
            return false;
        if (ew.valueChanged(fobj, rowIndex, "KEU_NONTUNAI", false))
            return false;
        return true;
    }

    // Form_CustomValidate
    fumkm_aspekkeuangangrid.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekkeuangangrid.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekkeuangangrid.lists.KEU_USAHAUTAMA = <?= $Grid->KEU_USAHAUTAMA->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_PENGELOLAAN = <?= $Grid->KEU_PENGELOLAAN->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_NOTA = <?= $Grid->KEU_NOTA->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_PENCATATAN = <?= $Grid->KEU_PENCATATAN->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_LAPORAN = <?= $Grid->KEU_LAPORAN->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_UTANGMODAL = <?= $Grid->KEU_UTANGMODAL->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_CATATNASET = <?= $Grid->KEU_CATATNASET->toClientList($Grid) ?>;
    fumkm_aspekkeuangangrid.lists.KEU_NONTUNAI = <?= $Grid->KEU_NONTUNAI->toClientList($Grid) ?>;
    loadjs.done("fumkm_aspekkeuangangrid");
});
</script>
<?php } ?>
<?php
$Grid->renderOtherOptions();
?>
<?php if ($Grid->TotalRecords > 0 || $Grid->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Grid->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> umkm_aspekkeuangan">
<div id="fumkm_aspekkeuangangrid" class="ew-form ew-list-form form-inline">
<div id="gmp_umkm_aspekkeuangan" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table id="tbl_umkm_aspekkeuangangrid" class="table ew-table"><!-- .ew-table -->
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
        <th data-name="NIK" class="<?= $Grid->NIK->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_NIK" class="umkm_aspekkeuangan_NIK"><?= $Grid->renderSort($Grid->NIK) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <th data-name="KEU_USAHAUTAMA" class="<?= $Grid->KEU_USAHAUTAMA->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_USAHAUTAMA" class="umkm_aspekkeuangan_KEU_USAHAUTAMA"><?= $Grid->renderSort($Grid->KEU_USAHAUTAMA) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <th data-name="KEU_PENGELOLAAN" class="<?= $Grid->KEU_PENGELOLAAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_PENGELOLAAN" class="umkm_aspekkeuangan_KEU_PENGELOLAAN"><?= $Grid->renderSort($Grid->KEU_PENGELOLAAN) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <th data-name="KEU_NOTA" class="<?= $Grid->KEU_NOTA->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_NOTA" class="umkm_aspekkeuangan_KEU_NOTA"><?= $Grid->renderSort($Grid->KEU_NOTA) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <th data-name="KEU_PENCATATAN" class="<?= $Grid->KEU_PENCATATAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_PENCATATAN" class="umkm_aspekkeuangan_KEU_PENCATATAN"><?= $Grid->renderSort($Grid->KEU_PENCATATAN) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <th data-name="KEU_LAPORAN" class="<?= $Grid->KEU_LAPORAN->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_LAPORAN" class="umkm_aspekkeuangan_KEU_LAPORAN"><?= $Grid->renderSort($Grid->KEU_LAPORAN) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <th data-name="KEU_UTANGMODAL" class="<?= $Grid->KEU_UTANGMODAL->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_UTANGMODAL" class="umkm_aspekkeuangan_KEU_UTANGMODAL"><?= $Grid->renderSort($Grid->KEU_UTANGMODAL) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <th data-name="KEU_CATATNASET" class="<?= $Grid->KEU_CATATNASET->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_CATATNASET" class="umkm_aspekkeuangan_KEU_CATATNASET"><?= $Grid->renderSort($Grid->KEU_CATATNASET) ?></div></th>
<?php } ?>
<?php if ($Grid->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <th data-name="KEU_NONTUNAI" class="<?= $Grid->KEU_NONTUNAI->headerCellClass() ?>"><div id="elh_umkm_aspekkeuangan_KEU_NONTUNAI" class="umkm_aspekkeuangan_KEU_NONTUNAI"><?= $Grid->renderSort($Grid->KEU_NONTUNAI) ?></div></th>
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowCount, "id" => "r" . $Grid->RowCount . "_umkm_aspekkeuangan", "data-rowtype" => $Grid->RowType]);

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
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NIK" id="o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_NIK">
<span<?= $Grid->NIK->viewAttributes() ?>>
<?= $Grid->NIK->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_NIK" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_NIK" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } else { ?>
            <input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NIK" id="x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->CurrentValue) ?>">
    <?php } ?>
    <?php if ($Grid->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <td data-name="KEU_USAHAUTAMA" <?= $Grid->KEU_USAHAUTAMA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        name="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Grid->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Grid->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Grid->KEU_USAHAUTAMA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_USAHAUTAMA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Grid->KEU_USAHAUTAMA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_USAHAUTAMA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" id="o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" value="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        name="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Grid->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Grid->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Grid->KEU_USAHAUTAMA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_USAHAUTAMA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Grid->KEU_USAHAUTAMA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
<span<?= $Grid->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Grid->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_USAHAUTAMA" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" value="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_USAHAUTAMA" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" value="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <td data-name="KEU_PENGELOLAAN" <?= $Grid->KEU_PENGELOLAAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Grid->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Grid->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Grid->KEU_PENGELOLAAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENGELOLAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENGELOLAAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENGELOLAAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" id="o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" value="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Grid->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Grid->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Grid->KEU_PENGELOLAAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENGELOLAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENGELOLAAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
<span<?= $Grid->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Grid->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENGELOLAAN" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" value="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENGELOLAAN" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" value="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <td data-name="KEU_NOTA" <?= $Grid->KEU_NOTA->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        name="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        class="form-control ew-select<?= $Grid->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Grid->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NOTA->editAttributes() ?>>
        <?= $Grid->KEU_NOTA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NOTA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NOTA->getErrorMessage() ?></div>
<?= $Grid->KEU_NOTA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NOTA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NOTA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_NOTA" id="o<?= $Grid->RowIndex ?>_KEU_NOTA" value="<?= HtmlEncode($Grid->KEU_NOTA->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        name="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        class="form-control ew-select<?= $Grid->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Grid->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NOTA->editAttributes() ?>>
        <?= $Grid->KEU_NOTA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NOTA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NOTA->getErrorMessage() ?></div>
<?= $Grid->KEU_NOTA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NOTA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
<span<?= $Grid->KEU_NOTA->viewAttributes() ?>>
<?= $Grid->KEU_NOTA->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NOTA" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_NOTA" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_NOTA" value="<?= HtmlEncode($Grid->KEU_NOTA->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NOTA" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_NOTA" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_NOTA" value="<?= HtmlEncode($Grid->KEU_NOTA->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <td data-name="KEU_PENCATATAN" <?= $Grid->KEU_PENCATATAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        class="form-control ew-select<?= $Grid->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Grid->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Grid->KEU_PENCATATAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENCATATAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENCATATAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENCATATAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" id="o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" value="<?= HtmlEncode($Grid->KEU_PENCATATAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        class="form-control ew-select<?= $Grid->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Grid->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Grid->KEU_PENCATATAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENCATATAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENCATATAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
<span<?= $Grid->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Grid->KEU_PENCATATAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENCATATAN" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_PENCATATAN" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_PENCATATAN" value="<?= HtmlEncode($Grid->KEU_PENCATATAN->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENCATATAN" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" value="<?= HtmlEncode($Grid->KEU_PENCATATAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <td data-name="KEU_LAPORAN" <?= $Grid->KEU_LAPORAN->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        name="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        class="form-control ew-select<?= $Grid->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Grid->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_LAPORAN->editAttributes() ?>>
        <?= $Grid->KEU_LAPORAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_LAPORAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Grid->KEU_LAPORAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_LAPORAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_LAPORAN" id="o<?= $Grid->RowIndex ?>_KEU_LAPORAN" value="<?= HtmlEncode($Grid->KEU_LAPORAN->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        name="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        class="form-control ew-select<?= $Grid->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Grid->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_LAPORAN->editAttributes() ?>>
        <?= $Grid->KEU_LAPORAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_LAPORAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Grid->KEU_LAPORAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
<span<?= $Grid->KEU_LAPORAN->viewAttributes() ?>>
<?= $Grid->KEU_LAPORAN->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_LAPORAN" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_LAPORAN" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_LAPORAN" value="<?= HtmlEncode($Grid->KEU_LAPORAN->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_LAPORAN" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_LAPORAN" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_LAPORAN" value="<?= HtmlEncode($Grid->KEU_LAPORAN->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <td data-name="KEU_UTANGMODAL" <?= $Grid->KEU_UTANGMODAL->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        name="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Grid->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Grid->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Grid->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Grid->KEU_UTANGMODAL->selectOptionListHtml("x{$Grid->RowIndex}_KEU_UTANGMODAL") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Grid->KEU_UTANGMODAL->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_UTANGMODAL" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" id="o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" value="<?= HtmlEncode($Grid->KEU_UTANGMODAL->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        name="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Grid->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Grid->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Grid->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Grid->KEU_UTANGMODAL->selectOptionListHtml("x{$Grid->RowIndex}_KEU_UTANGMODAL") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Grid->KEU_UTANGMODAL->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
<span<?= $Grid->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Grid->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_UTANGMODAL" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" value="<?= HtmlEncode($Grid->KEU_UTANGMODAL->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_UTANGMODAL" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" value="<?= HtmlEncode($Grid->KEU_UTANGMODAL->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <td data-name="KEU_CATATNASET" <?= $Grid->KEU_CATATNASET->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        name="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        class="form-control ew-select<?= $Grid->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Grid->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Grid->KEU_CATATNASET->editAttributes() ?>>
        <?= $Grid->KEU_CATATNASET->selectOptionListHtml("x{$Grid->RowIndex}_KEU_CATATNASET") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Grid->KEU_CATATNASET->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_CATATNASET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_CATATNASET" id="o<?= $Grid->RowIndex ?>_KEU_CATATNASET" value="<?= HtmlEncode($Grid->KEU_CATATNASET->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        name="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        class="form-control ew-select<?= $Grid->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Grid->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Grid->KEU_CATATNASET->editAttributes() ?>>
        <?= $Grid->KEU_CATATNASET->selectOptionListHtml("x{$Grid->RowIndex}_KEU_CATATNASET") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Grid->KEU_CATATNASET->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
<span<?= $Grid->KEU_CATATNASET->viewAttributes() ?>>
<?= $Grid->KEU_CATATNASET->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_CATATNASET" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_CATATNASET" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_CATATNASET" value="<?= HtmlEncode($Grid->KEU_CATATNASET->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_CATATNASET" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_CATATNASET" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_CATATNASET" value="<?= HtmlEncode($Grid->KEU_CATATNASET->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
    <?php } ?>
    <?php if ($Grid->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <td data-name="KEU_NONTUNAI" <?= $Grid->KEU_NONTUNAI->cellAttributes() ?>>
<?php if ($Grid->RowType == ROWTYPE_ADD) { // Add record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        name="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        class="form-control ew-select<?= $Grid->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Grid->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Grid->KEU_NONTUNAI->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NONTUNAI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Grid->KEU_NONTUNAI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NONTUNAI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" id="o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" value="<?= HtmlEncode($Grid->KEU_NONTUNAI->OldValue) ?>">
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        name="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        class="form-control ew-select<?= $Grid->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Grid->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Grid->KEU_NONTUNAI->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NONTUNAI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Grid->KEU_NONTUNAI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Grid->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Grid->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
<span<?= $Grid->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Grid->KEU_NONTUNAI->getViewValue() ?></span>
</span>
<?php if ($Grid->isConfirm()) { ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NONTUNAI" data-hidden="1" name="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_NONTUNAI" id="fumkm_aspekkeuangangrid$x<?= $Grid->RowIndex ?>_KEU_NONTUNAI" value="<?= HtmlEncode($Grid->KEU_NONTUNAI->FormValue) ?>">
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NONTUNAI" data-hidden="1" name="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" id="fumkm_aspekkeuangangrid$o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" value="<?= HtmlEncode($Grid->KEU_NONTUNAI->OldValue) ?>">
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
loadjs.ready(["fumkm_aspekkeuangangrid","load"], function () {
    fumkm_aspekkeuangangrid.updateLists(<?= $Grid->RowIndex ?>);
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
        $Grid->RowAttrs->merge(["data-rowindex" => $Grid->RowIndex, "id" => "r0_umkm_aspekkeuangan", "data-rowtype" => ROWTYPE_ADD]);
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
<span id="el$rowindex$_umkm_aspekkeuangan_NIK">
<span<?= $Grid->NIK->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->NIK->getDisplayValue($Grid->NIK->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="x<?= $Grid->RowIndex ?>_NIK" id="x<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_NIK" data-hidden="1" name="o<?= $Grid->RowIndex ?>_NIK" id="o<?= $Grid->RowIndex ?>_NIK" value="<?= HtmlEncode($Grid->NIK->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <td data-name="KEU_USAHAUTAMA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        name="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Grid->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Grid->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Grid->KEU_USAHAUTAMA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_USAHAUTAMA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Grid->KEU_USAHAUTAMA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_USAHAUTAMA">
<span<?= $Grid->KEU_USAHAUTAMA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_USAHAUTAMA->getDisplayValue($Grid->KEU_USAHAUTAMA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_USAHAUTAMA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" id="x<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" value="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_USAHAUTAMA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" id="o<?= $Grid->RowIndex ?>_KEU_USAHAUTAMA" value="<?= HtmlEncode($Grid->KEU_USAHAUTAMA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <td data-name="KEU_PENGELOLAAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Grid->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Grid->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Grid->KEU_PENGELOLAAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENGELOLAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENGELOLAAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_PENGELOLAAN">
<span<?= $Grid->KEU_PENGELOLAAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_PENGELOLAAN->getDisplayValue($Grid->KEU_PENGELOLAAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENGELOLAAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" id="x<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" value="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENGELOLAAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" id="o<?= $Grid->RowIndex ?>_KEU_PENGELOLAAN" value="<?= HtmlEncode($Grid->KEU_PENGELOLAAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <td data-name="KEU_NOTA">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        name="x<?= $Grid->RowIndex ?>_KEU_NOTA"
        class="form-control ew-select<?= $Grid->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Grid->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NOTA->editAttributes() ?>>
        <?= $Grid->KEU_NOTA->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NOTA") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NOTA->getErrorMessage() ?></div>
<?= $Grid->KEU_NOTA->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NOTA", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_NOTA">
<span<?= $Grid->KEU_NOTA->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_NOTA->getDisplayValue($Grid->KEU_NOTA->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NOTA" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_NOTA" id="x<?= $Grid->RowIndex ?>_KEU_NOTA" value="<?= HtmlEncode($Grid->KEU_NOTA->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NOTA" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_NOTA" id="o<?= $Grid->RowIndex ?>_KEU_NOTA" value="<?= HtmlEncode($Grid->KEU_NOTA->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <td data-name="KEU_PENCATATAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        name="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        class="form-control ew-select<?= $Grid->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Grid->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Grid->KEU_PENCATATAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_PENCATATAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Grid->KEU_PENCATATAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_PENCATATAN">
<span<?= $Grid->KEU_PENCATATAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_PENCATATAN->getDisplayValue($Grid->KEU_PENCATATAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENCATATAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN" id="x<?= $Grid->RowIndex ?>_KEU_PENCATATAN" value="<?= HtmlEncode($Grid->KEU_PENCATATAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_PENCATATAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" id="o<?= $Grid->RowIndex ?>_KEU_PENCATATAN" value="<?= HtmlEncode($Grid->KEU_PENCATATAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <td data-name="KEU_LAPORAN">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        name="x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        class="form-control ew-select<?= $Grid->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Grid->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Grid->KEU_LAPORAN->editAttributes() ?>>
        <?= $Grid->KEU_LAPORAN->selectOptionListHtml("x{$Grid->RowIndex}_KEU_LAPORAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Grid->KEU_LAPORAN->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_LAPORAN">
<span<?= $Grid->KEU_LAPORAN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_LAPORAN->getDisplayValue($Grid->KEU_LAPORAN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_LAPORAN" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_LAPORAN" id="x<?= $Grid->RowIndex ?>_KEU_LAPORAN" value="<?= HtmlEncode($Grid->KEU_LAPORAN->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_LAPORAN" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_LAPORAN" id="o<?= $Grid->RowIndex ?>_KEU_LAPORAN" value="<?= HtmlEncode($Grid->KEU_LAPORAN->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <td data-name="KEU_UTANGMODAL">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        name="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Grid->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Grid->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Grid->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Grid->KEU_UTANGMODAL->selectOptionListHtml("x{$Grid->RowIndex}_KEU_UTANGMODAL") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Grid->KEU_UTANGMODAL->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_UTANGMODAL">
<span<?= $Grid->KEU_UTANGMODAL->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_UTANGMODAL->getDisplayValue($Grid->KEU_UTANGMODAL->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_UTANGMODAL" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" id="x<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" value="<?= HtmlEncode($Grid->KEU_UTANGMODAL->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_UTANGMODAL" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" id="o<?= $Grid->RowIndex ?>_KEU_UTANGMODAL" value="<?= HtmlEncode($Grid->KEU_UTANGMODAL->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <td data-name="KEU_CATATNASET">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        name="x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        class="form-control ew-select<?= $Grid->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Grid->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Grid->KEU_CATATNASET->editAttributes() ?>>
        <?= $Grid->KEU_CATATNASET->selectOptionListHtml("x{$Grid->RowIndex}_KEU_CATATNASET") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Grid->KEU_CATATNASET->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_CATATNASET">
<span<?= $Grid->KEU_CATATNASET->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_CATATNASET->getDisplayValue($Grid->KEU_CATATNASET->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_CATATNASET" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_CATATNASET" id="x<?= $Grid->RowIndex ?>_KEU_CATATNASET" value="<?= HtmlEncode($Grid->KEU_CATATNASET->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_CATATNASET" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_CATATNASET" id="o<?= $Grid->RowIndex ?>_KEU_CATATNASET" value="<?= HtmlEncode($Grid->KEU_CATATNASET->OldValue) ?>">
</td>
    <?php } ?>
    <?php if ($Grid->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <td data-name="KEU_NONTUNAI">
<?php if (!$Grid->isConfirm()) { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        name="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        class="form-control ew-select<?= $Grid->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Grid->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Grid->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Grid->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Grid->KEU_NONTUNAI->selectOptionListHtml("x{$Grid->RowIndex}_KEU_NONTUNAI") ?>
    </select>
    <div class="invalid-feedback"><?= $Grid->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Grid->KEU_NONTUNAI->Lookup->getParamTag($Grid, "p_x" . $Grid->RowIndex . "_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI']"),
        options = { name: "x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x<?= $Grid->RowIndex ?>_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_umkm_aspekkeuangan_KEU_NONTUNAI">
<span<?= $Grid->KEU_NONTUNAI->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Grid->KEU_NONTUNAI->getDisplayValue($Grid->KEU_NONTUNAI->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NONTUNAI" data-hidden="1" name="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI" id="x<?= $Grid->RowIndex ?>_KEU_NONTUNAI" value="<?= HtmlEncode($Grid->KEU_NONTUNAI->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="umkm_aspekkeuangan" data-field="x_KEU_NONTUNAI" data-hidden="1" name="o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" id="o<?= $Grid->RowIndex ?>_KEU_NONTUNAI" value="<?= HtmlEncode($Grid->KEU_NONTUNAI->OldValue) ?>">
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Grid->ListOptions->render("body", "right", $Grid->RowIndex);
?>
<script>
loadjs.ready(["fumkm_aspekkeuangangrid","load"], function() {
    fumkm_aspekkeuangangrid.updateLists(<?= $Grid->RowIndex ?>);
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
<input type="hidden" name="detailpage" value="fumkm_aspekkeuangangrid">
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
    ew.addEventHandlers("umkm_aspekkeuangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
