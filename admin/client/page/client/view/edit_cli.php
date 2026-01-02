<?php


// PARA MIRAR QUE PUEDO HACER YA QUE HAY LOGICA QUE SE PUEDE TRASLADA
// AL SERVICES 

session_start();
include("../../../../db/db.inc");
include("../../../security/session.php");

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


        <?php

        if (isset($_GET["edit"]) && !empty($_GET["edit"])) {

            $id = intval($_GET["edit"]);
            $sql = "SELECT * FROM clientes WHERE id = $id";
            $res = mysqli_query($con, $sql);

            if (mysqli_num_rows($res) > 0) {
                $cliente = mysqli_fetch_assoc($res);
            } else {
                header(header: "Location: ../../../dashboard.php?page=clientes&cli=3");
            }
        } else {
            header("Location: ../../../dashboard.php?page=clientes&cli=3");
            exit;
        }

        ?>

        <?php if (isset($_GET["error"]) && !empty($_GET["error"])) { ?>
            <?php
            $valor = $_GET["error"];
            ?>

            <?php if ($valor == 1) {  ?>
                <div class="btn btn-danger mb-1">
                    <p>El correo ya existe</p>
                </div>
            <?php } else if ($valor == 2) { ?>
                <div class="btn btn-danger mb-1">
                    <p>Formato incorrecto de email</p>
                </div>
            <?php  } else if ($valor == 3) { ?>
                <div class="btn btn-danger mb-1">
                    <p>Algun campo vacio o vacios</p>
                </div>
            <?php } ?>
        <?php } ?>

        <header class="container header w-100">
            <h1 class="p-2">Actualizar Cliente</h1>
        </header>
        <form class="container d-flex flex-column p-3 gap-3 w-100" action="../services/update.php" method="post">
            <div class="flex-row d-flex gap-5 w-100 mb-3 mt-3">
                <div class="w-50">
                    <label class="form-label" for="">Nombre</label>
                    <input class="form-control" type="text" name="nombre" value="<?= $cliente["nombre"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Apellidos</label>
                    <input class="form-control" type="text" name="apellidos" value="<?= $cliente["apellidos"] ?>">
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3">
                <div class="w-50">
                    <label class="form-label" for="">Email</label>
                    <input class="form-control" type="text" name="email" value="<?= $cliente["email"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Genero</label>
                    <select class="form-select" name="genero" value="<?= $cliente["genero"] ?>">
                        <option value="M">M</option>
                        <option value="F">F</option>
                    </select>
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3">
                <div class="w-100">
                    <label class="form-label" for="">Direccion</label>
                    <input class="form-control" type="text" name="direccion" value="<?= $cliente["direccion"] ?>">
                </div>
            </div>
            <div class="flex-row d-flex gap-5 w-100 mb-3 justify-content-center">
                <div class="w-50">
                    <label class="form-label" for="">Codigo Postal</label>
                    <input class="form-control" type="text" name="codigo_postal" value="<?= $cliente["codpostal"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Poblacion</label>
                    <input class="form-control" type="text" name="poblacion" value="<?= $cliente["poblacion"] ?>">
                </div>
                <div class="w-50">
                    <label class="form-label" for="">Provincia</label>
                    <input type="text" class="form-control" name="provincia" value="<?= $cliente["provincia"] ?>">
                </div>
                <input type="hidden" name="id" value="<?= $cliente["id"] ?>">
            </div>
            <div class="flex-row d-flex gap-3 w-100 mb-3">
                <div>
                    <button type="submit" class="btn btn-success">Actualizar cliente</button>
                </div>
                <div>
                    <a href="../../../dashboard.php?page=clientes" class="btn btn-secondary">Volver a la lista de clientes</a>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>

</html>