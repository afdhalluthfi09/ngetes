<?php

namespace PHPMaker2021\umkm_sidakui;

// Table
$umkm_datadiri = Container("umkm_datadiri");
?>
<?php if ($umkm_datadiri->Visible) { ?>
<div class="ew-master-div">
<table id="tbl_umkm_datadirimaster" class="table ew-view-table ew-master-table ew-vertical">
    <tbody>
<?php if ($umkm_datadiri->NIK->Visible) { // NIK ?>
        <tr id="r_NIK">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->NIK->caption() ?></td>
            <td <?= $umkm_datadiri->NIK->cellAttributes() ?>>
<span id="el_umkm_datadiri_NIK">
<span<?= $umkm_datadiri->NIK->viewAttributes() ?>><?= Barcode()->show('', 'QRCODE', 100) ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->NAMA_PEMILIK->Visible) { // NAMA_PEMILIK ?>
        <tr id="r_NAMA_PEMILIK">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->NAMA_PEMILIK->caption() ?></td>
            <td <?= $umkm_datadiri->NAMA_PEMILIK->cellAttributes() ?>>
<span id="el_umkm_datadiri_NAMA_PEMILIK">
<span<?= $umkm_datadiri->NAMA_PEMILIK->viewAttributes() ?>>
<?= $umkm_datadiri->NAMA_PEMILIK->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->JENIS_KELAMIN->Visible) { // JENIS_KELAMIN ?>
        <tr id="r_JENIS_KELAMIN">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->JENIS_KELAMIN->caption() ?></td>
            <td <?= $umkm_datadiri->JENIS_KELAMIN->cellAttributes() ?>>
<span id="el_umkm_datadiri_JENIS_KELAMIN">
<span<?= $umkm_datadiri->JENIS_KELAMIN->viewAttributes() ?>>
<?= $umkm_datadiri->JENIS_KELAMIN->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->NO_HP->Visible) { // NO_HP ?>
        <tr id="r_NO_HP">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->NO_HP->caption() ?></td>
            <td <?= $umkm_datadiri->NO_HP->cellAttributes() ?>>
<span id="el_umkm_datadiri_NO_HP">
<span<?= $umkm_datadiri->NO_HP->viewAttributes() ?>>
<?= $umkm_datadiri->NO_HP->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->ALAMAT->Visible) { // ALAMAT ?>
        <tr id="r_ALAMAT">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->ALAMAT->caption() ?></td>
            <td <?= $umkm_datadiri->ALAMAT->cellAttributes() ?>>
<span id="el_umkm_datadiri_ALAMAT">
<span<?= $umkm_datadiri->ALAMAT->viewAttributes() ?>>
<?= $umkm_datadiri->ALAMAT->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->KAPANEWON->Visible) { // KAPANEWON ?>
        <tr id="r_KAPANEWON">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->KAPANEWON->caption() ?></td>
            <td <?= $umkm_datadiri->KAPANEWON->cellAttributes() ?>>
<span id="el_umkm_datadiri_KAPANEWON">
<span<?= $umkm_datadiri->KAPANEWON->viewAttributes() ?>>
<?= $umkm_datadiri->KAPANEWON->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->KALURAHAN->Visible) { // KALURAHAN ?>
        <tr id="r_KALURAHAN">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->KALURAHAN->caption() ?></td>
            <td <?= $umkm_datadiri->KALURAHAN->cellAttributes() ?>>
<span id="el_umkm_datadiri_KALURAHAN">
<span<?= $umkm_datadiri->KALURAHAN->viewAttributes() ?>>
<?= $umkm_datadiri->KALURAHAN->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
<?php if ($umkm_datadiri->_EMAIL->Visible) { // EMAIL ?>
        <tr id="r__EMAIL">
            <td class="<?= $umkm_datadiri->TableLeftColumnClass ?>"><?= $umkm_datadiri->_EMAIL->caption() ?></td>
            <td <?= $umkm_datadiri->_EMAIL->cellAttributes() ?>>
<span id="el_umkm_datadiri__EMAIL">
<span<?= $umkm_datadiri->_EMAIL->viewAttributes() ?>>
<?= $umkm_datadiri->_EMAIL->getViewValue() ?></span>
</span>
</td>
        </tr>
<?php } ?>
    </tbody>
</table>
</div>
<?php } ?>
