


<?php
//Se almacena el html en memoria
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<p><?php echo "Hola mundo"?></p>
</body>
</html>
<?php
//El html se almacena en una variable
$html=ob_get_clean();
//echo $html;
include_once './libreria/dompdf/autoload.inc.php';
//Se crea un objeto dompdf
use Dompdf\Dompdf;
$dompdf=new Dompdf();

//Se activan las opciones para mostrar imágenes
$options= $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml("Hola mundo");
//Formato de impresión del pdf
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4','landscape');
$dompdf->render();
//Con attachment se dice si se descarga el pdf o no, si es true se descarga, si es false no
$dompdf->stream("archivo.pdf", array("Attachment"=>false));


?>
