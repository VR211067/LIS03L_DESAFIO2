<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto</title>
    <link rel="stylesheet" href="/TextilExport/Views/Productos/css/create.css">
</head>
<body>


<nav>
    <div class="logo">TextilExport</div>
    <div class="nav-links">
        <a href="/TextilExport/Productos">Cancelar</a>
    </div>
</nav>


<h1>Nuevo Producto</h1>

<form method="POST" enctype="multipart/form-data">
    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <label>Código:</label>
    <input type="text" name="codigo" required placeholder="Ej: PROD0001" value="<?= htmlspecialchars($data['codigo'] ?? '') ?>">

    <label>Nombre:</label>
    <input type="text" name="nombre" required value="<?= htmlspecialchars($data['nombre'] ?? '') ?>">

    <label>Descripción:</label>
    <textarea name="descripcion" required><?= htmlspecialchars($data['descripcion'] ?? '') ?></textarea>

    <label>Imagen:</label>
    <input type="file" name="imagen" accept=".jpg,.png" required>

    <label>Categoría:</label>
    <select name="categoria_id">
        <?php foreach($categorias as $c): ?>
            <option value="<?= $c['id'] ?>" <?= (isset($data['categoria_id']) && $data['categoria_id'] == $c['id']) ? 'selected' : '' ?>>
                <?= $c['nombre'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label>Precio:</label>
    <input type="number" name="precio" step="0.01" value="<?= htmlspecialchars($data['precio'] ?? '') ?>">

    <label>Existencias:</label>
    <input type="number" name="existencias" min="0" value="<?= htmlspecialchars($data['existencias'] ?? '') ?>">

    <button type="submit">Guardar</button>
</form>

</body>
</html>
