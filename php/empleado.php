<?php
session_start();
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
$auxN = $empleado[2];

$bdReporteA="SELECT * FROM ReporteA WHERE id_usuario like '$idUsuario' ";
$ReporteA=$mysqli->query($bdReporteA);


$bdReporteB="SELECT * FROM ReporteB WHERE id_usuario like '$idUsuario' ";
$ReporteB=$mysqli->query($bdReporteB);

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

		<h1 align="right"><a href="logout.php" ><font size="4"> Cerrar sesion </font></a></h1>

		<h1><a href="#" class="active" ><?php echo 'Bienvenid@ '.$empleado[1]; ?></a></h1>



		<?php if($empleado[3]=='A'){ ?>
		<a> Reporte permitido A <a/>
			<br>
			<br>
			<div class="container">
				<div class="table-responsive">
					<table class="table table-bordered table-hover table-condensed" align="center">
						<tr class="info" >
							<th>Id</th>
							<th>Apellidos</th>
							<th>Departamento</th>
							<th>Fecha</th>
							<th colspan="2"><a href="reporteA.php"><button type="button" class="btn btn-info">Nuevo reporte</button></a></th>



						</tr>
						<?php
						while ($registroUsuario = $ReporteA->fetch_array(MYSQLI_BOTH)) {

							echo "<tr>";
							echo "<td align='center'>"; echo $registroUsuario['id_reporte']; "</td>";
							echo "<td align='center'>"; echo $registroUsuario['apellidos']; "</td>";
							echo "<td align='center'>"; echo $registroUsuario['departamento']; "</td>";
							echo "<td align='center'>"; echo $registroUsuario['fechaRegistro']; "</td>";

							echo "<td align='center'><a href='imprimirA.php'><button type='button' class='btn btn-success'>Imprimir</button></a></td>";
							echo "<td align='center'><a href='editaRepA.php?id=".$registroUsuario['id_reporte']."'><button type='button' class='btn btn-success'>Editar</button></a></td>";
							echo "</tr>";

						}

						?>
					</table>
				</div>
			</div>

			<?php } ?>

			<?php if($empleado[3]=='B'){ ?>
			<a> Reporte permitido b <a/>

				<br>
				<br>
				<div class="container">
					<div class="table-responsive">
						<table class="table table-bordered table-hover table-condensed" align="center">
							<tr class="info" >
								<th>Id</th>
								<th>Apellidos</th>
								<th>Departamento</th>
								<th>Fecha de registro</th>
								<th colspan="2"><a href="reporteB.php"><button type="button" class="btn btn-info">Nuevo reporte</button></a></th>
							</tr>
							<?php
							while ($registroUsuario = $ReporteB->fetch_array(MYSQLI_BOTH)) {

								echo "<tr>";
								echo "<td align='center'>"; echo $registroUsuario['id_reporte']; "</td>";
								echo "<td align='center'>"; echo $registroUsuario['apellidos']; "</td>";
								echo "<td align='center'>"; echo $registroUsuario['departamentos']; "</td>";
								echo "<td align='center'>"; echo $registroUsuario['fechaRegistro']; "</td>";

								echo "<td align='center'><a href='imprimirA.php'><button type='button' class='btn btn-success'>Imprimir</button></a></td>";
								echo "<td align='center'><a href='editaRepB.php?id=".$registroUsuario['id_reporte']."'><button type='button' class='btn btn-success'>Editar</button></a></td>";
								echo "</tr>";

							}

							?>
						</table>
					</div>
				</div>

				<?php } ?>

				<?php if($empleado[3]=="Ambos"){ ?>
				<a> Ambos reportes permitidos <a/>

					<br>
					<br>
					<div class="container">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-condensed" align="center">
								<tr class="info" >
									<th>Id</th>
									<th>Apellidos</th>
									<th>Departamento</th>
									<th>Fecha</th>
									<th colspan="2"><a href="reporteA.php"><button type="button" class="btn btn-info">Nuevo reporte</button></a></th>



								</tr>
								<?php
								while ($registroUsuario = $ReporteA->fetch_array(MYSQLI_BOTH)) {

									echo "<tr>";
									echo "<td align='center'>"; echo $registroUsuario['id_reporte']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['apellidos']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['departamento']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['fechaRegistro']; "</td>";

									echo "<td align='center'><a href='imprimirA.php'><button type='button' class='btn btn-success'>Imprimir</button></a></td>";
									echo "<td align='center'><a href='editaRepA.php?id=".$registroUsuario['id_reporte']."'><button type='button' class='btn btn-success'>Editar</button></a></td>";
									echo "</tr>";

								}

								?>
							</table>
						</div>
					</div>


					<br>
					<br>
					<div class="container">
						<div class="table-responsive">
							<table class="table table-bordered table-hover table-condensed" align="center">
								<tr class="info" >
									<th>Id</th>
									<th>Apellidos</th>
									<th>Departamento</th>
									<th>Fecha de registro</th>
									<th colspan="2"><a href="reporteB.php"><button type="button" class="btn btn-info">Nuevo reporte</button></a></th>
								</tr>
								<?php
								while ($registroUsuario = $ReporteB->fetch_array(MYSQLI_BOTH)) {

									echo "<tr>";
									echo "<td align='center'>"; echo $registroUsuario['id_reporte']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['apellidos']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['departamentos']; "</td>";
									echo "<td align='center'>"; echo $registroUsuario['fechaRegistro']; "</td>";

									echo "<td align='center'><a href='imprimirA.php'><button type='button' class='btn btn-success'>Imprimir</button></a></td>";
									echo "<td align='center'><a href='editaRepB.php?id=".$registroUsuario['id_reporte']."'><button type='button' class='btn btn-success'>Editar</button></a></td>";
									echo "</tr>";

								}

								?>
							</table>
						</div>
					</div>


					<?php } ?>

				</div>

			</body>
			</html>