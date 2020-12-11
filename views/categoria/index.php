<div id="central">
    <h1>Gestionar Categorias</h1>
    <!-- Boton para crear -->
    <a href="<?=base_url?>categoria/crear" class="button button-small">
        Crear Categoria
    </a>
    <!-- Tabla de muestra -->
    <table>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        <?php while($cat = $categorias->fetch_object()) :?>
            <tr>
                <td>
                    <?=$cat->id_categoria?>
                </td>
                <td>
                    <?=$cat->nombre?>
                </td>
            </tr>
        <?php endwhile;?>
    </table>   
</div>