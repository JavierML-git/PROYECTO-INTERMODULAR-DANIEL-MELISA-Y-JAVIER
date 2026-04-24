<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_ingrediente'];
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $cantidad_actual = $_POST['cantidad_actual'];
    $unidad_medida = $_POST['unidad_medida'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $fecha_actualizacion = $_POST['fecha_actualizacion'];
    $fecha_caducidad = $_POST['fecha_caducidad'];

    $con1 = $newobj->prepare("UPDATE ingredientes SET nombre = :nombre, categoria = :categoria, cantidad_actual = :cantidad_actual, unidad_medida = :unidad_medida, proveedor = :proveedor, precio = :precio, fecha_actualizacion = :fecha_actualizacion, fecha_caducidad = :fecha_caducidad WHERE id_ingrediente = :id_ingrediente");
    $con1->bindParam(':nombre', $nombre);
    $con1->bindParam(':categoria', $categoria);
    $con1->bindParam(':cantidad_actual', $cantidad_actual);
    $con1->bindParam(':unidad_medida', $unidad_medida);
    $con1->bindParam(':proveedor', $proveedor);
    $con1->bindParam(':precio', $precio);
    $con1->bindParam(':fecha_actualizacion', $fecha_actualizacion);
    $con1->bindParam(':fecha_caducidad', $fecha_caducidad);
    $con1->bindParam(':id_ingrediente', $id);
    
    if ($con1->execute()) {
        header("Location: indexfood.php");
        exit();
    } else {
        echo "Error al actualizar el ingrediente.";
    }
}

?>