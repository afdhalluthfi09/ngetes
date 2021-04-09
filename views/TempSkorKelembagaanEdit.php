<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelembagaanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelembagaanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftemp_skor_kelembagaanedit = currentForm = new ew.Form("ftemp_skor_kelembagaanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelembagaan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_kelembagaan)
        ew.vars.tables.temp_skor_kelembagaan = currentTable;
    ftemp_skor_kelembagaanedit.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["skor_badanhukum", [fields.skor_badanhukum.visible && fields.skor_badanhukum.required ? ew.Validators.required(fields.skor_badanhukum.caption) : null, ew.Validators.float], fields.skor_badanhukum.isInvalid],
        ["max_badanhukum", [fields.max_badanhukum.visible && fields.max_badanhukum.required ? ew.Validators.required(fields.max_badanhukum.caption) : null, ew.Validators.float], fields.max_badanhukum.isInvalid],
        ["skor_izin", [fields.skor_izin.visible && fields.skor_izin.required ? ew.Validators.required(fields.skor_izin.caption) : null, ew.Validators.float], fields.skor_izin.isInvalid],
        ["max_izin", [fields.max_izin.visible && fields.max_izin.required ? ew.Validators.required(fields.max_izin.caption) : null, ew.Validators.float], fields.max_izin.isInvalid],
        ["skor_npwp", [fields.skor_npwp.visible && fields.skor_npwp.required ? ew.Validators.required(fields.skor_npwp.caption) : null, ew.Validators.float], fields.skor_npwp.isInvalid],
        ["max_npwp", [fields.max_npwp.visible && fields.max_npwp.required ? ew.Validators.required(fields.max_npwp.caption) : null, ew.Validators.float], fields.max_npwp.isInvalid],
        ["skor_struktur", [fields.skor_struktur.visible && fields.skor_struktur.required ? ew.Validators.required(fields.skor_struktur.caption) : null, ew.Validators.float], fields.skor_struktur.isInvalid],
        ["max_struktur", [fields.max_struktur.visible && fields.max_struktur.required ? ew.Validators.required(fields.max_struktur.caption) : null, ew.Validators.float], fields.max_struktur.isInvalid],
        ["skor_jobdesk", [fields.skor_jobdesk.visible && fields.skor_jobdesk.required ? ew.Validators.required(fields.skor_jobdesk.caption) : null, ew.Validators.float], fields.skor_jobdesk.isInvalid],
        ["max_jobdesk", [fields.max_jobdesk.visible && fields.max_jobdesk.required ? ew.Validators.required(fields.max_jobdesk.caption) : null, ew.Validators.float], fields.max_jobdesk.isInvalid],
        ["skor_iso", [fields.skor_iso.visible && fields.skor_iso.required ? ew.Validators.required(fields.skor_iso.caption) : null, ew.Validators.float], fields.skor_iso.isInvalid],
        ["max_iso", [fields.max_iso.visible && fields.max_iso.required ? ew.Validators.required(fields.max_iso.caption) : null, ew.Validators.float], fields.max_iso.isInvalid],
        ["skor_kelembagaan", [fields.skor_kelembagaan.visible && fields.skor_kelembagaan.required ? ew.Validators.required(fields.skor_kelembagaan.caption) : null, ew.Validators.float], fields.skor_kelembagaan.isInvalid],
        ["maxskor_kelembagaan", [fields.maxskor_kelembagaan.visible && fields.maxskor_kelembagaan.required ? ew.Validators.required(fields.maxskor_kelembagaan.caption) : null, ew.Validators.float], fields.maxskor_kelembagaan.isInvalid],
        ["bobot_kelembagaan", [fields.bobot_kelembagaan.visible && fields.bobot_kelembagaan.required ? ew.Validators.required(fields.bobot_kelembagaan.caption) : null, ew.Validators.integer], fields.bobot_kelembagaan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_kelembagaanedit,
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
    ftemp_skor_kelembagaanedit.validate = function () {
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
    ftemp_skor_kelembagaanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_kelembagaanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_kelembagaanedit");
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
<form name="ftemp_skor_kelembagaanedit" id="ftemp_skor_kelembagaanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelembagaan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
<input type="hidden" data-table="temp_skor_kelembagaan" data-field="x_nik" data-hidden="1" name="o_nik" id="o_nik" value="<?= HtmlEncode($Page->nik->OldValue ?? $Page->nik->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_badanhukum->Visible) { // skor_badanhukum ?>
    <div id="r_skor_badanhukum" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_badanhukum" for="x_skor_badanhukum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_badanhukum->caption() ?><?= $Page->skor_badanhukum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_badanhukum->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_badanhukum">
<input type="<?= $Page->skor_badanhukum->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_badanhukum" name="x_skor_badanhukum" id="x_skor_badanhukum" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_badanhukum->getPlaceHolder()) ?>" value="<?= $Page->skor_badanhukum->EditValue ?>"<?= $Page->skor_badanhukum->editAttributes() ?> aria-describedby="x_skor_badanhukum_help">
<?= $Page->skor_badanhukum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_badanhukum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_badanhukum->Visible) { // max_badanhukum ?>
    <div id="r_max_badanhukum" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_badanhukum" for="x_max_badanhukum" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_badanhukum->caption() ?><?= $Page->max_badanhukum->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_badanhukum->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_badanhukum">
<input type="<?= $Page->max_badanhukum->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_badanhukum" name="x_max_badanhukum" id="x_max_badanhukum" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_badanhukum->getPlaceHolder()) ?>" value="<?= $Page->max_badanhukum->EditValue ?>"<?= $Page->max_badanhukum->editAttributes() ?> aria-describedby="x_max_badanhukum_help">
<?= $Page->max_badanhukum->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_badanhukum->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_izin->Visible) { // skor_izin ?>
    <div id="r_skor_izin" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_izin" for="x_skor_izin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_izin->caption() ?><?= $Page->skor_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_izin->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_izin">
<input type="<?= $Page->skor_izin->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_izin" name="x_skor_izin" id="x_skor_izin" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_izin->getPlaceHolder()) ?>" value="<?= $Page->skor_izin->EditValue ?>"<?= $Page->skor_izin->editAttributes() ?> aria-describedby="x_skor_izin_help">
<?= $Page->skor_izin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_izin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_izin->Visible) { // max_izin ?>
    <div id="r_max_izin" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_izin" for="x_max_izin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_izin->caption() ?><?= $Page->max_izin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_izin->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_izin">
<input type="<?= $Page->max_izin->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_izin" name="x_max_izin" id="x_max_izin" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_izin->getPlaceHolder()) ?>" value="<?= $Page->max_izin->EditValue ?>"<?= $Page->max_izin->editAttributes() ?> aria-describedby="x_max_izin_help">
<?= $Page->max_izin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_izin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_npwp->Visible) { // skor_npwp ?>
    <div id="r_skor_npwp" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_npwp" for="x_skor_npwp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_npwp->caption() ?><?= $Page->skor_npwp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_npwp->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_npwp">
<input type="<?= $Page->skor_npwp->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_npwp" name="x_skor_npwp" id="x_skor_npwp" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_npwp->getPlaceHolder()) ?>" value="<?= $Page->skor_npwp->EditValue ?>"<?= $Page->skor_npwp->editAttributes() ?> aria-describedby="x_skor_npwp_help">
<?= $Page->skor_npwp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_npwp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_npwp->Visible) { // max_npwp ?>
    <div id="r_max_npwp" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_npwp" for="x_max_npwp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_npwp->caption() ?><?= $Page->max_npwp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_npwp->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_npwp">
<input type="<?= $Page->max_npwp->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_npwp" name="x_max_npwp" id="x_max_npwp" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_npwp->getPlaceHolder()) ?>" value="<?= $Page->max_npwp->EditValue ?>"<?= $Page->max_npwp->editAttributes() ?> aria-describedby="x_max_npwp_help">
<?= $Page->max_npwp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_npwp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_struktur->Visible) { // skor_struktur ?>
    <div id="r_skor_struktur" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_struktur" for="x_skor_struktur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_struktur->caption() ?><?= $Page->skor_struktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_struktur->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_struktur">
<input type="<?= $Page->skor_struktur->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_struktur" name="x_skor_struktur" id="x_skor_struktur" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_struktur->getPlaceHolder()) ?>" value="<?= $Page->skor_struktur->EditValue ?>"<?= $Page->skor_struktur->editAttributes() ?> aria-describedby="x_skor_struktur_help">
<?= $Page->skor_struktur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_struktur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_struktur->Visible) { // max_struktur ?>
    <div id="r_max_struktur" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_struktur" for="x_max_struktur" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_struktur->caption() ?><?= $Page->max_struktur->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_struktur->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_struktur">
<input type="<?= $Page->max_struktur->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_struktur" name="x_max_struktur" id="x_max_struktur" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_struktur->getPlaceHolder()) ?>" value="<?= $Page->max_struktur->EditValue ?>"<?= $Page->max_struktur->editAttributes() ?> aria-describedby="x_max_struktur_help">
<?= $Page->max_struktur->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_struktur->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_jobdesk->Visible) { // skor_jobdesk ?>
    <div id="r_skor_jobdesk" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_jobdesk" for="x_skor_jobdesk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_jobdesk->caption() ?><?= $Page->skor_jobdesk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_jobdesk->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_jobdesk">
<input type="<?= $Page->skor_jobdesk->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_jobdesk" name="x_skor_jobdesk" id="x_skor_jobdesk" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_jobdesk->getPlaceHolder()) ?>" value="<?= $Page->skor_jobdesk->EditValue ?>"<?= $Page->skor_jobdesk->editAttributes() ?> aria-describedby="x_skor_jobdesk_help">
<?= $Page->skor_jobdesk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_jobdesk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_jobdesk->Visible) { // max_jobdesk ?>
    <div id="r_max_jobdesk" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_jobdesk" for="x_max_jobdesk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_jobdesk->caption() ?><?= $Page->max_jobdesk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_jobdesk->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_jobdesk">
<input type="<?= $Page->max_jobdesk->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_jobdesk" name="x_max_jobdesk" id="x_max_jobdesk" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_jobdesk->getPlaceHolder()) ?>" value="<?= $Page->max_jobdesk->EditValue ?>"<?= $Page->max_jobdesk->editAttributes() ?> aria-describedby="x_max_jobdesk_help">
<?= $Page->max_jobdesk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_jobdesk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_iso->Visible) { // skor_iso ?>
    <div id="r_skor_iso" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_iso" for="x_skor_iso" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_iso->caption() ?><?= $Page->skor_iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_iso->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_iso">
<input type="<?= $Page->skor_iso->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_iso" name="x_skor_iso" id="x_skor_iso" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_iso->getPlaceHolder()) ?>" value="<?= $Page->skor_iso->EditValue ?>"<?= $Page->skor_iso->editAttributes() ?> aria-describedby="x_skor_iso_help">
<?= $Page->skor_iso->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_iso->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_iso->Visible) { // max_iso ?>
    <div id="r_max_iso" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_max_iso" for="x_max_iso" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_iso->caption() ?><?= $Page->max_iso->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_iso->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_max_iso">
<input type="<?= $Page->max_iso->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_max_iso" name="x_max_iso" id="x_max_iso" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_iso->getPlaceHolder()) ?>" value="<?= $Page->max_iso->EditValue ?>"<?= $Page->max_iso->editAttributes() ?> aria-describedby="x_max_iso_help">
<?= $Page->max_iso->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_iso->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
    <div id="r_skor_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_skor_kelembagaan" for="x_skor_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_kelembagaan->caption() ?><?= $Page->skor_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_skor_kelembagaan">
<input type="<?= $Page->skor_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_skor_kelembagaan" name="x_skor_kelembagaan" id="x_skor_kelembagaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->skor_kelembagaan->EditValue ?>"<?= $Page->skor_kelembagaan->editAttributes() ?> aria-describedby="x_skor_kelembagaan_help">
<?= $Page->skor_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_kelembagaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
    <div id="r_maxskor_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_maxskor_kelembagaan" for="x_maxskor_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_kelembagaan->caption() ?><?= $Page->maxskor_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_maxskor_kelembagaan">
<input type="<?= $Page->maxskor_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_maxskor_kelembagaan" name="x_maxskor_kelembagaan" id="x_maxskor_kelembagaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->maxskor_kelembagaan->EditValue ?>"<?= $Page->maxskor_kelembagaan->editAttributes() ?> aria-describedby="x_maxskor_kelembagaan_help">
<?= $Page->maxskor_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_kelembagaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
    <div id="r_bobot_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelembagaan_bobot_kelembagaan" for="x_bobot_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_kelembagaan->caption() ?><?= $Page->bobot_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelembagaan_bobot_kelembagaan">
<input type="<?= $Page->bobot_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelembagaan" data-field="x_bobot_kelembagaan" name="x_bobot_kelembagaan" id="x_bobot_kelembagaan" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->bobot_kelembagaan->EditValue ?>"<?= $Page->bobot_kelembagaan->editAttributes() ?> aria-describedby="x_bobot_kelembagaan_help">
<?= $Page->bobot_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_kelembagaan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_kelembagaan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
