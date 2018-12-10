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
  $datos=$cliente->mostrarPerfil($id);

  ?>
<section class="culture-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding">
    <div class="container" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">

      <?php echo '<h1 style="color: white">Tu Perfil: '.$_SESSION['nomUsuario'].'</h1>';?>
      <p style="color: gray">Tenemos un lugar para Ti.</p>
      <div class="red-border"></div>
      

          <div class="card">
          <img src="img/user.png" alt="user" style="border-radius: 50%; width:10%">
          <?php

       if (empty($datos)) {
        echo '<script language="javascript">alert("Completa tu Perfil");document.location.href="?op=reg_perfil";</script>';

       }else{
        for($i=0;$i<count($datos);$i++){

          echo "<h1>".$datos[$i]["NOMBRE_USUARIO"]."</h1>";
          echo "<p class='title'>Tel.".$datos[$i]["TELEFONO"]."</p>";
          echo "<p class='title'>E-Mail ".$datos[$i]["CORREO"]."</p>";

          echo "<h4>Dirección:</h4>";
          echo "<p class='title'>".$datos[$i]["CALLE"]."</p>";
          echo "<p class='title'>".$datos[$i]["COLONIA"]."</p>";
          echo "<p class='title'>".$datos[$i]["MUNICIPIO"]."</p>";
          echo "<p class='title'>".$datos[$i]["ESTADO"]."</p>";

          echo "<h4>Forma de Pago:</h4>";
          echo "<p class='title'>".$datos[$i]["FORMA_PAGO"]."</p>";

          echo "<div style='margin: 24px 0;'>";
          echo "<a href='#'><i class='fa fa-twitter'></i></a>";   
          echo "<a href='#'><i class='fa fa-facebook'></i></a>"; 
          echo "</div>";

          echo "<p><a class='ct-u-marginTop60 btn btn-solodev-red-reversed btn-fullWidth-sm ct-u-size19' href='?op=editar_perfil'>Editar</a></p>";
          echo "</div>";
      echo "</div>";
    echo "</div>";
    echo "</div>";
echo "</section>";
        }
    }
  }
    ?>



