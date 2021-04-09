<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimarklist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekdigimarklist = currentForm = new ew.Form("fumkm_aspekdigimarklist", "list");
    fumkm_aspekdigimarklist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekdigimark")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekdigimark)
        ew.vars.tables.umkm_aspekdigimark = currentTable;
    fumkm_aspekdigimarklist.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["DM_CHATTING", [fields.DM_CHATTING.visible && fields.DM_CHATTING.required ? ew.Validators.required(fields.DM_CHATTING.caption) : null], fields.DM_CHATTING.isInvalid],
        ["DM_MEDSOS", [fields.DM_MEDSOS.visible && fields.DM_MEDSOS.required ? ew.Validators.required(fields.DM_MEDSOS.caption) : null], fields.DM_MEDSOS.isInvalid],
        ["DM_MP", [fields.DM_MP.visible && fields.DM_MP.required ? ew.Validators.required(fields.DM_MP.caption) : null], fields.DM_MP.isInvalid],
        ["DM_GMB", [fields.DM_GMB.visible && fields.DM_GMB.required ? ew.Validators.required(fields.DM_GMB.caption) : null], fields.DM_GMB.isInvalid],
        ["DM_WEB", [fields.DM_WEB.visible && fields.DM_WEB.required ? ew.Validators.required(fields.DM_WEB.caption) : null], fields.DM_WEB.isInvalid],
        ["DM_UPDATEMEDSOS", [fields.DM_UPDATEMEDSOS.visible && fields.DM_UPDATEMEDSOS.required ? ew.Validators.required(fields.DM_UPDATEMEDSOS.caption) : null], fields.DM_UPDATEMEDSOS.isInvalid],
        ["DM_UPDATEWEBSITE", [fields.DM_UPDATEWEBSITE.visible && fields.DM_UPDATEWEBSITE.required ? ew.Validators.required(fields.DM_UPDATEWEBSITE.caption) : null], fields.DM_UPDATEWEBSITE.isInvalid],
        ["DM_GOOGLEINDEX", [fields.DM_GOOGLEINDEX.visible && fields.DM_GOOGLEINDEX.required ? ew.Validators.required(fields.DM_GOOGLEINDEX.caption) : null], fields.DM_GOOGLEINDEX.isInvalid],
        ["DM_IKLANBERBAYAR", [fields.DM_IKLANBERBAYAR.visible && fields.DM_IKLANBERBAYAR.required ? ew.Validators.required(fields.DM_IKLANBERBAYAR.caption) : null], fields.DM_IKLANBERBAYAR.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspekdigimarklist,
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
    fumkm_aspekdigimarklist.validate = function () {
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
    fumkm_aspekdigimarklist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekdigimarklist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekdigimarklist.lists.DM_CHATTING = <?= $Page->DM_CHATTING->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_MEDSOS = <?= $Page->DM_MEDSOS->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_MP = <?= $Page->DM_MP->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_GMB = <?= $Page->DM_GMB->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_WEB = <?= $Page->DM_WEB->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_UPDATEMEDSOS = <?= $Page->DM_UPDATEMEDSOS->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_UPDATEWEBSITE = <?= $Page->DM_UPDATEWEBSITE->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_GOOGLEINDEX = <?= $Page->DM_GOOGLEINDEX->toClientList($Page) ?>;
    fumkm_aspekdigimarklist.lists.DM_IKLANBERBAYAR = <?= $Page->DM_IKLANBERBAYAR->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekdigimarklist");
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
<form name="fumkm_aspekdigimarklist" id="fumkm_aspekdigimarklist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekdigimark", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_NIK"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_CHATTING"><?= $Page->renderSort($Page->DM_CHATTING) ?></span></td>
            <td <?= $Page->DM_CHATTING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_CHATTING">
    <select
        id="x<?= $Page->RowIndex ?>_DM_CHATTING"
        name="x<?= $Page->RowIndex ?>_DM_CHATTING"
        class="form-control ew-select<?= $Page->DM_CHATTING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_CHATTING"
        data-value-separator="<?= $Page->DM_CHATTING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_CHATTING->getPlaceHolder()) ?>"
        <?= $Page->DM_CHATTING->editAttributes() ?>>
        <?= $Page->DM_CHATTING->selectOptionListHtml("x{$Page->RowIndex}_DM_CHATTING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_CHATTING->getErrorMessage() ?></div>
<?= $Page->DM_CHATTING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_CHATTING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_CHATTING", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_CHATTING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_CHATTING">
<span<?= $Page->DM_CHATTING->viewAttributes() ?>>
<?= $Page->DM_CHATTING->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_CHATTING">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_CHATTING->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_CHATTING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_CHATTING">
    <select
        id="x<?= $Page->RowIndex ?>_DM_CHATTING"
        name="x<?= $Page->RowIndex ?>_DM_CHATTING"
        class="form-control ew-select<?= $Page->DM_CHATTING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_CHATTING"
        data-value-separator="<?= $Page->DM_CHATTING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_CHATTING->getPlaceHolder()) ?>"
        <?= $Page->DM_CHATTING->editAttributes() ?>>
        <?= $Page->DM_CHATTING->selectOptionListHtml("x{$Page->RowIndex}_DM_CHATTING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_CHATTING->getErrorMessage() ?></div>
<?= $Page->DM_CHATTING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_CHATTING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_CHATTING", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_CHATTING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_CHATTING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_CHATTING">
<span<?= $Page->DM_CHATTING->viewAttributes() ?>>
<?= $Page->DM_CHATTING->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_MEDSOS"><?= $Page->renderSort($Page->DM_MEDSOS) ?></span></td>
            <td <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MEDSOS">
    <select
        id="x<?= $Page->RowIndex ?>_DM_MEDSOS"
        name="x<?= $Page->RowIndex ?>_DM_MEDSOS"
        class="form-control ew-select<?= $Page->DM_MEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MEDSOS"
        data-value-separator="<?= $Page->DM_MEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_MEDSOS->editAttributes() ?>>
        <?= $Page->DM_MEDSOS->selectOptionListHtml("x{$Page->RowIndex}_DM_MEDSOS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_MEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_MEDSOS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_MEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_MEDSOS", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MEDSOS">
<span<?= $Page->DM_MEDSOS->viewAttributes() ?>>
<?= $Page->DM_MEDSOS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_MEDSOS">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MEDSOS->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MEDSOS">
    <select
        id="x<?= $Page->RowIndex ?>_DM_MEDSOS"
        name="x<?= $Page->RowIndex ?>_DM_MEDSOS"
        class="form-control ew-select<?= $Page->DM_MEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MEDSOS"
        data-value-separator="<?= $Page->DM_MEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_MEDSOS->editAttributes() ?>>
        <?= $Page->DM_MEDSOS->selectOptionListHtml("x{$Page->RowIndex}_DM_MEDSOS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_MEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_MEDSOS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_MEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_MEDSOS", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MEDSOS">
<span<?= $Page->DM_MEDSOS->viewAttributes() ?>>
<?= $Page->DM_MEDSOS->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_MP->Visible) { // DM_MP ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_MP"><?= $Page->renderSort($Page->DM_MP) ?></span></td>
            <td <?= $Page->DM_MP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MP">
    <select
        id="x<?= $Page->RowIndex ?>_DM_MP"
        name="x<?= $Page->RowIndex ?>_DM_MP"
        class="form-control ew-select<?= $Page->DM_MP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MP"
        data-value-separator="<?= $Page->DM_MP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MP->getPlaceHolder()) ?>"
        <?= $Page->DM_MP->editAttributes() ?>>
        <?= $Page->DM_MP->selectOptionListHtml("x{$Page->RowIndex}_DM_MP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_MP->getErrorMessage() ?></div>
<?= $Page->DM_MP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_MP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_MP", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MP">
<span<?= $Page->DM_MP->viewAttributes() ?>>
<?= $Page->DM_MP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_MP">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MP->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MP">
    <select
        id="x<?= $Page->RowIndex ?>_DM_MP"
        name="x<?= $Page->RowIndex ?>_DM_MP"
        class="form-control ew-select<?= $Page->DM_MP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MP"
        data-value-separator="<?= $Page->DM_MP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MP->getPlaceHolder()) ?>"
        <?= $Page->DM_MP->editAttributes() ?>>
        <?= $Page->DM_MP->selectOptionListHtml("x{$Page->RowIndex}_DM_MP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_MP->getErrorMessage() ?></div>
<?= $Page->DM_MP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_MP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_MP", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_MP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_MP">
<span<?= $Page->DM_MP->viewAttributes() ?>>
<?= $Page->DM_MP->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_GMB"><?= $Page->renderSort($Page->DM_GMB) ?></span></td>
            <td <?= $Page->DM_GMB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GMB">
    <select
        id="x<?= $Page->RowIndex ?>_DM_GMB"
        name="x<?= $Page->RowIndex ?>_DM_GMB"
        class="form-control ew-select<?= $Page->DM_GMB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GMB"
        data-value-separator="<?= $Page->DM_GMB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GMB->getPlaceHolder()) ?>"
        <?= $Page->DM_GMB->editAttributes() ?>>
        <?= $Page->DM_GMB->selectOptionListHtml("x{$Page->RowIndex}_DM_GMB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_GMB->getErrorMessage() ?></div>
<?= $Page->DM_GMB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_GMB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_GMB", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GMB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GMB">
<span<?= $Page->DM_GMB->viewAttributes() ?>>
<?= $Page->DM_GMB->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_GMB">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GMB->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GMB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GMB">
    <select
        id="x<?= $Page->RowIndex ?>_DM_GMB"
        name="x<?= $Page->RowIndex ?>_DM_GMB"
        class="form-control ew-select<?= $Page->DM_GMB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GMB"
        data-value-separator="<?= $Page->DM_GMB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GMB->getPlaceHolder()) ?>"
        <?= $Page->DM_GMB->editAttributes() ?>>
        <?= $Page->DM_GMB->selectOptionListHtml("x{$Page->RowIndex}_DM_GMB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_GMB->getErrorMessage() ?></div>
<?= $Page->DM_GMB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_GMB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_GMB", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GMB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GMB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GMB">
<span<?= $Page->DM_GMB->viewAttributes() ?>>
<?= $Page->DM_GMB->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_WEB"><?= $Page->renderSort($Page->DM_WEB) ?></span></td>
            <td <?= $Page->DM_WEB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_WEB">
    <select
        id="x<?= $Page->RowIndex ?>_DM_WEB"
        name="x<?= $Page->RowIndex ?>_DM_WEB"
        class="form-control ew-select<?= $Page->DM_WEB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_WEB"
        data-value-separator="<?= $Page->DM_WEB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_WEB->getPlaceHolder()) ?>"
        <?= $Page->DM_WEB->editAttributes() ?>>
        <?= $Page->DM_WEB->selectOptionListHtml("x{$Page->RowIndex}_DM_WEB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_WEB->getErrorMessage() ?></div>
<?= $Page->DM_WEB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_WEB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_WEB", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_WEB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_WEB">
<span<?= $Page->DM_WEB->viewAttributes() ?>>
<?= $Page->DM_WEB->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_WEB">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_WEB->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_WEB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_WEB">
    <select
        id="x<?= $Page->RowIndex ?>_DM_WEB"
        name="x<?= $Page->RowIndex ?>_DM_WEB"
        class="form-control ew-select<?= $Page->DM_WEB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_WEB"
        data-value-separator="<?= $Page->DM_WEB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_WEB->getPlaceHolder()) ?>"
        <?= $Page->DM_WEB->editAttributes() ?>>
        <?= $Page->DM_WEB->selectOptionListHtml("x{$Page->RowIndex}_DM_WEB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_WEB->getErrorMessage() ?></div>
<?= $Page->DM_WEB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_WEB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_WEB", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_WEB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_WEB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_WEB">
<span<?= $Page->DM_WEB->viewAttributes() ?>>
<?= $Page->DM_WEB->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_UPDATEMEDSOS"><?= $Page->renderSort($Page->DM_UPDATEMEDSOS) ?></span></td>
            <td <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEMEDSOS">
    <select
        id="x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        name="x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        class="form-control ew-select<?= $Page->DM_UPDATEMEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEMEDSOS"
        data-value-separator="<?= $Page->DM_UPDATEMEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEMEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEMEDSOS->editAttributes() ?>>
        <?= $Page->DM_UPDATEMEDSOS->selectOptionListHtml("x{$Page->RowIndex}_DM_UPDATEMEDSOS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEMEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEMEDSOS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_UPDATEMEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEMEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEMEDSOS">
<span<?= $Page->DM_UPDATEMEDSOS->viewAttributes() ?>>
<?= $Page->DM_UPDATEMEDSOS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_UPDATEMEDSOS">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEMEDSOS->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEMEDSOS">
    <select
        id="x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        name="x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        class="form-control ew-select<?= $Page->DM_UPDATEMEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEMEDSOS"
        data-value-separator="<?= $Page->DM_UPDATEMEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEMEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEMEDSOS->editAttributes() ?>>
        <?= $Page->DM_UPDATEMEDSOS->selectOptionListHtml("x{$Page->RowIndex}_DM_UPDATEMEDSOS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEMEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEMEDSOS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_UPDATEMEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEMEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEMEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEMEDSOS">
<span<?= $Page->DM_UPDATEMEDSOS->viewAttributes() ?>>
<?= $Page->DM_UPDATEMEDSOS->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_UPDATEWEBSITE"><?= $Page->renderSort($Page->DM_UPDATEWEBSITE) ?></span></td>
            <td <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEWEBSITE">
    <select
        id="x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        name="x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        class="form-control ew-select<?= $Page->DM_UPDATEWEBSITE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEWEBSITE"
        data-value-separator="<?= $Page->DM_UPDATEWEBSITE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEWEBSITE->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEWEBSITE->editAttributes() ?>>
        <?= $Page->DM_UPDATEWEBSITE->selectOptionListHtml("x{$Page->RowIndex}_DM_UPDATEWEBSITE") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEWEBSITE->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEWEBSITE->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_UPDATEWEBSITE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEWEBSITE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEWEBSITE">
<span<?= $Page->DM_UPDATEWEBSITE->viewAttributes() ?>>
<?= $Page->DM_UPDATEWEBSITE->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_UPDATEWEBSITE">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEWEBSITE->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEWEBSITE">
    <select
        id="x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        name="x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        class="form-control ew-select<?= $Page->DM_UPDATEWEBSITE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEWEBSITE"
        data-value-separator="<?= $Page->DM_UPDATEWEBSITE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEWEBSITE->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEWEBSITE->editAttributes() ?>>
        <?= $Page->DM_UPDATEWEBSITE->selectOptionListHtml("x{$Page->RowIndex}_DM_UPDATEWEBSITE") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEWEBSITE->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEWEBSITE->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_UPDATEWEBSITE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_UPDATEWEBSITE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEWEBSITE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_UPDATEWEBSITE">
<span<?= $Page->DM_UPDATEWEBSITE->viewAttributes() ?>>
<?= $Page->DM_UPDATEWEBSITE->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_GOOGLEINDEX"><?= $Page->renderSort($Page->DM_GOOGLEINDEX) ?></span></td>
            <td <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GOOGLEINDEX">
    <select
        id="x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        name="x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        class="form-control ew-select<?= $Page->DM_GOOGLEINDEX->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GOOGLEINDEX"
        data-value-separator="<?= $Page->DM_GOOGLEINDEX->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GOOGLEINDEX->getPlaceHolder()) ?>"
        <?= $Page->DM_GOOGLEINDEX->editAttributes() ?>>
        <?= $Page->DM_GOOGLEINDEX->selectOptionListHtml("x{$Page->RowIndex}_DM_GOOGLEINDEX") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_GOOGLEINDEX->getErrorMessage() ?></div>
<?= $Page->DM_GOOGLEINDEX->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_GOOGLEINDEX") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GOOGLEINDEX.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GOOGLEINDEX">
<span<?= $Page->DM_GOOGLEINDEX->viewAttributes() ?>>
<?= $Page->DM_GOOGLEINDEX->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_GOOGLEINDEX">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GOOGLEINDEX->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GOOGLEINDEX">
    <select
        id="x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        name="x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        class="form-control ew-select<?= $Page->DM_GOOGLEINDEX->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GOOGLEINDEX"
        data-value-separator="<?= $Page->DM_GOOGLEINDEX->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GOOGLEINDEX->getPlaceHolder()) ?>"
        <?= $Page->DM_GOOGLEINDEX->editAttributes() ?>>
        <?= $Page->DM_GOOGLEINDEX->selectOptionListHtml("x{$Page->RowIndex}_DM_GOOGLEINDEX") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_GOOGLEINDEX->getErrorMessage() ?></div>
<?= $Page->DM_GOOGLEINDEX->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_GOOGLEINDEX") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_GOOGLEINDEX", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GOOGLEINDEX.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_GOOGLEINDEX">
<span<?= $Page->DM_GOOGLEINDEX->viewAttributes() ?>>
<?= $Page->DM_GOOGLEINDEX->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekdigimark_DM_IKLANBERBAYAR"><?= $Page->renderSort($Page->DM_IKLANBERBAYAR) ?></span></td>
            <td <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_IKLANBERBAYAR">
    <select
        id="x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        name="x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        class="form-control ew-select<?= $Page->DM_IKLANBERBAYAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_IKLANBERBAYAR"
        data-value-separator="<?= $Page->DM_IKLANBERBAYAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_IKLANBERBAYAR->getPlaceHolder()) ?>"
        <?= $Page->DM_IKLANBERBAYAR->editAttributes() ?>>
        <?= $Page->DM_IKLANBERBAYAR->selectOptionListHtml("x{$Page->RowIndex}_DM_IKLANBERBAYAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_IKLANBERBAYAR->getErrorMessage() ?></div>
<?= $Page->DM_IKLANBERBAYAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_IKLANBERBAYAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_IKLANBERBAYAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_IKLANBERBAYAR">
<span<?= $Page->DM_IKLANBERBAYAR->viewAttributes() ?>>
<?= $Page->DM_IKLANBERBAYAR->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekdigimark_DM_IKLANBERBAYAR">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_IKLANBERBAYAR->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_IKLANBERBAYAR">
    <select
        id="x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        name="x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        class="form-control ew-select<?= $Page->DM_IKLANBERBAYAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_IKLANBERBAYAR"
        data-value-separator="<?= $Page->DM_IKLANBERBAYAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_IKLANBERBAYAR->getPlaceHolder()) ?>"
        <?= $Page->DM_IKLANBERBAYAR->editAttributes() ?>>
        <?= $Page->DM_IKLANBERBAYAR->selectOptionListHtml("x{$Page->RowIndex}_DM_IKLANBERBAYAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->DM_IKLANBERBAYAR->getErrorMessage() ?></div>
<?= $Page->DM_IKLANBERBAYAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_DM_IKLANBERBAYAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR", selectId: "umkm_aspekdigimark_x<?= $Page->RowIndex ?>_DM_IKLANBERBAYAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_IKLANBERBAYAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekdigimark_DM_IKLANBERBAYAR">
<span<?= $Page->DM_IKLANBERBAYAR->viewAttributes() ?>>
<?= $Page->DM_IKLANBERBAYAR->getViewValue() ?></span>
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
loadjs.ready(["fumkm_aspekdigimarklist","load"], function () {
    fumkm_aspekdigimarklist.updateLists(<?= $Page->RowIndex ?>);
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
    ew.addEventHandlers("umkm_aspekdigimark");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
