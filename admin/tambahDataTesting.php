<?php
	include('koneksi.php');
	$nama = $_POST['nama'];
	$ipk = $_POST['ipk'];
	$akademik = $_POST['akademik'];
	$iptek = $_POST['iptek'];
	$wawancara = $_POST['wawancara'];
	
	$query = "INSERT into data_testing (nama,ipk,akademik,iptek,wawancara) 
	VALUES ('$nama','$ipk','$akademik','$iptek','$wawancara') 
	";
	$result = mysql_query($query);
	
	if($result){
		header("Location: input-data-uji.php");
	}else{
		echo "Input Gagal";
	}
?>