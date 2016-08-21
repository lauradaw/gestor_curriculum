<?php
SESSION_START();
	include('datos.php');
	$pagina = 'CURRICULUM';
	$pagina_contenido = "curriculum";
	$css = 'registro.css';
	@$user = $_SESSION['user'];
	$ID = $_GET['id'];

	$telefono = array();
    $titulacion_ID = array();
    $nr_nombre = array();
    $hobby_tipo = array();

	$result_set=mysqli_query($con,"SELECT * FROM menucurriculum WHERE ID='" . $ID . "'") or die("Error al realizar la consulta");
		while($row=mysqli_fetch_row($result_set)){
			$ID = $row[0];
			$name = utf8_encode($row[1]);
			$apellidos = utf8_encode($row[2]);
			$email = $row[3];
			$fechanacimiento = utf8_decode($row[4]);
            $direccion = utf8_encode($row[5]);
            $nacionalidad = utf8_encode($row[7]);
            $foto = $row[8];
        }

    $result_set=mysqli_query($con,"SELECT * FROM curriculums WHERE ID='" . $ID . "'") or die("Error al realizar la consulta");
		while($row=mysqli_fetch_row($result_set)){

             $categoria = $row[11];

             if(!in_array($row[7], $telefono)){
           		$telefono[] = $row[7];
        	}

            if(!in_array($row[12], $titulacion_ID)){
            	$titulacion_ID[] = $row[12];
            	$titulacion_Nombre[] = utf8_encode($row[10]);
            	$titulacion_fecha[] = $row[13];
            }

            if(!in_array($row[14], $nr_nombre)){
            	$nr_nombre[] = utf8_encode($row[14]);
            	$nr_descripcion[] = utf8_encode($row[15]);
            	$nr_tipo[] = $row[16];
            }

            if(!in_array($row[18], $hobby_tipo)){
            	$hobby_descripcion[] = utf8_encode($row[17]);
            	$hobby_tipo[] = $row[18];
            }
            
        }

        @$longitud_telefono = count($telefono);
        @$longitud_titulacion = count($titulacion_ID);
        @$longitud_nr = count($nr_nombre);
        @$longitud_hobby = count($hobby_descripcion);

    include('cabecera.php');
	?>

<article id="cuerpo">
	<h1 class="titulo">Curriculum de <?php echo $name . ' ' . $apellidos ?></h1>
	<div class="contenido">
		<table align="center" style="border: 1px solid black; width: 1200px; overflow: hidden">
			<tr>
				<td><img src="img/usuarios/<?php echo $foto ?>" height="169px" style="padding: 20px"/><span style="float: right; padding: 12px"><img src="img/logo_cv.jpg" ></span><hr></td>
			</tr>
			<tr>
				<td style="font-size: 30px; padding: 30px 40px 10px"><strong>DATOS PERSONALES:</strong>
				<span style="font-size: 26px; padding: 0px"><ul style="list-style-type: circle;"><li><strong>Nombre:</strong> <?php echo $name . ' ' . $apellidos ?></li>
				<li><strong>Fecha de Nacimiento:</strong> <?php echo $fechanacimiento ?></li>
				<li><strong>Dirección:</strong> <?php echo $direccion ?></li>
				<?php
					echo '<li><strong>Teléfono:</strong> ';
						for($i=0;$i<$longitud_telefono;$i++){
							if($i == 0){
								echo $telefono[$i];
							}
							else
							{
								echo ' - ' . $telefono[$i];
							}
						}
					echo '</li>';
					?>
						<li><strong>Email:</strong> <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
						<li><strong>Nacionalidad:</strong> <?php echo $nacionalidad ?></li>
					</span>
				</td>
				</tr>
				<tr>
				<td><hr></td>
				</tr>
				<tr>
					<td style="font-size: 30px; padding: 30px 40px 10px"><strong>ESTUDIOS:</strong>
							<?php
								if(!@$longitud_titulacion == 0){
							?>
						<br />
						<p style="padding: 0 10px; font-size: 22px; text-decoration: underline">OFICIALES:</p>
					<span style="font-size: 26px; padding: 0px">
						<ul style="list-style-type: circle;">
							<?php
								for($i=0;$i<$longitud_titulacion;$i++){
									echo '<li>' . $titulacion_Nombre[$i] . '</li>';
								}
							echo '</ul>';
								}
							
								if(!@$longitud_nr == 0){
							?>
						<p style="padding: 16px 10px 0; font-size: 22px; text-decoration: underline">NO OFICIALES:</p>
					<span style="font-size: 26px; padding: 0px">
						<ul style="list-style-type: circle;">
							<?php
								for($i=0;$i<$longitud_nr;$i++){
									echo '<li>' . $nr_nombre[$i] . '</li>';
								}
							
						echo '</ul>';
						}

						if(@$longitud_titulacion == 0 | @$longitud_nr == 0){
							echo '<br /><p>(No hay datos para mostrar)</p>';
						}
					?>
						</td>
				</tr>
				<tr><td><hr><br /></td></tr>
		</table>
		<div style="margin-bottom: 120px">&nbsp;</div>
	</div>
</article>

	<?php
	include('pie.php');
	?>
		</div>
	</body>
</html>