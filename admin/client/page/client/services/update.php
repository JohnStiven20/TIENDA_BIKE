<?php


// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS

session_start();

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");


$nombre = validaciones("nombre");
$codigo_postal = validaciones("apellidos");
$email = validaciones("email");
$genero = validaciones("genero");
$direccion = validaciones("direccion");
$codigo_postal = validaciones("codigo_postal");
$provincia = validaciones("provincia");
$poblacion = validaciones("poblacion");
$id = $_POST["id"];


$sql = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', email='$email', genero='$genero', direccion='$direccion', codpostal='$codigo_postal', provincia='$provincia', poblacion='$poblacion' WHERE id=$id";

if (mysqli_query($con, $sql)) {
    header("Location: ../../../dashboard.php?page=clientes");
} else {
    echo "Error al actualizar el cliente: " . mysqli_error($con);
}

