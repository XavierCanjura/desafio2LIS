<?php
    require_once('../app/views/template/page.class.php');
    Page::templateHeader("TextilExport - Agregar Producto");
    Page::templateNavbarDash();
    require_once('../app/controllers/create_controller.php');
    Page::templateFooter();
?>