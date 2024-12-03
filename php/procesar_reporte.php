<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";  // Cambia esto si tu base de datos tiene un usuario diferente
$password = "";  // Cambia esto si tu base de datos tiene una contraseña
$dbname = "reportes_huecos";  // Nombre de la base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$identificacion = $_POST['identificacion'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$provincia = $_POST['provincia'];
$canton = $_POST['canton'];
$distrito = $_POST['distrito'];
$descripcion = $_POST['descripcion'];
$direccion = $_POST['direccion'];
$acepto = isset($_POST['acepto']) ? 1 : 0;

// Validar que se haya marcado el checkbox de aceptación
if ($acepto == 0) {
    echo "Debes aceptar que la información proporcionada es verídica y real";
    exit();
}

// Manejo de las imágenes
$foto1 = $_FILES['foto1']['name'];
$foto2 = $_FILES['foto2']['name'];
$foto1_tmp = $_FILES['foto1']['tmp_name'];
$foto2_tmp = $_FILES['foto2']['tmp_name'];
$foto1_error = $_FILES['foto1']['error'];
$foto2_error = $_FILES['foto2']['error'];

// Directorio donde se guardarán las imágenes
$directorio = "uploads/";

// Verificar si la carpeta uploads existe, si no, crearla
if (!is_dir($directorio)) {
    mkdir($directorio, 0777, true);  // Crea la carpeta con permisos 777 (lectura/escritura)
}

// Validar el tipo y tamaño de los archivos
$allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
$max_size = 5 * 1024 * 1024;  // 5MB en bytes

// Validación para foto 1
if ($foto1_error === 0) {
    if (!in_array($_FILES['foto1']['type'], $allowed_types)) {
        echo "Solo se permiten imágenes JPG, JPEG o PNG para la foto 1.";
        exit();
    }
    if ($_FILES['foto1']['size'] > $max_size) {
        echo "El tamaño de la foto 1 es demasiado grande. El tamaño máximo permitido es 5MB.";
        exit();
    }

    $foto1_destino = $directorio . basename($foto1);
    if (!move_uploaded_file($foto1_tmp, $foto1_destino)) {
        echo "Error al subir la primera foto.";
        exit();
    }
}

// Validación para foto 2
if ($foto2_error === 0) {
    if (!in_array($_FILES['foto2']['type'], $allowed_types)) {
        echo "Solo se permiten imágenes JPG, JPEG o PNG para la foto 2.";
        exit();
    }
    if ($_FILES['foto2']['size'] > $max_size) {
        echo "El tamaño de la foto 2 es demasiado grande. El tamaño máximo permitido es 5MB.";
        exit();
    }

    $foto2_destino = $directorio . basename($foto2);
    if (!move_uploaded_file($foto2_tmp, $foto2_destino)) {
        echo "Error al subir la segunda foto.";
        exit();
    }
}

// Preparar la consulta SQL
$sql = "INSERT INTO reportes (nombre, apellido, identificacion, email, telefono, provincia, canton, distrito, descripcion, direccion, foto1, foto2) 
        VALUES ('$nombre', '$apellido', '$identificacion', '$email', '$telefono', '$provincia', '$canton', '$distrito', '$descripcion', '$direccion', '$foto1_destino', '$foto2_destino')";

// Ejecutar la consulta
if ($conn->query($sql) === TRUE) {
    echo "Reporte enviado correctamente.";
} else {
    echo "Error al enviar el reporte: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>
