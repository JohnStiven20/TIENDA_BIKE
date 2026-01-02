<?php


// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS


session_start();

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");

// NO PODRAS ACTUAZALIZAR LOS DATOS DE UN CLIENTE SI ALGUN CAMPO ESTA VACIO, YA QUE 
// SE NECESITA LA INFORMACION PARA ENTREGAR EL PEDIDO Y ESTE MISMA LOGICA APLICAR PARA
// INSERTAR NUEVOS CLIENTES


$id = $_POST["id"];

$direccion = "../view/edit_cli.php?edit=$id&error=3";

$nombre = validaciones("nombre", $direccion);
$apellidos = validaciones("apellidos", $direccion);
$email = validaciones("email", $direccion);

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header("Location: ../view/edit_cli.php?edit=$id&error=2");
    exit;
}

$genero = validaciones("genero", $direccion);
$direccion = validaciones("direccion", $direccion);
$codigo_postal = validaciones("codigo_postal", $direccion);
$provincia = validaciones("provincia", $direccion);
$poblacion = validaciones("poblacion", $direccion);

$sql_actulizar_con_mismo_correo = "SELECT email FROM clientes WHERE id='$id'";


$sql = "UPDATE clientes SET nombre='$nombre', apellidos='$apellidos', email='$email', genero='$genero', direccion='$direccion', codpostal='$codigo_postal', provincia='$provincia', poblacion='$poblacion' WHERE id=$id";


$rows = mysqli_query($con, $sql_actulizar_con_mismo_correo);

$datos = mysqli_fetch_all($rows);

if ($email === $datos[0][0]) {

    if (mysqli_query($con, $sql)) {
        header("Location: ../../../dashboard.php?page=clientes");
        exit;
    } else {
        echo "Error al actualizar el cliente: " . mysqli_error($con);
    }
} else {

    $sql_validar_email_encontrada = "SELECT email FROM clientes WHERE email='$email'";

    $validar = mysqli_query($con, $sql_validar_email_encontrada);

    if (!(mysqli_num_rows($validar) > 0)) {

        if (mysqli_query($con, $sql)) {
            header("Location: ../../../dashboard.php?page=clientes");
        }
    } else {
        header("Location: ../view/edit_cli.php?edit=$id&error=1");
        exit;
    }
}

