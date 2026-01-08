<?php

session_start();

$id = $_GET["id"];

unset($_SESSION["lista_pedidos"][$id]);

header("Location: ../view/insert_ped.php");
exit;