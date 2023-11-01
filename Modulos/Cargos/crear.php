<?php include("../../conexion_db.php");

if ($_POST) {
    print_r($_POST);
    //Recolectar y validar datos formulario
    $descripcion = (isset($_POST["descripcion"]) ? $_POST["descripcion"] : "");
    //Insertar datos
    $sentencia = $conexion->prepare("INSERT INTO cargos (id, descripcion) VALUES (null, :descripcion)");
    //Asignar valores 
    $sentencia->bindParam(":descripcion", $descripcion);
    $sentencia->execute();
    $mensaje = "¡Registro Creado!";
    header("Location:index.php?mensaje=".$mensaje);
}
?>

<?php include("../../Plantillas/header.php"); ?>
<br />

<div class="card">
    <div class="card-header">
        DATOS DEL CARGO
    </div>

    <div class="card-body">
        <!-- enctype = trabajar con archivos-->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="ingrese una descripción">
            </div>

            <button type="submit" class="btn btn-success">Guardar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>
        </form>
    </div>

    <?php include("../../Plantillas/footer.php"); ?>