<?php
    class Routing{
        public $url;
        public $controller;
        public $method;
        public $param;

        function __construct($url)
        {
            $this->url = explode("/", $url);
            $this->controller = empty($this->url[0]) ? 'index' : $this->url[0];
            $this->controller .= 'Controller';
            $this->method = empty($this->url[1]) ? 'index' : $this->url[1];
            $this->param = empty($this->url[2]) ? '' : $this->url[2];
        }
    }
?>