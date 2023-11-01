<?php
// Manejo de sesiones
session_start();

// verificar si funciona el submit --> print_r($_POST)

if ($_POST) {
    include("./conexion_db.php");

    $sentencia = $conexion->prepare("SELECT COUNT(*) as total_usuarios 
    FROM `usuarios` 
    WHERE nombre=:nombre 
    AND contrasena=:contrasena");

    $nombre = $_POST["nombre"];
    $contrasena = $_POST["contrasena"];

    $sentencia->bindParam(":nombre", $nombre);
    $sentencia->bindParam(":contrasena", $contrasena);

    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    if ($registro["total_usuarios"] > 0) {
        $_SESSION["nombre"] = $registro["nombre"];
        $_SESSION["logueado"] = true;
        header("Location:index.php");
    } else {
        $mensaje = "El usuario o la contraseña son incorrectos";
    }
}
?>;


<!doctype html>
<html lang="en">

<head>
    <title>LOGIN</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>

    <main class="container">
        <br>

        <div class="row">
            <div class="col-md-4">

            </div>
            <br /></br>

            <div class="col-md-4">
                <!--bs5 card-head-foot -->
                <div class="card">
                    <div class="card-header">
                        LOGIN
                    </div>
                    <div class="card-body">

                        <?php if (isset($mensaje)) { ?>
                            <div class="alert alert-danger" role="alert">
                                <strong><?php echo $mensaje; ?></strong>
                            </div>
                            <?php } ?>


                            <form action="" method="post">
                                <!-- bs5 form input -->
                                <div class="mb-3">
                                    <label for="nombre" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="ingrese su usuario">
                                    <!--  Colocar texto de ayuda adicional 
                            <small id="helpId" class="form-text text-muted">Help text</small> -->
                                </div>

                                <div class="mb-3">
                                    <label for="contrasena" class="form-label">Contraseña</label>
                                    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="">
                                    <!-- <small id="helpId" class="form-text text-muted">Help text</small> -->
                                </div>

                                <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>


                </div>

            </div>

    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</body>

</html>