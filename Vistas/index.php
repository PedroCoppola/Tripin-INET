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
        <p>Descubre paquetes de viaje seleccionados a los destinos más impresionantes. Tu aventura te espera.</p>
        <button>Encuentra un viaje</button>
    </div>
</header>

<section class="featured">
    <div class="section-title">
        <h2>Featured Trips</h2>
    </div>
    <div class="card-row">
        <?php
        try {
            $conn = Conexion::getConexion();
            $sql = "SELECT id, nombre, descripcion, imagen FROM productos ORDER BY RAND() LIMIT 3";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $viajes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($viajes as $viaje) {
                echo '<div class="card">';
                echo '<img src="../img/featured/' . htmlspecialchars($viaje['imagen']) . '" alt="' . htmlspecialchars($viaje['nombre']) . '">';
                echo '<h1>' . htmlspecialchars($viaje['nombre']) . '</h1>';
                echo '<p>' . htmlspecialchars($viaje['descripcion']) . '</p>';
                echo '<a href="producto.php?id=' . urlencode($viaje['id']) . '" class="view-details">Ver más →</a>';
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
        <h2>Destinos Populares</h2>
    </div>
    <div class="popular-grid">
        <?php
        try {
            $conn = Conexion::getConexion();
            $sql = "SELECT nombre, descripcion, imagen FROM productos ORDER BY RAND() LIMIT 6";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $destinos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($destinos as $destino) {
                echo '<div class="popular-card">';
                echo '<img src="../img/featured/' . htmlspecialchars($destino['imagen']) . '" alt="' . htmlspecialchars($destino['nombre']) . '">';
                echo '<div class="popular-info">';
                echo '<h3>' . htmlspecialchars($destino['nombre']) . '</h3>';
                echo '<p>' . htmlspecialchars($destino['descripcion']) . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } catch (PDOException $e) {
            echo '<p>Error al cargar los destinos: ' . $e->getMessage() . '</p>';
        }
        ?>
    </div>
</section>

<?php include 'footer.php'; ?>
</body>
</html>