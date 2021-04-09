<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKeuanganAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_keuanganadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftemp_skor_keuanganadd = currentForm = new ew.Form("ftemp_skor_keuanganadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_keuangan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_keuangan)
        ew.vars.tables.temp_skor_keuangan = currentTable;
    ftemp_skor_keuanganadd.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["skor_income", [fields.skor_income.visible && fields.skor_income.required ? ew.Validators.required(fields.skor_income.caption) : null, ew.Validators.float], fields.skor_income.isInvalid],
        ["max_income", [fields.max_income.visible && fields.max_income.required ? ew.Validators.required(fields.max_income.caption) : null, ew.Validators.float], fields.max_income.isInvalid],
        ["skor_pengelolaan", [fields.skor_pengelolaan.visible && fields.skor_pengelolaan.required ? ew.Validators.required(fields.skor_pengelolaan.caption) : null, ew.Validators.float], fields.skor_pengelolaan.isInvalid],
        ["max_pengelolaan", [fields.max_pengelolaan.visible && fields.max_pengelolaan.required ? ew.Validators.required(fields.max_pengelolaan.caption) : null, ew.Validators.float], fields.max_pengelolaan.isInvalid],
        ["skor_nota", [fields.skor_nota.visible && fields.skor_nota.required ? ew.Validators.required(fields.skor_nota.caption) : null, ew.Validators.float], fields.skor_nota.isInvalid],
        ["max_nota", [fields.max_nota.visible && fields.max_nota.required ? ew.Validators.required(fields.max_nota.caption) : null, ew.Validators.float], fields.max_nota.isInvalid],
        ["skor_jurnal", [fields.skor_jurnal.visible && fields.skor_jurnal.required ? ew.Validators.required(fields.skor_jurnal.caption) : null, ew.Validators.float], fields.skor_jurnal.isInvalid],
        ["max_jurnal", [fields.max_jurnal.visible && fields.max_jurnal.required ? ew.Validators.required(fields.max_jurnal.caption) : null, ew.Validators.float], fields.max_jurnal.isInvalid],
        ["skor_akutansi", [fields.skor_akutansi.visible && fields.skor_akutansi.required ? ew.Validators.required(fields.skor_akutansi.caption) : null, ew.Validators.float], fields.skor_akutansi.isInvalid],
        ["max_akutansi", [fields.max_akutansi.visible && fields.max_akutansi.required ? ew.Validators.required(fields.max_akutansi.caption) : null, ew.Validators.float], fields.max_akutansi.isInvalid],
        ["skor_utangbank", [fields.skor_utangbank.visible && fields.skor_utangbank.required ? ew.Validators.required(fields.skor_utangbank.caption) : null, ew.Validators.float], fields.skor_utangbank.isInvalid],
        ["max_utangbank", [fields.max_utangbank.visible && fields.max_utangbank.required ? ew.Validators.required(fields.max_utangbank.caption) : null, ew.Validators.float], fields.max_utangbank.isInvalid],
        ["skor_dokumentasi", [fields.skor_dokumentasi.visible && fields.skor_dokumentasi.required ? ew.Validators.required(fields.skor_dokumentasi.caption) : null, ew.Validators.float], fields.skor_dokumentasi.isInvalid],
        ["max_dokumentasi", [fields.max_dokumentasi.visible && fields.max_dokumentasi.required ? ew.Validators.required(fields.max_dokumentasi.caption) : null, ew.Validators.float], fields.max_dokumentasi.isInvalid],
        ["skor_nontunai", [fields.skor_nontunai.visible && fields.skor_nontunai.required ? ew.Validators.required(fields.skor_nontunai.caption) : null, ew.Validators.float], fields.skor_nontunai.isInvalid],
        ["max_nontunai", [fields.max_nontunai.visible && fields.max_nontunai.required ? ew.Validators.required(fields.max_nontunai.caption) : null, ew.Validators.float], fields.max_nontunai.isInvalid],
        ["skor_keuangan", [fields.skor_keuangan.visible && fields.skor_keuangan.required ? ew.Validators.required(fields.skor_keuangan.caption) : null, ew.Validators.float], fields.skor_keuangan.isInvalid],
        ["maxskor_keuangan", [fields.maxskor_keuangan.visible && fields.maxskor_keuangan.required ? ew.Validators.required(fields.maxskor_keuangan.caption) : null, ew.Validators.float], fields.maxskor_keuangan.isInvalid],
        ["bobot_keuangan", [fields.bobot_keuangan.visible && fields.bobot_keuangan.required ? ew.Validators.required(fields.bobot_keuangan.caption) : null, ew.Validators.integer], fields.bobot_keuangan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_keuanganadd,
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
    ftemp_skor_keuanganadd.validate = function () {
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
    ftemp_skor_keuanganadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_keuanganadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_keuanganadd");
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
<form name="ftemp_skor_keuanganadd" id="ftemp_skor_keuanganadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_keuangan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_skor_keuangan_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_income->Visible) { // skor_income ?>
    <div id="r_skor_income" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_income" for="x_skor_income" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_income->caption() ?><?= $Page->skor_income->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_income->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_income">
<input type="<?= $Page->skor_income->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_income" name="x_skor_income" id="x_skor_income" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_income->getPlaceHolder()) ?>" value="<?= $Page->skor_income->EditValue ?>"<?= $Page->skor_income->editAttributes() ?> aria-describedby="x_skor_income_help">
<?= $Page->skor_income->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_income->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_income->Visible) { // max_income ?>
    <div id="r_max_income" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_income" for="x_max_income" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_income->caption() ?><?= $Page->max_income->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_income->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_income">
<input type="<?= $Page->max_income->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_income" name="x_max_income" id="x_max_income" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_income->getPlaceHolder()) ?>" value="<?= $Page->max_income->EditValue ?>"<?= $Page->max_income->editAttributes() ?> aria-describedby="x_max_income_help">
<?= $Page->max_income->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_income->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pengelolaan->Visible) { // skor_pengelolaan ?>
    <div id="r_skor_pengelolaan" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_pengelolaan" for="x_skor_pengelolaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pengelolaan->caption() ?><?= $Page->skor_pengelolaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pengelolaan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_pengelolaan">
<input type="<?= $Page->skor_pengelolaan->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_pengelolaan" name="x_skor_pengelolaan" id="x_skor_pengelolaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pengelolaan->getPlaceHolder()) ?>" value="<?= $Page->skor_pengelolaan->EditValue ?>"<?= $Page->skor_pengelolaan->editAttributes() ?> aria-describedby="x_skor_pengelolaan_help">
<?= $Page->skor_pengelolaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pengelolaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_pengelolaan->Visible) { // max_pengelolaan ?>
    <div id="r_max_pengelolaan" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_pengelolaan" for="x_max_pengelolaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_pengelolaan->caption() ?><?= $Page->max_pengelolaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_pengelolaan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_pengelolaan">
<input type="<?= $Page->max_pengelolaan->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_pengelolaan" name="x_max_pengelolaan" id="x_max_pengelolaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_pengelolaan->getPlaceHolder()) ?>" value="<?= $Page->max_pengelolaan->EditValue ?>"<?= $Page->max_pengelolaan->editAttributes() ?> aria-describedby="x_max_pengelolaan_help">
<?= $Page->max_pengelolaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_pengelolaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_nota->Visible) { // skor_nota ?>
    <div id="r_skor_nota" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_nota" for="x_skor_nota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_nota->caption() ?><?= $Page->skor_nota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_nota->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_nota">
<input type="<?= $Page->skor_nota->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_nota" name="x_skor_nota" id="x_skor_nota" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_nota->getPlaceHolder()) ?>" value="<?= $Page->skor_nota->EditValue ?>"<?= $Page->skor_nota->editAttributes() ?> aria-describedby="x_skor_nota_help">
<?= $Page->skor_nota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_nota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_nota->Visible) { // max_nota ?>
    <div id="r_max_nota" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_nota" for="x_max_nota" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_nota->caption() ?><?= $Page->max_nota->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_nota->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_nota">
<input type="<?= $Page->max_nota->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_nota" name="x_max_nota" id="x_max_nota" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_nota->getPlaceHolder()) ?>" value="<?= $Page->max_nota->EditValue ?>"<?= $Page->max_nota->editAttributes() ?> aria-describedby="x_max_nota_help">
<?= $Page->max_nota->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_nota->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_jurnal->Visible) { // skor_jurnal ?>
    <div id="r_skor_jurnal" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_jurnal" for="x_skor_jurnal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_jurnal->caption() ?><?= $Page->skor_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_jurnal->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_jurnal">
<input type="<?= $Page->skor_jurnal->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_jurnal" name="x_skor_jurnal" id="x_skor_jurnal" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_jurnal->getPlaceHolder()) ?>" value="<?= $Page->skor_jurnal->EditValue ?>"<?= $Page->skor_jurnal->editAttributes() ?> aria-describedby="x_skor_jurnal_help">
<?= $Page->skor_jurnal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_jurnal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_jurnal->Visible) { // max_jurnal ?>
    <div id="r_max_jurnal" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_jurnal" for="x_max_jurnal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_jurnal->caption() ?><?= $Page->max_jurnal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_jurnal->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_jurnal">
<input type="<?= $Page->max_jurnal->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_jurnal" name="x_max_jurnal" id="x_max_jurnal" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_jurnal->getPlaceHolder()) ?>" value="<?= $Page->max_jurnal->EditValue ?>"<?= $Page->max_jurnal->editAttributes() ?> aria-describedby="x_max_jurnal_help">
<?= $Page->max_jurnal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_jurnal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_akutansi->Visible) { // skor_akutansi ?>
    <div id="r_skor_akutansi" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_akutansi" for="x_skor_akutansi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_akutansi->caption() ?><?= $Page->skor_akutansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_akutansi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_akutansi">
<input type="<?= $Page->skor_akutansi->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_akutansi" name="x_skor_akutansi" id="x_skor_akutansi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_akutansi->getPlaceHolder()) ?>" value="<?= $Page->skor_akutansi->EditValue ?>"<?= $Page->skor_akutansi->editAttributes() ?> aria-describedby="x_skor_akutansi_help">
<?= $Page->skor_akutansi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_akutansi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_akutansi->Visible) { // max_akutansi ?>
    <div id="r_max_akutansi" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_akutansi" for="x_max_akutansi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_akutansi->caption() ?><?= $Page->max_akutansi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_akutansi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_akutansi">
<input type="<?= $Page->max_akutansi->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_akutansi" name="x_max_akutansi" id="x_max_akutansi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_akutansi->getPlaceHolder()) ?>" value="<?= $Page->max_akutansi->EditValue ?>"<?= $Page->max_akutansi->editAttributes() ?> aria-describedby="x_max_akutansi_help">
<?= $Page->max_akutansi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_akutansi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_utangbank->Visible) { // skor_utangbank ?>
    <div id="r_skor_utangbank" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_utangbank" for="x_skor_utangbank" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_utangbank->caption() ?><?= $Page->skor_utangbank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_utangbank->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_utangbank">
<input type="<?= $Page->skor_utangbank->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_utangbank" name="x_skor_utangbank" id="x_skor_utangbank" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_utangbank->getPlaceHolder()) ?>" value="<?= $Page->skor_utangbank->EditValue ?>"<?= $Page->skor_utangbank->editAttributes() ?> aria-describedby="x_skor_utangbank_help">
<?= $Page->skor_utangbank->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_utangbank->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_utangbank->Visible) { // max_utangbank ?>
    <div id="r_max_utangbank" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_utangbank" for="x_max_utangbank" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_utangbank->caption() ?><?= $Page->max_utangbank->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_utangbank->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_utangbank">
<input type="<?= $Page->max_utangbank->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_utangbank" name="x_max_utangbank" id="x_max_utangbank" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_utangbank->getPlaceHolder()) ?>" value="<?= $Page->max_utangbank->EditValue ?>"<?= $Page->max_utangbank->editAttributes() ?> aria-describedby="x_max_utangbank_help">
<?= $Page->max_utangbank->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_utangbank->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_dokumentasi->Visible) { // skor_dokumentasi ?>
    <div id="r_skor_dokumentasi" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_dokumentasi" for="x_skor_dokumentasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_dokumentasi->caption() ?><?= $Page->skor_dokumentasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_dokumentasi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_dokumentasi">
<input type="<?= $Page->skor_dokumentasi->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_dokumentasi" name="x_skor_dokumentasi" id="x_skor_dokumentasi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_dokumentasi->getPlaceHolder()) ?>" value="<?= $Page->skor_dokumentasi->EditValue ?>"<?= $Page->skor_dokumentasi->editAttributes() ?> aria-describedby="x_skor_dokumentasi_help">
<?= $Page->skor_dokumentasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_dokumentasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_dokumentasi->Visible) { // max_dokumentasi ?>
    <div id="r_max_dokumentasi" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_dokumentasi" for="x_max_dokumentasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_dokumentasi->caption() ?><?= $Page->max_dokumentasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_dokumentasi->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_dokumentasi">
<input type="<?= $Page->max_dokumentasi->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_dokumentasi" name="x_max_dokumentasi" id="x_max_dokumentasi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_dokumentasi->getPlaceHolder()) ?>" value="<?= $Page->max_dokumentasi->EditValue ?>"<?= $Page->max_dokumentasi->editAttributes() ?> aria-describedby="x_max_dokumentasi_help">
<?= $Page->max_dokumentasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_dokumentasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_nontunai->Visible) { // skor_nontunai ?>
    <div id="r_skor_nontunai" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_nontunai" for="x_skor_nontunai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_nontunai->caption() ?><?= $Page->skor_nontunai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_nontunai->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_nontunai">
<input type="<?= $Page->skor_nontunai->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_nontunai" name="x_skor_nontunai" id="x_skor_nontunai" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_nontunai->getPlaceHolder()) ?>" value="<?= $Page->skor_nontunai->EditValue ?>"<?= $Page->skor_nontunai->editAttributes() ?> aria-describedby="x_skor_nontunai_help">
<?= $Page->skor_nontunai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_nontunai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->max_nontunai->Visible) { // max_nontunai ?>
    <div id="r_max_nontunai" class="form-group row">
        <label id="elh_temp_skor_keuangan_max_nontunai" for="x_max_nontunai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->max_nontunai->caption() ?><?= $Page->max_nontunai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->max_nontunai->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_max_nontunai">
<input type="<?= $Page->max_nontunai->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_max_nontunai" name="x_max_nontunai" id="x_max_nontunai" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->max_nontunai->getPlaceHolder()) ?>" value="<?= $Page->max_nontunai->EditValue ?>"<?= $Page->max_nontunai->editAttributes() ?> aria-describedby="x_max_nontunai_help">
<?= $Page->max_nontunai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->max_nontunai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
    <div id="r_skor_keuangan" class="form-group row">
        <label id="elh_temp_skor_keuangan_skor_keuangan" for="x_skor_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_keuangan->caption() ?><?= $Page->skor_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_skor_keuangan">
<input type="<?= $Page->skor_keuangan->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_skor_keuangan" name="x_skor_keuangan" id="x_skor_keuangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_keuangan->getPlaceHolder()) ?>" value="<?= $Page->skor_keuangan->EditValue ?>"<?= $Page->skor_keuangan->editAttributes() ?> aria-describedby="x_skor_keuangan_help">
<?= $Page->skor_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_keuangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
    <div id="r_maxskor_keuangan" class="form-group row">
        <label id="elh_temp_skor_keuangan_maxskor_keuangan" for="x_maxskor_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_keuangan->caption() ?><?= $Page->maxskor_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_maxskor_keuangan">
<input type="<?= $Page->maxskor_keuangan->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_maxskor_keuangan" name="x_maxskor_keuangan" id="x_maxskor_keuangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_keuangan->getPlaceHolder()) ?>" value="<?= $Page->maxskor_keuangan->EditValue ?>"<?= $Page->maxskor_keuangan->editAttributes() ?> aria-describedby="x_maxskor_keuangan_help">
<?= $Page->maxskor_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_keuangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
    <div id="r_bobot_keuangan" class="form-group row">
        <label id="elh_temp_skor_keuangan_bobot_keuangan" for="x_bobot_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_keuangan->caption() ?><?= $Page->bobot_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_keuangan_bobot_keuangan">
<input type="<?= $Page->bobot_keuangan->getInputTextType() ?>" data-table="temp_skor_keuangan" data-field="x_bobot_keuangan" name="x_bobot_keuangan" id="x_bobot_keuangan" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_keuangan->getPlaceHolder()) ?>" value="<?= $Page->bobot_keuangan->EditValue ?>"<?= $Page->bobot_keuangan->editAttributes() ?> aria-describedby="x_bobot_keuangan_help">
<?= $Page->bobot_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_keuangan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_keuangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
