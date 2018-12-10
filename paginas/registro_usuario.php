<?php
//guarda los datos que se capturaron en las cajas de texto del formulario
$NOMBRE=" ";
$APELLIDOPAT=" ";
$APELLIDOMAT=" ";
$NOMUSU=" ";
$PASS=" ";
$PASS2=" ";
//recibe los datos que devuelve metodo del web service
$datos=array();

//Verifica que tengan informacion
if(!empty($_POST['txtNombre'])&& !empty($_POST['txtPaterno']) && !empty($_POST['txtMaterno']) && !empty($_POST['txtNomUsu']) && !empty($_POST['txtPass']) && !empty($_POST['txtPass2'])){
	//toma los valores de la caja de texto
	
	$NOMBRE=htmlspecialchars($_POST['txtNombre']);
	$APELLIDOPAT=htmlspecialchars($_POST['txtPaterno']);
	$APELLIDOMAT=htmlspecialchars($_POST['txtMaterno']);
	$NOMUSU=htmlspecialchars($_POST['txtNomUsu']);
	$PASS=htmlspecialchars($_POST['txtPass']);
	$PASS2=htmlspecialchars($_POST['txtPass2']);
	
	if ($PASS == $PASS2) {
	//hace uso del servicio web que esta pulicando en el webhost
	$cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));
    //se ejecuta el metodo del servicio web, pasando sus parametros 
	$datos=$cliente->regUsuario($NOMBRE,$APELLIDOPAT,$APELLIDOMAT,$NOMUSU,$PASS);
	//hasta aqui ya recibieron los resultados del servicio web
	
	//verifica si encontro o no al usuario
	if((int)$datos[0]["CLAVE"]!=0){
	    //envia a la pagina principal de administrar
	    	echo '<script language="javascript">alert("Se ha registrado tu Usuario '.$datos[0]["CLAVE"].', correctamente");document.localtion.href="?op=perfil";</script>';
	}
	else{
	    //NO encuentra al usuario
	    $datos[0]=0;
	    	echo '<script language="javascript">alert("Error al registrar");</script>';
	}
	}else{
		echo '<script language="javascript">alert("Error las contraseñas no son iguales");</script>';
	}
}
?>
<!-- start banner Area -->
<form class="modal-content animate" method="POST" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">
	<div class="login">
	  <div class="login-header">
	    <h1>Registro de Usuario</h1>
	  </div>
	  <div class="login-form">

	  	<h3>Nombre:</h3>
	    <input type="text" placeholder="Nombre" name="txtNombre" required>

	     <h3>Apellido Paterno:</h3>
	    <input type="text" placeholder="Apellido Paterno" name="txtPaterno" required>

	    <h3>Apellido Materno:</h3>
	    <input type="text" placeholder="Apellido Materno" name="txtMaterno" required>

	    <h3>Nombre de Usuario:</h3>
	    <input type="text" placeholder="Nombre de Usuario" name="txtNomUsu" required>

	    <h3>Contraseña:</h3>
	    <input type="password" placeholder="Ingresar Contraseña" name="txtPass" required>

	    <br>
	    <input type="password" placeholder="Repetir Contraseña" name="txtPass2" required>
	    <br>

	  	<input type="submit" value="Registrar" class="login-button"/>
	    <br>
	    <br>
	  </div>
	</div>
</form>

<!-- End banner Area -->	
<!-- $CALLE=" ";
$COLONIA=" ";
$MUNICIPIO=" ";
$ESTADO=" ";
$LARGO=" ";
$ANCHO=" ";
$TOTAL=" ";
$PRECIO=" ";
$USU_CVE=" ";
$TIPO=" ";-->