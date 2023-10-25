<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Tercero</title>
    <link rel="stylesheet" href="styles.css"> <!-- Agrega tu archivo de estilos CSS si es necesario -->
</head>
<body>
    <?php
    include("/xampp/htdocs/app/bd.php"); // CONEXION - BASE DE DATOS

    // crear y agregar tercero
    if ($_POST) {
        $COD_TER = isset($_POST["COD_TER"]) ? $_POST["COD_TER"] : "";
        $NOM_TER = isset($_POST["NOM_TER"]) ? $_POST["NOM_TER"] : "";
        $DIR = isset($_POST["DIR"]) ? $_POST["DIR"] : "";
        $TEL = isset($_POST["TEL"]) ? $_POST["TEL"] : "";
        $CEL = isset($_POST["CEL"]) ? $_POST["CEL"] : "";
        $EMAIL = isset($_POST["EMAIL"]) ? $_POST["EMAIL"] : "";
        $COD_DIST = isset($_POST["COD_DIST"]) ? $_POST["COD_DIST"] : "";
        $COD_CONGREGACION = isset($_POST["COD_CONGREGACION"]) ? $_POST["COD_CONGREGACION"] : "";
        $NOM_CONGREGACION = isset($_POST["NOM_CONGREGACION"]) ? $_POST["NOM_CONGREGACION"] : "";
        $FECHA_NACIMIENTO = isset($_POST["FECHA_NACIMIENTO"]) ? $_POST["FECHA_NACIMIENTO"] : "";
        $FEC_ING_SIA = isset($_POST["FEC_ING_SIA"]) ? $_POST["FEC_ING_SIA"] : "";
        $FEC_MINIS_SIA = isset($_POST["FEC_MINIS_SIA"]) ? $_POST["FEC_MINIS_SIA"] : "";
        $FEC_APORT_SIA = isset($_POST["FEC_APORT_SIA"]) ? $_POST["FEC_APORT_SIA"] : "";
        $Fecha_Ini_Ministerio = isset($_POST["Fecha_Ini_Ministerio"]) ? $_POST["Fecha_Ini_Ministerio"] : "";
        $Fecha_Encuesta = isset($_POST["Fecha_Encuesta"]) ? $_POST["Fecha_Encuesta"] : "";
        $FECHAPARA_CALCULO = isset($_POST["FECHAPARA_CALCULO"]) ? $_POST["FECHAPARA_CALCULO"] : "";
        $ANIOS_MINISTERIO = isset($_POST["ANIOS_MINISTERIO"]) ? $_POST["ANIOS_MINISTERIO"] : "";

        // Preparar la inserción de los datos
        $sentencia = $conexion->prepare("INSERT INTO tbl_terceros (COD_TER, NOM_TER, DIR, TEL, CEL, EMAIL, COD_DIST, COD_CONGREGACION, NOM_CONGREGACION, FECHA_NACIMIENTO, FEC_ING_SIA, FEC_MINIS_SIA, FEC_APORT_SIA, Fecha_Ini_Ministerio, Fecha_Encuesta, FECHAPARA_CALCULO, ANIOS_MINISTERIO)
        VALUES (:COD_TER, :NOM_TER, :DIR, :TEL, :CEL, :EMAIL, :COD_DIST, :COD_CONGREGACION, :NOM_CONGREGACION, :FECHA_NACIMIENTO, :FEC_ING_SIA, :FEC_MINIS_SIA, :FEC_APORT_SIA, :Fecha_Ini_Ministerio, :Fecha_Encuesta, :FECHAPARA_CALCULO, :ANIOS_MINISTERIO)");

        // Asignar los valores que vienen del método POST a los marcadores de posición en la consulta SQL
        $sentencia->bindParam(":COD_TER", $COD_TER);
        $sentencia->bindParam(":NOM_TER", $NOM_TER);
        $sentencia->bindParam(":DIR", $DIR);
        $sentencia->bindParam(":TEL", $TEL);
        $sentencia->bindParam(":CEL", $CEL);
        $sentencia->bindParam(":EMAIL", $EMAIL);
        $sentencia->bindParam(":COD_DIST", $COD_DIST);
        $sentencia->bindParam(":COD_CONGREGACION", $COD_CONGREGACION);
        $sentencia->bindParam(":NOM_CONGREGACION", $NOM_CONGREGACION);
        $sentencia->bindParam(":FECHA_NACIMIENTO", $FECHA_NACIMIENTO);
        $sentencia->bindParam(":FEC_ING_SIA", $FEC_ING_SIA);
        $sentencia->bindParam(":FEC_MINIS_SIA", $FEC_MINIS_SIA);
        $sentencia->bindParam(":FEC_APORT_SIA", $FEC_APORT_SIA);
        $sentencia->bindParam(":Fecha_Ini_Ministerio", $Fecha_Ini_Ministerio);
        $sentencia->bindParam(":Fecha_Encuesta", $Fecha_Encuesta);
        $sentencia->bindParam(":FECHAPARA_CALCULO", $FECHAPARA_CALCULO);
        $sentencia->bindParam(":ANIOS_MINISTERIO", $ANIOS_MINISTERIO);

        $sentencia->execute(); // Ejecutar la consulta preparada para insertar los datos en la base de datos

        $mensaje = "Registro agregado";
        header("Location: index.php?mensaje=" . $mensaje); // Redirigir al archivo index.php con un mensaje de éxito en la URL
    }
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>
    <div class="card">
        <div class="card-header">
            Datos del Tercero
        </div>
        <div class="card-body">
            <!-- Formulario de creación -->
            <form action="" method="post">
                <!-- Campo COD_TER -->
                <div class="mb-3">
                    <label for="COD_TER" class="form-label">Código del Tercero:</label>
                    <input type="text" class="form-control" name="COD_TER" id="COD_TER" placeholder="Ingrese el código del tercero">
                </div>

                <!-- Campo NOM_TER -->
                <div class="mb-3">
                    <label for="NOM_TER" class="form-label">Nombre del Tercero:</label>
                    <input type="text" class="form-control" name="NOM_TER" id="NOM_TER" placeholder="Ingrese el nombre del tercero">
                </div>

                <!-- Campo DIR -->
                <div class="mb-3">
                    <label for="DIR" class="form-label">Dirección:</label>
                    <input type="text" class="form-control" name="DIR" id="DIR" placeholder="Ingrese la dirección">
                </div>

                <!-- Campo TEL -->
                <div class="mb-3">
                    <label for="TEL" class="form-label">Teléfono:</label>
                    <input type="text" class="form-control" name="TEL" id="TEL" placeholder="Ingrese el teléfono">
                </div>

                <!-- Campo CEL -->
                <div class="mb-3">
                    <label for="CEL" class="form-label">Celular:</label>
                    <input type="text" class="form-control" name="CEL" id="CEL" placeholder="Ingrese el celular">
                </div>

                <!-- Campo EMAIL -->
                <div class="mb-3">
                    <label for="EMAIL" class="form-label">Correo Electrónico:</label>
                    <input type="email" class="form-control" name="EMAIL" id="EMAIL" placeholder="Ingrese el correo electrónico">
                </div>

                <!-- Campo COD_DIST -->
                <div class="mb-3">
                    <label for="COD_DIST" class="form-label">Código de Distrito:</label>
                    <input type="text" class="form-control" name="COD_DIST" id="COD_DIST" placeholder="Ingrese el código de distrito">
                </div>

                <!-- Campo COD_CONGREGACION -->
                <div class="mb-3">
                    <label for="COD_CONGREGACION" class="form-label">Código de Congregación:</label>
                    <input type="text" class="form-control" name="COD_CONGREGACION" id="COD_CONGREGACION" placeholder="Ingrese el código de congregación">
                </div>

                <!-- Campo NOM_CONGREGACION -->
                <div class="mb-3">
                    <label for="NOM_CONGREGACION" class="form-label">Nombre de Congregación:</label>
                    <input type="text" class="form-control" name="NOM_CONGREGACION" id="NOM_CONGREGACION" placeholder="Ingrese el nombre de congregación">
                </div>

                <!-- Campo FECHA_NACIMIENTO -->
                <div class="mb-3">
                    <label for="FECHA_NACIMIENTO" class="form-label">Fecha de Nacimiento:</label>
                    <input type="date" class="form-control" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO">
                </div>

                <!-- Campo FEC_ING_SIA -->
                <div class="mb-3">
                    <label for="FEC_ING_SIA" class="form-label">Fecha de Ingreso a SIA:</label>
                    <input type="date" class="form-control" name="FEC_ING_SIA" id="FEC_ING_SIA">
                </div>

                <!-- Campo FEC_MINIS_SIA -->
                <div class="mb-3">
                    <label for="FEC_MINIS_SIA" class="form-label">Fecha de Ministerio en SIA:</label>
                    <input type="date" class="form-control" name="FEC_MINIS_SIA" id="FEC_MINIS_SIA">
                </div>

                <!-- Campo FEC_APORT_SIA -->
                <div class="mb-3">
                    <label for="FEC_APORT_SIA" class="form-label">Fecha de Aporte a SIA:</label>
                    <input type="date" class="form-control" name="FEC_APORT_SIA" id="FEC_APORT_SIA">
                </div>

                <!-- Campo Fecha_Ini_Ministerio -->
                <div class="mb-3">
                    <label for="Fecha_Ini_Ministerio" class="form-label">Fecha de Inicio de Ministerio:</label>
                    <input type="date" class="form-control" name="Fecha_Ini_Ministerio" id="Fecha_Ini_Ministerio">
                </div>

                <!-- Campo Fecha_Encuesta -->
                <div class="mb-3">
                    <label for="Fecha_Encuesta" class="form-label">Fecha de Encuesta:</label>
                    <input type="date" class="form-control" name="Fecha_Encuesta" id="Fecha_Encuesta">
                </div>

                <!-- Campo FECHAPARA_CALCULO -->
                <div class="mb-3">
                    <label for="FECHAPARA_CALCULO" class="form-label">Fecha para Cálculo:</label>
                    <input type="date" class="form-control" name="FECHAPARA_CALCULO" id="FECHAPARA_CALCULO">
                </div>

                <!-- Campo ANIOS_MINISTERIO -->
                <div class="mb-3">
                    <label for="ANIOS_MINISTERIO" class="form-label">Años de Ministerio:</label>
                    <input type="number" class="form-control" name="ANIOS_MINISTERIO" id="ANIOS_MINISTERIO" placeholder="Ingrese los años de ministerio">
                </div>


                <!-- Botones para enviar el formulario y cancelar -->
                <button type="submit" class="btn btn-success">Agregar</button>
                <a href="index.php" class="btn btn-primary">Cancelar</a>
            </form>
            <!-- Fin del formulario de creación -->
        </div>
    </div>

    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>
