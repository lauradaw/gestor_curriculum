<article id="menu">
	<header>
		<img id="logo" src="img/logotipo2.png">
	</header>
	<hr>
	<div id="clear"></div>
	<ul id="herramientas">
<?php
	include('funciones_backoffice.php');
	backoffice_menu();
?>
	<img class="icon" src="img/he.png">
		<ul class="cuenta"> Cuenta
			<li><a href="editar_backoffice.php">Editar Datos</a></li>
			<li><a href="cerrarsesion.php">Cerrar Sesión</a></li>
		</ul>
	</ul>
	<section id="sesion">
<?php	
		cargar_saludo(); 
?>
	</section>
</article>
