<?php 

require_once 'models/pedido.php';

class pedidoController {
    public function hacer() {
        
        
        require_once 'views/pedido/hacer.php';
    }
    
    public function add() {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id_usuario;
            
            $provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false; 
            
            $stats = Utils::statscarrito();
            $costo = $stats['total'];
            
            
            if($provincia || $localidad || $direccion) {
                // Guardar datos en la base de datos
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($provincia);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCosto($costo);
                
                $save = $pedido->save();
                
                $save_linea = $pedido->save_linea();
                
                if($save || $save_linea) {
                    unset($_SESSION['carrito']);
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed"; 
            }
            header('Location:'. base_url . 'pedido/confirmado');
        } else {
            // Redirigo a la pagina principal
            header('Location:'. base_url);
        }        
    }
    
    public function confirmado(){
        
        if(isset($_SESSION['identity'])){
            $identity = $_SESSION['identity'];
            $pedido   = new Pedido();
            
            $pedido->setUsuario_id($identity->id_usuario);
            $pedido = $pedido->getOneByUser();
            
            $pedido_producto = new Pedido();
            $productos = $pedido_producto->getProductByPedido($pedido->id_pedido);
            
        }
        require_once 'views/pedido/confirmado.php';
    }
    
    public function mis_pedidos() {
        Utils::isLogged();
        
        $id_usuario = $_SESSION['identity']->id_usuario;
        $pedido = new Pedido();
        $pedido->setUsuario_id($id_usuario);
        $pedido = $pedido->getAllByUser();
        
        // var_dump($pedido);
        // die();
        
        
        
        require_once 'views/pedido/mis_pedidos.php';
    }
    
     public function detalle() {
        Utils::isLogged();
        if($_GET['id_pedido']){
            $id_pedido = $_GET['id_pedido'];
            
            $pedido   = new Pedido();
            $pedido->setId_pedido($id_pedido);
            $pedido = $pedido->getOne();

            $pedido_producto = new Pedido();
            $productos = $pedido_producto->getProductByPedido($pedido->id_pedido);
            
            require_once 'views/pedido/detalle.php';
        } else {
            header('Location:'. base_url . 'pedido/mis_pedidos');
        }
        
    }
    
    public function gestion() {
        Utils::isAdmin();
        
        $gestion = true;
        
        $pedido = new Pedido();
        $pedido = $pedido->getAll();
        // var_dump($pedidos);
        // var_dump($pedidos->fetch_object());
        // die();
                
        require_once 'views/pedido/mis_pedidos.php';
    }
    
    public function estado() {
        Utils::isAdmin();
        
        if (isset($_POST['pedido_id']) && isset($_POST['estado'])) {
            
            // Datos del formulario
            $id_pedido = $_POST['pedido_id'];
            $estado = $_POST['estado'];
            
            //Actualizar pedido
            $pedido = new Pedido();
            $pedido->setId_pedido($id_pedido);
            $pedido->setEstado($estado);
            $pedido->editOne();
            // $gestion = true;
            
            isset($_POST['bandera']) ? $enlace = "&gestion=" . 1 : "";
            
            
            // $gestion = $_POST;
            // var_dump($gestion);
            // die();
            
            
            header("Location:". base_url . 'pedido/detalle&id_pedido='. $id_pedido. $enlace);
            
        } else {
            header("Location:". base_url);
        }
    }
}
