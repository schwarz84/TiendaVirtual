<div id="central">
    <?php if (isset($categoria)) : ?>
        <h1><?= $categoria->nombre ?></h1>
        <?php if ($productos->num_rows == 0) : ?>
            <p>No existen Productos para mostrar</p>
        <?php else : ?>
            <?php while ($product = $productos->fetch_object()) : ?>
                <div class="product">
                    <a href="<?= base_url ?>producto/ver&id_producto=<?= $product->id_producto ?>">
                        <?php if ($product->imagen != null) : ?>
                            <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" />
                        <?php else : ?>
                            <img src="<?= base_url ?>assets/img/camiseta.png">
                        <?php endif; ?>
                        <h2><?= $product->nombre ?></h2>
                    </a>
                    <p><?= $product->precio ?></p>
                    <a href="<?= base_url ?>carrito/add&id_producto=<?= $product->id_producto ?>" class="button">Comprar</a>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    <?php else : ?>
        <h1>La categoria no existe</h1>
    <?php endif; ?>

</div>