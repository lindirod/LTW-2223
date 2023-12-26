<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/faq.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    
    $session = new Session();
    drawFAQ($session);
?>