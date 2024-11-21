<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "anuario";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consultar los mensajes (ajusta 'nombre' si necesitas ordenar por otra columna válida)
$sql = "SELECT nombre, apellido, mensaje FROM anuario ORDER BY nombre DESC LIMIT 10";
$result = $conn->query($sql);

// Generar el HTML de los mensajes
if ($result === false) {
    die("Error en la consulta: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="testimonial-item bg-light rounded p-4">';
        echo '    <div class="d-flex align-items-center mb-4">';
        echo '        <img class="flex-shrink-0 rounded-circle border p-1" src="img\logo.png" alt="Imagen de perfil">';
        echo '        <div class="ms-4">';
        echo '            <h5 class="mb-1">' . htmlspecialchars($row["nombre"], ENT_QUOTES, 'UTF-8') . '</h5>';
        echo '            <span>' . htmlspecialchars($row["apellido"], ENT_QUOTES, 'UTF-8') . '</span>';
        echo '        </div>';
        echo '    </div>';
        echo '    <p class="mb-0">' . htmlspecialchars($row["mensaje"], ENT_QUOTES, 'UTF-8') . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No hay mensajes para mostrar.</p>';
}

// Cerrar la conexión
$conn->close();
?>
