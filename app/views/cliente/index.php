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
                        $headers = ['Id', 'Nombres', 'Apellidos', 'Correo', 'Usuario', 'Estado', 'Acciones'];
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
                    foreach($clientes as $cliente)
                    {
                        print("<tr>");
                        for($i = 0; $i < count($headers) - 1; $i++)
                        {
                            if(5 === $i)
                            {
                                $cliente[$i] === 1 ? print('<td>Activo</td>') : print('<td>Inactivo</td>');
                            }
                            else
                            {
                                print("
                                    <td>$cliente[$i]</td>
                                ");
                            }
                        }
                        
                        print("
                                <td id='actions'>
                                    <a class='btn btn-primary' href='$path/cliente/edit/$cliente[0]' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'>
                                        <i class='bi bi-pencil-fill'></i>
                                    </a>
                        ");
                        $cliente['estado'] === 1 ? print("
                                    <a class='btn btn-danger' href='$path/cliente/visibility/$cliente[0]' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Inhabilitar'>
                                        <i class='bi bi-eye-slash'></i>
                                    </a>
                        ") : print("
                                    <a class='btn btn-success' href='$path/cliente/visibility/$cliente[0]' role='button' data-bs-toggle='tooltip' data-bs-placement='top' title='Habilitar'>
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