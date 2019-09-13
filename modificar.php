<?php


if ($_GET){
                   $enlace = mysqli_connect("localhost", "root", "", "emergentes");
                $consulta= "UPDATE   entregas  SET pendiente= 'No' where id=".$_GET['id'];
                   $result = mysqli_query($enlace, $consulta);
                   header('Location: Mensajero.php');
}

?>