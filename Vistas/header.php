<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
?>

<link rel="stylesheet" href="../Estilos/header.css">

<header class="main-header">
    <div class="container">
        <div class="logo">
            <?php
            $indexPath = 'index.php';
            if (!file_exists($indexPath)) {
                $indexPath = '../Vistas/index.php';
            }
            ?>
            <a href="<?php echo $indexPath; ?>">
                <img src="../img/logo.jpg" alt="Logo Trippin" class="logo-img" />
            </a>
            Trippin
        </div>

        <div class="right-content">
            <nav class="nav">
                <a href="contacto.php">Contáctanos</a>
                <a href="sobrenosotros.php">Sobre Nosotros</a>
            </nav>

            <div class="header-buttons">
                <a href="explore-trips.php" class="btn book">Buscar un viaje</a>

                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="dropdown">
                        <button class="btn user dropdown-toggle" onclick="toggleDropdown()">
                            <?php echo htmlspecialchars($_SESSION['usuario']); ?>
                        </button>
                        <div id="dropdown-menu" class="dropdown-menu" style="display: none;">
                            <a href="../Modelos/carrito.php" class="dropdown-item" id="carrito">
                                <!-- Shopping Cart SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: middle; margin-right: 6px;">
                                    <path d="M0 1a1 1 0 0 1 1-1h1.22a1 1 0 0 1 .98.804L3.89 4H14a1 1 0 0 1 .96 1.273l-1.5 6A1 1 0 0 1 12.5 12H4a1 1 0 0 1-1-.89L1.01 2H1a1 1 0 0 1-1-1zm3.14 3l1.25 5h7.11l1.2-4.8A.5.5 0 0 0 14 4H3.14zM5.5 13a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm6 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3z"/>
                                </svg>
                                Mi carrito
                            </a>
                            <a href="../Modelos/logout.php" class="dropdown-item" id="logout">
                                <!-- Logout Door SVG -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" viewBox="0 0 16 16" style="vertical-align: middle; margin-right: 14px;">
                                    <path d="M6 2a2 2 0 0 0-2 2v2a.5.5 0 0 0 1 0V4a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1v-2a.5.5 0 0 0-1 0v2a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H6z"/>
                                    <path d="M.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H9.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2z"/>
                                </svg>
                                Cerrar sesión
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="btn sign">Iniciar Sesión</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>

<script>
function toggleDropdown() {
    const menu = document.getElementById('dropdown-menu');
    if (menu.style.display === 'none' || menu.style.display === '') {
        menu.style.display = 'block';
    } else {
        menu.style.display = 'none';
    }
}

window.onclick = function(event) {
    if (!event.target.matches('.dropdown-toggle')) {
        const menu = document.getElementById('dropdown-menu');
        if (menu && menu.style.display === 'block') {
            menu.style.display = 'none';
        }
    }
}
</script>
