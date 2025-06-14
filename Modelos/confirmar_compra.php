<?php
session_start();
$_SESSION['carrito'] = [];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Compra confirmada - Tripin</title>
    <link rel="stylesheet" href="../Estilos/carrito.css">
</head>
<body>
<?php include '../Vistas/header.php'; ?>

<main class="container">
    <h1>¡Gracias por tu compra!</h1>
    <p>Recibirás un correo con los detalles de tu reserva.</p>
    <a href="index.php">Volver al inicio</a>
</main>

<?php include '../Vistas/footer.php'; ?>
</body>
</html>
