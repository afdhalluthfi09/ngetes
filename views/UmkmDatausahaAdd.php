<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmDatausahaAdd = &$Page;
?>
<script>
var currentForm, currentPageID;
var fumkm_datausahaadd;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "add";
    fumkm_datausahaadd = currentForm = new ew.Form("fumkm_datausahaadd", "add");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_datausaha")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_datausaha)
        ew.vars.tables.umkm_datausaha = currentTable;
    fumkm_datausahaadd.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null], fields.NIK.isInvalid],
        ["NAMA_USAHA", [fields.NAMA_USAHA.visible && fields.NAMA_USAHA.required ? ew.Validators.required(fields.NAMA_USAHA.caption) : null], fields.NAMA_USAHA.isInvalid],
        ["TAHUN_MULAI_USAHA", [fields.TAHUN_MULAI_USAHA.visible && fields.TAHUN_MULAI_USAHA.required ? ew.Validators.required(fields.TAHUN_MULAI_USAHA.caption) : null], fields.TAHUN_MULAI_USAHA.isInvalid],
        ["NO_IZIN_USAHA", [fields.NO_IZIN_USAHA.visible && fields.NO_IZIN_USAHA.required ? ew.Validators.required(fields.NO_IZIN_USAHA.caption) : null], fields.NO_IZIN_USAHA.isInvalid],
        ["SEKTOR", [fields.SEKTOR.visible && fields.SEKTOR.required ? ew.Validators.required(fields.SEKTOR.caption) : null], fields.SEKTOR.isInvalid],
        ["SEKTOR_PERGUB", [fields.SEKTOR_PERGUB.visible && fields.SEKTOR_PERGUB.required ? ew.Validators.required(fields.SEKTOR_PERGUB.caption) : null], fields.SEKTOR_PERGUB.isInvalid],
        ["SEKTOR_KBLI", [fields.SEKTOR_KBLI.visible && fields.SEKTOR_KBLI.required ? ew.Validators.required(fields.SEKTOR_KBLI.caption) : null], fields.SEKTOR_KBLI.isInvalid],
        ["SEKTOR_EKRAF", [fields.SEKTOR_EKRAF.visible && fields.SEKTOR_EKRAF.required ? ew.Validators.required(fields.SEKTOR_EKRAF.caption) : null], fields.SEKTOR_EKRAF.isInvalid],
        ["KAPANEWON", [fields.KAPANEWON.visible && fields.KAPANEWON.required ? ew.Validators.required(fields.KAPANEWON.caption) : null], fields.KAPANEWON.isInvalid],
        ["KALURAHAN", [fields.KALURAHAN.visible && fields.KALURAHAN.required ? ew.Validators.required(fields.KALURAHAN.caption) : null], fields.KALURAHAN.isInvalid],
        ["DUSUN", [fields.DUSUN.visible && fields.DUSUN.required ? ew.Validators.required(fields.DUSUN.caption) : null], fields.DUSUN.isInvalid],
        ["ALAMAT", [fields.ALAMAT.visible && fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["TENAGA_KERJA_LAKILAKI", [fields.TENAGA_KERJA_LAKILAKI.visible && fields.TENAGA_KERJA_LAKILAKI.required ? ew.Validators.required(fields.TENAGA_KERJA_LAKILAKI.caption) : null, ew.Validators.integer], fields.TENAGA_KERJA_LAKILAKI.isInvalid],
        ["TENAGA_KERJA_PEREMPUAN", [fields.TENAGA_KERJA_PEREMPUAN.visible && fields.TENAGA_KERJA_PEREMPUAN.required ? ew.Validators.required(fields.TENAGA_KERJA_PEREMPUAN.caption) : null, ew.Validators.integer], fields.TENAGA_KERJA_PEREMPUAN.isInvalid],
        ["MODAL_KERJA", [fields.MODAL_KERJA.visible && fields.MODAL_KERJA.required ? ew.Validators.required(fields.MODAL_KERJA.caption) : null, ew.Validators.float], fields.MODAL_KERJA.isInvalid],
        ["OMZET_RATARATA_PERTAHUN", [fields.OMZET_RATARATA_PERTAHUN.visible && fields.OMZET_RATARATA_PERTAHUN.required ? ew.Validators.required(fields.OMZET_RATARATA_PERTAHUN.caption) : null, ew.Validators.float], fields.OMZET_RATARATA_PERTAHUN.isInvalid],
        ["STATUS_USAHA", [fields.STATUS_USAHA.visible && fields.STATUS_USAHA.required ? ew.Validators.required(fields.STATUS_USAHA.caption) : null], fields.STATUS_USAHA.isInvalid],
        ["ASET", [fields.ASET.visible && fields.ASET.required ? ew.Validators.required(fields.ASET.caption) : null, ew.Validators.float], fields.ASET.isInvalid]
    ]);

    // Set invalid fields
    $(function() {
        var f = fumkm_datausahaadd,
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
    fumkm_datausahaadd.validate = function () {
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
    fumkm_datausahaadd.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_datausahaadd.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_datausahaadd.lists.SEKTOR_PERGUB = <?= $Page->SEKTOR_PERGUB->toClientList($Page) ?>;
    fumkm_datausahaadd.lists.SEKTOR_KBLI = <?= $Page->SEKTOR_KBLI->toClientList($Page) ?>;
    fumkm_datausahaadd.lists.SEKTOR_EKRAF = <?= $Page->SEKTOR_EKRAF->toClientList($Page) ?>;
    fumkm_datausahaadd.lists.KAPANEWON = <?= $Page->KAPANEWON->toClientList($Page) ?>;
    fumkm_datausahaadd.lists.KALURAHAN = <?= $Page->KALURAHAN->toClientList($Page) ?>;
    loadjs.done("fumkm_datausahaadd");
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
<form name="fumkm_datausahaadd" id="fumkm_datausahaadd" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_datausaha">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php if ($Page->getCurrentMasterTable() == "umkm_datadiri") { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="umkm_datadiri">
<input type="hidden" name="fk_NIK" value="<?= HtmlEncode($Page->NIK->getSessionValue()) ?>">
<?php } ?>
<div class="ew-add-div"><!-- page* -->
<?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
    <div id="r_NAMA_USAHA" class="form-group row">
        <label id="elh_umkm_datausaha_NAMA_USAHA" for="x_NAMA_USAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_USAHA->caption() ?><?= $Page->NAMA_USAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<span id="el_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Page->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x_NAMA_USAHA" id="x_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NAMA_USAHA->EditValue ?>"<?= $Page->NAMA_USAHA->editAttributes() ?> aria-describedby="x_NAMA_USAHA_help">
<?= $Page->NAMA_USAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_USAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
    <div id="r_TAHUN_MULAI_USAHA" class="form-group row">
        <label id="elh_umkm_datausaha_TAHUN_MULAI_USAHA" for="x_TAHUN_MULAI_USAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TAHUN_MULAI_USAHA->caption() ?><?= $Page->TAHUN_MULAI_USAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TAHUN_MULAI_USAHA->cellAttributes() ?>>
<span id="el_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Page->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x_TAHUN_MULAI_USAHA" id="x_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Page->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Page->TAHUN_MULAI_USAHA->editAttributes() ?> aria-describedby="x_TAHUN_MULAI_USAHA_help">
<?= $Page->TAHUN_MULAI_USAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
    <div id="r_NO_IZIN_USAHA" class="form-group row">
        <label id="elh_umkm_datausaha_NO_IZIN_USAHA" for="x_NO_IZIN_USAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_IZIN_USAHA->caption() ?><?= $Page->NO_IZIN_USAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_IZIN_USAHA->cellAttributes() ?>>
<span id="el_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Page->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x_NO_IZIN_USAHA" id="x_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NO_IZIN_USAHA->EditValue ?>"<?= $Page->NO_IZIN_USAHA->editAttributes() ?> aria-describedby="x_NO_IZIN_USAHA_help">
<?= $Page->NO_IZIN_USAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SEKTOR->Visible) { // SEKTOR ?>
    <div id="r_SEKTOR" class="form-group row">
        <label id="elh_umkm_datausaha_SEKTOR" for="x_SEKTOR" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR->caption() ?><?= $Page->SEKTOR->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR->cellAttributes() ?>>
<span id="el_umkm_datausaha_SEKTOR">
<input type="<?= $Page->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x_SEKTOR" id="x_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SEKTOR->getPlaceHolder()) ?>" value="<?= $Page->SEKTOR->EditValue ?>"<?= $Page->SEKTOR->editAttributes() ?> aria-describedby="x_SEKTOR_help">
<?= $Page->SEKTOR->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->SEKTOR->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
    <div id="r_SEKTOR_PERGUB" class="form-group row">
        <label id="elh_umkm_datausaha_SEKTOR_PERGUB" for="x_SEKTOR_PERGUB" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_PERGUB->caption() ?><?= $Page->SEKTOR_PERGUB->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_PERGUB->cellAttributes() ?>>
<span id="el_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x_SEKTOR_PERGUB"
        name="x_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Page->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Page->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Page->SEKTOR_PERGUB->selectOptionListHtml("x_SEKTOR_PERGUB") ?>
    </select>
    <?= $Page->SEKTOR_PERGUB->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Page->SEKTOR_PERGUB->Lookup->getParamTag($Page, "p_x_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x_SEKTOR_PERGUB']"),
        options = { name: "x_SEKTOR_PERGUB", selectId: "umkm_datausaha_x_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
    <div id="r_SEKTOR_KBLI" class="form-group row">
        <label id="elh_umkm_datausaha_SEKTOR_KBLI" for="x_SEKTOR_KBLI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_KBLI->caption() ?><?= $Page->SEKTOR_KBLI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_KBLI->cellAttributes() ?>>
<span id="el_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x_SEKTOR_KBLI"
        name="x_SEKTOR_KBLI"
        class="form-control ew-select<?= $Page->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Page->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Page->SEKTOR_KBLI->selectOptionListHtml("x_SEKTOR_KBLI") ?>
    </select>
    <?= $Page->SEKTOR_KBLI->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Page->SEKTOR_KBLI->Lookup->getParamTag($Page, "p_x_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x_SEKTOR_KBLI']"),
        options = { name: "x_SEKTOR_KBLI", selectId: "umkm_datausaha_x_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
    <div id="r_SEKTOR_EKRAF" class="form-group row">
        <label id="elh_umkm_datausaha_SEKTOR_EKRAF" for="x_SEKTOR_EKRAF" class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_EKRAF->caption() ?><?= $Page->SEKTOR_EKRAF->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_EKRAF->cellAttributes() ?>>
<span id="el_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x_SEKTOR_EKRAF"
        name="x_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Page->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Page->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Page->SEKTOR_EKRAF->selectOptionListHtml("x_SEKTOR_EKRAF") ?>
    </select>
    <?= $Page->SEKTOR_EKRAF->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Page->SEKTOR_EKRAF->Lookup->getParamTag($Page, "p_x_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x_SEKTOR_EKRAF']"),
        options = { name: "x_SEKTOR_EKRAF", selectId: "umkm_datausaha_x_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
    <div id="r_KAPANEWON" class="form-group row">
        <label id="elh_umkm_datausaha_KAPANEWON" for="x_KAPANEWON" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAPANEWON->caption() ?><?= $Page->KAPANEWON->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAPANEWON->cellAttributes() ?>>
<span id="el_umkm_datausaha_KAPANEWON">
<?php $Page->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x_KAPANEWON"
        name="x_KAPANEWON"
        class="form-control ew-select<?= $Page->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Page->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Page->KAPANEWON->editAttributes() ?>>
        <?= $Page->KAPANEWON->selectOptionListHtml("x_KAPANEWON") ?>
    </select>
    <?= $Page->KAPANEWON->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KAPANEWON->getErrorMessage() ?></div>
<?= $Page->KAPANEWON->Lookup->getParamTag($Page, "p_x_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x_KAPANEWON']"),
        options = { name: "x_KAPANEWON", selectId: "umkm_datausaha_x_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
    <div id="r_KALURAHAN" class="form-group row">
        <label id="elh_umkm_datausaha_KALURAHAN" for="x_KALURAHAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->KALURAHAN->caption() ?><?= $Page->KALURAHAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KALURAHAN->cellAttributes() ?>>
<span id="el_umkm_datausaha_KALURAHAN">
    <select
        id="x_KALURAHAN"
        name="x_KALURAHAN"
        class="form-control ew-select<?= $Page->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Page->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Page->KALURAHAN->editAttributes() ?>>
        <?= $Page->KALURAHAN->selectOptionListHtml("x_KALURAHAN") ?>
    </select>
    <?= $Page->KALURAHAN->getCustomMessage() ?>
    <div class="invalid-feedback"><?= $Page->KALURAHAN->getErrorMessage() ?></div>
<?= $Page->KALURAHAN->Lookup->getParamTag($Page, "p_x_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x_KALURAHAN']"),
        options = { name: "x_KALURAHAN", selectId: "umkm_datausaha_x_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->DUSUN->Visible) { // DUSUN ?>
    <div id="r_DUSUN" class="form-group row">
        <label id="elh_umkm_datausaha_DUSUN" for="x_DUSUN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->DUSUN->caption() ?><?= $Page->DUSUN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DUSUN->cellAttributes() ?>>
<span id="el_umkm_datausaha_DUSUN">
<input type="<?= $Page->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x_DUSUN" id="x_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DUSUN->getPlaceHolder()) ?>" value="<?= $Page->DUSUN->EditValue ?>"<?= $Page->DUSUN->editAttributes() ?> aria-describedby="x_DUSUN_help">
<?= $Page->DUSUN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->DUSUN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_umkm_datausaha_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<span id="el_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
    <div id="r_TENAGA_KERJA_LAKILAKI" class="form-group row">
        <label id="elh_umkm_datausaha_TENAGA_KERJA_LAKILAKI" for="x_TENAGA_KERJA_LAKILAKI" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TENAGA_KERJA_LAKILAKI->caption() ?><?= $Page->TENAGA_KERJA_LAKILAKI->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TENAGA_KERJA_LAKILAKI->cellAttributes() ?>>
<span id="el_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Page->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x_TENAGA_KERJA_LAKILAKI" id="x_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Page->TENAGA_KERJA_LAKILAKI->editAttributes() ?> aria-describedby="x_TENAGA_KERJA_LAKILAKI_help">
<?= $Page->TENAGA_KERJA_LAKILAKI->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
    <div id="r_TENAGA_KERJA_PEREMPUAN" class="form-group row">
        <label id="elh_umkm_datausaha_TENAGA_KERJA_PEREMPUAN" for="x_TENAGA_KERJA_PEREMPUAN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->TENAGA_KERJA_PEREMPUAN->caption() ?><?= $Page->TENAGA_KERJA_PEREMPUAN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TENAGA_KERJA_PEREMPUAN->cellAttributes() ?>>
<span id="el_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Page->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x_TENAGA_KERJA_PEREMPUAN" id="x_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Page->TENAGA_KERJA_PEREMPUAN->editAttributes() ?> aria-describedby="x_TENAGA_KERJA_PEREMPUAN_help">
<?= $Page->TENAGA_KERJA_PEREMPUAN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
    <div id="r_MODAL_KERJA" class="form-group row">
        <label id="elh_umkm_datausaha_MODAL_KERJA" for="x_MODAL_KERJA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODAL_KERJA->caption() ?><?= $Page->MODAL_KERJA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODAL_KERJA->cellAttributes() ?>>
<span id="el_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Page->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x_MODAL_KERJA" id="x_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Page->MODAL_KERJA->EditValue ?>"<?= $Page->MODAL_KERJA->editAttributes() ?> aria-describedby="x_MODAL_KERJA_help">
<?= $Page->MODAL_KERJA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->MODAL_KERJA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
    <div id="r_OMZET_RATARATA_PERTAHUN" class="form-group row">
        <label id="elh_umkm_datausaha_OMZET_RATARATA_PERTAHUN" for="x_OMZET_RATARATA_PERTAHUN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->OMZET_RATARATA_PERTAHUN->caption() ?><?= $Page->OMZET_RATARATA_PERTAHUN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OMZET_RATARATA_PERTAHUN->cellAttributes() ?>>
<span id="el_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Page->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x_OMZET_RATARATA_PERTAHUN" id="x_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Page->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Page->OMZET_RATARATA_PERTAHUN->editAttributes() ?> aria-describedby="x_OMZET_RATARATA_PERTAHUN_help">
<?= $Page->OMZET_RATARATA_PERTAHUN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
    <div id="r_STATUS_USAHA" class="form-group row">
        <label id="elh_umkm_datausaha_STATUS_USAHA" for="x_STATUS_USAHA" class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_USAHA->caption() ?><?= $Page->STATUS_USAHA->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_USAHA->cellAttributes() ?>>
<span id="el_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Page->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x_STATUS_USAHA" id="x_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Page->STATUS_USAHA->EditValue ?>"<?= $Page->STATUS_USAHA->editAttributes() ?> aria-describedby="x_STATUS_USAHA_help">
<?= $Page->STATUS_USAHA->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->STATUS_USAHA->getErrorMessage() ?></div>
</span>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ASET->Visible) { // ASET ?>
    <div id="r_ASET" class="form-group row">
        <label id="elh_umkm_datausaha_ASET" for="x_ASET" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ASET->caption() ?><?= $Page->ASET->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ASET->cellAttributes() ?>>
<span id="el_umkm_datausaha_ASET">
<input type="<?= $Page->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x_ASET" id="x_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->ASET->getPlaceHolder()) ?>" value="<?= $Page->ASET->EditValue ?>"<?= $Page->ASET->editAttributes() ?> aria-describedby="x_ASET_help">
<?= $Page->ASET->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ASET->getErrorMessage() ?></div>
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
    ew.addEventHandlers("umkm_datausaha");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
