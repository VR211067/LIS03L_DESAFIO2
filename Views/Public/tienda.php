<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Catálogo de Productos</title>
    <link rel="stylesheet" href="/TextilExport/Views/Public/css/tienda.css">
</head>
<body>


<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-right">
    <?php if (isset($_SESSION['cliente'])): ?>
        <div class="bienvenido">Bienvenido, <?= $_SESSION['cliente']['nombre'] ?></div>
        <a href="/TextilExport/Public/logout">Cerrar sesión</a>
    <?php else: ?>
        <a href="/TextilExport/Public/login">Iniciar sesión</a>
        <a href="/TextilExport/Public/registro">Registrarse</a>
    <?php endif; ?>
    <a href="/TextilExport/Carrito/ver">Ver carrito</a>
</div>

</nav>

<h2>Catálogo de Productos</h2>


<div class="filtro-container">
    <h3>Filtrar por Categoría</h3>
    <form method="GET" action="/TextilExport/Public/tienda">
        <select name="categoria" onchange="this.form.submit()">
            <option value="">Todas las categorías</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>" <?= isset($_GET['categoria']) && $_GET['categoria'] == $categoria['id'] ? 'selected' : '' ?>>
                    <?= $categoria['nombre'] ?>
                </option>
            <?php endforeach; ?>
        </select>
    </form>
</div>



<div class="productos-container">
    <?php foreach ($productos as $p): ?>
        <div class="producto-card">
            <img src="/TextilExport/Public/uploads/<?= $p['imagen'] ?>" alt="<?= $p['nombre'] ?>"><br>
            <strong><?= $p['nombre'] ?></strong>
            <p><?= $p['descripcion'] ?></p>
            <p class="precio">$<?= $p['precio'] ?></p>
            <?php if ($p['existencias'] > 0): ?>
                <?php if (isset($_SESSION['cliente'])): ?>
                    <form method="POST" action="/TextilExport/Carrito/add" class="form-cantidad">
                        <input type="hidden" name="producto_id" value="<?= $p['id'] ?>">
                        <input type="number" name="cantidad" value="1" min="1" max="<?= $p['existencias'] ?>">
                        <button type="submit">Agregar al carrito</button>
                    </form>
                <?php else: ?>
                    <p><em>Inicia sesión para comprar</em></p>
                <?php endif; ?>
            <?php else: ?>
                <p style="color: red; font-weight: bold;">Sin stock</p>
            <?php endif; ?>

        </div>
    <?php endforeach; ?>
</div>

</body>
<footer>
    &copy; <?= date('Y') ?> TextilExport. Todos los derechos reservados. | San Salvador, El Salvador
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
