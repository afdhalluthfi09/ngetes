<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorSdmEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_sdmedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftemp_skor_sdmedit = currentForm = new ew.Form("ftemp_skor_sdmedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_sdm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_sdm)
        ew.vars.tables.temp_skor_sdm = currentTable;
    ftemp_skor_sdmedit.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["skor_oms", [fields.skor_oms.visible && fields.skor_oms.required ? ew.Validators.required(fields.skor_oms.caption) : null, ew.Validators.float], fields.skor_oms.isInvalid],
        ["max_oms", [fields.max_oms.visible && fields.max_oms.required ? ew.Validators.required(fields.max_oms.caption) : null, ew.Validators.float], fields.max_oms.isInvalid],
        ["skor_fokus", [fields.skor_fokus.visible && fields.skor_fokus.required ? ew.Validators.required(fields.skor_fokus.caption) : null, ew.Validators.float], fields.skor_fokus.isInvalid],
        ["max_fokus", [fields.max_fokus.visible && fields.max_fokus.required ? ew.Validators.required(fields.max_fokus.caption) : null, ew.Validators.float], fields.max_fokus.isInvalid],
        ["skor_target", [fields.skor_target.visible && fields.skor_target.required ? ew.Validators.required(fields.skor_target.caption) : null, ew.Validators.float], fields.skor_target.isInvalid],
        ["max_target", [fields.max_target.visible && fields.max_target.required ? ew.Validators.required(fields.max_target.caption) : null, ew.Validators.float], fields.max_target.isInvalid],
        ["skor_karyawan", [fields.skor_karyawan.visible && fields.skor_karyawan.required ? ew.Validators.required(fields.skor_karyawan.caption) : null, ew.Validators.float], fields.skor_karyawan.isInvalid],
        ["max_karyawan", [fields.max_karyawan.visible && fields.max_karyawan.required ? ew.Validators.required(fields.max_karyawan.caption) : null, ew.Validators.float], fields.max_karyawan.isInvalid],
        ["skor_outsource", [fields.skor_outsource.visible && fields.skor_outsource.required ? ew.Validators.required(fields.skor_outsource.caption) : null, ew.Validators.float], fields.skor_outsource.isInvalid],
        ["max_outsource", [fields.max_outsource.visible && fields.max_outsource.required ? ew.Validators.required(fields.max_outsource.caption) : null, ew.Validators.float], fields.max_outsource.isInvalid],
        ["skor_besarangaji", [fields.skor_besarangaji.visible && fields.skor_besarangaji.required ? ew.Validators.required(fields.skor_besarangaji.caption) : null, ew.Validators.float], fields.skor_besarangaji.isInvalid],
        ["max_besarangaji", [fields.max_besarangaji.visible && fields.max_besarangaji.required ? ew.Validators.required(fields.max_besarangaji.caption) : null, ew.Validators.float], fields.max_besarangaji.isInvalid],
        ["skor_asuransi", [fields.skor_asuransi.visible && fields.skor_asuransi.required ? ew.Validators.required(fields.skor_asuransi.caption) : null, ew.Validators.float], fields.skor_asuransi.isInvalid],
        ["max_asuransi", [fields.max_asuransi.visible && fields.max_asuransi.required ? ew.Validators.required(fields.max_asuransi.caption) : null, ew.Validators.float], fields.max_asuransi.isInvalid],
        ["skor_bonus", [fields.skor_bonus.visible && fields.skor_bonus.required ? ew.Validators.required(fields.skor_bonus.caption) : null, ew.Validators.float], fields.skor_bonus.isInvalid],
        ["max_bonus", [fields.max_bonus.visible && fields.max_bonus.required ? ew.Validators.required(fields.max_bonus.caption) : null, ew.Validators.float], fields.max_bonus.isInvalid],
        ["skor_training", [fields.skor_training.visible && fields.skor_training.required ? ew.Validators.required(fields.skor_training.caption) : null, ew.Validators.float], fields.skor_training.isInvalid],
        ["max_training", [fields.max_training.visible && fields.max_training.required ? ew.Validators.required(fields.max_training.caption) : null, ew.Validators.float], fields.max_training.isInvalid],
        ["skor_sdm", [fields.skor_sdm.visible && fields.skor_sdm.required ? ew.Validators.required(fields.skor_sdm.caption) : null, ew.Validators.float], fields.skor_sdm.isInvalid],
        ["maxskor_sdm", [fields.maxskor_sdm.visible && fields.maxskor_sdm.required ? ew.Validators.required(fields.maxskor_sdm.caption) : null, ew.Validators.float], fields.maxskor_sdm.isInvalid],
        ["bobot_sdm", [fields.bobot_sdm.visible && fields.bobot_sdm.required ? ew.Validators.required(fields.bobot_sdm.caption) : null, ew.Validators.integer], fields.bobot_sdm.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_sdmedit,
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
    ftemp_skor_sdmedit.validate = function () {
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
    ftemp_skor_sdmedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_sdmedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_sdmedit");
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
<form name="ftemp_skor_sdmedit" id="ftemp_skor_sdmedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_sdm">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_sdm_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
<input type="hidden" data-table="temp_skor_sdm" data-field="x_nik" data-hidden="1" name="o_nik" id="o_nik" value="<?= HtmlEncode($Page->nik->OldValue ?? $Page->nik->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_oms->Visible) { // skor_oms ?>
    <div id="r_skor_oms" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_oms" for="x_skor_oms" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_oms->caption() ?><?= $Page->skor_oms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_oms->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_oms">
<input type="<?= $Page->skor_oms->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_oms" name="x_skor_oms" id="x_skor_oms" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_oms->getPlaceHolder()) ?>" value="<?= $Page->skor_oms->EditValue ?>"<?= $Page->skor_oms->editAttributes() ?> aria-describedby="x_skor_oms_help">
<?= $Page->skor_oms->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_oms->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_oms->Visible) { // max_oms ?>
    <div id="r_max_oms" class="form-group row">
        <label id="elh_temp_skor_sdm_max_oms" for="x_max_oms" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_oms->caption() ?><?= $Page->max_oms->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_oms->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_oms">
<input type="<?= $Page->max_oms->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_oms" name="x_max_oms" id="x_max_oms" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_oms->getPlaceHolder()) ?>" value="<?= $Page->max_oms->EditValue ?>"<?= $Page->max_oms->editAttributes() ?> aria-describedby="x_max_oms_help">
<?= $Page->max_oms->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_oms->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_fokus->Visible) { // skor_fokus ?>
    <div id="r_skor_fokus" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_fokus" for="x_skor_fokus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_fokus->caption() ?><?= $Page->skor_fokus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_fokus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_fokus">
<input type="<?= $Page->skor_fokus->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_fokus" name="x_skor_fokus" id="x_skor_fokus" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_fokus->getPlaceHolder()) ?>" value="<?= $Page->skor_fokus->EditValue ?>"<?= $Page->skor_fokus->editAttributes() ?> aria-describedby="x_skor_fokus_help">
<?= $Page->skor_fokus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_fokus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_fokus->Visible) { // max_fokus ?>
    <div id="r_max_fokus" class="form-group row">
        <label id="elh_temp_skor_sdm_max_fokus" for="x_max_fokus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_fokus->caption() ?><?= $Page->max_fokus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_fokus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_fokus">
<input type="<?= $Page->max_fokus->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_fokus" name="x_max_fokus" id="x_max_fokus" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_fokus->getPlaceHolder()) ?>" value="<?= $Page->max_fokus->EditValue ?>"<?= $Page->max_fokus->editAttributes() ?> aria-describedby="x_max_fokus_help">
<?= $Page->max_fokus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_fokus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
    <div id="r_skor_target" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_target" for="x_skor_target" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_target->caption() ?><?= $Page->skor_target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_target->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_target">
<input type="<?= $Page->skor_target->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_target" name="x_skor_target" id="x_skor_target" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_target->getPlaceHolder()) ?>" value="<?= $Page->skor_target->EditValue ?>"<?= $Page->skor_target->editAttributes() ?> aria-describedby="x_skor_target_help">
<?= $Page->skor_target->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_target->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
    <div id="r_max_target" class="form-group row">
        <label id="elh_temp_skor_sdm_max_target" for="x_max_target" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_target->caption() ?><?= $Page->max_target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_target->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_target">
<input type="<?= $Page->max_target->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_target" name="x_max_target" id="x_max_target" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_target->getPlaceHolder()) ?>" value="<?= $Page->max_target->EditValue ?>"<?= $Page->max_target->editAttributes() ?> aria-describedby="x_max_target_help">
<?= $Page->max_target->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_target->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_karyawan->Visible) { // skor_karyawan ?>
    <div id="r_skor_karyawan" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_karyawan" for="x_skor_karyawan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_karyawan->caption() ?><?= $Page->skor_karyawan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_karyawan->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_karyawan">
<input type="<?= $Page->skor_karyawan->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_karyawan" name="x_skor_karyawan" id="x_skor_karyawan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_karyawan->getPlaceHolder()) ?>" value="<?= $Page->skor_karyawan->EditValue ?>"<?= $Page->skor_karyawan->editAttributes() ?> aria-describedby="x_skor_karyawan_help">
<?= $Page->skor_karyawan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_karyawan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_karyawan->Visible) { // max_karyawan ?>
    <div id="r_max_karyawan" class="form-group row">
        <label id="elh_temp_skor_sdm_max_karyawan" for="x_max_karyawan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_karyawan->caption() ?><?= $Page->max_karyawan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_karyawan->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_karyawan">
<input type="<?= $Page->max_karyawan->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_karyawan" name="x_max_karyawan" id="x_max_karyawan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_karyawan->getPlaceHolder()) ?>" value="<?= $Page->max_karyawan->EditValue ?>"<?= $Page->max_karyawan->editAttributes() ?> aria-describedby="x_max_karyawan_help">
<?= $Page->max_karyawan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_karyawan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_outsource->Visible) { // skor_outsource ?>
    <div id="r_skor_outsource" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_outsource" for="x_skor_outsource" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_outsource->caption() ?><?= $Page->skor_outsource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_outsource->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_outsource">
<input type="<?= $Page->skor_outsource->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_outsource" name="x_skor_outsource" id="x_skor_outsource" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_outsource->getPlaceHolder()) ?>" value="<?= $Page->skor_outsource->EditValue ?>"<?= $Page->skor_outsource->editAttributes() ?> aria-describedby="x_skor_outsource_help">
<?= $Page->skor_outsource->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_outsource->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_outsource->Visible) { // max_outsource ?>
    <div id="r_max_outsource" class="form-group row">
        <label id="elh_temp_skor_sdm_max_outsource" for="x_max_outsource" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_outsource->caption() ?><?= $Page->max_outsource->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_outsource->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_outsource">
<input type="<?= $Page->max_outsource->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_outsource" name="x_max_outsource" id="x_max_outsource" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_outsource->getPlaceHolder()) ?>" value="<?= $Page->max_outsource->EditValue ?>"<?= $Page->max_outsource->editAttributes() ?> aria-describedby="x_max_outsource_help">
<?= $Page->max_outsource->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_outsource->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_besarangaji->Visible) { // skor_besarangaji ?>
    <div id="r_skor_besarangaji" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_besarangaji" for="x_skor_besarangaji" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_besarangaji->caption() ?><?= $Page->skor_besarangaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_besarangaji->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_besarangaji">
<input type="<?= $Page->skor_besarangaji->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_besarangaji" name="x_skor_besarangaji" id="x_skor_besarangaji" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_besarangaji->getPlaceHolder()) ?>" value="<?= $Page->skor_besarangaji->EditValue ?>"<?= $Page->skor_besarangaji->editAttributes() ?> aria-describedby="x_skor_besarangaji_help">
<?= $Page->skor_besarangaji->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_besarangaji->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_besarangaji->Visible) { // max_besarangaji ?>
    <div id="r_max_besarangaji" class="form-group row">
        <label id="elh_temp_skor_sdm_max_besarangaji" for="x_max_besarangaji" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_besarangaji->caption() ?><?= $Page->max_besarangaji->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_besarangaji->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_besarangaji">
<input type="<?= $Page->max_besarangaji->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_besarangaji" name="x_max_besarangaji" id="x_max_besarangaji" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_besarangaji->getPlaceHolder()) ?>" value="<?= $Page->max_besarangaji->EditValue ?>"<?= $Page->max_besarangaji->editAttributes() ?> aria-describedby="x_max_besarangaji_help">
<?= $Page->max_besarangaji->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_besarangaji->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_asuransi->Visible) { // skor_asuransi ?>
    <div id="r_skor_asuransi" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_asuransi" for="x_skor_asuransi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_asuransi->caption() ?><?= $Page->skor_asuransi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_asuransi->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_asuransi">
<input type="<?= $Page->skor_asuransi->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_asuransi" name="x_skor_asuransi" id="x_skor_asuransi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_asuransi->getPlaceHolder()) ?>" value="<?= $Page->skor_asuransi->EditValue ?>"<?= $Page->skor_asuransi->editAttributes() ?> aria-describedby="x_skor_asuransi_help">
<?= $Page->skor_asuransi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_asuransi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_asuransi->Visible) { // max_asuransi ?>
    <div id="r_max_asuransi" class="form-group row">
        <label id="elh_temp_skor_sdm_max_asuransi" for="x_max_asuransi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_asuransi->caption() ?><?= $Page->max_asuransi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_asuransi->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_asuransi">
<input type="<?= $Page->max_asuransi->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_asuransi" name="x_max_asuransi" id="x_max_asuransi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_asuransi->getPlaceHolder()) ?>" value="<?= $Page->max_asuransi->EditValue ?>"<?= $Page->max_asuransi->editAttributes() ?> aria-describedby="x_max_asuransi_help">
<?= $Page->max_asuransi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_asuransi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_bonus->Visible) { // skor_bonus ?>
    <div id="r_skor_bonus" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_bonus" for="x_skor_bonus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_bonus->caption() ?><?= $Page->skor_bonus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_bonus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_bonus">
<input type="<?= $Page->skor_bonus->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_bonus" name="x_skor_bonus" id="x_skor_bonus" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_bonus->getPlaceHolder()) ?>" value="<?= $Page->skor_bonus->EditValue ?>"<?= $Page->skor_bonus->editAttributes() ?> aria-describedby="x_skor_bonus_help">
<?= $Page->skor_bonus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_bonus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_bonus->Visible) { // max_bonus ?>
    <div id="r_max_bonus" class="form-group row">
        <label id="elh_temp_skor_sdm_max_bonus" for="x_max_bonus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_bonus->caption() ?><?= $Page->max_bonus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_bonus->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_bonus">
<input type="<?= $Page->max_bonus->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_bonus" name="x_max_bonus" id="x_max_bonus" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_bonus->getPlaceHolder()) ?>" value="<?= $Page->max_bonus->EditValue ?>"<?= $Page->max_bonus->editAttributes() ?> aria-describedby="x_max_bonus_help">
<?= $Page->max_bonus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_bonus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_training->Visible) { // skor_training ?>
    <div id="r_skor_training" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_training" for="x_skor_training" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_training->caption() ?><?= $Page->skor_training->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_training->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_training">
<input type="<?= $Page->skor_training->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_training" name="x_skor_training" id="x_skor_training" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_training->getPlaceHolder()) ?>" value="<?= $Page->skor_training->EditValue ?>"<?= $Page->skor_training->editAttributes() ?> aria-describedby="x_skor_training_help">
<?= $Page->skor_training->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_training->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_training->Visible) { // max_training ?>
    <div id="r_max_training" class="form-group row">
        <label id="elh_temp_skor_sdm_max_training" for="x_max_training" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_training->caption() ?><?= $Page->max_training->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_training->cellAttributes() ?>>
<span id="el_temp_skor_sdm_max_training">
<input type="<?= $Page->max_training->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_max_training" name="x_max_training" id="x_max_training" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_training->getPlaceHolder()) ?>" value="<?= $Page->max_training->EditValue ?>"<?= $Page->max_training->editAttributes() ?> aria-describedby="x_max_training_help">
<?= $Page->max_training->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_training->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
    <div id="r_skor_sdm" class="form-group row">
        <label id="elh_temp_skor_sdm_skor_sdm" for="x_skor_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_sdm->caption() ?><?= $Page->skor_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_skor_sdm">
<input type="<?= $Page->skor_sdm->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_skor_sdm" name="x_skor_sdm" id="x_skor_sdm" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_sdm->getPlaceHolder()) ?>" value="<?= $Page->skor_sdm->EditValue ?>"<?= $Page->skor_sdm->editAttributes() ?> aria-describedby="x_skor_sdm_help">
<?= $Page->skor_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_sdm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
    <div id="r_maxskor_sdm" class="form-group row">
        <label id="elh_temp_skor_sdm_maxskor_sdm" for="x_maxskor_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_sdm->caption() ?><?= $Page->maxskor_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_maxskor_sdm">
<input type="<?= $Page->maxskor_sdm->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_maxskor_sdm" name="x_maxskor_sdm" id="x_maxskor_sdm" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_sdm->getPlaceHolder()) ?>" value="<?= $Page->maxskor_sdm->EditValue ?>"<?= $Page->maxskor_sdm->editAttributes() ?> aria-describedby="x_maxskor_sdm_help">
<?= $Page->maxskor_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_sdm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
    <div id="r_bobot_sdm" class="form-group row">
        <label id="elh_temp_skor_sdm_bobot_sdm" for="x_bobot_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_sdm->caption() ?><?= $Page->bobot_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el_temp_skor_sdm_bobot_sdm">
<input type="<?= $Page->bobot_sdm->getInputTextType() ?>" data-table="temp_skor_sdm" data-field="x_bobot_sdm" name="x_bobot_sdm" id="x_bobot_sdm" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_sdm->getPlaceHolder()) ?>" value="<?= $Page->bobot_sdm->EditValue ?>"<?= $Page->bobot_sdm->editAttributes() ?> aria-describedby="x_bobot_sdm_help">
<?= $Page->bobot_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_sdm->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_sdm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
