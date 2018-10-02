<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
}
#CONCAT(al.Nombres,' ',al.Apellido_paterno,' ',al.Apellido_materno) AS alumno,
$IDCO=$_GET['IDCO'];
#) INNER JOIN Tbl_alumno AS al ON mc.IDAlumno=al.IDAlumno)
$sqlM="SELECT a.IDCO AS operativo,a.IDMatricula AS matricula,al.IDAlumno AS ida,CONCAT(al.Nombres,' ',al.Apellido_paterno,' ',al.Apellido_materno) AS alumno,COUNT(a.AFecha) AS fecha FROM ((Tbl_asistencia AS a INNER JOIN Tbl_matricula_carrera AS mc ON a.IDMatricula=mc.IDMatricula) INNER JOIN Tbl_alumno AS al ON mc.IDAlumno=al.IDAlumno) WHERE a.IDCO='$IDCO' GROUP BY a.IDMatricula";
$resultadoM=$mysqli->query($sqlM) or trigger_error($mysqli->error);
$sqlA="SELECT FOUND_ROWS() AS fecha FROM Tbl_asistencia GROUP BY AFecha";
$resultadoA=$mysqli->query($sqlA);
$rowA=$resultadoA->fetch_array(MYSQLI_ASSOC);
$N=(int)$rowA['fecha'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="universidad, peruana, investigación, investigacion, negocios, upein, UPEIN">
  	<meta name="description" content="UPEIN! - Universidad Peruana de Invesitgacion y Negocios da la bienvenida a sus nuevos estudiantes">
	<title>Upein</title>
    <link href="img/favicon.ico" rel="shortcut icon" type="image/x-icon">
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-theme.css" rel="stylesheet">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>	
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Ultra" rel="stylesheet">
</head>
<body>
<div class="cuerpo">
    <form action="guardar.php" method="post">
        <input type="hidden" name="idco" value="<?php echo $IDCO?>">
        <div style="display:flex;justify-content:flex-end;">
            <a href="cursos.php" class="btn btn-warning">Regresar</a>&nbsp
        </div>
        <br>
        <div class="row table-responsive">
            <table class="table table-hover table-condensed table-bordered">
                <thead>
                    <tr>
                        <th>IDCO</th>
                        <th>Matricula</th>
                        <th>IDAlumno</th>
                        <th>Nombre</th>
                        <th>#Asistencias</th>
                        <th>%Asistencia</th>
                    </tr>    
                </thead>
                <tbody>
                <?php while ($rowM=$resultadoM->fetch_array(MYSQLI_ASSOC)) {?>
                    <tr>
                        <td><?php echo $rowM['operativo']?></td>
                        <td><?php echo $rowM['matricula']?></td>
                        <td><?php echo $rowM['ida']?></td>
                        <td><?php echo $rowM['alumno']?></td>
                        <td><?php echo $rowM['fecha']?></td>
                        <td>
                            <?php 
                                $p=($rowM['fecha']/$N)*100;
                                $p=round($p,1);
                                if ($p>=70) {
                                    echo "<span class='btn btn-success'>$p</span>";
                                }else if($p<70 & $p>50) {
                                    echo "<span class='btn btn-warning'>$p</span>";
                                }else{
                                    echo "<span class='btn btn-danger'>$p</span>";
                                }
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
</body>
</html>