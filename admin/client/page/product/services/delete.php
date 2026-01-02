<?php

include("../../../../db/db.inc");

if (isset($_GET["eliminar"]) && !empty($_GET["eliminar"])) {

    $id = $_GET["eliminar"];
    $sql_delete_product = "DELETE FROM productos WHERE id=$id";

    mysqli_query($con, $sql_delete_product);

    header("Location: ../../../dashboard.php?page=productos");
    exit;
}