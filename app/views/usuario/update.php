<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
?>

<form action='<?=PATH?>/usuario/update/<?=$usuario['id_usuario']?>' method="POST" autocomplete="off" class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Nombres', 'nombres', isset($usuario['nombres']) ? $usuario['nombres'] : '', 'text', 'Ingrese los nombres del usuario' );
        Page::textInput('Apellidos', 'apellidos', isset($usuario['apellidos']) ? $usuario['apellidos'] : '', 'text', 'Ingrese los apellidos del usuario');
        Page::textInput('Correo Electrónico', 'correo', isset($usuario['correo']) ? $usuario['correo'] : '', 'email', 'Ingrese el correo electronico del usuario');
        Page::showSelect('Tipo de usuario', 'id_tipo_usuario', isset($usuario['id_tipo_usuario']) ? $usuario['id_tipo_usuario'] : '', $tipos_usuario, 'Seleccione el tipo de usuario');
        Page::textInput('Usuario', 'usuario', isset($usuario['usuario']) ? $usuario['usuario'] : '', 'text', 'Ingrese el nombre de usuario' );
    ?>

    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='editar'>Editar Usuario</button>
        <a class='btn btn-secondary' href="<?=PATH?>/usuario/">Cancelar</a>
    </div>
</form>