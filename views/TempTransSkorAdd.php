<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$TempTransSkorAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var ftemp_trans_skoradd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    ftemp_trans_skoradd = currentForm = new ew.Form("ftemp_trans_skoradd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "temp_trans_skor")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.temp_trans_skor)
        ew.vars.tables.temp_trans_skor = currentTable;
    ftemp_trans_skoradd.addFields([
        ["nik", [fields.nik.visible && fields.nik.required ? ew.Validators.required(fields.nik.caption) : null], fields.nik.isInvalid],
        ["jenis_nilai", [fields.jenis_nilai.visible && fields.jenis_nilai.required ? ew.Validators.required(fields.jenis_nilai.caption) : null], fields.jenis_nilai.isInvalid],
        ["nilai", [fields.nilai.visible && fields.nilai.required ? ew.Validators.required(fields.nilai.caption) : null, ew.Validators.float], fields.nilai.isInvalid],
        ["nilaimax", [fields.nilaimax.visible && fields.nilaimax.required ? ew.Validators.required(fields.nilaimax.caption) : null, ew.Validators.float], fields.nilaimax.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = ftemp_trans_skoradd,
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
    ftemp_trans_skoradd.validate = function () {
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
    ftemp_trans_skoradd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    ftemp_trans_skoradd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("ftemp_trans_skoradd");
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
<form name="ftemp_trans_skoradd" id="ftemp_trans_skoradd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="temp_trans_skor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->nik->Visible) { // nik ?>
    <div id="r_nik" class="form-group row">
        <label id="elh_temp_trans_skor_nik" for="x_nik" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nik->caption() ?><?= $Page->nik->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nik->cellAttributes() ?>>
<span id="el_temp_trans_skor_nik">
<input type="<?= $Page->nik->getInputTextType() ?>" data-table="temp_trans_skor" data-field="x_nik" name="x_nik" id="x_nik" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->nik->getPlaceHolder()) ?>" value="<?= $Page->nik->EditValue ?>"<?= $Page->nik->editAttributes() ?> aria-describedby="x_nik_help">
<?= $Page->nik->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nik->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->jenis_nilai->Visible) { // jenis_nilai ?>
    <div id="r_jenis_nilai" class="form-group row">
        <label id="elh_temp_trans_skor_jenis_nilai" for="x_jenis_nilai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->jenis_nilai->caption() ?><?= $Page->jenis_nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->jenis_nilai->cellAttributes() ?>>
<span id="el_temp_trans_skor_jenis_nilai">
<input type="<?= $Page->jenis_nilai->getInputTextType() ?>" data-table="temp_trans_skor" data-field="x_jenis_nilai" name="x_jenis_nilai" id="x_jenis_nilai" size="30" maxlength="21" placeholder="<?= HtmlEncode($Page->jenis_nilai->getPlaceHolder()) ?>" value="<?= $Page->jenis_nilai->EditValue ?>"<?= $Page->jenis_nilai->editAttributes() ?> aria-describedby="x_jenis_nilai_help">
<?= $Page->jenis_nilai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->jenis_nilai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilai->Visible) { // nilai ?>
    <div id="r_nilai" class="form-group row">
        <label id="elh_temp_trans_skor_nilai" for="x_nilai" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilai->caption() ?><?= $Page->nilai->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilai->cellAttributes() ?>>
<span id="el_temp_trans_skor_nilai">
<input type="<?= $Page->nilai->getInputTextType() ?>" data-table="temp_trans_skor" data-field="x_nilai" name="x_nilai" id="x_nilai" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->nilai->getPlaceHolder()) ?>" value="<?= $Page->nilai->EditValue ?>"<?= $Page->nilai->editAttributes() ?> aria-describedby="x_nilai_help">
<?= $Page->nilai->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilai->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nilaimax->Visible) { // nilaimax ?>
    <div id="r_nilaimax" class="form-group row">
        <label id="elh_temp_trans_skor_nilaimax" for="x_nilaimax" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nilaimax->caption() ?><?= $Page->nilaimax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nilaimax->cellAttributes() ?>>
<span id="el_temp_trans_skor_nilaimax">
<input type="<?= $Page->nilaimax->getInputTextType() ?>" data-table="temp_trans_skor" data-field="x_nilaimax" name="x_nilaimax" id="x_nilaimax" size="30" maxlength="23" placeholder="<?= HtmlEncode($Page->nilaimax->getPlaceHolder()) ?>" value="<?= $Page->nilaimax->EditValue ?>"<?= $Page->nilaimax->editAttributes() ?> aria-describedby="x_nilaimax_help">
<?= $Page->nilaimax->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nilaimax->getErrorMessage() ?></div>
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
    ew.addEventHandlers("temp_trans_skor");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
