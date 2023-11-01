<?php include("../../conexion_db.php");

if (isset($_GET['txtId'])) {

    $txtId = (isset($_GET['txtId']) ? $_GET['txtId'] : "");
    // Buscar el archivo relacionado con el empleado
    $sentencia = $conexion->prepare("SELECT foto,cv FROM `empleados` WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $registro_recuperado= $sentencia->fetch(PDO::FETCH_LAZY);

    if( isset($registro_recuperado["foto"]) && $registro_recuperado["foto"]!= ""){
        if(file_exists("./".$registro_recuperado["foto"])){
            unlink("./".$registro_recuperado["foto"]);
        }
    }

    if( isset($registro_recuperado["cv"]) && $registro_recuperado["cv"]!= ""){
        if(file_exists("./".$registro_recuperado["cv"])){
            unlink("./".$registro_recuperado["cv"]);
        }
    }

    $sentencia = $conexion->prepare("DELETE FROM empleados WHERE id=:id");
    $sentencia->bindParam(":id",$txtId);
    $sentencia->execute();
    $mensaje = "¡Registro Eliminado!";
    header("Location:index.php?mensaje=".$mensaje);


    header ("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT *, 
(SELECT descripcion FROM cargos WHERE cargos.id = empleados.idCargo ) as cargo
 FROM empleados ");
$sentencia->execute();
$listaEmpleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../Plantillas/header.php"); ?>

<br />

<!-- bs5-card-head-foot para crear tabla-->
<div class="card">
    <div class="card-header">
        <a name="btnAdd" id="btnAdd" class="btn btn-primary" href="crear.php" role="button">AGREGAR EMPLEADO</a>
    </div>

    <div class="card-body">
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id" >
                <thead>
                    <tr>
                        <th scope="col" class="text-center">Id</th>
                        <th scope="col" class="text-center">NOMBRE</th>
                        <th scope="col" class="text-center">IDENTIFICACIÓN</th>
                        <th scope="col" class="text-center">FOTO</th>
                        <th scope="col" class="text-center">CV</th>
                        <th scope="col" class="text-center">CARGO</th>
                        <th scope="col" class="text-center">FECHA DE INGRESO</th>
                        <th scope="col" class="text-center">ACCIONES</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($listaEmpleados as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php echo $registro['id']; ?></td>
                            <td scope="row"><?php echo $registro['nombre']; ?>
                                <?php echo $registro['apellido']; ?></td>

                            <td scope="row"><?php echo $registro['identificacion']; ?></td>

                            <td>
                                <img width="50" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="" />
                            </td>

                            <td> 
                                <a href="<?php echo $registro['cv'];?>">
                                <?php echo $registro['cv'];?></a>
                            </td>

                            <td scope="row"><?php echo $registro['cargo']; ?></td>

                            <td scope="row"><?php echo $registro['fechaIngreso']; ?></td>

                            <td class="d-flex justify-content-between">
                                <a name="btnCarta" id="btnCarta" class="btn btn-success" href="carta.php?txtId=<?php echo $registro['id']; ?>" role="button">Carta</a>  |
                                <a name="btnEditar" id="btnEditar" class="btn btn-info" href="editar.php?txtId=<?php echo $registro['id']; ?>" role="button">Editar</a>  |
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