<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$Register = &$Page;
?>
<script>
var currentForm, currentPageID;
var fregister;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "register";
    fregister = currentForm = new ew.Form("fregister", "register");

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_datadiri")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_datadiri)
        ew.vars.tables.umkm_datadiri = currentTable;
    fregister.addFields([
        ["NIK", [fields.NIK.visible && fields.NIK.required ? ew.Validators.required(fields.NIK.caption) : null, ew.Validators.username(fields.NIK.raw), ew.Validators.integer], fields.NIK.isInvalid],
        ["NAMA_PEMILIK", [fields.NAMA_PEMILIK.visible && fields.NAMA_PEMILIK.required ? ew.Validators.required(fields.NAMA_PEMILIK.caption) : null], fields.NAMA_PEMILIK.isInvalid],
        ["JENIS_KELAMIN", [fields.JENIS_KELAMIN.visible && fields.JENIS_KELAMIN.required ? ew.Validators.required(fields.JENIS_KELAMIN.caption) : null], fields.JENIS_KELAMIN.isInvalid],
        ["NO_HP", [fields.NO_HP.visible && fields.NO_HP.required ? ew.Validators.required(fields.NO_HP.caption) : null], fields.NO_HP.isInvalid],
        ["ALAMAT", [fields.ALAMAT.visible && fields.ALAMAT.required ? ew.Validators.required(fields.ALAMAT.caption) : null], fields.ALAMAT.isInvalid],
        ["c__PASSWORD", [ew.Validators.required(ew.language.phrase("ConfirmPassword")), ew.Validators.mismatchPassword], fields._PASSWORD.isInvalid],
        ["_PASSWORD", [fields._PASSWORD.visible && fields._PASSWORD.required ? ew.Validators.required(fields._PASSWORD.caption) : null, ew.Validators.passwordStrength, ew.Validators.password(fields._PASSWORD.raw)], fields._PASSWORD.isInvalid],
        ["_EMAIL", [fields._EMAIL.visible && fields._EMAIL.required ? ew.Validators.required(fields._EMAIL.caption) : null, ew.Validators.email], fields._EMAIL.isInvalid]
    ]);
    <?= Captcha()->getScript("fregister") ?>

    // Set invalid fields
    $(function() {
        var f = fregister,
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
    fregister.validate = function () {
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
        return true;
    }

    // Form_CustomValidate
    fregister.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fregister.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fregister.lists.JENIS_KELAMIN = <?= $Page->JENIS_KELAMIN->toClientList($Page) ?>;
    loadjs.done("fregister");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your client script here, no need to add script tags.
});
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fregister" id="fregister" class="<?= $Page->FormClassName ?>" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<input type="hidden" name="t" value="umkm_datadiri">
<?php if ($Page->isConfirm()) { // Confirm page ?>
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="confirm" id="confirm" value="confirm">
<?php } else { ?>
<input type="hidden" name="action" id="action" value="confirm">
<?php } ?>
<div class="ew-register-div"><!-- page* -->
<?php if ($Page->NIK->Visible) { // NIK ?>
    <div id="r_NIK" class="form-group row">
        <label id="elh_umkm_datadiri_NIK" for="x_NIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?><?= $Page->NIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri_NIK">
<input type="<?= $Page->NIK->getInputTextType() ?>" data-table="umkm_datadiri" data-field="x_NIK" name="x_NIK" id="x_NIK" size="30" maxlength="16" placeholder="<?= HtmlEncode($Page->NIK->getPlaceHolder()) ?>" value="<?= $Page->NIK->EditValue ?>"<?= $Page->NIK->editAttributes() ?> aria-describedby="x_NIK_help">
<?= $Page->NIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NIK->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NIK->getDisplayValue($Page->NIK->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x_NIK" data-hidden="1" name="x_NIK" id="x_NIK" value="<?= HtmlEncode($Page->NIK->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
    <div id="r_NAMA_PEMILIK" class="form-group row">
        <label id="elh_umkm_datadiri_NAMA_PEMILIK" for="x_NAMA_PEMILIK" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_PEMILIK->caption() ?><?= $Page->NAMA_PEMILIK->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_PEMILIK->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri_NAMA_PEMILIK">
<input type="<?= $Page->NAMA_PEMILIK->getInputTextType() ?>" data-table="umkm_datadiri" data-field="x_NAMA_PEMILIK" name="x_NAMA_PEMILIK" id="x_NAMA_PEMILIK" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_PEMILIK->getPlaceHolder()) ?>" value="<?= $Page->NAMA_PEMILIK->EditValue ?>"<?= $Page->NAMA_PEMILIK->editAttributes() ?> aria-describedby="x_NAMA_PEMILIK_help">
<?= $Page->NAMA_PEMILIK->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NAMA_PEMILIK->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri_NAMA_PEMILIK">
<span<?= $Page->NAMA_PEMILIK->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NAMA_PEMILIK->getDisplayValue($Page->NAMA_PEMILIK->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x_NAMA_PEMILIK" data-hidden="1" name="x_NAMA_PEMILIK" id="x_NAMA_PEMILIK" value="<?= HtmlEncode($Page->NAMA_PEMILIK->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
    <div id="r_JENIS_KELAMIN" class="form-group row">
        <label id="elh_umkm_datadiri_JENIS_KELAMIN" class="<?= $Page->LeftColumnClass ?>"><?= $Page->JENIS_KELAMIN->caption() ?><?= $Page->JENIS_KELAMIN->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->JENIS_KELAMIN->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri_JENIS_KELAMIN">
<template id="tp_x_JENIS_KELAMIN">
    <div class="custom-control custom-radio">
        <input type="radio" class="custom-control-input" data-table="umkm_datadiri" data-field="x_JENIS_KELAMIN" name="x_JENIS_KELAMIN" id="x_JENIS_KELAMIN"<?= $Page->JENIS_KELAMIN->editAttributes() ?>>
        <label class="custom-control-label"></label>
    </div>
</template>
<div id="dsl_x_JENIS_KELAMIN" class="ew-item-list"></div>
<input type="hidden"
    is="selection-list"
    id="x_JENIS_KELAMIN"
    name="x_JENIS_KELAMIN"
    value="<?= HtmlEncode($Page->JENIS_KELAMIN->CurrentValue) ?>"
    data-type="select-one"
    data-template="tp_x_JENIS_KELAMIN"
    data-target="dsl_x_JENIS_KELAMIN"
    data-repeatcolumn="5"
    class="form-control<?= $Page->JENIS_KELAMIN->isInvalidClass() ?>"
    data-table="umkm_datadiri"
    data-field="x_JENIS_KELAMIN"
    data-value-separator="<?= $Page->JENIS_KELAMIN->displayValueSeparatorAttribute() ?>"
    <?= $Page->JENIS_KELAMIN->editAttributes() ?>>
<?= $Page->JENIS_KELAMIN->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->JENIS_KELAMIN->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri_JENIS_KELAMIN">
<span<?= $Page->JENIS_KELAMIN->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->JENIS_KELAMIN->getDisplayValue($Page->JENIS_KELAMIN->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x_JENIS_KELAMIN" data-hidden="1" name="x_JENIS_KELAMIN" id="x_JENIS_KELAMIN" value="<?= HtmlEncode($Page->JENIS_KELAMIN->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->NO_HP->Visible) { // NO_HP ?>
    <div id="r_NO_HP" class="form-group row">
        <label id="elh_umkm_datadiri_NO_HP" for="x_NO_HP" class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_HP->caption() ?><?= $Page->NO_HP->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_HP->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri_NO_HP">
<input type="<?= $Page->NO_HP->getInputTextType() ?>" data-table="umkm_datadiri" data-field="x_NO_HP" name="x_NO_HP" id="x_NO_HP" size="30" maxlength="20" placeholder="<?= HtmlEncode($Page->NO_HP->getPlaceHolder()) ?>" value="<?= $Page->NO_HP->EditValue ?>"<?= $Page->NO_HP->editAttributes() ?> aria-describedby="x_NO_HP_help">
<?= $Page->NO_HP->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->NO_HP->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri_NO_HP">
<span<?= $Page->NO_HP->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->NO_HP->getDisplayValue($Page->NO_HP->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x_NO_HP" data-hidden="1" name="x_NO_HP" id="x_NO_HP" value="<?= HtmlEncode($Page->NO_HP->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
    <div id="r_ALAMAT" class="form-group row">
        <label id="elh_umkm_datadiri_ALAMAT" for="x_ALAMAT" class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?><?= $Page->ALAMAT->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri_ALAMAT">
<textarea data-table="umkm_datadiri" data-field="x_ALAMAT" name="x_ALAMAT" id="x_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?> aria-describedby="x_ALAMAT_help"><?= $Page->ALAMAT->EditValue ?></textarea>
<?= $Page->ALAMAT->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->ViewValue ?></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x_ALAMAT" data-hidden="1" name="x_ALAMAT" id="x_ALAMAT" value="<?= HtmlEncode($Page->ALAMAT->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
    <div id="r__PASSWORD" class="form-group row">
        <label id="elh_umkm_datadiri__PASSWORD" for="x__PASSWORD" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_PASSWORD->caption() ?><?= $Page->_PASSWORD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_PASSWORD->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri__PASSWORD">
<div class="input-group" id="ig__PASSWORD">
    <input type="password" autocomplete="new-password" data-password-strength="pst__PASSWORD" data-table="umkm_datadiri" data-field="x__PASSWORD" name="x__PASSWORD" id="x__PASSWORD" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_PASSWORD->getPlaceHolder()) ?>"<?= $Page->_PASSWORD->editAttributes() ?> aria-describedby="x__PASSWORD_help">
    <div class="input-group-append">
        <button type="button" class="btn btn-default ew-toggle-password" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button>
        <button type="button" class="btn btn-default ew-password-generator rounded-right" title="<?= HtmlTitle($Language->phrase("GeneratePassword")) ?>" data-password-field="x__PASSWORD" data-password-confirm="c__PASSWORD" data-password-strength="pst__PASSWORD"><?= $Language->phrase("GeneratePassword") ?></button>
    </div>
</div>
<div class="progress ew-password-strength-bar form-text mt-1 d-none" id="pst__PASSWORD">
    <div class="progress-bar" role="progressbar"></div>
</div>
<?= $Page->_PASSWORD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_PASSWORD->getErrorMessage() ?></div>
<br>
<small>
 <p>Pastikan Password Yang Disi Mudah dan Di Ingan Oleh User</p>
<ul>
	<li>Panjang Passwor Minimal 8 Karakter</li>
	<li>Password Minimal Mengandung Huruf Kapitalis A-Z</li>
	<li>Password Minimal Mengandung Huruf Kecil a-z</li>
	<li>Password Minimal Mengandung Angka 0-9</li>
	<li>Password Minimal Mengandung Karater ( #, !, @ ) dll </li>
</ul>
</small>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri__PASSWORD">
<span<?= $Page->_PASSWORD->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->_PASSWORD->getDisplayValue($Page->_PASSWORD->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x__PASSWORD" data-hidden="1" name="x__PASSWORD" id="x__PASSWORD" value="<?= HtmlEncode($Page->_PASSWORD->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_PASSWORD->Visible) { // PASSWORD ?>
    <div id="r_c__PASSWORD" class="form-group row">
        <label id="elh_c_umkm_datadiri__PASSWORD" for="c__PASSWORD" class="<?= $Page->LeftColumnClass ?>"><?= $Language->phrase("Confirm") ?> <?= $Page->_PASSWORD->caption() ?><?= $Page->_PASSWORD->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_PASSWORD->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_c_umkm_datadiri__PASSWORD">
<div class="input-group">
    <input type="password" name="c__PASSWORD" id="c__PASSWORD" autocomplete="new-password" data-field="x__PASSWORD" size="30" maxlength="255" placeholder="<?= HtmlEncode($Page->_PASSWORD->getPlaceHolder()) ?>"<?= $Page->_PASSWORD->editAttributes() ?> aria-describedby="x__PASSWORD_help">
    <div class="input-group-append"><button type="button" class="btn btn-default ew-toggle-password rounded-right" onclick="ew.togglePassword(event);"><i class="fas fa-eye"></i></button></div>
</div>
<?= $Page->_PASSWORD->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_PASSWORD->getErrorMessage() ?></div>
<br>
<small>
 <p>Pastikan Password Yang Disi Mudah dan Di Ingan Oleh User</p>
<ul>
	<li>Panjang Passwor Minimal 8 Karakter</li>
	<li>Password Minimal Mengandung Huruf Kapitalis A-Z</li>
	<li>Password Minimal Mengandung Huruf Kecil a-z</li>
	<li>Password Minimal Mengandung Angka 0-9</li>
	<li>Password Minimal Mengandung Karater ( #, !, @ ) dll </li>
</ul>
</small>
</span>
<?php } else { ?>
<span id="el_c_umkm_datadiri__PASSWORD">
<span<?= $Page->_PASSWORD->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->_PASSWORD->getDisplayValue($Page->_PASSWORD->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x__PASSWORD" data-hidden="1" name="c__PASSWORD" id="c__PASSWORD" value="<?= HtmlEncode($Page->_PASSWORD->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
<?php if ($Page->_EMAIL->Visible) { // EMAIL ?>
    <div id="r__EMAIL" class="form-group row">
        <label id="elh_umkm_datadiri__EMAIL" for="x__EMAIL" class="<?= $Page->LeftColumnClass ?>"><?= $Page->_EMAIL->caption() ?><?= $Page->_EMAIL->Required ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
        <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->_EMAIL->cellAttributes() ?>>
<?php if (!$Page->isConfirm()) { ?>
<span id="el_umkm_datadiri__EMAIL">
<input type="<?= $Page->_EMAIL->getInputTextType() ?>" data-table="umkm_datadiri" data-field="x__EMAIL" name="x__EMAIL" id="x__EMAIL" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->_EMAIL->getPlaceHolder()) ?>" value="<?= $Page->_EMAIL->EditValue ?>"<?= $Page->_EMAIL->editAttributes() ?> aria-describedby="x__EMAIL_help">
<?= $Page->_EMAIL->getCustomMessage() ?>
<div class="invalid-feedback"><?= $Page->_EMAIL->getErrorMessage() ?></div>
</span>
<?php } else { ?>
<span id="el_umkm_datadiri__EMAIL">
<span<?= $Page->_EMAIL->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?= HtmlEncode(RemoveHtml($Page->_EMAIL->getDisplayValue($Page->_EMAIL->ViewValue))) ?>"></span>
</span>
<input type="hidden" data-table="umkm_datadiri" data-field="x__EMAIL" data-hidden="1" name="x__EMAIL" id="x__EMAIL" value="<?= HtmlEncode($Page->_EMAIL->FormValue) ?>">
<?php } ?>
</div></div>
    </div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$Page->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
    <div class="<?= $Page->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if (!$Page->isConfirm()) { // Confirm page ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit" onclick="this.form.action.value='confirm';"><?= $Language->phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="submit" onclick="this.form.action.value='cancel';"><?= $Language->phrase("CancelBtn") ?></button>
<?php } ?>
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
    ew.addEventHandlers("umkm_datadiri");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your startup script here, no need to add script tags.
});
</script>
