<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ventas Registradas</title>
    <link rel="stylesheet" href="/TextilExport/Views/Ventas/css/index.css">
</head>
<body>

<!-- NAVBAR -->
<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo2.png" alt="Logo TextilExport" class="logo">
        <div style="color:white; font-size:20px; font-weight:bold;">Textil Export</div>
    </div>
    <ul class="nav-links">
        <li><a href="/TextilExport/Index/dashboard">Panel Principal</a></li>
        <li><a href="/TextilExport/Auth/logout">Cerrar sesión</a></li>
    </ul>
</nav>

<!-- CONTENIDO -->
<div class="container">
    <h2>Ventas Registradas</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Comprobante</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $v): ?>
                <tr>
                    <td><?= htmlspecialchars($v['id']) ?></td>
                    <td><?= htmlspecialchars($v['cliente']) ?></td>
                    <td><?= htmlspecialchars($v['fecha']) ?></td>
                    <td>$<?= htmlspecialchars(number_format($v['total'], 2)) ?></td>
                    <td>
                        <?php if (!empty($v['comprobante_pdf'])): ?>
                            <a href="/TextilExport/Public/uploads/comprobantes/<?= htmlspecialchars($v['comprobante_pdf']) ?>" target="_blank">Ver</a>
                        <?php else: ?>
                            <em>No generado</em>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

</body>
</html>
