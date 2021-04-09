<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$CetakProfilumkmlengkapList = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fcetak_profilumkmlengkaplist;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "list";
    fcetak_profilumkmlengkaplist = currentForm = new ew.Form("fcetak_profilumkmlengkaplist", "list");
    fcetak_profilumkmlengkaplist.formKeyCountName = '<?= $Page->FormKeyCountName ?>';
    loadjs.done("fcetak_profilumkmlengkaplist");
});
var fcetak_profilumkmlengkaplistsrch, currentSearchForm, currentAdvancedSearchForm;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object for search
    fcetak_profilumkmlengkaplistsrch = currentSearchForm = new ew.Form("fcetak_profilumkmlengkaplistsrch");

    // Dynamic selection lists

    // Filters
    fcetak_profilumkmlengkaplistsrch.filterList = <?= $Page->getFilterList() ?>;
    loadjs.done("fcetak_profilumkmlengkaplistsrch");
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
<?php if ($Page->SearchOptions->visible()) { ?>
<?php $Page->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($Page->FilterOptions->visible()) { ?>
<?php $Page->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$Page->renderOtherOptions();
?>
<?php if ($Security->canSearch()) { ?>
<?php if (!$Page->isExport() && !$Page->CurrentAction) { ?>
<form name="fcetak_profilumkmlengkaplistsrch" id="fcetak_profilumkmlengkaplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?= CurrentPageUrl(false) ?>">
<div id="fcetak_profilumkmlengkaplistsrch-search-panel" class="<?= $Page->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cetak_profilumkmlengkap">
    <div class="ew-extended-search">
<div id="xsr_<?= $Page->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
    <div class="ew-quick-search input-group">
        <input type="text" name="<?= Config("TABLE_BASIC_SEARCH") ?>" id="<?= Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?= HtmlEncode($Page->BasicSearch->getKeyword()) ?>" placeholder="<?= HtmlEncode($Language->phrase("Search")) ?>">
        <input type="hidden" name="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?= Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?= HtmlEncode($Page->BasicSearch->getType()) ?>">
        <div class="input-group-append">
            <button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?= $Language->phrase("SearchBtn") ?></button>
            <button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?= $Page->BasicSearch->getTypeNameShort() ?></span></button>
            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?= $Language->phrase("QuickSearchAuto") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?= $Language->phrase("QuickSearchExact") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?= $Language->phrase("QuickSearchAll") ?></a>
                <a class="dropdown-item<?php if ($Page->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?= $Language->phrase("QuickSearchAny") ?></a>
            </div>
        </div>
    </div>
</div>
    </div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if ($Page->TotalRecords > 0 || $Page->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($Page->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cetak_profilumkmlengkap">
<?php if (!$Page->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$Page->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $Page->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcetak_profilumkmlengkaplist" id="fcetak_profilumkmlengkaplist" class="form-inline ew-form ew-list-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="cetak_profilumkmlengkap">
<div id="gmp_cetak_profilumkmlengkap" class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($Page->TotalRecords > 0 || $Page->isGridEdit()) { ?>
<table id="tbl_cetak_profilumkmlengkaplist" class="table ew-table"><!-- .ew-table -->
<thead>
    <tr class="ew-table-header">
<?php
// Header row
$Page->RowType = ROWTYPE_HEADER;

// Render list options
$Page->renderListOptions();

// Render list options (header, left)
$Page->ListOptions->render("header", "left");
?>
<?php if ($Page->nik->Visible) { // nik ?>
        <th data-name="nik" class="<?= $Page->nik->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_nik" class="cetak_profilumkmlengkap_nik"><?= $Page->renderSort($Page->nik) ?></div></th>
<?php } ?>
<?php if ($Page->nama_usaha->Visible) { // nama_usaha ?>
        <th data-name="nama_usaha" class="<?= $Page->nama_usaha->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_nama_usaha" class="cetak_profilumkmlengkap_nama_usaha"><?= $Page->renderSort($Page->nama_usaha) ?></div></th>
<?php } ?>
<?php if ($Page->prf_addbisnis_kel->Visible) { // prf_addbisnis_kel ?>
        <th data-name="prf_addbisnis_kel" class="<?= $Page->prf_addbisnis_kel->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_prf_addbisnis_kel" class="cetak_profilumkmlengkap_prf_addbisnis_kel"><?= $Page->renderSort($Page->prf_addbisnis_kel) ?></div></th>
<?php } ?>
<?php if ($Page->prf_addbisnis_kec->Visible) { // prf_addbisnis_kec ?>
        <th data-name="prf_addbisnis_kec" class="<?= $Page->prf_addbisnis_kec->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_prf_addbisnis_kec" class="cetak_profilumkmlengkap_prf_addbisnis_kec"><?= $Page->renderSort($Page->prf_addbisnis_kec) ?></div></th>
<?php } ?>
<?php if ($Page->kabupaten->Visible) { // kabupaten ?>
        <th data-name="kabupaten" class="<?= $Page->kabupaten->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_kabupaten" class="cetak_profilumkmlengkap_kabupaten"><?= $Page->renderSort($Page->kabupaten) ?></div></th>
<?php } ?>
<?php if ($Page->klasifikasi_usaha->Visible) { // klasifikasi_usaha ?>
        <th data-name="klasifikasi_usaha" class="<?= $Page->klasifikasi_usaha->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_klasifikasi_usaha" class="cetak_profilumkmlengkap_klasifikasi_usaha"><?= $Page->renderSort($Page->klasifikasi_usaha) ?></div></th>
<?php } ?>
<?php if ($Page->sektor_pergub->Visible) { // sektor_pergub ?>
        <th data-name="sektor_pergub" class="<?= $Page->sektor_pergub->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_sektor_pergub" class="cetak_profilumkmlengkap_sektor_pergub"><?= $Page->renderSort($Page->sektor_pergub) ?></div></th>
<?php } ?>
<?php if ($Page->sektor_kbli->Visible) { // sektor_kbli ?>
        <th data-name="sektor_kbli" class="<?= $Page->sektor_kbli->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_sektor_kbli" class="cetak_profilumkmlengkap_sektor_kbli"><?= $Page->renderSort($Page->sektor_kbli) ?></div></th>
<?php } ?>
<?php if ($Page->sektor_ekraf->Visible) { // sektor_ekraf ?>
        <th data-name="sektor_ekraf" class="<?= $Page->sektor_ekraf->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_sektor_ekraf" class="cetak_profilumkmlengkap_sektor_ekraf"><?= $Page->renderSort($Page->sektor_ekraf) ?></div></th>
<?php } ?>
<?php if ($Page->nama_lengkap->Visible) { // nama_lengkap ?>
        <th data-name="nama_lengkap" class="<?= $Page->nama_lengkap->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_nama_lengkap" class="cetak_profilumkmlengkap_nama_lengkap"><?= $Page->renderSort($Page->nama_lengkap) ?></div></th>
<?php } ?>
<?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <th data-name="jenis_kelamin" class="<?= $Page->jenis_kelamin->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_jenis_kelamin" class="cetak_profilumkmlengkap_jenis_kelamin"><?= $Page->renderSort($Page->jenis_kelamin) ?></div></th>
<?php } ?>
<?php if ($Page->no_hp->Visible) { // no_hp ?>
        <th data-name="no_hp" class="<?= $Page->no_hp->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_no_hp" class="cetak_profilumkmlengkap_no_hp"><?= $Page->renderSort($Page->no_hp) ?></div></th>
<?php } ?>
<?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <th data-name="pendidikan" class="<?= $Page->pendidikan->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_pendidikan" class="cetak_profilumkmlengkap_pendidikan"><?= $Page->renderSort($Page->pendidikan) ?></div></th>
<?php } ?>
<?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <th data-name="disabilitas" class="<?= $Page->disabilitas->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_disabilitas" class="cetak_profilumkmlengkap_disabilitas"><?= $Page->renderSort($Page->disabilitas) ?></div></th>
<?php } ?>
<?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <th data-name="tglmulai" class="<?= $Page->tglmulai->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_tglmulai" class="cetak_profilumkmlengkap_tglmulai"><?= $Page->renderSort($Page->tglmulai) ?></div></th>
<?php } ?>
<?php if ($Page->umurusaha->Visible) { // umurusaha ?>
        <th data-name="umurusaha" class="<?= $Page->umurusaha->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_umurusaha" class="cetak_profilumkmlengkap_umurusaha"><?= $Page->renderSort($Page->umurusaha) ?></div></th>
<?php } ?>
<?php if ($Page->addbisnis->Visible) { // addbisnis ?>
        <th data-name="addbisnis" class="<?= $Page->addbisnis->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_addbisnis" class="cetak_profilumkmlengkap_addbisnis"><?= $Page->renderSort($Page->addbisnis) ?></div></th>
<?php } ?>
<?php if ($Page->nilai_aset->Visible) { // nilai_aset ?>
        <th data-name="nilai_aset" class="<?= $Page->nilai_aset->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_nilai_aset" class="cetak_profilumkmlengkap_nilai_aset"><?= $Page->renderSort($Page->nilai_aset) ?></div></th>
<?php } ?>
<?php if ($Page->omsetbulan->Visible) { // omsetbulan ?>
        <th data-name="omsetbulan" class="<?= $Page->omsetbulan->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_omsetbulan" class="cetak_profilumkmlengkap_omsetbulan"><?= $Page->renderSort($Page->omsetbulan) ?></div></th>
<?php } ?>
<?php if ($Page->kegiatan_usaha->Visible) { // kegiatan_usaha ?>
        <th data-name="kegiatan_usaha" class="<?= $Page->kegiatan_usaha->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_kegiatan_usaha" class="cetak_profilumkmlengkap_kegiatan_usaha"><?= $Page->renderSort($Page->kegiatan_usaha) ?></div></th>
<?php } ?>
<?php if ($Page->uraian_kegiatan->Visible) { // uraian_kegiatan ?>
        <th data-name="uraian_kegiatan" class="<?= $Page->uraian_kegiatan->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_uraian_kegiatan" class="cetak_profilumkmlengkap_uraian_kegiatan"><?= $Page->renderSort($Page->uraian_kegiatan) ?></div></th>
<?php } ?>
<?php if ($Page->emailusaha->Visible) { // emailusaha ?>
        <th data-name="emailusaha" class="<?= $Page->emailusaha->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_emailusaha" class="cetak_profilumkmlengkap_emailusaha"><?= $Page->renderSort($Page->emailusaha) ?></div></th>
<?php } ?>
<?php if ($Page->akun_ig->Visible) { // akun_ig ?>
        <th data-name="akun_ig" class="<?= $Page->akun_ig->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_akun_ig" class="cetak_profilumkmlengkap_akun_ig"><?= $Page->renderSort($Page->akun_ig) ?></div></th>
<?php } ?>
<?php if ($Page->akun_facebook->Visible) { // akun_facebook ?>
        <th data-name="akun_facebook" class="<?= $Page->akun_facebook->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_akun_facebook" class="cetak_profilumkmlengkap_akun_facebook"><?= $Page->renderSort($Page->akun_facebook) ?></div></th>
<?php } ?>
<?php if ($Page->akun_gmb->Visible) { // akun_gmb ?>
        <th data-name="akun_gmb" class="<?= $Page->akun_gmb->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_akun_gmb" class="cetak_profilumkmlengkap_akun_gmb"><?= $Page->renderSort($Page->akun_gmb) ?></div></th>
<?php } ?>
<?php if ($Page->url_website->Visible) { // url_website ?>
        <th data-name="url_website" class="<?= $Page->url_website->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_url_website" class="cetak_profilumkmlengkap_url_website"><?= $Page->renderSort($Page->url_website) ?></div></th>
<?php } ?>
<?php if ($Page->url_marketplace->Visible) { // url_marketplace ?>
        <th data-name="url_marketplace" class="<?= $Page->url_marketplace->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_url_marketplace" class="cetak_profilumkmlengkap_url_marketplace"><?= $Page->renderSort($Page->url_marketplace) ?></div></th>
<?php } ?>
<?php if ($Page->kelas->Visible) { // kelas ?>
        <th data-name="kelas" class="<?= $Page->kelas->headerCellClass() ?>"><div id="elh_cetak_profilumkmlengkap_kelas" class="cetak_profilumkmlengkap_kelas"><?= $Page->renderSort($Page->kelas) ?></div></th>
<?php } ?>
<?php
// Render list options (header, right)
$Page->ListOptions->render("header", "right");
?>
    </tr>
</thead>
<tbody>
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
$Page->RecordCount = $Page->StartRecord - 1;
if ($Page->Recordset && !$Page->Recordset->EOF) {
    // Nothing to do
} elseif (!$Page->AllowAddDeleteRow && $Page->StopRecord == 0) {
    $Page->StopRecord = $Page->GridAddRowCount;
}

// Initialize aggregate
$Page->RowType = ROWTYPE_AGGREGATEINIT;
$Page->resetAttributes();
$Page->renderRow();
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

        // Set up row id / data-rowindex
        $Page->RowAttrs->merge(["data-rowindex" => $Page->RowCount, "id" => "r" . $Page->RowCount . "_cetak_profilumkmlengkap", "data-rowtype" => $Page->RowType]);

        // Render row
        $Page->renderRow();

        // Render list options
        $Page->renderListOptions();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php
// Render list options (body, left)
$Page->ListOptions->render("body", "left", $Page->RowCount);
?>
    <?php if ($Page->nik->Visible) { // nik ?>
        <td data-name="nik" <?= $Page->nik->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_nik">
<span<?= $Page->nik->viewAttributes() ?>>
<?= $Page->nik->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_usaha->Visible) { // nama_usaha ?>
        <td data-name="nama_usaha" <?= $Page->nama_usaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_nama_usaha">
<span<?= $Page->nama_usaha->viewAttributes() ?>>
<?= $Page->nama_usaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prf_addbisnis_kel->Visible) { // prf_addbisnis_kel ?>
        <td data-name="prf_addbisnis_kel" <?= $Page->prf_addbisnis_kel->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_prf_addbisnis_kel">
<span<?= $Page->prf_addbisnis_kel->viewAttributes() ?>>
<?= $Page->prf_addbisnis_kel->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->prf_addbisnis_kec->Visible) { // prf_addbisnis_kec ?>
        <td data-name="prf_addbisnis_kec" <?= $Page->prf_addbisnis_kec->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_prf_addbisnis_kec">
<span<?= $Page->prf_addbisnis_kec->viewAttributes() ?>>
<?= $Page->prf_addbisnis_kec->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kabupaten->Visible) { // kabupaten ?>
        <td data-name="kabupaten" <?= $Page->kabupaten->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_kabupaten">
<span<?= $Page->kabupaten->viewAttributes() ?>>
<?= $Page->kabupaten->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->klasifikasi_usaha->Visible) { // klasifikasi_usaha ?>
        <td data-name="klasifikasi_usaha" <?= $Page->klasifikasi_usaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_klasifikasi_usaha">
<span<?= $Page->klasifikasi_usaha->viewAttributes() ?>>
<?= $Page->klasifikasi_usaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sektor_pergub->Visible) { // sektor_pergub ?>
        <td data-name="sektor_pergub" <?= $Page->sektor_pergub->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_sektor_pergub">
<span<?= $Page->sektor_pergub->viewAttributes() ?>>
<?= $Page->sektor_pergub->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sektor_kbli->Visible) { // sektor_kbli ?>
        <td data-name="sektor_kbli" <?= $Page->sektor_kbli->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_sektor_kbli">
<span<?= $Page->sektor_kbli->viewAttributes() ?>>
<?= $Page->sektor_kbli->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->sektor_ekraf->Visible) { // sektor_ekraf ?>
        <td data-name="sektor_ekraf" <?= $Page->sektor_ekraf->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_sektor_ekraf">
<span<?= $Page->sektor_ekraf->viewAttributes() ?>>
<?= $Page->sektor_ekraf->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nama_lengkap->Visible) { // nama_lengkap ?>
        <td data-name="nama_lengkap" <?= $Page->nama_lengkap->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_nama_lengkap">
<span<?= $Page->nama_lengkap->viewAttributes() ?>>
<?= $Page->nama_lengkap->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->jenis_kelamin->Visible) { // jenis_kelamin ?>
        <td data-name="jenis_kelamin" <?= $Page->jenis_kelamin->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_jenis_kelamin">
<span<?= $Page->jenis_kelamin->viewAttributes() ?>>
<?= $Page->jenis_kelamin->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->no_hp->Visible) { // no_hp ?>
        <td data-name="no_hp" <?= $Page->no_hp->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_no_hp">
<span<?= $Page->no_hp->viewAttributes() ?>>
<?= $Page->no_hp->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->pendidikan->Visible) { // pendidikan ?>
        <td data-name="pendidikan" <?= $Page->pendidikan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_pendidikan">
<span<?= $Page->pendidikan->viewAttributes() ?>>
<?= $Page->pendidikan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->disabilitas->Visible) { // disabilitas ?>
        <td data-name="disabilitas" <?= $Page->disabilitas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_disabilitas">
<span<?= $Page->disabilitas->viewAttributes() ?>>
<?= $Page->disabilitas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->tglmulai->Visible) { // tglmulai ?>
        <td data-name="tglmulai" <?= $Page->tglmulai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_tglmulai">
<span<?= $Page->tglmulai->viewAttributes() ?>>
<?= $Page->tglmulai->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->umurusaha->Visible) { // umurusaha ?>
        <td data-name="umurusaha" <?= $Page->umurusaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_umurusaha">
<span<?= $Page->umurusaha->viewAttributes() ?>>
<?= $Page->umurusaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->addbisnis->Visible) { // addbisnis ?>
        <td data-name="addbisnis" <?= $Page->addbisnis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_addbisnis">
<span<?= $Page->addbisnis->viewAttributes() ?>>
<?= $Page->addbisnis->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->nilai_aset->Visible) { // nilai_aset ?>
        <td data-name="nilai_aset" <?= $Page->nilai_aset->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_nilai_aset">
<span<?= $Page->nilai_aset->viewAttributes() ?>>
<?= $Page->nilai_aset->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->omsetbulan->Visible) { // omsetbulan ?>
        <td data-name="omsetbulan" <?= $Page->omsetbulan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_omsetbulan">
<span<?= $Page->omsetbulan->viewAttributes() ?>>
<?= $Page->omsetbulan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kegiatan_usaha->Visible) { // kegiatan_usaha ?>
        <td data-name="kegiatan_usaha" <?= $Page->kegiatan_usaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_kegiatan_usaha">
<span<?= $Page->kegiatan_usaha->viewAttributes() ?>>
<?= $Page->kegiatan_usaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->uraian_kegiatan->Visible) { // uraian_kegiatan ?>
        <td data-name="uraian_kegiatan" <?= $Page->uraian_kegiatan->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_uraian_kegiatan">
<span<?= $Page->uraian_kegiatan->viewAttributes() ?>>
<?= $Page->uraian_kegiatan->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->emailusaha->Visible) { // emailusaha ?>
        <td data-name="emailusaha" <?= $Page->emailusaha->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_emailusaha">
<span<?= $Page->emailusaha->viewAttributes() ?>>
<?= $Page->emailusaha->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_ig->Visible) { // akun_ig ?>
        <td data-name="akun_ig" <?= $Page->akun_ig->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_akun_ig">
<span<?= $Page->akun_ig->viewAttributes() ?>>
<?= $Page->akun_ig->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_facebook->Visible) { // akun_facebook ?>
        <td data-name="akun_facebook" <?= $Page->akun_facebook->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_akun_facebook">
<span<?= $Page->akun_facebook->viewAttributes() ?>>
<?= $Page->akun_facebook->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->akun_gmb->Visible) { // akun_gmb ?>
        <td data-name="akun_gmb" <?= $Page->akun_gmb->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_akun_gmb">
<span<?= $Page->akun_gmb->viewAttributes() ?>>
<?= $Page->akun_gmb->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->url_website->Visible) { // url_website ?>
        <td data-name="url_website" <?= $Page->url_website->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_url_website">
<span<?= $Page->url_website->viewAttributes() ?>>
<?= $Page->url_website->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->url_marketplace->Visible) { // url_marketplace ?>
        <td data-name="url_marketplace" <?= $Page->url_marketplace->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_url_marketplace">
<span<?= $Page->url_marketplace->viewAttributes() ?>>
<?= $Page->url_marketplace->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
    <?php if ($Page->kelas->Visible) { // kelas ?>
        <td data-name="kelas" <?= $Page->kelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_cetak_profilumkmlengkap_kelas">
<span<?= $Page->kelas->viewAttributes() ?>>
<?= $Page->kelas->getViewValue() ?></span>
</span>
</td>
    <?php } ?>
<?php
// Render list options (body, right)
$Page->ListOptions->render("body", "right", $Page->RowCount);
?>
    </tr>
<?php
    }
    if (!$Page->isGridAdd()) {
        $Page->Recordset->moveNext();
    }
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
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
<div class="card-footer ew-grid-lower-panel">
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
</div><!-- /.ew-grid -->
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
    ew.addEventHandlers("cetak_profilumkmlengkap");
});
</script>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
