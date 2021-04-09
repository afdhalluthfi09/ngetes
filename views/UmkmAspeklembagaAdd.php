<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeklembagaAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeklembagaadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspeklembagaadd = currentForm = new ew.Form("fumkm_aspeklembagaadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeklembaga")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeklembaga)
        ew.vars.tables.umkm_aspeklembaga = currentTable;
    fumkm_aspeklembagaadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["LB_BADANHUKUM", [fields.LB_BADANHUKUM.visible && fields.LB_BADANHUKUM.required ? ew.Validators.required(fields.LB_BADANHUKUM.caption) : null], fields.LB_BADANHUKUM.isInvalid],
        ["LB_IZINUSAHA", [fields.LB_IZINUSAHA.visible && fields.LB_IZINUSAHA.required ? ew.Validators.required(fields.LB_IZINUSAHA.caption) : null], fields.LB_IZINUSAHA.isInvalid],
        ["LB_NPWP", [fields.LB_NPWP.visible && fields.LB_NPWP.required ? ew.Validators.required(fields.LB_NPWP.caption) : null], fields.LB_NPWP.isInvalid],
        ["LB_SO", [fields.LB_SO.visible && fields.LB_SO.required ? ew.Validators.required(fields.LB_SO.caption) : null], fields.LB_SO.isInvalid],
        ["LB_JD", [fields.LB_JD.visible && fields.LB_JD.required ? ew.Validators.required(fields.LB_JD.caption) : null], fields.LB_JD.isInvalid],
        ["LB_ISO", [fields.LB_ISO.visible && fields.LB_ISO.required ? ew.Validators.required(fields.LB_ISO.caption) : null], fields.LB_ISO.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeklembagaadd,
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
    fumkm_aspeklembagaadd.validate = function () {
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
    fumkm_aspeklembagaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeklembagaadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspeklembagaadd.lists.LB_BADANHUKUM = <?= $Page->LB_BADANHUKUM->toClientList($Page) ?>;
    fumkm_aspeklembagaadd.lists.LB_IZINUSAHA = <?= $Page->LB_IZINUSAHA->toClientList($Page) ?>;
    fumkm_aspeklembagaadd.lists.LB_NPWP = <?= $Page->LB_NPWP->toClientList($Page) ?>;
    fumkm_aspeklembagaadd.lists.LB_SO = <?= $Page->LB_SO->toClientList($Page) ?>;
    fumkm_aspeklembagaadd.lists.LB_JD = <?= $Page->LB_JD->toClientList($Page) ?>;
    fumkm_aspeklembagaadd.lists.LB_ISO = <?= $Page->LB_ISO->toClientList($Page) ?>;
    loadjs.done("fumkm_aspeklembagaadd");
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
<form name="fumkm_aspeklembagaadd" id="fumkm_aspeklembagaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeklembaga">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->LB_BADANHUKUM->Visible) { // LB_BADANHUKUM ?>
    <div id="r_LB_BADANHUKUM" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_BADANHUKUM" for="x_LB_BADANHUKUM" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_BADANHUKUM->caption() ?><?= $Page->LB_BADANHUKUM->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_BADANHUKUM->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_BADANHUKUM">
    <select
        id="x_LB_BADANHUKUM"
        name="x_LB_BADANHUKUM"
        class="form-control ew-select<?= $Page->LB_BADANHUKUM->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_BADANHUKUM"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_BADANHUKUM"
        data-value-separator="<?= $Page->LB_BADANHUKUM->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_BADANHUKUM->getPlaceHolder()) ?>"
        <?= $Page->LB_BADANHUKUM->editAttributes() ?>>
        <?= $Page->LB_BADANHUKUM->selectOptionListHtml("x_LB_BADANHUKUM") ?>
    </select>
    <?= $Page->LB_BADANHUKUM->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_BADANHUKUM->getErrorMessage() ?></div>
<?= $Page->LB_BADANHUKUM->Lookup->getParamTag($Page, "p_x_LB_BADANHUKUM") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_BADANHUKUM']"),
        options = { name: "x_LB_BADANHUKUM", selectId: "umkm_aspeklembaga_x_LB_BADANHUKUM", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_BADANHUKUM.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_IZINUSAHA->Visible) { // LB_IZINUSAHA ?>
    <div id="r_LB_IZINUSAHA" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_IZINUSAHA" for="x_LB_IZINUSAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_IZINUSAHA->caption() ?><?= $Page->LB_IZINUSAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_IZINUSAHA->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_IZINUSAHA">
    <select
        id="x_LB_IZINUSAHA"
        name="x_LB_IZINUSAHA"
        class="form-control ew-select<?= $Page->LB_IZINUSAHA->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_IZINUSAHA"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_IZINUSAHA"
        data-value-separator="<?= $Page->LB_IZINUSAHA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_IZINUSAHA->getPlaceHolder()) ?>"
        <?= $Page->LB_IZINUSAHA->editAttributes() ?>>
        <?= $Page->LB_IZINUSAHA->selectOptionListHtml("x_LB_IZINUSAHA") ?>
    </select>
    <?= $Page->LB_IZINUSAHA->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_IZINUSAHA->getErrorMessage() ?></div>
<?= $Page->LB_IZINUSAHA->Lookup->getParamTag($Page, "p_x_LB_IZINUSAHA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_IZINUSAHA']"),
        options = { name: "x_LB_IZINUSAHA", selectId: "umkm_aspeklembaga_x_LB_IZINUSAHA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_IZINUSAHA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_NPWP->Visible) { // LB_NPWP ?>
    <div id="r_LB_NPWP" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_NPWP" for="x_LB_NPWP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_NPWP->caption() ?><?= $Page->LB_NPWP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_NPWP->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_NPWP">
    <select
        id="x_LB_NPWP"
        name="x_LB_NPWP"
        class="form-control ew-select<?= $Page->LB_NPWP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_NPWP"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_NPWP"
        data-value-separator="<?= $Page->LB_NPWP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_NPWP->getPlaceHolder()) ?>"
        <?= $Page->LB_NPWP->editAttributes() ?>>
        <?= $Page->LB_NPWP->selectOptionListHtml("x_LB_NPWP") ?>
    </select>
    <?= $Page->LB_NPWP->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_NPWP->getErrorMessage() ?></div>
<?= $Page->LB_NPWP->Lookup->getParamTag($Page, "p_x_LB_NPWP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_NPWP']"),
        options = { name: "x_LB_NPWP", selectId: "umkm_aspeklembaga_x_LB_NPWP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_NPWP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_SO->Visible) { // LB_SO ?>
    <div id="r_LB_SO" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_SO" for="x_LB_SO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_SO->caption() ?><?= $Page->LB_SO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_SO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_SO">
    <select
        id="x_LB_SO"
        name="x_LB_SO"
        class="form-control ew-select<?= $Page->LB_SO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_SO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_SO"
        data-value-separator="<?= $Page->LB_SO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_SO->getPlaceHolder()) ?>"
        <?= $Page->LB_SO->editAttributes() ?>>
        <?= $Page->LB_SO->selectOptionListHtml("x_LB_SO") ?>
    </select>
    <?= $Page->LB_SO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_SO->getErrorMessage() ?></div>
<?= $Page->LB_SO->Lookup->getParamTag($Page, "p_x_LB_SO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_SO']"),
        options = { name: "x_LB_SO", selectId: "umkm_aspeklembaga_x_LB_SO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_SO.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_JD->Visible) { // LB_JD ?>
    <div id="r_LB_JD" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_JD" for="x_LB_JD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_JD->caption() ?><?= $Page->LB_JD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_JD->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_JD">
    <select
        id="x_LB_JD"
        name="x_LB_JD"
        class="form-control ew-select<?= $Page->LB_JD->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_JD"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_JD"
        data-value-separator="<?= $Page->LB_JD->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_JD->getPlaceHolder()) ?>"
        <?= $Page->LB_JD->editAttributes() ?>>
        <?= $Page->LB_JD->selectOptionListHtml("x_LB_JD") ?>
    </select>
    <?= $Page->LB_JD->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_JD->getErrorMessage() ?></div>
<?= $Page->LB_JD->Lookup->getParamTag($Page, "p_x_LB_JD") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_JD']"),
        options = { name: "x_LB_JD", selectId: "umkm_aspeklembaga_x_LB_JD", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_JD.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->LB_ISO->Visible) { // LB_ISO ?>
    <div id="r_LB_ISO" class="form-group row">
        <label id="elh_umkm_aspeklembaga_LB_ISO" for="x_LB_ISO" class="<?= $Page->LeftColumnClass ?>"><?= $Page->LB_ISO->caption() ?><?= $Page->LB_ISO->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->LB_ISO->cellAttributes() ?>>
<span id="el_umkm_aspeklembaga_LB_ISO">
    <select
        id="x_LB_ISO"
        name="x_LB_ISO"
        class="form-control ew-select<?= $Page->LB_ISO->isInvalidClass() ?>"
        data-select2-id="umkm_aspeklembaga_x_LB_ISO"
        data-table="umkm_aspeklembaga"
        data-field="x_LB_ISO"
        data-value-separator="<?= $Page->LB_ISO->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->LB_ISO->getPlaceHolder()) ?>"
        <?= $Page->LB_ISO->editAttributes() ?>>
        <?= $Page->LB_ISO->selectOptionListHtml("x_LB_ISO") ?>
    </select>
    <?= $Page->LB_ISO->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->LB_ISO->getErrorMessage() ?></div>
<?= $Page->LB_ISO->Lookup->getParamTag($Page, "p_x_LB_ISO") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeklembaga_x_LB_ISO']"),
        options = { name: "x_LB_ISO", selectId: "umkm_aspeklembaga_x_LB_ISO", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeklembaga.fields.LB_ISO.selectOptions);
    ew.createSelect(options);
});
</script>
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
    ew.addEventHandlers("umkm_aspeklembaga");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
