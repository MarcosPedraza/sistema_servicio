<?php
session_start();

require 'conexion.php';
require 'funcs.php';

if(!isset($_SESSION['id_usuario'])){
	header("Location: ../index.php");
}

if($_SESSION['TipoUsuario']==0){
	header("Location: ../logout.php");
}

$errors = array();

$consulta=ConsultarProducto($_GET['id']);

function ConsultarProducto($id_prod){

	global $mysqli;

	$verificar_usuario = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_usuario ='$id_prod'");

#$sentencia="SELECT * FROM usuarios WHERE id_usuario='$id_prod'";
#$resultado=mysql_query($sentencia);
	$filas=mysqli_fetch_array($verificar_usuario);
	return[
	$filas['id_usuario'],
	$filas['nombre'],
	$filas['apellidos'],
	$filas['usuario']
	];
}

if(!empty($_POST)){

	$id = $_GET['id'];
	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellidos = $mysqli->real_escape_string($_POST['apellidos']);
	$departamento = $mysqli->real_escape_string($_POST['departamento']);
	$reportes = $mysqli->real_escape_string($_POST['reportes']);
	$tipusuario = $mysqli->real_escape_string($_POST['tipusuario']);
	$usuario = $mysqli->real_escape_string($_POST['usuario']);

	if($departamento=='0'){
		$errors[] = "No selecciono departamento";
	}


	if(count($errors)==0){


		$registro = actualizarUsuario($id, $nombre, $apellidos, $departamento, $reportes, $tipusuario, $usuario);

		if($registro > 0){
			echo '<script>
			alert("El usuario se actualizo")
		</script>';
		header("location: administrador.php");
		
	} else{
		$errors[]="Error al registrar";
	}
}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Editar</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
	<script src="../js/bootstrap.min.js" ></script>
</head>
<body>

	<h1 align="center">Modificar Usuario</h1>
	<div class="container">
		<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Modificar</div>
				</div>

				<div class="panel-body" >

					<form id="signupform" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">

						<div id="signupalert" style="display:none" class="alert alert-danger">
							<p>Error:</p>
							<span></span>
						</div>

						<div class="form-group">
							<label for="nombre" class="col-md-3 control-label">Nombre:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $consulta[1]?>" required >
							</div>
						</div>

						<div class="form-group">
							<label for="apellidos" class="col-md-3 control-label">Apellidos:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php echo $consulta[2]?>" required >
							</div>
						</div>

						<div class="form-group">
							<label for="apellidos" class="col-md-3 control-label">Departamento:</label>
							<div class="col-md-9">
								<select class="form-control" name="departamento" value="">
									<option value="0">Seleccione:</option>
									<?php
									$query = $mysqli -> query ("SELECT * FROM departamentos");
									while ($valores = mysqli_fetch_array($query)) {
										echo '<option value="'.$valores['departamento'].'">'.$valores['departamento'].'</option>';
										if ($valores['departamento']) {
											$departamento=$valores['departamento'];
										}
										
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="tipousuario" class="col-md-3 control-label">Reportes:</label>
							<div class="col-md-9">
								<select class="form-control" name="reportes" >
									<option value="A">A</option>
									<option value="B">B</option>
									<option value="Ambos">Ambos</option>
									<?php
									if($reportes=="A"){
										echo $reportes = "A";}
										else if($reportes=="B"){
											echo $reportes = "B";
										}else {
											echo $reportes = "Ambos";
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="tipousuario" class="col-md-3 control-label">Tipo de usuario:</label>
								<div class="col-md-9">
									<select class="form-control" name="tipusuario">
										<option value="1">Administrador</option>
										<option value="0">Empleado</option>
										<?php
										if($tipusuario=="Administrador"){
											echo $tipusuario = "1";}
											else{
												echo $tipusuario = "0";
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="usuario" class="col-md-3 control-label">Usuario</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php echo $consulta[3]?>" required>
									</div>
								</div>


								<div class="form-group">
									<div class="col-md-offset-3 col-md-9">
										<button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
									</div>
								</div>
							</form>
							<?php echo resultBlock($errors); ?>
						</div>
					</div>
				</div>
			</div>

		</body>
		</html>