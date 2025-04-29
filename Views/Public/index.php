<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a TextilExport</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/TextilExport/Views/Public/css/index.css">

</head>
<body>

<nav>
    <div class="nav-left">
        <img src="/TextilExport/Public/IMG/logo.png" alt="Logo TextilExport">
        TextilExport
    </div>
    
</nav>

<section class="hero">
    <div class="hero-content">
        <h1 class="hero-title">Bienvenido a <span class="highlight">TextilExport</span></h1>
        <p class="hero-subtitle">Los mejores textiles y promocionales de El Salvador para tu empresa o evento.</p>
        <div class="hero-buttons">
            <a href="/TextilExport/Public/tienda" class="btn-hero">Ver Catálogo</a>
            <a href="/TextilExport/Public/login" class="btn-hero btn-outline">Cliente</a>
            <a href="/TextilExport/Auth/login" class="btn-hero btn-outline">Empleado</a>
        </div>
    </div>
</section>


<!-- Carrusel Mejorado -->
<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/TextilExport/Public/IMG/Banner1.png" class="d-block w-100" alt="Primera imagen">
    </div>
    <div class="carousel-item">
      <img src="/TextilExport/Public/IMG/Banner2.png" class="d-block w-100" alt="Segunda imagen">
    </div>
    <div class="carousel-item">
      <img src="/TextilExport/Public/IMG/Banner3.png" class="d-block w-100" alt="Tercera imagen">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

<section class="mision-vision">
    <h2 class="section-title">Nuestra Empresa</h2>
    <div class="container py-4">
        <div class="row justify-content-center g-4">
            <div class="col-md-5">
                <div class="card shadow-lg border-0 h-100 animate-card">
                    <div class="card-body text-center">
                        <h3 class="card-title text-primary mb-3">Misión</h3>
                        <p class="card-text text-secondary">
                            Proveer textiles y productos promocionales de alta calidad que impulsen el éxito de nuestros clientes, ofreciendo siempre un servicio confiable y personalizado.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card shadow-lg border-0 h-100 animate-card">
                    <div class="card-body text-center">
                        <h3 class="card-title text-primary mb-3">Visión</h3>
                        <p class="card-text text-secondary">
                            Ser la empresa líder en El Salvador en distribución de textiles y artículos promocionales, reconocida por nuestra innovación, compromiso social y excelencia en el servicio.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<footer>
    &copy; <?= date('Y') ?> TextilExport. Todos los derechos reservados. | San Salvador, El Salvador
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
