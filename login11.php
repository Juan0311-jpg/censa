<?php
// Conexión a la base de datos (reemplaza los valores con los de tu servidor)
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "nombre_de_tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibe los datos del formulario de login
$username = $_POST['username'];
$password = $_POST['password'];

// Consulta para verificar las credenciales (debo remplazar "usuarios" y "contrasenas" con los nombres de tabla)
$sql = "SELECT * FROM usuarios WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    // El usuario ha ingresado correctamente, puedes redirigirlo a la página de información del taller.
    header("Location: informacion_taller.php");
} else {
    // Las credenciales son incorrectas, muestra un mensaje de error o redirige al inicio de sesión nuevamente.
    echo "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
}

$conn->close();
?>