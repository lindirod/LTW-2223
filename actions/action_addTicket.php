<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    
    $user = User::getUserWithID($db, $session->getID());
    Ticket::addTicket($db, $_POST['title'], $_POST['description'], $user, $_POST["department"],$_POST["priority"], $_POST['hashtag']);

    header('Location: ../pages/profile.php');
?>