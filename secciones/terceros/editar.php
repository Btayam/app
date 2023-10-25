<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Tercero</title>
    <style>
        /* Estilos CSS */
        /* ... (tu estilo CSS personalizado) ... */
    </style>
</head>
<body>
    <?php
    include("/xampp/htdocs/app/bd.php"); // CONEXIÓN - BASE DE DATOS

    // Recolección y verificación de datos
    if (isset($_GET['txtID'])) {
        $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : ""; // Validación si - dirección del ID
        $sentencia = $conexion->prepare("SELECT * FROM tbl_terceros WHERE COD_TER=:COD_TER"); // Consulta
        $sentencia->bindParam(":COD_TER", $txtID); // Consulta
        $sentencia->execute(); // Consulta

        $registro = $sentencia->fetch(PDO::FETCH_ASSOC); // Obtener el registro a editar

        // Campos a editar
        $COD_TER = $registro["COD_TER"];
        $NOM_TER = $registro["NOM_TER"];
        $DIR = $registro["DIR"];
        $TEL = $registro["TEL"];
        $CEL = $registro["CEL"];
        $EMAIL = $registro["EMAIL"];
        $COD_DIST = $registro["COD_DIST"];
        $COD_CONGREGACION = $registro["COD_CONGREGACION"];
        $NOM_CONGREGACION = $registro["NOM_CONGREGACION"];
        $FECHA_NACIMIENTO = $registro["FECHA_NACIMIENTO"];
        $FEC_ING_SIA = $registro["FEC_ING_SIA"];
        $FEC_MINIS_SIA = $registro["FEC_MINIS_SIA"];
        $FEC_APORT_SIA = $registro["FEC_APORT_SIA"];
        $Fecha_Ini_Ministerio = $registro["Fecha_Ini_Ministerio"];
        $Fecha_Encuesta = $registro["Fecha_Encuesta"];
        $FECHAPARA_CALCULO = $registro["FECHAPARA_CALCULO"];
        $ANIOS_MINISTERIO = $registro["ANIOS_MINISTERIO"];
    }
    
    // Recolección de datos y actualización
    if ($_POST) {
        // Recolectamos los datos del método POST
        $COD_TER = (isset($_POST["COD_TER"])) ? $_POST["COD_TER"] : "";
        $NOM_TER = (isset($_POST["NOM_TER"])) ? $_POST["NOM_TER"] : "";
        $DIR = (isset($_POST["DIR"])) ? $_POST["DIR"] : "";
        $TEL = (isset($_POST["TEL"])) ? $_POST["TEL"] : "";
        $CEL = (isset($_POST["CEL"])) ? $_POST["CEL"] : "";
        $EMAIL = (isset($_POST["EMAIL"])) ? $_POST["EMAIL"] : "";
        $COD_DIST = (isset($_POST["COD_DIST"])) ? $_POST["COD_DIST"] : "";
        $COD_CONGREGACION = (isset($_POST["COD_CONGREGACION"])) ? $_POST["COD_CONGREGACION"] : "";
        $NOM_CONGREGACION = (isset($_POST["NOM_CONGREGACION"])) ? $_POST["NOM_CONGREGACION"] : "";
        $FECHA_NACIMIENTO = (isset($_POST["FECHA_NACIMIENTO"])) ? $_POST["FECHA_NACIMIENTO"] : "";
        $FEC_ING_SIA = (isset($_POST["FEC_ING_SIA"])) ? $_POST["FEC_ING_SIA"] : "";
        $FEC_MINIS_SIA = (isset($_POST["FEC_MINIS_SIA"])) ? $_POST["FEC_MINIS_SIA"] : "";
        $FEC_APORT_SIA = (isset($_POST["FEC_APORT_SIA"])) ? $_POST["FEC_APORT_SIA"] : "";
        $Fecha_Ini_Ministerio = (isset($_POST["Fecha_Ini_Ministerio"])) ? $_POST["Fecha_Ini_Ministerio"] : "";
        $Fecha_Encuesta = (isset($_POST["Fecha_Encuesta"])) ? $_POST["Fecha_Encuesta"] : "";
        $FECHAPARA_CALCULO = (isset($_POST["FECHAPARA_CALCULO"])) ? $_POST["FECHAPARA_CALCULO"] : "";
        $ANIOS_MINISTERIO = (isset($_POST["ANIOS_MINISTERIO"])) ? $_POST["ANIOS_MINISTERIO"] : "";

        // Preparar la actualización de los datos - actualizar registros
        $sentencia = $conexion->prepare("UPDATE tbl_terceros SET
            NOM_TER=:NOM_TER,
            DIR=:DIR,
            TEL=:TEL,
            CEL=:CEL,
            EMAIL=:EMAIL,
            COD_DIST=:COD_DIST,
            COD_CONGREGACION=:COD_CONGREGACION,
            NOM_CONGREGACION=:NOM_CONGREGACION,
            FECHA_NACIMIENTO=:FECHA_NACIMIENTO,
            FEC_ING_SIA=:FEC_ING_SIA,
            FEC_MINIS_SIA=:FEC_MINIS_SIA,
            FEC_APORT_SIA=:FEC_APORT_SIA,
            Fecha_Ini_Ministerio=:Fecha_Ini_Ministerio,
            Fecha_Encuesta=:Fecha_Encuesta,
            FECHAPARA_CALCULO=:FECHAPARA_CALCULO,
            ANIOS_MINISTERIO=:ANIOS_MINISTERIO
            WHERE COD_TER=:COD_TER
        ");

        // Asignando los valores que vienen del método POST (los que vienen del formulario) - se insertan - tienen uso de :variable
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

        $sentencia->execute();
        $mensaje = "Registro actualizado";
        header("Location: index.php?mensaje=" . $mensaje); // Nos devuelve al index - redireccionar
    }
    ?>

    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>

    <div class="card">
        <div class="card-header">
            Editar Tercero
        </div>
        <div class="card-body">
            <!-- Formulario de edición -->
            <form action="" method="post">
                <!-- Campos de edición -->
                <div class="mb-3">
                    <label for="COD_TER" class="form-label">COD_TER:</label>
                    <input type="text" value="<?php echo $COD_TER; ?>" class="form-control" readonly name="COD_TER" id="COD_TER" placeholder="Código del tercero">
                </div>

                <div class="mb-3">
                    <label for="NOM_TER" class="form-label">NOM_TER:</label>
                    <input type="text" value="<?php echo $NOM_TER; ?>" class="form-control" name="NOM_TER" id="NOM_TER" placeholder="Nombre del tercero">
                </div>

                <div class="mb-3">
                    <label for="DIR" class="form-label">DIR:</label>
                    <input type="text" value="<?php echo $DIR; ?>" class="form-control" name="DIR" id="DIR" placeholder="Dirección">
                </div>

                <div class="mb-3">
                    <label for="TEL" class="form-label">TEL:</label>
                    <input type="text" value="<?php echo $TEL; ?>" class="form-control" name="TEL" id="TEL" placeholder="Teléfono">
                </div>

                <div class="mb-3">
                    <label for="CEL" class="form-label">CEL:</label>
                    <input type="text" value="<?php echo $CEL; ?>" class="form-control" name="CEL" id="CEL" placeholder="Celular">
                </div>

                <div class="mb-3">
                    <label for="EMAIL" class="form-label">EMAIL:</label>
                    <input type="text" value="<?php echo $EMAIL; ?>" class="form-control" name="EMAIL" id="EMAIL" placeholder="Email">
                </div>

                <div class="mb-3">
                    <label for="COD_DIST" class="form-label">COD_DIST:</label>
                    <input type="text" value="<?php echo $COD_DIST; ?>" class="form-control" name="COD_DIST" id="COD_DIST" placeholder="Código de distrito">
                </div>

                <div class="mb-3">
                    <label for="COD_CONGREGACION" class="form-label">COD_CONGREGACION:</label>
                    <input type="text" value="<?php echo $COD_CONGREGACION; ?>" class="form-control" name="COD_CONGREGACION" id="COD_CONGREGACION" placeholder="Código de congregación">
                </div>

                <div class="mb-3">
                    <label for="NOM_CONGREGACION" class="form-label">NOM_CONGREGACION:</label>
                    <input type="text" value="<?php echo $NOM_CONGREGACION; ?>" class="form-control" name="NOM_CONGREGACION" id="NOM_CONGREGACION" placeholder="Nombre de congregación">
                </div>

                <div class="mb-3">
                    <label for="FECHA_NACIMIENTO" class="form-label">FECHA_NACIMIENTO:</label>
                    <input type="text" value="<?php echo $FECHA_NACIMIENTO; ?>" class="form-control" name="FECHA_NACIMIENTO" id="FECHA_NACIMIENTO" placeholder="Fecha de nacimiento">
                </div>

                <div class="mb-3">
                    <label for="FEC_ING_SIA" class="form-label">FEC_ING_SIA:</label>
                    <input type="text" value="<?php echo $FEC_ING_SIA; ?>" class="form-control" name="FEC_ING_SIA" id="FEC_ING_SIA" placeholder="Fecha de ingreso a SIA">
                </div>

                <div class="mb-3">
                    <label for="FEC_MINIS_SIA" class="form-label">FEC_MINIS_SIA:</label>
                    <input type="text" value="<?php echo $FEC_MINIS_SIA; ?>" class="form-control" name="FEC_MINIS_SIA" id="FEC_MINIS_SIA" placeholder="Fecha de inicio de ministerio en SIA">
                </div>

                <div class="mb-3">
                    <label for="FEC_APORT_SIA" class="form-label">FEC_APORT_SIA:</label>
                    <input type="text" value="<?php echo $FEC_APORT_SIA; ?>" class="form-control" name="FEC_APORT_SIA" id="FEC_APORT_SIA" placeholder="Fecha de aportación a SIA">
                </div>

                <div class="mb-3">
                    <label for="Fecha_Ini_Ministerio" class="form-label">Fecha_Ini_Ministerio:</label>
                    <input type="text" value="<?php echo $Fecha_Ini_Ministerio; ?>" class="form-control" name="Fecha_Ini_Ministerio" id="Fecha_Ini_Ministerio" placeholder="Fecha de inicio de ministerio">
                </div>

                <div class="mb-3">
                    <label for="Fecha_Encuesta" class="form-label">Fecha_Encuesta:</label>
                    <input type="text" value="<?php echo $Fecha_Encuesta; ?>" class="form-control" name="Fecha_Encuesta" id="Fecha_Encuesta" placeholder="Fecha de encuesta">
                </div>

                <div class="mb-3">
                    <label for="FECHAPARA_CALCULO" class="form-label">FECHAPARA_CALCULO:</label>
                    <input type="text" value="<?php echo $FECHAPARA_CALCULO; ?>" class="form-control" name="FECHAPARA_CALCULO" id="FECHAPARA_CALCULO" placeholder="Fecha para cálculo">
                </div>

                <div class="mb-3">
                    <label for="ANIOS_MINISTERIO" class="form-label">ANIOS_MINISTERIO:</label>
                    <input type="text" value="<?php echo $ANIOS_MINISTERIO; ?>" class="form-control" name="ANIOS_MINISTERIO" id="ANIOS_MINISTERIO" placeholder="Años de ministerio">
                </div>

                <!-- Botones de acción -->
                <div class="mb-3">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
                </div>
            </form>
            <!-- Fin del formulario de edición -->
        </div>
    </div>

    <?php include("/xampp/htdocs/app/templates/footer.php"); ?>
</body>
</html>
