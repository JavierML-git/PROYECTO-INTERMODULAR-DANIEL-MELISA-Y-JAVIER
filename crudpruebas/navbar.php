<style>
    nav {
        background-color: #808080;
        padding: 12px;
        text-align: center;
    }

    nav a {
        color: white;
        text-decoration: none;
        margin: 0 15px;
    }

    nav a:hover {
        text-decoration: underline;
    }

    nav span {
        color: white;
        margin-left: 20px;
    }
</style>

<nav>
    <a href="/asirphp/crudpruebas/index.php">Inicio</a>
    <a href="/asirphp/crudpruebas/tablaingredientes/indexfood.php">Ingredientes</a>
    <a href="/asirphp/crudpruebas/tablagastosemanal2/indexbills.php">Gastos Semanales</a>

    <?php if (isset($_SESSION['usuario'])): ?>
        <span>
            Hola, <strong><?= htmlspecialchars($_SESSION['usuario']) ?></strong>
            (<?= $_SESSION['rol'] ?>)
            — <a href="/asirphp/crudpruebas/logout.php">Cerrar sesión</a>
        </span>
    <?php endif; ?>
</nav>

