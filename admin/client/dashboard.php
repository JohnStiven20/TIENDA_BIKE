<?php
session_start();

include("../db/db_pdo.inc");
include("../db/db.inc");


include("security/session.php");

$nombre = $_SESSION["name"];
$rol = $_SESSION["rol"];
$page = $_GET['page'] ?? 'inicio';

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">

    <style>

        
        img {
            height: 40px;
            width: 40px;
        }

        .tarjeta {
            border-radius: 10px !important;
            border: 1px solid white;
            background-color: blue !important;
        }

        p {
            margin: 0;
        }

        button img {
            width: 24px;
            height: 24px;
        }

        button {
            height: 40px;
            width: 40px;
            border-radius: 50px;
        }

        ul {
            margin-top: 30px;
            text-decoration: none;
            list-style: none;
            padding-left: 50px !important;
        }

        .opcion :hover {
            color: white;
        }

        .opcion a {
            color: black;
        }

        .sujeto {
            border-radius: 50px !important;
        }

        .boton-salir {
            background-image: url(../img/descarga.png);
        }
    </style>

</head>

<body class="bg-light">

    <div class="d-flex flex-row vh-100">

        <div class="bg bg-primary w-25">
            <div class="card tarjeta m-3 p-3 d-flex flex-row justify-content-between text-white">
                <div class="d-flex flex-row justify-content-center align-items-center p-3 gap-3">
                    <img class="sujeto" src="../img/admin.jpg" alt="">
                    <div class="d-flex flex-column justify-content-between">
                        <p><?= $nombre ?></p>
                        <?= $rol == 1 ? "Administrador" : "Usuario" ?>
                    </div>
                </div>

                <button class="btn btn-danger align-self-center rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px;" aria-label="Cerrar sesión">
                    <a href="" style="text-decoration: none; color: white;">Salir</a>
                </button>
            </div>

            <div class="secciones">
                <ul class="d-flex flex-column gap-3 text-black">
                    <li>
                        <p class="text-white">Menu principal</p>
                        <hr>
                    </li>
                    <li class="opcion">
                        <a href="dashboard.php?page=clientes">Clientes</a>
                    </li>
                    <li class="opcion">
                        <a href="dashboard.php?page=productos">Pedidos</a>
                    </li>
                    <li class="opcion">
                        <a href="dashboard.php?page=pedidos">Productos</a>
                    </li>
                    <li class="opcion">
                        <a href="dashboard.php?page=inicio">Inicio</a>
                    </li>
                     <li class="opcion">
                        <a href="dashboard.php?page=imagen">Imagenes</a>
                    </li>
                </ul>
            </div>
        </div>


        <div class="flex-grow-1 p-4 table-responsive" style="height: 100% !important;">
            <?php
            switch ($page) {
                case 'inicio':
                    include("page/start/startPage.php");
                    break;
                case 'clientes':
                    include "page/client/view/clientes.php";
                    break;
                case 'pedidos':
                    include "page/orders/pedidos.php";
                    break;
                case 'productos':
                    include "page/product/productos.php";
                    break;
                 case 'imagen':
                    include "page/image/imagePage.php";
                    break;
                default:
                    include("page/start/startPage.php");
                    break;
            
            }
            ?>
        </div>
</body>
</html>