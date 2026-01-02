<?php

session_start();

include("../../../utils/validaciones.php");


$nombre = validaciones("nombre");
$codigo_postal = validaciones("codigo_postal");
$poblacion = validaciones("poblacion");

$_SESSION["filtros_clientes"] = [
    "nombre" => $nombre,
    "codigo_postal" => $codigo_postal,
    "poblacion" => $poblacion
];

header("Location: ../../../dashboard.php?page=clientes");
exit();

?>