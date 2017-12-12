<?php
	include('koneksi.php');
	
	$id=$_GET['id'];
	$nama = $_POST['nama'];
	$ipk = $_POST['ipk'];
	$akademik = $_POST['akademik'];
	$iptek = $_POST['iptek'];
	$wawancara = $_POST['wawancara'];
	
	$query = "UPDATE data_testing SET nama='$nama',ipk='$ipk',akademik='$akademik',iptek='$iptek',wawancara='$wawancara'
	WHERE id='$id'";
	$result = mysql_query($query);
	
	if($result){
		header("Location: input-data-uji.php");
	}else{
		echo "Input Gagal";
	}
?>