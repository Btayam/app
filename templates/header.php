<?php
// Inicia una sesión
session_start();

// URL base para evitar errores de URL
$url_base = "http://192.168.10.140/app";

// Redirige al usuario a la página de inicio de sesión si no está logeado
if (!isset($_SESSION['usuario'])) {
    header("Location: $url_base/login.php");
    exit; // Asegura que el script termine después de la redirección
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Título</title>
    <!-- Icono de la página -->
    <link rel="shortcut icon" href="http://192.168.10.140/app/icono.jpeg" type="image/x-icon">
    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.js"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        /* Estilo para centrar el menú en la parte superior */
        .navbar {
            display: flex;
            justify-content: center;
        }

        /* Estilo para el botón activo (resaltado en azul) */
        .nav-item.active .nav-link {
            background-color: blue;
            color: white;
        }

        /* Estilo para agregar sombra al botón al pasar el mouse */
        .nav-item .nav-link:hover {
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.5);
            color: #007bff;
        }
        .bannerHeader {
            position: fixed; /* Banner fijo en la parte superior */
            top: 0; /* Fijar en la parte superior de la ventana */
            background-color: #007bff; /* Color de fondo del banner */
            color: #ffffff; /* Color del texto del banner (azul) */
            padding: 0px; /* Espaciado interior del banner (ajusta según tus necesidades) */
            text-align: center; /* Centra el contenido horizontalmente */
            width: 100%; /* Ocupa todo el ancho de la página */
        }

        /* Estilo para la imagen del encabezado */
        .logo-img {
            float: left; /* Hace que la imagen quede a la izquierda */
            max-width: 100px; /* Ancho máximo de la imagen */
            height: auto; /* Altura ajustada automáticamente para mantener las proporciones */
        }
    </style>
</head>
<body>
    <div class="bannerHeader"><p>-</p></div>
    <header>
        <div class="bannerHeader">
            <img src="http://192.168.10.140/app/logo.png" alt="Logo de la empresa" class="logo-img">
        </div>
        <!-- Barra de navegación -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index.php') ? 'active' : ''; ?>" href="<?php echo $url_base ?>/index.php">Sistema</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (in_array(basename($_SERVER['PHP_SELF']), array('empleados', 'index.php'))) ? 'active' : ''; ?>" href="<?php echo $url_base ?>/secciones/empleados/index.php">Empleados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (in_array(basename($_SERVER['PHP_SELF']), array('puestos', 'index.php'))) ? 'active' : ''; ?>" href="<?php echo $url_base ?>/secciones/puestos/index.php">Puestos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (in_array(basename($_SERVER['PHP_SELF']), array('usuarios', 'index.php'))) ? 'active' : ''; ?>" href="<?php echo $url_base ?>/secciones/usuarios/index.php">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (in_array(basename($_SERVER['PHP_SELF']), array('correos', 'index.php'))) ? 'active' : ''; ?>" href="<?php echo $url_base ?>/secciones/correos/index.php">Correos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo (in_array(basename($_SERVER['PHP_SELF']), array('terceros', 'index.php'))) ? 'active' : ''; ?>" href="<?php echo $url_base ?>/secciones/terceros/index.php">Terceros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $url_base ?>/cerrar.php">Cerrar sesión</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container">
        <?php if (isset($_GET['mensaje'])) { ?> <!-- Comprueba si existe la variable GET 'mensaje' -->
            <script>
                // Muestra una alerta de éxito con el mensaje recibido
                Swal.fire({
                    icon: "success",
                    title: "<?php echo $_GET['mensaje']; ?>"
                });
            </script>
        <?php } ?>
        <!-- Aquí puedes agregar el contenido adicional del cuerpo de la página -->
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u9JFkjWQN4tzah9JRYR9icFvuVznCg1sXyPzlwqnPK3ZYs9cH1zOJK1A5Ai9MScG" crossorigin="anonymous"></script>

    <!-- Scripts personalizados -->
    <!-- Agrega tus scripts personalizados aquí -->
</body>
</html>
