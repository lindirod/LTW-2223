<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $session = new Session();
    $db = getDatabaseConnection();

    $user = User::getUser($db, $_POST['email'], $_POST['password']);

    if ($user) {
        $session->setID($user->id);
        $session->setName($user->name);
        $session->addMessage('success', 'Login successful!');
      } else {
        $session->addMessage('error', 'Wrong password!');
      }

      header('Location: ../pages');
?>