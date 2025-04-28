<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="/TextilExport/Views/Auth/css/login.css">
</head>
<body>


<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-links">
        <a href="/TextilExport/Public/login">Cliente</a>
        <a href="/TextilExport/">Página Principal</a>
    </div>
</nav>

<form method="POST">
    <h2>Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
    <div class="alerta"><?= $error ?></div>
    <?php endif; ?>

    <label for="usuario">Usuario:</label>
    <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuario ?? '') ?>" required>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Ingresar</button>
</form>

</body>
</html>
