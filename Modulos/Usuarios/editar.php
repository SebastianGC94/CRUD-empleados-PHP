<?php include("../../conexion_db.php");

// --> Para seleccionar los datos de lo que se editará
if (isset($_GET['txtId'])) {

    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    //Sentencia para eliminar de la tabla usuarios por id
    $sentencia = $conexion->prepare("SELECT * FROM `usuarios` WHERE id = :id");
    //Se iguala el id seleccionado con el id (variable inicial)
    $sentencia->bindParam(":id", $txtId);
    //Se ejecuta la sentencia
    $sentencia->execute();
    //fetch_lazy hace que solo se carge un registro
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $nombre = $registro["nombre"];
    $correo = $registro["correo"];
    $contrasena = $registro["contrasena"]; 
}
// --> Para editar los datos seleccionados
if ($_POST) {
    //Recolectar y validar datos del método (formulario)
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    $contrasena = (isset($_POST["contrasena"]) ? $_POST["contrasena"] : "");
    //Inserción de datos
    $sentencia = $conexion->prepare("UPDATE  usuarios SET nombre=:nombre, correo=:correo, contrasena=:contrasena WHERE id=:id");
    //Asignar valores 
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":contrasena", $contrasena);
    $sentencia->bindParam(":id", $txtId);
    $sentencia->execute();
    $mensaje = "¡Registro Actualizado!";
    header("Location:index.php?mensaje=".$mensaje);
}

?>



<?php include("../../Plantillas/header.php"); ?>

<br />

<div class="card">
    <div class="card-header">
        DATOS DEL USUARIO
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
                <label for="nombre" class="form-label">Nombre de Usuario</label>
                <input type="text" value="<?php echo $nombre; ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="ingrese un nombre de usuario">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" value="<?php echo $correo; ?>" class="form-control" name="correo" id="correo" aria-describedby="emailHelpId" placeholder="ingrese un correo electrónico">
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" value="<?php echo $contrasena; ?>" class="form-control" name="contrasena" id="contrasena" aria-describedby="passwordHelpId" placeholder="ingrese una contraseña">
            </div>


            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>
    </div>

    <?php include("../../Plantillas/footer.php"); ?>