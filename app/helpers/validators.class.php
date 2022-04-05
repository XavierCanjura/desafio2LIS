<?php
    class Validator{
        //Funcion para validar el codigo del producto, recibe el valor del codigo
        public function isValidateCodigo($value)
        {
            if(preg_match("/PROD[0-9]{5}$/", $value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //FUNCION PARA VALIDAR ID'S
		public function isValidateId($value)
		{
			if(filter_var($value, FILTER_VALIDATE_INT, array('options'=> array('min_range' => 1))))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

        //Funcion para validar que solo sea texto, recibe el valor del campo y cuanto es el minimo y el maximo de caracteres
        public function isValidateText($value, $minimum, $maximum)
        {
            if(preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{".$minimum.",".$maximum."}$/", $value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //Funcion para validar texto y numeros, recibe el valor del campo y cuanto es el minimo y el maximo de caracteres
        public function isValidateAlphanumeric($value, $minimum, $maximum)
        {
            if(preg_match("/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\.\,]{".$minimum.",".$maximum."}$/", $value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //Funcion para validar que solo sean numeros
        public function isValidateNumeric($value)
        {
            if(preg_match("/^(\d*\.)?\d+$/", $value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //FUNCION PARA VALIDAR FECHA EN FORMATO aaaa-mm-dd
		public function isValidateFecha($value)
		{
			if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$value))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

        //FUNCION PARA VALIDAR CORREOS ELECTRONICOS
		public function isValidateEmail($email)
		{
			if(filter_var($email, FILTER_VALIDATE_EMAIL))
			{
				return true;
			}
			else
			{
				return false;
			}
		}

        //Funcion para validar los campos de dinero
        public function isValidateMoney($value)
        {
            if(preg_match("/^[0-9]+(?:\.[0-9]{1,2})?$/", $value))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //Funcion para validar si es imagen o no
        public function isImage($archivo)
        { 
            if( preg_match("/\.(jpg|png)$/", $archivo))
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        //Validamos que sea un codigo de tipo byte
		public function isValidateVisibilidad($value)
        {
			if($value == 0 || $value == 1)
            {
				return true;
			}
            else
            {
				return false;
			}
		}
    }

?>