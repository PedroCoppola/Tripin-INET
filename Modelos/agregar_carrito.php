<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_POST['id'], $_POST['nombre'], $_POST['precio'], $_POST['imagen'])) {
    $id = $_POST['id'];

    if (!isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id] = [
            'id' => $id,
            'nombre' => $_POST['nombre'],
            'precio' => floatval($_POST['precio']),
            'imagen' => $_POST['imagen']
        ];
    }
}

header('Location: carrito.php');
exit;
