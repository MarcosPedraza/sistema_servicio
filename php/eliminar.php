<?php
session_start();

require 'conexion.php';
require 'funcs.php';

if(!isset($_SESSION['id_usuario'])){
	header("Location: ../index.php");
}

EliminarUsuario($_GET['id']);

function EliminarUsuario($id){

	global $mysqli;

	$sentencia="DELETE FROM usuarios WHERE id_usuario='$id' ";
	$resultado = mysqli_query($mysqli, $sentencia);
}
?>

<script type="text/javascript">
	alert("Usuario eliminado correctamente");
	window.location.href='administrador.php';
</script>
