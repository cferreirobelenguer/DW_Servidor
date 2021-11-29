
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESCARGA DE ARCHIVOS</title>
</head>
<body>
<h2>Subida de ficheros a un servidor Web</h2>
    
    <form action="ficheros.php" method="GET">
        <p>
            <label for="nombre">Indique su canción favorita: </label>
            <input type="text" name="cancion">
        </p>
        <p>
            <label for="gustos">Gustos musicales: </label>
            <input type="text" name="gustos">
        </p>
        
            <input type="submit" name="subir" value="Enviar datos">
        </form>
</body>
</html>