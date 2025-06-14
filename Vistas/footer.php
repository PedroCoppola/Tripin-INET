<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer</title>
    <link rel="stylesheet" href="../Estilos/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <?php
    function resolveLink($filename) {
        if (file_exists(__DIR__ . '/' . $filename)) {
            return $filename;
        } elseif (file_exists(__DIR__ . '/../Vistas/' . $filename)) {
            return '../Vistas/' . $filename;
        } else {
            return $filename; // fallback
        }
    }
    ?>
    <footer class="footer">
        <div class="footer-links">
            <a href="<?php echo resolveLink('sobrenosotros.php'); ?>">Nosotros</a>
            <a href="<?php echo resolveLink('contacto.php'); ?>">Contacto</a>
            <a href="<?php echo resolveLink('polypriv.php'); ?>">Políticas De Privacidad</a>
            <a href="<?php echo resolveLink('termyserv.php'); ?>">Terminos De Servicio</a>
        </div>
        <div class="footer-social">
            <a href="#"><i class="fas fa-arrow-up"></i></a>
            <a href="#"><i class="fas fa-th-list"></i></a>
            <a href="#"><i class="fas fa-info-circle"></i></a>
        </div>
        <div class="footer-copyright">
            ©2025 Tripin. All rights reserved.
        </div>
    </footer>

</body>
</html>