<?php
$conn=mysqli_connect("localhost","id7035083_pepe","l33th4x0r","id7035083_bd_inmobiliaria");

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

if(isset($_POST['generar_reporte']))
{
	// NOMBRE DEL ARCHIVO Y CHARSET
	header('Content-Type:text/csv; charset=latin1');
	header('Content-Disposition: attachment; filename="Reporte_de_Terrenos.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'w');
	// ENCABEZADOS
	fputcsv($salida, array('ID', 'CALLE', 'COLONIA', 'MUNICPIO', 'ESTADO','LARGO', 'ANCHO', 'TOTAL', 'PRECIO', 'DESCRIPCION', 'ESTATUS', 'REGISTRO','TIPO'));
	// QUERY PARA CREAR EL REPORTE
	$reporteCsv=$conexion->query("SELECT *  FROM INM_TERRENO where TER_FECHA_REG BETWEEN '$fecha1' AND '$fecha2' ORDER BY TER_CVE");
	while($filaR= $reporteCsv->fetch_assoc())
		fputcsv($salida, array($filaR['TER_CVE'], 
								$filaR['TER_CALLE'],
								$filaR['TERR_COLONIA'],
								$filaR['TER_MUNICIPIO'],
								$filaR['TER_ESTADO'],
								$filaR['TER_LARGO'],
								$filaR['TER_ANCHO'],
								$filaR['TER_TOTAL'],
								$filaR['TER_PRECIO'],
								$filaR['TER_DESC'],
								$filaR['TER_ESTATUS'],
								$filaR['TER_ESTADO']));

}

?>