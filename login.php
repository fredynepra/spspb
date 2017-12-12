<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Penentuan Seleksi Pegawai Baru </title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

</head>

<body >
<br /><br /><br />	
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="login-panel panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center"><strong>Please Login</strong></h3>
                    </div>
                    <div class="panel-body" >
                    	<div align="center">
                            <!--
							<img src="img/Logo.png" class="img-responsive">
							-->
                            <h5><strong>SISTEM PENENTUAN SELEKSI PEGAWAI BARU </strong></h5>
                        	<h5><strong></strong></h5>
                            <hr class="small">
                        </div>
                        <div align="center">
                        
                        <?php
						//kode php ini kita gunakan untuk menampilkan pesan eror
						if (!empty($_GET['error'])) {
							if ($_GET['error'] == 1) {
								echo '<h3 class="bg-warning">Username dan Password belum diisi!</h3>';
							} else if ($_GET['error'] == 2) {
								echo '<h3 class="bg-warning">Username belum diisi!</h3>';
							} else if ($_GET['error'] == 3) {
								echo '<h3 class="bg-warning">Password belum diisi!</h3>';
							} else if ($_GET['error'] == 4) {
								echo '<h3 class="bg-warning">Username dan Password tidak terdaftar!</h3>';
							}
						}
						?>
                        </div>
                        <form role="form" action="loginCek.php" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Name" name="user" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button href="admin/index.php" class="btn btn-outline btn-success btn-block" type="submit">Login</button>
                                <a href="index.php" class="btn btn-outline btn-danger btn-block">Back</a>
                            </fieldset>
                        </form>
                        <div align="center">
                        	<hr class="small">
                            <h6><p class="text-muted">Developed by Fredy Nendra Pranata &copy; FILKOM Universitas Brawijaya 2016</p></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
