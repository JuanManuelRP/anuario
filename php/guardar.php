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

// Verificar si se enviaron datos desde el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    if (empty($nombre) || empty($apellido) || empty($email)) {
        die("Por favor completa todos los campos requeridos.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Correo electrónico no es válido.");
    }

    // Insertar los datos en la base de datos
    $sql = "INSERT INTO `anuario` (nombre, apellido, email, telefono, mensaje) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $apellido, $email, $telefono, $mensaje);

    if ($stmt->execute()) {
        header("Location: /anuario/exito.html"); // Redirigir al formulario después de guardar
        exit();
    } else {
        error_log("Error al insertar datos: " . $stmt->error); // Registra el error
    die("Ocurrió un problema al procesar tu solicitud. Por favor, inténtalo más tarde.");
    }

    $stmt->close();
}
$conn->close();
?>
