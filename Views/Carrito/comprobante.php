<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra Realizada con Éxito</title>
    <link rel="stylesheet" href="/TextilExport/Views/Carrito/css/comprobante.css">
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

<h2>Compra Realizada con Éxito</h2>
<p>Gracias por tu compra. Puedes ver tu comprobante aquí:</p>
<a class="comprobante-link" href="/TextilExport/Public/uploads/comprobantes/<?= htmlspecialchars($pdf) ?>" target="_blank">Ver comprobante PDF</a>

</body>
</html>
