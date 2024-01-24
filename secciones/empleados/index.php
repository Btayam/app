<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
    <!-- icono de la pagina -->
    <link rel="shortcut icon" href="/app/ico/icono.jpeg" type="image/x-icon">
    <style>
        /* Estilos para el banner */
        .bannerCorreos {
            background-color: #007bff; /* Color de fondo del banner */
            color: #fff; /* Color del texto en el banner */
            text-align: center; /* Alineación del texto en el centro */
            padding: 20px;
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
    include("/xampp/htdocs/app/bd.php"); // CONEXIÓN - BASE DE DATOS

    // Recopilación y verificación de datos + instrucción de borrado
    if (isset($_GET['txtID'])) {
        $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

        // Buscar el archivo relacionado con el empleado
        $sentencia = $conexion->prepare("SELECT foto, cv FROM `tbl_empleados` WHERE id=:id");
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);
        print_r($registro_recuperado);

        if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != " ") {
            if (file_exists("./" . $registro_recuperado["foto"])) {
                unlink("./" . $registro_recuperado["foto"]);
            }
        }

        if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != " ") {
            if (file_exists("./" . $registro_recuperado["cv"])) {
                unlink("./" . $registro_recuperado["cv"]);
            }
        }

        // Tomado del crear.php
        $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
        // Tomado del crear.php
        $sentencia->bindParam(":id", $txtID);
        $sentencia->execute();

        $mensaje = "Registro eliminado";
        header("Location:index.php?mensaje=" . $mensaje); // Redirecciona al index
    }

    $sentencia = $conexion->prepare("SELECT *,
    (SELECT nombredelpuesto
    FROM tbl_puestos
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
    FROM `tbl_empleados`"); // BD - aquí se hace una subconsulta para el ID Puesto
    $sentencia->execute();
    $lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?> <!-- CONEXIÓN - VÍNCULO -->
    <br>

    <section>
        <div class="bannerCorreos">
            <!-- Contenido del banner -->
            <h1>Sistema de Empleados</h1>
            <p></p>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-header">
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Empleado</a> <!-- CONEXIÓN - VÍNCULO -->
            </div>

            <div class="card-body">
                <div class="table-responsive-sm">
                    <table class="table" id="tabla_id">
                        <thead>
                            <tr>
                                <th scope="col">Cédula</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Foto</th>
                                <th scope="col">CV</th>
                                <th scope="col">Puesto</th>
                                <th scope="col">Fecha de ingreso</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($lista_tbl_empleados as $registro) { ?>
                                <tr class="">
                                    <td><?php echo $registro['id'] ?></td>
                                    <td scope="row">
                                        <?php echo $registro['primernombre'] ?>
                                        <?php echo $registro['segundonombre'] ?>
                                        <?php echo $registro['primerapellido'] ?>
                                        <?php echo $registro['segundoapellido'] ?>
                                    </td>
                                    <td>
                                        <img width="50" src="<?php echo $registro['foto'] ?>" class="img-fluid rounded" alt="">
                                    </td>
                                    <td>
                                        <a href="<?php echo $registro['cv'] ?>">
                                            <?php echo $registro['cv'] ?>
                                        </a>
                                    </td>
                                    <td><?php echo $registro['puesto'] ?></td><!--El (idpuesto) se cambia por (puesto) por el alias o subconsulta arriba definida-->
                                    <td><?php echo $registro['fechadeingreso'] ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="carta.php?txtID=<?php echo $registro['id'] ?>" role="button">Carta</a> <!-- CONEXIÓN - VÍNCULO -->
                                        <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>
                                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id'] ?>);" role="button">Eliminar</a>
                                    </td>
                                </tr>
                            <?php } ?> <!-- BD- CICLO -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    
    <?php include("/xampp/htdocs/app/templates/footer.php"); ?> <!-- CONEXIÓN - VÍNCULO -->
</body>
</html>
