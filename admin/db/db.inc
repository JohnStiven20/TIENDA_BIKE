<?php

$host = "localhost";
$nombreBS = "queso1";
$usuario = "root";
$password = "";

$con = new mysqli($host, $usuario, $password, $nombreBS);

if ($con->connect_error) {
    die("La Conexion es errror" . $con -> connect_error);
}


?>