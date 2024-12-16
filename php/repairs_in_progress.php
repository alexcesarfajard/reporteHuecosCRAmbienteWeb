<?php
include_once 'Database.php';
include_once 'StreetRepair.php';

// Conectar a la base de datos
$database = new Database();
$db = $database->getConnection();
$streetRepair = new StreetRepair($db);

// Verificar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitizar los datos
    $nombre_calle = htmlspecialchars(strip_tags($_POST['nombre_calle']));
    $ubicacion = htmlspecialchars(strip_tags($_POST['ubicacion']));
    $descripcion = htmlspecialchars(strip_tags($_POST['descripcion']));
    $fecha_inicio = htmlspecialchars(strip_tags($_POST['fecha_inicio']));
    $estado = htmlspecialchars(strip_tags($_POST['estado']));

    // Validar que los campos no estén vacíos
    if (empty($nombre_calle) || empty($ubicacion) || empty($descripcion) || empty($fecha_inicio) || empty($estado)) {
        header("Location: repairs_in_progress.php?message=error&reason=emptyfields");
        exit();
    }

    // Intentar añadir la calle
    if ($streetRepair->addStreet($nombre_calle, $ubicacion, $descripcion, $fecha_inicio, $estado)) {
        // Redirigir con mensaje de éxito
        header("Location: repairs_in_progress.php?message=success");
    } else {
        // Redirigir con mensaje de error
        header("Location: repairs_in_progress.php?message=error&reason=insertfailed");
    }
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reparaciones en Progreso</title>
    <style>
        /* Estilos para el sitio */
        body {
            background-color: #f9f9f9;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        .navbar {
            background-color: #004080;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .navbar .navbar-brand {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
        }
        .navbar .nav-link {
            color: white;
        }
        .navbar .nav-link:hover {
            color: #0066cc;
        }
        .table {
            width: 100%;
            margin-top: 20px;
        }
        .footer {
            background-color: #004080;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 0.9rem;
        }
        .form-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.html">Reporte de Calles</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="repairs_in_progress.php">Reparaciones en Progreso</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario para añadir calle -->
    <div class="container form-container">
        <h1>Reparaciones en Progreso</h1>
        <p>Esta sección permite añadir nuevas calles que están siendo reparadas.</p>

        <?php
        // Mostrar mensajes de éxito o error
        if (isset($_GET['message'])) {
            if ($_GET['message'] == 'success') {
                echo "<div style='background-color: #d4edda; color: #155724; padding: 10px; text-align: center;'>La calle ha sido añadida exitosamente.</div>";
            } elseif ($_GET['message'] == 'error') {
                if (isset($_GET['reason']) && $_GET['reason'] == 'emptyfields') {
                    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center;'>Todos los campos son obligatorios.</div>";
                } elseif (isset($_GET['reason']) && $_GET['reason'] == 'insertfailed') {
                    echo "<div style='background-color: #f8d7da; color: #721c24; padding: 10px; text-align: center;'>Ocurrió un error al intentar añadir la calle.</div>";
                }
            }
        }
        ?>

        <!-- Formulario para añadir calle -->
        <form action="repairs_in_progress.php" method="POST">
            <div>
                <label for="nombre_calle">Nombre de la Calle:</label>
                <input type="text" id="nombre_calle" name="nombre_calle" required>
            </div>
            <div>
                <label for="ubicacion">Ubicación:</label>
                <input type="text" id="ubicacion" name="ubicacion" required>
            </div>
            <div>
                <label for="descripcion">Descripción del Daño:</label>
                <input type="text" id="descripcion" name="descripcion" required>
            </div>
            <div>
                <label for="fecha_inicio">Fecha de Inicio:</label>
                <input type="date" id="fecha_inicio" name="fecha_inicio" required>
            </div>
            <div>
                <label for="estado">Estado:</label>
                <select id="estado" name="estado" required>
                    <option value="En Reparación">En Reparación</option>
                    <option value="Reparación Programada">Reparación Programada</option>
                </select>
            </div>
            <button type="submit">Agregar Calle</button>
        </form>

        <!-- Mostrar las calles en reparación -->
        <h2>Calles en Reparación</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre de la Calle</th>
                    <th>Ubicación</th>
                    <th>Descripción</th>
                    <th>Fecha de Inicio</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar las calles registradas
                $query = "SELECT * FROM calles_reparacion"; // Asegúrate de que este sea el nombre correcto de tu tabla
                $stmt = $db->prepare($query);
                $stmt->execute();
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $count = 1;
                foreach ($rows as $row) {
                    echo "<tr>
                            <td>{$count}</td>
                            <td>{$row['nombre_calle']}</td>
                            <td>{$row['ubicacion']}</td>
                            <td>{$row['descripcion']}</td>
                            <td>{$row['fecha_inicio']}</td>
                            <td>{$row['estado']}</td>
                          </tr>";
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p><strong>Sistema de Reporte de Calles</strong> - Proyecto desarrollado en 2024 para mejorar nuestras vías públicas.</p>
    </footer>

</body>
</html>
