<?php 

require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController {
    public function index() {
        
        Utils::isAdmin();
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        require_once 'views/categoria/index.php';
    }
    
    public function ver() {

        if (isset($_GET['id_categoria'])) {
            $id = $_GET['id_categoria'];
            // Conseguir la categoria
            $categoria = new Categoria();
            $categoria->setId_categoria($id);
            
            $categoria = $categoria->getOne();
            
            // Mostrar productos por categoria
            
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllCategoria();
        }
        
        require_once 'views/categoria/ver.php';
    }
    
    public function crear() {
        
        Utils::isAdmin();
        require_once 'views/categoria/crear.php';
    }
    
    public function save() {
        
        Utils::isAdmin();
        
        // Guardar la Categoria
        if(isset($_POST) && isset($_POST['nombre'])) {
        $categoria = new Categoria();
        $categoria->setNombre($_POST['nombre']);
        $categoria->save();
        }
        
        header('Location:'.base_url.'categoria/index');
    }
}
