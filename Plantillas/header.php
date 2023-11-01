<!-- Bs5-$ para trabajar con bootstrap y poner código html-->

<!-- url base para evitar error al entrar a las secciones desde la misma sección -->
<?php
session_start();
$url_base = "http://localhost/AppEmpleados/";
// evitar que ingrese a otras ventanas un usuario inactivo
if(isset($_SESSION["nombre"])){
    header("Location:".$url_base."login.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- código de integración de jquery (minified) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- Instalación de los datatables (manual installation) arriba de local installation -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.js"></script>

    <!-- Instalación de sweetalert2 para mensajes emergentes personalizado-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <header>
        <!-- place navbar here -->
    </header>
    <!-- bs5-navbar-minimal-ul BARRA DE NAVEGACIÓN MENU SISTEMA-->
    <nav class="navbar navbar-expand navbar-light bg-light">
        <ul class="nav navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" href="#" aria-current="page">SISTEMA<span class="visually-hidden">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>Modulos/Empleados/">EMPLEADOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>Modulos/Cargos/">CARGOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>Modulos/Usuarios/">USUARIOS</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo $url_base; ?>cerrarSesion.php">CERRAR SESIÓN</a>
            </li>
        </ul>
    </nav>

    <!-- Código para mostrar el mensaje de confirmación según las selecciones del usuario -->
    <?php if (isset($_GET['mensaje'])) { ?>
        <script>
            Swal.fire({
                icon: "success",
                title: "<?php echo $_GET['mensaje']; ?>"
            });
        </script>
    <?php } ?>
    
    <main class="container">