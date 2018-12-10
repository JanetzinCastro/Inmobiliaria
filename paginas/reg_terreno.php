<div class="sidebar">
  <a href="?op=mis_terrenos">Mis Terrenos</a>
  <a href="?op=perfil">Mi perfil</a>
  <a href="?op=editar_perfil">Editar Mi perfil</a>
  <a href="?op=reg_terreno">Registrar Terreno</a>
  <a href="?op=cerrar_sesion">Cerrar Sesion</a>
</div>

<?php
  $conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
  //guarda los datos que se capturaron en las cajas de texto del formulario

  //resgistrar
  $CALLE=" ";
  $COLONIA=" ";
  $MUNICIPIO=" ";
  $ESTADO=" ";
  $LARGO=" "; 
  $ANCHO=" ";
  $PRECIO=" "; 
  $DESCRIPCION=" "; 
  $USUCVE=$_SESSION['cveUsuario'];
  $TIPOCVE=" ";

  //recibe los datos que devuelve metodo del web service
  $datos=array();

  if (isset($_SESSION['cveUsuario'])&&(!empty($_SESSION['cveUsuario']))){ 

  if(!empty($_POST['txtCalle']) && !empty($_POST['txtColonia'])&& !empty($_POST['txtMunicipio'])&& !empty($_POST['sltEstado'])&& !empty($_POST['txtLargo'])&& !empty($_POST['txtAncho'])&& !empty($_POST['txtPrecio'])&& !empty($_POST['txtDescripcion']) && !empty($_POST['sltTipo'])){

        $CALLE=htmlspecialchars($_POST['txtCalle']);
        $COLONIA=htmlspecialchars($_POST['txtColonia']);
        $MUNICIPIO=htmlspecialchars($_POST['txtMunicipio']);
        $ESTADO=htmlspecialchars($_POST['sltEstado']);
        $LARGO=htmlspecialchars($_POST['txtLargo']); 
        $ANCHO=htmlspecialchars($_POST['txtAncho']);
        $PRECIO=htmlspecialchars($_POST['txtPrecio']);
        $DESCRIPCION=htmlspecialchars($_POST['txtDescripcion']);
        $USUCVE=$_SESSION['cveUsuario'];
        $TIPOCVE=htmlspecialchars($_POST['sltTipo']);

        //hace uso del servicio web que esta pulicando en el webhost
            $cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));

            $datos=$cliente->regTerreno($CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$LARGO,$ANCHO,$PRECIO,$DESCRIPCION,$USUCVE,$TIPOCVE);
  //verifica si encontro o no al usuario
    if((int)$datos[0]["CLAVE"]!=0){
        //envia a la pagina principal de administrar
            echo '<script language="javascript">alert("Se ha registrado tu Terreno correctamente");document.localtion.href="?op=perfil";</script>';
    }
    else{
        //NO encuentra al usuario
        $datos[0]=0;
            echo '<script language="javascript">alert("Error al registrar el Terreno");</script>';
    }

    }

        }//end session
?>

<form class="modal-content animate" method="POST" style="background-image: url(img/login-background.jpg); background-position: center">
    <div class="login">
      <div class="login-header">
        <h1>Registro de Terreno</h1>
      </div>
      <div class="login-form">

        <h3>Calle:</h3>
        <input type="text" placeholder="Calle" name="txtCalle" required>

         <h3>Colonia:</h3>
        <input type="text" placeholder="Colonia" name="txtColonia" required>

        <h3>Municipio:</h3>
        <input type="text" placeholder="Municipio o ciudad" name="txtMunicipio" required>
    
        <h3>Estado:</h3>
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

        <h3>Medidas:</h3>
        <h5 style="color: white">Largo: </h5>
        <input class="select" type="number" name="txtLargo" placeholder="metros">
        <h5 style="color: white">Ancho: </h5>
        <input class="select" type="number" name="txtAncho" placeholder="metros">

        <h3>Precio:</h3><br>
        <input class="select" type="number" name="txtPrecio" placeholder="$.. pesos MXN">
        <br><br>

        <h3>Carateristicas:</h3><br>
        <textarea id="subject" name="txtDescripcion" placeholder="Descripción.." style="height:50px"></textarea>

        <br><br>
        <h3>Tipo de Terreno:</h3>
        <div class="select" style="text-align:center;">
          <select name="sltTipo">
            <option value="0">Selecciona un Tipo:</option>
            <?php
                $query = $conn -> query ("SELECT * FROM INM_TIPO_TERRENO");
                            
                while ($valores = mysqli_fetch_array($query)) {
                                
                  echo '<option value="'.$valores[TIPO_CVE].'">'.$valores[TIPO_NOMBRE].'</option>';
                }    
            ?>
          </select>
        </div>
        <input type="submit" value="Registrar" class="login-button"/>
        <br>
      </div>
    </div>
</form>