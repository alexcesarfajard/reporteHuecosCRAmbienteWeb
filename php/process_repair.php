<?php
include_once 'Database.php';
include_once 'StreetRepair.php';

// Conectar a la base de datos
$database = new Database();
$db = $database->getConnection();
$streetRepair = new StreetRepair($db);

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_calle = htmlspecialchars(strip_tags($_POST['nombre_calle']));
    $ubicacion = htmlspecialchars(strip_tags($_POST['ubicacion']));
    $descripcion = htmlspecialchars(strip_tags($_POST['descripcion']));
    $fecha_inicio = htmlspecialchars(strip_tags($_POST['fecha_inicio']));
    $estado = htmlspecialchars(strip_tags($_POST['estado']));

    // Intentar añadir la calle
    if ($streetRepair->addStreet($nombre_calle, $ubicacion, $descripcion, $fecha_inicio, $estado)) {
        header("Location: repairs_in_progress.html?message=success");
    } else {
        header("Location: repairs_in_progress.html?message=error");
    }
    exit();
}
