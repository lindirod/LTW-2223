<?php
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/about_us.tpl.php');
    $session = new Session();
    drawHeader($session);
    drawAboutUs();
?>