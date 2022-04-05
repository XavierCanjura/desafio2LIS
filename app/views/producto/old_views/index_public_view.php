<!-- Section-->
<section class="">
    <div class="container px-4 px-lg-5 mt-3">
        <h1 class='text-center mb-3'>Productos</h1>
        <form method="POST" class='mb-3'>
            <div class="row d-flex justify-content-end">
                <div class="col col-md-3">
                <input type="text" name='txtBuscar' class="form-control" id="exampleFormControlInput1" placeholder="Buscar producto">
                </div>
                <div class="col col-auto ">
                    <button class='btn btn-primary' type="submit" name='buscar'>Buscar</button>
                </div>
            </div>
        </form>
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4">
        <?php
            for($i = 0; $i < count($productos['producto']); $i++)
            {
                $exist =  ((int)$productos['producto'][$i]->existencias) > 0 ? "<p>".$productos['producto'][$i]->existencias."</p>" : "<p class='red-text'>Producto no disponible</p>";
                
                print("
                <div class='col col-md-4 mb-3 '>
                    <div class='card h-100'>
                        <!-- Product image-->
                        <img class='card-img-top' src='../web/img/".$productos['producto'][$i]->img."' alt='...' />
                        <!-- Product details-->
                        <div class='card-body p-4'>
                            <div class='text-center'>
                                <!-- Product name-->
                                <h5 class='fw-bolder'>".$productos['producto'][$i]->nombre."</h5>
                                <!-- Product price-->
                                $".$productos['producto'][$i]->precio."
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class='card-footer p-4 pt-0 border-top-0 bg-transparent'>
                            <div class='text-center'>
                                <a class='btn btn-outline-dark mt-auto' data-toggle='modal' data-target='#modal_".$productos['producto'][$i]->codigo."'>Ver mas</a>
                            </div>
                        </div>
                        <!-- Modal content-->
                        <div class='modal fade' id='modal_".$productos['producto'][$i]->codigo."' role='dialog'>
                            <div class='modal-dialog modal-lg'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='btn-close' data-dismiss='modal' aria-label='Close'></button>
                                    </div>
                                    <div class='modal-body d-flex flex-column'>
                                        <div class='row'>
                                            <div class='col col-md-6'>
                                                <div class='d-flex justify-content-center'>
                                                    <img src='../web/img/".$productos['producto'][$i]->img."' width='350' />
                                                </div>
                                            </div>
                                            <div class='col col-md-6'>
                                                <h4 class='text-center'>".$productos['producto'][$i]->nombre."</h4>
                                                <label class='fw-bold'>Descripción:</label>
                                                <p style='text-align: justify'>".$productos['producto'][$i]->descripcion."</p>
                                                <label class='fw-bold'>Categoria:</label>
                                                <p>".$productos['producto'][$i]->categoria."</p>
                                                <label class='fw-bold'>Precio:</label>
                                                <p>$".$productos['producto'][$i]->precio."</p>
                                                <label class='fw-bold'>Existencias:</label>
                                                $exist
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ");
            }

            
        ?>
        </div>
    </div>
</section>