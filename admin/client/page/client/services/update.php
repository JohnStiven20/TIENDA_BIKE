<?php


// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS

session_start();

include("../../../../db/db.inc");
include("../../../utils/validaciones.php");

$estado = false;

$nombre = validaciones("nombre");
$apellidos = validaciones(campo: "apellidos");
$email = validaciones("email");
$genero = validaciones("genero");
$direccion = validaciones("direccion");
$codigo_postal = validaciones("codigo_postal");
$provincia = validaciones("provincia");
$poblacion = validaciones("poblacion");
$id = $_POST["id"];

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

header("Location: ../../../dashboard.php?page=clientes");
exit;
