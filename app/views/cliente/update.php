<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
?>

<form action='<?=PATH?>/cliente/update/<?=$cliente['id_usuario']?>' method="POST" autocomplete="off" class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Nombres', 'nombres', isset($cliente['nombres']) ? $cliente['nombres'] : '', 'text', 'Ingrese los nombres del cliente' );
        Page::textInput('Apellidos', 'apellidos', isset($cliente['apellidos']) ? $cliente['apellidos'] : '', 'text', 'Ingrese los apellidos del cliente');
        Page::textInput('Correo Electrónico', 'correo', isset($cliente['correo']) ? $cliente['correo'] : '', 'email', 'Ingrese el correo electronico del cliente');
        Page::textInput('Usuario', 'usuario', isset($cliente['usuario']) ? $cliente['usuario'] : '', 'text', 'Ingrese el nombre de cliente' );
    ?>

    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='editar'>Editar Cliente</button>
        <a class='btn btn-secondary' href="<?=PATH?>/cliente/">Cancelar</a>
    </div>
</form>