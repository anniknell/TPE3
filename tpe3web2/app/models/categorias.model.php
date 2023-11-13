<?php
    
    require_once './app/models/model.php';
    class CategoriasModel extends Model{

        public function getAllCategorias() {
            $query = $this->db->prepare('SELECT * FROM categoria');
            $query->execute();
            $categorias=$query->fetchAll(PDO::FETCH_OBJ);;
            
            return $categorias;
        }
    
        public function getCategoriaById($categoriaID) {        
            $query = $this->db->prepare("SELECT * FROM categoria WHERE CategoriaID = ?");
            $query->execute([$categoriaID]);
            return $query->fetch(PDO::FETCH_OBJ);
        }
    
        public function insertCategoria($nombre) {
            
            $query = $this->db->prepare('INSERT INTO categoria (Nombre) VALUES(?)');
            $query->execute([$nombre]);
            
            return $this->db->lastInsertId();
            
        }
        function editCategoria($nombre, $categoriaID){
            $query = $this->db->prepare('UPDATE categoria SET Nombre=? WHERE CategoriaID=?');
            $query->execute([$nombre, $categoriaID]);
        }
    }
    