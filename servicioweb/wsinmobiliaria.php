<?php
	include 'clsinmobiliaria.php';
	$soap= new SoapServer(null, array('uri' => 'http://localhost/'));
	$soap->setClass('clsinmobiliaria');
	$soap-> handle();

?>