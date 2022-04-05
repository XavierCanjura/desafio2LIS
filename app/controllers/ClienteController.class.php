<?php
    require_once('./app/models/Usuario.class.php');
    class ClienteController extends Controller{
        private $model;

        function __construct()
        {
            Auth::checkAuth();
            Auth::checkAdminEmpleado();
            Auth::checkAdmin();
            $this->model = new Usuario;
        }

        //FUNCION PARA INDEX
        public function index()
        {
            $viewBag['clientes'] = $this->model->getClientes();
            $this->view('index.php', 'Clientes', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create(){}

        //FUNCION PARA CREAR REGISTRO
        public function store(){}

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show(){}

        //FUNCION PARA VISTA DE EDITAR
        public function edit($id = '')
        {
            $viewBag = array();
            try
            {
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('El id del cliente es invalido');
                }

                $cliente = $this->model->getClienteForId();
                if(!$cliente)
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('No existe un cliente con esa id');
                }

                $cliente['id_usuario'] = $id;
                $viewBag['cliente'] = $cliente;
                $this->view('update.php', 'Editar Cliente', $viewBag);
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Cliente', $viewBag);
            }
        }

        //FUNCION PARA EDITAR REGISTRO
        public function update($id = '')
        {
            $viewBag = array();
            $cliente = array();
            try
            {
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('El id del cliente es invalido');
                }

                $cliente = $this->model->getClienteForId();
                if(!$cliente)
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('No existe un cliente con esa id');
                }

                if(isset($_POST['editar']))
                {
                    extract($_POST);
                }

                $cliente['id_usuario'] = $id;
                $cliente['nombres'] = $nombres;
                $cliente['apellidos'] = $apellidos;
                $cliente['correo'] = $correo;
                $cliente['usuario'] = $usuario;

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
                if(!$this->model->setUsuario($usuario))
                {
                    throw new Exception('Ingrese el nombre de usuario');
                }
                //FIN DE VALIDACIONES DE CAMPOS

                if($this->model->updateCliente())
                {
                    $path = PATH;
                    header("Location: $path/cliente/");
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                $viewBag['cliente'] = $cliente;
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Cliente', $viewBag);
            }
        }

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}

        //FUNCION PARA CAMBIAR LA VISIBILIDAD DEL CLIENTE
        public function visibility($id = '')
        {
            $viewBag = array();
            try
            {
                if(!$this->model->setIdUsuario($id))
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('El id del cliente es invalido');
                }
                $cliente = $this->model->getClienteForId();
                if(!$cliente)
                {
                    $viewBag['redirect'] = PATH.'/cliente/';
                    throw new Exception('No existe un cliente con esa id');
                }

                $estado = $cliente['estado'];
                $newEstado = $estado == 1 ? 0 : 1;
                if(!$this->model->setEstado($newEstado))
                {
                    throw new Exception('Estado invalido');
                }

                if($this->model->changeVisibility())
                {
                    $path = PATH;
                    header("Location: $path/cliente/");
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch (Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $viewBag['clientes'] = $this->model->getClientes();
                $this->view('index.php', 'Clientes', $viewBag);
            }
        }
    }
?>