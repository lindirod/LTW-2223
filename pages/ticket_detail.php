<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/tickets.tpl.php');
    require_once(__DIR__ . '/../templates/ticket_detail.tpl.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithId($db, $session->getID());

    $ticket = $user->getTicketWithID($db, $_GET['ticket']);

    drawTicketsHeader($session, "<link href=\"../css/ticketsDetail_style.css\" rel=\"stylesheet\">");
    drawTicketDetail($db, $ticket, $user);
?>