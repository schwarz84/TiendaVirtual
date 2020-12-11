<?php 

class Utils {
    public static function deleteSession($name) {
        
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        
        return $name;
    }
    
    public static function isAdmin() {
        
        if(!isset($_SESSION['Administrador'])) {
            header('Location:'. base_url);
        } else {
            return true;
        }
    }

    public static function isLogged(){

        if (!isset($_SESSION['identity'])) {
            header('Location:' . base_url);
        } else {
            return true;
        }
    }
    
    public static function showCategorias() {
        
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        
        return $categorias;
        
    }
    
    public static function statscarrito() {
        $stats = array(
            'count' => 0,
            'total' => 0
        );
        
        if(isset($_SESSION['carrito'])) {
            foreach($_SESSION['carrito'] as $producto) {
                $stats['count'] += $producto['unidades'];
            }
            
            foreach($_SESSION['carrito'] as $producto) {
                $stats['total'] += $producto['precio'] * $producto['unidades']; 
            }
        }
        return $stats;
    }
    
    public static function showStatus($status) {
        $estado = "Pendiente";
        
        switch($status) {
            case "confirm":
                $estado = "Pendiente";
            break;
            case "preparation":
                $estado = "En preparacion";
            break;
            case "ready":
                $estado = "Listo para enviar";
            break;
            case "sended":
                $estado = "Enviado";
            break;
        }
        
        return $estado;
    }
}

?>