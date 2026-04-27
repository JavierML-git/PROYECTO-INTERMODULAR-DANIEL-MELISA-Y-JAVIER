<?php
require 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

/// Configuración de la base de datos
$host = 'localhost:3308';
$database = 'restaurante';
$dbUser = 'root';
$dbPassword = '';

$errorMessage = '';
// 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['usuario'] ?? '');
    $password = $_POST['contrasena'] ?? '';


    // Comprobamos que no vengan vacíos
    if (!$username || !$password) {
        $errorMessage = 'Por favor, rellena todos los campos.';
    } else {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $dbUser, $dbPassword);

            // Buscamos el usuario en la base de datos
            $query = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ?');
            $query->execute([$username]);
            $userRecord = $query->fetch(PDO::FETCH_ASSOC);

            // Si existe y la contraseña es correcta, iniciamos sesión
            if ($userRecord && password_verify($password, $userRecord['contrasena'])) {
                $_SESSION['usuario_id'] = $userRecord['id'];
                $_SESSION['usuario']    = $userRecord['usuario'];
                $_SESSION['rol']        = $userRecord['rol'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }

        } catch (PDOException $e) {
            $error = 'No se ha podido conectar con la base de datos.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="login.css" type="text/css">
</head>
<body>
<div class="card">
    <h1>Iniciar<br>sesión</h1>
    <p class="subtitle">Accede con tus credenciales</p>

    <?php if ($errorMessage): ?>
        <div class="error"><?= htmlspecialchars($errorMessage) ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="field">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" 
                   value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>" 
                   autocomplete="username" required>
        </div>
        <div class="field">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena" autocomplete="current-password" required>
        </div>
        <button type="submit">Entrar →</button>
    </form>
    
</div>
</body>
</html>


