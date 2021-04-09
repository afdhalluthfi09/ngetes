<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempSkorKelasEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_skor_kelasedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    ftemp_skor_kelasedit = currentForm = new ew.Form("ftemp_skor_kelasedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_skor_kelas")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_skor_kelas)
        ew.vars.tables.temp_skor_kelas = currentTable;
    ftemp_skor_kelasedit.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["NAMA_PEMILIK", [fields.NAMA_PEMILIK.visible && fields.NAMA_PEMILIK.required ? ew.Validators.required(fields.NAMA_PEMILIK.caption) : null], fields.NAMA_PEMILIK.isInvalid],
        ["NO_HP", [fields.NO_HP.visible && fields.NO_HP.required ? ew.Validators.required(fields.NO_HP.caption) : null], fields.NO_HP.isInvalid],
        ["NAMA_USAHA", [fields.NAMA_USAHA.visible && fields.NAMA_USAHA.required ? ew.Validators.required(fields.NAMA_USAHA.caption) : null], fields.NAMA_USAHA.isInvalid],
        ["KALURAHAN", [fields.KALURAHAN.visible && fields.KALURAHAN.required ? ew.Validators.required(fields.KALURAHAN.caption) : null], fields.KALURAHAN.isInvalid],
        ["KAPANEWON", [fields.KAPANEWON.visible && fields.KAPANEWON.required ? ew.Validators.required(fields.KAPANEWON.caption) : null], fields.KAPANEWON.isInvalid],
        ["skor_produksi", [fields.skor_produksi.visible && fields.skor_produksi.required ? ew.Validators.required(fields.skor_produksi.caption) : null, ew.Validators.float], fields.skor_produksi.isInvalid],
        ["maxskor_produksi", [fields.maxskor_produksi.visible && fields.maxskor_produksi.required ? ew.Validators.required(fields.maxskor_produksi.caption) : null, ew.Validators.float], fields.maxskor_produksi.isInvalid],
        ["bobot_produksi", [fields.bobot_produksi.visible && fields.bobot_produksi.required ? ew.Validators.required(fields.bobot_produksi.caption) : null, ew.Validators.integer], fields.bobot_produksi.isInvalid],
        ["skor_pemasaran", [fields.skor_pemasaran.visible && fields.skor_pemasaran.required ? ew.Validators.required(fields.skor_pemasaran.caption) : null, ew.Validators.float], fields.skor_pemasaran.isInvalid],
        ["maxskor_pemasaran", [fields.maxskor_pemasaran.visible && fields.maxskor_pemasaran.required ? ew.Validators.required(fields.maxskor_pemasaran.caption) : null, ew.Validators.float], fields.maxskor_pemasaran.isInvalid],
        ["bobot_pemasaran", [fields.bobot_pemasaran.visible && fields.bobot_pemasaran.required ? ew.Validators.required(fields.bobot_pemasaran.caption) : null, ew.Validators.integer], fields.bobot_pemasaran.isInvalid],
        ["skor_pemasaranonline", [fields.skor_pemasaranonline.visible && fields.skor_pemasaranonline.required ? ew.Validators.required(fields.skor_pemasaranonline.caption) : null, ew.Validators.float], fields.skor_pemasaranonline.isInvalid],
        ["maxskor_pemasaranonline", [fields.maxskor_pemasaranonline.visible && fields.maxskor_pemasaranonline.required ? ew.Validators.required(fields.maxskor_pemasaranonline.caption) : null, ew.Validators.float], fields.maxskor_pemasaranonline.isInvalid],
        ["bobot_pemasaranonline", [fields.bobot_pemasaranonline.visible && fields.bobot_pemasaranonline.required ? ew.Validators.required(fields.bobot_pemasaranonline.caption) : null, ew.Validators.integer], fields.bobot_pemasaranonline.isInvalid],
        ["skor_kelembagaan", [fields.skor_kelembagaan.visible && fields.skor_kelembagaan.required ? ew.Validators.required(fields.skor_kelembagaan.caption) : null, ew.Validators.float], fields.skor_kelembagaan.isInvalid],
        ["maxskor_kelembagaan", [fields.maxskor_kelembagaan.visible && fields.maxskor_kelembagaan.required ? ew.Validators.required(fields.maxskor_kelembagaan.caption) : null, ew.Validators.float], fields.maxskor_kelembagaan.isInvalid],
        ["bobot_kelembagaan", [fields.bobot_kelembagaan.visible && fields.bobot_kelembagaan.required ? ew.Validators.required(fields.bobot_kelembagaan.caption) : null, ew.Validators.integer], fields.bobot_kelembagaan.isInvalid],
        ["skor_keuangan", [fields.skor_keuangan.visible && fields.skor_keuangan.required ? ew.Validators.required(fields.skor_keuangan.caption) : null, ew.Validators.float], fields.skor_keuangan.isInvalid],
        ["maxskor_keuangan", [fields.maxskor_keuangan.visible && fields.maxskor_keuangan.required ? ew.Validators.required(fields.maxskor_keuangan.caption) : null, ew.Validators.float], fields.maxskor_keuangan.isInvalid],
        ["bobot_keuangan", [fields.bobot_keuangan.visible && fields.bobot_keuangan.required ? ew.Validators.required(fields.bobot_keuangan.caption) : null, ew.Validators.integer], fields.bobot_keuangan.isInvalid],
        ["skor_sdm", [fields.skor_sdm.visible && fields.skor_sdm.required ? ew.Validators.required(fields.skor_sdm.caption) : null, ew.Validators.float], fields.skor_sdm.isInvalid],
        ["maxskor_sdm", [fields.maxskor_sdm.visible && fields.maxskor_sdm.required ? ew.Validators.required(fields.maxskor_sdm.caption) : null, ew.Validators.float], fields.maxskor_sdm.isInvalid],
        ["bobot_sdm", [fields.bobot_sdm.visible && fields.bobot_sdm.required ? ew.Validators.required(fields.bobot_sdm.caption) : null, ew.Validators.integer], fields.bobot_sdm.isInvalid],
        ["skor_kelas", [fields.skor_kelas.visible && fields.skor_kelas.required ? ew.Validators.required(fields.skor_kelas.caption) : null, ew.Validators.float], fields.skor_kelas.isInvalid],
        ["maxskor_kelas", [fields.maxskor_kelas.visible && fields.maxskor_kelas.required ? ew.Validators.required(fields.maxskor_kelas.caption) : null, ew.Validators.float], fields.maxskor_kelas.isInvalid],
        ["kelas_umkm", [fields.kelas_umkm.visible && fields.kelas_umkm.required ? ew.Validators.required(fields.kelas_umkm.caption) : null], fields.kelas_umkm.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_skor_kelasedit,
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
    ftemp_skor_kelasedit.validate = function () {
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
    ftemp_skor_kelasedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_skor_kelasedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_skor_kelasedit");
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
<form name="ftemp_skor_kelasedit" id="ftemp_skor_kelasedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_skor_kelas">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_temp_skor_kelas_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
<input type="hidden" data-table="temp_skor_kelas" data-field="x_NIK" data-hidden="1" name="o_NIK" id="o_NIK" value="<?= HtmlEncode($Page->NIK->OldValue ?? $Page->NIK->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
    <div id="r_NAMA_PEMILIK" class="form-group row">
        <label id="elh_temp_skor_kelas_NAMA_PEMILIK" for="x_NAMA_PEMILIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PEMILIK->caption() ?><?= $Page->NAMA_PEMILIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NAMA_PEMILIK">
<input type="<?= $Page->NAMA_PEMILIK->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_NAMA_PEMILIK" name="x_NAMA_PEMILIK" id="x_NAMA_PEMILIK" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_PEMILIK->getPlaceHolder()) ?>" value="<?= $Page->NAMA_PEMILIK->EditValue ?>"<?= $Page->NAMA_PEMILIK->editAttributes() ?> aria-describedby="x_NAMA_PEMILIK_help">
<?= $Page->NAMA_PEMILIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_PEMILIK->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
    <div id="r_NO_HP" class="form-group row">
        <label id="elh_temp_skor_kelas_NO_HP" for="x_NO_HP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_HP->caption() ?><?= $Page->NO_HP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_HP->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NO_HP">
<input type="<?= $Page->NO_HP->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_NO_HP" name="x_NO_HP" id="x_NO_HP" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->NO_HP->getPlaceHolder()) ?>" value="<?= $Page->NO_HP->EditValue ?>"<?= $Page->NO_HP->editAttributes() ?> aria-describedby="x_NO_HP_help">
<?= $Page->NO_HP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_HP->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
    <div id="r_NAMA_USAHA" class="form-group row">
        <label id="elh_temp_skor_kelas_NAMA_USAHA" for="x_NAMA_USAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_USAHA->caption() ?><?= $Page->NAMA_USAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el_temp_skor_kelas_NAMA_USAHA">
<input type="<?= $Page->NAMA_USAHA->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_NAMA_USAHA" name="x_NAMA_USAHA" id="x_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NAMA_USAHA->EditValue ?>"<?= $Page->NAMA_USAHA->editAttributes() ?> aria-describedby="x_NAMA_USAHA_help">
<?= $Page->NAMA_USAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_USAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
    <div id="r_KALURAHAN" class="form-group row">
        <label id="elh_temp_skor_kelas_KALURAHAN" for="x_KALURAHAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KALURAHAN->caption() ?><?= $Page->KALURAHAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el_temp_skor_kelas_KALURAHAN">
<input type="<?= $Page->KALURAHAN->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_KALURAHAN" name="x_KALURAHAN" id="x_KALURAHAN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KALURAHAN->getPlaceHolder()) ?>" value="<?= $Page->KALURAHAN->EditValue ?>"<?= $Page->KALURAHAN->editAttributes() ?> aria-describedby="x_KALURAHAN_help">
<?= $Page->KALURAHAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KALURAHAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
    <div id="r_KAPANEWON" class="form-group row">
        <label id="elh_temp_skor_kelas_KAPANEWON" for="x_KAPANEWON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAPANEWON->caption() ?><?= $Page->KAPANEWON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el_temp_skor_kelas_KAPANEWON">
<input type="<?= $Page->KAPANEWON->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_KAPANEWON" name="x_KAPANEWON" id="x_KAPANEWON" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->KAPANEWON->getPlaceHolder()) ?>" value="<?= $Page->KAPANEWON->EditValue ?>"<?= $Page->KAPANEWON->editAttributes() ?> aria-describedby="x_KAPANEWON_help">
<?= $Page->KAPANEWON->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->KAPANEWON->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_produksi->Visible) { // skor_produksi ?>
    <div id="r_skor_produksi" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_produksi" for="x_skor_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_produksi->caption() ?><?= $Page->skor_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_produksi">
<input type="<?= $Page->skor_produksi->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_produksi" name="x_skor_produksi" id="x_skor_produksi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_produksi->getPlaceHolder()) ?>" value="<?= $Page->skor_produksi->EditValue ?>"<?= $Page->skor_produksi->editAttributes() ?> aria-describedby="x_skor_produksi_help">
<?= $Page->skor_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_produksi->Visible) { // maxskor_produksi ?>
    <div id="r_maxskor_produksi" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_produksi" for="x_maxskor_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_produksi->caption() ?><?= $Page->maxskor_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_produksi">
<input type="<?= $Page->maxskor_produksi->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_produksi" name="x_maxskor_produksi" id="x_maxskor_produksi" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_produksi->getPlaceHolder()) ?>" value="<?= $Page->maxskor_produksi->EditValue ?>"<?= $Page->maxskor_produksi->editAttributes() ?> aria-describedby="x_maxskor_produksi_help">
<?= $Page->maxskor_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_produksi->Visible) { // bobot_produksi ?>
    <div id="r_bobot_produksi" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_produksi" for="x_bobot_produksi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_produksi->caption() ?><?= $Page->bobot_produksi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_produksi->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_produksi">
<input type="<?= $Page->bobot_produksi->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_produksi" name="x_bobot_produksi" id="x_bobot_produksi" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_produksi->getPlaceHolder()) ?>" value="<?= $Page->bobot_produksi->EditValue ?>"<?= $Page->bobot_produksi->editAttributes() ?> aria-describedby="x_bobot_produksi_help">
<?= $Page->bobot_produksi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_produksi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pemasaran->Visible) { // skor_pemasaran ?>
    <div id="r_skor_pemasaran" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_pemasaran" for="x_skor_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pemasaran->caption() ?><?= $Page->skor_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_pemasaran">
<input type="<?= $Page->skor_pemasaran->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_pemasaran" name="x_skor_pemasaran" id="x_skor_pemasaran" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->skor_pemasaran->EditValue ?>"<?= $Page->skor_pemasaran->editAttributes() ?> aria-describedby="x_skor_pemasaran_help">
<?= $Page->skor_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pemasaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_pemasaran->Visible) { // maxskor_pemasaran ?>
    <div id="r_maxskor_pemasaran" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_pemasaran" for="x_maxskor_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_pemasaran->caption() ?><?= $Page->maxskor_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_pemasaran">
<input type="<?= $Page->maxskor_pemasaran->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_pemasaran" name="x_maxskor_pemasaran" id="x_maxskor_pemasaran" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->maxskor_pemasaran->EditValue ?>"<?= $Page->maxskor_pemasaran->editAttributes() ?> aria-describedby="x_maxskor_pemasaran_help">
<?= $Page->maxskor_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_pemasaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_pemasaran->Visible) { // bobot_pemasaran ?>
    <div id="r_bobot_pemasaran" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_pemasaran" for="x_bobot_pemasaran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_pemasaran->caption() ?><?= $Page->bobot_pemasaran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_pemasaran->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_pemasaran">
<input type="<?= $Page->bobot_pemasaran->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_pemasaran" name="x_bobot_pemasaran" id="x_bobot_pemasaran" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_pemasaran->getPlaceHolder()) ?>" value="<?= $Page->bobot_pemasaran->EditValue ?>"<?= $Page->bobot_pemasaran->editAttributes() ?> aria-describedby="x_bobot_pemasaran_help">
<?= $Page->bobot_pemasaran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_pemasaran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_pemasaranonline->Visible) { // skor_pemasaranonline ?>
    <div id="r_skor_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_pemasaranonline" for="x_skor_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_pemasaranonline->caption() ?><?= $Page->skor_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_pemasaranonline">
<input type="<?= $Page->skor_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_pemasaranonline" name="x_skor_pemasaranonline" id="x_skor_pemasaranonline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->skor_pemasaranonline->EditValue ?>"<?= $Page->skor_pemasaranonline->editAttributes() ?> aria-describedby="x_skor_pemasaranonline_help">
<?= $Page->skor_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_pemasaranonline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_pemasaranonline->Visible) { // maxskor_pemasaranonline ?>
    <div id="r_maxskor_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_pemasaranonline" for="x_maxskor_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_pemasaranonline->caption() ?><?= $Page->maxskor_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_pemasaranonline">
<input type="<?= $Page->maxskor_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_pemasaranonline" name="x_maxskor_pemasaranonline" id="x_maxskor_pemasaranonline" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->maxskor_pemasaranonline->EditValue ?>"<?= $Page->maxskor_pemasaranonline->editAttributes() ?> aria-describedby="x_maxskor_pemasaranonline_help">
<?= $Page->maxskor_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_pemasaranonline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_pemasaranonline->Visible) { // bobot_pemasaranonline ?>
    <div id="r_bobot_pemasaranonline" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_pemasaranonline" for="x_bobot_pemasaranonline" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_pemasaranonline->caption() ?><?= $Page->bobot_pemasaranonline->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_pemasaranonline->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_pemasaranonline">
<input type="<?= $Page->bobot_pemasaranonline->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_pemasaranonline" name="x_bobot_pemasaranonline" id="x_bobot_pemasaranonline" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_pemasaranonline->getPlaceHolder()) ?>" value="<?= $Page->bobot_pemasaranonline->EditValue ?>"<?= $Page->bobot_pemasaranonline->editAttributes() ?> aria-describedby="x_bobot_pemasaranonline_help">
<?= $Page->bobot_pemasaranonline->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_pemasaranonline->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_kelembagaan->Visible) { // skor_kelembagaan ?>
    <div id="r_skor_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_kelembagaan" for="x_skor_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_kelembagaan->caption() ?><?= $Page->skor_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_kelembagaan">
<input type="<?= $Page->skor_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_kelembagaan" name="x_skor_kelembagaan" id="x_skor_kelembagaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->skor_kelembagaan->EditValue ?>"<?= $Page->skor_kelembagaan->editAttributes() ?> aria-describedby="x_skor_kelembagaan_help">
<?= $Page->skor_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_kelembagaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_kelembagaan->Visible) { // maxskor_kelembagaan ?>
    <div id="r_maxskor_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_kelembagaan" for="x_maxskor_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_kelembagaan->caption() ?><?= $Page->maxskor_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_kelembagaan">
<input type="<?= $Page->maxskor_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_kelembagaan" name="x_maxskor_kelembagaan" id="x_maxskor_kelembagaan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->maxskor_kelembagaan->EditValue ?>"<?= $Page->maxskor_kelembagaan->editAttributes() ?> aria-describedby="x_maxskor_kelembagaan_help">
<?= $Page->maxskor_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_kelembagaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_kelembagaan->Visible) { // bobot_kelembagaan ?>
    <div id="r_bobot_kelembagaan" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_kelembagaan" for="x_bobot_kelembagaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_kelembagaan->caption() ?><?= $Page->bobot_kelembagaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_kelembagaan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_kelembagaan">
<input type="<?= $Page->bobot_kelembagaan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_kelembagaan" name="x_bobot_kelembagaan" id="x_bobot_kelembagaan" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_kelembagaan->getPlaceHolder()) ?>" value="<?= $Page->bobot_kelembagaan->EditValue ?>"<?= $Page->bobot_kelembagaan->editAttributes() ?> aria-describedby="x_bobot_kelembagaan_help">
<?= $Page->bobot_kelembagaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_kelembagaan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_keuangan->Visible) { // skor_keuangan ?>
    <div id="r_skor_keuangan" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_keuangan" for="x_skor_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_keuangan->caption() ?><?= $Page->skor_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_keuangan">
<input type="<?= $Page->skor_keuangan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_keuangan" name="x_skor_keuangan" id="x_skor_keuangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_keuangan->getPlaceHolder()) ?>" value="<?= $Page->skor_keuangan->EditValue ?>"<?= $Page->skor_keuangan->editAttributes() ?> aria-describedby="x_skor_keuangan_help">
<?= $Page->skor_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_keuangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_keuangan->Visible) { // maxskor_keuangan ?>
    <div id="r_maxskor_keuangan" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_keuangan" for="x_maxskor_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_keuangan->caption() ?><?= $Page->maxskor_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_keuangan">
<input type="<?= $Page->maxskor_keuangan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_keuangan" name="x_maxskor_keuangan" id="x_maxskor_keuangan" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_keuangan->getPlaceHolder()) ?>" value="<?= $Page->maxskor_keuangan->EditValue ?>"<?= $Page->maxskor_keuangan->editAttributes() ?> aria-describedby="x_maxskor_keuangan_help">
<?= $Page->maxskor_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_keuangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_keuangan->Visible) { // bobot_keuangan ?>
    <div id="r_bobot_keuangan" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_keuangan" for="x_bobot_keuangan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_keuangan->caption() ?><?= $Page->bobot_keuangan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_keuangan->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_keuangan">
<input type="<?= $Page->bobot_keuangan->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_keuangan" name="x_bobot_keuangan" id="x_bobot_keuangan" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_keuangan->getPlaceHolder()) ?>" value="<?= $Page->bobot_keuangan->EditValue ?>"<?= $Page->bobot_keuangan->editAttributes() ?> aria-describedby="x_bobot_keuangan_help">
<?= $Page->bobot_keuangan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_keuangan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_sdm->Visible) { // skor_sdm ?>
    <div id="r_skor_sdm" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_sdm" for="x_skor_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_sdm->caption() ?><?= $Page->skor_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_sdm">
<input type="<?= $Page->skor_sdm->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_sdm" name="x_skor_sdm" id="x_skor_sdm" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_sdm->getPlaceHolder()) ?>" value="<?= $Page->skor_sdm->EditValue ?>"<?= $Page->skor_sdm->editAttributes() ?> aria-describedby="x_skor_sdm_help">
<?= $Page->skor_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_sdm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_sdm->Visible) { // maxskor_sdm ?>
    <div id="r_maxskor_sdm" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_sdm" for="x_maxskor_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_sdm->caption() ?><?= $Page->maxskor_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_sdm">
<input type="<?= $Page->maxskor_sdm->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_sdm" name="x_maxskor_sdm" id="x_maxskor_sdm" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_sdm->getPlaceHolder()) ?>" value="<?= $Page->maxskor_sdm->EditValue ?>"<?= $Page->maxskor_sdm->editAttributes() ?> aria-describedby="x_maxskor_sdm_help">
<?= $Page->maxskor_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_sdm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot_sdm->Visible) { // bobot_sdm ?>
    <div id="r_bobot_sdm" class="form-group row">
        <label id="elh_temp_skor_kelas_bobot_sdm" for="x_bobot_sdm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot_sdm->caption() ?><?= $Page->bobot_sdm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot_sdm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_bobot_sdm">
<input type="<?= $Page->bobot_sdm->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_bobot_sdm" name="x_bobot_sdm" id="x_bobot_sdm" size="30" maxlength="2" placeholder="<?= HtmlEncode($Page->bobot_sdm->getPlaceHolder()) ?>" value="<?= $Page->bobot_sdm->EditValue ?>"<?= $Page->bobot_sdm->editAttributes() ?> aria-describedby="x_bobot_sdm_help">
<?= $Page->bobot_sdm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot_sdm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->skor_kelas->Visible) { // skor_kelas ?>
    <div id="r_skor_kelas" class="form-group row">
        <label id="elh_temp_skor_kelas_skor_kelas" for="x_skor_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->skor_kelas->caption() ?><?= $Page->skor_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->skor_kelas->cellAttributes() ?>>
<span id="el_temp_skor_kelas_skor_kelas">
<input type="<?= $Page->skor_kelas->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_skor_kelas" name="x_skor_kelas" id="x_skor_kelas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->skor_kelas->getPlaceHolder()) ?>" value="<?= $Page->skor_kelas->EditValue ?>"<?= $Page->skor_kelas->editAttributes() ?> aria-describedby="x_skor_kelas_help">
<?= $Page->skor_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->skor_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->maxskor_kelas->Visible) { // maxskor_kelas ?>
    <div id="r_maxskor_kelas" class="form-group row">
        <label id="elh_temp_skor_kelas_maxskor_kelas" for="x_maxskor_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->maxskor_kelas->caption() ?><?= $Page->maxskor_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->maxskor_kelas->cellAttributes() ?>>
<span id="el_temp_skor_kelas_maxskor_kelas">
<input type="<?= $Page->maxskor_kelas->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_maxskor_kelas" name="x_maxskor_kelas" id="x_maxskor_kelas" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->maxskor_kelas->getPlaceHolder()) ?>" value="<?= $Page->maxskor_kelas->EditValue ?>"<?= $Page->maxskor_kelas->editAttributes() ?> aria-describedby="x_maxskor_kelas_help">
<?= $Page->maxskor_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->maxskor_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kelas_umkm->Visible) { // kelas_umkm ?>
    <div id="r_kelas_umkm" class="form-group row">
        <label id="elh_temp_skor_kelas_kelas_umkm" for="x_kelas_umkm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kelas_umkm->caption() ?><?= $Page->kelas_umkm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kelas_umkm->cellAttributes() ?>>
<span id="el_temp_skor_kelas_kelas_umkm">
<input type="<?= $Page->kelas_umkm->getInputTextType() ?>" data-table="temp_skor_kelas" data-field="x_kelas_umkm" name="x_kelas_umkm" id="x_kelas_umkm" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->kelas_umkm->getPlaceHolder()) ?>" value="<?= $Page->kelas_umkm->EditValue ?>"<?= $Page->kelas_umkm->editAttributes() ?> aria-describedby="x_kelas_umkm_help">
<?= $Page->kelas_umkm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kelas_umkm->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_skor_kelas");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
