<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultados de Búsqueda</title>
    <link rel="stylesheet" href="../Vista/style.css">
</head>
<body>
    <?php
    // Iniciar la sesión
    session_start();

    // Incluir el archivo de conexión
    include '../Controladores/Conexion.php';

    // Verificar si se envió la tabla
    if (!isset($_POST['tabla'])) {
        die("<div class='error'>No se seleccionó ninguna tabla.</div>");
    }

    $tabla = $_POST['tabla'];
    $condiciones = [];
    $parametros = [];

    // Construir las condiciones de búsqueda dinámicamente
    foreach ($_POST as $campo => $valor) {
        if ($campo !== 'tabla' && $campo !== 'buscar_registro' && !empty($valor)) {
            $condiciones[] = "$campo = ?";
            $parametros[] = $valor;
        }
    }

    // Verificar si se ingresaron condiciones
    if (count($condiciones) > 0) {
        $sql = "SELECT * FROM $tabla WHERE " . implode(' AND ', $condiciones);
    } else {
        $sql = "SELECT * FROM $tabla";
    }

    // Preparar la consulta
    $stmt = $Direccion->prepare($sql);

    // Vincular los parámetros si hay condiciones
    if (count($parametros) > 0) {
        $tipos = str_repeat('s', count($parametros)); // Suponiendo que todos los campos sean de tipo string para este ejemplo
        $stmt->bind_param($tipos, ...$parametros);
    }

    // Ejecutar la consulta
    $stmt->execute();
    $resultado = $stmt->get_result();

    // Obtener la clave primaria de la tabla
    $sql_primary_key = "SHOW KEYS FROM $tabla WHERE Key_name = 'PRIMARY'";
    $resultado_primary_key = $Direccion->query($sql_primary_key);

    if ($resultado_primary_key === false) {
        die("<div class='error'>Error al consultar la clave primaria: " . $Direccion->error . "</div>");
    }

    $clave_primaria = null;
    if ($fila_clave = $resultado_primary_key->fetch_assoc()) {
        $clave_primaria = $fila_clave['Column_name'];
    }

    // Verificar si se encontraron resultados
    
    
    if ($resultado->num_rows > 0) {
        echo "<h2>Resultados de la tabla: " . htmlspecialchars($tabla) . "</h2>";
        echo "<div class='results-grid'>";    
        while ($fila = $resultado->fetch_assoc()) {
            echo "<div class='result-box'>";
            foreach ($fila as $campo => $valor) {
                echo "<strong>" . htmlspecialchars($campo) . ":</strong> " . htmlspecialchars($valor) . "<br>";
            }

            // Agregar el botón de eliminar
            if ($clave_primaria) {
                echo "<form method='POST' action='Baja.php' class='action-form' onsubmit='return confirm(\"¿Estás seguro de que quieres eliminar este registro?\");'>";
                echo "<input type='hidden' name='tabla' value='" . htmlspecialchars($tabla) . "'>";
                echo "<input type='hidden' name='clave_primaria' value='" . htmlspecialchars($clave_primaria) . "'>";
                echo "<input type='hidden' name='valor_primario' value='" . htmlspecialchars($fila[$clave_primaria]) . "'>"; 
                echo "<br><button type='submit'>Eliminar</button>";
                echo "</form>";
            }

            // Agregar el botón de editar
            if ($clave_primaria) {
                echo "<form method='POST' action='Modificacion.php' class='action-form'>";
                echo "<input type='hidden' name='tabla' value='" . htmlspecialchars($tabla) . "'>";
                echo "<input type='hidden' name='clave_primaria' value='" . htmlspecialchars($clave_primaria) . "'>";
                echo "<input type='hidden' name='valor_primario' value='" . htmlspecialchars($fila[$clave_primaria]) . "'>";
                echo "<br><button type='submit'>Editar</button>";
                echo "</form>";
            }

            echo "</div>";
        }
    } else {
        echo "<div class='error'>No se encontraron resultados para los criterios de búsqueda ingresados.</div>";
        echo "<a href='../index.php' class='back-link'>Volver hacia atrás</a>";
    }
    echo "</div>";

    // Cerrar la conexión
    $stmt->close();
    $Direccion->close();
    ?>
</body>
</html>
