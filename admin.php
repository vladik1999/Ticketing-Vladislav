<!-- Vladislav Bogdanov -->
<!-- M09 - IAW - CURS 2019-2020 -->

<?php session_start();
$varsesion = $_SESSION['privilegio'];

if($varsesion!='Admin'){
  echo 'No tienes privilegios para entrar aqui o no has introducido contraseña';
  die();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>ADMIN</title>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>

  <!--***********************************************************TOP***************************************************************-->

    <div class="hero-image">
     <div class="hero-text">
       <h1>ADMIN</h1>
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

<div class="divv">

  <div class="diva">

    <center><h1>ALTA/MODIFICACIÓN USUARIOS</h1></center>

    <form method="POST" action="admin.php" >

      <div class="form-group">
        <label class="lab" for="id">ID (A partir de ID "6")</label>
        <input type="text" name="id" class="form-control" id="id">
      </div>

      <div class="form-group">
          <label class="lab" for="usr">USUARIO</label>
          <input type="text" name="usr" class="form-control" id="usr">
      </div>

      <div class="form-group">
          <label class="lab" for="pass">CONTRASEÑA</label>
          <input type="password" name="pass" class="form-control" id="pass" >
      </div>

    <div class="form-group">
        <label class="lab" for="prv">PRIVILEGIO</label>
        <select name="prv" class="form-control" id="prv">
			<option value ="Normal">Normal</option>
			<option value ="Admin">Admin</option>
			<option value ="Bloqueado">Bloqueado</option>
		</select>
    </div>


    <center>
      <input type="submit" value="Registrar" class="btn btn-success" name="btn_registrar">
      <input type="submit" value="Modificar" class="btn btn-info" name="btn_actualizar">
    </center>

  </form>

<?php

include("abrirc.php");

  //*********************************************************REGISTRAR*******************************************************************-->

      $id    ="";
      $usr    ="";
      $pass    ="";
      $prv    ="";


  if(isset($_POST['btn_registrar']))
  {
    $id    =$_POST['id'];
    $usr    =$_POST['usr'];
    $pass    =$_POST['pass'];
    $prv    =$_POST['prv'];



 if($usr=="" || $pass=="" )
 {
   echo "CAMPOS USUARIO Y CONTRASEÑA OBLIGATORIOS";
 }else
 {

//   session_start();
//   $miuser = $_SESSION['usuario'];


    mysqli_query($conexion, "INSERT INTO `users` (`id`, `usuario`, `contrasena`, `privilegio`) VALUES
('$id', '$usr', '$pass', '$prv')");
    echo "Se ha añadido correctamente a la base de datos."."<br>";

//    mysqli_close($conexion);

  }

}



//*******************************************************************ACTUALIZAR (fecha, componente='$comp',aula='$aul',descripcion='$desc' no editable)*********************************************************-->


  if(isset($_POST['btn_actualizar']))
  {
    $id    =$_POST['id'];
    $usr    =$_POST['usr'];
    $pass    =$_POST['pass'];
    $prv    =$_POST['prv'];



 if($id=="")
 {
   echo "CAMPO DE IDENTIFICADOR OBLIGATORIO";
 }else
 {
  $X=0;
  $resultados = mysqli_query($conexion,"SELECT * FROM users WHERE id ='$id'");
  while($consulta = mysqli_fetch_array($resultados))
  {
  $x++;
  }
  if($x==0)
  {
  echo "No existe";
}else
{
  $_UPDATE_SQL="UPDATE users Set id='$id',usuario='$usr',contrasena='$pass',privilegio='$prv' WHERE id='$id'";
  mysqli_query($conexion,$_UPDATE_SQL);
  echo "ACTUALIZADO CORRECTAMENTE";


}

  }
  }



mysqli_close($conexion);

?>
</body>
</html>
