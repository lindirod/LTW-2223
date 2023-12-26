<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');

    $db = getDatabaseConnection();
    $session = new Session();

    $idticket = $_GET["ticket"];

    $user = User::getUserWithID($db, $session->getID()); 
    $ticket = $user->getTicketWithID($db, $idticket);
    $ticket->updateStatus($db, "Closed");
    
    header("Location: ../pages/departments.php");
?>
