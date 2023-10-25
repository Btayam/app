<?php
  include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS

  if($_POST){

    //print_r($_POST);
    //print_r($_FILES);//RECEPCIONA LOS ARCHIVO

    $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
    $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
    $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
    $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""

    $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
    $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""

    $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
    $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""

    //Preparar la inserccion de los datos
    $sentencia=$conexion->prepare("INSERT INTO 
    `tbl_empleados` (`id`, `primernombre`, `segundonombre`, `primerapellido`, `segundoapellido`, `foto`, `cv`, `idpuesto`, `fechadeingreso`) 
    VALUES (NULL, :primernombre, :segundonombre, :primerapellido, :segundoapellido, :foto, :cv, :idpuesto, :fechadeingreso);");

     //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
     $sentencia->bindParam(":primernombre",$primernombre);
     $sentencia->bindParam(":segundonombre",$segundonombre);
     $sentencia->bindParam(":primerapellido",$primerapellido);
     $sentencia->bindParam(":segundoapellido",$segundoapellido);
//0
     $fecha_fc=new DateTime();
//1
     $nombreArchivo_foto=($foto!='')?$fecha_fc->getTimestamp()."_".$_FILES["foto"]['name']:"";
     $tmp_foto=$_FILES["foto"]['tmp_name'];
     if($tmp_foto!=''){
      move_uploaded_file($tmp_foto,"./".$nombreArchivo_foto);
     }
     $sentencia->bindParam(":foto",$nombreArchivo_foto);
//2
     $nombreArchivo_cv=($cv!='')?$fecha_fc->getTimestamp()."_".$_FILES["cv"]['name']:"";
     $tmp_cv=$_FILES["cv"]['tmp_name'];
     if($tmp_cv!=''){
      move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
     }
     $sentencia->bindParam(":cv",$nombreArchivo_cv);
//--    
     $sentencia->bindParam(":idpuesto",$idpuesto);
     $sentencia->bindParam(":fechadeingreso",$fechadeingreso);

     $sentencia->execute();
     $mensaje = "Registro agregado";
     header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
  }

$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); //BD
$sentencia->execute();//ejecuta los registros
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("/xampp/htdocs/app/templates/header.php");?>
<br>
<!-- bs5-card-head-foot -->
<div class="card">
    <!--/01-->
    <div class="card-header">
    Datos del empleado
    </div>
    <!--/02 Formulario-->
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data"> <!--enctype="" (adjuntar archivos)-->
            <!-- bs5-form-input - 01-->
            <div class="mb-3">
              <label for="primernombre" class="form-label">Primer Nombre</label>
              <input type="text" class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
            </div>
            <!-- bs5-form-input - 02-->
            <div class="mb-3">
              <label for="segundonombre" class="form-label">Segundo Nombre</label>
              <input type="text" class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>
            <!-- bs5-form-input - 03-->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer Apellido</label>
              <input type="text" class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>
            <!-- bs5-form-input - 04-->
            <div class="mb-3">
              <label for="segundoapellido" class="form-label">Segundo Apellido</label>
              <input type="text" class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>
            <!-- bs5-form-input - 05 - cambios --> 
            <div class="mb-3">
              <label for="foto" class="form-label">Foto</label>
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto ">
            </div>
            <!-- bs5-form-file - 06-->
            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF):</label>
              <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
            </div>
            <!-- bs5-form-select-custom - 07-->
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>

                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                  <?php foreach ($lista_tbl_puestos as $registro){ ?>
                    <option value="
                      <?php echo $registro['id']?>">
                      <?php echo $registro['nombredelpuesto']?>
                    </option>
                  <?php } ?>
                </select>
            </div>
            <!-- bs5-form-email - 08-->
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
            </div>

            <!--BOTON-->
            <!-- bs5-button-default - 09-->
            <button type="submit" class="btn btn-success">Agregar registro</button>
            <!-- bs5-button-a - 10-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form> 
    </div>
    <!--/03-->
    <div class="card-footer text-muted"></div>
</div>

<?php include("/xampp/htdocs/app/templates/footer.php");?>