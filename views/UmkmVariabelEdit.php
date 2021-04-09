<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmVariabelEdit = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_variabeledit;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "edit";
    fumkm_variabeledit = currentForm = new ew.Form("fumkm_variabeledit", "edit");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_variabel")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_variabel)
        ew.vars.tables.umkm_variabel = currentTable;
    fumkm_variabeledit.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["variabel", [fields.variabel.visible && fields.variabel.required ? ew.Validators.required(fields.variabel.caption) : null], fields.variabel.isInvalid],
        ["nmin", [fields.nmin.visible && fields.nmin.required ? ew.Validators.required(fields.nmin.caption) : null, ew.Validators.float], fields.nmin.isInvalid],
        ["nmax", [fields.nmax.visible && fields.nmax.required ? ew.Validators.required(fields.nmax.caption) : null, ew.Validators.float], fields.nmax.isInvalid],
        ["subkat", [fields.subkat.visible && fields.subkat.required ? ew.Validators.required(fields.subkat.caption) : null], fields.subkat.isInvalid],
        ["bobot", [fields.bobot.visible && fields.bobot.required ? ew.Validators.required(fields.bobot.caption) : null, ew.Validators.float], fields.bobot.isInvalid],
        ["kat", [fields.kat.visible && fields.kat.required ? ew.Validators.required(fields.kat.caption) : null], fields.kat.isInvalid],
        ["porsi", [fields.porsi.visible && fields.porsi.required ? ew.Validators.required(fields.porsi.caption) : null, ew.Validators.float], fields.porsi.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_variabeledit,
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
    fumkm_variabeledit.validate = function () {
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
    fumkm_variabeledit.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_variabeledit.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fumkm_variabeledit");
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
<form name="fumkm_variabeledit" id="fumkm_variabeledit" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_variabel">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_umkm_variabel_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_umkm_variabel_id">
<span<?= $Page->id->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->id->getDisplayValue($Page->id->EditValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_variabel" data-field="x_id" data-hidden="1" name="x_id" id="x_id" value="<?= HtmlEncode($Page->id->CurrentValue) ?>">
</div></div>
    </div>
<?php } ?>
<?php if ($Page->variabel->Visible) { // variabel ?>
    <div id="r_variabel" class="form-group row">
        <label id="elh_umkm_variabel_variabel" for="x_variabel" class="<?= $Page->LeftColumnClass ?>"><?= $Page->variabel->caption() ?><?= $Page->variabel->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->variabel->cellAttributes() ?>>
<span id="el_umkm_variabel_variabel">
<input type="<?= $Page->variabel->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_variabel" name="x_variabel" id="x_variabel" size="30" maxlength="200" placeholder="<?= HtmlEncode($Page->variabel->getPlaceHolder()) ?>" value="<?= $Page->variabel->EditValue ?>"<?= $Page->variabel->editAttributes() ?> aria-describedby="x_variabel_help">
<?= $Page->variabel->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->variabel->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nmin->Visible) { // nmin ?>
    <div id="r_nmin" class="form-group row">
        <label id="elh_umkm_variabel_nmin" for="x_nmin" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nmin->caption() ?><?= $Page->nmin->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nmin->cellAttributes() ?>>
<span id="el_umkm_variabel_nmin">
<input type="<?= $Page->nmin->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_nmin" name="x_nmin" id="x_nmin" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->nmin->getPlaceHolder()) ?>" value="<?= $Page->nmin->EditValue ?>"<?= $Page->nmin->editAttributes() ?> aria-describedby="x_nmin_help">
<?= $Page->nmin->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nmin->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->nmax->Visible) { // nmax ?>
    <div id="r_nmax" class="form-group row">
        <label id="elh_umkm_variabel_nmax" for="x_nmax" class="<?= $Page->LeftColumnClass ?>"><?= $Page->nmax->caption() ?><?= $Page->nmax->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->nmax->cellAttributes() ?>>
<span id="el_umkm_variabel_nmax">
<input type="<?= $Page->nmax->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_nmax" name="x_nmax" id="x_nmax" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->nmax->getPlaceHolder()) ?>" value="<?= $Page->nmax->EditValue ?>"<?= $Page->nmax->editAttributes() ?> aria-describedby="x_nmax_help">
<?= $Page->nmax->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->nmax->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->subkat->Visible) { // subkat ?>
    <div id="r_subkat" class="form-group row">
        <label id="elh_umkm_variabel_subkat" for="x_subkat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->subkat->caption() ?><?= $Page->subkat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->subkat->cellAttributes() ?>>
<span id="el_umkm_variabel_subkat">
<input type="<?= $Page->subkat->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_subkat" name="x_subkat" id="x_subkat" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->subkat->getPlaceHolder()) ?>" value="<?= $Page->subkat->EditValue ?>"<?= $Page->subkat->editAttributes() ?> aria-describedby="x_subkat_help">
<?= $Page->subkat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->subkat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->bobot->Visible) { // bobot ?>
    <div id="r_bobot" class="form-group row">
        <label id="elh_umkm_variabel_bobot" for="x_bobot" class="<?= $Page->LeftColumnClass ?>"><?= $Page->bobot->caption() ?><?= $Page->bobot->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->bobot->cellAttributes() ?>>
<span id="el_umkm_variabel_bobot">
<input type="<?= $Page->bobot->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_bobot" name="x_bobot" id="x_bobot" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->bobot->getPlaceHolder()) ?>" value="<?= $Page->bobot->EditValue ?>"<?= $Page->bobot->editAttributes() ?> aria-describedby="x_bobot_help">
<?= $Page->bobot->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->bobot->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->kat->Visible) { // kat ?>
    <div id="r_kat" class="form-group row">
        <label id="elh_umkm_variabel_kat" for="x_kat" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kat->caption() ?><?= $Page->kat->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kat->cellAttributes() ?>>
<span id="el_umkm_variabel_kat">
<input type="<?= $Page->kat->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_kat" name="x_kat" id="x_kat" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->kat->getPlaceHolder()) ?>" value="<?= $Page->kat->EditValue ?>"<?= $Page->kat->editAttributes() ?> aria-describedby="x_kat_help">
<?= $Page->kat->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kat->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->porsi->Visible) { // porsi ?>
    <div id="r_porsi" class="form-group row">
        <label id="elh_umkm_variabel_porsi" for="x_porsi" class="<?= $Page->LeftColumnClass ?>"><?= $Page->porsi->caption() ?><?= $Page->porsi->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->porsi->cellAttributes() ?>>
<span id="el_umkm_variabel_porsi">
<input type="<?= $Page->porsi->getInputTextType() ?>" data-table="umkm_variabel" data-field="x_porsi" name="x_porsi" id="x_porsi" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->porsi->getPlaceHolder()) ?>" value="<?= $Page->porsi->EditValue ?>"<?= $Page->porsi->editAttributes() ?> aria-describedby="x_porsi_help">
<?= $Page->porsi->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->porsi->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_variabel");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
