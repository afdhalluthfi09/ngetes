<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorProduksiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_produksiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftemp_skor_produksiedit = currentForm = new ew.Form("ftemp_skor_produksiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_produksi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_produksi)
        ew.vars.tables.temp_skor_produksi = currentTable;
    ftemp_skor_produksiedit.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["skor_aktifitas", [fields.skor_aktifitas.visible && fields.skor_aktifitas.required ? ew.Validators.required(fields.skor_aktifitas.caption) : null, ew.Validators.float], fields.skor_aktifitas.isInvalid],
        ["max_aktifitas", [fields.max_aktifitas.visible && fields.max_aktifitas.required ? ew.Validators.required(fields.max_aktifitas.caption) : null, ew.Validators.float], fields.max_aktifitas.isInvalid],
        ["skor_kapasitas", [fields.skor_kapasitas.visible && fields.skor_kapasitas.required ? ew.Validators.required(fields.skor_kapasitas.caption) : null, ew.Validators.float], fields.skor_kapasitas.isInvalid],
        ["max_kapasitas", [fields.max_kapasitas.visible && fields.max_kapasitas.required ? ew.Validators.required(fields.max_kapasitas.caption) : null, ew.Validators.float], fields.max_kapasitas.isInvalid],
        ["skor_pangan", [fields.skor_pangan.visible && fields.skor_pangan.required ? ew.Validators.required(fields.skor_pangan.caption) : null, ew.Validators.float], fields.skor_pangan.isInvalid],
        ["max_pangan", [fields.max_pangan.visible && fields.max_pangan.required ? ew.Validators.required(fields.max_pangan.caption) : null, ew.Validators.float], fields.max_pangan.isInvalid],
        ["skor_sni", [fields.skor_sni.visible && fields.skor_sni.required ? ew.Validators.required(fields.skor_sni.caption) : null, ew.Validators.float], fields.skor_sni.isInvalid],
        ["max_sni", [fields.max_sni.visible && fields.max_sni.required ? ew.Validators.required(fields.max_sni.caption) : null, ew.Validators.float], fields.max_sni.isInvalid],
        ["skor_kemasan", [fields.skor_kemasan.visible && fields.skor_kemasan.required ? ew.Validators.required(fields.skor_kemasan.caption) : null, ew.Validators.float], fields.skor_kemasan.isInvalid],
        ["max_kemasan", [fields.max_kemasan.visible && fields.max_kemasan.required ? ew.Validators.required(fields.max_kemasan.caption) : null, ew.Validators.float], fields.max_kemasan.isInvalid],
        ["skor_bahanbaku", [fields.skor_bahanbaku.visible && fields.skor_bahanbaku.required ? ew.Validators.required(fields.skor_bahanbaku.caption) : null, ew.Validators.float], fields.skor_bahanbaku.isInvalid],
        ["max_bahanbaku", [fields.max_bahanbaku.visible && fields.max_bahanbaku.required ? ew.Validators.required(fields.max_bahanbaku.caption) : null, ew.Validators.float], fields.max_bahanbaku.isInvalid],
        ["skor_alat", [fields.skor_alat.visible && fields.skor_alat.required ? ew.Validators.required(fields.skor_alat.caption) : null, ew.Validators.float], fields.skor_alat.isInvalid],
        ["max_alat", [fields.max_alat.visible && fields.max_alat.required ? ew.Validators.required(fields.max_alat.caption) : null, ew.Validators.float], fields.max_alat.isInvalid],
        ["skor_gudang", [fields.skor_gudang.visible && fields.skor_gudang.required ? ew.Validators.required(fields.skor_gudang.caption) : null, ew.Validators.float], fields.skor_gudang.isInvalid],
        ["max_gudang", [fields.max_gudang.visible && fields.max_gudang.required ? ew.Validators.required(fields.max_gudang.caption) : null, ew.Validators.float], fields.max_gudang.isInvalid],
        ["skor_layout", [fields.skor_layout.visible && fields.skor_layout.required ? ew.Validators.required(fields.skor_layout.caption) : null, ew.Validators.float], fields.skor_layout.isInvalid],
        ["max_layout", [fields.max_layout.visible && fields.max_layout.required ? ew.Validators.required(fields.max_layout.caption) : null, ew.Validators.float], fields.max_layout.isInvalid],
        ["skor_sop", [fields.skor_sop.visible && fields.skor_sop.required ? ew.Validators.required(fields.skor_sop.caption) : null, ew.Validators.float], fields.skor_sop.isInvalid],
        ["max_sop", [fields.max_sop.visible && fields.max_sop.required ? ew.Validators.required(fields.max_sop.caption) : null, ew.Validators.float], fields.max_sop.isInvalid],
        ["skor_produksi", [fields.skor_produksi.visible && fields.skor_produksi.required ? ew.Validators.required(fields.skor_produksi.caption) : null, ew.Validators.float], fields.skor_produksi.isInvalid],
        ["maxskor_produksi", [fields.maxskor_produksi.visible && fields.maxskor_produksi.required ? ew.Validators.required(fields.maxskor_produksi.caption) : null, ew.Validators.float], fields.maxskor_produksi.isInvalid],
        ["bobot_produksi", [fields.bobot_produksi.visible && fields.bobot_produksi.required ? ew.Validators.required(fields.bobot_produksi.caption) : null, ew.Validators.integer], fields.bobot_produksi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_produksiedit,
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
    ftemp_skor_produksiedit.validate = function () {
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
    ftemp_skor_produksiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_produksiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_produksiedit");
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
<form name="ftemp_skor_produksiedit" id="ftemp_skor_produksiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_produksi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_produksi_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
<input type="hidden" data-table="temp_skor_produksi" data-field="x_nik" data-hidden="1" name="o_nik" id="o_nik" value="<?= HtmlEncode($Page->nik->OldValue ?? $Page->nik->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_aktifitas->Visible) { // skor_aktifitas ?>
    <div id="r_skor_aktifitas" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_aktifitas" for="x_skor_aktifitas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_aktifitas->caption() ?><?= $Page->skor_aktifitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_aktifitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_aktifitas">
<input type="<?= $Page->skor_aktifitas->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_aktifitas" name="x_skor_aktifitas" id="x_skor_aktifitas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_aktifitas->getPlaceHolder()) ?>" value="<?= $Page->skor_aktifitas->EditValue ?>"<?= $Page->skor_aktifitas->editAttributes() ?> aria-describedby="x_skor_aktifitas_help">
<?= $Page->skor_aktifitas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_aktifitas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_aktifitas->Visible) { // max_aktifitas ?>
    <div id="r_max_aktifitas" class="form-group row">
        <label id="elh_temp_skor_produksi_max_aktifitas" for="x_max_aktifitas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_aktifitas->caption() ?><?= $Page->max_aktifitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_aktifitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_aktifitas">
<input type="<?= $Page->max_aktifitas->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_aktifitas" name="x_max_aktifitas" id="x_max_aktifitas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_aktifitas->getPlaceHolder()) ?>" value="<?= $Page->max_aktifitas->EditValue ?>"<?= $Page->max_aktifitas->editAttributes() ?> aria-describedby="x_max_aktifitas_help">
<?= $Page->max_aktifitas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_aktifitas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_kapasitas->Visible) { // skor_kapasitas ?>
    <div id="r_skor_kapasitas" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_kapasitas" for="x_skor_kapasitas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_kapasitas->caption() ?><?= $Page->skor_kapasitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_kapasitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_kapasitas">
<input type="<?= $Page->skor_kapasitas->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_kapasitas" name="x_skor_kapasitas" id="x_skor_kapasitas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_kapasitas->getPlaceHolder()) ?>" value="<?= $Page->skor_kapasitas->EditValue ?>"<?= $Page->skor_kapasitas->editAttributes() ?> aria-describedby="x_skor_kapasitas_help">
<?= $Page->skor_kapasitas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_kapasitas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_kapasitas->Visible) { // max_kapasitas ?>
    <div id="r_max_kapasitas" class="form-group row">
        <label id="elh_temp_skor_produksi_max_kapasitas" for="x_max_kapasitas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_kapasitas->caption() ?><?= $Page->max_kapasitas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_kapasitas->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_kapasitas">
<input type="<?= $Page->max_kapasitas->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_kapasitas" name="x_max_kapasitas" id="x_max_kapasitas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_kapasitas->getPlaceHolder()) ?>" value="<?= $Page->max_kapasitas->EditValue ?>"<?= $Page->max_kapasitas->editAttributes() ?> aria-describedby="x_max_kapasitas_help">
<?= $Page->max_kapasitas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_kapasitas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pangan->Visible) { // skor_pangan ?>
    <div id="r_skor_pangan" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_pangan" for="x_skor_pangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pangan->caption() ?><?= $Page->skor_pangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pangan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_pangan">
<input type="<?= $Page->skor_pangan->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_pangan" name="x_skor_pangan" id="x_skor_pangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pangan->getPlaceHolder()) ?>" value="<?= $Page->skor_pangan->EditValue ?>"<?= $Page->skor_pangan->editAttributes() ?> aria-describedby="x_skor_pangan_help">
<?= $Page->skor_pangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_pangan->Visible) { // max_pangan ?>
    <div id="r_max_pangan" class="form-group row">
        <label id="elh_temp_skor_produksi_max_pangan" for="x_max_pangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_pangan->caption() ?><?= $Page->max_pangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_pangan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_pangan">
<input type="<?= $Page->max_pangan->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_pangan" name="x_max_pangan" id="x_max_pangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_pangan->getPlaceHolder()) ?>" value="<?= $Page->max_pangan->EditValue ?>"<?= $Page->max_pangan->editAttributes() ?> aria-describedby="x_max_pangan_help">
<?= $Page->max_pangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_pangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_sni->Visible) { // skor_sni ?>
    <div id="r_skor_sni" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_sni" for="x_skor_sni" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_sni->caption() ?><?= $Page->skor_sni->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_sni->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_sni">
<input type="<?= $Page->skor_sni->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_sni" name="x_skor_sni" id="x_skor_sni" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_sni->getPlaceHolder()) ?>" value="<?= $Page->skor_sni->EditValue ?>"<?= $Page->skor_sni->editAttributes() ?> aria-describedby="x_skor_sni_help">
<?= $Page->skor_sni->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_sni->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_sni->Visible) { // max_sni ?>
    <div id="r_max_sni" class="form-group row">
        <label id="elh_temp_skor_produksi_max_sni" for="x_max_sni" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_sni->caption() ?><?= $Page->max_sni->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_sni->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_sni">
<input type="<?= $Page->max_sni->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_sni" name="x_max_sni" id="x_max_sni" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_sni->getPlaceHolder()) ?>" value="<?= $Page->max_sni->EditValue ?>"<?= $Page->max_sni->editAttributes() ?> aria-describedby="x_max_sni_help">
<?= $Page->max_sni->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_sni->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_kemasan->Visible) { // skor_kemasan ?>
    <div id="r_skor_kemasan" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_kemasan" for="x_skor_kemasan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_kemasan->caption() ?><?= $Page->skor_kemasan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_kemasan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_kemasan">
<input type="<?= $Page->skor_kemasan->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_kemasan" name="x_skor_kemasan" id="x_skor_kemasan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_kemasan->getPlaceHolder()) ?>" value="<?= $Page->skor_kemasan->EditValue ?>"<?= $Page->skor_kemasan->editAttributes() ?> aria-describedby="x_skor_kemasan_help">
<?= $Page->skor_kemasan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_kemasan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_kemasan->Visible) { // max_kemasan ?>
    <div id="r_max_kemasan" class="form-group row">
        <label id="elh_temp_skor_produksi_max_kemasan" for="x_max_kemasan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_kemasan->caption() ?><?= $Page->max_kemasan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_kemasan->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_kemasan">
<input type="<?= $Page->max_kemasan->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_kemasan" name="x_max_kemasan" id="x_max_kemasan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_kemasan->getPlaceHolder()) ?>" value="<?= $Page->max_kemasan->EditValue ?>"<?= $Page->max_kemasan->editAttributes() ?> aria-describedby="x_max_kemasan_help">
<?= $Page->max_kemasan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_kemasan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_bahanbaku->Visible) { // skor_bahanbaku ?>
    <div id="r_skor_bahanbaku" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_bahanbaku" for="x_skor_bahanbaku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_bahanbaku->caption() ?><?= $Page->skor_bahanbaku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_bahanbaku->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_bahanbaku">
<input type="<?= $Page->skor_bahanbaku->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_bahanbaku" name="x_skor_bahanbaku" id="x_skor_bahanbaku" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_bahanbaku->getPlaceHolder()) ?>" value="<?= $Page->skor_bahanbaku->EditValue ?>"<?= $Page->skor_bahanbaku->editAttributes() ?> aria-describedby="x_skor_bahanbaku_help">
<?= $Page->skor_bahanbaku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_bahanbaku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_bahanbaku->Visible) { // max_bahanbaku ?>
    <div id="r_max_bahanbaku" class="form-group row">
        <label id="elh_temp_skor_produksi_max_bahanbaku" for="x_max_bahanbaku" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_bahanbaku->caption() ?><?= $Page->max_bahanbaku->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_bahanbaku->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_bahanbaku">
<input type="<?= $Page->max_bahanbaku->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_bahanbaku" name="x_max_bahanbaku" id="x_max_bahanbaku" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_bahanbaku->getPlaceHolder()) ?>" value="<?= $Page->max_bahanbaku->EditValue ?>"<?= $Page->max_bahanbaku->editAttributes() ?> aria-describedby="x_max_bahanbaku_help">
<?= $Page->max_bahanbaku->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_bahanbaku->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_alat->Visible) { // skor_alat ?>
    <div id="r_skor_alat" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_alat" for="x_skor_alat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_alat->caption() ?><?= $Page->skor_alat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_alat->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_alat">
<input type="<?= $Page->skor_alat->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_alat" name="x_skor_alat" id="x_skor_alat" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_alat->getPlaceHolder()) ?>" value="<?= $Page->skor_alat->EditValue ?>"<?= $Page->skor_alat->editAttributes() ?> aria-describedby="x_skor_alat_help">
<?= $Page->skor_alat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_alat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_alat->Visible) { // max_alat ?>
    <div id="r_max_alat" class="form-group row">
        <label id="elh_temp_skor_produksi_max_alat" for="x_max_alat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_alat->caption() ?><?= $Page->max_alat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_alat->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_alat">
<input type="<?= $Page->max_alat->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_alat" name="x_max_alat" id="x_max_alat" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_alat->getPlaceHolder()) ?>" value="<?= $Page->max_alat->EditValue ?>"<?= $Page->max_alat->editAttributes() ?> aria-describedby="x_max_alat_help">
<?= $Page->max_alat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_alat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_gudang->Visible) { // skor_gudang ?>
    <div id="r_skor_gudang" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_gudang" for="x_skor_gudang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_gudang->caption() ?><?= $Page->skor_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_gudang->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_gudang">
<input type="<?= $Page->skor_gudang->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_gudang" name="x_skor_gudang" id="x_skor_gudang" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_gudang->getPlaceHolder()) ?>" value="<?= $Page->skor_gudang->EditValue ?>"<?= $Page->skor_gudang->editAttributes() ?> aria-describedby="x_skor_gudang_help">
<?= $Page->skor_gudang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_gudang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_gudang->Visible) { // max_gudang ?>
    <div id="r_max_gudang" class="form-group row">
        <label id="elh_temp_skor_produksi_max_gudang" for="x_max_gudang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_gudang->caption() ?><?= $Page->max_gudang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_gudang->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_gudang">
<input type="<?= $Page->max_gudang->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_gudang" name="x_max_gudang" id="x_max_gudang" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_gudang->getPlaceHolder()) ?>" value="<?= $Page->max_gudang->EditValue ?>"<?= $Page->max_gudang->editAttributes() ?> aria-describedby="x_max_gudang_help">
<?= $Page->max_gudang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_gudang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_layout->Visible) { // skor_layout ?>
    <div id="r_skor_layout" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_layout" for="x_skor_layout" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_layout->caption() ?><?= $Page->skor_layout->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_layout->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_layout">
<input type="<?= $Page->skor_layout->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_layout" name="x_skor_layout" id="x_skor_layout" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_layout->getPlaceHolder()) ?>" value="<?= $Page->skor_layout->EditValue ?>"<?= $Page->skor_layout->editAttributes() ?> aria-describedby="x_skor_layout_help">
<?= $Page->skor_layout->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_layout->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_layout->Visible) { // max_layout ?>
    <div id="r_max_layout" class="form-group row">
        <label id="elh_temp_skor_produksi_max_layout" for="x_max_layout" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_layout->caption() ?><?= $Page->max_layout->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_layout->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_layout">
<input type="<?= $Page->max_layout->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_layout" name="x_max_layout" id="x_max_layout" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_layout->getPlaceHolder()) ?>" value="<?= $Page->max_layout->EditValue ?>"<?= $Page->max_layout->editAttributes() ?> aria-describedby="x_max_layout_help">
<?= $Page->max_layout->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_layout->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_sop->Visible) { // skor_sop ?>
    <div id="r_skor_sop" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_sop" for="x_skor_sop" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_sop->caption() ?><?= $Page->skor_sop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_sop->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_sop">
<input type="<?= $Page->skor_sop->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_sop" name="x_skor_sop" id="x_skor_sop" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_sop->getPlaceHolder()) ?>" value="<?= $Page->skor_sop->EditValue ?>"<?= $Page->skor_sop->editAttributes() ?> aria-describedby="x_skor_sop_help">
<?= $Page->skor_sop->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_sop->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_sop->Visible) { // max_sop ?>
    <div id="r_max_sop" class="form-group row">
        <label id="elh_temp_skor_produksi_max_sop" for="x_max_sop" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_sop->caption() ?><?= $Page->max_sop->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_sop->cellAttributes() ?>>
<span id="el_temp_skor_produksi_max_sop">
<input type="<?= $Page->max_sop->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_max_sop" name="x_max_sop" id="x_max_sop" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_sop->getPlaceHolder()) ?>" value="<?= $Page->max_sop->EditValue ?>"<?= $Page->max_sop->editAttributes() ?> aria-describedby="x_max_sop_help">
<?= $Page->max_sop->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_sop->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
    <div id="r_skor_produksi" class="form-group row">
        <label id="elh_temp_skor_produksi_skor_produksi" for="x_skor_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_produksi->caption() ?><?= $Page->skor_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_skor_produksi">
<input type="<?= $Page->skor_produksi->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_skor_produksi" name="x_skor_produksi" id="x_skor_produksi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_produksi->getPlaceHolder()) ?>" value="<?= $Page->skor_produksi->EditValue ?>"<?= $Page->skor_produksi->editAttributes() ?> aria-describedby="x_skor_produksi_help">
<?= $Page->skor_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
    <div id="r_maxskor_produksi" class="form-group row">
        <label id="elh_temp_skor_produksi_maxskor_produksi" for="x_maxskor_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_produksi->caption() ?><?= $Page->maxskor_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_maxskor_produksi">
<input type="<?= $Page->maxskor_produksi->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_maxskor_produksi" name="x_maxskor_produksi" id="x_maxskor_produksi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_produksi->getPlaceHolder()) ?>" value="<?= $Page->maxskor_produksi->EditValue ?>"<?= $Page->maxskor_produksi->editAttributes() ?> aria-describedby="x_maxskor_produksi_help">
<?= $Page->maxskor_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
    <div id="r_bobot_produksi" class="form-group row">
        <label id="elh_temp_skor_produksi_bobot_produksi" for="x_bobot_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_produksi->caption() ?><?= $Page->bobot_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el_temp_skor_produksi_bobot_produksi">
<input type="<?= $Page->bobot_produksi->getInputTextType() ?>" data-table="temp_skor_produksi" data-field="x_bobot_produksi" name="x_bobot_produksi" id="x_bobot_produksi" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_produksi->getPlaceHolder()) ?>" value="<?= $Page->bobot_produksi->EditValue ?>"<?= $Page->bobot_produksi->editAttributes() ?> aria-describedby="x_bobot_produksi_help">
<?= $Page->bobot_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_produksi->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_produksi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
