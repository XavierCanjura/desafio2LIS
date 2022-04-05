<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Factura</title>
    <link rel="stylesheet" href="http://localhost/desafio2/app/views/assets/css/stylePDF.css">
</head>
<body>
<div id="page_pdf">
	<table id="factura_head">
		<tr>
			<td class="logo_factura">
				<div>
					<img src="http://localhost/desafio2/app/views/assets/img/logo1.png" width='100px'>
				</div>
			</td>
			<td class="info_empresa">
				<div>
					<span class="h2">Textil Export</span>
					<p>Colonia Escalon, San Salvador</p>
					<p>Teléfono: +503 2235-8421</p>
					<p>Email: desafio2@udb.com</p>
				</div>
			</td>
			<td class="info_factura">
				<div class="round">
					<span class="h3">Factura</span>
					<p>No. Factura: <strong><?=$detalles[0]['id_factura']?></strong></p>
					<p>Fecha: <?=$detalles[0]['fecha']?></p>
				</div>
			</td>
		</tr>
	</table>
	<table id="factura_cliente">
		<tr>
			<td class="info_cliente">
				<div class="round">
					<span class="h3">Cliente</span>
					<table class="datos_cliente">
						<tr>
							<td><label>Nombres:</label><p><?=$usuario['nombres']?></p></td>
							<td><label>Apellidos:</label><p><?=$usuario['apellidos']?></p></td>
						</tr>
						<tr>
							<td><label>Usuario:</label> <p><?=$usuario['usuario']?></p></td>
							<td><label>Correo:</label> <p><?=$usuario['correo']?></p></td>
						</tr>
					</table>
				</div>
			</td>

		</tr>
	</table>

	<table id="factura_detalle">
			<thead>
				<tr>
					<th width="150px">Nombre</th>
					<th class="textleft">Descripción</th>
					<th class="textright" width="50px">Precio Unitario.</th>
					<th class="textright">Cantidad</th>
					<th class="textright" width="50px">Subtotal</th>
				</tr>
			</thead>
			<tbody id="detalle_productos">
				<?php
					foreach($detalles as $detalle)
					{
						print("<tr>");
                            print("
                                <td>$detalle[nombre]</td>
								<td>$detalle[descripcion]</td>
                                <td class='textright'>$detalle[precio]</td>
                                <td class='textright'>$detalle[cantidad]</td>
                                <td class='textright'>".number_format($detalle['precio'] * $detalle['cantidad'], 2)."</td>
                            ");
                            print("</tr>");
					}
				?>
			</tbody>
			<tfoot id="detalle_totales">
				<tr>
					<td colspan="4" class="textright"><span>Total</span></td>
					<td class="textright"><span><?=$total?></span></td>
				</tr>
		</tfoot>
	</table>
	<div>
		<p class="nota">Si usted tiene preguntas sobre esta factura, <br>pongase en contacto con nombre, teléfono y Email</p>
		<h4 class="label_gracias">¡Gracias por su compra!</h4>
	</div>

</div>

</body>
</html>
