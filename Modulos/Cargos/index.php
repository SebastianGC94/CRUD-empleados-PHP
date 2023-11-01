<!-- Conexión a la base de datos -->
<?php include("../../conexion_db.php");

// Método para listar datos --> GET obtener datos por ID
if (isset($_GET['txtId'])) {

    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    //Sentencia para eliminar de la tabla cargos por id
    $sentencia = $conexion->prepare("DELETE FROM `cargos` WHERE id = :id");
    //Se iguala el id seleccionado con el id (variable del inicio)
    $sentencia->bindParam(":id", $txtId);
    //Se ejecuta la sentencia
    $sentencia->execute();
    $mensaje = "¡Registro Eliminado!";
    header("Location:index.php?mensaje=" . $mensaje);
}

$sentencia = $conexion->prepare("SELECT * FROM `cargos`");
$sentencia->execute();
$listaCargos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../Plantillas/header.php"); ?>
<br />

<!-- bs5-card-head-foot para crear tabla-->
<div class="card">
    <div class="card-header">
        <a name="btnAdd" id="btnAdd" class="btn btn-primary" href="crear.php" role="button">AGREGAR CARGO</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">DESCRIPCIÓN</th>
                        <th scope="col" class="text-center" style="width: 200px;">ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($listaCargos as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id']; ?></td>
                            <td scope="row"><?php echo $registro['descripcion']; ?></td>
                            <td class="d-flex justify-content-center">
                                <a name="btnEditar" id="btnEditar" class="btn btn-info" href="editar.php?txtId=<?php echo $registro['id']; ?>" role="button">Editar</a> |
                                <!-- Insertar función mostrarAlerta -->
                                <a name="btnEliminar" id="btnEliminar" class="btn btn-danger" href="javascript:mostrarAlerta(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>

            </table>
        </div>

    </div>
</div>
<?php include("../../Plantillas/footer.php"); ?>