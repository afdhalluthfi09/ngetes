<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$UmkmDatausahaList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fumkm_datausahalist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fumkm_datausahalist = currentForm = new ew.Form("fumkm_datausahalist", "list");
    fumkm_datausahalist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';

    // Add fields
    var currentTable = <?= JsonEncode(GetClientVar("tables", "umkm_datausaha")) ?>,
        fields = currentTable.fields;
    if (!ew.vars.tables.umkm_datausaha)
        ew.vars.tables.umkm_datausaha = currentTable;
    fumkm_datausahalist.addFields([
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
        var f = fumkm_datausahalist,
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
    fumkm_datausahalist.validate = function () {
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
    fumkm_datausahalist.customValidate = function(fobj) { // DO NOT CHANGE THIS LINE!
        // Your custom validation code here, return false if invalid.
        return true;
    }

    // Use JavaScript validation or not
    fumkm_datausahalist.validateRequired = <?= Config("CLIENT_VALIDATE") ? "true" : "false" ?>;

    // Dynamic selection lists
    fumkm_datausahalist.lists.SEKTOR_PERGUB = <?= $Page->SEKTOR_PERGUB->toClientList($Page) ?>;
    fumkm_datausahalist.lists.SEKTOR_KBLI = <?= $Page->SEKTOR_KBLI->toClientList($Page) ?>;
    fumkm_datausahalist.lists.SEKTOR_EKRAF = <?= $Page->SEKTOR_EKRAF->toClientList($Page) ?>;
    fumkm_datausahalist.lists.KAPANEWON = <?= $Page->KAPANEWON->toClientList($Page) ?>;
    fumkm_datausahalist.lists.KALURAHAN = <?= $Page->KALURAHAN->toClientList($Page) ?>;
    loadjs.done("fumkm_datausahalist");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($Page->TotalRecords > 0 && $Page->ExportOptions->visible()) { ?>
<?php $Page->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($Page->ImportOptions->visible()) { ?>
<?php $Page->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Page->isExport() || Config("EXPORT_MASTER_RECORD") && $Page->isExport("print")) { ?>
<?php
if ($Page->DbMasterFilter != "" && $Page->getCurrentMasterTable() == "umkm_datadiri") {
    if ($Page->MasterRecordExists) {
        include_once "views/UmkmDatadiriMaster.php";
    }
}
?>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="ew-multi-column-grid">
<form name="fumkm_datausahalist" id="fumkm_datausahalist" class="ew-horizontal ew-form ew-list-form ew-multi-column-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="umkm_datausaha">
<?php if ($Page->getCurrentMasterTable() == "umkm_datadiri" && $Page->CurrentAction) { ?>
<input type="hidden" name="<?= Config("TABLE_SHOW_MASTER") ?>" value="umkm_datadiri">
<input type="hidden" name="fk_NIK" value="<?= HtmlEncode($Page->NIK->getSessionValue()) ?>">
<?php } ?>
<div class="row ew-multi-column-row">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<?php
if ($Page->ExportAll && $Page->isExport()) {
    $Page->StopRecord = $Page->TotalRecords;
} else {
    // Set the last record to display
    if ($Page->TotalRecords > $Page->StartRecord + $Page->DisplayRecords - 1) {
        $Page->StopRecord = $Page->StartRecord + $Page->DisplayRecords - 1;
    } else {
        $Page->StopRecord = $Page->TotalRecords;
    }
}

// Restore number of post back records
if ($CurrentForm && ($Page->isConfirm() || $Page->EventCancelled)) {
    $CurrentForm->Index = -1;
    if ($CurrentForm->hasValue($Page->FormKeyCountName) && ($Page->isGridAdd() || $Page->isGridEdit() || $Page->isConfirm())) {
        $Page->KeyCount = $CurrentForm->getValue($Page->FormKeyCountName);
        $Page->StopRecord = $Page->StartRecord + $Page->KeyCount - 1;
    }
}
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}
$Page->EditRowCount = 0;
if ($Page->isEdit())
    $Page->RowIndex = 1;
while ($Page->RecordCount < $Page->StopRecord) {
    $Page->RecordCount++;
    if ($Page->RecordCount >= $Page->StartRecord) {
        $Page->RowCount++;

        // Set up key count
        $Page->KeyCount = $Page->RowIndex;

        // Init row class and style
        $Page->resetAttributes();
        $Page->CssClass = "";
        if ($Page->isGridAdd()) {
            $Page->loadRowValues(); // Load default values
            $Page->OldKey = "";
            $Page->setKey($Page->OldKey);
        } else {
            $Page->loadRowValues($Page->Recordset); // Load row values
            if ($Page->isGridEdit()) {
                $Page->OldKey = $Page->getKey(true); // Get from CurrentValue
                $Page->setKey($Page->OldKey);
            }
        }
        $Page->RowType = ROWTYPE_VIEW; // Render view
        if ($Page->isEdit()) {
            if ($Page->checkInlineEditKey() && $Page->EditRowCount == 0) { // Inline edit
                $Page->RowType = ROWTYPE_EDIT; // Render edit
            }
        }
        if ($Page->isEdit() && $Page->RowType == ROWTYPE_EDIT && $Page->EventCancelled) { // Update failed
            $CurrentForm->Index = 1;
            $Page->restoreFormValues(); // Restore form values
        }
        if ($Page->RowType == ROWTYPE_EDIT) { // Edit row
            $Page->EditRowCount++;
        }

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_umkm_datausaha", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
<div class="<?= $Page->getMultiColumnClass() ?>" <?= $Page->rowAttributes() ?>>
    <div class="card ew-card">
    <div class="card-body">
    <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
    <table class="table table-striped table-sm ew-view-table">
    <?php } ?>
    <?php if ($Page->NIK->Visible) { // NIK ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_NIK"><?= $Page->renderSort($Page->NIK) ?></span></td>
            <td <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_NIK">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NIK->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NIK->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NIK">
<span<?= $Page->NIK->viewAttributes() ?>>
<?= $Page->NIK->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->NAMA_USAHA->Visible) { // NAMA_USAHA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_NAMA_USAHA"><?= $Page->renderSort($Page->NAMA_USAHA) ?></span></td>
            <td <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Page->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x<?= $Page->RowIndex ?>_NAMA_USAHA" id="x<?= $Page->RowIndex ?>_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NAMA_USAHA->EditValue ?>"<?= $Page->NAMA_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NAMA_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_NAMA_USAHA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NAMA_USAHA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NAMA_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<input type="<?= $Page->NAMA_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NAMA_USAHA" name="x<?= $Page->RowIndex ?>_NAMA_USAHA" id="x<?= $Page->RowIndex ?>_NAMA_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NAMA_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NAMA_USAHA->EditValue ?>"<?= $Page->NAMA_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NAMA_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NAMA_USAHA">
<span<?= $Page->NAMA_USAHA->viewAttributes() ?>>
<?= $Page->NAMA_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->TAHUN_MULAI_USAHA->Visible) { // TAHUN_MULAI_USAHA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_TAHUN_MULAI_USAHA"><?= $Page->renderSort($Page->TAHUN_MULAI_USAHA) ?></span></td>
            <td <?= $Page->TAHUN_MULAI_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Page->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x<?= $Page->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Page->RowIndex ?>_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Page->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Page->TAHUN_MULAI_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<span<?= $Page->TAHUN_MULAI_USAHA->viewAttributes() ?>>
<?= $Page->TAHUN_MULAI_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_TAHUN_MULAI_USAHA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->TAHUN_MULAI_USAHA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TAHUN_MULAI_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<input type="<?= $Page->TAHUN_MULAI_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TAHUN_MULAI_USAHA" name="x<?= $Page->RowIndex ?>_TAHUN_MULAI_USAHA" id="x<?= $Page->RowIndex ?>_TAHUN_MULAI_USAHA" size="30" maxlength="10" placeholder="<?= HtmlEncode($Page->TAHUN_MULAI_USAHA->getPlaceHolder()) ?>" value="<?= $Page->TAHUN_MULAI_USAHA->EditValue ?>"<?= $Page->TAHUN_MULAI_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TAHUN_MULAI_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TAHUN_MULAI_USAHA">
<span<?= $Page->TAHUN_MULAI_USAHA->viewAttributes() ?>>
<?= $Page->TAHUN_MULAI_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->NO_IZIN_USAHA->Visible) { // NO_IZIN_USAHA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_NO_IZIN_USAHA"><?= $Page->renderSort($Page->NO_IZIN_USAHA) ?></span></td>
            <td <?= $Page->NO_IZIN_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Page->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x<?= $Page->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Page->RowIndex ?>_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NO_IZIN_USAHA->EditValue ?>"<?= $Page->NO_IZIN_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<span<?= $Page->NO_IZIN_USAHA->viewAttributes() ?>>
<?= $Page->NO_IZIN_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_NO_IZIN_USAHA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->NO_IZIN_USAHA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->NO_IZIN_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<input type="<?= $Page->NO_IZIN_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_NO_IZIN_USAHA" name="x<?= $Page->RowIndex ?>_NO_IZIN_USAHA" id="x<?= $Page->RowIndex ?>_NO_IZIN_USAHA" size="30" maxlength="100" placeholder="<?= HtmlEncode($Page->NO_IZIN_USAHA->getPlaceHolder()) ?>" value="<?= $Page->NO_IZIN_USAHA->EditValue ?>"<?= $Page->NO_IZIN_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->NO_IZIN_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_NO_IZIN_USAHA">
<span<?= $Page->NO_IZIN_USAHA->viewAttributes() ?>>
<?= $Page->NO_IZIN_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SEKTOR->Visible) { // SEKTOR ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_SEKTOR"><?= $Page->renderSort($Page->SEKTOR) ?></span></td>
            <td <?= $Page->SEKTOR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR">
<input type="<?= $Page->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x<?= $Page->RowIndex ?>_SEKTOR" id="x<?= $Page->RowIndex ?>_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SEKTOR->getPlaceHolder()) ?>" value="<?= $Page->SEKTOR->EditValue ?>"<?= $Page->SEKTOR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SEKTOR->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR">
<span<?= $Page->SEKTOR->viewAttributes() ?>>
<?= $Page->SEKTOR->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_SEKTOR">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR">
<input type="<?= $Page->SEKTOR->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_SEKTOR" name="x<?= $Page->RowIndex ?>_SEKTOR" id="x<?= $Page->RowIndex ?>_SEKTOR" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->SEKTOR->getPlaceHolder()) ?>" value="<?= $Page->SEKTOR->EditValue ?>"<?= $Page->SEKTOR->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->SEKTOR->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR">
<span<?= $Page->SEKTOR->viewAttributes() ?>>
<?= $Page->SEKTOR->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SEKTOR_PERGUB->Visible) { // SEKTOR_PERGUB ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_SEKTOR_PERGUB"><?= $Page->renderSort($Page->SEKTOR_PERGUB) ?></span></td>
            <td <?= $Page->SEKTOR_PERGUB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        name="x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Page->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Page->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Page->SEKTOR_PERGUB->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_PERGUB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Page->SEKTOR_PERGUB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_PERGUB", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
<span<?= $Page->SEKTOR_PERGUB->viewAttributes() ?>>
<?= $Page->SEKTOR_PERGUB->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_SEKTOR_PERGUB">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_PERGUB->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_PERGUB->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        name="x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        class="form-control ew-select<?= $Page->SEKTOR_PERGUB->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_PERGUB"
        data-value-separator="<?= $Page->SEKTOR_PERGUB->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_PERGUB->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_PERGUB->editAttributes() ?>>
        <?= $Page->SEKTOR_PERGUB->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_PERGUB") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_PERGUB->getErrorMessage() ?></div>
<?= $Page->SEKTOR_PERGUB->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_PERGUB") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_PERGUB", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_PERGUB", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_PERGUB.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_PERGUB">
<span<?= $Page->SEKTOR_PERGUB->viewAttributes() ?>>
<?= $Page->SEKTOR_PERGUB->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SEKTOR_KBLI->Visible) { // SEKTOR_KBLI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_SEKTOR_KBLI"><?= $Page->renderSort($Page->SEKTOR_KBLI) ?></span></td>
            <td <?= $Page->SEKTOR_KBLI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        name="x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        class="form-control ew-select<?= $Page->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Page->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Page->SEKTOR_KBLI->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_KBLI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Page->SEKTOR_KBLI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_KBLI", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
<span<?= $Page->SEKTOR_KBLI->viewAttributes() ?>>
<?= $Page->SEKTOR_KBLI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_SEKTOR_KBLI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_KBLI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_KBLI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        name="x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        class="form-control ew-select<?= $Page->SEKTOR_KBLI->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_KBLI"
        data-value-separator="<?= $Page->SEKTOR_KBLI->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_KBLI->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_KBLI->editAttributes() ?>>
        <?= $Page->SEKTOR_KBLI->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_KBLI") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_KBLI->getErrorMessage() ?></div>
<?= $Page->SEKTOR_KBLI->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_KBLI") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_KBLI", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_KBLI", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_KBLI.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_KBLI">
<span<?= $Page->SEKTOR_KBLI->viewAttributes() ?>>
<?= $Page->SEKTOR_KBLI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->SEKTOR_EKRAF->Visible) { // SEKTOR_EKRAF ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_SEKTOR_EKRAF"><?= $Page->renderSort($Page->SEKTOR_EKRAF) ?></span></td>
            <td <?= $Page->SEKTOR_EKRAF->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        name="x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Page->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Page->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Page->SEKTOR_EKRAF->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_EKRAF") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Page->SEKTOR_EKRAF->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_EKRAF", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
<span<?= $Page->SEKTOR_EKRAF->viewAttributes() ?>>
<?= $Page->SEKTOR_EKRAF->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_SEKTOR_EKRAF">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->SEKTOR_EKRAF->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->SEKTOR_EKRAF->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
    <select
        id="x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        name="x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        class="form-control ew-select<?= $Page->SEKTOR_EKRAF->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF"
        data-table="umkm_datausaha"
        data-field="x_SEKTOR_EKRAF"
        data-value-separator="<?= $Page->SEKTOR_EKRAF->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->SEKTOR_EKRAF->getPlaceHolder()) ?>"
        <?= $Page->SEKTOR_EKRAF->editAttributes() ?>>
        <?= $Page->SEKTOR_EKRAF->selectOptionListHtml("x{$Page->RowIndex}_SEKTOR_EKRAF") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->SEKTOR_EKRAF->getErrorMessage() ?></div>
<?= $Page->SEKTOR_EKRAF->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_SEKTOR_EKRAF") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF']"),
        options = { name: "x<?= $Page->RowIndex ?>_SEKTOR_EKRAF", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_SEKTOR_EKRAF", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.SEKTOR_EKRAF.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_SEKTOR_EKRAF">
<span<?= $Page->SEKTOR_EKRAF->viewAttributes() ?>>
<?= $Page->SEKTOR_EKRAF->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KAPANEWON->Visible) { // KAPANEWON ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_KAPANEWON"><?= $Page->renderSort($Page->KAPANEWON) ?></span></td>
            <td <?= $Page->KAPANEWON->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KAPANEWON">
<?php $Page->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Page->RowIndex ?>_KAPANEWON"
        name="x<?= $Page->RowIndex ?>_KAPANEWON"
        class="form-control ew-select<?= $Page->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Page->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Page->KAPANEWON->editAttributes() ?>>
        <?= $Page->KAPANEWON->selectOptionListHtml("x{$Page->RowIndex}_KAPANEWON") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KAPANEWON->getErrorMessage() ?></div>
<?= $Page->KAPANEWON->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON']"),
        options = { name: "x<?= $Page->RowIndex ?>_KAPANEWON", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_KAPANEWON">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KAPANEWON->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KAPANEWON->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KAPANEWON">
<?php $Page->KAPANEWON->EditAttrs->prepend("onchange", "ew.updateOptions.call(this);"); ?>
    <select
        id="x<?= $Page->RowIndex ?>_KAPANEWON"
        name="x<?= $Page->RowIndex ?>_KAPANEWON"
        class="form-control ew-select<?= $Page->KAPANEWON->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON"
        data-table="umkm_datausaha"
        data-field="x_KAPANEWON"
        data-value-separator="<?= $Page->KAPANEWON->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KAPANEWON->getPlaceHolder()) ?>"
        <?= $Page->KAPANEWON->editAttributes() ?>>
        <?= $Page->KAPANEWON->selectOptionListHtml("x{$Page->RowIndex}_KAPANEWON") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KAPANEWON->getErrorMessage() ?></div>
<?= $Page->KAPANEWON->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KAPANEWON") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON']"),
        options = { name: "x<?= $Page->RowIndex ?>_KAPANEWON", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_KAPANEWON", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KAPANEWON.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KAPANEWON">
<span<?= $Page->KAPANEWON->viewAttributes() ?>>
<?= $Page->KAPANEWON->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->KALURAHAN->Visible) { // KALURAHAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_KALURAHAN"><?= $Page->renderSort($Page->KALURAHAN) ?></span></td>
            <td <?= $Page->KALURAHAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KALURAHAN">
    <select
        id="x<?= $Page->RowIndex ?>_KALURAHAN"
        name="x<?= $Page->RowIndex ?>_KALURAHAN"
        class="form-control ew-select<?= $Page->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Page->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Page->KALURAHAN->editAttributes() ?>>
        <?= $Page->KALURAHAN->selectOptionListHtml("x{$Page->RowIndex}_KALURAHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KALURAHAN->getErrorMessage() ?></div>
<?= $Page->KALURAHAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KALURAHAN", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_KALURAHAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->KALURAHAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->KALURAHAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KALURAHAN">
    <select
        id="x<?= $Page->RowIndex ?>_KALURAHAN"
        name="x<?= $Page->RowIndex ?>_KALURAHAN"
        class="form-control ew-select<?= $Page->KALURAHAN->isInvalidClass() ?>"
        data-select2-id="umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN"
        data-table="umkm_datausaha"
        data-field="x_KALURAHAN"
        data-value-separator="<?= $Page->KALURAHAN->displayValueSeparatorAttribute() ?>"
        data-placeholder="<?= HtmlEncode($Page->KALURAHAN->getPlaceHolder()) ?>"
        <?= $Page->KALURAHAN->editAttributes() ?>>
        <?= $Page->KALURAHAN->selectOptionListHtml("x{$Page->RowIndex}_KALURAHAN") ?>
    </select>
    <div class="invalid-feedback"><?= $Page->KALURAHAN->getErrorMessage() ?></div>
<?= $Page->KALURAHAN->Lookup->getParamTag($Page, "p_x" . $Page->RowIndex . "_KALURAHAN") ?>
<script>
loadjs.ready("head", function() {
    var el = document.querySelector("select[data-select2-id='umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN']"),
        options = { name: "x<?= $Page->RowIndex ?>_KALURAHAN", selectId: "umkm_datausaha_x<?= $Page->RowIndex ?>_KALURAHAN", language: ew.LANGUAGE_ID, dir: ew.IS_RTL ? "rtl" : "ltr" };
    options.dropdownParent = $(el).closest("#ew-modal-dialog, #ew-add-opt-dialog")[0];
    Object.assign(options, ew.vars.tables.umkm_datausaha.fields.KALURAHAN.selectOptions);
    ew.createSelect(options);
});
</script>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_KALURAHAN">
<span<?= $Page->KALURAHAN->viewAttributes() ?>>
<?= $Page->KALURAHAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->DUSUN->Visible) { // DUSUN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_DUSUN"><?= $Page->renderSort($Page->DUSUN) ?></span></td>
            <td <?= $Page->DUSUN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_DUSUN">
<input type="<?= $Page->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x<?= $Page->RowIndex ?>_DUSUN" id="x<?= $Page->RowIndex ?>_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DUSUN->getPlaceHolder()) ?>" value="<?= $Page->DUSUN->EditValue ?>"<?= $Page->DUSUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DUSUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_DUSUN">
<span<?= $Page->DUSUN->viewAttributes() ?>>
<?= $Page->DUSUN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_DUSUN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->DUSUN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->DUSUN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_DUSUN">
<input type="<?= $Page->DUSUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_DUSUN" name="x<?= $Page->RowIndex ?>_DUSUN" id="x<?= $Page->RowIndex ?>_DUSUN" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->DUSUN->getPlaceHolder()) ?>" value="<?= $Page->DUSUN->EditValue ?>"<?= $Page->DUSUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->DUSUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_DUSUN">
<span<?= $Page->DUSUN->viewAttributes() ?>>
<?= $Page->DUSUN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ALAMAT->Visible) { // ALAMAT ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_ALAMAT"><?= $Page->renderSort($Page->ALAMAT) ?></span></td>
            <td <?= $Page->ALAMAT->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x<?= $Page->RowIndex ?>_ALAMAT" id="x<?= $Page->RowIndex ?>_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?>><?= $Page->ALAMAT->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_ALAMAT">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ALAMAT->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ALAMAT->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ALAMAT">
<textarea data-table="umkm_datausaha" data-field="x_ALAMAT" name="x<?= $Page->RowIndex ?>_ALAMAT" id="x<?= $Page->RowIndex ?>_ALAMAT" cols="35" rows="4" placeholder="<?= HtmlEncode($Page->ALAMAT->getPlaceHolder()) ?>"<?= $Page->ALAMAT->editAttributes() ?>><?= $Page->ALAMAT->EditValue ?></textarea>
<div class="invalid-feedback"><?= $Page->ALAMAT->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ALAMAT">
<span<?= $Page->ALAMAT->viewAttributes() ?>>
<?= $Page->ALAMAT->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->TENAGA_KERJA_LAKILAKI->Visible) { // TENAGA_KERJA_LAKI-LAKI ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_TENAGA_KERJA_LAKILAKI"><?= $Page->renderSort($Page->TENAGA_KERJA_LAKILAKI) ?></span></td>
            <td <?= $Page->TENAGA_KERJA_LAKILAKI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Page->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x<?= $Page->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Page->RowIndex ?>_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Page->TENAGA_KERJA_LAKILAKI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<span<?= $Page->TENAGA_KERJA_LAKILAKI->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_LAKILAKI->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_TENAGA_KERJA_LAKILAKI">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->TENAGA_KERJA_LAKILAKI->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TENAGA_KERJA_LAKILAKI->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<input type="<?= $Page->TENAGA_KERJA_LAKILAKI->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_LAKILAKI" name="x<?= $Page->RowIndex ?>_TENAGA_KERJA_LAKILAKI" id="x<?= $Page->RowIndex ?>_TENAGA_KERJA_LAKILAKI" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_LAKILAKI->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_LAKILAKI->EditValue ?>"<?= $Page->TENAGA_KERJA_LAKILAKI->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_LAKILAKI->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_LAKILAKI">
<span<?= $Page->TENAGA_KERJA_LAKILAKI->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_LAKILAKI->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->TENAGA_KERJA_PEREMPUAN->Visible) { // TENAGA_KERJA_PEREMPUAN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_TENAGA_KERJA_PEREMPUAN"><?= $Page->renderSort($Page->TENAGA_KERJA_PEREMPUAN) ?></span></td>
            <td <?= $Page->TENAGA_KERJA_PEREMPUAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Page->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x<?= $Page->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Page->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Page->TENAGA_KERJA_PEREMPUAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<span<?= $Page->TENAGA_KERJA_PEREMPUAN->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_PEREMPUAN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->TENAGA_KERJA_PEREMPUAN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->TENAGA_KERJA_PEREMPUAN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<input type="<?= $Page->TENAGA_KERJA_PEREMPUAN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_TENAGA_KERJA_PEREMPUAN" name="x<?= $Page->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" id="x<?= $Page->RowIndex ?>_TENAGA_KERJA_PEREMPUAN" size="30" maxlength="4" placeholder="<?= HtmlEncode($Page->TENAGA_KERJA_PEREMPUAN->getPlaceHolder()) ?>" value="<?= $Page->TENAGA_KERJA_PEREMPUAN->EditValue ?>"<?= $Page->TENAGA_KERJA_PEREMPUAN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->TENAGA_KERJA_PEREMPUAN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_TENAGA_KERJA_PEREMPUAN">
<span<?= $Page->TENAGA_KERJA_PEREMPUAN->viewAttributes() ?>>
<?= $Page->TENAGA_KERJA_PEREMPUAN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->MODAL_KERJA->Visible) { // MODAL_KERJA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_MODAL_KERJA"><?= $Page->renderSort($Page->MODAL_KERJA) ?></span></td>
            <td <?= $Page->MODAL_KERJA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Page->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x<?= $Page->RowIndex ?>_MODAL_KERJA" id="x<?= $Page->RowIndex ?>_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Page->MODAL_KERJA->EditValue ?>"<?= $Page->MODAL_KERJA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MODAL_KERJA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<span<?= $Page->MODAL_KERJA->viewAttributes() ?>>
<?= $Page->MODAL_KERJA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_MODAL_KERJA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->MODAL_KERJA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->MODAL_KERJA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<input type="<?= $Page->MODAL_KERJA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_MODAL_KERJA" name="x<?= $Page->RowIndex ?>_MODAL_KERJA" id="x<?= $Page->RowIndex ?>_MODAL_KERJA" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->MODAL_KERJA->getPlaceHolder()) ?>" value="<?= $Page->MODAL_KERJA->EditValue ?>"<?= $Page->MODAL_KERJA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->MODAL_KERJA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_MODAL_KERJA">
<span<?= $Page->MODAL_KERJA->viewAttributes() ?>>
<?= $Page->MODAL_KERJA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->OMZET_RATARATA_PERTAHUN->Visible) { // OMZET_RATA-RATA_PERTAHUN ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_OMZET_RATARATA_PERTAHUN"><?= $Page->renderSort($Page->OMZET_RATARATA_PERTAHUN) ?></span></td>
            <td <?= $Page->OMZET_RATARATA_PERTAHUN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Page->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x<?= $Page->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Page->RowIndex ?>_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Page->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Page->OMZET_RATARATA_PERTAHUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<span<?= $Page->OMZET_RATARATA_PERTAHUN->viewAttributes() ?>>
<?= $Page->OMZET_RATARATA_PERTAHUN->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_OMZET_RATARATA_PERTAHUN">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->OMZET_RATARATA_PERTAHUN->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->OMZET_RATARATA_PERTAHUN->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<input type="<?= $Page->OMZET_RATARATA_PERTAHUN->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_OMZET_RATARATA_PERTAHUN" name="x<?= $Page->RowIndex ?>_OMZET_RATARATA_PERTAHUN" id="x<?= $Page->RowIndex ?>_OMZET_RATARATA_PERTAHUN" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->OMZET_RATARATA_PERTAHUN->getPlaceHolder()) ?>" value="<?= $Page->OMZET_RATARATA_PERTAHUN->EditValue ?>"<?= $Page->OMZET_RATARATA_PERTAHUN->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->OMZET_RATARATA_PERTAHUN->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_OMZET_RATARATA_PERTAHUN">
<span<?= $Page->OMZET_RATARATA_PERTAHUN->viewAttributes() ?>>
<?= $Page->OMZET_RATARATA_PERTAHUN->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->STATUS_USAHA->Visible) { // STATUS_USAHA ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_STATUS_USAHA"><?= $Page->renderSort($Page->STATUS_USAHA) ?></span></td>
            <td <?= $Page->STATUS_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Page->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x<?= $Page->RowIndex ?>_STATUS_USAHA" id="x<?= $Page->RowIndex ?>_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Page->STATUS_USAHA->EditValue ?>"<?= $Page->STATUS_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->STATUS_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<span<?= $Page->STATUS_USAHA->viewAttributes() ?>>
<?= $Page->STATUS_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_STATUS_USAHA">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->STATUS_USAHA->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->STATUS_USAHA->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<input type="<?= $Page->STATUS_USAHA->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_STATUS_USAHA" name="x<?= $Page->RowIndex ?>_STATUS_USAHA" id="x<?= $Page->RowIndex ?>_STATUS_USAHA" size="30" maxlength="50" placeholder="<?= HtmlEncode($Page->STATUS_USAHA->getPlaceHolder()) ?>" value="<?= $Page->STATUS_USAHA->EditValue ?>"<?= $Page->STATUS_USAHA->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->STATUS_USAHA->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_STATUS_USAHA">
<span<?= $Page->STATUS_USAHA->viewAttributes() ?>>
<?= $Page->STATUS_USAHA->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->ASET->Visible) { // ASET ?>
        <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
        <tr>
            <td class="ew-table-header <?= $Page->TableLeftColumnClass ?>"><span class="umkm_datausaha_ASET"><?= $Page->renderSort($Page->ASET) ?></span></td>
            <td <?= $Page->ASET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ASET">
<input type="<?= $Page->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x<?= $Page->RowIndex ?>_ASET" id="x<?= $Page->RowIndex ?>_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->ASET->getPlaceHolder()) ?>" value="<?= $Page->ASET->EditValue ?>"<?= $Page->ASET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ASET->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ASET">
<span<?= $Page->ASET->viewAttributes() ?>>
<?= $Page->ASET->getViewValue() ?></span>
</span>
<?php } ?>
</td>
        </tr>
        <?php } else { // Add/edit record ?>
        <div class="form-group row umkm_datausaha_ASET">
            <label class="<?= $Page->LeftColumnClass ?>"><?= $Page->ASET->caption() ?></label>
            <div class="<?= $Page->RightColumnClass ?>"><div <?= $Page->ASET->cellAttributes() ?>>
<?php if ($Page->RowType == ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ASET">
<input type="<?= $Page->ASET->getInputTextType() ?>" data-table="umkm_datausaha" data-field="x_ASET" name="x<?= $Page->RowIndex ?>_ASET" id="x<?= $Page->RowIndex ?>_ASET" size="30" maxlength="22" placeholder="<?= HtmlEncode($Page->ASET->getPlaceHolder()) ?>" value="<?= $Page->ASET->EditValue ?>"<?= $Page->ASET->editAttributes() ?>>
<div class="invalid-feedback"><?= $Page->ASET->getErrorMessage() ?></div>
</span>
<?php } ?>
<?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
<span id="el<?= $Page->RowCount ?>_umkm_datausaha_ASET">
<span<?= $Page->ASET->viewAttributes() ?>>
<?= $Page->ASET->getViewValue() ?></span>
</span>
<?php } ?>
</div></div>
        </div>
        <?php } ?>
    <?php } ?>
    <?php if ($Page->RowType == ROWTYPE_VIEW) { // View record ?>
    </table>
    <?php } ?>
    </div><!-- /.card-body -->
<?php if (!$Page->isExport()) { ?>
    <div class="card-footer">
        <div class="ew-multi-column-list-option">
<?php
// Render list options (body, bottom)
$Page->ListOptions->render("body", "bottom", $Page->RowCount);
?>
        </div><!-- /.ew-multi-column-list-option -->
        <div class="clearfix"></div>
    </div><!-- /.card-footer -->
<?php } ?>
    </div><!-- /.card -->
</div><!-- /.col-* -->
<?php if ($Page->RowType == ROWTYPE_ADD || $Page->RowType == ROWTYPE_EDIT) { ?>
<script>
loadjs.ready(["fumkm_datausahalist","load"], function () {
    fumkm_datausahalist.updateLists(<?= $Page->RowIndex ?>);
});
</script>
<?php } ?>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
<?php } ?>
</div><!-- /.ew-multi-column-row -->
<?php if ($Page->isEdit()) { ?>
<input type="hidden" name="<?= $Page->FormKeyCountName ?>" id="<?= $Page->FormKeyCountName ?>" value="<?= $Page->KeyCount ?>">
<input type="hidden" name="<?= $Page->OldKeyName ?>" value="<?= $Page->OldKey ?>">
<?php } ?>
<?php if (!$Page->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php
// Close recordset
if ($Page->Recordset) {
    $Page->Recordset->close();
}
?>
<?php if (!$Page->isExport()) { ?>
<div>
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-multi-column-grid -->
<?php } ?>
<?php if ($Page->TotalRecords == 0 && !$Page->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
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
<?php } ?>
