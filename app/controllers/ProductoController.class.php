<?php
    require_once('./app/models/Producto.class.php');
    require_once('./app/models/Categoria.class.php');
    class ProductoController extends Controller{
        private $model;
        private $categorias;

        function __construct()
        {
            Auth::checkAuth();
            Auth::checkAdminEmpleado();
            $this->model = new Producto;
            $this->categorias = new Categoria;
        }

        //FUNCION PARA INDEX
        public function index()
        { 
            $viewBag['productos'] = $this->model->getProductos();
            $this->view('index.php', 'Productos', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create()
        {
            $viewBag['categorias'] = $this->categorias->getCategorias();
            $this->view('create.php', 'Crear Producto', $viewBag);
        }

        //FUNCION PARA CREAR REGISTRO
        public function store()
        {
            $viewBag = array();
            $producto = array();
            try
            {
                if(isset($_POST['crear']))
                {
                    extract($_POST);
                }

                $producto['codigo_producto'] = $codigo_producto;
                $producto['nombre'] = $nombre;
                $producto['precio'] = $precio;
                $producto['categoria'] = $categoria;
                $producto['existencias'] = $existencias;
                $producto['imagen'] = $_FILES['imagen']['name'];
                $producto['descripcion'] = $descripcion;

                //VALIDACION DE CAMPOS
                if(!$this->model->setCodigoProducto($codigo_producto))
                {
                    throw new Exception('El formato del codigo es invalido PROD#####');
                }
                if(!$this->model->setNombre($nombre))
                {
                    throw new Exception('Ingrese solo letras');
                }
                if(!$this->model->setDescripcion($descripcion))
                {
                    throw new Exception('La descripcion del producto sobre pasa los limites');
                }
                if(!$this->model->setIdCategoria($categoria))
                {
                    throw new Exception('La categoria seleccionada es invalida');
                }
                if(!$this->model->setPrecio($precio))
                {
                    throw new Exception('El precio no tiene el formato correcto');
                }
                if(!$this->model->setExistencias($existencias))
                {
                    throw new Exception('Las existencias no pueden ser negativas');
                }
                $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                $nombreImage = $codigo_producto.".".$extension;
                if(!$this->model->setImagen($nombreImage))
                {
                    throw new Exception('seleccione un formato valido para la imagen (jpg o png)');
                }
                //FIN DE VALIDACION DE CAMPOS

                if($this->model->createProducto())
                {
                    $path = PATH;
                    if(move_uploaded_file($_FILES['imagen']['tmp_name'], "./app/views/assets/img/".$nombreImage))
                    {
                        header("Location: $path/producto/");
                    }
                    else
                    {
                        throw new Exception('El producto see creo correctamente pero la imagen no se guardo');
                    }
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                $viewBag['categorias'] = $this->categorias->getCategorias();
                $viewBag['producto'] = $producto;
                $viewBag['error'] = $error->getMessage();
                $this->view('create.php', 'Crear Producto', $viewBag);
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
                $viewBag['categorias'] = $this->categorias->getCategorias();
                if(!$this->model->setCodigoProducto($id))
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('El codigo no es invalido');
                }

                $producto = $this->model->getProductoForId();
                if(!$producto)
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('No existe producto con es codigo');
                }

                $producto['codigo_producto'] = $id;
                $viewBag['producto'] = $producto;
                $this->view('update.php', 'Editar Producto', $viewBag);
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Producto', $viewBag);
            }
        }

        //FUNCION PARA EDITAR REGISTRO
        public function update($id = '')
        {
            $viewBag = array();
            $producto = array();
            $nombreImage = "";
            try
            {
                $viewBag['categorias'] = $this->categorias->getCategorias();
                if(!$this->model->setCodigoProducto($id))
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('El codigo no es invalido');
                }
                if(!$this->model->getProductoForId())
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('No existe producto con es codigo');
                }

                if(isset($_POST['editar']))
                {
                    extract($_POST);
                }

                $producto['codigo_producto'] = $id;
                $producto['nombre'] = $nombre;
                $producto['precio'] = $precio;
                $producto['id_categoria_FK'] = $id_categoria_FK;
                $producto['existencias'] = $existencias;
                $producto['imagen'] = $_FILES['imagen']['name'];
                $producto['descripcion'] = $descripcion;

                //VALIDACION DE CAMPOS
                if(!$this->model->setNombre($nombre))
                {
                    throw new Exception('Ingrese solo letras');
                }
                if(!$this->model->setDescripcion($descripcion))
                {
                    throw new Exception('La descripcion del producto sobre pasa los limites');
                }
                if(!$this->model->setIdCategoria($id_categoria_FK))
                {
                    throw new Exception('La categoria seleccionada es invalida');
                }
                if(!$this->model->setPrecio($precio))
                {
                    throw new Exception('El precio no tiene el formato correcto');
                }
                if(!$this->model->setExistencias($existencias))
                {
                    throw new Exception('Las existencias no pueden ser negativas');
                }
                if($_FILES['imagen']['name'] !== $this->model->getImagen())
                {
                    $extension = strtolower(pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION));
                    $nombreImage = $id.".".$extension;
                    if(!$this->model->setImagen($nombreImage))
                    {
                        throw new Exception('seleccione un formato valido para la imagen (jpg o png)');
                    }
                }
                else
                {
                    if(!$this->model->setImagen($this->model->getImagen()))
                    {
                        throw new Exception('seleccione un formato valido para la imagen (jpg o png)');
                    }
                    
                }
                
                //FIN DE VALIDACION DE CAMPOS

                if($this->model->updateProducto())
                {
                    $path = PATH;
                    if($_FILES['imagen']['name'] !== $this->model->getImagen())
                    {
                        if(move_uploaded_file($_FILES['imagen']['tmp_name'], "./app/views/assets/img/".$this->model->getImagen()))
                        {
                            header("Location: $path/producto/");
                        }
                        else
                        {
                            throw new Exception('El producto se creo correctamente pero la imagen no se guardo');
                        }
                    }
                    else
                    {
                        header("Location: $path/producto/");
                    }
                }
                else
                {
                    throw new Exception(Database::getException());
                }

            }
            catch(Exception $error)
            {
                $viewBag['categorias'] = $this->categorias->getCategorias();
                $viewBag['producto'] = $producto;
                $viewBag['error'] = $error->getMessage();
                $this->view('update.php', 'Editar Producto', $viewBag);
            }
        }

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete($id = '')
        {
            $viewBag = array();
            try
            {
                if(!$this->model->setCodigoProducto($id))
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('El codigo no es invalido');
                }
                if(!$this->model->getProductoForId())
                {
                    $viewBag['redirect'] = PATH.'/producto/';
                    throw new Exception('No existe producto con es codigo');
                }
                else
                {
                    if(isset($_POST['eliminar']))
                    {
                        if($this->model->deleteProducto())
                        {
                            header('Location:'.PATH.'/producto/');
                        }
                        else
                        {
                            throw new Exception(Database::getException());
                        }
                    }
                    else
                    {
                        $producto['codigo_producto'] = $id;
                        $viewBag['producto'] = $producto;
                        $this->view('delete.php', 'Eliminar Producto', $viewBag);
                    }
                }
            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('delete.php', 'Eliminar Producto', $viewBag);
            }
        }
    }
?>