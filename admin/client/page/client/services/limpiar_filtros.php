<?php

session_start();

$_SESSION["filtros_clientes"] = "";

header("Location: ../../../dashboard.php?page=clientes");
exit();

?>