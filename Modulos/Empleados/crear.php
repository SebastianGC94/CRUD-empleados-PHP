<?php include("../../conexion_db.php");

if ($_POST) {
    // Se definen los mismos campos de la tabla del formulario
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $apellido = (isset($_POST["apellido"]) ? $_POST["apellido"] : "");
    $identificacion = (isset($_POST["identificacion"]) ? $_POST["identificacion"] : "");
    $idCargo = (isset($_POST["idCargo"]) ? $_POST["idCargo"] : "");
    $fechaIngreso = (isset($_POST["fechaIngreso"]) ? $_POST["fechaIngreso"] : "");
    $foto = (isset($_FILES["foto"]["name"]) ? $_FILES["foto"]["name"] : "");
    $cv = (isset($_FILES["cv"]["name"]) ? $_FILES["cv"]["name"] : "");

    //Obtener tiempo de la foto --> evita sobreescribir archivos
    $fecha_foto = new DateTime();
    $nombre_nueva_foto = ($foto !='')?$fecha_foto->getTimestamp()."_".$_FILES["foto"]["name"]:'';
    //Archivo binario temporal para subir la foto
    $tmp_foto = $_FILES["foto"]["tmp_name"];
    if ($tmp_foto!='') {
        move_uploaded_file($tmp_foto,"./".$nombre_nueva_foto);
    }

    $fecha_cv = new DateTime();
    $nombre_nuevo_cv = ($cv !='')?$fecha_cv->getTimestamp()."_".$_FILES["cv"]["name"]:'';
    $tmp_cv = $_FILES["cv"]["tmp_name"];
    if ($tmp_cv!='') {
        move_uploaded_file($tmp_cv,"./".$nombre_nuevo_cv);
    }

    //Inserción de datos
    $sentencia = $conexion->prepare("INSERT INTO empleados (id, nombre, apellido, identificacion, idCargo, fechaIngreso,
    foto, cv) VALUES (null, :nombre, :apellido, :identificacion, :idCargo, :fechaIngreso, :foto, :cv)");
    //Asignar valores 
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":apellido", $apellido);
    $sentencia->bindParam(":identificacion", $identificacion);
    $sentencia->bindParam(":idCargo", $idCargo);
    $sentencia->bindParam(":fechaIngreso", $fechaIngreso);
    $sentencia->bindParam(":foto", $nombre_nueva_foto);
    $sentencia->bindParam(":cv", $nombre_nuevo_cv);

   $sentencia->execute();
   $mensaje = "¡Registro Creado!";
   header("Location:index.php?mensaje=".$mensaje);

}

$sentencia = $conexion->prepare("SELECT * FROM `cargos`");
$sentencia->execute();
$listaCargos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../Plantillas/header.php"); ?>
<br>

<div class="card">
    <div class="card-header">
        DATOS DEL EMPLEADO
    </div>
    <div class="card-body">

        <!-- enctype permite adjuntar archivo en el formulario -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre (s)</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="ingrese su nombre">
            </div>

            <div class="mb-3">
                <label for="apellido" class="form-label">Apellido (s)</label>
                <input type="text" class="form-control" name="apellido" id="apellido" aria-describedby="helpId" placeholder="ingrese su apellido">
            </div>

            <div class="mb-3">
                <label for="identificacion" class="form-label">Identificación</label>
                <input type="text" class="form-control" name="identificacion" id="identificacion" aria-describedby="helpId" placeholder="ingrese su número de identificación">
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">↑ Foto</label>
                <input type="file" class="form-control" name="foto" id="foto" aria-describedby="fileHelpId" placeholder="foto">
            </div>

            <div class="mb-3">
                <label for="cv" class="form-label">↑ CV (pdf)</label>
                <input type="file" class="form-control" name="cv" id="cv" aria-describedby="fileHelpId" placeholder="cv">
            </div>

            <!-- bs5-form-select-custom -->
            <div class="mb-3">
                <label for="idCargo" class="form-label">Cargo</label>

                <select class="form-select form-select-sm" name="idCargo" id="idCargo">
                    <?php foreach ($listaCargos as $registro) { ?>
                        <option value="<?php echo $registro['id'] ?>">
                            <?php echo $registro['descripcion'] ?>
                        </option>

                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="fechaIngreso" class="form-label">Fecha de Ingreso</label>
                <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" aria-describedby="dateHelpId" placeholder="fechaIngreso">
            </div>

            <button type="submit" class="btn btn-success">Guardar Registro</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>
    </div>
    <div class="card-footer text-muted">
        Footer
    </div>
</div>

<?php include("../../Plantillas/footer.php"); ?>