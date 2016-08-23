<?php
	
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = 'Nuevo Currículum';
	//Llamamos al css de contacto.
	$css = 'contacto.css';
	include('cabecera.php');
?>
	
	<style type="text/css">
		
	</style>
	<article id="cuerpo">
		<div class="contenido">
			<nav>
				<button id="atras">Atrás</button>
				<button id="siguiente">Siguiente</button>
			</nav>
			<form action="#" method="POST">
				
				<div class="pagina pagina_actual">Primera
					<table>
						<tr>
							<td>
								<label for = "nombre">Nombre*: </label>
							</td>
							<td>
								<input type = "text" name="nombre" value="<?php echo $nombre ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label for = "apellidos" value="<?php echo $apellidos ?>">Apellidos*: </label>
							</td>
							<td>
								<input type = "text" name="apellidos">
							</td>
						</tr>
						<tr>
							<td>
								<label for = "nacimiento" value="<?php echo $fecha ?>">Fecha Nacimiento*: </label>
							</td>
							<td>
								<input type = "text" name="nacimiento" placeholder="AAAA/MM/DD" >
							</td>
						</tr>
						<tr>
							<td>
								<label for = "direccion">Dirección: </label>
							</td>
							<td>
								<input type = "text" name="direccion">
							</td>
						</tr>
						<tr>
							<td>
								<label for = "tel">Teléfono: </label>
							</td>
							<td>
								<input type = "text" name="tel">
							</td>
						</tr>
						<tr>
							<td>
								<label for = "nacionalidad">Nacionalidad*: </label>
							</td>
							<td>
								<input type = "text" name="nacionalidad">
							</td>
						</tr>
						<tr>
							<td>
								<label for = "foto">Foto: </label>
							</td>
							<td>
								<input type = "file" name="foto">
							</td>
						</tr>
					</table>
				</div>
				<div class="pagina">
					<table id="t011">
						<tr>
							<td>
								<label for = "puesto">Categoría: </label>
							</td>
							<td>	
								<select name="categoria">
<?php
									$sql = new conection();
									$conexion = $sql -> conectar();
									$consulta = $sql->ejecutar_consulta("SELECT * FROM categorias");

									if(!$consulta){
										die('Error al realizar la consulta');
										desconectar();
									}else{
										while($row=mysqli_fetch_array($consulta)){
											$ID = $row['IdCategorias'];
											$Categoria = $row['NombreCategoria'];

											echo '<option value="' . $ID . '">' . $Categoria . '</option>';
										}
									}

?>
								</select>
							</td>
							<td>
								<label for = "puesto">Formación: </label>
							</td>
							<td>
								<select name="estudio">
<?php
									$sql = new conection();
									$conexion = $sql -> conectar();
									$consulta = $sql->ejecutar_consulta("SELECT * FROM estudios");

									if(!$consulta){
										die('Error al realizar la consulta');
										desconectar();
									}else{
										while($row=mysqli_fetch_array($consulta)){
											$IdEstudio = $row['IDEstudios'];
											$NombreEstudio = $row['NombreEstudio'];

											echo '<option value="' . $IdEstudio . '">' . $NombreEstudio . '</option>';
										}
									}

?>
								</select>
							</td>
							<td>
								<label for="descripcion">Título: </label>
							</td>
							<td>
								<input type="text" class="descripcion" name="descripcion">
							</td>
							<td>
								<label for="graduacion">Año de Graduación: </label>
							</td>
							<td>
								<input class="fechatit" type="text" name="graduacion" placeholder="AAAA/MM/DD">
							</td>
						</tr>
						<tr>
							<td>
								<button class = "anadir" id = "anadirEstudio">+</button>
							</td>
						</tr>
					</table>
				</div>
				<div class="pagina">
					<table id="t011">
						<tr>
							<td>
								<label for="descripcion1">Título: </label>
							</td>
							<td>
								<input type="text" class="descripcion" name="tituloFN">
							</td>
							<td>
								<label for="graduacion">Descripcion: </label>
							</td>
							<td>
								<input class="descripcion" type="text" name="descripcionFN">
							</td>
							<td>
								<label for="graduacion">Tipo: </label>
							</td>
							<td>
								<input class="descripcion" type="text" name="tipoFN">
							</td>
						</tr>
						<tr>
							<td>
								<button class = "anadir" id = "anadirEstudio">+</button>
							</td>
						</tr>
					</table>
				</div>
				<div class="pagina">
					<table id="t011">
						<tr>
							<td>
								<label for="descripcion1">Nombre del Hobbie: </label>
							</td>
							<td>
								<input type="text" class="descripcion" name="NHobbie">
							</td>
							<td>
								<label for="graduacion">Descripcion del Hobbie: </label>
							</td>
							<td>
								<input class="descripcion" type="text" name="DHobbie">
							</td>
						</tr>
						<tr>
							<td>
								<button class = "anadir" id = "anadirEstudio">+</button>
							</td>
						</tr>
					</table>
				</div>
		</form>