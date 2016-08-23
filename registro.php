<?php
	//Variables para indicar el nombre de la página en el titulo.
	$_titulo = 'Curriculum';
	$pagina = 'Registrate en nuestra web';
	//Llamamos al css.
	$css = 'contacto.css';
	//Llamamos a la cabecera.
	include('cabecera.php');
	include('funciones.php');

	//HTML
?>
		<article id="cuerpo">
			<h1 class="titulo">Formulario de registro</h1>
			<div class="contenido">
				<form id="registrarse" action="#" method="POST" ENCTYPE="multipart/form-data">
					<table>
						<tr>
							<td>
								<label>Login / Nickname: * </label>
							</td>
							<td>
								<input class="campo1" type="text" name="user" maxlength="25" size="15">
							</td>
						</tr>
						<tr>
							<td>
								<label>Contraseña: * </label>
							</td>
							<td>
								<input class="campo2" type="password" name="passw" maxlength="25" size="15">
							</td>
						</tr>
						<tr>
							<td>
								<label>Repita la Contraseña: * </label>
							</td>
							<td>
								<input class="campo3" type="password" name="repassw" maxlength="25" size="15">
							</td>
						</tr>
						<tr>
							<td>
								<label>Email: * </label>
							</td>
							<td>
								<input class="campo4" type="text" name="mail">
							</td>
						</tr>
					</table>
					<table class="tabla2">
						<tr>
							<td>
								<p class="grande">* Todos los campos son obligatorios</p>
							</td>
						</tr>
						<tr>
							<td>
								<br/>
								<input type="checkbox" class="campo" name ="acepto" value="acepto">
								<b class="acepto">Acepto los <a href="Condiciones.php"  target="_blank">Términos y Condiciones de Uso</a> de esta página web.</b>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:left">
								<br/>
								<button name="enviar" type="submit" value="Enviardatos">Aceptar</button>
								<button type="reset" value="Borrar información">Borrar</button>
							</td>
						</tr>
					</table>
				</form>
			</article>
			<div style="margin-top: -30px">
<?php
				//Se incluye el pie de página.
				include('pie.php');
?>
		</div>
	</body>
</html>


<?php
	//Llamamos a la función de registrarse.
	registrarse();
?>
