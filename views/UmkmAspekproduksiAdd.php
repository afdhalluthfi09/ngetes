<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksiadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekproduksiadd = currentForm = new ew.Form("fumkm_aspekproduksiadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekproduksi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekproduksi)
        ew.vars.tables.umkm_aspekproduksi = currentTable;
    fumkm_aspekproduksiadd.addFields([
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
        var f = fumkm_aspekproduksiadd,
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
    fumkm_aspekproduksiadd.validate = function () {
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

        // Process detail forms
        var dfs = $fobj.find("input[name='detailpage']").get();
        for (var i = 0; i < dfs.length; i++) {
            var df = dfs[i],
                val = df.value,
                frm = ew.forms.get(val);
            if (val && frm && !frm.validate())
                return false;
        }
        return true;
    }

    // Form_CustomValidate
    fumkm_aspekproduksiadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekproduksiadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekproduksiadd.lists.PROD_FREKUENSIPRODUKSI = <?= $Page->PROD_FREKUENSIPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_KAPASITAS = <?= $Page->PROD_KAPASITAS->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_KEAMANANPANGAN = <?= $Page->PROD_KEAMANANPANGAN->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_SNI = <?= $Page->PROD_SNI->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_KEMASAN = <?= $Page->PROD_KEMASAN->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_KETERSEDIAANBAHANBAKU = <?= $Page->PROD_KETERSEDIAANBAHANBAKU->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_ALATPRODUKSI = <?= $Page->PROD_ALATPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_GUDANGPENYIMPAN = <?= $Page->PROD_GUDANGPENYIMPAN->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_LAYOUTPRODUKSI = <?= $Page->PROD_LAYOUTPRODUKSI->toClientList($Page) ?>;
    fumkm_aspekproduksiadd.lists.PROD_SOP = <?= $Page->PROD_SOP->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekproduksiadd");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fumkm_aspekproduksiadd" id="fumkm_aspekproduksiadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
    <div id="r_PROD_FREKUENSIPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI" for="x_PROD_FREKUENSIPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_FREKUENSIPRODUKSI->caption() ?><?= $Page->PROD_FREKUENSIPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_FREKUENSIPRODUKSI">
    <select
        id="x_PROD_FREKUENSIPRODUKSI"
        name="x_PROD_FREKUENSIPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_FREKUENSIPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_FREKUENSIPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_FREKUENSIPRODUKSI"
        data-value-separator="<?= $Page->PROD_FREKUENSIPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_FREKUENSIPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_FREKUENSIPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_FREKUENSIPRODUKSI->selectOptionListHtml("x_PROD_FREKUENSIPRODUKSI") ?>
    </select>
    <?= $Page->PROD_FREKUENSIPRODUKSI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_FREKUENSIPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_FREKUENSIPRODUKSI->Lookup->getParamTag($Page, "p_x_PROD_FREKUENSIPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_FREKUENSIPRODUKSI']"),
        options = { name: "x_PROD_FREKUENSIPRODUKSI", selectId: "umkm_aspekproduksi_x_PROD_FREKUENSIPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_FREKUENSIPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
    <div id="r_PROD_KAPASITAS" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_KAPASITAS" for="x_PROD_KAPASITAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KAPASITAS->caption() ?><?= $Page->PROD_KAPASITAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_KAPASITAS">
    <select
        id="x_PROD_KAPASITAS"
        name="x_PROD_KAPASITAS"
        class="form-control ew-select<?= $Page->PROD_KAPASITAS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_KAPASITAS"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KAPASITAS"
        data-value-separator="<?= $Page->PROD_KAPASITAS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KAPASITAS->getPlaceHolder()) ?>"
        <?= $Page->PROD_KAPASITAS->editAttributes() ?>>
        <?= $Page->PROD_KAPASITAS->selectOptionListHtml("x_PROD_KAPASITAS") ?>
    </select>
    <?= $Page->PROD_KAPASITAS->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_KAPASITAS->getErrorMessage() ?></div>
<?= $Page->PROD_KAPASITAS->Lookup->getParamTag($Page, "p_x_PROD_KAPASITAS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_KAPASITAS']"),
        options = { name: "x_PROD_KAPASITAS", selectId: "umkm_aspekproduksi_x_PROD_KAPASITAS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KAPASITAS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
    <div id="r_PROD_KEAMANANPANGAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_KEAMANANPANGAN" for="x_PROD_KEAMANANPANGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEAMANANPANGAN->caption() ?><?= $Page->PROD_KEAMANANPANGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_KEAMANANPANGAN">
    <select
        id="x_PROD_KEAMANANPANGAN"
        name="x_PROD_KEAMANANPANGAN"
        class="form-control ew-select<?= $Page->PROD_KEAMANANPANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_KEAMANANPANGAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEAMANANPANGAN"
        data-value-separator="<?= $Page->PROD_KEAMANANPANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEAMANANPANGAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEAMANANPANGAN->editAttributes() ?>>
        <?= $Page->PROD_KEAMANANPANGAN->selectOptionListHtml("x_PROD_KEAMANANPANGAN") ?>
    </select>
    <?= $Page->PROD_KEAMANANPANGAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_KEAMANANPANGAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEAMANANPANGAN->Lookup->getParamTag($Page, "p_x_PROD_KEAMANANPANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_KEAMANANPANGAN']"),
        options = { name: "x_PROD_KEAMANANPANGAN", selectId: "umkm_aspekproduksi_x_PROD_KEAMANANPANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEAMANANPANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
    <div id="r_PROD_SNI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_SNI" for="x_PROD_SNI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SNI->caption() ?><?= $Page->PROD_SNI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SNI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_SNI">
    <select
        id="x_PROD_SNI"
        name="x_PROD_SNI"
        class="form-control ew-select<?= $Page->PROD_SNI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_SNI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SNI"
        data-value-separator="<?= $Page->PROD_SNI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SNI->getPlaceHolder()) ?>"
        <?= $Page->PROD_SNI->editAttributes() ?>>
        <?= $Page->PROD_SNI->selectOptionListHtml("x_PROD_SNI") ?>
    </select>
    <?= $Page->PROD_SNI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_SNI->getErrorMessage() ?></div>
<?= $Page->PROD_SNI->Lookup->getParamTag($Page, "p_x_PROD_SNI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_SNI']"),
        options = { name: "x_PROD_SNI", selectId: "umkm_aspekproduksi_x_PROD_SNI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SNI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
    <div id="r_PROD_KEMASAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_KEMASAN" for="x_PROD_KEMASAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEMASAN->caption() ?><?= $Page->PROD_KEMASAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_KEMASAN">
    <select
        id="x_PROD_KEMASAN"
        name="x_PROD_KEMASAN"
        class="form-control ew-select<?= $Page->PROD_KEMASAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_KEMASAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KEMASAN"
        data-value-separator="<?= $Page->PROD_KEMASAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KEMASAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_KEMASAN->editAttributes() ?>>
        <?= $Page->PROD_KEMASAN->selectOptionListHtml("x_PROD_KEMASAN") ?>
    </select>
    <?= $Page->PROD_KEMASAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_KEMASAN->getErrorMessage() ?></div>
<?= $Page->PROD_KEMASAN->Lookup->getParamTag($Page, "p_x_PROD_KEMASAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_KEMASAN']"),
        options = { name: "x_PROD_KEMASAN", selectId: "umkm_aspekproduksi_x_PROD_KEMASAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KEMASAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
    <div id="r_PROD_KETERSEDIAANBAHANBAKU" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU" for="x_PROD_KETERSEDIAANBAHANBAKU" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->caption() ?><?= $Page->PROD_KETERSEDIAANBAHANBAKU->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_KETERSEDIAANBAHANBAKU">
    <select
        id="x_PROD_KETERSEDIAANBAHANBAKU"
        name="x_PROD_KETERSEDIAANBAHANBAKU"
        class="form-control ew-select<?= $Page->PROD_KETERSEDIAANBAHANBAKU->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_KETERSEDIAANBAHANBAKU"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_KETERSEDIAANBAHANBAKU"
        data-value-separator="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_KETERSEDIAANBAHANBAKU->getPlaceHolder()) ?>"
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->editAttributes() ?>>
        <?= $Page->PROD_KETERSEDIAANBAHANBAKU->selectOptionListHtml("x_PROD_KETERSEDIAANBAHANBAKU") ?>
    </select>
    <?= $Page->PROD_KETERSEDIAANBAHANBAKU->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->getErrorMessage() ?></div>
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->Lookup->getParamTag($Page, "p_x_PROD_KETERSEDIAANBAHANBAKU") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_KETERSEDIAANBAHANBAKU']"),
        options = { name: "x_PROD_KETERSEDIAANBAHANBAKU", selectId: "umkm_aspekproduksi_x_PROD_KETERSEDIAANBAHANBAKU", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_KETERSEDIAANBAHANBAKU.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
    <div id="r_PROD_ALATPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_ALATPRODUKSI" for="x_PROD_ALATPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_ALATPRODUKSI->caption() ?><?= $Page->PROD_ALATPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_ALATPRODUKSI">
    <select
        id="x_PROD_ALATPRODUKSI"
        name="x_PROD_ALATPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_ALATPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_ALATPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_ALATPRODUKSI"
        data-value-separator="<?= $Page->PROD_ALATPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_ALATPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_ALATPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_ALATPRODUKSI->selectOptionListHtml("x_PROD_ALATPRODUKSI") ?>
    </select>
    <?= $Page->PROD_ALATPRODUKSI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_ALATPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_ALATPRODUKSI->Lookup->getParamTag($Page, "p_x_PROD_ALATPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_ALATPRODUKSI']"),
        options = { name: "x_PROD_ALATPRODUKSI", selectId: "umkm_aspekproduksi_x_PROD_ALATPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_ALATPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
    <div id="r_PROD_GUDANGPENYIMPAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN" for="x_PROD_GUDANGPENYIMPAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_GUDANGPENYIMPAN->caption() ?><?= $Page->PROD_GUDANGPENYIMPAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_GUDANGPENYIMPAN">
    <select
        id="x_PROD_GUDANGPENYIMPAN"
        name="x_PROD_GUDANGPENYIMPAN"
        class="form-control ew-select<?= $Page->PROD_GUDANGPENYIMPAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_GUDANGPENYIMPAN"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_GUDANGPENYIMPAN"
        data-value-separator="<?= $Page->PROD_GUDANGPENYIMPAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_GUDANGPENYIMPAN->getPlaceHolder()) ?>"
        <?= $Page->PROD_GUDANGPENYIMPAN->editAttributes() ?>>
        <?= $Page->PROD_GUDANGPENYIMPAN->selectOptionListHtml("x_PROD_GUDANGPENYIMPAN") ?>
    </select>
    <?= $Page->PROD_GUDANGPENYIMPAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_GUDANGPENYIMPAN->getErrorMessage() ?></div>
<?= $Page->PROD_GUDANGPENYIMPAN->Lookup->getParamTag($Page, "p_x_PROD_GUDANGPENYIMPAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_GUDANGPENYIMPAN']"),
        options = { name: "x_PROD_GUDANGPENYIMPAN", selectId: "umkm_aspekproduksi_x_PROD_GUDANGPENYIMPAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_GUDANGPENYIMPAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
    <div id="r_PROD_LAYOUTPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI" for="x_PROD_LAYOUTPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_LAYOUTPRODUKSI->caption() ?><?= $Page->PROD_LAYOUTPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_LAYOUTPRODUKSI">
    <select
        id="x_PROD_LAYOUTPRODUKSI"
        name="x_PROD_LAYOUTPRODUKSI"
        class="form-control ew-select<?= $Page->PROD_LAYOUTPRODUKSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_LAYOUTPRODUKSI"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_LAYOUTPRODUKSI"
        data-value-separator="<?= $Page->PROD_LAYOUTPRODUKSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_LAYOUTPRODUKSI->getPlaceHolder()) ?>"
        <?= $Page->PROD_LAYOUTPRODUKSI->editAttributes() ?>>
        <?= $Page->PROD_LAYOUTPRODUKSI->selectOptionListHtml("x_PROD_LAYOUTPRODUKSI") ?>
    </select>
    <?= $Page->PROD_LAYOUTPRODUKSI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_LAYOUTPRODUKSI->getErrorMessage() ?></div>
<?= $Page->PROD_LAYOUTPRODUKSI->Lookup->getParamTag($Page, "p_x_PROD_LAYOUTPRODUKSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_LAYOUTPRODUKSI']"),
        options = { name: "x_PROD_LAYOUTPRODUKSI", selectId: "umkm_aspekproduksi_x_PROD_LAYOUTPRODUKSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_LAYOUTPRODUKSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
    <div id="r_PROD_SOP" class="form-group row">
        <label id="elh_umkm_aspekproduksi_PROD_SOP" for="x_PROD_SOP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SOP->caption() ?><?= $Page->PROD_SOP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SOP->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_PROD_SOP">
    <select
        id="x_PROD_SOP"
        name="x_PROD_SOP"
        class="form-control ew-select<?= $Page->PROD_SOP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekproduksi_x_PROD_SOP"
        data-table="umkm_aspekproduksi"
        data-field="x_PROD_SOP"
        data-value-separator="<?= $Page->PROD_SOP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->PROD_SOP->getPlaceHolder()) ?>"
        <?= $Page->PROD_SOP->editAttributes() ?>>
        <?= $Page->PROD_SOP->selectOptionListHtml("x_PROD_SOP") ?>
    </select>
    <?= $Page->PROD_SOP->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->PROD_SOP->getErrorMessage() ?></div>
<?= $Page->PROD_SOP->Lookup->getParamTag($Page, "p_x_PROD_SOP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekproduksi_x_PROD_SOP']"),
        options = { name: "x_PROD_SOP", selectId: "umkm_aspekproduksi_x_PROD_SOP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekproduksi.fields.PROD_SOP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
    </div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
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
