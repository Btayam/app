<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Sistema</title>
    <link rel="shortcut icon" href="icono.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style_01.css">
</head>

<body>
    <?php include("templates/header.php"); ?>

    <div class="contenedor"> 
        <div class="header">
            <h1 class="custom-heading">Bienvenido al Sistema</h1>
            <p class="custom-text">"La plataforma de trabajo eficiente y segura desarrollada por Corpentunida."</p>
        </div>

        <div class="main-content">
            <h2 class="custom-heading">Hola, <?php echo $_SESSION['usuario']; ?>.</h2>
            <p class="custom-text">Bienvenido al sistema. Estamos aquí para ayudarte en tus tareas diarias.</p>
            <a href="secciones/terceros/index.php" class="btn btn-primary">Ir al Inicio</a>
        </div>

        <section class="recomendaciones">
            <h3 class="custom-heading">Recomendaciones</h3>
            <div class="recomendacion-item">
                <h4>1. Mantén tus datos seguros</h4>
                <p>Protege tu información de acceso y no compartas contraseñas con nadie.</p>
            </div>
            <div class="recomendacion-item">
                <h4>2. Actualiza tus contraseñas regularmente</h4>
                <p>Cambia tus contraseñas periódicamente para garantizar la seguridad de tu cuenta.</p>
            </div>
            <div class="recomendacion-item">
                <h4>3. Contacta al soporte técnico</h4>
                <p>Si necesitas ayuda o tienes problemas, no dudes en contactar a nuestro equipo de soporte técnico.</p>
            </div>
        </section>
    </div>

    <?php include("templates/footer.php"); ?>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".recomendaciones").fadeIn(1000);
        });
    </script>
</body>

</html>

