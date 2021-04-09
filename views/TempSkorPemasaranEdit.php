<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorPemasaranEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_pemasaranedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftemp_skor_pemasaranedit = currentForm = new ew.Form("ftemp_skor_pemasaranedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_pemasaran")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_pemasaran)
        ew.vars.tables.temp_skor_pemasaran = currentTable;
    ftemp_skor_pemasaranedit.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["skor_unggul", [fields.skor_unggul.visible && fields.skor_unggul.required ? ew.Validators.required(fields.skor_unggul.caption) : null, ew.Validators.float], fields.skor_unggul.isInvalid],
        ["max_unggul", [fields.max_unggul.visible && fields.max_unggul.required ? ew.Validators.required(fields.max_unggul.caption) : null, ew.Validators.float], fields.max_unggul.isInvalid],
        ["skor_target", [fields.skor_target.visible && fields.skor_target.required ? ew.Validators.required(fields.skor_target.caption) : null, ew.Validators.float], fields.skor_target.isInvalid],
        ["max_target", [fields.max_target.visible && fields.max_target.required ? ew.Validators.required(fields.max_target.caption) : null, ew.Validators.float], fields.max_target.isInvalid],
        ["skor_available", [fields.skor_available.visible && fields.skor_available.required ? ew.Validators.required(fields.skor_available.caption) : null, ew.Validators.float], fields.skor_available.isInvalid],
        ["max_available", [fields.max_available.visible && fields.max_available.required ? ew.Validators.required(fields.max_available.caption) : null, ew.Validators.float], fields.max_available.isInvalid],
        ["skor_merk", [fields.skor_merk.visible && fields.skor_merk.required ? ew.Validators.required(fields.skor_merk.caption) : null, ew.Validators.float], fields.skor_merk.isInvalid],
        ["max_merk", [fields.max_merk.visible && fields.max_merk.required ? ew.Validators.required(fields.max_merk.caption) : null, ew.Validators.float], fields.max_merk.isInvalid],
        ["skor_merkhaki", [fields.skor_merkhaki.visible && fields.skor_merkhaki.required ? ew.Validators.required(fields.skor_merkhaki.caption) : null, ew.Validators.float], fields.skor_merkhaki.isInvalid],
        ["max_merkhaki", [fields.max_merkhaki.visible && fields.max_merkhaki.required ? ew.Validators.required(fields.max_merkhaki.caption) : null, ew.Validators.float], fields.max_merkhaki.isInvalid],
        ["skor_merkkonsep", [fields.skor_merkkonsep.visible && fields.skor_merkkonsep.required ? ew.Validators.required(fields.skor_merkkonsep.caption) : null, ew.Validators.float], fields.skor_merkkonsep.isInvalid],
        ["max_merkkonsep", [fields.max_merkkonsep.visible && fields.max_merkkonsep.required ? ew.Validators.required(fields.max_merkkonsep.caption) : null, ew.Validators.float], fields.max_merkkonsep.isInvalid],
        ["skor_merklisensi", [fields.skor_merklisensi.visible && fields.skor_merklisensi.required ? ew.Validators.required(fields.skor_merklisensi.caption) : null, ew.Validators.float], fields.skor_merklisensi.isInvalid],
        ["max_merklisensi", [fields.max_merklisensi.visible && fields.max_merklisensi.required ? ew.Validators.required(fields.max_merklisensi.caption) : null, ew.Validators.float], fields.max_merklisensi.isInvalid],
        ["skor_mitra", [fields.skor_mitra.visible && fields.skor_mitra.required ? ew.Validators.required(fields.skor_mitra.caption) : null, ew.Validators.float], fields.skor_mitra.isInvalid],
        ["max_mitra", [fields.max_mitra.visible && fields.max_mitra.required ? ew.Validators.required(fields.max_mitra.caption) : null, ew.Validators.float], fields.max_mitra.isInvalid],
        ["skor_market", [fields.skor_market.visible && fields.skor_market.required ? ew.Validators.required(fields.skor_market.caption) : null, ew.Validators.float], fields.skor_market.isInvalid],
        ["max_market", [fields.max_market.visible && fields.max_market.required ? ew.Validators.required(fields.max_market.caption) : null, ew.Validators.float], fields.max_market.isInvalid],
        ["skor_pelangganloyal", [fields.skor_pelangganloyal.visible && fields.skor_pelangganloyal.required ? ew.Validators.required(fields.skor_pelangganloyal.caption) : null, ew.Validators.float], fields.skor_pelangganloyal.isInvalid],
        ["max_pelangganloyal", [fields.max_pelangganloyal.visible && fields.max_pelangganloyal.required ? ew.Validators.required(fields.max_pelangganloyal.caption) : null, ew.Validators.float], fields.max_pelangganloyal.isInvalid],
        ["skor_pameranmandiri", [fields.skor_pameranmandiri.visible && fields.skor_pameranmandiri.required ? ew.Validators.required(fields.skor_pameranmandiri.caption) : null, ew.Validators.float], fields.skor_pameranmandiri.isInvalid],
        ["max_pameranmandiri", [fields.max_pameranmandiri.visible && fields.max_pameranmandiri.required ? ew.Validators.required(fields.max_pameranmandiri.caption) : null, ew.Validators.float], fields.max_pameranmandiri.isInvalid],
        ["skor_mediaoffline", [fields.skor_mediaoffline.visible && fields.skor_mediaoffline.required ? ew.Validators.required(fields.skor_mediaoffline.caption) : null, ew.Validators.float], fields.skor_mediaoffline.isInvalid],
        ["max_mediaoffline", [fields.max_mediaoffline.visible && fields.max_mediaoffline.required ? ew.Validators.required(fields.max_mediaoffline.caption) : null, ew.Validators.float], fields.max_mediaoffline.isInvalid],
        ["skor_pemasaran", [fields.skor_pemasaran.visible && fields.skor_pemasaran.required ? ew.Validators.required(fields.skor_pemasaran.caption) : null, ew.Validators.float], fields.skor_pemasaran.isInvalid],
        ["maxskor_pemasaran", [fields.maxskor_pemasaran.visible && fields.maxskor_pemasaran.required ? ew.Validators.required(fields.maxskor_pemasaran.caption) : null, ew.Validators.float], fields.maxskor_pemasaran.isInvalid],
        ["bobot_pemasaran", [fields.bobot_pemasaran.visible && fields.bobot_pemasaran.required ? ew.Validators.required(fields.bobot_pemasaran.caption) : null, ew.Validators.integer], fields.bobot_pemasaran.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_pemasaranedit,
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
    ftemp_skor_pemasaranedit.validate = function () {
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
    ftemp_skor_pemasaranedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_pemasaranedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_pemasaranedit");
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
<form name="ftemp_skor_pemasaranedit" id="ftemp_skor_pemasaranedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_pemasaran">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_pemasaran_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
<input type="hidden" data-table="temp_skor_pemasaran" data-field="x_nik" data-hidden="1" name="o_nik" id="o_nik" value="<?= HtmlEncode($Page->nik->OldValue ?? $Page->nik->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_unggul->Visible) { // skor_unggul ?>
    <div id="r_skor_unggul" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_unggul" for="x_skor_unggul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_unggul->caption() ?><?= $Page->skor_unggul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_unggul->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_unggul">
<input type="<?= $Page->skor_unggul->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_unggul" name="x_skor_unggul" id="x_skor_unggul" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_unggul->getPlaceHolder()) ?>" value="<?= $Page->skor_unggul->EditValue ?>"<?= $Page->skor_unggul->editAttributes() ?> aria-describedby="x_skor_unggul_help">
<?= $Page->skor_unggul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_unggul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_unggul->Visible) { // max_unggul ?>
    <div id="r_max_unggul" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_unggul" for="x_max_unggul" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_unggul->caption() ?><?= $Page->max_unggul->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_unggul->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_unggul">
<input type="<?= $Page->max_unggul->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_unggul" name="x_max_unggul" id="x_max_unggul" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_unggul->getPlaceHolder()) ?>" value="<?= $Page->max_unggul->EditValue ?>"<?= $Page->max_unggul->editAttributes() ?> aria-describedby="x_max_unggul_help">
<?= $Page->max_unggul->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_unggul->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_target->Visible) { // skor_target ?>
    <div id="r_skor_target" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_target" for="x_skor_target" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_target->caption() ?><?= $Page->skor_target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_target->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_target">
<input type="<?= $Page->skor_target->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_target" name="x_skor_target" id="x_skor_target" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_target->getPlaceHolder()) ?>" value="<?= $Page->skor_target->EditValue ?>"<?= $Page->skor_target->editAttributes() ?> aria-describedby="x_skor_target_help">
<?= $Page->skor_target->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_target->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_target->Visible) { // max_target ?>
    <div id="r_max_target" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_target" for="x_max_target" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_target->caption() ?><?= $Page->max_target->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_target->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_target">
<input type="<?= $Page->max_target->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_target" name="x_max_target" id="x_max_target" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_target->getPlaceHolder()) ?>" value="<?= $Page->max_target->EditValue ?>"<?= $Page->max_target->editAttributes() ?> aria-describedby="x_max_target_help">
<?= $Page->max_target->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_target->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_available->Visible) { // skor_available ?>
    <div id="r_skor_available" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_available" for="x_skor_available" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_available->caption() ?><?= $Page->skor_available->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_available->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_available">
<input type="<?= $Page->skor_available->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_available" name="x_skor_available" id="x_skor_available" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_available->getPlaceHolder()) ?>" value="<?= $Page->skor_available->EditValue ?>"<?= $Page->skor_available->editAttributes() ?> aria-describedby="x_skor_available_help">
<?= $Page->skor_available->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_available->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_available->Visible) { // max_available ?>
    <div id="r_max_available" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_available" for="x_max_available" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_available->caption() ?><?= $Page->max_available->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_available->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_available">
<input type="<?= $Page->max_available->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_available" name="x_max_available" id="x_max_available" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_available->getPlaceHolder()) ?>" value="<?= $Page->max_available->EditValue ?>"<?= $Page->max_available->editAttributes() ?> aria-describedby="x_max_available_help">
<?= $Page->max_available->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_available->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_merk->Visible) { // skor_merk ?>
    <div id="r_skor_merk" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_merk" for="x_skor_merk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_merk->caption() ?><?= $Page->skor_merk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_merk->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merk">
<input type="<?= $Page->skor_merk->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_merk" name="x_skor_merk" id="x_skor_merk" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_merk->getPlaceHolder()) ?>" value="<?= $Page->skor_merk->EditValue ?>"<?= $Page->skor_merk->editAttributes() ?> aria-describedby="x_skor_merk_help">
<?= $Page->skor_merk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_merk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_merk->Visible) { // max_merk ?>
    <div id="r_max_merk" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_merk" for="x_max_merk" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_merk->caption() ?><?= $Page->max_merk->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_merk->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merk">
<input type="<?= $Page->max_merk->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_merk" name="x_max_merk" id="x_max_merk" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_merk->getPlaceHolder()) ?>" value="<?= $Page->max_merk->EditValue ?>"<?= $Page->max_merk->editAttributes() ?> aria-describedby="x_max_merk_help">
<?= $Page->max_merk->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_merk->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_merkhaki->Visible) { // skor_merkhaki ?>
    <div id="r_skor_merkhaki" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_merkhaki" for="x_skor_merkhaki" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_merkhaki->caption() ?><?= $Page->skor_merkhaki->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_merkhaki->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merkhaki">
<input type="<?= $Page->skor_merkhaki->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_merkhaki" name="x_skor_merkhaki" id="x_skor_merkhaki" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_merkhaki->getPlaceHolder()) ?>" value="<?= $Page->skor_merkhaki->EditValue ?>"<?= $Page->skor_merkhaki->editAttributes() ?> aria-describedby="x_skor_merkhaki_help">
<?= $Page->skor_merkhaki->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_merkhaki->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_merkhaki->Visible) { // max_merkhaki ?>
    <div id="r_max_merkhaki" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_merkhaki" for="x_max_merkhaki" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_merkhaki->caption() ?><?= $Page->max_merkhaki->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_merkhaki->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merkhaki">
<input type="<?= $Page->max_merkhaki->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_merkhaki" name="x_max_merkhaki" id="x_max_merkhaki" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_merkhaki->getPlaceHolder()) ?>" value="<?= $Page->max_merkhaki->EditValue ?>"<?= $Page->max_merkhaki->editAttributes() ?> aria-describedby="x_max_merkhaki_help">
<?= $Page->max_merkhaki->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_merkhaki->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_merkkonsep->Visible) { // skor_merkkonsep ?>
    <div id="r_skor_merkkonsep" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_merkkonsep" for="x_skor_merkkonsep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_merkkonsep->caption() ?><?= $Page->skor_merkkonsep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_merkkonsep->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merkkonsep">
<input type="<?= $Page->skor_merkkonsep->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_merkkonsep" name="x_skor_merkkonsep" id="x_skor_merkkonsep" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_merkkonsep->getPlaceHolder()) ?>" value="<?= $Page->skor_merkkonsep->EditValue ?>"<?= $Page->skor_merkkonsep->editAttributes() ?> aria-describedby="x_skor_merkkonsep_help">
<?= $Page->skor_merkkonsep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_merkkonsep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_merkkonsep->Visible) { // max_merkkonsep ?>
    <div id="r_max_merkkonsep" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_merkkonsep" for="x_max_merkkonsep" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_merkkonsep->caption() ?><?= $Page->max_merkkonsep->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_merkkonsep->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merkkonsep">
<input type="<?= $Page->max_merkkonsep->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_merkkonsep" name="x_max_merkkonsep" id="x_max_merkkonsep" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_merkkonsep->getPlaceHolder()) ?>" value="<?= $Page->max_merkkonsep->EditValue ?>"<?= $Page->max_merkkonsep->editAttributes() ?> aria-describedby="x_max_merkkonsep_help">
<?= $Page->max_merkkonsep->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_merkkonsep->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_merklisensi->Visible) { // skor_merklisensi ?>
    <div id="r_skor_merklisensi" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_merklisensi" for="x_skor_merklisensi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_merklisensi->caption() ?><?= $Page->skor_merklisensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_merklisensi->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_merklisensi">
<input type="<?= $Page->skor_merklisensi->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_merklisensi" name="x_skor_merklisensi" id="x_skor_merklisensi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_merklisensi->getPlaceHolder()) ?>" value="<?= $Page->skor_merklisensi->EditValue ?>"<?= $Page->skor_merklisensi->editAttributes() ?> aria-describedby="x_skor_merklisensi_help">
<?= $Page->skor_merklisensi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_merklisensi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_merklisensi->Visible) { // max_merklisensi ?>
    <div id="r_max_merklisensi" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_merklisensi" for="x_max_merklisensi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_merklisensi->caption() ?><?= $Page->max_merklisensi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_merklisensi->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_merklisensi">
<input type="<?= $Page->max_merklisensi->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_merklisensi" name="x_max_merklisensi" id="x_max_merklisensi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_merklisensi->getPlaceHolder()) ?>" value="<?= $Page->max_merklisensi->EditValue ?>"<?= $Page->max_merklisensi->editAttributes() ?> aria-describedby="x_max_merklisensi_help">
<?= $Page->max_merklisensi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_merklisensi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_mitra->Visible) { // skor_mitra ?>
    <div id="r_skor_mitra" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_mitra" for="x_skor_mitra" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_mitra->caption() ?><?= $Page->skor_mitra->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_mitra->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_mitra">
<input type="<?= $Page->skor_mitra->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_mitra" name="x_skor_mitra" id="x_skor_mitra" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_mitra->getPlaceHolder()) ?>" value="<?= $Page->skor_mitra->EditValue ?>"<?= $Page->skor_mitra->editAttributes() ?> aria-describedby="x_skor_mitra_help">
<?= $Page->skor_mitra->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_mitra->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_mitra->Visible) { // max_mitra ?>
    <div id="r_max_mitra" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_mitra" for="x_max_mitra" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_mitra->caption() ?><?= $Page->max_mitra->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_mitra->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_mitra">
<input type="<?= $Page->max_mitra->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_mitra" name="x_max_mitra" id="x_max_mitra" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_mitra->getPlaceHolder()) ?>" value="<?= $Page->max_mitra->EditValue ?>"<?= $Page->max_mitra->editAttributes() ?> aria-describedby="x_max_mitra_help">
<?= $Page->max_mitra->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_mitra->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_market->Visible) { // skor_market ?>
    <div id="r_skor_market" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_market" for="x_skor_market" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_market->caption() ?><?= $Page->skor_market->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_market->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_market">
<input type="<?= $Page->skor_market->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_market" name="x_skor_market" id="x_skor_market" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_market->getPlaceHolder()) ?>" value="<?= $Page->skor_market->EditValue ?>"<?= $Page->skor_market->editAttributes() ?> aria-describedby="x_skor_market_help">
<?= $Page->skor_market->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_market->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_market->Visible) { // max_market ?>
    <div id="r_max_market" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_market" for="x_max_market" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_market->caption() ?><?= $Page->max_market->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_market->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_market">
<input type="<?= $Page->max_market->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_market" name="x_max_market" id="x_max_market" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_market->getPlaceHolder()) ?>" value="<?= $Page->max_market->EditValue ?>"<?= $Page->max_market->editAttributes() ?> aria-describedby="x_max_market_help">
<?= $Page->max_market->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_market->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pelangganloyal->Visible) { // skor_pelangganloyal ?>
    <div id="r_skor_pelangganloyal" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_pelangganloyal" for="x_skor_pelangganloyal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pelangganloyal->caption() ?><?= $Page->skor_pelangganloyal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pelangganloyal->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pelangganloyal">
<input type="<?= $Page->skor_pelangganloyal->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_pelangganloyal" name="x_skor_pelangganloyal" id="x_skor_pelangganloyal" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pelangganloyal->getPlaceHolder()) ?>" value="<?= $Page->skor_pelangganloyal->EditValue ?>"<?= $Page->skor_pelangganloyal->editAttributes() ?> aria-describedby="x_skor_pelangganloyal_help">
<?= $Page->skor_pelangganloyal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pelangganloyal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_pelangganloyal->Visible) { // max_pelangganloyal ?>
    <div id="r_max_pelangganloyal" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_pelangganloyal" for="x_max_pelangganloyal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_pelangganloyal->caption() ?><?= $Page->max_pelangganloyal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_pelangganloyal->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_pelangganloyal">
<input type="<?= $Page->max_pelangganloyal->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_pelangganloyal" name="x_max_pelangganloyal" id="x_max_pelangganloyal" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_pelangganloyal->getPlaceHolder()) ?>" value="<?= $Page->max_pelangganloyal->EditValue ?>"<?= $Page->max_pelangganloyal->editAttributes() ?> aria-describedby="x_max_pelangganloyal_help">
<?= $Page->max_pelangganloyal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_pelangganloyal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pameranmandiri->Visible) { // skor_pameranmandiri ?>
    <div id="r_skor_pameranmandiri" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_pameranmandiri" for="x_skor_pameranmandiri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pameranmandiri->caption() ?><?= $Page->skor_pameranmandiri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pameranmandiri->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pameranmandiri">
<input type="<?= $Page->skor_pameranmandiri->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_pameranmandiri" name="x_skor_pameranmandiri" id="x_skor_pameranmandiri" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pameranmandiri->getPlaceHolder()) ?>" value="<?= $Page->skor_pameranmandiri->EditValue ?>"<?= $Page->skor_pameranmandiri->editAttributes() ?> aria-describedby="x_skor_pameranmandiri_help">
<?= $Page->skor_pameranmandiri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pameranmandiri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_pameranmandiri->Visible) { // max_pameranmandiri ?>
    <div id="r_max_pameranmandiri" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_pameranmandiri" for="x_max_pameranmandiri" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_pameranmandiri->caption() ?><?= $Page->max_pameranmandiri->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_pameranmandiri->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_pameranmandiri">
<input type="<?= $Page->max_pameranmandiri->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_pameranmandiri" name="x_max_pameranmandiri" id="x_max_pameranmandiri" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_pameranmandiri->getPlaceHolder()) ?>" value="<?= $Page->max_pameranmandiri->EditValue ?>"<?= $Page->max_pameranmandiri->editAttributes() ?> aria-describedby="x_max_pameranmandiri_help">
<?= $Page->max_pameranmandiri->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_pameranmandiri->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_mediaoffline->Visible) { // skor_mediaoffline ?>
    <div id="r_skor_mediaoffline" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_mediaoffline" for="x_skor_mediaoffline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_mediaoffline->caption() ?><?= $Page->skor_mediaoffline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_mediaoffline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_mediaoffline">
<input type="<?= $Page->skor_mediaoffline->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_mediaoffline" name="x_skor_mediaoffline" id="x_skor_mediaoffline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_mediaoffline->getPlaceHolder()) ?>" value="<?= $Page->skor_mediaoffline->EditValue ?>"<?= $Page->skor_mediaoffline->editAttributes() ?> aria-describedby="x_skor_mediaoffline_help">
<?= $Page->skor_mediaoffline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_mediaoffline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_mediaoffline->Visible) { // max_mediaoffline ?>
    <div id="r_max_mediaoffline" class="form-group row">
        <label id="elh_temp_skor_pemasaran_max_mediaoffline" for="x_max_mediaoffline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_mediaoffline->caption() ?><?= $Page->max_mediaoffline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_mediaoffline->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_max_mediaoffline">
<input type="<?= $Page->max_mediaoffline->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_max_mediaoffline" name="x_max_mediaoffline" id="x_max_mediaoffline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_mediaoffline->getPlaceHolder()) ?>" value="<?= $Page->max_mediaoffline->EditValue ?>"<?= $Page->max_mediaoffline->editAttributes() ?> aria-describedby="x_max_mediaoffline_help">
<?= $Page->max_mediaoffline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_mediaoffline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
    <div id="r_skor_pemasaran" class="form-group row">
        <label id="elh_temp_skor_pemasaran_skor_pemasaran" for="x_skor_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pemasaran->caption() ?><?= $Page->skor_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_skor_pemasaran">
<input type="<?= $Page->skor_pemasaran->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_skor_pemasaran" name="x_skor_pemasaran" id="x_skor_pemasaran" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->skor_pemasaran->EditValue ?>"<?= $Page->skor_pemasaran->editAttributes() ?> aria-describedby="x_skor_pemasaran_help">
<?= $Page->skor_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pemasaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
    <div id="r_maxskor_pemasaran" class="form-group row">
        <label id="elh_temp_skor_pemasaran_maxskor_pemasaran" for="x_maxskor_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_pemasaran->caption() ?><?= $Page->maxskor_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_maxskor_pemasaran">
<input type="<?= $Page->maxskor_pemasaran->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_maxskor_pemasaran" name="x_maxskor_pemasaran" id="x_maxskor_pemasaran" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->maxskor_pemasaran->EditValue ?>"<?= $Page->maxskor_pemasaran->editAttributes() ?> aria-describedby="x_maxskor_pemasaran_help">
<?= $Page->maxskor_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_pemasaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
    <div id="r_bobot_pemasaran" class="form-group row">
        <label id="elh_temp_skor_pemasaran_bobot_pemasaran" for="x_bobot_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_pemasaran->caption() ?><?= $Page->bobot_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_pemasaran_bobot_pemasaran">
<input type="<?= $Page->bobot_pemasaran->getInputTextType() ?>" data-table="temp_skor_pemasaran" data-field="x_bobot_pemasaran" name="x_bobot_pemasaran" id="x_bobot_pemasaran" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->bobot_pemasaran->EditValue ?>"<?= $Page->bobot_pemasaran->editAttributes() ?> aria-describedby="x_bobot_pemasaran_help">
<?= $Page->bobot_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_pemasaran->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_pemasaran");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
