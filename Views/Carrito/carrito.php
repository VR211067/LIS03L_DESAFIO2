<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mi Carrito</title>
    <link rel="stylesheet" href="/TextilExport/Views/Carrito/css/carrito.css">

</head>
<body>

<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    <div class="nav-right">
        <a href="/TextilExport/Public/tienda">Seguir comprando</a>

    </div>
</nav>


<h2>Mi Carrito</h2>

<?php if (empty($carrito)): ?>
    <p>Tu carrito está vacío</p>
<?php else: ?>
    <table>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Subtotal</th>
            <th></th>
        </tr>
        <?php $total = 0; ?>
        <?php foreach ($carrito as $item): ?>
            <?php $subtotal = $item['precio'] * $item['cantidad']; ?>
            <tr>
                <td><?= $item['nombre'] ?></td>
                <td><?= $item['cantidad'] ?></td>
                <td>$<?= $subtotal ?></td>
                <td><a href="/TextilExport/Carrito/remove/<?= $item['id'] ?>">Eliminar</a></td>
            </tr>
            <?php $total += $subtotal; ?>
        <?php endforeach; ?>
        <tr>
            <td colspan="2"><strong>Total</strong></td>
            <td><strong>$<?= $total ?></strong></td>
            <td></td>
        </tr>
    </table>
    <form action="/TextilExport/Carrito/comprar" method="POST">
        <button type="submit">Finalizar Compra</button>
    </form>
<?php endif; ?>

</body>
</html>
