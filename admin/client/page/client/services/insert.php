

<?php

// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");


if (isset($_POST["nombre"])  && !empty($_POST["nombre"])) {

    $nombre = validaciones("nombre");
    $apellidos = validaciones("apellidos");
    $email = validaciones("email");

    

    $genero = validaciones(("genero"));
    $direccion = validaciones("direccion");
    $codigo_postal = validaciones("codigo_postal");
    $poblacion = validaciones("poblacion");
    $provincia = validaciones("provincia");
    $password = validaciones("password");

    $insert = "INSERT INTO clientes (nombre, apellidos, email, password , genero, direccion, codPostal, poblacion, provincia)  VALUES  ('$nombre', '$apellidos', '$email','$password' ,'$genero', '$direccion', '$codigo_postal', '$poblacion', '$provincia')";

    if (mysqli_query($con, $insert)) {
        header("Location: ../../../dashboard.php?page=clientes");
        exit;
    } else {
        header("Location:../../../dashboard.php?cli=2");
    }
}


?>