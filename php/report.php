<?php
// Incluir la clase para la conexión y el reporte de calles
include_once 'Database.php';
include_once 'StreetReport.php';

// Crear una instancia de la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia de la clase StreetReport
$streetReport = new StreetReport($db);

// Variable para el mensaje
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignar los valores recibidos del formulario a las propiedades de la clase
    $streetReport->nombre_calle = $_POST['nombre_calle'];
    $streetReport->ubicacion = $_POST['ubicacion'];
    $streetReport->descripcion = $_POST['descripcion'];
    $streetReport->tamano_estimado = $_POST['tamano_estimado'];
    $streetReport->estado = 'pendiente';  // El reporte comienza como pendiente

    // Intentar guardar el reporte
    if ($streetReport->report()) {
        $message = "<div class='alert alert-success' role='alert'>
                        Calle reportada exitosamente. ¡Gracias por tu colaboración!
                    </div>";
    } else {
        $message = "<div class='alert alert-danger' role='alert'>
                        Error al reportar la calle. Intenta nuevamente.
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Calle en Mal Estado</title>
    <style>
      /* Variables de color */
      :root {
          --background-color: #f9f9f9;
          --text-color: #333;
          --navbar-bg: #004080;
          --card-bg: #ffffff;
          --button-bg: #0066cc;
          --button-text: #ffffff;
          --button-hover: #005bb5;
          --dropdown-bg: #f0f0f0;
          --dropdown-hover: #e0e0e0;
          --link-hover: #0066cc;
          --border-color: #d1d1d1;
      }

      body {
          background-color: var(--background-color);
          color: var(--text-color);
          font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
          margin: 0;
          padding: 0;
          line-height: 1.6;
      }

      .navbar {
          background-color: var(--navbar-bg);
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .navbar .navbar-brand {
          color: var(--button-text);
          font-size: 1.5rem;
          font-weight: bold;
      }

      .navbar .nav-link {
          color: var(--button-text);
          transition: color 0.3s ease;
      }

      .navbar .nav-link:hover {
          color: var(--link-hover);
      }

      .btn-primary {
          background-color: var(--button-bg);
          color: var(--button-text);
          border: none;
          padding: 10px 15px;
          font-weight: 500;
          transition: background-color 0.3s ease;
      }

      .btn-primary:hover {
          background-color: var(--button-hover);
      }

      .formReport {
          margin: 20px;
      }

      .field {
          margin-bottom: 15px;
      }

      .input, .textarea, .select {
          width: 100%;
          padding: 8px;
          border: 1px solid var(--border-color);
          border-radius: 4px;
      }

      .footer {
          background-color: var(--navbar-bg);
          color: var(--button-text);
          text-align: center;
          padding: 20px 0;
          font-size: 0.9rem;
          margin-top: 30px;
      }

      /* Estilos para el mensaje */
      .alert {
          padding: 15px;
          margin-bottom: 20px;
          border-radius: 4px;
          font-size: 1.1rem;
      }

      .alert-success {
          background-color: #d4edda;
          color: #155724;
          border-color: #c3e6cb;
      }

      .alert-danger {
          background-color: #f8d7da;
          color: #721c24;
          border-color: #f5c6cb;
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <section class="navbar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="home.html">Reporte de Calles</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link active" href="report_issue.html">Reportar Calle</a></li>
                  <li class="nav-item"><a class="nav-link" href="repairs_in_progress.html">Reparaciones en Progreso</a></li>
                  <li class="nav-item"><a class="nav-link" href="contact_support.html">Soporte</a></li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <!-- Formulario de Reporte -->
    <main class="formReport">
        <h1 class="title">Reportar Calle en Mal Estado</h1>

        <!-- Mostrar el mensaje de éxito o error -->
        <?php echo $message; ?>

        <form action="report.php" method="POST">
            <div class="field">
                <label class="label">Nombre de la Calle</label>
                <div class="control">
                    <input class="input" type="text" name="nombre_calle" required placeholder="Ej: Calle Principal">
                </div>
            </div>
            <div class="field">
                <label class="label">Ubicación</label>
                <div class="control">
                    <input class="input" type="text" name="ubicacion" required placeholder="Ej: San José, Costa Rica">
                </div>
            </div>
            <div class="field">
                <label class="label">Descripción del Daño</label>
                <div class="control">
                    <textarea class="textarea" name="descripcion" required placeholder="Ej: Hueco grande cerca del cruce..."></textarea>
                </div>
            </div>
            <div class="field">
                <label class="label">Tamaño Estimado (en metros)</label>
                <div class="control">
                    <input class="input" type="number" name="tamano_estimado" required placeholder="Ej: 1.5">
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                    <button type="submit" class="button is-link">Enviar Reporte</button>
                </div>
                <div class="control">
                    <button type="reset" class="button is-link is-light">Cancelar</button>
                </div>
            </div>
        </form>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="content has-text-centered">
          <p><strong>Sistema de Reporte de Calles</strong> - Proyecto desarrollado en 2024.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
