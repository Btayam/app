<?php
// Incluye el archivo de conexión a la base de datos
include("bd.php");
var_dump("holaaaaaaaaaa1");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Se recibió una solicitud POST
    
    echo "entro if";
    var_dump($_POST["COD_TER"]);
    $COD_TER = $_POST["COD_TER"];
    var_dump($COD_TER);
    var_dump("holaaaaaaaaaa2");
    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    // Consulta SQL para buscar al asociado por código
    $sql = "SELECT * FROM tbl_terceros WHERE COD_TER = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $COD_TER); // "i" indica que es un valor entero
    $stmt->execute();
    $result = $stmt->get_result();
        
        if ($result) {
            if ($result->num_rows > 0) {
                // Mostrar los resultados en una tabla
                echo "<table border='1'>";
                echo "<tr><th>Carpeta Física</th><th>Código</th><th>Nombre</th><th>Teléfono</th><th>Correo</th><th>Distrito</th><th>Fecha de Actualización</th></tr>";
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["ID"] . "</td>";
                    echo "<td>" . $row["COD_TER"] . "</td>";
                    echo "<td>" . $row["NOM_TER"] . "</td>";
                    echo "<td>" . $row["TEL"] . "</td>";
                    echo "<td>" . $row["EMAIL"] . "</td>";
                    echo "<td>" . $row["COD_DIST"] . "</td>";
                    echo "<td>" . $row["FECHA_ACTUALIZACION"] . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No se encontraron registros con el código proporcionado.";
            }
        } else {
            echo "Error en la consulta: " . $conexion->error;
        }
        
        $stmt->close();
        $conexion->close();
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido al Sistema</title>
    <link rel="shortcut icon" href="icono.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="style_01.css">
</head>
<body>
    <div class="contenedor">
        <div class="header">
            <h1 class="custom-heading">Bienvenido al Sistema</h1>
            <p class="custom-text">"La plataforma de trabajo eficiente y segura desarrollada por Corpentunida."</p>
            <form action="http://192.168.10.140/app/index.php" method="POST">
                <input type="text" name="COD_TER" id="COD_TER" placeholder="Introduzca el código" required>
                <input type="submit" value="Consultar">
            </form>
        </div>

        <div class="main-content">
            <?php
            // Comprobar si el usuario ha iniciado sesión y mostrar su nombre
            if (isset($_SESSION['usuario'])) {
                echo '<h2 class="custom-heading">bienvenido, ' . $_SESSION['usuario'] . '.</h2>';
            }
            ?>
            <p class="custom-text">Bienvenido al sistema. Estamos aquí para ayudarte en tus tareas diarias.</p>
            <a href="secciones/terceros/index.php" class="btn btn-primary">Ir al Inicio</a>
        </div>
    </div>

    <?php include("templates/footer.php"); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
