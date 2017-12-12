<?php
	include('koneksi.php');
	
	$id=$_GET['id'];
	$nama = $_POST['nama'];
	$ipk = $_POST['ipk'];
	$akademik = $_POST['akademik'];
	$iptek = $_POST['iptek'];
	$wawancara = $_POST['wawancara'];
	$klasifikasi = $_POST['klasifikasi'];
	
	$query = "UPDATE data_training SET nama='$nama',ipk='$ipk',akademik='$akademik',iptek='$iptek',wawancara='$wawancara',
	klasifikasi='$klasifikasi'	
	WHERE id='$id'";
	$result = mysql_query($query);
	
	if($result){
		header("Location: input-data-latih.php");
	}else{
		echo "Input Gagal";
	}
?>