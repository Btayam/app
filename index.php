<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="shortcut icon" href="/app/ico/icono.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="index1.css">
</head>
<body>
    <?php include("/xampp/htdocs/app/templates/header.php"); ?>
    <br>
    <!-- Sección 1: Bienvenido al Sistema -->
    <section class="section">
        <div class="bannerInicio">
            <h1 class="custom-heading">Bienvenido al Sistema</h1>
        </div>
        <main class="main-content">
            <?php
                // Comprobar si el usuario ha iniciado sesión y mostrar su nombre
                if (isset($_SESSION['usuario'])) {
                    echo '<h2 class="custom-heading">Bienvenido, ' . $_SESSION['usuario'] . '.</h2>';
                }
            ?>
        </main>
    </section>

    <div class="contenedor">
        <!-- Sección 2: Formulario de consulta por código -->
        <section class="section">
            <h6>Consulta por Código</h6>
            <form action="/app/index.php" method="POST">
                <input type="text" name="COD_TER" id="COD_TER" placeholder="Introduzca el código" required>
                <input type="submit" value="Consultar">
            </form>
        </section>

        <!-- Sección 3: Resultados de la consulta -->
        <section class="section">
            <br><br>
            <h6>Resultados de la Consulta</h6>
            <?php
            // Incluir el archivo de conexión a la base de datos
            include("bd.php");

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Se recibió una solicitud POST
                $COD_TER = $_POST["COD_TER"];

                try {
                    // Preparar la consulta SQL para buscar al asociado por código
                    $sql = "SELECT * FROM tbl_terceros WHERE COD_TER = :cod_ter";
                    $stmt = $conexion->prepare($sql);
                    $stmt->bindParam(":cod_ter", $COD_TER, PDO::PARAM_INT);
                    $stmt->execute();

                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    if ($result) {
                        if (count($result) > 0) {
                            // Mostrar los resultados en una tabla
                            echo "<table>";
                            echo "<tr><th>COD_TER</th><th>NOM_TER</th><th>TEL</th><th>EMAIL</th><th>COD_DIST</th>";
                            foreach ($result as $row) {
                                echo "<tr>";
                                echo "<td>" . $row["COD_TER"] . "</td>";
                                echo "<td>" . $row["NOM_TER"] . "</td>";
                                echo "<td>" . $row["TEL"] . "</td>";
                                echo "<td>" . $row["EMAIL"] . "</td>";
                                echo "<td>" . $row["COD_DIST"] . "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "No se encontraron registros con el código proporcionado.";
                        }
                    } else {
                        echo "Error en la consulta: " . print_r($stmt->errorInfo(), true);
                    }
                } catch (PDOException $ex) {
                    echo "Error en la conexión: " . $ex->getMessage();
                }
            }
            ?>
        </section>

        <br><br>
        <a href="secciones/terceros/index.php" class="btn btn-primary">Terceros</a>
        <hr>
    </div>

    <?php include("templates/footer.php"); ?>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
