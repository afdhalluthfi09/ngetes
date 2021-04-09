<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaLmAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembaga_lmadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspeklembaga_lmadd = currentForm = new ew.Form("fumkm_aspeklembaga_lmadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeklembaga_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeklembaga_lm)
        ew.vars.tables.umkm_aspeklembaga_lm = currentTable;
    fumkm_aspeklembaga_lmadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["LB_BADANHUKUM", [fields.LB_BADANHUKUM.visible && fields.LB_BADANHUKUM.required ? ew.Validators.required(fields.LB_BADANHUKUM.caption) : null], fields.LB_BADANHUKUM.isInvalid],
        ["LB_IZINUSAHA", [fields.LB_IZINUSAHA.visible && fields.LB_IZINUSAHA.required ? ew.Validators.required(fields.LB_IZINUSAHA.caption) : null], fields.LB_IZINUSAHA.isInvalid],
        ["LB_NPWP", [fields.LB_NPWP.visible && fields.LB_NPWP.required ? ew.Validators.required(fields.LB_NPWP.caption) : null], fields.LB_NPWP.isInvalid],
        ["LB_SO", [fields.LB_SO.visible && fields.LB_SO.required ? ew.Validators.required(fields.LB_SO.caption) : null], fields.LB_SO.isInvalid],
        ["LB_JD", [fields.LB_JD.visible && fields.LB_JD.required ? ew.Validators.required(fields.LB_JD.caption) : null], fields.LB_JD.isInvalid],
        ["LB_ISO", [fields.LB_ISO.visible && fields.LB_ISO.required ? ew.Validators.required(fields.LB_ISO.caption) : null], fields.LB_ISO.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeklembaga_lmadd,
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
    fumkm_aspeklembaga_lmadd.validate = function () {
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
    fumkm_aspeklembaga_lmadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeklembaga_lmadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspeklembaga_lmadd");
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
<form name="fumkm_aspeklembaga_lmadd" id="fumkm_aspeklembaga_lmadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga_lm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_NIK">
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
    <div id="r_LB_BADANHUKUM" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_BADANHUKUM" for="x_LB_BADANHUKUM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_BADANHUKUM->caption() ?><?= $Page->LB_BADANHUKUM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_BADANHUKUM">
<input type="<?= $Page->LB_BADANHUKUM->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_BADANHUKUM" name="x_LB_BADANHUKUM" id="x_LB_BADANHUKUM" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_BADANHUKUM->getPlaceHolder()) ?>" value="<?= $Page->LB_BADANHUKUM->EditValue ?>"<?= $Page->LB_BADANHUKUM->editAttributes() ?> aria-describedby="x_LB_BADANHUKUM_help">
<?= $Page->LB_BADANHUKUM->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_BADANHUKUM->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
    <div id="r_LB_IZINUSAHA" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_IZINUSAHA" for="x_LB_IZINUSAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_IZINUSAHA->caption() ?><?= $Page->LB_IZINUSAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_IZINUSAHA">
<input type="<?= $Page->LB_IZINUSAHA->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_IZINUSAHA" name="x_LB_IZINUSAHA" id="x_LB_IZINUSAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_IZINUSAHA->getPlaceHolder()) ?>" value="<?= $Page->LB_IZINUSAHA->EditValue ?>"<?= $Page->LB_IZINUSAHA->editAttributes() ?> aria-describedby="x_LB_IZINUSAHA_help">
<?= $Page->LB_IZINUSAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_IZINUSAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
    <div id="r_LB_NPWP" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_NPWP" for="x_LB_NPWP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_NPWP->caption() ?><?= $Page->LB_NPWP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_NPWP->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_NPWP">
<input type="<?= $Page->LB_NPWP->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_NPWP" name="x_LB_NPWP" id="x_LB_NPWP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_NPWP->getPlaceHolder()) ?>" value="<?= $Page->LB_NPWP->EditValue ?>"<?= $Page->LB_NPWP->editAttributes() ?> aria-describedby="x_LB_NPWP_help">
<?= $Page->LB_NPWP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_NPWP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
    <div id="r_LB_SO" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_SO" for="x_LB_SO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_SO->caption() ?><?= $Page->LB_SO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_SO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_SO">
<input type="<?= $Page->LB_SO->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_SO" name="x_LB_SO" id="x_LB_SO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_SO->getPlaceHolder()) ?>" value="<?= $Page->LB_SO->EditValue ?>"<?= $Page->LB_SO->editAttributes() ?> aria-describedby="x_LB_SO_help">
<?= $Page->LB_SO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_SO->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
    <div id="r_LB_JD" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_JD" for="x_LB_JD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_JD->caption() ?><?= $Page->LB_JD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_JD->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_JD">
<input type="<?= $Page->LB_JD->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_JD" name="x_LB_JD" id="x_LB_JD" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_JD->getPlaceHolder()) ?>" value="<?= $Page->LB_JD->EditValue ?>"<?= $Page->LB_JD->editAttributes() ?> aria-describedby="x_LB_JD_help">
<?= $Page->LB_JD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_JD->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
    <div id="r_LB_ISO" class="form-group row">
        <label id="elh_umkm_aspeklembaga_lm_LB_ISO" for="x_LB_ISO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_ISO->caption() ?><?= $Page->LB_ISO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_ISO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_lm_LB_ISO">
<input type="<?= $Page->LB_ISO->getInputTextType() ?>" data-table="umkm_aspeklembaga_lm" data-field="x_LB_ISO" name="x_LB_ISO" id="x_LB_ISO" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->LB_ISO->getPlaceHolder()) ?>" value="<?= $Page->LB_ISO->EditValue ?>"<?= $Page->LB_ISO->editAttributes() ?> aria-describedby="x_LB_ISO_help">
<?= $Page->LB_ISO->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->LB_ISO->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_aspeklembaga_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
