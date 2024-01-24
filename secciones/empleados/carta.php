<?php
require_once("../../libs/autoload.inc.php");
use Dompdf\Dompdf;

include("/xampp/htdocs/app/bd.php"); // CONEXION - BASE DE DATOS

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT *, (SELECT nombredelpuesto FROM tbl_puestos WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if ($registro) {
        $primernombre = $registro["primernombre"];
        $segundonombre = $registro["segundonombre"];
        $primerapellido = $registro["primerapellido"];
        $segundoapellido = $registro["segundoapellido"];

        $nombreCompleto = $primernombre . " " . $segundonombre . " " . $primerapellido . " " . $segundoapellido;

        $fechadeingreso = $registro["fechadeingreso"];
        $fechaInicio = new DateTime($fechadeingreso);
        $fechaFin = new DateTime(date('Y-m-d'));
        $diferencia = date_diff($fechaInicio, $fechaFin);

        ob_start();
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Carta de recomendación</title>
        </head>
        <body>
            <h1>Carta de recomendación Laboral</h1>
            <br><br>
            Bogotá D.C. Colombia a <strong><?php echo date('d M Y'); ?></strong>
            <br><br>
            A quien pueda interesar:
            <br><br>
            Reciba un cordial y respetuoso saludo.
            <br><br>
            A través de estas líneas deseo hacer de su conocimiento que Sr.(a) <strong><?php echo $nombreCompleto; ?></strong>,
            quien laboró en la (Asociación Gremial de Ministros de la IPUC) durante <strong><?php echo $diferencia->y; ?> año(s)</strong>
            Es un placer recomendar a esta persona, tanto a nivel personal como profesional. Destacada por su actitud
            positiva, habilidad para resolver problemas y dedicación al equipo. Comunica de manera clara y concisa,
            aportando iniciativa y creatividad. Su ética de trabajo y compromiso son ejemplares. Sin duda, sería un
            gran activo para cualquier proyecto o equipo.
            <br><br>
            Durante estos años se ha desempeñado como: <strong><?php echo $registro["puesto"]; ?></strong>
            Es por ello le sugiero, considere esta recomendación, con la confianza de que estará siempre a la altura de sus compromisos y responsabilidades.
            <br><br>
            Sin más nada a que referirme y esperando que esta misiva sea tomada en cuenta, dejo mi número de contacto para cualquier información de interés.
            <br><br><br><br><br><br><br><br>
            _________________________________ <br>
            <strong> Atentamente, </strong>
            <br>
            Carlos Andrés Vásquez
            <br>
            Gerente Administrativo.
        </body>
        </html>

        <?php
        $HTML = ob_get_clean();

        $dompdf = new Dompdf();
        $opciones = $dompdf->getOptions();
        $opciones->set(array("isPhpEnabled" => true, "isRemoteEnable" => true, "debug" => true));

        $dompdf->setOptions($opciones);
        $dompdf->loadHtml($HTML);

        $dompdf->setPaper('letter');
        $dompdf->render();
        $dompdf->stream("archivo.pdf", array("Attachment" => false));

    } else {
        echo "El ID proporcionado no se encuentra en la base de datos.";
    }
} else {
    echo "No se proporcionó un ID en la URL.";
}
?>
