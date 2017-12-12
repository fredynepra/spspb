<?php
include ("koneksi.php");

$id = $_GET['id'];

$query = "DELETE FROM data_training WHERE id='$id'";
$result = mysql_query($query);
header("Location: input-data-latih.php");  

      
    


?>