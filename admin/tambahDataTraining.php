<?php
	include('koneksi.php');
	$nama = $_POST['nama'];
	$ipk = $_POST['ipk'];
	$akademik = $_POST['akademik'];
	$iptek = $_POST['iptek'];
	$wawancara = $_POST['wawancara'];
	$klasifikasi = $_POST['klasifikasi'];
	
	$query = "INSERT into data_training (nama,ipk,akademik,iptek,wawancara,klasifikasi) 
	VALUES ('$nama','$ipk','$akademik','$iptek','$wawancara','$klasifikasi') 
	";
	$result = mysql_query($query);
	
	if($result){
		header("Location: input-data-latih.php");
	}else{
		echo "Input Gagal";
	}
?>