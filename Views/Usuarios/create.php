<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
    <link rel="stylesheet" href="/TextilExport/Views/Usuarios/css/create.css">
</head>
<body>

<nav>
    <div class="logo">
        <img src="/TextilExport/public/img/logo2.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Usuarios">Cancelar</a>
    </div>
</nav>

<div class="container">
    <form method="POST">
        <h1>Nuevo Usuario</h1>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <label>Nombre:</label>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($data['nombre'] ?? '') ?>">

        <label>Usuario:</label>
        <input type="text" name="usuario" required value="<?= htmlspecialchars($data['usuario'] ?? '') ?>">

        <label>Contraseña:</label>
        <input type="password" name="password" required>

        <label>Rol:</label>
        <select name="rol">
            <option value="admin" <?= (isset($data['rol']) && $data['rol'] == 'admin') ? 'selected' : '' ?>>Administrador</option>
            <option value="empleado" <?= (isset($data['rol']) && $data['rol'] == 'empleado') ? 'selected' : '' ?>>Empleado</option>
        </select>

        <button type="submit">Guardar</button>
    </form>
</div>

</body>
</html>
