<?php
    require_once('./app/views/template/page.class.php');
    abstract class Controller{
        public function view($view, $title, $viewBag=array())
        {
            $file = "./app/views/".static::class."/$view";
            $file=str_replace('Controller', "", $file);
            $file = strtolower($file);
            if(is_file($file))
            {
                extract($viewBag);
                ob_start(); //Abriendo buffer
                require_once($file);
                $content = ob_get_contents(); //leyendo el contenido del buffer
                ob_end_clean(); //Cerrando el buffer
                Page::templateHeader($title);
                echo $content;
                Page::templateFooter();
            }
            else
            {
                echo "<h1>Archivo $view no existe</h1>";
            }
        }

        //FUNCION PARA INDEX
        abstract function index();

        //FUNCION PARA LA VISTA DE CREAR
        abstract function create();

        //FUNCION PARA CREAR REGISTRO
        abstract function store();

        //FUNCION PARA MOSTRAR REGISTRO (MODAL)
        abstract function show();

        //FUNCION PARA VISTA DE EDITAR
        abstract function edit();

        //FUNCION PARA EDITAR REGISTRO
        abstract function update();

        //FUNCION PARA ELIMINAR REGISTRO
        abstract function delete();

    }
?>