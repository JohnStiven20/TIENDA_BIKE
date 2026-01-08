<?php

session_start();

$id = $_GET["id"];

$_SESSION["lista_pedidos"][$id] = $id;

header(header: "Location: ../view/insert_ped.php");
exit;







