<?php
include("/xampp/htdocs/app/bd.php");// CONEXION - BASE DE DATOS
//recoleccion y verificacion de datos + istruccion de borrar
    if(isset( $_GET['txtID'] )){
        //validacion si
        $txtID=(isset( $_GET['txtID'] ))?( $_GET['txtID'] ):"";
        //tomado del crear.php
        $sentencia=$conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
        //tomado del crear.php
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $mensaje = "Registro eliminado";
        header("Location:index.php?mensaje=".$mensaje);//nos devuelve al index redireccionar
    }
$sentencia=$conexion->prepare("SELECT * FROM `tbl_puestos`"); //BD
$sentencia->execute();//ejecuta los registros
$lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
// el sigiente se empleo para verificacion ((print_r($lista_tbl_puestos);))  // la sentencia se esta  ejecutando
// copiamos esto () y lo llevamos a la parte de abajo donde encontramos los registros
?>
<!-- - -->
<?php include("/xampp/htdocs/app/templates/header.php");?>
<br>
<!--bs5-card-head-foot-->
<div class="card">
    <div class="card-header">
        <!--bs5-button-a-->
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Puesto</a> <!-- CONEXION - VINCULO -->
    </div>
    <div class="card-body">
        <!--bs5-table-default-->
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($lista_tbl_puestos as $registro){ ?>
                            <tr class="">
                                <td scope="row"> <?php echo $registro['id']?> </td>
                                <td> <?php echo $registro['nombredelpuesto']?> </td>

                                <!--bs5-button-input (Agregar Botones)-->
                                <!-- "btn btn-info" color azul claro-->
                                <!-- "btn btn-danger" color rojo-->
                                <td>
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

<?php include("/xampp/htdocs/app/templates/footer.php");?>


<!-- 
CREATE TABLE tbl_puestos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombredelpuesto VARCHAR(255) NOT NULL
);
 -->