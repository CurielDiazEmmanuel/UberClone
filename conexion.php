<?php

$bdd_host="localhost";
$bdd_user="root";
$bdd_pass="";
$bdd_bdd="emergentes";


$con=mysqli_connect($bdd_host,$bdd_user,$bdd_pass,$bdd_bdd);

	if(mysqli_connect_errno()){

	printf("Conexion fallida: %s\n", mysqli_connect_error());

	exit();
	}

?>
