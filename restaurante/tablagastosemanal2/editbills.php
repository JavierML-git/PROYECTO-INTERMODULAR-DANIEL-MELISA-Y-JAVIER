<?php

include '../conexion.php';

$id = $_GET['id'];
$editData = $newobj->prepare("SELECT * FROM gasto_semanal1 WHERE id_gasto = :id_gasto");
$editData->bindParam(':id_gasto', $id);
$editData->execute();
$result = $editData->fetch(PDO::FETCH_ASSOC);

$ingredientes = $newobj->query("SELECT id_ingrediente, nombre, precio, unidad_medida, cantidad_actual FROM ingredientes ORDER BY nombre")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Gasto Semanal</title>
    <link rel="stylesheet" href="editbills.css" type="text/css">
</head>
<body>

    <div class="card">
        <h1>Editar Gasto Semanal</h1>
        <form action="updatebills.php" method="POST">
            <input type="hidden" name="id_gasto" value="<?php echo $result['id_gasto']; ?>">

            <label for="inicio_semana">Inicio de la semana:</label>
            <input type="date" name="inicio_semana" id="inicio_semana" value="<?= $result['inicio_semana'] ?>">

            <label for="fin_semana">Fin de la semana:</label>
            <input type="date" name="fin_semana" id="fin_semana" value="<?= $result['fin_semana'] ?>">

            <label for="id_ingrediente">Ingrediente:</label>
            <select name="id_ingrediente" id="id_ingrediente">
                <option value="">Selecciona un ingrediente</option>
                <?php foreach ($ingredientes as $ing): ?>
                    <option value="<?= $ing['id_ingrediente'] ?>" <?= $ing['id_ingrediente'] == $result['id_ingrediente'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($ing['nombre']) ?>
                        (<?= number_format($ing['precio'], 2) ?> €/<?= $ing['unidad_medida'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="cantidad_costosemanal">Cantidad Gasto Semanal:</label>
            <input type="text" name="cantidad_costosemanal" id="cantidad_costosemanal" value="<?= $result['cantidad_costosemanal'] ?>">

            <label for="costo_total">Gasto Total:</label>
            <input type="text" name="costo_total" id="costo_total" value="<?php echo $result['costo_total']; ?>">

            <input type="submit" value="Actualizar">

        </form>

        <a href="javascript:history.back()" class="btn-back">← Volver atrás</a>
    </div>

</body>
</html>