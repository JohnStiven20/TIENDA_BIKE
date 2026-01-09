<?php

include("../../../../db/db.inc");

$id_pedido = $_GET["eliminar"];

$sql_eliminar_pedido = "DELETE  FROM pedidos WHERE id =$id_pedido";

if (mysqli_query($con, $sql_eliminar_pedido)) {
    header("Location: ../../../dashboard.php?page=pedidos");
    exit;
}
