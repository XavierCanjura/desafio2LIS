<?php
    if(isset($error))
    {
        Page::showMessage(3, $error, isset($redirect) ? $redirect:'');
    }
?>
<div class="row">
    <div class='table-responsive'>
        <table id='dataTable' class='table table-hover' style='width:100%'>
			<thead>
				<tr>
                    <?php
                        $path = PATH;
                        $headers = ['Id', 'Usuario', 'Fecha', 'Total', 'Acciones'];
                        foreach($headers as $header)
                        {
                            print("
                                <th>$header</th>
                            ");
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($ventas as $venta)
                    {
                        print("<tr>");
                        for($i = 0; $i < count($headers) - 1; $i++)
                        {
                            print("
                                <td>$venta[$i]</td>
                            ");
                        }
                        
                        print("
                                <td id='actions'>
                                    <a class='btn btn-success' href='$path/factura/show/$venta[0]' target='_blank' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Ver Factura'>
                                        <i class='bi bi-eye'></i>
                                    </a>
                        ");
                        print("
                                    
                                </td>
                            </tr>
                        ");
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>