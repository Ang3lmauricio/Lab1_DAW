<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";
$conn = new mysqli($servername, $username, "", $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id=$id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Usuario no encontrado.";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $edad = trim($_POST['edad']);

    if (!empty($nombre) && filter_var($email, FILTER_VALIDATE_EMAIL) && is_numeric($edad) && $edad > 0) {
        $sql = "UPDATE usuarios SET nombre='$nombre', email='$email', edad='$edad' WHERE id=$id";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color:green;'>Registro actualizado correctamente.</p>";
        } else {
            echo "<p style='color:red;'>Error: " . $conn->error . "</p>";
        }
    } else {
        echo "<p style='color:red;'>Datos inválidos.</p>";
    }
}

$conn->close();
?>

<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    Nombre: <input type="text" name="nombre" value="<?php echo $row['nombre']; ?>"><br>
    Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
    Edad: <input type="number" name="edad" value="<?php echo $row['edad']; ?>"><br>
    <button type="submit">Actualizar</button>
</form>
