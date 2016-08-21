<?php
	SESSION_START();
	$pagina = "Error";
	$pagina_contenido = "registro";
	$css = 'registro.css';
		include('cabecera.php');
?>
		<article id="cuerpo">
			<h1 class="titulo">¡No se encuentra lo que estas buscando!</h1>
			<div class="contenido"><h3>No hemos encontrado lo que buscabas... Es posible que no hayas introducido bien los datos, o simplemente lo que buscas ya no está disponible. Vuelve a intentarlo y si continua el error ponte en contacto con el webmaster.</h3></div>
		</article>
		<div style="margin-top: -30px">
			<br/>
			<br/>
<?php
	include('pie.php');
?>
		</div>
		<footer>
		</footer>
		
	</body>                                                                
</html>