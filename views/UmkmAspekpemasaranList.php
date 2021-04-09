<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasaranlist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_aspekpemasaranlist = currentForm = new ew.Form("fumkm_aspekpemasaranlist", "list");
    fumkm_aspekpemasaranlist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekpemasaran")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekpemasaran)
        ew.vars.tables.umkm_aspekpemasaran = currentTable;
    fumkm_aspekpemasaranlist.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["MK_KEUNGGULANPRODUK", [fields.MK_KEUNGGULANPRODUK.visible && fields.MK_KEUNGGULANPRODUK.required ? ew.Validators.required(fields.MK_KEUNGGULANPRODUK.caption) : null], fields.MK_KEUNGGULANPRODUK.isInvalid],
        ["MK_TARGETPASAR", [fields.MK_TARGETPASAR.visible && fields.MK_TARGETPASAR.required ? ew.Validators.required(fields.MK_TARGETPASAR.caption) : null], fields.MK_TARGETPASAR.isInvalid],
        ["MK_KETERSEDIAAN", [fields.MK_KETERSEDIAAN.visible && fields.MK_KETERSEDIAAN.required ? ew.Validators.required(fields.MK_KETERSEDIAAN.caption) : null], fields.MK_KETERSEDIAAN.isInvalid],
        ["MK_LOGO", [fields.MK_LOGO.visible && fields.MK_LOGO.required ? ew.Validators.required(fields.MK_LOGO.caption) : null], fields.MK_LOGO.isInvalid],
        ["MK_HKI", [fields.MK_HKI.visible && fields.MK_HKI.required ? ew.Validators.required(fields.MK_HKI.caption) : null], fields.MK_HKI.isInvalid],
        ["MK_BRANDING", [fields.MK_BRANDING.visible && fields.MK_BRANDING.required ? ew.Validators.required(fields.MK_BRANDING.caption) : null], fields.MK_BRANDING.isInvalid],
        ["MK_COBRANDING", [fields.MK_COBRANDING.visible && fields.MK_COBRANDING.required ? ew.Validators.required(fields.MK_COBRANDING.caption) : null], fields.MK_COBRANDING.isInvalid],
        ["MK_MEDIAOFFLINE", [fields.MK_MEDIAOFFLINE.visible && fields.MK_MEDIAOFFLINE.required ? ew.Validators.required(fields.MK_MEDIAOFFLINE.caption) : null], fields.MK_MEDIAOFFLINE.isInvalid],
        ["MK_RESELLER", [fields.MK_RESELLER.visible && fields.MK_RESELLER.required ? ew.Validators.required(fields.MK_RESELLER.caption) : null], fields.MK_RESELLER.isInvalid],
        ["MK_PASAR", [fields.MK_PASAR.visible && fields.MK_PASAR.required ? ew.Validators.required(fields.MK_PASAR.caption) : null], fields.MK_PASAR.isInvalid],
        ["MK_PELANGGAN", [fields.MK_PELANGGAN.visible && fields.MK_PELANGGAN.required ? ew.Validators.required(fields.MK_PELANGGAN.caption) : null], fields.MK_PELANGGAN.isInvalid],
        ["MK_PAMERANMANDIRI", [fields.MK_PAMERANMANDIRI.visible && fields.MK_PAMERANMANDIRI.required ? ew.Validators.required(fields.MK_PAMERANMANDIRI.caption) : null], fields.MK_PAMERANMANDIRI.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspekpemasaranlist,
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
    fumkm_aspekpemasaranlist.validate = function () {
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
    fumkm_aspekpemasaranlist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekpemasaranlist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekpemasaranlist.lists.MK_KEUNGGULANPRODUK = <?= $Page->MK_KEUNGGULANPRODUK->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_TARGETPASAR = <?= $Page->MK_TARGETPASAR->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_KETERSEDIAAN = <?= $Page->MK_KETERSEDIAAN->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_LOGO = <?= $Page->MK_LOGO->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_HKI = <?= $Page->MK_HKI->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_BRANDING = <?= $Page->MK_BRANDING->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_COBRANDING = <?= $Page->MK_COBRANDING->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_MEDIAOFFLINE = <?= $Page->MK_MEDIAOFFLINE->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_RESELLER = <?= $Page->MK_RESELLER->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_PASAR = <?= $Page->MK_PASAR->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_PELANGGAN = <?= $Page->MK_PELANGGAN->toClientList($Page) ?>;
    fumkm_aspekpemasaranlist.lists.MK_PAMERANMANDIRI = <?= $Page->MK_PAMERANMANDIRI->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekpemasaranlist");
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
<form name="fumkm_aspekpemasaranlist" id="fumkm_aspekpemasaranlist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran">
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
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_aspekpemasaran", "data-rowtype" => $Page->RowType]);

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
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_NIK" style="white-space: nowrap;"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_KEUNGGULANPRODUK"><?= $Page->renderSort($Page->MK_KEUNGGULANPRODUK) ?></span></td>
            <td <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
    <select
        id="x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        name="x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        class="form-control ew-select<?= $Page->MK_KEUNGGULANPRODUK->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KEUNGGULANPRODUK"
        data-value-separator="<?= $Page->MK_KEUNGGULANPRODUK->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KEUNGGULANPRODUK->getPlaceHolder()) ?>"
        <?= $Page->MK_KEUNGGULANPRODUK->editAttributes() ?>>
        <?= $Page->MK_KEUNGGULANPRODUK->selectOptionListHtml("x{$Page->RowIndex}_MK_KEUNGGULANPRODUK") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_KEUNGGULANPRODUK->getErrorMessage() ?></div>
<?= $Page->MK_KEUNGGULANPRODUK->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_KEUNGGULANPRODUK") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KEUNGGULANPRODUK.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
<span<?= $Page->MK_KEUNGGULANPRODUK->viewAttributes() ?>>
<?= $Page->MK_KEUNGGULANPRODUK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KEUNGGULANPRODUK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
    <select
        id="x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        name="x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        class="form-control ew-select<?= $Page->MK_KEUNGGULANPRODUK->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KEUNGGULANPRODUK"
        data-value-separator="<?= $Page->MK_KEUNGGULANPRODUK->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KEUNGGULANPRODUK->getPlaceHolder()) ?>"
        <?= $Page->MK_KEUNGGULANPRODUK->editAttributes() ?>>
        <?= $Page->MK_KEUNGGULANPRODUK->selectOptionListHtml("x{$Page->RowIndex}_MK_KEUNGGULANPRODUK") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_KEUNGGULANPRODUK->getErrorMessage() ?></div>
<?= $Page->MK_KEUNGGULANPRODUK->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_KEUNGGULANPRODUK") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KEUNGGULANPRODUK", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KEUNGGULANPRODUK.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
<span<?= $Page->MK_KEUNGGULANPRODUK->viewAttributes() ?>>
<?= $Page->MK_KEUNGGULANPRODUK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_TARGETPASAR"><?= $Page->renderSort($Page->MK_TARGETPASAR) ?></span></td>
            <td <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_TARGETPASAR">
    <select
        id="x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        name="x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        class="form-control ew-select<?= $Page->MK_TARGETPASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_TARGETPASAR"
        data-value-separator="<?= $Page->MK_TARGETPASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_TARGETPASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_TARGETPASAR->editAttributes() ?>>
        <?= $Page->MK_TARGETPASAR->selectOptionListHtml("x{$Page->RowIndex}_MK_TARGETPASAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_TARGETPASAR->getErrorMessage() ?></div>
<?= $Page->MK_TARGETPASAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_TARGETPASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_TARGETPASAR", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_TARGETPASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_TARGETPASAR">
<span<?= $Page->MK_TARGETPASAR->viewAttributes() ?>>
<?= $Page->MK_TARGETPASAR->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_TARGETPASAR">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_TARGETPASAR->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_TARGETPASAR">
    <select
        id="x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        name="x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        class="form-control ew-select<?= $Page->MK_TARGETPASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_TARGETPASAR"
        data-value-separator="<?= $Page->MK_TARGETPASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_TARGETPASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_TARGETPASAR->editAttributes() ?>>
        <?= $Page->MK_TARGETPASAR->selectOptionListHtml("x{$Page->RowIndex}_MK_TARGETPASAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_TARGETPASAR->getErrorMessage() ?></div>
<?= $Page->MK_TARGETPASAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_TARGETPASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_TARGETPASAR", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_TARGETPASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_TARGETPASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_TARGETPASAR">
<span<?= $Page->MK_TARGETPASAR->viewAttributes() ?>>
<?= $Page->MK_TARGETPASAR->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_KETERSEDIAAN"><?= $Page->renderSort($Page->MK_KETERSEDIAAN) ?></span></td>
            <td <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KETERSEDIAAN">
    <select
        id="x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        name="x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        class="form-control ew-select<?= $Page->MK_KETERSEDIAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KETERSEDIAAN"
        data-value-separator="<?= $Page->MK_KETERSEDIAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KETERSEDIAAN->getPlaceHolder()) ?>"
        <?= $Page->MK_KETERSEDIAAN->editAttributes() ?>>
        <?= $Page->MK_KETERSEDIAAN->selectOptionListHtml("x{$Page->RowIndex}_MK_KETERSEDIAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_KETERSEDIAAN->getErrorMessage() ?></div>
<?= $Page->MK_KETERSEDIAAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_KETERSEDIAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KETERSEDIAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KETERSEDIAAN">
<span<?= $Page->MK_KETERSEDIAAN->viewAttributes() ?>>
<?= $Page->MK_KETERSEDIAAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_KETERSEDIAAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KETERSEDIAAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KETERSEDIAAN">
    <select
        id="x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        name="x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        class="form-control ew-select<?= $Page->MK_KETERSEDIAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KETERSEDIAAN"
        data-value-separator="<?= $Page->MK_KETERSEDIAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KETERSEDIAAN->getPlaceHolder()) ?>"
        <?= $Page->MK_KETERSEDIAAN->editAttributes() ?>>
        <?= $Page->MK_KETERSEDIAAN->selectOptionListHtml("x{$Page->RowIndex}_MK_KETERSEDIAAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_KETERSEDIAAN->getErrorMessage() ?></div>
<?= $Page->MK_KETERSEDIAAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_KETERSEDIAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_KETERSEDIAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KETERSEDIAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_KETERSEDIAAN">
<span<?= $Page->MK_KETERSEDIAAN->viewAttributes() ?>>
<?= $Page->MK_KETERSEDIAAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_LOGO"><?= $Page->renderSort($Page->MK_LOGO) ?></span></td>
            <td <?= $Page->MK_LOGO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_LOGO">
    <select
        id="x<?= $Page->RowIndex ?>_MK_LOGO"
        name="x<?= $Page->RowIndex ?>_MK_LOGO"
        class="form-control ew-select<?= $Page->MK_LOGO->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_LOGO"
        data-value-separator="<?= $Page->MK_LOGO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_LOGO->getPlaceHolder()) ?>"
        <?= $Page->MK_LOGO->editAttributes() ?>>
        <?= $Page->MK_LOGO->selectOptionListHtml("x{$Page->RowIndex}_MK_LOGO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_LOGO->getErrorMessage() ?></div>
<?= $Page->MK_LOGO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_LOGO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_LOGO", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_LOGO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_LOGO">
<span<?= $Page->MK_LOGO->viewAttributes() ?>>
<?= $Page->MK_LOGO->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_LOGO">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_LOGO->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_LOGO->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_LOGO">
    <select
        id="x<?= $Page->RowIndex ?>_MK_LOGO"
        name="x<?= $Page->RowIndex ?>_MK_LOGO"
        class="form-control ew-select<?= $Page->MK_LOGO->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_LOGO"
        data-value-separator="<?= $Page->MK_LOGO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_LOGO->getPlaceHolder()) ?>"
        <?= $Page->MK_LOGO->editAttributes() ?>>
        <?= $Page->MK_LOGO->selectOptionListHtml("x{$Page->RowIndex}_MK_LOGO") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_LOGO->getErrorMessage() ?></div>
<?= $Page->MK_LOGO->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_LOGO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_LOGO", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_LOGO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_LOGO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_LOGO">
<span<?= $Page->MK_LOGO->viewAttributes() ?>>
<?= $Page->MK_LOGO->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_HKI"><?= $Page->renderSort($Page->MK_HKI) ?></span></td>
            <td <?= $Page->MK_HKI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_HKI">
    <select
        id="x<?= $Page->RowIndex ?>_MK_HKI"
        name="x<?= $Page->RowIndex ?>_MK_HKI"
        class="form-control ew-select<?= $Page->MK_HKI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_HKI"
        data-value-separator="<?= $Page->MK_HKI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_HKI->getPlaceHolder()) ?>"
        <?= $Page->MK_HKI->editAttributes() ?>>
        <?= $Page->MK_HKI->selectOptionListHtml("x{$Page->RowIndex}_MK_HKI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_HKI->getErrorMessage() ?></div>
<?= $Page->MK_HKI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_HKI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_HKI", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_HKI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_HKI">
<span<?= $Page->MK_HKI->viewAttributes() ?>>
<?= $Page->MK_HKI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_HKI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_HKI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_HKI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_HKI">
    <select
        id="x<?= $Page->RowIndex ?>_MK_HKI"
        name="x<?= $Page->RowIndex ?>_MK_HKI"
        class="form-control ew-select<?= $Page->MK_HKI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_HKI"
        data-value-separator="<?= $Page->MK_HKI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_HKI->getPlaceHolder()) ?>"
        <?= $Page->MK_HKI->editAttributes() ?>>
        <?= $Page->MK_HKI->selectOptionListHtml("x{$Page->RowIndex}_MK_HKI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_HKI->getErrorMessage() ?></div>
<?= $Page->MK_HKI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_HKI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_HKI", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_HKI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_HKI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_HKI">
<span<?= $Page->MK_HKI->viewAttributes() ?>>
<?= $Page->MK_HKI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_BRANDING"><?= $Page->renderSort($Page->MK_BRANDING) ?></span></td>
            <td <?= $Page->MK_BRANDING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_BRANDING">
    <select
        id="x<?= $Page->RowIndex ?>_MK_BRANDING"
        name="x<?= $Page->RowIndex ?>_MK_BRANDING"
        class="form-control ew-select<?= $Page->MK_BRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_BRANDING"
        data-value-separator="<?= $Page->MK_BRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_BRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_BRANDING->editAttributes() ?>>
        <?= $Page->MK_BRANDING->selectOptionListHtml("x{$Page->RowIndex}_MK_BRANDING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_BRANDING->getErrorMessage() ?></div>
<?= $Page->MK_BRANDING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_BRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_BRANDING", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_BRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_BRANDING">
<span<?= $Page->MK_BRANDING->viewAttributes() ?>>
<?= $Page->MK_BRANDING->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_BRANDING">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_BRANDING->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_BRANDING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_BRANDING">
    <select
        id="x<?= $Page->RowIndex ?>_MK_BRANDING"
        name="x<?= $Page->RowIndex ?>_MK_BRANDING"
        class="form-control ew-select<?= $Page->MK_BRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_BRANDING"
        data-value-separator="<?= $Page->MK_BRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_BRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_BRANDING->editAttributes() ?>>
        <?= $Page->MK_BRANDING->selectOptionListHtml("x{$Page->RowIndex}_MK_BRANDING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_BRANDING->getErrorMessage() ?></div>
<?= $Page->MK_BRANDING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_BRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_BRANDING", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_BRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_BRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_BRANDING">
<span<?= $Page->MK_BRANDING->viewAttributes() ?>>
<?= $Page->MK_BRANDING->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_COBRANDING"><?= $Page->renderSort($Page->MK_COBRANDING) ?></span></td>
            <td <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_COBRANDING">
    <select
        id="x<?= $Page->RowIndex ?>_MK_COBRANDING"
        name="x<?= $Page->RowIndex ?>_MK_COBRANDING"
        class="form-control ew-select<?= $Page->MK_COBRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_COBRANDING"
        data-value-separator="<?= $Page->MK_COBRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_COBRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_COBRANDING->editAttributes() ?>>
        <?= $Page->MK_COBRANDING->selectOptionListHtml("x{$Page->RowIndex}_MK_COBRANDING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_COBRANDING->getErrorMessage() ?></div>
<?= $Page->MK_COBRANDING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_COBRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_COBRANDING", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_COBRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_COBRANDING">
<span<?= $Page->MK_COBRANDING->viewAttributes() ?>>
<?= $Page->MK_COBRANDING->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_COBRANDING">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_COBRANDING->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_COBRANDING">
    <select
        id="x<?= $Page->RowIndex ?>_MK_COBRANDING"
        name="x<?= $Page->RowIndex ?>_MK_COBRANDING"
        class="form-control ew-select<?= $Page->MK_COBRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_COBRANDING"
        data-value-separator="<?= $Page->MK_COBRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_COBRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_COBRANDING->editAttributes() ?>>
        <?= $Page->MK_COBRANDING->selectOptionListHtml("x{$Page->RowIndex}_MK_COBRANDING") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_COBRANDING->getErrorMessage() ?></div>
<?= $Page->MK_COBRANDING->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_COBRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_COBRANDING", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_COBRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_COBRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_COBRANDING">
<span<?= $Page->MK_COBRANDING->viewAttributes() ?>>
<?= $Page->MK_COBRANDING->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_MEDIAOFFLINE"><?= $Page->renderSort($Page->MK_MEDIAOFFLINE) ?></span></td>
            <td <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_MEDIAOFFLINE">
    <select
        id="x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        name="x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        class="form-control ew-select<?= $Page->MK_MEDIAOFFLINE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_MEDIAOFFLINE"
        data-value-separator="<?= $Page->MK_MEDIAOFFLINE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_MEDIAOFFLINE->getPlaceHolder()) ?>"
        <?= $Page->MK_MEDIAOFFLINE->editAttributes() ?>>
        <?= $Page->MK_MEDIAOFFLINE->selectOptionListHtml("x{$Page->RowIndex}_MK_MEDIAOFFLINE") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_MEDIAOFFLINE->getErrorMessage() ?></div>
<?= $Page->MK_MEDIAOFFLINE->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_MEDIAOFFLINE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_MEDIAOFFLINE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_MEDIAOFFLINE">
<span<?= $Page->MK_MEDIAOFFLINE->viewAttributes() ?>>
<?= $Page->MK_MEDIAOFFLINE->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_MEDIAOFFLINE">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_MEDIAOFFLINE->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_MEDIAOFFLINE">
    <select
        id="x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        name="x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        class="form-control ew-select<?= $Page->MK_MEDIAOFFLINE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_MEDIAOFFLINE"
        data-value-separator="<?= $Page->MK_MEDIAOFFLINE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_MEDIAOFFLINE->getPlaceHolder()) ?>"
        <?= $Page->MK_MEDIAOFFLINE->editAttributes() ?>>
        <?= $Page->MK_MEDIAOFFLINE->selectOptionListHtml("x{$Page->RowIndex}_MK_MEDIAOFFLINE") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_MEDIAOFFLINE->getErrorMessage() ?></div>
<?= $Page->MK_MEDIAOFFLINE->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_MEDIAOFFLINE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_MEDIAOFFLINE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_MEDIAOFFLINE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_MEDIAOFFLINE">
<span<?= $Page->MK_MEDIAOFFLINE->viewAttributes() ?>>
<?= $Page->MK_MEDIAOFFLINE->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_RESELLER"><?= $Page->renderSort($Page->MK_RESELLER) ?></span></td>
            <td <?= $Page->MK_RESELLER->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_RESELLER">
    <select
        id="x<?= $Page->RowIndex ?>_MK_RESELLER"
        name="x<?= $Page->RowIndex ?>_MK_RESELLER"
        class="form-control ew-select<?= $Page->MK_RESELLER->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_RESELLER"
        data-value-separator="<?= $Page->MK_RESELLER->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_RESELLER->getPlaceHolder()) ?>"
        <?= $Page->MK_RESELLER->editAttributes() ?>>
        <?= $Page->MK_RESELLER->selectOptionListHtml("x{$Page->RowIndex}_MK_RESELLER") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_RESELLER->getErrorMessage() ?></div>
<?= $Page->MK_RESELLER->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_RESELLER") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_RESELLER", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_RESELLER.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_RESELLER">
<span<?= $Page->MK_RESELLER->viewAttributes() ?>>
<?= $Page->MK_RESELLER->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_RESELLER">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_RESELLER->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_RESELLER->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_RESELLER">
    <select
        id="x<?= $Page->RowIndex ?>_MK_RESELLER"
        name="x<?= $Page->RowIndex ?>_MK_RESELLER"
        class="form-control ew-select<?= $Page->MK_RESELLER->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_RESELLER"
        data-value-separator="<?= $Page->MK_RESELLER->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_RESELLER->getPlaceHolder()) ?>"
        <?= $Page->MK_RESELLER->editAttributes() ?>>
        <?= $Page->MK_RESELLER->selectOptionListHtml("x{$Page->RowIndex}_MK_RESELLER") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_RESELLER->getErrorMessage() ?></div>
<?= $Page->MK_RESELLER->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_RESELLER") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_RESELLER", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_RESELLER", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_RESELLER.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_RESELLER">
<span<?= $Page->MK_RESELLER->viewAttributes() ?>>
<?= $Page->MK_RESELLER->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_PASAR"><?= $Page->renderSort($Page->MK_PASAR) ?></span></td>
            <td <?= $Page->MK_PASAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PASAR">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PASAR"
        name="x<?= $Page->RowIndex ?>_MK_PASAR"
        class="form-control ew-select<?= $Page->MK_PASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PASAR"
        data-value-separator="<?= $Page->MK_PASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_PASAR->editAttributes() ?>>
        <?= $Page->MK_PASAR->selectOptionListHtml("x{$Page->RowIndex}_MK_PASAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PASAR->getErrorMessage() ?></div>
<?= $Page->MK_PASAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PASAR", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PASAR">
<span<?= $Page->MK_PASAR->viewAttributes() ?>>
<?= $Page->MK_PASAR->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_PASAR">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PASAR->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PASAR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PASAR">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PASAR"
        name="x<?= $Page->RowIndex ?>_MK_PASAR"
        class="form-control ew-select<?= $Page->MK_PASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PASAR"
        data-value-separator="<?= $Page->MK_PASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_PASAR->editAttributes() ?>>
        <?= $Page->MK_PASAR->selectOptionListHtml("x{$Page->RowIndex}_MK_PASAR") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PASAR->getErrorMessage() ?></div>
<?= $Page->MK_PASAR->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PASAR", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PASAR">
<span<?= $Page->MK_PASAR->viewAttributes() ?>>
<?= $Page->MK_PASAR->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_PELANGGAN"><?= $Page->renderSort($Page->MK_PELANGGAN) ?></span></td>
            <td <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PELANGGAN">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        name="x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        class="form-control ew-select<?= $Page->MK_PELANGGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PELANGGAN"
        data-value-separator="<?= $Page->MK_PELANGGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PELANGGAN->getPlaceHolder()) ?>"
        <?= $Page->MK_PELANGGAN->editAttributes() ?>>
        <?= $Page->MK_PELANGGAN->selectOptionListHtml("x{$Page->RowIndex}_MK_PELANGGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PELANGGAN->getErrorMessage() ?></div>
<?= $Page->MK_PELANGGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PELANGGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PELANGGAN", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PELANGGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PELANGGAN">
<span<?= $Page->MK_PELANGGAN->viewAttributes() ?>>
<?= $Page->MK_PELANGGAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_PELANGGAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PELANGGAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PELANGGAN">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        name="x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        class="form-control ew-select<?= $Page->MK_PELANGGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PELANGGAN"
        data-value-separator="<?= $Page->MK_PELANGGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PELANGGAN->getPlaceHolder()) ?>"
        <?= $Page->MK_PELANGGAN->editAttributes() ?>>
        <?= $Page->MK_PELANGGAN->selectOptionListHtml("x{$Page->RowIndex}_MK_PELANGGAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PELANGGAN->getErrorMessage() ?></div>
<?= $Page->MK_PELANGGAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PELANGGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PELANGGAN", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PELANGGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PELANGGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PELANGGAN">
<span<?= $Page->MK_PELANGGAN->viewAttributes() ?>>
<?= $Page->MK_PELANGGAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_aspekpemasaran_MK_PAMERANMANDIRI"><?= $Page->renderSort($Page->MK_PAMERANMANDIRI) ?></span></td>
            <td <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PAMERANMANDIRI">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        name="x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        class="form-control ew-select<?= $Page->MK_PAMERANMANDIRI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PAMERANMANDIRI"
        data-value-separator="<?= $Page->MK_PAMERANMANDIRI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PAMERANMANDIRI->getPlaceHolder()) ?>"
        <?= $Page->MK_PAMERANMANDIRI->editAttributes() ?>>
        <?= $Page->MK_PAMERANMANDIRI->selectOptionListHtml("x{$Page->RowIndex}_MK_PAMERANMANDIRI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PAMERANMANDIRI->getErrorMessage() ?></div>
<?= $Page->MK_PAMERANMANDIRI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PAMERANMANDIRI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PAMERANMANDIRI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PAMERANMANDIRI">
<span<?= $Page->MK_PAMERANMANDIRI->viewAttributes() ?>>
<?= $Page->MK_PAMERANMANDIRI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_aspekpemasaran_MK_PAMERANMANDIRI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PAMERANMANDIRI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PAMERANMANDIRI">
    <select
        id="x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        name="x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        class="form-control ew-select<?= $Page->MK_PAMERANMANDIRI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PAMERANMANDIRI"
        data-value-separator="<?= $Page->MK_PAMERANMANDIRI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PAMERANMANDIRI->getPlaceHolder()) ?>"
        <?= $Page->MK_PAMERANMANDIRI->editAttributes() ?>>
        <?= $Page->MK_PAMERANMANDIRI->selectOptionListHtml("x{$Page->RowIndex}_MK_PAMERANMANDIRI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->MK_PAMERANMANDIRI->getErrorMessage() ?></div>
<?= $Page->MK_PAMERANMANDIRI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_MK_PAMERANMANDIRI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI']"),
        options = { name: "x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI", selectId: "umkm_aspekpemasaran_x<?= $Page->RowIndex ?>_MK_PAMERANMANDIRI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PAMERANMANDIRI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_aspekpemasaran_MK_PAMERANMANDIRI">
<span<?= $Page->MK_PAMERANMANDIRI->viewAttributes() ?>>
<?= $Page->MK_PAMERANMANDIRI->getViewValue() ?></span>
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
loadjs.ready(["fumkm_aspekpemasaranlist","load"], function () {
    fumkm_aspekpemasaranlist.updateLists(<?= $Page->RowIndex ?>);
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
    ew.addEventHandlers("umkm_aspekpemasaran");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
