<?php 
session_start();

// Comprobar si se envió el formulario de inicio de sesión
if ($_POST) {
    include("./bd.php");

    // Preparar la consulta SQL
    $sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios` WHERE usuario=:usuario AND contrasena=:contrasena");

    // Obtener los datos del formulario
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    // Asignar los valores a los parámetros de la consulta
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":contrasena", $contrasena);

    // Ejecutar la consulta
    $sentencia->execute();

    // Verificar si se encontró un usuario válido
    if ($sentencia->rowCount() > 0) {
        // Establecer las variables de sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['logueado'] = true;

        // Redirigir al usuario a la página principal
        header("Location: index.php");
    } else {
        // Mostrar un mensaje de error
        $mensaje = "Error: El usuario o contraseña son incorrectos";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  
  <style>
    /* Estilos CSS personalizados */
    body {
      padding-top: 40px;
      padding-bottom: 40px;
      background-color: #f5f5f5;
    }

    .form-signin {
      max-width: 330px;
      padding: 15px;
      margin: 0 auto;
      animation: slide-up 0.5s ease;
    }

    .form-signin .form-signin-heading,
    .form-signin .checkbox {
      margin-bottom: 10px;
    }

    .form-signin .checkbox {
      font-weight: normal;
    }

    .form-signin .form-control {
      position: relative;
      height: auto;
      -webkit-box-sizing: border-box;
      -moz-box-sizing: border-box;
      box-sizing: border-box;
      padding: 10px;
      font-size: 16px;
    }

    .form-signin .form-control:focus {
      z-index: 2;
    }

    .form-signin input[type="text"] {
      margin-bottom: -1px;
      border-bottom-left-radius: 0;
      border-bottom-right-radius: 0;
    }

    .form-signin input[type="password"] {
      margin-bottom: 10px;
      border-top-left-radius: 0;
      border-top-right-radius: 0;
    }

    /* Animación de deslizamiento hacia arriba */
    @keyframes slide-up {
      0% {
        opacity: 0;
        transform: translateY(10px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>

</head>

<body>
  <header>
    <!-- Aquí se coloca la barra de navegación -->
  </header>

  <main class="container">
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
            <br>
            <div class="card">
                <div class="card-header">
                    Login
                </div>
                <div class="card-body">

                  <?php if (isset($mensaje)) { ?>
                    <div class="alert alert-danger" role="alert">
                      <strong><?php echo $mensaje; ?></strong>
                    </div>
                  <?php } ?>
                  
                    <form action="" method="post" class="form-signin">

                        <div class="mb-3">
                          <label for="usuario" class="form-label">Usuario:</label>
                          <input type="text"
                            class="form-control" name="usuario" id="usuario" placeholder="Escriba su usuario">
                        </div>

                        <div class="mb-3">
                          <label for="contrasena" class="form-label">Contraseña:</label>
                          <input type="password"
                            class="form-control" name="contrasena" id="contrasena" aria-describedby="helpId" placeholder="Escriba su contraseña ">
                        </div>

                        <button type="submit" class="btn btn-primary">Entrar al sistema</button>
                                            
                    </form>
                </div>
            </div>
        </div>
    </div>
  </main>

  <footer>
    <!-- Aquí se coloca el pie de página -->
  </footer>
  <!-- Bibliotecas de JavaScript de Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <script>
    // Añadir animación a la tarjeta de login al cargar la página
    document.addEventListener('DOMContentLoaded', function() {
      const card = document.querySelector('.card');
      card.style.opacity = '0';
      card.style.transform = 'translateY(10px)';

      setTimeout(function() {
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
      }, 300);
    });
  </script>
</body>

</html>
