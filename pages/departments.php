<?php
    require_once(__DIR__ . '/../templates/common.tpl.php');
    require_once(__DIR__ . '/../templates/departments.tpl.php');
    require_once(__DIR__ . '/../utils/session.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/connection.db.php');

    $session = new Session();
    $db = getDatabaseConnection();
    $user = Agent::getUserWithId($db, $session->getID());
    $departments = $user->getDepartments($db);

    drawHeader($session);
    drawBegin($session, $user);
    foreach($departments as $department){
        drawDepartment($department, $user, $db);
    }
    drawEnd($user);
?>