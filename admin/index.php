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
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="input-data-latih.php">Data Training</a></li>
			<li ><a href="input-data-uji.php">Data Testing</a></li>
			<li ><a href="hasil-knn.php">Hasil Klasifikasi KNN</a></li>
			<li ><a href="perhitungan-wp.php">Perhitungan Weighted Product</a></li>
			<li ><a href="perhitungan-wp.php">Hasil Weighted Product</a></li>
      	</ul>
		
		<ul class="nav navbar-nav navbar-right">
		<li ><a href="logoff.php">Log Out</a></li>
		</ul>
		
	  </div><!-- /.container-fluid -->
	</nav>
	
  
    <h1 align="center">Sistem Penentuan Seleksi Pegawai Baru</h1>
	
    <h4 align="center"></h4>
    
	<BLOCKQUOTE> 
	<h3 align="center">Sistem ini merupakan penerapan metode KNN dan WP sebagai metode penentuan seleksi pegawai baru 
	untuk mendapatkan pegawai yang berkualitas pada sekolah SMK Muhammadiyah 2 Kediri
			</h3>
	</BLOCKQUOTE>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
<?php
	}
	?>