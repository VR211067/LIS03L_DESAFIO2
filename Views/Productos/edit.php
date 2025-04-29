<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto</title>
    <link rel="stylesheet" href="/TextilExport/Views/Productos/css/edit.css">
</head>
<body>

<nav>
    <div class="logo">TextilExport</div>
    <div class="nav-links">
        <a href="/TextilExport/Productos">Cancelar</a>
    </div>
</nav>

<h1>Editar Producto</h1>
<?php if (!empty($error)): ?>
    <div class="error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>


<form method="POST" enctype="multipart/form-data">
    <label>Código:</label>
    <input type="text" name="codigo" value="<?= $producto['codigo'] ?>" required>

    <label>Nombre:</label>
    <input type="text" name="nombre" value="<?= $producto['nombre'] ?>" required>

    <label>Descripción:</label>
    <textarea name="descripcion" required><?= $producto['descripcion'] ?></textarea>

    <label>Imagen:</label>
    <img src="/TextilExport/Public/uploads/<?= $producto['imagen'] ?>" width="50">
    <input type="file" name="imagen" accept=".jpg,.png">

    <label>Categoría:</label>
    <select name="categoria_id">
        <?php foreach($categorias as $c): ?>
            <option value="<?= $c['id'] ?>" <?= ($producto['categoria_id'] == $c['id']) ? 'selected' : '' ?>><?= $c['nombre'] ?></option>
        <?php endforeach; ?>
    </select>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= $producto['precio'] ?>">

    <label>Existencias:</label>
    <input type="number" name="existencias" min="0" value="<?= $producto['existencias'] ?>">

    <button type="submit">Actualizar</button>
</form>

</body>
</html>
