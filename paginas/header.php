<!DOCTYPE html>
<html>
<head>
<title>OneLand</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" href="img/favicon.png" type="image/png" sizes="16x16">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<!--slider-->
<head>
    <img class="mySlides" src="img/1.jpg" style="width:100%">
    <img class="mySlides" src="img/2.jpg" style="width:100%">
    <img class="mySlides" src="img/3.jpg" style="width:100%">
    <img class="mySlides" src="img/4.jpg" style="width:100%">
  </div>
</head>
<!--fin del slider-->
<!--menu-->
<nav class="menu">
  <div class="topnav" id="myTopnav">
    <a href="?op=bienvenida" class="active"><img class="logo" src="img/favicon.png">OneLand</a>
    <a href="?op=consultar_terrenos">Terrenos en Venta</a>
    <a href="?op=acceso">Vendo un Terreno</a>
    <a href="?op=acceso">Iniciar Sesión</a>
    <a href="?op=nosotros">Nosotros</a>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
      <i class="fa fa-bars"></i>
    </a>
</div>
</nav>
<!--fin del menu-->
<!--controles-->
<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2000); // Change image every 2 seconds
}
/*control del menu*/
function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
        x.className += " responsive";
    } else {
        x.className = "topnav";
    }
}
</script>
<!--end controles-->
</body>
</html>
