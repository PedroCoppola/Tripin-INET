<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<link rel="stylesheet" href="../Estilos/header.css">

<header class="main-header">
    <div class="container">
        <div class="logo">
            <a href="index.php">
                <img src="../img/logo.jpg" alt="Logo Trippin" class="logo-img" />
            </a>
            Trippin
        </div>

        <div class="right-content">
            <nav class="nav">
                <a href="#">Lugares</a>
                <a href="contacto.php">Contáctanos</a>
                <a href="sobrenosotros.php">Sobre Nosotros</a>
            </nav>

            <div class="header-buttons">
                <a href="#" class="btn book">Buscar un viaje</a>

                <?php if (isset($_SESSION['usuario'])): ?>
                    <a href="perfil.php" class="btn user">
                        <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn sign">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
