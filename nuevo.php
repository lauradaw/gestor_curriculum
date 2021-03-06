<?php
	//Iniciamos sesión.
	SESSION_START();
	//Llamamos al archivo de conexión con la base de datos conectar.php.
	include('conectar.php');
	//Llamamos al archivo donde se almacenan todas las funciones del backoffice.

	//Llamamos al css que necesitamos e indicamos el título de la página.
	$css = 'backoffice.css';

	$pagina = "Nuevo Usuario";
	$_titulo = "Currículum";

?>
<html>
	<?php include('cabecera_backoffice2.php');?>
	<body>
		<section id="contenedor">
			<?php include('backoffice_menu.php');?>
			<article id="cuerpo_laterial">

				<!-- Mostramos el formulario -->
					<article id="cuerpo">
						<h1 class="titulo">Formulario de Registro de Nuevo Usuario:</h1>
						<div class="contenido">
							<form id="editardatos" action="#" method="POST" ENCTYPE="multipart/form-data">
								<table style="margin: -10px 30px" id="acceder">
									<tr>
										<td>
											<label>Nuevo Usuario: </label>
										</td>
										<td>
											<input class="campo7" type="text" name="user_name"  maxlength="30" size="40">
										</td>
									</tr>
									<tr>
										<td>
											<label>Email: </label>
										</td>
										<td>
											<input class="campo8" type="text" name="mail"  maxlength="50" size="40">
										</td>
									</tr>
									<tr>
										<td>
											<label>Contraseña: </label>
										</td>
										<td>
											<input maxlength="30" size="40" class="campo11" type="password" name="pass_new1">
										</td>
									</tr>
									<tr>
										<td>
											<label class="rep">Repite la Contraseña: </label>
										</td>
										<td>
											<input maxlength="30" size="40" class="campo12" type="password" name="pass_new2"><br>
										</td>
									</tr>
									<tr>
										<td>
											<label>Tipo: </label>
										</td>
										<td>
											<select name="tipo">
												<option value="1">Usuario</option>
												<option value="3">Recursos Humanos</option>;
												<option value="2">Administrador</option>;
											</select>
										</td>
									</tr>
									<tr>
										<td colspan="2"  style="text-align:left">
											<br/>
											<p>*No pueden haber campos vacíos.</p>
											<button name="guardar" type="submit" value="Enviardatos" alt="Crear nuevo usuario" title="Crear nuevo usuario">Crear</button>
											<button name="finalizar" type="submit" value="Enviardatos" style="margin-top:-10px" alt="Salir sin guardar los datos" title="Salir sin guardar los datos">Salir</button>
										</td>
									</tr>
								</table>	  
							</form>
						</div>
					</article>
			</article>
			<footer id="pie">
			</footer>
		</section>
	</body>
</html>

<?php
	
	//Llamamos a la función para crear un nuevo usuario.
	nuevo_user();

?>


					