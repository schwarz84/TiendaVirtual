<div id="content">
    <!-- Barra Lateral -->
    <aside id="side">

        <div id="carrito" class="block_aside">
            <h3>Mi Carrito</h3>
            <!-- Funcion para que se pueda cargar los datos en el Sidebar -->
            <?php ob_start();?>
            <?php $stats = Utils::statscarrito(); ?>
            
            <ul>
                <li>
                    <a href="<?= base_url ?>carrito/index">Productos (<?= $stats['count'] ?>)</a>
                </li>
                <li>
                    <a href="<?= base_url ?>carrito/index">Total: <?= $stats['total'] ?> $</a>
                </li>
                <li>
                    <a href="<?= base_url ?>carrito/index">Ver Carrito</a>
                </li>
            </ul>
        </div>
        
        <div id="login" class="block_aside">

            <?php if (!isset($_SESSION['identity'])) : ?>
                <h3>Entrar a la Web</h3>
                <form action="<?= base_url ?>usuario/login" method="post">
                    <!-- Email -->
                    <label for="correo">Email</label>
                    <input type="email" name="correo" />
                    <!-- pass -->
                    <label for="pass">Contraseña</label>
                    <input type="password" name="pass" />

                    <input type="submit" value="Enviar">
                </form>
            <?php else : ?>
                <h3><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellidos ?></h3>
            <?php endif; ?>

            <!-- Enlaces -->
            <ul>
                <?php if (isset($_SESSION['Administrador'])) : ?>
                    <li>
                        <a href="<?= base_url ?>categoria/index">Gestionar Categorias</a>
                    </li>
                    <li>
                        <a href="<?= base_url ?>producto/gestion">Gestionar Productos</a>
                    </li>
                    <li>
                        <a href="<?=base_url?>pedido/gestion">Gestionar Pedidos</a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['identity'])) : ?>
                    <li>
                        <a href="<?= base_url ?>pedido/mis_pedidos">Mis Pedidos</a>
                    </li>
                    <li>
                        <a href="<?= base_url ?>usuario/logout">Cerrar Sesión</a>
                    </li>
                <?php else : ?>
                    <li>
                        <a href="<?= base_url ?>usuario/registro">Registrate Aqui</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </aside>