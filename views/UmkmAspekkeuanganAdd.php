<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspekkeuanganAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspekkeuanganadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspekkeuanganadd = currentForm = new ew.Form("fumkm_aspekkeuanganadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspekkeuangan")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspekkeuangan)
        ew.vars.tables.umkm_aspekkeuangan = currentTable;
    fumkm_aspekkeuanganadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["KEU_USAHAUTAMA", [fields.KEU_USAHAUTAMA.visible && fields.KEU_USAHAUTAMA.required ? ew.Validators.required(fields.KEU_USAHAUTAMA.caption) : null], fields.KEU_USAHAUTAMA.isInvalid],
        ["KEU_PENGELOLAAN", [fields.KEU_PENGELOLAAN.visible && fields.KEU_PENGELOLAAN.required ? ew.Validators.required(fields.KEU_PENGELOLAAN.caption) : null], fields.KEU_PENGELOLAAN.isInvalid],
        ["KEU_NOTA", [fields.KEU_NOTA.visible && fields.KEU_NOTA.required ? ew.Validators.required(fields.KEU_NOTA.caption) : null], fields.KEU_NOTA.isInvalid],
        ["KEU_PENCATATAN", [fields.KEU_PENCATATAN.visible && fields.KEU_PENCATATAN.required ? ew.Validators.required(fields.KEU_PENCATATAN.caption) : null], fields.KEU_PENCATATAN.isInvalid],
        ["KEU_LAPORAN", [fields.KEU_LAPORAN.visible && fields.KEU_LAPORAN.required ? ew.Validators.required(fields.KEU_LAPORAN.caption) : null], fields.KEU_LAPORAN.isInvalid],
        ["KEU_UTANGMODAL", [fields.KEU_UTANGMODAL.visible && fields.KEU_UTANGMODAL.required ? ew.Validators.required(fields.KEU_UTANGMODAL.caption) : null], fields.KEU_UTANGMODAL.isInvalid],
        ["KEU_CATATNASET", [fields.KEU_CATATNASET.visible && fields.KEU_CATATNASET.required ? ew.Validators.required(fields.KEU_CATATNASET.caption) : null], fields.KEU_CATATNASET.isInvalid],
        ["KEU_NONTUNAI", [fields.KEU_NONTUNAI.visible && fields.KEU_NONTUNAI.required ? ew.Validators.required(fields.KEU_NONTUNAI.caption) : null], fields.KEU_NONTUNAI.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspekkeuanganadd,
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
    fumkm_aspekkeuanganadd.validate = function () {
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
    fumkm_aspekkeuanganadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspekkeuanganadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspekkeuanganadd.lists.KEU_USAHAUTAMA = <?= $Page->KEU_USAHAUTAMA->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_PENGELOLAAN = <?= $Page->KEU_PENGELOLAAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_NOTA = <?= $Page->KEU_NOTA->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_PENCATATAN = <?= $Page->KEU_PENCATATAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_LAPORAN = <?= $Page->KEU_LAPORAN->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_UTANGMODAL = <?= $Page->KEU_UTANGMODAL->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_CATATNASET = <?= $Page->KEU_CATATNASET->toClientList($Page) ?>;
    fumkm_aspekkeuanganadd.lists.KEU_NONTUNAI = <?= $Page->KEU_NONTUNAI->toClientList($Page) ?>;
    loadjs.done("fumkm_aspekkeuanganadd");
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
<form name="fumkm_aspekkeuanganadd" id="fumkm_aspekkeuanganadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspekkeuangan">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "umkm_datadiri") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="umkm_datadiri">
<input type="hidden" name="fk_NIK" value="<?= HtmlEncode($Page->NIK->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->KEU_USAHAUTAMA->Visible) { // KEU_USAHAUTAMA ?>
    <div id="r_KEU_USAHAUTAMA" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_USAHAUTAMA" for="x_KEU_USAHAUTAMA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_USAHAUTAMA->caption() ?><?= $Page->KEU_USAHAUTAMA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_USAHAUTAMA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_USAHAUTAMA">
    <select
        id="x_KEU_USAHAUTAMA"
        name="x_KEU_USAHAUTAMA"
        class="form-control ew-select<?= $Page->KEU_USAHAUTAMA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_USAHAUTAMA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_USAHAUTAMA"
        data-value-separator="<?= $Page->KEU_USAHAUTAMA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_USAHAUTAMA->getPlaceHolder()) ?>"
        <?= $Page->KEU_USAHAUTAMA->editAttributes() ?>>
        <?= $Page->KEU_USAHAUTAMA->selectOptionListHtml("x_KEU_USAHAUTAMA") ?>
    </select>
    <?= $Page->KEU_USAHAUTAMA->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_USAHAUTAMA->getErrorMessage() ?></div>
<?= $Page->KEU_USAHAUTAMA->Lookup->getParamTag($Page, "p_x_KEU_USAHAUTAMA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_USAHAUTAMA']"),
        options = { name: "x_KEU_USAHAUTAMA", selectId: "umkm_aspekkeuangan_x_KEU_USAHAUTAMA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_USAHAUTAMA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_PENGELOLAAN->Visible) { // KEU_PENGELOLAAN ?>
    <div id="r_KEU_PENGELOLAAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_PENGELOLAAN" for="x_KEU_PENGELOLAAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENGELOLAAN->caption() ?><?= $Page->KEU_PENGELOLAAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENGELOLAAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_PENGELOLAAN">
    <select
        id="x_KEU_PENGELOLAAN"
        name="x_KEU_PENGELOLAAN"
        class="form-control ew-select<?= $Page->KEU_PENGELOLAAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_PENGELOLAAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENGELOLAAN"
        data-value-separator="<?= $Page->KEU_PENGELOLAAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENGELOLAAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENGELOLAAN->editAttributes() ?>>
        <?= $Page->KEU_PENGELOLAAN->selectOptionListHtml("x_KEU_PENGELOLAAN") ?>
    </select>
    <?= $Page->KEU_PENGELOLAAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_PENGELOLAAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENGELOLAAN->Lookup->getParamTag($Page, "p_x_KEU_PENGELOLAAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_PENGELOLAAN']"),
        options = { name: "x_KEU_PENGELOLAAN", selectId: "umkm_aspekkeuangan_x_KEU_PENGELOLAAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENGELOLAAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_NOTA->Visible) { // KEU_NOTA ?>
    <div id="r_KEU_NOTA" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_NOTA" for="x_KEU_NOTA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NOTA->caption() ?><?= $Page->KEU_NOTA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NOTA->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_NOTA">
    <select
        id="x_KEU_NOTA"
        name="x_KEU_NOTA"
        class="form-control ew-select<?= $Page->KEU_NOTA->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_NOTA"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NOTA"
        data-value-separator="<?= $Page->KEU_NOTA->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NOTA->getPlaceHolder()) ?>"
        <?= $Page->KEU_NOTA->editAttributes() ?>>
        <?= $Page->KEU_NOTA->selectOptionListHtml("x_KEU_NOTA") ?>
    </select>
    <?= $Page->KEU_NOTA->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_NOTA->getErrorMessage() ?></div>
<?= $Page->KEU_NOTA->Lookup->getParamTag($Page, "p_x_KEU_NOTA") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_NOTA']"),
        options = { name: "x_KEU_NOTA", selectId: "umkm_aspekkeuangan_x_KEU_NOTA", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NOTA.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_PENCATATAN->Visible) { // KEU_PENCATATAN ?>
    <div id="r_KEU_PENCATATAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_PENCATATAN" for="x_KEU_PENCATATAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_PENCATATAN->caption() ?><?= $Page->KEU_PENCATATAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_PENCATATAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_PENCATATAN">
    <select
        id="x_KEU_PENCATATAN"
        name="x_KEU_PENCATATAN"
        class="form-control ew-select<?= $Page->KEU_PENCATATAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_PENCATATAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_PENCATATAN"
        data-value-separator="<?= $Page->KEU_PENCATATAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_PENCATATAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_PENCATATAN->editAttributes() ?>>
        <?= $Page->KEU_PENCATATAN->selectOptionListHtml("x_KEU_PENCATATAN") ?>
    </select>
    <?= $Page->KEU_PENCATATAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_PENCATATAN->getErrorMessage() ?></div>
<?= $Page->KEU_PENCATATAN->Lookup->getParamTag($Page, "p_x_KEU_PENCATATAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_PENCATATAN']"),
        options = { name: "x_KEU_PENCATATAN", selectId: "umkm_aspekkeuangan_x_KEU_PENCATATAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_PENCATATAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_LAPORAN->Visible) { // KEU_LAPORAN ?>
    <div id="r_KEU_LAPORAN" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_LAPORAN" for="x_KEU_LAPORAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_LAPORAN->caption() ?><?= $Page->KEU_LAPORAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_LAPORAN->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_LAPORAN">
    <select
        id="x_KEU_LAPORAN"
        name="x_KEU_LAPORAN"
        class="form-control ew-select<?= $Page->KEU_LAPORAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_LAPORAN"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_LAPORAN"
        data-value-separator="<?= $Page->KEU_LAPORAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_LAPORAN->getPlaceHolder()) ?>"
        <?= $Page->KEU_LAPORAN->editAttributes() ?>>
        <?= $Page->KEU_LAPORAN->selectOptionListHtml("x_KEU_LAPORAN") ?>
    </select>
    <?= $Page->KEU_LAPORAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_LAPORAN->getErrorMessage() ?></div>
<?= $Page->KEU_LAPORAN->Lookup->getParamTag($Page, "p_x_KEU_LAPORAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_LAPORAN']"),
        options = { name: "x_KEU_LAPORAN", selectId: "umkm_aspekkeuangan_x_KEU_LAPORAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_LAPORAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_UTANGMODAL->Visible) { // KEU_UTANGMODAL ?>
    <div id="r_KEU_UTANGMODAL" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_UTANGMODAL" for="x_KEU_UTANGMODAL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_UTANGMODAL->caption() ?><?= $Page->KEU_UTANGMODAL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_UTANGMODAL->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_UTANGMODAL">
    <select
        id="x_KEU_UTANGMODAL"
        name="x_KEU_UTANGMODAL"
        class="form-control ew-select<?= $Page->KEU_UTANGMODAL->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_UTANGMODAL"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_UTANGMODAL"
        data-value-separator="<?= $Page->KEU_UTANGMODAL->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_UTANGMODAL->getPlaceHolder()) ?>"
        <?= $Page->KEU_UTANGMODAL->editAttributes() ?>>
        <?= $Page->KEU_UTANGMODAL->selectOptionListHtml("x_KEU_UTANGMODAL") ?>
    </select>
    <?= $Page->KEU_UTANGMODAL->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_UTANGMODAL->getErrorMessage() ?></div>
<?= $Page->KEU_UTANGMODAL->Lookup->getParamTag($Page, "p_x_KEU_UTANGMODAL") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_UTANGMODAL']"),
        options = { name: "x_KEU_UTANGMODAL", selectId: "umkm_aspekkeuangan_x_KEU_UTANGMODAL", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_UTANGMODAL.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_CATATNASET->Visible) { // KEU_CATATNASET ?>
    <div id="r_KEU_CATATNASET" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_CATATNASET" for="x_KEU_CATATNASET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_CATATNASET->caption() ?><?= $Page->KEU_CATATNASET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_CATATNASET->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_CATATNASET">
    <select
        id="x_KEU_CATATNASET"
        name="x_KEU_CATATNASET"
        class="form-control ew-select<?= $Page->KEU_CATATNASET->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_CATATNASET"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_CATATNASET"
        data-value-separator="<?= $Page->KEU_CATATNASET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_CATATNASET->getPlaceHolder()) ?>"
        <?= $Page->KEU_CATATNASET->editAttributes() ?>>
        <?= $Page->KEU_CATATNASET->selectOptionListHtml("x_KEU_CATATNASET") ?>
    </select>
    <?= $Page->KEU_CATATNASET->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_CATATNASET->getErrorMessage() ?></div>
<?= $Page->KEU_CATATNASET->Lookup->getParamTag($Page, "p_x_KEU_CATATNASET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_CATATNASET']"),
        options = { name: "x_KEU_CATATNASET", selectId: "umkm_aspekkeuangan_x_KEU_CATATNASET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_CATATNASET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KEU_NONTUNAI->Visible) { // KEU_NONTUNAI ?>
    <div id="r_KEU_NONTUNAI" class="form-group row">
        <label id="elh_umkm_aspekkeuangan_KEU_NONTUNAI" for="x_KEU_NONTUNAI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KEU_NONTUNAI->caption() ?><?= $Page->KEU_NONTUNAI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KEU_NONTUNAI->cellAttributes() ?>>
<span id="el_umkm_aspekkeuangan_KEU_NONTUNAI">
    <select
        id="x_KEU_NONTUNAI"
        name="x_KEU_NONTUNAI"
        class="form-control ew-select<?= $Page->KEU_NONTUNAI->isInvalidClass() ?>"
        data-select2-id="umkm_aspekkeuangan_x_KEU_NONTUNAI"
        data-table="umkm_aspekkeuangan"
        data-field="x_KEU_NONTUNAI"
        data-value-separator="<?= $Page->KEU_NONTUNAI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KEU_NONTUNAI->getPlaceHolder()) ?>"
        <?= $Page->KEU_NONTUNAI->editAttributes() ?>>
        <?= $Page->KEU_NONTUNAI->selectOptionListHtml("x_KEU_NONTUNAI") ?>
    </select>
    <?= $Page->KEU_NONTUNAI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KEU_NONTUNAI->getErrorMessage() ?></div>
<?= $Page->KEU_NONTUNAI->Lookup->getParamTag($Page, "p_x_KEU_NONTUNAI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspekkeuangan_x_KEU_NONTUNAI']"),
        options = { name: "x_KEU_NONTUNAI", selectId: "umkm_aspekkeuangan_x_KEU_NONTUNAI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspekkeuangan.fields.KEU_NONTUNAI.selectOptions);
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
    ew.addEventHandlers("umkm_aspekkeuangan");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
