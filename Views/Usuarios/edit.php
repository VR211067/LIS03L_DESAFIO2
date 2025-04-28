<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="/TextilExport/Views/Usuarios/css/edit.css">
</head>
<body>

<nav>
    <div class="logo">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport">
        <span>TextilExport</span>
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Usuarios">Cancelar</a>
    </div>
</nav>

<div class="container">
    <form method="POST">
        <h1>Editar Usuario</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <label>Nombre:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

        <label>Usuario:</label>
        <input type="text" name="usuario" value="<?= htmlspecialchars($usuario['usuario']) ?>" required>

        <label>Contraseña (dejar en blanco para no cambiarla):</label>
        <input type="password" name="password">

        <label>Rol:</label>
        <select name="rol">
            <option value="admin" <?= $usuario['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="empleado" <?= $usuario['rol'] == 'empleado' ? 'selected' : '' ?>>Empleado</option>
        </select>

        <button type="submit">Actualizar</button>
    </form>
</div>

</body>
</html>
