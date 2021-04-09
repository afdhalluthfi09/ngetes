<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksilist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekproduksilist = currentForm = new ew.Form("fumkm_aspekproduksilist", "list");
    fumkm_aspekproduksilist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekproduksi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekproduksi)
        ew.vars.tables.umkm_aspekproduksi = currentTable;
    fumkm_aspekproduksilist.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["PROD_FREKUENSIPRODUKSI", [fields.PROD_FREKUENSIPRODUKSI.visible && fields.PROD_FREKUENSIPRODUKSI.required ? ew.Validators.required(fields.PROD_FREKUENSIPRODUKSI.caption) : null], fields.PROD_FREKUENSIPRODUKSI.isInvalid],
        ["PROD_KAPASITAS", [fields.PROD_KAPASITAS.visible && fields.PROD_KAPASITAS.required ? ew.Validators.required(fields.PROD_KAPASITAS.caption) : null], fields.PROD_KAPASITAS.isInvalid],
        ["PROD_KEAMANANPANGAN", [fields.PROD_KEAMANANPANGAN.visible && fields.PROD_KEAMANANPANGAN.required ? ew.Validators.required(fields.PROD_KEAMANANPANGAN.caption) : null], fields.PROD_KEAMANANPANGAN.isInvalid],
        ["PROD_SNI", [fields.PROD_SNI.visible && fields.PROD_SNI.required ? ew.Validators.required(fields.PROD_SNI.caption) : null], fields.PROD_SNI.isInvalid],
        ["PROD_KEMASAN", [fields.PROD_KEMASAN.visible && fields.PROD_KEMASAN.required ? ew.Validators.required(fields.PROD_KEMASAN.caption) : null], fields.PROD_KEMASAN.isInvalid],
        ["PROD_KETERSEDIAANBAHANBAKU", [fields.PROD_KETERSEDIAANBAHANBAKU.visible && fields.PROD_KETERSEDIAANBAHANBAKU.required ? ew.Validators.required(fields.PROD_KETERSEDIAANBAHANBAKU.caption) : null], fields.PROD_KETERSEDIAANBAHANBAKU.isInvalid],
        ["PROD_ALATPRODUKSI", [fields.PROD_ALATPRODUKSI.visible && fields.PROD_ALATPRODUKSI.required ? ew.Validators.required(fields.PROD_ALATPRODUKSI.caption) : null], fields.PROD_ALATPRODUKSI.isInvalid],
        ["PROD_GUDANGPENYIMPAN", [fields.PROD_GUDANGPENYIMPAN.visible && fields.PROD_GUDANGPENYIMPAN.required ? ew.Validators.required(fields.PROD_GUDANGPENYIMPAN.caption) : null], fields.PROD_GUDANGPENYIMPAN.isInvalid],
        ["PROD_LAYOUTPRODUKSI", [fields.PROD_LAYOUTPRODUKSI.visible && fields.PROD_LAYOUTPRODUKSI.required ? ew.Validators.required(fields.PROD_LAYOUTPRODUKSI.caption) : null], fields.PROD_LAYOUTPRODUKSI.isInvalid],
        ["PROD_SOP", [fields.PROD_SOP.visible && fields.PROD_SOP.required ? ew.Validators.required(fields.PROD_SOP.caption) : null], fields.PROD_SOP.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspekproduksilist,
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
    fumkm_aspekproduksilist.validate = function () {
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
    fumkm_aspekproduksilist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekproduksilist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekproduksilist.lists.PROD_FREKUENSIPRODUKSI = <?= $Page->PROD_FREKUENSIPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_KAPASITAS = <?= $Page->PROD_KAPASITAS->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_KEAMANANPANGAN = <?= $Page->PROD_KEAMANANPANGAN->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_SNI = <?= $Page->PROD_SNI->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_KEMASAN = <?= $Page->PROD_KEMASAN->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_KETERSEDIAANBAHANBAKU = <?= $Page->PROD_KETERSEDIAANBAHANBAKU->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_ALATPRODUKSI = <?= $Page->PROD_ALATPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_GUDANGPENYIMPAN = <?= $Page->PROD_GUDANGPENYIMPAN->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_LAYOUTPRODUKSI = <?= $Page->PROD_LAYOUTPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksilist.lists.PROD_SOP = <?= $Page->PROD_SOP->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekproduksilist");
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
<form name="fumkm_aspekproduksilist" id="fumkm_aspekproduksilist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekproduksi", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_NIK" style="white-space: nowrap;"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI"><?= $Page->renderSort($Page->PROD_FREKUENSIPRODUKSI) ?></span></td>
            <td <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_FREKUENSIPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_FREKUENSIPRODUKSI"
        data-value-separator="<?= $Page->PROD_FREKUENSIPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_FREKUENSIPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_FREKUENSIPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_FREKUENSIPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_FREKUENSIPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_FREKUENSIPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_FREKUENSIPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_FREKUENSIPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_FREKUENSIPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
<span<?= $Page->PROD_FREKUENSIPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_FREKUENSIPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_FREKUENSIPRODUKSI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_FREKUENSIPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_FREKUENSIPRODUKSI"
        data-value-separator="<?= $Page->PROD_FREKUENSIPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_FREKUENSIPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_FREKUENSIPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_FREKUENSIPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_FREKUENSIPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_FREKUENSIPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_FREKUENSIPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_FREKUENSIPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_FREKUENSIPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_FREKUENSIPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
<span<?= $Page->PROD_FREKUENSIPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_FREKUENSIPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_KAPASITAS"><?= $Page->renderSort($Page->PROD_KAPASITAS) ?></span></td>
            <td <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KAPASITAS">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        name="x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        class="form-control ew-select<?= $Page->PROD_KAPASITAS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KAPASITAS"
        data-value-separator="<?= $Page->PROD_KAPASITAS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KAPASITAS->getPlaceHolder()) ?>"
        <?= $Page->PROD_KAPASITAS->editAttributes() ?>>
        <?= $Page->PROD_KAPASITAS->selectOptionListHtml("x{$Page->RowIndex}_PROD_KAPASITAS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KAPASITAS->getErrorMessage() ?></div>
<?= $Page->PROD_KAPASITAS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KAPASITAS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KAPASITAS", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KAPASITAS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KAPASITAS">
<span<?= $Page->PROD_KAPASITAS->viewAttributes() ?>>
<?= $Page->PROD_KAPASITAS->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_KAPASITAS">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KAPASITAS->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KAPASITAS">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        name="x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        class="form-control ew-select<?= $Page->PROD_KAPASITAS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KAPASITAS"
        data-value-separator="<?= $Page->PROD_KAPASITAS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KAPASITAS->getPlaceHolder()) ?>"
        <?= $Page->PROD_KAPASITAS->editAttributes() ?>>
        <?= $Page->PROD_KAPASITAS->selectOptionListHtml("x{$Page->RowIndex}_PROD_KAPASITAS") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KAPASITAS->getErrorMessage() ?></div>
<?= $Page->PROD_KAPASITAS->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KAPASITAS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KAPASITAS", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KAPASITAS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KAPASITAS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KAPASITAS">
<span<?= $Page->PROD_KAPASITAS->viewAttributes() ?>>
<?= $Page->PROD_KAPASITAS->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_KEAMANANPANGAN"><?= $Page->renderSort($Page->PROD_KEAMANANPANGAN) ?></span></td>
            <td <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEAMANANPANGAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        name="x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        class="form-control ew-select<?= $Page->PROD_KEAMANANPANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEAMANANPANGAN"
        data-value-separator="<?= $Page->PROD_KEAMANANPANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEAMANANPANGAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEAMANANPANGAN->editAttributes() ?>>
        <?= $Page->PROD_KEAMANANPANGAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_KEAMANANPANGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KEAMANANPANGAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEAMANANPANGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KEAMANANPANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEAMANANPANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEAMANANPANGAN">
<span<?= $Page->PROD_KEAMANANPANGAN->viewAttributes() ?>>
<?= $Page->PROD_KEAMANANPANGAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_KEAMANANPANGAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEAMANANPANGAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEAMANANPANGAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        name="x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        class="form-control ew-select<?= $Page->PROD_KEAMANANPANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEAMANANPANGAN"
        data-value-separator="<?= $Page->PROD_KEAMANANPANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEAMANANPANGAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEAMANANPANGAN->editAttributes() ?>>
        <?= $Page->PROD_KEAMANANPANGAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_KEAMANANPANGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KEAMANANPANGAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEAMANANPANGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KEAMANANPANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEAMANANPANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEAMANANPANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEAMANANPANGAN">
<span<?= $Page->PROD_KEAMANANPANGAN->viewAttributes() ?>>
<?= $Page->PROD_KEAMANANPANGAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_SNI"><?= $Page->renderSort($Page->PROD_SNI) ?></span></td>
            <td <?= $Page->PROD_SNI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SNI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_SNI"
        name="x<?= $Page->RowIndex ?>_PROD_SNI"
        class="form-control ew-select<?= $Page->PROD_SNI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SNI"
        data-value-separator="<?= $Page->PROD_SNI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SNI->getPlaceHolder()) ?>"
        <?= $Page->PROD_SNI->editAttributes() ?>>
        <?= $Page->PROD_SNI->selectOptionListHtml("x{$Page->RowIndex}_PROD_SNI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_SNI->getErrorMessage() ?></div>
<?= $Page->PROD_SNI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_SNI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_SNI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SNI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SNI">
<span<?= $Page->PROD_SNI->viewAttributes() ?>>
<?= $Page->PROD_SNI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_SNI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SNI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SNI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SNI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_SNI"
        name="x<?= $Page->RowIndex ?>_PROD_SNI"
        class="form-control ew-select<?= $Page->PROD_SNI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SNI"
        data-value-separator="<?= $Page->PROD_SNI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SNI->getPlaceHolder()) ?>"
        <?= $Page->PROD_SNI->editAttributes() ?>>
        <?= $Page->PROD_SNI->selectOptionListHtml("x{$Page->RowIndex}_PROD_SNI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_SNI->getErrorMessage() ?></div>
<?= $Page->PROD_SNI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_SNI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_SNI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SNI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SNI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SNI">
<span<?= $Page->PROD_SNI->viewAttributes() ?>>
<?= $Page->PROD_SNI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_KEMASAN"><?= $Page->renderSort($Page->PROD_KEMASAN) ?></span></td>
            <td <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEMASAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        name="x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        class="form-control ew-select<?= $Page->PROD_KEMASAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEMASAN"
        data-value-separator="<?= $Page->PROD_KEMASAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEMASAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEMASAN->editAttributes() ?>>
        <?= $Page->PROD_KEMASAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_KEMASAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KEMASAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEMASAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KEMASAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KEMASAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEMASAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEMASAN">
<span<?= $Page->PROD_KEMASAN->viewAttributes() ?>>
<?= $Page->PROD_KEMASAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_KEMASAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEMASAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEMASAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        name="x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        class="form-control ew-select<?= $Page->PROD_KEMASAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEMASAN"
        data-value-separator="<?= $Page->PROD_KEMASAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEMASAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEMASAN->editAttributes() ?>>
        <?= $Page->PROD_KEMASAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_KEMASAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KEMASAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEMASAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KEMASAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KEMASAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KEMASAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEMASAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KEMASAN">
<span<?= $Page->PROD_KEMASAN->viewAttributes() ?>>
<?= $Page->PROD_KEMASAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU"><?= $Page->renderSort($Page->PROD_KETERSEDIAANBAHANBAKU) ?></span></td>
            <td <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        name="x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        class="form-control ew-select<?= $Page->PROD_KETERSEDIAANBAHANBAKU->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KETERSEDIAANBAHANBAKU"
        data-value-separator="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KETERSEDIAANBAHANBAKU->getPlaceHolder()) ?>"
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->editAttributes() ?>>
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->selectOptionListHtml("x{$Page->RowIndex}_PROD_KETERSEDIAANBAHANBAKU") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->getErrorMessage() ?></div>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KETERSEDIAANBAHANBAKU") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KETERSEDIAANBAHANBAKU.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
<span<?= $Page->PROD_KETERSEDIAANBAHANBAKU->viewAttributes() ?>>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        name="x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        class="form-control ew-select<?= $Page->PROD_KETERSEDIAANBAHANBAKU->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KETERSEDIAANBAHANBAKU"
        data-value-separator="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KETERSEDIAANBAHANBAKU->getPlaceHolder()) ?>"
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->editAttributes() ?>>
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->selectOptionListHtml("x{$Page->RowIndex}_PROD_KETERSEDIAANBAHANBAKU") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->getErrorMessage() ?></div>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_KETERSEDIAANBAHANBAKU") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_KETERSEDIAANBAHANBAKU", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KETERSEDIAANBAHANBAKU.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
<span<?= $Page->PROD_KETERSEDIAANBAHANBAKU->viewAttributes() ?>>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_ALATPRODUKSI"><?= $Page->renderSort($Page->PROD_ALATPRODUKSI) ?></span></td>
            <td <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_ALATPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_ALATPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_ALATPRODUKSI"
        data-value-separator="<?= $Page->PROD_ALATPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_ALATPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_ALATPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_ALATPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_ALATPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_ALATPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_ALATPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_ALATPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_ALATPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_ALATPRODUKSI">
<span<?= $Page->PROD_ALATPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_ALATPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_ALATPRODUKSI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_ALATPRODUKSI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_ALATPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_ALATPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_ALATPRODUKSI"
        data-value-separator="<?= $Page->PROD_ALATPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_ALATPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_ALATPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_ALATPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_ALATPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_ALATPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_ALATPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_ALATPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_ALATPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_ALATPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_ALATPRODUKSI">
<span<?= $Page->PROD_ALATPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_ALATPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_GUDANGPENYIMPAN"><?= $Page->renderSort($Page->PROD_GUDANGPENYIMPAN) ?></span></td>
            <td <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        name="x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        class="form-control ew-select<?= $Page->PROD_GUDANGPENYIMPAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_GUDANGPENYIMPAN"
        data-value-separator="<?= $Page->PROD_GUDANGPENYIMPAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_GUDANGPENYIMPAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_GUDANGPENYIMPAN->editAttributes() ?>>
        <?= $Page->PROD_GUDANGPENYIMPAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_GUDANGPENYIMPAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_GUDANGPENYIMPAN->getErrorMessage() ?></div>
<?= $Page->PROD_GUDANGPENYIMPAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_GUDANGPENYIMPAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_GUDANGPENYIMPAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
<span<?= $Page->PROD_GUDANGPENYIMPAN->viewAttributes() ?>>
<?= $Page->PROD_GUDANGPENYIMPAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_GUDANGPENYIMPAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        name="x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        class="form-control ew-select<?= $Page->PROD_GUDANGPENYIMPAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_GUDANGPENYIMPAN"
        data-value-separator="<?= $Page->PROD_GUDANGPENYIMPAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_GUDANGPENYIMPAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_GUDANGPENYIMPAN->editAttributes() ?>>
        <?= $Page->PROD_GUDANGPENYIMPAN->selectOptionListHtml("x{$Page->RowIndex}_PROD_GUDANGPENYIMPAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_GUDANGPENYIMPAN->getErrorMessage() ?></div>
<?= $Page->PROD_GUDANGPENYIMPAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_GUDANGPENYIMPAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_GUDANGPENYIMPAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_GUDANGPENYIMPAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
<span<?= $Page->PROD_GUDANGPENYIMPAN->viewAttributes() ?>>
<?= $Page->PROD_GUDANGPENYIMPAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_LAYOUTPRODUKSI"><?= $Page->renderSort($Page->PROD_LAYOUTPRODUKSI) ?></span></td>
            <td <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_LAYOUTPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_LAYOUTPRODUKSI"
        data-value-separator="<?= $Page->PROD_LAYOUTPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_LAYOUTPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_LAYOUTPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_LAYOUTPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_LAYOUTPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_LAYOUTPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_LAYOUTPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_LAYOUTPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_LAYOUTPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
<span<?= $Page->PROD_LAYOUTPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_LAYOUTPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_LAYOUTPRODUKSI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        name="x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_LAYOUTPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_LAYOUTPRODUKSI"
        data-value-separator="<?= $Page->PROD_LAYOUTPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_LAYOUTPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_LAYOUTPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_LAYOUTPRODUKSI->selectOptionListHtml("x{$Page->RowIndex}_PROD_LAYOUTPRODUKSI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_LAYOUTPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_LAYOUTPRODUKSI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_LAYOUTPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_LAYOUTPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_LAYOUTPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
<span<?= $Page->PROD_LAYOUTPRODUKSI->viewAttributes() ?>>
<?= $Page->PROD_LAYOUTPRODUKSI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekproduksi_PROD_SOP"><?= $Page->renderSort($Page->PROD_SOP) ?></span></td>
            <td <?= $Page->PROD_SOP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SOP">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_SOP"
        name="x<?= $Page->RowIndex ?>_PROD_SOP"
        class="form-control ew-select<?= $Page->PROD_SOP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SOP"
        data-value-separator="<?= $Page->PROD_SOP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SOP->getPlaceHolder()) ?>"
        <?= $Page->PROD_SOP->editAttributes() ?>>
        <?= $Page->PROD_SOP->selectOptionListHtml("x{$Page->RowIndex}_PROD_SOP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_SOP->getErrorMessage() ?></div>
<?= $Page->PROD_SOP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_SOP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_SOP", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SOP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SOP">
<span<?= $Page->PROD_SOP->viewAttributes() ?>>
<?= $Page->PROD_SOP->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekproduksi_PROD_SOP">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SOP->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SOP->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SOP">
    <select
        id="x<?= $Page->RowIndex ?>_PROD_SOP"
        name="x<?= $Page->RowIndex ?>_PROD_SOP"
        class="form-control ew-select<?= $Page->PROD_SOP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SOP"
        data-value-separator="<?= $Page->PROD_SOP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SOP->getPlaceHolder()) ?>"
        <?= $Page->PROD_SOP->editAttributes() ?>>
        <?= $Page->PROD_SOP->selectOptionListHtml("x{$Page->RowIndex}_PROD_SOP") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->PROD_SOP->getErrorMessage() ?></div>
<?= $Page->PROD_SOP->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_PROD_SOP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP']"),
        options = { name: "x<?= $Page->RowIndex ?>_PROD_SOP", selectId: "umkm_aspekproduksi_x<?= $Page->RowIndex ?>_PROD_SOP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SOP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekproduksi_PROD_SOP">
<span<?= $Page->PROD_SOP->viewAttributes() ?>>
<?= $Page->PROD_SOP->getViewValue() ?></span>
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
loadjs.ready(["fumkm_aspekproduksilist","load"], function () {
    fumkm_aspekproduksilist.updateLists(<?= $Page->RowIndex ?>);
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
    ew.addEventHandlers("umkm_aspekproduksi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
