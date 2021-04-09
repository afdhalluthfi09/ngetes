<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasaranadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekpemasaranadd = currentForm = new ew.Form("fumkm_aspekpemasaranadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekpemasaran")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekpemasaran)
        ew.vars.tables.umkm_aspekpemasaran = currentTable;
    fumkm_aspekpemasaranadd.addFields([
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
        var f = fumkm_aspekpemasaranadd,
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
    fumkm_aspekpemasaranadd.validate = function () {
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
    fumkm_aspekpemasaranadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekpemasaranadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekpemasaranadd.lists.MK_KEUNGGULANPRODUK = <?= $Page->MK_KEUNGGULANPRODUK->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_TARGETPASAR = <?= $Page->MK_TARGETPASAR->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_KETERSEDIAAN = <?= $Page->MK_KETERSEDIAAN->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_LOGO = <?= $Page->MK_LOGO->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_HKI = <?= $Page->MK_HKI->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_BRANDING = <?= $Page->MK_BRANDING->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_COBRANDING = <?= $Page->MK_COBRANDING->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_MEDIAOFFLINE = <?= $Page->MK_MEDIAOFFLINE->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_RESELLER = <?= $Page->MK_RESELLER->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_PASAR = <?= $Page->MK_PASAR->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_PELANGGAN = <?= $Page->MK_PELANGGAN->toClientList($Page) ?>;
    fumkm_aspekpemasaranadd.lists.MK_PAMERANMANDIRI = <?= $Page->MK_PAMERANMANDIRI->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekpemasaranadd");
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
<form name="fumkm_aspekpemasaranadd" id="fumkm_aspekpemasaranadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
    <div id="r_MK_KEUNGGULANPRODUK" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK" for="x_MK_KEUNGGULANPRODUK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KEUNGGULANPRODUK->caption() ?><?= $Page->MK_KEUNGGULANPRODUK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_KEUNGGULANPRODUK">
    <select
        id="x_MK_KEUNGGULANPRODUK"
        name="x_MK_KEUNGGULANPRODUK"
        class="form-control ew-select<?= $Page->MK_KEUNGGULANPRODUK->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_KEUNGGULANPRODUK"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KEUNGGULANPRODUK"
        data-value-separator="<?= $Page->MK_KEUNGGULANPRODUK->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KEUNGGULANPRODUK->getPlaceHolder()) ?>"
        <?= $Page->MK_KEUNGGULANPRODUK->editAttributes() ?>>
        <?= $Page->MK_KEUNGGULANPRODUK->selectOptionListHtml("x_MK_KEUNGGULANPRODUK") ?>
    </select>
    <?= $Page->MK_KEUNGGULANPRODUK->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_KEUNGGULANPRODUK->getErrorMessage() ?></div>
<?= $Page->MK_KEUNGGULANPRODUK->Lookup->getParamTag($Page, "p_x_MK_KEUNGGULANPRODUK") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_KEUNGGULANPRODUK']"),
        options = { name: "x_MK_KEUNGGULANPRODUK", selectId: "umkm_aspekpemasaran_x_MK_KEUNGGULANPRODUK", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KEUNGGULANPRODUK.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
    <div id="r_MK_TARGETPASAR" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_TARGETPASAR" for="x_MK_TARGETPASAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_TARGETPASAR->caption() ?><?= $Page->MK_TARGETPASAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_TARGETPASAR">
    <select
        id="x_MK_TARGETPASAR"
        name="x_MK_TARGETPASAR"
        class="form-control ew-select<?= $Page->MK_TARGETPASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_TARGETPASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_TARGETPASAR"
        data-value-separator="<?= $Page->MK_TARGETPASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_TARGETPASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_TARGETPASAR->editAttributes() ?>>
        <?= $Page->MK_TARGETPASAR->selectOptionListHtml("x_MK_TARGETPASAR") ?>
    </select>
    <?= $Page->MK_TARGETPASAR->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_TARGETPASAR->getErrorMessage() ?></div>
<?= $Page->MK_TARGETPASAR->Lookup->getParamTag($Page, "p_x_MK_TARGETPASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_TARGETPASAR']"),
        options = { name: "x_MK_TARGETPASAR", selectId: "umkm_aspekpemasaran_x_MK_TARGETPASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_TARGETPASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
    <div id="r_MK_KETERSEDIAAN" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_KETERSEDIAAN" for="x_MK_KETERSEDIAAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KETERSEDIAAN->caption() ?><?= $Page->MK_KETERSEDIAAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_KETERSEDIAAN">
    <select
        id="x_MK_KETERSEDIAAN"
        name="x_MK_KETERSEDIAAN"
        class="form-control ew-select<?= $Page->MK_KETERSEDIAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_KETERSEDIAAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_KETERSEDIAAN"
        data-value-separator="<?= $Page->MK_KETERSEDIAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_KETERSEDIAAN->getPlaceHolder()) ?>"
        <?= $Page->MK_KETERSEDIAAN->editAttributes() ?>>
        <?= $Page->MK_KETERSEDIAAN->selectOptionListHtml("x_MK_KETERSEDIAAN") ?>
    </select>
    <?= $Page->MK_KETERSEDIAAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_KETERSEDIAAN->getErrorMessage() ?></div>
<?= $Page->MK_KETERSEDIAAN->Lookup->getParamTag($Page, "p_x_MK_KETERSEDIAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_KETERSEDIAAN']"),
        options = { name: "x_MK_KETERSEDIAAN", selectId: "umkm_aspekpemasaran_x_MK_KETERSEDIAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_KETERSEDIAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
    <div id="r_MK_LOGO" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_LOGO" for="x_MK_LOGO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_LOGO->caption() ?><?= $Page->MK_LOGO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_LOGO->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_LOGO">
    <select
        id="x_MK_LOGO"
        name="x_MK_LOGO"
        class="form-control ew-select<?= $Page->MK_LOGO->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_LOGO"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_LOGO"
        data-value-separator="<?= $Page->MK_LOGO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_LOGO->getPlaceHolder()) ?>"
        <?= $Page->MK_LOGO->editAttributes() ?>>
        <?= $Page->MK_LOGO->selectOptionListHtml("x_MK_LOGO") ?>
    </select>
    <?= $Page->MK_LOGO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_LOGO->getErrorMessage() ?></div>
<?= $Page->MK_LOGO->Lookup->getParamTag($Page, "p_x_MK_LOGO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_LOGO']"),
        options = { name: "x_MK_LOGO", selectId: "umkm_aspekpemasaran_x_MK_LOGO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_LOGO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
    <div id="r_MK_HKI" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_HKI" for="x_MK_HKI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_HKI->caption() ?><?= $Page->MK_HKI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_HKI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_HKI">
    <select
        id="x_MK_HKI"
        name="x_MK_HKI"
        class="form-control ew-select<?= $Page->MK_HKI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_HKI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_HKI"
        data-value-separator="<?= $Page->MK_HKI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_HKI->getPlaceHolder()) ?>"
        <?= $Page->MK_HKI->editAttributes() ?>>
        <?= $Page->MK_HKI->selectOptionListHtml("x_MK_HKI") ?>
    </select>
    <?= $Page->MK_HKI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_HKI->getErrorMessage() ?></div>
<?= $Page->MK_HKI->Lookup->getParamTag($Page, "p_x_MK_HKI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_HKI']"),
        options = { name: "x_MK_HKI", selectId: "umkm_aspekpemasaran_x_MK_HKI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_HKI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
    <div id="r_MK_BRANDING" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_BRANDING" for="x_MK_BRANDING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_BRANDING->caption() ?><?= $Page->MK_BRANDING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_BRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_BRANDING">
    <select
        id="x_MK_BRANDING"
        name="x_MK_BRANDING"
        class="form-control ew-select<?= $Page->MK_BRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_BRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_BRANDING"
        data-value-separator="<?= $Page->MK_BRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_BRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_BRANDING->editAttributes() ?>>
        <?= $Page->MK_BRANDING->selectOptionListHtml("x_MK_BRANDING") ?>
    </select>
    <?= $Page->MK_BRANDING->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_BRANDING->getErrorMessage() ?></div>
<?= $Page->MK_BRANDING->Lookup->getParamTag($Page, "p_x_MK_BRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_BRANDING']"),
        options = { name: "x_MK_BRANDING", selectId: "umkm_aspekpemasaran_x_MK_BRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_BRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
    <div id="r_MK_COBRANDING" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_COBRANDING" for="x_MK_COBRANDING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_COBRANDING->caption() ?><?= $Page->MK_COBRANDING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_COBRANDING">
    <select
        id="x_MK_COBRANDING"
        name="x_MK_COBRANDING"
        class="form-control ew-select<?= $Page->MK_COBRANDING->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_COBRANDING"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_COBRANDING"
        data-value-separator="<?= $Page->MK_COBRANDING->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_COBRANDING->getPlaceHolder()) ?>"
        <?= $Page->MK_COBRANDING->editAttributes() ?>>
        <?= $Page->MK_COBRANDING->selectOptionListHtml("x_MK_COBRANDING") ?>
    </select>
    <?= $Page->MK_COBRANDING->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_COBRANDING->getErrorMessage() ?></div>
<?= $Page->MK_COBRANDING->Lookup->getParamTag($Page, "p_x_MK_COBRANDING") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_COBRANDING']"),
        options = { name: "x_MK_COBRANDING", selectId: "umkm_aspekpemasaran_x_MK_COBRANDING", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_COBRANDING.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
    <div id="r_MK_MEDIAOFFLINE" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_MEDIAOFFLINE" for="x_MK_MEDIAOFFLINE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_MEDIAOFFLINE->caption() ?><?= $Page->MK_MEDIAOFFLINE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_MEDIAOFFLINE">
    <select
        id="x_MK_MEDIAOFFLINE"
        name="x_MK_MEDIAOFFLINE"
        class="form-control ew-select<?= $Page->MK_MEDIAOFFLINE->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_MEDIAOFFLINE"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_MEDIAOFFLINE"
        data-value-separator="<?= $Page->MK_MEDIAOFFLINE->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_MEDIAOFFLINE->getPlaceHolder()) ?>"
        <?= $Page->MK_MEDIAOFFLINE->editAttributes() ?>>
        <?= $Page->MK_MEDIAOFFLINE->selectOptionListHtml("x_MK_MEDIAOFFLINE") ?>
    </select>
    <?= $Page->MK_MEDIAOFFLINE->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_MEDIAOFFLINE->getErrorMessage() ?></div>
<?= $Page->MK_MEDIAOFFLINE->Lookup->getParamTag($Page, "p_x_MK_MEDIAOFFLINE") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_MEDIAOFFLINE']"),
        options = { name: "x_MK_MEDIAOFFLINE", selectId: "umkm_aspekpemasaran_x_MK_MEDIAOFFLINE", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_MEDIAOFFLINE.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
    <div id="r_MK_RESELLER" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_RESELLER" for="x_MK_RESELLER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_RESELLER->caption() ?><?= $Page->MK_RESELLER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_RESELLER->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_RESELLER">
    <select
        id="x_MK_RESELLER"
        name="x_MK_RESELLER"
        class="form-control ew-select<?= $Page->MK_RESELLER->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_RESELLER"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_RESELLER"
        data-value-separator="<?= $Page->MK_RESELLER->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_RESELLER->getPlaceHolder()) ?>"
        <?= $Page->MK_RESELLER->editAttributes() ?>>
        <?= $Page->MK_RESELLER->selectOptionListHtml("x_MK_RESELLER") ?>
    </select>
    <?= $Page->MK_RESELLER->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_RESELLER->getErrorMessage() ?></div>
<?= $Page->MK_RESELLER->Lookup->getParamTag($Page, "p_x_MK_RESELLER") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_RESELLER']"),
        options = { name: "x_MK_RESELLER", selectId: "umkm_aspekpemasaran_x_MK_RESELLER", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_RESELLER.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
    <div id="r_MK_PASAR" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_PASAR" for="x_MK_PASAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PASAR->caption() ?><?= $Page->MK_PASAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_PASAR">
    <select
        id="x_MK_PASAR"
        name="x_MK_PASAR"
        class="form-control ew-select<?= $Page->MK_PASAR->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_PASAR"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PASAR"
        data-value-separator="<?= $Page->MK_PASAR->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PASAR->getPlaceHolder()) ?>"
        <?= $Page->MK_PASAR->editAttributes() ?>>
        <?= $Page->MK_PASAR->selectOptionListHtml("x_MK_PASAR") ?>
    </select>
    <?= $Page->MK_PASAR->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_PASAR->getErrorMessage() ?></div>
<?= $Page->MK_PASAR->Lookup->getParamTag($Page, "p_x_MK_PASAR") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_PASAR']"),
        options = { name: "x_MK_PASAR", selectId: "umkm_aspekpemasaran_x_MK_PASAR", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PASAR.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
    <div id="r_MK_PELANGGAN" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_PELANGGAN" for="x_MK_PELANGGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PELANGGAN->caption() ?><?= $Page->MK_PELANGGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_PELANGGAN">
    <select
        id="x_MK_PELANGGAN"
        name="x_MK_PELANGGAN"
        class="form-control ew-select<?= $Page->MK_PELANGGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_PELANGGAN"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PELANGGAN"
        data-value-separator="<?= $Page->MK_PELANGGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PELANGGAN->getPlaceHolder()) ?>"
        <?= $Page->MK_PELANGGAN->editAttributes() ?>>
        <?= $Page->MK_PELANGGAN->selectOptionListHtml("x_MK_PELANGGAN") ?>
    </select>
    <?= $Page->MK_PELANGGAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_PELANGGAN->getErrorMessage() ?></div>
<?= $Page->MK_PELANGGAN->Lookup->getParamTag($Page, "p_x_MK_PELANGGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_PELANGGAN']"),
        options = { name: "x_MK_PELANGGAN", selectId: "umkm_aspekpemasaran_x_MK_PELANGGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PELANGGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
    <div id="r_MK_PAMERANMANDIRI" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_MK_PAMERANMANDIRI" for="x_MK_PAMERANMANDIRI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PAMERANMANDIRI->caption() ?><?= $Page->MK_PAMERANMANDIRI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_MK_PAMERANMANDIRI">
    <select
        id="x_MK_PAMERANMANDIRI"
        name="x_MK_PAMERANMANDIRI"
        class="form-control ew-select<?= $Page->MK_PAMERANMANDIRI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekpemasaran_x_MK_PAMERANMANDIRI"
        data-table="umkm_aspekpemasaran"
        data-field="x_MK_PAMERANMANDIRI"
        data-value-separator="<?= $Page->MK_PAMERANMANDIRI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->MK_PAMERANMANDIRI->getPlaceHolder()) ?>"
        <?= $Page->MK_PAMERANMANDIRI->editAttributes() ?>>
        <?= $Page->MK_PAMERANMANDIRI->selectOptionListHtml("x_MK_PAMERANMANDIRI") ?>
    </select>
    <?= $Page->MK_PAMERANMANDIRI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->MK_PAMERANMANDIRI->getErrorMessage() ?></div>
<?= $Page->MK_PAMERANMANDIRI->Lookup->getParamTag($Page, "p_x_MK_PAMERANMANDIRI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekpemasaran_x_MK_PAMERANMANDIRI']"),
        options = { name: "x_MK_PAMERANMANDIRI", selectId: "umkm_aspekpemasaran_x_MK_PAMERANMANDIRI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekpemasaran.fields.MK_PAMERANMANDIRI.selectOptions);
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
    ew.addEventHandlers("umkm_aspekpemasaran");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
