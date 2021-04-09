<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$BinaKelompokAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fbina_kelompokadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fbina_kelompokadd = currentForm = new ew.Form("fbina_kelompokadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "bina_kelompok")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.bina_kelompok)
        ew.vars.tables.bina_kelompok = currentTable;
    fbina_kelompokadd.addFields([
        ["kelompok_pembinaan", [fields.kelompok_pembinaan.visible && fields.kelompok_pembinaan.required ? ew.Validators.required(fields.kelompok_pembinaan.caption) : null], fields.kelompok_pembinaan.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fbina_kelompokadd,
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
    fbina_kelompokadd.validate = function () {
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
    fbina_kelompokadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fbina_kelompokadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("fbina_kelompokadd");
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
<form name="fbina_kelompokadd" id="fbina_kelompokadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="bina_kelompok">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->kelompok_pembinaan->Visible) { // kelompok_pembinaan ?>
    <div id="r_kelompok_pembinaan" class="form-group row">
        <label id="elh_bina_kelompok_kelompok_pembinaan" for="x_kelompok_pembinaan" class="<?= $Page->LeftColumnClass ?>"><?= $Page->kelompok_pembinaan->caption() ?><?= $Page->kelompok_pembinaan->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->kelompok_pembinaan->cellAttributes() ?>>
<span id="el_bina_kelompok_kelompok_pembinaan">
<input type="<?= $Page->kelompok_pembinaan->getInputTextType() ?>" data-table="bina_kelompok" data-field="x_kelompok_pembinaan" name="x_kelompok_pembinaan" id="x_kelompok_pembinaan" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->kelompok_pembinaan->getPlaceHolder()) ?>" value="<?= $Page->kelompok_pembinaan->EditValue ?>"<?= $Page->kelompok_pembinaan->editAttributes() ?> aria-describedby="x_kelompok_pembinaan_help">
<?= $Page->kelompok_pembinaan->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->kelompok_pembinaan->getErrorMessage() ?></div>
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
    ew.addEventHandlers("bina_kelompok");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
