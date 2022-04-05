<?php
    require_once('../app/views/template/page.class.php');
    Page::templateHeader("TextilExport - Administración");
    Page::templateNavbarDash();
    require_once('../app/controllers/index_dash_controller.php');
    Page::templateFooter();
?>