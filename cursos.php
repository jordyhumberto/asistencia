<?php
session_start(); //Inicia una nueva sesión o reanuda la existente
require 'conexion.php'; //Agregamos el script de Conexión
if(!isset($_SESSION["id_usuario"])){
    header("Location: index.php");
}
$docente=$_SESSION["id_usuario"];
$sqlD="SELECT d.IDDocente AS docente FROM Tbl_docente AS d INNER JOIN Tbl_usuario_docente AS ud ON d.IDDocente=ud.IDDocente WHERE ud.IdUD='$docente'";
$resultD=$mysqli->query($sqlD);
$rowD=$resultD->fetch_array(MYSQLI_ASSOC);
$ID=$rowD['docente'];
$sql="SELECT co.IDCO AS idco,co.IDCursos AS idc,c.Descripcion AS curso,CONCAT(d.Nombres,' ',d.Apellidos) AS docente,s.Descripcion AS semestre FROM (((Tbl_curso_operativo AS co INNER JOIN Tbl_cursos AS c ON co.IDCursos=c.IDCursos) INNER JOIN Tbl_semestre AS s ON co.IDSemestre=s.IDSemestre)INNER JOIN tbl_docente AS d ON co.IDDocente=d.IDDocente) WHERE (s.IDSemestre=79 OR s.IDSemestre=80) AND d.IDDocente='$ID'";
$resultado=$mysqli->query($sql) or trigger_error($mysqli->error);
?>
<html lang="en">
<head>
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
	<link href="css/jquery.dataTables.min.css" rel="stylesheet">	
	<script src="js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Alfa+Slab+One|Ultra" rel="stylesheet">
	<script>
		$(document).ready(function(){
			$('#mitabla').DataTable({
				"order": [[1, "asc"]],
				"language":{
					"lengthMenu": "Mostrar _MENU_ registros por pagina",
					"info": "Mostrando pagina _PAGE_ de _PAGES_",
					"infoEmpty": "No hay registros disponibles",
					"infoFiltered": "(filtrada de _MAX_ registros)",
					"loadingRecords": "Cargando...",
					"processing":     "Procesando...",
					"search": "Buscar:",
					"zeroRecords":    "No se encontraron registros coincidentes",
					"paginate": {
						"next":       "Siguiente",
						"previous":   "Anterior"
					},					
				}
			});	
		});	
	</script>
</head>
</head>
<body>
<div class="cuerpo">
    <div class="logout">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
	<br>
    <div class="row table-responsive">
        <table class="display" id="mitabla">
            <thead>
                <tr>
                    <th>IDCO</th>
                    <th>IDCurso</th>
                    <th>Descripcion</th>
                    <th>Semestre</th>
                    <th>Ver</th>
                    <th>Reporte</th>
                </tr>    
            </thead>
            <tbody>
            <?php while ($row=$resultado->fetch_array(MYSQLI_ASSOC)) {?>
                <tr>
                    <td><?php echo $row['idco']?></td>
                    <td><?php echo $row['idc']?></td>
                    <td><?php echo $row['curso']?></td>
                    <td><?php echo $row['semestre']?></td>
                    <td><a href="alumnos.php?IDCO=<?php echo $row['idco'];?>" class="btn btn-success"><span class="glyphicon glyphicon-user"></span></a></td>
                    <td><a href="reporte.php?IDCO=<?php echo $row['idco'];?>" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
        <br>
    </div>
</div>
</body>
</html>