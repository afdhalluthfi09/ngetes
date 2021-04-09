<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekpemasaranLmAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekpemasaran_lmadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekpemasaran_lmadd = currentForm = new ew.Form("fumkm_aspekpemasaran_lmadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekpemasaran_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekpemasaran_lm)
        ew.vars.tables.umkm_aspekpemasaran_lm = currentTable;
    fumkm_aspekpemasaran_lmadd.addFields([
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
        var f = fumkm_aspekpemasaran_lmadd,
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
    fumkm_aspekpemasaran_lmadd.validate = function () {
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
    fumkm_aspekpemasaran_lmadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekpemasaran_lmadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspekpemasaran_lmadd");
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
<form name="fumkm_aspekpemasaran_lmadd" id="fumkm_aspekpemasaran_lmadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekpemasaran_lm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_NIK">
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_KEUNGGULANPRODUK->Visible) { // MK_KEUNGGULANPRODUK ?>
    <div id="r_MK_KEUNGGULANPRODUK" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK" for="x_MK_KEUNGGULANPRODUK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KEUNGGULANPRODUK->caption() ?><?= $Page->MK_KEUNGGULANPRODUK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KEUNGGULANPRODUK->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_KEUNGGULANPRODUK">
<input type="<?= $Page->MK_KEUNGGULANPRODUK->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_KEUNGGULANPRODUK" name="x_MK_KEUNGGULANPRODUK" id="x_MK_KEUNGGULANPRODUK" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_KEUNGGULANPRODUK->getPlaceHolder()) ?>" value="<?= $Page->MK_KEUNGGULANPRODUK->EditValue ?>"<?= $Page->MK_KEUNGGULANPRODUK->editAttributes() ?> aria-describedby="x_MK_KEUNGGULANPRODUK_help">
<?= $Page->MK_KEUNGGULANPRODUK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_KEUNGGULANPRODUK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_TARGETPASAR->Visible) { // MK_TARGETPASAR ?>
    <div id="r_MK_TARGETPASAR" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_TARGETPASAR" for="x_MK_TARGETPASAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_TARGETPASAR->caption() ?><?= $Page->MK_TARGETPASAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_TARGETPASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_TARGETPASAR">
<input type="<?= $Page->MK_TARGETPASAR->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_TARGETPASAR" name="x_MK_TARGETPASAR" id="x_MK_TARGETPASAR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_TARGETPASAR->getPlaceHolder()) ?>" value="<?= $Page->MK_TARGETPASAR->EditValue ?>"<?= $Page->MK_TARGETPASAR->editAttributes() ?> aria-describedby="x_MK_TARGETPASAR_help">
<?= $Page->MK_TARGETPASAR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_TARGETPASAR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_KETERSEDIAAN->Visible) { // MK_KETERSEDIAAN ?>
    <div id="r_MK_KETERSEDIAAN" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN" for="x_MK_KETERSEDIAAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_KETERSEDIAAN->caption() ?><?= $Page->MK_KETERSEDIAAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_KETERSEDIAAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_KETERSEDIAAN">
<input type="<?= $Page->MK_KETERSEDIAAN->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_KETERSEDIAAN" name="x_MK_KETERSEDIAAN" id="x_MK_KETERSEDIAAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_KETERSEDIAAN->getPlaceHolder()) ?>" value="<?= $Page->MK_KETERSEDIAAN->EditValue ?>"<?= $Page->MK_KETERSEDIAAN->editAttributes() ?> aria-describedby="x_MK_KETERSEDIAAN_help">
<?= $Page->MK_KETERSEDIAAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_KETERSEDIAAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_LOGO->Visible) { // MK_LOGO ?>
    <div id="r_MK_LOGO" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_LOGO" for="x_MK_LOGO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_LOGO->caption() ?><?= $Page->MK_LOGO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_LOGO->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_LOGO">
<input type="<?= $Page->MK_LOGO->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_LOGO" name="x_MK_LOGO" id="x_MK_LOGO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_LOGO->getPlaceHolder()) ?>" value="<?= $Page->MK_LOGO->EditValue ?>"<?= $Page->MK_LOGO->editAttributes() ?> aria-describedby="x_MK_LOGO_help">
<?= $Page->MK_LOGO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_LOGO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_HKI->Visible) { // MK_HKI ?>
    <div id="r_MK_HKI" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_HKI" for="x_MK_HKI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_HKI->caption() ?><?= $Page->MK_HKI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_HKI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_HKI">
<input type="<?= $Page->MK_HKI->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_HKI" name="x_MK_HKI" id="x_MK_HKI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_HKI->getPlaceHolder()) ?>" value="<?= $Page->MK_HKI->EditValue ?>"<?= $Page->MK_HKI->editAttributes() ?> aria-describedby="x_MK_HKI_help">
<?= $Page->MK_HKI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_HKI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_BRANDING->Visible) { // MK_BRANDING ?>
    <div id="r_MK_BRANDING" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_BRANDING" for="x_MK_BRANDING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_BRANDING->caption() ?><?= $Page->MK_BRANDING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_BRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_BRANDING">
<input type="<?= $Page->MK_BRANDING->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_BRANDING" name="x_MK_BRANDING" id="x_MK_BRANDING" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_BRANDING->getPlaceHolder()) ?>" value="<?= $Page->MK_BRANDING->EditValue ?>"<?= $Page->MK_BRANDING->editAttributes() ?> aria-describedby="x_MK_BRANDING_help">
<?= $Page->MK_BRANDING->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_BRANDING->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_COBRANDING->Visible) { // MK_COBRANDING ?>
    <div id="r_MK_COBRANDING" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_COBRANDING" for="x_MK_COBRANDING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_COBRANDING->caption() ?><?= $Page->MK_COBRANDING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_COBRANDING->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_COBRANDING">
<input type="<?= $Page->MK_COBRANDING->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_COBRANDING" name="x_MK_COBRANDING" id="x_MK_COBRANDING" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_COBRANDING->getPlaceHolder()) ?>" value="<?= $Page->MK_COBRANDING->EditValue ?>"<?= $Page->MK_COBRANDING->editAttributes() ?> aria-describedby="x_MK_COBRANDING_help">
<?= $Page->MK_COBRANDING->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_COBRANDING->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_MEDIAOFFLINE->Visible) { // MK_MEDIAOFFLINE ?>
    <div id="r_MK_MEDIAOFFLINE" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE" for="x_MK_MEDIAOFFLINE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_MEDIAOFFLINE->caption() ?><?= $Page->MK_MEDIAOFFLINE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_MEDIAOFFLINE->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_MEDIAOFFLINE">
<input type="<?= $Page->MK_MEDIAOFFLINE->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_MEDIAOFFLINE" name="x_MK_MEDIAOFFLINE" id="x_MK_MEDIAOFFLINE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_MEDIAOFFLINE->getPlaceHolder()) ?>" value="<?= $Page->MK_MEDIAOFFLINE->EditValue ?>"<?= $Page->MK_MEDIAOFFLINE->editAttributes() ?> aria-describedby="x_MK_MEDIAOFFLINE_help">
<?= $Page->MK_MEDIAOFFLINE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_MEDIAOFFLINE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_RESELLER->Visible) { // MK_RESELLER ?>
    <div id="r_MK_RESELLER" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_RESELLER" for="x_MK_RESELLER" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_RESELLER->caption() ?><?= $Page->MK_RESELLER->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_RESELLER->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_RESELLER">
<input type="<?= $Page->MK_RESELLER->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_RESELLER" name="x_MK_RESELLER" id="x_MK_RESELLER" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_RESELLER->getPlaceHolder()) ?>" value="<?= $Page->MK_RESELLER->EditValue ?>"<?= $Page->MK_RESELLER->editAttributes() ?> aria-describedby="x_MK_RESELLER_help">
<?= $Page->MK_RESELLER->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_RESELLER->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PASAR->Visible) { // MK_PASAR ?>
    <div id="r_MK_PASAR" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_PASAR" for="x_MK_PASAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PASAR->caption() ?><?= $Page->MK_PASAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PASAR->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PASAR">
<input type="<?= $Page->MK_PASAR->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_PASAR" name="x_MK_PASAR" id="x_MK_PASAR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_PASAR->getPlaceHolder()) ?>" value="<?= $Page->MK_PASAR->EditValue ?>"<?= $Page->MK_PASAR->editAttributes() ?> aria-describedby="x_MK_PASAR_help">
<?= $Page->MK_PASAR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_PASAR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PELANGGAN->Visible) { // MK_PELANGGAN ?>
    <div id="r_MK_PELANGGAN" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_PELANGGAN" for="x_MK_PELANGGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PELANGGAN->caption() ?><?= $Page->MK_PELANGGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PELANGGAN->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PELANGGAN">
<input type="<?= $Page->MK_PELANGGAN->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_PELANGGAN" name="x_MK_PELANGGAN" id="x_MK_PELANGGAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_PELANGGAN->getPlaceHolder()) ?>" value="<?= $Page->MK_PELANGGAN->EditValue ?>"<?= $Page->MK_PELANGGAN->editAttributes() ?> aria-describedby="x_MK_PELANGGAN_help">
<?= $Page->MK_PELANGGAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_PELANGGAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MK_PAMERANMANDIRI->Visible) { // MK_PAMERANMANDIRI ?>
    <div id="r_MK_PAMERANMANDIRI" class="form-group row">
        <label id="elh_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI" for="x_MK_PAMERANMANDIRI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MK_PAMERANMANDIRI->caption() ?><?= $Page->MK_PAMERANMANDIRI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MK_PAMERANMANDIRI->cellAttributes() ?>>
<span id="el_umkm_aspekpemasaran_lm_MK_PAMERANMANDIRI">
<input type="<?= $Page->MK_PAMERANMANDIRI->getInputTextType() ?>" data-table="umkm_aspekpemasaran_lm" data-field="x_MK_PAMERANMANDIRI" name="x_MK_PAMERANMANDIRI" id="x_MK_PAMERANMANDIRI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->MK_PAMERANMANDIRI->getPlaceHolder()) ?>" value="<?= $Page->MK_PAMERANMANDIRI->EditValue ?>"<?= $Page->MK_PAMERANMANDIRI->editAttributes() ?> aria-describedby="x_MK_PAMERANMANDIRI_help">
<?= $Page->MK_PAMERANMANDIRI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MK_PAMERANMANDIRI->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_aspekpemasaran_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
