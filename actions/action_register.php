<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $password = sha1($_POST['password']);
    User::addUser($db, $_POST['username'], $_POST['name'], $password, $_POST['email']);

    header('Location: ../pages');
?>