<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/contacts.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();
    drawHeader($session);
    drawContacts();
?>