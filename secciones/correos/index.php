<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Correos</title>
    <!-- icono de la pagina -->
    <link rel="shortcut icon" href="http://192.168.10.140/app/icono.jpeg" type="image/x-icon">
    <style>
        /* Estilos para el banner */
        .bannerCorreos {
            background-color: #007bff; /* Color de fondo del banner */
            color: #fff; /* Color del texto en el banner */
            text-align: center; /* Alineación del texto en el centro */
            padding: 20px; /* Espaciado interno del banner */
        }

        /* Estilos para la tabla */
        .table {
            max-width: 100%; /* Ancho máximo de la tabla */
        }
        .table th, .table td {
            white-space: nowrap; /* No permitir saltos de línea en celdas */
            text-overflow: ellipsis; /* Agregar puntos suspensivos si el contenido es demasiado largo */
            overflow: hidden; /* Ocultar el contenido que desborda la celda */
            max-width: 150px; /* Ancho máximo de celdas */
        }
        .table th:last-child, .table td:last-child {
            width: 150px; /* Ancho fijo para la última columna */
            white-space: normal; /* Permitir que el contenido se ajuste verticalmente */
        }
        .table th:nth-child(-n+17), .table td:nth-child(-n+17) {
            position: sticky; /* Hacer que las primeras 17 columnas se mantengan pegadas en la parte superior */
            top: 0;
            background-color: white; /* Fondo blanco para las celdas pegadas */
            z-index: 2;
        }

        /* Estilos para las acciones en la tabla */
        .acciones-th {
            position: sticky; /* Hacer que la columna de acciones se mantenga pegada en la parte superior */
            top: 0;
            background-color: white; /* Fondo blanco para la celda pegada */
            z-index: 2;
        }
        .acciones-td {
            position: sticky; /* Hacer que las celdas de acciones se mantengan pegadas en la parte superior */
            top: 0;
            background-color: white; /* Fondo blanco para las celdas pegadas */
            z-index: 2;
        }

    </style>
</head>
<body>
    <?php
    include("/xampp/htdocs/app/bd.php"); // Incluir el archivo de conexión a la base de datos

    // Recolección y verificación de datos + instrucción de borrado
    if(isset($_GET['txtID'])){
        $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : ""; // Validación si - dirección del ID
        $sentencia = $conexion->prepare("DELETE FROM tbl_correos WHERE id=:id"); // Preparar la instrucción de borrado
        $sentencia->bindParam(":id", $txtID); // Vincular el ID
        $sentencia->execute(); // Ejecutar la instrucción de borrado
        $mensaje = "Registro eliminado";
        header("Location: index.php?mensaje=".$mensaje); // Redirigir de vuelta al index
    }

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_correos`"); // Preparar la consulta a la base de datos
    $sentencia->execute(); // Ejecutar la consulta
    $lista_tbl_correos = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Obtener los registros
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>

    <section>
        <div class="bannerCorreos">
            <!-- Contenido del banner -->
            <h1>Sistema de Correos</h1>
            <p></p>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-header">
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar correo</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table" id="tabla_id">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Contraseña</th>
                                <th scope="col">Observación</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Correo de Recuperación</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($lista_tbl_correos as $registro) { ?>
                            <tr class="fila-compacta" data-id="<?php echo $registro['id']; ?>">
                                <td scope="row"> <?php echo $registro['id']; ?> </td>
                                <td title="<?php echo $registro['correo']; ?>" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; max-width: 150px;"> <?php echo $registro['correo']; ?> </td>
                                <td title="<?php echo $registro['contrase']; ?>" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; max-width: 150px;">
                                    <input type="password" class="password-field" value="<?php echo $registro['contrase']; ?>" disabled>
                                </td>
                                <td title="<?php echo $registro['observacion']; ?>" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; max-width: 150px;"> <?php echo $registro['observacion']; ?> </td>
                                <td title="<?php echo $registro['celular']; ?>" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; max-width: 150px;"> <?php echo $registro['celular']; ?> </td>
                                <td title="<?php echo $registro['recuperacion']; ?>" style="white-space: nowrap; text-overflow: ellipsis; overflow: hidden; max-width: 150px;"> <?php echo $registro['recuperacion']; ?> </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a class="btn btn-info btn-sm" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                                        <a class="btn btn-danger btn-sm" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                                        <a class="btn btn-success btn-sm" href="javascript:verContraseña(<?php echo $registro['id']; ?>);" role="button">Ver</a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script>
        function verContraseña(id) {
            var passwordField = document.querySelector("tr[data-id='" + id + "'] .password-field");
            passwordField.type = passwordField.type === "password" ? "text" : "password";
        }
    </script>

    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>




<!-- 
CREATE TABLE tbl_correos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    correo VARCHAR(255),
    contrase VARCHAR(255),
    observacion TEXT,
    celular VARCHAR(255),
    recuperacion VARCHAR(255)
);
 -->