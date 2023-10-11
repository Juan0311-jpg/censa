<?php
// Verificar si el usuario ha iniciado sesión; si no, redirigir al inicio de sesión
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html"); 
    exit;
}

// Agregar el código para manejar el registro de usuario cuando la URL indica 'registro'
if (isset($_GET['action']) && $_GET['action'] === 'registro') {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Procesar el formulario de registro aquí
        // ...
    } else {
        // Mostrar el formulario de registro
        echo '<h1>Registro de Usuario</h1>';
        echo '<form action="informacion_taller.php?action=registro" method="post">';
        echo '<label for="new_username">Nombre de usuario:</label>';
        echo '<input type="text" name="new_username" id="new_username" required>';
        echo '<label for="new_password">Contraseña:</label>';
        echo '<input type="password" name="new_password" id="new_password" required>';
        echo '<input type="submit" value="Registrarse">';
        echo '</form>';
    }
} else {
    // Obtener la información del taller mecánico desde la base de datos (sustituye con tus nombres de tabla)
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "nombre_de_la_base_de_datos";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $username = $_SESSION['username']; // El nombre de usuario se almacena en la sesión

    // Consulta para obtener la información del taller para el usuario en sesión
    $sql = "SELECT * FROM taller WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Mostrar los detalles del taller
        $row = $result->fetch_assoc();
        echo "<h1>Bienvenido al Taller Mecánico " . $row['nombre'] . "</h1>";
        echo "<p>Dirección: " . $row['direccion'] . "</p>";
        echo "<p>Tipo de Trabajo: " . $row['tipo_trabajo'] . "</p>";
        echo "<p>Fecha de Entrega Máxima: " . $row['fecha_entrega'] . "</p>";
    } else {
        echo "No se encontró información del taller.";
    }

    $conn->close();
}
?>
