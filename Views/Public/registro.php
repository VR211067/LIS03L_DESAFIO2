<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="/TextilExport/Views/Public/css/registro.css">
</head>
<body>

<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-links">
        <a href="/TextilExport/">Página Principal</a>
    </div>
</nav>


    <div class="content">
        <h2>Registro de Cliente</h2>

        <?php if (isset($error)): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <label>Nombre:</label>
            <input type="text" name="nombre" required>

            <label>Correo electrónico:</label>
            <input type="email" name="email" required>

            <label>Contraseña:</label>
            <input type="password" name="password" required>

            <button type="submit">Registrarse</button>
        </form>

        <a href="/TextilExport/Public/login">¿Ya tienes cuenta? Inicia sesión</a>
    </div>

</body>
</html>
