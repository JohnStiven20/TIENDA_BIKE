<?php

include("../../../../db/db.inc");

$id_cliente = $_POST["cliente_id"];

$sql_crear_pedido = "INSERT INTO pedidos(codigo, id_cliente) VALUES('PED-011',$id_cliente)";

mysqli_query($con, $sql_crear_pedido);

$id_pedido = mysqli_insert_id($con);

$productos = $_POST["productos"];
$cantidades = $_POST["cantidades"];
$precios = $_POST["precios"];

for ($i = 0; $i < count($productos); $i++) {

    $id_producto = $productos[$i];
    $cantidad_producto = $cantidades[$i];
    $precio  = $precios[$i];
    $precio_final =  $precio * $cantidad_producto;

    $sql_crear_linea_pedido = "INSERT INTO linea_pedido (pedido_id, producto_id, cantidad, precio_unitario) " .
        " VALUES ($id_pedido, $id_producto, $cantidad_producto, $precio_final)";

    mysqli_query($con, $sql_crear_linea_pedido);
}

header("Location: ../../../dashboard.php?page=pedidos");
exit;


