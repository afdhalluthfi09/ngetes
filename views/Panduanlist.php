<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$Panduanlist = &$Page;
?>
<div class="container">
	<div class="row">
		<?php $sql = "SELECT * FROM kumkm_literasi";
			  $rows = ExecuteRows($sql);
			  foreach($rows as $row):
		 ?>
		 <div class="col-12 col-md-4 col-sm-6">
		 <div class="card">
		 	<div class="card-header">
		 		<?= $row["subjenis"]; ?>
		 	</div>
		 	<div class="card-body">
		 	<a href="detail.php?b=<?= $row["id"];?>">
		 		<h5 class="card-title"><?= $row["judul_artikel"]; ?></h5><br>
		 		<p class="card-text"> <?= substr($row["isi_artikel"],0,40).' ...'; ?> </p>
		 	</div>
		 	</a>
		 </div>
		 </div>
		 <?php endforeach; ?>
	</div>
</div>



<?= GetDebugMessage() ?>
