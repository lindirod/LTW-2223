<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/main_page.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');

    $session = new Session();
    drawMainHeader($session);
    drawFooter();
?>