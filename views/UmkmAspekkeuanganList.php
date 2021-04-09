<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuanganlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekkeuanganlist = currentForm = new ew.Form("fumkm_aspekkeuanganlist", "list");
    fumkm_aspekkeuanganlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekkeuangan)
        ew.vars.tables.umkm_aspekkeuangan = currentTable;
    fumkm_aspekkeuanganlist.addFields([
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
        var f = fumkm_aspekkeuanganlist,
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
    fumkm_aspekkeuanganlist.validate = function () {
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
    fumkm_aspekkeuanganlist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekkeuanganlist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekkeuanganlist.lists.KEU_USAHAUTAMA = <?= $Page->KEU_USAHAUTAMA->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_PENGELOLAAN = <?= $Page->KEU_PENGELOLAAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_NOTA = <?= $Page->KEU_NOTA->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_PENCATATAN = <?= $Page->KEU_PENCATATAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_LAPORAN = <?= $Page->KEU_LAPORAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_UTANGMODAL = <?= $Page->KEU_UTANGMODAL->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_CATATNASET = <?= $Page->KEU_CATATNASET->toClientList($Page) ?>;
    fumkm_aspekkeuanganlist.lists.KEU_NONTUNAI = <?= $Page->KEU_NONTUNAI->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekkeuanganlist");
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
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "umkm_datadiri") {
    if ($Page->MasterRecordExists) {
        include_once "views/UmkmDatadiriMaster.php";
    }
}
?>
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
<form name="fumkm_aspekkeuanganlist" id="fumkm_aspekkeuanganlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan">
<?php if ($Page->getCurrentMasterTable() == "umkm_datadiri" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="umkm_datadiri">
<input type="hidden" name="fk_NIK" value="<?= HtmlEncode($Page->NIK->getSessionValue()) ?>">
<?php } ?>
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekkeuangan", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_NIK"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_USAHAUTAMA"><?= $Page->renderSort($Page->KEU_USAHAUTAMA) ?></span></td>
            <td <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        name="x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Page->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Page->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Page->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Page->KEU_USAHAUTAMA->selectOptionListHtml("x{$Page->RowIndex}_KEU_USAHAUTAMA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Page->KEU_USAHAUTAMA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
<span<?= $Page->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Page->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_USAHAUTAMA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_USAHAUTAMA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        name="x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Page->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Page->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Page->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Page->KEU_USAHAUTAMA->selectOptionListHtml("x{$Page->RowIndex}_KEU_USAHAUTAMA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Page->KEU_USAHAUTAMA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_USAHAUTAMA">
<span<?= $Page->KEU_USAHAUTAMA->viewAttributes() ?>>
<?= $Page->KEU_USAHAUTAMA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_PENGELOLAAN"><?= $Page->renderSort($Page->KEU_PENGELOLAAN) ?></span></td>
            <td <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        name="x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Page->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Page->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Page->KEU_PENGELOLAAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_PENGELOLAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENGELOLAAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
<span<?= $Page->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Page->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_PENGELOLAAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENGELOLAAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        name="x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Page->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Page->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Page->KEU_PENGELOLAAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_PENGELOLAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENGELOLAAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENGELOLAAN">
<span<?= $Page->KEU_PENGELOLAAN->viewAttributes() ?>>
<?= $Page->KEU_PENGELOLAAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_NOTA"><?= $Page->renderSort($Page->KEU_NOTA) ?></span></td>
            <td <?= $Page->KEU_NOTA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_NOTA"
        name="x<?= $Page->RowIndex ?>_KEU_NOTA"
        class="form-control ew-select<?= $Page->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Page->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Page->KEU_NOTA->editAttributes() ?>>
        <?= $Page->KEU_NOTA->selectOptionListHtml("x{$Page->RowIndex}_KEU_NOTA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_NOTA->getErrorMessage() ?></div>
<?= $Page->KEU_NOTA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_NOTA", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
<span<?= $Page->KEU_NOTA->viewAttributes() ?>>
<?= $Page->KEU_NOTA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_NOTA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NOTA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NOTA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_NOTA"
        name="x<?= $Page->RowIndex ?>_KEU_NOTA"
        class="form-control ew-select<?= $Page->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Page->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Page->KEU_NOTA->editAttributes() ?>>
        <?= $Page->KEU_NOTA->selectOptionListHtml("x{$Page->RowIndex}_KEU_NOTA") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_NOTA->getErrorMessage() ?></div>
<?= $Page->KEU_NOTA->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_NOTA", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NOTA">
<span<?= $Page->KEU_NOTA->viewAttributes() ?>>
<?= $Page->KEU_NOTA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_PENCATATAN"><?= $Page->renderSort($Page->KEU_PENCATATAN) ?></span></td>
            <td <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        name="x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        class="form-control ew-select<?= $Page->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Page->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Page->KEU_PENCATATAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_PENCATATAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENCATATAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
<span<?= $Page->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Page->KEU_PENCATATAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_PENCATATAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENCATATAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        name="x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        class="form-control ew-select<?= $Page->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Page->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Page->KEU_PENCATATAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_PENCATATAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENCATATAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_PENCATATAN">
<span<?= $Page->KEU_PENCATATAN->viewAttributes() ?>>
<?= $Page->KEU_PENCATATAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_LAPORAN"><?= $Page->renderSort($Page->KEU_LAPORAN) ?></span></td>
            <td <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        name="x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        class="form-control ew-select<?= $Page->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Page->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_LAPORAN->editAttributes() ?>>
        <?= $Page->KEU_LAPORAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_LAPORAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Page->KEU_LAPORAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
<span<?= $Page->KEU_LAPORAN->viewAttributes() ?>>
<?= $Page->KEU_LAPORAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_LAPORAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_LAPORAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        name="x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        class="form-control ew-select<?= $Page->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Page->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_LAPORAN->editAttributes() ?>>
        <?= $Page->KEU_LAPORAN->selectOptionListHtml("x{$Page->RowIndex}_KEU_LAPORAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Page->KEU_LAPORAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_LAPORAN">
<span<?= $Page->KEU_LAPORAN->viewAttributes() ?>>
<?= $Page->KEU_LAPORAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_UTANGMODAL"><?= $Page->renderSort($Page->KEU_UTANGMODAL) ?></span></td>
            <td <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        name="x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Page->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Page->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Page->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Page->KEU_UTANGMODAL->selectOptionListHtml("x{$Page->RowIndex}_KEU_UTANGMODAL") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Page->KEU_UTANGMODAL->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
<span<?= $Page->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Page->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_UTANGMODAL">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_UTANGMODAL->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        name="x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Page->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Page->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Page->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Page->KEU_UTANGMODAL->selectOptionListHtml("x{$Page->RowIndex}_KEU_UTANGMODAL") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Page->KEU_UTANGMODAL->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_UTANGMODAL">
<span<?= $Page->KEU_UTANGMODAL->viewAttributes() ?>>
<?= $Page->KEU_UTANGMODAL->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_CATATNASET"><?= $Page->renderSort($Page->KEU_CATATNASET) ?></span></td>
            <td <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        name="x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        class="form-control ew-select<?= $Page->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Page->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Page->KEU_CATATNASET->editAttributes() ?>>
        <?= $Page->KEU_CATATNASET->selectOptionListHtml("x{$Page->RowIndex}_KEU_CATATNASET") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Page->KEU_CATATNASET->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
<span<?= $Page->KEU_CATATNASET->viewAttributes() ?>>
<?= $Page->KEU_CATATNASET->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_CATATNASET">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_CATATNASET->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        name="x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        class="form-control ew-select<?= $Page->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Page->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Page->KEU_CATATNASET->editAttributes() ?>>
        <?= $Page->KEU_CATATNASET->selectOptionListHtml("x{$Page->RowIndex}_KEU_CATATNASET") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Page->KEU_CATATNASET->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_CATATNASET">
<span<?= $Page->KEU_CATATNASET->viewAttributes() ?>>
<?= $Page->KEU_CATATNASET->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekkeuangan_KEU_NONTUNAI"><?= $Page->renderSort($Page->KEU_NONTUNAI) ?></span></td>
            <td <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        name="x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        class="form-control ew-select<?= $Page->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Page->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Page->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Page->KEU_NONTUNAI->selectOptionListHtml("x{$Page->RowIndex}_KEU_NONTUNAI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Page->KEU_NONTUNAI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
<span<?= $Page->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Page->KEU_NONTUNAI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekkeuangan_KEU_NONTUNAI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NONTUNAI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        name="x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        class="form-control ew-select<?= $Page->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Page->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Page->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Page->KEU_NONTUNAI->selectOptionListHtml("x{$Page->RowIndex}_KEU_NONTUNAI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Page->KEU_NONTUNAI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI']"),
        options = { name: "x<?= $Page->RowIndex ?>_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x<?= $Page->RowIndex ?>_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekkeuangan_KEU_NONTUNAI">
<span<?= $Page->KEU_NONTUNAI->viewAttributes() ?>>
<?= $Page->KEU_NONTUNAI->getViewValue() ?></span>
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
loadjs.ready(["fumkm_aspekkeuanganlist","load"], function () {
    fumkm_aspekkeuanganlist.updateLists(<?= $Page->RowIndex ?>);
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
    ew.addEventHandlers("umkm_aspekkeuangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
