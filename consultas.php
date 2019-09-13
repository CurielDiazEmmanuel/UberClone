<?php

  session_start();
  require_once('vendor/autoload.php');
  require_once('App/Auth/Auth.php');
  $enlace = mysqli_connect("localhost", "root", "", "emergentes");

 ?>


<?php


if ($_GET){
                   $enlace = mysqli_connect("localhost", "root", "", "emergentes");
                $consulta= 'delete  from entregas where id='.$_GET['id'];
                   $result = mysqli_query($enlace, $consulta);
                   header('Location: Mensajero.php');
}



	
	if ($_POST) {                
        	$descripcion=$_POST['descripcion'];
        	$origen=$_POST['origen'];
        	$destino=$_POST['destino'];
        	$costo=$_POST['costo'];
          $dis=$_POST['distancia'];
          $mensajero=$_POST['mensajero'];
          $pendiente='si';
          

        $consulta="INSERT INTO entregas VALUES (14, 8,'{$descripcion}','{$origen}','{$destino}','{$dis}','{$costo}','{$mensajero}','{$pendiente}' )";
   
           



        $result = mysqli_query($enlace, $consulta);

        header('Location: Cliente.php');
 } 



         

?>