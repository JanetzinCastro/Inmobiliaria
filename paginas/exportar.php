<div class="sidebar">
  <a href="?op=terrenos_reg">Terrenos Registrados</a>
  <a href="?op=usuarios_reg">Usuarios Registrados</a>
  <a href="?op=reg_admin">Registrar Administrador</a>
  <a href="?op=cerrar_sesion">Cerrar Sesion</a>
</div>
<?php 
$conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");

$Terrenos="SELECT * FROM INM_TERRENO order by TER_FECHA_REG";

$resTerrenos=$conn->query($Terrenos);
?>

<div class="container" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">
			<p style="color: white">Reporte de Terrenos</p>
			<p style="color: gray">Tenemos un lugar para Ti.</p>
      		<div class="red-border"></div>

			<table class="table">
				<tr class="bg-primary">
					<th>ID</th>
					<th>CALLE</th>
					<th>COLONIA</th>
					<th>MUNICIPIO</th>
					<th>ESTADO</th>
					<th>LARGO</th>
					<th>ANCHO</th>
					<th>TOTAL</th>
					<th>PRECIO</th>
					<th>DESCRIPCION</th>
					<th>ESTATUS</th>
					<th>REGISTRO</th>
					<th>TIPO</th>
				</tr>
			<?php
				while ($registroTerrenos = $resTerrenos->fetch_array(MYSQLI_BOTH))
				{
					echo'<tr>
						 <td>'.$registroTerrenos['TER_CVE'].'</td>
						 <td>'.$registroTerrenos['TER_CALLE'].'</td>
						 <td>'.$registroTerrenos['TERR_COLONIA'].'</td>
						 <td>'.$registroTerrenos['TER_MUNICIPIO'].'</td>
						 <td>'.$registroTerrenos['TER_ESTADO'].'</td>
						 <td>'.$registroTerrenos['TER_LARGO'].'</td>
						 <td>'.$registroTerrenos['TER_ANCHO'].'</td>
						 <td>'.$registroTerrenos['TER_TOTAL'].'</td>
						 <td>'.$registroTerrenos['TER_PRECIO'].'</td>
						 <td>'.$registroTerrenos['TER_DESC'].'</td>
						 <td>'.$registroTerrenos['TER_ESTATUS'].'</td>
						 <td>'.$registroTerrenos['TER_FECHA_REG'].'</td>
						 <td>'.$registroTerrenos['TER_USU_CVE'].'</td
						 <td>'.$registroTerrenos['TER_TIPO_CVE'].'</td
						 </tr>';
				}
				?>
			</table>
		<br>
		<form method="post" class="form" action="?op=reporte">
		<input type="date" name="fecha1">
		<input type="date" name="fecha2">
		<input type="submit" name="generar_reporte">
		</form>
	</div>