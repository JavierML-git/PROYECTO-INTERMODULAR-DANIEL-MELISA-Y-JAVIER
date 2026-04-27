<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//Recogemos los datos del formulario
    $id = $_POST['id_ingrediente'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $cantidad_actual = $_POST['cantidad_actual'];
    $unidad_medida = $_POST['unidad_medida'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $fecha_actualizacion = $_POST['fecha_actualizacion'];
    $fecha_caducidad = $_POST['fecha_caducidad'];


    // Actualizamos el ingrediente
    $updateData = $newobj->prepare("UPDATE ingredientes SET nombre = :nombre, categoria = :categoria, cantidad_actual = :cantidad_actual, unidad_medida = :unidad_medida,
             proveedor = :proveedor, precio = :precio, fecha_actualizacion = :fecha_actualizacion, fecha_caducidad = :fecha_caducidad WHERE id_ingrediente = :id_ingrediente");


    $updateData->bindParam(':nombre', $nombre);
    $updateData->bindParam(':categoria', $categoria);
    $updateData->bindParam(':cantidad_actual', $cantidad_actual);
    $updateData->bindParam(':unidad_medida', $unidad_medida);
    $updateData->bindParam(':proveedor', $proveedor);
    $updateData->bindParam(':precio', $precio);
    $updateData->bindParam(':fecha_actualizacion', $fecha_actualizacion);
    $updateData->bindParam(':fecha_caducidad', $fecha_caducidad);
    $updateData->bindParam(':id_ingrediente', $id);

    $updateData->execute();

    header("Location: indexfood.php");
    exit;
}

?>