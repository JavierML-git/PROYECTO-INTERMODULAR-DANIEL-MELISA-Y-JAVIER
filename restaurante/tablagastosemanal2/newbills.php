<?php
include '../conexion.php';
$ingredientes = $newobj->query("SELECT id_ingrediente, nombre, precio, unidad_medida, cantidad_actual FROM ingredientes ORDER BY nombre")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir gastos semanales</title>
    <link rel="stylesheet" href="newbills.css" type="text/css">
    
</head>
<body>

    <div class="card">
        <h1>Añadir gastos semanales</h1>
        <form action="savebills.php" method="post">

            <label for="inicio_semana">Inicio de la semana:</label>
            <input type="date" name="inicio_semana" id="inicio_semana">

            <label for="fin_semana">Fin de la semana:</label>
            <input type="date" name="fin_semana" id="fin_semana">

            <label for="id_ingrediente">Selecciona un ingrediente:</label>
            <select name="id_ingrediente" id="id_ingrediente" onchange="calcularCosto()">
                <option value="">Selecciona un ingrediente</option>
                <?php foreach ($ingredientes as $ing): ?>
                    <option value="<?= $ing['id_ingrediente'] ?>" precioIngrediente="<?= $ing['precio'] ?>" unidadIngrediente="<?= htmlspecialchars($ing['unidad_medida']) ?>">
                        <?= htmlspecialchars($ing['nombre']) ?>
                        (<?= number_format($ing['precio'], 2) ?> €/<?= $ing['unidad_medida'] ?> - Cant: <?= $ing['cantidad_actual'] ?>)
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Cantidad usada *</label>
            <input type="number" name="cantidad_costosemanal" id="cantidad_costosemanal"
               step="0.001" min="0.001" required placeholder="0.000"
               oninput="calcularCosto()">
            
    

            <label for="costo_total">Gasto Total</label>
            <input type="text" name="costo_total" id="costo_total" placeholder="0.000" required
               oninput="calcularCosto()">
            

            <input type="submit" value="Guardar">
        </form>

        <a href="javascript:history.back()" class="btn-back">← Volver atrás</a>
    </div>

    <script>
    function calcularCosto() {
        const select = document.getElementById('id_ingrediente');
        const precio = parseFloat(select.options[select.selectedIndex].getAttribute('precioIngrediente')) || 0;
        const cantidad = parseFloat(document.getElementById('cantidad_costosemanal').value) || 0;

        // Multiplicamos precio por cantidad y lo mostramos con 2 decimales
        const total = precio * cantidad;
        document.getElementById('costo_total').value = total.toFixed(2);
    }
    </script>

</body>
</html>

