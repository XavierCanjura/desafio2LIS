<?php
    class Factura extends Validator{
        //DECLARACION DE ATRIBUTOS
        private $id_factura = null;
        private $id_usuario_FK = null;
        private $total = null;
        private $fecha = null;

        //METODOS DE ENCAPSULAMIENTO SET Y GET
        //PARA ID_FACTURA
        public function setIdFactura($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_factura = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdFactura()
        {
            return $this->id_factura;
        }

        //PARA ID_USUARIO_FK
        public function setIdUsuario($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_usuario_FK = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdUsuario()
        {
            return $this->id_usuario_FK;
        }

        //PARA TOTAL
        public function setTotal($value)
        {
            if($this->isValidateMoney($value))
            {
                $this->total = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getTotal()
        {
            return $this->total;
        }

        //PARA FECHA
        public function setFecha($value)
        {
            if($this->isValidateFecha($value))
            {
                $this->fecha = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getFecha()
        {
            return $this->fecha;
        }

        //METODOS PARA EL CRUD
        public function getFacturas()
        {
            $sql = "SELECT id_factura, u.usuario, fecha, total FROM facturas f 
            INNER JOIN usuarios u ON f.id_usuario_FK = u.id_usuario 
            ORDER BY fecha DESC";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getFacturaForId()
        {
            $sql = "SELECT * FROM facturas f 
            INNER JOIN usuarios u ON f.id_usuario_FK = u.id_usuario 
            WHERE f.id_factura = ?";
            $params = array($this->id_factura);
            return Database::getRow($sql, $params);
        }
        public function createFactura()
        {
            $today = date('y-m-d');
            $sql = "INSERT INTO facturas(id_usuario_FK, total, fecha) VALUES (?, ?, ?)";
            $params = array($this->id_usuario_FK, $this->total, $today);
            $factura = Database::executeRow($sql, $params);
            if($factura)
            {
                $this->id_factura = Database::getLastRowId();
                return true;
            }
            else
            {
                return false;
            }
        }
        public function updateFactura()
        {
            $sql = "UPDATE facturas SET total = ? WHERE id_factura = ?";
            $params = array($this->total, $this->id_factura);
            return Database::executeRow($sql, $params);
        }
        public function deleteFactura(){}
    }
?>