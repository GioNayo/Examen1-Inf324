<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="estilos.css" rel="stylesheet" type="text/css"/>
<title>FACULTAD DE CIENCIAS PURAS Y NATURALES</title>
		

</head>
	<body background="img/tm-astro-bg.jpg">
<?php
include 'conexionBD.php';
session_start();
if(isset($_SESSION["director_login"]))	
{
	header("location: directorAcceso.php");	
}
if(isset($_SESSION["estudiante_login"]))	
{
	header("location: index.php"); 
}
if(isset($_SESSION["docente_login"]))	
{
	header("location: index.php");
}

if(isset($_REQUEST['btn_login']))	
{
	$usuario =$_REQUEST["txt_usuario"];	
	$contra	=$_REQUEST["txt_contra"];	
		
	if(empty($usuario)){						
		$errorMsg[]="Por favor ingrese su Usuario";	
	}
	else if(empty($contra)){
		$errorMsg[]="Por favor ingrese Password";	
	}
	else if($usuario AND $contra)
	{
		try
		{   include 'conexionBD.php';
			$sql="select usuario ,password, rol 
					from acceso
					where usuario = '$usuario' and password = '$contra'";
			$resultado=mysqli_query($db,$sql);
			while($row=mysqli_fetch_array($resultado)){
				
				$dbusuario	=$row["usuario"];
				$dbcontra	=$row["password"];
                $dbrol	=$row["rol"];
			}
			if($usuario!=null AND $contra!=null )	
			{
				
					if($usuario==$dbusuario and $contra==$dbcontra)
					{
						switch($dbrol)		
						{
							case "director":
								$_SESSION["director_login"]=$usuario;			
								$loginMsg="docente: Inicio sesión con éxito";	
								header("refresh:1;directorAcceso.php");	
								break;
								
							case "estudiante";
								$_SESSION["estudiante_login"]=$usuario;				
								$loginMsg="Estudiante: Inicio sesión con éxito";		
								header("refresh:1;index.php");	
								break;
								
							case "docente":
								$_SESSION["docente_login"]=$usuario;				
								$loginMsg="Cliente: Inicio sesión con éxito";	
								header("refresh:1;index.php");		
								break;
								
							default:
								$errorMsg[]="usuario o contraseña o rol incorrectos";
						}
					}
					else
					{
						$errorMsg[]="usuario o contraseña o rol incorrectos";
					}
				
			}
			else
			{
				$errorMsg[]="usuario o contraseña o rol incorrectos";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
			
		}		
	}
	else
	{
		$errorMsg[]="usuario o contraseña o rol incorrectos";
	}
}
?>

	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		
		<?php
		if(isset($errorMsg))
		{
			foreach($errorMsg as $error)
			{
			?>
				<div class="alert alert-danger">
					<strong><?php echo $error; ?></strong>
				</div>
            <?php
			}
		}
		if(isset($loginMsg))
		{
		?>
			<div class="alert alert-success">
				<strong>ÉXITO ! <?php echo $loginMsg; ?></strong>
			</div>
        <?php
		}
		?> 


<div class="login-form">
	
<form method="post" class="form-horizontal">
	<center><h2>Inicio  de sesión</h2></center>
  <div class="form-group">
  <label class="col-sm-6 text-left">Usuario</label>
  <div class="col-sm-12">
  <input type="text" name="txt_usuario" class="form-control" placeholder="Ingrese Usuario" />
  </div>
  </div>
      
  <div class="form-group">
  <label class="col-sm-6 text-left">Password</label>
  <div class="col-sm-10">
  <input type="password" id="txt_contra" name="txt_contra" class="form-control" placeholder="Ingrese password" />
  </div>
  </div>

  
  <div class="form-group">
  <div class="col-sm-12">
  <input type="submit" name="btn_login" value="Iniciar Sesion">
  
  </div>
  </div>
      
</form>
</div>
<!--Cierra div login-->
		</div>
		
	</div>
			
	</div>
										
	</body>
</html>