<?php
    require_once('../app/models/productos.class.php');
    try
    {
        if(isset($_GET['codigo']))
        {
            $productoC = new Productos;
            if($productoC->setCodigo($_GET['codigo']))
            {
                if($productoC->getProductoForId())
                {
                    if(isset($_POST['eliminar']))
                    {
                        if($productoC->deleteProducto())
                        {
                            Page::showMessage(1, 'Producto eliminado', './index.php');
                        }
                        else
                        {
                            throw new Exception('Ocurrio un problema al eliminar el producto, vuelva a intentarlo');
                        }
                    }
                }
                else
                {
                    //Validacion que no hay registro con ese codigo
                    Page::showMessage(3, 'El producto no existe', './index.php');
                }
            }
            else
            {
                //Validacion de si el codigo es valido
                Page::showMessage(3, 'Codigo invalido', './index.php');
            }
        }
        else
        {
            //Validacion de si se ha enviado el codigo por GET
            Page::showMessage(3, 'Seleccione un producto', './index.php');
        }
    }
    catch(Exception $error)
    {
        Page::showMessage(3, $error->getMessage(), '');
    }
    require_once('../app/views/productos/delete_view.php');
?>