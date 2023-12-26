<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $user = User::getUserWithID($db, $session->getID());

    $title = $_POST["name"];
    $content = $_POST["description"];
    $user->addDepartment($db, $title, $content);

    header("Location: ../pages/departments.php");
?>
