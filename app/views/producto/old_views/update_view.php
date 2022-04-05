<?php
    if(isset($error))
    {
        Page::showMessage(2, $error, isset($redirect) ? $redirect:'');
    }
?>

<form action='<?=PATH?>/producto/add' method="POST" autocomplete="off" enctype= 'multipart/form-data'>
    
    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='editar'>Crear producto</button>
        <a class='btn btn-secondary' href="<?=PATH?>/producto/">Cancelar</a>
    </div>
</form>