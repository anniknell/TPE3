<?php
   
    require_once './app/helpers/auth.helper.php';
    require_once './app/models/user.model.php';
    require_once './app/controllers/api.controller.php';

    class UserApiController extends ApiController{
        private $model;
        private $authHelper;
       

        function __construct() {
            parent::__construct();
            $this->authHelper = new AuthHelper();
            $this->model = new UserModel();
           
        }
    
        function getToken($params = []) {
            $basic = $this->authHelper->getAuthHeaders(); // Darnos el header 'Authorization:' 'Basic: base64(usr:pass)'

            if(empty($basic)) {
                $this->view->response('No envio encabezados de autenticacion.', 401);
                return;
            }

            $basic = explode(" ", $basic); // ["Basic", "base64(usr:pass)"]

            if($basic[0]!="Basic") {
                $this->view->response('Los encabezados de autenticacion son incorrectos.', 401);
                return;
            }

            $userpass = base64_decode($basic[1]); // usr:pass
            $userpass = explode(":", $userpass); // ["usr", "pass"]

            $user = $userpass[0];
            $pass = $userpass[1];

            $userdata = [ "name" => $user, "id" => 123, "role" => 'ADMIN' ]; // Llamar a la DB

            if($user == "webadmin" && $pass == "admin") {
                // Usuario es válido
                
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token,200);
            } else {
                $this->view->response('El usuario o contraseña son incorrectos.', 401);
            }
        }
    }
