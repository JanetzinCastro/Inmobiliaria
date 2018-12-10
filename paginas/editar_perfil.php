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
	$id=$_SESSION['cveUsuario']; 
	$NOMUSU=" ";
	$CON=" ";
    $TELEFONO=" ";
    $EMAIL=" ";
    $CALLE=" ";
    $COLONIA=" ";
    $MUNICIPIO=" ";
    $ESTADO=" ";
    $PAGOCVE=" ";

    //recibe los datos que devuelve metodo del web service
    $datos=array();

       if (isset($_SESSION['cveUsuario'])&&(!empty($_SESSION['cveUsuario']))){//start session

          if(!empty($_POST['txtUsuario']) &&!empty($_POST['txtContra']) &&!empty($_POST['txtTelefono']) && !empty($_POST['txtEmail'])&& !empty($_POST['txtCalle'])&& !empty($_POST['txtMunicipio'])&& !empty($_POST['txtColonia'])&& !empty($_POST['txtMunicipio'])&& !empty($_POST['sltEstado'])&& !empty($_POST['sltPago']) ){

            
      //toma los valores de la caja de texto
        $id=$_SESSION['cveUsuario'];

        $NOMUSU=htmlspecialchars($_POST['txtUsuario']);
        $CON=htmlspecialchars($_POST['txtContra']);

        $TELEFONO=htmlspecialchars($_POST['txtTelefono']);
        $EMAIL=htmlspecialchars($_POST['txtEmail']);
        $CALLE=htmlspecialchars($_POST['txtCalle']);
        $COLONIA=htmlspecialchars($_POST['txtColonia']);
        $MUNICIPIO=htmlspecialchars($_POST['txtMunicipio']);
        $ESTADO=htmlspecialchars($_POST['sltEstado']);
        $PAGOCVE=htmlspecialchars($_POST['sltPago']);

              //hace uso del servicio web que esta pulicando en el webhost
            $cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));

            $datos=$cliente->editarPerfil($id,$NOMUSU,$CON,$TELEFONO,$EMAIL,$CALLE,$COLONIA,$MUNICIPIO,$ESTADO,$PAGOCVE);
            //hasta aqui ya recibieron los resultados del servicio web
    
    //verifica si encontro o no al usuario
    if((int)$datos[0]["CLAVE"]!=0){
        //envia a la pagina principal de administrar
            echo '<script language="javascript">alert("Se ha actualizado tu Perfil correctamente");document.localtion.href="?op=perfil";</script>';
    }
    else{
        //NO encuentra al usuario
        $datos[0]=0;
            echo '<script language="javascript">alert("Error al actualizar el perfil");</script>';
    }

    }

        }//end session
?>
<!-- start banner Area -->
<form class="modal-content animate" method="POST" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">
    <div class="login">
      <div class="login-header">
        <h1>Perfil</h1>
      </div>
      <div class="login-form">

      	<h3>Nombre de Usuario:</h3>
        <input type="text" placeholder="Usuario" name="txtUsuario" required>

        <h3>Nueva Contraseña:</h3>
        <input type="text" placeholder="Contraseña" name="txtContra" required>

        <h3>Telefono:</h3>
        <input type="text" placeholder="Telefono" name="txtTelefono" required>

        <h3>E-Mail:</h3>
        <input type="text" placeholder="E-Mail" name="txtEmail" required>

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

        <h3>Forma de Pago:</h3>
        <div class="select" style="text-align:center;">
          <select name="sltPago">
            <option value="0">Selecciona una forma de pago:</option>
            <?php
                $query2 = $conn -> query ("SELECT * FROM INM_TIPO_PAGO");
                            
                while ($valores2 = mysqli_fetch_array($query2)) {
                                
                  echo '<option value="'.$valores2[PAGO_CVE].'">'.$valores2[PAGO_FORMA].'</option>';
                }    
            ?>
          </select>
        </div>

        <br>
        <input type="submit" value="Registrar" class="login-button"/>
        <br>
        <br>
      </div>
    </div>
</form>
<!-- End banner Area --> 

