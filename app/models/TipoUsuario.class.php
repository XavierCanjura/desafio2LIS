<?php
    class TipoUsuario extends Validator{
        //DECLARACION DE ATRIBUTOS
        private $id_tipo_usuario = null;
        private $tipo_usuario = null;

        //METODOS DE ENCAPSULAMIENTO SET Y GET

        //PARA ID_TIPO_USUARIO
        public function setIdTipoUsuario($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_tipo_usuario = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdTipoUsuario()
        {
            return $this->id_tipo_usuario;
        }

        //PARA TIPO_USUARIO
        public function setTipoUsuario($value)
        {
            if($this->isValidateText($value, 1, 25))
            {
                $this->tipo_usuario = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        //METODOS PARA EL CRUD
        public function getTiposUsuario()
        {
            $sql = "SELECT id_tipo_usuario, tipo_usuario FROM tipos_usuario WHERE id_tipo_usuario != 3";
            $params = array();
            return Database::getRows($sql, $params);
        }
        public function createTipoUsuario(){}
        public function updateTipoUsuario(){}
        public function deleteTipoUsuario(){}
    }
?>