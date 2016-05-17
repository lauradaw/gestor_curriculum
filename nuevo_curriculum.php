<?php
	SESSION_START();
	//Incluimos el archivo datos.php que contiene los datos de conexión de la base de datos.
	include('datos.php');
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = 'Nuevo Currículum';
	//Llamamos al css de contacto.
	$css = 'contacto.css';

	if($_SESSION['user']){
		$user = $_SESSION['user'];
		
		if(empty($_SESSION['session'])){
			$_SESSION['session'] = "DatosPersonales";	
		}

		if(isset($_POST['refr'])){
			$_SESSION['session'] = empty($_SESSION['session']);
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
		@$nombre = $_SESSION['nombre'];
		@$apellidos = $_SESSION['apellidos'];
		@$fecha = $_SESSION['nacimiento'];
		@$direccion = $_SESSION['direccion'];
		@$telefono = $_SESSION['tel'];
		@$nacionalidad = $_SESSION['nacionalidad'];
		@$foto = $_SESSION['foto'];

		//Formación No Reglada
		@$nombre = $_SESSION['nombre'];
		@$apellidos = $_SESSION['apellidos'];
		@$fecha = $_SESSION['nacimiento'];
		@$direccion = $_SESSION['direccion'];
		@$telefono = $_SESSION['tel'];
		@$nacionalidad = $_SESSION['nacionalidad'];
		@$foto = $_SESSION['foto'];

		//Hobbies
		@$nombre = $_SESSION['nombre'];
		@$apellidos = $_SESSION['apellidos'];
		@$fecha = $_SESSION['nacimiento'];
		@$direccion = $_SESSION['direccion'];
		@$telefono = $_SESSION['tel'];
		@$nacionalidad = $_SESSION['nacionalidad'];
		@$foto = $_SESSION['foto'];


		switch($_SESSION['session']){
			case "DatosPersonales":
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
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<div class="contenido">
						<table>
							<tr>
								<td><label for = "nombre">Nombre: </label></td>
								<td><input type = "text" name="nombre" value="<?php echo $nombre ?>"></td>
							</tr>
							<tr>
								<td><label for = "apellidos">Apellidos: </label></td>
								<td><input type = "text" name="apellidos"></td>
							</tr>
							<tr>
								<td><label for = "nacimiento">Fecha Nacimiento: </label></td>
								<td><input type = "text" name="nacimiento" placeholder="AAAA/MM/DD"></td>
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
								<td><label for = "nacionalidad">Nacionalidad: </label></td>
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
				if(isset($_POST['step2'])){
					$_SESSION['session'] = "FormacionReglada";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormacionNoReglada";
					header('location: #');
				}
				if(isset($_POST['step4'])){
					$_SESSION['session'] = "Hobbies";
					header('location: #');
				}

				if(isset($_POST['siguiente'])){
					$_SESSION['session'] = "FormacionReglada";
					header('location: #');
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;

			case "FormacionReglada":
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
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
				
					<div class="contenido">
						<form action="#" method="POST">
						<table id="t011">
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria1">
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
								<td>	<select name="estudio1">
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
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion1"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion1" placeholder="AAAA/MM/DD"></td>
							</tr>
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria2">
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
								<td>	<select name="estudio2">
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
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion2"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion2" placeholder="AAAA/MM/DD"></td>
							</tr>
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria3">
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
								<td>	<select name="estudio3">
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
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion3"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion3" placeholder="AAAA/MM/DD"></td>
							</tr>
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria4">
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
								<td>	<select name="estudio4">
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
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion4"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion4" placeholder="AAAA/MM/DD"></td>
							</tr>
							<tr>
								<td><label for = "puesto">Categoría: </label></td>
								<td>	<select name="categoria5">
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
								<td>	<select name="estudio5">
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
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="descripcion5"></td>
								<td><label for="graduacion">Año de Graduación: </label></td>
								<td><input class="fechatit" type="text" name="graduacion5" placeholder="AAAA/MM/DD"></td>
							</tr>
						</table>
						<br /><br />
							<button name="siguiente">Siguiente</button>
							<button name="atras">Atrás</button>
<?php
				if(isset($_POST['step1'])){
					$_SESSION['session'] = "DatosPersonales";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormacionNoReglada";
					header('location: #');
				}
				if(isset($_POST['step4'])){
					$_SESSION['session'] = "Hobbies";
					header('location: #');
				}

				if(isset($_POST['siguiente'])){
					$_SESSION['session'] = "FormacionNoReglada";
					header('location: #');
				}
				if(isset($_POST['atras'])){
					$_SESSION['session'] = "DatosPersonales";
					header('location: #');
				}
				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';
			break;
			case "FormacionNoReglada":
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
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<div class="contenido">
						<table id="t011">
							<tr>
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="tituloFN1"></td>
								<td><label for="graduacion">Descripcion: </label></td>
								<td><input class="descripcion" type="text" name="descripcionFN1"></td>
								<td><label for="graduacion">Tipo: </label></td>
								<td><input class="descripcion" type="text" name="tipoFN1"></td>
							</tr>
							<tr>
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="tituloFN2"></td>
								<td><label for="graduacion">Descripcion: </label></td>
								<td><input class="descripcion" type="text" name="descripcionFN2"></td>
								<td><label for="graduacion">Tipo: </label></td>
								<td><input class="descripcion" type="text" name="tipoFN2"></td>
							</tr>
							<tr>
								<td><label for="descripcion1">Título: </label></td>
								<td><input type="text" class="descripcion" name="tituloFN3"></td>
								<td><label for="graduacion">Descripcion: </label></td>
								<td><input class="descripcion" type="text" name="descripcionFN3"></td>
								<td><label for="graduacion"class="descripcion">Tipo: </label></td>
								<td><input class="descripcion" type="text" name="tipoFN3"></td>
							</tr>
						</table>
						<br /><br />
							<form action="#" method="POST">
								<button name="siguiente">Siguiente</button>
								<button name="atras">Atrás</button>
							</form>
						
<?php
					if(isset($_POST['siguiente'])){
						$_SESSION['session'] = "Hobbbies";
						header('location: #');
					}
					if(isset($_POST['atras'])){
						$_SESSION['session'] = "FormacionNoReglada";
						header('location: #');
					}

					if(isset($_POST['step1'])){
						$_SESSION['session'] = "DatosPersonales";
						header('location: #');
					}
					if(isset($_POST['step2'])){
						$_SESSION['session'] = "FormacionReglada";
						header('location: #');
					}
					if(isset($_POST['step4'])){
						$_SESSION['session'] = "Hobbies";
						header('location: #');
					}

					//Se incluye el pie de página.
					include('pie.php');
					echo '		</div>
							</body>
						</html>';
			break;
			case "Hobbies":
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
					<form action="#" method="POST">
							<button style="width: 220px;" id="primero" name="step1">Datos Personales</button>
							<button style="width: 220px;" id="segundo" name="step2">Formación Reglada</button>
							<button style="width: 220px;" id="tercero" name="step3">Formación No Reglada</button>
							<button style="width: 220px;" id="cuarto" name="step4">Hobbbies</button>
							<button style="width: 220px;" id="refr" name="refr">Refrescar Sesion</button>
					</form>
					<div class="contenido">

<?php
				if(isset($_POST['step1'])){
					$_SESSION['session'] = "DatosPersonales";
					header('location: #');
				}
				if(isset($_POST['step2'])){
					$_SESSION['session'] = "FormacionReglada";
					header('location: #');
				}
				if(isset($_POST['step3'])){
					$_SESSION['session'] = "FormacionNoReglada";
					header('location: #');
				}


				//Se incluye el pie de página.
				include('pie.php');
				echo '		</div>
						</body>
					</html>';	
	}


	}else{

		header('location: entrar.php');
	}
?>