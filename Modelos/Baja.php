<link rel="stylesheet" href="Vista/style.css">
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

// Preparar la consulta para eliminar el registro
$sql = "DELETE FROM $tabla WHERE $clave_primaria = ?";
$stmt = $Direccion->prepare($sql);

if ($stmt === false) {
    die("Error al preparar la consulta: " . $Direccion->error);
    echo "<a href='../index.php'>Volver hacia atrás</a>";

}

// Vincular el valor de la clave primaria
$stmt->bind_param('i', $valor_primario); // Asumiendo que el tipo de la clave primaria es entero

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro eliminado con éxito.";
    echo "<a href='../index.php'>Volver hacia atrás</a>";
} else {
    echo "Error al eliminar el registro: " . $stmt->error;
    echo "<a href='../index.php'>Volver hacia atrás</a>";
}

// Cerrar la conexión
$stmt->close();
$Direccion->close();
?>
