<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaDataEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbina_dataedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fbina_dataedit = currentForm = new ew.Form("fbina_dataedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "bina_data")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.bina_data)
        ew.vars.tables.bina_data = currentTable;
    fbina_dataedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["idperiode", [fields.idperiode.visible && fields.idperiode.required ? ew.Validators.required(fields.idperiode.caption) : null, ew.Validators.integer], fields.idperiode.isInvalid],
        ["idkelompok", [fields.idkelompok.visible && fields.idkelompok.required ? ew.Validators.required(fields.idkelompok.caption) : null, ew.Validators.integer], fields.idkelompok.isInvalid],
        ["namakegiatan", [fields.namakegiatan.visible && fields.namakegiatan.required ? ew.Validators.required(fields.namakegiatan.caption) : null], fields.namakegiatan.isInvalid],
        ["uraian", [fields.uraian.visible && fields.uraian.required ? ew.Validators.required(fields.uraian.caption) : null], fields.uraian.isInvalid],
        ["tglmulai", [fields.tglmulai.visible && fields.tglmulai.required ? ew.Validators.required(fields.tglmulai.caption) : null, ew.Validators.datetime(0)], fields.tglmulai.isInvalid],
        ["tglakhir", [fields.tglakhir.visible && fields.tglakhir.required ? ew.Validators.required(fields.tglakhir.caption) : null, ew.Validators.datetime(0)], fields.tglakhir.isInvalid],
        ["narasumber", [fields.narasumber.visible && fields.narasumber.required ? ew.Validators.required(fields.narasumber.caption) : null], fields.narasumber.isInvalid],
        ["kontak_nama", [fields.kontak_nama.visible && fields.kontak_nama.required ? ew.Validators.required(fields.kontak_nama.caption) : null], fields.kontak_nama.isInvalid],
        ["kontak_hp", [fields.kontak_hp.visible && fields.kontak_hp.required ? ew.Validators.required(fields.kontak_hp.caption) : null], fields.kontak_hp.isInvalid],
        ["poster", [fields.poster.visible && fields.poster.required ? ew.Validators.required(fields.poster.caption) : null], fields.poster.isInvalid],
        ["postertipe", [fields.postertipe.visible && fields.postertipe.required ? ew.Validators.required(fields.postertipe.caption) : null], fields.postertipe.isInvalid],
        ["posterukuran", [fields.posterukuran.visible && fields.posterukuran.required ? ew.Validators.required(fields.posterukuran.caption) : null, ew.Validators.integer], fields.posterukuran.isInvalid],
        ["posterlebar", [fields.posterlebar.visible && fields.posterlebar.required ? ew.Validators.required(fields.posterlebar.caption) : null, ew.Validators.integer], fields.posterlebar.isInvalid],
        ["postertinggi", [fields.postertinggi.visible && fields.postertinggi.required ? ew.Validators.required(fields.postertinggi.caption) : null, ew.Validators.integer], fields.postertinggi.isInvalid],
        ["linkinfo", [fields.linkinfo.visible && fields.linkinfo.required ? ew.Validators.required(fields.linkinfo.caption) : null], fields.linkinfo.isInvalid],
        ["peserta_kelas", [fields.peserta_kelas.visible && fields.peserta_kelas.required ? ew.Validators.required(fields.peserta_kelas.caption) : null], fields.peserta_kelas.isInvalid],
        ["waktu", [fields.waktu.visible && fields.waktu.required ? ew.Validators.required(fields.waktu.caption) : null, ew.Validators.datetime(0)], fields.waktu.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbina_dataedit,
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
    fbina_dataedit.validate = function () {
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
    fbina_dataedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbina_dataedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbina_dataedit");
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
<form name="fbina_dataedit" id="fbina_dataedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_data">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_bina_data_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_bina_data_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="bina_data" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idperiode->Visible) { // idperiode ?>
    <div id="r_idperiode" class="form-group row">
        <label id="elh_bina_data_idperiode" for="x_idperiode" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idperiode->caption() ?><?= $Page->idperiode->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idperiode->cellAttributes() ?>>
<span id="el_bina_data_idperiode">
<input type="<?= $Page->idperiode->getInputTextType() ?>" data-table="bina_data" data-field="x_idperiode" name="x_idperiode" id="x_idperiode" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->idperiode->getPlaceHolder()) ?>" value="<?= $Page->idperiode->EditValue ?>"<?= $Page->idperiode->editAttributes() ?> aria-describedby="x_idperiode_help">
<?= $Page->idperiode->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idperiode->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idkelompok->Visible) { // idkelompok ?>
    <div id="r_idkelompok" class="form-group row">
        <label id="elh_bina_data_idkelompok" for="x_idkelompok" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idkelompok->caption() ?><?= $Page->idkelompok->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idkelompok->cellAttributes() ?>>
<span id="el_bina_data_idkelompok">
<input type="<?= $Page->idkelompok->getInputTextType() ?>" data-table="bina_data" data-field="x_idkelompok" name="x_idkelompok" id="x_idkelompok" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->idkelompok->getPlaceHolder()) ?>" value="<?= $Page->idkelompok->EditValue ?>"<?= $Page->idkelompok->editAttributes() ?> aria-describedby="x_idkelompok_help">
<?= $Page->idkelompok->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idkelompok->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->namakegiatan->Visible) { // namakegiatan ?>
    <div id="r_namakegiatan" class="form-group row">
        <label id="elh_bina_data_namakegiatan" for="x_namakegiatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->namakegiatan->caption() ?><?= $Page->namakegiatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->namakegiatan->cellAttributes() ?>>
<span id="el_bina_data_namakegiatan">
<input type="<?= $Page->namakegiatan->getInputTextType() ?>" data-table="bina_data" data-field="x_namakegiatan" name="x_namakegiatan" id="x_namakegiatan" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->namakegiatan->getPlaceHolder()) ?>" value="<?= $Page->namakegiatan->EditValue ?>"<?= $Page->namakegiatan->editAttributes() ?> aria-describedby="x_namakegiatan_help">
<?= $Page->namakegiatan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->namakegiatan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->uraian->Visible) { // uraian ?>
    <div id="r_uraian" class="form-group row">
        <label id="elh_bina_data_uraian" for="x_uraian" class="<?= $Page->LeftColumnClass ?>"><?= $Page->uraian->caption() ?><?= $Page->uraian->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->uraian->cellAttributes() ?>>
<span id="el_bina_data_uraian">
<input type="<?= $Page->uraian->getInputTextType() ?>" data-table="bina_data" data-field="x_uraian" name="x_uraian" id="x_uraian" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->uraian->getPlaceHolder()) ?>" value="<?= $Page->uraian->EditValue ?>"<?= $Page->uraian->editAttributes() ?> aria-describedby="x_uraian_help">
<?= $Page->uraian->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->uraian->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
    <div id="r_tglmulai" class="form-group row">
        <label id="elh_bina_data_tglmulai" for="x_tglmulai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tglmulai->caption() ?><?= $Page->tglmulai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el_bina_data_tglmulai">
<input type="<?= $Page->tglmulai->getInputTextType() ?>" data-table="bina_data" data-field="x_tglmulai" name="x_tglmulai" id="x_tglmulai" maxlength="10" placeholder="<?= HtmlEncode($Page->tglmulai->getPlaceHolder()) ?>" value="<?= $Page->tglmulai->EditValue ?>"<?= $Page->tglmulai->editAttributes() ?> aria-describedby="x_tglmulai_help">
<?= $Page->tglmulai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tglmulai->getErrorMessage() ?></div>
<?php if (!$Page->tglmulai->ReadOnly && !$Page->tglmulai->Disabled && !isset($Page->tglmulai->EditAttrs["readonly"]) && !isset($Page->tglmulai->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbina_dataedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbina_dataedit", "x_tglmulai", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->tglakhir->Visible) { // tglakhir ?>
    <div id="r_tglakhir" class="form-group row">
        <label id="elh_bina_data_tglakhir" for="x_tglakhir" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tglakhir->caption() ?><?= $Page->tglakhir->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tglakhir->cellAttributes() ?>>
<span id="el_bina_data_tglakhir">
<input type="<?= $Page->tglakhir->getInputTextType() ?>" data-table="bina_data" data-field="x_tglakhir" name="x_tglakhir" id="x_tglakhir" maxlength="10" placeholder="<?= HtmlEncode($Page->tglakhir->getPlaceHolder()) ?>" value="<?= $Page->tglakhir->EditValue ?>"<?= $Page->tglakhir->editAttributes() ?> aria-describedby="x_tglakhir_help">
<?= $Page->tglakhir->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tglakhir->getErrorMessage() ?></div>
<?php if (!$Page->tglakhir->ReadOnly && !$Page->tglakhir->Disabled && !isset($Page->tglakhir->EditAttrs["readonly"]) && !isset($Page->tglakhir->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbina_dataedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbina_dataedit", "x_tglakhir", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->narasumber->Visible) { // narasumber ?>
    <div id="r_narasumber" class="form-group row">
        <label id="elh_bina_data_narasumber" for="x_narasumber" class="<?= $Page->LeftColumnClass ?>"><?= $Page->narasumber->caption() ?><?= $Page->narasumber->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->narasumber->cellAttributes() ?>>
<span id="el_bina_data_narasumber">
<input type="<?= $Page->narasumber->getInputTextType() ?>" data-table="bina_data" data-field="x_narasumber" name="x_narasumber" id="x_narasumber" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->narasumber->getPlaceHolder()) ?>" value="<?= $Page->narasumber->EditValue ?>"<?= $Page->narasumber->editAttributes() ?> aria-describedby="x_narasumber_help">
<?= $Page->narasumber->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->narasumber->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kontak_nama->Visible) { // kontak_nama ?>
    <div id="r_kontak_nama" class="form-group row">
        <label id="elh_bina_data_kontak_nama" for="x_kontak_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak_nama->caption() ?><?= $Page->kontak_nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kontak_nama->cellAttributes() ?>>
<span id="el_bina_data_kontak_nama">
<input type="<?= $Page->kontak_nama->getInputTextType() ?>" data-table="bina_data" data-field="x_kontak_nama" name="x_kontak_nama" id="x_kontak_nama" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak_nama->getPlaceHolder()) ?>" value="<?= $Page->kontak_nama->EditValue ?>"<?= $Page->kontak_nama->editAttributes() ?> aria-describedby="x_kontak_nama_help">
<?= $Page->kontak_nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak_nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kontak_hp->Visible) { // kontak_hp ?>
    <div id="r_kontak_hp" class="form-group row">
        <label id="elh_bina_data_kontak_hp" for="x_kontak_hp" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kontak_hp->caption() ?><?= $Page->kontak_hp->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kontak_hp->cellAttributes() ?>>
<span id="el_bina_data_kontak_hp">
<input type="<?= $Page->kontak_hp->getInputTextType() ?>" data-table="bina_data" data-field="x_kontak_hp" name="x_kontak_hp" id="x_kontak_hp" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kontak_hp->getPlaceHolder()) ?>" value="<?= $Page->kontak_hp->EditValue ?>"<?= $Page->kontak_hp->editAttributes() ?> aria-describedby="x_kontak_hp_help">
<?= $Page->kontak_hp->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kontak_hp->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->poster->Visible) { // poster ?>
    <div id="r_poster" class="form-group row">
        <label id="elh_bina_data_poster" for="x_poster" class="<?= $Page->LeftColumnClass ?>"><?= $Page->poster->caption() ?><?= $Page->poster->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->poster->cellAttributes() ?>>
<span id="el_bina_data_poster">
<input type="<?= $Page->poster->getInputTextType() ?>" data-table="bina_data" data-field="x_poster" name="x_poster" id="x_poster" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->poster->getPlaceHolder()) ?>" value="<?= $Page->poster->EditValue ?>"<?= $Page->poster->editAttributes() ?> aria-describedby="x_poster_help">
<?= $Page->poster->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->poster->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->postertipe->Visible) { // postertipe ?>
    <div id="r_postertipe" class="form-group row">
        <label id="elh_bina_data_postertipe" for="x_postertipe" class="<?= $Page->LeftColumnClass ?>"><?= $Page->postertipe->caption() ?><?= $Page->postertipe->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->postertipe->cellAttributes() ?>>
<span id="el_bina_data_postertipe">
<input type="<?= $Page->postertipe->getInputTextType() ?>" data-table="bina_data" data-field="x_postertipe" name="x_postertipe" id="x_postertipe" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->postertipe->getPlaceHolder()) ?>" value="<?= $Page->postertipe->EditValue ?>"<?= $Page->postertipe->editAttributes() ?> aria-describedby="x_postertipe_help">
<?= $Page->postertipe->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->postertipe->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->posterukuran->Visible) { // posterukuran ?>
    <div id="r_posterukuran" class="form-group row">
        <label id="elh_bina_data_posterukuran" for="x_posterukuran" class="<?= $Page->LeftColumnClass ?>"><?= $Page->posterukuran->caption() ?><?= $Page->posterukuran->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->posterukuran->cellAttributes() ?>>
<span id="el_bina_data_posterukuran">
<input type="<?= $Page->posterukuran->getInputTextType() ?>" data-table="bina_data" data-field="x_posterukuran" name="x_posterukuran" id="x_posterukuran" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->posterukuran->getPlaceHolder()) ?>" value="<?= $Page->posterukuran->EditValue ?>"<?= $Page->posterukuran->editAttributes() ?> aria-describedby="x_posterukuran_help">
<?= $Page->posterukuran->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->posterukuran->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->posterlebar->Visible) { // posterlebar ?>
    <div id="r_posterlebar" class="form-group row">
        <label id="elh_bina_data_posterlebar" for="x_posterlebar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->posterlebar->caption() ?><?= $Page->posterlebar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->posterlebar->cellAttributes() ?>>
<span id="el_bina_data_posterlebar">
<input type="<?= $Page->posterlebar->getInputTextType() ?>" data-table="bina_data" data-field="x_posterlebar" name="x_posterlebar" id="x_posterlebar" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->posterlebar->getPlaceHolder()) ?>" value="<?= $Page->posterlebar->EditValue ?>"<?= $Page->posterlebar->editAttributes() ?> aria-describedby="x_posterlebar_help">
<?= $Page->posterlebar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->posterlebar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->postertinggi->Visible) { // postertinggi ?>
    <div id="r_postertinggi" class="form-group row">
        <label id="elh_bina_data_postertinggi" for="x_postertinggi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->postertinggi->caption() ?><?= $Page->postertinggi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->postertinggi->cellAttributes() ?>>
<span id="el_bina_data_postertinggi">
<input type="<?= $Page->postertinggi->getInputTextType() ?>" data-table="bina_data" data-field="x_postertinggi" name="x_postertinggi" id="x_postertinggi" size="30" maxlength="11" placeholder="<?= HtmlEncode($Page->postertinggi->getPlaceHolder()) ?>" value="<?= $Page->postertinggi->EditValue ?>"<?= $Page->postertinggi->editAttributes() ?> aria-describedby="x_postertinggi_help">
<?= $Page->postertinggi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->postertinggi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->linkinfo->Visible) { // linkinfo ?>
    <div id="r_linkinfo" class="form-group row">
        <label id="elh_bina_data_linkinfo" for="x_linkinfo" class="<?= $Page->LeftColumnClass ?>"><?= $Page->linkinfo->caption() ?><?= $Page->linkinfo->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->linkinfo->cellAttributes() ?>>
<span id="el_bina_data_linkinfo">
<input type="<?= $Page->linkinfo->getInputTextType() ?>" data-table="bina_data" data-field="x_linkinfo" name="x_linkinfo" id="x_linkinfo" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->linkinfo->getPlaceHolder()) ?>" value="<?= $Page->linkinfo->EditValue ?>"<?= $Page->linkinfo->editAttributes() ?> aria-describedby="x_linkinfo_help">
<?= $Page->linkinfo->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->linkinfo->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->peserta_kelas->Visible) { // peserta_kelas ?>
    <div id="r_peserta_kelas" class="form-group row">
        <label id="elh_bina_data_peserta_kelas" for="x_peserta_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->peserta_kelas->caption() ?><?= $Page->peserta_kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->peserta_kelas->cellAttributes() ?>>
<span id="el_bina_data_peserta_kelas">
<input type="<?= $Page->peserta_kelas->getInputTextType() ?>" data-table="bina_data" data-field="x_peserta_kelas" name="x_peserta_kelas" id="x_peserta_kelas" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->peserta_kelas->getPlaceHolder()) ?>" value="<?= $Page->peserta_kelas->EditValue ?>"<?= $Page->peserta_kelas->editAttributes() ?> aria-describedby="x_peserta_kelas_help">
<?= $Page->peserta_kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->peserta_kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu->Visible) { // waktu ?>
    <div id="r_waktu" class="form-group row">
        <label id="elh_bina_data_waktu" for="x_waktu" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu->caption() ?><?= $Page->waktu->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu->cellAttributes() ?>>
<span id="el_bina_data_waktu">
<input type="<?= $Page->waktu->getInputTextType() ?>" data-table="bina_data" data-field="x_waktu" name="x_waktu" id="x_waktu" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu->getPlaceHolder()) ?>" value="<?= $Page->waktu->EditValue ?>"<?= $Page->waktu->editAttributes() ?> aria-describedby="x_waktu_help">
<?= $Page->waktu->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu->getErrorMessage() ?></div>
<?php if (!$Page->waktu->ReadOnly && !$Page->waktu->Disabled && !isset($Page->waktu->EditAttrs["readonly"]) && !isset($Page->waktu->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fbina_dataedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fbina_dataedit", "x_waktu", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
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
    ew.addEventHandlers("bina_data");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
