<div id="central">

    <h1>Gestion de Productos</h1>

    <!-- Boton para crear -->
    <a href="<?= base_url ?>producto/crear" class="button button-small">
        Crear Producto
    </a>
    <?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'Completed') : ?>
        <strong class="confirmacion">EL producto se guardo correctamente</strong>
    <?php elseif (isset($_SESSION['producto']) && $_SESSION['producto'] != 'Completed') : ?>
        <strong class="negacion">EL producto no se guardo correctamente</strong>
    <?php endif; ?>

    <?php if (isset($_SESSION['edit']) && $_SESSION['edit'] == 'Completed') : ?>
        <strong class="confirmacion">EL producto se edito Correctamente</strong>
    <?php elseif (isset($_SESSION['edit']) && $_SESSION['edit'] != 'Completed') : ?>
        <strong class="negacion">EL producto no se edito correctamente</strong>
    <?php endif; ?>

    <?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'Completed') : ?>
        <strong class="confirmacion">EL producto se elimino Correctamente</strong>
    <?php elseif (isset($_SESSION['delete']) && $_SESSION['delete'] != 'Completed') : ?>
        <strong class="negacion">EL producto no se elimino Correctamente</strong>
    <?php endif; ?>

    <?php Utils::deleteSession('producto'); ?>
    <?php Utils::deleteSession('edit'); ?>
    <?php Utils::deleteSession('delete'); ?>

    <!-- Tabla de muestra -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Editar</th>
        </tr>
        <?php while ($pro = $productos->fetch_object()) : ?>
            <tr>
                <td>
                    <?= $pro->id_producto; ?>
                </td>
                <td>
                    <?= $pro->nombre; ?>
                </td>
                <td>
                    <?= $pro->precio; ?>
                </td>
                <td>
                    <?= $pro->stock; ?>
                </td>
                <td>
                    <a href="<?= base_url ?>producto/editar&id_producto=<?= $pro->id_producto ?>" class="buttonED">Editar</a>
                </td>
            </tr>
        <?php endwhile; ?>

    </table>

</div>