<?php
	//se debe siempre verificar si las variables de sesion existen para evitar errores
	if (isset($_SESSION['nomUsuario']))unset($_SESSION['nomUsuario']);//libera la variable de sesion
	if (isset($_SESSION['cveUsuario']))unset($_SESSION['cveUsuario']);
	if (isset($_SESSION['nRol']))unset($_SESSION['nRol']);

	session_destroy();//destruye la sesion completa

	echo '<script language="javascript">alert("Cerrando Sesión");document.location.href="?op=bienvenida";</script>';
?>