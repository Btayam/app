<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Terceros</title>
    <!-- icono de la pagina -->
    <link rel="shortcut icon" href="icono.jpeg" type="image/x-icon">
    <style>
        /* Estilos para el bannerTerceros */
        .bannerTerceros {
            background-color: #007bff;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        /* Estilos para la tabla */
        .table-container {
            overflow-x: auto;
        }
        .table {
            max-width: 100%; /* Ancho máximo de la tabla */
        }
        .table th, .table td {
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            max-width: 150px;
        }
        .table th:last-child, .table td:last-child {
            width: 150px; /* Ancho fijo para la última columna */
            white-space: normal; /* Permitir que el contenido se ajuste */
        }
        .table th:nth-child(-n+17), .table td:nth-child(-n+17) {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 2;
        }
        .acciones-th {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 2;
        }
        .acciones-td {
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 2;
        }
    </style>
</head>
<body>
    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>
    <section>
        <div class="bannerTerceros">
            <!-- Contenido del bannerTerceros -->
            <h1>Sistema de Terceros</h1>
            <p></p>
        </div>
    </section>

    <section>
        <?php
        include("/xampp/htdocs/app/bd.php"); // Incluir el archivo de conexión a la base de datos

        // Recolección y verificación de datos + instrucción de borrado
        if (isset($_GET['txtID'])) {
            $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : ""; // Validación y asignación del ID
            $sentencia = $conexion->prepare("DELETE FROM tbl_terceros WHERE COD_TER=:COD_TER"); // Preparar la instrucción de borrado
            $sentencia->bindParam(":COD_TER", $txtID); // Vincular el ID
            $sentencia->execute(); // Ejecutar la instrucción de borrado
            $mensaje = "Registro eliminado";
            header("Location: index.php?mensaje=" . $mensaje); // Redirigir de vuelta al index
        }

        $sentencia = $conexion->prepare("SELECT * FROM `tbl_terceros`"); // Preparar la consulta a la base de datos
        $sentencia->execute(); // Ejecutar la consulta
        $lista_tbl_terceros = $sentencia->fetchAll(PDO::FETCH_ASSOC); // Obtener los registros
        ?>

        <!-- Contenido principal del sistema -->
        <div class="card">
            <div class="card-header">
                <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Tercero</a>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table class="table" id="tabla_id">
                        <thead>
                            <tr>
                                <th scope="col">COD_TER</th>
                                <th scope="col">NOM_TER</th>
                                <th scope="col">DIR</th>
                                <th scope="col">TEL</th>
                                <th scope="col">CEL</th>
                                <th scope="col">EMAIL</th>
                                <th scope="col">COD_DIST</th>
                                <th scope="col">COD_CONGREGACION</th>
                                <th scope="col">NOM_CONGREGACION</th>
                                <th scope="col">FECHA_NACIMIENTO</th>
                                <th scope="col">FEC_ING_SIA</th>
                                <th scope="col">FEC_MINIS_SIA</th>
                                <th scope="col">FEC_APORT_SIA</th>
                                <th scope="col">Fecha_Ini_Ministerio</th>
                                <th scope="col">Fecha_Encuesta</th>
                                <th scope="col">FECHAPARA_CALCULO</th>
                                <th scope="col">ANIOS_MINISTERIO</th>
                                <th scope="col" class="acciones-th">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lista_tbl_terceros as $registro) { ?>
                                <tr class="fila-compacta" data-id="<?php echo $registro['COD_TER']; ?>">
                                    <td title="<?php echo $registro['COD_TER']; ?>"><?php echo $registro['COD_TER']; ?></td>
                                    <td title="<?php echo $registro['NOM_TER']; ?>"><?php echo $registro['NOM_TER']; ?></td>
                                    <td title="<?php echo $registro['DIR']; ?>"><?php echo $registro['DIR']; ?></td>
                                    <td title="<?php echo $registro['TEL']; ?>"><?php echo $registro['TEL']; ?></td>
                                    <td title="<?php echo $registro['CEL']; ?>"><?php echo $registro['CEL']; ?></td>
                                    <td title="<?php echo $registro['EMAIL']; ?>"><?php echo $registro['EMAIL']; ?></td>
                                    <td title="<?php echo $registro['COD_DIST']; ?>"><?php echo $registro['COD_DIST']; ?></td>
                                    <td title="<?php echo $registro['COD_CONGREGACION']; ?>"><?php echo $registro['COD_CONGREGACION']; ?></td>
                                    <td title="<?php echo $registro['NOM_CONGREGACION']; ?>"><?php echo $registro['NOM_CONGREGACION']; ?></td>
                                    <td title="<?php echo $registro['FECHA_NACIMIENTO']; ?>"><?php echo $registro['FECHA_NACIMIENTO']; ?></td>
                                    <td title="<?php echo $registro['FEC_ING_SIA']; ?>"><?php echo $registro['FEC_ING_SIA']; ?></td>
                                    <td title="<?php echo $registro['FEC_MINIS_SIA']; ?>"><?php echo $registro['FEC_MINIS_SIA']; ?></td>
                                    <td title="<?php echo $registro['FEC_APORT_SIA']; ?>"><?php echo $registro['FEC_APORT_SIA']; ?></td>
                                    <td title="<?php echo $registro['Fecha_Ini_Ministerio']; ?>"><?php echo $registro['Fecha_Ini_Ministerio']; ?></td>
                                    <td title="<?php echo $registro['Fecha_Encuesta']; ?>"><?php echo $registro['Fecha_Encuesta']; ?></td>
                                    <td title="<?php echo $registro['FECHAPARA_CALCULO']; ?>"><?php echo $registro['FECHAPARA_CALCULO']; ?></td>
                                    <td title="<?php echo $registro['ANIOS_MINISTERIO']; ?>"><?php echo $registro['ANIOS_MINISTERIO']; ?></td>
                                    <td class="acciones-td">
                                        <div class="btn-group" role="group">
                                            <a class="btn btn-info btn-sm" href="editar.php?txtID=<?php echo $registro['COD_TER']; ?>" role="button">Editar</a>
                                            <a class="btn btn-danger btn-sm" href="javascript:borrar(<?php echo $registro['COD_TER']; ?>);" role="button">Eliminar</a>
                                            <a class="btn btn-success btn-sm" href="javascript:verContraseña(<?php echo $registro['COD_TER']; ?>);" role="button">Carta</a>
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

    <!-- <script>
    </script> -->

    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>






<!-- 
CREATE TABLE tbl_terceros (
    COD_TER INT PRIMARY KEY,
    NOM_TER VARCHAR(255),
    DIR VARCHAR(255),
    TEL VARCHAR(20),
    CEL VARCHAR(20),
    EMAIL VARCHAR(255),
    COD_DIST INT,
    COD_CONGREGACION INT,
    NOM_CONGREGACION VARCHAR(255),
    FECHA_NACIMIENTO DATE,
    FEC_ING_SIA DATE,
    FEC_MINIS_SIA DATE,
    FEC_APORT_SIA DATE,
    Fecha_Ini_Ministerio DATE,
    Fecha_Encuesta DATE,
    FECHAPARA_CALCULO DATE,
    ANIOS_MINISTERIO INT
);
 -->




<!-- TRASLADOS
INSERT INTO app.tbl_terceros
SELECT * FROM terceros.congregaciones; 
-->

<!-- RESTABLECIMIENTO
TRUNCATE TABLE app.tbl_terceros; 
-->
