<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$Detail = &$Page;
?>
<?php  $id_tutorial = $_GET["b"];
		$sql = "SELECT * FROM kumkm_literasi WHERE id='$id_tutorial'";
		$rows =ExecuteRows($sql);
	 ?>
	 <?php foreach($rows as $row): ?>
	 <div class="container">
	 	<section class="mb-4">
	 		<img src="" class="img-fluid" alt="Responsive image">
	 	</section>

	 	<section class="mb-3">
	 		<div class="row">
	 			<div class="col-sm-6 text-left"><h6><?= $row["judul_artikel"]; ?></h6></div>
	 			<div class="col-sm-6 text-right"> <?= $row["subjenis"] ?>,<?= $row["tgl"] ?> </div>
	 		</div>
	 	</section>

	 	<section style="background-color:#ffffff; color:#351f39">
	 		<div class="px-3 py-2">
	 			<?= $row["isi_artikel"];?>
	 		</div>
	 	</section>
	
	 <?php endforeach;?>
	 <a class="px-2 py-1 mt-2 mb-2 btn btn-primary" href="panduanlist.php"> Kemabali .. </a>
	 </div>

<?= GetDebugMessage() ?>
