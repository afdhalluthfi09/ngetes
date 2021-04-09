<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembagalist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspeklembagalist = currentForm = new ew.Form("fumkm_aspeklembagalist", "list");
    fumkm_aspeklembagalist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeklembaga")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeklembaga)
        ew.vars.tables.umkm_aspeklembaga = currentTable;
    fumkm_aspeklembagalist.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["LB_BADANHUKUM", [fields.LB_BADANHUKUM.visible && fields.LB_BADANHUKUM.required ? ew.Validators.required(fields.LB_BADANHUKUM.caption) : null], fields.LB_BADANHUKUM.isInvalid],
        ["LB_IZINUSAHA", [fields.LB_IZINUSAHA.visible && fields.LB_IZINUSAHA.required ? ew.Validators.required(fields.LB_IZINUSAHA.caption) : null], fields.LB_IZINUSAHA.isInvalid],
        ["LB_NPWP", [fields.LB_NPWP.visible && fields.LB_NPWP.required ? ew.Validators.required(fields.LB_NPWP.caption) : null], fields.LB_NPWP.isInvalid],
        ["LB_SO", [fields.LB_SO.visible && fields.LB_SO.required ? ew.Validators.required(fields.LB_SO.caption) : null], fields.LB_SO.isInvalid],
        ["LB_JD", [fields.LB_JD.visible && fields.LB_JD.required ? ew.Validators.required(fields.LB_JD.caption) : null], fields.LB_JD.isInvalid],
        ["LB_ISO", [fields.LB_ISO.visible && fields.LB_ISO.required ? ew.Validators.required(fields.LB_ISO.caption) : null], fields.LB_ISO.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeklembagalist,
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
    fumkm_aspeklembagalist.validate = function () {
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
    fumkm_aspeklembagalist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeklembagalist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspeklembagalist.lists.LB_BADANHUKUM = <?= $Page->LB_BADANHUKUM->toClientList($Page) ?>;
    fumkm_aspeklembagalist.lists.LB_IZINUSAHA = <?= $Page->LB_IZINUSAHA->toClientList($Page) ?>;
    fumkm_aspeklembagalist.lists.LB_NPWP = <?= $Page->LB_NPWP->toClientList($Page) ?>;
    fumkm_aspeklembagalist.lists.LB_SO = <?= $Page->LB_SO->toClientList($Page) ?>;
    fumkm_aspeklembagalist.lists.LB_JD = <?= $Page->LB_JD->toClientList($Page) ?>;
    fumkm_aspeklembagalist.lists.LB_ISO = <?= $Page->LB_ISO->toClientList($Page) ?>;
    loadjs.done("fumkm_aspeklembagalist");
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
<form name="fumkm_aspeklembagalist" id="fumkm_aspeklembagalist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspeklembaga", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_NIK" style="white-space: nowrap;"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_BADANHUKUM"><?= $Page->renderSort($Page->LB_BADANHUKUM) ?></span></td>
            <td <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_BADANHUKUM">
    <select
        id="x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        name="x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        class="form-control ew-select<?= $Page->LB_BADANHUKUM->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_BADANHUKUM"
        data-value-separator="<?= $Page->LB_BADANHUKUM->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_BADANHUKUM->getPlaceHolder()) ?>"
        <?= $Page->LB_BADANHUKUM->editAttributes() ?>>
        <?= $Page->LB_BADANHUKUM->selectOptionListHtml("x{$Page->RowIndex}_LB_BADANHUKUM") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_BADANHUKUM->getErrorMessage() ?></div>
<?= $Page->LB_BADANHUKUM->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_BADANHUKUM") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_BADANHUKUM", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_BADANHUKUM.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_BADANHUKUM">
<span<?= $Page->LB_BADANHUKUM->viewAttributes() ?>>
<?= $Page->LB_BADANHUKUM->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_BADANHUKUM">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_BADANHUKUM->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_BADANHUKUM">
    <select
        id="x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        name="x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        class="form-control ew-select<?= $Page->LB_BADANHUKUM->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_BADANHUKUM"
        data-value-separator="<?= $Page->LB_BADANHUKUM->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_BADANHUKUM->getPlaceHolder()) ?>"
        <?= $Page->LB_BADANHUKUM->editAttributes() ?>>
        <?= $Page->LB_BADANHUKUM->selectOptionListHtml("x{$Page->RowIndex}_LB_BADANHUKUM") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_BADANHUKUM->getErrorMessage() ?></div>
<?= $Page->LB_BADANHUKUM->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_BADANHUKUM") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_BADANHUKUM", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_BADANHUKUM", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_BADANHUKUM.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_BADANHUKUM">
<span<?= $Page->LB_BADANHUKUM->viewAttributes() ?>>
<?= $Page->LB_BADANHUKUM->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_IZINUSAHA"><?= $Page->renderSort($Page->LB_IZINUSAHA) ?></span></td>
            <td <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_IZINUSAHA">
    <select
        id="x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        name="x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        class="form-control ew-select<?= $Page->LB_IZINUSAHA->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_IZINUSAHA"
        data-value-separator="<?= $Page->LB_IZINUSAHA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_IZINUSAHA->getPlaceHolder()) ?>"
        <?= $Page->LB_IZINUSAHA->editAttributes() ?>>
        <?= $Page->LB_IZINUSAHA->selectOptionListHtml("x{$Page->RowIndex}_LB_IZINUSAHA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_IZINUSAHA->getErrorMessage() ?></div>
<?= $Page->LB_IZINUSAHA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_IZINUSAHA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_IZINUSAHA", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_IZINUSAHA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_IZINUSAHA">
<span<?= $Page->LB_IZINUSAHA->viewAttributes() ?>>
<?= $Page->LB_IZINUSAHA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_IZINUSAHA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_IZINUSAHA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_IZINUSAHA">
    <select
        id="x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        name="x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        class="form-control ew-select<?= $Page->LB_IZINUSAHA->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_IZINUSAHA"
        data-value-separator="<?= $Page->LB_IZINUSAHA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_IZINUSAHA->getPlaceHolder()) ?>"
        <?= $Page->LB_IZINUSAHA->editAttributes() ?>>
        <?= $Page->LB_IZINUSAHA->selectOptionListHtml("x{$Page->RowIndex}_LB_IZINUSAHA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_IZINUSAHA->getErrorMessage() ?></div>
<?= $Page->LB_IZINUSAHA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_IZINUSAHA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_IZINUSAHA", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_IZINUSAHA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_IZINUSAHA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_IZINUSAHA">
<span<?= $Page->LB_IZINUSAHA->viewAttributes() ?>>
<?= $Page->LB_IZINUSAHA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_NPWP"><?= $Page->renderSort($Page->LB_NPWP) ?></span></td>
            <td <?= $Page->LB_NPWP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_NPWP">
    <select
        id="x<?= $Page->RowIndex ?>_LB_NPWP"
        name="x<?= $Page->RowIndex ?>_LB_NPWP"
        class="form-control ew-select<?= $Page->LB_NPWP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_NPWP"
        data-value-separator="<?= $Page->LB_NPWP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_NPWP->getPlaceHolder()) ?>"
        <?= $Page->LB_NPWP->editAttributes() ?>>
        <?= $Page->LB_NPWP->selectOptionListHtml("x{$Page->RowIndex}_LB_NPWP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_NPWP->getErrorMessage() ?></div>
<?= $Page->LB_NPWP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_NPWP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_NPWP", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_NPWP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_NPWP">
<span<?= $Page->LB_NPWP->viewAttributes() ?>>
<?= $Page->LB_NPWP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_NPWP">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_NPWP->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_NPWP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_NPWP">
    <select
        id="x<?= $Page->RowIndex ?>_LB_NPWP"
        name="x<?= $Page->RowIndex ?>_LB_NPWP"
        class="form-control ew-select<?= $Page->LB_NPWP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_NPWP"
        data-value-separator="<?= $Page->LB_NPWP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_NPWP->getPlaceHolder()) ?>"
        <?= $Page->LB_NPWP->editAttributes() ?>>
        <?= $Page->LB_NPWP->selectOptionListHtml("x{$Page->RowIndex}_LB_NPWP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_NPWP->getErrorMessage() ?></div>
<?= $Page->LB_NPWP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_NPWP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_NPWP", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_NPWP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_NPWP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_NPWP">
<span<?= $Page->LB_NPWP->viewAttributes() ?>>
<?= $Page->LB_NPWP->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_SO->Visible) { // LB_SO ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_SO"><?= $Page->renderSort($Page->LB_SO) ?></span></td>
            <td <?= $Page->LB_SO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_SO">
    <select
        id="x<?= $Page->RowIndex ?>_LB_SO"
        name="x<?= $Page->RowIndex ?>_LB_SO"
        class="form-control ew-select<?= $Page->LB_SO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_SO"
        data-value-separator="<?= $Page->LB_SO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_SO->getPlaceHolder()) ?>"
        <?= $Page->LB_SO->editAttributes() ?>>
        <?= $Page->LB_SO->selectOptionListHtml("x{$Page->RowIndex}_LB_SO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_SO->getErrorMessage() ?></div>
<?= $Page->LB_SO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_SO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_SO", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_SO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_SO">
<span<?= $Page->LB_SO->viewAttributes() ?>>
<?= $Page->LB_SO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_SO">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_SO->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_SO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_SO">
    <select
        id="x<?= $Page->RowIndex ?>_LB_SO"
        name="x<?= $Page->RowIndex ?>_LB_SO"
        class="form-control ew-select<?= $Page->LB_SO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_SO"
        data-value-separator="<?= $Page->LB_SO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_SO->getPlaceHolder()) ?>"
        <?= $Page->LB_SO->editAttributes() ?>>
        <?= $Page->LB_SO->selectOptionListHtml("x{$Page->RowIndex}_LB_SO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_SO->getErrorMessage() ?></div>
<?= $Page->LB_SO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_SO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_SO", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_SO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_SO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_SO">
<span<?= $Page->LB_SO->viewAttributes() ?>>
<?= $Page->LB_SO->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_JD->Visible) { // LB_JD ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_JD"><?= $Page->renderSort($Page->LB_JD) ?></span></td>
            <td <?= $Page->LB_JD->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_JD">
    <select
        id="x<?= $Page->RowIndex ?>_LB_JD"
        name="x<?= $Page->RowIndex ?>_LB_JD"
        class="form-control ew-select<?= $Page->LB_JD->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_JD"
        data-value-separator="<?= $Page->LB_JD->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_JD->getPlaceHolder()) ?>"
        <?= $Page->LB_JD->editAttributes() ?>>
        <?= $Page->LB_JD->selectOptionListHtml("x{$Page->RowIndex}_LB_JD") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_JD->getErrorMessage() ?></div>
<?= $Page->LB_JD->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_JD") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_JD", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_JD.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_JD">
<span<?= $Page->LB_JD->viewAttributes() ?>>
<?= $Page->LB_JD->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_JD">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_JD->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_JD->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_JD">
    <select
        id="x<?= $Page->RowIndex ?>_LB_JD"
        name="x<?= $Page->RowIndex ?>_LB_JD"
        class="form-control ew-select<?= $Page->LB_JD->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_JD"
        data-value-separator="<?= $Page->LB_JD->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_JD->getPlaceHolder()) ?>"
        <?= $Page->LB_JD->editAttributes() ?>>
        <?= $Page->LB_JD->selectOptionListHtml("x{$Page->RowIndex}_LB_JD") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_JD->getErrorMessage() ?></div>
<?= $Page->LB_JD->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_JD") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_JD", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_JD", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_JD.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_JD">
<span<?= $Page->LB_JD->viewAttributes() ?>>
<?= $Page->LB_JD->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspeklembaga_LB_ISO"><?= $Page->renderSort($Page->LB_ISO) ?></span></td>
            <td <?= $Page->LB_ISO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_ISO">
    <select
        id="x<?= $Page->RowIndex ?>_LB_ISO"
        name="x<?= $Page->RowIndex ?>_LB_ISO"
        class="form-control ew-select<?= $Page->LB_ISO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_ISO"
        data-value-separator="<?= $Page->LB_ISO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_ISO->getPlaceHolder()) ?>"
        <?= $Page->LB_ISO->editAttributes() ?>>
        <?= $Page->LB_ISO->selectOptionListHtml("x{$Page->RowIndex}_LB_ISO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_ISO->getErrorMessage() ?></div>
<?= $Page->LB_ISO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_ISO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_ISO", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_ISO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_ISO">
<span<?= $Page->LB_ISO->viewAttributes() ?>>
<?= $Page->LB_ISO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspeklembaga_LB_ISO">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_ISO->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_ISO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_ISO">
    <select
        id="x<?= $Page->RowIndex ?>_LB_ISO"
        name="x<?= $Page->RowIndex ?>_LB_ISO"
        class="form-control ew-select<?= $Page->LB_ISO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_ISO"
        data-value-separator="<?= $Page->LB_ISO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_ISO->getPlaceHolder()) ?>"
        <?= $Page->LB_ISO->editAttributes() ?>>
        <?= $Page->LB_ISO->selectOptionListHtml("x{$Page->RowIndex}_LB_ISO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->LB_ISO->getErrorMessage() ?></div>
<?= $Page->LB_ISO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_LB_ISO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO']"),
        options = { name: "x<?= $Page->RowIndex ?>_LB_ISO", selectId: "umkm_aspeklembaga_x<?= $Page->RowIndex ?>_LB_ISO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_ISO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspeklembaga_LB_ISO">
<span<?= $Page->LB_ISO->viewAttributes() ?>>
<?= $Page->LB_ISO->getViewValue() ?></span>
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
loadjs.ready(["fumkm_aspeklembagalist","load"], function () {
    fumkm_aspeklembagalist.updateLists(<?= $Page->RowIndex ?>);
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
    ew.addEventHandlers("umkm_aspeklembaga");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
