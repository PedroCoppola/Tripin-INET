<?php
require_once '../Controladores/conexion.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

try {
    $conn = Conexion::getConexion();

    // Traer el producto principal
    $stmt = $conn->prepare("SELECT * FROM productos WHERE id = ?");
    $stmt->execute([$id]);
    $producto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$producto) {
        echo "<h2>Producto no encontrado</h2>";
        exit;
    }

    // Calcular precio si hay descuento
    $precio_original = $producto['precio'];
    $precio_final = $producto['precio'];
    if ($producto['en_oferta'] == 1 && $producto['descuento'] > 0) {
        $precio_final = $precio_original - ($precio_original * ($producto['descuento'] / 100));
    }

    // Productos recomendados
    $recomendados = $conn->query("SELECT id, nombre, descripcion, precio, imagen FROM productos WHERE id != $id ORDER BY RAND() LIMIT 3")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($producto['nombre']); ?> - Tripin</title>
    <link rel="stylesheet" href="../Estilos/paginaviaje.css">
</head>
<body>
    <?php include 'header.php'; ?>

    <main class="product-page-content">
        <section class="main-product-display">
            <div class="product-image-container">
                <img src="../img/featured/<?php echo htmlspecialchars($producto['imagen']); ?>" alt="<?php echo htmlspecialchars($producto['nombre']); ?>" class="product-main-image">
            </div>
            <div class="product-details">
                <?php if ($producto['en_oferta'] == 1): ?>
                    <span class="special-offer-tag">Oferta Especial!</span>
                <?php endif; ?>

                <h1 class="product-title"><?php echo htmlspecialchars($producto['nombre']); ?></h1>
    

                <p class="product-description">
                    <?php echo htmlspecialchars($producto['descripcion']); ?>
                </p>

                <div class="product-price-info">
                    <span class="current-price">$<?php echo number_format($precio_final, 2); ?></span>
                    <?php if ($producto['en_oferta'] == 1): ?>
                        <span class="original-price">$<?php echo number_format($precio_original, 2); ?></span>
                    <?php endif; ?>
                </div>
                <div class="product-actions">
                    <button class="book-now-button">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="#ffffff" viewBox="0 0 24 24" style="vertical-align: middle; margin-right: 8px;">
                            <path d="M21 6.5a2.5 2.5 0 1 0-5 0 2.5 2.5 0 0 0 5 0zM2 4v2h1.42l3.58 7-1.35 2.44A2 2 0 0 0 7.92 19H19v-2H8.42a.25.25 0 0 1-.23-.36L9.1 14h7.45a2 2 0 0 0 1.84-1.21l2.2-5.05a.5.5 0 0 0-.47-.74H5.21L4.27 4H2z"/>
                        </svg>Comprar ahora
                    </button>
<form method="POST" action="../Modelos/agregar_carrito.php">
    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
    <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($producto['nombre']); ?>">
    <input type="hidden" name="precio" value="<?php echo $precio_final; ?>">
    <input type="hidden" name="imagen" value="<?php echo htmlspecialchars($producto['imagen']); ?>">
    <button type="submit" class="add-to-wishlist-button">🛒 Agregar al carrito</button>
</form>


                </div>
            </div>
        </section>

<section class="you-might-also-like">
    <h2>Quizás te interese</h2>
    <div class="recommended-products">
        <?php foreach ($recomendados as $r): ?>
            <?php
                $precio_original = $r['precio'];
                $precio_final = $precio_original;
                $en_oferta = isset($r['en_oferta']) && $r['en_oferta'] == 1;
                if ($en_oferta && isset($r['descuento']) && $r['descuento'] > 0) {
                    $precio_final = $precio_original - ($precio_original * ($r['descuento'] / 100));
                }
            ?>
            <a href="producto.php?id=<?php echo $r['id']; ?>" class="view-details">
                <div class="product-card">
                    <img src="../img/featured/<?php echo htmlspecialchars($r['imagen']); ?>" alt="<?php echo htmlspecialchars($r['nombre']); ?>" class="card-image">
                    <div class="card-content">
                        <h3><?php echo htmlspecialchars($r['nombre']); ?></h3>
                        <p><?php echo htmlspecialchars($r['descripcion']); ?></p>
                        <div class="card-price-details">
                            <span class="card-price">$<?php echo number_format($precio_final, 2); ?></span>
                            <?php if ($en_oferta): ?>
                                <span class="original-price" style="text-decoration: line-through; color: #999; margin-left: 10px;">
                                    $<?php echo number_format($precio_original, 2); ?>
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

    </main>

    <?php include 'footer.php'; ?>
</body>
</html>
