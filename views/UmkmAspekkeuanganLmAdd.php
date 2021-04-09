<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganLmAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuangan_lmadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekkeuangan_lmadd = currentForm = new ew.Form("fumkm_aspekkeuangan_lmadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekkeuangan_lm)
        ew.vars.tables.umkm_aspekkeuangan_lm = currentTable;
    fumkm_aspekkeuangan_lmadd.addFields([
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
        var f = fumkm_aspekkeuangan_lmadd,
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
    fumkm_aspekkeuangan_lmadd.validate = function () {
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
    fumkm_aspekkeuangan_lmadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekkeuangan_lmadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspekkeuangan_lmadd");
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
<form name="fumkm_aspekkeuangan_lmadd" id="fumkm_aspekkeuangan_lmadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan_lm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_NIK">
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
    <div id="r_KEU_USAHAUTAMA" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA" for="x_KEU_USAHAUTAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_USAHAUTAMA->caption() ?><?= $Page->KEU_USAHAUTAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_USAHAUTAMA">
<input type="<?= $Page->KEU_USAHAUTAMA->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_USAHAUTAMA" name="x_KEU_USAHAUTAMA" id="x_KEU_USAHAUTAMA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_USAHAUTAMA->getPlaceHolder()) ?>" value="<?= $Page->KEU_USAHAUTAMA->EditValue ?>"<?= $Page->KEU_USAHAUTAMA->editAttributes() ?> aria-describedby="x_KEU_USAHAUTAMA_help">
<?= $Page->KEU_USAHAUTAMA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_USAHAUTAMA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
    <div id="r_KEU_PENGELOLAAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN" for="x_KEU_PENGELOLAAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENGELOLAAN->caption() ?><?= $Page->KEU_PENGELOLAAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_PENGELOLAAN">
<input type="<?= $Page->KEU_PENGELOLAAN->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_PENGELOLAAN" name="x_KEU_PENGELOLAAN" id="x_KEU_PENGELOLAAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_PENGELOLAAN->getPlaceHolder()) ?>" value="<?= $Page->KEU_PENGELOLAAN->EditValue ?>"<?= $Page->KEU_PENGELOLAAN->editAttributes() ?> aria-describedby="x_KEU_PENGELOLAAN_help">
<?= $Page->KEU_PENGELOLAAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_PENGELOLAAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
    <div id="r_KEU_NOTA" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_NOTA" for="x_KEU_NOTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NOTA->caption() ?><?= $Page->KEU_NOTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NOTA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_NOTA">
<input type="<?= $Page->KEU_NOTA->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_NOTA" name="x_KEU_NOTA" id="x_KEU_NOTA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_NOTA->getPlaceHolder()) ?>" value="<?= $Page->KEU_NOTA->EditValue ?>"<?= $Page->KEU_NOTA->editAttributes() ?> aria-describedby="x_KEU_NOTA_help">
<?= $Page->KEU_NOTA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_NOTA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
    <div id="r_KEU_PENCATATAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_PENCATATAN" for="x_KEU_PENCATATAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENCATATAN->caption() ?><?= $Page->KEU_PENCATATAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_PENCATATAN">
<input type="<?= $Page->KEU_PENCATATAN->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_PENCATATAN" name="x_KEU_PENCATATAN" id="x_KEU_PENCATATAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_PENCATATAN->getPlaceHolder()) ?>" value="<?= $Page->KEU_PENCATATAN->EditValue ?>"<?= $Page->KEU_PENCATATAN->editAttributes() ?> aria-describedby="x_KEU_PENCATATAN_help">
<?= $Page->KEU_PENCATATAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_PENCATATAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
    <div id="r_KEU_LAPORAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_LAPORAN" for="x_KEU_LAPORAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_LAPORAN->caption() ?><?= $Page->KEU_LAPORAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_LAPORAN">
<input type="<?= $Page->KEU_LAPORAN->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_LAPORAN" name="x_KEU_LAPORAN" id="x_KEU_LAPORAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_LAPORAN->getPlaceHolder()) ?>" value="<?= $Page->KEU_LAPORAN->EditValue ?>"<?= $Page->KEU_LAPORAN->editAttributes() ?> aria-describedby="x_KEU_LAPORAN_help">
<?= $Page->KEU_LAPORAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_LAPORAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
    <div id="r_KEU_UTANGMODAL" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_UTANGMODAL" for="x_KEU_UTANGMODAL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_UTANGMODAL->caption() ?><?= $Page->KEU_UTANGMODAL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_UTANGMODAL">
<input type="<?= $Page->KEU_UTANGMODAL->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_UTANGMODAL" name="x_KEU_UTANGMODAL" id="x_KEU_UTANGMODAL" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_UTANGMODAL->getPlaceHolder()) ?>" value="<?= $Page->KEU_UTANGMODAL->EditValue ?>"<?= $Page->KEU_UTANGMODAL->editAttributes() ?> aria-describedby="x_KEU_UTANGMODAL_help">
<?= $Page->KEU_UTANGMODAL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_UTANGMODAL->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
    <div id="r_KEU_CATATNASET" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_CATATNASET" for="x_KEU_CATATNASET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_CATATNASET->caption() ?><?= $Page->KEU_CATATNASET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_CATATNASET">
<input type="<?= $Page->KEU_CATATNASET->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_CATATNASET" name="x_KEU_CATATNASET" id="x_KEU_CATATNASET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_CATATNASET->getPlaceHolder()) ?>" value="<?= $Page->KEU_CATATNASET->EditValue ?>"<?= $Page->KEU_CATATNASET->editAttributes() ?> aria-describedby="x_KEU_CATATNASET_help">
<?= $Page->KEU_CATATNASET->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_CATATNASET->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
    <div id="r_KEU_NONTUNAI" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_lm_KEU_NONTUNAI" for="x_KEU_NONTUNAI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NONTUNAI->caption() ?><?= $Page->KEU_NONTUNAI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_lm_KEU_NONTUNAI">
<input type="<?= $Page->KEU_NONTUNAI->getInputTextType() ?>" data-table="umkm_aspekkeuangan_lm" data-field="x_KEU_NONTUNAI" name="x_KEU_NONTUNAI" id="x_KEU_NONTUNAI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KEU_NONTUNAI->getPlaceHolder()) ?>" value="<?= $Page->KEU_NONTUNAI->EditValue ?>"<?= $Page->KEU_NONTUNAI->editAttributes() ?> aria-describedby="x_KEU_NONTUNAI_help">
<?= $Page->KEU_NONTUNAI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KEU_NONTUNAI->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_aspekkeuangan_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
