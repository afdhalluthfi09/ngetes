<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekdigimarkLmEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekdigimark_lmedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fumkm_aspekdigimark_lmedit = currentForm = new ew.Form("fumkm_aspekdigimark_lmedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekdigimark_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekdigimark_lm)
        ew.vars.tables.umkm_aspekdigimark_lm = currentTable;
    fumkm_aspekdigimark_lmedit.addFields([
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
        var f = fumkm_aspekdigimark_lmedit,
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
    fumkm_aspekdigimark_lmedit.validate = function () {
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
    fumkm_aspekdigimark_lmedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekdigimark_lmedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspekdigimark_lmedit");
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
<form name="fumkm_aspekdigimark_lmedit" id="fumkm_aspekdigimark_lmedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekdigimark_lm">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
<input type="hidden" data-table="umkm_aspekdigimark_lm" data-field="x_NIK" data-hidden="1" name="o_NIK" id="o_NIK" value="<?= HtmlEncode($Page->NIK->OldValue ?? $Page->NIK->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_CHATTING->Visible) { // DM_CHATTING ?>
    <div id="r_DM_CHATTING" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_CHATTING" for="x_DM_CHATTING" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_CHATTING->caption() ?><?= $Page->DM_CHATTING->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_CHATTING->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_CHATTING">
<input type="<?= $Page->DM_CHATTING->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_CHATTING" name="x_DM_CHATTING" id="x_DM_CHATTING" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_CHATTING->getPlaceHolder()) ?>" value="<?= $Page->DM_CHATTING->EditValue ?>"<?= $Page->DM_CHATTING->editAttributes() ?> aria-describedby="x_DM_CHATTING_help">
<?= $Page->DM_CHATTING->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_CHATTING->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_MEDSOS->Visible) { // DM_MEDSOS ?>
    <div id="r_DM_MEDSOS" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_MEDSOS" for="x_DM_MEDSOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MEDSOS->caption() ?><?= $Page->DM_MEDSOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_MEDSOS">
<input type="<?= $Page->DM_MEDSOS->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_MEDSOS" name="x_DM_MEDSOS" id="x_DM_MEDSOS" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_MEDSOS->getPlaceHolder()) ?>" value="<?= $Page->DM_MEDSOS->EditValue ?>"<?= $Page->DM_MEDSOS->editAttributes() ?> aria-describedby="x_DM_MEDSOS_help">
<?= $Page->DM_MEDSOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_MEDSOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_MP->Visible) { // DM_MP ?>
    <div id="r_DM_MP" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_MP" for="x_DM_MP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_MP->caption() ?><?= $Page->DM_MP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_MP->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_MP">
<input type="<?= $Page->DM_MP->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_MP" name="x_DM_MP" id="x_DM_MP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_MP->getPlaceHolder()) ?>" value="<?= $Page->DM_MP->EditValue ?>"<?= $Page->DM_MP->editAttributes() ?> aria-describedby="x_DM_MP_help">
<?= $Page->DM_MP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_MP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_GMB->Visible) { // DM_GMB ?>
    <div id="r_DM_GMB" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_GMB" for="x_DM_GMB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GMB->caption() ?><?= $Page->DM_GMB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GMB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_GMB">
<input type="<?= $Page->DM_GMB->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_GMB" name="x_DM_GMB" id="x_DM_GMB" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_GMB->getPlaceHolder()) ?>" value="<?= $Page->DM_GMB->EditValue ?>"<?= $Page->DM_GMB->editAttributes() ?> aria-describedby="x_DM_GMB_help">
<?= $Page->DM_GMB->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_GMB->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_WEB->Visible) { // DM_WEB ?>
    <div id="r_DM_WEB" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_WEB" for="x_DM_WEB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_WEB->caption() ?><?= $Page->DM_WEB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_WEB->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_WEB">
<input type="<?= $Page->DM_WEB->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_WEB" name="x_DM_WEB" id="x_DM_WEB" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_WEB->getPlaceHolder()) ?>" value="<?= $Page->DM_WEB->EditValue ?>"<?= $Page->DM_WEB->editAttributes() ?> aria-describedby="x_DM_WEB_help">
<?= $Page->DM_WEB->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_WEB->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_UPDATEMEDSOS->Visible) { // DM_UPDATEMEDSOS ?>
    <div id="r_DM_UPDATEMEDSOS" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS" for="x_DM_UPDATEMEDSOS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEMEDSOS->caption() ?><?= $Page->DM_UPDATEMEDSOS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEMEDSOS->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_UPDATEMEDSOS">
<input type="<?= $Page->DM_UPDATEMEDSOS->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_UPDATEMEDSOS" name="x_DM_UPDATEMEDSOS" id="x_DM_UPDATEMEDSOS" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_UPDATEMEDSOS->getPlaceHolder()) ?>" value="<?= $Page->DM_UPDATEMEDSOS->EditValue ?>"<?= $Page->DM_UPDATEMEDSOS->editAttributes() ?> aria-describedby="x_DM_UPDATEMEDSOS_help">
<?= $Page->DM_UPDATEMEDSOS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_UPDATEMEDSOS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_UPDATEWEBSITE->Visible) { // DM_UPDATEWEBSITE ?>
    <div id="r_DM_UPDATEWEBSITE" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE" for="x_DM_UPDATEWEBSITE" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_UPDATEWEBSITE->caption() ?><?= $Page->DM_UPDATEWEBSITE->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_UPDATEWEBSITE->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_UPDATEWEBSITE">
<input type="<?= $Page->DM_UPDATEWEBSITE->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_UPDATEWEBSITE" name="x_DM_UPDATEWEBSITE" id="x_DM_UPDATEWEBSITE" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_UPDATEWEBSITE->getPlaceHolder()) ?>" value="<?= $Page->DM_UPDATEWEBSITE->EditValue ?>"<?= $Page->DM_UPDATEWEBSITE->editAttributes() ?> aria-describedby="x_DM_UPDATEWEBSITE_help">
<?= $Page->DM_UPDATEWEBSITE->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_UPDATEWEBSITE->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_GOOGLEINDEX->Visible) { // DM_GOOGLEINDEX ?>
    <div id="r_DM_GOOGLEINDEX" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_GOOGLEINDEX" for="x_DM_GOOGLEINDEX" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_GOOGLEINDEX->caption() ?><?= $Page->DM_GOOGLEINDEX->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_GOOGLEINDEX->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_GOOGLEINDEX">
<input type="<?= $Page->DM_GOOGLEINDEX->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_GOOGLEINDEX" name="x_DM_GOOGLEINDEX" id="x_DM_GOOGLEINDEX" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_GOOGLEINDEX->getPlaceHolder()) ?>" value="<?= $Page->DM_GOOGLEINDEX->EditValue ?>"<?= $Page->DM_GOOGLEINDEX->editAttributes() ?> aria-describedby="x_DM_GOOGLEINDEX_help">
<?= $Page->DM_GOOGLEINDEX->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_GOOGLEINDEX->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DM_IKLANBERBAYAR->Visible) { // DM_IKLANBERBAYAR ?>
    <div id="r_DM_IKLANBERBAYAR" class="form-group row">
        <label id="elh_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR" for="x_DM_IKLANBERBAYAR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DM_IKLANBERBAYAR->caption() ?><?= $Page->DM_IKLANBERBAYAR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DM_IKLANBERBAYAR->cellAttributes() ?>>
<span id="el_umkm_aspekdigimark_lm_DM_IKLANBERBAYAR">
<input type="<?= $Page->DM_IKLANBERBAYAR->getInputTextType() ?>" data-table="umkm_aspekdigimark_lm" data-field="x_DM_IKLANBERBAYAR" name="x_DM_IKLANBERBAYAR" id="x_DM_IKLANBERBAYAR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DM_IKLANBERBAYAR->getPlaceHolder()) ?>" value="<?= $Page->DM_IKLANBERBAYAR->EditValue ?>"<?= $Page->DM_IKLANBERBAYAR->editAttributes() ?> aria-describedby="x_DM_IKLANBERBAYAR_help">
<?= $Page->DM_IKLANBERBAYAR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DM_IKLANBERBAYAR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
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
    ew.addEventHandlers("umkm_aspekdigimark_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
