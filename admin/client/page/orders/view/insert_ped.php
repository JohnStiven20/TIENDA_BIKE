<?php

session_start();

include("../../../security/session.php");
include("../../../../db/db.inc");


$sql_traer_todos = "SELECT * FROM clientes";
$res_traer_todos = mysqli_query($con, $sql_traer_todos);
$clientes = mysqli_fetch_all($res_traer_todos, MYSQLI_ASSOC);

$sql_trer_productos = "SELECT * FROM productos";
$res_traer_productos = mysqli_query($con, $sql_trer_productos);
$productos = mysqli_fetch_all($res_traer_productos, MYSQLI_ASSOC);

$cliente_actual = "";



if (isset($_SESSION["lista_pedidos"]) && count($_SESSION["lista_pedidos"]) > 0) {



    $lista = $_SESSION['lista_pedidos'];
    $ids = implode(',', array_map('intval', $lista));

    $sql_productos = "SELECT * FROM productos WHERE id IN ($ids)";

    $res = mysqli_query($con, $sql_productos);

    $productosEligidos = mysqli_fetch_all($res);
}


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
    <div class="container mt-5 card p-0">

        <?php if (isset($_GET["error"]) && !empty($_GET["error"])) { ?>
            <?php
            $valor = $_GET["error"];
            ?>

            <?php if ($valor == 1) {  ?>
                <div class="btn btn-danger mb-1">
                    <p>Formato de correo incorrecto</p>
                </div>
            <?php } else if ($valor == 2) { ?>
                <div class="btn btn-danger mb-1">
                    <p>El correo ya existe</p>
                </div>
            <?php  } else if ($valor == 3) { ?>
                <div class="btn btn-danger mb-1">
                    <p>Algun campo vacio o vacios</p>
                </div>
            <?php } ?>


        <?php } ?>

        <header class="container header w-100">
            <h1 class="p-2">Registrar Pedido</h1>
        </header>
        <form class="container d-flex flex-column p-3 gap-3 w-100" action="../services/insert.php" method="post">


            <div class="mb-3">
                <label for="cliente" class="form-label">Seleccionar Cliente</label>
                <select class="form-select" id="cliente" name="cliente_id" required>
                    <option value="" disabled selected>-- Selecciona un cliente --</option>
                    <?php foreach ($clientes as $cliente) { ?>
                        <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nombre']) . ' ' . htmlspecialchars($cliente['apellidos']) . ' - ' . htmlspecialchars($cliente['email']) ?></option>
                        <?php $cliente_actual = $cliente['id'] ?>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="producto" class="form-label">Seleccionar Producto</label>
                <select class="form-select" id="producto" name="producto_id" required>
                    <option value="" disabled selected>-- Selecciona un producto --</option>
                    <?php foreach ($productos as $producto) { ?>
                        <option value="<?= $producto['id'] ?>"><?= htmlspecialchars($producto['nombre']) . ' - $' . htmlspecialchars($producto['precio']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div id="linea_pedidos_php" class="d-flex flex-column gap-3">
                <?php if (count($_SESSION["lista_pedidos"]) > 0) { ?>
                    <?php foreach ($productosEligidos as $producto) { ?>
                        <div class="d-flex flex-row gap-3">
                            <p><?= $producto[1] ?> - <?= $producto[2] ?></p>
                            <label for="cantidad">Cantidad</label>
                            <input type="number" id="cantidad_${productoId}" name="cantidades[]" style="width: 70px;" class="form-control" value="1" min="1" required>
                            <a href="../services/quitar_linea_pedido.php?id=<?= $producto[0] ?>" type="button" class="btn btn-danger btn-sm eliminar-producto">Eliminar</a>
                        </div>
                    <?php } ?>

                <?php } ?>

            </div>

            <div class="flex-row d-flex gap-3 w-100 mb-3">
                <div>
                    <button type="submit" class="btn btn-success">Agregar cliente</button>
                </div>
                <div>
                    <a href="../../../dashboard.php?page=clientes" class="btn btn-secondary">Volver a la lista de clientes</a>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('producto').addEventListener('change', function() {
            window.location.href = '../services/lista_linea_pedidos.php?id=' + this.value;
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>