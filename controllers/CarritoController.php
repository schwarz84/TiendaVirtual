<?php

require_once 'models/producto.php';

class carritoController
{
    public function index() {
        $carrito = $_SESSION['carrito'];
        // var_dump($carrito);
        // die();
        if(isset($carrito)){
            require_once 'views/carrito/index.php';
            
        } else {
            header("Location:". base_url);
        }
    }
    
    public function add() {

        if (isset($_GET['id_producto'])) {
            
            $producto_id = $_GET['id_producto'];
        } else {
            
            header('Location'.base_url);
        }        
        
        if(isset($_SESSION['carrito'])) {
            
            $count = 0;
            foreach($_SESSION['carrito'] as $indice=>$elemento) {
                
                if($elemento['id_producto'] == $producto_id) {
                    $_SESSION['carrito'][$indice]['unidades']++;
                    $count++;
                }
            }
            
        } 
        if(!isset($count) || $count==0) {
            
            // Conseguir producto
            $producto = new Producto();
            $producto->setId_producto($producto_id);
            $producto = $producto->getOne();
            
            if(is_object($producto)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $producto->id_producto,
                    "precio"      => $producto->precio,
                    "unidades"    => 1,
                    "producto"    => $producto
                );                
            }
        }
        
        header('Location:'.base_url.'carrito/index');
    }
    
    public function remove(){        
        
        if (isset($_GET['indice'])) {            
            $indice = $_GET['indice'];
            unset($_SESSION['carrito'][$indice]);
        }            
            header("Location:". base_url . "carrito/index");
            
    }
    
    public function up(){
        
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $_SESSION['carrito'][$indice]['unidades']++;
            
            header("Location:" . base_url . "carrito/index");
        }
    }

    public function down() {
        
        if (isset($_GET['indice'])) {
            $indice = $_GET['indice'];
            $cuenta = $_SESSION['carrito'][$indice]['unidades'];

            if ($cuenta > 1) {
                $_SESSION['carrito'][$indice]['unidades']--;
            } else {
                unset($_SESSION['carrito'][$indice]);
            }
            header("Location:" . base_url . "carrito/index");
        }
    }
    
    public function delete_all() {
        
        unset($_SESSION['carrito']);
        header("Location:".base_url."carrito/index");
    }
    
}
?>