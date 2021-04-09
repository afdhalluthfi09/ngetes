<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekproduksiLmEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekproduksi_lmedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fumkm_aspekproduksi_lmedit = currentForm = new ew.Form("fumkm_aspekproduksi_lmedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekproduksi_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekproduksi_lm)
        ew.vars.tables.umkm_aspekproduksi_lm = currentTable;
    fumkm_aspekproduksi_lmedit.addFields([
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
        var f = fumkm_aspekproduksi_lmedit,
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
    fumkm_aspekproduksi_lmedit.validate = function () {
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
    fumkm_aspekproduksi_lmedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekproduksi_lmedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspekproduksi_lmedit");
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
<form name="fumkm_aspekproduksi_lmedit" id="fumkm_aspekproduksi_lmedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekproduksi_lm">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
<input type="hidden" data-table="umkm_aspekproduksi_lm" data-field="x_NIK" data-hidden="1" name="o_NIK" id="o_NIK" value="<?= HtmlEncode($Page->NIK->OldValue ?? $Page->NIK->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_FREKUENSIPRODUKSI->Visible) { // PROD_FREKUENSIPRODUKSI ?>
    <div id="r_PROD_FREKUENSIPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI" for="x_PROD_FREKUENSIPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_FREKUENSIPRODUKSI->caption() ?><?= $Page->PROD_FREKUENSIPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_FREKUENSIPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_FREKUENSIPRODUKSI">
<input type="<?= $Page->PROD_FREKUENSIPRODUKSI->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_FREKUENSIPRODUKSI" name="x_PROD_FREKUENSIPRODUKSI" id="x_PROD_FREKUENSIPRODUKSI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_FREKUENSIPRODUKSI->getPlaceHolder()) ?>" value="<?= $Page->PROD_FREKUENSIPRODUKSI->EditValue ?>"<?= $Page->PROD_FREKUENSIPRODUKSI->editAttributes() ?> aria-describedby="x_PROD_FREKUENSIPRODUKSI_help">
<?= $Page->PROD_FREKUENSIPRODUKSI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_FREKUENSIPRODUKSI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KAPASITAS->Visible) { // PROD_KAPASITAS ?>
    <div id="r_PROD_KAPASITAS" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_KAPASITAS" for="x_PROD_KAPASITAS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KAPASITAS->caption() ?><?= $Page->PROD_KAPASITAS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KAPASITAS->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KAPASITAS">
<input type="<?= $Page->PROD_KAPASITAS->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_KAPASITAS" name="x_PROD_KAPASITAS" id="x_PROD_KAPASITAS" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_KAPASITAS->getPlaceHolder()) ?>" value="<?= $Page->PROD_KAPASITAS->EditValue ?>"<?= $Page->PROD_KAPASITAS->editAttributes() ?> aria-describedby="x_PROD_KAPASITAS_help">
<?= $Page->PROD_KAPASITAS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_KAPASITAS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KEAMANANPANGAN->Visible) { // PROD_KEAMANANPANGAN ?>
    <div id="r_PROD_KEAMANANPANGAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN" for="x_PROD_KEAMANANPANGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEAMANANPANGAN->caption() ?><?= $Page->PROD_KEAMANANPANGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEAMANANPANGAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KEAMANANPANGAN">
<input type="<?= $Page->PROD_KEAMANANPANGAN->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_KEAMANANPANGAN" name="x_PROD_KEAMANANPANGAN" id="x_PROD_KEAMANANPANGAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_KEAMANANPANGAN->getPlaceHolder()) ?>" value="<?= $Page->PROD_KEAMANANPANGAN->EditValue ?>"<?= $Page->PROD_KEAMANANPANGAN->editAttributes() ?> aria-describedby="x_PROD_KEAMANANPANGAN_help">
<?= $Page->PROD_KEAMANANPANGAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_KEAMANANPANGAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_SNI->Visible) { // PROD_SNI ?>
    <div id="r_PROD_SNI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_SNI" for="x_PROD_SNI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SNI->caption() ?><?= $Page->PROD_SNI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SNI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_SNI">
<input type="<?= $Page->PROD_SNI->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_SNI" name="x_PROD_SNI" id="x_PROD_SNI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_SNI->getPlaceHolder()) ?>" value="<?= $Page->PROD_SNI->EditValue ?>"<?= $Page->PROD_SNI->editAttributes() ?> aria-describedby="x_PROD_SNI_help">
<?= $Page->PROD_SNI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_SNI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KEMASAN->Visible) { // PROD_KEMASAN ?>
    <div id="r_PROD_KEMASAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_KEMASAN" for="x_PROD_KEMASAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KEMASAN->caption() ?><?= $Page->PROD_KEMASAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KEMASAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KEMASAN">
<input type="<?= $Page->PROD_KEMASAN->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_KEMASAN" name="x_PROD_KEMASAN" id="x_PROD_KEMASAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_KEMASAN->getPlaceHolder()) ?>" value="<?= $Page->PROD_KEMASAN->EditValue ?>"<?= $Page->PROD_KEMASAN->editAttributes() ?> aria-describedby="x_PROD_KEMASAN_help">
<?= $Page->PROD_KEMASAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_KEMASAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_KETERSEDIAANBAHANBAKU->Visible) { // PROD_KETERSEDIAANBAHANBAKU ?>
    <div id="r_PROD_KETERSEDIAANBAHANBAKU" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU" for="x_PROD_KETERSEDIAANBAHANBAKU" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->caption() ?><?= $Page->PROD_KETERSEDIAANBAHANBAKU->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_KETERSEDIAANBAHANBAKU->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_KETERSEDIAANBAHANBAKU">
<input type="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_KETERSEDIAANBAHANBAKU" name="x_PROD_KETERSEDIAANBAHANBAKU" id="x_PROD_KETERSEDIAANBAHANBAKU" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_KETERSEDIAANBAHANBAKU->getPlaceHolder()) ?>" value="<?= $Page->PROD_KETERSEDIAANBAHANBAKU->EditValue ?>"<?= $Page->PROD_KETERSEDIAANBAHANBAKU->editAttributes() ?> aria-describedby="x_PROD_KETERSEDIAANBAHANBAKU_help">
<?= $Page->PROD_KETERSEDIAANBAHANBAKU->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_KETERSEDIAANBAHANBAKU->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_ALATPRODUKSI->Visible) { // PROD_ALATPRODUKSI ?>
    <div id="r_PROD_ALATPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI" for="x_PROD_ALATPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_ALATPRODUKSI->caption() ?><?= $Page->PROD_ALATPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_ALATPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_ALATPRODUKSI">
<input type="<?= $Page->PROD_ALATPRODUKSI->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_ALATPRODUKSI" name="x_PROD_ALATPRODUKSI" id="x_PROD_ALATPRODUKSI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_ALATPRODUKSI->getPlaceHolder()) ?>" value="<?= $Page->PROD_ALATPRODUKSI->EditValue ?>"<?= $Page->PROD_ALATPRODUKSI->editAttributes() ?> aria-describedby="x_PROD_ALATPRODUKSI_help">
<?= $Page->PROD_ALATPRODUKSI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_ALATPRODUKSI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_GUDANGPENYIMPAN->Visible) { // PROD_GUDANGPENYIMPAN ?>
    <div id="r_PROD_GUDANGPENYIMPAN" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN" for="x_PROD_GUDANGPENYIMPAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_GUDANGPENYIMPAN->caption() ?><?= $Page->PROD_GUDANGPENYIMPAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_GUDANGPENYIMPAN->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_GUDANGPENYIMPAN">
<input type="<?= $Page->PROD_GUDANGPENYIMPAN->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_GUDANGPENYIMPAN" name="x_PROD_GUDANGPENYIMPAN" id="x_PROD_GUDANGPENYIMPAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_GUDANGPENYIMPAN->getPlaceHolder()) ?>" value="<?= $Page->PROD_GUDANGPENYIMPAN->EditValue ?>"<?= $Page->PROD_GUDANGPENYIMPAN->editAttributes() ?> aria-describedby="x_PROD_GUDANGPENYIMPAN_help">
<?= $Page->PROD_GUDANGPENYIMPAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_GUDANGPENYIMPAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_LAYOUTPRODUKSI->Visible) { // PROD_LAYOUTPRODUKSI ?>
    <div id="r_PROD_LAYOUTPRODUKSI" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI" for="x_PROD_LAYOUTPRODUKSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_LAYOUTPRODUKSI->caption() ?><?= $Page->PROD_LAYOUTPRODUKSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_LAYOUTPRODUKSI->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_LAYOUTPRODUKSI">
<input type="<?= $Page->PROD_LAYOUTPRODUKSI->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_LAYOUTPRODUKSI" name="x_PROD_LAYOUTPRODUKSI" id="x_PROD_LAYOUTPRODUKSI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_LAYOUTPRODUKSI->getPlaceHolder()) ?>" value="<?= $Page->PROD_LAYOUTPRODUKSI->EditValue ?>"<?= $Page->PROD_LAYOUTPRODUKSI->editAttributes() ?> aria-describedby="x_PROD_LAYOUTPRODUKSI_help">
<?= $Page->PROD_LAYOUTPRODUKSI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_LAYOUTPRODUKSI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->PROD_SOP->Visible) { // PROD_SOP ?>
    <div id="r_PROD_SOP" class="form-group row">
        <label id="elh_umkm_aspekproduksi_lm_PROD_SOP" for="x_PROD_SOP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->PROD_SOP->caption() ?><?= $Page->PROD_SOP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->PROD_SOP->cellAttributes() ?>>
<span id="el_umkm_aspekproduksi_lm_PROD_SOP">
<input type="<?= $Page->PROD_SOP->getInputTextType() ?>" data-table="umkm_aspekproduksi_lm" data-field="x_PROD_SOP" name="x_PROD_SOP" id="x_PROD_SOP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->PROD_SOP->getPlaceHolder()) ?>" value="<?= $Page->PROD_SOP->EditValue ?>"<?= $Page->PROD_SOP->editAttributes() ?> aria-describedby="x_PROD_SOP_help">
<?= $Page->PROD_SOP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->PROD_SOP->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_aspekproduksi_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
