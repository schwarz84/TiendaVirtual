<?php 

class Usuario {
    private $id_usuario;
    private $nombre;
    private $apellidos;
    private $correo;
    private $pass;
    private $rol;
    private $imagen;
    private $db;
    
    // Conexion a la base de datos    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    // Getters
    
    function getId_usuario() {
        return $this->id_usuario;
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
    function getApellidos() {
        return $this->apellidos;
    }
    
    function getCorreo() {
        return $this->correo;
    }
    
    function getPass() {
        return password_hash($this->db->real_escape_string($this->pass), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    
    function getRol() {
        return $this->rol;
    }
    
    function getImagen() {
        return $this->imagen;
    }
    
    // Setters
    
    function setId_usuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }
    
    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    function setApellidos($apellidos) {
        $this->apellidos = $this->db->real_escape_string($apellidos);
    }
    
    function setCorreo($correo) {
        $this->correo = $this->db->real_escape_string($correo);
    }
    
    function setPass($pass) {
        $this->pass = $pass;
    }
    
    function setRol($rol) {
        $this->rol = $rol;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;
    }
    
    public function save() {
        $sql= "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getCorreo()}', '{$this->getPass()}', 'user', NULL);";
        $save = $this->db->query($sql);
            
        $result = false;
        
        if($save) {
            $result = true;
        }
        return $result;
    }
    
    public function login() {
        // Comprobar si existe el usuario
        $result = False;
        $correo = $this->correo;
        $pass = $this->pass;    
        
        $sql = "SELECT * FROM usuarios WHERE correo = '$correo'";
        $login = $this->db->query($sql);
        
        if ($login && $login->num_rows == 1) {
            $usuario =$login->fetch_object();
            
            // verificamos la pass
            $verify = password_verify($pass, $usuario->pass);
            
            if ($verify) {
                $result = $usuario;
            }
        }
        return $result;
        
    }
    
}

?>