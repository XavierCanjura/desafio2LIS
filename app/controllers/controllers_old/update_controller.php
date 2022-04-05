<?php
    require_once('../app/models/productos.class.php');
    try
    {
        if(isset($_GET['codigo']))
        {
            $productoC = new Productos;
            if($productoC->setCodigo($_GET['codigo']))
            {
                if($productoC->getProductoForId())
                {
                    require_once('../app/views/productos/update_view.php');

                    if(isset($_POST['editar']))
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
                                            if($_FILES['image']['name'] != "")
                                            {
                                                $extension = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
                                                $nombreImage = $_GET['codigo'].".".$extension;
                                            }
                                            else
                                            {
                                                $nombreImage = $productoC->getImagen();
                                            }
                                            if($productoC->setImagen($nombreImage))
                                            {
                                                if($productoC->updateProducto())
                                                {
                                                    if($_FILES['image']['name'] != "")
                                                    {
                                                        if(move_uploaded_file($_FILES['image']['tmp_name'], '../web/img/'.$nombreImage))
                                                        {
                                                            Page::showMessage(1, 'Producto editado', './index.php');
                                                        }
                                                        else
                                                        {
                                                            throw new Exception('Ocurrio un problema al guardar la imagen, pero el producto se guardo');
                                                        }
                                                    }
                                                    else
                                                    {
                                                        Page::showMessage(1, 'Producto editado', './index.php');
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
                }
                else
                {
                    //Validacion que no hay registro con ese codigo
                    Page::showMessage(3, 'El producto no existe', './index.php');
                }
            }
            else
            {
                //Validacion de si el codigo es valido
                Page::showMessage(3, 'Codigo invalido', './index.php');
            }
        }
        else
        {
            //Validacion de si se ha enviado el codigo por GET
            Page::showMessage(3, 'Seleccione un producto', './index.php');
        }
    }
    catch(Exception $error)
    {
        Page::showMessage(3, $error->getMessage(), '');
    }
    
?>