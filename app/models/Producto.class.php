<?php
    class Producto extends Validator
    {
        //Atributos
        private $codigo_producto = null;
        private $nombre = null;
        private $descripcion = null;
        private $imagen = null;
        private $precio = null;
        private $id_categoria = null;
        private $existencias = null;

        //Metodos SET y GET

        //Para codigo_producto
        public function setCodigoProducto($value)
        {
            if($this->isValidateCodigo($value))
            {
                $this->codigo_producto = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getCodigoProducto()
        {
            return $this->codigo_producto;
        }

        //Para nombre
        public function setNombre($value)
        {
            if($this->isValidateText($value, 1, 100))
            {
                $this->nombre = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getNombre()
        {
            return $this->nombre;
        }

        //Para descripcion
        public function setDescripcion($value)
        {
            if($this->isValidateAlphanumeric($value, 1, 1000))
            {
                $this->descripcion = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getDescripcion()
        {
            return $this->descripcion;
        }

        //Para imagen
        public function setImagen($value)
        {
            if($this->isImage($value))
            {
                $this->imagen = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getImagen()
        {
            return $this->imagen;
        }

        //Para id_categoria
        public function setIdCategoria($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_categoria = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdCategoria()
        {
            return $this->id_categoria;
        }

        //Para precio
        public function setPrecio($value)
        {
            if($this->isValidateMoney($value))
            {
                $this->precio = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getPrecio()
        {
            return $this->precio;
        }

        //PARA EXISTENCIAS
        public function setExistencias($value)
        {
            if($this->isValidateNumeric($value))
            {
                $this->existencias = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getExistencias()
        {
            return $this->existencias;
        }

        //FUNCIONES PARA HACER EL CRUD

        public function getProductos()
        {
            $sql = "SELECT codigo_producto, nombre, descripcion, precio, c.categoria, existencias FROM productos p 
            INNER JOIN categorias c ON p.id_categoria_FK = c.id_categoria";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getProductoForId()
        {
            $sql = "SELECT nombre, descripcion, imagen, precio, id_categoria_FK, existencias FROM productos WHERE codigo_producto = ?";
            $params = array($this->codigo_producto);
            $producto = Database::getRow($sql, $params);
            if($producto)
            {
                $this->nombre = $producto['nombre'];
                $this->descripcion = $producto['descripcion'];
                $this->imagen = $producto['imagen'];
                $this->precio = $producto['precio'];
                $this->id_categoria = $producto['id_categoria_FK'];
                $this->existencias = $producto['existencias'];
                return $producto;
            }
            else
            {
                return false;
            }
        }

        public function createProducto()
        {
            $sql = "INSERT INTO productos(codigo_producto, nombre, descripcion, imagen, precio, id_categoria_FK, existencias) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $params = array($this->codigo_producto, $this->nombre, $this->descripcion, $this->imagen, $this->precio, $this->id_categoria, $this->existencias);
            return Database::executeRow($sql, $params);
        }

        public function updateProducto()
        {
            $sql = "UPDATE productos SET nombre = ?, descripcion = ?, imagen = ?, precio = ?, id_categoria_FK = ?, existencias = ? WHERE codigo_producto = ?";
            $params = array($this->nombre, $this->descripcion, $this->imagen, $this->precio, $this->id_categoria, $this->existencias, $this->codigo_producto);
            return Database::executeRow($sql, $params);
        }

        public function deleteProducto()
        {
            $sql = "DELETE FROM productos WHERE codigo_producto = ?";
            $params = array($this->codigo_producto);
            $producto = Database::executeRow($sql, $params);
            if($producto)
            {
                unlink("./app/views/assets/img/".$this->imagen);
                return true;
            }
            else
            {
                return false;
            }
        }

        //METODOS PARA PUBLIC
        public function getProductosPublic()
        {
            $sql = "SELECT codigo_producto, nombre, descripcion, precio, c.categoria, imagen, existencias FROM productos p 
            INNER JOIN categorias c ON p.id_categoria_FK = c.id_categoria";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getProductoPublic()
        {
            $sql = "SELECT codigo_producto, nombre, descripcion, precio, c.categoria, imagen, existencias FROM productos p 
            INNER JOIN categorias c ON p.id_categoria_FK = c.id_categoria WHERE codigo_producto = ?";
            $params = array($this->codigo_producto);
            return Database::getRows($sql, $params);
        }
    }
?>