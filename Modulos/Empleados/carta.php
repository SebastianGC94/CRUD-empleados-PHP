<?php include("../../conexion_db.php");

if (isset($_GET['txtId'])) {

    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    $sentencia = $conexion->prepare("SELECT *, 
    (SELECT descripcion FROM cargos 
    WHERE cargos.id = empleados.idCargo LIMIT 1 ) as cargo FROM `empleados` WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $apellido = $registro["apellido"];
    $nombreCompleto = $nombre . " " . $apellido;

    $identificacion = $registro["identificacion"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idCargo = $registro["idCargo"];
    $cargo = $registro["cargo"];
    $fechaIngreso = $registro["fechaIngreso"];


    //Campo Fecha Carta
    $fechaCreacionCarta = new DateTime();
    $fechaFormateada = $fechaCreacionCarta->format('d/m/Y');
    //Campo Fecha Duración
    $fechaInicio = new DateTime($fechaIngreso);
    $fechaFin = new DateTime(date('Y-m-d'));
    $diferencia = date_diff($fechaInicio, $fechaFin);

    $empresa = "Code Verse Corp.";
}
ob_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Carta de Recomendación Laboral</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Carta de Recomendación Laboral</h1>
            <br>
        </div>

        <div class="content">
            <p>Fecha: <strong> <?php echo $fechaFormateada; ?></strong></p>
            <br>

            <p>A quien pueda interesar,</p>
            <br>

            <p>Me complace recomendar encarecidamente a el(la) señor(a) <strong> <?php echo $nombreCompleto; ?></strong> quien apoyó los procesos de <strong> <?php echo $empresa; ?></strong> por un periodo de <strong> <?php echo $diferencia->y; ?></strong> año(s). He tenido el placer de trabajar con <strong> <?php echo $nombreCompleto; ?></strong> y durante ese tiempo he quedado impresionado por su dedicación, habilidades y ética profesional.</p>

            <p>El(la) señor(a)<strong> <?php echo $nombreCompleto; ?></strong> se desempeñó en el cargo de <strong> <?php echo $cargo; ?></strong> y ha demostrado un alto nivel de competencia en el campo. Además, es una persona con la que es un placer trabajar, siempre dispuesto(a) en asumir responsabilidades adicionales y colaborar con el equipo de manera efectiva.</p>

            <p>Estoy seguro de que <strong> <?php echo $nombreCompleto; ?></strong> será un activo valioso para cualquier organización y no dudo en recomendarlo(a). Si surge alguna pregunta o se requiere más información, estaré atento.</p>
            <br></br>

            <p>Cordialmente,</p>
            <br>
            <p><strong>Gerencia <?php echo $empresa; ?></strong></p>
            <p><strong>Colombia</strong></p>
            <p><strong>2023</strong></p>

        </div>
    </div>
</body>

</html>

<!-- Descargar Dompdf de github -- releases -- archivo zip descomprimir en Lib o Librerias -->
<!-- Incluir archivo de Libreria para convertir html -> pdf -->
<?php
// Recolecta datos del html
$HTML = ob_get_clean();
require_once("../../Librerias/dompdf/autoload.inc.php");

use Dompdf\Dompdf;
// Config del Dompdf
$dompdf = new Dompdf();

$opciones = $dompdf->getOptions();
$opciones->set(array("isRemoteEnabled" => true));

$dompdf->setOptions($opciones);
$dompdf->loadHTML($HTML);
$dompdf->setPaper('letter');
$dompdf->render();
$dompdf->stream("archivo.pdf", array("Attachment" => false));


?>