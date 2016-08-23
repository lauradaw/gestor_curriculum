<?php

	//Variable para indicar el nombre de la página en el titulo.
	$_titulo = 'Curriculum';
	$pagina = "Acceso a la Web";
	//Llamamos al css de registro.
	$css = 'registro.css';

	//Incluimos la cabecera y el archivo de funciones.
	include('cabecera.php');

	//HTML
?>

		<article id="cuerpo">
			<h1 class="titulo">Accede a nuestra web</h1>
			<div class="contenido">
				<form id="acceder" action="#" method="POST" ENCTYPE="multipart/form-data">
					<table>
						<tr>
							<td>
								<label>Login / Nickname: * </label>
							</td>
							<td>
								<input type="text" name="user" maxlength="50" size="25" placeholder="Introduce tu usuario">
							</td>
						</tr>
						<tr>
							<td>
								<label>Contraseña: * </label>
							</td>
							<td>
								<input type="password" name="passw" maxlength="50" size="25" placeholder="Introduce tu contraseña">
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
			</article>
		<div style="margin-top: -30px">
<?php
			include('pie.php');
?>
		</div>
	</body>
</html>

