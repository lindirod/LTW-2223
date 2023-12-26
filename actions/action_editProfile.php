<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    
    $session = new Session();
    $db = getDatabaseConnection();

    $user = User::getUserWithID($db, $session->getID());
    $new_pass = sha1($_POST['new_password']);

    $user->updateUser($db, $_POST['username'], $_POST['name'], $new_pass, $_POST['email']);

    header('Location: ../pages/profile.php');
?>