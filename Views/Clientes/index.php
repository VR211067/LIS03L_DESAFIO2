<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes Registrados</title>
    <link rel="stylesheet" href="/TextilExport/Views/Clientes/css/index.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="color:white; font-size:20px; font-weight:bold;">Textil Export</div>
    </div>
    <ul class="nav-links">
        <li><a href="/TextilExport/Index/dashboard">Panel Principal</a></li>
        <li><a href="/TextilExport/Auth/logout">Cerrar sesión</a></li>
    </ul>
</nav>

<!-- CONTENIDO -->
<div class="container">
    <h2>Clientes Registrados</h2>
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= $c['activo'] ? 'Activo' : 'Inhabilitado' ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="/TextilExport/Clientes/edit/<?= $c['id'] ?>" class="btn-editar">Editar</a>
                            <a href="/TextilExport/Clientes/delete/<?= $c['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">Eliminar</a>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
