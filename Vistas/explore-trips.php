<?php 
include '../Controladores/conexion.php';
$conn = Conexion::getConexion(); 
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explorar Viajes - Tripin</title>
    <link rel="stylesheet" href="../Estilos/explore-trips.css" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include 'header.php'; ?>

<main class="explore-trips-main">
    <section class="hero-explore-section">
        <div class="container hero-content-container">
            <h1>Explorá los viajes</h1>
            <p>Descubrí experiencias únicas a los destinos más impresionantes</p>
<form class="search-bar" method="GET" action="">
    <input type="text" name="busqueda" placeholder="Buscar destinos o actividades" value="<?php echo isset($_GET['busqueda']) ? htmlspecialchars($_GET['busqueda']) : ''; ?>">
    <button type="submit"><i class="fas fa-search"></i></button>
</form>




        </div>
        <?php if (isset($_GET['busqueda']) && !empty(trim($_GET['busqueda']))) {
    $busqueda = trim($_GET['busqueda']);
    try {
        $stmt = $conn->prepare("SELECT id, nombre, descripcion, precio, descuento, en_oferta, imagen FROM productos WHERE nombre LIKE :term OR descripcion LIKE :term");
        $stmt->execute(['term' => '%' . $busqueda . '%']);
        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "<p class='error-message'>Error en la búsqueda: " . $e->getMessage() . "</p>";
        $resultados = [];
    }
?>

<section class="featured-trips-section">
    <div class="container-featured">
        <h2>Resultados para "<?php echo htmlspecialchars($busqueda); ?>"</h2>
        <div class="trips-grid featured-grid">
            <?php
            if ($resultados) {
                foreach ($resultados as $trip) {
                    $precio_final = $trip['precio'];
                    if ($trip['descuento'] > 0 && $trip['en_oferta'] == 1) {
                        $precio_final -= ($trip['precio'] * ($trip['descuento'] / 100));
                    }

                    $img = "../img/featured/" . htmlspecialchars($trip['imagen']);
                    echo '<a href="producto.php?id=' . $trip['id'] . '" class="trip-card featured-card">';
                    echo '<img src="' . $img . '" alt="' . htmlspecialchars($trip['nombre']) . '" onerror="this.onerror=null;this.src=\'https://placehold.co/400x250?text=Sin+Imagen\';">';
                    echo '<h3>' . htmlspecialchars($trip['nombre']) . '</h3>';
                    echo '<p>' . htmlspecialchars($trip['descripcion']) . '</p>';
                    echo '<div class="card-price-details">';
                    echo '<span class="card-price">$' . number_format($precio_final, 2) . '</span>';
                    if ($trip['en_oferta'] == 1 && $trip['descuento'] > 0) {
                        echo '<span class="original-price">$' . number_format($trip['precio'], 2) . '</span>';
                    }
                    echo '</div>';
                    echo '</a>';
                }
            } else {
                echo "<p class='no-results'>No se encontraron viajes que coincidan.</p>";
            }
            ?>
        </div>
    </div>
</section>

<?php } ?>

    </section>

    

    <section class="featured-trips-section">
        <div class="container-featured">
            <h2>Ofertas Especiales</h2>
            <div class="trips-grid featured-grid">
                <?php
                try {
                    $stmt = $conn->query("SELECT id, nombre, descripcion, precio, descuento, imagen FROM productos WHERE en_oferta = 1 LIMIT 3");
                    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($trips) {
                        foreach ($trips as $trip) {
                            $precio_final = $trip['precio'];
                            if ($trip['descuento'] > 0) {
                                $precio_final -= ($trip['precio'] * ($trip['descuento'] / 100));
                            }

                            $img = "../img/featured/" . htmlspecialchars($trip['imagen']);
                            echo '<a href="producto.php?id=' . $trip['id'] . '" class="trip-card featured-card">';
                            echo '<img src="' . $img . '" alt="' . htmlspecialchars($trip['nombre']) . '" onerror="this.onerror=null;this.src=\'https://placehold.co/400x250?text=Sin+Imagen\';">';
                            echo '<h3>' . htmlspecialchars($trip['nombre']) . '</h3>';
                            echo '<p>' . htmlspecialchars($trip['descripcion']) . '</p>';
                          echo '<div class="card-price-details">';
echo '<span class="card-price">$' . number_format($precio_final, 2) . '</span>';

if (($trip['en_oferta'] ?? 1) && $trip['descuento'] > 0) {
    echo '<span class="original-price">$' . number_format($trip['precio'], 2) . '</span>';
}

echo '</div>';
                            echo '</a>';
                        }
                    } else {
                        echo "<p class='no-results'>No hay viajes destacados disponibles.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error-message'>Error al cargar viajes: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </div>
    </section>

    <section class="all-trips-section">
        <div class="container-featured  ">
            <h2>Todos los viajes</h2>
            <div class="trips-grid all-trips-grid">
                <?php
                try {
                    $stmt = $conn->query("SELECT id, nombre, descripcion, precio, descuento, en_oferta, imagen FROM productos");
                    $trips = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($trips) {
                        foreach ($trips as $trip) {
                            $precio_final = $trip['precio'];
                            if ($trip['en_oferta'] == 1 && $trip['descuento'] > 0) {
                                $precio_final -= ($trip['precio'] * ($trip['descuento'] / 100));
                            }

                            $img = "../img/featured/" . htmlspecialchars($trip['imagen']);
                            echo '<a href="producto.php?id=' . $trip['id'] . '" class="trip-card">';
                            echo '<img src="' . $img . '" alt="' . htmlspecialchars($trip['nombre']) . '" onerror="this.onerror=null;this.src=\'https://placehold.co/400x250?text=Sin+Imagen\';">';
                            echo '<h3>' . htmlspecialchars($trip['nombre']) . '</h3>';
                            echo '<p>' . htmlspecialchars($trip['descripcion']) . '</p>';
                           echo '<div class="card-price-details">';
echo '<span class="card-price">$' . number_format($precio_final, 2) . '</span>';

if (($trip['en_oferta'] ?? 1) && $trip['descuento'] > 0) {
    echo '<span class="original-price">$' . number_format($trip['precio'], 2) . '</span>';
}

echo '</div>';
                            echo '</a>';
                        }
                    } else {
                        echo "<p class='no-results'>No hay viajes disponibles por ahora.</p>";
                    }
                } catch (PDOException $e) {
                    echo "<p class='error-message'>Error al cargar los viajes: " . $e->getMessage() . "</p>";
                }
                ?>
            </div>
        </div>
    </section>
</main>

<?php include 'footer.php'; ?>
</body>
</html>
