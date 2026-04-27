<?php

include '../conexion.php';

$id = $_GET['id'];
$editData = $newobj->prepare("SELECT * FROM ingredientes WHERE id_ingrediente = :id_ingrediente");
$editData->bindParam(':id_ingrediente', $id);
$editData->execute();
$result = $editData->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="editfood.css" type="text/css">
</head>
<body>
    <div class="card">
        <h1>Editar Ingrediente</h1>
        <form action="updatefood.php" method="POST">

        <input type="hidden" name="id_ingrediente" value="<?php echo $result['id_ingrediente']; ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="<?php echo $result['nombre']; ?>">
        <br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" name="categoria" id="categoria" value="<?php echo $result['categoria']; ?>">
        <br><br>

        <label for="cantidad_actual">Cantidad_actual:</label>
        <input type="text" name="cantidad_actual" id="cantidad_actual" value="<?php echo $result['cantidad_actual']; ?>">
        <br><br>

        <label for="unidad_medida">Unidad de medida:</label>
        <input type="text" name="unidad_medida" id="unidad_medida" value="<?php echo $result['unidad_medida']; ?>">
        <br><br>

        <label for="proveedor">Proveedores:</label>
        <input type="text" name="proveedor" id="proveedor" value="<?php echo $result['proveedor']; ?>">
        <br><br>

        <label for="precio">Precio:</label>
        <input type="text" name="precio" id="precio" value="<?php echo $result['precio']; ?>">
        <br><br>

        <label for="fecha_actualizacion">Fecha de actualización:</label>
        <input type="date" name="fecha_actualizacion" id="fecha_actualizacion" value="<?php echo $result['fecha_actualizacion']; ?>">
        <br><br>

        <label for="fecha_caducidad">Fecha de caducidad:</label>
        <input type="date" name="fecha_caducidad" id="fecha_caducidad" value="<?php echo $result['fecha_caducidad']; ?>">
        <br><br>  
              
        <input type="submit" value="Actualizar">
    </form>
    <a href="javascript:history.back()" class="btn-back">← Volver atrás</a>
    </div>

</body>
</html>