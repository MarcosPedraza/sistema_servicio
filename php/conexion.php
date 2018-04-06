<?php

	$mysqli=new mysqli("localhost","root","Mike9593","servicio_db"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

	$mysqli->set_charset("utf8");

	if(mysqli_connect_error()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

?>
