<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdmlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspeksdmlist = currentForm = new ew.Form("fumkm_aspeksdmlist", "list");
    fumkm_aspeksdmlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeksdm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeksdm)
        ew.vars.tables.umkm_aspeksdm = currentTable;
    fumkm_aspeksdmlist.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["SDM_OMS", [fields.SDM_OMS.visible && fields.SDM_OMS.required ? ew.Validators.required(fields.SDM_OMS.caption) : null], fields.SDM_OMS.isInvalid],
        ["SDM_FOKUS", [fields.SDM_FOKUS.visible && fields.SDM_FOKUS.required ? ew.Validators.required(fields.SDM_FOKUS.caption) : null], fields.SDM_FOKUS.isInvalid],
        ["SDM_TARGET", [fields.SDM_TARGET.visible && fields.SDM_TARGET.required ? ew.Validators.required(fields.SDM_TARGET.caption) : null], fields.SDM_TARGET.isInvalid],
        ["SDM_KARYAWANTETAP", [fields.SDM_KARYAWANTETAP.visible && fields.SDM_KARYAWANTETAP.required ? ew.Validators.required(fields.SDM_KARYAWANTETAP.caption) : null], fields.SDM_KARYAWANTETAP.isInvalid],
        ["SDM_KARYAWANSUBKON", [fields.SDM_KARYAWANSUBKON.visible && fields.SDM_KARYAWANSUBKON.required ? ew.Validators.required(fields.SDM_KARYAWANSUBKON.caption) : null], fields.SDM_KARYAWANSUBKON.isInvalid],
        ["SDM_GAJI", [fields.SDM_GAJI.visible && fields.SDM_GAJI.required ? ew.Validators.required(fields.SDM_GAJI.caption) : null], fields.SDM_GAJI.isInvalid],
        ["SDM_ASURANSI", [fields.SDM_ASURANSI.visible && fields.SDM_ASURANSI.required ? ew.Validators.required(fields.SDM_ASURANSI.caption) : null], fields.SDM_ASURANSI.isInvalid],
        ["SDM_TUNJANGAN", [fields.SDM_TUNJANGAN.visible && fields.SDM_TUNJANGAN.required ? ew.Validators.required(fields.SDM_TUNJANGAN.caption) : null], fields.SDM_TUNJANGAN.isInvalid],
        ["SDM_PELATIHAN", [fields.SDM_PELATIHAN.visible && fields.SDM_PELATIHAN.required ? ew.Validators.required(fields.SDM_PELATIHAN.caption) : null], fields.SDM_PELATIHAN.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeksdmlist,
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
    fumkm_aspeksdmlist.validate = function () {
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

            // Validate fields
            if (!this.validateFields(rowIndex))
                return false;

            // Call Form_CustomValidate event
            if (!this.customValidate(fobj)) {
                this.focus();
                return false;
            }
        }
        return true;
    }

    // Form_CustomValidate
    fumkm_aspeksdmlist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeksdmlist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspeksdmlist.lists.SDM_OMS = <?= $Page->SDM_OMS->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_FOKUS = <?= $Page->SDM_FOKUS->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_TARGET = <?= $Page->SDM_TARGET->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_KARYAWANTETAP = <?= $Page->SDM_KARYAWANTETAP->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_KARYAWANSUBKON = <?= $Page->SDM_KARYAWANSUBKON->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_GAJI = <?= $Page->SDM_GAJI->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_ASURANSI = <?= $Page->SDM_ASURANSI->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_TUNJANGAN = <?= $Page->SDM_TUNJANGAN->toClientList($Page) ?>;
    fumkm_aspeksdmlist.lists.SDM_PELATIHAN = <?= $Page->SDM_PELATIHAN->toClientList($Page) ?>;
    loadjs.done("fumkm_aspeksdmlist");
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
<form name="fumkm_aspeksdmlist" id="fumkm_aspeksdmlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm">
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

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}
$Page->EditRowCount = 0;
if ($Page->isEdit())
    $Page->RowIndex = 1;
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
        if ($Page->isEdit()) {
            if ($Page->checkInlineEditKey() && $Page->EditRowCount == 0) { // Inline edit
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isEdit() && $Page->RowType == ROWTYPE_EDIT && $Page->EventCancelled) { // Update failed
            $CurrentForm->Index = 1;
            $Page->restoreFormValues(); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspeksdm", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_NIK" style="white-space: nowrap;"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_OMS"><?= $Page->renderSort($Page->SDM_OMS) ?></span></td>
            <td <?= $Page->SDM_OMS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_OMS">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_OMS"
        name="x<?= $Page->RowIndex ?>_SDM_OMS"
        class="form-control ew-select<?= $Page->SDM_OMS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_OMS"
        data-value-separator="<?= $Page->SDM_OMS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_OMS->getPlaceHolder()) ?>"
        <?= $Page->SDM_OMS->editAttributes() ?>>
        <?= $Page->SDM_OMS->selectOptionListHtml("x{$Page->RowIndex}_SDM_OMS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_OMS->getErrorMessage() ?></div>
<?= $Page->SDM_OMS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_OMS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_OMS", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_OMS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_OMS">
<span<?= $Page->SDM_OMS->viewAttributes() ?>>
<?= $Page->SDM_OMS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_OMS">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_OMS->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_OMS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_OMS">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_OMS"
        name="x<?= $Page->RowIndex ?>_SDM_OMS"
        class="form-control ew-select<?= $Page->SDM_OMS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_OMS"
        data-value-separator="<?= $Page->SDM_OMS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_OMS->getPlaceHolder()) ?>"
        <?= $Page->SDM_OMS->editAttributes() ?>>
        <?= $Page->SDM_OMS->selectOptionListHtml("x{$Page->RowIndex}_SDM_OMS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_OMS->getErrorMessage() ?></div>
<?= $Page->SDM_OMS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_OMS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_OMS", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_OMS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_OMS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_OMS">
<span<?= $Page->SDM_OMS->viewAttributes() ?>>
<?= $Page->SDM_OMS->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_FOKUS"><?= $Page->renderSort($Page->SDM_FOKUS) ?></span></td>
            <td <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_FOKUS">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_FOKUS"
        name="x<?= $Page->RowIndex ?>_SDM_FOKUS"
        class="form-control ew-select<?= $Page->SDM_FOKUS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_FOKUS"
        data-value-separator="<?= $Page->SDM_FOKUS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_FOKUS->getPlaceHolder()) ?>"
        <?= $Page->SDM_FOKUS->editAttributes() ?>>
        <?= $Page->SDM_FOKUS->selectOptionListHtml("x{$Page->RowIndex}_SDM_FOKUS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_FOKUS->getErrorMessage() ?></div>
<?= $Page->SDM_FOKUS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_FOKUS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_FOKUS", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_FOKUS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_FOKUS">
<span<?= $Page->SDM_FOKUS->viewAttributes() ?>>
<?= $Page->SDM_FOKUS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_FOKUS">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_FOKUS->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_FOKUS">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_FOKUS"
        name="x<?= $Page->RowIndex ?>_SDM_FOKUS"
        class="form-control ew-select<?= $Page->SDM_FOKUS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_FOKUS"
        data-value-separator="<?= $Page->SDM_FOKUS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_FOKUS->getPlaceHolder()) ?>"
        <?= $Page->SDM_FOKUS->editAttributes() ?>>
        <?= $Page->SDM_FOKUS->selectOptionListHtml("x{$Page->RowIndex}_SDM_FOKUS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_FOKUS->getErrorMessage() ?></div>
<?= $Page->SDM_FOKUS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_FOKUS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_FOKUS", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_FOKUS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_FOKUS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_FOKUS">
<span<?= $Page->SDM_FOKUS->viewAttributes() ?>>
<?= $Page->SDM_FOKUS->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_TARGET"><?= $Page->renderSort($Page->SDM_TARGET) ?></span></td>
            <td <?= $Page->SDM_TARGET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TARGET">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_TARGET"
        name="x<?= $Page->RowIndex ?>_SDM_TARGET"
        class="form-control ew-select<?= $Page->SDM_TARGET->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TARGET"
        data-value-separator="<?= $Page->SDM_TARGET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TARGET->getPlaceHolder()) ?>"
        <?= $Page->SDM_TARGET->editAttributes() ?>>
        <?= $Page->SDM_TARGET->selectOptionListHtml("x{$Page->RowIndex}_SDM_TARGET") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_TARGET->getErrorMessage() ?></div>
<?= $Page->SDM_TARGET->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_TARGET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_TARGET", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TARGET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TARGET">
<span<?= $Page->SDM_TARGET->viewAttributes() ?>>
<?= $Page->SDM_TARGET->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_TARGET">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TARGET->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TARGET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TARGET">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_TARGET"
        name="x<?= $Page->RowIndex ?>_SDM_TARGET"
        class="form-control ew-select<?= $Page->SDM_TARGET->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TARGET"
        data-value-separator="<?= $Page->SDM_TARGET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TARGET->getPlaceHolder()) ?>"
        <?= $Page->SDM_TARGET->editAttributes() ?>>
        <?= $Page->SDM_TARGET->selectOptionListHtml("x{$Page->RowIndex}_SDM_TARGET") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_TARGET->getErrorMessage() ?></div>
<?= $Page->SDM_TARGET->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_TARGET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_TARGET", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TARGET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TARGET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TARGET">
<span<?= $Page->SDM_TARGET->viewAttributes() ?>>
<?= $Page->SDM_TARGET->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_KARYAWANTETAP"><?= $Page->renderSort($Page->SDM_KARYAWANTETAP) ?></span></td>
            <td <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANTETAP">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        name="x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        class="form-control ew-select<?= $Page->SDM_KARYAWANTETAP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANTETAP"
        data-value-separator="<?= $Page->SDM_KARYAWANTETAP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANTETAP->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANTETAP->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANTETAP->selectOptionListHtml("x{$Page->RowIndex}_SDM_KARYAWANTETAP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANTETAP->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANTETAP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_KARYAWANTETAP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANTETAP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANTETAP">
<span<?= $Page->SDM_KARYAWANTETAP->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANTETAP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_KARYAWANTETAP">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANTETAP->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANTETAP">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        name="x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        class="form-control ew-select<?= $Page->SDM_KARYAWANTETAP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANTETAP"
        data-value-separator="<?= $Page->SDM_KARYAWANTETAP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANTETAP->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANTETAP->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANTETAP->selectOptionListHtml("x{$Page->RowIndex}_SDM_KARYAWANTETAP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANTETAP->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANTETAP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_KARYAWANTETAP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANTETAP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANTETAP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANTETAP">
<span<?= $Page->SDM_KARYAWANTETAP->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANTETAP->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_KARYAWANSUBKON"><?= $Page->renderSort($Page->SDM_KARYAWANSUBKON) ?></span></td>
            <td <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANSUBKON">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        name="x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        class="form-control ew-select<?= $Page->SDM_KARYAWANSUBKON->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANSUBKON"
        data-value-separator="<?= $Page->SDM_KARYAWANSUBKON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANSUBKON->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANSUBKON->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANSUBKON->selectOptionListHtml("x{$Page->RowIndex}_SDM_KARYAWANSUBKON") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANSUBKON->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANSUBKON->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_KARYAWANSUBKON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANSUBKON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANSUBKON">
<span<?= $Page->SDM_KARYAWANSUBKON->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANSUBKON->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_KARYAWANSUBKON">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANSUBKON->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANSUBKON">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        name="x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        class="form-control ew-select<?= $Page->SDM_KARYAWANSUBKON->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANSUBKON"
        data-value-separator="<?= $Page->SDM_KARYAWANSUBKON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANSUBKON->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANSUBKON->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANSUBKON->selectOptionListHtml("x{$Page->RowIndex}_SDM_KARYAWANSUBKON") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANSUBKON->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANSUBKON->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_KARYAWANSUBKON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_KARYAWANSUBKON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANSUBKON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_KARYAWANSUBKON">
<span<?= $Page->SDM_KARYAWANSUBKON->viewAttributes() ?>>
<?= $Page->SDM_KARYAWANSUBKON->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_GAJI"><?= $Page->renderSort($Page->SDM_GAJI) ?></span></td>
            <td <?= $Page->SDM_GAJI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_GAJI">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_GAJI"
        name="x<?= $Page->RowIndex ?>_SDM_GAJI"
        class="form-control ew-select<?= $Page->SDM_GAJI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_GAJI"
        data-value-separator="<?= $Page->SDM_GAJI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_GAJI->getPlaceHolder()) ?>"
        <?= $Page->SDM_GAJI->editAttributes() ?>>
        <?= $Page->SDM_GAJI->selectOptionListHtml("x{$Page->RowIndex}_SDM_GAJI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_GAJI->getErrorMessage() ?></div>
<?= $Page->SDM_GAJI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_GAJI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_GAJI", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_GAJI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_GAJI">
<span<?= $Page->SDM_GAJI->viewAttributes() ?>>
<?= $Page->SDM_GAJI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_GAJI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_GAJI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_GAJI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_GAJI">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_GAJI"
        name="x<?= $Page->RowIndex ?>_SDM_GAJI"
        class="form-control ew-select<?= $Page->SDM_GAJI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_GAJI"
        data-value-separator="<?= $Page->SDM_GAJI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_GAJI->getPlaceHolder()) ?>"
        <?= $Page->SDM_GAJI->editAttributes() ?>>
        <?= $Page->SDM_GAJI->selectOptionListHtml("x{$Page->RowIndex}_SDM_GAJI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_GAJI->getErrorMessage() ?></div>
<?= $Page->SDM_GAJI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_GAJI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_GAJI", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_GAJI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_GAJI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_GAJI">
<span<?= $Page->SDM_GAJI->viewAttributes() ?>>
<?= $Page->SDM_GAJI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_ASURANSI"><?= $Page->renderSort($Page->SDM_ASURANSI) ?></span></td>
            <td <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_ASURANSI">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        name="x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        class="form-control ew-select<?= $Page->SDM_ASURANSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_ASURANSI"
        data-value-separator="<?= $Page->SDM_ASURANSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_ASURANSI->getPlaceHolder()) ?>"
        <?= $Page->SDM_ASURANSI->editAttributes() ?>>
        <?= $Page->SDM_ASURANSI->selectOptionListHtml("x{$Page->RowIndex}_SDM_ASURANSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_ASURANSI->getErrorMessage() ?></div>
<?= $Page->SDM_ASURANSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_ASURANSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_ASURANSI", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_ASURANSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_ASURANSI">
<span<?= $Page->SDM_ASURANSI->viewAttributes() ?>>
<?= $Page->SDM_ASURANSI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_ASURANSI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_ASURANSI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_ASURANSI">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        name="x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        class="form-control ew-select<?= $Page->SDM_ASURANSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_ASURANSI"
        data-value-separator="<?= $Page->SDM_ASURANSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_ASURANSI->getPlaceHolder()) ?>"
        <?= $Page->SDM_ASURANSI->editAttributes() ?>>
        <?= $Page->SDM_ASURANSI->selectOptionListHtml("x{$Page->RowIndex}_SDM_ASURANSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_ASURANSI->getErrorMessage() ?></div>
<?= $Page->SDM_ASURANSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_ASURANSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_ASURANSI", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_ASURANSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_ASURANSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_ASURANSI">
<span<?= $Page->SDM_ASURANSI->viewAttributes() ?>>
<?= $Page->SDM_ASURANSI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_TUNJANGAN"><?= $Page->renderSort($Page->SDM_TUNJANGAN) ?></span></td>
            <td <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TUNJANGAN">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        name="x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        class="form-control ew-select<?= $Page->SDM_TUNJANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TUNJANGAN"
        data-value-separator="<?= $Page->SDM_TUNJANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TUNJANGAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_TUNJANGAN->editAttributes() ?>>
        <?= $Page->SDM_TUNJANGAN->selectOptionListHtml("x{$Page->RowIndex}_SDM_TUNJANGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_TUNJANGAN->getErrorMessage() ?></div>
<?= $Page->SDM_TUNJANGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_TUNJANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_TUNJANGAN", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TUNJANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TUNJANGAN">
<span<?= $Page->SDM_TUNJANGAN->viewAttributes() ?>>
<?= $Page->SDM_TUNJANGAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_TUNJANGAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TUNJANGAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TUNJANGAN">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        name="x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        class="form-control ew-select<?= $Page->SDM_TUNJANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TUNJANGAN"
        data-value-separator="<?= $Page->SDM_TUNJANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TUNJANGAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_TUNJANGAN->editAttributes() ?>>
        <?= $Page->SDM_TUNJANGAN->selectOptionListHtml("x{$Page->RowIndex}_SDM_TUNJANGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_TUNJANGAN->getErrorMessage() ?></div>
<?= $Page->SDM_TUNJANGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_TUNJANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_TUNJANGAN", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_TUNJANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TUNJANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_TUNJANGAN">
<span<?= $Page->SDM_TUNJANGAN->viewAttributes() ?>>
<?= $Page->SDM_TUNJANGAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeksdm_SDM_PELATIHAN"><?= $Page->renderSort($Page->SDM_PELATIHAN) ?></span></td>
            <td <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_PELATIHAN">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        name="x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        class="form-control ew-select<?= $Page->SDM_PELATIHAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_PELATIHAN"
        data-value-separator="<?= $Page->SDM_PELATIHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_PELATIHAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_PELATIHAN->editAttributes() ?>>
        <?= $Page->SDM_PELATIHAN->selectOptionListHtml("x{$Page->RowIndex}_SDM_PELATIHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_PELATIHAN->getErrorMessage() ?></div>
<?= $Page->SDM_PELATIHAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_PELATIHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_PELATIHAN", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_PELATIHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_PELATIHAN">
<span<?= $Page->SDM_PELATIHAN->viewAttributes() ?>>
<?= $Page->SDM_PELATIHAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeksdm_SDM_PELATIHAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_PELATIHAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_PELATIHAN">
    <select
        id="x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        name="x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        class="form-control ew-select<?= $Page->SDM_PELATIHAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_PELATIHAN"
        data-value-separator="<?= $Page->SDM_PELATIHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_PELATIHAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_PELATIHAN->editAttributes() ?>>
        <?= $Page->SDM_PELATIHAN->selectOptionListHtml("x{$Page->RowIndex}_SDM_PELATIHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SDM_PELATIHAN->getErrorMessage() ?></div>
<?= $Page->SDM_PELATIHAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SDM_PELATIHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_SDM_PELATIHAN", selectId: "umkm_aspeksdm_x<?= $Page->RowIndex ?>_SDM_PELATIHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_PELATIHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeksdm_SDM_PELATIHAN">
<span<?= $Page->SDM_PELATIHAN->viewAttributes() ?>>
<?= $Page->SDM_PELATIHAN->getViewValue() ?></span>
</span>
<?php } ?>
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
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fumkm_aspeksdmlist","load"], function () {
    fumkm_aspeksdmlist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
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
    ew.addEventHandlers("umkm_aspeksdm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
