<?php
    require_once "./app/models/productos.model.php";
    require_once "./app/helpers/auth.helper.php";
    require_once 'app/controllers/api.controller.php';

    class ProductosController extends ApiController{
        private $model;
        private $authHelper;

        function __construct(){
            parent::__construct();
            $this->model = new ProductosModel();
            $this->authHelper = new AuthHelper();
            
        }
      
            function getProductos($params = []) {
                if (empty($params)){
    
                    
                    $get=array_keys($_GET);//Convierto lo obtenido en _GET en un arreglo numerico para preguntar por la segunda posición 
                    
                    /*Pregunto si es estan definidos los parametros de ordenamiento
                    o si no hay ninguno definido*/
                    if(isset($_GET['sort'])||isset($_GET['order'])||!isset($get[1])){
                        $this->getOrdenado();
                        return;
                    }
    
                    //Pregunta si estan definidos los filtros
                    if(isset($_GET['ProductoID'])||isset($_GET['Nombre'])||isset($_GET['Descripcion'])||isset($_GET['Precio'])){
                        $this->getFiltro($get);                   
                        return;
                    }
    
                    //Pregunta si esta definido el paginado
                  
                    $this->view->response("No existen esos parametros", 404);
                    return;
    
    
                } else{       
                    
                    //verifico que sea un numero (un ID)
                    if(!is_numeric($params[':ID'])){
                        $this->view->response("No existen esos parametros", 404);
                        return;
                    }
    
                    $producto = $this->model->getProductosbyid($params[':ID']);
                    if(!empty($producto)){
                        $this->view->response($producto , 200);
                        return;
                    }else{
                        $this->view->response("No existe producto con ese ID", 404);
                        return;
                    }
                }
            }
        
       
        function getOrdenado(){

            $sort =  $_GET['sort']??  'ProductoID'; //si no hay parametro de ordenamiento se asigna ID
            $order =  $_GET['order']?? 'asc';//si no hay parametro de ordenamiento se asigna ASC

            // Verifica que la dirección de ordenamiento sea válida
            if (!in_array($order, ['asc', 'desc']) || !in_array($sort, ['ProductoID', 'Nombre', 'Precio', 'Descripcion'])) {
                $this->view->response("Dirección de ordenamiento no válida", 400);
                return;
            }
            $productos= $this->model->getProductos($sort,$order);  
            $this->view->response($productos, 200);
            return;

        }

        function getFiltro($get){
            $filtro=$get[1];
            $condicion=$_GET[$filtro];
            
            $productos= $this->model->getProductosPorFiltro($filtro,$condicion);
            if(!empty($productos)){
                $this->view->response($productos, 200);
                return;
            }else{
                $this->view->response("No hay productos para ese filtro",404);
                return;
            }            
        }


        function insertProducto($params = null){
            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->view->response("Unauthorized", 401);
                return;
            }

            if($user->role!='ADMIN') {
                $this->view->response("Forbidden", 403);
                return;
            }

            $body = $this->getData();
            
            $nombre = $body->Nombre;
            $descripcion = $body->Descripcion;
            $precio = $body->Precio;
            $categoria = $body->CategoriaID;
            if(empty($nombre)||empty($descripcion)||empty($precio)||empty($categoria)){
                $this->view->response(["faltan campos por completar"], 400);
            }else{
                $id = $this->model->insertProducto($nombre,$descripcion,$precio,$categoria);
                $producto = $this->model->getProductosbyid($id);
                $this->view->response($producto, 200);
            }
        }
        function updateProducto($params = null){
            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->view->response("Unauthorized", 401);
                return;
            }

            if($user->role!='ADMIN') {
                $this->view->response("Forbidden", 403);
                return;
            }

            $id = $params[":ID"];
            $body = $this->getdata();
            $nombre = $body->Nombre;
            $descripcion = $body->Descripcion;
            $precio = $body->Precio;
            $categoria = $body->CategoriaID;

            if(empty($nombre)||empty($descripcion)||empty($precio)||empty($categoria)){
                $this->view->response(["faltan campos por completar"], 400);

            }
            $producto = $this->model->getProductosbyid($id);
            if($producto){
                $this->model->updateProducto($id,$nombre,$descripcion,$precio,$categoria);
                $this->view->response( $producto, 200);
            }else{
                $this->view->response(["producto no encontrado"],404);
                }
            }
        }