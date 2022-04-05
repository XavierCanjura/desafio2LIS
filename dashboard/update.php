<?php
    require_once('../app/views/template/page.class.php');
    Page::templateHeader("TextilExport - Editar Producto");
    Page::templateNavbarDash();
    require_once('../app/controllers/update_controller.php');
    Page::templateFooter();
?>