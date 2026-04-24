<?php
require 'auth.php';

// Si ya está logueado, no necesita registrarse
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// ── Configuración BD ──────────────────────────────────────
$host   = 'localhost:3308';
$db     = 'restaurante';
$dbuser = 'root';
$dbpass = '';
// ─────────────────────────────────────────────────────────

$error   = '';
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_usuario = trim($_POST['usuario'] ?? '');
    $contrasena    = $_POST['contrasena'] ?? '';
    $rol           = $_POST['rol'] ?? '';

    if ($nuevo_usuario && $contrasena && in_array($rol, ['admin', 'invitado'])) {
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $dbuser, $dbpass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $check = $pdo->prepare('SELECT id FROM usuarios WHERE usuario = ?');
            $check->execute([$nuevo_usuario]);

            if ($check->fetch()) {
                $error = 'Ese nombre de usuario ya está en uso.';
            } else {
                $hash = password_hash($contrasena, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare('INSERT INTO usuarios (usuario, contrasena, rol) VALUES (?, ?, ?)');
                $stmt->execute([$nuevo_usuario, $hash, $rol]);
                $mensaje = 'Cuenta creada. Ya puedes iniciar sesión.';
            }
        } catch (PDOException $e) {
            $error = 'Error de conexión con la base de datos.';
        }
    } else {
        $error = 'Rellena todos los campos y elige un rol válido.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;800&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
    
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
        --bg:      #0b1526;      
        --surface: #142033;      
        --border:  #1f3554;     
        --accent:  #4db8ff;      
        --text:    #e8f4ff;     
        --muted:   #8ba3c7;      
    }

    body {
        min-height: 100vh;
        background: var(--bg);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'DM Sans', sans-serif;
        color: var(--text);
    }


    .card {
        position: relative;
        background: var(--surface);
        border: 1px solid var(--border);
        width: 100%;
        max-width: 420px;
        padding: 48px 40px;
        animation: fadeUp .4s ease both;
        border-radius: 6px;
    }

    

    h1 {
        font-family: 'Syne', sans-serif;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .subtitle {
        font-size: 14px;
        color: var(--muted);
        margin-bottom: 36px;
    }

    .field { margin-bottom: 20px; }

    label {
        display: block;
        font-size: 11px;
        font-weight: 500;
        letter-spacing: .12em;
        text-transform: uppercase;
        color: var(--muted);
        margin-bottom: 8px;
    }

    input, select {
        width: 100%;
        background: #0a1b30;
        border: 1px solid var(--border);
        color: var(--text);
        padding: 12px 14px;
        font-size: 15px;
        outline: none;
        transition: border-color .2s, background .2s;
        appearance: none;
    }

    input:focus, select:focus {
        border-color: var(--accent);
        background: #0d223d;
    }



    .roles {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
    }

    .role-option input[type="radio"] { display: none; }

    .role-option label {
        display: flex;
        flex-direction: column;
        gap: 4px;
        border: 1px solid var(--border);
        padding: 14px;
        cursor: pointer;
        transition: border-color .2s, background .2s;
        color: var(--text);
        border-radius: 4px;
    }

    .role-option label span {
        font-size: 11px;
        color: var(--muted);
    }

    .role-option input[type="radio"]:checked + label {
        border-color: var(--accent);
        background: rgba(77, 184, 255, .08);
    }

    .error {
        background: rgba(255, 80, 80, .08);
        border: 1px solid rgba(255, 80, 80, .3);
        color: #ff6b6b;
        font-size: 13px;
        padding: 10px 14px;
        margin-bottom: 20px;
    }

    .success {
        background: rgba(71, 255, 136, .08);
        border: 1px solid rgba(71, 255, 136, .3);
        color: #47ff88;
        font-size: 13px;
        padding: 10px 14px;
        margin-bottom: 20px;
    }

    button[type="submit"] {
        width: 100%;
        background: var(--accent);
        color: #00131f;
        border: none;
        padding: 14px;
        font-family: 'Syne', sans-serif;
        font-size: 13px;
        font-weight: 800;
        letter-spacing: .1em;
        text-transform: uppercase;
        cursor: pointer;
        margin-top: 8px;
        transition: opacity .2s, transform .15s;
        border-radius: 4px;
    }

    button[type="submit"]:hover {
        opacity: .9;
        transform: translateY(-1px);
    }

    .footer-link {
        text-align: center;
        margin-top: 24px;
        font-size: 13px;
        color: var(--muted);
    }

    .footer-link a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
    }

    .footer-link a:hover { text-decoration: underline; }
</style>
    </style>
</head>
<body>
<div class="card">
    <h1>Crear cuenta</h1>
    <p class="subtitle">Elige tus datos de acceso y tu rol</p>

    <?php if ($error): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <?php if ($mensaje): ?>
        <div class="success">
            <?= htmlspecialchars($mensaje) ?>
            — <a href="login.php" style="color:inherit;font-weight:600">Ir al login</a>
        </div>
    <?php endif; ?>

    <form method="POST">
        <div class="field">
            <label for="usuario">Nombre de usuario</label>
            <input type="text" id="usuario" name="usuario"
                   value="<?= htmlspecialchars($_POST['usuario'] ?? '') ?>"
                   autocomplete="username" required>
        </div>

        <div class="field">
            <label for="contrasena">Contraseña</label>
            <input type="password" id="contrasena" name="contrasena"
                   autocomplete="new-password" required>
        </div>

        <div class="field">
            <label>Rol</label>
            <div class="roles">
                <div class="role-option">
                    <input type="radio" id="rol-admin" name="rol" value="admin"
                        <?= (($_POST['rol'] ?? '') === 'admin') ? 'checked' : '' ?>>
                    <label for="rol-admin">
                        Admin
                        <span>Puede crear, editar y eliminar</span>
                    </label>
                </div>
                <div class="role-option">
                    <input type="radio" id="rol-invitado" name="rol" value="invitado"
                        <?= (($_POST['rol'] ?? '') !== 'admin') ? 'checked' : '' ?>>
                    <label for="rol-invitado">
                        Invitado
                        <span>Solo puede consultar</span>
                    </label>
                </div>
            </div>
        </div>

        <button type="submit">Crear cuenta →</button>
    </form>

    <p class="footer-link">
        ¿Ya tienes cuenta? <a href="login.php">Inicia sesión</a>
    </p>
</div>
</body>
</html>