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
			<li class="active"><a href="input-data-latih.php">Data Training</a></li>
			<li ><a href="input-data-uji.php">Data Testing</a></li>
			<li ><a href="hasil-knn.php">Hasil Klasifikasi KNN</a></li>
			<li ><a href="perhitungan-wp.php">Perhitungan Weighted Product</a></li>
			<li ><a href="hasil-wp.php">Hasil Weighted Product</a></li>
      	</ul>
		
		<ul class="nav navbar-nav navbar-right">
		<li ><a href="logoff.php">Log Out</a></li>
		</ul>

	  </div><!-- /.container-fluid -->
	</nav>
	
  
    <h1 align="center">Sistem Penentuan Seleksi Pegawai Baru</h1>
    <h1 align="center"></h1>

<?php
	include('koneksi.php');
	
	$kvall = $_POST['k_vall'];
	 
	$query_k_del = "TRUNCATE TABLE nilai_k";
	mysql_query($query_k_del);
	
	$query_k = "INSERT into nilai_k (k) VALUES ('$kvall') ";
	mysql_query($query_k);
	
	
	$query = "SELECT COUNT(*) FROM data_training";
	$result = mysql_query($query);
	$query2 = "SELECT COUNT(*) FROM DATA_TESTING";
	$result2 = mysql_query($query2);
	
			$kelas1="Baik";
			$kelas2="Sedang";
			$kelas3="Buruk";
			
			$counterClass1=0;
			
			$counterClass2=0;
			
			
			$counterClass3=0;
	
	if($result AND $result2) {
		$banyak_data = mysql_result($result,0);
		//Mendapatkan total data training
		//echo ("Berapa total training: $banyak_data");
		$query_data = "SELECT * FROM data_training";
		$result_data = mysql_query($query_data);
		
		$banyak_data2 = mysql_result($result2,0);
		//Mendapatkan total data training
		//echo ("Berapa total training: $banyak_data2");
		$query_data2 = "SELECT * FROM data_testing";
		$result_data2 = mysql_query($query_data2);
	}

	//Mendapatkan total kolom data training
	$jmlh_kolom = mysql_num_fields($result_data);
	//echo ("Jumlah kolom: $jmlh_kolom");
	
	for($i=0;$i<$banyak_data2;$i++){
			
		for($j=0;$j<$banyak_data;$j++){
			
			$isi=0;
			for($z = 2; $z<$jmlh_kolom-1;$z++){
				//Mendapatkan fitur data training
				$data_train = mysql_result($result_data,$j,$z);
				//Mendapatkan fitur data testing
				$data_test = mysql_result($result_data2,$i,$z);
				//echo("$data_test");
				$isi=$isi+pow($data_train-$data_test,2);
				//echo $data_test;
			}
				
			${'eu'.$i}[$j]=sqrt($isi);
			//echo "euclidian [".$i."][".$j."] =".${'eu'.$i}[$j]."<br>";
		}
		
		//echo ("<br>");
	}
		
		//sorting data array yang berisi nilai euclidian
		for($i=0;$i<$banyak_data2;$i++){
			asort(${'eu'.$i}); 
			
			foreach(${'eu'.$i} as $x => $x_value) {
				 //echo $i." - Key=" . $x . ", Value=" . $x_value;
				 //echo "<br>";
				 ${'keys'.$i}[]= $x ;
				 ${'val'.$i}[]=$x_value;
			}
		}

		//MENAMPILKAN DATA SEBANYAK K.VALLUE DALAM KEADAAN SUDAH DISORTING
		//$sqldel = "DELETE FROM validitas_admin";
		//mysql_query($sqldel);
		
		for($k=0;$k<$banyak_data;$k++){
			$sumK=0;
			//$contoh =  mysql_result($result_data,0,7);
			for($l=0;$l<$kvall;$l++){
				//echo "hasil sorting : [".$k."][".${'keys'.$k}[$l]."] = ".${'val'.$k}[$l]."<br>";
				
				$id = mysql_result($result_data,$k,0);
				${'klasifikasi'.$l}[$k] = mysql_result($result_data,$k,6);
				
			}
			
			
		}

	?>
	

    <div class="form-horizontal">	
        <div class="form-group">
            <label class="col-sm-2 control-label">Nilai K</label>
            <div class="col-sm-1">
            <input class="form-control" value=" <?php echo $kvall ?>" readonly>
            </div>
			
        </div> 
			
		<div class="form-group">
			<label class="col-sm-2 control-label">Banyak Data </label>
			<div class="col-sm-1">
			<input class="form-control" value=" <?php echo $banyak_data ?>" readonly>
			</div>
		</div>   
    </div>
	
    <div>
		<h3 align="center">Tabel Euclidian</h3><br />
    </div>
	

	<div class="col-md-10 col-md-offset-1" style="height:350px;overflow:auto;">
      	<table class="table table-bordered">
          	<tbody>
            	<?php 
					echo "<tr>";
					echo "<th></th>";
					
					for($i=0;$i<$banyak_data;$i++){
						echo "<th>".$i."</th>";
					}
					echo "</tr>";
					
					for($i=0;$i<$banyak_data2;$i++){
						echo "<tr>";
						echo "<td>".$i."</td>";
						for($j=0;$j<$banyak_data;$j++){
							echo "<td>".${'eu'.$i}[$j]."</td>";
						}
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
			<h3 align="center">Hasil Sorting Euclidian | K = <?php echo $kvall ?></h3>
		</div>   
    </div>

	
	<div class="table-responsive col-md-8 col-md-offset-2" style="height:350px;overflow:auto;">
      	<table class="table table-bordered">
			<thead>
				<tr>
					<th>Array [DataTesting] [DataTraining]</th>
					<th>Jarak Euclidian</th>
					<th>Klasifikasi</th>
				</tr>
			</thead>
          	<tbody>
				<tr>
					
				<?php
				$query_klas_del = "TRUNCATE TABLE temp";
	mysql_query($query_klas_del);
	
					for($k=0;$k<$banyak_data2;$k++){
						for($l=0;$l<$kvall;$l++){
							echo "<tr>";
							echo "<td>"."[".$k."][".${'keys'.$k}[$l]."]"."</td>";
							echo "<td>".${'val'.$k}[$l]."</td>";
							echo "<td>".${'klasifikasi'.$l}[${'keys'.$k}[$l]]."</td>";
							echo "</tr>";
							//echo ${'keys'.$k}[$l];
							
				if(${'klasifikasi'.$l}[${'keys'.$k}[$l]] == $kelas1) {
				$counterClass1++;		
				}
				else if(${'klasifikasi'.$l}[${'keys'.$k}[$l]] == $kelas2) {
				$counterClass2++;
				}
				else { 
				$counterClass3++;
				}
						
						}
						
						if($counterClass1>$counterClass2 && $counterClass1>$counterClass3) {
						$query_klas1 = "insert into temp (klasifikasi) values ('$kelas1')";
					$result_klas1 = mysql_query($query_klas1);
						}
						else if($counterClass2>$counterClass1 && $counterClass2>$counterClass3) {
						$query_klas2 = "insert into temp (klasifikasi) values ('$kelas2')";
					$result_klas2 = mysql_query($query_klas2);
						}
						else if($counterClass3>$counterClass1 && $counterClass3>$counterClass2) {
						$query_klas3 = "insert into temp (klasifikasi) values ('$kelas3')";
					$result_klas3 = mysql_query($query_klas3);
						}
						
						$counterClass1=0;
						$counterClass2=0;
						$counterClass3=0;

					} 
		
				?>
					
					
				</tr>
			</tbody>
      	</table>
    </div>
	
	<div class="form-horizontal">	
        <div class="form-group">
            <label class="col-sm-2 control-label"> &nbsp </label>
        </div> 
		
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
	}
	?>