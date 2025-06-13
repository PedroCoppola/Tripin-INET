<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Viajes - Trippin</title>
    <link rel="stylesheet" href="../Estilos/explore-trips.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include "header.php";?>

    <main class="explore-trips-main">
        <section class="hero-explore-section">
            <div class="container hero-content-container">
                <h1>Explore Trips</h1>
                <p>Discover unique experiences led by local experts</p>
                <div class="search-bar">
                    <input type="text" placeholder="Search for destinations or activities">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </div>
        </section>

        <section class="filters-section">
            <div class="container">
                <div class="filter-buttons">
                    <button class="filter-btn active">All</button>
                    <button class="filter-btn">Adventure</button>
                    <button class="filter-btn">Relaxation</button>
                    <button class="filter-btn">Cultural</button>
                    <button class="filter-btn">Food & Drink</button>
                </div>
            </div>
        </section>

        <section class="featured-trips-section">
            <div class="container">
                <h2>Featured Trips</h2>
                <div class="trips-grid featured-grid">
                    <?php include '../Controladores/conexion.php'; // Incluye el archivo de conexión a la DB

                    try {
                        $stmt = $pdo->query("SELECT nombre, descripcion, imagen FROM productos WHERE en_oferta = 1 LIMIT 3");
                        $featured_trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($featured_trips) {
                            foreach ($featured_trips as $trip) {
                                // Asegúrate de que la ruta de la imagen sea correcta.
                                // Si tu carpeta de imágenes 'img' está en la raíz de 'Tripin-INET', y estás en 'Vistas/', entonces es '../img/trips/'
                                $image_src = "../img/featured/" . htmlspecialchars($trip['imagen']); 
                    ?>
                                <div class="trip-card featured-card">
                                    <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($trip['nombre']); ?>" onerror="this.onerror=null;this.src='https://placehold.co/400x250/cccccc/333333?text=Imagen+No+Disp.';">
                                    <h3><?php echo htmlspecialchars($trip['nombre']); ?></h3>
                                    <p><?php echo htmlspecialchars($trip['descripcion']); ?></p>
                                </div>
                    <?php
                            }
                        } else {
                            echo "<p class='no-results'>No hay viajes destacados disponibles en este momento.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p class='error-message'>Error al cargar viajes destacados: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </div>
            </div>
        </section>

        <section class="all-trips-section">
            <div class="container">
                <h2>All Trips</h2>
                <div class="trips-grid all-trips-grid">
                    <?php
                    // La conexión $pdo ya debería estar disponible aquí desde el include anterior.
                    try {
                        $stmt = $pdo->query("SELECT nombre, descripcion, imagen FROM productos");
                        $all_trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

                        if ($all_trips) {
                            foreach ($all_trips as $trip) {
                                $image_src = "../img/featured/" . htmlspecialchars($trip['imagen']); 
                    ?>
                                <div class="trip-card">
                                    <img src="<?php echo $image_src; ?>" alt="<?php echo htmlspecialchars($trip['nombre']); ?>" onerror="this.onerror=null;this.src='https://placehold.co/400x250/cccccc/333333?text=Imagen+No+Disp.';">
                                    <h3><?php echo htmlspecialchars($trip['nombre']); ?></h3>
                                    <p><?php echo htmlspecialchars($trip['descripcion']); ?></p>
                                </div>
                    <?php
                            }
                        } else {
                            echo "<p class='no-results'>No hay viajes disponibles en este momento.</p>";
                        }
                    } catch (PDOException $e) {
                        echo "<p class='error-message'>Error al cargar todos los viajes: " . $e->getMessage() . "</p>";
                    }
                    ?>
                </div>
                <div class="pagination">
                    <a href="#">&lt;</a>
                    <a href="#" class="active">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">4</a>
                    <a href="#">5</a>
                    <a href="#">&gt;</a>
                </div>
            </div>
        </section>
    </main>

    <?php include "footer.php";?>
</body>
</html>