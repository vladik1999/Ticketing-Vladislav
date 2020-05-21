<!-- Vladislav Bogdanov -->
<!-- M09 - IAW - CURS 2019-2020 -->

<?php
session_start();
$usuario=$_POST['usuario'];
$contrasena=$_POST['contrasena'];
include("abrirc.php");
$consulta="SELECT * FROM users WHERE usuario='$usuario' and contrasena='$contrasena'";
$resultado=mysqli_query($conexion, $consulta);

//if ($conexion>connect_errno) {
//  echo "fallo en conectar a db";
//  exit();
//}

while($row = mysqli_fetch_array($resultado)) {
  $privilegio=$row['privilegio'];
}

$_SESSION['privilegio'] = $privilegio;

$columnas=mysqli_num_rows($resultado);


if ($columnas>0) {
header("location:dashboard.php");

} else {
echo "Error en la autentificacion";
}

mysqli_free_result($resultado);

mysqli_close($conexion);
?>
