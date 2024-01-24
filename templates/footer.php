<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>footer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css"
        integrity="sha384-DPfg5+c4TIUyfZHz3BXYUjKICrA63vTevW0CEn13cKp6ItcNQoLVLuof1j7TukzE"
        crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.css">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.min.css">
    
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh; /* Asegura que el contenido ocupe al menos el 100% de la altura de la ventana */
            position: relative;
        }
        /* Footer */
        /* ------ */
        .footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background-color: #007bff; /* Color de fondo del footer */
            color: #fff; /* Color del texto del footer */
            padding: 20px 0; /* Espaciado interior del footer */
        }
        /* Contenedor centrado en la parte inferior */
        /* ---------------------------------------- */
        .contenedorf {
            background-color: #007bff; /* Color de fondo del contenedor */
            color: #fff; /* Color del texto del contenedor */
            padding: 10px; /* Espaciado interior del contenedor */
            /* position: fixed; Fija el contenedor en la parte inferior */
            bottom: 0; /* Lo coloca en la parte inferior de la ventana */
            left: 0; /* Lo coloca al borde izquierdo */
            right: 0; /* Lo coloca al borde derecho */
            text-align: center; /* Centra el contenido horizontal y verticalmente */
            background-position: center center; /* Centra el fondo del contenedor */
        }
    </style>
</head>
<body>
    <main>
        <!-- El inicio lo encontramos en (header.php) -->
    </main>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
        integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.js"></script>

    <!-- SweetAlert2 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.1/dist/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#tabla_id").DataTable({
                "pageLength": 4,
                lengthMenu: [
                    [4, 5, 25, 50, 75, 100],
                    [4, 5, 25, 50, 75, 100]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.13.1/i18n/es-ES.json"
                }
            });
        });
    </script>

    <script>
        function borrar(id) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, elimínalo!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "index.php?txtID=" + id;
                    Swal.fire(
                        '¡Borrado!',
                        'El registro se ha eliminado.',
                        'success'
                    )
                }
            });
        }
    </script>
    <br><br>
    <!-- Footer -->
    <footer>
        <div class="contenedorf">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; <?php echo date('Y'); ?> Corpentunida. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
