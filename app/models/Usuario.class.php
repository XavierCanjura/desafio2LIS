<?php
    class Usuario extends Validator{
        //DECLARANDO LOS ATRIBUTOS DE LA CLASE
        private $id_usuario = null;
        private $nombres = null;
        private $apellidos = null;
        private $correo = null;
        private $usuario = null;
        private $password = null;
        private $id_tipo_usuario_FK = null;
        private $estado = 1;
        
        //METODOS DE ENCAPSULAMIENTO SET Y GET

        //PARA ID_USUARIO
        public function setIdUsuario($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_usuario = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdUsuario()
        {
            return $this->id_usuario;
        }

        //PARA NOMBRES
        public function setNombres($value)
        {
            if($this->isValidateText($value, 1, 50))
            {
                $this->nombres = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getNombres()
        {
            return $this->nombres;
        }

        //PARA APELLIDOS
        public function setApellidos($value)
        {
            if($this->isValidateText($value, 1, 50))
            {
                $this->apellidos = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getApellidos()
        {
            return $this->apellidos;
        }

        //PARAR CORREO
        public function setCorreo($value)
        {
            if($this->isValidateEmail($value))
            {
                $this->correo = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getCorreo()
        {
            return $this->correo;
        }

        //PARA USUARIO
        public function setUsuario($value)
        {
            if($this->isValidateAlphanumeric($value, 1, 25))
            {
                $this->usuario = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getUsuario()
        {
            return $this->usuario;
        }

        //PARA PASSWORD
        // password_hash($this->clave, PASSWORD_DEFAULT);
        public function setPassword($value)
        {
            if($this->isValidateAlphanumeric($value, 1, 25))
            {
                $this->password = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getPassword()
        {
            return $this->password;
        }

        //PARA ID_TIPO_USUARIO
        public function setIdTipoUsuario($value)
        {
            if($this->isValidateId($value))
            {
                $this->id_tipo_usuario_FK = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getIdTipoUsuario()
        {
            return $this->id_tipo_usuario_FK;
        }

        //PARA ESTADO
        public function setEstado($value)
        {
            if($this->isValidateVisibilidad($value))
            {
                $this->estado = $value;
                return true;
            }
            else
            {
                return false;
            }
        }

        //METODOS PARA EL CRUD DE USUARIOS
        public function checkUsuarios()
        {
            $sql = "SELECT COUNT(*) FROM usuarios";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getUsuarios()
        {
            $sql = "SELECT id_usuario, nombres, apellidos, correo, usuario, tu.tipo_usuario FROM usuarios u
            INNER JOIN tipos_usuario tu ON u.id_tipo_usuario_FK = tu.id_tipo_usuario
            WHERE tu.id_tipo_usuario != 3";
            $params = array();
            return Database::getRows($sql, $params);
        }
        
        public function getUsuarioForId()
        {
            $sql = "SELECT nombres, apellidos, correo, usuario, id_tipo_usuario_FK as id_tipo_usuario FROM usuarios WHERE id_usuario = ? AND id_tipo_usuario_FK != 3";
            $params = array($this->id_usuario);
            return Database::getRow($sql, $params);
        }

        public function createUsuario()
        {
            $hash = password_hash($this->password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO usuarios(nombres, apellidos, correo, usuario, password, id_tipo_usuario_FK, estado) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $params = array($this->nombres, $this->apellidos, $this->correo, $this->usuario, $hash, $this->id_tipo_usuario_FK, $this->estado);
            return Database::executeRow($sql, $params);
        }

        public function updateUsuario()
        {
            $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, correo = ?, usuario = ?, id_tipo_usuario_FK = ? WHERE id_usuario = ?";
            $params = array($this->nombres, $this->apellidos, $this->correo, $this->usuario, $this->id_tipo_usuario_FK, $this->id_usuario);
            return Database::executeRow($sql, $params);
        }

        public function deleteUsuario()
        {
            $sql = "DELETE FROM usuarios WHERE id_usuario = ?";
            $params = array($this->id_usuario);
            return Database::executeRow($sql, $params);
        }

        //METODOS PARA EL CRUD DE CLIENTES
        public function getClientes()
        {
            $sql = "SELECT id_usuario, nombres, apellidos, correo, usuario, estado FROM usuarios 
            WHERE id_tipo_usuario_FK = 3";
            $params = array();
            return Database::getRows($sql, $params);
        }

        public function getClienteForId()
        {
            $sql = "SELECT nombres, apellidos, correo, usuario, estado FROM usuarios WHERE id_usuario = ? AND id_tipo_usuario_FK = 3";
            $params = array($this->id_usuario);
            return Database::getRow($sql, $params);
        }

        public function updateCliente()
        {
            $sql = "UPDATE usuarios SET nombres = ?, apellidos = ?, correo = ?, usuario = ? WHERE id_usuario = ?";
            $params = array($this->nombres, $this->apellidos, $this->correo, $this->usuario, $this->id_usuario);
            return Database::executeRow($sql, $params);
        }

        public function changeVisibility()
        {
            $sql = "UPDATE usuarios SET estado = ? WHERE id_usuario = ?";
            $params = array($this->estado, $this->id_usuario);
            return Database::executeRow($sql, $params);
        }

        //METODOS PARA EL CRUD DE AUTHENTICATION
        public function checkPassword()
        {
            $sql = "SELECT id_usuario, password FROM usuarios WHERE usuario = ?";
            $params = array($this->usuario);
            $usuario = Database::getRow($sql, $params);
            if($usuario)
            {
                if(password_verify($this->password, $usuario['password']))
                {
                    $this->id_usuario = $usuario['id_usuario'];
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }

        public function getInfoSession()
        {
            $sql = "SELECT id_usuario, nombres, apellidos, correo, usuario, id_tipo_usuario_FK as id_tipo_usuario, estado FROM usuarios 
            WHERE id_usuario = ?";
            $params = array($this->id_usuario);
            return Database::getRow($sql, $params);
        }

        public function logout()
        {
            return session_destroy();
        }
    }

?>