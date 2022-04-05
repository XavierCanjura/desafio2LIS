<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, '');
    }
?>
<div class='d-flex justify-content-center'>
    <div class="card my-4">
        <div class='card-login'>
            <div class='img-login'>
                <img src="<?=PATH?>/app/views/assets/img/login.jpg" alt="">
            </div>
            <div class='form-login'>
                <h1 class='text-center'>Login</h1>
                <form action="<?=PATH?>/auth/login" method="POST" class="row g-3 needs-validation" novalidate>
                    <div class='col-10 offset-1'>
                        <label for='usuario' class='form-label'>Usuario</label>
                        <input type='text' class='form-control' id='usuario' name='usuario' required>
                        <div class='invalid-feedback'>
                            Ingrese su usuario
                        </div>
                    </div>
                    <div class='col-10 offset-1'>
                        <label for='password' class='form-label'>Contraseña</label>
                        <input type='password' class='form-control' id='password' name='password' required>
                        <div class='invalid-feedback'>
                            Ingrese su contraseña
                        </div>
                    </div>

                    <div class="d-flex col-12 justify-content-center">
                        <button class="btn btn-primary me-3" type="submit" name='acceder'>Iniciar sesion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>