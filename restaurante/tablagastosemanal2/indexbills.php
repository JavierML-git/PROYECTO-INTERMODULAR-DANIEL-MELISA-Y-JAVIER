<?php
require '../auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gastos Semanales</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="indexbills.css" type="text/css">
    
</head>
<body class="text-center">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/restaurante/navbar.php'; ?>

    <h1>Tabla Gastos Semanales</h1>

    <div class="info-bar">
        Hola, <strong><?=htmlspecialchars($_SESSION['usuario']) ?></strong>
        (<?= $_SESSION['rol'] ?>)
        — <a href="../logout.php">Cerrar sesión</a>
    </div>

    <?php if (isAdmin()): ?>
        <a href="newbills.php" class="btn-añadir">Añadir gasto semanal</a>
    <?php endif; ?>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Inicio Semana</th>
                    <th>Fin Semana</th>
                    <th>Ingrediente</th>
                    <th>Cantidad</th>
                    <th>Cantidad Costo Semanal</th>
                    <th>Unidad Medida</th>
                    <th>Precio</th>
                    <th>Costo Total</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../conexion.php';
                $sql = "
                    SELECT
                        gastoing.id_gasto,
                        gastoing.inicio_semana,
                        gastoing.fin_semana,
                        gastoing.costo_total,
                        gastoing.cantidad_costosemanal,
                        ing.id_ingrediente,
                        ing.nombre,
                        ing.cantidad_actual,
                        ing.unidad_medida,
                        ing.precio
                    FROM gasto_semanal1 gastoing
                    INNER JOIN ingredientes ing ON gastoing.id_ingrediente = ing.id_ingrediente
                ";
                $query = $newobj->prepare($sql);
                $query->execute();
                $resultado = $query->fetchAll();

                foreach ($resultado as $row) {
                    echo "<tr>
                            <td>".$row['inicio_semana']."</td>
                            <td>".$row['fin_semana']."</td>
                            <td>".$row['nombre']."</td>
                            <td>".$row['cantidad_actual']."</td>
                            <td>".$row['cantidad_costosemanal']."</td>
                            <td>".$row['unidad_medida']."</td>
                            <td>".$row['precio']." €</td>
                            <td>".$row['costo_total']." €</td>
                            <td>";
                    if (isAdmin()) {
                        echo "<a href='editbills.php?id=".$row['id_gasto']."' class='btn-edit'>Editar</a>
                              <a href='deletebills.php?id=".$row['id_gasto']."' class='btn-delete'>Eliminar</a>";
                    }
                    echo "</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>
</html>