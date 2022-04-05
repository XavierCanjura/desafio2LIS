<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }

    Page::cardDelete('¿Esta seguro de eliminar la categoria?', 'La categoria sera eliminada permanentemente', $categoria['id_categoria'], 'categoria');
?>