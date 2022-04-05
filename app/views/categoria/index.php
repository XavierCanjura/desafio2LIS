<div class="row">
    <div class='col my-3'>
        <a class="btn btn-primary" href="<?=PATH?>/categoria/create" role="button">Agregar Categoria</a>
    </div>
</div>
<div class="row">
    <?php
        Page::dataTable(['Id', 'Categoria', 'Acciones'], $categorias, 'categoria');
    ?>
</div>