<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["login"])&& !isset($_SESSION["name"])){
	header('location:../login.php');
	}
	else{
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistem Penentuan Seleksi Pegawai Baru</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			
        <ul class="nav navbar-nav" >
			<li ><a href="index.php">Home</a></li>
			<li><a href="input-data-latih.php">Pelatihan</a></li>
			<li ><a href="input-data-uji.php">Klasifikasi Status Gizi</a></li>
			<li class="active"><a href="hasil-knn.php">Pengujian</a></li>
			<li><a href="perhitungan-wp.php">Tentukan K Value Optimal</a></li>
      	</ul>
		
		<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>  Setting <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="logoff.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  Log Off</a></li>
				</ul>
			</li>
		</ul>

	  </div><!-- /.container-fluid -->
	</nav>
	
  
    <h1 align="center">Klasifikasi Status Gizi Balita Banyak Data</h1>
    <h1 align="center"></h1>

    <?php
		
		include('koneksi.php');
		//banyak data training
		$query = "SELECT COUNT(*) FROM data_training";
		$result = mysql_query($query);
		if($result) {
			$banyak_data = mysql_result($result,0);
			//echo "banyak data training".$banyak_data."<br> ";
		}

		//banyak data testing
		$query_count_testing = "SELECT COUNT(*) FROM data_testing";
		$result_count_testing = mysql_query($query_count_testing);
		if($result_count_testing) {
			$banyak_data_testing = mysql_result($result_count_testing,0);
			//echo "banyak data testing=".$banyak_data_testing."<br> ";
		}

		$query_data = "SELECT * FROM data_training";
		$result_data = mysql_query($query_data);

		$query_data_testing = "SELECT * FROM data_testing";
		$result_data_testing = mysql_query($query_data_testing);

		//mengambil k=jumlah kolom data training
		$jmlh_kolom = mysql_num_fields($result_data);

		//mengambil k=jumlah kolom data testing
		$jmlh_kolom_testing = mysql_num_fields($result_data_testing);

		for($i=0;$i<$banyak_data_testing;$i++){
			
			for($j=0;$j<$banyak_data;$j++){
				$total=0;
				
				for($k=1;$k<$jmlh_kolom-1;$k++){
					$dataLatih = mysql_result($result_data,$j,$k);
					$dataTesting = mysql_result($result_data_testing,$i,$k);

					if ($dataLatih == "L"){
						$dataLatih = 1;
					}else if($dataLatih == "P"){
						$dataLatih=2;
					}

					if ($dataTesting == "L"){
						$dataTesting = 1;
					}else if($dataTesting == "P"){
						$dataTesting=2;
					}
					
					$total=$total+pow($dataTesting-$dataLatih,2);
				}
				
				$eu[$i][$j]=sqrt($total);
				//echo "euclidian [".$i."][".$j."] =".$eu[$i][$j]."<br>";
			}
		}
		//echo ("<br>");


		//menghitung weight voting
		$query_validitas = "SELECT * FROM validitas_admin";
		$result_validitas = mysql_query($query_validitas);
		for($i=0;$i<$banyak_data_testing;$i++){
			for($j=0;$j<$banyak_data;$j++){
				$validitas = mysql_result($result_validitas,$j,1);
				//echo "validitas =".$validitas."<br>";
				$euclidian = $eu[$i][$j];
				$w[$i][$j] = $validitas * (1/($euclidian+0.5));
				//echo"w ke[".($i+1)."][".($j+1)."] = ". $w[$i][$j]."<br>";
			}
		}
			//////////////////////////////////////////////////////////////////////////////////////////////////
		
		$query_k = "SELECT * FROM nilai_k";
		$result_k = mysql_query ($query_k);
		$kvall = mysql_result($result_k,0,0);
			
			
		//SORTING DATA ARRAY
		for($i=0;$i<$banyak_data_testing;$i++){
				arsort($w[$i]); 
				foreach($w[$i] as $x => $x_value) {
					//if ($x_value == 0) continue;
					 //echo $i." - Key=" . $x . ", Value=" . $x_value;
					 //echo "<br>";
					 $keys[$i][]= $x ;
					 $val[$i][]=$x_value;
				}
		}
			

		/* //MENAMPILKAN DATA DALAM KEADAAN SUDAH DISORTING
		for($i=0;$i<$banyak_data_testing;$i++){
			for($l=0;$l<$banyak_data;$l++){
				echo "hasil sorting w [".$i."][".$keys[$i][$l]."] = ".$val[$i][$l]."<br>";
				$status = mysql_result($result_data,$keys[$i][$l],5);
				echo $status."<br><br>";
			}
		}
			 */	
		//MENAMPILKAN DATA SEBANYAK K.VALLUE DALAM KEADAAN SUDAH DISORTING
		/* for($i=0;$i<$banyak_data_testing;$i++){
			for($l=0;$l<$kvall;$l++){
				echo "hasil sorting w sesuai k " .$kvall." = w [".$i."][".$keys[$i][$l]."] = ".$val[$i][$l]."<br>";
				$status = mysql_result($result_data,$keys[$i][$l],5);
				echo $status."<br><br>";
			}
		} */
		
		
		
		for($i=0;$i<$banyak_data_testing;$i++){

			$val_baik=0; $val_buruk=0; $val_kurang=0; $val_lebih=0;
			for($j=0;$j<$kvall;$j++){
				$status = mysql_result($result_data,$keys[$i][$j],5);
				if($status == "Gizi Lebih"){
					$val_lebih = $val_lebih+$val[$i][$j];
				}
				elseif($status == "Gizi Baik"){
					$val_baik = $val_baik+$val[$i][$j];
				}
				elseif($status == "Gizi Kurang"){
					$val_kurang = $val_kurang+$val[$i][$j];
				}
				elseif($status == "Gizi Buruk"){
					$val_buruk = $val_buruk+$val[$i][$j];
				}
			}
			/*
			echo "DATA TESTING ".$i."<br>";
			echo "lebih ".$val_lebih."<br>";
			echo "baik ".$val_baik."<br>";
			echo "kurang ".$val_kurang."<br>";
			echo "buruk ".$val_buruk."<br>";
*/
			if ($val_lebih>$val_baik && $val_lebih>$val_kurang && $val_lebih>$val_buruk	){
				$statusGisi[$i]="Gizi Lebih";
				//echo "Status awal = ".$statustest = mysql_result($result_data_testing,$i,5)."<br>";
				//echo "Klasifikasi = GIZI LEBIH<br><br>";
			}elseif ($val_baik>$val_lebih && $val_baik>$val_kurang && $val_baik>$val_buruk	){
				$statusGisi[$i]="Gizi Baik";
				//echo "Status awal = ".$statustest = mysql_result($result_data_testing,$i,5)."<br>";
				//echo "Klasifikasi = GIZI BAIK<br><br>";
			}elseif ($val_kurang>$val_baik && $val_kurang>$val_lebih && $val_kurang>$val_buruk	){
				$statusGisi[$i]="Gizi Kurang";
				//echo "Status awal = ".$statustest = mysql_result($result_data_testing,$i,5)."<br>";
				//echo "Klasifikasi = GIZI KURANG<br><br>";
			}elseif ($val_buruk>$val_baik && $val_buruk>$val_kurang && $val_buruk>$val_lebih	){
				$statusGisi[$i]="Gizi Buruk";
				//echo "Status awal = ".$statustest = mysql_result($result_data_testing,$i,5)."<br>";
				//echo "Klasifikasi = GIZI BURUK<br><br>";
			}
				
		}
		
		//hitung jumlah data  klasifikasi yang benar
		$jumlah_benar=0;
		$presentase=0;
		for($i=0;$i<$banyak_data_testing;$i++){
			$statustest = mysql_result($result_data_testing,$i,5);
			if($statusGisi[$i]==$statustest){
				$jumlah_benar=$jumlah_benar+1;
			}
		}
		
		$presentase=(($jumlah_benar/$banyak_data_testing)*100);
		
	?>
	
	<div class="form-horizontal">	
        <div class="form-group">
            <label class="col-sm-2 control-label">Nilai K</label>
            <div class="col-sm-1">
            <input class="form-control" value=" <?php echo $kvall ?>" readonly>
            </div>
        </div> 
			
		<div class="form-group">
			<label class="col-sm-2 control-label">Banyak Data Training </label>
			<div class="col-sm-1">
			<input class="form-control" value=" <?php echo $banyak_data ?>" readonly>
			</div>
		</div>   
		
		<div class="form-group">
			<label class="col-sm-2 control-label">Banyak Data Testing</label>
			<div class="col-sm-1">
			<input class="form-control" value=" <?php echo $banyak_data_testing ?>" readonly>
			</div>
		</div>  
    </div>
	
	<div class="form-horizontal">	
        <div class="form-group">
            <label class="col-sm-2 control-label"> &nbsp </label>
        </div> 
		
		<div class="form-group">
			<label class="col-sm-3 control-label">Tabel Hasil Klasifikasi Banyak Data</label>
		</div>   
    </div>
	
	<div class="col-md-10 col-md-offset-1" style="overflow:auto;">
      	<table class="table table-bordered">
          	<tbody>
            	<?php
					echo "<tr>";
						echo "<th>Nomer</th>";
						echo "<th>Kelas Prediksi Sistem</th>";
						echo "<th>Kelas Data Sesungguhnya</th>";
					echo "</tr>";
					
					for($i=0;$i<$banyak_data_testing;$i++){
						echo "<tr>";
						
							echo "<td>".($i+1)."</td>";
							echo "<td>".$statusGisi[$i]."</td>";
							echo "<td>".$statustest = mysql_result($result_data_testing,$i,5)."</td>";
						
						echo "</tr>";
					}
					
				?>
			</tbody>
      	</table>
    </div>
	
	<div class="form-horizontal">	
		<div class="form-group">
            <label class="col-sm-2 control-label"> &nbsp </label>
        </div> 
        <div class="form-group">
            <label class="col-sm-2 control-label">Data Benar</label>
            <div class="col-sm-1">
            <input class="form-control" value=" <?php echo $jumlah_benar ?>" readonly>
            </div>
        </div> 
			
		<div class="form-group">
			<label class="col-sm-2 control-label">Presentase Akurasi Sistem </label>
			<div class="col-sm-1">
			<input class="form-control" value=" <?php echo $presentase ?>" readonly>
			</div>
		</div>    
    </div>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
	}
	?>