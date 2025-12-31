<?php

// MIRAR DESPUES EL HTPP ESTE PARA VALIDAR ?

// if (parse_url($_SERVER['HTTP_REFERER'], PHP_URL_HOST) != $_SERVER['HTTP_HOST']) {
//     header("Location: /ud2/TIENDA_BIKE/admin/client/login/index1.php");
// }

if (!isset($_SESSION["name"]) && !isset($_SESSION["email"]) && !isset($_SESSION["rol"])) {
    header("Location: ". BASE_URL ."/admin/client/login/index1.php");
    exit;
}

