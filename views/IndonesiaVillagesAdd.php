<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$IndonesiaVillagesAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var findonesia_villagesadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    findonesia_villagesadd = currentForm = new ew.Form("findonesia_villagesadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "indonesia_villages")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.indonesia_villages)
        ew.vars.tables.indonesia_villages = currentTable;
    findonesia_villagesadd.addFields([
        ["id", [fields.id.visible && fields.id.required ? ew.Validators.required(fields.id.caption) : null], fields.id.isInvalid],
        ["district_id", [fields.district_id.visible && fields.district_id.required ? ew.Validators.required(fields.district_id.caption) : null], fields.district_id.isInvalid],
        ["name", [fields.name.visible && fields.name.required ? ew.Validators.required(fields.name.caption) : null], fields.name.isInvalid],
        ["meta", [fields.meta.visible && fields.meta.required ? ew.Validators.required(fields.meta.caption) : null], fields.meta.isInvalid],
        ["created_at", [fields.created_at.visible && fields.created_at.required ? ew.Validators.required(fields.created_at.caption) : null, ew.Validators.datetime(0)], fields.created_at.isInvalid],
        ["updated_at", [fields.updated_at.visible && fields.updated_at.required ? ew.Validators.required(fields.updated_at.caption) : null, ew.Validators.datetime(0)], fields.updated_at.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = findonesia_villagesadd,
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
    findonesia_villagesadd.validate = function () {
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
    findonesia_villagesadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    findonesia_villagesadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    loadjs.done("findonesia_villagesadd");
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
<form name="findonesia_villagesadd" id="findonesia_villagesadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="indonesia_villages">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->id->Visible) { // id ?>
    <div id="r_id" class="form-group row">
        <label id="elh_indonesia_villages_id" for="x_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->id->caption() ?><?= $Page->id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->id->cellAttributes() ?>>
<span id="el_indonesia_villages_id">
<input type="<?= $Page->id->getInputTextType() ?>" data-table="indonesia_villages" data-field="x_id" name="x_id" id="x_id" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->id->getPlaceHolder()) ?>" value="<?= $Page->id->EditValue ?>"<?= $Page->id->editAttributes() ?> aria-describedby="x_id_help">
<?= $Page->id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->district_id->Visible) { // district_id ?>
    <div id="r_district_id" class="form-group row">
        <label id="elh_indonesia_villages_district_id" for="x_district_id" class="<?= $Page->LeftColumnClass ?>"><?= $Page->district_id->caption() ?><?= $Page->district_id->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->district_id->cellAttributes() ?>>
<span id="el_indonesia_villages_district_id">
<input type="<?= $Page->district_id->getInputTextType() ?>" data-table="indonesia_villages" data-field="x_district_id" name="x_district_id" id="x_district_id" size="30" maxlength="7" placeholder="<?= HtmlEncode($Page->district_id->getPlaceHolder()) ?>" value="<?= $Page->district_id->EditValue ?>"<?= $Page->district_id->editAttributes() ?> aria-describedby="x_district_id_help">
<?= $Page->district_id->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->district_id->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->name->Visible) { // name ?>
    <div id="r_name" class="form-group row">
        <label id="elh_indonesia_villages_name" for="x_name" class="<?= $Page->LeftColumnClass ?>"><?= $Page->name->caption() ?><?= $Page->name->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->name->cellAttributes() ?>>
<span id="el_indonesia_villages_name">
<input type="<?= $Page->name->getInputTextType() ?>" data-table="indonesia_villages" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->name->getPlaceHolder()) ?>" value="<?= $Page->name->EditValue ?>"<?= $Page->name->editAttributes() ?> aria-describedby="x_name_help">
<?= $Page->name->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->name->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->meta->Visible) { // meta ?>
    <div id="r_meta" class="form-group row">
        <label id="elh_indonesia_villages_meta" for="x_meta" class="<?= $Page->LeftColumnClass ?>"><?= $Page->meta->caption() ?><?= $Page->meta->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->meta->cellAttributes() ?>>
<span id="el_indonesia_villages_meta">
<textarea data-table="indonesia_villages" data-field="x_meta" name="x_meta" id="x_meta" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->meta->getPlaceHolder()) ?>"<?= $Page->meta->editAttributes() ?> aria-describedby="x_meta_help"><?= $Page->meta->EditValue ?></textarea>
<?= $Page->meta->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->meta->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->created_at->Visible) { // created_at ?>
    <div id="r_created_at" class="form-group row">
        <label id="elh_indonesia_villages_created_at" for="x_created_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->created_at->caption() ?><?= $Page->created_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->created_at->cellAttributes() ?>>
<span id="el_indonesia_villages_created_at">
<input type="<?= $Page->created_at->getInputTextType() ?>" data-table="indonesia_villages" data-field="x_created_at" name="x_created_at" id="x_created_at" maxlength="19" placeholder="<?= HtmlEncode($Page->created_at->getPlaceHolder()) ?>" value="<?= $Page->created_at->EditValue ?>"<?= $Page->created_at->editAttributes() ?> aria-describedby="x_created_at_help">
<?= $Page->created_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->created_at->getErrorMessage() ?></div>
<?php if (!$Page->created_at->ReadOnly && !$Page->created_at->Disabled && !isset($Page->created_at->EditAttrs["readonly"]) && !isset($Page->created_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["findonesia_villagesadd", "datetimepicker"], function() {
    ew.createDateTimePicker("findonesia_villagesadd", "x_created_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
});
</script>
<?php } ?>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->updated_at->Visible) { // updated_at ?>
    <div id="r_updated_at" class="form-group row">
        <label id="elh_indonesia_villages_updated_at" for="x_updated_at" class="<?= $Page->LeftColumnClass ?>"><?= $Page->updated_at->caption() ?><?= $Page->updated_at->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->updated_at->cellAttributes() ?>>
<span id="el_indonesia_villages_updated_at">
<input type="<?= $Page->updated_at->getInputTextType() ?>" data-table="indonesia_villages" data-field="x_updated_at" name="x_updated_at" id="x_updated_at" maxlength="19" placeholder="<?= HtmlEncode($Page->updated_at->getPlaceHolder()) ?>" value="<?= $Page->updated_at->EditValue ?>"<?= $Page->updated_at->editAttributes() ?> aria-describedby="x_updated_at_help">
<?= $Page->updated_at->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->updated_at->getErrorMessage() ?></div>
<?php if (!$Page->updated_at->ReadOnly && !$Page->updated_at->Disabled && !isset($Page->updated_at->EditAttrs["readonly"]) && !isset($Page->updated_at->EditAttrs["disabled"])) { ?>
<script>
loadjs.ready(["findonesia_villagesadd", "datetimepicker"], function() {
    ew.createDateTimePicker("findonesia_villagesadd", "x_updated_at", {"ignoreReadonly":true,"useCurrent":false,"format":0});
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
    ew.addEventHandlers("indonesia_villages");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
