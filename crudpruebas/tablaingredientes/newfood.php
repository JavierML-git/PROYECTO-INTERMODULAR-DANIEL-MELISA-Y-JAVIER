<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir ingredientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="newfood.css" type="text/css">
    
</head>
<body>
    <div class="card">
        <h1> Añadir ingredientes </h1>

        <form action="savefood.php" method="post">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre">
        <br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria">
        <br><br>

        <label for="cantidad_actual">Cantidad_actual:</label>
        <input type="text" name="cantidad_actual" id="cantidad_actual">
        <br><br>

        <label for="unidad_medida">Unidad de medida:</label>
        <input type="text" name="unidad_medida" id="unidad_medida">
        <br><br>

        <label for="proveedor">Proveedores:</label>
        <input type="text" name="proveedor" id="proveedor">
        <br><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio">
        <br><br>

        <label for="fecha_actualizacion">Fecha de actualización:</label>
        <input type="date" name="fecha_actualizacion" id="fecha_actualizacion">
        <br><br>
        
        <label for="fecha_caducidad">Fecha de caducidad:</label>
        <input type="date" name="fecha_caducidad" id="fecha_caducidad">
        <br><br>
        
        <input type="submit" value="Guardar">
        </form>

    <a href="javascript:history.back()" class="btn-back">← Volver atrás</a>
    </div>
    
</body>
</html>