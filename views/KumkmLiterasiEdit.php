<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmLiterasiEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkumkm_literasiedit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fkumkm_literasiedit = currentForm = new ew.Form("fkumkm_literasiedit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "kumkm_literasi")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.kumkm_literasi)
        ew.vars.tables.kumkm_literasi = currentTable;
    fkumkm_literasiedit.addFields([
        ["tgl", [fields.tgl.visible && fields.tgl.required ? ew.Validators.required(fields.tgl.caption) : null, ew.Validators.datetime(0)], fields.tgl.isInvalid],
        ["foto", [fields.foto.visible && fields.foto.required ? ew.Validators.required(fields.foto.caption) : null], fields.foto.isInvalid],
        ["idjenis", [fields.idjenis.visible && fields.idjenis.required ? ew.Validators.required(fields.idjenis.caption) : null], fields.idjenis.isInvalid],
        ["judul_artikel", [fields.judul_artikel.visible && fields.judul_artikel.required ? ew.Validators.required(fields.judul_artikel.caption) : null], fields.judul_artikel.isInvalid],
        ["kelas", [fields.kelas.visible && fields.kelas.required ? ew.Validators.required(fields.kelas.caption) : null], fields.kelas.isInvalid],
        ["isi_artikel", [fields.isi_artikel.visible && fields.isi_artikel.required ? ew.Validators.required(fields.isi_artikel.caption) : null], fields.isi_artikel.isInvalid],
        ["subjenis", [fields.subjenis.visible && fields.subjenis.required ? ew.Validators.required(fields.subjenis.caption) : null], fields.subjenis.isInvalid],
        ["urutan", [fields.urutan.visible && fields.urutan.required ? ew.Validators.required(fields.urutan.caption) : null, ew.Validators.integer], fields.urutan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fkumkm_literasiedit,
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
    fkumkm_literasiedit.validate = function () {
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
    fkumkm_literasiedit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fkumkm_literasiedit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fkumkm_literasiedit");
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
<form name="fkumkm_literasiedit" id="fkumkm_literasiedit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_literasi">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->tgl->Visible) { // tgl ?>
    <div id="r_tgl" class="form-group row">
        <label id="elh_kumkm_literasi_tgl" for="x_tgl" class="<?= $Page->LeftColumnClass ?>"><?= $Page->tgl->caption() ?><?= $Page->tgl->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->tgl->cellAttributes() ?>>
<span id="el_kumkm_literasi_tgl">
<input type="<?= $Page->tgl->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_tgl" name="x_tgl" id="x_tgl" maxlength="10" placeholder="<?= HtmlEncode($Page->tgl->getPlaceHolder()) ?>" value="<?= $Page->tgl->EditValue ?>"<?= $Page->tgl->editAttributes() ?> aria-describedby="x_tgl_help">
<?= $Page->tgl->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->tgl->getErrorMessage() ?></div>
<?php if (!$Page->tgl->ReadOnly && !$Page->tgl->Disabled && !isset($Page->tgl->EditAttrs["readonly"]) && !isset($Page->tgl->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["fkumkm_literasiedit", "datetimepicker"], function() {
    ew.createDateTimePicker("fkumkm_literasiedit", "x_tgl", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->foto->Visible) { // foto ?>
    <div id="r_foto" class="form-group row">
        <label id="elh_kumkm_literasi_foto" for="x_foto" class="<?= $Page->LeftColumnClass ?>"><?= $Page->foto->caption() ?><?= $Page->foto->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->foto->cellAttributes() ?>>
<span id="el_kumkm_literasi_foto">
<input type="<?= $Page->foto->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_foto" name="x_foto" id="x_foto" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->foto->getPlaceHolder()) ?>" value="<?= $Page->foto->EditValue ?>"<?= $Page->foto->editAttributes() ?> aria-describedby="x_foto_help">
<?= $Page->foto->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->foto->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->idjenis->Visible) { // idjenis ?>
    <div id="r_idjenis" class="form-group row">
        <label id="elh_kumkm_literasi_idjenis" for="x_idjenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->idjenis->caption() ?><?= $Page->idjenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->idjenis->cellAttributes() ?>>
<span id="el_kumkm_literasi_idjenis">
<input type="<?= $Page->idjenis->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_idjenis" name="x_idjenis" id="x_idjenis" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->idjenis->getPlaceHolder()) ?>" value="<?= $Page->idjenis->EditValue ?>"<?= $Page->idjenis->editAttributes() ?> aria-describedby="x_idjenis_help">
<?= $Page->idjenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->idjenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->judul_artikel->Visible) { // judul_artikel ?>
    <div id="r_judul_artikel" class="form-group row">
        <label id="elh_kumkm_literasi_judul_artikel" for="x_judul_artikel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->judul_artikel->caption() ?><?= $Page->judul_artikel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->judul_artikel->cellAttributes() ?>>
<span id="el_kumkm_literasi_judul_artikel">
<input type="<?= $Page->judul_artikel->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_judul_artikel" name="x_judul_artikel" id="x_judul_artikel" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->judul_artikel->getPlaceHolder()) ?>" value="<?= $Page->judul_artikel->EditValue ?>"<?= $Page->judul_artikel->editAttributes() ?> aria-describedby="x_judul_artikel_help">
<?= $Page->judul_artikel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->judul_artikel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
    <div id="r_kelas" class="form-group row">
        <label id="elh_kumkm_literasi_kelas" for="x_kelas" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kelas->caption() ?><?= $Page->kelas->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kelas->cellAttributes() ?>>
<span id="el_kumkm_literasi_kelas">
<input type="<?= $Page->kelas->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_kelas" name="x_kelas" id="x_kelas" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->kelas->getPlaceHolder()) ?>" value="<?= $Page->kelas->EditValue ?>"<?= $Page->kelas->editAttributes() ?> aria-describedby="x_kelas_help">
<?= $Page->kelas->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kelas->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->isi_artikel->Visible) { // isi_artikel ?>
    <div id="r_isi_artikel" class="form-group row">
        <label id="elh_kumkm_literasi_isi_artikel" for="x_isi_artikel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->isi_artikel->caption() ?><?= $Page->isi_artikel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->isi_artikel->cellAttributes() ?>>
<span id="el_kumkm_literasi_isi_artikel">
<textarea data-table="kumkm_literasi" data-field="x_isi_artikel" name="x_isi_artikel" id="x_isi_artikel" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->isi_artikel->getPlaceHolder()) ?>"<?= $Page->isi_artikel->editAttributes() ?> aria-describedby="x_isi_artikel_help"><?= $Page->isi_artikel->EditValue ?></textarea>
<?= $Page->isi_artikel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->isi_artikel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subjenis->Visible) { // subjenis ?>
    <div id="r_subjenis" class="form-group row">
        <label id="elh_kumkm_literasi_subjenis" for="x_subjenis" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subjenis->caption() ?><?= $Page->subjenis->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subjenis->cellAttributes() ?>>
<span id="el_kumkm_literasi_subjenis">
<input type="<?= $Page->subjenis->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_subjenis" name="x_subjenis" id="x_subjenis" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->subjenis->getPlaceHolder()) ?>" value="<?= $Page->subjenis->EditValue ?>"<?= $Page->subjenis->editAttributes() ?> aria-describedby="x_subjenis_help">
<?= $Page->subjenis->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subjenis->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->urutan->Visible) { // urutan ?>
    <div id="r_urutan" class="form-group row">
        <label id="elh_kumkm_literasi_urutan" for="x_urutan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->urutan->caption() ?><?= $Page->urutan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->urutan->cellAttributes() ?>>
<span id="el_kumkm_literasi_urutan">
<input type="<?= $Page->urutan->getInputTextType() ?>" data-table="kumkm_literasi" data-field="x_urutan" name="x_urutan" id="x_urutan" size="30" maxlength="6" placeholder="<?= HtmlEncode($Page->urutan->getPlaceHolder()) ?>" value="<?= $Page->urutan->EditValue ?>"<?= $Page->urutan->editAttributes() ?> aria-describedby="x_urutan_help">
<?= $Page->urutan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->urutan->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
    <input type="hidden" data-table="kumkm_literasi" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
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
    ew.addEventHandlers("kumkm_literasi");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
