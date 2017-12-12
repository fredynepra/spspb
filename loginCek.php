<?php
include('koneksi.php');

//tangkap data dari form login
$username = $_POST['user'];
$password = $_POST['password'];

//untuk mencegah sql injection
//kita gunakan mysql_real_escape_string
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

//cek data yang dikirim, apakah kosong atau tidak
if (empty($username) && empty($password)) {
	//kalau username dan password kosong
	header('location:login.php?error=1');
	break;
} else if (empty($username)) {
	//kalau username saja yang kosong
	header('location:login.php?error=2');
	break;
} else if (empty($password)) {
	//kalau password saja yang kosong
	//redirect ke halaman index
	header('location:login.php?error=3');
	break;
}

$q = mysql_query("select * from admin where username='$username' and password='$password'");

if (mysql_num_rows($q) == 1) {
	//kalau username dan password sudah terdaftar di database
	header('location:Admin/index.php');
	session_start();
	$_SESSION["name"]= $username;
	$_SESSION["login"]=1;
} else {
	//kalau username ataupun password tidak terdaftar di database
	header('location:login.php?error=4');
}
?>