<div id="central">
    <?php if(isset($_SESSION['identity'])) :?>
        <h1>Hacer Pedido</h1>
        <a href="<?=base_url?>carrito/index">Ver los productos del pedido</a> 
        
        <h3 class="carrito">Hacer Pedido</h3>
        <form action="<?=base_url?>pedido/add" method="POST">
        
            <label for="direccion">Dirección:</label>
            <input type="text" name="direccion">
            
            <label for="localidad">Localidad:</label>
            <input type="text" name="localidad">
            
            <label for="provincia">Provincia:</label>
            <input type="text" name="provincia">
            
            <input type="submit" value="Hacer pedido">
        </form>
        
    <?php else:?>
        <h1>Debes estar identificado</h1>
        <p>Debes logearte para poder realizar tu pedido</p>
        <p>Si no estas logueado haz click <a href="<?=base_url?>usuario/registro">AQUI</a></p>
    <?php endif ;?>
</div>