<?php 
require_once 'models/producto.php';

class productoController {
    public function index() {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        
        // Renderizar vista
        require_once 'views/producto/destacados.php';
    }
    
    public function ver() {
        if (isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];
            
            $producto = new Producto();
            $producto->setId_producto($id_producto);

            $product = $producto->getOne();
                        
        } 
        require_once 'views/producto/ver.php';
    }
    
    public function gestion(){
        Utils::isAdmin();
        
        $producto = new Producto();
        $productos = $producto->getAll();
        
        // return $productos;
        
        require_once 'views/producto/gestion.php';
    }
    
    public function crear() {
        Utils::isAdmin();
        
        require_once "views/producto/crear.php";
    }
    
    public function save() {
        Utils::isAdmin();
        if(isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            // $imagen = isset($_POST['imagen']) ? $_POST['imagen'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            
            if($nombre && $precio && $stock && $categoria && $descripcion) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);
                $producto->setDescripcion($descripcion);
                
                if(isset($_FILES['imagen'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
                    
                    
                    if($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif") {
                        
                        if(!is_dir('uploads/images')) {
                            
                            mkdir('uploads/images', 0777, true);
                        }
                        
                        move_uploaded_file($file['tmp_name'], 'uploads/images/'. $filename);
                        $producto->setImagen($filename);
                    }
                    
                }
                
                if(isset($_GET['id_producto'])){
                    $id = $_GET['id_producto'];
                    $producto->setId_producto($id);
                    if(isset($_POST['eliminar'])) {
                        $delete = $producto->delete();
                    } else {
                        $edit = $producto->edit();                    
                    }
                } else {
                    $save = $producto->save();
                    
                }
                
                if ($delete) {
                    $_SESSION['delete'] = "Completed";
                } 
                
                if ($edit) {
                    $_SESSION['edit'] = "Completed";
                } 
                
                if($save) {
                    $_SESSION['producto'] = "Completed";
                } 
                
            } else {
                $_SESSION['producto'] = "Failed";
            }
        } else {
            $_SESSION['producto'] = "Failed";
        }
        header('Location:' . base_url . 'producto/gestion');
    }
    
    public function editar(){
        Utils::isAdmin();
        if(isset($_GET['id_producto'])) {
            $id_producto = $_GET['id_producto'];
            $edit = true;
            
            $producto = new Producto();
            $producto->setId_producto($id_producto);
            
            $pro = $producto->getOne();
            
            require_once "views/producto/crear.php";
        } else {
            header('Location:'. base_url .'producto/gestion');
        }
        
    }
}
