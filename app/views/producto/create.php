<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, '');
    }
?>
<form action='<?=PATH?>/producto/store' method="POST" autocomplete="off" enctype= 'multipart/form-data' class="row g-3 needs-validation" novalidate>
    <?php
        Page::textInput('Codigo producto', 'codigo_producto', isset($producto['codigo_producto']) ? $producto['codigo_producto'] : '', 'text', 'Ingrese el codigo del producto' );
        Page::textInput('Nombre', 'nombre', isset($producto['nombre']) ? $producto['nombre'] : '', 'text', 'Ingrese el nombre del producto');
        Page::textInput('Precio', 'precio', isset($producto['precio']) ? $producto['precio'] : '', 'text', 'Ingrese el precio del producto');
        Page::showSelect('Categoria', 'categoria', isset($producto['categoria']) ? $producto['categoria'] : '', $categorias, 'Seleccione una categoria');
        Page::textInput('Existencias', 'existencias', isset($producto['existencias']) ? $producto['existencias'] : '', 'number', 'Ingrese la existencias del producto');
    ?>

    <div class="col-12 col-sm-6 col-md-4">
        <label for="imagen" class="form-label">Imagen</label>
        <input type="file" class="form-control" id='imagen' name='imagen' aria-label="file example" value='<?=isset($producto['imagen']) ? $producto['imagen'] : ''?>' required>
        <div class="invalid-feedback">Seleccione una imagen</div>
    </div>

    <div class="col-12">
        <label for="descripcion" class="form-label">Descripcion</label>
        <textarea class="form-control" id="descripcion" name='descripcion' required><?=isset($producto['descripcion']) ? $producto['descripcion'] : ''?></textarea>
        <div class="invalid-feedback">
            Ingrese la descripcion del producto
        </div>
    </div>

    <div class="d-flex col-12 justify-content-center">
        <button class="btn btn-primary me-3" type="submit" name='crear'>Crear producto</button>
        <a class='btn btn-secondary' href="<?=PATH?>/producto/">Cancelar</a>
    </div>
</form>