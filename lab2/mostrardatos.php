<?php
// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consultar datos
$sql = "SELECT id, nombre, email, edad FROM usuarios";
$result = $conn->query($sql);

// Agregar estilos CSS
echo "<style>
    table { 
        width: 100%; 
        border-collapse: collapse; 
        margin-top: 20px; 
    }
    th, td { 
        border: 1px solid black; 
        padding: 10px; 
        text-align: center; 
    }
    th { 
        background-color: #4CAF50; 
        color: white; 
    }
    tr:nth-child(even) { 
        background-color: #f2f2f2; 
    }
    tr:hover { 
        background-color: #ddd; 
    }
</style>";

echo "<h1>Usuarios Registrados</h1>";
echo "<table>";
echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Acciones</th></tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["nombre"] . "</td>";
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["edad"] . "</td>";
        echo "<td>
            <a href='editar.php?id=" . $row["id"] . "'>Editar</a> | 
            <a href='eliminar.php?id=" . $row["id"] . "' onclick='return confirm(\"¿Seguro que quieres eliminar este usuario?\")'>Eliminar</a>
        </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay usuarios registrados.</td></tr>";
}

echo "</table>";

$conn->close();
?>
