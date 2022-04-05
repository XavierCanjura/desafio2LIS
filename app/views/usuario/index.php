
<div class="row">
    <div class='col my-3'>
        <a class="btn btn-primary" href="<?=PATH?>/usuario/create" role="button">Agregar Usuario</a>
    </div>
</div>
<div class="row">
    <?php
        Page::dataTable(['Id', 'Nombres', 'Apellidos', 'Correo', 'Usuario', 'Tipo de usuario', 'Acciones'], $usuarios, 'usuario');
    ?>
</div>