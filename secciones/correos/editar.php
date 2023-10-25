<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS

// Recolección, recepción y verificación de datos + instrucción de borrar
if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : ""; // Validación si - recepción

    $sentencia = $conexion->prepare("SELECT * FROM tbl_correos WHERE id=:id"); // Tomado del crear.php - Consulta
    $sentencia->bindParam(":id", $txtID); // Tomado del crear.php - Consulta
    $sentencia->execute(); // Consulta

    $registro = $sentencia->fetch(PDO::FETCH_ASSOC); // Solo se carga un registro - Consulta para hacer registro

    $correo = $registro["correo"]; // 01 datos recolectados
    $contrase = $registro["contrase"]; // 02 datos recolectados
    $observacion = $registro["observacion"]; // 03 datos recolectados
    $celular = $registro["celular"]; // 04
    $recuperacion = $registro["recuperacion"]; // 05
}

// Recolección de datos y actualización
if ($_POST) {
    // Recolectamos los datos del método POST
    $txtID = (isset($_POST["txtID"])) ? $_POST["txtID"] : ""; // 01 validación de que si existe se ponga, de lo contrario ""
    $correo = (isset($_POST["correo"])) ? $_POST["correo"] : ""; // 01 validación de que si existe se ponga, de lo contrario ""
    $contrase = (isset($_POST["contrase"])) ? $_POST["contrase"] : ""; // 02 validación de que si existe se ponga, de lo contrario ""
    $observacion = (isset($_POST["observacion"])) ? $_POST["observacion"] : ""; // 03 validación de que si existe se ponga, de lo contrario ""
    $celular = (isset($_POST["celular"])) ? $_POST["celular"] : "";
    $recuperacion = (isset($_POST["recuperacion"])) ? $_POST["recuperacion"] : "";

    // Preparar la actualización de los datos - actualizar registros
    $sentencia = $conexion->prepare("UPDATE tbl_correos SET
        correo=:correo,      
        contrase=:contrase,
        observacion=:observacion,
        celular=:celular,
        recuperacion=:recuperacion
        WHERE id=:id
    ");

    // Asignando los valores que vienen del método POST (los que vienen del formulario) - se insertan - tienen uso de :variable
    $sentencia->bindParam(":correo", $correo); // 01
    $sentencia->bindParam(":contrase", $contrase); // 02
    $sentencia->bindParam(":observacion", $observacion); // 03
    $sentencia->bindParam(":celular", $celular); // 04
    $sentencia->bindParam(":recuperacion", $recuperacion); // 05
    $sentencia->bindParam(":id", $txtID); // 06

    $sentencia->execute();
    $mensaje = "Registro actualizado";
    header("Location:index.php?mensaje=".$mensaje); // Nos devuelve al index - redireccionar
}
?>

<?php include("/xampp/htdocs/app/templates/header.php"); ?>
<!--2:32:49-->
<br>
<!-- /* bs5-card-head-foot */ -->
<div class="card">
    <div class="card-header">
        Datos del correo
    </div>
    <div class="card-body">
        <!-- PARTE 1 form:post -->
        <!-- PARTE 2 enctype="multipart/form-data" AGREGADO -->
        <form action="" method="post" enctype="multipart/form-data">
            
            <!-- Agregamos el ID - bs5-form-input -->
            <div class="mb-3">
                <label for="txtID" class="form-label">ID:</label>
                <input type="text"
                    value="<?php echo $txtID; ?>"
                    class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

            <!-- bs5-form-input 01 correo -->
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input type="text"
                    value="<?php echo $correo; ?>"
                    class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Nombre del correo">
            </div>
            
            <!-- bs5-form-input 02 CONTRASEÑA -->
            <div class="mb-3">
                <label for="contrase" class="form-label">Contraseña</label>
                <input type="text"
                    value="<?php echo $contrase; ?>"
                    class="form-control" name="contrase" id="contrase" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>
            
            <!-- bs5-form-input 03 OBSERVACION -->
            <div class="mb-3">
                <label for="observacion" class="form-label">Observacion</label>
                <input type="text"
                    value="<?php echo $observacion; ?>"
                    class="form-control" name="observacion" id="observacion" aria-describedby="helpId" placeholder="Escriba su observacion">
            </div>
            
            <!-- bs5-form-input 04 CELULAR -->
            <div class="mb-3">
                <label for="celular" class="form-label">Celular de Recuperacion</label>
                <input type="text"
                    value="<?php echo $celular; ?>"
                    class="form-control" name="celular" id="celular" aria-describedby="helpId" placeholder="Escriba su celular">
            </div>
            
            <!-- bs5-form-input 05 CORRE_R -->
            <div class="mb-3">
                <label for="recuperacion" class="form-label">Correo de Recuperacion</label>
                <input type="text"
                    value="<?php echo $recuperacion; ?>"
                    class="form-control" name="recuperacion" id="recuperacion" aria-describedby="helpId" placeholder="Escriba su recuperacion">
            </div>

            <!-- bs5-button-default -->
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<!--Estilos CSS-->
<style>
    /* Agrega tus estilos CSS personalizados aquí */
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }

    .card {
        margin: 20px auto;
        width: 400px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #f8f8f8;
        padding: 10px;
        font-weight: bold;
        border-bottom: 1px solid #ccc;
    }

    .card-body {
        padding: 20px;
    }

    .form-label {
        font-weight: bold;
    }

    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        margin-bottom: 10px;
    }

    .btn {
        display: inline-block;
        padding: 8px 12px;
        background-color: #4caf50;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #007bff;
    }

    .btn-success {
        background-color: #28a745;
    }

    .btn:hover {
        opacity: 0.8;
    }
</style>
<!--JS.-->
<script>
    // Función para validar el formulario antes de enviarlo
    function validateForm(event) {
        event.preventDefault(); // Evita el envío del formulario por defecto

        // Validación de los campos
        var correoInput = document.getElementById("correo");
        var contraseInput = document.getElementById("contrase");
        var observacionInput = document.getElementById("observacion");

        if (correoInput.value.trim() === "") {
            alert("Por favor, ingrese un correo válido.");
            correoInput.focus();
            return false;
        }

        if (contraseInput.value.trim() === "") {
            alert("Por favor, ingrese una contraseña válida.");
            contraseInput.focus();
            return false;
        }

        if (observacionInput.value.trim() === "") {
            alert("Por favor, ingrese una observación válida.");
            observacionInput.focus();
            return false;
        }

        // Si todos los campos son válidos, enviar el formulario
        document.getElementById("updateForm").submit();
    }

    // Escucha el evento submit del formulario
    var form = document.getElementById("updateForm");
    form.addEventListener("submit", validateForm);
</script>

<?php include("/xampp/htdocs/app/templates/footer.php"); ?>
