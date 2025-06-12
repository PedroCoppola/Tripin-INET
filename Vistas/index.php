<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TravelEase</title>
    <link rel="stylesheet" href="../Estilos/style_index.css" />
</head>
<body>
    <?php include 'header.php'; ?>
   <header class="banner">
    <div class="banner-content">
        <h1>¡Explora el mundo con Trippin!</h1>
        <p>Descubre paquetes de viaje seleccionados a los destinos más impresionantes. Tu aventura te espera.</p>
        <button>Encuentra un viaje</button>
    </div>
</header>

   <section class="featured">
    <div class="section-title">
        <h2>Featured Trips</h2>
    </div>
    <div class="card-row">
        <div class="card">
            <img src="../img/featured/paris.jpg" alt="Featured1">
            <h1>Paris</h1>
            <p>Viaje a paris</p>
        </div>
        <div class="card">
            <img src="../img/featured/serrascord.jpg" alt="Featured2">
            <h1>Sierras De Córdoba</h1>
            <p>Este es otro viaje pero en vez de a maldivia a las sierras de cordoba papa</p>
        </div>
        <div class="card">
            <img src="../img/featured/maldivas.jpg" alt="Featured3">
            <h1>Viaje a las maldivas re copado</h1>
            <p>Este es un viaje a las maldivas y si no te gusta comeme bien la banana</p>
        </div>
    </div>
</section>

    <section class="popular">
        <div class="section-title">
            <h2>Popular Destinations</h2>
        </div>
        <div class="grid">
            <div class="grid-item">Paris</div>
            <div class="grid-item">Rome</div>
            <div class="grid-item">New York</div>
            <div class="grid-item">Tokyo</div>
            <div class="grid-item">Sydney</div>
            <div class="grid-item">Rio de Janeiro</div>
        </div>
    </section>
</body>
</html>
