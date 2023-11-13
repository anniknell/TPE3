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

            $user = $this->model->getByUser($user);

            
            if (isset($user)) {
              if (password_verify($pass, $user->password)) {
                $userdata = ["id" => $user->id, "usuario" => $user->usuario];
                $token = $this->authHelper->createToken($userdata);
                $this->view->response($token, 200);
                return;
              }
            }
            $this->view->response('El usuario o contraseña son incorrectos.', 401);
          }
        }
