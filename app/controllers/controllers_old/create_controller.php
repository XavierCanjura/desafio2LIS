<?php
    require_once('../app/models/productos.class.php');
    try
    {
        if(isset($_POST['crear']))
        {
            $productoC = new Productos;
            if($productoC->setCodigo($_POST['codigo']))
            {
                if($productoC->setNombre($_POST['nombre']))
                {
                    if($productoC->setDescripcion($_POST['descripcion']))
                    {
                        if($productoC->setCategoria($_POST['categoria']))
                        {
                            if($productoC->setPrecio($_POST['precio']))
                            {
                                if($productoC->setExistencias($_POST['existencia']))
                                {
                                    //obtiene la extension de la imagen
                                    $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                                    $nombreImage = $_POST['codigo'].".".$extension;
                                    if($productoC->setImagen($nombreImage))
                                    {
                                        if($productoC->createProducto())
                                        {
                                            if(move_uploaded_file($_FILES['image']['tmp_name'], '../web/img/'.$nombreImage))
                                            {
                                                Page::showMessage(1, 'Producto creado', './index.php');
                                            }
                                            else
                                            {
                                                throw new Exception('Ocurrio un problema al guardar la imagen, pero el producto se guardo');
                                            }
                                        }
                                        else
                                        {
                                            echo 'no creado';
                                        }
                                    }
                                    else
                                    {
                                        throw new Exception('Seleccione una imagen para el producto');
                                    }
                                }
                                else
                                {
                                    throw new Exception('Ingrese el número de existencias');
                                }
                            }
                            else
                            {
                                throw new Exception('Ingrese el precio del producto');
                            }
                        }
                        else
                        {
                             throw new Exception('Seleccione la categoria del producto');
                        }
                    }
                    else
                    {
                        throw new Exception('Ingrese la descripcion del producto');
                    }
                }
                else
                {
                    throw new Exception('Ingrese el nombre del producto');
                }
            }
            else
            {
                throw new Exception('Ingrese un codigo del producto y que sea valido');
            }
        }
    }
    catch(Exception $error)
    {
        Page::showMessage(3, $error->getMessage(), null);
    }
    require_once('../app/views/productos/create_view.php');
?>