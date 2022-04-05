<?php
    require_once('./app/models/Categoria.class.php');

    class CategoriaController extends Controller{
        private $model;

        function __construct()
        {
            Auth::checkAuth();
            Auth::checkAdminEmpleado();
            Auth::checkAdmin();
            $this->model = new Categoria;
        }

        //FUNCION PARA INDEX
        public function index()
        { 
            $viewBag['categorias'] = $this->model->getCategorias();
            $this->view('index.php', 'Categorias', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create()
        {
            $this->view('create.php', 'Crear Categoria');
        }

        //FUNCION PARA CREAR REGISTRO
        public function store()
        {
            $viewBag = array();
            $categoriaData = array();
            try
            {
                if(isset($_POST['crear']))
                {
                    extract($_POST);
                }
                $categoriaData['categoria'] = $categoria;

                if(!$this->model->setCategoria($categoria))
                {
                    throw new Exception('Ingrese solo letras');
                }

                if($this->model->createCategoria())
                {
                    header('Location:'.PATH.'/categoria/');
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                $viewBag['categoria'] = $categoriaData;
                $viewBag['error'] = $error->getMessage();
                $this->view('create.php', 'Crear Categoria', $viewBag);
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
                if(!$this->model->setIdCategoria($id))
                {
                    $viewBag['redirect'] = PATH.'/categoria';
                    throw new Exception('El id no es valida');
                }
                //To do: validar id que no existe
                $categoriaData = $this->model->getCategoriaForId();
                $categoriaData['id_categoria'] = $id;
                $viewBag['categoria'] = $categoriaData;
                $this->view('update.php', 'Editar Categoria', $viewBag);
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Categoria', $viewBag);
            }
            
        }

        //FUNCION PARA EDITAR REGISTRO
        public function update($id = '')
        {
            $viewBag = array();
            $categoriaData = array();
            try
            {
                if(!$this->model->setIdCategoria($id))
                {
                    $viewBag['redirect'] = PATH.'/categoria';
                    throw new Exception('El id no es valida');
                }
                else
                {
                    if(isset($_POST['editar']))
                    {
                        extract($_POST);
                    }
                    $categoriaData['id_categoria'] = $id;
                    $categoriaData['categoria'] = $categoria;
                    
                    if(!$this->model->setCategoria($categoria))
                    {
                        throw new Exception('Ingrese solo letras');
                    }
                    
                    if($this->model->updateCategoria())
                    {
                        header('Location:'.PATH.'/categoria/');
                    }
                    else
                    {
                        throw new Exception(Database::getException());
                    }
                }

            }
            catch(Exception $error)
            {
                $viewBag['categoria'] = $categoriaData;
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Categoria', $viewBag);
            }
        }

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete($id = '')
        {
            $viewBag = array();
            try
            {
                if(!$this->model->setIdCategoria($id))
                {
                    $viewBag['redirect'] = PATH.'/categoria';
                    throw new Exception('El id no es valida');
                }
                else
                {
                    if(isset($_POST['eliminar']))
                    {
                        if($this->model->deleteCategoria())
                        {
                            header('Location:'.PATH.'/categoria/');
                        }
                        else
                        {
                            throw new Exception(Database::getException());
                        }
                    }
                    else
                    {
                        $categoriaData['id_categoria'] = $id;
                        $viewBag['categoria'] = $categoriaData;
                        $this->view('delete.php', 'Eliminar Categoria', $viewBag);
                    }
                }
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('delete.php', 'Eliminar Categoria', $viewBag);
            }
        }
    }
?>