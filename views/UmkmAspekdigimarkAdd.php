<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimarkadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekdigimarkadd = currentForm = new ew.Form("fumkm_aspekdigimarkadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekdigimark")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekdigimark)
        ew.vars.tables.umkm_aspekdigimark = currentTable;
    fumkm_aspekdigimarkadd.addFields([
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
        var f = fumkm_aspekdigimarkadd,
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
    fumkm_aspekdigimarkadd.validate = function () {
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
    fumkm_aspekdigimarkadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekdigimarkadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekdigimarkadd.lists.DM_CHATTING = <?= $Page->DM_CHATTING->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_MEDSOS = <?= $Page->DM_MEDSOS->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_MP = <?= $Page->DM_MP->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_GMB = <?= $Page->DM_GMB->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_WEB = <?= $Page->DM_WEB->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_UPDATEMEDSOS = <?= $Page->DM_UPDATEMEDSOS->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_UPDATEWEBSITE = <?= $Page->DM_UPDATEWEBSITE->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_GOOGLEINDEX = <?= $Page->DM_GOOGLEINDEX->toClientList($Page) ?>;
    fumkm_aspekdigimarkadd.lists.DM_IKLANBERBAYAR = <?= $Page->DM_IKLANBERBAYAR->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekdigimarkadd");
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
<form name="fumkm_aspekdigimarkadd" id="fumkm_aspekdigimarkadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
    <div id="r_DM_CHATTING" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_CHATTING" for="x_DM_CHATTING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_CHATTING->caption() ?><?= $Page->DM_CHATTING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_CHATTING->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_CHATTING">
    <select
        id="x_DM_CHATTING"
        name="x_DM_CHATTING"
        class="form-control ew-select<?= $Page->DM_CHATTING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_CHATTING"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_CHATTING"
        data-value-separator="<?= $Page->DM_CHATTING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_CHATTING->getPlaceHolder()) ?>"
        <?= $Page->DM_CHATTING->editAttributes() ?>>
        <?= $Page->DM_CHATTING->selectOptionListHtml("x_DM_CHATTING") ?>
    </select>
    <?= $Page->DM_CHATTING->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_CHATTING->getErrorMessage() ?></div>
<?= $Page->DM_CHATTING->Lookup->getParamTag($Page, "p_x_DM_CHATTING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_CHATTING']"),
        options = { name: "x_DM_CHATTING", selectId: "umkm_aspekdigimark_x_DM_CHATTING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_CHATTING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
    <div id="r_DM_MEDSOS" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_MEDSOS" for="x_DM_MEDSOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MEDSOS->caption() ?><?= $Page->DM_MEDSOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_MEDSOS">
    <select
        id="x_DM_MEDSOS"
        name="x_DM_MEDSOS"
        class="form-control ew-select<?= $Page->DM_MEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_MEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MEDSOS"
        data-value-separator="<?= $Page->DM_MEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_MEDSOS->editAttributes() ?>>
        <?= $Page->DM_MEDSOS->selectOptionListHtml("x_DM_MEDSOS") ?>
    </select>
    <?= $Page->DM_MEDSOS->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_MEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_MEDSOS->Lookup->getParamTag($Page, "p_x_DM_MEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_MEDSOS']"),
        options = { name: "x_DM_MEDSOS", selectId: "umkm_aspekdigimark_x_DM_MEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
    <div id="r_DM_MP" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_MP" for="x_DM_MP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MP->caption() ?><?= $Page->DM_MP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MP->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_MP">
    <select
        id="x_DM_MP"
        name="x_DM_MP"
        class="form-control ew-select<?= $Page->DM_MP->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_MP"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_MP"
        data-value-separator="<?= $Page->DM_MP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_MP->getPlaceHolder()) ?>"
        <?= $Page->DM_MP->editAttributes() ?>>
        <?= $Page->DM_MP->selectOptionListHtml("x_DM_MP") ?>
    </select>
    <?= $Page->DM_MP->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_MP->getErrorMessage() ?></div>
<?= $Page->DM_MP->Lookup->getParamTag($Page, "p_x_DM_MP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_MP']"),
        options = { name: "x_DM_MP", selectId: "umkm_aspekdigimark_x_DM_MP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_MP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
    <div id="r_DM_GMB" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_GMB" for="x_DM_GMB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GMB->caption() ?><?= $Page->DM_GMB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GMB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_GMB">
    <select
        id="x_DM_GMB"
        name="x_DM_GMB"
        class="form-control ew-select<?= $Page->DM_GMB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_GMB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GMB"
        data-value-separator="<?= $Page->DM_GMB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GMB->getPlaceHolder()) ?>"
        <?= $Page->DM_GMB->editAttributes() ?>>
        <?= $Page->DM_GMB->selectOptionListHtml("x_DM_GMB") ?>
    </select>
    <?= $Page->DM_GMB->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_GMB->getErrorMessage() ?></div>
<?= $Page->DM_GMB->Lookup->getParamTag($Page, "p_x_DM_GMB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_GMB']"),
        options = { name: "x_DM_GMB", selectId: "umkm_aspekdigimark_x_DM_GMB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GMB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
    <div id="r_DM_WEB" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_WEB" for="x_DM_WEB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_WEB->caption() ?><?= $Page->DM_WEB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_WEB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_WEB">
    <select
        id="x_DM_WEB"
        name="x_DM_WEB"
        class="form-control ew-select<?= $Page->DM_WEB->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_WEB"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_WEB"
        data-value-separator="<?= $Page->DM_WEB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_WEB->getPlaceHolder()) ?>"
        <?= $Page->DM_WEB->editAttributes() ?>>
        <?= $Page->DM_WEB->selectOptionListHtml("x_DM_WEB") ?>
    </select>
    <?= $Page->DM_WEB->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_WEB->getErrorMessage() ?></div>
<?= $Page->DM_WEB->Lookup->getParamTag($Page, "p_x_DM_WEB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_WEB']"),
        options = { name: "x_DM_WEB", selectId: "umkm_aspekdigimark_x_DM_WEB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_WEB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
    <div id="r_DM_UPDATEMEDSOS" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_UPDATEMEDSOS" for="x_DM_UPDATEMEDSOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEMEDSOS->caption() ?><?= $Page->DM_UPDATEMEDSOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_UPDATEMEDSOS">
    <select
        id="x_DM_UPDATEMEDSOS"
        name="x_DM_UPDATEMEDSOS"
        class="form-control ew-select<?= $Page->DM_UPDATEMEDSOS->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_UPDATEMEDSOS"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEMEDSOS"
        data-value-separator="<?= $Page->DM_UPDATEMEDSOS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEMEDSOS->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEMEDSOS->editAttributes() ?>>
        <?= $Page->DM_UPDATEMEDSOS->selectOptionListHtml("x_DM_UPDATEMEDSOS") ?>
    </select>
    <?= $Page->DM_UPDATEMEDSOS->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEMEDSOS->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEMEDSOS->Lookup->getParamTag($Page, "p_x_DM_UPDATEMEDSOS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_UPDATEMEDSOS']"),
        options = { name: "x_DM_UPDATEMEDSOS", selectId: "umkm_aspekdigimark_x_DM_UPDATEMEDSOS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEMEDSOS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
    <div id="r_DM_UPDATEWEBSITE" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_UPDATEWEBSITE" for="x_DM_UPDATEWEBSITE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEWEBSITE->caption() ?><?= $Page->DM_UPDATEWEBSITE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_UPDATEWEBSITE">
    <select
        id="x_DM_UPDATEWEBSITE"
        name="x_DM_UPDATEWEBSITE"
        class="form-control ew-select<?= $Page->DM_UPDATEWEBSITE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_UPDATEWEBSITE"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_UPDATEWEBSITE"
        data-value-separator="<?= $Page->DM_UPDATEWEBSITE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_UPDATEWEBSITE->getPlaceHolder()) ?>"
        <?= $Page->DM_UPDATEWEBSITE->editAttributes() ?>>
        <?= $Page->DM_UPDATEWEBSITE->selectOptionListHtml("x_DM_UPDATEWEBSITE") ?>
    </select>
    <?= $Page->DM_UPDATEWEBSITE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_UPDATEWEBSITE->getErrorMessage() ?></div>
<?= $Page->DM_UPDATEWEBSITE->Lookup->getParamTag($Page, "p_x_DM_UPDATEWEBSITE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_UPDATEWEBSITE']"),
        options = { name: "x_DM_UPDATEWEBSITE", selectId: "umkm_aspekdigimark_x_DM_UPDATEWEBSITE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_UPDATEWEBSITE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
    <div id="r_DM_GOOGLEINDEX" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_GOOGLEINDEX" for="x_DM_GOOGLEINDEX" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GOOGLEINDEX->caption() ?><?= $Page->DM_GOOGLEINDEX->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_GOOGLEINDEX">
    <select
        id="x_DM_GOOGLEINDEX"
        name="x_DM_GOOGLEINDEX"
        class="form-control ew-select<?= $Page->DM_GOOGLEINDEX->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_GOOGLEINDEX"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_GOOGLEINDEX"
        data-value-separator="<?= $Page->DM_GOOGLEINDEX->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_GOOGLEINDEX->getPlaceHolder()) ?>"
        <?= $Page->DM_GOOGLEINDEX->editAttributes() ?>>
        <?= $Page->DM_GOOGLEINDEX->selectOptionListHtml("x_DM_GOOGLEINDEX") ?>
    </select>
    <?= $Page->DM_GOOGLEINDEX->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_GOOGLEINDEX->getErrorMessage() ?></div>
<?= $Page->DM_GOOGLEINDEX->Lookup->getParamTag($Page, "p_x_DM_GOOGLEINDEX") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_GOOGLEINDEX']"),
        options = { name: "x_DM_GOOGLEINDEX", selectId: "umkm_aspekdigimark_x_DM_GOOGLEINDEX", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_GOOGLEINDEX.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
    <div id="r_DM_IKLANBERBAYAR" class="form-group row">
        <label id="elh_umkm_aspekdigimark_DM_IKLANBERBAYAR" for="x_DM_IKLANBERBAYAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_IKLANBERBAYAR->caption() ?><?= $Page->DM_IKLANBERBAYAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_DM_IKLANBERBAYAR">
    <select
        id="x_DM_IKLANBERBAYAR"
        name="x_DM_IKLANBERBAYAR"
        class="form-control ew-select<?= $Page->DM_IKLANBERBAYAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekdigimark_x_DM_IKLANBERBAYAR"
        data-table="umkm_aspekdigimark"
        data-field="x_DM_IKLANBERBAYAR"
        data-value-separator="<?= $Page->DM_IKLANBERBAYAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->DM_IKLANBERBAYAR->getPlaceHolder()) ?>"
        <?= $Page->DM_IKLANBERBAYAR->editAttributes() ?>>
        <?= $Page->DM_IKLANBERBAYAR->selectOptionListHtml("x_DM_IKLANBERBAYAR") ?>
    </select>
    <?= $Page->DM_IKLANBERBAYAR->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->DM_IKLANBERBAYAR->getErrorMessage() ?></div>
<?= $Page->DM_IKLANBERBAYAR->Lookup->getParamTag($Page, "p_x_DM_IKLANBERBAYAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekdigimark_x_DM_IKLANBERBAYAR']"),
        options = { name: "x_DM_IKLANBERBAYAR", selectId: "umkm_aspekdigimark_x_DM_IKLANBERBAYAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekdigimark.fields.DM_IKLANBERBAYAR.selectOptions);
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
    ew.addEventHandlers("umkm_aspekdigimark");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
