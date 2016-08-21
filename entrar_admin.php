<html>
	<head>
<?php
	//Iniciamos sesión.
	SESSION_START();

	//Incluimos el archivo datos.php con los datos de la base de datos.
	//Variable para indicar el nombre de la página en el titulo.
	$pagina = "Acceso VIP";
	$_titulo = "Currículum";
	//Llamamos al css de registro.
	$css = 'registro2.css';

	include('conectar.php');
	include('funciones_backoffice.php');
?>
	<link rel="stylesheet" type="text/css" href="css/estilo.css" media="screen" />
<?php include('cabecera_backoffice.php'); ?>
	</head>
	<body>
		<div id="contenedor">
			<article id="cuerpo">
				<h1 class="titulo">Acceso VIP:</h1>
				<div class="contenido">
					<form id="acceder" action="#" method="POST" ENCTYPE="multipart/form-data">
						<table>
							<tr>
								<td class="etiqueta">
									<label>Login / Nickname: * </label>
								</td>
								<td>
									<input type="text" name="user" maxlength="50" placeholder="Introduce tu usuario">
								</td>
							</tr>
							<tr>
								<td class="etiqueta">
									<label>Contraseña: * </label>
								</td>
								<td>
									<input type="password" name="passw" maxlength="50" placeholder="Introduce tu contraseña">
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:left">
									<br />
									<button name="enviar" type="submit" value="Enviardatos">Aceptar</button>
									<button name="enviar" type="reset" value="Enviardatos">Borrar</button>
								</td>
							</tr>
							<tr>
								<td td colspan="2" style="text-align:left">
									<a href="solicitar.php">¿Has olvidado la contraseña?</a>
								</td>
							</tr>
						</table>
					</form>
				</div>
			</article>
		</div>
	</body>
</html>

<?php

	backoffice_login();
	
?>
