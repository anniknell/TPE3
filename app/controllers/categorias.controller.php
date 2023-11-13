<?php

    require_once "./app/models/categorias.model.php";
    require_once "app/controllers/api.controller.php";

    class CategoriasController extends ApiController{
        private $model;
        private $authHelper;

        function __construct(){
            parent::__construct();
            $this->model = new CategoriasModel();
            $this->authHelper = new AuthHelper();
            
        }
     
        function getCategorias($params = []) {
            // obtengo tareas del controlador
            $orderField = $_GET['orderField'] ?? 'categoria'; // Campo por el que se ordenarán las categorías (por defecto, 'nombre')
            $orderDirection = $_GET['orderDirection'] ?? 'asc';

            if (empty($params)){
                $categorias = $this->model->getAllCategorias($orderField, $orderDirection);

                if ($categorias) {
                    $this->view->response($categorias, 200);
                } else {
                    $this->view->response("No se encontraron categorías.", 404);
                }
            }else{
                $categorias = $this->model->getCategoriaById($params[':ID']);
                    if ($categorias) {
                        $this->view->response($categorias, 200);
                    }else{
                        $this->view->response("No se encontraron categorías con ese id.", 404);
                    }

            }

        }

        function insertCategoria() {
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

            if (empty($nombre)) {
                $this->view->response("Complete los datos", 400);
            } else {
                $categoriaID = $this->model->insertCategoria($nombre);

                // en una API REST es buena práctica es devolver el recurso creado
                $categoria = $this->model->getCategoriaById($categoriaID);
                $this->view->response($categoria, 201);
            }
        }

        function editCategoria($params = []){
            $user = $this->authHelper->currentUser();
            if(!$user) {
                $this->view->response("Unauthorized", 401);
                return;
            }

            if($user->role!='ADMIN') {
                $this->view->response("Forbidden", 403);
                return;
            }

            $categoriaID = $params[':ID'];
            $body = $this->getdata();

            $nombre = $body->Nombre;

            if(empty($nombre)){
                $this->view->response(["faltan campos por completar"], 400);
    
            }
            $categoria = $this->model->getCategoriaById($categoriaID);

            if($categoria) {
                    $this->model->editCategoria($nombre, $categoriaID);
                    $this->view->response($categoria, 200);
                }else{
                    $this->view->response('La tarea con id='.$categoriaID.' no existe.', 404);
                }
        }

    }

    