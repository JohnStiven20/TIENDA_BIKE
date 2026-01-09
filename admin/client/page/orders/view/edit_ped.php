<?php

session_start();

include("../../../security/session.php");
include("../../../../db/db.inc");


$id_pedido = $_GET["edit"];
$sql_traer_pedido = "SELECT * FROM pedidos WHERE id = $id_pedido";
$res_pedido = mysqli_query($con, $sql_traer_pedido);
$pedido = mysqli_fetch_assoc($res_pedido);
$sql_traer_cliente = "SELECT * FROM clientes WHERE id=" . $pedido["id_cliente"];
$res_cliente = mysqli_query($con, $sql_traer_cliente);
$cliente = mysqli_fetch_assoc($res_cliente);
$sql_traer_linea_pedidos = "SELECT * FROM linea_pedido WHERE pedido_id=$id_pedido";
$res_linea_pedidos = mysqli_query($con, $sql_traer_linea_pedidos);
$linea_pedidos = mysqli_fetch_all($res_linea_pedidos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .header {
            background-color: blue !important;
            color: white !important;
        }
    </style>
</head>

<body>
    <input type="hidden" value="<?= $linea_pedidos ?>" id="cosa">

    <div class="container mt-5 card p-0">
        <header class="container header w-100">
            <h1 class="p-2">Registrar Pedido</h1>
        </header>
        <form class="container d-flex flex-column p-3 gap-3 w-100" action="../services/update.php" method="post">
            <div class="mb-3">
                <label for="cliente" class="form-label">Seleccionar Cliente</label>
                <select class="form-select" id="cliente" name="cliente_id">
                    <option value="<?= $cliente["id"] ?>" disabled selected><?= htmlspecialchars($cliente['nombre']) . ' ' . htmlspecialchars($cliente['apellidos']) . ' - ' . htmlspecialchars($cliente['email']) ?></option>
                </select>
            </div>
            <?php foreach ($linea_pedidos as $linea) { ?>
                <?php 
                $sql_traer_producto_concreto = "SELECT nombre, precio FROM productos WHERE id = " . $linea[2];
                $res_producto = mysqli_query($con ,$sql_traer_producto_concreto);
                $producto_concreto = mysqli_fetch_assoc($res_producto);
                ?>
                <div class="d-flex flex-row gap-2">
                    <input type="hidden" name="productos[]" value="<?= $linea[2] ?>">
                    <span><?= $producto_concreto["nombre"] ?> - $<?= $producto_concreto["precio"] ?> </span>
                    <label  class="form-label">Cantidad:</label>
                    <input type="number" name="cantidades[]" style="width: 70px;" class="form-control" value="<?= $linea[3] ?>" min="0" required>
                    <input type="hidden" value="<?= $producto_concreto["precio"] ?>" name="precios[]">
                    <input type="hidden" value="<?= $linea[0] ?>" name="linea-pedidos[]">
                    <input type="hidden" value="<?= $id_pedido ?>" name="id-pedido">
                </div>
            <?php } ?>
            <div class=" flex-row d-flex gap-3 w-100 mb-3">
                <div>
                    <button type="submit" class="btn btn-success" id="botonAgregar">Agregar Pedido</button>
                </div>
                <div>
                    <a href="../../../dashboard.php?page=pedidos" class="btn btn-secondary">Volver a la lista a pedido</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>