<?php
$conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");
?>
  <section class="story-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding" id="section">
    <div class="container text-center">
      <h2>ONELAND</h2>
      <h3>Misión</h3>
      <div class="col-md-8 col-md-offset-2">
        <div class="red-border"></div>
        <p class="ct-u-size22 ct-u-fontWeight300 marginTop40">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed libero vel ex maximus vulputate nec eu ligula. Vestibulum elementum nisi ut fermentum lobortis. Sed quis iaculis felis.</p>
      </div>
    </div>
  </section>

  <section class="culture-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding">
    <div class="container" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">
      
       <div>
        <div class="row" style="color: #E4E5E6">
            <div  class="column">
              <img src="img/zalma.jpg" width="30%" style="border-radius: 50%">
            <p>DOLOR SIT AMET</p>
            <p class="company-icons-subtext hidden-xs">Praesent sed libero vel ex maximus vulputate nec eu ligula.</p>
            </div>

            <div  class="column">
              <img src="img/alicia.jpg" width="30%" style="border-radius: 50%">
            <p>SED TRISTIQUE</p>
            <p class="company-icons-subtext hidden-xs">Vestibulum elementum nisi ut fermentum lobortis.</p>
            </div>

            <div  class="column">
              <img src="img/fredy.jpg" width="30%" style="border-radius: 50%">
            <p>SEMPER IPSUM</p>
            <p class="company-icons-subtext hidden-xs">Nullam bibendum felis non laoreet rutrum.</p>
            </div>
            <div  class="column">
              <img src="img/angel.jpg" width="30%" style="border-radius: 50%">
            <p>SEMPER IPSUM</p>
            <p class="company-icons-subtext hidden-xs">Nullam bibendum felis non laoreet rutrum.</p>
            </div>
      </div>

      </div>
      <a class="ct-u-marginTop60 btn btn-solodev-red-reversed btn-fullWidth-sm ct-u-size19" href="#contacto">Contáctanos</a>
    </div>
  </section>


  <section class="customers-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding">
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-md-offset-2">
          <h2>Tenemos un lugar para Ti</h2>
          <h3>Visíon.</h3>
          <div class="red-border"></div>
          <p class="ct-u-size22 ct-u-fontWeight300 ct-u-marginBottom60 marginTop40">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sed libero vel ex maximus vulputate nec eu ligula. Vestibulum elementum nisi ut fermentum lobortis. Sed quis iaculis felis.</p>
        </div>
        <div class="clearfix">
      </div>
    </div>
  </section>

  <section class="culture-section company-sections ct-u-paddingBoth50 paddingBothHalf noTopMobilePadding">
    <div class="container" style="background-image: url(img/login-background.jpg);background-repeat: no-repeat; background-position: center">

<section id="contacto">
<h3>¿Tienes alguna Pregunta?</h3>
<p>Nos gustaria ayudarte.</p>

<div class="container-contact">
  <form action="/action_page.php">
    <div class="row">
      <div class="col-25">
        <label for="fname">Nombre</label>
      </div>
      <div class="col-75">
        <input type="text" id="nombre" name="Nombre" placeholder="Tu Nombre..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="apellidos">Apellidos</label>
      </div>
      <div class="col-75">
        <input type="text" id="lname" name="Apellidos" placeholder="Apellidos..">
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="estado">Estado</label>
      </div>
      <div class="col-75">
        <select id="estado" name="estado">
          <option value="0">Selecciona un Estado:</option>
            <?php
                $query = $conn -> query ("SELECT * FROM INM_ESTADO");
                            
                while ($valores = mysqli_fetch_array($query)) {
                                
                  echo '<option value="'.$valores[ESTADO_CVE].'">'.$valores[ESTADO_NOMBRE].'</option>';
                }    
            ?>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-25">
        <label for="subject">Tu mensaje</label>
      </div>
      <div class="col-75">
        <textarea id="subject" name="subject" placeholder="Escribenos.." style="height:200px"></textarea>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Enviar">
    </div>
  </form>
</div>
</section>
</section>

