<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_gasto'];
    $inicio_semana = $_POST['inicio_semana'];
    $fin_semana = $_POST['fin_semana'];
    $gasto_total = $_POST['costo_total'];
}
    


    $con1 = $newobj->prepare("UPDATE gasto_semanal1 SET id_ingrediente = :id_ingrediente, inicio_semana = :inicio_semana, fin_semana = :fin_semana, costo_total = :costo_total WHERE id_gasto = :id_gasto");
    $con1->bindParam(':id_ingrediente', $_POST['id_ingrediente']);
    $con1->bindParam(':inicio_semana', $inicio_semana);
    $con1->bindParam(':fin_semana', $fin_semana);
    $con1->bindParam(':costo_total', $gasto_total);
    $con1->bindParam(':id_gasto', $id);

    if ($con1->execute()) {
        header("Location: indexbills.php");
        exit();
    } else {
        echo "Error al actualizar el gasto semanal.";
    }


?>