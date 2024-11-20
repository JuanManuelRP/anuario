<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensajes de Usuarios</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 90%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f9;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .error {
            color: red;
            text-align: center;
        }
        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            text-decoration: none;
            color: #fff;
            background-color: #4CAF50;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Mensajes de Usuarios</h2>
        <?php
        // Datos de conexión
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "anuario";

        // Crear la conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            echo "<p class='error'>Error de conexión: " . htmlspecialchars($conn->connect_error) . "</p>";
        } else {
            // Consulta a la base de datos
            $sql = "SELECT nombre, apellido, mensaje FROM `anuario`";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Apellido</th>
                                <th>Mensaje</th>
                            </tr>
                        </thead>
                        <tbody>";
                // Mostrar los datos
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['nombre']) . "</td>
                            <td>" . htmlspecialchars($row['apellido']) . "</td>
                            <td>" . htmlspecialchars($row['mensaje']) . "</td>
                          </tr>";
                }
                echo "</tbody>
                    </table>";
            } else {
                echo "<p>No hay mensajes registrados.</p>";
            }
            // Cerrar conexión
            $conn->close();
        }
        ?>
        <a href="index.html">Regresar al formulario</a>
    </div>
</body>
</html>
