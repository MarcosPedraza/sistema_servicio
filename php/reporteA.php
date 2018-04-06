<?php
session_start();

require '../fpdf/fpdf.php';
require 'conexion.php';
require 'funcs.php';

if(!isset($_SESSION['id_usuario'])){
	header("Location: ../index.php");
}


$idUsuario = $_SESSION['id_usuario'];

$empleado = ConsultarEmpleado($idUsuario);

function ConsultarEmpleado($idUsuario){

	global $mysqli;

  $verificar_usuario = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_usuario ='$idUsuario'");

  $filas=mysqli_fetch_array($verificar_usuario);
  return[
  $filas['id_usuario'],
  $filas['nombre'],
  $filas['apellidos'],
  $filas['reportes'],
  $filas['usuario'],
  $filas['departamentos']
  ];

}

if(!empty($_POST)){

  ini_set('date.timezone', 'America/Mexico_City');
  $time = date('Y-m-d, H:i:s', time());

  $campo1 = $mysqli->real_escape_string($_POST['campo1']);
  $campo2 = $mysqli->real_escape_string($_POST['campo2']);
  $campo3 = $mysqli->real_escape_string($_POST['campo3']);
  $campo4 = $mysqli->real_escape_string($_POST['campo4']);
  $campo5 = $mysqli->real_escape_string($_POST['campo5']);
  $nombre = $empleado[1];
  $apellidos = $empleado[2];
  $departamento = $empleado[5];
  $id_usuario = $empleado[0];

  $registro = registrarReporteA($campo1, $campo2, $campo3, $campo4, $campo5, $nombre, $apellidos, $departamento, $id_usuario, $time);

  if($registro > 0){
   
   echo "<script type='text/javascript'>
   alert('Usuario registrado exitosamente');
 </script>";

 header("location: empleado.php");
 
} else{
 $errors[]="Error al registrar";
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
            <div class="panel-title">Realizar reporte</div>
          </div>

          <div class="panel-body" >

            <form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

              <div id="signupalert" style="display:none" class="alert alert-danger">
                <p>Error:</p>
                <span></span>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Referencia de la ubicación del expediente o archivo magnético(4):</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo1" id="campo1" rows="5" value="<?php if(isset($campo1)) echo $campo1; ?>"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Clasificación, número de control del expediente nombre del archivo magnético(5):</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo2" rows="5" value="<?php if(isset($campo2)) echo $campo2; ?>"></textarea>
                </div>
              </div>
              
              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Descripción del expediente o archivo magnético(6):</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo3" rows="5" value="<?php if(isset($campo3)) echo $campo3; ?>"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Tomos(7):</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo4" rows="5" value="<?php if(isset($campo4)) echo $campo4; ?>"></textarea>
                </div>
              </div>

              <div class="form-group">
                <label for="nombre" class="col-md-3 control-label">Perido comprendido o fecha de elaboración(8):</label>
                <div class="col-md-9">
                  <textarea class="form-control" name="campo5" rows="5" value="<?php if(isset($campo5)) echo $campo5; ?>"></textarea>
                </div>
              </div>

              <div class="form-group">
                <div class="col-md-offset-3 col-md-9">
                  <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
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