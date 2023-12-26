<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = User::getUserWithID($db, $session->getID());

    $userToUpgrade = User::getUserWithID($db, intval($_GET["user"]));

    if (!$user instanceof Agent) header("Location: ../pages");

    if ($userToUpgrade instanceof Agent) $userToUpgrade->upgradeToAdmin($db);

    else if ($userToUpgrade instanceof Client) $userToUpgrade->upgradeToAgent($db);

    header("Location: ../pages/profile_foreign.php?user=" . $_GET["user"]);
?>