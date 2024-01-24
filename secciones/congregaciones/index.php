<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Congregaciones</title>
    <!-- icono de la pagina -->
    <link rel="shortcut icon" href="/app/ico/icono.jpeg" type="image/x-icon">
    <style>
        /* Estilos para el banner */
        .bannerCorreos {
            background-color: #007bff; /* Color de fondo del banner */
            color: #fff; /* Color del texto en el banner */
            text-align: center; /* Alineación del texto en el centro */
            padding: 20px; /* Espaciado interno del banner */
            margin-top:40px; /* Espaciado interno del banner */
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
    include("/xampp/htdocs/app/bd.php"); // CONEXIÓN A LA BASE DE DATOS

    if(isset($_GET['txtID'])){
        $txtID = (isset($_GET['txtID'])) ? ($_GET['txtID']) : "";
        // $sentencia = $conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $mensaje = "Registro eliminado";
        header("Location:index.php?mensaje=" . $mensaje); // Redirige de nuevo al index
    }

    $sentencia = $conexion->prepare("SELECT * FROM `tbl_puestos`");
    $sentencia->execute();
    $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?>

    <br>
    <section>
        <div class="bannerCorreos">
            <!-- Contenido del banner -->
            <h1>Sistema de Congregaciones</h1>
            <p></p>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-header">
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Congregacion</a>
            </div>
            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table" id="tabla_id">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre del puesto</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_tbl_puestos as $registro) { ?>
                                <tr>
                                    <td scope="row"><?php echo $registro['id'] ?></td>
                                    <td><?php echo $registro['nombredelpuesto'] ?></td>
                                    <td>
                                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>
                                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>



<!-- 
CREATE TABLE tbl_puestos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombredelpuesto VARCHAR(255) NOT NULL
);
 -->