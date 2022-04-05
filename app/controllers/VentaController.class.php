<?php
    require_once('./app/models/Factura.class.php');
    require_once('./app/models/DetalleFactura.class.php');
    class VentaController extends Controller{
        private $model;
        private $detalleFactura;

        function __construct()
        {
            Auth::checkAuth();
            $this->model = new Factura;
            $this->detalleFactura = new DetalleFactura;
        }

        //FUNCION PARA INDEX
        public function index()
        {
            $viewBag['ventas'] = $this->model->getFacturas();
            $this->view('index.php', 'Ventas', $viewBag);
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create(){}

        //FUNCION PARA CREAR REGISTRO
        public function store(){}

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show()
        {
            
        }

        //FUNCION PARA VISTA DE EDITAR
        public function edit(){}

        //FUNCION PARA EDITAR REGISTRO
        public function update(){}

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}


    }

?>