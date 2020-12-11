<?php 

require_once 'models/usuario.php';

class usuarioController {
    public function index() {
        echo 'Controlador: Usuario, Accion: Index';
    }
    
    public function registro() {
        require_once 'views/usuario/registro.php';
    }
    
    public function save() {
        if(isset($_POST)) {
            
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
            $correo = isset($_POST['correo']) ? $_POST['correo'] : false;
            $pass = isset($_POST['pass']) ? $_POST['pass'] : false;
            
            if ($nombre && $apellidos && $correo && $pass) {
                
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setCorreo($correo);
                $usuario->setPass($pass);
                
                $save = $usuario->save();
                
                if ($save) {
                    $_SESSION['register'] = "complete";
                } else {
                    $_SESSION['register'] = "failed";
                }
                // var_dump($usuario);
            } else {
                $_SESSION['register'] = "failed"; 
            }
        } else {
            $_SESSION['register'] = "failed";
        }
        header("Location:".base_url);
    }
    
    public function login(){
        if(isset($_POST)) {
            
            // Identificar el Usuario
                // Consulta a la base de datos 
                $usuario = new Usuario();
                $usuario->setCorreo($_POST['correo']);
                $usuario->setPass($_POST['pass']);
                
                $identity = $usuario->login();
                
               
                
                if ($identity && is_object($identity)) {
                    $_SESSION['identity'] = $identity;
                   
                    if ($identity->rol == 'Administrador') {
                        $_SESSION['Administrador'] = True;
                    }
                    
                } else {
                    $_SESSION['error_login'] = 'Identificacion Fallida!!';
                }
                // Crear Sesion
        }
        header('Location:'.base_url);
    }
    
    public function logout() {
        if(isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['Administrador'])) {
            unset($_SESSION['Administrador']);
        }
        
        header('Location:' . base_url);
    }
}
?>