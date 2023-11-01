<?php include("../../conexion_db.php");

/*Este código permite ver en la url lo que se envía
    if ($_POST){
    print_r($_POST);
} */

if ($_POST) {
    //Recolectar y validar datos del método (formulario)
    $nombre = (isset($_POST["nombre"]) ? $_POST["nombre"] : "");
    $correo = (isset($_POST["correo"]) ? $_POST["correo"] : "");
    $contrasena = (isset($_POST["contrasena"]) ? $_POST["contrasena"] : "");
    //Inserción de datos
    $sentencia = $conexion->prepare("INSERT INTO usuarios (id, nombre, correo, contrasena) VALUES (null, :nombre,:correo, :contrasena)");
    //Asignar valores 
    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->bindParam(":contrasena", $contrasena);

    $sentencia->execute();
    $mensaje = "¡Registro Creado!";
    header("Location:index.php?mensaje=".$mensaje);
}

?>

<?php include("../../Plantillas/header.php"); ?>
<br>

<div class="card">
    <div class="card-header">
        DATOS DEL USUARIO
    </div>
    <div class="card-body">

        <!-- enctype permite adjuntar archivo en el formulario -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de Usuario</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="ingrese un nombre de usuario">
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="EmailHelpId" placeholder="ingrese un correo electrónico">
            </div>

            <div class="mb-3">
                <label for="contrasena" class="form-label">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" aria-describedby="PasswordHelpId" placeholder="ingrese una contraseña">
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