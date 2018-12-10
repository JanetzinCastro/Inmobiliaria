<?php
$conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
$datos=array();

      //hace uso del servicio web que esta pulicando en el webhost
    $cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));

if (isset($_POST['buscar'])) {
    $ESTADO=htmlspecialchars($_POST['sltEstado']);
    $TIPO=htmlspecialchars($_POST['sltTipo']);
    $datos=$cliente->BuscarTerrenos($ESTADO,$TIPO);
    
}

else{

    $ESTADO="";
    $TIPO="";
    $datos=$cliente->BuscarTerrenos($ESTADO,$TIPO);
}

?>
  <form action="" method="post">
    <table>
        <tr>
            <td> 
                <div class="select" style="text-align:center;">
          <select name="sltEstado">
            <option value="0">Selecciona un Estado:</option>
            <?php
                $query = $conn -> query ("SELECT * FROM INM_ESTADO");
                            
                while ($valores = mysqli_fetch_array($query)) {
                                
                  echo '<option value="'.$valores[ESTADO_NOMBRE].'">'.$valores[ESTADO_NOMBRE].'</option>';
                }    
            ?>
          </select>
        </div>  
            </td>
        </tr>

        <tr>
            <td>
                <div class="select" style="text-align:center;">
          <select name="sltTipo">
            <option value="0">Selecciona un Tipo:</option>
            <?php
                $query = $conn -> query ("SELECT * FROM INM_TIPO_TERRENO");
                            
                while ($valores = mysqli_fetch_array($query)) {
                                
                  echo '<option value="'.$valores[TIPO_NOMBRE].'">'.$valores[TIPO_NOMBRE].'</option>';
                }    
            ?>
          </select>
        </div>
            </td>
        </tr> 
            <td>
                <input href="#terrenos" type="submit" value="CONSULTAR" id="buscar" name="buscar">
            </td>
    </table>
</form>

<section id="terrenos">
<?php 
   echo "<div class='container' style='background-image: url(img/login-background.jpg); background-position: center'>";
    echo '<center>';
      echo '<h1 style="color: white">Terrenos Disponibles</h1>';
    echo '</center>';
    for($i=0;$i<count($datos);$i++){
      echo "<div class='cardT'>";

      echo "<div class='id'>";
      echo "<label>Terreno</label>";
      echo "<h2>".($i+1)."</h2>";
      echo "</div>";

      echo "<div class='calle'>";
      echo "<label>DIRECCIÓN</label>";
      echo "<h2>".$datos[$i]["DIRECCION"]."</h2>";
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
      echo "<label>FECHA DE REGISTRO</label>";
      echo "<h2>".$datos[$i]["FECHA_REGISTRO"]."</h2>";
      echo "</div>";

      echo "<div class='municipio'>";
      echo "<label>TIPO DE TERRENO</label>";
      echo "<h2>".$datos[$i]["TIPO"]."</h2>";
      echo "</div>";
      
      echo"</div>";
  }
?>
 </div>
 </section>

