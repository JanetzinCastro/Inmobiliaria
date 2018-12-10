<?php
session_start();
$pagina=isset($_GET['op'])? strtolower($_GET['op']): 'bienvenida';
require_once'paginas/header.php';
require_once'paginas/'.$pagina.'.php';
require_once'paginas/footer.php';

?>