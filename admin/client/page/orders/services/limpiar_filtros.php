<?php

session_start();

$_SESSION["filtros_pedidos"] = "";

header("Location: ../../../dashboard.php?page=pedidos");

?>