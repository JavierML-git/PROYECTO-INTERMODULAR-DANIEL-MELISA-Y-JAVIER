<?php
include '../conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//Recogemos los datos del formulario

    $id = $_POST['id_gasto'];
    $inicio_semana = $_POST['inicio_semana'];
    $fin_semana = $_POST['fin_semana'];
    $gasto_total = $_POST['costo_total'];
    $cantidad_costosemanal = $_POST['cantidad_costosemanal'];
}
    

    // Actualizamos los gatos semanales
    $updateData = $newobj->prepare("UPDATE gasto_semanal1 SET id_ingrediente = :id_ingrediente, inicio_semana = :inicio_semana, fin_semana = :fin_semana, costo_total = :costo_total, cantidad_costosemanal = :cantidad_costosemanal
                 WHERE id_gasto = :id_gasto");


    $updateData->bindParam(':id_ingrediente', $_POST['id_ingrediente']);
    $updateData->bindParam(':inicio_semana', $inicio_semana);
    $updateData->bindParam(':fin_semana', $fin_semana);
    $updateData->bindParam(':costo_total', $gasto_total);
    $updateData->bindParam(':id_gasto', $id);
    $updateData->bindParam(':cantidad_costosemanal', $cantidad_costosemanal);

    $updateData->execute();

    header("Location: indexbills.php");
    exit;


?>

