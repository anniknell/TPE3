<?php

        require_once './app/models/model.php';

        class ProductosModel extends Model{

        public function getProductos($sort,$order){
            $query = $this->db->prepare("SELECT producto.*, categoria.Nombre as categoria FROM producto JOIN categoria ON producto.CategoriaID = categoria.CategoriaID ORDER BY $sort $order");
            $query->execute();
            $productos = $query->fetchAll(PDO::FETCH_OBJ);

            return $productos;
        }
        function getProductosPorFiltro($filtro , $condicion){
            $query = $this->db->prepare("SELECT producto.*, categoria.Nombre as categoria FROM producto JOIN categoria ON producto.CategoriaID = categoria.CategoriaID WHERE $filtro = ?");
            $query->execute([$condicion]);
    
            $productos=$query->fetchAll(PDO::FETCH_OBJ);
    
            return $productos;
        }
        
        function getProductosbyid($id){
            $query = $this->db->prepare("SELECT producto.*, categoria.Nombre as categoria FROM producto JOIN categoria ON producto.CategoriaID = categoria.CategoriaID WHERE producto.ProductoID = ?");
            $query->execute([$id]);
            $productos = $query->fetchAll(PDO::FETCH_OBJ);
            
            return $productos;

        }
        function insertProducto($nombre,$descripcion,$precio,$categoria){
            $query = $this->db->prepare("INSERT INTO producto (Nombre,Descripcion,Precio,CategoriaID) VALUES (?,?,?,?)");
            $query->execute([$nombre,$descripcion,$precio,$categoria]);
            
            return $this->db->lastInsertId();
        }
        function updateProducto($id,$nombre,$descripcion,$precio,$categoria){
            $query = $this->db->prepare("UPDATE producto SET Nombre = ?, Descripcion = ?, Precio = ?, CategoriaID = ? WHERE ProductoID = ? ");
            $query->execute([$nombre,$descripcion,$precio,$categoria,$id]);
            
        }
    }