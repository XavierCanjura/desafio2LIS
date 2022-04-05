<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
    Page::cardDelete('¿Esta seguro de eliminar el producto?', 'El producto sera eliminado permanentemente', $producto['codigo_producto'], 'producto');
?>