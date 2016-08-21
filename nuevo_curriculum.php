<?php
	SESSION_START();
	//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
	include('datos.php');
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = 'Nuevo Currículum';
	//Llamamos al css de contacto.
	$css = 'contacto.css';
	include ('funciones.php');
	$error = 0;
	if(isset($_POST['siguiente'])){
		validar();
	}

	if($_SESSION['user']){
		$user = $_SESSION['user'];
		
		if(empty($_SESSION['session'])){
			$_SESSION['session'] = 1;	
		}

		if(isset($_POST['refr'])){
			session_clear();
			header('location: #');
		}

		$consulta = "SELECT * FROM categorias";
		$result_set = mysqli_query($con, $consulta) or die("Error en la consulta");
		while($row = mysqli_fetch_row($result_set)){
			$IdCat[] = $row[0];
		}

		$totalcat = count($IdCat);

		$consulta = "SELECT * FROM estudios";
		$result_set = mysqli_query($con, $consulta) or die("Error en la consulta");
		while($row = mysqli_fetch_row($result_set)){
			$IdEst[] = $row[0];
		}

		$totalEst = count($IdEst);

		//Datos Personales
		@$nombre = $_SESSION['nombre'];
		@$apellidos = $_SESSION['apellidos'];
		@$fecha = $_SESSION['nacimiento'];
		@$direccion = $_SESSION['direccion'];
		@$telefono = $_SESSION['tel'];
		@$nacionalidad = $_SESSION['nacionalidad'];
		@$foto = $_SESSION['foto'];

		//Formación Reglada
		@$categoria = $_SESSION['categoria'];
		@$estudio = $_SESSION['estudio'];
		@$descripcion = $_SESSION['descripcion'];
		@$graduacion = $_SESSION['graduacion'];
		@$fechatit = $_SESSION['fechatit'];

		//Formación No Reglada
		@$tituloFN = $_SESSION['tituloFN'];
		@$descripcionFN = $_SESSION['descripcionFN'];
		@$tipoFN = $_SESSION['tipoFN'];
		

		//Hobbies
		@$NHobbie = $_SESSION['NHobbie'];
		@$DHobbie = $_SESSION['DHobbie'];
		
		switch($_SESSION['session']){
			case 1:
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Datos Personales';
				include('cabecera.php');		
?>
				<style>
					#primero{
						background-color: #376bb1;
						color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>
				<article id="cuerpo">
<?php
					desplegar_botones();
?>
					<div class="contenido">
						<table>
							<tr>
								<td><label for = "nombre">Nombre*: </label></td>
								<td><input type = "text" name="nombre" value="<?php echo $nombre ?>"></td>
							</tr>
							<tr>
								<td><label for = "apellidos" value="<?php echo $apellidos ?>">Apellidos*: </label></td>
								<td><input type = "text" name="apellidos"></td>
							</tr>
							<tr>
								<td><label for = "nacimiento" value="<?php echo $fecha ?>">Fecha Nacimiento*: </label></td>
								<td><input type = "text" name="nacimiento" placeholder="AAAA/MM/DD" ></td>
							</tr>
							<tr>
								<td><label for = "direccion">Dirección: </label></td>
								<td><input type = "text" name="direccion"></td>
							</tr>
							<tr>
								<td><label for = "tel">Teléfono: </label></td>
								<td><input type = "text" name="tel"></td>
							</tr>
							<tr>
								<td><label for = "nacionalidad">Nacionalidad*: </label></td>
								<td><input type = "text" name="nacionalidad"></td>
							</tr>
							<tr>
								<td><label for = "foto">Foto: </label></td>
								<td><input type = "file" name="foto"></td>
							</tr>
						</table>
						<br /><br />
						<form action="#" method="POST">
							<button name="siguiente">Siguiente</button>
						</form>
<?php

				if(isset($_POST['siguiente'])){
					if($error == 0){
						$_SESSION['session'] = 2;
						header('location: #');
					}else{
						echo 'Revisa los campos';
					}
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;

			case 2:
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Formación Reglada';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: #376bb1;
						color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>
				<article id="cuerpo">
<?php
					desplegar_botones();
?>
				
					<div class="contenido">
						<form action="#" method="POST">
						<table id="t011">
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria">
									<?php
										for($i = 0; $i < $totalcat; $i++){
											echo '<option value=' . $i . '>';
												switch ($IdCat[$i]) {
													case 1:
														echo 'Básico';
													break;
													case 2:
														echo 'Moda';
													break;
													case 3:
														echo 'Informática';
													break;
													case 4:
														echo 'Administración';
													break;
													case 5:
														echo 'Estética';
													break;
												}
											echo '</option>';
										}
									?>
									</select>
								</td>
								<td><label for = "puesto">Formación: </label></td>
								<td>	<select name="estudio">
									<?php
										for($i = 0; $i < $totalEst; $i++){
											echo '<option value=' . $i . '>';
												switch ($IdEst[$i]) {
													case 1:
														echo 'Primaria';
													break;
													case 2:
														echo 'ESO';
													break;
													case 3:
														echo 'Bachiller';
													break;
													case 4:
														echo 'FP Grado Medio';
													break;
													case 5:
														echo 'FP Grado Superior';
													break;
													case 6:
														echo 'Universitario';
													break;
													case 7:
														echo 'Máster';
													break;
												}
											echo '</option>';
										}
									?>
									</select>
								</td>
								<td><label for="descripcion">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion" placeholder="AAAA/MM/DD"></td>
							</tr>
						</table>
						<br /><br />
							<button name="siguiente">Siguiente</button>
							<button name="atras">Atrás</button>
<?php
				if(isset($_POST['siguiente'])){
					if($error == 0){
						$_SESSION['session'] = 3;
						header('location: #');
					}else{
						echo 'Revisa los campos';
					}
				}
				if(isset($_POST['atras'])){
					$_SESSION['session'] = 1;
					header('location: #');
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;
			case 3:
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Formación No Reglada';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: #376bb1;
						color: white;
					}
					#cuarto{
						background-color: white;
					}
				</style>

				<article id="cuerpo">
<?php
					desplegar_botones();
?>
					<div class="contenido">
						<table id="t011">
							<tr>
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="tituloFN"></td>
								<td><label for="graduacion">Descripcion: </label></td>
								<td><input class="descripcion" type="text" name="descripcionFN"></td>
								<td><label for="graduacion">Tipo: </label></td>
								<td><input class="descripcion" type="text" name="tipoFN"></td>
							</tr>
						</table>
						<br /><br />
							<form action="#" method="POST">
								<button name="siguiente">Siguiente</button>
								<button name="atras">Atrás</button>
							</form>
						
<?php
					if(isset($_POST['siguiente'])){
						$_SESSION['session'] = 4;
						header('location: #');
					}
					if(isset($_POST['atras'])){
						$_SESSION['session'] = 2;
						header('location: #');
					}

					//Se incluye el pie de página.
					include('pie.php');
					echo '		</div>
							</body>
						</html>';
			break;
			case 4:
				//Variable para indicar el nombre de la página en el titulo.
				$pagina = 'Hobbies';
				include('cabecera.php');
?>
				<style>
					#primero{
						background-color: white;
					}
					#segundo{
						background-color: white;
					}
					#tercero{
						background-color: white;
					}
					#cuarto{
						background-color: #376bb1;
						color: white;
					}
				</style>

				<article id="cuerpo">
<?php
					desplegar_botones();
?>
					<div class="contenido"><div class="contenido">
						<table id="t011">
							<tr>
								<td><label for="descripcion1">Nombre del Hobbie: </label></td>
								<td><input type="text" class="descripcion" name="NHobbie"></td>
								<td><label for="graduacion">Descripcion del Hobbie: </label></td>
								<td><input class="descripcion" type="text" name="DHobbie"></td>
							</tr>
						</table>
						<br /><br />
							<form action="#" method="POST">
								<button name="siguiente">Guardar Currículum</button>
								<button name="atras">Atrás</button>
							</form>
						
<?php
					if(isset($_POST['siguiente'])){
						
					}
					if(isset($_POST['atras'])){
						$_SESSION['session'] = 3;
						header('location: #');
					}

					//Se incluye el pie de página.
					include('pie.php');
					echo '		</div>
							</body>
						</html>';
			break;
		}


	}else{

		header('location: entrar.php');
	}
?>