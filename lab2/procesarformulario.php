<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, "", $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$edad = $_POST['edad'];

$errores = [];

if (empty($nombre)) {
    $errores[] = "El nombre no puede estar vacío.";
}

if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El email no es válido.";
}

if (empty($edad) || !is_numeric($edad) || $edad <= 0) {
    $errores[] = "La edad debe ser un número positivo.";
}

if (!empty($errores)) {
    foreach ($errores as $error) {
        echo "<p style='color:red;'>$error</p>";
    }
} else {
    // Insertar datos en la base de datos
    $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES ('$nombre', '$email', '$edad')";
    
    if ($conn->query($sql) === TRUE) {
        echo "<p style='color:green;'>Registro agregado correctamente.</p>";
    } else {
        echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
    }
}

$conn->close();
?>
