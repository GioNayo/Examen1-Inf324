<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<link rel="stylesheet" href="css/font-awesome.min.css">
  <link rel="stylesheet" href="css/style.css">
<title>FACULTAD DE CIENCIAS PURAS Y NATURALES</title>
		
<style type="text/css">
	.login-form {
		width: 340px;
    	margin: 20px auto;
	}
    .login-form form {
    	margin-bottom: 15px;
        background: #f7f7f7;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
        padding: 30px;
    }
    .login-form h2 {
        margin: 0 0 15px;
    }
    .form-control, .btn {
        min-height: 38px;
        border-radius: 2px;
    }
    .btn {        
        font-size: 15px;
        font-weight: bold;
    }
</style>
</head>
	<body background="img/fondo2.jpg">
<?php
require_once 'conexionBD.php';
session_start();
if(isset($_SESSION["director_login"]))	
{
	header("location: index.php");	
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
		{   
			$select_stmt=$db->prepare("select usuario ,password, rol 
                                       from acceso
                                        where usuario = :uusuario and password = :ucontra"); 
			$select_stmt->bindValue(":uusuario",$usuario);
			$select_stmt->bindValue(":ucontra",$contra);	
			$select_stmt->execute();	//execute query	
			while($row=$select_stmt->fetch(PDO::FETCH_ASSOC))	
			{
				$dbusuario	=$row["usuario"];
				$dbcontra	=$row["password"];
                $dbrol	=$row["rol"];
			}
			if($usuario!=null AND $contra!=null )	
			{
				if($select_stmt->rowCount()>0)
				{
					if($usuario==$dbusuario and $contra==$dbcontra)
					{
						switch($dbrol)		
						{
							
								
							case "estudiante";
								$_SESSION["estudiante_login"]=$usuario;				
								$loginMsg="Estudiante: Inicio sesión con éxito";		
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
			else
			{
				$errorMsg[]="usuario o contraseña o rol incorrectos";
			}
		}
		catch(PDOException $e)
		{
			$e->getMessage();
			//echo 'Excepción capturada: ',  $e->getMessage(), "\n";
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
<center><h1>Inicio de  sesión</h1></center>

<form method="post" class="form-horizontal">
  <div class="form-group">
  <label class="col-sm-6 text-left">Usuario</label>
  <div class="col-sm-6">
  <input type="text" name="txt_usuario" class="form-control" placeholder="Ingrese Usuario" />
  </div>
  </div>
      
  <div class="form-group">
  <label class="col-sm-6 text-left">Password</label>
  <div class="col-sm-10">
  <input type="password" id="txt_contra" name="txt_contra" class="form-control" placeholder="Ingrese passowrd" />
  </div>
 


  
  <div class="form-group">
  <div class="col-sm-12">
  <input type="submit" name="btn_login" class="btn btn-success btn-block" value="Iniciar Sesion">
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