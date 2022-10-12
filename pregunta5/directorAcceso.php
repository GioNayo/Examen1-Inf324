<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>FACULTAD DE CIENCIAS PURAS Y NATURALES</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<link href="estilos.css" rel="stylesheet" type="text/css"/>

</head>
	<body background="img/tm-astro-bg.jpg">

	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		 
			<center>
				<h1 style="color:#FF0000">Pagina Administrativa Director</h1>
				
				<h3>
				<?php
				session_start();

				if(!isset($_SESSION['director_login']))	
				{
					header("location: ../login.php");  
				}

				if(isset($_SESSION['estudiante_login']))	
				{
					header("location: index.php");	
				}

				if(isset($_SESSION['prefesor_login']))	
				{
					header("location: profesor.php");
				}
				
				if(isset($_SESSION['director_login']))
				{
				?>
					<p style="color:#FF0000">Bienvenido</p>,
				<?php
						echo $_SESSION['director_login'];
				}
				?>
				</h3>
					
			</center>
			<a href="cerrar_sesion.php"><button  aria-hidden="true"></span> Cerrar Sesion</button></a>
            <hr>
		</div>
		
		<br><br><br>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center><h1> Promedios segun  departamentos.<h1></center>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped  ">
                                    <thead>
                                        <tr>
                                            <td>CHUQUISACA (CH)</td>
										    <td>LA PAZ (LP)</td>
										    <td>COCHABAMBA (CB)</td>
											<td>ORURO (OR)</td>
											<td>POTOSI (PT)</td>
											<td>TARIJA (TJ)</td>
											<td>SANTA CRUZ (SC)</td>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									include 'conexionBD.php';
									$sql="select 
												round(avg(case when xper.departamento='01' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) CH,
												round(avg(case when xper.departamento='02' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) LP, 
												round(avg(case when xper.departamento='03' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) CB, 
												round(avg(case when xper.departamento='04' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) RU, 
												round(avg(case when xper.departamento='05' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) PT, 
												round(avg(case when xper.departamento='06' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) TJ, 
												round(avg(case when xper.departamento='07' then (xins.nota1+xins.nota2+xins.nota3+xins.nota_final) end),2) SC
												from persona xper, inscripcion xins 
												where xper.ci=xins.ci_estudiante";
										$resultado=mysqli_query($db,$sql);
										while($filas=mysqli_fetch_array($resultado)){
											echo "</tr>";
											    echo "<td>".$filas['CH']."</td>";
											    echo "<td>".$filas['LP']."</td>";
												echo "<td>".$filas['CB']."</td>";
												echo "<td>".$filas['RU']."</td>";
												echo "<td>".$filas['PT']."</td>";
												echo "<td>".$filas['TJ']."</td>";
												echo "<td>".$filas['SC']."</td>";
											echo "</tr>";

											}
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
		
	</div>
			
	</div>
										
	</body>
</html>