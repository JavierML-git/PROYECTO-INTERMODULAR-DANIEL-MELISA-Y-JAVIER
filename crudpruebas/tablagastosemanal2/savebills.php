<?php
include '../conexion.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inicio_semana = $_POST['inicio_semana'];
    $fin_semana = $_POST['fin_semana'];
    $gasto_total = $_POST['costo_total'];
    

    $store = $newobj->prepare("INSERT INTO gasto_semanal1 (id_ingrediente, inicio_semana, fin_semana, costo_total) 
                            VALUES (:id_ingrediente, :inicio_semana, :fin_semana, :costo_total)");
    $store->bindParam(':id_ingrediente', $_POST['id_ingrediente']);
    $store->bindParam(':inicio_semana',  $_POST['inicio_semana']);
    $store->bindParam(':fin_semana',     $_POST['fin_semana']);
    $store->bindParam(':costo_total',    $_POST['costo_total']);
    $store->execute();

    if ($store->rowCount() > 0) {
        echo "Gasto semanal añadido correctamente.";
    } else {
        echo "Error al añadir el gasto semanal.";
    }

    header("Location: indexbills.php");
    
}
?>