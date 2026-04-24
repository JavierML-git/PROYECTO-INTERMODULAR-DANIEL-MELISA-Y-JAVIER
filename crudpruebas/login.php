<?php
require 'auth.php';

if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Configuración BD
$host   = 'localhost:3308';
$db     = 'restaurante';
$dbuser = 'root';
$dbpass = '';



$error = '';
// 
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //El buicle solo comienza si se han enviado datos de algun metodo POST
    $usuario    = trim($_POST['usuario'] ?? ''); //trim elimina espacios en blanco
    $contrasena = $_POST['contrasena'] ?? '';

    if ($usuario && $contrasena) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $dbuser, $dbpass);

            $sql = $pdo->prepare('SELECT * FROM usuarios WHERE usuario = ?');
            $sql->execute([$usuario]);
            $user = $sql->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($contrasena, $user['contrasena'])) {
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['usuario']    = $user['usuario'];
                $_SESSION['rol']        = $user['rol'];
                header('Location: index.php');
                exit;
            } else {
                $error = 'Usuario o contraseña incorrectos.';
            }
        } catch (PDOException $e) {
            $error = 'Error de conexión con la base de datos.';
        }
    } else {
        $error = 'Por favor, rellena todos los campos.';
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

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
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
            <input type="password" id="contrasena" name="contrasena"
                   autocomplete="current-password" required>
        </div>
        <button type="submit">Entrar →</button>
    </form>

     <p class="footer-link">
        ¿No tienes cuenta? <a href="registro.php">Regístrate</a>
    </p>
</div>
</body>
</html>