<?php  
    require_once('./app/models/Usuario.class.php');
    require_once('./app/models/TipoUsuario.class.php');
    
    class UsuarioController extends Controller{

        private $model;
        private $tiposusuario;
        function __construct()
        {
            Auth::checkAuth();
            Auth::checkAdminEmpleado();
            Auth::checkAdmin();
            $this->model = new Usuario;
            $this->tiposusuario = new TipoUsuario;
        }

        public function Saludo($id)
        {
            echo '<h1>Hola soy el controlador de usuarios y el parametro es '.$id;
        }

        public function indexExample()
        {
            try
            {
                $viewBag['productos'] = $this->model->getUsuarios();
                if(!$this->model->setIdUsuario('1'))
                {
                    throw new Exception('Ingrese Datos');

                }
                else
                {
                    $this->view('index.php', 'Usuarios', $viewBag);
                }
            }
            catch(Exception $error)
            {
                $viewBag['errores'] = $error->getMessage();
                $this->view('index.php', 'Usuarios', $viewBag);
            }
            
        }

        //FUNCION PARA INDEX
        public function index()
        {
            $viewBag['usuarios'] = $this->model->getUsuarios();
            $this->view('index.php', 'Usuarios', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create()
        {
            $viewBag['tipos_usuario'] = $this->tiposusuario->getTiposUsuario();
            $this->view('create.php', 'Crear Usuario', $viewBag);
        }

        //FUNCION PARA CREAR REGISTRO
        public function store()
        {
            $viewBag = array();
            $usuarioData = array();
            try
            {
                if(isset($_POST['crear']))
                {
                    extract($_POST);
                }

                $usuarioData['nombres'] = $nombres;
                $usuarioData['apellidos'] = $apellidos;
                $usuarioData['correo'] = $correo;
                $usuarioData['id_tipo_usuario'] = $id_tipo_usuario;
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
                if(!$this->model->setIdTipoUsuario($id_tipo_usuario))
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
                    $path = PATH;
                    header("Location: $path/usuario/");
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                $viewBag['tipos_usuario'] = $this->tiposusuario->getTiposUsuario();
                $viewBag['usuario'] = $usuarioData;
                $viewBag['error'] = $error->getMessage();
                $this->view('create.php', 'Crear Usuario', $viewBag);
            }
        }

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show(){}

        //FUNCION PARA VISTA DE EDITAR
        public function edit($id = '')
        {
            $viewBag = array();
            try
            {
                $viewBag['tipos_usuario'] = $this->tiposusuario->getTiposUsuario();
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('El id del usuario es invalido');
                }

                $usuarioData = $this->model->getUsuarioForId();
                if(!$usuarioData)
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('No existe un usuario con esa id');
                }

                $usuarioData['id_usuario'] = $id;
                $viewBag['usuario'] = $usuarioData;
                $this->view('update.php', 'Editar Usuario', $viewBag);
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Usuario', $viewBag);
            }
        }

        //FUNCION PARA EDITAR REGISTRO
        public function update($id = '')
        {
            $viewBag = array();
            $usuarioData = array();
            try
            {
                $viewBag['tipos_usuario'] = $this->tiposusuario->getTiposUsuario();
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('El id del usuario es invalido');
                }

                $usuarioData = $this->model->getUsuarioForId();
                if(!$usuarioData)
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('No existe un usuario con esa id');
                }

                if(isset($_POST['editar']))
                {
                    extract($_POST);
                }

                $usuarioData['id_usuario'] = $id;
                $usuarioData['nombres'] = $nombres;
                $usuarioData['apellidos'] = $apellidos;
                $usuarioData['correo'] = $correo;
                $usuarioData['id_tipo_usuario'] = $id_tipo_usuario;
                $usuarioData['usuario'] = $usuario;

                //VALIDACIONES DE CAMPOS
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
                if(!$this->model->setIdTipoUsuario($id_tipo_usuario))
                {
                    throw new Exception('Selecione el tipo de usuario');
                }
                if(!$this->model->setUsuario($usuario))
                {
                    throw new Exception('Ingrese el nombre de usuario');
                }
                //FIN DE VALIDACIONES DE CAMPOS

                if($this->model->updateUsuario())
                {
                    $path = PATH;
                    header("Location: $path/usuario/");
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
                $this->view('update.php', 'Editar Usuario', $viewBag);
            }
        }

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete($id = '')
        {
            $viewBag = array();

            try
            {
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('El id del usuario es invalido');
                }

                if(!$this->model->getUsuarioForId())
                {
                    $viewBag['redirect'] = PATH.'/usuario/';
                    throw new Exception('No existe un usuario con esa id');
                }
                else
                {
                    if(isset($_POST['eliminar']))
                    {
                        if($this->model->deleteUsuario())
                        {
                            $path = PATH;
                            header("Location: $path/usuario/");
                        }
                        else
                        {
                            throw new Exception(Database::getException());
                        }
                    }
                    else
                    {
                        $usuarioData['id_usuario'] = $id;
                        $viewBag['usuario'] = $usuarioData;
                        $this->view('delete.php', 'Eliminar Usuario', $viewBag);
                    }
                }
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('delete.php', 'Eliminar Usuario', $viewBag);
            }
        }
    }

?>