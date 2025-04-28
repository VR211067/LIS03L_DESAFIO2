<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="/TextilExport/Views/Usuarios/css/index.css">
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
    <h2>Gestión de Usuarios</h2>
    <a href="/TextilExport/Usuarios/create">+ Nuevo Usuario</a>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
                <tr>
                    <td><?= $u['nombre'] ?></td>
                    <td><?= $u['usuario'] ?></td>
                    <td><?= $u['rol'] ?></td>
                  
                    <td>
                        <div class="btn-group">
                            <a href="/TextilExport/Usuarios/edit/<?= $p['id'] ?>" class="btn-editar">Editar</a>
                            <a href="/TextilExport/Usuarios/delete/<?= $p['id'] ?>" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar a este Usuario?')">Eliminar</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>
