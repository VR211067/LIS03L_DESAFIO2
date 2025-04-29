<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos</title>
    <link rel="stylesheet" href="/TextilExport/Views/Productos/css/index.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport">
        <div style="color:white; font-size:20px; font-weight:bold;">Textil Export</div>
    </div>
    <ul class="nav-links">
        <li><a href="/TextilExport/Index/dashboard">Panel Principal</a></li>
      
        <li><a href="/TextilExport/Auth/logout">Cerrar sesión</a></li>
    </ul>
</nav>

<!-- CONTENIDO -->
<div class="container">
    <h1>Productos</h1>
    <a href="/TextilExport/Productos/create">+ Nuevo Producto</a>

    <table>
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Existencias</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($productos as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['codigo']) ?></td>
                    <td><?= htmlspecialchars($p['nombre']) ?></td>
                    <td><?= htmlspecialchars($p['descripcion']) ?></td>
                    <td><img src="/TextilExport/Public/uploads/<?= htmlspecialchars($p['imagen']) ?>" width="50"></td>
                    <td><?= htmlspecialchars($p['categoria']) ?></td>
                    <td>$<?= number_format($p['precio'], 2) ?></td>
                    <td><?= htmlspecialchars($p['existencias']) ?></td>
                    <td>
                    <div class="btn-group">
                        <a href="/TextilExport/Productos/edit/<?= $p['id'] ?>" class="btn-editar">Editar</a>
                    

                        <form action="/TextilExport/Productos/delete" method="POST" style="display:inline;">
    <input type="hidden" name="id" value="<?= $p['id'] ?>">
    <button type="submit" class="btn-eliminar" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
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
