<?php
    class FacturaController extends Controller{
        private $pdf;

        function __construct()
        {
        }

        public function index()
        {
            $this->view('crearPDF.php', '');
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