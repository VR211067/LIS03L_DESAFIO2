<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Categoría</title>
    <link rel="stylesheet" href="/TextilExport/Views/Categorias/css/edit.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="font-weight:bold; font-size:1.5em;">TextilExport</div>
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Categorias">Cancelar</a>
    </div>
</nav>

<!-- FORMULARIO -->
<div class="container">
    <form method="POST">
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <h1>Editar Categoría</h1>

        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($categoria['nombre']) ?>" required>

        <button type="submit">Actualizar</button>

       
    </form>
</div>

</body>
</html>
