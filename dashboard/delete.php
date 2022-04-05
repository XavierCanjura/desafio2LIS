<?php
    require_once('../app/views/template/page.class.php');
    Page::templateHeader("TextilExport - Eliminar Producto");
    Page::templateNavbarDash();
    require_once('../app/controllers/delete_controller.php');
    Page::templateFooter();
?>