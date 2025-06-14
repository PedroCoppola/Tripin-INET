    <?php
    session_start();
    require_once '../Controladores/Conexion.php'; // Asegurate de tener tu clase Conexion con PDO

    function limpiar($data) {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    $conn = Conexion::getConexion();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        if (isset($_POST['registro'])) {
            $nombre = limpiar($_POST['nombre']);
            $email = limpiar($_POST['email']);
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

            $sql = "INSERT INTO usuarios (nombre, email, password, rol) VALUES (?, ?, ?, 'cliente')";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$nombre, $email, $password]);

            header('Location: ../vistas/login.php');
            exit;
        }

        if (isset($_POST['login'])) {
            $email = limpiar($_POST['email']);
            $password = $_POST['password'];

            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$email]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($password, $usuario['password'])) {
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];
                header('Location: ../vistas/index.php');
                exit;
            } else {
                header('Location: ../vistas/index.php?error=1');
                exit;
            }
        }
    }
