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
        <form class="container d-flex flex-column p-3 gap-3 w-100" action="../services/linea_pedidos_guardar.php" method="post">


            <div class="mb-3">
                <label for="cliente" class="form-label">Seleccionar Cliente</label>
                <select class="form-select" id="cliente" name="cliente_id">
                    <option value="" disabled selected>-- Selecciona un cliente --</option>
                    <?php foreach ($clientes as $cliente) { ?>
                        <option value="<?= $cliente['id'] ?>"><?= htmlspecialchars($cliente['nombre']) . ' ' . htmlspecialchars($cliente['apellidos']) . ' - ' . htmlspecialchars($cliente['email']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="producto" class="form-label">Seleccionar Producto</label>
                <select class="form-select" id="producto" name="producto_id">
                    <option value="" disabled selected>-- Selecciona un producto --</option>
                    <?php foreach ($productos as $producto) { ?>
                        <option value="<?= $producto['id'] ?>"><?= htmlspecialchars($producto['nombre']) . ' - $' . htmlspecialchars($producto['precio']) ?></option>
                    <?php } ?>
                </select>
            </div>

            <div id="linea_pedidos">
            </div>

            <div class="flex-row d-flex gap-3 w-100 mb-3">
                <div>
                    <button type="submit" class="btn btn-success" id="botonAgregar">Agregar Pedido</button>
                </div>
                <div>
                    <a href="../../../dashboard.php?page=clientes" class="btn btn-secondary">Volver a la lista de clientes</a>
                </div>
            </div>
        </form>

        <input type="hidden" value="${productoId}" name="precio">

    </div>

    <script>
        const cliente = document.getElementById("cliente");

        const lineaPedidosDiv = document.getElementById('linea_pedidos');

        document.getElementById('producto').addEventListener('change', function() {

            let estado = true;

            const lineaPedidosDiv = document.getElementById('linea_pedidos');
            console.log(lineaPedidosDiv.children.length)

            for (let i = 0; i < lineaPedidosDiv.children.length; i++) {
                const element = lineaPedidosDiv.children[i];
                if (element.id == this.value) {
                    estado = false;
                }
            }

            const productoId = this.value;
            const textoSeleccionado = this.options[this.selectedIndex].text;

            console.log(textoSeleccionado.length)

            let ultimo = textoSeleccionado.split(" ").length;
            let precio = textoSeleccionado.split(" ")[ultimo - 1].replace("$", "");

            if (estado) {
                const nuevaLinea = document.createElement('div');

                nuevaLinea.classList.add('mb-3', 'd-flex', 'align-items-center', 'gap-3');

                nuevaLinea.id = this.value;

                nuevaLinea.innerHTML = `
                <input type="hidden" name="productos[]" value="${productoId}">
                <span>${textoSeleccionado}</span>
                <label for="cantidad_${productoId}" class="form-label">Cantidad:</label>
                <input type="number" id="cantidad_${productoId}" name="cantidades[]" style="width: 70px;" class="form-control" value="1" min="1" required>
                <a href="#" type="button" class=" btn btn-danger btn-sm eliminar-producto">Eliminar</a>
                <input type="hidden" value="${precio}" name="precios[]">

                `;

                const eliminar = nuevaLinea.children[4];

                eliminar.addEventListener("click", (e) => {
                    const elemento = document.getElementById(nuevaLinea.id);
                    elemento.remove();
                });

                lineaPedidosDiv.appendChild(nuevaLinea);
                this.selectedIndex = 0;
            }

        });

        const boton = document.getElementById("botonAgregar");

        boton.addEventListener("click", (e) => {
            if (cliente.value == "") {
                e.preventDefault();
                alert("Selenciona un cliente");
            } else if (!(lineaPedidosDiv.children.length > 0)) {
                e.preventDefault();
                alert("Tienes que eligir un producto minimo");
            }
        })


    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>