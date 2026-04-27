<?php
include '../conexion.php';
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    // Recogemos los datos del formulario
    $nombre = $_POST['nombre'];
    $categoria = $_POST['categoria'];
    $cantidad_actual = $_POST['cantidad_actual'];
    $unidad_medida = $_POST['unidad_medida'];
    $proveedor = $_POST['proveedor'];
    $precio = $_POST['precio'];
    $fecha_actualizacion = $_POST['fecha_actualizacion'];
    $fecha_caducidad = $_POST['fecha_caducidad'];
 
    // Insertamos el nuevo ingrediente
    $insertData = $newobj->prepare(
        'INSERT INTO ingredientes (nombre, categoria, cantidad_actual, unidad_medida, proveedor, precio, fecha_actualizacion, fecha_caducidad) 
         VALUES (:nombre, :categoria, :cantidad_actual, :unidad_medida, :proveedor, :precio, :fecha_actualizacion, :fecha_caducidad)'
    );
 
    $insertData->bindParam(':nombre',              $nombre);
    $insertData->bindParam(':categoria',           $categoria);
    $insertData->bindParam(':cantidad_actual',     $cantidad_actual);
    $insertData->bindParam(':unidad_medida',       $unidad_medida);
    $insertData->bindParam(':proveedor',           $proveedor);
    $insertData->bindParam(':precio',              $precio);
    $insertData->bindParam(':fecha_actualizacion', $fecha_actualizacion);
    $insertData->bindParam(':fecha_caducidad',     $fecha_caducidad);
 
    $insertData->execute();
 
    // Redirigimos al listado de ingredientes
    header('Location: indexfood.php');
    exit;
}
?>