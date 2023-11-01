<?php include ("../../conexion_db.php");

// --> Seleccionar datos para editar
if(isset($_GET['txtId'])){

    $txtId = (isset($_GET['txtId'])?$_GET['txtId']:"");
    //Eliminar cargos por id
    $sentencia = $conexion->prepare("SELECT * FROM `cargos` WHERE id = :id");
    $sentencia->bindParam(":id",$txtId);
    //Ejecutar la sentencia
    $sentencia->execute();
    //fetch_lazy = solo carga un registro
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    $descripcion = $registro["descripcion"];
    
}

// Editar datos
if ($_POST){
    $descripcion = (isset($_POST["descripcion"])?$_POST["descripcion"]:"");
    $sentencia = $conexion->prepare("UPDATE  cargos SET descripcion=:descripcion WHERE id=:id");
    $sentencia->bindParam(":descripcion",$descripcion);
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $mensaje = "¡Registro Actualizado!";
    header("Location:index.php?mensaje=".$mensaje);
}

?>


<?php include("../../Plantillas/header.php"); ?>
<br/>

<div class="card">
    <div class="card-header">
        DATOS DEL CARGO
    </div>
    <div class="card-body">

        <!-- enctype permite adjuntar archivo en el formulario -->
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5-form-input -->
            <div class="mb-3">
                <label for="txtId" class="form-label">Id</label>
                <input type="text" value="<?php echo $txtId ;?>" class="form-control" readonly name="txtId" id="txtId" aria-describedby="helpId" placeholder="">
            </div>

          <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" value="<?php echo $descripcion ;?>" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="ingrese una descripción">
            </div>


            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>



        </form>
    </div>

<?php include("../../Plantillas/footer.php"); ?>
