<?php 

class Pedido {
    private $id_pedido;
    private $usuario_id;
    private $provincia;
    private $localidad;
    private $direccion;
    private $costo;
    private $estado;
    private $fecha;
    private $hora;
    
    private $db;
    
    // Conexion a la Base de datos
    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters
    
    function getId_pedido() {
        return $this->id_pedido;
    }
    
    function getUsuario_id() {
        return $this->usuario_id;
    }
    
    function getProvincia() {
        return $this->provincia;
    }
    
    function getLocalidad() {
        return $this->localidad;
    }
    
    function getDireccion(){
        return $this->direccion;
    }
    
    function getCosto() {
        return $this->costo;
    }
    
    function getEstado() {
        return $this->estado;
    }
    
    function getFecha() {
        return $this->fecha;
    }
    
    function getHora() {
        return $this->hora;
    }
    
    // Setters
    
    function setId_pedido($id_pedido) {
        $this->id_pedido = $id_pedido;
    }
    
    function setUsuario_id($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
    
    function setProvincia($provincia) {
        $this->provincia = $this->db->real_escape_string($provincia);
    }
    
    function setLocalidad($localidad) {
        $this->localidad = $this->db->real_escape_string($localidad);
    }
    
    function setDireccion($direccion) {
        $this->direccion = $this->db->real_escape_string($direccion);
    }
    
    function setCosto($costo) {
        $this->costo = $costo;
    }
    
    function setEstado($estado) {
        $this->estado = $estado;
    }
    
    function setFecha($fecha) {       
        $this->fecha = $fecha;
    }
    
    function setHora($hora) {
        $this->hora = $hora;        
    }
    
    public function getAll() {
        $sql = "SELECT * FROM pedidos ORDER BY id_pedido DESC;";
        $productos = $this->db->query($sql);
        // echo $sql;
        // echo $this->db->error;
        
        // var_dump($productos->fetch_object());
        // die();
        return $productos;        
    }
    
    public function getOne() {
        $sql = "SELECT * FROM pedidos WHERE id_pedido = '{$this->getId_pedido()}';";
        $producto = $this->db->query($sql);
        
        return $producto->fetch_object();
    }
    
    public function getOneByUser() {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id_pedido DESC LIMIT 1 ;";
        $producto = $this->db->query($sql);
        
        // echo $sql;
        // echo $this->db->error;
        // die();
        
        return $producto->fetch_object();
    }

    public function getAllByUser() {
        $sql = "SELECT * FROM pedidos WHERE usuario_id = {$this->getUsuario_id()} ORDER BY id_pedido;";
        $producto = $this->db->query($sql);

        // echo $sql;
        // echo $this->db->error;
        // die();

        return $producto;
    }
    
    public function getProductByPedido($id_pedido){
        $sql = "SELECT pr.* , lp.unidades FROM productos pr INNER JOIN lineas_pedidos lp on pr.id_producto = lp.producto_id WHERE lp.pedido_id = {$id_pedido} ";

        $productos = $this->db->query($sql);
        
        return $productos;
    }
   
    public function save() {
        // Acordate que los campos con valores numericos no se ingresan con comillas simples
        $sql = "INSERT INTO pedidos VALUE(NULL, '{$this->getUsuario_id()}', '{$this->getProvincia()}', '{$this->getLocalidad()}', '{$this->getDireccion()}', {$this->getCosto()}, 'Confirm', CURDATE(), CURTIME());";
        
        $save = $this->db->query($sql);
        // var_dump($sql);
        // die();
        $result = false;
        if($save) {
            $result = true;
        }
        
        return $result;
    }
    
    public function save_linea() {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        
        $pedido_id = $query->fetch_object()->pedido;
        
        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id_producto}, {$elemento['unidades']});";
            
            $save = $this->db->query($insert);
            
        }
        $result = false;
        if($save) {
            $result = true;
        }
        return $result;
    }    
    
    public function editOne() {
        $sql = "UPDATE pedidos SET estado='{$this->getEstado()}' WHERE id_pedido='{$this->getId_pedido()}' ;";
        $save = $this->db->query($sql);
        
        // var_dump($sql);
        // var_dump($save);
        // die();
        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
        
    }
}
