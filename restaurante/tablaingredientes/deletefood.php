<?php

include '../conexion.php';

$id = $_GET['id'];


$delData1 = $newobj->prepare("DELETE FROM gasto_semanal1 WHERE id_ingrediente = :id_ingrediente");
$delData1->bindParam(':id_ingrediente', $id);
$delData1->execute();

$delData2 = $newobj->prepare("DELETE FROM ingredientes WHERE id_ingrediente = :id_ingrediente");
$delData2->bindParam(':id_ingrediente', $id);
$delData2->execute();


header("Location: indexfood.php");
exit;
?>