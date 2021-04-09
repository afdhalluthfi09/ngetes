<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmMarketView = &$Page;
?>
<?php if (!$Page->isExport()) { ?>
<script>
var currentForm, currentPageID;
var fkumkm_marketview;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "view";
    fkumkm_marketview = currentForm = new ew.Form("fkumkm_marketview", "view");
    loadjs.done("fkumkm_marketview");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<?php } ?>
<script>
if (!ew.vars.tables.kumkm_market) ew.vars.tables.kumkm_market = <?= JsonEncode(GetClientVar("tables", "kumkm_market")) ?>;
</script>
<?php if (!$Page->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $Page->ExportOptions->render("body") ?>
<?php $Page->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?= CurrentPageUrl(false) ?>">
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
</form>
<?php } ?>
<?php } ?>
<form name="fkumkm_marketview" id="fkumkm_marketview" class="form-inline ew-form ew-view-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_market">
<input type="hidden" name="modal" value="<?= (int)$Page->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($Page->produk_foto->Visible) { // produk_foto ?>
    <tr id="r_produk_foto">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_foto"><?= $Page->produk_foto->caption() ?></span></td>
        <td data-name="produk_foto" <?= $Page->produk_foto->cellAttributes() ?>>
<span id="el_kumkm_market_produk_foto">
<span<?= $Page->produk_foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->produk_foto, $Page->produk_foto->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_nama->Visible) { // produk_nama ?>
    <tr id="r_produk_nama">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_nama"><?= $Page->produk_nama->caption() ?></span></td>
        <td data-name="produk_nama" <?= $Page->produk_nama->cellAttributes() ?>>
<span id="el_kumkm_market_produk_nama">
<span<?= $Page->produk_nama->viewAttributes() ?>>
<?= $Page->produk_nama->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_jenis->Visible) { // produk_jenis ?>
    <tr id="r_produk_jenis">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_jenis"><?= $Page->produk_jenis->caption() ?></span></td>
        <td data-name="produk_jenis" <?= $Page->produk_jenis->cellAttributes() ?>>
<span id="el_kumkm_market_produk_jenis">
<span<?= $Page->produk_jenis->viewAttributes() ?>>
<?= $Page->produk_jenis->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_desc->Visible) { // produk_desc ?>
    <tr id="r_produk_desc">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_desc"><?= $Page->produk_desc->caption() ?></span></td>
        <td data-name="produk_desc" <?= $Page->produk_desc->cellAttributes() ?>>
<span id="el_kumkm_market_produk_desc">
<span<?= $Page->produk_desc->viewAttributes() ?>>
<?= $Page->produk_desc->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_harga->Visible) { // produk_harga ?>
    <tr id="r_produk_harga">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_harga"><?= $Page->produk_harga->caption() ?></span></td>
        <td data-name="produk_harga" <?= $Page->produk_harga->cellAttributes() ?>>
<span id="el_kumkm_market_produk_harga">
<span<?= $Page->produk_harga->viewAttributes() ?>>
<?= $Page->produk_harga->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->kurator->Visible) { // kurator ?>
    <tr id="r_kurator">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_kurator"><?= $Page->kurator->caption() ?></span></td>
        <td data-name="kurator" <?= $Page->kurator->cellAttributes() ?>>
<span id="el_kumkm_market_kurator">
<span<?= $Page->kurator->viewAttributes() ?>>
<?= $Page->kurator->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_legal->Visible) { // produk_legal ?>
    <tr id="r_produk_legal">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_legal"><?= $Page->produk_legal->caption() ?></span></td>
        <td data-name="produk_legal" <?= $Page->produk_legal->cellAttributes() ?>>
<span id="el_kumkm_market_produk_legal">
<span<?= $Page->produk_legal->viewAttributes() ?>>
<?= $Page->produk_legal->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->judul_sesuai->Visible) { // judul_sesuai ?>
    <tr id="r_judul_sesuai">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_judul_sesuai"><?= $Page->judul_sesuai->caption() ?></span></td>
        <td data-name="judul_sesuai" <?= $Page->judul_sesuai->cellAttributes() ?>>
<span id="el_kumkm_market_judul_sesuai">
<span<?= $Page->judul_sesuai->viewAttributes() ?>>
<?= $Page->judul_sesuai->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->foto_bagus->Visible) { // foto_bagus ?>
    <tr id="r_foto_bagus">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_foto_bagus"><?= $Page->foto_bagus->caption() ?></span></td>
        <td data-name="foto_bagus" <?= $Page->foto_bagus->cellAttributes() ?>>
<span id="el_kumkm_market_foto_bagus">
<span<?= $Page->foto_bagus->viewAttributes() ?>>
<?= $Page->foto_bagus->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->deskripsi_jelas->Visible) { // deskripsi_jelas ?>
    <tr id="r_deskripsi_jelas">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_deskripsi_jelas"><?= $Page->deskripsi_jelas->caption() ?></span></td>
        <td data-name="deskripsi_jelas" <?= $Page->deskripsi_jelas->cellAttributes() ?>>
<span id="el_kumkm_market_deskripsi_jelas">
<span<?= $Page->deskripsi_jelas->viewAttributes() ?>>
<?= $Page->deskripsi_jelas->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->harga_tidak_kosong->Visible) { // harga_tidak_kosong ?>
    <tr id="r_harga_tidak_kosong">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_harga_tidak_kosong"><?= $Page->harga_tidak_kosong->caption() ?></span></td>
        <td data-name="harga_tidak_kosong" <?= $Page->harga_tidak_kosong->cellAttributes() ?>>
<span id="el_kumkm_market_harga_tidak_kosong">
<span<?= $Page->harga_tidak_kosong->viewAttributes() ?>>
<?= $Page->harga_tidak_kosong->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->berat_tidak_kosong->Visible) { // berat_tidak_kosong ?>
    <tr id="r_berat_tidak_kosong">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_berat_tidak_kosong"><?= $Page->berat_tidak_kosong->caption() ?></span></td>
        <td data-name="berat_tidak_kosong" <?= $Page->berat_tidak_kosong->cellAttributes() ?>>
<span id="el_kumkm_market_berat_tidak_kosong">
<span<?= $Page->berat_tidak_kosong->viewAttributes() ?>>
<?= $Page->berat_tidak_kosong->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_berat->Visible) { // produk_berat ?>
    <tr id="r_produk_berat">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_berat"><?= $Page->produk_berat->caption() ?></span></td>
        <td data-name="produk_berat" <?= $Page->produk_berat->cellAttributes() ?>>
<span id="el_kumkm_market_produk_berat">
<span<?= $Page->produk_berat->viewAttributes() ?>>
<?= $Page->produk_berat->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_panjang->Visible) { // produk_panjang ?>
    <tr id="r_produk_panjang">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_panjang"><?= $Page->produk_panjang->caption() ?></span></td>
        <td data-name="produk_panjang" <?= $Page->produk_panjang->cellAttributes() ?>>
<span id="el_kumkm_market_produk_panjang">
<span<?= $Page->produk_panjang->viewAttributes() ?>>
<?= $Page->produk_panjang->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_lebar->Visible) { // produk_lebar ?>
    <tr id="r_produk_lebar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_lebar"><?= $Page->produk_lebar->caption() ?></span></td>
        <td data-name="produk_lebar" <?= $Page->produk_lebar->cellAttributes() ?>>
<span id="el_kumkm_market_produk_lebar">
<span<?= $Page->produk_lebar->viewAttributes() ?>>
<?= $Page->produk_lebar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_tinggi->Visible) { // produk_tinggi ?>
    <tr id="r_produk_tinggi">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_tinggi"><?= $Page->produk_tinggi->caption() ?></span></td>
        <td data-name="produk_tinggi" <?= $Page->produk_tinggi->cellAttributes() ?>>
<span id="el_kumkm_market_produk_tinggi">
<span<?= $Page->produk_tinggi->viewAttributes() ?>>
<?= $Page->produk_tinggi->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_harga_dasar->Visible) { // produk_harga_dasar ?>
    <tr id="r_produk_harga_dasar">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_harga_dasar"><?= $Page->produk_harga_dasar->caption() ?></span></td>
        <td data-name="produk_harga_dasar" <?= $Page->produk_harga_dasar->cellAttributes() ?>>
<span id="el_kumkm_market_produk_harga_dasar">
<span<?= $Page->produk_harga_dasar->viewAttributes() ?>>
<?= $Page->produk_harga_dasar->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_foto_1->Visible) { // produk_foto_1 ?>
    <tr id="r_produk_foto_1">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_foto_1"><?= $Page->produk_foto_1->caption() ?></span></td>
        <td data-name="produk_foto_1" <?= $Page->produk_foto_1->cellAttributes() ?>>
<span id="el_kumkm_market_produk_foto_1">
<span>
<?= GetFileViewTag($Page->produk_foto_1, $Page->produk_foto_1->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_foto_2->Visible) { // produk_foto_2 ?>
    <tr id="r_produk_foto_2">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_foto_2"><?= $Page->produk_foto_2->caption() ?></span></td>
        <td data-name="produk_foto_2" <?= $Page->produk_foto_2->cellAttributes() ?>>
<span id="el_kumkm_market_produk_foto_2">
<span>
<?= GetFileViewTag($Page->produk_foto_2, $Page->produk_foto_2->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->produk_foto_3->Visible) { // produk_foto_3 ?>
    <tr id="r_produk_foto_3">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_produk_foto_3"><?= $Page->produk_foto_3->caption() ?></span></td>
        <td data-name="produk_foto_3" <?= $Page->produk_foto_3->cellAttributes() ?>>
<span id="el_kumkm_market_produk_foto_3">
<span>
<?= GetFileViewTag($Page->produk_foto_3, $Page->produk_foto_3->getViewValue(), false) ?>
</span>
</span>
</td>
    </tr>
<?php } ?>
<?php if ($Page->market->Visible) { // market ?>
    <tr id="r_market">
        <td class="<?= $Page->TableLeftColumnClass ?>"><span id="elh_kumkm_market_market"><?= $Page->market->caption() ?></span></td>
        <td data-name="market" <?= $Page->market->cellAttributes() ?>>
<span id="el_kumkm_market_market">
<span<?= $Page->market->viewAttributes() ?>>
<?= $Page->market->getViewValue() ?></span>
</span>
</td>
    </tr>
<?php } ?>
</table>
<?php if (!$Page->IsModal) { ?>
<?php if (!$Page->isExport()) { ?>
<?= $Page->Pager->render() ?>
<div class="clearfix"></div>
<?php } ?>
<?php } ?>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<?php if (!$Page->isExport()) { ?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
<?php } ?>
