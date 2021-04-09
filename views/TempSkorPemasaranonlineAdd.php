<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranonlineAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasaranonlineadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftemp_skor_pemasaranonlineadd = currentForm = new ew.Form("ftemp_skor_pemasaranonlineadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaranonline")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_pemasaranonline)
        ew.vars.tables.temp_skor_pemasaranonline = currentTable;
    ftemp_skor_pemasaranonlineadd.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["chatting", [fields.chatting.visible && fields.chatting.required ? ew.Validators.required(fields.chatting.caption) : null], fields.chatting.isInvalid],
        ["skor_chatting", [fields.skor_chatting.visible && fields.skor_chatting.required ? ew.Validators.required(fields.skor_chatting.caption) : null, ew.Validators.float], fields.skor_chatting.isInvalid],
        ["max_chatting", [fields.max_chatting.visible && fields.max_chatting.required ? ew.Validators.required(fields.max_chatting.caption) : null, ew.Validators.float], fields.max_chatting.isInvalid],
        ["medsos", [fields.medsos.visible && fields.medsos.required ? ew.Validators.required(fields.medsos.caption) : null], fields.medsos.isInvalid],
        ["skor_medsos", [fields.skor_medsos.visible && fields.skor_medsos.required ? ew.Validators.required(fields.skor_medsos.caption) : null, ew.Validators.float], fields.skor_medsos.isInvalid],
        ["max_medsos", [fields.max_medsos.visible && fields.max_medsos.required ? ew.Validators.required(fields.max_medsos.caption) : null, ew.Validators.float], fields.max_medsos.isInvalid],
        ["marketplace", [fields.marketplace.visible && fields.marketplace.required ? ew.Validators.required(fields.marketplace.caption) : null], fields.marketplace.isInvalid],
        ["skor_mp", [fields.skor_mp.visible && fields.skor_mp.required ? ew.Validators.required(fields.skor_mp.caption) : null, ew.Validators.float], fields.skor_mp.isInvalid],
        ["max_mp", [fields.max_mp.visible && fields.max_mp.required ? ew.Validators.required(fields.max_mp.caption) : null, ew.Validators.float], fields.max_mp.isInvalid],
        ["gmb", [fields.gmb.visible && fields.gmb.required ? ew.Validators.required(fields.gmb.caption) : null], fields.gmb.isInvalid],
        ["skor_gmb", [fields.skor_gmb.visible && fields.skor_gmb.required ? ew.Validators.required(fields.skor_gmb.caption) : null, ew.Validators.float], fields.skor_gmb.isInvalid],
        ["max_gmb", [fields.max_gmb.visible && fields.max_gmb.required ? ew.Validators.required(fields.max_gmb.caption) : null, ew.Validators.float], fields.max_gmb.isInvalid],
        ["web", [fields.web.visible && fields.web.required ? ew.Validators.required(fields.web.caption) : null], fields.web.isInvalid],
        ["skor_web", [fields.skor_web.visible && fields.skor_web.required ? ew.Validators.required(fields.skor_web.caption) : null, ew.Validators.float], fields.skor_web.isInvalid],
        ["max_web", [fields.max_web.visible && fields.max_web.required ? ew.Validators.required(fields.max_web.caption) : null, ew.Validators.float], fields.max_web.isInvalid],
        ["updatemedsos", [fields.updatemedsos.visible && fields.updatemedsos.required ? ew.Validators.required(fields.updatemedsos.caption) : null], fields.updatemedsos.isInvalid],
        ["skor_updatemedsos", [fields.skor_updatemedsos.visible && fields.skor_updatemedsos.required ? ew.Validators.required(fields.skor_updatemedsos.caption) : null, ew.Validators.float], fields.skor_updatemedsos.isInvalid],
        ["max_updatemedsos", [fields.max_updatemedsos.visible && fields.max_updatemedsos.required ? ew.Validators.required(fields.max_updatemedsos.caption) : null, ew.Validators.float], fields.max_updatemedsos.isInvalid],
        ["updateweb", [fields.updateweb.visible && fields.updateweb.required ? ew.Validators.required(fields.updateweb.caption) : null], fields.updateweb.isInvalid],
        ["skor_updateweb", [fields.skor_updateweb.visible && fields.skor_updateweb.required ? ew.Validators.required(fields.skor_updateweb.caption) : null, ew.Validators.float], fields.skor_updateweb.isInvalid],
        ["max_updateweb", [fields.max_updateweb.visible && fields.max_updateweb.required ? ew.Validators.required(fields.max_updateweb.caption) : null, ew.Validators.float], fields.max_updateweb.isInvalid],
        ["seo", [fields.seo.visible && fields.seo.required ? ew.Validators.required(fields.seo.caption) : null], fields.seo.isInvalid],
        ["skor_seo", [fields.skor_seo.visible && fields.skor_seo.required ? ew.Validators.required(fields.skor_seo.caption) : null, ew.Validators.float], fields.skor_seo.isInvalid],
        ["max_seo", [fields.max_seo.visible && fields.max_seo.required ? ew.Validators.required(fields.max_seo.caption) : null, ew.Validators.float], fields.max_seo.isInvalid],
        ["iklan", [fields.iklan.visible && fields.iklan.required ? ew.Validators.required(fields.iklan.caption) : null], fields.iklan.isInvalid],
        ["skor_iklan", [fields.skor_iklan.visible && fields.skor_iklan.required ? ew.Validators.required(fields.skor_iklan.caption) : null, ew.Validators.float], fields.skor_iklan.isInvalid],
        ["max_iklan", [fields.max_iklan.visible && fields.max_iklan.required ? ew.Validators.required(fields.max_iklan.caption) : null, ew.Validators.float], fields.max_iklan.isInvalid],
        ["skor_pemasaranonline", [fields.skor_pemasaranonline.visible && fields.skor_pemasaranonline.required ? ew.Validators.required(fields.skor_pemasaranonline.caption) : null, ew.Validators.float], fields.skor_pemasaranonline.isInvalid],
        ["maxskor_pemasaranonline", [fields.maxskor_pemasaranonline.visible && fields.maxskor_pemasaranonline.required ? ew.Validators.required(fields.maxskor_pemasaranonline.caption) : null, ew.Validators.float], fields.maxskor_pemasaranonline.isInvalid],
        ["bobot_pemasaranonline", [fields.bobot_pemasaranonline.visible && fields.bobot_pemasaranonline.required ? ew.Validators.required(fields.bobot_pemasaranonline.caption) : null, ew.Validators.integer], fields.bobot_pemasaranonline.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_pemasaranonlineadd,
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
    ftemp_skor_pemasaranonlineadd.validate = function () {
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
    ftemp_skor_pemasaranonlineadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_pemasaranonlineadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_pemasaranonlineadd");
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
<form name="ftemp_skor_pemasaranonlineadd" id="ftemp_skor_pemasaranonlineadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaranonline">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->chatting->Visible) { // chatting ?>
    <div id="r_chatting" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_chatting" for="x_chatting" class="<?= $Page->LeftColumnClass ?>"><?= $Page->chatting->caption() ?><?= $Page->chatting->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_chatting">
<input type="<?= $Page->chatting->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_chatting" name="x_chatting" id="x_chatting" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->chatting->getPlaceHolder()) ?>" value="<?= $Page->chatting->EditValue ?>"<?= $Page->chatting->editAttributes() ?> aria-describedby="x_chatting_help">
<?= $Page->chatting->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->chatting->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_chatting->Visible) { // skor_chatting ?>
    <div id="r_skor_chatting" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_chatting" for="x_skor_chatting" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_chatting->caption() ?><?= $Page->skor_chatting->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_chatting">
<input type="<?= $Page->skor_chatting->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_chatting" name="x_skor_chatting" id="x_skor_chatting" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_chatting->getPlaceHolder()) ?>" value="<?= $Page->skor_chatting->EditValue ?>"<?= $Page->skor_chatting->editAttributes() ?> aria-describedby="x_skor_chatting_help">
<?= $Page->skor_chatting->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_chatting->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_chatting->Visible) { // max_chatting ?>
    <div id="r_max_chatting" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_chatting" for="x_max_chatting" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_chatting->caption() ?><?= $Page->max_chatting->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_chatting->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_chatting">
<input type="<?= $Page->max_chatting->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_chatting" name="x_max_chatting" id="x_max_chatting" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_chatting->getPlaceHolder()) ?>" value="<?= $Page->max_chatting->EditValue ?>"<?= $Page->max_chatting->editAttributes() ?> aria-describedby="x_max_chatting_help">
<?= $Page->max_chatting->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_chatting->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->medsos->Visible) { // medsos ?>
    <div id="r_medsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_medsos" for="x_medsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->medsos->caption() ?><?= $Page->medsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_medsos">
<input type="<?= $Page->medsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_medsos" name="x_medsos" id="x_medsos" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->medsos->getPlaceHolder()) ?>" value="<?= $Page->medsos->EditValue ?>"<?= $Page->medsos->editAttributes() ?> aria-describedby="x_medsos_help">
<?= $Page->medsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->medsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_medsos->Visible) { // skor_medsos ?>
    <div id="r_skor_medsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_medsos" for="x_skor_medsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_medsos->caption() ?><?= $Page->skor_medsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_medsos">
<input type="<?= $Page->skor_medsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_medsos" name="x_skor_medsos" id="x_skor_medsos" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_medsos->getPlaceHolder()) ?>" value="<?= $Page->skor_medsos->EditValue ?>"<?= $Page->skor_medsos->editAttributes() ?> aria-describedby="x_skor_medsos_help">
<?= $Page->skor_medsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_medsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_medsos->Visible) { // max_medsos ?>
    <div id="r_max_medsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_medsos" for="x_max_medsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_medsos->caption() ?><?= $Page->max_medsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_medsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_medsos">
<input type="<?= $Page->max_medsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_medsos" name="x_max_medsos" id="x_max_medsos" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_medsos->getPlaceHolder()) ?>" value="<?= $Page->max_medsos->EditValue ?>"<?= $Page->max_medsos->editAttributes() ?> aria-describedby="x_max_medsos_help">
<?= $Page->max_medsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_medsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->marketplace->Visible) { // marketplace ?>
    <div id="r_marketplace" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_marketplace" for="x_marketplace" class="<?= $Page->LeftColumnClass ?>"><?= $Page->marketplace->caption() ?><?= $Page->marketplace->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->marketplace->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_marketplace">
<input type="<?= $Page->marketplace->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_marketplace" name="x_marketplace" id="x_marketplace" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->marketplace->getPlaceHolder()) ?>" value="<?= $Page->marketplace->EditValue ?>"<?= $Page->marketplace->editAttributes() ?> aria-describedby="x_marketplace_help">
<?= $Page->marketplace->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->marketplace->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_mp->Visible) { // skor_mp ?>
    <div id="r_skor_mp" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_mp" for="x_skor_mp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_mp->caption() ?><?= $Page->skor_mp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_mp->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_mp">
<input type="<?= $Page->skor_mp->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_mp" name="x_skor_mp" id="x_skor_mp" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_mp->getPlaceHolder()) ?>" value="<?= $Page->skor_mp->EditValue ?>"<?= $Page->skor_mp->editAttributes() ?> aria-describedby="x_skor_mp_help">
<?= $Page->skor_mp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_mp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_mp->Visible) { // max_mp ?>
    <div id="r_max_mp" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_mp" for="x_max_mp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_mp->caption() ?><?= $Page->max_mp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_mp->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_mp">
<input type="<?= $Page->max_mp->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_mp" name="x_max_mp" id="x_max_mp" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_mp->getPlaceHolder()) ?>" value="<?= $Page->max_mp->EditValue ?>"<?= $Page->max_mp->editAttributes() ?> aria-describedby="x_max_mp_help">
<?= $Page->max_mp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_mp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->gmb->Visible) { // gmb ?>
    <div id="r_gmb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_gmb" for="x_gmb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->gmb->caption() ?><?= $Page->gmb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_gmb">
<input type="<?= $Page->gmb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_gmb" name="x_gmb" id="x_gmb" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->gmb->getPlaceHolder()) ?>" value="<?= $Page->gmb->EditValue ?>"<?= $Page->gmb->editAttributes() ?> aria-describedby="x_gmb_help">
<?= $Page->gmb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->gmb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_gmb->Visible) { // skor_gmb ?>
    <div id="r_skor_gmb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_gmb" for="x_skor_gmb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_gmb->caption() ?><?= $Page->skor_gmb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_gmb">
<input type="<?= $Page->skor_gmb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_gmb" name="x_skor_gmb" id="x_skor_gmb" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_gmb->getPlaceHolder()) ?>" value="<?= $Page->skor_gmb->EditValue ?>"<?= $Page->skor_gmb->editAttributes() ?> aria-describedby="x_skor_gmb_help">
<?= $Page->skor_gmb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_gmb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_gmb->Visible) { // max_gmb ?>
    <div id="r_max_gmb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_gmb" for="x_max_gmb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_gmb->caption() ?><?= $Page->max_gmb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_gmb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_gmb">
<input type="<?= $Page->max_gmb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_gmb" name="x_max_gmb" id="x_max_gmb" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_gmb->getPlaceHolder()) ?>" value="<?= $Page->max_gmb->EditValue ?>"<?= $Page->max_gmb->editAttributes() ?> aria-describedby="x_max_gmb_help">
<?= $Page->max_gmb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_gmb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->web->Visible) { // web ?>
    <div id="r_web" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_web" for="x_web" class="<?= $Page->LeftColumnClass ?>"><?= $Page->web->caption() ?><?= $Page->web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_web">
<input type="<?= $Page->web->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_web" name="x_web" id="x_web" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->web->getPlaceHolder()) ?>" value="<?= $Page->web->EditValue ?>"<?= $Page->web->editAttributes() ?> aria-describedby="x_web_help">
<?= $Page->web->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->web->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_web->Visible) { // skor_web ?>
    <div id="r_skor_web" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_web" for="x_skor_web" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_web->caption() ?><?= $Page->skor_web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_web">
<input type="<?= $Page->skor_web->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_web" name="x_skor_web" id="x_skor_web" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_web->getPlaceHolder()) ?>" value="<?= $Page->skor_web->EditValue ?>"<?= $Page->skor_web->editAttributes() ?> aria-describedby="x_skor_web_help">
<?= $Page->skor_web->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_web->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_web->Visible) { // max_web ?>
    <div id="r_max_web" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_web" for="x_max_web" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_web->caption() ?><?= $Page->max_web->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_web->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_web">
<input type="<?= $Page->max_web->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_web" name="x_max_web" id="x_max_web" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_web->getPlaceHolder()) ?>" value="<?= $Page->max_web->EditValue ?>"<?= $Page->max_web->editAttributes() ?> aria-describedby="x_max_web_help">
<?= $Page->max_web->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_web->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updatemedsos->Visible) { // updatemedsos ?>
    <div id="r_updatemedsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_updatemedsos" for="x_updatemedsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updatemedsos->caption() ?><?= $Page->updatemedsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_updatemedsos">
<input type="<?= $Page->updatemedsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_updatemedsos" name="x_updatemedsos" id="x_updatemedsos" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->updatemedsos->getPlaceHolder()) ?>" value="<?= $Page->updatemedsos->EditValue ?>"<?= $Page->updatemedsos->editAttributes() ?> aria-describedby="x_updatemedsos_help">
<?= $Page->updatemedsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updatemedsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_updatemedsos->Visible) { // skor_updatemedsos ?>
    <div id="r_skor_updatemedsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_updatemedsos" for="x_skor_updatemedsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_updatemedsos->caption() ?><?= $Page->skor_updatemedsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_updatemedsos">
<input type="<?= $Page->skor_updatemedsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_updatemedsos" name="x_skor_updatemedsos" id="x_skor_updatemedsos" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_updatemedsos->getPlaceHolder()) ?>" value="<?= $Page->skor_updatemedsos->EditValue ?>"<?= $Page->skor_updatemedsos->editAttributes() ?> aria-describedby="x_skor_updatemedsos_help">
<?= $Page->skor_updatemedsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_updatemedsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_updatemedsos->Visible) { // max_updatemedsos ?>
    <div id="r_max_updatemedsos" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_updatemedsos" for="x_max_updatemedsos" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_updatemedsos->caption() ?><?= $Page->max_updatemedsos->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_updatemedsos->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_updatemedsos">
<input type="<?= $Page->max_updatemedsos->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_updatemedsos" name="x_max_updatemedsos" id="x_max_updatemedsos" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_updatemedsos->getPlaceHolder()) ?>" value="<?= $Page->max_updatemedsos->EditValue ?>"<?= $Page->max_updatemedsos->editAttributes() ?> aria-describedby="x_max_updatemedsos_help">
<?= $Page->max_updatemedsos->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_updatemedsos->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updateweb->Visible) { // updateweb ?>
    <div id="r_updateweb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_updateweb" for="x_updateweb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updateweb->caption() ?><?= $Page->updateweb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_updateweb">
<input type="<?= $Page->updateweb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_updateweb" name="x_updateweb" id="x_updateweb" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->updateweb->getPlaceHolder()) ?>" value="<?= $Page->updateweb->EditValue ?>"<?= $Page->updateweb->editAttributes() ?> aria-describedby="x_updateweb_help">
<?= $Page->updateweb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updateweb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_updateweb->Visible) { // skor_updateweb ?>
    <div id="r_skor_updateweb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_updateweb" for="x_skor_updateweb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_updateweb->caption() ?><?= $Page->skor_updateweb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_updateweb">
<input type="<?= $Page->skor_updateweb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_updateweb" name="x_skor_updateweb" id="x_skor_updateweb" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_updateweb->getPlaceHolder()) ?>" value="<?= $Page->skor_updateweb->EditValue ?>"<?= $Page->skor_updateweb->editAttributes() ?> aria-describedby="x_skor_updateweb_help">
<?= $Page->skor_updateweb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_updateweb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_updateweb->Visible) { // max_updateweb ?>
    <div id="r_max_updateweb" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_updateweb" for="x_max_updateweb" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_updateweb->caption() ?><?= $Page->max_updateweb->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_updateweb->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_updateweb">
<input type="<?= $Page->max_updateweb->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_updateweb" name="x_max_updateweb" id="x_max_updateweb" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_updateweb->getPlaceHolder()) ?>" value="<?= $Page->max_updateweb->EditValue ?>"<?= $Page->max_updateweb->editAttributes() ?> aria-describedby="x_max_updateweb_help">
<?= $Page->max_updateweb->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_updateweb->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->seo->Visible) { // seo ?>
    <div id="r_seo" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_seo" for="x_seo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->seo->caption() ?><?= $Page->seo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_seo">
<input type="<?= $Page->seo->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_seo" name="x_seo" id="x_seo" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->seo->getPlaceHolder()) ?>" value="<?= $Page->seo->EditValue ?>"<?= $Page->seo->editAttributes() ?> aria-describedby="x_seo_help">
<?= $Page->seo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->seo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_seo->Visible) { // skor_seo ?>
    <div id="r_skor_seo" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_seo" for="x_skor_seo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_seo->caption() ?><?= $Page->skor_seo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_seo">
<input type="<?= $Page->skor_seo->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_seo" name="x_skor_seo" id="x_skor_seo" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_seo->getPlaceHolder()) ?>" value="<?= $Page->skor_seo->EditValue ?>"<?= $Page->skor_seo->editAttributes() ?> aria-describedby="x_skor_seo_help">
<?= $Page->skor_seo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_seo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_seo->Visible) { // max_seo ?>
    <div id="r_max_seo" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_seo" for="x_max_seo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_seo->caption() ?><?= $Page->max_seo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_seo->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_seo">
<input type="<?= $Page->max_seo->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_seo" name="x_max_seo" id="x_max_seo" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_seo->getPlaceHolder()) ?>" value="<?= $Page->max_seo->EditValue ?>"<?= $Page->max_seo->editAttributes() ?> aria-describedby="x_max_seo_help">
<?= $Page->max_seo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_seo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->iklan->Visible) { // iklan ?>
    <div id="r_iklan" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_iklan" for="x_iklan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->iklan->caption() ?><?= $Page->iklan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_iklan">
<input type="<?= $Page->iklan->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_iklan" name="x_iklan" id="x_iklan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->iklan->getPlaceHolder()) ?>" value="<?= $Page->iklan->EditValue ?>"<?= $Page->iklan->editAttributes() ?> aria-describedby="x_iklan_help">
<?= $Page->iklan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->iklan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_iklan->Visible) { // skor_iklan ?>
    <div id="r_skor_iklan" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_iklan" for="x_skor_iklan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_iklan->caption() ?><?= $Page->skor_iklan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_iklan">
<input type="<?= $Page->skor_iklan->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_iklan" name="x_skor_iklan" id="x_skor_iklan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_iklan->getPlaceHolder()) ?>" value="<?= $Page->skor_iklan->EditValue ?>"<?= $Page->skor_iklan->editAttributes() ?> aria-describedby="x_skor_iklan_help">
<?= $Page->skor_iklan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_iklan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_iklan->Visible) { // max_iklan ?>
    <div id="r_max_iklan" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_max_iklan" for="x_max_iklan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_iklan->caption() ?><?= $Page->max_iklan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_iklan->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_max_iklan">
<input type="<?= $Page->max_iklan->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_max_iklan" name="x_max_iklan" id="x_max_iklan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_iklan->getPlaceHolder()) ?>" value="<?= $Page->max_iklan->EditValue ?>"<?= $Page->max_iklan->editAttributes() ?> aria-describedby="x_max_iklan_help">
<?= $Page->max_iklan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_iklan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
    <div id="r_skor_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_skor_pemasaranonline" for="x_skor_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pemasaranonline->caption() ?><?= $Page->skor_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_skor_pemasaranonline">
<input type="<?= $Page->skor_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_skor_pemasaranonline" name="x_skor_pemasaranonline" id="x_skor_pemasaranonline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->skor_pemasaranonline->EditValue ?>"<?= $Page->skor_pemasaranonline->editAttributes() ?> aria-describedby="x_skor_pemasaranonline_help">
<?= $Page->skor_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pemasaranonline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
    <div id="r_maxskor_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_maxskor_pemasaranonline" for="x_maxskor_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_pemasaranonline->caption() ?><?= $Page->maxskor_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_maxskor_pemasaranonline">
<input type="<?= $Page->maxskor_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_maxskor_pemasaranonline" name="x_maxskor_pemasaranonline" id="x_maxskor_pemasaranonline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->maxskor_pemasaranonline->EditValue ?>"<?= $Page->maxskor_pemasaranonline->editAttributes() ?> aria-describedby="x_maxskor_pemasaranonline_help">
<?= $Page->maxskor_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_pemasaranonline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
    <div id="r_bobot_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_pemasaranonline_bobot_pemasaranonline" for="x_bobot_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_pemasaranonline->caption() ?><?= $Page->bobot_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaranonline_bobot_pemasaranonline">
<input type="<?= $Page->bobot_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_pemasaranonline" data-field="x_bobot_pemasaranonline" name="x_bobot_pemasaranonline" id="x_bobot_pemasaranonline" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->bobot_pemasaranonline->EditValue ?>"<?= $Page->bobot_pemasaranonline->editAttributes() ?> aria-describedby="x_bobot_pemasaranonline_help">
<?= $Page->bobot_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_pemasaranonline->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_pemasaranonline");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
