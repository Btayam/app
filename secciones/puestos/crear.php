<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS

if($_POST){
    print_r($_POST);

    //Recolectamos los datos del metodo POST
    $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");//validacion de que si existe se ponga de lo contrario ""
    //Preparar la inserccion de los datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) 
                VALUES (null, :nombredelpuesto)");
    //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
    $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
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
        Puestos
    </div>
    <div class="card-body">
        <!--PARTE 1 form:post -->
        <!--PARTE 2 enctype="multipart/form-data" AGREGADO-->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
              <input type="text"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>
            <!--bs5-button-default-->
            <button type="submit" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("/xampp/htdocs/app/templates/footer.php");?>