<?php

// He decidido que los pedidos dependan completamente de los clientes.
// Por eso, para borrar un cliente, primero elimino sus pedidos asociados.
// Un pedido no puede existir sin cliente, pero un cliente sí puede existir sin pedidos

// PUEDE QUE TENGA QUE IMPLEMENTAR LOS HTTP PARA VALIDAR LA ENTRADAS DE CLIENTES NO AUTORIZADOS
include("../../../../db/db_pdo.inc");
include("../../../../db/db.inc");


if (isset($_GET["eliminar"])) {

    $id = intval($_GET['eliminar']);

    $validacion = "SELECT count(pedidos.id) as pedidos FROM clientes LEFT JOIN pedidos ON clientes.id = pedidos.id WHERE clientes.id='$id'";

    $respuesta = mysqli_query($con, $validacion);

    $datos = mysqli_fetch_all($respuesta);

    echo $datos[0][0];

    if ($datos[0][0] == 0) {

        $sql_delete_cliente = "DELETE FROM clientes WHERE id = '$id'";

        $resultado = mysqli_query($con, $sql_delete_cliente);

        if ($resultado && mysqli_affected_rows($con) > 0) {
        }

        header("Location: ../../../dashboard.php?page=clientes&cli=5");
        exit;
        
    } else {
        header("Location: ../../../dashboard.php?page=clientes&cli=4");
        exit;
    }
}
