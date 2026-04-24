<?php
include '../conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $cantidad_actual = $_POST['cantidad_actual'];
    $unidad_medida = $_POST['unidad_medida'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $fecha_actualizacion = $_POST['fecha_actualizacion'];
    $fecha_caducidad = $_POST['fecha_caducidad'];
    

    $store = $newobj->prepare("INSERT INTO ingredientes (nombre, categoria, cantidad_actual, unidad_medida, proveedor, precio, fecha_actualizacion, fecha_caducidad) 
                                VALUES (:nombre, :categoria, :cantidad_actual, :unidad_medida, :proveedor, :precio, :fecha_actualizacion, :fecha_caducidad)");
    $store->bindParam(':nombre', $nombre);
    $store->bindParam(':categoria', $categoria);
    $store->bindParam(':cantidad_actual', $cantidad_actual);
    $store->bindParam(':unidad_medida', $unidad_medida);
    $store->bindParam(':proveedor', $proveedor);
    $store->bindParam(':precio', $precio);
    $store->bindParam(':fecha_actualizacion', $fecha_actualizacion);
    $store->bindParam(':fecha_caducidad', $fecha_caducidad);
    $store->execute();

    if ($store->rowCount() > 0) {
        echo "Ingrediente añadido correctamente.";
    } else {
        echo "Error al añadir el ingrediente.";
    }

    header("Location: indexfood.php");
    
}
?>