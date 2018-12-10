<?php
//guarda los datos que se capturaron en las cajas de texto del formulario
$usuario=" ";
$contra=" ";

//recibe los datos que devuelve metodo del web service
$datos=array();

//Verifica que tengan informacion
if(!empty($_POST['txtUsuarios']) && !empty($_POST['txtContrasena']) ){
	//toma los valores de la caja de texto
	$usuario=htmlspecialchars($_POST['txtUsuarios']);
	$contra=htmlspecialchars($_POST['txtContrasena']);
	
	//hace uso del servicio web que esta pulicando en el webhost
	$cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));
    //se ejecuta el metodo del servicio web, pasando sus parametros 
	$datos=$cliente->acceso($usuario,$contra);
	//hasta aqui ya recibieron los resultados del servicio web
	//echo '<pre>'; 
	//print_r($datos); echo '</pre>';

	//verifica si encontro o no al usuario
	if((int)$datos[0]["CLAVE"]!= 0){

		if (!isset($_SESSION['cveUsuario'])){
			$_SESSION['cveUsuario']=$datos[0]["CLAVE"];
		}

		if (!isset($_SESSION['nomUsuario'])) {
			$_SESSION['nomUsuario']=$datos[1]["NOMBRE"];
		}

		if (!isset($_SESSION['nRol'])) {
			$_SESSION['nRol']=$datos[2]["ROL"];
		}

        //verificar el rol
        //nombre
        if($datos[2]["ROL"]=="Administrador")
		{	    //envia a la pagina principal de administrar .$datos[0]["CLAVE"].
	    	echo '<script language="javascript">alert("Bienvenido '.$datos[1]["NOMBRE"].', estas accediendo como '.$datos[2]["ROL"].'");document.location.href="?op=inicio_admin";</script>';
		}
		
		else{	    			    //envia a la pagina principal de administrar .$datos[0]["CLAVE"].
		    	echo '<script language="javascript">alert("Bienvenido '.$datos[1]["NOMBRE"].', estas accediendo como '.$datos[2]["ROL"].'");document.location.href="?op=perfil";</script>';
		    }
	}	

	else{
	    //NO encuentra al usuario
	    $datos[0]=0;
	    	echo '<script language="javascript">alert("Acceso denegado, Verifica tus datos o Llena tu registro");document.location.href="?op=registro_usuario";</script>';
	}
}

?>
 <!--==============================content=================================-->
<!-- start banner Area -->
<form class="modal-content animate" action="<?php $_SERVER['PHP_SELF']; ?>"  method="POST" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">
	<div class="login">
	  <div class="login-header">
	    <h1>Iniciar Sesión</h1>
	  </div>
	  <div class="login-form">
	    <h3>Usuario:</h3>
	    <input type="text" placeholder="Nombre de Usuario" name="txtUsuarios" required>
	    <h3>Contraseña:</h3>
	    <input type="password" placeholder="Ingresar Contraseña" name="txtContrasena" required>
	    <br>
	  	<input type="submit" value="Entrar" class="login-button"/>
	    <br>
	    <a href="?op=registro_usuario" class="sign-up">Registrarse!</a>
	    <br>
	  </div>
	</div>
</form>

<!-- End banner Area -->
