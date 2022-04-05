<?php
    require_once('./app/models/Producto.class.php');
    require_once('./app/models/DetalleFactura.class.php');
    require_once('./app/models/Factura.class.php');
    class PublicController extends Controller{
        private $model;
        private $factura;
        private $detalleFatura;
        function __construct()
        {
            $this->model = new Producto;
            $this->factura = new Factura;
            $this->detalleFatura = new DetalleFactura;
        }

        //FUNCION PARA INDEX
        public function index()
        {
            $viewBag['productos'] = $this->model->getProductosPublic();
            $this->view('index.php', 'Productos', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create(){}

        //FUNCION PARA CREAR REGISTRO
        public function store(){}

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show($id = '')
        {
            if($this->model->setCodigoProducto($id))
            {
                $producto = $this->model->getProductoPublic()[0];
                echo json_encode($producto);
            }
        }

        //FUNCION PARA VISTA DE EDITAR
        public function edit(){}

        //FUNCION PARA EDITAR REGISTRO
        public function update(){}

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}

        //LOGICA PARA AGREGAR PRODUCTOS AL CARRITO
        public function addCart()
        {
            try
            {
                $body = file_get_contents('php://input'); //Se obtiene los valores enviados por fetch 
                $data = json_decode($body); //Se convierte a un array
                if(!isset($_SESSION['auth']['id_usuario']))
                {
                    throw new Exception('Necesita iniciar sesion para comprar productos');
                }

                if(!isset($_SESSION['id_factura']))
                {
                    if(!$this->factura->setIdUsuario($_SESSION['auth']['id_usuario']))
                    {
                        throw new Exception('Necesita iniciar sesion para comprar productos');
                    }

                    if(!$this->factura->setTotal(0))
                    {
                        throw new Exception('Total no valido');
                    }

                    if($this->factura->createFactura())
                    {
                        $_SESSION['id_factura'] = $this->factura->getIdFactura();
                    }
                    else
                    {
                        throw new Exception('Ocurrio un problema al crear la factura');
                    }
                }

                if(!$this->detalleFatura->setIdFactura($_SESSION['id_factura']))
                {
                    throw new Exception('El id de factura es invalido');
                }
                if(!$this->detalleFatura->setCodigoProducto($data->codigo))
                {
                    throw new Exception('El codigo del producto es invalido');
                }
                if(!$this->detalleFatura->setCantidad($data->cantidad))
                {
                    throw new Exception('Ingrese cantidad en numeros');
                }

                if($this->detalleFatura->existDetalleFactura())
                {
                    $cantidad = $this->detalleFatura->getCantidad();
                    $newCantidad = $cantidad + $data->cantidad;
                    $this->detalleFatura->setCantidad($newCantidad);
                    if($this->detalleFatura->updateDetalleFactura())
                    {
                        // $this->detalleFatura->setIdFactura($_SESSION['id_factura']);
                        $count = $this->detalleFatura->countDetalleFactura();
                        echo json_encode([ "count" => $count[0]]);
                    }
                    else
                    {
                        throw new Exception('No se modifico el producto del carrito');
                    }
                }
                else
                {
                    if($this->detalleFatura->createDetalleFactura())
                    {
                        $this->detalleFatura->setIdFactura($_SESSION['id_factura']);
                        $count = $this->detalleFatura->countDetalleFactura();
                        echo json_encode([ "count" => $count[0]]);
                    }
                    else
                    {
                        throw new Exception('No se agrego el producto al carrito');
                    }
                }
            }
            catch(Exception $error)
            {
                echo json_encode(["error" => $error->getMessage()]);
            }
        }

        //FUNCION PARA MOSTRAR EL CARRITO
        public function cart()
        {
            $viewBag = array();
            try
            {
                if(!isset($_SESSION['id_factura']))
                {
                    $viewBag['redirect'] = PATH.'/public/';
                    throw new Exception('Agrega productos al carrito');
                }
                $this->detalleFatura->setIdFactura($_SESSION['id_factura']);
                $detallesFactura = $this->detalleFatura->getDetalleFacturaForId();
                if(count($detallesFactura) == 0)
                {
                    $viewBag['redirect'] = PATH.'/public/';
                    throw new Exception('Agrega productos al carrito');
                }
                
                $viewBag['detalles'] = $detallesFactura;
                $viewBag['total'] = $this->detalleFatura->total();
                $this->view('cart.php', 'Carrito', $viewBag);

            }
            catch(Exception $error)
            {
                $viewBag['error'] = $error->getMessage();
                $this->view('cart.php', 'Carrito', $viewBag);
            }
            
        }

        //FUNCION PARA RELIZAR LA COMPRAR
        public function buy()
        {
            try
            {
                $this->detalleFatura->setIdFactura($_SESSION['id_factura']);
                $total = number_format($this->detalleFatura->total(), 2);
                if(!$this->factura->setTotal($total))
                {
                    throw new Exception('Ocurrio un problema al generar la factura 2');
                }
                if(!$this->factura->setIdFactura($_SESSION['id_factura']))
                {
                    throw new Exception('Ocurrio un problema al generar la factura 1');
                }
                if($this->factura->updateFactura())
                {
                    //To do: Generar pdf de factura
                }
                else
                {
                    throw new Exception(Database::getException());
                }
            }
            catch(Exception $error)
            {
                echo json_encode(["error" => $error->getMessage()]);
            }
        }
    }
?>