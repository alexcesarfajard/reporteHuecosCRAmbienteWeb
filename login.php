<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Reporte de Calles</title>
    <link rel="stylesheet" href="css/estilos.css">
    <style>
      :root {
            --background-color: #f9f9f9;
            --text-color: #333;
            --navbar-bg: #004080;
            --button-bg: #0066cc;
            --button-text: #ffffff;
            --button-hover: #005bb5;
            --border-color: #d1d1d1;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: "Segoe UI", Tahoma, sans-serif;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: var(--navbar-bg);
            padding: 10px;
        }

        .navbar a {
            color: var(--button-text);
            text-decoration: none;
            margin-right: 20px;
        }

        .container {
            margin: 20px auto;
            max-width: 1200px;
        }

        .title {
            color: var(--navbar-bg);
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

      .footer {
          background-color: var(--navbar-bg);
          color: var(--button-text);
          text-align: center;
          padding: 20px 0;
          font-size: 0.9rem;
          margin-top: 30px;
      }

      .container {
          padding: 20px;
      }

      .tituloIndex {
          font-size: 2rem;
          font-weight: bold;
          color: var(--navbar-bg);
      }

      .parrafoIndex {
          font-size: 1.2rem;
          color: var(--text-color);
      }
    </style>
  </head>
  <body>
    <!-- Navbar -->
    <section class="navbar">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
              <a class="navbar-brand" href="index.html">Reporte de Calles</a> <!-- Redirigir al index.html -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item"><a class="nav-link active" href="report_issue.html">Reportar Calle</a></li>
                  <li class="nav-item"><a class="nav-link" href="repairs_in_progress.html">Reparaciones en Progreso</a></li>
                  <li class="nav-item"><a class="nav-link" href="contact_support.html">Soporte</a></li>
                  <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                </ul>
              </div>
            </div>
          </nav>
    </section>

    <!-- Contenido Principal -->
    <main>
    <form method="post" action="/procesar_login.php">
            <label>Usuario:</label><br>
            <input type="text" name="username" id="username"><br>
            <label>Clave:</label><br>
            <input type="password" name="password" id="password"><br>
            <button type="submit">Iniciar sesion</button>
        </form>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="content has-text-centered">
          <p><strong>Sistema de Reporte de Calles</strong> desarrollado en 2024.</p>
        </div>
    </footer>

    <!-- Script -->
    <script src="js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
