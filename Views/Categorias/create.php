<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Categoría</title>
    <link rel="stylesheet" href="/TextilExport/Views/Categorias/css/create.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="font-weight:bold; font-size:1.5em;">TextilExport</div>
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Categorias">Volver</a>
    </div>
</nav>

<!-- FORMULARIO -->
<div class="container">
    <form method="POST">
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <h1>Nueva Categoría</h1>

        <label for="nombre">Nombre de la Categoría:</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre" required>

        <button type="submit">Guardar</button>

        
    </form>
</div>

</body>
</html>
