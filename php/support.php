<?php
// Incluir la clase para la conexión y el manejo de contactos
include_once 'Database.php';

class SupportRequest {
    private $conn;
    private $table_name = "contactos";  // La tabla en la base de datos donde se guardarán los mensajes

    public $id;
    public $nombre;
    public $email;
    public $asunto;
    public $mensaje;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Función para guardar el mensaje de soporte
    public function saveMessage() {
        // Consulta para insertar el mensaje de soporte
        $query = "INSERT INTO " . $this->table_name . " (nombre, email, asunto, mensaje) 
                  VALUES (:nombre, :email, :asunto, :mensaje)";

        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->nombre = htmlspecialchars(strip_tags($this->nombre));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->asunto = htmlspecialchars(strip_tags($this->asunto));
        $this->mensaje = htmlspecialchars(strip_tags($this->mensaje));

        // Bind datos
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":asunto", $this->asunto);
        $stmt->bindParam(":mensaje", $this->mensaje);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}

// Crear una instancia de la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear instancia de la clase SupportRequest
$supportRequest = new SupportRequest($db);

// Variable para el mensaje
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Asignar los valores recibidos del formulario a las propiedades de la clase
    $supportRequest->nombre = $_POST['nombre'];
    $supportRequest->email = $_POST['email'];
    $supportRequest->asunto = $_POST['asunto'];
    $supportRequest->mensaje = $_POST['mensaje'];

    // Intentar guardar el mensaje
    if ($supportRequest->saveMessage()) {
        $message = "<div class='alert alert-success' role='alert'>
                        <strong>¡Éxito!</strong> Tu mensaje ha sido enviado exitosamente. ¡Gracias por ponerte en contacto con nosotros!
                    </div>";
    } else {
        $message = "<div class='alert alert-danger' role='alert'>
                        <strong>Error</strong> Hubo un error al enviar el mensaje. Intenta nuevamente.
                    </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte al Ciudadano</title>
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

      .footer {
          background-color: var(--navbar-bg);
          color: var(--button-text);
          text-align: center;
          padding: 20px 0;
          font-size: 0.9rem;
          margin-top: 30px;
      }

      .form-control {
          background-color: #ffffff;
          color: var(--text-color);
          border: 1px solid var(--border-color);
          border-radius: 4px;
          padding: 10px;
          width: 100%;
      }

      .form-control:focus {
          border-color: var(--button-bg);
          box-shadow: 0 0 5px rgba(0, 102, 204, 0.5);
      }

      .select, .textarea {
          width: 100%;
          padding: 8px;
          border: 1px solid var(--border-color);
          border-radius: 4px;
      }

      .title {
          font-size: 1.8rem;
          font-weight: bold;
          color: var(--navbar-bg);
          margin-bottom: 15px;
      }

      .field {
          margin-bottom: 20px;
      }

      .label {
          font-weight: bold;
          margin-bottom: 8px;
      }

      .button {
          background-color: var(--button-bg);
          color: var(--button-text);
          padding: 10px 20px;
          border-radius: 5px;
          font-size: 1rem;
          cursor: pointer;
          transition: background-color 0.3s ease;
      }

      .button.is-light {
          background-color: #f0f0f0;
          color: var(--navbar-bg);
      }

      .button:hover {
          background-color: var(--button-hover);
      }

      .button.is-light:hover {
          background-color: #e0e0e0;
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

    <!-- Formulario de Soporte -->
    <main class="support-form my-5">
      <div class="container">
        <h1 class="title">Soporte al Ciudadano</h1>
        <p>Si tienes preguntas, problemas o necesitas ayuda sobre el sistema, contáctanos a través del siguiente formulario.</p>

        <!-- Mostrar el mensaje de éxito o error -->
        <?php echo $message; ?>

        <form action="support.php" method="POST">  <!-- Acción POST hacia 'support.php' -->
            <div class="field">
                <label class="label">Nombre Completo</label>
                <div class="control">
                  <input class="form-control" type="text" name="nombre" required placeholder="Ej: Juan Pérez">
                </div>
            </div>
            <div class="field">
                <label class="label">Correo Electrónico</label>
                <div class="control">
                  <input class="form-control" type="email" name="email" required placeholder="Ej: correo@ejemplo.com">
                </div>
            </div>
            <div class="field">
                <label class="label">Asunto</label>
                <div class="control">
                  <div class="select">
                    <select name="asunto" required>
                      <option>Problemas con el reporte</option>
                      <option>Consulta sobre reparaciones</option>
                      <option>Problemas técnicos</option>
                      <option>Otro</option>
                    </select>
                  </div>
                </div>
            </div>
            <div class="field">
                <label class="label">Mensaje</label>
                <div class="control">
                  <textarea class="textarea" name="mensaje" required placeholder="Escribe tu mensaje aquí"></textarea>
                </div>
            </div>
            <div class="field">
                <div class="control">
                  <label class="checkbox">
                    <input type="checkbox" name="terms" required>
                    Estoy de acuerdo con los <a href="#">Términos y Condiciones</a>.
                  </label>
                </div>
            </div>
            <div class="field is-grouped">
                <div class="control">
                  <button type="submit" class="button is-link">Enviar</button>
                </div>
                <div class="control">
                  <button type="reset" class="button is-link is-light">Cancelar</button>
                </div>
            </div>
        </form>
      </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="content has-text-centered">
          <p>
            <strong>Sistema de Reporte de Calles</strong> - Proyecto desarrollado en 2024 para mejorar nuestras vías públicas.
          </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
