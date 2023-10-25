<?php
  include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS

  //recoleccion y verificacion de datos + istruccion de borrar
  if(isset( $_GET['txtID'] )){
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";//validacion si

    $sentencia=$conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");//tomado del crear.php
    $sentencia->bindParam(":id",$txtID);//tomado del crear.php
    $sentencia->execute();
    $registro=$sentencia->fetch(PDO::FETCH_LAZY);//Solo se carge un resgistro
    //Asignar informacion deacuerdo a lo agregado
    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];

    $foto=$registro["foto"];
    $cv=$registro["cv"];

    $idpuesto=$registro["idpuesto"];
    $fechadeingreso=$registro["fechadeingreso"];

    $sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); //BD
    $sentencia->execute();//ejecuta los registros
    $lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    }
//ACTTUALIZACION
    if($_POST){

      $txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";//validacion si
      //print_r($_POST);
      //print_r($_FILES);//RECEPCIONA LOS ARCHIVO
  
      $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
      $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
      $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
      $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
      $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
      $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
  
      //Preparar la inserccion de los datos
      $sentencia=$conexion->prepare("
        UPDATE tbl_empleados 
        SET
          primernombre=:primernombre,
          segundonombre=:segundonombre,
          primerapellido=:primerapellido,
          segundoapellido=:segundoapellido,
          idpuesto=:idpuesto,
          fechadeingreso=:fechadeingreso
        WHERE id=:id
      ");
  
       //Asignando los valores que vienen del metodo POST (LOS QUE VIENEN DEL FORMULARIO)
       $sentencia->bindParam(":primernombre",$primernombre);
       $sentencia->bindParam(":segundonombre",$segundonombre);
       $sentencia->bindParam(":primerapellido",$primerapellido);
       $sentencia->bindParam(":segundoapellido",$segundoapellido);
       $sentencia->bindParam(":idpuesto",$idpuesto);
       $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
       $sentencia->bindParam(":id",$txtID);
       $sentencia->execute();

       //ACTUALIZACION FOTO
       $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
       $fecha_fc=new DateTime();
       $nombreArchivo_foto=($foto!='')?$fecha_fc->getTimestamp()."_".$_FILES["foto"]['name']:"";
       $tmp_foto=$_FILES["foto"]['tmp_name'];
       
        if ($tmp_foto != '') {
          move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);  // Mueve el archivo cargado a la ubicación especificada

          $sentencia=$conexion->prepare("SELECT foto FROM `tbl_empleados` WHERE id=:id"); //BD
          $sentencia->bindParam(":id",$txtID);
          $sentencia->execute();//ejecuta los registros
          $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
            if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=" "){
                if(file_exists("./".$registro_recuperado["foto"])){
                    unlink("./".$registro_recuperado["foto"]);
                }
            }

          $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto=:foto WHERE id=:id"); // Prepara una sentencia para actualizar el campo "foto" en la tabla "tbl_empleados" para el empleado con el ID especificado  
          $sentencia->bindParam(":foto", $nombreArchivo_foto); // Vincula el nombre del archivo de la foto con el parámetro ":foto" en la sentencia preparada
          $sentencia->bindParam(":id", $txtID); // Vincula el ID del empleado con el parámetro ":id" en la sentencia preparada
          $sentencia->execute(); // Ejecuta la sentencia preparada para actualizar la foto del empleado
        }
        
        
       //ACTUALIZACION CV
       $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");//Almacenamiento - validacion de que si existe se ponga de lo contrario ""
       
       $nombreArchivo_cv=($cv!='')?$fecha_fc->getTimestamp()."_".$_FILES["cv"]['name']:"";
       $tmp_cv=$_FILES["cv"]['tmp_name'];
       if($tmp_cv!=''){
          move_uploaded_file($tmp_cv,"./".$nombreArchivo_cv);
          
          $sentencia=$conexion->prepare("SELECT cv FROM `tbl_empleados` WHERE id=:id"); //BD
          $sentencia->bindParam(":id",$txtID);
          $sentencia->execute();//ejecuta los registros
          $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);

          if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=" "){
            if(file_exists("./".$registro_recuperado["cv"])){
                unlink("./".$registro_recuperado["cv"]);
            }
          }

          $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id=:id");
          $sentencia->bindParam(":cv", $nombreArchivo_cv); 
          $sentencia->bindParam(":id", $txtID); 
          $sentencia->execute();
        }
        $mensaje = "Registro actualizado";
        header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
       }
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

            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
                value="<?php echo $txtID;?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>
            <!-- bs5-form-input - 01-->
            <div class="mb-3">
              <label for="primernombre" class="form-label">Primer Nombre</label>
              <input type="text" 
                value="<?php echo $primernombre;?>"
                class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
                
            </div>
            <!-- bs5-form-input - 02-->
            <div class="mb-3">
              <label for="segundonombre" class="form-label">Segundo Nombre</label>
              <input type="text" 
              value="<?php echo $segundonombre;?>"
              class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>
            <!-- bs5-form-input - 03-->
            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer Apellido</label>
              <input type="text" 
              value="<?php echo $primerapellido;?>"
              class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>
            <!-- bs5-form-input - 04-->
            <div class="mb-3">
              <label for="segundoapellido" class="form-label">Segundo Apellido</label>
              <input type="text" 
              value="<?php echo $segundoapellido;?>"
              class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>
            <!-- bs5-form-input - 05 - cambios --> 
            <div class="mb-3">
              <label for="foto" class="form-label">Foto</label>
              <!-- Muestra la variable $foto, que debería contener la URL de la imagen -->
              <!--?php echo $foto;?>"-->
              <br/>
              <!-- Muestra la imagen utilizando la URL contenida en la variable $foto -->
              <img width="100" src="<?php echo $foto;?>" class="img-fluid rounded" alt="">
              <br/><br/>

              <!-- Input para seleccionar un archivo de imagen -->
              <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto ">
              <hr>
          </div>

            <!-- bs5-form-file - 06-->
            <div class="mb-3">
              <label for="cv" class="form-label">Hoha de Vida (PDF)</label>
              <br/>
              CV<a href=" <?php echo $cv;?>"><?php echo $cv;?></a> <!-- Enlace al currículum vitae actual -->
              <br/><br/>

              <input type="file" class="form-control" name="cv" id="cv" placeholder="CV" aria-describedby="fileHelpId">
              <hr> <!-- Línea horizontal para separar visualmente -->
            </div>
            <!-- bs5-form-select-custom - 07-->
            <div class="mb-3">
                <label for="idpuesto" class="form-label">Puesto:</label>
                <!--"?php echo $idpuesto;?>"-->
                <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                  <?php foreach ($lista_tbl_puestos as $registro) { ?>
                      <option <?php echo ($idpuesto == $registro['id']) ? "selected" : ""; ?> value="<?php echo $registro['id']?>">
                          <?php echo $registro['nombredelpuesto']?> <!-- Muestra el nombre del puesto -->
                      </option>
                  <?php } ?> <!-- Fin del bucle foreach para recorrer los registros de puestos -->
              </select>
            </div>
            <!-- bs5-form-email - 08-->
            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
              <input type="date" 
              value="<?php echo $fechadeingreso;?>"
              class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
            </div>

            <!--BOTON-->
            <!-- bs5-button-default - 09-->
            <button type="submit" class="btn btn-success">Actualizar registro</button>
            <!-- bs5-button-a - 10-->
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
        </form> 
    </div>
    <!--/03-->
    <div class="card-footer text-muted"></div>
</div>


<?php include("/xampp/htdocs/app/templates/footer.php");?>