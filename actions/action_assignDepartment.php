<?php
    declare(strict_types = 1);
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/ticket.class.php');
    $session = new Session();
    $db = getDatabaseConnection();

    $agentID = intval($_POST["id"]);
    $department = $_POST["departmentsassign"];
    $agent = User::getUserWithID($db, $agentID);

    $agent->assignDepartment($db, $department);
    header("Location: ../pages/profile_foreign.php?user=" . $agentID);
?>
