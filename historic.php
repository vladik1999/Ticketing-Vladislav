<!-- Vladislav Bogdanov -->
<!-- M09 - IAW - CURS 2019-2020 -->

<!--******************************************COMPRUEBA SESION******************************************************************-->

<?php session_start();
$varsesion = $_SESSION['privilegio'];

if($varsesion!='Admin'){
  echo 'No tienes privilegios para entrar aqui o no has introducido contraseña';
  die();
}

?>

<!--****************************************************************************************************************************-->


<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <meta charset="utf-8">

  <title>HISTORICO</title>

</head>
<body>

<!--***********************************************************TOP***************************************************************-->

  <div class="hero-image">
   <div class="hero-text">
     <h1>HISTORICO - DASHBOARD</h1>
     <p>Vladislav Bogdanov - M09 - IAW - CURS 2019-2020</p>
     <p>BIENVENIDO: <?php echo $_SESSION['privilegio']?></p>
   </div>
 </div>

<ul class="menus">
  <?php echo '<li><a href="dashboard.php">INICI-DASHBOARD</a></li>'; ?>
  <?php echo '<li><a href="incidencies.php">INCIDENCIAS</a></li>'; ?>
  <?php echo '<li><a href="historic.php">HISTORICO</a></li>'; ?>
  <?php echo '<li><a href="admin.php">ADMIN</a></li>'; ?>
  <?php echo '<li><a href="close.php">CERRAR SESION</a></li>'; ?>


</ul>

<!--****************************************************************************************************************************-->


<?php

include("abrirc.php");

	if($resultado = mysqli_query($conexion, "SELECT * FROM incidencias WHERE estado ='cerrada'")){
		if(mysqli_num_rows($resultado) > 0){
			echo "<table border='1'>";
			echo "<tr>";
				echo "<th>id</th>";
				echo "<th>fecha</th>";
				echo "<th>componente</th>";
				echo "<th>aula</th>";
				echo "<th>descripcion</th>";
        echo "<th>estado</th>";
        echo "<th>usuario</th>";
			echo "</tr>";
			while($fila = mysqli_fetch_array($resultado)){
				echo "<tr>";
					echo "<td>" . $fila['id'] . "</td>";
					echo "<td>" . $fila['fecha'] . "</td>";
					echo "<td>" . $fila['componente'] . "</td>";
					echo "<td>" . $fila['aula'] . "</td>";
					echo "<td>" . $fila['descripcion'] . "</td>";
          echo "<td>" . $fila['estado'] . "</td>";
          echo "<td>" . $fila['usuario'] . "</td>";
				echo "</tr>";

				$file=fopen("historico.txt","w");
				fwrite($file,$fila['id']."".$fila['fecha']."".$fila['componente']."".$fila['aula']."".$fila['descripcion']."".$fila['estado']."".$fila['usuario']."&nbsp");

			}
			fclose($file);
			echo "</table>";
			 mysqli_free_result($resultado);
		}
}
 ?>

</body>
</html>
