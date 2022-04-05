<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
?>
<div class="row mb-3">
    <div class='table-responsive'>
        <table class='table table-hover' style='width:100%'>
			<thead>
				<tr>
                    <th colspan='2' class='text-center'>Producto</th>
                    <th>Precio unitario</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($detalles))
                    {
                        $path = PATH;
                        foreach($detalles as $detalle)
                        {
                            print("<tr>");
                            print("
                                <td>
                                    <img src='../../app/views/assets/img/$detalle[imagen]' alt='$detalle[nombre]' width='150px'>
                                </td>
                                <td>$detalle[nombre]</td>
                                <td>$detalle[precio]</td>
                                <td>$detalle[cantidad]</td>
                                <td>".number_format($detalle['precio'] * $detalle['cantidad'], 2)."</td>
                            ");
                            print("</tr>");
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <h4 class='d-flex justify-content-end'>Total: <?=isset($total[0]) ? number_format($total[0], 2) : ''?></h4>
    <div class = 'd-flex justify-content-end my-2'>
        <a class='btn btn-secondary me-3' href="<?=PATH?>/public/">Elegir mas productos</a>
        <button class="btn btn-primary" type="submit" id='shop'>Comprar</button>
    </div>
</div>

<div class='modal fade' id='modalCard' role='dialog'>
    <div class='modal-dialog modal-lg'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='btn-close' onclick="$('#modalCard').modal('hide')"></button>
            </div>
            <div class='modal-body'>
                <form method="POST" class="row g-3 needs-validation" novalidate>
                    <div class='col-md-6'>
                        <label for='tarjeta' class='form-label'>Número de tarjeta de credito o debido</label>
                        <input type='text' class='form-control' id='tarjeta' name='tarjeta' required>
                        <div class='invalid-feedback'>
                            Ingrese el numero de tarjeta
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for='cvv' class='form-label'>CVV</label>
                        <input type='text' class='form-control' id='cvv' name='cvv' required>
                        <div class='invalid-feedback'>
                            Ingrese el CVV de su tarjeta(se encuentra en la parte de atras)
                        </div>
                    </div>
                    <div class='col-md-6'>
                        <label for='fecha' class='form-label'>Fecha de vencimiento</label>
                        <input type='text' class='form-control' id='fecha' name='fecha' required>
                        <div class='invalid-feedback'>
                            Ingrese la fecha de vencimiento
                        </div>
                    </div>
                    

                    <div class="d-flex col-12 justify-content-center">
                        <button class="btn btn-primary me-3" type="submit" id='buy'>Pagar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>