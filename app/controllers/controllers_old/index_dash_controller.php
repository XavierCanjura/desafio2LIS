<?php
    require_once('../app/models/productos.class.php');
    $productoC = new Productos;
    $productos = $productoC->getProductos();
    require_once('../app/views/productos/index_dash_view.php');
?>