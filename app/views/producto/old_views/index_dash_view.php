<h1 class='text-center'>Administración de Productos</h1>
<div class="container">
    <div class="row">
        <div class='col my-3'>
            <a class="btn btn-primary" href="create.php" role="button">Agregar Producto</a>
        </div>
    </div>
    <div class="row">
        <table class="table table-striped table-responsive">
            <thead>
                <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Codigo</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Existencias</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($productos as $producto)
                    {
                        print("
                        <tr>
                            <td><img src='../web/img/$producto->img' width='100' /></td>
                            <td scope='row'>".$producto->codigo."</th>
                            <td>".$producto->nombre."</td>
                            <td class='descripcion'>".$producto->descripcion."</td>
                            <td>".$producto->categoria."</td>
                            <td>$".$producto->precio."</td>
                            <td>".$producto->existencias."</td>
                            <td>
                                <a class='btn btn-success' href='update.php?codigo=".$producto->codigo."' role='button'><i class='bi bi-pencil'></i></a>
                                <a class='btn btn-danger' href='delete.php?codigo=".$producto->codigo."' role='button'><i class='bi bi-trash'></i></a>
                            </td>
                        </tr>
                        ");
                    }
                ?>
            </tbody>
        </table>
    </div>

</div>