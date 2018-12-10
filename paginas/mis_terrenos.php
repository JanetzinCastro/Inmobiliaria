<div class="sidebar">
  <a href="?op=mis_terrenos">Mis Terrenos</a>
  <a href="?op=perfil">Mi perfil</a>
  <a href="?op=editar_perfil">Editar Mi perfil</a>
  <a href="?op=reg_terreno">Registrar Terreno</a>
  <a href="?op=cerrar_sesion">Cerrar Sesion</a>
</div>

<?php
	$datos=array();

	  //hace uso del servicio web que esta pulicando en el webhost
  	$cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));

	if (isset($_SESSION['cveUsuario'])&&(!empty($_SESSION['cveUsuario']))&&isset($_SESSION['nomUsuario'])){

		$id=$_SESSION['cveUsuario'];
		$datos=$cliente->mostrarTerreno($id);
?>

<?php
	if (empty($datos)) {
        echo '<script language="javascript">alert("No tienes terrenos registrados");document.location.href="?op=reg_terreno";</script>';

       }else{

		echo "<div class='container' style='background-image: url(img/login-background.jpg); background-position: center'>";
		echo '<center>';
			echo '<h1 style="color: white">Mis terrenos</h1>';
		echo '</center>';
		for($i=0;$i<count($datos);$i++){
			echo "<div class='cardT'>";

			echo "<div class='id'>";
			echo "<label>TERRENO</label>";
			echo "<h2>".($i+1)."</h2>";
			echo "</div>";

			echo "<div class='calle'>";
			echo "<label>CALLE</label>";
			echo "<h2>".$datos[$i]["CALLE"]."</h2>";
			echo "</div>";

			echo "<div class='colonia'>";
			echo "<label>COLONIA</label>";
			echo "<h2>".$datos[$i]["COLONIA"]."</h2>";
			echo "</div>";

			echo "<div class='municipio'>";
			echo "<label>MUNICIPIO</label>";
			echo "<h2>".$datos[$i]["MUNICIPIO"]."</h2>";
			echo "</div>";

			echo "<div class='largo'>";
			echo "<label>LARGO</label>";
			echo "<h2>".$datos[$i]["LARGO"]."</h2>";
			echo "</div>";

			echo "<div class='ancho'>";
			echo "<label>ANCHO</label>";
			echo "<h2>".$datos[$i]["ANCHO"]."</h2>";
			echo "</div>";

			echo "<div class='superficie'>";
			echo "<label>SUPERFICIE</label>";
			echo "<h2>".$datos[$i]["SUPERFICIE"]."</h2>";
			echo "</div>";

			echo "<div class='precio'>";
			echo "<label>PRECIO</label>";
			echo "<h2>".$datos[$i]["PRECIO"]."</h2>";
			echo "</div>";

			echo "<div class='descripcion'>";
			echo "<label>DESCRIPCION</label>";
			echo "<h2>".$datos[$i]["DESCRIPCION"]."</h2>";
			echo "</div>";

			echo "<div class='tipo'>";
			echo "<label>TIPO</label>";
			echo "<h2>".$datos[$i]["TIPO"]."</h2>";
			echo "</div>";

			echo "<div class='fecha'>";
			echo "<label>FECHA DE REGISTRO</label>";
			echo "<h2>".$datos[$i]["FECHA"]."</h2>";
			echo "</div>";
			echo"</div>";

			echo "<center>";
			echo "<label><a href='?op=mis_terrenos&opcion=".$datos[$i]["ID"]."' style='color:rgb(228, 0, 43);font-size:18px;'>ELIMINAR</a></label>";

			echo "<label><a href='?op=editar_terreno&opcion=".$datos[$i]["ID"]."'style='color:white;font-size:18px;'>EDITAR</a></label>";
			echo "</center>";
		}
		echo"</div>";
		}
	 }

	 $datosE=array();
 		$CLAVE=0;
			if(isset($_GET['opcion'])){
    	$CLAVE = $_GET['opcion'];
        	$datosE = $cliente -> bajaTerreno($CLAVE);
		    	if((int)$datosE[$i]["ID"] != 0){
		    	echo '<script language="javascript">alert("No se pudo eliminar.")</script>';
		    } else {
		    	echo '<script language="javascript">alert("Terreno eliminado.");document.location.href="?op=mis_terrenos";</script>';
		    }
	}
?>