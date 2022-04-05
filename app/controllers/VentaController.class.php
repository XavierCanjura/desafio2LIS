<?php
    require_once('./app/models/Factura.class.php');
    class VentaController extends Controller{
        private $model;

        function __construct()
        {
            Auth::checkAuth();
            $this->model = new Factura;
        }

        //FUNCION PARA INDEX
        public function index()
        { 
            $this->view('index.php', 'Ventas');
        }

        //FUNCION PARA LA VISTA DE CREAR
        public function create(){}

        //FUNCION PARA CREAR REGISTRO
        public function store(){}

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        public function show(){}

        //FUNCION PARA VISTA DE EDITAR
        public function edit(){}

        //FUNCION PARA EDITAR REGISTRO
        public function update(){}

        //FUNCION PARA ELIMINAR REGISTRO
        public function delete(){}
    }

?>