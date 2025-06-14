<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tablero de </title>
    <link rel="stylesheet" href="../Estilos/dashboard.css">
    <style>
        
    </style>
</head>
<body>
    <?php
    // Iniciar la sesión
    session_start();

    // Incluir el archivo de conexión
    include '../Controladores/Conexion.php';

    // Consulta para obtener las tablas de la base de datos
    $sql = "SHOW TABLES";
    $resultado = $Direccion->query($sql);

    // Verificamos si la consulta fue exitosa
    if ($resultado === false) {
        die("Error al consultar las tablas: " . $Direccion->error);
    }
    ?>

    <header>
        <h1>Selecciona una Tabla</h1>
    </header>

    <main>
        <form method="POST" action="">
            <label for="tabla">Tablas disponibles:</label>
            <select name="tabla" id="tabla">
                <?php
                // Generar las opciones del dropdown con las tablas obtenidas de la consulta
                while ($fila = $resultado->fetch_array()) {
                    // Mantener la selección previa del usuario
                    $selected = (isset($_POST['tabla']) && $_POST['tabla'] == $fila[0]) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($fila[0]) . "' $selected>" . htmlspecialchars($fila[0]) . "</option>";
                }
                ?>
            </select>
            <button type="submit" name="mostrar_campos">Mostrar Campos</button>
        </form>

        <?php
        // Si se selecciona una tabla y se hace clic en "Mostrar Campos"
        if (isset($_POST['mostrar_campos']) && isset($_POST['tabla'])) {
            $tabla = $_POST['tabla'];

            // Consulta para obtener los campos de la tabla seleccionada
            $sql_campos = "SHOW COLUMNS FROM " . $tabla;
            $resultado_campos = $Direccion->query($sql_campos);

            // Verificar si la consulta fue exitosa
            if ($resultado_campos === false) {
                die("Error al consultar los campos de la tabla: " . $Direccion->error);
            }

            echo "<h2>Campos de la tabla: " . htmlspecialchars($tabla) . "</h2>";

            // Formulario combinado para agregar o buscar registros
            echo "<form method='POST' action=''>";
            echo "<input type='hidden' name='tabla' value='" . htmlspecialchars($tabla) . "'>"; // Enviar el nombre de la tabla seleccionada

            // Generar inputs para los campos de la tabla
            while ($campo = $resultado_campos->fetch_assoc()) {
                $nombre_campo = htmlspecialchars($campo['Field']);
                $tipo_campo = strtolower($campo['Type']);
                $es_autoincremental = $campo['Extra'] === 'auto_increment';

                echo "<label for='$nombre_campo'>$nombre_campo:</label>";

                // Detectar tipo de campo y generar el input adecuado
                if ($es_autoincremental) {
                    echo "<input type='text' name='$nombre_campo' id='$nombre_campo' value='' placeholder='Este campo es autoincremental y su valor será ignorado'>";
                } elseif (strpos($tipo_campo, 'int') !== false) {
                    echo "<input type='number' name='$nombre_campo' id='$nombre_campo'>";
                } elseif (strpos($tipo_campo, 'varchar') !== false || strpos($tipo_campo, 'text') !== false) {
                    echo "<input type='text' name='$nombre_campo' id='$nombre_campo'>";
                } elseif (strpos($tipo_campo, 'date') !== false) {
                    echo "<input type='date' name='$nombre_campo' id='$nombre_campo'>";
                } elseif (strpos($tipo_campo, 'float') !== false || strpos($tipo_campo, 'decimal') !== false) {
                    echo "<input type='number' step='0.01' name='$nombre_campo' id='$nombre_campo'>";
                } else {
                    // Input genérico por defecto
                    echo "<input type='text' name='$nombre_campo' id='$nombre_campo'>";
                }
            }

            // Botones de acción
            echo "<div class='actions'>";
            echo "<button type='submit' name='agregar_registro' formaction='../Modelos/Alta.php'>Agregar Registro</button>";
            echo "<button type='submit' name='buscar_registro' formaction='../Modelos/Consulta.php'>Buscar Registro</button>";
            echo "</div>";

            echo "</form>";
        }
        ?>
    </main>
</body>
</html>
