<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Sistem Klasifikasi Gizi Balita</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

  </head>
  <body>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
			
        <ul class="nav navbar-nav" >
			<li ><a href="index.php">Home</a></li>
			<li ><a href="input-data-latih.php">Data Training</a></li>
			<li ><a href="input-data-uji.php">Data Testing</a></li>
			<li ><a href="hasil-knn.php">Hasil Klasifikasi KNN</a></li>
			<li class="active"><a href="perhitungan-wp.php">Perhitungan Weighted Product</a></li>
			<li ><a href="hasil-wp.php">Hasil Weighted Product</a></li>
      	</ul>
		
		<ul class="nav navbar-nav navbar-right">
		<li ><a href="logoff.php">Log Out</a></li>
		</ul>

	  </div><!-- /.container-fluid -->
	</nav>
	
	<h1 align="center">Sistem Penentuan Seleksi Pegawai Baru</h1>
    <h1 align="center"></h1>
	
    <br>
    <br>
	
		<h4 align="center">Ketentuan Bobot Setiap Kriteria</h4>
    <div class="table-responsive col-md-10 col-md-offset-1" style="height:230px;overflow:auto;">
      	<table class="table table-bordered">
         	<thead>
              	<tr>
                    <th>Kriteria</th>
                    <th>Bobot</th>
              	</tr>
          	</thead>
            
            <?php
               	//$c=0;
				include("koneksi.php");
				$sql = "SELECT * FROM pembobotan";
				$query = mysql_query($sql);
											
				$result = array(); 
				while ($data = mysql_fetch_array($query)){                                                          
            ?>
         
          	<tbody>
            	<tr>
                	<td><?php echo $data[0] ?></td>
                    <td><?php echo $data[1] ?></td>
                </tr>
			</tbody>
            <?php }          
			?>
      	</table>
    </div>
    
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<h4 align="center">Nilai Hasil W [j]</h4>
    <div class="table-responsive col-md-10 col-md-offset-1" style="height:230px;overflow:auto;">
      	<table class="table table-bordered">
         	<thead>
              	<tr>
                    <th>Kriteria</th>
                   <th>Bobot</th> 
              	</tr>
          	</thead>
            
            <?php
               	$c=1;
				$totalBobot=100;
				include("koneksi.php");
				$sql2 = "SELECT * FROM pembobotan";
				$query2 = mysql_query($sql2);			
				$result2 = array(); 
				
				while ($data2 = mysql_fetch_array($query2)){
            ?>
         
          	<tbody>
            	<tr>
                	<td><?php echo ("W$c") ?></td>
                   <td><?php echo $data2[1]/$totalBobot ?></td>
                </tr>
			</tbody>
            <?php 
			$c++;
			}  
			?>
      	</table>
    </div>
    
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<h4 align="center">Hasil Perhitungan S [i]</h4>
    <div class="table-responsive col-md-10 col-md-offset-1" style="height:350px;overflow:auto;">
      	<table class="table table-bordered">
         	<thead>
              	<tr>
                    <th>S [i]</th>
                   <th>Nilai</th>
              	</tr>
          	</thead>
            
            <?php
               	$c=1;
				$i=0; $j=2;
				$totalSi=0;
				include("koneksi.php");
				$sql3 = "SELECT * FROM DATA_TESTING";
				$query3 = mysql_query($sql3);							
				$result3 = array();
				
				while ($data3 = mysql_fetch_array($query3)){
					$S[$i]=((pow($data3[$j],0.1))*(pow($data3[$j+1],0.2))*(pow($data3[$j+2],0.35))*(pow($data3[$j+3],0.35)));
					$totalSi+=$S[$i];
            ?>
         
          	<tbody>
            	<tr>
                	<td><?php echo ("S$c") ?></td>
                   <td><?php echo $S[$i] ?></td>
                </tr>
			</tbody>
            <?php 
			$c++;
			$i++;

			}
			?>
      	</table>
    </div>
	<br />
	
	<br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
		<h4 align="center">Hasil Perhitungan V [i]</h4>
    <div class="table-responsive col-md-10 col-md-offset-1" style="height:350px;overflow:auto;">
      	<table class="table table-bordered">
         	<thead>
              	<tr>
                    <th>V [i]</th>
                   <th>Nilai</th>
              	</tr>
          	</thead>
            
            <?php
$query_klas_del = "TRUNCATE TABLE temp02";
	mysql_query($query_klas_del);
	
               	$c=1;
				$i=0; $j=2;
				include("koneksi.php");
				$sql4 = "SELECT * FROM DATA_TESTING";
				$query4 = mysql_query($sql4);							
				$result4 = array();
				
				while ($data4 = mysql_fetch_array($query4)){
					$S[$i]=((pow($data4[$j],0.1))*(pow($data4[$j+1],0.2))*(pow($data4[$j+2],0.35))*(pow($data4[$j+3],0.35)));
            ?>
         
          	<tbody>
            	<tr>
                	<td><?php echo ("V$c") ?></td>
                   <td><?php echo $S[$i]/$totalSi ?></td>
                </tr>
			</tbody>
            <?php 
			$query5 = "insert into temp02 (id, Vi) values ($c, $S[$i]/$totalSi)";
					$result5 = mysql_query($query5);
			$c++;
			$i++;
			
			}
			
			?>
      	</table>
    </div>
    
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>