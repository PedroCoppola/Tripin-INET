<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Registro</title>
    <link rel="stylesheet" href="../Vista/style.css">   
</head>
<body>
    <div class="container">
        <?php
        // Iniciar la sesión
        session_start();

        // Incluir el archivo de conexión
        include '../Controladores/Conexion.php';

        // Verificar si el formulario fue enviado
        if (isset($_POST['agregar_registro']) && isset($_POST['tabla'])) {
            $tabla = $_POST['tabla'];

            // Filtrar los datos del formulario dinámicamente
            $campos = array();
            $valores = array();

            foreach ($_POST as $campo => $valor) {
                if ($campo != 'tabla' && $campo != 'agregar_registro') {
                    $campos[] = $campo;
                    $valores[] = "'" . $Direccion->real_escape_string($valor) . "'";
                }
            }

            // Convertir los arrays en cadenas separadas por comas para la consulta SQL
            $campos_sql = implode(", ", $campos);
            $valores_sql = implode(", ", $valores);

            // Crear la consulta SQL de inserción
            $sql_insert = "INSERT INTO $tabla ($campos_sql) VALUES ($valores_sql)";

            // Ejecutar la consulta de inserción
            if ($Direccion->query($sql_insert) === true) {
                echo "<div class='success'>Registro agregado exitosamente.</div>";
                echo "<a href='../Vistas/dashboard.php' class='back-link'>Volver hacia atrás</a>";
            } else {
                echo "<div class='error'>Error al agregar el registro: " . $Direccion->error . "</div>";
            }
        } else {
            echo "<div class='error'>No se han recibido datos para procesar.</div>";
        }

        // Cerrar la conexión
        $Direccion->close();
        ?>
    </div>
</body>
</html>
