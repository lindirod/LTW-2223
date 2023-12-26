<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/inquirie.class.php');
    require_once(__DIR__ . '/../templates/tickets.tpl.php');
    require_once(__DIR__ . '/../templates/inquiries.tpl.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithId($db, $session->getID());

    $ticket = $user->getTicketWithID($db, intval($_GET['ticket']));
    
    $inquiries = $ticket->getInquiries($db);

    $changes = $ticket->getChanges($db);

    function compareTickets($a, $b) {
        return $a->idChange - $b->idChange;
    }

    usort($changes, 'compareTickets');


    drawTicketsHeader($session, "<link href=\"../css/inquires_style.css\" rel=\"stylesheet\">");
    drawInquiries($inquiries, $ticket, $user, $changes);
?>