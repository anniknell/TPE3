<?php 
    require_once "config.php";
    require_once "./libs/router.php";
    require_once "./app/controllers/productos.controller.php";
    require_once "./app/controllers/categorias.controller.php";
    require_once "./app/controllers/user.controller.php";
    

    $router = new Router();
    
    $router->addRoute('productos', 'GET', 'ProductosController', 'getProductos');
    $router->addRoute('productos/:ID', 'GET', 'ProductosController', 'getProductos');
    $router->addRoute('productosfil', 'GET','ProductosController','getProductos');
    $router->addRoute('productos',  'POST', 'ProductosController', 'insertProducto');
    $router->addRoute('productos/:ID', 'PUT', 'ProductosController', 'updateProducto');

    $router->addRoute('categorias/:ID', 'GET', 'CategoriasController', 'getCategorias');
    $router->addRoute('categorias', 'GET', 'CategoriasController', 'getCategorias');
    $router->addRoute('categorias/:ID', 'DELETE', 'CategoriasController', 'deleteCategoria');
    $router->addRoute('categorias', 'POST', 'CategoriasController', 'insertCategoria');
    $router->addRoute('categorias/:ID', 'PUT', 'CategoriasController', 'editCategoria');

    $router->addRoute('user/token', 'GET',  'UserApiController', 'getToken' );

    $router->Route($_GET["resource"], $_SERVER['REQUEST_METHOD']);