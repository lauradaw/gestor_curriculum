<?php
	SESSION_START();

	if(empty($_SESSION['user'])){
			header("Location: 404.php");
	}
	if($_SESSION['tipo'] == 2 || $_SESSION['tipo'] == 3){
			//Incluimos el archivo datos.php con los datos de la base de datos.
			//Variable para indicar el nombre de la página en el titulo.
			$pagina = "Panel de Control";
			$_titulo = "Currículum";
			//Llamamos al css de registro.
			$css = 'backoffice.css';

			include('conectar.php');

?>
		<html>
			<?php include('cabecera_backoffice2.php');?>
			<body>
				<section id="contenedor">
					<?php include('backoffice_menu.php');?>
					<article id="cuerpo_laterial">
						<img class="cp" src="img/CUR.png">
						<img class="portada" src="img/fondo.jpeg">

					</article>
					<footer id="pie">
					</footer>
				</section>
			</body>
		</html>

<?php
	}else{
		header("Location: 404.php");
	}
?>

	