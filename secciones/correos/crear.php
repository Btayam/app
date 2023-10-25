<?php
include("/xampp/htdocs/app/bd.php"); // CONEXION - BASE DE DATOS

// crear y agregar correos
if ($_POST) {
  $correo = isset($_POST["correo"]) ? $_POST["correo"] : ""; // Obtener el valor del campo "correo" del formulario
  $contrase = isset($_POST["contrase"]) ? $_POST["contrase"] : ""; // Obtener el valor del campo "contrase" del formulario
  $observacion = isset($_POST["observacion"]) ? $_POST["observacion"] : ""; // Obtener el valor del campo "observacion" del formulario
  $celular = isset($_POST["celular"]) ? $_POST["celular"] : ""; // Obtener el valor del campo "celular" del formulario
  $recuperacion = isset($_POST["recuperacion"]) ? $_POST["recuperacion"] : ""; // Obtener el valor del campo "recuperacion" del formulario

  // Preparar la inserción de los datos - insertar registros
  $sentencia = $conexion->prepare("INSERT INTO tbl_correos (id, correo, contrase, observacion, celular, recuperacion)
    VALUES (NULL, :correo, :contrase, :observacion, :celular, :recuperacion)");

  // Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO) - y se insertan - tienen uso de :variable
  $sentencia->bindParam(":correo", $correo); // Vincular el valor de $correo al marcador de posición :correo
  $sentencia->bindParam(":contrase", $contrase); // Vincular el valor de $contrase al marcador de posición :contrase
  $sentencia->bindParam(":observacion", $observacion); // Vincular el valor de $observacion al marcador de posición :observacion
  $sentencia->bindParam(":celular", $celular); // Vincular el valor de $celular al marcador de posición :celular
  $sentencia->bindParam(":recuperacion", $recuperacion); // Vincular el valor de $recuperacion al marcador de posición :recuperacion
  $sentencia->execute(); // Ejecutar la consulta preparada para insertar los datos en la base de datos

  $mensaje = "Registro agregado";
  header("Location:index.php?mensaje=" . $mensaje); // Redirigir al archivo index.php con un mensaje de éxito en la URL
}
?>

<?php include("/xampp/htdocs/app/templates/header.php");?>
<br>
<!-- /* bs5-card-head-foot */ -->
<div class="card">
  <div class="card-header">
    Datos del correo
  </div>
  <div class="card-body">
    <!--PARTE 1 form:post -->
    <!--PARTE 2 enctype="multipart/form-data" AGREGADO-->
    <form action="" method="post" enctype="multipart/form-data">

      <!-- bs5-form-input 01 correo + -->
      <div class="mb-3">
        <label for="correo" class="form-label">Correo:</label>
        <input type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId"
          placeholder="Escriba su correo"> <!-- Campo de entrada para el correo -->
      </div>
      <!-- bs5-form-input 02 contraseña-->
      <div class="mb-3">
        <label for="contrase" class="form-label">Contraseña</label>
        <input type="text" class="form-control" name="contrase" id="contrase" aria-describedby="helpId"
          placeholder="Escriba su contraseña"> <!-- Campo de entrada para la contraseña -->
      </div>
      <!-- bs5-form-input 03 Observacion-->
      <div class="mb-3">
        <label for="observacion" class="form-label">Observacion</label>
        <input type="text" class="form-control" name="observacion" id="observacion" aria-describedby="helpId"
          placeholder="Escriba su observacion"> <!-- Campo de entrada para la observación -->
      </div>
      <!-- bs5-form-input 04 celular-->
      <div class="mb-3">
        <label for="celular" class="form-label">Celular de recuperacion</label>
        <input type="text" class="form-control" name="celular" id="celular" aria-describedby="helpId"
          placeholder="Celular de recuperacion"> <!-- Campo de entrada para el celular de recuperación -->
      </div>
      <!-- bs5-form-input 05 recuperacion-->
      <div class="mb-3">
        <label for="recuperacion" class="form-label">Correo de recuperacion</label>
        <input type="text" class="form-control" name="recuperacion" id="recuperacion" aria-describedby="helpId"
          placeholder="Correo de recuperacion"> <!-- Campo de entrada para el correo de recuperación -->
      </div>

      <!-- bs5-button-default-->
      <button type="submit" class="btn btn-success">Agregar</button> <!-- Botón para enviar el formulario -->
      <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a> <!-- Enlace para cancelar y volver al archivo index.php -->

    </form>
  </div>
  <div class="card-footer text-muted"></div>
</div>
<!--Estilos CSS-->
<style>
  .card-header {
    padding: 10px;
    background-color: #f7f7f7;
    border-bottom: 1px solid #ccc;
    font-size: 18px;
    font-weight: bold;
  }
  /* Estilos generales del formulario */
  form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f7f7f7;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .form-label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
  }

  .form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-bottom: 10px;
    font-size: 14px;
    line-height: 1.5;
  }

  .form-control:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
  }

  .btn {
    display: inline-block;
    padding: 10px 20px;
    font-size: 14px;
    font-weight: bold;
    text-align: center;
    text-decoration: none;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 4px;
  }

  .btn-success {
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
  }

  .btn-success:hover {
    background-color: #218838;
    border-color: #1e7e34;
  }

  .btn-primary {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
  }

  .btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
  }

  /* Estilos específicos para el botón de cancelar */
  .btn-cancel {
    margin-right: 10px;
  }
</style>
<!--JS.-->
<script>
  // Obtener referencias a los elementos del formulario
  const form = document.querySelector('form');
  const correoInput = document.getElementById('correo');
  const contraseInput = document.getElementById('contrase');
  const observacionInput = document.getElementById('observacion');
  const celularInput = document.getElementById('celular');
  const recuperacionInput = document.getElementById('recuperacion');

  // Validar el formulario antes de enviarlo
  form.addEventListener('submit', function (event) {
    if (!validateForm()) {
      event.preventDefault(); // Evitar el envío del formulario si no es válido
    }
  });

  // Función para validar el formulario
  function validateForm() {
    let isValid = true;

    // Validar el campo de correo
    if (correoInput.value === '') {
      isValid = false;
      correoInput.classList.add('is-invalid');
    } else {
      correoInput.classList.remove('is-invalid');
    }

    // Validar el campo de contraseña
    if (contraseInput.value === '') {
      isValid = false;
      contraseInput.classList.add('is-invalid');
    } else {
      contraseInput.classList.remove('is-invalid');
    }

    // Validar el campo de observación
    if (observacionInput.value === '') {
      isValid = false;
      observacionInput.classList.add('is-invalid');
    } else {
      observacionInput.classList.remove('is-invalid');
    }

    // Validar el campo de celular
    if (celularInput.value === '') {
      isValid = false;
      celularInput.classList.add('is-invalid');
    } else {
      celularInput.classList.remove('is-invalid');
    }

    // Validar el campo de recuperación
    if (recuperacionInput.value === '') {
      isValid = false;
      recuperacionInput.classList.add('is-invalid');
    } else {
      recuperacionInput.classList.remove('is-invalid');
    }

    return isValid;
  }
</script>


<?php include("/xampp/htdocs/app/templates/footer.php");?>
