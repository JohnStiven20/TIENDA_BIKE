<?php

session_start();

include("../../../utils/validaciones.php");

$_SESSION["filtros_pedidos"] = [];

$email = validaciones("email");
$codigo = validaciones("codigo_pedido");

$_SESSION["filtros_pedidos"] = [
    "email" => $email,
    "codigo_pedido" => $codigo
];

header("Location: ../../../dashboard.php?page=pedidos");
exit;



