<!--vamoa a validar que el ID llegue-->
<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS

    //recoleccion y verificacion de datos + istruccion de borrar
    if(isset( $_GET['txtID'] )){
        $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";//validacion si

        // $sentencia=$conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");//tomado del crear.php
        $sentencia->bindParam(":id",$txtID);//tomado del crear.php
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);//Solo se carge un resgistro
        $nombredelpuesto=$registro["nombredelpuesto"];
    }

    //recoleccion de datos y actualizacion
    if($_POST){
        // print_r($_POST); - Si funciona ya no lo requerimos

        //Recolectamos los datos del metodo POST
        $txtID=(isset( $_POST['txtID']))?$_POST['txtID']:"";
        $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");//validacion de que si existe se ponga de lo contrario ""

        //Preparar la inserccion de los datos
        $sentencia=$conexion->prepare("UPDATE tbl_puestos 
        SET nombredelpuesto=:nombredelpuesto
        WHERE id=:id "); 

        //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
        $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();

        //Nos devuelve al index redireccionar
        $mensaje = "Registro actualizado";
        header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
    }

?>

<?php include("/xampp/htdocs/app/templates/header.php");?>
    <!--Mismo formulario de crear.php-->
    <br>
    <!-- /* bs5-card-head-foot */ -->
    <div class="card">
        <div class="card-header">
            Editar Puesto
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

                <!-- bs5-form-input -->
                    <div class="mb-3">
                        <label for="nombredelpuesto" class="form-label">Nombre del puesto:</label>
                        <input type="text"
                            value="<?php echo $nombredelpuesto;?>"
                            class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
                    </div>

                <!--bs5-button-default-->
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <a 
                        name="" 
                        id="" 
                        class="btn btn-primary" 
                        href="index.php" 
                        role="button"
                        
                        >Cancelar
                    </a>

            </form>
        </div>
        <div class="card-footer text-muted"></div>
    </div>

<?php include("/xampp/htdocs/app/templates/footer.php");?>