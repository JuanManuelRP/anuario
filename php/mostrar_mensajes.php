<?php
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

// Consultar los mensajes
$sql = "SELECT nombre, apellido, mensaje FROM anuario ORDER BY id DESC";
$result = $conn->query($sql);

// Generar el HTML de los mensajes
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="testimonial-item bg-light rounded p-4">';
        echo '    <div class="d-flex align-items-center mb-4">';
        echo '        <img class="flex-shrink-0 rounded-circle border p-1" src="img/testimonial-2.jpg" alt="Imagen de perfil">';
        echo '        <div class="ms-4">';
        echo '            <h5 class="mb-1">' . htmlspecialchars($row["nombre"]) . '</h5>';
        echo '            <span>' . htmlspecialchars($row["apellido"]) . '</span>';
        echo '        </div>';
        echo '    </div>';
        echo '    <p class="mb-0">' . htmlspecialchars($row["mensaje"]) . '</p>';
        echo '</div>';
    }
} else {
    echo '<p>No hay mensajes para mostrar.</p>';
}

$conn->close();
?>

