<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
}
$IDCO=$_GET['IDCO'];
$sqlM="SELECT ca.IDCO AS idco,ca.IDMatricula AS idm,a.IDAlumno AS ida,CONCAT(a.Nombres,' ',a.Apellido_paterno,' ',a.Apellido_materno) AS alumno FROM ((Tbl_cursos_alumno AS ca INNER JOIN Tbl_matricula_carrera AS mc ON ca.IDMatricula=mc.IDMatricula) INNER JOIN Tbl_alumno AS a ON mc.IDAlumno=a.IDAlumno) WHERE ca.IDCO='$IDCO'";
$resultadoM=$mysqli->query($sqlM);
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
        <div style="display:flex;justify-content: space-between;">
            <div>
                <input type="date" name="fecha" id="fecha" value="<?php echo date("Y-m-d")?>" class="form-control">
            </div>
            <div>
                <a href="cursos.php" class="btn btn-warning">Regresar</a>&nbsp
                <input type="submit" class="btn btn-success">    
            </div>
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
                        <th>Asistencia</th>
                    </tr>    
                </thead>
                <tbody>
                <?php while ($rowM=$resultadoM->fetch_array(MYSQLI_ASSOC)) {?>
                    <tr>
                        <td><?php echo $rowM['idco']?></td>
                        <td><?php echo $rowM['idm']?></td>
                        <td><?php echo $rowM['ida']?></td>
                        <td><?php echo $rowM['alumno']?></td>
                        <td><input type="checkbox" name="check[]" value="<?php echo $rowM['idm'];?>"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
</div>
</body>
</html>