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
			<li ><a href="perhitungan-wp.php">Perhitungan Weighted Product</a></li>
			<li class="active"><a href="hasil-wp.php">Hasil Weighted Product</a></li>
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
	
	
	<div>
		<h3 align="center">Hasil Klasifikasi Data Testing</h3><br /> 
    </div>
    <div class="table-responsive col-md-10 col-md-offset-1" style="height:350px;overflow:auto;">
      	<table class="table table-bordered">
         	<thead>
              	<tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Nilai IPK</th>
                    <th>Nilai Akademik</th>
                    <th>Nilai IPTEK</th>
                    <th>Nilai Wawancara</th>
					<th>Vi</th>
					<th>Klasifikasi</th>
              	</tr>
          	</thead>
            
            <?php
               	//$c=0;
				include("koneksi.php");
				$sql = "SELECT ts.id, ts.nama, ts.ipk, ts.akademik, ts.iptek, ts.wawancara, tm2.Vi, tm.klasifikasi FROM 
				data_testing ts, temp tm, temp02 tm2 where ts.id=tm.id AND tm.klasifikasi='Baik' AND tm.id=tm2.id ORDER BY tm2.Vi desc";
				$query = mysql_query($sql);
											
				$result = array(); 
				while ($data = mysql_fetch_array($query)){                                                          
            ?>
         
          	<tbody>
            	<tr>
                	<td><?php echo $data[0] ?></td>
                    <td><?php echo $data[1] ?></td>
                    <td><?php echo $data[2] ?></td>
                    <td><?php echo $data[3] ?></td>
                    <td><?php echo $data[4] ?></td>
                    <td><?php echo $data[5] ?></td>
					<td><?php echo $data[6] ?></td>
					<td><?php echo $data[7] ?></td>
                </tr>
			</tbody>
            <?php }          
			?>
      	</table>
    </div>
    

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>