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


$idUsuario = $_SESSION['id_usuario'];

$sql = "SELECT id_usuario, nombre FROM usuarios WHERE id_usuario = '$idUsuario'";
$result = $mysqli->query($sql);

$row = $result->fetch_assoc();

$bdusuarios="SELECT * FROM usuarios";
$resbdusuarios=$mysqli->query($bdusuarios);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Administrador</title>
	<link rel="stylesheet" href="../css/bootstrap.min.css" >
	<link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
	<script src="../js/bootstrap.min.js" ></script>

</head>
<body style="">

    <div class="container">

        <h1 align="right"><a href="logout.php" ><font size="4"> Cerrar sesion </font></a></h1>

        <h1><a href="#" class="active" ><?php echo 'Bienvenid@ '.utf8_decode($row['nombre']); ?></a></h1>

        <div class="table-responsive">
            <table class="table table-bordered table-hover table-condensed" align="center">
               <tr class="info" >
                   <th>Id</th>
                   <th>Nombre</th>
                   <th>Apellidos</th>
                   <th>Reportes permitidos</th>
                   <th>Tipo de usuario</th>
                   <th>Departamento</th>
                   <th>Usuario</th>
                   <th><a href="registro.php"><button type="button" class="btn btn-info">Nuevo Usuario</button></a></th>
                   <th><a href="#"><button type="button" class="btn btn-info">Agregar departamento</button></a></th>

               </tr>
               <?php
               while ($registroUsuario = $resbdusuarios->fetch_array(MYSQLI_BOTH)) {
                   
                   if ($registroUsuario['TipoUsuario']==1) {
                     $aux="Administrador";
                 }else{
                  $aux="Empleado";
              }

              echo "<tr>";
              echo "<td align='center'>"; echo $registroUsuario['id_usuario']; "</td>";
              echo "<td align='center'>"; echo $registroUsuario['nombre']; "</td>";
              echo "<td align='center'>"; echo $registroUsuario['apellidos']; "</td>";
              echo "<td align='center'>"; echo $registroUsuario['reportes']; "</td>";
              echo "<td align='center'>"; echo $aux; "</td>";
              echo "<td align='center'>"; echo $registroUsuario['departamentos']; "</td>";
              echo "<td align='center'>"; echo $registroUsuario['usuario']; "</td>";
              
              echo "<td align='center'><a href='editar.php?id=".$registroUsuario['id_usuario']."'><button type='button' class='btn btn-success'>Modificar</button></a></td>";
              echo "<td align='center'><a href='eliminar.php?id=".$registroUsuario['id_usuario']."'><button type='button' class='btn btn-danger'>Eliminar</button></a></td>";
              echo "</tr>";
              
          }

          ?>
      </table>


  </div>
</div>

</body>
</html>