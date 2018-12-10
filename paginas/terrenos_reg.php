<div class="sidebar">
  <a href="?op=terrenos_reg">Terrenos Registrados</a>
  <a href="?op=usuarios_reg">Usuarios Registrados</a>
  <a href="?op=reg_admin">Registrar Administrador</a>
  <a href="?op=exportar">Generar reporte</a>
  <a href="?op=cerrar_sesion">Cerrar Sesion</a>
</div>

<?php
  $datos=array();

      //hace uso del servicio web que esta pulicando en el webhost
    $cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));

  if (isset($_SESSION['cveUsuario'])&&(!empty($_SESSION['cveUsuario']))&&isset($_SESSION['nomUsuario'])){

    $id=$_SESSION['cveUsuario'];
    $datos=$cliente->MostrarTerrenosReg($id);
?>

<?php
  if (empty($datos)) {
        echo '<script language="javascript">alert("No tienes usuarios registrados");document.location.href="?op=inicio_admin";</script>';

       }else{

    echo "<div class='container' style='background-image: url(img/login-background.jpg); background-position: center'>";
    echo '<center>';
      echo '<h1 style="color: white">Terrenos Registrados</h1>';
    echo '</center>';
    for($i=0;$i<count($datos);$i++){
      echo "<div class='cardT'>";

      echo "<div class='id'>";
      echo "<label>Terreno</label>";
      echo "<h2>".($i+1)."</h2>";
      echo "</div>";

      echo "<div class='colonia'>";
      echo "<label>MEDIDAS</label>";
      echo "<h2>".$datos[$i]["MEDIDAS"]."</h2>";
      echo "</div>";

      echo "<div class='largo'>";
      echo "<label>PRECIO</label>";
      echo "<h2>$. ".$datos[$i]["PRECIO"]." MXN.</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>PROPIETARIO</label>";
      echo "<h2>".$datos[$i]["PROPIETARIO"]."</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>TIPO DE TERRENO</label>";
      echo "<h2>".$datos[$i]["TIPO"]."</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>DESCRIPCION</label>";
      echo "<h2>".$datos[$i]["DESCRIPCION"]."</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>ESTATUS</label>";
      echo "<h2>".$datos[$i]["ESTATUS"]."</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>FECHA DE REGISTRO</label>";
      echo "<h2>".$datos[$i]["FECHA_REGISTRO"]."</h2>";
      echo "</div>";
      echo"</div>";

      echo "<center>";
      echo "<label><a href='?op=terrenos_reg&opcion=".$datos[$i]["ID"]."' style='color:rgb(228, 0, 43);font-size:18px;'>ELIMINAR</a></label>";
      echo "</center>";
    }
    echo"</div>";
    }
   }

   $datosE=array();
    $CLAVE=0;
      if(isset($_GET['opcion'])){
      $CLAVE = $_GET['opcion'];
          $datosE = $cliente -> eliminarTerreno($CLAVE);
          if((int)$datosE[$i]["ID"] != 0){
          echo '<script language="javascript">alert("No se pudo eliminar.")</script>';
        } else {
          echo '<script language="javascript">alert("Terreno eliminado.");document.location.href="?op=terrenos_reg";</script>';
        }
  }
?>