<link rel="stylesheet" href="../Vista/style.css">
<?php
// Iniciar la sesión
session_start();

// Incluir el archivo de conexión
include '../Controladores/Conexion.php';

// Verificar si se enviaron los datos requeridos
if (!isset($_POST['tabla']) || !isset($_POST['clave_primaria']) || !isset($_POST['valor_primario'])) {
    die("Datos incompletos.");
}

$tabla = $_POST['tabla'];
$clave_primaria = $_POST['clave_primaria'];
$valor_primario = $_POST['valor_primario'];

// Verificar si se ha enviado el formulario para actualizar
if (isset($_POST['guardar_cambios'])) {
    $set_clause = [];
    $parametros = [];

    foreach ($_POST as $campo => $valor) {
        if ($campo !== 'tabla' && $campo !== 'clave_primaria' && $campo !== 'valor_primario' && $campo !== 'guardar_cambios') {
            $set_clause[] = "$campo = ?";
            $parametros[] = $valor;
        }
    }

    $parametros[] = $valor_primario; // Valor de la clave primaria para WHERE
    $tipos = str_repeat('s', count($parametros) - 1) . 'i'; // Asumiendo que el tipo de la clave primaria es entero

    $sql = "UPDATE $tabla SET " . implode(', ', $set_clause) . " WHERE $clave_primaria = ?";
    $stmt = $Direccion->prepare($sql);

    if ($stmt === false) {
        die("Error al preparar la consulta: " . $Direccion->error);
    }

    // Vincular los parámetros
    $stmt->bind_param($tipos, ...$parametros);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "<div class='success'>Registro actualizado con éxito.</div>";
        echo "<a href='../index.php' class='back-link'>Volver hacia atrás</a>";
    } else {
        echo "<div class='error'>Error al actualizar el registro: " . $stmt->error . "</div>";
        echo "<a href='../index.php' class='back-link'>Volver hacia atrás</a>";
    }

    // Cerrar la conexión
    $stmt->close();
    $Direccion->close();
    exit;
}

// Obtener los detalles del registro a editar
$sql = "SELECT * FROM $tabla WHERE $clave_primaria = ?";
$stmt = $Direccion->prepare($sql);
$stmt->bind_param('i', $valor_primario); // Asumiendo que el tipo de la clave primaria es entero
$stmt->execute();
$resultado = $stmt->get_result();
$registro = $resultado->fetch_assoc();

// Obtener la lista de campos de la tabla
$sql_campos = "SHOW COLUMNS FROM $tabla";
$resultado_campos = $Direccion->query($sql_campos);

if ($resultado_campos === false) {
    die("Error al consultar los campos de la tabla: " . $Direccion->error);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Registro</title>
</head>
<body>
    <header>
        <h1>Modificar Registro</h1>
    </header>

    <main>
        <form method="POST" action="">
            <input type="hidden" name="tabla" value="<?php echo htmlspecialchars($tabla); ?>">
            <input type="hidden" name="clave_primaria" value="<?php echo htmlspecialchars($clave_primaria); ?>">
            <input type="hidden" name="valor_primario" value="<?php echo htmlspecialchars($valor_primario); ?>">

            <?php
            // Mostrar los campos con los valores actuales
            while ($campo = $resultado_campos->fetch_assoc()) {
                $nombre_campo = htmlspecialchars($campo['Field']);
                $tipo_campo = strtolower($campo['Type']);
                $valor = htmlspecialchars($registro[$nombre_campo] ?? '');

                echo "<label for='$nombre_campo'>$nombre_campo:</label>";

                // Detectar tipo de campo y generar el input adecuado
                if (strpos($tipo_campo, 'int') !== false) {
                    echo "<input type='number' name='$nombre_campo' id='$nombre_campo' value='$valor'><br><br>";
                } elseif (strpos($tipo_campo, 'varchar') !== false || strpos($tipo_campo, 'text') !== false) {
                    echo "<input type='text' name='$nombre_campo' id='$nombre_campo' value='$valor'><br><br>";
                } elseif (strpos($tipo_campo, 'date') !== false) {
                    echo "<input type='date' name='$nombre_campo' id='$nombre_campo' value='$valor'><br><br>";
                } elseif (strpos($tipo_campo, 'float') !== false || strpos($tipo_campo, 'decimal') !== false) {
                    echo "<input type='number' step='0.01' name='$nombre_campo' id='$nombre_campo' value='$valor'><br><br>";
                } else {
                    // Input genérico por defecto
                    echo "<input type='text' name='$nombre_campo' id='$nombre_campo' value='$valor'><br><br>";
                }
            }
            ?>

            <button type="submit" name="guardar_cambios">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>
