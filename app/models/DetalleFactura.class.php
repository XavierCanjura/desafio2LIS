<?php
    class DetalleFactura extends Validator{
        //DECLARACION DE ATRIBUTOS
        private $codigo_producto_FK = null;
        private $id_factura_FK = null;
        private $cantidad = null;

        //METODOS DE ENCAPSULAMIENTO SET Y GET
        //PARA CODIGO_PRODUCTO_FK
        public function setCodigoProducto($value)
        {
            if($this->isValidateCodigo($value))
            {
                $this->codigo_producto_FK = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getCodigoProducto()
        {
            return $this->codigo_producto_FK;
        }

        //PARA ID_FACTURA_FK
        public function setIdFactura($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_factura_FK = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdFactura()
        {
            return $this->id_factura_FK;
        }

        //PARA CANTIDAD
        public function setCantidad($value)
        {
            if($this->isValidateNumeric($value))
            {
                $this->cantidad = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getCantidad()
        {
            return $this->cantidad;
        }

        //METODOS PARA EL CRUD
        public function getDetalleFacturaForId()
        {
            $sql = "SELECT * FROM detalles_factura df 
            INNER JOIN productos p ON df.codigo_producto_FK = p.codigo_producto 
            INNER JOIN facturas f ON df.id_factura_FK = f.id_factura 
            WHERE df.id_factura_FK = ?";
            $params = array($this->id_factura_FK);
            return Database::getRows($sql, $params);
        }

        public function createDetalleFactura()
        {
            $sql = "INSERT INTO detalles_factura(codigo_producto_FK, id_factura_FK, cantidad) VALUES (?, ?, ?)";
            $params = array($this->codigo_producto_FK, $this->id_factura_FK, $this->cantidad);
            return Database::executeRow($sql, $params);
        }

        public function updateDetalleFactura()
        {
            $sql = "UPDATE detalles_factura SET cantidad = ? WHERE codigo_producto_FK = ? AND id_factura_FK = ?";
            $params = array($this->cantidad, $this->codigo_producto_FK, $this->id_factura_FK);
            return Database::executeRow($sql, $params);
        }

        public function deleteDetalleFactura(){}

        public function countDetalleFactura()
        {
            $sql = "SELECT COUNT(*) FROM detalles_factura df WHERE df.id_factura_FK = ?";
            $params = array($this->id_factura_FK);
            return Database::getRow($sql, $params);
        }

        public function existDetalleFactura()
        {
            $sql = "SELECT cantidad FROM detalles_factura WHERE codigo_producto_FK = ? AND id_factura_FK = ?";
            $params = array($this->codigo_producto_FK, $this->id_factura_FK);
            $detalle = Database::getRow($sql, $params);
            if($detalle)
            {
                $this->cantidad = $detalle['cantidad'];
                return true;
            }
            else
            {
                return false;
            }
        }

        public function total()
        {
            $sql = "SELECT SUM(df.cantidad * p.precio) as Total FROM detalles_factura df 
            INNER JOIN productos p ON df.codigo_producto_FK = p.codigo_producto 
            INNER JOIN facturas f ON df.id_factura_FK = f.id_factura 
            WHERE df.id_factura_FK = ?";
            $params = array($this->id_factura_FK);
            return Database::getRow($sql, $params);
        }

        //Consulta para calcular el total
        //SELECT SUM(df.cantidad * p.precio) as Total FROM detalles_factura df INNER JOIN productos p ON df.codigo_producto_FK = p.codigo_producto INNER JOIN facturas f ON df.id_factura_FK = f.id_factura WHERE df.id_factura_FK = 1;
    }
?>