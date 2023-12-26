<?php
declare(strict_types = 1);
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
require_once(__DIR__ . '/../database/connection.db.php');
require_once(__DIR__ . '/../database/ticket.class.php');
require_once(__DIR__ . '/../database/user.class.php');
$db = getDatabaseConnection();

$user = User::getUserWithID($db, $session->getID());
$newHashtag = $_POST['myHashtag'];
$idticket = $_POST["ticket_id"];
$ticket = $user->getTicketWithID($db, intval($idticket));
$ticket->updateHashtag($db, intval($idticket), $newHashtag); 


header('Location: ../pages/ticket_detail.php?ticket=' . urlencode($idticket));

?>