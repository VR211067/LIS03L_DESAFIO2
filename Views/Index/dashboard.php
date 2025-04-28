<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="/TextilExport/Views/Index/css/dashboard.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="color:white; font-size:20px; font-weight:bold;">Textil Export</div>
    </div>
    <ul class="nav-links">

        <li><a href="/TextilExport/Auth/logout">Cerrar sesión</a></li>
    </ul>
</nav>

<!-- CONTENIDO -->
<div class="container">
    <h1>Panel de Administración</h1>
    <p class="bienvenido-panel">Bienvenido, <?= htmlspecialchars($nombre) ?> (<?= htmlspecialchars($rol) ?>)</p>


    <div class="button-group">
        <a href="/TextilExport/Productos">Productos</a>
        <?php if ($rol === 'admin'): ?>
            <a href="/TextilExport/Categorias">Categorías</a>
            <a href="/TextilExport/Usuarios">Usuarios</a>
            <a href="/TextilExport/Clientes">Clientes</a>
        <?php endif; ?>
        <a href="/TextilExport/Ventas">Ventas</a>
    </div>

    <div class="stats">
        <div class="card">
            <h3>Total de Ventas</h3>
            <p>$<?= number_format($totalVentas, 2) ?></p>
        </div>
        <div class="card">
            <h3>Productos</h3>
            <p><?= (int)$totalProductos ?></p>
        </div>
        <?php if ($rol === 'admin'): ?>
            <div class="card">
                <h3>Clientes</h3>
                <p><?= (int)$totalClientes ?></p>
            </div>
            <div class="card">
                <h3>Usuarios</h3>
                <p><?= (int)$totalUsuarios ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
