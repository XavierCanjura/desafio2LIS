<?php
    class Categoria extends Validator{
        //DECLARACION DE ATRIBUTOS
        private $id_categoria = null;
        private $categoria = null;

        //METODOS EN ENCAPSULAMIENTO SET Y GET
        //PARA ID_CATEGORIA
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

        //PARA CATEGORIA
        public function setCategoria($value)
        {
            if($this->isValidateText($value, 1, 15))
            {
                $this->categoria = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getCategoria()
        {
            return $this->categoria;
        }

        //METODOS PARA EL CRUD
        public function getCategorias()
        {
            $sql = "SELECT id_categoria, categoria FROM categorias";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getCategoriaForId()
        {
            $sql = "SELECT categoria FROM categorias WHERE id_categoria = ?";
            $params = array($this->id_categoria);
            return Database::getRow($sql, $params);
        }

        public function createCategoria()
        {
            $sql = "INSERT INTO categorias(categoria) VALUES (?)";
            $params = array($this->categoria);
            return Database::executeRow($sql, $params);
        }
        public function updateCategoria()
        {
            $sql = "UPDATE categorias SET categoria = ? WHERE id_categoria = ?";
            $params = array($this->categoria, $this->id_categoria);
            return Database::executeRow($sql, $params);
        }
        public function deleteCategoria()
        {
            $sql = "DELETE FROM categorias WHERE id_categoria = ?";
            $params = array($this->id_categoria);
            return Database::executeRow($sql, $params);
        }
    }

?>