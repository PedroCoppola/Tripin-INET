<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto - TravelEase</title>
    <link rel="stylesheet" href="../Estilos/contacto.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<?php include "header.php"?>
    <main class="contact-page-main">
        <section class="get-in-touch-section">
            <div class="container get-in-touch-content"> 
                <h1>Ponte en Contacto</h1>
                <p>¡Nos encantaría escucharte! Si tienes alguna pregunta sobre nuestros viajes, precios o cualquier otra cosa, nuestro equipo está listo para responder todas tus inquietudes.</p>
            </div>
        </section>

        <section class="contact-form-section">
            <div class="container contact-grid">
                <div class="form-card">
                    <h2>¡Envianos un mensaje!</h2>
                    <form action="#" method="POST">
                        <div class="form-group">
                            <label for="full-name">Nombre Completo</label>
                            <input type="text" id="full-name" name="full-name" placeholder="Tu Nombre...">
                        </div>
                        <div class="form-group">
                            <label for="email-address">Correo Electrónico</label>
                            <input type="email" id="email-address" name="email-address" placeholder="correo@ejemplo.com">
                        </div>
                        <div class="form-group">
                            <label for="subject">Mótivo</label>
                            <input type="text" id="subject" name="subject" placeholder="Motivo de su mensaje...">
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tu Mensaje..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-submit">Enviar Mensaje</button>
                    </form>
                </div>

                <div class="info-card">
                    <h2>Contact Information</h2>
                    <div class="contact-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div class="text-content">
                            <h3>Nuestra Oficina</h3>
                            <p>Algun Lugar del mundo, 123, Buenos Aires, Argentina</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-envelope"></i>
                        <div class="text-content">
                            <h3>Contácto por correo</h3>
                            <p>marcosvillaro007@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <i class="fas fa-phone-alt"></i>
                        <div class="text-content">
                            <h3>Llámanos</h3>
                            <p>+54 9 11-2302-1712</p>
                        </div>
                    </div>

                    <h2 class="connect-title">¡Contáctanos!</h2>
                    <div class="social-links">
                        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <?php include "footer.php" ?>
</body>
</html>