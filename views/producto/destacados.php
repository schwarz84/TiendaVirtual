<!-- Contenido Central -->
<div id="central">
    <h1>Productos Destacados</h1>
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
</div>