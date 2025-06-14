<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
$total = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tu carrito - Tripin</title>
    <link rel="stylesheet" href="../Estilos/carrito.css">
</head>
<body>
<?php include '../Vistas/header.php'; ?>

<main class="container">
    <h1>Carrito de Compras</h1>

    <?php if (empty($carrito)): ?>
        <p>Tu carrito está vacío.</p>
    <?php else: ?>
   <div class="carrito-grid">
<?php foreach ($carrito as $item): ?>
    <?php 
        
        $total += $item['precio'];
    ?>
    <div class="carrito-card">
        <img src="../img/featured/<?php echo htmlspecialchars($item['imagen']); ?>" alt="<?php echo htmlspecialchars($item['nombre']); ?>">
        <div class="carrito-info">
            <h3><?php echo htmlspecialchars($item['nombre']); ?></h3>
            <p class="precio">$<?php echo number_format($item['precio'], 2); ?></p>
            <a href="quitar_del_carrito.php?id=<?php echo $item['id']; ?>" class="eliminar-btn">Eliminar</a>
        </div>
    </div>
<?php endforeach; ?>
</div>

<div class="carrito-total">
    <p><strong>Total:</strong> $<?php echo number_format($total, 2); ?></p>
    <a href="confirmar_compra.php" class="btn-confirmar">Confirmar compra</a>
</div>

    <?php endif; ?>
</main>

<?php include '../Vistas/footer.php'; ?>
</body>
</html>
