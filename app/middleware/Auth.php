<?php
    class Auth{
        //FUNCION PARA VALIDAR SI HA INICIADO SESION, SI NO SE ENVIA AL LOGIN
        public static function checkAuth()
        {
            if(!isset($_SESSION['auth']))
            {
                $path = PATH;
                header("Location: $path/auth");
            }
        }

        //FUNCION PARA VALIDAR SI ES CLIENTE O NO
        public static function checkAdminEmpleado()
        {
            $path = PATH;
            if($_SESSION['auth']['id_tipo_usuario'] == 3)
            {
                header("Location: $path/public/");
            }
        }

        //FUNCION PARA VALIDAR SI ES ADMINISTRADOR O EMPLEADO
        public static function checkAdmin()
        {
            $path = PATH;
            if($_SESSION['auth']['id_tipo_usuario'] == 2)
            {
                header("Location: $path/producto/");
            }
        }
    }
?>