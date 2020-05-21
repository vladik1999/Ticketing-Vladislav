<!-- Vladislav Bogdanov -->
<!-- M09 - IAW - CURS 2019-2020 -->

<!--******************************************COMPRUEBA SESION******************************************************************-->

<?php session_start();
$varsesion = $_SESSION['privilegio'];

/*if($varsesion!='Admin'){
  echo 'No tienes privilegios para entrar aqui o no has introducido contraseña';
  die();
}
*/
?>

<!--****************************************************************************************************************************-->


<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
  <link rel="stylesheet" type="text/css" href="estilo.css">
  <meta charset="utf-8">

  <title>DASHBOARD TICKETING</title>

</head>
<body>

<!--***********************************************************TOP***************************************************************-->

  <div class="hero-image">
   <div class="hero-text">
     <h1>TICKETING - DASHBOARD</h1>
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

<table class="tablas">


<caption>TOTAL INCIDENCIAS</caption>

<th>ABIERTAS</th>
<th>CERRADAS</th>
<th>EN CURSO</th>

  <tr>

    <td><?php
include("abrirc.php");

//CONSULTA INCIDENCIAS ABIERTAS

    $porcentaje_abierto=mysqli_query($conexion, "select count(*) as total from incidencias where estado='abierta'");
    while($consulta = mysqli_fetch_array($porcentaje_abierto)){
      echo $consulta['total']."<br>";
    } ?></td>

    <td><?php
    //CONSULTA INCIDENCIAS CERRADAS

    $porcentaje_cerrado=mysqli_query($conexion, "select count(*) as total from incidencias where estado='cerrada'");
    while($consulta = mysqli_fetch_array($porcentaje_cerrado)){
      echo $consulta['total']."<br>";
    }?>

  </td>

    <td><?php //CONSULTA INCIDENCIAS EN CURSO

    $porcentaje_curso=mysqli_query($conexion, "select count(*) as total from incidencias where estado='en_curso'");
    while($consulta = mysqli_fetch_array($porcentaje_curso)){
      echo $consulta['total']."<br>";
    } ?></td>

  </tr>

</table>


<br>
<br>
<br>
<!-- ............................................................................................................................... -->


<table class="tablas">


<caption>PORCENTAJE DE INCIDENCIAS POR RESOLVER</caption>

<th>MEDIDA EN %</th>

  <tr>

    <td><?php
//CONSULTA INCIDENCIAS POR RESOLVER EN %
    $porcentaje_incidenciasabiertas=mysqli_query($conexion, "SELECT count(*)/(SELECT count(*) from incidencias)* 100 as percentage from incidencias where estado='abierta'");
    while($consulta = mysqli_fetch_array($porcentaje_incidenciasabiertas)){
      echo $consulta['percentage']."%";
    }?>

  </td>


  </tr>

</table>

<br>
<br>
<br>
<!-- ............................................................................................................................... -->



<table class="tablas">


<caption>PORCENTAJE DE INCIDENCIAS POR USUARIO</caption>

<th>USUARIO</th>
<th>MEDIDA EN %</th>


  <tr>

    <td><?php
    //CONSULTA INCIDENCIAS POR RESOLVER EN %

    $porcentaje_incidenciasporuser=mysqli_query($conexion, "SELECT usuario,count(*)/(SELECT count(*) from incidencias)* 100 as percentage from incidencias group by usuario");
    while($consulta = mysqli_fetch_array($porcentaje_incidenciasporuser)){
      echo $consulta['usuario']."<br>";
    }?>
  </td>

  <td><?php
  //CONSULTA INCIDENCIAS POR RESOLVER EN %

  $porcentaje_incidenciasporuser=mysqli_query($conexion, "SELECT usuario,count(*)/(SELECT count(*) from incidencias)* 100 as percentage from incidencias group by usuario");
  while($consulta = mysqli_fetch_array($porcentaje_incidenciasporuser)){
    echo $consulta['percentage']."<br>";
  }?>
</td>

  </tr>

</table>

<br>
<br>
<br>


<!-- ............................................................................................................................... -->


<table class="tablas">


<caption>TIPOS DE INCIDENCIAS</caption>

<th>INCIDENCIAS</th>


  <tr>
    <td><a>HARDWARE</a></td>
  </tr>
  <tr>
    <td><a>SOFTWARE</a></td>
  </tr>
  <tr>
    <td><a>ESTRUCTURAS</a></td>
  </tr>
  <tr>
    <td><a>ELECTRICO</a></td>
  </tr>
  <tr>
    <td><a>NATURALES</a></td>
  </tr>

</table>

<br>
<br>
<br>

<!-- CERRAMOS SESION MYSQL -->

<?php
mysqli_close($conexion);
?>

<!-- .....................................................FUENTES.......................................................................... -->


<table class="tablas">


<caption>FUENTES</caption>

<th>LINK</th>


  <tr>
    <td><a href="https://www.youtube.com/watch?v=hXgmuKgNkb0&t=722s">https://www.youtube.com/watch?v=hXgmuKgNkb0&t=722s</a></td>
  </tr>
  <tr>
    <td><a href="https://www.youtube.com/watch?v=IAL6Nq6FW0s&t=447s">https://www.youtube.com/watch?v=IAL6Nq6FW0s&t=447s</a></td>
  </tr>
  <tr>
    <td><a href="https://www.w3schools.com/php/default.asp">https://www.w3schools.com/php/default.asp</a></td>
  </tr>
  <tr>
    <td><a href="https://www.w3schools.com/php/php_date.asp">https://www.w3schools.com/php/php_date.asp</a></td>
  </tr>
  <tr>
    <td><a href="http://www.forosdelweb.com/f18/ayuda-guardar-datos-formulario-txt-812274/">http://www.forosdelweb.com/f18/ayuda-guardar-datos-formulario-txt-812274/</a></td>
  </tr>

</table>

<br>
<br>
<br>


</body>

</html>
