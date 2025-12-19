<?php

session_start();

$id = $_GET["id"];

$_SESSION["filtros_pedidos"] = [
    "id_cliente" => $id
];

header("Location: ../../../dashboard.php?page=pedidos");

exit();





