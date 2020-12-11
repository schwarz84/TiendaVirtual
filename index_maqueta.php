<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Tienda de Camistes</title>
    <link rel="stylesheet" href="assets/css/styles.css" />
</head>

<body>
    <div id="conteiner">
        <!-- Cabecera -->
        <header id="header">
            <div id="logo">
                <img src="assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="index.php">
                    Tienda de Camisetas
                </a>
            </div>
        </header>
        <!-- Menu -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="#">Inicio</a>
                </li>
                <li>
                    <a href="#">Categoria 1</a>
                </li>
                <li>
                    <a href="#">Categoria 2</a>
                </li>
                <li>
                    <a href="#">Categoria 3</a>
                </li>
                <li>
                    <a href="#">Categoria 4</a>
                </li>
                <li>
                    <a href="#">Categoria 5</a>
                </li>
            </ul>
        </nav>
        <div id="content">
            <!-- Barra Lateral -->
            <aside id="side">
                <div id="login" class="block_aside">
                    <h3>Entrar a la Web</h3>
                    <form action="#">
                        <!-- Email -->
                        <label for="email">Email</label>
                        <input type="email" name="email" />
                        <!-- pass -->
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" />

                        <input type="submit" value="Enviar">
                    </form>
                    <!-- Enlaces -->
                    <ul>
                        <li>
                            <a href="#">Mis Pedidos</a>
                        </li>
                        <li>
                            <a href="#">Gestionar Pedidos</a>
                        </li>
                        <li>
                            <a href="#">Gestionar Categorias</a>
                        </li>
                    </ul>

                </div>
            </aside>
            <!-- Contenido Central -->
            <div id="central">
                <h1>Productos Destacados</h1>
                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiste Azul Ancha</h2>
                    <p>300 Pesos</p>
                    <a href="#" class="button">Comprar</a>

                </div>

                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiste Azul Ancha</h2>
                    <p>300 Pesos</p>
                    <a href="#" class="button">Comprar</a>

                </div>

                <div class="product">
                    <img src="assets/img/camiseta.png" alt="" />
                    <h2>Camiste Azul Ancha</h2>
                    <p>300 Pesos</p>
                    <a href="#" class="button">Comprar</a>

                </div>
            </div>

        </div>
        <!-- Footer -->
        <footer id="footer">
            <p>Desarrollado por Carlos Schwarz &copy <?= date('Y') ?></p>

        </footer>
    </div>
</body>

</html>