<footer id="pieinicio">
	<div id="iconos">
		<img src="img/logo.png" width="70%" align="left"/>
		<span id="pie_mensaje">
<?php 
			/*Mostramos el año actual */ 
			echo date('Y'); 
?>
			&copy; Todos los derechos reservados
		</span>
	</div>
	<section id="mensage">
<?php
	//Si se es visitante mostrará un saludo.
	if (empty($user)){
			echo '<article id="saludo">
					<p class="saludar2">Bienvenido usuario</p>
				  </article>
					<img class="avatar" src="img/avatar.png">';
	}else{
        //Si es un usuario registrado, mostrará otro.
		echo '<article id="saludo">';
		//Si la sesion de tipo existe, mostrará el nombre del usuario.
		if($_SESSION['tipo']){
			echo '<p class="saludar2">Bienvenido ' . utf8_encode($user) . '</p>';
		}					
	}
?>
	</section>
		<div id="feed">
			<img src="img/up.png" />
			<br />
<?php 
			//Si hay sesión de usuario
			if (!empty($user)){
				//Mostrará el último acceso a la cuenta.
				echo '<p style="margin-bottom: -50px; margin-top: -30px; text-align: right; margin-right: 100px"> '. $_SESSION['registro'] . '</p>';
			}
?>
			</br></br>
			<h1>Menú del pie</h1>
			<br />
			<h2>Links:</h2>
			link1
			<br/>
			link2
			<br/>
			link3
			<br/>	
		</div>
	</footer>
</section>