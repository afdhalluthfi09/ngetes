<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$PhpKurasiPerbaikanEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fphp_kurasi_perbaikanedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fphp_kurasi_perbaikanedit = currentForm = new ew.Form("fphp_kurasi_perbaikanedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "php_kurasi_perbaikan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.php_kurasi_perbaikan)
        ew.vars.tables.php_kurasi_perbaikan = currentTable;
    fphp_kurasi_perbaikanedit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["nik_ukm", [fields.nik_ukm.visible && fields.nik_ukm.required ? ew.Validators.required(fields.nik_ukm.caption) : null], fields.nik_ukm.isInvalid],
        ["produk_nama", [fields.produk_nama.visible && fields.produk_nama.required ? ew.Validators.required(fields.produk_nama.caption) : null], fields.produk_nama.isInvalid],
        ["produk_jenis", [fields.produk_jenis.visible && fields.produk_jenis.required ? ew.Validators.required(fields.produk_jenis.caption) : null], fields.produk_jenis.isInvalid],
        ["produk_desc", [fields.produk_desc.visible && fields.produk_desc.required ? ew.Validators.required(fields.produk_desc.caption) : null], fields.produk_desc.isInvalid],
        ["produk_harga", [fields.produk_harga.visible && fields.produk_harga.required ? ew.Validators.required(fields.produk_harga.caption) : null, ew.Validators.float], fields.produk_harga.isInvalid],
        ["produk_foto", [fields.produk_foto.visible && fields.produk_foto.required ? ew.Validators.fileRequired(fields.produk_foto.caption) : null], fields.produk_foto.isInvalid],
        ["produk_berat", [fields.produk_berat.visible && fields.produk_berat.required ? ew.Validators.required(fields.produk_berat.caption) : null, ew.Validators.float], fields.produk_berat.isInvalid],
        ["produk_legal", [fields.produk_legal.visible && fields.produk_legal.required ? ew.Validators.required(fields.produk_legal.caption) : null, ew.Validators.integer], fields.produk_legal.isInvalid],
        ["judul_sesuai", [fields.judul_sesuai.visible && fields.judul_sesuai.required ? ew.Validators.required(fields.judul_sesuai.caption) : null, ew.Validators.integer], fields.judul_sesuai.isInvalid],
        ["foto_bagus", [fields.foto_bagus.visible && fields.foto_bagus.required ? ew.Validators.required(fields.foto_bagus.caption) : null, ew.Validators.integer], fields.foto_bagus.isInvalid],
        ["deskripsi_jelas", [fields.deskripsi_jelas.visible && fields.deskripsi_jelas.required ? ew.Validators.required(fields.deskripsi_jelas.caption) : null, ew.Validators.integer], fields.deskripsi_jelas.isInvalid],
        ["harga_tidak_kosong", [fields.harga_tidak_kosong.visible && fields.harga_tidak_kosong.required ? ew.Validators.required(fields.harga_tidak_kosong.caption) : null, ew.Validators.integer], fields.harga_tidak_kosong.isInvalid],
        ["berat_tidak_kosong", [fields.berat_tidak_kosong.visible && fields.berat_tidak_kosong.required ? ew.Validators.required(fields.berat_tidak_kosong.caption) : null, ew.Validators.integer], fields.berat_tidak_kosong.isInvalid],
        ["kurasi", [fields.kurasi.visible && fields.kurasi.required ? ew.Validators.required(fields.kurasi.caption) : null], fields.kurasi.isInvalid],
        ["waktu_entry", [fields.waktu_entry.visible && fields.waktu_entry.required ? ew.Validators.required(fields.waktu_entry.caption) : null, ew.Validators.datetime(0)], fields.waktu_entry.isInvalid],
        ["waktu_kurasi", [fields.waktu_kurasi.visible && fields.waktu_kurasi.required ? ew.Validators.required(fields.waktu_kurasi.caption) : null, ew.Validators.datetime(0)], fields.waktu_kurasi.isInvalid],
        ["waktu_update", [fields.waktu_update.visible && fields.waktu_update.required ? ew.Validators.required(fields.waktu_update.caption) : null, ew.Validators.datetime(0)], fields.waktu_update.isInvalid],
        ["editor", [fields.editor.visible && fields.editor.required ? ew.Validators.required(fields.editor.caption) : null], fields.editor.isInvalid],
        ["kurator", [fields.kurator.visible && fields.kurator.required ? ew.Validators.required(fields.kurator.caption) : null], fields.kurator.isInvalid],
        ["produk_panjang", [fields.produk_panjang.visible && fields.produk_panjang.required ? ew.Validators.required(fields.produk_panjang.caption) : null, ew.Validators.float], fields.produk_panjang.isInvalid],
        ["produk_lebar", [fields.produk_lebar.visible && fields.produk_lebar.required ? ew.Validators.required(fields.produk_lebar.caption) : null, ew.Validators.float], fields.produk_lebar.isInvalid],
        ["produk_tinggi", [fields.produk_tinggi.visible && fields.produk_tinggi.required ? ew.Validators.required(fields.produk_tinggi.caption) : null, ew.Validators.float], fields.produk_tinggi.isInvalid],
        ["produk_foto_1", [fields.produk_foto_1.visible && fields.produk_foto_1.required ? ew.Validators.fileRequired(fields.produk_foto_1.caption) : null], fields.produk_foto_1.isInvalid],
        ["produk_foto_2", [fields.produk_foto_2.visible && fields.produk_foto_2.required ? ew.Validators.fileRequired(fields.produk_foto_2.caption) : null], fields.produk_foto_2.isInvalid],
        ["produk_foto_3", [fields.produk_foto_3.visible && fields.produk_foto_3.required ? ew.Validators.fileRequired(fields.produk_foto_3.caption) : null], fields.produk_foto_3.isInvalid],
        ["catatan", [fields.catatan.visible && fields.catatan.required ? ew.Validators.required(fields.catatan.caption) : null], fields.catatan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fphp_kurasi_perbaikanedit,
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
    fphp_kurasi_perbaikanedit.validate = function () {
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
    fphp_kurasi_perbaikanedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fphp_kurasi_perbaikanedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fphp_kurasi_perbaikanedit");
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
<form name="fphp_kurasi_perbaikanedit" id="fphp_kurasi_perbaikanedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="php_kurasi_perbaikan">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="php_kurasi_perbaikan" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nik_ukm->Visible) { // nik_ukm ?>
    <div id="r_nik_ukm" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_nik_ukm" for="x_nik_ukm" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik_ukm->caption() ?><?= $Page->nik_ukm->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik_ukm->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_nik_ukm">
<input type="<?= $Page->nik_ukm->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_nik_ukm" name="x_nik_ukm" id="x_nik_ukm" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik_ukm->getPlaceHolder()) ?>" value="<?= $Page->nik_ukm->EditValue ?>"<?= $Page->nik_ukm->editAttributes() ?> aria-describedby="x_nik_ukm_help">
<?= $Page->nik_ukm->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik_ukm->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_nama->Visible) { // produk_nama ?>
    <div id="r_produk_nama" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_nama" for="x_produk_nama" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_nama->caption() ?><?= $Page->produk_nama->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_nama->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_nama">
<input type="<?= $Page->produk_nama->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_nama" name="x_produk_nama" id="x_produk_nama" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->produk_nama->getPlaceHolder()) ?>" value="<?= $Page->produk_nama->EditValue ?>"<?= $Page->produk_nama->editAttributes() ?> aria-describedby="x_produk_nama_help">
<?= $Page->produk_nama->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_nama->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_jenis->Visible) { // produk_jenis ?>
    <div id="r_produk_jenis" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_jenis" for="x_produk_jenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_jenis->caption() ?><?= $Page->produk_jenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_jenis->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_jenis">
<input type="<?= $Page->produk_jenis->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_jenis" name="x_produk_jenis" id="x_produk_jenis" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->produk_jenis->getPlaceHolder()) ?>" value="<?= $Page->produk_jenis->EditValue ?>"<?= $Page->produk_jenis->editAttributes() ?> aria-describedby="x_produk_jenis_help">
<?= $Page->produk_jenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_jenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_desc->Visible) { // produk_desc ?>
    <div id="r_produk_desc" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_desc" for="x_produk_desc" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_desc->caption() ?><?= $Page->produk_desc->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_desc->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_desc">
<textarea data-table="php_kurasi_perbaikan" data-field="x_produk_desc" name="x_produk_desc" id="x_produk_desc" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->produk_desc->getPlaceHolder()) ?>"<?= $Page->produk_desc->editAttributes() ?> aria-describedby="x_produk_desc_help"><?= $Page->produk_desc->EditValue ?></textarea>
<?= $Page->produk_desc->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_desc->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_harga->Visible) { // produk_harga ?>
    <div id="r_produk_harga" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_harga" for="x_produk_harga" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_harga->caption() ?><?= $Page->produk_harga->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_harga->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_harga">
<input type="<?= $Page->produk_harga->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_harga" name="x_produk_harga" id="x_produk_harga" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->produk_harga->getPlaceHolder()) ?>" value="<?= $Page->produk_harga->EditValue ?>"<?= $Page->produk_harga->editAttributes() ?> aria-describedby="x_produk_harga_help">
<?= $Page->produk_harga->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_harga->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_foto->Visible) { // produk_foto ?>
    <div id="r_produk_foto" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_foto" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto->caption() ?><?= $Page->produk_foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_foto">
<div id="fd_x_produk_foto">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->produk_foto->title() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_foto" name="x_produk_foto" id="x_produk_foto" lang="<?= CurrentLanguageID() ?>"<?= $Page->produk_foto->editAttributes() ?><?= ($Page->produk_foto->ReadOnly || $Page->produk_foto->Disabled) ? " disabled" : "" ?> aria-describedby="x_produk_foto_help">
        <label class="custom-file-label ew-file-label" for="x_produk_foto"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->produk_foto->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_foto->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_produk_foto" id= "fn_x_produk_foto" value="<?= $Page->produk_foto->Upload->FileName ?>">
<input type="hidden" name="fa_x_produk_foto" id= "fa_x_produk_foto" value="<?= (Post("fa_x_produk_foto") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_produk_foto" id= "fs_x_produk_foto" value="50">
<input type="hidden" name="fx_x_produk_foto" id= "fx_x_produk_foto" value="<?= $Page->produk_foto->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_produk_foto" id= "fm_x_produk_foto" value="<?= $Page->produk_foto->UploadMaxFileSize ?>">
</div>
<table id="ft_x_produk_foto" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_berat->Visible) { // produk_berat ?>
    <div id="r_produk_berat" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_berat" for="x_produk_berat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_berat->caption() ?><?= $Page->produk_berat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_berat->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_berat">
<input type="<?= $Page->produk_berat->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_berat" name="x_produk_berat" id="x_produk_berat" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->produk_berat->getPlaceHolder()) ?>" value="<?= $Page->produk_berat->EditValue ?>"<?= $Page->produk_berat->editAttributes() ?> aria-describedby="x_produk_berat_help">
<?= $Page->produk_berat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_berat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_legal->Visible) { // produk_legal ?>
    <div id="r_produk_legal" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_legal" for="x_produk_legal" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_legal->caption() ?><?= $Page->produk_legal->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_legal->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_legal">
<input type="<?= $Page->produk_legal->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_legal" name="x_produk_legal" id="x_produk_legal" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->produk_legal->getPlaceHolder()) ?>" value="<?= $Page->produk_legal->EditValue ?>"<?= $Page->produk_legal->editAttributes() ?> aria-describedby="x_produk_legal_help">
<?= $Page->produk_legal->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_legal->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul_sesuai->Visible) { // judul_sesuai ?>
    <div id="r_judul_sesuai" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_judul_sesuai" for="x_judul_sesuai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul_sesuai->caption() ?><?= $Page->judul_sesuai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->judul_sesuai->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_judul_sesuai">
<input type="<?= $Page->judul_sesuai->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_judul_sesuai" name="x_judul_sesuai" id="x_judul_sesuai" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->judul_sesuai->getPlaceHolder()) ?>" value="<?= $Page->judul_sesuai->EditValue ?>"<?= $Page->judul_sesuai->editAttributes() ?> aria-describedby="x_judul_sesuai_help">
<?= $Page->judul_sesuai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul_sesuai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foto_bagus->Visible) { // foto_bagus ?>
    <div id="r_foto_bagus" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_foto_bagus" for="x_foto_bagus" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto_bagus->caption() ?><?= $Page->foto_bagus->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foto_bagus->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_foto_bagus">
<input type="<?= $Page->foto_bagus->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_foto_bagus" name="x_foto_bagus" id="x_foto_bagus" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->foto_bagus->getPlaceHolder()) ?>" value="<?= $Page->foto_bagus->EditValue ?>"<?= $Page->foto_bagus->editAttributes() ?> aria-describedby="x_foto_bagus_help">
<?= $Page->foto_bagus->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->foto_bagus->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->deskripsi_jelas->Visible) { // deskripsi_jelas ?>
    <div id="r_deskripsi_jelas" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_deskripsi_jelas" for="x_deskripsi_jelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->deskripsi_jelas->caption() ?><?= $Page->deskripsi_jelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->deskripsi_jelas->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_deskripsi_jelas">
<input type="<?= $Page->deskripsi_jelas->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_deskripsi_jelas" name="x_deskripsi_jelas" id="x_deskripsi_jelas" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->deskripsi_jelas->getPlaceHolder()) ?>" value="<?= $Page->deskripsi_jelas->EditValue ?>"<?= $Page->deskripsi_jelas->editAttributes() ?> aria-describedby="x_deskripsi_jelas_help">
<?= $Page->deskripsi_jelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->deskripsi_jelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->harga_tidak_kosong->Visible) { // harga_tidak_kosong ?>
    <div id="r_harga_tidak_kosong" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_harga_tidak_kosong" for="x_harga_tidak_kosong" class="<?= $Page->LeftColumnClass ?>"><?= $Page->harga_tidak_kosong->caption() ?><?= $Page->harga_tidak_kosong->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->harga_tidak_kosong->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_harga_tidak_kosong">
<input type="<?= $Page->harga_tidak_kosong->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_harga_tidak_kosong" name="x_harga_tidak_kosong" id="x_harga_tidak_kosong" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->harga_tidak_kosong->getPlaceHolder()) ?>" value="<?= $Page->harga_tidak_kosong->EditValue ?>"<?= $Page->harga_tidak_kosong->editAttributes() ?> aria-describedby="x_harga_tidak_kosong_help">
<?= $Page->harga_tidak_kosong->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->harga_tidak_kosong->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->berat_tidak_kosong->Visible) { // berat_tidak_kosong ?>
    <div id="r_berat_tidak_kosong" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_berat_tidak_kosong" for="x_berat_tidak_kosong" class="<?= $Page->LeftColumnClass ?>"><?= $Page->berat_tidak_kosong->caption() ?><?= $Page->berat_tidak_kosong->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->berat_tidak_kosong->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_berat_tidak_kosong">
<input type="<?= $Page->berat_tidak_kosong->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_berat_tidak_kosong" name="x_berat_tidak_kosong" id="x_berat_tidak_kosong" size="30" maxlength="1" placeholder="<?= HtmlEncode($Page->berat_tidak_kosong->getPlaceHolder()) ?>" value="<?= $Page->berat_tidak_kosong->EditValue ?>"<?= $Page->berat_tidak_kosong->editAttributes() ?> aria-describedby="x_berat_tidak_kosong_help">
<?= $Page->berat_tidak_kosong->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->berat_tidak_kosong->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kurasi->Visible) { // kurasi ?>
    <div id="r_kurasi" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_kurasi" for="x_kurasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kurasi->caption() ?><?= $Page->kurasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kurasi->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_kurasi">
<input type="<?= $Page->kurasi->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_kurasi" name="x_kurasi" id="x_kurasi" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kurasi->getPlaceHolder()) ?>" value="<?= $Page->kurasi->EditValue ?>"<?= $Page->kurasi->editAttributes() ?> aria-describedby="x_kurasi_help">
<?= $Page->kurasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kurasi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu_entry->Visible) { // waktu_entry ?>
    <div id="r_waktu_entry" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_waktu_entry" for="x_waktu_entry" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_entry->caption() ?><?= $Page->waktu_entry->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_entry->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_waktu_entry">
<input type="<?= $Page->waktu_entry->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_waktu_entry" name="x_waktu_entry" id="x_waktu_entry" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_entry->getPlaceHolder()) ?>" value="<?= $Page->waktu_entry->EditValue ?>"<?= $Page->waktu_entry->editAttributes() ?> aria-describedby="x_waktu_entry_help">
<?= $Page->waktu_entry->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_entry->getErrorMessage() ?></div>
<?php if (!$Page->waktu_entry->ReadOnly && !$Page->waktu_entry->Disabled && !isset($Page->waktu_entry->EditAttrs["readonly"]) && !isset($Page->waktu_entry->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fphp_kurasi_perbaikanedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fphp_kurasi_perbaikanedit", "x_waktu_entry", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu_kurasi->Visible) { // waktu_kurasi ?>
    <div id="r_waktu_kurasi" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_waktu_kurasi" for="x_waktu_kurasi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_kurasi->caption() ?><?= $Page->waktu_kurasi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_kurasi->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_waktu_kurasi">
<input type="<?= $Page->waktu_kurasi->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_waktu_kurasi" name="x_waktu_kurasi" id="x_waktu_kurasi" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_kurasi->getPlaceHolder()) ?>" value="<?= $Page->waktu_kurasi->EditValue ?>"<?= $Page->waktu_kurasi->editAttributes() ?> aria-describedby="x_waktu_kurasi_help">
<?= $Page->waktu_kurasi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_kurasi->getErrorMessage() ?></div>
<?php if (!$Page->waktu_kurasi->ReadOnly && !$Page->waktu_kurasi->Disabled && !isset($Page->waktu_kurasi->EditAttrs["readonly"]) && !isset($Page->waktu_kurasi->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fphp_kurasi_perbaikanedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fphp_kurasi_perbaikanedit", "x_waktu_kurasi", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->waktu_update->Visible) { // waktu_update ?>
    <div id="r_waktu_update" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_waktu_update" for="x_waktu_update" class="<?= $Page->LeftColumnClass ?>"><?= $Page->waktu_update->caption() ?><?= $Page->waktu_update->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->waktu_update->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_waktu_update">
<input type="<?= $Page->waktu_update->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_waktu_update" name="x_waktu_update" id="x_waktu_update" maxlength="19" placeholder="<?= HtmlEncode($Page->waktu_update->getPlaceHolder()) ?>" value="<?= $Page->waktu_update->EditValue ?>"<?= $Page->waktu_update->editAttributes() ?> aria-describedby="x_waktu_update_help">
<?= $Page->waktu_update->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->waktu_update->getErrorMessage() ?></div>
<?php if (!$Page->waktu_update->ReadOnly && !$Page->waktu_update->Disabled && !isset($Page->waktu_update->EditAttrs["readonly"]) && !isset($Page->waktu_update->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fphp_kurasi_perbaikanedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fphp_kurasi_perbaikanedit", "x_waktu_update", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->editor->Visible) { // editor ?>
    <div id="r_editor" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_editor" for="x_editor" class="<?= $Page->LeftColumnClass ?>"><?= $Page->editor->caption() ?><?= $Page->editor->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->editor->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_editor">
<input type="<?= $Page->editor->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_editor" name="x_editor" id="x_editor" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->editor->getPlaceHolder()) ?>" value="<?= $Page->editor->EditValue ?>"<?= $Page->editor->editAttributes() ?> aria-describedby="x_editor_help">
<?= $Page->editor->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->editor->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kurator->Visible) { // kurator ?>
    <div id="r_kurator" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_kurator" for="x_kurator" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kurator->caption() ?><?= $Page->kurator->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kurator->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_kurator">
<input type="<?= $Page->kurator->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_kurator" name="x_kurator" id="x_kurator" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->kurator->getPlaceHolder()) ?>" value="<?= $Page->kurator->EditValue ?>"<?= $Page->kurator->editAttributes() ?> aria-describedby="x_kurator_help">
<?= $Page->kurator->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kurator->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_panjang->Visible) { // produk_panjang ?>
    <div id="r_produk_panjang" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_panjang" for="x_produk_panjang" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_panjang->caption() ?><?= $Page->produk_panjang->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_panjang->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_panjang">
<input type="<?= $Page->produk_panjang->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_panjang" name="x_produk_panjang" id="x_produk_panjang" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->produk_panjang->getPlaceHolder()) ?>" value="<?= $Page->produk_panjang->EditValue ?>"<?= $Page->produk_panjang->editAttributes() ?> aria-describedby="x_produk_panjang_help">
<?= $Page->produk_panjang->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_panjang->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_lebar->Visible) { // produk_lebar ?>
    <div id="r_produk_lebar" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_lebar" for="x_produk_lebar" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_lebar->caption() ?><?= $Page->produk_lebar->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_lebar->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_lebar">
<input type="<?= $Page->produk_lebar->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_lebar" name="x_produk_lebar" id="x_produk_lebar" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->produk_lebar->getPlaceHolder()) ?>" value="<?= $Page->produk_lebar->EditValue ?>"<?= $Page->produk_lebar->editAttributes() ?> aria-describedby="x_produk_lebar_help">
<?= $Page->produk_lebar->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_lebar->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_tinggi->Visible) { // produk_tinggi ?>
    <div id="r_produk_tinggi" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_tinggi" for="x_produk_tinggi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_tinggi->caption() ?><?= $Page->produk_tinggi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_tinggi->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_tinggi">
<input type="<?= $Page->produk_tinggi->getInputTextType() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_tinggi" name="x_produk_tinggi" id="x_produk_tinggi" size="30" maxlength="12" placeholder="<?= HtmlEncode($Page->produk_tinggi->getPlaceHolder()) ?>" value="<?= $Page->produk_tinggi->EditValue ?>"<?= $Page->produk_tinggi->editAttributes() ?> aria-describedby="x_produk_tinggi_help">
<?= $Page->produk_tinggi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_tinggi->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_foto_1->Visible) { // produk_foto_1 ?>
    <div id="r_produk_foto_1" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_foto_1" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_1->caption() ?><?= $Page->produk_foto_1->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_1->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_foto_1">
<div id="fd_x_produk_foto_1">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->produk_foto_1->title() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_foto_1" name="x_produk_foto_1" id="x_produk_foto_1" lang="<?= CurrentLanguageID() ?>"<?= $Page->produk_foto_1->editAttributes() ?><?= ($Page->produk_foto_1->ReadOnly || $Page->produk_foto_1->Disabled) ? " disabled" : "" ?> aria-describedby="x_produk_foto_1_help">
        <label class="custom-file-label ew-file-label" for="x_produk_foto_1"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->produk_foto_1->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_foto_1->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_produk_foto_1" id= "fn_x_produk_foto_1" value="<?= $Page->produk_foto_1->Upload->FileName ?>">
<input type="hidden" name="fa_x_produk_foto_1" id= "fa_x_produk_foto_1" value="<?= (Post("fa_x_produk_foto_1") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_produk_foto_1" id= "fs_x_produk_foto_1" value="50">
<input type="hidden" name="fx_x_produk_foto_1" id= "fx_x_produk_foto_1" value="<?= $Page->produk_foto_1->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_produk_foto_1" id= "fm_x_produk_foto_1" value="<?= $Page->produk_foto_1->UploadMaxFileSize ?>">
</div>
<table id="ft_x_produk_foto_1" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_foto_2->Visible) { // produk_foto_2 ?>
    <div id="r_produk_foto_2" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_foto_2" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_2->caption() ?><?= $Page->produk_foto_2->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_2->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_foto_2">
<div id="fd_x_produk_foto_2">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->produk_foto_2->title() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_foto_2" name="x_produk_foto_2" id="x_produk_foto_2" lang="<?= CurrentLanguageID() ?>"<?= $Page->produk_foto_2->editAttributes() ?><?= ($Page->produk_foto_2->ReadOnly || $Page->produk_foto_2->Disabled) ? " disabled" : "" ?> aria-describedby="x_produk_foto_2_help">
        <label class="custom-file-label ew-file-label" for="x_produk_foto_2"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->produk_foto_2->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_foto_2->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_produk_foto_2" id= "fn_x_produk_foto_2" value="<?= $Page->produk_foto_2->Upload->FileName ?>">
<input type="hidden" name="fa_x_produk_foto_2" id= "fa_x_produk_foto_2" value="<?= (Post("fa_x_produk_foto_2") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_produk_foto_2" id= "fs_x_produk_foto_2" value="50">
<input type="hidden" name="fx_x_produk_foto_2" id= "fx_x_produk_foto_2" value="<?= $Page->produk_foto_2->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_produk_foto_2" id= "fm_x_produk_foto_2" value="<?= $Page->produk_foto_2->UploadMaxFileSize ?>">
</div>
<table id="ft_x_produk_foto_2" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->produk_foto_3->Visible) { // produk_foto_3 ?>
    <div id="r_produk_foto_3" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_produk_foto_3" class="<?= $Page->LeftColumnClass ?>"><?= $Page->produk_foto_3->caption() ?><?= $Page->produk_foto_3->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->produk_foto_3->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_produk_foto_3">
<div id="fd_x_produk_foto_3">
<div class="input-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input" title="<?= $Page->produk_foto_3->title() ?>" data-table="php_kurasi_perbaikan" data-field="x_produk_foto_3" name="x_produk_foto_3" id="x_produk_foto_3" lang="<?= CurrentLanguageID() ?>"<?= $Page->produk_foto_3->editAttributes() ?><?= ($Page->produk_foto_3->ReadOnly || $Page->produk_foto_3->Disabled) ? " disabled" : "" ?> aria-describedby="x_produk_foto_3_help">
        <label class="custom-file-label ew-file-label" for="x_produk_foto_3"><?= $Language->phrase("ChooseFile") ?></label>
    </div>
</div>
<?= $Page->produk_foto_3->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->produk_foto_3->getErrorMessage() ?></div>
<input type="hidden" name="fn_x_produk_foto_3" id= "fn_x_produk_foto_3" value="<?= $Page->produk_foto_3->Upload->FileName ?>">
<input type="hidden" name="fa_x_produk_foto_3" id= "fa_x_produk_foto_3" value="<?= (Post("fa_x_produk_foto_3") == "0") ? "0" : "1" ?>">
<input type="hidden" name="fs_x_produk_foto_3" id= "fs_x_produk_foto_3" value="50">
<input type="hidden" name="fx_x_produk_foto_3" id= "fx_x_produk_foto_3" value="<?= $Page->produk_foto_3->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_produk_foto_3" id= "fm_x_produk_foto_3" value="<?= $Page->produk_foto_3->UploadMaxFileSize ?>">
</div>
<table id="ft_x_produk_foto_3" class="table table-sm float-left ew-upload-table"><tbody class="files"></tbody></table>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->catatan->Visible) { // catatan ?>
    <div id="r_catatan" class="form-group row">
        <label id="elh_php_kurasi_perbaikan_catatan" for="x_catatan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->catatan->caption() ?><?= $Page->catatan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->catatan->cellAttributes() ?>>
<span id="el_php_kurasi_perbaikan_catatan">
<textarea data-table="php_kurasi_perbaikan" data-field="x_catatan" name="x_catatan" id="x_catatan" cols="3" rows="4" placeholder="<?= HtmlEncode($Page->catatan->getPlaceHolder()) ?>"<?= $Page->catatan->editAttributes() ?> aria-describedby="x_catatan_help"><?= $Page->catatan->EditValue ?></textarea>
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
    ew.addEventHandlers("php_kurasi_perbaikan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
