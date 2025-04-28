<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cliente</title>
    <link rel="stylesheet" href="/TextilExport/Views/Clientes/css/edit.css">
 
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="font-weight:bold; font-size:1.5em;">TextilExport</div>
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Clientes">Cancelar</a>
    </div>
</nav>

<!-- FORMULARIO -->
<div class="container">
    <form method="POST">
        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <h1>Editar Cliente</h1>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($cliente['nombre']) ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>" required>

        <label for="activo">Estado:</label>
        <select id="activo" name="activo" required>
            <option value="1" <?= $cliente['activo'] ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= !$cliente['activo'] ? 'selected' : '' ?>>Inhabilitado</option>
        </select>

        <button type="submit">Actualizar</button>

        <a href="/TextilExport/Clientes" class="back-link">Cancelar y volver</a>
    </form>
</div>

</body>
</html>
