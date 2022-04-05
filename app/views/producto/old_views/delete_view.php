<h1 class='text-center'>Eliminar Producto</h1>
<div class="container">
    <form action="" method="POST">
        <div class="alert alert-danger" role="alert">
            <h4 class='text-center'><?=$productoC->getNombre() ?> será borrada ¿está seguro?</h4>
            <div class='d-flex justify-content-center'>
                <a class="btn btn-secondary me-1" href="index.php" role="button">Cancelar</a>
                <button type="submit" name ='eliminar' class="btn btn-danger">Eliminar</button>
            </div>
        </div>
    </form>
</div>