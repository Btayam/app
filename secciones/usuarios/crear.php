<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS
//crear y agregar usuarios
  if($_POST){
    // print_r($_POST);

    //Recolectamos los datos del metodo POST
      $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");    //01 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
      $password=(isset($_POST["password"])?$_POST["password"]:""); //02 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
      $correo=(isset($_POST["correo"])?$_POST["correo"]:"");       //03 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.


    //Preparar la inserccion de los datos - insertar registros
    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios (id,usuario,password,correo)
    VALUES (NULL,:usuario,:password,:correo) ");


    //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO) - y se insertan - tienen uso de :variable
    $sentencia->bindParam(":usuario",$usuario);
    $sentencia->bindParam(":password",$password);
    $sentencia->bindParam(":correo",$correo);
    $sentencia->execute();

    $mensaje = "Registro agregado";
    header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
  }

?>

<?php include("/xampp/htdocs/app/templates/header.php");?>
<br>
<!-- /* bs5-card-head-foot */ -->
<div class="card">
    <div class="card-header">
        Datos del usuario
    </div>
    <div class="card-body">
        <!--PARTE 1 form:post -->
        <!--PARTE 2 enctype="multipart/form-data" AGREGADO-->
        <form action="" method="post" enctype="multipart/form-data">
            
            <!-- bs5-form-input 01 usuario + -->
              <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text"
                  class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
              </div>
            <!-- bs5-form-input 02 contraseña-->
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                  class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
              </div>
            <!-- bs5-form-input 03 corre-->
              <div class="mb-3">
                <label for="correo" class="form-label">Email</label>
                <input type="email"
                  class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
              </div>
            <!--bs5-button-default-->
              <button type="submit" class="btn btn-success">Agregar</button>
              <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>


<?php include("/xampp/htdocs/app/templates/footer.php");?>