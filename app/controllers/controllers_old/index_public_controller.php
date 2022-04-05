<?php
    require_once('../app/models/productos.class.php');
    try
    {
        $productoC = new Productos;
        if(isset($_POST['buscar']))
        {
            $productosN = (array)$productoC->getProductos();
            $productos = array('producto' => array());
            for($i = 0; $i < count($productosN['producto']); $i++)
            {
                $result = preg_match("/(".$_POST['txtBuscar'].")/i", $productosN['producto'][$i]->nombre);
                if( $result !== 0)
                {
                    $productos['producto'][count($productos['producto'])] = $productosN['producto'][$i];
                }
            }
        }
        else
        {
            $productos = (array)$productoC->getProductos();
        }
    }
    catch(Exception $error)
    {
        Page::showMessage(3, $error->getMessage(), '');
    }
    require_once('../app/views/productos/index_public_view.php');
    
?>