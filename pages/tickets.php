<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/tickets.tpl.php');

    
    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithId($db, $session->getID());

    $assigned = $user->getTickets($db, "Assigned");
    $closed = $user->getTickets($db, "Closed");
    $opened = $user->getTickets($db, "Opened");

    drawTicketsHeader($session);
    drawTickets($opened, $assigned, $closed);
?>