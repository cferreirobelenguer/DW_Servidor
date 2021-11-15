<?php
include_once 'app/config.php';

// Cargo los datos segun el formato de configuración
// cargarDatostxt
function cargarDatos()
{
    $funcion = __FUNCTION__ . TIPO;
    return $funcion();
}

function volcarDatos($valores)
{
    $funcion = __FUNCTION__ . TIPO;
    $funcion($valores);
}

// ----------------------------------------------------
// FICHERO DE TEXT 
//Carga los datos de un fichero de texto
function cargarDatostxt()
{
    $tabla = [];
    $tabla_ = [];
    // Si no existe lo creo
    if (!is_readable(FILEUSER)) {
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich = @fopen(FILEUSER, "w") or die("Error al crear el fichero.");
        fclose($fich);
    }
    $fich = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura

    while ($linea = fgets($fich)) {
        $partes = explode('|', trim($linea));
        // Escribimos la correspondiente fila en tabla
        $tabla = [$partes[0], $partes[1], $partes[2], $partes[3]];
        array_push($tabla_, $tabla);
    }
    fclose($fich);
    return $tabla_;
}
//Vuelca los datos a un fichero de texto
function volcarDatostxt($tvalores)
{

    $fich2 = @fopen(FILEUSER, "w");
    //print_r($tvalores);
    foreach ($tvalores as $lineas) {

        $lineas = implode($lineas);
        //echo $lineas;
        fwrite($fich2, $lineas);
    }

    fclose($fich2);
}

// ----------------------------------------------------
// FICHERO DE CSV

function cargarDatoscsv()
{
    $tabla2 = [];
    if (!is_readable(FILEUSER)) {
        // El directorio donde se crea tiene que tener permisos adecuados
        $fich3 = @fopen(FILEUSER, "w") or die("Error al crear el fichero.");
        fclose($fich3);
    }
    $fich3 = @fopen(FILEUSER, 'r') or die("ERROR al abrir fichero de usuarios"); // abrimos el fichero para lectura
    while (($linea_ = fgetcsv($fich3))) {
        // Escribimos la correspondiente fila en tabla
        array_push($tabla2, $linea_);
    }
    fclose($fich3);
    return $tabla2;
}


//Vuelca los datos a un fichero de csv
function volcarDatoscsv($tvalores)
{

    $fich4 = @fopen(FILEUSER, "w");
    foreach ($tvalores as $lineas) {

        fputcsv($fich4, $lineas);
    }


    fclose($fich4);
}
// ----------------------------------------------------

// FICHERO DE JSON
function cargarDatosjson()
{

    //Convertimos json a array
    $data = file_get_contents("dat/usuarios.json");
    $fich5 = json_decode($data, true);

    return $fich5;
}

function volcarDatosjson($tvalores)
{
    //Retorna la representación JSON del valor dado
    $tvalores_ = json_encode($tvalores);
    $file = FILEUSER;
    //echo $tvalores_;
    file_put_contents($file, $tvalores_);
}


// MOSTRAR LOS DATOS DE LA TABLA DE ALMACENADA EN AL SESSION 
function mostrarDatos()
{

    $titulos = ["Nombre", "login", "Password", "Comentario"];
    $msg = "<table>\n";
    // Identificador de la tabla
    $msg .= "<tr>";
    for ($j = 0; $j < CAMPOSVISIBLES; $j++) {
        $msg .= "<th>$titulos[$j]</th>";
    }
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $id = 0;
    $nusuarios = count($_SESSION['tuser']);
    for ($id = 0; $id < $nusuarios; $id++) {
        $msg .= "<tr>";
        $datosusuario = $_SESSION['tuser'][$id];
        for ($j = 0; $j < CAMPOSVISIBLES; $j++) {
            $msg .= "<td>$datosusuario[$j]</td>";
        }
        $msg .= "<td><a href=\"#\" onclick=\"confirmarBorrar('$datosusuario[0]',$id);\" >Borrar</a></td>\n";
        $msg .= "<td><a href=\"" . $auto . "?orden=Modificar&id=$id\">Modificar</a></td>\n";
        $msg .= "<td><a href=\"" . $auto . "?orden=Detalles&id=$id\" >Detalles</a></td>\n";
        $msg .= "</tr>\n";
    }
    $msg .= "</table>";

    return $msg;
}

/*
 *  Funciones para limpiar la entreda de posibles inyecciones
 */


// Función para limpiar todos elementos de un array
function limpiarArrayEntrada(array &$entrada)
{
    //print_r($entrada);
    foreach ($entrada as $valor) {
        $valor = htmlspecialchars($valor);
        $valor = trim($valor);
        $valor = stripslashes($valor);
    }
}
