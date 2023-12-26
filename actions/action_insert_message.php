<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/inquirie.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    
    $user = User::getUserWithID($db, $session->getID());

    $currentDate = date('Y-m-d');

    $inquirie =  new Inquirie(1, $_GET["content"], $currentDate, $user->id, intval($_GET["idTicket"]));

    Ticket::addInquirie($db, $inquirie);

    header("Location: ../pages/inquiries.php?ticket=" . $_GET["idTicket"]);
?>