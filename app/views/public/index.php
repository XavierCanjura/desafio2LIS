<section class="">
    <div class="container px-4 px-lg-5 mt-3">
        <form action='<?=PATH?>/public/' method="POST" class='mb-3'>
            <div class="row d-flex justify-content-end">
                <div class='col-md-3'>
                    <input type='text' class='form-control' id='txtbuscar' name='txtbuscar' placeholder='Buscar por nombre'>
                </div>
                <div class="col col-auto ">
                    <button class='btn btn-primary' type="submit" name='buscar'>Buscar</button>
                </div>
            </div>
        </form>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
        <?php
            foreach($productos as $producto)
            {
                $exist =  ((int)$producto['existencias']) > 0 ? "<p>".$producto['existencias']."</p>" : "<p class='red-text'>Producto no disponible</p>";

                print("
                <div class='col col-md-4 mb-3 '>
                    <div class='card h-100'>
                        <!-- Product image-->
                        <img class='card-img-top' src='../app/views/assets/img/".$producto['imagen']."' alt='...' />
                        <!-- Product details-->
                        <div class='card-body p-4'>
                            <div class='text-center'>
                                <!-- Product name-->
                                <h5 class='fw-bolder'>".$producto['nombre']."</h5>
                                <!-- Product price-->
                                $".$producto['precio']."
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                            <div class='text-center'>
                                <a class='btn btn-outline-dark mt-auto' href='javascript:void(0)' onclick = 'details(`".$producto['codigo_producto']."`)'>Ver producto</a>
                            </div>
                        </div>
                    </div>
                </div>
                ");
            }
        ?>
            <!-- Modal content-->
            <div class='modal fade' id='modal' role='dialog'>
                <div class='modal-dialog modal-lg'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                            <button type='button' class='btn-close' onclick="$('#modal').modal('hide')"></button>
                        </div>
                        <div class='modal-body d-flex flex-column'>
                            <div class='row'>
                                <div class='col col-md-6'>
                                    <div class='d-flex justify-content-center'>
                                        <img id='imagen' src='' width='350' />
                                    </div>
                                </div>
                                <div class='col col-md-6'>
                                    <h4 class='text-center' id='nameProduct'></h4>
                                    <label class='fw-bold'>Descripción:</label>
                                    <p style='text-align: justify' id='description'></p>
                                    <label class='fw-bold'>Categoria:</label>
                                    <p id='category'></p>
                                    <label class='fw-bold'>Precio:</label>
                                    <p id='price'></p>
                                    <label class='fw-bold'>Existencias:</label>
                                    <p id='stock'></p>
                                    <div class="mb-3 col-2" id='selectCant'>
                                        <label class='fw-bold'>Cantidad:</label>
                                        <input type="number" class="form-control" id="cantidad" name = 'cantidad' min='1' value='1'>
                                    </div>
                                    <div>
                                        <button class='btn btn-secondary' type="submit" id='addCart'>Agregar a tu carrito</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin de Modal -->
        </div>
    </div>
</section>