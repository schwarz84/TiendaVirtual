<div id="central">
    <h1>Detalle del Pedido</h1>

    <?php if (isset($pedido)) : ?>
        <?php if (isset($_SESSION['Administrador'])) : ?>
            <h3>Cambiar Estador del Pedido</h3>
            <form action="<?= base_url ?>pedido/estado" method="POST">
                <input type="hidden" value="<?= $pedido->id_pedido ?>" name="pedido_id">
                <!-- Bandera para que vuelva al lugar correcto -->
                <?php if (isset($_GET['gestion'])) : ?>
                    <input type="hidden" name="bandera" value="1">
                <?php endif; ?>
                <!--  -->
                <select name="estado">
                    <option value="confirm" <?= $pedido->estado == "confirm" ? "selected" : ""; ?>>Pendiente</option>
                    <option value="preparation" <?= $pedido->estado == "preparation" ? "selected" : ""; ?>>En preparacion</option>
                    <option value="ready" <?= $pedido->estado == "ready" ? "selected" : ""; ?>>Listo para Enviar</option>
                    <option value="sended" <?= $pedido->estado == "sended" ? "selected" : ""; ?>>Enviado</option>

                    <input type="submit" value="Cambiar Estado">
                </select>
            </form><br>

        <?php endif; ?>


        <h3>Datos del pedido</h3>

        Numero de Pedido: <?= $pedido->id_pedido ?> <br>
        Estado: <?= Utils::showStatus($pedido->estado) ?> <br>
        Direccion: <?= $pedido->direccion ?> <br>
        Ciudad: <?= $pedido->localidad ?> <br>
        Provincia: <?= $pedido->provincia ?> <br>
        Total a pagar: <?= $pedido->costo ?> $ <br>
        Productos: <br>

        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>

            <?php while ($producto = $productos->fetch_object()) : ?>
                <tr>
                    <td>
                        <?php if ($producto->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="img-carrito" />
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png" class="img-carrito">
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url ?>producto/ver&id_producto=<?= $producto->id_producto ?>"><?= $producto->nombre ?></a>
                    </td>
                    <td>
                        <?= $producto->precio ?>
                    </td>
                    <td>
                        <?= $producto->unidades ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <a class="super" href="<?= base_url ?><?= isset($_SESSION['Administrador']) && (isset($_GET['gestion'])) ? 'pedido/gestion' : 'pedido/mis_pedidos'; ?>"><input type="button" value="< Volver al Mis Pedidos"></a>
    <?php endif; ?>
</div>