<?php


$consulta = "";


if (isset($_SESSION["filtros_pedidos"])) {

    if (isset($_SESSION["filtros_pedidos"]["id_cliente"])) {
        $consulta = "SELECT pedidos.* FROM pedidos " .
            " JOIN clientes ON pedidos.id_cliente = clientes.id " .
            " WHERE clientes.id = '" .  $_SESSION["filtros_pedidos"]["id_cliente"]  . "'";
    } else {
        $consulta = "SELECT * FROM pedidos ORDER BY id ASC LIMIT 20";
    }
} else {
    $consulta = "SELECT * FROM pedidos ORDER BY id ASC LIMIT 20";
}


$clientes = $pdo->query($consulta)->fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container mt-4">
    <h2 class="text-center mb-4">📋 Gestión de Pedidos</h2>
    <div class="card shadow">
        <div class="card-header bg-secondary text-white">📋 Lista de Pedidos</div>
        <div class="card-body d-flex flex-column gap-2">
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
            <div class="row mb-3 me-2 float-end">
                <a href="page/client/view/insert_cli.php" class="btn btn-success">➕ Nuevo Cliente</a>
            </div>

            <div class="card p-3 mb-3 text-center">
                <h3 class="mb-3">Filtros</h3>

                <!-- NO SE SI PONER EN LA PROPIEDAD NAME EL VALOR NOMBRE  PORQUE VA UTILIZAR VARIAS VECES -->

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
                        <a href="page/orders/services/limpiar_filtros.php" class="btn btn-dark">Limpiar filtros</a>
                    </div>
                </form>
            </div>



            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>id</th>
                        <th>Codigo</th>
                        <th>Fecha</th>

                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['id']) ?></td>
                            <td><?= htmlspecialchars($c['codigo']) ?></td>
                            <td><?= htmlspecialchars($c['create_time']) ?></td>
                            <td>
                                <a href="page/client/view/edit_cli.php?edit= <?= $c["id"] ?> " class="btn btn-sm btnwarning">✏️</a>
                                <button type="button" class="btn btn-danger" onclick="eliminarCliente(<?= $c['id']; ?>)">🗑️</button>
                                <a href="page/client/view/edit_cli.php?edit= <?= $c["id"] ?> " class="btn btn-sm btnwarning">📦</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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