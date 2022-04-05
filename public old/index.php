<?php
    require_once('../app/views/template/page.class.php');
    Page::templateHeader("TextilExport - Público");
    Page::templateNavbarPublic();
    Page::templateSlider();
    require_once("../app/controllers/index_public_controller.php");
    Page::templateFooter();
?>