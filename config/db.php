<?php 

class Database {
    public static function connect() {
        $db = new mysqli('localhost', 'root', '', 'tienda_master');
        $db -> query("SET NAME 'utf8'");
        
        return $db;
    }
}
?>