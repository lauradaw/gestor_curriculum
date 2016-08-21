<?php
	//Iniciamos sesión.
	SESSION_START();
	//Llamamos al archivo de conexión con la base de datos conectar.php.
	include('conectar.php');
	//Llamamos al archivo donde se almacenan todas las funciones del backoffice.

	//Llamamos al css que necesitamos e indicamos el título de la página.
	$css = 'backoffice.css';

	$pagina = "Nueva Categoría";
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
						<h1 class="titulo">Formularia para la creación de una Nueva Categoría:</h1>
						<div class="contenido">
							<form id="editardatos" action="#" method="POST" ENCTYPE="multipart/form-data">
								<table style="margin: -10px 30px" id="acceder">
									<tr>
										<td>
											<label>Nueva Categoría: </label>
										</td>
										<td>
											<input class="campo7" type="text" name="categoria"  maxlength="30" size="40">
										</td>
									</tr>
									<tr>
										<td colspan="2"  style="text-align:left">
											<br/>
											<p>*No pueden haber campos vacíos.</p>
											<button name="guardar" type="submit" value="Enviardatos" alt="Crear nueva categoría" title="Crear nuevo usuario">Crear</button>
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
	nueva_categoria();

?>

