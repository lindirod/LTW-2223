<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithID($db, $session->getID());

    $department = $_POST['department'];
    $id = $_POST["ticket_id"];

    $ticket = $user->getTicketWithID($db, $id);
    $ticket->changeDepartment($db, $department);
    
   header('Location: ../pages/departments.php');
?>