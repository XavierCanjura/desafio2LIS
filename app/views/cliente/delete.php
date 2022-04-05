<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
    Page::cardDelete('¿Esta seguro de eliminar al usuario?', 'El usuario sera eliminado permanentemente', $usuario['id_usuario'], 'usuario');
?>