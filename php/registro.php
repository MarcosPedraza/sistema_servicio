<?php
session_start();

require 'conexion.php';
require 'funcs.php';

if(!isset($_SESSION['id_usuario'])){
	header("Location: ../index.php");
}

if($_SESSION['TipoUsuario']==0){
    header("Location: logout.php");
}

$errors = array();

if(!empty($_POST)){

	$nombre = $mysqli->real_escape_string($_POST['nombre']);
	$apellidos = $mysqli->real_escape_string($_POST['apellidos']);
	$departamento = $mysqli->real_escape_string($_POST['departamento']);
	$reportes = $mysqli->real_escape_string($_POST['reportes']);
	$tipusuario = $mysqli->real_escape_string($_POST['tipusuario']);
	$usuario = $mysqli->real_escape_string($_POST['usuario']);
	$password = $mysqli->real_escape_string($_POST['password']);
	$con_password = $mysqli->real_escape_string($_POST['con_password']);

	$activo = 0;
	$tipo_usuario = 2;
	$secret = '';

	 //if(isNull($nombre, $apellidos, $departamento, $reporteA, $reporteB, $tipusuario, $usuario, $password, $con_password)){
		 //$errors[]="Debe llenar todos los campos";}

	if(!validaPassword($password, $con_password)){
		$errors[] = "Las contraseñas no coinciden";
	}

	if($departamento=='0'){
		$errors[] = "No selecciono departamento";
	}

	if(usuarioExiste($usuario)){
		$errors[] = "El usuario $usuario ya existe";
	}

	if(count($errors)==0){
		$pass_hash = hashPassword($password);

		$registro = registraUsuario($nombre, $apellidos, $departamento, $reportes, $tipusuario, $usuario, $pass_hash);

		if($registro > 0){
			
			echo "<script type='text/javascript'>
			alert('Usuario registrado exitosamente');
		</script>";

		header("location: administrador.php");
		
	} else{
		$errors[]="Error al registrar";
	}
}
}
?>

<html>
<head>
	<title>Registro</title>

	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
	<script src="../js/bootstrap.min.js" ></script>
</head>

<body style="">
	<h1 align="center">Registrar Usuario</h1>
	<div class="container">
		<div id="signupbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
				<div class="panel-heading">
					<div class="panel-title">Registrar usuario</div>
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
								<input type="text" class="form-control" name="nombre" placeholder="Nombre" value="<?php if(isset($nombre)) echo $nombre; ?>" required >
							</div>
						</div>

						<div class="form-group">
							<label for="apellidos" class="col-md-3 control-label">Apellidos:</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="apellidos" placeholder="Apellidos" value="<?php if(isset($apellidos)) echo $apellidos; ?>" required >
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
								<select class="form-control" name="reportes" value="<?php if(isset($reportes)) echo $reportes; ?>">
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
									<select class="form-control" name="tipusuario" value="<?php if(isset($tipusuario)) echo $tipusuario; ?>">
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
										<input type="text" class="form-control" name="usuario" placeholder="Usuario" value="<?php if(isset($usuario)) echo $usuario; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="password" class="col-md-3 control-label">Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="password" placeholder="Password" required>
									</div>
								</div>

								<div class="form-group">
									<label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
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
