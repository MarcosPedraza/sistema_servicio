<?php

  //include 'php/conexion.php';

	function isNull($nombre, $apellidos, $departamentos, $reportes, $tipusuario, $usuario, $password, $con_password){
		if(strlen(trim($nombre)) < 1 || sterlen(trim($apellidos)) < 1 || strlen(trim($departamentos)) < 1 || strlen(trim($reportes)) < 1 || strlen(trim($tipusuario)) < 1 || strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1 || strlen(trim($pass_con)) <1)
		{
			return true;
			} else {
			return false;
		}
	}

	function isEmail($email)
	{
		if (filter_var($email, FILTER_VALIDATE_EMAIL)){
			return true;
			} else {
			return false;
		}
	}

	function validaPassword($var1, $var2)
	{
		if (strcmp($var1, $var2) !== 0){
			return false;
			} else {
			return true;
		}
	}

	function minMax($min, $max, $valor){
		if(strlen(trim($valor)) < $min)
		{
			return true;
		}
		else if(strlen(trim($valor)) > $max)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function usuarioExiste($usuario)
	{
		global $mysqli;

	  $verificar_usuario = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE usuario ='$usuario'");

		if (mysqli_num_rows($verificar_usuario) > 0){
			return true;
			} else {
			return false;
		}
	}

	function emailExiste($email)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id FROM usuarios WHERE correo = ? LIMIT 1");
		$stmt->bind_param("s", $email);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;
		$stmt->close();

		if ($num > 0){
			return true;
			} else {
			return false;
		}
	}

	function generateToken()
	{
		$gen = md5(uniqid(mt_rand(), false));
		return $gen;
	}

	function hashPassword($password)
	{
		$hash = password_hash($password, PASSWORD_DEFAULT);
		return $hash;
	}

	function resultBlock($errors){
		if(count($errors) > 0)
		{
			echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";
			foreach($errors as $error)
			{
				echo "<li>".$error."</li>";
			}
			echo "</ul>";
			echo "</div>";
		}
	}

	function registraUsuario($nombre, $apellidos, $departamentos, $reportes, $tipusuario, $usuario, $password){

		global $mysqli;

		$stmt = "INSERT INTO usuarios (nombre, apellidos, departamentos, reportes, TipoUsuario, usuario, password) VALUES('$nombre', '$apellidos', '$departamentos', '$reportes', '$tipusuario', '$usuario', '$password')";

		$resultado = mysqli_query($mysqli, $stmt);
		if(!$resultado){
			echo '<script>
			alert("Error al registrar")
			</script>';
		} else{
			echo '<script>
			alert("El usuario se registro")
			</script>';
			header("location: administrador.php");
		}
	}

	function registrarReporteA($campo1, $campo2, $campo3, $campo4, $campo5, $nombre, $apellidos, $departamento, $id_usuario, $time){

		global $mysqli;

		$stmt = "INSERT INTO ReporteA (campo1, campo2, campo3, campo4, campo5, nombre, apellidos, departamento, id_usuario, fechaRegistro) VALUES('$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$nombre', '$apellidos', '$departamento', '$id_usuario', '$time')";

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

	function registrarReporteB($campo1, $campo2, $campo3, $campo4, $campo5, $id_usuario, $nombre, $apellidos, $departamento, $time){


		global $mysqli;

		$stmt = "INSERT INTO ReporteB (asunto, prioridad, fechaAtencion, unidadAd, situacion, id_usuario, nombre, apellidos, departamentos, fechaRegistro) VALUES('$campo1', '$campo2', '$campo3', '$campo4', '$campo5', '$id_usuario', '$nombre', '$apellidos', '$departamento', '$time')";

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

	function actualizarUsuario($id, $nombre, $apellidos, $departamentos, $reportes, $tipusuario, $usuario){

		global $mysqli;
        
        #$verificar_usuario = mysqli_query($mysqli, "SELECT * FROM usuarios WHERE id_usuario ='$id_prod'");

		$stmt = "UPDATE usuarios SET nombre= '$nombre', apellidos='$apellidos', departamentos='$departamentos', reportes='$reportes', TipoUsuario='$tipusuario', usuario='$usuario' WHERE id_usuario='$id'" ;
        
        $resultado = mysqli_query($mysqli, $stmt);
		if(!$resultado){
			echo '<script>
			alert("Error al registrar")
			</script>';
		} else{
			echo '<script>
			alert("El usuario se registro")
			</script>';
			header("location: administrador.php");
		}

    function actualizarReporteA($id, $campo1, $campo2, $campo3, $campo4, $campo5){

    	global $mysqli;

    	$stmt = "UPDATE ReporteA SET campo1= '$campo1', campo2='$campo2', campo3='$campo3', campo4='$campo4', campo5='$campo5' WHERE id_reporte='$id'" ;
        
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

	}

	function enviarEmail($email, $nombre, $asunto, $cuerpo){

		require_once 'PHPMailer/PHPMailerAutoload.php';

		$mail = new PHPMailer();
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'tipo de seguridad';
		$mail->Host = 'smtp.hosting.com';
		$mail->Port = 'puerto';

		$mail->Username = 'miemail@dominio.com';
		$mail->Password = 'password';

		$mail->setFrom('miemail@dominio.com', 'Sistema de Usuarios');
		$mail->addAddress($email, $nombre);

		$mail->Subject = $asunto;
		$mail->Body    = $cuerpo;
		$mail->IsHTML(true);

		if($mail->send())
		return true;
		else
		return false;
	}

	function validaIdToken($id, $token){
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token = ? LIMIT 1");
		$stmt->bind_param("is", $id, $token);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0) {
			$stmt->bind_result($activacion);
			$stmt->fetch();

			if($activacion == 1){
				$msg = "La cuenta ya se activo anteriormente.";
				} else {
				if(activarUsuario($id)){
					$msg = 'Cuenta activada.';
					} else {
					$msg = 'Error al Activar Cuenta';
				}
			}
			} else {
			$msg = 'No existe el registro para activar.';
		}
		return $msg;
	}

	function activarUsuario($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET activacion=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$result = $stmt->execute();
		$stmt->close();
		return $result;
	}

	function isNullLogin($usuario, $password){
		if(strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function login($usuario, $password)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT id_usuario, TipoUsuario, password FROM usuarios WHERE usuario = ? LIMIT 1");
		$stmt->bind_param("s", $usuario);
		$stmt->execute();
		$stmt->store_result();
		$rows = $stmt->num_rows;

		if($rows > 0) {

				$stmt->bind_result($id, $id_tipo, $passwd);
				$stmt->fetch();

				#$prueba='1234';

				#$validaPassw = password_verify($password, $passwd);

				if(password_verify($password, $passwd)){

					

					$_SESSION['id_usuario'] = $id;
					$_SESSION['TipoUsuario'] = $id_tipo;

					if($id_tipo == 1){
                       header("location: php/administrador.php");
					}
					else{
						header("location: php/empleado.php");
					}

					} else {

					$errors = "La contrase&ntilde;a es incorrecta";}
			} else {
			$errors = "El nombre de usuario no existe";
		}
		return $errors;
	}

	function lastSession($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET last_session=NOW(), token_password='', password_request=1 WHERE id = ?");
		$stmt->bind_param('s', $id);
		$stmt->execute();
		$stmt->close();
	}

	function isActivo($usuario)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE usuario = ? || correo = ? LIMIT 1");
		$stmt->bind_param('ss', $usuario, $usuario);
		$stmt->execute();
		$stmt->bind_result($activacion);
		$stmt->fetch();

		if ($activacion == 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function generaTokenPass($user_id)
	{
		global $mysqli;

		$token = generateToken();

		$stmt = $mysqli->prepare("UPDATE usuarios SET token_password=?, password_request=1 WHERE id = ?");
		$stmt->bind_param('ss', $token, $user_id);
		$stmt->execute();
		$stmt->close();

		return $token;
	}

	function getValor($campo, $campoWhere, $valor)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT $campo FROM usuarios WHERE $campoWhere = ? LIMIT 1");
		$stmt->bind_param('s', $valor);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($_campo);
			$stmt->fetch();
			return $_campo;
		}
		else
		{
			return null;
		}
	}

	function getPasswordRequest($id)
	{
		global $mysqli;

		$stmt = $mysqli->prepare("SELECT password_request FROM usuarios WHERE id = ?");
		$stmt->bind_param('i', $id);
		$stmt->execute();
		$stmt->bind_result($_id);
		$stmt->fetch();

		if ($_id == 1)
		{
			return true;
		}
		else
		{
			return null;
		}
	}

	function verificaTokenPass($user_id, $token){

		global $mysqli;

		$stmt = $mysqli->prepare("SELECT activacion FROM usuarios WHERE id = ? AND token_password = ? AND password_request = 1 LIMIT 1");
		$stmt->bind_param('is', $user_id, $token);
		$stmt->execute();
		$stmt->store_result();
		$num = $stmt->num_rows;

		if ($num > 0)
		{
			$stmt->bind_result($activacion);
			$stmt->fetch();
			if($activacion == 1)
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	function cambiaPassword($password, $user_id, $token){

		global $mysqli;

		$stmt = $mysqli->prepare("UPDATE usuarios SET password = ?, token_password='', password_request=0 WHERE id = ? AND token_password = ?");
		$stmt->bind_param('sis', $password, $user_id, $token);

		if($stmt->execute()){
			return true;
			} else {
			return false;
		}
	}
