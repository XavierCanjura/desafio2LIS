<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
?>
<form action='<?=PATH?>/categoria/update/<?=$categoria['id_categoria']?>' method='POST' class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Categoria', 'categoria', isset($categoria['categoria']) ? $categoria['categoria'] : '', 'text', 'Ingrese una categoria');
    ?>
    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='editar'>Editar categoria</button>
        <a class='btn btn-secondary' href="<?=PATH?>/categoria/">Cancelar</a>
    </div>
</form>