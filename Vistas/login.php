<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tripin - Acceso</title>
    <link rel="stylesheet" href="../Estilos/style_login.css">
</head>
<body>

<img src="../Img/logo.jpg">
<h1>Tripin</h1>

<div class="contenedor-login">
    <div class="tabs">
        <div class="tab activo" onclick="mostrarFormulario('login')">Iniciar Sesión</div>
        <div class="tab" onclick="mostrarFormulario('registro')">Registrarse</div>
    </div>

    <form class="formulario activo" id="form-login" method="POST" action="../modelos/login.php">
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="login">Ingresar</button>
    </form>

    <form class="formulario" id="form-registro" method="POST" action="../modelos/login.php">
        <input type="text" name="nombre" placeholder="Nombre completo" required>
        <input type="email" name="email" placeholder="Correo electrónico" required>
        <input type="password" name="password" placeholder="Contraseña" required>
        <button type="submit" name="registro">Crear cuenta</button>
    </form>
</div>

<script>
    function mostrarFormulario(id) {
        document.getElementById('form-login').classList.remove('activo');
        document.getElementById('form-registro').classList.remove('activo');
        document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('activo'));

        document.getElementById('form-' + id).classList.add('activo');
        document.querySelector('.tab:nth-child(' + (id === 'login' ? '1' : '2') + ')').classList.add('activo');
    }
</script>

</body>
</html>
