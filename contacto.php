	<?php
	    SESSION_START();
	    $pagina = "Contacte con nosotros";
	    $pagina_contenido = "registro";
	    $css = 'contacto.css';

		if(isset($_POST['Enviar'])){

		if(isset($_POST['email'])) {

			$email_to = "laura.g.brao@gmail.com";
			$email_subject = "Contacto desde el sitio web";

			// Aquí se deberían validar los datos ingresados por el usuario
			if(strlen($_POST['first_name']) <3 || strlen($_POST['last_name']) < 3 || !$_POST['email'] || strlen($_POST['comments']) < 3 || !preg_match('^([a-zA-Z0-9._]+)@([a-zA-Z0-9.-]+).([a-zA-Z]{2,4})^',$_POST['email'])){
				echo '<script language="javascript">window.alert("Ocurrió un error y el formulario no ha sido enviado.\nPor favor, vuelva atrás y verifique la información ingresada"); window.history.go(-1)</script>';
				die(); 
			}
			$email_message = "Detalles del formulario de contacto:\n\n";
			$email_message .= "Nombre: " . $_POST['first_name'] . "\n";
			$email_message .= "Apellido: " . $_POST['last_name'] . "\n";
			$email_message .= "E-mail: " . $_POST['email'] . "\n";
			$email_message .= "Teléfono: " . $_POST['telephone'] . "\n";
			$email_message .= "Comentarios: " . $_POST['comments'] . "\n\n";
			// Ahora se envía el e-mail usando la función mail() de PHP
			$headers = 'From: '.$email_from."\r\n".
			'Reply-To: '.$email_from."\r\n" .
			'X-Mailer: PHP/' . phpversion();
			@mail($email_to, $email_subject, $email_message, $headers);
			echo '<script language="javascript">window.alert("¡Su solicitud se ha enviado con éxito!\nLe contestaremos en la máxima brevedad posible. Gracias!"); window.location="index.php";</script>';
		}
	}
		include('cabecera.php');
	?>

			<article id="cuerpo">
				<h1 class="titulo">Contactenos via e-mail</h1>
				<div class="contenido">
					<form id="Contacto" name="frmContacto" method="post" action="#">
						<table width="500px;">
							<tr>
								<td>
									<label for="first_name">Nombre: *</label>
								</td>
								<td>
									<input type="text" name="first_name" maxlength="50" size="25">
								</td>
							</tr>
							<tr>
								<td valign="top">
									<label for="last_name">Apellido: *</label>
								</td>
								<td>
									<input type="text" name="last_name" maxlength="50" size="25">
								</td>
							</tr>
							<tr>
								<td>
									<label for="email">Dirección de E-mail: *</label>
								</td>
								<td>
									<input type="text" name="email" maxlength="80" size="35">
								</td>
							</tr>
							<tr>
								<td>
									<label for="telephone">Número de teléfono:</label>
								</td>
								<td>
									<input type="text" name="telephone" maxlength="25" size="15">
								</td>
							</tr>
							<tr>
								<td>
									<label for="comments">Comentarios: *</label>
								</td>
								<td>
									<textarea name="comments" maxlength="500" cols="30" rows="5"></textarea>
								</td>
							</tr>
							<tr>
								<td colspan="2" style="text-align:left">
									<br />
									<button name="Enviar" type="submit" value="Enviar">Enviar</button>
									<button type="reset" value="Borrar información">Borrar</button>
								</td>
							</tr>
						</table>
					</form>
				</div>
				<div style="margin-bottom: 120px">&nbsp;</div>
			</article>
			<div style="margin-top: -30px">
			<?php
				include('pie.php');
			?>
		</div>
		<footer>
		</footer>
		
	</body>                                                                

</html>