<?php
include '../conexion.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    //Recogemos los datos del formulario
    $inicio_semana = $_POST['inicio_semana'];
    $fin_semana = $_POST['fin_semana'];
    $gasto_total = $_POST['costo_total'];
    $cantidad_costosemanal = $_POST['cantidad_costosemanal'];
    

    $insertData = $newobj->prepare("INSERT INTO gasto_semanal1 (id_ingrediente, inicio_semana, fin_semana, costo_total, cantidad_costosemanal) 
                            VALUES (:id_ingrediente, :inicio_semana, :fin_semana, :costo_total, :cantidad_costosemanal)");
    $insertData->bindParam(':id_ingrediente', $_POST['id_ingrediente']);
    $insertData->bindParam(':inicio_semana',  $_POST['inicio_semana']);
    $insertData->bindParam(':fin_semana',     $_POST['fin_semana']);
    $insertData->bindParam(':costo_total',    $_POST['costo_total']);
    $insertData->bindParam(':cantidad_costosemanal', $cantidad_costosemanal);


    $insertData->execute();

    //Redirigimos al listado de gastos semanales
    header("Location: indexbills.php");
    exit;
}
?>