<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$PeriodeDataAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fperiode_dataadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fperiode_dataadd = currentForm = new ew.Form("fperiode_dataadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "periode_data")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.periode_data)
        ew.vars.tables.periode_data = currentTable;
    fperiode_dataadd.addFields([
        ["periode_tahun", [fields.periode_tahun.visible && fields.periode_tahun.required ? ew.Validators.required(fields.periode_tahun.caption) : null, ew.Validators.integer], fields.periode_tahun.isInvalid],
        ["periode_bulan", [fields.periode_bulan.visible && fields.periode_bulan.required ? ew.Validators.required(fields.periode_bulan.caption) : null], fields.periode_bulan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fperiode_dataadd,
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
    fperiode_dataadd.validate = function () {
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
    fperiode_dataadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fperiode_dataadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fperiode_dataadd");
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
<form name="fperiode_dataadd" id="fperiode_dataadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="periode_data">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->periode_tahun->Visible) { // periode_tahun ?>
    <div id="r_periode_tahun" class="form-group row">
        <label id="elh_periode_data_periode_tahun" for="x_periode_tahun" class="<?= $Page->LeftColumnClass ?>"><?= $Page->periode_tahun->caption() ?><?= $Page->periode_tahun->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->periode_tahun->cellAttributes() ?>>
<span id="el_periode_data_periode_tahun">
<input type="<?= $Page->periode_tahun->getInputTextType() ?>" data-table="periode_data" data-field="x_periode_tahun" name="x_periode_tahun" id="x_periode_tahun" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->periode_tahun->getPlaceHolder()) ?>" value="<?= $Page->periode_tahun->EditValue ?>"<?= $Page->periode_tahun->editAttributes() ?> aria-describedby="x_periode_tahun_help">
<?= $Page->periode_tahun->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->periode_tahun->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->periode_bulan->Visible) { // periode_bulan ?>
    <div id="r_periode_bulan" class="form-group row">
        <label id="elh_periode_data_periode_bulan" for="x_periode_bulan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->periode_bulan->caption() ?><?= $Page->periode_bulan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->periode_bulan->cellAttributes() ?>>
<span id="el_periode_data_periode_bulan">
<input type="<?= $Page->periode_bulan->getInputTextType() ?>" data-table="periode_data" data-field="x_periode_bulan" name="x_periode_bulan" id="x_periode_bulan" size="30" maxlength="30" placeholder="<?= HtmlEncode($Page->periode_bulan->getPlaceHolder()) ?>" value="<?= $Page->periode_bulan->EditValue ?>"<?= $Page->periode_bulan->editAttributes() ?> aria-describedby="x_periode_bulan_help">
<?= $Page->periode_bulan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->periode_bulan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("periode_data");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
