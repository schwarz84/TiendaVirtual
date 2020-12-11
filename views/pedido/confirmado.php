<div id="central">
    <?php if (isset($_SESSION['pedido']) || $_SESSION['pedido'] == 'complete') : ?>
        
        <h1>Su pedido fue confirmado</h1>
        <p>Tu pedido a sido guardado con exito. Una vez que realices la trasnferencia Bancaria a la cuenta 410015458595456545 por el valor total del pedido sera procesado y enviado</p>
        <br>
        <?php if (isset($pedido)) : ?>
            <h3>Datos del pedido</h3>

            Numero de Pedido: <?= $pedido->id_pedido ?> <br>
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
        <?php endif; ?>

    <?php elseif (isset($_SESSION['pedido']) || $_SESSION['pedido'] != 'complete') : ?>
        <h1>Tu pedido no fue confirmado</h1>
    <?php endif; ?>

</div>