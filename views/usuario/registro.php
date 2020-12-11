<div id="central">
    <h1>Registro</h1>
    
    <?php if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete' ):?>
        <strong>Registro Completado</strong>
    <?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
        <strong>Registro Fllido, introduce bien los datos.</strong>
    <?php endif; ?>
    
    <?php Utils::deleteSession('register');?>
    
    
    <form action="<?=base_url?>usuario/save" method="POST">
    
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="" required>
    
        <label for="apellidos">Apellido</label>
        <input type="text" name="apellidos" id="" required>
    
        <label for="correo">Email</label>
        <input type="email" name="correo" id="" required>
    
        <label for="pass">Contraseña</label>
        <input type="password" name="pass" id="" required>
        
        <input type="submit" value="Registrase">
    </form>
</div>