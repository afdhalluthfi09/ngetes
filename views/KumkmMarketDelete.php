<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$KumkmMarketDelete = &$Page;
?>
<script>
var currentForm, currentPageID;
var fkumkm_marketdelete;
loadjs.ready("head", function () {
    var $ = jQuery;
    // Form object
    currentPageID = ew.PAGE_ID = "delete";
    fkumkm_marketdelete = currentForm = new ew.Form("fkumkm_marketdelete", "delete");
    loadjs.done("fkumkm_marketdelete");
});
</script>
<script>
loadjs.ready("head", function () {
    // Write your table-specific client script here, no need to add script tags.
});
</script>
<script>
if (!ew.vars.tables.kumkm_market) ew.vars.tables.kumkm_market = <?= JsonEncode(GetClientVar("tables", "kumkm_market")) ?>;
</script>
<?php $Page->showPageHeader(); ?>
<?php
$Page->showMessage();
?>
<form name="fkumkm_marketdelete" id="fkumkm_marketdelete" class="form-inline ew-form ew-delete-form" action="<?= CurrentPageUrl(false) ?>" method="post">
<?php if (Config("CHECK_TOKEN")) { ?>
<input type="hidden" name="<?= $TokenNameKey ?>" value="<?= $TokenName ?>"><!-- CSRF token name -->
<input type="hidden" name="<?= $TokenValueKey ?>" value="<?= $TokenValue ?>"><!-- CSRF token value -->
<?php } ?>
<input type="hidden" name="t" value="kumkm_market">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($Page->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode(Config("COMPOSITE_KEY_SEPARATOR"), $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?= HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?= ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
    <thead>
    <tr class="ew-table-header">
<?php if ($Page->produk_foto->Visible) { // produk_foto ?>
        <th class="<?= $Page->produk_foto->headerCellClass() ?>"><span id="elh_kumkm_market_produk_foto" class="kumkm_market_produk_foto"><?= $Page->produk_foto->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_nama->Visible) { // produk_nama ?>
        <th class="<?= $Page->produk_nama->headerCellClass() ?>"><span id="elh_kumkm_market_produk_nama" class="kumkm_market_produk_nama"><?= $Page->produk_nama->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_jenis->Visible) { // produk_jenis ?>
        <th class="<?= $Page->produk_jenis->headerCellClass() ?>"><span id="elh_kumkm_market_produk_jenis" class="kumkm_market_produk_jenis"><?= $Page->produk_jenis->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_harga->Visible) { // produk_harga ?>
        <th class="<?= $Page->produk_harga->headerCellClass() ?>"><span id="elh_kumkm_market_produk_harga" class="kumkm_market_produk_harga"><?= $Page->produk_harga->caption() ?></span></th>
<?php } ?>
<?php if ($Page->kurasi->Visible) { // kurasi ?>
        <th class="<?= $Page->kurasi->headerCellClass() ?>"><span id="elh_kumkm_market_kurasi" class="kumkm_market_kurasi"><?= $Page->kurasi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->judul_sesuai->Visible) { // judul_sesuai ?>
        <th class="<?= $Page->judul_sesuai->headerCellClass() ?>"><span id="elh_kumkm_market_judul_sesuai" class="kumkm_market_judul_sesuai"><?= $Page->judul_sesuai->caption() ?></span></th>
<?php } ?>
<?php if ($Page->foto_bagus->Visible) { // foto_bagus ?>
        <th class="<?= $Page->foto_bagus->headerCellClass() ?>"><span id="elh_kumkm_market_foto_bagus" class="kumkm_market_foto_bagus"><?= $Page->foto_bagus->caption() ?></span></th>
<?php } ?>
<?php if ($Page->deskripsi_jelas->Visible) { // deskripsi_jelas ?>
        <th class="<?= $Page->deskripsi_jelas->headerCellClass() ?>"><span id="elh_kumkm_market_deskripsi_jelas" class="kumkm_market_deskripsi_jelas"><?= $Page->deskripsi_jelas->caption() ?></span></th>
<?php } ?>
<?php if ($Page->harga_tidak_kosong->Visible) { // harga_tidak_kosong ?>
        <th class="<?= $Page->harga_tidak_kosong->headerCellClass() ?>"><span id="elh_kumkm_market_harga_tidak_kosong" class="kumkm_market_harga_tidak_kosong"><?= $Page->harga_tidak_kosong->caption() ?></span></th>
<?php } ?>
<?php if ($Page->berat_tidak_kosong->Visible) { // berat_tidak_kosong ?>
        <th class="<?= $Page->berat_tidak_kosong->headerCellClass() ?>"><span id="elh_kumkm_market_berat_tidak_kosong" class="kumkm_market_berat_tidak_kosong"><?= $Page->berat_tidak_kosong->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_berat->Visible) { // produk_berat ?>
        <th class="<?= $Page->produk_berat->headerCellClass() ?>"><span id="elh_kumkm_market_produk_berat" class="kumkm_market_produk_berat"><?= $Page->produk_berat->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_panjang->Visible) { // produk_panjang ?>
        <th class="<?= $Page->produk_panjang->headerCellClass() ?>"><span id="elh_kumkm_market_produk_panjang" class="kumkm_market_produk_panjang"><?= $Page->produk_panjang->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_lebar->Visible) { // produk_lebar ?>
        <th class="<?= $Page->produk_lebar->headerCellClass() ?>"><span id="elh_kumkm_market_produk_lebar" class="kumkm_market_produk_lebar"><?= $Page->produk_lebar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_tinggi->Visible) { // produk_tinggi ?>
        <th class="<?= $Page->produk_tinggi->headerCellClass() ?>"><span id="elh_kumkm_market_produk_tinggi" class="kumkm_market_produk_tinggi"><?= $Page->produk_tinggi->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_harga_dasar->Visible) { // produk_harga_dasar ?>
        <th class="<?= $Page->produk_harga_dasar->headerCellClass() ?>"><span id="elh_kumkm_market_produk_harga_dasar" class="kumkm_market_produk_harga_dasar"><?= $Page->produk_harga_dasar->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_foto_1->Visible) { // produk_foto_1 ?>
        <th class="<?= $Page->produk_foto_1->headerCellClass() ?>"><span id="elh_kumkm_market_produk_foto_1" class="kumkm_market_produk_foto_1"><?= $Page->produk_foto_1->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_foto_2->Visible) { // produk_foto_2 ?>
        <th class="<?= $Page->produk_foto_2->headerCellClass() ?>"><span id="elh_kumkm_market_produk_foto_2" class="kumkm_market_produk_foto_2"><?= $Page->produk_foto_2->caption() ?></span></th>
<?php } ?>
<?php if ($Page->produk_foto_3->Visible) { // produk_foto_3 ?>
        <th class="<?= $Page->produk_foto_3->headerCellClass() ?>"><span id="elh_kumkm_market_produk_foto_3" class="kumkm_market_produk_foto_3"><?= $Page->produk_foto_3->caption() ?></span></th>
<?php } ?>
<?php if ($Page->market->Visible) { // market ?>
        <th class="<?= $Page->market->headerCellClass() ?>"><span id="elh_kumkm_market_market" class="kumkm_market_market"><?= $Page->market->caption() ?></span></th>
<?php } ?>
    </tr>
    </thead>
    <tbody>
<?php
$Page->RecordCount = 0;
$i = 0;
while (!$Page->Recordset->EOF) {
    $Page->RecordCount++;
    $Page->RowCount++;

    // Set row properties
    $Page->resetAttributes();
    $Page->RowType = ROWTYPE_VIEW; // View

    // Get the field contents
    $Page->loadRowValues($Page->Recordset);

    // Render row
    $Page->renderRow();
?>
    <tr <?= $Page->rowAttributes() ?>>
<?php if ($Page->produk_foto->Visible) { // produk_foto ?>
        <td <?= $Page->produk_foto->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_foto" class="kumkm_market_produk_foto">
<span<?= $Page->produk_foto->viewAttributes() ?>>
<?= GetFileViewTag($Page->produk_foto, $Page->produk_foto->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_nama->Visible) { // produk_nama ?>
        <td <?= $Page->produk_nama->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_nama" class="kumkm_market_produk_nama">
<span<?= $Page->produk_nama->viewAttributes() ?>>
<?= $Page->produk_nama->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_jenis->Visible) { // produk_jenis ?>
        <td <?= $Page->produk_jenis->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_jenis" class="kumkm_market_produk_jenis">
<span<?= $Page->produk_jenis->viewAttributes() ?>>
<?= $Page->produk_jenis->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_harga->Visible) { // produk_harga ?>
        <td <?= $Page->produk_harga->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_harga" class="kumkm_market_produk_harga">
<span<?= $Page->produk_harga->viewAttributes() ?>>
<?= $Page->produk_harga->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->kurasi->Visible) { // kurasi ?>
        <td <?= $Page->kurasi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_kurasi" class="kumkm_market_kurasi">
<span<?= $Page->kurasi->viewAttributes() ?>>
<?= $Page->kurasi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->judul_sesuai->Visible) { // judul_sesuai ?>
        <td <?= $Page->judul_sesuai->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_judul_sesuai" class="kumkm_market_judul_sesuai">
<span<?= $Page->judul_sesuai->viewAttributes() ?>>
<?= $Page->judul_sesuai->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->foto_bagus->Visible) { // foto_bagus ?>
        <td <?= $Page->foto_bagus->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_foto_bagus" class="kumkm_market_foto_bagus">
<span<?= $Page->foto_bagus->viewAttributes() ?>>
<?= $Page->foto_bagus->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->deskripsi_jelas->Visible) { // deskripsi_jelas ?>
        <td <?= $Page->deskripsi_jelas->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_deskripsi_jelas" class="kumkm_market_deskripsi_jelas">
<span<?= $Page->deskripsi_jelas->viewAttributes() ?>>
<?= $Page->deskripsi_jelas->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->harga_tidak_kosong->Visible) { // harga_tidak_kosong ?>
        <td <?= $Page->harga_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_harga_tidak_kosong" class="kumkm_market_harga_tidak_kosong">
<span<?= $Page->harga_tidak_kosong->viewAttributes() ?>>
<?= $Page->harga_tidak_kosong->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->berat_tidak_kosong->Visible) { // berat_tidak_kosong ?>
        <td <?= $Page->berat_tidak_kosong->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_berat_tidak_kosong" class="kumkm_market_berat_tidak_kosong">
<span<?= $Page->berat_tidak_kosong->viewAttributes() ?>>
<?= $Page->berat_tidak_kosong->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_berat->Visible) { // produk_berat ?>
        <td <?= $Page->produk_berat->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_berat" class="kumkm_market_produk_berat">
<span<?= $Page->produk_berat->viewAttributes() ?>>
<?= $Page->produk_berat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_panjang->Visible) { // produk_panjang ?>
        <td <?= $Page->produk_panjang->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_panjang" class="kumkm_market_produk_panjang">
<span<?= $Page->produk_panjang->viewAttributes() ?>>
<?= $Page->produk_panjang->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_lebar->Visible) { // produk_lebar ?>
        <td <?= $Page->produk_lebar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_lebar" class="kumkm_market_produk_lebar">
<span<?= $Page->produk_lebar->viewAttributes() ?>>
<?= $Page->produk_lebar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_tinggi->Visible) { // produk_tinggi ?>
        <td <?= $Page->produk_tinggi->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_tinggi" class="kumkm_market_produk_tinggi">
<span<?= $Page->produk_tinggi->viewAttributes() ?>>
<?= $Page->produk_tinggi->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_harga_dasar->Visible) { // produk_harga_dasar ?>
        <td <?= $Page->produk_harga_dasar->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_harga_dasar" class="kumkm_market_produk_harga_dasar">
<span<?= $Page->produk_harga_dasar->viewAttributes() ?>>
<?= $Page->produk_harga_dasar->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_foto_1->Visible) { // produk_foto_1 ?>
        <td <?= $Page->produk_foto_1->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_foto_1" class="kumkm_market_produk_foto_1">
<span>
<?= GetFileViewTag($Page->produk_foto_1, $Page->produk_foto_1->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_foto_2->Visible) { // produk_foto_2 ?>
        <td <?= $Page->produk_foto_2->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_foto_2" class="kumkm_market_produk_foto_2">
<span>
<?= GetFileViewTag($Page->produk_foto_2, $Page->produk_foto_2->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->produk_foto_3->Visible) { // produk_foto_3 ?>
        <td <?= $Page->produk_foto_3->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_produk_foto_3" class="kumkm_market_produk_foto_3">
<span>
<?= GetFileViewTag($Page->produk_foto_3, $Page->produk_foto_3->getViewValue(), false) ?>
</span>
</span>
</td>
<?php } ?>
<?php if ($Page->market->Visible) { // market ?>
        <td <?= $Page->market->cellAttributes() ?>>
<span id="el<?= $Page->RowCount ?>_kumkm_market_market" class="kumkm_market_market">
<span<?= $Page->market->viewAttributes() ?>>
<?= $Page->market->getViewValue() ?></span>
</span>
</td>
<?php } ?>
    </tr>
<?php
    $Page->Recordset->moveNext();
}
$Page->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?= $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?= HtmlEncode(GetUrl($Page->getReturnUrl())) ?>"><?= $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$Page->showPageFooter();
echo GetDebugMessage();
?>
<script>
loadjs.ready("load", function () {
    // Write your table-specific startup script here, no need to add script tags.
});
</script>
