<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link rel="stylesheet" href="/TextilExport/Views/Categorias/css/index.css">
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
    <h1>Categorías</h1>
    <a href="/TextilExport/Categorias/create">+ Nueva Categoría</a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($categorias as $cat): ?>
                <tr>
                    <td><?= $cat['id'] ?></td>
                    <td><?= $cat['nombre'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="/TextilExport/Categorias/edit/<?= $cat['id'] ?>" class="btn-editar">Editar</a>
                            <form action="/TextilExport/Categorias/delete" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $cat['id'] ?>">
                                <button type="submit" class="btn-eliminar" onclick="return confirm('¿Seguro?')">Eliminar</button>
                            </form>

                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>