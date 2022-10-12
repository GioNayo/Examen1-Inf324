<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=2.0">
<title>FACULTAD DE CIENCIAS PURAS Y NATURALES</title>
		
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css"/>

</head>
	<body background="img/tm-astro-bg.jpg">

	
	<div class="wrapper">
	
	<div class="container">
			
		<div class="col-lg-12">
		 
			<center>
				<h1 style="color:#FF0000">Pagina  Director</h1>
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
					header("location: index.php");
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
			<a href="cerrar_sesion.php"><button  ><span  aria-hidden="true"></span> Cerrar Sesion</button></a>
            <hr>
		</div>
		
		<br><br><br>
		<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <center><h1> promedios segun los departamentos.<h1></center>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <td>CODIGO DEPARTAMENTO</td>
										    <td>PROM DE NOTAS</td>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									include 'conexionBD.php';
									$sql="SELECT xper.departamento,AVG(xins.nota1+xins.nota2+xins.nota3+xins.nota_final)promedio
										FROM inscripcion xins,persona xper
										where xins.ci_estudiante =xper.ci
										GROUP by xper.departamento";
										$resultado=mysqli_query($db,$sql);
										while($filas=mysqli_fetch_array($resultado)){
											echo "</tr>";
											if($filas['departamento']=='01')
											{
												echo "<td> CHUQUICADA  (".$filas['departamento'].")</td>";
											}
											else
											{
												if($filas['departamento']=='02')
												{
													echo "<td> LA PAZ  (".$filas['departamento'].")</td>";
												}
												else{
													if($filas['departamento']=='03')
													{
														echo "<td> COCHABAMBA  (".$filas['departamento'].")</td>";
													}
													else{
														if($filas['departamento']=='04')
														{
															echo "<td> ORURO  (".$filas['departamento'].")</td>";
														}
														else{
															if($filas['departamento']=='05')
															{
																echo "<td> POTOSI  (".$filas['departamento'].")</td>";
															}
															else{
																if($filas['departamento']=='06')
																{
																	echo "<td> TARIJA  (".$filas['departamento'].")</td>";
																}
																else{
																	if($filas['departamento']=='07')
																	{
																		echo "<td> SANTA CRUZ  (".$filas['departamento'].")</td>";
																	}
																}
															}
														}
													}
												}
											}
											echo "<td>".$filas['promedio']."</td>";
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