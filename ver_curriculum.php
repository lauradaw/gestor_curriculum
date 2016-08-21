<?php
SESSION_START();
	include('datos.php');
	$pagina = 'CURRICULUM';
	$pagina_contenido = "curriculum";
	$css = 'registro.css';
	@$user = $_SESSION['user'];
	$ID = $_GET['id'];

	$result_set=mysqli_query($con,"SELECT * FROM menucurriculum WHERE ID='" . $ID . "'") or die("Error al realizar la consulta");
		while($row=mysqli_fetch_row($result_set)){
			$ID = $row[0];
			$name = utf8_encode($row[1]);
			$apellidos = utf8_encode($row[2]);
			$email = $row[3];
			$fechanacimiento = date_create($row[4]);
            $direccion = utf8_encode($row[5]);
            $nacionalidad = utf8_encode($row[7]);
            $foto = $row[8];
        }

		$fechanacimiento = date_format($fechanacimiento, 'd M Y');

        $telefono = array();
        $titulacion_ID = array();
        $nr_tipo = array();
        $hobby_descripcion = array();

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

            if(!in_array($row[16], $nr_tipo)){
            	$nr_nombre[] = utf8_encode($row[14]);
            	$nr_descripcion[] = utf8_encode($row[15]);
            	$nr_tipo[] = $row[16];
            }

            if(!in_array($row[17], $hobby_descripcion)){
            	$hobby_descripcion[] = utf8_encode($row[17]);
            	$hobby_tipo[] = utf8_encode($row[18]);
            }
            
        }

        @$longitud_telefono = count($telefono);
        @$longitud_titulacion = count($titulacion_ID);
        @$longitud_nr = count($nr_tipo);
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
				if($longitud_telefono > 0){
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
				}
				?>
				<li><strong>Email:</strong> <a href="mailto:<?php echo $email ?>"><?php echo $email ?></a></li>
				<li><strong>Nacionalidad:</strong> <?php echo $nacionalidad ?></li>
				</span>
				</td>
				</tr>
				<tr>
				<?php
					if((@$longitud_titulacion + @$longitud_nr) > 0){
					echo '<td><hr></td>
				</tr>
				<tr>
				<td style="font-size: 30px; padding: 30px 40px 10px"><strong>ESTUDIOS:</strong>';
								if(!@$longitud_titulacion == 0){
							?>
						<br />
						<p style="padding: 0 10px; font-size: 22px; text-decoration: underline">OFICIALES:</p>
					<span style="font-size: 26px; padding: 0px">
						<ul style="list-style-type: circle;">
							<?php
								for($i=0;$i<$longitud_titulacion;$i++){
									echo '<li>' . $titulacion_Nombre[$i] . ': (' . $titulacion_fecha[$i] . ')</li>';
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
									echo '<li>' . $nr_nombre[$i] . ': (' . $nr_descripcion[$i] . ')</li>';
								}
							
						echo '</ul>';
							}
						}



				if((@$longitud_hobby) > 0){
					echo '</td></tr>
						<tr><td><hr></td></tr>
						<tr>
						<td style="font-size: 30px; padding: 30px 40px 10px"><strong>HOBBIES:</strong>';
								if(!@$longitud_hobby == 0){
							?>
						<br />
							<span style="font-size: 26px; padding: 0px">
							<ul style="list-style-type: circle;">
							<?php
								for($i=0;$i<$longitud_hobby;$i++){
									echo '<li>' . $hobby_tipo[$i] . ': (' . $hobby_descripcion[$i] . ')</li>';
								}
							echo '</ul>';
							}
						}
					?>
					<br />
						</td>
				</tr>
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