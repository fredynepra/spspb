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
			<li ><a href="hasil-knn.php">Perhitungan KNN</a></li>
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
	
  
    <h1 align="center">Sistem Penentuan Seleksi Pegawai Baru</h1>
    <h1 align="center"></h1>
    
	<?php
		include("koneksi.php");
        $id = $_GET['id'];
		$sql = "SELECT * FROM data_training where id='$id'";
		$query = mysql_query($sql);
		while ($data = mysql_fetch_array($query)){
																                                                                            
    ?>
	<form class="form-horizontal col-sm-offset-2" method="post" action="updateDataTraining.php?id=<?php echo $id?>">
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nama</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="nama" value="<?php echo $data[1] ?>" required>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nilai IPK</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="ipk" value="<?php echo $data[2] ?>" required>
		</div>
	  </div>
      
      <div class="form-group">
		<label class="col-sm-2 control-label">Nilai Akademik</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="akademik" value="<?php echo $data[3] ?>" required>
		</div>
	  </div>
      <div class="form-group">
		<label class="col-sm-2 control-label">Nilai IPTEK</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="iptek" value="<?php echo $data[4] ?>" required>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Nilai Wawancara</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="wawancara" value="<?php echo $data[5] ?>" required>
		</div>
	  </div>
	  <div class="form-group">
		<label class="col-sm-2 control-label">Klasifikasi</label>
		<div class="col-sm-6">
		  <input class="form-control" id="" name="klasifikasi" value="<?php echo $data[6] ?>" required>
		</div>
	  </div>
      <div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
		  <button type="submit" class="btn btn-default">Update Data</button>
		</div>
	  </div>
	</form>
	<?php
	}
	?>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
	<?php
	}
	?>