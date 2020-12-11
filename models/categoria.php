<?php 

class Categoria {
    private $id_categoria;
    private $nombre;
    
    private $db;
    
    // Conexion a la base de datos    
    public function __construct() {
        $this->db = Database::connect();
    }
    
    function getId_categoria() {
        return $this->id_categoria;
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
    function setId_categoria($id_categoria){
        $this->id_categoria = $id_categoria;
    }
    
    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    public function getAll() {
        
        $sql = 'SELECT * FROM categorias ORDER BY id_categoria DESC;' ;
        $categorias = $this->db->query($sql);
        
        return $categorias;
    }

    public function getOne() {

        $sql = "SELECT * FROM categorias WHERE id_categoria={$this->getId_categoria()};";
        $categorias = $this->db->query($sql);
       
        return $categorias->fetch_object();
    }
    
    public function save() {
        
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
        $save = $this->db->query($sql);
        
        $result = false;
        
        if($save) {
            $result = true;
        }
        
        return $result;
    }
    
}

?>