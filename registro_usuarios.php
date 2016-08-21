<?php
	header('Location: index.php');
	SESSION_START();
	$pagina = 'Registro de Usuarios';
	$pagina_contenido = "perfiles";
	include('cabecera.php');
	?>

			<article id="cuerpo">
				<h1 class="titulo2">Registro de Usuarios Registrados</h1>
				<div id="perfil">
					<div id="dat">
						<br><br>
							<?php
							echo '<ul class="pri">
									<li><b class="negrita">Alias: </b>'. $_SESSION['user'] . '</li>
									<li><b class="negrita">E-Mail: </b>'. $_SESSION['email'] . '</li>
								</ul>';
							echo '<ul class="secun">
									<li><b class="negrita">Nombre: </b>'. utf8_encode($_SESSION['nombre']) . '</li>
									<li><b class="negrita">Dirección: </b>'. utf8_encode($_SESSION['direccion']) . '</li>
									<li><b class="negrita">Teléfono: </b>'. $_SESSION['tel'] . '</li>
									
								</ul>';
							?>
					</div>
					<div id="avat">
						<p style="margin-bottom:-6px;">Imagen de avatar:</p>
						<img src="avatares/<?php echo @$avatar?>" style="border: 3px solid blue; border-radius:20px">
					</div>
				</div>

				<button name="Enviar" type="submit" value="Enviar" onclick="window.location='editar.php'" style="margin-top:-120px">Modifica tu Perfil</button>
			</article>
	<div style="margin-top: -30px">
			<?php
				include('pie.php');
			?>
		</div>
	</body>
</html>