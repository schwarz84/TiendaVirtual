<div id="central">
    <h1>Carrito de Compra</h1>
    <!-- Para poder modificar el Sidebar -->
    
    <?php ob_start(); ?>
    <?php if ($_SESSION['carrito'] != Array()) :?>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>

            <?php
            foreach ($carrito as $indice => $elemento) :
                $producto = $elemento['producto'];
            ?>

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
                        <div id=updown>
                            <a href="<?=base_url?>carrito/up&indice=<?=$indice?>">+</a>
                            <?= $elemento['unidades'] ?>
                            <a href="<?=base_url?>carrito/down&indice=<?=$indice?>">-</a>
                        </div>
                    </td>
                    <td>
                        <a href="<?= base_url ?>carrito/remove&indice=<?=$indice?>" class="button button-eliminar">Eliminar Producto</a>
                    </td>
                </tr>

            <?php endforeach; ?>
        </table>
        <div class="vaciar-carrito">
            <a href="<?= base_url ?>carrito/delete_all" class="button button-vaciar">Vaciar Carrito</a>
        </div>
        <div class="total-carrito">
            <?php $stats = Utils::statscarrito(); ?>
            <h3>Total a Pagar: <span><?= $stats['total'] ?></span></h3>
            <a href="<?= base_url ?>pedido/hacer" class="button button-pedido">Hacer Pedido</a>
        </div>
    <?php else :?>
        <p>El carrito esta vacio. Ir al <a href="<?=base_url?>">Inicio</a></p>
    <?php endif;?>


</div>