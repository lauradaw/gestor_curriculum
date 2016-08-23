	<?php
	   	$pagina = "Contacte con Nosotros";
		$_titulo = "Currículum";
	    $css = 'contacto.css';

	    include('cabecera.php');
	    include('funciones.php');
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
							<td>
								<label for="comments">Comentarios: *</label>
							</td>
							<td>
								<textarea name="comments" maxlength="500" cols="30" rows="5"></textarea>
							</td>
						</tr>
						<tr>
							<td colspan="2" style="text-align:left">
								<br/>
								<button name="enviar" type="submit" value="Enviar">Enviar</button>
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
	</body>                                                                

</html>

<?php
	
	if(!empty($_SESSION['tipo'])){
		if($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 3){
			echo '<script language="javascript">window.location="backoffice.php";</script>';
		}
	}

	//Llamamos a la función Contactar;
	Contactar();
?>