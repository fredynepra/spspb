<?php
include ("koneksi.php");

$id = $_GET['id'];

$query = "DELETE FROM data_testing WHERE id='$id'";
$result = mysql_query($query);
header("Location: input-data-uji.php");  

?>