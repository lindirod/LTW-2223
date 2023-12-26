<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/tickets.tpl.php');
    require_once(__DIR__ . '/../templates/users_all.tpl.php');
    
    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithId($db, $session->getID());

    $users = User::getAllUsers($db);
    
    drawTicketsHeader($session);
    drawUsersAll($users);
?>