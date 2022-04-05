<?php
    class Database{
        //Declaracion de atributos
        private static $connection = null;
        private static $statement = null;
        private static $id = null;
        private static $error = null;

        //FUNCION PARA ABRIR CONEXION A LA BASE DE DATOS
        private static function connect()
        {
            $server = "localhost";
            $database = "textil_export_db";
            $username = "root";
            $password = "";
            try
            {
                @self::$connection = new PDO("mysql:host=$server; dbname=$database; charset=utf8", $username, $password);
            }
            catch(PDOException $exception)
            {
                throw new Exception($exception->getCode());
            }
        }

        //FUNCION PARA CERRAR CONEXION
        private static function desconnect()
        {
            self::$error = self::$statement->errorInfo();
            self::$connection = null;
        }

        //FUNCION PARA EJECUTAR OPERACIONES DE INSERT, UPDATE Y DELETE
        public static function executeRow($query, $values)
        {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            $state = self::$statement->execute($values);
            self::$id = self::$connection->lastInsertId();
            self::desconnect();
            return $state;
        }

        //IMPORTANT FUNCION PARA OBTENER UNA SOLA FILA CUANDO SE HACE UN SELECT
        public static function getRow($query, $values)
        {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            self::desconnect();
            return self::$statement->fetch();
        }

        //FUNCION PARA OBTENER TODAS LAS FILAS AL HACER UN SELECT
        public static function getRows($query, $values)
        {
            self::connect();
            self::$statement = self::$connection->prepare($query);
            self::$statement->execute($values);
            self::desconnect();
            return self::$statement->fetchAll();
        }

        //FUNCION PARA RETORNAR LA ULTIMA ID INSERTADA
        public static function getLastRowId()
        {
            return self::$id;
        }

        //FUNCION PARA RETORNAR LOS ERRORES DE LA BASE DE DATOS
        public static function getException()
        {
            if(self::$error[0] == "00000")
            {
                return false;
            }
            else
            {
                return self::$error[1];
            }
        }
    }
?>