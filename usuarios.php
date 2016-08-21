﻿<?php
	//Iniciamos sesión.
	SESSION_START();
	//Llamamos al archivo de conexión con la base de datos conectar.php.
	include('conectar.php');
	//Llamamos al archivo donde se almacenan todas las funciones del backoffice.

	//Llamamos al css que necesitamos e indicamos el título de la página.
	$css = 'backoffice.css';

	$pagina = "Usuarios Registrados";
	$_titulo = "Currículum";
?>

<html>
	<?php include('cabecera_backoffice2.php');?>
	<body>
		<section id="contenedor">
			<?php include('backoffice_menu.php');?>
			<article id="cuerpo_laterial">
				<article id="cuerpo2">
					<h1 class="titulo">Registro de Usuarios</h1>
					<div class="contenido" style="width:100%">
						<table id="t01" style="width:100%">
							<tr>
								<th>Usuario</th>
								<th>Email</th>
								<th>Rango</th>
								<th>Acciones</th>
							</tr>
<?php
							listar_usuarios();
?>
						</table>
					</div>
				</article>
			</article>
			<footer id="pie">
			</footer>
		</section>
	</body>
</html>