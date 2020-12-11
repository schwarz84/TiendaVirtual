<!DOCTYPE HTML>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title>Tienda de Camistes</title>
    <link rel="stylesheet" href="<?= base_url ?>assets/css/styles.css" />
</head>

<body>
    <div id="conteiner">
        <!-- Cabecera -->
        <header id="header">
            <div id="logo">
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta Logo">
                <a href="<?= base_url ?>">
                    Tienda de Camisetas
                </a>
            </div>
        </header>
        <!-- Menu -->
        <?php $categorias = Utils::showCategorias(); ?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?= base_url ?>">Inicio</a>
                </li>
                <?php while ($cat = $categorias->fetch_object()) : ?>
                    <li>
                        <a href="<?= base_url ?>categoria/ver&id_categoria=<?= $cat->id_categoria ?>"><?= $cat->nombre ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
        </nav>