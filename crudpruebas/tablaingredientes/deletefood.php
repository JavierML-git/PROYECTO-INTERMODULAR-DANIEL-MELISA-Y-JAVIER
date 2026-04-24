<?php

include '../conexion.php';

$id = $_GET['id'];


$del1 = $newobj->prepare("DELETE FROM gasto_semanal1 WHERE id_ingrediente = :id_ingrediente");
$del1->bindParam(':id_ingrediente', $id);
$del1->execute();

$del2 = $newobj->prepare("DELETE FROM ingredientes WHERE id_ingrediente = :id_ingrediente");
$del2->bindParam(':id_ingrediente', $id);
$del2->execute();


header("Location: indexfood.php");
exit;
?>