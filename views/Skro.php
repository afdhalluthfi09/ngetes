<?php

namespace PHPMaker2021\umkm_sidakui;

// Page object
$Skro = &$Page;
?>
<?php
	//echo "1 : " . $_SESSION[umkm_sidakui_status_UserProfile_UserName];
	//echo "2 : " . $_SESSION[umkm_sidakui_status_UserName];
	
?>

<?php
  include('koneksi.php');
  $sqlx = mysqli_query($dbcon,"SELECT * FROM cetak_profil_umkm WHERE  NIK='$_SESSION[umkm_sidakui_status_UserProfile_UserName]'");
  //echo "SELECT * FROM cetak_profilumkm WHERE  NIK='$_SESSION[umkm_sidakui_status_UserProfile_UserName]'";	
  while($r=mysqli_fetch_array($sqlx)){
  
	   echo"<b>$r[NAMA_USAHA]</b> | $r[NIK] | $r[NAMA_PEMILIK] | $r[NO_HP] <hr>";
		 
  } 
 

?>
<canvas id="myChart" style="width:200px"></canvas>
<table class="table ew-table" width="100%">
<thead>
<tr class="ew-table-header">
	<th class="ew-table-header-cell" >Uraian</th>
	<th class="ew-table-header-cell">Nilai</th>
</tr>
</thead>
<?php
  $no=1;
  $sqlx = mysqli_query($dbcon,"SELECT * FROM temp_trans_skor WHERE  NIK='$_SESSION[umkm_sidakui_status_UserProfile_UserName]'");
  //echo 	"SELECT * FROM temp_trans_skor WHERE  NIK='$_SESSION[umkm_sidakui_status_UserProfile_UserName]'";
  while($r=mysqli_fetch_array($sqlx)){
  
	   echo"<tr class='ew-table-row'>
			<td>$r[jenis_nilai]</td>
			<td>$r[nilai]</td>
		    </tr>";
		  $no++;
  } 
  echo"
  </tbody>";

?>

 
 </table>




<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>


<?php
	$sqlx = mysqli_query($dbcon,"SELECT * FROM temp_skor_kelas WHERE  NIK='$_SESSION[umkm_sidakui_status_UserProfile_UserName]'");
	
  $r=mysqli_fetch_array($sqlx);

?>

<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
	type: 'radar',
	data: {
		labels: ['PRODUKSI', 'PEMASARAN', 'PEMASARAN ONLINE', 'KELEMBAGAAN', 'KEUANGAN', 'SDM'],
		datasets: [{
			label: 'Kompetensi',
			data: [<?= "$r[skor_produksi],$r[skor_pemasaran],$r[skor_pemasaranonline],$r[skor_kelembagaan],$r[skor_keuangan],$r[skor_sdm]";?>],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(255, 206, 86, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
				'rgba(255, 99, 132, 1)',
				'rgba(54, 162, 235, 1)',
				'rgba(255, 206, 86, 1)',
				'rgba(75, 192, 192, 1)',
				'rgba(153, 102, 255, 1)',
				'rgba(255, 159, 64, 1)'
			],
			borderWidth: 1
		}]
	},
	options: {
		scales: {
			yAxes: [{
				ticks: {
					beginAtZero: true
				}
			}]
		}
	}
});
</script>

<?= GetDebugMessage() ?>
