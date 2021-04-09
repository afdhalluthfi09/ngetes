<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmAspeksdmAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_aspeksdmadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_aspeksdmadd = currentForm = new ew.Form("fumkm_aspeksdmadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_aspeksdm")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_aspeksdm)
        ew.vars.tables.umkm_aspeksdm = currentTable;
    fumkm_aspeksdmadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["SDM_OMS", [fields.SDM_OMS.visible && fields.SDM_OMS.required ? ew.Validators.required(fields.SDM_OMS.caption) : null], fields.SDM_OMS.isInvalid],
        ["SDM_FOKUS", [fields.SDM_FOKUS.visible && fields.SDM_FOKUS.required ? ew.Validators.required(fields.SDM_FOKUS.caption) : null], fields.SDM_FOKUS.isInvalid],
        ["SDM_TARGET", [fields.SDM_TARGET.visible && fields.SDM_TARGET.required ? ew.Validators.required(fields.SDM_TARGET.caption) : null], fields.SDM_TARGET.isInvalid],
        ["SDM_KARYAWANTETAP", [fields.SDM_KARYAWANTETAP.visible && fields.SDM_KARYAWANTETAP.required ? ew.Validators.required(fields.SDM_KARYAWANTETAP.caption) : null], fields.SDM_KARYAWANTETAP.isInvalid],
        ["SDM_KARYAWANSUBKON", [fields.SDM_KARYAWANSUBKON.visible && fields.SDM_KARYAWANSUBKON.required ? ew.Validators.required(fields.SDM_KARYAWANSUBKON.caption) : null], fields.SDM_KARYAWANSUBKON.isInvalid],
        ["SDM_GAJI", [fields.SDM_GAJI.visible && fields.SDM_GAJI.required ? ew.Validators.required(fields.SDM_GAJI.caption) : null], fields.SDM_GAJI.isInvalid],
        ["SDM_ASURANSI", [fields.SDM_ASURANSI.visible && fields.SDM_ASURANSI.required ? ew.Validators.required(fields.SDM_ASURANSI.caption) : null], fields.SDM_ASURANSI.isInvalid],
        ["SDM_TUNJANGAN", [fields.SDM_TUNJANGAN.visible && fields.SDM_TUNJANGAN.required ? ew.Validators.required(fields.SDM_TUNJANGAN.caption) : null], fields.SDM_TUNJANGAN.isInvalid],
        ["SDM_PELATIHAN", [fields.SDM_PELATIHAN.visible && fields.SDM_PELATIHAN.required ? ew.Validators.required(fields.SDM_PELATIHAN.caption) : null], fields.SDM_PELATIHAN.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_aspeksdmadd,
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
    fumkm_aspeksdmadd.validate = function () {
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
    fumkm_aspeksdmadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_aspeksdmadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_aspeksdmadd.lists.SDM_OMS = <?= $Page->SDM_OMS->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_FOKUS = <?= $Page->SDM_FOKUS->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_TARGET = <?= $Page->SDM_TARGET->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_KARYAWANTETAP = <?= $Page->SDM_KARYAWANTETAP->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_KARYAWANSUBKON = <?= $Page->SDM_KARYAWANSUBKON->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_GAJI = <?= $Page->SDM_GAJI->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_ASURANSI = <?= $Page->SDM_ASURANSI->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_TUNJANGAN = <?= $Page->SDM_TUNJANGAN->toClientList($Page) ?>;
    fumkm_aspeksdmadd.lists.SDM_PELATIHAN = <?= $Page->SDM_PELATIHAN->toClientList($Page) ?>;
    loadjs.done("fumkm_aspeksdmadd");
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
<form name="fumkm_aspeksdmadd" id="fumkm_aspeksdmadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_aspeksdm">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->SDM_OMS->Visible) { // SDM_OMS ?>
    <div id="r_SDM_OMS" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_OMS" for="x_SDM_OMS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_OMS->caption() ?><?= $Page->SDM_OMS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_OMS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_OMS">
    <select
        id="x_SDM_OMS"
        name="x_SDM_OMS"
        class="form-control ew-select<?= $Page->SDM_OMS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_OMS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_OMS"
        data-value-separator="<?= $Page->SDM_OMS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_OMS->getPlaceHolder()) ?>"
        <?= $Page->SDM_OMS->editAttributes() ?>>
        <?= $Page->SDM_OMS->selectOptionListHtml("x_SDM_OMS") ?>
    </select>
    <?= $Page->SDM_OMS->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_OMS->getErrorMessage() ?></div>
<?= $Page->SDM_OMS->Lookup->getParamTag($Page, "p_x_SDM_OMS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_OMS']"),
        options = { name: "x_SDM_OMS", selectId: "umkm_aspeksdm_x_SDM_OMS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_OMS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_FOKUS->Visible) { // SDM_FOKUS ?>
    <div id="r_SDM_FOKUS" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_FOKUS" for="x_SDM_FOKUS" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_FOKUS->caption() ?><?= $Page->SDM_FOKUS->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_FOKUS->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_FOKUS">
    <select
        id="x_SDM_FOKUS"
        name="x_SDM_FOKUS"
        class="form-control ew-select<?= $Page->SDM_FOKUS->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_FOKUS"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_FOKUS"
        data-value-separator="<?= $Page->SDM_FOKUS->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_FOKUS->getPlaceHolder()) ?>"
        <?= $Page->SDM_FOKUS->editAttributes() ?>>
        <?= $Page->SDM_FOKUS->selectOptionListHtml("x_SDM_FOKUS") ?>
    </select>
    <?= $Page->SDM_FOKUS->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_FOKUS->getErrorMessage() ?></div>
<?= $Page->SDM_FOKUS->Lookup->getParamTag($Page, "p_x_SDM_FOKUS") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_FOKUS']"),
        options = { name: "x_SDM_FOKUS", selectId: "umkm_aspeksdm_x_SDM_FOKUS", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_FOKUS.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_TARGET->Visible) { // SDM_TARGET ?>
    <div id="r_SDM_TARGET" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_TARGET" for="x_SDM_TARGET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TARGET->caption() ?><?= $Page->SDM_TARGET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TARGET->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_TARGET">
    <select
        id="x_SDM_TARGET"
        name="x_SDM_TARGET"
        class="form-control ew-select<?= $Page->SDM_TARGET->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_TARGET"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TARGET"
        data-value-separator="<?= $Page->SDM_TARGET->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TARGET->getPlaceHolder()) ?>"
        <?= $Page->SDM_TARGET->editAttributes() ?>>
        <?= $Page->SDM_TARGET->selectOptionListHtml("x_SDM_TARGET") ?>
    </select>
    <?= $Page->SDM_TARGET->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_TARGET->getErrorMessage() ?></div>
<?= $Page->SDM_TARGET->Lookup->getParamTag($Page, "p_x_SDM_TARGET") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_TARGET']"),
        options = { name: "x_SDM_TARGET", selectId: "umkm_aspeksdm_x_SDM_TARGET", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TARGET.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_KARYAWANTETAP->Visible) { // SDM_KARYAWANTETAP ?>
    <div id="r_SDM_KARYAWANTETAP" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_KARYAWANTETAP" for="x_SDM_KARYAWANTETAP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANTETAP->caption() ?><?= $Page->SDM_KARYAWANTETAP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANTETAP->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_KARYAWANTETAP">
    <select
        id="x_SDM_KARYAWANTETAP"
        name="x_SDM_KARYAWANTETAP"
        class="form-control ew-select<?= $Page->SDM_KARYAWANTETAP->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_KARYAWANTETAP"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANTETAP"
        data-value-separator="<?= $Page->SDM_KARYAWANTETAP->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANTETAP->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANTETAP->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANTETAP->selectOptionListHtml("x_SDM_KARYAWANTETAP") ?>
    </select>
    <?= $Page->SDM_KARYAWANTETAP->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANTETAP->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANTETAP->Lookup->getParamTag($Page, "p_x_SDM_KARYAWANTETAP") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_KARYAWANTETAP']"),
        options = { name: "x_SDM_KARYAWANTETAP", selectId: "umkm_aspeksdm_x_SDM_KARYAWANTETAP", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANTETAP.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_KARYAWANSUBKON->Visible) { // SDM_KARYAWANSUBKON ?>
    <div id="r_SDM_KARYAWANSUBKON" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_KARYAWANSUBKON" for="x_SDM_KARYAWANSUBKON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_KARYAWANSUBKON->caption() ?><?= $Page->SDM_KARYAWANSUBKON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_KARYAWANSUBKON->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_KARYAWANSUBKON">
    <select
        id="x_SDM_KARYAWANSUBKON"
        name="x_SDM_KARYAWANSUBKON"
        class="form-control ew-select<?= $Page->SDM_KARYAWANSUBKON->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_KARYAWANSUBKON"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_KARYAWANSUBKON"
        data-value-separator="<?= $Page->SDM_KARYAWANSUBKON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_KARYAWANSUBKON->getPlaceHolder()) ?>"
        <?= $Page->SDM_KARYAWANSUBKON->editAttributes() ?>>
        <?= $Page->SDM_KARYAWANSUBKON->selectOptionListHtml("x_SDM_KARYAWANSUBKON") ?>
    </select>
    <?= $Page->SDM_KARYAWANSUBKON->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_KARYAWANSUBKON->getErrorMessage() ?></div>
<?= $Page->SDM_KARYAWANSUBKON->Lookup->getParamTag($Page, "p_x_SDM_KARYAWANSUBKON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_KARYAWANSUBKON']"),
        options = { name: "x_SDM_KARYAWANSUBKON", selectId: "umkm_aspeksdm_x_SDM_KARYAWANSUBKON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_KARYAWANSUBKON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_GAJI->Visible) { // SDM_GAJI ?>
    <div id="r_SDM_GAJI" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_GAJI" for="x_SDM_GAJI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_GAJI->caption() ?><?= $Page->SDM_GAJI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_GAJI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_GAJI">
    <select
        id="x_SDM_GAJI"
        name="x_SDM_GAJI"
        class="form-control ew-select<?= $Page->SDM_GAJI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_GAJI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_GAJI"
        data-value-separator="<?= $Page->SDM_GAJI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_GAJI->getPlaceHolder()) ?>"
        <?= $Page->SDM_GAJI->editAttributes() ?>>
        <?= $Page->SDM_GAJI->selectOptionListHtml("x_SDM_GAJI") ?>
    </select>
    <?= $Page->SDM_GAJI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_GAJI->getErrorMessage() ?></div>
<?= $Page->SDM_GAJI->Lookup->getParamTag($Page, "p_x_SDM_GAJI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_GAJI']"),
        options = { name: "x_SDM_GAJI", selectId: "umkm_aspeksdm_x_SDM_GAJI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_GAJI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_ASURANSI->Visible) { // SDM_ASURANSI ?>
    <div id="r_SDM_ASURANSI" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_ASURANSI" for="x_SDM_ASURANSI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_ASURANSI->caption() ?><?= $Page->SDM_ASURANSI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_ASURANSI->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_ASURANSI">
    <select
        id="x_SDM_ASURANSI"
        name="x_SDM_ASURANSI"
        class="form-control ew-select<?= $Page->SDM_ASURANSI->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_ASURANSI"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_ASURANSI"
        data-value-separator="<?= $Page->SDM_ASURANSI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_ASURANSI->getPlaceHolder()) ?>"
        <?= $Page->SDM_ASURANSI->editAttributes() ?>>
        <?= $Page->SDM_ASURANSI->selectOptionListHtml("x_SDM_ASURANSI") ?>
    </select>
    <?= $Page->SDM_ASURANSI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_ASURANSI->getErrorMessage() ?></div>
<?= $Page->SDM_ASURANSI->Lookup->getParamTag($Page, "p_x_SDM_ASURANSI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_ASURANSI']"),
        options = { name: "x_SDM_ASURANSI", selectId: "umkm_aspeksdm_x_SDM_ASURANSI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_ASURANSI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_TUNJANGAN->Visible) { // SDM_TUNJANGAN ?>
    <div id="r_SDM_TUNJANGAN" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_TUNJANGAN" for="x_SDM_TUNJANGAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_TUNJANGAN->caption() ?><?= $Page->SDM_TUNJANGAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_TUNJANGAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_TUNJANGAN">
    <select
        id="x_SDM_TUNJANGAN"
        name="x_SDM_TUNJANGAN"
        class="form-control ew-select<?= $Page->SDM_TUNJANGAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_TUNJANGAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_TUNJANGAN"
        data-value-separator="<?= $Page->SDM_TUNJANGAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_TUNJANGAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_TUNJANGAN->editAttributes() ?>>
        <?= $Page->SDM_TUNJANGAN->selectOptionListHtml("x_SDM_TUNJANGAN") ?>
    </select>
    <?= $Page->SDM_TUNJANGAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_TUNJANGAN->getErrorMessage() ?></div>
<?= $Page->SDM_TUNJANGAN->Lookup->getParamTag($Page, "p_x_SDM_TUNJANGAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_TUNJANGAN']"),
        options = { name: "x_SDM_TUNJANGAN", selectId: "umkm_aspeksdm_x_SDM_TUNJANGAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_TUNJANGAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SDM_PELATIHAN->Visible) { // SDM_PELATIHAN ?>
    <div id="r_SDM_PELATIHAN" class="form-group row">
        <label id="elh_umkm_aspeksdm_SDM_PELATIHAN" for="x_SDM_PELATIHAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SDM_PELATIHAN->caption() ?><?= $Page->SDM_PELATIHAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SDM_PELATIHAN->cellAttributes() ?>>
<span id="el_umkm_aspeksdm_SDM_PELATIHAN">
    <select
        id="x_SDM_PELATIHAN"
        name="x_SDM_PELATIHAN"
        class="form-control ew-select<?= $Page->SDM_PELATIHAN->isInvalidClass() ?>"
        data-select2-id="umkm_aspeksdm_x_SDM_PELATIHAN"
        data-table="umkm_aspeksdm"
        data-field="x_SDM_PELATIHAN"
        data-value-separator="<?= $Page->SDM_PELATIHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SDM_PELATIHAN->getPlaceHolder()) ?>"
        <?= $Page->SDM_PELATIHAN->editAttributes() ?>>
        <?= $Page->SDM_PELATIHAN->selectOptionListHtml("x_SDM_PELATIHAN") ?>
    </select>
    <?= $Page->SDM_PELATIHAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SDM_PELATIHAN->getErrorMessage() ?></div>
<?= $Page->SDM_PELATIHAN->Lookup->getParamTag($Page, "p_x_SDM_PELATIHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_aspeksdm_x_SDM_PELATIHAN']"),
        options = { name: "x_SDM_PELATIHAN", selectId: "umkm_aspeksdm_x_SDM_PELATIHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_aspeksdm.fields.SDM_PELATIHAN.selectOptions);
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
    ew.addEventHandlers("umkm_aspeksdm");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
