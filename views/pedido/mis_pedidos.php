<div id="central">
    <?php if (isset($pedido)) : ?>
        <?php if (isset($gestion)) : ?>

            <h1>Gestionar Pedidos</h1>
        <?php else : ?>
            <h1>Histroico de mis pedidos</h1>
        <?php endif; ?>

        <table>
            <tr>
                <th>Nº de Pedido</th>
                <th>Costo Total</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>

            <?php while ($ped = $pedido->fetch_object()) : ?>
                <tr>
                    <td>
                        <?php if (isset($gestion)) :?>
                            <a href="<?= base_url ?>pedido/detalle&id_pedido=<?= $ped->id_pedido ?>&gestion=<?=$gestion?>"><?= $ped->id_pedido ?></a>
                        <?php else :?>
                            <a href="<?= base_url ?>pedido/detalle&id_pedido=<?= $ped->id_pedido ?>"><?= $ped->id_pedido ?></a>
                        <?php endif;?>
                    </td>
                    <td>
                        <?= $ped->costo ?> $
                    </td>
                    <td>
                        <?= $ped->fecha ?>
                    </td>
                    <td>
                        <?= Utils::showStatus($ped->estado) ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else : ?>
        <h1>No tiene ningun pedido realizado</h1>
    <?php endif; ?>
</div>