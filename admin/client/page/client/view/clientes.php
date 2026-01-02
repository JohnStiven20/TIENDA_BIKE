<?php

$consulta = "";

if (isset($_SESSION["filtros_clientes"])) {

    $filtrado_estado = true;
    $consulta = "SELECT c.* , COUNT(pedidos.id) AS total_pedidos FROM clientes c LEFT JOIN pedidos ON pedidos.id_cliente = c.id";
    $condiciones = [];

    if (!empty($_SESSION["filtros_clientes"]["nombre"])) {
        $condiciones[] = "nombre = '" . $_SESSION["filtros_clientes"]["nombre"] . "'";
    }

    if (!empty($_SESSION["filtros_clientes"]["codigo_postal"])) {
        $condiciones[] = "codpostal = '" . $_SESSION["filtros_clientes"]["codigo_postal"] . "'";
    }

    if (!empty($_SESSION["filtros_clientes"]["poblacion"])) {
        $condiciones[] = "poblacion = '" . $_SESSION["filtros_clientes"]["poblacion"] . "'";
    }

    if (!empty($condiciones)) {
        $consulta .= " WHERE " . implode(" AND ", $condiciones) . " ORDER BY c.id DESC LIMIT 20";
    } else {
        $consulta .= " GROUP BY c.id HAVING c.id IS NOT NULL ORDER BY c.id ASC LIMIT 20";
        $filtrado_estado = false;
    }
} else {
    $consulta = "SELECT c.*, COUNT(pedidos.id) AS total_pedidos FROM clientes c LEFT JOIN pedidos ON pedidos.id_cliente = c.id GROUP BY c.id HAVING c.id  IS NOT NULL ORDER BY c.id ASC LIMIT 20";
    $filtrado_estado = false;
}


$clientes = $pdo-> query($consulta)-> fetchAll(PDO::FETCH_ASSOC);

?>

<div class="fluid-container mt-4 ">
    <h2 class="text-center mb-4">📋 Gestión de Clientes</h2>
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">📋 Lista de Clientes</div>

        <div class="card-body table">

            <?php if (isset($_GET["cli"])) { ?>
                <?php if ($_GET["cli"] == 0) { ?>
                    <div class="alert alert-success">
                        Todo Correcto
                    </div>
                <?php } ?>
                <?php if ($_GET["cli"] == 1) { ?>
                    <div class="alert alert-warning">
                        Ya existe
                    </div>
                <?php } ?>
                <?php if ($_GET["cli"] == 2) { ?>
                    <div class="alert alert-danger">
                        Error en el ingreso
                    </div>
                <?php } ?>
            <?php } ?>


            <div class="mb-3 me-2 d-flex justify-content-end">
                <a href="page/client/view/insert_cli.php" class="btn btn-success">➕ Nuevo Cliente</a>
            </div>

            <div class="card p-3 mb-3 text-center">
                <h3 class="mb-3">Filtros</h3>

                <form class="row g-3 align-items-end justify-content-center" action="page/client/services/filtros.php" method="post">
                    <div class="col-12 col-md-4 text-start">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input
                            type="text"
                            id="nombre"
                            class="form-control"
                            placeholder="Nombre" name="nombre">
                    </div>

                    <div class="col-12 col-md-4 text-start">
                        <label for="codigoPostal" class="form-label">Código Postal</label>
                        <input
                            type="text"
                            id="codigoPostal"
                            class="form-control"
                            placeholder="Código Postal" name="codigo_postal">
                    </div>

                    <div class="col-12 col-md-4 text-start">
                        <label for="poblacion" class="form-label">Población</label>
                        <input
                            type="text"
                            id="poblacion"
                            class="form-control"
                            placeholder="Población" name="poblacion">
                    </div>
                    <input type="hidden" name="filtros" value="1">
                    <div class="col-12 text-end">
                        <button class="btn btn-success" style="width: 100px !important;" type="submit">Filtrar</button>
                        <?php if ($filtrado_estado) { ?>
                            <a href="page/client/services/limpiar_filtros.php" class="btn btn-dark">Limpiar filtros</a>
                        <?php  } ?>
                    </div>
                </form>
            </div>

            <?php if (count($clientes) > 0 && $clientes[0]['id'] != null) { ?>   

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellidos</th>
                                <th>Email</th>
                                <th>Género</th>
                                <th>Dirección</th>
                                <th>Código Postal</th>
                                <th>Población</th>
                                <th>Provincia</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($clientes as $c): ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= htmlspecialchars($c['nombre']) ?></td>
                                    <td><?= htmlspecialchars($c['apellidos']) ?></td>
                                    <td><?= htmlspecialchars($c['email']) ?></td>
                                    <td><?= $c['genero'] ?></td>
                                    <td><?= htmlspecialchars($c['direccion']) ?></td>
                                    <td><?= $c['codpostal'] ?></td>
                                    <td><?= htmlspecialchars($c['poblacion']) ?></td>
                                    <td><?= htmlspecialchars($c['provincia']) ?></td>
                                    <td>
                                        <a href="page/client/view/edit_cli.php?edit=<?= $c['id'] ?>" class="btn btn-sm btn-info">✏️</a>
                                        <button type="button" class="btn btn-danger" onclick="eliminarCliente(<?= $c['id']; ?>)">🗑️</button>
                                        <?php if (isset($c['total_pedidos']) && $c['total_pedidos'] > 0) { ?>
                                            <a href="page/client/services/navegarPedido.php?id=<?= $c["id"] ?>" class="btn btn-info">📦</a>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="card p-3 mb-3 text-center d-flex flex-column justify-content-center" style="height: 400px !important;">
                    <p>No hay clientes registrados.</p>
                </div>
            <?php } ?>
        </div>
    </div>
</div>

<div class="modal fade" id="confirmModal" tabindex="-1" ariahidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bsdismiss="modal"></button>
            </div>
            <div class="modal-body">
                ¿Seguro que deseas eliminar este Cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bsdismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function eliminarCliente(numcliente) {
        const modal = new bootstrap.Modal(document.getElementById('confirmModal'));
        modal.show();

        document.getElementById('confirmDeleteBtn').onclick = () => {
            window.location.href = './page/client/services/delete.php?eliminar=' + numcliente;
            modal.hide();
        };
    }
</script>