<?php
    require_once('./app/models/Usuario.class.php');

    class AuthController extends Controller{
        private $model;

        function __construct()
        {
            $this->model = new Usuario;
        }

        //FUNCION PARA INDEX
        public function index()
        {
            $path = PATH;
            header("Location: $path/auth/login");
            
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create()
        {
            $path = PATH;
            if($this->model->checkUsuarios() !== 0)
            {
                header("Location: $path/auth/login");
            }
            $this->view('registerAdmin.php', 'Registrar Administrador');
        }

        //FUNCION PARA CREAR REGISTRO
        public function store()
        {
            $viewBag = array();
            $usuarioData = array();
            $path = PATH;
            try
            {
                if($this->model->checkUsuarios() !== 0)
                {
                    header("Location: $path/auth/login");
                }
                if(isset($_POST['crear']))
                {
                    extract($_POST);
                }

                $usuarioData['nombres'] = $nombres;
                $usuarioData['apellidos'] = $apellidos;
                $usuarioData['correo'] = $correo;
                $usuarioData['usuario'] = $usuario;
                $usuarioData['password'] = $password;
                $usuarioData['password_confirm'] = $password_confirm;

                //VALIDACION DE CAMPOS
                if(!$this->model->setNombres($nombres))
                {
                    throw new Exception('Solo ingrese letras en los nombres');
                }
                if(!$this->model->setApellidos($apellidos))
                {
                    throw new Exception('Solo ingrese letras en los apellidos');
                }
                if(!$this->model->setCorreo($correo))
                {
                    throw new Exception('Ingrese un correo valido');
                }
                if(!$this->model->setIdTipoUsuario(1))
                {
                    throw new Exception('Selecione el tipo de usuario');
                }
                if(!$this->model->setUsuario($usuario))
                {
                    throw new Exception('Ingrese el nombre de usuario');
                }
                if($password !== $password_confirm)
                {
                    throw new Exception('Las contraseñas no son iguales');
                }
                if(!$this->model->setPassword($password))
                {
                    throw new Exception('La contraseña no puede contener caracteres especiales');
                }
                //FIN DE VALIDACION DE CAMPOS

                if($this->model->createUsuario())
                {
                    header("Location: $path/auth/login");
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                $viewBag['usuario'] = $usuarioData;
                $viewBag['error'] = $error->getMessage();
                $this->view('registerAdmin.php', 'Registrar Administrador', $viewBag);
            }
        }

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show(){}

        //FUNCION PARA VISTA DE EDITAR
        public function edit(){}

        //FUNCION PARA EDITAR REGISTRO
        public function update(){}

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}

        //FUNCION PARA LOGIN
        public function login()
        {
            $path = PATH;
            $viewBag = array();
            try
            {
                if($this->model->checkUsuarios() === 0)
                {
                    header("Location: $path/auth/create");
                }
                if(isset($_POST['acceder']))
                {
                    extract($_POST);

                    if(!$this->model->setUsuario($usuario))
                    {
                        throw new Exception('Ingrese el usuario');
                    }
                    if(!$this->model->setPassword($password))
                    {
                        throw new Exception('Ingrese la contraseña');
                    }
                    else
                    {
                        if($this->model->checkPassword())
                        {
                            $path = PATH;
                            $_SESSION['auth'] = $this->model->getInfoSession();
                            if($_SESSION['auth']['id_tipo_usuario'] != 3)
                            {
                                header("Location: $path/usuario/");
                            }
                            else
                            {
                                //To do: redirigir a public
                                header("Location: $path/cliente/");
                            }
                        }
                        else
                        {
                            throw new Exception('El usuario o la contraseña son invalidos');
                        }
                    }
                }
                else
                {
                    $this->view('login.php', '', $viewBag);
                }
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('login.php', '', $viewBag);
            }
        }

        public function logout()
        {
            $path = PATH;
            $this->model->logout();
            header("Location: $path/auth/login");
        }
    }
?>