<!-- para insertar el header en todas las ventanas del sistema -->
<?php include("Plantillas/header.php"); ?>
<br>



<!--bs5 jumbodron ver estructura del contenedor-->
<div class="p-5 mb-4 bg-light rounded-3">
    <div class="container-fluid py-5">
        <h1 class="display-5 fw-bold">¡Bienvenido!</h1>
        <p class="col-md-8 fs-4"><?php echo $_SESSION["nombre"]; ?></p>
        <a name="" id="" class="btn btn-success" href="./Modulos/Empleados/index.php" role="button">Continuar</a>
    </div>
</div>

<!-- para insertar el footer en todas las ventanas del sistema -->
<?php include("Plantillas/footer.php"); ?>

