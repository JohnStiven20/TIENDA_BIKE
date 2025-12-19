<?php


// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS
include("../../../../db/db_pdo.inc");


if (isset($_GET["eliminar"])) {
    $id = intval($_GET['eliminar']);
    $pdo->prepare("DELETE FROM clientes WHERE id = ?")->execute([$id]);
    header("Location: ../../../dashboard.php?page=clientes");
    exit;    
}
