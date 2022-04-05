<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, '');
    }
?>
<form action='<?=PATH?>/categoria/store' method='POST' class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Categoria', 'categoria', isset($categoria['categoria']) ? $categoria['categoria'] : '', 'text', 'Ingrese una categoria');
    ?>
    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='crear'>Crear categoria</button>
        <a class='btn btn-secondary' href="<?=PATH?>/categoria/">Cancelar</a>
    </div>
</form>