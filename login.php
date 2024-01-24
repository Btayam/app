<!DOCTYPE html>
<html lang="en">

<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Incluye la hoja de estilo de Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <!-- Incluye la hoja de estilo personalizada -->
  <link rel="stylesheet" href="login1.css">
</head>

<body>
  <!-- Encabezado de la página -->
  <header class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <br>
        <div class="card">
          <div class="card-header">
            SISTEMA BASE DE DATOS - CORPENTUNIDA
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Contenido principal -->
  <main class="container">
    <div class="row">
      <div class="col-md-4"></div>
      <div class="col-md-4">
        <br>
        <div class="card">
          <div class="card-header">
            Login
          </div>
          <div class="card-body">

            <?php
            // Inicia la sesión PHP
            session_start();

            // Verifica si el formulario ha sido enviado
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              // Incluye el archivo de conexión a la base de datos
              include("./bd.php");

              // Filtra y obtiene los datos del formulario
              $usuario = filter_var($_POST["usuario"], FILTER_SANITIZE_STRING);
              $password = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

              try {
                // Consulta SQL para verificar el usuario y contraseña
                $sql = "SELECT * FROM tbl_usuarios WHERE usuario = :usuario AND password = :password";
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(":usuario", $usuario, PDO::PARAM_STR);
                $stmt->bindParam(":password", $password, PDO::PARAM_STR);
                $stmt->execute();

                // Obtiene el resultado de la consulta
                $result = $stmt->fetch(PDO::FETCH_ASSOC);

                // Verifica si se encontró un usuario válido
                if ($result) {
                  $_SESSION['usuario'] = $usuario;
                  $_SESSION['logueado'] = true;
                  header("Location: index.php");
                  exit();
                } else {
                  $mensaje = "Error: El usuario o contraseña son incorrectos";
                }
              } catch (PDOException $e) {
                $mensaje = "Error en la consulta: " . $e->getMessage();
              } finally {
                $stmt = null; // Libera el statement
              }

              $conexion = null; // Cierra la conexión a la base de datos
            }
            ?>

            <?php if (isset($mensaje)) { ?>
              <!-- Muestra un mensaje de error si existe -->
              <div class="alert alert-danger" role="alert">
                <strong><?php echo $mensaje; ?></strong>
              </div>
            <?php } ?>

            <!-- Formulario de inicio de sesión -->
            <form action="" method="post" class="form-signin">
              <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Escriba su usuario">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Escriba su contraseña">
              </div>
              <button type="submit" class="btn btn-primary">Entrar al sistema</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- Pie de página -->
  
  <footer>
    <!-- Aquí se coloca el pie de página -->
  </footer>

  <!-- Scripts de Bootstrap y animación -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <!-- Script para la animación de la tarjeta -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Selecciona la tarjeta por su clase 'card'
      const card = document.querySelector('.card');

      // Configura la opacidad y la posición inicial de la tarjeta
      card.style.opacity = '0';
      card.style.transform = 'translateY(10px)';

      // Establece un temporizador para aplicar la animación después de 300 milisegundos (0.3 segundos)
      setTimeout(function () {
        // Ajusta la opacidad y la posición final de la tarjeta para lograr la animación
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }, 300);
    });
  </script>

</body>

</html>
