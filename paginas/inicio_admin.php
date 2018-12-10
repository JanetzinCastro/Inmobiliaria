<?php
  
  $datos=array();
    
    //hace uso del servicio web que esta pulicando en el webhost
  $cliente= new SoapClient(null, array('uri' => 'http://localhost/','location' => 'https://misitioupmh.000webhostapp.com/Inmobiliaria/servicioweb/wsinmobiliaria.php'));
    
  if (isset($_SESSION['cveUsuario'])&&(!empty($_SESSION['cveUsuario']))&&isset($_SESSION['nomUsuario'])){

  $id=$_SESSION['cveUsuario'];

  ?>
<section class="culture-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding">
    <div class="container" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">

      <?php echo '<h1 style="color: white">Tu Perfil: '.$_SESSION['nomUsuario'].'</h1>';}?>
      <p style="color: gray">Panel de Administración.</p>
      <div class="red-border"></div>
      	<div class="sidebar">
  		<a href="?op=terrenos_reg">Terrenos Registrados</a>
  		<a href="?op=usuarios_reg">Usuarios Registrados</a>
  		<a href="?op=reg_admin">Registrar Administrador</a>
  		<a href="?op=cerrar_sesion">Cerrar Sesion</a>
		</div>
</section>

