

<?php

// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");
include("../view/insert_cli.php?error=1");


if (isset($_POST["nombre"])  && !empty($_POST["nombre"])) {

    $nombre = validaciones("nombre");
    $apellidos = validaciones("apellidos");
    $email = validaciones("email");

    $sql_validation_email = "SELECT id FROM clientes WHERE email='$email'";

    $rows = mysqli_query($con, $sql_validation_email);

    if (mysqli_num_rows($rows) > 0) {
        header("Location: ../view/insert_cli.php?error=1");
        exit();
    }

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