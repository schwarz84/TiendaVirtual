<?php 

class Producto {
    private $id_producto;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha_i;
    private $imagen;
    
    private $db;
    
    // Conexion a la Base de datos
    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters
    
    function getId_producto() {
        return $this->id_producto;
    }
    
    function getCategoria_id() {
        return $this->categoria_id;
    }
    
    function getNombre() {
        return $this->nombre;
    }
    
    function getDescripcion() {
        return $this->descripcion;
    }
    
    function getPrecio(){
        return $this->precio;
    }
    
    function getStock() {
        return $this->stock;
    }
    
    function getOferta() {
        return $this->oferta;
    }
    
    function getFecha_i() {
        return $this->fecha_i;
    }
    
    function getImagen() {
        return $this->imagen;
    }
    
    // Setters
    
    function setId_producto($id_producto) {
        $this->id_producto = $id_producto;
    }
    
    function setCategoria_id($categoria_id) {
        $this->categoria_id = $categoria_id;
    }
    
    function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    
    function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }
    
    function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }
    
    function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }
    
    function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    
    function setFecha_i($fecha_i) {       
        $this->fecha_i = $fecha_i;
    }
    
    function setImagen($imagen) {
        $this->imagen = $imagen;        
    }
    
    public function getAll() {
        $sql = "SELECT * FROM productos ORDER BY id_producto DESC;";
        $productos = $this->db->query($sql);
        
        return $productos;        
    }

    public function getAllCategoria()
    {
        $sql = "SELECT p.* FROM productos p INNER JOIN categorias c on p.categoria_id = c.id_categoria WHERE p.categoria_id = {$this->getCategoria_id()} ORDER BY id_producto DESC;";
        $productos = $this->db->query($sql);
        
        return $productos;
    }
       
    public function getRandom($limit){
        $sql = "SELECT * FROM productos ORDER BY RAND() LIMIT $limit;";
        $productos = $this->db->query($sql);
        
        return $productos;
    }
    
    public function getOne() {
        $sql = "SELECT * FROM productos WHERE id_producto = '{$this->getId_producto()}';";
        $producto = $this->db->query($sql);
        
        return $producto->fetch_object();
    }
   
    public function save() {
        // Acordate que los campos con valores numericos no se ingresan con comillas simples
        $sql = "INSERT INTO productos VALUE(NULL, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, NULL, CURDATE(),'{$this->getImagen()}');";
        
        $save = $this->db->query($sql);
        // var_dump($sql);
        // die();
        $result = false;
        if($save) {
            $result = true;
        }
        
        return $result;
    }

    public function edit(){
    
        // Acordate que los campos con valores numericos no se ingresan con comillas simples
        $sql = "UPDATE productos SET categoria_id={$this->getCategoria_id()}, nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}";
        
        if ($this->getImagen() != null){
            $sql .= ", imagen='{$this->getImagen()}'";            
        }
        
        $sql .= " WHERE id_producto = {$this->id_producto} ;";
        
        $save = $this->db->query($sql);
        
        $result = false;
        if ($save) {
            $result = true;
        }

        return $result;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id_producto = {$this->id_producto};";
        $delete = $this->db->query($sql);
        
        $result = false;
        if($delete) {
            $result = true;
        }
        
        return $result;
    }
}

?>