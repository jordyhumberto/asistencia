<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
}
$IDCO=$_POST['idco'];
$FECHA=$_POST['fecha'];
$check=$_POST['check'];
$N=count($check);
for ($i=0; $i < $N ; $i++) { 
    $sql="INSERT INTO Tbl_asistencia VALUES ('$IDCO','$check[$i]','$FECHA')";
    $result=$mysqli->query($sql);
}
header("Location: cursos.php");
?>