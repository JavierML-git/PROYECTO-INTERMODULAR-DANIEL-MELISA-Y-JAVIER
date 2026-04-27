<?php

include '../conexion.php';

$id = $_GET['id'];

$sql = "DELETE FROM gasto_semanal1 WHERE id_gasto = :id_gasto";
$delData = $newobj->prepare($sql);
$delData->bindParam(':id_gasto', $id);   

if ($delData->execute()) {
    header("Location: indexbills.php");
    exit();
} else {
    echo "Error al eliminar el gasto semanal.";
}

header("Location: indexbills.php");
?>