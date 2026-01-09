<?php

session_start();

include("../../../../db/db.inc");
include("../../../security/session.php");

// TENGO QUE MIRAR QUE PUEDO QUITAR Y MEJORAR OTRAS COSAS OK SIIIUUUUUUUUUUU

$productos = $_POST["productos"];
$cantidades = $_POST["cantidades"];
$precios = $_POST["precios"];
$id_lineas_pedidos = $_POST['linea-pedidos'];
$id_pedido = $_POST["id-pedido"];

for ($i = 0; $i < count($id_lineas_pedidos); $i++) {

    $cantidad = $cantidades[$i];
    $precio = $precios[$i];
    $producto = $productos[$i];
    $id_lineas_pedido = $id_lineas_pedidos[$i];

    if ($cantidad == 0) {
        $sql_borrar_registro = "DELETE FROM linea_pedido WHERE id=$id_lineas_pedido";

        if (mysqli_query($con, $sql_borrar_registro)) {
            continue;
        }
    }

    $sql_actulizar_linea_pedido = "UPDATE linea_pedido SET cantidad = $cantidad  WHERE id=$id_lineas_pedido";
    mysqli_query($con, $sql_actulizar_linea_pedido);
}


$sql_pedido_con_linea = "SELECT linea_pedido.* FROM linea_pedido
JOIN pedidos ON linea_pedido.pedido_id = pedidos.id
WHERE pedidos.id = $id_pedido";

$res = mysqli_query($con, $sql_pedido_con_linea);

$linea_pedidos = mysqli_fetch_all($res);

if (empty($linea_pedidos)) {
    $sql_borrar_pedido = "DELETE FROM pedidos WHERE id=$id_pedido";
    mysqli_query($con, $sql_borrar_pedido);
    header("Location: ../../../dashboard.php?page=pedidos");
    exit;
}

header("Location: ../../../dashboard.php?page=pedidos");
exit;