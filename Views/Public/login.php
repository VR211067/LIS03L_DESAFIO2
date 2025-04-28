<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión - Cliente</title>
    <link rel="stylesheet" href="/TextilExport/Views/Public/css/login.css">
</head>
<body>


<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Auth/login">Empleado</a>
        <a href="/TextilExport/">Página Principal</a>
    </div>
</nav>

<h2>Inicio de Sesión</h2>

<?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST">
    <label>Correo electrónico:</label>
    <input type="email" name="email" required value="<?= htmlspecialchars($email ?? '') ?>">

    <label>Contraseña:</label>
    <input type="password" name="password" required>

    <button type="submit">Iniciar sesión</button>
</form>

<a href="/TextilExport/Public/registro">¿No tienes cuenta? Regístrate</a>

</body>
</html>
