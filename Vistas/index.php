<?php include '../Controladores/conexion.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tripin</title>
    <link rel="stylesheet" href="../Estilos/style_index.css" />
</head>
<body>

<?php include 'header.php'; ?>

<header class="banner">
    <div class="banner-content">
        <h1>¡Explora el mundo con Tripin!</h1>
=======
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
>>>>>>> bda5a00c540c0e025bebb074e0608774ec3f8b50
        <p>Descubre paquetes de viaje seleccionados a los destinos más impresionantes. Tu aventura te espera.</p>
        <button>Encuentra un viaje</button>
    </div>
</header>

<<<<<<< HEAD
<section class="featured">
=======
   <section class="featured">
>>>>>>> bda5a00c540c0e025bebb074e0608774ec3f8b50
    <div class="section-title">
        <h2>Featured Trips</h2>
    </div>
    <div class="card-row">
<<<<<<< HEAD
        <?php
        try {
            $conn = Conexion::getConexion();
            $sql = "SELECT nombre, descripcion, imagen FROM productos ORDER BY RAND() LIMIT 3";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($viajes as $viaje) {
                echo '<div class="card">';
                echo '<img src="../img/featured/' . htmlspecialchars($viaje['imagen']) . '" alt="' . htmlspecialchars($viaje['nombre']) . '">';
                echo '<h1>' . htmlspecialchars($viaje['nombre']) . '</h1>';
                echo '<p>' . htmlspecialchars($viaje['descripcion']) . '</p>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '<p>Error al cargar viajes destacados: ' . $e->getMessage() . '</p>';
        }
        ?>
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

=======
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
>>>>>>> bda5a00c540c0e025bebb074e0608774ec3f8b50
</body>
</html>
