<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS
    //recoleccion, recepcion y verificacion de datos + istruccion de borrar
    if(isset( $_GET['txtID'] )){
        $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";//validacion si - recepcion 

        $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");//tomado del crear.php - Consulta
        $sentencia->bindParam(":id",$txtID);//tomado del crear.php - Consulta
        $sentencia->execute(); // - Consulta

        $registro=$sentencia->fetch(PDO::FETCH_LAZY);//Solo se carge un resgistro - Consulta para hacer registro

        $usuario=$registro["usuario"]; // 01 datos recolectados
        $password=$registro["password"]; // 02 datos recolectados
        $correo=$registro["correo"]; // 03 datos recolectados
    }
    //recoleccion de datos y actualizacion
    if($_POST){
        
        //Recolectamos los datos del metodo POST
          $txtID=(isset($_POST["txtID"])?$_POST["txtID"]:"");    //01 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
          $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");    //01 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
          $password=(isset($_POST["password"])?$_POST["password"]:""); //02 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
          $correo=(isset($_POST["correo"])?$_POST["correo"]:"");       //03 validacion de que si existe se ponga de lo contrario "" //tambien se esta recolectando.
        
          //Preparar la inserccion de los datos - insertar registros
        $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET
            usuario=:usuario,      
            password=:password,
            correo=:correo
            WHERE id=:id
        ");

        //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO) - y se insertan - tienen uso de :variable
        $sentencia->bindParam(":usuario",$usuario);     //01
        $sentencia->bindParam(":password",$password);   //02
        $sentencia->bindParam(":correo",$correo);       //03

        $sentencia->bindParam(":id",$txtID);            //04
        
        $sentencia->execute();
        $mensaje = "Registro actualizado";
        header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
      }

?>

<?php include("/xampp/htdocs/app/templates/header.php");?>
<!--2:32:49-->
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
            <!--Agregamos el ID - bs5-form-input-->
            <div class="mb-3">
                        <label for="txtID" class="form-label">ID:</label>
                        <input type="text"
                            value="<?php echo $txtID;?>"
                            class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
                    </div>

            <!-- bs5-form-input 01 USUARIO-->
              <div class="mb-3">
                <label for="usuario" class="form-label">Nombre del usuario:</label>
                <input type="text"
                  value="<?php echo $usuario;?>"
                  class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
              </div>
            <!-- bs5-form-input 02 CONTRASEÑA-->
              <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password"
                  value="<?php echo $password;?>"
                  class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
              </div>
            <!-- bs5-form-input 03 CORREO-->
              <div class="mb-3">
                <label for="correo" class="form-label">Email</label>
                <input type="email"
                  value="<?php echo $correo;?>"
                  class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo">
              </div>
            <!--bs5-button-default-->
              <button type="submit" class="btn btn-success">Actualizar</button>
              <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("/xampp/htdocs/app/templates/footer.php");?>