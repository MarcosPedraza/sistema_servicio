<?php
session_start();

require '../fpdf/fpdf.php';
require 'conexion.php';
require 'funcs.php';
#require_once("funcs.php");

if(!isset($_SESSION['id_usuario'])){
	header("Location: ../index.php");
}


$idReporte = $_GET['id'];

$Reporte = ConsultarEmpleado($idReporte);

function ConsultarEmpleado($idReporte){

	global $mysqli;

  $verificar_reporte = mysqli_query($mysqli, "SELECT * FROM ReporteB WHERE id_reporte ='$idReporte'");

  $filas=mysqli_fetch_array($verificar_reporte);
  return[
  $filas['id_reporte'],
  $filas['asunto'],
  $filas['prioridad'],
  $filas['fechaAtencion'],
  $filas['unidadAd'],
  $filas['situacion']
  ];

}

if(!empty($_POST)){

  ini_set('date.timezone', 'America/Mexico_City');

  $id=$_GET['id'];
  $campo1 = $mysqli->real_escape_string($_POST['campo1']);
  $campo2 = $mysqli->real_escape_string($_POST['campo2']);
  $campo3 = $mysqli->real_escape_string($_POST['campo3']);
  $campo4 = $mysqli->real_escape_string($_POST['campo4']);
  $campo5 = $mysqli->real_escape_string($_POST['campo5']);
  $time = date('Y-m-d, H:i:s', time());


    #$registro = actualizarReporteA($id, $campo1, $campo2, $campo3, $campo4, $campo5);
  
  $stmt = "UPDATE ReporteB SET asunto= '$campo1', prioridad='$campo2', fechaAtencion='$campo3', unidadAd='$campo4', situacion='$campo5', fechaRegistro='$time' WHERE id_reporte='$id'" ;

  $resultado = mysqli_query($mysqli, $stmt);
  if(!$resultado){
    echo '<script>
    alert("Error al registrar")
    </script>';
   } else{
   echo '<script>
   alert("El usuario se registro")
   </script>';
    header("location: empleado.php");
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Empleado</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
	<script src="../js/bootstrap.min.js" ></script>
</head>
<body>

  <div class="container">


    <h1 align="center">Reporte A</h1>
    <div class="container">
      <div id="signupbox" style="margin-top:50px" class="mainbox ">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="panel-title">Editar reporte</div>
          </div>

          <div class="panel-body" >

            <form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

              <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Asunto:</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo1" id="campo1" rows="5"><?php echo $Reporte[1]?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Prioridad:</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="campo2" placeholder="Prioridad" value="<?php echo $Reporte[1]?>" required >
                </div>
              </div>
              
              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Fecha de atencion :</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="campo3" placeholder="Fecha de atencion" value="<?php echo $Reporte[1]?>" required >
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Unidad administrativa responsable de la atención:</label>
                <div class="col-md-9">
                  <input type="text" class="form-control" name="campo4" placeholder="" value="<?php echo $Reporte[1]?>" required >
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Situación del trámite:</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo5" rows="5" value=""><?php echo $Reporte[1]?></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Actualizar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>

</body>
</html>