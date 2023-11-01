<?php include("../../conexion_db.php");

if (isset($_GET['txtId'])) {

    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    $sentencia = $conexion->prepare("SELECT * FROM `empleados` WHERE id = :id");
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $nombre = $registro["nombre"];
    $apellido = $registro["apellido"];
    $identificacion = $registro["identificacion"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
    $idCargo = $registro["idCargo"];
    $fechaIngreso = $registro["fechaIngreso"];
}

if ($_POST) {
    $txtId = (isset($_POST['txtId']) ? $_POST['txtId'] : "");
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
    $identificacion = (isset($_POST["identificacion"]) ? $_POST["identificacion"] : "");
    $idCargo = (isset($_POST["idCargo"]) ? $_POST["idCargo"] : "");
    $fechaIngreso = (isset($_POST["fechaIngreso"]) ? $_POST["fechaIngreso"] : "");

    $sentencia = $conexion->prepare("UPDATE  empleados SET nombre=:nombre, apellido=:apellido, 
    identificacion=:identificacion, idCargo=:idCargo, fechaIngreso=:fechaIngreso WHERE id=:id");

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido", $apellido);
    $sentencia->bindParam(":identificacion", $identificacion);
    $sentencia->bindParam(":idCargo", $idCargo);
    $sentencia->bindParam(":fechaIngreso", $fechaIngreso);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $mensaje = "¡Registro Actualizado!";
    header("Location:index.php?mensaje=".$mensaje);

    $foto = (isset($_FILES["foto"]) ? $_FILES["foto"] : "");
    $fecha_foto = new DateTime();
    $nombre_nueva_foto = ($foto != '') ? $fecha_foto->getTimestamp() . "_" . $_FILES["foto"]["name"] : '';
    $tmp_foto = $_FILES["foto"]["tmp_name"];

    if ($tmp_foto != '') {
        move_uploaded_file($tmp_foto, "./" . $nombre_nueva_foto);
        $sentencia = $conexion->prepare("SELECT foto FROM `empleados` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
            if (file_exists("./" . $registro_recuperado["foto"])) {
                unlink("./" . $registro_recuperado["foto"]);
            }
        }
        $sentencia = $conexion->prepare("UPDATE empleados SET foto=:foto WHERE id=:id");
        $sentencia->bindParam(":foto", $nombre_nueva_foto);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $mensaje = "¡Registro Actualizado!";
        header("Location:index.php?mensaje=".$mensaje);
    }

    $cv = (isset($_FILES["cv"]) ? $_FILES["cv"] : "");
    $fecha_cv = new DateTime();
    $nombre_nuevo_cv = ($cv != '') ? $fecha_cv->getTimestamp() . "_" . $_FILES["cv"]["name"] : '';
    $tmp_cv = $_FILES["cv"]["tmp_name"];
    if ($tmp_cv != '') {
        move_uploaded_file($tmp_cv, "./" . $nombre_nuevo_cv);

        $sentencia = $conexion->prepare("SELECT cv FROM `empleados` WHERE id=:id");
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY);

        if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
            if (file_exists("./" . $registro_recuperado["cv"])) {
                unlink("./" . $registro_recuperado["cv"]);
            }
        }
        $sentencia = $conexion->prepare("UPDATE empleados SET cv=:cv WHERE id=:id");
        $sentencia->bindParam(":cv", $nombre_nuevo_cv);
        $sentencia->bindParam(":id", $txtId);
        $sentencia->execute();
        $mensaje = "¡Registro Actualizado!";
        header("Location:index.php?mensaje=".$mensaje);
    }
    //header("Location:index.php");
}
// Para cargar los Cargos
$sentencia = $conexion->prepare("SELECT * FROM `cargos`");
$sentencia->execute();
$listaCargos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>


<?php include("../../Plantillas/header.php"); ?>

<div class="card">
    <div class="card-header">
        DATOS DEL EMPLEADO
    </div>
    <div class="card-body">

        <!-- enctype permite adjuntar archivo en el formulario -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
                <label for="txtId" class="form-label">Id</label>
                <input type="text" value="<?php echo $txtId; ?>" class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre (s)</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="ingrese su nombre">
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido (s)</label>
                <input type="text" value="<?php echo $apellido; ?>" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="ingrese su apellido">
            </div>

            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación</label>
                <input type="text" value="<?php echo $identificacion; ?>" class="form-control" name="identificacion" id="identificacion" aria-describedby="helpId" placeholder="ingrese su número de identificación">
            </div>


            <div class="mb-3">
                <label for="foto" class="form-label">↑ Foto</label>
                <br />

                <!-- Se imprime fuera del input la foto para ver lo que se envió -->
                <img width="100" src="<?php echo $foto; ?>" class="rounded" alt="" />
                <br /> <br />

                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="fileHelpId" placeholder="foto">
            </div>
            <br />

            <div class="mb-3">
                <label for="cv" class="form-label">↑ CV (pdf)</label>
                <br />
                <!-- Se imprime fuera del input el cv para ver lo que se envió -->
                CV actual: <a href="<?php echo $cv; ?>"><?php echo $cv; ?></a>
                <br /> <br />
                <input type="file" class="form-control" name="cv" id="cv" aria-describedby="fileHelpId" placeholder="cv">
            </div>

            <!-- bs5-form-select-custom -->
            <div class="mb-3">
                <label for="idCargo" class="form-label">Cargo</label>
                <!-- Acá solo se debe seleccionar el dato que estaba guardado (no toda la lista) -->
                <select class="form-select form-select-sm" name="idCargo" id="idCargo">
                    <?php foreach ($listaCargos as $registro) { ?>

                        <!-- ---recuperar descripcion del cargo que tenia -->
                        <option <?php echo ($idCargo == $registro['id']) ? "selected" : "" ?> value="<?php echo $registro['id'] ?>">
                            <?php echo $registro['descripcion'] ?>
                        </option>

                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                <input type="date" value="<?php echo $fechaIngreso; ?>" class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="dateHelpId" placeholder="fechaIngreso">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>
<?php include("../../Plantillas/footer.php"); ?>