<?php
//Punto 8 PDF
    require_once './autoload.inc.php';
    header_remove();
?>
    <?php
    $msg="";
    $msg.="<hr><h1>PEDIDO Nº " . $pedido->id . " :</h1><hr><br><br>";
    $msg.= "DATOS DE CLIENTE:<br>";
    $msg.= "Nombre: " . $usuario->nombre . "<br>";
    $msg.= "Email: " . $usuario->email . "<br>";
    $msg.="DIRECCIÓN DE ENVÍO:</br>";
    $msg.=  "Provincia: " . $pedido->provincia . "<br>";
    $msg.= "Localidad: " . $pedido->localidad . "<br>";
    $msg.= "Dirección: " . $pedido->direccion . "<br>";
    $msg.= "DATOS DEL PEDIDO :<br>";
    $msg.= "Id de pedido: " . $pedido->id . "<br>";
    $msg.= "Estado del pedido: " . $pedido->estado . "<br>";
    //PUNTO 10 PERSONALIZADO SI LOS PEDIDOS SON SUPERIORES A 50 SE DESCUENTAN 4 EUROS DE TRANSPORTE DEL PEDIDO TOTAL
    if($pedido->coste>=50):
        $msg.="<br><h3>Gatos de envío: -4 $ </h3><br>";
        $msg.="<strike>TOTAL A PAGAR : " . $pedido->coste . "</strike><br><hr>";
        $msg.="<h3>TOTAL A PAGAR : " . $pedido->coste-4 . "</h3><br><hr>";
    else:
        $msg.="<h3>TOTAL A PAGAR : " . $pedido->coste . "</h3><br><hr>";
    endif;
    
//Se crea un objeto dompdf
// reference the Dompdf namespace
ob_clean();
ob_start();


use Dompdf\Dompdf;
// instantiate and use the dompdf class
$dompdf = new Dompdf();
//Se activan las opciones para mostrar imágenes
$options= $dompdf->getOptions();
$options->set(array('isRemoteEnabled' => true));
$dompdf->setOptions($options);
$dompdf->loadHtml($msg);
//$dompdf->loadHtml("Hola Mundo");
//Formato de impresión del pdf
$dompdf->setPaper('letter');
//$dompdf->setPaper('A4','landscape');
$dompdf->render();
//Con attachment se dice si se descarga el pdf o no, si es true se descarga, si es false no
$dompdf->stream("archivo.pdf", array("Attachment"=>false));
ob_flush();
?>
