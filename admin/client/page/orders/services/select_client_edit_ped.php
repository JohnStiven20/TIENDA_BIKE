<?php


session_start();

include("../../../../db/db.inc");
include("../../../security/session.php");
include("../../../utils/validaciones.php");


$cliente_id = validaciones("client_id");

$_SESSION["cliente_seleccionado_para_pedido"] = $cliente_id;


header("Location: ../view/insert_ped.php");


