

<?php

// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");

$direccion = "../view/insert_cli.php?error=3";

$nombre = validaciones("nombre", $direccion);
$apellidos = validaciones("apellidos", $direccion);
$email = validaciones("email", $direccion);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/insert_cli.php?error=1");
    exit;
}

$sql_validation_email = "SELECT id FROM clientes WHERE email='$email'";

$rows = mysqli_query($con, $sql_validation_email);

if (mysqli_num_rows($rows) > 0) {
    header("Location: ../view/insert_cli.php?error=2");
    exit();
}

$genero = validaciones("genero", $direccion);
$direccion = validaciones("direccion", $direccion);
$codigo_postal = validaciones("codigo_postal", $direccion);
$poblacion = validaciones("poblacion", $direccion);
$provincia = validaciones("provincia", $direccion);
$password = validaciones("password", $direccion);

$insert = "INSERT INTO clientes (nombre, apellidos, email, password , genero, direccion, codPostal, poblacion, provincia)  VALUES  ('$nombre', '$apellidos', '$email','$password' ,'$genero', '$direccion', '$codigo_postal', '$poblacion', '$provincia')";

if (mysqli_query($con, $insert)) {
    header("Location: ../../../dashboard.php?page=clientes&cli=0");
    exit;
} else {
    header("Location:../../../dashboard.php?cli=2");
}


?>