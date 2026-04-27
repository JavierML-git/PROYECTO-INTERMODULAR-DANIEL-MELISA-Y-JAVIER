<?php
require '../auth.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingredientes</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="indexfood.css" type="text/css">
</head>
<body class="text-center">

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/restaurante/navbar.php'; ?>
    
    <h1>Tabla Ingredientes</h1>

    <div class="info-bar">
        Hola, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
        (<?= $_SESSION['rol'] ?>)
        — <a href="../logout.php">Cerrar sesión</a>
    </div>

    <?php if (isAdmin()): ?>
        <a href="newfood.php" class="btn-añadir">Añadir ingrediente</a>
    <?php endif; ?>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Cant. actual</th>
                    <th>Unidad</th>
                    <th>Proveedor</th>
                    <th>Precio</th>
                    <th>F. actualización</th>
                    <th>F. caducidad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../conexion.php';
                $query = $newobj->prepare("SELECT * FROM ingredientes");
                $query->execute();
                $resultado = $query->fetchAll();

                foreach ($resultado as $res) {
                    echo "<tr>
                            <td>".$res['nombre']."</td>
                            <td>".$res['categoria']."</td>
                            <td>".$res['cantidad_actual']."</td>              
                            <td>".$res['unidad_medida']."</td>
                            <td>".$res['proveedor']."</td>
                            <td>".$res['precio']." €</td>
                            <td>".$res['fecha_actualizacion']."</td>
                            <td>".$res['fecha_caducidad']."</td>
                            <td>";
                    if (isAdmin()) {
                        echo "<a href='editfood.php?id=".$res['id_ingrediente']."' class='btn-edit'>Editar</a>
                              <a href='deletefood.php?id=".$res['id_ingrediente']."' class='btn-delete'>Eliminar</a>";
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