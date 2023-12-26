<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    $session = new Session();
    $db = getDatabaseConnection();

    $user = User::getUserWithID($db, $session->getID());
    $agentID = intval($_POST["idAgent"]);

    $ticket= $user->getTicketWithID($db, $_POST["ticket_id"]);
    $ticket->assignTicket($db, $agentID);
    
    header("Location: ../pages/ticket_detail.php?ticket=" . $_POST["ticket_id"]);
?>
