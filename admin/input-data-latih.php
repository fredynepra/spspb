<!DOCTYPE html>
<?php
session_start();
if(!isset($_SESSION["login"])&& !isset($_SESSION["name"])){
	header('location:../login.php');
	}
	else{
?>
<?php
	include('koneksi.php');
	
	$query = "SELECT COUNT(*) FROM data_training";
	$result = mysql_query($query);
	if($result) {
		$banyak_data = mysql_result($result,0);
	}
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
			<li class="active"><a href="inputLatihAdmin.php">Data Training</a></li>
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
    
	
	<form class="form-horizontal" method="post" action="proses-pelatihan-datatesting.php">
	  <div class="form-group ">
		<label class="col-sm-1 control-label">Nilai K</label>
		<div class="col-sm-1 ">
		  <input class="form-control"  placeholder="Banyak K" name="k_vall" required>
		</div>
         <button type="reset" class="btn btn-warning" >Reset</button>
	  </div>
	 
      <div class="form-group">
		<div class=" col-sm-offset-1 col-sm-2">
		
		  <button type="submit" class="btn btn-primary btn-block">Mulai Pelatihan</button>
		</div>
	  </div>
	  <hr />
	</form>
				  <!-- Button trigger modal -->
		<button type="button" class="btn btn-success col-sm-offset-9 col-sm-2" data-toggle="modal" data-target="#myModal">
		  Input Data Training
		</button>

		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Input Data Pegawai</h4>
			  </div>
			  <form class="form-horizontal col-sm-offset-2" method="post" action="tambahDataTraining.php">
				<div class="modal-body">
				  <div class="form-group ">
					<label class="col-sm-4 control-label">Nama</label>
					<div class="col-sm-6 ">
					 <input class="form-control" id=" "name="nama" required>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-4 control-label">Nilai IPK</label>
					<div class="col-sm-6">
					  <input class="form-control" id="" name="ipk" required>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-sm-4 control-label">Nilai Akademik</label>
					<div class="col-sm-6">
					  <input class="form-control" id="" name="akademik" required>
					</div>
				  </div>
				  
				  <div class="form-group">
					<label class="col-sm-4 control-label">Nilai IPTEK</label>
					<div class="col-sm-6">
					  <input class="form-control" id="" name="iptek" required>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-4 control-label">Nilai Wawancara</label>
					<div class="col-sm-6">
					  <input class="form-control" id="" name="wawancara" required>
					</div>
				  </div>
				  <div class="form-group">
					<label class="col-sm-4 control-label">Klasifikasi</label>
					<div class="col-sm-6">
					  <input class="form-control" id="" name="klasifikasi" required>
					</div>
				  </div>

				</div>
				  <div class="modal-footer">
				  <button type="submit" class="btn btn-primary">Simpan</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
				  </div>
				</form>
			</div>
		  </div>
		</div>
	
    <br>
    <br><br />
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
					<th>Klasifikasi</th>
					<th>Edit Data</th>
              	</tr>
          	</thead>
            
            <?php
               	//$c=0;
				include("koneksi.php");
				$sql = "SELECT * FROM data_training";
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
					<td align="center" width="140">
						<a href="form-edit-datatraining.php?id=<?php echo $data[0] ?>" class="btn btn-success btn-sm">
							<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Edit
						</a>
						<a href="deleteDataTraining.php?id=<?php echo $data[0] ?>" class="btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del
						</a>
					</td>
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
<?php
	}
	?>