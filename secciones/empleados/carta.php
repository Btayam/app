<?php
include("/xampp/htdocs/app/bd.php"); // Incluye la conexión a la base de datos

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : ""; // Validación si se proporciona un ID

    $sentencia = $conexion->prepare("SELECT *,(SELECT nombredelpuesto 
    FROM tbl_puestos 
    WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre = $registro["primernombre"];
    $segundonombre = $registro["segundonombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];

    $nombreCompleto = $primernombre . " " . $segundonombre . " " . $primerapellido . " " . $segundoapellido;

    $puesto = $registro["puesto"];
}
ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificado Laboral</title>
</head>

<body>
    <h1>Certificado Laboral</h1>
    <br><br>
    Bogotá D.C. Colombia a <strong> <?php echo date('d M Y'); ?> </strong>
    <br><br>
    Certificamos que:
    <br><br>
    <strong> <?php echo $nombreCompleto; ?> </strong>
    <br><br>
    Actualmente se desempeña en nuestra empresa en el cargo de <strong> <?php echo $puesto; ?> </strong>.
    <br><br>
    Este certificado tiene como propósito informar que <strong> <?php echo $nombreCompleto; ?> </strong> es un empleado
    activo de nuestra empresa y está contribuyendo positivamente a nuestro equipo.
    <br><br>
    Extendemos nuestros mejores deseos para su éxito continuo en su puesto actual.
    <br><br><br><br><br><br><br><br>
    _________________________________ <br>
    <strong> Firma y Sello de la Empresa </strong>
</body>

</html>

<?php
$HTML = ob_get_clean();

require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnable" => true));

$dompdf->setOptions($opciones);
$dompdf->loadHTML($HTML);

$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("Certificado_Laboral.pdf", array("Attachment" => false));

?>
