<?php
class Component{

	//FUNCION PARA CREAR LOS SELECTS
    public static function showSelect($label, $name, $value, $data, $messageError){
        print("
		<div class='col-6 col-md-4'>
			<label for='categoria' class='form-label'>$label</label>");
		print("<select class='form-select' name='$name' id='$name' required>");
		if($data)
        {
			if(!$value){
				print("<option value='' disabled selected>Seleccione una opción</option>");
			}
			foreach($data as $row){
				if($value == $row[0]){
					print("<option value='$row[0]' selected>$row[1]</option>");
				}else{
					print("<option value='$row[0]'>$row[1]</option>");
				}
			}
		}
        else
        {
			print("<option value='' disabled selected>No hay opciones disponibles</option>");
		}
		print("
			</select>
			<div class='invalid-feedback'>$messageError</div>
		</div>
		");	
	}

	//FUNCION PARA CREAR TABLA DINAMICAS
	public static function dataTable($headers, $data, $controller)
	{
		$path = PATH;
		print("
		<div class='table-responsive'>
			<table id='dataTable' class='table table-hover' style='width:100%'>
			<thead>
				<tr>
		");
		foreach($headers as $header)
		{
			print("
					<th>$header</th>
			");
		}
		print("      
				</tr>
			</thead>
			<tbody>
		");

		foreach($data as $info)
		{
			print("<tr>");
			for($i = 0; $i < count($headers) - 1; $i++)
			{

				print("
					<td>$info[$i]</td>
				");
			}
			
			print("
					<td id='actions'>
						<a class='btn btn-primary' href='$path/$controller/edit/$info[0]' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'>
							<i class='bi bi-pencil-fill'></i>
						</a>
						<a class='btn btn-danger' href='$path/$controller/delete/$info[0]' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'>
							<i class='bi bi-trash3-fill'></i>
						</a>
					</td>
				</tr>
			");
		}

		print("  
			</tbody>
			</table>
		</div>
		");
	}

	//FUNCION PARA CREAR INPUTS
	public static function textInput($label, $name, $value, $type, $messageError)
	{
		print("
			<div class='col-6 col-md-4'>
				<label for='$name' class='form-label'>$label</label>
				<input type='$type' class='form-control' id='$name' name='$name' value='$value' required>
				<div class='invalid-feedback'>
					$messageError
				</div>
			</div>
		");

		
	}

	//FUNCION PARA CREAR LA CARD DINAMICA DE ELIMINAR REGISTRO
	public static function cardDelete($message, $subMessage, $id, $controller)
	{
		$path = PATH;
		print("
		<div class='col-sm-12'>
			<div class='card'>
				<div class='card-body'>
					<h2 class='card-title text-center'>$message</h2>
					<h5 class='card-text text-center mt-3'>$subMessage</h5>
					<div class='d-flex justify-content-center mt-3'>
						<form action='$path/$controller/delete/$id' method='POST'>
							<button class ='btn btn-danger me-3' type='submit' name='eliminar'>Eliminar</button>
						</form>
						<a href='$path/$controller/' class='btn btn-secondary'>Cancelar</a>
					</div>
				</div>
			</div>
		</div>
		");
	}

	//FUNCION PARA LAS ALERTAS CON SWEETALERT
	public static function showMessage($type, $message, $url)
	{
		if(is_numeric($message))
		{
			switch($message)
			{
				case 1045:
					$text = "Autenticación desconocida";
					break;
				case 1049:
					$text = "Base de datos desconocida";
					break;
				case 1054:
					$text = "Nombre de campo desconocido";
					break;
				case 1062:
					$text = "Ya existe un registro con esa ID";
					break;
				case 1146:
					$text = "Nombre de tabla desconocido";
					break;
				case 1451:
					$text = "Registro ocupado, no se puede eliminar";
					break;
				case 2002:
					$text = "Servidor desconocido";
					break;
				default:
					$text = "Ocurrió un problema, contacte al administrador :(";
			}
		}
		else
		{
			$text = $message;
		}

		switch($type)
		{
			case 1:
				$title = "Éxito";
				$icon = "success";
				break;
			case 2:
				$title = "Error";
				$icon = "error";
				break;
			case 3:
				$title = "Advertencia";
				$icon = "warning";
				break;
			case 4:
				$title = "Aviso";
				$icon = "info";
		}

		if($url)
		{
			print("<script> swal({title: `$title`, text: `$text`, icon: `$icon`, button: 'Aceptar', closeOnClickOutside: false, closeOnEsc: false}).then(value=>{location.href = '$url'}) </script>");
		}
		else
		{
			print("<script> swal({title: `$title`, text: `$text`, icon: `$icon`, button: 'Aceptar', closeOnClickOutside: false, closeOnEsc: false}) </script>");
		}
	}
}
?>