<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmLmAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdm_lmadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspeksdm_lmadd = currentForm = new ew.Form("fumkm_aspeksdm_lmadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeksdm_lm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeksdm_lm)
        ew.vars.tables.umkm_aspeksdm_lm = currentTable;
    fumkm_aspeksdm_lmadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["SDM_OMS", [fields.SDM_OMS.visible && fields.SDM_OMS.required ? ew.Validators.required(fields.SDM_OMS.caption) : null], fields.SDM_OMS.isInvalid],
        ["SDM_FOKUS", [fields.SDM_FOKUS.visible && fields.SDM_FOKUS.required ? ew.Validators.required(fields.SDM_FOKUS.caption) : null], fields.SDM_FOKUS.isInvalid],
        ["SDM_TARGET", [fields.SDM_TARGET.visible && fields.SDM_TARGET.required ? ew.Validators.required(fields.SDM_TARGET.caption) : null], fields.SDM_TARGET.isInvalid],
        ["SDM_KARYAWANTETAP", [fields.SDM_KARYAWANTETAP.visible && fields.SDM_KARYAWANTETAP.required ? ew.Validators.required(fields.SDM_KARYAWANTETAP.caption) : null], fields.SDM_KARYAWANTETAP.isInvalid],
        ["SDM_KARYAWANSUBKON", [fields.SDM_KARYAWANSUBKON.visible && fields.SDM_KARYAWANSUBKON.required ? ew.Validators.required(fields.SDM_KARYAWANSUBKON.caption) : null], fields.SDM_KARYAWANSUBKON.isInvalid],
        ["SDM_GAJI", [fields.SDM_GAJI.visible && fields.SDM_GAJI.required ? ew.Validators.required(fields.SDM_GAJI.caption) : null], fields.SDM_GAJI.isInvalid],
        ["SDM_ASURANSI", [fields.SDM_ASURANSI.visible && fields.SDM_ASURANSI.required ? ew.Validators.required(fields.SDM_ASURANSI.caption) : null], fields.SDM_ASURANSI.isInvalid],
        ["SDM_TUNJANGAN", [fields.SDM_TUNJANGAN.visible && fields.SDM_TUNJANGAN.required ? ew.Validators.required(fields.SDM_TUNJANGAN.caption) : null], fields.SDM_TUNJANGAN.isInvalid],
        ["SDM_PELATIHAN", [fields.SDM_PELATIHAN.visible && fields.SDM_PELATIHAN.required ? ew.Validators.required(fields.SDM_PELATIHAN.caption) : null], fields.SDM_PELATIHAN.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeksdm_lmadd,
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
    fumkm_aspeksdm_lmadd.validate = function () {
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
    fumkm_aspeksdm_lmadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeksdm_lmadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_aspeksdm_lmadd");
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
<form name="fumkm_aspeksdm_lmadd" id="fumkm_aspeksdm_lmadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm_lm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_NIK">
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
    <div id="r_SDM_OMS" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_OMS" for="x_SDM_OMS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_OMS->caption() ?><?= $Page->SDM_OMS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_OMS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_OMS">
<input type="<?= $Page->SDM_OMS->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_OMS" name="x_SDM_OMS" id="x_SDM_OMS" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_OMS->getPlaceHolder()) ?>" value="<?= $Page->SDM_OMS->EditValue ?>"<?= $Page->SDM_OMS->editAttributes() ?> aria-describedby="x_SDM_OMS_help">
<?= $Page->SDM_OMS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_OMS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
    <div id="r_SDM_FOKUS" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_FOKUS" for="x_SDM_FOKUS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_FOKUS->caption() ?><?= $Page->SDM_FOKUS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_FOKUS">
<input type="<?= $Page->SDM_FOKUS->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_FOKUS" name="x_SDM_FOKUS" id="x_SDM_FOKUS" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_FOKUS->getPlaceHolder()) ?>" value="<?= $Page->SDM_FOKUS->EditValue ?>"<?= $Page->SDM_FOKUS->editAttributes() ?> aria-describedby="x_SDM_FOKUS_help">
<?= $Page->SDM_FOKUS->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_FOKUS->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
    <div id="r_SDM_TARGET" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_TARGET" for="x_SDM_TARGET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TARGET->caption() ?><?= $Page->SDM_TARGET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TARGET->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_TARGET">
<input type="<?= $Page->SDM_TARGET->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_TARGET" name="x_SDM_TARGET" id="x_SDM_TARGET" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_TARGET->getPlaceHolder()) ?>" value="<?= $Page->SDM_TARGET->EditValue ?>"<?= $Page->SDM_TARGET->editAttributes() ?> aria-describedby="x_SDM_TARGET_help">
<?= $Page->SDM_TARGET->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_TARGET->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
    <div id="r_SDM_KARYAWANTETAP" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_KARYAWANTETAP" for="x_SDM_KARYAWANTETAP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANTETAP->caption() ?><?= $Page->SDM_KARYAWANTETAP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_KARYAWANTETAP">
<input type="<?= $Page->SDM_KARYAWANTETAP->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_KARYAWANTETAP" name="x_SDM_KARYAWANTETAP" id="x_SDM_KARYAWANTETAP" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_KARYAWANTETAP->getPlaceHolder()) ?>" value="<?= $Page->SDM_KARYAWANTETAP->EditValue ?>"<?= $Page->SDM_KARYAWANTETAP->editAttributes() ?> aria-describedby="x_SDM_KARYAWANTETAP_help">
<?= $Page->SDM_KARYAWANTETAP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_KARYAWANTETAP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
    <div id="r_SDM_KARYAWANSUBKON" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON" for="x_SDM_KARYAWANSUBKON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANSUBKON->caption() ?><?= $Page->SDM_KARYAWANSUBKON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_KARYAWANSUBKON">
<input type="<?= $Page->SDM_KARYAWANSUBKON->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_KARYAWANSUBKON" name="x_SDM_KARYAWANSUBKON" id="x_SDM_KARYAWANSUBKON" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_KARYAWANSUBKON->getPlaceHolder()) ?>" value="<?= $Page->SDM_KARYAWANSUBKON->EditValue ?>"<?= $Page->SDM_KARYAWANSUBKON->editAttributes() ?> aria-describedby="x_SDM_KARYAWANSUBKON_help">
<?= $Page->SDM_KARYAWANSUBKON->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_KARYAWANSUBKON->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
    <div id="r_SDM_GAJI" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_GAJI" for="x_SDM_GAJI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_GAJI->caption() ?><?= $Page->SDM_GAJI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_GAJI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_GAJI">
<input type="<?= $Page->SDM_GAJI->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_GAJI" name="x_SDM_GAJI" id="x_SDM_GAJI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_GAJI->getPlaceHolder()) ?>" value="<?= $Page->SDM_GAJI->EditValue ?>"<?= $Page->SDM_GAJI->editAttributes() ?> aria-describedby="x_SDM_GAJI_help">
<?= $Page->SDM_GAJI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_GAJI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
    <div id="r_SDM_ASURANSI" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_ASURANSI" for="x_SDM_ASURANSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_ASURANSI->caption() ?><?= $Page->SDM_ASURANSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_ASURANSI">
<input type="<?= $Page->SDM_ASURANSI->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_ASURANSI" name="x_SDM_ASURANSI" id="x_SDM_ASURANSI" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_ASURANSI->getPlaceHolder()) ?>" value="<?= $Page->SDM_ASURANSI->EditValue ?>"<?= $Page->SDM_ASURANSI->editAttributes() ?> aria-describedby="x_SDM_ASURANSI_help">
<?= $Page->SDM_ASURANSI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_ASURANSI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
    <div id="r_SDM_TUNJANGAN" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_TUNJANGAN" for="x_SDM_TUNJANGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TUNJANGAN->caption() ?><?= $Page->SDM_TUNJANGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_TUNJANGAN">
<input type="<?= $Page->SDM_TUNJANGAN->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_TUNJANGAN" name="x_SDM_TUNJANGAN" id="x_SDM_TUNJANGAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_TUNJANGAN->getPlaceHolder()) ?>" value="<?= $Page->SDM_TUNJANGAN->EditValue ?>"<?= $Page->SDM_TUNJANGAN->editAttributes() ?> aria-describedby="x_SDM_TUNJANGAN_help">
<?= $Page->SDM_TUNJANGAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_TUNJANGAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
    <div id="r_SDM_PELATIHAN" class="form-group row">
        <label id="elh_umkm_aspeksdm_lm_SDM_PELATIHAN" for="x_SDM_PELATIHAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_PELATIHAN->caption() ?><?= $Page->SDM_PELATIHAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_lm_SDM_PELATIHAN">
<input type="<?= $Page->SDM_PELATIHAN->getInputTextType() ?>" data-table="umkm_aspeksdm_lm" data-field="x_SDM_PELATIHAN" name="x_SDM_PELATIHAN" id="x_SDM_PELATIHAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SDM_PELATIHAN->getPlaceHolder()) ?>" value="<?= $Page->SDM_PELATIHAN->EditValue ?>"<?= $Page->SDM_PELATIHAN->editAttributes() ?> aria-describedby="x_SDM_PELATIHAN_help">
<?= $Page->SDM_PELATIHAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SDM_PELATIHAN->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_aspeksdm_lm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
