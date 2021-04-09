<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$VUmkmDatadiriEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fv_umkm_datadiriedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fv_umkm_datadiriedit = currentForm = new ew.Form("fv_umkm_datadiriedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "v_umkm_datadiri")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.v_umkm_datadiri)
        ew.vars.tables.v_umkm_datadiri = currentTable;
    fv_umkm_datadiriedit.addFields([
        ["IDSIDAKUI", [fields.IDSIDAKUI.visible && fields.IDSIDAKUI.required ? ew.Validators.required(fields.IDSIDAKUI.caption) : null], fields.IDSIDAKUI.isInvalid],
        ["NoKTP", [fields.NoKTP.visible && fields.NoKTP.required ? ew.Validators.required(fields.NoKTP.caption) : null], fields.NoKTP.isInvalid],
        ["NAMA_PEMILIK", [fields.NAMA_PEMILIK.visible && fields.NAMA_PEMILIK.required ? ew.Validators.required(fields.NAMA_PEMILIK.caption) : null], fields.NAMA_PEMILIK.isInvalid],
        ["JENIS_KELAMIN", [fields.JENIS_KELAMIN.visible && fields.JENIS_KELAMIN.required ? ew.Validators.required(fields.JENIS_KELAMIN.caption) : null], fields.JENIS_KELAMIN.isInvalid],
        ["KAPANEWON", [fields.KAPANEWON.visible && fields.KAPANEWON.required ? ew.Validators.required(fields.KAPANEWON.caption) : null], fields.KAPANEWON.isInvalid],
        ["KALURAHAN", [fields.KALURAHAN.visible && fields.KALURAHAN.required ? ew.Validators.required(fields.KALURAHAN.caption) : null], fields.KALURAHAN.isInvalid],
        ["ALAMAT", [fields.ALAMAT.visible && fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["_EMAIL", [fields._EMAIL.visible && fields._EMAIL.required ? ew.Validators.required(fields._EMAIL.caption) : null, ew.Validators.email], fields._EMAIL.isInvalid],
        ["NO_HP", [fields.NO_HP.visible && fields.NO_HP.required ? ew.Validators.required(fields.NO_HP.caption) : null], fields.NO_HP.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fv_umkm_datadiriedit,
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
    fv_umkm_datadiriedit.validate = function () {
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
    fv_umkm_datadiriedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fv_umkm_datadiriedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fv_umkm_datadiriedit.lists.JENIS_KELAMIN = <?= $Page->JENIS_KELAMIN->toClientList($Page) ?>;
    fv_umkm_datadiriedit.lists.KAPANEWON = <?= $Page->KAPANEWON->toClientList($Page) ?>;
    fv_umkm_datadiriedit.lists.KALURAHAN = <?= $Page->KALURAHAN->toClientList($Page) ?>;
    loadjs.done("fv_umkm_datadiriedit");
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
<form name="fv_umkm_datadiriedit" id="fv_umkm_datadiriedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="v_umkm_datadiri">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->IDSIDAKUI->Visible) { // IDSIDAKUI ?>
    <div id="r_IDSIDAKUI" class="form-group row">
        <label id="elh_v_umkm_datadiri_IDSIDAKUI" for="x_IDSIDAKUI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->IDSIDAKUI->caption() ?><?= $Page->IDSIDAKUI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->IDSIDAKUI->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_IDSIDAKUI">
<input type="<?= $Page->IDSIDAKUI->getInputTextType() ?>" data-table="v_umkm_datadiri" data-field="x_IDSIDAKUI" name="x_IDSIDAKUI" id="x_IDSIDAKUI" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->IDSIDAKUI->getPlaceHolder()) ?>" value="<?= $Page->IDSIDAKUI->EditValue ?>"<?= $Page->IDSIDAKUI->editAttributes() ?> aria-describedby="x_IDSIDAKUI_help">
<?= $Page->IDSIDAKUI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->IDSIDAKUI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NoKTP->Visible) { // NoKTP ?>
    <div id="r_NoKTP" class="form-group row">
        <label id="elh_v_umkm_datadiri_NoKTP" for="x_NoKTP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NoKTP->caption() ?><?= $Page->NoKTP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NoKTP->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_NoKTP">
<input type="<?= $Page->NoKTP->getInputTextType() ?>" data-table="v_umkm_datadiri" data-field="x_NoKTP" name="x_NoKTP" id="x_NoKTP" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NoKTP->getPlaceHolder()) ?>" value="<?= $Page->NoKTP->EditValue ?>"<?= $Page->NoKTP->editAttributes() ?> aria-describedby="x_NoKTP_help">
<?= $Page->NoKTP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NoKTP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
    <div id="r_NAMA_PEMILIK" class="form-group row">
        <label id="elh_v_umkm_datadiri_NAMA_PEMILIK" for="x_NAMA_PEMILIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PEMILIK->caption() ?><?= $Page->NAMA_PEMILIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_NAMA_PEMILIK">
<input type="<?= $Page->NAMA_PEMILIK->getInputTextType() ?>" data-table="v_umkm_datadiri" data-field="x_NAMA_PEMILIK" name="x_NAMA_PEMILIK" id="x_NAMA_PEMILIK" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_PEMILIK->getPlaceHolder()) ?>" value="<?= $Page->NAMA_PEMILIK->EditValue ?>"<?= $Page->NAMA_PEMILIK->editAttributes() ?> aria-describedby="x_NAMA_PEMILIK_help">
<?= $Page->NAMA_PEMILIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_PEMILIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
    <div id="r_JENIS_KELAMIN" class="form-group row">
        <label id="elh_v_umkm_datadiri_JENIS_KELAMIN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JENIS_KELAMIN->caption() ?><?= $Page->JENIS_KELAMIN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_JENIS_KELAMIN">
<template id="tp_x_JENIS_KELAMIN">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="v_umkm_datadiri" data-field="x_JENIS_KELAMIN" name="x_JENIS_KELAMIN" id="x_JENIS_KELAMIN"<?= $Page->JENIS_KELAMIN->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_JENIS_KELAMIN" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_JENIS_KELAMIN"
    name="x_JENIS_KELAMIN"
    value="<?= HtmlEncode($Page->JENIS_KELAMIN->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_JENIS_KELAMIN"
    data-target="dsl_x_JENIS_KELAMIN"
    data-repeatcolumn="5"
    class="form-control<?= $Page->JENIS_KELAMIN->isInvalidClass() ?>"
    data-table="v_umkm_datadiri"
    data-field="x_JENIS_KELAMIN"
    data-value-separator="<?= $Page->JENIS_KELAMIN->displayValueSeparatorAttribute() ?>"
    <?= $Page->JENIS_KELAMIN->editAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JENIS_KELAMIN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
    <div id="r_KAPANEWON" class="form-group row">
        <label id="elh_v_umkm_datadiri_KAPANEWON" for="x_KAPANEWON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAPANEWON->caption() ?><?= $Page->KAPANEWON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_KAPANEWON">
<?php $Page->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_KAPANEWON"
        name="x_KAPANEWON"
        class="form-control ew-select<?= $Page->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="v_umkm_datadiri_x_KAPANEWON"
        data-table="v_umkm_datadiri"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Page->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Page->KAPANEWON->editAttributes() ?>>
        <?= $Page->KAPANEWON->selectOptionListHtml("x_KAPANEWON") ?>
    </select>
    <?= $Page->KAPANEWON->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KAPANEWON->getErrorMessage() ?></div>
<?= $Page->KAPANEWON->Lookup->getParamTag($Page, "p_x_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='v_umkm_datadiri_x_KAPANEWON']"),
        options = { name: "x_KAPANEWON", selectId: "v_umkm_datadiri_x_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.v_umkm_datadiri.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
    <div id="r_KALURAHAN" class="form-group row">
        <label id="elh_v_umkm_datadiri_KALURAHAN" for="x_KALURAHAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KALURAHAN->caption() ?><?= $Page->KALURAHAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_KALURAHAN">
    <select
        id="x_KALURAHAN"
        name="x_KALURAHAN"
        class="form-control ew-select<?= $Page->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="v_umkm_datadiri_x_KALURAHAN"
        data-table="v_umkm_datadiri"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Page->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Page->KALURAHAN->editAttributes() ?>>
        <?= $Page->KALURAHAN->selectOptionListHtml("x_KALURAHAN") ?>
    </select>
    <?= $Page->KALURAHAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KALURAHAN->getErrorMessage() ?></div>
<?= $Page->KALURAHAN->Lookup->getParamTag($Page, "p_x_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='v_umkm_datadiri_x_KALURAHAN']"),
        options = { name: "x_KALURAHAN", selectId: "v_umkm_datadiri_x_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.v_umkm_datadiri.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_v_umkm_datadiri_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_ALAMAT">
<textarea data-table="v_umkm_datadiri" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="3" rows="3" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <div id="r__EMAIL" class="form-group row">
        <label id="elh_v_umkm_datadiri__EMAIL" for="x__EMAIL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_EMAIL->caption() ?><?= $Page->_EMAIL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_EMAIL->cellAttributes() ?>>
<span id="el_v_umkm_datadiri__EMAIL">
<input type="<?= $Page->_EMAIL->getInputTextType() ?>" data-table="v_umkm_datadiri" data-field="x__EMAIL" name="x__EMAIL" id="x__EMAIL" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_EMAIL->getPlaceHolder()) ?>" value="<?= $Page->_EMAIL->EditValue ?>"<?= $Page->_EMAIL->editAttributes() ?> aria-describedby="x__EMAIL_help">
<?= $Page->_EMAIL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_EMAIL->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
    <div id="r_NO_HP" class="form-group row">
        <label id="elh_v_umkm_datadiri_NO_HP" for="x_NO_HP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_HP->caption() ?><?= $Page->NO_HP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el_v_umkm_datadiri_NO_HP">
<input type="<?= $Page->NO_HP->getInputTextType() ?>" data-table="v_umkm_datadiri" data-field="x_NO_HP" name="x_NO_HP" id="x_NO_HP" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->NO_HP->getPlaceHolder()) ?>" value="<?= $Page->NO_HP->EditValue ?>"<?= $Page->NO_HP->editAttributes() ?> aria-describedby="x_NO_HP_help">
<?= $Page->NO_HP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_HP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="v_umkm_datadiri" data-field="x_NIK" data-hidden="1" name="x_NIK" id="x_NIK" value="<?= HtmlEncode($Page->NIK->CurrentValue) ?>">
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("SaveBtn") ?></button>
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
    ew.addEventHandlers("v_umkm_datadiri");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
