<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tu Título Aquí</title>
    <style>
        /* Estilos para el banner */
        .bannerUsuarios{
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
    include("/xampp/htdocs/app/bd.php"); // CONEXIÓN - BASE DE DATOS

    // Recolección y verificación de datos + instrucción de borrado
    if (isset($_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? ($_GET['txtID']) : ""; // Validación si - recogida del ID
        $sentencia = $conexion->prepare("DELETE FROM tbl_usuarios WHERE id=:id"); // Tomado del crear.php - Instrucción de borrado
        $sentencia->bindParam(":id", $txtID); // Tomado del crear.php - Instrucción de borrado
        $sentencia->execute(); // Instrucción de borrado
        $mensaje = "Registro eliminado";
        header("Location:index.php?mensaje=" . $mensaje); // Nos redirige al index
    }

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_usuarios`"); // BD
    $sentencia->execute(); // Ejecuta los registros
    $lista_tbl_usuarios = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>
    <section>
        <div class="bannerUsuarios">
            <!-- Contenido del banner -->
            <h1>Sistema de Usuarios</h1>
            <p></p>
        </div>
    </section>

    <section class="card">
        <div class="card-header">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Usuario</a>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table" id="tabla_id">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre del usuario</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_tbl_usuarios as $registro) { ?>
                            <tr>
                                <td scope="row"> <?php echo $registro['id']; ?> </td>
                                <td> <?php echo $registro['usuario']; ?> </td>
                                <td>*********</td>
                                <td> <?php echo $registro['correo']; ?> </td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']; ?>" role="button">Editar</a>
                                    <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>



<!-- 
CREATE TABLE tbl_usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL,
    correo VARCHAR(255) NOT NULL
);
 -->