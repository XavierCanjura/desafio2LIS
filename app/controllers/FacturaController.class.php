<?php
    require_once('./app/models/DetalleFactura.class.php');
    require_once('./app/models/Factura.class.php');
    class FacturaController extends Controller{
        private $pdf;
        private $detalleFactura;
        private $model;

        function __construct()
        {
            $this->detalleFactura = new DetalleFactura;
            $this->model = new Factura;
        }

        //FUNCION PARA LA VISTA DEL INDEX
        public function index()
        {
            $id = $_SESSION['id_factura'];
            $this->detalleFactura->setIdFactura($id);
            $viewBag['detalles'] = $this->detalleFactura->getDetalleFacturaForId();
            $viewBag['total'] = $this->detalleFactura->total()[0];
            $usuario['nombres'] = $_SESSION['auth']['nombres'];
            $usuario['apellidos'] = $_SESSION['auth']['apellidos'];
            $usuario['usuario'] = $_SESSION['auth']['usuario'];
            $usuario['correo'] = $_SESSION['auth']['correo'];
            $viewBag['usuario'] = $usuario;
            $this->renderPDF('crearPDF.php', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create(){}

        //FUNCION PARA CREAR REGISTRO
        public function store(){}

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show($id = '')
        {
            $this->detalleFactura->setIdFactura($id);
            $detalles = $this->detalleFactura->getDetalleFacturaForId();
            $this->model->setIdFactura($id);
            $infoCliente = $this->model->getFacturaForId();
            $usuario['nombres'] = $infoCliente['nombres'];
            $usuario['apellidos'] = $infoCliente['apellidos'];
            $usuario['usuario'] = $infoCliente['usuario'];
            $usuario['correo'] = $infoCliente['correo'];
            $viewBag['usuario'] = $usuario;
            $viewBag['detalles'] = $detalles;
            $viewBag['total'] = $this->detalleFactura->total()[0];
            $this->renderPDF('crearPDF.php', $viewBag);
        }

        //FUNCION PARA VISTA DE EDITAR
        public function edit(){}

        //FUNCION PARA EDITAR REGISTRO
        public function update(){}

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}
    }
?>