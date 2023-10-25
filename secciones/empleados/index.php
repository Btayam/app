<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS
//recoleccion y verificacion de datos + istruccion de borrar
if(isset( $_GET['txtID'] )){  
    //validacion si
    $txtID=(isset( $_GET['txtID'] ))?$_GET['txtID']:"";
    //Buscar el archivo relacionado con el empleado
    $sentencia=$conexion->prepare("SELECT foto,cv FROM `tbl_empleados` WHERE id=:id"); //BD
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();//ejecuta los registros
    $registro_recuperado=$sentencia->fetch(PDO::FETCH_LAZY);
    print_r($registro_recuperado);//<
    if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!=" "){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }
    if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!=" "){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }


    //tomado del crear.php
    $sentencia=$conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    //tomado del crear.php
    $sentencia->bindParam(":id",$txtID);
    $sentencia->execute();
    
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
}

$sentencia=$conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
 FROM tbl_puestos 
 WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto
 FROM `tbl_empleados`"); //BD - aqui se hace una subconsulta para el ID Puesto
$sentencia->execute();//ejecuta los registros
$lista_tbl_empleados=$sentencia->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include("/xampp/htdocs/app/templates/header.php");?> <!-- CONEXION - VINCULO -->
<br>
<!-- <h3>Empleados</h4> -->
<!-- /* bs5-card-head-foot */ -->
<div class="card">

<!--EMPLEADOS - AGREGAR EMPLEADOS - SECCIONES EMPLEADOS-->
    <div class="card-header">
        <!--bs5-button-a-->
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Empleado</a> <!-- CONEXION - VINCULO -->
    </div>

    <div class="card-body">
        <!-- bs5-table-default -->
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>

                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_tbl_empleados as $registro){ ?>
                        <tr class="">
                            <td> <?php echo $registro['id']?> </td>
                            
                            <td scope="row"> 
                                <?php echo $registro['primernombre']?>
                                <?php echo $registro['segundonombre']?>
                                <?php echo $registro['primerapellido']?>
                                <?php echo $registro['segundoapellido']?>
                            </td>

                            <td>
                                <img 
                                    width="50" 
                                    src="<?php echo $registro['foto']?>" 
                                    class="img-fluid rounded" alt="">
                            </td>

                            <td> 
                                <a href="<?php echo $registro['cv']?>">
                                <?php echo $registro['cv']?>
                                </a>
                            </td>
                            <td> <?php echo $registro['puesto']?> </td><!--El (idpuesto) se cambia por (puesto) por el alias o subconsulta arriba definida-->
                            <td> <?php echo $registro['fechadeingreso']?> </td>
                                <!--bs5-button-a (Agregar Botones)-->
                            <td>
                                <!-- Carta|Editar|Eliminar -->
                                <!-- "btn btn-primary" / BOTON AZUL OSCURO -->
                                <!-- "btn btn-info" / BOTON AZUL CLARO -->
                                <!-- "btn btn-danger" / BOTO ROJO -->
                                <a class="btn btn-primary" href="carta.php?txtID=<?php echo $registro['id']?>" role="button">Carta</a> <!-- CONEXION - VINCULO -->
                                <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id']?>" role="button">Editar</a><!--bs5-button-a  <php echo $registro['id']?>  -->
                                <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']?>);" role="button">Eliminar</a><!--bs5-button-a  <php echo $registro['id']?>  -->
                            </td>
                        </tr>
                    <?php } ?> <!--BD- CICLO-->

                </tbody>
            </table>
        </div>
        
    </div>
</div>

<?php include("/xampp/htdocs/app/templates/footer.php");?> <!-- CONEXION - VINCULO -->


<!-- 
CREATE TABLE tbl_empleados (
    id INT AUTO_INCREMENT PRIMARY KEY,
    primernombre VARCHAR(255),
    segundonombre VARCHAR(255),
    primerapellido VARCHAR(255),
    segundoapellido VARCHAR(255),
    foto VARCHAR(255),
    cv VARCHAR(255),
    idpuesto INT,
    fechadeingreso DATE,
    FOREIGN KEY (idpuesto) REFERENCES tbl_puestos(id)
);
 -->