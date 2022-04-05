
<div class="row">
    <div class='col my-3'>
        <a class="btn btn-primary" href="<?=PATH?>/producto/create" role="button">Agregar Producto</a>
    </div>
</div>
<div class="row">
    <?php
        Page::dataTable(['Codigo', 'Nombre', 'Descripcion', 'Precio', 'Categoria', 'Existencias', 'Acciones'], $productos, 'producto'); 
    ?>
</div>