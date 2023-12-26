<?php
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../templates/tickets.tpl.php');
    require_once(__DIR__ . '/../templates/tickets_all.tpl.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithId($db, $session->getID());

    if (!($user->checkDepartment($db, $_GET['department']))) header("Location: profile.php");

    $tickets = $user->getAllTicketsWithDepartment($db, $_GET['department']);

    $departments = $user->getAllDepartments($db);
    
    drawTicketsHeader($session);
    drawTicketsAll($db, $tickets, $departments);
?>