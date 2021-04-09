<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaUmkmPesertaCopyAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbina_umkm_peserta_copyadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fbina_umkm_peserta_copyadd = currentForm = new ew.Form("fbina_umkm_peserta_copyadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "bina_umkm_peserta_copy")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.bina_umkm_peserta_copy)
        ew.vars.tables.bina_umkm_peserta_copy = currentTable;
    fbina_umkm_peserta_copyadd.addFields([
        ["id_binadata", [fields.id_binadata.visible && fields.id_binadata.required ? ew.Validators.required(fields.id_binadata.caption) : null, ew.Validators.integer], fields.id_binadata.isInvalid],
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["status", [fields.status.visible && fields.status.required ? ew.Validators.required(fields.status.caption) : null], fields.status.isInvalid],
        ["catatan", [fields.catatan.visible && fields.catatan.required ? ew.Validators.required(fields.catatan.caption) : null], fields.catatan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbina_umkm_peserta_copyadd,
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
    fbina_umkm_peserta_copyadd.validate = function () {
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
    fbina_umkm_peserta_copyadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbina_umkm_peserta_copyadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbina_umkm_peserta_copyadd");
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
<form name="fbina_umkm_peserta_copyadd" id="fbina_umkm_peserta_copyadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_umkm_peserta_copy">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id_binadata->Visible) { // id_binadata ?>
    <div id="r_id_binadata" class="form-group row">
        <label id="elh_bina_umkm_peserta_copy_id_binadata" for="x_id_binadata" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id_binadata->caption() ?><?= $Page->id_binadata->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id_binadata->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_copy_id_binadata">
<input type="<?= $Page->id_binadata->getInputTextType() ?>" data-table="bina_umkm_peserta_copy" data-field="x_id_binadata" name="x_id_binadata" id="x_id_binadata" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->id_binadata->getPlaceHolder()) ?>" value="<?= $Page->id_binadata->EditValue ?>"<?= $Page->id_binadata->editAttributes() ?> aria-describedby="x_id_binadata_help">
<?= $Page->id_binadata->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id_binadata->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_bina_umkm_peserta_copy_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_copy_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="bina_umkm_peserta_copy" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->status->Visible) { // status ?>
    <div id="r_status" class="form-group row">
        <label id="elh_bina_umkm_peserta_copy_status" for="x_status" class="<?= $Page->LeftColumnClass ?>"><?= $Page->status->caption() ?><?= $Page->status->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->status->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_copy_status">
<input type="<?= $Page->status->getInputTextType() ?>" data-table="bina_umkm_peserta_copy" data-field="x_status" name="x_status" id="x_status" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->status->getPlaceHolder()) ?>" value="<?= $Page->status->EditValue ?>"<?= $Page->status->editAttributes() ?> aria-describedby="x_status_help">
<?= $Page->status->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->status->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <div id="r_catatan" class="form-group row">
        <label id="elh_bina_umkm_peserta_copy_catatan" for="x_catatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catatan->caption() ?><?= $Page->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catatan->cellAttributes() ?>>
<span id="el_bina_umkm_peserta_copy_catatan">
<input type="<?= $Page->catatan->getInputTextType() ?>" data-table="bina_umkm_peserta_copy" data-field="x_catatan" name="x_catatan" id="x_catatan" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->catatan->getPlaceHolder()) ?>" value="<?= $Page->catatan->EditValue ?>"<?= $Page->catatan->editAttributes() ?> aria-describedby="x_catatan_help">
<?= $Page->catatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->catatan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("bina_umkm_peserta_copy");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
