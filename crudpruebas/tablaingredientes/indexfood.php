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

    <?php include $_SERVER['DOCUMENT_ROOT'] . '/asirphp/crudpruebas/navbar.php'; ?>
    
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
                $con1 = $newobj->prepare("SELECT * FROM ingredientes");
                $con1->execute();
                $res = $con1->fetchAll();

                foreach ($res as $row) {
                    echo "<tr>
                            <td>".$row['nombre']."</td>
                            <td>".$row['categoria']."</td>
                            <td>".$row['cantidad_actual']."</td>              
                            <td>".$row['unidad_medida']."</td>
                            <td>".$row['proveedor']."</td>
                            <td>".$row['precio']." €</td>
                            <td>".$row['fecha_actualizacion']."</td>
                            <td>".$row['fecha_caducidad']."</td>
                            <td>";
                    if (isAdmin()) {
                        echo "<a href='editfood.php?id=".$row['id_ingrediente']."' class='btn-edit'>Editar</a>
                              <a href='deletefood.php?id=".$row['id_ingrediente']."' class='btn-delete'>Eliminar</a>";
                    }
                    echo "</td>
                          </tr>";
                }
                ?>

                create table ingredientes (
                    id_ingrediente int primary key auto_increment,
                    nombre varchar(255) not null,
                    categoria varchar(255) not null,
                    cantidad_actual int not null,
                    unidad_medida varchar(50) not null,
                    proveedor varchar(255) not null,
                    precio decimal(10,2) not null,
                    fecha_actualizacion date not null,
                    fecha_caducidad date not null
                );


                create table usuarios (
                    id int primary key auto_increment,
                    usuario varchar(255) not null unique,
                    contrasena varchar(255) not null,
                    rol enum('admin', 'invitado') not null
                );
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>