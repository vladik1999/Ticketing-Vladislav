<!-- Vladislav Bogdanov -->
<!-- M09 - IAW - CURS 2019-2020 -->


<!DOCTYPE html>
<html lang="es">
<head>
  <title>INCIDENCIAS</title>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>

  <!--***********************************************************TOP***************************************************************-->

    <div class="hero-image">
     <div class="hero-text">
       <h1>INCIDENCIAS</h1>
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

    <center><h1>INCIDENCIAS</h1></center>

    <form method="POST" action="incidencies.php" >

      <div class="form-group">
        <label class="lab" for="id">ID(NULL O NUMERO EN CASO DE CREAR)</label>
        <input type="text" name="id" class="form-control" id="id">
      </div>

    <div class="form-group">
      <label class="lab" for="dat">FECHA</label>
      <input type="text" name="dat" class="form-control" id="dat">
    </div>

    <div class="form-group">
        <label class="lab" for="comp">COMPONENTE (Solo editable en creacion)</label>
        <input type="text" name="comp" class="form-control" id="comp" >
    </div>

    <div class="form-group">
        <label class="lab" for="aul">AULA (Solo editable en creacion)</label>
        <select name="aul" class="form-control" id="aul">
			<option value ="22">22</option>
			<option value ="24">24</option>
			<option value ="25">25</option>
		</select>
    </div>

    <div class="form-group">
        <label class="lab" for="desc">DESCRIPCION (Solo editable en creacion)</label>
        <input type="text" name="desc" class="form-control" id="desc" >
    </div>

    <div class="form-group">
       <label class="lab" for="est">ESTADO</label>
       <select name="est" class="form-control" id="est">
     <option value= "abierta">abierta</option>
     <option value= "cerrada">cerrada</option>
   </select>
   </div>

    <div class="form-group">
        <label class="lab" for="usr">USUARIO</label>
        <input type="text" name="usr" class="form-control" id="usr">
    </div>


    <center>
      <input type="submit" value="Registrar" class="btn btn-success" name="btn_registrar">
      <input type="submit" value="Consultar" class="btn btn-primary" name="btn_consultar">
      <input type="submit" value="Actualizar" class="btn btn-info" name="btn_actualizar">
      <input type="submit" value="Eliminar" class="btn btn-danger" name="btn_eliminar">
    </center>

  </form>

  <?php
    include("abrirc.php");

    //**********************************************************CONSULTAR******************************************************************-->


      if(isset($_POST['btn_consultar']))
      {
		 $dat =$_POST['dat'];
		 $x=0;
		 if($dat=="")
		 {
			 echo "CAMPO DE FECHA OBLIGATORIO";
		 }else
		 {
		  $resultados = mysqli_query($conexion,"SELECT * FROM incidencias WHERE fecha ='$dat'");
		  while($consulta = mysqli_fetch_array($resultados))
		  {
			echo $variable=$consulta['fecha']."<br>";
			echo $consulta['descripcion']."<br>";
			echo $consulta['usuario']."<br>";
			echo $consulta['estado']."<br><br>";

			$x++;
		  }
		  if($x==0){echo "No existe.";}
	  }
	}


  //*********************************************************REGISTRAR*******************************************************************-->

      $id    ="";
      $dat    ="";
      $comp    ="";
      $aul    ="";
      $desc    ="";
      $est    ="";
      $usr    ="";


  if(isset($_POST['btn_registrar']))
  {
    $id    =$_POST['id'];
    $dat    =$_POST['dat'];
    $comp    =$_POST['comp'];
    $aul    =$_POST['aul'];
    $desc    =$_POST['desc'];
    $est    =$_POST['est'];
    $usr    =$_POST['usr'];


 if($desc=="" || $usr=="" )
 {
   echo "CAMPOS DESCRIPCION Y USUARIO OBLIGATORIOS";
 }else
 {

//   session_start();
//   $miuser = $_SESSION['usuario'];


    mysqli_query($conexion, "INSERT INTO `incidencias` (`id`, `fecha`, `componente`, `aula`, `descripcion`, `estado`, `usuario`)
    VALUES ('$id', '$dat', '$comp',  '$aul', '$desc', '$est', '$usr')");
    echo "Se ha añadido correctamente a la base de datos."."<br>";

//    mysqli_close($conexion);

  }

}

//***************************************************************SOLO PUEDEN ADMINS*************************************************************-->

    session_start();




    $varsesion = $_SESSION['privilegio'];


    if($varsesion!= "Admin"){

        echo "<br>"."NO TIENES PERMISOS PARA MODIFICAR.";

        die();

    }


    //*******************************************************************ACTUALIZAR (fecha, componente='$comp',aula='$aul',descripcion='$desc' no editable)*********************************************************-->


      if(isset($_POST['btn_actualizar']))
      {
        $id    =$_POST['id'];
        $comp    =$_POST['comp'];
        $aul    =$_POST['aul'];
        $desc    =$_POST['desc'];
        $est    =$_POST['est'];
        $usr    =$_POST['usr'];


		 if($id=="")
		 {
			 echo "CAMPO DE IDENTIFICADOR OBLIGATORIO";
		 }else
		 {
			$X=0;
		  $resultados = mysqli_query($conexion,"SELECT * FROM incidencias WHERE id ='$id'");
		  while($consulta = mysqli_fetch_array($resultados))
		  {
			$x++;
		  }
		  if($x==0)
		  {
			echo "No existe";
		}else
		{
			$_UPDATE_SQL="UPDATE incidencias Set id='$id',estado='$est',usuario='$usr' WHERE id='$id'";
			mysqli_query($conexion,$_UPDATE_SQL);
			echo "ACTUALIZADO CORRECTAMENTE";
		}

      }
      }

      //*****************************************************************ELIMINAR***********************************************************-->


      if(isset($_POST['btn_eliminar']))
      {
       $id    =$_POST['id'];
		 $x=0;
		 if($id=="")
		 {
			 echo "CAMPO IDENTIFICADOR OBLIGATORIO";
		 }else
		 {
		  $resultados = mysqli_query($conexion,"SELECT * FROM incidencias WHERE id ='$id'");
		  while($consulta = mysqli_fetch_array($resultados))
		  {

			$x++;
		  }
		  if($x==0){echo "No existe";}
		  else
		  {
			   $_DELETE_SQL =  "DELETE FROM incidencias WHERE id = '$id'";
				mysqli_query($conexion,$_DELETE_SQL);
				echo "ELIMINADO CORRECTAMENTE";
		  }
	  }
      }

      mysqli_close($conexion);
  ?>

  </div>

  <div class="col-md-4"></div>
</div>

</body>
</html>
