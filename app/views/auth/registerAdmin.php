<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, '');
    }
?>

<form action='<?=PATH?>/auth/store' method="POST" autocomplete="off" class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Nombres', 'nombres', isset($usuario['nombres']) ? $usuario['nombres'] : '', 'text', 'Ingrese los nombres del usuario' );
        Page::textInput('Apellidos', 'apellidos', isset($usuario['apellidos']) ? $usuario['apellidos'] : '', 'text', 'Ingrese los apellidos del usuario');
        Page::textInput('Correo Electrónico', 'correo', isset($usuario['correo']) ? $usuario['correo'] : '', 'email', 'Ingrese el correo electronico del usuario');
        Page::textInput('Usuario', 'usuario', isset($usuario['usuario']) ? $usuario['usuario'] : '', 'text', 'Ingrese el nombre de usuario' );
    ?>
    <h3>Contraseña</h3>
    <?php
        Page::textInput('Contraseña', 'password', isset($usuario['password']) ? $usuario['password'] : '', 'password', 'Ingrese la contraseña del usuario');
        Page::textInput('Confirmar Contraseña', 'password_confirm', isset($usuario['password_confirm']) ? $usuario['password_confirm'] : '', 'password', 'Confirme la contraseña');
    ?>

    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='crear'>Crear Administrador</button>
        <a class='btn btn-secondary' href="<?=PATH?>/usuario/">Cancelar</a>
    </div>
</form>