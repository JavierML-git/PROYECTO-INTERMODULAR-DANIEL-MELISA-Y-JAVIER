<?php

include '../conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM gasto_semanal1 WHERE id_gasto = :id_gasto";
$stmt = $newobj->prepare($sql);
$stmt->bindParam(':id_gasto', $id);   

if ($stmt->execute()) {
    header("Location: indexbills.php");
    exit();
} else {
    echo "Error al eliminar el gasto semanal.";
}

header("Location: indexbills.php");
?>