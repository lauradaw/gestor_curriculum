<footer id="pieinicio">
	<div id="iconos">
		<img src="img/logo.png" width="70%" align="left"/>
		<span id="pie_mensaje"><?php /* Llamamos al año actual */ echo date('Y'); ?>&copy; Todos los derechos reservados</span>
	</div>
	<section id="mensage">
		<?php
			//Si se es visitante mostrará un saludo.
			if (is_null(@$user)){
				echo '<article id="saludo">
						<p class="saludar2">Bienvenido usuario</p>
					 </article>
					<img class="avatar" src="img/avatar.png">';
				}else{
        			//Dependiendo del tipo mostrará el rango de usuario o el nombre de registro y su foto.
					echo '<article id="saludo">';
						if (@$is_admin == 3){
							echo '<p class="saludar2">RECURSOS HUMANOS</p>';
						}
						if (@$is_admin == 2){
							echo '<p class="saludar2">ADMINISTRADOR</p>';
						}
						if (@$is_admin == 1){
							$consulta = "SELECT * FROM avatares WHERE Login='" . $user ."'";
							$result_set= mysqli_query($con, $consulta) or die("Error en la consulta");
							while($row=mysqli_fetch_row($result_set)){
								$avatar = $row[2];
							}
							
							echo '<p class="saludar2">Bienvenido ' . utf8_encode($nombre_db) . '</p>';
						}
						if(@$avatar){
							echo '</article>
								<img class="avatar_foto" src="img/usuarios/' . @$avatar . '">
							 </article>';
						}else{
							echo '</article>
								<img class="avatar" src="img/usuarios/avatar.png">
							 </article>';
						}
						
				}
						?>
	</section>

				<div id="feed">
					<img src="img/up.png" />
					<br />

						<h1>Menú del pie</h1>
					<br />
						<h2>Links:</h2>
					
						<p>
						<?php 
							if (!is_null(@$user)){
							echo $time;
							}
						?>
						</p>
						link1
					<br />
						link2
					<br />
						link3
					<br />
					
				</div>

			</footer>
					</section>